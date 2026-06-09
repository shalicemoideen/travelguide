<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class B2b_partner extends MY_Controller {
	public $table = 'b2b_partner';
	public $activity = 'activity';
	public $page  = 'B2b_partner';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('B2b_partner_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['country'] = $this->B2b_partner_model->fetch_country();;
		$template['partner'] = $this->B2b_partner_model->fetch_b2b_partner_details();
		$template['state'] = $this->B2b_partner_model->fetch_state();
		$template['staff'] = $this->B2b_partner_model->fetch_staff_details();
		$template['body'] = 'B2b_partner/list';
		$template['script'] = 'B2b_partner/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('B2b_partner_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
				
		if (!has_permission('B2B_PARTNER_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

    	$data = $this->B2b_partner_model->getB2bpartnerTable($param);
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

		$b2b_partner_agent_name = $this->input->post('b2b_partner_agent_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'b2b_partner_agent_name' => $this->input->post('b2b_partner_agent_name'),
				'b2b_partner_address' => $this->input->post('b2b_partner_address'),
				'b2b_partner_country_id_fk' => $this->input->post('b2b_partner_country_id_fk'),
				'b2b_partner_location_id_fk' => $this->input->post('b2b_partner_location_id_fk'),
				'b2b_partner_person_name' => $this->input->post('b2b_partner_person_name'),
				'b2b_partner_contact_number' => $this->input->post('b2b_partner_contact_number'),
				'b2b_partner_email_address' => $this->input->post('b2b_partner_email_address'),
				'b2b_partner_description' => $this->input->post('b2b_partner_description'),					
				'b2b_partner_createdby_user_id' => $currentuserid,					
				'b2b_partner_created_at' => $date1,						
				'b2b_partner_status' => 1
			);
		$insert = $this->B2b_partner_model->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->B2b_partner_model->get_by_id($id);
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
		
		
		
		$b2b_partner_agent_name = $this->input->post('b2b_partner_agent_name');
		
		$id = $this->input->post('id');
		
		
		$data = array(
				
				'b2b_partner_agent_name' => $this->input->post('b2b_partner_agent_name'),
				'b2b_partner_address' => $this->input->post('b2b_partner_address'),
				'b2b_partner_country_id_fk' => $this->input->post('b2b_partner_country_id_fk'),
				'b2b_partner_location_id_fk' => $this->input->post('b2b_partner_location_id_fk'),
				'b2b_partner_person_name' => $this->input->post('b2b_partner_person_name'),
				'b2b_partner_contact_number' => $this->input->post('b2b_partner_contact_number'),
				'b2b_partner_email_address' => $this->input->post('b2b_partner_email_address'),
				'b2b_partner_description' => $this->input->post('b2b_partner_description'),				
				'b2b_partner_updatedby_user_id' => $currentuserid,					
				'b2b_partner_updated_at' => $date1,			
			);
			// print_r($data);exit();
		$this->B2b_partner_model->update(array('b2b_partner_id' => $this->input->post('id')), $data);
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

		$updateData = array('b2b_partner_status' => 0);
		
		$this->B2b_partner_model->update(array('b2b_partner_id' => $this->input->post('id')), $updateData);

		// $b2b_partner_agent_name = $this->input->post('b2b_partner_agent_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted b2b partner: '.$b2b_partner_agent_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'B2B_partner_registration',
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

	function fetch_state()
	{
	  if($this->input->post('country_id'))
	  {

	  	$sel=$this->input->post('state_id');

	    echo $this->B2b_partner_model->fetch_state($this->input->post('country_id'), $sel);
	  }
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('b2b_partner_agent_name') == '')
		{
			$data['inputerror'][] = 'b2b_partner_agent_name';
			$data['error_string'][] = 'Agent name is required';
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