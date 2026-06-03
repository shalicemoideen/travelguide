<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Client_confirmation_model extends CI_Model{
	var $table = 'client_confirmation';
	var $table_days = 'client_confirmation_days';
	var $table_rooms = 'client_confirmation_rooms';

	public function __construct()
    {
        parent::__construct();
    }

	public function get_by_token($token)
	{
		$this->db->where('confirmation_token', $token);
		$this->db->where('confirmation_status', 'pending');
		$this->db->where('client_confirmation_status', 1);
		$query = $this->db->get($this->table);
		return $query->row();
	}

	public function get_by_quotation_id($quotation_id)
	{
		$this->db->where('quotation_id_fk', $quotation_id);
		$this->db->where('client_confirmation_status', 1);
		$this->db->order_by('client_confirmation_id', 'DESC');
		$query = $this->db->get($this->table);
		return $query->result();
	}

	public function get_confirmation_with_details($confirmation_id)
	{
		$this->db->where('client_confirmation_id', $confirmation_id);
		$this->db->where('client_confirmation_status', 1);
		$query = $this->db->get($this->table);
		$confirmation = $query->row();

		if ($confirmation) {
			// Get days with confirmed properties
			$confirmation->days = $this->get_confirmation_days($confirmation_id);
		}

		return $confirmation;
	}

	public function get_confirmation_days($confirmation_id)
	{
		$this->db->select('ccd.*, qpd.quotation_properties_days_day, s.state_name as destination_name');
		$this->db->from($this->table_days . ' ccd');
		$this->db->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = ccd.quotation_properties_days_id_fk', 'left');
		$this->db->join('state s', 's.state_id = qpd.quotation_properties_days_destination_id_fk', 'left');
		$this->db->where('ccd.client_confirmation_id_fk', $confirmation_id);
		$this->db->where('ccd.client_confirmation_days_status', 1);
		$this->db->order_by('ccd.day_number', 'ASC');
		$query = $this->db->get();
		$days = $query->result();

		foreach ($days as &$day) {
			// Get confirmed rooms for this day/property
			$day->rooms = $this->get_confirmation_rooms($day->client_confirmation_days_id);
		}

		return $days;
	}

	public function get_confirmation_rooms($confirmation_days_id)
	{
		$this->db->select('ccr.*, prc.properties_room_category_name');
		$this->db->from($this->table_rooms . ' ccr');
		$this->db->join('quotation_properties_rooms qpr', 'qpr.quotation_properties_rooms_id = ccr.confirmed_quotation_properties_rooms_id_fk', 'left');
		$this->db->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left');
		$this->db->where('ccr.client_confirmation_days_id_fk', $confirmation_days_id);
		$this->db->where('ccr.client_confirmation_rooms_status', 1);
		$query = $this->db->get();
		return $query->result();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function save_days($data)
	{
		$this->db->insert_batch($this->table_days, $data);
	}

	public function save_rooms($data)
	{
		$this->db->insert_batch($this->table_rooms, $data);
	}

	public function update_confirmation($id, $data)
	{
		$this->db->where('client_confirmation_id', $id);
		return $this->db->update($this->table, $data);
	}

	public function get_quotation_properties_for_confirmation($quotation_id, $quotation_options_id)
	{
		// Get days
		$days = $this->db
			->select('qpd.*, s.state_name as destination_name')
			->from('quotation_properties_days qpd')
			->join('state s', 's.state_id = qpd.quotation_properties_days_destination_id_fk', 'left')
			->where('qpd.quotation_id_fk', $quotation_id)
			->where('qpd.quotation_options_id_fk', $quotation_options_id)
			->where('qpd.quotation_properties_days_status', 1)
			->order_by('qpd.quotation_properties_days_day', 'ASC')
			->get()
			->result();

		foreach ($days as &$day) {
			// Get properties for this day
			$day->properties = $this->db
				->select('qp.*, p.properties_name')
				->from('quotation_properties qp')
				->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')
				->where('qp.quotation_properties_days_id_fk', $day->quotation_properties_days_id)
				->where('qp.quotation_properties_status', 1)
				->order_by('qp.quotation_properties_id', 'ASC')
				->get()
				->result();

			foreach ($day->properties as &$property) {
				// Get rooms for this property
				$property->rooms = $this->db
					->select('qpr.*, prc.properties_room_category_name')
					->from('quotation_properties_rooms qpr')
					->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')
					->where('qpr.quotation_properties_id_fk', $property->quotation_properties_id)
					->where('qpr.quotation_properties_rooms_status', 1)
					->order_by('qpr.quotation_properties_rooms_id', 'ASC')
					->get()
					->result();
			}
		}

		return $days;
	}

	public function get_quotation_options($quotation_id)
	{
		$this->db->where('quotation_id_fk', $quotation_id);
		$this->db->where('quotation_options_status', 1);
		$query = $this->db->get('quotation_options');
		return $query->result();
	}

	public function get_all_confirmations()
	{
		$this->db->select('cc.*, q.quotation_number');
		$this->db->from($this->table . ' cc');
		$this->db->join('quotation q', 'q.quotation_id = cc.quotation_id_fk', 'left');
		$this->db->where('cc.client_confirmation_status', 1);
		$this->db->order_by('cc.client_confirmation_id', 'DESC');
		$query = $this->db->get();
		return $query->result();
	}
}
