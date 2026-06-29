<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class IncentiveConfig extends MY_Controller {

    public $page = 'IncentiveConfig';

    public function __construct() {
        parent::__construct();
        if (!$this->is_logged_in()) {
            redirect('/login');
        }
        $this->currentuserid   = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
        $this->load->model('General_model');
        $this->load->model('IncentiveConfig_model');
    }

    public function index() {
        $template['slabs']  = $this->IncentiveConfig_model->get_all_slabs();
        $template['body']   = 'IncentiveConfig/list';
        $template['script'] = 'IncentiveConfig/script';
        $this->load->view('template', $template);
    }

    public function ajax_get($id) {
        $slab = $this->IncentiveConfig_model->get_slab_by_id($id);
        echo json_encode($slab);
    }

    public function ajax_add() {
        $data = array(
            'slab_label'       => $this->input->post('slab_label'),
            'min_profit'       => $this->input->post('min_profit'),
            'max_profit'       => ($this->input->post('max_profit') !== '' && $this->input->post('max_profit') !== null) ? $this->input->post('max_profit') : null,
            'calculation_type' => $this->input->post('calculation_type'),
            'incentive_value'  => $this->input->post('incentive_value'),
            'deduction'        => $this->input->post('deduction') ?: 0,
            'status'           => 1,
        );
        $this->IncentiveConfig_model->add_slab($data);
        echo json_encode(array('status' => true));
    }

    public function ajax_update() {
        $id   = $this->input->post('id');
        $max  = $this->input->post('max_profit');
        $data = array(
            'slab_label'       => $this->input->post('slab_label'),
            'min_profit'       => $this->input->post('min_profit'),
            'max_profit'       => ($max !== '' && $max !== null) ? $max : null,
            'calculation_type' => $this->input->post('calculation_type'),
            'incentive_value'  => $this->input->post('incentive_value'),
            'deduction'        => $this->input->post('deduction') ?: 0,
        );
        $this->IncentiveConfig_model->update_slab($id, $data);
        echo json_encode(array('status' => true));
    }

    public function ajax_delete() {
        $id = $this->input->post('id');
        $this->IncentiveConfig_model->delete_slab($id);
        echo json_encode(array('status' => true));
    }
}
?>
