<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Special_requirments extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Special_requirments';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Special_requirments_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		$template['category'] = $this->Special_requirments_model->fetch_special_requirements_details();
		$template['staff'] = $this->Special_requirments_model->fetch_staff_details();
		$template['body'] = 'Special_requirments/list';
		$template['script'] = 'Special_requirments/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Special_requirments_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['special_requirements_id'] =(isset($_REQUEST['special_requirements_id']))?$_REQUEST['special_requirements_id']:'';
		$param['special_requirements_createdby_user_id'] =(isset($_REQUEST['special_requirements_createdby_user_id']))?$_REQUEST['special_requirements_createdby_user_id']:'';

		if (!has_permission('SPECIAL_REQUIREMENTS_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }
		
    	$data = $this->Special_requirments_model->getSpecialrequirmentsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function ajax_add()
	{
		$this->_validate();
		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());

		$special_requirements_name = $this->input->post('special_requirements_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'special_requirements_name' => $this->input->post('special_requirements_name'),
				'special_requirements_cost' => $this->input->post('special_requirements_cost'),
				'special_requirements_description' => $this->input->post('special_requirements_description'),					
				'special_requirements_createdby_user_id' => $currentuserid,			
				'special_requirements_createdby_user_name' => $currentusername,			
				'special_requirements_created_date' => $date,			
				'special_requirements_created_time' => $time,			
				'special_requirements_status' => 1
			);
		$insert = $this->Special_requirments_model->save($data);

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added special requirement: '.$special_requirements_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Special_requirements_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Add',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,
				'activity_date' => $date,				
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Special_requirments_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();
		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		
		
		$special_requirements_name = $this->input->post('special_requirements_name');
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited special requirement: '.$special_requirements_name.'',
				'id_fk' => $id,
				'activity_type' => 'Special_requirements_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Edit',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,	
				'activity_date' => $date,			
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		$data = array(
				
				'special_requirements_name' => $this->input->post('special_requirements_name'),
				'special_requirements_cost' => $this->input->post('special_requirements_cost'),
				'special_requirements_description' => $this->input->post('special_requirements_description'),					
				// 'special_requirements_createdby_user_id' => $currentuserid,			
				// 'special_requirements_createdby_user_name' => $currentusername,			
				// 'special_requirements_created_date' => $date,			
				// 'special_requirements_created_time' => $time,			
				// 'special_requirements_status' => 1
			);
			// print_r($data);exit();
		$this->Special_requirments_model->update(array('special_requirements_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function checkspecial_requirements(){
            
			
            $special_requirements_name	 = $this->input->post('value');
            $data = $this->Special_requirments_model->checkspecial_requirements($special_requirements_name);
            // print_r($data);exit();
			$json_data = json_encode($data);
            echo $json_data;
            
	}
	 public function checkEditspecial_requirements(){
		
	 	
		$special_requirements_name = $this->input->post('value');
		$special_requirements_id = $this->input->post('id');
		$data = $this->Special_requirments_model->checkEditspecial_requirements($special_requirements_name, $special_requirements_id);
		$json_data = json_encode($data);
		echo $json_data;
		
	}

	public function delete()
	{
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());

		$updateData = array('special_requirements_status' => 0);
		
		$this->Special_requirments_model->update(array('special_requirements_id' => $this->input->post('id')), $updateData);

		$special_requirements_name = $this->input->post('special_requirements_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted special requirement '.$special_requirements_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Special_requirements_registration',
				// 'activity_order_number' => $invoice_order_number1,
				'activity_ip' => $ip,
				'activity_action' => 'Delete',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,
				'activity_date' => $date,
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('special_requirements_name') == '')
		{
			$data['inputerror'][] = 'special_requirements_name';
			$data['error_string'][] = 'Special requirements name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('special_requirements_cost') == '')
		{
			$data['inputerror'][] = 'special_requirements_cost';
			$data['error_string'][] = 'Special requirements cost is required';
			$data['status'] = FALSE;
		}

		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
}
?>