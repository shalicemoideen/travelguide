<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Rooms extends MY_Controller {
	public $table = 'properties_room_category';
	public $activity = 'activity';
	public $page  = 'Rooms';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Rooms_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['meal_plan'] = $this->Rooms_model->fetch_meal_plan();
		$template['room_category'] = $this->Rooms_model->fetch_room_category_details();
		$template['property'] = $this->Rooms_model->fetch_properties_details();
		$template['property_category'] = $this->Rooms_model->fetch_property_category();
		$template['country'] = $this->Rooms_model->fetch_country();
		$template['state'] = $this->Rooms_model->fetch_state();
		$template['staff'] = $this->Rooms_model->fetch_staff_details();
		$template['body'] = 'Rooms/list';
		$template['script'] = 'Rooms/script';
		$this->load->view('template', $template);
	}

	public function get(){
    	//print($properties_id_fk);die;
		$this->load->model('Property_registration_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['properties_id'] =(isset($_REQUEST['properties_id']))?$_REQUEST['properties_id']:'';
		$param['room_meal_plan_id'] =(isset($_REQUEST['room_meal_plan_id']))?$_REQUEST['room_meal_plan_id']:'';
		$param['properties_room_category_id'] =(isset($_REQUEST['properties_room_category_id']))?$_REQUEST['properties_room_category_id']:'';
		$param['properties_room_category_createdby_user_id'] =(isset($_REQUEST['properties_room_category_createdby_user_id']))?$_REQUEST['properties_room_category_createdby_user_id']:'';
		
		
    	$data = $this->Rooms_model->getRoomsTable($param);
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

		$properties_name = $this->input->post('properties_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		
		


				$photo = $this->input->post('properties_room_category_photo');
				if(empty($photo))
				{
					$config1 = array(

					'upload_path' => "./uploads/Property-room-category-doc",
					'allowed_types' => "gif|jpg|png|jpeg|pdf|wav",
					'overwrite' => FALSE,
					'max_size' => "131072", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					// 'max_height' => "768",
					// 'max_width' => "1024"
					);

					$file1 = '';
					$this->load->library('upload',$config1);			
					if($this->upload->do_upload('properties_room_category_photo'))
					{	

						 $template = array('upload_data1' => $this->upload->data());
						 $upload_data1 = $this->upload->data();
						 //print_r($upload_data); die;
						 $file1 =$upload_data1['file_name'];

					}

					if(empty($file1))
					{
						 $file1 = $this->input->post('properties_room_category_photo_txt');

					}
				
				
				}

				$properties_room_category_name = $this->input->post('properties_room_category_name');

				$data = array(

				'properties_id_fk' => $this->input->post('properties_id_fk'),
				'room_meal_plan_id_fk' => $this->input->post('room_meal_plan_id_fk'),
				'properties_room_category_name' => $this->input->post('properties_room_category_name'),
				'properties_room_category_inventory' => $this->input->post('properties_room_category_inventory'),
				'properties_room_category_number_of_adults_allowed' => $this->input->post('properties_room_category_number_of_adults_allowed'),
				'properties_room_category_children_allowed_on_bed_sharing_basis' => $this->input->post('properties_room_category_children_allowed_on_bed_sharing_basis'),
				'properties_room_category_extra_bed_mattress_allowed_in_room' => $this->input->post('properties_room_category_extra_bed_mattress_allowed_in_room'),
				'properties_room_category_welcomes_child_all_ages' => $this->input->post('properties_room_category_welcomes_child_all_ages'),
				'properties_room_category_admission_restricted_guests_under_age' => $this->input->post('properties_room_category_admission_restricted_guests_under_age'),
				'properties_room_category_complimentary_guest_between_type' => $this->input->post('properties_room_category_complimentary_guest_between_type'),
				'properties_room_category_complimentary_guest_between_from_year' => $this->input->post('properties_room_category_complimentary_guest_between_from_year_hidden'),
				'properties_room_category_complimentary_guest_between_to_year' => $this->input->post('properties_room_category_complimentary_guest_between_to_year'),
				'properties_room_category_child_rate_applied_guest_between_type' => $this->input->post('properties_room_category_child_rate_applied_guest_between_type'),
				'properties_room_category_child_rate_applied_guest_from_year' => $this->input->post('properties_room_category_child_rate_applied_guest_from_year_hidden'),
				'properties_room_category_child_rate_applied_guest_to_year' => $this->input->post('properties_room_category_child_rate_applied_guest_to_year'),
				'properties_room_category_adult_rate_applied_guest_over' => $this->input->post('properties_room_category_adult_rate_applied_guest_over_hidden'),
				'properties_room_category_photo' => $file1,
				'properties_room_category_description' => $this->input->post('properties_room_category_description'),
				'properties_room_category_createdby_user_id' => $currentuserid,			
				'properties_room_category_createdby_user_name' => $currentusername,			
				'properties_room_category_created_date' => $date,			
				'properties_room_category_created_time' => $time,			
				'properties_room_category_status' => 1
			);
	// print_r($data);die;
		$insert = $this->Rooms_model->save1($data);

			
			

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added room category: '.$properties_room_category_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Room_category_registration',
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
		$data = $this->Rooms_model->get_by_id($id);
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

		$properties_name = $this->input->post('properties_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		
		


				$photo = $this->input->post('properties_room_category_photo');
				if(empty($photo))
				{
					$config1 = array(

					'upload_path' => "./uploads/Property-room-category-doc",
					'allowed_types' => "gif|jpg|png|jpeg|pdf|wav",
					'overwrite' => FALSE,
					'max_size' => "131072", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					// 'max_height' => "768",
					// 'max_width' => "1024"
					);

					$file1 = '';
					$this->load->library('upload',$config1);			
					if($this->upload->do_upload('properties_room_category_photo'))
					{	

						 $template = array('upload_data1' => $this->upload->data());
						 $upload_data1 = $this->upload->data();
						 //print_r($upload_data); die;
						 $file1 =$upload_data1['file_name'];

					}

					if(empty($file1))
					{
						 $file1 = $this->input->post('properties_room_category_photo_txt');

					}
				
				
				}

				$properties_room_category_name = $this->input->post('properties_room_category_name');
		
		
				$ip = $this->input->ip_address();
				$id = $this->input->post('id1');
				// echo $ip;

				$activity_data = array(
						'activity_description' => 'Edited room category: '.$properties_room_category_name.'',
						'id_fk' => $id,
						'activity_type' => 'Room_category_registration',
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
				'properties_id_fk' => $this->input->post('properties_id_fk'),
				'room_meal_plan_id_fk' => $this->input->post('room_meal_plan_id_fk'),
				'properties_room_category_name' => $this->input->post('properties_room_category_name'),
				'properties_room_category_inventory' => $this->input->post('properties_room_category_inventory'),
				'properties_room_category_number_of_adults_allowed' => $this->input->post('properties_room_category_number_of_adults_allowed'),
				'properties_room_category_children_allowed_on_bed_sharing_basis' => $this->input->post('properties_room_category_children_allowed_on_bed_sharing_basis'),
				'properties_room_category_extra_bed_mattress_allowed_in_room' => $this->input->post('properties_room_category_extra_bed_mattress_allowed_in_room'),
				'properties_room_category_welcomes_child_all_ages' => $this->input->post('properties_room_category_welcomes_child_all_ages'),
				'properties_room_category_admission_restricted_guests_under_age' => $this->input->post('properties_room_category_admission_restricted_guests_under_age'),
				'properties_room_category_complimentary_guest_between_type' => $this->input->post('properties_room_category_complimentary_guest_between_type'),
				'properties_room_category_complimentary_guest_between_from_year' => $this->input->post('properties_room_category_complimentary_guest_between_from_year_hidden'),
				'properties_room_category_complimentary_guest_between_to_year' => $this->input->post('properties_room_category_complimentary_guest_between_to_year'),
				'properties_room_category_child_rate_applied_guest_between_type' => $this->input->post('properties_room_category_child_rate_applied_guest_between_type'),
				'properties_room_category_child_rate_applied_guest_from_year' => $this->input->post('properties_room_category_child_rate_applied_guest_from_year_hidden'),
				'properties_room_category_child_rate_applied_guest_to_year' => $this->input->post('properties_room_category_child_rate_applied_guest_to_year'),
				'properties_room_category_adult_rate_applied_guest_over' => $this->input->post('properties_room_category_adult_rate_applied_guest_over_hidden'),
				'properties_room_category_photo' => $file1,
				'properties_room_category_description' => $this->input->post('properties_room_category_description'),
				'properties_room_category_createdby_user_id' => $currentuserid,			
				'properties_room_category_createdby_user_name' => $currentusername,			
				'properties_room_category_created_date' => $date,			
				'properties_room_category_created_time' => $time,			
				'properties_room_category_status' => 1
			);
				
		$this->Rooms_model->update(array('properties_room_category_id' => $this->input->post('id1')), $data);
		
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

		$updateData = array('properties_room_category_status' => 0);
		
		$this->Rooms_model->update(array('properties_room_category_id' => $this->input->post('id2')), $updateData);

		$properties_room_category_name = $this->input->post('properties_room_category_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted room category: '.$properties_room_category_name.'',
				'id_fk' => $this->input->post('id2'),
				'activity_type' => 'Room_category_registration',
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

		if($this->input->post('properties_id_fk') == '')
		{
			$data['inputerror'][] = 'properties_id_fk';
			$data['error_string'][] = 'Property is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('properties_room_category_name') == '')
		{
			$data['inputerror'][] = 'properties_room_category_name';
			$data['error_string'][] = 'Room category is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('room_meal_plan_id_fk') == '')
		{
			$data['inputerror'][] = 'room_meal_plan_id_fk';
			$data['error_string'][] = 'Meal plan is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('properties_room_category_number_of_adults_allowed') == '')
		{
			$data['inputerror'][] = 'properties_room_category_number_of_adults_allowed';
			$data['error_string'][] = 'Room number of adults allowed required';
			$data['status'] = FALSE;
		}
		if($this->input->post('properties_room_category_children_allowed_on_bed_sharing_basis') == '')
		{
			$data['inputerror'][] = 'properties_room_category_children_allowed_on_bed_sharing_basis';
			$data['error_string'][] = 'Room number of children allowed on bed sharing required';
			$data['status'] = FALSE;
		}
		if($this->input->post('properties_room_category_extra_bed_mattress_allowed_in_room') == '')
		{
			$data['inputerror'][] = 'properties_room_category_extra_bed_mattress_allowed_in_room';
			$data['error_string'][] = 'Room number of extra bed mattress allowed required';
			$data['status'] = FALSE;
		}
		if($this->input->post('properties_room_category_welcomes_child_all_ages') == 'N')
		{
			if($this->input->post('properties_room_category_admission_restricted_guests_under_age') == '')
			{
				$data['inputerror'][] = 'properties_room_category_admission_restricted_guests_under_age';
				$data['error_string'][] = 'Room admission restricted guests under age required';
				$data['status'] = FALSE;
			}
		}
		if($this->input->post('properties_room_category_complimentary_guest_between_type') == 'Y')
		{
			if($this->input->post('properties_room_category_complimentary_guest_between_to_year') == '')
			{
				$data['inputerror'][] = 'properties_room_category_complimentary_guest_between_to_year';
				$data['error_string'][] = 'Room complimentary guest to year required';
				$data['status'] = FALSE;
			}
		}
		if($this->input->post('properties_room_category_child_rate_applied_guest_between_type') == 'Y')
		{
			if($this->input->post('properties_room_category_child_rate_applied_guest_to_year') == '')
			{
				$data['inputerror'][] = 'properties_room_category_child_rate_applied_guest_to_year';
				$data['error_string'][] = 'Room child rate applied to year required';
				$data['status'] = FALSE;
			}
		}
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

}
?>