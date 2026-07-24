-- Add separate permission for the Transporter Report
-- Run this SQL to create the permission entry in tr_permissions
-- Then assign it to roles via Role Management UI

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('TRANSPORTER_REPORT', 'TRANSPORTER REPORT', 'REPORTS', 'MAIN REPORTS', 'Transporter Report (Driver Not Assigned) menu access and update', 1, 1, NOW());
