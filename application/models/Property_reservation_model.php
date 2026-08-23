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

    /**
     * The live reservation for a property on a booking.
     *
     * CANCELLED rows are skipped: once a reservation has been cancelled and
     * credited, it is closed history. If the client later swaps that property
     * back in, the caller creates a fresh reservation rather than reopening a
     * settled one — the cancelled row stays visible in the superseded list.
     */
    public function get_reservation($quotation_id, $properties_id)
    {
        return $this->db
            ->from($this->table)
            ->where('quotation_id_fk', (int)$quotation_id)
            ->where('properties_id_fk', (int)$properties_id)
            ->where('property_reservation_status', 1)
            ->where('reservation_state !=', 'CANCELLED')
            ->order_by('property_reservation_id', 'DESC')
            ->limit(1)
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
    // PROPERTY CHANGE: supersede / restore / cancel
    // =========================================================

    /**
     * Total already paid to a property across every installment of its
     * scheduler. Reads the installment roll-up rather than the append-only
     * payment rows so it matches what the reservation view displays.
     */
    public function get_paid_total($property_reservation_id)
    {
        $payment = $this->get_payment_by_reservation($property_reservation_id);
        if (!$payment) { return 0.0; }

        $row = $this->db
            ->select('COALESCE(SUM(paid_amount), 0) AS paid', FALSE)
            ->from($this->table_installments)
            ->where('property_payment_scheduler_id_fk', (int)$payment->property_payment_scheduler_id)
            ->where('installment_status', 1)
            ->get()
            ->row();

        return $row ? (float)$row->paid : 0.0;
    }

    /**
     * Mark a reservation as superseded because the client swapped this
     * property out on the confirmation page.
     *
     * The amounts must be snapshotted here: they are derived from
     * quotation_confirmation rows that the caller is about to deactivate,
     * after which get_property_total_amount() would return 0.
     *
     * Idempotent — a reservation that is already SUPERSEDED or CANCELLED is
     * left untouched so repeated saves never overwrite the original snapshot.
     */
    public function supersede_reservation($reservation, $quotation_id, $replaced_by_properties_id = null)
    {
        if (!$reservation || $reservation->reservation_state !== 'ACTIVE') {
            return false;
        }

        $reservation_id = (int)$reservation->property_reservation_id;

        return $this->update_reservation($reservation_id, array(
            'reservation_state'              => 'SUPERSEDED',
            'snap_reservation_amount'        => round($this->get_property_total_amount(
                                                    $quotation_id,
                                                    (int)$reservation->properties_id_fk
                                                ), 2),
            'snap_paid_amount'               => round($this->get_paid_total($reservation_id), 2),
            'superseded_by_properties_id_fk' => $replaced_by_properties_id > 0 ? (int)$replaced_by_properties_id : null,
            'superseded_datetime'            => date('Y-m-d H:i:s'),
        ));
    }

    /**
     * The client swapped a previously dropped property back in. Only a
     * SUPERSEDED reservation is revived — once CANCELLED, a credit has been
     * issued against it and the row must stay closed.
     */
    public function restore_reservation($reservation)
    {
        if (!$reservation || $reservation->reservation_state !== 'SUPERSEDED') {
            return false;
        }

        return $this->update_reservation($reservation->property_reservation_id, array(
            'reservation_state'              => 'ACTIVE',
            'snap_reservation_amount'        => null,
            'snap_paid_amount'               => null,
            'superseded_by_properties_id_fk' => null,
            'superseded_datetime'            => null,
        ));
    }

    // =========================================================
    // PROPERTY SCHEDULER SYNC
    // =========================================================

    /**
     * Realign every active property payment scheduler on a booking with the
     * current property amount.
     *
     * The supplier schedule stores its total as a snapshot taken when Level 2
     * confirmation was saved, so a later reschedule or room change left the
     * scheduler, its installments and the derived pending figure showing the
     * old amount. This is the property-side counterpart of
     * Receipt_scheduler_model::sync_total_amount().
     *
     * SUPERSEDED and CANCELLED reservations are skipped — their amounts are
     * historical snapshots and must not move.
     *
     * @return array one entry per scheduler that actually changed
     */
    public function sync_property_scheduler_totals($quotation_id)
    {
        $quotation_id = (int)$quotation_id;

        $reservations = $this->db
            ->from($this->table)
            ->where('quotation_id_fk', $quotation_id)
            ->where('property_reservation_status', 1)
            ->where('reservation_state', 'ACTIVE')
            ->get()
            ->result();

        $changed = array();

        foreach ($reservations as $reservation) {
            $payment = $this->get_payment_by_reservation($reservation->property_reservation_id);
            if (!$payment) { continue; }

            $new_total = round(
                $this->get_property_total_amount($quotation_id, (int)$reservation->properties_id_fk), 2
            );

            // A zero total means the confirmed rooms could not be resolved.
            // Never wipe a real schedule on the strength of that.
            if ($new_total <= 0) { continue; }

            if (abs($new_total - (float)$payment->total_amount) < 0.01) { continue; }

            // If the user had manually entered a net payable (discounted_total)
            // that differs from the old total_amount, preserve it; only update
            // discounted_total when it was equal to the old total (no manual discount).
            $old_total = (float)$payment->total_amount;
            $old_discounted = (float)$payment->discounted_total;
            if (abs($old_discounted - $old_total) > 0.01) {
                // User had entered a manual net payable — keep it.
                $new_discounted = $old_discounted;
            } else {
                $new_discounted = round($new_total, 2);
            }

            $this->update_payment($payment->property_payment_scheduler_id, array(
                'total_amount'     => $new_total,
                'discounted_total' => $new_discounted,
            ));

            $this->_redistribute_installments($payment, $new_discounted);

            $changed[] = array(
                'property_reservation_id' => (int)$reservation->property_reservation_id,
                'properties_id'           => (int)$reservation->properties_id_fk,
                'old_total'               => (float)$payment->total_amount,
                'new_total'               => $new_total,
            );
        }

        return $changed;
    }

    /**
     * Spread a revised net total across a scheduler's active installments.
     *
     * Rules:
     *   * An installment is never reduced below what has already been paid.
     *   * Installments that carry a payment keep their current amount, so
     *     settled history is not rewritten.
     *   * The difference is spread proportionally across the fully unpaid
     *     installments; if there are none (e.g. a FULL payment whose single
     *     installment is partly paid), the last installment absorbs it.
     */
    private function _redistribute_installments($payment, $new_net_total)
    {
        $installments = $this->get_installments($payment->property_payment_scheduler_id);
        if (empty($installments)) { return; }

        $unpaid   = array();
        $reserved = 0.0;

        foreach ($installments as $inst) {
            if ((float)$inst->paid_amount > 0) {
                $reserved += (float)$inst->calculated_amount;
            } else {
                $unpaid[] = $inst;
            }
        }

        if (!empty($unpaid)) {
            $remaining   = max(0, $new_net_total - $reserved);
            $unpaid_base = 0.0;
            foreach ($unpaid as $inst) { $unpaid_base += (float)$inst->calculated_amount; }

            $count   = count($unpaid);
            $running = 0.0;

            for ($i = 0; $i < $count; $i++) {
                $inst = $unpaid[$i];

                if ($i < $count - 1) {
                    $share = $unpaid_base > 0
                        ? round($remaining * ((float)$inst->calculated_amount / $unpaid_base), 2)
                        : round($remaining / $count, 2);
                    $running += $share;
                } else {
                    // Last unpaid installment absorbs any rounding remainder.
                    $share = round($remaining - $running, 2);
                }

                $this->_write_installment_amount($inst, $share, $payment, $new_net_total);
            }

            return;
        }

        /* Every installment carries a payment — typically a FULL schedule with
           one partly-paid row. Put the whole revised total on the last one,
           floored at what has already been paid. */
        $last     = $installments[count($installments) - 1];
        $others   = 0.0;
        for ($i = 0; $i < count($installments) - 1; $i++) {
            $others += (float)$installments[$i]->calculated_amount;
        }

        $this->_write_installment_amount($last, $new_net_total - $others, $payment, $new_net_total);
    }

    /**
     * Write a recalculated amount onto an installment, never dropping below
     * the amount already paid, and refresh its payment status.
     */
    private function _write_installment_amount($installment, $amount, $payment, $new_net_total)
    {
        $paid   = (float)$installment->paid_amount;
        $amount = round(max($amount, $paid), 2);

        if ($paid <= 0) {
            $status = 'PENDING';
        } elseif ($paid >= $amount) {
            $status = 'PAID';
        } else {
            $status = 'PARTIAL';
        }

        $update = array(
            'installment_amount' => $amount,
            'calculated_amount'  => $amount,
            'payment_status'     => $status,
        );

        // Keep the percentage meaningful when the schedule splits by percentage.
        if ($payment->payment_type == 'EMI' && $payment->split_type == 'PERCENTAGE' && $new_net_total > 0) {
            $update['installment_percentage'] = round(($amount / $new_net_total) * 100, 2);
        }

        $this->update_installment($installment->installment_id, $update);
    }

    /**
     * Reservations retained for audit after a property change: the ones the
     * Property Reservation page must keep showing with a cancel action.
     */
    public function get_superseded_reservations($quotation_id)
    {
        $rows = $this->db
            ->select('pr.*, p.properties_name, np.properties_name AS superseded_by_property_name')
            ->from('property_reservation pr')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->join('properties np', 'np.properties_id = pr.superseded_by_properties_id_fk', 'left')
            ->where('pr.quotation_id_fk', (int)$quotation_id)
            ->where('pr.property_reservation_status', 1)
            ->where_in('pr.reservation_state', array('SUPERSEDED', 'CANCELLED'))
            ->order_by('pr.check_in_date', 'ASC')
            ->get()
            ->result();

        foreach ($rows as $r) {
            // Snapshots are written when the property is superseded; fall back
            // to the live figures for rows predating this migration.
            if ($r->snap_reservation_amount === null) {
                $r->snap_reservation_amount = $this->get_property_total_amount(
                    $quotation_id, (int)$r->properties_id_fk
                );
            }
            if ($r->snap_paid_amount === null) {
                $r->snap_paid_amount = $this->get_paid_total($r->property_reservation_id);
            }

            /* Every replaced property is listed so the change history stays
               visible, but cancellation only applies where money was actually
               paid — otherwise the hotel holds nothing and there is no credit
               to raise. The UI uses this to decide whether to offer the action. */
            $r->is_cancellable = ((float)$r->snap_paid_amount > 0);
        }

        return $rows;
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

    /**
     * Per-day property rent breakdown for the confirmed rooms of a property.
     * Mirrors the joins in get_property_total_amount, grouped by day.
     */
    public function get_property_rent_breakdown($quotation_id, $properties_id)
    {
        return $this->db
            ->select('qpd.quotation_properties_days_id,
                      qpd.quotation_properties_days_day AS day_label,
                      ap.accommodation_date,
                      SUM(qrtd.manual_total_rate) AS day_rent')
            ->from('quotation_confirmation qc')
            ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')
            ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')
            ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')
            ->join('quotation_properties_rooms qpr', 'qpr.quotation_properties_rooms_id = qc.properties_room_id_fk', 'inner')
            ->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id', 'left')
            ->where('qc.quotation_id_fk', (int)$quotation_id)
            ->where('qc.property_confirmation_status', 1)
            ->where('qp.properties_id_fk', (int)$properties_id)
            ->where('qp.quotation_properties_status', 1)
            ->where('qpr.quotation_properties_rooms_status', 1)
            ->group_by('qpd.quotation_properties_days_id')
            ->order_by('ap.accommodation_date', 'ASC')
            ->get()
            ->result();
    }

    /**
     * Property-based inclusions (name + amount + date) for the confirmed
     * option(s) of a property.
     */
    public function get_property_inclusions_detail($quotation_id, $properties_id)
    {
        $opts = $this->db
            ->distinct()
            ->select('qc.option_id_fk')
            ->from('quotation_confirmation qc')
            ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')
            ->where('qc.quotation_id_fk', (int)$quotation_id)
            ->where('qc.property_confirmation_status', 1)
            ->where('qp.properties_id_fk', (int)$properties_id)
            ->get()
            ->result();

        $option_ids = array();
        foreach ($opts as $o) { $option_ids[] = (int)$o->option_id_fk; }

        $this->db
            ->select('qpi.inclusion_name, qpi.inclusion_amount, qpi.accommodation_date')
            ->from('quotation_property_inclusions qpi')
            ->where('qpi.quotation_id_fk', (int)$quotation_id)
            ->where('qpi.inclusion_property_id_fk', (int)$properties_id)
            ->where('qpi.quotation_property_inclusions_status', 1);

        if (!empty($option_ids)) {
            $this->db->where_in('qpi.quotation_options_id_fk', $option_ids);
        }

        return $this->db
            ->order_by('qpi.accommodation_date', 'ASC')
            ->get()
            ->result();
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
                pr.reconfirmation_status,
                pps.discounted_total,
                pps.total_amount AS scheduler_total_amount
            ')
            ->from('quotation_confirmation qc')
            ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')
            ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')
            ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')
            ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')
            ->join('property_reservation pr', 'pr.quotation_id_fk = qc.quotation_id_fk AND pr.properties_id_fk = qp.properties_id_fk AND pr.property_reservation_status = 1', 'left')
            ->join('property_payment_scheduler pps', 'pps.property_reservation_id_fk = pr.property_reservation_id AND pps.property_payment_scheduler_status = 1', 'left')
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
            $r->property_total = $this->get_property_total_amount($quotation_id, $r->properties_id);
            $r->net_payable = (float)$r->discounted_total;
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
        $travel_date_start       = isset($param['travel_date_start']) ? $param['travel_date_start'] : '';
        $travel_date_end         = isset($param['travel_date_end']) ? $param['travel_date_end'] : '';

        $this->db
            ->select('pps.property_payment_scheduler_id, pps.payment_type, pps.total_amount, pps.discounted_total,
                      pps.max_emi_count, pps.property_reservation_id_fk,
                      (CASE WHEN pps.discounted_total > 0 THEN pps.discounted_total ELSE pps.total_amount END) as net_total,
                      p.properties_name,
                      q.quotation_number,
                      l.guest_name,
                      l.start_date,
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
        if ($travel_date_start) {
            $this->db->where('l.start_date >=', $travel_date_start);
        }
        if ($travel_date_end) {
            $this->db->where('l.start_date <=', $travel_date_end);
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
        $travel_date_start       = isset($param['travel_date_start']) ? $param['travel_date_start'] : '';
        $travel_date_end         = isset($param['travel_date_end']) ? $param['travel_date_end'] : '';

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
        if ($travel_date_start) {
            $this->db->where('l.start_date >=', $travel_date_start);
        }
        if ($travel_date_end) {
            $this->db->where('l.start_date <=', $travel_date_end);
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
