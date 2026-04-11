<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Login extends CI_Controller{
    public $login_logs = 'login_logs';
    function __construct() {
        parent::__construct();
        $this->load->model('Loginmodel');
        $this->load->model('General_model');
    }
    public function index(){
        $this->form_validation->set_rules('username', 'Username', 'required');
        $this->form_validation->set_rules('password', 'password', 'required');
        if ($this->form_validation->run() == FALSE) {
              $this->load->view('Login/Login');
        } else {
                $data = array('user_name' => $this->input->post('username'),
                              'password' => $this->input->post('password')
                              );
                $result = $this->Loginmodel->checkUserLogin($data);
				// print_r($data);exit();
				// echo json_encode($data);
				$response_text = 'Logged in successfully';
                if($result){
					
					// $this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");

                    $user_type = $this->session->userdata['user_type'];
                    $currentusername = $this->session->userdata('admin_name');
                    $currentuserid = $this->session->userdata('user_id');
                    $currentuserid_fk = $this->session->userdata('user_id_fk');

                    //echo session_id(); die;
                    $this->load->helper('date');
                    if(function_exists('date_default_timezone_set')) {
                        date_default_timezone_set("Asia/Kolkata");
                    }
                    $date = date('Y-m-d');
                    $time = date('h:i:sa');
                    
                    $date1 = date('Y-m-d h:i:s a', time());                
                    $sessionid = session_id();

                    $log_data = array(
                            'login_logs_user_id_fk' => $currentuserid,
                            'login_logs_user_type' => $user_type,
                            'login_logs_session_id' => $sessionid,
                            'login_logs_admin_name' => $currentusername,
                            'login_logs_date' => $date,               
                            'login_logs_date_time' => $date1,             
                            'login_logs_status' => 1,
                        );
                    //print_r($log_data); exit;
                    $this->General_model->add($this->login_logs,$log_data);
					
					 if($user_type == 'C') {
                        redirect('/Property_registration/');
                    }
                    if($user_type == 'S'){
						redirect('Dashboard');
                    } 
					if($user_type == 'A'){
						redirect('Home');
                    }
                    if($user_type == 'MH'){
                        redirect('Dashboard');
                    }
					if($user_type == 'H'){
						redirect('Payment_control');
                    }

                    
                }
                else{
                    $error['message'] = "The user name or password is invalid";
                    $this->load->view('Login/Login',$error);
                }
        }
    }
    public function logout(){

        $date1 = date('Y-m-d h:i:s a', time());                
        $sessionid = session_id();

        $logout_data = array(               
                            'logout_logs_date_time' => $date1
                        );
                    //print_r($log_data); exit;
        $this->General_model->update($this->login_logs,$logout_data,'login_logs_session_id',$sessionid);

        $this->session->sess_destroy();
        redirect('/login/');
    }
	
	public function ValidationUserLogin(){
           
            $data = $this->Loginmodel->Validation_login();
			// print_r($data);exit();
            echo json_encode($data);
        }
	public function checkUsername(){
            $user_name = $this->input->post('value');      
            $data = $this->Loginmodel->checkUsername($user_name);
			// print_r($data);exit();
            $json_data = json_encode($data);
            echo $json_data;
            
        }
		
	public function checkPassword(){
            $password = $this->input->post('value');      
            $data = $this->Loginmodel->checkPassword($password);
			// print_r($data);exit();
            $json_data = json_encode($data);
            echo $json_data;
            
        }

    public function check_session()
    {
        if (!$this->session->userdata('user_id')) {
            echo json_encode(['status' => 'expired']);
        } else {
            echo json_encode(['status' => 'active']);
        }
    }
}
?>
