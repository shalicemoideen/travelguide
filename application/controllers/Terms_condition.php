<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Terms_condition extends MY_Controller {
	public $table = 'terms_condition';
	public $terms_condition_items = 'terms_condition_items';
	public $activity = 'activity';
	public $page  = 'Terms_condition';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Terms_condition_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['condition'] = $this->Terms_condition_model->fetch_terms_condition();
		$template['staff'] = $this->Terms_condition_model->fetch_staff_details();
		$template['body'] = 'Terms_condition/list';
		$template['script'] = 'Terms_condition/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Terms_condition_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['terms_condition_id'] =(isset($_REQUEST['terms_condition_id']))?$_REQUEST['terms_condition_id']:'';
		
		$param['terms_condition_createdby_user_id'] =(isset($_REQUEST['terms_condition_createdby_user_id']))?$_REQUEST['terms_condition_createdby_user_id']:'';
		
		
    	$data = $this->Terms_condition_model->getTermsconditionTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function fetch_terms_condition_items(){
            
            $terms_condition_id = $this->input->post('terms_condition_id');
            $data = $this->Terms_condition_model->fetch_terms_condition_items($terms_condition_id);
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

		$terms_condition_name = $this->input->post('terms_condition_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'terms_condition_name' => $this->input->post('terms_condition_name'),
				'terms_condition_createdby_user_id' => $currentuserid,			
				'terms_condition_createdby_user_name' => $currentusername,			
				'terms_condition_created_date' => $date,			
				'terms_condition_created_time' => $time,			
				'terms_condition_status' => 1
			);
		$insert = $this->Terms_condition_model->save($data);

		$terms_condition_id_fk = $this->input->post('terms_condition_id_fk');
		$terms_condition_items_name = $this->input->post('terms_condition_items_name');

		if($insert){

      //foreach ($ledger_id as $key => $value) {
      foreach ($terms_condition_id_fk as $key => $value) {

				$data_terms_condition_item_add = array(
					'terms_condition_id_fk' => $insert,
					'terms_condition_items_name' => $terms_condition_items_name[$key],							
					'terms_condition_items_status' => 1
                    );
				//echo '<pre>'; print_r($data_terms_condition_item_add); exit();
				$result = $this->General_model->add($this->terms_condition_items,$data_terms_condition_item_add);
				// // print_r($data);exit();
				//$response_text = 'Payment policies added successfully';
				
			// }
			 
    }
	}

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added terms and conditions: '.$terms_condition_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Terms_condition_registration',
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
		$data = $this->Terms_condition_model->get_by_id($id);
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
		
		
		
		$terms_condition_name = $this->input->post('terms_condition_name');
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited terms and conditions: '.$terms_condition_name.'',
				'id_fk' => $id,
				'activity_type' => 'Terms_condition_registration',
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
				
				'terms_condition_name' => $this->input->post('terms_condition_name'),
				// 'terms_condition_createdby_user_id' => $currentuserid,			
				// 'terms_condition_createdby_user_name' => $currentusername,			
				// 'terms_condition_created_date' => $date,			
				// 'terms_condition_created_time' => $time,			
				// 'terms_condition_status' => 1
			);
			// print_r($data);exit();
		$this->Terms_condition_model->update(array('terms_condition_id' => $this->input->post('id')), $data);

		

		$terms_condition_items_id = $this->input->post('terms_condition_items_id');
		$terms_condition_id_fk = $this->input->post('terms_condition_id_fk');
		$terms_condition_items_name = $this->input->post('terms_condition_items_name');
		
		$itemCount=count($this->input->post('terms_condition_id_fk'));	
				
		$count=count($this->input->post('terms_condition_items_id'));
// echo $itemCount;die;
		$limit=$itemCount-$count;
		
		if($count==$itemCount)
		{
			
			//echo "hh";die;

			//foreach ($ledger_id as $key => $value) {
			foreach ($terms_condition_items_id as $key => $value) {		
			
			$emp_his_pk = $value;
			
			$data_item_details_update = array(
					'terms_condition_id_fk' => $id,
					'terms_condition_items_name' => $terms_condition_items_name[$key],							
					'terms_condition_items_status' => 1
					);
					//echo '<pre>'; print_r($data_vendors_boards); exit();
					$result = $this->General_model->update($this->terms_condition_items,$data_item_details_update,'terms_condition_items_id',$emp_his_pk);
                  
                  		// by dev team NB
                  		$removed_item_ids = $this->input->post('removed_terms_condition_id');
                  		if(!empty($removed_item_ids) && $removed_item_ids != '') {
                          $this->General_model->delete_in($this->terms_condition_items, 'terms_condition_items_id', $removed_item_ids);
                        }
                  		// by dev team NB end
                  
					// // print_r($data);exit();
					$response_text = 'Terms and condition details updated  successfully';
					
				// }
				 
			}
		}
		
		else{	
			
			//************** NEW BOARD DATA ****************//
// echo "jkk";die;

			//foreach ($ledger_id as $key => $value) {
			foreach ($terms_condition_id_fk as $key => $value) {
				
			
			$data_item_details_add_fromedit = array(
					'terms_condition_id_fk' => $id,
					'terms_condition_items_name' => $terms_condition_items_name[$key],							
					'terms_condition_items_status' => 1
                    );
					//echo '<pre>'; print_r($data_vendors_boards); exit();
                  	
                  		// edited by dev team NB
                  		if (isset($terms_condition_items_id[$key])) { 
                            // $result = $this->General_model->add($this->vendors_boards,$data_vendors_boards);
                            $result = $this->General_model->update($this->terms_condition_items, $data_item_details_add_fromedit, 'terms_condition_items_id', $terms_condition_items_id[$key]);
                        } else {
                            $result = $this->General_model->add($this->terms_condition_items, $data_item_details_add_fromedit);
                        }
					
                  		$removed_item_ids = $this->input->post('removed_terms_condition_id');
                  		if(!empty($removed_item_ids) && $removed_item_ids != '') {
                          $this->General_model->delete_in($this->terms_condition_items, 'terms_condition_items_id', $removed_item_ids);
                        }
                  		// edited by dev team NB end
                  
					// // print_r($data);exit();
					$response_text = 'Terms and condition details added  successfully';
					
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

		$updateData = array('terms_condition_status' => 0);
		
		$this->Terms_condition_model->update(array('terms_condition_id' => $this->input->post('id')), $updateData);

		$terms_condition_name = $this->input->post('terms_condition_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted terms and conditions: '.$terms_condition_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Terms_condition_registration',
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

		if($this->input->post('terms_condition_name') == '')
		{
			$data['inputerror'][] = 'terms_condition_name';
			$data['error_string'][] = 'Terms and condition is required';
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