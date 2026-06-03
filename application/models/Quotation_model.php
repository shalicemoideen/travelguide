<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Quotation_model extends CI_Model{
	var $table = 'quotation';
    var $table1 = 'quotation_room_tariff_details';
    var $table3 = 'trips';

	public function __construct()
    {
        parent::__construct();
    }

    public function getQuotationTable($param){
		$arOrder = array('','roles_name');
        $quotation_number_filter =(isset($param['quotation_number_filter']))?$param['quotation_number_filter']:'';
		$leads_id_filter =(isset($param['leads_id_filter']))?$param['leads_id_filter']:'';
        $guest_name =(isset($param['guest_name']))?$param['guest_name']:'';
        $package_id_filter =(isset($param['package_id_filter']))?$param['package_id_filter']:'';
		$arriving_destination_filter =(isset($param['arriving_destination_filter']))?$param['arriving_destination_filter']:'';
		$departuring_destination_filter =(isset($param['departuring_destination_filter']))?$param['departuring_destination_filter']:'';
        $quotation_current_status_filter =(isset($param['quotation_current_status_filter']))?$param['quotation_current_status_filter']:'';
		$quotation_created_by_userid =(isset($param['quotation_created_by_userid']))?$param['quotation_created_by_userid']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';

        if($quotation_number_filter){
            $this->db->where('quotation_number', $quotation_number_filter); 
        }
		if($leads_id_filter){
            $this->db->where('leads_id_fk', $leads_id_filter); 
        }
        if($guest_name){
            $this->db->like('guest_name', $guest_name); 
        }
        if($package_id_filter){
            $this->db->where('package_id_fk', $package_id_filter); 
        }
        if($quotation_current_status_filter){
            $this->db->where('quotation_current_status', $quotation_current_status_filter); 
        }
        if($arriving_destination_filter){
            $this->db->like('arriving_destination', $arriving_destination_filter); 
        }
        if($departuring_destination_filter){
            $this->db->where('departuring_destination', $departuring_destination_filter); 
        }
        if($start_date){
            $this->db->where('quotation_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('quotation_date<=', $end_date); 
        }
        if($quotation_created_by_userid){
            $this->db->where('quotation_created_by_userid', $quotation_created_by_userid); 
        }
        $this->db->where("quotation_status",1);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(quotation_date,\'%d-%m-%Y\') as quotation_date');
		$this->db->from('quotation');
		$this->db->join('leads', 'leads.leads_id = quotation.leads_id_fk','left');
		$this->db->join('packages', 'packages.packages_id = quotation.package_id_fk','left');
		$this->db->order_by('quotation_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getQuotationTotalCount($param);
        $data['recordsFiltered'] = $this->getQuotationTotalCount($param);
        return $data;

	}

	public function getQuotationTotalCount($param = NULL){

		$quotation_number_filter =(isset($param['quotation_number_filter']))?$param['quotation_number_filter']:'';
        $leads_id_filter =(isset($param['leads_id_filter']))?$param['leads_id_filter']:'';
        $guest_name =(isset($param['guest_name']))?$param['guest_name']:'';
        $package_id_filter =(isset($param['package_id_filter']))?$param['package_id_filter']:'';
		$quotation_current_status_filter =(isset($param['quotation_current_status_filter']))?$param['quotation_current_status_filter']:'';
        $arriving_destination_filter =(isset($param['arriving_destination_filter']))?$param['arriving_destination_filter']:'';
		$departuring_destination_filter =(isset($param['departuring_destination_filter']))?$param['departuring_destination_filter']:'';
		$quotation_created_by_userid =(isset($param['quotation_created_by_userid']))?$param['quotation_created_by_userid']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';

        if($quotation_number_filter){
            $this->db->where('quotation_number', $quotation_number_filter); 
        }
		if($leads_id_filter){
            $this->db->where('leads_id_fk', $leads_id_filter); 
        }
        if($guest_name){
            $this->db->like('guest_name', $guest_name); 
        }
        if($package_id_filter){
            $this->db->where('package_id_fk', $package_id_filter); 
        }
        if($quotation_current_status_filter){
            $this->db->where('quotation_current_status', $quotation_current_status_filter); 
        }
        if($arriving_destination_filter){
            $this->db->like('arriving_destination', $arriving_destination_filter); 
        }
        if($departuring_destination_filter){
            $this->db->where('departuring_destination', $departuring_destination_filter); 
        }
        if($start_date){
            $this->db->where('quotation_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('quotation_date<=', $end_date); 
        }
        if($quotation_created_by_userid){
            $this->db->where('quotation_created_by_userid', $quotation_created_by_userid); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*,DATE_FORMAT(quotation_date,\'%d-%m-%Y\') as quotation_date');
		$this->db->from('quotation');
		$this->db->join('leads', 'leads.leads_id = quotation.leads_id_fk','left');
		$this->db->join('packages', 'packages.packages_id = quotation.package_id_fk','left');
        $this->db->where("quotation_status",1);
		$this->db->order_by('quotation_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }

    public function last_id_quotation()
	{
		$this->db->select('quotation_id');
		$this->db->from('quotation');
		$this->db->where("quotation_status",1);
		$this->db->order_by('quotation_id','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->row();
	}

    function fetch_staff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		$this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}

	function fetch_all_users()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}

    function fetch_quotation()
	{
		$this->db->order_by("quotation_id", "ASC");
		$this->db->where("quotation_status",1);
		$query = $this->db->get("quotation");
		return $query->result();
	}

    function fetch_packages()
	{
		$this->db->order_by("packages_id", "ASC");
		$this->db->where("packages_status",1);
		$query = $this->db->get("packages");
		return $query->result();
	}

    function fetch_leads()
	{
		$this->db->order_by("leads_id", "ASC");
		$this->db->where("leads_status",1);
        $this->db->where("leads_accomodation_status",2);
        $this->db->where("leads_quotation_status",0);
		$this->db->where("lead_type",'B2C');
		$query = $this->db->get("leads");
		return $query->result();
	}

    public function get_quotation_hub_summary($quotation_id)
    {
        return $this->db
            ->select('q.quotation_number, q.quotation_current_status,
                    l.guest_name, l.leads_number, l.lead_type,
                    l.start_date, l.duration, l.end_date')
            ->from('quotation q')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('q.quotation_id', (int)$quotation_id)
            ->where('q.quotation_status', 1)
            ->get()
            ->row_array();
    }

    public function get_lead_full_details($id)
	{
		return $this->db
			->select('
				l.*,
				ud.admin_name as staff_name,
				s.source_name,
				p.packages_title,
				c.name as country_name,
				ps.priority_status_button,
				st.stages_button,
				a.admin_name as agent_name,
				m.meta_ads_setting_name
			')
			->from('quotation q')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
			->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left')
			->join('source s', 's.source_id = l.source_id_fk', 'left')
			->join('packages p', 'p.packages_id = l.package_id_fk', 'left')
			->join('country c', 'c.id = l.country_id_fk', 'left')
			->join('priority_status ps', 'ps.priority_status_id = l.priority_status_id_fk', 'left')
			->join('stages st', 'st.stages_id = l.stage_id_fk', 'left')
			->join('user_details a', 'a.user_id = l.agent_id_fk', 'left')
			->join('meta_ads_setting m', 'm.facebook_form_id = l.meta_form_id', 'left')
			->where('q.quotation_id', $id)
			->get()
			->row_array();
	}

	public function get_guest_accommodation_details($quotation_id)
    {
        return $this->db
            ->select('
                ap.*,
                ppd.packages_itineraries_days_title as day_label,
                ppd.packages_itineraries_days_day as day_name,
                ppd.packages_itineraries_days_travel_back as travel_back_flag,
                s.state_name,
                mp.meal_plan_name,
                gcd.adults,
                gcd.children,
                gcd.total_count
            ')
            ->from('accommodation_plan ap')
            ->join('packages_itinerary_days ppd', 'ppd.packages_itinerary_days_id = ap.day_id_fk', 'left')
            ->join('state s', 's.state_id = ap.stay_destination_id_fk', 'left')
            ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')
            ->join('guset_count_details gcd', 'gcd.guset_count_details_id = ap.guset_count_details_id_fk', 'left')
            // ->where('ap.lead_id_fk', $lead_id)
            ->where('ap.quotation_id_fk', $quotation_id)
            ->where('ap.accommodation_plan_status', 1)
            ->order_by('ap.accommodation_date', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_child_age_breakup($guest_count_id)
    {
        $rows = $this->db
            ->select('age, count')
            ->from('child_age_break_up')
            ->where('guset_count_details_id_fk', $guest_count_id)
            ->get()
            ->result();

        $parts = array();

        foreach ($rows as $r) {
            $parts[] = $r->age . ' yr x ' . $r->count;
        }

        return implode(', ', $parts);
    }

    public function get_quotation_options_for_confirmation($quotation_id)
    {
        return $this->db
            ->select('quotation_options_id, quotation_options_title')
            ->from('quotation_options')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_options_status', 1)
            ->order_by('quotation_options_id', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_confirmation_option_details($quotation_id, $quotation_options_id)
    {
        $days = $this->db
            ->select('qpd.*, s.state_name')
            ->from('quotation_properties_days qpd')
            ->join('state s', 's.state_id = qpd.quotation_properties_days_destination_id_fk', 'left')
            ->where('qpd.quotation_id_fk', $quotation_id)
            ->where('qpd.quotation_options_id_fk', $quotation_options_id)
            ->where('qpd.quotation_properties_days_status', 1)
            ->order_by('qpd.quotation_properties_days_id', 'ASC')
            ->get()
            ->result_array();

        foreach ($days as &$day) {
            $properties = $this->db
                ->select('qp.*, p.properties_name')
                ->from('quotation_properties qp')
                ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')
                ->where('qp.quotation_properties_days_id_fk', $day['quotation_properties_days_id'])
                ->where('qp.quotation_properties_status', 1)
                ->order_by('qp.quotation_properties_id', 'ASC')
                ->get()
                ->result_array();

            foreach ($properties as &$property) {
                $property['rooms'] = $this->db
                    ->select('qpr.*, prc.properties_room_category_name')
                    ->from('quotation_properties_rooms qpr')
                    ->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')
                    ->where('qpr.quotation_properties_id_fk', $property['quotation_properties_id'])
                    ->where('qpr.quotation_properties_rooms_status', 1)
                    ->order_by('qpr.quotation_properties_rooms_id', 'ASC')
                    ->get()
                    ->result_array();
            }

            $day['properties'] = $properties;
        }

        return $days;
    }
    public function get_active_vehicles()
    {
        return $this->db
            ->select('vehicle_id, vehicle_name, vehicle_number_seat')
            ->from('vehicle')
            ->where('vehicle_status', 1)
            ->order_by('vehicle_name', 'ASC')
            ->get()
            ->result();
    }

    public function get_full_itinerary_filtered($common_id, $lead_id, $package_id)
    {
        // 1) Get ONLY days that are allowed by accommodation_plan

            $days = $this->db
            ->select('
                d.packages_properties_days_id,
                d.packages_properties_days_day,
                ds.state_name,
                d.packages_properties_days_destination_id_fk,
                d.packages_itinerary_days_id_fk,
                ap.accommodation_plan_id,
                ap.guset_count_details_id_fk,
                ap.accommodation_date
            ')
            ->from('accommodation_plan ap')
            ->join('packages_properties_days d', 'd.packages_itinerary_days_id_fk = ap.day_id_fk', 'inner')
            ->join('state ds', 'ds.state_id = d.packages_properties_days_destination_id_fk', 'left')
            ->where('d.packages_properties_common_id_fk', $common_id)
            ->where('d.packages_properties_days_status', 1)
            ->where('ap.lead_id_fk', $lead_id)
            ->where('ap.pacakage_id_fk', $package_id)
            ->where('ap.accommodation_plan_status', 1)
            ->where('ap.accomodation_required_staus', 'R')
            ->order_by('d.packages_properties_days_id', 'ASC')
            ->get()
            ->result_array();
// echo $this->db->last_query();
// 		exit();
        // If no days match, return empty
        if (!$days) return [];

        // 2) For each day, load properties + rooms (your existing logic)
        foreach ($days as &$day) {

            $props = $this->db
                ->select('p.packages_properties_id, p.properties_id_fk as properties_id, pr.properties_name')
                ->from('packages_properties p')
                ->join('properties pr', 'pr.properties_id = p.properties_id_fk', 'left')
                ->where('p.packages_properties_days_id_fk', $day['packages_properties_days_id'])
                ->where('p.packages_properties_status', 1)
                ->order_by('p.packages_properties_id', 'ASC')
                ->get()
                ->result_array();

            foreach ($props as &$prop) {

                $rooms = $this->db
                    ->select('r.packages_properties_rooms_id, r.packages_properties_rooms_id_fk as properties_room_category_id, rc.properties_room_category_name')
                    ->from('packages_properties_rooms r')
                    ->join('properties_room_category rc', 'rc.properties_room_category_id = r.packages_properties_rooms_id_fk', 'left')
                    ->where('r.packages_properties_id_fk', $prop['packages_properties_id'])
                    ->where('r.packages_properties_rooms_status', 1)
                    ->order_by('r.packages_properties_rooms_id', 'ASC')
                    ->get()
                    ->result_array();

                $prop['rooms'] = $rooms;
            }

            $day['properties'] = $props;
        }

        return $days;
    }

    private function v($arr, $key, $default = null)
{
    return (is_array($arr) && isset($arr[$key]) && $arr[$key] !== null && $arr[$key] !== '')
        ? $arr[$key]
        : $default;
}

   public function get_room_policy_details($lead_id, $property_id, $room_cat_id)
{
    // ---------------------------
    // Lead
    // ---------------------------
    $lead = $this->db
        ->select('leads_id, leads_number')
        ->from('leads')
        ->where('leads_id', $lead_id)
        ->limit(1)
        ->get()
        ->row_array();

    if (!$lead) $lead = array();

    // ---------------------------
    // Property
    // ---------------------------
    $property = $this->db
        ->select('properties_id, properties_name')
        ->from('properties')
        ->where('properties_id', $property_id)
        ->limit(1)
        ->get()
        ->row_array();

    if (!$property) $property = array();

    // ---------------------------
    // Room Category + Meal Plan (default)
    // ---------------------------
    $room = $this->db
        ->select('
            rc.properties_room_category_id,
            rc.properties_id_fk,
            rc.room_meal_plan_id_fk,
            rc.properties_room_category_name,
            rc.properties_room_category_inventory,
            rc.properties_room_category_number_of_adults_allowed,
            rc.properties_room_category_children_allowed_on_bed_sharing_basis,
            rc.properties_room_category_extra_bed_mattress_allowed_in_room,

            rc.properties_room_category_welcomes_child_all_ages,
            rc.properties_room_category_admission_restricted_guests_under_age,

            rc.properties_room_category_complimentary_guest_between_type,
            rc.properties_room_category_complimentary_guest_between_from_year,
            rc.properties_room_category_complimentary_guest_between_to_year,

            rc.properties_room_category_child_rate_applied_guest_between_type,
            rc.properties_room_category_child_rate_applied_guest_from_year,
            rc.properties_room_category_child_rate_applied_guest_to_year,

            rc.properties_room_category_adult_rate_applied_guest_over,

            mp.meal_plan_name
        ')
        ->from('properties_room_category rc')
        ->join('meal_plan mp', 'mp.meal_plan_id = rc.room_meal_plan_id_fk', 'left')
        ->where('rc.properties_room_category_id', $room_cat_id)
        ->where('rc.properties_id_fk', $property_id)
        ->where('rc.properties_room_category_status', 1)
        ->limit(1)
        ->get()
        ->row_array();

    if (!$room) {
        // if invalid room category
        return array(
            'lead' => $lead,
            'property' => $property,
            'room' => array(),
            'policy_ages_text' => 'Baby - | Child -'
        );
    }

    // ---------------------------
    // Build Room Policy ages (Always show "Baby X-Y | Child A-B")
    // Baby = Complimentary range
    // Child = Child-rate range
    // ---------------------------
    $babyText = '';
    $compType = isset($room['properties_room_category_complimentary_guest_between_type'])
        ? $room['properties_room_category_complimentary_guest_between_type']
        : 'N';

    $compFrom = isset($room['properties_room_category_complimentary_guest_between_from_year'])
        ? $room['properties_room_category_complimentary_guest_between_from_year']
        : null;

    $compTo = isset($room['properties_room_category_complimentary_guest_between_to_year'])
        ? $room['properties_room_category_complimentary_guest_between_to_year']
        : null;

    if ($compType === 'Y' && $compFrom !== null && $compTo !== null && $compTo !== '0' && $compFrom !== '' && $compTo !== '') {
        $babyText = 'Baby ' . $compFrom . '-' . $compTo . ' YR';
    }

    $childText = '';
    $childType = isset($room['properties_room_category_child_rate_applied_guest_between_type'])
        ? $room['properties_room_category_child_rate_applied_guest_between_type']
        : 'N';

    $childFrom = isset($room['properties_room_category_child_rate_applied_guest_from_year'])
        ? $room['properties_room_category_child_rate_applied_guest_from_year']
        : null;

    $childTo = isset($room['properties_room_category_child_rate_applied_guest_to_year'])
        ? $room['properties_room_category_child_rate_applied_guest_to_year']
        : null;

    if ($childType === 'Y' && $childFrom !== null && $childTo !== null && $childFrom !== '0' && $childTo !== '0' && $childFrom !== '' && $childTo !== '') {
        $childText = 'Child ' . $childFrom . '-' . $childTo . ' YR';
    }

    // ✅ Always show fallback
    if ($babyText === '')  $babyText = 'Baby -';
    if ($childText === '') $childText = 'Child -';

    $policyAgesText = $babyText . ' | ' . $childText;

    return array(
        'lead' => $lead,
        'property' => $property,
        'room' => $room,
        'policy_ages_text' => $policyAgesText
    );
}

public function get_quotation_room_tariff_details_by_id($id)
{
    return $this->db
        ->from('quotation_room_tariff_details')
        ->where('quotation_room_tariff_details_id', (int)$id)
        ->where('quotation_room_tariff_details_status', 1)
        ->limit(1)
        ->get()
        ->row_array();
}

public function get_tariff_by_context($lead_id, $day_id_fk, $stay_destination_id, $property_id, $room_cat_id)
{
    // 1) Get accommodation_plan (date/day/meal)
    $apRow = $this->db
        ->select('accommodation_date, accommodation_day_name, meal_plan_id_fk, guset_count_details_id_fk')
        ->from('accommodation_plan')
        ->where('lead_id_fk', $lead_id)
        ->where('day_id_fk', $day_id_fk)
        ->where('stay_destination_id_fk', $stay_destination_id)
        ->where('accommodation_plan_status', 1)
        ->where('accomodation_required_staus', 'R')
        ->limit(1)
        ->get()
        ->row_array();

    if (!$apRow) {
        return array(
            'message' => 'No accommodation_plan found for this context',
            'supplement_amount' => 0,
            'meal_plan_id_fk' => 0,
            'meal_plan_name' => '',
            'used_counts' => array('adults' => 0, 'children' => 0, 'baby' => 0),
            'rates_source' => '',
            'rates' => array(
                'room_rate' => 0,
                'adult_eb_rate' => 0,
                'child_eb_rate' => 0,
                'child_sb_rate' => 0,
                'sgl_rate' => 0
            )
        );
    }

    $acc_date = $apRow['accommodation_date'];
    $acc_day  = $apRow['accommodation_day_name'];
    $meal_id  = (int)$apRow['meal_plan_id_fk'];

    // meal name
    $meal = $this->db
        ->select('meal_plan_id, meal_plan_name')
        ->from('meal_plan')
        ->where('meal_plan_id', $meal_id)
        ->limit(1)
        ->get()
        ->row_array();

    $meal_name = $meal ? $meal['meal_plan_name'] : '';

    // 2) Get applied plan context
    $ctx = $this->get_applied_plan_by_context(
        $lead_id,
        $day_id_fk,
        $stay_destination_id,
        $property_id,
        $room_cat_id
    );

    $appliedAdults = 0;
    $appliedChildren = 0;
    $appliedBaby = 0;

    if (isset($ctx['applied']) && is_array($ctx['applied'])) {
        $appliedAdults   = isset($ctx['applied']['adults']) ? (int)$ctx['applied']['adults'] : 0;
        $appliedChildren = isset($ctx['applied']['children']) ? (int)$ctx['applied']['children'] : 0;
        $appliedBaby     = isset($ctx['applied']['baby']) ? (int)$ctx['applied']['baby'] : 0;
    }

    // meal supplement uses applied counts
    $adultsForMeal = $appliedAdults;
    $childrenForMeal = $appliedChildren;

    /* =========================================================
       3) FIND NORMAL HIKE MASTER
       IMPORTANT:
       This is now from NEW TABLE:
       hike_room_tariff_hike
       ========================================================= */
    $hike = $this->db
        ->select('*')
        ->from('hike_room_tariff_hike')
        ->where('hike_properties_id_fk', $property_id)
        ->where('hike_room_tariff_hike_status', 1)
        ->where('hike_room_tariff_hike_from_date <=', $acc_date)
        ->where('hike_room_tariff_hike_to_date >=', $acc_date)
        ->order_by('hike_room_tariff_hike_from_date', 'DESC')
        ->limit(1)
        ->get()
        ->row_array();

   /* =========================================================
   4) MEAL SUPPLEMENT CALCULATION
   Priority:
   1. Hike tariff
   2. Normal tariff (fallback)
   ========================================================= */

    $supplement = 0;

    if ($meal_id == 2) {
        // EP => no meals
        $supplement = 0;
    } else {

        /* ============================
        4A) USE HIKE IF AVAILABLE
        ============================ */
        if ($hike) {

            $bA = (double)$hike['hike_room_tariff_hike_breakfast_rate_adult'];
            $bC = (double)$hike['hike_room_tariff_hike_breakfast_rate_child'];
            $lA = (double)$hike['hike_room_tariff_hike_lunch_rate_adult'];
            $lC = (double)$hike['hike_room_tariff_hike_lunch_rate_child'];
            $dA = (double)$hike['hike_room_tariff_hike_dinner_rate_adult'];
            $dC = (double)$hike['hike_room_tariff_hike_dinner_rate_child'];

        } else {

            /* ============================
            4B) FALLBACK → NORMAL TARIFF
            ============================ */

            $normal = $this->db
                ->select('*')
                ->from('room_tariff_hike')
                ->where('properties_id_fk', $property_id)
                ->where('room_tariff_hike_status', 1)
                ->where('room_tariff_hike_from_date <=', $acc_date)
                ->where('room_tariff_hike_to_date >=', $acc_date)
                ->order_by('room_tariff_hike_from_date', 'DESC')
                ->limit(1)
                ->get()
                ->row_array();

            if ($normal) {

                $bA = (double)$normal['room_tariff_hike_breakfast_rate_adult'];
                $bC = (double)$normal['room_tariff_hike_breakfast_rate_child'];
                $lA = (double)$normal['room_tariff_hike_lunch_rate_adult'];
                $lC = (double)$normal['room_tariff_hike_lunch_rate_child'];
                $dA = (double)$normal['room_tariff_hike_dinner_rate_adult'];
                $dC = (double)$normal['room_tariff_hike_dinner_rate_child'];

            } else {
                // no tariff at all
                $bA = $bC = $lA = $lC = $dA = $dC = 0;
            }
        }

        /* ============================
        4C) APPLY MEAL LOGIC
        ============================ */

        if ($meal_id == 1) {
            // CP (Breakfast)
            $supplement = ($bA * $adultsForMeal) + ($bC * $childrenForMeal);

        } elseif ($meal_id == 3) {
            // MAP (Breakfast + Dinner)
            $supplement =
                ($bA * $adultsForMeal) + ($bC * $childrenForMeal) +
                ($dA * $adultsForMeal) + ($dC * $childrenForMeal);

        } elseif ($meal_id == 4) {
            // AP (Breakfast + Lunch + Dinner)
            $supplement =
                ($bA * $adultsForMeal) + ($bC * $childrenForMeal) +
                ($lA * $adultsForMeal) + ($lC * $childrenForMeal) +
                ($dA * $adultsForMeal) + ($dC * $childrenForMeal);
        }
    }

    /* =========================================================
   5) ROOMING RATES
   Priority:
   1. hike_room_tariff_hike_rate / hike_room_tariff_week_days_rate
   2. room_tariff_hike_rate / room_tariff_week_days_rate
   ========================================================= */

    $rates_source = '';
    $rates = array(
        'room_rate' => 0,
        'adult_eb_rate' => 0,
        'child_eb_rate' => 0,
        'child_sb_rate' => 0,
        'sgl_rate' => 0
    );

    /* ============================
    5A) FIRST CHECK HIKE RATE
    ============================ */
    if ($hike) {

        $hike_rate = $this->db
            ->select('*')
            ->from('hike_room_tariff_hike_rate')
            ->where('hike_room_tariff_hike_id_fk', (int)$hike['hike_room_tariff_hike_id'])
            ->where('hike_room_id_fk', (int)$room_cat_id)
            ->where('hike_room_tariff_hike_rate_status', 1)
            ->limit(1)
            ->get()
            ->row_array();

        if ($hike_rate) {

            $use_week_override = false;
            if (
                isset($hike_rate['hike_room_tariff_hike_rate_some_days_type']) &&
                (
                    $hike_rate['hike_room_tariff_hike_rate_some_days_type'] == 'Y' ||
                    $hike_rate['hike_room_tariff_hike_rate_some_days_type'] == 1 ||
                    $hike_rate['hike_room_tariff_hike_rate_some_days_type'] == '1'
                )
            ) {
                $use_week_override = true;
            }

            if ($use_week_override && $acc_day) {

                $week = $this->db
                    ->select('week_days_id')
                    ->from('week_days')
                    ->where('week_days_name', $acc_day)
                    ->where('week_days_status', 1)
                    ->limit(1)
                    ->get()
                    ->row_array();

                if ($week) {
                    $week_rate = $this->db
                        ->select('*')
                        ->from('hike_room_tariff_week_days_rate')
                        ->where('hike_room_tariff_hike_rate_id_fk', (int)$hike_rate['hike_room_tariff_hike_rate_id'])
                        ->where('hike_week_days_room_id_fk', (int)$room_cat_id)
                        ->where('hike_week_days_id_fk', (int)$week['week_days_id'])
                        ->where('hike_room_tariff_week_days_rate_status', 1)
                        ->limit(1)
                        ->get()
                        ->row_array();

                    if ($week_rate) {
                        $rates_source = 'hike_week_days_rate';
                        $rates['room_rate']     = (double)$week_rate['hike_room_tariff_week_days_rate_room_amount'];
                        $rates['adult_eb_rate'] = (double)$week_rate['hike_room_tariff_week_days_rate_adult_with_extra_bed'];
                        $rates['child_eb_rate'] = (double)$week_rate['hike_room_tariff_week_days_rate_child_with_extra_bed'];
                        $rates['child_sb_rate'] = (double)$week_rate['hike_room_tariff_week_days_rate_child_sharing_bed'];
                        $rates['sgl_rate']      = (double)$week_rate['hike_room_tariff_week_days_rate_single_occupancy'];
                    }
                }
            }

            if ($rates_source == '') {
                $rates_source = 'hike_rate';
                $rates['room_rate']     = (double)$hike_rate['hike_room_tariff_hike_rate_room_rate'];
                $rates['adult_eb_rate'] = (double)$hike_rate['hike_room_tariff_hike_rate_adult_with_extra_bed'];
                $rates['child_eb_rate'] = (double)$hike_rate['hike_room_tariff_hike_rate_child_with_extra_bed'];
                $rates['child_sb_rate'] = (double)$hike_rate['hike_room_tariff_hike_rate_child_sharing_bed'];
                $rates['sgl_rate']      = (double)$hike_rate['hike_room_tariff_hike_rate_single_occupancy'];
            }
        }
    }

    /* ============================
    5B) FALLBACK TO NORMAL RATE
    ============================ */
    if ($rates_source == '') {

        $normal_master = $this->db
            ->select('*')
            ->from('room_tariff_hike')
            ->where('properties_id_fk', $property_id)
            ->where('room_tariff_hike_status', 1)
            ->where('room_tariff_hike_from_date <=', $acc_date)
            ->where('room_tariff_hike_to_date >=', $acc_date)
            ->order_by('room_tariff_hike_from_date', 'DESC')
            ->limit(1)
            ->get()
            ->row_array();

        if ($normal_master) {

            $normal_rate = $this->db
                ->select('*')
                ->from('room_tariff_hike_rate')
                ->where('room_tariff_hike_id_fk', (int)$normal_master['room_tariff_hike_id'])
                ->where('room_id_fk', (int)$room_cat_id)
                ->where('room_tariff_hike_rate_status', 1)
                ->limit(1)
                ->get()
                ->row_array();

            if ($normal_rate) {

                $use_normal_week_override = false;
                if (
                    isset($normal_rate['room_tariff_hike_rate_some_days_type']) &&
                    (
                        $normal_rate['room_tariff_hike_rate_some_days_type'] == 'Y' ||
                        $normal_rate['room_tariff_hike_rate_some_days_type'] == 1 ||
                        $normal_rate['room_tariff_hike_rate_some_days_type'] == '1'
                    )
                ) {
                    $use_normal_week_override = true;
                }

                if ($use_normal_week_override && $acc_day) {

                    $week = $this->db
                        ->select('week_days_id')
                        ->from('week_days')
                        ->where('week_days_name', $acc_day)
                        ->where('week_days_status', 1)
                        ->limit(1)
                        ->get()
                        ->row_array();

                    if ($week) {
                        $normal_week_rate = $this->db
                            ->select('*')
                            ->from('room_tariff_week_days_rate')
                            ->where('week_days_room_tariff_hike_id_fk', (int)$normal_rate['room_tariff_hike_rate_id'])
                            ->where('week_days_room_id_fk', (int)$room_cat_id)
                            ->where('week_days_id_fk', (int)$week['week_days_id'])
                            ->where('room_tariff_week_days_rate_status', 1)
                            ->limit(1)
                            ->get()
                            ->row_array();

                        if ($normal_week_rate) {
                            $rates_source = 'normal_week_days_rate';
                            $rates['room_rate']     = (double)$normal_week_rate['room_tariff_week_days_rate_room_amount'];
                            $rates['adult_eb_rate'] = (double)$normal_week_rate['room_tariff_week_days_rate_adult_with_extra_bed'];
                            $rates['child_eb_rate'] = (double)$normal_week_rate['room_tariff_week_days_rate_child_with_extra_bed'];
                            $rates['child_sb_rate'] = (double)$normal_week_rate['room_tariff_week_days_rate_child_sharing_bed'];
                            $rates['sgl_rate']      = (double)$normal_week_rate['room_tariff_week_days_rate_single_occupancy'];
                        }
                    }
                }

                if ($rates_source == '') {
                    $rates_source = 'normal_rate';
                    $rates['room_rate']     = (double)$normal_rate['room_tariff_hike_rate_room_rate'];
                    $rates['adult_eb_rate'] = (double)$normal_rate['room_tariff_hike_rate_adult_with_extra_bed'];
                    $rates['child_eb_rate'] = (double)$normal_rate['room_tariff_hike_rate_child_with_extra_bed'];
                    $rates['child_sb_rate'] = (double)$normal_rate['room_tariff_hike_rate_child_sharing_bed'];
                    $rates['sgl_rate']      = (double)$normal_rate['room_tariff_hike_rate_single_occupancy'];
                }
            }
        }
    }

    return array(
        'accommodation_date' => $acc_date,
        'accommodation_day_name' => $acc_day,
        'meal_plan_id_fk' => $meal_id,
        'meal_plan_name' => $meal_name,
        'used_counts' => array(
            'adults' => $adultsForMeal,
            'children' => $childrenForMeal,
            'baby' => $appliedBaby
        ),
        'supplement_amount' => (double)$supplement,
        'rates_source' => $rates_source,
        'rates' => $rates
    );
}

// public function get_tariff_by_context($lead_id, $day_id_fk, $stay_destination_id, $property_id, $room_cat_id)
// {
//     // 1) Get accommodation_plan (date/day/meal)
//     $apRow = $this->db
//         ->select('accommodation_date, accommodation_day_name, meal_plan_id_fk, guset_count_details_id_fk')
//         ->from('accommodation_plan')
//         ->where('lead_id_fk', $lead_id)
//         ->where('day_id_fk', $day_id_fk)
//         ->where('stay_destination_id_fk', $stay_destination_id)
//         ->where('accommodation_plan_status', 1)
//         ->where('accomodation_required_staus', 'R')
//         ->limit(1)
//         ->get()
//         ->row_array();

//     if (!$apRow) {
//         return array(
//             'message' => 'No accommodation_plan found for this context',
//             'supplement_amount' => 0,
//             'meal_plan_id_fk' => 0,
//             'meal_plan_name' => '',
//             'used_counts' => array('adults' => 0, 'children' => 0, 'baby' => 0),
//             'rates_source' => '',
//             'rates' => array(
//                 'room_rate' => 0,
//                 'adult_eb_rate' => 0,
//                 'child_eb_rate' => 0,
//                 'child_sb_rate' => 0,
//                 'sgl_rate' => 0
//             )
//         );
//     }

//     $acc_date = $apRow['accommodation_date'];
//     $acc_day  = $apRow['accommodation_day_name'];
//     $meal_id  = (int)$apRow['meal_plan_id_fk'];

//     // meal name
//     $meal = $this->db
//         ->select('meal_plan_id, meal_plan_name')
//         ->from('meal_plan')
//         ->where('meal_plan_id', $meal_id)
//         ->limit(1)
//         ->get()
//         ->row_array();
//     $meal_name = $meal ? $meal['meal_plan_name'] : '';

//     // 2) Get applied plan context (THIS contains your applied counts)
//     // IMPORTANT: reuse your existing function so no mismatch
//     $ctx = $this->get_applied_plan_by_context(
//         $lead_id, $day_id_fk, $stay_destination_id, $property_id, $room_cat_id
//     );

//     $appliedAdults = 0;
//     $appliedChildren = 0;
//     $appliedBaby = 0;

//     if (isset($ctx['applied']) && is_array($ctx['applied'])) {
//         $appliedAdults   = isset($ctx['applied']['adults']) ? (int)$ctx['applied']['adults'] : 0;
//         $appliedChildren = isset($ctx['applied']['children']) ? (int)$ctx['applied']['children'] : 0;
//         $appliedBaby     = isset($ctx['applied']['baby']) ? (int)$ctx['applied']['baby'] : 0;
//     }

//     // ✅ Meal supplement uses APPLIED counts
//     $adultsForMeal = $appliedAdults;
//     $childrenForMeal = $appliedChildren;
//     // (baby ignored for meal cost as per your rule)

//     // 3) Find applicable room_tariff_hike (property + date range)
//     $hike = $this->db
//         ->select('*')
//         ->from('room_tariff_hike')
//         ->where('properties_id_fk', $property_id)
//         ->where('room_tariff_hike_status', 1)
//         ->where("'" . $this->db->escape_str($acc_date) . "' BETWEEN room_tariff_hike_from_date AND room_tariff_hike_to_date", null, false)
//         ->order_by('room_tariff_hike_from_date', 'DESC')
//         ->limit(1)
//         ->get()
//         ->row_array();

//     // 4) Meal supplement calculation
//     $supplement = 0;

//     if ($meal_id == 2) {
//         // EP => 0
//         $supplement = 0;
//     } else {

//         if ($hike) {
//             $bA = (double)$hike['room_tariff_hike_breakfast_rate_adult'];
//             $bC = (double)$hike['room_tariff_hike_breakfast_rate_child'];
//             $lA = (double)$hike['room_tariff_hike_lunch_rate_adult'];
//             $lC = (double)$hike['room_tariff_hike_lunch_rate_child'];
//             $dA = (double)$hike['room_tariff_hike_dinner_rate_adult'];
//             $dC = (double)$hike['room_tariff_hike_dinner_rate_child'];

//             if ($meal_id == 1) {
//                 // CP(B)
//                 $supplement = ($bA * $adultsForMeal) + ($bC * $childrenForMeal);
//             } elseif ($meal_id == 3) {
//                 // MAP(B+D)
//                 $supplement = ($bA * $adultsForMeal) + ($bC * $childrenForMeal)
//                            + ($dA * $adultsForMeal) + ($dC * $childrenForMeal);
//             } elseif ($meal_id == 4) {
//                 // AP(B+L+D)
//                 $supplement = ($bA * $adultsForMeal) + ($bC * $childrenForMeal)
//                            + ($lA * $adultsForMeal) + ($lC * $childrenForMeal)
//                            + ($dA * $adultsForMeal) + ($dC * $childrenForMeal);
//             }
//         } else {
//             $supplement = 0; // no hike -> no rate
//         }
//     }

//     // 5) Rooming rates (same as before)
//     $rates_source = '';
//     $rates = array(
//         'room_rate' => 0,
//         'adult_eb_rate' => 0,
//         'child_eb_rate' => 0,
//         'child_sb_rate' => 0,
//         'sgl_rate' => 0
//     );

//     if ($hike) {

//         $hike_rate = $this->db
//             ->select('*')
//             ->from('room_tariff_hike_rate')
//             ->where('room_tariff_hike_id_fk', (int)$hike['room_tariff_hike_id'])
//             ->where('room_id_fk', (int)$room_cat_id)
//             ->where('room_tariff_hike_rate_status', 1)
//             ->limit(1)
//             ->get()
//             ->row_array();

//         if ($hike_rate) {

//             $use_week_override =
//                 (isset($hike_rate['room_tariff_hike_rate_some_days_type']) && $hike_rate['room_tariff_hike_rate_some_days_type'] == 'Y');

//             if ($use_week_override && $acc_day) {

//                 $week = $this->db
//                     ->select('week_days_id')
//                     ->from('week_days')
//                     ->where('week_days_name', $acc_day)
//                     ->where('week_days_status', 1)
//                     ->limit(1)
//                     ->get()
//                     ->row_array();

//                 if ($week) {
//                     $week_rate = $this->db
//                         ->select('*')
//                         ->from('room_tariff_week_days_rate')
//                         ->where('week_days_room_tariff_hike_id_fk', (int)$hike_rate['room_tariff_hike_rate_id'])
//                         ->where('week_days_id_fk', (int)$week['week_days_id'])
//                         ->where('room_tariff_week_days_rate_status', 1)
//                         ->limit(1)
//                         ->get()
//                         ->row_array();

//                     if ($week_rate) {
//                         $rates_source = 'week_days';
//                         $rates['room_rate']     = (double)$week_rate['room_tariff_week_days_rate_room_amount'];
//                         $rates['adult_eb_rate'] = (double)$week_rate['room_tariff_week_days_rate_adult_with_extra_bed'];
//                         $rates['child_eb_rate'] = (double)$week_rate['room_tariff_week_days_rate_child_with_extra_bed'];
//                         $rates['child_sb_rate'] = (double)$week_rate['room_tariff_week_days_rate_child_sharing_bed'];
//                         $rates['sgl_rate']      = (double)$week_rate['room_tariff_week_days_rate_single_occupancy'];
//                     }
//                 }
//             }

//             if ($rates_source == '') {
//                 $rates_source = 'hike_rate';
//                 $rates['room_rate']     = (double)$hike_rate['room_tariff_hike_rate_room_rate'];
//                 $rates['adult_eb_rate'] = (double)$hike_rate['room_tariff_hike_rate_adult_with_extra_bed'];
//                 $rates['child_eb_rate'] = (double)$hike_rate['room_tariff_hike_rate_child_with_extra_bed'];
//                 $rates['child_sb_rate'] = (double)$hike_rate['room_tariff_hike_rate_child_sharing_bed'];
//                 $rates['sgl_rate']      = (double)$hike_rate['room_tariff_hike_rate_single_occupancy'];
//             }
//         }
//     }

//     return array(
//         'accommodation_date' => $acc_date,
//         'accommodation_day_name' => $acc_day,
//         'meal_plan_id_fk' => $meal_id,
//         'meal_plan_name' => $meal_name,

//         // ✅ show what counts were used for meal calc
//         'used_counts' => array(
//             'adults' => $adultsForMeal,
//             'children' => $childrenForMeal,
//             'baby' => $appliedBaby
//         ),

//         'supplement_amount' => (double)$supplement,
//         'rates_source' => $rates_source,
//         'rates' => $rates
//     );
// }



    public function get_in_enquiry_by_context($lead_id, $day_id_fk, $stay_destination_id, $property_id, $room_cat_id)
{
    // 1) Validate room category belongs to property (important)
    $room = $this->db
        ->select('properties_room_category_id, properties_id_fk, room_meal_plan_id_fk, properties_room_category_name')
        ->from('properties_room_category')
        ->where('properties_room_category_id', $room_cat_id)
        ->where('properties_id_fk', $property_id)
        ->where('properties_room_category_status', 1)
        ->get()
        ->row_array();

    if (!$room) {
        return [
            'meal_plan_id_fk' => 0,
            'meal_plan_name' => '',
            'plan' => null,
            'child_age_break_up' => [],
            'message' => 'Room category not valid for this property'
        ];
    }

    // 2) Accommodation plan row for this day + destination + lead
    $ap = $this->db
        ->select('ap.guset_count_details_id_fk, ap.meal_plan_id_fk, mp.meal_plan_name')
        ->from('accommodation_plan ap')
        ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')
        ->where('ap.lead_id_fk', $lead_id)
        ->where('ap.day_id_fk', $day_id_fk)      // ✅ property_day_id_fk
        ->where('ap.stay_destination_id_fk', $stay_destination_id) // ✅ stay_destination_id_fk
        ->where('ap.accommodation_plan_status', 1)
        ->where('ap.accomodation_required_staus', 'R')
        ->limit(1)
        ->get()
        ->row_array();

    if (!$ap) {
        return [
            'meal_plan_id_fk' => 0,
            'meal_plan_name' => '',
            'plan' => null,
            'child_age_break_up' => [],
            'message' => 'No accommodation_plan found for this context'
        ];
    }

    // 3) Applied plan details
    $plan = $this->db
        ->select('guset_count_details_id, pax_count_plan, adults, children, total_count')
        ->from('guset_count_details')
        ->where('guset_count_details_id', $ap['guset_count_details_id_fk'])
        ->where('guset_count_details_status', 1)
        ->get()
        ->row_array();

    // 4) Child age breakup (optional)
    $ages = $this->db
        ->select('age, count')
        ->from('child_age_break_up')
        ->where('guset_count_details_id_fk', $ap['guset_count_details_id_fk'])
        ->where('child_age_break_up_status', 1)
        ->get()
        ->result_array();

    return [
        'meal_plan_id_fk' => (int)$ap['meal_plan_id_fk'],
        'meal_plan_name' => $ap['meal_plan_name'] ?: '',
        'plan' => $plan ?: null,
        'child_age_break_up' => $ages ?: [],
        'room' => $room
    ];
}

    public function get_applied_plan_by_context($lead_id, $day_id_fk, $stay_destination_id, $property_id, $room_cat_id)
{
    // ---------- 1) Load room category + room default meal plan ----------
    $room = $this->db
        ->select('
            rc.properties_room_category_id,
            rc.properties_id_fk,
            rc.room_meal_plan_id_fk,
            rc.properties_room_category_name,
            rc.properties_room_category_inventory,
            rc.properties_room_category_number_of_adults_allowed,
            rc.properties_room_category_children_allowed_on_bed_sharing_basis,
            rc.properties_room_category_extra_bed_mattress_allowed_in_room,
            rc.properties_room_category_welcomes_child_all_ages,
            rc.properties_room_category_admission_restricted_guests_under_age,
            rc.properties_room_category_complimentary_guest_between_type,
            rc.properties_room_category_complimentary_guest_between_from_year,
            rc.properties_room_category_complimentary_guest_between_to_year,
            rc.properties_room_category_child_rate_applied_guest_between_type,
            rc.properties_room_category_child_rate_applied_guest_from_year,
            rc.properties_room_category_child_rate_applied_guest_to_year,
            rc.properties_room_category_adult_rate_applied_guest_over,
            mp_room.meal_plan_name as room_meal_plan_name
        ')
        ->from('properties_room_category rc')
        ->join('meal_plan mp_room', 'mp_room.meal_plan_id = rc.room_meal_plan_id_fk', 'left')
        ->where('rc.properties_room_category_id', $room_cat_id)
        ->where('rc.properties_id_fk', $property_id)
        ->where('rc.properties_room_category_status', 1)
        ->limit(1)
        ->get()
        ->row_array();

    if (!$room) {
        return array(
            'meal_plan_id_fk' => 0,
            'meal_plan_name' => '',
            'room_meal_plan_id_fk' => 0,
            'room_meal_plan_name' => '',
            'meal_plan_mismatch' => 0,
            'room_is_ep_room_only' => 0,
            'applied' => array('adults' => 0, 'children' => 0, 'baby' => 0),
            'plan' => null,
            'child_age_break_up' => array(),
            'room' => null,
            'message' => 'Room category not valid for this property'
        );
    }

    $roomMealId = (int)$room['room_meal_plan_id_fk'];
    $roomIsEP   = ($roomMealId === 2) ? 1 : 0;

    // ---------- 2) Accommodation plan row for this context ----------
    $ap = $this->db
        ->select('ap.guset_count_details_id_fk, ap.meal_plan_id_fk, mp.meal_plan_name')
        ->from('accommodation_plan ap')
        ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')
        ->where('ap.lead_id_fk', $lead_id)
        ->where('ap.day_id_fk', $day_id_fk)
        ->where('ap.stay_destination_id_fk', $stay_destination_id)
        ->where('ap.accommodation_plan_status', 1)
        ->where('ap.accomodation_required_staus', 'R')
        ->limit(1)
        ->get()
        ->row_array();

    if (!$ap) {
        return array(
            'meal_plan_id_fk' => 0,
            'meal_plan_name' => '',
            'room_meal_plan_id_fk' => $roomMealId,
            'room_meal_plan_name' => $room['room_meal_plan_name'],
            'meal_plan_mismatch' => 0,
            'room_is_ep_room_only' => $roomIsEP,
            'applied' => array('adults' => 0, 'children' => 0, 'baby' => 0),
            'plan' => null,
            'child_age_break_up' => array(),
            'room' => $room,
            'message' => 'No accommodation_plan found for this context'
        );
    }

    $enquiryMealId = (int)$ap['meal_plan_id_fk'];
    $mealMismatch  = ($enquiryMealId && $roomMealId && $enquiryMealId !== $roomMealId) ? 1 : 0;

    // ---------- 3) guset_count_details (enquiry pax info) ----------
    $plan = $this->db
        ->select('guset_count_details_id, pax_count_plan, adults, children, total_count')
        ->from('guset_count_details')
        ->where('guset_count_details_id', $ap['guset_count_details_id_fk'])
        ->where('guset_count_details_status', 1)
        ->limit(1)
        ->get()
        ->row_array();

    // ---------- 4) child_age_break_up (ages list) ----------
    $ages = $this->db
        ->select('age, count')
        ->from('child_age_break_up')
        ->where('guset_count_details_id_fk', $ap['guset_count_details_id_fk'])
        ->where('child_age_break_up_status', 1)
        ->get()
        ->result_array();

    // ---------- 5) Compute Applied counts (Adult / Child / Baby) ----------
    $adults   = $plan ? (int)$plan['adults'] : 0;
    $children = $plan ? (int)$plan['children'] : 0;
    $baby     = 0;

    // room policy values
    $welcomesAllAges = isset($room['properties_room_category_welcomes_child_all_ages'])
        ? strtoupper(trim($room['properties_room_category_welcomes_child_all_ages']))
        : 'N';

    $restrictedUnder = isset($room['properties_room_category_admission_restricted_guests_under_age'])
        ? (int)$room['properties_room_category_admission_restricted_guests_under_age']
        : 0;

    $complType = isset($room['properties_room_category_complimentary_guest_between_type'])
        ? strtoupper(trim($room['properties_room_category_complimentary_guest_between_type']))
        : 'N';

    $complFrom = isset($room['properties_room_category_complimentary_guest_between_from_year']);

    $complTo = isset($room['properties_room_category_complimentary_guest_between_to_year'])
        ? (int)$room['properties_room_category_complimentary_guest_between_to_year']
        : 0;

    $childType = isset($room['properties_room_category_child_rate_applied_guest_between_type'])
        ? strtoupper(trim($room['properties_room_category_child_rate_applied_guest_between_type']))
        : 'N';

    $childFrom = isset($room['properties_room_category_child_rate_applied_guest_from_year'])
        ? (int)$room['properties_room_category_child_rate_applied_guest_from_year']
        : 0;

    $childTo = isset($room['properties_room_category_child_rate_applied_guest_to_year'])
        ? (int)$room['properties_room_category_child_rate_applied_guest_to_year']
        : 0;

    $adultRateOver = isset($room['properties_room_category_adult_rate_applied_guest_over'])
        ? (int)$room['properties_room_category_adult_rate_applied_guest_over']
        : 0;

    // helper: age between
    $between = function($age, $from, $to) {
        return ($from > 0 && $to > 0 && $age >= $from && $age <= $to);
    };

    // Track how many child-age-breakup persons remain as "child"
    // Start with all breakup counts (some may shift to baby/adult)
    $ageChildTotal = 0;
    foreach ($ages as $row) {
        $ageChildTotal += (int)$row['count'];
    }

    // Rule processing:
    // We'll classify each age bucket:
    // - Baby (Rule 3)
    // - Child (Rule 4)
    // - Adult conversions (Rule 2, then Rule 1)
    $classifiedAsChild = 0; // stays child by rule 4 or by default

    foreach ($ages as $row) {

        $age = (int)$row['age'];
        $cnt = (int)$row['count'];

        // (3) Complimentary => Baby
        if ($complType === 'Y' && $between($age, $complFrom, $complTo)) {
            $baby += $cnt;
            continue;
        }

        // (4) Child rate applied => Child
        if ($childType === 'Y' && $between($age, $childFrom, $childTo)) {
            $classifiedAsChild += $cnt;
            continue;
        }

        // (2) Restricted under age => convert to Adult
        if ($welcomesAllAges === 'N' && $restrictedUnder > 0 && $age < $restrictedUnder) {
            $adults += $cnt;
            continue;
        }

        // otherwise undecided child bucket (could become adult by rule 1)
        $classifiedAsChild += $cnt;
    }

    // Now recompute children based on classification:
    // children should become: classifiedAsChild minus baby? (baby already separated)
    // If your stored plan->children includes baby ages, then we adjust it.
    // We assume plan->children includes all non-adult minors, so subtract baby.
    $children = $children - $baby;
    if ($children < 0) $children = 0;

    // Force children count to what the age breakup indicates if it exists
    // (Safer to rely on breakup)
    if ($ageChildTotal > 0) {
        // ageChildTotal includes all minors in breakup, subtract baby to get "kids+adult-shifts"
        $children = ($classifiedAsChild);
    }

    // (1) adult_rate_over = 0 => consider child as adult (only if conditions match)
    if ($adultRateOver === 0 && $welcomesAllAges === 'Y' && $restrictedUnder <= 0) {
        // Convert ALL remaining children to adults
        $adults += $children;
        $children = 0;
    }

    $applied = array(
        'adults' => (int)$adults,
        'children' => (int)$children,
        'baby' => (int)$baby
    );

    return array(
        'meal_plan_id_fk' => $enquiryMealId,
        'meal_plan_name' => $ap['meal_plan_name'] ? $ap['meal_plan_name'] : '',
        'room_meal_plan_id_fk' => $roomMealId,
        'room_meal_plan_name' => $room['room_meal_plan_name'] ? $room['room_meal_plan_name'] : '',
        'meal_plan_mismatch' => $mealMismatch,
        'room_is_ep_room_only' => $roomIsEP,
        'applied' => $applied,
        'plan' => $plan ? $plan : null,
        'child_age_break_up' => $ages ? $ages : array(),
        'room' => $room
    );
}

public function get_accommodation_day_options($lead_id, $package_id)
{
    return $this->db
        ->select('
            ap.accommodation_plan_id,
            ap.day_id_fk,
            ap.stay_destination_id_fk,
            ap.accommodation_date,
            d.packages_properties_days_day,
            s.state_name
        ')
        ->from('accommodation_plan ap')
        ->join('packages_properties_days d', 'd.packages_itinerary_days_id_fk = ap.day_id_fk', 'left')
        ->join('state s', 's.state_id = ap.stay_destination_id_fk', 'left')
        ->where('ap.lead_id_fk', $lead_id)
        ->where('ap.pacakage_id_fk', $package_id)
        ->where('ap.accommodation_plan_status', 1)
        ->where('ap.accomodation_required_staus', 'R')
        ->order_by('ap.day_id_fk', 'ASC')
        ->group_by('ap.day_id_fk', 'ASC')
        ->get()
        ->result_array();
        // echo $this->db->last_query();
		// exit();
}


public function get_property_inclusions_by_property($property_id)
{
    return $this->db
        ->select('property_inclusions_id, property_inclusions_name, property_inclusions_amount')
        ->from('property_inclusions')
        ->where('property_id_fk', $property_id)
        ->where('property_inclusions_status', 1)
        ->order_by('property_inclusions_name', 'ASC')
        ->get()
        ->result_array();
}

public function get_daywise_properties_for_inclusion($lead_id, $package_id, $day_id_fk, $stay_destination_id_fk, $accommodation_date, $packages_properties_common_id_fk)
{
    return $this->db
        ->distinct()
        ->select('p.properties_id as property_id, p.properties_name as property_name')
        ->from('accommodation_plan ap')
        ->join('packages_properties_days d', 'd.packages_itinerary_days_id_fk = ap.day_id_fk', 'left')
        ->join('packages_properties pd', 'd.packages_properties_days_id = pd.packages_properties_days_id_fk', 'left')
        ->join('properties p', 'p.properties_id = pd.properties_id_fk', 'left')
        ->where('ap.lead_id_fk', $lead_id)
        ->where('ap.pacakage_id_fk', $package_id)
        ->where('ap.day_id_fk', $day_id_fk)
        ->where('ap.stay_destination_id_fk', $stay_destination_id_fk)
        ->where('ap.accommodation_date', $accommodation_date)
        ->where('d.packages_properties_common_id_fk', $packages_properties_common_id_fk)
        ->where('ap.accommodation_plan_status', 1)
        ->where('pd.properties_id_fk >', 0)
        ->order_by('p.properties_name', 'ASC')
        ->get()
        ->result_array();
}

public function get_quotation_itinerary_day_id_by_package_day($quotation_id, $packages_itinerary_days_id_fk)
{
    $row = $this->db
        ->select('quotation_itinerary_days_id')
        ->from('quotation_itinerary_days')
        ->where('quotation_id_fk', (int)$quotation_id)
        ->where('packages_itinerary_days_id_fk', (int)$packages_itinerary_days_id_fk)
        ->where('quotation_itinerary_days_status', 1)
        ->get()
        ->row();

    return $row ? (int)$row->quotation_itinerary_days_id : 0;
}

public function get_packages_properties_day_id_by_itinerary_day($packages_itinerary_days_id_fk)
{
    $row = $this->db
        ->select('packages_properties_days_id')
        ->from('packages_properties_days')
        ->where('packages_itinerary_days_id_fk', (int)$packages_itinerary_days_id_fk)
        ->where('packages_properties_days_status', 1)
        ->get()
        ->row();

    return $row ? (int)$row->packages_properties_days_id : 0;
}

public function get_quotation_properties_day_id($quotation_id, $packages_properties_days_id_fk)
{
    $row = $this->db
        ->select('quotation_properties_days_id')
        ->from('quotation_properties_days')
        ->where('quotation_id_fk', (int)$quotation_id)
        ->where('packages_properties_days_id_fk', (int)$packages_properties_days_id_fk)
        ->where('quotation_properties_days_status', 1)
        ->get()
        ->row();

    return $row ? (int)$row->quotation_properties_days_id : 0;
}

public function update_quotation_property_inclusion_fk($id, $data)
{
    $this->db->where('quotation_property_inclusions_id', (int)$id);
    return $this->db->update('quotation_property_inclusions', $data);
}

public function update_quotation_special_requirement_fk($id, $data)
{
    $this->db->where('quotation_special_requirements_id', (int)$id);
    return $this->db->update('quotation_special_requirements', $data);
}

// public function get_daywise_properties_for_inclusion($lead_id, $package_id)
// {
//     return $this->db
//         ->select('
//             ap.property_day_id_fk,
//             ap.stay_destination_id_fk,
//             ap.accommodation_date,
//             p.properties_id as property_id,
//             p.properties_name as property_name
//         ')
//         ->from('accommodation_plan ap')
//         ->join('properties p', 'p.properties_id = ap.property_id_fk', 'left')
//         ->where('ap.lead_id_fk', $lead_id)
//         ->where('ap.pacakage_id_fk', $package_id)
//         ->where('ap.accommodation_plan_status', 1)
//         // ->where('ap.property_id_fk >', 0)
//         // ->order_by('ap.property_day_id_fk', 'ASC')
//         ->get()
//         ->result_array();
// }

public function get_special_requirements_list()
{
    return $this->db
        ->select('special_requirements_id, special_requirements_name, special_requirements_cost')
        ->from('special_requirements')
        ->where('special_requirements_status', 1)
        ->order_by('special_requirements_name', 'ASC')
        ->get()
        ->result_array();
}

/* ---------- Save helpers (used by ajax_add) ---------- */

public function add_property_inclusion($data)
{
    return $this->db->insert('quotation_property_inclusions', $data);
}

public function add_special_requirement($data)
{
    return $this->db->insert('quotation_special_requirements', $data);
}

public function add_quotation_room_tariff_details($data)
{
    $this->db->insert('quotation_room_tariff_details', $data);
    return $this->db->insert_id();
}

public function update_room_tariff_room_fk($quotation_room_tariff_details_id, $quotation_properties_room_id, $quotation_id)
{
    $this->db->where('quotation_room_tariff_details_id', (int)$quotation_room_tariff_details_id);
    return $this->db->update(
        'quotation_room_tariff_details',
        array(
            'quotation_properties_rooms_id_fk' => (int)$quotation_properties_room_id,
            'quotation_id_fk' => (int)$quotation_id
        )
    );
}

public function update_quotation_room_tariff_details($id, $data)
{
    $this->db->where('quotation_room_tariff_details_id', (int)$id);
    return $this->db->update('quotation_room_tariff_details', $data);
}

public function update_room_tariff_details_quotation_id($ids, $quotation_id)
{
    if (empty($ids) || !$quotation_id) {
        return false;
    }

    $this->db->where_in('quotation_room_tariff_details_id', $ids);
    return $this->db->update(
        'quotation_room_tariff_details',
        array('quotation_id_fk' => (int)$quotation_id)
    );
}

public function insert_room_tariff_details($data)
{
    $ok = $this->db->insert('quotation_room_tariff_details', $data);
    if (!$ok) return false;
    return $this->db->insert_id();
}


    public function getpackageid_underlead($leads_id)
    {
        $status=1;
        $this->db->select('package_id_fk');
        $this->db->from('leads');
        $this->db->where('leads_id', $leads_id);
        $query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
        return $query->row();
    }

    function fetch_package_under_leads($package_id, $sel='')
	{

	  $this->db->where('packages_id', $package_id);

	//   $this->db->where("crm_status",2);
	  $this->db->where("packages_status",1);

	  $this->db->order_by('packages_id', 'ASC');

	  $query = $this->db->get('packages');
//echo $this->db->last_query();exit;
	  $output = '<option value="">Please Select Template</option>';

	  foreach($query->result() as $row)

	  {

	  	$selected=''; if($sel==$row->packages_id) { $selected=' selected'; }

	   	$output .= '<option value="'.$row->packages_id.'" '.$selected.'>'.$row->packages_title.'</option>';

	  }

	  return $output;

	}

    public function fetch_package_property_category($package_id)
    {
        return $this->db
            ->select('packages_properties_common_id, packages_properties_common_category_name, packages_properties_common_design_type')
            ->from('packages_properties_common')
            ->where('packages_properties_common_packages_id_fk', $package_id)
            ->where('packages_properties_common_status', 1)
            ->order_by('packages_properties_common_id', 'ASC')
            ->get()
            ->result_array(); // array is better for JSON
    }

    public function fetch_packages_properties_days($packages_properties_common_id){

        return $this->db
            ->select('packages_properties_days_id,packages_properties_days_destination_id_fk,packages_properties_days_day, district_name')
            ->from('packages_properties_days')
            ->join('district', 'district.district_id = packages_properties_days.packages_properties_days_destination_id_fk','left')
            ->where('packages_properties_common_id_fk', $packages_properties_common_id)
            ->where('packages_properties_days_status', 1)
            ->order_by('packages_properties_days_id ', 'ASC')
            ->get()
            ->result_array(); // array is better for JSON
    }

    public function fetch_packages_properties($packages_properties_days_id){

        return $this->db
            ->select('packages_properties_id,properties_id,properties_name')
            ->from('packages_properties')
            ->join('properties', 'properties.properties_id = packages_properties.properties_id_fk','left')
            ->where('packages_properties_days_id_fk', $packages_properties_days_id)
            ->where('packages_properties_status', 1)
            ->order_by('packages_properties_id ', 'ASC')
            ->get()
            ->result_array(); // array is better for JSON
    }

    public function fetch_packages_properties_rooms($packages_properties_id){

        return $this->db
            ->select('packages_properties_rooms_id,properties_room_category_id,properties_room_category_name')
            ->from('packages_properties_rooms')
            ->join('properties_room_category', 'properties_room_category.properties_room_category_id = packages_properties_rooms.packages_properties_rooms_id_fk','left')
            ->where('packages_properties_id_fk', $packages_properties_id)
            ->where('packages_properties_rooms_status', 1)
            ->order_by('packages_properties_rooms_id ', 'ASC')
            ->get()
            ->result_array(); // array is better for JSON
    }

    public function load_properties(){

        return $this->db
            ->select('properties_id,properties_name')
            ->from('properties')
            ->where('properties_status', 1)
            ->order_by('properties_id ', 'ASC')
            ->get()
            ->result_array(); // array is better for JSON
    }

    public function load_rooms($properties_id_fk){

        return $this->db
            ->select('properties_room_category_id,properties_room_category_name')
            ->from('properties_room_category')
            ->where('properties_room_category_status', 1)
            ->where('properties_id_fk', $properties_id_fk)
            ->order_by('properties_room_category_id ', 'ASC')
            ->get()
            ->result_array(); // array is better for JSON
    }

    /* ================= COPY PACKAGE DATA TO QUOTATION ================= */

    public function get_package_basic_details($package_id)
    {
        return $this->db
            ->select('
                packages_id,
                packages_title,
                packages_first_cover_page,
                packages_last_cover_page,
                packages_inclusion_exclusion_common_id_fk,
                packages_inclusion_exclusion_checked_type,
                packages_optional_add_on_checked_type,
                packages_payment_policies_checked_type,
                packages_terms_conditions_checked_type,
                packages_cancellation_policy_checked_type,
                packages_notes_checked_type
            ')
            ->from('packages')
            ->where('packages_id', $package_id)
            ->where('packages_status', 1)
            ->get()
            ->row();
    }

    
    public function copy_package_itinerary_to_quotation($quotation_id, $package_id)
    {
        // 1) Itinerary master
        $rows = $this->db
            ->select('packages_itinerary_id, itineraries_id_fk')
            ->from('packages_itinerary')
            ->where('packages_id_fk', (int)$package_id)
            ->where('packages_itinerary_status', 1)
            ->get()->result_array();

        if (!$rows) return [];

        // Insert quotation_itinerary
        $insert = [];
        foreach ($rows as $r) {
            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_itinerary_id_fk' => (int)$r['packages_itinerary_id'],
                'quotation_itineraries_id_fk' => (int)$r['itineraries_id_fk'],
                'quotation_itinerary_status' => 1
            ];
        }
        $this->db->insert_batch('quotation_itinerary', $insert);

        // Return mapping packages_itinerary_id => quotation_itinerary_id
        $map = [];
        $qRows = $this->db
            ->select('quotation_itinerary_id, packages_itinerary_id_fk')
            ->from('quotation_itinerary')
            ->where('quotation_id_fk', (int)$quotation_id)
            ->where('quotation_itinerary_status', 1)
            ->get()->result_array();

        foreach ($qRows as $qr) {
            $map[(int)$qr['packages_itinerary_id_fk']] = (int)$qr['quotation_itinerary_id'];
        }

        return $map;
    }

    // public function copy_package_itinerary_days_to_quotation($quotation_id, $package_itinerary_to_quotation_map)
    // {
    //     if (!$package_itinerary_to_quotation_map) return;

    //     // packages itinerary ids
    //     $pkgItineraryIds = array_keys($package_itinerary_to_quotation_map);

    //     // Fetch package itinerary days
    //     $rows = $this->db
    //         ->select('packages_itinerary_days_id, packages_itinerary_id_fk, itineraries_days_id_fk,
    //                   packages_itineraries_days_day, packages_itineraries_days_destination_id_fk,
    //                   packages_itineraries_days_title, packages_itineraries_days_description')
    //         ->from('packages_itinerary_days')
    //         ->where_in('packages_itinerary_id_fk', $pkgItineraryIds)
    //         ->where('packages_itinerary_days_status', 1)
    //         ->get()->result_array();

    //     if (!$rows) return;

    //     // Insert quotation_itinerary_days
    //     $insert = [];
    //     foreach ($rows as $r) {
    //         $pkgItId = (int)$r['packages_itinerary_id_fk'];
    //         $quotation_itinerary_id = isset($package_itinerary_to_quotation_map[$pkgItId])
    //             ? (int)$package_itinerary_to_quotation_map[$pkgItId]
    //             : 0;

    //         if (!$quotation_itinerary_id) continue;

    //         $insert[] = [
    //             'quotation_id_fk' => (int)$quotation_id,
    //             'packages_itinerary_days_id_fk' => (int)$r['packages_itinerary_days_id'],
    //             'quotation_itinerary_id_fk' => (int)$quotation_itinerary_id,
    //             'quotation_days_id_fk' => (int)$r['itineraries_days_id_fk'], // if this is your "quotation_days" master, keep it
    //             'quotation_itineraries_days_day' => $r['packages_itineraries_days_day'],
    //             'quotation_itineraries_days_destination_id_fk' => (int)$r['packages_itineraries_days_destination_id_fk'],
    //             'quotation_itineraries_days_title' => $r['packages_itineraries_days_title'],
    //             'quotation_itineraries_days_description' => $r['packages_itineraries_days_description'],
    //             'quotation_itinerary_days_status' => 1
    //         ];
    //     }

    //     if ($insert) $this->db->insert_batch('quotation_itinerary_days', $insert);
    // }

    private function copy_package_day_image_to_quotation($filename)
    {
        if (!$filename) return '';

        $src = FCPATH . 'uploads/package_day_images/' . $filename;
        if (!file_exists($src)) return '';

        $ext = pathinfo($filename, PATHINFO_EXTENSION);
        $newName = uniqid('quotation_day_') . '.' . $ext;
        $dest = FCPATH . 'uploads/quotation_day_images/' . $newName;

        if (@copy($src, $dest)) {
            return $newName;
        }

        return '';
    }
    
    public function get_quotation_itinerary_day_id($quotation_id, $packages_itinerary_days_id_fk)
    {
        $row = $this->db
            ->select('quotation_itinerary_days_id')
            ->from('quotation_itinerary_days')
            ->where('quotation_id_fk', $quotation_id)
            ->where('packages_itinerary_days_id_fk', $packages_itinerary_days_id_fk)
            ->where('quotation_itinerary_days_status', 1)
            ->get()
            ->row();
// echo $this->db->last_query();exit();
        return $row ? (int)$row->quotation_itinerary_days_id : 0;
    }

    public function copy_package_itinerary_days_to_quotation($quotation_id, $package_itinerary_to_quotation_map)
    {
        if (!$package_itinerary_to_quotation_map) return;

        $pkgItineraryIds = array_keys($package_itinerary_to_quotation_map);

        $rows = $this->db
            ->select('
                packages_itinerary_days_id,
                packages_itinerary_id_fk,
                itineraries_days_id_fk,
                packages_itineraries_days_day,
                packages_itineraries_days_destination_id_fk,
                packages_itineraries_days_title,
                packages_itineraries_days_description,
                packages_itineraries_days_image,
                packages_itineraries_days_travel_back,
                packages_itineraries_days_required_status
            ')
            ->from('packages_itinerary_days')
            ->where_in('packages_itinerary_id_fk', $pkgItineraryIds)
            ->where('packages_itinerary_days_status', 1)
            ->get()->result_array();

        if (!$rows) return;

        $insert = [];

        foreach ($rows as $r) {

            $pkgItId = (int)$r['packages_itinerary_id_fk'];
            $quotation_itinerary_id = isset($package_itinerary_to_quotation_map[$pkgItId])
                ? (int)$package_itinerary_to_quotation_map[$pkgItId]
                : 0;

            if (!$quotation_itinerary_id) continue;

            $newImage = '';
            if (!empty($r['packages_itineraries_days_image'])) {
                $newImage = $this->copy_package_day_image_to_quotation($r['packages_itineraries_days_image']);
            }

            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_itinerary_days_id_fk' => (int)$r['packages_itinerary_days_id'],
                'quotation_itinerary_id_fk' => (int)$quotation_itinerary_id,
                'quotation_days_id_fk' => (int)$r['itineraries_days_id_fk'],
                'quotation_itineraries_days_day' => $r['packages_itineraries_days_day'],
                'quotation_itineraries_days_destination_id_fk' => (int)$r['packages_itineraries_days_destination_id_fk'],
                'quotation_itineraries_days_title' => $r['packages_itineraries_days_title'],
                'quotation_itineraries_days_description' => $r['packages_itineraries_days_description'],
                'quotation_itineraries_days_image' => $newImage,
                'quotation_itineraries_days_travel_back' => $r['packages_itineraries_days_travel_back'],
                'quotation_itineraries_days_required_status' => $r['packages_itineraries_days_required_status'],
                'quotation_itinerary_days_status' => 1
            ];
        }

        if ($insert) {
            $this->db->insert_batch('quotation_itinerary_days', $insert);
        }
    }

    public function copy_packages_inclusions($quotation_id, $package_id)
    {
        $rows = $this->db
            ->select('packages_inclusions_id, inclusion_common_id_fk, inclusions_id_fk, packages_inclusions_type, packages_inclusions_details')
            ->from('packages_inclusions')
            ->where('packages_id_fk', (int)$package_id)
            ->where('packages_inclusions_status', 1)
            ->get()->result_array();

        if (!$rows) return;

        $insert = [];
        foreach ($rows as $r) {
            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_inclusions_id_fk' => (int)$r['packages_inclusions_id'],
                'quotation_inclusion_common_id_fk' => (int)$r['inclusion_common_id_fk'],
                'quotation_inclusions_id_fk' => (int)$r['inclusions_id_fk'],
                'quotation_inclusions_type' => $r['packages_inclusions_type'],
                'quotation_inclusions_details' => $r['packages_inclusions_details'],
                'quotation_inclusions_status' => 1
            ];
        }
        $this->db->insert_batch('quotation_inclusions', $insert);
    }

    public function copy_packages_exclusions($quotation_id, $package_id)
    {
        $rows = $this->db
            ->select('packages_exclusions_id, exclusions_common_id_fk, exclusions_id_fk, packages_exclusions_type, packages_exclusions_details')
            ->from('packages_exclusions')
            ->where('packages_id_fk', (int)$package_id)
            ->where('packages_exclusions_status', 1)
            ->get()->result_array();

        if (!$rows) return;

        $insert = [];
        foreach ($rows as $r) {
            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_exclusions_id_fk' => (int)$r['packages_exclusions_id'],
                'quotation_exclusions_common_id_fk' => (int)$r['exclusions_common_id_fk'],
                'quotation_exclusions_id_fk' => (int)$r['exclusions_id_fk'],
                'quotation_exclusions_type' => $r['packages_exclusions_type'],
                'quotation_exclusions_details' => $r['packages_exclusions_details'],
                'quotation_exclusion_status' => 1
            ];
        }
        $this->db->insert_batch('quotation_exclusion', $insert);
    }

    public function copy_packages_optional_add_on($quotation_id, $package_id)
    {
        $rows = $this->db
            ->select('packages_optional_add_on_id, packages_optional_add_on_details')
            ->from('packages_optional_add_on')
            ->where('packages_optional_add_on_packages_id_fk', (int)$package_id)
            ->where('packages_optional_add_on_status', 1)
            ->get()->result_array();

        if (!$rows) return;

        $insert = [];
        foreach ($rows as $r) {
            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_optional_add_on_id_fk' => (int)$r['packages_optional_add_on_id'],
                'quotation_optional_add_on_details' => $r['packages_optional_add_on_details'],
                'quotation_optional_add_on_status' => 1
            ];
        }
        $this->db->insert_batch('quotation_optional_add_on', $insert);
    }

    public function copy_packages_payment_policies($quotation_id, $package_id)
    {
        $rows = $this->db
            ->select('packages_payment_policies_id, payment_policies_id_fk, payment_policies_items_id_fk,
                      packages_payment_policies_type, packages_payment_policies_details')
            ->from('packages_payment_policies')
            ->where('packages_payment_policies_packages_id_fk', (int)$package_id)
            ->where('packages_payment_policies_status', 1)
            ->get()->result_array();

        if (!$rows) return;

        $insert = [];
        foreach ($rows as $r) {
            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_payment_policies_id_fk' => (int)$r['packages_payment_policies_id'],
                'quotation_policies_id_fk' => (int)$r['payment_policies_id_fk'],
                'quotation_policies_items_id_fk' => (int)$r['payment_policies_items_id_fk'],
                'quotation_payment_policies_type' => $r['packages_payment_policies_type'],
                'quotation_payment_policies_details' => $r['packages_payment_policies_details'],
                'quotation_payment_policies_status' => 1
            ];
        }
        $this->db->insert_batch('quotation_payment_policies', $insert);
    }

    public function copy_packages_terms_condition($quotation_id, $package_id)
    {
        $rows = $this->db
            ->select('packages_terms_condition_id, terms_condition_id_fk, terms_condition_item_id_fk,
                      packages_terms_condition_type, packages_terms_condition_details')
            ->from('packages_terms_condition')
            ->where('packages_terms_condition_packages_id_fk', (int)$package_id)
            ->where('packages_terms_condition_status', 1)
            ->get()->result_array();

        if (!$rows) return;

        $insert = [];
        foreach ($rows as $r) {
            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_terms_condition_id_fk' => (int)$r['packages_terms_condition_id'],
                'quotation_terms_condition_id_fk' => (int)$r['terms_condition_id_fk'],
                'quotation_terms_condition_item_id_fk' => (int)$r['terms_condition_item_id_fk'],
                'quotation_terms_condition_type' => $r['packages_terms_condition_type'],
                'quotation_terms_condition_details' => $r['packages_terms_condition_details'],
                'quotation_terms_condition_status' => 1
            ];
        }
        $this->db->insert_batch('quotation_terms_condition', $insert);
    }

    public function copy_packages_cancellation_policies($quotation_id, $package_id)
    {
        $rows = $this->db
            ->select('packages_cancellation_policies_id, cancellation_policies_id_fk, cancellation_policies_item_id_fk,
                      packages_cancellation_policies_type, packages_cancellation_policies_details')
            ->from('packages_cancellation_policies')
            ->where('packages_cancellation_policies_packages_id_fk', (int)$package_id)
            ->where('packages_cancellation_policies_status', 1)
            ->get()->result_array();

        if (!$rows) return;

        $insert = [];
        foreach ($rows as $r) {
            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_cancellation_policies_id_fk' => (int)$r['packages_cancellation_policies_id'],
                'quotation_cancellation_policies_id_fk' => (int)$r['cancellation_policies_id_fk'],
                'quotation_cancellation_policies_item_id_fk' => (int)$r['cancellation_policies_item_id_fk'],
                'quotation_cancellation_policies_type' => $r['packages_cancellation_policies_type'],
                'quotation_cancellation_policies_details' => $r['packages_cancellation_policies_details'],
                'quotation_cancellation_policies_status' => 1
            ];
        }
        $this->db->insert_batch('quotation_cancellation_policies', $insert);
    }

    public function copy_packages_notes($quotation_id, $package_id)
    {
        $rows = $this->db
            ->select('packages_notes_id, packages_notes_details')
            ->from('packages_notes')
            ->where('packages_notes_packages_id_fk', (int)$package_id)
            ->where('packages_notes_status', 1)
            ->get()->result_array();

        if (!$rows) return;

        $insert = [];
        foreach ($rows as $r) {
            $insert[] = [
                'quotation_id_fk' => (int)$quotation_id,
                'packages_notes_id_fk' => (int)$r['packages_notes_id'],
                'quotation_notes_details' => $r['packages_notes_details'],
                'quotation_notes_status' => 1
            ];
        }
        $this->db->insert_batch('quotation_notes', $insert);
    }

    /* ================= QUOTATION BASIC ================= */
    public function get_quotation($id)
    {
        return $this->db
            ->where('quotation_id', $id)
            ->get('quotation')
            ->row();
    }

    /* ================= QUOTATION ITINERARY DAYS =================
    Uses: quotation_itinerary_days -> destination state table (or district table if you use that)
    */
    // public function get_quotation_itinerary_days($quotation_id)
    // {
    //     return $this->db
    //         ->select('d.*, s.state_name')
    //         ->from('quotation_itinerary_days d')
    //         ->join('state s', 's.state_id = d.quotation_itineraries_days_destination_id_fk', 'left')
    //         ->where('d.quotation_id_fk', $quotation_id)
    //         ->order_by('d.quotation_itineraries_days_day', 'ASC')
    //         ->get()->result();
    // }

    /* ================= QUOTATION INCLUSIONS ================= */
    // public function get_quotation_inclusions($quotation_id)
    // {
    //     return $this->db
    //         ->where('quotation_id_fk', $quotation_id)
    //         ->where('quotation_inclusions_type', 'Y')
    //         ->get('quotation_inclusions')
    //         ->result();
    // }

    /* ================= QUOTATION EXCLUSIONS ================= */
    // public function get_quotation_exclusions($quotation_id)
    // {
    //     return $this->db
    //         ->where('quotation_id_fk', $quotation_id)
    //         ->where('quotation_exclusions_type', 'Y')
    //         ->get('quotation_exclusion')
    //         ->result();
    // }

    /* ================= QUOTATION OPTIONAL ADD-ONS ================= */
    // public function get_quotation_optional_addons($quotation_id)
    // {
    //     return $this->db
    //         ->where('quotation_id_fk', $quotation_id)
    //         ->get('quotation_optional_add_on')
    //         ->result();
    // }

    /* ================= QUOTATION PAYMENT POLICIES ================= */
    // public function get_quotation_payment_policies($quotation_id)
    // {
    //     return $this->db
    //         ->where('quotation_id_fk', $quotation_id)
    //         ->get('quotation_payment_policies')
    //         ->result();
    // }

    /* ================= QUOTATION TERMS ================= */
    // public function get_quotation_terms($quotation_id)
    // {
    //     return $this->db
    //         ->where('quotation_id_fk', $quotation_id)
    //         ->get('quotation_terms_condition')
    //         ->result();
    // }

    /* ================= QUOTATION CANCELLATION ================= */
    public function get_quotation_cancellation($quotation_id)
    {
        return $this->db
            ->where('quotation_id_fk', $quotation_id)
            ->get('quotation_cancellation_policies')
            ->result();
    }

    /* ================= QUOTATION NOTES ================= */
    // public function get_quotation_notes($quotation_id)
    // {
    //     return $this->db
    //         ->where('quotation_id_fk', $quotation_id)
    //         ->get('quotation_notes')
    //         ->result();
    // }

    /* ================= OPTIONS + DAYS + PROPERTIES + ROOMS TREE ================= */
    public function get_quotation_options_full($quotation_id)
    {
        $options = $this->db
            ->select('o.*, c.packages_properties_common_category_name')
            ->from('quotation_options o')
            ->join('packages_properties_common c',
                'c.packages_properties_common_id=o.packages_properties_common_id_fk',
                'left'
            )
            ->where('o.quotation_id_fk', $quotation_id)
            ->order_by('o.quotation_options_id', 'ASC')
            ->get()->result();

        foreach ($options as &$opt) {

            // Days
            $opt->days = $this->db
                ->select('d.*, s.state_name')
                ->from('quotation_properties_days d')
                ->join('state s', 's.state_id = d.quotation_properties_days_destination_id_fk', 'left')
                ->where('d.quotation_options_id_fk', $opt->quotation_options_id)
                ->order_by('d.quotation_properties_days_day', 'ASC')
                ->get()->result();

            foreach ($opt->days as &$day) {

                // Properties
                $day->properties = $this->db
                    ->select('qp.quotation_properties_id, p.properties_name')
                    ->from('quotation_properties qp')
                    ->join('properties p', 'p.properties_id=qp.properties_id_fk', 'left')
                    ->where('qp.quotation_properties_days_id_fk', $day->quotation_properties_days_id)
                    ->get()->result();

                foreach ($day->properties as &$prop) {

                    // Rooms (room name from properties_room_category)
                    // NOTE: You wrote packages_properties_rooms_id_fk is the room category id.
                    $prop->rooms = $this->db
                        ->select('qr.total_room_cost, r.properties_room_category_name')
                        ->from('quotation_properties_rooms qr')
                        ->join('properties_room_category r',
                            'r.properties_room_category_id = qr.packages_properties_rooms_id_fk',
                            'left'
                        )
                        ->where('qr.quotation_properties_id_fk', $prop->quotation_properties_id)
                        ->get()->result();
                }
            }
        }

        return $options;
    }

    /* ================= QUOTATION SPECIAL REQUIREMENTS ================= */
    // public function get_quotation_special_requirements($quotation_id)
    // {
    //     return $this->db
    //         ->select('s.special_requirements_name, q.quotation_special_requirements_cost')
    //         ->from('quotation_special_requirements q')
    //         ->join('special_requirements s',
    //             's.special_requirements_id=q.quotation_special_requirements_id_fk',
    //             'left'
    //         )
    //         ->where('q.quotation_id_fk', $quotation_id)
    //         ->get()->result();
    // }

    /* ================= QUOTATION PROPERTY INCLUSIONS ================= */
    // public function get_quotation_property_inclusions($quotation_id)
    // {
    //     return $this->db
    //         ->where('quotation_id_fk', $quotation_id)
    //         ->get('quotation_property_inclusions')
    //         ->result();
    // }

    /* =========================
     QUOTATION ITINERARY
       ========================= */
    public function get_quotation_itinerary($id)
    {
        // return $this->db->where('quotation_id', (int)$id)->get('quotation')->row_array();
        return $this->db
        ->select('q.*,qp.quotation_policies_id_fk,qt.quotation_terms_condition_id_fk,qc.quotation_cancellation_policies_id_fk')
        ->from('quotation q')
        ->join('quotation_payment_policies qp', 'q.quotation_id = qp.quotation_id_fk', 'left')
        ->join('quotation_terms_condition qt', 'q.quotation_id = qt.quotation_id_fk', 'left')
        ->join('quotation_cancellation_policies qc', 'q.quotation_id = qc.quotation_id_fk', 'left')
        ->where('q.quotation_id', $id)
        ->group_by('q.quotation_id')
        ->get()
        ->row_array();
    }

    
    public function save_trip($data)
	{
		$this->db->insert($this->table3, $data);
		return $this->db->insert_id();
	}

    public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	
    public function save1($data)
	{
		$this->db->insert($this->table1, $data);
		return $this->db->insert_id();
	}

	public function get_by_id_trip($id)
	{
		$this->db->select('*');
		$this->db->from('quotation');
		$this->db->join('leads', 'leads.leads_id = quotation.leads_id_fk','left');
		$this->db->where("quotation_status",1);
		$this->db->where('quotation_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
    // public function get_by_id($id)
    // {
    //     // $this->db->from($this->table);
    //     $this->db->select('*,DATE_FORMAT(quotation_date,\'%d-%m-%Y\') as quotation_date');
    //     $this->db->from('quotation');
    //     $this->db->where("quotation_status", 1);
    //     $this->db->where('quotation_id', $id);
    //     $query = $this->db->get();

    //     return $query->row_array();
    // }

    public function get_by_id($id)
{
    return $this->db
        ->select('q.*, l.leads_number, l.guest_name,,DATE_FORMAT(quotation_date,\'%d-%m-%Y\') as quotation_date')
        ->from('quotation q')
        ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
        ->where('q.quotation_status', 1)
        ->where('q.quotation_id', $id)
        ->get()
        ->row();
}

    public function get_full_quotation_options($quotation_id)
    {
        $options = $this->db
            ->select('qo.*')
            ->from('quotation_options qo')
            ->where('qo.quotation_id_fk', $quotation_id)
            ->where('qo.quotation_options_status', 1)
            ->order_by('qo.quotation_options_id', 'ASC')
            ->get()
            ->result_array();

        foreach ($options as &$option) {

            // $days = $this->db
            //     ->select('qpd.*, s.state_name, pid.packages_itinerary_days_id as day_id')
            //     ->from('quotation_properties_days qpd')
            //     ->join('state s', 's.state_id = qpd.quotation_properties_days_destination_id_fk', 'left')
            //     ->join('packages_itinerary_days pid', 'pid.packages_itinerary_days_id = qpd.packages_properties_days_id_fk', 'left')
            //     ->where('qpd.quotation_id_fk', $quotation_id)
            //     ->where('qpd.quotation_options_id_fk', $option['quotation_options_id'])
            //     ->where('qpd.quotation_properties_days_status', 1)
            //     ->order_by('qpd.quotation_properties_days_id', 'ASC')
            //     ->get()
            //     ->result_array();

            $days = $this->db
            ->select('
                qpd.*,
                s.state_name,
                ppd.packages_itinerary_days_id_fk as packages_itinerary_days_id_fk
            ')
            ->from('quotation_properties_days qpd')
            ->join('state s', 's.state_id = qpd.quotation_properties_days_destination_id_fk', 'left')
            ->join('packages_properties_days ppd', 'ppd.packages_properties_days_id = qpd.packages_properties_days_id_fk', 'left')
            ->where('qpd.quotation_id_fk', $quotation_id)
            ->where('qpd.quotation_options_id_fk', $option['quotation_options_id'])
            ->where('qpd.quotation_properties_days_status', 1)
            ->order_by('qpd.quotation_properties_days_id', 'ASC')
            ->get()
            ->result_array();

            foreach ($days as &$day) {

                $properties = $this->db
                    ->select('qp.*, p.properties_name')
                    ->from('quotation_properties qp')
                    ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')
                    ->where('qp.quotation_properties_days_id_fk', $day['quotation_properties_days_id'])
                    ->where('qp.quotation_properties_status', 1)
                    ->order_by('qp.quotation_properties_id', 'ASC')
                    ->get()
                    ->result_array();

                foreach ($properties as &$property) {

                    $rooms = $this->db
                        ->select('qpr.*, prc.properties_room_category_name, qrtd.quotation_room_tariff_details_id,
                                qrtd.auto_total_rate, qrtd.manual_total_rate')
                        ->from('quotation_properties_rooms qpr')
                        ->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')
                        ->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id AND qrtd.quotation_id_fk = '.$this->db->escape($quotation_id), 'left')
                        ->where('qpr.quotation_properties_id_fk', $property['quotation_properties_id'])
                        ->where('qpr.quotation_properties_rooms_status', 1)
                        ->order_by('qpr.quotation_properties_rooms_id', 'ASC')
                        ->get()
                        ->result_array();

                    $property['rooms'] = $rooms;
                }

                $day['properties'] = $properties;
            }

            $option['days'] = $days;
        }

        return $options;
    }

    public function get_quotation_property_inclusions($quotation_id)
    {
        return $this->db
            ->select('qpi.*')
            ->from('quotation_property_inclusions qpi')
            ->where('qpi.quotation_id_fk', $quotation_id)
            ->where('qpi.quotation_property_inclusions_status', 1)
            ->order_by('qpi.quotation_property_inclusions_id', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_quotation_special_requirements($quotation_id)
    {
        return $this->db
            ->select('qsr.*')
            ->from('quotation_special_requirements qsr')
            ->where('qsr.quotation_id_fk', $quotation_id)
            ->where('qsr.quotation_special_requirements_status', 1)
            ->order_by('qsr.quotation_special_requirements_id', 'ASC')
            ->get()
            ->result_array();
    }

    public function get_quotation_preview_data($quotation_id)
    {
        $quotation = $this->db
            ->select('q.*, l.start_date, l.end_date, l.leads_id, l.guest_name')
            ->from('quotation q')
            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')
            ->where('q.quotation_id', $quotation_id)
            ->where('q.quotation_status', 1)
            ->get()
            ->row();

        if (!$quotation) {
            return array();
        }

        return array(
            'quotation'           => $quotation,
            'brief_itinerary'     => $this->get_quotation_brief_itinerary($quotation_id),
            'itinerary'           => $this->get_quotation_itinerary_days($quotation_id),
            'options'             => $this->get_quotation_preview_options($quotation_id),
            'guest_total'         => $this->get_guest_total($quotation->leads_id_fk),
            'travel_date_text'    => $this->format_travel_date_range($quotation->start_date, $quotation->end_date),
            'inclusions' => $this->get_quotation_inclusions($quotation_id),
            'exclusions' => $this->get_quotation_exclusions($quotation_id),
            'payment'             => $this->get_quotation_payment_policies($quotation_id),
            'cancel'              => $this->get_quotation_cancellation_policies($quotation_id),
            'optional_addons'     => $this->get_quotation_optional_addons($quotation_id),
            'terms'               => $this->get_quotation_terms($quotation_id),
            'notes'               => $this->get_quotation_notes($quotation_id),
            'property_inclusions' => $this->get_quotation_property_inclusions_preview($quotation_id),
            'account_details'     => $this->get_default_account_details(),
        );
    }

    public function get_default_account_details()
    {
        return $this->db
            
            ->get('account_details')->row();
    }

    public function get_quotation_inclusions($quotation_id)
    {
        return $this->db
            ->from('quotation_inclusions')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_inclusions_status', 1)
            ->get()
            ->result();
    }

    public function get_quotation_exclusions($quotation_id)
    {
        return $this->db
            ->from('quotation_exclusion')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_exclusion_status', 1)
            ->get()
            ->result();
    }

    public function get_quotation_brief_itinerary($quotation_id)
    {
        return $this->db
            ->select('quotation_itinerary_days_id, quotation_itineraries_days_day, quotation_itineraries_days_title')
            ->from('quotation_itinerary_days')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_itinerary_days_status', 1)
            ->order_by('quotation_itinerary_days_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_quotation_itinerary_days($quotation_id)
    {
        return $this->db
            ->select('qid.*, s.state_name')
            ->from('quotation_itinerary_days qid')
            ->join('state s', 's.state_id = qid.quotation_itineraries_days_destination_id_fk', 'left')
            ->where('qid.quotation_id_fk', $quotation_id)
            ->where('qid.quotation_itinerary_days_status', 1)
            ->order_by('qid.quotation_itinerary_days_id', 'ASC')
            ->get()
            ->result();
    }

    // public function get_guest_total($lead_id)
    // {
    //     $row = $this->db
    //         ->select_sum('guset_count_total')
    //         ->from('guset_count')
    //         ->where('guset_count_lead_id_fk', $lead_id)
    //         ->where('guset_count_status', 1)
    //         ->get()
    //         ->row();

    //     return $row && $row->guset_count_total ? (int)$row->guset_count_total : 0;
    // }

public function get_guest_total($lead_id)
{
    $row = $this->db
        ->select('
            SUM(gcd.adults) as total_adults,
            SUM(gcd.children) as total_children,
            SUM(gc.guset_count_total) as total_guests
        ')
        ->from('guset_count gc')
        ->join('guset_count_details gcd', 'gcd.guset_count_id_fk = gc.guset_count_id', 'left')
        ->where('gc.guset_count_lead_id_fk', (int)$lead_id)
        ->where('gc.guset_count_status', 1)
        ->where('gcd.guset_count_details_status', 1)
        ->get()
        ->row();

    return array(
        'total'    => !empty($row->total_guests) ? (int)$row->total_guests : 0,
        'adults'   => !empty($row->total_adults) ? (int)$row->total_adults : 0,
        'children' => !empty($row->total_children) ? (int)$row->total_children : 0
    );
}

    // public function format_travel_date_range($start_date, $end_date)
    // {
    //     if (empty($start_date) || empty($end_date)) return '';

    //     $start = date('d M', strtotime($start_date));
    //     $end   = date('d M Y', strtotime($end_date));

    //     return $start . ' - ' . $end;
    // }
    
    public function format_travel_date_range($start_date, $end_date) 
{
    if (empty($start_date) || empty($end_date)) return '';

    // add 1 day for travel back date
    $end_date_plus_one = date('Y-m-d', strtotime($end_date . ' +1 day'));

    $start = date('d M', strtotime($start_date));
    $end   = date('d M Y', strtotime($end_date_plus_one));

    return $start . ' - ' . $end;
}
    

    public function get_quotation_preview_options($quotation_id)
{
    $quotation = $this->db
        ->select('total_inclusion_amount, total_special_requirment_amount')
        ->from('quotation')
        ->where('quotation_id', $quotation_id)
        ->where('quotation_status', 1)
        ->get()
        ->row();

    $quotation_total_inclusion = !empty($quotation->total_inclusion_amount)
        ? (float)$quotation->total_inclusion_amount
        : 0;

    $quotation_total_special = !empty($quotation->total_special_requirment_amount)
        ? (float)$quotation->total_special_requirment_amount
        : 0;

    $options = $this->db
        ->select('qo.*, v.vehicle_name, v.vehicle_number_seat, v.vehicle_description')
        ->from('quotation_options qo')
        ->join('vehicle v', 'v.vehicle_id = qo.quotation_options_vehicle_id_fk', 'left')
        ->where('qo.quotation_id_fk', $quotation_id)
        ->where('qo.quotation_options_status', 1)
        ->order_by('qo.quotation_options_id', 'ASC')
        ->get()
        ->result();

    foreach ($options as &$option) {

        $option->days = $this->db
            ->select('qpd.*, s.state_name')
            ->from('quotation_properties_days qpd')
            ->join('state s', 's.state_id = qpd.quotation_properties_days_destination_id_fk', 'left')
            ->where('qpd.quotation_id_fk', $quotation_id)
            ->where('qpd.quotation_options_id_fk', $option->quotation_options_id)
            ->where('qpd.quotation_properties_days_status', 1)
            ->order_by('qpd.quotation_properties_days_id', 'ASC')
            ->get()
            ->result();

        foreach ($option->days as &$day) {

            $day->rows = $this->db
                ->select('qp.*, p.properties_name')
                ->from('quotation_properties qp')
                ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')
                ->where('qp.quotation_properties_days_id_fk', $day->quotation_properties_days_id)
                ->where('qp.quotation_properties_status', 1)
                ->get()
                ->result();

            foreach ($day->rows as &$prop) {
                $rooms = $this->db
                    ->select('qpr.*, prc.properties_room_category_name')
                    ->from('quotation_properties_rooms qpr')
                    ->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')
                    ->where('qpr.quotation_properties_id_fk', $prop->quotation_properties_id)
                    ->where('qpr.quotation_properties_rooms_status', 1)
                    ->get()
                    ->result();

                $prop->rooms = array();
                foreach ($rooms as $r) {
                    $prop->rooms[] = $r->properties_room_category_name;
                }
            }

            $day->meal_plan = $this->get_day_meal_plan_from_accommodation($quotation_id, $day->packages_properties_days_id_fk);
        }

        // ✅ correct total
        $option->preview_total_amount =
            (float)$option->quotation_options_total_quote_rate +
            $quotation_total_inclusion +
            $quotation_total_special;

        // $option->complimentary = $this->get_option_property_inclusions($quotation_id);

        $option->complimentary = $this->get_option_property_inclusions(
    $quotation_id,
    $option->quotation_options_id
);

$optionInclusionAmount = 0;
foreach ($option->complimentary as $inc) {
    $optionInclusionAmount += (float)$inc->inclusion_amount;
}

$option->special_requirements = $this->get_quotation_special_requirements_preview($quotation_id);

$optionSpecialAmount = 0;
foreach ($option->special_requirements as $sr) {
    $optionSpecialAmount += (float)$sr->quotation_special_requirements_cost;
}

$option->preview_total_amount =
    (float)$option->quotation_options_total_quote_rate +
    $optionInclusionAmount +
    $optionSpecialAmount;
    }

    return $options;
}


    // public function get_day_meal_plan_from_accommodation($quotation_id, $packages_properties_days_id_fk)
    // {
    //     $quotation = $this->db
    //         ->select('leads_id_fk, package_id_fk')
    //         ->from('quotation')
    //         ->where('quotation_id', $quotation_id)
    //         ->get()
    //         ->row();

    //     if (!$quotation) return '-';

    //     $row = $this->db
    //         ->select('mp.meal_plan_name')
    //         ->from('accommodation_plan ap')
    //         ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')
    //         ->where('ap.lead_id_fk', $quotation->leads_id_fk)
    //         ->where('ap.pacakage_id_fk', $quotation->package_id_fk)
    //         ->where('ap.day_id_fk', $packages_properties_days_id_fk)
    //         ->where('ap.accommodation_plan_status', 1)
    //         ->get()
    //         ->row();

    //     return $row && !empty($row->meal_plan_name) ? $row->meal_plan_name : '-';
    // }

    public function get_day_meal_plan_from_accommodation($quotation_id, $packages_properties_days_id_fk)
{
    $quotation = $this->db
        ->select('leads_id_fk, package_id_fk')
        ->from('quotation')
        ->where('quotation_id', (int)$quotation_id)
        ->where('quotation_status', 1)
        ->get()
        ->row();

    if (!$quotation) return '-';

    // get packages_itinerary_days_id_fk from packages_properties_days
    $ppd = $this->db
        ->select('packages_itinerary_days_id_fk')
        ->from('packages_properties_days')
        ->where('packages_properties_days_id', (int)$packages_properties_days_id_fk)
        ->get()
        ->row();

    if (!$ppd || empty($ppd->packages_itinerary_days_id_fk)) {
        return '-';
    }

    $row = $this->db
        ->select('mp.meal_plan_name')
        ->from('accommodation_plan ap')
        ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')
        ->where('ap.lead_id_fk', (int)$quotation->leads_id_fk)
        ->where('ap.pacakage_id_fk', (int)$quotation->package_id_fk)
        ->where('ap.day_id_fk', (int)$ppd->packages_itinerary_days_id_fk)
        ->where('ap.accommodation_plan_status', 1)
        ->get()
        ->row();

    return ($row && !empty($row->meal_plan_name)) ? $row->meal_plan_name : '-';
}
    // public function get_option_property_inclusions($quotation_id)
    // {
    //     return $this->db
    //         ->select('qpi.*')
    //         ->from('quotation_property_inclusions qpi')
    //         ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qpi.quotation_properties_days_id_fk', 'left')
    //         ->where('qpi.quotation_id_fk', $quotation_id)
    //         // ->where('qpd.quotation_options_id_fk', $quotation_options_id)
    //         ->where('qpi.quotation_property_inclusions_status', 1)
    //         ->get()
    //         ->result();
    // }

    public function get_option_property_inclusions($quotation_id, $quotation_options_id)
{
    return $this->db
        ->select('qpi.*')
        ->from('quotation_property_inclusions qpi')
        ->where('qpi.quotation_id_fk', (int)$quotation_id)
        ->where('qpi.quotation_options_id_fk', (int)$quotation_options_id)
        ->where('qpi.quotation_property_inclusions_status', 1)
        ->get()
        ->result();
}

public function get_quotation_special_requirements_preview($quotation_id)
{
    return $this->db
        ->select('qsr.*, sr.special_requirements_name')
        ->from('quotation_special_requirements qsr')
        ->join('special_requirements sr', 'sr.special_requirements_id = qsr.quotation_special_requirements_id_fk', 'left')
        ->where('qsr.quotation_id_fk', (int)$quotation_id)
        ->where('qsr.quotation_special_requirements_status', 1)
        ->get()
        ->result();
}
    public function get_quotation_property_inclusions_preview($quotation_id)
    {
        return $this->db
            ->select('qpi.*')
            ->from('quotation_property_inclusions qpi')
            ->where('qpi.quotation_id_fk', $quotation_id)
            ->where('qpi.quotation_property_inclusions_status', 1)
            ->order_by('qpi.quotation_property_inclusions_id', 'ASC')
            ->get()
            ->result();
    }

    public function get_quotation_payment_policies($quotation_id)
    {
        return $this->db->from('quotation_payment_policies')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_payment_policies_status', 1)
            ->get()->result();
    }

    public function get_quotation_cancellation_policies($quotation_id)
    {
        return $this->db->from('quotation_cancellation_policies')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_cancellation_policies_status', 1)
            ->get()->result();
    }

    public function get_quotation_optional_addons($quotation_id)
    {
        return $this->db->from('quotation_optional_add_on')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_optional_add_on_status', 1)
            ->get()->result();
    }

    public function get_quotation_terms($quotation_id)
    {
        return $this->db->from('quotation_terms_condition')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_terms_condition_status', 1)
            ->get()->result();
    }

    public function get_quotation_notes($quotation_id)
    {
        return $this->db->from('quotation_notes')
            ->where('quotation_id_fk', $quotation_id)
            ->where('quotation_notes_status', 1)
            ->get()->result();
    }
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		// echo $this->db->last_query();exit();
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id, $data)
	{
		$this->db->where('quotation_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>