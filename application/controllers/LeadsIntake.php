<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class LeadsIntake extends MY_Controller {
	public $table = 'leads';
	public $guset_count_details = 'guset_count_details';
	public $child_age_break_up = 'child_age_break_up';
	public $activity = 'activity';
	public $b2b_partner = 'b2b_partner';
	public $page  = 'Leads';


	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		// if ($method != 'meta_webhook') {
		// 	if (!$this->session->userdata('logged_in')) {
		// 		redirect('login');
		// 	}
		// }

		$this->currentuserid = $this->session->userdata('user_id');
	    $this->currentusertype = $this->session->userdata('user_type');
			
			
			$this->load->model('General_model');
			$this->load->model('Leads_model');
            $this->load->model('LeadsIntake_model');
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['staff'] = $this->Leads_model->fetch_staff_details();
		$template['users'] = $this->Leads_model->fetch_all_users();
		$template['source'] = $this->Leads_model->fetch_source();
		$template['b2b_partner'] = $this->Leads_model->fetch_b2b_partner();
		$template['country'] = $this->Leads_model->fetch_country();
		$template['priority_status'] = $this->Leads_model->fetch_priority_status();
		$template['stages'] = $this->Leads_model->fetch_stages();
		$template['leads'] = $this->Leads_model->fetch_leads();
		$template['packages'] = $this->Leads_model->fetch_packages_filter();
		$template['ads'] = $this->Leads_model->fetch_meta_ads_list();
		$template['body'] = 'LeadsIntake/list';
		$template['script'] = 'LeadsIntake/script';
		$this->load->view('template', $template);
	}

	

	public function get_b2c(){
		$this->load->model('LeadsIntake_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['leads_number_filter1'] =(isset($_REQUEST['leads_number_filter1']))?$_REQUEST['leads_number_filter1']:'';
		$param['staff_id1'] =(isset($_REQUEST['staff_id1']))?$_REQUEST['staff_id1']:'';
		$param['source_id1'] =(isset($_REQUEST['source_id1']))?$_REQUEST['source_id1']:'';
		$param['packages_id1'] =(isset($_REQUEST['packages_id1']))?$_REQUEST['packages_id1']:'';
		$param['country_id1'] =(isset($_REQUEST['country_id1']))?$_REQUEST['country_id1']:'';
		$param['priority_status_id1'] =(isset($_REQUEST['priority_status_id1']))?$_REQUEST['priority_status_id1']:'';
		$param['stages_id1'] =(isset($_REQUEST['stages_id1']))?$_REQUEST['stages_id1']:'';
		$param['lead_type1'] =(isset($_REQUEST['lead_type1']))?$_REQUEST['lead_type1']:'';
		$param['lead_current_status1'] =(isset($_REQUEST['lead_current_status1']))?$_REQUEST['lead_current_status1']:'';
		$param['guest_name_filter1'] =(isset($_REQUEST['guest_name_filter1']))?$_REQUEST['guest_name_filter1']:'';
		$param['whats_number_filter1'] =(isset($_REQUEST['whats_number_filter1']))?$_REQUEST['whats_number_filter1']:'';
		$param['leads_createdby_userid1'] =(isset($_REQUEST['leads_createdby_userid1']))?$_REQUEST['leads_createdby_userid1']:'';
		$leads_start_date1 =(isset($_REQUEST['leads_start_date1']))?$_REQUEST['leads_start_date1']:'';
        $leads_end_date1 =(isset($_REQUEST['leads_end_date1']))?$_REQUEST['leads_end_date1']:'';
		if($leads_start_date1){
            $leads_start_date1 = str_replace('/', '-', $leads_start_date1);
            $param['leads_start_date1'] =  date("Y-m-d",strtotime($leads_start_date1));
        }
       
        if($leads_end_date1){
            $leads_end_date1 = str_replace('/', '-', $leads_end_date1);
            $param['leads_end_date1'] =  date("Y-m-d",strtotime($leads_end_date1));
        }
		$travels_start_date1 =(isset($_REQUEST['travels_start_date1']))?$_REQUEST['travels_start_date1']:'';
        $travels_end_date1 =(isset($_REQUEST['travels_end_date1']))?$_REQUEST['travels_end_date1']:'';
		if($travels_start_date1){
            $travels_start_date1 = str_replace('/', '-', $travels_start_date1);
            $param['travels_start_date1'] =  date("Y-m-d",strtotime($travels_start_date1));
        }
       
        if($travels_end_date1){
            $travels_end_date1 = str_replace('/', '-', $travels_end_date1);
            $param['travels_end_date1'] =  date("Y-m-d",strtotime($travels_end_date1));
        }
		
		
    	$data = $this->LeadsIntake_model->getManualB2CLeadsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	
	public function get_meta(){
		$this->load->model('LeadsIntake_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['staff_id2'] =(isset($_REQUEST['staff_id2']))?$_REQUEST['staff_id2']:'';
		$param['source_id2'] =(isset($_REQUEST['source_id2']))?$_REQUEST['source_id2']:'';
		$param['packages_id2'] =(isset($_REQUEST['packages_id2']))?$_REQUEST['packages_id2']:'';
		$param['facebook_ads'] =(isset($_REQUEST['facebook_ads']))?$_REQUEST['facebook_ads']:'';
		$param['country_id2'] =(isset($_REQUEST['country_id2']))?$_REQUEST['country_id2']:'';
		$param['priority_status_id2'] =(isset($_REQUEST['priority_status_id2']))?$_REQUEST['priority_status_id2']:'';
		$param['stages_id2'] =(isset($_REQUEST['stages_id2']))?$_REQUEST['stages_id2']:'';
		$param['lead_current_status2'] =(isset($_REQUEST['lead_current_status2']))?$_REQUEST['lead_current_status2']:'';
		$param['lead_type2'] =(isset($_REQUEST['lead_type2']))?$_REQUEST['lead_type2']:'';
		$param['guest_name_filter2'] =(isset($_REQUEST['guest_name_filter2']))?$_REQUEST['guest_name_filter2']:'';
		$param['whats_number_filter2'] =(isset($_REQUEST['whats_number_filter2']))?$_REQUEST['whats_number_filter2']:'';
		$param['leads_createdby_userid2'] =(isset($_REQUEST['leads_createdby_userid2']))?$_REQUEST['leads_createdby_userid2']:'';
		$leads_start_date2 =(isset($_REQUEST['leads_start_date2']))?$_REQUEST['leads_start_date2']:'';
        $leads_end_date2 =(isset($_REQUEST['leads_end_date2']))?$_REQUEST['leads_end_date2']:'';
		if($leads_start_date2){
            $leads_start_date2 = str_replace('/', '-', $leads_start_date2);
            $param['leads_start_date2'] =  date("Y-m-d",strtotime($leads_start_date2));
        }
       
        if($leads_end_date2){
            $leads_end_date2 = str_replace('/', '-', $leads_end_date2);
            $param['leads_end_date2'] =  date("Y-m-d",strtotime($leads_end_date2));
        }
		$travels_start_date2 =(isset($_REQUEST['travels_start_date2']))?$_REQUEST['travels_start_date2']:'';
        $travels_end_date2 =(isset($_REQUEST['travels_end_date2']))?$_REQUEST['travels_end_date2']:'';
		if($travels_start_date2){
            $travels_start_date2 = str_replace('/', '-', $travels_start_date2);
            $param['travels_start_date2'] =  date("Y-m-d",strtotime($travels_start_date2));
        }
       
        if($travels_end_date2){
            $travels_end_date2 = str_replace('/', '-', $travels_end_date2);
            $param['travels_end_date2'] =  date("Y-m-d",strtotime($travels_end_date2));
        }
		
		
    	$data = $this->LeadsIntake_model->getMetaLeadsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

	public function get_b2b(){
		$this->load->model('LeadsIntake_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['agent_id_filter'] =(isset($_REQUEST['agent_id_filter']))?$_REQUEST['agent_id_filter']:'';
		$param['leads_createdby_userid3'] =(isset($_REQUEST['leads_createdby_userid3']))?$_REQUEST['leads_createdby_userid3']:'';
		$leads_start_date3 =(isset($_REQUEST['leads_start_date3']))?$_REQUEST['leads_start_date3']:'';
        $leads_end_date3 =(isset($_REQUEST['leads_end_date3']))?$_REQUEST['leads_end_date3']:'';
		if($leads_start_date3){
            $leads_start_date3 = str_replace('/', '-', $leads_start_date3);
            $param['leads_start_date3'] =  date("Y-m-d",strtotime($leads_start_date3));
        }
       
        if($leads_end_date3){
            $leads_end_date3 = str_replace('/', '-', $leads_end_date3);
            $param['leads_end_date3'] =  date("Y-m-d",strtotime($leads_end_date3));
        }
		
		
    	$data = $this->LeadsIntake_model->getB2BLeadsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

}

?>