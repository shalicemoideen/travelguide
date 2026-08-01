<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Dashboard extends MY_Controller {
	public $table = 'user_details';
	public $table1 = 'main_head';
	public $page  = 'Dashboard';
	public function __construct() {
		parent::__construct();
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Dashboard_model');
        
	}
	
	
	public function index()
	{
		$template['allleads']      = $this->Dashboard_model->getTotalLeadsCount('today');
		$template['converted']     = $this->Dashboard_model->getConvertedTripsCount('today');
		$template['checkin']       = $this->Dashboard_model->getCheckinCount('today');
		$template['checkout']      = $this->Dashboard_model->getCheckoutCount('today');
		$template['quotations_generated']    = $this->Dashboard_model->getQuotationsCount('today', 1);
		$template['quotations_confirmed']    = $this->Dashboard_model->getQuotationsCount('today', 5);
		$template['quotations_reservation']  = $this->Dashboard_model->getQuotationsCount('today', 8);
		$template['quotations_driver_not_assigned'] = $this->Dashboard_model->getQuotationsCount('today', 9);
		$template['pending_customer_payment'] = $this->Dashboard_model->getTripsWithPendingCustomerPayment('today');
		$template['pending_property_payment'] = $this->Dashboard_model->getTripsWithPendingPropertyPayment('today');
		$template['body'] = 'Dashboard/list';
		$template['script'] = 'Dashboard/script';
		$this->load->view('template', $template);
	}

	public function get_period_counts()
	{
		$period = $this->input->post('period') ? $this->input->post('period') : 'today';

		$allleads      = $this->Dashboard_model->getTotalLeadsCount($period);
		$converted     = $this->Dashboard_model->getConvertedTripsCount($period);
		$checkin       = $this->Dashboard_model->getCheckinCount($period);
		$checkout      = $this->Dashboard_model->getCheckoutCount($period);
		$quot_generated          = $this->Dashboard_model->getQuotationsCount($period, 1);
		$quot_confirmed          = $this->Dashboard_model->getQuotationsCount($period, 5);
		$quot_reservation        = $this->Dashboard_model->getQuotationsCount($period, 8);
		$quot_driver_not_assigned = $this->Dashboard_model->getQuotationsCount($period, 9);
		$leads                   = $this->Dashboard_model->getLeadsCount($period);
		$pending_customer        = $this->Dashboard_model->getTripsWithPendingCustomerPayment($period);
		$pending_property        = $this->Dashboard_model->getTripsWithPendingPropertyPayment($period);

		$data = array(
			'allleads'              => $allleads              ? (int)$allleads[0]->total_count              : 0,
			'converted'             => $converted             ? (int)$converted[0]->total_count             : 0,
			'checkin'               => $checkin               ? (int)$checkin[0]->total_count               : 0,
			'checkout'              => $checkout              ? (int)$checkout[0]->total_count              : 0,
			'quotations_generated'  => $quot_generated        ? (int)$quot_generated[0]->total_count        : 0,
			'quotations_confirmed'  => $quot_confirmed        ? (int)$quot_confirmed[0]->total_count        : 0,
			'quotations_reservation'=> $quot_reservation      ? (int)$quot_reservation[0]->total_count      : 0,
			'quotations_driver_not_assigned' => $quot_driver_not_assigned ? (int)$quot_driver_not_assigned[0]->total_count : 0,
			'pending_customer_payment' => (int)$pending_customer,
			'pending_property_payment' => (int)$pending_property,
			'leads'                 => $leads                 ? (int)$leads[0]->total_count                 : 0
		);
		echo json_encode($data);
	}

	public function graph_data1()
	{
		$m_month = $this->input->get('m_month') ? $this->input->get('m_month') : date('m');
		$m_year  = $this->input->get('m_year') ? $this->input->get('m_year') : date('Y');
		$y_year  = $this->input->get('y_year') ? $this->input->get('y_year') : date('Y');

		if ($this->currentusertype != 'A') {
			$m_staff = $this->currentuserid;
			$y_staff = $this->currentuserid;
		} else {
			$m_staff = $this->input->get('m_staff');
			$y_staff = $this->input->get('y_staff');
		}

		// Monthly data: leads per day in the selected month
		$days_in_month = cal_days_in_month(CAL_GREGORIAN, $m_month, $m_year);
		$month_labels = array();
		$month_assigned = array();
		$month_occupied = array();
		$month_lost = array();

		for($d = 1; $d <= $days_in_month; $d++){
			$date = $m_year.'-'.str_pad($m_month, 2, '0', STR_PAD_LEFT).'-'.str_pad($d, 2, '0', STR_PAD_LEFT);
			$month_labels[] = $d;

			$this->db->select('COUNT(leads_id) as cnt');
			$this->db->from('leads');
			$this->db->where('lead_register_date', $date);
			$this->db->where('leads_status', 1);
			if($m_staff && $m_staff != '0'){ $this->db->where('staff_id_fk', $m_staff); }
			$row = $this->db->get()->row();
			$assigned = $row ? (int)$row->cnt : 0;

			$this->db->select('COUNT(leads_id) as cnt');
			$this->db->from('leads');
			$this->db->where('lead_register_date', $date);
			$this->db->where('leads_status', 1);
			$this->db->where('lead_current_status', 3);
			if($m_staff && $m_staff != '0'){ $this->db->where('staff_id_fk', $m_staff); }
			$row2 = $this->db->get()->row();
			$occupied = $row2 ? (int)$row2->cnt : 0;

			$this->db->select('COUNT(leads_id) as cnt');
			$this->db->from('leads');
			$this->db->where('lead_register_date', $date);
			$this->db->where('leads_status', 1);
			$this->db->where('lead_current_status', 5);
			if($m_staff && $m_staff != '0'){ $this->db->where('staff_id_fk', $m_staff); }
			$row3 = $this->db->get()->row();
			$lost = $row3 ? (int)$row3->cnt : 0;

			$month_assigned[] = $assigned;
			$month_occupied[] = $occupied;
			$month_lost[] = $lost;
		}

		// Yearly data: leads per month in the selected year
		$year_labels = array('Jan','Feb','Mar','Apr','May','Jun','Jul','Aug','Sep','Oct','Nov','Dec');
		$year_assigned = array();
		$year_occupied = array();
		$year_lost = array();

		for($m = 1; $m <= 12; $m++){
			$start_date = $y_year.'-'.str_pad($m, 2, '0', STR_PAD_LEFT).'-01';
			$end_date   = date('Y-m-t', strtotime($start_date));

			$this->db->select('COUNT(leads_id) as cnt');
			$this->db->from('leads');
			$this->db->where('lead_register_date >=', $start_date);
			$this->db->where('lead_register_date <=', $end_date);
			$this->db->where('leads_status', 1);
			if($y_staff && $y_staff != '0'){ $this->db->where('staff_id_fk', $y_staff); }
			$row = $this->db->get()->row();
			$year_assigned[] = $row ? (int)$row->cnt : 0;

			$this->db->select('COUNT(leads_id) as cnt');
			$this->db->from('leads');
			$this->db->where('lead_register_date >=', $start_date);
			$this->db->where('lead_register_date <=', $end_date);
			$this->db->where('leads_status', 1);
			$this->db->where('lead_current_status', 3);
			if($y_staff && $y_staff != '0'){ $this->db->where('staff_id_fk', $y_staff); }
			$row2 = $this->db->get()->row();
			$year_occupied[] = $row2 ? (int)$row2->cnt : 0;

			$this->db->select('COUNT(leads_id) as cnt');
			$this->db->from('leads');
			$this->db->where('lead_register_date >=', $start_date);
			$this->db->where('lead_register_date <=', $end_date);
			$this->db->where('leads_status', 1);
			$this->db->where('lead_current_status', 5);
			if($y_staff && $y_staff != '0'){ $this->db->where('staff_id_fk', $y_staff); }
			$row3 = $this->db->get()->row();
			$year_lost[] = $row3 ? (int)$row3->cnt : 0;
		}

		$data = array(
			'month' => array(
				'labels'          => $month_labels,
				'total_assigned'  => array_sum($month_assigned),
				'total_occupied'  => array_sum($month_occupied),
				'total_lost'      => array_sum($month_lost),
				'assigned_amount' => $month_assigned,
				'occupied_amount' => $month_occupied,
				'lost_amount'     => $month_lost
			),
			'year' => array(
				'labels'          => $year_labels,
				'total_assigned'  => array_sum($year_assigned),
				'total_occupied'  => array_sum($year_occupied),
				'total_lost'      => array_sum($year_lost),
				'assigned_amount' => $year_assigned,
				'occupied_amount' => $year_occupied,
				'lost_amount'     => $year_lost
			)
		);
		echo json_encode($data);
	}

	public function fetch_staff_under_company()
	{
		$user_id_fk = $this->input->post('user_id_fk');
		$this->db->select('user_id, admin_name');
		$this->db->from('user_details');
		$this->db->where('user_id_fk', $user_id_fk);
		$this->db->where('user_type', 'S');
		$this->db->where('user_status', 1);
		$this->db->order_by('admin_name', 'ASC');
		$query = $this->db->get();
		$result = $query->result();

		$output = '<option value="0">All Staff</option>';
		foreach($result as $row){
			$output .= '<option value="'.$row->user_id.'">'.$row->admin_name.'</option>';
		}
		echo $output;
	}

	public function leads_chart_data()
	{
		$daily_raw = $this->Dashboard_model->getMonthlyDailyLeadsCount();
		$staff_raw = $this->Dashboard_model->getStaffLeadsAssignedVsConverted();
		$status_raw = $this->Dashboard_model->getLeadsStatusBreakdown();

		// Build full 30-day labels array (fill 0 for missing days)
		$start = strtotime('-29 days');
		$daily_map = array();
		foreach($daily_raw as $row){
			$daily_map[$row->raw_date] = (int)$row->total_count;
		}
		$labels = array();
		$counts = array();
		for($i = 0; $i < 30; $i++){
			$date_key = date('Y-m-d', strtotime("+$i days", $start));
			$labels[] = date('d M', strtotime("+$i days", $start));
			$counts[] = isset($daily_map[$date_key]) ? $daily_map[$date_key] : 0;
		}

		// Staff chart
		$staff_names = array();
		$staff_assigned = array();
		$staff_converted = array();
		foreach($staff_raw as $row){
			$staff_names[] = $row->staff_name ? $row->staff_name : 'Unassigned';
			$staff_assigned[] = (int)$row->total_assigned;
			$staff_converted[] = (int)$row->total_converted;
		}

		// Status donut (map status codes to labels)
		$status_labels_map = array(
			1 => 'Intake',
			2 => 'Qualified',
			3 => 'Converted',
			4 => 'Not Qualified',
			5 => 'Lost'
		);
		$status_labels = array();
		$status_counts = array();
		foreach($status_raw as $row){
			$code = (int)$row->lead_current_status;
			$status_labels[] = isset($status_labels_map[$code]) ? $status_labels_map[$code] : 'Status '.$code;
			$status_counts[] = (int)$row->total_count;
		}

		$data = array(
			'daily' => array(
				'labels' => $labels,
				'counts' => $counts
			),
			'staff' => array(
				'names'     => $staff_names,
				'assigned'  => $staff_assigned,
				'converted' => $staff_converted
			),
			'status' => array(
				'labels' => $status_labels,
				'counts' => $status_counts
			)
		);
		echo json_encode($data);
	}
	
}
?>