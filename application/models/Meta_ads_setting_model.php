<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Meta_ads_setting_model extends CI_Model{
	var $table = 'meta_ads_setting';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getMetaadssettingTable($param){
		$arOrder = array('','meta_ads_setting_name');
		$staff_id =(isset($param['staff_id']))?$param['staff_id']:'';
		$meta_ads_setting_id =(isset($param['meta_ads_setting_id']))?$param['meta_ads_setting_id']:'';
		$facebook_form_id_filter =(isset($param['facebook_form_id_filter']))?$param['facebook_form_id_filter']:'';
		$meta_ads_setting_created_by_userid =(isset($param['meta_ads_setting_created_by_userid']))?$param['meta_ads_setting_created_by_userid']:'';
		
		
		if($staff_id){
            $this->db->where('meta_ads_setting_staff_id_fk', $staff_id); 
        }
		if($meta_ads_setting_id){
            $this->db->where('meta_ads_setting_id', $meta_ads_setting_id); 
        }
        if($facebook_form_id_filter){
            $this->db->where_in('facebook_form_id', $facebook_form_id_filter); 
        }
        if($meta_ads_setting_created_by_userid){
            $this->db->where('meta_ads_setting_created_by_userid', $meta_ads_setting_created_by_userid); 
        }
        $this->db->where("meta_ads_setting_status",1);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("meta_ads_setting_created_by_userid",$currentuserid);
			}
		$this->db->select('*');
		$this->db->from('meta_ads_setting');
		$this->db->join('meta_ads_setting_staff', 'meta_ads_setting.meta_ads_setting_id = meta_ads_setting_staff.meta_ads_setting_id_fk','left');
		// $this->db->join('state', 'transporter.transporter_base_station_id_fk = state.state_id');
		$this->db->order_by('meta_ads_setting_id', 'DESC');
		$this->db->group_by('meta_ads_setting_staff.meta_ads_setting_id_fk');
        $query = $this->db->get();
        

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getMetaadssettingTotalCount($param);
        $data['recordsFiltered'] = $this->getMetaadssettingTotalCount($param);
        return $data;

	}

	public function getMetaadssettingTotalCount($param = NULL){

		$staff_id =(isset($param['staff_id']))?$param['staff_id']:'';
		$meta_ads_setting_id =(isset($param['meta_ads_setting_id']))?$param['meta_ads_setting_id']:'';
		$facebook_form_id_filter =(isset($param['facebook_form_id_filter']))?$param['facebook_form_id_filter']:'';
		$meta_ads_setting_created_by_userid =(isset($param['meta_ads_setting_created_by_userid']))?$param['meta_ads_setting_created_by_userid']:'';
		
		
		if($staff_id){
            $this->db->where('meta_ads_setting_staff_id_fk', $staff_id); 
        }
		if($meta_ads_setting_id){
            $this->db->where('meta_ads_setting_id', $meta_ads_setting_id); 
        }
        if($facebook_form_id_filter){
            $this->db->where_in('facebook_form_id', $facebook_form_id_filter); 
        }
        if($meta_ads_setting_created_by_userid){
            $this->db->where('meta_ads_setting_created_by_userid', $meta_ads_setting_created_by_userid); 
        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("meta_ads_setting_created_by_userid",$currentuserid);
			}
		$this->db->select('*');
		$this->db->from('meta_ads_setting');
		$this->db->join('meta_ads_setting_staff', 'meta_ads_setting.meta_ads_setting_id = meta_ads_setting_staff.meta_ads_setting_id_fk','left');
		// $this->db->join('state', 'transporter.transporter_base_station_id_fk = state.state_id');
		$this->db->where("meta_ads_setting_status",1);
        $this->db->order_by('meta_ads_setting_id', 'DESC');
		$this->db->group_by('meta_ads_setting_staff.meta_ads_setting_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	public function staff_array_list($user_id_fk){


        $query1 = "select *
                        from 
                            meta_ads_setting_staff

                            LEFT JOIN user_details p ON p.user_id = meta_ads_setting_staff.meta_ads_setting_staff_id_fk
                            

                        where meta_ads_setting_id_fk = $user_id_fk AND
                            meta_ads_setting_staff_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    function fetch_meta_staff($user_id)
	{

		
		
		$this->db->select('user_id');
		$this->db->from('meta_ads_setting_staff');
		$this->db->join('user_details', 'meta_ads_setting_staff.meta_ads_setting_staff_id_fk = user_details.user_id');
		$this->db->where("meta_ads_setting_staff_status",1);
		$this->db->where("meta_ads_setting_id_fk",$user_id);
		$query = $this->db->get();
		return $query->result();
	}

	public function get_user_shift($staff_id)
	{
		return $this->db
			->select('shift_id_fk')
			->from('user_details')
			->where('user_id', $staff_id)
			->where('user_status', 1)
			->get()
			->row();
	}

	public function get_next_staff_order($shift_id, $meta_campain_id)
	{
		$row = $this->db
			->select('staff_order')
			->from('staff_order_assign')
			->where('shift_id_fk', $shift_id)
			->where('meta_campain_id_fk', $meta_campain_id)
			->where('staff_order_assign_status', 1)
			->order_by('CAST(staff_order AS UNSIGNED)', 'DESC', false)
			->limit(1)
			->get()
			->row();

		if ($row && is_numeric($row->staff_order)) {
			return ((int)$row->staff_order) + 1;
		}

		return 1;
	}
    function fetch_meta_ads_setting_details()
	{
		$this->db->order_by("meta_ads_setting_id", "ASC");
		$this->db->where("meta_ads_setting_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("meta_ads_setting");
		return $query->result();
	}

    function fetch_allstaff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}

	function fetch_staff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		$this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}
	

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where("meta_ads_setting_status",1);
		$this->db->where('meta_ads_setting_id',$id);
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
		$this->db->where('meta_ads_setting_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>