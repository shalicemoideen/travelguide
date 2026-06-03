<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Roles extends MY_Controller {
	public $roles = 'roles';
	public $roles_privilege = 'roles_privilege';
	public $activity = 'activity';
	public $page  = 'Roles';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
       $this->currentuserid = $this->session->userdata('user_id');
       $this->currentusertype = $this->session->userdata('user_type');
       // $this->user_role_add = $this->session->userdata('user_role_add');
       // $this->user_role_edit = $this->session->userdata('user_role_edit');
       // $this->user_role_delete = $this->session->userdata('user_role_delete');
		
        $this->load->model('General_model');
        $this->load->model('Roles_model');
       
       
        
	}
	
	
	public function index()
	{
		$template['currentuserid'] = $this->currentuserid;
		$template['currentusertype'] = $this->currentusertype;
		// $template['user_role_add'] = $this->user_role_add;
		// $template['user_role_edit'] = $this->user_role_edit;
		// $template['user_role_delete'] = $this->user_role_delete;
		
		$template['company'] = $this->Roles_model->fetch_company();
		$template['staff'] = $this->Roles_model->fetch_staff_details();
		$template['roles'] = $this->Roles_model->fetch_role_details();
		$template['body'] = 'Roles/list';
		$template['script'] = 'Roles/script';
		$this->load->view('template', $template);
	}
	
	public function add(){
            
		$this->form_validation->set_rules('roles_name', 'Name', 'required');
		if ($this->form_validation->run() == FALSE) {
			$template['currentuserid'] = $this->currentuserid;
			$template['currentusertype'] = $this->currentusertype;
			
			$currentuserid = $this->session->userdata('user_id');
			$currentusertype = $this->session->userdata('user_type');
			$template['company'] = $this->Roles_model->fetch_company();
			$template['body'] = 'Roles/add';
			$template['script'] = 'Roles/script';
			$this->load->view('template', $template);
		}
		else{
			$leads_add = $this->input->post('leads_add');
			if($leads_add == NULL){
				$leads_add ="N";
			}
			
			$leads_edit = $this->input->post('leads_edit');
			if($leads_edit == NULL){
				$leads_edit ="N";
			}
			$leads_view = $this->input->post('leads_view');
			if($leads_view == NULL){
				$leads_view ="N";
			}
			$leads_delete = $this->input->post('leads_delete');
			if($leads_delete == NULL){
				$leads_delete ="N";
			}
			
			$customer_add = $this->input->post('customer_add');
			if($customer_add == NULL){
				$customer_add ="N";
			}
			$customer_edit = $this->input->post('customer_edit');
			if($customer_edit == NULL){
				$customer_edit ="N";
			}
			$customer_view = $this->input->post('customer_view');
			if($customer_view == NULL){
				$customer_view ="N";
			}
			
			$customer_delete = $this->input->post('customer_delete');
			if($customer_delete == NULL){
				$customer_delete ="N";
			}
			
			$proposal_add = $this->input->post('proposal_add');
			if($proposal_add == NULL){
				$proposal_add ="N";
			}
			$proposal_edit = $this->input->post('proposal_edit');
			if($proposal_edit == NULL){
				$proposal_edit ="N";
			}
			$proposal_view = $this->input->post('proposal_view');
			if($proposal_view == NULL){
				$proposal_view ="N";
			}
			
			$proposal_delete = $this->input->post('proposal_delete');
			if($proposal_delete == NULL){
				$proposal_delete ="N";
			}
			$estimate_add = $this->input->post('estimate_add');
			if($estimate_add == NULL){
				$estimate_add ="N";
			}
			$estimate_edit = $this->input->post('estimate_edit');
			if($estimate_edit == NULL){
				$estimate_edit ="N";
			}
			$estimate_view = $this->input->post('estimate_view');
			if($estimate_view == NULL){
				$estimate_view ="N";
			}
			$estimate_delete = $this->input->post('estimate_delete');
			if($estimate_delete == NULL){
				$estimate_delete ="N";
			}
			$invoice_add = $this->input->post('invoice_add');
			if($invoice_add == NULL){
				$invoice_add ="N";
			}
			//enquiry details
			$invoice_edit = $this->input->post('invoice_edit');
			if($invoice_edit == NULL){
				$invoice_edit ="N";
			}
			$invoice_view = $this->input->post('invoice_view');
			if($invoice_view == NULL){
				$invoice_view ="N";
			}
			$invoice_delete = $this->input->post('invoice_delete');
			if($invoice_delete == NULL){
				$invoice_delete ="N";
			}
			$item_registration_add = $this->input->post('item_registration_add');
			if($item_registration_add == NULL){
				$item_registration_add ="N";
			}
			//Quotation Details
			$item_registration_edit = $this->input->post('item_registration_edit');
			if($item_registration_edit == NULL){
				$item_registration_edit ="N";
			}
			$item_registration_view = $this->input->post('item_registration_view');
			if($item_registration_view == NULL){
				$item_registration_view ="N";
			}
			$item_registration_delete = $this->input->post('item_registration_delete');
			if($item_registration_delete == NULL){
				$item_registration_delete ="N";
			}
			$support_add = $this->input->post('support_add');
			if($support_add == NULL){
				$support_add ="N";
			}
			//Product Details
			$support_edit = $this->input->post('support_edit');
			if($support_edit == NULL){
				$support_edit ="N";
			}
			$support_view = $this->input->post('support_view');
			if($support_view == NULL){
				$support_view ="N";
			}
			$support_delete = $this->input->post('support_delete');
			if($support_delete == NULL){
				$support_delete ="N";
			}
			$news_announcement_add = $this->input->post('news_announcement_add');
			if($news_announcement_add == NULL){
				$news_announcement_add ="N";
			}
			//Category Details 
			$news_announcement_edit = $this->input->post('news_announcement_edit');
			if($news_announcement_edit == NULL){
				$news_announcement_edit ="N";
			}
			$news_announcement_delete = $this->input->post('news_announcement_delete');
			if($news_announcement_delete == NULL){
				$news_announcement_delete ="N";
			}
			$notice_add = $this->input->post('notice_add');
			if($notice_add == NULL){
				$notice_add ="N";
			}
			//Purchase Details
			$notice_edit = $this->input->post('notice_edit');
			if($notice_edit == NULL){
				$notice_edit ="N";
			}
			$notice_delete = $this->input->post('notice_delete');
			if($notice_delete == NULL){
				$notice_delete ="N";
			}
			
			$role_add = $this->input->post('role_add');
			if($role_add == NULL){
				$role_add ="N";
			}
			//Purchase Details
			$role_edit = $this->input->post('role_edit');
			if($role_edit == NULL){
				$role_edit ="N";
			}
			$role_delete = $this->input->post('role_delete');
			if($role_delete == NULL){
				$role_delete ="N";
			}
			
			$payment_add = $this->input->post('payment_add');
			if($payment_add == NULL){
				$payment_add ="N";
			}
			$payment_edit = $this->input->post('payment_edit');
			if($payment_edit == NULL){
				$payment_edit ="N";
			}
			$payment_view = $this->input->post('payment_view');
			if($payment_view == NULL){
				$payment_view ="N";
			}
			$payment_delete = $this->input->post('payment_delete');
			if($payment_delete == NULL){
				$payment_delete ="N";
			}
			$staff_add = $this->input->post('staff_add');
			if($staff_add == NULL){
				$staff_add ="N";
			}
			$staff_edit = $this->input->post('staff_edit');
			if($staff_edit == NULL){
				$staff_edit ="N";
			}
			$staff_view = $this->input->post('staff_view');
			if($staff_view == NULL){
				$staff_view ="N";
			}
			$staff_delete = $this->input->post('staff_delete');
			if($staff_delete == NULL){
				$staff_delete ="N";
			}
			
			
			$menu_dashboard = $this->input->post('menu_dashboard');
			if($menu_dashboard == NULL){
				$menu_dashboard ="N";
			}
			$menu_lead = $this->input->post('menu_lead');
			if($menu_lead == NULL){
				$menu_lead ="N";
			}
			$menu_customer = $this->input->post('menu_customer');
			if($menu_customer == NULL){
				$menu_customer ="N";
			}
			$menu_proposal = $this->input->post('menu_proposal');
			if($menu_proposal == NULL){
				$menu_proposal ="N";
			}
			$menu_estimate = $this->input->post('menu_estimate');
			if($menu_estimate == NULL){
				$menu_estimate ="N";
			}
			$menu_invoice = $this->input->post('menu_invoice');
			if($menu_invoice == NULL){
				$menu_invoice ="N";
			}
			$menu_item_registration = $this->input->post('menu_item_registration');
			if($menu_item_registration == NULL){
				$menu_item_registration ="N";
			}
			// $menu_staff = $this->input->post('menu_staff');
			// if($menu_staff == NULL){
				// $menu_staff ="N";
			// }
			$menu_support = $this->input->post('menu_support');
			if($menu_support == NULL){
				$menu_support ="N";
			}
			$menu_news_announcement = $this->input->post('menu_news_announcement');
			if($menu_news_announcement == NULL){
				$menu_news_announcement ="N";
			}
			$menu_notice = $this->input->post('menu_notice');
			if($menu_notice == NULL){
				$menu_notice ="N";
			}
			$menu_payments = $this->input->post('menu_payments');
			if($menu_payments == NULL){
				$menu_payments ="N";
			}
			$menu_staff = $this->input->post('menu_staff');
			if($menu_staff == NULL){
				$menu_staff ="N";
			}
			
			$menu_setting_role = $this->input->post('menu_setting_role');
			if($menu_setting_role == NULL){
				$menu_setting_role ="N";
			}
			
			
			$currentuserid = $this->session->userdata('user_id');
			$currentusertype = $this->session->userdata('user_type');
			$currentusername = $this->session->userdata('admin_name');
			$this->load->helper('date');
			if(function_exists('date_default_timezone_set')) {

				date_default_timezone_set("Asia/Kolkata");

			}
			$date = date('Y-m-d');
			$time = date('h:i:sa');
						
			$roles_data = array(
				'roles_name'=>$this->input->post('roles_name'),
				'company_user_id_fk_role'=>$this->input->post('user_id_fk'),
				'roles_description'=>$this->input->post('roles_description'),
				'roles_created_by_userid' => $currentuserid,
				'roles_created_by_username' => $currentusername,
				'roles_created_by_usertype' => $currentusertype,
				'roles_created_date' => $date,
				'roles_created_by_time' => $time,
				'roles_status'=>1
				);
				
			$roles_privileges_data_update = array(			
					'leads_add'=>$leads_add,
					'leads_edit' =>$leads_edit,
					'leads_view' =>$leads_view,
					'leads_delete'=>$leads_delete,
					'customer_add'=>$customer_add,
					'customer_edit'=>$customer_edit, //10
					'customer_view'=>$customer_view,
					'customer_delete' =>$customer_delete,
					'proposal_add'=>$proposal_add,
					'proposal_edit'=>$proposal_edit, //10
					'proposal_view'=>$proposal_view,
					'proposal_delete' => $proposal_delete,
					'estimate_add' =>$estimate_add,
					'estimate_edit' =>$estimate_edit,
					'estimate_view' =>$estimate_view,
					'estimate_delete' =>$estimate_delete,
					
					'invoice_add' =>$invoice_add,
					'invoice_edit' =>$invoice_edit,
					//'due' =>$due,
					'invoice_view'=>$invoice_view,
					'invoice_delete'=>$invoice_delete,
					'item_registration_add'=>$item_registration_add,
					'item_registration_edit'=>$item_registration_edit,
					'item_registration_view'=>$item_registration_view,
					'item_registration_delete'=>$item_registration_delete, //20
					'support_add'=>$support_add,
					'support_edit'=>$support_edit,
					'support_view'=>$support_view,
					'support_delete'=>$support_delete,
					'news_announcement_add'=>$news_announcement_add,
					'news_announcement_edit'=>$news_announcement_edit,
					'news_announcement_delete'=>$news_announcement_delete,
					'notice_add'=>$notice_add,
					'notice_edit'=>$notice_edit,
					'notice_delete'=>$notice_delete,
					'role_add'=>$role_add,
					'role_edit'=>$role_edit,
					'role_delete'=>$role_delete,				
					// 'staff_add'=>$staff_add,				
					// 'staff_edit'=>$staff_edit,				
					// 'staff_view'=>$staff_view,				
					// 'staff_delete'=>$staff_delete,				
					'payment_add'=>$payment_add,				
					'payment_edit'=>$payment_edit,				
					'payment_view'=>$payment_view,
					'payment_delete'=>$payment_delete,
					'staff_add'=>$staff_add,				
					'staff_edit'=>$staff_edit,				
					'staff_view'=>$staff_view,
					'staff_delete'=>$staff_delete,
								
					'menu_dashboard'=>$menu_dashboard,				
					'menu_lead'=>$menu_lead,				
					'menu_customer'=>$menu_customer,				
					'menu_proposal'=>$menu_proposal,				
					'menu_estimate'=>$menu_estimate,				
					'menu_invoice'=>$menu_invoice,				
					'menu_item_registration'=>$menu_item_registration,				
					// 'menu_staff'=>$menu_staff,				
					'menu_support'=>$menu_support,				
					'menu_news_announcement'=>$menu_news_announcement,				
					'menu_notice'=>$menu_notice,				
					'menu_payments'=>$menu_payments,				
					'menu_staff'=>$menu_staff,						
					'menu_setting_role'=>$menu_setting_role,						
					'roles_privilege_status'=>1
					);
			//print_r($user_data);
			//exit();
				
			$roles_id = $this->input->post('roles_id');
			if($roles_id){
				$data['roles_id'] = $roles_id;
				 $result = $this->General_model->update($this->roles,$roles_data,'roles_id',$roles_id);
				 $result = $this->General_model->update($this->roles_privilege,$roles_privileges_data_update,'roles_id_fk',$roles_id);
				 $currentuserid = $this->session->userdata('user_id');
				 $currentusertype = $this->session->userdata('user_type');
				 $currentusername = $this->session->userdata('admin_name');
				
				 $ip = $this->input->ip_address();
				 // echo $ip;
				 $date1 = date('Y-m-d h:i:s a', time());
				 $this->load->helper('date');
				 if(function_exists('date_default_timezone_set')) {

						date_default_timezone_set("Asia/Kolkata");

				 }
				 $date = date('Y-m-d');
				 $roles_name = $this->input->post('roles_name');
				 $activity_data = array(
						'id_fk' => $roles_id,
						'activity_type' => 'Role',
						'activity_description' => 'Edited role '.$roles_name.'',
						'activity_ip' => $ip,
						'activity_action' => 'Edit',
						'activity_by_userid' => $currentuserid,
						'activity_by_username' => $currentusername,
						'activity_date_time	' => $date1,
						'activity_date' => $date,
						'activity_status' => 1,
					);
				
				 $this->General_model->add($this->activity,$activity_data);
				 $response_text = 'Role Details updated successfully';
			}    
			else{
				$roles_id1 = $this->General_model->add_returnID($this->roles,$roles_data);
				
				$currentuserid = $this->session->userdata('user_id');
				$currentusertype = $this->session->userdata('user_type');
				$currentusername = $this->session->userdata('admin_name');
				
				$ip = $this->input->ip_address();
				// echo $ip;
				$date1 = date('Y-m-d h:i:s a', time());
				$this->load->helper('date');
				if(function_exists('date_default_timezone_set')) {

					date_default_timezone_set("Asia/Kolkata");

				}
				$date = date('Y-m-d');
				$roles_name = $this->input->post('roles_name');
				$activity_data = array(
						'id_fk' => $roles_id1,
						'activity_type' => 'Role',
						'activity_description' => 'Added role '.$roles_name.'',
						'activity_ip' => $ip,
						'activity_action' => 'Add',
						'activity_by_userid' => $currentuserid,
						'activity_by_username' => $currentusername,
						'activity_date_time	' => $date1,
						'activity_date' => $date,
						'activity_status' => 1,
					);
				
				$this->General_model->add($this->activity,$activity_data);
		
				if($roles_id1){
					$roles_privileges_data = array(			
					'roles_id_fk'=>$roles_id1,
					'leads_add'=>$leads_add,
					'leads_edit' =>$leads_edit,
					'leads_view' =>$leads_view,
					'leads_delete'=>$leads_delete,
					'customer_add'=>$customer_add,
					'customer_edit'=>$customer_edit, //10
					'customer_view'=>$customer_view,
					'customer_delete' =>$customer_delete,
					'proposal_add'=>$proposal_add,
					'proposal_edit'=>$proposal_edit, //10
					'proposal_view'=>$proposal_view,
					'proposal_delete' => $proposal_delete,
					'estimate_add' =>$estimate_add,
					'estimate_edit' =>$estimate_edit,
					'estimate_view' =>$estimate_view,
					'estimate_delete' =>$estimate_delete,
					
					'invoice_add' =>$invoice_add,
					'invoice_edit' =>$invoice_edit,
					//'due' =>$due,
					'invoice_view'=>$invoice_view,
					'invoice_delete'=>$invoice_delete,
					'item_registration_add'=>$item_registration_add,
					'item_registration_edit'=>$item_registration_edit,
					'item_registration_view'=>$item_registration_view,
					'item_registration_delete'=>$item_registration_delete, //20
					'support_add'=>$support_add,
					'support_edit'=>$support_edit,
					'support_view'=>$support_view,
					'support_delete'=>$support_delete,
					'news_announcement_add'=>$news_announcement_add,
					'news_announcement_edit'=>$news_announcement_edit,
					'news_announcement_delete'=>$news_announcement_delete,
					'notice_add'=>$notice_add,
					'notice_edit'=>$notice_edit,
					'notice_delete'=>$notice_delete,
					'role_add'=>$role_add,
					'role_edit'=>$role_edit,
					'role_delete'=>$role_delete,	
					// 'staff_add'=>$staff_add,				
					// 'staff_edit'=>$staff_edit,				
					// 'staff_view'=>$staff_view,				
					// 'staff_delete'=>$staff_delete,				
					'payment_add'=>$payment_add,				
					'payment_edit'=>$payment_edit,				
					'payment_view'=>$payment_view,
					'payment_delete'=>$payment_delete,
					'staff_add'=>$staff_add,				
					'staff_edit'=>$staff_edit,				
					'staff_view'=>$staff_view,
					'staff_delete'=>$staff_delete,
								
					'menu_dashboard'=>$menu_dashboard,				
					'menu_lead'=>$menu_lead,				
					'menu_customer'=>$menu_customer,				
					'menu_proposal'=>$menu_proposal,				
					'menu_estimate'=>$menu_estimate,				
					'menu_invoice'=>$menu_invoice,				
					'menu_item_registration'=>$menu_item_registration,				
					// 'menu_staff'=>$menu_staff,				
					'menu_support'=>$menu_support,				
					'menu_news_announcement'=>$menu_news_announcement,				
					'menu_notice'=>$menu_notice,				
					'menu_payments'=>$menu_payments,				
					'menu_staff'=>$menu_staff,
					'menu_setting_role'=>$menu_setting_role,
					// 'menu_report_activities'=>$menu_report_activities,	
					'roles_privilege_status'=>1
					);
					
					$result = $this->General_model->add($this->roles_privilege,$roles_privileges_data);
					
					$response_text = 'Role Details added  successfully';
				}
			}
			if($result){
			$this->session->set_flashdata('response', "{&quot;text&quot;:&quot;$response_text&quot;,&quot;layout&quot;:&quot;topRight&quot;,&quot;type&quot;:&quot;success&quot;}");
		}
		else{
			$this->session->set_flashdata('response', '{&quot;text&quot;:&quot;Something went wrong,please try again later&quot;,&quot;layout&quot;:&quot;bottomRight&quot;,&quot;type&quot;:&quot;error&quot;}');
		}
			//print_r($user_data);
			
		   // exit();
			redirect('/Roles/', 'refresh');
		}
       }
     
	public function get(){
		$this->load->model('Roles_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['roles_id'] =(isset($_REQUEST['roles_id']))?$_REQUEST['roles_id']:'';
		$param['company_user_id_fk_role'] =(isset($_REQUEST['company_user_id_fk_role']))?$_REQUEST['company_user_id_fk_role']:'';
		$param['roles_created_by_userid'] =(isset($_REQUEST['roles_created_by_userid']))?$_REQUEST['roles_created_by_userid']:'';
		
    	$data = $this->Roles_model->getRolesTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

	public function edit($roles_id){
		$template['currentuserid'] = $this->currentuserid;
		$template['currentusertype'] = $this->currentusertype;
		
		$template['company'] = $this->Roles_model->fetch_company();
		$template['records'] = $this->Roles_model->Roledetails_row($roles_id);
		
		$template['body'] = 'Roles/add';
		$template['script'] = 'Roles/script';
    	$this->load->view('template', $template);
		
	}
    
	public function ajax_edit($id)
	{
		$data = $this->Roles_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}
	
	
	public function delete()
	{
		
		$updateData1 = array('roles_status' => 0);
		$updateData2 = array('roles_privilege_status' => 0);
		
		$roles_id = $this->input->post('id');
		
		$this->Roles_model->update(array('roles_id' => $this->input->post('id')), $updateData1);
		$this->General_model->update($this->roles_privilege,$updateData2,'roles_id_fk',$roles_id);
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		$ip = $this->input->ip_address();
		// echo $ip;
		$date1 = date('Y-m-d h:i:s a', time());
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {

			date_default_timezone_set("Asia/Kolkata");

		}
		$date = date('Y-m-d');
		$template['role'] = $this->General_model->get_row($this->roles,'roles_id',$roles_id);

		$roles_name = $template['role']->roles_name;
		
		$activity_data = array(
				'id_fk' => $roles_id,
				'activity_type' => 'Role',
				'activity_description' => 'Deleted role '.$roles_name.'',
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
}
?>