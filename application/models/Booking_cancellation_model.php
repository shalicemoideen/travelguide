<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Booking Cancellation
 *
 * Cancellation is an EVENT, not a deletion. This model NEVER writes to
 * receipt_scheduler_*, property_payment_scheduler_* or property_reservation.
 * It only reads them to build a snapshot, then maintains its own ledger.
 *
 * All derived money columns are recomputed by recalculate() inside the same
 * transaction as the money event, so the stored figures and the screen can
 * never disagree.
 */
class Booking_cancellation_model extends CI_Model {

    var $table            = 'booking_cancellation';
    var $table_reason     = 'booking_cancellation_reason';
    var $table_cust_refund = 'booking_cancellation_customer_refund';
    var $table_property   = 'booking_cancellation_property';
    var $table_prop_refund = 'booking_cancellation_property_refund';
    var $table_service    = 'booking_cancellation_service';
    var $table_adjustment = 'booking_cancellation_adjustment';

    /* Booking statuses that may be cancelled */
    var $cancellable_statuses = array(5, 7, 8, 9);

    /* Cancellation header statuses that occupy the "active" slot */
    var $active_statuses = array('DRAFT', 'PENDING_APPROVAL', 'APPROVED', 'SETTLED');

    /* Property line statuses set manually that recalculate() must not override */
    var $terminal_line_statuses = array('REFUSED', 'WRITTEN_OFF');

    public function __construct()
    {
        parent::__construct();
    }

    // =====================================================
    // MASTERS
    // =====================================================

    public function get_reasons()
    {
        return $this->db
            ->where('cancellation_reason_status', 1)
            ->order_by('reason_sort_order', 'ASC')
            ->order_by('reason_name', 'ASC')
            ->get($this->table_reason)
            ->result();
    }

    /**
     * Confirmed bookings that do not already have an active cancellation.
     */
    public function get_eligible_bookings()
    {
        $this->db
            ->select('q.quotation_id, q.quotation_number, q.quotation_current_status,
                      l.guest_name, l.start_date')
            ->from('quotation q')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('q.quotation_status', 1)
            ->where_in('q.quotation_current_status', $this->cancellable_statuses)
            ->where("NOT EXISTS (
                        SELECT 1 FROM {$this->table} bc
                        WHERE bc.quotation_id_fk = q.quotation_id
                          AND bc.booking_cancellation_status = 1
                          AND bc.cancellation_status IN ('DRAFT','PENDING_APPROVAL','APPROVED','SETTLED')
                     )", NULL, FALSE)
            ->order_by('q.quotation_id', 'DESC');

        return $this->db->get()->result();
    }

    // =====================================================
    // ELIGIBILITY
    // =====================================================

    /**
     * @return array {eligible: bool, blockers: string[], booking: object|null}
     */
    public function check_eligibility($quotation_id)
    {
        $quotation_id = (int)$quotation_id;
        $blockers     = array();

        $booking = $this->get_booking_header($quotation_id);

        if (!$booking) {
            return array('eligible' => false, 'blockers' => array('Booking not found'), 'booking' => null);
        }

        if ((int)$booking->quotation_status !== 1) {
            $blockers[] = 'Booking has been deleted';
        }

        if ((int)$booking->quotation_current_status === 6) {
            $blockers[] = 'Booking is already cancelled';
        } elseif (!in_array((int)$booking->quotation_current_status, $this->cancellable_statuses)) {
            $blockers[] = 'Only confirmed bookings can be cancelled (current status: '
                        . $this->status_label($booking->quotation_current_status) . ')';
        }

        $existing = $this->get_active_cancellation($quotation_id);
        if ($existing) {
            $blockers[] = 'An active cancellation already exists (' . $existing->cancellation_number . ')';
        }

        return array(
            'eligible' => empty($blockers),
            'blockers' => $blockers,
            'booking'  => $booking,
            'existing' => $existing,
        );
    }

    public function status_label($status)
    {
        $map = array(
            1 => 'Generated', 2 => 'Draft', 3 => 'Sent', 4 => 'Rejected',
            5 => 'Confirmed', 6 => 'Cancelled', 7 => 'Ready to Trip',
            8 => 'Reservation Completed', 9 => 'Driver Not Assigned',
        );
        return isset($map[(int)$status]) ? $map[(int)$status] : 'Unknown';
    }

    public function get_booking_header($quotation_id)
    {
        return $this->db
            ->select('q.quotation_id, q.quotation_number, q.quotation_current_status,
                      q.quotation_status, q.leads_id_fk, q.quotation_date,
                      l.leads_id, l.leads_number, l.guest_name, l.whats_number AS guest_mobile_number,
                      l.start_date, l.end_date, l.duration, l.staff_id_fk,
                      ud.user_name AS staff_name')
            ->from('quotation q')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left')
            ->where('q.quotation_id', (int)$quotation_id)
            ->get()
            ->row();
    }

    public function get_active_cancellation($quotation_id)
    {
        return $this->db
            ->from($this->table)
            ->where('quotation_id_fk', (int)$quotation_id)
            ->where('booking_cancellation_status', 1)
            ->where_in('cancellation_status', $this->active_statuses)
            ->order_by('booking_cancellation_id', 'DESC')
            ->limit(1)
            ->get()
            ->row();
    }

    // =====================================================
    // WORKSHEET (live read, nothing persisted)
    // =====================================================

    /**
     * Builds the pre-cancellation worksheet: what the customer has paid us,
     * what we have paid each property, and the non-property services.
     */
    public function build_worksheet($quotation_id)
    {
        $quotation_id = (int)$quotation_id;

        $booking = $this->get_booking_header($quotation_id);
        if (!$booking) {
            return null;
        }

        $customer   = $this->get_customer_financials($quotation_id);
        $properties = $this->get_property_financials($quotation_id);
        $services   = $this->get_service_financials($quotation_id);

        $supplier_booked = 0.0;
        $supplier_paid   = 0.0;
        foreach ($properties as $p) {
            $supplier_booked += (float)$p['reservation_amount'];
            $supplier_paid   += (float)$p['amount_paid'];
        }

        $service_paid = 0.0;
        foreach ($services as $s) {
            $service_paid += (float)$s['amount_paid'];
        }

        $days_before = null;
        if (!empty($booking->start_date) && $booking->start_date !== '0000-00-00') {
            $days_before = (int)floor(
                (strtotime($booking->start_date) - strtotime(date('Y-m-d'))) / 86400
            );
        }

        return array(
            'booking'          => $booking,
            'days_before'      => $days_before,
            'customer'         => $customer,
            'properties'       => $properties,
            'services'         => $services,
            'supplier_booked'  => round($supplier_booked, 2),
            'supplier_paid'    => round($supplier_paid, 2),
            'service_paid'     => round($service_paid, 2),
        );
    }

    /**
     * Customer side money from receipt_scheduler. Read-only.
     */
    public function get_customer_financials($quotation_id)
    {
        $quotation_id = (int)$quotation_id;

        $scheduler = $this->db
            ->select('receipt_scheduler_id, payment_type, total_amount')
            ->from('receipt_scheduler')
            ->where('quotation_id_fk', $quotation_id)
            ->where('receipt_scheduler_status', 1)
            ->order_by('receipt_scheduler_id', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        $package_value = $scheduler ? (float)$scheduler->total_amount : 0.0;

        /* Fall back to the confirmed option quote when no scheduler exists yet */
        if ($package_value <= 0) {
            $package_value = (float)$this->get_confirmed_option_amount($quotation_id);
        }

        $received       = 0.0;
        $received_appr  = 0.0;

        if ($scheduler) {
            $row = $this->db
                ->select("COALESCE(SUM(p.payment_amount), 0) AS total,
                          COALESCE(SUM(CASE WHEN p.accountant_approval_status = 'approved'
                                            THEN p.payment_amount ELSE 0 END), 0) AS approved", FALSE)
                ->from('receipt_scheduler_payments p')
                ->where('p.receipt_scheduler_id_fk', $scheduler->receipt_scheduler_id)
                ->where('p.payment_status', 1)
                ->get()
                ->row();

            $received      = $row ? (float)$row->total : 0.0;
            $received_appr = $row ? (float)$row->approved : 0.0;
        }

        return array(
            'receipt_scheduler_id' => $scheduler ? (int)$scheduler->receipt_scheduler_id : 0,
            'payment_type'         => $scheduler ? $scheduler->payment_type : null,
            'package_value'        => round($package_value, 2),
            'received'             => round($received, 2),
            'received_approved'    => round($received_appr, 2),
            'outstanding'          => round(max(0, $package_value - $received), 2),
        );
    }

    public function get_confirmed_option_amount($quotation_id)
    {
        $row = $this->db
            ->select('qo.quotation_options_total_quote_rate AS amount')
            ->from('quotation_options qo')
            ->where('qo.quotation_id_fk', (int)$quotation_id)
            ->where('qo.quotation_options_status', 1)
            ->order_by('qo.quotation_options_id', 'ASC')
            ->limit(1)
            ->get()
            ->row();

        return $row ? (float)$row->amount : 0.0;
    }

    /**
     * Supplier side money per property reservation. Read-only.
     */
    public function get_property_financials($quotation_id)
    {
        $rows = $this->db
            ->select("pr.property_reservation_id, pr.properties_id_fk, pr.check_in_date,
                      pr.check_out_date, pr.duration_nights, pr.blocking_status,
                      pr.blocking_cutoff_date, pr.confirmation_status,
                      pr.confirmation_cnfm_no, pr.reconfirmation_status,
                      p.properties_name,
                      pps.property_payment_scheduler_id,
                      pps.total_amount, pps.discounted_total,
                      (CASE WHEN pps.discounted_total > 0
                            THEN pps.discounted_total ELSE pps.total_amount END) AS net_total", FALSE)
            ->from('property_reservation pr')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->join('property_payment_scheduler pps',
                   'pps.property_reservation_id_fk = pr.property_reservation_id
                    AND pps.property_payment_scheduler_status = 1', 'left')
            ->where('pr.quotation_id_fk', (int)$quotation_id)
            ->where('pr.property_reservation_status', 1)
            ->order_by('pr.check_in_date', 'ASC')
            ->get()
            ->result();

        $out = array();

        foreach ($rows as $r) {

            $paid = 0.0;
            if (!empty($r->property_payment_scheduler_id)) {
                $paid_row = $this->db
                    ->select('COALESCE(SUM(payment_amount), 0) AS total', FALSE)
                    ->from('property_payment_scheduler_payments')
                    ->where('property_payment_scheduler_id_fk', $r->property_payment_scheduler_id)
                    ->where('payment_status', 1)
                    ->get()
                    ->row();
                $paid = $paid_row ? (float)$paid_row->total : 0.0;
            }

            $reservation_amount = (float)$r->net_total;

            $out[] = array(
                'property_reservation_id'        => (int)$r->property_reservation_id,
                'properties_id'                 => (int)$r->properties_id_fk,
                'properties_name'               => $r->properties_name,
                'property_payment_scheduler_id' => $r->property_payment_scheduler_id ? (int)$r->property_payment_scheduler_id : null,
                'check_in_date'                 => $r->check_in_date,
                'check_out_date'                => $r->check_out_date,
                'duration_nights'               => (int)$r->duration_nights,
                'confirmation_number'           => $r->confirmation_cnfm_no,
                'cutoff_date'                   => $r->blocking_cutoff_date,
                'blocking_status'               => $r->blocking_status,
                'confirmation_status'           => $r->confirmation_status,
                'reservation_amount'            => round($reservation_amount, 2),
                'amount_paid'                   => round($paid, 2),
                'outstanding'                   => round(max(0, $reservation_amount - $paid), 2),
            );
        }

        return $out;
    }

    /**
     * Non-property services in scope. Transport is the only one with a
     * concrete allocation table today; the rest are entered manually.
     */
    public function get_service_financials($quotation_id)
    {
        $out = array();

        if (!$this->db->table_exists('quotation_transport_allocation')) {
            return $out;
        }

        $rows = $this->db
            ->select('qta.*')
            ->from('quotation_transport_allocation qta')
            ->where('qta.quotation_id_fk', (int)$quotation_id)
            ->get()
            ->result();

        $fields = $this->db->list_fields('quotation_transport_allocation');
        $pk     = in_array('quotation_transport_allocation_id', $fields)
                    ? 'quotation_transport_allocation_id' : null;
        $amount_field = null;
        foreach (array('transport_amount', 'driver_amount', 'total_amount', 'amount') as $candidate) {
            if (in_array($candidate, $fields)) { $amount_field = $candidate; break; }
        }

        foreach ($rows as $r) {
            $amount = $amount_field && isset($r->$amount_field) ? (float)$r->$amount_field : 0.0;

            $out[] = array(
                'service_type'        => 'TRANSPORT',
                'source_table'        => 'quotation_transport_allocation',
                'source_row_id'       => $pk && isset($r->$pk) ? (int)$r->$pk : null,
                'vendor_name'         => isset($r->driver_name) ? $r->driver_name : null,
                'service_description' => trim(
                    (isset($r->cab_number) ? 'Cab ' . $r->cab_number . ' ' : '')
                    . (isset($r->driver_mobile) ? '(' . $r->driver_mobile . ')' : '')
                ),
                'service_amount'      => round($amount, 2),
                'amount_paid'         => 0.00,
            );
        }

        return $out;
    }

    // =====================================================
    // CREATE
    // =====================================================

    public function generate_cancellation_number()
    {
        $year = date('Y');

        $row = $this->db
            ->select('cancellation_number')
            ->from($this->table)
            ->like('cancellation_number', 'CAN-' . $year . '-', 'after')
            ->order_by('booking_cancellation_id', 'DESC')
            ->limit(1)
            ->get()
            ->row();

        $next = 1;
        if ($row && preg_match('/CAN-' . $year . '-(\d+)/', $row->cancellation_number, $m)) {
            $next = (int)$m[1] + 1;
        }

        return 'CAN-' . $year . '-' . str_pad($next, 5, '0', STR_PAD_LEFT);
    }

    public function insert_header($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function insert_property_line($data)
    {
        $this->db->insert($this->table_property, $data);
        return $this->db->insert_id();
    }

    public function insert_service_line($data)
    {
        $this->db->insert($this->table_service, $data);
        return $this->db->insert_id();
    }

    public function update_header($id, $data)
    {
        $this->db->where('booking_cancellation_id', (int)$id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    public function update_property_line($id, $data)
    {
        $this->db->where('cancellation_property_id', (int)$id);
        $this->db->update($this->table_property, $data);
        return $this->db->affected_rows();
    }

    public function update_service_line($id, $data)
    {
        $this->db->where('cancellation_service_id', (int)$id);
        $this->db->update($this->table_service, $data);
        return $this->db->affected_rows();
    }

    // =====================================================
    // READ
    // =====================================================

    public function get_header($id)
    {
        return $this->db
            ->select('bc.*, q.quotation_number, q.quotation_current_status,
                      l.leads_number, l.guest_name, l.whats_number AS guest_mobile_number,
                      l.start_date, l.end_date, l.duration,
                      r.reason_name, r.reason_category, r.reason_code,
                      ud.user_name AS staff_name')
            ->from($this->table . ' bc')
            ->join('quotation q', 'q.quotation_id = bc.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = bc.leads_id_fk', 'left')
            ->join($this->table_reason . ' r', 'r.cancellation_reason_id = bc.cancellation_reason_id_fk', 'left')
            ->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left')
            ->where('bc.booking_cancellation_id', (int)$id)
            ->get()
            ->row();
    }

    public function get_property_lines($cancellation_id)
    {
        return $this->db
            ->select('cp.*, p.properties_name AS current_property_name')
            ->from($this->table_property . ' cp')
            ->join('properties p', 'p.properties_id = cp.properties_id_fk', 'left')
            ->where('cp.booking_cancellation_id_fk', (int)$cancellation_id)
            ->where('cp.cancellation_property_status', 1)
            ->order_by('cp.snap_check_in_date', 'ASC')
            ->get()
            ->result();
    }

    public function get_property_line($id)
    {
        return $this->db
            ->from($this->table_property)
            ->where('cancellation_property_id', (int)$id)
            ->get()
            ->row();
    }

    public function get_service_lines($cancellation_id)
    {
        return $this->db
            ->from($this->table_service)
            ->where('booking_cancellation_id_fk', (int)$cancellation_id)
            ->where('cancellation_service_status', 1)
            ->order_by('cancellation_service_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_customer_refunds($cancellation_id)
    {
        return $this->db
            ->from($this->table_cust_refund)
            ->where('booking_cancellation_id_fk', (int)$cancellation_id)
            ->where('customer_refund_status', 1)
            ->order_by('refund_date', 'ASC')
            ->order_by('customer_refund_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_customer_refund($id)
    {
        return $this->db
            ->from($this->table_cust_refund)
            ->where('customer_refund_id', (int)$id)
            ->get()
            ->row();
    }

    public function get_property_refunds($cancellation_id)
    {
        return $this->db
            ->from($this->table_prop_refund)
            ->where('booking_cancellation_id_fk', (int)$cancellation_id)
            ->where('property_refund_status', 1)
            ->order_by('refund_date', 'ASC')
            ->order_by('property_refund_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_property_refund($id)
    {
        return $this->db
            ->from($this->table_prop_refund)
            ->where('property_refund_id', (int)$id)
            ->get()
            ->row();
    }

    public function get_property_credits($cancellation_id)
    {
        if (!$this->db->table_exists('property_credit_ledger')) {
            return array();
        }

        return $this->db
            ->select('pcl.*, p.properties_name, q.quotation_number AS original_booking_number')
            ->from('property_credit_ledger pcl')
            ->join('properties p', 'p.properties_id = pcl.properties_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = pcl.quotation_id_fk', 'left')
            ->where('pcl.booking_cancellation_id_fk', (int)$cancellation_id)
            ->where('pcl.property_credit_status', 1)
            ->order_by('pcl.property_credit_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_adjustments($cancellation_id)
    {
        return $this->db
            ->from($this->table_adjustment)
            ->where('booking_cancellation_id_fk', (int)$cancellation_id)
            ->where('cancellation_adjustment_status', 1)
            ->order_by('cancellation_adjustment_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_full($id)
    {
        $header = $this->get_header($id);
        if (!$header) {
            return null;
        }

        return array(
            'header'           => $header,
            'properties'       => $this->get_property_lines($id),
            'services'         => $this->get_service_lines($id),
            'customer_refunds' => $this->get_customer_refunds($id),
            'property_refunds' => $this->get_property_refunds($id),
            'property_credits' => $this->get_property_credits($id),
            'adjustments'      => $this->get_adjustments($id),
        );
    }

    // =====================================================
    // MONEY ROWS (append-only)
    // =====================================================

    public function insert_customer_refund($data)
    {
        $this->db->insert($this->table_cust_refund, $data);
        return $this->db->insert_id();
    }

    public function insert_property_refund($data)
    {
        $this->db->insert($this->table_prop_refund, $data);
        return $this->db->insert_id();
    }

    public function insert_adjustment($data)
    {
        $this->db->insert($this->table_adjustment, $data);
        return $this->db->insert_id();
    }

    public function approve_customer_refund($id, $data)
    {
        $this->db->where('customer_refund_id', (int)$id);
        $this->db->update($this->table_cust_refund, $data);
        return $this->db->affected_rows();
    }

    /** Signed sum: REFUND positive, REVERSAL negative. */
    public function sum_customer_refunds($cancellation_id)
    {
        $row = $this->db
            ->select("COALESCE(SUM(CASE WHEN refund_entry_type = 'REVERSAL'
                                        THEN -refund_amount ELSE refund_amount END), 0) AS total", FALSE)
            ->from($this->table_cust_refund)
            ->where('booking_cancellation_id_fk', (int)$cancellation_id)
            ->where('customer_refund_status', 1)
            ->get()
            ->row();

        return $row ? (float)$row->total : 0.0;
    }

    public function sum_property_refunds($cancellation_property_id)
    {
        $row = $this->db
            ->select("COALESCE(SUM(CASE WHEN refund_entry_type = 'REVERSAL'
                                        THEN -refund_amount ELSE refund_amount END), 0) AS total", FALSE)
            ->from($this->table_prop_refund)
            ->where('cancellation_property_id_fk', (int)$cancellation_property_id)
            ->where('property_refund_status', 1)
            ->get()
            ->row();

        return $row ? (float)$row->total : 0.0;
    }

    public function sum_reversed_amount($table, $id_column, $refund_id)
    {
        $row = $this->db
            ->select('COALESCE(SUM(refund_amount), 0) AS total', FALSE)
            ->from($table)
            ->where('reverses_refund_id_fk', (int)$refund_id)
            ->where($id_column . ' IS NOT NULL', NULL, FALSE)
            ->get()
            ->row();

        return $row ? (float)$row->total : 0.0;
    }

    // =====================================================
    // SNAPSHOT RE-SYNC — draft only
    // =====================================================

    /**
     * While a cancellation is still editable (DRAFT / PENDING_APPROVAL) the
     * money snapshot must track the live booking, so payments recorded against
     * the customer or a property after the draft was created still flow in.
     * Once APPROVED the snapshot is frozen forever so the approved P&L stays
     * reproducible. Only the frozen "paid / received / booked" figures are
     * refreshed here — user-entered charges are never touched.
     */
    public function resync_snapshots($cancellation_id)
    {
        $cancellation_id = (int)$cancellation_id;

        $header = $this->db
            ->select('booking_cancellation_id, quotation_id_fk, cancellation_status')
            ->from($this->table)
            ->where('booking_cancellation_id', $cancellation_id)
            ->get()
            ->row();

        if (!$header || !in_array($header->cancellation_status, array('DRAFT', 'PENDING_APPROVAL'))) {
            return false;
        }

        $quotation_id = (int)$header->quotation_id_fk;

        $customer   = $this->get_customer_financials($quotation_id);
        $properties = $this->get_property_financials($quotation_id);

        $by_reservation = array();
        foreach ($properties as $p) {
            $by_reservation[(int)$p['property_reservation_id']] = $p;
        }

        $supplier_booked = 0.0;
        $supplier_paid   = 0.0;

        foreach ($this->get_property_lines($cancellation_id) as $line) {
            $rid = (int)$line->property_reservation_id_fk;

            if (isset($by_reservation[$rid])) {
                $p = $by_reservation[$rid];
                $this->update_property_line($line->cancellation_property_id, array(
                    'snap_reservation_amount'  => $p['reservation_amount'],
                    'snap_amount_paid'         => $p['amount_paid'],
                    'snap_outstanding_payable' => $p['outstanding'],
                ));
                $supplier_booked += (float)$p['reservation_amount'];
                $supplier_paid   += (float)$p['amount_paid'];
            } else {
                /* reservation no longer live -> keep the existing snapshot */
                $supplier_booked += (float)$line->snap_reservation_amount;
                $supplier_paid   += (float)$line->snap_amount_paid;
            }
        }

        $this->update_header($cancellation_id, array(
            'snap_package_value'        => $customer['package_value'],
            'snap_customer_received'    => $customer['received'],
            'snap_customer_outstanding' => $customer['outstanding'],
            'snap_supplier_booked'      => round($supplier_booked, 2),
            'snap_supplier_paid'        => round($supplier_paid, 2),
        ));

        return true;
    }

    // =====================================================
    // RECALCULATION — the single source of financial truth
    // =====================================================

    /**
     * Recomputes every derived money column and status for one cancellation.
     * Must be called inside the same transaction as any money event.
     */
    public function recalculate($cancellation_id)
    {
        $cancellation_id = (int)$cancellation_id;

        $header = $this->db
            ->from($this->table)
            ->where('booking_cancellation_id', $cancellation_id)
            ->get()
            ->row();

        if (!$header) {
            return null;
        }

        /* Keep the snapshot in step with live booking money while still editable,
           then re-read the header so the P&L below uses the refreshed figures. */
        if (in_array($header->cancellation_status, array('DRAFT', 'PENDING_APPROVAL'))) {
            $this->resync_snapshots($cancellation_id);
            $header = $this->db
                ->from($this->table)
                ->where('booking_cancellation_id', $cancellation_id)
                ->get()
                ->row();
        }

        // ---------- Property lines ----------
        $lines = $this->get_property_lines($cancellation_id);

        $supplier_charge   = 0.0;
        $refund_expected   = 0.0;
        $refund_received   = 0.0;
        $still_payable     = 0.0;
        $written_off       = 0.0;
        $open_lines        = 0;
        $lines_with_refund = 0;

        foreach ($lines as $line) {

            $paid     = (float)$line->snap_amount_paid;
            $charge   = (float)$line->cancellation_charge;
            $wo       = (float)$line->amount_written_off;
            $received = $this->sum_property_refunds($line->cancellation_property_id);

            $expected = max(0, $paid - $charge);
            $payable  = max(0, $charge - $paid);
            $pending  = max(0, $expected - $received - $wo);

            $status = $this->derive_property_line_status($line, $expected, $received, $payable);

            $this->update_property_line($line->cancellation_property_id, array(
                'refund_expected'           => round($expected, 2),
                'refund_received'           => round($received, 2),
                'refund_pending'            => round($pending, 2),
                'still_payable_to_property' => round($payable, 2),
                'line_status'               => $status,
            ));

            $supplier_charge += $charge;
            $refund_expected += $expected;
            $refund_received += $received;
            $still_payable   += $payable;
            $written_off     += $wo;

            if ($received > 0)      { $lines_with_refund++; }
            if ($pending > 0.009)   { $open_lines++; }
        }

        // ---------- Service lines ----------
        $services      = $this->get_service_lines($cancellation_id);
        $service_cost  = 0.0;

        foreach ($services as $svc) {
            $paid     = (float)$svc->snap_amount_paid;
            $charge   = (float)$svc->cancellation_charge;
            $received = (float)$svc->refund_received;
            $expected = (int)$svc->is_recoverable === 1 ? max(0, $paid - $charge) : 0.0;

            $this->update_service_line($svc->cancellation_service_id, array(
                'refund_expected' => round($expected, 2),
            ));

            $service_cost += ($paid - $received) + max(0, $charge - $paid);
        }

        // ---------- Customer side ----------
        $received_from_customer = (float)$header->snap_customer_received;
        $customer_charge        = (float)$header->customer_cancellation_charge;
        $customer_refund_due    = round($received_from_customer - $customer_charge, 2);
        $customer_refund_paid   = round($this->sum_customer_refunds($cancellation_id), 2);

        $customer_status = $this->derive_customer_settlement_status(
            $header, $received_from_customer, $customer_refund_due, $customer_refund_paid
        );

        // ---------- Supplier rollup ----------
        $supplier_status = $this->derive_supplier_settlement_status(
            $header, $lines, $refund_expected, $refund_received, $open_lines, $lines_with_refund
        );

        // ---------- Adjustments ----------
        $adj = $this->db
            ->select("COALESCE(SUM(CASE WHEN adjustment_direction = 'CREDIT'
                                        THEN adjustment_amount ELSE -adjustment_amount END), 0) AS total", FALSE)
            ->from($this->table_adjustment)
            ->where('booking_cancellation_id_fk', $cancellation_id)
            ->where('cancellation_adjustment_status', 1)
            ->get()
            ->row();

        $adjustment_total = $adj ? (float)$adj->total : 0.0;

        // ---------- P&L ----------
        $net_retained  = $received_from_customer - $customer_refund_paid;
        $net_suppliers = ((float)$header->snap_supplier_paid - $refund_received) + $still_payable;
        $net_result    = $net_retained - $net_suppliers - $service_cost + $adjustment_total;

        $update = array(
            'customer_refund_due'          => $customer_refund_due,
            'customer_refund_paid'         => $customer_refund_paid,
            'customer_settlement_status'   => $customer_status,

            'supplier_cancellation_charge' => round($supplier_charge, 2),
            'supplier_refund_expected'     => round($refund_expected, 2),
            'supplier_refund_received'     => round($refund_received, 2),
            'supplier_still_payable'       => round($still_payable, 2),
            'supplier_settlement_status'   => $supplier_status,

            'net_retained_from_customer'   => round($net_retained, 2),
            'net_paid_to_suppliers'        => round($net_suppliers, 2),
            'net_other_cost'               => round($service_cost, 2),
            'net_adjustment_total'         => round($adjustment_total, 2),
            'net_result'                   => round($net_result, 2),
            'pnl_last_computed_datetime'   => date('Y-m-d H:i:s'),
        );

        /* Auto-close once both clocks have stopped */
        if ($header->cancellation_status === 'APPROVED'
            && in_array($customer_status, array('COMPLETED', 'NOT_APPLICABLE', 'WRITTEN_OFF'))
            && in_array($supplier_status, array('COMPLETED', 'NOT_APPLICABLE', 'WRITTEN_OFF'))) {
            $update['cancellation_status'] = 'SETTLED';
            $update['settled_datetime']    = date('Y-m-d H:i:s');
        }

        $this->update_header($cancellation_id, $update);

        return $this->get_summary($cancellation_id);
    }

    private function derive_property_line_status($line, $expected, $received, $payable)
    {
        if (in_array($line->line_status, $this->terminal_line_statuses)) {
            return $line->line_status;
        }

        if ($payable > 0.009) {
            return 'PAYABLE_PENDING';
        }

        if ($expected <= 0.009) {
            return 'NO_REFUND_DUE';
        }

        if ($received >= $expected - 0.009) {
            return 'FULLY_REFUNDED';
        }

        if ($received > 0.009) {
            return 'PARTIALLY_REFUNDED';
        }

        /* Nothing received yet: keep the intimation stage until the hotel
           has confirmed its charge, then the refund clock starts. */
        if (!empty($line->charge_confirmed_date) && $line->charge_confirmed_date !== '0000-00-00') {
            return 'REFUND_PENDING';
        }

        return in_array($line->line_status, array('PENDING_INTIMATION', 'INTIMATED', 'CHARGE_CONFIRMED'))
            ? $line->line_status
            : 'REFUND_PENDING';
    }

    private function derive_customer_settlement_status($header, $received, $due, $paid)
    {
        if ($header->customer_settlement_status === 'WRITTEN_OFF') {
            return 'WRITTEN_OFF';
        }

        /* Nothing was ever received, or the customer owes us instead */
        if ($received <= 0.009 || $due <= 0.009) {
            return 'NOT_APPLICABLE';
        }

        if ($paid >= $due - 0.009) {
            return 'COMPLETED';
        }

        return $paid > 0.009 ? 'PARTIAL' : 'PENDING';
    }

    private function derive_supplier_settlement_status($header, $lines, $expected, $received, $open_lines, $lines_with_refund)
    {
        if ($header->supplier_settlement_status === 'WRITTEN_OFF') {
            return 'WRITTEN_OFF';
        }

        if (empty($lines) || $expected <= 0.009) {
            return 'NOT_APPLICABLE';
        }

        $all_closed = true;
        $closed     = array('FULLY_REFUNDED', 'WRITTEN_OFF', 'NO_REFUND_DUE', 'REFUSED');

        foreach ($lines as $line) {
            if (!in_array($line->line_status, $closed)) {
                $all_closed = false;
                break;
            }
        }

        if ($all_closed && $open_lines === 0) {
            return 'COMPLETED';
        }

        return $lines_with_refund > 0 ? 'PARTIAL' : 'PENDING';
    }

    /**
     * Summary block returned by every write endpoint so the UI never has to
     * derive money client-side.
     */
    public function get_summary($cancellation_id)
    {
        $h = $this->db
            ->from($this->table)
            ->where('booking_cancellation_id', (int)$cancellation_id)
            ->get()
            ->row();

        if (!$h) {
            return null;
        }

        return array(
            'booking_cancellation_id'      => (int)$h->booking_cancellation_id,
            'cancellation_number'          => $h->cancellation_number,
            'cancellation_status'          => $h->cancellation_status,

            'package_value'                => (float)$h->snap_package_value,
            'customer_received'             => (float)$h->snap_customer_received,
            'customer_outstanding'          => (float)$h->snap_customer_outstanding,
            'customer_cancellation_charge'  => (float)$h->customer_cancellation_charge,
            'customer_refund_due'           => (float)$h->customer_refund_due,
            'customer_refund_paid'          => (float)$h->customer_refund_paid,
            'customer_refund_balance'       => round((float)$h->customer_refund_due - (float)$h->customer_refund_paid, 2),
            'customer_settlement_status'    => $h->customer_settlement_status,

            'supplier_booked'               => (float)$h->snap_supplier_booked,
            'supplier_paid'                 => (float)$h->snap_supplier_paid,
            'supplier_cancellation_charge'  => (float)$h->supplier_cancellation_charge,
            'supplier_refund_expected'      => (float)$h->supplier_refund_expected,
            'supplier_refund_received'      => (float)$h->supplier_refund_received,
            'supplier_refund_pending'       => round((float)$h->supplier_refund_expected - (float)$h->supplier_refund_received, 2),
            'supplier_still_payable'        => (float)$h->supplier_still_payable,
            'supplier_settlement_status'    => $h->supplier_settlement_status,

            'net_retained_from_customer'    => (float)$h->net_retained_from_customer,
            'net_paid_to_suppliers'         => (float)$h->net_paid_to_suppliers,
            'net_other_cost'                => (float)$h->net_other_cost,
            'net_adjustment_total'          => (float)$h->net_adjustment_total,
            'net_result'                    => (float)$h->net_result,
        );
    }

    // =====================================================
    // DATATABLES: cancellation list / report
    // =====================================================

    private function _apply_list_filters($param)
    {
        $start_date        = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date          = isset($param['end_date']) ? $param['end_date'] : '';
        $quotation_number  = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name        = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $reason_filter     = isset($param['reason_filter']) ? $param['reason_filter'] : '';
        $status_filter     = isset($param['status_filter']) ? $param['status_filter'] : '';
        $cust_settlement   = isset($param['customer_settlement_filter']) ? $param['customer_settlement_filter'] : '';
        $supp_settlement   = isset($param['supplier_settlement_filter']) ? $param['supplier_settlement_filter'] : '';
        $staff_filter      = isset($param['staff_filter']) ? $param['staff_filter'] : '';
        $search_value      = isset($param['searchValue']) ? $param['searchValue'] : '';

        $this->db->where('bc.booking_cancellation_status', 1);

        if ($start_date)       { $this->db->where('bc.cancellation_effective_date >=', $start_date); }
        if ($end_date)         { $this->db->where('bc.cancellation_effective_date <=', $end_date); }
        if ($quotation_number) { $this->db->like('q.quotation_number', $quotation_number); }
        if ($guest_name)       { $this->db->like('l.guest_name', $guest_name); }
        if ($reason_filter)    { $this->db->where('bc.cancellation_reason_id_fk', (int)$reason_filter); }
        if ($status_filter)    { $this->db->where('bc.cancellation_status', $status_filter); }
        if ($cust_settlement)  { $this->db->where('bc.customer_settlement_status', $cust_settlement); }
        if ($supp_settlement)  { $this->db->where('bc.supplier_settlement_status', $supp_settlement); }
        if ($staff_filter)     { $this->db->where('l.staff_id_fk', (int)$staff_filter); }

        if ($search_value) {
            $this->db->group_start()
                ->like('bc.cancellation_number', $search_value)
                ->or_like('q.quotation_number', $search_value)
                ->or_like('l.guest_name', $search_value)
                ->group_end();
        }

        /* Sales staff see only their own bookings */
        if ($this->session->userdata('user_type') === 'S') {
            $this->db->where('l.staff_id_fk', $this->session->userdata('user_id'));
        }
    }

    public function getCancellationTable($param)
    {
        $this->db
            ->select('bc.*, q.quotation_number, l.leads_number, l.guest_name,
                      l.start_date, r.reason_name, ud.user_name AS staff_name')
            ->from($this->table . ' bc')
            ->join('quotation q', 'q.quotation_id = bc.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = bc.leads_id_fk', 'left')
            ->join($this->table_reason . ' r', 'r.cancellation_reason_id = bc.cancellation_reason_id_fk', 'left')
            ->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left');

        $this->_apply_list_filters($param);

        $this->db->order_by('bc.booking_cancellation_id', 'DESC');

        if ($param['length'] != -1 && $param['start'] !== 'false' && $param['length'] !== 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();

        $total = $this->getCancellationTotalCount($param);

        return array(
            'data'            => $query->result(),
            'recordsTotal'    => $total,
            'recordsFiltered' => $total,
        );
    }

    public function getCancellationTotalCount($param)
    {
        $this->db
            ->select('bc.booking_cancellation_id')
            ->from($this->table . ' bc')
            ->join('quotation q', 'q.quotation_id = bc.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = bc.leads_id_fk', 'left')
            ->join($this->table_reason . ' r', 'r.cancellation_reason_id = bc.cancellation_reason_id_fk', 'left');

        $this->_apply_list_filters($param);

        return $this->db->get()->num_rows();
    }

    // =====================================================
    // DATATABLES: supplier refund tracker (cross-booking)
    // =====================================================

    private function _apply_tracker_filters($param)
    {
        $property_filter = isset($param['property_filter']) ? $param['property_filter'] : '';
        $status_filter   = isset($param['line_status_filter']) ? $param['line_status_filter'] : '';
        $start_date      = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date        = isset($param['end_date']) ? $param['end_date'] : '';
        $age_bucket      = isset($param['age_bucket']) ? $param['age_bucket'] : '';
        $open_only       = isset($param['open_only']) ? $param['open_only'] : '';
        $search_value    = isset($param['searchValue']) ? $param['searchValue'] : '';

        $this->db->where('cp.cancellation_property_status', 1);
        $this->db->where('bc.booking_cancellation_status', 1);
        $this->db->where_in('bc.cancellation_status', array('APPROVED', 'SETTLED'));

        if ($property_filter) { $this->db->where('cp.properties_id_fk', (int)$property_filter); }
        if ($status_filter)   { $this->db->where('cp.line_status', $status_filter); }
        if ($start_date)      { $this->db->where('bc.cancellation_effective_date >=', $start_date); }
        if ($end_date)        { $this->db->where('bc.cancellation_effective_date <=', $end_date); }

        if ($open_only === '1') {
            $this->db->where_not_in('cp.line_status', array(
                'FULLY_REFUNDED', 'REFUSED', 'WRITTEN_OFF', 'NO_REFUND_DUE'
            ));
        }

        if ($age_bucket !== '') {
            $days = 'DATEDIFF(CURDATE(), bc.cancellation_effective_date)';
            switch ($age_bucket) {
                case '0_15':  $this->db->where("{$days} BETWEEN 0 AND 15", NULL, FALSE); break;
                case '16_30': $this->db->where("{$days} BETWEEN 16 AND 30", NULL, FALSE); break;
                case '31_60': $this->db->where("{$days} BETWEEN 31 AND 60", NULL, FALSE); break;
                case '60_up': $this->db->where("{$days} > 60", NULL, FALSE); break;
            }
        }

        if ($search_value) {
            $this->db->group_start()
                ->like('cp.snap_property_name', $search_value)
                ->or_like('bc.cancellation_number', $search_value)
                ->or_like('q.quotation_number', $search_value)
                ->or_like('l.guest_name', $search_value)
                ->group_end();
        }
    }

    public function getSupplierTrackerTable($param)
    {
        $this->db
            ->select('cp.*, bc.cancellation_number, bc.cancellation_effective_date,
                      bc.quotation_id_fk, q.quotation_number, l.guest_name,
                      DATEDIFF(CURDATE(), bc.cancellation_effective_date) AS age_days', FALSE)
            ->from($this->table_property . ' cp')
            ->join($this->table . ' bc', 'bc.booking_cancellation_id = cp.booking_cancellation_id_fk', 'inner')
            ->join('quotation q', 'q.quotation_id = bc.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = bc.leads_id_fk', 'left');

        $this->_apply_tracker_filters($param);

        $this->db->order_by('age_days', 'DESC');

        if ($param['length'] != -1 && $param['start'] !== 'false' && $param['length'] !== 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();
        $total = $this->getSupplierTrackerTotalCount($param);

        return array(
            'data'            => $query->result(),
            'recordsTotal'    => $total,
            'recordsFiltered' => $total,
        );
    }

    public function getSupplierTrackerTotalCount($param)
    {
        $this->db
            ->select('cp.cancellation_property_id')
            ->from($this->table_property . ' cp')
            ->join($this->table . ' bc', 'bc.booking_cancellation_id = cp.booking_cancellation_id_fk', 'inner')
            ->join('quotation q', 'q.quotation_id = bc.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = bc.leads_id_fk', 'left');

        $this->_apply_tracker_filters($param);

        return $this->db->get()->num_rows();
    }

    public function get_tracker_totals($param)
    {
        $this->db
            ->select('COALESCE(SUM(cp.refund_expected), 0) AS expected,
                      COALESCE(SUM(cp.refund_received), 0) AS received,
                      COALESCE(SUM(cp.refund_pending), 0)  AS pending,
                      COALESCE(SUM(cp.still_payable_to_property), 0) AS payable', FALSE)
            ->from($this->table_property . ' cp')
            ->join($this->table . ' bc', 'bc.booking_cancellation_id = cp.booking_cancellation_id_fk', 'inner')
            ->join('quotation q', 'q.quotation_id = bc.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = bc.leads_id_fk', 'left');

        $this->_apply_tracker_filters($param);

        $row = $this->db->get()->row();

        return array(
            'expected' => $row ? (float)$row->expected : 0.0,
            'received' => $row ? (float)$row->received : 0.0,
            'pending'  => $row ? (float)$row->pending : 0.0,
            'payable'  => $row ? (float)$row->payable : 0.0,
        );
    }

    // =====================================================
    // DATATABLES: customer refund register
    // =====================================================

    private function _apply_customer_refund_filters($param)
    {
        $start_date    = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date      = isset($param['end_date']) ? $param['end_date'] : '';
        $mode_filter   = isset($param['mode_filter']) ? $param['mode_filter'] : '';
        $approval      = isset($param['approval_filter']) ? $param['approval_filter'] : '';
        $search_value  = isset($param['searchValue']) ? $param['searchValue'] : '';

        $this->db->where('cr.customer_refund_status', 1);

        if ($start_date)  { $this->db->where('cr.refund_date >=', $start_date); }
        if ($end_date)    { $this->db->where('cr.refund_date <=', $end_date); }
        if ($mode_filter) { $this->db->where('cr.refund_mode', $mode_filter); }
        if ($approval)    { $this->db->where('cr.accountant_approval_status', $approval); }

        if ($search_value) {
            $this->db->group_start()
                ->like('bc.cancellation_number', $search_value)
                ->or_like('q.quotation_number', $search_value)
                ->or_like('l.guest_name', $search_value)
                ->or_like('cr.refund_reference', $search_value)
                ->group_end();
        }
    }

    public function getCustomerRefundTable($param)
    {
        $this->db
            ->select('cr.*, bc.cancellation_number, q.quotation_number, l.guest_name')
            ->from($this->table_cust_refund . ' cr')
            ->join($this->table . ' bc', 'bc.booking_cancellation_id = cr.booking_cancellation_id_fk', 'inner')
            ->join('quotation q', 'q.quotation_id = bc.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = bc.leads_id_fk', 'left');

        $this->_apply_customer_refund_filters($param);

        $this->db->order_by('cr.refund_date', 'DESC');
        $this->db->order_by('cr.customer_refund_id', 'DESC');

        if ($param['length'] != -1 && $param['start'] !== 'false' && $param['length'] !== 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();
        $total = $this->getCustomerRefundTotalCount($param);

        return array(
            'data'            => $query->result(),
            'recordsTotal'    => $total,
            'recordsFiltered' => $total,
        );
    }

    public function getCustomerRefundTotalCount($param)
    {
        $this->db
            ->select('cr.customer_refund_id')
            ->from($this->table_cust_refund . ' cr')
            ->join($this->table . ' bc', 'bc.booking_cancellation_id = cr.booking_cancellation_id_fk', 'inner')
            ->join('quotation q', 'q.quotation_id = bc.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = bc.leads_id_fk', 'left');

        $this->_apply_customer_refund_filters($param);

        return $this->db->get()->num_rows();
    }

    // =====================================================
    // MISC
    // =====================================================

    public function get_properties_with_cancellations()
    {
        return $this->db
            ->select('DISTINCT cp.properties_id_fk, cp.snap_property_name', FALSE)
            ->from($this->table_property . ' cp')
            ->where('cp.cancellation_property_status', 1)
            ->order_by('cp.snap_property_name', 'ASC')
            ->get()
            ->result();
    }

    public function fetch_staff()
    {
        return $this->db
            ->where('user_status', 1)
            ->order_by('user_name', 'ASC')
            ->get('user_details')
            ->result();
    }

    /**
     * Cancellations pending customer refund / overdue supplier refund.
     * Used by dashboard widgets.
     */
    public function get_dashboard_counts()
    {
        $cust = $this->db
            ->select('COUNT(*) AS cnt,
                      COALESCE(SUM(customer_refund_due - customer_refund_paid), 0) AS amount', FALSE)
            ->from($this->table)
            ->where('booking_cancellation_status', 1)
            ->where_in('cancellation_status', array('APPROVED'))
            ->where_in('customer_settlement_status', array('PENDING', 'PARTIAL'))
            ->get()
            ->row();

        $supp = $this->db
            ->select('COUNT(*) AS cnt, COALESCE(SUM(cp.refund_pending), 0) AS amount', FALSE)
            ->from($this->table_property . ' cp')
            ->join($this->table . ' bc', 'bc.booking_cancellation_id = cp.booking_cancellation_id_fk', 'inner')
            ->where('cp.cancellation_property_status', 1)
            ->where('cp.refund_pending >', 0)
            ->where('bc.booking_cancellation_status', 1)
            ->where('DATEDIFF(CURDATE(), bc.cancellation_effective_date) > 30', NULL, FALSE)
            ->get()
            ->row();

        $loss = $this->db
            ->select('COALESCE(SUM(net_result), 0) AS amount', FALSE)
            ->from($this->table)
            ->where('booking_cancellation_status', 1)
            ->where_in('cancellation_status', array('APPROVED', 'SETTLED'))
            ->where('MONTH(cancellation_effective_date) = MONTH(CURDATE())', NULL, FALSE)
            ->where('YEAR(cancellation_effective_date) = YEAR(CURDATE())', NULL, FALSE)
            ->get()
            ->row();

        return array(
            'customer_refund_pending_count'  => $cust ? (int)$cust->cnt : 0,
            'customer_refund_pending_amount' => $cust ? (float)$cust->amount : 0.0,
            'supplier_overdue_count'         => $supp ? (int)$supp->cnt : 0,
            'supplier_overdue_amount'        => $supp ? (float)$supp->amount : 0.0,
            'month_net_result'               => $loss ? (float)$loss->amount : 0.0,
        );
    }
}
