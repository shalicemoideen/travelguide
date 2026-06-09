<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class B2b_partner_model extends CI_Model{
	var $table = 'b2b_partner';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getB2bpartnerTable($param){
		$arOrder = array('','b2b_partner_agent_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('b2b_partner_agent_name', $searchValue); 
        }		
		
		
        $this->db->where("b2b_partner_status",1);

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
		$this->db->from('b2b_partner');
		$this->db->join('country', 'b2b_partner.b2b_partner_country_id_fk = country.id','left');
		$this->db->join('state', 'b2b_partner.b2b_partner_location_id_fk = state.state_id','left');
		$this->db->order_by('b2b_partner_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getB2bpartnerTotalCount($param);
        $data['recordsFiltered'] = $this->getB2bpartnerTotalCount($param);
        return $data;

	}

	public function getB2bpartnerTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('b2b_partner_agent_name', $searchValue); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('b2b_partner');
		$this->db->join('country', 'b2b_partner.b2b_partner_country_id_fk = country.id','left');
		$this->db->join('state', 'b2b_partner.b2b_partner_location_id_fk = state.state_id','left');
		$this->db->order_by('b2b_partner_id', 'DESC');
		$this->db->where("b2b_partner_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_b2b_partner_details()
	{
		$this->db->order_by("b2b_partner_id", "ASC");
		$this->db->where("b2b_partner_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("b2b_partner");
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
	

	function fetch_country()
	{
		$this->db->order_by("id", "ASC");
		$query = $this->db->get("country");
		return $query->result();
	}
	
	function fetch_state()
	{
		$this->db->order_by("state_id", "ASC");
		 $this->db->where("state_status",1);
		$query = $this->db->get("state");
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
		$this->db->where("b2b_partner_status",1);
		$this->db->where('b2b_partner_id',$id);
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
		$this->db->where('b2b_partner_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>