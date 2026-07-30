-- Add Payment Report (combined customer and property payment report) permission
-- Run this SQL to create the permission entry in tr_permissions
-- Then assign it to roles via Role Management UI

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('PAYMENT_REPORT', 'PAYMENT REPORT', 'REPORTS', 'MAIN REPORTS', 'Combined customer and property payment report menu access', 1, 1, NOW());

-- Grant to Super Admin role automatically
INSERT INTO `tr_role_permissions` (`role_id`, `permission_id`, `assigned_by`, `updated_at`)
SELECT r.id, p.id, 1, NOW()
FROM `tr_roles` r
CROSS JOIN `tr_permissions` p
WHERE UPPER(r.name) = 'SUPER ADMIN'
  AND p.name = 'PAYMENT_REPORT';
