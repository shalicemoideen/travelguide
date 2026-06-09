<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Staff_order_assign_model extends CI_Model{
	var $table = 'staff_order_assign';
	
	public function __construct()
    {
        parent::__construct();
    }

    public function get_all_shifts()
    {
        return $this->db
            ->select('*')
            ->from('shift')
            ->where('shift_status', 1)
            ->order_by('shift_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_all_campaigns()
    {
        return $this->db
            ->select('meta_ads_setting_id, meta_ads_setting_name,facebook_form_id')
            ->from('meta_ads_setting')
            ->where('meta_ads_setting_status', 1)
            ->order_by('meta_ads_setting_name', 'ASC')
            ->get()
            ->result();
    }

    public function get_staff_order_by_shift_campaign($shift_id, $campaign_id)
    {
        return $this->db
            ->select('soa.staff_order_assign_id, soa.shift_id_fk, soa.meta_campain_id_fk, soa.staff_id_fk, soa.staff_order, u.admin_name')
            ->from('staff_order_assign soa')
            ->join('user_details u', 'u.user_id = soa.staff_id_fk', 'left')
            ->where('soa.shift_id_fk', $shift_id)
            ->where('soa.meta_campain_id_fk', $campaign_id)
            ->where('soa.staff_order_assign_status', 1)
            ->where('u.user_status', 1)
            ->order_by('CAST(soa.staff_order AS UNSIGNED)', 'ASC', false)
            ->get()
            ->result();
    }

    public function is_holiday($date)
    {
        $dayOfWeek = date('w', strtotime($date));
        $dayOfMonth = date('j', strtotime($date));

        // Check if Sunday holiday is enabled
        $enable_sunday = $this->get_holiday_setting('enable_sunday_holiday');
        if ($enable_sunday == '1' && $dayOfWeek == 0) {
            return true;
        }

        // Check if 2nd Saturday holiday is enabled
        $enable_second_saturday = $this->get_holiday_setting('enable_second_saturday_holiday');
        if ($enable_second_saturday == '1' && $dayOfWeek == 6 && $dayOfMonth >= 8 && $dayOfMonth <= 14) {
            return true;
        }

        // Check custom holidays from database
        $this->db->from('company_holidays');
        $this->db->where('holiday_date', $date);
        $this->db->where('holiday_status', 1);
        $query = $this->db->get();
        return $query->num_rows() > 0;
    }

    public function get_holiday_setting($setting_key)
    {
        $this->db->select('setting_value');
        $this->db->from('holiday_settings');
        $this->db->where('setting_key', $setting_key);
        $query = $this->db->get();
        $result = $query->row();
        return $result ? $result->setting_value : '0';
    }
}