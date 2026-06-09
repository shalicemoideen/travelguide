<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Company_holidays extends MY_Controller {
	public $table = 'company_holidays';
	public $activity = 'activity';
	public $page  = 'Company_holidays';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
        $this->load->model('General_model');
        $this->load->model('Company_holidays_model');
	}
	
	public function index()
	{
		$template['settings'] = $this->Company_holidays_model->get_all_settings();
		$template['body'] = 'Company_holidays/list';
		$template['script'] = 'Company_holidays/script';
		$this->load->view('template', $template);
	}

	public function ajax_check_date_holiday()
	{
		$date = $this->input->post('date');
		
		if (empty($date)) {
			echo json_encode(array('status' => FALSE, 'is_holiday' => FALSE, 'message' => 'Invalid date'));
			return;
		}

		$is_holiday = $this->Company_holidays_model->is_holiday($date);
		$holiday_type = '';
		
		if ($is_holiday) {
			$dayOfWeek = date('w', strtotime($date));
			$dayOfMonth = date('j', strtotime($date));
			
			$enable_sunday = $this->Company_holidays_model->get_setting('enable_sunday_holiday');
			$enable_second_saturday = $this->Company_holidays_model->get_setting('enable_second_saturday_holiday');
			
			if ($enable_sunday == '1' && $dayOfWeek == 0) {
				$holiday_type = 'Sunday';
			} elseif ($enable_second_saturday == '1' && $dayOfWeek == 6 && $dayOfMonth >= 8 && $dayOfMonth <= 14) {
				$holiday_type = '2nd Saturday';
			} else {
				$holiday_type = 'Custom Holiday';
			}
		}
		
		echo json_encode(array('status' => TRUE, 'is_holiday' => $is_holiday, 'holiday_type' => $holiday_type));
	}

	public function ajax_update_settings()
	{
		$enable_sunday = $this->input->post('enable_sunday_holiday');
		$enable_second_saturday = $this->input->post('enable_second_saturday_holiday');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');
		
		$this->Company_holidays_model->update_setting('enable_sunday_holiday', $enable_sunday, $currentuserid, $currentusername);
		$this->Company_holidays_model->update_setting('enable_second_saturday_holiday', $enable_second_saturday, $currentuserid, $currentusername);
		
		echo json_encode(array("status" => TRUE));
	}

	public function get()
	{
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'holiday_date';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'DESC';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
		
    	$data = $this->Company_holidays_model->get_holidays($param);
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

		$holiday_name = $this->input->post('holiday_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(
				'holiday_name' => $this->input->post('holiday_name'),
				'holiday_date' => $this->input->post('holiday_date'),
				'holiday_description' => $this->input->post('holiday_description'),
				'holiday_type' => $this->input->post('holiday_type'),
				'holiday_created_by_user_id' => $currentuserid,			
				'holiday_created_by_username' => $currentusername,			
				'holiday_created_date' => $date,			
				'holiday_created_time' => $time,			
				'holiday_status' => 1
			);
		$insert = $this->Company_holidays_model->save($data);

		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Added holiday: '.$holiday_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Company_holiday',
				'activity_ip' => $ip,
				'activity_action' => 'Add',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time' => $date1,
				'activity_date' => $date,				
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Company_holidays_model->get_by_id($id);
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
		$currentusername = $this->session->userdata('admin_name');
		
		$holiday_name = $this->input->post('holiday_name');
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');

		$activity_data = array(
				'activity_description' => 'Edited holiday: '.$holiday_name.'',
				'id_fk' => $id,
				'activity_type' => 'Company_holiday',
				'activity_ip' => $ip,
				'activity_action' => 'Edit',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time' => $date1,	
				'activity_date' => $date,			
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		$data = array(
				'holiday_name' => $this->input->post('holiday_name'),
				'holiday_date' => $this->input->post('holiday_date'),
				'holiday_description' => $this->input->post('holiday_description'),
				'holiday_type' => $this->input->post('holiday_type'),
			);
		
		$this->Company_holidays_model->update(array('company_holiday_id' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	public function checkHolidayDate()
	{
		$holiday_date = $this->input->post('value');
		$data = $this->Company_holidays_model->check_holiday_date($holiday_date);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function checkEditHolidayDate()
	{
		$holiday_date = $this->input->post('value');
		$holiday_id = $this->input->post('id');
		$data = $this->Company_holidays_model->check_edit_holiday_date($holiday_date, $holiday_id);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function delete()
	{
		$currentuserid = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());

		$updateData = array('holiday_status' => 0);
		
		$this->Company_holidays_model->update(array('company_holiday_id' => $this->input->post('id')), $updateData);

		$holiday_name = $this->input->post('holiday_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted holiday '.$holiday_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Company_holiday',
				'activity_ip' => $ip,
				'activity_action' => 'Delete',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time' => $date1,
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

		if($this->input->post('holiday_name') == '')
		{
			$data['inputerror'][] = 'holiday_name';
			$data['error_string'][] = 'Holiday name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('holiday_date') == '')
		{
			$data['inputerror'][] = 'holiday_date';
			$data['error_string'][] = 'Holiday date is required';
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
