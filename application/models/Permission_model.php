<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Permission_model extends CI_Model{
	var $table = 'tr_permissions';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getPermissionTable($param){
		$arOrder = array('','roles_name');
		$permission_status =(isset($param['permission_status']))?$param['permission_status']:'';
		$state_created_user_id =(isset($param['state_created_user_id']))?$param['state_created_user_id']:'';
		
		
		if($permission_status != NULL){
            $this->db->where('p.status', $permission_status); 
        }
		if($state_created_user_id){
            $this->db->where('state_created_user_id', $state_created_user_id); 
        }
        

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
		$this->db->from($this->table . ' p'); 
		$this->db->join('user_details u', 'u.user_id = p.created_by', 'left');
		$this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
                

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPermissionTotalCount($param);
        $data['recordsFiltered'] = $this->getPermissionTotalCount($param);
        return $data;

	}

	public function getPermissionTotalCount($param = NULL){

		$permission_status =(isset($param['permission_status']))?$param['permission_status']:'';
		$state_created_user_id =(isset($param['state_created_user_id']))?$param['state_created_user_id']:'';
		
		
		if($permission_status != NULL){
            $this->db->where('status', $permission_status); 
        }
		if($state_created_user_id){
            $this->db->where('state_created_user_id', $state_created_user_id); 
        }
		
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();
    	return $query->num_rows();
    }
	
	

	function getAllPermissions()
	{
		// $this->db->order_by("user_id", "ASC");
		$this->db->where("status",1);
		$query = $this->db->get($this->table);
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
		$this->db->where("status",1);
		$this->db->where('id',$id);
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