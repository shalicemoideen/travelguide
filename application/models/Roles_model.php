<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Roles_model extends CI_Model{
	var $table = 'roles';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getRolesTable($param){
		$arOrder = array('','roles_name');
		$roles_id =(isset($param['roles_id']))?$param['roles_id']:'';
		// $company_user_id_fk_role =(isset($param['company_user_id_fk_role']))?$param['company_user_id_fk_role']:'';
		$roles_created_by_userid =(isset($param['roles_created_by_userid']))?$param['roles_created_by_userid']:'';
		
		
		if($roles_id){
            $this->db->where('roles_id', $roles_id); 
        }
        // if($company_user_id_fk_role){
        //     $this->db->where('company_user_id_fk_role', $company_user_id_fk_role); 
        // }
		if($roles_created_by_userid){
            $this->db->where('roles_created_by_userid', $roles_created_by_userid); 
        }
        $this->db->where("roles_status",1);

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
		$this->db->select('*,n1.admin_name as plname');
		$this->db->from('roles');
		//$this->db->join('user_details','user_details.user_id = roles.roles_created_by_userid');
		$this->db->join('user_details n1', 'n1.user_id = roles.roles_created_by_userid');
        // $this->db->join('user_details n2', 'n2.user_id = roles.company_user_id_fk_role');
		$this->db->order_by('roles_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getRolesTotalCount($param);
        $data['recordsFiltered'] = $this->getRolesTotalCount($param);
        return $data;

	}

	public function getRolesTotalCount($param = NULL){

		$roles_id =(isset($param['roles_id']))?$param['roles_id']:'';
		// $company_user_id_fk_role =(isset($param['company_user_id_fk_role']))?$param['company_user_id_fk_role']:'';
		$roles_created_by_userid =(isset($param['roles_created_by_userid']))?$param['roles_created_by_userid']:'';
		
		
		if($roles_id){
            $this->db->where('roles_id', $roles_id); 
        }
        // if($company_user_id_fk_role){
        //     $this->db->where('company_user_id_fk_role', $company_user_id_fk_role); 
        // }
		if($roles_created_by_userid){
            $this->db->where('roles_created_by_userid', $roles_created_by_userid); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,n1.admin_name as plname, n2.admin_name as rcname');
		$this->db->from('roles');
		//$this->db->join('user_details','user_details.user_id = roles.roles_created_by_userid');
		$this->db->join('user_details n1', 'n1.user_id = roles.roles_created_by_userid');
        // $this->db->join('user_details n2', 'n2.user_id = roles.company_user_id_fk_role');
		$this->db->where("roles_status",1);
		$this->db->order_by('roles_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	public function Roledetails_row($roles_id)
    {

        $status=1;

        $this->db->select('*');

        $this->db->from('roles');
		
		$this->db->join('roles_privilege', 'roles_privilege.roles_id_fk = roles.roles_id');
		
        $this->db->where('roles_id', $roles_id);

        $this->db->where('roles_status', $status);

        $query = $this->db->get();

        return $query->row();

    }
	function fetch_staff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}
	
	function fetch_role_details()
	{
		$this->db->order_by("roles_id", "ASC");
		$this->db->where("roles_status",1);
		$query = $this->db->get("roles");
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
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where('roles_id',$id);
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
		$this->db->where('roles_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>