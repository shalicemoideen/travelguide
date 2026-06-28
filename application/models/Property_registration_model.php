<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Property_registration_model extends CI_Model{
	var $table = 'properties';
	var $table1 = 'properties_room_category';
	var $table2 = 'upload_tariff_document';
	var $table3 = 'property_inclusions';

	public function __construct()
    {
        parent::__construct();
    }
	
	public function getPropertiesTable($param){
		$arOrder = array('','roles_name');
		$properties_id =(isset($param['properties_id']))?$param['properties_id']:'';
		$property_category_id_fk =(isset($param['property_category_id_fk']))?$param['property_category_id_fk']:'';
		$country_id_fk =(isset($param['country_id_fk']))?$param['country_id_fk']:'';
		$location_id_fk =(isset($param['location_id_fk']))?$param['location_id_fk']:'';
		$properties_destination_id_fk =(isset($param['properties_destination_id_fk']))?$param['properties_destination_id_fk']:'';
		$properties_createdby_userid =(isset($param['properties_createdby_userid']))?$param['properties_createdby_userid']:'';


		if($properties_id){
            $this->db->where('properties_id', $properties_id);
        }
        if($property_category_id_fk){
            $this->db->where('property_category_id_fk', $property_category_id_fk);
        }
        if($country_id_fk){
            $this->db->where('properties.country_id_fk', $country_id_fk);
        }
        if($location_id_fk){
            $this->db->where('properties.location_id_fk', $location_id_fk);
        }
        if($properties_destination_id_fk){
            $this->db->where('properties_destination_id_fk', $properties_destination_id_fk);
        }
        if($properties_createdby_userid){
            $this->db->where('properties_createdby_userid', $properties_createdby_userid);
        }
        $this->db->where("properties_status",1);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');

		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,location.location_name as plname, state.state_name as rcname, latest_tariff.room_tariff_hike_to_date');
		$this->db->from('properties');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->join('country', 'properties.country_id_fk = country.id','left');
		$this->db->join('location', 'location.location_id = properties.location_id_fk','left');
        $this->db->join('state', 'state.state_id = properties.properties_destination_id_fk');
        // Join with subquery to get the latest room_tariff_hike record for each property
        $this->db->join('(SELECT rth1.properties_id_fk, rth1.room_tariff_hike_to_date
                         FROM room_tariff_hike rth1
                         WHERE rth1.room_tariff_hike_status = 1
                         AND rth1.room_tariff_hike_id = (
                             SELECT MAX(rth2.room_tariff_hike_id)
                             FROM room_tariff_hike rth2
                             WHERE rth2.properties_id_fk = rth1.properties_id_fk
                             AND rth2.room_tariff_hike_status = 1
                         )
                        ) latest_tariff', 'latest_tariff.properties_id_fk = properties.properties_id', 'left');
		$this->db->order_by('properties_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $results = $query->result();
        $current_date = date('Y-m-d');

        // Calculate tariff status for each property
        foreach ($results as $row) {
            $row->tariff_status = $this->calculate_tariff_status($row->room_tariff_hike_to_date, $current_date);
        }

        $data['data'] = $results;
        $data['recordsTotal'] = $this->getPropertiesTotalCount($param);
        $data['recordsFiltered'] = $this->getPropertiesTotalCount($param);
        return $data;

	}

	private function calculate_tariff_status($to_date, $current_date)
	{
		if (empty($to_date)) {
			return array('text' => 'Tariff not available', 'color' => 'danger');
		}

		$to_date_obj = new DateTime($to_date);
		$current_date_obj = new DateTime($current_date);
		$interval = $current_date_obj->diff($to_date_obj);
		$days_diff = $interval->days;

		// Check if expired today
		if ($to_date == $current_date) {
			return array('text' => 'Expired today', 'color' => 'primary');
		}

		// Check if expired (to_date is in the past)
		if ($to_date < $current_date) {
			// Expired MAR 27 2026 (2 days ago) - show the date and day count
			return array('text' => 'Expired ' . $to_date_obj->format('M d Y') . ' (' . $days_diff . ' days ago)', 'color' => 'primary');
		}

		// Check if within 60 days (future)
		if ($days_diff <= 60) {
			// Expired in 42 days - show day count
			return array('text' => 'Expired in ' . $days_diff . ' days', 'color' => 'warning');
		}

		// More than 60 days in the future
		// Till MAR 27 2026 - show the date
		return array('text' => 'Till ' . $to_date_obj->format('M d Y'), 'color' => 'success');
	}

	public function getPropertiesTotalCount($param = NULL){

		$properties_id =(isset($param['properties_id']))?$param['properties_id']:'';
		$property_category_id_fk =(isset($param['property_category_id_fk']))?$param['property_category_id_fk']:'';
		$country_id_fk =(isset($param['country_id_fk']))?$param['country_id_fk']:'';
		$location_id_fk =(isset($param['location_id_fk']))?$param['location_id_fk']:'';
		$properties_destination_id_fk =(isset($param['properties_destination_id_fk']))?$param['properties_destination_id_fk']:'';
		$properties_createdby_userid =(isset($param['properties_createdby_userid']))?$param['properties_createdby_userid']:'';
		
		
		if($properties_id){
            $this->db->where('properties_id', $properties_id); 
        }
        if($property_category_id_fk){
            $this->db->where('property_category_id_fk', $property_category_id_fk); 
        }
        if($country_id_fk){
            $this->db->where('properties.country_id_fk', $country_id_fk); 
        }
        if($location_id_fk){
            $this->db->where('properties.location_id_fk', $location_id_fk);
        }
        if($properties_destination_id_fk){
            $this->db->where('properties_destination_id_fk', $properties_destination_id_fk); 
        }
        if($properties_createdby_userid){
            $this->db->where('properties_createdby_userid', $properties_createdby_userid); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');

		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,location.location_name as plname, state.state_name as rcname');
		$this->db->from('properties');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->join('country', 'properties.country_id_fk = country.id','left');
		$this->db->join('location', 'location.location_id = properties.location_id_fk','left');
        $this->db->join('state', 'state.state_id = properties.properties_destination_id_fk');
        $this->db->where("properties_status",1);
		$this->db->order_by('properties_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
    public function getPropertyroomcategoryTable($param,$properties_id_fk){
		$arOrder = array('','roles_name');
		$properties_id =(isset($param['properties_id']))?$param['properties_id']:'';
		$room_meal_plan_id =(isset($param['room_meal_plan_id']))?$param['room_meal_plan_id']:'';
		$properties_room_category_id =(isset($param['properties_room_category_id']))?$param['properties_room_category_id']:'';
		$properties_room_category_createdby_user_id =(isset($param['properties_room_category_createdby_user_id']))?$param['properties_room_category_createdby_user_id']:'';
		
		
		if($properties_id){
            $this->db->where('properties_id', $properties_id); 
        }
        if($room_meal_plan_id){
            $this->db->where('meal_plan_id', $room_meal_plan_id); 
        }
        if($properties_room_category_id){
            $this->db->where('properties_room_category_id', $properties_room_category_id); 
        }
        if($properties_room_category_createdby_user_id){
            $this->db->where('properties_room_category_createdby_user_id', $properties_room_category_createdby_user_id); 
        }
        $this->db->where("properties_room_category_status",1);
        $this->db->where("properties_id_fk",$properties_id_fk);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('properties_room_category');
		$this->db->join('properties', 'properties.properties_id = properties_room_category.properties_id_fk','left');
		$this->db->join('meal_plan', 'meal_plan.meal_plan_id = properties_room_category.room_meal_plan_id_fk','left');
		$this->db->order_by('room_category_show_order', 'ASC');
		$this->db->order_by('properties_room_category_id', 'ASC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPropertyroomcategoryTotalCount($param,$properties_id_fk);
        $data['recordsFiltered'] = $this->getPropertyroomcategoryTotalCount($param,$properties_id_fk);
        return $data;

	}

	public function getPropertyroomcategoryTotalCount($param = NULL,$properties_id_fk){

		$properties_id =(isset($param['properties_id']))?$param['properties_id']:'';
		$room_meal_plan_id =(isset($param['room_meal_plan_id']))?$param['room_meal_plan_id']:'';
		$properties_room_category_id =(isset($param['properties_room_category_id']))?$param['properties_room_category_id']:'';
		$properties_room_category_createdby_user_id =(isset($param['properties_room_category_createdby_user_id']))?$param['properties_room_category_createdby_user_id']:'';
		
		
		if($properties_id){
            $this->db->where('properties_id', $properties_id); 
        }
        if($room_meal_plan_id){
            $this->db->where('meal_plan_id', $room_meal_plan_id); 
        }
        if($properties_room_category_id){
            $this->db->where('properties_room_category_id', $properties_room_category_id); 
        }
        if($properties_room_category_createdby_user_id){
            $this->db->where('properties_room_category_createdby_user_id', $properties_room_category_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('properties_room_category');
		$this->db->join('properties', 'properties.properties_id = properties_room_category.properties_id_fk','left');
		$this->db->join('meal_plan', 'meal_plan.meal_plan_id = properties_room_category.room_meal_plan_id_fk','left');
		$this->db->where("properties_room_category_status",1);
		$this->db->where("properties_id_fk",$properties_id_fk);
		$this->db->order_by('properties_room_category_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }

    public function getUploadtariffTable($param,$properties_id_fk){
		$arOrder = array('','roles_name');
		$upload_tariff_document_created_by_user_id =(isset($param['upload_tariff_document_created_by_user_id']))?$param['upload_tariff_document_created_by_user_id']:'';
		
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';

		
        if($upload_tariff_document_created_by_user_id){
            $this->db->where('upload_tariff_document_created_by_user_id', $upload_tariff_document_created_by_user_id); 
        }
        if($start_date){
            $this->db->where('upload_tariff_document_from_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('upload_tariff_document_to_date<=', $end_date); 
        }
        $this->db->where("upload_tariff_document_status",1);
        $this->db->where("property_id_fk",$properties_id_fk);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(upload_tariff_document_from_date,\'%d-%m-%Y\') as upload_tariff_document_from_date,DATE_FORMAT(upload_tariff_document_to_date	,\'%d-%m-%Y\') as upload_tariff_document_to_date');
		$this->db->from('upload_tariff_document');
		$this->db->join('properties', 'properties.properties_id = upload_tariff_document.property_id_fk','left');
		$this->db->order_by('upload_tariff_document_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getUploadtariffTotalCount($param,$properties_id_fk);
        $data['recordsFiltered'] = $this->getUploadtariffTotalCount($param,$properties_id_fk);
        return $data;

	}

	public function getUploadtariffTotalCount($param = NULL,$properties_id_fk){

		$upload_tariff_document_created_by_user_id =(isset($param['upload_tariff_document_created_by_user_id']))?$param['upload_tariff_document_created_by_user_id']:'';
		
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';

		
        if($upload_tariff_document_created_by_user_id){
            $this->db->where('upload_tariff_document_created_by_user_id', $upload_tariff_document_created_by_user_id); 
        }
        if($start_date){
            $this->db->where('upload_tariff_document_from_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('upload_tariff_document_to_date<=', $end_date); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(upload_tariff_document_from_date,\'%d-%m-%Y\') as upload_tariff_document_from_date,DATE_FORMAT(upload_tariff_document_to_date	,\'%d-%m-%Y\') as upload_tariff_document_to_date');
		$this->db->from('upload_tariff_document');
		$this->db->join('properties', 'properties.properties_id = upload_tariff_document.property_id_fk','left');
		$this->db->where("upload_tariff_document_status",1);
        $this->db->where("property_id_fk",$properties_id_fk);
		$this->db->order_by('upload_tariff_document_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }

	public function getRoomtariffTable($param,$properties_id_fk){
		$arOrder = array('','roles_name');
		$properties_id =(isset($param['properties_id']))?$param['properties_id']:'';
		$property_category_id_fk =(isset($param['property_category_id_fk']))?$param['property_category_id_fk']:'';
		$properties_room_category_id =(isset($param['properties_room_category_id']))?$param['properties_room_category_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		$room_tariff_hike_createdby_user_id =(isset($param['room_tariff_hike_createdby_user_id']))?$param['room_tariff_hike_createdby_user_id']:'';
		
		
		if($properties_id){
            $this->db->where('properties_id', $properties_id); 
        }
        if($property_category_id_fk){
            $this->db->where('property_category_id_fk', $property_category_id_fk); 
        }
        if($properties_room_category_id){
            $this->db->where('properties_room_category_id', $properties_room_category_id); 
        }
        if($start_date){
            $this->db->where('room_tariff_hike_from_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('room_tariff_hike_to_date<=', $end_date); 
        }
        if($room_tariff_hike_createdby_user_id){
            $this->db->where('room_tariff_hike_createdby_user_id', $room_tariff_hike_createdby_user_id); 
        }
        $this->db->where("room_tariff_hike_status",1);
		$this->db->where("room_tariff_hike.properties_id_fk",$properties_id_fk);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(room_tariff_hike_from_date,\'%d-%m-%Y\') as room_tariff_hike_from_date,DATE_FORMAT(room_tariff_hike_to_date,\'%d-%m-%Y\') as room_tariff_hike_to_date');
		$this->db->from('room_tariff_hike');
		$this->db->join('room_tariff_hike_rate', 'room_tariff_hike_rate.room_tariff_hike_id_fk = room_tariff_hike.room_tariff_hike_id','left');
		$this->db->join('properties', 'room_tariff_hike.properties_id_fk = properties.properties_id','left');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->join('properties_room_category', 'properties_room_category.properties_room_category_id = room_tariff_hike_rate.room_id_fk','left');
		$this->db->order_by('room_tariff_hike_id', 'DESC');
		$this->db->group_by('room_tariff_hike_rate.room_tariff_hike_id_fk');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getRoomtariffTotalCount($param,$properties_id_fk);
        $data['recordsFiltered'] = $this->getRoomtariffTotalCount($param,$properties_id_fk);
        return $data;

	}

	public function getRoomtariffTotalCount($param = NULL,$properties_id_fk){

		$properties_id =(isset($param['properties_id']))?$param['properties_id']:'';
		$property_category_id_fk =(isset($param['property_category_id_fk']))?$param['property_category_id_fk']:'';
		$properties_room_category_id =(isset($param['properties_room_category_id']))?$param['properties_room_category_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		$room_tariff_hike_createdby_user_id =(isset($param['room_tariff_hike_createdby_user_id']))?$param['room_tariff_hike_createdby_user_id']:'';
		
		
		if($properties_id){
            $this->db->where('properties_id', $properties_id); 
        }
        if($property_category_id_fk){
            $this->db->where('property_category_id_fk', $property_category_id_fk); 
        }
        if($properties_room_category_id){
            $this->db->where('properties_room_category_id', $properties_room_category_id); 
        }
        if($start_date){
            $this->db->where('room_tariff_hike_from_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('room_tariff_hike_to_date<=', $end_date); 
        }
        if($room_tariff_hike_createdby_user_id){
            $this->db->where('room_tariff_hike_createdby_user_id', $room_tariff_hike_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(room_tariff_hike_from_date,\'%d-%m-%Y\') as room_tariff_hike_from_date,DATE_FORMAT(room_tariff_hike_to_date,\'%d-%m-%Y\') as room_tariff_hike_to_date');
		$this->db->from('room_tariff_hike');
		$this->db->join('room_tariff_hike_rate', 'room_tariff_hike_rate.room_tariff_hike_id_fk = room_tariff_hike.room_tariff_hike_id','left');
		$this->db->join('properties', 'room_tariff_hike.properties_id_fk = properties.properties_id','left');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->join('properties_room_category', 'properties_room_category.properties_room_category_id = room_tariff_hike_rate.room_id_fk','left');
		$this->db->where("room_tariff_hike_status",1);
		$this->db->where("room_tariff_hike.properties_id_fk",$properties_id_fk);
		$this->db->order_by('room_tariff_hike_id', 'DESC');
		$this->db->group_by('room_tariff_hike_rate.room_tariff_hike_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }

	public function getPropertyinclusionsTable($param,$properties_id_fk){
		$arOrder = array('','roles_name');
		$property_inclusions_id_filter =(isset($param['property_inclusions_id_filter']))?$param['property_inclusions_id_filter']:'';
		$property_inclusions_created_by_userid =(isset($param['property_inclusions_created_by_userid']))?$param['property_inclusions_created_by_userid']:'';


		if($property_inclusions_id_filter){
            $this->db->where('property_inclusions_id', $property_inclusions_id_filter); 
        }
        if($property_inclusions_created_by_userid){
            $this->db->where('property_inclusions_created_by_userid', $property_inclusions_created_by_userid); 
        }

        $this->db->where("property_inclusions_status",1);
        $this->db->where("property_id_fk",$properties_id_fk);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('property_inclusions');
		$this->db->join('properties', 'properties.properties_id = property_inclusions.property_id_fk','left');
		$this->db->order_by('property_inclusions_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPropertyinclusionsTotalCount($param,$properties_id_fk);
        $data['recordsFiltered'] = $this->getPropertyinclusionsTotalCount($param,$properties_id_fk);
        return $data;

	}

	public function getPropertyinclusionsTotalCount($param = NULL,$properties_id_fk){

		$property_inclusions_id_filter =(isset($param['property_inclusions_id_filter']))?$param['property_inclusions_id_filter']:'';
		$property_inclusions_created_by_userid =(isset($param['property_inclusions_created_by_userid']))?$param['property_inclusions_created_by_userid']:'';


		if($property_inclusions_id_filter){
            $this->db->where('property_inclusions_id', $property_inclusions_id_filter); 
        }
        if($property_inclusions_created_by_userid){
            $this->db->where('property_inclusions_created_by_userid', $property_inclusions_created_by_userid); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('property_inclusions');
		$this->db->join('properties', 'properties.properties_id = property_inclusions.property_id_fk','left');
		$this->db->where("property_inclusions_status",1);
        $this->db->where("property_id_fk",$properties_id_fk);
		$this->db->order_by('property_inclusions_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }

	public function getRoomHiketariffTable($param,$properties_id_fk){
		$arOrder = array('','roles_name');
		// Handle room tariff date range
		$room_tariff_from_date_filter =(isset($param['room_tariff_from_date_filter']))?$param['room_tariff_from_date_filter']:'';
        $room_tariff_to_date_filter =(isset($param['room_tariff_to_date_filter']))?$param['room_tariff_to_date_filter']:'';

		// Handle hike tariff date range
		$hike_room_tariff_hike_from_date_filter =(isset($param['hike_room_tariff_hike_from_date_filter']))?$param['hike_room_tariff_hike_from_date_filter']:'';
        $hike_room_tariff_hike_to_date_filter =(isset($param['hike_room_tariff_hike_to_date_filter']))?$param['hike_room_tariff_hike_to_date_filter']:'';

		// Handle created by filter
		$hike_room_tariff_hike_createdby_user_id =(isset($param['hike_room_tariff_hike_createdby_user_id']))?$param['hike_room_tariff_hike_createdby_user_id']:'';


		if($room_tariff_from_date_filter){
            $this->db->where('room_tariff_hike_from_date>=', $room_tariff_from_date_filter);
        }
        if($room_tariff_to_date_filter){
            $this->db->where('room_tariff_hike_to_date<=', $room_tariff_to_date_filter);
        }

        if($hike_room_tariff_hike_from_date_filter){
            $this->db->where('hike_room_tariff_hike_from_date>=', $hike_room_tariff_hike_from_date_filter);
        }
        if($hike_room_tariff_hike_to_date_filter){
            $this->db->where('hike_room_tariff_hike_to_date<=', $hike_room_tariff_hike_to_date_filter); 
        }
        if($hike_room_tariff_hike_createdby_user_id){
            $this->db->where('hike_room_tariff_hike_createdby_user_id', $hike_room_tariff_hike_createdby_user_id); 
        }
        $this->db->where("hike_room_tariff_hike_status",1);
		$this->db->where("hike_room_tariff_hike.hike_properties_id_fk",$properties_id_fk);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(hike_room_tariff_hike_from_date,\'%d-%m-%Y\') as hike_room_tariff_hike_from_date,DATE_FORMAT(hike_room_tariff_hike_to_date,\'%d-%m-%Y\') as hike_room_tariff_hike_to_date,DATE_FORMAT(room_tariff_hike_from_date,\'%d-%m-%Y\') as room_tariff_hike_from_date,DATE_FORMAT(room_tariff_hike_to_date,\'%d-%m-%Y\') as room_tariff_hike_to_date');
		$this->db->from('hike_room_tariff_hike');
		$this->db->join('hike_room_tariff_hike_rate', 'hike_room_tariff_hike_rate.hike_room_tariff_hike_id_fk = hike_room_tariff_hike.hike_room_tariff_hike_id','left');
		$this->db->join('room_tariff_hike', 'room_tariff_hike.room_tariff_hike_id = hike_room_tariff_hike.room_tariff_hike_id_fk','left');
		$this->db->join('properties', 'hike_room_tariff_hike.hike_properties_id_fk = properties.properties_id','left');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->join('properties_room_category', 'properties_room_category.properties_room_category_id = hike_room_tariff_hike_rate.hike_room_id_fk','left');
		$this->db->order_by('hike_room_tariff_hike_id', 'DESC');
		$this->db->group_by('hike_room_tariff_hike_rate.hike_room_tariff_hike_id_fk');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getRoomHiketariffTotalCount($param,$properties_id_fk);
        $data['recordsFiltered'] = $this->getRoomHiketariffTotalCount($param,$properties_id_fk);
        return $data;

	}

	public function getRoomHiketariffTotalCount($param = NULL,$properties_id_fk){
		// Handle room tariff date range
		$room_tariff_from_date_filter =(isset($param['room_tariff_from_date_filter']))?$param['room_tariff_from_date_filter']:'';
        $room_tariff_to_date_filter =(isset($param['room_tariff_to_date_filter']))?$param['room_tariff_to_date_filter']:'';

		// Handle hike tariff date range
		$hike_room_tariff_hike_from_date_filter =(isset($param['hike_room_tariff_hike_from_date_filter']))?$param['hike_room_tariff_hike_from_date_filter']:'';
        $hike_room_tariff_hike_to_date_filter =(isset($param['hike_room_tariff_hike_to_date_filter']))?$param['hike_room_tariff_hike_to_date_filter']:'';

		// Handle created by filter
		$hike_room_tariff_hike_createdby_user_id =(isset($param['hike_room_tariff_hike_createdby_user_id']))?$param['hike_room_tariff_hike_createdby_user_id']:'';


		if($room_tariff_from_date_filter){
            $this->db->where('room_tariff_hike_from_date>=', $room_tariff_from_date_filter);
        }
        if($room_tariff_to_date_filter){
            $this->db->where('room_tariff_hike_to_date<=', $room_tariff_to_date_filter);
        }
        if($hike_room_tariff_hike_from_date_filter){
            $this->db->where('hike_room_tariff_hike_from_date>=', $hike_room_tariff_hike_from_date_filter);
        }
        if($hike_room_tariff_hike_to_date_filter){
            $this->db->where('hike_room_tariff_hike_to_date<=', $hike_room_tariff_hike_to_date_filter);
        }
        if($hike_room_tariff_hike_createdby_user_id){
            $this->db->where('hike_room_tariff_hike_createdby_user_id', $hike_room_tariff_hike_createdby_user_id);
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(hike_room_tariff_hike_from_date,\'%d-%m-%Y\') as hike_room_tariff_hike_from_date,DATE_FORMAT(hike_room_tariff_hike_to_date,\'%d-%m-%Y\') as hike_room_tariff_hike_to_date,DATE_FORMAT(room_tariff_hike_from_date,\'%d-%m-%Y\') as room_tariff_hike_from_date,DATE_FORMAT(room_tariff_hike_to_date,\'%d-%m-%Y\') as room_tariff_hike_to_date');
		$this->db->from('hike_room_tariff_hike');
		$this->db->join('hike_room_tariff_hike_rate', 'hike_room_tariff_hike_rate.hike_room_tariff_hike_id_fk = hike_room_tariff_hike.hike_room_tariff_hike_id','left');
		$this->db->join('room_tariff_hike', 'room_tariff_hike.room_tariff_hike_id = hike_room_tariff_hike.room_tariff_hike_id_fk','left');
		$this->db->join('properties', 'hike_room_tariff_hike.hike_properties_id_fk = properties.properties_id','left');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->join('properties_room_category', 'properties_room_category.properties_room_category_id = hike_room_tariff_hike_rate.hike_room_id_fk','left');
		$this->db->where("hike_room_tariff_hike_status",1);
		$this->db->where("hike_room_tariff_hike.hike_properties_id_fk",$properties_id_fk);
		$this->db->order_by('hike_room_tariff_hike_id', 'DESC');
		$this->db->group_by('hike_room_tariff_hike_rate.hike_room_tariff_hike_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }

	function fetch_property_inclusions()
	{
		$this->db->order_by("property_inclusions_id", "ASC");
		$this->db->where("property_inclusions_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("property_inclusions");
		return $query->result();
	}

    function fetch_meal_plan()
	{
		$this->db->order_by("meal_plan_id", "ASC");
		$this->db->where("meal_plan_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("meal_plan");
		return $query->result();
	}

	function fetch_properties_details()
	{
		$this->db->order_by("properties_id", "ASC");
		$this->db->where("properties_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("properties");
		return $query->result();
	}

	function fetch_room_category_details()
	{
		$this->db->order_by("properties_room_category_id", "ASC");
		$this->db->where("properties_room_category_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("properties_room_category");
		return $query->result();
	}

	// Faster: only room categories for this property (used in lazy-loaded tabs)
	function fetch_room_category_details_by_property($properties_id_fk)
	{
		$this->db->order_by("properties_room_category_id", "ASC");
		$this->db->where("properties_room_category_status", 1);
		$this->db->where("properties_id_fk", (int)$properties_id_fk);
		$query = $this->db->get("properties_room_category");
		return $query->result();
	}

	function fetch_property_category()
	{
		$this->db->order_by("property_category_id", "ASC");
		$this->db->where("property_category_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("property_category");
		return $query->result();
	}

	function fetch_staff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}
	
	public function property_data($properties_id){
        $this->db->select('*,n1.state_name as plname, n2.state_name as rcname');
		$this->db->from('properties');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->join('country', 'properties.country_id_fk = country.id','left');
		$this->db->join('state n1', 'n1.state_id = properties.state_id_fk');
        $this->db->join('state n2', 'n2.state_id = properties.properties_destination_id_fk');
        $this->db->where("properties_status",1);
        $this->db->where('properties_id',$properties_id);
         $query = $this->db->get();
         return $query->row();
    }

	public function get_property_view_row($properties_id)
    {
       $this->db->select('*,location.location_name as plname, state.state_name as rcname');
		$this->db->from('properties');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->join('country', 'properties.country_id_fk = country.id','left');
		$this->db->join('location', 'location.location_id = properties.location_id_fk','left');
        $this->db->join('state', 'state.state_id = properties.properties_destination_id_fk');
        $this->db->where("properties_status",1);
        $this->db->where("properties_id",$properties_id);
		$this->db->order_by('properties_id', 'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
    }
	function fetch_country()
	{
		$this->db->order_by("id", "ASC");
		$query = $this->db->get("country");
		return $query->result();
	}

	function fetch_state()
	{
		$this->db->order_by("state_id", "ASC");
		 $this->db->where("state_status",1);
		$query = $this->db->get("state");
		return $query->result();
	}

	function fetch_location()
	{
		$this->db->order_by("location_id", "ASC");
		 $this->db->where("location_status",1);
		$query = $this->db->get("location");
		return $query->result();
	}

	function fetch_destination_by_location($location_id)
	{
		$this->db->order_by("state_id", "ASC");
		 $this->db->where("state_status",1);
		 $this->db->where("location_id_fk", $location_id);
		$query = $this->db->get("state");
		return $query->result();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id)
	{
		$this->db->select('properties.*, property_category.property_category_name, country.name as country_name, location.location_name, state.state_name as destination_name');
		$this->db->from($this->table);
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk', 'left');
		$this->db->join('country', 'country.id = properties.country_id_fk', 'left');
		$this->db->join('location', 'location.location_id = properties.location_id_fk', 'left');
		$this->db->join('state', 'state.state_id = properties.properties_destination_id_fk', 'left');
		$this->db->where("properties_status",1);
		$this->db->where('properties_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id, $data)
	{
		$this->db->where('properties_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function save1($data)
	{
		$this->db->insert($this->table1, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id1($id)
	{
		$this->db->from($this->table1);
		$this->db->where("properties_room_category_status",1);
		$this->db->where('properties_room_category_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function update1($where, $data)
	{
		$this->db->update($this->table1, $data, $where);
		// echo $this->db->last_query();exit();
		return $this->db->affected_rows();
	}
	
	public function delete_by_id1($id, $data)
	{
		$this->db->where('properties_room_category_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table1, $data);
		return $this->db->affected_rows();
	}

	public function save2($data)
	{
		$this->db->insert($this->table2, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id2($id)
	{
		// $this->db->from($this->table2);
		$this->db->select('*,DATE_FORMAT(upload_tariff_document_from_date,\'%d-%m-%Y\') as upload_tariff_document_from_date,DATE_FORMAT(upload_tariff_document_to_date	,\'%d-%m-%Y\') as upload_tariff_document_to_date');
		$this->db->from('upload_tariff_document');
		$this->db->where("upload_tariff_document_status",1);
		$this->db->where('upload_tariff_document_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function update2($where, $data)
	{
		$this->db->update($this->table2, $data, $where);
		// echo $this->db->last_query();exit();
		return $this->db->affected_rows();
	}
	
	public function delete_by_id2($id, $data)
	{
		$this->db->where('upload_tariff_document_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table1, $data);
		return $this->db->affected_rows();
	}

	public function save3($data)
	{
		$this->db->insert($this->table3, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id3($id)
	{
		$this->db->from($this->table3);
		$this->db->where('property_inclusions_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function update3($where, $data)
	{
		$this->db->update($this->table3, $data, $where);
		// echo $this->db->last_query();exit();
		return $this->db->affected_rows();
	}
	
	public function delete_by_id3($id, $data)
	{
		$this->db->where('upload_tariff_document_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table3, $data);
		return $this->db->affected_rows();
	}
}

?>