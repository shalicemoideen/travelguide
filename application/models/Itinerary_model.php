<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Itinerary_model extends CI_Model{
	var $table = 'itineraries';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getItinerarypoliciesTable($param){
		$arOrder = array('','roles_name');
		$itineraries_id_filter =(isset($param['itineraries_id_filter']))?$param['itineraries_id_filter']:'';
		$itineraries_category_id_filter =(isset($param['itineraries_category_id_filter']))?$param['itineraries_category_id_filter']:'';
		$itineraries_duration_nights_filter =(isset($param['itineraries_duration_nights_filter']))?$param['itineraries_duration_nights_filter']:'';
		$itineraries_days_destination_id_fk_filter =(isset($param['itineraries_days_destination_id_fk_filter']))?$param['itineraries_days_destination_id_fk_filter']:'';
		$itineraries_createdby_user_id =(isset($param['itineraries_createdby_user_id']))?$param['itineraries_createdby_user_id']:'';
		
		
		if($itineraries_id_filter){
            $this->db->where('itineraries_id', $itineraries_id_filter); 
        }
        if($itineraries_category_id_filter){
            $this->db->where('itinerary_category_id', $itineraries_category_id_filter); 
        }
        if($itineraries_duration_nights_filter){
            $this->db->like('itineraries_duration_nights', $itineraries_duration_nights_filter); 
        }
        if($itineraries_days_destination_id_fk_filter){
            $this->db->where('itineraries_days_destination_id_fk', $itineraries_days_destination_id_fk_filter); 
        }
        if($itineraries_createdby_user_id){
            $this->db->where('itineraries_createdby_user_id', $itineraries_createdby_user_id); 
        }
        $this->db->where("itineraries_status",1);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("itineraries_createdby_user_id",$currentuserid);
			}
		$this->db->select('*');
		$this->db->from('itineraries');
		$this->db->join('itineraries_days', 'itineraries_days.itineraries_id_fk = itineraries.itineraries_id','left');
		$this->db->join('itinerary_category', 'itinerary_category.itinerary_category_id = itineraries.itineraries_category_id_fk','left');
		$this->db->join('user_details', 'user_details.user_id = itineraries.itineraries_createdby_user_id','left');
		$this->db->order_by('itineraries_id', 'DESC');
		$this->db->group_by('itineraries_days.itineraries_id_fk');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getItineraryTotalCount($param);
        $data['recordsFiltered'] = $this->getItineraryTotalCount($param);
        return $data;

	}

	public function getItineraryTotalCount($param = NULL){

		$itineraries_id_filter =(isset($param['itineraries_id_filter']))?$param['itineraries_id_filter']:'';
		$itineraries_category_id_filter =(isset($param['itineraries_category_id_filter']))?$param['itineraries_category_id_filter']:'';
		$itineraries_duration_nights_filter =(isset($param['itineraries_duration_nights_filter']))?$param['itineraries_duration_nights_filter']:'';
		$itineraries_days_destination_id_fk_filter =(isset($param['itineraries_days_destination_id_fk_filter']))?$param['itineraries_days_destination_id_fk_filter']:'';
		$itineraries_createdby_user_id =(isset($param['itineraries_createdby_user_id']))?$param['itineraries_createdby_user_id']:'';
		
		
		if($itineraries_id_filter){
            $this->db->where('itineraries_id', $itineraries_id_filter); 
        }
        if($itineraries_category_id_filter){
            $this->db->where('itinerary_category_id', $itineraries_category_id_filter); 
        }
        if($itineraries_duration_nights_filter){
            $this->db->like('itineraries_duration_nights', $itineraries_duration_nights_filter); 
        }
        if($itineraries_days_destination_id_fk_filter){
            $this->db->where('itineraries_days_destination_id_fk', $itineraries_days_destination_id_fk_filter); 
        }
        if($itineraries_createdby_user_id){
            $this->db->where('itineraries_createdby_user_id', $itineraries_createdby_user_id); 
        } 
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("itineraries_createdby_user_id",$currentuserid);
			}
		$this->db->select('*');
		$this->db->from('itineraries');
		$this->db->join('itineraries_days', 'itineraries_days.itineraries_id_fk = itineraries.itineraries_id','left');
		$this->db->join('itinerary_category', 'itinerary_category.itinerary_category_id = itineraries.itineraries_category_id_fk','left');
		$this->db->join('user_details', 'user_details.user_id = itineraries.itineraries_createdby_user_id','left');
		$this->db->where("itineraries_status",1);
		$this->db->order_by('itineraries_id', 'DESC');
		$this->db->group_by('itineraries_days.itineraries_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	

    function fetch_itineraries_days($itineraries_id)
	{

		
		
		$this->db->select('*');
		$this->db->from('itineraries_days');
		$this->db->where("itineraries_days_status",1);
		$this->db->where("itineraries_id_fk",$itineraries_id);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_itineraries()
	{
		$this->db->order_by("itineraries_id", "ASC");
		$this->db->where("itineraries_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("itineraries");
		return $query->result();
	}

	function fetch_itinerary_category()
	{
		$this->db->order_by("itinerary_category_id", "ASC");
		$this->db->where("itinerary_category_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("itinerary_category");
		return $query->result();
	}

	function fetch_destination()
	{
		$this->db->order_by("state_id", "ASC");
		$this->db->where("state_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("state");
		return $query->result();
	}
	// function get_destination(){
	

	// $this->db->select('state_id,state_name');
    // $this->db->where('state_status', 1);

	// $query = $this->db->get('state');
	// // echo $this->db->last_query();die;
	// $state_name = array();
	// if($query->result()){
	// 	foreach ($query->result() as $state_names) {
	// 		$state_name[$state_names->state_id] = $state_names->state_name;
	// 	}
	// 	return $state_name;
	// 	}
	// else{
	// 		return FALSE;
    //      }
	// }

	public function get_destination()
{
    return $this->db
        ->select('state_id as id, state_name as name')
        ->where('state_status', 1)
        ->order_by('state_name', 'ASC')
        ->get('state')
        ->result_array();   // [ {id:1,name:"Dubai"}, ... ]
}


	function fetch_staff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
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
		$this->db->where("itineraries_status",1);
		$this->db->where('itineraries_id',$id);
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
		$this->db->where('itineraries_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>