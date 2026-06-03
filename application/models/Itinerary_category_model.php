<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Itinerary_category_model extends CI_Model{
	var $table = 'itinerary_category';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getItinerarycategoryTable($param){
		$arOrder = array('','roles_name');
		$itinerary_category_id =(isset($param['itinerary_category_id']))?$param['itinerary_category_id']:'';
		$itinerary_category_createdby_user_id =(isset($param['itinerary_category_createdby_user_id']))?$param['itinerary_category_createdby_user_id']:'';
		
		
		if($itinerary_category_id){
            $this->db->where('itinerary_category_id', $itinerary_category_id); 
        }
		if($itinerary_category_createdby_user_id){
            $this->db->where('itinerary_category_createdby_user_id', $itinerary_category_createdby_user_id); 
        }
        $this->db->where("itinerary_category_status",1);

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
		$this->db->from('itinerary_category');
		$this->db->order_by('itinerary_category_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getItinerarycategoryTotalCount($param);
        $data['recordsFiltered'] = $this->getItinerarycategoryTotalCount($param);
        return $data;

	}

	public function getItinerarycategoryTotalCount($param = NULL){

		$itinerary_category_id =(isset($param['itinerary_category_id']))?$param['itinerary_category_id']:'';
		$itinerary_category_createdby_user_id =(isset($param['itinerary_category_createdby_user_id']))?$param['itinerary_category_createdby_user_id']:'';
		
		
		if($itinerary_category_id){
            $this->db->where('itinerary_category_id', $itinerary_category_id); 
        }
		if($itinerary_category_createdby_user_id){
            $this->db->where('itinerary_category_createdby_user_id', $itinerary_category_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('itinerary_category');
		$this->db->order_by('itinerary_category_id', 'DESC');
		$this->db->where("itinerary_category_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_itinerary_category_details()
	{
		$this->db->order_by("itinerary_category_id", "ASC");
		$this->db->where("itinerary_category_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("itinerary_category");
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
	
	public function checkitinerary_category($itinerary_category_name)
    {
        // $status=1;
        $this->db->select('itinerary_category_name');
        $this->db->from('itinerary_category');  
        $this->db->where('itinerary_category_name', $itinerary_category_name);
        $this->db->where('itinerary_category_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
    public function checkEdititinerary_category($itinerary_category_name, $itinerary_category_id)
    {
        // $status=1;
        $this->db->select('itinerary_category_name');
        $this->db->from('itinerary_category');
        $this->db->where('itinerary_category_name', $itinerary_category_name);
        $this->db->where('itinerary_category_id !=', $itinerary_category_id);
        $this->db->where('itinerary_category_status', '1');
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
		$this->db->where("itinerary_category_status",1);
		$this->db->where('itinerary_category_id',$id);
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
		$this->db->where('itinerary_category_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>