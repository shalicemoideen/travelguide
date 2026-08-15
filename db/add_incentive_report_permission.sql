-- Add permission for the Incentive Report (converted trips with financial posting done)
-- Run this SQL to create the permission entry in tr_permissions
-- Then assign it to roles via Role Management UI

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('INCENTIVE_REPORT', 'INCENTIVE REPORT', 'REPORTS', 'MAIN REPORTS', 'Incentive Report (converted trips profit and incentive) menu access', 1, 1, NOW());

-- If an earlier build already created this permission as FINANCIAL_POSTING_REPORT,
-- run this instead of the INSERT above:
-- UPDATE `tr_permissions`
--    SET `name` = 'INCENTIVE_REPORT',
--        `display_name` = 'INCENTIVE REPORT',
--        `description` = 'Incentive Report (converted trips profit and incentive) menu access'
--  WHERE `name` = 'FINANCIAL_POSTING_REPORT';
