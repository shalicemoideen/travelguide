<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Leads_model extends CI_Model{
	var $table = 'leads';
	var $table1 = 'guset_count';
	var $table2 = 'source';

	public function __construct()
    {
        parent::__construct();
    }

    public function getManualB2CLeadsTable($param){
		$arOrder = array('','roles_name');
		$staff_id1 =(isset($param['staff_id1']))?$param['staff_id1']:'';
		$source_id1 =(isset($param['source_id1']))?$param['source_id1']:'';
		$packages_id1 =(isset($param['packages_id1']))?$param['packages_id1']:'';
		$country_id1 =(isset($param['country_id1']))?$param['country_id1']:'';
		$priority_status_id1 =(isset($param['priority_status_id1']))?$param['priority_status_id1']:'';
		$stages_id1 =(isset($param['stages_id1']))?$param['stages_id1']:'';
		$lead_type1 =(isset($param['lead_type1']))?$param['lead_type1']:'';
		$lead_current_status1 =(isset($param['lead_current_status1']))?$param['lead_current_status1']:'';
		$guest_name_filter1 =(isset($param['guest_name_filter1']))?$param['guest_name_filter1']:'';
		$whats_number_filter1 =(isset($param['whats_number_filter1']))?$param['whats_number_filter1']:'';
		$leads_createdby_userid1 =(isset($param['leads_createdby_userid1']))?$param['leads_createdby_userid1']:'';
		$leads_start_date1 =(isset($param['leads_start_date1']))?$param['leads_start_date1']:'';
        $leads_end_date1 =(isset($param['leads_end_date1']))?$param['leads_end_date1']:'';
		$travels_start_date1 =(isset($param['travels_start_date1']))?$param['travels_start_date1']:'';
        $travels_end_date1 =(isset($param['travels_end_date1']))?$param['travels_end_date1']:'';

		if($staff_id1){
            $this->db->where('staff_id_fk', $staff_id1); 
        }
        if($source_id1){
            $this->db->where('source_id', $source_id1); 
        }
        if($packages_id1){
            $this->db->where('packages_id', $packages_id1); 
        }
        if($country_id1){
            $this->db->where('id', $country_id1); 
        }
        if($priority_status_id1){
            $this->db->where('priority_status_id', $priority_status_id1); 
        }
        if($lead_type1){
            $this->db->where('lead_type', $lead_type1); 
        }
		if($lead_current_status1){
            $this->db->where('lead_current_status', $lead_current_status1); 
        }
        if($guest_name_filter1){
            $this->db->like('guest_name', $guest_name_filter1); 
        }
        if($whats_number_filter1){
            $this->db->like('whats_number', $whats_number_filter1); 
        }
        if($stages_id1){
            $this->db->where('stages_id', $stages_id1); 
        }
        if($leads_start_date1){
            $this->db->where('lead_register_date>=', $leads_start_date1);
        }
        if($leads_end_date1){
            $this->db->where('lead_register_date<=', $leads_end_date1); 
        }
		if($travels_start_date1){
            $this->db->where('start_date>=', $travels_start_date1);
        }
        if($travels_end_date1){
            $this->db->where('end_date<=', $travels_end_date1); 
        }
        if($leads_createdby_userid1){
            $this->db->where('leads_createdby_userid', $leads_createdby_userid1); 
        }

        $this->db->where("lead_type",'B2C');
		$this->db->where("leads_status",1);
		

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
		$this->db->select('*,DATE_FORMAT(lead_register_date,\'%d-%m-%Y\') as lead_register_date,DATE_FORMAT(start_date,\'%d-%m-%Y\') as start_date,DATE_FORMAT(end_date,\'%d-%m-%Y\') as end_date');
		$this->db->from('leads');
		$this->db->join('user_details', 'user_details.user_id = leads.staff_id_fk','left');
		$this->db->join('source', 'source.source_id = leads.source_id_fk','left');
		$this->db->join('packages', 'packages.packages_id = leads.package_id_fk','left');
		$this->db->join('country', 'country.id = leads.country_id_fk','left');
		$this->db->join('priority_status', 'priority_status.priority_status_id = leads.priority_status_id_fk','left');
		$this->db->join('stages', 'stages.stages_id = leads.stage_id_fk','left');
		$this->db->order_by('leads_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getManualB2CLeadsTotalCount($param);
        $data['recordsFiltered'] = $this->getManualB2CLeadsTotalCount($param);
        return $data;

	}

	public function getManualB2CLeadsTotalCount($param = NULL){

		$staff_id1 =(isset($param['staff_id1']))?$param['staff_id1']:'';
		$source_id1 =(isset($param['source_id1']))?$param['source_id1']:'';
		$packages_id1 =(isset($param['packages_id1']))?$param['packages_id1']:'';
		$country_id1 =(isset($param['country_id1']))?$param['country_id1']:'';
		$priority_status_id1 =(isset($param['priority_status_id1']))?$param['priority_status_id1']:'';
		$stages_id1 =(isset($param['stages_id1']))?$param['stages_id1']:'';
		$lead_type1 =(isset($param['lead_type1']))?$param['lead_type1']:'';
		$lead_current_status1 =(isset($param['lead_current_status1']))?$param['lead_current_status1']:'';
		$guest_name_filter1 =(isset($param['guest_name_filter1']))?$param['guest_name_filter1']:'';
		$whats_number_filter1 =(isset($param['whats_number_filter1']))?$param['whats_number_filter1']:'';
		$leads_createdby_userid1 =(isset($param['leads_createdby_userid1']))?$param['leads_createdby_userid1']:'';
		$leads_start_date1 =(isset($param['leads_start_date1']))?$param['leads_start_date1']:'';
        $leads_end_date1 =(isset($param['leads_end_date1']))?$param['leads_end_date1']:'';
		$travels_start_date1 =(isset($param['travels_start_date1']))?$param['travels_start_date1']:'';
        $travels_end_date1 =(isset($param['travels_end_date1']))?$param['travels_end_date1']:'';

		if($staff_id1){
            $this->db->where('staff_id_fk', $staff_id1); 
        }
        if($source_id1){
            $this->db->where('source_id', $source_id1); 
        }
        if($packages_id1){
            $this->db->where('packages_id', $packages_id1); 
        }
        if($country_id1){
            $this->db->where('id', $country_id1); 
        }
        if($priority_status_id1){
            $this->db->where('priority_status_id', $priority_status_id1); 
        }
        if($lead_type1){
            $this->db->where('lead_type', $lead_type1); 
        }
		if($lead_current_status1){
            $this->db->where('lead_current_status', $lead_current_status1); 
        }
        if($guest_name_filter1){
            $this->db->like('guest_name', $guest_name_filter1); 
        }
        if($whats_number_filter1){
            $this->db->like('whats_number', $whats_number_filter1); 
        }
        if($stages_id1){
            $this->db->where('stages_id', $stages_id1); 
        }
        if($leads_start_date1){
            $this->db->where('lead_register_date>=', $leads_start_date1);
        }
        if($leads_end_date1){
            $this->db->where('lead_register_date<=', $leads_end_date1); 
        }
		if($travels_start_date1){
            $this->db->where('start_date>=', $travels_start_date1);
        }
        if($travels_end_date1){
            $this->db->where('end_date<=', $travels_end_date1); 
        }
        if($leads_createdby_userid1){
            $this->db->where('leads_createdby_userid', $leads_createdby_userid1); 
        }

		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
		$this->db->select('*,DATE_FORMAT(lead_register_date,\'%d-%m-%Y\') as lead_register_date,DATE_FORMAT(start_date,\'%d-%m-%Y\') as start_date,DATE_FORMAT(end_date,\'%d-%m-%Y\') as end_date');
		$this->db->from('leads');
		$this->db->join('user_details', 'user_details.user_id = leads.staff_id_fk','left');
		$this->db->join('source', 'source.source_id = leads.source_id_fk','left');
		$this->db->join('packages', 'packages.packages_id = leads.package_id_fk','left');
		$this->db->join('country', 'country.id = leads.country_id_fk','left');
		$this->db->join('priority_status', 'priority_status.priority_status_id = leads.priority_status_id_fk','left');
		$this->db->join('stages', 'stages.stages_id = leads.stage_id_fk','left');
		$this->db->where("lead_type",'B2C');
		$this->db->where("leads_status",1);
		$this->db->order_by('leads_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }


	public function getMetaLeadsTable($param){
		$arOrder = array('','roles_name');
		$staff_id2 =(isset($param['staff_id2']))?$param['staff_id2']:'';
		$source_id2 =(isset($param['source_id2']))?$param['source_id2']:'';
		$packages_id2 =(isset($param['packages_id2']))?$param['packages_id2']:'';
		$country_id2 =(isset($param['country_id2']))?$param['country_id2']:'';
		$priority_status_id2 =(isset($param['priority_status_id2']))?$param['priority_status_id2']:'';
		$stages_id2 =(isset($param['stages_id2']))?$param['stages_id2']:'';
		$lead_type2 =(isset($param['lead_type2']))?$param['lead_type2']:'';
		$lead_current_status2 =(isset($param['lead_current_status2']))?$param['lead_current_status2']:'';
		$guest_name_filter2 =(isset($param['guest_name_filter2']))?$param['guest_name_filter2']:'';
		$whats_number_filter2 =(isset($param['whats_number_filter2']))?$param['whats_number_filter2']:'';
		$leads_createdby_userid2 =(isset($param['leads_createdby_userid2']))?$param['leads_createdby_userid2']:'';
		$leads_start_date2 =(isset($param['leads_start_date2']))?$param['leads_start_date2']:'';
        $leads_end_date2 =(isset($param['leads_end_date2']))?$param['leads_end_date2']:'';
		$travels_start_date2 =(isset($param['travels_start_date2']))?$param['travels_start_date2']:'';
        $travels_end_date2 =(isset($param['travels_end_date2']))?$param['travels_end_date2']:'';

		if($staff_id2){
            $this->db->where('staff_id_fk', $staff_id2); 
        }
        if($source_id2){
            $this->db->where('source_id', $source_id2); 
        }
        if($packages_id2){
            $this->db->where('packages_id', $packages_id2); 
        }
        if($country_id2){
            $this->db->where('id', $country_id2); 
        }
        if($priority_status_id2){
            $this->db->where('priority_status_id', $priority_status_id2); 
        }
        if($lead_type2){
            $this->db->where('lead_type', $lead_type2); 
        }
		if($lead_current_status2){
            $this->db->where('lead_current_status', $lead_current_status2); 
        }
        if($guest_name_filter2){
            $this->db->like('guest_name', $guest_name_filter2); 
        }
        if($whats_number_filter2){
            $this->db->like('whats_number', $whats_number_filter2); 
        }
        if($stages_id2){
            $this->db->where('stages_id', $stages_id2); 
        }
        if($leads_start_date2){
            $this->db->where('lead_register_date>=', $leads_start_date2);
        }
        if($leads_end_date2){
            $this->db->where('lead_register_date<=', $leads_end_date2); 
        }
		if($travels_start_date2){
            $this->db->where('start_date>=', $travels_start_date2);
        }
        if($travels_end_date2){
            $this->db->where('end_date<=', $travels_end_date2); 
        }
        if($leads_createdby_userid2){
            $this->db->where('leads_createdby_userid', $leads_createdby_userid2); 
        }
        
        $this->db->where("lead_type",'Meta Lead');
		$this->db->where("leads_status",1);
		

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
		$this->db->select('*,DATE_FORMAT(lead_register_date,\'%d-%m-%Y\') as lead_register_date,DATE_FORMAT(start_date,\'%d-%m-%Y\') as start_date,DATE_FORMAT(end_date,\'%d-%m-%Y\') as end_date');
		$this->db->from('leads');
		$this->db->join('user_details', 'user_details.user_id = leads.staff_id_fk','left');
		$this->db->join('source', 'source.source_id = leads.source_id_fk','left');
		$this->db->join('packages', 'packages.packages_id = leads.package_id_fk','left');
		$this->db->join('country', 'country.id = leads.country_id_fk','left');
		$this->db->join('priority_status', 'priority_status.priority_status_id = leads.priority_status_id_fk','left');
		$this->db->join('stages', 'stages.stages_id = leads.stage_id_fk','left');
		$this->db->order_by('leads_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getMetaLeadsTotalCount($param);
        $data['recordsFiltered'] = $this->getMetaLeadsTotalCount($param);
        return $data;

	}

	public function getMetaLeadsTotalCount($param = NULL){

		$staff_id2 =(isset($param['staff_id2']))?$param['staff_id2']:'';
		$source_id2 =(isset($param['source_id2']))?$param['source_id2']:'';
		$packages_id2 =(isset($param['packages_id2']))?$param['packages_id2']:'';
		$country_id2 =(isset($param['country_id2']))?$param['country_id2']:'';
		$priority_status_id2 =(isset($param['priority_status_id2']))?$param['priority_status_id2']:'';
		$stages_id2 =(isset($param['stages_id2']))?$param['stages_id2']:'';
		$lead_type2 =(isset($param['lead_type2']))?$param['lead_type2']:'';
		$lead_current_status2 =(isset($param['lead_current_status2']))?$param['lead_current_status2']:'';
		$guest_name_filter2 =(isset($param['guest_name_filter2']))?$param['guest_name_filter2']:'';
		$whats_number_filter2 =(isset($param['whats_number_filter2']))?$param['whats_number_filter2']:'';
		$leads_createdby_userid2 =(isset($param['leads_createdby_userid2']))?$param['leads_createdby_userid2']:'';
		$leads_start_date2 =(isset($param['leads_start_date2']))?$param['leads_start_date2']:'';
        $leads_end_date2 =(isset($param['leads_end_date2']))?$param['leads_end_date2']:'';
		$travels_start_date2 =(isset($param['travels_start_date2']))?$param['travels_start_date2']:'';
        $travels_end_date2 =(isset($param['travels_end_date2']))?$param['travels_end_date2']:'';

		if($staff_id2){
            $this->db->where('staff_id_fk', $staff_id2); 
        }
        if($source_id2){
            $this->db->where('source_id', $source_id2); 
        }
        if($packages_id2){
            $this->db->where('packages_id', $packages_id2); 
        }
        if($country_id2){
            $this->db->where('id', $country_id2); 
        }
        if($priority_status_id2){
            $this->db->where('priority_status_id', $priority_status_id2); 
        }
        if($lead_type2){
            $this->db->where('lead_type', $lead_type2); 
        }
		if($lead_current_status2){
            $this->db->where('lead_current_status', $lead_current_status2); 
        }
        if($guest_name_filter2){
            $this->db->like('guest_name', $guest_name_filter2); 
        }
        if($whats_number_filter2){
            $this->db->like('whats_number', $whats_number_filter2); 
        }
        if($stages_id2){
            $this->db->where('stages_id', $stages_id2); 
        }
        if($leads_start_date2){
            $this->db->where('lead_register_date>=', $leads_start_date2);
        }
        if($leads_end_date2){
            $this->db->where('lead_register_date<=', $leads_end_date2); 
        }
		if($travels_start_date2){
            $this->db->where('start_date>=', $travels_start_date2);
        }
        if($travels_end_date2){
            $this->db->where('end_date<=', $travels_end_date2); 
        }
        if($leads_createdby_userid2){
            $this->db->where('leads_createdby_userid', $leads_createdby_userid2); 
        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
		$this->db->select('*,DATE_FORMAT(lead_register_date,\'%d-%m-%Y\') as lead_register_date,DATE_FORMAT(start_date,\'%d-%m-%Y\') as start_date,DATE_FORMAT(end_date,\'%d-%m-%Y\') as end_date');
		$this->db->from('leads');
		$this->db->join('user_details', 'user_details.user_id = leads.staff_id_fk','left');
		$this->db->join('source', 'source.source_id = leads.source_id_fk','left');
		$this->db->join('packages', 'packages.packages_id = leads.package_id_fk','left');
		$this->db->join('country', 'country.id = leads.country_id_fk','left');
		$this->db->join('priority_status', 'priority_status.priority_status_id = leads.priority_status_id_fk','left');
		$this->db->join('stages', 'stages.stages_id = leads.stage_id_fk','left');
		$this->db->where("lead_type",'Meta Lead');
		$this->db->where("leads_status",1);
		$this->db->order_by('leads_id', 'DESC');
        $query = $this->db->get();
    	return $query->num_rows();
    }

	public function getB2BLeadsTable($param){
		$arOrder = array('','roles_name');
		$agent_id_filter =(isset($param['agent_id_filter']))?$param['agent_id_filter']:'';
		$leads_createdby_userid3 =(isset($param['leads_createdby_userid3']))?$param['leads_createdby_userid3']:'';
		$leads_start_date3 =(isset($param['leads_start_date3']))?$param['leads_start_date3']:'';
        $leads_end_date3 =(isset($param['leads_end_date3']))?$param['leads_end_date3']:'';
		
		if($agent_id_filter){
            $this->db->where('agent_id_fk', $agent_id_filter); 
		}
        if($leads_start_date3){
            $this->db->where('lead_register_date>=', $leads_start_date3);
        }
        if($leads_end_date3){
            $this->db->where('lead_register_date<=', $leads_end_date3); 
        }
        if($leads_createdby_userid3){
            $this->db->where('leads_createdby_userid', $leads_createdby_userid3); 
        }
        
        $this->db->where("lead_type",'B2B');
		$this->db->where("leads_status",1);
		

        if($param['length']== -1) {

            //$this->db->limit($param['length'],$param['start']);

        } elseif ($param['start'] != 'false' and $param['length'] != 'false') {

        	$this->db->limit($param['length'],$param['start']);

        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
		$this->db->select('*,DATE_FORMAT(lead_register_date,\'%d-%m-%Y\') as lead_register_date');
		$this->db->from('leads');
		$this->db->join('b2b_partner', 'b2b_partner.b2b_partner_id = leads.agent_id_fk','left');
		$this->db->order_by('leads_id', 'DESC');

        $query = $this->db->get();
        // echo $this->db->last_query();exit();

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getB2BleadsTotalCount($param);
        $data['recordsFiltered'] = $this->getB2BleadsTotalCount($param);
        return $data;

	}

	public function getB2BleadsTotalCount($param = NULL){

		$agent_id_filter =(isset($param['agent_id_filter']))?$param['agent_id_filter']:'';
		$leads_createdby_userid3 =(isset($param['leads_createdby_userid3']))?$param['leads_createdby_userid3']:'';
		$leads_start_date3 =(isset($param['leads_start_date3']))?$param['leads_start_date3']:'';
        $leads_end_date3 =(isset($param['leads_end_date3']))?$param['leads_end_date3']:'';
		
		if($agent_id_filter){
            $this->db->where('agent_id_fk', $agent_id_filter); 
		}
        if($leads_start_date3){
            $this->db->where('lead_register_date>=', $leads_start_date3);
        }
        if($leads_end_date3){
            $this->db->where('lead_register_date<=', $leads_end_date3); 
        }
        if($leads_createdby_userid3){
            $this->db->where('leads_createdby_userid', $leads_createdby_userid3); 
        }
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
			
		if($currentusertype == 'S'){
			 $this->db->where("leads_createdby_userid",$currentuserid);
			}
		$this->db->select('*,DATE_FORMAT(lead_register_date,\'%d-%m-%Y\') as lead_register_date');
		$this->db->from('leads');
		$this->db->join('b2b_partner', 'b2b_partner.b2b_partner_id = leads.agent_id_fk','left');
		$this->db->where("lead_type",'Meta Lead');
		$this->db->where("leads_status",1);
		$this->db->order_by('leads_id', 'DESC');
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

	public function last_id_leads()
	{
		$this->db->select('leads_id');
		$this->db->from('leads');
		$this->db->where("leads_status",1);
		$this->db->order_by('leads_id','DESC');
		$this->db->limit('1');
		$query = $this->db->get();
		return $query->row();
	}

	function fetch_source()
	{
		$this->db->order_by("source_id", "ASC");
		$query = $this->db->get("source");
		// $this->db->where("source_status",1);
		return $query->result();
	}

	function fetch_b2b_partner()
	{
		$this->db->order_by("b2b_partner_id", "ASC");
		$query = $this->db->get("b2b_partner");
		// $this->db->where("b2b_partner_status",1);
		// echo $this->db->last_query();exit();
		return $query->result();
	}

	function fetch_priority_status()
	{
		$this->db->order_by("priority_status_id", "ASC");
		$query = $this->db->get("priority_status");
		// $this->db->where("priority_status_created_status",1);
		return $query->result();
	}

	function fetch_stages()
	{
		$this->db->order_by("stages_id", "ASC");
		$query = $this->db->get("stages");
		// $this->db->where("stages_status",1);
		return $query->result();
	}

	public function fetch_packages($duration)
	{
		$this->db->order_by('packages_id', 'ASC');
		$this->db->where('packages_status', 1);
		$this->db->where('packages_duration_in_nights', $duration);
		$query = $this->db->get('packages');
// echo $this->db->last_query();exit();
		return $query->result();
	}


	function fetch_country()
	{
		$this->db->order_by("id", "ASC");
		$query = $this->db->get("country");
		return $query->result();
	}

	function fetch_state()
	{
		$this->db->order_by("state_id", "ASC");
		 $this->db->where("state_status",1);
		$query = $this->db->get("state");
		return $query->result();
	}

	// function fetch_package_itineray($packages_itinerary_id)
	// {
	// 	$this->db->select('packages_itinerary_days_id,packages_itineraries_days_day,packages_itineraries_days_destination_id_fk,packages_itineraries_days_travel_back,packages_itineraries_days_required_status');
	// 	$this->db->from('packages_itinerary_days');
	// 	$this->db->where("packages_itinerary_days_status",1);
	// 	$this->db->where("packages_itinerary_id_fk", $packages_itinerary_id);
	// 	$query = $this->db->get();
	// 	return $query->result();
	// }

	public function fetch_package_itineray($package_id)
{
    return $this->db
        ->select('pid.*')
        ->from('packages_itinerary pi')
        ->join('packages_itinerary_days pid', 'pid.packages_itinerary_id_fk = pi.packages_itinerary_id', 'inner')
        ->where('pi.packages_id_fk', (int)$package_id)
        ->order_by('pid.packages_itineraries_days_day', 'ASC')
        ->get()
        ->result_array();
}
	public function get_property_days_map_by_package($package_id)
{
    $rows = $this->db
        ->select("ppd.packages_properties_days_id AS property_day_id, ppd.packages_properties_days_day AS day_no")
        ->from('packages_properties_common ppc')
        ->join('packages_properties_days ppd', 'ppd.packages_properties_common_id_fk = ppc.packages_properties_common_id', 'inner')
        ->where('ppc.packages_properties_common_packages_id_fk', (int)$package_id)
        ->order_by('ppd.packages_properties_days_day', 'ASC')
        ->get()
        ->result_array();
// echo $this->db->last_query();exit();
    $map = array(); // day_no => property_day_id
    foreach ($rows as $r) {
        $map[(int)$r['day_no']] = (int)$r['property_day_id'];
    }
    return $map;
}


	function fetch_stay_destination(){

		$this->db->select('state_id,state_name');
		$this->db->from('state');
		$this->db->order_by("state_id", "ASC");
		$this->db->where("state_status",1);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_meal_plan(){

		$this->db->select('meal_plan_id,meal_plan_name');
		$this->db->from('meal_plan');
		$this->db->order_by("meal_plan_id", "ASC");
		$this->db->where("meal_plan_status",1);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_guset_count_details($lead_id)
	{
		$this->db->select('
			guset_count_details.guset_count_details_id,
			guset_count_details.pax_count_plan,
			guset_count_details.adults,
			guset_count_details.children,
			guset_count_details.guset_count_details_type,
			guset_count.guset_count_id AS guset_count_id
		');
		$this->db->from('guset_count');
		$this->db->join(
			'guset_count_details',
			'guset_count_details.guset_count_id_fk = guset_count.guset_count_id',
			'left'
		);
		$this->db->where('guset_count.guset_count_lead_id_fk', $lead_id);
		$this->db->where('guset_count.guset_count_status', 1);
		$this->db->order_by('guset_count_details.guset_count_details_id', 'ASC');
// echo $this->db->last_query();exit();
		return $this->db->get()->result();
	}

	public function add_source($data) {
        $this->db->insert($this->table2, $data);
        return $this->db->insert_id();
    }

	public function add_priority_status($data) {
		$this->db->insert('priority_status', $data);
		return $this->db->insert_id();
	}

	public function add_stage($data) {
		$this->db->insert('stages', $data);
		return $this->db->insert_id();
	}

	public function getLeadStage($lead_id)
	{
		return $this->db
			->select('stage_id_fk, lead_type')
			->where('leads_id', $lead_id)
			->get('leads')
			->row_array(); // return as array
	}

    public function getActiveStages()
    {
        return $this->db
            ->where('stages_status', 1)
            ->get('stages')
            ->result();
    }

    public function insertStageFlow($lead_id,$cur_stage,$prev_stage,$desc)
    {
        $data = [
            'stage_flow_lead_id_fk'        => $lead_id,
            'stage_flow_cur_stage_id_fk'   => $cur_stage,
            'stage_flow_prev_stage_id_fk'  => $prev_stage,
            'stage_flow_description'       => $desc,
            'stage_flow_created_user_id'   => $this->session->userdata('user_id'),
            'stage_flow_created_username' => $this->session->userdata('admin_name'),
            'stage_flow_created_date'      => date('Y-m-d'),
            'stage_flow_created_time'      => date('H:i:s'),
            'stage_flow_status'            => 1
        ];

        $this->db->insert('stage_flow', $data);
    }

	 public function get_stage_history($lead_id) {
        $this->db->select('sf.*, cs.stages_button as current_stage_name, ps.stages_button as prev_stage_name');
        $this->db->from('stage_flow sf');
        $this->db->join('stages cs', 'cs.stages_id = sf.stage_flow_cur_stage_id_fk', 'left');
        $this->db->join('stages ps', 'ps.stages_id = sf.stage_flow_prev_stage_id_fk', 'left');
        $this->db->where('sf.stage_flow_lead_id_fk', $lead_id);
        // $this->db->order_by('sf.stage_flow_id', 'ASC');
		$this->db->order_by('sf.stage_flow_id', 'DESC');
        $query = $this->db->get();

        return $query->result_array();
    }

    public function updateLeadStage($lead_id,$stage_id)
    {
        $this->db
            ->where('leads_id',$lead_id)
            ->update('leads',['stage_id_fk'=>$stage_id]);
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

	public function insert_accommodation_plan_batch($data)
	{
		return $this->db->insert_batch('accommodation_plan', $data);
	}

	public function delete_accommodation_plan_by_lead($lead_id)
{
    return $this->db
        ->where('lead_id_fk', (int)$lead_id)
        ->delete('accommodation_plan'); // <-- your table name
}

	public function get_package_property_categories($package_id)
	{
		return $this->db
			->select('packages_properties_common_id, packages_properties_common_category_name')
			->from('packages_properties_common')
			->where('packages_properties_common_packages_id_fk', (int)$package_id)
			->where('packages_properties_common_status', 1)
			->order_by('packages_properties_common_id', 'ASC')
			->get()->result_array();
	}


	public function get_by_id($id)
	{
		// $this->db->from($this->table);
		$this->db->select('*,DATE_FORMAT(start_date,\'%d-%m-%Y\') as start_date');
		$this->db->from('leads');
		$this->db->where("leads_status",1);
		$this->db->where('leads_id',$id);
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
		$this->db->where('leads_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}

?>