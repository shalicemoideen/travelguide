<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Receipt_scheduler_model extends CI_Model {
    
    var $table = 'receipt_scheduler';
    var $table_installments = 'receipt_scheduler_installments';
    var $table_payments = 'receipt_scheduler_payments';

    public function __construct()
    {
        parent::__construct();
    }

    // =========================================
    // RECEIPT SCHEDULER CRUD
    // =========================================

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_by_id($id)
    {
        return $this->db
            ->select('rs.*, q.quotation_number, q.quotation_id, l.guest_name, l.leads_number, l.whats_number')
            ->from('receipt_scheduler rs')
            ->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('rs.receipt_scheduler_id', $id)
            ->where('rs.receipt_scheduler_status', 1)
            ->get()
            ->row();
    }

    public function get_by_quotation_id($quotation_id)
    {
        return $this->db
            ->from($this->table)
            ->where('quotation_id_fk', $quotation_id)
            ->where('receipt_scheduler_status', 1)
            ->get()
            ->row();
    }

    public function delete_by_id($id)
    {
        $this->db->where('receipt_scheduler_id', $id);
        $this->db->update($this->table, array('receipt_scheduler_status' => 0));
        return $this->db->affected_rows();
    }

    // =========================================
    // DATATABLE LISTING
    // =========================================

    public function getReceiptSchedulerTable($param)
    {
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $payment_type_filter = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';
        $payment_status_filter = isset($param['payment_status_filter']) ? $param['payment_status_filter'] : '';
        $start_date = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date = isset($param['end_date']) ? $param['end_date'] : '';
        $quotation_id_filter = isset($param['quotation_id_filter']) ? $param['quotation_id_filter'] : '';

        if ($quotation_id_filter) {
            $this->db->where('rs.quotation_id_fk', $quotation_id_filter);
        }
        if ($quotation_number_filter) {
            $this->db->like('q.quotation_number', $quotation_number_filter);
        }
        if ($payment_type_filter) {
            $this->db->where('rs.payment_type', $payment_type_filter);
        }
        if ($start_date) {
            $this->db->where('rs.receipt_scheduler_created_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('rs.receipt_scheduler_created_date <=', $end_date);
        }

        $this->db->where('q.quotation_current_status !=', 6);
        $this->db->where('rs.receipt_scheduler_status', 1);

        if ($param['length'] != -1 && $param['start'] != 'false' && $param['length'] != 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $this->db->select('rs.*, q.quotation_number, l.guest_name, l.leads_number,
                          DATE_FORMAT(rs.receipt_scheduler_created_date, \'%d-%m-%Y\') as created_date_formatted,
                          (SELECT COUNT(*) FROM receipt_scheduler_payments p WHERE p.receipt_scheduler_id_fk = rs.receipt_scheduler_id AND p.payment_status = 1) as has_payments');
        $this->db->from('receipt_scheduler rs');
        $this->db->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left');
        $this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'left');
        $this->db->order_by('rs.receipt_scheduler_id', 'DESC');

        $query = $this->db->get();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getReceiptSchedulerTotalCount($param);
        $data['recordsFiltered'] = $this->getReceiptSchedulerTotalCount($param);
        return $data;
    }

    public function getReceiptSchedulerTotalCount($param = NULL)
    {
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $payment_type_filter = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';
        $start_date = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date = isset($param['end_date']) ? $param['end_date'] : '';

        if ($quotation_number_filter) {
            $this->db->like('q.quotation_number', $quotation_number_filter);
        }
        if ($payment_type_filter) {
            $this->db->where('rs.payment_type', $payment_type_filter);
        }
        if ($start_date) {
            $this->db->where('rs.receipt_scheduler_created_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('rs.receipt_scheduler_created_date <=', $end_date);
        }

        $this->db->from('receipt_scheduler rs');
        $this->db->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left');
        $this->db->where('q.quotation_current_status !=', 6);
        $this->db->where('rs.receipt_scheduler_status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    // =========================================
    // INSTALLMENTS CRUD
    // =========================================

    public function save_installment($data)
    {
        $this->db->insert($this->table_installments, $data);
        return $this->db->insert_id();
    }

    public function update_installment($where, $data)
    {
        $this->db->update($this->table_installments, $data, $where);
        return $this->db->affected_rows();
    }

    public function get_installments_by_scheduler_id($receipt_scheduler_id)
    {
        return $this->db
            ->select('i.*, latest_p.payment_id as latest_payment_id, latest_p.accountant_approval_status')
            ->from($this->table_installments . ' i')
            ->join('(
                SELECT p1.*
                FROM receipt_scheduler_payments p1
                INNER JOIN (
                    SELECT installment_id_fk, MAX(payment_id) as max_payment_id
                    FROM receipt_scheduler_payments
                    WHERE payment_status = 1
                    GROUP BY installment_id_fk
                ) p2 ON p2.installment_id_fk = p1.installment_id_fk AND p2.max_payment_id = p1.payment_id
            ) latest_p', 'latest_p.installment_id_fk = i.installment_id', 'left')
            ->where('i.receipt_scheduler_id_fk', $receipt_scheduler_id)
            ->where('i.installment_status', 1)
            ->order_by('i.installment_number', 'ASC')
            ->get()
            ->result();
    }

    public function get_installment_by_id($installment_id)
    {
        return $this->db
            ->from($this->table_installments)
            ->where('installment_id', $installment_id)
            ->where('installment_status', 1)
            ->get()
            ->row();
    }

    public function delete_installments_by_scheduler_id($receipt_scheduler_id)
    {
        $this->db->where('receipt_scheduler_id_fk', $receipt_scheduler_id);
        $this->db->update($this->table_installments, array('installment_status' => 0));
        return $this->db->affected_rows();
    }

    // =========================================
    // PAYMENTS CRUD
    // =========================================

    public function save_payment($data)
    {
        $this->db->insert($this->table_payments, $data);
        return $this->db->insert_id();
    }

    public function get_payments_by_installment_id($installment_id)
    {
        return $this->db
            ->from($this->table_payments)
            ->where('installment_id_fk', $installment_id)
            ->where('payment_status', 1)
            ->order_by('payment_date', 'ASC')
            ->get()
            ->result();
    }

    public function get_payments_by_scheduler_id($receipt_scheduler_id)
    {
        return $this->db
            ->select('p.*, i.installment_number, i.due_date')
            ->from('receipt_scheduler_payments p')
            ->join('receipt_scheduler_installments i', 'i.installment_id = p.installment_id_fk', 'left')
            ->where('p.receipt_scheduler_id_fk', $receipt_scheduler_id)
            ->where('p.payment_status', 1)
            ->order_by('p.payment_date', 'ASC')
            ->get()
            ->result();
    }

    public function get_payment_by_id($payment_id)
    {
        return $this->db
            ->from($this->table_payments)
            ->where('payment_id', $payment_id)
            ->where('payment_status', 1)
            ->get()
            ->row();
    }

    public function approve_payment($payment_id, $user_id, $username)
    {
        $this->db
            ->where('payment_id', $payment_id)
            ->update($this->table_payments, array(
                'accountant_approval_status' => 'approved',
                'accountant_approved_by_userid' => $user_id,
                'accountant_approved_by_username' => $username,
                'accountant_approved_at' => date('Y-m-d H:i:s')
            ));
        return $this->db->affected_rows() > 0;
    }

    public function get_quotation_id_by_payment($payment_id)
    {
        $row = $this->db
            ->select('rs.quotation_id_fk')
            ->from($this->table_payments . ' p')
            ->join($this->table_installments . ' i', 'i.installment_id = p.installment_id_fk', 'inner')
            ->join($this->table . ' rs', 'rs.receipt_scheduler_id = i.receipt_scheduler_id_fk', 'inner')
            ->where('p.payment_id', (int)$payment_id)
            ->get()
            ->row();
        return $row ? (int)$row->quotation_id_fk : 0;
    }

    public function get_quotation_id_by_installment($installment_id)
    {
        $row = $this->db
            ->select('rs.quotation_id_fk')
            ->from($this->table_installments . ' i')
            ->join($this->table . ' rs', 'rs.receipt_scheduler_id = i.receipt_scheduler_id_fk', 'inner')
            ->where('i.installment_id', (int)$installment_id)
            ->get()
            ->row();
        return $row ? (int)$row->quotation_id_fk : 0;
    }

    public function is_first_installment_approved($receipt_scheduler_id)
    {
        $row = $this->db
            ->select('latest_p.accountant_approval_status')
            ->from('receipt_scheduler_installments i')
            ->join('(
                SELECT p1.installment_id_fk, p1.accountant_approval_status
                FROM receipt_scheduler_payments p1
                INNER JOIN (
                    SELECT installment_id_fk, MAX(payment_id) as max_payment_id
                    FROM receipt_scheduler_payments
                    WHERE payment_status = 1
                    GROUP BY installment_id_fk
                ) p2 ON p2.installment_id_fk = p1.installment_id_fk AND p2.max_payment_id = p1.payment_id
            ) latest_p', 'latest_p.installment_id_fk = i.installment_id', 'left')
            ->where('i.receipt_scheduler_id_fk', $receipt_scheduler_id)
            ->where('i.installment_status', 1)
            ->where('i.installment_number', 1)
            ->order_by('i.installment_id', 'ASC')
            ->limit(1)
            ->get()
            ->row();

        return $row && $row->accountant_approval_status === 'approved';
    }

    public function is_first_installment_payment_pending($receipt_scheduler_id)
    {
        $row = $this->db
            ->select('latest_p.accountant_approval_status')
            ->from('receipt_scheduler_installments i')
            ->join('(
                SELECT p1.installment_id_fk, p1.accountant_approval_status
                FROM receipt_scheduler_payments p1
                INNER JOIN (
                    SELECT installment_id_fk, MAX(payment_id) as max_payment_id
                    FROM receipt_scheduler_payments
                    WHERE payment_status = 1
                    GROUP BY installment_id_fk
                ) p2 ON p2.installment_id_fk = p1.installment_id_fk AND p2.max_payment_id = p1.payment_id
            ) latest_p', 'latest_p.installment_id_fk = i.installment_id', 'left')
            ->where('i.receipt_scheduler_id_fk', $receipt_scheduler_id)
            ->where('i.installment_status', 1)
            ->where('i.installment_number', 1)
            ->order_by('i.installment_id', 'ASC')
            ->limit(1)
            ->get()
            ->row();

        return $row && $row->accountant_approval_status !== null && $row->accountant_approval_status !== 'approved';
    }

    public function get_total_paid_amount($receipt_scheduler_id)
    {
        $row = $this->db
            ->select_sum('payment_amount')
            ->from($this->table_payments)
            ->where('receipt_scheduler_id_fk', $receipt_scheduler_id)
            ->where('payment_status', 1)
            ->get()
            ->row();

        return $row && $row->payment_amount ? (float)$row->payment_amount : 0;
    }

    // =========================================
    // HELPER FUNCTIONS
    // =========================================

    public function get_confirmed_quotations_for_dropdown()
    {
        return $this->db
            ->select('q.quotation_id, q.quotation_number, l.guest_name')
            ->from('quotation q')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('q.quotation_current_status', 1) // 5 = accepted/confirmed
            ->where('q.quotation_current_status !=', 6)
            ->where('q.quotation_status', 1)
            ->order_by('q.quotation_id', 'DESC')
            ->get()
            ->result();
    }

    // public function get_quotation_total_amount($quotation_id)
    // {
    //     // Get total from quotation options (first/selected option)
    //     $option = $this->db
    //         ->select('quotation_options_total_quote_rate')
    //         ->from('quotation_options')
    //         ->where('quotation_id_fk', $quotation_id)
    //         ->where('quotation_options_status', 1)
    //         ->order_by('quotation_options_id', 'ASC')
    //         ->limit(1)
    //         ->get()
    //         ->row();

    //     $base_amount = $option ? (float)$option->quotation_options_total_quote_rate : 0;

    //     // Get inclusions amount
    //     $quotation = $this->db
    //         ->select('total_inclusion_amount, total_special_requirment_amount')
    //         ->from('quotation')
    //         ->where('quotation_id', $quotation_id)
    //         ->get()
    //         ->row();

    //     $inclusion_amount = $quotation ? (float)$quotation->total_inclusion_amount : 0;
    //     $special_amount = $quotation ? (float)$quotation->total_special_requirment_amount : 0;

    //     return $base_amount + $inclusion_amount + $special_amount;
    // }

    public function get_quotation_total_amount($quotation_id)
    {
        $main = $this->db
            ->select('
                q.quotation_id,
                qo.quotation_options_id,
                qo.quotation_options_total_quote_rate,
                qo.quotation_options_cab_amount,
                qo.quotation_options_margin_value,
                l.start_date
            ')
            ->from('quotation_confirmation qc')
            ->join('quotation q', 'q.quotation_id = qc.quotation_id_fk', 'left')
            ->join('quotation_options qo', 'qo.quotation_options_id = qc.option_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('q.quotation_id', (int)$quotation_id)
            ->where('qc.property_confirmation_status', 1)
            ->limit(1)
            ->get()
            ->row_array();

        if (empty($main)) {
            return array('total_amount' => 0, 'travel_start_date' => '');
        }

        // Calculate hotel total dynamically from confirmed rooms
        $hotelRow = $this->db
            ->select('COALESCE(SUM(day_max.max_rate),0) as total')
            ->from('(SELECT MAX(qpr.total_room_cost) as max_rate
                FROM quotation_confirmation qc2
                INNER JOIN quotation_properties_days qpd ON qpd.quotation_properties_days_id = qc2.properties_day_id_fk
                INNER JOIN quotation_properties qp ON qp.quotation_properties_days_id_fk = qpd.quotation_properties_days_id
                INNER JOIN quotation_properties_rooms qpr ON qpr.quotation_properties_id_fk = qp.quotation_properties_id
                WHERE qc2.quotation_id_fk = ' . (int)$main['quotation_id'] . '
                AND qc2.option_id_fk = ' . (int)$main['quotation_options_id'] . '
                AND qc2.property_confirmation_status = 1
                AND qpd.quotation_properties_days_status = 1
                AND qp.quotation_properties_status = 1
                AND qpr.quotation_properties_rooms_status = 1
                GROUP BY qpd.quotation_properties_days_id
            ) as day_max')
            ->get()->row();
        $hotel_total = $hotelRow ? (float)$hotelRow->total : 0;

        $base_amount = $hotel_total
            + (float)$main['quotation_options_cab_amount']
            + (float)$main['quotation_options_margin_value'];

        $inclusion_row = $this->db
            ->select_sum('inclusion_amount')
            ->where('quotation_id_fk', $main['quotation_id'])
            ->where('quotation_options_id_fk', $main['quotation_options_id'])
            ->where('quotation_property_inclusions_status', 1)
            ->get('quotation_property_inclusions')
            ->row();

        $inclusion_amount = !empty($inclusion_row->inclusion_amount)
            ? (float)$inclusion_row->inclusion_amount
            : 0;

        $special_row = $this->db
            ->select_sum('quotation_special_requirements_cost')
            ->where('quotation_id_fk', $main['quotation_id'])
            ->where('quotation_special_requirements_status', 1)
            ->get('quotation_special_requirements')
            ->row();

        $special_amount = !empty($special_row->quotation_special_requirements_cost)
            ? (float)$special_row->quotation_special_requirements_cost
            : 0;

        return array(
            'total_amount' => $base_amount + $inclusion_amount + $special_amount,
            'travel_start_date' => !empty($main['start_date']) ? $main['start_date'] : ''
        );
    }

    public function has_payments($receipt_scheduler_id)
    {
        $count = $this->db
            ->from($this->table_payments)
            ->where('receipt_scheduler_id_fk', $receipt_scheduler_id)
            ->where('payment_status', 1)
            ->count_all_results();
        return $count > 0;
    }

    public function sync_total_amount($quotation_id)
    {
        $scheduler = $this->get_by_quotation_id($quotation_id);
        if (!$scheduler) {
            return false;
        }

        $scheduler_id = $scheduler->receipt_scheduler_id;

        $new_data = $this->get_quotation_total_amount($quotation_id);
        $new_total = (float)$new_data['total_amount'];

        if ($new_total <= 0) {
            return false;
        }

        $old_total = (float)$scheduler->total_amount;

        if (abs($new_total - $old_total) < 0.01) {
            return false;
        }

        // Always update the scheduler total to match the quotation.
        $this->update(
            array('receipt_scheduler_id' => $scheduler_id),
            array('total_amount' => $new_total)
        );

        $installments = $this->db
            ->from($this->table_installments)
            ->where('receipt_scheduler_id_fk', $scheduler_id)
            ->where('installment_status', 1)
            ->order_by('installment_number', 'ASC')
            ->get()
            ->result();

        if (empty($installments)) {
            return true;
        }

        // Separate installments that already have a recorded payment (preserve them)
        // from fully unpaid installments (redistribute the remaining balance).
        $reserved = 0;
        $unpaid = array();
        foreach ($installments as $inst) {
            if ((float)$inst->paid_amount > 0) {
                $reserved += (float)$inst->calculated_amount;
            } else {
                $unpaid[] = $inst;
            }
        }

        // Remaining amount to spread across the unpaid installments.
        $remaining = $new_total - $reserved;
        if ($remaining < 0) {
            $remaining = 0;
        }

        // No unpaid installments to adjust; total already updated.
        if (empty($unpaid)) {
            return true;
        }

        // Baseline sum of existing unpaid amounts (for proportional distribution).
        $unpaid_base = 0;
        foreach ($unpaid as $inst) {
            $unpaid_base += (float)$inst->calculated_amount;
        }

        $count = count($unpaid);
        $running = 0;
        for ($i = 0; $i < $count; $i++) {
            $inst = $unpaid[$i];

            if ($i < $count - 1) {
                if ($unpaid_base > 0) {
                    $share = round($remaining * ((float)$inst->calculated_amount / $unpaid_base), 2);
                } else {
                    $share = round($remaining / $count, 2);
                }
                $running += $share;
            } else {
                // Last unpaid installment absorbs any rounding remainder.
                $share = round($remaining - $running, 2);
            }

            $update = array(
                'installment_amount' => $share,
                'calculated_amount' => $share
            );

            // Keep percentage in sync when the scheduler splits by percentage.
            if ($scheduler->payment_type == 'EMI' && $scheduler->split_type == 'PERCENTAGE' && $new_total > 0) {
                $update['installment_percentage'] = round(($share / $new_total) * 100, 2);
            }

            $this->update_installment(
                array('installment_id' => $inst->installment_id),
                $update
            );
        }

        return true;
    }

    public function check_scheduler_exists($quotation_id)
    {
        $exists = $this->db
            ->from($this->table)
            ->where('quotation_id_fk', $quotation_id)
            ->where('receipt_scheduler_status', 1)
            ->get()
            ->row();

        return $exists ? true : false;
    }

    public function get_pending_installments()
    {
        return $this->db
            ->select('i.*, rs.payment_type, rs.total_amount, q.quotation_number, l.guest_name')
            ->from('receipt_scheduler_installments i')
            ->join('receipt_scheduler rs', 'rs.receipt_scheduler_id = i.receipt_scheduler_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('i.payment_status', 'PENDING')
            ->where('i.installment_status', 1)
            ->where('rs.receipt_scheduler_status', 1)
            ->where('q.quotation_current_status !=', 6)
            ->order_by('i.due_date', 'ASC')
            ->get()
            ->result();
    }

    public function get_overdue_installments()
    {
        $today = date('Y-m-d');
        return $this->db
            ->select('i.*, rs.payment_type, rs.total_amount, q.quotation_number, l.guest_name')
            ->from('receipt_scheduler_installments i')
            ->join('receipt_scheduler rs', 'rs.receipt_scheduler_id = i.receipt_scheduler_id_fk', 'left')
            ->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('i.payment_status IN ("PENDING", "PARTIAL")')
            ->where('i.due_date <', $today)
            ->where('i.installment_status', 1)
            ->where('rs.receipt_scheduler_status', 1)
            ->where('q.quotation_current_status !=', 6)
            ->order_by('i.due_date', 'ASC')
            ->get()
            ->result();
    }

    public function update_overdue_status()
    {
        $today = date('Y-m-d');
        $this->db->where('due_date <', $today);
        $this->db->where('payment_status', 'PENDING');
        $this->db->where('installment_status', 1);
        $this->db->update($this->table_installments, array('payment_status' => 'OVERDUE'));
        return $this->db->affected_rows();
    }

    public function getCustomerPaymentReportTable($param)
    {
        $start_date              = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date                = isset($param['end_date']) ? $param['end_date'] : '';
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name_filter       = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $payment_type_filter     = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';
        $installment_number_filter = isset($param['installment_number_filter']) ? $param['installment_number_filter'] : '';
        $status_filter           = isset($param['status_filter']) ? $param['status_filter'] : '';
        $approval_pending_filter = isset($param['approval_pending_filter']) ? $param['approval_pending_filter'] : '';

        $this->db
            ->select('i.installment_id, i.installment_number, i.due_date, i.calculated_amount, i.paid_amount, i.payment_status,
                      rs.receipt_scheduler_id, rs.payment_type, rs.total_amount,
                      q.quotation_number, q.quotation_id,
                      l.guest_name,
                      latest_p.payment_id as latest_payment_id,
                      latest_p.accountant_approval_status as latest_approval_status')
            ->from($this->table_installments . ' i')
            ->join($this->table . ' rs', 'rs.receipt_scheduler_id = i.receipt_scheduler_id_fk', 'inner')
            ->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->join('(
                SELECT p1.payment_id, p1.installment_id_fk, p1.accountant_approval_status
                FROM ' . $this->table_payments . ' p1
                INNER JOIN (
                    SELECT installment_id_fk, MAX(payment_id) as max_payment_id
                    FROM ' . $this->table_payments . '
                    WHERE payment_status = 1
                    GROUP BY installment_id_fk
                ) p2 ON p2.installment_id_fk = p1.installment_id_fk AND p2.max_payment_id = p1.payment_id
                WHERE p1.payment_status = 1
            ) latest_p', 'latest_p.installment_id_fk = i.installment_id', 'left')
            ->where('i.installment_status', 1)
            ->where('rs.receipt_scheduler_status', 1)
            ->where('q.quotation_current_status !=', 6);

        $this->_applyCustomerPaymentReportFilters($start_date, $end_date, $quotation_number_filter, $guest_name_filter, $payment_type_filter, $installment_number_filter, $status_filter, $approval_pending_filter);

        $this->db->order_by('i.due_date', 'ASC');

        if ($param['length'] != -1 && $param['start'] != 'false' && $param['length'] != 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCustomerPaymentReportTotalCount($param);
        $data['recordsFiltered'] = $this->getCustomerPaymentReportTotalCount($param);
        return $data;
    }

    public function getCustomerPaymentReportTotalCount($param = NULL)
    {
        $start_date              = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date                = isset($param['end_date']) ? $param['end_date'] : '';
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name_filter       = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $payment_type_filter     = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';
        $installment_number_filter = isset($param['installment_number_filter']) ? $param['installment_number_filter'] : '';
        $status_filter           = isset($param['status_filter']) ? $param['status_filter'] : '';
        $approval_pending_filter = isset($param['approval_pending_filter']) ? $param['approval_pending_filter'] : '';

        $this->db
            ->from($this->table_installments . ' i')
            ->join($this->table . ' rs', 'rs.receipt_scheduler_id = i.receipt_scheduler_id_fk', 'inner')
            ->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->join('(
                SELECT p1.installment_id_fk, p1.accountant_approval_status
                FROM ' . $this->table_payments . ' p1
                INNER JOIN (
                    SELECT installment_id_fk, MAX(payment_id) as max_payment_id
                    FROM ' . $this->table_payments . '
                    WHERE payment_status = 1
                    GROUP BY installment_id_fk
                ) p2 ON p2.installment_id_fk = p1.installment_id_fk AND p2.max_payment_id = p1.payment_id
                WHERE p1.payment_status = 1
            ) latest_p', 'latest_p.installment_id_fk = i.installment_id', 'left')
            ->where('i.installment_status', 1)
            ->where('rs.receipt_scheduler_status', 1)
            ->where('q.quotation_current_status !=', 6);

        $this->_applyCustomerPaymentReportFilters($start_date, $end_date, $quotation_number_filter, $guest_name_filter, $payment_type_filter, $installment_number_filter, $status_filter, $approval_pending_filter);

        return $this->db->get()->num_rows();
    }

    private function _applyCustomerPaymentReportFilters($start_date, $end_date, $quotation_number_filter, $guest_name_filter, $payment_type_filter, $installment_number_filter, $status_filter, $approval_pending_filter = '')
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
        if ($payment_type_filter) {
            $this->db->where('rs.payment_type', $payment_type_filter);
        }
        if ($installment_number_filter !== '' && $installment_number_filter !== null) {
            $this->db->where('i.installment_number', (int)$installment_number_filter);
        }
        if ($status_filter) {
            $this->db->where('i.payment_status', $status_filter);
        }
        if ($approval_pending_filter === '1') {
            $this->db->group_start()
                ->where('latest_p.accountant_approval_status IS NULL', null, false)
                ->or_where('latest_p.accountant_approval_status !=', 'approved')
                ->group_end();
        }
    }

    public function getCustomerSchedulerReportTable($param)
    {
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name_filter       = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $payment_type_filter     = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';
        $start_date              = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date                = isset($param['end_date']) ? $param['end_date'] : '';

        $this->db
            ->select('rs.receipt_scheduler_id, rs.payment_type, rs.total_amount, rs.max_emi_count,
                      rs.quotation_id_fk,
                      q.quotation_number,
                      l.guest_name,
                      DATE_FORMAT(rs.receipt_scheduler_created_date, \'%d-%m-%Y\') as created_date_formatted,
                      COALESCE(SUM(i.paid_amount), 0) as total_paid,
                      (rs.total_amount - COALESCE(SUM(i.paid_amount), 0)) as pending_amount')
            ->from('receipt_scheduler rs')
            ->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->join($this->table_installments . ' i', 'i.receipt_scheduler_id_fk = rs.receipt_scheduler_id AND i.installment_status = 1', 'left')
            ->where('rs.receipt_scheduler_status', 1)
            ->where('q.quotation_current_status !=', 6);

        if ($quotation_number_filter) {
            $this->db->like('q.quotation_number', $quotation_number_filter);
        }
        if ($guest_name_filter) {
            $this->db->like('l.guest_name', $guest_name_filter);
        }
        if ($payment_type_filter) {
            $this->db->where('rs.payment_type', $payment_type_filter);
        }
        if ($start_date) {
            $this->db->where('rs.receipt_scheduler_created_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('rs.receipt_scheduler_created_date <=', $end_date);
        }

        $this->db->group_by('rs.receipt_scheduler_id');
        $this->db->order_by('rs.receipt_scheduler_id', 'DESC');

        if ($param['length'] != -1 && $param['start'] != 'false' && $param['length'] != 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCustomerSchedulerReportTotalCount($param);
        $data['recordsFiltered'] = $this->getCustomerSchedulerReportTotalCount($param);
        return $data;
    }

    public function getCustomerSchedulerReportTotalCount($param = NULL)
    {
        $quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';
        $guest_name_filter       = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';
        $payment_type_filter     = isset($param['payment_type_filter']) ? $param['payment_type_filter'] : '';
        $start_date              = isset($param['start_date']) ? $param['start_date'] : '';
        $end_date                = isset($param['end_date']) ? $param['end_date'] : '';

        $this->db
            ->from('receipt_scheduler rs')
            ->join('quotation q', 'q.quotation_id = rs.quotation_id_fk', 'left')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('rs.receipt_scheduler_status', 1)
            ->where('q.quotation_current_status !=', 6);

        if ($quotation_number_filter) {
            $this->db->like('q.quotation_number', $quotation_number_filter);
        }
        if ($guest_name_filter) {
            $this->db->like('l.guest_name', $guest_name_filter);
        }
        if ($payment_type_filter) {
            $this->db->where('rs.payment_type', $payment_type_filter);
        }
        if ($start_date) {
            $this->db->where('rs.receipt_scheduler_created_date >=', $start_date);
        }
        if ($end_date) {
            $this->db->where('rs.receipt_scheduler_created_date <=', $end_date);
        }

        return $this->db->count_all_results();
    }

    public function get_payment_summary($receipt_scheduler_id)
    {
        $scheduler = $this->get_by_id($receipt_scheduler_id);
        if (!$scheduler) return null;

        $installments = $this->get_installments_by_scheduler_id($receipt_scheduler_id);
        $total_paid = $this->get_total_paid_amount($receipt_scheduler_id);
        $pending_amount = $scheduler->total_amount - $total_paid;

        $pending_count = 0;
        $paid_count = 0;
        $overdue_count = 0;

        foreach ($installments as $inst) {
            if ($inst->payment_status == 'PAID') {
                $paid_count++;
            } elseif ($inst->payment_status == 'OVERDUE') {
                $overdue_count++;
            } else {
                $pending_count++;
            }
        }

        return array(
            'scheduler' => $scheduler,
            'installments' => $installments,
            'total_amount' => $scheduler->total_amount,
            'total_paid' => $total_paid,
            'pending_amount' => $pending_amount,
            'total_installments' => count($installments),
            'paid_count' => $paid_count,
            'pending_count' => $pending_count,
            'overdue_count' => $overdue_count
        );
    }
}
?>
