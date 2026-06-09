<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Terms_condition extends MY_Controller
{
    public $table = 'terms_condition';
    public $terms_condition_items = 'terms_condition_items';
    public $activity = 'activity';
    public $page = 'Terms_condition';

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
        $this->load->model('Terms_condition_model');
    }


    /* ============================================
       LIST PAGE
    ============================================ */
    public function index()
    {
        $template['terms'] = $this->Terms_condition_model->fetch_terms_condition();
        $template['staff']    = $this->Terms_condition_model->fetch_staff_details();

        $template['body']   = 'Terms_condition/list';
		$template['script'] = 'Terms_condition/script';

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


        if (!has_permission('TERMS_AND_CONDITIONS_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

        /* DATA */
        $data = $this->Terms_condition_model->getTermsconditionTable($param);

        echo json_encode($data);
    }

    /* ============================================
       ADD NEW TERMS
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
        $terms_data = array(
            'terms_condition_name'              => $this->input->post('terms_condition_name'),
            'terms_condition_createdby_user_id' => $this->currentuserid,
            'terms_condition_status'            => 1,
            'terms_condition_created_at'      => $date1
        );

        $this->db->insert($this->table, $terms_data);

        $terms_id = $this->db->insert_id();

        /* ITEMS */
        $items = $this->input->post('terms_condition_items_name');

        if (!empty($items)) {

            foreach ($items as $item) {

                if (trim($item) != '') {

                    $item_data = array(
                        'terms_condition_id_fk'      		=> $terms_id,
                        'terms_condition_items_name' 		=> trim($item),
                        'terms_condition_items_status'     => 1
                    );

                    $this->db->insert($this->terms_condition_items, $item_data);
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
        $terms = $this->db
            ->where('terms_condition_id', $id)
            ->get($this->table)
            ->row();

        $items = $this->db
            ->where('terms_condition_id_fk', $id)
            ->get($this->terms_condition_items)
            ->result();

        echo json_encode(array(
            'terms' => $terms,
            'items'  => $items
        ));
    }


    /* ============================================
       UPDATE TERMS
    ============================================ */
    public function ajax_update()
    {
        $this->_validate();

        $terms_id = $this->input->post('terms_condition_id');

        $this->db->trans_start();

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');

		$date1 = date('Y-m-d h:i:s a', time());

        /* UPDATE MAIN */
		$terms_data = array(
            'terms_condition_name'              => $this->input->post('terms_condition_name'),
            'terms_condition_updatedby_user_id' => $this->currentuserid,
            'terms_condition_updated_at'      => $date1
        );

        $this->db->where('terms_condition_id', $terms_id);
        $this->db->update($this->table, $terms_data);

        /* DELETE OLD ITEMS */
        $this->db->where('terms_condition_id_fk', $terms_id);
        $this->db->delete($this->terms_condition_items);

        /* INSERT UPDATED ITEMS */
        $items = $this->input->post('terms_condition_items_name');

        if (!empty($items)) {

            foreach ($items as $item) {

                if (trim($item) != '') {

                    $item_data = array(
                        'terms_condition_id_fk'      		=> $terms_id,
                        'terms_condition_items_name' 		=> trim($item),
                        'terms_condition_items_status'     => 1
                    );

                    $this->db->insert($this->terms_condition_items, $item_data);
                }
            }
        }

        $this->db->trans_complete();

        
        echo json_encode(array(
            "status" => TRUE
        ));
    }


    /* ============================================
       DELETE TERMS
    ============================================ */
    public function ajax_delete($terms_id)
    {
        /* DELETE ITEMS */
        $this->db->where('terms_condition_id_fk', $terms_id);
        $this->db->delete($this->terms_condition_items);

        /* DELETE MAIN */
        $this->db->where('terms_condition_id', $terms_id);
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

        /* TERMS NAME */
        if ($this->input->post('terms_condition_name') == '') {
            $data['inputerror'][] = 'terms_condition_name';
            $data['error_string'][] = 'Terms & Condition name is required';
            $data['status'] = FALSE;
        }

        /* TERMS ITEMS */
        $items = $this->input->post('terms_condition_items_name');

        if (empty($items)) {

            $data['inputerror'][] = 'terms_condition_items_name';
            $data['error_string'][] = 'At least one terms condition item is required';
            $data['status'] = FALSE;

        } else {

            foreach ($items as $key => $item) {

                if (trim($item) == '') {

                    $data['inputerror'][] = 'terms_condition_items_name['.$key.']';
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