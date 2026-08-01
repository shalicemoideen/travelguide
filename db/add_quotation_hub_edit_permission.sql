-- Add separate permission for Edit Quotation button in Quotation Hub
-- Run this SQL to create the new permission entry in tr_permissions
-- Then assign it to roles via Role Management UI

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('QUOTATION_HUB_EDIT', 'EDIT QUOTATION', 'QUOTATION', 'QUOTATION_HUB', 'Edit quotation button in quotation hub', 1, 1, NOW());
