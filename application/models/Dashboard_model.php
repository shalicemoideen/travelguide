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
			 $this->db->where("staff_id_fk",$currentuserid);
			}
        $today=date('Y-m-d');
        $between="'$today' between lead_register_date and lead_register_date";
        $this->db-> select('count(leads_id)as total_count');
        $this->db->from('leads');
        // $this->db->where('lead_current_status',1);
        $this->db->where('leads_status',1);
        $this->db->where($between);
        $query = $this->db->get();
        return $query->result();
    }

    public function getAllLeads_count(){
        $currentuserid = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        if($currentusertype == 'S'){
            $this->db->where("staff_id_fk", $currentuserid);
        }
        $this->db->select('count(leads_id) as total_count');
        $this->db->from('leads');
        $this->db->where('leads_status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getIntake_leads_count(){
            
		
        $currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("staff_id_fk",$currentuserid);
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
			 $this->db->where("staff_id_fk",$currentuserid);
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
			 $this->db->where("staff_id_fk",$currentuserid);
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
			 $this->db->where("staff_id_fk",$currentuserid);
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
			 $this->db->where("staff_id_fk",$currentuserid);
			}
        $this->db-> select('count(leads_id)as total_count');
        $this->db->from('leads');
        $this->db->where('lead_current_status',5);
        $this->db->where('leads_status',1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getToday_checkin_count(){
        $today = date('Y-m-d');
        $this->db->select('COALESCE(SUM(gcd.adults + gcd.children), 0) as total_count');
        $this->db->from('quotation q');
        $this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');
        $this->db->join('guset_count gc', 'gc.guset_count_lead_id_fk = l.leads_id', 'inner');
        $this->db->join('guset_count_details gcd', 'gcd.guset_count_id_fk = gc.guset_count_id', 'inner');
        $this->db->where('q.quotation_current_status', 5);
        $this->db->where('q.quotation_status', 1);
        $this->db->where('l.start_date', $today);
        $this->db->where('gc.guset_count_status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    public function getToday_checkout_count(){
        $today = date('Y-m-d');
        $this->db->select('COALESCE(SUM(gcd.adults + gcd.children), 0) as total_count');
        $this->db->from('quotation q');
        $this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');
        $this->db->join('guset_count gc', 'gc.guset_count_lead_id_fk = l.leads_id', 'inner');
        $this->db->join('guset_count_details gcd', 'gcd.guset_count_id_fk = gc.guset_count_id', 'inner');
        $this->db->where('q.quotation_current_status', 5);
        $this->db->where('q.quotation_status', 1);
        $this->db->where('l.end_date', $today);
        $this->db->where('gc.guset_count_status', 1);
        $query = $this->db->get();
        return $query->result();
    }

    private function _getPeriodRange($period){
        $end_date   = date('Y-m-d');
        $start_date = '';
        switch($period){
            case 'today':
                $start_date = date('Y-m-d');
                break;
            case 'week':
                $dow        = (int)date('w');
                $start_date = date('Y-m-d', strtotime('-' . $dow . ' days'));
                $end_date   = date('Y-m-d', strtotime('+' . (6 - $dow) . ' days'));
                break;
            case 'month':
                $start_date = date('Y-m-01');
                $end_date   = date('Y-m-t');
                break;
            case 'year':
                $start_date = date('Y-01-01');
                $end_date   = date('Y-12-31');
                break;
        }
        return array('start' => $start_date, 'end' => $end_date);
    }

    public function getTotalLeadsCount($period = 'today'){
        $range = $this->_getPeriodRange($period);
        $currentuserid = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        if($currentusertype == 'S'){
            $this->db->where("staff_id_fk", $currentuserid);
        }
        $this->db->select('count(leads_id) as total_count');
        $this->db->from('leads');
        $this->db->where('leads_status', 1);
        if($range['start']){
            $this->db->where('lead_register_date >=', $range['start']);
        }
        $this->db->where('lead_register_date <=', $range['end']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getConvertedTripsCount($period = 'today'){
        $range = $this->_getPeriodRange($period);
        $currentuserid = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        if($currentusertype == 'S'){
            $this->db->where("staff_id_fk", $currentuserid);
        }
        $this->db->select('count(leads_id) as total_count');
        $this->db->from('leads');
        $this->db->where('lead_current_status', 3);
        $this->db->where('leads_status', 1);
        if($range['start']){
            $this->db->where('start_date >=', $range['start']);
        }
        $this->db->where('start_date <=', $range['end']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCheckinCount($period = 'today'){
        $range = $this->_getPeriodRange($period);
        $currentuserid   = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        $this->db->select('COUNT(q.quotation_id) as total_count');
        $this->db->from('quotation q');
        $this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');
        $this->db->where('q.quotation_current_status', 5);
        $this->db->where('q.quotation_status', 1);
        if($currentusertype == 'S'){
            $this->db->where('l.staff_id_fk', $currentuserid);
        }
        if($range['start']){
            $this->db->where('l.start_date >=', $range['start']);
        }
        $this->db->where('l.start_date <=', $range['end']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getCheckoutCount($period = 'today'){
        $range = $this->_getPeriodRange($period);
        $currentuserid   = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        $this->db->select('COUNT(q.quotation_id) as total_count');
        $this->db->from('quotation q');
        $this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');
        $this->db->where('q.quotation_current_status', 5);
        $this->db->where('q.quotation_status', 1);
        if($currentusertype == 'S'){
            $this->db->where('l.staff_id_fk', $currentuserid);
        }
        if($range['start']){
            $this->db->where('l.start_date >=', $range['start']);
        }
        $this->db->where('l.start_date <=', $range['end']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getMonthlyDailyLeadsCount(){
        $currentuserid = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');

        $start_date = date('Y-m-d', strtotime('-29 days'));
        $end_date   = date('Y-m-d');

        if($currentusertype == 'S'){
            $this->db->where("staff_id_fk", $currentuserid);
        }
        $this->db->select("DATE_FORMAT(lead_register_date, '%d %b') as day_label, lead_register_date as raw_date, COUNT(leads_id) as total_count");
        $this->db->from('leads');
        $this->db->where('leads_status', 1);
        $this->db->where('lead_register_date >=', $start_date);
        $this->db->where('lead_register_date <=', $end_date);
        $this->db->group_by('lead_register_date');
        $this->db->order_by('lead_register_date', 'ASC');
        $query = $this->db->get();
        return $query->result();
    }

    public function getStaffLeadsAssignedVsConverted(){
        $currentuserid   = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        $this->db->select("u.admin_name as staff_name, COUNT(l.leads_id) as total_assigned, SUM(CASE WHEN l.lead_current_status = 3 THEN 1 ELSE 0 END) as total_converted");
        $this->db->from('leads l');
        $this->db->join('user_details u', 'u.user_id = l.staff_id_fk', 'left');
        $this->db->where('l.leads_status', 1);
        $this->db->where('l.staff_id_fk !=', 0);
        $this->db->where('l.staff_id_fk IS NOT NULL', null, false);
        if ($currentusertype == 'S') {
            $this->db->where('l.staff_id_fk', $currentuserid);
        }
        $this->db->group_by('l.staff_id_fk');
        $this->db->order_by('total_assigned', 'DESC');
        $this->db->limit(10);
        $query = $this->db->get();
        return $query->result();
    }

    public function getLeadsStatusBreakdown(){
        $currentuserid = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');

        if($currentusertype == 'S'){
            $this->db->where("staff_id_fk", $currentuserid);
        }
        $this->db->select("lead_current_status, COUNT(leads_id) as total_count");
        $this->db->from('leads');
        $this->db->where('leads_status', 1);
        $this->db->group_by('lead_current_status');
        $query = $this->db->get();
        return $query->result();
    }

    public function getQuotationsCount($period = 'today', $status_code = null){
        $range = $this->_getPeriodRange($period);

        $currentuserid   = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');
        $this->db->select('COUNT(q.quotation_id) as total_count');
        $this->db->from('quotation q');
        $this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');
        $this->db->where('q.quotation_status', 1);
        $this->db->where('l.leads_status', 1);
        if($status_code !== null){
            $this->db->where('q.quotation_current_status', $status_code);
        }
        if($currentusertype == 'S'){
            $this->db->where('l.staff_id_fk', $currentuserid);
        }
        if($range['start']){
            $this->db->where('DATE(q.quotation_date) >=', $range['start']);
        }
        $this->db->where('DATE(q.quotation_date) <=', $range['end']);
        $query = $this->db->get();
        return $query->result();
    }

    public function getLeadsCount($period = 'today'){
        $end_date   = date('Y-m-d');
        $start_date = '';

        switch($period){
            case 'today':
                $start_date = date('Y-m-d');
                break;
            case 'week':
                $start_date = date('Y-m-d', strtotime('monday this week'));
                break;
            case 'month':
                $start_date = date('Y-m-d', strtotime('first day of this month'));
                break;
            case 'year':
                $start_date = date('Y-m-d', strtotime('first day of january this year'));
                break;
        }

        $currentuserid = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');

        if($currentusertype == 'S'){
            $this->db->where("staff_id_fk", $currentuserid);
        }

        $this->db->select('COUNT(leads_id) as total_count');
        $this->db->from('leads');
        $this->db->where('leads_status', 1);
        if($start_date){
            $this->db->where('lead_register_date >=', $start_date);
        }
        $this->db->where('lead_register_date <=', $end_date);
        $query = $this->db->get();
        return $query->result();
    }

    public function getTripsWithPendingCustomerPayment($period = 'today'){
        $range = $this->_getPeriodRange($period);
        $currentuserid   = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');

        $this->db->select('q.quotation_id, rs.total_amount');
        $this->db->from('quotation q');
        $this->db->join('receipt_scheduler rs', 'rs.quotation_id_fk = q.quotation_id', 'inner');
        $this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');
        $this->db->join('receipt_scheduler_payments p', 'p.receipt_scheduler_id_fk = rs.receipt_scheduler_id AND p.payment_status = 1', 'left');
        $this->db->where('q.quotation_status', 1);
        $this->db->where('q.quotation_current_status !=', 6);
        $this->db->where('rs.receipt_scheduler_status', 1);
        if($currentusertype == 'S'){
            $this->db->where('q.quotation_created_by_userid', $currentuserid);
        }
        if($range['start']){
            $this->db->where('l.start_date >=', $range['start']);
        }
        $this->db->where('l.start_date <=', $range['end']);
        $this->db->group_by('q.quotation_id, rs.total_amount');
        $this->db->having('(rs.total_amount - COALESCE(SUM(p.payment_amount), 0)) > 0');
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function getTripsWithPendingPropertyPayment($period = 'today'){
        $range = $this->_getPeriodRange($period);
        $currentuserid   = $this->session->userdata('user_id');
        $currentusertype = $this->session->userdata('user_type');

        $this->db->select('q.quotation_id, pps.total_amount, pps.discounted_total');
        $this->db->from('quotation q');
        $this->db->join('property_payment_scheduler pps', 'pps.quotation_id_fk = q.quotation_id', 'inner');
        $this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');
        $this->db->join('property_payment_scheduler_installments i', 'i.property_payment_scheduler_id_fk = pps.property_payment_scheduler_id AND i.installment_status = 1', 'left');
        $this->db->where('q.quotation_status', 1);
        $this->db->where('q.quotation_current_status !=', 6);
        $this->db->where('pps.property_payment_scheduler_status', 1);
        if($currentusertype == 'S'){
            $this->db->where('q.quotation_created_by_userid', $currentuserid);
        }
        if($range['start']){
            $this->db->where('l.start_date >=', $range['start']);
        }
        $this->db->where('l.start_date <=', $range['end']);
        $this->db->group_by('q.quotation_id, pps.total_amount, pps.discounted_total');
        $this->db->having('((CASE WHEN pps.discounted_total > 0 THEN pps.discounted_total ELSE pps.total_amount END) - COALESCE(SUM(i.paid_amount), 0)) > 0');
        $query = $this->db->get();
        return $query->num_rows();
    }

}
?>