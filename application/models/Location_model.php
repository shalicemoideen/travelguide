<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Location_model extends CI_Model{
	var $table = 'location';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getLocationTable($param){
		$arOrder = array('','location_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('location_name', $searchValue); 
        }
        $this->db->where("location_status",1);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("location_created_user_id",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('location');
		$this->db->order_by('location_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getLocationTotalCount($param);
        $data['recordsFiltered'] = $this->getLocationTotalCount($param);
        return $data;

	}

	public function getLocationTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('location_name', $searchValue); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("location_created_user_id",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('location');
		$this->db->order_by('location_id', 'DESC');
		$this->db->where("location_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
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
		$this->db->where("location_status",1);
		$this->db->where('location_id',$id);
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
		$this->db->where('location_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>
