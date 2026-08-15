-- Add permission for the standalone Financial Posting page (listing + add/edit)
-- Run this SQL to create the permission entry in tr_permissions
-- Then assign it to roles via Role Management UI
--
-- Note: this is separate from FINANCIAL_POSTING, which controls the financial
-- posting tab inside the quotation hub.

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('FINANCIAL_POSTING_REPORT', 'FINANCIAL POSTING REPORT', 'REPORTS', 'MAIN REPORTS', 'Standalone Financial Posting page: list postings and add/edit them', 1, 1, NOW());
