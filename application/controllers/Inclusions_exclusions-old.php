<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Inclusions_exclusions extends MY_Controller {
	public $table = 'payment_policies';
	public $inclusions = 'inclusions';
	public $exclusions = 'exclusions';
	public $activity = 'activity';
	public $page  = 'Inclusions_exclusions';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Inclusions_exclusions_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['exclusion'] = $this->Inclusions_exclusions_model->fetch_inclusion_exclusion();
		$template['staff'] = $this->Inclusions_exclusions_model->fetch_staff_details();
		$template['body'] = 'Inclusions_exclusions/list_new';
		$template['script'] = 'Inclusions_exclusions/script_new';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Inclusions_exclusions_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['inclusion_exclusion_common_id'] =(isset($_REQUEST['inclusion_exclusion_common_id']))?$_REQUEST['inclusion_exclusion_common_id']:'';
		
		$param['inclusion_exclusion_common_createdby_user_id'] =(isset($_REQUEST['inclusion_exclusion_common_createdby_user_id']))?$_REQUEST['inclusion_exclusion_common_createdby_user_id']:'';
		
		if (!has_permission('INCLUSION_AND_EXCLUSION_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }
		
    	$data = $this->Inclusions_exclusions_model->getInclusions_exclusionsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    public function fetch_inclusion_items(){
            
            $inclusion_exclusion_common_id = $this->input->post('inclusion_exclusion_common_id');
            $data = $this->Inclusions_exclusions_model->fetch_inclusion_items($inclusion_exclusion_common_id);
            $json_data = json_encode($data);
            echo $json_data;
            
        }

  public function fetch_exclusion_items(){
            
            $inclusion_exclusion_common_id = $this->input->post('inclusion_exclusion_common_id');
            $data = $this->Inclusions_exclusions_model->fetch_exclusion_items($inclusion_exclusion_common_id);
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

		$inclusion_exclusion_common_title = $this->input->post('inclusion_exclusion_common_title');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$data = array(

				'inclusion_exclusion_common_title' => $this->input->post('inclusion_exclusion_common_title'),
				'inclusion_exclusion_common_createdby_user_id' => $currentuserid,			
				'inclusion_exclusion_common_createdby_user_name' => $currentusername,			
				'inclusion_exclusion_common_created_date' => $date,			
				'inclusion_exclusion_common_created_time' => $time,			
				'inclusion_exclusion_common_status' => 1
			);
		$insert = $this->Inclusions_exclusions_model->save($data);

		////Inserting inclusion details///

		$inclusion_exclusion_common_id_fk1 = $this->input->post('inclusion_exclusion_common_id_fk1');
		$inclusions_details = $this->input->post('inclusions_details');

		if($insert){

      //foreach ($ledger_id as $key => $value) {
      foreach ($inclusion_exclusion_common_id_fk1 as $key => $value) {

				$data_inclusions_add = array(
					'inclusion_exclusion_common_id_fk1' => $insert,
					'inclusions_details' => $inclusions_details[$key],							
					'inclusions_status' => 1
                    );
				//echo '<pre>'; print_r($data_vendors_boards); exit();
				$result = $this->General_model->add($this->inclusions,$data_inclusions_add);
				// // print_r($data);exit();
				//$response_text = 'Payment policies added successfully';
				
			// }
			 
    }
	}

	////Inserting exclusion details///
		
		$inclusion_exclusion_common_id_fk2 = $this->input->post('inclusion_exclusion_common_id_fk2');
		$exclusions_details = $this->input->post('exclusions_details');
// print_r($inclusion_exclusion_common_id_fk2);die;
		if($insert){

      //foreach ($ledger_id as $key => $value) {
      foreach ($inclusion_exclusion_common_id_fk2 as $key => $value) {

				$data_exclusions_add = array(
					'inclusion_exclusion_common_id_fk2' => $insert,
					'exclusions_details' => $exclusions_details[$key],							
					'exclusions_status' => 1
                    );
				//echo '<pre>'; print_r($data_vendors_boards); exit();
				$result = $this->General_model->add($this->exclusions,$data_exclusions_add);
				// // print_r($data);exit();
				//$response_text = 'Payment policies added successfully';
				
			// }
			 
    }
	}

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added inclusions and exclusions with title: '.$inclusion_exclusion_common_title.'',
				'id_fk' => $insert,
				'activity_type' => 'Inclusion_exclusion_registration',
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
		$data = $this->Inclusions_exclusions_model->get_by_id($id);
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
		
		
		
		$inclusion_exclusion_common_title = $this->input->post('inclusion_exclusion_common_title');
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited inclusions and exclusions with title: '.$inclusion_exclusion_common_title.'',
				'id_fk' => $id,
				'activity_type' => 'Inclusion_exclusion_registration',
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
				
				'inclusion_exclusion_common_title' => $this->input->post('inclusion_exclusion_common_title'),
				// 'inclusion_exclusion_common_createdby_user_id' => $currentuserid,			
				// 'inclusion_exclusion_common_createdby_user_name' => $currentusername,			
				// 'inclusion_exclusion_common_created_date' => $date,			
				// 'inclusion_exclusion_common_created_time' => $time,			
				// 'inclusion_exclusion_common_status' => 1
			);
			// print_r($data);exit();
		$this->Inclusions_exclusions_model->update(array('inclusion_exclusion_common_id' => $this->input->post('id')), $data);

		
		////// Inclusion edit ///

		$inclusions_id = $this->input->post('inclusions_id');
		$inclusion_exclusion_common_id_fk1 = $this->input->post('inclusion_exclusion_common_id_fk1');
		$inclusions_details = $this->input->post('inclusions_details');
		
		$itemCount=count($this->input->post('inclusion_exclusion_common_id_fk1'));	
				
		$count=count($this->input->post('inclusions_id'));
// echo $itemCount;die;
		$limit=$itemCount-$count;
		
		if($count==$itemCount)
		{
			
			//echo "hh";die;

			//foreach ($ledger_id as $key => $value) {
			foreach ($inclusions_id as $key => $value) {		
			
			$emp_his_pk = $value;
			
			$data_inclusions_item_details_update = array(
					'inclusion_exclusion_common_id_fk1' => $id,
					'inclusions_details' => $inclusions_details[$key],							
					'inclusions_status' => 1
					);
					//echo '<pre>'; print_r($data_vendors_boards); exit();
					$result = $this->General_model->update($this->inclusions,$data_inclusions_item_details_update,'inclusions_id',$emp_his_pk);
                  
                  		// by dev team NB
                  		$removed_inclusion_item_ids = $this->input->post('removed_inclusions_ids');
                  		if(!empty($removed_inclusion_item_ids) && $removed_inclusion_item_ids != '') {
                          $this->General_model->delete_in($this->inclusions, 'inclusions_id', $removed_inclusion_item_ids);
                        }
                  		// by dev team NB end
                  
					// // print_r($data);exit();
					$response_text = 'Inclusions and exclusions details updated  successfully';
					
				// }
				 
			}
		}
		
		else{	
			
			//************** NEW INCLUSIONS DATA ****************//
// echo "jkk";die;

			//foreach ($ledger_id as $key => $value) {
			foreach ($inclusion_exclusion_common_id_fk1 as $key => $value) {
				
			
			$data_inclusions_item_details_add_fromedit = array(
					'inclusion_exclusion_common_id_fk1' => $id,
					'inclusions_details' => $inclusions_details[$key],							
					'inclusions_status' => 1
                    );
					//echo '<pre>'; print_r($data_vendors_boards); exit();
                  	
                  		// edited by dev team NB
                  		if (isset($inclusions_id[$key])) { 
                            // $result = $this->General_model->add($this->vendors_boards,$data_vendors_boards);
                            $result = $this->General_model->update($this->inclusions, $data_inclusions_item_details_add_fromedit, 'inclusions_id', $inclusions_id[$key]);
                        } else {
                            $result = $this->General_model->add($this->inclusions, $data_inclusions_item_details_add_fromedit);
                        }
					
                  		$removed_inclusion_item_ids = $this->input->post('removed_inclusions_ids');
                  		if(!empty($removed_inclusion_item_ids) && $removed_inclusion_item_ids != '') {
                          $this->General_model->delete_in($this->inclusions, 'inclusions_id', $removed_inclusion_item_ids);
                        }
                  		// edited by dev team NB end
                  
					// // print_r($data);exit();
					$response_text = 'Inclusions and exclusions details added  successfully';
					
				// }
				 
			}
    }


    ////// Exclusion edit ///

		$exclusions_id = $this->input->post('exclusions_id');
		$inclusion_exclusion_common_id_fk2 = $this->input->post('inclusion_exclusion_common_id_fk2');
		$exclusions_details = $this->input->post('exclusions_details');
		
		$itemCount=count($this->input->post('inclusion_exclusion_common_id_fk2'));	
				
		$count=count($this->input->post('exclusions_id'));
// echo $itemCount;die;
		$limit=$itemCount-$count;
		
		if($count==$itemCount)
		{
			
			//echo "hh";die;

			//foreach ($ledger_id as $key => $value) {
			foreach ($exclusions_id as $key => $value) {		
			
			$emp_his_pk = $value;
			
			$data_exclusions_item_details_update = array(
					'inclusion_exclusion_common_id_fk2' => $id,
					'exclusions_details' => $exclusions_details[$key],							
					'exclusions_status' => 1
					);
					//echo '<pre>'; print_r($data_vendors_boards); exit();
					$result = $this->General_model->update($this->exclusions,$data_exclusions_item_details_update,'exclusions_id',$emp_his_pk);
                  
                  		// by dev team NB
                  		$removed_exclusion_item_ids = $this->input->post('removed_exclusions_ids');
                  		if(!empty($removed_exclusion_item_ids) && $removed_exclusion_item_ids != '') {
                          $this->General_model->delete_in($this->exclusions, 'exclusions_id', $removed_exclusion_item_ids);
                        }
                  		// by dev team NB end
                  
					// // print_r($data);exit();
					$response_text = 'Inclusions and exclusions details updated  successfully';
					
				// }
				 
			}
		}
		
		else{	
			
			//************** NEW EXCLUSIONS DATA ****************//
// echo "jkk";die;

			//foreach ($ledger_id as $key => $value) {
			foreach ($inclusion_exclusion_common_id_fk2 as $key => $value) {
				
			
			$data_exclusions_item_details_add_fromedit = array(
					'inclusion_exclusion_common_id_fk2' => $id,
					'exclusions_details' => $exclusions_details[$key],							
					'exclusions_status' => 1
                    );
					//echo '<pre>'; print_r($data_vendors_boards); exit();
                  	
                  		// edited by dev team NB
                  		if (isset($exclusions_id[$key])) { 
                            // $result = $this->General_model->add($this->vendors_boards,$data_vendors_boards);
                            $result = $this->General_model->update($this->exclusions, $data_exclusions_item_details_add_fromedit, 'exclusions_id', $exclusions_id[$key]);
                        } else {
                            $result = $this->General_model->add($this->exclusions, $data_exclusions_item_details_add_fromedit);
                        }
					
                  		$removed_exclusion_item_ids = $this->input->post('removed_exclusions_ids');
                  		if(!empty($removed_exclusion_item_ids) && $removed_exclusion_item_ids != '') {
                          $this->General_model->delete_in($this->exclusions, 'exclusions_id', $removed_exclusion_item_ids);
                        }
                  		// edited by dev team NB end
                  
					// // print_r($data);exit();
					$response_text = 'Inclusions and exclusions details added  successfully';
					
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

		$updateData = array('inclusion_exclusion_common_status' => 0);
		
		$this->Payment_policies_model->update(array('inclusion_exclusion_common_id' => $this->input->post('id')), $updateData);

		$inclusion_exclusion_common_title = $this->input->post('inclusion_exclusion_common_title');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted inclusions and exclusions with title: '.$inclusion_exclusion_common_title.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Inclusion_exclusion_registration',
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

		$title = trim($this->input->post('inclusion_exclusion_common_title'));

		if ($title == '') {
			$data['inputerror'][] = 'inclusion_exclusion_common_title';
			$data['error_string'][] = 'Title is required';
			$data['status'] = FALSE;
		}

		$inclusions_details = $this->input->post('inclusions_details');
		if (empty($inclusions_details) || !is_array($inclusions_details)) {
			$data['inputerror'][] = 'inclusions_details[1]';
			$data['error_string'][] = 'At least one inclusion is required';
			$data['status'] = FALSE;
		} else {
			foreach ($inclusions_details as $key => $value) {
				if (trim($value) == '') {
					$data['inputerror'][] = 'inclusions_details['.$key.']';
					$data['error_string'][] = 'Inclusion is required';
					$data['status'] = FALSE;
				}
			}
		}

		$exclusions_details = $this->input->post('exclusions_details');
		if (empty($exclusions_details) || !is_array($exclusions_details)) {
			$data['inputerror'][] = 'exclusions_details[1]';
			$data['error_string'][] = 'At least one exclusion is required';
			$data['status'] = FALSE;
		} else {
			foreach ($exclusions_details as $key => $value) {
				if (trim($value) == '') {
					$data['inputerror'][] = 'exclusions_details['.$key.']';
					$data['error_string'][] = 'Exclusion is required';
					$data['status'] = FALSE;
				}
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}
	
}
?>