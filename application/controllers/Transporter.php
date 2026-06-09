<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Transporter extends MY_Controller {
	public $table = 'transporter';
	public $transporter_vehicle = 'transporter_vehicle';
	public $activity = 'activity';
	public $page  = 'Transporter';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Transporter_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['state'] = $this->Transporter_model->fetch_state();;
		$template['transporter'] = $this->Transporter_model->fetch_transporter_details();
		$template['vehicle'] = $this->Transporter_model->fetch_vehicle();
		$template['staff'] = $this->Transporter_model->fetch_staff_details();
		$template['body'] = 'Transporter/list';
		$template['script'] = 'Transporter/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Transporter_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		
		// $vehicle_id_fk =(isset($_REQUEST['vehicle_id_fk']))?$_REQUEST['vehicle_id_fk']:'';
		// if($vehicle_id_fk){
		// $param['vehicle_id_fk'] = implode(', ', $vehicle_id_fk);
		// //print_r($tags);
		// }
		
		
		if (!has_permission('TRANSPORTER_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

    	$data = $this->Transporter_model->getTransporterTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function fetch_transporter_vehicle(){
            
            $transporter_id = $this->input->post('transporter_id');
            $data = $this->Transporter_model->fetch_transporter_vehicle($transporter_id);
            $json_data = json_encode($data);
            echo $json_data;
            
        }

    public function vehicle_array_list(){
    	
      $staff_id_fk = $this->input->post('staff_id_fk');

      
      echo json_encode($this->Transporter_model->vehicle_array_list($staff_id_fk));
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

		$transporter_name = $this->input->post('transporter_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'transporter_name' => $this->input->post('transporter_name'),
				'transporter_base_station_id_fk' => $this->input->post('transporter_base_station_id_fk'),
				'transporter_address' => $this->input->post('transporter_address'),
				'transporter_contact_person_name1' => $this->input->post('transporter_contact_person_name1'),
				'transporter_contact_person_email1' => $this->input->post('transporter_contact_person_email1'),
				'transporter_contact_person_contact_num1' => $this->input->post('transporter_contact_person_contact_num1'),
				'transporter_contact_person_contact_num12' => $this->input->post('transporter_contact_person_contact_num12'),
				'transporter_contact_person_name2' => $this->input->post('transporter_contact_person_name2'),
				'transporter_contact_person_email2' => $this->input->post('transporter_contact_person_email2'),
				'transporter_contact_person_contact_num2' => $this->input->post('transporter_contact_person_contact_num2'),
				'transporter_contact_person_contact_num22' => $this->input->post('transporter_contact_person_contact_num22'),
				'transporter_bank_name' => $this->input->post('transporter_bank_name'),
				'transporter_bank_account_number' => $this->input->post('transporter_bank_account_number'),
				'transporter_bank_account_name' => $this->input->post('transporter_bank_account_name'),
				'transporter_bank_account_ifsc_code' => $this->input->post('transporter_bank_account_ifsc_code'),
				'transporter_bank_account_branch' => $this->input->post('transporter_bank_account_branch'),
				'transporter_bank_swift_code' => $this->input->post('transporter_bank_swift_code'),				
				'transporter_createdby_user_id' => $currentuserid,						
				'transporter_created_at' => $date1,					
				'transporter_status' => 1
			);
		$insert = $this->Transporter_model->save($data);

		$vehicle_id_fk = $this->input->post('vehicle_id_fk');

			foreach ($vehicle_id_fk as $key => $value) {		
					
					$vehicle_id = $value;

					$vehicle_list = array(
					'transporter_id_fk' => $insert,
					'vehicle_id_fk' => $vehicle_id,
					'transporter_vehicle_status' => '1',
					);

					$this->General_model->add($this->transporter_vehicle,$vehicle_list);
			}
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Transporter_model->get_by_id($id);
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
		
		
		
		$transporter_name = $this->input->post('transporter_name');

		$id = $this->input->post('id');
		
		$data = array(
				
				'transporter_name' => $this->input->post('transporter_name'),
				'transporter_base_station_id_fk' => $this->input->post('transporter_base_station_id_fk'),
				'transporter_address' => $this->input->post('transporter_address'),
				'transporter_contact_person_name1' => $this->input->post('transporter_contact_person_name1'),
				'transporter_contact_person_email1' => $this->input->post('transporter_contact_person_email1'),
				'transporter_contact_person_contact_num12' => $this->input->post('transporter_contact_person_contact_num12'),
				'transporter_contact_person_name2' => $this->input->post('transporter_contact_person_name2'),
				'transporter_contact_person_email2' => $this->input->post('transporter_contact_person_email2'),
				'transporter_contact_person_contact_num2' => $this->input->post('transporter_contact_person_contact_num2'),
				'transporter_contact_person_contact_num22' => $this->input->post('transporter_contact_person_contact_num22'),
				'transporter_bank_name' => $this->input->post('transporter_bank_name'),
				'transporter_bank_account_number' => $this->input->post('transporter_bank_account_number'),
				'transporter_bank_account_name' => $this->input->post('transporter_bank_account_name'),
				'transporter_bank_account_ifsc_code' => $this->input->post('transporter_bank_account_ifsc_code'),
				'transporter_bank_account_branch' => $this->input->post('transporter_bank_account_branch'),
				'transporter_bank_swift_code' => $this->input->post('transporter_bank_swift_code'),				
				'transporter_updatedby_user_id' => $currentuserid,					
				'transporter_updated_at' => $date1,			
			);
			// print_r($data);exit();
		$this->Transporter_model->update(array('transporter_id' => $this->input->post('id')), $data);

		$this->General_model->delete($this->transporter_vehicle,'transporter_id_fk',$id);

			$vehicle_id_fk = $this->input->post('vehicle_id_fk');

			foreach ($vehicle_id_fk as $key => $value) {		
					
					$vehicle_id = $value;

					$vehicle_list = array(
					'transporter_id_fk' => $id,
					'vehicle_id_fk' => $vehicle_id,
					'transporter_vehicle_status' => '1',
					);

					$this->General_model->add($this->transporter_vehicle,$vehicle_list);
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

		$updateData = array('transporter_status' => 0);
		
		$this->Transporter_model->update(array('transporter_id' => $this->input->post('id')), $updateData);

		// $transporter_name = $this->input->post('transporter_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted transporter: '.$transporter_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Transporter_registration',
		// 		// 'activity_order_number' => $invoice_order_number1,
		// 		'activity_ip' => $ip,
		// 		'activity_action' => 'Delete',
		// 		'activity_by_userid' => $currentuserid,
		// 		'activity_by_username' => $currentusername,
		// 		'activity_date_time	' => $date1,
		// 		'activity_date' => $date,
		// 		'activity_status' => 1,
		// 	);
		
		// $this->General_model->add($this->activity,$activity_data);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('transporter_name') == '')
		{
			$data['inputerror'][] = 'transporter_name';
			$data['error_string'][] = 'Transporter name is required';
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