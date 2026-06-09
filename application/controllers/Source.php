<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Source extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Source';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Source_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		$template['source'] = $this->Source_model->fetch_source_details();
		$template['staff'] = $this->Source_model->fetch_staff_details();
		$template['body'] = 'Source/list';
		$template['script'] = 'Source/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Source_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		if (!has_permission('SOURCE_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }


		
    	$data = $this->Source_model->getSourceTable($param);
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

		$source_name = $this->input->post('source_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'source_name' => $this->input->post('source_name'),					
				'source_created_user_id' => $currentuserid,						
				'source_created_at' => $date1,						
				'source_status' => 1
			);
		$insert = $this->Source_model->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Source_model->get_by_id($id);
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
		
		
		
		$source_name = $this->input->post('source_name');
		$id = $this->input->post('id');
		
		$data = array(
				
				
				'source_name' => $this->input->post('source_name'),					
				'source_updated_user_id' => $currentuserid,					
				'source_updated_at' => $date1,			
			);
			// print_r($data);exit();
		$this->Source_model->update(array('source_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function checksource(){
            
			
            $source_name	 = $this->input->post('value');
            $data = $this->Source_model->checksource($source_name);
            // print_r($data);exit();
			$json_data = json_encode($data);
            echo $json_data;
            
	}
	 public function checkEditsource(){
		
	 	
		$source_name = $this->input->post('value');
		$source_id = $this->input->post('id');
		$data = $this->Source_model->checkEditsource($source_name, $source_id);
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

		$updateData = array('source_status' => 0);
		
		$this->Source_model->update(array('source_id' => $this->input->post('id')), $updateData);

		// $source_name = $this->input->post('source_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted source '.$source_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Source_registration',
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

		if($this->input->post('source_name') == '')
		{
			$data['inputerror'][] = 'source_name';
			$data['error_string'][] = 'Source name is required';
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