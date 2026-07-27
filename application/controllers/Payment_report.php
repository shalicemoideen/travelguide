<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_report extends MY_Controller {

    public $page = 'Payment Report';

    public function __construct() {
        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login');
        }

        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
        $this->currentusername = $this->session->userdata('admin_name');

        $this->load->model('Quotation_model');
        $this->load->model('Receipt_scheduler_model');
        $this->load->model('Property_reservation_model');
    }

    public function index()
    {
        if (!has_permission('PAYMENT_REPORT')) {
            show_error('Permission denied: Payment Report', 403);
            return;
        }

        $template['body'] = 'Payment_report/payment_report';
        $template['script'] = 'Payment_report/payment_report_script';
        $this->load->view('template', $template);
    }

    public function get_payment_report_table()
    {
        if (!has_permission('PAYMENT_REPORT')) {
            echo json_encode(array('error' => true, 'message' => 'Permission denied'));
            return;
        }

        $param = array(
            'quotation_number_filter' => $this->input->post('quotation_number_filter'),
            'guest_name_filter' => $this->input->post('guest_name_filter'),
            'customer_payment_status_filter' => $this->input->post('customer_payment_status_filter'),
            'customer_approval_filter' => $this->input->post('customer_approval_filter'),
            'property_payment_status_filter' => $this->input->post('property_payment_status_filter'),
            'start' => $this->input->post('start'),
            'length' => $this->input->post('length'),
        );

        $result = $this->Quotation_model->get_payment_report_table($param);
        echo json_encode($result);
    }
}
