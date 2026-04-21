<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Cancellation_policies extends MY_Controller {
	public $table = 'cancellation_policies';
	public $cancellation_policies_item = 'cancellation_policies_item';
	public $activity = 'activity';
	public $page  = 'Cancellation_policies';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Cancellation_policies_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['cancellation'] = $this->Cancellation_policies_model->fetch_cancellation_policies();
		$template['staff'] = $this->Cancellation_policies_model->fetch_staff_details();
		$template['body'] = 'Cancellation_policies/list';
		$template['script'] = 'Cancellation_policies/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Cancellation_policies_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['cancellation_policies_id'] =(isset($_REQUEST['cancellation_policies_id']))?$_REQUEST['cancellation_policies_id']:'';
		
		$param['cancellation_policies_createdby_user_id'] =(isset($_REQUEST['cancellation_policies_createdby_user_id']))?$_REQUEST['cancellation_policies_createdby_user_id']:'';
		
		
    	$data = $this->Cancellation_policies_model->getCancellationpoliciesTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function fetch_cancellation_policies_items(){
            
            $cancellation_policies_id = $this->input->post('cancellation_policies_id');
            $data = $this->Cancellation_policies_model->fetch_cancellation_policies_items($cancellation_policies_id);
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

		$cancellation_policies_name = $this->input->post('cancellation_policies_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'cancellation_policies_name' => $this->input->post('cancellation_policies_name'),
				'cancellation_policies_createdby_user_id' => $currentuserid,			
				'cancellation_policies_createdby_user_name' => $currentusername,			
				'cancellation_policies_created_date' => $date,			
				'cancellation_policies_created_time' => $time,			
				'cancellation_policies_status' => 1
			);
		$insert = $this->Cancellation_policies_model->save($data);

		$cancellation_policies_id_fk = $this->input->post('cancellation_policies_id_fk');
		$cancellation_policies_item_name = $this->input->post('cancellation_policies_item_name');

		if($insert){

      //foreach ($ledger_id as $key => $value) {
      foreach ($cancellation_policies_id_fk as $key => $value) {

				$data_cancellation_policies_item_add = array(
					'cancellation_policies_id_fk' => $insert,
					'cancellation_policies_item_name' => $cancellation_policies_item_name[$key],							
					'cancellation_policies_item_status' => 1
                    );
				//echo '<pre>'; print_r($data_terms_condition_item_add); exit();
				$result = $this->General_model->add($this->cancellation_policies_item,$data_cancellation_policies_item_add);
				// // print_r($data);exit();
				//$response_text = 'Payment policies added successfully';
				
			// }
			 
    }
	}

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added cancellation and policies: '.$cancellation_policies_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Cancellation_policies_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Add',
				// 'activity_by_userid' => $currentuserid,
				// 'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,
				'activity_date' => $date,				
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$data = $this->Cancellation_policies_model->get_by_id($id);
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
		
		
		
		$cancellation_policies_name = $this->input->post('cancellation_policies_name');
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited cancellation and policies: '.$cancellation_policies_name.'',
				'id_fk' => $id,
				'activity_type' => 'Cancellation_policies_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Edit',
				// 'activity_by_userid' => $currentuserid,
				// 'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,	
				'activity_date' => $date,			
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		$data = array(
				
				'cancellation_policies_name' => $this->input->post('cancellation_policies_name'),
				// 'cancellation_policies_createdby_user_id' => $currentuserid,			
				// 'cancellation_policies_createdby_user_name' => $currentusername,			
				// 'cancellation_policies_created_date' => $date,			
				// 'cancellation_policies_created_time' => $time,			
				// 'cancellation_policies_status' => 1
			);
			// print_r($data);exit();
		$this->Cancellation_policies_model->update(array('cancellation_policies_id' => $this->input->post('id')), $data);

		

		$cancellation_policies_item_id = $this->input->post('cancellation_policies_item_id');
		$cancellation_policies_id_fk = $this->input->post('cancellation_policies_id_fk');
		$cancellation_policies_item_name = $this->input->post('cancellation_policies_item_name');
		
		$itemCount=count($this->input->post('cancellation_policies_id_fk'));	
				
		$count=count($this->input->post('cancellation_policies_item_id'));
// echo $itemCount;die;
		$limit=$itemCount-$count;
		
		if($count==$itemCount)
		{
			
			//echo "hh";die;

			//foreach ($ledger_id as $key => $value) {
			foreach ($cancellation_policies_item_id as $key => $value) {		
			
			$emp_his_pk = $value;
			
			$data_item_details_update = array(
					'cancellation_policies_id_fk' => $id,
					'cancellation_policies_item_name' => $cancellation_policies_item_name[$key],							
					'cancellation_policies_item_status' => 1
					);
					//echo '<pre>'; print_r($data_vendors_boards); exit();
					$result = $this->General_model->update($this->cancellation_policies_item,$data_item_details_update,'cancellation_policies_item_id',$emp_his_pk);
                  
                  		// by dev team NB
                  		$removed_item_ids = $this->input->post('removed_cancellation_policies_id');
                  		if(!empty($removed_item_ids) && $removed_item_ids != '') {
                          $this->General_model->delete_in($this->cancellation_policies_item, 'cancellation_policies_item_id', $removed_item_ids);
                        }
                  		// by dev team NB end
                  
					// // print_r($data);exit();
					$response_text = 'Cancellation and policies details updated  successfully';
					
				// }
				 
			}
		}
		
		else{	
			
			//************** NEW BOARD DATA ****************//
// echo "jkk";die;

			//foreach ($ledger_id as $key => $value) {
			foreach ($cancellation_policies_id_fk as $key => $value) {
				
			
			$data_item_details_add_fromedit = array(
					'cancellation_policies_id_fk' => $id,
					'cancellation_policies_item_name' => $cancellation_policies_item_name[$key],							
					'cancellation_policies_item_status' => 1
                    );
					//echo '<pre>'; print_r($data_vendors_boards); exit();
                  	
                  		// edited by dev team NB
                  		if (isset($cancellation_policies_item_id[$key])) { 
                            // $result = $this->General_model->add($this->vendors_boards,$data_vendors_boards);
                            $result = $this->General_model->update($this->cancellation_policies_item, $data_item_details_add_fromedit, 'cancellation_policies_item_id', $cancellation_policies_item_id[$key]);
                        } else {
                            $result = $this->General_model->add($this->cancellation_policies_item, $data_item_details_add_fromedit);
                        }
					
                  		$removed_item_ids = $this->input->post('removed_cancellation_policies_id');
                  		if(!empty($removed_item_ids) && $removed_item_ids != '') {
                          $this->General_model->delete_in($this->cancellation_policies_item, 'cancellation_policies_item_id', $removed_item_ids);
                        }
                  		// edited by dev team NB end
                  
					// // print_r($data);exit();
					$response_text = 'Cancellation and policies details added  successfully';
					
				// }
				 
			}
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

		$updateData = array('cancellation_policies_status' => 0);
		
		$this->Terms_condition_model->update(array('cancellation_policies_id' => $this->input->post('id')), $updateData);

		$cancellation_policies_name = $this->input->post('cancellation_policies_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted cancellation and policies: '.$cancellation_policies_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Cancellation_policies_registration',
				// 'activity_order_number' => $invoice_order_number1,
				'activity_ip' => $ip,
				'activity_action' => 'Delete',
				// 'activity_by_userid' => $currentuserid,
				// 'activity_by_username' => $currentusername,
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

		if($this->input->post('cancellation_policies_name') == '')
		{
			$data['inputerror'][] = 'cancellation_policies_name';
			$data['error_string'][] = 'cancellation and policies title is required';
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