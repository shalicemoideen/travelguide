<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Role_model extends CI_Model{
	var $table = 'tr_roles';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getRoleTable($param){
		$arOrder = array('','name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('name', $searchValue); 
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
		$this->db->where('status', 1); 
		$this->db->where('id !=', '1');
		$this->db->select('*');
		$this->db->from($this->table); 
		$this->db->order_by('created_at', 'DESC');
        $query = $this->db->get();
                

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getRoleTotalCount($param);
        $data['recordsFiltered'] = $this->getRoleTotalCount($param);
        return $data;

	}

	public function getRoleTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('name', $searchValue); 
        }
		
		
		$this->db->where('status', 1); 
		
		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where('id !=', '1');
		$this->db->order_by('created_at', 'DESC');
		$query = $this->db->get();
    	return $query->num_rows();
    }
	
	

	public function getAllPermissions()
	{
		// $this->db->order_by("user_id", "ASC");
		$this->db->where("status",1);
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_permission_tree()
	{
	    $result = $this->db->get('tr_permissions')->result();

	    $tree = [];

	    foreach ($result as $row) {
	        $tree[$row->module][$row->sub_module][] = $row;
	    }

	    return $tree;
	}

	public function get_role_permissions_by_roleid($id){
		$result = [];

		$this->db->select('*');
		$this->db->from($this->table);
		$this->db->where("id", $id);
		$query = $this->db->get();
		$result['role'] = $query->row();


		$this->db->select('p.name permission_name,p.id permission_id');
		$this->db->from('tr_role_permissions rp'); 
		$this->db->join('tr_permissions p', 'p.id = rp.permission_id', 'left');
		$this->db->where("rp.role_id", $id);
		$query = $this->db->get();
		
		$result['permissions'] = $query->result();
		return $result;

	}
	
	
	public function delete_permissions_by_role($role_id)
	{
	    $this->db->where('role_id', $role_id);
	    return $this->db->delete('tr_role_permissions');
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