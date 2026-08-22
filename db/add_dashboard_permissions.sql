-- Dashboard module permissions + VIEW_ALL permission
-- Run this SQL, then assign permissions to roles via Role Management UI
-- Dashboard access is granted if user has ANY of the DASHBOARD_* permissions below

-- First remove old permissions if they exist
-- DELETE FROM `tr_permissions` WHERE `name` IN ('DASHBOARD_VIEW','DASHBOARD_COUNT_CARDS','DASHBOARD_PENDING_PAYMENTS');
-- DELETE FROM `tr_role_permissions` WHERE `permission_id_fk` IN (
--   SELECT `permission_id` FROM `tr_permissions` WHERE `name` IN ('DASHBOARD_VIEW','DASHBOARD_COUNT_CARDS','DASHBOARD_PENDING_PAYMENTS')
-- );

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
-- Count cards
('DASHBOARD_TOTAL_LEADS', 'TOTAL LEADS CARD', 'DASHBOARD', 'DASHBOARD', 'View Total Leads count card', 1, 1, NOW()),
('DASHBOARD_CONVERTED_TRIPS', 'CONVERTED TRIPS CARD', 'DASHBOARD', 'DASHBOARD', 'View Converted Trips count card', 1, 1, NOW()),
('DASHBOARD_ARRIVAL', 'ARRIVAL TRIPS CARD', 'DASHBOARD', 'DASHBOARD', 'View Arrival Trips count card', 1, 1, NOW()),
('DASHBOARD_DEPARTURE', 'DEPARTURE TRIPS CARD', 'DASHBOARD', 'DASHBOARD', 'View Departure Trips count card', 1, 1, NOW()),
('DASHBOARD_QUOT_GENERATED', 'QUOTATION GENERATED CARD', 'DASHBOARD', 'DASHBOARD', 'View Quotation Generated count card', 1, 1, NOW()),
('DASHBOARD_QUOT_CONFIRMED', 'QUOTATION CONFIRMED CARD', 'DASHBOARD', 'DASHBOARD', 'View Confirmed count card', 1, 1, NOW()),
('DASHBOARD_QUOT_RESERVATION', 'RESERVATION COMPLETED CARD', 'DASHBOARD', 'DASHBOARD', 'View Reservation Completed count card', 1, 1, NOW()),
('DASHBOARD_DRIVER_NOT_ASSIGNED', 'DRIVER NOT ASSIGNED CARD', 'DASHBOARD', 'DASHBOARD', 'View Driver Not Assigned count card', 1, 1, NOW()),
-- Pending payment cards
('DASHBOARD_CUSTOMER_PAYMENT_PENDING', 'CUSTOMER PAYMENT PENDING CARD', 'DASHBOARD', 'DASHBOARD', 'View Customer Payment Pending card', 1, 1, NOW()),
('DASHBOARD_PROPERTY_PAYMENT_PENDING', 'PROPERTY PAYMENT PENDING CARD', 'DASHBOARD', 'DASHBOARD', 'View Property Payment Pending card', 1, 1, NOW()),
-- Charts
('DASHBOARD_LEADS_INCOMING_CHART', 'LEADS INCOMING CHART', 'DASHBOARD', 'DASHBOARD', 'View Leads Incoming - Last 30 Days chart', 1, 1, NOW()),
('DASHBOARD_LEADS_STATUS_CHART', 'LEADS STATUS CHART', 'DASHBOARD', 'DASHBOARD', 'View Lead Status Breakdown donut chart', 1, 1, NOW()),
('DASHBOARD_STAFF_CHART', 'STAFF CHART', 'DASHBOARD', 'DASHBOARD', 'View Staff - Leads Assigned vs Converted to Trip chart', 1, 1, NOW()),
-- Global
('VIEW_ALL', 'VIEW ALL DATA', 'GLOBAL', 'VIEW ALL', 'When enabled, user sees all data regardless of created_by/user_id. Applies to Dashboard, Lead Report, Converted Trips Report, Quotation Report, Transporter Report, Payment Report', 1, 1, NOW());
