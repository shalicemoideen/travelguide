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
		$this->load->model('Rooms_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';

		// Removed filter dropdown data loading - now loaded via AJAX
		// $template['property'] = $this->Property_registration_model->fetch_properties_details();
		// $template['staff'] = $this->Property_registration_model->fetch_staff_details();

		// Removed modal dropdown data loading - now loaded via AJAX for faster page load
		// $template['property_category'] = $this->Property_registration_model->fetch_property_category();
		// $template['country'] = $this->Property_registration_model->fetch_country();
		// $template['location'] = $this->Property_registration_model->fetch_location();
		// $template['state'] = $this->Property_registration_model->fetch_state();

		$template['body'] = 'Property_registration/list';
		$template['script'] = 'Property_registration/script';
		$this->load->view('template', $template);
	}

	public function view($properties_id)
	{
		$template['meal_plan'] = $this->Rooms_model->fetch_meal_plan();
		// Load only property details for faster page load (removed meal_plan and inclusions)
		$template['records'] = $this->Property_registration_model->get_property_view_row($properties_id);
		$template['body'] = 'Property_registration/view';
		$template['script'] = 'Property_registration/script';
		$this->load->view('template', $template);
	}

	/**
	 * Lazy-loaded tab: Rooms
	 */
	public function tab_room_details($properties_id)
	{
		// Removed filter dropdown data loading - now loaded via AJAX
		$data['records'] = $this->Property_registration_model->get_property_view_row($properties_id);
		$this->load->view('Property_registration/tab_room_details', $data);
	}

	/**
	 * Lazy-loaded tab: Upload Tariff
	 */
	public function tab_upload_tariff($properties_id)
	{
		// Removed staff loading - now loaded via AJAX in filter dropdown
		$data['records'] = $this->Property_registration_model->get_property_view_row($properties_id);
		$this->load->view('Property_registration/tab_upload_tariff', $data);
	}

	/**
	 * Lazy-loaded tab: Room Tariff
	 */
	public function tab_room_tariff($properties_id)
	{
		// Removed filter dropdown data loading - now loaded via AJAX
		$data['records'] = $this->Property_registration_model->get_property_view_row($properties_id);
		$this->load->view('Property_registration/tab_room_tariff', $data);
	}

	/**
	 * Lazy-loaded tab: Room Hike Tariff
	 */
	public function tab_room_hike_tariff($properties_id)
	{
		$data['records'] = $this->Property_registration_model->get_property_view_row($properties_id);
		$this->load->view('Property_registration/tab_room_hike_tariff', $data);
	}

	/**
	 * Lazy-loaded tab: Property inclusion
	 */
	public function tab_property_inclusion($properties_id)
	{
		// Removed filter dropdown data loading - now loaded via AJAX
		$data['records'] = $this->Property_registration_model->get_property_view_row($properties_id);
		$this->load->view('Property_registration/tab_property_inclusion', $data);
	}

	/**
	 * Lazy-loaded tab: Property inclusion
	 */
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
		$param['location_id_fk'] =(isset($_REQUEST['location_id_fk']))?$_REQUEST['location_id_fk']:'';
		$param['properties_destination_id_fk'] =(isset($_REQUEST['properties_destination_id_fk']))?$_REQUEST['properties_destination_id_fk']:'';

		
		$param['properties_createdby_userid'] =(isset($_REQUEST['properties_createdby_userid']))?$_REQUEST['properties_createdby_userid']:'';
		
		if (!has_permission('PROPERTY_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

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

		if (!has_permission('ROOM_DETAILS_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

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

		if (!has_permission('UPLOAD_TARIFF_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

		$param['upload_tariff_document_created_by_user_id'] =(isset($_REQUEST['upload_tariff_document_created_by_user_id']))?$_REQUEST['upload_tariff_document_created_by_user_id']:'';

		// Handle separate start_date and end_date parameters
		$start_date=(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date=(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';

		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] = date("Y-m-d",strtotime($start_date));
        }

        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] = date("Y-m-d",strtotime($end_date));
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

		if (!has_permission('ROOM_TARIFF_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

		// Handle separate start_date and end_date parameters
		$start_date=(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date=(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';

		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] = date("Y-m-d",strtotime($start_date));
        }

        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] = date("Y-m-d",strtotime($end_date));
        }

		$param['room_tariff_hike_createdby_user_id'] =(isset($_REQUEST['room_tariff_hike_createdby_user_id']))?$_REQUEST['room_tariff_hike_createdby_user_id']:'';


		$data = $this->Property_registration_model->getRoomtariffTable($param,$properties_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function Room_tariff_hike_management($properties_id_fk){
		$this->load->model('Property_registration_model');
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		if (!has_permission('ROOM_TARIFF_HIKE_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

		// Handle room tariff date range
		$room_tariff_start_date =(isset($_REQUEST['room_tariff_start_date']))?$_REQUEST['room_tariff_start_date']:'';
		$room_tariff_end_date =(isset($_REQUEST['room_tariff_end_date']))?$_REQUEST['room_tariff_end_date']:'';
		if($room_tariff_start_date){
			$room_tariff_start_date = str_replace('/', '-', $room_tariff_start_date);
			$param['room_tariff_from_date_filter'] = date("Y-m-d",strtotime($room_tariff_start_date));
		}
		if($room_tariff_end_date){
			$room_tariff_end_date = str_replace('/', '-', $room_tariff_end_date);
			$param['room_tariff_to_date_filter'] = date("Y-m-d",strtotime($room_tariff_end_date));
		}

		// Handle hike tariff date range
		$hike_tariff_start_date =(isset($_REQUEST['hike_tariff_start_date']))?$_REQUEST['hike_tariff_start_date']:'';
		$hike_tariff_end_date =(isset($_REQUEST['hike_tariff_end_date']))?$_REQUEST['hike_tariff_end_date']:'';
		if($hike_tariff_start_date){
			$hike_tariff_start_date = str_replace('/', '-', $hike_tariff_start_date);
			$param['hike_room_tariff_hike_from_date_filter'] = date("Y-m-d",strtotime($hike_tariff_start_date));
		}
		if($hike_tariff_end_date){
			$hike_tariff_end_date = str_replace('/', '-', $hike_tariff_end_date);
			$param['hike_room_tariff_hike_to_date_filter'] = date("Y-m-d",strtotime($hike_tariff_end_date));
		}

		$param['hike_room_tariff_hike_createdby_user_id'] =(isset($_REQUEST['hike_room_tariff_hike_createdby_user_id']))?$_REQUEST['hike_room_tariff_hike_createdby_user_id']:'';


		$data = $this->Property_registration_model->getRoomHiketariffTable($param,$properties_id_fk);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function get_property_inclusions($properties_id_fk){
    	//print($properties_id_fk);die;
		$this->load->model('Property_registration_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		if (!has_permission('PROPERTY_INCLUSION_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

		$param['property_inclusions_id_filter'] =(isset($_REQUEST['property_inclusions_id_filter']))?$_REQUEST['property_inclusions_id_filter']:'';
		$param['property_inclusions_created_by_userid'] =(isset($_REQUEST['property_inclusions_created_by_userid']))?$_REQUEST['property_inclusions_created_by_userid']:'';


    	$data = $this->Property_registration_model->getPropertyinclusionsTable($param,$properties_id_fk);
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
        'max_size'      => 40960, // 40MB in KB
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

	$v1 = $this->validate_upload_file('properties_hotel_logo', 40 * 1024 * 1024); ///40mb
	if(!$v1['ok']) $fileErrors['properties_hotel_logo'] = $v1['msg'];

	$v2 = $this->validate_upload_file('properties_photos', 40 * 1024 * 1024);
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
        'location_id_fk'          => $this->input->post('location_id_fk'),
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
        'properties_created_at'        => $date1,
        'properties_status'             => 1,
    ];

    $insert = $this->Property_registration_model->save($data);

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

	$v1 = $this->validate_upload_file('properties_hotel_logo', 40 * 1024 * 1024);
	if(!$v1['ok']) $fileErrors['properties_hotel_logo'] = $v1['msg'];

	$v2 = $this->validate_upload_file('properties_photos', 40 * 1024 * 1024);
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
        'location_id_fk'          => $this->input->post('location_id_fk'),
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
		'properties_updatedby_userid'   => $currentuserid,
        'properties_updated_at'        => $date1,
    ];

    $this->Property_registration_model->update(['properties_id' => $id], $data);

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

		// $properties_name = $this->input->post('properties_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted property: '.$properties_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Property_registration',
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

	public function ajax_add_room_category()
  	{
		if (!has_permission('ROOM_DETAILS_CREATE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

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
				'properties_room_category_created_at' => $date1,						
				'properties_room_category_status' => 1
			);
	// print_r($data);die;
		$insert = $this->Property_registration_model->save1($data);
		
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
		if (!has_permission('ROOM_DETAILS_UPDATE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

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

				$id = $this->input->post('id1');
				

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
				'properties_room_category_updatedby_user_id' => $currentuserid,					
				'properties_room_category_updated_at' => $date1,						
				'properties_room_category_status' => 1
			);
				
		$this->Property_registration_model->update1(array('properties_room_category_id' => $this->input->post('id1')), $data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function delete_room_category()
	{
		if (!has_permission('ROOM_DETAILS_DELETE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

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

		// $properties_room_category_name = $this->input->post('properties_room_category_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted room category: '.$properties_room_category_name.'',
		// 		'id_fk' => $this->input->post('id2'),
		// 		'activity_type' => 'Room_category_registration',
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

	public function ajax_add_uploaded_tariff()
  	{
		if (!has_permission('UPLOAD_TARIFF_CREATE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

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
		
		// $upload_tariff_document_from_date = '';
		// if($this->input->post('upload_tariff_document_from_date')!='') {
        // $date1 = explode('/', $this->input->post('upload_tariff_document_from_date'));
		// $upload_tariff_document_from_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		// }
		
		// $upload_tariff_document_to_date = '';
		// if($this->input->post('upload_tariff_document_to_date')!='') {
        // $date1 = explode('/', $this->input->post('upload_tariff_document_to_date'));
		// $upload_tariff_document_to_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		// }

		$upload_tariff_document_from_date = str_replace('/', '-', $this->input->post('upload_tariff_document_from_date'));
		$upload_tariff_document_to_date   = str_replace('/', '-', $this->input->post('upload_tariff_document_to_date'));

		$upload_tariff_document_from_date = date('Y-m-d', strtotime($upload_tariff_document_from_date));
		$upload_tariff_document_to_date   = date('Y-m-d', strtotime($upload_tariff_document_to_date));

				$document = $this->input->post('upload_tariff_document_name');
				if(empty($document))
				{
					$config1 = array(

					'upload_path' => "./uploads/tariff-doc",
					'allowed_types' => "gif|jpg|png|jpeg|pdf|wav|doc|docx|xls|xlsx",
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
				'upload_tariff_document_created_at' => $date2,					
				'upload_tariff_document_status' => 1
			);
	// print_r($data);die;
		$insert = $this->Property_registration_model->save2($data);

			
			

		
		
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
		if (!has_permission('UPLOAD_TARIFF_UPDATE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

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
		
		// $upload_tariff_document_from_date = '';
		// if($this->input->post('upload_tariff_document_from_date')!='') {
        // $date1 = explode('/', $this->input->post('upload_tariff_document_from_date'));
		// $upload_tariff_document_from_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		// }
		
		// $upload_tariff_document_to_date = '';
		// if($this->input->post('upload_tariff_document_to_date')!='') {
        // $date1 = explode('/', $this->input->post('upload_tariff_document_to_date'));
		// $upload_tariff_document_to_date = $date1[2].'-'.$date1[1].'-'.$date1[0];
		// }
		
		$upload_tariff_document_from_date = str_replace('/', '-', $this->input->post('upload_tariff_document_from_date'));
		$upload_tariff_document_to_date   = str_replace('/', '-', $this->input->post('upload_tariff_document_to_date'));

		$upload_tariff_document_from_date = date('Y-m-d', strtotime($upload_tariff_document_from_date));
		$upload_tariff_document_to_date   = date('Y-m-d', strtotime($upload_tariff_document_to_date));

				$document = $this->input->post('upload_tariff_document_name');
				if(empty($document))
				{
					$config1 = array(

					'upload_path' => "./uploads/tariff-doc",
					'allowed_types' => "gif|jpg|png|jpeg|pdf|wav|doc|docx|xls|xlsx",
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

		

				$id = $this->input->post('id3');
				

				$data = array(
				// 'property_id_fk' => $this->input->post('properties_id_fk'),
				'upload_tariff_document_from_date' => $upload_tariff_document_from_date,
				'upload_tariff_document_to_date' => $upload_tariff_document_to_date,				
				'upload_tariff_document_name' => $file1,
				'upload_tariff_document_description' => $this->input->post('upload_tariff_document_description'),
				'upload_tariff_document_updated_by_user_id' => $currentuserid,						
				'upload_tariff_document_updated_at' => $date2,			
			);
				
		$this->Property_registration_model->update2(array('upload_tariff_document_id' => $this->input->post('id3')), $data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function delete_uploaded_tariff()
	{
		if (!has_permission('UPLOAD_TARIFF_DELETE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

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
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted room tariff from date: '.$upload_tariff_document_from_date.' to date '.$upload_tariff_document_to_date.'',
		// 		'id_fk' => $this->input->post('id4'),
		// 		'activity_type' => 'Room_tariff_document_registration',
		// 		// 'activity_order_number' => $invoice_order_number1,
		// 		'activity_ip' => $ip,
		// 		'activity_action' => 'Delete',
		// 		'activity_by_userid' => $currentuserid,
		// 		'activity_by_username' => $currentusername,
		// 		'activity_date_time	' => $date2,
		// 		'activity_date' => $date,
		// 		'activity_status' => 1,
		// 	);
		
		// $this->General_model->add($this->activity,$activity_data);
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_add_property_inclusion()
  	{
		if (!has_permission('PROPERTY_INCLUSION_CREATE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

		$this->_validate3();
		
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
		
		
		$property_inclusions_name = $this->input->post('property_inclusions_name');

				$data = array(

				'property_id_fk' => $this->input->post('properties_id_fk'),
				'property_inclusions_name' => $property_inclusions_name,
				'property_inclusions_amount' => $this->input->post('property_inclusions_amount'),				
				'property_inclusions_description' => $this->input->post('property_inclusions_description'),
				'property_inclusions_created_by_userid' => $currentuserid,						
				'property_inclusions_created_at' => $date2,						
				'property_inclusions_status' => 1
			);
	// print_r($data);die;
		$insert = $this->Property_registration_model->save3($data);

			
	
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_property_inclusions($id)
	{
		$data = $this->Property_registration_model->get_by_id3($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_update_property_inclusions()
  	{
		if (!has_permission('PROPERTY_INCLUSION_UPDATE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

		$this->_validate3();
		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date2 = date('Y-m-d h:i:s a', time());

		$property_inclusions_name = $this->input->post('property_inclusions_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		
		
				$id = $this->input->post('id');
				
				

				$data = array(

				// 'property_id_fk' => $this->input->post('properties_id_fk'),
				'property_inclusions_name' => $property_inclusions_name,
				'property_inclusions_amount' => $this->input->post('property_inclusions_amount'),				
				'property_inclusions_description' => $this->input->post('property_inclusions_description'),
				'property_inclusions_updated_by_userid' => $currentuserid,						
				'property_inclusions_updated_at' => $date2,			
			);
				
		$this->Property_registration_model->update3(array('property_inclusions_id' => $this->input->post('id')), $data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function delete_property_inclusions()
	{
		if (!has_permission('PROPERTY_INCLUSION_DELETE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

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

		$updateData = array('property_inclusions_status' => 0);
		
		$this->Property_registration_model->update3(array('property_inclusions_id' => $this->input->post('id')), $updateData);

		
		// $ip = $this->input->ip_address();
		
		// $property_inclusions_name = $this->input->post('property_inclusions_name');

		// $activity_data = array(
		// 		'activity_description' => 'Deleted property inclusion: '.$property_inclusions_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Property_Inclusions_registration',
		// 		// 'activity_order_number' => $invoice_order_number1,
		// 		'activity_ip' => $ip,
		// 		'activity_action' => 'Delete',
		// 		'activity_by_userid' => $currentuserid,
		// 		'activity_by_username' => $currentusername,
		// 		'activity_date_time	' => $date2,
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

		if($this->input->post('location_id_fk') == '')
		{
			$data['inputerror'][] = 'location_id_fk';
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
				$data['error_string'][] = 'Room child rate applied to year required,';
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

	private function _validate3()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('property_inclusions_name') == '')
		{
			$data['inputerror'][] = 'property_inclusions_name';
			$data['error_string'][] = 'inclusion name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('property_inclusions_amount') == '')
		{
			$data['inputerror'][] = 'property_inclusions_amount';
			$data['error_string'][] = 'amount is required';
			$data['status'] = FALSE;
		}

		

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	// AJAX endpoints for dropdown data
	public function get_properties_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		
		$this->db->select('properties_id as id, properties_name as text');
		$this->db->from('properties');
		$this->db->where('properties_status', 1);
		
		if ($search) {
			$this->db->like('properties_name', $search);
		}
		
		$this->db->order_by('properties_name', 'ASC');
		// $this->db->limit(50, ($page - 1) * 50);
		
		$query = $this->db->get();
		// echo $this->db->last_query();exit();
		$results = $query->result();
		
		echo json_encode(['results' => $results]);
	}

	public function get_property_category_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		
		$this->db->select('property_category_id as id, property_category_name as text');
		$this->db->from('property_category');
		$this->db->where('property_category_status', 1);
		
		if ($search) {
			$this->db->like('property_category_name', $search);
		}
		
		$this->db->order_by('property_category_name', 'ASC');
		// $this->db->limit(50, ($page - 1) * 50);
		
		$query = $this->db->get();
		$results = $query->result();
		
		echo json_encode(['results' => $results]);
	}

	public function get_country_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		
		$this->db->select('id, name as text');
		$this->db->from('country');
		
		if ($search) {
			$this->db->like('name', $search);
		}
		
		$this->db->order_by('name', 'ASC');
		// $this->db->limit(50, ($page - 1) * 50);
		
		$query = $this->db->get();
		$results = $query->result();
		
		echo json_encode(['results' => $results]);
	}

	public function get_state_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		
		$this->db->select('state_id as id, state_name as text');
		$this->db->from('state');
		$this->db->where('state_status', 1);
		
		if ($search) {
			$this->db->like('state_name', $search);
		}
		
		$this->db->order_by('state_name', 'ASC');
		// $this->db->limit(50, ($page - 1) * 50);
		
		$query = $this->db->get();
		$results = $query->result();
		
		echo json_encode(['results' => $results]);
	}

	public function get_staff_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;

		$this->db->select('user_id as id, admin_name as text');
		$this->db->from('user_details');
		$this->db->where('user_status', 1);

		if ($search) {
			$this->db->like('admin_name', $search);
		}

		$this->db->order_by('admin_name', 'ASC');
		// $this->db->limit(50, ($page - 1) * 50);

		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get_location_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;

		$this->db->select('location_id as id, location_name as text');
		$this->db->from('location');
		$this->db->where('location_status', 1);

		if ($search) {
			$this->db->like('location_name', $search);
		}

		$this->db->order_by('location_name', 'ASC');
		// $this->db->limit(50, ($page - 1) * 50);

		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get_destination_by_location_dropdown()
	{
		$location_id = $this->input->get('location_id');

		$this->db->select('state_id as id, state_name as text');
		$this->db->from('state');
		$this->db->where('state_status', 1);
		$this->db->where('location_id_fk', $location_id);

		$this->db->order_by('state_name', 'ASC');

		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get_room_category_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		$properties_id = $this->input->get('properties_id');

		$this->db->select('properties_room_category_id as id, properties_room_category_name as text');
		$this->db->from('properties_room_category');
		$this->db->where('properties_room_category_status', 1);

		if ($properties_id) {
			$this->db->where('properties_id_fk', $properties_id);
		}

		if ($search) {
			$this->db->like('properties_room_category_name', $search);
		}

		$this->db->limit(20, ($page - 1) * 20);
		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get_property_inclusion_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;
		$properties_id = $this->input->get('properties_id');

		$this->db->select('property_inclusions_id as id, property_inclusions_name as text');
		$this->db->from('property_inclusions');
		$this->db->where('property_inclusions_status', 1);

		if ($properties_id) {
			$this->db->where('property_id_fk', $properties_id);
		}

		if ($search) {
			$this->db->like('property_inclusions_name', $search);
		}

		$this->db->limit(20, ($page - 1) * 20);
		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get_meal_plan_dropdown()
	{
		$search = $this->input->get('q');
		$page = $this->input->get('page') ? $this->input->get('page') : 1;

		$this->db->select('meal_plan_id as id, meal_plan_name as text');
		$this->db->from('meal_plan');
		$this->db->where('meal_plan_status', 1);

		if ($search) {
			$this->db->like('meal_plan_name', $search);
		}

		$this->db->order_by('meal_plan_name', 'ASC');
		// $this->db->limit(50, ($page - 1) * 50);

		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}
}
?>