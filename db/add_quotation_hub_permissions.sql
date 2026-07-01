-- Add Quotation Hub granular permissions
-- Run this SQL to create the new permission entries in tr_permissions
-- Then assign them to roles via Role Management UI

INSERT INTO `tr_permissions` (`name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('CLIENT_CONFIRMATION', 'QUOTATION', 'QUOTATION_HUB', 'Client confirmation tab in quotation hub', 1, 1, NOW()),
('RECEIPT_SCHEDULER', 'QUOTATION', 'QUOTATION_HUB', 'Receipt scheduler tab in quotation hub', 1, 1, NOW()),
('PROPERTY_RESERVATION', 'QUOTATION', 'QUOTATION_HUB', 'Property reservation tab in quotation hub', 1, 1, NOW()),
('PROPERTY_VOUCHER', 'QUOTATION', 'QUOTATION_HUB', 'Property voucher tab in quotation hub', 1, 1, NOW()),
('TOUR_VOUCHER', 'QUOTATION', 'QUOTATION_HUB', 'Tour voucher tab in quotation hub', 1, 1, NOW()),
('DRIVER_ITINERARY', 'QUOTATION', 'QUOTATION_HUB', 'Driver itinerary tab in quotation hub', 1, 1, NOW()),
('GENERATE_QUOTATION', 'QUOTATION', 'QUOTATION_HUB', 'Generate quotation button in quotation hub', 1, 1, NOW()),
('CONFIRM_QUOTATION', 'QUOTATION', 'QUOTATION_HUB', 'Confirm quotation button in quotation hub', 1, 1, NOW()),
('FINANCIAL_POSTING', 'QUOTATION', 'QUOTATION_HUB', 'Financial posting tab in quotation hub', 1, 1, NOW());
