<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Designation_model extends CI_Model{
	var $table = 'designation';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getDesignationTable($param){
		$arOrder = array('','roles_name');
		$designation_id =(isset($param['designation_id']))?$param['designation_id']:'';
		$designation_created_by_user_id =(isset($param['designation_created_by_user_id']))?$param['designation_created_by_user_id']:'';
		
		
		if($designation_id){
            $this->db->where('designation_id', $designation_id); 
        }
		if($designation_created_by_user_id){
            $this->db->where('designation_created_by_user_id', $designation_created_by_user_id); 
        }
        $this->db->where("designation_status",1);

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
		$this->db->from('designation');
		$this->db->order_by('designation_id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();die;

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getDesignationTotalCount($param);
        $data['recordsFiltered'] = $this->getDesignationTotalCount($param);
        return $data;

	}

	public function getDesignationTotalCount($param = NULL){

		$designation_id =(isset($param['designation_id']))?$param['designation_id']:'';
		$designation_created_by_user_id =(isset($param['designation_created_by_user_id']))?$param['designation_created_by_user_id']:'';
		
		
		if($designation_id){
            $this->db->where('designation_id', $designation_id); 
        }
		if($designation_created_by_user_id){
            $this->db->where('designation_created_by_user_id', $designation_created_by_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('designation');
		$this->db->order_by('designation_id', 'DESC');
        $this->db->where("designation_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_designation_details()
	{
		$this->db->order_by("designation_id", "ASC");
		$this->db->where("designation_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("designation");
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
	
	public function checkdesignation($designation_name)
    {
        // $status=1;
        $this->db->select('designation_name');
        $this->db->from('designation');  
        $this->db->where('designation_name', $designation_name);
        $this->db->where('designation_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEditdesignation($designation_name, $designation_id)
    {
        // $status=1;
        $this->db->select('designation_name');
        $this->db->from('designation');
        $this->db->where('designation_name', $designation_name);
        $this->db->where('designation_id !=', $designation_id);
        $this->db->where('designation_status', '1');
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
		$this->db->where("designation_status",1);
		$this->db->where('designation_id',$id);
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
		$this->db->where('designation_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>