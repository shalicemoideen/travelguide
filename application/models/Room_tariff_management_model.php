<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Room_tariff_management_model extends CI_Model{
	var $table = 'room_tariff_hike';
	var $table1 = 'hike_room_tariff_hike';

	public function __construct()
    {
        parent::__construct();
    }
	
	public function getRoomtariffTable($param){
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
		$this->db->order_by('room_tariff_hike_id', 'DESC');
		$this->db->group_by('room_tariff_hike_rate.room_tariff_hike_id_fk');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getRoomtariffTotalCount($param);
        $data['recordsFiltered'] = $this->getRoomtariffTotalCount($param);
        return $data;

	}

	public function getRoomtariffTotalCount($param = NULL){

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
		$this->db->where("room_tariff_hike_status",1);
		$this->db->order_by('room_tariff_hike_id', 'DESC');
		$this->db->group_by('room_tariff_hike_rate.room_tariff_hike_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	public function getHikeRoomtariffTable($param,$room_tariff_hike_id_fk){
		$arOrder = array('','roles_name');
		$properties_id =(isset($param['properties_id']))?$param['properties_id']:'';
		$property_category_id_fk =(isset($param['property_category_id_fk']))?$param['property_category_id_fk']:'';
		$properties_room_category_id =(isset($param['properties_room_category_id']))?$param['properties_room_category_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		$hike_room_tariff_hike_createdby_user_id =(isset($param['hike_room_tariff_hike_createdby_user_id']))?$param['hike_room_tariff_hike_createdby_user_id']:'';
		
		
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
            $this->db->where('hike_room_tariff_hike_from_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('hike_room_tariff_hike_to_date<=', $end_date); 
        }
        if($hike_room_tariff_hike_createdby_user_id){
            $this->db->where('hike_room_tariff_hike_createdby_user_id', $hike_room_tariff_hike_createdby_user_id); 
        }
        $this->db->where("hike_room_tariff_hike_status",1);
        $this->db->where("hike_room_tariff_hike_id_fk",$room_tariff_hike_id_fk);

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
		$this->db->select('*,DATE_FORMAT(hike_room_tariff_hike_from_date,\'%d-%m-%Y\') as hike_room_tariff_hike_from_date,DATE_FORMAT(hike_room_tariff_hike_to_date,\'%d-%m-%Y\') as hike_room_tariff_hike_to_date');
		$this->db->from('hike_room_tariff_hike');
		$this->db->join('hike_room_tariff_hike_rate', 'hike_room_tariff_hike_rate.hike_room_tariff_hike_id_fk = hike_room_tariff_hike.hike_room_tariff_hike_id','left');
		$this->db->join('properties', 'hike_room_tariff_hike.hike_properties_id_fk = properties.properties_id','left');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->order_by('hike_room_tariff_hike_id', 'DESC');
		$this->db->group_by('hike_room_tariff_hike_rate.hike_room_tariff_hike_id_fk');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getHikeRoomtariffTotalCount($param,$room_tariff_hike_id_fk);
        $data['recordsFiltered'] = $this->getHikeRoomtariffTotalCount($param,$room_tariff_hike_id_fk);
        return $data;

	}

	public function getHikeRoomtariffTotalCount($param = NULL,$room_tariff_hike_id_fk){

		$properties_id =(isset($param['properties_id']))?$param['properties_id']:'';
		$property_category_id_fk =(isset($param['property_category_id_fk']))?$param['property_category_id_fk']:'';
		$properties_room_category_id =(isset($param['properties_room_category_id']))?$param['properties_room_category_id']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';
		$hike_room_tariff_hike_createdby_user_id =(isset($param['hike_room_tariff_hike_createdby_user_id']))?$param['hike_room_tariff_hike_createdby_user_id']:'';
		
		
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
            $this->db->where('hike_room_tariff_hike_from_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('hike_room_tariff_hike_to_date<=', $end_date); 
        }
        if($hike_room_tariff_hike_createdby_user_id){
            $this->db->where('hike_room_tariff_hike_createdby_user_id', $hike_room_tariff_hike_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(hike_room_tariff_hike_from_date,\'%d-%m-%Y\') as hike_room_tariff_hike_from_date,DATE_FORMAT(hike_room_tariff_hike_to_date,\'%d-%m-%Y\') as hike_room_tariff_hike_to_date');
		$this->db->from('hike_room_tariff_hike');
		$this->db->join('hike_room_tariff_hike_rate', 'hike_room_tariff_hike_rate.hike_room_tariff_hike_id_fk = hike_room_tariff_hike.hike_room_tariff_hike_id','left');
		$this->db->join('properties', 'hike_room_tariff_hike.hike_properties_id_fk = properties.properties_id','left');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->where("hike_room_tariff_hike_id_fk",$room_tariff_hike_id_fk);
		$this->db->order_by('hike_room_tariff_hike_id', 'DESC');
		$this->db->group_by('hike_room_tariff_hike_rate.hike_room_tariff_hike_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }

    public function rooms_array_list($properties_id){


        $query1 = "select *
                        from 
                            properties_room_category
                            

                        where properties_id_fk = $properties_id AND
                            properties_room_category_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    public function weekdays_array_list(){


        $query1 = "select *
                        from 
                            week_days
                        where
                            	week_days_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }


    function fetch_property_rooms($properties_id)
	{

		
		
		$this->db->select('*');
		$this->db->from('properties_room_category');
		// $this->db->join('vehicle', 'transporter_vehicle.vehicle_id_fk = vehicle.vehicle_id');
		$this->db->where("properties_room_category_status",1);
		$this->db->where("properties_id_fk	",$properties_id);
		$query = $this->db->get();
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
	

	public function property_data($room_tariff_hike_id){
        $this->db->select('*');
		$this->db->from('room_tariff_hike');
		$this->db->join('room_tariff_hike_rate', 'room_tariff_hike_rate.room_tariff_hike_id_fk = room_tariff_hike.room_tariff_hike_id','left');
		$this->db->join('properties', 'room_tariff_hike.properties_id_fk = properties.properties_id','left');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->where("room_tariff_hike_status",1);
	    $this->db->where("room_tariff_hike_id",$room_tariff_hike_id);
         $query = $this->db->get();
         return $query->row();
    }

	public function get_room_tariff_view_row($room_tariff_hike_id)
    {
        $this->db->select('*');
		$this->db->from('room_tariff_hike');
		$this->db->join('room_tariff_hike_rate', 'room_tariff_hike_rate.room_tariff_hike_id_fk = room_tariff_hike.room_tariff_hike_id','left');
		$this->db->join('properties', 'room_tariff_hike.properties_id_fk = properties.properties_id','left');
		$this->db->join('property_category', 'property_category.property_category_id = properties.property_category_id_fk','left');
		$this->db->where("room_tariff_hike_status",1);
	    $this->db->where("room_tariff_hike_id",$room_tariff_hike_id);
		$this->db->order_by('room_tariff_hike_id', 'DESC');
		$query = $this->db->get();
		//echo $this->db->last_query();
	    if($query->num_rows() > 0)
	    {
	        return $query->row();
	    }
	    return false;
    }


	public function get_tariff_full($hikeId)
	{
		$hikeId = (int)$hikeId;

		// 1) header
		$hike = $this->db->where('room_tariff_hike_id', $hikeId)
						->get('room_tariff_hike')
						->row_array();

		if (!$hike) return null;

		$propertyId = (int)$hike['properties_id_fk'];

		// 2) rooms of the property
		$rooms = $this->db->where('properties_id_fk', $propertyId)
						->where('properties_room_category_status', 1)
						->order_by('properties_room_category_id', 'ASC')
						->get('properties_room_category')
						->result_array();

		// 3) weekdays
		$weekdays = $this->db->where('week_days_status', 1)
							->order_by('week_days_id', 'ASC')
							->get('week_days')
							->result_array();

		// 4) per-room rates
		$rates = $this->db->where('room_tariff_hike_id_fk', $hikeId)
						->where('room_tariff_hike_rate_status', 1)
						->get('room_tariff_hike_rate')
						->result_array();

		// 5) week day rates (join to get room_id if needed)
		// IMPORTANT: your table has week_days_room_id_fk, so filter by hike via room_tariff_hike_rate
		// $weekRates = $this->db->select('w.*')
		// 					->from('room_tariff_week_days_rate w')
		// 					->join('room_tariff_hike_rate r', 'r.room_tariff_hike_rate_id = w.week_days_room_tariff_hike_id_fk')
		// 					->where('r.room_tariff_hike_id_fk', $hikeId)
		// 					->where('w.room_tariff_week_days_rate_status', 1)
		// 					->get()
		// 					->result_array();

		$weekRates = $this->db->select('w.*, r.room_id_fk AS room_id_fk')
					->from('room_tariff_week_days_rate w')
					->join('room_tariff_hike_rate r', 'r.room_tariff_hike_rate_id = w.week_days_room_tariff_hike_id_fk')
					->where('r.room_tariff_hike_id_fk', $hikeId)
					->where('w.room_tariff_week_days_rate_status', 1)
					->get()
					->result_array();

		return [
			"hike"      => $hike,
			"rooms"     => $rooms,
			"weekdays"  => $weekdays,
			"rates"     => $rates,
			"weekRates" => $weekRates,
		];
	}

	public function is_date_range_conflict($property_id, $from_date, $to_date, $exclude_hike_id = 0)
	{
		$property_id = (int)$property_id;
		$exclude_hike_id = (int)$exclude_hike_id;

		// $from_date and $to_date must be Y-m-d
		$this->db->from('room_tariff_hike');
		$this->db->where('properties_id_fk', $property_id);
		$this->db->where('room_tariff_hike_status', 1);

		if ($exclude_hike_id > 0) {
			$this->db->where('room_tariff_hike_id !=', $exclude_hike_id);
		}

		// overlap condition:
		// new_from <= existing_to AND new_to >= existing_from
		$this->db->where('room_tariff_hike_from_date <=', $to_date);
		$this->db->where('room_tariff_hike_to_date >=', $from_date);

		return ($this->db->count_all_results() > 0);
	}

	public function get_last_tariff_for_property($property_id, $new_from_date = '')
	{
		$property_id = (int)$property_id;

		// If from date provided, pick last tariff that ended before new_from_date
		if ($new_from_date != '') {
			$row = $this->db->where('properties_id_fk', $property_id)
				->where('room_tariff_hike_status', 1)
				->where('room_tariff_hike_to_date <', $new_from_date)
				->order_by('room_tariff_hike_to_date', 'DESC')
				->order_by('room_tariff_hike_id', 'DESC')
				->limit(1)
				->get('room_tariff_hike')
				->row_array();

			if ($row) return $this->get_tariff_view($row['room_tariff_hike_id']);
		}

		// fallback: latest tariff of this property
		$row2 = $this->db->where('properties_id_fk', $property_id)
			->where('room_tariff_hike_status', 1)
			->order_by('room_tariff_hike_to_date', 'DESC')
			->order_by('room_tariff_hike_id', 'DESC')
			->limit(1)
			->get('room_tariff_hike')
			->row_array();

		if ($row2) return $this->get_tariff_view($row2['room_tariff_hike_id']);

		return null;
	}

	public function get_tariff_view($hikeId)
	{
		$hikeId = (int)$hikeId;

		// Header + property name
		$hike = $this->db->select('h.*, p.properties_name')
			->from('room_tariff_hike h')
			->join('properties p', 'p.properties_id = h.properties_id_fk', 'left')
			->where('h.room_tariff_hike_id', $hikeId)
			->limit(1)
			->get()
			->row_array();

		if (!$hike) return null;

		// Rates + room name
		$rates = $this->db->select('r.*, rc.properties_room_category_name')
			->from('room_tariff_hike_rate r')
			->join('properties_room_category rc', 'rc.properties_room_category_id = r.room_id_fk', 'left')
			->where('r.room_tariff_hike_id_fk', $hikeId)
			->where('r.room_tariff_hike_rate_status', 1)
			->order_by('r.room_tariff_hike_rate_id', 'ASC')
			->get()
			->result_array();

		// Weekday rows (ONLY status=1) with weekday name and room_id_fk from join
		$weekRates = $this->db->select('w.*, d.week_days_name, r.room_id_fk AS room_id_fk')
			->from('room_tariff_week_days_rate w')
			->join('week_days d', 'd.week_days_id = w.week_days_id_fk', 'left')
			->join('room_tariff_hike_rate r', 'r.room_tariff_hike_rate_id = w.week_days_room_tariff_hike_id_fk', 'left')
			->where('r.room_tariff_hike_id_fk', $hikeId)
			->where('w.room_tariff_week_days_rate_status', 1)
			->order_by('r.room_id_fk', 'ASC')
			->order_by('w.week_days_id_fk', 'ASC')
			->get()
			->result_array();

		return array(
			"hike"      => $hike,
			"rates"     => $rates,
			"weekRates" => $weekRates
		);
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id)
	{
		$this->db->select('*,room_tariff_hike_id,properties_name');
		$this->db->from('room_tariff_hike');
		$this->db->join('properties', 'room_tariff_hike.properties_id_fk = properties.properties_id','left');
		// $this->db->from($this->table);
		$this->db->where("room_tariff_hike_status",1);
		$this->db->where('room_tariff_hike_id',$id);
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
		$this->db->where('room_tariff_hike_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	public function get_by_id_hike($id)
	{
		$this->db->select('*,hike_room_tariff_hike_id,properties_name');
		$this->db->from('hike_room_tariff_hike');
		$this->db->join('properties', 'hike_room_tariff_hike.hike_properties_id_fk = properties.properties_id','left');
		// $this->db->from($this->table);
		$this->db->where("hike_room_tariff_hike_status",1);
		$this->db->where('hike_room_tariff_hike_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function update_hike($where, $data)
	{
		$this->db->update($this->table1, $data, $where);
		return $this->db->affected_rows();
	}

	///////////// Rppm tariff hike //////////

	public function get_room_tariff_hike($room_tariff_hike_id)
	{
		return $this->db->where('room_tariff_hike_id', (int)$room_tariff_hike_id)
			->where('room_tariff_hike_status', 1)
			->get('room_tariff_hike')
			->row_array();
	}

	public function is_hike_date_range_conflict($room_tariff_hike_id_fk, $property_id, $from_date, $to_date, $exclude_id)
	{
		$room_tariff_hike_id_fk = (int)$room_tariff_hike_id_fk;
		$property_id = (int)$property_id;
		$exclude_id = (int)$exclude_id;

		$this->db->from('hike_room_tariff_hike');
		$this->db->where('room_tariff_hike_id_fk', $room_tariff_hike_id_fk);
		$this->db->where('hike_properties_id_fk', $property_id);
		$this->db->where('hike_room_tariff_hike_status', 1);

		if ($exclude_id > 0) {
			$this->db->where('hike_room_tariff_hike_id !=', $exclude_id);
		}

		// overlap
		$this->db->where('hike_room_tariff_hike_from_date <=', $to_date);
		$this->db->where('hike_room_tariff_hike_to_date >=', $from_date);

		return ($this->db->count_all_results() > 0);
	}

	public function get_parent_room_tariff_dates($room_tariff_hike_id)
	{
		return $this->db->select('room_tariff_hike_id, room_tariff_hike_from_date, room_tariff_hike_to_date, properties_id_fk')
			->from('room_tariff_hike')
			->where('room_tariff_hike_id', (int)$room_tariff_hike_id)
			->where('room_tariff_hike_status', 1)
			->limit(1)
			->get()
			->row_array();
	}

	public function is_hike_overlap_by_parent($room_tariff_hike_id_fk, $from_date, $to_date, $exclude_hike_id)
	{
		$room_tariff_hike_id_fk = (int)$room_tariff_hike_id_fk;
		$exclude_hike_id = (int)$exclude_hike_id;

		$this->db->from('hike_room_tariff_hike');
		$this->db->where('room_tariff_hike_id_fk', $room_tariff_hike_id_fk);
		$this->db->where('hike_room_tariff_hike_status', 1);

		if ($exclude_hike_id > 0) {
			$this->db->where('hike_room_tariff_hike_id !=', $exclude_hike_id);
		}

		// overlap condition:
		$this->db->where('hike_room_tariff_hike_from_date <=', $to_date);
		$this->db->where('hike_room_tariff_hike_to_date >=', $from_date);

		return ($this->db->count_all_results() > 0);
	}

	public function get_hike_tariff_full($hike_id)
	{
		$hike_id = (int)$hike_id;

		$hike = $this->db->where('hike_room_tariff_hike_id', $hike_id)
			->get('hike_room_tariff_hike')
			->row_array();

		if (!$hike) return null;

		// rates with room name (room is properties_room_category_id in your system)
		// NOTE: your hike_rate table doesn't have room_id_fk column.
		// So we MUST store room id inside hike_room_tariff_week_days_rate (you already have hike_week_days_room_id_fk)
		// For main room blocks, we will still render rooms based on property rooms list and fill by mapping via weekdays table and existing rate rows.
		$rates = $this->db->where('hike_room_tariff_hike_id_fk', $hike_id)
			->where('hike_room_tariff_hike_rate_status', 1)
			->get('hike_room_tariff_hike_rate')
			->result_array();

		$weekRates = $this->db->select('w.*, d.week_days_name')
			->from('hike_room_tariff_week_days_rate w')
			->join('week_days d', 'd.week_days_id = w.hike_week_days_id_fk', 'left')
			->where('w.hike_room_tariff_week_days_rate_status', 1)
			->where('w.hike_room_tariff_hike_rate_id_fk IN (SELECT hike_room_tariff_hike_rate_id FROM hike_room_tariff_hike_rate WHERE hike_room_tariff_hike_id_fk=' . $hike_id . ')', null, false)
			->get()
			->result_array();

		return array(
			'hike' => $hike,
			'rates' => $rates,
			'weekRates' => $weekRates
		);
	}

	public function get_hike_tariff_view($hike_id)
	{
		$hike_id = (int)$hike_id;

		// Header + property name + parent room tariff date range
		$hike = $this->db->select('h.*, p.properties_name, rt.room_tariff_hike_from_date AS parent_from, rt.room_tariff_hike_to_date AS parent_to')
			->from('hike_room_tariff_hike h')
			->join('properties p', 'p.properties_id = h.hike_properties_id_fk', 'left')
			->join('room_tariff_hike rt', 'rt.room_tariff_hike_id = h.room_tariff_hike_id_fk', 'left')
			->where('h.hike_room_tariff_hike_id', $hike_id)
			->where('h.hike_room_tariff_hike_status', 1)
			->limit(1)
			->get()
			->row_array();

		if (!$hike) return null;

		// Rates + room name (needs hike_room_id_fk in hike_room_tariff_hike_rate)
		$rates = $this->db->select('r.*, rc.properties_room_category_name')
			->from('hike_room_tariff_hike_rate r')
			->join('properties_room_category rc', 'rc.properties_room_category_id = r.hike_room_id_fk', 'left')
			->where('r.hike_room_tariff_hike_id_fk', $hike_id)
			->where('r.hike_room_tariff_hike_rate_status', 1)
			->order_by('r.hike_room_tariff_hike_rate_id', 'ASC')
			->get()
			->result_array();

		// Weekday rates (status=1) with weekday name + room id
		$weekRates = $this->db->select('w.*, d.week_days_name, r.hike_room_id_fk AS room_id_fk')
			->from('hike_room_tariff_week_days_rate w')
			->join('week_days d', 'd.week_days_id = w.hike_week_days_id_fk', 'left')
			->join('hike_room_tariff_hike_rate r', 'r.hike_room_tariff_hike_rate_id = w.hike_room_tariff_hike_rate_id_fk', 'left')
			->where('r.hike_room_tariff_hike_id_fk', $hike_id)
			->where('w.hike_room_tariff_week_days_rate_status', 1)
			->order_by('r.hike_room_id_fk', 'ASC')
			->order_by('w.hike_week_days_id_fk', 'ASC')
			->get()
			->result_array();

		return array(
			"hike" => $hike,
			"rates" => $rates,
			"weekRates" => $weekRates
		);
	}

	public function get_last_hike_tariff_for_property($property_id, $new_from_date = '')
	{
		$property_id = (int)$property_id;

		// If from date provided, pick last hike tariff that ended before new_from_date
		if ($new_from_date != '') {

			$row = $this->db->where('hike_properties_id_fk', $property_id)
				->where('hike_room_tariff_hike_status', 1)
				->where('hike_room_tariff_hike_to_date <', $new_from_date)
				->order_by('hike_room_tariff_hike_to_date', 'DESC')
				->order_by('hike_room_tariff_hike_id', 'DESC')
				->limit(1)
				->get('hike_room_tariff_hike')
				->row_array();

			if ($row) return $this->get_hike_tariff_view($row['hike_room_tariff_hike_id']);
		}

		// fallback: latest hike tariff of this property
		$row2 = $this->db->where('hike_properties_id_fk', $property_id)
			->where('hike_room_tariff_hike_status', 1)
			->order_by('hike_room_tariff_hike_to_date', 'DESC')
			->order_by('hike_room_tariff_hike_id', 'DESC')
			->limit(1)
			->get('hike_room_tariff_hike')
			->row_array();

		if ($row2) return $this->get_hike_tariff_view($row2['hike_room_tariff_hike_id']);

		return null;
	}

	public function get_hike_tariff_viaew($hike_id)
		{
			$hike_id = (int)$hike_id;

			$hike = $this->db->where('hike_room_tariff_hike_id', $hike_id)
				->get('hike_room_tariff_hike')
				->row_array();

			if (!$hike) return null;

			$rates = $this->db->where('room_tariff_hike_id_fk', $hike_id)
				->get('hike_room_tariff_hike_rate')
				->result_array();

			// IMPORTANT:
			// This assumes hike_room_tariff_week_days_rate has room_tariff_hike_id_fk
			$weekRates = $this->db->where('room_tariff_hike_id_fk', $hike_id)
				->get('hike_room_tariff_week_days_rate')
				->result_array();

			return [
				"hike"      => $hike,
				"rates"     => $rates,
				"weekRates" => $weekRates
			];
		}
}

?>