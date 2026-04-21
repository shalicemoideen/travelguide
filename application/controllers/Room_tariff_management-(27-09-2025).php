<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Room_tariff_management extends MY_Controller {
	public $table = 'room_tariff_hike';
	public $room_tariff_hike_rate = 'room_tariff_hike_rate';
	public $room_tariff_week_days_rate = 'room_tariff_week_days_rate';
	public $properties = 'properties';
	public $activity = 'activity';
	public $page  = 'Room_tariff_management';
	public function __construct() {
		parent::__construct();
        
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

		$properties_id_fk = $this->input->post('properties_id_fk');
		$template['properties'] = $this->General_model->get_row($this->properties,'properties_id',$properties_id_fk);
				$properties_name = $template['properties']->properties_name;
		
		$room_tariff_hike_from_date = str_replace('/','-', $this->input->post('room_tariff_hike_from_date'));
    $room_tariff_hike_from_date = date("Y-m-d h:i:s a",strtotime($room_tariff_hike_from_date));

    $room_tariff_hike_to_date = str_replace('/','-', $this->input->post('room_tariff_hike_to_date'));
    $room_tariff_hike_to_date = date("Y-m-d h:i:s a",strtotime($room_tariff_hike_to_date));

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
				'room_tariff_hike_createdby_user_name' => $currentusername,			
				'room_tariff_hike_created_date' => $date,			
				'room_tariff_hike_created_time' => $time,			
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


		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added room tariff details of property: '.$properties_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Room_tariff_registration',
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
		$data = $this->Room_tariff_management_model->get_by_id($id);
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
		
		$properties_id_fk = $this->input->post('properties_id_fk');
		$template['properties'] = $this->General_model->get_row($this->properties,'properties_id',$properties_id_fk);
				$properties_name = $template['properties']->properties_name;
		
		$room_tariff_hike_from_date = str_replace('/','-', $this->input->post('room_tariff_hike_from_date'));
    $room_tariff_hike_from_date = date("Y-m-d h:i:s a",strtotime($room_tariff_hike_from_date));

    $room_tariff_hike_to_date = str_replace('/','-', $this->input->post('room_tariff_hike_to_date'));
    $room_tariff_hike_to_date = date("Y-m-d h:i:s a",strtotime($room_tariff_hike_to_date));

		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited room tariff details of property: '.$properties_name.'',
				'id_fk' => $id,
				'activity_type' => 'Room_tariff_registration',
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
				'room_tariff_hike_from_date' => $room_tariff_hike_from_date,
				'room_tariff_hike_to_date' => $room_tariff_hike_to_date,
				'room_tariff_hike_breakfast_rate_adult' => $this->input->post('room_tariff_hike_breakfast_rate_adult'),
				'room_tariff_hike_breakfast_rate_child' => $this->input->post('room_tariff_hike_breakfast_rate_child'),
				'room_tariff_hike_lunch_rate_adult' => $this->input->post('room_tariff_hike_lunch_rate_adult'),
				'room_tariff_hike_lunch_rate_child' => $this->input->post('room_tariff_hike_lunch_rate_child'),
				'room_tariff_hike_dinner_rate_adult' => $this->input->post('room_tariff_hike_dinner_rate_adult'),
				'room_tariff_hike_dinner_rate_child' => $this->input->post('room_tariff_hike_dinner_rate_child'),
				'room_tariff_hike_description' => $this->input->post('room_tariff_hike_description'),
				// 'room_tariff_hike_createdby_user_id' => $currentuserid,			
				// 'room_tariff_hike_createdby_user_name' => $currentusername,			
				// 'room_tariff_hike_created_date' => $date,			
				// 'room_tariff_hike_created_time' => $time,			
				// 'room_tariff_hike_status' => 1
			);
			// print_r($data);exit();
		$this->Room_tariff_management_model->update(array('room_tariff_hike_id' => $this->input->post('id')), $data);

		// $this->General_model->delete($this->transporter_vehicle,'transporter_id_fk',$id);

		$room_tariff_hike_rate_id = $this->input->post('room_tariff_hike_rate_id');
		$room_id_fk = $this->input->post('room_id_fk');
		$room_tariff_hike_rate_room_rate = $this->input->post('room_tariff_hike_rate_room_rate');
		$room_tariff_hike_rate_adult_with_extra_bed = $this->input->post('room_tariff_hike_rate_adult_with_extra_bed');
		$room_tariff_hike_rate_child_with_extra_bed = $this->input->post('room_tariff_hike_rate_child_with_extra_bed');
		$room_tariff_hike_rate_child_sharing_bed = $this->input->post('room_tariff_hike_rate_child_sharing_bed');
		$room_tariff_hike_rate_single_occupancy = $this->input->post('room_tariff_hike_rate_single_occupancy');
		$room_tariff_hike_rate_some_days_type = $this->input->post('room_tariff_hike_rate_some_days_type');

			foreach ($room_tariff_hike_rate_id as $key => $value) {		
					
					$room_tariff_id = $value;

					$room_rate_list = array(
					'room_tariff_hike_id_fk' => $id,
					'room_id_fk' => $room_id_fk[$key],
					'room_tariff_hike_rate_room_rate' => $room_tariff_hike_rate_room_rate[$key],
					'room_tariff_hike_rate_adult_with_extra_bed' => $room_tariff_hike_rate_adult_with_extra_bed[$key],
					'room_tariff_hike_rate_child_with_extra_bed' => $room_tariff_hike_rate_child_with_extra_bed[$key],
					'room_tariff_hike_rate_child_sharing_bed' => $room_tariff_hike_rate_child_sharing_bed[$key],
					'room_tariff_hike_rate_single_occupancy' => $room_tariff_hike_rate_single_occupancy[$key],
					'room_tariff_hike_rate_some_days_type' => $room_tariff_hike_rate_some_days_type[$key],
					'room_tariff_hike_rate_status' => '1',
					);

					$result = $this->General_model->update($this->room_tariff_hike_rate,$room_rate_list,'room_tariff_hike_rate_id',$room_tariff_id);
			}
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

		$updateData = array('room_tariff_hike_status' => 0);
		
		$this->Room_tariff_management_model->update(array('room_tariff_hike_id' => $this->input->post('id')), $updateData);

		$properties_name = $this->input->post('properties_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted room tariff details of property: '.$properties_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Room_tariff_registration',
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

		
		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}
	
}
?>