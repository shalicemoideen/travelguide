# API & AJAX Endpoints

## Overview

The application uses CodeIgniter's default URI routing: `index.php/{controller}/{method}/{parameters}`. All data operations are performed via AJAX calls returning JSON. There is no REST API layer; endpoints are controller methods prefixed with `ajax_`.

## Authentication

All endpoints except `Login`, `Client_confirmation/view`, and `Whatsapp/webhook` require an active session. The `MY_Controller::is_logged_in()` method checks session data and redirects to login if absent.

## Endpoint Catalog

### Authentication

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Login/index` | GET | No | Login form |
| `Login/ajax_login` | POST | No | Validate credentials, create session |
| `Login/logout` | GET | Yes | Destroy session, redirect |

### Leads

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Leads/index` | GET | Yes | Lead list page |
| `Leads/get` | GET | Yes | DataTables server-side list |
| `Leads/ajax_add` | POST | Yes | Create/update lead |
| `Leads/ajax_edit_delete/{id}` | GET | Yes | Get lead for editing |
| `Leads/ajax_delete` | POST | Yes | Delete lead |
| `Leads/ajax_update_status` | POST | Yes | Update lead status/stage |
| `Leads/meta_webhook` | POST | Token | Meta Lead Ads webhook receiver |
| `LeadsConverted/get` | GET | Yes | DataTables converted leads |
| `LeadsQualified/get` | GET | Yes | DataTables qualified leads |
| `LeadsIntake/get` | GET | Yes | DataTables intake leads |
| `LeadsNotQualified/get` | GET | Yes | DataTables not-qualified leads |
| `Leadslost/get` | GET | Yes | DataTables lost leads |
| `RecentLeads/get` | GET | Yes | DataTables recent leads |

### Quotation

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Quotation/index` | GET | Yes | Quotation list page |
| `Quotation/preview_quotation/{id}` | GET | Yes | Preview quotation |
| `Quotation/ajax_add` | POST | Yes | Create quotation (JSON payload) |
| `Quotation/ajax_itinerary_update` | POST | Yes | Update itinerary + child tables |
| `Quotation/ajax_delete` | POST | Yes | Soft-delete quotation |
| `Quotation/ajax_edit_delete/{id}` | GET | Yes | Get quotation for editing |
| `Quotation/get_properties` | GET | Yes | List all properties |
| `Quotation/get_rooms` | GET | Yes | Rooms for a property |
| `Quotation/get_room_modal_details` | GET | Yes | Room tariff modal data |
| `Quotation/ajax_get_tariff_by_context` | GET | Yes | Tariff by lead/day/property/room |
| `Quotation/ajax_add_quotation_room_tariff_details` | POST | Yes | Save room tariff calculation |
| `Quotation/ajax_get_quotation_room_tariff_details` | GET | Yes | Get saved tariff |
| `Quotation/ajax_get_saved_quotation_room_tariff_details_by_id` | GET | Yes | Get tariff by ID |
| `Quotation/ajax_get_vehicle_list` | GET | Yes | List active vehicles |

### Client Confirmation

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Client_confirmation/view/{token}` | GET | No | Public confirmation page |
| `Client_confirmation/submit_confirmation` | POST | No | Process client confirmation |
| `Client_confirmation/generate_confirmation/{quotation_id}` | POST | Yes | Generate confirmation link |
| `Client_confirmation/index` | GET | Yes | Admin confirmation list |
| `Client_confirmation/view_confirmation/{id}` | GET | Yes | Admin detail view |

### Property Reservation

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Property_reservation/index` | GET | Yes | Reservation list page |
| `Property_reservation/get` | GET | Yes | DataTables list |
| `Property_reservation/view/{id}` | GET | Yes | Detail view |
| `Property_reservation/ajax_create_reservations/{quotation_id}` | POST | Yes | Auto-create from confirmation |
| `Property_reservation/ajax_save_blocking` | POST | Yes | Save Level 1 (blocking) |
| `Property_reservation/ajax_save_confirmation` | POST | Yes | Save Level 2 (confirmation) |
| `Property_reservation/ajax_save_reconfirmation` | POST | Yes | Save Level 3 (re-confirmation) |
| `Property_reservation/ajax_save_payment_scheduler` | POST | Yes | Create/update property payment |
| `Property_reservation/ajax_add_installment` | POST | Yes | Add installment |
| `Property_reservation/ajax_record_payment` | POST | Yes | Record property payment |
| `Property_reservation/ajax_add_comment` | POST | Yes | Add comment |
| `Property_reservation/ajax_get_comments/{id}` | GET | Yes | Fetch comments |
| `Property_reservation/ajax_get_payment_scheduler/{id}` | GET | Yes | Fetch payment scheduler |

### Receipt Scheduler (Client Payments)

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Receipt_scheduler/index` | GET | Yes | Payment list page |
| `Receipt_scheduler/get` | GET | Yes | DataTables list |
| `Receipt_scheduler/view/{id}` | GET | Yes | Detail view |
| `Receipt_scheduler/ajax_save_scheduler` | POST | Yes | Create/update scheduler |
| `Receipt_scheduler/ajax_add_installment` | POST | Yes | Add installment |
| `Receipt_scheduler/ajax_edit_installment` | POST | Yes | Edit installment |
| `Receipt_scheduler/ajax_delete_installment` | POST | Yes | Delete installment |
| `Receipt_scheduler/ajax_record_payment` | POST | Yes | Record payment |
| `Receipt_scheduler/ajax_get_scheduler/{id}` | GET | Yes | Fetch scheduler |
| `Receipt_scheduler/ajax_get_installments/{id}` | GET | Yes | Fetch installments |
| `Receipt_scheduler/ajax_get_payments/{id}` | GET | Yes | Fetch payment history |

### Booking Cancellation

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Booking_cancellation/index` | GET | Yes | Cancellation list page |
| `Booking_cancellation/get` | GET | Yes | DataTables list |
| `Booking_cancellation/create/{quotation_id}` | GET | Yes | Create form |
| `Booking_cancellation/view/{id}` | GET | Yes | Detail view |
| `Booking_cancellation/ajax_save_draft` | POST | Yes | Save draft |
| `Booking_cancellation/ajax_submit_for_approval` | POST | Yes | Submit for approval |
| `Booking_cancellation/ajax_approve` | POST | Yes | Manager approves |
| `Booking_cancellation/ajax_reject` | POST | Yes | Manager rejects |
| `Booking_cancellation/ajax_record_customer_refund` | POST | Yes | Record customer refund |
| `Booking_cancellation/ajax_reverse_customer_refund` | POST | Yes | Reverse customer refund |
| `Booking_cancellation/ajax_record_property_refund` | POST | Yes | Record supplier refund |
| `Booking_cancellation/ajax_add_service` | POST | Yes | Add service cancellation |
| `Booking_cancellation/ajax_add_adjustment` | POST | Yes | Add adjustment |
| `Booking_cancellation/ajax_settle` | POST | Yes | Mark settled |
| `Booking_cancellation/ajax_reverse_cancellation` | POST | Yes | Reverse cancellation |
| `Booking_cancellation/ajax_get_reasons` | GET | Yes | Fetch reasons |
| `Booking_cancellation/ajax_get_summary/{id}` | GET | Yes | P&L summary |

### Packages

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Packages/index` | GET | Yes | Package list |
| `Packages/ajax_add` | POST | Yes | Create/update package |
| `Packages/ajax_edit_delete/{id}` | GET | Yes | Get package for editing |
| `Packages/ajax_delete` | POST | Yes | Delete package |
| `Packages/get_properties` | GET | Yes | List properties |
| `Packages/get_rooms` | GET | Yes | Rooms for property |

### Property Registration

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Property_registration/index` | GET | Yes | Property list |
| `Property_registration/ajax_add` | POST | Yes | Create/update property |
| `Property_registration/ajax_edit_delete/{id}` | GET | Yes | Get property for editing |
| `Property_registration/ajax_delete` | POST | Yes | Delete property |

### Room Tariff Management

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Room_tariff_management/index` | GET | Yes | Tariff list |
| `Room_tariff_management/ajax_add` | POST | Yes | Create/update tariff |
| `Room_tariff_management/ajax_edit_delete/{id}` | GET | Yes | Get tariff for editing |
| `Room_tariff_management/ajax_delete` | POST | Yes | Delete tariff |

### Master Data (Generic Pattern)

Each master data module follows the same pattern:

| Endpoint Pattern | Method | Purpose |
|-----------------|--------|---------|
| `{Controller}/index` | GET | List page |
| `{Controller}/get` | GET | DataTables server-side |
| `{Controller}/ajax_add` | POST | Create/update |
| `{Controller}/ajax_edit_delete/{id}` | GET | Get for editing |
| `{Controller}/ajax_delete` | POST | Delete |

**Modules following this pattern:** Destination, Location, Source, Stages, Priority_status, Package_category, Property_category, Rooms, Vehicle, Designation, Company_holidays, Template_master, Inclusions_exclusion, Cancellation_policies, Payment_policies, Terms_condition, Special_requirments, B2b_partner, Transporter, Account_details, IncentiveConfig.

### Staff & Attendance

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Staff/index` | GET | Yes | Staff list |
| `Staff/ajax_add` | POST | Yes | Create/update staff |
| `Staff/ajax_delete` | POST | Yes | Delete staff |
| `Staff_attendance/index` | GET | Yes | Attendance dashboard |
| `Staff_attendance/ajax_sync` | POST | Yes | Sync from biometric API |
| `Staff_attendance/ajax_get_records` | GET | Yes | Fetch attendance records |

### Roles & Permissions

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Roles/index` | GET | Yes | Role list |
| `Roles/ajax_add` | POST | Yes | Create/update role + privileges |
| `Roles/ajax_edit_delete/{id}` | GET | Yes | Get role for editing |
| `Roles/ajax_delete` | POST | Yes | Delete role |
| `Permission/index` | GET | Yes | Permission list |
| `Permission/ajax_add` | POST | Yes | Create/update permission |
| `Permission/ajax_delete` | POST | Yes | Delete permission |

### Dashboard

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Dashboard/index` | GET | Yes | Dashboard with charts |
| `Dashboard/ajax_get_stats` | GET | Yes | Fetch statistics JSON |
| `Dashboard/ajax_get_chart_data` | GET | Yes | Fetch chart data JSON |

### WhatsApp

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Whatsapp/webhook` | GET/POST | Token | WhatsApp Cloud API webhook |

### Meta Lead Ads

| Endpoint | Method | Auth | Purpose |
|----------|--------|------|---------|
| `Leads/meta_webhook` | GET/POST | Token | Meta lead ads webhook |

## Request/Response Patterns

### Standard AJAX Create/Update

**Request:**
```
POST /index.php/{Controller}/ajax_add
Content-Type: application/x-www-form-urlencoded

field1=value1&field2=value2&...
```

**Response (success):**
```json
{
  "status": true,
  "message": "Saved successfully"
}
```

**Response (error):**
```json
{
  "status": false,
  "message": "Error description"
}
```

### Quotation Create (Complex Payload)

**Request:**
```
POST /index.php/Quotation/ajax_add
Content-Type: application/x-www-form-urlencoded

quotation_data={JSON-encoded payload with options, days, properties, rooms, inclusions, ...}
```

**Response:**
```json
{
  "status": true,
  "quotation_id": 42
}
```

### DataTables Server-Side

**Request:**
```
GET /index.php/{Controller}/get?draw=1&start=0&length=10&search[value]=&...
```

**Response:**
```json
{
  "draw": 1,
  "recordsTotal": 100,
  "recordsFiltered": 50,
  "data": [
    ["row1col1", "row1col2", ...],
    ["row2col1", "row2col2", ...]
  ]
}
```

## File Upload Endpoints

File uploads are handled within AJAX endpoints using CodeIgniter's file upload library:

| Controller | Upload Field | Destination |
|-----------|-------------|-------------|
| `Quotation` | Cover page images | `uploads/Quotation/` |
| `Property_registration` | Property photos, docs | `uploads/Property-doc/` |
| `Receipt_scheduler` | Payment slips | `uploads/Payment-slips/` |
| `Property_reservation` | Payment slips | `uploads/Property-payments/` |
| `Staff` | Profile pictures | `uploads/Profile-pics/` |
| `Booking_cancellation` | Refund slips | `uploads/Cancellation-refunds/` |
