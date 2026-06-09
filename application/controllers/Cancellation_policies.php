<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cancellation_policies extends MY_Controller
{
    public $table = 'cancellation_policies';
    public $cancellation_policies_item = 'cancellation_policies_item';
    public $activity = 'activity';
    public $page = 'Cancellation_policies';

    public function __construct()
    {
        parent::__construct();

        /* ============================================
           LOGIN CHECK
        ============================================ */
        if (!$this->is_logged_in()) {
            redirect('/login');
        }

        /* ============================================
           SESSION
        ============================================ */
        $this->currentuserid   = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');

        /* ============================================
           LOAD MODELS
        ============================================ */
        $this->load->model('General_model');
        $this->load->model('Cancellation_policies_model');
    }


    /* ============================================
       LIST PAGE
    ============================================ */
    public function index()
    {
        $template['terms'] = $this->Cancellation_policies_model->fetch_cancellation_policies();
        $template['staff']    = $this->Cancellation_policies_model->fetch_staff_details();

        $template['body']   = 'Cancellation_policies/list';
		$template['script'] = 'Cancellation_policies/script';

        $this->load->view('template', $template);
    }


    /* ============================================
       DATATABLE LIST
    ============================================ */
    public function get()
    {
        $param['draw']   = $this->input->post('draw');
        $param['length'] = $this->input->post('length');
        $param['start']  = $this->input->post('start');

        $order = $this->input->post('order');

        $param['order'] = isset($order[0]['column']) ? $order[0]['column'] : '';
        $param['dir']   = isset($order[0]['dir']) ? $order[0]['dir'] : '';

        $search = $this->input->post('search');
        $param['searchValue'] = isset($search['value']) ? $search['value'] : '';


        if (!has_permission('CANCELLATION_AND_POLICY_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

        /* DATA */
        $data = $this->Cancellation_policies_model->getCancellationpolicesTable($param);

        echo json_encode($data);
    }

    /* ============================================
       ADD NEW CANCEL
    ============================================ */
    public function ajax_add()
    {

    	$this->_validate();

        $this->db->trans_start();

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');

		$date1 = date('Y-m-d h:i:s a', time());
        /* MAIN POLICY */
        $cancel_data = array(
            'cancellation_policies_name'              => $this->input->post('cancellation_policies_name'),
            'cancellation_policies_createdby_user_id' => $this->currentuserid,
            'cancellation_policies_status'            => 1,
            'cancellation_policies_created_at'      => $date1
        );

        $this->db->insert($this->table, $cancel_data);

        $cancel_id = $this->db->insert_id();

        /* ITEMS */
        $items = $this->input->post('cancellation_policies_item_name');

        if (!empty($items)) {

            foreach ($items as $item) {

                if (trim($item) != '') {

                    $item_data = array(
                        'cancellation_policies_id_fk'      		=> $cancel_id,
                        'cancellation_policies_item_name' 		=> trim($item),
                        'cancellation_policies_item_status'     => 1
                    );

                    $this->db->insert($this->cancellation_policies_item, $item_data);
                }
            }
        }

        $this->db->trans_complete();

        echo json_encode(array(
            "status" => TRUE
        ));
    }


    /* ============================================
       EDIT DATA FETCH
    ============================================ */
    public function ajax_edit($id)
    {
        $cancel = $this->db
            ->where('cancellation_policies_id', $id)
            ->get($this->table)
            ->row();

        $items = $this->db
            ->where('cancellation_policies_id_fk', $id)
            ->get($this->cancellation_policies_item)
            ->result();

        echo json_encode(array(
            'cancel' => $cancel,
            'items'  => $items
        ));
    }


    /* ============================================
       UPDATE TERMS
    ============================================ */
    public function ajax_update()
    {
        $this->_validate();

        $cancel_id = $this->input->post('cancellation_policies_id');

        $this->db->trans_start();

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');

		$date1 = date('Y-m-d h:i:s a', time());

        /* UPDATE MAIN */
		$cancel_data = array(
            'cancellation_policies_name'              => $this->input->post('cancellation_policies_name'),
            'cancellation_policies_updatedby_user_id' => $this->currentuserid,
            'cancellation_policies_created_at'      => $date1
        );

        $this->db->where('cancellation_policies_id', $cancel_id);
        $this->db->update($this->table, $cancel_data);

        /* DELETE OLD ITEMS */
        $this->db->where('cancellation_policies_id_fk', $cancel_id);
        $this->db->delete($this->cancellation_policies_item);

        /* INSERT UPDATED ITEMS */
        $items = $this->input->post('cancellation_policies_item_name');

        if (!empty($items)) {

            foreach ($items as $item) {

                if (trim($item) != '') {

                    $item_data = array(
                        'cancellation_policies_id_fk'      		=> $cancel_id,
                        'cancellation_policies_item_name' 		=> trim($item),
                        'cancellation_policies_item_status'     => 1
                    );

                    $this->db->insert($this->cancellation_policies_item, $item_data);
                }
            }
        }

        $this->db->trans_complete();

        
        echo json_encode(array(
            "status" => TRUE
        ));
    }


    /* ============================================
       DELETE CANCEL
    ============================================ */
    public function ajax_delete($cancel_id)
    {
        /* DELETE ITEMS */
        $this->db->where('cancellation_policies_id_fk', $cancel_id);
        $this->db->delete($this->cancellation_policies_item);

        /* DELETE MAIN */
        $this->db->where('cancellation_policies_id', $cancel_id);
        $this->db->delete($this->table);

        /* ACTIVITY LOG */
        // $ip = $this->input->ip_address();
        // $activity_data=array(
        //     'activity_action' => 'Deleted Payment Policy',
        //     'id_fk' => $terms_id,
        //     'activity_type' => 'Payment_policies_registration',
        //     'activity_ip' => $ip,
        //     'activity_action' => 'Delete',
        //     'activity_by_userid' => $this->currentuserid,
        //     'activity_date' => date('Y-m-d H:i:s')
        // );
        // $this->General_model->add($this->activity,$activity_data);

        echo json_encode(array(
            "status" => TRUE
        ));
    }


    /* ============================================
       VALIDATION
    ============================================ */
    private function _validate()
    {
        $data = array();
        $data['inputerror'] = array();
        $data['error_string'] = array();
        $data['status'] = TRUE;

        /* POLICY NAME */
        if ($this->input->post('cancellation_policies_name') == '') {
            $data['inputerror'][] = 'cancellation_policies_name';
            $data['error_string'][] = 'Cancellation policy name is required';
            $data['status'] = FALSE;
        }

        /* POLICY ITEMS */
        $items = $this->input->post('cancellation_policies_item_name');

        if (empty($items)) {

            $data['inputerror'][] = 'cancellation_policies_item_name';
            $data['error_string'][] = 'At least one cancellation policy item is required';
            $data['status'] = FALSE;

        } else {

            foreach ($items as $key => $item) {

                if (trim($item) == '') {

                    $data['inputerror'][] = 'cancellation_policies_item_name['.$key.']';
                    $data['error_string'][] = 'This field is required';
                    $data['status'] = FALSE;
                }
            }
        }

        if ($data['status'] === FALSE) {
            echo json_encode($data);
            exit();
        }
    }
}