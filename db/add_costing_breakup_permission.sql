-- Add Costing Breakup (Quotation Details) permission
-- Run this SQL to create the permission entry in tr_permissions
-- Then assign it to roles via Role Management UI

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('COSTING_BREAKUP', 'QUOTATION DETAILS', 'QUOTATION', 'QUOTATION_DETAILS', 'View quotation costing breakup / details', 1, 1, NOW());

-- Grant to Super Admin role automatically
INSERT INTO `tr_role_permissions` (`role_id`, `permission_id`, `assigned_by`, `updated_at`)
SELECT r.id, p.id, 1, NOW()
FROM `tr_roles` r
CROSS JOIN `tr_permissions` p
WHERE UPPER(r.name) = 'SUPER ADMIN'
  AND p.name = 'COSTING_BREAKUP';
