<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Leads extends MY_Controller {
	public $table = 'leads';
	public $guset_count_details = 'guset_count_details';
	public $child_age_break_up = 'child_age_break_up';
	public $activity = 'activity';
	public $b2b_partner = 'b2b_partner';
	public $page  = 'Leads';

	private $meta_verify_token = 'royale_meta_verify_2026';
    private $meta_page_access_token = 'EAAVTcbJT5Q0BRYw1nmZCQYIHrBIaSp1srLCH5atbkaOM9ByWesoJ0ZA1xet4M3XvjIWCpmbFYdI4UZBEFsIyS3MeZCZCnpSowjHYMKZAH0u1dgIhz8n1Pl2kG17GHw948S8doRyZBZB5NI5eiUVcU2PgbgLkJni0hAvHVGk1No98p81sG5u7bY6ZCiFgEn2RZBFDBMwkkgbZCIjKueGpCp9L3jMZBOTO';
	private $whatsapp_access_token = 'EAATNvzmtrb8BRU8029mGRttu2jsK91rEzKv7iowYMDYulHwuvVRmWxDR5VSkIjqgZAlgbn9PRZCoDf0YJN3L19g30gEBLaRwoHlAPA933K68zfcZCpzRxdogEaFodj9vdKPNQhKoN4LuGeQudqTymHZAmGofhvy1UZCZB0zDBgjxzZACZALTA2NIqpP4NohUsQZDZD';
	private $whatsapp_phone_number_id = '1152051051315150';
	private $whatsapp_notify_number = '971581572871'; // single registered number, no ++971 58 157 2871

	// onemonth validity token: EAAVTcbJT5Q0BRS4JGtk6WcFWpSbsJE7xoffOPoOPJvPVVjNxbGztCFmSYwY0Rliy1wQdVVlYVsbeFxDQGGfq5m6ZAV9ppm8fUOHPxyzEsa5xJjrpHThTaGODgn7ZAuaHpfZBSFYjxLmSiE1IXeztZBM5ZAK0KFyz6VPMkvs8VdcOJ9KiOJCJxc5R78bTKRPD3i8rREQ5TrAmXQrj3mqT5
	// newtoken: EAAVTcbJT5Q0BRYw1nmZCQYIHrBIaSp1srLCH5atbkaOM9ByWesoJ0ZA1xet4M3XvjIWCpmbFYdI4UZBEFsIyS3MeZCZCnpSowjHYMKZAH0u1dgIhz8n1Pl2kG17GHw948S8doRyZBZB5NI5eiUVcU2PgbgLkJni0hAvHVGk1No98p81sG5u7bY6ZCiFgEn2RZBFDBMwkkgbZCIjKueGpCp9L3jMZBOTO
	public function __construct()
	{
		parent::__construct();
		$this->load->database();

		$method = $this->router->fetch_method();

		// if ($method != 'meta_webhook') {
		// 	if (!$this->session->userdata('logged_in')) {
		// 		redirect('login');
		// 	}
		// }

		$this->currentuserid = $this->session->userdata('user_id');
			$this->currentusertype = $this->session->userdata('user_type');
			
			
			$this->load->model('General_model');
			$this->load->model('Leads_model');

			$this->config->load('whatsapp');
			$this->load->model('Whatsapp_model');

			$this->meta_verify_token = $this->config->item('meta_verify_token');
			$this->meta_page_access_token = $this->config->item('meta_page_access_token');
	}
	
	// POST /{page-id}/subscribed_apps?subscribed_fields=leadgen&access_token=PAGE_ACCESS_TOKEN
	// GET /{page-id}/subscribed_apps?access_token=PAGE_ACCESS_TOKEN
	// acess token: EAAVTcbJT5Q0BQ8zfKz0PiRGh9jx1tD0DkY7MOBYRrDwEWpzt3SaNlM5aoAbyAM4so1dD75bGzaaXm4fObjvWZCn3SlYsQjYlXQZC9KInGmC4UeeBbZCXsFiqZA7YhAh1zomXeEuvbwrlsg6478j6hGmLUkQyH3i2kCXvf64scNVuo7ZAUGtRpZCaNOlrRHMQOgFS1EieDN7ZBADH8w1dzSwMgChnWbxqaLoXHzaSuPF15g5fqTT4BIeAPOIZAERZCSy8k7mn5ZAYt5VaPcOMTXTb7lmbafGXPyhCUcELfcLgZDZD
// 	{
//   "data": [
//     {
//       "access_token": "EAAVTcbJT5Q0BQzV3dVAS1ytrkiRH9IminywGkQh312oIn9bzTykwElNXvLB93hUaAwjBNZCU1rDsxKM3hBGh2moDEj9E3i3y5hwW1CkZCcgo88zlxxgvXAwZBKmvSE45JnIkOPtT7enfVnMyEbtyubC5dMQaCnS5hK6ZBE7VBkgZBInSlx2CxlV4WhTBNAujykkUuQJUI1CmNI6nm5jQE2SXAhSW7TNCs4ZBqH2bgViWu69JEMQpFwTKQWmdsZD",
//       "category": "Travel company",
//       "category_list": [
//         {
//           "id": "2258",
//           "name": "Travel company"
//         }
//       ],
//       "name": "Royale India Premium Tours",
//       "id": "521436764394620",
//       "tasks": [
//         "ADVERTISE",
//         "ANALYZE",
//         "CREATE_CONTENT",
//         "MESSAGING",
//         "MODERATE",
//         "MANAGE"
//       ]
//     },
//     {
//       "access_token": "EAAVTcbJT5Q0BQy1swQABiqdUMFsTOORzWYM74dql4CZCtmlMOUcBvm3mS02E2D5EzqZB4lHWlWVSMDfTOpQdAcse0g1c1kGFZAZAGmxCaVWuXZCwCpaHkCY9KR8U5G8kgQPswaRhnzhRZBeeYuDOquaxigGGH0WaLcmBUdcZAMoxA7ahkBiI7ZCILUWa0Sar0wsl1ZAfPxWqNLB4lvMxZCiwEIba9OTTfXwQquSUcLwW9KZAp3ObZAogG95czZBX5HQcZD",
//       "category": "Travel company",
//       "category_list": [
//         {
//           "id": "2258",
//           "name": "Travel company"
//         }
//       ],
//       "name": "Royalè India",
//       "id": "333063373223872",
//       "tasks": [
//         "ADVERTISE",
//         "ANALYZE",
//         "CREATE_CONTENT",
//         "MESSAGING",
//         "MODERATE",
//         "MANAGE"
//       ]
//     }
//   ],
//   "paging": {
//     "cursors": {
//       "before": "QVFIU1dFWldRSTV0eHBfeVNRNFdOUm1tVEhvY3lQaXlsLVFaQjhscTBHNFM5WVc4VkI2cHJXY0d4UlI0bTRQUV9rdUxSdy1pWGY3bk5DaFAza0gwdnVseWN3",
//       "after": "QVFIU2gtSDJ4ekY4S2xCajJ4ZAEswdnhRREJWdHQtWU04bjZAqNF85WE4tckZAmNmk1VjJDLXQ3UzhIWndzTExXYUF2MUJ5OW5MYUpwZAUJobHZASem5OQXJGZAHF3"
//     }
//   }
// }
	public function index()
	{
		//$name = 'PERSONAL CASH';
		$template['packages_category'] = $this->Leads_model->fetch_packages_category();
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
		$template['body'] = 'Leads/list';
		$template['script'] = 'Leads/script';
		$this->load->view('template', $template);
	}

	public function get_packages_by_duration()
	{
		$duration = $this->input->post('duration');

		if ($duration <= 0) {
			echo json_encode([]);
			return;
		}

		$this->load->model('Leads_model');
		$packages = $this->Leads_model->fetch_packages($duration);

		echo json_encode($packages);
	}

	// public function get_packages_by_filter()
	// {
	// 	$duration  = $this->input->post('duration');
	// 	$category  = $this->input->post('category');
	// 	$createdby = $this->input->post('createdby');

	// 	$data = $this->Leads_model->fetch_packages($duration, $category, $createdby);

	// 	echo json_encode($data);
	// }

	public function get_packages_by_filter()
	{
		$duration  = $this->input->post('duration');
		$category  = $this->input->post('category');
		$createdby = $this->input->post('createdby');

		if ((int)$duration <= 0 && (int)$category <= 0 && (int)$createdby <= 0) {
			echo json_encode(array());
			return;
		}

		$data = $this->Leads_model->fetch_packages($duration, $category, $createdby);

		echo json_encode($data);
	}

	public function check_package_properties()
	{
		$package_id = (int)$this->input->post('package_id');

		if ($package_id <= 0) {
			echo json_encode(array(
				'status' => false,
				'has_properties' => false,
				'msg' => 'Please select template.'
			));
			return;
		}

		$count = $this->db
			->where('packages_properties_common_packages_id_fk', $package_id)
			->count_all_results('packages_properties_common');

		echo json_encode(array(
			'status' => true,
			'has_properties' => ($count > 0),
			'msg' => ($count > 0) ? '' : 'Selected template does not have properties saved. Please update properties.'
		));
	}

	public function check_lead_active_quotation()
	{
		$lead_id = (int)$this->input->post('lead_id');

		if ($lead_id <= 0) {
			echo json_encode(array(
				'status' => false,
				'has_active_quotation' => false
			));
			return;
		}

		$count = $this->db
			->where('leads_id_fk', $lead_id)
			->where('quotation_current_status !=', 6)
			->where('quotation_status', 1)
			->count_all_results('quotation');

		echo json_encode(array(
			'status' => true,
			'has_active_quotation' => ($count > 0)
		));
	}

	public function ajax_check_lead_travel_details($lead_id)
{
    $lead = $this->db
        ->select('start_date, end_date, duration, package_id_fk')
        ->from('leads')
        ->where('leads_id', (int)$lead_id)
        ->where('leads_status', 1)
        ->get()
        ->row_array();

    if (!$lead) {
        echo json_encode(array(
            'status' => false,
            'message' => 'Lead not found.'
        ));
        return;
    }

    $missing = array();

    // Start Date
    if (
        empty($lead['start_date']) ||
        $lead['start_date'] == '0000-00-00' ||
        $lead['start_date'] == '1970-01-01'
    ) {
        $missing[] = 'Travel Date';
    }

    // Duration
    if (
        empty($lead['duration']) ||
        (int)$lead['duration'] <= 0
    ) {
        $missing[] = 'Duration';
    }

    // End Date
    if (
        empty($lead['end_date']) ||
        $lead['end_date'] == '0000-00-00' ||
        $lead['end_date'] == '1970-01-01'
    ) {
        $missing[] = 'Travel End Date';
    }

    // Package / Template
    if (
        empty($lead['package_id_fk']) ||
        (int)$lead['package_id_fk'] <= 0
    ) {
        $missing[] = 'Template';
    }

    if (!empty($missing)) {
        echo json_encode(array(
            'status' => false,
            'missing' => $missing,
            'message' => 'Missing travel details.'
        ));
        return;
    }

    echo json_encode(array(
        'status' => true
    ));
}

	public function getLeadStageData()
	{
		$lead_id = $this->input->post('lead_id');

		$lead = $this->Leads_model->getLeadStage($lead_id);

		$data = [
			'current_stage_id' => $lead['stage_id_fk'],
			'lead_type' => $lead['lead_type'],
			'stages' => $this->Leads_model->getActiveStages()
		];

		echo json_encode($data);
	}

    public function saveStageFlow()
    {
        $lead_id       = $this->input->post('lead_id');
        $cur_stage     = $this->input->post('stage_id');
        $prev_stage    = $this->input->post('prev_stage_id');
        $description   = $this->input->post('description');

        if($cur_stage == $prev_stage){
            echo json_encode(['status'=>false,'message'=>'Same status cannot be saved']);
            return;
        }

        $this->Leads_model->insertStageFlow(
            $lead_id,
            $cur_stage,
            $prev_stage,
            $description
        );

        // update lead current stage
        $this->Leads_model->updateLeadStage($lead_id,$cur_stage);

        echo json_encode(['status'=>true]);
    }

	// public function getLeadStatusData()
	// {
	// 	$lead_id = $this->input->post('lead_id');

	// 	$lead = $this->Leads_model->getLeadStatus($lead_id);

	// 	$status = 1->In take, 2->Qualified, 3->coverted to trip, 4->Not Qualified, 5->Lost
	// 	$data = [
	// 		'current_status' => $lead['lead_current_status'],
	// 		'lead_type' => $lead['lead_type'],
	// 		'status' => $status
	// 	];

	// 	echo json_encode($data);
	// }

	public function getLeadStatusData()
	{
		$lead_id = $this->input->post('lead_id');
		$lead = $this->Leads_model->getLeadStatus($lead_id);

		// Format the status as an array of objects for the JS loop
		$status = [
			['lead_current_status' => 1, 'status_name' => 'In take'],
			['lead_current_status' => 2, 'status_name' => 'Qualified'],
			['lead_current_status' => 3, 'status_name' => 'Converted to trip'],
			['lead_current_status' => 4, 'status_name' => 'Not Qualified'],
			['lead_current_status' => 5, 'status_name' => 'Lost']
		];

		$data = [
			'current_status' => $lead['lead_current_status'],
			'lead_type' => $lead['lead_type'],
			'status' => $status
		];

		echo json_encode($data);
	}

    public function saveStatusflow()
    {
        $lead_id       = $this->input->post('lead_id');
        $cur_status     = $this->input->post('status');
        $prev_status    = $this->input->post('prev_status');
        $description   = $this->input->post('description');

        if($cur_status == $prev_status){
            echo json_encode(['status'=>false,'message'=>'Same status cannot be saved']);
            return;
        }

        $this->Leads_model->insertStatusFlow(
            $lead_id,
            $cur_status,
            $prev_status,
            $description
        );

        // update lead current stage
        $this->Leads_model->updateLeadStatus($lead_id,$cur_status);

        echo json_encode(['status'=>true]);
    }

	public function getStageHistory() {
		$lead_id = $this->input->post('lead_id');

		$this->load->model('Leads_model');

		$history = $this->Leads_model->get_stage_history($lead_id);

		if($history) {
			echo json_encode([
				'status' => true,
				'history' => $history
			]);
		} else {
			echo json_encode([
				'status' => true,
				'history' => []
			]);
		}
	}

	public function getStatusHistory() {
		$lead_id = $this->input->post('lead_id');

		$this->load->model('Leads_model');

		$history = $this->Leads_model->get_status_history($lead_id);

		if($history) {
			echo json_encode([
				'status' => true,
				'history' => $history
			]);
		} else {
			echo json_encode([
				'status' => true,
				'history' => []
			]);
		}
	}

	public function ajax_view_lead_details($id)
	{
		$data = $this->Leads_model->get_lead_full_details($id);

		if ($data) {
			echo json_encode(array(
				'status' => true,
				'data'   => $data
			));
		} else {
			echo json_encode(array(
				'status'  => false,
				'message' => 'Lead details not found'
			));
		}
	}

public function ajax_guest_accommodation_details($lead_id)
{
    $this->load->model('Leads_model');

    $data = $this->Leads_model->get_guest_accommodation_details($lead_id);

    foreach ($data as $key => $row) {
        $guest_count_id = isset($row['guset_count_details_id_fk']) ? $row['guset_count_details_id_fk'] : 0;

        if ($guest_count_id > 0) {
            $data[$key]['child_age_breakup'] = $this->Leads_model->get_child_age_breakup($guest_count_id);
        } else {
            $data[$key]['child_age_breakup'] = '';
        }
    }

    echo json_encode(array(
        'status' => !empty($data),
        'data'   => $data
    ));
}

	public function get_b2c(){
		$this->load->model('Leads_model');
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
		$param['leads_accomodation_status1'] =(isset($_REQUEST['leads_accomodation_status1']))?$_REQUEST['leads_accomodation_status1']:'';
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
		
		if (!has_permission('LEADS_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

    	$data = $this->Leads_model->getManualB2CLeadsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
	
	public function get_meta(){
		$this->load->model('Leads_model');
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
		$param['leads_accomodation_status2'] =(isset($_REQUEST['leads_accomodation_status2']))?$_REQUEST['leads_accomodation_status2']:'';
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
		
		
    	$data = $this->Leads_model->getMetaLeadsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

	public function get_b2b(){
		$this->load->model('Leads_model');
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
		
		
    	$data = $this->Leads_model->getB2BLeadsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

	public function ajax_add1()
	{
		$this->_validate1();
		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());

		$guest_name = $this->input->post('guest_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		// $start_date = str_replace('/','-', $this->input->post('start_date'));
		// $start_date = date("Y-m-d h:i:s a",strtotime($start_date));

		$start_date_input = $this->input->post('start_date');

		if (!empty($start_date_input)) {

			$start_date_input = str_replace('/', '-', $start_date_input);
			$timestamp = strtotime($start_date_input);

			if ($timestamp && date('Y-m-d', $timestamp) !== '1970-01-01') {
				$start_date = date('Y-m-d', $timestamp);
			} else {
				$start_date = '0000-00-00';
			}

		} else {
			$start_date = '0000-00-00';
		}

		// $end_date = str_replace('/','-', $this->input->post('end_date'));
		// $end_date = date("Y-m-d h:i:s a",strtotime($end_date));

		$end_date = $this->input->post('end_date');

		$last_insert_id_leads = $this->Leads_model->last_id_leads();
		if(empty($last_insert_id_leads)){ $last_id_leads = 0;}
		else{ $last_id_leads = $last_insert_id_leads->leads_id; }

		if($last_id_leads == 0){
			$leads_num = 0;
		} else {
			$leads_num = $last_insert_id_leads->leads_id;
		}
		$leads_number = $leads_num+1;
		$leads_number1 = "LD-$leads_number";
		$data_b2c = array(

				'leads_number' => $leads_number1,
				'staff_id_fk' => $this->input->post('staff_id_fk'),
				'source_id_fk' => $this->input->post('source_id_fk'),
				'package_id_fk' => $this->input->post('package_id_fk'),
				'country_id_fk' => $this->input->post('country_id_fk'),
				'whats_number' => $this->input->post('whats_number'),
				'alternative_number' => $this->input->post('alternative_number'),
				'leads_email' => $this->input->post('leads_email'),
				'leads_address' => $this->input->post('leads_address'),
				'priority_status_id_fk' => $this->input->post('priority_status_id_fk'),
				// 'stage_id_fk' => $this->input->post('stage_id_fk'),
				'lead_type' => $this->input->post('lead_type'),
				'guest_name' => $this->input->post('guest_name'),
				'date_type' => $this->input->post('date_type'),			
				'start_date' => $start_date,
				'end_date' => $end_date,
				'duration' => $this->input->post('duration'),
				'leads_package_category_id_fk' => $this->input->post('leads_package_category_id_fk'),
				'package_created_by_staff_id' => $this->input->post('package_created_by_staff_id'),
				'lead_register_date' => $date,
				// 'whats_number' => $this->input->post('whats_number'),
				// 'alternative_number' => $this->input->post('alternative_number'),
				'description' => $this->input->post('description'),		
				'leads_createdby_userid' => $currentuserid,			
				'leads_createdby_username' => $currentusername,			
				'leads_created_date' => $date,			
				'leads_created_time' => $time,		
				'stage_id_fk' => 1,
				'lead_current_status' => 1,
				'leads_status' => 1
			);
		

		$insert = $this->Leads_model->save($data_b2c);
		
		

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added B2C leads: '.$leads_number1.'',
				'id_fk' => $insert,
				'activity_type' => 'Lead_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Add',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,
				'activity_date' => $date,				
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		// echo json_encode(array("status" => TRUE));
		echo json_encode(array(
			"status" => true,
			"lead_id" => $insert
		));
	}

	public function ajax_add2()
	{
		$this->_validate2();
		
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
		
		
		$template['agent'] = $this->General_model->get_row($this->b2b_partner,'b2b_partner_id',$this->input->post('agent_id_fk'));
		$agent_name = $template['agent']->b2b_partner_agent_name;

		$data_b2b = array(

				'agent_id_fk' => $this->input->post('agent_id_fk'),
				'lead_type' => $this->input->post('lead_type_b2b'),
				'total_package_cost' => $this->input->post('total_package_cost'),			
				'expense' => $this->input->post('expense'),
				'margin' => $this->input->post('margin'),
				'description' => $this->input->post('description'),		
				'leads_createdby_userid' => $currentuserid,			
				'leads_createdby_username' => $currentusername,			
				'leads_created_date' => $date,			
				'leads_created_time' => $time,			
				'leads_status' => 1
			);
		
		
		$insert = $this->Leads_model->save($data_b2b);
		
		

		$ip = $this->input->ip_address();
		
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Added B2B leads: '.$agent_name.'',
				'id_fk' => $insert,
				'activity_type' => 'Lead_registration',
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
		$data = $this->Leads_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_get_package_property_categories()
	{
		$package_id = (int)$this->input->get('package_id');
		if (!$package_id) {
			echo json_encode(array('status' => false, 'data' => array()));
			return;
		}

		$rows = $this->Leads_model->get_package_property_categories($package_id);
		echo json_encode(array('status' => true, 'data' => $rows));
	}


	public function ajax_update1()
	{
		$this->_validate1();
		
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
		
		
		$start_date = str_replace('/','-', $this->input->post('start_date'));
		$start_date = date("Y-m-d h:i:s a",strtotime($start_date));

		$start_date_input = $this->input->post('start_date');

		if (!empty($start_date_input)) {

			$start_date_input = str_replace('/', '-', $start_date_input);
			$timestamp = strtotime($start_date_input);

			if ($timestamp && date('Y-m-d', $timestamp) !== '1970-01-01') {
				$start_date = date('Y-m-d', $timestamp);
			} else {
				$start_date = '0000-00-00';
			}

		} else {
			$start_date = '0000-00-00';
		}

		// $end_date = str_replace('/','-', $this->input->post('end_date'));
		// $end_date = date("Y-m-d h:i:s a",strtotime($end_date));

		$end_date = $this->input->post('end_date');

		$guest_name = $this->input->post('guest_name');
		
		
		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited B2C leads: '.$guest_name.'',
				'id_fk' => $id,
				'activity_type' => 'Lead_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Edit',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,	
				'activity_date' => $date,			
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		
		$data_b2c = array(

				// 'leads_number' => $leads_number1,
				'staff_id_fk' => $this->input->post('staff_id_fk'),
				'source_id_fk' => $this->input->post('source_id_fk'),
				'package_id_fk' => $this->input->post('package_id_fk'),
				'country_id_fk' => $this->input->post('country_id_fk'),
				'whats_number' => $this->input->post('whats_number'),
				'alternative_number' => $this->input->post('alternative_number'),
				'leads_email' => $this->input->post('leads_email'),
				'leads_address' => $this->input->post('leads_address'),
				'priority_status_id_fk' => $this->input->post('priority_status_id_fk'),
				// 'stage_id_fk' => $this->input->post('stage_id_fk'),
				'lead_type' => $this->input->post('lead_type'),
				'guest_name' => $this->input->post('guest_name'),
				'date_type' => $this->input->post('date_type'),			
				'start_date' => $start_date,
				'end_date' => $end_date,
				'duration' => $this->input->post('duration'),
				'leads_package_category_id_fk' => $this->input->post('leads_package_category_id_fk'),
				'package_created_by_staff_id' => $this->input->post('package_created_by_staff_id'),
				// 'lead_register_date' => $date,
				// 'whats_number' => $this->input->post('whats_number'),
				// 'alternative_number' => $this->input->post('alternative_number'),
				'description' => $this->input->post('description'),		
				// 'leads_createdby_userid' => $currentuserid,			
				// 'leads_createdby_username' => $currentusername,			
				// 'leads_created_date' => $date,			
				// 'leads_created_time' => $time,		
				// 'stage_id_fk' => 1,
				// 'leads_status' => 1
			);

			

			// print_r($data);exit();



		$this->Leads_model->update(array('leads_id' => $this->input->post('id')), $data_b2c);
		

		
		// echo json_encode(array("status" => TRUE));
		echo json_encode(array(
			"status" => true,
			"lead_id" => $this->input->post('id')
		));
	}

	public function ajax_update2()
	{
		$this->_validate2();
		
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
		
		$template['agent'] = $this->General_model->get_row($this->b2b_partner,'b2b_partner_id',$this->input->post('agent_id_fk'));
		$agent_name = $template['agent']->b2b_partner_agent_name;

		$ip = $this->input->ip_address();
		$id = $this->input->post('id');
		// echo $ip;

		$activity_data = array(
				'activity_description' => 'Edited B2B leads: '.$agent_name.'',
				'id_fk' => $id,
				'activity_type' => 'Lead_registration',
				'activity_ip' => $ip,
				'activity_action' => 'Edit',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,	
				'activity_date' => $date,			
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		

		$data_b2b = array(

				'agent_id_fk' => $this->input->post('agent_id_fk'),
				'lead_type' => $this->input->post('lead_type_b2b'),
				'total_package_cost' => $this->input->post('total_package_cost'),			
				'expense' => $this->input->post('expense'),
				'margin' => $this->input->post('margin'),
				'description' => $this->input->post('description'),
				// 'whats_number' => $this->input->post('whats_number'),
				// 'alternative_number' => $this->input->post('alternative_number'),		
				// 'leads_createdby_userid' => $currentuserid,			
				// 'leads_createdby_username' => $currentusername,			
				// 'leads_created_date' => $date,			
				// 'leads_created_time' => $time,			
				// 'leads_status' => 1
			);
			// print_r($data_b2b);exit();

			
		$this->Leads_model->update(array('leads_id' => $this->input->post('id')), $data_b2b);
		
		
		echo json_encode(array("status" => TRUE));
	}

	/**
     * Meta webhook endpoint
     * Callback URL example:
     * https://yourdomain.com/index.php/Leads/meta_webhook
     */

public function meta_webhook()
{
    $log_file = FCPATH . 'meta_test_log.txt';
    $raw_input = file_get_contents('php://input');

    file_put_contents($log_file, date('Y-m-d H:i:s') . " | HIT START\n", FILE_APPEND);
    file_put_contents($log_file, date('Y-m-d H:i:s') . " | METHOD: " . $_SERVER['REQUEST_METHOD'] . "\n", FILE_APPEND);
    file_put_contents($log_file, date('Y-m-d H:i:s') . " | RAW: " . $raw_input . "\n\n", FILE_APPEND);

    if ($_SERVER['REQUEST_METHOD'] === 'GET') {
        file_put_contents($log_file, date('Y-m-d H:i:s') . " | GET VERIFICATION\n", FILE_APPEND);

        $mode = $this->input->get('hub_mode');
        if (!$mode) $mode = $this->input->get('hub.mode');

        $token = $this->input->get('hub_verify_token');
        if (!$token) $token = $this->input->get('hub.verify_token');

        $challenge = $this->input->get('hub_challenge');
        if (!$challenge) $challenge = $this->input->get('hub.challenge');

        if ($mode === 'subscribe' && $token === $this->meta_verify_token) {
            file_put_contents($log_file, date('Y-m-d H:i:s') . " | GET VERIFIED OK\n", FILE_APPEND);
            echo $challenge;
            exit;
        }

        file_put_contents($log_file, date('Y-m-d H:i:s') . " | GET VERIFY FAILED\n", FILE_APPEND);
        header('HTTP/1.1 403 Forbidden');
        echo 'Webhook verification failed';
        exit;
    }

    $payload = json_decode($raw_input, true);

    if (empty($payload) || !isset($payload['entry'])) {
        file_put_contents($log_file, date('Y-m-d H:i:s') . " | NO ENTRY FOUND\n", FILE_APPEND);
        echo 'EVENT_RECEIVED';
        exit;
    }

    foreach ($payload['entry'] as $entry) {
        if (!isset($entry['changes']) || !is_array($entry['changes'])) {
            file_put_contents($log_file, date('Y-m-d H:i:s') . " | NO CHANGES FOUND\n", FILE_APPEND);
            continue;
        }

        foreach ($entry['changes'] as $change) {
            if (!isset($change['field']) || $change['field'] !== 'leadgen') {
                file_put_contents($log_file, date('Y-m-d H:i:s') . " | NON-LEADGEN CHANGE\n", FILE_APPEND);
                continue;
            }

            $value = isset($change['value']) ? $change['value'] : array();

            $leadgen_id = isset($value['leadgen_id']) ? $value['leadgen_id'] : '';
            $page_id    = isset($value['page_id']) ? $value['page_id'] : '';
            $form_id    = isset($value['form_id']) ? $value['form_id'] : '';
            $ad_id      = isset($value['ad_id']) ? $value['ad_id'] : '';

            file_put_contents($log_file, date('Y-m-d H:i:s') . " | leadgen_id: " . $leadgen_id . "\n", FILE_APPEND);

            if ($leadgen_id === '') {
                file_put_contents($log_file, date('Y-m-d H:i:s') . " | EMPTY LEADGEN ID\n", FILE_APPEND);
                continue;
            }

            $insert_log = $this->db->insert('meta_lead_logs', array(
                'leadgen_id'   => $leadgen_id,
                'page_id'      => $page_id,
                'form_id'      => $form_id,
                'ad_id'        => $ad_id,
                'raw_payload'  => json_encode($value),
                'status'       => 'received',
                'error_message'=> NULL,
                'created_at'   => date('Y-m-d H:i:s')
            ));

            file_put_contents(
                $log_file,
                date('Y-m-d H:i:s') . " | meta_lead_logs insert: " . ($insert_log ? 'SUCCESS' : 'FAILED') . " | " . json_encode($this->db->error()) . "\n",
                FILE_APPEND
            );

            $leadData = $this->fetch_meta_lead($leadgen_id);

            file_put_contents(
                $log_file,
                date('Y-m-d H:i:s') . " | fetch_meta_lead: " . json_encode($leadData) . "\n",
                FILE_APPEND
            );

            if (!$leadData || isset($leadData['error'])) {
                $this->db->where('leadgen_id', $leadgen_id);
                $this->db->update('meta_lead_logs', array(
                    'status'        => 'error',
                    'error_message' => json_encode($leadData)
                ));

                file_put_contents($log_file, date('Y-m-d H:i:s') . " | FETCH FAILED\n", FILE_APPEND);
                continue;
            }

            $saved = $this->save_meta_lead_to_leads_table($leadData, $page_id, $form_id, $ad_id);

            file_put_contents($log_file, date('Y-m-d H:i:s') . " | leads insert result: " . ($saved ? 'SUCCESS' : 'FAILED') . "\n", FILE_APPEND);

            $this->db->where('leadgen_id', $leadgen_id);
            $this->db->update('meta_lead_logs', array(
                'status'        => $saved ? 'saved' : 'error',
                'error_message' => $saved ? NULL : 'Failed to insert into leads table'
            ));
        }
    }

    file_put_contents($log_file, date('Y-m-d H:i:s') . " | END\n\n", FILE_APPEND);

    echo 'EVENT_RECEIVED';
    exit;
}

private function get_staff_whatsapp_number($staff_id)
{
    $row = $this->db
        ->select('user_phone_number')
        ->from('user_details')
        ->where('user_id', $staff_id)
        ->where('user_status', 1)
        ->get()
        ->row_array();

    if (!$row || empty($row['user_phone_number'])) {
        return '';
    }

    return preg_replace('/[^0-9]/', '', $row['user_phone_number']);
}

private function build_meta_lead_whatsapp_message($mapped)
{
    $skip = array(
        'Source',
        'Leadgen ID',
        'Page ID',
        'Form ID',
        'Ad ID',
        'source',
        'leadgen_id',
        'page_id',
        'form_id',
        'ad_id'
    );

    $lines = array();

    foreach ($mapped as $key => $value) {

        if (in_array($key, $skip)) {
            continue;
        }

        if ($value === '') {
            $value = '-';
        }

        $label = ucwords(str_replace('_', ' ', $key));
        $lines[] = $label . ': ' . $value;
    }

    if (empty($lines)) {
        return 'No field data found';
    }

    return implode("\n", $lines);
}

private function get_staff_name($staff_id)
{
    $row = $this->db
        ->select('admin_name')
        ->from('user_details')
        ->where('user_id', $staff_id)
        ->get()
        ->row_array();

    return $row ? $row['admin_name'] : 'Staff';
}

private function get_mapped_value($mapped, $keys, $default = '-')
{
    foreach ($keys as $key) {
        if (isset($mapped[$key]) && trim($mapped[$key]) !== '') {
            return trim($mapped[$key]);
        }
    }

    return $default;
}

private function send_meta_lead_to_staff_whatsapp($staff_id, $mapped, $lead_number)
{
    $staff_number = $this->get_staff_whatsapp_number($staff_id);

    if ($staff_number == '') {
        return false;
    }

    $templateName = $this->config->item('meta_lead_template_name');
    $languageCode = $this->config->item('meta_lead_template_language');

    $staff_name  = $this->get_staff_name($staff_id);
    $guest_name  = $this->get_mapped_value($mapped, array('full_name', 'first_name', 'name'), 'Meta Lead');
    $phone       = $this->get_mapped_value($mapped, array('phone_number', 'phone'), '-');
    $city        = $this->get_mapped_value($mapped, array('city'), '-');
    $travel_date = $this->get_mapped_value($mapped, array('travel_date', 'travel_date?'), '-');
    $duration    = $this->get_mapped_value($mapped, array('how_many_days_planning', 'how_many_days_planning?', 'duration'), '-');

    $all_fields = $this->build_meta_lead_whatsapp_message($mapped);
    if (trim($all_fields) == '') {
        $all_fields = '-';
    }

    $params = array(
        $staff_name,   // {{1}}
        $lead_number,  // {{2}}
        $guest_name,   // {{3}}
        $phone,        // {{4}}
        $city,         // {{5}}
        $travel_date,  // {{6}}
        $duration,     // {{7}}
        $all_fields    // {{8}}
    );

    $result = $this->Whatsapp_model->send_template_message(
        $staff_number,
        $templateName,
        $languageCode,
        $params
    );

    file_put_contents(
        FCPATH . 'meta_staff_whatsapp_log.txt',
        date('Y-m-d H:i:s') .
        ' | staff_id: ' . $staff_id .
        ' | number: ' . $staff_number .
        ' | params: ' . json_encode($params) .
        ' | result: ' . json_encode($result) . "\n\n",
        FILE_APPEND
    );

    return $result;
}

// private function send_meta_lead_to_staff_whatsapp($staff_id, $mapped, $lead_number)
// {
//     $staff_number = $this->get_staff_whatsapp_number($staff_id);

//     if ($staff_number == '') {
//         return false;
//     }

//     $templateName = $this->config->item('meta_lead_template_name');
//     $languageCode = $this->config->item('meta_lead_template_language');

//     $guest_name = isset($mapped['full_name']) ? $mapped['full_name'] : '';
// 	$phone = isset($mapped['phone_number']) ? $mapped['phone_number'] : '';
// 	$city = isset($mapped['city']) ? $mapped['city'] : '';
// 	$travel_date = isset($mapped['travel_date']) ? $mapped['travel_date'] : '';
// 	$duration = isset($mapped['how_many_days_planning']) ? $mapped['how_many_days_planning'] : '';
// 	$staff_name = $this->get_staff_name($staff_id);

//     $all_fields = $this->build_meta_lead_whatsapp_message($mapped);

//     // $params = array(
//     //     $guest_name,     // {{1}}
//     //     $lead_number,    // {{2}}
//     //     $all_fields      // {{3}}
//     // );
// 	$params = array(
//     $staff_name,
//     $lead_number,
//     $guest_name,
//     $phone,
//     $city,
//     $travel_date,
//     $duration,
//     $all_fields
// );

//     $result = $this->Whatsapp_model->send_template_message(
//         $staff_number,
//         $templateName,
//         $languageCode,
//         $params
//     );

//     file_put_contents(
//         FCPATH . 'meta_staff_whatsapp_log.txt',
//         date('Y-m-d H:i:s') .
//         ' | staff_id: ' . $staff_id .
//         ' | number: ' . $staff_number .
//         ' | result: ' . json_encode($result) . "\n\n",
//         FILE_APPEND
//     );

//     return $result;
// }

private function send_meta_lead_whatsapp($leadData, $mapped, $page_id, $form_id, $ad_id)
{
    $name = isset($mapped['full_name']) ? $mapped['full_name'] : 'Meta Lead';
    $phone = isset($mapped['phone_number']) ? $mapped['phone_number'] : '';
    $email = isset($mapped['email']) ? $mapped['email'] : '';
    $duration = isset($mapped['how_many_days_planning']) ? $mapped['how_many_days_planning'] : '-';

    $url = 'https://graph.facebook.com/v24.0/' . $this->whatsapp_phone_number_id . '/messages';

    $payload = array(
        'messaging_product' => 'whatsapp',
        'to' => $this->whatsapp_notify_number,
        'type' => 'template',
        'template' => array(
            'name' => 'jaspers_market_order',
            'language' => array(
                'code' => 'en'
            ),
            'components' => array(
                array(
                    'type' => 'body',
                    'parameters' => array(
                        array('type' => 'text', 'text' => $name),
                        array('type' => 'text', 'text' => $phone),
                        array('type' => 'text', 'text' => $email)
                        // array('type' => 'text', 'text' => $duration),
                        // array('type' => 'text', 'text' => $form_id)
                    )
                )
            )
        )
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, true);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Authorization: Bearer ' . $this->whatsapp_access_token,
        'Content-Type: application/json'
    ));
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($payload));
    curl_setopt($ch, CURLOPT_TIMEOUT, 30);

    $response = curl_exec($ch);
    $error = curl_error($ch);
    $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
    curl_close($ch);

    file_put_contents(
        FCPATH . 'whatsapp_meta_lead_log.txt',
        date('Y-m-d H:i:s') .
        " | HTTP_CODE: " . $http_code .
        " | PAYLOAD: " . json_encode($payload) .
        " | RESPONSE: " . $response .
        " | CURL_ERROR: " . $error . "\n\n",
        FILE_APPEND
    );

    return $response;
}
    /**
     * Fetch full lead data from Meta Graph API
     */
    private function fetch_meta_lead($leadgen_id)
    {
        $url = 'https://graph.facebook.com/v24.0/' . $leadgen_id .
               '?fields=id,created_time,ad_id,form_id,field_data' .
               '&access_token=' . urlencode($this->meta_page_access_token);

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_TIMEOUT, 30);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, true);

        $response = curl_exec($ch);
        $curl_error = curl_error($ch);
        curl_close($ch);

        if ($curl_error) {
            return array('error' => $curl_error);
        }

        $decoded = json_decode($response, true);

        if (!$decoded) {
            return array('error' => 'Invalid JSON response from Meta', 'raw' => $response);
        }

        return $decoded;
    }

	private function get_next_staff($form_id, $mapped)
	{
		// STEP 1 campaign
		$campaign = $this->db
			->where('facebook_form_id', $form_id)
			->get('meta_ads_setting')
			->row();

		if (!$campaign) return 1;

		$campaign_id = $campaign->meta_ads_setting_id;

		// STEP 2 shift
		$current_time = date('H:i:s');

		$shift = $this->db
			->where('shift_start_time <=', $current_time)
			->where('shift_end_time >=', $current_time)
			->where('shift_status', 1)
			->get('shift')
			->row();

		// STEP 3 staff list
		$this->db->select('soa.staff_id_fk, soa.staff_order, u.meta_force_stop');
		$this->db->from('staff_order_assign soa');
		$this->db->join('user_details u', 'u.user_id = soa.staff_id_fk');

		$this->db->where('soa.meta_campain_id_fk', $campaign_id);

		if ($shift) {
			$this->db->where('soa.shift_id_fk', $shift->shift_id);
		}

		$this->db->order_by('soa.staff_order', 'ASC');

		$staff_list = $this->db->get()->result();

		// STEP 4 fallback to all staff if no one in shift
		if (empty($staff_list) && $shift) {
			// Get all staff for this campaign (any shift)
			$this->db->select('soa.staff_id_fk, soa.staff_order, u.meta_force_stop');
			$this->db->from('staff_order_assign soa');
			$this->db->join('user_details u', 'u.user_id = soa.staff_id_fk');
			$this->db->where('soa.meta_campain_id_fk', $campaign_id);
			$this->db->order_by('soa.staff_order', 'ASC');
			$staff_list = $this->db->get()->result();
		}

		if (empty($staff_list)) return 1;

		// STEP 5 filter out staff with meta_force_stop
		$filtered = array();
		foreach ($staff_list as $s) {
			if ($s->meta_force_stop == 'Y') continue;
			$filtered[] = $s;
		}

		if (empty($filtered)) return 1;

		// STEP 6 language filtering
		$lead_language = '';
		if (isset($mapped['language'])) {
			$lead_language = strtolower(trim($mapped['language']));
		}

		if (!empty($lead_language)) {
			// Get language ID from languages table
			$language_row = $this->db
				->select('language_id')
				->where('LOWER(language_name)', $lead_language)
				->or_where('LOWER(language_code)', $lead_language)
				->where('language_status', 1)
				->get('languages')
				->row();

			if ($language_row) {
				$language_id = $language_row->language_id;

				// Filter staff who speak this language
				$language_filtered = array();
				foreach ($filtered as $s) {
					// Check if this staff speaks the language
					$staff_lang = $this->db
						->select('language_id_fk')
						->where('user_id_fk', $s->staff_id_fk)
						->where('language_id_fk', $language_id)
						->get('staff_languages')
						->row();

					if ($staff_lang) {
						$language_filtered[] = $s;
					}
				}

				// Use language-filtered list if not empty
				if (!empty($language_filtered)) {
					$filtered = $language_filtered;
				}
			}
		}

		if (empty($filtered)) return 1;

		// STEP 6.5 - Re-sort filtered staff by staff_order to maintain priority
		usort($filtered, function($a, $b) {
			return $a->staff_order - $b->staff_order;
		});

		// STEP 7 assign based on staff_order (priority order)
		// The staff_order_assign table already defines the priority order
		// We assign to the first staff in the order, then cycle through
		// Track round-robin per campaign+shift combination

		$shift_id = $shift ? $shift->shift_id : 0;

		// Get last assigned staff for this specific campaign+shift combination
		$this->db->select('staff_id_fk');
		$this->db->where('meta_form_id', $form_id);
		$this->db->order_by('leads_id', 'DESC');
		$this->db->limit(1);

		$last = $this->db->get('leads')->row();

		$last_staff = $last ? $last->staff_id_fk : 0;

		// STEP 8 round robin based on staff_order
		// Find the last assigned staff in the filtered list and return the next one
		$next_staff = $filtered[0]->staff_id_fk; // Default to first in order
		$found = false;

		for ($i = 0; $i < count($filtered); $i++) {
			if ($found) {
				return $filtered[$i]->staff_id_fk;
			}
			if ($filtered[$i]->staff_id_fk == $last_staff) {
				$found = true;
			}
		}

		return $next_staff;
	}
    /**
     * Convert Meta lead fields and insert into your leads table
     */
    private function save_meta_lead_to_leads_table($leadData, $page_id, $form_id, $ad_id)
    {
        $leadgen_id   = isset($leadData['id']) ? $leadData['id'] : '';
        $created_time = isset($leadData['created_time']) ? $leadData['created_time'] : '';
        $field_data   = isset($leadData['field_data']) ? $leadData['field_data'] : array();

        // Prevent duplicate insertion by checking meta_lead_logs already saved
        $already_saved = $this->db
            ->where('leadgen_id', $leadgen_id)
            ->where('status', 'saved')
            ->get('meta_lead_logs')
            ->row();

        if ($already_saved) {
            return true;
        }

        // Convert Meta field_data to associative array
        $mapped = array();

        if (is_array($field_data)) {
            foreach ($field_data as $field) {
                $name = isset($field['name']) ? trim($field['name']) : '';
                $vals = isset($field['values']) ? $field['values'] : array();

                if ($name === '') {
                    continue;
                }

                if (is_array($vals) && !empty($vals)) {
                    $mapped[$name] = implode(', ', $vals);
                } else {
                    $mapped[$name] = '';
                }
            }
        }

        // Name
        $guest_name = '';
        if (isset($mapped['full_name']) && $mapped['full_name'] !== '') {
            $guest_name = $mapped['full_name'];
        } else {
            $first_name = isset($mapped['first_name']) ? $mapped['first_name'] : '';
            $last_name  = isset($mapped['last_name']) ? $mapped['last_name'] : '';
            $guest_name = trim($first_name . ' ' . $last_name);
        }

        if ($guest_name === '') {
            $guest_name = 'Meta Lead';
        }

        // Email
        $email = '';
        if (isset($mapped['email'])) {
            $email = $mapped['email'];
        }

        // Phone
        $phone = '';
        if (isset($mapped['phone_number'])) {
            $phone = $mapped['phone_number'];
        } else if (isset($mapped['phone'])) {
            $phone = $mapped['phone'];
        }

		// Duration
        $duration = '';
        if (isset($mapped['how_many_days_planning'])) {
            $duration = $mapped['how_many_days_planning'];
        } else if (isset($mapped['phodurationne'])) {
            $duration = $mapped['duration'];
        }

        // Address / city / country
        $address_parts = array();

        if (isset($mapped['city']) && $mapped['city'] !== '') {
            $address_parts[] = 'City: ' . $mapped['city'];
        }

        if (isset($mapped['state']) && $mapped['state'] !== '') {
            $address_parts[] = 'State: ' . $mapped['state'];
        }

        if (isset($mapped['country']) && $mapped['country'] !== '') {
            $address_parts[] = 'Country: ' . $mapped['country'];
        }

        $lead_address = '';
        if (!empty($address_parts)) {
            $lead_address = implode(' | ', $address_parts);
        }

        // Dates
        $today = date('Y-m-d');
        $now_time = date('H:i:s');

        if ($created_time !== '') {
            $timestamp = strtotime($created_time);
            if ($timestamp !== false) {
                $today = date('Y-m-d', $timestamp);
                $now_time = date('H:i:s', $timestamp);
            }
        }

        // Custom details into description
        $description = 'Source: Meta Facebook Lead';
        $description .= "\nLeadgen ID: " . $leadgen_id;
        $description .= "\nPage ID: " . $page_id;
        $description .= "\nForm ID: " . $form_id;
        $description .= "\nAd ID: " . $ad_id;

        if (!empty($mapped)) {
            $description .= "\n\nField Data:";
            foreach ($mapped as $k => $v) {
                $description .= "\n" . $k . ': ' . $v;
            }
        }
        // print_r($mapped);exit();

        // IMPORTANT:
        // Change these IDs based on your system master data
       	$staff_id_fk = $this->get_next_staff($form_id, $mapped);

        $source_id_fk           = 12; // Facebook / Meta source ID
        $package_id_fk          = 0;
        $country_id_fk          = 99;
        $priority_status_id_fk  = 1;
        $stage_id_fk            = 1;
        $agent_id_fk            = 0;
        $created_user_id        = 1;
        $created_user_name      = 'Meta Facebook';

		$lead_number = $this->generate_meta_lead_number();

        $insert = array(
            'staff_id_fk'               => $staff_id_fk,
            'source_id_fk'              => $source_id_fk,
            'package_id_fk'             => $package_id_fk,
            'country_id_fk'             => $country_id_fk,
            'priority_status_id_fk'     => $priority_status_id_fk,
            'stage_id_fk'               => $stage_id_fk,
            'agent_id_fk'               => $agent_id_fk,
            'leads_number'              => $lead_number,
            'lead_type'                 => 'Meta Lead',
            'guest_name'                => $guest_name,
            'lead_register_date'        => $today,
            'date_type'                 => '',
            // 'start_date'                => $today,
            // 'end_date'                  => $today,
            'duration'                  => $duration,
            'whats_number'              => $phone,
            'alternative_number'        => '',
            'leads_email'               => $email,
            'leads_address'             => $lead_address,
            'total_package_cost'        => 0,
            'expense'                   => 0,
            'margin'                    => 0,
            'leads_accomodation_status' => 0,
            'description'               => $description,
            'leads_created_date'        => $today,
            'leads_created_time'        => $now_time,
            'leads_createdby_userid'    => $created_user_id,
            'leads_createdby_username'  => $created_user_name,
			'lead_current_status'       => 1,
            'leads_status'              => 1,
            'meta_leadgen_id'           => $leadgen_id,
            'meta_page_id'              => $page_id,
            'meta_form_id'              => $form_id,
            'meta_ad_id'                => $ad_id,
            'raw_meta_json'             => $description
        );

        $result = $this->db->insert('leads', $insert);
		// if ($result) {
		// 	$this->send_meta_lead_whatsapp($leadData, $mapped, $page_id, $form_id, $ad_id);
		// 	return true;
		// }

		// return false;



		// if ($result) {
		// 	$this->send_meta_lead_to_staff_whatsapp($staff_id_fk, $mapped, $lead_number);
		// 	return true;
		// }

		return false;

        // return $result ? true : false;
    }

    /**
     * Generate lead number
     */
    private function generate_meta_lead_number()
    {
        return 'META-' . date('YmdHis') . '-' . rand(100, 999);
    }

	public function add_source() {
        $source_name = $this->input->post('source_name');

        if(empty($source_name)) {
            echo json_encode(['status' => 'error', 'message' => 'Source name is required']);
            return;
        }

        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
        

        $data = array(
            'source_name' => $source_name,
            'source_created_date' => date('Y-m-d'),
            'source_created_time' => date('H:i:s'),
            'source_created_user_id' => $currentuserid,
            'source_created_username' => $currentusername,
            'source_status' => 1
	);

        $insert_id = $this->Leads_model->add_source($data);

        if($insert_id) {
            echo json_encode(['status' => 'success', 'source_id' => $insert_id, 'source_name' => $source_name]);
        } else {
            echo json_encode(['status' => 'error', 'message' => 'Database error']);
        }
    }

	public function add_priority_status() {
		
		$name = $this->input->post('priority_status_name');
		$button = $this->input->post('priority_status_button');
		$description = $this->input->post('priority_status_description');

		if(empty($name) || empty($button)) {
			echo json_encode(['status'=>'error', 'message'=>'Name and button are required']);
			return;
		}

		$currentuserid = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');

		$data = array(
			'priority_status_name' => $name,
			'priority_status_button' => $button,
			'priority_status_description' => $description,
			'priority_status_created_date' => date('Y-m-d'),
			'priority_status_created_time' => date('H:i:s'),
			'priority_status_created_user_id' => $currentuserid,
			'priority_status_created_username' => $currentusername,
			'priority_status_created_status' => 1
		);

		$insert_id = $this->Leads_model->add_priority_status($data);

		if($insert_id) {
			echo json_encode(['status'=>'success', 'priority_status_id'=>$insert_id, 'priority_status_name'=>$name]);
		} else {
			echo json_encode(['status'=>'error', 'message'=>'Database error']);
		}
	}

	public function add_stage() {
		
		$name = $this->input->post('stages_name');
		$button = $this->input->post('stages_button');
		$description = $this->input->post('stages_description');

		if(empty($name) || empty($button)) {
			echo json_encode(['status'=>'error', 'message'=>'Stage name and button are required']);
			return;
		}

		$currentuserid = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');

		$data = array(
			'stages_name' => $name,
			'stages_button' => $button,
			'stages_description' => $description,
			'stages_created_date' => date('Y-m-d'),
			'stages_created_time' => date('H:i:s'),
			'stages_created_user_id' => $currentuserid,
			'stages_created_username' => $currentusername,
			'stages_status' => 1
		);

		$insert_id = $this->Leads_model->add_stage($data);

		if($insert_id) {
			echo json_encode(['status'=>'success', 'stages_id'=>$insert_id, 'stages_name'=>$name]);
		} else {
			echo json_encode(['status'=>'error', 'message'=>'Database error']);
		}
	}


	public function ajax_add_guest_count_old(){

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());

		$guest_name = $this->input->post('guest_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$start_date = str_replace('/','-', $this->input->post('start_date'));
		$start_date = date("Y-m-d h:i:s a",strtotime($start_date));

		$end_date = str_replace('/','-', $this->input->post('end_date'));
		$end_date = date("Y-m-d h:i:s a",strtotime($end_date));

		$data_guest_count = array(

				'guset_count_lead_id_fk' => $this->input->post('guset_count_lead_id_fk'),
				'guset_count_package_id_fk' => $this->input->post('guset_count_package_id_fk'),
				'guset_count_type' => $this->input->post('guest_type'),
				'guset_count_total' => $this->input->post('guset_count_total'),		
				'guset_count_created_by_userid' => $currentuserid,			
				'guset_count_created_by_username' => $currentusername,			
				'guset_count_created_date' => $date,			
				'guset_count_created_time' => $time,			
				'guset_count_status' => 1
			);

		
		
		$insert = $this->Leads_model->save1($data_guest_count);
		
		$pax_count_plan = $this->input->post('pax_count_plan');
		$adults = $this->input->post('adults');
		$children = $this->input->post('children');
		$total_count = $this->input->post('total_count');

		if($insert){

			foreach ($pax_count_plan as $key => $value) {

				$data_guset_count_details_add = array(
							'guset_count_id_fk' => $insert,
							'guset_count_details_type' => $this->input->post('guest_type'),
							'pax_count_plan' => $pax_count_plan[$key],
							'adults' => $adults[$key],
							'children' => $children[$key],	
							'total_count' => $total_count[$key],				
							'guset_count_details_status' => 1
							);
						//echo '<pre>'; print_r($data_terms_condition_item_add); exit();
						$guset_count_details_id = $this->General_model->add_returnID($this->guset_count_details,$data_guset_count_details_add);
						
				$age = $this->input->post('age');
				$count = $this->input->post('count');

				foreach ($pax_count_plan as $key => $value) {

					$data_child_breakup_validation_details_add = array(
								'guset_count_details_id_fk' => $guset_count_details_id,
								'age' => $age[$key],
								'count' => $count[$key],			
								'child_age_break_up_status' => 1
								);
							//echo '<pre>'; print_r($data_terms_condition_item_add); exit();
							$this->General_model->add_returnID($this->child_age_break_up,$data_child_breakup_validation_details_add);
							
				}
			}
		}
		
		echo json_encode(array("status" => TRUE));
	}
	
	public function ajax_get_guest_count($lead_id)
	{
		$lead_id = (int)$lead_id;

		// master record (latest active - adjust if you use status)
		$master = $this->db->select('*')
			->from('guset_count')
			->join('leads', 'leads.leads_id = guset_count.guset_count_lead_id_fk', 'inner')
			->where('guset_count_lead_id_fk', $lead_id)
			->where('guset_count_status', 1)
			->order_by('guset_count_id', 'DESC')
			->limit(1)
			->get()->row_array();

		if (!$master) {
			echo json_encode(array('status' => true, 'exists' => false));
			return;
		}

		$details = $this->db->select('*')
			->from('guset_count_details')
			->where('guset_count_id_fk', $master['guset_count_id'])
			->where('guset_count_details_status', 1)
			->order_by('guset_count_details_id', 'ASC')
			->get()->result_array();

		// attach child breakup to each detail
		foreach ($details as $k => $d) {
			$children = $this->db->select('*')
				->from('child_age_break_up')
				->where('guset_count_details_id_fk', $d['guset_count_details_id'])
				->where('child_age_break_up_status', 1)
				->order_by('child_age_break_up_id', 'ASC')
				->get()->result_array();

			$details[$k]['child_breakup'] = $children;
		}

		echo json_encode(array(
			'status' => true,
			'exists' => true,
			'master' => $master,
			'details' => $details
		));
	}


	public function ajax_save_guest_count()
{
    date_default_timezone_set("Asia/Kolkata");
    $currentuserid   = $this->session->userdata('user_id');
    $currentusername = $this->session->userdata('admin_name');
    $date = date('Y-m-d');
    $time = date('h:i:sa');

    $lead_id    = (int)$this->input->post('guset_count_lead_id_fk');
    $package_id = (int)$this->input->post('guset_count_package_id_fk');
    $guest_type = $this->input->post('guest_type'); // S or D

    $pax_plan    = $this->input->post('pax_count_plan');
    $adults      = $this->input->post('adults');
    $children    = $this->input->post('children');
    $total_count = $this->input->post('total_count');

    // grouped: age[0][]=.. count[0][]=..
    $age   = $this->input->post('age');
    $count = $this->input->post('count');

    // normalize for PHP 5.6
    $pax_plan    = is_array($pax_plan) ? $pax_plan : array();
    $adults      = is_array($adults) ? $adults : array();
    $children    = is_array($children) ? $children : array();
    $total_count = is_array($total_count) ? $total_count : array();
    $age         = is_array($age) ? $age : array();
    $count       = is_array($count) ? $count : array();

    // if package missing, take from lead
    if ($package_id <= 0 && $lead_id > 0) {
        $row = $this->db->select('package_id_fk')
            ->from('leads')
            ->where('leads_id', $lead_id)
            ->limit(1)->get()->row_array();
        if ($row) $package_id = (int)$row['package_id_fk'];
    }

    // ---------- VALIDATION ----------
    $errors = array();
    if ($lead_id <= 0) $errors[] = "Lead required";
    if ($package_id <= 0) $errors[] = "Package required";
    if ($guest_type !== 'S' && $guest_type !== 'D') $errors[] = "Invalid guest type";
    if (count($pax_plan) === 0) $errors[] = "At least one plan required";

    for ($i=0; $i<count($pax_plan); $i++) {
        $a = isset($adults[$i]) ? (int)$adults[$i] : 0;
        $c = isset($children[$i]) ? (int)$children[$i] : 0;
        $t = isset($total_count[$i]) ? (int)$total_count[$i] : 0;

        if ($a <= 0) $errors[] = "Plan ".($i+1).": Adults must be > 0";
        // if ($c <= 0) $errors[] = "Plan ".($i+1).": Children must be > 0";
        if ($t !== ($a+$c)) $errors[] = "Plan ".($i+1).": Total must equal Adults + Children";

        // EXACT MATCH: sum(count[i][]) must equal children
        $sum = 0;
        if (isset($count[$i]) && is_array($count[$i])) {
            foreach ($count[$i] as $cc) $sum += (int)$cc;
        }
        if ($sum !== $c) $errors[] = "Plan ".($i+1).": Child breakup must equal Children (".$c.")";
    }

    if (!empty($errors)) {
        echo json_encode(array("status"=>false, "errors"=>$errors));
        return;
    }

    // compute grand total
    $grand = 0;
    foreach ($total_count as $t) $grand += (int)$t;

    // ---------- FIND CURRENT ACTIVE MASTER FOR THIS LEAD ----------
    $active = $this->db->select('guset_count_id')
        ->from('guset_count')
        ->where('guset_count_lead_id_fk', $lead_id)
        ->where('guset_count_status', 1)
        ->order_by('guset_count_id', 'DESC')
        ->limit(1)
        ->get()->row_array();

    $old_master_id = $active ? (int)$active['guset_count_id'] : 0;

    // ---------- OPTIONAL: NO-CHANGE CHECK ----------
    // If you want "no change => do nothing", keep this block.
    // If you don't need it, you can remove it.
    if ($old_master_id > 0) {
        // build normalized current data
        $current = array('guest_type'=>null, 'plans'=>array());

        $oldMaster = $this->db->select('guset_count_type')
            ->from('guset_count')
            ->where('guset_count_id', $old_master_id)
            ->limit(1)->get()->row_array();

        $current['guest_type'] = $oldMaster ? $oldMaster['guset_count_type'] : null;

        $oldDetails = $this->db->select('*')
            ->from('guset_count_details')
            ->where('guset_count_id_fk', $old_master_id)
            ->where('guset_count_details_status', 1)
            ->order_by('guset_count_details_id', 'ASC')
            ->get()->result_array();

        foreach ($oldDetails as $d) {
            $breaks = $this->db->select('age, count')
                ->from('child_age_break_up')
                ->where('guset_count_details_id_fk', $d['guset_count_details_id'])
                ->where('child_age_break_up_status', 1)
                ->order_by('child_age_break_up_id', 'ASC')
                ->get()->result_array();

            $current['plans'][] = array(
                'pax_count_plan' => (string)$d['pax_count_plan'],
                'adults' => (int)$d['adults'],
                'children' => (int)$d['children'],
                'total' => (int)$d['total_count'],
                'breakup' => array_map(function($r){
                    return array('age'=>(int)$r['age'], 'count'=>(int)$r['count']);
                }, $breaks)
            );
        }

        // build normalized new payload
        $incoming = array('guest_type'=>$guest_type, 'plans'=>array());
        for ($i=0; $i<count($pax_plan); $i++) {
            $incoming['plans'][] = array(
                'pax_count_plan' => (string)$pax_plan[$i],
                'adults' => (int)$adults[$i],
                'children' => (int)$children[$i],
                'total' => (int)$total_count[$i],
                'breakup' => $this->_normalize_breakup($age, $count, $i)
            );
        }

        // if same => do not save
        // if ($current == $incoming) {
        //     // still mark leads_accomodation_status to 1 (as you requested)
        //     $this->db->where('leads_id', $lead_id)->update('leads', array('leads_accomodation_status'=>1));

        //     echo json_encode(array("status"=>true, "no_change"=>true));
        //     return;
        // }
		if ($current == $incoming) {
    echo json_encode(array(
        "status" => true,
        "no_change" => true,
        "msg" => "No changes found. Guest count not saved again."
    ));
    return;
}
    }

    // ---------- TRANSACTION ----------
    $this->db->trans_begin();

    // ✅ update leads status to 1
    // $this->db->where('leads_id', $lead_id)
    //     ->update('leads', array('leads_accomodation_status' => 1));

	$oldDetailIdsArray = array();

if ($old_master_id > 0) {
    $oldDetailRows = $this->db->select('guset_count_details_id')
        ->from('guset_count_details')
        ->where('guset_count_id_fk', $old_master_id)
        ->where('guset_count_details_status', 1)
        ->order_by('guset_count_details_id', 'ASC')
        ->get()
        ->result_array();

    foreach ($oldDetailRows as $row) {
        $oldDetailIdsArray[] = (int)$row['guset_count_details_id'];
    }
}

    // ✅ soft delete OLD active records
    if ($old_master_id > 0) {

        // get old detail ids
        $oldDetailIds = $this->db->select('guset_count_details_id')
            ->from('guset_count_details')
            ->where('guset_count_id_fk', $old_master_id)
            ->where('guset_count_details_status', 1)
            ->get()->result_array();

        foreach ($oldDetailIds as $od) {
            $this->db->where('guset_count_details_id_fk', (int)$od['guset_count_details_id'])
                ->update('child_age_break_up', array('child_age_break_up_status' => 0));
        }

        $this->db->where('guset_count_id_fk', $old_master_id)
            ->update('guset_count_details', array('guset_count_details_status' => 0));

        $this->db->where('guset_count_id', $old_master_id)
            ->update('guset_count', array('guset_count_status' => 0));
    }

    // ✅ INSERT NEW MASTER (always)
    $this->db->insert('guset_count', array(
        'guset_count_lead_id_fk' => $lead_id,
        'guset_count_package_id_fk' => $package_id,
        'guset_count_type' => $guest_type,
        'guset_count_total' => $grand,
        'guset_count_created_by_userid' => $currentuserid,
        'guset_count_created_by_username' => $currentusername,
        'guset_count_created_date' => $date,
        'guset_count_created_time' => $time,
        'guset_count_status' => 1
    ));
    $new_master_id = (int)$this->db->insert_id();
	$this->db->where('leads_id', $lead_id);
	$this->db->update('leads', array(
				'leads_accomodation_status' => 1
	));
	$newDetailIdsArray = array();
    // ✅ INSERT NEW DETAILS + BREAKUP
    for ($i=0; $i<count($pax_plan); $i++) {

        $this->db->insert('guset_count_details', array(
            'guset_count_id_fk' => $new_master_id,
            'guset_count_details_type' => $guest_type,
            'pax_count_plan' => $pax_plan[$i],
            'adults' => (int)$adults[$i],
            'children' => (int)$children[$i],
            'total_count' => (int)$total_count[$i],
            'guset_count_details_status' => 1
        ));
        $detail_id = (int)$this->db->insert_id();
		$newDetailIdsArray[] = $detail_id;

        // insert breakup rows for that plan index
        if (isset($age[$i]) && is_array($age[$i])) {
            for ($j=0; $j<count($age[$i]); $j++) {
                $this->db->insert('child_age_break_up', array(
                    'guset_count_details_id_fk' => $detail_id,
                    'age' => (int)$age[$i][$j],
                    'count' => (int)$count[$i][$j],
                    'child_age_break_up_status' => 1
                ));
            }
        }
    }

	if (!empty($oldDetailIdsArray) && !empty($newDetailIdsArray)) {

		for ($i = 0; $i < count($oldDetailIdsArray); $i++) {

			if (!isset($newDetailIdsArray[$i])) {
				continue;
			}

			$old_detail_id = (int)$oldDetailIdsArray[$i];
			$new_detail_id = (int)$newDetailIdsArray[$i];

			$this->db->where('lead_id_fk', $lead_id);
			$this->db->where('accommodation_plan_status', 1);

			// Use this if your required status is Y
			$this->db->where('accomodation_required_staus', 'R');

			// If your required status is R, use this instead:
			// $this->db->where('accomodation_required_staus', 'R');

			$this->db->where('guset_count_details_id_fk', $old_detail_id);
			$this->db->update('accommodation_plan', array(
				'guset_count_details_id_fk' => $new_detail_id
			));
		}
	}

    if ($this->db->trans_status() === false) {
        $this->db->trans_rollback();
        echo json_encode(array("status"=>false, "errors"=>array("DB transaction failed")));
        return;
    }

    $this->db->trans_commit();
    echo json_encode(array("status"=>true, "guset_count_id"=>$new_master_id, "updated"=>($old_master_id>0)));
}

/**
 * Helper for no-change compare: returns breakup for plan index as array(age,count)
 * This assumes your post format: age[planIndex][], count[planIndex][]
 */
private function _normalize_breakup($age, $count, $planIndex)
{
    $out = array();
    if (isset($age[$planIndex]) && is_array($age[$planIndex])) {
        for ($j=0; $j<count($age[$planIndex]); $j++) {
            $out[] = array(
                'age' => isset($age[$planIndex][$j]) ? (int)$age[$planIndex][$j] : 0,
                'count' => isset($count[$planIndex][$j]) ? (int)$count[$planIndex][$j] : 0
            );
        }
    }
    return $out;
}



	public function ajax_add_guest_count()
	{
		$this->load->helper('date');
		date_default_timezone_set("Asia/Kolkata");

		$currentuserid   = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');
		$date = date('Y-m-d');
		$time = date('h:i:sa');

		// ---------- Read inputs ----------
		$lead_id    = $this->input->post('guset_count_lead_id_fk');
		$package_id = $this->input->post('guset_count_package_id_fk');
		$guest_type = $this->input->post('guest_type');
		$grand_total = $this->input->post('guset_count_total');

		$pax_count_plan = $this->input->post('pax_count_plan');
		$adults         = $this->input->post('adults');
		$children       = $this->input->post('children');
		$total_count    = $this->input->post('total_count');
		$age            = $this->input->post('age');
		$count          = $this->input->post('count');

		// ---------- Normalize arrays (PHP 5.6 safe) ----------
		$pax_count_plan = is_array($pax_count_plan) ? $pax_count_plan : array();
		$adults         = is_array($adults) ? $adults : array();
		$children       = is_array($children) ? $children : array();
		$total_count    = is_array($total_count) ? $total_count : array();
		$age            = is_array($age) ? $age : array();
		$count          = is_array($count) ? $count : array();

		$errors = array();

		// ---------- Basic validation ----------
		if (empty($lead_id) || !is_numeric($lead_id)) {
			$errors[] = "Lead is required.";
		}
		if (empty($package_id) || !is_numeric($package_id)) {
			$errors[] = "Package is required.";
		}
		if ($guest_type !== 'S' && $guest_type !== 'D') {
			$errors[] = "Invalid guest type.";
		}
		if (count($pax_count_plan) === 0) {
			$errors[] = "At least one Pax Plan is required.";
		}

		// Stop early if basic invalid
		if (!empty($errors)) {
			echo json_encode(array("status" => false, "errors" => $errors));
			return;
		}

		// ---------- Strong plan validation ----------
		// Ensure arrays have same length
		$planCount = count($pax_count_plan);
		if (count($adults) < $planCount || count($children) < $planCount || count($total_count) < $planCount) {
			echo json_encode(array("status" => false, "errors" => array("Plans data mismatch.")));
			return;
		}

		// Validate each plan numbers, and compute expected grand total
		$computedGrand = 0;
		for ($k = 0; $k < $planCount; $k++) {
			$a = (int)$adults[$k];
			$c = (int)$children[$k];
			$t = (int)$total_count[$k];

			if ($a <= 0) $errors[] = "Plan ".($k+1).": Adults must be greater than 0.";
			// if ($c <= 0) $errors[] = "Plan ".($k+1).": Children must be greater than 0.";

			if ($t !== ($a + $c)) {
				$errors[] = "Plan ".($k+1).": Total must equal Adults + Children.";
			}

			$computedGrand += $t;
		}

		// Optional: validate posted grand total
		if ((int)$grand_total !== $computedGrand) {
			// You can choose to treat as warning or error. Here we enforce.
			$errors[] = "Grand total mismatch.";
		}

		if (!empty($errors)) {
			echo json_encode(array("status" => false, "errors" => $errors));
			return;
		}

		// ---------- Child breakup strong validation ----------
		// Frontend sends flat age[] and count[] across ALL plans.
		// We will consume child breakup rows in order, per plan, until sum(count) == children for that plan.
		if (count($age) !== count($count)) {
			echo json_encode(array("status" => false, "errors" => array("Child breakup data mismatch.")));
			return;
		}

		// Validate all child rows are positive numbers (age>0, count>0)
		for ($i = 0; $i < count($age); $i++) {
			$ai = (int)$age[$i];
			$ci = (int)$count[$i];
			if ($ai <= 0) $errors[] = "Child breakup row ".($i+1).": Age must be greater than 0.";
			if ($ci <= 0) $errors[] = "Child breakup row ".($i+1).": Count must be greater than 0.";
		}

		if (!empty($errors)) {
			echo json_encode(array("status" => false, "errors" => $errors));
			return;
		}

		// ---------- Transaction start ----------
		$this->db->trans_begin();

		// Insert guest count master
		$data_guest_count = array(
			'guset_count_lead_id_fk'         => $lead_id,
			'guset_count_package_id_fk'      => $package_id,
			'guset_count_type'               => $guest_type,
			'guset_count_total'              => $computedGrand,
			'guset_count_created_by_userid'  => $currentuserid,
			'guset_count_created_by_username'=> $currentusername,
			'guset_count_created_date'       => $date,
			'guset_count_created_time'       => $time,
			'guset_count_status'             => 1
		);

		$insert = $this->Leads_model->save1($data_guest_count);
		
		$this->db->where('leads_id', $lead_id)
			->update('leads', array('leads_accomodation_status' => 1));

		if (!$insert) {
			$this->db->trans_rollback();
			echo json_encode(array("status" => false, "errors" => array("Failed to save guest count.")));
			return;
		}

		// Insert plans + child breakup mapping
		$childIndex = 0;
		for ($k = 0; $k < $planCount; $k++) {

			$a = (int)$adults[$k];
			$c = (int)$children[$k];
			$t = (int)$total_count[$k];

			// Insert details
			$details = array(
				'guset_count_id_fk'            => $insert,
				'guset_count_details_type'     => $guest_type,
				'pax_count_plan'               => $pax_count_plan[$k],
				'adults'                       => $a,
				'children'                     => $c,
				'total_count'                  => $t,
				'guset_count_details_status'   => 1
			);

			$details_id = $this->General_model->add_returnID($this->guset_count_details, $details);

			if (!$details_id) {
				$this->db->trans_rollback();
				echo json_encode(array("status" => false, "errors" => array("Failed to save pax plan details.")));
				return;
			}

			// Consume child breakup rows until sum(count)==children for this plan
			$used = 0;

			while ($used < $c) {

				if (!isset($age[$childIndex]) || !isset($count[$childIndex])) {
					$this->db->trans_rollback();
					echo json_encode(array("status" => false, "errors" => array("Plan ".($k+1).": Child breakup rows are missing.")));
					return;
				}

				$ai = (int)$age[$childIndex];
				$ci = (int)$count[$childIndex];

				// If this row would exceed allowed children -> error
				if (($used + $ci) > $c) {
					$this->db->trans_rollback();
					echo json_encode(array(
						"status" => false,
						"errors" => array("Plan ".($k+1).": Child breakup count exceeded (Allowed: ".$c.").")
					));
					return;
				}

				$childData = array(
					'guset_count_details_id_fk' => $details_id,
					'age'                       => $ai,
					'count'                     => $ci,
					'child_age_break_up_status' => 1
				);

				$ok = $this->General_model->add_returnID($this->child_age_break_up, $childData);
				if (!$ok) {
					$this->db->trans_rollback();
					echo json_encode(array("status" => false, "errors" => array("Failed to save child breakup.")));
					return;
				}

				$used += $ci;
				$childIndex++;
			}

			// Enforce exact match (used == children). If you want <= instead, remove this.
			if ($used !== $c) {
				$this->db->trans_rollback();
				echo json_encode(array(
					"status" => false,
					"errors" => array("Plan ".($k+1).": Child breakup total must equal Children (".$c.").")
				));
				return;
			}
		}

		// If extra child breakup rows are still left, that means frontend sent too many rows
		if ($childIndex < count($age)) {
			$this->db->trans_rollback();
			echo json_encode(array("status" => false, "errors" => array("Extra child breakup rows found. Please check inputs.")));
			return;
		}

		// Commit transaction
		if ($this->db->trans_status() === false) {
			$this->db->trans_rollback();
			echo json_encode(array("status" => false, "errors" => array("Transaction failed.")));
			return;
		}

		$this->db->trans_commit();
		echo json_encode(array("status" => true));
	}

	public function ajax_accommodation_plan($lead_id)
	{
		$lead = $this->Leads_model->get_by_id($lead_id);

		$itinerary_days = $this->Leads_model->fetch_package_itineray($lead->package_id_fk);
		$destinations   = $this->Leads_model->fetch_stay_destination();
		$meal_plans     = $this->Leads_model->fetch_meal_plan();
		$pax_plans      = $this->Leads_model->fetch_guset_count_details($lead_id);

		// ✅ fetch existing accommodation plan rows for this lead
		$existing = $this->db->select('*')
			->from('accommodation_plan')
			->where('lead_id_fk', (int)$lead_id)
			->get()
			->result_array();

		// ✅ map existing by day_id_fk for easy lookup in JS
		$existingMap = array();
		foreach ($existing as $row) {
			$existingMap[(int)$row['day_id_fk']] = $row;
		}

		echo json_encode(array(
			'lead'         => $lead,
			'days'         => $itinerary_days,
			'destinations' => $destinations,
			'meal_plans'   => $meal_plans,
			'pax_plans'    => $pax_plans,

			// ✅ new:
			'existing'     => $existingMap
		));
	}


	// public function ajax_accommodation_plan($lead_id)
	// {
	// 	$lead_id = (int)$lead_id;

	// 	$lead = $this->Leads_model->get_by_id($lead_id);

	// 	if (!$lead) {
	// 		echo json_encode(array(
	// 			'status' => false,
	// 			'message' => 'Lead not found',
	// 			'lead_id' => $lead_id
	// 		));
	// 		return;
	// 	}

	// 	// Convert lead object to array for safe JSON
	// 	$leadArr = is_object($lead) ? (array)$lead : $lead;

	// 	$packageId = isset($leadArr['package_id_fk']) ? (int)$leadArr['package_id_fk'] : 0;

	// 	// If no package id, return clean error
	// 	if ($packageId <= 0) {
	// 		echo json_encode(array(
	// 			'status' => false,
	// 			'message' => 'Package not found for this lead',
	// 			'lead' => $leadArr
	// 		));
	// 		return;
	// 	}

	// 	$itinerary_days = $this->Leads_model->fetch_package_itineray($packageId);
	// 	$destinations   = $this->Leads_model->fetch_stay_destination();
	// 	$meal_plans     = $this->Leads_model->fetch_meal_plan();
	// 	$pax_plans      = $this->Leads_model->fetch_guset_count_details($lead_id);

	// 	// Ensure arrays (not false/null)
	// 	$itinerary_days = is_array($itinerary_days) ? $itinerary_days : array();
	// 	$destinations   = is_array($destinations) ? $destinations : array();
	// 	$meal_plans     = is_array($meal_plans) ? $meal_plans : array();
	// 	$pax_plans      = is_array($pax_plans) ? $pax_plans : array();

	// 	echo json_encode(array(
	// 		'status' => true,
	// 		'lead' => $leadArr,
	// 		'days' => $itinerary_days,
	// 		'destinations' => $destinations,
	// 		'meal_plans' => $meal_plans,
	// 		'pax_plans' => $pax_plans
	// 	));
	// }

	private function build_date_map($start_date, $end_date)
{
    // Accepts: "2026-01-29" OR "2026-01-29 10:00:00" etc.
    $start_date = trim($start_date);
    $end_date   = trim($end_date);

    // Normalize to Y-m-d
    $start = date('Y-m-d', strtotime($start_date));
    $end   = date('Y-m-d', strtotime($end_date));

    $startDt = DateTime::createFromFormat('Y-m-d', $start);
    $endDt   = DateTime::createFromFormat('Y-m-d', $end);

    if (!$startDt || !$endDt) return array();

    // ensure start <= end
    if ($startDt > $endDt) {
        $tmp = $startDt; $startDt = $endDt; $endDt = $tmp;
    }

    $map = array();
    $idx = 0;

    while ($startDt <= $endDt) {
        $map[$idx] = array(
            'date' => $startDt->format('Y-m-d'),
            'day'  => $startDt->format('l') // Sunday, Monday...
        );
        $startDt->modify('+1 day');
        $idx++;
    }

    return $map; // 0=>Day1, 1=>Day2, ...
}

private function get_accommodation_date_by_index($start_date, $index)
{
    if (empty($start_date) || $start_date == '0000-00-00') {
        return array(
            'date' => null,
            'day'  => null
        );
    }

    $time = strtotime($start_date . ' +' . $index . ' days');

    return array(
        'date' => date('Y-m-d', $time),
        'day'  => date('l', $time)
    );
}
	public function save_accommodation_plan()
{
    $lead_id    = (int)$this->input->post('lead_id_fk');
    $package_id = (int)$this->input->post('pacakage_id_fk');

    $day_ids     = $this->input->post('itinerary_day_id');
    $status      = $this->input->post('accommodation_status');
    $destination = $this->input->post('stay_destination_id');
    $meal_plan   = $this->input->post('meal_plan_id');
    $pax_plan    = $this->input->post('pax_count_plan_id');

    $day_ids     = is_array($day_ids) ? $day_ids : array();
    $status      = is_array($status) ? $status : array();
    $destination = is_array($destination) ? $destination : array();
    $meal_plan   = is_array($meal_plan) ? $meal_plan : array();
    $pax_plan    = is_array($pax_plan) ? $pax_plan : array();

    // ✅ fetch lead dates
    $lead = $this->db->select('start_date, end_date, package_id_fk')
        ->from('leads')
        ->where('leads_id', $lead_id)
        ->limit(1)
        ->get()
        ->row_array();
// echo $this->db->last_query();exit();
    if (!$lead) {
        echo json_encode(array('status'=>false, 'msg'=>'Lead not found'));
        return;
    }

    // ✅ fallback package id from lead if not posted
    if ($package_id <= 0 && !empty($lead['package_id_fk'])) {
        $package_id = (int)$lead['package_id_fk'];
    }

    $dateMap = $this->build_date_map($lead['start_date'], $lead['end_date']);

    // ✅ property day map: day_no => packages_properties_days_id
    // (Day 1 => id, Day 2 => id ...)
    $propertyDayMap = $this->Leads_model->get_property_days_map_by_package($package_id);
// print_r($propertyDayMap);die;
    $insertData = array();

    if (!empty($day_ids)) {


// 		foreach ($day_ids as $i => $day_id) {

//     $s = isset($status[$i]) ? $status[$i] : '';

//     if ($s == '' || $s === 'N') continue;

//     $dateInfo = $this->get_accommodation_date_by_index($lead['start_date'], $i);

//     $accDate = $dateInfo['date'];
//     $accDay  = $dateInfo['day'];

//     $dayNo = $i + 1;
//     $property_day_id_fk = isset($propertyDayMap[$dayNo]) ? (int)$propertyDayMap[$dayNo] : null;

//     $insertData[] = array(
//         'lead_id_fk'                  => $lead_id,
//         'pacakage_id_fk'              => $package_id,
//         'day_id_fk'                   => (int)$day_id,
//         'accomodation_required_staus' => $s,
//         'stay_destination_id_fk'      => isset($destination[$i]) ? (int)$destination[$i] : null,
//         'meal_plan_id_fk'             => isset($meal_plan[$i]) ? (int)$meal_plan[$i] : null,
//         'guset_count_details_id_fk'   => isset($pax_plan[$i]) ? (int)$pax_plan[$i] : null,
//         'accommodation_date'          => $accDate,
//         'accommodation_day_name'      => $accDay,
//         'property_day_id_fk'          => $property_day_id_fk,
//         'accommodation_plan_status'   => '1'
//     );
// }

		foreach ($day_ids as $i => $day_id) {

    $s = isset($status[$i]) ? $status[$i] : 'N';

    // If empty, save as Not Required
    if ($s == '') {
        $s = 'N';
    }

    $dateInfo = $this->get_accommodation_date_by_index($lead['start_date'], $i);

    $accDate = $dateInfo['date'];
    $accDay  = $dateInfo['day'];

    $dayNo = $i + 1;
    $property_day_id_fk = isset($propertyDayMap[$dayNo]) ? (int)$propertyDayMap[$dayNo] : null;

    $insertData[] = array(
        'lead_id_fk'                  => $lead_id,
        'pacakage_id_fk'              => $package_id,
        'day_id_fk'                   => (int)$day_id,
        'accomodation_required_staus' => $s,

        // Save details only when required, otherwise NULL
        'stay_destination_id_fk'      => ($s == 'R' && isset($destination[$i])) ? (int)$destination[$i] : null,
        'meal_plan_id_fk'             => ($s == 'R' && isset($meal_plan[$i])) ? (int)$meal_plan[$i] : null,
        'guset_count_details_id_fk'   => ($s == 'R' && isset($pax_plan[$i])) ? (int)$pax_plan[$i] : null,

        'accommodation_date'          => $accDate,
        'accommodation_day_name'      => $accDay,
        'property_day_id_fk'          => $property_day_id_fk,
        'accommodation_plan_status'   => '1'
    );
}
    }

    if (empty($insertData)) {
        echo json_encode(array(
            'status' => false,
            'msg' => 'No accommodation required for selected days'
        ));
        return;
    }

    // ✅ Recommended: clear old rows first to avoid duplicates
    // $this->db->where('lead_id_fk', $lead_id)->delete('accommodation_plan');

	$this->db->where('lead_id_fk', $lead_id);
		$this->db->where('accommodation_plan_status', 1);
		$this->db->update('accommodation_plan', array(
			'accommodation_plan_status' => 0
		));
    $this->Leads_model->insert_accommodation_plan_batch($insertData);

	// ✅ Update leads_accomodation_status to 2
	$this->db->where('leads_id', $lead_id);
	$this->db->update('leads', array(
		'leads_accomodation_status' => 2
	));

    echo json_encode(array(
        'status' => true,
        'msg' => 'Accommodation plan saved successfully'
    ));
}





	public function save_accommodation_planold()
	{
		$lead_id    = $this->input->post('lead_id_fk');
		$package_id = $this->input->post('pacakage_id_fk');

		$day_ids     = $this->input->post('itinerary_day_id');
		$status      = $this->input->post('accommodation_status');
		$destination = $this->input->post('stay_destination_id');
		$meal_plan   = $this->input->post('meal_plan_id');
		$pax_plan    = $this->input->post('pax_count_plan_id');

		$insertData = array();

		if (!empty($day_ids)) {
			foreach ($day_ids as $i => $day_id) {

				// Skip "Not Required"
				if (isset($status[$i]) && $status[$i] === 'N') {
					continue;
				}

				$insertData[] = array(
					'lead_id_fk'        => $lead_id,
					'pacakage_id_fk'     => $package_id,
					'day_id_fk' => $day_id,
					'accomodation_required_staus'            => $status[$i],
					'stay_destination_id_fk'               => isset($destination[$i]) ? $destination[$i] : NULL,
					'meal_plan_id_fk'                      => isset($meal_plan[$i]) ? $meal_plan[$i] : NULL,
					'guset_count_details_id_fk'                 => isset($pax_plan[$i]) ? $pax_plan[$i] : NULL,
				);
			}
		}

		if (empty($insertData)) {
			echo json_encode(array(
				'status' => false,
				'msg' => 'No accommodation required for selected days'
			));
			return;
		}

		$this->Leads_model->insert_accommodation_plan_batch($insertData);

		echo json_encode(array(
			'status' => true,
			'msg' => 'Accommodation plan saved successfully'
		));
		
	}



	private function _validate1()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;


		if($this->input->post('staff_id_fk') == '')
		{
			$data['inputerror'][] = 'staff_id_fk';
			$data['error_string'][] = 'Staff is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('source_id_fk') == '')
		{
			$data['inputerror'][] = 'source_id_fk';
			$data['error_string'][] = 'Source is required';
			$data['status'] = FALSE;
		}

		// if($this->input->post('package_id_fk') == '')
		// {
		// 	$data['inputerror'][] = 'package_id_fk';
		// 	$data['error_string'][] = 'Package is required';
		// 	$data['status'] = FALSE;
		// }

		if($this->input->post('country_id_fk') == '')
		{
			$data['inputerror'][] = 'country_id_fk';
			$data['error_string'][] = 'Country is required';
			$data['status'] = FALSE;
		}

		// if($this->input->post('stage_id_fk') == '')
		// {
		// 	$data['inputerror'][] = 'stage_id_fk';
		// 	$data['error_string'][] = 'Stage is required';
		// 	$data['status'] = FALSE;
		// }
		if($this->input->post('lead_type') == '')
		{
			$data['inputerror'][] = 'lead_type';
			$data['error_string'][] = 'Lead type is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('guest_name') == '')
		{
			$data['inputerror'][] = 'guest_name';
			$data['error_string'][] = 'Guest name is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('date_type') == '')
		{
			$data['inputerror'][] = 'date_type';
			$data['error_string'][] = 'Date type is required';
			$data['status'] = FALSE;
		}
		// if($this->input->post('start_date') == '')
		// {
		// 	$data['inputerror'][] = 'start_date';
		// 	$data['error_string'][] = 'Start date is required';
		// 	$data['status'] = FALSE;
		// }
		// if($this->input->post('end_date') == '')
		// {
		// 	$data['inputerror'][] = 'end_date';
		// 	$data['error_string'][] = 'End date is required';
		// 	$data['status'] = FALSE;
		// }
		// if($this->input->post('duration') == '')
		// {
		// 	$data['inputerror'][] = 'duration';
		// 	$data['error_string'][] = 'Duration is required';
		// 	$data['status'] = FALSE;
		// }

		if($this->input->post('whats_number') == '')
		{
			$data['inputerror'][] = 'whats_number';
			$data['error_string'][] = 'Whats app number is required';
			$data['status'] = FALSE;
		}

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
	}

	private function _validate2()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		

		if($this->input->post('lead_type_b2b') == '')
		{
			$data['inputerror'][] = 'lead_type_b2b';
			$data['error_string'][] = 'Lead type is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('agent_id_fk') == '')
		{
			$data['inputerror'][] = 'agent_id_fk';
			$data['error_string'][] = 'Agent is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('total_package_cost') == '')
		{
			$data['inputerror'][] = 'total_package_cost';
			$data['error_string'][] = 'Total package cost is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('expense') == '')
		{
			$data['inputerror'][] = 'expense';
			$data['error_string'][] = 'Expense is required';
			$data['status'] = FALSE;
		}
		if($this->input->post('margin') == '')
		{
			$data['inputerror'][] = 'margin';
			$data['error_string'][] = 'Margin is required';
			$data['status'] = FALSE;
		}

		

		if($data['status'] === FALSE)
		{
			echo json_encode($data);
			exit();
		}
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

		$updateData = array('leads_status' => 0);
		
		$this->Leads_model->update(array('leads_id' => $this->input->post('id')), $updateData);

		$guest_name = $this->input->post('guest_name');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted lead: '.$guest_name.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Lead_registration',
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
}

?>