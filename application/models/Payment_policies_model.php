<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Payment_policies_model extends CI_Model{
	var $table = 'payment_policies';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getPaymentpoliciesTable($param){
		$arOrder = array('','roles_name');
		$payment_policies_id =(isset($param['payment_policies_id']))?$param['payment_policies_id']:'';
		$payment_policies_createdby_user_id =(isset($param['payment_policies_createdby_user_id']))?$param['payment_policies_createdby_user_id']:'';
		
		
		if($payment_policies_id){
            $this->db->where('payment_policies_id', $payment_policies_id); 
        }
        if($payment_policies_createdby_user_id){
            $this->db->where('payment_policies_createdby_user_id', $payment_policies_createdby_user_id); 
        }

        if (!empty($param['payment_policies_name'])) {
		    $this->db->like(
		        'payment_policies.payment_policies_name',
		        $param['payment_policies_name']
		    );
		}
        $this->db->where("payment_policies_status",1);

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
		$this->db->from('payment_policies');
		$this->db->join('payment_policies_items', 'payment_policies_items.payment_policies_id_fk = payment_policies.payment_policies_id','left');
		$this->db->join('user_details u', 'u.user_id = payment_policies.payment_policies_createdby_user_id', 'left');
		$this->db->order_by('payment_policies_id', 'DESC');
		$this->db->group_by('payment_policies_items.payment_policies_id_fk');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPaymentpoliciesTotalCount($param);
        $data['recordsFiltered'] = $this->getPaymentpoliciesTotalCount($param);
        return $data;

	}

	public function getPaymentpoliciesTotalCount($param = NULL){

		$payment_policies_id =(isset($param['payment_policies_id']))?$param['payment_policies_id']:'';
		$payment_policies_createdby_user_id =(isset($param['payment_policies_createdby_user_id']))?$param['payment_policies_createdby_user_id']:'';
		
		
		if($payment_policies_id){
            $this->db->where('payment_policies_id', $payment_policies_id); 
        }
        if($payment_policies_createdby_user_id){
            $this->db->where('payment_policies_createdby_user_id', $payment_policies_createdby_user_id); 
        }
        if (!empty($param['payment_policies_name'])) {
		    $this->db->like(
		        'payment_policies.payment_policies_name',
		        $param['payment_policies_name']
		    );
		}
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('payment_policies');
		$this->db->join('payment_policies_items', 'payment_policies_items.payment_policies_id_fk = payment_policies.payment_policies_id','left');
		$this->db->join('user_details u', 'u.user_id = payment_policies.payment_policies_createdby_user_id', 'left');
		$this->db->where("payment_policies_status",1);
		$this->db->order_by('payment_policies_id', 'DESC');
		$this->db->group_by('payment_policies_items.payment_policies_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	

    function fetch_payment_policies_items($payment_policies_id)
	{

		
		
		$this->db->select('*');
		$this->db->from('payment_policies_items');
		$this->db->where("payment_policies_items_status",1);
		$this->db->where("payment_policies_id_fk",$payment_policies_id);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_payment_policies()
	{
		$this->db->order_by("payment_policies_id", "ASC");
		$this->db->where("payment_policies_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("payment_policies");
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
		$this->db->where("payment_policies_status",1);
		$this->db->where('payment_policies_id',$id);
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
		$this->db->where('payment_policies_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>