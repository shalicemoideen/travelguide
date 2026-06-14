<?php 
defined('BASEPATH') OR exit('No direct script access allowed');

class Staff_attendance extends MY_Controller {
    public $table = 'attendance_records';
    public $activity = 'activity';
    public $page = 'Staff Attendance';

    public function __construct() {
        parent::__construct();
        if(!$this->input->is_cli_request() && !$this->is_logged_in()){
            redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
        
        $this->load->model('General_model');
        $this->load->model('Staff_attendance_model');
        $this->load->model('Staff_model');
    }

    public function index()
    {
        $template['staff_list'] = $this->Staff_attendance_model->get_active_staff();
        $template['api_config'] = $this->Staff_attendance_model->get_api_config();
        $template['shifts'] = $this->Staff_model->fetch_shift();
        $template['body'] = 'Staff_attendance/list';
        $template['script'] = 'Staff_attendance/script';
        $this->load->view('template', $template);
    }

    /**
     * Get attendance records for DataTable
     */
    public function get()
    {
        $param['draw'] = (isset($_REQUEST['draw'])) ? $_REQUEST['draw'] : '';
        $param['length'] = (isset($_REQUEST['length'])) ? $_REQUEST['length'] : '10';
        $param['start'] = (isset($_REQUEST['start'])) ? $_REQUEST['start'] : '0';
        $param['order'] = (isset($_REQUEST['order'][0]['column'])) ? $_REQUEST['order'][0]['column'] : '';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir'])) ? $_REQUEST['order'][0]['dir'] : '';
        $param['searchValue'] = (isset($_REQUEST['search']['value'])) ? $_REQUEST['search']['value'] : '';
        
        $param['staff_id_filter'] = (isset($_REQUEST['staff_id_filter'])) ? $_REQUEST['staff_id_filter'] : '';
        $param['date_from_filter'] = (isset($_REQUEST['date_from_filter'])) ? $_REQUEST['date_from_filter'] : '';
        $param['date_to_filter'] = (isset($_REQUEST['date_to_filter'])) ? $_REQUEST['date_to_filter'] : '';
        $param['status_filter'] = (isset($_REQUEST['status_filter'])) ? $_REQUEST['status_filter'] : '';

        $data = $this->Staff_attendance_model->get_attendance_table($param);
        echo json_encode($data);
    }

    /**
     * Fetch attendance data from biometric device API
     */
    public function sync_from_device()
    {
        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }

        $from_date = $this->input->post('from_date');
        $to_date = $this->input->post('to_date');

        if (empty($from_date) || empty($to_date)) {
            echo json_encode(array('status' => FALSE, 'message' => 'Date range is required'));
            return;
        }

        $result = $this->Staff_attendance_model->fetch_from_api($from_date, $to_date);
        
        // Log activity
        $currentuserid = $this->session->userdata('user_id');
        $currentusername = $this->session->userdata('admin_name');
        $date = date('Y-m-d');
        $date1 = date('Y-m-d h:i:s a');
        $ip = $this->input->ip_address();

        $activity_data = array(
            'activity_description' => 'Synced attendance data from biometric device: ' . $from_date . ' to ' . $to_date,
            'id_fk' => 0,
            'activity_type' => 'Staff_attendance',
            'activity_ip' => $ip,
            'activity_action' => 'Sync',
            'activity_by_userid' => $currentuserid,
            'activity_by_username' => $currentusername,
            'activity_date_time' => $date1,
            'activity_date' => $date,
            'activity_status' => $result['status'] ? 1 : 0,
        );
        
        $this->General_model->add($this->activity, $activity_data);

        echo json_encode($result);
    }

    /**
     * Add manual attendance entry
     */
    public function ajax_add()
    {
        $this->_validate();
        
        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }
        
        $date = date('Y-m-d');
        $time = date('h:i:sa');
        $date1 = date('Y-m-d h:i:s a');

        $currentuserid = $this->session->userdata('user_id');
        $currentusername = $this->session->userdata('admin_name');
        
        $user_id = $this->input->post('user_id_fk');
        $punch_date = $this->input->post('punch_date');
        
        // Calculate working hours
        $first_punch_in = $this->input->post('first_punch_in');
        $last_punch_out = $this->input->post('last_punch_out');
        $total_working_hours = 0;
        $net_working_hours = 0;
        
        if (!empty($first_punch_in) && !empty($last_punch_out)) {
            $start = strtotime($first_punch_in);
            $end = strtotime($last_punch_out);
            $diff = ($end - $start) / 3600;
            $total_working_hours = round($diff, 2);
            $net_working_hours = $total_working_hours;
        }

        $data = array(
            'user_id_fk' => $user_id,
            'punch_date' => $punch_date,
            'first_punch_in' => $first_punch_in,
            'last_punch_out' => $last_punch_out,
            'total_working_hours' => $total_working_hours,
            'net_working_hours' => $net_working_hours,
            'status' => $this->input->post('status'),
            'shift_id_fk' => $this->input->post('shift_id_fk'),
            'is_manual_entry' => 1,
            'manual_entry_reason' => $this->input->post('manual_entry_reason'),
            'created_date' => $date,
            'created_time' => $time,
            'created_by_user_id' => $currentuserid,
        );

        $insert = $this->Staff_attendance_model->save($data);

        // Log activity
        $ip = $this->input->ip_address();
        $activity_data = array(
            'activity_description' => 'Added manual attendance entry for user ID: ' . $user_id . ' on ' . $punch_date,
            'id_fk' => $insert,
            'activity_type' => 'Staff_attendance',
            'activity_ip' => $ip,
            'activity_action' => 'Add',
            'activity_by_userid' => $currentuserid,
            'activity_by_username' => $currentusername,
            'activity_date_time' => $date1,
            'activity_date' => $date,
            'activity_status' => 1,
        );
        
        $this->General_model->add($this->activity, $activity_data);

        echo json_encode(array("status" => TRUE));
    }

    /**
     * Get attendance record for editing
     */
    public function ajax_edit($id)
    {
        $data = $this->Staff_attendance_model->get_by_id($id);
        echo json_encode($data);
    }

    /**
     * Update attendance record
     */
    public function ajax_update()
    {
        $this->_validate();
        
        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }
        
        $date = date('Y-m-d');
        $time = date('h:i:sa');
        $date1 = date('Y-m-d h:i:s a');

        $currentuserid = $this->session->userdata('user_id');
        $currentusername = $this->session->userdata('admin_name');
        
        $id = $this->input->post('attendance_id');
        
        // Calculate working hours
        $first_punch_in = $this->input->post('first_punch_in');
        $last_punch_out = $this->input->post('last_punch_out');
        $total_working_hours = 0;
        $net_working_hours = 0;
        
        if (!empty($first_punch_in) && !empty($last_punch_out)) {
            $start = strtotime($first_punch_in);
            $end = strtotime($last_punch_out);
            $diff = ($end - $start) / 3600;
            $total_working_hours = round($diff, 2);
            $net_working_hours = $total_working_hours;
        }

        $data = array(
            'first_punch_in' => $first_punch_in,
            'last_punch_out' => $last_punch_out,
            'total_working_hours' => $total_working_hours,
            'net_working_hours' => $net_working_hours,
            'status' => $this->input->post('status'),
            'shift_id_fk' => $this->input->post('shift_id_fk'),
            'manual_entry_reason' => $this->input->post('manual_entry_reason'),
            'updated_date' => $date,
            'updated_time' => $time,
            'updated_by_user_id' => $currentuserid,
        );

        $this->Staff_attendance_model->update(array('attendance_id' => $id), $data);

        // Log activity
        $ip = $this->input->ip_address();
        $activity_data = array(
            'activity_description' => 'Updated attendance record ID: ' . $id,
            'id_fk' => $id,
            'activity_type' => 'Staff_attendance',
            'activity_ip' => $ip,
            'activity_action' => 'Edit',
            'activity_by_userid' => $currentuserid,
            'activity_by_username' => $currentusername,
            'activity_date_time' => $date1,
            'activity_date' => $date,
            'activity_status' => 1,
        );
        
        $this->General_model->add($this->activity, $activity_data);

        echo json_encode(array("status" => TRUE));
    }

    /**
     * Delete attendance record
     */
    public function delete()
    {
        $currentuserid = $this->session->userdata('user_id');
        $currentusername = $this->session->userdata('admin_name');

        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }
        $date = date('Y-m-d');
        $date1 = date('Y-m-d h:i:s a');

        $id = $this->input->post('attendance_id');
        
        $this->Staff_attendance_model->delete_by_id($id);

        // Log activity
        $ip = $this->input->ip_address();
        $activity_data = array(
            'activity_description' => 'Deleted attendance record ID: ' . $id,
            'id_fk' => $id,
            'activity_type' => 'Staff_attendance',
            'activity_ip' => $ip,
            'activity_action' => 'Delete',
            'activity_by_userid' => $currentuserid,
            'activity_by_username' => $currentusername,
            'activity_date_time' => $date1,
            'activity_date' => $date,
            'activity_status' => 1,
        );
        
        $this->General_model->add($this->activity, $activity_data);

        echo json_encode(array("status" => TRUE));
    }

    /**
     * Save API configuration
     */
    public function save_api_config()
    {
        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }
        
        $date = date('Y-m-d');
        $time = date('h:i:sa');

        $currentuserid = $this->session->userdata('user_id');
        $currentusername = $this->session->userdata('admin_name');

        $data = array(
            'api_name' => $this->input->post('api_name'),
            'api_endpoint' => $this->input->post('api_endpoint'),
            'api_key' => $this->input->post('api_key'),
            'api_secret' => $this->input->post('api_secret'),
            'device_id' => $this->input->post('device_id'),
            'sync_interval_minutes' => $this->input->post('sync_interval_minutes'),
            'is_active' => $this->input->post('is_active') ? 1 : 0,
            'updated_date' => $date,
            'updated_time' => $time,
        );

        $config_id = $this->input->post('config_id');
        
        if ($config_id) {
            $this->Staff_attendance_model->update_api_config($config_id, $data);
        } else {
            $data['created_date'] = $date;
            $data['created_time'] = $time;
            $data['created_by_user_id'] = $currentuserid;
            $config_id = $this->Staff_attendance_model->save_api_config($data);
        }

        // Log activity
        $ip = $this->input->ip_address();
        $date1 = date('Y-m-d h:i:s a');
        $activity_data = array(
            'activity_description' => 'Updated API configuration for biometric device',
            'id_fk' => $config_id,
            'activity_type' => 'Staff_attendance',
            'activity_ip' => $ip,
            'activity_action' => 'Config_Update',
            'activity_by_userid' => $currentuserid,
            'activity_by_username' => $currentusername,
            'activity_date_time' => $date1,
            'activity_date' => $date,
            'activity_status' => 1,
        );
        
        $this->General_model->add($this->activity, $activity_data);

        echo json_encode(array("status" => TRUE));
    }

    /**
     * Get monthly attendance summary
     */
    public function get_monthly_summary()
    {
        $month = $this->input->post('month');
        $year = $this->input->post('year');
        $user_id = $this->input->post('user_id_fk');

        if (empty($month) || empty($year)) {
            echo json_encode(array('status' => FALSE, 'message' => 'Month and year are required'));
            return;
        }

        $data = $this->Staff_attendance_model->get_monthly_summary($month, $year, $user_id);
        echo json_encode(array('status' => TRUE, 'data' => $data));
    }

    /**
     * Check if attendance record exists for user and date
     */
    public function check_attendance_exists()
    {
        $user_id = $this->input->post('user_id');
        $punch_date = $this->input->post('punch_date');
        
        $exists = $this->Staff_attendance_model->check_attendance_exists($user_id, $punch_date);
        echo json_encode(array('exists' => $exists));
    }

    /**
     * Cron job for automatic attendance sync
     * Called via CLI: php index.php Staff_attendance cron_sync
     * Only accessible from command line for security
     */
    public function cron_sync()
    {
        // Only allow CLI access
        if (!$this->input->is_cli_request()) {
            show_error('This endpoint is only accessible via CLI', 403);
            return;
        }

        $this->load->helper('date');
        if(function_exists('date_default_timezone_set')) {
            date_default_timezone_set("Asia/Kolkata");
        }

        $config = $this->Staff_attendance_model->get_api_config();

        if (!$config || !$config->is_active) {
            echo date('Y-m-d H:i:s') . " - Cron: API config not found or inactive. Skipping.\n";
            return;
        }

        // Check if enough time has passed since last sync
        if (!empty($config->last_sync_datetime)) {
            $last_sync = strtotime($config->last_sync_datetime);
            $interval_seconds = intval($config->sync_interval_minutes) * 60;
            $next_sync_time = $last_sync + $interval_seconds;

            if (time() < $next_sync_time) {
                echo date('Y-m-d H:i:s') . " - Cron: Next sync at " . date('Y-m-d H:i:s', $next_sync_time) . ". Skipping.\n";
                return;
            }
        }

        // Sync today's data
        $from_date = date('Y-m-d');
        $to_date = date('Y-m-d');

        echo date('Y-m-d H:i:s') . " - Cron: Starting sync for $from_date to $to_date\n";

        $result = $this->Staff_attendance_model->fetch_from_api($from_date, $to_date);

        // Log activity
        $date = date('Y-m-d');
        $date1 = date('Y-m-d h:i:s a');

        $activity_data = array(
            'activity_description' => 'Cron: Auto-synced attendance from device: ' . $from_date . ' to ' . $to_date,
            'id_fk' => 0,
            'activity_type' => 'Staff_attendance',
            'activity_ip' => '127.0.0.1',
            'activity_action' => 'Cron_Sync',
            'activity_by_userid' => 0,
            'activity_by_username' => 'SYSTEM',
            'activity_date_time' => $date1,
            'activity_date' => $date,
            'activity_status' => $result['status'] ? 1 : 0,
        );

        $this->General_model->add($this->activity, $activity_data);

        echo date('Y-m-d H:i:s') . " - Cron: " . $result['message'] . "\n";
    }

    /**
     * Validation rules
     */
    private function _validate()
    {
        $data = array();
        $data['error_string'] = array();
        $data['inputerror'] = array();
        $data['status'] = TRUE;

        if($this->input->post('user_id_fk') == '')
        {
            $data['inputerror'][] = 'user_id_fk';
            $data['error_string'][] = 'Staff member is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('punch_date') == '')
        {
            $data['inputerror'][] = 'punch_date';
            $data['error_string'][] = 'Date is required';
            $data['status'] = FALSE;
        }

        if($this->input->post('status') == '')
        {
            $data['inputerror'][] = 'status';
            $data['error_string'][] = 'Status is required';
            $data['status'] = FALSE;
        }

        if($data['status'] === FALSE)
        {
            echo json_encode($data);
            exit();
        }
    }
}
?>
