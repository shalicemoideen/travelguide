# Database Schema

## Overview

The database is MySQL with InnoDB engine and latin1 charset. The full schema is in `db/travels_software.sql` (7569 lines). Additional migration files add the property reservation and booking cancellation modules.

## Core Tables

### `leads` — Lead Master

| Column | Type | Description |
|--------|------|-------------|
| `leads_id` | int(11) PK | Primary key |
| `staff_id_fk` | int(11) | Assigned staff member |
| `source_id_fk` | int(11) | Lead source (walk-in, phone, Meta, etc.) |
| `package_id_fk` | int(11) | Selected package |
| `country_id_fk` | int(11) | Destination country |
| `priority_status_id_fk` | int(11) | Priority level |
| `stage_id_fk` | int(11) | Pipeline stage |
| `agent_id_fk` | int(11) | Agent (B2B partner) |
| `leads_number` | varchar(255) | Display number (e.g. LD-1) |
| `lead_type` | varchar(50) | B2C or B2B |
| `guest_name` | varchar(255) | Guest name |
| `lead_register_date` | date | Registration date |
| `date_type` | varchar(50) | WITH (fixed dates) or FLEXI |
| `start_date` | date | Travel start date |
| `end_date` | date | Travel end date |
| `duration` | varchar(50) | Trip duration in days |
| `leads_package_category_id_fk` | int(11) | Package category |
| `whats_number` | varchar(255) | WhatsApp number |
| `alternative_number` | varchar(255) | Alternative phone |
| `leads_email` | varchar(255) | Email |
| `leads_address` | text | Address |
| `total_package_cost` | double | Package cost |
| `expense` | double | Expense |
| `margin` | double | Margin |
| `lead_current_status` | int(11) | Current pipeline status |
| `leads_accomodation_status` | int(11) | Accommodation status |
| `leads_quotation_status` | int(11) | Quotation generated (0/1) |
| `meta_leadgen_id` | varchar(50) | Meta lead gen ID |
| `meta_page_id` | varchar(50) | Meta page ID |
| `meta_form_id` | varchar(50) | Meta form ID |
| `meta_ad_id` | varchar(50) | Meta ad ID |
| `lead_source` | varchar(100) | Source label |
| `raw_meta_json` | longtext | Raw Meta webhook payload |
| `leads_status` | tinyint(4) | 1=active, 0=deleted |

### `quotation` — Quotation Master

| Column | Type | Description |
|--------|------|-------------|
| `quotation_id` | int(11) PK | Primary key |
| `leads_id_fk` | int(11) | FK to leads |
| `quotation_number` | varchar(255) | Display number (e.g. Quot-1) |
| `package_id_fk` | int(11) | Source package |
| `quotation_date` | datetime | Quotation date |
| `arriving_destination` | int(11) | Arrival destination |
| `departuring_destination` | int(11) | Departure destination |
| `quotation_remarks` | text | Remarks |
| `quotation_title` | varchar(255) | Title |
| `quotation_first_cover_page` | varchar(255) | Cover page image |
| `quotation_last_cover_page` | varchar(255) | Back cover image |
| `total_inclusion_amount` | double | Total inclusion cost |
| `total_special_requirment_amount` | double | Total special requirement cost |
| `quotation_current_status` | int(11) | Status (2=created, 5=confirmed, 6=cancelled) |
| `quotation_created_by_userid` | int(11) | Created by user |
| `quotation_created_at` | datetime | Creation timestamp |
| `quotation_updatedby_user_id` | int(11) | Updated by user |
| `quotation_updated_at` | datetime | Update timestamp |
| `quotation_status` | tinyint(4) | 1=active, 0=deleted |

### `quotation_options` — Quotation Option Variants

| Column | Type | Description |
|--------|------|-------------|
| `quotation_options_id` | int(11) PK | Primary key |
| `quotation_id_fk` | int(11) | FK to quotation |
| `packages_properties_common_id_fk` | int(11) | Source package option |
| `quotation_options_title` | varchar(255) | Option title (e.g. "Option 1 - 3 Star") |
| `quotation_options_cab_amount` | double | Cab/transport cost |
| `quotation_options_design_type` | varchar(255) | Design layout type |
| `quotation_options_vehicle_id_fk` | int(11) | Vehicle type |
| `quotation_options_room_category_display` | varchar(255) | Room category display text |
| `quotation_options_meal_plan_display` | varchar(255) | Meal plan display text |
| `quotation_options_vehicle_display` | varchar(255) | Vehicle display text |
| `quotation_options_total_cost` | double | Total cost (net) |
| `quotation_options_margin_type` | varchar(255) | FIXED or PERCENTAGE |
| `quotation_options_margin_value` | double | Margin amount/percentage |
| `quotation_options_total_quote_rate` | double | Quoted rate to client |
| `quotation_options_amount_type` | varchar(255) | net or gross |
| `quotation_options_per_amount` | double | Per-person amount |
| `quotation_options_status` | int(11) | 1=active, 0=deleted |

### Quotation Child Tables

| Table | Purpose |
|-------|---------|
| `quotation_properties_days` | Day-by-day breakdown per option (destination, accommodation plan) |
| `quotation_properties` | Properties (hotels) per day |
| `quotation_properties_rooms` | Room categories per property |
| `quotation_room_tariff_details` | Detailed tariff calculation per room (pax, bed types, extra beds, supplements, auto/manual rates) |
| `quotation_itinerary` | Itinerary header |
| `quotation_itinerary_days` | Day-by-day itinerary with description and image |
| `quotation_inclusions` | Inclusions list |
| `quotation_exclusion` | Exclusions list |
| `quotation_optional_add_on` | Optional add-ons |
| `quotation_payment_policies` | Payment policy details |
| `quotation_terms_condition` | Terms & conditions |
| `quotation_cancellation_policies` | Cancellation policy details |
| `quotation_notes` | Notes |
| `quotation_special_requirements` | Special requirements per day |
| `quotation_property_inclusions` | Property-specific inclusions |
| `quotation_confirmation` | Client's confirmed option + properties + rooms |
| `quotation_review` | Quotation review ratings and comments |

### `property_reservation` — Property Reservation (3-Level Confirmation)

| Column | Type | Description |
|--------|------|-------------|
| `property_reservation_id` | int(11) PK | Primary key |
| `quotation_id_fk` | int(11) | FK to quotation |
| `quotation_confirmation_id_fk` | int(11) | FK to quotation_confirmation |
| `properties_id_fk` | int(11) | FK to properties (hotel) |
| `booking_number` | varchar(255) | Booking number (e.g. 2-26-326) |
| `guest_name` | varchar(255) | Guest name |
| `check_in_date` | date | Check-in |
| `check_out_date` | date | Check-out |
| `duration_nights` | int(11) | Number of nights |
| `blocking_status` | enum('PENDING','BLOCKED') | Level 1: Hotel blocking status |
| `blocking_cnfm_by` | varchar(255) | Confirmed by (hotel contact) |
| `blocking_cutoff_date` | date | Cut-off date for blocking |
| `blocking_date` | date | Date blocked |
| `blocking_done_by_userid` | int(11) | Staff who blocked |
| `blocking_done_datetime` | datetime | When blocked |
| `confirmation_status` | enum('PENDING','CONFIRMED') | Level 2: Reservation confirmation |
| `confirmation_cnfm_by` | varchar(255) | Confirmed by |
| `confirmation_cnfm_no` | varchar(255) | Confirmation number |
| `confirmation_cnfm_date` | date | Confirmation date |
| `confirmation_done_by_userid` | int(11) | Staff who confirmed |
| `confirmation_done_datetime` | datetime | When confirmed |
| `reconfirmation_status` | enum('PENDING','RECONFIRMED') | Level 3: Re-confirmation |
| `reconfirmation_cnfm_by` | varchar(255) | Re-confirmed by |
| `reconfirmation_cnfm_no` | varchar(255) | Re-confirmation number |
| `reconfirmation_date` | date | Re-confirmation date |
| `reconfirmation_done_by_userid` | int(11) | Staff who re-confirmed |
| `reconfirmation_done_datetime` | datetime | When re-confirmed |
| `property_reservation_status` | int(11) | 1=active, 0=deleted |

### `property_payment_scheduler` — Property Payment Header

| Column | Type | Description |
|--------|------|-------------|
| `property_payment_scheduler_id` | int(11) PK | Primary key |
| `property_reservation_id_fk` | int(11) | FK to property_reservation |
| `quotation_id_fk` | int(11) | FK to quotation |
| `payment_type` | enum('FULL','EMI') | Payment type |
| `total_amount` | double | Total payable to property |
| `currency` | varchar(10) | Currency (default INR) |
| `max_emi_count` | int(11) | Max EMI count (EMI only) |
| `split_type` | enum('AMOUNT','PERCENTAGE') | EMI split type |
| `property_payment_scheduler_status` | int(11) | 1=active, 0=deleted |

### `property_payment_scheduler_installments` — Property Payment Installments

| Column | Type | Description |
|--------|------|-------------|
| `installment_id` | int(11) PK | Primary key |
| `property_payment_scheduler_id_fk` | int(11) | FK to scheduler |
| `installment_number` | int(11) | EMI number (1 for FULL) |
| `installment_amount` | double | Fixed amount (AMOUNT split) |
| `installment_percentage` | double | Percentage (PERCENTAGE split) |
| `calculated_amount` | double | Actual calculated amount |
| `due_date` | date | Due date |
| `payment_status` | enum('PENDING','PARTIAL','PAID','OVERDUE') | Payment status |
| `paid_amount` | double | Amount paid so far |
| `paid_date` | date | Last payment date |
| `payment_reference` | varchar(255) | Transaction reference |
| `payment_method` | varchar(100) | Cash/Card/UPI/Bank Transfer |
| `installment_status` | int(11) | 1=active, 0=deleted |

### `property_payment_scheduler_payments` — Property Payment Transactions

Append-only audit trail for each payment made to a property owner.

### `property_reservation_comments` — Reservation Comments

1:N comments per reservation, with user ID and timestamp.

### `booking_cancellation` — Cancellation Header

| Column | Type | Description |
|--------|------|-------------|
| `booking_cancellation_id` | int(11) PK | Primary key |
| `cancellation_number` | varchar(50) | Display number (CAN-2026-00001) |
| `quotation_id_fk` | int(11) | FK to quotation |
| `leads_id_fk` | int(11) | FK to leads (denormalized) |
| `quotation_options_id_fk` | int(11) | Confirmed option being cancelled |
| `cancellation_scope` | enum('FULL','PARTIAL') | Cancellation scope |
| `cancellation_reason_id_fk` | int(11) | FK to booking_cancellation_reason |
| `cancellation_reason_notes` | text | Reason notes |
| `cancellation_request_date` | date | Guest request date |
| `cancellation_effective_date` | date | Date for policy slab calc |
| `travel_start_date` | date | Snapshot of leads.start_date |
| `days_before_travel` | int(11) | Signed; negative = after departure |
| `snap_package_value` | decimal(14,2) | Snapshot of package value |
| `snap_customer_received` | decimal(14,2) | Snapshot of customer payments |
| `snap_customer_outstanding` | decimal(14,2) | Snapshot of outstanding |
| `customer_cancellation_charge` | decimal(14,2) | Amount retained from customer |
| `customer_charge_is_override` | tinyint(1) | Manual override flag |
| `customer_refund_due` | decimal(14,2) | Refund due (negative = customer owes) |
| `customer_refund_paid` | decimal(14,2) | Refund paid so far |
| `customer_settlement_status` | enum | NOT_APPLICABLE/PENDING/PARTIAL/COMPLETED/WRITTEN_OFF |
| `snap_supplier_booked` | decimal(14,2) | Snapshot of supplier cost |
| `snap_supplier_paid` | decimal(14,2) | Snapshot of supplier payments |
| `supplier_cancellation_charge` | decimal(14,2) | Supplier cancellation charge |
| `supplier_refund_expected` | decimal(14,2) | Expected supplier refund |
| `supplier_refund_received` | decimal(14,2) | Received supplier refund |
| `supplier_still_payable` | decimal(14,2) | Additional amount owed to supplier |
| `supplier_settlement_status` | enum | Settlement status |
| `net_retained_from_customer` | decimal(14,2) | Final P&L: customer retention |
| `net_paid_to_suppliers` | decimal(14,2) | Final P&L: supplier payments |
| `net_other_cost` | decimal(14,2) | Transport, visa, gateway fees |
| `net_adjustment_total` | decimal(14,2) | Adjustments total |
| `net_result` | decimal(14,2) | Final P&L (positive=profit, negative=loss) |
| `cancellation_status` | enum | DRAFT/PENDING_APPROVAL/APPROVED/SETTLED/REJECTED/REVERSED |
| `previous_quotation_status` | int(11) | For safe reversal |
| `requested_by_userid` | int(11) | Requested by |
| `approved_by_userid` | int(11) | Approved by |

### Booking Cancellation Child Tables

| Table | Purpose |
|-------|---------|
| `booking_cancellation_reason` | Master list of cancellation reasons (GUEST/COMPANY/SUPPLIER/FORCE_MAJEURE/NO_SHOW/OTHER) |
| `booking_cancellation_customer_refund` | Append-only customer refund transactions with REVERSAL support |
| `booking_cancellation_property` | Per-property cancellation details with charge snapshots and line status |
| `booking_cancellation_property_refund` | Per-property supplier refund transactions |
| `booking_cancellation_service` | Non-property supplier cancellations (transport, visa, guide, etc.) |
| `booking_cancellation_adjustment` | Write-offs, goodwill, gateway fees, tax adjustments, incentive clawback |

### `user_details` — User/Staff Master

| Column | Type | Description |
|--------|------|-------------|
| `user_id` | int(11) PK | Primary key |
| `device_user_id` | varchar(50) | eSSL biometric employee code |
| `admin_name` | varchar(255) | Display name |
| `user_type` | varchar(255) | User type (A=Admin, etc.) |
| `user_email_address` | varchar(255) | Email |
| `user_phone_number` | varchar(255) | Phone |
| `role_id_fk` | int(11) | FK to tr_roles |
| `designation_id_fk` | int(11) | FK to designation |
| `user_name` | varchar(255) | Login username |
| `password` | varchar(255) | Login password (stored as a PHP `password_hash()` hash, not plaintext) |
| `user_status` | int(11) | 1=active, 0=inactive |
| `meta_force_stop` | varchar(50) | N=not stopped, Y=stopped |
| `tamil_speak` | varchar(50) | Tamil speaking flag |
| `main_head_staff_id` | int(11) | Reporting manager |
| `shift_id_fk` | int(11) | Work shift |
| `user_profile_pic` | varchar(255) | Profile picture path |
| `user_date_of_joining` | date | Joining date |

### `tr_roles` — Role Master

| Column | Type | Description |
|--------|------|-------------|
| `id` | int(11) PK | Primary key |
| `name` | varchar(100) | Role name |
| `description` | varchar(255) | Description |
| `status` | tinyint(4) | 1=active, 0=inactive |

### `tr_permissions` — Permission Master

| Column | Type | Description |
|--------|------|-------------|
| `id` | int(11) PK | Primary key |
| `name` | varchar(100) | Permission key (e.g. STAFF_CREATE) |
| `display_name` | varchar(100) | Display label |
| `module` | varchar(22) | Module name (e.g. STAFF MANAGEMENT) |
| `sub_module` | varchar(50) | Sub-module (e.g. STAFF, ROLE) |
| `description` | varchar(255) | Description |
| `status` | tinyint(4) | 1=active, 0=inactive |

### `tr_role_permissions` — Role-Permission Mapping

| Column | Type | Description |
|--------|------|-------------|
| `id` | int(11) PK | Primary key |
| `role_id` | int(11) | FK to tr_roles |
| `permission_id` | int(11) | FK to tr_permissions |
| `status` | tinyint(4) | 1=active, 0=inactive |
| `assigned_by` | int(11) | User who assigned |
| `assigned_at` | datetime | Assignment timestamp |

### Other Key Tables

| Table | Purpose |
|-------|---------|
| `properties` | Hotel/property master (name, category, address, contact) |
| `properties_room_category` | Room categories per property |
| `packages` | Package master templates |
| `packages_properties_days` | Package day-by-day structure |
| `packages_properties` | Properties per package day |
| `packages_properties_rooms` | Room categories per package property |
| `packages_itinerary` | Package itinerary |
| `packages_itinerary_days` | Package itinerary days |
| `packages_inclusions` | Package inclusions |
| `packages_exclusions` | Package exclusions |
| `packages_optional_add_on` | Package optional add-ons |
| `packages_payment_policies` | Package payment policies |
| `packages_terms_condition` | Package terms |
| `packages_cancellation_policies` | Package cancellation policies |
| `packages_notes` | Package notes |
| `inclusion_exclusion_common` | Shared inclusion/exclusion master |
| `inclusions` | Inclusion items |
| `exclusions` | Exclusion items |
| `cancellation_policies` | Cancellation policy master |
| `cancellation_policies_item` | Cancellation policy line items |
| `payment_policies` | Payment policy master |
| `payment_policies_item` | Payment policy line items |
| `terms_condition` | Terms master |
| `terms_condition_item` | Terms line items |
| `itineraries` | Itinerary templates |
| `itineraries_days` | Itinerary day templates |
| `itinerary_category` | Itinerary categories |
| `room_tariff_hike` | Seasonal tariff hike periods |
| `hike_room_tariff_hike` | Hike per property |
| `hike_room_tariff_hike_rate` | Hike rates per room category |
| `hike_room_tariff_week_days_rate` | Weekday-specific hike rates |
| `vehicle` | Vehicle types |
| `transporter` | Transporter master |
| `vendor` | Vendor master |
| `b2b_partner` | B2B partner master |
| `source` | Lead source master |
| `stages` | Lead pipeline stages |
| `priority_status` | Priority levels |
| `state` | State/destination master |
| `country` | Country master |
| `designation` | Staff designations |
| `activity` | Audit log for all modules |
| `login_logs` | Login/logout audit trail |
| `attendance_records` | Staff attendance from biometric |
| `attendance_raw_logs` | Raw biometric punch data |
| `attendance_api_config` | Biometric API configuration |
| `attendance_leave_requests` | Leave requests |
| `company_holidays` | Company holiday calendar |
| `holiday_settings` | Holiday settings |
| `force_stop_log` | Meta force-stop log |
| `account_details` | Bank account details with QR code |
| `guset_count` / `guset_count_details` | Guest count (adults/children) per lead |
| `child_age_break_up` | Child age breakdown |
| `accommodation_plan` | Accommodation plan per lead |

## Foreign Key Constraints

### Property Reservation FKs

- `property_reservation.quotation_id_fk` → `quotation.quotation_id` (RESTRICT)
- `property_reservation.quotation_confirmation_id_fk` → `quotation_confirmation.id` (SET NULL)
- `property_reservation.properties_id_fk` → `properties.properties_id` (RESTRICT)
- `property_payment_scheduler.property_reservation_id_fk` → `property_reservation.property_reservation_id` (CASCADE)
- `property_payment_scheduler.quotation_id_fk` → `quotation.quotation_id` (RESTRICT)
- `property_payment_scheduler_installments.property_payment_scheduler_id_fk` → `property_payment_scheduler` (CASCADE)
- `property_payment_scheduler_payments.installment_id_fk` → `property_payment_scheduler_installments` (RESTRICT)
- `property_reservation_comments.property_reservation_id_fk` → `property_reservation` (CASCADE)

### Booking Cancellation FKs

- `booking_cancellation.quotation_id_fk` → `quotation.quotation_id` (RESTRICT)
- `booking_cancellation.leads_id_fk` → `leads.leads_id` (RESTRICT)
- `booking_cancellation.cancellation_reason_id_fk` → `booking_cancellation_reason` (SET NULL)
- `booking_cancellation_customer_refund.booking_cancellation_id_fk` → `booking_cancellation` (RESTRICT)
- `booking_cancellation_customer_refund.reverses_refund_id_fk` → `booking_cancellation_customer_refund` (RESTRICT)
- `booking_cancellation_property.booking_cancellation_id_fk` → `booking_cancellation` (CASCADE)
- `booking_cancellation_property.property_reservation_id_fk` → `property_reservation` (RESTRICT)

## Design Patterns

- **Soft deletes**: All tables use a `*_status` column (1=active, 0=deleted) instead of physical deletion
- **Append-only financials**: Refund and payment tables use REVERSAL entries instead of UPDATE/DELETE
- **Snapshot financials**: Cancellation records freeze financial figures at approval time so historical P&L remains reproducible
- **Denormalization**: `leads_id_fk` in `booking_cancellation` and `properties_id_fk` in refund tables for efficient report joins
- **Audit trail**: `activity` table logs all CRUD operations with user, IP, timestamp, and action type
