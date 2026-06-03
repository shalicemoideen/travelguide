<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Inclusions_exclusions_model extends CI_Model{
	var $table = 'inclusion_exclusion_common';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getInclusions_exclusionsTable($param){
		$arOrder = array('','roles_name');
		$inclusion_exclusion_common_id =(isset($param['inclusion_exclusion_common_id']))?$param['inclusion_exclusion_common_id']:'';
		$inclusion_exclusion_common_createdby_user_id =(isset($param['inclusion_exclusion_common_createdby_user_id']))?$param['inclusion_exclusion_common_createdby_user_id']:'';

		if (!empty($param['inclusion_exclusion_common_title'])) {
		    $this->db->like(
		        'inclusion_exclusion_common.inclusion_exclusion_common_title',
		        $param['inclusion_exclusion_common_title']
		    );
		}

		
		if($inclusion_exclusion_common_id){
            $this->db->where('inclusion_exclusion_common_id', $inclusion_exclusion_common_id); 
        }
		if($inclusion_exclusion_common_createdby_user_id){
            $this->db->where('inclusion_exclusion_common_createdby_user_id', $inclusion_exclusion_common_createdby_user_id); 
        }
        $this->db->where("inclusion_exclusion_common_status",1);

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
		$this->db->from('inclusion_exclusion_common');
		$this->db->join('user_details u', 'u.user_id = inclusion_exclusion_common.inclusion_exclusion_common_createdby_user_id', 'left');
		$this->db->order_by('inclusion_exclusion_common_id', 'DESC');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getInclusions_exclusionsTotalCount($param);
        $data['recordsFiltered'] = $this->getInclusions_exclusionsTotalCount($param);
        return $data;

	}

	public function getInclusions_exclusionsTotalCount($param = NULL){

		$inclusion_exclusion_common_id =(isset($param['inclusion_exclusion_common_id']))?$param['inclusion_exclusion_common_id']:'';
		$inclusion_exclusion_common_createdby_user_id =(isset($param['inclusion_exclusion_common_createdby_user_id']))?$param['inclusion_exclusion_common_createdby_user_id']:'';
		
		
		if($inclusion_exclusion_common_id){
            $this->db->where('inclusion_exclusion_common_id', $inclusion_exclusion_common_id); 
        }
		if($inclusion_exclusion_common_createdby_user_id){
            $this->db->where('inclusion_exclusion_common_createdby_user_id', $inclusion_exclusion_common_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('inclusion_exclusion_common');
		$this->db->join('user_details u', 'u.user_id = inclusion_exclusion_common.inclusion_exclusion_common_createdby_user_id', 'left');
		$this->db->order_by('inclusion_exclusion_common_id', 'DESC');
		$this->db->where("inclusion_exclusion_common_status",1);
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_inclusion_exclusion()
	{
		$this->db->order_by("inclusion_exclusion_common_id", "ASC");
		$this->db->where("inclusion_exclusion_common_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("inclusion_exclusion_common");
		return $query->result();
	}

	function fetch_inclusion_items($inclusion_exclusion_common_id)
	{

		
		
		$this->db->select('*');
		$this->db->from('inclusions');
		$this->db->where("inclusions_status",1);
		$this->db->where("inclusion_exclusion_common_id_fk1",$inclusion_exclusion_common_id);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_exclusion_items($inclusion_exclusion_common_id)
	{

		
		
		$this->db->select('*');
		$this->db->from('exclusions');
		$this->db->where("exclusions_status",1);
		$this->db->where("inclusion_exclusion_common_id_fk2",$inclusion_exclusion_common_id);
		$query = $this->db->get();
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
	

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where("inclusion_exclusion_common_status",1);
		$this->db->where('inclusion_exclusion_common_id',$id);
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
		$this->db->where('inclusion_exclusion_common_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>