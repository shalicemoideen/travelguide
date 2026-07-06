<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Template_master_model extends CI_Model{
	var $table = 'template_master';

	public function __construct()
	{
		parent::__construct();
	}

	public function getTemplateMasterTable($param){
		$arOrder = array('','template_master_category_name','template_master_design_type');
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->group_start();
			$this->db->like('template_master_category_name', $searchValue);
			$this->db->or_like('template_master_design_type', $searchValue);
			$this->db->group_end();
		}
		$this->db->where("template_master_status",1);

		if($param['length']== -1) {
		} elseif ($param['start'] != 'false' and $param['length'] != 'false') {
			$this->db->limit($param['length'],$param['start']);
		}

		$this->db->select('*');
		$this->db->from('template_master');
		$this->db->order_by('template_master_id', 'DESC');
		$query = $this->db->get();

		$data['data'] = $query->result();
		$data['recordsTotal'] = $this->getTemplateMasterTotalCount($param);
		$data['recordsFiltered'] = $this->getTemplateMasterTotalCount($param);
		return $data;
	}

	public function getTemplateMasterTotalCount($param = NULL){
		$searchValue =($param['searchValue'])?$param['searchValue']:'';
		if($searchValue){
			$this->db->group_start();
			$this->db->like('template_master_category_name', $searchValue);
			$this->db->or_like('template_master_design_type', $searchValue);
			$this->db->group_end();
		}
		$this->db->select('*');
		$this->db->from('template_master');
		$this->db->where("template_master_status",1);
		$this->db->order_by('template_master_id', 'DESC');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function check_category_name($category_name)
	{
		$this->db->select('template_master_category_name');
		$this->db->from('template_master');
		$this->db->where('template_master_category_name', $category_name);
		$this->db->where('template_master_status', '1');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function checkEdit_category_name($category_name, $id)
	{
		$this->db->select('template_master_category_name');
		$this->db->from('template_master');
		$this->db->where('template_master_category_name', $category_name);
		$this->db->where('template_master_id !=', $id);
		$this->db->where('template_master_status', '1');
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where("template_master_status",1);
		$this->db->where('template_master_id',$id);
		$query = $this->db->get();
		return $query->row();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($id, $data)
	{
		$this->db->where('template_master_id', $id);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}

	// --- Nested methods for destinations ---

	public function save_destination($data)
	{
		$this->db->insert('template_master_destination', $data);
		return $this->db->insert_id();
	}

	public function get_destinations_by_master($master_id)
	{
		$this->db->select('tmd.*, s.state_name');
		$this->db->from('template_master_destination tmd');
		$this->db->join('state s', 's.state_id = tmd.state_id_fk', 'left');
		$this->db->where('tmd.template_master_id_fk', $master_id);
		$this->db->where('tmd.template_master_destination_status', 1);
		$this->db->order_by('tmd.template_master_destination_id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	public function delete_destinations_by_master($master_id)
	{
		$this->db->where('template_master_id_fk', $master_id);
		$this->db->delete('template_master_destination');
		return $this->db->affected_rows();
	}

	// --- Nested methods for properties ---

	public function save_property($data)
	{
		$this->db->insert('template_master_destination_property', $data);
		return $this->db->insert_id();
	}

	public function get_properties_by_destination($destination_id)
	{
		$this->db->select('tmdp.*, p.properties_name');
		$this->db->from('template_master_destination_property tmdp');
		$this->db->join('properties p', 'p.properties_id = tmdp.properties_id_fk', 'left');
		$this->db->where('tmdp.template_master_destination_id_fk', $destination_id);
		$this->db->where('tmdp.template_master_destination_property_status', 1);
		$this->db->order_by('tmdp.template_master_destination_property_id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}

	// --- Nested methods for rooms ---

	public function save_room($data)
	{
		$this->db->insert('template_master_destination_property_room', $data);
		return $this->db->insert_id();
	}

	public function get_rooms_by_property($property_id)
	{
		$this->db->select('tmdpr.*, pr.properties_room_category_name');
		$this->db->from('template_master_destination_property_room tmdpr');
		$this->db->join('properties_room_category pr', 'pr.properties_room_category_id = tmdpr.properties_room_category_id_fk', 'left');
		$this->db->where('tmdpr.template_master_destination_property_id_fk', $property_id);
		$this->db->where('tmdpr.template_master_destination_property_room_status', 1);
		$this->db->order_by('tmdpr.template_master_destination_property_room_id', 'ASC');
		$query = $this->db->get();
		return $query->result();
	}
}
?>
