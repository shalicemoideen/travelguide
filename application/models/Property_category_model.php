<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Property_category_model extends CI_Model{
	var $table = 'property_category';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getPropertycategoryTable($param){
		$arOrder = array('','property_category_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('property_category_name', $searchValue); 
        }
        $this->db->where("property_category_status",1);

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
		$this->db->from('property_category');
		$this->db->order_by('property_category_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPropertycategoryTotalCount($param);
        $data['recordsFiltered'] = $this->getPropertycategoryTotalCount($param);
        return $data;

	}

	public function getPropertycategoryTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('property_category_name', $searchValue); 
        }		
		
		
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('property_category');
		$this->db->order_by('property_category_id', 'DESC');
		$this->db->where("property_category_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_property_category_details()
	{
		$this->db->order_by("property_category_id", "ASC");
		$this->db->where("property_category_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("property_category");
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
	
	public function checkproperty_category($property_category_name)
    {
        // $status=1;
        $this->db->select('property_category_name');
        $this->db->from('property_category');  
        $this->db->where('property_category_name', $property_category_name);
        $this->db->where('property_category_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEditproperty_category($property_category_name, $property_category_id)
    {
        // $status=1;
        $this->db->select('property_category_name');
        $this->db->from('property_category');
        $this->db->where('property_category_name', $property_category_name);
        $this->db->where('property_category_id !=', $property_category_id);
        $this->db->where('property_category_status', '1');
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
		$this->db->where("property_category_status",1);
		$this->db->where('property_category_id',$id);
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
		$this->db->where('property_category_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>