<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Destination extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Destination';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
		
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Destination_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		// $template['category'] = $this->Destination_model->fetch_itinerary_category_details();
		$template['staff'] = $this->Destination_model->fetch_staff_details();
		$template['location'] = $this->Destination_model->fetch_location_details();
		$template['body'] = 'Destination/list';
		$template['script'] = 'Destination/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Destination_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        

		if (!has_permission('DESTINATION_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

		
    	$data = $this->Destination_model->getDestinationTable($param);
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

		$state_name = $this->input->post('state_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'state_name' => $this->input->post('state_name'),
				'state_description' => $this->input->post('state_description'),
				'location_id_fk' => $this->input->post('location_id_fk'),
				'state_created_user_id' => $currentuserid,
				'state_created_at' => $date1,
				'state_status' => 1
			);
		$insert = $this->Destination_model->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Destination_model->get_by_id($id);
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
		
		
		
		$state_name = $this->input->post('state_name');
		
		$id = $this->input->post('id');
		// echo $ip;
		
		$data = array(
				
				'state_name' => $this->input->post('state_name'),
				'state_description' => $this->input->post('state_description'),
				'location_id_fk' => $this->input->post('location_id_fk'),
				'state_updated_user_id' => $currentuserid,
				'state_updated_at' => $date1,
			);
			// print_r($data);exit();
		$this->Destination_model->update(array('state_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
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

		$updateData = array('state_status' => 0);
		
		$this->Destination_model->update(array('state_id' => $this->input->post('id')), $updateData);

		$state_name = $this->input->post('state_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted Destination: '.$state_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Destination_registration',
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

		if($this->input->post('location_id_fk') == '')
		{
			$data['inputerror'][] = 'location_id_fk';
			$data['error_string'][] = 'Location is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('state_name') == '')
		{
			$data['inputerror'][] = 'state_name';
			$data['error_string'][] = 'Destination name is required';
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