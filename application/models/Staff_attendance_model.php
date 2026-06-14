<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Staff_attendance_model extends CI_Model {
    var $table = 'attendance_records';
    var $api_config_table = 'attendance_api_config';
    var $raw_logs_table = 'attendance_raw_logs';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Get attendance records for DataTable
     */
    public function get_attendance_table($param)
    {
        $staff_id_filter = isset($param['staff_id_filter']) ? $param['staff_id_filter'] : '';
        $date_from_filter = isset($param['date_from_filter']) ? $param['date_from_filter'] : '';
        $date_to_filter = isset($param['date_to_filter']) ? $param['date_to_filter'] : '';
        $status_filter = isset($param['status_filter']) ? $param['status_filter'] : '';

        // Total records (unfiltered)
        $totalData = $this->db->count_all($this->table);

        // Build filtered count query
        $this->db->from($this->table);
        $this->db->join('user_details', 'user_details.user_id = attendance_records.user_id_fk', 'left');

        if (!empty($staff_id_filter)) {
            $this->db->where('attendance_records.user_id_fk', $staff_id_filter);
        }
        if (!empty($date_from_filter)) {
            $this->db->where('attendance_records.punch_date >=', $date_from_filter);
        }
        if (!empty($date_to_filter)) {
            $this->db->where('attendance_records.punch_date <=', $date_to_filter);
        }
        if (!empty($status_filter)) {
            $this->db->where('attendance_records.status', $status_filter);
        }
        if (!empty($param['searchValue'])) {
            $this->db->group_start();
            $this->db->like('user_details.admin_name', $param['searchValue']);
            $this->db->or_like('attendance_records.punch_date', $param['searchValue']);
            $this->db->or_like('attendance_records.status', $param['searchValue']);
            $this->db->group_end();
        }

        $totalFiltered = $this->db->count_all_results();

        // Build data query
        $this->db->select('attendance_records.*, user_details.admin_name as staff_name, user_details.device_user_id, shift.shift_start_time, shift.shift_end_time');
        $this->db->select('created_user.admin_name as created_by_name, updated_user.admin_name as updated_by_name');
        $this->db->from($this->table);
        $this->db->join('user_details', 'user_details.user_id = attendance_records.user_id_fk', 'left');
        $this->db->join('user_details as created_user', 'created_user.user_id = attendance_records.created_by_user_id', 'left');
        $this->db->join('user_details as updated_user', 'updated_user.user_id = attendance_records.updated_by_user_id', 'left');
        $this->db->join('shift', 'shift.shift_id = attendance_records.shift_id_fk', 'left');

        // Apply filters
        if (!empty($staff_id_filter)) {
            $this->db->where('attendance_records.user_id_fk', $staff_id_filter);
        }
        if (!empty($date_from_filter)) {
            $this->db->where('attendance_records.punch_date >=', $date_from_filter);
        }
        if (!empty($date_to_filter)) {
            $this->db->where('attendance_records.punch_date <=', $date_to_filter);
        }
        if (!empty($status_filter)) {
            $this->db->where('attendance_records.status', $status_filter);
        }

        // Search
        if (!empty($param['searchValue'])) {
            $this->db->group_start();
            $this->db->like('user_details.admin_name', $param['searchValue']);
            $this->db->or_like('attendance_records.punch_date', $param['searchValue']);
            $this->db->or_like('attendance_records.status', $param['searchValue']);
            $this->db->group_end();
        }

        // Ordering
        if (!empty($param['order']) && !empty($param['dir'])) {
            $columns = array('attendance_id', 'admin_name', 'punch_date', 'first_punch_in', 'last_punch_out', 'net_working_hours', 'status', 'is_manual_entry');
            if (isset($columns[$param['order']])) {
                $this->db->order_by($columns[$param['order']], $param['dir']);
            }
        } else {
            $this->db->order_by('attendance_records.punch_date', 'DESC');
            $this->db->order_by('user_details.admin_name', 'ASC');
        }

        // Pagination
        if (!empty($param['length']) && $param['length'] != -1) {
            $this->db->limit($param['length'], $param['start']);
        }

        $query = $this->db->get();
        $data = $query->result();

        return array(
            'draw' => isset($param['draw']) ? intval($param['draw']) : 0,
            'recordsTotal' => $totalData,
            'recordsFiltered' => $totalFiltered,
            'data' => $data
        );
    }

    /**
     * Save attendance record
     */
    public function save($data)
    {
        // Check if record exists for this user and date
        $this->db->where('user_id_fk', $data['user_id_fk']);
        $this->db->where('punch_date', $data['punch_date']);
        $existing = $this->db->get($this->table)->row();

        if ($existing) {
            // Update existing record
            $this->db->where('attendance_id', $existing->attendance_id);
            $this->db->update($this->table, $data);
            return $existing->attendance_id;
        } else {
            // Insert new record
            $this->db->insert($this->table, $data);
            return $this->db->insert_id();
        }
    }

    /**
     * Get attendance record by ID
     */
    public function get_by_id($id)
    {
        $this->db->select('attendance_records.*, user_details.admin_name as staff_name');
        $this->db->select('created_user.admin_name as created_by_name, updated_user.admin_name as updated_by_name');
        $this->db->from($this->table);
        $this->db->join('user_details', 'user_details.user_id = attendance_records.user_id_fk', 'left');
        $this->db->join('user_details as created_user', 'created_user.user_id = attendance_records.created_by_user_id', 'left');
        $this->db->join('user_details as updated_user', 'updated_user.user_id = attendance_records.updated_by_user_id', 'left');
        $this->db->where('attendance_records.attendance_id', $id);
        $query = $this->db->get();
        return $query->row();
    }

    /**
     * Update attendance record
     */
    public function update($where, $data)
    {
        $this->db->update($this->table, $data, $where);
        return $this->db->affected_rows();
    }

    /**
     * Delete attendance record
     */
    public function delete_by_id($id)
    {
        $this->db->where('attendance_id', $id);
        $this->db->delete($this->table);
        return $this->db->affected_rows();
    }

    /**
     * Check if attendance exists for user and date
     */
    public function check_attendance_exists($user_id, $punch_date)
    {
        $this->db->where('user_id_fk', $user_id);
        $this->db->where('punch_date', $punch_date);
        $query = $this->db->get($this->table);
        return $query->num_rows() > 0;
    }

    /**
     * Get API configuration
     */
    public function get_api_config()
    {
        $query = $this->db->get($this->api_config_table);
        return $query->row();
    }

    /**
     * Save API configuration
     */
    public function save_api_config($data)
    {
        $this->db->insert($this->api_config_table, $data);
        return $this->db->insert_id();
    }

    /**
     * Update API configuration
     */
    public function update_api_config($id, $data)
    {
        $this->db->where('config_id', $id);
        $this->db->update($this->api_config_table, $data);
        return $this->db->affected_rows();
    }

    /**
     * Get active staff members
     */
    public function get_active_staff()
    {
        $this->db->order_by("admin_name", "ASC");
        $this->db->where("user_status", 1);
        $this->db->where("user_type", 'S');
        $query = $this->db->get("user_details");
        return $query->result();
    }

    /**
     * Fetch attendance data from eSSL biometric device API
     * Uses SOAP GetTransactionsLog endpoint
     */
    public function fetch_from_api($from_date, $to_date)
    {
        $config = $this->get_api_config();
        
        if (!$config || !$config->is_active) {
            return array('status' => FALSE, 'message' => 'API configuration not found or inactive');
        }

        try {
            $this->load->helper('date');
            if(function_exists('date_default_timezone_set')) {
                date_default_timezone_set("Asia/Kolkata");
            }

            // Parse credentials from api_key field (format: username:password)
            $credentials = explode(':', $config->api_key);
            $username = isset($credentials[0]) ? $credentials[0] : '';
            $password = isset($credentials[1]) ? $credentials[1] : '';

            // Build SOAP request for GetTransactionsLog
            // Date format: yyyy/MM/dd HH:mm
            $from_datetime = date('Y/m/d 00:00', strtotime($from_date));
            $to_datetime = date('Y/m/d 23:59', strtotime($to_date));

            $soap_request = '<?xml version="1.0" encoding="utf-8"?>
<soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
        <GetTransactionsLog xmlns="http://tempuri.org/">
            <FromDate>' . $from_datetime . '</FromDate>
            <ToDate>' . $to_datetime . '</ToDate>
            <SerialNumber>' . $config->device_id . '</SerialNumber>
            <UserName>' . $username . '</UserName>
            <UserPassword>' . $password . '</UserPassword>
            <strDataList>Blank</strDataList>
        </GetTransactionsLog>
    </soap:Body>
</soap:Envelope>';

            // Make SOAP call
            $api_url = $config->api_endpoint;
            if (empty($api_url)) {
                $api_url = 'http://192.168.1.140/iclock/WebAPIService.asmx';
            }

            $headers = array(
                'Content-Type: text/xml; charset=utf-8',
                'SOAPAction: "http://tempuri.org/GetTransactionsLog"',
                'Content-Length: ' . strlen($soap_request)
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, $api_url);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $soap_request);
            curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
            curl_setopt($ch, CURLOPT_TIMEOUT, 60);
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);

            $response = curl_exec($ch);
            $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
            $curl_error = curl_error($ch);
            curl_close($ch);

            if ($curl_error) {
                throw new Exception('cURL Error: ' . $curl_error);
            }

            if ($http_code != 200) {
                throw new Exception('HTTP Error: ' . $http_code);
            }

            // Parse SOAP response
            $xml = simplexml_load_string($response);
            if ($xml === false) {
                throw new Exception('Failed to parse XML response');
            }

            // Register SOAP namespaces
            $namespaces = $xml->getNamespaces(true);
            $soap_ns = isset($namespaces['soap']) ? $namespaces['soap'] : 'http://schemas.xmlsoap.org/soap/envelope/';
            
            // Extract response data
            $xml->registerXPathNamespace('soap', $soap_ns);
            $xml->registerXPathNamespace('tempuri', 'http://tempuri.org/');

            $result = $xml->xpath('//tempuri:GetTransactionsLogResponse/tempuri:GetTransactionsLogResult');
            $data_list = $xml->xpath('//tempuri:GetTransactionsLogResponse/tempuri:strDataList');

            $transaction_data = isset($data_list[0]) ? (string)$data_list[0] : '';

            // If no data returned or data contains placeholder text, handle gracefully
            if (empty($transaction_data) || strpos($transaction_data, 'We will Post data') !== false || strpos($transaction_data, 'Blank') !== false) {
                // No new transactions or device not ready
                $update_data = array(
                    'last_sync_datetime' => date('Y-m-d H:i:s'),
                    'last_sync_status' => 'success',
                    'last_sync_message' => 'No new transactions found'
                );
                
                $this->db->where('config_id', $config->config_id);
                $this->db->update($this->api_config_table, $update_data);

                return array(
                    'status' => TRUE, 
                    'message' => 'No new transactions found for the selected date range',
                    'processed_count' => 0
                );
            }

            // Process transaction data (JSON format expected)
            $processed_count = $this->process_essl_transaction_data($transaction_data);

            // Update last sync info
            $update_data = array(
                'last_sync_datetime' => date('Y-m-d H:i:s'),
                'last_sync_status' => 'success',
                'last_sync_message' => 'Synced ' . $processed_count . ' records'
            );
            
            $this->db->where('config_id', $config->config_id);
            $this->db->update($this->api_config_table, $update_data);

            return array(
                'status' => TRUE, 
                'message' => 'Successfully synced ' . $processed_count . ' attendance records',
                'processed_count' => $processed_count
            );

        } catch (Exception $e) {
            // Update sync status on error
            $this->db->where('config_id', $config->config_id);
            $this->db->update($this->api_config_table, array(
                'last_sync_datetime' => date('Y-m-d H:i:s'),
                'last_sync_status' => 'failed',
                'last_sync_message' => $e->getMessage()
            ));

            return array('status' => FALSE, 'message' => 'API Error: ' . $e->getMessage());
        }
    }

    /**
     * Process eSSL transaction data from GetTransactionsLog response
     * Expected format: JSON array of punch records
     */
    private function process_essl_transaction_data($transaction_data)
    {
        $processed = 0;
        
        // Try to parse JSON data
        $transactions = json_decode($transaction_data, true);
        
        if (!is_array($transactions)) {
            // If not valid JSON, log error and return
            log_message('error', 'Invalid transaction data format from eSSL device: ' . substr($transaction_data, 0, 500));
            return 0;
        }

        // Group transactions by employee and date
        $grouped_data = array();
        
        foreach ($transactions as $transaction) {
            // Expected fields: EmployeeCode, PunchDateTime, etc.
            $employee_code = isset($transaction['EmployeeCode']) ? $transaction['EmployeeCode'] : 
                             (isset($transaction['employee_code']) ? $transaction['employee_code'] : '');
            
            $punch_datetime = isset($transaction['PunchDateTime']) ? $transaction['PunchDateTime'] : 
                              (isset($transaction['punch_datetime']) ? $transaction['punch_datetime'] : '');
            
            if (empty($employee_code) || empty($punch_datetime)) {
                continue;
            }

            // Parse date and time
            $date = date('Y-m-d', strtotime($punch_datetime));
            $time = date('H:i:s', strtotime($punch_datetime));
            
            // Group by employee code and date
            $key = $employee_code . '_' . $date;
            
            if (!isset($grouped_data[$key])) {
                $grouped_data[$key] = array(
                    'employee_code' => $employee_code,
                    'date' => $date,
                    'punches' => array()
                );
            }
            
            $grouped_data[$key]['punches'][] = $time;
        }

        // Process grouped data into attendance records
        foreach ($grouped_data as $key => $data) {
            if (empty($data['punches'])) {
                continue;
            }

            // Find user by device_user_id (employee_code)
            $this->db->where('device_user_id', $data['employee_code']);
            $user = $this->db->get('user_details')->row();
            
            if (!$user) {
                // Store raw log without user mapping for later processing
                foreach ($data['punches'] as $punch_time) {
                    $raw_log = array(
                        'device_user_id' => $data['employee_code'],
                        'punch_datetime' => $data['date'] . ' ' . $punch_time,
                        'punch_type' => 'other',
                        'device_id' => $this->get_api_config()->device_id,
                        'is_processed' => 0,
                        'raw_data' => json_encode($data)
                    );
                    $this->db->insert($this->raw_logs_table, $raw_log);
                }
                continue;
            }

            // Calculate attendance metrics
            sort($data['punches']);
            $first_punch = $data['punches'][0];
            $last_punch = end($data['punches']);
            
            $start = strtotime($first_punch);
            $end = strtotime($last_punch);
            $hours = round(($end - $start) / 3600, 2);
            
            // Determine status
            $status = 'present';
            $late_threshold = '09:30:00';
            
            if (strtotime($first_punch) > strtotime($late_threshold)) {
                $status = 'late';
            }
            if ($hours < 4) {
                $status = 'half_day';
            }

            // Check if it's a holiday or weekend
            if ($this->check_holiday($data['date'])) {
                $status = 'holiday';
            }
            $dayOfWeek = date('w', strtotime($data['date']));
            if ($dayOfWeek == 0 || $dayOfWeek == 6) {
                $status = 'weekend';
            }

            // Save attendance record
            $attendance_data = array(
                'user_id_fk' => $user->user_id,
                'device_user_id' => $data['employee_code'],
                'punch_date' => $data['date'],
                'first_punch_in' => $first_punch,
                'last_punch_out' => $last_punch,
                'total_working_hours' => $hours,
                'net_working_hours' => $hours,
                'status' => $status,
                'shift_id_fk' => $user->shift_id_fk,
                'device_punch_count' => count($data['punches']),
                'created_date' => date('Y-m-d'),
                'created_time' => date('h:i:sa')
            );

            $this->save($attendance_data);
            $processed++;
        }

        return $processed;
    }

    /**
     * Check if date is a holiday
     */
    private function check_holiday($date)
    {
        $this->db->where('holiday_date', $date);
        $this->db->where('holiday_status', 1);
        $query = $this->db->get('company_holidays');
        
        if ($query->num_rows() > 0) {
            return TRUE;
        }
        
        // Check Sunday setting
        $dayOfWeek = date('w', strtotime($date));
        if ($dayOfWeek == 0) {
            $this->db->where('setting_key', 'enable_sunday_holiday');
            $result = $this->db->get('holiday_settings')->row();
            if ($result && $result->setting_value == '1') {
                return TRUE;
            }
        }
        
        // Check 2nd Saturday setting
        if ($dayOfWeek == 6) {
            $dayOfMonth = date('j', strtotime($date));
            if ($dayOfMonth >= 8 && $dayOfMonth <= 14) {
                $this->db->where('setting_key', 'enable_second_saturday_holiday');
                $result = $this->db->get('holiday_settings')->row();
                if ($result && $result->setting_value == '1') {
                    return TRUE;
                }
            }
        }
        
        return FALSE;
    }

    /**
     * Get monthly attendance summary
     */
    public function get_monthly_summary($month, $year, $user_id = null)
    {
        $this->db->select('
            user_details.admin_name as staff_name,
            COUNT(*) as total_days,
            SUM(CASE WHEN attendance_records.status = "present" THEN 1 ELSE 0 END) as present_days,
            SUM(CASE WHEN attendance_records.status = "absent" THEN 1 ELSE 0 END) as absent_days,
            SUM(CASE WHEN attendance_records.status = "late" THEN 1 ELSE 0 END) as late_days,
            SUM(CASE WHEN attendance_records.status = "half_day" THEN 1 ELSE 0 END) as half_days,
            SUM(CASE WHEN attendance_records.status = "on_leave" THEN 1 ELSE 0 END) as leave_days,
            SUM(CASE WHEN attendance_records.status IN ("holiday", "weekend") THEN 1 ELSE 0 END) as holidays,
            SUM(attendance_records.net_working_hours) as total_working_hours,
            ROUND(AVG(attendance_records.net_working_hours), 2) as avg_working_hours
        ');
        $this->db->from($this->table);
        $this->db->join('user_details', 'user_details.user_id = attendance_records.user_id_fk', 'left');
        $this->db->where('MONTH(attendance_records.punch_date)', $month);
        $this->db->where('YEAR(attendance_records.punch_date)', $year);
        
        if (!empty($user_id)) {
            $this->db->where('attendance_records.user_id_fk', $user_id);
        }
        
        $this->db->group_by('attendance_records.user_id_fk');
        $query = $this->db->get();
        
        return $query->result();
    }

    /**
     * Process raw punch logs and calculate attendance
     */
    public function process_raw_logs($date)
    {
        // Get all unprocessed raw logs for the date
        $this->db->where('DATE(punch_datetime)', $date);
        $this->db->where('is_processed', 0);
        $this->db->order_by('device_user_id, punch_datetime');
        $logs = $this->db->get($this->raw_logs_table)->result();
        
        // Group logs by user
        $user_logs = array();
        foreach ($logs as $log) {
            if (!isset($user_logs[$log->device_user_id])) {
                $user_logs[$log->device_user_id] = array();
            }
            $user_logs[$log->device_user_id][] = $log;
        }
        
        // Process each user's logs
        foreach ($user_logs as $device_user_id => $punches) {
            if (empty($punches)) continue;
            
            $first_punch = $punches[0];
            $last_punch = end($punches);
            
            // Get user_id from device_user_id mapping
            $this->db->where('device_user_id', $device_user_id);
            $user = $this->db->get('user_details')->row();
            
            if (!$user) continue;
            
            $punch_in = date('H:i:s', strtotime($first_punch->punch_datetime));
            $punch_out = date('H:i:s', strtotime($last_punch->punch_datetime));
            
            $start = strtotime($punch_in);
            $end = strtotime($punch_out);
            $hours = round(($end - $start) / 3600, 2);
            
            // Determine status
            $status = 'present';
            if (strtotime($punch_in) > strtotime('09:30:00')) {
                $status = 'late';
            }
            if ($hours < 4) {
                $status = 'half_day';
            }
            
            $data = array(
                'user_id_fk' => $user->user_id,
                'device_user_id' => $device_user_id,
                'punch_date' => $date,
                'first_punch_in' => $punch_in,
                'last_punch_out' => $punch_out,
                'total_working_hours' => $hours,
                'net_working_hours' => $hours,
                'status' => $status,
                'device_punch_count' => count($punches),
                'created_date' => date('Y-m-d'),
                'created_time' => date('h:i:sa')
            );
            
            $this->save($data);
            
            // Mark logs as processed
            foreach ($punches as $punch) {
                $this->db->where('log_id', $punch->log_id);
                $this->db->update($this->raw_logs_table, array(
                    'is_processed' => 1,
                    'processed_date' => date('Y-m-d H:i:s'),
                    'user_id_fk' => $user->user_id
                ));
            }
        }
        
        return count($user_logs);
    }
}
?>
