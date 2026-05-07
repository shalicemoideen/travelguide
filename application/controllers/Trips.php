<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Trips extends MY_Controller {
	public $table = 'itineraries';
	public $itineraries_days = 'itineraries_days';
	public $activity = 'activity';
	public $page  = 'Trips';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Trips_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		$template['staff'] = $this->Trips_model->fetch_staff_details();
		$template['users'] = $this->Trips_model->fetch_all_users();
		$template['leads'] = $this->Trips_model->fetch_leads();
		// $template['packages'] = $this->Trips_model->fetch_packages_filter();
        $template['quotation'] = $this->Trips_model->fetch_quotation();
		$template['body'] = 'Trips/list';
		$template['script'] = 'Trips/script';
		$this->load->view('template', $template);
	}

	public function get(){
		$this->load->model('Trips_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['quotation_number_filter'] =(isset($_REQUEST['quotation_number_filter']))?$_REQUEST['quotation_number_filter']:'';
		$param['leads_id_filter'] =(isset($_REQUEST['leads_id_filter']))?$_REQUEST['leads_id_filter']:'';
		$param['package_id_filter'] =(isset($_REQUEST['package_id_filter']))?$_REQUEST['package_id_filter']:'';
		$param['arriving_destination_filter'] =(isset($_REQUEST['arriving_destination_filter']))?$_REQUEST['arriving_destination_filter']:'';
        $param['departuring_destination_filter'] =(isset($_REQUEST['departuring_destination_filter']))?$_REQUEST['departuring_destination_filter']:'';
        $param['trips_current_status_filter'] =(isset($_REQUEST['trips_current_status_filter']))?$_REQUEST['trips_current_status_filter']:'';
        $param['trips_created_by_userid'] =(isset($_REQUEST['trips_created_by_userid']))?$_REQUEST['trips_created_by_userid']:'';
		
		$start_date =(isset($_REQUEST['start_date']))?$_REQUEST['start_date']:'';
        $end_date =(isset($_REQUEST['end_date']))?$_REQUEST['end_date']:'';
		if($start_date){
            $start_date = str_replace('/', '-', $start_date);
            $param['start_date'] =  date("Y-m-d",strtotime($start_date));
        }
       
        if($end_date){
            $end_date = str_replace('/', '-', $end_date);
            $param['end_date'] =  date("Y-m-d",strtotime($end_date));
        }

    	$data = $this->Trips_model->getTripsTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

}
?>