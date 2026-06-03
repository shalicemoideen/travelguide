<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Inclusions_exclusions extends MY_Controller {
	public $table = 'inclusion_exclusion_common';
	public $inclusions = 'inclusions';
	public $exclusions = 'exclusions';
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
        $this->load->model('Inclusions_exclusions_model');
    }


    /* ============================================
       LIST PAGE
    ============================================ */
    public function index()
    {
        $template['exclusion'] = $this->Inclusions_exclusions_model->fetch_inclusion_exclusion();
        // $template['staff']    = $this->Payment_policies_model->fetch_staff_details();

        $template['body']   = 'Inclusions_exclusions/list_new';
        $template['script'] = 'Inclusions_exclusions/script_new';

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
        $param['inclusion_exclusion_common_title'] = $this->input->post('inclusion_exclusion_common_title_filter');

		if (!has_permission('INCLUSION_AND_EXCLUSION_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

        /* DATA */
        $data = $this->Inclusions_exclusions_model->getInclusions_exclusionsTable($param);

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
        $common_data = array(
            'inclusion_exclusion_common_title'    			 => $this->input->post('inclusion_exclusion_common_title'),
            'inclusion_exclusion_common_createdby_user_id'   => $this->currentuserid,
            'inclusion_exclusion_common_status'              => 1,
            'inclusion_exclusion_common_created_date'        => date('Y-m-d')
        );

        $this->db->insert($this->table, $common_data);

        $inclusion_exclusion_common_id_fk = $this->db->insert_id();

        /* ITEMS */
        $inclusions_details = $this->input->post('inclusions_details');

        if (!empty($inclusions_details)) {

            foreach ($inclusions_details as $inclusions_detail) {

                if (trim($inclusions_detail) != '') {

                    $inclusion_data = array(
                        'inclusion_exclusion_common_id_fk1'     => $inclusion_exclusion_common_id_fk,
                        'inclusions_details' 		            => trim($inclusions_detail),
                        'inclusions_status'                     => 1
                    );

                    $this->db->insert($this->inclusions, $inclusion_data);
                }
            }
        }

        /* ITEMS */
        $exclusions_details = $this->input->post('exclusions_details');

        if (!empty($exclusions_details)) {

            foreach ($exclusions_details as $exclusions_detail) {

                if (trim($exclusions_detail) != '') {

                    $exclusion_data = array(
                        'inclusion_exclusion_common_id_fk2'     => $inclusion_exclusion_common_id_fk,
                        'exclusions_details' 		            => trim($exclusions_detail),
                        'exclusions_status'                     => 1
                    );

                    $this->db->insert($this->exclusions, $exclusion_data);
                }
            }
        }

        $this->db->trans_complete();

        /* ACTIVITY LOG */
        $ip = $this->input->ip_address();
        $activity_data=array(
            'activity_action' => 'Added Inclusion Exclusion',
            'id_fk' => $inclusion_exclusion_common_id_fk,
            'activity_type' => 'Inclusion_exclusion_registration',
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
        $item = $this->db
            ->where('inclusion_exclusion_common_id', $id)
            ->get($this->table)
            ->row();

        $inclusions = $this->db
            ->where('inclusion_exclusion_common_id_fk1', $id)
            ->get($this->inclusions)
            ->result();
        $exclusions = $this->db
            ->where('inclusion_exclusion_common_id_fk2', $id)
            ->get($this->exclusions)
            ->result();

        echo json_encode(array(
            'item' => $item,
            'inclusions'  => $inclusions,
            'exclusions'  => $exclusions
        ));
    }


    /* ============================================
       UPDATE POLICY
    ============================================ */
    public function ajax_update()
    {
        $this->_validate();

        $inclusion_exclusion_common_id = $this->input->post('inclusion_exclusion_common_id');

        $this->db->trans_start();

        /* UPDATE MAIN */
        $common_data = array(
            'inclusion_exclusion_common_title'   => $this->input->post('inclusion_exclusion_common_title'),
        );

        $this->db->where('inclusion_exclusion_common_id', $inclusion_exclusion_common_id);
        $this->db->update($this->table, $common_data);

        /* DELETE OLD ITEMS */
        $this->db->where('inclusion_exclusion_common_id_fk1', $inclusion_exclusion_common_id);
        $this->db->delete($this->inclusions);

        /* DELETE OLD ITEMS */
        $this->db->where('inclusion_exclusion_common_id_fk2', $inclusion_exclusion_common_id);
        $this->db->delete($this->exclusions);

        /* INSERT UPDATED ITEMS */
        $inclusions_details = $this->input->post('inclusions_details');

        if (!empty($inclusions_details)) {

            foreach ($inclusions_details as $inclusions_detail) {

                if (trim($inclusions_detail) != '') {

                    $inclusion_data = array(
                        'inclusion_exclusion_common_id_fk1'     => $inclusion_exclusion_common_id,
                        'inclusions_details' 		            => trim($inclusions_detail),
                        'inclusions_status'                     => 1
                    );

                    $this->db->insert($this->inclusions, $inclusion_data);
                }
            }
        }


        /* ITEMS */
        $exclusions_details = $this->input->post('exclusions_details');

        if (!empty($exclusions_details)) {

            foreach ($exclusions_details as $exclusions_detail) {

                if (trim($exclusions_detail) != '') {

                    $exclusion_data = array(
                        'inclusion_exclusion_common_id_fk2'     => $inclusion_exclusion_common_id,
                        'exclusions_details' 		            => trim($exclusions_detail),
                        'exclusions_status'                     => 1
                    );

                    $this->db->insert($this->exclusions, $exclusion_data);
                }
            }
        }

        $this->db->trans_complete();

        /* ACTIVITY LOG */
        $ip = $this->input->ip_address();
        $activity_data=array(
            'activity_action' => 'Updated Inclusion and Excluions',
            'id_fk' => $inclusion_exclusion_common_id,
            'activity_type' => 'Include_exclude_registration',
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
    public function ajax_delete($inclusion_exclusion_common_id)
    {
        /* DELETE ITEMS */
        $this->db->where('inclusion_exclusion_common_id_fk1', $inclusion_exclusion_common_id);
        $this->db->delete($this->inclusions);

        /* DELETE ITEMS */
        $this->db->where('inclusion_exclusion_common_id_fk2', $inclusion_exclusion_common_id);
        $this->db->delete($this->exclusions);

        /* DELETE MAIN */
        $this->db->where('inclusion_exclusion_common_id', $inclusion_exclusion_common_id);
        $this->db->delete($this->table);

        /* ACTIVITY LOG */
        $ip = $this->input->ip_address();
        $activity_data=array(
            'activity_action' => 'Deleted Inclusion and Exclusion Policy',
            'id_fk' => $inclusion_exclusion_common_id,
            'activity_type' => 'Include_Exclude_registration',
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
        if ($this->input->post('inclusion_exclusion_common_title') == '') {
            $data['inputerror'][] = 'inclusion_exclusion_common_title';
            $data['error_string'][] = 'Inclusion and Exclusion title is required';
            $data['status'] = FALSE;
        }

        /* POLICY ITEMS */
        $inlcusion_items = $this->input->post('inclusions_details');

        if (empty($inlcusion_items)) {

            $data['inputerror'][] = 'inclusions_details';
            $data['error_string'][] = 'At least one inclusion item is required';
            $data['status'] = FALSE;

        } else {

            foreach ($inlcusion_items as $key => $item) {

                if (trim($item) == '') {

                    $data['inputerror'][] = 'inclusions_details['.$key.']';
                    $data['error_string'][] = 'This field is required';
                    $data['status'] = FALSE;
                }
            }
        }

        /* POLICY ITEMS */
        $exclusion_items = $this->input->post('exclusions_details');

        if (empty($exclusion_items)) {

            $data['inputerror'][] = 'exclusions_details';
            $data['error_string'][] = 'At least one exclusion item is required';
            $data['status'] = FALSE;

        } else {

            foreach ($exclusion_items as $key => $item) {

                if (trim($item) == '') {

                    $data['inputerror'][] = 'exclusions_details['.$key.']';
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
?>