-- Booking Cancellation module permissions
-- Run after migration_booking_cancellation.sql, then assign to roles
-- via Role Management UI.
--
-- SEGREGATION OF DUTIES: do not grant BOOKING_CANCELLATION_CREATE and
-- BOOKING_CANCELLATION_APPROVE to the same role.

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`) VALUES
('BOOKING_CANCELLATION_VIEW',            'VIEW',            'CANCELLATION', 'BOOKING_CANCELLATION', 'View booking cancellations', 1, 1, NOW()),
('BOOKING_CANCELLATION_CREATE',          'CREATE',          'CANCELLATION', 'BOOKING_CANCELLATION', 'Create / edit cancellation draft', 1, 1, NOW()),
('BOOKING_CANCELLATION_APPROVE',         'APPROVE',         'CANCELLATION', 'BOOKING_CANCELLATION', 'Approve or reject a cancellation', 1, 1, NOW()),
('BOOKING_CANCELLATION_CHARGE',          'CHARGE',          'CANCELLATION', 'BOOKING_CANCELLATION', 'Set customer / supplier cancellation charges', 1, 1, NOW()),
('BOOKING_CANCELLATION_REFUND_CUSTOMER', 'REFUND CUSTOMER', 'CANCELLATION', 'BOOKING_CANCELLATION', 'Record customer refunds', 1, 1, NOW()),
('BOOKING_CANCELLATION_REFUND_SUPPLIER', 'REFUND SUPPLIER', 'CANCELLATION', 'BOOKING_CANCELLATION', 'Record supplier refunds received', 1, 1, NOW()),
('BOOKING_CANCELLATION_REFUND_APPROVE',  'REFUND APPROVE',  'CANCELLATION', 'BOOKING_CANCELLATION', 'Accountant approval of customer refunds', 1, 1, NOW()),
('BOOKING_CANCELLATION_REFUND_REVERSE',  'REFUND REVERSE',  'CANCELLATION', 'BOOKING_CANCELLATION', 'Reverse a refund entry', 1, 1, NOW()),
('BOOKING_CANCELLATION_ADJUST',          'ADJUST',          'CANCELLATION', 'BOOKING_CANCELLATION', 'Manual adjustments and write-offs', 1, 1, NOW()),
('BOOKING_CANCELLATION_REVERSE',         'REVERSE',         'CANCELLATION', 'BOOKING_CANCELLATION', 'Reverse / un-cancel a booking', 1, 1, NOW()),
('BOOKING_CANCELLATION_TRACKER',         'TRACKER',         'CANCELLATION', 'BOOKING_CANCELLATION', 'Supplier refund tracker worklist', 1, 1, NOW()),
('BOOKING_CANCELLATION_REPORT',          'CANCELLATION REPORT', 'REPORTS', 'CANCELLATION_REPORTS', 'Cancellation report', 1, 1, NOW()),
('BOOKING_CANCELLATION_PNL_REPORT',      'CANCELLATION P&L',    'REPORTS', 'CANCELLATION_REPORTS', 'Cancellation P&L report', 1, 1, NOW());


-- Grant everything to SUPER ADMIN
INSERT INTO `tr_role_permissions` (`role_id`, `permission_id`, `assigned_by`, `updated_at`)
SELECT r.id, p.id, 1, NOW()
FROM `tr_roles` r
CROSS JOIN `tr_permissions` p
WHERE UPPER(r.name) = 'SUPER ADMIN'
  AND p.name IN (
    'BOOKING_CANCELLATION_VIEW',
    'BOOKING_CANCELLATION_CREATE',
    'BOOKING_CANCELLATION_APPROVE',
    'BOOKING_CANCELLATION_CHARGE',
    'BOOKING_CANCELLATION_REFUND_CUSTOMER',
    'BOOKING_CANCELLATION_REFUND_SUPPLIER',
    'BOOKING_CANCELLATION_REFUND_APPROVE',
    'BOOKING_CANCELLATION_REFUND_REVERSE',
    'BOOKING_CANCELLATION_ADJUST',
    'BOOKING_CANCELLATION_REVERSE',
    'BOOKING_CANCELLATION_TRACKER',
    'BOOKING_CANCELLATION_REPORT',
    'BOOKING_CANCELLATION_PNL_REPORT'
  )
  AND NOT EXISTS (
    SELECT 1 FROM `tr_role_permissions` rp
    WHERE rp.role_id = r.id AND rp.permission_id = p.id
  );
