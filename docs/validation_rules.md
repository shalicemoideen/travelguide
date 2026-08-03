# Validation Rules

## Overview

Validation is handled by CodeIgniter's Form Validation library for form submissions, and by manual checks within AJAX methods for JSON endpoints. The application uses a mix of server-side validation (controller-level) and client-side validation (jQuery).

## Server-Side Validation Patterns

### Form Validation (CodeIgniter)

Controllers use `$this->form_validation->set_rules()` for form-based submissions:

```php
$this->form_validation->set_rules('field_name', 'Human Label', 'required|trim|xss_clean');
```

Common rules used:
- `required` — Field must not be empty
- `trim` — Strip whitespace
- `xss_clean` — XSS filtering
- `integer` — Must be integer
- `numeric` — Must be numeric
- `max_length[N]` — Max N characters
- `min_length[N]` — Min N characters
- `valid_email` — Valid email format
- `is_unique[table.field]` — Unique in database
- `callback_*` — Custom validation callback

### AJAX Validation (Manual)

AJAX methods typically perform manual validation:

```php
if (empty($this->input->post('required_field'))) {
    echo json_encode(array('status' => false, 'message' => 'Field is required'));
    return;
}
```

## Module-Specific Validation

### Leads

| Field | Rule | Notes |
|-------|------|-------|
| `guest_name` | Required, trim | Guest name |
| `lead_register_date` | Required, valid date | Registration date |
| `date_type` | Required, enum (WITH/FLEXI) | Date flexibility |
| `start_date` | Required if date_type=WITH | Travel start |
| `end_date` | Required if date_type=WITH | Travel end |
| `source_id_fk` | Required, integer | Lead source |
| `staff_id_fk` | Required, integer | Assigned staff |
| `country_id_fk` | Required, integer | Destination country |
| `whats_number` | Required | WhatsApp number |
| `lead_type` | Required, enum (B2C/B2B) | Lead type |

### Quotation

| Field | Rule | Notes |
|-------|------|-------|
| `leads_id` | Required, integer | Parent lead |
| `package_id` | Required, integer | Source package |
| `quotation_date` | Required, parsed via strtotime | Quotation date |
| `options` | Required, JSON array | Must have at least one option |
| `options[*].title` | Required | Option title |
| `options[*].total_cost` | Required, numeric | Net cost |
| `options[*].total_quote_rate` | Required, numeric | Quoted rate |
| `options[*].margin_type` | Enum (FIXED/PERCENTAGE) | Margin type |
| `options[*].margin_value` | Numeric | Margin value |
| `options[*].amount_type` | Enum (net/gross) | Amount type |

### Quotation Room Tariff

| Field | Rule | Notes |
|-------|------|-------|
| `quotation_properties_rooms_id_fk` | Integer | Room FK (0 if pre-save) |
| `adult_count` | Integer | Number of adults |
| `child_with_bed_count` | Integer | Children with bed |
| `child_without_bed_count` | Integer | Children without bed |
| `extra_bed_count` | Integer | Extra beds |
| `room_count` | Integer | Number of rooms |
| `per_night_rate` | Numeric | Rate per night |
| `nights` | Integer | Number of nights |
| `auto_total_rate` | Numeric | Auto-calculated total |
| `manual_total_rate` | Numeric | Manual override total |

> **Manual room allocation is fully user-controlled.** The system auto-calculates a suggested minimum room allocation (Total Rooms / DB / EB / SB) from the room policy and guest counts and displays it as a suggestion, but it is **not enforced**. Users may enter any values for Total Rooms, Double Bed (DB), Extra Bed (EB), and Child Sharing Bed (SB) — including fewer than the calculated minimum — and the entered values are saved exactly as entered. Numeric, negative-number, required-field, data-type, booking-status, and permission validations still apply.

### Client Confirmation

| Field | Rule | Notes |
|-------|------|-------|
| `token` | Required, must exist in DB | Confirmation token |
| `selected_option_id` | Required, integer | Selected option |
| `selected_properties` | Required, array | Properties per day |
| `client_name` | Required | Client name |
| `client_email` | Valid email | Client email |
| `client_phone` | Required | Client phone |

### Property Reservation

| Field | Rule | Notes |
|-------|------|-------|
| `blocking_cnfm_by` | Required (Level 1) | Hotel contact name |
| `blocking_cutoff_date` | Required (Level 1), valid date | Cut-off date |
| `blocking_date` | Required (Level 1), valid date | Date blocked |
| `confirmation_cnfm_by` | Required (Level 2) | Confirmed by |
| `confirmation_cnfm_no` | Required (Level 2) | Confirmation number |
| `confirmation_cnfm_date` | Required (Level 2), valid date | Confirmation date |
| `reconfirmation_cnfm_by` | Required (Level 3) | Re-confirmed by |
| `reconfirmation_cnfm_no` | Required (Level 3) | Re-confirmation number |
| `reconfirmation_date` | Required (Level 3), valid date | Re-confirmation date |

### Payment Scheduler

| Field | Rule | Notes |
|-------|------|-------|
| `quotation_id_fk` | Required, integer | Parent quotation |
| `payment_type` | Required, enum (FULL/EMI) | Payment type |
| `total_amount` | Required, numeric > 0 | Total amount |
| `max_emi_count` | Required if EMI, integer ≥ 2 | EMI count |
| `split_type` | Required if EMI, enum (AMOUNT/PERCENTAGE) | Split type |
| `installment_amount` | Required if split=AMOUNT, numeric | Fixed amount |
| `installment_percentage` | Required if split=PERCENTAGE, numeric 0-100 | Percentage |
| `due_date` | Required, valid date | Installment due date |
| `payment_amount` | Required, numeric > 0 | Payment amount |
| `payment_date` | Required, valid date | Payment date |
| `payment_method` | Required, enum | Cash/Card/UPI/Bank/Cheque |

### Booking Cancellation

| Field | Rule | Notes |
|-------|------|-------|
| `quotation_id_fk` | Required, integer | Parent quotation |
| `cancellation_reason_id_fk` | Required, integer | Cancellation reason |
| `cancellation_request_date` | Required, valid date | Guest request date |
| `cancellation_effective_date` | Required, valid date | Effective date for policy |
| `cancellation_scope` | Required, enum (FULL/PARTIAL) | Scope |
| `customer_cancellation_charge` | Numeric ≥ 0 | Auto or override |
| `customer_charge_is_override` | Boolean | Override flag |
| `refund_amount` | Required (refund), numeric > 0 | Refund amount |
| `refund_date` | Required (refund), valid date | Refund date |
| `refund_method` | Required (refund) | Refund method |
| `service_name` | Required (service) | Service name |
| `booked_amount` | Required (service), numeric | Booked amount |
| `cancellation_charge` | Required (service), numeric | Charge |
| `adjustment_type` | Required (adjustment) | Adjustment type |
| `amount` | Required (adjustment), numeric | Amount |
| `description` | Required (adjustment) | Description |

### Staff

| Field | Rule | Notes |
|-------|------|-------|
| `admin_name` | Required, trim | Display name |
| `user_name` | Required, trim, is_unique (on create) | Login username |
| `password` | Required (on create), min_length[6] | Password |
| `user_email_address` | Valid email | Email |
| `user_phone_number` | Required | Phone |
| `role_id_fk` | Required, integer | Role |
| `designation_id_fk` | Integer | Designation |

### Roles

| Field | Rule | Notes |
|-------|------|-------|
| `name` | Required, trim, is_unique | Role name |
| `description` | Trim | Description |
| `privileges` | Array | Module-level privileges |

### Permissions

| Field | Rule | Notes |
|-------|------|-------|
| `name` | Required, trim, is_unique | Permission key |
| `display_name` | Required, trim | Display label |
| `module` | Required | Module name |
| `sub_module` | Required | Sub-module |

### Property Registration

| Field | Rule | Notes |
|-------|------|-------|
| `properties_name` | Required, trim | Property name |
| `properties_category_id_fk` | Required, integer | Category |
| `properties_address` | Required | Address |
| `properties_phone_number` | Required | Phone |

### Packages

| Field | Rule | Notes |
|-------|------|-------|
| `packages_name` | Required, trim | Package name |
| `packages_category_id_fk` | Required, integer | Category |
| `packages_days` | Required, integer > 0 | Duration |

## Client-Side Validation

The application uses jQuery for client-side validation:

- **Required field highlighting**: Fields with `required` attribute or class
- **Date pickers**: jQuery UI datepicker for date fields
- **Numeric inputs**: `type="number"` with min/max attributes
- **Select2 dropdowns**: For property, room, vehicle selection
- **Form submission**: `e.preventDefault()` + AJAX call; success/error notifications via Noty

## File Upload Validation

| Upload | Allowed types | Max size | Notes |
|--------|--------------|----------|-------|
| Cover page images | gif, jpg, png, jpeg | 5MB | Quotation cover pages |
| Property photos | gif, jpg, png, jpeg | 5MB | Property registration |
| Payment slips | gif, jpg, png, jpeg, pdf | 5MB | Payment records |
| Profile pics | gif, jpg, png, jpeg | 2MB | Staff profiles |
| Refund slips | gif, jpg, png, jpeg, pdf | 5MB | Cancellation refunds |
