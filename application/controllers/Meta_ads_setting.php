<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Meta_ads_setting extends MY_Controller {
	public $table = 'meta_ads_setting';
	public $meta_ads_setting_staff = 'meta_ads_setting_staff';
	public $activity = 'activity';
	public $page  = 'Meta_ads_setting';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Meta_ads_setting_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['meta'] = $this->Meta_ads_setting_model->fetch_meta_ads_setting_details();
		$template['staff'] = $this->Meta_ads_setting_model->fetch_staff_details();
        $template['allstaff'] = $this->Meta_ads_setting_model->fetch_allstaff_details();
		$template['body'] = 'Meta_ads_setting/list';
		$template['script'] = 'Meta_ads_setting/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Meta_ads_setting_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		// $param['staff_id'] =(isset($_REQUEST['staff_id']))?$_REQUEST['staff_id']:'';
		$param['meta_ads_setting_id'] =(isset($_REQUEST['meta_ads_setting_id']))?$_REQUEST['meta_ads_setting_id']:'';
		$param['facebook_form_id_filter'] =(isset($_REQUEST['facebook_form_id_filter']))?$_REQUEST['facebook_form_id_filter']:'';
		$staff_id =(isset($_REQUEST['staff_id']))?$_REQUEST['staff_id']:'';
		if($staff_id){
		$param['staff_id'] = implode(', ', $staff_id);
		//print_r($tags);
		}
		$param['meta_ads_setting_created_by_userid'] =(isset($_REQUEST['meta_ads_setting_created_by_userid']))?$_REQUEST['meta_ads_setting_created_by_userid']:'';
		
		
    	$data = $this->Meta_ads_setting_model->getMetaadssettingTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function fetch_meta_staff(){
            
            $meta_ads_setting_id = $this->input->post('meta_ads_setting_id');
            $data = $this->Meta_ads_setting_model->fetch_meta_staff($meta_ads_setting_id);
            $json_data = json_encode($data);
            echo $json_data;
            
        }

    public function staff_array_list(){
    	
      $staff_id_fk = $this->input->post('staff_id_fk');

      
      echo json_encode($this->Meta_ads_setting_model->staff_array_list($staff_id_fk));
    }

    // public function ajax_add()
	// {
	// 	$this->_validate();
		
	// 	$this->load->helper('date');
	// 	if(function_exists('date_default_timezone_set')) {
	// 		date_default_timezone_set("Asia/Kolkata");
	// 	}
	// 	$date = date('Y-m-d');
	// 	$time = date('h:i:sa');
		
	// 	$date1 = date('Y-m-d h:i:s a', time());

	// 	$meta_ads_setting_name = $this->input->post('meta_ads_setting_name');
		
	// 	$currentuserid = $this->session->userdata('user_id');
	// 	$currentusertype = $this->session->userdata('user_type');
	// 	$currentusername = $this->session->userdata('admin_name');
		
	// 	$data = array(

	// 			'meta_ads_setting_name' => $this->input->post('meta_ads_setting_name'),
	// 			'facebook_form_id' => $this->input->post('facebook_form_id'),
	// 			'meta_ads_setting_description' => $this->input->post('meta_ads_setting_description'),				
	// 			'meta_ads_setting_created_by_userid' => $currentuserid,			
	// 			'meta_ads_setting_created_by_username' => $currentusername,			
	// 			'meta_ads_setting_created_by_date' => $date,			
	// 			'meta_ads_setting_created_by_time' => $time,			
	// 			'meta_ads_setting_status' => 1
	// 		);
	// 	$insert = $this->Meta_ads_setting_model->save($data);

	// 	$meta_ads_setting_staff_id_fk = $this->input->post('meta_ads_setting_staff_id_fk');

	// 		foreach ($meta_ads_setting_staff_id_fk as $key => $value) {		
					
	// 				$staff_id = $value;

	// 				$staff_list = array(
	// 				'meta_ads_setting_id_fk' => $insert,
	// 				'meta_ads_setting_staff_id_fk' => $staff_id,
	// 				'meta_ads_setting_staff_status' => '1',
	// 				);

	// 				$this->General_model->add($this->meta_ads_setting_staff,$staff_list);
	// 		}

	// 	$ip = $this->input->ip_address();
		
	// 	// echo $ip;

	// 	$activity_data = array(
	// 			'activity_description' => 'Added meta ads setting: '.$meta_ads_setting_name.'',
	// 			'id_fk' => $insert,
	// 			'activity_type' => 'Meta_ads_setting_registration',
	// 			'activity_ip' => $ip,
	// 			'activity_action' => 'Add',
	// 			'activity_by_userid' => $currentuserid,
	// 			'activity_by_username' => $currentusername,
	// 			'activity_date_time	' => $date1,
	// 			'activity_date' => $date,				
	// 			'activity_status' => 1,
	// 		);
		
	// 	$this->General_model->add($this->activity,$activity_data);
		
	// 	echo json_encode(array("status" => TRUE));
	// }

	public function ajax_add()
{
    $this->_validate();

    $this->load->helper('date');
    if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }

    $date  = date('Y-m-d');
    $time  = date('H:i:s');
    $date1 = date('Y-m-d H:i:s');

    $meta_ads_setting_name = $this->input->post('meta_ads_setting_name');

    $currentuserid   = $this->session->userdata('user_id');
    $currentusertype = $this->session->userdata('user_type');
    $currentusername = $this->session->userdata('admin_name');

    $data = array(
        'meta_ads_setting_name'               => $this->input->post('meta_ads_setting_name'),
        'facebook_form_id'                    => $this->input->post('facebook_form_id'),
        'meta_ads_setting_description'        => $this->input->post('meta_ads_setting_description'),
        'meta_ads_setting_created_by_userid'  => $currentuserid,
        'meta_ads_setting_created_by_username'=> $currentusername,
        'meta_ads_setting_created_by_date'    => $date,
        'meta_ads_setting_created_by_time'    => $time,
        'meta_ads_setting_status'             => 1
    );

    $insert = $this->Meta_ads_setting_model->save($data);

    $meta_ads_setting_staff_id_fk = $this->input->post('meta_ads_setting_staff_id_fk');

    if (!empty($meta_ads_setting_staff_id_fk)) {
        foreach ($meta_ads_setting_staff_id_fk as $staff_id) {

            // save selected staff in meta_ads_setting_staff table
            $staff_list = array(
                'meta_ads_setting_id_fk'       => $insert,
                'meta_ads_setting_staff_id_fk' => $staff_id,
                'meta_ads_setting_staff_status'=> 1,
            );

            $this->General_model->add($this->meta_ads_setting_staff, $staff_list);

            // get staff shift from userdetails table
            $userdetails = $this->Meta_ads_setting_model->get_user_shift($staff_id);

            if (!empty($userdetails)) {
                $actual_shift_id = (int)$userdetails->shift_id_fk;

                // 1. Insert actual shift row
                $next_order_actual = $this->Meta_ads_setting_model->get_next_staff_order($actual_shift_id, $insert);

                $staff_order_data_actual = array(
                    'shift_id_fk'                            => $actual_shift_id,
                    'meta_campain_id_fk'                    => $insert,
                    'staff_id_fk'                           => $staff_id,
                    'staff_order'                           => $next_order_actual,
                    'staff_order_assign_created_date'       => $date,
                    'staff_order_assign_created_time'       => $time,
                    'staff_order_assign_creaded_by_user_id' => $currentuserid,
                    'staff_order_assign_created_by_username'=> $currentusername,
                    'staff_order_assign_status'             => 1
                );

                $this->General_model->add('staff_order_assign', $staff_order_data_actual);

                // 2. Insert default shift_id = 3 row
                $default_shift_id = 3;
                $next_order_default = $this->Meta_ads_setting_model->get_next_staff_order($default_shift_id, $insert);

                $staff_order_data_default = array(
                    'shift_id_fk'                            => $default_shift_id,
                    'meta_campain_id_fk'                    => $insert,
                    'staff_id_fk'                           => $staff_id,
                    'staff_order'                           => $next_order_default,
                    'staff_order_assign_created_date'       => $date,
                    'staff_order_assign_created_time'       => $time,
                    'staff_order_assign_creaded_by_user_id' => $currentuserid,
                    'staff_order_assign_created_by_username'=> $currentusername,
                    'staff_order_assign_status'             => 1
                );

                $this->General_model->add('staff_order_assign', $staff_order_data_default);
            }
        }
    }

    $ip = $this->input->ip_address();

    $activity_data = array(
        'activity_description' => 'Added meta ads setting: '.$meta_ads_setting_name,
        'id_fk'                => $insert,
        'activity_type'        => 'Meta_ads_setting_registration',
        'activity_ip'          => $ip,
        'activity_action'      => 'Add',
        'activity_by_userid'   => $currentuserid,
        'activity_by_username' => $currentusername,
        'activity_date_time'   => $date1,
        'activity_date'        => $date,
        'activity_status'      => 1,
    );

    $this->General_model->add($this->activity, $activity_data);

    echo json_encode(array("status" => TRUE));
}
	public function ajax_edit($id)
	{
		$data = $this->Meta_ads_setting_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
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
		
		
		
		$meta_ads_setting_name = $this->input->post('meta_ads_setting_name');
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited meta ads setting: '.$meta_ads_setting_name.'',
				'id_fk' => $id,
				'activity_type' => 'Meta_ads_setting_registration',
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
				
				'meta_ads_setting_name' => $this->input->post('meta_ads_setting_name'),
				'facebook_form_id' => $this->input->post('facebook_form_id'),
				'meta_ads_setting_description' => $this->input->post('meta_ads_setting_description'),				
				// 'meta_ads_setting_created_by_userid' => $currentuserid,			
				// 'meta_ads_setting_created_by_username' => $currentusername,			
				// 'meta_ads_setting_created_by_date' => $date,			
				// 'meta_ads_setting_created_by_time' => $time,			
				// 'meta_ads_setting_status' => 1
			);
			// print_r($data);exit();
		$this->Meta_ads_setting_model->update(array('meta_ads_setting_id' => $this->input->post('id')), $data);

		$this->General_model->delete($this->meta_ads_setting_staff,'meta_ads_setting_id_fk',$id);

			// $vehicle_id_fk = $this->input->post('vehicle_id_fk');

			// foreach ($vehicle_id_fk as $key => $value) {		
					
			// 		$vehicle_id = $value;

			// 		$vehicle_list = array(
			// 		'transporter_id_fk' => $id,
			// 		'vehicle_id_fk' => $vehicle_id,
			// 		'transporter_vehicle_status' => '1',
			// 		);

			// 		$this->General_model->add($this->transporter_vehicle,$vehicle_list);
			// }

        $meta_ads_setting_staff_id_fk = $this->input->post('meta_ads_setting_staff_id_fk');

			foreach ($meta_ads_setting_staff_id_fk as $key => $value) {		
					
					$staff_id = $value;

					$staff_list = array(
					'meta_ads_setting_id_fk' => $id,
					'meta_ads_setting_staff_id_fk' => $staff_id,
					'meta_ads_setting_staff_status' => '1',
					);

					$this->General_model->add($this->meta_ads_setting_staff,$staff_list);
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

		$updateData = array('meta_ads_setting_status' => 0);
		
		$this->Meta_ads_setting_model->update(array('meta_ads_setting_id' => $this->input->post('id')), $updateData);

		$meta_ads_setting_name = $this->input->post('meta_ads_setting_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted meta ads setting: '.$meta_ads_setting_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Meta_ads_setting_registration',
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

        if (trim($this->input->post('meta_ads_setting_name')) == '')
        {
            $data['inputerror'][] = 'meta_ads_setting_name';
            $data['error_string'][] = 'Ads name is required';
            $data['status'] = FALSE;
        }

        if (trim($this->input->post('facebook_form_id')) == '')
        {
            $data['inputerror'][] = 'facebook_form_id';
            $data['error_string'][] = 'Facebook form id is required';
            $data['status'] = FALSE;
        }

        $staff_ids = $this->input->post('meta_ads_setting_staff_id_fk');

        if (empty($staff_ids) || !is_array($staff_ids))
        {
            $data['inputerror'][] = 'meta_ads_setting_staff_id_fk';
            $data['error_string'][] = 'Staff is required';
            $data['status'] = FALSE;
        }
        else
        {
            // remove empty values if any
            $staff_ids = array_filter($staff_ids, function($value){
                return $value !== '';
            });

            if (count($staff_ids) == 0)
            {
                $data['inputerror'][] = 'meta_ads_setting_staff_id_fk';
                $data['error_string'][] = 'Staff is required';
                $data['status'] = FALSE;
            }
        }

        if ($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
	
}
?>