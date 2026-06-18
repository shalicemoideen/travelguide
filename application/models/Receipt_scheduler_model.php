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
            ->select('rs.*, q.quotation_number, q.quotation_id, l.guest_name, l.leads_number')
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

        $this->db->where('rs.receipt_scheduler_status', 1);

        if ($param['length'] != -1 && $param['start'] != 'false' && $param['length'] != 'false') {
            $this->db->limit($param['length'], $param['start']);
        }

        $this->db->select('rs.*, q.quotation_number, l.guest_name, l.leads_number,
                          DATE_FORMAT(rs.receipt_scheduler_created_date, \'%d-%m-%Y\') as created_date_formatted');
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
            ->from($this->table_installments)
            ->where('receipt_scheduler_id_fk', $receipt_scheduler_id)
            ->where('installment_status', 1)
            ->order_by('installment_number', 'ASC')
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
                qo.quotation_options_total_quote_rate
            ')
            ->from('quotation_confirmation qc')
            ->join('quotation q', 'q.quotation_id = qc.quotation_id_fk', 'left')
            ->join('quotation_options qo', 'qo.quotation_options_id = qc.option_id_fk', 'left')
            ->where('q.quotation_id', (int)$quotation_id)
            ->where('qc.property_confirmation_status', 1)
            ->limit(1)
            ->get()
            ->row_array();

        if (empty($main)) {
            return 0;
        }

        $base_amount = !empty($main['quotation_options_total_quote_rate'])
            ? (float)$main['quotation_options_total_quote_rate']
            : 0;

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

        return $base_amount + $inclusion_amount + $special_amount;
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
