<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Package_category_model extends CI_Model{
	var $table = 'package_category';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getPackagecategoryTable($param){
		$arOrder = array('','package_category_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('package_category_name', $searchValue); 
        }
        $this->db->where("package_category_status",1);

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
		$this->db->from('package_category');
		$this->db->order_by('package_category_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPackagecategoryTotalCount($param);
        $data['recordsFiltered'] = $this->getPackagecategoryTotalCount($param);
        return $data;

	}

	public function getPackagecategoryTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('package_category_name', $searchValue); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('package_category');
		$this->db->order_by('package_category_id', 'DESC');
		$this->db->where("package_category_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_package_category_details()
	{
		$this->db->order_by("package_category_id", "ASC");
		$this->db->where("package_category_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("package_category");
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
	
	public function checkpackage_category($package_category_name)
    {
        // $status=1;
        $this->db->select('package_category_name');
        $this->db->from('package_category');  
        $this->db->where('package_category_name', $package_category_name);
        $this->db->where('package_category_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEditpackage_category($package_category_name, $package_category_id)
    {
        // $status=1;
        $this->db->select('package_category_name');
        $this->db->from('package_category');
        $this->db->where('package_category_name', $package_category_name);
        $this->db->where('package_category_id !=', $package_category_id);
        $this->db->where('package_category_status', '1');
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
		$this->db->where("package_category_status",1);
		$this->db->where('package_category_id',$id);
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
		$this->db->where('package_category_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>