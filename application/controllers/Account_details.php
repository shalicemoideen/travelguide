<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Account_details extends MY_Controller {
	public $table = 'account_details';
	public $activity = 'activity';
	public $page  = 'Account Details';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
		
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
        $this->load->model('General_model');
        $this->load->model('Account_details_model');
        
	}
	
	
	public function index()
	{
		$template['body'] = 'Account_details/list';
		$template['script'] = 'Account_details/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Account_details_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        

		if (!has_permission('ACCOUNT_DETAILS_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

		
    	$data = $this->Account_details_model->getAccountDetailsTable($param);
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
		$date1 = date('Y-m-d h:i:s a', time());
		
		$currentuserid = $this->session->userdata('user_id');
		
		$qr_code = $this->_do_upload('qr_code', './uploads/qr-code');
		$bank_logo = $this->_do_upload('bank_logo', './uploads/bank_logo');
		
		$data = array(
				'account_name' => $this->input->post('account_name'),
				'account_number' => $this->input->post('account_number'),
				'ifsc_code' => $this->input->post('ifsc_code'),
				'branch_name' => $this->input->post('branch_name'),
				'up_id' => $this->input->post('up_id'),
				'qr_code' => $qr_code,
				'bank_logo' => $bank_logo,
				'account_details_created_user_id' => $currentuserid,
				'account_details_created_at' => $date1,
				'account_details_status' => 1
			);
		$insert = $this->Account_details_model->save($data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Account_details_model->get_by_id($id);
		echo json_encode($data);
	}

	public function ajax_update()
	{
		$this->_validate();
		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date1 = date('Y-m-d h:i:s a', time());
		
		$currentuserid = $this->session->userdata('user_id');
		
		$id = $this->input->post('id');
		$existing = $this->Account_details_model->get_by_id($id);
		
		$qr_code = $this->_do_upload('qr_code', './uploads/qr-code', $existing ? $existing->qr_code : '');
		$bank_logo = $this->_do_upload('bank_logo', './uploads/bank_logo', $existing ? $existing->bank_logo : '');
		
		$data = array(
				'account_name' => $this->input->post('account_name'),
				'account_number' => $this->input->post('account_number'),
				'ifsc_code' => $this->input->post('ifsc_code'),
				'branch_name' => $this->input->post('branch_name'),
				'up_id' => $this->input->post('up_id'),
				'qr_code' => $qr_code,
				'bank_logo' => $bank_logo,
				'account_details_updated_user_id' => $currentuserid,
				'account_details_updated_at' => $date1
			);
		$this->Account_details_model->update(array('account_details_id' => $id), $data);
		echo json_encode(array("status" => TRUE));
	}

	

	public function delete()
	{
		$currentuserid = $this->session->userdata('user_id');

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date1 = date('Y-m-d h:i:s a', time());

		$updateData = array('account_details_status' => 0);
		
		$this->Account_details_model->update(array('account_details_id' => $this->input->post('id')), $updateData);

		echo json_encode(array("status" => TRUE));
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('account_name') == '')
		{
			$data['inputerror'][] = 'account_name';
			$data['error_string'][] = 'Account name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('account_number') == '')
		{
			$data['inputerror'][] = 'account_number';
			$data['error_string'][] = 'Account number is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _do_upload($field, $upload_path, $old_value = '')
	{
		if (!isset($_FILES[$field]) || empty($_FILES[$field]['name'])) {
			return $old_value;
		}

		if (!is_dir($upload_path)) {
			@mkdir($upload_path, 0777, true);
		}

		$config = array(
			'upload_path'   => $upload_path,
			'allowed_types' => 'gif|jpg|png|jpeg|pdf|wav',
			'max_size'      => 40960,
			'encrypt_name'  => true,
			'overwrite'     => false,
		);

		$this->load->library('upload');
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($field)) {
			return $old_value;
		}

		$up = $this->upload->data();
		return $up['file_name'];
	}
	
}
?>
