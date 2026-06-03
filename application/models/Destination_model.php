<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Destination_model extends CI_Model{
	var $table = 'state';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getDestinationTable($param){
		$arOrder = array('','roles_name');
		$state_id_filter =(isset($param['state_id_filter']))?$param['state_id_filter']:'';
		$state_created_user_id =(isset($param['state_created_user_id']))?$param['state_created_user_id']:'';
		
		
		if($state_id_filter){
            $this->db->where('state_id', $state_id_filter); 
        }
		if($state_created_user_id){
            $this->db->where('state_created_user_id', $state_created_user_id); 
        }
        $this->db->where("state_status",1);

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
		$this->db->from('state');
		$this->db->order_by('state_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getDestinationTotalCount($param);
        $data['recordsFiltered'] = $this->getDestinationTotalCount($param);
        return $data;

	}

	public function getDestinationTotalCount($param = NULL){

		$state_id_filter =(isset($param['state_id_filter']))?$param['state_id_filter']:'';
		$state_created_user_id =(isset($param['state_created_user_id']))?$param['state_created_user_id']:'';
		
		
		if($state_id_filter){
            $this->db->where('state_id', $state_id_filter); 
        }
		if($state_created_user_id){
            $this->db->where('state_created_user_id', $state_created_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('state');
		$this->db->order_by('state_id', 'DESC');
		$this->db->where("state_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	// function fetch_itinerary_category_details()
	// {
	// 	$this->db->order_by("itinerary_category_id", "ASC");
	// 	$this->db->where("itinerary_category_status",1);
	// 	// $this->db->where("user_type",'S');
	// 	$query = $this->db->get("itinerary_category");
	// 	return $query->result();
	// }

	function fetch_staff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}
	
	
	

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where("state_status",1);
		$this->db->where('state_id',$id);
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
		$this->db->where('state_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>