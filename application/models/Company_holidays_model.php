<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Company_holidays_model extends CI_Model{
	var $table = 'company_holidays';
	
	public function __construct()
    {
        parent::__construct();
    }

    public function get_holidays($param)
    {
        // Get total records
        $totalData = $this->db->count_all($this->table);
        
        // Build the main query
        $this->db->select('*');
        $this->db->from($this->table);
        $this->db->where('holiday_status', 1);

        if (!empty($param['searchValue'])) {
            $this->db->group_start();
            $this->db->like('holiday_name', $param['searchValue']);
            $this->db->or_like('holiday_date', $param['searchValue']);
            $this->db->group_end();
        }

        // Clone the query for counting filtered results
        $queryForCount = clone $this->db;
        $totalFiltered = $queryForCount->count_all_results();
        
        // Apply ordering
        if (!empty($param['order']) && !empty($param['dir'])) {
            $this->db->order_by($param['order'], $param['dir']);
        } else {
            $this->db->order_by('holiday_date', 'DESC');
        }

        // Apply pagination
        if (!empty($param['length']) && !empty($param['start'])) {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();
        $data = $query->result();

        return array(
            'draw' => isset($param['draw']) ? intval($param['draw']) : 0,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data
        );
    }

    public function save($data)
    {
        $this->db->insert($this->table, $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id)
    {
        $this->db->from($this->table);
        $this->db->where('company_holiday_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    public function check_holiday_date($holiday_date)
    {
        $this->db->from($this->table);
        $this->db->where('holiday_date', $holiday_date);
        $this->db->where('holiday_status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function check_edit_holiday_date($holiday_date, $id)
    {
        $this->db->from($this->table);
        $this->db->where('holiday_date', $holiday_date);
        $this->db->where('company_holiday_id !=', $id);
        $this->db->where('holiday_status', 1);
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function is_holiday($date)
    {
        $dayOfWeek = date('w', strtotime($date));
        $dayOfMonth = date('j', strtotime($date));
        $holiday_type = '';

        // Check if Sunday holiday is enabled
        $enable_sunday = $this->get_setting('enable_sunday_holiday');
        if ($enable_sunday == '1' && $dayOfWeek == 0) {
            return true;
        }

        // Check if 2nd Saturday holiday is enabled
        $enable_second_saturday = $this->get_setting('enable_second_saturday_holiday');
        if ($enable_second_saturday == '1' && $dayOfWeek == 6 && $dayOfMonth >= 8 && $dayOfMonth <= 14) {
            return true;
        }

        // Check custom holidays from database
        $this->db->from($this->table);
        $this->db->where('holiday_date', $date);
        $this->db->where('holiday_status', 1);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    public function get_setting($setting_key)
    {
        $this->db->select('setting_value');
        $this->db->from('holiday_settings');
        $this->db->where('setting_key', $setting_key);
        $query = $this->db->get();
        $result = $query->row();
        return $result ? $result->setting_value : '0';
    }

    public function get_all_settings()
    {
        $this->db->from('holiday_settings');
        $query = $this->db->get();
        return $query->result();
    }

    public function update_setting($setting_key, $setting_value, $updated_by_user_id, $updated_by_username)
    {
        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }
        $date = date('Y-m-d');
        $time = date('h:i:sa');

        $data = array(
            'setting_value' => $setting_value,
            'setting_updated_date' => $date,
            'setting_updated_time' => $time,
            'setting_updated_by_user_id' => $updated_by_user_id,
            'setting_updated_by_username' => $updated_by_username
        );

        $this->db->where('setting_key', $setting_key);
        $this->db->update('holiday_settings', $data);
        return $this->db->affected_rows();
    }
}
