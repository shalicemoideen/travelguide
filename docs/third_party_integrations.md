# Third-Party Integrations

## 1. WhatsApp Cloud API (Meta)

**Config file:** `application/config/whatsapp.php`
**Controller:** `Whatsapp.php`
**Model:** `Whatsapp_model.php`

### Configuration

```php
$config['whatsapp_api_token'] = '...';        // Bearer token
$config['whatsapp_phone_number_id'] = '...';   // Phone number ID
$config['whatsapp_api_version'] = 'v21.0';     // Meta Graph API version
$config['whatsapp_verify_token'] = '...';      // Webhook verification token
$config['whatsapp_templates'] = [
    'quotation_link' => 'quotation_confirmation_template',
    'payment_reminder' => 'payment_reminder_template',
];
```

### Webhook Endpoint

```
GET  /index.php/Whatsapp/webhook  — Meta verification challenge
POST /index.php/Whatsapp/webhook  — Incoming message/status webhook
```

### Outbound Messages

Messages are sent via Meta Graph API:
```
POST https://graph.facebook.com/{api_version}/{phone_number_id}/messages
Authorization: Bearer {api_token}
Content-Type: application/json

{
  "messaging_product": "whatsapp",
  "to": "phone_number",
  "type": "template",
  "template": { "name": "template_name", "language": { "code": "en" } }
}
```

### Usage

- Send quotation confirmation links to clients
- Send payment reminders for overdue installments
- Receive incoming messages from clients

## 2. Meta/Facebook Lead Ads

**Controller:** `Leads.php` (meta_webhook method)
**Model:** `Leads_model.php`
**Config:** `Meta_ads_setting.php` controller for configuration

### Webhook Endpoint

```
GET  /index.php/Leads/meta_webhook  — Meta verification challenge
POST /index.php/Leads/meta_webhook  — Lead data payload
```

### Lead Processing

1. Meta sends lead data JSON to webhook
2. Webhook verifies `meta_verify_token`
3. Lead data is parsed from `raw_meta_json`
4. New lead created in `leads` table with:
   - `lead_source` = 'Meta Lead'
   - `meta_leadgen_id`, `meta_page_id`, `meta_form_id`, `meta_ad_id` populated
   - `raw_meta_json` stores full payload
5. Lead assigned to staff (round-robin or based on Meta ads settings)

### Meta Ads Settings

Managed via `Meta_ads_setting.php` controller:
- Configure page ID, form ID, access token
- Map Meta form fields to lead fields
- Set staff assignment rules
- Force stop Meta lead assignment per staff (`meta_force_stop`)

### Force Stop Log

When a staff member is force-stopped from receiving Meta leads:
- `user_details.meta_force_stop` set to 'Y'
- Entry logged in `force_stop_log` with action (ENABLED/STOPPED), user, timestamp

## 3. eSSL Biometric Attendance

**Controller:** `Staff_attendance.php`
**Model:** `Staff_attendance_model.php`
**Config:** `attendance_api_config` table

### Configuration

Stored in `attendance_api_config` table:
- `api_name`: Biometric Device API
- `api_endpoint`: eSSL API URL
- `api_key`: Authentication key
- `device_ids`: Comma-separated device IDs

### Sync Process

1. Staff clicks "Sync Attendance" button
2. Controller calls eSSL API endpoint
3. Raw punch data stored in `attendance_raw_logs`
4. Data processed into daily `attendance_records` (in time, out time, work hours, status)
5. `device_user_id` mapped to `user_details.device_user_id` → `user_id`

### Attendance Records

| Field | Description |
|-------|-------------|
| `user_id_fk` | Staff user ID |
| `attendance_date` | Date of attendance |
| `first_punch_in` | First punch time |
| `last_punch_out` | Last punch time |
| `total_work_hours` | Calculated work hours |
| `attendance_status` | PRESENT, ABSENT, LATE, HALF_DAY, LEAVE |
| `punch_count` | Number of biometric punches |

### Leave Requests

Staff can submit leave requests via `attendance_leave_requests`:
- Types: sick, casual, paid, unpaid, half_day, other
- Status: pending, approved, rejected
- Approved by manager

## 4. PHPMailer (Email)

**Config file:** `application/config/email.php`

### Configuration

```php
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'smtp.gmail.com';
$config['smtp_port'] = 587;
$config['smtp_crypto'] = 'tls';
$config['smtp_user'] = '...';
$config['smtp_pass'] = '...';
$config['mailtype'] = 'html';
$config['charset'] = 'utf-8';
$config['dkim_signing'] = true;
```

### Usage

- Send quotation confirmation links via email
- Send payment receipts
- Send cancellation notifications
- Send staff leave approval/rejection notifications

## 5. Select2 (Frontend)

Used for searchable dropdowns throughout the application:
- Property selection
- Room category selection
- Vehicle selection
- Staff assignment
- Source/destination selection

## 6. DataTables (Frontend)

Used for all list views with:
- Server-side processing
- Column sorting and searching
- CSV/Excel export
- Print
- Pagination

## 7. Chart.js / Morris.js (Frontend)

Used for dashboard charts:
- Lead conversion trends
- Revenue trends
- Lead source distribution
- Staff performance

## 8. jQuery UI Datepicker (Frontend)

Used for date selection in forms and filters:
- Lead travel dates
- Quotation dates
- Payment due dates
- Reservation check-in/check-out
- Cancellation dates
- Date range filters

## 9. Noty / Notify (Frontend)

Used for user notifications:
- Success messages after AJAX operations
- Error messages on validation failures
- Confirmation dialogs before destructive actions

## 10. Bootstrap (Frontend)

CSS framework for responsive layout:
- Grid system for forms and lists
- Modals for AJAX-loaded content
- Tabs for multi-section views
- Badges for status indicators
- Alerts for messages
