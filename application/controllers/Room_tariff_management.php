<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Room_tariff_management extends MY_Controller {
	public $table = 'room_tariff_hike';
	public $room_tariff_hike_rate = 'room_tariff_hike_rate';
	public $room_tariff_week_days_rate = 'room_tariff_week_days_rate';
	public $hike_room_tariff_hike_rate = 'hike_room_tariff_hike_rate';
	public $properties = 'properties';
	public $activity = 'activity';
	public $page  = 'Room_tariff_management';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Room_tariff_management_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['room_category'] = $this->Room_tariff_management_model->fetch_room_category_details();
		$template['property'] = $this->Room_tariff_management_model->fetch_properties_details();
		$template['property_category'] = $this->Room_tariff_management_model->fetch_property_category();
		$template['staff'] = $this->Room_tariff_management_model->fetch_staff_details();
		$template['body'] = 'Room_tariff_management/list';
		$template['script'] = 'Room_tariff_management/script';
		$this->load->view('template', $template);
	}

	public function view($room_tariff_hike_id)
	{
		$template['room_category'] = $this->Room_tariff_management_model->fetch_room_category_details();
		$template['property'] = $this->Room_tariff_management_model->fetch_properties_details();
		$template['property_category'] = $this->Room_tariff_management_model->fetch_property_category();
		$template['staff'] = $this->Room_tariff_management_model->fetch_staff_details();
		$template['records'] = $this->Room_tariff_management_model->get_room_tariff_view_row($room_tariff_hike_id);
		$template['body'] = 'Room_tariff_management/view';
		$template['script'] = 'Room_tariff_management/script';
		$this->load->view('template', $template);
	}

	public function ajax_view($id)
	{
		$id = (int)$id;

		$data = $this->Room_tariff_management_model->get_tariff_view($id);

		if (!$data) {
			echo json_encode(array("status" => false, "message" => "Not found"));
			return;
		}

		echo json_encode(array(
			"status" => true,
			"data"   => $data
		));
	}


	public function get_data(){
        $id = $this->input->post('id');
        $data = $this->Room_tariff_management_model->tariff_data($id);
        echo json_encode($data);
    }

	public function get(){
		$this->load->model('Room_tariff_management_model');
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
		$param['transporter_createdby_user_id'] =(isset($_REQUEST['transporter_createdby_user_id']))?$_REQUEST['transporter_createdby_user_id']:'';
		
		
    	$data = $this->Room_tariff_management_model->getRoomtariffTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

	private function parse_dmy_to_ymd($input)
{
    $input = trim((string)$input);
    if ($input === '') return '';

    $input = str_replace('/', '-', $input);

    $dt = DateTime::createFromFormat('d-m-Y', $input);
    if ($dt && $dt->format('d-m-Y') === $input) {
        return $dt->format('Y-m-d');
    }
    return ''; // invalid
}

public function ajax_last_hike_tariff()
{
    $property_id = (int)$this->input->post('hike_properties_id_fk');
    $from_in     = $this->input->post('hike_room_tariff_hike_from_date');

    if (!$property_id) {
        echo json_encode(["status" => false, "message" => "Property required"]);
        return;
    }

    $new_from = '';
    if ($from_in != '') {
        $new_from = $this->parse_dmy_to_ymd($from_in);
        if ($new_from === '') {
            echo json_encode(["status" => false, "message" => "Invalid date format. Use dd/mm/yyyy"]);
            return;
        }
    }

    $data = $this->Room_tariff_management_model->get_last_hike_tariff_for_property($property_id, $new_from);

    // Keep same behavior as your old function:
    if (!$data) {
        echo json_encode(["status" => true, "data" => null]);
        return;
    }

    echo json_encode(["status" => true, "data" => $data]);
}

    public function get_hikeRoomtariff($room_tariff_hike_id_fk){
    	//print($properties_id_fk);die;
		$this->load->model('Room_tariff_management_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['properties_id'] =(isset($_REQUEST['properties_id']))?$_REQUEST['properties_id']:'';
		$param['property_category_id_fk'] =(isset($_REQUEST['property_category_id_fk']))?$_REQUEST['property_category_id_fk']:'';
		$param['properties_room_category_id'] =(isset($_REQUEST['properties_room_category_id']))?$_REQUEST['properties_room_category_id']:'';
		$param['hike_room_tariff_hike_createdby_user_id'] =(isset($_REQUEST['hike_room_tariff_hike_createdby_user_id']))?$_REQUEST['hike_room_tariff_hike_createdby_user_id']:'';
		
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
    	$data = $this->Room_tariff_management_model->getHikeRoomtariffTable($param,$room_tariff_hike_id_fk);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function fetch_property_rooms(){
            
            $properties_id = $this->input->post('properties_id');
            $data = $this->Room_tariff_management_model->fetch_property_rooms($properties_id);
            $json_data = json_encode($data);
            echo $json_data;
            
        }

    public function rooms_array_list(){
    	
      $properties_id = $this->input->post('properties_id');

      
      echo json_encode($this->Room_tariff_management_model->rooms_array_list($properties_id));
    }

  public function weekdays_array_list(){ 

      
      echo json_encode($this->Room_tariff_management_model->weekdays_array_list());
    }


	public function ajax_check_date_range()
	{
		$property_id = (int)$this->input->post('properties_id_fk');
		$from_in = $this->input->post('room_tariff_hike_from_date');
		$to_in   = $this->input->post('room_tariff_hike_to_date');
		$exclude_id = (int)$this->input->post('exclude_id'); // for edit

		// convert dd/mm/yyyy to Y-m-d
		$from_in = str_replace('/', '-', $from_in);
		$to_in   = str_replace('/', '-', $to_in);

		$from_date = date('Y-m-d', strtotime($from_in));
		$to_date   = date('Y-m-d', strtotime($to_in));

		// basic sanity
		if (!$property_id || !$from_date || !$to_date) {
			echo json_encode(array("valid" => true)); // don't block if empty; normal required rules handle it
			return;
		}

		if (strtotime($from_date) > strtotime($to_date)) {
			echo json_encode(array("valid" => false, "message" => "Hike From date must be less than or equal to Hike To date"));
			return;
		}

		$conflict = $this->Room_tariff_management_model
			->is_date_range_conflict($property_id, $from_date, $to_date, $exclude_id);

		if ($conflict) {
			echo json_encode(array(
				"valid" => false,
				"message" => "This date range already exists / overlaps for the selected property."
			));
		} else {
			echo json_encode(array("valid" => true));
		}
	}

	public function ajax_last_tariff()
	{
		$property_id = (int)$this->input->post('properties_id_fk');
		$from_in     = $this->input->post('room_tariff_hike_from_date');

		if (!$property_id) {
			echo json_encode(array("status" => false, "message" => "Property required"));
			return;
		}

		// dd/mm/yyyy -> Y-m-d (if provided)
		$new_from = '';
		if ($from_in != '') {
			$from_in = str_replace('/', '-', $from_in);
			$new_from = date('Y-m-d', strtotime($from_in));
		}

		$data = $this->Room_tariff_management_model->get_last_tariff_for_property($property_id, $new_from);

		if (!$data) {
			echo json_encode(array("status" => true, "data" => null)); // no previous record
			return;
		}

		echo json_encode(array("status" => true, "data" => $data));
	}

	public function ajax_hike_view($id)
	{
		$id = (int)$id;

		$data = $this->Room_tariff_management_model->get_hike_tariff_view($id);

		if (!$data) {
			echo json_encode(array("status" => false, "message" => "Not found"));
			return;
		}

		echo json_encode(array("status" => true, "data" => $data));
	}
	
  public function ajax_add()
	{
		if (!has_permission('ROOM_TARIFF_CREATE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

		$this->_validate();
		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());

		$properties_id_fk = $this->input->post('properties_id_fk');
		
		$template['properties'] = $this->General_model->get_row($this->properties,'properties_id',$properties_id_fk);
				$properties_name = $template['properties']->properties_name;
		// echo$properties_name;die;
		$room_tariff_hike_from_date = str_replace('/','-', $this->input->post('room_tariff_hike_from_date'));
		$room_tariff_hike_from_date = date("Y-m-d h:i:s a",strtotime($room_tariff_hike_from_date));

		$room_tariff_hike_to_date = str_replace('/','-', $this->input->post('room_tariff_hike_to_date'));
		$room_tariff_hike_to_date = date("Y-m-d h:i:s a",strtotime($room_tariff_hike_to_date));

		$property_id = (int)$this->input->post('properties_id_fk');

		$from_in = str_replace('/', '-', $this->input->post('room_tariff_hike_from_date'));
		$to_in   = str_replace('/', '-', $this->input->post('room_tariff_hike_to_date'));

		$from_date = date('Y-m-d', strtotime($from_in));
		$to_date   = date('Y-m-d', strtotime($to_in));

		if ($this->Room_tariff_management_model->is_date_range_conflict($property_id, $from_date, $to_date, 0)) {
			echo json_encode(array(
				"status" => false,
				"inputerror" => array("room_tariff_hike_from_date", "room_tariff_hike_to_date"),
				"error_string" => array("Date range overlaps existing record", "Date range overlaps existing record")
			));
			return;
		}

		$room_ids = $this->input->post('room_id_fk');

		if (!is_array($room_ids) || count($room_ids) == 0) {
			echo json_encode(array(
				"status" => false,
				"inputerror" => array("properties_id_fk"),
				"error_string" => array("No rooms available for this property. Cannot save tariff.")
			));
			return;
		}


		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'properties_id_fk' => $this->input->post('properties_id_fk'),
				'room_tariff_hike_from_date' => $room_tariff_hike_from_date,
				'room_tariff_hike_to_date' => $room_tariff_hike_to_date,
				'room_tariff_hike_breakfast_rate_adult' => $this->input->post('room_tariff_hike_breakfast_rate_adult'),
				'room_tariff_hike_breakfast_rate_child' => $this->input->post('room_tariff_hike_breakfast_rate_child'),
				'room_tariff_hike_lunch_rate_adult' => $this->input->post('room_tariff_hike_lunch_rate_adult'),
				'room_tariff_hike_lunch_rate_child' => $this->input->post('room_tariff_hike_lunch_rate_child'),
				'room_tariff_hike_dinner_rate_adult' => $this->input->post('room_tariff_hike_dinner_rate_adult'),
				'room_tariff_hike_dinner_rate_child' => $this->input->post('room_tariff_hike_dinner_rate_child'),
				'room_tariff_hike_description' => $this->input->post('room_tariff_hike_description'),
				'room_tariff_hike_createdby_user_id' => $currentuserid,					
				'room_tariff_hike_created_at' => $date1,						
				'room_tariff_hike_status' => 1
			);
		$insert = $this->Room_tariff_management_model->save($data);

		$room_tariff_hike_rate_id = $this->input->post('room_tariff_hike_rate_id');
		$room_id_fk = $this->input->post('room_id_fk');
		$room_tariff_hike_rate_room_rate = $this->input->post('room_tariff_hike_rate_room_rate');
		$room_tariff_hike_rate_adult_with_extra_bed = $this->input->post('room_tariff_hike_rate_adult_with_extra_bed');
		$room_tariff_hike_rate_child_with_extra_bed = $this->input->post('room_tariff_hike_rate_child_with_extra_bed');
		$room_tariff_hike_rate_child_sharing_bed = $this->input->post('room_tariff_hike_rate_child_sharing_bed');
		$room_tariff_hike_rate_single_occupancy = $this->input->post('room_tariff_hike_rate_single_occupancy');
		$room_tariff_hike_rate_some_days_type = $this->input->post('room_tariff_hike_rate_some_days_type');

		$week_day_rates = $this->input->post('room_tariff_week_days_rate');
// echo "<pre>";
// print_r($this->input->post('room_tariff_week_days_rate'));
// echo "</pre>";
// exit;
		


		foreach ($room_tariff_hike_rate_id as $key => $value) {
		    
		    $room_tariff_id = $value;

					$room_rate_list = array(
					'room_tariff_hike_id_fk' => $insert,
					'room_id_fk' => $room_id_fk[$key],
					'room_tariff_hike_rate_room_rate' => $room_tariff_hike_rate_room_rate[$key],
					'room_tariff_hike_rate_adult_with_extra_bed' => $room_tariff_hike_rate_adult_with_extra_bed[$key],
					'room_tariff_hike_rate_child_with_extra_bed' => $room_tariff_hike_rate_child_with_extra_bed[$key],
					'room_tariff_hike_rate_child_sharing_bed' => $room_tariff_hike_rate_child_sharing_bed[$key],
					'room_tariff_hike_rate_single_occupancy' => $room_tariff_hike_rate_single_occupancy[$key],
					'room_tariff_hike_rate_some_days_type' => $room_tariff_hike_rate_some_days_type[$key],
					'room_tariff_hike_rate_status' => '1',
					);

				$tariff_id = $this->General_model->add_returnID($this->room_tariff_hike_rate,$room_rate_list);
$week_day_id = $this->input->post('week_day_id');
// print_r($this->input->post('week_day_id'));die;
		    if(isset($week_day_id[$key]) && count($week_day_id[$key])>0) {


//echo count($week_day_id[$key]);die;
						  foreach ($week_day_id[$key] as $key2 => $value2) {

						  			$wd_value = $value2;
						  			$room_amount = $this->input->post('room_amount');
						  			$adult_with_extra_bed = $this->input->post('adult_with_extra_bed');
						  			$child_with_extra_bed = $this->input->post('child_with_extra_bed');
						  			$child_sharing_bed = $this->input->post('child_sharing_bed');
						  			$single_occupancy = $this->input->post('single_occupancy');

		                $room_rate_week_days_list = array(
		                    'week_days_room_tariff_hike_id_fk' => $tariff_id,
		                    'week_days_id_fk' => $wd_value,
		                    'room_tariff_week_days_rate_room_amount' => $room_amount[$key][$key2],
		                    'room_tariff_week_days_rate_adult_with_extra_bed' => $adult_with_extra_bed[$key][$key2],
		                    'room_tariff_week_days_rate_child_with_extra_bed' => $child_with_extra_bed[$key][$key2],
		                    'room_tariff_week_days_rate_child_sharing_bed' => $child_sharing_bed[$key][$key2],
		                    'room_tariff_week_days_rate_single_occupancy' => $single_occupancy[$key][$key2],
		                    'room_tariff_week_days_rate_status' => '1',
		                );
		                // print_r($room_rate_week_days_list);die;
		                $this->General_model->add($this->room_tariff_week_days_rate, $room_rate_week_days_list);
		            }

		        }
		}


		
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit_delete($id)
	{
		$data = $this->Room_tariff_management_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_edit_delete_hike($id)
	{
		$data = $this->Room_tariff_management_model->get_by_id_hike($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_edit($id)
	{
		$id = (int)$id;

		$data = $this->Room_tariff_management_model->get_tariff_full($id);

		if (!$data) {
			echo json_encode(["status" => false, "message" => "Not found"]);
			return;
		}

		echo json_encode([
			"status"   => true,
			"hike"     => $data["hike"],        // header table row
			"rooms"    => $data["rooms"],       // rooms of that property
			"weekdays" => $data["weekdays"],    // all weekdays
			"rates"    => $data["rates"],       // room rates rows
			"weekRates"=> $data["weekRates"],   // weekday rate rows
		]);
	}

	public function ajax_update()
{
	if (!has_permission('ROOM_TARIFF_UPDATE')) {
        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
        return;
    }

    $this->_validate();

    $this->db->trans_begin();

    $hike_id = (int)$this->input->post('id');

    // ---- Date convert ----
    $from = str_replace('/', '-', $this->input->post('room_tariff_hike_from_date'));
    $to   = str_replace('/', '-', $this->input->post('room_tariff_hike_to_date'));

    $room_tariff_hike_from_date = date('Y-m-d', strtotime($from));
    $room_tariff_hike_to_date   = date('Y-m-d', strtotime($to));

	$property_id = (int)$this->input->post('properties_id_fk');

	$from_in = str_replace('/', '-', $this->input->post('room_tariff_hike_from_date'));
	$to_in   = str_replace('/', '-', $this->input->post('room_tariff_hike_to_date'));

	$from_date = date('Y-m-d', strtotime($from_in));
	$to_date   = date('Y-m-d', strtotime($to_in));

	if ($this->Room_tariff_management_model->is_date_range_conflict($property_id, $from_date, $to_date, $hike_id)) {
		echo json_encode(array(
			"status" => false,
			"inputerror" => array("room_tariff_hike_from_date", "room_tariff_hike_to_date"),
			"error_string" => array("Date range overlaps existing record", "Date range overlaps existing record")
		));
		return;
	}

	$room_ids = $this->input->post('room_id_fk');

	if (!is_array($room_ids) || count($room_ids) == 0) {
		echo json_encode(array(
			"status" => false,
			"inputerror" => array("properties_id_fk"),
			"error_string" => array("No rooms available for this property. Cannot save tariff.")
		));
		return;
	}

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

    // ---- Update header ----
    $header = array(
        'properties_id_fk' => (int)$this->input->post('properties_id_fk'),
        'room_tariff_hike_from_date' => $room_tariff_hike_from_date,
        'room_tariff_hike_to_date'   => $room_tariff_hike_to_date,

        'room_tariff_hike_breakfast_rate_adult' => (double)$this->input->post('room_tariff_hike_breakfast_rate_adult'),
        'room_tariff_hike_breakfast_rate_child' => (double)$this->input->post('room_tariff_hike_breakfast_rate_child'),
        'room_tariff_hike_lunch_rate_adult'     => (double)$this->input->post('room_tariff_hike_lunch_rate_adult'),
        'room_tariff_hike_lunch_rate_child'     => (double)$this->input->post('room_tariff_hike_lunch_rate_child'),
        'room_tariff_hike_dinner_rate_adult'    => (double)$this->input->post('room_tariff_hike_dinner_rate_adult'),
        'room_tariff_hike_dinner_rate_child'    => (double)$this->input->post('room_tariff_hike_dinner_rate_child'),
        'room_tariff_hike_description'          => $this->input->post('room_tariff_hike_description'),
		'room_tariff_hike_updatedby_user_id' => $currentuserid,					
		'room_tariff_hike_updated_at' => $date1,
    );

    $this->db->where('room_tariff_hike_id', $hike_id)->update('room_tariff_hike', $header);

    // ---- Arrays ----
    $room_rate_ids = $this->input->post('room_tariff_hike_rate_id');
    $room_ids      = $this->input->post('room_id_fk');

    $room_rate_room_rate         = $this->input->post('room_tariff_hike_rate_room_rate');
    $room_rate_adult_extra_bed   = $this->input->post('room_tariff_hike_rate_adult_with_extra_bed');
    $room_rate_child_extra_bed   = $this->input->post('room_tariff_hike_rate_child_with_extra_bed');
    $room_rate_child_sharing_bed = $this->input->post('room_tariff_hike_rate_child_sharing_bed');
    $room_rate_single            = $this->input->post('room_tariff_hike_rate_single_occupancy');
    $some_days_type              = $this->input->post('room_tariff_hike_rate_some_days_type');

    $checked_days    = $this->input->post('week_day_id');
    $room_amount     = $this->input->post('room_amount');
    $adult_extra_bed = $this->input->post('adult_with_extra_bed');
    $child_extra_bed = $this->input->post('child_with_extra_bed');
    $child_sharing   = $this->input->post('child_sharing_bed');
    $single_occ      = $this->input->post('single_occupancy');

    if (!is_array($room_ids)) $room_ids = array();

    foreach ($room_ids as $num => $room_id_fk) {

        $room_id_fk = (int)$room_id_fk;

        $rate_id = isset($room_rate_ids[$num]) ? (int)$room_rate_ids[$num] : 0;

        $rateData = array(
            'room_tariff_hike_id_fk' => $hike_id,
            'room_id_fk' => $room_id_fk,
            'room_tariff_hike_rate_room_rate' =>
                isset($room_rate_room_rate[$num]) ? (double)$room_rate_room_rate[$num] : 0,

            'room_tariff_hike_rate_adult_with_extra_bed' =>
                isset($room_rate_adult_extra_bed[$num]) ? (double)$room_rate_adult_extra_bed[$num] : 0,

            'room_tariff_hike_rate_child_with_extra_bed' =>
                isset($room_rate_child_extra_bed[$num]) ? (double)$room_rate_child_extra_bed[$num] : 0,

            'room_tariff_hike_rate_child_sharing_bed' =>
                isset($room_rate_child_sharing_bed[$num]) ? (double)$room_rate_child_sharing_bed[$num] : 0,

            'room_tariff_hike_rate_single_occupancy' =>
                isset($room_rate_single[$num]) ? (double)$room_rate_single[$num] : 0,

            'room_tariff_hike_rate_some_days_type' =>
                isset($some_days_type[$num]) ? $some_days_type[$num] : 'N',

            'room_tariff_hike_rate_status' => 1
        );

        if ($rate_id > 0) {
            $this->db->where('room_tariff_hike_rate_id', $rate_id)
                     ->update('room_tariff_hike_rate', $rateData);
        } else {
            $this->db->insert('room_tariff_hike_rate', $rateData);
            $rate_id = $this->db->insert_id();
        }

        $type = isset($some_days_type[$num]) ? $some_days_type[$num] : 'N';

        if ($type == 'N') {
            $this->db->where('week_days_room_tariff_hike_id_fk', $rate_id)
                     ->update('room_tariff_week_days_rate',
                         array('room_tariff_week_days_rate_status' => 0));
            continue;
        }

        // reset all to inactive first
        $this->db->where('week_days_room_tariff_hike_id_fk', $rate_id)
                 ->update('room_tariff_week_days_rate',
                     array('room_tariff_week_days_rate_status' => 0));

        if (isset($checked_days[$num])) {

            foreach ($checked_days[$num] as $idx => $day_id_fk) {

                $wkData = array(
                    'week_days_room_tariff_hike_id_fk' => $rate_id,
                    'week_days_room_id_fk' => $room_id_fk,
                    'week_days_id_fk' => (int)$day_id_fk,
                    'room_tariff_week_days_rate_room_amount' =>
                        isset($room_amount[$num][$idx]) ? $room_amount[$num][$idx] : 0,

                    'room_tariff_week_days_rate_adult_with_extra_bed' =>
                        isset($adult_extra_bed[$num][$idx]) ? $adult_extra_bed[$num][$idx] : 0,

                    'room_tariff_week_days_rate_child_with_extra_bed' =>
                        isset($child_extra_bed[$num][$idx]) ? $child_extra_bed[$num][$idx] : 0,

                    'room_tariff_week_days_rate_child_sharing_bed' =>
                        isset($child_sharing[$num][$idx]) ? $child_sharing[$num][$idx] : 0,

                    'room_tariff_week_days_rate_single_occupancy' =>
                        isset($single_occ[$num][$idx]) ? $single_occ[$num][$idx] : 0,

                    'room_tariff_week_days_rate_status' => 1
                );

                $exists = $this->db
                    ->where('week_days_room_tariff_hike_id_fk', $rate_id)
                    ->where('week_days_id_fk', $day_id_fk)
                    ->get('room_tariff_week_days_rate')
                    ->row();

                if ($exists) {
                    $this->db->where('room_tariff_week_days_rate_id',
                        $exists->room_tariff_week_days_rate_id)
                        ->update('room_tariff_week_days_rate', $wkData);
                } else {
                    $this->db->insert('room_tariff_week_days_rate', $wkData);
                }
            }
        }
    }

    $this->db->trans_commit();

    echo json_encode(array("status" => TRUE));
}


	

	public function delete()
	{
		if (!has_permission('ROOM_TARIFF_DELETE')) {
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

		$updateData = array('room_tariff_hike_status' => 0);
		
		$this->Room_tariff_management_model->update(array('room_tariff_hike_id' => $this->input->post('id')), $updateData);
		
		$updateroom_tariff_hike_rateData = array('room_tariff_hike_rate_status' => 0);
		$this->db->where('room_tariff_hike_id_fk', $this->input->post('id'))->update('room_tariff_hike_rate', $updateroom_tariff_hike_rateData);

		$template['tariff_hike_rate'] = $this->General_model->get_row($this->room_tariff_hike_rate,'room_tariff_hike_id_fk',$this->input->post('id'));
		$room_tariff_hike_rate_id = $template['tariff_hike_rate']->room_tariff_hike_rate_id;

		$updateroom_tariff_week_days_rateData = array('room_tariff_week_days_rate_status' => 0);
		$this->db->where('week_days_room_tariff_hike_id_fk', $room_tariff_hike_rate_id)->update('room_tariff_week_days_rate', $updateroom_tariff_week_days_rateData);

		// $properties_name = $this->input->post('properties_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted room tariff details of property: '.$properties_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Room_tariff_registration',
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


	public function delete_hike()
	{
		if (!has_permission('ROOM_TARIFF_DELETE_HIKE')) {
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

		$updateData = array('hike_room_tariff_hike_status' => 0);
		
		$this->Room_tariff_management_model->update_hike(array('hike_room_tariff_hike_id' => $this->input->post('id')), $updateData);
		
		$updateroom_tariff_hike_rateData = array('hike_room_tariff_hike_rate_status' => 0);
		$this->db->where('hike_room_tariff_hike_id_fk', $this->input->post('id'))->update('hike_room_tariff_hike_rate', $updateroom_tariff_hike_rateData);

		$template['tariff_hike_rate'] = $this->General_model->get_row($this->hike_room_tariff_hike_rate,'hike_room_tariff_hike_id_fk',$this->input->post('id'));
		$hike_room_tariff_hike_rate_id = $template['tariff_hike_rate']->hike_room_tariff_hike_rate_id;
		// print_r($hike_room_tariff_hike_rate_id);die;

		$updateroom_tariff_week_days_rateData = array('hike_room_tariff_week_days_rate_status' => 0);
		$this->db->where('hike_room_tariff_hike_rate_id_fk', $hike_room_tariff_hike_rate_id)->update('hike_room_tariff_week_days_rate', $updateroom_tariff_week_days_rateData);

		$properties_name = $this->input->post('properties_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted room tariff hike details of property: '.$properties_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Room_tariff_hike_registration',
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

		// if($this->input->post('properties_id_fk') == '')
		// {
		// 	$data['inputerror'][] = 'properties_id_fk';
		// 	$data['error_string'][] = 'Property is required';
		// 	$data['status'] = FALSE;
		// }

		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}


	////// Room hike tariff////

	public function ajax_hike_init($room_tariff_hike_id)
	{
		$room_tariff_hike_id = (int)$room_tariff_hike_id;

		$parent = $this->Room_tariff_management_model->get_room_tariff_hike($room_tariff_hike_id);
		if (!$parent) {
			echo json_encode(array("status" => false, "message" => "Parent tariff not found"));
			return;
		}

		$property_id = (int)$parent['properties_id_fk'];

		$rooms = $this->Room_tariff_management_model->rooms_array_list($property_id);
		$weekdays = $this->Room_tariff_management_model->weekdays_array_list();

		echo json_encode(array(
			"status" => true,
			"parent" => $parent,
			"rooms" => $rooms,
			"weekdays" => $weekdays
		));
	}

	public function ajax_check_hike_dates()
	{
		$parent_id  = (int)$this->input->post('room_tariff_hike_id_fk');
		$exclude_id = (int)$this->input->post('exclude_id');

		$from_in = $this->input->post('hike_room_tariff_hike_from_date');
		$to_in   = $this->input->post('hike_room_tariff_hike_to_date');

		if (!$parent_id || !$from_in || !$to_in) {
			echo json_encode(array("valid" => true));
			return;
		}

		// dd/mm/yyyy -> Y-m-d
		$from_in = str_replace('/', '-', $from_in);
		$to_in   = str_replace('/', '-', $to_in);
		$from_date = date('Y-m-d', strtotime($from_in));
		$to_date   = date('Y-m-d', strtotime($to_in));

		if (strtotime($from_date) > strtotime($to_date)) {
			echo json_encode(array("valid" => false, "message" => "Hike From date must be less than or equal to Hike To date"));
			return;
		}

		// parent tariff
		$parent = $this->Room_tariff_management_model->get_parent_room_tariff_dates($parent_id);
		if (!$parent) {
			echo json_encode(array("valid" => false, "message" => "Parent room tariff not found"));
			return;
		}

		$property_id = (int)$parent['properties_id_fk']; // ✅ property from parent (safe)

		$p_from = $parent['room_tariff_hike_from_date'];
		$p_to   = $parent['room_tariff_hike_to_date'];

		if ($from_date < $p_from || $to_date > $p_to) {
			echo json_encode(array(
				"valid" => false,
				"message" => "Hike dates must be within Parent Room Tariff dates (" . date('d/m/Y', strtotime($p_from)) . " - " . date('d/m/Y', strtotime($p_to)) . ")"
			));
			return;
		}

		// overlap check with property id
		$conflict = $this->Room_tariff_management_model
			->is_hike_date_range_conflict($parent_id, $property_id, $from_date, $to_date, $exclude_id);

		if ($conflict) {
			echo json_encode(array("valid" => false, "message" => "This hike date range overlaps an existing hike tariff."));
			return;
		}

		echo json_encode(array("valid" => true));
	}

	public function ajax_hike_add()
	{
		if (!has_permission('ROOM_TARIFF_ADD_HIKE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

		$this->_validate(); // reuse, or create _validate_hike()

		$room_tariff_hike_id_fk = (int)$this->input->post('room_tariff_hike_id_fk');
		$hike_properties_id_fk  = (int)$this->input->post('hike_properties_id_fk');

		// dd/mm/yyyy -> y-m-d
		// $from_in = str_replace('/', '-', $this->input->post('hike_room_tariff_hike_from_date'));
		// $to_in   = str_replace('/', '-', $this->input->post('hike_room_tariff_hike_to_date'));
		// $from_date = date('Y-m-d', strtotime($from_in));
		// $to_date   = date('Y-m-d', strtotime($to_in));

		// // overlap check
		// if ($this->Room_tariff_management_model->is_hike_date_range_conflict($room_tariff_hike_id_fk, $hike_properties_id_fk, $from_date, $to_date, 0)) {
		// 	echo json_encode(array(
		// 		"status" => false,
		// 		"inputerror" => array("hike_room_tariff_hike_from_date", "hike_room_tariff_hike_to_date"),
		// 		"error_string" => array("Date range overlaps existing hike tariff", "Date range overlaps existing hike tariff")
		// 	));
		// 	return;
		// }

		$parent_id = (int)$this->input->post('room_tariff_hike_id_fk');

		$from_in = str_replace('/', '-', $this->input->post('hike_room_tariff_hike_from_date'));
		$to_in   = str_replace('/', '-', $this->input->post('hike_room_tariff_hike_to_date'));

		$from_date = date('Y-m-d', strtotime($from_in));
		$to_date   = date('Y-m-d', strtotime($to_in));

		$parent = $this->Room_tariff_management_model->get_parent_room_tariff_dates($parent_id);
		if (!$parent) {
			echo json_encode(array("status" => false, "message" => "Parent room tariff not found"));
			return;
		}

		$property_id = (int)$parent['properties_id_fk'];

		if ($from_date < $parent['room_tariff_hike_from_date'] || $to_date > $parent['room_tariff_hike_to_date']) {
			echo json_encode(array(
				"status" => false,
				"inputerror" => array("hike_room_tariff_hike_from_date", "hike_room_tariff_hike_to_date"),
				"error_string" => array("Dates must be within parent range", "Dates must be within parent range")
			));
			return;
		}

		if ($this->Room_tariff_management_model->is_hike_date_range_conflict($parent_id, $property_id, $from_date, $to_date, 0)) {
			echo json_encode(array(
				"status" => false,
				"inputerror" => array("hike_room_tariff_hike_from_date", "hike_room_tariff_hike_to_date"),
				"error_string" => array("Overlaps existing hike tariff", "Overlaps existing hike tariff")
			));
			return;
		}

		// also set hike_properties_id_fk from parent (don’t trust post)
		$_POST['hike_properties_id_fk'] = $property_id;

		// rooms exist validation
		$room_ids = $this->input->post('room_id_fk');
		if (!is_array($room_ids) || count($room_ids) == 0) {
			echo json_encode(array(
				"status" => false,
				"inputerror" => array("hike_properties_id_fk"),
				"error_string" => array("No rooms available for this property. Cannot save hike tariff.")
			));
			return;
		}

		// $date = date('Y-m-d');
		// $time = date('H:i:s');

		$this->load->helper('date');
	if(function_exists('date_default_timezone_set')) {
		date_default_timezone_set("Asia/Kolkata");
	}
		$date = date('Y-m-d');
	$time = date('h:i:sa');
	
	$date1 = date('Y-m-d h:i:s a', time());

		$currentuserid   = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');

		$header = array(
			'room_tariff_hike_id_fk' => $room_tariff_hike_id_fk,
			'hike_properties_id_fk' => $hike_properties_id_fk,
			'hike_room_tariff_hike_from_date' => $from_date,
			'hike_room_tariff_hike_to_date'   => $to_date,
			'hike_room_tariff_hike_breakfast_rate_adult' => $this->input->post('hike_room_tariff_hike_breakfast_rate_adult'),
			'hike_room_tariff_hike_breakfast_rate_child' => $this->input->post('hike_room_tariff_hike_breakfast_rate_child'),
			'hike_room_tariff_hike_lunch_rate_adult'     => $this->input->post('hike_room_tariff_hike_lunch_rate_adult'),
			'hike_room_tariff_hike_lunch_rate_child'     => $this->input->post('hike_room_tariff_hike_lunch_rate_child'),
			'hike_room_tariff_hike_dinner_rate_adult'    => $this->input->post('hike_room_tariff_hike_dinner_rate_adult'),
			'hike_room_tariff_hike_dinner_rate_child'    => $this->input->post('hike_room_tariff_hike_dinner_rate_child'),
			'hike_room_tariff_hike_description'          => $this->input->post('hike_room_tariff_hike_description'),
			'hike_room_tariff_hike_createdby_user_id'    => $currentuserid,
			'hike_room_tariff_hike_created_at'         => $date1,
			'hike_room_tariff_hike_status'               => 1
		);

		$this->db->insert('hike_room_tariff_hike', $header);
		$hike_id = $this->db->insert_id();

		// rates arrays
		$room_rate_room_rate         = $this->input->post('hike_room_tariff_hike_rate_room_rate');
		$room_rate_adult_extra_bed   = $this->input->post('hike_room_tariff_hike_rate_adult_with_extra_bed');
		$room_rate_child_extra_bed   = $this->input->post('hike_room_tariff_hike_rate_child_with_extra_bed');
		$room_rate_child_sharing_bed = $this->input->post('hike_room_tariff_hike_rate_child_sharing_bed');
		$room_rate_single            = $this->input->post('hike_room_tariff_hike_rate_single_occupancy');
		$some_days_type              = $this->input->post('hike_room_tariff_hike_rate_some_days_type');

		// weekdays arrays
		$checked_days    = $this->input->post('week_day_id');
		$room_amount     = $this->input->post('room_amount');
		$adult_extra_bed = $this->input->post('adult_with_extra_bed');
		$child_extra_bed = $this->input->post('child_with_extra_bed');
		$child_sharing   = $this->input->post('child_sharing_bed');
		$single_occ      = $this->input->post('single_occupancy');

		foreach ($room_ids as $num => $room_id_fk) {

			$room_id_fk = (int)$room_id_fk;
			$type = isset($some_days_type[$num]) ? $some_days_type[$num] : 'N';

			// IMPORTANT: assuming you added hike_room_id_fk in hike_rate table
			$rateRow = array(
				'hike_room_tariff_hike_id_fk' => $hike_id,
				'hike_room_id_fk' => $room_id_fk,
				'hike_room_tariff_hike_rate_room_rate' =>
					isset($room_rate_room_rate[$num]) ? $room_rate_room_rate[$num] : 0,
				'hike_room_tariff_hike_rate_adult_with_extra_bed' =>
					isset($room_rate_adult_extra_bed[$num]) ? $room_rate_adult_extra_bed[$num] : 0,
				'hike_room_tariff_hike_rate_child_with_extra_bed' =>
					isset($room_rate_child_extra_bed[$num]) ? $room_rate_child_extra_bed[$num] : 0,
				'hike_room_tariff_hike_rate_child_sharing_bed' =>
					isset($room_rate_child_sharing_bed[$num]) ? $room_rate_child_sharing_bed[$num] : 0,
				'hike_room_tariff_hike_rate_single_occupancy' =>
					isset($room_rate_single[$num]) ? $room_rate_single[$num] : 0,
				'hike_room_tariff_hike_rate_some_days_type' => $type,
				'hike_room_tariff_hike_rate_status' => 1
			);

			$this->db->insert('hike_room_tariff_hike_rate', $rateRow);
			$rate_id = $this->db->insert_id();

			if ($type == 'Y' && isset($checked_days[$num]) && is_array($checked_days[$num])) {
				foreach ($checked_days[$num] as $idx => $day_id_fk) {

					$wkRow = array(
						'hike_room_tariff_hike_rate_id_fk' => $rate_id,
						'hike_week_days_room_id_fk' => $room_id_fk,
						'hike_week_days_id_fk' => (int)$day_id_fk,
						'hike_room_tariff_week_days_rate_room_amount' =>
							isset($room_amount[$num][$idx]) ? $room_amount[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_adult_with_extra_bed' =>
							isset($adult_extra_bed[$num][$idx]) ? $adult_extra_bed[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_child_with_extra_bed' =>
							isset($child_extra_bed[$num][$idx]) ? $child_extra_bed[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_child_sharing_bed' =>
							isset($child_sharing[$num][$idx]) ? $child_sharing[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_single_occupancy' =>
							isset($single_occ[$num][$idx]) ? $single_occ[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_status' => 1
					);

					$this->db->insert('hike_room_tariff_week_days_rate', $wkRow);
				}
			}
		}

		// echo json_encode(array("status" => true));
		echo json_encode(array(
			"status" => true,
			"hike_room_tariff_hike_id" => $hike_id,
			"room_tariff_hike_id_fk" => $room_tariff_hike_id_fk,
			"hike_properties_id_fk" => $hike_properties_id_fk
		));
	}

	public function ajax_hike_edit($hike_id)
	{
		$hike_id = (int)$hike_id;

		$full = $this->Room_tariff_management_model->get_hike_tariff_full($hike_id);
		if (!$full) {
			echo json_encode(array("status" => false, "message" => "Not found"));
			return;
		}

		// rooms + weekdays for property
		$rooms = $this->Room_tariff_management_model->rooms_array_list($full['hike']['hike_properties_id_fk']);
		$weekdays = $this->Room_tariff_management_model->weekdays_array_list();

		echo json_encode(array(
			"status" => true,
			"hike" => $full['hike'],
			"rooms" => $rooms,
			"weekdays" => $weekdays,
			"rates" => $full['rates'],
			"weekRates" => $full['weekRates']
		));
	}

	public function ajax_hike_update()
	{
		if (!has_permission('ROOM_TARIFF_UPDATE_HIKE')) {
	        echo json_encode(['status' => FALSE, 'message' => 'Permission denied']);
	        return;
	    }

		$this->_validate();

		$hike_id = (int)$this->input->post('hike_room_tariff_hike_id');
		$room_tariff_hike_id_fk = (int)$this->input->post('room_tariff_hike_id_fk');
		$property_id = (int)$this->input->post('hike_properties_id_fk');

		// $from_in = str_replace('/', '-', $this->input->post('hike_room_tariff_hike_from_date'));
		// $to_in   = str_replace('/', '-', $this->input->post('hike_room_tariff_hike_to_date'));
		// $from_date = date('Y-m-d', strtotime($from_in));
		// $to_date   = date('Y-m-d', strtotime($to_in));

		// if ($this->Room_tariff_management_model->is_hike_date_range_conflict($room_tariff_hike_id_fk, $property_id, $from_date, $to_date, $hike_id)) {
		// 	echo json_encode(array(
		// 		"status" => false,
		// 		"inputerror" => array("hike_room_tariff_hike_from_date", "hike_room_tariff_hike_to_date"),
		// 		"error_string" => array("Date range overlaps existing hike tariff", "Date range overlaps existing hike tariff")
		// 	));
		// 	return;
		// }

		$parent_id = (int)$this->input->post('room_tariff_hike_id_fk');

		$from_in = str_replace('/', '-', $this->input->post('hike_room_tariff_hike_from_date'));
		$to_in   = str_replace('/', '-', $this->input->post('hike_room_tariff_hike_to_date'));

		$from_date = date('Y-m-d', strtotime($from_in));
		$to_date   = date('Y-m-d', strtotime($to_in));

		$parent = $this->Room_tariff_management_model->get_parent_room_tariff_dates($parent_id);
		if (!$parent) {
			echo json_encode(array("status" => false, "message" => "Parent room tariff not found"));
			return;
		}

		$property_id = (int)$parent['properties_id_fk'];

		if ($from_date < $parent['room_tariff_hike_from_date'] || $to_date > $parent['room_tariff_hike_to_date']) {
			echo json_encode(array(
				"status" => false,
				"inputerror" => array("hike_room_tariff_hike_from_date", "hike_room_tariff_hike_to_date"),
				"error_string" => array("Dates must be within parent range", "Dates must be within parent range")
			));
			return;
		}

		// if ($this->Room_tariff_management_model->is_hike_date_range_conflict($parent_id, $property_id, $from_date, $to_date, 0)) {
		// 	echo json_encode(array(
		// 		"status" => false,
		// 		"inputerror" => array("hike_room_tariff_hike_from_date", "hike_room_tariff_hike_to_date"),
		// 		"error_string" => array("Overlaps existing hike tariff", "Overlaps existing hike tariff")
		// 	));
		// 	return;
		// }

		$exclude_id = (int)$this->input->post('hike_room_tariff_hike_id');
		if ($this->Room_tariff_management_model->is_hike_date_range_conflict($parent_id, $property_id, $from_date, $to_date, $exclude_id)) {
			 echo json_encode(array(
				"status" => false,
				"inputerror" => array("hike_room_tariff_hike_from_date", "hike_room_tariff_hike_to_date"),
				"error_string" => array("Overlaps existing hike tariff", "Overlaps existing hike tariff")
			));
			return; 
			
		}

		// also set hike_properties_id_fk from parent (don’t trust post)
		$_POST['hike_properties_id_fk'] = $property_id;

		$this->load->helper('date');
	if(function_exists('date_default_timezone_set')) {
		date_default_timezone_set("Asia/Kolkata");
	}
	$date = date('Y-m-d');
	$time = date('h:i:sa');
	
	$date1 = date('Y-m-d h:i:s a', time());
	
		// update header
		$header = array(
			'hike_room_tariff_hike_from_date' => $from_date,
			'hike_room_tariff_hike_to_date'   => $to_date,
			'hike_room_tariff_hike_breakfast_rate_adult' => $this->input->post('hike_room_tariff_hike_breakfast_rate_adult'),
			'hike_room_tariff_hike_breakfast_rate_child' => $this->input->post('hike_room_tariff_hike_breakfast_rate_child'),
			'hike_room_tariff_hike_lunch_rate_adult'     => $this->input->post('hike_room_tariff_hike_lunch_rate_adult'),
			'hike_room_tariff_hike_lunch_rate_child'     => $this->input->post('hike_room_tariff_hike_lunch_rate_child'),
			'hike_room_tariff_hike_dinner_rate_adult'    => $this->input->post('hike_room_tariff_hike_dinner_rate_adult'),
			'hike_room_tariff_hike_dinner_rate_child'    => $this->input->post('hike_room_tariff_hike_dinner_rate_child'),
			'hike_room_tariff_hike_description'          => $this->input->post('hike_room_tariff_hike_description'),
			'hike_room_tariff_hike_updatedby_user_id'    => $currentuserid,
			'hike_room_tariff_hike_updated_at'         => $date1,
		);

		$this->db->where('hike_room_tariff_hike_id', $hike_id)->update('hike_room_tariff_hike', $header);

		// rooms exist validation
		$room_ids = $this->input->post('room_id_fk');
		if (!is_array($room_ids) || count($room_ids) == 0) {
			echo json_encode(array(
				"status" => false,
				"inputerror" => array("hike_properties_id_fk"),
				"error_string" => array("No rooms available for this property. Cannot update hike tariff.")
			));
			return;
		}

		$rate_ids = $this->input->post('hike_room_tariff_hike_rate_id');

		$room_rate_room_rate         = $this->input->post('hike_room_tariff_hike_rate_room_rate');
		$room_rate_adult_extra_bed   = $this->input->post('hike_room_tariff_hike_rate_adult_with_extra_bed');
		$room_rate_child_extra_bed   = $this->input->post('hike_room_tariff_hike_rate_child_with_extra_bed');
		$room_rate_child_sharing_bed = $this->input->post('hike_room_tariff_hike_rate_child_sharing_bed');
		$room_rate_single            = $this->input->post('hike_room_tariff_hike_rate_single_occupancy');
		$some_days_type              = $this->input->post('hike_room_tariff_hike_rate_some_days_type');

		$checked_days    = $this->input->post('week_day_id');
		$room_amount     = $this->input->post('room_amount');
		$adult_extra_bed = $this->input->post('adult_with_extra_bed');
		$child_extra_bed = $this->input->post('child_with_extra_bed');
		$child_sharing   = $this->input->post('child_sharing_bed');
		$single_occ      = $this->input->post('single_occupancy');

		foreach ($room_ids as $num => $room_id_fk) {

			$room_id_fk = (int)$room_id_fk;
			$type = isset($some_days_type[$num]) ? $some_days_type[$num] : 'N';

			$rate_id = isset($rate_ids[$num]) ? (int)$rate_ids[$num] : 0;

			$rateRow = array(
				'hike_room_tariff_hike_rate_room_rate' =>
					isset($room_rate_room_rate[$num]) ? $room_rate_room_rate[$num] : 0,
				'hike_room_tariff_hike_rate_adult_with_extra_bed' =>
					isset($room_rate_adult_extra_bed[$num]) ? $room_rate_adult_extra_bed[$num] : 0,
				'hike_room_tariff_hike_rate_child_with_extra_bed' =>
					isset($room_rate_child_extra_bed[$num]) ? $room_rate_child_extra_bed[$num] : 0,
				'hike_room_tariff_hike_rate_child_sharing_bed' =>
					isset($room_rate_child_sharing_bed[$num]) ? $room_rate_child_sharing_bed[$num] : 0,
				'hike_room_tariff_hike_rate_single_occupancy' =>
					isset($room_rate_single[$num]) ? $room_rate_single[$num] : 0,
				'hike_room_tariff_hike_rate_some_days_type' => $type,
				'hike_room_tariff_hike_rate_status' => 1
			);

			if ($rate_id > 0) {
				$this->db->where('hike_room_tariff_hike_rate_id', $rate_id)->update('hike_room_tariff_hike_rate', $rateRow);
			} else {
				$rateRow['hike_room_tariff_hike_id_fk'] = $hike_id;
				$rateRow['hike_room_id_fk'] = $room_id_fk; // requires column
				$this->db->insert('hike_room_tariff_hike_rate', $rateRow);
				$rate_id = $this->db->insert_id();
			}

			// If type N -> all weekdays status 0
			if ($type == 'N') {
				$this->db->where('hike_room_tariff_hike_rate_id_fk', $rate_id)
					->update('hike_room_tariff_week_days_rate', array('hike_room_tariff_week_days_rate_status' => 0));
				continue;
			}

			// reset all to status 0 then re-enable checked
			$this->db->where('hike_room_tariff_hike_rate_id_fk', $rate_id)
				->update('hike_room_tariff_week_days_rate', array('hike_room_tariff_week_days_rate_status' => 0));

			if (isset($checked_days[$num]) && is_array($checked_days[$num])) {
				foreach ($checked_days[$num] as $idx => $day_id_fk) {

					$day_id_fk = (int)$day_id_fk;

					$wkRow = array(
						'hike_room_tariff_hike_rate_id_fk' => $rate_id,
						'hike_week_days_room_id_fk' => $room_id_fk,
						'hike_week_days_id_fk' => $day_id_fk,
						'hike_room_tariff_week_days_rate_room_amount' =>
							isset($room_amount[$num][$idx]) ? $room_amount[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_adult_with_extra_bed' =>
							isset($adult_extra_bed[$num][$idx]) ? $adult_extra_bed[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_child_with_extra_bed' =>
							isset($child_extra_bed[$num][$idx]) ? $child_extra_bed[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_child_sharing_bed' =>
							isset($child_sharing[$num][$idx]) ? $child_sharing[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_single_occupancy' =>
							isset($single_occ[$num][$idx]) ? $single_occ[$num][$idx] : 0,
						'hike_room_tariff_week_days_rate_status' => 1
					);

					$exists = $this->db
						->where('hike_room_tariff_hike_rate_id_fk', $rate_id)
						->where('hike_week_days_id_fk', $day_id_fk)
						->get('hike_room_tariff_week_days_rate')
						->row();

					if ($exists) {
						$this->db->where('hike_room_tariff_week_days_rate_id', $exists->hike_room_tariff_week_days_rate_id)
							->update('hike_room_tariff_week_days_rate', $wkRow);
					} else {
						$this->db->insert('hike_room_tariff_week_days_rate', $wkRow);
					}
				}
			}
		}

		echo json_encode(array("status" => true));
	}
	
}
?>