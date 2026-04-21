<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Special_requirments_model extends CI_Model{
	var $table = 'special_requirements';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getSpecialrequirmentsTable($param){
		$arOrder = array('','roles_name');
		$special_requirements_id =(isset($param['special_requirements_id']))?$param['special_requirements_id']:'';
		$special_requirements_createdby_user_id =(isset($param['special_requirements_createdby_user_id']))?$param['special_requirements_createdby_user_id']:'';
		
		
		if($special_requirements_id){
            $this->db->where('special_requirements_id', $special_requirements_id); 
        }
		if($special_requirements_createdby_user_id){
            $this->db->where('special_requirements_createdby_user_id', $special_requirements_createdby_user_id); 
        }
        $this->db->where("special_requirements_status",1);

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
		$this->db->from('special_requirements');
		$this->db->order_by('special_requirements_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getSpecialrequirmentsTotalCount($param);
        $data['recordsFiltered'] = $this->getSpecialrequirmentsTotalCount($param);
        return $data;

	}

	public function getSpecialrequirmentsTotalCount($param = NULL){

		$special_requirements_id =(isset($param['special_requirements_id']))?$param['special_requirements_id']:'';
		$special_requirements_createdby_user_id =(isset($param['special_requirements_createdby_user_id']))?$param['special_requirements_createdby_user_id']:'';
		
		
		if($special_requirements_id){
            $this->db->where('special_requirements_id', $special_requirements_id); 
        }
		if($special_requirements_createdby_user_id){
            $this->db->where('special_requirements_createdby_user_id', $special_requirements_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('special_requirements');
		$this->db->order_by('special_requirements_id', 'DESC');
		$this->db->where("special_requirements_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_special_requirements_details()
	{
		$this->db->order_by("special_requirements_id", "ASC");
		$this->db->where("special_requirements_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("special_requirements");
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
	
	public function checkspecial_requirements($special_requirements_name)
    {
        // $status=1;
        $this->db->select('special_requirements_name');
        $this->db->from('special_requirements');  
        $this->db->where('special_requirements_name', $special_requirements_name);
        $this->db->where('special_requirements_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEditspecial_requirements($special_requirements_name, $special_requirements_id)
    {
        // $status=1;
        $this->db->select('special_requirements_name');
        $this->db->from('special_requirements');
        $this->db->where('special_requirements_name', $special_requirements_name);
        $this->db->where('special_requirements_id !=', $special_requirements_id);
        $this->db->where('special_requirements_status', '1');
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
		$this->db->where("special_requirements_status",1);
		$this->db->where('special_requirements_id',$id);
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
		$this->db->where('special_requirements_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>