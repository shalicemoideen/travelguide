<?php 
defined('BASEPATH') OR exit('No direct script access allowed');
class Packages extends MY_Controller {
	public $table = 'packages';
	public $packages_itinerary = 'packages_itinerary';
	public $packages_itinerary_days = 'packages_itinerary_days';
	public $packages_inclusions = 'packages_inclusions';
	public $packages_exclusions = 'packages_exclusions';
	public $packages_optional_add_on = 'packages_optional_add_on';
	public $packages_special_requirements = 'packages_special_requirements';
	public $packages_payment_policies = 'packages_payment_policies';
	public $packages_terms_condition = 'packages_terms_condition';
	public $packages_cancellation_policies = 'packages_cancellation_policies';
	public $packages_notes  = 'packages_notes';
	public $packages_properties = 'packages_properties';
	public $packages_properties_common = 'packages_properties_common';
	public $packages_properties_days = 'packages_properties_days';
	public $packages_properties_rooms = 'packages_properties_rooms';
	public $activity = 'activity';
	public $page  = 'Packages';
	public function __construct() {
		parent::__construct();
		if(! $this->is_logged_in()){
          redirect('/login');
        }
        
        $this->currentuserid = $this->session->userdata('user_id');
        $this->currentusertype = $this->session->userdata('user_type');
		
		
        $this->load->model('General_model');
        $this->load->model('Packages_model');
        
	}
	
	
	public function index()
	{
		//$name = 'PERSONAL CASH';
		$template['staff'] = $this->Packages_model->fetch_staff_details();
		$template['users'] = $this->Packages_model->fetch_all_users();
		$template['package'] = $this->Packages_model->fetch_package();
		$template['pcategory'] = $this->Packages_model->fetch_package_category();
		$template['itcategory'] = $this->Packages_model->fetch_itinerary_category();
		$template['itinerary'] = $this->Packages_model->fetch_itinerary_filter();
		$template['inclusions_exclusion'] = $this->Packages_model->fetch_inclusions_exclusion();
		$template['payment_policies'] = $this->Packages_model->fetch_payment_policies();
		$template['terms_condition'] = $this->Packages_model->fetch_terms_condition();
		$template['cancellation_policies'] = $this->Packages_model->fetch_cancellation_policies();
		
		$template['body'] = 'Packages/list';
		$template['script'] = 'Packages/script';
		$this->load->view('template', $template);
	}
	
	function fetch_itinerary_under_category()
	{
	  if($this->input->post('packages_itinerary_category_id_fk'))
	  {
	   
	   $sel=$this->input->post('itinerary_id');
	   //echo $sel;
	   echo $this->Packages_model->fetch_itinerary_under_category($this->input->post('packages_itinerary_category_id_fk'), $this->input->post('packages_duration_in_nights'), $sel);
	  }
	}

	public function itinerary_array_list($itineraries_id)
	{
		$data = $this->Packages_model->itinerary_array_list($itineraries_id);
		echo json_encode($data);
	}

	public function gettdestination_details()
	{
		$data = $this->Packages_model->gettdestination_details();
		echo json_encode($data);
	}

	public function fetch_itinerary()
	{
		// $duration     = $this->input->post('itineraries_duration_nights');
		// $stayDestinationId  = $this->input->post('itineraries_days_destination_id_fk');

		// $data = $this->Packages_model->fetch_itinerary($duration, $stayDestinationId);
		$data = $this->Packages_model->fetch_itinerary();
		echo json_encode($data);
	}

	public function get_itinerary_cover_pages()
	{
		$id = $this->input->post('itinerary_id');

		$row = $this->db->select('
				itineraries_first_cover_page,
				itineraries_last_cover_page
			')
			->from('itineraries')
			->where('itineraries_id', $id)
			->get()
			->row_array();

		echo json_encode($row);
	}

	public function ajax_fetch_itinerary_under_category()
	{
		$category_id = $this->input->post('itineraries_category_id');
		$nights      = $this->input->post('itineraries_duration_nights');

		$category_id = (int)$category_id;
		$nights      = (int)$nights;

		// Default empty dropdown
		if ($category_id <= 0 || $nights <= 0) {
			echo '<option value="">Please Select itinerary</option>';
			exit;
		}

		// Your existing function (returns <option> list)
		echo $this->Packages_model->fetch_itinerary_under_category($category_id, $nights);
		exit;
	}


	public function fetch_days_under_itinerary()
	{
		$itineraryId = $this->input->post('itineraries_id_fk');

		if (!$itineraryId) {
			echo json_encode([]);
			return;
		}

		$days = $this->Packages_model->fetch_days_under_itinerary($itineraryId);

		echo json_encode($days);
	}


	public function get_itinerary_day_details()
	{
		$day_id = $this->input->post('itineraries_days_id');
		$data = $this->Packages_model->get_itinerary_day_details($day_id);
		echo json_encode($data);
	}

	public function inclusion_array_list(){
    	
      $inclusion_exclusion_common_id = $this->input->post('inclusion_exclusion_common_id');

      
      echo json_encode($this->Packages_model->inclusion_array_list($inclusion_exclusion_common_id));
    }

	public function exclusion_array_list(){
    	
      $inclusion_exclusion_common_id = $this->input->post('inclusion_exclusion_common_id');

      
      echo json_encode($this->Packages_model->exclusion_array_list($inclusion_exclusion_common_id));
    }

	public function get_inclusion_exclusion_details()
	{
		$common_id = $this->input->post('common_id');

		$inclusions = $this->Packages_model->inclusion_array_list($common_id);
		$exclusions = $this->Packages_model->exclusion_array_list($common_id);

		echo json_encode([
			'inclusions' => $inclusions,
			'exclusions' => $exclusions
		]);
	}


	public function get_special_requirements()
	{
		// returns list for dropdown
		$data = $this->Packages_model->gettspecialrequirment_details();

		$result = [];
		if ($data) {
			foreach ($data as $id => $name) {
				$result[] = [
					'id' => $id,
					'text' => $name
				];
			}
		}

		echo json_encode($result);
	}

	public function get_special_requirement_amount()
	{
		$id = $this->input->post('special_requirements_id');

		if (!$id) {
			echo json_encode(['amount' => '']);
			return;
		}

		$row = $this->Packages_model->getSpecialrequirmentamount($id);

		echo json_encode([
			'amount' => $row ? $row->amount : ''
		]);
	}

	// public function payment_policies_array_list(){
    	
    //   $payment_policies_id = $this->input->post('payment_policies_id');

      
    //   echo json_encode($this->Packages_model->payment_policies_array_list($payment_policies_id));
    // }

	public function get_payment_policies_items()
	{
		$id = $this->input->post('payment_policies_id');

		if (!$id) {
			echo json_encode([]);
			return;
		}

		$data = $this->Packages_model->payment_policies_array_list($id);

		$result = [];
		foreach ($data as $row) {
			$result[] = [
				'description' => $row->payment_policies_items_name
			];
		}

		echo json_encode($result);
	}

	// public function terms_condition_array_list(){
    	
    //   $terms_condition_id = $this->input->post('terms_condition_id');

      
    //   echo json_encode($this->Packages_model->terms_condition_array_list($terms_condition_id));
    // }

	public function get_terms_conditions_items()
	{
		$id = $this->input->post('terms_condition_id');

		if (!$id) {
			echo json_encode([]);
			return;
		}

		// ✅ You must create this model function like payment_policies_array_list()
		$data = $this->Packages_model->terms_condition_array_list($id);

		$result = [];
		foreach ($data as $row) {
			$result[] = [
				'description' => $row->terms_condition_items_name
			];
		}

		echo json_encode($result);
	}

	// public function cancellation_policies_array_list(){
    	
    //   $cancellation_policies_id = $this->input->post('cancellation_policies_id');

      
    //   echo json_encode($this->Packages_model->cancellation_policies_array_list($cancellation_policies_id));
    // }

	public function get_cancellation_policy_items()
	{
		$id = $this->input->post('cancellation_policies_id');

		if (!$id) {
			echo json_encode([]);
			return;
		}

		// Create this model function like payment_policies_array_list()
		$data = $this->Packages_model->cancellation_policies_array_list($id);

		$result = [];
		foreach ($data as $row) {
			$result[] = [
				'description' => $row->cancellation_policies_item_name
			];
		}

		echo json_encode($result);
	}

	public function get_properties_by_destination()
	{
		$dest_id = $this->input->post('destination_id');
		if (!$dest_id) { echo json_encode([]); return; }

		$rows = $this->Packages_model->gettproperties_details($dest_id);
		echo json_encode($rows);
	}

	public function get_rooms_by_property()
	{
		$property_id = $this->input->post('property_id');
		if (!$property_id) { echo json_encode([]); return; }

		$rows = $this->Packages_model->fetch_rooms_under_property($property_id);
		echo json_encode($rows);
	}


	public function package_preview(){

		$template['body'] = 'Packages/preview';
		$template['script'] = 'Packages/script';
		$this->load->view('template', $template);
		// $this->load->view('Packages/preview');
	}

	public function new_preview(){

		// $template['body'] = 'Packages/new_preview';
		// $template['script'] = 'Packages/script';
		// $this->load->view('template', $template);
		$this->load->view('Packages/new_preview');
	}

	// public function preview_direct($package_id)
	// {
	// 	if (!$package_id) {
	// 		show_404();
	// 	}

	// 	$this->load->model('Packages_model');

	// 	$data['package']        = $this->Packages_model->get_package($package_id);
	// 	$data['itinerary']      = $this->Packages_model->get_itinerary_days($package_id);
	// 	$data['inclusions']     = $this->Packages_model->get_inclusions($package_id);
	// 	$data['exclusions']     = $this->Packages_model->get_exclusions($package_id);
	// 	$data['optional_addons']= $this->Packages_model->get_optional_addons($package_id);
	// 	$data['special_req']    = $this->Packages_model->get_special_requirements($package_id);
	// 	$data['payment']        = $this->Packages_model->get_payment_policies($package_id);
	// 	$data['terms']          = $this->Packages_model->get_terms($package_id);
	// 	$data['cancel']         = $this->Packages_model->get_cancellation($package_id);
	// 	$data['notes']          = $this->Packages_model->get_notes($package_id);
	// 	$data['properties'] 	= $this->Packages_model->get_properties_grouped($package_id);

	// 	$this->load->view('Packages/preview_direct', $data);
	// }

	public function preview_direct($package_id)
{
    if (!$package_id) {
        show_404();
    }

    $this->load->model('Packages_model');

    $package = $this->Packages_model->get_package($package_id);

    if (!$package) {
        show_404();
    }

    $data = array();

    $data['status']           = true;
    $data['package']          = $package;
    $data['master']           = $package; // if your preview page uses master object
    $data['days']             = $this->Packages_model->get_itinerary_days($package_id);
    $data['itinerary']        = $data['days']; // if your old code still uses $itinerary

    $data['inclusions']       = $this->Packages_model->get_inclusions($package_id);
    $data['exclusions']       = $this->Packages_model->get_exclusions($package_id);
    $data['optional_addons']  = $this->Packages_model->get_optional_addons($package_id);
    $data['special_req']      = $this->Packages_model->get_special_requirements($package_id);
    $data['payment']          = $this->Packages_model->get_payment_policies($package_id);
    $data['terms']            = $this->Packages_model->get_terms($package_id);
    $data['cancel']           = $this->Packages_model->get_cancellation($package_id);
    $data['notes']            = $this->Packages_model->get_notes($package_id);
    $data['properties']       = $this->Packages_model->get_properties_grouped($package_id);

    $this->load->view('Packages/preview_direct', $data);
}
	public function preview_direct_json($package_id)
{
    if (!$package_id) {
        echo json_encode(array(
            'status'  => false,
            'message' => 'Invalid package id'
        ));
        return;
    }

    $this->load->model('Packages_model');

    $master = $this->Packages_model->get_package($package_id);

    if (!$master) {
        echo json_encode(array(
            'status'  => false,
            'message' => 'Package not found'
        ));
        return;
    }

    $days            = $this->Packages_model->get_itinerary_days($package_id);
    $inclusions      = $this->Packages_model->get_inclusions($package_id);
    $exclusions      = $this->Packages_model->get_exclusions($package_id);
    $optional_addons = $this->Packages_model->get_optional_addons($package_id);
    $payment         = $this->Packages_model->get_payment_policies($package_id);
    $terms           = $this->Packages_model->get_terms($package_id);
    $cancel          = $this->Packages_model->get_cancellation($package_id);
    $notes           = $this->Packages_model->get_notes($package_id);

    echo json_encode(array(
        'status'          => true,
        'master'          => $master,
        'days'            => $days,
        'inclusions'      => $inclusions,
        'exclusions'      => $exclusions,
        'optional_addons' => $optional_addons,
        'payment'         => $payment,
        'terms'           => $terms,
        'cancel'          => $cancel,
        'notes'           => $notes
    ));
}


	public function get(){
		$this->load->model('Packages_model');
    	$param['draw'] = (isset($_REQUEST['draw']))?$_REQUEST['draw']:'';
        $param['length'] =(isset($_REQUEST['length']))?$_REQUEST['length']:'10'; 
        $param['start'] = (isset($_REQUEST['start']))?$_REQUEST['start']:'0';
        $param['order'] = (isset($_REQUEST['order'][0]['column']))?$_REQUEST['order'][0]['column']:'';
        $param['dir'] = (isset($_REQUEST['order'][0]['dir']))?$_REQUEST['order'][0]['dir']:'';
        $param['searchValue'] =(isset($_REQUEST['search']['value']))?$_REQUEST['search']['value']:'';
        
		$param['packages_title_filter'] =(isset($_REQUEST['packages_title_filter']))?$_REQUEST['packages_title_filter']:'';
		$param['packages_category_id_filter'] =(isset($_REQUEST['packages_category_id_filter']))?$_REQUEST['packages_category_id_filter']:'';
		$param['packages_itinerary_category_id_filter'] =(isset($_REQUEST['packages_itinerary_category_id_filter']))?$_REQUEST['packages_itinerary_category_id_filter']:'';
		$param['packages_itinerary_id_filter'] =(isset($_REQUEST['packages_itinerary_id_filter']))?$_REQUEST['packages_itinerary_id_filter']:'';
		$param['packages_duration_in_nights_filter'] =(isset($_REQUEST['packages_duration_in_nights_filter']))?$_REQUEST['packages_duration_in_nights_filter']:'';
		$param['packages_createdby_user_id'] =(isset($_REQUEST['packages_createdby_user_id']))?$_REQUEST['packages_createdby_user_id']:'';
		
    	$data = $this->Packages_model->getPackageTable($param);
    	$json_data = json_encode($data);
    	echo $json_data;
    }


	private function upload_day_image($fieldName)
	{
		$config['upload_path']   = FCPATH . 'uploads/package_day_images/';
		$config['allowed_types'] = 'jpg|jpeg|png|webp';
		$config['max_size']      = 4096; // 4MB
		$config['encrypt_name']  = true;

		if (!is_dir($config['upload_path'])) {
			@mkdir($config['upload_path'], 0777, true);
		}

		$this->load->library('upload', $config);
		$this->upload->initialize($config);

		if (!$this->upload->do_upload($fieldName)) {
			return ['ok' => false, 'error' => $this->upload->display_errors('', '')];
		}

		$data = $this->upload->data();
		return ['ok' => true, 'file' => $data['file_name']];
	}

	private function copy_default_day_image_to_package($fileName)
	{
		$fileName = trim((string)$fileName);
		if ($fileName === '') return '';

		// ✅ if POST contains full url/path, keep only filename
		$fileName = basename($fileName);

		// ✅ IMPORTANT: set your real source folder here
		// If your images are in uploads/itinerary_days/ then use this:
		$src = FCPATH . 'uploads/itinerary_days/' . $fileName;

		$destDir = FCPATH . 'uploads/package_day_images/';
		if (!is_dir($destDir)) {
			@mkdir($destDir, 0777, true);
		}

		// ---- DEBUG LOGS ----
		log_message('error', 'COPY DEFAULT IMG: fileName=' . $fileName);
		log_message('error', 'COPY DEFAULT IMG: src=' . $src);
		log_message('error', 'COPY DEFAULT IMG: destDir=' . $destDir);

		if (!file_exists($src)) {
			log_message('error', 'COPY DEFAULT IMG FAILED: source not found: ' . $src);
			return '';
		}

		if (!is_writable($destDir)) {
			log_message('error', 'COPY DEFAULT IMG FAILED: destDir not writable: ' . $destDir);
			return '';
		}

		$ext = pathinfo($fileName, PATHINFO_EXTENSION);
		$newName = uniqid('pkgday_', true) . ($ext ? '.' . $ext : '');
		$dest = $destDir . $newName;

		if (@copy($src, $dest)) {
			log_message('error', 'COPY DEFAULT IMG OK: ' . $src . ' -> ' . $dest);
			return $newName;
		}

		log_message('error', 'COPY DEFAULT IMG FAILED: copy() false src=' . $src . ' dest=' . $dest);
		return '';
	}

	

private function upload_package_cover_image($field_name)
{
    $upload_path = FCPATH . 'uploads/packages_cover/';

    if (!is_dir($upload_path)) {
        @mkdir($upload_path, 0777, true);
    }

    $file_name = $_FILES[$field_name]['name'];
    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $allowed = array('jpg', 'jpeg', 'png', 'webp');

    if (!in_array($ext, $allowed)) {
        return array(
            'ok' => false,
            'message' => 'Only JPG, JPEG, PNG, WEBP allowed for cover page'
        );
    }

    $new_name = 'pkg_cover_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;

    $config = array();
    $config['upload_path']   = $upload_path;
    $config['allowed_types'] = 'jpg|jpeg|png|webp';
    $config['file_name']     = $new_name;
    $config['overwrite']     = false;
    $config['max_size']      = 5120; // 5MB

    $this->load->library('upload');
    $this->upload->initialize($config);

    if (!$this->upload->do_upload($field_name)) {
        return array(
            'ok' => false,
            'message' => $this->upload->display_errors('', '')
        );
    }

    $updata = $this->upload->data();

    return array(
        'ok'   => true,
        'file' => $updata['file_name']
    );
}


private function copy_itinerary_cover_to_package_cover($file_name)
{
    $file_name = trim((string)$file_name);
    if ($file_name === '') return '';

    $source = FCPATH . 'uploads/itinerary_cover/' . $file_name;
    $destDir = FCPATH . 'uploads/packages_cover/';

    if (!file_exists($source)) {
        return '';
    }

    if (!is_dir($destDir)) {
        @mkdir($destDir, 0777, true);
    }

    $ext = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));
    $new_name = 'pkg_cover_copy_' . time() . '_' . mt_rand(1000,9999) . '.' . $ext;
    $dest = $destDir . $new_name;

    if (@copy($source, $dest)) {
        return $new_name;
    }

    return '';
}

// public function ajax_add()
// {
//     // ✅ validate first if you have validator
//     if (method_exists($this, '_ajax_add_validate')) {
//         $this->_ajax_add_validate();
//     }

//     $this->db->trans_begin();

//     // timezone (PHP 5.6)
//     if (function_exists('date_default_timezone_set')) {
//         date_default_timezone_set("Asia/Kolkata");
//     }

//     $date = date('Y-m-d');
//     $time = date('h:i:sa');

//     $currentuserid   = $this->session->userdata('user_id');
//     $currentusername = $this->session->userdata('admin_name');

//     /* =========================================================
//        0) SAVE / COPY FIRST & LAST COVER PAGE INTO packages_cover
//     ========================================================= */
//     $packages_first_cover_page = '';
//     $packages_last_cover_page  = '';

//     // ---------- FIRST COVER ----------
//     if (!empty($_FILES['packages_first_cover_page']['name'])) {

//         $up1 = $this->upload_package_cover_image('packages_first_cover_page');

//         if (!isset($up1['ok']) || !$up1['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 "status"  => FALSE,
//                 "message" => isset($up1['message']) ? $up1['message'] : 'First cover page upload failed'
//             ));
//             return;
//         }

//         $packages_first_cover_page = $up1['file'];

//     } else {

//         $defaultFirst = trim((string)$this->input->post('packages_first_cover_page_txt'));
//         if ($defaultFirst !== '') {
//             $copiedFirst = $this->copy_itinerary_cover_to_package_cover($defaultFirst);
//             $packages_first_cover_page = $copiedFirst ? $copiedFirst : $defaultFirst;
//         }
//     }

//     // ---------- LAST COVER ----------
//     if (!empty($_FILES['packages_last_cover_page']['name'])) {

//         $up2 = $this->upload_package_cover_image('packages_last_cover_page');

//         if (!isset($up2['ok']) || !$up2['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 "status"  => FALSE,
//                 "message" => isset($up2['message']) ? $up2['message'] : 'Last cover page upload failed'
//             ));
//             return;
//         }

//         $packages_last_cover_page = $up2['file'];

//     } else {

//         $defaultLast = trim((string)$this->input->post('packages_last_cover_page_txt'));
//         if ($defaultLast !== '') {
//             $copiedLast = $this->copy_itinerary_cover_to_package_cover($defaultLast);
//             $packages_last_cover_page = $copiedLast ? $copiedLast : $defaultLast;
//         }
//     }

//     /* =========================================================
//        1) SAVE PACKAGE MASTER
//     ========================================================= */
//     $data = array(
//         'packages_category_id_fk'                   => $this->input->post('packages_category_id_fk'),
//         'packages_itinerary_category_id_fk'         => $this->input->post('packages_itinerary_category_id_fk'),
//         'packages_itinerary_id_fk'                  => $this->input->post('packages_itinerary_id_fk'),

//         'packages_inclusion_exclusion_common_id_fk' => $this->input->post('packages_inclusion_exclusion_common_id_fk'),
//         'packages_inclusion_exclusion_checked_type' => $this->input->post('packages_inclusion_exclusion_checked_type'),

//         'packages_optional_add_on_checked_type'     => $this->input->post('packages_optional_add_on_checked_type'),
//         'packages_special_requirment_checked_type'  => $this->input->post('packages_special_requirment_checked_type'),
//         'packages_payment_policies_checked_type'    => $this->input->post('packages_payment_policies_checked_type'),
//         'packages_terms_conditions_checked_type'    => $this->input->post('packages_terms_conditions_checked_type'),
//         'packages_cancellation_policy_checked_type' => $this->input->post('packages_cancellation_policy_checked_type'),
//         'packages_notes_checked_type'               => $this->input->post('packages_notes_checked_type'),

//         'packages_property_checked_type'            => $this->input->post('packages_property_checked_type'),

//         'packages_title'                            => $this->input->post('packages_title'),
//         'packages_duration_in_nights'               => $this->input->post('packages_duration_in_nights'),
//         'packages_description'                      => $this->input->post('packages_description'),

//         // ✅ NEW
//         'packages_first_cover_page'                 => $packages_first_cover_page,
//         'packages_last_cover_page'                  => $packages_last_cover_page,

//         'packages_createdby_user_id'                => $currentuserid,
//         'packages_createdby_user_name'              => $currentusername,
//         'packages_created_date'                     => $date,
//         'packages_created_time'                     => $time,
//         'packages_status'                           => 1
//     );

//     // ✅ insert package
//     $packages_id = $this->Packages_model->save($data);

//     if (!$packages_id) {
//         $this->db->trans_rollback();
//         echo json_encode(array("status" => FALSE, "message" => "Package insert failed"));
//         return;
//     }

//     /* =========================================================
//        2) SAVE ITINERARY HEADER
//     ========================================================= */
//     $data_itinerary = array(
//         'packages_id_fk'            => $packages_id,
//         'itineraries_id_fk'         => $this->input->post('packages_itinerary_id_fk'),
//         'packages_itinerary_status' => 1
//     );

//     $packages_itinerary_id = $this->General_model->add_returnID($this->packages_itinerary, $data_itinerary);

//     if (!$packages_itinerary_id) {
//         $this->db->trans_rollback();
//         echo json_encode(array("status" => FALSE, "message" => "Package itinerary insert failed"));
//         return;
//     }

//     /* =========================================================
//        3) SAVE ITINERARY DAYS (AND MAP DAY IDs)
//     ========================================================= */
//     $itineraries_days_id_fk                      = (array)$this->input->post('itineraries_days_id_fk');
//     $packages_itineraries_days_day               = (array)$this->input->post('packages_itineraries_days_day');
//     $packages_itineraries_days_destination_id_fk = (array)$this->input->post('packages_itineraries_days_destination_id_fk');
//     $packages_itineraries_days_title             = (array)$this->input->post('packages_itineraries_days_title');
//     $packages_itineraries_days_description       = (array)$this->input->post('packages_itineraries_days_description');
//     $travelBackArr                               = (array)$this->input->post('packages_itineraries_days_travel_back');
//     $defaultImages                               = (array)$this->input->post('default_itinerary_day_image');

//     $pkgDayIdByItinDayId = array();

//     $travelBackMap = array();
//     foreach ($travelBackArr as $i => $tb) {
//         if ($tb === 'TB') {
//             $travelBackMap[$i + 1] = true;
//         }
//     }

//     foreach ($itineraries_days_id_fk as $k => $itinDayId) {

//         $itinDayId = (int)$itinDayId;
//         if (!$itinDayId) continue;

//         $dayIndex = $k + 1;
//         $uploadedFile = '';

//         if (!empty($_FILES['packages_itineraries_days_image_file']['name'][$k])) {

//             $fileName = $_FILES['packages_itineraries_days_image_file']['name'][$k];
//             $ext = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
//             $allowed = array('jpg','jpeg','png');

//             if (!in_array($ext, $allowed)) {
//                 $this->db->trans_rollback();
//                 echo json_encode(array("status" => FALSE, "message" => "Only JPG/JPEG/PNG allowed for itinerary day image"));
//                 return;
//             }

//             $_FILES['day_image_tmp'] = array(
//                 'name'     => $_FILES['packages_itineraries_days_image_file']['name'][$k],
//                 'type'     => $_FILES['packages_itineraries_days_image_file']['type'][$k],
//                 'tmp_name' => $_FILES['packages_itineraries_days_image_file']['tmp_name'][$k],
//                 'error'    => $_FILES['packages_itineraries_days_image_file']['error'][$k],
//                 'size'     => $_FILES['packages_itineraries_days_image_file']['size'][$k],
//             );

//             $up = $this->upload_day_image('day_image_tmp');

//             if (isset($up['ok']) && $up['ok']) {
//                 $uploadedFile = $up['file'];
//             } else {
//                 $defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';
//                 $copied = $this->copy_default_day_image_to_package($defaultName);
//                 $uploadedFile = $copied ? $copied : $defaultName;
//             }

//         } else {
//             $defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';
//             $copied = $this->copy_default_day_image_to_package($defaultName);
//             $uploadedFile = $copied ? $copied : $defaultName;
//         }

//         $data_itinerary_days = array(
//             'packages_itinerary_id_fk'                    => $packages_itinerary_id,
//             'itineraries_days_id_fk'                      => $itinDayId,
//             'packages_itineraries_days_day'               => isset($packages_itineraries_days_day[$k]) ? $packages_itineraries_days_day[$k] : $dayIndex,
//             'packages_itineraries_days_destination_id_fk' => isset($packages_itineraries_days_destination_id_fk[$k]) ? $packages_itineraries_days_destination_id_fk[$k] : '',
//             'packages_itineraries_days_title'             => isset($packages_itineraries_days_title[$k]) ? $packages_itineraries_days_title[$k] : '',
//             'packages_itineraries_days_description'       => isset($packages_itineraries_days_description[$k]) ? $packages_itineraries_days_description[$k] : '',
//             'packages_itineraries_days_travel_back'       => isset($travelBackMap[$dayIndex]) ? 'TB' : '',
//             'packages_itineraries_days_image'             => $uploadedFile,
//             'packages_itinerary_days_status'              => 1
//         );

//         $packages_itinerary_days_id = $this->General_model->add_returnID($this->packages_itinerary_days, $data_itinerary_days);

//         if (!$packages_itinerary_days_id) {
//             $this->db->trans_rollback();
//             echo json_encode(array("status" => FALSE, "message" => "Package itinerary day insert failed"));
//             return;
//         }

//         $pkgDayIdByItinDayId[$itinDayId] = $packages_itinerary_days_id;
//     }

//     /* =========================================================
//        4) INCLUSIONS
//     ========================================================= */
//     $packages_inclusion_exclusion_checked_type = $this->input->post('packages_inclusion_exclusion_checked_type');
//     $common_id                                 = $this->input->post('packages_inclusion_exclusion_common_id_fk');
//     $packages_inclusions_details               = (array)$this->input->post('packages_inclusions_details');

//     if ($packages_inclusion_exclusion_checked_type == 'Y' && !empty($packages_inclusions_details)) {
//         foreach ($packages_inclusions_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $data_inclusion = array(
//                 'packages_id_fk'              => $packages_id,
//                 'inclusion_common_id_fk'      => $common_id,
//                 'packages_inclusions_type'    => 'Y',
//                 'packages_inclusions_details' => $detail,
//                 'packages_inclusions_status'  => 1
//             );
//             $this->General_model->add($this->packages_inclusions, $data_inclusion);
//         }
//     }

//     /* =========================================================
//        5) EXCLUSIONS
//     ========================================================= */
//     $packages_exclusions_details = (array)$this->input->post('packages_exclusions_details');

//     if ($packages_inclusion_exclusion_checked_type == 'Y' && !empty($packages_exclusions_details)) {
//         foreach ($packages_exclusions_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $data_exclusion = array(
//                 'packages_id_fk'              => $packages_id,
//                 'exclusions_common_id_fk'     => $common_id,
//                 'packages_exclusions_type'    => 'Y',
//                 'packages_exclusions_details' => $detail,
//                 'packages_exclusions_status'  => 1
//             );
//             $this->General_model->add($this->packages_exclusions, $data_exclusion);
//         }
//     }

//     /* =========================================================
//        6) OPTIONAL ADD ON
//     ========================================================= */
//     $packages_optional_add_on_checked_type = $this->input->post('packages_optional_add_on_checked_type');
//     $packages_optional_add_on_details      = (array)$this->input->post('packages_optional_add_on_details');

//     if ($packages_optional_add_on_checked_type == 'Y' && !empty($packages_optional_add_on_details)) {
//         foreach ($packages_optional_add_on_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $data_optional = array(
//                 'packages_optional_add_on_packages_id_fk' => $packages_id,
//                 'packages_optional_add_on_details'        => $detail,
//                 'packages_optional_add_on_status'         => 1
//             );
//             $this->General_model->add($this->packages_optional_add_on, $data_optional);
//         }
//     }

//     /* =========================================================
//        7) PAYMENT POLICIES
//     ========================================================= */
//     $packages_payment_policies_checked_type = $this->input->post('packages_payment_policies_checked_type');
//     $payment_policies_id_fk                 = $this->input->post('payment_policies_id_fk');
//     $packages_payment_policies_details      = (array)$this->input->post('packages_payment_policies_details');
//     $payment_policies_items_id_fk           = (array)$this->input->post('payment_policies_items_id_fk');

//     if ($packages_payment_policies_checked_type == 'Y' && !empty($packages_payment_policies_details)) {
//         foreach ($packages_payment_policies_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $itemId = isset($payment_policies_items_id_fk[$k]) ? $payment_policies_items_id_fk[$k] : '';

//             $data_payment = array(
//                 'packages_payment_policies_packages_id_fk' => $packages_id,
//                 'payment_policies_id_fk'                   => $payment_policies_id_fk,
//                 'payment_policies_items_id_fk'             => $itemId,
//                 'packages_payment_policies_type'           => 'Y',
//                 'packages_payment_policies_details'        => $detail,
//                 'packages_payment_policies_status'         => 1
//             );
//             $this->General_model->add($this->packages_payment_policies, $data_payment);
//         }
//     }

//     /* =========================================================
//        8) TERMS & CONDITIONS
//     ========================================================= */
//     $packages_terms_conditions_checked_type = $this->input->post('packages_terms_conditions_checked_type');
//     $terms_condition_id_fk                  = $this->input->post('terms_condition_id_fk');
//     $packages_terms_condition_details       = (array)$this->input->post('packages_terms_condition_details');
//     $terms_condition_item_id_fk             = (array)$this->input->post('terms_condition_item_id_fk');

//     if ($packages_terms_conditions_checked_type == 'Y' && !empty($packages_terms_condition_details)) {
//         foreach ($packages_terms_condition_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $itemId = isset($terms_condition_item_id_fk[$k]) ? $terms_condition_item_id_fk[$k] : '';

//             $data_terms = array(
//                 'packages_terms_condition_packages_id_fk' => $packages_id,
//                 'terms_condition_id_fk'                   => $terms_condition_id_fk,
//                 'terms_condition_item_id_fk'              => $itemId,
//                 'packages_terms_condition_type'           => 'Y',
//                 'packages_terms_condition_details'        => $detail,
//                 'packages_terms_condition_status'         => 1
//             );
//             $this->General_model->add($this->packages_terms_condition, $data_terms);
//         }
//     }

//     /* =========================================================
//        9) CANCELLATION POLICY
//     ========================================================= */
//     $packages_cancellation_policy_checked_type = $this->input->post('packages_cancellation_policy_checked_type');
//     $cancellation_policies_id_fk               = $this->input->post('cancellation_policies_id_fk');
//     $packages_cancellation_policies_details    = (array)$this->input->post('packages_cancellation_policies_details');
//     $cancellation_policies_item_id_fk          = (array)$this->input->post('cancellation_policies_item_id_fk');

//     if ($packages_cancellation_policy_checked_type == 'Y' && !empty($packages_cancellation_policies_details)) {
//         foreach ($packages_cancellation_policies_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $itemId = isset($cancellation_policies_item_id_fk[$k]) ? $cancellation_policies_item_id_fk[$k] : '';

//             $data_cancel = array(
//                 'packages_cancellation_policies_packages_id_fk' => $packages_id,
//                 'cancellation_policies_id_fk'                   => $cancellation_policies_id_fk,
//                 'cancellation_policies_item_id_fk'              => $itemId,
//                 'packages_cancellation_policies_type'           => 'Y',
//                 'packages_cancellation_policies_details'        => $detail,
//                 'packages_cancellation_policies_status'         => 1
//             );
//             $this->General_model->add($this->packages_cancellation_policies, $data_cancel);
//         }
//     }

//     /* =========================================================
//        10) NOTES
//     ========================================================= */
//     $packages_notes_checked_type = $this->input->post('packages_notes_checked_type');
//     $packages_notes_details      = (array)$this->input->post('packages_notes_details');

//     if ($packages_notes_checked_type == 'Y' && !empty($packages_notes_details)) {
//         foreach ($packages_notes_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $data_notes = array(
//                 'packages_notes_packages_id_fk' => $packages_id,
//                 'packages_notes_details'        => $detail,
//                 'packages_notes_status'         => 1
//             );
//             $this->General_model->add($this->packages_notes, $data_notes);
//         }
//     }

//     /* =========================================================
//        11) PROPERTIES
//     ========================================================= */
//     $packages_property_checked_type = $this->input->post('packages_property_checked_type');

//     if ($packages_property_checked_type === 'Y') {

//         $category_names      = (array)$this->input->post('property_category_name');
// 		$design_types = (array)$this->input->post('packages_properties_common_design_type');
//         $destinations_by_sec = (array)$this->input->post('property_destination_id');
//         $properties_by_sec   = (array)$this->input->post('properties_id');
//         $rooms_by_sec        = (array)$this->input->post('rooms_id');

//         foreach ($category_names as $secIndex => $categoryName) {

//             $categoryName = trim((string)$categoryName);
//             if ($categoryName === '') continue;

//             // $data_common = array(
//             //     'packages_properties_common_packages_id_fk' => $packages_id,
//             //     'packages_properties_common_category_name'  => $categoryName,
//             //     'packages_properties_common_status'         => 1
//             // );

// 			$designType = isset($design_types[$secIndex]) ? $design_types[$secIndex] : '';

// 			$data_common = array(
// 				'packages_properties_common_packages_id_fk' => $packages_id,
// 				'packages_properties_common_category_name'  => $categoryName,
// 				'packages_properties_common_design_type'    => $designType,
// 				'packages_properties_common_status'         => 1
// 			);
// 			// print_r($data_common);die;
//             $common_id = $this->General_model->add_returnID($this->packages_properties_common, $data_common);

//             if (empty($destinations_by_sec[$secIndex]) || !is_array($destinations_by_sec[$secIndex])) {
//                 continue;
//             }

//             foreach ($destinations_by_sec[$secIndex] as $itinDayId => $destId) {

//                 $itinDayId = (int)$itinDayId;
//                 if (!$itinDayId || !$destId) continue;

//                 $pkgItineraryDaysIdFk = isset($pkgDayIdByItinDayId[$itinDayId]) ? $pkgDayIdByItinDayId[$itinDayId] : 0;
//                 if (!$pkgItineraryDaysIdFk) {
//                     continue;
//                 }

//                 $dayNo = 0;
//                 $tbVal = '';

//                 foreach ($itineraries_days_id_fk as $kk => $postedItinDayId) {
//                     if ((int)$postedItinDayId === $itinDayId) {
//                         $dayNo = isset($packages_itineraries_days_day[$kk]) ? $packages_itineraries_days_day[$kk] : 0;
//                         $tbVal = isset($travelBackArr[$kk]) && $travelBackArr[$kk] === 'TB' ? 'TB' : '';
//                         break;
//                     }
//                 }

//                 $data_day = array(
//                     'packages_properties_common_id_fk'           => $common_id,
//                     'packages_itinerary_days_id_fk'              => $pkgItineraryDaysIdFk,
//                     'packages_properties_days_day'               => $dayNo,
//                     'packages_properties_days_destination_id_fk' => $destId,
//                     'packages_properties_days_travel_back'       => $tbVal,
//                     'packages_properties_days_status'            => 1
//                 );

//                 $day_id = $this->General_model->add_returnID($this->packages_properties_days, $data_day);

//                 if (empty($properties_by_sec[$secIndex][$itinDayId]) || !is_array($properties_by_sec[$secIndex][$itinDayId])) {
//                     continue;
//                 }

//                 foreach ($properties_by_sec[$secIndex][$itinDayId] as $rowKey => $propertyId) {

//                     if ($tbVal === 'TB') continue;
//                     if (empty($propertyId)) continue;

//                     $data_prop = array(
//                         'packages_properties_days_id_fk' => $day_id,
//                         'properties_id_fk'               => $propertyId,
//                         'packages_properties_status'     => 1
//                     );
//                     $packages_properties_id = $this->General_model->add_returnID($this->packages_properties, $data_prop);

//                     if (!empty($rooms_by_sec[$secIndex][$itinDayId][$rowKey]) && is_array($rooms_by_sec[$secIndex][$itinDayId][$rowKey])) {
//                         foreach ($rooms_by_sec[$secIndex][$itinDayId][$rowKey] as $roomId) {
//                             if (!$roomId) continue;

//                             $data_room = array(
//                                 'packages_properties_id_fk'        => $packages_properties_id,
//                                 'packages_properties_rooms_id_fk'  => $roomId,
//                                 'packages_properties_rooms_status' => 1
//                             );
//                             $this->General_model->add($this->packages_properties_rooms, $data_room);
//                         }
//                     }
//                 }
//             }
//         }
//     }

//     /* =========================================================
//        FINALIZE TRANSACTION
//     ========================================================= */
//     if ($this->db->trans_status() === FALSE) {
//         $this->db->trans_rollback();
//         echo json_encode(array("status" => FALSE, "message" => "Database error while saving package"));
//         return;
//     }

//     $this->db->trans_commit();
//     echo json_encode(array("status" => TRUE));
// }

// public function ajax_add()
// {
//     if (method_exists($this, '_ajax_add_validate')) {
//         $this->_ajax_add_validate();
//     }

//     $this->db->trans_begin();

//     if (function_exists('date_default_timezone_set')) {
//         date_default_timezone_set("Asia/Kolkata");
//     }

//     $date = date('Y-m-d');
//     $time = date('h:i:sa');

//     $currentuserid   = $this->session->userdata('user_id');
//     $currentusername = $this->session->userdata('admin_name');

//     /* =========================================================
//        0) SAVE / COPY COVER PAGE IMAGES
//     ========================================================= */
//     $packages_first_cover_page = '';
//     $packages_last_cover_page  = '';

//     // First cover
//     if (!empty($_FILES['packages_first_cover_page']['name'])) {

//         $up1 = $this->upload_package_cover_image('packages_first_cover_page');

//         if (!isset($up1['ok']) || !$up1['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 'status'  => FALSE,
//                 'message' => isset($up1['message']) ? $up1['message'] : 'First cover page upload failed'
//             ));
//             return;
//         }

//         $packages_first_cover_page = $up1['file'];

//     } else {

//         $defaultFirst = trim((string)$this->input->post('packages_first_cover_page_txt'));
//         if ($defaultFirst !== '') {
//             $copiedFirst = $this->copy_itinerary_cover_to_package_cover($defaultFirst);
//             $packages_first_cover_page = $copiedFirst ? $copiedFirst : $defaultFirst;
//         }
//     }

//     // Last cover
//     if (!empty($_FILES['packages_last_cover_page']['name'])) {

//         $up2 = $this->upload_package_cover_image('packages_last_cover_page');

//         if (!isset($up2['ok']) || !$up2['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 'status'  => FALSE,
//                 'message' => isset($up2['message']) ? $up2['message'] : 'Last cover page upload failed'
//             ));
//             return;
//         }

//         $packages_last_cover_page = $up2['file'];

//     } else {

//         $defaultLast = trim((string)$this->input->post('packages_last_cover_page_txt'));
//         if ($defaultLast !== '') {
//             $copiedLast = $this->copy_itinerary_cover_to_package_cover($defaultLast);
//             $packages_last_cover_page = $copiedLast ? $copiedLast : $defaultLast;
//         }
//     }

//     /* =========================================================
//        1) PACKAGE MASTER
//     ========================================================= */
//     $data = array(
//         'packages_category_id_fk'                   => $this->input->post('packages_category_id_fk'),
//         'packages_itinerary_category_id_fk'         => $this->input->post('packages_itinerary_category_id_fk'),
//         'packages_itinerary_id_fk'                  => $this->input->post('packages_itinerary_id_fk'),

//         'packages_inclusion_exclusion_common_id_fk' => $this->input->post('packages_inclusion_exclusion_common_id_fk'),
//         'packages_inclusion_exclusion_checked_type' => $this->input->post('packages_inclusion_exclusion_checked_type'),

//         'packages_optional_add_on_checked_type'     => $this->input->post('packages_optional_add_on_checked_type'),
//         'packages_special_requirment_checked_type'  => $this->input->post('packages_special_requirment_checked_type'),
//         'packages_payment_policies_checked_type'    => $this->input->post('packages_payment_policies_checked_type'),
//         'packages_terms_conditions_checked_type'    => $this->input->post('packages_terms_conditions_checked_type'),
//         'packages_cancellation_policy_checked_type' => $this->input->post('packages_cancellation_policy_checked_type'),
//         'packages_notes_checked_type'               => $this->input->post('packages_notes_checked_type'),
//         'packages_property_checked_type'            => $this->input->post('packages_property_checked_type'),

//         'packages_title'                            => $this->input->post('packages_title'),
//         'packages_duration_in_nights'               => $this->input->post('packages_duration_in_nights'),
//         'packages_description'                      => $this->input->post('packages_description'),

//         'packages_first_cover_page'                 => $packages_first_cover_page,
//         'packages_last_cover_page'                  => $packages_last_cover_page,

//         'packages_createdby_user_id'                => $currentuserid,
//         'packages_createdby_user_name'              => $currentusername,
//         'packages_created_date'                     => $date,
//         'packages_created_time'                     => $time,
//         'packages_status'                           => 1
//     );

//     $packages_id = $this->Packages_model->save($data);

//     if (!$packages_id) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Package insert failed'));
//         return;
//     }

//     /* =========================================================
//        2) INSERT ALL CHILD DATA
//     ========================================================= */
//     $ok = $this->insert_children_for_package($packages_id, FALSE);

//     if (!$ok) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Failed while saving child data'));
//         return;
//     }

//     if ($this->db->trans_status() === FALSE) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Database error while saving package'));
//         return;
//     }

//     $this->db->trans_commit();
//     echo json_encode(array('status' => TRUE));
// }

// public function ajax_update()
// {
//     if (method_exists($this, '_ajax_add_validate')) {
//         $this->_ajax_add_validate();
//     }

//     $id = (int)$this->input->post('packages_id');

//     if (!$id) {
//         echo json_encode(array('status' => FALSE, 'message' => 'Invalid package ID'));
//         return;
//     }

//     $this->db->trans_begin();

//     if (function_exists('date_default_timezone_set')) {
//         date_default_timezone_set("Asia/Kolkata");
//     }

//     $date = date('Y-m-d');
//     $time = date('h:i:sa');

//     $currentuserid   = $this->session->userdata('user_id');
//     $currentusername = $this->session->userdata('admin_name');

//     /* =========================================================
//        0) SAVE / KEEP COVER PAGE IMAGES
//     ========================================================= */
//     $packages_first_cover_page = '';
//     $packages_last_cover_page  = '';

//     // First cover
//     if (!empty($_FILES['packages_first_cover_page']['name'])) {

//         $up1 = $this->upload_package_cover_image('packages_first_cover_page');

//         if (!isset($up1['ok']) || !$up1['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 'status'  => FALSE,
//                 'message' => isset($up1['message']) ? $up1['message'] : 'First cover page upload failed'
//             ));
//             return;
//         }

//         $packages_first_cover_page = $up1['file'];

//     } else {
//         $packages_first_cover_page = trim((string)$this->input->post('packages_first_cover_page_txt'));
//     }

//     // Last cover
//     if (!empty($_FILES['packages_last_cover_page']['name'])) {

//         $up2 = $this->upload_package_cover_image('packages_last_cover_page');

//         if (!isset($up2['ok']) || !$up2['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 'status'  => FALSE,
//                 'message' => isset($up2['message']) ? $up2['message'] : 'Last cover page upload failed'
//             ));
//             return;
//         }

//         $packages_last_cover_page = $up2['file'];

//     } else {
//         $packages_last_cover_page = trim((string)$this->input->post('packages_last_cover_page_txt'));
//     }

//     /* =========================================================
//        1) UPDATE PACKAGE MASTER
//     ========================================================= */
//     $data = array(
//         'packages_category_id_fk'                   => $this->input->post('packages_category_id_fk'),
//         'packages_itinerary_category_id_fk'         => $this->input->post('packages_itinerary_category_id_fk'),
//         'packages_itinerary_id_fk'                  => $this->input->post('packages_itinerary_id_fk'),

//         'packages_inclusion_exclusion_common_id_fk' => $this->input->post('packages_inclusion_exclusion_common_id_fk'),
//         'packages_inclusion_exclusion_checked_type' => $this->input->post('packages_inclusion_exclusion_checked_type'),

//         'packages_optional_add_on_checked_type'     => $this->input->post('packages_optional_add_on_checked_type'),
//         'packages_special_requirment_checked_type'  => $this->input->post('packages_special_requirment_checked_type'),
//         'packages_payment_policies_checked_type'    => $this->input->post('packages_payment_policies_checked_type'),
//         'packages_terms_conditions_checked_type'    => $this->input->post('packages_terms_conditions_checked_type'),
//         'packages_cancellation_policy_checked_type' => $this->input->post('packages_cancellation_policy_checked_type'),
//         'packages_notes_checked_type'               => $this->input->post('packages_notes_checked_type'),
//         'packages_property_checked_type'            => $this->input->post('packages_property_checked_type'),

//         'packages_title'                            => $this->input->post('packages_title'),
//         'packages_duration_in_nights'               => $this->input->post('packages_duration_in_nights'),
//         'packages_description'                      => $this->input->post('packages_description'),

//         'packages_first_cover_page'                 => $packages_first_cover_page,
//         'packages_last_cover_page'                  => $packages_last_cover_page,

//         // use these only if columns exist in your table
//         // 'packages_updatedby_user_id'             => $currentuserid,
//         // 'packages_updatedby_user_name'           => $currentusername,
//         // 'packages_updated_date'                  => $date,
//         // 'packages_updated_time'                  => $time
//     );

//     $this->db->where('packages_id', $id);
//     $this->db->update('packages', $data);

//     /* =========================================================
//        2) DELETE OLD CHILD RECORDS
//     ========================================================= */
//     $this->delete_package_children($id);

//     /* =========================================================
//        3) INSERT CHILD DATA AGAIN
//     ========================================================= */
//     $ok = $this->insert_children_for_package($id, TRUE);

//     if (!$ok) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Failed while updating child data'));
//         return;
//     }

//     if ($this->db->trans_status() === FALSE) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Update failed'));
//         return;
//     }

//     $this->db->trans_commit();
//     echo json_encode(array('status' => TRUE));
// }

// private function delete_package_children($package_id)
// {
//     /* =============================
//        DELETE ITINERARY DAYS FIRST
//     ============================= */
//     $itRows = $this->db->select('packages_itinerary_id')
//         ->from('packages_itinerary')
//         ->where('packages_id_fk', $package_id)
//         ->get()
//         ->result_array();

//     $itineraryIds = array();
//     foreach ($itRows as $r) {
//         if (!empty($r['packages_itinerary_id'])) {
//             $itineraryIds[] = $r['packages_itinerary_id'];
//         }
//     }

//     if (!empty($itineraryIds)) {
//         $this->db->where_in('packages_itinerary_id_fk', $itineraryIds);
//         $this->db->delete('packages_itinerary_days');
//     }

//     $this->db->where('packages_id_fk', $package_id);
//     $this->db->delete('packages_itinerary');

//     /* =============================
//        OTHER SIMPLE CHILD TABLES
//     ============================= */
//     $this->db->where('packages_id_fk', $package_id)->delete('packages_inclusions');
//     $this->db->where('packages_id_fk', $package_id)->delete('packages_exclusions');

//     $this->db->where('packages_optional_add_on_packages_id_fk', $package_id)
//         ->delete('packages_optional_add_on');

//     $this->db->where('packages_special_requirements_packages_id_fk', $package_id)
//         ->delete('packages_special_requirements');

//     $this->db->where('packages_payment_policies_packages_id_fk', $package_id)
//         ->delete('packages_payment_policies');

//     $this->db->where('packages_terms_condition_packages_id_fk', $package_id)
//         ->delete('packages_terms_condition');

//     $this->db->where('packages_cancellation_policies_packages_id_fk', $package_id)
//         ->delete('packages_cancellation_policies');

//     $this->db->where('packages_notes_packages_id_fk', $package_id)
//         ->delete('packages_notes');

//     /* =============================
//        DELETE PROPERTY STRUCTURE
//     ============================= */
//     $commonRows = $this->db->select('packages_properties_common_id')
//         ->from('packages_properties_common')
//         ->where('packages_properties_common_packages_id_fk', $package_id)
//         ->get()
//         ->result_array();

//     $commonIds = array();
//     foreach ($commonRows as $r) {
//         if (!empty($r['packages_properties_common_id'])) {
//             $commonIds[] = $r['packages_properties_common_id'];
//         }
//     }

//     if (!empty($commonIds)) {

//         $dayRows = $this->db->select('packages_properties_days_id')
//             ->from('packages_properties_days')
//             ->where_in('packages_properties_common_id_fk', $commonIds)
//             ->get()
//             ->result_array();

//         $dayIds = array();
//         foreach ($dayRows as $r) {
//             if (!empty($r['packages_properties_days_id'])) {
//                 $dayIds[] = $r['packages_properties_days_id'];
//             }
//         }

//         if (!empty($dayIds)) {

//             $propRows = $this->db->select('packages_properties_id')
//                 ->from('packages_properties')
//                 ->where_in('packages_properties_days_id_fk', $dayIds)
//                 ->get()
//                 ->result_array();

//             $propIds = array();
//             foreach ($propRows as $r) {
//                 if (!empty($r['packages_properties_id'])) {
//                     $propIds[] = $r['packages_properties_id'];
//                 }
//             }

//             if (!empty($propIds)) {
//                 $this->db->where_in('packages_properties_id_fk', $propIds);
//                 $this->db->delete('packages_properties_rooms');
//             }

//             $this->db->where_in('packages_properties_days_id_fk', $dayIds);
//             $this->db->delete('packages_properties');
//         }

//         $this->db->where_in('packages_properties_common_id_fk', $commonIds);
//         $this->db->delete('packages_properties_days');
//     }

//     $this->db->where('packages_properties_common_packages_id_fk', $package_id);
//     $this->db->delete('packages_properties_common');
// }

// private function insert_children_for_package($package_id, $is_update)
// {
//     /* =============================
//        1) ITINERARY HEADER
//     ============================= */
//     $data_itinerary = array(
//         'packages_id_fk'            => $package_id,
//         'itineraries_id_fk'         => $this->input->post('packages_itinerary_id_fk'),
//         'packages_itinerary_status' => 1
//     );

//     $packages_itinerary_id = $this->General_model->add_returnID(
//         $this->packages_itinerary,
//         $data_itinerary
//     );

//     if (!$packages_itinerary_id) {
//         return FALSE;
//     }

//     /* =============================
//        2) ITINERARY DAYS
//     ============================= */
//     $itineraries_days_id_fk                      = (array)$this->input->post('itineraries_days_id_fk');
//     $packages_itineraries_days_day               = (array)$this->input->post('packages_itineraries_days_day');
//     $packages_itineraries_days_destination_id_fk = (array)$this->input->post('packages_itineraries_days_destination_id_fk');
//     $packages_itineraries_days_title             = (array)$this->input->post('packages_itineraries_days_title');
//     $packages_itineraries_days_description       = (array)$this->input->post('packages_itineraries_days_description');
//     $travelBackArr                               = (array)$this->input->post('packages_itineraries_days_travel_back');
//     $defaultImages                               = (array)$this->input->post('default_itinerary_day_image');
//     $requiredStatusArr                           = (array)$this->input->post('packages_itineraries_days_required_status');

//     // map: itineraries_days_id_fk => packages_itinerary_days_id
//     $pkgDayMap = array();

//     foreach ($itineraries_days_id_fk as $k => $itinDayId) {

//         $itinDayId = (int)$itinDayId;
//         if (!$itinDayId) {
//             continue;
//         }

//         $dayNo = isset($packages_itineraries_days_day[$k]) ? $packages_itineraries_days_day[$k] : ($k + 1);
//         $image = '';

//         if (!empty($_FILES['packages_itineraries_days_image_file']['name'][$k])) {

//             $_FILES['tmp_day_image'] = array(
//                 'name'     => $_FILES['packages_itineraries_days_image_file']['name'][$k],
//                 'type'     => $_FILES['packages_itineraries_days_image_file']['type'][$k],
//                 'tmp_name' => $_FILES['packages_itineraries_days_image_file']['tmp_name'][$k],
//                 'error'    => $_FILES['packages_itineraries_days_image_file']['error'][$k],
//                 'size'     => $_FILES['packages_itineraries_days_image_file']['size'][$k]
//             );

//             $up = $this->upload_day_image('tmp_day_image');

//             if (isset($up['ok']) && $up['ok']) {
//                 $image = $up['file'];
//             } else {
//                 $defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';
//                 $copied = $this->copy_default_day_image_to_package($defaultName);
//                 $image = $copied ? $copied : $defaultName;
//             }

//         } else {
//             $defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';
//             $copied = $this->copy_default_day_image_to_package($defaultName);
//             $image = $copied ? $copied : $defaultName;
//         }

//         $data_day = array(
//             'packages_itinerary_id_fk'                    => $packages_itinerary_id,
//             'itineraries_days_id_fk'                      => $itinDayId,
//             'packages_itineraries_days_day'               => $dayNo,
//             'packages_itineraries_days_destination_id_fk' => isset($packages_itineraries_days_destination_id_fk[$k]) ? $packages_itineraries_days_destination_id_fk[$k] : '',
//             'packages_itineraries_days_title'             => isset($packages_itineraries_days_title[$k]) ? $packages_itineraries_days_title[$k] : '',
//             'packages_itineraries_days_description'       => isset($packages_itineraries_days_description[$k]) ? $packages_itineraries_days_description[$k] : '',
//             'packages_itineraries_days_travel_back'       => isset($travelBackArr[$k]) ? $travelBackArr[$k] : '',
//             'packages_itineraries_days_required_status'   => isset($requiredStatusArr[$k]) ? $requiredStatusArr[$k] : 1,
//             'packages_itineraries_days_image'             => $image,
//             'packages_itinerary_days_status'              => 1
//         );

//         $pkgInsertedId = $this->General_model->add_returnID(
//             $this->packages_itinerary_days,
//             $data_day
//         );

//         if (!$pkgInsertedId) {
//             return FALSE;
//         }

//         $pkgDayMap[$itinDayId] = $pkgInsertedId;
//     }

//     /* =============================
//        3) INCLUSIONS
//     ============================= */
//     $packages_inclusion_exclusion_checked_type = $this->input->post('packages_inclusion_exclusion_checked_type');
//     $common_id                                 = $this->input->post('packages_inclusion_exclusion_common_id_fk');
//     $packages_inclusions_details               = (array)$this->input->post('packages_inclusions_details');

//     if ($packages_inclusion_exclusion_checked_type == 'Y') {
//         foreach ($packages_inclusions_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') {
//                 continue;
//             }

//             $this->General_model->add($this->packages_inclusions, array(
//                 'packages_id_fk'              => $package_id,
//                 'inclusion_common_id_fk'      => $common_id,
//                 'packages_inclusions_type'    => 'Y',
//                 'packages_inclusions_details' => $detail,
//                 'packages_inclusions_status'  => 1
//             ));
//         }
//     }

//     /* =============================
//        4) EXCLUSIONS
//     ============================= */
//     $packages_exclusions_details = (array)$this->input->post('packages_exclusions_details');

//     if ($packages_inclusion_exclusion_checked_type == 'Y') {
//         foreach ($packages_exclusions_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') {
//                 continue;
//             }

//             $this->General_model->add($this->packages_exclusions, array(
//                 'packages_id_fk'              => $package_id,
//                 'exclusions_common_id_fk'     => $common_id,
//                 'packages_exclusions_type'    => 'Y',
//                 'packages_exclusions_details' => $detail,
//                 'packages_exclusions_status'  => 1
//             ));
//         }
//     }

//     /* =============================
//        5) OPTIONAL ADD ON
//     ============================= */
//     $packages_optional_add_on_checked_type = $this->input->post('packages_optional_add_on_checked_type');
//     $packages_optional_add_on_details      = (array)$this->input->post('packages_optional_add_on_details');

//     if ($packages_optional_add_on_checked_type == 'Y') {
//         foreach ($packages_optional_add_on_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') {
//                 continue;
//             }

//             $this->General_model->add($this->packages_optional_add_on, array(
//                 'packages_optional_add_on_packages_id_fk' => $package_id,
//                 'packages_optional_add_on_details'        => $detail,
//                 'packages_optional_add_on_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        6) SPECIAL REQUIREMENTS
//     ============================= */
//     $packages_special_requirment_checked_type = $this->input->post('packages_special_requirment_checked_type');
//     $special_requirements_id_fk               = (array)$this->input->post('special_requirements_id_fk');
//     $packages_special_requirements_cost       = (array)$this->input->post('packages_special_requirements_cost');

//     if ($packages_special_requirment_checked_type == 'Y') {
//         foreach ($special_requirements_id_fk as $k => $sid) {
//             if (!$sid) {
//                 continue;
//             }

//             $this->General_model->add($this->packages_special_requirements, array(
//                 'packages_special_requirements_packages_id_fk' => $package_id,
//                 'special_requirements_id_fk'                   => $sid,
//                 'packages_special_requirements_cost'           => isset($packages_special_requirements_cost[$k]) ? $packages_special_requirements_cost[$k] : '',
//                 'packages_special_requirements_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        7) PAYMENT POLICIES
//     ============================= */
//     $packages_payment_policies_checked_type = $this->input->post('packages_payment_policies_checked_type');
//     $payment_policies_id_fk                 = $this->input->post('payment_policies_id_fk');
//     $payment_policies_items_id_fk           = (array)$this->input->post('payment_policies_items_id_fk');
//     $packages_payment_policies_details      = (array)$this->input->post('packages_payment_policies_details');

//     if ($packages_payment_policies_checked_type == 'Y') {
//         foreach ($packages_payment_policies_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') {
//                 continue;
//             }

//             $itemId = isset($payment_policies_items_id_fk[$k]) ? $payment_policies_items_id_fk[$k] : '';

//             $this->General_model->add($this->packages_payment_policies, array(
//                 'packages_payment_policies_packages_id_fk' => $package_id,
//                 'payment_policies_id_fk'                   => $payment_policies_id_fk,
//                 'payment_policies_items_id_fk'             => $itemId,
//                 'packages_payment_policies_type'           => 'Y',
//                 'packages_payment_policies_details'        => $detail,
//                 'packages_payment_policies_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        8) TERMS
//     ============================= */
//     $packages_terms_conditions_checked_type = $this->input->post('packages_terms_conditions_checked_type');
//     $terms_condition_id_fk                  = $this->input->post('terms_condition_id_fk');
//     $terms_condition_item_id_fk             = (array)$this->input->post('terms_condition_item_id_fk');
//     $packages_terms_condition_details       = (array)$this->input->post('packages_terms_condition_details');

//     if ($packages_terms_conditions_checked_type == 'Y') {
//         foreach ($packages_terms_condition_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') {
//                 continue;
//             }

//             $itemId = isset($terms_condition_item_id_fk[$k]) ? $terms_condition_item_id_fk[$k] : '';

//             $this->General_model->add($this->packages_terms_condition, array(
//                 'packages_terms_condition_packages_id_fk' => $package_id,
//                 'terms_condition_id_fk'                   => $terms_condition_id_fk,
//                 'terms_condition_item_id_fk'              => $itemId,
//                 'packages_terms_condition_type'           => 'Y',
//                 'packages_terms_condition_details'        => $detail,
//                 'packages_terms_condition_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        9) CANCELLATION
//     ============================= */
//     $packages_cancellation_policy_checked_type = $this->input->post('packages_cancellation_policy_checked_type');
//     $cancellation_policies_id_fk               = $this->input->post('cancellation_policies_id_fk');
//     $cancellation_policies_item_id_fk          = (array)$this->input->post('cancellation_policies_item_id_fk');
//     $packages_cancellation_policies_details    = (array)$this->input->post('packages_cancellation_policies_details');

//     if ($packages_cancellation_policy_checked_type == 'Y') {
//         foreach ($packages_cancellation_policies_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') {
//                 continue;
//             }

//             $itemId = isset($cancellation_policies_item_id_fk[$k]) ? $cancellation_policies_item_id_fk[$k] : '';

//             $this->General_model->add($this->packages_cancellation_policies, array(
//                 'packages_cancellation_policies_packages_id_fk' => $package_id,
//                 'cancellation_policies_id_fk'                   => $cancellation_policies_id_fk,
//                 'cancellation_policies_item_id_fk'              => $itemId,
//                 'packages_cancellation_policies_type'           => 'Y',
//                 'packages_cancellation_policies_details'        => $detail,
//                 'packages_cancellation_policies_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        10) NOTES
//     ============================= */
//     $packages_notes_checked_type = $this->input->post('packages_notes_checked_type');
//     $packages_notes_details      = (array)$this->input->post('packages_notes_details');

//     if ($packages_notes_checked_type == 'Y') {
//         foreach ($packages_notes_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') {
//                 continue;
//             }

//             $this->General_model->add($this->packages_notes, array(
//                 'packages_notes_packages_id_fk' => $package_id,
//                 'packages_notes_details'        => $detail,
//                 'packages_notes_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        11) PROPERTIES
//     ============================= */
//     $packages_property_checked_type = $this->input->post('packages_property_checked_type');

//     if ($packages_property_checked_type === 'Y') {

//         $category_names      = (array)$this->input->post('property_category_name');
//         $design_types        = (array)$this->input->post('packages_properties_common_design_type');
//         $destinations_by_sec = (array)$this->input->post('property_destination_id');
//         $properties_by_sec   = (array)$this->input->post('properties_id');
//         $rooms_by_sec        = (array)$this->input->post('rooms_id');

//         foreach ($category_names as $secIndex => $categoryName) {

//             $categoryName = trim((string)$categoryName);
//             if ($categoryName === '') {
//                 continue;
//             }

//             $designType = isset($design_types[$secIndex]) ? trim((string)$design_types[$secIndex]) : '';

//             $common_id = $this->General_model->add_returnID(
//                 $this->packages_properties_common,
//                 array(
//                     'packages_properties_common_packages_id_fk' => $package_id,
//                     'packages_properties_common_category_name'  => $categoryName,
//                     'packages_properties_common_design_type'    => $designType,
//                     'packages_properties_common_status'         => 1
//                 )
//             );

//             if (!$common_id) {
//                 return FALSE;
//             }

//             if (empty($destinations_by_sec[$secIndex]) || !is_array($destinations_by_sec[$secIndex])) {
//                 continue;
//             }

//             foreach ($destinations_by_sec[$secIndex] as $itinDayId => $destId) {

//                 $itinDayId = (int)$itinDayId;
//                 if (!$itinDayId || !$destId) {
//                     continue;
//                 }

//                 $pkgItineraryDaysIdFk = isset($pkgDayMap[$itinDayId]) ? $pkgDayMap[$itinDayId] : 0;
//                 if (!$pkgItineraryDaysIdFk) {
//                     continue;
//                 }

//                 $dayNo = 0;
//                 $tbVal = '';

//                 foreach ($itineraries_days_id_fk as $kk => $postedItinDayId) {
//                     if ((int)$postedItinDayId === $itinDayId) {
//                         $dayNo = isset($packages_itineraries_days_day[$kk]) ? $packages_itineraries_days_day[$kk] : 0;
//                         $tbVal = (isset($travelBackArr[$kk]) && $travelBackArr[$kk] === 'TB') ? 'TB' : '';
//                         break;
//                     }
//                 }

//                 $day_id = $this->General_model->add_returnID(
//                     $this->packages_properties_days,
//                     array(
//                         'packages_properties_common_id_fk'           => $common_id,
//                         'packages_itinerary_days_id_fk'              => $pkgItineraryDaysIdFk,
//                         'packages_properties_days_day'               => $dayNo,
//                         'packages_properties_days_destination_id_fk' => $destId,
//                         'packages_properties_days_travel_back'       => $tbVal,
//                         'packages_properties_days_status'            => 1
//                     )
//                 );

//                 if (!$day_id) {
//                     return FALSE;
//                 }

//                 if (empty($properties_by_sec[$secIndex][$itinDayId]) || !is_array($properties_by_sec[$secIndex][$itinDayId])) {
//                     continue;
//                 }

//                 foreach ($properties_by_sec[$secIndex][$itinDayId] as $rowKey => $propertyId) {

//                     $propertyId = trim((string)$propertyId);

//                     // normal and travel back both save if property selected
//                     if ($propertyId === '') {
//                         continue;
//                     }

//                     $packages_properties_id = $this->General_model->add_returnID(
//                         $this->packages_properties,
//                         array(
//                             'packages_properties_days_id_fk' => $day_id,
//                             'properties_id_fk'               => $propertyId,
//                             'packages_properties_status'     => 1
//                         )
//                     );

//                     if (!$packages_properties_id) {
//                         return FALSE;
//                     }

//                     if (!empty($rooms_by_sec[$secIndex][$itinDayId][$rowKey]) && is_array($rooms_by_sec[$secIndex][$itinDayId][$rowKey])) {
//                         foreach ($rooms_by_sec[$secIndex][$itinDayId][$rowKey] as $roomId) {

//                             if (!$roomId) {
//                                 continue;
//                             }

//                             $this->General_model->add(
//                                 $this->packages_properties_rooms,
//                                 array(
//                                     'packages_properties_id_fk'        => $packages_properties_id,
//                                     'packages_properties_rooms_id_fk'  => $roomId,
//                                     'packages_properties_rooms_status' => 1
//                                 )
//                             );
//                         }
//                     }
//                 }

//                 // foreach ($properties_by_sec[$secIndex][$itinDayId] as $rowKey => $propertyId) {

//                 //     if (empty($propertyId)) continue;

//                 //     $data_prop = array(
//                 //         'packages_properties_days_id_fk' => $day_id,
//                 //         'properties_id_fk'               => $propertyId,
//                 //         'packages_properties_status'     => 1
//                 //     );
//                 //     $packages_properties_id = $this->General_model->add_returnID($this->packages_properties, $data_prop);

//                 //     if (!empty($rooms_by_sec[$secIndex][$itinDayId][$rowKey]) && is_array($rooms_by_sec[$secIndex][$itinDayId][$rowKey])) {
//                 //         foreach ($rooms_by_sec[$secIndex][$itinDayId][$rowKey] as $roomId) {
//                 //             if (!$roomId) continue;

//                 //             $data_room = array(
//                 //                 'packages_properties_id_fk'        => $packages_properties_id,
//                 //                 'packages_properties_rooms_id_fk'  => $roomId,
//                 //                 'packages_properties_rooms_status' => 1
//                 //             );
//                 //             $this->General_model->add($this->packages_properties_rooms, $data_room);
//                 //         }
//                 //     }
//                 // }
//             }
//         }
//     }

//     return TRUE;
// }

private function _ajax_add_validate()
{
    $errors = array(
        "status"       => FALSE,
        "inputerror"   => array(),
        "error_string" => array()
    );

    /* =========================
       HELPERS
    ========================= */
    $trim = function ($v) {
        return trim((string)$v);
    };

    $addErr = function ($field, $msg) use (&$errors) {
        $errors["inputerror"][]   = $field;
        $errors["error_string"][] = $msg;
    };

    $hasAnyText = function ($arr) use ($trim) {
        if (!is_array($arr)) return FALSE;
        foreach ($arr as $v) {
            if ($trim($v) !== '') return TRUE;
        }
        return FALSE;
    };

    $hasEmptyText = function ($arr) use ($trim) {
        if (!is_array($arr)) return FALSE;
        foreach ($arr as $v) {
            if ($trim($v) === '') return TRUE;
        }
        return FALSE;
    };

    /* =========================
       1) MAIN REQUIRED FIELDS
    ========================= */
    $title   = $trim($this->input->post('packages_title'));
    $nights  = $trim($this->input->post('packages_duration_in_nights'));
    $catId   = $trim($this->input->post('packages_category_id_fk'));
    $icatId  = $trim($this->input->post('packages_itinerary_category_id_fk'));
    $itId    = $trim($this->input->post('packages_itinerary_id_fk'));

    if ($title === '')  $addErr('packages_title', 'Package title is required');
    if ($nights === '') $addErr('packages_duration_in_nights', 'Duration in nights is required');
    if ($catId === '')  $addErr('packages_category_id_fk', 'Package category is required');
    if ($icatId === '') $addErr('packages_itinerary_category_id_fk', 'Itinerary category is required');
    if ($itId === '')   $addErr('packages_itinerary_id_fk', 'Itinerary is required');

    /* =========================
       2) COVER PAGE VALIDATION
       - only required when no old/default image
    ========================= */
    $oldFirst = $trim($this->input->post('packages_first_cover_page_txt'));
    $oldLast  = $trim($this->input->post('packages_last_cover_page_txt'));

    $newFirst = isset($_FILES['packages_first_cover_page']['name']) ? trim($_FILES['packages_first_cover_page']['name']) : '';
    $newLast  = isset($_FILES['packages_last_cover_page']['name']) ? trim($_FILES['packages_last_cover_page']['name']) : '';

    if ($oldFirst === '' && $newFirst === '') {
        $addErr('packages_first_cover_page', 'First cover page is required');
    }

    if ($oldLast === '' && $newLast === '') {
        $addErr('packages_last_cover_page', 'Last cover page is required');
    }

    /* =========================
       3) INCLUSION / EXCLUSION
    ========================= */
    $incExcChk = $trim($this->input->post('packages_inclusion_exclusion_checked_type'));

    if ($incExcChk === 'Y') {

        $incDetails = $this->input->post('packages_inclusions_details');
        $excDetails = $this->input->post('packages_exclusions_details');

        if (!$hasAnyText($incDetails)) {
            $addErr('packages_inclusions_details', 'Please add at least one Inclusion');
        }

        if (!$hasAnyText($excDetails)) {
            $addErr('packages_exclusions_details', 'Please add at least one Exclusion');
        }

        if ($hasEmptyText($incDetails)) {
            $addErr('packages_inclusions_details', 'Inclusions contains empty value');
        }

        if ($hasEmptyText($excDetails)) {
            $addErr('packages_exclusions_details', 'Exclusions contains empty value');
        }
    }

    /* =========================
       4) OPTIONAL ADD ON
    ========================= */
    $optChk = $trim($this->input->post('packages_optional_add_on_checked_type'));

    if ($optChk === 'Y') {
        $opt = $this->input->post('packages_optional_add_on_details');

        if (!$hasAnyText($opt)) {
            $addErr('packages_optional_add_on_details', 'Please add at least one Optional add on');
        }

        if ($hasEmptyText($opt)) {
            $addErr('packages_optional_add_on_details', 'Optional add on contains empty value');
        }
    }

    /* =========================
       5) SPECIAL REQUIREMENTS
       (uncomment only if using)
    ========================= */
    /*
    $spChk = $trim($this->input->post('packages_special_requirment_checked_type'));

    if ($spChk === 'Y') {
        $spId   = (array)$this->input->post('special_requirements_id_fk');
        $spCost = (array)$this->input->post('packages_special_requirements_cost');

        if (empty($spId)) {
            $addErr('special_requirements_id_fk', 'Please add at least one Special requirement');
        } else {
            foreach ($spId as $k => $sid) {
                if ($trim($sid) === '') {
                    $addErr('special_requirements_id_fk', 'Special requirement is required');
                }
                if (!isset($spCost[$k]) || $trim($spCost[$k]) === '') {
                    $addErr('packages_special_requirements_cost', 'Special requirement cost is required');
                }
            }
        }
    }
    */

    /* =========================
       6) PAYMENT POLICIES
    ========================= */
    $payChk = $trim($this->input->post('packages_payment_policies_checked_type'));

    if ($payChk === 'Y') {
        $pay = $this->input->post('packages_payment_policies_details');

        if (!$hasAnyText($pay)) {
            $addErr('packages_payment_policies_details', 'Please add at least one Payment policy');
        }

        if ($hasEmptyText($pay)) {
            $addErr('packages_payment_policies_details', 'Payment policies contains empty value');
        }
    }

    /* =========================
       7) TERMS & CONDITIONS
    ========================= */
    $termsChk = $trim($this->input->post('packages_terms_conditions_checked_type'));

    if ($termsChk === 'Y') {
        $terms = $this->input->post('packages_terms_condition_details');

        if (!$hasAnyText($terms)) {
            $addErr('packages_terms_condition_details', 'Please add at least one Terms & Conditions item');
        }

        if ($hasEmptyText($terms)) {
            $addErr('packages_terms_condition_details', 'Terms & Conditions contains empty value');
        }
    }

    /* =========================
       8) CANCELLATION POLICY
    ========================= */
    $canChk = $trim($this->input->post('packages_cancellation_policy_checked_type'));

    if ($canChk === 'Y') {
        $can = $this->input->post('packages_cancellation_policies_details');

        if (!$hasAnyText($can)) {
            $addErr('packages_cancellation_policies_details', 'Please add at least one Cancellation policy');
        }

        if ($hasEmptyText($can)) {
            $addErr('packages_cancellation_policies_details', 'Cancellation policy contains empty value');
        }
    }

    /* =========================
       9) NOTES
    ========================= */
    $notesChk = $trim($this->input->post('packages_notes_checked_type'));

    if ($notesChk === 'Y') {
        $notes = $this->input->post('packages_notes_details');

        if (!$hasAnyText($notes)) {
            $addErr('packages_notes_details', 'Please add at least one Note');
        }

        if ($hasEmptyText($notes)) {
            $addErr('packages_notes_details', 'Notes contains empty value');
        }
    }

    /* =========================
       10) PROPERTIES
       Travel Back row validation:
       - if TB required_status = 1 => property/room required
       - if TB required_status = 2 => skip validation
    ========================= */
    $propChk = $trim($this->input->post('packages_property_checked_type'));

    if ($propChk === 'Y') {

        $catNames          = (array)$this->input->post('property_category_name');
        $designTypes       = (array)$this->input->post('packages_properties_common_design_type');
        $props             = (array)$this->input->post('properties_id');
        $rooms             = (array)$this->input->post('rooms_id');
        $travelBackArr     = (array)$this->input->post('packages_itineraries_days_travel_back');
        $requiredStatusArr = (array)$this->input->post('packages_itineraries_days_required_status');
        $itinDayIds        = (array)$this->input->post('itineraries_days_id_fk');

        if (empty($catNames)) {
            $addErr('property_category_name', 'Please add at least one Property category');
        } else {

            /* build day map:
               [itinerary_day_id] => array(
                   'is_tb' => true/false,
                   'required_status' => 1 or 2
               )
            */
            $dayMeta = array();

            foreach ($itinDayIds as $k => $itinDayId) {
                $itinDayId = (int)$itinDayId;
                if (!$itinDayId) continue;

                $tb = isset($travelBackArr[$k]) && $travelBackArr[$k] === 'TB' ? TRUE : FALSE;
                $reqStatus = isset($requiredStatusArr[$k]) ? (int)$requiredStatusArr[$k] : 1;

                $dayMeta[$itinDayId] = array(
                    'is_tb' => $tb,
                    'required_status' => $reqStatus
                );
            }

            foreach ($catNames as $secIndex => $name) {

                if ($trim($name) === '') {
                    $addErr('property_category_name', 'Property category name is required');
                }

                if (!isset($designTypes[$secIndex]) || $trim($designTypes[$secIndex]) === '') {
                    $addErr('packages_properties_common_design_type', 'Design type is required');
                }

                if (!isset($props[$secIndex]) || !is_array($props[$secIndex])) {
                    continue;
                }

                foreach ($props[$secIndex] as $itinDayId => $rows) {

                    $itinDayId = (int)$itinDayId;
                    if (!$itinDayId || !is_array($rows)) {
                        continue;
                    }

                    $isTB = FALSE;
                    $requiredStatus = 1;

                    if (isset($dayMeta[$itinDayId])) {
                        $isTB = $dayMeta[$itinDayId]['is_tb'];
                        $requiredStatus = $dayMeta[$itinDayId]['required_status'];
                    }

                    // skip TB validation only when unchecked (status 2)
                    $skipThisDay = ($isTB && $requiredStatus == 2);

                    if ($skipThisDay) {
                        continue;
                    }

                    foreach ($rows as $rowKey => $propertyId) {

                        $propertyId = $trim($propertyId);

                        if ($propertyId === '') {
                            $addErr('properties_id', 'Property is required');
                        }

                        if (
                            !isset($rooms[$secIndex]) ||
                            !isset($rooms[$secIndex][$itinDayId]) ||
                            !isset($rooms[$secIndex][$itinDayId][$rowKey]) ||
                            !is_array($rooms[$secIndex][$itinDayId][$rowKey]) ||
                            count($rooms[$secIndex][$itinDayId][$rowKey]) === 0
                        ) {
                            $addErr('rooms_id', 'Rooms are required for selected property');
                        }
                    }
                }
            }
        }
    }

    /* =========================
       RETURN ERRORS
    ========================= */
    if (!empty($errors['inputerror'])) {
        echo json_encode($errors);
        exit;
    }
}

// public function ajax_add()
// {
//     if (method_exists($this, '_ajax_add_validate')) {
//         $this->_ajax_add_validate();
//     }

//     $this->db->trans_begin();

//     if (function_exists('date_default_timezone_set')) {
//         date_default_timezone_set("Asia/Kolkata");
//     }

//     $date = date('Y-m-d');
//     $time = date('h:i:sa');

//     $currentuserid   = $this->session->userdata('user_id');
//     $currentusername = $this->session->userdata('admin_name');

//     /* =========================================================
//        0) SAVE / COPY COVER PAGE IMAGES
//     ========================================================= */
//     $packages_first_cover_page = '';
//     $packages_last_cover_page  = '';

//     if (!empty($_FILES['packages_first_cover_page']['name'])) {

//         $up1 = $this->upload_package_cover_image('packages_first_cover_page');

//         if (!isset($up1['ok']) || !$up1['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 'status'  => FALSE,
//                 'message' => isset($up1['message']) ? $up1['message'] : 'First cover page upload failed'
//             ));
//             return;
//         }

//         $packages_first_cover_page = $up1['file'];

//     } else {

//         $defaultFirst = trim((string)$this->input->post('packages_first_cover_page_txt'));
//         if ($defaultFirst !== '') {
//             $copiedFirst = $this->copy_itinerary_cover_to_package_cover($defaultFirst);
//             $packages_first_cover_page = $copiedFirst ? $copiedFirst : $defaultFirst;
//         }
//     }

//     if (!empty($_FILES['packages_last_cover_page']['name'])) {

//         $up2 = $this->upload_package_cover_image('packages_last_cover_page');

//         if (!isset($up2['ok']) || !$up2['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 'status'  => FALSE,
//                 'message' => isset($up2['message']) ? $up2['message'] : 'Last cover page upload failed'
//             ));
//             return;
//         }

//         $packages_last_cover_page = $up2['file'];

//     } else {

//         $defaultLast = trim((string)$this->input->post('packages_last_cover_page_txt'));
//         if ($defaultLast !== '') {
//             $copiedLast = $this->copy_itinerary_cover_to_package_cover($defaultLast);
//             $packages_last_cover_page = $copiedLast ? $copiedLast : $defaultLast;
//         }
//     }

//     /* =========================================================
//        1) PACKAGE MASTER
//     ========================================================= */
//     $data = array(
//         'packages_category_id_fk'                   => $this->input->post('packages_category_id_fk'),
//         'packages_itinerary_category_id_fk'         => $this->input->post('packages_itinerary_category_id_fk'),
//         'packages_itinerary_id_fk'                  => $this->input->post('packages_itinerary_id_fk'),

//         'packages_inclusion_exclusion_common_id_fk' => $this->input->post('packages_inclusion_exclusion_common_id_fk'),
//         'packages_inclusion_exclusion_checked_type' => $this->input->post('packages_inclusion_exclusion_checked_type'),

//         'packages_optional_add_on_checked_type'     => $this->input->post('packages_optional_add_on_checked_type'),
//         'packages_special_requirment_checked_type'  => $this->input->post('packages_special_requirment_checked_type'),
//         'packages_payment_policies_checked_type'    => $this->input->post('packages_payment_policies_checked_type'),
//         'packages_terms_conditions_checked_type'    => $this->input->post('packages_terms_conditions_checked_type'),
//         'packages_cancellation_policy_checked_type' => $this->input->post('packages_cancellation_policy_checked_type'),
//         'packages_notes_checked_type'               => $this->input->post('packages_notes_checked_type'),
//         'packages_property_checked_type'            => $this->input->post('packages_property_checked_type'),

//         'packages_title'                            => $this->input->post('packages_title'),
//         'packages_duration_in_nights'               => $this->input->post('packages_duration_in_nights'),
//         'packages_description'                      => $this->input->post('packages_description'),

//         'packages_first_cover_page'                 => $packages_first_cover_page,
//         'packages_last_cover_page'                  => $packages_last_cover_page,

//         'packages_createdby_user_id'                => $currentuserid,
//         'packages_createdby_user_name'              => $currentusername,
//         'packages_created_date'                     => $date,
//         'packages_created_time'                     => $time,
//         'packages_status'                           => 1
//     );

//     $packages_id = $this->Packages_model->save($data);

//     if (!$packages_id) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Package insert failed'));
//         return;
//     }

//     // $ok = $this->insert_children_for_package($packages_id, FALSE);

//     // if (!$ok) {
//     //     $this->db->trans_rollback();
//     //     echo json_encode(array('status' => FALSE, 'message' => 'Failed while saving child data'));
//     //     return;
//     // }

//     $insertRes = $this->insert_children_for_package($packages_id, FALSE);

//     if (!$insertRes || empty($insertRes['status'])) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Failed while saving child data'));
//         return;
//     }

//     if ($this->db->trans_status() === FALSE) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Database error while saving package'));
//         return;
//     }

//     $this->db->trans_commit();
//     echo json_encode(array('status' => TRUE));
// }

// public function ajax_update()
// {
//     if (method_exists($this, '_ajax_add_validate')) {
//         $this->_ajax_add_validate();
//     }

//     $id = (int)$this->input->post('packages_id');

//     if (!$id) {
//         echo json_encode(array('status' => FALSE, 'message' => 'Invalid package ID'));
//         return;
//     }

//     $this->db->trans_begin();

//     if (function_exists('date_default_timezone_set')) {
//         date_default_timezone_set("Asia/Kolkata");
//     }

//     /* =========================================================
//        0) SAVE / KEEP COVER PAGE IMAGES
//     ========================================================= */
//     $packages_first_cover_page = '';
//     $packages_last_cover_page  = '';

//     if (!empty($_FILES['packages_first_cover_page']['name'])) {

//         $up1 = $this->upload_package_cover_image('packages_first_cover_page');

//         if (!isset($up1['ok']) || !$up1['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 'status'  => FALSE,
//                 'message' => isset($up1['message']) ? $up1['message'] : 'First cover page upload failed'
//             ));
//             return;
//         }

//         $packages_first_cover_page = $up1['file'];

//     } else {
//         $packages_first_cover_page = trim((string)$this->input->post('packages_first_cover_page_txt'));
//     }

//     if (!empty($_FILES['packages_last_cover_page']['name'])) {

//         $up2 = $this->upload_package_cover_image('packages_last_cover_page');

//         if (!isset($up2['ok']) || !$up2['ok']) {
//             $this->db->trans_rollback();
//             echo json_encode(array(
//                 'status'  => FALSE,
//                 'message' => isset($up2['message']) ? $up2['message'] : 'Last cover page upload failed'
//             ));
//             return;
//         }

//         $packages_last_cover_page = $up2['file'];

//     } else {
//         $packages_last_cover_page = trim((string)$this->input->post('packages_last_cover_page_txt'));
//     }

//     /* =========================================================
//        1) TAKE OLD PACKAGE DAY MAP BEFORE DELETE
//        old map format:
//        [
//          old_packages_itinerary_days_id => itineraries_days_id_fk
//        ]
//     ========================================================= */
//     $oldPkgDayMap = $this->get_old_package_day_map($id);

//     /* =========================================================
//        2) UPDATE PACKAGE MASTER
//     ========================================================= */
//     $data = array(
//         'packages_category_id_fk'                   => $this->input->post('packages_category_id_fk'),
//         'packages_itinerary_category_id_fk'         => $this->input->post('packages_itinerary_category_id_fk'),
//         'packages_itinerary_id_fk'                  => $this->input->post('packages_itinerary_id_fk'),

//         'packages_inclusion_exclusion_common_id_fk' => $this->input->post('packages_inclusion_exclusion_common_id_fk'),
//         'packages_inclusion_exclusion_checked_type' => $this->input->post('packages_inclusion_exclusion_checked_type'),

//         'packages_optional_add_on_checked_type'     => $this->input->post('packages_optional_add_on_checked_type'),
//         'packages_special_requirment_checked_type'  => $this->input->post('packages_special_requirment_checked_type'),
//         'packages_payment_policies_checked_type'    => $this->input->post('packages_payment_policies_checked_type'),
//         'packages_terms_conditions_checked_type'    => $this->input->post('packages_terms_conditions_checked_type'),
//         'packages_cancellation_policy_checked_type' => $this->input->post('packages_cancellation_policy_checked_type'),
//         'packages_notes_checked_type'               => $this->input->post('packages_notes_checked_type'),
//         'packages_property_checked_type'            => $this->input->post('packages_property_checked_type'),

//         'packages_title'                            => $this->input->post('packages_title'),
//         'packages_duration_in_nights'               => $this->input->post('packages_duration_in_nights'),
//         'packages_description'                      => $this->input->post('packages_description'),

//         'packages_first_cover_page'                 => $packages_first_cover_page,
//         'packages_last_cover_page'                  => $packages_last_cover_page
//     );

//     $this->db->where('packages_id', $id);
//     $this->db->update('packages', $data);

//     /* =========================================================
//        3) DELETE OLD CHILD RECORDS
//     ========================================================= */
//     $this->delete_package_children($id);

//     /* =========================================================
//        4) INSERT CHILD DATA AGAIN
//        return:
//        [
//          'status' => TRUE/FALSE,
//          'pkgDayMap' => [ itineraries_days_id_fk => new_packages_itinerary_days_id ]
//        ]
//     ========================================================= */
//     $insertRes = $this->insert_children_for_package($id, TRUE);

//     if (!$insertRes || empty($insertRes['status'])) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Failed while updating child data'));
//         return;
//     }

//     $newPkgDayMap = !empty($insertRes['pkgDayMap']) ? $insertRes['pkgDayMap'] : array();

//     /* =========================================================
//        5) UPDATE accommodation_plan.day_id_fk
//        ONLY FOR UPDATE, NOT FOR DUPLICATE
//     ========================================================= */
//     $this->update_accommodation_plan_day_ids($oldPkgDayMap, $newPkgDayMap);

//     if ($this->db->trans_status() === FALSE) {
//         $this->db->trans_rollback();
//         echo json_encode(array('status' => FALSE, 'message' => 'Update failed'));
//         return;
//     }

//     $this->db->trans_commit();
//     echo json_encode(array('status' => TRUE));
// }

// private function get_old_package_day_map($package_id)
// {
//     $rows = $this->db->select('pid.packages_itinerary_days_id, pid.itineraries_days_id_fk')
//         ->from('packages_itinerary_days pid')
//         ->join('packages_itinerary pi', 'pi.packages_itinerary_id = pid.packages_itinerary_id_fk', 'inner')
//         ->where('pi.packages_id_fk', $package_id)
//         ->get()
//         ->result_array();

//     $map = array();

//     foreach ($rows as $r) {
//         $oldPkgDayId = (int)$r['packages_itinerary_days_id'];
//         $itinDayId   = (int)$r['itineraries_days_id_fk'];

//         if ($oldPkgDayId > 0 && $itinDayId > 0) {
//             $map[$oldPkgDayId] = $itinDayId;
//         }
//     }

//     return $map;
// }

// private function update_accommodation_plan_day_ids($oldPkgDayMap, $newPkgDayMap)
// {
//     if (empty($oldPkgDayMap) || empty($newPkgDayMap)) {
//         return;
//     }

//     foreach ($oldPkgDayMap as $oldPkgDayId => $itinDayId) {

//         $oldPkgDayId = (int)$oldPkgDayId;
//         $itinDayId   = (int)$itinDayId;

//         if ($oldPkgDayId <= 0 || $itinDayId <= 0) {
//             continue;
//         }

//         if (empty($newPkgDayMap[$itinDayId])) {
//             continue;
//         }

//         $newPkgDayId = (int)$newPkgDayMap[$itinDayId];

//         if ($newPkgDayId <= 0) {
//             continue;
//         }

//         $this->db->where('day_id_fk', $oldPkgDayId);
//         $this->db->update('accommodation_plan', array(
//             'day_id_fk' => $newPkgDayId
//         ));
//     }
// }

// private function delete_package_children($package_id)
// {
//     /* =============================
//        DELETE ITINERARY DAYS FIRST
//     ============================= */
//     $itRows = $this->db->select('packages_itinerary_id')
//         ->from('packages_itinerary')
//         ->where('packages_id_fk', $package_id)
//         ->get()
//         ->result_array();

//     $itineraryIds = array();
//     foreach ($itRows as $r) {
//         if (!empty($r['packages_itinerary_id'])) {
//             $itineraryIds[] = $r['packages_itinerary_id'];
//         }
//     }

//     if (!empty($itineraryIds)) {
//         $this->db->where_in('packages_itinerary_id_fk', $itineraryIds);
//         $this->db->delete('packages_itinerary_days');
//     }

//     $this->db->where('packages_id_fk', $package_id);
//     $this->db->delete('packages_itinerary');

//     /* =============================
//        OTHER SIMPLE CHILD TABLES
//     ============================= */
//     $this->db->where('packages_id_fk', $package_id)->delete('packages_inclusions');
//     $this->db->where('packages_id_fk', $package_id)->delete('packages_exclusions');

//     $this->db->where('packages_optional_add_on_packages_id_fk', $package_id)
//         ->delete('packages_optional_add_on');

//     $this->db->where('packages_special_requirements_packages_id_fk', $package_id)
//         ->delete('packages_special_requirements');

//     $this->db->where('packages_payment_policies_packages_id_fk', $package_id)
//         ->delete('packages_payment_policies');

//     $this->db->where('packages_terms_condition_packages_id_fk', $package_id)
//         ->delete('packages_terms_condition');

//     $this->db->where('packages_cancellation_policies_packages_id_fk', $package_id)
//         ->delete('packages_cancellation_policies');

//     $this->db->where('packages_notes_packages_id_fk', $package_id)
//         ->delete('packages_notes');

//     /* =============================
//        DELETE PROPERTY STRUCTURE
//     ============================= */
//     $commonRows = $this->db->select('packages_properties_common_id')
//         ->from('packages_properties_common')
//         ->where('packages_properties_common_packages_id_fk', $package_id)
//         ->get()
//         ->result_array();

//     $commonIds = array();
//     foreach ($commonRows as $r) {
//         if (!empty($r['packages_properties_common_id'])) {
//             $commonIds[] = $r['packages_properties_common_id'];
//         }
//     }

//     if (!empty($commonIds)) {

//         $dayRows = $this->db->select('packages_properties_days_id')
//             ->from('packages_properties_days')
//             ->where_in('packages_properties_common_id_fk', $commonIds)
//             ->get()
//             ->result_array();

//         $dayIds = array();
//         foreach ($dayRows as $r) {
//             if (!empty($r['packages_properties_days_id'])) {
//                 $dayIds[] = $r['packages_properties_days_id'];
//             }
//         }

//         if (!empty($dayIds)) {

//             $propRows = $this->db->select('packages_properties_id')
//                 ->from('packages_properties')
//                 ->where_in('packages_properties_days_id_fk', $dayIds)
//                 ->get()
//                 ->result_array();

//             $propIds = array();
//             foreach ($propRows as $r) {
//                 if (!empty($r['packages_properties_id'])) {
//                     $propIds[] = $r['packages_properties_id'];
//                 }
//             }

//             if (!empty($propIds)) {
//                 $this->db->where_in('packages_properties_id_fk', $propIds);
//                 $this->db->delete('packages_properties_rooms');
//             }

//             $this->db->where_in('packages_properties_days_id_fk', $dayIds);
//             $this->db->delete('packages_properties');
//         }

//         $this->db->where_in('packages_properties_common_id_fk', $commonIds);
//         $this->db->delete('packages_properties_days');
//     }

//     $this->db->where('packages_properties_common_packages_id_fk', $package_id);
//     $this->db->delete('packages_properties_common');
// }

// private function insert_children_for_package($package_id, $is_update)
// {
//     /* =============================
//        1) ITINERARY HEADER
//     ============================= */
//     $data_itinerary = array(
//         'packages_id_fk'            => $package_id,
//         'itineraries_id_fk'         => $this->input->post('packages_itinerary_id_fk'),
//         'packages_itinerary_status' => 1
//     );

//     $packages_itinerary_id = $this->General_model->add_returnID(
//         $this->packages_itinerary,
//         $data_itinerary
//     );

//     if (!$packages_itinerary_id) {
//         return FALSE;
//     }

//     /* =============================
//        2) ITINERARY DAYS
//        REQUIRED STATUS SAVED HERE
//     ============================= */
//     $itineraries_days_id_fk                      = (array)$this->input->post('itineraries_days_id_fk');
//     $packages_itineraries_days_day               = (array)$this->input->post('packages_itineraries_days_day');
//     $packages_itineraries_days_destination_id_fk = (array)$this->input->post('packages_itineraries_days_destination_id_fk');
//     $packages_itineraries_days_title             = (array)$this->input->post('packages_itineraries_days_title');
//     $packages_itineraries_days_description       = (array)$this->input->post('packages_itineraries_days_description');
//     $travelBackArr                               = (array)$this->input->post('packages_itineraries_days_travel_back');
//     $requiredStatusArr                           = (array)$this->input->post('packages_itineraries_days_required_status');
//     $defaultImages                               = (array)$this->input->post('default_itinerary_day_image');

//     $pkgDayMap      = array(); // itineraries_days_id => packages_itinerary_days_id
//     $dayNoMap       = array(); // itineraries_days_id => day no
//     $dayTBMap       = array(); // itineraries_days_id => TB or ''
//     $dayReqStatMap  = array(); // itineraries_days_id => 1 or 2

//     foreach ($itineraries_days_id_fk as $k => $itinDayId) {

//         $itinDayId = (int)$itinDayId;
//         if (!$itinDayId) {
//             continue;
//         }

//         $dayNo = isset($packages_itineraries_days_day[$k]) ? $packages_itineraries_days_day[$k] : ($k + 1);
//         $image = '';

//         if (!empty($_FILES['packages_itineraries_days_image_file']['name'][$k])) {

//             $_FILES['tmp_day_image'] = array(
//                 'name'     => $_FILES['packages_itineraries_days_image_file']['name'][$k],
//                 'type'     => $_FILES['packages_itineraries_days_image_file']['type'][$k],
//                 'tmp_name' => $_FILES['packages_itineraries_days_image_file']['tmp_name'][$k],
//                 'error'    => $_FILES['packages_itineraries_days_image_file']['error'][$k],
//                 'size'     => $_FILES['packages_itineraries_days_image_file']['size'][$k]
//             );

//             $up = $this->upload_day_image('tmp_day_image');

//             if (isset($up['ok']) && $up['ok']) {
//                 $image = $up['file'];
//             } else {
//                 $defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';
//                 $copied = $this->copy_default_day_image_to_package($defaultName);
//                 $image = $copied ? $copied : $defaultName;
//             }

//         } else {
//             $defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';
//             $copied = $this->copy_default_day_image_to_package($defaultName);
//             $image = $copied ? $copied : $defaultName;
//         }

//         $tbVal = isset($travelBackArr[$k]) ? $travelBackArr[$k] : '';

//         $requiredStatus = 0;
//         if ($tbVal === 'TB') {
//             $requiredStatus = isset($requiredStatusArr[$k]) ? (int)$requiredStatusArr[$k] : 1;
//             if ($requiredStatus !== 2) {
//                 $requiredStatus = 1;
//             }
//         }

//         $data_day = array(
//             'packages_itinerary_id_fk'                    => $packages_itinerary_id,
//             'itineraries_days_id_fk'                      => $itinDayId,
//             'packages_itineraries_days_day'               => $dayNo,
//             'packages_itineraries_days_destination_id_fk' => isset($packages_itineraries_days_destination_id_fk[$k]) ? $packages_itineraries_days_destination_id_fk[$k] : '',
//             'packages_itineraries_days_title'             => isset($packages_itineraries_days_title[$k]) ? $packages_itineraries_days_title[$k] : '',
//             'packages_itineraries_days_description'       => isset($packages_itineraries_days_description[$k]) ? $packages_itineraries_days_description[$k] : '',
//             'packages_itineraries_days_travel_back'       => $tbVal,
//             'packages_itineraries_days_required_status'   => $requiredStatus,
//             'packages_itineraries_days_image'             => $image,
//             'packages_itinerary_days_status'              => 1
//         );

//         $pkgInsertedId = $this->General_model->add_returnID(
//             $this->packages_itinerary_days,
//             $data_day
//         );

//         if (!$pkgInsertedId) {
//             return FALSE;
//         }

//         $pkgDayMap[$itinDayId] = $pkgInsertedId;
//     }
//     /* =============================
//        3) INCLUSIONS
//     ============================= */
//     $packages_inclusion_exclusion_checked_type = $this->input->post('packages_inclusion_exclusion_checked_type');
//     $common_id                                 = $this->input->post('packages_inclusion_exclusion_common_id_fk');
//     $packages_inclusions_details               = (array)$this->input->post('packages_inclusions_details');

//     if ($packages_inclusion_exclusion_checked_type == 'Y') {
//         foreach ($packages_inclusions_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $this->General_model->add($this->packages_inclusions, array(
//                 'packages_id_fk'              => $package_id,
//                 'inclusion_common_id_fk'      => $common_id,
//                 'packages_inclusions_type'    => 'Y',
//                 'packages_inclusions_details' => $detail,
//                 'packages_inclusions_status'  => 1
//             ));
//         }
//     }

//     /* =============================
//        4) EXCLUSIONS
//     ============================= */
//     $packages_exclusions_details = (array)$this->input->post('packages_exclusions_details');

//     if ($packages_inclusion_exclusion_checked_type == 'Y') {
//         foreach ($packages_exclusions_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $this->General_model->add($this->packages_exclusions, array(
//                 'packages_id_fk'              => $package_id,
//                 'exclusions_common_id_fk'     => $common_id,
//                 'packages_exclusions_type'    => 'Y',
//                 'packages_exclusions_details' => $detail,
//                 'packages_exclusions_status'  => 1
//             ));
//         }
//     }

//     /* =============================
//        5) OPTIONAL ADD ON
//     ============================= */
//     $packages_optional_add_on_checked_type = $this->input->post('packages_optional_add_on_checked_type');
//     $packages_optional_add_on_details      = (array)$this->input->post('packages_optional_add_on_details');

//     if ($packages_optional_add_on_checked_type == 'Y') {
//         foreach ($packages_optional_add_on_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $this->General_model->add($this->packages_optional_add_on, array(
//                 'packages_optional_add_on_packages_id_fk' => $package_id,
//                 'packages_optional_add_on_details'        => $detail,
//                 'packages_optional_add_on_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        6) SPECIAL REQUIREMENTS
//     ============================= */
//     $packages_special_requirment_checked_type = $this->input->post('packages_special_requirment_checked_type');
//     $special_requirements_id_fk               = (array)$this->input->post('special_requirements_id_fk');
//     $packages_special_requirements_cost       = (array)$this->input->post('packages_special_requirements_cost');

//     if ($packages_special_requirment_checked_type == 'Y') {
//         foreach ($special_requirements_id_fk as $k => $sid) {
//             if (!$sid) continue;

//             $this->General_model->add($this->packages_special_requirements, array(
//                 'packages_special_requirements_packages_id_fk' => $package_id,
//                 'special_requirements_id_fk'                   => $sid,
//                 'packages_special_requirements_cost'           => isset($packages_special_requirements_cost[$k]) ? $packages_special_requirements_cost[$k] : '',
//                 'packages_special_requirements_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        7) PAYMENT POLICIES
//     ============================= */
//     $packages_payment_policies_checked_type = $this->input->post('packages_payment_policies_checked_type');
//     $payment_policies_id_fk                 = $this->input->post('payment_policies_id_fk');
//     $payment_policies_items_id_fk           = (array)$this->input->post('payment_policies_items_id_fk');
//     $packages_payment_policies_details      = (array)$this->input->post('packages_payment_policies_details');

//     if ($packages_payment_policies_checked_type == 'Y') {
//         foreach ($packages_payment_policies_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $itemId = isset($payment_policies_items_id_fk[$k]) ? $payment_policies_items_id_fk[$k] : '';

//             $this->General_model->add($this->packages_payment_policies, array(
//                 'packages_payment_policies_packages_id_fk' => $package_id,
//                 'payment_policies_id_fk'                   => $payment_policies_id_fk,
//                 'payment_policies_items_id_fk'             => $itemId,
//                 'packages_payment_policies_type'           => 'Y',
//                 'packages_payment_policies_details'        => $detail,
//                 'packages_payment_policies_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        8) TERMS
//     ============================= */
//     $packages_terms_conditions_checked_type = $this->input->post('packages_terms_conditions_checked_type');
//     $terms_condition_id_fk                  = $this->input->post('terms_condition_id_fk');
//     $terms_condition_item_id_fk             = (array)$this->input->post('terms_condition_item_id_fk');
//     $packages_terms_condition_details       = (array)$this->input->post('packages_terms_condition_details');

//     if ($packages_terms_conditions_checked_type == 'Y') {
//         foreach ($packages_terms_condition_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $itemId = isset($terms_condition_item_id_fk[$k]) ? $terms_condition_item_id_fk[$k] : '';

//             $this->General_model->add($this->packages_terms_condition, array(
//                 'packages_terms_condition_packages_id_fk' => $package_id,
//                 'terms_condition_id_fk'                   => $terms_condition_id_fk,
//                 'terms_condition_item_id_fk'              => $itemId,
//                 'packages_terms_condition_type'           => 'Y',
//                 'packages_terms_condition_details'        => $detail,
//                 'packages_terms_condition_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        9) CANCELLATION
//     ============================= */
//     $packages_cancellation_policy_checked_type = $this->input->post('packages_cancellation_policy_checked_type');
//     $cancellation_policies_id_fk               = $this->input->post('cancellation_policies_id_fk');
//     $cancellation_policies_item_id_fk          = (array)$this->input->post('cancellation_policies_item_id_fk');
//     $packages_cancellation_policies_details    = (array)$this->input->post('packages_cancellation_policies_details');

//     if ($packages_cancellation_policy_checked_type == 'Y') {
//         foreach ($packages_cancellation_policies_details as $k => $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $itemId = isset($cancellation_policies_item_id_fk[$k]) ? $cancellation_policies_item_id_fk[$k] : '';

//             $this->General_model->add($this->packages_cancellation_policies, array(
//                 'packages_cancellation_policies_packages_id_fk' => $package_id,
//                 'cancellation_policies_id_fk'                   => $cancellation_policies_id_fk,
//                 'cancellation_policies_item_id_fk'              => $itemId,
//                 'packages_cancellation_policies_type'           => 'Y',
//                 'packages_cancellation_policies_details'        => $detail,
//                 'packages_cancellation_policies_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//        10) NOTES
//     ============================= */
//     $packages_notes_checked_type = $this->input->post('packages_notes_checked_type');
//     $packages_notes_details      = (array)$this->input->post('packages_notes_details');

//     if ($packages_notes_checked_type == 'Y') {
//         foreach ($packages_notes_details as $detail) {
//             $detail = trim((string)$detail);
//             if ($detail === '') continue;

//             $this->General_model->add($this->packages_notes, array(
//                 'packages_notes_packages_id_fk' => $package_id,
//                 'packages_notes_details'        => $detail,
//                 'packages_notes_status'         => 1
//             ));
//         }
//     }

//     /* =============================
//     11) PROPERTIES
//     ============================= */
//     $packages_property_checked_type = $this->input->post('packages_property_checked_type');

//     if ($packages_property_checked_type === 'Y') {

//         $category_names      = (array)$this->input->post('property_category_name');
//         $design_types        = (array)$this->input->post('packages_properties_common_design_type');
//         $destinations_by_sec = (array)$this->input->post('property_destination_id');
//         $properties_by_sec   = (array)$this->input->post('properties_id');
//         $rooms_by_sec        = (array)$this->input->post('rooms_id');

//         foreach ($category_names as $secIndex => $categoryName) {

//             $categoryName = trim((string)$categoryName);
//             if ($categoryName === '') {
//                 continue;
//             }

//             $designType = isset($design_types[$secIndex]) ? trim((string)$design_types[$secIndex]) : '';

//             $common_id = $this->General_model->add_returnID(
//                 $this->packages_properties_common,
//                 array(
//                     'packages_properties_common_packages_id_fk' => $package_id,
//                     'packages_properties_common_category_name'  => $categoryName,
//                     'packages_properties_common_design_type'    => $designType,
//                     'packages_properties_common_status'         => 1
//                 )
//             );

//             if (!$common_id) {
//                 return FALSE;
//             }

//             if (empty($destinations_by_sec[$secIndex]) || !is_array($destinations_by_sec[$secIndex])) {
//                 continue;
//             }

//             foreach ($destinations_by_sec[$secIndex] as $itinDayId => $destId) {

//                 $itinDayId = (int)$itinDayId;
//                 if (!$itinDayId || !$destId) {
//                     continue;
//                 }

//                 $pkgItineraryDaysIdFk = isset($pkgDayMap[$itinDayId]) ? $pkgDayMap[$itinDayId] : 0;
//                 if (!$pkgItineraryDaysIdFk) {
//                     continue;
//                 }

//                 // find posted day text + TB flag from itinerary arrays
//                 $dayNo = '';
//                 $tbVal = '';

//                 foreach ($itineraries_days_id_fk as $kk => $postedItinDayId) {
//                     if ((int)$postedItinDayId === $itinDayId) {
//                         $dayNo = isset($packages_itineraries_days_day[$kk]) ? $packages_itineraries_days_day[$kk] : '';
//                         $tbVal = (isset($travelBackArr[$kk]) && $travelBackArr[$kk] === 'TB') ? 'TB' : '';
//                         break;
//                     }
//                 }

//                 $day_id = $this->General_model->add_returnID(
//                     $this->packages_properties_days,
//                     array(
//                         'packages_properties_common_id_fk'           => $common_id,
//                         'packages_itinerary_days_id_fk'              => $pkgItineraryDaysIdFk,
//                         'packages_properties_days_day'               => $dayNo,
//                         'packages_properties_days_destination_id_fk' => $destId,
//                         'packages_properties_days_travel_back'       => $tbVal,
//                         'packages_properties_days_status'            => 1
//                     )
//                 );

//                 if (!$day_id) {
//                     return FALSE;
//                 }

//                 // if no property rows selected for this day, keep only day row saved
//                 if (empty($properties_by_sec[$secIndex][$itinDayId]) || !is_array($properties_by_sec[$secIndex][$itinDayId])) {
//                     continue;
//                 }

//                 foreach ($properties_by_sec[$secIndex][$itinDayId] as $rowKey => $propertyId) {

//                     $propertyId = trim((string)$propertyId);
//                     if ($propertyId === '') {
//                         continue;
//                     }

//                     $packages_properties_id = $this->General_model->add_returnID(
//                         $this->packages_properties,
//                         array(
//                             'packages_properties_days_id_fk' => $day_id,
//                             'properties_id_fk'               => $propertyId,
//                             'packages_properties_status'     => 1
//                         )
//                     );

//                     if (!$packages_properties_id) {
//                         return FALSE;
//                     }

//                     if (!empty($rooms_by_sec[$secIndex][$itinDayId][$rowKey]) && is_array($rooms_by_sec[$secIndex][$itinDayId][$rowKey])) {
//                         foreach ($rooms_by_sec[$secIndex][$itinDayId][$rowKey] as $roomId) {

//                             $roomId = trim((string)$roomId);
//                             if ($roomId === '') {
//                                 continue;
//                             }

//                             $okRoom = $this->General_model->add(
//                                 $this->packages_properties_rooms,
//                                 array(
//                                     'packages_properties_id_fk'        => $packages_properties_id,
//                                     'packages_properties_rooms_id_fk'  => $roomId,
//                                     'packages_properties_rooms_status' => 1
//                                 )
//                             );

//                             if (!$okRoom) {
//                                 return FALSE;
//                             }
//                         }
//                     }
//                 }
//             }
//         }
//     }
//     // return TRUE;
//     return array(
//         'status'   => TRUE,
//         'pkgDayMap' => $pkgDayMap
//     );
// }

public function ajax_add()
{
    if (method_exists($this, '_ajax_add_validate')) {
        $this->_ajax_add_validate();
    }

    $this->db->trans_begin();

    if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }

    $date = date('Y-m-d');
    $time = date('h:i:sa');

    $currentuserid   = $this->session->userdata('user_id');
    $currentusername = $this->session->userdata('admin_name');

    /* =========================================================
       0) SAVE / COPY COVER PAGE IMAGES
    ========================================================= */
    $packages_first_cover_page = '';
    $packages_last_cover_page  = '';

    if (!empty($_FILES['packages_first_cover_page']['name'])) {

        $up1 = $this->upload_package_cover_image('packages_first_cover_page');

        if (!isset($up1['ok']) || !$up1['ok']) {
            $this->db->trans_rollback();
            echo json_encode(array(
                'status'  => FALSE,
                'message' => isset($up1['message']) ? $up1['message'] : 'First cover page upload failed'
            ));
            return;
        }

        $packages_first_cover_page = $up1['file'];

    } else {

        $defaultFirst = trim((string)$this->input->post('packages_first_cover_page_txt'));
        if ($defaultFirst !== '') {
            $copiedFirst = $this->copy_itinerary_cover_to_package_cover($defaultFirst);
            $packages_first_cover_page = $copiedFirst ? $copiedFirst : $defaultFirst;
        }
    }

    if (!empty($_FILES['packages_last_cover_page']['name'])) {

        $up2 = $this->upload_package_cover_image('packages_last_cover_page');

        if (!isset($up2['ok']) || !$up2['ok']) {
            $this->db->trans_rollback();
            echo json_encode(array(
                'status'  => FALSE,
                'message' => isset($up2['message']) ? $up2['message'] : 'Last cover page upload failed'
            ));
            return;
        }

        $packages_last_cover_page = $up2['file'];

    } else {

        $defaultLast = trim((string)$this->input->post('packages_last_cover_page_txt'));
        if ($defaultLast !== '') {
            $copiedLast = $this->copy_itinerary_cover_to_package_cover($defaultLast);
            $packages_last_cover_page = $copiedLast ? $copiedLast : $defaultLast;
        }
    }

    /* =========================================================
       1) PACKAGE MASTER
    ========================================================= */
    $data = array(
        'packages_category_id_fk'                   => $this->input->post('packages_category_id_fk'),
        'packages_itinerary_category_id_fk'         => $this->input->post('packages_itinerary_category_id_fk'),
        'packages_itinerary_id_fk'                  => $this->input->post('packages_itinerary_id_fk'),

        'packages_inclusion_exclusion_common_id_fk' => $this->input->post('packages_inclusion_exclusion_common_id_fk'),
        'packages_inclusion_exclusion_checked_type' => $this->input->post('packages_inclusion_exclusion_checked_type'),

        'packages_optional_add_on_checked_type'     => $this->input->post('packages_optional_add_on_checked_type'),
        'packages_special_requirment_checked_type'  => $this->input->post('packages_special_requirment_checked_type'),
        'packages_payment_policies_checked_type'    => $this->input->post('packages_payment_policies_checked_type'),
        'packages_terms_conditions_checked_type'    => $this->input->post('packages_terms_conditions_checked_type'),
        'packages_cancellation_policy_checked_type' => $this->input->post('packages_cancellation_policy_checked_type'),
        'packages_notes_checked_type'               => $this->input->post('packages_notes_checked_type'),
        'packages_property_checked_type'            => $this->input->post('packages_property_checked_type'),

        'packages_title'                            => $this->input->post('packages_title'),
        'packages_duration_in_nights'               => $this->input->post('packages_duration_in_nights'),
        'packages_description'                      => $this->input->post('packages_description'),

        'packages_first_cover_page'                 => $packages_first_cover_page,
        'packages_last_cover_page'                  => $packages_last_cover_page,

        'packages_createdby_user_id'                => $currentuserid,
        'packages_createdby_user_name'              => $currentusername,
        'packages_created_date'                     => $date,
        'packages_created_time'                     => $time,
        'packages_status'                           => 1
    );

    $packages_id = $this->Packages_model->save($data);

    if (!$packages_id) {
        $this->db->trans_rollback();
        echo json_encode(array('status' => FALSE, 'message' => 'Package insert failed'));
        return;
    }

    $insertRes = $this->insert_children_for_package($packages_id, FALSE);

    if (!$insertRes || empty($insertRes['status'])) {
        $this->db->trans_rollback();
        echo json_encode(array('status' => FALSE, 'message' => 'Failed while saving child data'));
        return;
    }

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        echo json_encode(array('status' => FALSE, 'message' => 'Database error while saving package'));
        return;
    }

    $this->db->trans_commit();
    echo json_encode(array('status' => TRUE));
}

public function ajax_update()
{
    if (method_exists($this, '_ajax_add_validate')) {
        $this->_ajax_add_validate();
    }

    $id = (int)$this->input->post('packages_id');

    if (!$id) {
        echo json_encode(array('status' => FALSE, 'message' => 'Invalid package ID'));
        return;
    }

    $this->db->trans_begin();

    if (function_exists('date_default_timezone_set')) {
        date_default_timezone_set("Asia/Kolkata");
    }

    /* =========================================================
       0) SAVE / KEEP COVER PAGE IMAGES
    ========================================================= */
    $packages_first_cover_page = '';
    $packages_last_cover_page  = '';

    if (!empty($_FILES['packages_first_cover_page']['name'])) {

        $up1 = $this->upload_package_cover_image('packages_first_cover_page');

        if (!isset($up1['ok']) || !$up1['ok']) {
            $this->db->trans_rollback();
            echo json_encode(array(
                'status'  => FALSE,
                'message' => isset($up1['message']) ? $up1['message'] : 'First cover page upload failed'
            ));
            return;
        }

        $packages_first_cover_page = $up1['file'];

    } else {
        $packages_first_cover_page = trim((string)$this->input->post('packages_first_cover_page_txt'));
    }

    if (!empty($_FILES['packages_last_cover_page']['name'])) {

        $up2 = $this->upload_package_cover_image('packages_last_cover_page');

        if (!isset($up2['ok']) || !$up2['ok']) {
            $this->db->trans_rollback();
            echo json_encode(array(
                'status'  => FALSE,
                'message' => isset($up2['message']) ? $up2['message'] : 'Last cover page upload failed'
            ));
            return;
        }

        $packages_last_cover_page = $up2['file'];

    } else {
        $packages_last_cover_page = trim((string)$this->input->post('packages_last_cover_page_txt'));
    }

    /* =========================================================
       1) GET OLD ITINERARY IDS + OLD PACKAGE DAY MAP
    ========================================================= */
    $oldItineraryIds = $this->get_old_package_itinerary_ids($id);
    $oldPkgDayMap    = $this->get_old_package_day_map($id);

    /* =========================================================
       2) CHECK accommodation_plan EXISTS FOR THIS PACKAGE
    ========================================================= */
    $hasAccommodationRows = $this->package_has_accommodation_rows($id);

    /* =========================================================
       3) UPDATE PACKAGE MASTER
    ========================================================= */
    $data = array(
        'packages_category_id_fk'                   => $this->input->post('packages_category_id_fk'),
        'packages_itinerary_category_id_fk'         => $this->input->post('packages_itinerary_category_id_fk'),
        'packages_itinerary_id_fk'                  => $this->input->post('packages_itinerary_id_fk'),

        'packages_inclusion_exclusion_common_id_fk' => $this->input->post('packages_inclusion_exclusion_common_id_fk'),
        'packages_inclusion_exclusion_checked_type' => $this->input->post('packages_inclusion_exclusion_checked_type'),

        'packages_optional_add_on_checked_type'     => $this->input->post('packages_optional_add_on_checked_type'),
        'packages_special_requirment_checked_type'  => $this->input->post('packages_special_requirment_checked_type'),
        'packages_payment_policies_checked_type'    => $this->input->post('packages_payment_policies_checked_type'),
        'packages_terms_conditions_checked_type'    => $this->input->post('packages_terms_conditions_checked_type'),
        'packages_cancellation_policy_checked_type' => $this->input->post('packages_cancellation_policy_checked_type'),
        'packages_notes_checked_type'               => $this->input->post('packages_notes_checked_type'),
        'packages_property_checked_type'            => $this->input->post('packages_property_checked_type'),

        'packages_title'                            => $this->input->post('packages_title'),
        'packages_duration_in_nights'               => $this->input->post('packages_duration_in_nights'),
        'packages_description'                      => $this->input->post('packages_description'),

        'packages_first_cover_page'                 => $packages_first_cover_page,
        'packages_last_cover_page'                  => $packages_last_cover_page
    );

    $this->db->where('packages_id', $id);
    $this->db->update('packages', $data);

    /* =========================================================
       4) DELETE ALL CHILD DATA EXCEPT OLD ITINERARY / OLD DAYS
    ========================================================= */
    $this->delete_package_children_except_itinerary($id);

    /* =========================================================
       5) INSERT NEW ITINERARY + NEW CHILD DATA
    ========================================================= */
    $insertRes = $this->insert_children_for_package($id, TRUE);

    if (!$insertRes || empty($insertRes['status'])) {
        $this->db->trans_rollback();
        echo json_encode(array('status' => FALSE, 'message' => 'Failed while updating child data'));
        return;
    }

    $newPkgDayMap     = !empty($insertRes['pkgDayMap']) ? $insertRes['pkgDayMap'] : array();
    $newItineraryId   = !empty($insertRes['packages_itinerary_id']) ? (int)$insertRes['packages_itinerary_id'] : 0;

    /* =========================================================
       6) UPDATE accommodation_plan.day_id_fk ONLY IF PACKAGE EXISTS
    ========================================================= */
    if ($hasAccommodationRows) {
        $this->update_accommodation_plan_day_ids($id, $oldPkgDayMap, $newPkgDayMap);
    }

    /* =========================================================
       7) NOW DELETE OLD ITINERARY / OLD DAYS
    ========================================================= */
    $this->delete_old_package_itinerary_rows($oldItineraryIds, $newItineraryId);

    if ($this->db->trans_status() === FALSE) {
        $this->db->trans_rollback();
        echo json_encode(array('status' => FALSE, 'message' => 'Update failed'));
        return;
    }

    $this->db->trans_commit();
    echo json_encode(array('status' => TRUE));
}

private function package_has_accommodation_rows($package_id)
{
    $package_id = (int)$package_id;

    if ($package_id <= 0) {
        return FALSE;
    }

    $cnt = $this->db->from('accommodation_plan')
        ->where('pacakage_id_fk', $package_id)
        ->count_all_results();

    return ($cnt > 0);
}

private function get_old_package_itinerary_ids($package_id)
{
    $rows = $this->db->select('packages_itinerary_id')
        ->from('packages_itinerary')
        ->where('packages_id_fk', $package_id)
        ->get()
        ->result_array();

    $ids = array();

    foreach ($rows as $r) {
        if (!empty($r['packages_itinerary_id'])) {
            $ids[] = (int)$r['packages_itinerary_id'];
        }
    }

    return $ids;
}

private function get_old_package_day_map($package_id)
{
    $rows = $this->db->select('pid.packages_itinerary_days_id, pid.itineraries_days_id_fk')
        ->from('packages_itinerary_days pid')
        ->join('packages_itinerary pi', 'pi.packages_itinerary_id = pid.packages_itinerary_id_fk', 'inner')
        ->where('pi.packages_id_fk', $package_id)
        ->get()
        ->result_array();

    $map = array();

    foreach ($rows as $r) {
        $oldPkgDayId = (int)$r['packages_itinerary_days_id'];
        $itinDayId   = (int)$r['itineraries_days_id_fk'];

        if ($oldPkgDayId > 0 && $itinDayId > 0) {
            $map[$oldPkgDayId] = $itinDayId;
        }
    }

    return $map;
}

private function update_accommodation_plan_day_ids($package_id, $oldPkgDayMap, $newPkgDayMap)
{
    $package_id = (int)$package_id;

    if ($package_id <= 0 || empty($oldPkgDayMap) || empty($newPkgDayMap)) {
        return;
    }

    foreach ($oldPkgDayMap as $oldPkgDayId => $itinDayId) {

        $oldPkgDayId = (int)$oldPkgDayId;
        $itinDayId   = (int)$itinDayId;

        if ($oldPkgDayId <= 0 || $itinDayId <= 0) {
            continue;
        }

        if (empty($newPkgDayMap[$itinDayId])) {
            continue;
        }

        $newPkgDayId = (int)$newPkgDayMap[$itinDayId];
        if ($newPkgDayId <= 0) {
            continue;
        }

        $this->db->where('pacakage_id_fk', $package_id);
        $this->db->where('day_id_fk', $oldPkgDayId);
        $this->db->update('accommodation_plan', array(
            'day_id_fk' => $newPkgDayId
        ));
    }
}

private function delete_package_children_except_itinerary($package_id)
{
    /* =============================
       OTHER SIMPLE CHILD TABLES
    ============================= */
    $this->db->where('packages_id_fk', $package_id)->delete('packages_inclusions');
    $this->db->where('packages_id_fk', $package_id)->delete('packages_exclusions');

    $this->db->where('packages_optional_add_on_packages_id_fk', $package_id)
        ->delete('packages_optional_add_on');

    $this->db->where('packages_special_requirements_packages_id_fk', $package_id)
        ->delete('packages_special_requirements');

    $this->db->where('packages_payment_policies_packages_id_fk', $package_id)
        ->delete('packages_payment_policies');

    $this->db->where('packages_terms_condition_packages_id_fk', $package_id)
        ->delete('packages_terms_condition');

    $this->db->where('packages_cancellation_policies_packages_id_fk', $package_id)
        ->delete('packages_cancellation_policies');

    $this->db->where('packages_notes_packages_id_fk', $package_id)
        ->delete('packages_notes');

    /* =============================
       DELETE PROPERTY STRUCTURE
    ============================= */
    $commonRows = $this->db->select('packages_properties_common_id')
        ->from('packages_properties_common')
        ->where('packages_properties_common_packages_id_fk', $package_id)
        ->get()
        ->result_array();

    $commonIds = array();
    foreach ($commonRows as $r) {
        if (!empty($r['packages_properties_common_id'])) {
            $commonIds[] = (int)$r['packages_properties_common_id'];
        }
    }

    if (!empty($commonIds)) {

        $dayRows = $this->db->select('packages_properties_days_id')
            ->from('packages_properties_days')
            ->where_in('packages_properties_common_id_fk', $commonIds)
            ->get()
            ->result_array();

        $dayIds = array();
        foreach ($dayRows as $r) {
            if (!empty($r['packages_properties_days_id'])) {
                $dayIds[] = (int)$r['packages_properties_days_id'];
            }
        }

        if (!empty($dayIds)) {

            $propRows = $this->db->select('packages_properties_id')
                ->from('packages_properties')
                ->where_in('packages_properties_days_id_fk', $dayIds)
                ->get()
                ->result_array();

            $propIds = array();
            foreach ($propRows as $r) {
                if (!empty($r['packages_properties_id'])) {
                    $propIds[] = (int)$r['packages_properties_id'];
                }
            }

            if (!empty($propIds)) {
                $this->db->where_in('packages_properties_id_fk', $propIds);
                $this->db->delete('packages_properties_rooms');
            }

            $this->db->where_in('packages_properties_days_id_fk', $dayIds);
            $this->db->delete('packages_properties');
        }

        $this->db->where_in('packages_properties_common_id_fk', $commonIds);
        $this->db->delete('packages_properties_days');
    }

    $this->db->where('packages_properties_common_packages_id_fk', $package_id);
    $this->db->delete('packages_properties_common');
}

private function delete_old_package_itinerary_rows($oldItineraryIds, $keepItineraryId)
{
    $keepItineraryId = (int)$keepItineraryId;

    if (empty($oldItineraryIds)) {
        return;
    }

    $deleteIds = array();

    foreach ($oldItineraryIds as $oldId) {
        $oldId = (int)$oldId;
        if ($oldId > 0 && $oldId !== $keepItineraryId) {
            $deleteIds[] = $oldId;
        }
    }

    if (empty($deleteIds)) {
        return;
    }

    $this->db->where_in('packages_itinerary_id_fk', $deleteIds);
    $this->db->delete('packages_itinerary_days');

    $this->db->where_in('packages_itinerary_id', $deleteIds);
    $this->db->delete('packages_itinerary');
}

// private function insert_children_for_package($package_id, $is_update)
// {
//     /* =============================
//        1) ITINERARY HEADER
//     ============================= */
//     $data_itinerary = array(
//         'packages_id_fk'            => $package_id,
//         'itineraries_id_fk'         => $this->input->post('packages_itinerary_id_fk'),
//         'packages_itinerary_status' => 1
//     );

//     $packages_itinerary_id = $this->General_model->add_returnID(
//         $this->packages_itinerary,
//         $data_itinerary
//     );

//     if (!$packages_itinerary_id) {
//         return FALSE;
//     }

//         return array(
//         'status'                => TRUE,
//         'packages_itinerary_id' => $packages_itinerary_id,
//         'pkgDayMap'             => $pkgDayMap
//     );
// }

private function insert_children_for_package($package_id, $is_update)
{
    /* =============================
       1) ITINERARY HEADER
    ============================= */
    $data_itinerary = array(
        'packages_id_fk'            => $package_id,
        'itineraries_id_fk'         => $this->input->post('packages_itinerary_id_fk'),
        'packages_itinerary_status' => 1
    );

    $packages_itinerary_id = $this->General_model->add_returnID(
        $this->packages_itinerary,
        $data_itinerary
    );

    if (!$packages_itinerary_id) {
        return FALSE;
    }

    /* =============================
       2) ITINERARY DAYS
       REQUIRED STATUS SAVED HERE
    ============================= */
    $itineraries_days_id_fk                      = (array)$this->input->post('itineraries_days_id_fk');
    $packages_itineraries_days_day               = (array)$this->input->post('packages_itineraries_days_day');
    $packages_itineraries_days_destination_id_fk = (array)$this->input->post('packages_itineraries_days_destination_id_fk');
    $packages_itineraries_days_title             = (array)$this->input->post('packages_itineraries_days_title');
    $packages_itineraries_days_description       = (array)$this->input->post('packages_itineraries_days_description');
    $travelBackArr                               = (array)$this->input->post('packages_itineraries_days_travel_back');
    $requiredStatusArr                           = (array)$this->input->post('packages_itineraries_days_required_status');
    $defaultImages                               = (array)$this->input->post('default_itinerary_day_image');

    $pkgDayMap      = array(); // itineraries_days_id => packages_itinerary_days_id
    $dayNoMap       = array(); // itineraries_days_id => day no
    $dayTBMap       = array(); // itineraries_days_id => TB or ''
    $dayReqStatMap  = array(); // itineraries_days_id => 1 or 2

    foreach ($itineraries_days_id_fk as $k => $itinDayId) {

        $itinDayId = (int)$itinDayId;
        if (!$itinDayId) {
            continue;
        }

        $dayNo = isset($packages_itineraries_days_day[$k]) ? $packages_itineraries_days_day[$k] : ($k + 1);
        $image = '';

        if (!empty($_FILES['packages_itineraries_days_image_file']['name'][$k])) {

            $_FILES['tmp_day_image'] = array(
                'name'     => $_FILES['packages_itineraries_days_image_file']['name'][$k],
                'type'     => $_FILES['packages_itineraries_days_image_file']['type'][$k],
                'tmp_name' => $_FILES['packages_itineraries_days_image_file']['tmp_name'][$k],
                'error'    => $_FILES['packages_itineraries_days_image_file']['error'][$k],
                'size'     => $_FILES['packages_itineraries_days_image_file']['size'][$k]
            );

            $up = $this->upload_day_image('tmp_day_image');

            if (isset($up['ok']) && $up['ok']) {
                $image = $up['file'];
            } else {
                $defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';
                $copied = $this->copy_default_day_image_to_package($defaultName);
                $image = $copied ? $copied : $defaultName;
            }

        } else {
            $defaultName = isset($defaultImages[$k]) ? $defaultImages[$k] : '';
            $copied = $this->copy_default_day_image_to_package($defaultName);
            $image = $copied ? $copied : $defaultName;
        }

        $tbVal = isset($travelBackArr[$k]) ? $travelBackArr[$k] : '';

        $requiredStatus = 0;
        if ($tbVal === 'TB') {
            $requiredStatus = isset($requiredStatusArr[$k]) ? (int)$requiredStatusArr[$k] : 1;
            if ($requiredStatus !== 2) {
                $requiredStatus = 1;
            }
        }

        $data_day = array(
            'packages_itinerary_id_fk'                    => $packages_itinerary_id,
            'itineraries_days_id_fk'                      => $itinDayId,
            'packages_itineraries_days_day'               => $dayNo,
            'packages_itineraries_days_destination_id_fk' => isset($packages_itineraries_days_destination_id_fk[$k]) ? $packages_itineraries_days_destination_id_fk[$k] : '',
            'packages_itineraries_days_title'             => isset($packages_itineraries_days_title[$k]) ? $packages_itineraries_days_title[$k] : '',
            'packages_itineraries_days_description'       => isset($packages_itineraries_days_description[$k]) ? $packages_itineraries_days_description[$k] : '',
            'packages_itineraries_days_travel_back'       => $tbVal,
            'packages_itineraries_days_required_status'   => $requiredStatus,
            'packages_itineraries_days_image'             => $image,
            'packages_itinerary_days_status'              => 1
        );

        $pkgInsertedId = $this->General_model->add_returnID(
            $this->packages_itinerary_days,
            $data_day
        );

        if (!$pkgInsertedId) {
            return FALSE;
        }

        $pkgDayMap[$itinDayId] = $pkgInsertedId;
    }
    /* =============================
       3) INCLUSIONS
    ============================= */
    $packages_inclusion_exclusion_checked_type = $this->input->post('packages_inclusion_exclusion_checked_type');
    $common_id                                 = $this->input->post('packages_inclusion_exclusion_common_id_fk');
    $packages_inclusions_details               = (array)$this->input->post('packages_inclusions_details');

    if ($packages_inclusion_exclusion_checked_type == 'Y') {
        foreach ($packages_inclusions_details as $detail) {
            $detail = trim((string)$detail);
            if ($detail === '') continue;

            $this->General_model->add($this->packages_inclusions, array(
                'packages_id_fk'              => $package_id,
                'inclusion_common_id_fk'      => $common_id,
                'packages_inclusions_type'    => 'Y',
                'packages_inclusions_details' => $detail,
                'packages_inclusions_status'  => 1
            ));
        }
    }

    /* =============================
       4) EXCLUSIONS
    ============================= */
    $packages_exclusions_details = (array)$this->input->post('packages_exclusions_details');

    if ($packages_inclusion_exclusion_checked_type == 'Y') {
        foreach ($packages_exclusions_details as $detail) {
            $detail = trim((string)$detail);
            if ($detail === '') continue;

            $this->General_model->add($this->packages_exclusions, array(
                'packages_id_fk'              => $package_id,
                'exclusions_common_id_fk'     => $common_id,
                'packages_exclusions_type'    => 'Y',
                'packages_exclusions_details' => $detail,
                'packages_exclusions_status'  => 1
            ));
        }
    }

    /* =============================
       5) OPTIONAL ADD ON
    ============================= */
    $packages_optional_add_on_checked_type = $this->input->post('packages_optional_add_on_checked_type');
    $packages_optional_add_on_details      = (array)$this->input->post('packages_optional_add_on_details');

    if ($packages_optional_add_on_checked_type == 'Y') {
        foreach ($packages_optional_add_on_details as $detail) {
            $detail = trim((string)$detail);
            if ($detail === '') continue;

            $this->General_model->add($this->packages_optional_add_on, array(
                'packages_optional_add_on_packages_id_fk' => $package_id,
                'packages_optional_add_on_details'        => $detail,
                'packages_optional_add_on_status'         => 1
            ));
        }
    }

    /* =============================
       6) SPECIAL REQUIREMENTS
    ============================= */
    $packages_special_requirment_checked_type = $this->input->post('packages_special_requirment_checked_type');
    $special_requirements_id_fk               = (array)$this->input->post('special_requirements_id_fk');
    $packages_special_requirements_cost       = (array)$this->input->post('packages_special_requirements_cost');

    if ($packages_special_requirment_checked_type == 'Y') {
        foreach ($special_requirements_id_fk as $k => $sid) {
            if (!$sid) continue;

            $this->General_model->add($this->packages_special_requirements, array(
                'packages_special_requirements_packages_id_fk' => $package_id,
                'special_requirements_id_fk'                   => $sid,
                'packages_special_requirements_cost'           => isset($packages_special_requirements_cost[$k]) ? $packages_special_requirements_cost[$k] : '',
                'packages_special_requirements_status'         => 1
            ));
        }
    }

    /* =============================
       7) PAYMENT POLICIES
    ============================= */
    $packages_payment_policies_checked_type = $this->input->post('packages_payment_policies_checked_type');
    $payment_policies_id_fk                 = $this->input->post('payment_policies_id_fk');
    $payment_policies_items_id_fk           = (array)$this->input->post('payment_policies_items_id_fk');
    $packages_payment_policies_details      = (array)$this->input->post('packages_payment_policies_details');

    if ($packages_payment_policies_checked_type == 'Y') {
        foreach ($packages_payment_policies_details as $k => $detail) {
            $detail = trim((string)$detail);
            if ($detail === '') continue;

            $itemId = isset($payment_policies_items_id_fk[$k]) ? $payment_policies_items_id_fk[$k] : '';

            $this->General_model->add($this->packages_payment_policies, array(
                'packages_payment_policies_packages_id_fk' => $package_id,
                'payment_policies_id_fk'                   => $payment_policies_id_fk,
                'payment_policies_items_id_fk'             => $itemId,
                'packages_payment_policies_type'           => 'Y',
                'packages_payment_policies_details'        => $detail,
                'packages_payment_policies_status'         => 1
            ));
        }
    }

    /* =============================
       8) TERMS
    ============================= */
    $packages_terms_conditions_checked_type = $this->input->post('packages_terms_conditions_checked_type');
    $terms_condition_id_fk                  = $this->input->post('terms_condition_id_fk');
    $terms_condition_item_id_fk             = (array)$this->input->post('terms_condition_item_id_fk');
    $packages_terms_condition_details       = (array)$this->input->post('packages_terms_condition_details');

    if ($packages_terms_conditions_checked_type == 'Y') {
        foreach ($packages_terms_condition_details as $k => $detail) {
            $detail = trim((string)$detail);
            if ($detail === '') continue;

            $itemId = isset($terms_condition_item_id_fk[$k]) ? $terms_condition_item_id_fk[$k] : '';

            $this->General_model->add($this->packages_terms_condition, array(
                'packages_terms_condition_packages_id_fk' => $package_id,
                'terms_condition_id_fk'                   => $terms_condition_id_fk,
                'terms_condition_item_id_fk'              => $itemId,
                'packages_terms_condition_type'           => 'Y',
                'packages_terms_condition_details'        => $detail,
                'packages_terms_condition_status'         => 1
            ));
        }
    }

    /* =============================
       9) CANCELLATION
    ============================= */
    $packages_cancellation_policy_checked_type = $this->input->post('packages_cancellation_policy_checked_type');
    $cancellation_policies_id_fk               = $this->input->post('cancellation_policies_id_fk');
    $cancellation_policies_item_id_fk          = (array)$this->input->post('cancellation_policies_item_id_fk');
    $packages_cancellation_policies_details    = (array)$this->input->post('packages_cancellation_policies_details');

    if ($packages_cancellation_policy_checked_type == 'Y') {
        foreach ($packages_cancellation_policies_details as $k => $detail) {
            $detail = trim((string)$detail);
            if ($detail === '') continue;

            $itemId = isset($cancellation_policies_item_id_fk[$k]) ? $cancellation_policies_item_id_fk[$k] : '';

            $this->General_model->add($this->packages_cancellation_policies, array(
                'packages_cancellation_policies_packages_id_fk' => $package_id,
                'cancellation_policies_id_fk'                   => $cancellation_policies_id_fk,
                'cancellation_policies_item_id_fk'              => $itemId,
                'packages_cancellation_policies_type'           => 'Y',
                'packages_cancellation_policies_details'        => $detail,
                'packages_cancellation_policies_status'         => 1
            ));
        }
    }

    /* =============================
       10) NOTES
    ============================= */
    $packages_notes_checked_type = $this->input->post('packages_notes_checked_type');
    $packages_notes_details      = (array)$this->input->post('packages_notes_details');

    if ($packages_notes_checked_type == 'Y') {
        foreach ($packages_notes_details as $detail) {
            $detail = trim((string)$detail);
            if ($detail === '') continue;

            $this->General_model->add($this->packages_notes, array(
                'packages_notes_packages_id_fk' => $package_id,
                'packages_notes_details'        => $detail,
                'packages_notes_status'         => 1
            ));
        }
    }

    /* =============================
    11) PROPERTIES
    ============================= */
    $packages_property_checked_type = $this->input->post('packages_property_checked_type');

    if ($packages_property_checked_type === 'Y') {

        $category_names      = (array)$this->input->post('property_category_name');
        $design_types        = (array)$this->input->post('packages_properties_common_design_type');
        $destinations_by_sec = (array)$this->input->post('property_destination_id');
        $properties_by_sec   = (array)$this->input->post('properties_id');
        $rooms_by_sec        = (array)$this->input->post('rooms_id');

        foreach ($category_names as $secIndex => $categoryName) {

            $categoryName = trim((string)$categoryName);
            if ($categoryName === '') {
                continue;
            }

            $designType = isset($design_types[$secIndex]) ? trim((string)$design_types[$secIndex]) : '';

            $common_id = $this->General_model->add_returnID(
                $this->packages_properties_common,
                array(
                    'packages_properties_common_packages_id_fk' => $package_id,
                    'packages_properties_common_category_name'  => $categoryName,
                    'packages_properties_common_design_type'    => $designType,
                    'packages_properties_common_status'         => 1
                )
            );

            if (!$common_id) {
                return FALSE;
            }

            if (empty($destinations_by_sec[$secIndex]) || !is_array($destinations_by_sec[$secIndex])) {
                continue;
            }

            foreach ($destinations_by_sec[$secIndex] as $itinDayId => $destId) {

                $itinDayId = (int)$itinDayId;
                if (!$itinDayId || !$destId) {
                    continue;
                }

                $pkgItineraryDaysIdFk = isset($pkgDayMap[$itinDayId]) ? $pkgDayMap[$itinDayId] : 0;
                if (!$pkgItineraryDaysIdFk) {
                    continue;
                }

                // find posted day text + TB flag from itinerary arrays
                $dayNo = '';
                $tbVal = '';

                foreach ($itineraries_days_id_fk as $kk => $postedItinDayId) {
                    if ((int)$postedItinDayId === $itinDayId) {
                        $dayNo = isset($packages_itineraries_days_day[$kk]) ? $packages_itineraries_days_day[$kk] : '';
                        $tbVal = (isset($travelBackArr[$kk]) && $travelBackArr[$kk] === 'TB') ? 'TB' : '';
                        break;
                    }
                }

                $day_id = $this->General_model->add_returnID(
                    $this->packages_properties_days,
                    array(
                        'packages_properties_common_id_fk'           => $common_id,
                        'packages_itinerary_days_id_fk'              => $pkgItineraryDaysIdFk,
                        'packages_properties_days_day'               => $dayNo,
                        'packages_properties_days_destination_id_fk' => $destId,
                        'packages_properties_days_travel_back'       => $tbVal,
                        'packages_properties_days_status'            => 1
                    )
                );

                if (!$day_id) {
                    return FALSE;
                }

                // if no property rows selected for this day, keep only day row saved
                if (empty($properties_by_sec[$secIndex][$itinDayId]) || !is_array($properties_by_sec[$secIndex][$itinDayId])) {
                    continue;
                }

                foreach ($properties_by_sec[$secIndex][$itinDayId] as $rowKey => $propertyId) {

                    $propertyId = trim((string)$propertyId);
                    if ($propertyId === '') {
                        continue;
                    }

                    $packages_properties_id = $this->General_model->add_returnID(
                        $this->packages_properties,
                        array(
                            'packages_properties_days_id_fk' => $day_id,
                            'properties_id_fk'               => $propertyId,
                            'packages_properties_status'     => 1
                        )
                    );

                    if (!$packages_properties_id) {
                        return FALSE;
                    }

                    if (!empty($rooms_by_sec[$secIndex][$itinDayId][$rowKey]) && is_array($rooms_by_sec[$secIndex][$itinDayId][$rowKey])) {
                        foreach ($rooms_by_sec[$secIndex][$itinDayId][$rowKey] as $roomId) {

                            $roomId = trim((string)$roomId);
                            if ($roomId === '') {
                                continue;
                            }

                            $okRoom = $this->General_model->add(
                                $this->packages_properties_rooms,
                                array(
                                    'packages_properties_id_fk'        => $packages_properties_id,
                                    'packages_properties_rooms_id_fk'  => $roomId,
                                    'packages_properties_rooms_status' => 1
                                )
                            );

                            if (!$okRoom) {
                                return FALSE;
                            }
                        }
                    }
                }
            }
        }
    }
    // return TRUE;
    // return array(
    //     'status'   => TRUE,
    //     'pkgDayMap' => $pkgDayMap
    // );
    return array(
        'status'                => TRUE,
        'packages_itinerary_id' => $packages_itinerary_id,
        'pkgDayMap'             => $pkgDayMap
    );
}
	public function ajax_edit($id)
	{
		/* =========================
		PACKAGE MASTER
		========================= */
		// $package = $this->db
		// 	->where('packages_id', $id)
		// 	->get('packages')
		// 	->row_array();

		// if (!$package) {
		// 	echo json_encode(['status' => false, 'message' => 'Package not found']);
		// 	return;
		// }

		$package = $this->Packages_model->get_package($id);
    if (!$package) {
        echo json_encode(['status' => false, 'message' => 'Package not found']);
        return;
    }

		/* =========================
		ITINERARY DAYS
		========================= */
		$itinerary_days = $this->db
			->select('pid.*')
			->from('packages_itinerary_days pid')
			->join('packages_itinerary pi', 'pi.packages_itinerary_id = pid.packages_itinerary_id_fk')
			->where('pi.packages_id_fk', $id)
			->get()
			->result_array();

		$itinerary_header = $this->db
		->where('packages_id_fk', $id)
		->get('packages_itinerary')
		->row_array();

		/* =========================
		INCLUSIONS / EXCLUSIONS
		========================= */
		$inclusions = $this->db
			->where('packages_id_fk', $id)
			->get('packages_inclusions')
			->result_array();

		$exclusions = $this->db
			->where('packages_id_fk', $id)
			->get('packages_exclusions')
			->result_array();

		/* =========================
		OPTIONAL ADDONS
		========================= */
		$optional_addons = $this->db
			->where('packages_optional_add_on_packages_id_fk', $id)
			->get('packages_optional_add_on')
			->result_array();

		/* =========================
		SPECIAL REQUIREMENTS
		========================= */
		$special_requirements = $this->db
			->where('packages_special_requirements_packages_id_fk', $id)
			->get('packages_special_requirements')
			->result_array();

		/* =========================
		PAYMENT POLICIES
		========================= */
		$payment_policies = $this->db
			->where('packages_payment_policies_packages_id_fk', $id)
			->get('packages_payment_policies')
			->result_array();

		/* =========================
		TERMS & CONDITIONS
		========================= */
		$terms = $this->db
			->where('packages_terms_condition_packages_id_fk', $id)
			->get('packages_terms_condition')
			->result_array();

		/* =========================
		CANCELLATION POLICIES
		========================= */
		$cancellation = $this->db
			->where('packages_cancellation_policies_packages_id_fk', $id)
			->get('packages_cancellation_policies')
			->result_array();

		/* =========================
		NOTES
		========================= */
		$notes = $this->db
			->where('packages_notes_packages_id_fk', $id)
			->get('packages_notes')
			->result_array();

		/* =========================
		PROPERTIES (FULL TREE)
		========================= */
		$properties = $this->db
			->where('packages_properties_common_packages_id_fk', $id)
			->get('packages_properties_common')
			->result_array();

		foreach ($properties as &$common) {

			$days = $this->db
				->where('packages_properties_common_id_fk', $common['packages_properties_common_id'])
				->get('packages_properties_days')
				->result_array();

			foreach ($days as &$day) {

				$props = $this->db
					->where('packages_properties_days_id_fk', $day['packages_properties_days_id'])
					->get('packages_properties')
					->result_array();

				foreach ($props as &$p) {

					$rooms = $this->db
						->where('packages_properties_id_fk', $p['packages_properties_id'])
						->get('packages_properties_rooms')
						->result_array();

					$p['rooms'] = $rooms;
				}

				$day['properties'] = $props;
			}

			$common['days'] = $days;
		}
// print_r($properties);die;
		echo json_encode([
			'status'               => true,
			'package'              => $package,
			'itinerary_header' => $itinerary_header,
			'itinerary_days'       => $itinerary_days,
			'inclusions'           => $inclusions,
			'exclusions'           => $exclusions,
			'optional_addons'      => $optional_addons,
			'special_requirements' => $special_requirements,
			'payment_policies'     => $payment_policies,
			'terms'                => $terms,
			'cancellation'         => $cancellation,
			'notes'                => $notes,
			'properties'           => $properties,
			'property_data' => $this->Packages_model->get_saved_property_data($id), // ✅ ADD THIS
		]);
	}

// public function ajax_update()
// {
//     $id = (int)$this->input->post('packages_id');

//     if (!$id) {
//         echo json_encode(['status'=>false,'message'=>'Invalid package ID']);
//         return;
//     }

//     $this->db->trans_begin();

//     date_default_timezone_set("Asia/Kolkata");

//     /* =============================
//        COVER PAGE IMAGES
//     ============================= */

//     $first_cover = '';
//     $last_cover  = '';

//     if (!empty($_FILES['packages_first_cover_page']['name'])) {

//         $up = $this->upload_package_cover_image('packages_first_cover_page');

//         if (!$up['ok']) {
//             echo json_encode(['status'=>false,'message'=>$up['message']]);
//             return;
//         }

//         $first_cover = $up['file'];

//     } else {

//         $first_cover = $this->input->post('packages_first_cover_page_txt');
//     }


//     if (!empty($_FILES['packages_last_cover_page']['name'])) {

//         $up = $this->upload_package_cover_image('packages_last_cover_page');

//         if (!$up['ok']) {
//             echo json_encode(['status'=>false,'message'=>$up['message']]);
//             return;
//         }

//         $last_cover = $up['file'];

//     } else {

//         $last_cover = $this->input->post('packages_last_cover_page_txt');
//     }

//     /* =============================
//        UPDATE PACKAGE MASTER
//     ============================= */

//     $data = array(

//         'packages_category_id_fk'           => $this->input->post('packages_category_id_fk'),
//         'packages_itinerary_category_id_fk' => $this->input->post('packages_itinerary_category_id_fk'),
//         'packages_itinerary_id_fk'          => $this->input->post('packages_itinerary_id_fk'),

//         'packages_inclusion_exclusion_common_id_fk' => $this->input->post('packages_inclusion_exclusion_common_id_fk'),
//         'packages_inclusion_exclusion_checked_type' => $this->input->post('packages_inclusion_exclusion_checked_type'),

//         'packages_optional_add_on_checked_type'     => $this->input->post('packages_optional_add_on_checked_type'),
//         'packages_special_requirment_checked_type'  => $this->input->post('packages_special_requirment_checked_type'),
//         'packages_payment_policies_checked_type'    => $this->input->post('packages_payment_policies_checked_type'),
//         'packages_terms_conditions_checked_type'    => $this->input->post('packages_terms_conditions_checked_type'),
//         'packages_cancellation_policy_checked_type' => $this->input->post('packages_cancellation_policy_checked_type'),
//         'packages_notes_checked_type'               => $this->input->post('packages_notes_checked_type'),
//         'packages_property_checked_type'            => $this->input->post('packages_property_checked_type'),

//         'packages_title'              => $this->input->post('packages_title'),
//         'packages_duration_in_nights' => $this->input->post('packages_duration_in_nights'),
//         'packages_description'        => $this->input->post('packages_description'),

//         'packages_first_cover_page' => $first_cover,
//         'packages_last_cover_page'  => $last_cover
//     );

//     $this->db->where('packages_id',$id)->update('packages',$data);

//     /* =============================
//        DELETE OLD CHILD DATA
//     ============================= */

//     $this->db->where('packages_id_fk',$id)->delete('packages_itinerary');

//     $this->db->where('packages_id_fk',$id)->delete('packages_inclusions');
//     $this->db->where('packages_id_fk',$id)->delete('packages_exclusions');

//     $this->db->where('packages_optional_add_on_packages_id_fk',$id)
//         ->delete('packages_optional_add_on');

//     $this->db->where('packages_payment_policies_packages_id_fk',$id)
//         ->delete('packages_payment_policies');

//     $this->db->where('packages_terms_condition_packages_id_fk',$id)
//         ->delete('packages_terms_condition');

//     $this->db->where('packages_cancellation_policies_packages_id_fk',$id)
//         ->delete('packages_cancellation_policies');

//     $this->db->where('packages_notes_packages_id_fk',$id)
//         ->delete('packages_notes');


//     /* =============================
//        DELETE PROPERTY STRUCTURE
//     ============================= */

//     $common = $this->db->select('packages_properties_common_id')
//         ->from('packages_properties_common')
//         ->where('packages_properties_common_packages_id_fk',$id)
//         ->get()->result_array();

//     foreach($common as $c){

//         $days = $this->db->select('packages_properties_days_id')
//             ->from('packages_properties_days')
//             ->where('packages_properties_common_id_fk',$c['packages_properties_common_id'])
//             ->get()->result_array();

//         foreach($days as $d){

//             $props = $this->db->select('packages_properties_id')
//                 ->from('packages_properties')
//                 ->where('packages_properties_days_id_fk',$d['packages_properties_days_id'])
//                 ->get()->result_array();

//             foreach($props as $p){

//                 $this->db->where(
//                     'packages_properties_id_fk',
//                     $p['packages_properties_id']
//                 )->delete('packages_properties_rooms');
//             }

//             $this->db->where(
//                 'packages_properties_days_id_fk',
//                 $d['packages_properties_days_id']
//             )->delete('packages_properties');
//         }

//         $this->db->where(
//             'packages_properties_common_id_fk',
//             $c['packages_properties_common_id']
//         )->delete('packages_properties_days');
//     }

//     $this->db->where('packages_properties_common_packages_id_fk',$id)
//         ->delete('packages_properties_common');


//     /* =============================
//        INSERT CHILD DATA AGAIN
//     ============================= */

//     $this->insert_children_for_package($id);

//     if ($this->db->trans_status() === FALSE) {

//         $this->db->trans_rollback();

//         echo json_encode(['status'=>false,'message'=>'Update failed']);
//         return;
//     }

//     $this->db->trans_commit();

//     echo json_encode(['status'=>true]);
// }

// private function insert_children_for_package($package_id)
// {
//     /* =============================
//        ITINERARY HEADER
//     ============================= */
//     $data_itinerary = array(
//         'packages_id_fk'            => $package_id,
//         'itineraries_id_fk'         => $this->input->post('packages_itinerary_id_fk'),
//         'packages_itinerary_status' => 1
//     );

//     $packages_itinerary_id = $this->General_model->add_returnID(
//         $this->packages_itinerary,
//         $data_itinerary
//     );

//     /* =============================
//        ITINERARY DAYS
//     ============================= */
//     $itineraries_days_id_fk                = (array)$this->input->post('itineraries_days_id_fk');
//     $days                                  = (array)$this->input->post('packages_itineraries_days_day');
//     $dest                                  = (array)$this->input->post('packages_itineraries_days_destination_id_fk');
//     $title                                 = (array)$this->input->post('packages_itineraries_days_title');
//     $desc                                  = (array)$this->input->post('packages_itineraries_days_description');
//     $travelBack                            = (array)$this->input->post('packages_itineraries_days_travel_back');
//     $defaultImg                            = (array)$this->input->post('default_itinerary_day_image');

//     // IMPORTANT: map by itinerary day id, not by row index
//     $pkgDayMap = array(); // [itineraries_days_id_fk] => packages_itinerary_days_id

//     foreach ($itineraries_days_id_fk as $k => $itinDayId) {

//         $itinDayId = (int)$itinDayId;
//         if (!$itinDayId) continue;

//         $rowDayNo = isset($days[$k]) ? $days[$k] : ($k + 1);
//         $image = '';

//         if (!empty($_FILES['packages_itineraries_days_image_file']['name'][$k])) {

//             $_FILES['tmp']['name']     = $_FILES['packages_itineraries_days_image_file']['name'][$k];
//             $_FILES['tmp']['tmp_name'] = $_FILES['packages_itineraries_days_image_file']['tmp_name'][$k];
//             $_FILES['tmp']['type']     = $_FILES['packages_itineraries_days_image_file']['type'][$k];
//             $_FILES['tmp']['size']     = $_FILES['packages_itineraries_days_image_file']['size'][$k];
//             $_FILES['tmp']['error']    = $_FILES['packages_itineraries_days_image_file']['error'][$k];

//             $up = $this->upload_day_image('tmp');

//             if (isset($up['ok']) && $up['ok']) {
//                 $image = $up['file'];
//             } else {
//                 $image = isset($defaultImg[$k]) ? $defaultImg[$k] : '';
//             }

//         } else {
//             $image = isset($defaultImg[$k]) ? $defaultImg[$k] : '';
//         }

//         $data_day = array(
//             'packages_itinerary_id_fk'                    => $packages_itinerary_id,
//             'itineraries_days_id_fk'                      => $itinDayId,
//             'packages_itineraries_days_day'               => $rowDayNo,
//             'packages_itineraries_days_destination_id_fk' => isset($dest[$k]) ? $dest[$k] : '',
//             'packages_itineraries_days_title'             => isset($title[$k]) ? $title[$k] : '',
//             'packages_itineraries_days_description'       => isset($desc[$k]) ? $desc[$k] : '',
//             'packages_itineraries_days_travel_back'       => isset($travelBack[$k]) ? $travelBack[$k] : '',
//             'packages_itineraries_days_image'             => $image,
//             'packages_itinerary_days_status'              => 1
//         );

//         $pkgInsertedId = $this->General_model->add_returnID(
//             $this->packages_itinerary_days,
//             $data_day
//         );

//         // KEY = itineraries_days_id_fk
//         $pkgDayMap[$itinDayId] = $pkgInsertedId;
//     }

//     /* =============================
//        INCLUSIONS
//     ============================= */
//     $packages_inclusions_details = (array)$this->input->post('packages_inclusions_details');
//     $common = $this->input->post('packages_inclusion_exclusion_common_id_fk');

//     foreach ($packages_inclusions_details as $v) {
//         $v = trim((string)$v);
//         if ($v === '') continue;

//         $this->General_model->add($this->packages_inclusions, array(
//             'packages_id_fk'              => $package_id,
//             'inclusion_common_id_fk'      => $common,
//             'packages_inclusions_type'    => 'Y',
//             'packages_inclusions_details' => $v,
//             'packages_inclusions_status'  => 1
//         ));
//     }

//     /* =============================
//        EXCLUSIONS
//     ============================= */
//     $packages_exclusions_details = (array)$this->input->post('packages_exclusions_details');

//     foreach ($packages_exclusions_details as $v) {
//         $v = trim((string)$v);
//         if ($v === '') continue;

//         $this->General_model->add($this->packages_exclusions, array(
//             'packages_id_fk'              => $package_id,
//             'exclusions_common_id_fk'     => $common,
//             'packages_exclusions_type'    => 'Y',
//             'packages_exclusions_details' => $v,
//             'packages_exclusions_status'  => 1
//         ));
//     }

//     /* =============================
//        OPTIONAL ADD ON
//     ============================= */
//     $packages_optional_add_on_details = (array)$this->input->post('packages_optional_add_on_details');

//     foreach ($packages_optional_add_on_details as $v) {
//         $v = trim((string)$v);
//         if ($v === '') continue;

//         $this->General_model->add($this->packages_optional_add_on, array(
//             'packages_optional_add_on_packages_id_fk' => $package_id,
//             'packages_optional_add_on_details'        => $v,
//             'packages_optional_add_on_status'         => 1
//         ));
//     }

//     /* =============================
//        PAYMENT
//     ============================= */
//     $payment_policies_id_fk             = $this->input->post('payment_policies_id_fk');
//     $packages_payment_policies_details  = (array)$this->input->post('packages_payment_policies_details');

//     foreach ($packages_payment_policies_details as $v) {
//         $v = trim((string)$v);
//         if ($v === '') continue;

//         $this->General_model->add($this->packages_payment_policies, array(
//             'packages_payment_policies_packages_id_fk' => $package_id,
//             'payment_policies_id_fk'                   => $payment_policies_id_fk,
//             'packages_payment_policies_type'           => 'Y',
//             'packages_payment_policies_details'        => $v,
//             'packages_payment_policies_status'         => 1
//         ));
//     }

//     /* =============================
//        TERMS
//     ============================= */
//     $terms_condition_id_fk           = $this->input->post('terms_condition_id_fk');
//     $packages_terms_condition_details = (array)$this->input->post('packages_terms_condition_details');

//     foreach ($packages_terms_condition_details as $v) {
//         $v = trim((string)$v);
//         if ($v === '') continue;

//         $this->General_model->add($this->packages_terms_condition, array(
//             'packages_terms_condition_packages_id_fk' => $package_id,
//             'terms_condition_id_fk'                   => $terms_condition_id_fk,
//             'packages_terms_condition_type'           => 'Y',
//             'packages_terms_condition_details'        => $v,
//             'packages_terms_condition_status'         => 1
//         ));
//     }

//     /* =============================
//        CANCELLATION
//     ============================= */
//     $cancellation_policies_id_fk            = $this->input->post('cancellation_policies_id_fk');
//     $packages_cancellation_policies_details = (array)$this->input->post('packages_cancellation_policies_details');

//     foreach ($packages_cancellation_policies_details as $v) {
//         $v = trim((string)$v);
//         if ($v === '') continue;

//         $this->General_model->add($this->packages_cancellation_policies, array(
//             'packages_cancellation_policies_packages_id_fk' => $package_id,
//             'cancellation_policies_id_fk'                   => $cancellation_policies_id_fk,
//             'packages_cancellation_policies_type'           => 'Y',
//             'packages_cancellation_policies_details'        => $v,
//             'packages_cancellation_policies_status'         => 1
//         ));
//     }

//     /* =============================
//        NOTES
//     ============================= */
//     $packages_notes_details = (array)$this->input->post('packages_notes_details');

//     foreach ($packages_notes_details as $v) {
//         $v = trim((string)$v);
//         if ($v === '') continue;

//         $this->General_model->add($this->packages_notes, array(
//             'packages_notes_packages_id_fk' => $package_id,
//             'packages_notes_details'        => $v,
//             'packages_notes_status'         => 1
//         ));
//     }

//     /* =============================
//        PROPERTIES
//     ============================= */
//     $packages_property_checked_type = $this->input->post('packages_property_checked_type');

//     if ($packages_property_checked_type === 'Y') {

//         $category_names      = (array)$this->input->post('property_category_name');
//         $design_types        = (array)$this->input->post('packages_properties_common_design_type');
//         $destinations_by_sec = (array)$this->input->post('property_destination_id'); // [sec][itinDayId]
//         $properties_by_sec   = (array)$this->input->post('properties_id');           // [sec][itinDayId][rowKey]
//         $rooms_by_sec        = (array)$this->input->post('rooms_id');                // [sec][itinDayId][rowKey][]

//         foreach ($category_names as $secIndex => $categoryName) {

//             $categoryName = trim((string)$categoryName);
//             if ($categoryName === '') continue;

//             $designType = isset($design_types[$secIndex]) ? $design_types[$secIndex] : '';

//             $common_id = $this->General_model->add_returnID(
//                 $this->packages_properties_common,
//                 array(
//                     'packages_properties_common_packages_id_fk' => $package_id,
//                     'packages_properties_common_category_name'  => $categoryName,
//                     'packages_properties_common_design_type'    => $designType,
//                     'packages_properties_common_status'         => 1
//                 )
//             );

//             if (empty($destinations_by_sec[$secIndex]) || !is_array($destinations_by_sec[$secIndex])) {
//                 continue;
//             }

//             foreach ($destinations_by_sec[$secIndex] as $itinDayId => $destId) {

//                 $itinDayId = (int)$itinDayId;
//                 if (!$itinDayId || !$destId) continue;

//                 // THIS IS THE FIX
//                 $pkgItineraryDaysIdFk = isset($pkgDayMap[$itinDayId]) ? $pkgDayMap[$itinDayId] : 0;

//                 if (!$pkgItineraryDaysIdFk) {
//                     continue;
//                 }

//                 $day_id = $this->General_model->add_returnID(
//                     $this->packages_properties_days,
//                     array(
//                         'packages_properties_common_id_fk'           => $common_id,
//                         'packages_itinerary_days_id_fk'              => $pkgItineraryDaysIdFk,
//                         'packages_properties_days_day'               => $itinDayId,
//                         'packages_properties_days_destination_id_fk' => $destId,
//                         'packages_properties_days_status'            => 1
//                     )
//                 );

//                 if (empty($properties_by_sec[$secIndex][$itinDayId]) || !is_array($properties_by_sec[$secIndex][$itinDayId])) {
//                     continue;
//                 }

//                 foreach ($properties_by_sec[$secIndex][$itinDayId] as $rowKey => $propertyId) {

//                     if (!$propertyId) continue;

//                     $packages_properties_id = $this->General_model->add_returnID(
//                         $this->packages_properties,
//                         array(
//                             'packages_properties_days_id_fk' => $day_id,
//                             'properties_id_fk'               => $propertyId,
//                             'packages_properties_status'     => 1
//                         )
//                     );

//                     if (!empty($rooms_by_sec[$secIndex][$itinDayId][$rowKey]) && is_array($rooms_by_sec[$secIndex][$itinDayId][$rowKey])) {
//                         foreach ($rooms_by_sec[$secIndex][$itinDayId][$rowKey] as $roomId) {

//                             if (!$roomId) continue;

//                             $this->General_model->add(
//                                 $this->packages_properties_rooms,
//                                 array(
//                                     'packages_properties_id_fk'        => $packages_properties_id,
//                                     'packages_properties_rooms_id_fk'  => $roomId,
//                                     'packages_properties_rooms_status' => 1
//                                 )
//                             );
//                         }
//                     }
//                 }
//             }
//         }
//     }
// }

	public function ajax_edit_delete($id)
	{
		$data = $this->Packages_model->get_by_id($id);
		// $data->dob = ($data->dob == '0000-00-00') ? '' : $data->dob; // if 0000-00-00 set tu empty for datepicker compatibility
		echo json_encode($data);
	}

	public function ajax_delete(){

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

		$updateData = array('packages_status' => 0);
		
		$this->Packages_model->update(array('packages_id' => $this->input->post('id')), $updateData);
// echo $this->db->last_query();exit();
		$updatecancellationData = array('packages_cancellation_policies_status' => 0);
		$this->db->where('packages_cancellation_policies_packages_id_fk', $this->input->post('id'))->update('packages_cancellation_policies', $updatecancellationData);

		$updateexclusionData = array('packages_exclusions_status' => 0);
		$this->db->where('packages_id_fk', $this->input->post('id'))->update('packages_exclusions', $updateexclusionData);

		$updateinclusionData = array('packages_inclusions_status' => 0);
		$this->db->where('packages_id_fk', $this->input->post('id'))->update('packages_inclusions', $updateinclusionData);

		$updateitineraryData = array('packages_itinerary_status' => 0);
		$this->db->where('packages_id_fk', $this->input->post('id'))->update('packages_itinerary', $updateitineraryData);

		$template['itinerary'] = $this->General_model->get_row($this->packages_itinerary,'packages_id_fk',$this->input->post('id'));
		
		$packages_itinerary_id = $template['itinerary']->packages_itinerary_id;
// print_r($template['itinerary']);die;
		$updateitinerarydayData = array('packages_itinerary_days_status' => 0);
		$this->db->where('packages_itinerary_id_fk', $packages_itinerary_id)->update('packages_itinerary_days', $updateitinerarydayData);

		$updatenotes = array('packages_notes_status' => 0);
		$this->db->where('packages_notes_packages_id_fk', $this->input->post('id'))->update('packages_notes', $updatenotes);

		$updateoptional_add_on = array('packages_optional_add_on_status' => 0);
		$this->db->where('packages_optional_add_on_packages_id_fk', $this->input->post('id'))->update('packages_optional_add_on', $updateoptional_add_on);

		$updatepayment_policies = array('packages_payment_policies_status' => 0);
		$this->db->where('packages_payment_policies_packages_id_fk', $this->input->post('id'))->update('packages_payment_policies', $updatepayment_policies);

		$updateproperties_common = array('packages_properties_common_status' => 0);
		$this->db->where('packages_properties_common_packages_id_fk', $this->input->post('id'))->update('packages_properties_common', $updateproperties_common);

		$template['common'] = $this->General_model->get_row($this->packages_properties_common,'packages_properties_common_packages_id_fk',$this->input->post('id'));
		$packages_properties_common_id = $template['common']->packages_properties_common_id;

		$updateproperties_days = array('packages_properties_days_status' => 0);
		$this->db->where('packages_properties_common_id_fk', $packages_properties_common_id)->update('packages_properties_days', $updateproperties_days);

		$template['properties_days'] = $this->General_model->get_row($this->packages_properties_days,'packages_properties_common_id_fk',$packages_properties_common_id);
		$packages_properties_days_id = $template['properties_days']->packages_properties_days_id;

		$updateproperties = array('packages_properties_status' => 0);
		$this->db->where('packages_properties_days_id_fk', $packages_properties_days_id)->update('packages_properties', $updateproperties);

		$template['properties'] = $this->General_model->get_row($this->packages_properties,'packages_properties_days_id_fk',$packages_properties_days_id);
		$packages_properties_id = $template['properties']->packages_properties_id;

		$updateproperties_rooms = array('packages_properties_rooms_status' => 0);
		$this->db->where('packages_properties_id_fk', $packages_properties_id)->update('packages_properties_rooms', $updateproperties_rooms);

		$updatespecial_requirements = array('packages_special_requirements_status' => 0);
		$this->db->where('packages_special_requirements_packages_id_fk', $this->input->post('id'))->update('packages_special_requirements', $updatespecial_requirements);

		$updateterms_condition = array('packages_terms_condition_status' => 0);
		$this->db->where('packages_terms_condition_packages_id_fk', $this->input->post('id'))->update('packages_terms_condition', $updateterms_condition);

		$packages_title = $this->input->post('packages_title');
		$ip = $this->input->ip_address();
		
		$activity_data = array(
				'activity_description' => 'Deleted package: '.$packages_title.'',
				'id_fk' => $this->input->post('id'),
				'activity_type' => 'Package_registration',
				// 'activity_order_number' => $invoice_order_number1,
				'activity_ip' => $ip,
				'activity_action' => 'Delete',
				'activity_by_userid' => $currentuserid,
				'activity_by_username' => $currentusername,
				'activity_date_time	' => $date1,
				'activity_date' => $date,
				'activity_status' => 1,
			);
		
		$this->General_model->add($this->activity,$activity_data);
		echo json_encode(array("status" => TRUE));

	}
}
?>
