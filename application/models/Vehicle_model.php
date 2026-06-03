<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Vehicle_model extends CI_Model{
	var $table = 'vehicle';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getVehicleTable($param){
		$arOrder = array('','roles_name');
		$vehicle_id =(isset($param['vehicle_id']))?$param['vehicle_id']:'';
		$vehicle_createdby_user_id =(isset($param['vehicle_createdby_user_id']))?$param['vehicle_createdby_user_id']:'';
		
		
		if($vehicle_id){
            $this->db->where('vehicle_id', $vehicle_id); 
        }
		if($vehicle_createdby_user_id){
            $this->db->where('vehicle_createdby_user_id', $vehicle_createdby_user_id); 
        }
        $this->db->where("vehicle_status",1);

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
		$this->db->from('vehicle');
		$this->db->order_by('vehicle_id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();die;

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getVehicleTotalCount($param);
        $data['recordsFiltered'] = $this->getVehicleTotalCount($param);
        return $data;

	}

	public function getVehicleTotalCount($param = NULL){

		$vehicle_id =(isset($param['vehicle_id']))?$param['vehicle_id']:'';
		$vehicle_createdby_user_id =(isset($param['vehicle_createdby_user_id']))?$param['vehicle_createdby_user_id']:'';
		
		
		if($vehicle_id){
            $this->db->where('vehicle_id', $vehicle_id); 
        }
		if($vehicle_createdby_user_id){
            $this->db->where('vehicle_createdby_user_id', $vehicle_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('vehicle');
		$this->db->order_by('vehicle_id', 'DESC');
		$this->db->where("vehicle_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_vehicle_details()
	{
		$this->db->order_by("vehicle_id", "ASC");
		$this->db->where("vehicle_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("vehicle");
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
	
	
	function fetch_company()
	{
		$this->db->select('*');
		$this->db->from('user_details');
		
		$this->db->where('user_type', 'C');
		$this->db->where('user_status', '1');
		$this->db->order_by("user_id", "ASC");
		$query = $this->db->get();
		return $query->result();
	}
	
	public function checkvehicle($vehicle_name)
    {
        // $status=1;
        $this->db->select('vehicle_name');
        $this->db->from('vehicle');  
        $this->db->where('vehicle_name', $vehicle_name);
        $this->db->where('vehicle_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEditvehicle($vehicle_name, $vehicle_id)
    {
        // $status=1;
        $this->db->select('vehicle_name');
        $this->db->from('vehicle');
        $this->db->where('vehicle_name', $vehicle_name);
        $this->db->where('vehicle_id !=', $vehicle_id);
        $this->db->where('vehicle_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where("vehicle_status",1);
		$this->db->where('vehicle_id',$id);
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
		$this->db->where('vehicle_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>