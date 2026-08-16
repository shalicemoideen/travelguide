<?php



if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Quotation_model extends CI_Model{



	var $table = 'quotation';



    var $table1 = 'quotation_room_tariff_details';



    var $table3 = 'trips';







	public function __construct()



    {



        parent::__construct();



        $this->load->model('IncentiveConfig_model');



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



		$travel_start_date =(isset($param['travel_start_date']))?$param['travel_start_date']:'';



		$travel_end_date =(isset($param['travel_end_date']))?$param['travel_end_date']:'';







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



            $this->db->where('quotation.package_id_fk', $package_id_filter); 



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



        if($travel_start_date){



            $this->db->where('leads.start_date>=', $travel_start_date);



        }



        if($travel_end_date){



            $this->db->where('leads.end_date<=', $travel_end_date);



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



		$currentuserid = $this->session->userdata('user_id');



		$currentusertype = $this->session->userdata('user_type');



			



		$this->db->select('*, DATE_FORMAT(quotation_date,\'%d-%m-%Y\') as quotation_date, ud.admin_name as quotation_created_by_username, DATE_FORMAT(leads.start_date,\'%d-%m-%Y\') as arriving_date, DATE_FORMAT(leads.end_date,\'%d-%m-%Y\') as departure_date, leads.duration as travel_duration, (SELECT t.transporter_name FROM quotation_transport_allocation qta LEFT JOIN transporter t ON t.user_id_fk = qta.transporter_id_fk WHERE qta.quotation_id_fk = quotation.quotation_id AND qta.status = 1 LIMIT 1) as transporter_name, (SELECT v.vehicle_name FROM quotation_confirmation qc LEFT JOIN quotation_options qo ON qo.quotation_options_id = qc.option_id_fk LEFT JOIN vehicle v ON v.vehicle_id = qo.quotation_options_vehicle_id_fk WHERE qc.quotation_id_fk = quotation.quotation_id AND qc.property_confirmation_status = 1 LIMIT 1) as confirmed_cab_type', FALSE);



		$this->db->from('quotation');



		$this->db->join('leads', 'leads.leads_id = quotation.leads_id_fk','left');



		$this->db->join('packages', 'packages.packages_id = quotation.package_id_fk','left');



		$this->db->join('user_details ud', 'ud.user_id = quotation.quotation_created_by_userid', 'left');



        if (!empty($param['confirmed_only'])) {

            if ($currentusertype == 'S') {

                $this->db->group_start();

                $this->db->where_in('quotation_current_status', array(5, 7, 8, 9, 10));

                $this->db->or_where('quotation_created_by_userid', $currentuserid);

                $this->db->group_end();

            } else {

                $this->db->where_in('quotation_current_status', array(5, 7, 8, 9, 10));

            }

        } else {

            if($currentusertype == 'S'){

                $this->db->where("quotation_created_by_userid",$currentuserid);

            }

        }



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



		$travel_start_date =(isset($param['travel_start_date']))?$param['travel_start_date']:'';



		$travel_end_date =(isset($param['travel_end_date']))?$param['travel_end_date']:'';







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



            $this->db->where('quotation.package_id_fk', $package_id_filter); 



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



        if($travel_start_date){



            $this->db->where('leads.start_date>=', $travel_start_date);



        }



        if($travel_end_date){



            $this->db->where('leads.end_date<=', $travel_end_date);



        }



        if($quotation_created_by_userid){



            $this->db->where('quotation_created_by_userid', $quotation_created_by_userid); 



        }



        $this->db->where("quotation_status",1);



		$currentuserid = $this->session->userdata('user_id');



		$currentusertype = $this->session->userdata('user_type');



		$this->db->select('*,DATE_FORMAT(quotation_date,\'%d-%m-%Y\') as quotation_date');



		$this->db->from('quotation');



		$this->db->join('leads', 'leads.leads_id = quotation.leads_id_fk','left');



		$this->db->join('packages', 'packages.packages_id = quotation.package_id_fk','left');



        if (!empty($param['confirmed_only'])) {

            if ($currentusertype == 'S') {

                $this->db->group_start();

                $this->db->where_in('quotation_current_status', array(5, 7, 8, 9, 10));

                $this->db->or_where('quotation_created_by_userid', $currentuserid);

                $this->db->group_end();

            } else {

                $this->db->where_in('quotation_current_status', array(5, 7, 8, 9, 10));

            }

        } else {

            if($currentusertype == 'S'){

                $this->db->where("quotation_created_by_userid",$currentuserid);

            }

        }



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



            ->select('q.quotation_number, q.quotation_current_status, q.leads_id_fk, q.quotation_title, q.trip_code,



                    l.guest_name, l.leads_number, l.lead_type, l.leads_id,



                    l.start_date, l.duration, l.end_date,



                    qo.quotation_options_title as confirmed_option_title,



                    qta.id as allocation_id,

                    qta.transporter_id_fk as quotation_transporter_id_fk,

                    qta.driver_name, qta.driver_mobile, qta.cab_number,

                    t.transporter_name,



                    v.vehicle_name as confirmed_vehicle_name,



                    qr.review_id, qr.review_rating, qr.review_comment, qr.reviewed_at')



            ->from('quotation q')



            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')



            ->join('quotation_confirmation qc', 'qc.quotation_id_fk = q.quotation_id AND qc.property_confirmation_status = 1', 'left')



            ->join('quotation_options qo', 'qo.quotation_options_id = qc.option_id_fk', 'left')



            ->join('quotation_transport_allocation qta', 'qta.quotation_id_fk = q.quotation_id AND qta.status = 1', 'left')



            ->join('transporter t', 't.user_id_fk = qta.transporter_id_fk', 'left')



            ->join('vehicle v', 'v.vehicle_id = qo.quotation_options_vehicle_id_fk', 'left')



            ->join('quotation_review qr', 'qr.quotation_id_fk = q.quotation_id AND qr.review_status = 1', 'left')



            ->where('q.quotation_id', (int)$quotation_id)



            ->where('q.quotation_status', 1)



            ->group_by('q.quotation_id')



            ->get()



            ->row_array();



    }







    public function update_review($quotation_id, $review_rating, $review_comment = '')



    {



        $ci =& get_instance();



        $user_id = $ci->session->userdata('user_id') ? $ci->session->userdata('user_id') : null;







        // Check if a review already exists for this quotation



        $existing = $this->db



            ->where('quotation_id_fk', (int)$quotation_id)



            ->where('review_status', 1)



            ->get('quotation_review')



            ->row_array();







        if ($existing) {



            // Update existing review



            $this->db->where('review_id', $existing['review_id']);



            $updated = $this->db->update('quotation_review', array(



                'review_rating' => $review_rating,



                'review_comment' => $review_comment,



                'reviewed_by_user_id' => $user_id,



                'reviewed_at' => date('Y-m-d H:i:s')



            ));



        } else {



            // Insert new review



            $updated = $this->db->insert('quotation_review', array(



                'quotation_id_fk' => (int)$quotation_id,



                'review_rating' => $review_rating,



                'review_comment' => $review_comment,



                'reviewed_by_user_id' => $user_id,



                'reviewed_at' => date('Y-m-d H:i:s'),



                'review_status' => 1



            ));



        }







        if ($updated) {



            return array(



                'status' => true,



                'message' => 'Review updated successfully'



            );



        } else {



            return array(



                'status' => false,



                'message' => 'Failed to update review'



            );



        }



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



				m.meta_ads_setting_name,



				uc.admin_name as created_by_admin_name,



				uu.admin_name as updated_by_admin_name



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



			->join('user_details uc', 'uc.user_id = l.leads_createdby_userid', 'left')



			->join('user_details uu', 'uu.user_id = l.leads_updatedby_user_id', 'left')



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



            // ->where('ap.accommodation_plan_status', 1)



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



        $options = $this->db



            ->select('qo.quotation_options_id, qo.quotation_options_title,

                qo.quotation_options_cab_amount, qo.quotation_options_total_cost,

                qo.quotation_options_margin_value, qo.quotation_options_total_quote_rate,

                v.vehicle_name')



            ->from('quotation_options qo')



            ->join('vehicle v', 'v.vehicle_id = qo.quotation_options_vehicle_id_fk', 'left')



            ->where('qo.quotation_id_fk', $quotation_id)



            ->where('qo.quotation_options_status', 1)



            ->order_by('qo.quotation_options_id', 'ASC')



            ->get()



            ->result_array();







        foreach ($options as &$opt) {



            $optId = (int)$opt['quotation_options_id'];







            $incRow = $this->db



                ->select('COALESCE(SUM(qpi.inclusion_amount),0) as total')



                ->from('quotation_property_inclusions qpi')



                ->where('qpi.quotation_id_fk', (int)$quotation_id)



                ->where('qpi.quotation_options_id_fk', $optId)



                ->where('qpi.quotation_property_inclusions_status', 1)



                ->get()->row();



            $opt['inclusion_total'] = $incRow ? (float)$incRow->total : 0;







            $specRow = $this->db



                ->select('COALESCE(SUM(qsr.quotation_special_requirements_cost),0) as total')



                ->from('quotation_special_requirements qsr')



                ->where('qsr.quotation_id_fk', (int)$quotation_id)



                ->where('qsr.quotation_special_requirements_status', 1)



                ->get()->row();



            $opt['special_total'] = $specRow ? (float)$specRow->total : 0;







            $hotelRow = $this->db



                ->select('COALESCE(SUM(day_max.max_rate),0) as total')



                ->from('(SELECT MAX(qpr.total_room_cost) as max_rate



                    FROM quotation_properties_days qpd



                    INNER JOIN quotation_properties qp ON qp.quotation_properties_days_id_fk = qpd.quotation_properties_days_id



                    INNER JOIN quotation_properties_rooms qpr ON qpr.quotation_properties_id_fk = qp.quotation_properties_id



                    WHERE qpd.quotation_id_fk = ' . (int)$quotation_id . '



                    AND qpd.quotation_options_id_fk = ' . $optId . '



                    AND qpd.quotation_properties_days_status = 1



                    AND qp.quotation_properties_status = 1



                    AND qpr.quotation_properties_rooms_status = 1



                    GROUP BY qpd.quotation_properties_days_id



                ) as day_max')



                ->get()->row();



            $opt['hotel_total'] = $hotelRow ? (float)$hotelRow->total : 0;







            $opt['cab_amount'] = (float)$opt['quotation_options_cab_amount'];



            $opt['total_cost'] = (float)$opt['quotation_options_total_cost'];



            $opt['margin_value'] = (float)$opt['quotation_options_margin_value'];



            $opt['quote_rate'] = (float)$opt['quotation_options_total_quote_rate'];



            $opt['grand_total'] = $opt['hotel_total'] + $opt['cab_amount'] + $opt['margin_value'] + $opt['inclusion_total'] + $opt['special_total'];



        }



        unset($opt);







        return $options;



    }







    public function get_confirmation_option_details($quotation_id, $quotation_options_id)



    {



        $days = $this->db



            ->select('qpd.*, s.state_name, ap.accommodation_date, mp.meal_plan_name')



            ->from('quotation_properties_days qpd')



            ->join('state s', 's.state_id = qpd.quotation_properties_days_destination_id_fk', 'left')



            ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')



            ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')



            ->where('qpd.quotation_id_fk', $quotation_id)



            ->where('qpd.quotation_options_id_fk', $quotation_options_id)



            ->where('qpd.quotation_properties_days_status', 1)



            ->order_by('qpd.quotation_properties_days_id', 'ASC')



            ->get()



            ->result_array();







        foreach ($days as &$day) {



            $properties = $this->db



                ->select('qp.*, p.properties_name, pc.property_category_name')



                ->from('quotation_properties qp')



                ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')



                ->join('property_category pc', 'pc.property_category_id = p.property_category_id_fk', 'left')



                ->where('qp.quotation_properties_days_id_fk', $day['quotation_properties_days_id'])



                ->where('qp.quotation_properties_status', 1)



                ->order_by('qp.quotation_properties_id', 'ASC')



                ->get()



                ->result_array();







            foreach ($properties as &$property) {



                $property['rooms'] = $this->db



                    ->select('qpr.*, prc.properties_room_category_name,

                        qrtd.room_unit_manual_count, qrtd.room_unit_manual_rate, qrtd.room_unit_manual_total_rate,

                        qrtd.extra_bed_adult_manual_count, qrtd.extra_bed_adult_manual_rate, qrtd.extra_bed_adult_manual_total_rate,

                        qrtd.extra_bed_child_manual_count, qrtd.extra_bed_child_manual_rate, qrtd.extra_bed_child_manual_total_rate,

                        qrtd.manual_total_rate')



                    ->from('quotation_properties_rooms qpr')



                    ->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')



                    ->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id AND qrtd.quotation_id_fk = ' . (int)$quotation_id . ' AND qrtd.quotation_room_tariff_details_status = 1', 'left')



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







    public function delete_confirmation($quotation_id)



    {



        return $this->db->delete('quotation_confirmation', array('quotation_id_fk' => (int)$quotation_id));



    }







    public function deactivate_confirmation($quotation_id)



    {



        return $this->db->update(



            'quotation_confirmation',



            array('property_confirmation_status' => 0),



            array('quotation_id_fk' => (int)$quotation_id)



        );



    }







    public function save_confirmation($insert_data)



    {



        if (empty($insert_data)) return false;



        return $this->db->insert_batch('quotation_confirmation', $insert_data);



    }







    public function upsert_confirmation($quotation_id, $row)



    {



        $update_data = array(



            'option_id_fk'                => (int)$row['option_id_fk'],



            'properties_id_fk'            => (int)$row['properties_id_fk'],



            'properties_room_id_fk'       => (int)$row['properties_room_id_fk'],



            'created_date'                => $row['created_date'],



            'created_by'                  => (int)$row['created_by'],



            'property_confirmation_status'=> 1,



        );







        // If a confirmation id is passed, update directly by primary key



        if (!empty($row['confirmation_id'])) {



            $this->db->where('id', (int)$row['confirmation_id']);



            return $this->db->update('quotation_confirmation', $update_data);



        }







        // Fallback: check by quotation + day



        $existing = $this->db



            ->select('id')



            ->from('quotation_confirmation')



            ->where('quotation_id_fk', (int)$quotation_id)



            ->where('properties_day_id_fk', (int)$row['properties_day_id_fk'])



            ->get()



            ->row();







        if ($existing) {



            $this->db->where('id', $existing->id);



            return $this->db->update('quotation_confirmation', $update_data);



        }







        return $this->db->insert('quotation_confirmation', array(



            'quotation_id_fk'       => (int)$quotation_id,



            'option_id_fk'          => (int)$row['option_id_fk'],



            'properties_day_id_fk'  => (int)$row['properties_day_id_fk'],



            'properties_id_fk'      => (int)$row['properties_id_fk'],



            'properties_room_id_fk' => (int)$row['properties_room_id_fk'],



            'created_date'          => $row['created_date'],



            'created_by'            => (int)$row['created_by'],



        ));



    }







    public function get_saved_confirmation($quotation_id)



    {



        return $this->db



            ->select('id, option_id_fk, properties_day_id_fk, properties_id_fk, properties_room_id_fk')



            ->from('quotation_confirmation')



            ->where('quotation_id_fk', (int)$quotation_id)



            ->where('property_confirmation_status', 1)



            ->order_by('id', 'ASC')



            ->get()



            ->result_array();



    }







    /**



     * Real properties.properties_id values currently confirmed for a quotation.



     *



     * quotation_confirmation.properties_id_fk holds a quotation_properties_id



     * (the per-day candidate hotel row), not a properties_id, so it has to be



     * resolved through quotation_properties before two selections can be



     * compared. Returns a de-duplicated list of integers.



     */



    public function get_confirmed_property_ids($quotation_id)



    {



        $rows = $this->db



            ->distinct()



            ->select('qp.properties_id_fk')



            ->from('quotation_confirmation qc')



            ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')



            ->where('qc.quotation_id_fk', (int)$quotation_id)



            ->where('qc.property_confirmation_status', 1)



            ->get()



            ->result_array();







        $ids = array();



        foreach ($rows as $r) {



            $pid = (int)$r['properties_id_fk'];



            if ($pid > 0) { $ids[$pid] = $pid; }



        }







        return array_values($ids);



    }







    /**



     * Resolve a set of quotation_properties_id values (as posted by the



     * confirmation page) to their real properties_id values.



     */



    public function resolve_real_property_ids($quotation_property_ids)



    {



        $quotation_property_ids = array_filter(array_map('intval', (array)$quotation_property_ids));



        if (empty($quotation_property_ids)) { return array(); }







        $rows = $this->db



            ->distinct()



            ->select('properties_id_fk')



            ->from('quotation_properties')



            ->where_in('quotation_properties_id', array_values($quotation_property_ids))



            ->get()



            ->result_array();







        $ids = array();



        foreach ($rows as $r) {



            $pid = (int)$r['properties_id_fk'];



            if ($pid > 0) { $ids[$pid] = $pid; }



        }







        return array_values($ids);



    }







    public function get_financial_posting_defaults($quotation_id)



    {



        $quotation_id = (int)$quotation_id;







        try {



            // Prefer the confirmed option; fall back to the first active option



            $confirmed = $this->db



                ->select('qc.option_id_fk')



                ->from('quotation_confirmation qc')



                ->where('qc.quotation_id_fk', $quotation_id)



                ->where('qc.property_confirmation_status', 1)



                ->group_by('qc.option_id_fk')



                ->order_by('qc.id', 'ASC')



                ->limit(1)



                ->get()



                ->row_array();







            $option_id = isset($confirmed['option_id_fk']) ? (int)$confirmed['option_id_fk'] : 0;







            if (!$option_id) {



                $first = $this->db



                    ->select('quotation_options_id')



                    ->from('quotation_options')



                    ->where('quotation_id_fk', $quotation_id)



                    ->where('quotation_options_status', 1)



                    ->order_by('quotation_options_id', 'ASC')



                    ->limit(1)



                    ->get()



                    ->row_array();



                $option_id = isset($first['quotation_options_id']) ? (int)$first['quotation_options_id'] : 0;



            }







            $defaults = [



                'driver_quote_amount'       => 0,



                'hotel_reservation_amount'  => 0,



                'pre_quoted_amount'         => 0,



                'margin_value'              => 0,



                'option_id'                 => $option_id,



            ];







            if (!$option_id) {



                return $defaults;



            }







            $option = $this->db



                ->select('quotation_options_cab_amount, quotation_options_total_quote_rate, quotation_options_total_cost, quotation_options_margin_value')



                ->from('quotation_options')



                ->where('quotation_options_id', $option_id)



                ->limit(1)



                ->get()



                ->row_array();







            if ($option) {



                $defaults['driver_quote_amount'] = (float)$option['quotation_options_cab_amount'];



                $defaults['pre_quoted_amount']    = (float)$option['quotation_options_total_quote_rate'];



                $defaults['margin_value']         = (float)$option['quotation_options_margin_value'];



            }







            // Confirmed property / room for each day of this option

            $confirmations = $this->db

                ->select('properties_day_id_fk, properties_id_fk, properties_room_id_fk')

                ->from('quotation_confirmation')

                ->where('quotation_id_fk', $quotation_id)

                ->where('option_id_fk', $option_id)

                ->where('property_confirmation_status', 1)

                ->get()

                ->result_array();



            $confirmedQpByDay = array();

            $confirmedRoomIds = array();

            foreach ($confirmations as $cnf) {

                $dayId  = (int)$cnf['properties_day_id_fk'];

                $roomId = (int)$cnf['properties_room_id_fk'];

                if ($roomId) {

                    $confirmedRoomIds[] = $roomId;

                }

                if ((int)$cnf['properties_id_fk']) {

                    $confirmedQpByDay[$dayId] = (int)$cnf['properties_id_fk'];

                }

            }



            // Resolve the confirmed quotation_properties rows to real property ids

            $confirmedPropertyByDay = array();

            if (!empty($confirmedQpByDay)) {

                $qpRows = $this->db

                    ->select('quotation_properties_id, properties_id_fk')

                    ->from('quotation_properties')

                    ->where_in('quotation_properties_id', array_values($confirmedQpByDay))

                    ->get()

                    ->result_array();



                $qpPropertyMap = array();

                foreach ($qpRows as $qpRow) {

                    $qpPropertyMap[(int)$qpRow['quotation_properties_id']] = (int)$qpRow['properties_id_fk'];

                }

                foreach ($confirmedQpByDay as $dayId => $qpId) {

                    if (isset($qpPropertyMap[$qpId])) {

                        $confirmedPropertyByDay[$dayId] = $qpPropertyMap[$qpId];

                    }

                }

            }



            // Property names of the confirmed properties, so each day row on the

            // financial posting screen can show which property it belongs to.

            $propertyNameById = array();

            if (!empty($confirmedPropertyByDay)) {

                $propRows = $this->db

                    ->select('properties_id, properties_name')

                    ->from('properties')

                    ->where_in('properties_id', array_unique(array_values($confirmedPropertyByDay)))

                    ->get()

                    ->result_array();

                foreach ($propRows as $propRow) {

                    $propertyNameById[(int)$propRow['properties_id']] = $propRow['properties_name'];

                }

            }



            // Cost only the confirmed room(s); fall back to every room when nothing is confirmed yet

            $dayCostExpr = 'COALESCE(SUM(qrtd.manual_total_rate), 0) as day_cost';

            if (!empty($confirmedRoomIds)) {

                $dayCostExpr = 'COALESCE(SUM(CASE WHEN qpr.quotation_properties_rooms_id IN ('

                    . implode(',', array_unique($confirmedRoomIds))

                    . ') THEN qrtd.manual_total_rate ELSE 0 END), 0) as day_cost';

            }



            $hotelDays = $this->db



                ->select('qpd.quotation_properties_days_id, qpd.quotation_properties_days_day as day_label, qpd.packages_properties_days_id_fk, qpd.quotation_itinerary_days_id_fk, ap.accommodation_date, ap.accommodation_day_name, ' . $dayCostExpr, FALSE)



                ->from('quotation_properties_days qpd')



                ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')



                ->join('quotation_properties qp', 'qp.quotation_properties_days_id_fk = qpd.quotation_properties_days_id', 'inner')



                ->join('quotation_properties_rooms qpr', 'qpr.quotation_properties_id_fk = qp.quotation_properties_id', 'inner')



                ->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id AND qrtd.quotation_room_tariff_details_status = 1', 'left')





                ->where('qpd.quotation_id_fk', $quotation_id)



                ->where('qpd.quotation_options_id_fk', $option_id)



                ->where('qpd.quotation_properties_days_status', 1)



                ->where('qp.quotation_properties_status', 1)



                ->where('qpr.quotation_properties_rooms_status', 1)



                ->group_by('qpd.quotation_properties_days_id')



                ->order_by('qpd.quotation_properties_days_id', 'ASC')



                ->get()



                ->result_array();







            $hotelTotal = 0;



            foreach ($hotelDays as $day) {



                $hotelTotal += (float)$day['day_cost'];



            }



            $defaults['hotel_reservation_amount'] = $hotelTotal;



            $defaults['hotel_days'] = $hotelDays;



            // Inclusions of this option, per quotation day + property

            $inclusionRows = $this->db

                ->select('qpi.quotation_properties_days_id_fk, qpi.quotation_itinerary_days_id_fk, qpi.inclusion_property_id_fk, qpi.inclusion_name, qpi.inclusion_amount')

                ->from('quotation_property_inclusions qpi')

                ->where('qpi.quotation_id_fk', $quotation_id)

                ->where('qpi.quotation_options_id_fk', $option_id)

                ->where('qpi.quotation_property_inclusions_status', 1)

                ->get()

                ->result_array();



            // Special requirements per quotation day

            $specialRows = $this->db

                ->select('qsr.quotation_properties_days_id_fk, qsr.quotation_itinerary_days_id_fk, qsr.quotation_special_requirements_name, qsr.quotation_special_requirements_cost')

                ->from('quotation_special_requirements qsr')

                ->where('qsr.quotation_id_fk', $quotation_id)

                ->where('qsr.quotation_special_requirements_status', 1)

                ->get()

                ->result_array();



            // Reservation totals / discounts of the confirmed properties, keyed by real property id

            $reservationRows = $this->db

                ->select('pr.property_reservation_id, pr.properties_id_fk, pps.total_amount, pps.discount_amount, pps.discounted_total')

                ->from('property_reservation pr')

                ->join('property_payment_scheduler pps', 'pps.property_reservation_id_fk = pr.property_reservation_id AND pps.property_payment_scheduler_status = 1', 'left')

                ->where('pr.quotation_id_fk', $quotation_id)

                ->where('pr.property_reservation_status', 1)

                ->order_by('pr.property_reservation_id', 'ASC')

                ->get()

                ->result_array();



            $reservationQueue = array();

            foreach ($reservationRows as $res) {

                $reservationQueue[(int)$res['properties_id_fk']][] = $res;

            }



            // Build combined days array with hotel + inclusions + special per day

            $combinedDays = array();

            $inclusionsTotal = 0;

            $specialTotal = 0;



            foreach ($hotelDays as $day) {

                $dayId = (int)$day['quotation_properties_days_id'];

                $dayItinId = (int)$day['quotation_itinerary_days_id_fk'];

                $confirmedPropertyId = isset($confirmedPropertyByDay[$dayId]) ? $confirmedPropertyByDay[$dayId] : 0;



                // Inclusions of the confirmed property only (all of them when nothing is confirmed)

                $incAmount = 0;

                $incNames  = array();

                foreach ($inclusionRows as $inc) {

                    if (!$this->fp_row_matches_day($inc, $dayId, $dayItinId)) {

                        continue;

                    }

                    if ($confirmedPropertyId && (int)$inc['inclusion_property_id_fk'] !== $confirmedPropertyId) {

                        continue;

                    }

                    $incAmount += (float)$inc['inclusion_amount'];

                    if ($inc['inclusion_name'] !== '') {

                        $incNames[] = $inc['inclusion_name'];

                    }

                }



                $specAmount = 0;

                $specNames  = array();

                foreach ($specialRows as $sr) {

                    if (!$this->fp_row_matches_day($sr, $dayId, $dayItinId)) {

                        continue;

                    }

                    $specAmount += (float)$sr['quotation_special_requirements_cost'];

                    if ($sr['quotation_special_requirements_name'] !== '') {

                        $specNames[] = $sr['quotation_special_requirements_name'];

                    }

                }



                $inclusionsTotal += $incAmount;

                $specialTotal += $specAmount;



                $hotelQuoted = (float)$day['day_cost'];

                $hotelActual = $hotelQuoted;

                $hotelDesc   = '';



                if ($confirmedPropertyId && !empty($reservationQueue[$confirmedPropertyId])) {

                    $res      = array_shift($reservationQueue[$confirmedPropertyId]);

                    $resDisc  = (float)$res['discount_amount'];



                    // Hotel actual = room rent (quoted tariff) minus discount only.

                    // Do NOT use payment scheduler total_amount / discounted_total —

                    // those include property-based inclusion costs which have their

                    // own separate column on the Financial Posting screen.

                    $hotelActual = $hotelQuoted - $resDisc;

                    if ($hotelActual < 0) {

                        $hotelActual = 0;

                    }

                    if ($resDisc > 0) {

                        $hotelDesc = 'Reservation discount: ' . number_format($resDisc, 2, '.', '');

                    }

                }



                $combinedDays[] = array(

                    'day_label' => $day['day_label'],

                    'stay_date' => (!empty($day['accommodation_date']) && $day['accommodation_date'] !== '0000-00-00')

                        ? date('d-m-Y', strtotime($day['accommodation_date']))

                        : '',

                    'stay_day_name' => !empty($day['accommodation_day_name']) ? $day['accommodation_day_name'] : '',

                    'property_name' => ($confirmedPropertyId && isset($propertyNameById[$confirmedPropertyId]))

                        ? $propertyNameById[$confirmedPropertyId]

                        : '',

                    'hotel_cost' => $hotelQuoted,

                    'hotel_quoted' => $hotelQuoted,

                    'hotel_actual' => $hotelActual,

                    'hotel_desc' => $hotelDesc,

                    'inclusions_cost' => $incAmount,

                    'inclusion_desc' => implode(', ', $incNames),

                    'inclusion_names' => implode(', ', $incNames),

                    'special_cost' => $specAmount,

                    'special_desc' => implode(', ', $specNames),

                    'special_names' => implode(', ', $specNames),

                );

            }



            $defaults['days'] = $combinedDays;



            // pre_quoted_amount = quotation_options_total_quote_rate (hotel + driver + margin)

            // plus property-based inclusions and special requirements, which are not

            // included in total_quote_rate but were quoted to the customer on top.

            $defaults['pre_quoted_amount'] = (float)$defaults['pre_quoted_amount'] + $inclusionsTotal + $specialTotal;



            return $defaults;



        } catch (Exception $e) {



            return ['error' => $e->getMessage()];



        }



    }



    /**

     * Match an inclusion / special-requirement row to a quotation day.

     *

     * quotation_property_inclusions and quotation_special_requirements store the

     * day linkage in quotation_itinerary_days_id_fk; quotation_properties_days_id_fk

     * is frequently saved as 0. Match on the itinerary day first and fall back to the

     * properties-day id only when both sides carry a non-zero value.

     */

    private function fp_row_matches_day($row, $dayId, $dayItinId)

    {

        $rowItinId = isset($row['quotation_itinerary_days_id_fk']) ? (int)$row['quotation_itinerary_days_id_fk'] : 0;

        if ($dayItinId && $rowItinId) {

            return $rowItinId === $dayItinId;

        }



        $rowDayId = isset($row['quotation_properties_days_id_fk']) ? (int)$row['quotation_properties_days_id_fk'] : 0;

        if ($dayId && $rowDayId) {

            return $rowDayId === $dayId;

        }



        return false;

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



        ->limit(1)



        ->get()



        ->row_array();



}







public function get_tariff_by_context($lead_id, $day_id_fk, $stay_destination_id, $property_id, $room_cat_id, $override_date = null)



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



    // Rescheduling: use the new travel date for tariff lookups instead of the stored accommodation_date

    if ($override_date && preg_match('/^\d{4}-\d{2}-\d{2}$/', $override_date)) {

        $acc_date = $override_date;

        $acc_day  = date('l', strtotime($override_date));

    }



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







    /* =========================================================



       4) MEAL SUPPLEMENT CALCULATION



       Compare accommodation_plan (guest needs) with room policy

       (room provides). Supplement = cost of meals the room does

       NOT provide but the guest requires.



       ========================================================= */



    $roomMealId = isset($ctx['room_meal_plan_id_fk']) ? (int)$ctx['room_meal_plan_id_fk'] : 0;



    $roomMealName = isset($ctx['room_meal_plan_name']) ? $ctx['room_meal_plan_name'] : '';







    // Meal coverage by plan ID



    $mealCoverage = array(



        1 => array('breakfast'),           // CP



        3 => array('breakfast', 'dinner'), // MAP



        4 => array('breakfast', 'lunch', 'dinner') // AP



    );







    $neededMeals  = isset($mealCoverage[$meal_id]) ? $mealCoverage[$meal_id] : array();



    $providedMeals = isset($mealCoverage[$roomMealId]) ? $mealCoverage[$roomMealId] : array();







    // If guest needs EP (no meals) OR room policy exactly matches enquiry => no supplement



    $needsSupplement = false;



    $missingMeals = array();



    $supplement = 0;







    if ($meal_id != 2 && !empty($neededMeals)) {



        // Find meals needed but not provided by room policy



        foreach ($neededMeals as $m) {



            if (!in_array($m, $providedMeals)) {



                $missingMeals[] = $m;



            }



        }







        if (!empty($missingMeals)) {



            $needsSupplement = true;



        }



    }







    /* ============================



    4A) FETCH MEAL RATES



    ============================ */



    $bA = $bC = $lA = $lC = $dA = $dC = 0;



    $mealRatesSource = '';







    if ($needsSupplement) {



        if ($hike) {



            $bA = (double)$hike['hike_room_tariff_hike_breakfast_rate_adult'];



            $bC = (double)$hike['hike_room_tariff_hike_breakfast_rate_child'];



            $lA = (double)$hike['hike_room_tariff_hike_lunch_rate_adult'];



            $lC = (double)$hike['hike_room_tariff_hike_lunch_rate_child'];



            $dA = (double)$hike['hike_room_tariff_hike_dinner_rate_adult'];



            $dC = (double)$hike['hike_room_tariff_hike_dinner_rate_child'];



            $mealRatesSource = 'hike';



        } else {



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



                $mealRatesSource = 'normal';



            } else {



                $bA = $bC = $lA = $lC = $dA = $dC = 0;



                $mealRatesSource = 'none';



            }



        }



    }







    /* ============================



    4B) CALCULATE SUPPLEMENT FOR MISSING MEALS



    ============================ */



    $mealRatesMissing = array();







    if ($needsSupplement) {



        foreach ($missingMeals as $m) {



            if ($m === 'breakfast') {



                if ($bA > 0 || $bC > 0) {



                    $supplement += ($bA * $adultsForMeal) + ($bC * $childrenForMeal);



                } else {



                    $mealRatesMissing[] = 'breakfast';



                }



            } elseif ($m === 'lunch') {



                if ($lA > 0 || $lC > 0) {



                    $supplement += ($lA * $adultsForMeal) + ($lC * $childrenForMeal);



                } else {



                    $mealRatesMissing[] = 'lunch';



                }



            } elseif ($m === 'dinner') {



                if ($dA > 0 || $dC > 0) {



                    $supplement += ($dA * $adultsForMeal) + ($dC * $childrenForMeal);



                } else {



                    $mealRatesMissing[] = 'dinner';



                }



            }



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



        'room_meal_plan_id_fk' => $roomMealId,



        'room_meal_plan_name' => $roomMealName,



        'used_counts' => array(



            'adults' => $adultsForMeal,



            'children' => $childrenForMeal,



            'baby' => $appliedBaby



        ),



        'supplement_amount' => (double)$supplement,



        'needs_supplement' => $needsSupplement,



        'missing_meals' => $missingMeals,



        'meal_rates_missing' => $mealRatesMissing,



        'meal_rates_source' => $mealRatesSource,



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







public function get_itinerary_days_id_fk_by_properties_day($packages_properties_days_id)

{

    $row = $this->db

        ->select('packages_itinerary_days_id_fk')

        ->from('packages_properties_days')

        ->where('packages_properties_days_id', (int)$packages_properties_days_id)

        ->where('packages_properties_days_status', 1)

        ->get()

        ->row();



    return $row ? (int)$row->packages_itinerary_days_id_fk : 0;

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



        $this->db->select('l.package_id_fk, p.packages_title');



        $this->db->from('leads l');



        $this->db->join('packages p', 'p.packages_id = l.package_id_fk', 'left');



        $this->db->where('l.leads_id', $leads_id);



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



            ->select('packages_properties_common_id, packages_properties_common_category_name, packages_properties_common_design_type, packages_properties_common_complimentary_inclusion')



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







    public function load_properties($destination_id = ''){



        $this->db



            ->select('properties_id,properties_name')



            ->from('properties')



            ->where('properties_status', 1);



        if ($destination_id) {



            $this->db->where('properties_destination_id_fk', $destination_id);



        }



        return $this->db



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



        ->select('q.*,

            iec.inclusion_exclusion_common_title,

            qp.quotation_policies_id_fk,

            pay.payment_policies_name,

            qt.quotation_terms_condition_id_fk,

            tc.terms_condition_name,

            qc.quotation_cancellation_policies_id_fk,

            cp.cancellation_policies_name')



        ->from('quotation q')



        ->join('inclusion_exclusion_common iec', 'iec.inclusion_exclusion_common_id = q.quotation_inclusion_exclusion_common_id_fk', 'left')



        ->join('quotation_payment_policies qp', 'q.quotation_id = qp.quotation_id_fk', 'left')



        ->join('quotation_terms_condition qt', 'q.quotation_id = qt.quotation_id_fk', 'left')



        ->join('quotation_cancellation_policies qc', 'q.quotation_id = qc.quotation_id_fk', 'left')



        ->join('payment_policies pay', 'pay.payment_policies_id = qp.quotation_policies_id_fk', 'left')



        ->join('terms_condition tc', 'tc.terms_condition_id = qt.quotation_terms_condition_id_fk', 'left')



        ->join('cancellation_policies cp', 'cp.cancellation_policies_id = qc.quotation_cancellation_policies_id_fk', 'left')



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







    public function fetch_staff_users()



	{

		$this->db->order_by('admin_name', 'ASC');

		$this->db->where('user_status', 1);

		$this->db->where('user_type', 'S');

		$query = $this->db->get('user_details');

		return $query->result();

	}







    public function getConvertedTripsReport($param = array())



	{



		$guest_name = isset($param['guest_name']) ? $param['guest_name'] : '';

		$trip_code  = isset($param['trip_code'])  ? $param['trip_code']  : '';

		$staff_id   = isset($param['staff_id'])   ? $param['staff_id']   : '';

		$start_date = isset($param['start_date']) ? $param['start_date'] : '';

		$end_date   = isset($param['end_date'])   ? $param['end_date']   : '';

		$date_type  = isset($param['date_type'])  ? $param['date_type']  : 'arrival';

		$date_col   = ($date_type === 'departure') ? 'l.end_date' : 'l.start_date';



		if ($guest_name) {

			$this->db->like('l.guest_name', $guest_name);

		}

		if ($trip_code) {

			$this->db->like('q.trip_code', $trip_code);

		}

		if ($staff_id) {

			$this->db->where('l.staff_id_fk', $staff_id);

		}

		if ($start_date) {

			$this->db->where($date_col . ' >=', $start_date);

		}

		if ($end_date) {

			$this->db->where($date_col . ' <=', $end_date);

		}



		$this->db->where('l.leads_status', 1);

		$this->db->where('l.lead_current_status', 3);



		if (isset($param['length']) && $param['length'] != -1 && isset($param['start']) && $param['start'] != 'false') {

			$this->db->limit($param['length'], $param['start']);

		}



		$this->db->select("

			l.leads_id,

			l.leads_number,

			l.guest_name,

			l.whats_number,

			DATE_FORMAT(l.start_date, '%d-%m-%Y') AS travel_start_date,

			DATE_FORMAT(l.end_date, '%d-%m-%Y') AS travel_end_date,

			l.duration,

			DATE_FORMAT(l.lead_register_date, '%d-%m-%Y') AS lead_register_date,

			ud.admin_name AS staff_name,

			q.quotation_id,

			q.quotation_number,

			q.trip_code,

			COALESCE(gc.total_adults, 0) AS total_adults,

			COALESCE(gc.total_children, 0) AS total_children,

			COALESCE(rs.total_amount, qa.quotation_total_amount, 0) AS pre_quoted_amount

		", FALSE);



		$this->db->from('leads l');

		$this->db->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left');

		$this->db->join('(

			SELECT q1.leads_id_fk, q1.quotation_number, q1.quotation_id, q1.trip_code

			FROM quotation q1

			INNER JOIN (

				SELECT leads_id_fk, MAX(quotation_id) AS max_qid

				FROM quotation

				WHERE quotation_status = 1

				GROUP BY leads_id_fk

			) q2 ON q2.leads_id_fk = q1.leads_id_fk AND q2.max_qid = q1.quotation_id

		) q', 'q.leads_id_fk = l.leads_id', 'left');

		// Pre quoted amount: the customer receipt scheduler total, matching the

		// incentive report. See Receipt_scheduler_model::get_quotation_total_amount().

		$this->db->join('(

			SELECT rs1.quotation_id_fk, rs1.total_amount

			FROM receipt_scheduler rs1

			INNER JOIN (

				SELECT quotation_id_fk, MAX(receipt_scheduler_id) AS max_rs_id

				FROM receipt_scheduler

				WHERE receipt_scheduler_status = 1

				GROUP BY quotation_id_fk

			) rs2 ON rs2.quotation_id_fk = rs1.quotation_id_fk AND rs2.max_rs_id = rs1.receipt_scheduler_id

		) rs', 'rs.quotation_id_fk = q.quotation_id', 'left');

		// Fallback when no scheduler exists yet: confirmed option rate + property

		// inclusions + special requirements.

		$this->db->join('(

			SELECT qc.quotation_id_fk,

				COALESCE(qo.quotation_options_total_quote_rate, 0)

					+ COALESCE(inc.inclusion_total, 0)

					+ COALESCE(sp.special_total, 0) AS quotation_total_amount

			FROM quotation_confirmation qc

			INNER JOIN (

				SELECT quotation_id_fk, MIN(id) AS min_qc_id

				FROM quotation_confirmation

				WHERE property_confirmation_status = 1

				GROUP BY quotation_id_fk

			) qc2 ON qc2.min_qc_id = qc.id

			LEFT JOIN quotation_options qo ON qo.quotation_options_id = qc.option_id_fk

			LEFT JOIN (

				SELECT quotation_id_fk, quotation_options_id_fk, SUM(inclusion_amount) AS inclusion_total

				FROM quotation_property_inclusions

				WHERE quotation_property_inclusions_status = 1

				GROUP BY quotation_id_fk, quotation_options_id_fk

			) inc ON inc.quotation_id_fk = qc.quotation_id_fk AND inc.quotation_options_id_fk = qc.option_id_fk

			LEFT JOIN (

				SELECT quotation_id_fk, SUM(quotation_special_requirements_cost) AS special_total

				FROM quotation_special_requirements

				WHERE quotation_special_requirements_status = 1

				GROUP BY quotation_id_fk

			) sp ON sp.quotation_id_fk = qc.quotation_id_fk

		) qa', 'qa.quotation_id_fk = q.quotation_id', 'left');

		$this->db->join('(

			SELECT gc1.guset_count_lead_id_fk,

				SUM(gcd1.adults) AS total_adults,

				SUM(gcd1.children) AS total_children

			FROM guset_count gc1

			LEFT JOIN guset_count_details gcd1 ON gcd1.guset_count_id_fk = gc1.guset_count_id

				AND gcd1.guset_count_details_status = 1

			WHERE gc1.guset_count_status = 1

			GROUP BY gc1.guset_count_lead_id_fk

		) gc', 'gc.guset_count_lead_id_fk = l.leads_id', 'left');



		$this->db->order_by('l.leads_id', 'DESC');



		$query = $this->db->get();

		$rows  = $query->result();



		$data['data'] = $rows;

		$data['recordsTotal'] = $this->getConvertedTripsReportCount($param);

		$data['recordsFiltered'] = $data['recordsTotal'];



		return $data;

	}







    public function getConvertedTripsReportCount($param = array())



	{

		$guest_name = isset($param['guest_name']) ? $param['guest_name'] : '';

		$trip_code  = isset($param['trip_code'])  ? $param['trip_code']  : '';

		$staff_id   = isset($param['staff_id'])   ? $param['staff_id']   : '';

		$start_date = isset($param['start_date']) ? $param['start_date'] : '';

		$end_date   = isset($param['end_date'])   ? $param['end_date']   : '';

		$date_type  = isset($param['date_type'])  ? $param['date_type']  : 'arrival';

		$date_col   = ($date_type === 'departure') ? 'end_date' : 'start_date';



		if ($guest_name) {

			$this->db->like('guest_name', $guest_name);

		}

		if ($trip_code) {

			$this->db->join('quotation q', 'q.leads_id_fk = leads.leads_id', 'inner');

			$this->db->like('q.trip_code', $trip_code);

		}

		if ($staff_id) {

			$this->db->where('staff_id_fk', $staff_id);

		}

		if ($start_date) {

			$this->db->where($date_col . ' >=', $start_date);

		}

		if ($end_date) {

			$this->db->where($date_col . ' <=', $end_date);

		}



		$this->db->where('leads_status', 1);

		$this->db->where('lead_current_status', 3);

		$this->db->from('leads');



		return $this->db->count_all_results();

	}







	/**

	 * Converted trips that already have a financial posting record.

	 * The quoted amount is the customer receipt scheduler total, so the report

	 * shows the same figure the client is billed.

	 */

    public function getIncentiveReport($param = array())



	{

		$this->_incentiveReportFrom($param);



		if (isset($param['length']) && $param['length'] != -1 && isset($param['start']) && $param['start'] != 'false') {

			$this->db->limit($param['length'], $param['start']);

		}



		$this->db->select("

			l.leads_id,

			l.leads_number,

			l.guest_name,

			DATE_FORMAT(l.start_date, '%d-%m-%Y') AS travel_start_date,

			DATE_FORMAT(l.end_date, '%d-%m-%Y') AS travel_end_date,

			l.duration,

			ud.admin_name AS staff_name,

			q.quotation_number,

			q.trip_code,

			COALESCE(fp.fp_cost_after, 0) AS total_financial_cost,

			COALESCE(rs.total_amount, qa.quotation_total_amount, 0) AS pre_quoted_amount,

			(COALESCE(rs.total_amount, qa.quotation_total_amount, 0) - COALESCE(fp.fp_cost_after, 0)) AS profit

		", FALSE);



		$this->db->order_by('l.leads_id', 'DESC');



		$rows = $this->db->get()->result();



		$slabs = $this->IncentiveConfig_model->get_all_slabs();

		foreach ($rows as $row) {

			$row->incentive = $this->IncentiveConfig_model->calculate_incentive($row->profit, $slabs);

		}



		$data['data'] = $rows;

		$data['recordsTotal'] = $this->getIncentiveReportCount($param);

		$data['recordsFiltered'] = $data['recordsTotal'];

		$data['totals'] = $this->getIncentiveReportTotals($param);



		return $data;

	}







    public function getIncentiveReportTotals($param = array())



	{

		$this->_incentiveReportFrom($param);



		$this->db->select("

			COALESCE(SUM(COALESCE(rs.total_amount, qa.quotation_total_amount, 0)), 0) AS total_pre_quoted,

			COALESCE(SUM(COALESCE(fp.fp_cost_after, 0)), 0) AS total_cost,

			COALESCE(SUM(COALESCE(rs.total_amount, qa.quotation_total_amount, 0) - COALESCE(fp.fp_cost_after, 0)), 0) AS total_profit

		", FALSE);



		$query = $this->db->get();

		$result = $query->row();



		$rows = $this->_getIncentiveReportAllRows($param);

		$slabs = $this->IncentiveConfig_model->get_all_slabs();

		$total_incentive = 0;

		foreach ($rows as $row) {

			$total_incentive += $this->IncentiveConfig_model->calculate_incentive(floatval($row->profit), $slabs);

		}



		return array(

			'total_pre_quoted' => floatval($result->total_pre_quoted),

			'total_cost'       => floatval($result->total_cost),

			'total_profit'     => floatval($result->total_profit),

			'total_incentive'  => floatval($total_incentive)

		);

	}



	private function _getIncentiveReportAllRows($param = array())

	{

		$this->_incentiveReportFrom($param);



		$this->db->select("

			(COALESCE(rs.total_amount, qa.quotation_total_amount, 0) - COALESCE(fp.fp_cost_after, 0)) AS profit

		", FALSE);



		$this->db->order_by('l.leads_id', 'DESC');

		return $this->db->get()->result();

	}







    public function getIncentiveReportCount($param = array())



	{

		$this->_incentiveReportFrom($param);



		return $this->db->count_all_results();

	}







	/**

	 * Listing for the standalone financial posting page: one row per quotation

	 * that already has a financial posting record.

	 */

    public function getFinancialPostingList($param = array())



	{

		$this->_financialPostingListFrom($param);



		if (isset($param['length']) && $param['length'] != -1 && isset($param['start']) && $param['start'] != 'false') {

			$this->db->limit($param['length'], $param['start']);

		}



		$this->db->select("

			l.leads_id,

			l.guest_name,

			DATE_FORMAT(l.start_date, '%d-%m-%Y') AS travel_start_date,

			DATE_FORMAT(l.end_date, '%d-%m-%Y') AS travel_end_date,

			l.duration,

			ud.admin_name AS staff_name,

			q.quotation_id,

			q.quotation_number,

			q.trip_code,

			fp.fp_id,

			COALESCE(fp.fp_cost_after, 0) AS actual_cost,

			COALESCE(rs.total_amount, qa.quotation_total_amount, 0) AS pre_quoted_amount,

			(COALESCE(rs.total_amount, qa.quotation_total_amount, 0) - COALESCE(fp.fp_cost_after, 0)) AS total_margin

		", FALSE);



		$this->db->order_by('fp.fp_id', 'DESC');



		$data['data'] = $this->db->get()->result();

		$data['recordsTotal'] = $this->getFinancialPostingListCount($param);

		$data['recordsFiltered'] = $data['recordsTotal'];



		return $data;

	}







    public function getFinancialPostingListCount($param = array())



	{

		$this->_financialPostingListFrom($param);



		return $this->db->count_all_results();

	}







	private function _financialPostingListFrom($param = array())

	{

		$search = isset($param['search']) ? $param['search'] : '';



		if ($search) {

			$this->db->group_start();

			$this->db->like('q.quotation_number', $search);

			$this->db->or_like('q.trip_code', $search);

			$this->db->or_like('l.guest_name', $search);

			$this->db->group_end();

		}



		$this->db->where('l.leads_status', 1);



		$this->db->from('leads l');

		$this->db->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left');

		$this->db->join('(

			SELECT q1.leads_id_fk, q1.quotation_number, q1.quotation_id, q1.trip_code

			FROM quotation q1

			INNER JOIN (

				SELECT leads_id_fk, MAX(quotation_id) AS max_qid

				FROM quotation

				WHERE quotation_status = 1

				GROUP BY leads_id_fk

			) q2 ON q2.leads_id_fk = q1.leads_id_fk AND q2.max_qid = q1.quotation_id

		) q', 'q.leads_id_fk = l.leads_id', 'inner');

		// INNER JOIN: only leads with a saved financial posting are listed

		$this->db->join('(

			SELECT fp1.fp_leads_id_fk, fp1.fp_id, fp1.fp_cost_after

			FROM financial_posting fp1

			INNER JOIN (

				SELECT fp_leads_id_fk, MAX(fp_id) AS max_fp_id

				FROM financial_posting

				GROUP BY fp_leads_id_fk

			) fp2 ON fp2.fp_leads_id_fk = fp1.fp_leads_id_fk AND fp2.max_fp_id = fp1.fp_id

		) fp', 'fp.fp_leads_id_fk = l.leads_id', 'inner');

		$this->db->join('(

			SELECT rs1.quotation_id_fk, rs1.total_amount

			FROM receipt_scheduler rs1

			INNER JOIN (

				SELECT quotation_id_fk, MAX(receipt_scheduler_id) AS max_rs_id

				FROM receipt_scheduler

				WHERE receipt_scheduler_status = 1

				GROUP BY quotation_id_fk

			) rs2 ON rs2.quotation_id_fk = rs1.quotation_id_fk AND rs2.max_rs_id = rs1.receipt_scheduler_id

		) rs', 'rs.quotation_id_fk = q.quotation_id', 'left');

		$this->db->join('(

			SELECT qc.quotation_id_fk,

				COALESCE(qo.quotation_options_total_quote_rate, 0)

					+ COALESCE(inc.inclusion_total, 0)

					+ COALESCE(sp.special_total, 0) AS quotation_total_amount

			FROM quotation_confirmation qc

			INNER JOIN (

				SELECT quotation_id_fk, MIN(id) AS min_qc_id

				FROM quotation_confirmation

				WHERE property_confirmation_status = 1

				GROUP BY quotation_id_fk

			) qc2 ON qc2.min_qc_id = qc.id

			LEFT JOIN quotation_options qo ON qo.quotation_options_id = qc.option_id_fk

			LEFT JOIN (

				SELECT quotation_id_fk, quotation_options_id_fk, SUM(inclusion_amount) AS inclusion_total

				FROM quotation_property_inclusions

				WHERE quotation_property_inclusions_status = 1

				GROUP BY quotation_id_fk, quotation_options_id_fk

			) inc ON inc.quotation_id_fk = qc.quotation_id_fk AND inc.quotation_options_id_fk = qc.option_id_fk

			LEFT JOIN (

				SELECT quotation_id_fk, SUM(quotation_special_requirements_cost) AS special_total

				FROM quotation_special_requirements

				WHERE quotation_special_requirements_status = 1

				GROUP BY quotation_id_fk

			) sp ON sp.quotation_id_fk = qc.quotation_id_fk

		) qa', 'qa.quotation_id_fk = q.quotation_id', 'left');

	}







	/**

	 * Trip-completed quotations that do not have a financial posting yet.

	 * Feeds the "Add Financial Posting" picker.

	 */

	public function getTripCompletedQuotationsForPosting($search = '', $limit = 30)

	{

		if ($search) {

			$this->db->group_start();

			$this->db->like('q.quotation_number', $search);

			$this->db->or_like('q.trip_code', $search);

			$this->db->or_like('l.guest_name', $search);

			$this->db->group_end();

		}



		$this->db->select("

			q.quotation_id,

			q.quotation_number,

			q.trip_code,

			l.leads_id,

			l.leads_number,

			l.guest_name,

			DATE_FORMAT(l.start_date, '%d-%m-%Y') AS travel_start_date

		", FALSE);

		$this->db->from('quotation q');

		$this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');

		$this->db->where('q.quotation_status', 1);

		$this->db->where('q.quotation_current_status', 10); // Trip Completed

		$this->db->where('l.leads_status', 1);

		$this->db->where('NOT EXISTS (SELECT 1 FROM financial_posting fp WHERE fp.fp_leads_id_fk = l.leads_id)', NULL, FALSE);

		$this->db->order_by('q.quotation_id', 'DESC');

		$this->db->limit($limit);



		return $this->db->get()->result();

	}







	/**

	 * Shared FROM/JOIN/WHERE for the incentive report and its row count.

	 */

	private function _incentiveReportFrom($param = array())

	{

		$guest_name = isset($param['guest_name']) ? $param['guest_name'] : '';

		$staff_id   = isset($param['staff_id'])   ? $param['staff_id']   : '';

		$trip_code  = isset($param['trip_code'])  ? $param['trip_code']  : '';

		$start_date = isset($param['start_date']) ? $param['start_date'] : '';

		$end_date   = isset($param['end_date'])   ? $param['end_date']   : '';

		$date_type  = isset($param['date_type'])  ? $param['date_type']  : 'arrival';

		$date_col   = ($date_type === 'departure') ? 'l.end_date' : 'l.start_date';



		if ($guest_name) {

			$this->db->like('l.guest_name', $guest_name);

		}

		if ($staff_id) {

			$this->db->where('l.staff_id_fk', $staff_id);

		}

		if ($start_date) {

			$this->db->where($date_col . ' >=', $start_date);

		}

		if ($end_date) {

			$this->db->where($date_col . ' <=', $end_date);

		}



		$this->db->where('l.leads_status', 1);

		$this->db->where('l.lead_current_status', 3);



		$this->db->from('leads l');

		$this->db->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left');

		$this->db->join('(

			SELECT q1.leads_id_fk, q1.quotation_number, q1.quotation_id, q1.trip_code

			FROM quotation q1

			INNER JOIN (

				SELECT leads_id_fk, MAX(quotation_id) AS max_qid

				FROM quotation

				WHERE quotation_status = 1

				GROUP BY leads_id_fk

			) q2 ON q2.leads_id_fk = q1.leads_id_fk AND q2.max_qid = q1.quotation_id

		) q', 'q.leads_id_fk = l.leads_id', 'left');

		// INNER JOIN: only trips whose financial posting is done appear in this report

		$this->db->join('(

			SELECT fp1.fp_leads_id_fk, fp1.fp_cost_after

			FROM financial_posting fp1

			INNER JOIN (

				SELECT fp_leads_id_fk, MAX(fp_id) AS max_fp_id

				FROM financial_posting

				GROUP BY fp_leads_id_fk

			) fp2 ON fp2.fp_leads_id_fk = fp1.fp_leads_id_fk AND fp2.max_fp_id = fp1.fp_id

		) fp', 'fp.fp_leads_id_fk = l.leads_id', 'inner');

		// Customer receipt scheduler total; the amount the client is actually billed.

		$this->db->join('(

			SELECT rs1.quotation_id_fk, rs1.total_amount

			FROM receipt_scheduler rs1

			INNER JOIN (

				SELECT quotation_id_fk, MAX(receipt_scheduler_id) AS max_rs_id

				FROM receipt_scheduler

				WHERE receipt_scheduler_status = 1

				GROUP BY quotation_id_fk

			) rs2 ON rs2.quotation_id_fk = rs1.quotation_id_fk AND rs2.max_rs_id = rs1.receipt_scheduler_id

		) rs', 'rs.quotation_id_fk = q.quotation_id', 'left');

		// Fallback when no scheduler exists yet: same formula the scheduler is built

		// from - confirmed option rate + property inclusions + special requirements.

		// See Receipt_scheduler_model::get_quotation_total_amount().

		$this->db->join('(

			SELECT qc.quotation_id_fk,

				COALESCE(qo.quotation_options_total_quote_rate, 0)

					+ COALESCE(inc.inclusion_total, 0)

					+ COALESCE(sp.special_total, 0) AS quotation_total_amount

			FROM quotation_confirmation qc

			INNER JOIN (

				SELECT quotation_id_fk, MIN(id) AS min_qc_id

				FROM quotation_confirmation

				WHERE property_confirmation_status = 1

				GROUP BY quotation_id_fk

			) qc2 ON qc2.min_qc_id = qc.id

			LEFT JOIN quotation_options qo ON qo.quotation_options_id = qc.option_id_fk

			LEFT JOIN (

				SELECT quotation_id_fk, quotation_options_id_fk, SUM(inclusion_amount) AS inclusion_total

				FROM quotation_property_inclusions

				WHERE quotation_property_inclusions_status = 1

				GROUP BY quotation_id_fk, quotation_options_id_fk

			) inc ON inc.quotation_id_fk = qc.quotation_id_fk AND inc.quotation_options_id_fk = qc.option_id_fk

			LEFT JOIN (

				SELECT quotation_id_fk, SUM(quotation_special_requirements_cost) AS special_total

				FROM quotation_special_requirements

				WHERE quotation_special_requirements_status = 1

				GROUP BY quotation_id_fk

			) sp ON sp.quotation_id_fk = qc.quotation_id_fk

		) qa', 'qa.quotation_id_fk = q.quotation_id', 'left');



		if ($trip_code) {

			$this->db->like('q.trip_code', $trip_code);

		}

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



        ->select('q.*, l.leads_number, l.guest_name, p.packages_title, DATE_FORMAT(quotation_date,\'%d-%m-%Y\') as quotation_date')



        ->from('quotation q')



        ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')



        ->join('packages p', 'p.packages_id = q.package_id_fk', 'left')



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



                s.state_name, ap.accommodation_date,



                COALESCE(ppd.packages_itinerary_days_id_fk, ap.day_id_fk) as packages_itinerary_days_id_fk



            ')



            ->from('quotation_properties_days qpd')



            ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')



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



                        ->select('qpr.*, prc.properties_room_category_name')



                        ->from('quotation_properties_rooms qpr')



                        ->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')



                        ->where('qpr.quotation_properties_id_fk', $property['quotation_properties_id'])



                        ->where('qpr.quotation_properties_rooms_status', 1)



                        ->order_by('qpr.quotation_properties_rooms_id', 'ASC')



                        ->get()



                        ->result_array();







                    // For each room, find the most recent tariff by matching room category



                    // (packages_properties_rooms_id_fk), since the tariff's room FK may point



                    // to an old room row PK after update



                    foreach ($rooms as &$room) {



                        $tariff = $this->db



                            ->select('qrtd.quotation_room_tariff_details_id, qrtd.auto_total_rate, qrtd.manual_total_rate')



                            ->from('quotation_room_tariff_details qrtd')



                            ->join('quotation_properties_rooms qpr2', 'qpr2.quotation_properties_rooms_id = qrtd.quotation_properties_rooms_id_fk', 'inner')



                            ->join('quotation_properties qp2', 'qp2.quotation_properties_id = qpr2.quotation_properties_id_fk', 'inner')



                            ->join('quotation_properties_days qpd2', 'qpd2.quotation_properties_days_id = qp2.quotation_properties_days_id_fk', 'inner')



                            ->where('qrtd.quotation_id_fk', (int)$quotation_id)



                            ->where('qpr2.packages_properties_rooms_id_fk', (int)$room['packages_properties_rooms_id_fk'])



                            ->where('qpd2.quotation_options_id_fk', (int)$option['quotation_options_id'])



                            ->order_by('qrtd.quotation_room_tariff_details_status', 'DESC')



                            ->order_by('qrtd.quotation_room_tariff_details_id', 'DESC')



                            ->limit(1)



                            ->get()



                            ->row_array();



                        if ($tariff) {



                            $room['quotation_room_tariff_details_id'] = $tariff['quotation_room_tariff_details_id'];



                            $room['auto_total_rate'] = $tariff['auto_total_rate'];



                            $room['manual_total_rate'] = $tariff['manual_total_rate'];



                        } else {



                            $room['quotation_room_tariff_details_id'] = null;



                            $room['auto_total_rate'] = 0;



                            $room['manual_total_rate'] = 0;



                        }



                    }







                    $property['rooms'] = $rooms;



                }







                $day['properties'] = $properties;



            }







            $option['days'] = $days;



        }







        return $options;



    }







    public function get_quotation_property_inclusions($quotation_id, $option_id = null)



    {



        $this->db



            ->select('qpi.*, p.properties_name as property_name, pi.property_inclusions_name as inclusion_name_label')



            ->from('quotation_property_inclusions qpi')



            ->join('properties p', 'p.properties_id = qpi.inclusion_property_id_fk', 'left')



            ->join('property_inclusions pi', 'pi.property_inclusions_id = qpi.property_inclusions_id_fk', 'left')



            ->where('qpi.quotation_id_fk', $quotation_id)



            ->where('qpi.quotation_property_inclusions_status', 1);



        if ($option_id !== null && (int)$option_id > 0) {



            $this->db->where('qpi.quotation_options_id_fk', (int)$option_id);



        }



        $this->db->order_by('qpi.quotation_property_inclusions_id', 'ASC');



        return $this->db



            ->get()



            ->result_array();



    }







    public function get_quotation_special_requirements($quotation_id)



    {



        return $this->db



            ->select('qsr.*, qsr.quotation_special_requirements_name')



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



            'prepared_by'         => $this->get_prepared_by_user($quotation->quotation_created_by_userid),



        );



    }







    public function get_default_account_details()



    {



        return $this->db



            ->where('account_details_status', 1)



            ->get('account_details')->result();



    }



    public function get_prepared_by_user($user_id)



    {



        $this->db->select('ud.user_id, ud.admin_name, ud.user_email_address, ud.user_phone_number, d.designation_name');



        $this->db->from('user_details ud');



        $this->db->join('designation d', 'd.designation_id = ud.designation_id_fk', 'left');



        $this->db->where('ud.user_id', $user_id);



        $this->db->where('ud.user_status', 1);



        $query = $this->db->get();



        return $query->row();



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







    $start = date('d M', strtotime($start_date));

    $end   = date('d M Y', strtotime($end_date));





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



            ->select('qid.*, qpd.quotation_properties_days_id, qpd.quotation_properties_days_day, qpd.packages_properties_days_id_fk, qpd.accommodation_plan_id_fk, qpd.quotation_properties_days_destination_id_fk, qpd.quotation_properties_days_status, s.state_name')



            ->from('quotation_itinerary_days qid')



            ->join('quotation_properties_days qpd', 'qpd.quotation_itinerary_days_id_fk = qid.quotation_itinerary_days_id AND qpd.quotation_options_id_fk = ' . (int)$option->quotation_options_id . ' AND qpd.quotation_properties_days_status = 1', 'left')



            ->join('state s', 's.state_id = COALESCE(qpd.quotation_properties_days_destination_id_fk, qid.quotation_itineraries_days_destination_id_fk)', 'left')



            ->where('qid.quotation_id_fk', $quotation_id)



            ->where('qid.quotation_itinerary_days_status', 1)



            ->order_by('qid.quotation_itinerary_days_id', 'ASC')



            ->get()



            ->result();







        foreach ($option->days as &$day) {







            if (!empty($day->quotation_properties_days_id)) {



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



            } else {



                $day->rows = array();



                $day->meal_plan = '';



            }



        }







        // preview_total_amount calculated below after per-option inclusions/specials are fetched







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







// quotation_options_total_quote_rate already includes hotel + cab + inclusions + specials + margin
// So preview_total_amount = quote_rate (no need to add inclusions/specials again)
$option->preview_total_amount = (float)$option->quotation_options_total_quote_rate;



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



        ->select('qsr.*, qsr.quotation_special_requirements_name as special_requirements_name')



        ->from('quotation_special_requirements qsr')



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



    public function get_client_confirmation_preview($quotation_id)

    {

        $main = $this->db

            ->select('

            q.quotation_id,

            q.quotation_number,

            q.leads_id_fk,

            q.arriving_destination,

            q.departuring_destination,

            q.quotation_created_by_username,

            qc.created_by as confirmation_created_by,

            qo.quotation_options_total_quote_rate,

            qo.quotation_options_cab_amount,

            qo.quotation_options_margin_value,

            l.guest_name,

            l.start_date,

            l.end_date,

            l.duration,

            qo.quotation_options_id,

            qo.quotation_options_title,

            v.vehicle_name

        ')

            ->from('quotation_confirmation qc')

            ->join('quotation q', 'q.quotation_id = qc.quotation_id_fk', 'left')

            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

            ->join('quotation_options qo', 'qo.quotation_options_id = qc.option_id_fk', 'left')

            ->join('vehicle v', 'v.vehicle_id = qo.quotation_options_vehicle_id_fk', 'left')

            ->where('q.quotation_id', $quotation_id)

            ->where('qc.property_confirmation_status', 1)

            ->get()

            ->row_array();



        if (!$main) return array();



        /* Fetch prepared-by user details from quotation_confirmation.created_by */

        $prepared_by = null;

        if (!empty($main['confirmation_created_by'])) {

            $prepared_by = $this->get_prepared_by_user($main['confirmation_created_by']);

        }

        $main['prepared_by_user'] = $prepared_by;



    

    $rooms = $this->db

        ->select('

            qc.*,



            qpd.quotation_properties_days_id,

            qpd.quotation_properties_days_day,



            ap.accommodation_day_name,

            ap.accommodation_date,

            ap.guset_count_details_id_fk,

            ap.lead_id_fk,

            ap.day_id_fk,

            ap.stay_destination_id_fk,



            s.state_name,



            qp.quotation_properties_id,

            qp.properties_id_fk,



            p.properties_name,



            qpr.quotation_properties_rooms_id,

            qpr.quotation_properties_rooms_id_fk,



            prc.properties_room_category_name,



            mp.meal_plan_name,



            gcd.adults,

            gcd.children,



            qrtd.room_unit_manual_count,

            qrtd.single_occupancy_manual_count,

            qrtd.extra_bed_adult_manual_count,

            qrtd.extra_bed_child_manual_count,

            qrtd.child_sharing_bed_manual_count

        ')

        ->from('quotation_confirmation qc')



        // confirmed option

        ->join('quotation_options qo', 'qo.quotation_options_id = qc.option_id_fk', 'inner')



        // confirmed day only

        ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')



        // accommodation for that day

        ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')

        ->join('state s', 's.state_id = ap.stay_destination_id_fk', 'left')



        // confirmed property only

        ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')

        ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')



        // confirmed room only

        ->join('quotation_properties_rooms qpr', 'qpr.quotation_properties_rooms_id = qc.properties_room_id_fk', 'inner')

        ->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')



        ->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id', 'left')

        ->join('guset_count_details gcd', 'gcd.guset_count_details_id = ap.guset_count_details_id_fk', 'left')

        ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')



        ->where('qc.quotation_id_fk', $quotation_id)

        ->where('qc.option_id_fk', $main['quotation_options_id'])

        ->where('qc.property_confirmation_status', 1)



        ->order_by('ap.accommodation_date', 'ASC')

        ->order_by('qpd.quotation_properties_days_id', 'ASC')

        ->order_by('qp.quotation_properties_id', 'ASC')

        ->order_by('qpr.quotation_properties_rooms_id', 'ASC')



        ->get()

        ->result_array();

    foreach ($rooms as $key => $r) {



        $lead_id = !empty($r['lead_id_fk']) ? (int)$r['lead_id_fk'] : (int)$main['leads_id_fk'];



        $day_id_fk = !empty($r['day_id_fk']) ? (int)$r['day_id_fk'] : 0;

        $stay_destination_id = !empty($r['stay_destination_id_fk']) ? (int)$r['stay_destination_id_fk'] : 0;

        $property_id = !empty($r['properties_id_fk']) ? (int)$r['properties_id_fk'] : 0;

        $room_cat_id = !empty($r['quotation_properties_rooms_id_fk']) ? (int)$r['quotation_properties_rooms_id_fk'] : 0;



        $rooms[$key]['applied_plan'] = $this->get_applied_plan_by_context(

            $lead_id,

            $day_id_fk,

            $stay_destination_id,

            $property_id,

            $room_cat_id

        );

    }

        $inclusions = $this->db

            ->select('

                qpi.accommodation_date,

                p.properties_name,

                pi.property_inclusions_name

            ')

            ->from('quotation_property_inclusions qpi')

            ->join('properties p', 'p.properties_id = qpi.inclusion_property_id_fk', 'left')

            ->join('property_inclusions pi', 'pi.property_inclusions_id = qpi.property_inclusions_id_fk', 'left')

            ->where('qpi.quotation_id_fk', $main['quotation_id'])

            ->where('qpi.quotation_options_id_fk', $main['quotation_options_id'])

            ->where('qpi.quotation_property_inclusions_status', 1)

            ->get()

            ->result_array();



        $special_requirements = $this->db

        ->select('

            qsr.quotation_special_requirements_cost,

            qsr.accommodation_date,

            qsr.quotation_special_requirements_name as special_requirements_name

        ')

        ->from('quotation_special_requirements qsr')

        ->where('qsr.quotation_id_fk', $main['quotation_id'])

        // ->where('qsr.quotation_options_id_fk', $main['quotation_options_id'])

        ->where('qsr.quotation_special_requirements_status', 1)

        ->get()

        ->result_array();



        $inclusion_total = $this->db

        ->select_sum('inclusion_amount')

        ->where('quotation_id_fk', $main['quotation_id'])

        ->where('quotation_options_id_fk', $main['quotation_options_id'])

        ->where('quotation_property_inclusions_status', 1)

        ->get('quotation_property_inclusions')

        ->row();



        $inclusion_total = (float)$inclusion_total->inclusion_amount;



        $special_total = $this->db

        ->select_sum('quotation_special_requirements_cost')

        ->where('quotation_id_fk', $main['quotation_id'])

        // ->where('quotation_options_id_fk', $main['quotation_options_id'])

        ->where('quotation_special_requirements_status', 1)

        ->get('quotation_special_requirements')

        ->row();



        $special_total = (float)$special_total->quotation_special_requirements_cost;



        // Calculate hotel total dynamically from confirmed rooms

        $hotelRow = $this->db

            ->select('COALESCE(SUM(day_max.max_rate),0) as total')

            ->from('(SELECT MAX(qpr.total_room_cost) as max_rate

                FROM quotation_confirmation qc2

                INNER JOIN quotation_properties_days qpd ON qpd.quotation_properties_days_id = qc2.properties_day_id_fk

                INNER JOIN quotation_properties qp ON qp.quotation_properties_days_id_fk = qpd.quotation_properties_days_id

                INNER JOIN quotation_properties_rooms qpr ON qpr.quotation_properties_id_fk = qp.quotation_properties_id

                WHERE qc2.quotation_id_fk = ' . (int)$main['quotation_id'] . '

                AND qc2.option_id_fk = ' . (int)$main['quotation_options_id'] . '

                AND qc2.property_confirmation_status = 1

                AND qpd.quotation_properties_days_status = 1

                AND qp.quotation_properties_status = 1

                AND qpr.quotation_properties_rooms_status = 1

                GROUP BY qpd.quotation_properties_days_id

            ) as day_max')

            ->get()->row();

        $hotel_total = $hotelRow ? (float)$hotelRow->total : 0;



        $main['final_quoted_price'] =

        $hotel_total

        + (float)$main['quotation_options_cab_amount']

        + (float)$main['quotation_options_margin_value']

        + $inclusion_total

        + $special_total;

        // Get payment schedule (receipt scheduler installments) with paid amounts

        $payment_schedule = $this->db

            ->select('

                i.installment_id,

                i.due_date,

                i.calculated_amount,

                i.payment_status,

                IFNULL(p.paid_amount, 0) as paid_amount

            ')

            ->from('receipt_scheduler_installments i')

            ->join('receipt_scheduler rs', 'rs.receipt_scheduler_id = i.receipt_scheduler_id_fk', 'left')

            ->join('(

                SELECT installment_id_fk, SUM(payment_amount) as paid_amount

                FROM receipt_scheduler_payments

                WHERE payment_status = 1

                GROUP BY installment_id_fk

            ) p', 'p.installment_id_fk = i.installment_id', 'left')

            ->where('rs.quotation_id_fk', $main['quotation_id'])

            ->where('i.installment_status', 1)

            ->order_by('i.due_date', 'ASC')

            ->get()

            ->result_array();



        $account = $this->db

            ->where('account_details_status', 1)

            ->get('account_details')

            ->row_array();



        return array(

            'main' => $main,

            'rooms' => $rooms,

            'inclusions' => $inclusions,

            'special_requirements' => $special_requirements,

            'payment_schedule' => $payment_schedule,

            'account' => $account

        );

    }



    /**

     * Full trip details for the converted trips report modal.

     * Builds on the client confirmation preview (confirmed option, per-day

     * properties, inclusions, special requirements, payment schedule) and adds

     * the lead contact block, trip code, transport allocation and guest counts.

     */

    public function get_converted_trip_details($quotation_id)

    {

        $quotation_id = (int)$quotation_id;



        $data = $this->get_client_confirmation_preview($quotation_id);



        if (empty($data) || empty($data['main'])) {

            return array();

        }



        $extra = $this->db

            ->select("

                q.quotation_id,

                q.trip_code,

                q.quotation_title,

                l.leads_id,

                l.leads_number,

                l.lead_type,

                l.leads_email,

                l.leads_address,

                l.whats_number,

                l.alternative_number,

                DATEDIFF(l.end_date, l.start_date) AS total_nights,

                ud.admin_name AS staff_name,

                pc.package_category_name

            ", FALSE)

            ->from('quotation q')

            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

            ->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left')

            ->join('package_category pc', 'pc.package_category_id = l.leads_package_category_id_fk', 'left')

            ->where('q.quotation_id', $quotation_id)

            ->get()

            ->row_array();



        if ($extra) {

            $data['main'] = array_merge($data['main'], $extra);

        }



        $data['transport'] = $this->db

            ->select('qta.driver_name, qta.driver_mobile, qta.cab_number, t.transporter_name')

            ->from('quotation_transport_allocation qta')

            ->join('transporter t', 't.user_id_fk = qta.transporter_id_fk', 'left')

            ->where('qta.quotation_id_fk', $quotation_id)

            ->where('qta.status', 1)

            ->get()

            ->result_array();



        $guests = $this->db

            ->select('SUM(gcd.adults) AS total_adults, SUM(gcd.children) AS total_children', FALSE)

            ->from('guset_count gc')

            ->join('guset_count_details gcd', 'gcd.guset_count_id_fk = gc.guset_count_id AND gcd.guset_count_details_status = 1', 'left')

            ->where('gc.guset_count_lead_id_fk', $data['main']['leads_id_fk'])

            ->where('gc.guset_count_status', 1)

            ->get()

            ->row_array();



        $data['main']['total_adults']   = isset($guests['total_adults'])   ? (int)$guests['total_adults']   : 0;

        $data['main']['total_children'] = isset($guests['total_children']) ? (int)$guests['total_children'] : 0;



        // Package cost shown to the client: the receipt scheduler total, falling

        // back to the confirmation preview figure when no scheduler exists yet.

        $scheduler = $this->db

            ->select('total_amount')

            ->from('receipt_scheduler')

            ->where('quotation_id_fk', $quotation_id)

            ->where('receipt_scheduler_status', 1)

            ->order_by('receipt_scheduler_id', 'DESC')

            ->limit(1)

            ->get()

            ->row_array();



        $data['main']['package_cost'] = !empty($scheduler['total_amount'])

            ? (float)$scheduler['total_amount']

            : (float)(isset($data['main']['final_quoted_price']) ? $data['main']['final_quoted_price'] : 0);



        return $data;

    }



    public function get_property_reservation_preview($quotation_id)

    {

        $main = $this->db

            ->select('q.*, l.guest_name, l.start_date, l.end_date, l.duration')

            ->from('quotation q')

            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

            ->where('q.quotation_id', $quotation_id)

            ->get()

            ->row_array();



        $rows = $this->db

        ->select('

            qc.id as confirmation_id,

            qc.option_id_fk,

            qc.properties_day_id_fk,

            qc.properties_id_fk as confirmed_quotation_property_id,

            qc.properties_room_id_fk as confirmed_quotation_room_id,



            qpd.quotation_properties_days_id,

            qpd.quotation_properties_days_day,



            ap.accommodation_date,

            ap.accommodation_day_name,

            ap.guset_count_details_id_fk,

            ap.lead_id_fk,

            ap.day_id_fk,

            ap.stay_destination_id_fk,



            s.state_name,



            qp.quotation_properties_id,

            qp.properties_id_fk,



            p.properties_name,



            qpr.quotation_properties_rooms_id,

            qpr.quotation_properties_rooms_id_fk,



            prc.properties_room_category_name,



            qrtd.room_unit_manual_count,

            qrtd.single_occupancy_manual_count,

            qrtd.extra_bed_adult_manual_count,

            qrtd.extra_bed_child_manual_count,

            qrtd.child_sharing_bed_manual_count,

            qrtd.manual_total_rate,



            gcd.adults,

            gcd.children,



            mp.meal_plan_name

        ')

        ->from('quotation_confirmation qc')



        // confirmed day only

        ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')



        // accommodation of that day

        ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')

        ->join('state s', 's.state_id = ap.stay_destination_id_fk', 'left')



        // confirmed property only

        ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')

        ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')



        // confirmed room only

        ->join('quotation_properties_rooms qpr', 'qpr.quotation_properties_rooms_id = qc.properties_room_id_fk', 'inner')

        ->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')



        ->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id', 'left')

        ->join('guset_count_details gcd', 'gcd.guset_count_details_id = ap.guset_count_details_id_fk', 'left')

        ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')



        ->where('qc.quotation_id_fk', $quotation_id)

        ->where('qc.property_confirmation_status', 1)



        ->where('qpd.quotation_properties_days_status', 1)

        ->where('qp.quotation_properties_status', 1)

        ->where('qpr.quotation_properties_rooms_status', 1)



        ->order_by('ap.accommodation_date', 'ASC')

        ->order_by('qp.quotation_properties_id', 'ASC')

        ->order_by('qpr.quotation_properties_rooms_id', 'ASC')

        ->get()

        ->result_array();



        foreach ($rows as $key => $r) {



        $lead_id = !empty($r['lead_id_fk']) ? (int)$r['lead_id_fk'] : 0;

        $day_id_fk = !empty($r['day_id_fk']) ? (int)$r['day_id_fk'] : 0;

        $stay_destination_id = !empty($r['stay_destination_id_fk']) ? (int)$r['stay_destination_id_fk'] : 0;

        $property_id = !empty($r['properties_id_fk']) ? (int)$r['properties_id_fk'] : 0;

        $room_cat_id = !empty($r['quotation_properties_rooms_id_fk']) ? (int)$r['quotation_properties_rooms_id_fk'] : 0;



        $rows[$key]['applied_plan'] = $this->get_applied_plan_by_context(

            $lead_id,

            $day_id_fk,

            $stay_destination_id,

            $property_id,

            $room_cat_id

        );



        // Fetch property-based inclusions for this property

        $rows[$key]['property_inclusions'] = $this->db

            ->select('qpi.inclusion_name, qpi.inclusion_amount')

            ->from('quotation_property_inclusions qpi')

            ->where('qpi.quotation_id_fk', (int)$quotation_id)

            ->where('qpi.inclusion_property_id_fk', $property_id)

            ->where('qpi.quotation_property_inclusions_status', 1)

            ->order_by('qpi.inclusion_name', 'ASC')

            ->get()

            ->result_array();

    }



        /* Fetch prepared-by user details from property_reservation.property_reservation_created_by_userid */

        $prepared_by = null;

        $resUserRow = $this->db

            ->select('property_reservation_created_by_userid')

            ->from('property_reservation')

            ->where('quotation_id_fk', $quotation_id)

            ->where('property_reservation_status', 1)

            ->limit(1)

            ->get()

            ->row_array();

        if ($resUserRow && !empty($resUserRow['property_reservation_created_by_userid'])) {

            $prepared_by = $this->get_prepared_by_user($resUserRow['property_reservation_created_by_userid']);

        }



        return array(

            'main' => $main,

            'properties' => $rows,

            'prepared_by_user' => $prepared_by

        );

    }



    public function get_property_voucher_preview($quotation_id)

    {

        $main = $this->db

            ->select('q.*, l.guest_name, l.start_date, l.end_date, l.duration, l.whats_number')

            ->from('quotation q')

            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

            ->where('q.quotation_id', $quotation_id)

            ->get()

            ->row_array();



        $rows = $this->db

        ->select('

            qc.id as confirmation_id,

            qc.option_id_fk,

            qc.properties_day_id_fk,

            qc.properties_id_fk as confirmed_quotation_property_id,

            qc.properties_room_id_fk as confirmed_quotation_room_id,



            qpd.quotation_properties_days_id,

            qpd.quotation_properties_days_day,



            ap.accommodation_date,

            ap.accommodation_day_name,

            ap.guset_count_details_id_fk,

            ap.lead_id_fk,

            ap.day_id_fk,

            ap.stay_destination_id_fk,



            s.state_name,



            qp.quotation_properties_id,

            qp.properties_id_fk,



            p.properties_name,

            p.properties_hotel_logo,



            qpr.quotation_properties_rooms_id,

            qpr.quotation_properties_rooms_id_fk,



            prc.properties_room_category_name,



            qrtd.room_unit_manual_count,

            qrtd.single_occupancy_manual_count,

            qrtd.extra_bed_adult_manual_count,

            qrtd.extra_bed_child_manual_count,

            qrtd.child_sharing_bed_manual_count,

            qrtd.manual_total_rate,



            gcd.adults,

            gcd.children,



            mp.meal_plan_name

        ')

        ->from('quotation_confirmation qc')



        // confirmed day only

        ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')



        // accommodation of that day

        ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')

        ->join('state s', 's.state_id = ap.stay_destination_id_fk', 'left')



        // confirmed property only

        ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')

        ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')



        // confirmed room only

        ->join('quotation_properties_rooms qpr', 'qpr.quotation_properties_rooms_id = qc.properties_room_id_fk', 'inner')

        ->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')



        ->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id', 'left')

        ->join('guset_count_details gcd', 'gcd.guset_count_details_id = ap.guset_count_details_id_fk', 'left')

        ->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')



        ->where('qc.quotation_id_fk', $quotation_id)

        ->where('qc.property_confirmation_status', 1)



        ->where('qpd.quotation_properties_days_status', 1)

        ->where('qp.quotation_properties_status', 1)

        ->where('qpr.quotation_properties_rooms_status', 1)



        ->order_by('ap.accommodation_date', 'ASC')

        ->order_by('qp.quotation_properties_id', 'ASC')

        ->order_by('qpr.quotation_properties_rooms_id', 'ASC')

        ->get()

        ->result_array();



        foreach ($rows as $key => $r) {



        $lead_id = !empty($r['lead_id_fk']) ? (int)$r['lead_id_fk'] : 0;

        $day_id_fk = !empty($r['day_id_fk']) ? (int)$r['day_id_fk'] : 0;

        $stay_destination_id = !empty($r['stay_destination_id_fk']) ? (int)$r['stay_destination_id_fk'] : 0;

        $property_id = !empty($r['properties_id_fk']) ? (int)$r['properties_id_fk'] : 0;

        $room_cat_id = !empty($r['quotation_properties_rooms_id_fk']) ? (int)$r['quotation_properties_rooms_id_fk'] : 0;



        $rows[$key]['applied_plan'] = $this->get_applied_plan_by_context(

            $lead_id,

            $day_id_fk,

            $stay_destination_id,

            $property_id,

            $room_cat_id

        );

    }



        $resRows = $this->db

            ->select('properties_id_fk, confirmation_cnfm_by, confirmation_cnfm_no')

            ->from('property_reservation')

            ->where('quotation_id_fk', $quotation_id)

            ->where('property_reservation_status', 1)

            ->get()->result_array();

        $reservations = array();

        foreach ($resRows as $rv) {

            $reservations[$rv['properties_id_fk']] = $rv;

        }



        return array(

            'main'         => $main,

            'properties'   => $rows,

            'reservations' => $reservations

        );

    }



    public function get_driver_itinerary_preview($quotation_id)

    {

        $main = $this->db

            ->select('

                q.quotation_id,

                q.quotation_number,

                q.quotation_title,

                q.trip_code,

                q.arriving_destination,

                q.departuring_destination,

                l.guest_name,

                l.whats_number,

                l.start_date,

                l.end_date,

                l.duration

            ')

            ->from('quotation q')

            ->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

            ->where('q.quotation_id', (int)$quotation_id)

            ->where('q.quotation_status', 1)

            ->get()

            ->row_array();



        $days = $this->db

            ->select('

                qpd.quotation_properties_days_day,

                qpd.quotation_itinerary_days_id_fk,

                ap.accommodation_date,

                ap.accommodation_day_name,

                s.state_name,

                p.properties_name,

                p.properties_sales_contact_phone_number,

                p.properties_reservation_contact_phone_number,

                p.properties_google_map_location,

                qid.quotation_itineraries_days_description

            ')

            ->from('quotation_confirmation qc')

            ->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')

            ->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')

            ->join('state s', 's.state_id = ap.stay_destination_id_fk', 'left')

            ->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')

            ->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')

            ->join('quotation_itinerary_days qid', 'qid.quotation_itinerary_days_id = qpd.quotation_itinerary_days_id_fk', 'left')

            ->where('qc.quotation_id_fk', (int)$quotation_id)

            ->where('qc.property_confirmation_status', 1)

            ->group_by('qpd.quotation_properties_days_id')

            ->order_by('ap.accommodation_date', 'ASC')

            ->get()

            ->result_array();



        return array(

            'main' => $main,

            'days' => $days

        );

    }



    public function get_tour_voucher_preview($quotation_id)

    {

        $data = $this->get_client_confirmation_preview($quotation_id);



        $resRows = $this->db

            ->select('properties_id_fk, confirmation_cnfm_by, confirmation_cnfm_no, property_reservation_created_by_userid')

            ->from('property_reservation')

            ->where('quotation_id_fk', $quotation_id)

            ->where('property_reservation_status', 1)

            ->get()->result_array();

        $reservations = array();

        $resUserId = null;

        foreach ($resRows as $rv) {

            $reservations[$rv['properties_id_fk']] = $rv;

            if (!$resUserId && !empty($rv['property_reservation_created_by_userid'])) {

                $resUserId = $rv['property_reservation_created_by_userid'];

            }

        }

        $data['reservations'] = $reservations;



        /* Override prepared_by with the user who did the property reservation */

        if ($resUserId) {

            $data['main']['prepared_by_user'] = $this->get_prepared_by_user($resUserId);

        }



        return $data;

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



	public function getQuotationReport($param)

	{

		$staff_id            = isset($param['staff_id'])            ? $param['staff_id']            : '';

		$guest_name          = isset($param['guest_name'])          ? $param['guest_name']          : '';

		$quotation_status    = isset($param['quotation_status'])    ? $param['quotation_status']    : '';

		$start_date          = isset($param['start_date'])          ? $param['start_date']          : '';

		$end_date            = isset($param['end_date'])            ? $param['end_date']            : '';

		$created_start_date  = isset($param['created_start_date'])  ? $param['created_start_date']  : '';

		$created_end_date    = isset($param['created_end_date'])    ? $param['created_end_date']    : '';



		if ($staff_id) {

			$this->db->where('l.staff_id_fk', $staff_id);

		}

		if ($guest_name) {

			$this->db->like('l.guest_name', $guest_name);

		}

		if ($quotation_status) {

			$this->db->where('q.quotation_current_status', $quotation_status);

		}

		if ($start_date) {

			$this->db->where('DATE(l.start_date) >=', $start_date);

		}

		if ($end_date) {

			$this->db->where('DATE(l.start_date) <=', $end_date);

		}

		if ($created_start_date) {

			$this->db->where('DATE(q.quotation_date) >=', $created_start_date);

		}

		if ($created_end_date) {

			$this->db->where('DATE(q.quotation_date) <=', $created_end_date);

		}



		if ($param['length'] == -1) {

			// no limit

		} elseif ($param['start'] != 'false' && $param['length'] != 'false') {

			$this->db->limit($param['length'], $param['start']);

		}



		$this->db->select("q.quotation_id, q.quotation_number, l.leads_id, l.guest_name,

			ud.admin_name as staff_name,

			c.name as destination,

			DATE_FORMAT(q.quotation_date, '%d-%m-%Y') as quotation_date,

			DATE_FORMAT(l.start_date, '%d-%m-%Y') as travel_date,

			DATE_FORMAT(l.end_date, '%d-%m-%Y') as travel_end_date,

			l.duration,

			q.quotation_current_status,

			COALESCE((SELECT SUM(gcd.adults) FROM guset_count_details gcd

				JOIN guset_count gc ON gc.guset_count_id = gcd.guset_count_id_fk

				WHERE gc.guset_count_lead_id_fk = l.leads_id AND gc.guset_count_status = 1

				AND gcd.guset_count_details_status = 1), 0) as total_adults,

			COALESCE((SELECT SUM(gcd.children) FROM guset_count_details gcd

				JOIN guset_count gc ON gc.guset_count_id = gcd.guset_count_id_fk

				WHERE gc.guset_count_lead_id_fk = l.leads_id AND gc.guset_count_status = 1

				AND gcd.guset_count_details_status = 1), 0) as total_children", FALSE);

		$this->db->from('quotation q');

		$this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');

		$this->db->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left');

		$this->db->join('country c', 'c.id = l.country_id_fk', 'left');

		$this->db->where('q.quotation_status', 1);

		$this->db->where('l.leads_status', 1);

		$this->db->order_by('q.quotation_id', 'DESC');



		$query = $this->db->get();

		$data['data']            = $query->result();

		$data['recordsTotal']    = $this->getQuotationReportCount($param);

		$data['recordsFiltered'] = $this->getQuotationReportCount($param);

		return $data;

	}



	public function getQuotationReportCount($param = NULL)

	{

		$staff_id            = isset($param['staff_id'])            ? $param['staff_id']            : '';

		$guest_name          = isset($param['guest_name'])          ? $param['guest_name']          : '';

		$quotation_status    = isset($param['quotation_status'])    ? $param['quotation_status']    : '';

		$start_date          = isset($param['start_date'])          ? $param['start_date']          : '';

		$end_date            = isset($param['end_date'])            ? $param['end_date']            : '';

		$created_start_date  = isset($param['created_start_date'])  ? $param['created_start_date']  : '';

		$created_end_date    = isset($param['created_end_date'])    ? $param['created_end_date']    : '';



		if ($staff_id) {

			$this->db->where('l.staff_id_fk', $staff_id);

		}

		if ($guest_name) {

			$this->db->like('l.guest_name', $guest_name);

		}

		if ($quotation_status) {

			$this->db->where('q.quotation_current_status', $quotation_status);

		}

		if ($start_date) {

			$this->db->where('DATE(l.start_date) >=', $start_date);

		}

		if ($end_date) {

			$this->db->where('DATE(l.start_date) <=', $end_date);

		}

		if ($created_start_date) {

			$this->db->where('DATE(q.quotation_date) >=', $created_start_date);

		}

		if ($created_end_date) {

			$this->db->where('DATE(q.quotation_date) <=', $created_end_date);

		}



		$this->db->select('q.quotation_id', FALSE);

		$this->db->from('quotation q');

		$this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'inner');

		$this->db->join('user_details ud', 'ud.user_id = l.staff_id_fk', 'left');

		$this->db->where('q.quotation_status', 1);

		$this->db->where('l.leads_status', 1);

		$query = $this->db->get();

		return $query->num_rows();

	}



	public function getDriverNotAssignedReport($param)

	{

		$searchValue       = isset($param['searchValue'])       ? $param['searchValue']       : '';

		$quotation_number  = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';

		$trip_code         = isset($param['trip_code_filter'])     ? $param['trip_code_filter']     : '';

		$guest_name        = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';

		$transporter_id_fk = isset($param['transporter_id_fk']) ? $param['transporter_id_fk'] : '';

		$start_date        = isset($param['start_date'])        ? $param['start_date']        : '';

		$end_date          = isset($param['end_date'])          ? $param['end_date']          : '';

		$status_filter     = isset($param['status_filter'])     ? $param['status_filter']     : '';



		$this->db->select('

			qta.id as allocation_id,

			q.quotation_id,

			q.trip_code,

			l.guest_name,

			DATE_FORMAT(l.start_date, "%d-%m-%Y") as travel_date,

			DATE_FORMAT(l.end_date, "%d-%m-%Y") as travel_end_date,

			l.duration,

			qta.transporter_id_fk,

			t.transporter_name,

			qta.driver_name,

			qta.driver_mobile,

			qta.cab_number,

			q.quotation_current_status,

			v.vehicle_name as confirmed_vehicle_name', FALSE);

		$this->db->from('quotation_transport_allocation qta');

		$this->db->join('quotation q', 'q.quotation_id = qta.quotation_id_fk', 'inner');

		$this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'left');

		$this->db->join('transporter t', 't.user_id_fk = qta.transporter_id_fk', 'left');

		$this->db->join('quotation_confirmation qconf', 'qconf.quotation_id_fk = q.quotation_id AND qconf.property_confirmation_status = 1', 'left');

		$this->db->join('quotation_options qo', 'qo.quotation_options_id = qconf.option_id_fk', 'left');

		$this->db->join('vehicle v', 'v.vehicle_id = qo.quotation_options_vehicle_id_fk', 'left');

		$this->db->group_by('qta.id');

		$this->db->where('q.quotation_status', 1);

		if ($status_filter) {

			$this->db->where('q.quotation_current_status', (int)$status_filter);

		} else {

			$this->db->where_in('q.quotation_current_status', array(9, 7, 10));

		}



		if ($transporter_id_fk) {

			$this->db->where('qta.transporter_id_fk', $transporter_id_fk);

		}

		if ($quotation_number) {

			$this->db->like('q.quotation_number', $quotation_number);

		}

		if ($trip_code) {

			$this->db->like('q.trip_code', $trip_code);

		}

		if ($guest_name) {

			$this->db->like('l.guest_name', $guest_name);

		}

		if ($start_date) {

			$this->db->where('l.start_date >=', $start_date);

		}

		if ($end_date) {

			$this->db->where('l.start_date <=', $end_date);

		}

		if ($searchValue) {

			$this->db->group_start();

			$this->db->like('q.quotation_number', $searchValue);

			$this->db->or_like('l.leads_number', $searchValue);

			$this->db->or_like('l.guest_name', $searchValue);

			$this->db->or_like('t.transporter_name', $searchValue);

			$this->db->or_like('qta.driver_name', $searchValue);

			$this->db->or_like('qta.cab_number', $searchValue);

			$this->db->group_end();

		}



		if ($param['length'] == -1) {

			// no limit

		} elseif ($param['start'] != 'false' and $param['length'] != 'false') {

			$this->db->limit($param['length'], $param['start']);

		}



		$this->db->order_by('q.quotation_id', 'DESC');

		$query = $this->db->get();

		$data['data']            = $query->result();

		$data['recordsTotal']    = $this->getDriverNotAssignedReportCount($param);

		$data['recordsFiltered'] = $this->getDriverNotAssignedReportCount($param);

		return $data;

	}



	public function getDriverNotAssignedReportCount($param = NULL)

	{

		$searchValue       = isset($param['searchValue'])       ? $param['searchValue']       : '';

		$quotation_number  = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';

		$trip_code         = isset($param['trip_code_filter'])     ? $param['trip_code_filter']     : '';

		$guest_name        = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';

		$transporter_id_fk = isset($param['transporter_id_fk']) ? $param['transporter_id_fk'] : '';

		$start_date        = isset($param['start_date'])        ? $param['start_date']        : '';

		$end_date          = isset($param['end_date'])          ? $param['end_date']          : '';

		$status_filter     = isset($param['status_filter'])     ? $param['status_filter']     : '';



		$this->db->select('qta.id', FALSE);

		$this->db->from('quotation_transport_allocation qta');

		$this->db->join('quotation q', 'q.quotation_id = qta.quotation_id_fk', 'inner');

		$this->db->join('leads l', 'l.leads_id = q.leads_id_fk', 'left');

		$this->db->join('transporter t', 't.user_id_fk = qta.transporter_id_fk', 'left');

		$this->db->where('q.quotation_status', 1);

		if ($status_filter) {

			$this->db->where('q.quotation_current_status', (int)$status_filter);

		} else {

			$this->db->where_in('q.quotation_current_status', array(9, 7, 10));

		}



		if ($transporter_id_fk) {

			$this->db->where('qta.transporter_id_fk', $transporter_id_fk);

		}

		if ($quotation_number) {

			$this->db->like('q.quotation_number', $quotation_number);

		}

		if ($trip_code) {

			$this->db->like('q.trip_code', $trip_code);

		}

		if ($guest_name) {

			$this->db->like('l.guest_name', $guest_name);

		}

		if ($start_date) {

			$this->db->where('l.start_date >=', $start_date);

		}

		if ($end_date) {

			$this->db->where('l.start_date <=', $end_date);

		}

		if ($searchValue) {

			$this->db->group_start();

			$this->db->like('q.quotation_number', $searchValue);

			$this->db->or_like('l.leads_number', $searchValue);

			$this->db->or_like('l.guest_name', $searchValue);

			$this->db->or_like('t.transporter_name', $searchValue);

			$this->db->or_like('qta.driver_name', $searchValue);

			$this->db->or_like('qta.cab_number', $searchValue);

			$this->db->group_end();

		}



		$query = $this->db->get();

		return $query->num_rows();

	}



	public function updateTransportAllocation($where, $data)

	{

		$this->db->where($where);

		$this->db->update('quotation_transport_allocation', $data);

		return $this->db->affected_rows();

	}



	public function get_transporter_guest_details($quotation_id)

	{

		$quotation_id = (int)$quotation_id;



		$main = $this->db

			->select('

				q.quotation_id,

				q.quotation_number,

				q.quotation_title,

				q.trip_code,

				q.arriving_destination,

				q.departuring_destination,

				l.leads_id,

				l.guest_name,

				l.whats_number,

				l.alternative_number,

				l.start_date,

				l.end_date,

				l.duration

			')

			->from('quotation q')

			->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

			->where('q.quotation_id', $quotation_id)

			->where('q.quotation_status', 1)

			->get()

			->row_array();



		if (!$main) {

			return array('main' => null, 'guest_count' => array(), 'days' => array());

		}



		$lead_id = $main['leads_id'];



		$guest_count = $this->db

			->select('

				gcd.guset_count_details_id,

				gcd.pax_count_plan,

				gcd.adults,

				gcd.children,

				gcd.total_count,

				gcd.guset_count_details_type

			')

			->from('guset_count gc')

			->join('guset_count_details gcd', 'gcd.guset_count_id_fk = gc.guset_count_id', 'left')

			->where('gc.guset_count_lead_id_fk', $lead_id)

			->where('gc.guset_count_status', 1)

			->where('gcd.guset_count_details_status', 1)

			->order_by('gcd.guset_count_details_id', 'ASC')

			->get()

			->result_array();



		// Attach child age break up to each guest count detail

		foreach ($guest_count as &$gc_row) {

			$gc_row['child_ages'] = array();

			if (!empty($gc_row['guset_count_details_id'])) {

				$gc_row['child_ages'] = $this->db

					->select('age, count')

					->from('child_age_break_up')

					->where('guset_count_details_id_fk', $gc_row['guset_count_details_id'])

					->where('child_age_break_up_status', 1)

					->get()

					->result_array();

			}

		}

		unset($gc_row);



		$days = $this->db

			->select('

				qpd.quotation_properties_days_day,

				ap.accommodation_date,

				ap.accommodation_day_name,

				s.state_name,

				p.properties_name,

				p.properties_sales_contact_phone_number,

				p.properties_reservation_contact_phone_number,

				p.properties_google_map_location,

				qid.quotation_itineraries_days_description

			')

			->from('quotation_confirmation qc')

			->join('quotation_properties_days qpd', 'qpd.quotation_properties_days_id = qc.properties_day_id_fk', 'inner')

			->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')

			->join('state s', 's.state_id = ap.stay_destination_id_fk', 'left')

			->join('quotation_properties qp', 'qp.quotation_properties_id = qc.properties_id_fk', 'inner')

			->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')

			->join('quotation_itinerary_days qid', 'qid.quotation_itinerary_days_id = qpd.quotation_itinerary_days_id_fk', 'left')

			->where('qc.quotation_id_fk', $quotation_id)

			->where('qc.property_confirmation_status', 1)

			->group_by('qpd.quotation_properties_days_id')

			->order_by('ap.accommodation_date', 'ASC')

			->get()

			->result_array();



		return array(

			'main'        => $main,

			'guest_count' => $guest_count,

			'days'        => $days

		);

	}



	public function get_payment_report_table($param)

	{

		$quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';

		$guest_name_filter       = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';

		$cust_pay_status_filter  = isset($param['customer_payment_status_filter']) ? $param['customer_payment_status_filter'] : '';

		$cust_approval_filter    = isset($param['customer_approval_filter']) ? $param['customer_approval_filter'] : '';

		$prop_pay_status_filter  = isset($param['property_payment_status_filter']) ? $param['property_payment_status_filter'] : '';

		$travel_date_start       = isset($param['travel_date_start']) ? $param['travel_date_start'] : '';

		$travel_date_end         = isset($param['travel_date_end']) ? $param['travel_date_end'] : '';



		$this->db

			->select('q.quotation_id, q.quotation_number, l.guest_name, l.whats_number, l.start_date, l.end_date, l.duration,

			          (SELECT COUNT(*) FROM receipt_scheduler rs WHERE rs.quotation_id_fk = q.quotation_id AND rs.receipt_scheduler_status = 1) as has_customer_scheduler,

			          (SELECT COUNT(*) FROM property_payment_scheduler pps WHERE pps.quotation_id_fk = q.quotation_id AND pps.property_payment_scheduler_status = 1) as has_property_scheduler,

			          (SELECT GROUP_CONCAT(DISTINCT rsi.payment_status) FROM receipt_scheduler rs2

			           INNER JOIN receipt_scheduler_installments rsi ON rsi.receipt_scheduler_id_fk = rs2.receipt_scheduler_id AND rsi.installment_status = 1

			           WHERE rs2.quotation_id_fk = q.quotation_id AND rs2.receipt_scheduler_status = 1) as customer_payment_statuses,

			          (SELECT COUNT(*) FROM receipt_scheduler_payments rsp

			           INNER JOIN receipt_scheduler_installments rsi2 ON rsi2.installment_id = rsp.installment_id_fk

			           INNER JOIN receipt_scheduler rs3 ON rs3.receipt_scheduler_id = rsi2.receipt_scheduler_id_fk

			           WHERE rs3.quotation_id_fk = q.quotation_id AND rs3.receipt_scheduler_status = 1

			           AND rsp.payment_status = 1 AND (rsp.accountant_approval_status IS NULL OR rsp.accountant_approval_status != "approved")) as customer_approval_pending,

			          (SELECT GROUP_CONCAT(DISTINCT ppsi.payment_status) FROM property_payment_scheduler pps2

			           INNER JOIN property_payment_scheduler_installments ppsi ON ppsi.property_payment_scheduler_id_fk = pps2.property_payment_scheduler_id AND ppsi.installment_status = 1

			           WHERE pps2.quotation_id_fk = q.quotation_id AND pps2.property_payment_scheduler_status = 1) as property_payment_statuses')

			->from('quotation q')

			->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

			->where('q.quotation_status', 1)

			->having('(has_customer_scheduler > 0 OR has_property_scheduler > 0)');



		if ($quotation_number_filter) {

			$this->db->like('q.quotation_number', $quotation_number_filter);

		}

		if ($guest_name_filter) {

			$this->db->like('l.guest_name', $guest_name_filter);

		}

		if ($cust_pay_status_filter) {

			$this->db->having("customer_payment_statuses LIKE '%" . $cust_pay_status_filter . "%'");

		}

		if ($cust_approval_filter === 'pending') {

			$this->db->having('customer_approval_pending > 0');

		} elseif ($cust_approval_filter === 'approved') {

			$this->db->having('customer_approval_pending = 0');

			$this->db->having('has_customer_scheduler > 0');

		}

		if ($prop_pay_status_filter) {

			$this->db->having("property_payment_statuses LIKE '%" . $prop_pay_status_filter . "%'");

		}

		if ($travel_date_start) {

			$this->db->where('l.start_date >=', $travel_date_start);

		}

		if ($travel_date_end) {

			$this->db->where('l.start_date <=', $travel_date_end);

		}



		$this->db->order_by('q.quotation_id', 'DESC');



		if ($param['length'] != -1 && $param['start'] != 'false' && $param['length'] != 'false') {

			$this->db->limit($param['length'], $param['start']);

		}



		$query = $this->db->get();



		$data['data'] = $query->result();

		$data['recordsTotal'] = $this->get_payment_report_total_count($param);

		$data['recordsFiltered'] = $this->get_payment_report_total_count($param);

		return $data;

	}



	public function get_payment_report_total_count($param = NULL)

	{

		$quotation_number_filter = isset($param['quotation_number_filter']) ? $param['quotation_number_filter'] : '';

		$guest_name_filter       = isset($param['guest_name_filter']) ? $param['guest_name_filter'] : '';

		$cust_pay_status_filter  = isset($param['customer_payment_status_filter']) ? $param['customer_payment_status_filter'] : '';

		$cust_approval_filter    = isset($param['customer_approval_filter']) ? $param['customer_approval_filter'] : '';

		$prop_pay_status_filter  = isset($param['property_payment_status_filter']) ? $param['property_payment_status_filter'] : '';

		$travel_date_start       = isset($param['travel_date_start']) ? $param['travel_date_start'] : '';

		$travel_date_end         = isset($param['travel_date_end']) ? $param['travel_date_end'] : '';



		$this->db

			->select('q.quotation_id,

			          (SELECT COUNT(*) FROM receipt_scheduler rs WHERE rs.quotation_id_fk = q.quotation_id AND rs.receipt_scheduler_status = 1) as has_customer_scheduler,

			          (SELECT COUNT(*) FROM property_payment_scheduler pps WHERE pps.quotation_id_fk = q.quotation_id AND pps.property_payment_scheduler_status = 1) as has_property_scheduler,

			          (SELECT GROUP_CONCAT(DISTINCT rsi.payment_status) FROM receipt_scheduler rs2

			           INNER JOIN receipt_scheduler_installments rsi ON rsi.receipt_scheduler_id_fk = rs2.receipt_scheduler_id AND rsi.installment_status = 1

			           WHERE rs2.quotation_id_fk = q.quotation_id AND rs2.receipt_scheduler_status = 1) as customer_payment_statuses,

			          (SELECT COUNT(*) FROM receipt_scheduler_payments rsp

			           INNER JOIN receipt_scheduler_installments rsi2 ON rsi2.installment_id = rsp.installment_id_fk

			           INNER JOIN receipt_scheduler rs3 ON rs3.receipt_scheduler_id = rsi2.receipt_scheduler_id_fk

			           WHERE rs3.quotation_id_fk = q.quotation_id AND rs3.receipt_scheduler_status = 1

			           AND rsp.payment_status = 1 AND (rsp.accountant_approval_status IS NULL OR rsp.accountant_approval_status != "approved")) as customer_approval_pending,

			          (SELECT GROUP_CONCAT(DISTINCT ppsi.payment_status) FROM property_payment_scheduler pps2

			           INNER JOIN property_payment_scheduler_installments ppsi ON ppsi.property_payment_scheduler_id_fk = pps2.property_payment_scheduler_id AND ppsi.installment_status = 1

			           WHERE pps2.quotation_id_fk = q.quotation_id AND pps2.property_payment_scheduler_status = 1) as property_payment_statuses')

			->from('quotation q')

			->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

			->where('q.quotation_status', 1)

			->having('(has_customer_scheduler > 0 OR has_property_scheduler > 0)');



		if ($quotation_number_filter) {

			$this->db->like('q.quotation_number', $quotation_number_filter);

		}

		if ($guest_name_filter) {

			$this->db->like('l.guest_name', $guest_name_filter);

		}

		if ($cust_pay_status_filter) {

			$this->db->having("customer_payment_statuses LIKE '%" . $cust_pay_status_filter . "%'");

		}

		if ($cust_approval_filter === 'pending') {

			$this->db->having('customer_approval_pending > 0');

		} elseif ($cust_approval_filter === 'approved') {

			$this->db->having('customer_approval_pending = 0');

			$this->db->having('has_customer_scheduler > 0');

		}

		if ($prop_pay_status_filter) {

			$this->db->having("property_payment_statuses LIKE '%" . $prop_pay_status_filter . "%'");

		}

		if ($travel_date_start) {

			$this->db->where('l.start_date >=', $travel_date_start);

		}

		if ($travel_date_end) {

			$this->db->where('l.start_date <=', $travel_date_end);

		}



		$subquery = $this->db->get_compiled_select();

		$count_query = $this->db->query("SELECT COUNT(*) as cnt FROM ($subquery) as sub")->row();

		return $count_query ? $count_query->cnt : 0;

	}



	public function get_costing_breakup_data($quotation_id)

	{

		$quotation = $this->db

			->select('q.*, l.guest_name, l.leads_number, l.start_date, l.end_date, l.whats_number, ud.admin_name, qo.quotation_options_title as confirmed_option_title, qo.quotation_options_id as confirmed_option_id')

			->from('quotation q')

			->join('leads l', 'l.leads_id = q.leads_id_fk', 'left')

			->join('user_details ud', 'ud.user_id = q.quotation_created_by_userid', 'left')

			->join('quotation_confirmation qc', 'qc.quotation_id_fk = q.quotation_id AND qc.property_confirmation_status = 1', 'left')

			->join('quotation_options qo', 'qo.quotation_options_id = qc.option_id_fk', 'left')

			->where('q.quotation_id', $quotation_id)

			->where('q.quotation_status', 1)

			->group_by('q.quotation_id')

			->get()

			->row();



		if (!$quotation) {

			return array();

		}



		$options = $this->db

			->select('qo.*, v.vehicle_name, v.vehicle_number_seat')

			->from('quotation_options qo')

			->join('vehicle v', 'v.vehicle_id = qo.quotation_options_vehicle_id_fk', 'left')

			->where('qo.quotation_id_fk', $quotation_id)

			->where('qo.quotation_options_status', 1)

			->order_by('qo.quotation_options_id', 'ASC')

			->get()

			->result();



		foreach ($options as &$option) {



			$option->inclusions = $this->db

				->select('qpi.*, p.properties_name as inc_property_name, pc.property_category_name as inc_category_name')

				->from('quotation_property_inclusions qpi')

				->join('properties p', 'p.properties_id = qpi.inclusion_property_id_fk', 'left')

				->join('property_category pc', 'pc.property_category_id = p.property_category_id_fk', 'left')

				->where('qpi.quotation_id_fk', (int)$quotation_id)

				->where('qpi.quotation_options_id_fk', (int)$option->quotation_options_id)

				->where('qpi.quotation_property_inclusions_status', 1)

				->get()

				->result();

			$option->special_requirements = $this->get_quotation_special_requirements_preview($quotation_id);



			$days = $this->db

				->select('qpd.*, s.state_name, ap.accommodation_date, ap.meal_plan_id_fk,

					gcd.guset_count_details_id, gcd.guset_count_details_type,

					mp.meal_plan_id, mp.meal_plan_name')

				->from('quotation_properties_days qpd')

				->join('state s', 's.state_id = qpd.quotation_properties_days_destination_id_fk', 'left')

				->join('accommodation_plan ap', 'ap.accommodation_plan_id = qpd.accommodation_plan_id_fk', 'left')

				->join('guset_count_details gcd', 'gcd.guset_count_details_id = ap.guset_count_details_id_fk', 'left')

				->join('meal_plan mp', 'mp.meal_plan_id = ap.meal_plan_id_fk', 'left')

				->where('qpd.quotation_id_fk', $quotation_id)

				->where('qpd.quotation_options_id_fk', $option->quotation_options_id)

				->where('qpd.quotation_properties_days_status', 1)

				->order_by('qpd.quotation_properties_days_id', 'ASC')

				->get()

				->result();



			foreach ($days as &$day) {



				$properties = $this->db

					->select('qp.*, p.properties_name, pc.property_category_name')

					->from('quotation_properties qp')

					->join('properties p', 'p.properties_id = qp.properties_id_fk', 'left')

					->join('property_category pc', 'pc.property_category_id = p.property_category_id_fk', 'left')

					->where('qp.quotation_properties_days_id_fk', $day->quotation_properties_days_id)

					->where('qp.quotation_properties_status', 1)

					->order_by('qp.quotation_properties_id', 'ASC')

					->get()

					->result();



				foreach ($properties as &$prop) {



					$rooms = $this->db

						->select('qpr.*, prc.properties_room_category_name,

							qrtd.quotation_room_tariff_details_id,

							qrtd.pax_wise_bed_adult_db_count, qrtd.pax_wise_bed_adult_eb_count, qrtd.pax_wise_bed_adult_sgl_count,

							qrtd.pax_wise_bed_child_db_count, qrtd.pax_wise_bed_child_eb_count, qrtd.pax_wise_bed_child_sb_count,

							qrtd.pax_wise_bed_baby_db_count, qrtd.pax_wise_bed_baby_eb_count, qrtd.pax_wise_bed_baby_sb_count,

							qrtd.room_unit_auto_count, qrtd.room_unit_auto_rate, qrtd.room_unit_auto_total_rate,

							qrtd.room_unit_manual_count, qrtd.room_unit_manual_rate, qrtd.room_unit_manual_total_rate,

							qrtd.extra_bed_adult_auto_count, qrtd.extra_bed_adult_auto_rate, qrtd.extra_bed_adult_auto_total_rate,

							qrtd.extra_bed_adult_manual_count, qrtd.extra_bed_adult_manual_rate, qrtd.extra_bed_adult_manual_total_rate,

							qrtd.extra_bed_child_auto_count, qrtd.extra_bed_child_auto_rate, qrtd.extra_bed_child_auto_total_rate,

							qrtd.extra_bed_child_manual_count, qrtd.extra_bed_child_manual_rate, qrtd.extra_bed_child_manual_total_rate,

							qrtd.child_sharing_bed_auto_count, qrtd.child_sharing_bed_auto_rate, qrtd.child_sharing_bed_auto_total_rate,

							qrtd.child_sharing_bed_manual_count, qrtd.child_sharing_bed_manual_rate, qrtd.child_sharing_bed_manual_total_rate,

							qrtd.single_occupancy_auto_count, qrtd.single_occupancy_auto_rate, qrtd.single_occupancy_auto_total_rate,

							qrtd.single_occupancy_manual_count, qrtd.single_occupancy_manual_rate, qrtd.single_occupancy_manual_total_rate,

							qrtd.supplyment_auto_cost, qrtd.supplyment_auto_total_cost,

							qrtd.supplyment_manual_cost, qrtd.supplyment_manual_total_cost,

							qrtd.auto_total_rate, qrtd.manual_total_rate')

						->from('quotation_properties_rooms qpr')

						->join('properties_room_category prc', 'prc.properties_room_category_id = qpr.quotation_properties_rooms_id_fk', 'left')

						->join('quotation_room_tariff_details qrtd', 'qrtd.quotation_properties_rooms_id_fk = qpr.quotation_properties_rooms_id AND qrtd.quotation_id_fk = ' . (int)$quotation_id . ' AND qrtd.quotation_room_tariff_details_status = 1', 'left')

						->where('qpr.quotation_properties_id_fk', $prop->quotation_properties_id)

						->where('qpr.quotation_properties_rooms_status', 1)

						->order_by('qpr.quotation_properties_rooms_id', 'ASC')

						->get()

						->result();



					$prop->rooms = $rooms;

				}

				unset($prop);



				$day->properties = $properties;

			}

			unset($day);



			$option->days = $days;



			$inclusionTotal = 0;

			foreach ($option->inclusions as $inc) {

				$inclusionTotal += (float)$inc->inclusion_amount;

			}



			$specialTotal = 0;

			foreach ($option->special_requirements as $sr) {

				$specialTotal += (float)$sr->quotation_special_requirements_cost;

			}



			$hotelTotal = 0;

			foreach ($option->days as $day) {

				$dayMax = 0;

				foreach ($day->properties as $prop) {

					foreach ($prop->rooms as $room) {

						$roomCost = (float)$room->total_room_cost;

						if ($roomCost > $dayMax) {

							$dayMax = $roomCost;

						}

					}

				}

				$hotelTotal += $dayMax;

			}



			$option->hotel_total = $hotelTotal;

			$option->inclusion_total = $inclusionTotal;

			$option->special_total = $specialTotal;

			$option->cab_amount = (float)$option->quotation_options_cab_amount;

			$option->total_cost = (float)$option->quotation_options_total_cost;

			$option->margin_value = (float)$option->quotation_options_margin_value;

			$option->quote_rate = (float)$option->quotation_options_total_quote_rate;

			$option->grand_total = $hotelTotal + $option->cab_amount + $option->margin_value + $inclusionTotal + $specialTotal;

		}

		unset($option);



		return array(

			'quotation' => $quotation,

			'options'   => $options,

		);

	}



	public function generate_trip_code()

	{

		$year = date('Y');

		$prefix = 'RIT';



		$row = $this->db

			->select('trip_code')

			->from('quotation')

			->like('trip_code', $prefix . '/' . $year, 'after')

			->order_by('quotation_id', 'DESC')

			->limit(1)

			->get()

			->row();



		$next_seq = 1;

		if ($row && !empty($row->trip_code)) {

			$parts = explode('/', $row->trip_code);

			if (count($parts) >= 2 && is_numeric($parts[1])) {

				$next_seq = (int)$parts[1] + 1;

			}

		}



		return $prefix . '/' . str_pad($next_seq, 3, '0', STR_PAD_LEFT) . '/' . $year;

	}



}

