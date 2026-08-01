<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_model extends CI_Model{
	var $table = 'user_details';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getStaffTable($param){
		$arOrder = array('','roles_name');
		$user_id_filter =(isset($param['user_id_filter']))?$param['user_id_filter']:'';
		$role_id_filter =(isset($param['role_id_filter']))?$param['role_id_filter']:'';
		$designation_id_filter =(isset($param['designation_id_filter']))?$param['designation_id_filter']:'';
		$user_phone_number_filter =(isset($param['user_phone_number_filter']))?$param['user_phone_number_filter']:'';
		
		
		
		if($user_id_filter){
            $this->db->where('user_id', $user_id_filter); 
        }
        if($role_id_filter){
            $this->db->where('role_id_fk', $role_id_filter); 
        }
        if($designation_id_filter){
            $this->db->like('designation_id_fk', $designation_id_filter); 
        }
        if($user_phone_number_filter){
            $this->db->where('user_phone_number', $user_phone_number_filter); 
        }
        
        $this->db->where("user_status",1);
        $this->db->where("user_type",'S');

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
		$this->db->select('*,tr_roles.name roles_name,DATE_FORMAT(user_date_of_joining,\'%d-%m-%Y\') as user_date_of_joining');
		$this->db->from('user_details');
		$this->db->join('tr_roles', 'tr_roles.id = user_details.role_id_fk','left');
		$this->db->join('designation', 'designation.designation_id = user_details.designation_id_fk','left');
		$this->db->order_by('user_id', 'DESC');
        $query = $this->db->get();

        $rows = $query->result();

        foreach ($rows as $row) {
            unset($row->password);
        }

        $data['data'] = $rows;
        $data['recordsTotal'] = $this->getStaffTotalCount($param);
        $data['recordsFiltered'] = $this->getStaffTotalCount($param);
        return $data;

	}

	public function getStaffTotalCount($param = NULL){

		$user_id_filter =(isset($param['user_id_filter']))?$param['user_id_filter']:'';
		$role_id_filter =(isset($param['role_id_filter']))?$param['role_id_filter']:'';
		$designation_id_filter =(isset($param['designation_id_filter']))?$param['designation_id_filter']:'';
		$user_phone_number_filter =(isset($param['user_phone_number_filter']))?$param['user_phone_number_filter']:'';
		
		
		
		if($user_id_filter){
            $this->db->where('user_id', $user_id_filter); 
        }
        if($role_id_filter){
            $this->db->where('role_id_fk', $role_id_filter); 
        }
        if($designation_id_filter){
            $this->db->like('designation_id_fk', $designation_id_filter); 
        }
        if($user_phone_number_filter){
            $this->db->where('user_phone_number', $user_phone_number_filter); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,tr_roles.name role_name,DATE_FORMAT(user_date_of_joining,\'%d-%m-%Y\') as user_date_of_joining');
		$this->db->from('user_details');
		$this->db->join('tr_roles', 'tr_roles.id = user_details.role_id_fk','left');
		$this->db->join('designation', 'designation.designation_id = user_details.designation_id_fk','left');
		$this->db->where("user_status",1);
        $this->db->where("user_type",'S');
        $this->db->order_by('user_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	

    

	function fetch_roles()
	{
		$this->db->order_by("id", "ASC");
		$this->db->where('id !=', '1');
		$this->db->where("status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("tr_roles");
		return $query->result();
	}

	function fetch_designation()
	{
		$this->db->order_by("designation_id", "ASC");
		$this->db->where("designation_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("designation");
		return $query->result();
	}


	function fetch_shift()
	{
		$this->db->order_by("shift_id", "ASC");
		$this->db->where("shift_status",1);
		// Pass the IDs as an array
    	$this->db->where_in("shift_id", array(1, 2)); 
		$query = $this->db->get("shift");
		return $query->result();
	}

	function fetch_languages()
	{
		$this->db->order_by("language_name", "ASC");
		$this->db->where("language_status",1);
		$query = $this->db->get("languages");
		return $query->result();
	}

	function fetch_staff_languages($user_id)
	{
		$this->db->select("language_id_fk");
		$this->db->where("user_id_fk", $user_id);
		$query = $this->db->get("staff_languages");
		return $query->result();
	}

	function save_staff_languages($user_id, $language_ids)
	{
		// Delete existing languages for this staff
		$this->db->where("user_id_fk", $user_id);
		$this->db->delete("staff_languages");

		// Insert new languages
		if (!empty($language_ids)) {
			foreach ($language_ids as $language_id) {
				// Skip empty values
				if (!empty($language_id) && $language_id != '') {
					$data = array(
						'user_id_fk' => $user_id,
						'language_id_fk' => $language_id
					);
					$this->db->insert("staff_languages", $data);
				}
			}
		}
	}
	
	function fetch_staff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		$this->db->where("user_type",'S');
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
		$this->db->where("user_status",1);
		$this->db->where('user_id',$id);
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
		$this->db->where('user_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>