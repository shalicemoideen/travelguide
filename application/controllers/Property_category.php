<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Property_category extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Property_category';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Property_category_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		$template['category'] = $this->Property_category_model->fetch_property_category_details();
		$template['staff'] = $this->Property_category_model->fetch_staff_details();
		$template['body'] = 'Property_category/list';
		$template['script'] = 'Property_category/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Property_category_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['property_category_id'] =(isset($_REQUEST['property_category_id']))?$_REQUEST['property_category_id']:'';
		$param['property_category_createdby_user_id'] =(isset($_REQUEST['property_category_createdby_user_id']))?$_REQUEST['property_category_createdby_user_id']:'';

		
    	$data = $this->Property_category_model->getPropertycategoryTable($param);
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

		$property_category_name = $this->input->post('property_category_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'property_category_name' => $this->input->post('property_category_name'),
				'property_category_description' => $this->input->post('property_category_description'),					
				'property_category_createdby_user_id' => $currentuserid,			
				'property_category_createdby_user_name' => $currentusername,			
				'property_category_created_date' => $date,			
				'property_category_created_time' => $time,			
				'property_category_status' => 1
			);
		$insert = $this->Property_category_model->save($data);

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added property category: '.$property_category_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Property_category_registration',
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
		$data = $this->Property_category_model->get_by_id($id);
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
		
		
		
		$property_category_name = $this->input->post('property_category_name');
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited property category: '.$property_category_name.'',
				'id_fk' => $id,
				'activity_type' => 'Property_category_registration',
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
				
				'property_category_name' => $this->input->post('property_category_name'),
				'property_category_description' => $this->input->post('property_category_description'),					
				// 'property_category_createdby_user_id' => $currentuserid,			
				// 'property_category_createdby_user_name' => $currentusername,			
				// 'property_category_created_date' => $date,			
				// 'property_category_created_time' => $time,			
				// 'property_category_status' => 1
			);
			// print_r($data);exit();
		$this->Property_category_model->update(array('property_category_id' => $this->input->post('id')), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function checkproperty_category(){
            
			
            $property_category_name	 = $this->input->post('value');
            $data = $this->Property_category_model->checkproperty_category($property_category_name);
            // print_r($data);exit();
			$json_data = json_encode($data);
            echo $json_data;
            
	}
	 public function checkEditproperty_category(){
		
	 	
		$property_category_name = $this->input->post('value');
		$property_category_id = $this->input->post('id');
		$data = $this->Property_category_model->checkEditproperty_category($property_category_name, $property_category_id);
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

		$updateData = array('property_category_status' => 0);
		
		$this->Property_category_model->update(array('property_category_id' => $this->input->post('id')), $updateData);

		$property_category_name = $this->input->post('property_category_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted property category '.$property_category_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Property_category_registration',
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

		if($this->input->post('property_category_name') == '')
		{
			$data['inputerror'][] = 'property_category_name';
			$data['error_string'][] = 'category name is required';
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