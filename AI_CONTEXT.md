# AI Context — Travels Software

> **Quick-reference summary for AI assistants working on this codebase.**
> Read this first, then dive into specific docs in `/docs/` as needed.

## Project at a Glance

| Attribute | Value |
|-----------|-------|
| **Type** | Travel agency management system (B2B/B2C) |
| **Framework** | CodeIgniter 3 (PHP) |
| **Database** | MySQL (InnoDB, latin1) |
| **Frontend** | jQuery, Bootstrap, DataTables, Select2, Chart.js |
| **Entry point** | `index.php` → `login` controller (default route) |
| **Auth** | Session-based, role-permission RBAC |
| **Base URL** | `http://localhost/Travels-software-new` |

## Critical File Paths

| What | Path |
|------|------|
| **Quotation controller** | `application/controllers/Quotation.php` (189KB, 8545 lines) |
| **Quotation model** | `application/models/Quotation_model.php` (185KB) |
| **Leads controller** | `application/controllers/Leads.php` (126KB) |
| **Booking cancellation controller** | `application/controllers/Booking_cancellation.php` (66KB) |
| **Property reservation controller** | `application/controllers/Property_reservation.php` (29KB) |
| **Receipt scheduler controller** | `application/controllers/Receipt_scheduler.php` (27KB) |
| **Client confirmation controller** | `application/controllers/Client_confirmation.php` (8KB) |
| **Permission helper** | `application/helpers/permission_helper.php` |
| **Base controller** | `application/core/MY_Controller.php` |
| **Generic CRUD model** | `application/models/General_model.php` |
| **Auth model** | `application/models/Loginmodel.php` |
| **Main SQL schema** | `db/travels_software.sql` (7569 lines) |
| **Reservation migration** | `db/migration_property_reservation.sql` |
| **Cancellation migration** | `db/migration_booking_cancellation.sql` |
| **Config** | `application/config/config.php`, `database.php`, `autoload.php` |
| **WhatsApp config** | `application/config/whatsapp.php` |
| **Email config** | `application/config/email.php` |
| **View template** | `application/views/template.php` |

## Architecture Summary

```
Apache → index.php → CodeIgniter Router → Controller → Model → MySQL
                                         ↓
                                    View (template.php)
                                      ├── header
                                      ├── left_navigation
                                      ├── body (module view)
                                      ├── footer
                                      └── script (JS)
```

- **Controllers** contain business logic and AJAX endpoints (`ajax_*` methods)
- **Models** handle all DB queries using CodeIgniter Query Builder
- **Views** use PHP templates with jQuery for interactivity
- **General_model** provides generic CRUD (`add`, `update`, `delete`, `get_row`, `getall`)
- **Soft deletes** everywhere: `*_status = 0` instead of DELETE
- **Activity log** tracks all CRUD operations in `activity` table

## Core Business Flow

```
Lead → Package → Quotation (multi-option) → Client Confirmation (tokenized link)
  → Property Reservation (3-level: Block → Confirm → Re-confirm)
  → Payment Scheduling (client + property, FULL/EMI)
  → [if cancelled] → Booking Cancellation (DRAFT → APPROVE → SETTLE, with P&L)
```

## Key Database Tables (Quick Reference)

| Table | PK | Purpose |
|-------|-----|---------|
| `leads` | `leads_id` | Lead master |
| `quotation` | `quotation_id` | Quotation header |
| `quotation_options` | `quotation_options_id` | Option variants |
| `quotation_properties_days` | `quotation_properties_days_id` | Days per option |
| `quotation_properties` | `quotation_properties_id` | Properties per day |
| `quotation_properties_rooms` | `quotation_properties_rooms_id` | Rooms per property |
| `quotation_room_tariff_details` | `quotation_room_tariff_details_id` | Tariff per room |
| `quotation_confirmation` | `id` | Client's confirmed selections |
| `property_reservation` | `property_reservation_id` | 3-level hotel reservation |
| `property_payment_scheduler` | `property_payment_scheduler_id` | Property payment header |
| `receipt_scheduler` | `receipt_scheduler_id` | Client payment header |
| `booking_cancellation` | `booking_cancellation_id` | Cancellation with P&L |
| `user_details` | `user_id` | Staff users |
| `tr_roles` | `id` | Roles |
| `tr_permissions` | `id` | Permissions |
| `tr_role_permissions` | `id` | Role-permission mapping |
| `properties` | `properties_id` | Hotel master |
| `packages` | `packages_id` | Package templates |

## Permission System

```php
// Check permission (from session)
has_permission('QUOTATION_CREATE');
has_any_permission(['QUOTATION_CREATE', 'QUOTATION_EDIT']);

// Session keys: user_id, user_name, admin_name, role_id, permissions[], logged_in
```

## AJAX Pattern

```php
// Controller endpoint
public function ajax_add() {
    $data = $this->input->post();
    // validation, processing...
    echo json_encode(['status' => true, 'id' => $new_id]);
    exit;
}

// Frontend
$.post(base_url + 'index.php/Controller/ajax_add', data, function(resp) {
    if (resp.status) { /* success */ }
}, 'json');
```

## Important Conventions

1. **Always use soft deletes** — set `*_status = 0`, never physical DELETE
2. **Use General_model for basic CRUD** — `add_returnID()`, `update()`, `get_row()`
3. **Log activity** for all create/update/delete operations
4. **Use transactions** for multi-table inserts (quotation creation, cancellation approval)
5. **Permission checks** at top of controller methods
6. **Append-only for financials** — payments and refunds are never updated/deleted; use REVERSAL entries
7. **Snapshot financials** at cancellation approval time for historical P&L
8. **Date format** in DB: `Y-m-d`; in forms: `d-m-Y` (converted via `strtotime(str_replace('/', '-', $date))`)
9. **View loading** via template.php with `$template['body']` and `$template['script']`
10. **No direct model access from views** — all data passed via controller

## External Integrations

| Integration | Purpose | Config |
|-------------|---------|--------|
| WhatsApp Cloud API | Send quotation links, payment reminders | `config/whatsapp.php` |
| Meta Lead Ads | Auto-create leads from Facebook ads | `Leads/meta_webhook` |
| eSSL Biometric | Staff attendance sync | `attendance_api_config` table |
| PHPMailer | Email sending | `config/email.php` |

## Documentation Index

| Document | Content |
|----------|---------|
| `docs/project_overview.md` | Application purpose, domain, tech stack, architecture |
| `docs/folder_structure.md` | Complete directory layout, controllers, models, views |
| `docs/database_schema.md` | All table structures, FKs, design patterns |
| `docs/workflow_quotation.md` | Quotation creation, options, tariff, transaction handling |
| `docs/workflow_booking.md` | Lead conversion, client confirmation, trip creation |
| `docs/workflow_property_allocation.md` | 3-level property reservation, payment scheduling |
| `docs/workflow_payment.md` | Client payment scheduler (FULL/EMI), installments |
| `docs/workflow_cancellation.md` | Cancellation lifecycle, P&L, refunds, approvals |
| `docs/api_endpoints.md` | All AJAX endpoints with methods and purposes |
| `docs/business_rules.md` | All business logic rules by module |
| `docs/validation_rules.md` | Server-side and client-side validation per module |
| `docs/user_roles.md` | RBAC, auth flow, permission modules, session data |
| `docs/reports.md` | Dashboard analytics, list views, export capabilities |
| `docs/third_party_integrations.md` | WhatsApp, Meta, eSSL, PHPMailer, frontend libraries |
| `docs/coding_conventions.md` | Naming, patterns, security, technical debt |

## Quick Start for Common Tasks

### "Add a new field to the quotation form"

1. Add column to `quotation` table via SQL ALTER
2. Add field to `application/views/Quotation/list.php` (or form view)
3. Add field to `ajax_add()` method in `application/controllers/Quotation.php`
4. Add field to `save()` / `update()` in `application/models/Quotation_model.php`
5. Add field to `ajax_edit_delete()` response if editing
6. Add permission check if the field is restricted

### "Add a new AJAX endpoint"

1. Add `ajax_*` method to the relevant controller
2. Add corresponding model method if DB access needed
3. Add JavaScript AJAX call in the view's `script.php`
4. Add permission check at top of method
5. Return JSON with `status` boolean

### "Add a new module"

1. Create controller in `application/controllers/{Module}.php` extending `MY_Controller`
2. Create model in `application/models/{Module}_model.php` extending `CI_Model`
3. Create views in `application/views/{Module}/` (list.php, script.php, form.php)
4. Add SQL for new tables in `db/`
5. Add permissions to `tr_permissions` and seed via SQL
6. Add menu item in `application/views/template/left_navigation.php`
