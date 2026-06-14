<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff extends MY_Controller {
	public $table = 'user_details';
	public $activity = 'activity';
	public $page  = 'Staff';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Staff_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		$template['roles'] = $this->Staff_model->fetch_roles();
        $template['designation'] = $this->Staff_model->fetch_designation();
		$template['staff'] = $this->Staff_model->fetch_staff_details();
		$template['shift'] = $this->Staff_model->fetch_shift();
		$template['languages'] = $this->Staff_model->fetch_languages();
		$template['body'] = 'Staff/list';
		$template['script'] = 'Staff/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Staff_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['user_id_filter'] =(isset($_REQUEST['user_id_filter']))?$_REQUEST['user_id_filter']:'';
		$param['role_id_filter'] =(isset($_REQUEST['role_id_filter']))?$_REQUEST['role_id_filter']:'';
        $param['designation_id_filter'] =(isset($_REQUEST['designation_id_filter']))?$_REQUEST['designation_id_filter']:'';
        $param['user_phone_number_filter'] =(isset($_REQUEST['user_phone_number_filter']))?$_REQUEST['user_phone_number_filter']:'';

		if (!has_permission('STAFF_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

    	$data = $this->Staff_model->getStaffTable($param);
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

		$admin_name = $this->input->post('admin_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
        $user_date_of_joining = str_replace('/','-', $this->input->post('user_date_of_joining'));
		$user_date_of_joining = date("Y-m-d h:i:s a",strtotime($user_date_of_joining));
        
		$document = $this->input->post('user_profile_pic');
		if(empty($document))
		{
			$config1 = array(

			'upload_path' => "./uploads/user-profile",
			'allowed_types' => "gif|jpg|png|jpeg|pdf|wav|",
			'overwrite' => FALSE,
			'max_size' => "131072", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);

			$file1 = '';
			$this->load->library('upload',$config1);			
			if($this->upload->do_upload('user_profile_pic'))
			{	

					$template = array('upload_data' => $this->upload->data());
					$upload_data = $this->upload->data();
					//print_r($upload_data); die;
					$file1 =$upload_data['file_name'];

			}

			if(empty($file1))
			{
					$file1 = $this->input->post('user_profile_pic_txt');

			}
		
		
		}

		$data = array(

				'admin_name' => $this->input->post('admin_name'),
				'user_profile_pic' => $file1,
				'user_address' => $this->input->post('user_address'),
                'user_email_address' => $this->input->post('user_email_address'),					
                'user_phone_number' => $this->input->post('user_phone_number'),
                'user_lan_number' => $this->input->post('user_lan_number'),
                'role_id_fk' => $this->input->post('role_id_fk'),
                'designation_id_fk' => $this->input->post('designation_id_fk'),
                'user_date_of_joining' => $user_date_of_joining,
                'user_name' => $this->input->post('user_name'),
                'password' => $this->input->post('password'),
                'device_user_id' => $this->input->post('device_user_id'),
				 // Logic: If input is 'Y', save 'Y', otherwise save 'N'
				'meta_force_stop' => ($this->input->post('meta_force_stop') == 'Y') ? 'Y' : 'N',


				'shift_id_fk' => $this->input->post('shift_id_fk'),
                'user_description' => $this->input->post('user_description'),
                // 'user_profile_pic' => $file,                		
				'user_created_date' => $date,			
				'user_created_time' => $time,			
				'user_type' => 'S',
                'user_status' => 1
			);
		$insert = $this->Staff_model->save($data);

		// Save staff languages
		$languages = $this->input->post('languages');
		if (!empty($languages)) {
			$this->Staff_model->save_staff_languages($insert, $languages);
		}

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added staff: '.$admin_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Staff_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Add',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,
				'activity_date' => $date,				
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Staff_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		
		// Fetch staff languages
		$staff_languages = $this->Staff_model->fetch_staff_languages($id);
		$data->languages = array();
		foreach ($staff_languages as $lang) {
			$data->languages[] = $lang->language_id_fk;
		}
		
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
		
		$user_date_of_joining = str_replace('/','-', $this->input->post('user_date_of_joining'));
		$user_date_of_joining = date("Y-m-d h:i:s a",strtotime($user_date_of_joining));
		
		$admin_name = $this->input->post('admin_name');
		
		$document = $this->input->post('user_profile_pic');
		if(empty($document))
		{
			$config1 = array(

			'upload_path' => "./uploads/user-profile",
			'allowed_types' => "gif|jpg|png|jpeg|pdf|wav|",
			'overwrite' => FALSE,
			'max_size' => "131072", // Can be set to particular file size , here it is 2 MB(2048 Kb)
			// 'max_height' => "768",
			// 'max_width' => "1024"
			);

			$file1 = '';
			$this->load->library('upload',$config1);			
			if($this->upload->do_upload('user_profile_pic'))
			{	

					$template = array('upload_data' => $this->upload->data());
					$upload_data = $this->upload->data();
					//print_r($upload_data); die;
					$file1 =$upload_data['file_name'];

			}

			if(empty($file1))
			{
					$file1 = $this->input->post('user_profile_pic_txt');

			}
		
		
		}
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		$new_shift_id = $this->input->post('shift_id_fk');
		
		// Get current shift to check if it changed
		$current_staff = $this->Staff_model->get_by_id($id);
		$old_shift_id = $current_staff->shift_id_fk;
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited staff: '.$admin_name.'',
				'id_fk' => $id,
				'activity_type' => 'Staff_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Edit',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,	
				'activity_date' => $date,			
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		$data = array(

				'admin_name' => $this->input->post('admin_name'),
				'user_profile_pic' => $file1,
				'user_address' => $this->input->post('user_address'),
                'user_email_address' => $this->input->post('user_email_address'),					
                'user_phone_number' => $this->input->post('user_phone_number'),
                'user_lan_number' => $this->input->post('user_lan_number'),
                'role_id_fk' => $this->input->post('role_id_fk'),
                'designation_id_fk' => $this->input->post('designation_id_fk'),
                'user_date_of_joining' => $user_date_of_joining,
                'user_name' => $this->input->post('user_name'),
                'password' => $this->input->post('password'),
                'device_user_id' => $this->input->post('device_user_id'),
				// Logic: If input is 'Y', save 'Y', otherwise save 'N'
				'meta_force_stop' => ($this->input->post('meta_force_stop') == 'Y') ? 'Y' : 'N',


				'shift_id_fk' => $new_shift_id,
                'user_description' => $this->input->post('user_description'),
                // 'user_profile_pic' => $file,	
				// 'user_created_date' => $date,			
				// 'user_created_time' => $time,			
				// 'user_type' => 'S',
                // 'user_status' => 1
			);
			// print_r($data);exit();
		$this->Staff_model->update(array('user_id' => $this->input->post('id')), $data);

		// Update staff_order_assign table if shift changed
		if ($old_shift_id != $new_shift_id) {
			// Get all staff_order_assign entries for this staff
			$staff_order_assigns = $this->db
				->where('staff_id_fk', $id)
				->get('staff_order_assign')
				->result();

			if (!empty($staff_order_assigns)) {
				foreach ($staff_order_assigns as $assign) {
					// Get next order for the new shift in this campaign
					$this->db->select_max('staff_order');
					$this->db->where('shift_id_fk', $new_shift_id);
					$this->db->where('meta_campain_id_fk', $assign->meta_campain_id_fk);
					$max_order = $this->db->get('staff_order_assign')->row();
					
					$next_order = ($max_order && $max_order->staff_order) ? ($max_order->staff_order + 1) : 1;

					// Update the staff_order_assign entry with new shift and order
					$this->db->where('staff_order_assign_id', $assign->staff_order_assign_id);
					$this->db->update('staff_order_assign', array(
						'shift_id_fk' => $new_shift_id,
						'staff_order' => $next_order
					));
				}
			}
		}

		// Save staff languages
		$languages = $this->input->post('languages');
		$this->Staff_model->save_staff_languages($this->input->post('id'), $languages);

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

		$updateData = array('user_status' => 0);
		
		$this->Staff_model->update(array('user_id' => $this->input->post('id')), $updateData);

		$admin_name = $this->input->post('admin_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted staff '.$admin_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Staff_registration',
				// 'activity_order_number' => $invoice_order_number1,
				'activity_ip' => $ip,
				'activity_action' => 'Delete',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,
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
		

		if($this->input->post('admin_name') == '')
		{
			$data['inputerror'][] = 'admin_name';
			$data['error_string'][] = 'Staff name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('user_name') == '')
		{
			$data['inputerror'][] = 'user_name';
			$data['error_string'][] = 'User name is required';
			$data['status'] = FALSE;
		}

        if($this->input->post('password') == '')
		{
			$data['inputerror'][] = 'password';
			$data['error_string'][] = 'Staff name is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('shift_id_fk') == '')
		{
			$data['inputerror'][] = 'shift_id_fk';
			$data['error_string'][] = 'Shift is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('role_id_fk') == '')
		{
			$data['inputerror'][] = 'role_id_fk';
			$data['error_string'][] = 'Role is required';
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