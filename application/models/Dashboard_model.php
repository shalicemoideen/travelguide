<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Dashboard_model extends CI_Model{
	var $table = 'leads';

	public function __construct()
    {
        parent::__construct();
    }

    public function getToday_leads_count(){
            
			
			
        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
        $today=date('Y-m-d');
        $between="'$today' between leads_created_date and leads_created_date";
        $this->db-> select('count(leads_id)as total_count');
        $this->db->from('leads');
        // $this->db->where('lead_current_status',1);
        $this->db->where('leads_status',1);
        $this->db->where($between);
        $query = $this->db->get();
        return $query->result();
    }

    public function getIntake_leads_count(){
            
		
        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
        
        $this->db-> select('count(leads_id)as total_count');
        $this->db->from('leads');
        $this->db->where('lead_current_status',1);
        $this->db->where('leads_status',1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getQualified_leads_count(){
            
		
        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
        $this->db-> select('count(leads_id)as total_count');
        $this->db->from('leads');
        $this->db->where('lead_current_status',2);
        $this->db->where('leads_status',1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getConverted_leads_count(){
            
		
        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
        $this->db-> select('count(leads_id)as total_count');
        $this->db->from('leads');
        $this->db->where('lead_current_status',3);
        $this->db->where('leads_status',1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getNotQualified_leads_count(){
            
		
        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
        $this->db-> select('count(leads_id)as total_count');
        $this->db->from('leads');
        $this->db->where('lead_current_status',4);
        $this->db->where('leads_status',1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getLost_leads_count(){
           
        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
        $this->db-> select('count(leads_id)as total_count');
        $this->db->from('leads');
        $this->db->where('lead_current_status',5);
        $this->db->where('leads_status',1);
        $query = $this->db->get();
        return $query->result();
    }

}
?>