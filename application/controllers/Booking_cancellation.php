<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Booking Cancellation
 *
 * The only existing table this controller writes to is `quotation`
 * (quotation_current_status -> 6) at the moment of approval. Everything else
 * lives in the booking_cancellation_* tables.
 *
 * Refund rows are append-only: corrections are contra rows, never UPDATE/DELETE.
 */
class Booking_cancellation extends MY_Controller {

    public $page = 'Booking Cancellation';

    /* Header statuses in which the worksheet may still be edited */
    private $editable_statuses = array('DRAFT', 'PENDING_APPROVAL');

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
        $this->load->model('Booking_cancellation_model');
        $this->load->model('Property_credit_model');
    }

    // =========================================================
    // PAGES
    // =========================================================

    public function index($quotation_id = null)
    {
        if (!has_permission('BOOKING_CANCELLATION_VIEW')) {
            show_permission_denied();
            return;
        }

        $template['bookings']            = $this->Booking_cancellation_model->get_eligible_bookings();
        $template['reasons']             = $this->Booking_cancellation_model->get_reasons();
        $template['staff']               = $this->Booking_cancellation_model->fetch_staff();
        $template['preselect_quotation'] = $quotation_id ? (int)$quotation_id : 0;
        $template['body']                = 'Booking_cancellation/list';
        $template['script']              = 'Booking_cancellation/script';

        $this->load->view('template', $template);
    }

    public function detail($id = null)
    {
        if (!has_permission('BOOKING_CANCELLATION_VIEW')) {
            show_permission_denied();
            return;
        }

        $id = (int)$id;
        $header = $this->Booking_cancellation_model->get_header($id);

        if (!$header) {
            show_404();
            return;
        }

        $template['cancellation_id'] = $id;
        $template['header']          = $header;
        $template['reasons']         = $this->Booking_cancellation_model->get_reasons();
        $template['body']            = 'Booking_cancellation/detail';
        $template['script']          = 'Booking_cancellation/detail_script';

        $this->load->view('template', $template);
    }

    public function tracker()
    {
        if (!has_permission('BOOKING_CANCELLATION_TRACKER')) {
            show_permission_denied();
            return;
        }

        $template['properties'] = $this->Booking_cancellation_model->get_properties_with_cancellations();
        $template['body']       = 'Booking_cancellation/tracker';
        $template['script']     = 'Booking_cancellation/tracker_script';

        $this->load->view('template', $template);
    }

    public function customer_refund_register()
    {
        if (!has_permission('BOOKING_CANCELLATION_REPORT')) {
            show_permission_denied();
            return;
        }

        $template['body']   = 'Booking_cancellation/customer_refund_register';
        $template['script'] = 'Booking_cancellation/customer_refund_register_script';

        $this->load->view('template', $template);
    }

    // =========================================================
    // AJAX: READ
    // =========================================================

    public function ajax_check_eligibility()
    {
        $quotation_id = (int)$this->input->post('quotation_id');
        $result = $this->Booking_cancellation_model->check_eligibility($quotation_id);

        $this->_json(true, '', $result);
    }

    public function ajax_get_worksheet()
    {
        $quotation_id = (int)$this->input->post('quotation_id');

        if ($quotation_id <= 0) {
            $this->_json(false, 'Please select a booking');
            return;
        }

        $eligibility = $this->Booking_cancellation_model->check_eligibility($quotation_id);
        if (!$eligibility['eligible']) {
            $this->_json(false, implode('. ', $eligibility['blockers']), $eligibility);
            return;
        }

        $worksheet = $this->Booking_cancellation_model->build_worksheet($quotation_id);
        if (!$worksheet) {
            $this->_json(false, 'Booking not found');
            return;
        }

        /* Default suggested retention = supplier charges are unknown at this
           point, so start from what we have already paid out. Staff overrides
           it in step 3 once hotel charges are entered. */
        $worksheet['suggested_customer_charge'] = round(
            (float)$worksheet['supplier_paid'] + (float)$worksheet['service_paid'], 2
        );

        $this->_json(true, '', $worksheet);
    }

    public function ajax_get_cancellation()
    {
        $id   = (int)$this->input->post('booking_cancellation_id');

        /* While still editable, pull the latest paid/received figures from the
           live booking into the draft snapshot so payments recorded after the
           draft was created are reflected. recalculate() no-ops the resync once
           the cancellation is APPROVED. */
        $header = $this->Booking_cancellation_model->get_header($id);
        if ($header && in_array($header->cancellation_status, array('DRAFT', 'PENDING_APPROVAL'))) {
            $this->db->trans_begin();
            $this->Booking_cancellation_model->recalculate($id);
            if ($this->db->trans_status() === FALSE) {
                $this->db->trans_rollback();
            } else {
                $this->db->trans_commit();
            }
        }

        $data = $this->Booking_cancellation_model->get_full($id);

        if (!$data) {
            $this->_json(false, 'Cancellation not found');
            return;
        }

        $data['summary']     = $this->Booking_cancellation_model->get_summary($id);
        $data['permissions'] = $this->_permission_flags();

        $this->_json(true, '', $data);
    }

    public function ajax_get_summary()
    {
        $id      = (int)$this->input->post('booking_cancellation_id');
        $summary = $this->Booking_cancellation_model->get_summary($id);

        if (!$summary) {
            $this->_json(false, 'Cancellation not found');
            return;
        }

        $this->_json(true, '', $summary);
    }

    // =========================================================
    // AJAX: LIFECYCLE
    // =========================================================

    public function ajax_create_draft()
    {
        if (!has_permission('BOOKING_CANCELLATION_CREATE')) {
            $this->_json(false, 'Permission denied: Create Cancellation');
            return;
        }

        $quotation_id  = (int)$this->input->post('quotation_id');
        $reason_id     = (int)$this->input->post('cancellation_reason_id_fk');
        $request_date  = $this->_date($this->input->post('cancellation_request_date'));
        $effective_date = $this->_date($this->input->post('cancellation_effective_date'));
        $scope         = $this->input->post('cancellation_scope') === 'PARTIAL' ? 'PARTIAL' : 'FULL';
        $notes         = trim((string)$this->input->post('cancellation_reason_notes'));
        $selected      = $this->input->post('property_reservation_ids');

        $errors = array();
        if ($quotation_id <= 0)  { $errors[] = 'Please select a booking'; }
        if ($reason_id <= 0)     { $errors[] = 'Cancellation reason is required'; }
        if (!$request_date)      { $errors[] = 'Valid request date is required'; }
        if (!$effective_date)    { $errors[] = 'Valid effective date is required'; }

        if ($errors) {
            $this->_json(false, implode('. ', $errors));
            return;
        }

        $eligibility = $this->Booking_cancellation_model->check_eligibility($quotation_id);
        if (!$eligibility['eligible']) {
            $this->_json(false, implode('. ', $eligibility['blockers']));
            return;
        }

        $worksheet = $this->Booking_cancellation_model->build_worksheet($quotation_id);
        if (!$worksheet) {
            $this->_json(false, 'Booking not found');
            return;
        }

        $booking  = $worksheet['booking'];
        $customer = $worksheet['customer'];

        /* Restrict property lines when the cancellation is partial */
        $properties = $worksheet['properties'];
        if ($scope === 'PARTIAL' && is_array($selected) && !empty($selected)) {
            $selected = array_map('intval', $selected);
            $properties = array_values(array_filter($properties, function ($p) use ($selected) {
                return in_array((int)$p['property_reservation_id'], $selected);
            }));

            if (empty($properties)) {
                $this->_json(false, 'Select at least one property for a partial cancellation');
                return;
            }
        }

        $supplier_booked = 0.0;
        $supplier_paid   = 0.0;
        foreach ($properties as $p) {
            $supplier_booked += (float)$p['reservation_amount'];
            $supplier_paid   += (float)$p['amount_paid'];
        }

        $days_before = null;
        if (!empty($booking->start_date) && $booking->start_date !== '0000-00-00') {
            $days_before = (int)floor(
                (strtotime($booking->start_date) - strtotime($effective_date)) / 86400
            );
        }

        $now = date('Y-m-d H:i:s');

        $this->db->trans_begin();

        $header = array(
            'cancellation_number'         => $this->Booking_cancellation_model->generate_cancellation_number(),
            'quotation_id_fk'             => $quotation_id,
            'leads_id_fk'                 => (int)$booking->leads_id_fk,
            'cancellation_scope'          => $scope,
            'cancellation_reason_id_fk'   => $reason_id,
            'cancellation_reason_notes'   => $notes,
            'cancellation_request_date'   => $request_date,
            'cancellation_effective_date' => $effective_date,
            'travel_start_date'           => (!empty($booking->start_date) && $booking->start_date !== '0000-00-00')
                                                ? $booking->start_date : null,
            'days_before_travel'          => $days_before,

            'snap_package_value'          => $customer['package_value'],
            'snap_customer_received'      => $customer['received'],
            'snap_customer_outstanding'   => $customer['outstanding'],

            'snap_supplier_booked'        => round($supplier_booked, 2),
            'snap_supplier_paid'          => round($supplier_paid, 2),

            'cancellation_status'         => 'DRAFT',
            'previous_quotation_status'   => (int)$booking->quotation_current_status,
            'requested_by_userid'         => $this->currentuserid,
            'requested_by_username'       => $this->currentusername,
            'booking_cancellation_created_datetime' => $now,
            'booking_cancellation_status' => 1,
        );

        $cancellation_id = $this->Booking_cancellation_model->insert_header($header);

        if (!$cancellation_id) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not create the cancellation record');
            return;
        }

        foreach ($properties as $p) {
            $this->Booking_cancellation_model->insert_property_line(array(
                'booking_cancellation_id_fk'       => $cancellation_id,
                'property_reservation_id_fk'       => $p['property_reservation_id'],
                'properties_id_fk'                => $p['properties_id'],
                'property_payment_scheduler_id_fk' => $p['property_payment_scheduler_id'],
                'snap_property_name'              => $p['properties_name'],
                'snap_check_in_date'              => $p['check_in_date'],
                'snap_check_out_date'             => $p['check_out_date'],
                'snap_duration_nights'            => $p['duration_nights'],
                'snap_confirmation_number'        => $p['confirmation_number'],
                'snap_cutoff_date'                => $p['cutoff_date'],
                'snap_reservation_amount'         => $p['reservation_amount'],
                'snap_amount_paid'                => $p['amount_paid'],
                'snap_outstanding_payable'        => $p['outstanding'],
                /* Never blocked with the hotel -> nothing is recoverable or owed */
                'line_status'                     => $p['blocking_status'] === 'PENDING'
                                                        ? 'NO_REFUND_DUE' : 'PENDING_INTIMATION',
                'cancellation_property_created_datetime' => $now,
                'cancellation_property_status'    => 1,
            ));
        }

        foreach ($worksheet['services'] as $s) {
            $this->Booking_cancellation_model->insert_service_line(array(
                'booking_cancellation_id_fk' => $cancellation_id,
                'service_type'               => $s['service_type'],
                'source_table'               => $s['source_table'],
                'source_row_id'              => $s['source_row_id'],
                'vendor_name'                => $s['vendor_name'],
                'service_description'        => $s['service_description'],
                'snap_service_amount'        => $s['service_amount'],
                'snap_amount_paid'           => $s['amount_paid'],
                'cancellation_service_created_datetime' => $now,
                'cancellation_service_status' => 1,
            ));
        }

        $this->Booking_cancellation_model->recalculate($cancellation_id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not create the cancellation record');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Cancellation draft created', array(
            'booking_cancellation_id' => $cancellation_id,
            'summary'                 => $this->Booking_cancellation_model->get_summary($cancellation_id),
        ));
    }

    public function ajax_update_draft()
    {
        $cancellation = $this->_load_editable('BOOKING_CANCELLATION_CREATE');
        if (!$cancellation) { return; }

        $reason_id      = (int)$this->input->post('cancellation_reason_id_fk');
        $request_date   = $this->_date($this->input->post('cancellation_request_date'));
        $effective_date = $this->_date($this->input->post('cancellation_effective_date'));
        $notes          = trim((string)$this->input->post('cancellation_reason_notes'));

        if ($reason_id <= 0 || !$request_date || !$effective_date) {
            $this->_json(false, 'Reason, request date and effective date are required');
            return;
        }

        $days_before = null;
        if (!empty($cancellation->travel_start_date) && $cancellation->travel_start_date !== '0000-00-00') {
            $days_before = (int)floor(
                (strtotime($cancellation->travel_start_date) - strtotime($effective_date)) / 86400
            );
        }

        $this->Booking_cancellation_model->update_header($cancellation->booking_cancellation_id, array(
            'cancellation_reason_id_fk'   => $reason_id,
            'cancellation_request_date'   => $request_date,
            'cancellation_effective_date' => $effective_date,
            'cancellation_reason_notes'   => $notes,
            'days_before_travel'          => $days_before,
        ));

        $this->_json(true, 'Cancellation updated', array(
            'summary' => $this->Booking_cancellation_model->recalculate($cancellation->booking_cancellation_id),
        ));
    }

    public function ajax_submit_for_approval()
    {
        $cancellation = $this->_load_editable('BOOKING_CANCELLATION_CREATE');
        if (!$cancellation) { return; }

        if ($cancellation->cancellation_status !== 'DRAFT') {
            $this->_json(false, 'Only a draft can be submitted for approval');
            return;
        }

        if (empty($cancellation->cancellation_reason_id_fk)) {
            $this->_json(false, 'Cancellation reason is required before submitting');
            return;
        }

        $this->Booking_cancellation_model->update_header($cancellation->booking_cancellation_id, array(
            'cancellation_status' => 'PENDING_APPROVAL',
        ));

        $this->_json(true, 'Submitted for approval', array(
            'cancellation_status' => 'PENDING_APPROVAL',
        ));
    }

    /**
     * The single point where the booking status actually flips to 6.
     */
    public function ajax_approve_cancellation()
    {
        if (!has_permission('BOOKING_CANCELLATION_APPROVE')) {
            $this->_json(false, 'Permission denied: Approve Cancellation');
            return;
        }

        $id = (int)$this->input->post('booking_cancellation_id');

        $this->db->trans_begin();

        /* Lock both rows so a concurrent approve/cancel cannot interleave */
        $cancellation = $this->db->query(
            'SELECT * FROM booking_cancellation WHERE booking_cancellation_id = ? FOR UPDATE',
            array($id)
        )->row();

        if (!$cancellation) {
            $this->db->trans_rollback();
            $this->_json(false, 'Cancellation not found');
            return;
        }

        if ($cancellation->cancellation_status === 'APPROVED'
            || $cancellation->cancellation_status === 'SETTLED') {
            /* Idempotent: a double-click must not error or double-apply */
            $this->db->trans_commit();
            $this->_json(true, 'Cancellation is already approved', array(
                'summary' => $this->Booking_cancellation_model->get_summary($id),
            ));
            return;
        }

        if ($cancellation->cancellation_status !== 'PENDING_APPROVAL') {
            $this->db->trans_rollback();
            $this->_json(false, 'Only a cancellation pending approval can be approved');
            return;
        }

        if ($this->currentuserid == $cancellation->requested_by_userid
            && $this->currentusertype !== 'A') {
            $this->db->trans_rollback();
            $this->_json(false, 'A cancellation cannot be approved by the same user who requested it');
            return;
        }

        $quotation = $this->db->query(
            'SELECT quotation_id, quotation_current_status FROM quotation WHERE quotation_id = ? FOR UPDATE',
            array($cancellation->quotation_id_fk)
        )->row();

        if (!$quotation) {
            $this->db->trans_rollback();
            $this->_json(false, 'Booking not found');
            return;
        }

        $now = date('Y-m-d H:i:s');

        /* Capture the final live paid/received figures before the snapshot is
           frozen by the status change below. */
        $this->Booking_cancellation_model->resync_snapshots($id);

        $this->Booking_cancellation_model->update_header($id, array(
            'cancellation_status'       => 'APPROVED',
            'previous_quotation_status' => (int)$quotation->quotation_current_status,
            'approved_by_userid'        => $this->currentuserid,
            'approved_by_username'      => $this->currentusername,
            'approved_datetime'         => $now,
        ));

        /* The one and only mutation of an existing table */
        $this->db->where('quotation_id', $cancellation->quotation_id_fk);
        $this->db->update('quotation', array('quotation_current_status' => 6));

        $this->Booking_cancellation_model->recalculate($id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not approve the cancellation');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Cancellation approved. Booking marked as Cancelled.', array(
            'summary' => $this->Booking_cancellation_model->get_summary($id),
        ));
    }

    public function ajax_reject_cancellation()
    {
        if (!has_permission('BOOKING_CANCELLATION_APPROVE')) {
            $this->_json(false, 'Permission denied: Approve Cancellation');
            return;
        }

        $id     = (int)$this->input->post('booking_cancellation_id');
        $reason = trim((string)$this->input->post('rejected_reason'));

        if ($reason === '') {
            $this->_json(false, 'Rejection reason is required');
            return;
        }

        $cancellation = $this->Booking_cancellation_model->get_header($id);
        if (!$cancellation) {
            $this->_json(false, 'Cancellation not found');
            return;
        }

        if (!in_array($cancellation->cancellation_status, array('DRAFT', 'PENDING_APPROVAL'))) {
            $this->_json(false, 'Only a draft or pending cancellation can be rejected');
            return;
        }

        $this->Booking_cancellation_model->update_header($id, array(
            'cancellation_status' => 'REJECTED',
            'rejected_reason'     => $reason,
            'approved_by_userid'  => $this->currentuserid,
            'approved_by_username' => $this->currentusername,
            'approved_datetime'   => date('Y-m-d H:i:s'),
        ));

        $this->_json(true, 'Cancellation rejected');
    }

    /**
     * Un-cancel. Blocked once any money has moved -- raise a fresh booking instead.
     */
    public function ajax_reverse_cancellation()
    {
        if (!has_permission('BOOKING_CANCELLATION_REVERSE')) {
            $this->_json(false, 'Permission denied: Reverse Cancellation');
            return;
        }

        $id     = (int)$this->input->post('booking_cancellation_id');
        $reason = trim((string)$this->input->post('reversed_reason'));

        if ($reason === '') {
            $this->_json(false, 'Reversal reason is required');
            return;
        }

        $cancellation = $this->Booking_cancellation_model->get_header($id);
        if (!$cancellation) {
            $this->_json(false, 'Cancellation not found');
            return;
        }

        if (!in_array($cancellation->cancellation_status, array('APPROVED', 'SETTLED'))) {
            $this->_json(false, 'Only an approved cancellation can be reversed');
            return;
        }

        if ((float)$cancellation->customer_refund_paid != 0.0) {
            $this->_json(false, 'Cannot reverse: customer refunds have already been paid. Create a new booking instead.');
            return;
        }

        if ((float)$cancellation->supplier_refund_received != 0.0) {
            $this->_json(false, 'Cannot reverse: supplier refunds have already been received. Create a new booking instead.');
            return;
        }

        $restore_to = $cancellation->previous_quotation_status
                        ? (int)$cancellation->previous_quotation_status : 5;

        $this->db->trans_begin();

        $this->Booking_cancellation_model->update_header($id, array(
            'cancellation_status'   => 'REVERSED',
            'reversed_by_userid'    => $this->currentuserid,
            'reversed_by_username'  => $this->currentusername,
            'reversed_reason'       => $reason,
            'reversed_datetime'     => date('Y-m-d H:i:s'),
        ));

        $this->db->where('quotation_id', $cancellation->quotation_id_fk);
        $this->db->update('quotation', array('quotation_current_status' => $restore_to));

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not reverse the cancellation');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Cancellation reversed. Booking restored to '
            . $this->Booking_cancellation_model->status_label($restore_to) . '.');
    }

    // =========================================================
    // AJAX: CUSTOMER MONEY
    // =========================================================

    public function ajax_save_customer_charge()
    {
        if (!has_permission('BOOKING_CANCELLATION_CHARGE')) {
            $this->_json(false, 'Permission denied: Set Cancellation Charge');
            return;
        }

        $id       = (int)$this->input->post('booking_cancellation_id');
        $charge   = (float)$this->input->post('customer_cancellation_charge');
        $override = $this->input->post('customer_charge_is_override') ? 1 : 0;
        $note     = trim((string)$this->input->post('customer_charge_override_note'));

        $cancellation = $this->Booking_cancellation_model->get_header($id);
        if (!$cancellation) {
            $this->_json(false, 'Cancellation not found');
            return;
        }

        if (in_array($cancellation->cancellation_status, array('REJECTED', 'REVERSED'))) {
            $this->_json(false, 'This cancellation is closed and cannot be changed');
            return;
        }

        if ($charge < 0) {
            $this->_json(false, 'Cancellation charge cannot be negative');
            return;
        }

        if ($override && $note === '') {
            $this->_json(false, 'A justification is required when overriding the suggested charge');
            return;
        }

        /* Reducing the charge below what has already been refunded would make
           the ledger inconsistent. */
        $new_due = (float)$cancellation->snap_customer_received - $charge;
        if ((float)$cancellation->customer_refund_paid > $new_due + 0.009) {
            $this->_json(false, 'Charge too high: refunds already paid ('
                . number_format((float)$cancellation->customer_refund_paid, 2)
                . ') would exceed the refund due (' . number_format($new_due, 2) . ')');
            return;
        }

        $this->Booking_cancellation_model->update_header($id, array(
            'customer_cancellation_charge'  => round($charge, 2),
            'customer_charge_is_override'   => $override,
            'customer_charge_override_note' => $note,
        ));

        $this->_json(true, 'Customer cancellation charge saved', array(
            'summary' => $this->Booking_cancellation_model->recalculate($id),
        ));
    }

    public function ajax_add_customer_refund()
    {
        if (!has_permission('BOOKING_CANCELLATION_REFUND_CUSTOMER')) {
            $this->_json(false, 'Permission denied: Record Customer Refund');
            return;
        }

        $id      = (int)$this->input->post('booking_cancellation_id');
        $amount  = (float)$this->input->post('refund_amount');
        $date    = $this->_date($this->input->post('refund_date'));
        $mode    = trim((string)$this->input->post('refund_mode'));
        $ref     = trim((string)$this->input->post('refund_reference'));
        $bank    = trim((string)$this->input->post('refund_bank_account'));
        $remarks = trim((string)$this->input->post('refund_remarks'));

        $cancellation = $this->Booking_cancellation_model->get_header($id);
        if (!$cancellation) {
            $this->_json(false, 'Cancellation not found');
            return;
        }

        if (!in_array($cancellation->cancellation_status, array('APPROVED', 'SETTLED'))) {
            $this->_json(false, 'Refunds can only be recorded on an approved cancellation');
            return;
        }

        $errors = array();
        if ($amount <= 0) { $errors[] = 'Refund amount must be greater than zero'; }
        if (!$date)       { $errors[] = 'Valid refund date is required'; }
        if ($mode === '') { $errors[] = 'Refund mode is required'; }

        if ($errors) {
            $this->_json(false, implode('. ', $errors));
            return;
        }

        $due       = (float)$cancellation->customer_refund_due;
        $paid      = (float)$cancellation->customer_refund_paid;
        $remaining = round($due - $paid, 2);

        if ($remaining <= 0.009) {
            $this->_json(false, 'Nothing left to refund. Add an adjustment first if an extra payout is genuinely required.');
            return;
        }

        if ($amount > $remaining + 0.009) {
            $this->_json(false, 'Refund exceeds the balance due (' . number_format($remaining, 2) . ')');
            return;
        }

        $proof = null;
        if (!empty($_FILES['refund_proof_file']['name'])) {
            $upload = $this->_upload_proof('refund_proof_file');
            if (!$upload['status']) {
                $this->_json(false, $upload['message']);
                return;
            }
            $proof = $upload['filename'];
        }

        $this->db->trans_begin();

        $this->Booking_cancellation_model->insert_customer_refund(array(
            'booking_cancellation_id_fk' => $id,
            'quotation_id_fk'            => (int)$cancellation->quotation_id_fk,
            'refund_amount'              => round($amount, 2),
            'refund_date'                => $date,
            'refund_mode'                => $mode,
            'refund_reference'           => $ref,
            'refund_bank_account'        => $bank,
            'refund_remarks'             => $remarks,
            'refund_proof_file'          => $proof,
            'refund_entry_type'          => 'REFUND',
            'accountant_approval_status' => 'pending',
            'refund_paid_by_userid'      => $this->currentuserid,
            'refund_paid_by_username'    => $this->currentusername,
            'customer_refund_created_datetime' => date('Y-m-d H:i:s'),
            'customer_refund_status'     => 1,
        ));

        $summary = $this->Booking_cancellation_model->recalculate($id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not record the refund');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Customer refund recorded', array('summary' => $summary));
    }

    public function ajax_reverse_customer_refund()
    {
        if (!has_permission('BOOKING_CANCELLATION_REFUND_REVERSE')) {
            $this->_json(false, 'Permission denied: Reverse Refund');
            return;
        }

        $refund_id = (int)$this->input->post('customer_refund_id');
        $reason    = trim((string)$this->input->post('refund_remarks'));

        if ($reason === '') {
            $this->_json(false, 'A reason is required to reverse a refund');
            return;
        }

        $refund = $this->Booking_cancellation_model->get_customer_refund($refund_id);
        if (!$refund || (int)$refund->customer_refund_status !== 1) {
            $this->_json(false, 'Refund entry not found');
            return;
        }

        if ($refund->refund_entry_type === 'REVERSAL') {
            $this->_json(false, 'A reversal entry cannot itself be reversed');
            return;
        }

        $already = $this->Booking_cancellation_model->sum_reversed_amount(
            'booking_cancellation_customer_refund', 'customer_refund_id', $refund_id
        );

        if ($already >= (float)$refund->refund_amount - 0.009) {
            $this->_json(false, 'This refund has already been fully reversed');
            return;
        }

        $this->db->trans_begin();

        $this->Booking_cancellation_model->insert_customer_refund(array(
            'booking_cancellation_id_fk' => (int)$refund->booking_cancellation_id_fk,
            'quotation_id_fk'            => (int)$refund->quotation_id_fk,
            'refund_amount'              => round((float)$refund->refund_amount - $already, 2),
            'refund_date'                => date('Y-m-d'),
            'refund_mode'                => $refund->refund_mode,
            'refund_reference'           => $refund->refund_reference,
            'refund_remarks'             => 'Reversal of refund #' . $refund_id . ': ' . $reason,
            'refund_entry_type'          => 'REVERSAL',
            'reverses_refund_id_fk'      => $refund_id,
            'accountant_approval_status' => 'approved',
            'accountant_approved_by_userid'   => $this->currentuserid,
            'accountant_approved_by_username' => $this->currentusername,
            'accountant_approved_at'     => date('Y-m-d H:i:s'),
            'refund_paid_by_userid'      => $this->currentuserid,
            'refund_paid_by_username'    => $this->currentusername,
            'customer_refund_created_datetime' => date('Y-m-d H:i:s'),
            'customer_refund_status'     => 1,
        ));

        $summary = $this->Booking_cancellation_model->recalculate($refund->booking_cancellation_id_fk);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not reverse the refund');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Refund reversed', array('summary' => $summary));
    }

    public function ajax_approve_customer_refund()
    {
        if (!has_permission('BOOKING_CANCELLATION_REFUND_APPROVE')) {
            $this->_json(false, 'Permission denied: Approve Refund');
            return;
        }

        $refund_id = (int)$this->input->post('customer_refund_id');
        $decision  = $this->input->post('decision') === 'rejected' ? 'rejected' : 'approved';

        $refund = $this->Booking_cancellation_model->get_customer_refund($refund_id);
        if (!$refund || (int)$refund->customer_refund_status !== 1) {
            $this->_json(false, 'Refund entry not found');
            return;
        }

        if ($refund->accountant_approval_status !== 'pending') {
            $this->_json(false, 'This refund has already been reviewed');
            return;
        }

        $this->Booking_cancellation_model->approve_customer_refund($refund_id, array(
            'accountant_approval_status'      => $decision,
            'accountant_approved_by_userid'   => $this->currentuserid,
            'accountant_approved_by_username' => $this->currentusername,
            'accountant_approved_at'          => date('Y-m-d H:i:s'),
        ));

        $this->_json(true, 'Refund marked as ' . $decision, array(
            'summary' => $this->Booking_cancellation_model->get_summary($refund->booking_cancellation_id_fk),
        ));
    }

    // =========================================================
    // AJAX: SUPPLIER MONEY
    // =========================================================

    public function ajax_save_property_charge()
    {
        if (!has_permission('BOOKING_CANCELLATION_CHARGE')) {
            $this->_json(false, 'Permission denied: Set Cancellation Charge');
            return;
        }

        $line_id = (int)$this->input->post('cancellation_property_id');
        $line    = $this->Booking_cancellation_model->get_property_line($line_id);

        if (!$line) {
            $this->_json(false, 'Property line not found');
            return;
        }

        $charge     = (float)$this->input->post('cancellation_charge');
        $basis      = $this->input->post('charge_basis');
        $percentage = $this->input->post('charge_percentage');
        $cnfm_by    = trim((string)$this->input->post('charge_confirmed_by'));
        $cnfm_date  = $this->_date($this->input->post('charge_confirmed_date'));
        $expected_by = $this->_date($this->input->post('expected_refund_by_date'));
        $remarks    = trim((string)$this->input->post('line_remarks'));

        if ($charge < 0) {
            $this->_json(false, 'Cancellation charge cannot be negative');
            return;
        }

        $valid_basis = array('POLICY_SLAB', 'NEGOTIATED', 'FULL_RETENTION', 'NO_CHARGE', 'NO_SHOW');
        if (!in_array($basis, $valid_basis)) {
            $basis = 'NEGOTIATED';
        }

        /* Never let the charge drop below refunds already received back */
        $received = $this->Booking_cancellation_model->sum_property_refunds($line_id);
        $new_expected = max(0, (float)$line->snap_amount_paid - $charge);
        if ($received > $new_expected + 0.009) {
            $this->_json(false, 'Charge too high: refunds already received ('
                . number_format($received, 2) . ') would exceed the expected refund ('
                . number_format($new_expected, 2) . ')');
            return;
        }

        $proof = $line->charge_proof_file;
        if (!empty($_FILES['charge_proof_file']['name'])) {
            $upload = $this->_upload_proof('charge_proof_file');
            if (!$upload['status']) {
                $this->_json(false, $upload['message']);
                return;
            }
            $proof = $upload['filename'];
        }

        /* Default the refund SLA to 30 days from the cancellation date */
        if (!$expected_by && $new_expected > 0) {
            $header = $this->Booking_cancellation_model->get_header($line->booking_cancellation_id_fk);
            $base   = ($header && !empty($header->cancellation_effective_date))
                        ? $header->cancellation_effective_date : date('Y-m-d');
            $expected_by = date('Y-m-d', strtotime($base . ' +30 days'));
        }

        $update = array(
            'cancellation_charge'      => round($charge, 2),
            'charge_basis'             => $basis,
            'charge_percentage'        => ($percentage === '' || $percentage === null) ? null : (float)$percentage,
            'charge_confirmed_by'      => $cnfm_by,
            'charge_confirmed_date'    => $cnfm_date,
            'charge_proof_file'        => $proof,
            'expected_refund_by_date'  => $expected_by,
            'line_remarks'             => $remarks,
        );

        /* Move a fresh line forward out of the intimation stage */
        if ($cnfm_date && in_array($line->line_status, array('PENDING_INTIMATION', 'INTIMATED'))) {
            $update['line_status'] = 'CHARGE_CONFIRMED';
        }

        $this->db->trans_begin();

        $this->Booking_cancellation_model->update_property_line($line_id, $update);
        $summary = $this->Booking_cancellation_model->recalculate($line->booking_cancellation_id_fk);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not save the property charge');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Property cancellation charge saved', array('summary' => $summary));
    }

    public function ajax_add_property_refund()
    {
        if (!has_permission('BOOKING_CANCELLATION_REFUND_SUPPLIER')) {
            $this->_json(false, 'Permission denied: Record Supplier Refund');
            return;
        }

        $line_id = (int)$this->input->post('cancellation_property_id');
        $line    = $this->Booking_cancellation_model->get_property_line($line_id);

        if (!$line) {
            $this->_json(false, 'Property line not found');
            return;
        }

        $header = $this->Booking_cancellation_model->get_header($line->booking_cancellation_id_fk);
        if (!$header || !in_array($header->cancellation_status, array('APPROVED', 'SETTLED'))) {
            $this->_json(false, 'Refunds can only be recorded on an approved cancellation');
            return;
        }

        $amount   = (float)$this->input->post('refund_amount');
        $date     = $this->_date($this->input->post('refund_date'));
        $mode     = trim((string)$this->input->post('refund_mode'));
        $ref      = trim((string)$this->input->post('refund_reference'));
        $remarks  = trim((string)$this->input->post('refund_remarks'));
        $adjusted = (int)$this->input->post('adjusted_against_quotation_id');

        $errors = array();
        if ($amount <= 0) { $errors[] = 'Refund amount must be greater than zero'; }
        if (!$date)       { $errors[] = 'Valid refund date is required'; }
        if ($mode === '') { $errors[] = 'Refund mode is required'; }

        if ($errors) {
            $this->_json(false, implode('. ', $errors));
            return;
        }

        $expected  = (float)$line->refund_expected;
        $received  = $this->Booking_cancellation_model->sum_property_refunds($line_id);
        $remaining = round($expected - $received - (float)$line->amount_written_off, 2);

        if ($remaining <= 0.009) {
            $this->_json(false, 'No refund is outstanding on this property line');
            return;
        }

        if ($amount > $remaining + 0.009) {
            $this->_json(false, 'Refund exceeds the pending amount (' . number_format($remaining, 2) . ')');
            return;
        }

        $proof = null;
        if (!empty($_FILES['refund_proof_file']['name'])) {
            $upload = $this->_upload_proof('refund_proof_file');
            if (!$upload['status']) {
                $this->_json(false, $upload['message']);
                return;
            }
            $proof = $upload['filename'];
        }

        $this->db->trans_begin();

        $refund_id = $this->Booking_cancellation_model->insert_property_refund(array(
            'cancellation_property_id_fk'   => $line_id,
            'booking_cancellation_id_fk'    => (int)$line->booking_cancellation_id_fk,
            'properties_id_fk'              => (int)$line->properties_id_fk,
            'refund_amount'                 => round($amount, 2),
            'refund_date'                   => $date,
            'refund_mode'                   => $mode,
            'refund_reference'              => $ref,
            'refund_remarks'                => $remarks,
            'refund_proof_file'             => $proof,
            'refund_entry_type'             => 'REFUND',
            'adjusted_against_quotation_id' => $adjusted > 0 ? $adjusted : null,
            'refund_received_by_userid'     => $this->currentuserid,
            'refund_received_by_username'   => $this->currentusername,
            'property_refund_created_datetime' => date('Y-m-d H:i:s'),
            'property_refund_status'        => 1,
        ));

        /* When the property keeps the amount as future-booking credit,
           create a ledger entry so the credit can be tracked and applied. */
        if ($mode === 'PROPERTY_CREDIT') {

            $expiry = $this->_date($this->input->post('credit_expiry_date'));

            $this->Property_credit_model->create_credit(array(
                'properties_id_fk'            => (int)$line->properties_id_fk,
                'booking_cancellation_id_fk'  => (int)$line->booking_cancellation_id_fk,
                'cancellation_property_id_fk' => $line_id,
                'property_reservation_id_fk'  => (int)$line->property_reservation_id_fk > 0
                                                 ? (int)$line->property_reservation_id_fk : null,
                'quotation_id_fk'             => (int)$header->quotation_id_fk,
                'credit_amount'               => round($amount, 2),
                'used_amount'                 => 0.00,
                'remaining_amount'            => round($amount, 2),
                'credit_status'               => 'AVAILABLE',
                'expiry_date'                 => $expiry,
                'reference_number'            => $ref,
                'remarks'                     => $remarks,
                'created_by_userid'           => $this->currentuserid,
                'created_by_username'         => $this->currentusername,
                'created_datetime'            => date('Y-m-d H:i:s'),
                'property_credit_status'      => 1,
            ));
        }

        $summary = $this->Booking_cancellation_model->recalculate($line->booking_cancellation_id_fk);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not record the refund');
            return;
        }

        $this->db->trans_commit();

        $msg = ($mode === 'PROPERTY_CREDIT')
             ? 'Property credit recorded'
             : 'Supplier refund recorded';

        $this->_json(true, $msg, array('summary' => $summary));
    }

    public function ajax_reverse_property_refund()
    {
        if (!has_permission('BOOKING_CANCELLATION_REFUND_REVERSE')) {
            $this->_json(false, 'Permission denied: Reverse Refund');
            return;
        }

        $refund_id = (int)$this->input->post('property_refund_id');
        $reason    = trim((string)$this->input->post('refund_remarks'));

        if ($reason === '') {
            $this->_json(false, 'A reason is required to reverse a refund');
            return;
        }

        $refund = $this->Booking_cancellation_model->get_property_refund($refund_id);
        if (!$refund || (int)$refund->property_refund_status !== 1) {
            $this->_json(false, 'Refund entry not found');
            return;
        }

        if ($refund->refund_entry_type === 'REVERSAL') {
            $this->_json(false, 'A reversal entry cannot itself be reversed');
            return;
        }

        $already = $this->Booking_cancellation_model->sum_reversed_amount(
            'booking_cancellation_property_refund', 'property_refund_id', $refund_id
        );

        if ($already >= (float)$refund->refund_amount - 0.009) {
            $this->_json(false, 'This refund has already been fully reversed');
            return;
        }

        $this->db->trans_begin();

        $this->Booking_cancellation_model->insert_property_refund(array(
            'cancellation_property_id_fk' => (int)$refund->cancellation_property_id_fk,
            'booking_cancellation_id_fk'  => (int)$refund->booking_cancellation_id_fk,
            'properties_id_fk'            => (int)$refund->properties_id_fk,
            'refund_amount'               => round((float)$refund->refund_amount - $already, 2),
            'refund_date'                 => date('Y-m-d'),
            'refund_mode'                 => $refund->refund_mode,
            'refund_reference'            => $refund->refund_reference,
            'refund_remarks'              => 'Reversal of refund #' . $refund_id . ': ' . $reason,
            'refund_entry_type'           => 'REVERSAL',
            'reverses_refund_id_fk'       => $refund_id,
            'refund_received_by_userid'   => $this->currentuserid,
            'refund_received_by_username' => $this->currentusername,
            'property_refund_created_datetime' => date('Y-m-d H:i:s'),
            'property_refund_status'      => 1,
        ));

        /* If the original refund was a PROPERTY_CREDIT, cancel the
           corresponding ledger entry (only if not yet used). */
        if ($refund->refund_mode === 'PROPERTY_CREDIT') {
            $credits = $this->Property_credit_model->get_credits_for_cancellation(
                (int)$refund->booking_cancellation_id_fk
            );
            foreach ($credits as $cr) {
                if ((int)$cr->cancellation_property_id_fk === (int)$refund->cancellation_property_id_fk
                    && (float)$cr->credit_amount === (float)$refund->refund_amount
                    && (float)$cr->used_amount <= 0.009) {
                    $this->Property_credit_model->update_credit($cr->property_credit_id, array(
                        'credit_status' => 'CANCELLED',
                        'remarks'       => trim($cr->remarks
                            . "\n[Cancelled: reversal of refund #" . $refund_id . ' — ' . $reason . ']'),
                    ));
                }
            }
        }

        $summary = $this->Booking_cancellation_model->recalculate($refund->booking_cancellation_id_fk);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not reverse the refund');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Refund reversed', array('summary' => $summary));
    }

    public function ajax_mark_property_refused()
    {
        if (!has_permission('BOOKING_CANCELLATION_CHARGE')) {
            $this->_json(false, 'Permission denied: Set Cancellation Charge');
            return;
        }

        $line_id = (int)$this->input->post('cancellation_property_id');
        $reason  = trim((string)$this->input->post('refusal_reason'));

        if ($reason === '') {
            $this->_json(false, 'Refusal reason is required');
            return;
        }

        $line = $this->Booking_cancellation_model->get_property_line($line_id);
        if (!$line) {
            $this->_json(false, 'Property line not found');
            return;
        }

        $this->db->trans_begin();

        $this->Booking_cancellation_model->update_property_line($line_id, array(
            'line_status'     => 'REFUSED',
            'refusal_reason'  => $reason,
        ));

        $summary = $this->Booking_cancellation_model->recalculate($line->booking_cancellation_id_fk);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not update the property line');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Property marked as refund refused', array('summary' => $summary));
    }

    /**
     * Give up on the pending amount and book it as a loss.
     */
    public function ajax_write_off_property()
    {
        if (!has_permission('BOOKING_CANCELLATION_ADJUST')) {
            $this->_json(false, 'Permission denied: Adjustments');
            return;
        }

        $line_id = (int)$this->input->post('cancellation_property_id');
        $reason  = trim((string)$this->input->post('adjustment_reason'));

        if ($reason === '') {
            $this->_json(false, 'A reason is required to write off a pending refund');
            return;
        }

        $line = $this->Booking_cancellation_model->get_property_line($line_id);
        if (!$line) {
            $this->_json(false, 'Property line not found');
            return;
        }

        $pending = (float)$line->refund_pending;
        if ($pending <= 0.009) {
            $this->_json(false, 'Nothing is pending on this property line');
            return;
        }

        $this->db->trans_begin();

        $this->Booking_cancellation_model->update_property_line($line_id, array(
            'amount_written_off' => round((float)$line->amount_written_off + $pending, 2),
            'line_status'        => 'WRITTEN_OFF',
        ));

        $this->Booking_cancellation_model->insert_adjustment(array(
            'booking_cancellation_id_fk'   => (int)$line->booking_cancellation_id_fk,
            'adjustment_type'              => 'WRITE_OFF',
            'adjustment_side'              => 'SUPPLIER',
            'adjustment_direction'         => 'DEBIT',
            'adjustment_amount'            => round($pending, 2),
            'adjustment_reason'            => 'Write-off of unrecovered refund from '
                                              . $line->snap_property_name . ': ' . $reason,
            'related_property_id_fk'       => $line_id,
            'adjustment_created_by_userid' => $this->currentuserid,
            'adjustment_created_by_username' => $this->currentusername,
            'adjustment_created_datetime'  => date('Y-m-d H:i:s'),
            'cancellation_adjustment_status' => 1,
        ));

        $summary = $this->Booking_cancellation_model->recalculate($line->booking_cancellation_id_fk);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not write off the pending refund');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Pending refund written off', array('summary' => $summary));
    }

    public function ajax_log_property_followup()
    {
        if (!has_permission('BOOKING_CANCELLATION_VIEW')) {
            $this->_json(false, 'Permission denied');
            return;
        }

        $line_id = (int)$this->input->post('cancellation_property_id');
        $note    = trim((string)$this->input->post('followup_note'));

        $line = $this->Booking_cancellation_model->get_property_line($line_id);
        if (!$line) {
            $this->_json(false, 'Property line not found');
            return;
        }

        $existing = trim((string)$line->line_remarks);
        $entry    = '[' . date('d/m/Y') . ' ' . $this->currentusername . '] '
                    . ($note !== '' ? $note : 'Followed up with the property');

        $this->Booking_cancellation_model->update_property_line($line_id, array(
            'followup_count'     => (int)$line->followup_count + 1,
            'last_followup_date' => date('Y-m-d'),
            'line_remarks'       => $existing === '' ? $entry : $existing . "\n" . $entry,
        ));

        $this->_json(true, 'Follow-up logged');
    }

    // =========================================================
    // AJAX: SERVICES & ADJUSTMENTS
    // =========================================================

    public function ajax_save_service_line()
    {
        if (!has_permission('BOOKING_CANCELLATION_CHARGE')) {
            $this->_json(false, 'Permission denied: Set Cancellation Charge');
            return;
        }

        $service_id = (int)$this->input->post('cancellation_service_id');
        $cancellation_id = (int)$this->input->post('booking_cancellation_id');

        $amount      = (float)$this->input->post('snap_service_amount');
        $paid        = (float)$this->input->post('snap_amount_paid');
        $charge      = (float)$this->input->post('cancellation_charge');
        $received    = (float)$this->input->post('refund_received');
        $recoverable = $this->input->post('is_recoverable') ? 1 : 0;
        $remarks     = trim((string)$this->input->post('service_remarks'));

        if ($amount < 0 || $paid < 0 || $charge < 0 || $received < 0) {
            $this->_json(false, 'Amounts cannot be negative');
            return;
        }

        $data = array(
            'snap_service_amount' => round($amount, 2),
            'snap_amount_paid'    => round($paid, 2),
            'cancellation_charge' => round($charge, 2),
            'refund_received'     => round($received, 2),
            'is_recoverable'      => $recoverable,
            'service_remarks'     => $remarks,
        );

        $this->db->trans_begin();

        if ($service_id > 0) {
            $this->Booking_cancellation_model->update_service_line($service_id, $data);
        } else {
            if ($cancellation_id <= 0) {
                $this->db->trans_rollback();
                $this->_json(false, 'Cancellation reference missing');
                return;
            }

            $type = $this->input->post('service_type');
            $valid = array('TRANSPORT', 'INCLUSION', 'SPECIAL_REQUIREMENT', 'FLIGHT', 'VISA', 'GUIDE', 'OTHER');

            $data['booking_cancellation_id_fk'] = $cancellation_id;
            $data['service_type']        = in_array($type, $valid) ? $type : 'OTHER';
            $data['vendor_name']         = trim((string)$this->input->post('vendor_name'));
            $data['service_description'] = trim((string)$this->input->post('service_description'));
            $data['cancellation_service_created_datetime'] = date('Y-m-d H:i:s');
            $data['cancellation_service_status'] = 1;

            $service_id = $this->Booking_cancellation_model->insert_service_line($data);
        }

        $line = $service_id
            ? $this->db->where('cancellation_service_id', $service_id)
                       ->get('booking_cancellation_service')->row()
            : null;

        $target = $line ? (int)$line->booking_cancellation_id_fk : $cancellation_id;
        $summary = $this->Booking_cancellation_model->recalculate($target);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not save the service line');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Service line saved', array('summary' => $summary));
    }

    public function ajax_add_adjustment()
    {
        if (!has_permission('BOOKING_CANCELLATION_ADJUST')) {
            $this->_json(false, 'Permission denied: Adjustments');
            return;
        }

        $id        = (int)$this->input->post('booking_cancellation_id');
        $type      = $this->input->post('adjustment_type');
        $side      = $this->input->post('adjustment_side');
        $direction = $this->input->post('adjustment_direction');
        $amount    = (float)$this->input->post('adjustment_amount');
        $reason    = trim((string)$this->input->post('adjustment_reason'));

        $cancellation = $this->Booking_cancellation_model->get_header($id);
        if (!$cancellation) {
            $this->_json(false, 'Cancellation not found');
            return;
        }

        $valid_types = array('WRITE_OFF', 'GOODWILL_DISCOUNT', 'ADDITIONAL_CHARGE', 'BANK_CHARGE',
                             'GATEWAY_FEE', 'TAX_ADJUSTMENT', 'CREDIT_NOTE_ISSUED',
                             'INCENTIVE_CLAWBACK', 'ROUNDING', 'OTHER');

        $errors = array();
        if (!in_array($type, $valid_types))                      { $errors[] = 'Select a valid adjustment type'; }
        if (!in_array($side, array('CUSTOMER','SUPPLIER','COMPANY'))) { $errors[] = 'Select a valid side'; }
        if (!in_array($direction, array('DEBIT','CREDIT')))       { $errors[] = 'Select debit or credit'; }
        if ($amount <= 0)                                        { $errors[] = 'Amount must be greater than zero'; }
        if ($reason === '')                                      { $errors[] = 'A reason is required'; }

        if ($errors) {
            $this->_json(false, implode('. ', $errors));
            return;
        }

        $this->db->trans_begin();

        $this->Booking_cancellation_model->insert_adjustment(array(
            'booking_cancellation_id_fk'   => $id,
            'adjustment_type'              => $type,
            'adjustment_side'              => $side,
            'adjustment_direction'         => $direction,
            'adjustment_amount'            => round($amount, 2),
            'adjustment_reason'            => $reason,
            'approved_by_userid'           => $this->currentuserid,
            'approved_datetime'            => date('Y-m-d H:i:s'),
            'adjustment_created_by_userid' => $this->currentuserid,
            'adjustment_created_by_username' => $this->currentusername,
            'adjustment_created_datetime'  => date('Y-m-d H:i:s'),
            'cancellation_adjustment_status' => 1,
        ));

        $summary = $this->Booking_cancellation_model->recalculate($id);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not save the adjustment');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Adjustment saved', array('summary' => $summary));
    }

    public function ajax_delete_adjustment()
    {
        if (!has_permission('BOOKING_CANCELLATION_ADJUST')) {
            $this->_json(false, 'Permission denied: Adjustments');
            return;
        }

        $adj_id = (int)$this->input->post('cancellation_adjustment_id');

        $adj = $this->db
            ->where('cancellation_adjustment_id', $adj_id)
            ->where('cancellation_adjustment_status', 1)
            ->get($this->Booking_cancellation_model->table_adjustment)
            ->row();

        if (!$adj) {
            $this->_json(false, 'Adjustment not found');
            return;
        }

        $this->db->trans_begin();

        $this->db
            ->where('cancellation_adjustment_id', $adj_id)
            ->update($this->Booking_cancellation_model->table_adjustment, array(
                'cancellation_adjustment_status' => 0,
            ));

        $summary = $this->Booking_cancellation_model->recalculate((int)$adj->booking_cancellation_id_fk);

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            $this->_json(false, 'Could not delete the adjustment');
            return;
        }

        $this->db->trans_commit();

        $this->_json(true, 'Adjustment deleted', array('summary' => $summary));
    }

    // =========================================================
    // DATATABLES
    // =========================================================

    public function get_table()
    {
        if (!has_permission('BOOKING_CANCELLATION_VIEW')) {
            $this->_empty_table();
            return;
        }

        $param = $this->_datatable_params();

        $param['start_date']                 = $this->_date($this->input->post('start_date'));
        $param['end_date']                   = $this->_date($this->input->post('end_date'));
        $param['quotation_number_filter']    = $this->input->post('quotation_number_filter');
        $param['guest_name_filter']          = $this->input->post('guest_name_filter');
        $param['reason_filter']              = $this->input->post('reason_filter');
        $param['status_filter']              = $this->input->post('status_filter');
        $param['customer_settlement_filter'] = $this->input->post('customer_settlement_filter');
        $param['supplier_settlement_filter'] = $this->input->post('supplier_settlement_filter');
        $param['staff_filter']               = $this->input->post('staff_filter');

        $data = $this->Booking_cancellation_model->getCancellationTable($param);
        $data['draw'] = $param['draw'];

        echo json_encode($data);
    }

    public function get_tracker_table()
    {
        if (!has_permission('BOOKING_CANCELLATION_TRACKER')) {
            $this->_empty_table();
            return;
        }

        $param = $this->_datatable_params();

        $param['property_filter']    = $this->input->post('property_filter');
        $param['line_status_filter'] = $this->input->post('line_status_filter');
        $param['start_date']         = $this->_date($this->input->post('start_date'));
        $param['end_date']           = $this->_date($this->input->post('end_date'));
        $param['age_bucket']         = $this->input->post('age_bucket');
        $param['open_only']          = $this->input->post('open_only');

        $data = $this->Booking_cancellation_model->getSupplierTrackerTable($param);
        $data['draw']   = $param['draw'];
        $data['totals'] = $this->Booking_cancellation_model->get_tracker_totals($param);

        echo json_encode($data);
    }

    public function get_customer_refund_table()
    {
        if (!has_permission('BOOKING_CANCELLATION_REPORT')) {
            $this->_empty_table();
            return;
        }

        $param = $this->_datatable_params();

        $param['start_date']      = $this->_date($this->input->post('start_date'));
        $param['end_date']        = $this->_date($this->input->post('end_date'));
        $param['mode_filter']     = $this->input->post('mode_filter');
        $param['approval_filter'] = $this->input->post('approval_filter');

        $data = $this->Booking_cancellation_model->getCustomerRefundTable($param);
        $data['draw'] = $param['draw'];

        echo json_encode($data);
    }

    // =========================================================
    // HELPERS
    // =========================================================

    private function _datatable_params()
    {
        $order  = $this->input->post('order');
        $search = $this->input->post('search');

        return array(
            'draw'        => intval($this->input->post('draw')),
            'length'      => $this->input->post('length') !== null ? $this->input->post('length') : 10,
            'start'       => $this->input->post('start') !== null ? $this->input->post('start') : 0,
            'order'       => isset($order[0]['column']) ? $order[0]['column'] : '',
            'dir'         => isset($order[0]['dir']) ? $order[0]['dir'] : '',
            'searchValue' => isset($search['value']) ? $search['value'] : '',
        );
    }

    private function _empty_table()
    {
        echo json_encode(array(
            'draw'            => intval($this->input->post('draw')),
            'recordsTotal'    => 0,
            'recordsFiltered' => 0,
            'data'            => array(),
        ));
    }

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

    /**
     * Accepts dd/mm/yyyy (the format used across this app) or yyyy-mm-dd.
     */
    private function _date($value)
    {
        $value = trim((string)$value);
        if ($value === '') {
            return null;
        }

        $d = DateTime::createFromFormat('!d/m/Y', $value);
        if ($d && $d->format('d/m/Y') === $value) {
            return $d->format('Y-m-d');
        }

        $d = DateTime::createFromFormat('!Y-m-d', $value);
        if ($d && $d->format('Y-m-d') === $value) {
            return $d->format('Y-m-d');
        }

        return null;
    }

    private function _upload_proof($field)
    {
        $config = array(
            'upload_path'   => FCPATH . 'uploads/cancellation_proofs/',
            'allowed_types' => 'jpg|jpeg|png|pdf',
            'max_size'      => 20480,
            'encrypt_name'  => true,
        );

        if (!is_dir($config['upload_path'])) {
            @mkdir($config['upload_path'], 0777, true);
        }

        $this->load->library('upload');
        $this->upload->initialize($config);

        if (!$this->upload->do_upload($field)) {
            return array('status' => false, 'message' => $this->upload->display_errors('', ''));
        }

        $file = $this->upload->data();
        return array('status' => true, 'filename' => $file['file_name']);
    }

    /**
     * Loads the cancellation and guarantees it is still editable.
     * Echoes the error and returns FALSE when it is not.
     */
    private function _load_editable($permission)
    {
        if (!has_permission($permission)) {
            $this->_json(false, 'Permission denied');
            return false;
        }

        $id = (int)$this->input->post('booking_cancellation_id');
        $cancellation = $this->Booking_cancellation_model->get_header($id);

        if (!$cancellation) {
            $this->_json(false, 'Cancellation not found');
            return false;
        }

        if (!in_array($cancellation->cancellation_status, $this->editable_statuses)) {
            $this->_json(false, 'This cancellation is no longer editable ('
                . $cancellation->cancellation_status . ')');
            return false;
        }

        return $cancellation;
    }

    private function _permission_flags()
    {
        return array(
            'create'          => has_permission('BOOKING_CANCELLATION_CREATE'),
            'approve'         => has_permission('BOOKING_CANCELLATION_APPROVE'),
            'charge'          => has_permission('BOOKING_CANCELLATION_CHARGE'),
            'refund_customer' => has_permission('BOOKING_CANCELLATION_REFUND_CUSTOMER'),
            'refund_supplier' => has_permission('BOOKING_CANCELLATION_REFUND_SUPPLIER'),
            'refund_approve'  => has_permission('BOOKING_CANCELLATION_REFUND_APPROVE'),
            'refund_reverse'  => has_permission('BOOKING_CANCELLATION_REFUND_REVERSE'),
            'adjust'          => has_permission('BOOKING_CANCELLATION_ADJUST'),
            'reverse'         => has_permission('BOOKING_CANCELLATION_REVERSE'),
            'credit_apply'    => has_permission('PROPERTY_CREDIT_APPLY'),
            'credit_reverse'  => has_permission('PROPERTY_CREDIT_REVERSE'),
        );
    }
}
