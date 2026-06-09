<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Staff_order_assign extends MY_Controller {
	public $table = 'staff_order_assign';
	public $staff_order_assign_details = 'staff_order_assign_details';
	public $activity = 'activity';
	public $page  = 'Staff_order_assign';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Staff_order_assign_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		
		// $template['meta'] = $this->Meta_ads_setting_model->fetch_meta_ads_setting_details();
		// $template['staff'] = $this->Meta_ads_setting_model->fetch_staff_details();
        // $template['allstaff'] = $this->Meta_ads_setting_model->fetch_allstaff_details();
		$template['body'] = 'Staff_order_assign/list';
		$template['script'] = 'Staff_order_assign/script';
		$this->load->view('template', $template);
	}

    public function ajax_get_all_shifts()
    {
        $shifts = $this->Staff_order_assign_model->get_all_shifts();
        echo json_encode($shifts);
    }

    public function ajax_get_all_campaigns()
    {
        $campaigns = $this->Staff_order_assign_model->get_all_campaigns();
        echo json_encode($campaigns);
    }

    public function ajax_get_staff_order_by_shift_campaign()
    {
        $shift_id    = $this->input->post('shift_id');
        $campaign_id = $this->input->post('campaign_id');

        $staff = $this->Staff_order_assign_model->get_staff_order_by_shift_campaign($shift_id, $campaign_id);

        echo json_encode($staff);
    }

    public function ajax_update_staff_order()
    {
        $order_data = $this->input->post('order_data');

        if (empty($order_data) || !is_array($order_data)) {
            echo json_encode(array('status' => FALSE, 'message' => 'Invalid order data'));
            return;
        }

        $this->db->trans_begin();

        foreach ($order_data as $row) {
            $update_data = array(
                'staff_order' => $row['staff_order']
            );

            $this->db->where('staff_order_assign_id', $row['staff_order_assign_id']);
            $this->db->update('staff_order_assign', $update_data);
        }

        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();
            echo json_encode(array('status' => FALSE));
        } else {
            $this->db->trans_commit();
            echo json_encode(array('status' => TRUE));
        }
    }

    public function ajax_check_holiday()
    {
        $date = $this->input->post('date');
        
        if (empty($date)) {
            echo json_encode(array('status' => FALSE, 'is_holiday' => FALSE, 'message' => 'Invalid date'));
            return;
        }

        $is_holiday = $this->Staff_order_assign_model->is_holiday($date);
        $holiday_type = '';
        
        if ($is_holiday) {
            $dayOfWeek = date('w', strtotime($date));
            $dayOfMonth = date('j', strtotime($date));
            
            if ($dayOfWeek == 0) {
                $holiday_type = 'Sunday';
            } elseif ($dayOfWeek == 6 && $dayOfMonth >= 8 && $dayOfMonth <= 14) {
                $holiday_type = '2nd Saturday';
            } else {
                $holiday_type = 'Custom Holiday';
            }
        }
        
        echo json_encode(array('status' => TRUE, 'is_holiday' => $is_holiday, 'holiday_type' => $holiday_type));
    }

}
?>