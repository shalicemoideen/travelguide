<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Stages extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Stages';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Stages_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		$template['stage'] = $this->Stages_model->fetch_stages_details();
		$template['staff'] = $this->Stages_model->fetch_staff_details();
		$template['body'] = 'Stages/list';
		$template['script'] = 'Stages/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Stages_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['stages_id'] =(isset($_REQUEST['stages_id']))?$_REQUEST['stages_id']:'';
		$param['stages_created_user_id'] =(isset($_REQUEST['stages_created_user_id']))?$_REQUEST['stages_created_user_id']:'';

		if (!has_permission('STAGE_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }


		
    	$data = $this->Stages_model->getStageTable($param);
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

		$stages_name = $this->input->post('stages_name');
		$stages_button  = $this->input->post('stages_button');
		$button = '<center><span class="btn btn-sm" style="background-color:'.$stages_button.'"><span style="color:white">'.$stages_name.'</span></span></center>';

		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'stages_name' => $this->input->post('stages_name'),	
                'stages_button' => $button,	
                'stages_description' => $this->input->post('stages_description'),					
				'stages_created_user_id' => $currentuserid,			
				'stages_created_username' => $currentusername,			
				'stages_created_date' => $date,			
				'stages_created_time ' => $time,			
				'stages_status' => 1
			);
		$insert = $this->Stages_model->save($data);

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added stage: '.$stages_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Stage_registration',
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
		$data = $this->Stages_model->get_by_id($id);
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
		
		
		
		$stages_name = $this->input->post('stages_name');
		$stages_button  = $this->input->post('stages_button');
		$button = '<center><span class="btn btn-sm" style="background-color:'.$stages_button.'"><span style="color:white">'.$stages_name.'</span></span></center>';

		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited stage: '.$stages_name.'',
				'id_fk' => $id,
				'activity_type' => 'Stage_registration',
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
				
				
				'stages_name' => $this->input->post('stages_name'),	
                'stages_button' => $button,	
                'stages_description' => $this->input->post('stages_description'),					
				// 'stages_created_user_id' => $currentuserid,			
				// 'stages_created_username' => $currentusername,			
				// 'stages_created_date' => $date,			
				// 'stages_created_time ' => $time,			
				// 'stages_status' => 1
			);
			// print_r($data);exit();
		$this->Stages_model->update(array('stages_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function checkstage(){
            
			
            $stages_name	 = $this->input->post('value');
            $data = $this->Stages_model->checkstage($stages_name);
            // print_r($data);exit();
			$json_data = json_encode($data);
            echo $json_data;
            
	}
	 public function checkEditstage(){
		
	 	
		$stages_name = $this->input->post('value');
		$stages_id = $this->input->post('id');
		$data = $this->Stages_model->checkEditstage($stages_name, $stages_id);
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

		$updateData = array('stages_status' => 0);
		
		$this->Stages_model->update(array('stages_id' => $this->input->post('id')), $updateData);

		$stages_name = $this->input->post('stages_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted stage '.$stages_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Stage_registration',
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

		if($this->input->post('stages_name') == '')
		{
			$data['inputerror'][] = 'stages_name';
			$data['error_string'][] = 'Stage is required';
			$data['status'] = FALSE;
		}
        if($this->input->post('stages_button') == '')
		{
			$data['inputerror'][] = 'stages_button';
			$data['error_string'][] = 'stage label is required';
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