-- =====================================================
-- Property Change on Confirmed Quotation
-- =====================================================
-- When the client edits the confirmation page and swaps one
-- property for another, the reservation already raised against
-- the old property (and any money paid to it) must stay visible
-- and auditable instead of silently dropping out of every
-- confirmation-driven query.
--
-- Design principles (consistent with booking_cancellation and
-- property_credit_ledger):
--   * Additive only — no column is dropped or renamed.
--   * Money columns use DECIMAL(14,2).
--   * Financials are snapshotted at the moment the property is
--     superseded, because the live amount is derived from
--     quotation_confirmation rows that are about to be
--     deactivated.
--   * State transitions use an enum, not a boolean flag.
--   * Historical rows stay valid: every added column is either
--     nullable or carries a default matching today's behaviour.
-- =====================================================


-- --------------------------------------------------------
-- 1. property_reservation: lifecycle state + cancellation
-- --------------------------------------------------------
-- ACTIVE      the property is on the current confirmation
-- SUPERSEDED  the client swapped this property out; the
--             reservation is retained for cancellation/audit
-- CANCELLED   the reservation was formally cancelled and the
--             recoverable amount pushed to the credit ledger
--
-- Existing rows default to ACTIVE, so every current query and
-- the reconfirmed==total completion gate behave exactly as before.
-- --------------------------------------------------------

ALTER TABLE `property_reservation`
  ADD COLUMN `reservation_state` enum('ACTIVE','SUPERSEDED','CANCELLED')
      NOT NULL DEFAULT 'ACTIVE'
      COMMENT 'lifecycle state; SUPERSEDED = client changed to another property'
      AFTER `duration_nights`,

  ADD COLUMN `snap_reservation_amount` decimal(14,2) DEFAULT NULL
      COMMENT 'property total captured when superseded (confirmation rows are deactivated after)'
      AFTER `reservation_state`,

  ADD COLUMN `snap_paid_amount` decimal(14,2) DEFAULT NULL
      COMMENT 'amount already paid to the property when superseded'
      AFTER `snap_reservation_amount`,

  ADD COLUMN `superseded_by_properties_id_fk` int(11) DEFAULT NULL
      COMMENT 'property that replaced this one on the confirmation, when unambiguous'
      AFTER `snap_paid_amount`,

  ADD COLUMN `superseded_datetime` datetime DEFAULT NULL
      AFTER `superseded_by_properties_id_fk`,

  ADD COLUMN `cancellation_amount` decimal(14,2) DEFAULT NULL
      COMMENT 'manually entered recoverable amount, pushed to property_credit_ledger'
      AFTER `superseded_datetime`,

  ADD COLUMN `cancellation_date` date DEFAULT NULL
      AFTER `cancellation_amount`,

  ADD COLUMN `cancellation_reason` varchar(500) DEFAULT NULL
      AFTER `cancellation_date`,

  ADD COLUMN `cancelled_by_userid` int(11) DEFAULT NULL
      AFTER `cancellation_reason`,

  ADD COLUMN `cancelled_by_username` varchar(200) DEFAULT NULL
      AFTER `cancelled_by_userid`,

  ADD COLUMN `cancelled_datetime` datetime DEFAULT NULL
      AFTER `cancelled_by_username`,

  ADD KEY `idx_reservation_state` (`reservation_state`);


-- --------------------------------------------------------
-- 2. property_credit_ledger: allow non-cancellation origins
-- --------------------------------------------------------
-- A property swap is not a booking cancellation — the booking is
-- still alive, only the hotel changed. The two cancellation FKs
-- therefore become nullable so the existing ledger can carry both
-- origins. MySQL does not enforce a foreign key on a NULL value,
-- so fk_pcl_cancellation / fk_pcl_cancellation_property stay in
-- place untouched and keep protecting cancellation-origin rows.
-- --------------------------------------------------------

ALTER TABLE `property_credit_ledger`
  MODIFY COLUMN `booking_cancellation_id_fk` int(11) DEFAULT NULL
      COMMENT 'NULL when credit_origin = PROPERTY_CHANGE',

  MODIFY COLUMN `cancellation_property_id_fk` int(11) DEFAULT NULL
      COMMENT 'NULL when credit_origin = PROPERTY_CHANGE',

  ADD COLUMN `credit_origin` enum('BOOKING_CANCELLATION','PROPERTY_CHANGE')
      NOT NULL DEFAULT 'BOOKING_CANCELLATION'
      COMMENT 'what produced this credit'
      AFTER `quotation_id_fk`,

  -- UNIQUE, so a property-change credit can never be created twice for the
  -- same reservation. MySQL allows repeated NULLs in a unique index, so
  -- booking-cancellation credits (which leave this NULL) are unaffected.
  ADD COLUMN `property_change_reservation_id_fk` int(11) DEFAULT NULL
      COMMENT 'the superseded reservation that was cancelled',

  ADD UNIQUE KEY `uq_property_change_reservation` (`property_change_reservation_id_fk`),

  ADD KEY `idx_credit_origin` (`credit_origin`);

-- Existing rows were all produced by the cancellation module and
-- keep credit_origin = 'BOOKING_CANCELLATION' via the column default.

ALTER TABLE `property_credit_ledger`
  ADD CONSTRAINT `fk_pcl_property_change_reservation`
  FOREIGN KEY (`property_change_reservation_id_fk`)
  REFERENCES `property_reservation` (`property_reservation_id`)
  ON DELETE SET NULL ON UPDATE CASCADE;


-- --------------------------------------------------------
-- 3. Permission for the cancel action
-- --------------------------------------------------------

INSERT INTO `tr_permissions` (`name`, `display_name`, `module`, `sub_module`, `description`, `status`, `created_by`, `created_at`)
SELECT 'PROPERTY_RESERVATION_CANCEL', 'CANCEL', 'QUOTATION', 'QUOTATION_HUB',
       'Cancel a superseded property reservation and record the credit', 1, 1, NOW()
FROM DUAL
WHERE NOT EXISTS (
  SELECT 1 FROM `tr_permissions` WHERE `name` = 'PROPERTY_RESERVATION_CANCEL'
);

INSERT INTO `tr_role_permissions` (`role_id`, `permission_id`, `assigned_by`, `updated_at`)
SELECT r.id, p.id, 1, NOW()
FROM `tr_roles` r
CROSS JOIN `tr_permissions` p
WHERE UPPER(r.name) = 'SUPER ADMIN'
  AND p.name = 'PROPERTY_RESERVATION_CANCEL'
  AND NOT EXISTS (
    SELECT 1 FROM `tr_role_permissions` rp
    WHERE rp.role_id = r.id AND rp.permission_id = p.id
  );
