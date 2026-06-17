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
        $rows = $this->db
            ->select('pr.*, p.properties_name')
            ->from('property_reservation pr')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->where('pr.quotation_id_fk', (int)$quotation_id)
            ->where('pr.property_reservation_status', 1)
            ->order_by('pr.property_reservation_id', 'ASC')
            ->get()
            ->result();

        $total       = count($rows);
        $blocked     = 0;
        $confirmed   = 0;
        $reconfirmed = 0;

        foreach ($rows as $r) {
            if ($r->blocking_status === 'BLOCKED')          { $blocked++; }
            if ($r->confirmation_status === 'CONFIRMED')    { $confirmed++; }
            if ($r->reconfirmation_status === 'RECONFIRMED'){ $reconfirmed++; }
        }

        return array(
            'rows'        => $rows,
            'total'       => $total,
            'blocked'     => $blocked,
            'confirmed'   => $confirmed,
            'reconfirmed' => $reconfirmed,
        );
    }
}
?>
