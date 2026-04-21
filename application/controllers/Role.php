<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Role extends MY_Controller {
    public $table = 'tr_roles';
    public $activity = 'activity';
    public $page  = 'Roles';
    public function __construct() {
        parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
        
        
        $this->load->model('General_model');
        $this->load->model('Role_model');
        $this->load->model('Permission_model');
        
    }
    
    
    public function index()
    {
        $template['permissions'] = $this->Role_model->get_permission_tree();
        $template['body'] = 'Role/list';
        $template['script'] = 'Role/script';
        $this->load->view('template', $template);
    }

    public function get(){
        $this->load->model('Role_model');
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
        // $param['permission_status'] =(isset($_REQUEST['permission_status']))?$_REQUEST['permission_status']:'';
        
        // $param['state_created_user_id'] =(isset($_REQUEST['state_created_user_id']))?$_REQUEST['state_created_user_id']:'';

        
        $data = $this->Role_model->getRoleTable($param);
        $json_data = json_encode($data);
        echo $json_data;
    }

    public function ajax_add()
    {
        $this->_validate();
        
        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }
        $date = date('Y-m-d');
        $time = date('h:i:sa');
        
        $date1 = date('Y-m-d h:i:s a', time());
        
        $role_name = $this->input->post('role_name');
        $permissions = $this->input->post('permissions_name[]');

        
        $currentuserid = $this->session->userdata('user_id');
        $currentusername = $this->session->userdata('admin_name');
        
        $data = array(

                'name' => $this->input->post('role_name'),
                'description' => $this->input->post('role_description'), 
                'created_by' => $currentuserid,          
                'created_at' => $date1
            );
        $insert = $this->Role_model->save($data);

        foreach($permissions as $permission){
            $role_permission_data= array(
                'role_id' => $insert,
                'permission_id' => $permission,
                'assigned_by' => $currentuserid,
                'updated_at' => $date1
            );
            $this->General_model->add('tr_role_permissions',$role_permission_data);
        }

        $ip = $this->input->ip_address();
        
        // echo $ip;

        $activity_data = array(
                'activity_description' => 'Added Role: '.$role_name.'',
                'id_fk' => $insert,
                'activity_type' => 'Role_registration',
                'activity_ip' => $ip,
                'activity_action' => 'Add',
                'activity_by_userid' => $currentuserid,
                'activity_by_username' => $currentusername,
                'activity_date_time ' => $date1,
                'activity_date' => $date,               
                'activity_status' => 1,
            );
        
        $this->General_model->add($this->activity,$activity_data);
        
        echo json_encode(array("status" => TRUE));
    }

    public function ajax_edit($id)
    {
        $data = $this->Role_model->get_role_permissions_by_roleid($id);
        echo json_encode($data);
    }

    public function ajax_update()
    {
        $this->_validate();
        
        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }
        $date = date('Y-m-d');
        $time = date('h:i:sa');
        
        $date1 = date('Y-m-d h:i:s a', time());
        
        $currentuserid = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        $currentusername = $this->session->userdata('admin_name');
        
        $role_name = $this->input->post('role_name');
        
        
        $ip = $this->input->ip_address();
        $role_id = $this->input->post('id');
        // echo $ip;

        $activity_data = array(
                'activity_description' => 'Updated Role: '.$role_name.'',
                'id_fk' => $role_id,
                'activity_type' => 'Permission_registration',
                'activity_ip' => $ip,
                'activity_action' => 'Edit',
                'activity_by_userid' => $currentuserid,
                'activity_by_username' => $currentusername,
                'activity_date_time ' => $date1,    
                'activity_date' => $date,           
                'activity_status' => 1,
            );
        
        $this->General_model->add($this->activity,$activity_data);
        
        $data = array(
                
                'name' => $this->input->post('role_name'),
                'description' => $this->input->post('role_description'), 
                'updated_by' => $currentuserid,           
                'updated_at' => $date1,           
            );

        $this->Role_model->update(array('id' => $this->input->post('id')), $data);

        $permissions = $this->input->post('permissions_name[]');

        // Step 1: Delete old        
        $this->Role_model->delete_permissions_by_role($role_id);

        // Step 2: Insert new
        foreach($permissions as $permission){
            $role_permission_data= array(
                'role_id' => $role_id,
                'permission_id' => $permission,
                'assigned_by' => $currentuserid,
                'updated_at' => $date1
            );
            $this->General_model->add('tr_role_permissions',$role_permission_data);
        }

        echo json_encode(array("status" => TRUE));
    }

    

    public function delete()
    {
        $currentuserid = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        $currentusername = $this->session->userdata('admin_name');

        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }
        $date = date('Y-m-d');
        $time = date('h:i:sa');
        
        $date1 = date('Y-m-d h:i:s a', time());

        $updateData = array('status' => 0);
        
        $this->Role_model->update(array('id' => $this->input->post('role_id_delete')), $updateData);

        $this->Role_model->delete_permissions_by_role($this->input->post('role_id_delete'));

        $role_name = $this->input->post('role_name_delete');
        $ip = $this->input->ip_address();
        
        $activity_data = array(
                'activity_description' => 'Deleted Role: '.$role_name.'',
                'id_fk' => $this->input->post('role_id_delete'),
                'activity_type' => 'Role_registration',
                // 'activity_order_number' => $invoice_order_number1,
                'activity_ip' => $ip,
                'activity_action' => 'Delete',
                'activity_by_userid' => $currentuserid,
                'activity_by_username' => $currentusername,
                'activity_date_time ' => $date1,
                'activity_date' => $date,
                'activity_status' => 1,
            );
        
        $this->General_model->add($this->activity,$activity_data);
        echo json_encode(array("status" => TRUE));
    }

    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('role_name') == '')
        {
            $data['inputerror'][] = 'role_name';
            $data['error_string'][] = 'Role name is required';
            $data['status'] = FALSE;
        }

        $permissions = $this->input->post('permissions_name'); // array
        // ✅ Validation: At least one permission required
        if (empty($permissions)) {
            $data['inputerror'][] = 'permissions[]';
            $data['error_string'][] = 'Please select at least one permission';
            $data['status'] = FALSE;
        }

        
        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
    
}
?>