-- Property Credit module permissions
-- Run after migration_property_credit.sql, then assign to roles
-- via Role Management UI.

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('PROPERTY_CREDIT_VIEW',    'VIEW',     'CANCELLATION', 'PROPERTY_CREDIT', 'View property credit ledger', 1, 1, NOW()),
('PROPERTY_CREDIT_CREATE',  'CREATE',   'CANCELLATION', 'PROPERTY_CREDIT', 'Create property credit entries', 1, 1, NOW()),
('PROPERTY_CREDIT_APPLY',   'APPLY',    'CANCELLATION', 'PROPERTY_CREDIT', 'Apply property credit to a booking', 1, 1, NOW()),
('PROPERTY_CREDIT_REVERSE', 'REVERSE',  'CANCELLATION', 'PROPERTY_CREDIT', 'Reverse a credit application', 1, 1, NOW()),
('PROPERTY_CREDIT_REPORT',  'REPORT',   'REPORTS',      'PROPERTY_CREDIT_REPORTS', 'Property credit reports', 1, 1, NOW());


-- Grant everything to SUPER ADMIN
INSERT INTO `tr_role_permissions` (`role_id`, `permission_id`, `assigned_by`, `updated_at`)
SELECT r.id, p.id, 1, NOW()
FROM `tr_roles` r
CROSS JOIN `tr_permissions` p
WHERE UPPER(r.name) = 'SUPER ADMIN'
  AND p.name IN (
    'PROPERTY_CREDIT_VIEW',
    'PROPERTY_CREDIT_CREATE',
    'PROPERTY_CREDIT_APPLY',
    'PROPERTY_CREDIT_REVERSE',
    'PROPERTY_CREDIT_REPORT'
  )
  AND NOT EXISTS (
    SELECT 1 FROM `tr_role_permissions` rp
    WHERE rp.role_id = r.id AND rp.permission_id = p.id
  );
