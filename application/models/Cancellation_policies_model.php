<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Cancellation_policies_model extends CI_Model{
	var $table = 'cancellation_policies';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getCancellationpoliciesTable($param){
		$arOrder = array('','roles_name');
		$cancellation_policies_id =(isset($param['cancellation_policies_id']))?$param['cancellation_policies_id']:'';
		$cancellation_policies_createdby_user_id =(isset($param['cancellation_policies_createdby_user_id']))?$param['cancellation_policies_createdby_user_id']:'';
		
		
		if($cancellation_policies_id){
            $this->db->where('cancellation_policies_id', $cancellation_policies_id); 
        }
        if($cancellation_policies_createdby_user_id){
            $this->db->where('cancellation_policies_createdby_user_id', $cancellation_policies_createdby_user_id); 
        }
        $this->db->where("cancellation_policies_status",1);

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
		$this->db->from('cancellation_policies');
		$this->db->join('cancellation_policies_item', 'cancellation_policies_item.cancellation_policies_id_fk = cancellation_policies.cancellation_policies_id','left');
		$this->db->order_by('cancellation_policies_id', 'DESC');
		$this->db->group_by('cancellation_policies_item.cancellation_policies_id_fk');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getCancellationpoliciesTotalCount($param);
        $data['recordsFiltered'] = $this->getCancellationpoliciesTotalCount($param);
        return $data;

	}

	public function getCancellationpoliciesTotalCount($param = NULL){

		$cancellation_policies_id =(isset($param['cancellation_policies_id']))?$param['cancellation_policies_id']:'';
		$cancellation_policies_createdby_user_id =(isset($param['cancellation_policies_createdby_user_id']))?$param['cancellation_policies_createdby_user_id']:'';
		
		
		if($cancellation_policies_id){
            $this->db->where('cancellation_policies_id', $cancellation_policies_id); 
        }
        if($cancellation_policies_createdby_user_id){
            $this->db->where('cancellation_policies_createdby_user_id', $cancellation_policies_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('cancellation_policies');
		$this->db->join('cancellation_policies_item', 'cancellation_policies_item.cancellation_policies_id_fk = cancellation_policies.cancellation_policies_id','left');
		$this->db->where("cancellation_policies_status",1);
		$this->db->order_by('cancellation_policies_id', 'DESC');
		$this->db->group_by('cancellation_policies_item.cancellation_policies_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	

    function fetch_cancellation_policies_items($cancellation_policies_id)
	{

		
		
		$this->db->select('*');
		$this->db->from('cancellation_policies_item');
		$this->db->where("cancellation_policies_item_status",1);
		$this->db->where("cancellation_policies_id_fk",$cancellation_policies_id);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_cancellation_policies()
	{
		$this->db->order_by("cancellation_policies_id", "ASC");
		$this->db->where("cancellation_policies_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("cancellation_policies");
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
		$this->db->where("cancellation_policies_status",1);
		$this->db->where('cancellation_policies_id',$id);
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
		$this->db->where('cancellation_policies_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>