<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class Room_list extends MY_Controller {
	public $table = 'user_details';
	public $table1 = 'main_head';
	public $page  = 'Room_list';
	public function __construct() {
		parent::__construct();
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		
		// print_r($data);exit;
		$template['body'] = 'Room_list/list';
		$template['script'] = 'Room_list/script';
		$this->load->view('template', $template);
	}
	
}
?>