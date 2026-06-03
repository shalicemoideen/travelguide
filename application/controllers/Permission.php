<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Permission extends MY_Controller {
    public $table = 'tr_permissions';
    public $activity = 'activity';
    public $page  = 'Permission';
    public function __construct() {
        parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
        
        
        $this->load->model('General_model');
        $this->load->model('Permission_model');
        
    }
    
    
    public function index()
    {
        $template['staff'] = $this->Permission_model->getAllPermissions();
        $template['body'] = 'Permission/list';
        $template['script'] = 'Permission/script';
        $this->load->view('template', $template);
    }

    public function get(){
        $this->load->model('Permission_model');
        $param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
        $param['permission_status'] =(isset($_REQUEST['permission_status']))?$_REQUEST['permission_status']:'';
        
        // $param['state_created_user_id'] =(isset($_REQUEST['state_created_user_id']))?$_REQUEST['state_created_user_id']:'';

        
        $data = $this->Permission_model->getPermissionTable($param);
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
        
        $permission_name = $this->input->post('permission_name');
        $permission_description = $this->input->post('permission_description');
        $permission_status = $this->input->post('permission_status');
        $currentuserid = $this->session->userdata('user_id');
        $currentusername = $this->session->userdata('admin_name');
        
        $data = array(

                'name' => $this->input->post('permission_name'),
                'description' => $this->input->post('permission_description'), 
                'status' => $this->input->post('permission_status'),                 
                'created_by' => $currentuserid,          
                'created_at' => $date1
            );
        $insert = $this->Permission_model->save($data);

        $ip = $this->input->ip_address();
        
        // echo $ip;

        $activity_data = array(
                'activity_description' => 'Added Permission: '.$permission_name.'',
                'id_fk' => $insert,
                'activity_type' => 'Permission_registration',
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
        $data = $this->Permission_model->get_by_id($id);
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
        
        
        
        $permission_name = $this->input->post('permission_name');
        
        
        $ip = $this->input->ip_address();
        $id = $this->input->post('id');
        // echo $ip;

        $activity_data = array(
                'activity_description' => 'Updated Permission: '.$permission_name.'',
                'id_fk' => $id,
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
                
                'name' => $this->input->post('permission_name'),
                'description' => $this->input->post('permission_description'), 
                'status' => $this->input->post('permission_status'),                 
                'updated_by' => $currentuserid,           
                'updated_at' => $date1,           
            );
        $this->Permission_model->update(array('id' => $this->input->post('id')), $data);
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

        $updateData = array('status' => 2);
        
        $this->Permission_model->update(array('id' => $this->input->post('id')), $updateData);

        $permission_name = $this->input->post('permission_name');
        $ip = $this->input->ip_address();
        
        $activity_data = array(
                'activity_description' => 'Deleted Permission: '.$permission_name.'',
                'id_fk' => $this->input->post('id'),
                'activity_type' => 'Permission_registration',
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

        if($this->input->post('permission_name') == '')
        {
            $data['inputerror'][] = 'permission_name';
            $data['error_string'][] = 'Permission name is required';
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