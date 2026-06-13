<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Receipt_scheduler extends MY_Controller {
    
    public $table = 'receipt_scheduler';
    public $page = 'Receipt Scheduler';

    public function __construct() {
        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login');
        }

        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
        $this->currentusername = $this->session->userdata('admin_name');

        $this->load->model('General_model');
        $this->load->model('Receipt_scheduler_model');
    }

    public function index()
    {
        $template['confirmed_quotations'] = $this->Receipt_scheduler_model->get_confirmed_quotations_for_dropdown();
        $template['body'] = 'Receipt_scheduler/list';
        $template['script'] = 'Receipt_scheduler/script';
        $this->load->view('template', $template);
    }

    public function get_table()
    {
        $param = array(
            'quotation_number_filter' => $this->input->post('quotation_number_filter'),
            'payment_type_filter' => $this->input->post('payment_type_filter'),
            'payment_status_filter' => $this->input->post('payment_status_filter'),
            'start_date' => $this->input->post('start_date'),
            'end_date' => $this->input->post('end_date'),
            'start' => $this->input->post('start'),
            'length' => $this->input->post('length'),
        );

        $result = $this->Receipt_scheduler_model->getReceiptSchedulerTable($param);
        echo json_encode($result);
    }

    public function add()
    {
        $quotation_id = $this->input->post('quotation_id_fk');
        $payment_type = $this->input->post('payment_type');
        $total_amount = $this->input->post('total_amount');
        $max_emi_count = $this->input->post('max_emi_count');
        $split_type = $this->input->post('split_type');
        $remarks = $this->input->post('receipt_scheduler_remarks');

        // Check if scheduler already exists for this quotation
        if ($this->Receipt_scheduler_model->check_scheduler_exists($quotation_id)) {
            echo json_encode(array('error' => true, 'message' => 'Payment schedule already exists for this quotation'));
            return;
        }

        // Insert main scheduler record
        $scheduler_data = array(
            'quotation_id_fk' => $quotation_id,
            'payment_type' => $payment_type,
            'total_amount' => $total_amount,
            'max_emi_count' => $payment_type == 'EMI' ? $max_emi_count : null,
            'split_type' => $payment_type == 'EMI' ? $split_type : null,
            'receipt_scheduler_remarks' => $remarks,
            'receipt_scheduler_created_by_userid' => $this->currentuserid,
            'receipt_scheduler_created_by_username' => $this->currentusername,
            'receipt_scheduler_created_date' => date('Y-m-d'),
            'receipt_scheduler_created_time' => date('H:i:s'),
            'receipt_scheduler_status' => 1
        );

        $scheduler_id = $this->Receipt_scheduler_model->save($scheduler_data);

        if ($scheduler_id) {
            // Handle installments based on payment type
            if ($payment_type == 'FULL') {
                // Single installment for FULL payment
                $cutoff_date = $this->input->post('cutoff_date');
                $this->Receipt_scheduler_model->save_installment(array(
                    'receipt_scheduler_id_fk' => $scheduler_id,
                    'installment_number' => 1,
                    'installment_amount' => $total_amount,
                    'installment_percentage' => 100,
                    'calculated_amount' => $total_amount,
                    'due_date' => $cutoff_date,
                    'payment_status' => 'PENDING',
                    'paid_amount' => 0,
                    'installment_status' => 1
                ));
            } else {
                // Multiple installments for EMI
                $emi_amounts = $this->input->post('emi_amount');
                $emi_percentages = $this->input->post('emi_percentage');
                $emi_due_dates = $this->input->post('emi_due_date');

                if (is_array($emi_due_dates)) {
                    for ($i = 0; $i < count($emi_due_dates); $i++) {
                        $calculated_amount = 0;
                        if ($split_type == 'AMOUNT') {
                            $calculated_amount = isset($emi_amounts[$i]) ? (float)$emi_amounts[$i] : 0;
                        } else {
                            $percentage = isset($emi_percentages[$i]) ? (float)$emi_percentages[$i] : 0;
                            $calculated_amount = ($total_amount * $percentage) / 100;
                        }

                        $this->Receipt_scheduler_model->save_installment(array(
                            'receipt_scheduler_id_fk' => $scheduler_id,
                            'installment_number' => ($i + 1),
                            'installment_amount' => isset($emi_amounts[$i]) ? $emi_amounts[$i] : null,
                            'installment_percentage' => isset($emi_percentages[$i]) ? $emi_percentages[$i] : null,
                            'calculated_amount' => $calculated_amount,
                            'due_date' => $emi_due_dates[$i],
                            'payment_status' => 'PENDING',
                            'paid_amount' => 0,
                            'installment_status' => 1
                        ));
                    }
                }
            }

            echo json_encode(array('error' => false, 'message' => 'Payment schedule created successfully'));
        } else {
            echo json_encode(array('error' => true, 'message' => 'Failed to create payment schedule'));
        }
    }

    public function edit()
    {
        $scheduler_id = $this->input->post('receipt_scheduler_id');
        $payment_type = $this->input->post('payment_type');
        $total_amount = $this->input->post('total_amount');
        $max_emi_count = $this->input->post('max_emi_count');
        $split_type = $this->input->post('split_type');
        $remarks = $this->input->post('receipt_scheduler_remarks');

        $scheduler_data = array(
            'payment_type' => $payment_type,
            'total_amount' => $total_amount,
            'max_emi_count' => $payment_type == 'EMI' ? $max_emi_count : null,
            'split_type' => $payment_type == 'EMI' ? $split_type : null,
            'receipt_scheduler_remarks' => $remarks
        );

        $this->Receipt_scheduler_model->update(array('receipt_scheduler_id' => $scheduler_id), $scheduler_data);

        // Delete existing installments and recreate
        $this->Receipt_scheduler_model->delete_installments_by_scheduler_id($scheduler_id);

        if ($payment_type == 'FULL') {
            $cutoff_date = $this->input->post('cutoff_date');
            $this->Receipt_scheduler_model->save_installment(array(
                'receipt_scheduler_id_fk' => $scheduler_id,
                'installment_number' => 1,
                'installment_amount' => $total_amount,
                'installment_percentage' => 100,
                'calculated_amount' => $total_amount,
                'due_date' => $cutoff_date,
                'payment_status' => 'PENDING',
                'paid_amount' => 0,
                'installment_status' => 1
            ));
        } else {
            $emi_amounts = $this->input->post('emi_amount');
            $emi_percentages = $this->input->post('emi_percentage');
            $emi_due_dates = $this->input->post('emi_due_date');

            if (is_array($emi_due_dates)) {
                for ($i = 0; $i < count($emi_due_dates); $i++) {
                    $calculated_amount = 0;
                    if ($split_type == 'AMOUNT') {
                        $calculated_amount = isset($emi_amounts[$i]) ? (float)$emi_amounts[$i] : 0;
                    } else {
                        $percentage = isset($emi_percentages[$i]) ? (float)$emi_percentages[$i] : 0;
                        $calculated_amount = ($total_amount * $percentage) / 100;
                    }

                    $this->Receipt_scheduler_model->save_installment(array(
                        'receipt_scheduler_id_fk' => $scheduler_id,
                        'installment_number' => ($i + 1),
                        'installment_amount' => isset($emi_amounts[$i]) ? $emi_amounts[$i] : null,
                        'installment_percentage' => isset($emi_percentages[$i]) ? $emi_percentages[$i] : null,
                        'calculated_amount' => $calculated_amount,
                        'due_date' => $emi_due_dates[$i],
                        'payment_status' => 'PENDING',
                        'paid_amount' => 0,
                        'installment_status' => 1
                    ));
                }
            }
        }

        echo json_encode(array('error' => false, 'message' => 'Payment schedule updated successfully'));
    }

    public function get_by_id()
    {
        $id = $this->input->post('receipt_scheduler_id');
        $scheduler = $this->Receipt_scheduler_model->get_by_id($id);
        $installments = $this->Receipt_scheduler_model->get_installments_by_scheduler_id($id);

        echo json_encode(array(
            'scheduler' => $scheduler,
            'installments' => $installments
        ));
    }

    public function delete()
    {
        $id = $this->input->post('receipt_scheduler_id');
        $result = $this->Receipt_scheduler_model->delete_by_id($id);
        
        if ($result) {
            $this->Receipt_scheduler_model->delete_installments_by_scheduler_id($id);
            echo json_encode(array('error' => false, 'message' => 'Deleted successfully'));
        } else {
            echo json_encode(array('error' => true, 'message' => 'Delete failed'));
        }
    }

    public function get_quotation_amount()
    {
        $quotation_id = $this->input->post('quotation_id');
        $amount = $this->Receipt_scheduler_model->get_quotation_total_amount($quotation_id);
        echo json_encode(array('total_amount' => $amount));
    }

    public function record_payment()
    {
        $installment_id = $this->input->post('installment_id');
        $payment_amount = $this->input->post('payment_amount');
        $payment_date = $this->input->post('payment_date');
        $payment_method = $this->input->post('payment_method');
        $payment_reference = $this->input->post('payment_reference');
        $payment_remarks = $this->input->post('payment_remarks');

        $installment = $this->Receipt_scheduler_model->get_installment_by_id($installment_id);
        if (!$installment) {
            echo json_encode(array('error' => true, 'message' => 'Installment not found'));
            return;
        }

        // Record payment
        $payment_data = array(
            'installment_id_fk' => $installment_id,
            'receipt_scheduler_id_fk' => $installment->receipt_scheduler_id_fk,
            'payment_amount' => $payment_amount,
            'payment_date' => $payment_date,
            'payment_method' => $payment_method,
            'payment_reference' => $payment_reference,
            'payment_remarks' => $payment_remarks,
            'payment_received_by_userid' => $this->currentuserid,
            'payment_received_by_username' => $this->currentusername,
            'payment_status' => 1
        );

        $payment_id = $this->Receipt_scheduler_model->save_payment($payment_data);

        if ($payment_id) {
            // Update installment status
            $new_paid_amount = (float)$installment->paid_amount + (float)$payment_amount;
            $new_status = 'PARTIAL';
            
            if ($new_paid_amount >= $installment->calculated_amount) {
                $new_status = 'PAID';
            }

            $this->Receipt_scheduler_model->update_installment(
                array('installment_id' => $installment_id),
                array(
                    'paid_amount' => $new_paid_amount,
                    'paid_date' => $payment_date,
                    'payment_status' => $new_status,
                    'payment_reference' => $payment_reference,
                    'payment_method' => $payment_method
                )
            );

            echo json_encode(array('error' => false, 'message' => 'Payment recorded successfully'));
        } else {
            echo json_encode(array('error' => true, 'message' => 'Failed to record payment'));
        }
    }

    public function get_payment_summary()
    {
        $scheduler_id = $this->input->post('receipt_scheduler_id');
        $summary = $this->Receipt_scheduler_model->get_payment_summary($scheduler_id);
        echo json_encode($summary);
    }

    public function get_installments()
    {
        $scheduler_id = $this->input->post('receipt_scheduler_id');
        $installments = $this->Receipt_scheduler_model->get_installments_by_scheduler_id($scheduler_id);
        echo json_encode($installments);
    }

    public function get_payment_history()
    {
        $scheduler_id = $this->input->post('receipt_scheduler_id');
        $payments = $this->Receipt_scheduler_model->get_payments_by_scheduler_id($scheduler_id);
        echo json_encode($payments);
    }

    public function pending_payments()
    {
        $template['pending_installments'] = $this->Receipt_scheduler_model->get_pending_installments();
        $template['overdue_installments'] = $this->Receipt_scheduler_model->get_overdue_installments();
        $template['body'] = 'Receipt_scheduler/pending';
        $template['script'] = 'Receipt_scheduler/script_pending';
        $this->load->view('template', $template);
    }

    public function update_overdue_status()
    {
        $count = $this->Receipt_scheduler_model->update_overdue_status();
        echo json_encode(array('updated' => $count));
    }
}
?>
