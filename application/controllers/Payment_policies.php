<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Payment_policies extends MY_Controller
{
    public $table = 'payment_policies';
    public $payment_policies_items = 'payment_policies_items';
    public $activity = 'activity';
    public $page = 'Payment_policies';

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
        $this->load->model('Payment_policies_model');
    }


    /* ============================================
       LIST PAGE
    ============================================ */
    public function index()
    {
        $template['policies'] = $this->Payment_policies_model->fetch_payment_policies();
        $template['staff']    = $this->Payment_policies_model->fetch_staff_details();

        $template['body']   = 'Payment_policies/list_new';
        $template['script'] = 'Payment_policies/script_new';

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

        /* FILTERS */
        $param['payment_policies_id'] = $this->input->post('payment_policies_id');
        $param['payment_policies_createdby_user_id'] = $this->input->post('payment_policies_createdby_user_id');
        $param['payment_policies_name'] = $this->input->post('payment_policies_name');

        if (!has_permission('PAYMENT_POLICY_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

        /* DATA */
        $data = $this->Payment_policies_model->getPaymentpoliciesTable($param);

        echo json_encode($data);
    }


    /* ============================================
       ADD NEW POLICY
    ============================================ */
    public function ajax_add()
    {

    	$this->_validate();

        $this->db->trans_start();

        /* MAIN POLICY */
        $policy_data = array(
            'payment_policies_name'              => $this->input->post('payment_policies_name'),
            'payment_policies_createdby_user_id' => $this->currentuserid,
            'payment_policies_status'            => 1,
            'payment_policies_created_date'      => date('Y-m-d H:i:s')
        );

        $this->db->insert($this->table, $policy_data);

        $policy_id = $this->db->insert_id();

        /* ITEMS */
        $items = $this->input->post('payment_policies_items_name');

        if (!empty($items)) {

            foreach ($items as $item) {

                if (trim($item) != '') {

                    $item_data = array(
                        'payment_policies_id_fk'      		=> $policy_id,
                        'payment_policies_items_name' 		=> trim($item),
                        'payment_policies_items_status'     => 1
                    );

                    $this->db->insert($this->payment_policies_items, $item_data);
                }
            }
        }

        $this->db->trans_complete();

        /* ACTIVITY LOG */
        $ip = $this->input->ip_address();
        $activity_data=array(
            'activity_action' => 'Added Payment Policy',
            'id_fk' => $policy_id,
            'activity_type' => 'Payment_policies_registration',
            'activity_ip' => $ip,
            'activity_action' => 'Add',
            'activity_by_userid' => $this->currentuserid,
            'activity_date' => date('Y-m-d H:i:s')
        );
        $this->General_model->add($this->activity,$activity_data);

        echo json_encode(array(
            "status" => TRUE
        ));
    }


    /* ============================================
       EDIT DATA FETCH
    ============================================ */
    public function ajax_edit($id)
    {
        $policy = $this->db
            ->where('payment_policies_id', $id)
            ->get($this->table)
            ->row();

        $items = $this->db
            ->where('payment_policies_id_fk', $id)
            ->get($this->payment_policies_items)
            ->result();

        echo json_encode(array(
            'policy' => $policy,
            'items'  => $items
        ));
    }


    /* ============================================
       UPDATE POLICY
    ============================================ */
    public function ajax_update()
    {
        $this->_validate();

        $policy_id = $this->input->post('payment_policies_id');

        $this->db->trans_start();

        /* UPDATE MAIN */
        $policy_data = array(
            'payment_policies_name' => $this->input->post('payment_policies_name')
        );

        $this->db->where('payment_policies_id', $policy_id);
        $this->db->update($this->table, $policy_data);

        /* DELETE OLD ITEMS */
        $this->db->where('payment_policies_id_fk', $policy_id);
        $this->db->delete($this->payment_policies_items);

        /* INSERT UPDATED ITEMS */
        $items = $this->input->post('payment_policies_items_name');

        if (!empty($items)) {

            foreach ($items as $item) {

                if (trim($item) != '') {

                    $item_data = array(
                        'payment_policies_id_fk'      		=> $policy_id,
                        'payment_policies_items_name' 		=> trim($item),
                        'payment_policies_items_status'     => 1
                    );

                    $this->db->insert($this->payment_policies_items, $item_data);
                }
            }
        }

        $this->db->trans_complete();

        /* ACTIVITY LOG */
        $ip = $this->input->ip_address();
        $activity_data=array(
            'activity_action' => 'Updated Payment Policy',
            'id_fk' => $policy_id,
            'activity_type' => 'Payment_policies_registration',
            'activity_ip' => $ip,
            'activity_action' => 'Update',
            'activity_by_userid' => $this->currentuserid,
            'activity_date' => date('Y-m-d H:i:s')
        );
        $this->General_model->add($this->activity,$activity_data);

        
        echo json_encode(array(
            "status" => TRUE
        ));
    }


    /* ============================================
       DELETE POLICY
    ============================================ */
    public function ajax_delete($policy_id)
    {
        /* DELETE ITEMS */
        $this->db->where('payment_policies_id_fk', $policy_id);
        $this->db->delete($this->payment_policies_items);

        /* DELETE MAIN */
        $this->db->where('payment_policies_id', $policy_id);
        $this->db->delete($this->table);

        /* ACTIVITY LOG */
        $ip = $this->input->ip_address();
        $activity_data=array(
            'activity_action' => 'Deleted Payment Policy',
            'id_fk' => $policy_id,
            'activity_type' => 'Payment_policies_registration',
            'activity_ip' => $ip,
            'activity_action' => 'Delete',
            'activity_by_userid' => $this->currentuserid,
            'activity_date' => date('Y-m-d H:i:s')
        );
        $this->General_model->add($this->activity,$activity_data);

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
        if ($this->input->post('payment_policies_name') == '') {
            $data['inputerror'][] = 'payment_policies_name';
            $data['error_string'][] = 'Payment policy name is required';
            $data['status'] = FALSE;
        }

        /* POLICY ITEMS */
        $items = $this->input->post('payment_policies_items_name');

        if (empty($items)) {

            $data['inputerror'][] = 'payment_policies_items_name';
            $data['error_string'][] = 'At least one payment policy item is required';
            $data['status'] = FALSE;

        } else {

            foreach ($items as $key => $item) {

                if (trim($item) == '') {

                    $data['inputerror'][] = 'payment_policies_items_name['.$key.']';
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