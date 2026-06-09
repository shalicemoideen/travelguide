<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Designation extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Designation';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Designation_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		$template['designation'] = $this->Designation_model->fetch_designation_details();
		$template['staff'] = $this->Designation_model->fetch_staff_details();
		$template['body'] = 'Designation/list';
		$template['script'] = 'Designation/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Designation_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		
		if (!has_permission('DESIGNATION_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }


		
    	$data = $this->Designation_model->getDesignationTable($param);
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

		$designation_name = $this->input->post('designation_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'designation_name' => $this->input->post('designation_name'),
				'designation_description' => $this->input->post('designation_description'),						
				'designation_created_by_user_id' => $currentuserid,						
				'designation_created_at' => $date1,						
				'designation_status' => 1
			);
		$insert = $this->Designation_model->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Designation_model->get_by_id($id);
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
		
		
		
		$designation_name = $this->input->post('designation_name');
		
		$id = $this->input->post('id');
		
		$data = array(
				
				
				'designation_name' => $this->input->post('designation_name'),
				'designation_description' => $this->input->post('designation_description'),						
				'designation_updated_by_user_id' => $currentuserid,						
				'designation_updated_at' => $date1,			
			);
			// print_r($data);exit();
		$this->Designation_model->update(array('designation_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function checkdesignation(){
            
			
            $designation_name	 = $this->input->post('value');
            $data = $this->Designation_model->checkdesignation($designation_name);
            // print_r($data);exit();
			$json_data = json_encode($data);
            echo $json_data;
            
	}
	 public function checkEditdesignation(){
		
	 	
		$designation_name = $this->input->post('value');
		$designation_id = $this->input->post('id');
		$data = $this->Designation_model->checkEditdesignation($designation_name, $designation_id);
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

		$updateData = array('designation_status' => 0);
		
		$this->Designation_model->update(array('designation_id' => $this->input->post('id')), $updateData);

		$designation_name = $this->input->post('designation_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted designation '.$designation_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Designation_registration',
		// 		// 'activity_order_number' => $invoice_order_number1,
		// 		'activity_ip' => $ip,
		// 		'activity_action' => 'Delete',
		// 		'activity_by_userid' => $currentuserid,
		// 		'activity_by_username' => $currentusername,
		// 		'activity_date_time	' => $date1,
		// 		'activity_date' => $date,
		// 		'activity_status' => 1,
		// 	);
		
		// $this->General_model->add($this->activity,$activity_data);
		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('designation_name') == '')
		{
			$data['inputerror'][] = 'designation_name';
			$data['error_string'][] = 'Designation name is required';
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