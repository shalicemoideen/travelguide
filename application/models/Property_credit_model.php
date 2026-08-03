<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

/**
 * Property Credit Ledger
 *
 * Tracks credits that a property holds on our behalf when a cancellation
 * refund is taken as future-booking credit instead of cash.
 *
 * Ledger amounts (used_amount, remaining_amount) are recomputed from
 * property_credit_application inside the same transaction as the
 * application or reversal — they are never trusted from the client.
 */
class Property_credit_model extends CI_Model {

    var $table_ledger      = 'property_credit_ledger';
    var $table_application = 'property_credit_application';

    public function __construct()
    {
        parent::__construct();
    }

    // =====================================================
    // LEDGER
    // =====================================================

    /**
     * Available credits for a property, oldest first.
     * Returns rows with status AVAILABLE or PARTIALLY_USED.
     */
    public function get_available_credits($properties_id)
    {
        return $this->db
            ->select('pcl.*, bc.cancellation_number,
                      q.quotation_number AS original_booking_number,
                      p.properties_name')
            ->from($this->table_ledger . ' pcl')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('quotation q',
                   'q.quotation_id = pcl.quotation_id_fk', 'left')
            ->join('properties p',
                   'p.properties_id = pcl.properties_id_fk', 'left')
            ->where('pcl.properties_id_fk', (int)$properties_id)
            ->where('pcl.property_credit_status', 1)
            ->where_in('pcl.credit_status', array('AVAILABLE', 'PARTIALLY_USED'))
            ->order_by('pcl.created_datetime', 'ASC')
            ->order_by('pcl.property_credit_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_credit($credit_id)
    {
        return $this->db
            ->select('pcl.*, bc.cancellation_number,
                      q.quotation_number AS original_booking_number,
                      p.properties_name')
            ->from($this->table_ledger . ' pcl')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('quotation q',
                   'q.quotation_id = pcl.quotation_id_fk', 'left')
            ->join('properties p',
                   'p.properties_id = pcl.properties_id_fk', 'left')
            ->where('pcl.property_credit_id', (int)$credit_id)
            ->where('pcl.property_credit_status', 1)
            ->get()
            ->row();
    }

    public function get_credits_for_cancellation($cancellation_id)
    {
        return $this->db
            ->select('pcl.*, bc.cancellation_number,
                      q.quotation_number AS original_booking_number')
            ->from($this->table_ledger . ' pcl')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('quotation q',
                   'q.quotation_id = pcl.quotation_id_fk', 'left')
            ->where('pcl.booking_cancellation_id_fk', (int)$cancellation_id)
            ->where('pcl.property_credit_status', 1)
            ->order_by('pcl.property_credit_id', 'ASC')
            ->get()
            ->result();
    }

    public function create_credit($data)
    {
        $this->db->insert($this->table_ledger, $data);
        return $this->db->insert_id();
    }

    public function update_credit($credit_id, $data)
    {
        $this->db->where('property_credit_id', (int)$credit_id);
        $this->db->update($this->table_ledger, $data);
        return $this->db->affected_rows();
    }

    /**
     * Recompute used_amount, remaining_amount and credit_status
     * from the non-reversed application rows.
     */
    public function recalculate_credit($credit_id)
    {
        $credit_id = (int)$credit_id;

        $row = $this->db
            ->select('COALESCE(SUM(applied_amount), 0) AS used', FALSE)
            ->from($this->table_application)
            ->where('property_credit_id_fk', $credit_id)
            ->where('reversed', 0)
            ->where('credit_application_status', 1)
            ->get()
            ->row();

        $used      = $row ? (float)$row->used : 0.0;
        $credit    = $this->get_credit($credit_id);
        $remaining = $credit ? round((float)$credit->credit_amount - $used, 2) : 0.0;

        if ($remaining <= 0.009) {
            $status = 'FULLY_UTILIZED';
        } elseif ($used > 0.009) {
            $status = 'PARTIALLY_USED';
        } else {
            $status = 'AVAILABLE';
        }

        $this->update_credit($credit_id, array(
            'used_amount'      => round($used, 2),
            'remaining_amount' => round(max(0, $remaining), 2),
            'credit_status'    => $status,
        ));

        return array(
            'used_amount'      => round($used, 2),
            'remaining_amount' => round(max(0, $remaining), 2),
            'credit_status'    => $status,
        );
    }

    // =====================================================
    // APPLICATIONS
    // =====================================================

    public function get_application($application_id)
    {
        return $this->db
            ->select('pca.*, pcl.credit_amount, pcl.remaining_amount,
                      pcl.credit_status, pcl.properties_id_fk,
                      p.properties_name,
                      q.quotation_number AS consuming_booking_number')
            ->from($this->table_application . ' pca')
            ->join($this->table_ledger . ' pcl',
                   'pcl.property_credit_id = pca.property_credit_id_fk', 'inner')
            ->join('properties p',
                   'p.properties_id = pca.properties_id_fk', 'left')
            ->join('quotation q',
                   'q.quotation_id = pca.quotation_id_fk', 'left')
            ->where('pca.credit_application_id', (int)$application_id)
            ->where('pca.credit_application_status', 1)
            ->get()
            ->row();
    }

    public function get_applications_for_credit($credit_id)
    {
        return $this->db
            ->select('pca.*, q.quotation_number AS consuming_booking_number')
            ->from($this->table_application . ' pca')
            ->join('quotation q',
                   'q.quotation_id = pca.quotation_id_fk', 'left')
            ->where('pca.property_credit_id_fk', (int)$credit_id)
            ->where('pca.credit_application_status', 1)
            ->order_by('pca.applied_datetime', 'ASC')
            ->get()
            ->result();
    }

    public function get_applications_for_quotation($quotation_id)
    {
        return $this->db
            ->select('pca.*, pcl.credit_amount, pcl.credit_status,
                      pcl.booking_cancellation_id_fk,
                      bc.cancellation_number,
                      p.properties_name')
            ->from($this->table_application . ' pca')
            ->join($this->table_ledger . ' pcl',
                   'pcl.property_credit_id = pca.property_credit_id_fk', 'inner')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('properties p',
                   'p.properties_id = pca.properties_id_fk', 'left')
            ->where('pca.quotation_id_fk', (int)$quotation_id)
            ->where('pca.reversed', 0)
            ->where('pca.credit_application_status', 1)
            ->order_by('pca.applied_datetime', 'ASC')
            ->get()
            ->result();
    }

    /**
     * Applications for a quotation scoped to a single property. Used so a
     * property reservation modal only shows the credit applied to that
     * property, not every property in the booking.
     */
    public function get_applications_for_property($quotation_id, $properties_id)
    {
        return $this->db
            ->select('pca.*, pcl.credit_amount, pcl.credit_status,
                      pcl.booking_cancellation_id_fk,
                      bc.cancellation_number,
                      p.properties_name')
            ->from($this->table_application . ' pca')
            ->join($this->table_ledger . ' pcl',
                   'pcl.property_credit_id = pca.property_credit_id_fk', 'inner')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('properties p',
                   'p.properties_id = pca.properties_id_fk', 'left')
            ->where('pca.quotation_id_fk', (int)$quotation_id)
            ->where('pca.properties_id_fk', (int)$properties_id)
            ->where('pca.reversed', 0)
            ->where('pca.credit_application_status', 1)
            ->order_by('pca.applied_datetime', 'ASC')
            ->get()
            ->result();
    }

    public function insert_application($data)
    {
        $this->db->insert($this->table_application, $data);
        return $this->db->insert_id();
    }

    public function sum_applications_for_quotation($quotation_id)
    {
        $row = $this->db
            ->select('COALESCE(SUM(applied_amount), 0) AS total', FALSE)
            ->from($this->table_application)
            ->where('quotation_id_fk', (int)$quotation_id)
            ->where('reversed', 0)
            ->where('credit_application_status', 1)
            ->get()
            ->row();

        return $row ? (float)$row->total : 0.0;
    }

    // =====================================================
    // HISTORY & SUMMARY
    // =====================================================

    public function get_credit_history($properties_id)
    {
        return $this->db
            ->select('pcl.*, bc.cancellation_number,
                      q.quotation_number AS original_booking_number,
                      p.properties_name')
            ->from($this->table_ledger . ' pcl')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('quotation q',
                   'q.quotation_id = pcl.quotation_id_fk', 'left')
            ->join('properties p',
                   'p.properties_id = pcl.properties_id_fk', 'left')
            ->where('pcl.properties_id_fk', (int)$properties_id)
            ->where('pcl.property_credit_status', 1)
            ->order_by('pcl.created_datetime', 'DESC')
            ->get()
            ->result();
    }

    public function get_credit_summary($properties_id)
    {
        $row = $this->db
            ->select('COALESCE(SUM(credit_amount), 0) AS total_credit,
                      COALESCE(SUM(used_amount), 0) AS total_used,
                      COALESCE(SUM(remaining_amount), 0) AS total_remaining,
                      COALESCE(SUM(CASE WHEN credit_status = "AVAILABLE" THEN remaining_amount ELSE 0 END), 0) AS available,
                      COALESCE(SUM(CASE WHEN credit_status = "PARTIALLY_USED" THEN remaining_amount ELSE 0 END), 0) AS partially_used_remaining,
                      COALESCE(SUM(CASE WHEN credit_status = "FULLY_UTILIZED" THEN credit_amount ELSE 0 END), 0) AS fully_used,
                      COALESCE(SUM(CASE WHEN credit_status = "EXPIRED" THEN remaining_amount ELSE 0 END), 0) AS expired_remaining', FALSE)
            ->from($this->table_ledger)
            ->where('properties_id_fk', (int)$properties_id)
            ->where('property_credit_status', 1)
            ->get()
            ->row();

        return array(
            'total_credit'             => $row ? (float)$row->total_credit : 0.0,
            'total_used'               => $row ? (float)$row->total_used : 0.0,
            'total_remaining'          => $row ? (float)$row->total_remaining : 0.0,
            'available'                => $row ? (float)$row->available : 0.0,
            'partially_used_remaining' => $row ? (float)$row->partially_used_remaining : 0.0,
            'fully_used'               => $row ? (float)$row->fully_used : 0.0,
            'expired_remaining'        => $row ? (float)$row->expired_remaining : 0.0,
        );
    }

    // =====================================================
    // DATATABLES: credit report
    // =====================================================

    private function _apply_report_filters($param)
    {
        $property_filter = isset($param['property_filter']) ? $param['property_filter'] : '';
        $status_filter   = isset($param['credit_status_filter']) ? $param['credit_status_filter'] : '';
        $start_date      = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date        = isset($param['end_date']) ? $param['end_date'] : '';
        $expiring_days   = isset($param['expiring_days']) ? $param['expiring_days'] : '';
        $search_value    = isset($param['searchValue']) ? $param['searchValue'] : '';

        $this->db->where('pcl.property_credit_status', 1);

        if ($property_filter) { $this->db->where('pcl.properties_id_fk', (int)$property_filter); }
        if ($status_filter)   { $this->db->where('pcl.credit_status', $status_filter); }
        if ($start_date)      { $this->db->where('pcl.created_datetime >=', $start_date); }
        if ($end_date)        { $this->db->where('pcl.created_datetime <=', $end_date . ' 23:59:59'); }

        if ($expiring_days !== '') {
            $this->db->where('pcl.expiry_date IS NOT NULL', NULL, FALSE);
            $this->db->where('pcl.credit_status IN ("AVAILABLE","PARTIALLY_USED")', NULL, FALSE);
            $this->db->where("DATEDIFF(pcl.expiry_date, CURDATE()) <= " . (int)$expiring_days, NULL, FALSE);
            $this->db->where('pcl.expiry_date >= CURDATE()', NULL, FALSE);
        }

        if ($search_value) {
            $this->db->group_start()
                ->like('p.properties_name', $search_value)
                ->or_like('bc.cancellation_number', $search_value)
                ->or_like('q.quotation_number', $search_value)
                ->or_like('pcl.reference_number', $search_value)
                ->group_end();
        }
    }

    public function getCreditTable($param)
    {
        $this->db
            ->select('pcl.*, p.properties_name,
                      bc.cancellation_number,
                      q.quotation_number AS original_booking_number,
                      DATEDIFF(CURDATE(), pcl.created_datetime) AS age_days', FALSE)
            ->from($this->table_ledger . ' pcl')
            ->join('properties p', 'p.properties_id = pcl.properties_id_fk', 'left')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = pcl.quotation_id_fk', 'left');

        $this->_apply_report_filters($param);

        $this->db->order_by('pcl.property_credit_id', 'DESC');

        if ($param['length'] != -1 && $param['start'] !== 'false' && $param['length'] !== 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();
        $total = $this->getCreditTotalCount($param);

        return array(
            'data'            => $query->result(),
            'recordsTotal'    => $total,
            'recordsFiltered' => $total,
        );
    }

    public function getCreditTotalCount($param)
    {
        $this->db
            ->select('pcl.property_credit_id')
            ->from($this->table_ledger . ' pcl')
            ->join('properties p', 'p.properties_id = pcl.properties_id_fk', 'left')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = pcl.quotation_id_fk', 'left');

        $this->_apply_report_filters($param);

        return $this->db->get()->num_rows();
    }

    public function get_report_totals($param)
    {
        $this->db
            ->select('COALESCE(SUM(credit_amount), 0) AS total_credit,
                      COALESCE(SUM(used_amount), 0) AS total_used,
                      COALESCE(SUM(remaining_amount), 0) AS total_remaining', FALSE)
            ->from($this->table_ledger . ' pcl')
            ->join('properties p', 'p.properties_id = pcl.properties_id_fk', 'left')
            ->join('booking_cancellation bc',
                   'bc.booking_cancellation_id = pcl.booking_cancellation_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = pcl.quotation_id_fk', 'left');

        $this->_apply_report_filters($param);

        $row = $this->db->get()->row();

        return array(
            'total_credit'    => $row ? (float)$row->total_credit : 0.0,
            'total_used'      => $row ? (float)$row->total_used : 0.0,
            'total_remaining' => $row ? (float)$row->total_remaining : 0.0,
        );
    }

    // =====================================================
    // PROPERTIES WITH CREDITS (for dropdowns)
    // =====================================================

    public function get_properties_with_credits()
    {
        return $this->db
            ->select('DISTINCT pcl.properties_id_fk, p.properties_name', FALSE)
            ->from($this->table_ledger . ' pcl')
            ->join('properties p', 'p.properties_id = pcl.properties_id_fk', 'left')
            ->where('pcl.property_credit_status', 1)
            ->where_in('pcl.credit_status', array('AVAILABLE', 'PARTIALLY_USED'))
            ->order_by('p.properties_name', 'ASC')
            ->get()
            ->result();
    }
}
