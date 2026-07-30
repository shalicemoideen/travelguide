# Coding Conventions

## Framework

CodeIgniter 3 (PHP MVC framework). System core files in `system/` are untouched. All custom code is in `application/`.

## Naming Conventions

### Controllers

- **File name**: PascalCase, singular or plural matching entity (e.g., `Quotation.php`, `Leads.php`, `Booking_cancellation.php`)
- **Class name**: Same as file name, extends `MY_Controller`
- **Properties**: `$table` (main table name), `$page` (page identifier)
- **Methods**: `index()` for list, `ajax_*` for AJAX endpoints, `snake_case` for internal methods

```php
class Quotation extends MY_Controller {
    public $table = 'quotation';
    public $page = 'Quotation';

    public function __construct() {
        parent::__construct();
        $this->load->database();
        $this->load->model('Quotation_model');
        $this->load->model('General_model');
    }

    public function index() { /* list view */ }
    public function ajax_add() { /* AJAX create/update */ }
    public function ajax_delete() { /* AJAX delete */ }
    public function ajax_edit_delete($id) { /* AJAX get for editing */ }
}
```

### Models

- **File name**: PascalCase with `_model` suffix (e.g., `Quotation_model.php`, `Leads_model.php`)
- **Class name**: Same as file name, extends `CI_Model`
- **Methods**: `snake_case` (e.g., `get_by_id()`, `save()`, `get_financial_posting_defaults()`)

```php
class Quotation_model extends CI_Model {
    public function __construct() {
        parent::__construct();
    }

    public function save($data) {
        $this->db->insert('quotation', $data);
        return $this->db->insert_id();
    }

    public function get_by_id($id) {
        return $this->db->where('quotation_id', $id)
            ->get('quotation')->row();
    }
}
```

### Views

- **Directory**: PascalCase matching controller (e.g., `views/Quotation/`)
- **Files**: `list.php` (list view), `script.php` (JavaScript), `form.php` (form), modal partials
- **Template loading**: Via `template.php` which loads header, left_navigation, body, footer, script

```php
// Controller loads view:
$template['body'] = 'Quotation/list';
$template['script'] = 'Quotation/script';
$this->load->view('template', $template);
```

### Database Tables

- **Table names**: `snake_case` (e.g., `quotation_properties_days`, `property_reservation`)
- **Primary keys**: `{table_name_singular}_id` (e.g., `quotation_id`, `leads_id`, `property_reservation_id`)
- **Foreign keys**: `{referenced_table}_id_fk` or `{referenced_table_singular}_id_fk` (e.g., `quotation_id_fk`, `leads_id_fk`)
- **Status columns**: `{table_name}_status` (tinyint, 1=active, 0=deleted)
- **Timestamps**: `{table_name}_created_at`, `{table_name}_updated_at`
- **User tracking**: `{table_name}_createdby_userid`, `{table_name}_updatedby_user_id`

### Variables

- **PHP variables**: `snake_case` (e.g., `$quotation_id`, `$lead_data`)
- **JavaScript variables**: `camelCase` (e.g., `quotationId`, `leadData`)
- **POST/GET parameters**: `snake_case` (e.g., `quotation_id`, `leads_id_fk`)

## Common Patterns

### Generic CRUD via General_model

Most controllers use `General_model` for basic CRUD:

```php
// Insert
$this->General_model->add('table_name', $data);
$this->General_model->add_returnID('table_name', $data);

// Update
$this->General_model->update('table_name', $data, 'primary_key', $id);

// Delete
$this->General_model->delete('table_name', 'primary_key', $id);

// Get
$this->General_model->get_all('table_name');
$this->General_model->getall('table_name', $where_array);
$this->General_model->get_row('table_name', 'primary_key', $id);
```

### Soft Deletes

All tables use status columns instead of physical deletion:

```php
// Soft delete pattern
$this->General_model->update('table_name', ['table_name_status' => 0], 'id', $id);
```

### Activity Logging

Operations are logged in the `activity` table:

```php
$activity = array(
    'id_fk' => $record_id,
    'activity_staff_id_fk' => $this->session->userdata('user_id'),
    'activity_type' => 'CREATE', // CREATE, UPDATE, DELETE
    'activity_description' => 'Created quotation Quot-42',
    'activity_date_time' => date('Y-m-d H:i:s'),
);
$this->General_model->add('activity', $activity);
```

### AJAX Response Pattern

```php
// Success
echo json_encode(array('status' => true, 'message' => 'Success'));
exit;

// Error
echo json_encode(array('status' => false, 'message' => 'Error description'));
exit;
```

### Transaction Handling

```php
$this->db->trans_begin();
try {
    // Multiple inserts/updates
    $this->db->trans_commit();
} catch (Exception $e) {
    $this->db->trans_rollback();
    echo json_encode(array('status' => false, 'message' => $e->getMessage()));
    exit;
}
```

### Permission Checks

```php
// In controller
if (!has_permission('QUOTATION_CREATE')) {
    show_404();
}

// In view
<?php if (has_permission('QUOTATION_DELETE')): ?>
    <button class="btn btn-danger btn-delete">Delete</button>
<?php endif; ?>
```

### Date Handling

```php
// Parse date from form (DD-MM-YYYY to YYYY-MM-DD)
$formatted_date = date('Y-m-d', strtotime(str_replace('/', '-', $input_date)));

// Current timestamp
$now = date('Y-m-d H:i:s');
```

### File Uploads

```php
$config['upload_path'] = 'uploads/Quotation/';
$config['allowed_types'] = 'gif|jpg|png|jpeg';
$config['max_size'] = 5120; // 5MB
$this->load->library('upload', $config);
if ($this->upload->do_upload('file_field')) {
    $upload_data = $this->upload->data();
    $file_path = $upload_data['file_name'];
}
```

## Code Structure

### Controller Constructor Pattern

```php
public function __construct() {
    parent::__construct();
    $this->load->database();
    $this->load->model('Entity_model');
    $this->load->model('General_model');
    // Optional: load helpers, libraries
}
```

### View Template Pattern

```php
// Controller
$template['body'] = 'Module/list';
$template['script'] = 'Module/script';
$template['extra_data'] = $data;
$this->load->view('template', $template);

// template.php
$this->load->view('template/header');
$this->load->view('template/left_navigation');
$this->load->view($body);
$this->load->view('template/footer');
$this->load->view($script);
```

### DataTables Server-Side Pattern

```php
// Controller
public function get() {
    $draw = $this->input->post('draw');
    $start = $this->input->post('start');
    $length = $this->input->post('length');
    $search = $this->input->post('search')['value'];

    $data = $this->Entity_model->get_datatables($start, $length, $search);
    $total = $this->Entity_model->count_all();
    $filtered = $this->Entity_model->count_filtered($search);

    echo json_encode(array(
        'draw' => $draw,
        'recordsTotal' => $total,
        'recordsFiltered' => $filtered,
        'data' => $data
    ));
}
```

## Security Considerations

- **XSS filtering**: Applied via form validation `xss_clean` rule
- **CSRF protection**: Enabled in config with token regeneration
- **SQL injection**: CodeIgniter Query Builder automatically escapes values
- **Direct access prevention**: `.htaccess` denies direct access to `application/` and `system/`
- **Session validation**: `MY_Controller::is_logged_in()` checks session on every controller load

## Known Technical Debt

- **Password hashing**: `user_details.password` stores secure hashes via `password_hash(PASSWORD_DEFAULT)`, verified with `password_verify()`. Legacy plaintext passwords are transparently rehashed on first successful login
- **No input sanitization on some AJAX endpoints**: Some methods accept raw POST data without form validation
- **Duplicate controllers**: `Role.php` and `Roles.php` both exist; `Inclusions_exclusion-old.php` and `Payment_policies-OLD.php` are legacy versions
- **Large controllers**: `Quotation.php` (189KB) and `Leads.php` (126KB) are monolithic and could be refactored
- **Mixed naming**: Some tables use `leads_id` while others use `quotation_id` (inconsistent singular/plural)
- **No environment separation**: Single `config.php` and `database.php` for all environments
