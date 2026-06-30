<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Account_details_model extends CI_Model{
	var $table = 'account_details';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getAccountDetailsTable($param){
		$arOrder = array('','account_name');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('account_name', $searchValue); 
        }
        $this->db->where("account_details_status",1);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		
		$this->db->select('*');
		$this->db->from('account_details');
		$this->db->order_by('account_details_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getAccountDetailsTotalCount($param);
        $data['recordsFiltered'] = $this->getAccountDetailsTotalCount($param);
        return $data;

	}

	public function getAccountDetailsTotalCount($param = NULL){

		$searchValue =($param['searchValue'])?$param['searchValue']:'';
        if($searchValue){
            $this->db->like('account_name', $searchValue); 
        }
		
		$this->db->select('*');
		$this->db->from('account_details');
		$this->db->order_by('account_details_id', 'DESC');
		$this->db->where("account_details_status",1);
        $query = $this->db->get();
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
		$this->db->where("account_details_status",1);
		$this->db->where('account_details_id',$id);
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
		$this->db->where('account_details_id', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>
