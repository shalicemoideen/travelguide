<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Quotation extends MY_Controller {
	public $table = 'quotation';
	public $quotation_options = 'quotation_options';
	public $quotation_properties_days = 'quotation_properties_days';
	public $quotation_properties = 'quotation_properties';
	public $quotation_properties_rooms = 'quotation_properties_rooms';
	public $activity = 'activity';
	public $page  = 'Quotation';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Quotation_model');
		$this->load->model('Packages_model');
        
	}

    public function index()
	{
		//$name = 'PERSONAL CASH';
		$template['staff'] = $this->Quotation_model->fetch_staff_details();
		$template['users'] = $this->Quotation_model->fetch_all_users();
		$template['quotation'] = $this->Quotation_model->fetch_quotation();
		$template['packages'] = $this->Quotation_model->fetch_packages();
		$template['leads'] = $this->Quotation_model->fetch_leads();
		$template['inclusions_exclusion'] = $this->Packages_model->fetch_inclusions_exclusion();
		$template['payment_policies'] = $this->Packages_model->fetch_payment_policies();
		$template['terms_condition'] = $this->Packages_model->fetch_terms_condition();
		$template['cancellation_policies'] = $this->Packages_model->fetch_cancellation_policies();
		$template['body'] = 'Quotation/list';
		$template['script'] = 'Quotation/script';
		$this->load->view('template', $template);
	}

	public function preview_quotation($quotation_id)
	{
		if (!$quotation_id) {
			show_404();
		}

		$this->load->model('Quotation_model');

		$data['quotation']       = $this->Quotation_model->get_quotation($quotation_id);

		// quotation based copies
		$data['itinerary']       = $this->Quotation_model->get_quotation_itinerary_days($quotation_id);
		$data['inclusions']      = $this->Quotation_model->get_quotation_inclusions($quotation_id);
		$data['exclusions']      = $this->Quotation_model->get_quotation_exclusions($quotation_id);
		$data['optional_addons'] = $this->Quotation_model->get_quotation_optional_addons($quotation_id);
		$data['payment']         = $this->Quotation_model->get_quotation_payment_policies($quotation_id);
		$data['terms']           = $this->Quotation_model->get_quotation_terms($quotation_id);
		$data['cancel']          = $this->Quotation_model->get_quotation_cancellation($quotation_id);
		$data['notes']           = $this->Quotation_model->get_quotation_notes($quotation_id);

		// option/property/room + totals
		$data['options']         = $this->Quotation_model->get_quotation_options_full($quotation_id);

		// extra blocks (if exists)
		$data['special_req']     = $this->Quotation_model->get_quotation_special_requirements($quotation_id);
		$data['prop_inclusion']  = $this->Quotation_model->get_quotation_property_inclusions($quotation_id);

		$this->load->view('quotation/preview', $data);
	}

	public function get(){
		$this->load->model('Quotation_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['quotation_number_filter'] =(isset($_REQUEST['quotation_number_filter']))?$_REQUEST['quotation_number_filter']:'';
		$param['leads_id_filter'] =(isset($_REQUEST['leads_id_filter']))?$_REQUEST['leads_id_filter']:'';
		$param['package_id_filter'] =(isset($_REQUEST['package_id_filter']))?$_REQUEST['package_id_filter']:'';
		$param['arriving_destination_filter'] =(isset($_REQUEST['arriving_destination_filter']))?$_REQUEST['arriving_destination_filter']:'';
		$param['departuring_destination_filter'] =(isset($_REQUEST['departuring_destination_filter']))?$_REQUEST['departuring_destination_filter']:'';
		$param['quotation_current_status_filter'] =(isset($_REQUEST['quotation_current_status_filter']))?$_REQUEST['quotation_current_status_filter']:'';
		$param['quotation_created_by_userid'] =(isset($_REQUEST['quotation_created_by_userid']))?$_REQUEST['quotation_created_by_userid']:'';
		$start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        }
		
		
		
    	$data = $this->Quotation_model->getQuotationTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }
    
//     public function fetch_package_property_category()
// {
//     $result = $this->Quotation_model->fetch_package_property_category();

//     $this->output
//         ->set_content_type('application/json')
//         ->set_output(json_encode($result));
// }

	public function packageid_underlead($leads_id){
           
		$data = $this->Quotation_model->getpackageid_underlead($leads_id);
		// print_r($data);exit();
		echo json_encode($data);
	}

	function fetch_package_under_lead()
	{
	  if($this->input->post('packages_id'))
	  {
	   
	   $sel=$this->input->post('itinerary_id');
	   //echo $sel;
	   echo $this->Quotation_model->fetch_package_under_leads($this->input->post('packages_id'), $sel);
	  }
	}

	public function get_property_categories($package_id)
    {
        $this->load->model('Quotation_model');

        $data = $this->Quotation_model->fetch_package_property_category($package_id);
		// print_r($data);die;
        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }

	public function get_property_categories_by_package()
    {
        $package_id = $this->input->get('package_id');

        if (!$package_id) {
            echo json_encode(['status' => false, 'data' => []]);
            return;
        }

        $this->load->model('Quotation_model');

        $data = $this->Quotation_model->fetch_package_property_category($package_id);

        echo json_encode([
            'status' => true,
            'data' => $data
        ]);
    }

	public function get_package_full_itinerary()
	{
		$common_id = $this->input->get('packages_properties_common_id');
		$lead_id   = $this->input->get('lead_id');
		$package_id= $this->input->get('package_id');

		if (!$common_id || !$lead_id || !$package_id) {
			echo json_encode(['status' => false, 'message' => 'Missing params']);
			return;
		}

		$data = $this->Quotation_model->get_full_itinerary_filtered($common_id, $lead_id, $package_id);

		echo json_encode([
			'status' => true,
			'data'   => $data
		]);
	}


	public function ajax_get_room_policy_details()
{
    header('Content-Type: application/json');

    $lead_id = $this->input->get('lead_id');
    $property_id = $this->input->get('property_id');
    $room_category_id = $this->input->get('room_category_id');

    if (!$lead_id || !$property_id || !$room_category_id) {
        echo json_encode(array('status' => false, 'message' => 'Missing params'));
        exit;
    }

    $data = $this->Quotation_model->get_room_policy_details($lead_id, $property_id, $room_category_id);

    echo json_encode(array(
        'status' => true,
        'data' => $data
    ));
}


	public function ajax_get_in_enquiry_context()
{
    header('Content-Type: application/json');

    $lead_id      = $this->input->get('lead_id');
    // $property_day = $this->input->get('property_day_id');
	$day_id_fk = $this->input->get('day_id_fk');
    $stay_dest    = $this->input->get('stay_destination_id');
    $property_id  = $this->input->get('property_id');
    $room_cat_id  = $this->input->get('room_category_id');

    if (!$lead_id || !$day_id_fk || !$stay_dest || !$property_id || !$room_cat_id) {
        echo json_encode([
            'status' => false,
            'message' => 'Missing params',
            'debug' => compact('lead_id','day_id_fk','stay_dest','property_id','room_cat_id')
        ]);
        exit;
    }

    $data = $this->Quotation_model->get_in_enquiry_by_context(
        $lead_id, $day_id_fk, $stay_dest, $property_id, $room_cat_id
    );

    echo json_encode([
        'status' => true,
        'data'   => $data
    ]);
}


public function ajax_get_applied_plan_context()
{
    header('Content-Type: application/json');

    $lead_id      = $this->input->get('lead_id');
    // $property_day = $this->input->get('property_day_id');
	$day_id_fk = $this->input->get('day_id_fk');
    $stay_dest    = $this->input->get('stay_destination_id');
    $property_id  = $this->input->get('property_id');
    $room_cat_id  = $this->input->get('room_category_id');

    if (!$lead_id || !$day_id_fk || !$stay_dest || !$property_id || !$room_cat_id) {
        echo json_encode(array(
            'status' => false,
            'message' => 'Missing params'
        ));
        return;
    }

    $data = $this->Quotation_model->get_applied_plan_by_context(
        $lead_id, $day_id_fk, $stay_dest, $property_id, $room_cat_id
    );

    echo json_encode(array(
        'status' => true,
        'data' => $data
    ));
}


public function ajax_get_tariff_by_context()
{
    header('Content-Type: application/json');

    $lead_id      = (int)$this->input->get('lead_id');
    $day_id_fk    = (int)$this->input->get('day_id_fk');
    $stay_dest    = (int)$this->input->get('stay_destination_id');
    $property_id  = (int)$this->input->get('property_id');
    $room_cat_id  = (int)$this->input->get('room_category_id');

    if (!$lead_id || !$day_id_fk || !$stay_dest || !$property_id || !$room_cat_id) {
        echo json_encode(array(
            'status'  => false,
            'message' => 'Missing params',
            'debug'   => array(
                'lead_id'             => $lead_id,
                'day_id_fk'           => $day_id_fk,
                'stay_destination_id' => $stay_dest,
                'property_id'         => $property_id,
                'room_category_id'    => $room_cat_id
            )
        ));
        exit;
    }

    $this->load->model('Quotation_model');

    $data = $this->Quotation_model->get_tariff_by_context(
        $lead_id,
        $day_id_fk,
        $stay_dest,
        $property_id,
        $room_cat_id
    );

    echo json_encode(array(
        'status' => true,
        'data'   => $data
    ));
    exit;
}

	public function ajax_get_saved_quotation_room_tariff_details_by_id()
	{
		header('Content-Type: application/json');

		$quotation_room_tariff_details_id = (int)$this->input->get('quotation_room_tariff_details_id');

		if (!$quotation_room_tariff_details_id) {
			echo json_encode(array(
				'status' => false,
				'message' => 'Missing quotation_room_tariff_details_id'
			));
			exit;
		}

		$this->load->model('Quotation_model');
		$row = $this->Quotation_model->get_quotation_room_tariff_details_by_id($quotation_room_tariff_details_id);

		if ($row) {
			echo json_encode(array(
				'status' => true,
				'data' => $row
			));
		} else {
			echo json_encode(array(
				'status' => false,
				'message' => 'No saved row found'
			));
		}
		exit;
	}

	public function ajax_get_quotation_room_tariff_details()
	{
		header('Content-Type: application/json');

		$day_id_fk   = (int)$this->input->get('packages_properties_days_id_fk');
		$room_row_fk = (int)$this->input->get('quotation_properties_rooms_id_fk');

		if (!$day_id_fk || !$room_row_fk) {
			echo json_encode([
				"status" => false,
				"message" => "Missing parameters"
			]);
			return;
		}

		$this->db->where('packages_properties_days_id_fk', $day_id_fk);
		$this->db->where('quotation_properties_rooms_id_fk', $room_row_fk);
		$this->db->where('quotation_room_tariff_details_status', 1);

		$row = $this->db->get('quotation_room_tariff_details')->row();

		if ($row) {
			echo json_encode([
				"status" => true,
				"data" => $row
			]);
		} else {
			echo json_encode([
				"status" => false,
				"message" => "No data found"
			]);
		}
	}
	public function get_properties()
	{
		$data = $this->Quotation_model->load_properties();
		echo json_encode(['status' => true, 'data' => $data]);
	}

	public function get_rooms()
	{
		$propertyId = $this->input->get('properties_id');
		$data = $this->Quotation_model->load_rooms($propertyId);
		echo json_encode(['status' => true, 'data' => $data]);
	}

	public function ajax_get_vehicle_list()
	{
		$this->load->model('Quotation_model');
		$data = $this->Quotation_model->get_active_vehicles();

		echo json_encode(array(
			'status' => true,
			'data'   => $data
		));
	}

	
	public function get_room_modal_details()
	{
		$lead_id = $this->input->get('lead_id');
		$property_id = $this->input->get('property_id');
		$room_category_id = $this->input->get('room_category_id');

		if (!$lead_id || !$property_id || !$room_category_id) {
			echo json_encode(['status' => false, 'message' => 'Missing parameters']);
			return;
		}

		$data = $this->Quotation_model->get_room_modal_details($lead_id, $property_id, $room_category_id);

		if (!$data) {
			echo json_encode(['status' => false, 'message' => 'No data found']);
			return;
		}

		echo json_encode(['status' => true, 'data' => $data]);
	}

	public function ajax_add_quotation_room_tariff_details()
	{
		header('Content-Type: application/json');

		// $quotation_room_tariff_details_id = (int)$this->input->post('quotation_room_tariff_details_id');
		// $day_id_fk   = (int)$this->input->post('packages_properties_days_id_fk');
		// $room_row_fk = (int)$this->input->post('quotation_properties_rooms_id_fk');

		// if (!$day_id_fk || !$room_row_fk) {
		// 	echo json_encode([
		// 		"status" => false,
		// 		"message" => "Missing required fields",
		// 		"debug" => [
		// 			"quotation_room_tariff_details_id" => $quotation_room_tariff_details_id,
		// 			"packages_properties_days_id_fk" => $day_id_fk,
		// 			"quotation_properties_rooms_id_fk" => $room_row_fk
		// 		]
		// 	]);
		// 	return;
		// }

		$quotation_room_tariff_details_id = (int)$this->input->post('quotation_room_tariff_details_id');
		$packages_properties_days_id_fk   = (int)$this->input->post('packages_properties_days_id_fk'); // can be 0
		$quotation_properties_rooms_id_fk = (int)$this->input->post('quotation_properties_rooms_id_fk'); // can be 0 for now


		$data = array(
			'packages_properties_days_id_fk'   => $packages_properties_days_id_fk,
			'quotation_properties_rooms_id_fk' => $quotation_properties_rooms_id_fk,

			// Pax
			'pax_wise_bed_adult_db_count' => (int)$this->input->post('pax_wise_bed_adult_db_count'),
			'pax_wise_bed_adult_eb_count' => (int)$this->input->post('pax_wise_bed_adult_eb_count'),
			'pax_wise_bed_adult_sgl_count'=> (int)$this->input->post('pax_wise_bed_adult_sgl_count'),

			'pax_wise_bed_child_db_count' => (int)$this->input->post('pax_wise_bed_child_db_count'),
			'pax_wise_bed_child_eb_count' => (int)$this->input->post('pax_wise_bed_child_eb_count'),
			'pax_wise_bed_child_sb_count' => (int)$this->input->post('pax_wise_bed_child_sb_count'),

			'pax_wise_bed_baby_db_count'  => (int)$this->input->post('pax_wise_bed_baby_db_count'),
			'pax_wise_bed_baby_eb_count'  => (int)$this->input->post('pax_wise_bed_baby_eb_count'),
			'pax_wise_bed_baby_sb_count'  => (int)$this->input->post('pax_wise_bed_baby_sb_count'),

			// Room
			'room_unit_auto_count'        => (int)$this->input->post('room_unit_auto_count'),
			'room_unit_auto_rate'         => (float)$this->input->post('room_unit_auto_rate'),
			'room_unit_auto_total_rate'   => (float)$this->input->post('room_unit_auto_total_rate'),

			'room_unit_manual_count'      => (int)$this->input->post('room_unit_manual_count'),
			'room_unit_manual_rate'       => (float)$this->input->post('room_unit_manual_rate'),
			'room_unit_manual_total_rate' => (float)$this->input->post('room_unit_manual_total_rate'),

			// Extra bed adult
			'extra_bed_adult_auto_count'        => (int)$this->input->post('extra_bed_adult_auto_count'),
			'extra_bed_adult_auto_rate'         => (float)$this->input->post('extra_bed_adult_auto_rate'),
			'extra_bed_adult_auto_total_rate'   => (float)$this->input->post('extra_bed_adult_auto_total_rate'),

			'extra_bed_adult_manual_count'      => (int)$this->input->post('extra_bed_adult_manual_count'),
			'extra_bed_adult_manual_rate'       => (float)$this->input->post('extra_bed_adult_manual_rate'),
			'extra_bed_adult_manual_total_rate' => (float)$this->input->post('extra_bed_adult_manual_total_rate'),

			// Extra bed child
			'extra_bed_child_auto_count'        => (int)$this->input->post('extra_bed_child_auto_count'),
			'extra_bed_child_auto_rate'         => (float)$this->input->post('extra_bed_child_auto_rate'),
			'extra_bed_child_auto_total_rate'   => (float)$this->input->post('extra_bed_child_auto_total_rate'),

			'extra_bed_child_manual_count'      => (int)$this->input->post('extra_bed_child_manual_count'),
			'extra_bed_child_manual_rate'       => (float)$this->input->post('extra_bed_child_manual_rate'),
			'extra_bed_child_manual_total_rate' => (float)$this->input->post('extra_bed_child_manual_total_rate'),

			// Child sharing
			'child_sharing_bed_auto_count'        => (int)$this->input->post('child_sharing_bed_auto_count'),
			'child_sharing_bed_auto_rate'         => (float)$this->input->post('child_sharing_bed_auto_rate'),
			'child_sharing_bed_auto_total_rate'   => (float)$this->input->post('child_sharing_bed_auto_total_rate'),

			'child_sharing_bed_manual_count'      => (int)$this->input->post('child_sharing_bed_manual_count'),
			'child_sharing_bed_manual_rate'       => (float)$this->input->post('child_sharing_bed_manual_rate'),
			'child_sharing_bed_manual_total_rate' => (float)$this->input->post('child_sharing_bed_manual_total_rate'),

			// Single
			'single_occupancy_auto_count'        => (int)$this->input->post('single_occupancy_auto_count'),
			'single_occupancy_auto_rate'         => (float)$this->input->post('single_occupancy_auto_rate'),
			'single_occupancy_auto_total_rate'   => (float)$this->input->post('single_occupancy_auto_total_rate'),

			'single_occupancy_manual_count'      => (int)$this->input->post('single_occupancy_manual_count'),
			'single_occupancy_manual_rate'       => (float)$this->input->post('single_occupancy_manual_rate'),
			'single_occupancy_manual_total_rate' => (float)$this->input->post('single_occupancy_manual_total_rate'),

			// Supplement
			'supplyment_auto_cost'        => (float)$this->input->post('supplyment_auto_cost'),
			'supplyment_auto_total_cost'  => (float)$this->input->post('supplyment_auto_total_cost'),
			'supplyment_manual_cost'      => (float)$this->input->post('supplyment_manual_cost'),
			'supplyment_manual_total_cost'=> (float)$this->input->post('supplyment_manual_total_cost'),

			// totals
			'auto_total_rate'   => (float)$this->input->post('auto_total_rate'),
			'manual_total_rate' => (float)$this->input->post('manual_total_rate'),

			'quotation_room_tariff_details_status' => 1
		);

		// ✅ UPDATE
		// if ($quotation_room_tariff_details_id > 0) {

		// 	$this->db->where('quotation_room_tariff_details_id', $quotation_room_tariff_details_id);
		// 	$this->db->update('quotation_room_tariff_details', $data);

		// 	echo json_encode([
		// 		"status" => true,
		// 		"quotation_room_tariff_details_id" => $quotation_room_tariff_details_id,
		// 		"mode" => "update",
		// 		"auto_total_rate" => $data['auto_total_rate'],
		// 		"manual_total_rate" => $data['manual_total_rate']
		// 	]);
		// 	return;
		// }

		// // ✅ INSERT
		// $this->db->insert('quotation_room_tariff_details', $data);
		// $insert_id = $this->db->insert_id();

		// echo json_encode([
		// 	"status" => true,
		// 	"quotation_room_tariff_details_id" => $insert_id,
		// 	"mode" => "insert",
		// 	"auto_total_rate" => $data['auto_total_rate'],
		// 	"manual_total_rate" => $data['manual_total_rate']
		// ]);

		if ($quotation_room_tariff_details_id > 0) {
			$ok = $this->Quotation_model->update_quotation_room_tariff_details($quotation_room_tariff_details_id, $data);

			echo json_encode(array(
				'status' => $ok ? true : false,
				'quotation_room_tariff_details_id' => $quotation_room_tariff_details_id,
				'auto_total_rate' => $this->input->post('auto_total_rate'),
				'manual_total_rate' => $this->input->post('manual_total_rate')
			));
			exit;
		} else {
			$new_id = $this->Quotation_model->add_quotation_room_tariff_details($data);

			echo json_encode(array(
				'status' => $new_id ? true : false,
				'quotation_room_tariff_details_id' => $new_id,
				'auto_total_rate' => $this->input->post('auto_total_rate'),
				'manual_total_rate' => $this->input->post('manual_total_rate')
			));
			exit;
		}
	}

	// public function ajax_add_quotation_room_tariff_details()
	// {
	// 	header('Content-Type: application/json');

	// 	$quotation_room_tariff_details_id = (int)$this->input->post('quotation_room_tariff_details_id');
	// 	$packages_properties_days_id_fk   = (int)$this->input->post('packages_properties_days_id_fk'); // can be 0
	// 	$quotation_properties_rooms_id_fk = (int)$this->input->post('quotation_properties_rooms_id_fk'); // can be 0 for now

	// 	$data = array(
	// 		'packages_properties_days_id_fk'   => $packages_properties_days_id_fk,
	// 		'quotation_properties_rooms_id_fk' => $quotation_properties_rooms_id_fk,

	// 		'pax_wise_bed_adult_db_count'      => $this->input->post('pax_wise_bed_adult_db_count'),
	// 		'pax_wise_bed_adult_eb_count'      => $this->input->post('pax_wise_bed_adult_eb_count'),
	// 		'pax_wise_bed_adult_sgl_count'     => $this->input->post('pax_wise_bed_adult_sgl_count'),

	// 		'pax_wise_bed_child_db_count'      => $this->input->post('pax_wise_bed_child_db_count'),
	// 		'pax_wise_bed_child_eb_count'      => $this->input->post('pax_wise_bed_child_eb_count'),
	// 		'pax_wise_bed_child_sb_count'      => $this->input->post('pax_wise_bed_child_sb_count'),

	// 		'pax_wise_bed_baby_db_count'       => $this->input->post('pax_wise_bed_baby_db_count'),
	// 		'pax_wise_bed_baby_eb_count'       => $this->input->post('pax_wise_bed_baby_eb_count'),
	// 		'pax_wise_bed_baby_sb_count'       => $this->input->post('pax_wise_bed_baby_sb_count'),

	// 		'room_unit_auto_count'             => $this->input->post('room_unit_auto_count'),
	// 		'room_unit_auto_rate'              => $this->input->post('room_unit_auto_rate'),
	// 		'room_unit_auto_total_rate'        => $this->input->post('room_unit_auto_total_rate'),

	// 		'extra_bed_adult_auto_count'       => $this->input->post('extra_bed_adult_auto_count'),
	// 		'extra_bed_adult_auto_rate'        => $this->input->post('extra_bed_adult_auto_rate'),
	// 		'extra_bed_adult_auto_total_rate'  => $this->input->post('extra_bed_adult_auto_total_rate'),

	// 		'extra_bed_child_auto_count'       => $this->input->post('extra_bed_child_auto_count'),
	// 		'extra_bed_child_auto_rate'        => $this->input->post('extra_bed_child_auto_rate'),
	// 		'extra_bed_child_auto_total_rate'  => $this->input->post('extra_bed_child_auto_total_rate'),

	// 		'child_sharing_bed_auto_count'     => $this->input->post('child_sharing_bed_auto_count'),
	// 		'child_sharing_bed_auto_rate'      => $this->input->post('child_sharing_bed_auto_rate'),
	// 		'child_sharing_bed_auto_total_rate'=> $this->input->post('child_sharing_bed_auto_total_rate'),

	// 		'single_occupancy_auto_count'      => $this->input->post('single_occupancy_auto_count'),
	// 		'single_occupancy_auto_rate'       => $this->input->post('single_occupancy_auto_rate'),
	// 		'single_occupancy_auto_total_rate' => $this->input->post('single_occupancy_auto_total_rate'),

	// 		'supplyment_auto_cost'             => $this->input->post('supplyment_auto_cost'),
	// 		'supplyment_auto_total_cost'       => $this->input->post('supplyment_auto_total_cost'),

	// 		'room_unit_manual_count'           => $this->input->post('room_unit_manual_count'),
	// 		'room_unit_manual_rate'            => $this->input->post('room_unit_manual_rate'),
	// 		'room_unit_manual_total_rate'      => $this->input->post('room_unit_manual_total_rate'),

	// 		'extra_bed_adult_manual_count'     => $this->input->post('extra_bed_adult_manual_count'),
	// 		'extra_bed_adult_manual_rate'      => $this->input->post('extra_bed_adult_manual_rate'),
	// 		'extra_bed_adult_manual_total_rate'=> $this->input->post('extra_bed_adult_manual_total_rate'),

	// 		'extra_bed_child_manual_count'     => $this->input->post('extra_bed_child_manual_count'),
	// 		'extra_bed_child_manual_rate'      => $this->input->post('extra_bed_child_manual_rate'),
	// 		'extra_bed_child_manual_total_rate'=> $this->input->post('extra_bed_child_manual_total_rate'),

	// 		'child_sharing_bed_manual_count'   => $this->input->post('child_sharing_bed_manual_count'),
	// 		'child_sharing_bed_manual_rate'    => $this->input->post('child_sharing_bed_manual_rate'),
	// 		'child_sharing_bed_manual_total_rate' => $this->input->post('child_sharing_bed_manual_total_rate'),

	// 		'single_occupancy_manual_count'    => $this->input->post('single_occupancy_manual_count'),
	// 		'single_occupancy_manual_rate'     => $this->input->post('single_occupancy_manual_rate'),
	// 		'single_occupancy_manual_total_rate'=> $this->input->post('single_occupancy_manual_total_rate'),

	// 		'supplyment_manual_cost'           => $this->input->post('supplyment_manual_cost'),
	// 		'supplyment_manual_total_cost'     => $this->input->post('supplyment_manual_total_cost'),

	// 		'auto_total_rate'                  => $this->input->post('auto_total_rate'),
	// 		'manual_total_rate'                => $this->input->post('manual_total_rate'),
	// 		'quotation_room_tariff_details_status' => 1
	// 	);

	// 	if ($quotation_room_tariff_details_id > 0) {
	// 		$ok = $this->Quotation_model->update_quotation_room_tariff_details($quotation_room_tariff_details_id, $data);

	// 		echo json_encode(array(
	// 			'status' => $ok ? true : false,
	// 			'quotation_room_tariff_details_id' => $quotation_room_tariff_details_id,
	// 			'auto_total_rate' => $this->input->post('auto_total_rate'),
	// 			'manual_total_rate' => $this->input->post('manual_total_rate')
	// 		));
	// 		exit;
	// 	} else {
	// 		$new_id = $this->Quotation_model->add_quotation_room_tariff_details($data);

	// 		echo json_encode(array(
	// 			'status' => $new_id ? true : false,
	// 			'quotation_room_tariff_details_id' => $new_id,
	// 			'auto_total_rate' => $this->input->post('auto_total_rate'),
	// 			'manual_total_rate' => $this->input->post('manual_total_rate')
	// 		));
	// 		exit;
	// 	}
	// }
	public function ajax_add_old()
	{

		
		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());

		// $itineraries_name = $this->input->post('itineraries_name');
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');
		
		$quotation_date = str_replace('/','-', $this->input->post('quotation_date'));
		$quotation_date = date("Y-m-d h:i:s a",strtotime($quotation_date));

		$data = array(

				'leads_id_fk' => $this->input->post('leads_id_fk'),
				'package_id_fk' => $this->input->post('package_id_fk'),
				'quotation_date' => $quotation_date,
				'arriving_destination' => $this->input->post('arriving_destination'),
				'departuring_destination' => $this->input->post('departuring_destination'),
				'quotation_remarks' => $this->input->post('quotation_remarks'),
				'quotation_created_by_userid' => $currentuserid,			
				'quotation_created_by_username' => $currentusername,			
				'quotation_created_date' => $date,			
				'quotation_created_time' => $time,			
				'quotation_status' => 1
			);
		
		$insert = $this->Quotation_model->save($data);

		$packages_properties_common_id_fk = $this->input->post('packages_properties_common_id_fk');
		$quotation_options_title = $this->input->post('quotation_options_title');
		$quotation_options_cab_amount = $this->input->post('quotation_options_cab_amount');

		if($insert){

			//foreach ($ledger_id as $key => $value) {
			foreach ($packages_properties_common_id_fk as $key => $value) {

						$data_quotation_option_add = array(
							'quotation_id_fk' => $insert,
							'packages_properties_common_id_fk' => $packages_properties_common_id_fk[$key],
							'quotation_options_title' => $quotation_options_title[$key],
							'quotation_options_cab_amount' => $quotation_options_cab_amount[$key],				
							'quotation_options_status' => 1
							);
						//echo '<pre>'; print_r($data_terms_condition_item_add); exit();
						$quotation_options_id = $this->General_model->add_returnID($this->quotation_options,$data_quotation_option_add);
						// // print_r($data);exit();
						//$response_text = 'Payment policies added successfully';
						
					// }
				
				$packages_properties_days_id_fk = $this->input->post('packages_properties_days_id_fk');
				$quotation_properties_days_day = $this->input->post('quotation_properties_days_day');
				$quotation_properties_days_destination_id_fk = $this->input->post('quotation_properties_days_destination_id_fk');

				foreach ($packages_properties_days_id_fk as $key => $value) {

							$data_properties_days_add = array(
								'quotation_id_fk' => $insert,
								'quotation_options_id_fk' => $quotation_options_id,
								'packages_properties_days_id_fk' => $packages_properties_days_id_fk[$key],
								'quotation_properties_days_day' => $quotation_properties_days_day[$key],
								'quotation_properties_days_destination_id_fk' => $quotation_properties_days_destination_id_fk[$key],				
								'quotation_properties_days_status' => 1
								);
							//echo '<pre>'; print_r($data_terms_condition_item_add); exit();
							$quotation_properties_days_id = $this->General_model->add($this->quotation_properties_days,$data_properties_days_add);
							// // print_r($data);exit();
							//$response_text = 'Payment policies added successfully';
							
						// }
						
						$packages_properties_id_fk = $this->input->post('packages_properties_id_fk');
						$properties_id_fk = $this->input->post('properties_id_fk');						

						foreach ($packages_properties_id_fk as $key => $value) {

									$data_quotation_properties_add = array(
										'quotation_properties_days_id_fk' => $quotation_properties_days_id,
										'packages_properties_id_fk' => $packages_properties_id_fk[$key],
										'properties_id_fk' => $properties_id_fk[$key],										
										'quotation_properties_status' => 1
										);
									//echo '<pre>'; print_r($data_terms_condition_item_add); exit();
									$quotation_properties_id = $this->General_model->add($this->quotation_properties,$data_quotation_properties_add);
									// // print_r($data);exit();
									//$response_text = 'Payment policies added successfully';
									
								// }
								
								$packages_properties_rooms_id_fk = $this->input->post('packages_properties_rooms_id_fk');
								$quotation_properties_rooms_id_fk = $this->input->post('quotation_properties_rooms_id_fk');						

								foreach ($packages_properties_rooms_id_fk as $key => $value) {

											$data_quotation_properties_rooms_add = array(
												'quotation_properties_id_fk' => $quotation_properties_id,
												'packages_properties_rooms_id_fk' => $packages_properties_rooms_id_fk[$key],
												'quotation_properties_rooms_id_fk' => $quotation_properties_rooms_id_fk[$key],										
												'quotation_properties_rooms_status' => 1
												);
											//echo '<pre>'; print_r($data_terms_condition_item_add); exit();
											$result = $this->General_model->add($this-> quotation_properties_rooms,$data_quotation_properties_rooms_add);
											// // print_r($data);exit();
											//$response_text = 'Payment policies added successfully';
											
										// }
										
								}
						}
				}
			}
	}

		
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_addversion()
	{
		$payload = json_decode($this->input->post('data'), true);

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());
		
		$currentuserid = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');

		/* ================= SAVE QUOTATION ================= */

		$quotationData = [
			'leads_id_fk' => $this->input->post('leads_id'),
			'package_id_fk' => $this->input->post('packages_id_fk'),
			'quotation_date' => $this->input->post('quotation_date'),
			'quotation_remarks' => $this->input->post('quotation_remarks'),
			 // ✅ NEW TOTALS (from hidden inputs)
			'total_inclusion_amount' => $this->input->post('total_inclusion_amount'),
			'total_special_requirment_amount' => $this->input->post('total_special_requirment_amount'),
			'quotation_created_by_userid' => $currentuserid,			
			'quotation_created_by_username' => $currentusername,			
			'quotation_created_date' => $date,			
			'quotation_created_time' => $time,			
			'quotation_status' => 1
		];

		$quotation_id = $this->Quotation_model->save($quotationData);

		$package_id = (int)$this->input->post('packages_id_fk');

		$this->db->trans_begin();

		try {

			// ✅ Copy package data into quotation tables
			$itineraryMap = $this->Quotation_model->copy_package_itinerary_to_quotation($quotation_id, $package_id);
			$this->Quotation_model->copy_package_itinerary_days_to_quotation($quotation_id, $itineraryMap);

			$this->Quotation_model->copy_packages_inclusions($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_exclusions($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_optional_add_on($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_payment_policies($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_terms_condition($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_cancellation_policies($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_notes($quotation_id, $package_id);

			// ✅ Your existing loops (options/days/properties/rooms/inclusions/special req) continue here...

			if ($this->db->trans_status() === false) {
				throw new Exception('DB transaction failed');
			}

			$this->db->trans_commit();

			echo json_encode(['status' => true]);
			return;

		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(['status' => false, 'message' => $e->getMessage()]);
			return;
		}

		/* ================= OPTIONS ================= */

		foreach ($payload['options'] as $option) {

			$option_id = $this->General_model->add_returnID(
				$this->quotation_options,
				[
					'quotation_id_fk' => $quotation_id,
					'packages_properties_common_id_fk' => $option['packages_properties_common_id_fk'],
					'quotation_options_title' => $option['title'],
					'quotation_options_cab_amount' => $option['cab_amount'],
					// ✅ NEW FIELDS
					'quotation_options_total_cost' => $option['quotation_options_total_cost'],
					'quotation_options_margin_type' => $option['quotation_options_margin_type'],   // 'percent' or 'amount'
					'quotation_options_margin_value' => $option['quotation_options_margin_value'],
					'quotation_options_total_quote_rate' => $option['quotation_options_total_quote_rate'],			

					'quotation_options_status' => 1
				]
			);

			/* ================= DAYS ================= */

			foreach ($option['days'] as $day) {

				$day_id = $this->General_model->add_returnID(
					$this->quotation_properties_days,
					[
						'quotation_id_fk' => $quotation_id,
						'quotation_options_id_fk' => $option_id,
						'packages_properties_days_id_fk' => $day['packages_properties_days_id_fk'],
						'quotation_properties_days_day' => $day['day'],
						'quotation_properties_days_destination_id_fk' => $day['destination_id'],
						'quotation_properties_days_status' => 1
					]
				);

				/* ================= PROPERTIES ================= */

				foreach ($day['properties'] as $property) {

					$property_id = $this->General_model->add_returnID(
						$this->quotation_properties,
						[
							'quotation_properties_days_id_fk' => $day_id,
							'packages_properties_id_fk' => $property['packages_properties_id_fk'],
							'properties_id_fk' => $property['properties_id_fk'],
							'quotation_properties_status' => 1
						]
					);

					/* ================= ROOMS ================= */

					// foreach ($property['rooms'] as $room) {

					// 	$this->General_model->add(
					// 		$this->quotation_properties_rooms,
					// 		[
					// 			'quotation_properties_id_fk' => $property_id,
					// 			'packages_properties_rooms_id_fk' => $room['packages_properties_rooms_id_fk'],
					// 			'quotation_properties_rooms_id_fk' => $room['quotation_properties_rooms_id_fk'],
					// 			'quotation_properties_rooms_status' => 1
					// 		]
					// 	);
					// }
					/* ================= ROOMS ================= */
					foreach ($property['rooms'] as $room) {

						$this->General_model->add(
							$this->quotation_properties_rooms,
							[
								'quotation_properties_id_fk' => $property_id,
								'packages_properties_rooms_id_fk' => $room['packages_properties_rooms_id_fk'],
								'quotation_properties_rooms_id_fk' => $room['quotation_properties_rooms_id_fk'],

								// ✅ NEW FIELD
								'total_room_cost' => isset($room['total_room_cost']) ? (float)$room['total_room_cost'] : 0,

								'quotation_properties_rooms_status' => 1
							]
						);
					}

					/* ================= SAVE PROPERTY INCLUSIONS ================= */
if (!empty($payload['inclusions']) && is_array($payload['inclusions'])) {

    foreach ($payload['inclusions'] as $inc) {

        // dayKey: property_day_id|stay_destination_id|accommodation_date
        $parts = explode('|', $inc['dayKey']);
        $property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;
        $stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;
        $acc_date        = isset($parts[2]) ? $parts[2] : null;

        if (!$property_day_id || !$stay_dest_id) continue;

        $this->Quotation_model->add_property_inclusion([
            'quotation_id_fk' => $quotation_id,
            'packages_properties_days_id_fk' => $property_day_id,
            'stay_destination_id_fk' => $stay_dest_id,
            'accommodation_date' => $acc_date, // if you have this column, else remove
            'inclusion_name' => $inc['name'],
            'inclusion_amount' => $inc['amount'],
            'quotation_property_inclusions_status' => 1
        ]);
    }
}

/* ================= SAVE SPECIAL REQUIREMENTS ================= */
if (!empty($payload['special_requirements']) && is_array($payload['special_requirements'])) {

    foreach ($payload['special_requirements'] as $sr) {

        $parts = explode('|', $sr['dayKey']);
        $property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;
        $stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;
        $acc_date        = isset($parts[2]) ? $parts[2] : null;

        if (!$property_day_id || !$stay_dest_id) continue;

        $this->Quotation_model->add_special_requirement([
            'quotation_id_fk' => $quotation_id,
            'packages_properties_days_id_fk' => $property_day_id,
            'stay_destination_id_fk' => $stay_dest_id,
            'accommodation_date' => $acc_date, // if column exists
            'quotation_special_requirements_id_fk' => (int)$sr['quotation_special_requirements_id_fk'],
            'quotation_special_requirements_cost' => $sr['cost'],
            'quotation_special_requirements_status' => 1
        ]);
    }
}



				}
			}
		}

		echo json_encode(['status' => true]);
	}

	// private function copy_file_to_quotation_cover($filename)
    // {
    //     if (!$filename) return '';

    //     $src = FCPATH . 'uploads/itinerary_cover/' . $filename;
    //     if (!file_exists($src)) return '';

    //     $ext = pathinfo($filename, PATHINFO_EXTENSION);
    //     $newName = uniqid('quotation_cover_') . '.' . $ext;
    //     $dest = FCPATH . 'uploads/quotation_cover/' . $newName;

    //     if (@copy($src, $dest)) {
    //         return $newName;
    //     }

    //     return '';
    // }

	private function copy_file_to_quotation_cover($filename)
	{
		if (!$filename) return '';

		$src = FCPATH . 'uploads/packages_cover/' . $filename;

		if (!file_exists($src)) {
			return ''; // file not found
		}

		$ext = pathinfo($filename, PATHINFO_EXTENSION);
		$newName = uniqid('quotation_cover_') . '.' . $ext;

		$destDir = FCPATH . 'uploads/quotation_cover/';
		if (!is_dir($destDir)) {
			mkdir($destDir, 0777, true);
		}

		$dest = $destDir . $newName;

		if (@copy($src, $dest)) {
			return $newName;
		}

		return '';
	}
	
	public function ajax_add()
	{
		$payload = json_decode($this->input->post('data'), true);

		$this->load->helper('date');
		if (function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}

		$date = date('Y-m-d');
		$time = date('h:i:sa');

		$currentuserid   = $this->session->userdata('user_id');
		$currentusername = $this->session->userdata('admin_name');

		$last_insert_id_quotation = $this->Quotation_model->last_id_quotation();
		if(empty($last_insert_id_quotation)){ $last_id_quotation = 0;}
		else{ $last_id_quotation = $last_insert_id_quotation->quotation_id; }

		if($last_id_quotation == 0){
			$quotation_num = 0;
		} else {
			$quotation_num = $last_insert_id_quotation->quotation_id;
		}
		$quotation_number = $quotation_num+1;
		$quotation_number1 = "Quot-$quotation_number";

		$quotation_date = str_replace('/','-', $this->input->post('quotation_date'));
		$quotation_date = date("Y-m-d h:i:s a",strtotime($quotation_date));

		$package_id = (int)$this->input->post('packages_id_fk');

		// ✅ START TRANSACTION BEFORE ANY INSERTS
		$this->db->trans_begin();

		try {

			/* ================= SAVE QUOTATION ================= */

			$package = $this->Quotation_model->get_package_basic_details($package_id);

			$quotationData = [
				'leads_id_fk' => $this->input->post('leads_id'),
				'quotation_number' => $quotation_number1,
				'package_id_fk' => $this->input->post('packages_id_fk'),
				'quotation_date' => $quotation_date,
				'arriving_destination' => $this->input->post('arriving_destination'),
				'departuring_destination' => $this->input->post('departuring_destination'),
				'quotation_remarks' => $this->input->post('quotation_remarks'),

				'quotation_inclusion_exclusion_common_id_fk' => isset($package->packages_inclusion_exclusion_common_id_fk) ? $package->packages_inclusion_exclusion_common_id_fk : 0,
				'quotation_inclusion_exclusion_checked_type' => isset($package->packages_inclusion_exclusion_checked_type) ? $package->packages_inclusion_exclusion_checked_type : '',
				'quotation_optional_add_on_checked_type' => isset($package->packages_optional_add_on_checked_type) ? $package->packages_optional_add_on_checked_type : '',
				'quotation_payment_policies_checked_type' => isset($package->packages_payment_policies_checked_type) ? $package->packages_payment_policies_checked_type : '',
				'quotation_terms_conditions_checked_type' => isset($package->packages_terms_conditions_checked_type) ? $package->packages_terms_conditions_checked_type : '',
				'quotation_cancellation_policy_checked_type' => isset($package->packages_cancellation_policy_checked_type) ? $package->packages_cancellation_policy_checked_type : '',
				'quotation_notes_checked_type' => isset($package->packages_notes_checked_type) ? $package->packages_notes_checked_type : '',
				'quotation_title' => isset($package->packages_title) ? $package->packages_title : '',

				'quotation_first_cover_page' => '',
				'quotation_last_cover_page' => '',

				'total_inclusion_amount' => $this->input->post('total_inclusion_amount'),
				'total_special_requirment_amount' => $this->input->post('total_special_requirment_amount'),
				'quotation_created_by_userid' => $currentuserid,
				'quotation_created_by_username' => $currentusername,
				'quotation_created_date' => $date,
				'quotation_created_time' => $time,
				'quotation_current_status' => 1,
				'quotation_status' => 1
			];

			$quotation_id = $this->Quotation_model->save($quotationData);

			if (!$quotation_id) {
				throw new Exception('Quotation insert failed');
			}

			$room_tariff_detail_ids = $this->input->post('quotation_room_tariff_details_id');

			if (!empty($room_tariff_detail_ids) && is_array($room_tariff_detail_ids)) {
				$clean_ids = array();

				foreach ($room_tariff_detail_ids as $rid) {
					$rid = (int)$rid;
					if ($rid > 0) {
						$clean_ids[] = $rid;
					}
				}

				if (!empty($clean_ids)) {
					$this->Quotation_model->update_room_tariff_details_quotation_id($clean_ids, $quotation_id);
				}
			}

			$firstCover = '';
			$lastCover = '';

			if (!empty($package->packages_first_cover_page)) {
				$firstCover = $this->copy_file_to_quotation_cover($package->packages_first_cover_page);
			}

			if (!empty($package->packages_last_cover_page)) {
				$lastCover = $this->copy_file_to_quotation_cover($package->packages_last_cover_page);
			}

			$this->db->where('quotation_id', $quotation_id)->update('quotation', [
				'quotation_first_cover_page' => $firstCover,
				'quotation_last_cover_page' => $lastCover
			]);

			/* ================= COPY PACKAGE DATA ================= */
			$itineraryMap = $this->Quotation_model->copy_package_itinerary_to_quotation($quotation_id, $package_id);
			$this->Quotation_model->copy_package_itinerary_days_to_quotation($quotation_id, $itineraryMap);
			$this->Quotation_model->copy_packages_inclusions($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_exclusions($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_optional_add_on($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_payment_policies($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_terms_condition($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_cancellation_policies($quotation_id, $package_id);
			$this->Quotation_model->copy_packages_notes($quotation_id, $package_id);

			/* ================= OPTIONS ================= */
			if (!empty($payload['options']) && is_array($payload['options'])) {

				foreach ($payload['options'] as $option) {

					$option_id = $this->General_model->add_returnID(
						$this->quotation_options,
						[
							'quotation_id_fk' => $quotation_id,
							'packages_properties_common_id_fk' => $option['packages_properties_common_id_fk'],
							'quotation_options_title' => $option['title'],
							'quotation_options_cab_amount' => $option['cab_amount'],
							'quotation_options_design_type' => $option['quotation_options_design_type'],
							'quotation_options_vehicle_id_fk' => $option['quotation_options_vehicle_id_fk'],
							'quotation_options_room_category_display' => $option['quotation_options_room_category_display'],
							'quotation_options_meal_plan_display' => $option['quotation_options_meal_plan_display'],
							'quotation_options_total_cost' => $option['quotation_options_total_cost'],
							'quotation_options_margin_type' => $option['quotation_options_margin_type'],
							'quotation_options_margin_value' => $option['quotation_options_margin_value'],
							'quotation_options_total_quote_rate' => $option['quotation_options_total_quote_rate'],

							'quotation_options_status' => 1
						]
					);

					if (!$option_id) throw new Exception('Option insert failed');

					/* ================= DAYS ================= */
					foreach ($option['days'] as $day) {

						$day_id = $this->General_model->add_returnID(
							$this->quotation_properties_days,
							[
								'quotation_id_fk' => $quotation_id,
								'quotation_options_id_fk' => $option_id,
								'packages_properties_days_id_fk' => $day['packages_properties_days_id_fk'],
								'quotation_properties_days_day' => $day['day'],
								'quotation_properties_days_destination_id_fk' => $day['destination_id'],
								'quotation_properties_days_status' => 1
							]
						);

						if (!$day_id) throw new Exception('Day insert failed');

						/* ================= PROPERTIES ================= */
						foreach ($day['properties'] as $property) {

							$property_id = $this->General_model->add_returnID(
								$this->quotation_properties,
								[
									'quotation_properties_days_id_fk' => $day_id,
									'packages_properties_id_fk' => $property['packages_properties_id_fk'],
									'properties_id_fk' => $property['properties_id_fk'],
									'quotation_properties_status' => 1
								]
							);

							if (!$property_id) throw new Exception('Property insert failed');

							/* ================= ROOMS ================= */
							// foreach ($property['rooms'] as $room) {

							// 	$ok = $this->General_model->add(
							// 		$this->quotation_properties_rooms,
							// 		[
							// 			'quotation_properties_id_fk' => $property_id,
							// 			'packages_properties_rooms_id_fk' => $room['packages_properties_rooms_id_fk'],
							// 			'quotation_properties_rooms_id_fk' => $room['quotation_properties_rooms_id_fk'],
							// 			'total_room_cost' => isset($room['total_room_cost']) ? (float)$room['total_room_cost'] : 0,
							// 			'quotation_properties_rooms_status' => 1
							// 		]
							// 	);

							// 	if (!$ok) throw new Exception('Room insert failed');
							// }

							foreach ($property['rooms'] as $room) {

								$quotation_properties_room_id = $this->General_model->add_returnID(
									$this->quotation_properties_rooms,
									array(
										'quotation_properties_id_fk' => $property_id,
										'packages_properties_rooms_id_fk' => $room['packages_properties_rooms_id_fk'],
										'quotation_properties_rooms_id_fk' => $room['quotation_properties_rooms_id_fk'],
										'total_room_cost' => isset($room['total_room_cost']) ? (float)$room['total_room_cost'] : 0,
										'quotation_properties_rooms_status' => 1
									)
								);

								if (!$quotation_properties_room_id) {
									throw new Exception('Room insert failed');
								}

								// ✅ update real quotation_properties_rooms_id into quotation_room_tariff_details
								$quotation_room_tariff_details_id = isset($room['quotation_room_tariff_details_id'])
									? (int)$room['quotation_room_tariff_details_id']
									: 0;

								if ($quotation_room_tariff_details_id > 0) {
									$this->Quotation_model->update_room_tariff_room_fk(
										$quotation_room_tariff_details_id,
										$quotation_properties_room_id,
										$quotation_id
									);
								}
							}
						}
					}

					/* ================= DAYS ================= */
// 					foreach ($option['days'] as $day) {

// 						// ✅ fetch quotation_itinerary_days_id for this package day
// 						$quotation_itinerary_days_id_fk = $this->Quotation_model->get_quotation_itinerary_day_id(
// 							$quotation_id,
// 							$day['packages_properties_days_id_fk']
// 						);
// // print_r($quotation_id);die;
// 						$day_id = $this->General_model->add_returnID(
// 							$this->quotation_properties_days,
// 							array(
// 								'quotation_id_fk' => $quotation_id,
// 								'quotation_options_id_fk' => $option_id,
// 								'packages_properties_days_id_fk' => $day['packages_properties_days_id_fk'],
// 								'quotation_itinerary_days_id_fk' => $quotation_itinerary_days_id_fk, // ✅ save FK here
// 								'quotation_properties_days_day' => $day['day'],
// 								'quotation_properties_days_destination_id_fk' => $day['destination_id'],
// 								'quotation_properties_days_status' => 1
// 							)
// 						);

// 						if (!$day_id) throw new Exception('Day insert failed');

// 						/* ================= PROPERTIES ================= */
// 						foreach ($day['properties'] as $property) {

// 							$property_id = $this->General_model->add_returnID(
// 								$this->quotation_properties,
// 								array(
// 									'quotation_properties_days_id_fk' => $day_id,
// 									'packages_properties_id_fk' => $property['packages_properties_id_fk'],
// 									'properties_id_fk' => $property['properties_id_fk'],
// 									'quotation_properties_status' => 1
// 								)
// 							);

// 							if (!$property_id) throw new Exception('Property insert failed');

// 							/* ================= ROOMS ================= */
// 							foreach ($property['rooms'] as $room) {

// 								$ok = $this->General_model->add(
// 									$this->quotation_properties_rooms,
// 									array(
// 										'quotation_properties_id_fk' => $property_id,
// 										'packages_properties_rooms_id_fk' => $room['packages_properties_rooms_id_fk'],
// 										'quotation_properties_rooms_id_fk' => $room['quotation_properties_rooms_id_fk'],
// 										'total_room_cost' => isset($room['total_room_cost']) ? (float)$room['total_room_cost'] : 0,
// 										'quotation_properties_rooms_status' => 1
// 									)
// 								);

// 								if (!$ok) throw new Exception('Room insert failed');
// 							}
// 						}
// 					}
					/* ================= DAYS ================= */
					// foreach ($option['days'] as $day) {

					// 	$packages_properties_days_id_fk = (int)$day['packages_properties_days_id_fk'];

					// 	// ✅ get quotation_itinerary_days_id from quotation_itinerary_days table
					// 	$quotation_itinerary_days_id_fk = isset($quotationItineraryDayMap[$packages_properties_days_id_fk])
					// 		? (int)$quotationItineraryDayMap[$packages_properties_days_id_fk]
					// 		: 0;

					// 	$day_id = $this->General_model->add_returnID(
					// 		$this->quotation_properties_days,
					// 		array(
					// 			'quotation_id_fk' => $quotation_id,
					// 			'quotation_options_id_fk' => $option_id,
					// 			'packages_properties_days_id_fk' => $packages_properties_days_id_fk,
					// 			'quotation_itinerary_days_id_fk' => $quotation_itinerary_days_id_fk, // ✅ NEW FIELD
					// 			'quotation_properties_days_day' => $day['day'],
					// 			'quotation_properties_days_destination_id_fk' => $day['destination_id'],
					// 			'quotation_properties_days_status' => 1
					// 		)
					// 	);

					// 	if (!$day_id) throw new Exception('Day insert failed');

					// 	/* ================= PROPERTIES ================= */
					// 	foreach ($day['properties'] as $property) {

					// 		$property_id = $this->General_model->add_returnID(
					// 			$this->quotation_properties,
					// 			array(
					// 				'quotation_properties_days_id_fk' => $day_id,
					// 				'packages_properties_id_fk' => $property['packages_properties_id_fk'],
					// 				'properties_id_fk' => $property['properties_id_fk'],
					// 				'quotation_properties_status' => 1
					// 			)
					// 		);

					// 		if (!$property_id) throw new Exception('Property insert failed');

					// 		/* ================= ROOMS ================= */
					// 		foreach ($property['rooms'] as $room) {

					// 			$ok = $this->General_model->add(
					// 				$this->quotation_properties_rooms,
					// 				array(
					// 					'quotation_properties_id_fk' => $property_id,
					// 					'packages_properties_rooms_id_fk' => $room['packages_properties_rooms_id_fk'],
					// 					'quotation_properties_rooms_id_fk' => $room['quotation_properties_rooms_id_fk'],
					// 					'total_room_cost' => isset($room['total_room_cost']) ? (float)$room['total_room_cost'] : 0,
					// 					'quotation_properties_rooms_status' => 1
					// 				)
					// 			);

					// 			if (!$ok) throw new Exception('Room insert failed');
					// 		}
					// 	}
					// }
				}
			}

			/* ================= SAVE PROPERTY INCLUSIONS ================= */
			if (!empty($payload['inclusions']) && is_array($payload['inclusions'])) {

				foreach ($payload['inclusions'] as $inc) {

					$parts = explode('|', $inc['dayKey']);
					$property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;
					$stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;
					$acc_date        = isset($parts[2]) ? $parts[2] : null;

					$property_id_fk = isset($inc['property_id_fk']) ? (int)$inc['property_id_fk'] : 0;
					$property_inclusions_id_fk = isset($inc['property_inclusions_id_fk']) ? (int)$inc['property_inclusions_id_fk'] : 0;

					if (!$property_day_id || !$stay_dest_id) continue;

					$ok = $this->Quotation_model->add_property_inclusion([
						'quotation_id_fk' => $quotation_id,
						'packages_properties_days_id_fk' => $property_day_id,
						'stay_destination_id_fk' => $stay_dest_id,
						'accommodation_date' => $acc_date,
						'inclusion_property_id_fk' => $property_id_fk,
						'property_inclusions_id_fk' => $property_inclusions_id_fk,
						'inclusion_name' => isset($inc['name']) ? $inc['name'] : '',
						'inclusion_amount' => isset($inc['amount']) ? $inc['amount'] : 0,
						'quotation_property_inclusions_status' => 1
					]);

					if (!$ok) throw new Exception('Inclusion insert failed');
				}
			}
			
			/* ================= SAVE SPECIAL REQUIREMENTS ================= */
			if (!empty($payload['special_requirements']) && is_array($payload['special_requirements'])) {

				foreach ($payload['special_requirements'] as $sr) {

					$parts = explode('|', $sr['dayKey']);
					$property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;
					$stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;
					$acc_date        = isset($parts[2]) ? $parts[2] : null;

					if (!$property_day_id || !$stay_dest_id) continue;

					$ok = $this->Quotation_model->add_special_requirement([
						'quotation_id_fk' => $quotation_id,
						'packages_properties_days_id_fk' => $property_day_id,
						'stay_destination_id_fk' => $stay_dest_id,
						'accommodation_date' => $acc_date,
						'quotation_special_requirements_id_fk' => (int)$sr['quotation_special_requirements_id_fk'],
						'quotation_special_requirements_cost' => $sr['cost'],
						'quotation_special_requirements_status' => 1
					]);

					if (!$ok) throw new Exception('Special requirement insert failed');
				}
			}

			$inclusionRows = $this->db
			->select('quotation_property_inclusions_id, quotation_id_fk, packages_properties_days_id_fk')
			->from('quotation_property_inclusions')
			->where('quotation_id_fk', (int)$quotation_id)
			->where('quotation_property_inclusions_status', 1)
			->get()
			->result_array();

		foreach ($inclusionRows as $row) {

			$packages_itinerary_days_id_fk = (int)$row['packages_properties_days_id_fk'];

			// 1) get quotation_itinerary_days_id
			$quotation_itinerary_days_id_fk = $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day(
				$quotation_id,
				$packages_itinerary_days_id_fk
			);

			// 2) get packages_properties_days_id from packages_properties_days
			$packages_properties_days_id_fk = $this->Quotation_model->get_packages_properties_day_id_by_itinerary_day(
				$packages_itinerary_days_id_fk
			);

			// 3) get quotation_properties_days_id from quotation_properties_days
			$quotation_properties_days_id_fk = 0;
			if ($packages_properties_days_id_fk > 0) {
				$quotation_properties_days_id_fk = $this->Quotation_model->get_quotation_properties_day_id(
					$quotation_id,
					$packages_properties_days_id_fk
				);
			}

			$this->Quotation_model->update_quotation_property_inclusion_fk(
				$row['quotation_property_inclusions_id'],
				array(
					'quotation_itinerary_days_id_fk' => $quotation_itinerary_days_id_fk,
					'quotation_properties_days_id_fk' => $quotation_properties_days_id_fk
				)
			);
		}

		$specialRows = $this->db
			->select('quotation_special_requirements_id, quotation_id_fk, packages_properties_days_id_fk')
			->from('quotation_special_requirements')
			->where('quotation_id_fk', (int)$quotation_id)
			->where('quotation_special_requirements_status', 1)
			->get()
			->result_array();

		foreach ($specialRows as $row) {

			$packages_itinerary_days_id_fk = (int)$row['packages_properties_days_id_fk'];

			// 1) get quotation_itinerary_days_id
			$quotation_itinerary_days_id_fk = $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day(
				$quotation_id,
				$packages_itinerary_days_id_fk
			);

			// 2) get packages_properties_days_id from packages_properties_days
			$packages_properties_days_id_fk = $this->Quotation_model->get_packages_properties_day_id_by_itinerary_day(
				$packages_itinerary_days_id_fk
			);

			// 3) get quotation_properties_days_id from quotation_properties_days
			$quotation_properties_days_id_fk = 0;
			if ($packages_properties_days_id_fk > 0) {
				$quotation_properties_days_id_fk = $this->Quotation_model->get_quotation_properties_day_id(
					$quotation_id,
					$packages_properties_days_id_fk
				);
			}

			$this->Quotation_model->update_quotation_special_requirement_fk(
				$row['quotation_special_requirements_id'],
				array(
					'quotation_itinerary_days_id_fk' => $quotation_itinerary_days_id_fk,
					'quotation_properties_days_id_fk' => $quotation_properties_days_id_fk
				)
			);
		}
			/* ================= COMMIT ================= */
			if ($this->db->trans_status() === false) {
				throw new Exception('DB transaction failed');
			}

			$this->db->trans_commit();
			echo json_encode(['status' => true, 'quotation_id' => $quotation_id]);
			return;

		} catch (Exception $e) {

			$this->db->trans_rollback();
			echo json_encode(['status' => false, 'message' => $e->getMessage()]);
			return;
		}
	}

	public function ajax_get_accommodation_day_options()
{
    header('Content-Type: application/json');

    $lead_id    = $this->input->get('lead_id');
    $package_id = $this->input->get('package_id');

    if (!$lead_id || !$package_id) {
        echo json_encode(['status' => false, 'message' => 'Missing lead_id or package_id']);
        return;
    }

    $rows = $this->Quotation_model->get_accommodation_day_options($lead_id, $package_id);

    echo json_encode(['status' => true, 'data' => $rows]);
}

public function ajax_get_property_inclusions_by_property()
{
    $property_id = (int)$this->input->get('property_id');

    $this->load->model('Quotation_model');
    $rows = $this->Quotation_model->get_property_inclusions_by_property($property_id);

    echo json_encode(array(
        'status' => true,
        'data'   => $rows
    ));
    exit;
}
public function ajax_get_special_requirements()
{
    header('Content-Type: application/json');

    $rows = $this->Quotation_model->get_special_requirements_list();
    echo json_encode(['status' => true, 'data' => $rows]);
}

// public function ajax_get_daywise_properties_for_inclusion()
// {
//     $lead_id = (int)$this->input->get('lead_id');
//     $package_id = (int)$this->input->get('package_id');

//     $this->load->model('Quotation_model');
//     $rows = $this->Quotation_model->get_daywise_properties_for_inclusion($lead_id, $package_id);

//     $grouped = array();

//     foreach ($rows as $r) {
//         $key = $r['property_day_id_fk'] . '|' . $r['stay_destination_id_fk'] . '|' . $r['accommodation_date'];

//         if (!isset($grouped[$key])) {
//             $grouped[$key] = array();
//         }

//         $grouped[$key][] = array(
//             'property_id'   => $r['property_id'],
//             'property_name' => $r['property_name']
//         );
//     }

//     echo json_encode(array(
//         'status' => true,
//         'data'   => array(
//             'day_properties' => $grouped
//         )
//     ));
//     exit;
// }

public function ajax_get_daywise_properties_for_inclusion()
{
    $lead_id = (int)$this->input->get('lead_id');
    $package_id = (int)$this->input->get('package_id');
    $day_key = $this->input->get('day_key');

    $parts = explode('|', $day_key);
    $day_id_fk = isset($parts[0]) ? (int)$parts[0] : 0;
    $stay_destination_id_fk = isset($parts[1]) ? (int)$parts[1] : 0;
    $accommodation_date = isset($parts[2]) ? $parts[2] : '';

    $this->load->model('Quotation_model');
    $rows = $this->Quotation_model->get_daywise_properties_for_inclusion(
        $lead_id,
        $package_id,
        $day_id_fk,
        $stay_destination_id_fk,
        $accommodation_date
    );

    echo json_encode(array(
        'status' => true,
        'data'   => $rows
    ));
    exit;
}

public function ajax_get_quotation_status()
{
    $id = (int)$this->input->get('quotation_id');

    $row = $this->db
        ->select('quotation_id, leads_id_fk, quotation_current_status')
        ->where('quotation_id', $id)
        ->get('quotation')
        ->row();

    if ($row) {
        echo json_encode([
            'status' => true,
            'data' => [
                'quotation_id' => $row->quotation_id,
                'lead_id' => $row->leads_id_fk,
                'quotation_current_status' => $row->quotation_current_status
            ]
        ]);
    } else {
        echo json_encode(['status' => false]);
    }
}

public function ajax_update_quotation_status()
{
    $id     = (int)$this->input->post('quotation_id');
    $status = (int)$this->input->post('quotation_current_status');

    $this->db->where('quotation_id', $id)
             ->update('quotation', [
                 'quotation_current_status' => $status
             ]);

    echo json_encode(['status' => true]);
}


	public function ajax_edit($id)
	{
		/* =========================
		PACKAGE MASTER
		========================= */


		$quotation_itinerary = $this->Quotation_model->get_quotation_itinerary($id);
		if (!$quotation_itinerary) {
			echo json_encode(['status' => false, 'message' => 'Quotation not found']);
			return;
		}

		/* =========================
		ITINERARY DAYS
		========================= */
		$itinerary_days = $this->db
			->select('qid.*, s.state_name')
			->from('quotation_itinerary_days qid')
			->join('quotation_itinerary qi', 'qi.quotation_itinerary_id = qid.quotation_itinerary_id_fk')
			->join('state s', 's.state_id = qid.quotation_itineraries_days_destination_id_fk')
			->where('qi.quotation_id_fk', $id)
			->get()
			->result_array();
// print_r($itinerary_days);die;
		$itinerary_header = $this->db
		->where('quotation_id_fk', $id)
		->get('quotation_itinerary')
		->row_array();

		/* =========================
		INCLUSIONS / EXCLUSIONS
		========================= */
		$inclusions = $this->db
			->where('quotation_id_fk', $id)
			->get('quotation_inclusions')
			->result_array();

		$exclusions = $this->db
			->where('quotation_id_fk', $id)
			->get('quotation_exclusion')
			->result_array();

		/* =========================
		OPTIONAL ADDONS
		========================= */
		$optional_addons = $this->db
			->where('quotation_id_fk', $id)
			->get('quotation_optional_add_on')
			->result_array();

		/* =========================
		PAYMENT POLICIES
		========================= */
		$payment_policies = $this->db
			->where('quotation_id_fk', $id)
			->get('quotation_payment_policies')
			->result_array();

		/* =========================
		TERMS & CONDITIONS
		========================= */
		$terms = $this->db
			->where('quotation_id_fk', $id)
			->get('quotation_terms_condition')
			->result_array();

		/* =========================
		CANCELLATION POLICIES
		========================= */
		$cancellation = $this->db
			->where('quotation_id_fk', $id)
			->get('quotation_cancellation_policies')
			->result_array();

		/* =========================
		NOTES
		========================= */
		$notes = $this->db
			->where('quotation_id_fk', $id)
			->get('quotation_notes')
			->result_array();

		echo json_encode([
			'status'               => true,
			'quotation_itinerary'  => $quotation_itinerary,
			'itinerary_header' => $itinerary_header,
			'itinerary_days'       => $itinerary_days,
			'inclusions'           => $inclusions,
			'exclusions'           => $exclusions,
			'optional_addons'      => $optional_addons,
			'payment_policies'     => $payment_policies,
			'terms'                => $terms,
			'cancellation'         => $cancellation,
			'notes'                => $notes,
		]);
	}
}

?>