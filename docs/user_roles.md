# User Roles & Permissions

## Overview

The application implements role-based access control (RBAC) with three layers:

1. **Roles** (`tr_roles`) — Named roles assigned to users
2. **Permissions** (`tr_permissions`) — Granular permission keys grouped by module
3. **Role-Permission Mapping** (`tr_role_permissions`) — Many-to-many mapping

## Authentication Flow

```
User submits login form
  │
  ▼
Login/ajax_login
  │
  ▼
Loginmodel::checkUserLogin()
  ├── Load active user by user_name only (no password in SQL)
  ├── Verify password with password_verify() against the stored hash
  │     └── Legacy plaintext passwords are accepted once, then transparently
  │         re-hashed via password_hash(PASSWORD_DEFAULT) (rehash-on-login)
  ├── Check user_status = 1 (active)
  └── Fetch user details + role (password hash stripped before session set)
  │
  ▼
Loginmodel::get_user_permissions_by_role($role_id)
  ├── JOIN tr_role_permissions + tr_permissions
  ├── WHERE role_id = user's role AND status = 1
  └── Return permission name array
  │
  ▼
Session set:
  ├── user_id
  ├── user_name
  ├── admin_name
  ├── user_type
  ├── role_id
  ├── role_name
  ├── permissions (array of permission names)
  └── logged_in = true
  │
  ▼
Redirect to Dashboard
```

## Permission Checking

Permissions are checked in controllers and views using helper functions:

### `has_permission($permission)`

Checks if the current session has a specific permission.

```php
// application/helpers/permission_helper.php
function has_permission($permission) {
    $permissions = $this->session->userdata('permissions');
    return in_array($permission, $permissions);
}
```

Usage in controllers:
```php
if (!has_permission('QUOTATION_CREATE')) {
    show_404();
}
```

Usage in views:
```php
<?php if (has_permission('QUOTATION_DELETE')): ?>
    <button class="btn-delete">Delete</button>
<?php endif; ?>
```

### `has_any_permission($permissions)`

Checks if the session has at least one of the given permissions.

```php
if (!has_any_permission(['QUOTATION_CREATE', 'QUOTATION_EDIT'])) {
    show_404();
}
```

## Role Master (`tr_roles`)

| ID | Name | Description |
|----|------|-------------|
| 1 | Super Admin | Full access to all modules |
| 2 | Admin | Administrative access |
| 3 | Manager | Management-level access |
| 4 | Sales Staff | Sales operations |
| 5 | Operations | Property reservations, operations |
| 6 | Accounts | Payment management, cancellations |
| (custom) | ... | User-defined roles |

## Permission Modules

Permissions are grouped by module and sub-module:

| Module | Sub-Module | Example Permissions |
|--------|-----------|-------------------|
| STAFF MANAGEMENT | STAFF | STAFF_VIEW, STAFF_CREATE, STAFF_EDIT, STAFF_DELETE |
| STAFF MANAGEMENT | ROLE | ROLE_VIEW, ROLE_CREATE, ROLE_EDIT, ROLE_DELETE |
| STAFF MANAGEMENT | PERMISSION | PERMISSION_VIEW, PERMISSION_CREATE, PERMISSION_EDIT, PERMISSION_DELETE |
| LEAD MANAGEMENT | LEAD | LEAD_VIEW, LEAD_CREATE, LEAD_EDIT, LEAD_DELETE |
| QUOTATION | QUOTATION | QUOTATION_VIEW, QUOTATION_CREATE, QUOTATION_EDIT, QUOTATION_DELETE |
| QUOTATION | QUOTATION_HUB | QUOTATION_HUB_VIEW, QUOTATION_HUB_CREATE |
| QUOTATION | QUOTATION_REVIEW | QUOTATION_REVIEW_VIEW, QUOTATION_REVIEW_APPROVE |
| PROPERTY | PROPERTY | PROPERTY_VIEW, PROPERTY_CREATE, PROPERTY_EDIT, PROPERTY_DELETE |
| PROPERTY | RESERVATION | RESERVATION_VIEW, RESERVATION_CREATE, RESERVATION_EDIT |
| BOOKING CANCELLATION | CANCELLATION | CANCELLATION_VIEW, CANCELLATION_CREATE, CANCELLATION_APPROVE, CANCELLATION_SETTLE |
| PAYMENT | RECEIPT_SCHEDULER | PAYMENT_VIEW, PAYMENT_CREATE, PAYMENT_EDIT, PAYMENT_RECORD |
| PAYMENT | PROPERTY_PAYMENT | PROPERTY_PAYMENT_VIEW, PROPERTY_PAYMENT_RECORD |
| PACKAGE | PACKAGE | PACKAGE_VIEW, PACKAGE_CREATE, PACKAGE_EDIT, PACKAGE_DELETE |
| ROOM TARIFF | TARIFF | TARIFF_VIEW, TARIFF_CREATE, TARIFF_EDIT, TARIFF_DELETE |
| REPORTS | TRANSPORTER | TRANSPORTER_REPORT_VIEW |
| DASHBOARD | DASHBOARD | DASHBOARD_VIEW |
| ATTENDANCE | ATTENDANCE | ATTENDANCE_VIEW, ATTENDANCE_SYNC |

## Role Management

### Creating a Role

1. Admin navigates to Roles list
2. Clicks "Add Role"
3. Enters role name and description
4. Selects module-level privileges (checkboxes per module/sub-module)
5. On save:
   - INSERT into `tr_roles`
   - INSERT into `tr_role_permissions` for each selected permission
   - Log activity

### Editing a Role

1. Admin clicks edit on a role
2. Role details + current permissions loaded
3. Admin modifies privileges
4. On save:
   - UPDATE `tr_roles`
   - DELETE existing `tr_role_permissions` for role
   - INSERT new `tr_role_permissions` for each selected permission
   - Log activity

### User Assignment

Users are assigned a role via `user_details.role_id_fk`. When a user logs in, their permissions are loaded from the role-permission mapping and stored in session.

## Session Data

| Session Key | Description |
|-------------|-------------|
| `user_id` | User's ID from `user_details` |
| `user_name` | Login username |
| `admin_name` | Display name |
| `user_type` | User type (A=Admin, etc.) |
| `role_id` | Role ID |
| `role_name` | Role name |
| `permissions` | Array of permission name strings |
| `logged_in` | Boolean |

## Permission Seeds

Additional permissions are added via SQL migration files:

- `db/add_booking_cancellation_permissions.sql` — Cancellation module permissions
- `db/add_quotation_hub_permissions.sql` — Quotation hub permissions
- `db/add_transporter_report_permission.sql` — Transporter report permission
- `db/migrations.txt` — Quotation review permission

## Security Notes

- **Password storage**: Passwords are stored as secure hashes in `user_details.password` using PHP `password_hash()` with `PASSWORD_DEFAULT`; verified with `password_verify()`. Legacy plaintext passwords are transparently upgraded to hashes on the user's next successful login (rehash-on-login). The password hash is never returned to the UI or stored in the session.
- **Session-based auth**: File-based sessions; expires on browser close
- **CSRF protection**: Enabled with token regeneration
- **XSS filtering**: Applied via form validation rules
- **No API tokens**: All endpoints use session cookies; no token-based API auth
- **Public endpoints**: Only `Client_confirmation/view/{token}` and webhook endpoints are public
