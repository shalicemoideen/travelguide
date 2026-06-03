<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Rooms_model extends CI_Model{
	var $table = 'properties_room_category';

	public function __construct()
    {
        parent::__construct();
    }

    public function getRoomsTable($param){
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
		$this->db->order_by('properties_room_category_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getRoomsTotalCount($param);
        $data['recordsFiltered'] = $this->getRoomsTotalCount($param);
        return $data;

	}

	public function getRoomsTotalCount($param = NULL){

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
		$this->db->order_by('properties_room_category_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
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

	public function save1($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where("properties_room_category_status",1);
		$this->db->where('properties_room_category_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		// echo $this->db->last_query();exit();
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id, $data)
	{
		$this->db->where('properties_room_category_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}

?>