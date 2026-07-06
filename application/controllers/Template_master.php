<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Template_master extends MY_Controller {
	public $table = 'template_master';
	public $activity = 'activity';
	public $page  = 'Template_master';

	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
			redirect('/login');
		}
		$this->currentuserid = $this->session->userdata('user_id');
		$this->currentusertype = $this->session->userdata('user_type');

		$this->load->model('General_model');
		$this->load->model('Template_master_model');
	}

	public function index()
	{
		$template['body'] = 'Template_master/list';
		$template['script'] = 'Template_master/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
		$param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10';
		$param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
		$param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
		$param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
		$param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';

		if (!has_permission('TEMPLATE_MASTER_VIEW')) {
			echo json_encode([
				"draw" => intval($this->input->post('draw')),
				"recordsTotal" => 0,
				"recordsFiltered" => 0,
				"data" => []
			]);
			return;
		}

		$data = $this->Template_master_model->getTemplateMasterTable($param);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function ajax_get_states()
	{
		$search = $this->input->get('q');
		$this->db->select('state_id as id, state_name as text');
		$this->db->from('state');
		$this->db->where('state_status', 1);
		if ($search) {
			$this->db->like('state_name', $search);
		}
		$this->db->order_by('state_name', 'ASC');
		$query = $this->db->get();
		echo json_encode(['results' => $query->result()]);
	}

	public function ajax_get_properties()
	{
		$state_id = $this->input->get('state_id');
		$search = $this->input->get('q');

		$this->db->select('properties_id as id, properties_name as text');
		$this->db->from('properties');
		$this->db->where('properties_status', 1);
		$this->db->where('properties_destination_id_fk', $state_id);
		if ($search) {
			$this->db->like('properties_name', $search);
		}
		$this->db->order_by('properties_name', 'ASC');
		$query = $this->db->get();
		echo json_encode(['results' => $query->result()]);
	}

	public function ajax_get_rooms()
	{
		$property_id = $this->input->get('property_id');
		$search = $this->input->get('q');

		$this->db->select('properties_room_category_id as id, properties_room_category_name as text');
		$this->db->from('properties_room_category');
		$this->db->where('properties_room_category_status', 1);
		$this->db->where('properties_id_fk', $property_id);
		if ($search) {
			$this->db->like('properties_room_category_name', $search);
		}
		$this->db->order_by('properties_room_category_name', 'ASC');
		$query = $this->db->get();
		echo json_encode(['results' => $query->result()]);
	}

	public function ajax_add()
	{
		$this->_validate();

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date1 = date('Y-m-d h:i:s a', time());

		$data = array(
			'template_master_category_name' => $this->input->post('template_master_category_name'),
			'template_master_design_type'   => $this->input->post('template_master_design_type'),
			'template_master_status'        => 1,
			'template_master_created_date'  => $date1
		);

		$master_id = $this->Template_master_model->save($data);
		$this->_save_nested_data($master_id, $this->input->post('destination'));
		echo json_encode(array("status" => TRUE));
	}

	public function ajax_edit($id)
	{
		$master = $this->Template_master_model->get_by_id($id);
		$destinations = $this->Template_master_model->get_destinations_by_master($id);
		$master->destinations = [];
		foreach ($destinations as $dest) {
			$d = [
				'template_master_destination_id' => $dest->template_master_destination_id,
				'state_id' => $dest->state_id_fk,
				'state_name' => $dest->state_name,
				'properties' => []
			];
			$props = $this->Template_master_model->get_properties_by_destination($dest->template_master_destination_id);
			foreach ($props as $prop) {
				$p = [
					'template_master_destination_property_id' => $prop->template_master_destination_property_id,
					'property_id' => $prop->properties_id_fk,
					'property_name' => $prop->properties_name,
					'rooms' => []
				];
				$rooms = $this->Template_master_model->get_rooms_by_property($prop->template_master_destination_property_id);
				foreach ($rooms as $room) {
					$p['rooms'][] = [
						'template_master_destination_property_room_id' => $room->template_master_destination_property_room_id,
						'properties_room_category_id' => $room->properties_room_category_id_fk,
						'properties_room_category_name' => $room->properties_room_category_name
					];
				}
				$d['properties'][] = $p;
			}
			$master->destinations[] = $d;
		}
		echo json_encode($master);
	}

	public function ajax_update()
	{
		$this->_validate();

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date1 = date('Y-m-d h:i:s a', time());

		$data = array(
			'template_master_category_name' => $this->input->post('template_master_category_name'),
			'template_master_design_type'   => $this->input->post('template_master_design_type'),
			'template_master_updated_date'  => $date1
		);

		$master_id = $this->input->post('id');
		$this->Template_master_model->update(array('template_master_id' => $master_id), $data);

		// Delete all existing nested data and re-insert
		$this->Template_master_model->delete_destinations_by_master($master_id);
		$this->_save_nested_data($master_id, $this->input->post('destination'));

		echo json_encode(array("status" => TRUE));
	}

	public function check_category_name(){
		$category_name = $this->input->post('value');
		$data = $this->Template_master_model->check_category_name($category_name);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function checkEdit_category_name(){
		$category_name = $this->input->post('value');
		$id = $this->input->post('id');
		$data = $this->Template_master_model->checkEdit_category_name($category_name, $id);
		$json_data = json_encode($data);
		echo $json_data;
	}

	public function delete()
	{
		$updateData = array('template_master_status' => 0);
		$this->Template_master_model->update(array('template_master_id' => $this->input->post('id')), $updateData);
		echo json_encode(array("status" => TRUE));
	}

	private function _save_nested_data($master_id, $destinations)
	{
		if (empty($destinations) || !is_array($destinations)) {
			return;
		}

		foreach ($destinations as $dest) {
			if (empty($dest['state_id'])) {
				continue;
			}
			$dest_data = array(
				'template_master_id_fk' => $master_id,
				'state_id_fk' => $dest['state_id'],
				'template_master_destination_status' => 1,
				'template_master_destination_created_date' => date('Y-m-d H:i:s')
			);
			$dest_id = $this->Template_master_model->save_destination($dest_data);

			if (!empty($dest['property']) && is_array($dest['property'])) {
				foreach ($dest['property'] as $prop) {
					if (empty($prop['property_id'])) {
						continue;
					}
					$prop_data = array(
						'template_master_destination_id_fk' => $dest_id,
						'properties_id_fk' => $prop['property_id'],
						'template_master_destination_property_status' => 1,
						'template_master_destination_property_created_date' => date('Y-m-d H:i:s')
					);
					$prop_id = $this->Template_master_model->save_property($prop_data);

					if (!empty($prop['rooms']) && is_array($prop['rooms'])) {
						foreach ($prop['rooms'] as $room_id) {
							if (empty($room_id)) {
								continue;
							}
							$room_data = array(
								'template_master_destination_property_id_fk' => $prop_id,
								'properties_room_category_id_fk' => $room_id,
								'template_master_destination_property_room_status' => 1,
								'template_master_destination_property_room_created_date' => date('Y-m-d H:i:s')
							);
							$this->Template_master_model->save_room($room_data);
						}
					}
				}
			}
		}
	}

	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if($this->input->post('template_master_category_name') == '')
		{
			$data['inputerror'][] = 'template_master_category_name';
			$data['error_string'][] = 'Category name is required';
			$data['status'] = FALSE;
		}

		if($this->input->post('template_master_design_type') == '')
		{
			$data['inputerror'][] = 'template_master_design_type';
			$data['error_string'][] = 'Design type is required';
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
