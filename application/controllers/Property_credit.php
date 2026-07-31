<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Property Credit Ledger
 *
 * Manages property credit entries created from cancellations and their
 * application to future bookings. Coexists with the existing supplier
 * refund workflow — PROPERTY_CREDIT is an additional refund mode.
 */
class Property_credit extends MY_Controller {

    public $page = 'Property Credit';

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
        $this->load->model('Property_credit_model');
        $this->load->model('Property_reservation_model');
    }

    // =========================================================
    // PAGE
    // =========================================================

    public function index()
    {
        if (!has_permission('PROPERTY_CREDIT_VIEW')) {
            show_error('Permission denied: Property Credit', 403);
            return;
        }

        $template['properties'] = $this->Property_credit_model->get_properties_with_credits();
        $template['body']       = 'Property_credit/report';
        $template['script']     = 'Property_credit/report_script';

        $this->load->view('template', $template);
    }

    // =========================================================
    // AJAX: READ
    // =========================================================

    public function ajax_get_available_credits()
    {
        if (!has_permission('PROPERTY_CREDIT_VIEW')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $properties_id = (int)$this->input->post('properties_id');

        if ($properties_id <= 0) {
            $this->_json(false, 'Property ID is required');
            return;
        }

        $credits = $this->Property_credit_model->get_available_credits($properties_id);

        $this->_json(true, '', array('credits' => $credits));
    }

    public function ajax_get_credit_detail()
    {
        if (!has_permission('PROPERTY_CREDIT_VIEW')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $credit_id = (int)$this->input->post('property_credit_id');

        $credit = $this->Property_credit_model->get_credit($credit_id);
        if (!$credit) {
            $this->_json(false, 'Credit not found');
            return;
        }

        $applications = $this->Property_credit_model->get_applications_for_credit($credit_id);

        $this->_json(true, '', array(
            'credit'       => $credit,
            'applications' => $applications,
        ));
    }

    public function ajax_get_credit_history()
    {
        if (!has_permission('PROPERTY_CREDIT_VIEW')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $properties_id = (int)$this->input->post('properties_id');

        if ($properties_id <= 0) {
            $this->_json(false, 'Property ID is required');
            return;
        }

        $history = $this->Property_credit_model->get_credit_history($properties_id);

        $this->_json(true, '', array('history' => $history));
    }

    public function ajax_get_credit_summary()
    {
        if (!has_permission('PROPERTY_CREDIT_VIEW')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $properties_id = (int)$this->input->post('properties_id');

        if ($properties_id <= 0) {
            $this->_json(false, 'Property ID is required');
            return;
        }

        $summary = $this->Property_credit_model->get_credit_summary($properties_id);

        $this->_json(true, '', array('summary' => $summary));
    }

    public function ajax_get_applied_credits()
    {
        if (!has_permission('PROPERTY_CREDIT_VIEW')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $quotation_id = (int)$this->input->post('quotation_id');

        if ($quotation_id <= 0) {
            $this->_json(false, 'Quotation ID is required');
            return;
        }

        $applications = $this->Property_credit_model->get_applications_for_quotation($quotation_id);
        $total_used   = $this->Property_credit_model->sum_applications_for_quotation($quotation_id);

        $this->_json(true, '', array(
            'applications' => $applications,
            'total_used'   => $total_used,
        ));
    }

    // =========================================================
    // AJAX: APPLY CREDIT
    // =========================================================

    public function ajax_apply_credit()
    {
        if (!has_permission('PROPERTY_CREDIT_APPLY') && !has_permission('RESERVATION_EDIT')) {
            $this->_json(false, 'Permission denied: Apply Property Credit');
            return;
        }

        $credit_id       = (int)$this->input->post('property_credit_id');
        $quotation_id    = (int)$this->input->post('quotation_id');
        $reservation_id  = (int)$this->input->post('property_reservation_id');
        $applied_amount  = (float)$this->input->post('applied_amount');

        $errors = array();
        if ($credit_id <= 0)        { $errors[] = 'Credit ID is required'; }
        if ($quotation_id <= 0)     { $errors[] = 'Quotation ID is required'; }
        if ($applied_amount <= 0)   { $errors[] = 'Applied amount must be greater than zero'; }

        if ($errors) {
            $this->_json(false, implode('. ', $errors));
            return;
        }

        $credit = $this->Property_credit_model->get_credit($credit_id);
        if (!$credit) {
            $this->_json(false, 'Credit not found');
            return;
        }

        if (!in_array($credit->credit_status, array('AVAILABLE', 'PARTIALLY_USED'))) {
            $this->_json(false, 'This credit is ' . $credit->credit_status . ' and cannot be applied');
            return;
        }

        $remaining = (float)$credit->remaining_amount;
        if ($applied_amount > $remaining + 0.009) {
            $this->_json(false, 'Applied amount exceeds remaining credit ('
                . number_format($remaining, 2) . ')');
            return;
        }

        /* Check expiry */
        if ($credit->expiry_date && $credit->expiry_date !== '0000-00-00'
            && strtotime($credit->expiry_date) < strtotime(date('Y-m-d'))) {
            $this->_json(false, 'This credit has expired');
            return;
        }

        $application_type = ($applied_amount >= $remaining - 0.009) ? 'FULL' : 'PARTIAL';

        $this->db->trans_begin();

        $app_id = $this->Property_credit_model->insert_application(array(
            'property_credit_id_fk'      => $credit_id,
            'quotation_id_fk'            => $quotation_id,
            'property_reservation_id_fk' => $reservation_id > 0 ? $reservation_id : null,
            'properties_id_fk'           => (int)$credit->properties_id_fk,
            'applied_amount'             => round($applied_amount, 2),
            'application_type'           => $application_type,
            'applied_by_userid'          => $this->currentuserid,
            'applied_by_username'        => $this->currentusername,
            'applied_datetime'           => date('Y-m-d H:i:s'),
            'credit_application_status'  => 1,
        ));

        $this->Property_credit_model->recalculate_credit($credit_id);

        /* Record a payment transaction against the installment so the
           credit shows up in the Property Payment Schedule. */
        if ($reservation_id > 0) {
            $payment = $this->Property_reservation_model->get_payment_by_reservation($reservation_id);
            if ($payment) {
                $installments = $this->Property_reservation_model->get_installments($payment->property_payment_scheduler_id);
                if ($installments && count($installments) > 0) {
                    $inst = $installments[0];
                    $this->Property_reservation_model->save_payment_txn(array(
                        'installment_id_fk'                => $inst->installment_id,
                        'property_payment_scheduler_id_fk' => $payment->property_payment_scheduler_id,
                        'payment_amount'                   => round($applied_amount, 2),
                        'payment_date'                     => date('Y-m-d'),
                        'payment_method'                   => 'PROPERTY_CREDIT',
                        'payment_reference'                => 'Credit #' . $credit_id,
                        'payment_remarks'                  => 'Property credit applied from Credit #' . $credit_id
                                                             . ' (CAN ' . ($credit->cancellation_number || '-') . ')',
                        'payment_paid_by_userid'           => $this->currentuserid,
                        'payment_status'                   => 1,
                    ));

                    $new_paid = (float)$inst->paid_amount + $applied_amount;
                    $new_status = $new_paid >= (float)$inst->calculated_amount ? 'PAID' : 'PARTIAL';
                    $this->Property_reservation_model->update_installment($inst->installment_id, array(
                        'paid_amount'    => $new_paid,
                        'paid_date'      => date('Y-m-d'),
                        'payment_status' => $new_status,
                        'payment_reference' => 'Credit #' . $credit_id,
                        'payment_method'    => 'PROPERTY_CREDIT',
                    ));
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not apply the credit');
            return;
        }

        $this->db->trans_commit();

        $updated = $this->Property_credit_model->get_credit($credit_id);

        $this->_json(true, 'Property credit applied', array(
            'credit'    => $updated,
            'remaining' => (float)$updated->remaining_amount,
        ));
    }

    // =========================================================
    // AJAX: REVERSE APPLICATION
    // =========================================================

    public function ajax_reverse_credit_application()
    {
        if (!has_permission('PROPERTY_CREDIT_REVERSE') && !has_permission('CANCELLATION_SETTLE')) {
            $this->_json(false, 'Permission denied: Reverse Credit Application');
            return;
        }

        $application_id = (int)$this->input->post('credit_application_id');
        $reason         = trim((string)$this->input->post('reversal_reason'));

        if ($reason === '') {
            $this->_json(false, 'A reason is required to reverse a credit application');
            return;
        }

        $application = $this->Property_credit_model->get_application($application_id);
        if (!$application) {
            $this->_json(false, 'Credit application not found');
            return;
        }

        if ((int)$application->reversed === 1) {
            $this->_json(false, 'This application has already been reversed');
            return;
        }

        $this->db->trans_begin();

        $this->db->where('credit_application_id', $application_id);
        $this->db->update($this->Property_credit_model->table_application, array(
            'reversed'             => 1,
            'reversed_by_userid'   => $this->currentuserid,
            'reversed_by_username' => $this->currentusername,
            'reversed_datetime'    => date('Y-m-d H:i:s'),
            'reversal_reason'      => $reason,
        ));

        $this->Property_credit_model->recalculate_credit($application->property_credit_id_fk);

        /* Reverse the payment transaction that was created when the credit was applied. */
        $reservation_id = (int)$application->property_reservation_id_fk;
        $applied_amount = (float)$application->applied_amount;
        if ($reservation_id > 0) {
            $payment = $this->Property_reservation_model->get_payment_by_reservation($reservation_id);
            if ($payment) {
                /* Mark the PROPERTY_CREDIT payment txn as deleted */
                $this->db->where('property_payment_scheduler_id_fk', $payment->property_payment_scheduler_id);
                $this->db->where('payment_method', 'PROPERTY_CREDIT');
                $this->db->where('payment_reference', 'Credit #' . $application->property_credit_id_fk);
                $this->db->where('payment_status', 1);
                $this->db->update('property_payment_scheduler_payments', array('payment_status' => 0));

                /* Recalculate installment paid_amount from remaining active payments */
                $installments = $this->Property_reservation_model->get_installments($payment->property_payment_scheduler_id);
                if ($installments && count($installments) > 0) {
                    $inst = $installments[0];
                    $active_payments = $this->db
                        ->select_sum('payment_amount')
                        ->from('property_payment_scheduler_payments')
                        ->where('installment_id_fk', $inst->installment_id)
                        ->where('payment_status', 1)
                        ->get()
                        ->row();
                    $new_paid = (float)($active_payments->payment_amount ?? 0);
                    $new_status = $new_paid >= (float)$inst->calculated_amount ? 'PAID' : ($new_paid > 0 ? 'PARTIAL' : 'PENDING');
                    $this->Property_reservation_model->update_installment($inst->installment_id, array(
                        'paid_amount'    => $new_paid,
                        'payment_status' => $new_status,
                    ));
                }
            }
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not reverse the credit application');
            return;
        }

        $this->db->trans_commit();

        $updated = $this->Property_credit_model->get_credit($application->property_credit_id_fk);

        $this->_json(true, 'Credit application reversed', array(
            'credit' => $updated,
        ));
    }

    // =========================================================
    // AJAX: EXPIRE / CANCEL CREDIT
    // =========================================================

    public function ajax_expire_credit()
    {
        if (!has_permission('PROPERTY_CREDIT_REVERSE')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $credit_id = (int)$this->input->post('property_credit_id');
        $reason    = trim((string)$this->input->post('reason'));

        if ($reason === '') {
            $this->_json(false, 'A reason is required');
            return;
        }

        $credit = $this->Property_credit_model->get_credit($credit_id);
        if (!$credit) {
            $this->_json(false, 'Credit not found');
            return;
        }

        if (!in_array($credit->credit_status, array('AVAILABLE', 'PARTIALLY_USED'))) {
            $this->_json(false, 'Only available or partially used credits can be expired');
            return;
        }

        $this->Property_credit_model->update_credit($credit_id, array(
            'credit_status' => 'EXPIRED',
            'remarks'       => trim($credit->remarks . "\n[Expired: " . $reason . ']'),
        ));

        $this->_json(true, 'Credit marked as expired');
    }

    public function ajax_cancel_credit()
    {
        if (!has_permission('PROPERTY_CREDIT_REVERSE')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $credit_id = (int)$this->input->post('property_credit_id');
        $reason    = trim((string)$this->input->post('reason'));

        if ($reason === '') {
            $this->_json(false, 'A reason is required');
            return;
        }

        $credit = $this->Property_credit_model->get_credit($credit_id);
        if (!$credit) {
            $this->_json(false, 'Credit not found');
            return;
        }

        if ((float)$credit->used_amount > 0.009) {
            $this->_json(false, 'Cannot cancel a credit that has been partially used. Reverse the applications first.');
            return;
        }

        $this->Property_credit_model->update_credit($credit_id, array(
            'credit_status' => 'CANCELLED',
            'remarks'       => trim($credit->remarks . "\n[Cancelled: " . $reason . ']'),
        ));

        $this->_json(true, 'Credit cancelled');
    }

    // =========================================================
    // DATATABLES: report
    // =========================================================

    public function get()
    {
        if (!has_permission('PROPERTY_CREDIT_REPORT')) {
            echo json_encode(array('status' => false, 'message' => 'Permission denied'));
            return;
        }

        $param = $this->input->post();
        $result = $this->Property_credit_model->getCreditTable($param);

        echo json_encode($result);
    }

    public function ajax_get_report_totals()
    {
        if (!has_permission('PROPERTY_CREDIT_REPORT')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $param  = $this->input->post();
        $totals = $this->Property_credit_model->get_report_totals($param);

        $this->_json(true, '', $totals);
    }

    // =========================================================
    // HELPERS
    // =========================================================

    private function _json($status, $message = '', $data = null)
    {
        $this->output
            ->set_content_type('application/json')
            ->set_output(json_encode(array(
                'status'  => (bool)$status,
                'message' => $message,
                'data'    => $data,
            )));
    }
}
