<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Source_model extends CI_Model{
	var $table = 'source';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getSourceTable($param){
		$arOrder = array('','roles_name');
		$source_id =(isset($param['source_id']))?$param['source_id']:'';
		$source_created_user_id =(isset($param['source_created_user_id']))?$param['source_created_user_id']:'';
		
		
		if($source_id){
            $this->db->where('source_id', $source_id); 
        }
		if($source_created_user_id){
            $this->db->where('source_created_user_id', $source_created_user_id); 
        }
        $this->db->where("source_status",1);

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
		$this->db->from('source');
		$this->db->order_by('source_id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();die;

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSourceTotalCount($param);
        $data['recordsFiltered'] = $this->getSourceTotalCount($param);
        return $data;

	}

	public function getSourceTotalCount($param = NULL){

		$source_id =(isset($param['source_id']))?$param['source_id']:'';
		$source_created_user_id =(isset($param['source_created_user_id']))?$param['source_created_user_id']:'';
		
		
		if($source_id){
            $this->db->where('source_id', $source_id); 
        }
		if($source_created_user_id){
            $this->db->where('source_created_user_id', $source_created_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('source');
		$this->db->order_by('source_id', 'DESC');
        $this->db->where("source_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_source_details()
	{
		$this->db->order_by("source_id", "ASC");
		$this->db->where("source_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("source");
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
	
	public function checksource($source_name)
    {
        // $status=1;
        $this->db->select('source_name');
        $this->db->from('source');  
        $this->db->where('source_name', $source_name);
        $this->db->where('source_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEditsource($source_name, $source_id)
    {
        // $status=1;
        $this->db->select('source_name');
        $this->db->from('source');
        $this->db->where('source_name', $source_name);
        $this->db->where('source_id !=', $source_id);
        $this->db->where('source_status', '1');
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
		$this->db->where("source_status",1);
		$this->db->where('source_id',$id);
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
		$this->db->where('source_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>