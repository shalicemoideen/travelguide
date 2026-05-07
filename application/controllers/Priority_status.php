<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Priority_status extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Priority_status';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Priority_status_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		$template['priority'] = $this->Priority_status_model->fetch_priority_status_details();
		$template['staff'] = $this->Priority_status_model->fetch_staff_details();
		$template['body'] = 'Priority_status/list';
		$template['script'] = 'Priority_status/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Priority_status_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['priority_status_id'] =(isset($_REQUEST['priority_status_id']))?$_REQUEST['priority_status_id']:'';
		$param['priority_status_created_user_id'] =(isset($_REQUEST['priority_status_created_user_id']))?$_REQUEST['priority_status_created_user_id']:'';

		if (!has_permission('PRIORITY_STATUS_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }


		
    	$data = $this->Priority_status_model->getPriortystatusTable($param);
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

		$priority_status_name = $this->input->post('priority_status_name');
		$priority_status_button  = $this->input->post('priority_status_button');
		$button = '<center><span class="btn btn-sm" style="background-color:'.$priority_status_button.'"><span style="color:white">'.$priority_status_name.'</span></span></center>';

		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'priority_status_name' => $this->input->post('priority_status_name'),	
                'priority_status_button' => $button,	
                'priority_status_description' => $this->input->post('priority_status_description'),					
				'priority_status_created_user_id' => $currentuserid,			
				'priority_status_created_username' => $currentusername,			
				'priority_status_created_date' => $date,			
				'priority_status_created_time ' => $time,			
				'priority_status_created_status' => 1
			);
		$insert = $this->Priority_status_model->save($data);

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added priority status: '.$priority_status_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Priority_status_registration',
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
		$data = $this->Priority_status_model->get_by_id($id);
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
		
		
		
		$priority_status_name = $this->input->post('priority_status_name');
        $priority_status_button  = $this->input->post('priority_status_button');
		$button = '<center><span class="btn btn-sm" style="background-color:'.$priority_status_button.'"><span style="color:white">'.$priority_status_name.'</span></span></center>';

		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited priority status: '.$priority_status_name.'',
				'id_fk' => $id,
				'activity_type' => 'Priority_status_registration',
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
				
				
				'priority_status_name' => $this->input->post('priority_status_name'),					
				'priority_status_button' => $button,	
                'priority_status_description' => $this->input->post('priority_status_description'),					
				// 'priority_status_created_user_id' => $currentuserid,			
				// 'priority_status_created_username' => $currentusername,			
				// 'priority_status_created_date' => $date,			
				// 'priority_status_created_time ' => $time,			
				// 'priority_status_created_status' => 1
			);
			// print_r($data);exit();
		$this->Priority_status_model->update(array('priority_status_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function checkpriority(){
            
			
            $priority_status_name	 = $this->input->post('value');
            $data = $this->Priority_status_model->checkpriority($priority_status_name);
            // print_r($data);exit();
			$json_data = json_encode($data);
            echo $json_data;
            
	}
	 public function checkEditpriorty(){
		
	 	
		$priority_status_name = $this->input->post('value');
		$priority_status_id = $this->input->post('id');
		$data = $this->Priority_status_model->checkEditpriorty($priority_status_name, $priority_status_id);
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

		$updateData = array('priority_status_created_status' => 0);
		
		$this->Priority_status_model->update(array('priority_status_id' => $this->input->post('id')), $updateData);

		$priority_status_name = $this->input->post('priority_status_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted priority status '.$priority_status_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Priority_status_registration',
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

		if($this->input->post('priority_status_name') == '')
		{
			$data['inputerror'][] = 'priority_status_name';
			$data['error_string'][] = 'priority status is required';
			$data['status'] = FALSE;
		}
        if($this->input->post('priority_status_button') == '')
		{
			$data['inputerror'][] = 'priority_status_button';
			$data['error_string'][] = 'priority status label is required';
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