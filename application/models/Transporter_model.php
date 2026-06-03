<?php
if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Transporter_model extends CI_Model{
	var $table = 'transporter';
	
	public function __construct()
    {
        parent::__construct();
    }
	
	public function getTransporterTable($param){
		$arOrder = array('','roles_name');
		$transporter_id =(isset($param['transporter_id']))?$param['transporter_id']:'';
		$transporter_base_station_id_fk =(isset($param['transporter_base_station_id_fk']))?$param['transporter_base_station_id_fk']:'';
		$vehicle_id_fk =(isset($param['vehicle_id_fk']))?$param['vehicle_id_fk']:'';
		$transporter_createdby_user_id =(isset($param['transporter_createdby_user_id']))?$param['transporter_createdby_user_id']:'';
		
		
		if($transporter_id){
            $this->db->where('transporter_id', $transporter_id); 
        }
		if($transporter_base_station_id_fk){
            $this->db->where('transporter_base_station_id_fk', $transporter_base_station_id_fk); 
        }
        if($vehicle_id_fk){
            $this->db->where_in('vehicle_id_fk', $vehicle_id_fk); 
        }
        if($transporter_createdby_user_id){
            $this->db->where('transporter_createdby_user_id', $transporter_createdby_user_id); 
        }
        $this->db->where("transporter_status",1);

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
		$this->db->select('*');
		$this->db->from('transporter');
		$this->db->join('transporter_vehicle', 'transporter_vehicle.transporter_id_fk = transporter.transporter_id','left');
		$this->db->join('state', 'transporter.transporter_base_station_id_fk = state.state_id','left');
		$this->db->order_by('transporter_id', 'DESC');
		$this->db->group_by('transporter_vehicle.transporter_id_fk');
        $query = $this->db->get();
        // echo $this->db->last_query();die;

        $data['data'] = $query->result();
        $data['recordsTotal'] = $this->getTransporterTotalCount($param);
        $data['recordsFiltered'] = $this->getTransporterTotalCount($param);
        return $data;

	}

	public function getTransporterTotalCount($param = NULL){

		$transporter_id =(isset($param['transporter_id']))?$param['transporter_id']:'';
		$transporter_base_station_id_fk =(isset($param['transporter_base_station_id_fk']))?$param['transporter_base_station_id_fk']:'';
		$vehicle_id_fk =(isset($param['vehicle_id_fk']))?$param['vehicle_id_fk']:'';
		$transporter_createdby_user_id =(isset($param['transporter_createdby_user_id']))?$param['transporter_createdby_user_id']:'';
		
		
		if($transporter_id){
            $this->db->where('transporter_id', $transporter_id); 
        }
		if($transporter_base_station_id_fk){
            $this->db->where('transporter_base_station_id_fk', $transporter_base_station_id_fk); 
        }
        if($vehicle_id_fk){
            $this->db->where_in('vehicle_id_fk', $vehicle_id_fk); 
        }
        if($transporter_createdby_user_id){
            $this->db->where('transporter_createdby_user_id', $transporter_createdby_user_id); 
        }
		// $currentuserid = $this->session->userdata('user_id');
		// $currentusertype = $this->session->userdata('user_type');
			
		// if($currentusertype == 'S'){
			 // $this->db->where("roles_created_by_userid",$currentuserid);
			// }
		$this->db->select('*');
		$this->db->from('transporter');
		$this->db->join('transporter_vehicle', 'transporter_vehicle.transporter_id_fk = transporter.transporter_id','left');
		$this->db->join('state', 'transporter.transporter_base_station_id_fk = state.state_id','left');
		$this->db->where("transporter_status",1);
		$this->db->order_by('transporter_id', 'DESC');
		$this->db->group_by('transporter_vehicle.transporter_id_fk');
        $query = $this->db->get();
    	return $query->num_rows();
    }
	
	public function vehicle_array_list($staff_id_fk){


        $query1 = "select *
                        from 
                            transporter_vehicle

                            LEFT JOIN vehicle p ON p.vehicle_id = transporter_vehicle.vehicle_id_fk
                            

                        where transporter_id_fk = $staff_id_fk AND
                            transporter_vehicle_status = 1";

        

        $query = $this->db->query("$query1");
        //echo $this->db->last_query();exit;
        return $query->result();
    }

    function fetch_transporter_vehicle($transporter_id)
	{

		
		
		$this->db->select('vehicle_id');
		$this->db->from('transporter_vehicle');
		$this->db->join('vehicle', 'transporter_vehicle.vehicle_id_fk = vehicle.vehicle_id');
		$this->db->where("transporter_vehicle_status",1);
		$this->db->where("transporter_id_fk	",$transporter_id);
		$query = $this->db->get();
		return $query->result();
	}

	function fetch_transporter_details()
	{
		$this->db->order_by("transporter_id", "ASC");
		$this->db->where("transporter_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("transporter");
		return $query->result();
	}

	function fetch_staff_details()
	{
		$this->db->order_by("user_id", "ASC");
		$this->db->where("user_status",1);
		// $this->db->where("user_type",'S');
		$query = $this->db->get("user_details");
		return $query->result();
	}
	

	function fetch_state()
	{
		$this->db->order_by("state_id", "ASC");
		 $this->db->where("state_status",1);
		$query = $this->db->get("state");
		return $query->result();
	}
	
	function fetch_vehicle()
	{
		$this->db->order_by("vehicle_id", "ASC");
		 $this->db->where("vehicle_status",1);
		$query = $this->db->get("vehicle");
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
		$this->db->where("transporter_status",1);
		$this->db->where('transporter_id',$id);
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
		$this->db->where('transporter_id', $id);
		// $this->db->delete($this->table);
		$this->db->update($this->table, $data);
		return $this->db->affected_rows();
	}
}
?>