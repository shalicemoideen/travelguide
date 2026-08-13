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
        $this->load->model('Property_credit_model');
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
        $has_payments = false;
        if ($installments) {
            foreach ($installments as $inst) {
                if (floatval($inst->paid_amount) > 0) { $has_payments = true; break; }
            }
        }
        $comments     = $this->Property_reservation_model->get_comments($reservation->property_reservation_id);
        $total_amount = $this->Property_reservation_model->get_property_total_amount($quotation_id, $properties_id);
        $rent_breakdown    = $this->Property_reservation_model->get_property_rent_breakdown($quotation_id, $properties_id);
        $inclusions_detail = $this->Property_reservation_model->get_property_inclusions_detail($quotation_id, $properties_id);

        /* A property the client has swapped out no longer has active
           confirmation rows, so the live total collapses to 0. Fall back to the
           amount snapshotted at the moment it was superseded. */
        if ($reservation->reservation_state !== 'ACTIVE' && $reservation->snap_reservation_amount !== null) {
            $total_amount = (float)$reservation->snap_reservation_amount;
        }

        /* Property credit detection: check for available credits on this property */
        $available_credits = array();
        $applied_credits   = array();
        if ($this->db->table_exists('property_credit_ledger')) {
            $available_credits = $this->Property_credit_model->get_available_credits($properties_id);
            $applied_credits   = $this->Property_credit_model->get_applications_for_property($quotation_id, $properties_id);
        }

        echo json_encode(array(
            'status'            => true,
            'reservation'       => $reservation,
            'payment'           => $payment,
            'installments'      => $installments,
            'has_payments'      => $has_payments,
            'comments'          => $comments,
            'total_amount'      => $total_amount,
            'rent_breakdown'    => $rent_breakdown,
            'inclusions_detail' => $inclusions_detail,
            'available_credits' => $available_credits,
            'applied_credits'   => $applied_credits,
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

        $reservation = $this->Property_reservation_model->get_reservation_by_id($id);
        $blocking_cutoff_date = $this->_date($this->input->post('blocking_cutoff_date'));
        $blocking_date = $this->_date($this->input->post('blocking_date'));

        $data = array(
            'blocking_cnfm_by'        => $this->input->post('blocking_cnfm_by'),
            'blocking_cutoff_date'    => $blocking_cutoff_date ?: ($reservation ? $reservation->check_in_date : date('Y-m-d')),
            'blocking_date'           => $blocking_date ?: date('Y-m-d'),
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
        $max_emi      = min(24, max(2, (int)$this->input->post('max_emi_count')));
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

            /* Rebuilding installments soft-deletes the previous ones, which
               orphans any payments already recorded against them (e.g. a
               property credit applied before confirmation). Re-point those
               payments to the new installments and recompute paid amounts so
               they stay in the payment history. */
            $this->_relink_orphan_payments($scheduler_id);
        }

        echo json_encode(array('error' => false, 'message' => 'Reservation confirmation saved successfully'));
    }

    /**
     * Re-attach active payment transactions (whose installment was soft-deleted
     * during an installment rebuild) to the first current installment, then
     * recompute paid_amount / payment_status for every active installment.
     */
    private function _relink_orphan_payments($scheduler_id)
    {
        $installments = $this->Property_reservation_model->get_installments($scheduler_id);
        if (!$installments || count($installments) === 0) { return; }

        $payments = $this->db
            ->from('property_payment_scheduler_payments')
            ->where('property_payment_scheduler_id_fk', (int)$scheduler_id)
            ->where('payment_status', 1)
            ->get()
            ->result();
        if (!$payments) { return; }

        $valid_ids = array();
        foreach ($installments as $inst) { $valid_ids[$inst->installment_id] = true; }

        $first = $installments[0];
        foreach ($payments as $p) {
            if (!isset($valid_ids[$p->installment_id_fk])) {
                $this->db->where('payment_id', $p->payment_id);
                $this->db->update('property_payment_scheduler_payments',
                    array('installment_id_fk' => $first->installment_id));
            }
        }

        foreach ($installments as $inst) {
            $sum = $this->db
                ->select_sum('payment_amount')
                ->from('property_payment_scheduler_payments')
                ->where('installment_id_fk', $inst->installment_id)
                ->where('payment_status', 1)
                ->get()
                ->row();
            $paid = $sum && $sum->payment_amount ? (float)$sum->payment_amount : 0;
            if ($paid <= 0) {
                $status = 'PENDING';
            } elseif ($paid >= (float)$inst->calculated_amount) {
                $status = 'PAID';
            } else {
                $status = 'PARTIAL';
            }
            $this->Property_reservation_model->update_installment($inst->installment_id, array(
                'paid_amount'    => round($paid, 2),
                'paid_date'      => $paid > 0 ? date('Y-m-d') : null,
                'payment_status' => $status,
            ));
        }
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
            for ($i = 0; $i < min(24, count($emi_due_dates)); $i++) {
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

        $reservation = $this->Property_reservation_model->get_reservation_by_id($id);
        $reconfirmation_date = $this->_date($this->input->post('reconfirmation_date'));

        $data = array(
            'reconfirmation_cnfm_by'        => $this->input->post('reconfirmation_cnfm_by'),
            'reconfirmation_cnfm_no'        => $reservation ? $reservation->confirmation_cnfm_no : '',
            'reconfirmation_date'           => $reconfirmation_date ?: date('Y-m-d'),
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

        $scheduler = $this->Property_reservation_model->get_scheduler_with_details($scheduler_id);
        if ($scheduler) {
            $summary['scheduler'] = $scheduler;
            $summary['scheduler']->properties_name = $this->_get_property_name_by_reservation($scheduler->property_reservation_id_fk);
        }

        echo json_encode(array('error' => false, 'data' => $summary));
    }

    public function property_payments_report()
    {
        if (!has_permission('PROPERTY_PAYMENTS_REPORT')) {
            show_permission_denied();
            return;
        }
        $template['body']   = 'Property_reservation/payments_report';
        $template['script'] = 'Property_reservation/payments_report_script';
        $this->load->view('template', $template);
    }

    public function get_property_scheduler_report_table()
    {
        if (!has_permission('PROPERTY_PAYMENTS_REPORT')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied'));
            return;
        }

        $param = array(
            'quotation_number_filter' => $this->input->post('quotation_number_filter'),
            'guest_name_filter' => $this->input->post('guest_name_filter'),
            'property_name_filter' => $this->input->post('property_name_filter'),
            'payment_type_filter' => $this->input->post('payment_type_filter'),
            'travel_date_start' => $this->input->post('travel_date_start'),
            'travel_date_end' => $this->input->post('travel_date_end'),
            'start' => $this->input->post('start'),
            'length' => $this->input->post('length'),
        );

        $result = $this->Property_reservation_model->getPropertySchedulerReportTable($param);
        echo json_encode($result);
    }

    public function get_property_payment_summary()
    {
        if (!has_permission('PROPERTY_PAYMENTS_REPORT') && !has_permission('PROPERTY_RESERVATION') && !has_permission('PAYMENT_REPORT')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied'));
            return;
        }

        $scheduler_id = (int)$this->input->post('scheduler_id');
        $summary = $this->Property_reservation_model->get_payment_summary_by_scheduler($scheduler_id);
        if (!$summary) {
            echo json_encode(array('error' => true, 'message' => 'Payment schedule not found'));
            return;
        }

        $scheduler = $this->Property_reservation_model->get_scheduler_with_details($scheduler_id);
        if ($scheduler) {
            $summary['payment'] = $scheduler;
            $summary['payment']->properties_name = $this->_get_property_name_by_reservation($scheduler->property_reservation_id_fk);
        }

        echo json_encode($summary);
    }

    public function get_property_scheduler_by_quotation()
    {
        $quotation_id = (int)$this->input->post('quotation_id');
        if (!$quotation_id) {
            echo json_encode(array('error' => true, 'message' => 'Quotation ID required'));
            return;
        }

        $rows = $this->db
            ->select('property_payment_scheduler_id')
            ->from('property_payment_scheduler')
            ->where('quotation_id_fk', $quotation_id)
            ->where('property_payment_scheduler_status', 1)
            ->order_by('property_payment_scheduler_id', 'DESC')
            ->get()
            ->result();

        if ($rows) {
            $ids = array();
            foreach ($rows as $r) {
                $ids[] = $r->property_payment_scheduler_id;
            }
            echo json_encode(array('property_payment_scheduler_ids' => $ids));
        } else {
            echo json_encode(array('error' => true, 'message' => 'No property scheduler found'));
        }
    }

    private function _get_property_name_by_reservation($reservation_id)
    {
        if (!$reservation_id) return '';
        $this->load->model('Property_reservation_model');
        $row = $this->db->select('p.properties_name')
            ->from('property_reservation pr')
            ->join('properties p', 'p.properties_id = pr.properties_id_fk', 'left')
            ->where('pr.property_reservation_id', (int)$reservation_id)
            ->get()->row();
        return $row ? $row->properties_name : '';
    }

    public function get_property_payments_report_table()
    {
        if (!has_permission('PROPERTY_PAYMENTS_REPORT')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied'));
            return;
        }

        $param = array(
            'start_date'  => $this->_payment_date($this->input->post('start_date')),
            'end_date'    => $this->_payment_date($this->input->post('end_date')),
            'quotation_number_filter' => $this->input->post('quotation_number_filter'),
            'guest_name_filter' => $this->input->post('guest_name_filter'),
            'property_name_filter' => $this->input->post('property_name_filter'),
            'payment_type_filter' => $this->input->post('payment_type_filter'),
            'installment_number_filter' => $this->input->post('installment_number_filter'),
            'status_filter' => $this->input->post('status_filter'),
            'start' => $this->input->post('start'),
            'length' => $this->input->post('length'),
        );

        $result = $this->Property_reservation_model->getPropertyPaymentsReportTable($param);
        echo json_encode($result);
    }

    public function ajax_record_payment()
    {
        if (!has_permission('PROPERTY_RESERVATION') && !has_permission('PROPERTY_PAYMENTS_REPORT') && !has_permission('PAYMENT_REPORT')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied: Property Reservation'));
            return;
        }

        $installment_id  = (int)$this->input->post('installment_id');
        $scheduler_id    = (int)$this->input->post('scheduler_id');
        $payment_amount  = (float)$this->input->post('payment_amount');
        $payment_date    = $this->_payment_date($this->input->post('payment_date'));
        $payment_method  = $this->input->post('payment_method');
        $payment_ref     = $this->input->post('payment_reference');
        $payment_remarks = $this->input->post('payment_remarks');

        if (!$payment_date) {
            echo json_encode(array('error' => true, 'message' => 'Please enter a valid payment date in dd/mm/yyyy format'));
            return;
        }

        $installment = $this->Property_reservation_model->get_installment_by_id($installment_id);
        if (!$installment) {
            echo json_encode(array('error' => true, 'message' => 'Installment not found'));
            return;
        }

        $upload = $this->_upload_payment_slip();
        if (!$upload['status']) {
            echo json_encode(array('error' => true, 'message' => $upload['message']));
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
            'payment_slip'                       => $upload['filename'],
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

    private function _upload_payment_slip()
    {
        if (empty($_FILES['payment_slip']['name'])) {
            return array('status' => false, 'message' => 'Payment slip is required');
        }

        $config = array(
            'upload_path' => FCPATH . 'uploads/payment_slips/',
            'allowed_types' => 'jpg|jpeg|png|pdf',
            'max_size' => 20480,
            'encrypt_name' => true,
        );

        if (!is_dir($config['upload_path'])) {
            @mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload('payment_slip')) {
            return array('status' => false, 'message' => $this->upload->display_errors('', ''));
        }

        $file = $this->upload->data();
        return array('status' => true, 'filename' => $file['file_name']);
    }

    public function ajax_get_installment_payments()
    {
        if (!has_permission('PROPERTY_RESERVATION') && !has_permission('PROPERTY_PAYMENTS_REPORT') && !has_permission('PAYMENT_REPORT')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied: Property Reservation'));
            return;
        }
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
    // PROPERTY CREDIT DETECTION
    // =========================================================

    public function ajax_get_available_credits()
    {
        $properties_id = (int)$this->input->post('properties_id');

        if ($properties_id <= 0) {
            echo json_encode(array('status' => false, 'message' => 'Property ID is required'));
            return;
        }

        if (!$this->db->table_exists('property_credit_ledger')) {
            echo json_encode(array('status' => true, 'credits' => array()));
            return;
        }

        $credits = $this->Property_credit_model->get_available_credits($properties_id);
        echo json_encode(array('status' => true, 'credits' => $credits));
    }

    // =========================================================
    // PROPERTY CHANGE: superseded reservations
    // =========================================================

    /**
     * Reservations kept after the client changed property on the confirmation
     * page. These no longer appear in any confirmation-driven query, so the
     * page loads them separately to keep the money spent on them visible.
     */
    public function ajax_get_superseded_reservations()
    {
        $quotation_id = (int)$this->input->post('quotation_id');

        if ($quotation_id <= 0) {
            echo json_encode(array('status' => false, 'message' => 'Booking is required'));
            return;
        }

        $rows = $this->Property_reservation_model->get_superseded_reservations($quotation_id);

        // Surface the credit already raised so the UI can show it instead of
        // offering the cancel action a second time.
        $has_credit_table = $this->db->table_exists('property_credit_ledger');
        foreach ($rows as $r) {
            $r->property_credit = $has_credit_table
                ? $this->Property_credit_model->get_credit_for_property_change($r->property_reservation_id)
                : null;
        }

        echo json_encode(array(
            'status'    => true,
            'rows'      => $rows,
            'can_cancel'=> has_permission('PROPERTY_RESERVATION_CANCEL'),
        ));
    }

    /**
     * Cancel a superseded property reservation and push the manually entered
     * recoverable amount into the existing property credit ledger.
     *
     * The reservation is never deleted — it moves to CANCELLED and keeps its
     * snapshotted amounts, its payment scheduler and its payment history, so
     * the trail from reservation to cancellation to credit stays auditable.
     */
    public function ajax_cancel_reservation()
    {
        if (!has_permission('PROPERTY_RESERVATION_CANCEL')) {
            echo json_encode(array('status' => false, 'message' => 'Permission denied: Cancel Property Reservation'));
            return;
        }

        $reservation_id      = (int)$this->input->post('property_reservation_id');
        $cancellation_amount = (float)$this->input->post('cancellation_amount');
        $cancellation_date   = $this->_date($this->input->post('cancellation_date'));
        $reason              = trim((string)$this->input->post('cancellation_reason'));
        $reference           = trim((string)$this->input->post('reference_number'));
        $expiry_date         = $this->_date($this->input->post('credit_expiry_date'));

        $reservation = $reservation_id > 0
            ? $this->Property_reservation_model->get_reservation_by_id($reservation_id)
            : null;

        if (!$reservation || (int)$reservation->property_reservation_status !== 1) {
            echo json_encode(array('status' => false, 'message' => 'Reservation not found'));
            return;
        }

        if ($reservation->reservation_state === 'CANCELLED') {
            echo json_encode(array('status' => false, 'message' => 'This reservation is already cancelled'));
            return;
        }

        if ($reservation->reservation_state !== 'SUPERSEDED') {
            echo json_encode(array(
                'status'  => false,
                'message' => 'Only a property that has been replaced on the confirmation can be cancelled here'
            ));
            return;
        }

        /* The recoverable amount cannot exceed what was actually paid to the
           property — the credit has to be money the property is holding. */
        $paid = $reservation->snap_paid_amount !== null
            ? (float)$reservation->snap_paid_amount
            : $this->Property_reservation_model->get_paid_total($reservation_id);

        /* Nothing was paid, so the property holds nothing for us. Such
           reservations are not offered for cancellation in the UI; reject a
           direct call too rather than creating a meaningless zero credit. */
        if ($paid <= 0) {
            echo json_encode(array(
                'status'  => false,
                'message' => 'No amount has been paid to this property, so there is nothing to cancel or credit'
            ));
            return;
        }

        $errors = array();
        if ($cancellation_amount < 0)  { $errors[] = 'Cancellation amount cannot be negative'; }
        if (!$cancellation_date)       { $errors[] = 'Valid cancellation date is required'; }

        if ($cancellation_amount > $paid + 0.009) {
            $errors[] = 'Cancellation amount cannot exceed the amount paid to this property ('
                      . number_format($paid, 2) . ')';
        }

        if ($errors) {
            echo json_encode(array('status' => false, 'message' => implode('. ', $errors)));
            return;
        }

        $credit_supported = $this->db->table_exists('property_credit_ledger');

        if ($cancellation_amount > 0.009 && $credit_supported) {
            $existing = $this->Property_credit_model->get_credit_for_property_change($reservation_id);
            if ($existing) {
                echo json_encode(array(
                    'status'  => false,
                    'message' => 'A property credit has already been recorded for this reservation'
                ));
                return;
            }
        }

        $this->db->trans_begin();

        $this->Property_reservation_model->update_reservation($reservation_id, array(
            'reservation_state'     => 'CANCELLED',
            'cancellation_amount'   => round($cancellation_amount, 2),
            'cancellation_date'     => $cancellation_date,
            'cancellation_reason'   => $reason,
            'cancelled_by_userid'   => $this->currentuserid,
            'cancelled_by_username' => $this->currentusername,
            'cancelled_datetime'    => date('Y-m-d H:i:s'),
        ));

        /* Reuse the cancellation module's ledger rather than a parallel one.
           credit_origin distinguishes this from a booking cancellation, and the
           two cancellation FKs stay NULL because no booking was cancelled. */
        $credit_id = null;
        if ($cancellation_amount > 0.009 && $credit_supported) {
            $credit_id = $this->Property_credit_model->create_credit(array(
                'properties_id_fk'                  => (int)$reservation->properties_id_fk,
                'booking_cancellation_id_fk'        => null,
                'cancellation_property_id_fk'       => null,
                'property_reservation_id_fk'        => $reservation_id,
                'property_change_reservation_id_fk' => $reservation_id,
                'quotation_id_fk'                   => (int)$reservation->quotation_id_fk,
                'credit_origin'                     => 'PROPERTY_CHANGE',
                'credit_amount'                     => round($cancellation_amount, 2),
                'used_amount'                       => 0.00,
                'remaining_amount'                  => round($cancellation_amount, 2),
                'credit_status'                     => 'AVAILABLE',
                'expiry_date'                       => $expiry_date,
                'reference_number'                  => $reference,
                'remarks'                           => $reason,
                'created_by_userid'                 => $this->currentuserid,
                'created_by_username'               => $this->currentusername,
                'created_datetime'                  => date('Y-m-d H:i:s'),
                'property_credit_status'            => 1,
            ));
        }

        $this->Property_reservation_model->add_comment(array(
            'property_reservation_id_fk' => $reservation_id,
            'comment_text'               => 'Reservation cancelled after property change. Cancellation amount: '
                                            . number_format($cancellation_amount, 2)
                                            . ($reason !== '' ? '. Reason: ' . $reason : ''),
            'comment_created_by_userid'  => $this->currentuserid,
            'comment_created_date'       => date('Y-m-d H:i:s'),
            'comment_status'             => 1,
        ));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode(array('status' => false, 'message' => 'Could not cancel the reservation'));
            return;
        }

        $this->db->trans_commit();

        $message = 'Reservation cancelled.';
        if ($credit_id) {
            $message .= ' Property credit of ' . number_format($cancellation_amount, 2) . ' recorded.';
        } elseif ($cancellation_amount > 0.009 && !$credit_supported) {
            $message .= ' Property credit ledger is not installed, so no credit was recorded.';
        }

        echo json_encode(array(
            'status'            => true,
            'message'           => $message,
            'property_credit_id'=> $credit_id,
        ));
    }

    // =========================================================
    // Helpers
    // =========================================================

    private function _payment_date($value)
    {
        $date = DateTime::createFromFormat('!d/m/Y', trim($value));
        return $date && $date->format('d/m/Y') === trim($value) ? $date->format('Y-m-d') : null;
    }

    private function _date($value)
    {
        if (empty($value)) { return null; }
        $ts = strtotime(str_replace('/', '-', $value));
        return $ts ? date('Y-m-d', $ts) : null;
    }
}
?>
