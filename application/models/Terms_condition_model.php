<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Terms_condition_model extends CI_Model{
	var $table = 'terms_condition';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getTermsconditionTable($param){
		$arOrder = array('','roles_name');

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('terms_condition_name', $searchValue); 
        }
        $this->db->where("terms_condition_status",1);

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
		$this->db->from('terms_condition');
		$this->db->join('terms_condition_items', 'terms_condition_items.terms_condition_id_fk = terms_condition.terms_condition_id','left');
		$this->db->join('user_details u', 'u.user_id = terms_condition.terms_condition_createdby_user_id', 'left');
		$this->db->order_by('terms_condition_id', 'DESC');
		$this->db->group_by('terms_condition_items.terms_condition_id_fk');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getTermsconditionTotalCount($param);
        $data['recordsFiltered'] = $this->getTermsconditionTotalCount($param);
        return $data;

	}

	public function getTermsconditionTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('terms_condition_name', $searchValue); 
		}
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('terms_condition');
		$this->db->join('terms_condition_items', 'terms_condition_items.terms_condition_id_fk = terms_condition.terms_condition_id','left');
		$this->db->join('user_details u', 'u.user_id = terms_condition.terms_condition_createdby_user_id', 'left');
		$this->db->order_by('terms_condition_id', 'DESC');
		$this->db->where("terms_condition_status",1);
		$this->db->group_by('terms_condition_items.terms_condition_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	

    function fetch_terms_condition_items($terms_condition_id)
	{

		
		
		$this->db->select('*');
		$this->db->from('terms_condition_items');
		$this->db->where("terms_condition_items_status",1);
		$this->db->where("terms_condition_id_fk",$terms_condition_id);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_terms_condition()
	{
		$this->db->order_by("terms_condition_id", "ASC");
		$this->db->where("terms_condition_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("terms_condition");
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
	

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where("terms_condition_status",1);
		$this->db->where('terms_condition_id',$id);
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
		$this->db->where('terms_condition_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>