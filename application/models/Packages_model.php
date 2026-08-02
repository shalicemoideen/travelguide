<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Packages_model extends CI_Model{
	var $table = 'packages';

	public function __construct()
    {
        parent::__construct();
    }

	public function getPackageTable($param){
		$arOrder = array('','roles_name');
		$packages_title_filter =(isset($param['packages_title_filter']))?$param['packages_title_filter']:'';
		$packages_category_id_filter =(isset($param['packages_category_id_filter']))?$param['packages_category_id_filter']:'';
		$packages_itinerary_category_id_filter =(isset($param['packages_itinerary_category_id_filter']))?$param['packages_itinerary_category_id_filter']:'';
		$packages_itinerary_id_filter =(isset($param['packages_itinerary_id_filter']))?$param['packages_itinerary_id_filter']:'';
		$packages_duration_in_nights_filter =(isset($param['packages_duration_in_nights_filter']))?$param['packages_duration_in_nights_filter']:'';
		$packages_createdby_user_id =(isset($param['packages_createdby_user_id']))?$param['packages_createdby_user_id']:'';
		
		
		if($packages_title_filter){
            $this->db->like('packages_title', $packages_title_filter); 
        }
        if($packages_category_id_filter){
            $this->db->where('packages_category_id_fk', $packages_category_id_filter); 
        }
        if($packages_itinerary_category_id_filter){
            $this->db->where('itinerary_category_id', $packages_itinerary_category_id_filter); 
        }
		if($packages_itinerary_id_filter){
            $this->db->where('packages_itinerary_id_fk', $packages_itinerary_id_filter); 
        }
		if($packages_duration_in_nights_filter){
            $this->db->where('packages_duration_in_nights', $packages_duration_in_nights_filter); 
        }		
        if($packages_createdby_user_id){
            $this->db->where('packages_createdby_user_id', $packages_createdby_user_id); 
        }
        $this->db->where("packages_status",1);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');

		if($currentusertype == 'S'){
			$this->db->group_start();
			$this->db->where('packages_createdby_user_id', $currentuserid);
			$this->db->or_where('user_details.user_type', 'A');
			$this->db->group_end();
		}
		$this->db->select('packages.*, package_category.package_category_name, itinerary_category.itinerary_category_name, itineraries.itineraries_name, user_details.user_type as creator_user_type, user_details.admin_name');
		$this->db->from('packages');
		$this->db->join('package_category', 'package_category.package_category_id = packages.packages_category_id_fk','left');
		$this->db->join('itinerary_category', 'itinerary_category.itinerary_category_id = packages.packages_itinerary_category_id_fk','left');
		$this->db->join('itineraries', 'itineraries.itineraries_id = packages.packages_itinerary_id_fk','left');
		$this->db->join('user_details', 'user_details.user_id = packages.packages_createdby_user_id','left');
		$this->db->order_by('packages_id', 'DESC');
		// $this->db->group_by('room_tariff_hike_rate.room_tariff_hike_id_fk');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getPackageTotalCount($param);
        $data['recordsFiltered'] = $this->getPackageTotalCount($param);
        return $data;

	}

	public function getPackageTotalCount($param = NULL){

		$packages_title_filter =(isset($param['packages_title_filter']))?$param['packages_title_filter']:'';
		$packages_category_id_filter =(isset($param['packages_category_id_filter']))?$param['packages_category_id_filter']:'';
		$packages_itinerary_category_id_filter =(isset($param['packages_itinerary_category_id_filter']))?$param['packages_itinerary_category_id_filter']:'';
		$packages_itinerary_id_filter =(isset($param['packages_itinerary_id_filter']))?$param['packages_itinerary_id_filter']:'';
		$packages_duration_in_nights_filter =(isset($param['packages_duration_in_nights_filter']))?$param['packages_duration_in_nights_filter']:'';
		$packages_createdby_user_id =(isset($param['packages_createdby_user_id']))?$param['packages_createdby_user_id']:'';
		
		
		if($packages_title_filter){
            $this->db->like('packages_title', $packages_title_filter); 
        }
        if($packages_category_id_filter){
            $this->db->where('packages_category_id_fk', $packages_category_id_filter); 
        }
        if($packages_itinerary_category_id_filter){
            $this->db->where('itinerary_category_id', $packages_itinerary_category_id_filter); 
        }
		if($packages_itinerary_id_filter){
            $this->db->where('packages_itinerary_id_fk', $packages_itinerary_id_filter); 
        }
		if($packages_duration_in_nights_filter){
            $this->db->where('packages_duration_in_nights', $packages_duration_in_nights_filter); 
        }		
        if($packages_createdby_user_id){
            $this->db->where('packages_createdby_user_id', $packages_createdby_user_id); 
        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');

		if($currentusertype == 'S'){
			$this->db->group_start();
			$this->db->where('packages_createdby_user_id', $currentuserid);
			$this->db->or_where('user_details.user_type', 'A');
			$this->db->group_end();
		}
		$this->db->from('packages');
		$this->db->join('package_category', 'package_category.package_category_id = packages.packages_category_id_fk','left');
		$this->db->join('itinerary_category', 'itinerary_category.itinerary_category_id = packages.packages_itinerary_category_id_fk','left');
		$this->db->join('itineraries', 'itineraries.itineraries_id = packages.packages_itinerary_id_fk','left');
		$this->db->join('user_details', 'user_details.user_id = packages.packages_createdby_user_id','left');
		$this->db->where("packages_status",1);
		$this->db->order_by('packages_id', 'DESC');
		// $this->db->group_by('room_tariff_hike_rate.room_tariff_hike_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	function fetch_package()
	{
		$this->db->order_by("packages_id", "ASC");
		$this->db->where("packages_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("packages");
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

	function fetch_all_users()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}

	function get_prepared_by_user($user_id)
	{
		$this->db->select('ud.user_id, ud.admin_name, ud.user_email_address, ud.user_phone_number, d.designation_name');
		$this->db->from('user_details ud');
		$this->db->join('designation d', 'd.designation_id = ud.designation_id_fk', 'left');
		$this->db->where('ud.user_id', $user_id);
		$this->db->where('ud.user_status', 1);
		$query = $this->db->get();
		return $query->row();
	}

    function fetch_package_category()
	{
		$this->db->order_by("package_category_id", "ASC");
		$this->db->where("package_category_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("package_category");
		return $query->result();
	}

    function fetch_itinerary_category()
	{
		$this->db->order_by("itinerary_category_id", "ASC");
		$this->db->where("itinerary_category_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("itinerary_category");
		return $query->result();
	}

	function fetch_itinerary_filter()
	{
		$this->db->order_by("itineraries_id", "ASC");
		$this->db->where("itineraries_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("itineraries");
		return $query->result();
	}

	function fetch_inclusions_exclusion()
	{
		$this->db->order_by("inclusion_exclusion_common_id", "ASC");
		$this->db->where("inclusion_exclusion_common_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("inclusion_exclusion_common");
		return $query->result();
	}
	
    function fetch_itinerary_under_category($itineraries_category_id, $itineraries_duration_nights, $sel='')
	{

	  $this->db->where('itineraries_duration_nights', $itineraries_duration_nights);
	  $this->db->where('itineraries_category_id_fk', $itineraries_category_id);

	//   $this->db->where("crm_status",2);
	  $this->db->where("itineraries_status",1);

	  $this->db->order_by('itineraries_id', 'ASC');

	  $query = $this->db->get('itineraries');
//echo $this->db->last_query();exit;
	  $output = '<option value="">Please Select itinerary</option>';

	  foreach($query->result() as $row)

	  {

	  	$selected=''; if($sel==$row->itineraries_id) { $selected=' selected'; }

	   	$output .= '<option value="'.$row->itineraries_id.'" '.$selected.'>'.$row->itineraries_name.'</option>';

	  }

	  return $output;

	}

	/* ================= PACKAGE ================= */
    public function get_package($id)
    {
        return $this->db
            ->select('p.*, pc.package_category_name, ic.itinerary_category_name,
                iec.inclusion_exclusion_common_title,
                pp.payment_policies_id_fk,
                pay.payment_policies_name,
                pt.terms_condition_id_fk,
                tc.terms_condition_name,
                pc2.cancellation_policies_id_fk,
                cp.cancellation_policies_name')
            ->where('p.packages_id', $id)
            ->group_by('p.packages_id')
            ->from('packages p')
            ->join('package_category pc', 'pc.package_category_id = p.packages_category_id_fk', 'left')
            ->join('itinerary_category ic', 'ic.itinerary_category_id = p.packages_itinerary_category_id_fk', 'left')
            ->join('inclusion_exclusion_common iec', 'iec.inclusion_exclusion_common_id = p.packages_inclusion_exclusion_common_id_fk', 'left')
            ->join('packages_payment_policies pp', 'p.packages_id = pp.packages_payment_policies_packages_id_fk', 'left')
            ->join('packages_terms_condition pt', 'p.packages_id = pt.packages_terms_condition_packages_id_fk', 'left')
            ->join('packages_cancellation_policies pc2', 'p.packages_id = pc2.packages_cancellation_policies_packages_id_fk', 'left')

            ->join('payment_policies pay', 'pay.payment_policies_id = pp.payment_policies_id_fk', 'left')
            ->join('terms_condition tc', 'tc.terms_condition_id = pt.terms_condition_id_fk', 'left')
            ->join('cancellation_policies cp', 'cp.cancellation_policies_id = pc2.cancellation_policies_id_fk', 'left')
            ->get()->row();
    }

    /* ================= ITINERARY ================= */
    public function get_itinerary_days($package_id)
    {
        return $this->db
            ->select('d.*, s.state_name')
            ->from('packages_itinerary_days d')
            ->join('state s', 's.state_id = d.packages_itineraries_days_destination_id_fk', 'left')
            ->join('packages_itinerary i', 'i.packages_itinerary_id = d.packages_itinerary_id_fk')
            ->where('i.packages_id_fk', $package_id)
            ->order_by('d.packages_itineraries_days_day', 'ASC')
            ->get()->result();
    }

    /* ================= INCLUSION / EXCLUSION ================= */
    public function get_inclusions($id)
    {
        return $this->db->where('packages_id_fk', $id)
            ->where('packages_inclusions_type', 'Y')
            ->get('packages_inclusions')->result();
    }

    public function get_exclusions($id)
    {
        return $this->db->where('packages_id_fk', $id)
            ->where('packages_exclusions_type', 'Y')
            ->get('packages_exclusions')->result();
    }

    /* ================= OPTIONAL ================= */
    public function get_optional_addons($id)
    {
        return $this->db
            ->where('packages_optional_add_on_packages_id_fk', $id)
            ->get('packages_optional_add_on')->result();
    }

    /* ================= SPECIAL ================= */
    public function get_special_requirements($id)
    {
        return $this->db
            ->select('s.special_requirements_name, p.packages_special_requirements_cost')
            ->from('packages_special_requirements p')
            ->join('special_requirements s','s.special_requirements_id=p.special_requirements_id_fk')
            ->where('p.packages_special_requirements_packages_id_fk',$id)
            ->get()->result();
    }

    /* ================= PAYMENT ================= */
    public function get_payment_policies($id)
    {
        return $this->db
            ->where('packages_payment_policies_packages_id_fk',$id)
            ->get('packages_payment_policies')->result();
    }

    /* ================= TERMS ================= */
    public function get_terms($id)
    {
        return $this->db
            ->where('packages_terms_condition_packages_id_fk',$id)
            ->get('packages_terms_condition')->result();
    }

    /* ================= CANCELLATION ================= */
    public function get_cancellation($id)
    {
        return $this->db
            ->where('packages_cancellation_policies_packages_id_fk',$id)
            ->get('packages_cancellation_policies')->result();
    }

    /* ================= NOTES ================= */
    public function get_notes($id)
    {
        return $this->db
            ->where('packages_notes_packages_id_fk',$id)
            ->get('packages_notes')->result();
    }

    /* ================= Account details ================= */
    public function get_accountdetails()
    {
        return $this->db
            
            ->get('account_details')->row();
    }

    public function get_all_accountdetails()
    {
        return $this->db
            ->where('account_details_status', 1)
            ->get('account_details')->result();
    }

    /* ================= PROPERTIES ================= */
//     public function get_properties_grouped($package_id)
// {
//     $result = array();

//     $commons = $this->db
//         ->select('packages_properties_common_id, packages_properties_common_category_name, packages_properties_common_design_type')
//         ->from('packages_properties_common')
//         ->where('packages_properties_common_packages_id_fk', $package_id)
//         ->order_by('packages_properties_common_id', 'ASC')
//         ->get()
//         ->result();

//     foreach ($commons as $common) {

//         $cat = new stdClass();
//         $cat->packages_properties_common_id = $common->packages_properties_common_id;
//         $cat->packages_properties_common_category_name = $common->packages_properties_common_category_name;
//         $cat->packages_properties_common_design_type = $common->packages_properties_common_design_type;
//         $cat->days = array();

//         $days = $this->db
//             ->select('ppd.packages_properties_days_id, ppd.packages_properties_days_day, s.state_name as destination_name')
//             ->from('packages_properties_days ppd')
//             ->join('state s', 's.state_id = ppd.packages_properties_days_destination_id_fk', 'left')
//             ->where('ppd.packages_properties_common_id_fk', $common->packages_properties_common_id)
//             ->order_by('ppd.packages_properties_days_id', 'ASC')
//             ->get()
//             ->result();

//         foreach ($days as $dayRow) {

//             $day = new stdClass();
//             $day->day_no = $dayRow->packages_properties_days_day;
//             $day->destination_name = $dayRow->destination_name;
//             $day->rows = array();

//             $props = $this->db
//                 ->select('pp.packages_properties_id, p.properties_name as property_name')
//                 ->from('packages_properties pp')
//                 ->join('properties p', 'p.properties_id = pp.properties_id_fk', 'left')
//                 ->where('pp.packages_properties_days_id_fk', $dayRow->packages_properties_days_id)
//                 ->order_by('pp.packages_properties_id', 'ASC')
//                 ->get()
//                 ->result();

//             foreach ($props as $propRow) {

//                 $prop = new stdClass();
//                 $prop->property_name = $propRow->property_name;
//                 $prop->meal_plan_name = '-';
//                 $prop->rooms = array();

//                 $rooms = $this->db
//                     ->select('prc.properties_room_category_name')
//                     ->from('packages_properties_rooms ppr')
//                     ->join('properties_room_category prc', 'prc.properties_room_category_id = ppr.packages_properties_rooms_id_fk', 'left')
//                     ->where('ppr.packages_properties_id_fk', $propRow->packages_properties_id)
//                     ->get()
//                     ->result();

//                 if (!empty($rooms)) {
//                     foreach ($rooms as $r) {
//                         $prop->rooms[] = $r->properties_room_category_name;
//                     }
//                 } else {
//                     $prop->rooms[] = '-';
//                 }

//                 $day->rows[] = $prop;
//             }

//             $cat->days[] = $day;
//         }

//         $result[] = $cat;
//     }

//     return $result;
// }

public function get_properties_grouped($package_id)
{
    $result = array();

    $commons = $this->db
        ->select('packages_properties_common_id, packages_properties_common_category_name, packages_properties_common_design_type')
        ->from('packages_properties_common')
        ->where('packages_properties_common_packages_id_fk', $package_id)
        ->order_by('packages_properties_common_id', 'ASC')
        ->get()
        ->result();

    foreach ($commons as $common) {

        $cat = new stdClass();
        $cat->packages_properties_common_id = $common->packages_properties_common_id;
        $cat->packages_properties_common_category_name = $common->packages_properties_common_category_name;
        $cat->packages_properties_common_design_type = $common->packages_properties_common_design_type;
        $cat->days = array();

        $days = $this->db
            ->select('ppd.packages_properties_days_id, ppd.packages_properties_days_day, s.state_name as destination_name')
            ->from('packages_properties_days ppd')
            ->join('state s', 's.state_id = ppd.packages_properties_days_destination_id_fk', 'left')
            ->where('ppd.packages_properties_common_id_fk', $common->packages_properties_common_id)
            ->order_by('ppd.packages_properties_days_id', 'ASC')
            ->get()
            ->result();

        foreach ($days as $dayRow) {

            $day = new stdClass();
            $day->day_no = $dayRow->packages_properties_days_day;
            $day->destination_name = $dayRow->destination_name;
            $day->rows = array();

            $props = $this->db
                ->select('pp.packages_properties_id, p.properties_name as property_name')
                ->from('packages_properties pp')
                ->join('properties p', 'p.properties_id = pp.properties_id_fk', 'left')
                ->where('pp.packages_properties_days_id_fk', $dayRow->packages_properties_days_id)
                ->order_by('pp.packages_properties_id', 'ASC')
                ->get()
                ->result();

            foreach ($props as $propRow) {

                $prop = new stdClass();
                $prop->property_name = $propRow->property_name;
                $prop->meal_plan_name = '-';
                $prop->rooms = array();

                $rooms = $this->db
                    ->select('prc.properties_room_category_name')
                    ->from('packages_properties_rooms ppr')
                    ->join('properties_room_category prc', 'prc.properties_room_category_id = ppr.packages_properties_rooms_id_fk', 'left')
                    ->where('ppr.packages_properties_id_fk', $propRow->packages_properties_id)
                    ->get()
                    ->result();

                if (!empty($rooms)) {
                    foreach ($rooms as $r) {
                        $prop->rooms[] = $r->properties_room_category_name;
                    }
                } else {
                    $prop->rooms[] = '-';
                }

                $day->rows[] = $prop;
            }

            $cat->days[] = $day;
        }

        $result[] = $cat;
    }

    return $result;
}

// 	$query1 = "select itineraries_days_day,state_name,itineraries_days_description
//                         from 
//                             itineraries
                            
// 						LEFT JOIN itineraries_days
// ON itineraries.itineraries_id = itineraries_days.itineraries_id_fk
// LEFT JOIN state
// ON state.state_id = itineraries_days.itineraries_days_destination_id_fk
//                         where itineraries_category_id_fk = $itinerary_category_id AND
//                             itineraries_status = 1";

        

//         $query = $this->db->query("$query1");
//         //echo $this->db->last_query();exit;
//         return $query->result();

	
	public function itinerary_array_list($itineraries_id){


		$this->db->select('
			itineraries_days_id,itineraries_days_day,itineraries_days_title,state_name,itineraries_days_destination_id_fk,itineraries_days_image,itineraries_days_travel_back,itineraries_first_cover_page,itineraries_last_cover_page,itineraries_days_description
		');
		$this->db->from('itineraries');
		$this->db->join(
			'itineraries_days',
			'itineraries.itineraries_id = itineraries_days.itineraries_id_fk',
			'left'
		);
		$this->db->join(
			'state',
			'state.state_id = itineraries_days.itineraries_days_destination_id_fk',
			'left'
		);
		$this->db->where('itineraries.itineraries_id', $itineraries_id);
		$this->db->where('itineraries.itineraries_status', 1);
		$this->db->order_by('itineraries_days.itineraries_days_id', 'ASC');

		return $this->db->get()->result();
    }

	public function inclusion_array_list($inclusion_exclusion_common_id){


        $query1 = "select *
                        from 
                            inclusion_exclusion_common
                            
						LEFT JOIN inclusions
ON inclusion_exclusion_common.inclusion_exclusion_common_id = inclusions.inclusion_exclusion_common_id_fk1

                        where inclusion_exclusion_common_id = $inclusion_exclusion_common_id AND
                            inclusion_exclusion_common_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

	public function exclusion_array_list($inclusion_exclusion_common_id){


        $query1 = "select *
                        from 
                            inclusion_exclusion_common
                            

LEFT JOIN exclusions
ON inclusion_exclusion_common.inclusion_exclusion_common_id = exclusions.inclusion_exclusion_common_id_fk2
                        where inclusion_exclusion_common_id = $inclusion_exclusion_common_id AND
                            inclusion_exclusion_common_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

	function gettspecialrequirment_details(){
	
	
	$this->db->select('special_requirements_id, special_requirements_name');
	$this->db->where("special_requirements_status",1);
	$query = $this->db->get('special_requirements');
	$special_requirements_name = array();
	if($query->result()){
		foreach ($query->result() as $special_requirements_names) {
			$special_requirements_name[$special_requirements_names->special_requirements_id] = $special_requirements_names->special_requirements_name;
		}
		return $special_requirements_name;
		}
	else{
			return FALSE;
         }
	}

	public function getSpecialrequirmentamount($special_requirements_id)
    {
        $status=1;
        $this->db->select('special_requirements_cost as amount');
        $this->db->from('special_requirements');
        $this->db->where('special_requirements_id', $special_requirements_id);
        $this->db->where('special_requirements_status', $status);
		// $this->db->limit('1');
		// $this->db->order_by('loan_payment_id','DESC');
        $query = $this->db->get();
		// echo $this->db->last_query();
		// exit();
        return $query->row();
    }

	function fetch_payment_policies()
	{
		$this->db->order_by("payment_policies_id", "ASC");
		$this->db->where("payment_policies_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("payment_policies");
		return $query->result();
	}

	public function payment_policies_array_list($payment_policies_id){


        $query1 = "select *
                        from 
                            payment_policies
                            

LEFT JOIN payment_policies_items
ON payment_policies.payment_policies_id = payment_policies_items.payment_policies_id_fk
                        where payment_policies_id = $payment_policies_id AND
                            payment_policies_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

	function fetch_terms_condition()
	{
		$this->db->order_by("terms_condition_id", "ASC");
		$this->db->where("terms_condition_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("terms_condition");
		return $query->result();
	}

	public function terms_condition_array_list($terms_condition_id){


        $query1 = "select *
                        from 
                            terms_condition
                            

LEFT JOIN terms_condition_items
ON terms_condition.terms_condition_id = terms_condition_items.terms_condition_id_fk
                        where terms_condition_id = $terms_condition_id AND
                            terms_condition_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

	function fetch_cancellation_policies()
	{
		$this->db->order_by("cancellation_policies_id", "ASC");
		$this->db->where("cancellation_policies_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("cancellation_policies");
		return $query->result();
	}

	public function cancellation_policies_array_list($cancellation_policies_id){


        $query1 = "select *
                        from 
                            cancellation_policies
                            

LEFT JOIN cancellation_policies_item
ON cancellation_policies.cancellation_policies_id = cancellation_policies_item.cancellation_policies_id_fk
                        where cancellation_policies_id = $cancellation_policies_id AND
                            cancellation_policies_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

	function gettproperties_details($properties_destination_id_fk){
	
	
	$this->db->select('properties_id, properties_name');
	$this->db->where("properties_status",1);
	$this->db->where("properties_destination_id_fk",$properties_destination_id_fk);
	$query = $this->db->get('properties');
	
	return $query->result();

	}
	public function fetch_rooms_under_property($properties_id_fk)
	{
		return $this->db
			->select('
				properties_room_category_id,
				properties_room_category_name,
				room_category_show_order
			')
			->from('properties_room_category')
			->where('properties_id_fk', $properties_id_fk)
			->where('properties_room_category_status', 1)
			->order_by('room_category_show_order', 'ASC')
			->order_by('properties_room_category_id', 'ASC')
			->get()
			->result_array();
	}
	// function gettdestination_details(){
	
	
	// $this->db->select('state_id, state_name');
	// $this->db->where("state_status",1);
	// $query = $this->db->get('state');
	// $state_name = array();
	// if($query->result()){
	// 	foreach ($query->result() as $state_names) {
	// 		$state_name[$state_names->state_id] = $state_names->state_name;
	// 	}
	// 	return $state_name;
	// 	}
	// else{
	// 		return FALSE;
    //      }
	// }

	function gettdestination_details(){
	
	
	$this->db->select('state_id, state_name');
	$this->db->where("state_status",1);
	$query = $this->db->get('state');
	return $query->result();

	}

	// function fetch_itinerary($itineraries_duration_nights,$itineraries_days_destination_id_fk)
	// {
	function fetch_itinerary()
	{

		$this->db->select('itineraries_id, itineraries_name');
		$this->db->from('itineraries');
		$this->db->join(
			'itineraries_days',
			'itineraries.itineraries_id = itineraries_days.itineraries_id_fk',
			'left'
		);
		$this->db->where("itineraries_status",1);
		// $this->db->where('itineraries_duration_nights', $itineraries_duration_nights);
		// $this->db->where_in('itineraries_days_destination_id_fk', $itineraries_days_destination_id_fk);
		$this->db->group_by('itineraries_id');
		$query = $this->db->get();
		// echo $this->db->last_query();exit;
		return $query->result();
	}

// 	function fetch_days_under_itinerary($itineraries_id_fk, $sel='')
// 	{

// 	  $this->db->select('itineraries_days_id, itineraries_days_day, state_name,itineraries_days_description,itineraries_days_title');
// 	  $this->db->from('itineraries');
// 	  $this->db->join(
// 			'itineraries_days',
// 			'itineraries.itineraries_id = itineraries_days.itineraries_id_fk',
// 			'left'
// 		);
// 	  $this->db->join(
// 			'state',
// 			'state.state_id = itineraries_days.itineraries_days_destination_id_fk',
// 			'left'
// 		);
// 	  $this->db->where('itineraries_id_fk', $itineraries_id_fk);

// 	//   $this->db->where("crm_status",2);
// 	  $this->db->where("itineraries_days_status",1);

// 	  $this->db->order_by('itineraries_days_id', 'ASC');

// 	  $query = $this->db->get();
// //echo $this->db->last_query();exit;
// 	  $output = '<option value="">Please Select itinerary Days</option>';

// 	  foreach($query->result() as $row)

// 	  {

// 	  	$selected=''; if($sel==$row->itineraries_days_id) { $selected=' selected'; }

// 	   	$output .= '<option value="'.$row->itineraries_days_id.'" '.$selected.'>'.$row->itineraries_days_day.' | '.$row->state_name.'</option>';

// 	  }

// 	  return $output;

// 	}

	public function fetch_days_under_itinerary($itineraries_id_fk)
	{
		return $this->db
			->select('
				itineraries_days_id,
				itineraries_days_day,
				itineraries_days_title,
				itineraries_days_description,
				state_name
			')
			->from('itineraries_days')
			->join('state', 'state.state_id = itineraries_days.itineraries_days_destination_id_fk', 'left')
			->where('itineraries_days.itineraries_id_fk', $itineraries_id_fk)
			->where('itineraries_days.itineraries_days_status', 1)
			->order_by('itineraries_days_day', 'ASC')
			->get()
			->result_array();
	}

	public function get_itinerary_day_details($day_id)
	{
		
		$this->db->select('
			itineraries_days_day,
			itineraries_days_title,
			itineraries_days_description
		');
		$this->db->from('itineraries_days');
		$this->db->where('itineraries_days_id', $day_id);
		$this->db->where('itineraries_days_status', 1);

		$query = $this->db->get();

		return $query->row();
		
	}

	public function get_saved_property_data($package_id)
{
    $sections = $this->db->select('
            packages_properties_common_id,
            packages_properties_common_category_name,
            packages_properties_common_design_type
        ')
        ->from('packages_properties_common')
        ->where('packages_properties_common_packages_id_fk', $package_id)
        ->order_by('packages_properties_common_id', 'ASC')
        ->get()
        ->result_array();

    $out = array();

    foreach ($sections as $sec) {
        $secId = (int)$sec['packages_properties_common_id'];

        // IMPORTANT:
        // packages_properties_days.packages_itinerary_days_id_fk = package itinerary day table id
        // we must join packages_itinerary_days to get the ORIGINAL itineraries_days_id_fk
        $days = $this->db->select('
                ppd.packages_properties_days_id,
                ppd.packages_properties_days_destination_id_fk as destination_id,
                ppd.packages_itinerary_days_id_fk as package_itinerary_day_id,
                pid.itineraries_days_id_fk as itineraries_days_id_fk
            ')
            ->from('packages_properties_days ppd')
            ->join('packages_itinerary_days pid', 'pid.packages_itinerary_days_id = ppd.packages_itinerary_days_id_fk', 'left')
            ->where('ppd.packages_properties_common_id_fk', $secId)
            ->order_by('ppd.packages_properties_days_id', 'ASC')
            ->get()
            ->result_array();

        $daysOut = array();

        foreach ($days as $d) {
            $ppdId = (int)$d['packages_properties_days_id'];

            $props = $this->db->select('
                    packages_properties_id,
                    properties_id_fk as property_id
                ')
                ->from('packages_properties')
                ->where('packages_properties_days_id_fk', $ppdId)
                ->order_by('packages_properties_id', 'ASC')
                ->get()
                ->result_array();

            $propsOut = array();

            foreach ($props as $p) {
                $ppId = (int)$p['packages_properties_id'];

                $rooms = $this->db->select('packages_properties_rooms_id_fk as room_category_id')
                    ->from('packages_properties_rooms')
                    ->where('packages_properties_id_fk', $ppId)
                    ->order_by('packages_properties_rooms_id', 'ASC')
                    ->get()
                    ->result_array();

                $roomIds = array();
                foreach ($rooms as $r) {
                    $roomIds[] = (string)$r['room_category_id'];
                }

                $propsOut[] = array(
                    'property_id' => (string)$p['property_id'],
                    'rooms'       => $roomIds
                );
            }

            $daysOut[] = array(
                // THIS MUST MATCH YOUR FRONTEND data-day-id
                'itineraries_days_id_fk' => (string)$d['itineraries_days_id_fk'],
                'destination_id'         => (string)$d['destination_id'],
                'properties'             => $propsOut
            );
        }

        $out[] = array(
            'packages_properties_common_category_name' => $sec['packages_properties_common_category_name'],
            'packages_properties_common_design_type'   => $sec['packages_properties_common_design_type'],
            'days'                                     => $daysOut
        );
    }

    return $out;
}
	public function get_properties_with_names($package_id)
	{
		$sections = $this->db->select('
				packages_properties_common_id,
				packages_properties_common_category_name,
				packages_properties_common_design_type,
				packages_properties_common_template_master_id_fk
			')
			->from('packages_properties_common')
			->where('packages_properties_common_packages_id_fk', $package_id)
			->order_by('packages_properties_common_id', 'ASC')
			->get()->result_array();

		$out = array();

		foreach ($sections as $sec) {
			$secId = (int)$sec['packages_properties_common_id'];

			$days = $this->db->select('
					ppd.packages_properties_days_id,
					ppd.packages_properties_days_destination_id_fk as destination_id,
					ppd.packages_itinerary_days_id_fk as package_itinerary_day_id,
					pid.itineraries_days_id_fk as itineraries_days_id_fk
				')
				->from('packages_properties_days ppd')
				->join('packages_itinerary_days pid', 'pid.packages_itinerary_days_id = ppd.packages_itinerary_days_id_fk', 'left')
				->where('ppd.packages_properties_common_id_fk', $secId)
				->order_by('ppd.packages_properties_days_id', 'ASC')
				->get()->result_array();

			$daysOut = array();

			foreach ($days as $d) {
				$ppdId = (int)$d['packages_properties_days_id'];

				$props = $this->db->select('
						pp.packages_properties_id,
						pp.properties_id_fk as property_id,
						p.properties_name
					')
					->from('packages_properties pp')
					->join('properties p', 'p.properties_id = pp.properties_id_fk', 'left')
					->where('pp.packages_properties_days_id_fk', $ppdId)
					->order_by('pp.packages_properties_id', 'ASC')
					->get()->result_array();

				$propsOut = array();

				foreach ($props as $p) {
					$ppId = (int)$p['packages_properties_id'];

					$rooms = $this->db->select('
							ppr.packages_properties_rooms_id_fk as room_id,
							rc.properties_room_category_name as room_name
						')
						->from('packages_properties_rooms ppr')
						->join('properties_room_category rc', 'rc.properties_room_category_id = ppr.packages_properties_rooms_id_fk', 'left')
						->where('ppr.packages_properties_id_fk', $ppId)
						->order_by('ppr.packages_properties_rooms_id', 'ASC')
						->get()->result_array();

					$roomsOut = array();
					foreach ($rooms as $r) {
						$roomsOut[] = array(
							'id'   => (string)$r['room_id'],
							'text' => (string)$r['room_name']
						);
					}

					$propsOut[] = array(
						'property_id'   => (string)$p['property_id'],
						'property_name' => (string)$p['properties_name'],
						'rooms'         => $roomsOut
					);
				}

				$daysOut[] = array(
					'itineraries_days_id_fk' => (string)$d['itineraries_days_id_fk'],
					'destination_id'         => (string)$d['destination_id'],
					'properties'             => $propsOut
				);
			}

			$out[] = array(
				'packages_properties_common_category_name' => $sec['packages_properties_common_category_name'],
				'packages_properties_common_design_type'   => $sec['packages_properties_common_design_type'],
				'packages_properties_common_template_master_id_fk' => $sec['packages_properties_common_template_master_id_fk'],
				'days'                                     => $daysOut
			);
		}

		return $out;
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where("packages_status",1);
		$this->db->where('packages_id',$id);
		$query = $this->db->get();

		return $query->row();
	}
	
	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		// echo $this->db->last_query();exit();
		return $this->db->affected_rows();
	}
	
	public function delete_by_id($id, $data)
	{
		$this->db->where('packages_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>
