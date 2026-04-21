<?php
defined('BASEPATH') OR exit('No direct script access allowed');

require_once dirname(__FILE__).'/../libraries/vendor/autoload.php';

class Home extends MY_Controller {
	public $task_management = 'task_management';
	public $user_details = 'user_details';
	public $task = 'task';
	public $page  = 'Task_management';
	public $cronMethods = array('Duetasklist');

	public function __construct() {

		parent::__construct();

	// public function __construct() {
		// parent::__construct();
        // if(! $this->is_logged_in()){
          // redirect('/login');
        // }
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		$this->load->library('email');
        $this->load->model('General_model');
        // $this->load->model('Task_management_model');
       
        
	}
	
	
	public function index()
	{
		
		$template['body'] = 'home/list';
		$template['script'] = 'home/script';
		$this->load->view('template', $template);
	}

}

?>