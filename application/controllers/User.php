<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class User extends MY_Controller {
	public $table = 'user_details';
	public $page  = 'User';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
            redirect('/login');
        }
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
        $this->load->model('General_model');
        $this->load->model('Loginmodel');
        
		
	}
	public function index()
	{       
		$template['currentuserid'] = $this->currentuserid;
		$template['currentusertype'] = $this->currentusertype; 
		$currentuserid = $this->session->userdata('user_id');
		$template['records'] = $this->Loginmodel->get_row($currentuserid);
		$template['admin_data'] = $this->Loginmodel->get_User_details();
		$template['body'] = 'User/view';
		$template['script'] = 'User/script';
		$this->load->view('template', $template);
	}
        
		
    public function upload(){
		
		$template['body'] = 'User/upload';
		$template['script'] = 'User/script';
		$this->load->view('template', $template);
		$config = array(
		'upload_path' => "./uploads/",
		'allowed_types' => "gif|jpg|png|jpeg|pdf",
		'overwrite' => TRUE,
		'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
		'max_height' => "768",
		'max_width' => "1024"
		);
		
		$this->load->library('upload', $config);
		if($this->upload->do_upload())
		{
		$template = array('upload_data' => $this->upload->data());
		 $upload_data=$this->upload->data();
		 $file =$upload_data['file_name'];
		 $data1 = array(
        'imgpath' => $file
        );  
		$result = $this->General_model->add($this->table1,$data1);
		}
	}
	
	public function add(){
	    	
            $template['currentuserid'] = $this->currentuserid;
			$template['currentusertype'] = $this->currentusertype;
			$template['body'] = 'User/edit';
		    $template['script'] = 'User/script';
			$this->load->view('template', $template);
			
			$config = array(
			'upload_path' => "./uploads/user-profile",
			'allowed_types' => "gif|jpg|png|jpeg|pdf",
			'overwrite' => TRUE,
			'max_size' => "2048000", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);
		 
			$this->load->library('upload',$config);
			
			if($this->upload->do_upload('user_profile_pic'))
			{	
				 $template = array('upload_data' => $this->upload->data());
				 $upload_data = $this->upload->data();
				 //print_r($upload_data); die;
				 $file1 =$upload_data['file_name'];
			}
			// else{
			// echo"Not uploaded";
			// }
			// if(empty($file1))
			// {
				 // $file1 = $this->input->post('user_profile_pic');
				 // // print_r($file);exit();
			// }
			
			$this->load->helper('date');
			if(function_exists('date_default_timezone_set')) {
				date_default_timezone_set("Asia/Kolkata");
			}
			$date = date('Y-m-d h:i:sa');
			
			$data = array(
			
						'user_address' => $this->input->post('user_address'),
						'user_email_address' => $this->input->post('user_email_address'),
						'user_phone_number' => $this->input->post('user_phone_number'),
						'user_lan_number' => $this->input->post('user_lan_number'),
						'user_name' => $this->input->post('user_name'),
						'user_description' => $this->input->post('user_description')					
						// 'updated_date' => $date					
						);
					if(isset($file1) && $file1!='') { $data['user_profile_pic'] = $file1; }	else { unset($data['user_profile_pic']); }	

					// Only update password if a new one is provided (non-empty)
					$new_password = $this->input->post('password');
					if (trim((string)$new_password) !== '') {
						$data['password'] = password_hash($new_password, PASSWORD_DEFAULT);
					}
						//print_r($data); die;
						$user_id = $this->input->post('user_id');
				
				if($user_id){
					 
                      $data['user_id'] = $user_id;
                      $result = $this->General_model->update($this->table,$data,'user_id',$user_id);
                      $response_text = 'User details updated successfully';
                      
                      // Update session profile pic if current user updated their own profile
                      if ((int)$user_id === (int)$this->currentuserid && isset($file1) && $file1 != '') {
                          $this->session->set_userdata('user_profile_pic', $file1);
                      }
                }
				else{
                    
                }
				if($result){
	            $this->session->set_flashdata('response', json_encode(['text' => $response_text, 'type' => 'success']));
				}
				else{
	            $this->session->set_flashdata('response', json_encode(['text' => 'Something went wrong, please try again later', 'type' => 'error']));
				}
				
	        redirect('/User/', 'refresh');
		
	}
	
	public function editUserdetails($currentuserid){
		
		$template['currentuserid'] = $this->currentuserid;
		$template['currentusertype'] = $this->currentusertype;
		$currentuserid = $this->session->userdata('user_id');
		$template['records'] = $this->Loginmodel->get_row($currentuserid);
		$template['body'] = 'User/edit';
		$template['script'] = 'User/script';
		$this->load->view('template', $template);
		
	}
	
	public function layout(){
	
		$template['body'] = 'User/layout';
		$template['script'] = 'User/script';
		$this->load->view('template', $template);
	}
	public function editUpdate(){
	
        $id= $this->input->post('id');
        $shop_name= $this->input->post('shop_name');
        $address= $this->input->post('address');
        $tin_no= $this->input->post('tin_no');
        $phone_number= $this->input->post('phone_number');
        $admin_email= $this->input->post('admin_email');
        $user_name= $this->input->post('user_name');
        $password= $this->input->post('password');
        $this->load->helper('date');
        $date = date('Y-m-d h:i:sa');
        $update_data = array(
               
                'shop_name'=>$shop_name,
                'shop_address'=>$address,
                'tin_no'=>$tin_no,
                'phone_no'=>$phone_number,
                'admin_email'=>$admin_email,
                'user_name'=>$user_name,
                'admin_password'=>$password,
                'updated_date'=>$date
        );
        $data = $this->General_model->update($this->table,$update_data,'id',$id);
		
		if($data) {
            $response['text'] = 'Admin Details Updated successfully';
            $response['type'] = 'success';
        }
        else{
            $response['text'] = 'Something went wrong';
            $response['type'] = 'error';
        }
        $response['layout'] = 'topRight';
        $data_json = json_encode($response);
        echo $data_json;
        redirect('/User/', 'refresh');
    }
	
	public function checkUsername(){
            $user_name = $this->input->post('value');
            $data = $this->Loginmodel->checkUsernames($user_name);
            $json_data = json_encode($data);
            echo $json_data;
            
        }
	
	public function checkEditUsername(){
            $user_name = $this->input->post('value');
            $user_id = $this->input->post('id');
            $data = $this->Loginmodel->checkEditUsername($user_name,$user_id);
            $json_data = json_encode($data);
            echo $json_data;
            
        }

	public function toggle_file_saving()
	{
		$user_id = $this->session->userdata('user_id');
		$current_value = $this->input->post('current_value');

		if (function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$datetime = date('Y-m-d H:i:s');

		$new_value = ($current_value === 'Y') ? 'N' : 'Y';
		$action    = ($new_value === 'Y') ? 'STOPPED' : 'ENABLED';

		$this->db->where('user_id', $user_id)->update('user_details', ['meta_force_stop' => $new_value]);

		$this->db->insert('force_stop_log', [
			'log_user_id_fk'    => $user_id,
			'log_action'        => $action,
			'log_action_datetime' => $datetime,
			'log_status'        => 1
		]);

		echo json_encode(['status' => TRUE, 'new_value' => $new_value, 'action' => $action]);
	}

	public function get_file_saving_status()
	{
		$user_id = $this->session->userdata('user_id');
		$query = $this->db->select('meta_force_stop')->where('user_id', $user_id)->get('user_details');
		$row = $query->row();
		echo json_encode(['meta_force_stop' => $row ? $row->meta_force_stop : 'N']);
	}
}