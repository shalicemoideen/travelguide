# Folder Structure

## Root Layout

```
Travels-software-latest/
├── application/          # Main application code (MVC)
│   ├── cache/            # CI cache files
│   ├── config/           # Configuration files
│   ├── controllers/      # 60+ controller classes
│   ├── core/             # Extended base classes (MY_Controller, MY_Input)
│   ├── helpers/          # Custom helpers (permission_helper, etc.)
│   ├── models/           # 55+ model classes
│   ├── views/            # 50+ view directories with PHP templates
│   ├── .htaccess          # Denies direct access
│   ├── composer.json      # PHP dependencies
│   └── index.html         # Directory access prevention
├── assets/               # Frontend assets
│   ├── ajax/             # AJAX-loaded HTML fragments
│   ├── css/              # Stylesheets (DataTables, Noty, Notify)
│   ├── icons/            # Icon sets (avasta, bootstrap-icons, flaticon, etc.)
│   └── images/           # Logos, avatars, property images
├── db/                   # Database SQL files
│   ├── live-db/          # Live database dumps
│   ├── migrations.txt    # Alter table migration statements
│   ├── migration_booking_cancellation.sql
│   ├── migration_property_reservation.sql
│   ├── migration_property_credit.sql
│   ├── add_property_credit_permissions.sql
│   └── travels_software.sql  # Full schema + seed data
├── system/               # CodeIgniter 3 system core (do not modify)
├── uploads/              # User-uploaded files
│   ├── Profile-pics/
│   ├── Property-doc/
│   ├── Property-room-category-doc/
│   ├── Vendor-image/
│   └── ... (11+ subdirectories)
├── user_guide/           # CodeIgniter user guide
├── index.php             # Front controller entry point
├── composer.json
└── README.md
```

## Application Configuration (`application/config/`)

| File | Purpose |
|------|---------|
| `config.php` | Base URL, session, CSRF, logging, charset |
| `database.php` | MySQL connection (host, user, password, db) |
| `autoload.php` | Auto-loaded libraries, helpers, models |
| `constants.php` | File modes, exit status codes |
| `routes.php` | URI routing; default controller = `login` |
| `whatsapp.php` | WhatsApp Cloud API token, phone number ID, Meta verify token |
| `email.php` | PHPMailer SMTP configuration |

## Controllers (`application/controllers/`)

### Core Business Controllers

| Controller | Size | Responsibility |
|-----------|------|----------------|
| `Leads.php` | 126 KB | Lead CRUD, Meta lead ads webhook, package filtering, lead conversion |
| `Quotation.php` | 189 KB | Quotation CRUD, options, properties, rooms, tariff, itinerary, inclusions, exclusions, policies, preview |
| `Property_reservation.php` | 29 KB | 3-level property confirmation (blocking, confirmation, re-confirmation), comments, payment recording |
| `Booking_cancellation.php` | 66 KB | Cancellation lifecycle: draft, approval, P&L, refunds, adjustments |
| `Receipt_scheduler.php` | 27 KB | Client payment scheduling (FULL/EMI), installment management, payment recording |
| `Client_confirmation.php` | 8 KB | Public tokenized client confirmation page, option/property selection |
| `Packages.php` | 111 KB | Package CRUD, itinerary, properties, rooms, inclusions, policies |
| `Property_registration.php` | 62 KB | Property (hotel) master data, room categories, tariffs |
| `Property_registration_edit.php` | 48 KB | Property editing |
| `Room_tariff_management.php` | 56 KB | Room tariff management with seasonal hikes |
| `Itinerary.php` | 38 KB | Itinerary template management |
| `Transporter.php` | 17 KB | Transporter/vehicle management |

### Master Data Controllers

| Controller | Responsibility |
|-----------|----------------|
| `Destination.php` | Travel destinations (states) |
| `Location.php` | Locations |
| `Source.php` | Lead sources |
| `Stages.php` | Lead pipeline stages |
| `Priority_status.php` | Lead priority levels |
| `Package_category.php` | Package categories |
| `Property_category.php` | Property categories |
| `Rooms.php` | Room category management |
| `Vehicle.php` | Vehicle management |
| `Designation.php` | Staff designations |
| `Company_holidays.php` | Holiday calendar |
| `Template_master.php` | Document templates |

### Administrative Controllers

| Controller | Responsibility |
|-----------|----------------|
| `Login.php` | Authentication, session, logout |
| `Roles.php` | Role management with module-level privileges |
| `Role.php` | Alternative role controller |
| `Permission.php` | Permission management (CRUD) |
| `Staff.php` | Staff user management |
| `Staff_attendance.php` | Biometric attendance sync & display |
| `Staff_order_assign.php` | Staff order assignment |
| `User.php` | User account management |
| `Dashboard.php` | Dashboard stats and charts |
| `Account_details.php` | Bank account details |
| `IncentiveConfig.php` | Incentive configuration |
| `Meta_ads_setting.php` | Meta/Facebook ads configuration |

### Lead Pipeline Controllers

| Controller | Responsibility |
|-----------|----------------|
| `LeadsConverted.php` | Converted leads list |
| `LeadsIntake.php` | Intake stage leads |
| `LeadsQualified.php` | Qualified leads |
| `LeadsNotQualified.php` | Not-qualified leads |
| `Leadslost.php` | Lost leads |
| `RecentLeads.php` | Recent leads feed |
| `Trips.php` | Active trips (converted + travelling) |

### Supporting Controllers

| Controller | Responsibility |
|-----------|----------------|
| `Inclusions_exclusions.php` | Inclusion/exclusion master |
| `Cancellation_policies.php` | Cancellation policy master |
| `Payment_policies.php` | Payment policy master |
| `Terms_condition.php` | Terms & conditions master |
| `Special_requirments.php` | Special requirements master |
| `B2b_partner.php` | B2B partner management |
| `Whatsapp.php` | WhatsApp webhook handler |
| `Payment_report.php` | Payment reports |
| `Home.php` | Home page redirect |

## Models (`application/models/`)

Each controller typically has a corresponding model. Key models:

| Model | Size | Responsibility |
|-------|------|----------------|
| `Quotation_model.php` | 185 KB | All quotation DB operations, option/property/room/tariff queries |
| `Leads_model.php` | 49 KB | Lead CRUD, Meta lead parsing, lead status updates |
| `Booking_cancellation_model.php` | 54 KB | Cancellation calculations, refund tracking, P&L computation |
| `Property_reservation_model.php` | 31 KB | Reservation CRUD, payment scheduler, comments |
| `Receipt_scheduler_model.php` | 32 KB | Payment schedule CRUD, installment calculations |
| `Packages_model.php` | 40 KB | Package CRUD, itinerary, properties, policies |
| `Property_registration_model.php` | 41 KB | Property master, room categories, tariffs |
| `Room_tariff_management_model.php` | 30 KB | Tariff management, seasonal hikes |
| `Dashboard_model.php` | 15 KB | Dashboard statistics queries |
| `Loginmodel.php` | 3.5 KB | Authentication, user lookup, permission loading |
| `General_model.php` | 5 KB | Generic CRUD (add, update, delete, get_row, get_all) |
| `Staff_attendance_model.php` | 25 KB | Biometric API sync, attendance records |
| `Roles_model.php` | 5 KB | Role CRUD with privilege mapping |
| `Permission_model.php` | 3 KB | Permission CRUD |

## Views (`application/views/`)

Views follow a **template pattern**: `template.php` loads `template/header`, `template/left_navigation`, the body view, `template/footer`, and a script view.

| View Directory | Files | Purpose |
|---------------|-------|---------|
| `Quotation/` | 17 files | Quotation list, form, preview, modal scripts |
| `Leads/` | 4 files | Lead list, form, scripts |
| `Booking_cancellation/` | 8 files | Cancellation list, form, details, approval |
| `Property_reservation/` | 5 files | Reservation list, details, payment |
| `Receipt_scheduler/` | 5 files | Payment schedule list, form |
| `Packages/` | 7 files | Package list, form, itinerary |
| `Property_registration/` | 8 files | Property list, form, rooms, tariffs |
| `Dashboard/` | 3 files | Dashboard with charts |
| `Client_confirmation/` | 4 files | Public client confirmation page + admin views |
| `Staff/` | 2 files | Staff list, form |
| `Staff_attendance/` | 2 files | Attendance dashboard |
| `Login/` | 2 files | Login form |
| `Roles/` | 2 files | Role management |
| `template/` | 3 files | Header, left navigation, footer |

## Core Extensions (`application/core/`)

| File | Purpose |
|------|---------|
| `MY_Controller.php` | Base controller with `is_logged_in()` method |
| `MY_Input.php` | Extended input handler |

## Helpers (`application/helpers/`)

| File | Purpose |
|------|---------|
| `permission_helper.php` | `has_permission()` and `has_any_permission()` functions checking session-stored permissions |

## Database Files (`db/`)

| File | Purpose |
|------|---------|
| `travels_software.sql` | Full schema dump with seed data (7569 lines) |
| `migration_property_reservation.sql` | Property reservation tables + FK constraints |
| `migration_booking_cancellation.sql` | Booking cancellation tables + FK constraints |
| `migrations.txt` | ALTER TABLE migration statements (315 lines) |
| `add_booking_cancellation_permissions.sql` | Permission seeds for cancellation module |
| `add_quotation_hub_permissions.sql` | Permission seeds for quotation hub |
| `add_transporter_report_permission.sql` | Permission seed for transporter report |
| `incentive_config_migration.sql` | Incentive config table migration |
| `location.sql` | Location seed data |
