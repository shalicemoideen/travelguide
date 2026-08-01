<?php 

defined('BASEPATH') OR exit('No direct script access allowed');

class Quotation extends MY_Controller {

	public $table = 'quotation';

	public $quotation_options = 'quotation_options';

	public $quotation_properties_days = 'quotation_properties_days';

	public $quotation_properties = 'quotation_properties';

	public $quotation_properties_rooms = 'quotation_properties_rooms';

	public $quotation_itinerary = 'quotation_itinerary';

	public $quotation_itinerary_days = 'quotation_itinerary_days';

	public $quotation_inclusions = 'quotation_inclusions';

	public $quotation_exclusion = 'quotation_exclusion';

	public $quotation_optional_add_on = 'quotation_optional_add_on';

	public $quotation_payment_policies = 'quotation_payment_policies';

	public $quotation_terms_condition = 'quotation_terms_condition';

	public $quotation_cancellation_policies = 'quotation_cancellation_policies';

	public $quotation_notes = 'quotation_notes';

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

		$data['prepared_by']     = $this->Quotation_model->get_prepared_by_user($data['quotation']->quotation_created_by_userid);



		// option/property/room + totals

		$data['options']         = $this->Quotation_model->get_quotation_options_full($quotation_id);



		// extra blocks (if exists)

		$data['special_req']     = $this->Quotation_model->get_quotation_special_requirements($quotation_id);

		$data['prop_inclusion']  = $this->Quotation_model->get_quotation_property_inclusions($quotation_id);



		$this->load->view('Quotation/preview', $data);

	}



	public function quotation_preview($quotation_id)

	{

		$this->load->model('Quotation_model');



		$data = $this->Quotation_model->get_quotation_preview_data($quotation_id);



		if (empty($data['quotation'])) {

			show_404();

			return;

		}



		$this->load->view('Quotation/preview', $data);

	}

	public function costing_breakup($quotation_id)

	{

		if (!has_permission('COSTING_BREAKUP')) {

			show_error('Permission denied: Quotation Details');

			return;

		}

		$this->load->model('Quotation_model');

		$data = $this->Quotation_model->get_costing_breakup_data($quotation_id);

		if (empty($data['quotation'])) {

			show_404();

			return;

		}

		$this->load->view('Quotation/costing_breakup', $data);

	}



	// public function quotation_hub($quotation_id)

	// {

		

	// 	$template['body'] = 'Quotation/hub';

	// 	$template['script'] = 'Quotation/script';

	// 	$this->load->view('template', $template);



		

	// }



	public function quotation_hub($quotation_id)

	{

		

		$template['quotation_id'] = $quotation_id;

		$template['body'] = 'Quotation/hub';

		$template['script'] = 'Quotation/hub_script';



		$this->load->view('template', $template);

	}





	public function ajax_get_quotation_hub_summary()

	{

		$quotation_id = (int)$this->input->post('quotation_id');



		if ($quotation_id <= 0) {

			echo json_encode(array('status' => false, 'message' => 'Quotation ID missing'));

			return;

		}



		$data = $this->Quotation_model->get_quotation_hub_summary($quotation_id);

		if (!empty($data)) {
			$this->load->model('Receipt_scheduler_model');
			$scheduler = $this->Receipt_scheduler_model->get_by_quotation_id($quotation_id);
			$data['first_emi_approved'] = false;
			$data['first_emi_payment_pending'] = false;
			$data['all_payments_complete'] = false;
			if ($scheduler) {
				$data['first_emi_approved'] = $this->Receipt_scheduler_model->is_first_installment_approved($scheduler->receipt_scheduler_id);
				$data['first_emi_payment_pending'] = $this->Receipt_scheduler_model->is_first_installment_payment_pending($scheduler->receipt_scheduler_id);

				$summary = $this->Receipt_scheduler_model->get_payment_summary($scheduler->receipt_scheduler_id);
				if ($summary && $summary['pending_amount'] <= 0 && $summary['total_amount'] > 0) {
					$data['all_payments_complete'] = true;
				}
			}

			$this->load->model('Property_reservation_model');
			$prSummary = $this->Property_reservation_model->get_status_summary($quotation_id);
			$data['all_properties_reserved'] = false;
			if (!empty($prSummary) && $prSummary['total'] > 0) {
				$data['all_properties_reserved'] = ($prSummary['reconfirmed'] === $prSummary['total']);
			}
		}

		if (!empty($data['start_date'])) {

			$data['start_date'] = date('d-m-Y', strtotime($data['start_date']));

		}



		if (!empty($data['end_date'])) {

			$data['end_date'] = date('d-m-Y', strtotime($data['end_date']));

		}



		echo json_encode(array(

			'status' => !empty($data),

			'data' => $data

		));

	}



	public function ajax_update_review()

	{

		header('Content-Type: application/json');



		if (!has_permission('QUOTATION_REVIEW')) {

			echo json_encode(array('status' => false, 'message' => 'Permission denied'));

			return;

		}



		$quotation_id = (int)$this->input->post('quotation_id');

		$review_rating = (int)$this->input->post('review_rating');

		$review_comment = $this->input->post('review_comment');



		if ($quotation_id <= 0) {

			echo json_encode(array('status' => false, 'message' => 'Quotation ID missing'));

			return;

		}



		if ($review_rating < 1 || $review_rating > 5) {

			echo json_encode(array('status' => false, 'message' => 'Rating must be between 1 and 5'));

			return;

		}



		$result = $this->Quotation_model->update_review($quotation_id, $review_rating, $review_comment);



		echo json_encode($result);

	}



	public function ajax_update_status()

	{

		$quotation_id = (int)$this->input->post('quotation_id');

		$status = (int)$this->input->post('status');



		if ($quotation_id <= 0) {

			echo json_encode(array('status' => false, 'message' => 'Quotation ID missing'));

			return;

		}



		// Valid status values: 1=Generated, 5=Confirmed

		$valid_statuses = array(1, 5);

		if (!in_array($status, $valid_statuses)) {

			echo json_encode(array('status' => false, 'message' => 'Invalid status value'));

			return;

		}



		$this->db->where('quotation_id', $quotation_id);

		$this->db->update($this->table, array('quotation_current_status' => $status));



		if ($this->db->affected_rows() > 0) {

			echo json_encode(array('status' => true, 'message' => 'Status updated successfully'));

		} else {

			echo json_encode(array('status' => false, 'message' => 'No changes made or quotation not found'));

		}

	}



	public function ajax_driver_allocation()
	{
		if (!has_permission('DRIVER_ITINERARY')) {
			echo json_encode(array('status' => false, 'message' => 'Permission denied: Driver Itinerary'));
			return;
		}

		$quotation_id      = (int)$this->input->post('quotation_id');
		$transporter_id    = (int)$this->input->post('transporter_id');

		if ($quotation_id <= 0) {
			echo json_encode(array('status' => false, 'message' => 'Quotation ID missing'));
			return;
		}

		if ($transporter_id <= 0) {
			echo json_encode(array('status' => false, 'message' => 'Please select a transporter'));
			return;
		}

		// Upsert into the separate transport allocation table
		$existing = $this->db->where('quotation_id_fk', $quotation_id)
							 ->where('status', 1)
							 ->get('quotation_transport_allocation')
							 ->row();
		$allocation_data = array(
			'quotation_id_fk'     => $quotation_id,
			'transporter_id_fk'   => $transporter_id > 0 ? $transporter_id : NULL,
		);
		if ($existing) {
			$this->db->where('id', $existing->id);
			$this->db->update('quotation_transport_allocation', $allocation_data);
		} else {
			$allocation_data['status'] = 1;
			$this->db->insert('quotation_transport_allocation', $allocation_data);
		}

		// Update quotation status to Driver Not Assigned
		$this->db->where('quotation_id', $quotation_id);
		$this->db->update($this->table, array('quotation_current_status' => 9));

		// Mark lead as converted to trip on transporter allocation
		$quotation = $this->db->where('quotation_id', $quotation_id)
							  ->where('quotation_status', 1)
							  ->get($this->table)
							  ->row();
		if ($quotation && !empty($quotation->leads_id_fk)) {
			$this->db->where('leads_id', (int)$quotation->leads_id_fk);
			$this->db->update('leads', array('lead_current_status' => 3));
		}

		echo json_encode(array('status' => true, 'message' => 'Transporter allocated. Status set to Driver Not Assigned.'));
	}

	public function ajax_mark_reservation_complete()
	{
		if (!has_permission('PROPERTY_RESERVATION')) {
			echo json_encode(array('status' => false, 'message' => 'Permission denied: Property Reservation'));
			return;
		}

		$quotation_id = (int)$this->input->post('quotation_id');
		if ($quotation_id <= 0) {
			echo json_encode(array('status' => false, 'message' => 'Quotation ID missing'));
			return;
		}

		$quotation = $this->db->where('quotation_id', $quotation_id)
							  ->where('quotation_status', 1)
							  ->get($this->table)
							  ->row();
		if (!$quotation) {
			echo json_encode(array('status' => false, 'message' => 'Quotation not found'));
			return;
		}

		if ((int)$quotation->quotation_current_status !== 5) {
			echo json_encode(array('status' => false, 'message' => 'Quotation must be in Confirmed status.'));
			return;
		}

		$this->load->model('Property_reservation_model');
		$prSummary = $this->Property_reservation_model->get_status_summary($quotation_id);
		if (empty($prSummary) || $prSummary['total'] == 0) {
			echo json_encode(array('status' => false, 'message' => 'No property reservations found.'));
			return;
		}
		if ($prSummary['reconfirmed'] !== $prSummary['total']) {
			echo json_encode(array('status' => false, 'message' => 'All property reservations must be reconfirmed before completing.'));
			return;
		}

		$this->db->where('quotation_id', $quotation_id);
		$this->db->update($this->table, array('quotation_current_status' => 8));

		if ($this->db->affected_rows() > 0) {
			echo json_encode(array('status' => true, 'message' => 'Reservation completed successfully. Voucher and itinerary tabs are now enabled.'));
		} else {
			echo json_encode(array('status' => false, 'message' => 'No changes made or already completed.'));
		}
	}

	public function ajax_mark_trip_completed()
	{
		$quotation_id = (int)$this->input->post('quotation_id');

		if ($quotation_id <= 0) {
			echo json_encode(array('status' => false, 'message' => 'Quotation ID missing'));
			return;
		}

		$quotation = $this->db->where('quotation_id', $quotation_id)
							  ->where('quotation_status', 1)
							  ->get($this->table)
							  ->row();
		if (!$quotation) {
			echo json_encode(array('status' => false, 'message' => 'Quotation not found'));
			return;
		}

		if ((int)$quotation->quotation_current_status !== 7) {
			echo json_encode(array('status' => false, 'message' => 'Quotation must be in Ready to Trip status to mark as Trip Completed.'));
			return;
		}

		$this->db->where('quotation_id', $quotation_id);
		$this->db->update($this->table, array('quotation_current_status' => 10));

		if ($this->db->affected_rows() > 0) {
			echo json_encode(array('status' => true, 'message' => 'Trip marked as completed successfully.'));
		} else {
			echo json_encode(array('status' => false, 'message' => 'No changes made or already completed.'));
		}
	}

	public function ajax_get_transporters()
	{
		$transporters = $this->db
			->select('user_id_fk as transporter_id, transporter_name')
			->where('transporter_status', 1)
			->where('user_id_fk IS NOT NULL')
			->order_by('transporter_name', 'ASC')
			->get('transporter')
			->result_array();
		echo json_encode(array('status' => true, 'data' => $transporters));
	}

	public function ajax_view_lead_details($id)

	{

		$data = $this->Quotation_model->get_lead_full_details($id);



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

public function client_confirmation_preview($quotation_id)
{
    if (!has_permission('CLIENT_CONFIRMATION')) {
        show_error('Permission denied: Client Confirmation');
        return;
    }

    $data = $this->Quotation_model->get_client_confirmation_preview($quotation_id);

    if (empty($data)) {
        show_error('Confirmation details not found');
        return;
    }

    $this->load->view('Quotation/confirmation_preview', $data);
}

	public function ajax_guest_accommodation_details($quotation_id)

	{

		$this->load->model('Quotation_model');



		$data = $this->Quotation_model->get_guest_accommodation_details($quotation_id);

		// echo $this->db->last_query();exit();



		foreach ($data as $key => $row) {

			$guest_count_id = isset($row['guset_count_details_id_fk']) ? $row['guset_count_details_id_fk'] : 0;



			if ($guest_count_id > 0) {

				$data[$key]['child_age_breakup'] = $this->Quotation_model->get_child_age_breakup($guest_count_id);

			} else {

				$data[$key]['child_age_breakup'] = '';

			}

		}



		echo json_encode(array(

			'status' => !empty($data),

			'data'   => $data

		));

	}

	

	public function ajax_get_hub_lead_details($quotation_id)

	{

		$data = $this->Quotation_model->get_lead_full_details($quotation_id);



		echo json_encode(array(

			'status' => !empty($data),

			'data'   => $data

		));

	}



	public function ajax_get_confirmation_options()

	{

		$quotation_id = (int)$this->input->post('quotation_id');



		$data = $this->Quotation_model->get_quotation_options_for_confirmation($quotation_id);



		echo json_encode(array(

			'status' => !empty($data),

			'data' => $data

		));

	}



	public function ajax_get_confirmation_option_details()

	{

		$quotation_id = (int)$this->input->post('quotation_id');

		$quotation_options_id = (int)$this->input->post('quotation_options_id');



		$data = $this->Quotation_model->get_confirmation_option_details($quotation_id, $quotation_options_id);



		echo json_encode(array(

			'status' => !empty($data),

			'data' => $data

		));

	}



	public function ajax_get_saved_confirmation()

	{

		$quotation_id = (int)$this->input->post('quotation_id');

		$rows = $this->Quotation_model->get_saved_confirmation($quotation_id);



		$option_id = !empty($rows) ? (int)$rows[0]['option_id_fk'] : 0;



		echo json_encode(array(

			'status'    => !empty($rows),

			'option_id' => $option_id,

			'rows'      => $rows

		));

	}



	public function ajax_check_confirmation_scheduler()
	{
		$quotation_id = (int)$this->input->post('quotation_id');

		$confirmation = $this->Quotation_model->get_saved_confirmation($quotation_id);
		$has_confirmation = !empty($confirmation);

		$this->load->model('Receipt_scheduler_model');
		$has_scheduler = $this->Receipt_scheduler_model->check_scheduler_exists($quotation_id);

		$first_emi_approved = false;
		if ($has_scheduler) {
			$scheduler = $this->Receipt_scheduler_model->get_by_quotation_id($quotation_id);
			if ($scheduler) {
				$first_emi_approved = $this->Receipt_scheduler_model->is_first_installment_approved($scheduler->receipt_scheduler_id);
			}
		}

		$messages = array();
		if (!$has_confirmation) {
			$messages[] = 'Client Confirmation is not created.';
		}
		if (!$has_scheduler) {
			$messages[] = 'Receipt Scheduler is not created.';
		}
		if ($has_scheduler && !$first_emi_approved) {
			$messages[] = 'First installment payment must be approved by accountant before confirmation.';
		}

		echo json_encode(array(
			'can_confirm' => empty($messages),
			'messages'    => $messages
		));
	}

	public function ajax_save_confirmation()

	{

		if (!has_permission('CLIENT_CONFIRMATION')) {

			echo json_encode(array('status' => false, 'message' => 'Permission denied: Client Confirmation'));

			return;

		}



		$quotation_id = (int)$this->input->post('quotation_id');

		$option_id    = (int)$this->input->post('option_id');

		$rows         = $this->input->post('rows');



		if (!$quotation_id || !$option_id || empty($rows) || !is_array($rows)) {

			echo json_encode(array('status' => false, 'message' => 'Invalid data.'));

			return;

		}



		$created_by   = (int)$this->session->userdata('user_id');

		$created_date = date('Y-m-d H:i:s');



		$insert_data = array();

		$has_new = false;

		foreach ($rows as $row) {

			$conf_id = isset($row['confirmation_id']) ? (int)$row['confirmation_id'] : 0;

			if (!$conf_id) $has_new = true;

			$insert_data[] = array(

				'confirmation_id'             => $conf_id,

				'quotation_id_fk'             => $quotation_id,

				'option_id_fk'                => $option_id,

				'properties_day_id_fk'        => (int)$row['properties_day_id_fk'],

				'properties_id_fk'            => (int)$row['properties_id_fk'],

				'properties_room_id_fk'       => (int)$row['properties_room_id_fk'],

				'created_date'                => $created_date,

				'created_by'                  => $created_by,

				'property_confirmation_status'=> 1,

			);
// print_r($insert_data);die;
		}



		// New option selected: deactivate all previous rows first, then insert fresh

		if ($has_new) {

			$this->Quotation_model->deactivate_confirmation($quotation_id);

			$insert_only = array();

			foreach ($insert_data as $row) {

				unset($row['confirmation_id']);

				$insert_only[] = $row;

			}

			$this->Quotation_model->save_confirmation($insert_only);

		} else {

			// All rows have existing ids: update each by primary key

			foreach ($insert_data as $row) {

				$this->Quotation_model->upsert_confirmation($quotation_id, $row);

			}

		}



		echo json_encode(array('status' => true));

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

		$param['guest_name'] =(isset($_REQUEST['guest_name']))?$_REQUEST['guest_name']:'';

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

		

		if (!has_permission('QUOTATION_VIEW') && !has_permission('QUOTATION_VIEW_CONFIRMED')) {

	        echo json_encode([

	            "draw" => intval($this->input->post('draw')),

	            "recordsTotal" => 0,

	            "recordsFiltered" => 0,

	            "data" => []

	        ]);

	        return;

	    }

		// Reservation team: restrict to confirmed statuses only (5=Confirmed, 7=Ready to Trip, 9=Driver Not Assigned)
		if (!has_permission('QUOTATION_VIEW') && has_permission('QUOTATION_VIEW_CONFIRMED')) {
			$param['confirmed_only'] = true;
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

	   

	   $sel=$this->input->post('leads_id');

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

// echo $this->db->last_query();exit();

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



public function property_reservation_preview($quotation_id)
{
    if (!has_permission('PROPERTY_RESERVATION')) {
        show_error('Permission denied: Property Reservation');
        return;
    }

    $data = $this->Quotation_model->get_property_reservation_preview($quotation_id);

    if (empty($data['properties'])) {
        show_error('No property reservation details found.');
        return;
    }

    $this->load->view('Quotation/property_reservation_preview', $data);
}

public function property_reservation_preview_new($quotation_id)
{
    if (!has_permission('PROPERTY_RESERVATION')) {
        show_error('Permission denied: Property Reservation');
        return;
    }

    $data = $this->Quotation_model->get_property_reservation_preview($quotation_id);

    if (empty($data['properties'])) {
        show_error('No property reservation details found.');
        return;
    }

    $this->load->view('Quotation/property_reservation_preview_new', $data);
}

public function property_voucher_preview($quotation_id)
{
    if (!has_permission('PROPERTY_VOUCHER')) {
        show_error('Permission denied: Property Voucher');
        return;
    }

    $data = $this->Quotation_model->get_property_voucher_preview($quotation_id);

    if (empty($data['main'])) {
        show_error('Property voucher details not found');
        return;
    }

    if (empty($data['properties'])) {
        show_error('No confirmed property reservations found for this quotation. Please confirm properties first.');
        return;
    }

    $this->load->view(
        'Quotation/property_voucher_preview',
        $data
    );
}

public function tour_voucher_preview($quotation_id)
{
    if (!has_permission('TOUR_VOUCHER')) {
        show_error('Permission denied: Tour Voucher');
        return;
    }

    $data = $this->Quotation_model->get_tour_voucher_preview($quotation_id);

    if (empty($data['main'])) {
        show_error('Tour voucher details not found');
        return;
    }

    $this->load->view('Quotation/tour_voucher_preview', $data);
}

public function driver_itinerary_preview($quotation_id)
{
    if (!has_permission('DRIVER_ITINERARY')) {
        show_error('Permission denied: Driver Itinerary');
        return;
    }

    $data = $this->Quotation_model->get_driver_itinerary_preview($quotation_id);

    if (empty($data['main'])) {
        show_error('Driver itinerary details not found');
        return;
    }

    $this->load->view('Quotation/driver_itinerary_preview', $data);
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



							$_ppd_id_1 = (int)$packages_properties_days_id_fk[$key];
							$_pit_id_1 = $this->Quotation_model->get_itinerary_days_id_fk_by_properties_day($_ppd_id_1);
							$_qit_id_1 = $_pit_id_1 > 0 ? $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day($insert, $_pit_id_1) : 0;

							$data_properties_days_add = array(

								'quotation_id_fk' => $insert,

								'quotation_options_id_fk' => $quotation_options_id,

								'packages_properties_days_id_fk' => $_ppd_id_1,

								'quotation_itinerary_days_id_fk' => $_qit_id_1,

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

						'quotation_itinerary_days_id_fk' => isset($day['quotation_itinerary_days_id_fk']) ? (int)$day['quotation_itinerary_days_id_fk'] : $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day($quotation_id, $this->Quotation_model->get_itinerary_days_id_fk_by_properties_day((int)$day['packages_properties_days_id_fk'])),

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

			'package_option_id_fk' => isset($inc['package_option_id_fk']) ? (int)$inc['package_option_id_fk'] : 0,

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

            'quotation_special_requirements_name' => $sr['quotation_special_requirements_name'],

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

		$date1 = date('Y-m-d h:i:s a', time());


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

		$leads_id = (int)$this->input->post('leads_id');



		$updateleads_quotation_status = array('leads_quotation_status' => 1);

		$this->db->where('leads_id', $leads_id)->update('leads', $updateleads_quotation_status);



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

				// 'quotation_created_by_username' => $currentusername,

				'quotation_created_at' => $date1,

				// 'quotation_created_time' => $time,

				'quotation_current_status' => 2,

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

			$optionMap = array();

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

							'quotation_options_vehicle_display' => $option['quotation_options_vehicle_display'],

							'quotation_options_total_cost' => $option['quotation_options_total_cost'],

							'quotation_options_margin_type' => $option['quotation_options_margin_type'],

							'quotation_options_margin_value' => $option['quotation_options_margin_value'],

							'quotation_options_total_quote_rate' => $option['quotation_options_total_quote_rate'],

							'quotation_options_amount_type' => isset($option['quotation_options_amount_type']) ? $option['quotation_options_amount_type'] : 'net',

							'quotation_options_per_amount'  => isset($option['quotation_options_per_amount']) ? (float)$option['quotation_options_per_amount'] : 0,

							'quotation_options_status' => 1

						]

					);

					

					if (!$option_id) throw new Exception('Option insert failed');

					$package_option_id = isset($option['packages_properties_common_id_fk'])

						? (int)$option['packages_properties_common_id_fk']

						: 0;



					if ($package_option_id > 0) {

						$optionMap[$package_option_id] = (int)$option_id;

					}



					/* ================= DAYS ================= */

					foreach ($option['days'] as $day) {



						$day_id = $this->General_model->add_returnID(

							$this->quotation_properties_days,

							[

								'quotation_id_fk' => $quotation_id,

								'quotation_options_id_fk' => $option_id,

								'packages_properties_days_id_fk' => $day['packages_properties_days_id_fk'],

								'quotation_itinerary_days_id_fk' => isset($day['quotation_itinerary_days_id_fk']) ? (int)$day['quotation_itinerary_days_id_fk'] : $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day($quotation_id, $this->Quotation_model->get_itinerary_days_id_fk_by_properties_day((int)$day['packages_properties_days_id_fk'])),

								'quotation_properties_days_day' => $day['day'],

								'quotation_properties_days_destination_id_fk' => $day['destination_id'],

								'accommodation_plan_id_fk' => isset($day['accommodation_plan_id_fk']) ? (int)$day['accommodation_plan_id_fk'] : 0,

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



				}

			}



			

			/* ================= SAVE PROPERTY INCLUSIONS ================= */

			// if (!empty($payload['inclusions']) && is_array($payload['inclusions'])) {



			// 	foreach ($payload['inclusions'] as $inc) {



			// 		$parts = explode('|', $inc['dayKey']);

			// 		$property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;

			// 		$stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;

			// 		$acc_date        = isset($parts[2]) ? $parts[2] : null;



			// 		$property_id_fk = isset($inc['property_id_fk']) ? (int)$inc['property_id_fk'] : 0;

			// 		$property_inclusions_id_fk = isset($inc['property_inclusions_id_fk']) ? (int)$inc['property_inclusions_id_fk'] : 0;



			// 		if (!$property_day_id || !$stay_dest_id) continue;



			// 		$ok = $this->Quotation_model->add_property_inclusion([

			// 			'quotation_id_fk' => $quotation_id,

			// 			'package_option_id_fk' => isset($inc['package_option_id_fk']) ? (int)$inc['package_option_id_fk'] : 0,

			// 			'packages_properties_days_id_fk' => $property_day_id,

			// 			'stay_destination_id_fk' => $stay_dest_id,

			// 			'accommodation_date' => $acc_date,

			// 			'inclusion_property_id_fk' => $property_id_fk,

			// 			'property_inclusions_id_fk' => $property_inclusions_id_fk,

			// 			'inclusion_name' => isset($inc['name']) ? $inc['name'] : '',

			// 			'inclusion_amount' => isset($inc['amount']) ? $inc['amount'] : 0,

			// 			'quotation_property_inclusions_status' => 1

			// 		]);



			// 		if (!$ok) throw new Exception('Inclusion insert failed');

			// 	}

			// }

			

			/* ================= SAVE PROPERTY INCLUSIONS ================= */

if (!empty($payload['inclusions']) && is_array($payload['inclusions'])) {



    foreach ($payload['inclusions'] as $inc) {



        $parts = explode('|', $inc['dayKey']);

        $property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;

        $stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;

        $acc_date        = isset($parts[2]) ? $parts[2] : null;



        $package_option_id_fk = isset($inc['package_option_id_fk'])

            ? (int)$inc['package_option_id_fk']

            : 0;



        $quotation_options_id_fk = isset($optionMap[$package_option_id_fk])

            ? (int)$optionMap[$package_option_id_fk]

            : 0;



        $property_id_fk = isset($inc['property_id_fk'])

            ? (int)$inc['property_id_fk']

            : 0;



        $property_inclusions_id_fk = isset($inc['property_inclusions_id_fk'])

            ? (int)$inc['property_inclusions_id_fk']

            : 0;



        if (!$property_day_id || !$stay_dest_id) {

            continue;

        }



        $ok = $this->Quotation_model->add_property_inclusion(array(

            'quotation_id_fk' => $quotation_id,

            'quotation_options_id_fk' => $quotation_options_id_fk,

            'package_option_id_fk' => $package_option_id_fk,

            'packages_properties_days_id_fk' => $property_day_id,

            'stay_destination_id_fk' => $stay_dest_id,

            'accommodation_date' => $acc_date,

            'inclusion_property_id_fk' => $property_id_fk,

            'property_inclusions_id_fk' => $property_inclusions_id_fk,

            'inclusion_name' => isset($inc['name']) ? $inc['name'] : '',

            'inclusion_amount' => isset($inc['amount']) ? $inc['amount'] : 0,

            'quotation_property_inclusions_status' => 1

        ));



        if (!$ok) {

            throw new Exception('Inclusion insert failed');

        }

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

						'quotation_special_requirements_name' => $sr['quotation_special_requirements_name'],

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



		$accommodationPlanIds = array();



foreach ($payload['options'] as $option) {

    if (!empty($option['days'])) {

        foreach ($option['days'] as $day) {

            if (!empty($day['accommodation_plan_id_fk'])) {

                $accommodationPlanIds[] = (int)$day['accommodation_plan_id_fk'];

            }

        }

    }

}



$accommodationPlanIds = array_unique(array_filter($accommodationPlanIds));



if (!empty($accommodationPlanIds)) {

    $this->db->where_in('accommodation_plan_id', $accommodationPlanIds)

             ->update('accommodation_plan', array(

                 'quotation_id_fk' => $quotation_id

             ));

}



if (!empty($accommodationPlanIds)) {

    $this->db->query("

        UPDATE guset_count gc

        JOIN guset_count_details gcd 

            ON gcd.guset_count_id_fk = gc.guset_count_id

        JOIN accommodation_plan ap 

            ON ap.guset_count_details_id_fk = gcd.guset_count_details_id

        SET gc.quotation_id_fk = ?

        WHERE ap.accommodation_plan_id IN (" . implode(',', array_map('intval', $accommodationPlanIds)) . ")

    ", array($quotation_id));

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



	public function ajax_update()

{

    $payload = json_decode($this->input->post('data'), true);



    $quotation_id = (int)$this->input->post('id');



    if (!$quotation_id) {

        echo json_encode(array(

            'status' => false,

            'message' => 'Quotation ID missing'

        ));

        return;

    }


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



    $quotation_date = str_replace('/', '-', $this->input->post('quotation_date'));

    $quotation_date = date("Y-m-d h:i:s a", strtotime($quotation_date));



    $this->db->trans_begin();



    try {



        /* ================= UPDATE QUOTATION MAIN ONLY ================= */



        $quotationData = array(

            'leads_id_fk' => $this->input->post('leads_id_hidden'),

            'package_id_fk' => $this->input->post('packages_id_hidden'),

            'quotation_date' => $quotation_date,

            'arriving_destination' => $this->input->post('arriving_destination'),

            'departuring_destination' => $this->input->post('departuring_destination'),

            'quotation_remarks' => $this->input->post('quotation_remarks'),

            'total_inclusion_amount' => $this->input->post('total_inclusion_amount'),

            'total_special_requirment_amount' => $this->input->post('total_special_requirment_amount'),

			'quotation_updatedby_user_id' => $currentuserid,

			'quotation_updated_at' => $date1,

        );

        $this->db->where('quotation_id', $quotation_id);

        $this->db->update('quotation', $quotationData);



        /* =========================================================

           DO NOT DELETE:

           quotation

           quotation_itinerary

           quotation_itinerary_days



           DO NOT COPY PACKAGE DATA ON UPDATE

        ========================================================= */



        /* ================= DELETE OLD OPTION RELATED DATA ================= */



        $oldOptions = $this->db

            ->select('quotation_options_id')

            ->from($this->quotation_options)

            ->where('quotation_id_fk', $quotation_id)

            ->where('quotation_options_status', 1)

            ->get()

            ->result_array();



        $oldOptionIds = array();



        foreach ($oldOptions as $op) {

            $oldOptionIds[] = (int)$op['quotation_options_id'];

        }



        $oldDayIds = array();



        if (!empty($oldOptionIds)) {

            $oldDays = $this->db

                ->select('quotation_properties_days_id')

                ->from($this->quotation_properties_days)

                ->where('quotation_id_fk', $quotation_id)

                ->where_in('quotation_options_id_fk', $oldOptionIds)

                ->where('quotation_properties_days_status', 1)

                ->get()

                ->result_array();



            foreach ($oldDays as $d) {

                $oldDayIds[] = (int)$d['quotation_properties_days_id'];

            }

        }



        $oldPropertyIds = array();



        if (!empty($oldDayIds)) {

            $oldProperties = $this->db

                ->select('quotation_properties_id')

                ->from($this->quotation_properties)

                ->where_in('quotation_properties_days_id_fk', $oldDayIds)

                ->where('quotation_properties_status', 1)

                ->get()

                ->result_array();



            foreach ($oldProperties as $p) {

                $oldPropertyIds[] = (int)$p['quotation_properties_id'];

            }

        }



        if (!empty($oldPropertyIds)) {

            $this->db->where_in('quotation_properties_id_fk', $oldPropertyIds);

            $this->db->update($this->quotation_properties_rooms, array(

                'quotation_properties_rooms_status' => 0

            ));

        }



        if (!empty($oldDayIds)) {

            $this->db->where_in('quotation_properties_days_id_fk', $oldDayIds);

            $this->db->update($this->quotation_properties, array(

                'quotation_properties_status' => 0

            ));

        }



        if (!empty($oldOptionIds)) {

            $this->db->where_in('quotation_options_id_fk', $oldOptionIds);

            $this->db->update($this->quotation_properties_days, array(

                'quotation_properties_days_status' => 0

            ));



            $this->db->where_in('quotation_options_id', $oldOptionIds);

            $this->db->update($this->quotation_options, array(

                'quotation_options_status' => 0

            ));

        }



        // delete/disable old dynamic inclusion and special requirement rows

        $this->db->where('quotation_id_fk', $quotation_id);

        $this->db->update('quotation_property_inclusions', array(

            'quotation_property_inclusions_status' => 0

        ));



        $this->db->where('quotation_id_fk', $quotation_id);

        $this->db->update('quotation_special_requirements', array(

            'quotation_special_requirements_status' => 0

        ));



        /* ================= INSERT UPDATED OPTIONS ================= */

		$optionMap = array();

        if (!empty($payload['options']) && is_array($payload['options'])) {



            foreach ($payload['options'] as $option) {



                $option_id = $this->General_model->add_returnID(

                    $this->quotation_options,

                    array(

                        'quotation_id_fk' => $quotation_id,

                        'packages_properties_common_id_fk' => isset($option['packages_properties_common_id_fk']) ? $option['packages_properties_common_id_fk'] : 0,

                        'quotation_options_title' => isset($option['title']) ? $option['title'] : '',

                        'quotation_options_cab_amount' => isset($option['cab_amount']) ? $option['cab_amount'] : 0,

                        'quotation_options_design_type' => isset($option['quotation_options_design_type']) ? $option['quotation_options_design_type'] : '',

                        'quotation_options_vehicle_id_fk' => isset($option['quotation_options_vehicle_id_fk']) ? $option['quotation_options_vehicle_id_fk'] : 0,

                        'quotation_options_room_category_display' => isset($option['quotation_options_room_category_display']) ? $option['quotation_options_room_category_display'] : 0,

                        'quotation_options_meal_plan_display' => isset($option['quotation_options_meal_plan_display']) ? $option['quotation_options_meal_plan_display'] : 0,

                        'quotation_options_vehicle_display' => isset($option['quotation_options_vehicle_display']) ? $option['quotation_options_vehicle_display'] : 0,

                        'quotation_options_total_cost' => isset($option['quotation_options_total_cost']) ? $option['quotation_options_total_cost'] : 0,

                        'quotation_options_margin_type' => isset($option['quotation_options_margin_type']) ? $option['quotation_options_margin_type'] : 'amount',

                        'quotation_options_margin_value' => isset($option['quotation_options_margin_value']) ? $option['quotation_options_margin_value'] : 0,

                        'quotation_options_total_quote_rate' => isset($option['quotation_options_total_quote_rate']) ? $option['quotation_options_total_quote_rate'] : 0,

						'quotation_options_amount_type' => isset($option['quotation_options_amount_type']) ? $option['quotation_options_amount_type'] : 'net',

						'quotation_options_per_amount'  => isset($option['quotation_options_per_amount']) ? (float)$option['quotation_options_per_amount'] : 0,

                        'quotation_options_status' => 1

                    )

                );



                if (!$option_id) {

                    throw new Exception('Option insert failed');

                }

				$package_option_id = isset($option['packages_properties_common_id_fk'])

					? (int)$option['packages_properties_common_id_fk']

					: 0;



				if ($package_option_id > 0) {

					$optionMap[$package_option_id] = (int)$option_id;

				}

                if (!empty($option['days']) && is_array($option['days'])) {



                    foreach ($option['days'] as $day) {



                        $day_id = $this->General_model->add_returnID(

                            $this->quotation_properties_days,

                            array(

                                'quotation_id_fk' => $quotation_id,

                                'quotation_options_id_fk' => $option_id,

                                'packages_properties_days_id_fk' => isset($day['packages_properties_days_id_fk']) ? $day['packages_properties_days_id_fk'] : 0,

                                'quotation_itinerary_days_id_fk' => $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day($quotation_id, $this->Quotation_model->get_itinerary_days_id_fk_by_properties_day(isset($day['packages_properties_days_id_fk']) ? (int)$day['packages_properties_days_id_fk'] : 0)),

                                'quotation_properties_days_day' => isset($day['day']) ? $day['day'] : '',

                                'quotation_properties_days_destination_id_fk' => isset($day['destination_id']) ? $day['destination_id'] : 0,

								'accommodation_plan_id_fk' => isset($day['accommodation_plan_id_fk']) ? (int)$day['accommodation_plan_id_fk'] : 0,

                                'quotation_properties_days_status' => 1

                            )

                        );



                        if (!$day_id) {

                            throw new Exception('Day insert failed');

                        }



                        if (!empty($day['properties']) && is_array($day['properties'])) {



                            foreach ($day['properties'] as $property) {



                                $property_id = $this->General_model->add_returnID(

                                    $this->quotation_properties,

                                    array(

                                        'quotation_properties_days_id_fk' => $day_id,

                                        'packages_properties_id_fk' => isset($property['packages_properties_id_fk']) ? $property['packages_properties_id_fk'] : 0,

                                        'properties_id_fk' => isset($property['properties_id_fk']) ? $property['properties_id_fk'] : 0,

                                        'quotation_properties_status' => 1

                                    )

                                );



                                if (!$property_id) {

                                    throw new Exception('Property insert failed');

                                }



                                if (!empty($property['rooms']) && is_array($property['rooms'])) {



                                    foreach ($property['rooms'] as $room) {



                                        $quotation_properties_room_id = $this->General_model->add_returnID(

                                            $this->quotation_properties_rooms,

                                            array(

                                                'quotation_properties_id_fk' => $property_id,

                                                'packages_properties_rooms_id_fk' => isset($room['packages_properties_rooms_id_fk']) ? $room['packages_properties_rooms_id_fk'] : 0,

                                                'quotation_properties_rooms_id_fk' => isset($room['quotation_properties_rooms_id_fk']) ? $room['quotation_properties_rooms_id_fk'] : 0,

                                                'total_room_cost' => isset($room['total_room_cost']) ? (float)$room['total_room_cost'] : 0,

                                                'quotation_properties_rooms_status' => 1

                                            )

                                        );



                                        if (!$quotation_properties_room_id) {

                                            throw new Exception('Room insert failed');

                                        }



                                        /*

                                         * IMPORTANT:

                                         * quotation_room_tariff_details.quotation_properties_rooms_id_fk

                                         * must be updated with NEW quotation_properties_rooms.quotation_properties_rooms_id

                                         */

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

                        }

                    }

                }

            }

        }



        /* ================= SAVE UPDATED PROPERTY INCLUSIONS ================= */



        // if (!empty($payload['inclusions']) && is_array($payload['inclusions'])) {



        //     foreach ($payload['inclusions'] as $inc) {



        //         $parts = explode('|', $inc['dayKey']);

        //         $property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;

        //         $stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;

        //         $acc_date        = isset($parts[2]) ? $parts[2] : null;



        //         if (!$property_day_id || !$stay_dest_id) {

        //             continue;

        //         }



        //         $ok = $this->Quotation_model->add_property_inclusion(array(

        //             'quotation_id_fk' => $quotation_id,

        //             'package_option_id_fk' => isset($inc['package_option_id_fk']) ? (int)$inc['package_option_id_fk'] : 0,

        //             'packages_properties_days_id_fk' => $property_day_id,

        //             'stay_destination_id_fk' => $stay_dest_id,

        //             'accommodation_date' => $acc_date,

        //             'inclusion_property_id_fk' => isset($inc['property_id_fk']) ? (int)$inc['property_id_fk'] : 0,

        //             'property_inclusions_id_fk' => isset($inc['property_inclusions_id_fk']) ? (int)$inc['property_inclusions_id_fk'] : 0,

        //             'inclusion_name' => isset($inc['name']) ? $inc['name'] : '',

        //             'inclusion_amount' => isset($inc['amount']) ? $inc['amount'] : 0,

        //             'quotation_property_inclusions_status' => 1

        //         ));



        //         if (!$ok) {

        //             throw new Exception('Inclusion insert failed');

        //         }

        //     }

        // }



		/* ================= SAVE UPDATED PROPERTY INCLUSIONS ================= */

if (!empty($payload['inclusions']) && is_array($payload['inclusions'])) {



    foreach ($payload['inclusions'] as $inc) {



        $parts = explode('|', $inc['dayKey']);

        $property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;

        $stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;

        $acc_date        = isset($parts[2]) ? $parts[2] : null;



        if (!$property_day_id || !$stay_dest_id) {

            continue;

        }



        $package_option_id_fk = isset($inc['package_option_id_fk'])

            ? (int)$inc['package_option_id_fk']

            : 0;



        $quotation_options_id_fk = isset($optionMap[$package_option_id_fk])

            ? (int)$optionMap[$package_option_id_fk]

            : 0;



        $ok = $this->Quotation_model->add_property_inclusion(array(

            'quotation_id_fk' => $quotation_id,

            'quotation_options_id_fk' => $quotation_options_id_fk,

            'package_option_id_fk' => $package_option_id_fk,

            'packages_properties_days_id_fk' => $property_day_id,

            'stay_destination_id_fk' => $stay_dest_id,

            'accommodation_date' => $acc_date,

            'inclusion_property_id_fk' => isset($inc['property_id_fk']) ? (int)$inc['property_id_fk'] : 0,

            'property_inclusions_id_fk' => isset($inc['property_inclusions_id_fk']) ? (int)$inc['property_inclusions_id_fk'] : 0,

            'inclusion_name' => isset($inc['name']) ? $inc['name'] : '',

            'inclusion_amount' => isset($inc['amount']) ? $inc['amount'] : 0,

            'quotation_property_inclusions_status' => 1

        ));



        if (!$ok) {

            throw new Exception('Inclusion insert failed');

        }

    }

}

        /* ================= SAVE UPDATED SPECIAL REQUIREMENTS ================= */



        if (!empty($payload['special_requirements']) && is_array($payload['special_requirements'])) {



            foreach ($payload['special_requirements'] as $sr) {



                $parts = explode('|', $sr['dayKey']);

                $property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;

                $stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;

                $acc_date        = isset($parts[2]) ? $parts[2] : null;



                if (!$property_day_id || !$stay_dest_id) {

                    continue;

                }



                $ok = $this->Quotation_model->add_special_requirement(array(

                    'quotation_id_fk' => $quotation_id,

                    'packages_properties_days_id_fk' => $property_day_id,

                    'stay_destination_id_fk' => $stay_dest_id,

                    'accommodation_date' => $acc_date,

                    'quotation_special_requirements_name' => isset($sr['quotation_special_requirements_name']) ? $sr['quotation_special_requirements_name'] : '',

                    'quotation_special_requirements_cost' => isset($sr['cost']) ? $sr['cost'] : 0,

                    'quotation_special_requirements_status' => 1

                ));



                if (!$ok) {

                    throw new Exception('Special requirement insert failed');

                }

            }

        }



        /* ================= UPDATE INCLUSION / SPECIAL FK LINKS ================= */



        $this->update_quotation_inclusion_and_special_day_links($quotation_id);



        if ($this->db->trans_status() === false) {

            throw new Exception('DB transaction failed');

        }



        $this->db->trans_commit();



        echo json_encode(array(

            'status' => true,

            'quotation_id' => $quotation_id

        ));

        return;



    } catch (Exception $e) {



        $this->db->trans_rollback();



        echo json_encode(array(

            'status' => false,

            'message' => $e->getMessage()

        ));

        return;

    }

}



private function update_quotation_inclusion_and_special_day_links($quotation_id)

{

    /* ================= PROPERTY INCLUSIONS ================= */



    $inclusionRows = $this->db

        ->select('quotation_property_inclusions_id, quotation_id_fk, packages_properties_days_id_fk')

        ->from('quotation_property_inclusions')

        ->where('quotation_id_fk', (int)$quotation_id)

        ->where('quotation_property_inclusions_status', 1)

        ->get()

        ->result_array();



    foreach ($inclusionRows as $row) {



        $packages_itinerary_days_id_fk = (int)$row['packages_properties_days_id_fk'];



        $quotation_itinerary_days_id_fk = $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day(

            $quotation_id,

            $packages_itinerary_days_id_fk

        );



        $packages_properties_days_id_fk = $this->Quotation_model->get_packages_properties_day_id_by_itinerary_day(

            $packages_itinerary_days_id_fk

        );



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



    /* ================= SPECIAL REQUIREMENTS ================= */



    $specialRows = $this->db

        ->select('quotation_special_requirements_id, quotation_id_fk, packages_properties_days_id_fk')

        ->from('quotation_special_requirements')

        ->where('quotation_id_fk', (int)$quotation_id)

        ->where('quotation_special_requirements_status', 1)

        ->get()

        ->result_array();



    foreach ($specialRows as $row) {



        $packages_itinerary_days_id_fk = (int)$row['packages_properties_days_id_fk'];



        $quotation_itinerary_days_id_fk = $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day(

            $quotation_id,

            $packages_itinerary_days_id_fk

        );



        $packages_properties_days_id_fk = $this->Quotation_model->get_packages_properties_day_id_by_itinerary_day(

            $packages_itinerary_days_id_fk

        );



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



public function ajax_get_daywise_properties_for_inclusion()

{

    $lead_id = (int)$this->input->get('lead_id');

    $package_id = (int)$this->input->get('package_id');

    $day_key = $this->input->get('day_key');



    // ✅ new param

    $packages_properties_common_id_fk = (int)$this->input->get('packages_properties_common_id_fk');



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

        $accommodation_date,

        $packages_properties_common_id_fk // ✅ pass to model

    );

// echo $this->db->last_query();

// 		exit();

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



    // Permission check based on target status

    if ($status == 1 && !has_permission('GENERATE_QUOTATION')) {

        echo json_encode(['status' => false, 'message' => 'Permission denied: Generate Quotation']);

        return;

    }

    if ($status == 5 && !has_permission('CONFIRM_QUOTATION')) {

        echo json_encode(['status' => false, 'message' => 'Permission denied: Confirm Quotation']);

        return;

    }



    $this->db->where('quotation_id', $id)

             ->update('quotation', [

                 'quotation_current_status' => $status

             ]);



	// 1. Fetch the quotation row

	$quotation = $this->db

		->where('quotation_id', $this->input->post('quotation_id'))

		->get('quotation')

		->row();



	// 2. Ensure the quotation exists before updating

	if ($quotation) {

		$lead_id = $quotation->leads_id_fk;

// print_r($lead_id);die;

		// 3. Update both status fields in the array

		$this->db->where('leads_id', $lead_id)

				->update('leads', [

					// 'leads_accomodation_status' => '1',

					'leads_quotation_status'    => '2' // Update this to '0' (or your desired value)

				]);

	}



    echo json_encode(['status' => true]);

}



private function delete_quotation_children_except_itinerary($quotation_id)

{

    /* =============================

       OTHER SIMPLE CHILD TABLES

    ============================= */

    $this->db->where('quotation_id_fk', $quotation_id)->delete('quotation_inclusions');

    $this->db->where('quotation_id_fk', $quotation_id)->delete('quotation_exclusion');



    $this->db->where('quotation_id_fk', $quotation_id)

        ->delete('quotation_optional_add_on');



    // $this->db->where('packages_special_requirements_packages_id_fk', $quotation_id)

    //     ->delete('packages_special_requirements');



    $this->db->where('quotation_id_fk', $quotation_id)

        ->delete('quotation_payment_policies');



    $this->db->where('quotation_id_fk', $quotation_id)

        ->delete('quotation_terms_condition');



    $this->db->where('quotation_id_fk', $quotation_id)

        ->delete('quotation_cancellation_policies');



    $this->db->where('quotation_id_fk', $quotation_id)

        ->delete('quotation_notes');



    

}



	private function upload_day_image($fieldName)

	{

		$config['upload_path']   = FCPATH . 'uploads/quotation_day_images/';

		$config['allowed_types'] = 'jpg|jpeg|png|webp';

		$config['max_size']      = 4096; // 4MB

		$config['encrypt_name']  = true;



		if (!is_dir($config['upload_path'])) {

			@mkdir($config['upload_path'], 0777, true);

		}



		$this->load->library('upload', $config);

		$this->upload->initialize($config);



		if (!$this->upload->do_upload($fieldName)) {

			return ['ok' => false, 'error' => $this->upload->display_errors('', '')];

		}



		$data = $this->upload->data();

		return ['ok' => true, 'file' => $data['file_name']];

	}



	private function copy_default_day_image_to_quotation($fileName)

	{

		$fileName = trim((string)$fileName);

		if ($fileName === '') return '';



		// ✅ if POST contains full url/path, keep only filename

		$fileName = basename($fileName);



		// ✅ IMPORTANT: set your real source folder here

		// If your images are in uploads/itinerary_days/ then use this:

		$src = FCPATH . 'uploads/quotation_day_images/' . $fileName;



		$destDir = FCPATH . 'uploads/quotation_day_images/';

		if (!is_dir($destDir)) {

			@mkdir($destDir, 0777, true);

		}



		// ---- DEBUG LOGS ----

		log_message('error', 'COPY DEFAULT IMG: fileName=' . $fileName);

		log_message('error', 'COPY DEFAULT IMG: src=' . $src);

		log_message('error', 'COPY DEFAULT IMG: destDir=' . $destDir);



		if (!file_exists($src)) {

			log_message('error', 'COPY DEFAULT IMG FAILED: source not found: ' . $src);

			return '';

		}



		if (!is_writable($destDir)) {

			log_message('error', 'COPY DEFAULT IMG FAILED: destDir not writable: ' . $destDir);

			return '';

		}



		$ext = pathinfo($fileName, PATHINFO_EXTENSION);

		$newName = uniqid('pkgday_', true) . ($ext ? '.' . $ext : '');

		$dest = $destDir . $newName;



		if (@copy($src, $dest)) {

			log_message('error', 'COPY DEFAULT IMG OK: ' . $src . ' -> ' . $dest);

			return $newName;

		}



		log_message('error', 'COPY DEFAULT IMG FAILED: copy() false src=' . $src . ' dest=' . $dest);

		return '';

	}



	private function insert_children_for_quotation($quotation_id, $is_update)

	{

		/* =============================

		1) ITINERARY HEADER

		============================= */

		$data_itinerary = array(

			'quotation_id_fk'            => $quotation_id,

			// 'quotation_itineraries_id_fk'         => $this->input->post('quotation_itineraries_id_fk'),

			'quotation_itinerary_status' => 1

		);



		$quotation_itinerary_id = $this->General_model->add_returnID(

			$this->quotation_itinerary,

			$data_itinerary

		);



		if (!$quotation_itinerary_id) {

			return FALSE;

		}



		/* =============================

		2) ITINERARY DAYS

		REQUIRED STATUS SAVED HERE

		============================= */

		$itineraries_days_id_fk                      = (array)$this->input->post('itineraries_days_id_fk');

		$quotation_itineraries_days_day               = (array)$this->input->post('quotation_itineraries_days_day');

		$quotation_itineraries_days_destination_id_fk = (array)$this->input->post('quotation_itineraries_days_destination_id_fk');

		$quotation_itineraries_days_title             = (array)$this->input->post('quotation_itineraries_days_title');

		$quotation_itineraries_days_description       = (array)$this->input->post('quotation_itineraries_days_description');

		$travelBackArr                               = (array)$this->input->post('quotation_itineraries_days_travel_back');

		$requiredStatusArr                           = (array)$this->input->post('quotation_itineraries_days_required_status');

		$defaultImages                               = (array)$this->input->post('default_itinerary_day_image');



		$pkgDayMap      = array(); // itineraries_days_id => packages_itinerary_days_id

		$dayNoMap       = array(); // itineraries_days_id => day no

		$dayTBMap       = array(); // itineraries_days_id => TB or ''

		$dayReqStatMap  = array(); // itineraries_days_id => 1 or 2



		foreach ($itineraries_days_id_fk as $k => $itinDayId) {



			$itinDayId = (int)$itinDayId;

			if (!$itinDayId) {

				continue;

			}



			$dayNo = isset($quotation_itineraries_days_day[$k]) ? $quotation_itineraries_days_day[$k] : ($k + 1);

			$image = '';



			if (!empty($_FILES['quotation_itineraries_days_image_file']['name'][$k])) {



				$_FILES['tmp_day_image'] = array(

					'name'     => $_FILES['quotation_itineraries_days_image_file']['name'][$k],

					'type'     => $_FILES['quotation_itineraries_days_image_file']['type'][$k],

					'tmp_name' => $_FILES['quotation_itineraries_days_image_file']['tmp_name'][$k],

					'error'    => $_FILES['quotation_itineraries_days_image_file']['error'][$k],

					'size'     => $_FILES['quotation_itineraries_days_image_file']['size'][$k]

				);



				$up = $this->upload_day_image('tmp_day_image');



				if (isset($up['ok']) && $up['ok']) {

					$image = $up['file'];

				} else {

					$defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';

					$copied = $this->copy_default_day_image_to_quotation($defaultName);

					$image = $copied ? $copied : $defaultName;

				}



			} else {

				$defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';

				$copied = $this->copy_default_day_image_to_quotation($defaultName);

				$image = $copied ? $copied : $defaultName;

			}



			$tbVal = isset($travelBackArr[$k]) ? $travelBackArr[$k] : '';



			$requiredStatus = 0;

			if ($tbVal === 'TB') {

				$requiredStatus = isset($requiredStatusArr[$k]) ? (int)$requiredStatusArr[$k] : 1;

				if ($requiredStatus !== 2) {

					$requiredStatus = 1;

				}

			}



			$data_day = array(

				'quotation_itinerary_id_fk'                    => $quotation_itinerary_id,

				'quotation_days_id_fk'                      => $itinDayId,

				'quotation_itineraries_days_day'               => $dayNo,

				'quotation_itineraries_days_destination_id_fk' => isset($quotation_itineraries_days_destination_id_fk[$k]) ? $quotation_itineraries_days_destination_id_fk[$k] : '',

				'quotation_itineraries_days_title'             => isset($quotation_itineraries_days_title[$k]) ? $quotation_itineraries_days_title[$k] : '',

				'quotation_itineraries_days_description'       => isset($quotation_itineraries_days_description[$k]) ? $quotation_itineraries_days_description[$k] : '',

				'quotation_itineraries_days_travel_back'       => $tbVal,

				'quotation_itineraries_days_required_status'   => $requiredStatus,

				'quotation_itineraries_days_image'             => $image,

				'quotation_itinerary_days_status'              => 1

			);



			$pkgInsertedId = $this->General_model->add_returnID(

				$this->quotation_itinerary_days,

				$data_day

			);



			if (!$pkgInsertedId) {

				return FALSE;

			}



			$pkgDayMap[$itinDayId] = $pkgInsertedId;

		}

		/* =============================

		3) INCLUSIONS

		============================= */

		$quotation_inclusion_exclusion_checked_type = $this->input->post('quotation_inclusion_exclusion_checked_type');

		$common_id                                 = $this->input->post('quotation_inclusion_exclusion_common_id_fk');

		$quotation_inclusions_details               = (array)$this->input->post('quotation_inclusions_details');



		if ($quotation_inclusion_exclusion_checked_type == 'Y') {

			foreach ($quotation_inclusions_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_inclusions, array(

					'quotation_id_fk'              => $quotation_id,

					'quotation_inclusion_common_id_fk'      => $common_id,

					'quotation_inclusions_type'    => $quotation_inclusion_exclusion_checked_type,

					'quotation_inclusions_details ' => $detail,

					'quotation_inclusions_status'  => 1

				));

			}

		}



		/* =============================

		4) EXCLUSIONS

		============================= */

		$quotation_exclusions_details = (array)$this->input->post('quotation_exclusions_details');



		if ($quotation_inclusion_exclusion_checked_type == 'Y') {

			foreach ($quotation_exclusions_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_exclusion, array(

					'quotation_id_fk'              => $quotation_id,

					'quotation_exclusions_id_fk'     => $common_id,

					'quotation_exclusions_type'    => $quotation_inclusion_exclusion_checked_type,

					'quotation_exclusions_details' => $detail,

					'quotation_exclusion_status'  => 1

				));

			}

		}



		/* =============================

		5) OPTIONAL ADD ON

		============================= */

		$quotation_optional_add_on_checked_type = $this->input->post('quotation_optional_add_on_checked_type');

		$quotation_optional_add_on_details      = (array)$this->input->post('quotation_optional_add_on_details');



		if ($quotation_optional_add_on_checked_type == 'Y') {

			foreach ($quotation_optional_add_on_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_optional_add_on, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_optional_add_on_details'        => $detail,

					'quotation_optional_add_on_status'         => 1

				));

			}

		}



		/* =============================

		6) SPECIAL REQUIREMENTS

		============================= */

		// $packages_special_requirment_checked_type = $this->input->post('packages_special_requirment_checked_type');

		// $special_requirements_id_fk               = (array)$this->input->post('special_requirements_id_fk');

		// $packages_special_requirements_cost       = (array)$this->input->post('packages_special_requirements_cost');



		// if ($packages_special_requirment_checked_type == 'Y') {

		// 	foreach ($special_requirements_id_fk as $k => $sid) {

		// 		if (!$sid) continue;



		// 		$this->General_model->add($this->packages_special_requirements, array(

		// 			'packages_special_requirements_packages_id_fk' => $package_id,

		// 			'special_requirements_id_fk'                   => $sid,

		// 			'packages_special_requirements_cost'           => isset($packages_special_requirements_cost[$k]) ? $packages_special_requirements_cost[$k] : '',

		// 			'packages_special_requirements_status'         => 1

		// 		));

		// 	}

		// }



		/* =============================

		7) PAYMENT POLICIES

		============================= */

		$quotation_payment_policies_checked_type = $this->input->post('quotation_payment_policies_checked_type');

		$quotation_policies_id_fk                 = $this->input->post('quotation_policies_id_fk');

		// $payment_policies_items_id_fk           = (array)$this->input->post('payment_policies_items_id_fk');

		$quotation_payment_policies_details      = (array)$this->input->post('quotation_payment_policies_details');



		if ($quotation_payment_policies_checked_type == 'Y') {

			foreach ($quotation_payment_policies_details as $k => $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				// $itemId = isset($payment_policies_items_id_fk[$k]) ? $payment_policies_items_id_fk[$k] : '';



				$this->General_model->add($this->quotation_payment_policies, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_policies_id_fk'                   => $quotation_policies_id_fk,

					// 'payment_policies_items_id_fk'             => $itemId,

					'quotation_payment_policies_type'           => $quotation_payment_policies_checked_type,

					'quotation_payment_policies_details'        => $detail,

					'quotation_payment_policies_status'         => 1

				));

			}

		}



		/* =============================

		8) TERMS

		============================= */

		$quotation_terms_conditions_checked_type = $this->input->post('quotation_terms_conditions_checked_type');

		$quotation_terms_condition_id_fk                  = $this->input->post('quotation_terms_condition_id_fk');

		// $terms_condition_item_id_fk             = (array)$this->input->post('terms_condition_item_id_fk');

		$quotation_terms_condition_details       = (array)$this->input->post('quotation_terms_condition_details');



		if ($quotation_terms_conditions_checked_type == 'Y') {

			foreach ($quotation_terms_condition_details as $k => $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				// $itemId = isset($terms_condition_item_id_fk[$k]) ? $terms_condition_item_id_fk[$k] : '';



				$this->General_model->add($this->quotation_terms_condition, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_terms_condition_id_fk'                   => $quotation_terms_condition_id_fk,

					// 'terms_condition_item_id_fk'              => $itemId,

					'quotation_terms_condition_type'           => $quotation_terms_conditions_checked_type,

					'quotation_terms_condition_details'        => $detail,

					'quotation_terms_condition_status'         => 1

				));

			}

		}



		/* =============================

		9) CANCELLATION

		============================= */

		$quotation_cancellation_policy_checked_type = $this->input->post('quotation_cancellation_policy_checked_type');

		$quotation_cancellation_policies_id_fk               = $this->input->post('quotation_cancellation_policies_id_fk');

		// $cancellation_policies_item_id_fk          = (array)$this->input->post('cancellation_policies_item_id_fk');

		$quotation_cancellation_policies_details    = (array)$this->input->post('quotation_cancellation_policies_details');



		if ($quotation_cancellation_policy_checked_type == 'Y') {

			foreach ($quotation_cancellation_policies_details as $k => $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				// $itemId = isset($cancellation_policies_item_id_fk[$k]) ? $cancellation_policies_item_id_fk[$k] : '';



				$this->General_model->add($this->quotation_cancellation_policies, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_cancellation_policies_id_fk'                   => $quotation_cancellation_policies_id_fk,

					// 'cancellation_policies_item_id_fk'              => $itemId,

					'quotation_cancellation_policies_type'           => $quotation_cancellation_policy_checked_type,

					'quotation_cancellation_policies_details'        => $detail,

					'quotation_cancellation_policies_status'         => 1

				));

			}

		}



		/* =============================

		10) NOTES

		============================= */

		$quotation_notes_checked_type = $this->input->post('quotation_notes_checked_type');

		$quotation_notes_details      = (array)$this->input->post('quotation_notes_details');



		if ($quotation_notes_checked_type == 'Y') {

			foreach ($quotation_notes_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_notes, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_notes_details'        => $detail,

					'quotation_notes_status'         => 1

				));

			}

		}



		return array(

			'status'                => TRUE,

			'quotation_itinerary_id' => $quotation_itinerary_id,

			'pkgDayMap'             => $pkgDayMap

		);

	}

	public function ajax_edit_itinerary($id)

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



	private function upload_quotation_cover_image($field_name)

	{

		$upload_path = FCPATH . 'uploads/quotation_cover/';



		if (!is_dir($upload_path)) {

			@mkdir($upload_path, 0777, true);

		}



		$file_name = $_FILES[$field_name]['name'];

		$ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

		$allowed = array('jpg', 'jpeg', 'png', 'webp');



		if (!in_array($ext, $allowed)) {

			return array(

				'ok' => false,

				'message' => 'Only JPG, JPEG, PNG, WEBP allowed for cover page'

			);

		}



		$new_name = 'pkg_cover_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;



		$config = array();

		$config['upload_path']   = $upload_path;

		$config['allowed_types'] = 'jpg|jpeg|png|webp';

		$config['file_name']     = $new_name;

		$config['overwrite']     = false;

		$config['max_size']      = 5120; // 5MB



		$this->load->library('upload');

		$this->upload->initialize($config);



		if (!$this->upload->do_upload($field_name)) {

			return array(

				'ok' => false,

				'message' => $this->upload->display_errors('', '')

			);

		}



		$updata = $this->upload->data();



		return array(

			'ok'   => true,

			'file' => $updata['file_name']

		);

	}



	private function delete_old_package_itinerary_rows($oldItineraryIds, $keepItineraryId)

	{

		$keepItineraryId = (int)$keepItineraryId;



		if (empty($oldItineraryIds)) {

			return;

		}



		$deleteIds = array();



		foreach ($oldItineraryIds as $oldId) {

			$oldId = (int)$oldId;

			if ($oldId > 0 && $oldId !== $keepItineraryId) {

				$deleteIds[] = $oldId;

			}

		}



		if (empty($deleteIds)) {

			return;

		}



		$this->db->where_in('quotation_itinerary_id_fk', $deleteIds);

		$this->db->delete('quotation_itinerary_days');



		$this->db->where_in('quotation_itinerary_id', $deleteIds);

		$this->db->delete('quotation_itinerary');

	}



	private function get_old_package_itinerary_ids($quotation_id)

	{

		$rows = $this->db->select('quotation_itinerary_id')

			->from('quotation_itinerary')

			->where('quotation_id_fk', $quotation_id)

			->get()

			->result_array();



		$ids = array();



		foreach ($rows as $r) {

			if (!empty($r['quotation_itinerary_id'])) {

				$ids[] = (int)$r['quotation_itinerary_id'];

			}

		}



		return $ids;

	}



	private function update_quotation_itinerary_days_only($quotation_id)

	{

		$quotation_itinerary_days_id        = (array)$this->input->post('quotation_itinerary_days_id');

		$descriptions                       = (array)$this->input->post('quotation_itineraries_days_description');

		$defaultImages                      = (array)$this->input->post('default_itinerary_day_image');



		foreach ($quotation_itinerary_days_id as $k => $qidDayId) {



			$qidDayId = (int)$qidDayId;

			if (!$qidDayId) {

				continue;

			}



			// keep old image by default

			$image = isset($defaultImages[$k]) ? trim((string)$defaultImages[$k]) : '';



			// if new upload exists, upload new image

			if (!empty($_FILES['quotation_itineraries_days_image_file']['name'][$k])) {



				$_FILES['tmp_day_image'] = array(

					'name'     => $_FILES['quotation_itineraries_days_image_file']['name'][$k],

					'type'     => $_FILES['quotation_itineraries_days_image_file']['type'][$k],

					'tmp_name' => $_FILES['quotation_itineraries_days_image_file']['tmp_name'][$k],

					'error'    => $_FILES['quotation_itineraries_days_image_file']['error'][$k],

					'size'     => $_FILES['quotation_itineraries_days_image_file']['size'][$k]

				);



				$up = $this->upload_day_image('tmp_day_image');



				if (isset($up['ok']) && $up['ok']) {

					$image = $up['file'];

				} else {

					return array(

						'status' => FALSE,

						'message' => isset($up['error']) ? $up['error'] : 'Day image upload failed'

					);

				}

			}



			$data = array(

				'quotation_itineraries_days_description' => isset($descriptions[$k]) ? $descriptions[$k] : '',

				'quotation_itineraries_days_image'       => $image

			);



			$this->db->where('quotation_itinerary_days_id', $qidDayId);

			$this->db->where('quotation_itinerary_id_fk IN (SELECT quotation_itinerary_id FROM quotation_itinerary WHERE quotation_id_fk = ' . (int)$quotation_id . ')', NULL, FALSE);

			$this->db->update('quotation_itinerary_days', $data);

		}



		return array('status' => TRUE);

	}



	private function insert_quotation_non_itinerary_children($quotation_id)

	{

		/* =============================

		3) INCLUSIONS

		============================= */

		$quotation_inclusion_exclusion_checked_type = $this->input->post('quotation_inclusion_exclusion_checked_type');

		$common_id = $this->input->post('quotation_inclusion_exclusion_common_id_fk');

		$quotation_inclusions_details = (array)$this->input->post('quotation_inclusions_details');



		if ($quotation_inclusion_exclusion_checked_type == 'Y') {

			foreach ($quotation_inclusions_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_inclusions, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_inclusion_common_id_fk' => $common_id,

					'quotation_inclusions_type' => $quotation_inclusion_exclusion_checked_type,

					'quotation_inclusions_details' => $detail,

					'quotation_inclusions_status' => 1

				));

			}

		}



		/* =============================

		4) EXCLUSIONS

		============================= */

		$quotation_exclusions_details = (array)$this->input->post('quotation_exclusions_details');



		if ($quotation_inclusion_exclusion_checked_type == 'Y') {

			foreach ($quotation_exclusions_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_exclusion, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_exclusions_id_fk' => $common_id,

					'quotation_exclusions_type' => $quotation_inclusion_exclusion_checked_type,

					'quotation_exclusions_details' => $detail,

					'quotation_exclusion_status' => 1

				));

			}

		}



		/* =============================

		OPTIONAL ADD ON

		============================= */

		$quotation_optional_add_on_checked_type = $this->input->post('quotation_optional_add_on_checked_type');

		$quotation_optional_add_on_details = (array)$this->input->post('quotation_optional_add_on_details');



		if ($quotation_optional_add_on_checked_type == 'Y') {

			foreach ($quotation_optional_add_on_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_optional_add_on, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_optional_add_on_details' => $detail,

					'quotation_optional_add_on_status' => 1

				));

			}

		}



		/* =============================

		PAYMENT POLICIES

		============================= */

		$quotation_payment_policies_checked_type = $this->input->post('quotation_payment_policies_checked_type');

		$quotation_policies_id_fk = $this->input->post('quotation_policies_id_fk');

		$quotation_payment_policies_details = (array)$this->input->post('quotation_payment_policies_details');



		if ($quotation_payment_policies_checked_type == 'Y') {

			foreach ($quotation_payment_policies_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_payment_policies, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_policies_id_fk' => $quotation_policies_id_fk,

					'quotation_payment_policies_type' => $quotation_payment_policies_checked_type,

					'quotation_payment_policies_details' => $detail,

					'quotation_payment_policies_status' => 1

				));

			}

		}



		/* =============================

		TERMS

		============================= */

		$quotation_terms_conditions_checked_type = $this->input->post('quotation_terms_conditions_checked_type');

		$quotation_terms_condition_id_fk = $this->input->post('quotation_terms_condition_id_fk');

		$quotation_terms_condition_details = (array)$this->input->post('quotation_terms_condition_details');



		if ($quotation_terms_conditions_checked_type == 'Y') {

			foreach ($quotation_terms_condition_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_terms_condition, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_terms_condition_id_fk' => $quotation_terms_condition_id_fk,

					'quotation_terms_condition_type' => $quotation_terms_conditions_checked_type,

					'quotation_terms_condition_details' => $detail,

					'quotation_terms_condition_status' => 1

				));

			}

		}



		/* =============================

		CANCELLATION

		============================= */

		$quotation_cancellation_policy_checked_type = $this->input->post('quotation_cancellation_policy_checked_type');

		$quotation_cancellation_policies_id_fk = $this->input->post('quotation_cancellation_policies_id_fk');

		$quotation_cancellation_policies_details = (array)$this->input->post('quotation_cancellation_policies_details');



		if ($quotation_cancellation_policy_checked_type == 'Y') {

			foreach ($quotation_cancellation_policies_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_cancellation_policies, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_cancellation_policies_id_fk' => $quotation_cancellation_policies_id_fk,

					'quotation_cancellation_policies_type' => $quotation_cancellation_policy_checked_type,

					'quotation_cancellation_policies_details' => $detail,

					'quotation_cancellation_policies_status' => 1

				));

			}

		}



		/* =============================

		NOTES

		============================= */

		$quotation_notes_checked_type = $this->input->post('quotation_notes_checked_type');

		$quotation_notes_details = (array)$this->input->post('quotation_notes_details');



		if ($quotation_notes_checked_type == 'Y') {

			foreach ($quotation_notes_details as $detail) {

				$detail = trim((string)$detail);

				if ($detail === '') continue;



				$this->General_model->add($this->quotation_notes, array(

					'quotation_id_fk' => $quotation_id,

					'quotation_notes_details' => $detail,

					'quotation_notes_status' => 1

				));

			}

		}



		return TRUE;

	}

	public function ajax_itinerary_update()

{

    if (method_exists($this, '_ajax_add_validate')) {

        $this->_ajax_add_validate();

    }



    $id = (int)$this->input->post('quotations_id');



    if (!$id) {

        echo json_encode(array('status' => FALSE, 'message' => 'Invalid quotation ID'));

        return;

    }



    $this->db->trans_begin();



    if (function_exists('date_default_timezone_set')) {

        date_default_timezone_set("Asia/Kolkata");

    }



    /* =========================================================

       1) SAVE / KEEP COVER PAGE IMAGES

    ========================================================= */

    $quotation_first_cover_page = '';

    $quotation_last_cover_page  = '';



    if (!empty($_FILES['quotation_first_cover_page']['name'])) {

        $up1 = $this->upload_quotation_cover_image('quotation_first_cover_page');



        if (!isset($up1['ok']) || !$up1['ok']) {

            $this->db->trans_rollback();

            echo json_encode(array(

                'status'  => FALSE,

                'message' => isset($up1['message']) ? $up1['message'] : 'First cover page upload failed'

            ));

            return;

        }



        $quotation_first_cover_page = $up1['file'];

    } else {

        $quotation_first_cover_page = trim((string)$this->input->post('quotation_first_cover_page_txt'));

    }



    if (!empty($_FILES['quotation_last_cover_page']['name'])) {

        $up2 = $this->upload_quotation_cover_image('quotation_last_cover_page');



        if (!isset($up2['ok']) || !$up2['ok']) {

            $this->db->trans_rollback();

            echo json_encode(array(

                'status'  => FALSE,

                'message' => isset($up2['message']) ? $up2['message'] : 'Last cover page upload failed'

            ));

            return;

        }



        $quotation_last_cover_page = $up2['file'];

    } else {

        $quotation_last_cover_page = trim((string)$this->input->post('quotation_last_cover_page_txt'));

    }



    /* =========================================================

       2) UPDATE QUOTATION MASTER

    ========================================================= */

    $data = array(

        'quotation_inclusion_exclusion_common_id_fk' => $this->input->post('quotation_inclusion_exclusion_common_id_fk'),

        'quotation_inclusion_exclusion_checked_type' => $this->input->post('quotation_inclusion_exclusion_checked_type'),

        'quotation_optional_add_on_checked_type'     => $this->input->post('quotation_optional_add_on_checked_type'),

        'quotation_payment_policies_checked_type'    => $this->input->post('quotation_payment_policies_checked_type'),

        'quotation_terms_conditions_checked_type'    => $this->input->post('quotation_terms_conditions_checked_type'),

        'quotation_cancellation_policy_checked_type' => $this->input->post('quotation_cancellation_policy_checked_type'),

        'quotation_notes_checked_type'               => $this->input->post('quotation_notes_checked_type'),

        'quotation_title'                            => $this->input->post('quotation_title'),

        'quotation_first_cover_page'                 => $quotation_first_cover_page,

        'quotation_last_cover_page'                  => $quotation_last_cover_page

    );



    $this->db->where('quotation_id', $id);

    $this->db->update('quotation', $data);



    /* =========================================================

       3) UPDATE ONLY itinerary day description + image

    ========================================================= */

    $updateDays = $this->update_quotation_itinerary_days_only($id);



    if (!$updateDays['status']) {

        $this->db->trans_rollback();

        echo json_encode(array(

            'status' => FALSE,

            'message' => $updateDays['message']

        ));

        return;

    }



    /* =========================================================

       4) DELETE & REINSERT OTHER CHILD TABLES ONLY

    ========================================================= */

    $this->delete_quotation_children_except_itinerary($id);



    // reinsert non-itinerary children only

    $this->insert_quotation_non_itinerary_children($id);



    if ($this->db->trans_status() === FALSE) {

        $this->db->trans_rollback();

        echo json_encode(array('status' => FALSE, 'message' => 'Update failed'));

        return;

    }



    $this->db->trans_commit();

    echo json_encode(array('status' => TRUE));

}



	

public function ajax_edit_delete($id)

	{

		$data = $this->Quotation_model->get_by_id($id);

		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility

		echo json_encode($data);

	}



// 	public function ajax_delete(){



// 		$currentuserid = $this->session->userdata('user_id');

// 		$currentusertype = $this->session->userdata('user_type');

// 		$currentusername = $this->session->userdata('admin_name');



// 		$this->load->helper('date');

// 		if(function_exists('date_default_timezone_set')) {

// 			date_default_timezone_set("Asia/Kolkata");

// 		}

// 		$date = date('Y-m-d');

// 		$time = date('h:i:sa');

		

// 		$date1 = date('Y-m-d h:i:s a', time());



// 		$updateData = array('quotation_status' => 0);

		

// 		$this->Quotation_model->update(array('quotation_id' => $this->input->post('id')), $updateData);

// // echo $this->db->last_query();exit();

// 		$updatecancellationData = array('quotation_cancellation_policies_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_cancellation_policies', $updatecancellationData);



// 		$updateexclusionData = array('quotation_exclusion_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_exclusion', $updateexclusionData);



// 		$updateinclusionData = array('quotation_inclusions_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_inclusions', $updateinclusionData);



// 		$updateitineraryData = array('quotation_itinerary_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_itinerary', $updateitineraryData);



// 		$template['itinerary'] = $this->General_model->get_row($this->quotation_itinerary,'quotation_id_fk',$this->input->post('id'));

		

// 		$quotation_itinerary_id = $template['itinerary']->quotation_itinerary_id;



// 		$updateitinerarydayData = array('quotation_itinerary_days_status' => 0);

// 		$this->db->where('quotation_itinerary_id_fk', $quotation_itinerary_id)->update('quotation_itinerary_days', $updateitinerarydayData);



// 		$updatenotes = array('quotation_notes_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_notes', $updatenotes);



// 		$updateoptional_add_on = array('quotation_optional_add_on_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_optional_add_on', $updateoptional_add_on);



// 		$updatepayment_policies = array('quotation_payment_policies_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_payment_policies', $updatepayment_policies);



// 		$updatequotation_option = array('quotation_options_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_options', $updatequotation_option);



// 		$status = 1;

// 		// $template['option'] = $this->General_model->get_rowtwo($this->quotation_options,'quotation_id_fk',$this->input->post('id'),'quotation_options_status',$status);

// 		$template['option'] = $this->db

// 			->where('quotation_id_fk', $this->input->post('id'))

// 			->where('quotation_options_status', '1')

// 			->get('quotation_options')

// 			->row();

// 		$quotation_options_id = $template['option']->quotation_options_id;



// 		// print_r($quotation_options_id);die;

// 		$updateproperties_days = array('quotation_properties_days_status' => 0);

// 		$this->db->where('quotation_options_id_fk', $quotation_options_id)->update('quotation_properties_days', $updateproperties_days);



// 		// $template['properties_days'] = $this->General_model->get_row($this->quotation_properties_days,'quotation_options_id_fk',$quotation_options_id);

// 		$template['properties_days'] = $this->db

// 			->where('quotation_options_id_fk', $quotation_options_id)

// 			->where('quotation_properties_days_status', '1')

// 			->get('quotation_properties_days')

// 			->row();

// 		$quotation_properties_days_id = $template['properties_days']->quotation_properties_days_id;



// 		$updateproperties = array('quotation_properties_status' => 0);

// 		$this->db->where('quotation_properties_days_id_fk', $quotation_properties_days_id)->update('quotation_properties', $updateproperties);



// 		// $template['properties'] = $this->General_model->get_row($this->quotation_properties,'quotation_properties_days_id_fk',$quotation_properties_days_id);

// 		$template['properties'] = $this->db

// 			->where('quotation_properties_days_id_fk', $quotation_properties_days_id)

// 			->where('quotation_properties_status', '1')

// 			->get('quotation_properties')

// 			->row();

// 		$quotation_properties_id = $template['properties']->quotation_properties_id;



// 		$updateproperties_rooms = array('quotation_properties_rooms_status' => 0);

// 		$this->db->where('quotation_properties_id_fk', $quotation_properties_id)->update('quotation_properties_rooms', $updateproperties_rooms);



// 		$updatespecial_requirements = array('quotation_special_requirements_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_special_requirements', $updatespecial_requirements);



// 		$updatespecial_requirements = array('quotation_property_inclusions_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_property_inclusions', $updatespecial_requirements);



// 		$updateterms_condition = array('quotation_terms_condition_status' => 0);

// 		$this->db->where('quotation_id_fk', $this->input->post('id'))->update('quotation_terms_condition', $updateterms_condition);



// 		$quote_num = $this->input->post('quote_num');

// 		$ip = $this->input->ip_address();

		

// 		$activity_data = array(

// 				'activity_description' => 'Deleted quotation: '.$quote_num.'',

// 				'id_fk' => $this->input->post('id'),

// 				'activity_type' => 'Quotation_registration',

// 				// 'activity_order_number' => $invoice_order_number1,

// 				'activity_ip' => $ip,

// 				'activity_action' => 'Delete',

// 				'activity_by_userid' => $currentuserid,

// 				'activity_by_username' => $currentusername,

// 				'activity_date_time	' => $date1,

// 				'activity_date' => $date,

// 				'activity_status' => 1,

// 			);

		

// 		$this->General_model->add($this->activity,$activity_data);

// 		echo json_encode(array("status" => TRUE));



// 	}



public function ajax_delete()

{

    $quotation_id = (int)$this->input->post('id');

    $quote_num    = $this->input->post('quote_num');



    if ($quotation_id <= 0) {

        echo json_encode(array("status" => FALSE, "message" => "Invalid quotation ID"));

        return;

    }



    $currentuserid   = $this->session->userdata('user_id');

    $currentusername = $this->session->userdata('admin_name');



    date_default_timezone_set("Asia/Kolkata");

    $date  = date('Y-m-d');

    $date1 = date('Y-m-d h:i:s a');



    $this->db->trans_start();



    // main quotation

    $this->db->where('quotation_id', $quotation_id)

             ->update('quotation', array('quotation_status' => 0));



    // direct child tables

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_cancellation_policies', array('quotation_cancellation_policies_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_exclusion', array('quotation_exclusion_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_inclusions', array('quotation_inclusions_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_itinerary', array('quotation_itinerary_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_notes', array('quotation_notes_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_optional_add_on', array('quotation_optional_add_on_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_payment_policies', array('quotation_payment_policies_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_special_requirements', array('quotation_special_requirements_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_property_inclusions', array('quotation_property_inclusions_status' => 0));

    $this->db->where('quotation_id_fk', $quotation_id)->update('quotation_terms_condition', array('quotation_terms_condition_status' => 0));



    // itinerary days

    $itinerary_ids = $this->db

        ->select('quotation_itinerary_id')

        ->from('quotation_itinerary')

        ->where('quotation_id_fk', $quotation_id)

        ->get()

        ->result_array();



    if (!empty($itinerary_ids)) {

        $ids = array_column($itinerary_ids, 'quotation_itinerary_id');



        $this->db->where_in('quotation_itinerary_id_fk', $ids)

                 ->update('quotation_itinerary_days', array('quotation_itinerary_days_status' => 0));

    }



    // quotation option tree

    $option_ids = $this->db

        ->select('quotation_options_id')

        ->from('quotation_options')

        ->where('quotation_id_fk', $quotation_id)

        ->get()

        ->result_array();



    if (!empty($option_ids)) {

        $optionIds = array_column($option_ids, 'quotation_options_id');



        $day_ids = $this->db

            ->select('quotation_properties_days_id')

            ->from('quotation_properties_days')

            ->where_in('quotation_options_id_fk', $optionIds)

            ->get()

            ->result_array();



        $this->db->where_in('quotation_options_id', $optionIds)

                 ->update('quotation_options', array('quotation_options_status' => 0));



        if (!empty($day_ids)) {

            $dayIds = array_column($day_ids, 'quotation_properties_days_id');



            $property_ids = $this->db

                ->select('quotation_properties_id')

                ->from('quotation_properties')

                ->where_in('quotation_properties_days_id_fk', $dayIds)

                ->get()

                ->result_array();



            $this->db->where_in('quotation_properties_days_id', $dayIds)

                     ->update('quotation_properties_days', array('quotation_properties_days_status' => 0));



            if (!empty($property_ids)) {

                $propertyIds = array_column($property_ids, 'quotation_properties_id');



                $this->db->where_in('quotation_properties_id_fk', $propertyIds)

                         ->update('quotation_properties_rooms', array('quotation_properties_rooms_status' => 0));



                $this->db->where_in('quotation_properties_id', $propertyIds)

                         ->update('quotation_properties', array('quotation_properties_status' => 0));

            }

        }

    }



    // optional: reset lead quotation status

    $quotation = $this->db->select('leads_id_fk')

        ->from('quotation')

        ->where('quotation_id', $quotation_id)

        ->get()

        ->row();



    if ($quotation && !empty($quotation->leads_id_fk)) {

        $this->db->where('leads_id', $quotation->leads_id_fk)

                 ->update('leads', array('leads_quotation_status' => 0));

    }



    // activity

    // $activity_data = array(

    //     'activity_description' => 'Deleted quotation: '.$quote_num,

    //     'id_fk' => $quotation_id,

    //     'activity_type' => 'Quotation_registration',

    //     'activity_ip' => $this->input->ip_address(),

    //     'activity_action' => 'Delete',

    //     'activity_by_userid' => $currentuserid,

    //     'activity_by_username' => $currentusername,

    //     'activity_date_time' => $date1,

    //     'activity_date' => $date,

    //     'activity_status' => 1,

    // );



    // $this->General_model->add($this->activity, $activity_data);



    $this->db->trans_complete();



    echo json_encode(array(

        "status" => $this->db->trans_status()

    ));

}

	private function _ajax_add_validate()

	{

		$errors = array(

			"status"       => FALSE,

			"inputerror"   => array(),

			"error_string" => array()

		);



		/* =========================

		HELPERS

		========================= */

		$trim = function ($v) {

			return trim((string)$v);

		};



		$addErr = function ($field, $msg) use (&$errors) {

			$errors["inputerror"][]   = $field;

			$errors["error_string"][] = $msg;

		};



		$hasAnyText = function ($arr) use ($trim) {

			if (!is_array($arr)) return FALSE;

			foreach ($arr as $v) {

				if ($trim($v) !== '') return TRUE;

			}

			return FALSE;

		};



		$hasEmptyText = function ($arr) use ($trim) {

			if (!is_array($arr)) return FALSE;

			foreach ($arr as $v) {

				if ($trim($v) === '') return TRUE;

			}

			return FALSE;

		};



		/* =========================

		1) MAIN REQUIRED FIELDS

		========================= */

		$title   = $trim($this->input->post('quotation_title'));

		



		if ($title === '')  $addErr('quotation_title', 'Package title is required');

		



		/* =========================

		2) COVER PAGE VALIDATION

		- only required when no old/default image

		========================= */

		$oldFirst = $trim($this->input->post('quotation_first_cover_page_txt'));

		$oldLast  = $trim($this->input->post('quotation_last_cover_page_txt'));



		$newFirst = isset($_FILES['quotation_first_cover_page']['name']) ? trim($_FILES['quotation_first_cover_page']['name']) : '';

		$newLast  = isset($_FILES['quotation_last_cover_page']['name']) ? trim($_FILES['quotation_last_cover_page']['name']) : '';



		if ($oldFirst === '' && $newFirst === '') {

			$addErr('quotation_first_cover_page', 'First cover page is required');

		}



		if ($oldLast === '' && $newLast === '') {

			$addErr('quotation_last_cover_page', 'Last cover page is required');

		}



		/* =========================

		ITINERARY DAY DESCRIPTION (REQUIRED)

		========================= */

		$descriptions = $this->input->post('quotation_itineraries_days_description');



		if (!$hasAnyText($descriptions)) {

			$addErr('quotation_itineraries_days_description', 'Please add at least one itinerary day description');

		}



		if ($hasEmptyText($descriptions)) {

			$addErr('quotation_itineraries_days_description', 'Day description cannot be empty');

		}



		/* =========================

		3) INCLUSION / EXCLUSION

		========================= */

		$incExcChk = $trim($this->input->post('quotation_inclusion_exclusion_checked_type'));



		if ($incExcChk === 'Y') {



			$incDetails = $this->input->post('quotation_inclusions_details');

			$excDetails = $this->input->post('quotation_exclusions_details');



			if (!$hasAnyText($incDetails)) {

				$addErr('quotation_inclusions_details', 'Please add at least one Inclusion');

			}



			if (!$hasAnyText($excDetails)) {

				$addErr('quotation_exclusions_details', 'Please add at least one Exclusion');

			}



			if ($hasEmptyText($incDetails)) {

				$addErr('quotation_inclusions_details', 'Inclusions contains empty value');

			}



			if ($hasEmptyText($excDetails)) {

				$addErr('quotation_exclusions_details', 'Exclusions contains empty value');

			}

		}



		/* =========================

		4) OPTIONAL ADD ON

		========================= */

		$optChk = $trim($this->input->post('quotation_optional_add_on_checked_type'));



		if ($optChk === 'Y') {

			$opt = $this->input->post('quotation_optional_add_on_details');



			if (!$hasAnyText($opt)) {

				$addErr('quotation_optional_add_on_details', 'Please add at least one Optional add on');

			}



			if ($hasEmptyText($opt)) {

				$addErr('quotation_optional_add_on_details', 'Optional add on contains empty value');

			}

		}



		/* =========================

		5) SPECIAL REQUIREMENTS

		(uncomment only if using)

		========================= */

		/*

		$spChk = $trim($this->input->post('packages_special_requirment_checked_type'));



		if ($spChk === 'Y') {

			$spId   = (array)$this->input->post('special_requirements_id_fk');

			$spCost = (array)$this->input->post('packages_special_requirements_cost');



			if (empty($spId)) {

				$addErr('special_requirements_id_fk', 'Please add at least one Special requirement');

			} else {

				foreach ($spId as $k => $sid) {

					if ($trim($sid) === '') {

						$addErr('special_requirements_id_fk', 'Special requirement is required');

					}

					if (!isset($spCost[$k]) || $trim($spCost[$k]) === '') {

						$addErr('packages_special_requirements_cost', 'Special requirement cost is required');

					}

				}

			}

		}

		*/



		/* =========================

		6) PAYMENT POLICIES

		========================= */

		$payChk = $trim($this->input->post('quotation_payment_policies_checked_type'));



		if ($payChk === 'Y') {

			$pay = $this->input->post('quotation_payment_policies_details');



			if (!$hasAnyText($pay)) {

				$addErr('quotation_payment_policies_details', 'Please add at least one Payment policy');

			}



			if ($hasEmptyText($pay)) {

				$addErr('quotation_payment_policies_details', 'Payment policies contains empty value');

			}

		}



		/* =========================

		7) TERMS & CONDITIONS

		========================= */

		$termsChk = $trim($this->input->post('quotation_terms_conditions_checked_type'));



		if ($termsChk === 'Y') {

			$terms = $this->input->post('quotation_terms_condition_details');



			if (!$hasAnyText($terms)) {

				$addErr('quotation_terms_condition_details', 'Please add at least one Terms & Conditions item');

			}



			if ($hasEmptyText($terms)) {

				$addErr('quotation_terms_condition_details', 'Terms & Conditions contains empty value');

			}

		}



		/* =========================

		8) CANCELLATION POLICY

		========================= */

		$canChk = $trim($this->input->post('quotation_cancellation_policy_checked_type'));



		if ($canChk === 'Y') {

			$can = $this->input->post('quotation_cancellation_policies_details');



			if (!$hasAnyText($can)) {

				$addErr('quotation_cancellation_policies_details', 'Please add at least one Cancellation policy');

			}



			if ($hasEmptyText($can)) {

				$addErr('quotation_cancellation_policies_details', 'Cancellation policy contains empty value');

			}

		}



		/* =========================

		9) NOTES

		========================= */

		$notesChk = $trim($this->input->post('quotation_notes_checked_type'));



		if ($notesChk === 'Y') {

			$notes = $this->input->post('quotation_notes_details');



			if (!$hasAnyText($notes)) {

				$addErr('quotation_notes_details', 'Please add at least one Note');

			}



			if ($hasEmptyText($notes)) {

				$addErr('quotation_notes_details', 'Notes contains empty value');

			}

		}





		/* =========================

		RETURN ERRORS

		========================= */

		if (!empty($errors['inputerror'])) {

			echo json_encode($errors);

			exit;

		}

	}



	// public function ajax_edit($id)

	// {

	// 	$data = $this->Quotation_model->get_by_id($id);

	// 	// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility

	// 	echo json_encode($data);

	// }



	public function ajax_edit_trip($id)

	{

		$data = $this->Quotation_model->get_by_id_trip($id);

		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility

		echo json_encode($data);

	}



	public function ajax_edit($id)

	{

		$quotation = $this->Quotation_model->get_by_id($id);



		// print_r($quotation);die;

		if (!$quotation) {

			echo json_encode(array(

				'status' => false,

				'message' => 'Quotation not found'

			));

			return;

		}



		$options = $this->Quotation_model->get_full_quotation_options($id);

		// echo $this->db->last_query();exit();

		$property_inclusions = $this->Quotation_model->get_quotation_property_inclusions($id);

		$special_requirements = $this->Quotation_model->get_quotation_special_requirements($id);



		echo json_encode(array(

			'status' => true,

			'quotation' => $quotation,

			'options' => $options,

			'property_inclusions' => $property_inclusions,

			'special_requirements' => $special_requirements

		));

	}



	public function convert_trip()

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



		$trips_travel_start_date = str_replace('/','-', $this->input->post('trips_travel_start_date'));

		$trips_travel_start_date = date("Y-m-d h:i:s a",strtotime($trips_travel_start_date));



		$trips_travel_end_date = str_replace('/','-', $this->input->post('trips_travel_end_date'));

		$trips_travel_end_date = date("Y-m-d h:i:s a",strtotime($trips_travel_end_date));



		$data = array(

			'quotation_id_fk'               => $this->input->post('id'),

			'lead_id_fk'                    => $this->input->post('lead_id_fk'),

			'trips_travel_start_date'        => $trips_travel_start_date,

			'trips_travel_duration'        => $this->input->post('trips_travel_duration'),

			'trips_travel_end_date'        => $trips_travel_end_date,

			'trips_created_by_userid'  => $currentuserid,

			'trips_created_by_username'=> $currentusername,

			'trips_created_date'    => $date,

			'trips_created_time'    => $time,

			'trips_current_status'             => 1,

			'trips_status'             => 1

		);



		$insert = $this->Quotation_model->save_trip($data);



		// $itineraries_name = $this->input->post('itineraries_name');

		$ip = $this->input->ip_address();

		

		// $activity_data = array(

		// 		'activity_description' => 'Deleted itinerary: '.$itineraries_name.'',

		// 		'id_fk' => $this->input->post('id'),

		// 		'activity_type' => 'Itinerary_registration',

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



	/* ================= AJAX FILTER ENDPOINTS ================= */



	public function ajax_filter_quotations()

	{

		$q = $this->input->get('q');

		$this->db->select('quotation_id, quotation_number');

		$this->db->from('quotation');

		$this->db->where('quotation_status', 1);

		$this->db->where('quotation_status', 1);

		if ($q) {

			$this->db->like('quotation_number', $q);

		}

		$this->db->order_by('quotation_id', 'DESC');

		$rows = $this->db->get()->result();



		$results = [];

		foreach ($rows as $row) {

			$results[] = ['id' => $row->quotation_id, 'text' => $row->quotation_number];

		}

		echo json_encode(['results' => $results]);

	}



	public function ajax_filter_packages()

	{

		$q = $this->input->get('q');

		$this->db->select('packages_id, packages_title');

		$this->db->from('packages');

		$this->db->where('packages_status', 1);

		if ($q) {

			$this->db->like('packages_title', $q);

		}

		$this->db->order_by('packages_id', 'DESC');

		$rows = $this->db->get()->result();



		$results = [];

		foreach ($rows as $row) {

			$results[] = ['id' => $row->packages_id, 'text' => $row->packages_title];

		}

		echo json_encode(['results' => $results]);

	}



	public function ajax_filter_leads()

	{

		$q = $this->input->get('q');

		$filter_mode = $this->input->get('filter_mode');

		$this->db->select('leads_id, leads_number, guest_name');

		$this->db->from('leads');

		$this->db->where('leads_status', 1);

		if ($filter_mode === 'add_quotation') {
			$this->db->where('leads_accomodation_status', 2);
			$this->db->group_start();
			$this->db->where('leads_quotation_status', 0);
			$this->db->or_where('leads_quotation_status', 2);
			$this->db->group_end();
		}

		if ($q) {

			$this->db->group_start();

			$this->db->like('leads_number', $q);

			$this->db->or_like('guest_name', $q);

			$this->db->group_end();

		}

		$this->db->order_by('leads_id', 'DESC');

		$rows = $this->db->get()->result();



		$results = [];

		foreach ($rows as $row) {

			$display = $row->leads_number . ' - ' . $row->guest_name;

			$results[] = ['id' => $row->leads_id, 'text' => $display];

		}

		echo json_encode(['results' => $results]);

	}

	public function ajax_save_financial_posting()
	{
		if (!has_permission('FINANCIAL_POSTING')) {
			echo json_encode(['status' => false, 'message' => 'Permission denied: Financial Posting']);
			return;
		}

		$raw     = file_get_contents('php://input');
		$payload = json_decode($raw, true);

		if (!$payload) {
			echo json_encode(['status' => false, 'message' => 'Invalid payload']);
			return;
		}

		$leadId   = (int)(isset($payload['fp_leads_id_fk']) ? $payload['fp_leads_id_fk'] : 0);
		$recordId = (int)(isset($payload['fp_record_id'])   ? $payload['fp_record_id']   : 0);

		if (!$leadId) {
			echo json_encode(['status' => false, 'message' => 'Lead ID required']);
			return;
		}

		$main = [
			'fp_leads_id_fk'   => $leadId,
			'fp_driver_quoted' => (float)(isset($payload['fp_driver_quoted']) ? $payload['fp_driver_quoted'] : 0),
			'fp_driver_actual' => (float)(isset($payload['fp_driver_actual']) ? $payload['fp_driver_actual'] : 0),
			'fp_driver_desc'   => isset($payload['fp_driver_desc']) ? $payload['fp_driver_desc'] : '',
			'fp_actual_cost'   => (float)(isset($payload['fp_actual_cost'])   ? $payload['fp_actual_cost']   : 0),
			'fp_cost_after'    => (float)(isset($payload['fp_cost_after'])    ? $payload['fp_cost_after']    : 0),
			'fp_margin'        => (float)(isset($payload['fp_margin'])        ? $payload['fp_margin']        : 0),
			'fp_notes'         => isset($payload['fp_notes']) ? $payload['fp_notes'] : '',
		];

		if ($recordId > 0) {
			$this->db->where('fp_id', $recordId)->update('financial_posting', $main);
			$fpId = $recordId;
			$this->db->where('fphd_fp_id_fk', $fpId)->delete('financial_posting_hotel_days');
			if ($this->db->table_exists('financial_posting_inclusions')) {
				$this->db->where('fpi_fp_id_fk', $fpId)->delete('financial_posting_inclusions');
			}
			if ($this->db->table_exists('financial_posting_special')) {
				$this->db->where('fps_fp_id_fk', $fpId)->delete('financial_posting_special');
			}
			$this->db->where('fpe_fp_id_fk',  $fpId)->delete('financial_posting_expenses');
		} else {
			$this->db->insert('financial_posting', $main);
			$fpId = $this->db->insert_id();
		}

		// Save day-based data
		$days = isset($payload['days']) ? $payload['days'] : [];
		foreach ($days as $i => $day) {
			$dayLabel = isset($day['day_label']) ? $day['day_label'] : 'Day ' . ($i + 1);

			// Hotel
			$this->db->insert('financial_posting_hotel_days', [
				'fphd_fp_id_fk'      => $fpId,
				'fphd_day_label'     => $dayLabel,
				'fphd_quoted_amount' => (float)(isset($day['hotel_quoted']) ? $day['hotel_quoted'] : 0),
				'fphd_actual_amount' => (float)(isset($day['hotel_actual']) ? $day['hotel_actual'] : 0),
				'fphd_description'   => isset($day['hotel_desc']) ? $day['hotel_desc'] : '',
				'fphd_sort_order'    => $i,
			]);

			// Inclusions - check if table exists
			if ($this->db->table_exists('financial_posting_inclusions')) {
				$this->db->insert('financial_posting_inclusions', [
					'fpi_fp_id_fk'      => $fpId,
					'fpi_day_label'     => $dayLabel,
					'fpi_quoted_amount' => (float)(isset($day['inc_quoted']) ? $day['inc_quoted'] : 0),
					'fpi_actual_amount' => (float)(isset($day['inc_actual']) ? $day['inc_actual'] : 0),
					'fpi_description'   => isset($day['inc_desc']) ? $day['inc_desc'] : '',
					'fpi_sort_order'    => $i,
				]);
			}

			// Special Requirements - check if table exists
			if ($this->db->table_exists('financial_posting_special')) {
				$this->db->insert('financial_posting_special', [
					'fps_fp_id_fk'      => $fpId,
					'fps_day_label'     => $dayLabel,
					'fps_quoted_amount' => (float)(isset($day['special_quoted']) ? $day['special_quoted'] : 0),
					'fps_actual_amount' => (float)(isset($day['special_actual']) ? $day['special_actual'] : 0),
					'fps_description'   => isset($day['special_desc']) ? $day['special_desc'] : '',
					'fps_sort_order'    => $i,
				]);
			}
		}

		$expLabels  = isset($payload['exp_labels'])  ? $payload['exp_labels']  : [];
		$expAmounts = isset($payload['exp_amounts']) ? $payload['exp_amounts'] : [];
		$expDescs   = isset($payload['exp_descs'])   ? $payload['exp_descs']   : [];
		foreach ($expLabels as $i => $label) {
			$this->db->insert('financial_posting_expenses', [
				'fpe_fp_id_fk'    => $fpId,
				'fpe_label'       => $label,
				'fpe_amount'      => (float)(isset($expAmounts[$i]) ? $expAmounts[$i] : 0),
				'fpe_description' => isset($expDescs[$i]) ? $expDescs[$i] : '',
			]);
		}

		echo json_encode(['status' => true, 'fp_id' => $fpId]);
	}

	public function ajax_get_financial_posting($leadId)
	{
		$leadId = (int)$leadId;
		if (!$leadId) {
			echo json_encode(['status' => false, 'message' => 'Invalid lead ID']);
			return;
		}

		$main = $this->db
			->where('fp_leads_id_fk', $leadId)
			->order_by('fp_id', 'DESC')
			->limit(1)
			->get('financial_posting')
			->row_array();

		if (!$main) {
			echo json_encode(['status' => false, 'message' => 'No record found']);
			return;
		}

		$fpId = $main['fp_id'];

		$hotelDays = $this->db
			->where('fphd_fp_id_fk', $fpId)
			->order_by('fphd_sort_order', 'ASC')
			->get('financial_posting_hotel_days')
			->result_array();

		$expenses = $this->db
			->where('fpe_fp_id_fk', $fpId)
			->get('financial_posting_expenses')
			->result_array();

		$inclusions = array();
		if ($this->db->table_exists('financial_posting_inclusions')) {
			$inclusions = $this->db
				->where('fpi_fp_id_fk', $fpId)
				->order_by('fpi_sort_order', 'ASC')
				->get('financial_posting_inclusions')
				->result_array();
		}

		$special = array();
		if ($this->db->table_exists('financial_posting_special')) {
			$special = $this->db
				->where('fps_fp_id_fk', $fpId)
				->order_by('fps_sort_order', 'ASC')
				->get('financial_posting_special')
				->result_array();
		}

		// Convert hotel_days to days format for JavaScript
		$days = array();
		foreach ($hotelDays as $i => $hotel) {
			$dayLabel = isset($hotel['fphd_day_label']) ? $hotel['fphd_day_label'] : 'Day ' . ($i + 1);
			$days[] = array(
				'day_label' => $dayLabel,
				'hotel_cost' => (float)$hotel['fphd_quoted_amount'],
				'hotel_quoted' => (float)$hotel['fphd_quoted_amount'],
				'hotel_actual' => (float)$hotel['fphd_actual_amount'],
				'hotel_desc' => $hotel['fphd_description'],
				'inclusions_cost' => 0,
				'inc_quoted' => 0,
				'inc_actual' => 0,
				'inc_desc' => '',
				'special_cost' => 0,
				'special_quoted' => 0,
				'special_actual' => 0,
				'special_desc' => ''
			);
		}

		// Merge inclusions into days
		foreach ($inclusions as $inc) {
			$dayLabel = $inc['fpi_day_label'];
			foreach ($days as &$day) {
				if ($day['day_label'] == $dayLabel) {
					$day['inclusions_cost'] = (float)$inc['fpi_quoted_amount'];
					$day['inc_quoted'] = (float)$inc['fpi_quoted_amount'];
					$day['inc_actual'] = (float)$inc['fpi_actual_amount'];
					$day['inc_desc'] = $inc['fpi_description'];
					break;
				}
			}
		}

		// Merge special requirements into days
		foreach ($special as $sp) {
			$dayLabel = $sp['fps_day_label'];
			foreach ($days as &$day) {
				if ($day['day_label'] == $dayLabel) {
					$day['special_cost'] = (float)$sp['fps_quoted_amount'];
					$day['special_quoted'] = (float)$sp['fps_quoted_amount'];
					$day['special_actual'] = (float)$sp['fps_actual_amount'];
					$day['special_desc'] = $sp['fps_description'];
					break;
				}
			}
		}

		echo json_encode([
			'status' => true,
			'data'   => array_merge($main, [
				'days'     => $days,
				'expenses' => $expenses,
			]),
		]);
	}

	public function ajax_get_financial_posting_defaults($quotation_id)
	{
		$quotation_id = (int)$quotation_id;
		if (!$quotation_id) {
			echo json_encode(['status' => false, 'message' => 'Invalid quotation ID']);
			return;
		}

		$defaults = $this->Quotation_model->get_financial_posting_defaults($quotation_id);

		echo json_encode([
			'status' => true,
			'data'   => $defaults,
		]);
	}

	public function converted_trips_report()
	{
		if (!has_permission('CONVERTED_TRIPS_REPORT')) {
			show_error('Permission denied: Converted Trips Report', 403);
			return;
		}
		$template['staff']            = $this->Quotation_model->fetch_staff_users();
		$template['current_user_type'] = $this->session->userdata('user_type');
		$template['current_user_id']   = $this->session->userdata('user_id');
		$template['body']   = 'Quotation/converted_trips_report';
		$template['script'] = 'Quotation/converted_trips_report_script';
		$this->load->view('template', $template);
	}

	public function ajax_converted_trips_report()
	{
		$param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
		$param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
		$param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
		$param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
		$param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';

		$param['guest_name'] = (isset($_REQUEST['guest_name'])) ? $_REQUEST['guest_name'] : '';
		if ($this->currentusertype != 'A') {
			$param['staff_id'] = $this->currentuserid;
		} else {
			$param['staff_id'] = (isset($_REQUEST['staff_id'])) ? $_REQUEST['staff_id'] : '';
		}

		$travels_start_date = (isset($_REQUEST['start_date'])) ? $_REQUEST['start_date'] : '';
		$travels_end_date   = (isset($_REQUEST['end_date'])) ? $_REQUEST['end_date'] : '';

		if ($travels_start_date) {
			$travels_start_date = str_replace('/', '-', $travels_start_date);
			$param['start_date'] = date('Y-m-d', strtotime($travels_start_date));
		}
		if ($travels_end_date) {
			$travels_end_date = str_replace('/', '-', $travels_end_date);
			$param['end_date'] = date('Y-m-d', strtotime($travels_end_date));
		}

		$param['date_type'] = (isset($_REQUEST['date_type'])) ? $_REQUEST['date_type'] : 'arrival';

		$data = $this->Quotation_model->getConvertedTripsReport($param);
		echo json_encode($data);
	}

	public function quotation_report()
	{
		if (!has_permission('QUOTATION_REPORT')) {
			show_error('Permission denied: Quotation Report', 403);
			return;
		}
		$template['staff']            = $this->Quotation_model->fetch_staff_users();
		$template['current_user_type'] = $this->currentusertype;
		$template['current_user_id']   = $this->currentuserid;
		$template['body']   = 'Quotation/quotation_report';
		$template['script'] = 'Quotation/quotation_report_script';
		$this->load->view('template', $template);
	}

	public function ajax_quotation_report()
	{
		$param['draw']        = isset($_REQUEST['draw'])                  ? $_REQUEST['draw']                  : '';
		$param['length']      = isset($_REQUEST['length'])                ? $_REQUEST['length']                : '10';
		$param['start']       = isset($_REQUEST['start'])                 ? $_REQUEST['start']                 : '0';
		$param['order']       = isset($_REQUEST['order'][0]['column'])    ? $_REQUEST['order'][0]['column']    : '';
		$param['dir']         = isset($_REQUEST['order'][0]['dir'])       ? $_REQUEST['order'][0]['dir']       : '';
		$param['searchValue'] = isset($_REQUEST['search']['value'])       ? $_REQUEST['search']['value']       : '';

		$param['guest_name']  = isset($_REQUEST['guest_name'])  ? $_REQUEST['guest_name']  : '';
		$param['quotation_status'] = isset($_REQUEST['quotation_status']) ? $_REQUEST['quotation_status'] : '';

		if ($this->currentusertype != 'A') {
			$param['staff_id'] = $this->currentuserid;
		} else {
			$param['staff_id'] = isset($_REQUEST['staff_id']) ? $_REQUEST['staff_id'] : '';
		}

		$start_date = isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : '';
		$end_date   = isset($_REQUEST['end_date'])   ? $_REQUEST['end_date']   : '';

		if ($start_date) {
			$start_date = str_replace('/', '-', $start_date);
			$param['start_date'] = date('Y-m-d', strtotime($start_date));
		}
		if ($end_date) {
			$end_date = str_replace('/', '-', $end_date);
			$param['end_date'] = date('Y-m-d', strtotime($end_date));
		}

		$data = $this->Quotation_model->getQuotationReport($param);
		echo json_encode($data);
	}

	public function transporter_report()
	{
		if (!has_permission('TRANSPORTER_REPORT')) {
			redirect('/login');
		}

		$template['current_user_type'] = $this->currentusertype;
		$template['current_user_id']   = $this->currentuserid;
		$template['body']   = 'Quotation/transporter_report';
		$template['script'] = 'Quotation/transporter_report_script';
		$this->load->view('template', $template);
	}

	public function ajax_get_driver_not_assigned()
	{
		if (!has_permission('TRANSPORTER_REPORT')) {
			echo json_encode(array('status' => false, 'message' => 'Permission denied'));
			return;
		}

		$param['draw']        = isset($_REQUEST['draw'])                  ? $_REQUEST['draw']                  : '';
		$param['length']      = isset($_REQUEST['length'])                ? $_REQUEST['length']                : '10';
		$param['start']       = isset($_REQUEST['start'])                 ? $_REQUEST['start']                 : '0';
		$param['order']       = isset($_REQUEST['order'][0]['column'])    ? $_REQUEST['order'][0]['column']    : '';
		$param['dir']         = isset($_REQUEST['order'][0]['dir'])       ? $_REQUEST['order'][0]['dir']       : '';
		$param['searchValue'] = isset($_REQUEST['search']['value'])       ? $_REQUEST['search']['value']       : '';

		if ($this->currentusertype != 'A') {
			$param['transporter_id_fk'] = $this->currentuserid;
		}

		$status_filter = isset($_REQUEST['status_filter']) ? $_REQUEST['status_filter'] : '';
		if ($status_filter) {
			$param['status_filter'] = $status_filter;
		}

		$start_date = isset($_REQUEST['start_date']) ? $_REQUEST['start_date'] : '';
		$end_date   = isset($_REQUEST['end_date'])   ? $_REQUEST['end_date']   : '';

		if ($start_date) {
			$start_date = str_replace('/', '-', $start_date);
			$param['start_date'] = date('Y-m-d', strtotime($start_date));
		}
		if ($end_date) {
			$end_date = str_replace('/', '-', $end_date);
			$param['end_date'] = date('Y-m-d', strtotime($end_date));
		}

		$data = $this->Quotation_model->getDriverNotAssignedReport($param);
		echo json_encode($data);
	}

	public function ajax_update_driver_details()
	{
		if (!has_permission('TRANSPORTER_REPORT')) {
			echo json_encode(array('status' => false, 'message' => 'Permission denied'));
			return;
		}

		$allocation_id   = (int)$this->input->post('allocation_id');
		$quotation_id    = (int)$this->input->post('quotation_id');
		$driver_name     = trim($this->input->post('driver_name'));
		$driver_mobile   = trim($this->input->post('driver_mobile'));
		$cab_number      = trim($this->input->post('cab_number'));

		if ($allocation_id <= 0 || $quotation_id <= 0) {
			echo json_encode(array('status' => false, 'message' => 'Invalid allocation'));
			return;
		}

		if ($driver_name == '') {
			echo json_encode(array('status' => false, 'message' => 'Driver name is required'));
			return;
		}

		if ($driver_mobile == '') {
			echo json_encode(array('status' => false, 'message' => 'Driver mobile is required'));
			return;
		}

		if ($cab_number == '') {
			echo json_encode(array('status' => false, 'message' => 'Cab number is required'));
			return;
		}

		if ($this->currentusertype != 'A') {
			$allocation = $this->db->where('id', $allocation_id)
								   ->where('transporter_id_fk', $this->currentuserid)
								   ->get('quotation_transport_allocation')
								   ->row();
			if (!$allocation) {
				echo json_encode(array('status' => false, 'message' => 'Allocation not found or access denied'));
				return;
			}
		}

		$update_data = array(
			'driver_name'   => $driver_name,
			'driver_mobile' => $driver_mobile,
			'cab_number'    => $cab_number
		);
		$this->Quotation_model->updateTransportAllocation(array('id' => $allocation_id), $update_data);

		$this->db->where('quotation_id', $quotation_id);
		$this->db->update('quotation', array('quotation_current_status' => 7));

		$quotation = $this->db->where('quotation_id', $quotation_id)
							  ->get('quotation')
							  ->row();
		if ($quotation && !empty($quotation->leads_id_fk)) {
			$this->db->where('leads_id', $quotation->leads_id_fk);
			$this->db->update('leads', array('lead_current_status' => 3));
		}

		echo json_encode(array('status' => true, 'message' => 'Driver details updated. Status set to Ready to Trip.'));
	}

	public function ajax_get_transporter_guest_details()
	{
		if (!has_permission('TRANSPORTER_REPORT')) {
			echo json_encode(array('status' => false, 'message' => 'Permission denied'));
			return;
		}

		$quotation_id = (int)$this->input->post('quotation_id');
		if (!$quotation_id) {
			echo json_encode(array('status' => false, 'message' => 'Quotation ID required'));
			return;
		}

		if ($this->currentusertype != 'A') {
			$allocation = $this->db->where('quotation_id_fk', $quotation_id)
								   ->where('transporter_id_fk', $this->currentuserid)
								   ->get('quotation_transport_allocation')
								   ->row();
			if (!$allocation) {
				echo json_encode(array('status' => false, 'message' => 'Access denied'));
				return;
			}
		}

		$data = $this->Quotation_model->get_transporter_guest_details($quotation_id);
		if (empty($data['main'])) {
			echo json_encode(array('status' => false, 'message' => 'Guest details not found'));
			return;
		}

		echo json_encode(array('status' => true, 'data' => $data));
	}

	public function ajax_get_quotation_basic_info()
	{
		$quotation_id = (int)$this->input->post('quotation_id');
		if (!$quotation_id) {
			echo json_encode(array('status' => false, 'message' => 'Quotation ID required'));
			return;
		}

		$row = $this->db
			->select('q.quotation_id, q.quotation_number, q.quotation_current_status, l.guest_name, l.whats_number')
			->from('quotation q')
			->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
			->where('q.quotation_id', $quotation_id)
			->get()
			->row_array();

		if (!$row) {
			echo json_encode(array('status' => false, 'message' => 'Quotation not found'));
			return;
		}

		echo json_encode(array('status' => true, 'data' => $row));
	}

	public function ajax_edit_hub($id)
	{
		$quotation = $this->Quotation_model->get_by_id($id);

		if (!$quotation) {
			echo json_encode(array(
				'status' => false,
				'message' => 'Quotation not found'
			));
			return;
		}

		// Get confirmed option ID from quotation_confirmation
		$confirmed = $this->db
			->select('option_id_fk')
			->from('quotation_confirmation')
			->where('quotation_id_fk', (int)$id)
			->where('property_confirmation_status', 1)
			->group_by('option_id_fk')
			->order_by('id', 'ASC')
			->get()
			->row_array();

		if (!$confirmed || empty($confirmed['option_id_fk'])) {
			echo json_encode(array(
				'status' => false,
				'message' => 'No confirmed option found for this quotation'
			));
			return;
		}

		$confirmed_option_id = (int)$confirmed['option_id_fk'];

		// Fetch only the confirmed option
		$options = $this->Quotation_model->get_full_quotation_options($id);
		$confirmed_option = null;
		foreach ($options as $opt) {
			if ((int)$opt['quotation_options_id'] === $confirmed_option_id) {
				$confirmed_option = $opt;
				break;
			}
		}

		// Fetch property inclusions and special requirements
		$property_inclusions = $this->Quotation_model->get_quotation_property_inclusions($id);
		$special_requirements = $this->Quotation_model->get_quotation_special_requirements($id);

		// Fetch lead travel dates for reschedule
		$lead = $this->db
			->select('l.start_date, l.end_date, l.duration')
			->from('leads l')
			->join('quotation q', 'q.leads_id_fk = l.leads_id', 'inner')
			->where('q.quotation_id', (int)$id)
			->limit(1)
			->get()
			->row_array();

		echo json_encode(array(
			'status' => true,
			'quotation' => $quotation,
			'confirmed_option' => $confirmed_option,
			'property_inclusions' => $property_inclusions,
			'special_requirements' => $special_requirements,
			'lead' => $lead
		));
	}

	public function ajax_reschedule_travel_date()
	{
		$quotation_id = (int)$this->input->post('quotation_id');
		$new_start_date = $this->input->post('new_start_date');

		if (!$quotation_id || !$new_start_date) {
			echo json_encode(array(
				'status' => false,
				'message' => 'Quotation ID and new start date are required'
			));
			return;
		}

		$new_start_date = str_replace('/', '-', $new_start_date);
		$new_start = date('Y-m-d', strtotime($new_start_date));

		// Get lead info
		$lead = $this->db
			->select('l.leads_id, l.start_date, l.end_date, l.duration')
			->from('leads l')
			->join('quotation q', 'q.leads_id_fk = l.leads_id', 'inner')
			->where('q.quotation_id', $quotation_id)
			->limit(1)
			->get()
			->row_array();

		if (!$lead) {
			echo json_encode(array(
				'status' => false,
				'message' => 'Lead not found for this quotation'
			));
			return;
		}

		$lead_id = (int)$lead['leads_id'];
		$old_start = date('Y-m-d', strtotime($lead['start_date']));
		$duration = (int)$lead['duration'];

		if (!$duration) {
			// Calculate duration from dates
			$old_start_dt = new DateTime($old_start);
			$old_end_dt = new DateTime(date('Y-m-d', strtotime($lead['end_date'])));
			$diff = $old_start_dt->diff($old_end_dt);
			$duration = (int)$diff->days;
		}

		// Calculate new end date = new start + duration days
		$new_start_dt = new DateTime($new_start);
		$new_end_dt = clone $new_start_dt;
		$new_end_dt->modify('+' . $duration . ' days');
		$new_end = $new_end_dt->format('Y-m-d');

		// Calculate date offset in days
		$old_start_dt = new DateTime($old_start);
		$offset_diff = $new_start_dt->diff($old_start_dt);
		$offset_days = (int)$offset_diff->days;
		if ($offset_diff->invert) {
			$offset_days = -$offset_days; // new start is after old start
		} else {
			$offset_days = $offset_days; // new start is before old start
		}

		// Actually: if new_start > old_start, offset is positive (shift forward)
		// If new_start < old_start, offset is negative (shift backward)
		$offset_seconds = strtotime($new_start) - strtotime($old_start);
		$offset_days = (int)round($offset_seconds / 86400);

		$this->db->trans_begin();

		try {
			// Update leads start_date and end_date
			$this->db->where('leads_id', $lead_id);
			$this->db->update('leads', array(
				'start_date' => $new_start,
				'end_date' => $new_end
			));

			// Shift all accommodation_plan dates for this lead
			$acc_plans = $this->db
				->select('accommodation_plan_id, accommodation_date, accommodation_day_name')
				->from('accommodation_plan')
				->where('lead_id_fk', $lead_id)
				->where('accommodation_plan_status', 1)
				->get()
				->result_array();

			foreach ($acc_plans as $ap) {
				$ap_id = (int)$ap['accommodation_plan_id'];
				$old_acc_date = $ap['accommodation_date'];

				if ($old_acc_date && $old_acc_date !== '0000-00-00') {
					$new_acc_date = date('Y-m-d', strtotime($old_acc_date . ' +' . $offset_days . ' days'));
					$new_acc_day = date('l', strtotime($new_acc_date));

					$this->db->where('accommodation_plan_id', $ap_id);
					$this->db->update('accommodation_plan', array(
						'accommodation_date' => $new_acc_date,
						'accommodation_day_name' => $new_acc_day
					));
				}
			}

			$this->db->trans_commit();

			echo json_encode(array(
				'status' => true,
				'message' => 'Travel dates rescheduled successfully',
				'new_start_date' => $new_start,
				'new_end_date' => $new_end,
				'offset_days' => $offset_days
			));

		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(array(
				'status' => false,
				'message' => $e->getMessage()
			));
		}
	}

	public function ajax_update_hub()
	{
		$quotation_id = (int)$this->input->post('id');

		if (!$quotation_id) {
			echo json_encode(array(
				'status' => false,
				'message' => 'Quotation ID missing'
			));
			return;
		}

		$payload = json_decode($this->input->post('data'), true);

		$this->load->helper('date');
		if (function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date1 = date('Y-m-d h:i:s a', time());

		$currentuserid = $this->session->userdata('user_id');

		$this->db->trans_begin();

		try {
			// Update quotation-level fields
			$quotationData = array(
				'quotation_remarks' => $this->input->post('quotation_remarks'),
				'total_inclusion_amount' => $this->input->post('total_inclusion_amount'),
				'total_special_requirment_amount' => $this->input->post('total_special_requirment_amount'),
				'quotation_updatedby_user_id' => $currentuserid,
				'quotation_updated_at' => $date1,
			);

			$this->db->where('quotation_id', $quotation_id);
			$this->db->update('quotation', $quotationData);

			/* ================= DELETE ONLY CONFIRMED OPTION'S OLD DATA ================= */

			// Get confirmed option ID from quotation_confirmation
			$confirmed = $this->db
				->select('option_id_fk')
				->from('quotation_confirmation')
				->where('quotation_id_fk', $quotation_id)
				->where('property_confirmation_status', 1)
				->group_by('option_id_fk')
				->order_by('id', 'ASC')
				->get()
				->row_array();

			if ($confirmed && !empty($confirmed['option_id_fk'])) {
				$confirmed_option_id = (int)$confirmed['option_id_fk'];

				// Get old days for this option
				$oldDays = $this->db
					->select('quotation_properties_days_id')
					->from($this->quotation_properties_days)
					->where('quotation_id_fk', $quotation_id)
					->where('quotation_options_id_fk', $confirmed_option_id)
					->where('quotation_properties_days_status', 1)
					->get()
					->result_array();

				$oldDayIds = array();
				foreach ($oldDays as $d) {
					$oldDayIds[] = (int)$d['quotation_properties_days_id'];
				}

				// Get old properties for those days
				$oldPropertyIds = array();
				if (!empty($oldDayIds)) {
					$oldProperties = $this->db
						->select('quotation_properties_id')
						->from($this->quotation_properties)
						->where_in('quotation_properties_days_id_fk', $oldDayIds)
						->where('quotation_properties_status', 1)
						->get()
						->result_array();

					foreach ($oldProperties as $p) {
						$oldPropertyIds[] = (int)$p['quotation_properties_id'];
					}
				}

				// Disable old rooms
				if (!empty($oldPropertyIds)) {
					$this->db->where_in('quotation_properties_id_fk', $oldPropertyIds);
					$this->db->update($this->quotation_properties_rooms, array(
						'quotation_properties_rooms_status' => 0
					));
				}

				// Disable old properties
				if (!empty($oldDayIds)) {
					$this->db->where_in('quotation_properties_days_id_fk', $oldDayIds);
					$this->db->update($this->quotation_properties, array(
						'quotation_properties_status' => 0
					));
				}

				// Disable old days
				if (!empty($oldDayIds)) {
					$this->db->where_in('quotation_properties_days_id', $oldDayIds);
					$this->db->update($this->quotation_properties_days, array(
						'quotation_properties_days_status' => 0
					));
				}

				// Disable old confirmed option
				$this->db->where('quotation_options_id', $confirmed_option_id);
				$this->db->update($this->quotation_options, array(
					'quotation_options_status' => 0
				));
			}

			/* ================= INSERT UPDATED CONFIRMED OPTION ================= */

			if (!empty($payload['options']) && is_array($payload['options'])) {

				foreach ($payload['options'] as $option) {

					$option_id = $this->General_model->add_returnID(
						$this->quotation_options,
						array(
							'quotation_id_fk' => $quotation_id,
							'packages_properties_common_id_fk' => isset($option['packages_properties_common_id_fk']) ? $option['packages_properties_common_id_fk'] : 0,
							'quotation_options_title' => isset($option['title']) ? $option['title'] : '',
							'quotation_options_cab_amount' => isset($option['cab_amount']) ? $option['cab_amount'] : 0,
							'quotation_options_design_type' => isset($option['quotation_options_design_type']) ? $option['quotation_options_design_type'] : '',
							'quotation_options_vehicle_id_fk' => isset($option['quotation_options_vehicle_id_fk']) ? $option['quotation_options_vehicle_id_fk'] : 0,
							'quotation_options_room_category_display' => isset($option['quotation_options_room_category_display']) ? $option['quotation_options_room_category_display'] : 0,
							'quotation_options_meal_plan_display' => isset($option['quotation_options_meal_plan_display']) ? $option['quotation_options_meal_plan_display'] : 0,
							'quotation_options_vehicle_display' => isset($option['quotation_options_vehicle_display']) ? $option['quotation_options_vehicle_display'] : 0,
							'quotation_options_total_cost' => isset($option['quotation_options_total_cost']) ? $option['quotation_options_total_cost'] : 0,
							'quotation_options_margin_type' => isset($option['quotation_options_margin_type']) ? $option['quotation_options_margin_type'] : 'amount',
							'quotation_options_margin_value' => isset($option['quotation_options_margin_value']) ? $option['quotation_options_margin_value'] : 0,
							'quotation_options_total_quote_rate' => isset($option['quotation_options_total_quote_rate']) ? $option['quotation_options_total_quote_rate'] : 0,
							'quotation_options_amount_type' => isset($option['quotation_options_amount_type']) ? $option['quotation_options_amount_type'] : 'net',
							'quotation_options_per_amount'  => isset($option['quotation_options_per_amount']) ? (float)$option['quotation_options_per_amount'] : 0,
							'quotation_options_status' => 1
						)
					);

					if (!$option_id) {
						throw new Exception('Option insert failed');
					}

					// Update quotation_confirmation to point to new option ID
					if (isset($confirmed_option_id) && $confirmed_option_id) {
						$this->db->where('option_id_fk', $confirmed_option_id);
						$this->db->where('quotation_id_fk', $quotation_id);
						$this->db->update('quotation_confirmation', array(
							'option_id_fk' => (int)$option_id
						));
					}

					if (!empty($option['days']) && is_array($option['days'])) {

						foreach ($option['days'] as $day) {

							$day_id = $this->General_model->add_returnID(
								$this->quotation_properties_days,
								array(
									'quotation_id_fk' => $quotation_id,
									'quotation_options_id_fk' => $option_id,
									'packages_properties_days_id_fk' => isset($day['packages_properties_days_id_fk']) ? $day['packages_properties_days_id_fk'] : 0,
									'quotation_itinerary_days_id_fk' => $this->Quotation_model->get_quotation_itinerary_day_id_by_package_day($quotation_id, $this->Quotation_model->get_itinerary_days_id_fk_by_properties_day(isset($day['packages_properties_days_id_fk']) ? (int)$day['packages_properties_days_id_fk'] : 0)),
									'quotation_properties_days_day' => isset($day['day']) ? $day['day'] : '',
									'quotation_properties_days_destination_id_fk' => isset($day['destination_id']) ? $day['destination_id'] : 0,
									'accommodation_plan_id_fk' => isset($day['accommodation_plan_id_fk']) ? (int)$day['accommodation_plan_id_fk'] : 0,
									'quotation_properties_days_status' => 1
								)
							);

							if (!$day_id) {
								throw new Exception('Day insert failed');
							}

							if (!empty($day['properties']) && is_array($day['properties'])) {

								foreach ($day['properties'] as $property) {

									$property_id = $this->General_model->add_returnID(
										$this->quotation_properties,
										array(
											'quotation_properties_days_id_fk' => $day_id,
											'packages_properties_id_fk' => isset($property['packages_properties_id_fk']) ? $property['packages_properties_id_fk'] : 0,
											'properties_id_fk' => isset($property['properties_id_fk']) ? $property['properties_id_fk'] : 0,
											'quotation_properties_status' => 1
										)
									);

									if (!$property_id) {
										throw new Exception('Property insert failed');
									}

									if (!empty($property['rooms']) && is_array($property['rooms'])) {

										foreach ($property['rooms'] as $room) {

											$quotation_properties_room_id = $this->General_model->add_returnID(
												$this->quotation_properties_rooms,
												array(
													'quotation_properties_id_fk' => $property_id,
													'packages_properties_rooms_id_fk' => isset($room['packages_properties_rooms_id_fk']) ? $room['packages_properties_rooms_id_fk'] : 0,
													'quotation_properties_rooms_id_fk' => isset($room['quotation_properties_rooms_id_fk']) ? $room['quotation_properties_rooms_id_fk'] : 0,
													'total_room_cost' => isset($room['total_room_cost']) ? (float)$room['total_room_cost'] : 0,
													'quotation_properties_rooms_status' => 1
												)
											);

											if (!$quotation_properties_room_id) {
												throw new Exception('Room insert failed');
											}
										}
									}
								}
							}
						}
					}
				}
			}

			/* ================= DISABLE OLD INCLUSIONS & SPECIAL REQUIREMENTS ================= */

			$this->db->where('quotation_id_fk', $quotation_id);
			$this->db->update('quotation_property_inclusions', array(
				'quotation_property_inclusions_status' => 0
			));

			$this->db->where('quotation_id_fk', $quotation_id);
			$this->db->update('quotation_special_requirements', array(
				'quotation_special_requirements_status' => 0
			));

			/* ================= INSERT NEW INCLUSIONS ================= */

			if (!empty($payload['inclusions']) && is_array($payload['inclusions'])) {

				foreach ($payload['inclusions'] as $inc) {

					$parts = explode('|', $inc['dayKey']);

					$property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;

					$stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;

					$acc_date        = isset($parts[2]) ? $parts[2] : null;

					if (!$property_day_id || !$stay_dest_id) {
						continue;
					}

					$package_option_id_fk = isset($inc['package_option_id_fk']) ? (int)$inc['package_option_id_fk'] : 0;

					$ok = $this->Quotation_model->add_property_inclusion(array(
						'quotation_id_fk' => $quotation_id,
						'quotation_options_id_fk' => isset($option_id) ? (int)$option_id : 0,
						'package_option_id_fk' => $package_option_id_fk,
						'packages_properties_days_id_fk' => $property_day_id,
						'stay_destination_id_fk' => $stay_dest_id,
						'accommodation_date' => $acc_date,
						'inclusion_property_id_fk' => isset($inc['property_id_fk']) ? (int)$inc['property_id_fk'] : 0,
						'property_inclusions_id_fk' => isset($inc['property_inclusions_id_fk']) ? (int)$inc['property_inclusions_id_fk'] : 0,
						'inclusion_name' => isset($inc['name']) ? $inc['name'] : '',
						'inclusion_amount' => isset($inc['amount']) ? $inc['amount'] : 0,
						'quotation_property_inclusions_status' => 1
					));

					if (!$ok) {
						throw new Exception('Inclusion insert failed');
					}
				}
			}

			/* ================= INSERT NEW SPECIAL REQUIREMENTS ================= */

			if (!empty($payload['special_requirements']) && is_array($payload['special_requirements'])) {

				foreach ($payload['special_requirements'] as $sr) {

					$parts = explode('|', $sr['dayKey']);

					$property_day_id = isset($parts[0]) ? (int)$parts[0] : 0;

					$stay_dest_id    = isset($parts[1]) ? (int)$parts[1] : 0;

					$acc_date        = isset($parts[2]) ? $parts[2] : null;

					if (!$property_day_id || !$stay_dest_id) {
						continue;
					}

					$ok = $this->Quotation_model->add_special_requirement(array(
						'quotation_id_fk' => $quotation_id,
						'packages_properties_days_id_fk' => $property_day_id,
						'stay_destination_id_fk' => $stay_dest_id,
						'accommodation_date' => $acc_date,
						'quotation_special_requirements_name' => isset($sr['quotation_special_requirements_name']) ? $sr['quotation_special_requirements_name'] : '',
						'quotation_special_requirements_cost' => isset($sr['cost']) ? $sr['cost'] : 0,
						'quotation_special_requirements_status' => 1
					));

					if (!$ok) {
						throw new Exception('Special requirement insert failed');
					}
				}
			}

			$this->db->trans_commit();

			echo json_encode(array(
				'status' => true,
				'message' => 'Quotation updated successfully'
			));

		} catch (Exception $e) {
			$this->db->trans_rollback();
			echo json_encode(array(
				'status' => false,
				'message' => $e->getMessage()
			));
		}
	}
}



?>