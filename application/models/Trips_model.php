<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Trips_model extends CI_Model{
	var $table = 'quotation';
    var $table1 = 'quotation_room_tariff_details';
    var $table3 = 'trips';

	public function __construct()
    {
        parent::__construct();
    }

    public function getTripsTable($param){
		$arOrder = array('','roles_name');
        $quotation_number_filter =(isset($param['quotation_number_filter']))?$param['quotation_number_filter']:'';
		$leads_id_filter =(isset($param['leads_id_filter']))?$param['leads_id_filter']:'';
        $package_id_filter =(isset($param['package_id_filter']))?$param['package_id_filter']:'';
		$arriving_destination_filter =(isset($param['arriving_destination_filter']))?$param['arriving_destination_filter']:'';
		$departuring_destination_filter =(isset($param['departuring_destination_filter']))?$param['departuring_destination_filter']:'';
        $trips_current_status_filter =(isset($param['trips_current_status_filter']))?$param['trips_current_status_filter']:'';
		$trips_created_by_userid =(isset($param['trips_created_by_userid']))?$param['trips_created_by_userid']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';

        if($quotation_number_filter){
            $this->db->where('quotation_number', $quotation_number_filter); 
        }
		if($leads_id_filter){
            $this->db->where('leads_id_fk', $leads_id_filter); 
        }
        if($package_id_filter){
            $this->db->where('package_id_fk', $package_id_filter); 
        }
        if($trips_current_status_filter){
            $this->db->where('trips_current_status', $trips_current_status_filter); 
        }
        if($arriving_destination_filter){
            $this->db->like('arriving_destination', $arriving_destination_filter); 
        }
        if($departuring_destination_filter){
            $this->db->where('departuring_destination', $departuring_destination_filter); 
        }
        if($start_date){
            $this->db->where('trips_travel_start_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('trips_travel_end_date<=', $end_date); 
        }
        if($trips_created_by_userid){
            $this->db->where('trips_created_by_userid', $trips_created_by_userid); 
        }
        $this->db->where("trips_status",1);

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("trips_created_by_userid",$currentuserid);
			}
		$this->db->select('*,DATE_FORMAT(trips_travel_start_date,\'%d-%m-%Y\') as trips_travel_start_date,DATE_FORMAT(trips_travel_end_date,\'%d-%m-%Y\') as trips_travel_end_date');
		$this->db->from('trips');
        $this->db->join('quotation', 'quotation.quotation_id = trips.quotation_id_fk','left');
		$this->db->join('leads', 'leads.leads_id = quotation.leads_id_fk','left');
		$this->db->join('packages', 'packages.packages_id = quotation.package_id_fk','left');
		$this->db->order_by('trips_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getTripsTotalCount($param);
        $data['recordsFiltered'] = $this->getTripsTotalCount($param);
        return $data;

	}

	public function getTripsTotalCount($param = NULL){

		$quotation_number_filter =(isset($param['quotation_number_filter']))?$param['quotation_number_filter']:'';
		$leads_id_filter =(isset($param['leads_id_filter']))?$param['leads_id_filter']:'';
        $package_id_filter =(isset($param['package_id_filter']))?$param['package_id_filter']:'';
		$arriving_destination_filter =(isset($param['arriving_destination_filter']))?$param['arriving_destination_filter']:'';
		$departuring_destination_filter =(isset($param['departuring_destination_filter']))?$param['departuring_destination_filter']:'';
        $trips_current_status_filter =(isset($param['trips_current_status_filter']))?$param['trips_current_status_filter']:'';
		$trips_created_by_userid =(isset($param['trips_created_by_userid']))?$param['trips_created_by_userid']:'';
		$start_date =(isset($param['start_date']))?$param['start_date']:'';
        $end_date =(isset($param['end_date']))?$param['end_date']:'';

        if($quotation_number_filter){
            $this->db->where('quotation_number', $quotation_number_filter); 
        }
		if($leads_id_filter){
            $this->db->where('leads_id_fk', $leads_id_filter); 
        }
        if($package_id_filter){
            $this->db->where('package_id_fk', $package_id_filter); 
        }
        if($trips_current_status_filter){
            $this->db->where('trips_current_status', $trips_current_status_filter); 
        }
        if($arriving_destination_filter){
            $this->db->like('arriving_destination', $arriving_destination_filter); 
        }
        if($departuring_destination_filter){
            $this->db->where('departuring_destination', $departuring_destination_filter); 
        }
        if($start_date){
            $this->db->where('trips_travel_start_date>=', $start_date);
        }
        if($end_date){
            $this->db->where('trips_travel_end_date<=', $end_date); 
        }
        if($trips_created_by_userid){
            $this->db->where('trips_created_by_userid', $trips_created_by_userid); 
        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("trips_created_by_userid",$currentuserid);
			}

        $this->db->select('*,DATE_FORMAT(trips_travel_start_date,\'%d-%m-%Y\') as trips_travel_start_date,DATE_FORMAT(trips_travel_end_date,\'%d-%m-%Y\') as trips_travel_end_date');
		$this->db->from('trips');
        $this->db->join('quotation', 'quotation.quotation_id = trips.quotation_id_fk','left');
		$this->db->join('leads', 'leads.leads_id = quotation.leads_id_fk','left');
		$this->db->join('packages', 'packages.packages_id = quotation.package_id_fk','left');
        $this->db->where("trips_status",1);
		$this->db->order_by('trips_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
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
		$this->db->where("lead_type",'B2C');
		$query = $this->db->get("leads");
		return $query->result();
	}

}
?>