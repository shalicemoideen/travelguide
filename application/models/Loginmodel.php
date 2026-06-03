<?php
class Loginmodel extends CI_Model{
    public function checkUserLogin($data){
        $this->db->where($data);
        
        $query = $this->db->get('user_details');
//                                                             
        if($query->num_rows() == 1){
            $this->session->set_userdata($query->row_array());
            return true;
        }
        else{
            return false;
        }
    }
	
	public function Validation_login()
    {
        $status=1;
        $this->db->select('user_name');
        $this->db->from('user_details');
        // $this->db->where('user_id', $user_id);
        $this->db->where('user_status', $status);
        $query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
        return $query->num_rows();
    }
	
	public function checkUsername(  $user_name)
    {
        $status=1;
        $this->db->select('user_name');
        $this->db->from('user_details');
        $this->db->where('user_name', $user_name);
        $this->db->where('user_status', $status);
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	public function checkPassword($password)
    {
        $status=1;
        $this->db->select('password');
        $this->db->from('user_details');
        $this->db->where('password', $password);
        $this->db->where('user_status', $status);
        $query = $this->db->get();
        return $query->num_rows();
    }
	
	public function get_User_details()
    {	
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		
        $this->db->select('*');
		$this->db->from('user_details');
		$this->db->where("user_id",$currentuserid);
		$query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
    }
	
	public function get_row($currentuserid)
    {
        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$this->db->select('*');
		$this->db->from('user_details');
		$this->db->where('user_id', $currentuserid);
		$query = $this->db->get();
        if($query->num_rows() > 0)
        {
            return $query->row();
        }
        return false;
    }
	
	public function checkUsernames($user_name)
    {
       
        $this->db->select('user_name');
        $this->db->from('user_details');
        $this->db->where('user_name', $user_name);
        $this->db->where('user_status', '1');
        $query = $this->db->get();
		// echo $this->db->last_query();
        return $query->num_rows();
    }
	
	public function checkEditUsername($user_name,$user_id)
    {
        $this->db->select('user_name');
        $this->db->from('user_details');
        $this->db->where('user_name', $user_name);
        $this->db->where('user_id !=', $user_id);
        $this->db->where('user_status', '1');
        $query = $this->db->get();
		
        return $query->num_rows();
    }

    public function get_user_permissions($role_id)
    {
        $this->db->select('p.name');
        $this->db->from('tr_permissions p');
        $this->db->join('tr_role_permissions rp', 'rp.permission_id = p.id');
        $this->db->where('rp.role_id', $role_id);

        $result = $this->db->get()->result_array();

        return array_column($result, 'name');
    }
}
?>
