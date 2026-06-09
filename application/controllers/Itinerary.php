<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Itinerary extends MY_Controller {
	public $table = 'itineraries';
	public $itineraries_days = 'itineraries_days';
	public $activity = 'activity';
	public $page  = 'Itinerary';
	public function __construct() {
		parent::__construct();
        if(! $this->is_logged_in()){
          redirect('/login');
        }
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Itinerary_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';

		$template['body'] = 'Itinerary/list';
		$template['script'] = 'Itinerary/script';
		$this->load->view('template', $template);
	}

	public function get_itinerary_dropdown()
	{
		$search = $this->input->get('q');
		$this->db->select('itineraries_id as id, itineraries_name as text');
		$this->db->from('itineraries');
		$this->db->where('itineraries_status', 1);

		if ($search) {
			$this->db->like('itineraries_name', $search);
		}

		$this->db->order_by('itineraries_name', 'ASC');
		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get_itinerary_category_dropdown()
	{
		$search = $this->input->get('q');
		$this->db->select('itinerary_category_id as id, itinerary_category_name as text');
		$this->db->from('itinerary_category');
		$this->db->where('itinerary_category_status', 1);

		if ($search) {
			$this->db->like('itinerary_category_name', $search);
		}

		$this->db->order_by('itinerary_category_name', 'ASC');
		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get_destination_dropdown()
	{
		$search = $this->input->get('q');
		$this->db->select('state_id as id, state_name as text');
		$this->db->from('state');
		$this->db->where('state_status', 1);

		if ($search) {
			$this->db->like('state_name', $search);
		}

		$this->db->order_by('state_name', 'ASC');
		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get_staff_dropdown()
	{
		$search = $this->input->get('q');
		$this->db->select('user_id as id, admin_name as text');
		$this->db->from('user_details');
		$this->db->where('user_status', 1);

		if ($search) {
			$this->db->like('admin_name', $search);
		}

		$this->db->order_by('admin_name', 'ASC');
		$query = $this->db->get();
		$results = $query->result();

		echo json_encode(['results' => $results]);
	}

	public function get(){
		$this->load->model('Itinerary_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['itineraries_id_filter'] =(isset($_REQUEST['itineraries_id_filter']))?$_REQUEST['itineraries_id_filter']:'';
		$param['itineraries_category_id_filter'] =(isset($_REQUEST['itineraries_category_id_filter']))?$_REQUEST['itineraries_category_id_filter']:'';
		$param['itineraries_duration_nights_filter'] =(isset($_REQUEST['itineraries_duration_nights_filter']))?$_REQUEST['itineraries_duration_nights_filter']:'';
		$param['itineraries_days_destination_id_fk_filter'] =(isset($_REQUEST['itineraries_days_destination_id_fk_filter']))?$_REQUEST['itineraries_days_destination_id_fk_filter']:'';
		
		$param['itineraries_createdby_user_id'] =(isset($_REQUEST['itineraries_createdby_user_id']))?$_REQUEST['itineraries_createdby_user_id']:'';
		
		if (!has_permission('ITINERARY_VIEW')) {
	        echo json_encode([
	            "draw" => intval($this->input->post('draw')),
	            "recordsTotal" => 0,
	            "recordsFiltered" => 0,
	            "data" => []
	        ]);
	        return;
	    }

    	$data = $this->Itinerary_model->getItinerarypoliciesTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }

    // public function fetch_itineraries_days(){
            
    //         $itineraries_id = $this->input->post('itineraries_id');
    //         $data = $this->Itinerary_model->fetch_itineraries_days($itineraries_id);
    //         $json_data = json_encode($data);
    //         echo $json_data;
            
    //     }

// }

	public function preview($id)
	{
		$data = array();
		$data['itineraries_id'] = (int)$id;

		// IMPORTANT: load ONLY preview page view
		$this->load->view('Itinerary/view', $data);
	}

	public function ajax_view_preview($id)
	{
		$id = (int)$id;

		$master = $this->db->where('itineraries_id', $id)
			->where('itineraries_status', 1)
			->get('itineraries')->row_array();

		if (!$master) {
			echo json_encode(['status' => false]);
			return;
		}

		$days = $this->db->where('itineraries_id_fk', $id)
			->where('itineraries_days_status', 1)
			->order_by('itineraries_days_id', 'ASC')
			->get('itineraries_days')->result_array();

		// Build response for preview
		$outDays = [];
		foreach ($days as $d) {

			$imgUrl = '';
			if (!empty($d['itineraries_days_image'])) {
				// example path: uploads/itinerary_days/filename.jpg
				$imgUrl = base_url('uploads/itinerary_days/' . $d['itineraries_days_image']);
			}

			// if DB stores "Day 1" already, keep it
			$dayText = !empty($d['itineraries_days_day']) ? $d['itineraries_days_day'] : '';

			// extract numeric for fallback
			$dayNo = 0;
			if ($dayText) {
				$dayNo = (int) trim(str_ireplace('Day', '', $dayText));
			}

			$outDays[] = [
				'day_text'   => $dayText,
				'day_no'     => $dayNo,
				'title'      => $d['itineraries_days_title'],
				// description is HTML (from editor) – send as-is
				'desc_html'  => $d['itineraries_days_description'],
				'image_url'  => $imgUrl,
			];
		}

		// Cover info (you can customize from DB/user)
		$res = [
			'status' => true,
			'master' => [
				'cover_subtitle' => $master['itineraries_name'], // or destination name
				'prepared_for'   => '-', // set from lead/customer if you have
				'travel_dates'   => '-', // set if you have
				'duration_text'  => $master['itineraries_duration_nights'] . ' Nights',
				'company_name'   => 'Royale india Premium Tours',
				'company_email'  => 'contact@royaleindia.in',
				'company_phone'  => '+917907648636',
				'itineraries_first_cover_page' => $master['itineraries_first_cover_page'],
        		'itineraries_last_cover_page' => $master['itineraries_last_cover_page'],
			],
			'days' => $outDays
		];

		echo json_encode($res);
	}

	public function fetch_itineraries_days()
	{
		$itineraries_id = $this->input->post('itineraries_id');

		$rows = $this->db
			->where('itineraries_id_fk', $itineraries_id)
			->where('itineraries_days_status', 1)
			->order_by('itineraries_days_id', 'ASC')
			->get('itineraries_days')
			->result();

		echo json_encode($rows);
	}

    public function Destination_details()
	{
		$result = $this->Itinerary_model->get_destination();

		$this->output
			->set_content_type('application/json', 'utf-8')
			->set_output(json_encode($result, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES));
	}

	// private function _upload_day_image($field, $index)
	// {
	// 	if (!isset($_FILES[$field]['name'][$index]) || $_FILES[$field]['name'][$index] == '') {
	// 		return '';
	// 	}

	// 	$path = FCPATH . 'uploads/itinerary_days/';
	// 	if (!is_dir($path)) { @mkdir($path, 0777, true); }

	// 	// remap single file for CI upload
	// 	$_FILES['single_day_image']['name']     = $_FILES[$field]['name'][$index];
	// 	$_FILES['single_day_image']['type']     = $_FILES[$field]['type'][$index];
	// 	$_FILES['single_day_image']['tmp_name'] = $_FILES[$field]['tmp_name'][$index];
	// 	$_FILES['single_day_image']['error']    = $_FILES[$field]['error'][$index];
	// 	$_FILES['single_day_image']['size']     = $_FILES[$field]['size'][$index];

	// 	$config = array();
	// 	$config['upload_path']   = $path;
	// 	$config['allowed_types'] = 'jpg|jpeg|png|gif|webp';
	// 	$config['max_size']      = 2048; // 2MB
	// 	$config['encrypt_name']  = true;

	// 	$this->load->library('upload');
	// 	$this->upload->initialize($config);

	// 	if (!$this->upload->do_upload('single_day_image')) {
	// 		// you can also return error message if you want
	// 		return '';
	// 	}

	// 	$up = $this->upload->data();
	// 	return $up['file_name'];
	// }

	private function resize_day_image_1088x510($filePath)
{
    if (!file_exists($filePath)) return false;

    $this->load->library('image_lib');

    $config = array();
    $config['image_library']  = 'gd2';
    $config['source_image']   = $filePath;
    $config['maintain_ratio'] = FALSE;
    $config['width']          = 1088;
    $config['height']         = 510;
    $config['quality']        = '90%';

    $this->image_lib->clear();
    $this->image_lib->initialize($config);

    if (!$this->image_lib->resize()) {
        log_message('error', $this->image_lib->display_errors('', ''));
        $this->image_lib->clear();
        return false;
    }

    $this->image_lib->clear();
    return true;
}

	private function _upload_day_image($fieldName, $index)
	{
		if (!isset($_FILES[$fieldName]['name'][$index])) return '';

		$name = $_FILES[$fieldName]['name'][$index];
		if ($name == '') return '';

		$upload_path = FCPATH . 'uploads/itinerary_days/';
		if (!is_dir($upload_path)) {
			@mkdir($upload_path, 0777, true);
		}

		// Rebuild one file entry for CI upload
		$_FILES['single_day_image']['name']     = $_FILES[$fieldName]['name'][$index];
		$_FILES['single_day_image']['type']     = $_FILES[$fieldName]['type'][$index];
		$_FILES['single_day_image']['tmp_name'] = $_FILES[$fieldName]['tmp_name'][$index];
		$_FILES['single_day_image']['error']    = $_FILES[$fieldName]['error'][$index];
		$_FILES['single_day_image']['size']     = $_FILES[$fieldName]['size'][$index];

		$config = array();
		$config['upload_path']   = $upload_path;
		$config['allowed_types'] = '*';  // TEMP allow all for test
		$config['encrypt_name']  = true;
		$config['detect_mime']   = FALSE;

// 		echo '<pre>';
// print_r($_FILES['single_day_image']);
// exit;

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload('single_day_image')) {
			// return error string so you can debug easily
			return '__ERROR__:' . $this->upload->display_errors('', '');
		}

		$up = $this->upload->data();
		return $up['file_name'];

// 		$up = $this->upload->data();

// $this->resize_day_image_1088x510($up['full_path']);

// return $up['file_name'];
	}

	
private function clone_existing_file($folderPath, $oldFileName)
{
    if ($oldFileName == '') return '';

    $source = FCPATH . trim($folderPath, '/').'/'.$oldFileName;

    if (!file_exists($source)) return '';

    $ext = pathinfo($oldFileName, PATHINFO_EXTENSION);
    $newName = md5(uniqid(mt_rand(), true)) . '.' . strtolower($ext);
    $dest = FCPATH . trim($folderPath, '/').'/'.$newName;

    if (@copy($source, $dest)) {
        return $newName;
    }

    return '';
}

// private function clone_existing_file($folderPath, $oldFileName)
// {
//     if ($oldFileName == '') return '';

//     $folder = trim($folderPath, '/');
//     $source = FCPATH . $folder . '/' . $oldFileName;

//     if (!file_exists($source)) return '';

//     $ext = pathinfo($oldFileName, PATHINFO_EXTENSION);
//     $newName = md5(uniqid(mt_rand(), true)) . '.' . strtolower($ext);
//     $dest = FCPATH . $folder . '/' . $newName;

//     if (@copy($source, $dest)) {

//         // resize only itinerary day images
//         if ($folder == 'uploads/itinerary_days') {
//             $this->resize_day_image_1088x510($dest);
//         }

//         return $newName;
//     }

//     return '';
// }

private function _upload_single_file_from_array($fieldName, $index, $uploadPath, $allowed = '*')
{
    if (
        !isset($_FILES[$fieldName]['name'][$index]) ||
        $_FILES[$fieldName]['name'][$index] == ''
    ) {
        return '';
    }

    if (!is_dir($uploadPath)) {
        @mkdir($uploadPath, 0777, true);
    }

    $_FILES['__single_file']['name']     = $_FILES[$fieldName]['name'][$index];
    $_FILES['__single_file']['type']     = $_FILES[$fieldName]['type'][$index];
    $_FILES['__single_file']['tmp_name'] = $_FILES[$fieldName]['tmp_name'][$index];
    $_FILES['__single_file']['error']    = $_FILES[$fieldName]['error'][$index];
    $_FILES['__single_file']['size']     = $_FILES[$fieldName]['size'][$index];

    $config = array();
    $config['upload_path']      = $uploadPath;
    $config['allowed_types']    = $allowed;
    $config['encrypt_name']     = TRUE;
    $config['file_ext_tolower'] = TRUE;
    $config['detect_mime']      = FALSE;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload('__single_file')) {
        return '__ERROR__:' . strip_tags($this->upload->display_errors('', ''));
    }

    $up = $this->upload->data();
    return $up['file_name'];

// 	$up = $this->upload->data();

// $this->resize_day_image_1088x510($up['full_path']);

// return $up['file_name'];
}

private function _upload_single_normal_file($fieldName, $uploadPath, $allowed = '*')
{
    if (!isset($_FILES[$fieldName]['name']) || $_FILES[$fieldName]['name'] == '') {
        return '';
    }

    if (!is_dir($uploadPath)) {
        @mkdir($uploadPath, 0777, true);
    }

    $config = array();
    $config['upload_path']      = $uploadPath;
    $config['allowed_types']    = $allowed;
    $config['encrypt_name']     = TRUE;
    $config['file_ext_tolower'] = TRUE;
    $config['detect_mime']      = FALSE;

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload($fieldName)) {
        return '__ERROR__:' . strip_tags($this->upload->display_errors('', ''));
    }

    $up = $this->upload->data();
    return $up['file_name'];
}


  public function ajax_add()
{
    $this->_validate();

    if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }

    $date  = date('Y-m-d');
    $time  = date('h:i:sa');
    $date1 = date('Y-m-d h:i:s a', time());

    $itineraries_name = $this->input->post('itineraries_name');

    $currentuserid   = $this->session->userdata('user_id');
    $currentusername = $this->session->userdata('admin_name');

	$first_cover = '';
	$last_cover  = '';

	// new first cover uploaded?
	$first_upload = $this->_upload_single_normal_file('itineraries_first_cover_page', FCPATH.'uploads/itinerary_cover/');
	if (strpos($first_upload, '__ERROR__:') === 0) {
		echo json_encode(array('status'=>FALSE, 'message'=>$first_upload));
		return;
	}
	if ($first_upload != '') {
		$first_cover = $first_upload;
	} else {
		// duplicate old first cover as NEW file
		$first_cover = $this->clone_existing_file('uploads/itinerary_cover', $this->input->post('itineraries_first_cover_page_txt'));
	}

	$last_upload = $this->_upload_single_normal_file('itineraries_last_cover_page', FCPATH.'uploads/itinerary_cover/');
	if (strpos($last_upload, '__ERROR__:') === 0) {
		echo json_encode(array('status'=>FALSE, 'message'=>$last_upload));
		return;
	}
	if ($last_upload != '') {
		$last_cover = $last_upload;
	} else {
		// duplicate old last cover as NEW file
		$last_cover = $this->clone_existing_file('uploads/itinerary_cover', $this->input->post('itineraries_last_cover_page_txt'));
	}
    // 1) Insert itineraries
    $data = array(
        'itineraries_name'                => $this->input->post('itineraries_name'),
        'itineraries_category_id_fk'      => $this->input->post('itineraries_category_id_fk'),
        'itineraries_duration_nights'     => $this->input->post('itineraries_duration_nights'),
        'itineraries_description'         => $this->input->post('itineraries_description'),
		// 'itineraries_first_cover_page'    => $file1,
        // 'itineraries_last_cover_page'     => $file2,
		'itineraries_first_cover_page' => $first_cover,
		'itineraries_last_cover_page'  => $last_cover,
        'itineraries_createdby_user_id'   => $currentuserid,
        'itineraries_created_at'        => $date1,
        'itineraries_status'              => 1
    );

    $insert = $this->Itinerary_model->save($data);

    // 2) Insert itineraries_days
    $days_day   = (array)$this->input->post('itineraries_days_day');
    $days_dest  = (array)$this->input->post('itineraries_days_destination_id_fk');
    $days_title = (array)$this->input->post('itineraries_days_title');
    $days_desc  = (array)$this->input->post('itineraries_days_description');
    $days_tb    = (array)$this->input->post('itineraries_days_travel_back');

    if ($insert) {

		$days_image_existing = $this->input->post('itineraries_days_image_existing');

		foreach ($days_day as $k => $dayNo) {

			$destVal  = isset($days_dest[$k]) ? $days_dest[$k] : '';
			$titleVal = isset($days_title[$k]) ? $days_title[$k] : '';
			$descVal  = isset($days_desc[$k]) ? $days_desc[$k] : '';
			$tbVal    = isset($days_tb[$k]) ? $days_tb[$k] : '';

			$imgName = '';

			// if new image selected, upload it
			$imgUpload = $this->_upload_single_file_from_array(
				'itineraries_days_image',
				$k,
				FCPATH.'uploads/itinerary_days/'
			);

			if (strpos($imgUpload, '__ERROR__:') === 0) {
				echo json_encode(array('status'=>FALSE, 'message'=>$imgUpload));
				return;
			}

			if ($imgUpload != '') {
				$imgName = $imgUpload;
			} else {
				// duplicate old image as NEW file
				$oldImg = isset($days_image_existing[$k]) ? $days_image_existing[$k] : '';
				$imgName = $this->clone_existing_file('uploads/itinerary_days', $oldImg);
			}

			$data_itineraries_day = array(
				'itineraries_id_fk'                  => $insert,
				'itineraries_days_day'               => 'Day ' . $dayNo,
				'itineraries_days_destination_id_fk' => $destVal,
				'itineraries_days_title'             => $titleVal,
				'itineraries_days_description'       => $descVal,
				'itineraries_days_travel_back'       => $tbVal,
				'itineraries_days_image'             => $imgName,
				'itineraries_days_status'            => 1
			);
// print_r($data_itineraries_day);die;
			$this->db->insert('itineraries_days', $data_itineraries_day);
		}
        // activity
        // $ip = $this->input->ip_address();
        // $activity_data = array(
        //     'activity_description' => 'Added itinerary: ' . $itineraries_name,
        //     'id_fk'                => $insert,
        //     'activity_type'        => 'Itinerary_registration',
        //     'activity_ip'          => $ip,
        //     'activity_action'      => 'Add',
        //     'activity_date_time'   => $date1,
        //     'activity_date'        => $date,
        //     'activity_status'      => 1
        // );
        // $this->db->insert('activity', $activity_data);

        echo json_encode(array("status"=>TRUE));
        return;
    }

    echo json_encode(array("status"=>FALSE));
}

	public function ajax_edit($id)
	{
		$data = $this->Itinerary_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

// 	public function ajax_update()
// {
//     $this->_validate();

//     $itineraries_id = (int)$this->input->post('id');

//     // update master
//     $data = array(
//         'itineraries_name'            => $this->input->post('itineraries_name'),
//         'itineraries_category_id_fk'  => $this->input->post('itineraries_category_id_fk'),
//         'itineraries_duration_nights' => $this->input->post('itineraries_duration_nights'),
//         'itineraries_description'     => $this->input->post('itineraries_description')
//     );
//     $this->db->where('itineraries_id', $itineraries_id)->update('itineraries', $data);

//     // soft disable removed
//     $removed = trim($this->input->post('removed_itineraries_days_ids'));
//     if ($removed !== '') {
//         $ids = array();
//         foreach (explode(',', $removed) as $x) {
//             $x = trim($x);
//             if ($x !== '' && ctype_digit($x)) $ids[] = (int)$x;
//         }
//         if (count($ids) > 0) {
//             $this->db->where_in('itineraries_days_id', $ids)
//                      ->update('itineraries_days', array('itineraries_days_status' => 0));
//         }
//     }

//     // upsert days
//     $days_id     = $this->input->post('itineraries_days_id');
//     $days_day    = $this->input->post('itineraries_days_day');
//     $days_dest   = $this->input->post('itineraries_days_destination_id_fk');
//     $days_title  = $this->input->post('itineraries_days_title');
//     $days_desc   = $this->input->post('itineraries_days_description');
//     $days_tb     = $this->input->post('itineraries_days_travel_back');
//     $days_img_ex = $this->input->post('itineraries_days_image_existing');

//     if (is_array($days_day)) {

//         foreach ($days_day as $k => $dayNo) {

//             $idVal   = isset($days_id[$k]) ? trim($days_id[$k]) : '';
//             $destVal = isset($days_dest[$k]) ? $days_dest[$k] : '';
//             $titVal  = isset($days_title[$k]) ? $days_title[$k] : '';
//             $desVal  = isset($days_desc[$k]) ? $days_desc[$k] : '';
//             $tbVal   = isset($days_tb[$k]) ? $days_tb[$k] : '';
//             $oldImg  = isset($days_img_ex[$k]) ? $days_img_ex[$k] : '';

//             // new upload? if yes, override
//             $newImg = $this->_upload_day_image('itineraries_days_image', $k);
//             $finalImg = ($newImg !== '') ? $newImg : $oldImg;

//             $rowData = array(
//                 'itineraries_id_fk'                  => $itineraries_id,
//                 'itineraries_days_day'               => 'Day ' . $dayNo,
//                 'itineraries_days_destination_id_fk' => $destVal,
//                 'itineraries_days_title'             => $titVal,
//                 'itineraries_days_description'       => $desVal,
//                 'itineraries_days_travel_back'       => $tbVal,
//                 'itineraries_days_image'             => $finalImg,
//                 'itineraries_days_status'            => 1
//             );

//             if ($idVal !== '' && ctype_digit($idVal)) {
//                 $this->db->where('itineraries_days_id', (int)$idVal)->update('itineraries_days', $rowData);
//             } else {
//                 $this->db->insert('itineraries_days', $rowData);
//             }
//         }
//     }

//     echo json_encode(array("status" => TRUE));
// }

public function ajax_update()
{
    $this->_validate();

    if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }

    $itineraries_id = (int)$this->input->post('id');

	$photo1 = $this->input->post('itineraries_first_cover_page');
	if(empty($photo1))
	{
		$config1 = array(

		'upload_path' => "./uploads/itinerary_cover",
		'allowed_types' => "gif|jpg|png|jpeg|pdf|wav",
		'overwrite' => FALSE,
		'max_size' => "131072", // Can be set to particular file size , here it is 2 MB(2048 Kb)
		// 'max_height' => "768",
		// 'max_width' => "1024"
		);

		$file1 = '';
		$this->load->library('upload',$config1);			
		if($this->upload->do_upload('itineraries_first_cover_page'))
		{	

				$template = array('upload_data1' => $this->upload->data());
				$upload_data1 = $this->upload->data();
				//print_r($upload_data); die;
				$file1 =$upload_data1['file_name'];

		}

		if(empty($file1))
		{
				$file1 = $this->input->post('itineraries_first_cover_page_txt');

		}
	
	
	}

	$photo2 = $this->input->post('itineraries_last_cover_page');
	if(empty($photo2))
	{
		$config2 = array(

		'upload_path' => "./uploads/itinerary_cover",
		'allowed_types' => "gif|jpg|png|jpeg|pdf|wav",
		'overwrite' => FALSE,
		'max_size' => "131072", // Can be set to particular file size , here it is 2 MB(2048 Kb)
		// 'max_height' => "768",
		// 'max_width' => "1024"
		);

		$file2 = '';
		$this->load->library('upload',$config2);			
		if($this->upload->do_upload('itineraries_last_cover_page'))
		{	

				$template = array('upload_data2' => $this->upload->data());
				$upload_data2 = $this->upload->data();
				//print_r($upload_data); die;
				$file2 =$upload_data2['file_name'];

		}

		if(empty($file2))
		{
				$file2 = $this->input->post('itineraries_last_cover_page_txt');

		}
	
	
	}

	if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }

    $date  = date('Y-m-d');
    $time  = date('h:i:sa');
    $date1 = date('Y-m-d h:i:s a', time());

    // 1) update master
    $data = array(
        'itineraries_name'            => $this->input->post('itineraries_name'),
        'itineraries_category_id_fk'  => $this->input->post('itineraries_category_id_fk'),
        'itineraries_duration_nights' => $this->input->post('itineraries_duration_nights'),
		'itineraries_first_cover_page'    => $file1,
        'itineraries_last_cover_page'     => $file2,
        'itineraries_description'     => $this->input->post('itineraries_description'),
		'itineraries_updatedby_user_id'   => $currentuserid,
        'itineraries_updated_at'        => $date1,
    );

    $this->db->where('itineraries_id', $itineraries_id)->update('itineraries', $data);

    // 2) soft disable removed ids
    $removed = trim($this->input->post('removed_itineraries_days_ids'));
    if ($removed !== '') {
        $ids = array();
        foreach (explode(',', $removed) as $x) {
            $x = trim($x);
            if ($x !== '' && ctype_digit($x)) $ids[] = (int)$x;
        }
        if (!empty($ids)) {
            $this->db->where_in('itineraries_days_id', $ids)
                     ->set('itineraries_days_status', 0)
                     ->update('itineraries_days');
        }
    }

    // 3) upsert days
    $days_id        = (array)$this->input->post('itineraries_days_id');
    $days_day       = (array)$this->input->post('itineraries_days_day');
    $days_dest      = (array)$this->input->post('itineraries_days_destination_id_fk');
    $days_title     = (array)$this->input->post('itineraries_days_title');
    $days_desc      = (array)$this->input->post('itineraries_days_description');
    $days_tb        = (array)$this->input->post('itineraries_days_travel_back');
    $img_existing   = (array)$this->input->post('itineraries_days_image_existing');

    foreach ($days_day as $k => $dayNo) {

        $idVal   = isset($days_id[$k]) ? trim($days_id[$k]) : '';
        $destVal = isset($days_dest[$k]) ? $days_dest[$k] : '';
        $titVal  = isset($days_title[$k]) ? $days_title[$k] : '';
        $desVal  = isset($days_desc[$k]) ? $days_desc[$k] : '';
        $tbVal   = isset($days_tb[$k]) ? $days_tb[$k] : '';

        // ✅ upload new if selected, else keep existing
        $imgNew = $this->_upload_day_image('itineraries_days_image', $k);
        if (strpos($imgNew, '__ERROR__:') === 0) {
            echo json_encode(array("status"=>FALSE, "message"=>$imgNew));
            return;
        }

        $finalImg = $imgNew !== '' ? $imgNew : (isset($img_existing[$k]) ? $img_existing[$k] : '');

        $rowData = array(
            'itineraries_id_fk'                  => $itineraries_id,
            'itineraries_days_day'               => 'Day ' . $dayNo,
            'itineraries_days_destination_id_fk' => $destVal,
            'itineraries_days_title'             => $titVal,
            'itineraries_days_description'       => $desVal,
            'itineraries_days_travel_back'       => $tbVal,
            'itineraries_days_image'             => $finalImg,
            'itineraries_days_status'            => 1
        );

        if ($idVal !== '' && ctype_digit($idVal)) {
            $this->db->where('itineraries_days_id', (int)$idVal)->update('itineraries_days', $rowData);
        } else {
            $this->db->insert('itineraries_days', $rowData);
        }
    }

    echo json_encode(array("status"=>TRUE));
}

	public function ajax_upmmdate()
	{
		$this->_validate(); // keep your validations + add day validation too

		if (function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}

		$date  = date('Y-m-d');
		$time  = date('h:i:sa');

		$itineraries_id = $this->input->post('id'); // your hidden id field

		// 1) Update itineraries master
		$data = array(
			'itineraries_name'            => $this->input->post('itineraries_name'),
			'itineraries_category_id_fk'  => $this->input->post('itineraries_category_id_fk'),
			'itineraries_duration_nights' => $this->input->post('itineraries_duration_nights'),
			'itineraries_description'     => $this->input->post('itineraries_description')
		);

		$this->db->where('itineraries_id', $itineraries_id);
		$this->db->update('itineraries', $data);

		// 2) Soft-disable removed days (DO NOT DELETE)
		// $removed = trim($this->input->post('removed_itineraries_days_ids'));
		// if ($removed != '') {
		// 	$ids = array();
		// 	foreach (explode(',', $removed) as $x) {
		// 		$x = trim($x);
		// 		if ($x !== '' && ctype_digit($x)) $ids[] = (int)$x;
		// 	}
		// 	if (count($ids) > 0) {
		// 		$this->db->where_in('itineraries_days_id', $ids);
		// 		$this->db->set('itineraries_days_status', 0);
		// 		$this->db->update('itineraries_days');
		// 	}
		// }

		// ===============================
		// Soft-disable removed day rows
		// ===============================
		$removed = trim($this->input->post('removed_itineraries_days_ids'));

		if ($removed != '') {

			$ids = array();

			foreach (explode(',', $removed) as $x) {
				$x = trim($x);
				if ($x !== '' && ctype_digit($x)) {
					$ids[] = (int)$x;
				}
			}

			if (count($ids) > 0) {

				$this->db->where_in('itineraries_days_id', $ids);
				$this->db->set('itineraries_days_status', 0);
				$this->db->update('itineraries_days');

			}
		}

		// 3) Upsert day rows: update if itineraries_days_id exists, else insert
		$days_id         = $this->input->post('itineraries_days_id'); // array
		$days_day        = $this->input->post('itineraries_days_day'); // array (numeric day)
		$days_dest       = $this->input->post('itineraries_days_destination_id_fk'); // array
		$days_title      = $this->input->post('itineraries_days_title'); // array
		$days_desc       = $this->input->post('itineraries_days_description'); // array
		$days_tb         = $this->input->post('itineraries_days_travel_back'); // array

		if (is_array($days_day)) {

			foreach ($days_day as $k => $dayNo) {

				$idVal   = (isset($days_id[$k]) ? trim($days_id[$k]) : '');
				$destVal = (isset($days_dest[$k]) ? $days_dest[$k] : '');
				$titVal  = (isset($days_title[$k]) ? $days_title[$k] : '');
				$desVal  = (isset($days_desc[$k]) ? $days_desc[$k] : '');
				$tbVal   = (isset($days_tb[$k]) ? $days_tb[$k] : '');

				$rowData = array(
					'itineraries_id_fk'                  => $itineraries_id,
					'itineraries_days_day'               => 'Day ' . $dayNo, // store "Day 1"
					'itineraries_days_destination_id_fk' => $destVal,
					'itineraries_days_title'             => $titVal,
					'itineraries_days_description'       => $desVal,
					'itineraries_days_travel_back'       => $tbVal,
					'itineraries_days_status'            => 1
				);

				// Update existing
				if ($idVal !== '' && ctype_digit($idVal)) {
					$this->db->where('itineraries_days_id', (int)$idVal);
					$this->db->update('itineraries_days', $rowData);
				}
				// Insert new
				else {
					$this->db->insert('itineraries_days', $rowData);
				}
			}
		}

		echo json_encode(array("status" => TRUE));
	}


	

	public function delete()
	{
		$currentuserid = $this->session->userdata('user_id');
		$currentusertype = $this->session->userdata('user_type');
		$currentusername = $this->session->userdata('admin_name');

		$this->load->helper('date');
		if(function_exists('date_default_timezone_set')) {
			date_default_timezone_set("Asia/Kolkata");
		}
		$date = date('Y-m-d');
		$time = date('h:i:sa');
		
		$date1 = date('Y-m-d h:i:s a', time());

		$updateData = array('itineraries_status' => 0);
		
		$this->Itinerary_model->update(array('itineraries_id' => $this->input->post('id')), $updateData);

		$updateitineraryData = array('itineraries_days_status' => 0);
		$this->db->where('itineraries_id_fk', $this->input->post('id'))->update('itineraries_days', $updateitineraryData);

		// $itineraries_name = $this->input->post('itineraries_name');
		// $ip = $this->input->ip_address();
		
		// $activity_data = array(
		// 		'activity_description' => 'Deleted itinerary: '.$itineraries_name.'',
		// 		'id_fk' => $this->input->post('id'),
		// 		'activity_type' => 'Itinerary_registration',
		// 		// 'activity_order_number' => $invoice_order_number1,
		// 		'activity_ip' => $ip,
		// 		'activity_action' => 'Delete',
		// 		'activity_by_userid' => $currentuserid,
		// 		'activity_by_username' => $currentusername,
		// 		'activity_date_time	' => $date1,
		// 		'activity_date' => $date,
		// 		'activity_status' => 1,
		// 	);
		
		// $this->General_model->add($this->activity,$activity_data);
		echo json_encode(array("status" => TRUE));
	}


	private function _validate()
	{
		$data = array();
		$data['error_string'] = array();
		$data['inputerror'] = array();
		$data['status'] = TRUE;

		if ($this->input->post('itineraries_name') == '') {
			$data['inputerror'][] = 'itineraries_name';
			$data['error_string'][] = 'Itineraries name is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('itineraries_duration_nights') === '' || $this->input->post('itineraries_duration_nights') === NULL) {
			$data['inputerror'][] = 'itineraries_duration_nights';
			$data['error_string'][] = 'Duration nights is required';
			$data['status'] = FALSE;
		}

		if ($this->input->post('itineraries_category_id_fk') == '') {
			$data['inputerror'][] = 'itineraries_category_id_fk';
			$data['error_string'][] = 'Itineraries category is required';
			$data['status'] = FALSE;
		}

		// if ($this->input->post('itineraries_description') == '') {
		// 	$data['inputerror'][] = 'itineraries_description';
		// 	$data['error_string'][] = 'Itineraries description is required';
		// 	$data['status'] = FALSE;
		// }

		// Validate dynamic day arrays (safe validation)
		$days_day  = $this->input->post('itineraries_days_day');
		$days_dest = $this->input->post('itineraries_days_destination_id_fk');
		$days_title= $this->input->post('itineraries_days_title');
		$days_desc = $this->input->post('itineraries_days_description');

		if (!is_array($days_day) || count($days_day) == 0) {
			$data['inputerror'][] = 'itineraries_days_day';
			$data['error_string'][] = 'Days are required';
			$data['status'] = FALSE;
		} else {
			foreach ($days_day as $k => $d) {

				$destVal  = isset($days_dest[$k]) ? $days_dest[$k] : '';
				$titleVal = isset($days_title[$k]) ? trim($days_title[$k]) : '';
				$descVal  = isset($days_desc[$k]) ? trim($days_desc[$k]) : '';

				if ($destVal == '') {
					$data['inputerror'][] = 'itineraries_days_destination_id_fk[]';
					$data['error_string'][] = 'Destination is required for all days';
					$data['status'] = FALSE;
					break;
				}

				if ($titleVal == '') {
					$data['inputerror'][] = 'itineraries_days_title[]';
					$data['error_string'][] = 'Title is required for all days';
					$data['status'] = FALSE;
					break;
				}

				if ($descVal == '') {
					$data['inputerror'][] = 'itineraries_days_description[]';
					$data['error_string'][] = 'Description is required for all days';
					$data['status'] = FALSE;
					break;
				}
			}
		}

		if ($data['status'] === FALSE) {
			echo json_encode($data);
			exit();
		}
	}

	
}
?>