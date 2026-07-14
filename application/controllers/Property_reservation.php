<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Property_reservation extends MY_Controller {

    public $table = 'property_reservation';
    public $page  = 'Property Reservation';

    public function __construct()
    {
        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login');
        }

        $this->currentuserid   = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
        $this->currentusername = $this->session->userdata('admin_name');

        $this->load->model('General_model');
        $this->load->model('Property_reservation_model');
    }

    // =========================================================
    // PAGE
    // =========================================================

    public function index($quotation_id = null)
    {
        $template['bookings']            = $this->Property_reservation_model->get_confirmed_bookings();
        $template['preselect_quotation'] = $quotation_id ? (int)$quotation_id : 0;
        $template['body']                = 'Property_reservation/list';
        $template['script']              = 'Property_reservation/script';
        $this->load->view('template', $template);
    }

    // =========================================================
    // AJAX: dropdown data
    // =========================================================

    public function ajax_get_options()
    {
        $quotation_id = (int)$this->input->post('quotation_id');
        $data = $this->Property_reservation_model->get_options_for_quotation($quotation_id);
        echo json_encode(array('status' => !empty($data), 'data' => $data));
    }

    public function ajax_get_properties()
    {
        $quotation_id        = (int)$this->input->post('quotation_id');
        $quotation_options_id = (int)$this->input->post('quotation_options_id');
        $data = $this->Property_reservation_model->get_properties_for_booking($quotation_id, $quotation_options_id);
        echo json_encode(array('status' => !empty($data), 'data' => $data));
    }

    public function ajax_get_accommodation_dates()
    {
        $quotation_id  = (int)$this->input->post('quotation_id');
        $properties_id = (int)$this->input->post('properties_id');
        $dates = $this->Property_reservation_model->get_accommodation_dates($quotation_id, $properties_id);
        echo json_encode(array('status' => true, 'dates' => $dates));
    }

    // =========================================================
    // AJAX: load (and seed if missing) a reservation
    // =========================================================

    public function ajax_get_reservation()
    {
        $quotation_id  = (int)$this->input->post('quotation_id');
        $properties_id = (int)$this->input->post('properties_id');
        $check_in      = $this->input->post('check_in_date');
        $check_out     = $this->input->post('check_out_date');
        $nights        = (int)$this->input->post('duration_nights');

        if ($quotation_id <= 0 || $properties_id <= 0) {
            echo json_encode(array('status' => false, 'message' => 'Missing booking or property'));
            return;
        }

        $reservation = $this->Property_reservation_model->get_reservation($quotation_id, $properties_id);

        if (!$reservation) {
            $header = $this->Property_reservation_model->get_booking_header($quotation_id);

            $insert = array(
                'quotation_id_fk'  => $quotation_id,
                'properties_id_fk' => $properties_id,
                'booking_number'   => $header ? $header->quotation_number : '',
                'guest_name'       => $header ? $header->guest_name : '',
                'check_in_date'    => $check_in ? date('Y-m-d', strtotime($check_in)) : date('Y-m-d'),
                'check_out_date'   => $check_out ? date('Y-m-d', strtotime($check_out)) : date('Y-m-d'),
                'duration_nights'  => $nights > 0 ? $nights : 1,
                'property_reservation_created_by_userid' => $this->currentuserid,
                'property_reservation_created_datetime'  => date('Y-m-d H:i:s'),
                'property_reservation_status' => 1,
            );

            $id = $this->Property_reservation_model->create_reservation($insert);
            $reservation = $this->Property_reservation_model->get_reservation_by_id($id);
        }

        $payment      = $this->Property_reservation_model->get_payment_by_reservation($reservation->property_reservation_id);
        $installments = $payment ? $this->Property_reservation_model->get_installments($payment->property_payment_scheduler_id) : array();
        $comments     = $this->Property_reservation_model->get_comments($reservation->property_reservation_id);
        $total_amount = $this->Property_reservation_model->get_property_total_amount($quotation_id, $properties_id);

        echo json_encode(array(
            'status'       => true,
            'reservation'  => $reservation,
            'payment'      => $payment,
            'installments' => $installments,
            'comments'     => $comments,
            'total_amount' => $total_amount,
        ));
    }

    // =========================================================
    // LEVEL 1: Hotel Blocking
    // =========================================================

    public function save_blocking()
    {
        if (!has_permission('PROPERTY_RESERVATION')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied: Property Reservation'));
            return;
        }

        $id = (int)$this->input->post('property_reservation_id');
        if ($id <= 0) {
            echo json_encode(array('error' => true, 'message' => 'Reservation not found'));
            return;
        }

        $data = array(
            'blocking_cnfm_by'        => $this->input->post('blocking_cnfm_by'),
            'blocking_cutoff_date'    => $this->_date($this->input->post('blocking_cutoff_date')),
            'blocking_date'           => $this->_date($this->input->post('blocking_date')),
            'blocking_status'         => 'BLOCKED',
            'blocking_done_by_userid' => $this->currentuserid,
            'blocking_done_datetime'  => date('Y-m-d H:i:s'),
        );

        $this->Property_reservation_model->update_reservation($id, $data);
        echo json_encode(array('error' => false, 'message' => 'Hotel blocking saved successfully'));
    }

    // =========================================================
    // LEVEL 2: Reservation Confirmation + Payment Scheduler
    // =========================================================

    public function save_confirmation()
    {
        if (!has_permission('PROPERTY_RESERVATION')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied: Property Reservation'));
            return;
        }

        $id = (int)$this->input->post('property_reservation_id');
        if ($id <= 0) {
            echo json_encode(array('error' => true, 'message' => 'Reservation not found'));
            return;
        }

        $reservation = $this->Property_reservation_model->get_reservation_by_id($id);
        if (!$reservation) {
            echo json_encode(array('error' => true, 'message' => 'Reservation not found'));
            return;
        }

        // ---- Update confirmation (level 2) ----
        $this->Property_reservation_model->update_reservation($id, array(
            'confirmation_cnfm_by'        => $this->input->post('confirmation_cnfm_by'),
            'confirmation_cnfm_no'        => $this->input->post('confirmation_cnfm_no'),
            'confirmation_cnfm_date'      => $this->_date($this->input->post('confirmation_cnfm_date')),
            'confirmation_status'         => 'CONFIRMED',
            'confirmation_done_by_userid' => $this->currentuserid,
            'confirmation_done_datetime'  => date('Y-m-d H:i:s'),
        ));

        // ---- Payment scheduler ----
        $payment_type     = $this->input->post('payment_type') ?: $this->input->post('hub_payment_type'); // FULL | EMI
        $total_amount     = (float)$this->input->post('total_amount');
        $discount_amount  = (float)$this->input->post('discount_amount');
        $discounted_total = (float)$this->input->post('discounted_total');
        if ($discounted_total <= 0) $discounted_total = $total_amount - $discount_amount;
        if ($discounted_total < 0)  $discounted_total = 0;
        $max_emi      = $this->input->post('max_emi_count');
        $split_type   = $this->input->post('split_type');
        $remarks      = $this->input->post('payment_remarks');

        if ($payment_type) {
            $existing = $this->Property_reservation_model->get_payment_by_reservation($id);

            $payment_data = array(
                'property_reservation_id_fk' => $id,
                'quotation_id_fk'            => $reservation->quotation_id_fk,
                'payment_type'               => $payment_type,
                'total_amount'               => $total_amount,
                'discount_amount'            => $discount_amount,
                'discounted_total'           => $discounted_total,
                'max_emi_count'              => $payment_type == 'EMI' ? (int)$max_emi : null,
                'split_type'                 => $payment_type == 'EMI' ? $split_type : null,
                'property_payment_scheduler_remarks' => $remarks,
            );

            if ($existing) {
                $scheduler_id = $existing->property_payment_scheduler_id;
                $this->Property_reservation_model->update_payment($scheduler_id, $payment_data);
                $this->Property_reservation_model->delete_installments($scheduler_id);
            } else {
                $payment_data['property_payment_scheduler_created_by_userid'] = $this->currentuserid;
                $payment_data['property_payment_scheduler_created_datetime']  = date('Y-m-d H:i:s');
                $payment_data['property_payment_scheduler_status'] = 1;
                $scheduler_id = $this->Property_reservation_model->save_payment($payment_data);
            }

            $this->_build_installments($scheduler_id, $payment_type, $discounted_total, $split_type);
        }

        echo json_encode(array('error' => false, 'message' => 'Reservation confirmation saved successfully'));
    }

    private function _build_installments($scheduler_id, $payment_type, $total_amount, $split_type)
    {
        if ($payment_type == 'FULL') {
            $cutoff_date = $this->_date($this->input->post('cutoff_date'));
            $this->Property_reservation_model->save_installment(array(
                'property_payment_scheduler_id_fk' => $scheduler_id,
                'installment_number'   => 1,
                'installment_amount'   => $total_amount,
                'installment_percentage' => 100,
                'calculated_amount'    => $total_amount,
                'due_date'             => $cutoff_date ? $cutoff_date : date('Y-m-d'),
                'payment_status'       => 'PENDING',
                'paid_amount'          => 0,
                'installment_status'   => 1,
            ));
            return;
        }

        // EMI
        $emi_amounts      = $this->input->post('emi_amount');
        $emi_percentages  = $this->input->post('emi_percentage');
        $emi_due_dates    = $this->input->post('emi_due_date');

        if (is_array($emi_due_dates)) {
            for ($i = 0; $i < count($emi_due_dates); $i++) {
                if ($split_type == 'AMOUNT') {
                    $calculated = isset($emi_amounts[$i]) ? (float)$emi_amounts[$i] : 0;
                } else {
                    $pct = isset($emi_percentages[$i]) ? (float)$emi_percentages[$i] : 0;
                    $calculated = ($total_amount * $pct) / 100;
                }

                $this->Property_reservation_model->save_installment(array(
                    'property_payment_scheduler_id_fk' => $scheduler_id,
                    'installment_number'   => ($i + 1),
                    'installment_amount'   => isset($emi_amounts[$i]) ? $emi_amounts[$i] : null,
                    'installment_percentage' => isset($emi_percentages[$i]) ? $emi_percentages[$i] : null,
                    'calculated_amount'    => $calculated,
                    'due_date'             => $this->_date($emi_due_dates[$i]),
                    'payment_status'       => 'PENDING',
                    'paid_amount'          => 0,
                    'installment_status'   => 1,
                ));
            }
        }
    }

    // =========================================================
    // LEVEL 3: Re-confirmation
    // =========================================================

    public function save_reconfirmation()
    {
        if (!has_permission('PROPERTY_RESERVATION')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied: Property Reservation'));
            return;
        }

        $id = (int)$this->input->post('property_reservation_id');
        if ($id <= 0) {
            echo json_encode(array('error' => true, 'message' => 'Reservation not found'));
            return;
        }

        $data = array(
            'reconfirmation_cnfm_by'        => $this->input->post('reconfirmation_cnfm_by'),
            'reconfirmation_cnfm_no'        => $this->input->post('reconfirmation_cnfm_no'),
            'reconfirmation_date'           => $this->_date($this->input->post('reconfirmation_date')),
            'reconfirmation_status'         => 'RECONFIRMED',
            'reconfirmation_done_by_userid' => $this->currentuserid,
            'reconfirmation_done_datetime'  => date('Y-m-d H:i:s'),
        );

        $this->Property_reservation_model->update_reservation($id, $data);
        echo json_encode(array('error' => false, 'message' => 'Re-confirmation saved successfully'));
    }

    // =========================================================
    // COMMENTS
    // =========================================================

    public function add_comment()
    {
        if (!has_permission('PROPERTY_RESERVATION')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied: Property Reservation'));
            return;
        }

        $id   = (int)$this->input->post('property_reservation_id');
        $text = trim($this->input->post('comment_text'));

        if ($id <= 0 || $text === '') {
            echo json_encode(array('error' => true, 'message' => 'Comment is empty'));
            return;
        }

        $this->Property_reservation_model->add_comment(array(
            'property_reservation_id_fk' => $id,
            'comment_text'               => $text,
            'comment_created_by_userid'  => $this->currentuserid,
            'comment_created_date'       => date('Y-m-d H:i:s'),
            'comment_status'             => 1,
        ));

        $comments = $this->Property_reservation_model->get_comments($id);
        echo json_encode(array('error' => false, 'message' => 'Comment added', 'comments' => $comments));
    }

    // =========================================================
    // PAYMENT helpers
    // =========================================================

    public function get_quotation_amount()
    {
        $quotation_id = (int)$this->input->post('quotation_id');
        $amount = $this->Property_reservation_model->get_quotation_total_amount($quotation_id);
        echo json_encode(array('total_amount' => $amount));
    }

    // =========================================================
    // QUOTE HUB: property status panel
    // =========================================================

    public function ajax_property_status()
    {
        $quotation_id = (int)$this->input->post('quotation_id');
        $summary = $this->Property_reservation_model->get_status_summary($quotation_id);
        echo json_encode(array('status' => true, 'data' => $summary));
    }

    // =========================================================
    // PAYMENT RECORDING (like Receipt Scheduler)
    // =========================================================

    public function ajax_get_payment_summary()
    {
        $scheduler_id = (int)$this->input->post('scheduler_id');
        $summary = $this->Property_reservation_model->get_payment_summary_by_scheduler($scheduler_id);
        if (!$summary) {
            echo json_encode(array('error' => true, 'message' => 'Not found'));
            return;
        }
        echo json_encode(array('error' => false, 'data' => $summary));
    }

    public function ajax_record_payment()
    {
        $installment_id  = (int)$this->input->post('installment_id');
        $scheduler_id    = (int)$this->input->post('scheduler_id');
        $payment_amount  = (float)$this->input->post('payment_amount');
        $payment_date    = $this->_date($this->input->post('payment_date'));
        $payment_method  = $this->input->post('payment_method');
        $payment_ref     = $this->input->post('payment_reference');
        $payment_remarks = $this->input->post('payment_remarks');

        $installment = $this->Property_reservation_model->get_installment_by_id($installment_id);
        if (!$installment) {
            echo json_encode(array('error' => true, 'message' => 'Installment not found'));
            return;
        }

        $payment_id = $this->Property_reservation_model->save_payment_txn(array(
            'installment_id_fk'                  => $installment_id,
            'property_payment_scheduler_id_fk'   => $scheduler_id,
            'payment_amount'                     => $payment_amount,
            'payment_date'                       => $payment_date ?: date('Y-m-d'),
            'payment_method'                     => $payment_method,
            'payment_reference'                  => $payment_ref,
            'payment_remarks'                    => $payment_remarks,
            'payment_paid_by_userid'             => $this->currentuserid,
            'payment_paid_by_username'           => $this->currentusername,
            'payment_status'                     => 1,
        ));

        if ($payment_id) {
            $new_paid = (float)$installment->paid_amount + $payment_amount;
            $new_status = $new_paid >= (float)$installment->calculated_amount ? 'PAID' : 'PARTIAL';
            $this->Property_reservation_model->update_installment($installment_id, array(
                'paid_amount'        => $new_paid,
                'paid_date'          => $payment_date ?: date('Y-m-d'),
                'payment_status'     => $new_status,
                'payment_reference'  => $payment_ref,
                'payment_method'     => $payment_method,
            ));
            echo json_encode(array('error' => false, 'message' => 'Payment recorded successfully'));
        } else {
            echo json_encode(array('error' => true, 'message' => 'Failed to record payment'));
        }
    }

    public function ajax_get_installment_payments()
    {
        $installment_id = (int)$this->input->post('installment_id');
        $payments = $this->Property_reservation_model->get_payments_by_installment_id($installment_id);
        echo json_encode(array('error' => false, 'payments' => $payments));
    }

    public function print_receipt($payment_id = null)
    {
        if (!$payment_id) {
            $payment_id = $this->input->get('payment_id');
        }
        $payment = $this->Property_reservation_model->get_payment_by_id($payment_id);
        if (!$payment) {
            show_404();
            return;
        }
        $installment = $this->Property_reservation_model->get_installment_by_id($payment->installment_id_fk);
        $scheduler   = $this->Property_reservation_model->get_scheduler_with_details($payment->property_payment_scheduler_id_fk);
        $data = array(
            'payment'     => $payment,
            'installment' => $installment,
            'scheduler'   => $scheduler,
        );
        $this->load->view('Property_reservation/receipt', $data);
    }

    // =========================================================
    // Helpers
    // =========================================================

    private function _date($value)
    {
        if (empty($value)) { return null; }
        $ts = strtotime(str_replace('/', '-', $value));
        return $ts ? date('Y-m-d', $ts) : null;
    }
}
?>
