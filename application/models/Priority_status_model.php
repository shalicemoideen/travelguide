<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Priority_status_model extends CI_Model{
	var $table = 'priority_status';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getPriortystatusTable($param){
		$arOrder = array('','roles_name');
		$priority_status_id =(isset($param['priority_status_id']))?$param['priority_status_id']:'';
		$priority_status_created_user_id =(isset($param['priority_status_created_user_id']))?$param['priority_status_created_user_id']:'';
		
		
		if($priority_status_id){
            $this->db->where('priority_status_id', $priority_status_id); 
        }
		if($priority_status_created_user_id){
            $this->db->where('priority_status_created_user_id', $priority_status_created_user_id); 
        }
        $this->db->where("priority_status_created_status",1);

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
		$this->db->from('priority_status');
		$this->db->order_by('priority_status_id', 'DESC');
        $query = $this->db->get();
        // echo $this->db->last_query();die;

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPrioritystatusTotalCount($param);
        $data['recordsFiltered'] = $this->getPrioritystatusTotalCount($param);
        return $data;

	}

	public function getPrioritystatusTotalCount($param = NULL){

		$priority_status_id =(isset($param['priority_status_id']))?$param['priority_status_id']:'';
		$priority_status_created_user_id =(isset($param['priority_status_created_user_id']))?$param['priority_status_created_user_id']:'';
		
		
		if($priority_status_id){
            $this->db->where('priority_status_id', $priority_status_id); 
        }
		if($priority_status_created_user_id){
            $this->db->where('priority_status_created_user_id', $priority_status_created_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('priority_status');
		$this->db->order_by('priority_status_id', 'DESC');
        $this->db->where("priority_status_created_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_priority_status_details()
	{
		$this->db->order_by("priority_status_id", "ASC");
		$this->db->where("priority_status_created_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("priority_status");
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
	
	public function checkpriority($priority_status_name)
    {
        // $status=1;
        $this->db->select('priority_status_name');
        $this->db->from('priority_status');  
        $this->db->where('priority_status_name', $priority_status_name);
        $this->db->where('priority_status_created_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEditpriorty($priority_status_name, $priority_status_id)
    {
        // $status=1;
        $this->db->select('priority_status_name');
        $this->db->from('priority_status');
        $this->db->where('priority_status_name', $priority_status_name);
        $this->db->where('priority_status_name !=', $priority_status_id);
        $this->db->where('priority_status_created_status', '1');
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
		$this->db->where("priority_status_created_status",1);
		$this->db->where('priority_status_id',$id);
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
		$this->db->where('priority_status_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>