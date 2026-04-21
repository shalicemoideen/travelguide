<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Property_registration extends MY_Controller {
	public $table = 'properties';
	public $activity = 'activity';
	public $page  = 'Property_registration';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Property_registration_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['property'] = $this->Property_registration_model->fetch_properties_details();
		$template['property_category'] = $this->Property_registration_model->fetch_property_category();
		$template['country'] = $this->Property_registration_model->fetch_country();
		$template['state'] = $this->Property_registration_model->fetch_state();
		$template['staff'] = $this->Property_registration_model->fetch_staff_details();
		$template['body'] = 'Property_registration/list';
		$template['script'] = 'Property_registration/script';
		$this->load->view('template', $template);
	}

	public function view($properties_id)
	{
		$template['meal_plan'] = $this->Property_registration_model->fetch_meal_plan();
		$template['room_category'] = $this->Property_registration_model->fetch_room_category_details();
		$template['property'] = $this->Property_registration_model->fetch_properties_details();
		$template['property_category'] = $this->Property_registration_model->fetch_property_category();
		$template['country'] = $this->Property_registration_model->fetch_country();
		$template['state'] = $this->Property_registration_model->fetch_state();
		$template['staff'] = $this->Property_registration_model->fetch_staff_details();
		$template['records'] = $this->Property_registration_model->get_property_view_row($properties_id);
		$template['body'] = 'Property_registration/view';
		$template['script'] = 'Property_registration/script';
		$this->load->view('template', $template);
	}

	public function get_data(){
        $id = $this->input->post('id');
        $data = $this->Property_registration_model->property_data($id);
        echo json_encode($data);
    }

	public function get(){
		$this->load->model('Property_registration_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['properties_id'] =(isset($_REQUEST['properties_id']))?$_REQUEST['properties_id']:'';
		$param['property_category_id_fk'] =(isset($_REQUEST['property_category_id_fk']))?$_REQUEST['property_category_id_fk']:'';
		$param['country_id_fk'] =(isset($_REQUEST['country_id_fk']))?$_REQUEST['country_id_fk']:'';
		$param['state_id_fk'] =(isset($_REQUEST['state_id_fk']))?$_REQUEST['state_id_fk']:'';
		$param['properties_destination_id_fk'] =(isset($_REQUEST['properties_destination_id_fk']))?$_REQUEST['properties_destination_id_fk']:'';

		
		$param['properties_createdby_userid'] =(isset($_REQUEST['properties_createdby_userid']))?$_REQUEST['properties_createdby_userid']:'';
		
		
    	$data = $this->Property_registration_model->getPropertiesTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function get_roomcategory($properties_id_fk){
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
		
		
    	$data = $this->Property_registration_model->getPropertyroomcategoryTable($param,$properties_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

   public function get_uploaded_tariff($properties_id_fk){
    	//print($properties_id_fk);die;
		$this->load->model('Property_registration_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		
		$param['upload_tariff_document_created_by_user_id'] =(isset($_REQUEST['upload_tariff_document_created_by_user_id']))?$_REQUEST['upload_tariff_document_created_by_user_id']:'';

		$start_date=(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date=(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		
		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        }
		
		
    	$data = $this->Property_registration_model->getUploadtariffTable($param,$properties_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

  public function Room_tariff_management($properties_id_fk){
		$this->load->model('Property_registration_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		
		$param['properties_id'] =(isset($_REQUEST['properties_id']))?$_REQUEST['properties_id']:'';
		$param['property_category_id_fk'] =(isset($_REQUEST['property_category_id_fk']))?$_REQUEST['property_category_id_fk']:'';
		$param['properties_room_category_id'] =(isset($_REQUEST['properties_room_category_id']))?$_REQUEST['properties_room_category_id']:'';
		$start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
		$end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
			$start_date = str_replace('/', '-', $start_date);
			$param['start_date'] =  date("Y-m-d",strtotime($start_date));
		}
		
		if($end_date){
			$end_date = str_replace('/', '-', $end_date);
			$param['end_date'] =  date("Y-m-d",strtotime($end_date));
		}
		$param['room_tariff_hike_createdby_user_id'] =(isset($_REQUEST['room_tariff_hike_createdby_user_id']))?$_REQUEST['room_tariff_hike_createdby_user_id']:'';
		
		
		$data = $this->Property_registration_model->getRoomtariffTable($param,$properties_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}

  private function handle_upload($field, $upload_path, $old_value = '')
{
    if (!isset($_FILES[$field]) || empty($_FILES[$field]['name'])) {
        return $old_value;
    }

    if (!is_dir($upload_path)) {
        @mkdir($upload_path, 0777, true);
    }

    $config = [
        'upload_path'   => $upload_path,
        'allowed_types' => 'gif|jpg|png|jpeg|pdf|wav',
        'max_size'      => 131072,
        'encrypt_name'  => true,
        'overwrite'     => false,
    ];

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload($field)) {
        // If you want error back to ajax, return special value and handle
        return $old_value;
    }

    $up = $this->upload->data();
    return $up['file_name'];
}

private function validate_upload_file($field, $maxBytes = 2097152)
{
    // If file not chosen, OK (for update)
    if (!isset($_FILES[$field]) || empty($_FILES[$field]['name'])) {
        return ['ok' => true];
    }

    if (!empty($_FILES[$field]['error']) && $_FILES[$field]['error'] != UPLOAD_ERR_OK) {
        return ['ok' => false, 'msg' => 'File upload error. Please try again.'];
    }

    $name = $_FILES[$field]['name'];
    $size = (int)$_FILES[$field]['size'];

    $ext = strtolower(pathinfo($name, PATHINFO_EXTENSION));
    $allowed = ['jpg','jpeg','png','gif','pdf'];

    if (!in_array($ext, $allowed)) {
        return ['ok' => false, 'msg' => 'Only JPG, JPEG, PNG, GIF or PDF files are allowed.'];
    }

    if ($size > $maxBytes) {
        return ['ok' => false, 'msg' => 'File size must be less than 2 MB.'];
    }

    return ['ok' => true];
}


  public function ajax_add()
{
    $this->_validate();

	$fileErrors = [];

	$v1 = $this->validate_upload_file('properties_hotel_logo', 2097152);
	if(!$v1['ok']) $fileErrors['properties_hotel_logo'] = $v1['msg'];

	$v2 = $this->validate_upload_file('properties_photos', 2097152);
	if(!$v2['ok']) $fileErrors['properties_photos'] = $v2['msg'];

	if(!empty($fileErrors)){
		echo json_encode([
			"status" => FALSE,
			"fileerror" => $fileErrors
		]);
		exit;
	}

    date_default_timezone_set("Asia/Kolkata");
    $date  = date('Y-m-d');
    $time  = date('h:i:sa');
    $date1 = date('Y-m-d h:i:s a');

    $currentuserid   = $this->session->userdata('user_id');
    $currentusername = $this->session->userdata('admin_name');

    $properties_name = $this->input->post('properties_name');
    $properties_check_type = $this->input->post('properties_check_type');

    // upload (based on your preview folders)
    $file_logo  = $this->handle_upload('properties_hotel_logo', './uploads/Property-doc/logo', '');
    $file_photo = $this->handle_upload('properties_photos', './uploads/Property-doc/photo', '');

    // check time logic
    $check_in  = $this->input->post('properties_check_in_time');
    $check_out = $this->input->post('properties_check_out_time');

    if ($properties_check_type == 'T') {
        $check_in  = NULL;
        $check_out = NULL;
    }

    $data = [
        'property_category_id_fk' => $this->input->post('property_category_id_fk'),
        'country_id_fk'           => $this->input->post('country_id_fk'),
        'state_id_fk'             => $this->input->post('state_id_fk'),
        'properties_destination_id_fk' => $this->input->post('properties_destination_id_fk'),
        'properties_house_boat_type'   => $this->input->post('properties_house_boat_type'),
        'properties_hotel_url'         => $this->input->post('properties_hotel_url'),

        'properties_name'         => $properties_name,
        'properties_check_type'   => $properties_check_type,

        'properties_check_in_time'  => $check_in,
        'properties_check_out_time' => $check_out,

        'properties_sales_contact_name'         => $this->input->post('properties_sales_contact_name'),
        'properties_sales_contact_phone_number' => $this->input->post('properties_sales_contact_phone_number'),
        'properties_sales_contact_email'        => $this->input->post('properties_sales_contact_email'),

        'properties_reservation_contact_name'         => $this->input->post('properties_reservation_contact_name'),
        'properties_reservation_contact_phone_number' => $this->input->post('properties_reservation_contact_phone_number'),
        'properties_reservation_contact_email'        => $this->input->post('properties_reservation_contact_email'),

        'properties_google_map_location' => $this->input->post('properties_google_map_location'),

        'properties_hotel_logo' => $file_logo,
        'properties_photos'     => $file_photo,
        'properties_description'=> $this->input->post('properties_description'),

        'properties_createdby_userid'   => $currentuserid,
        'properties_createdby_username' => $currentusername,
        'properties_create_date'        => $date,
        'properties_create_time'        => $time,
        'properties_status'             => 1,
    ];

    $insert = $this->Property_registration_model->save($data);

    // activity log
    $ip = $this->input->ip_address();
    $activity_data = [
        'activity_description' => 'Added property: '.$properties_name,
        'id_fk'                => $insert,
        'activity_type'        => 'Property_registration',
        'activity_ip'          => $ip,
        'activity_action'      => 'Add',
        'activity_by_userid'   => $currentuserid,
        'activity_by_username' => $currentusername,
        'activity_date_time '  => $date1,
        'activity_date'        => $date,
        'activity_status'      => 1,
    ];
    $this->General_model->add($this->activity, $activity_data);

    echo json_encode(["status" => TRUE]);
}


	public function ajax_edit($id)
	{
		$data = $this->Property_registration_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}


	public function ajax_update()
{
    $this->_validate();

	$fileErrors = [];

	$v1 = $this->validate_upload_file('properties_hotel_logo', 2097152);
	if(!$v1['ok']) $fileErrors['properties_hotel_logo'] = $v1['msg'];

	$v2 = $this->validate_upload_file('properties_photos', 2097152);
	if(!$v2['ok']) $fileErrors['properties_photos'] = $v2['msg'];

	if(!empty($fileErrors)){
		echo json_encode([
			"status" => FALSE,
			"fileerror" => $fileErrors
		]);
		exit;
	}

    date_default_timezone_set("Asia/Kolkata");
    $date1 = date('Y-m-d h:i:s a');
    $date  = date('Y-m-d');

    $currentuserid   = $this->session->userdata('user_id');
    $currentusername = $this->session->userdata('admin_name');

    $id = $this->input->post('id');
    $properties_name = $this->input->post('properties_name');
    $properties_check_type = $this->input->post('properties_check_type');

    // old filenames
    $old_logo  = $this->input->post('properties_hotel_logo_txt');
    $old_photo = $this->input->post('properties_photos_txt');

    // upload new if selected, else keep old
    $file_logo  = $this->handle_upload('properties_hotel_logo', './uploads/Property-doc/logo', $old_logo);
    $file_photo = $this->handle_upload('properties_photos', './uploads/Property-doc/photo', $old_photo);

    // time logic
    $check_in  = $this->input->post('properties_check_in_time');
    $check_out = $this->input->post('properties_check_out_time');

    if ($properties_check_type == 'T') {
        $check_in  = NULL;
        $check_out = NULL;
    }

    $data = [
        'property_category_id_fk' => $this->input->post('property_category_id_fk'),
        'country_id_fk'           => $this->input->post('country_id_fk'),
        'state_id_fk'             => $this->input->post('state_id_fk'),
        'properties_destination_id_fk' => $this->input->post('properties_destination_id_fk'),
        'properties_house_boat_type'   => $this->input->post('properties_house_boat_type'),
        'properties_hotel_url'         => $this->input->post('properties_hotel_url'),

        'properties_name'       => $properties_name,
        'properties_check_type' => $properties_check_type,
        'properties_check_in_time'  => $check_in,
        'properties_check_out_time' => $check_out,

        'properties_sales_contact_name'         => $this->input->post('properties_sales_contact_name'),
        'properties_sales_contact_phone_number' => $this->input->post('properties_sales_contact_phone_number'),
        'properties_sales_contact_email'        => $this->input->post('properties_sales_contact_email'),

        'properties_reservation_contact_name'         => $this->input->post('properties_reservation_contact_name'),
        'properties_reservation_contact_phone_number' => $this->input->post('properties_reservation_contact_phone_number'),
        'properties_reservation_contact_email'        => $this->input->post('properties_reservation_contact_email'),

        'properties_google_map_location' => $this->input->post('properties_google_map_location'),

        'properties_hotel_logo' => $file_logo,
        'properties_photos'     => $file_photo,
        'properties_description'=> $this->input->post('properties_description'),
    ];

    $this->Property_registration_model->update(['properties_id' => $id], $data);

    // activity log
    $ip = $this->input->ip_address();
    $activity_data = [
        'activity_description' => 'Edited property: '.$properties_name,
        'id_fk'                => $id,
        'activity_type'        => 'Property_registration',
        'activity_ip'          => $ip,
        'activity_action'      => 'Edit',
        'activity_by_userid'   => $currentuserid,
        'activity_by_username' => $currentusername,
        'activity_date_time '  => $date1,
        'activity_date'        => $date,
        'activity_status'      => 1,
    ];
    $this->General_model->add($this->activity, $activity_data);

    echo json_encode(["status" => TRUE]);
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

		$updateData = array('properties_status' => 0);
		
		$this->Property_registration_model->update(array('properties_id' => $this->input->post('id')), $updateData);

		$properties_name = $this->input->post('properties_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted property: '.$properties_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Property_registration',
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

	public function ajax_add_room_category()
  	{
		$this->_validate1();
		
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
		$insert = $this->Property_registration_model->save1($data);

			
			

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

	public function ajax_edit_room_category($id)
	{
		$data = $this->Property_registration_model->get_by_id1($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update_room_category()
  	{
		$this->_validate1();
		
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
				
		$this->Property_registration_model->update1(array('properties_room_category_id' => $this->input->post('id1')), $data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function delete_room_category()
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
		
		$this->Property_registration_model->update1(array('properties_room_category_id' => $this->input->post('id2')), $updateData);

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

	public function ajax_add_uploaded_tariff()
  	{
		$this->_validate2();
		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date2 = date('Y-m-d h:i:s a', time());

		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$upload_tariff_document_from_date = '';
		if($this->input->post('upload_tariff_document_from_date')!='') {
        $date1 = explode('/', $this->input->post('upload_tariff_document_from_date'));
		$upload_tariff_document_from_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		}
		
		$upload_tariff_document_to_date = '';
		if($this->input->post('upload_tariff_document_to_date')!='') {
        $date1 = explode('/', $this->input->post('upload_tariff_document_to_date'));
		$upload_tariff_document_to_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		}

				$document = $this->input->post('upload_tariff_document_name');
				if(empty($document))
				{
					$config1 = array(

					'upload_path' => "./uploads/tariff-doc",
					'allowed_types' => "gif|jpg|png|jpeg|pdf|wav",
					'overwrite' => FALSE,
					'max_size' => "131072", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					// 'max_height' => "768",
					// 'max_width' => "1024"
					);

					$file1 = '';
					$this->load->library('upload',$config1);			
					if($this->upload->do_upload('upload_tariff_document_name'))
					{	

						 $template = array('upload_data' => $this->upload->data());
						 $upload_data = $this->upload->data();
						 //print_r($upload_data); die;
						 $file1 =$upload_data['file_name'];

					}

					if(empty($file1))
					{
						 $file1 = $this->input->post('upload_tariff_document_name_txt');

					}
				
				
				}


				$data = array(

				'property_id_fk' => $this->input->post('properties_id_fk'),
				'upload_tariff_document_from_date' => $upload_tariff_document_from_date,
				'upload_tariff_document_to_date' => $upload_tariff_document_to_date,				
				'upload_tariff_document_name' => $file1,
				'upload_tariff_document_description' => $this->input->post('upload_tariff_document_description'),
				'upload_tariff_document_created_by_user_id' => $currentuserid,			
				'upload_tariff_document_created_by_user_name' => $currentusername,			
				'upload_tariff_document_created_date' => $date,			
				'upload_tariff_document_created_time' => $time,			
				'upload_tariff_document_status' => 1
			);
	// print_r($data);die;
		$insert = $this->Property_registration_model->save2($data);

			
			

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added room tariff from date: '.$upload_tariff_document_from_date.' to date '.$upload_tariff_document_to_date.'',
				'id_fk' => $insert,
				'activity_type' => 'Room_tariff_document_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Add',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date2,
				'activity_date' => $date,				
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_uploaded_tariff($id)
	{
		$data = $this->Property_registration_model->get_by_id2($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update_uploaded_tariff()
  	{
		$this->_validate2();
		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date2 = date('Y-m-d h:i:s a', time());

		$properties_name = $this->input->post('properties_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$upload_tariff_document_from_date = '';
		if($this->input->post('upload_tariff_document_from_date')!='') {
        $date1 = explode('/', $this->input->post('upload_tariff_document_from_date'));
		$upload_tariff_document_from_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		}
		
		$upload_tariff_document_to_date = '';
		if($this->input->post('upload_tariff_document_to_date')!='') {
        $date1 = explode('/', $this->input->post('upload_tariff_document_to_date'));
		$upload_tariff_document_to_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		}
		


				$document = $this->input->post('upload_tariff_document_name');
				if(empty($document))
				{
					$config1 = array(

					'upload_path' => "./uploads/tariff-doc",
					'allowed_types' => "gif|jpg|png|jpeg|pdf|wav",
					'overwrite' => FALSE,
					'max_size' => "131072", // Can be set to particular file size , here it is 2 MB(2048 Kb)
					// 'max_height' => "768",
					// 'max_width' => "1024"
					);

					$file1 = '';
					$this->load->library('upload',$config1);			
					if($this->upload->do_upload('upload_tariff_document_name'))
					{	

						 $template = array('upload_data' => $this->upload->data());
						 $upload_data = $this->upload->data();
						 //print_r($upload_data); die;
						 $file1 =$upload_data['file_name'];

					}

					if(empty($file1))
					{
						 $file1 = $this->input->post('upload_tariff_document_name_txt');

					}
				
				
				}

		
		
				$ip = $this->input->ip_address();
				$id = $this->input->post('id3');
				// echo $ip;

				$activity_data = array(
						'activity_description' => 'Edited room tariff from date: '.$upload_tariff_document_from_date.' to date '.$upload_tariff_document_to_date.'',
						'id_fk' => $id,
						'activity_type' => 'Room_tariff_document_registration',
						'activity_ip' => $ip,
						'activity_action' => 'Edit',
						'activity_by_userid' => $currentuserid,
						'activity_by_username' => $currentusername,
						'activity_date_time	' => $date2,	
						'activity_date' => $date,			
						'activity_status' => 1,
					);
				
				$this->General_model->add($this->activity,$activity_data);

				$data = array(
				// 'property_id_fk' => $this->input->post('properties_id_fk'),
				'upload_tariff_document_from_date' => $upload_tariff_document_from_date,
				'upload_tariff_document_to_date' => $upload_tariff_document_to_date,				
				'upload_tariff_document_name' => $file1,
				'upload_tariff_document_description' => $this->input->post('upload_tariff_document_description'),
				// 'upload_tariff_document_created_by_user_id' => $currentuserid,			
				// 'upload_tariff_document_created_by_user_name' => $currentusername,			
				// 'upload_tariff_document_created_date' => $date,			
				// 'upload_tariff_document_created_time' => $time,			
				// 'upload_tariff_document_status' => 1
			);
				
		$this->Property_registration_model->update2(array('upload_tariff_document_id' => $this->input->post('id3')), $data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function delete_uploaded_tariff()
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
		
		$date2 = date('Y-m-d h:i:s a', time());

		$updateData = array('upload_tariff_document_status' => 0);
		
		$this->Property_registration_model->update2(array('upload_tariff_document_id' => $this->input->post('id4')), $updateData);

		$upload_tariff_document_from_date = '';
		if($this->input->post('upload_tariff_document_from_date')!='') {
        $date1 = explode('/', $this->input->post('upload_tariff_document_from_date'));
		$upload_tariff_document_from_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		}
		
		$upload_tariff_document_to_date = '';
		if($this->input->post('upload_tariff_document_to_date')!='') {
        $date1 = explode('/', $this->input->post('upload_tariff_document_to_date'));
		$upload_tariff_document_to_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		}
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted room tariff from date: '.$upload_tariff_document_from_date.' to date '.$upload_tariff_document_to_date.'',
				'id_fk' => $this->input->post('id4'),
				'activity_type' => 'Room_tariff_document_registration',
				// 'activity_order_number' => $invoice_order_number1,
				'activity_ip' => $ip,
				'activity_action' => 'Delete',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date2,
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

		if($this->input->post('properties_name') == '')
		{
			$data['inputerror'][] = 'properties_name';
			$data['error_string'][] = 'Property name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('property_category_id_fk') == '')
		{
			$data['inputerror'][] = 'property_category_id_fk';
			$data['error_string'][] = 'Property category is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('country_id_fk') == '')
		{
			$data['inputerror'][] = 'country_id_fk';
			$data['error_string'][] = 'Country is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('state_id_fk') == '')
		{
			$data['inputerror'][] = 'state_id_fk';
			$data['error_string'][] = 'Location is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('properties_destination_id_fk') == '')
		{
			$data['inputerror'][] = 'properties_destination_id_fk';
			$data['error_string'][] = 'Destination is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('properties_house_boat_type') == '')
		{
			$data['inputerror'][] = 'properties_house_boat_type';
			$data['error_string'][] = 'House boat type is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('properties_check_type') == '')
		{
			$data['inputerror'][] = 'properties_check_type';
			$data['error_string'][] = 'Property checking type is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('properties_check_type') == '')
		{
			if($this->input->post('properties_check_in_time') == '')
			{
				$data['inputerror'][] = 'properties_check_in_time';
				$data['error_string'][] = 'Check in time is required';
				$data['status'] = FALSE;
			}
			
			if($this->input->post('properties_check_out_time') == '')
			{
				$data['inputerror'][] = 'properties_check_out_time';
				$data['error_string'][] = 'Check out time is required';
				$data['status'] = FALSE;
			}
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate1()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

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
	
	private function _validate2()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('upload_tariff_document_from_date') == '')
		{
			$data['inputerror'][] = 'upload_tariff_document_from_date';
			$data['error_string'][] = 'From date is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('upload_tariff_document_to_date') == '')
		{
			$data['inputerror'][] = 'upload_tariff_document_to_date';
			$data['error_string'][] = 'To date is required';
			$data['status'] = FALSE;
		}

		$id = $this->input->post('id3');
		if($id == '')
		{
			if($_FILES['upload_tariff_document_name']['name'] == '' && $this->input->post('upload_tariff_document_name') == '')
			{
				$data['inputerror'][] = 'upload_tariff_document_name';
				$data['error_string'][] = 'Document is required';
				$data['status'] = FALSE;
			}
		}
		if($id != '')
		{
			if($_FILES['upload_tariff_document_name']['name'] == '' && $this->input->post('upload_tariff_document_name_txt') == '')
			{
				$data['inputerror'][] = 'upload_tariff_document_name';
				$data['error_string'][] = 'Document is required';
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