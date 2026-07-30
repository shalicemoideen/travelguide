<?php
class Loginmodel extends CI_Model{
    public function checkUserLogin($data){
        $user_name = isset($data['user_name']) ? $data['user_name'] : '';
        $input_password = isset($data['password']) ? $data['password'] : '';

        // Load the active user by username only. Never compare the password in SQL.
        $this->db->where('user_name', $user_name);
        $this->db->where('user_status', 1);
        $query = $this->db->get('user_details');

        if($query->num_rows() != 1){
            return false;
        }

        $user = $query->row_array();
        $stored_password = isset($user['password']) ? (string) $user['password'] : '';

        $authenticated = false;
        $needs_rehash  = false;

        $hash_info = password_get_info($stored_password);
        if(!empty($hash_info['algo'])){
            // Stored value is already a secure hash.
            if(password_verify($input_password, $stored_password)){
                $authenticated = true;
                if(password_needs_rehash($stored_password, PASSWORD_DEFAULT)){
                    $needs_rehash = true;
                }
            }
        }
        else{
            // Legacy plain-text password: verify then transparently upgrade to a hash.
            if(hash_equals($stored_password, (string) $input_password)){
                $authenticated = true;
                $needs_rehash  = true;
            }
        }

        if(!$authenticated){
            return false;
        }

        // Rehash on first successful login (self-healing migration to hashed storage).
        if($needs_rehash){
            $new_hash = password_hash($input_password, PASSWORD_DEFAULT);
            $this->db->where('user_id', $user['user_id']);
            $this->db->update('user_details', array('password' => $new_hash));
            $user['password'] = $new_hash;
        }

        // Never keep the password hash in the session.
        unset($user['password']);
        $this->session->set_userdata($user);
        return true;
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
        // Passwords are stored hashed and must never be matched in SQL.
        // This client-side pre-check now only verifies a password was entered;
        // actual credential verification happens in checkUserLogin().
        return (trim((string) $password) !== '') ? 1 : 0;
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
