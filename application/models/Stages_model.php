<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Stages_model extends CI_Model{
	var $table = 'stages';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getStageTable($param){
		$arOrder = array('','roles_name');
		$stages_id =(isset($param['stages_id']))?$param['stages_id']:'';
		$stages_created_user_id =(isset($param['stages_created_user_id']))?$param['stages_created_user_id']:'';
		
		
		if($stages_id){
            $this->db->where('stages_id', $stages_id); 
        }
		if($stages_created_user_id){
            $this->db->where('stages_created_user_id', $stages_created_user_id); 
        }
        $this->db->where("stages_status",1);

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
		$this->db->from('stages');
		$this->db->order_by('stages_id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();die;

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getStageTotalCount($param);
        $data['recordsFiltered'] = $this->getStageTotalCount($param);
        return $data;

	}

	public function getStageTotalCount($param = NULL){

		$stages_id =(isset($param['stages_id']))?$param['stages_id']:'';
		$stages_created_user_id =(isset($param['stages_created_user_id']))?$param['stages_created_user_id']:'';
		
		
		if($stages_id){
            $this->db->where('stages_id', $stages_id); 
        }
		if($stages_created_user_id){
            $this->db->where('stages_created_user_id', $stages_created_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('stages');
		$this->db->order_by('stages_id', 'DESC');
        $this->db->where("stages_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_stages_details()
	{
		$this->db->order_by("stages_id", "ASC");
		$this->db->where("stages_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("stages");
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
	
	public function checkstage($stages_name)
    {
        // $status=1;
        $this->db->select('stages_name');
        $this->db->from('stages');  
        $this->db->where('stages_name', $stages_name);
        $this->db->where('stages_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEditstage($stages_name, $stages_id)
    {
        // $status=1;
        $this->db->select('stages_name');
        $this->db->from('stages');
        $this->db->where('stages_name', $stages_name);
        $this->db->where('stages_id !=', $stages_id);
        $this->db->where('stages_status', '1');
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
		$this->db->where("stages_status",1);
		$this->db->where('stages_id',$id);
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
		$this->db->where('stages_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>