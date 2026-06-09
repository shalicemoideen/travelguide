<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Vehicle extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Vehicle';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Vehicle_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		$template['vehicle'] = $this->Vehicle_model->fetch_vehicle_details();
		$template['staff'] = $this->Vehicle_model->fetch_staff_details();
		$template['body'] = 'Vehicle/list';
		$template['script'] = 'Vehicle/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Vehicle_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		
		if (!has_permission('VEHICLE_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }


		
    	$data = $this->Vehicle_model->getVehicleTable($param);
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

		$vehicle_name = $this->input->post('vehicle_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'vehicle_name' => $this->input->post('vehicle_name'),
				'vehicle_number_seat' => $this->input->post('vehicle_number_seat'),
				'vehicle_description' => $this->input->post('vehicle_description'),						
				'vehicle_createdby_user_id' => $currentuserid,						
				'vehicle_created_at' => $date1,					
				'vehicle_status' => 1
			);
		$insert = $this->Vehicle_model->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Vehicle_model->get_by_id($id);
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
		
		
		
		$vehicle_name = $this->input->post('vehicle_name');

		$id = $this->input->post('id');
		
		$data = array(
				
				'vehicle_name' => $this->input->post('vehicle_name'),
				'vehicle_number_seat' => $this->input->post('vehicle_number_seat'),
				'vehicle_description' => $this->input->post('vehicle_description'),						
				'vehicle_updatedby_user_id' => $currentuserid,					
				'vehicle_updated_at' => $date1,			
			);
			// print_r($data);exit();
		$this->Vehicle_model->update(array('vehicle_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function checkvehicle(){
            
			
            $vehicle_name	 = $this->input->post('value');
            $data = $this->Vehicle_model->checkvehicle($vehicle_name);
            // print_r($data);exit();
			$json_data = json_encode($data);
            echo $json_data;
            
	}
	 public function checkEditvehicle(){
		
	 	
		$vehicle_name = $this->input->post('value');
		$vehicle_id = $this->input->post('id');
		$data = $this->Vehicle_model->checkEditvehicle($vehicle_name, $vehicle_id);
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

		$updateData = array('vehicle_status' => 0);
		
		$this->Vehicle_model->update(array('vehicle_id' => $this->input->post('id')), $updateData);

		$vehicle_name = $this->input->post('vehicle_name');
		$ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted vehicle '.$vehicle_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Vehicle_registration',
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

		if($this->input->post('vehicle_name') == '')
		{
			$data['inputerror'][] = 'vehicle_name';
			$data['error_string'][] = 'Vehicle name is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('vehicle_number_seat') == '')
		{
			$data['inputerror'][] = 'vehicle_number_seat';
			$data['error_string'][] = 'Number of seat is required';
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