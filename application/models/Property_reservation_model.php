<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Property_reservation_model extends CI_Model {

    var $table                = 'property_reservation';
    var $table_payment        = 'property_payment_scheduler';
    var $table_installments   = 'property_payment_scheduler_installments';
    var $table_payments       = 'property_payment_scheduler_payments';
    var $table_comments       = 'property_reservation_comments';

    public function __construct()
    {
        parent::__construct();
    }

    // =========================================================
    // BOOKINGS (confirmed quotations) + OPTIONS
    // =========================================================

    /**
     * Confirmed quotations for the Booking No dropdown.
     * quotation_current_status = 5 => accepted/confirmed (same as Receipt Scheduler).
     */
    public function get_confirmed_bookings()
    {
        return $this->db
            ->select('q.quotation_id, q.quotation_number, l.guest_name, l.leads_number')
            ->from('quotation q')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('q.quotation_current_status', 5)
            ->where('q.quotation_status', 1)
            ->order_by('q.quotation_id', 'DESC')
            ->get()
            ->result();
    }

    public function get_options_for_quotation($quotation_id)
    {
        return $this->db
            ->select('quotation_options_id, quotation_options_title')
            ->from('quotation_options')
            ->where('quotation_id_fk', (int)$quotation_id)
            ->where('quotation_options_status', 1)
            ->order_by('quotation_options_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_booking_header($quotation_id)
    {
        return $this->db
            ->select('q.quotation_id, q.quotation_number, q.leads_id_fk,
                      l.guest_name, l.leads_number, l.start_date, l.end_date, l.duration')
            ->from('quotation q')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('q.quotation_id', (int)$quotation_id)
            ->get()
            ->row();
    }

    // =========================================================
    // PROPERTIES for a booking+option (with derived dates)
    // =========================================================

    /**
     * Distinct properties confirmed within a quotation option, with
     * check-in/check-out derived from leads.start_date + day offset.
     * nights = number of distinct days that property spans.
     */
    public function get_properties_for_booking($quotation_id, $quotation_options_id)
    {
        $rows = $this->db
            ->select('qp.properties_id_fk, p.properties_name,
                      qpd.quotation_properties_days_day AS day_number')
            ->from('quotation_properties_days qpd')
            ->join('quotation_properties qp', 'qp.quotation_properties_days_id_fk = qpd.quotation_properties_days_id', 'inner')
            ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')
            ->where('qpd.quotation_id_fk', (int)$quotation_id)
            ->where('qpd.quotation_options_id_fk', (int)$quotation_options_id)
            ->where('qpd.quotation_properties_days_status', 1)
            ->where('qp.quotation_properties_status', 1)
            ->order_by('qp.properties_id_fk', 'ASC')
            ->get()
            ->result();

        // Group by property -> collect day numbers
        $grouped = array();
        foreach ($rows as $r) {
            $pid = (int)$r->properties_id_fk;
            if (!isset($grouped[$pid])) {
                $grouped[$pid] = array(
                    'properties_id'   => $pid,
                    'properties_name' => $r->properties_name,
                    'days'            => array(),
                );
            }
            $day = (int)preg_replace('/[^0-9]/', '', (string)$r->day_number);
            if ($day <= 0) { $day = count($grouped[$pid]['days']) + 1; }
            $grouped[$pid]['days'][] = $day;
        }

        $header = $this->get_booking_header($quotation_id);
        $start  = ($header && $header->start_date) ? $header->start_date : date('Y-m-d');

        $result = array();
        foreach ($grouped as $pid => $g) {
            sort($g['days']);
            $min_day = $g['days'][0];
            $nights  = count(array_unique($g['days']));
            $check_in  = date('Y-m-d', strtotime($start . ' +' . ($min_day - 1) . ' days'));
            $check_out = date('Y-m-d', strtotime($check_in . ' +' . max(1, $nights) . ' days'));

            $result[] = array(
                'properties_id'   => $pid,
                'properties_name' => $g['properties_name'],
                'check_in_date'   => $check_in,
                'check_out_date'  => $check_out,
                'duration_nights' => max(1, $nights),
            );
        }

        return $result;
    }

    // =========================================================
    // RESERVATION load / seed
    // =========================================================

    public function get_reservation($quotation_id, $properties_id)
    {
        return $this->db
            ->from($this->table)
            ->where('quotation_id_fk', (int)$quotation_id)
            ->where('properties_id_fk', (int)$properties_id)
            ->where('property_reservation_status', 1)
            ->get()
            ->row();
    }

    public function get_reservation_by_id($id)
    {
        return $this->db
            ->select('pr.*, q.quotation_number, p.properties_name')
            ->from('property_reservation pr')
            ->join('quotation q', 'q.quotation_id = pr.quotation_id_fk', 'left')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->where('pr.property_reservation_id', (int)$id)
            ->get()
            ->row();
    }

    public function create_reservation($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update_reservation($id, $data)
    {
        $this->db->where('property_reservation_id', (int)$id);
        $this->db->update($this->table, $data);
        return $this->db->affected_rows();
    }

    // =========================================================
    // PAYMENT SCHEDULER (mirror of receipt_scheduler)
    // =========================================================

    public function get_payment_by_reservation($property_reservation_id)
    {
        return $this->db
            ->from($this->table_payment)
            ->where('property_reservation_id_fk', (int)$property_reservation_id)
            ->where('property_payment_scheduler_status', 1)
            ->get()
            ->row();
    }

    public function save_payment($data)
    {
        $this->db->insert($this->table_payment, $data);
        return $this->db->insert_id();
    }

    public function update_payment($id, $data)
    {
        $this->db->where('property_payment_scheduler_id', (int)$id);
        $this->db->update($this->table_payment, $data);
        return $this->db->affected_rows();
    }

    public function save_installment($data)
    {
        $this->db->insert($this->table_installments, $data);
        return $this->db->insert_id();
    }

    public function get_installments($scheduler_id)
    {
        return $this->db
            ->from($this->table_installments)
            ->where('property_payment_scheduler_id_fk', (int)$scheduler_id)
            ->where('installment_status', 1)
            ->order_by('installment_number', 'ASC')
            ->get()
            ->result();
    }

    public function delete_installments($scheduler_id)
    {
        $this->db->where('property_payment_scheduler_id_fk', (int)$scheduler_id);
        $this->db->update($this->table_installments, array('installment_status' => 0));
        return $this->db->affected_rows();
    }

    public function get_installment_by_id($installment_id)
    {
        return $this->db
            ->from($this->table_installments)
            ->where('installment_id', (int)$installment_id)
            ->where('installment_status', 1)
            ->get()
            ->row();
    }

    public function update_installment($id, $data)
    {
        $this->db->where('installment_id', (int)$id);
        $this->db->update($this->table_installments, $data);
        return $this->db->affected_rows();
    }

    public function save_payment_txn($data)
    {
        $this->db->insert($this->table_payments, $data);
        return $this->db->insert_id();
    }

    public function get_payment_by_id($payment_id)
    {
        return $this->db
            ->from($this->table_payments)
            ->where('payment_id', (int)$payment_id)
            ->where('payment_status', 1)
            ->get()
            ->row();
    }

    public function get_payments_by_installment_id($installment_id)
    {
        return $this->db
            ->from($this->table_payments)
            ->where('installment_id_fk', (int)$installment_id)
            ->where('payment_status', 1)
            ->order_by('payment_date', 'ASC')
            ->get()
            ->result();
    }

    public function get_total_paid_by_scheduler($scheduler_id)
    {
        $row = $this->db
            ->select_sum('payment_amount')
            ->from($this->table_payments)
            ->where('property_payment_scheduler_id_fk', (int)$scheduler_id)
            ->where('payment_status', 1)
            ->get()
            ->row();
        return $row && $row->payment_amount ? (float)$row->payment_amount : 0;
    }

    public function get_scheduler_with_details($scheduler_id)
    {
        return $this->db
            ->select('pps.*, q.quotation_number, l.guest_name, l.leads_number')
            ->from('property_payment_scheduler pps')
            ->join('quotation q', 'q.quotation_id = pps.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('pps.property_payment_scheduler_id', (int)$scheduler_id)
            ->where('pps.property_payment_scheduler_status', 1)
            ->get()
            ->row();
    }

    public function get_payment_summary_by_scheduler($scheduler_id)
    {
        $payment = $this->get_payment_by_reservation(null);
        $payment = $this->db
            ->from($this->table_payment)
            ->where('property_payment_scheduler_id', (int)$scheduler_id)
            ->where('property_payment_scheduler_status', 1)
            ->get()->row();
        if (!$payment) return null;

        $installments = $this->get_installments($scheduler_id);
        $total_paid   = $this->get_total_paid_by_scheduler($scheduler_id);
        $net_total    = $payment->discounted_total > 0 ? $payment->discounted_total : $payment->total_amount;
        $pending      = $net_total - $total_paid;

        $overdue_count = 0;
        foreach ($installments as $inst) {
            if ($inst->payment_status === 'OVERDUE') $overdue_count++;
        }

        return array(
            'payment'      => $payment,
            'installments' => $installments,
            'net_total'    => $net_total,
            'total_paid'   => $total_paid,
            'pending'      => max(0, $pending),
            'overdue_count'=> $overdue_count,
        );
    }

    public function get_quotation_total_amount($quotation_id)
    {
        $option = $this->db
            ->select('quotation_options_total_quote_rate')
            ->from('quotation_options')
            ->where('quotation_id_fk', (int)$quotation_id)
            ->where('quotation_options_status', 1)
            ->order_by('quotation_options_id', 'ASC')
            ->limit(1)
            ->get()
            ->row();

        return $option ? (float)$option->quotation_options_total_quote_rate : 0;
    }

    public function get_accommodation_dates($quotation_id, $properties_id)
    {
        $rows = $this->db
            ->select('ap.accommodation_date')
            ->from('quotation_properties_days qpd')
            ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'inner')
            ->join('quotation_properties qp', 'qp.quotation_properties_days_id_fk = qpd.quotation_properties_days_id', 'inner')
            ->where('qpd.quotation_id_fk', (int)$quotation_id)
            ->where('qp.properties_id_fk', (int)$properties_id)
            ->where('qpd.quotation_properties_days_status', 1)
            ->where('qp.quotation_properties_status', 1)
            ->where('ap.accommodation_plan_status', 1)
            ->order_by('ap.accommodation_date', 'ASC')
            ->get()
            ->result();

        $dates = array();
        foreach ($rows as $r) {
            if ($r->accommodation_date && $r->accommodation_date !== '0000-00-00') {
                $dates[] = $r->accommodation_date;
            }
        }
        return array_values(array_unique($dates));
    }

    public function get_property_total_amount($quotation_id, $properties_id)
    {
        $result = $this->db
            ->select('SUM(qrtd.manual_total_rate) AS property_total')
            ->from('quotation_confirmation qc')
            ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')
            ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')
            ->join('quotation_properties_rooms qpr', 'qpr.quotation_properties_rooms_id = qc.properties_room_id_fk', 'inner')
            ->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id', 'left')
            ->where('qc.quotation_id_fk', (int)$quotation_id)
            ->where('qc.property_confirmation_status', 1)
            ->where('qp.properties_id_fk', (int)$properties_id)
            ->where('qp.quotation_properties_status', 1)
            ->where('qpr.quotation_properties_rooms_status', 1)
            ->get()
            ->row();

        return $result ? (float)$result->property_total : 0;
    }

    // =========================================================
    // COMMENTS
    // =========================================================

    public function add_comment($data)
    {
        $this->db->insert($this->table_comments, $data);
        return $this->db->insert_id();
    }

    public function get_comments($property_reservation_id)
    {
        return $this->db
            ->select('c.*, ud.admin_name AS created_by_name')
            ->from('property_reservation_comments c')
            ->join('user_details ud', 'ud.user_id = c.comment_created_by_userid', 'left')
            ->where('c.property_reservation_id_fk', (int)$property_reservation_id)
            ->where('c.comment_status', 1)
            ->order_by('c.property_reservation_comments_id', 'DESC')
            ->get()
            ->result();
    }

    // =========================================================
    // PROPERTY STATUS SUMMARY (Quote Hub panel)
    // =========================================================

    public function get_status_summary($quotation_id)
    {
        // Fetch distinct properties from confirmed client confirmation, derive check-in/out from accommodation_plan
        $rows = $this->db
            ->select('
                p.properties_id,
                p.properties_name,
                MIN(ap.accommodation_date) AS check_in_date,
                COUNT(DISTINCT qpd.quotation_properties_days_id) AS night_count,
                pr.property_reservation_id,
                pr.blocking_status,
                pr.confirmation_status,
                pr.reconfirmation_status
            ')
            ->from('quotation_confirmation qc')
            ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')
            ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')
            ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')
            ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')
            ->join('property_reservation pr', 'pr.quotation_id_fk = qc.quotation_id_fk AND pr.properties_id_fk = qp.properties_id_fk AND pr.property_reservation_status = 1', 'left')
            ->where('qc.quotation_id_fk', (int)$quotation_id)
            ->where('qc.property_confirmation_status', 1)
            ->group_by('qp.properties_id_fk')
            ->order_by('check_in_date', 'ASC')
            ->get()
            ->result();

        // Compute check_out as check_in + nights
        foreach ($rows as $r) {
            $nights = max(1, (int)$r->night_count);
            $r->duration_nights = $nights;
            if ($r->check_in_date && $r->check_in_date !== '0000-00-00') {
                $r->check_out_date = date('Y-m-d', strtotime($r->check_in_date . ' +' . $nights . ' days'));
            } else {
                $r->check_out_date = null;
            }
        }

        $total       = count($rows);
        $blocked     = 0;
        $confirmed   = 0;
        $reconfirmed = 0;

        foreach ($rows as $r) {
            if ($r->blocking_status === 'BLOCKED')           { $blocked++; }
            if ($r->confirmation_status === 'CONFIRMED')     { $confirmed++; }
            if ($r->reconfirmation_status === 'RECONFIRMED') { $reconfirmed++; }
        }

        return array(
            'rows'        => $rows,
            'total'       => $total,
            'blocked'     => $blocked,
            'confirmed'   => $confirmed,
            'reconfirmed' => $reconfirmed,
        );
    }

    // =========================================================
    // PROPERTY PAYMENTS REPORT (Accountant)
    // =========================================================

    public function getPropertySchedulerReportTable($param)
    {
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name_filter       = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $property_name_filter    = isset($param['property_name_filter']) ? $param['property_name_filter'] : '';
        $payment_type_filter     = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';

        $this->db
            ->select('pps.property_payment_scheduler_id, pps.payment_type, pps.total_amount, pps.discounted_total,
                      pps.max_emi_count, pps.property_reservation_id_fk,
                      (CASE WHEN pps.discounted_total > 0 THEN pps.discounted_total ELSE pps.total_amount END) as net_total,
                      p.properties_name,
                      q.quotation_number,
                      l.guest_name,
                      COALESCE(SUM(i.paid_amount), 0) as total_paid,
                      ((CASE WHEN pps.discounted_total > 0 THEN pps.discounted_total ELSE pps.total_amount END) - COALESCE(SUM(i.paid_amount), 0)) as pending_amount')
            ->from($this->table_payment . ' pps')
            ->join($this->table . ' pr', 'pr.property_reservation_id = pps.property_reservation_id_fk', 'left')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = pps.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->join($this->table_installments . ' i', 'i.property_payment_scheduler_id_fk = pps.property_payment_scheduler_id AND i.installment_status = 1', 'left')
            ->where('pps.property_payment_scheduler_status', 1);

        if ($quotation_number_filter) {
            $this->db->like('q.quotation_number', $quotation_number_filter);
        }
        if ($guest_name_filter) {
            $this->db->like('l.guest_name', $guest_name_filter);
        }
        if ($property_name_filter) {
            $this->db->like('p.properties_name', $property_name_filter);
        }
        if ($payment_type_filter) {
            $this->db->where('pps.payment_type', $payment_type_filter);
        }

        $this->db->group_by('pps.property_payment_scheduler_id');
        $this->db->order_by('pps.property_payment_scheduler_id', 'DESC');

        if ($param['length'] != -1 && $param['start'] != 'false' && $param['length'] != 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPropertySchedulerReportTotalCount($param);
        $data['recordsFiltered'] = $this->getPropertySchedulerReportTotalCount($param);
        return $data;
    }

    public function getPropertySchedulerReportTotalCount($param = NULL)
    {
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name_filter       = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $property_name_filter    = isset($param['property_name_filter']) ? $param['property_name_filter'] : '';
        $payment_type_filter     = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';

        $this->db
            ->from($this->table_payment . ' pps')
            ->join($this->table . ' pr', 'pr.property_reservation_id = pps.property_reservation_id_fk', 'left')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = pps.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('pps.property_payment_scheduler_status', 1);

        if ($quotation_number_filter) {
            $this->db->like('q.quotation_number', $quotation_number_filter);
        }
        if ($guest_name_filter) {
            $this->db->like('l.guest_name', $guest_name_filter);
        }
        if ($property_name_filter) {
            $this->db->like('p.properties_name', $property_name_filter);
        }
        if ($payment_type_filter) {
            $this->db->where('pps.payment_type', $payment_type_filter);
        }

        return $this->db->count_all_results();
    }

    public function getPropertyPaymentsReportTable($param)
    {
        $start_date  = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date    = isset($param['end_date']) ? $param['end_date'] : '';
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name_filter = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $property_name_filter = isset($param['property_name_filter']) ? $param['property_name_filter'] : '';
        $payment_type_filter = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';
        $installment_number_filter = isset($param['installment_number_filter']) ? $param['installment_number_filter'] : '';
        $status_filter = isset($param['status_filter']) ? $param['status_filter'] : '';

        $this->db
            ->select('i.installment_id, i.installment_number, i.calculated_amount, i.due_date, i.payment_status, i.paid_amount, i.paid_date, i.payment_reference, i.payment_method,
                      pps.property_payment_scheduler_id, pps.payment_type, pps.total_amount, pps.discounted_total,
                      pr.property_reservation_id, pr.quotation_id_fk, pr.properties_id_fk,
                      p.properties_name,
                      q.quotation_number,
                      l.guest_name')
            ->from($this->table_installments . ' i')
            ->join($this->table_payment . ' pps', 'pps.property_payment_scheduler_id = i.property_payment_scheduler_id_fk', 'left')
            ->join($this->table . ' pr', 'pr.property_reservation_id = pps.property_reservation_id_fk', 'left')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = pr.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('i.installment_status', 1);

        $this->_applyPropertyPaymentsReportFilters($start_date, $end_date, $quotation_number_filter, $guest_name_filter, $property_name_filter, $payment_type_filter, $installment_number_filter, $status_filter);

        $this->db->order_by('i.due_date', 'DESC');

        if ($param['length'] != -1 && $param['start'] != 'false' && $param['length'] != 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();
        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPropertyPaymentsReportTotalCount($param);
        $data['recordsFiltered'] = $this->getPropertyPaymentsReportTotalCount($param);
        return $data;
    }

    public function getPropertyPaymentsReportTotalCount($param = NULL)
    {
        $start_date  = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date    = isset($param['end_date']) ? $param['end_date'] : '';
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name_filter = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $property_name_filter = isset($param['property_name_filter']) ? $param['property_name_filter'] : '';
        $payment_type_filter = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';
        $installment_number_filter = isset($param['installment_number_filter']) ? $param['installment_number_filter'] : '';
        $status_filter = isset($param['status_filter']) ? $param['status_filter'] : '';

        $this->db
            ->from($this->table_installments . ' i')
            ->join($this->table_payment . ' pps', 'pps.property_payment_scheduler_id = i.property_payment_scheduler_id_fk', 'left')
            ->join($this->table . ' pr', 'pr.property_reservation_id = pps.property_reservation_id_fk', 'left')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = pr.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('i.installment_status', 1);

        $this->_applyPropertyPaymentsReportFilters($start_date, $end_date, $quotation_number_filter, $guest_name_filter, $property_name_filter, $payment_type_filter, $installment_number_filter, $status_filter);

        return $this->db->get()->num_rows();
    }

    private function _applyPropertyPaymentsReportFilters($start_date, $end_date, $quotation_number_filter, $guest_name_filter, $property_name_filter, $payment_type_filter, $installment_number_filter, $status_filter)
    {
        if ($start_date) {
            $this->db->where('i.due_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('i.due_date <=', $end_date);
        }
        if ($quotation_number_filter) {
            $this->db->like('q.quotation_number', $quotation_number_filter);
        }
        if ($guest_name_filter) {
            $this->db->like('l.guest_name', $guest_name_filter);
        }
        if ($property_name_filter) {
            $this->db->like('p.properties_name', $property_name_filter);
        }
        if ($payment_type_filter) {
            $this->db->where('pps.payment_type', $payment_type_filter);
        }
        if ($installment_number_filter !== '' && $installment_number_filter !== null) {
            $this->db->where('i.installment_number', (int)$installment_number_filter);
        }
        if ($status_filter) {
            $this->db->where('i.payment_status', $status_filter);
        }
    }
}
?>
