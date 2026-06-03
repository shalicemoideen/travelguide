<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Client_confirmation extends MY_Controller {
	public $table = 'client_confirmation';
	public $page = 'Client_confirmation';

	public function __construct()
	{
		parent::__construct();
		$this->load->database();
		$this->load->model('General_model');
		$this->load->model('Client_confirmation_model');
		$this->load->model('Quotation_model');
	}

	// Public view for client to confirm quotation
	public function view($token)
	{
		$confirmation = $this->Client_confirmation_model->get_by_token($token);

		if (!$confirmation) {
			show_404();
		}

		// Get quotation details
		$quotation = $this->Quotation_model->get_quotation($confirmation->quotation_id_fk);

		if (!$quotation) {
			show_404();
		}

		// Get quotation options
		$options = $this->Client_confirmation_model->get_quotation_options($confirmation->quotation_id_fk);

		// Get properties for each option
		foreach ($options as &$option) {
			$option->days = $this->Client_confirmation_model->get_quotation_properties_for_confirmation(
				$confirmation->quotation_id_fk,
				$option->quotation_options_id
			);
		}

		$data['confirmation'] = $confirmation;
		$data['quotation'] = $quotation;
		$data['options'] = $options;

		$this->load->view('Client_confirmation/client_view', $data);
	}

	// Process client confirmation
	public function submit_confirmation()
	{
		$token = $this->input->post('token');
		$confirmation = $this->Client_confirmation_model->get_by_token($token);

		if (!$confirmation) {
			echo json_encode(array('status' => false, 'message' => 'Invalid or expired confirmation link'));
			return;
		}

		// Get selected option
		$selected_option_id = $this->input->post('selected_option_id');

		if (!$selected_option_id) {
			echo json_encode(array('status' => false, 'message' => 'Please select an option'));
			return;
		}

		// Get selected properties for each day
		$selected_properties = $this->input->post('selected_properties');

		if (empty($selected_properties)) {
			echo json_encode(array('status' => false, 'message' => 'Please select properties for each day'));
			return;
		}

		// Get selected rooms for each property
		$selected_rooms = $this->input->post('selected_rooms');

		// Save client details
		$update_data = array(
			'confirmation_status' => 'confirmed',
			'confirmation_date' => date('Y-m-d H:i:s'),
			'client_name' => $this->input->post('client_name'),
			'client_email' => $this->input->post('client_email'),
			'client_phone' => $this->input->post('client_phone'),
			'client_comments' => $this->input->post('client_comments')
		);

		$this->Client_confirmation_model->update_confirmation($confirmation->client_confirmation_id, $update_data);

		// Save day-wise property confirmations
		$days_data = array();
		$rooms_data = array();

		foreach ($selected_properties as $day_key => $property_id) {
			// Extract day number from key (format: day_1, day_2, etc.)
			$day_number = str_replace('day_', '', $day_key);

			// Get quotation_properties_days_id for this day
			$day_info = $this->db
				->select('quotation_properties_days_id')
				->from('quotation_properties_days')
				->where('quotation_id_fk', $confirmation->quotation_id_fk)
				->where('quotation_options_id_fk', $selected_option_id)
				->where('quotation_properties_days_day', 'Day ' . $day_number)
				->where('quotation_properties_days_status', 1)
				->get()
				->row();

			if ($day_info) {
				$days_data[] = array(
					'client_confirmation_id_fk' => $confirmation->client_confirmation_id,
					'quotation_properties_days_id_fk' => $day_info->quotation_properties_days_id,
					'confirmed_quotation_properties_id_fk' => $property_id,
					'day_number' => $day_number
				);

				// Save rooms for this property if selected
				if (isset($selected_rooms[$property_id]) && !empty($selected_rooms[$property_id])) {
					foreach ($selected_rooms[$property_id] as $room_id) {
						$rooms_data[] = array(
							'client_confirmation_days_id_fk' => 0, // Will be updated after insert
							'confirmed_quotation_properties_rooms_id_fk' => $room_id,
							'room_category_name' => '' // Will be fetched from DB
						);
					}
				}
			}
		}

		// Insert days and get their IDs
		if (!empty($days_data)) {
			$this->Client_confirmation_model->save_days($days_data);

			// Get the inserted days with their IDs
			$inserted_days = $this->db
				->select('client_confirmation_days_id, confirmed_quotation_properties_id_fk')
				->from('client_confirmation_days')
				->where('client_confirmation_id_fk', $confirmation->client_confirmation_id)
				->get()
				->result();

			// Update rooms with correct day IDs
			$property_to_day_map = array();
			foreach ($inserted_days as $day) {
				$property_to_day_map[$day->confirmed_quotation_properties_id_fk] = $day->client_confirmation_days_id;
			}

			foreach ($rooms_data as &$room) {
				$property_id_for_room = $this->db
					->select('quotation_properties_id_fk')
					->from('quotation_properties_rooms')
					->where('quotation_properties_rooms_id', $room['confirmed_quotation_properties_rooms_id_fk'])
					->get()
					->row();

				if ($property_id_for_room && isset($property_to_day_map[$property_id_for_room->quotation_properties_id_fk])) {
					$room['client_confirmation_days_id_fk'] = $property_to_day_map[$property_id_for_room->quotation_properties_id_fk];

					// Get room category name
					$room_info = $this->db
						->select('prc.properties_room_category_name')
						->from('quotation_properties_rooms qpr')
						->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')
						->where('qpr.quotation_properties_rooms_id', $room['confirmed_quotation_properties_rooms_id_fk'])
						->get()
						->row();

					if ($room_info) {
						$room['room_category_name'] = $room_info->properties_room_category_name;
					}
				}
			}

			// Insert rooms
			if (!empty($rooms_data)) {
				$this->Client_confirmation_model->save_rooms($rooms_data);
			}
		}

		echo json_encode(array('status' => true, 'message' => 'Confirmation submitted successfully'));
	}

	// Admin view to see all confirmations
	public function index()
	{
		if (!$this->is_logged_in()) {
			redirect('/login');
		}

		$template['confirmations'] = $this->Client_confirmation_model->get_all_confirmations();
		$template['body'] = 'Client_confirmation/admin_list';
		$template['script'] = 'Client_confirmation/admin_script';
		$this->load->view('template', $template);
	}

	// Admin view to see confirmation details
	public function view_confirmation($confirmation_id)
	{
		if (!$this->is_logged_in()) {
			redirect('/login');
		}

		$confirmation = $this->Client_confirmation_model->get_confirmation_with_details($confirmation_id);

		if (!$confirmation) {
			show_404();
		}

		$template['confirmation'] = $confirmation;
		$template['body'] = 'Client_confirmation/admin_view';
		$this->load->view('template', $template);
	}

	// Generate confirmation link for a quotation
	public function generate_confirmation($quotation_id)
	{
		if (!$this->is_logged_in()) {
			redirect('/login');
		}

		// Check if confirmation already exists
		$existing = $this->Client_confirmation_model->get_by_quotation_id($quotation_id);

		if ($existing) {
			echo json_encode(array('status' => false, 'message' => 'Confirmation already generated for this quotation'));
			return;
		}

		// Generate unique token
		$token = md5(uniqid($quotation_id . time(), true));

		// Get quotation details
		$quotation = $this->Quotation_model->get_quotation($quotation_id);

		if (!$quotation) {
			echo json_encode(array('status' => false, 'message' => 'Quotation not found'));
			return;
		}

		// Create confirmation record
		$data = array(
			'quotation_id_fk' => $quotation_id,
			'confirmation_token' => $token,
			'confirmation_status' => 'pending',
			'client_name' => $quotation->guest_name,
			'created_date' => date('Y-m-d H:i:s'),
			'created_by' => $this->session->userdata('user_id')
		);

		$confirmation_id = $this->Client_confirmation_model->save($data);

		if ($confirmation_id) {
			$confirmation_link = base_url('index.php/Client_confirmation/view/' . $token);
			echo json_encode(array(
				'status' => true,
				'message' => 'Confirmation link generated successfully',
				'confirmation_link' => $confirmation_link
			));
		} else {
			echo json_encode(array('status' => false, 'message' => 'Failed to generate confirmation link'));
		}
	}
}
