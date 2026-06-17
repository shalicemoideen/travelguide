-- =====================================================
-- Property Reservation (Hotel Reservation Status) Tables
-- Three-Level Confirmation with Property Owners
-- =====================================================
-- Flow: Client confirms quotation → Properties need owner confirmation
-- Level 1: Hotel Blocking  → Level 2: Reservation Confirmation → Level 3: Re-confirmation
--
-- DESIGN RATIONALE:
--   All three confirmation levels are 1:1 with a property reservation,
--   so their fields are flattened into the main table (no JOIN overhead).
--   Only genuinely 1:N relationships are kept as separate tables:
--     - property_reservation_installments  (many installments per reservation)
--     - property_reservation_comments      (many comments per reservation)
-- =====================================================

-- --------------------------------------------------------
-- Table: property_reservation
-- One record per property per confirmed quotation.
-- Contains booking info + all three level details as columns.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `property_reservation` (
  `property_reservation_id` int(11) NOT NULL AUTO_INCREMENT,

  -- ── Booking Context ──────────────────────────────────
  `quotation_id_fk` int(11) NOT NULL COMMENT 'FK to quotation',
  `quotation_confirmation_id_fk` int(11) DEFAULT NULL COMMENT 'FK to quotation_confirmation (already pins day+property+room)',
  `properties_id_fk` int(11) NOT NULL COMMENT 'FK to properties (the hotel)',
  `booking_number` varchar(255) NOT NULL COMMENT 'e.g. 2-26-326',
  `guest_name` varchar(255) NOT NULL,
  `check_in_date` date NOT NULL,
  `check_out_date` date NOT NULL,
  `duration_nights` int(11) NOT NULL DEFAULT 1,

  -- ── Level 1: Hotel Blocking ───────────────────────────
  -- Status: PENDING until this section is submitted
  `blocking_status` enum('PENDING','BLOCKED') NOT NULL DEFAULT 'PENDING',
  `blocking_cnfm_by` varchar(255) DEFAULT NULL COMMENT 'CNFM By field',
  `blocking_cutoff_date` date DEFAULT NULL COMMENT 'Cut-off Date field',
  `blocking_date` date DEFAULT NULL COMMENT 'Blocked Date field',
  `blocking_done_by_userid` int(11) DEFAULT NULL,
  `blocking_done_datetime` datetime DEFAULT NULL,

  -- ── Level 2: Reservation Confirmation ────────────────
  -- Status: PENDING until this section is submitted
  `confirmation_status` enum('PENDING','CONFIRMED') NOT NULL DEFAULT 'PENDING',
  `confirmation_cnfm_by` varchar(255) DEFAULT NULL COMMENT 'CNFM By field',
  `confirmation_cnfm_no` varchar(255) DEFAULT NULL COMMENT 'CNFM No field',
  `confirmation_cnfm_date` date DEFAULT NULL COMMENT 'CNFM Date field',
  `confirmation_done_by_userid` int(11) DEFAULT NULL,
  `confirmation_done_datetime` datetime DEFAULT NULL,
  -- NOTE: Payment Scheduler for Level 2 lives in `property_payment_scheduler`
  --       (mirrors the client-side receipt_scheduler design: FULL / EMI)

  -- ── Level 3: Re-confirmation ──────────────────────────
  -- Status: PENDING until this section is submitted
  `reconfirmation_status` enum('PENDING','RECONFIRMED') NOT NULL DEFAULT 'PENDING',
  `reconfirmation_cnfm_by` varchar(255) DEFAULT NULL COMMENT 'CNFM By field',
  `reconfirmation_cnfm_no` varchar(255) DEFAULT NULL COMMENT 'CNFM No field',
  `reconfirmation_date` date DEFAULT NULL COMMENT 'RE-CNFM Date field',
  `reconfirmation_done_by_userid` int(11) DEFAULT NULL,
  `reconfirmation_done_datetime` datetime DEFAULT NULL,

  -- ── Record Audit ──────────────────────────────────────
  `property_reservation_created_by_userid` int(11) NOT NULL,
  `property_reservation_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `property_reservation_updated_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `property_reservation_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',

  PRIMARY KEY (`property_reservation_id`),
  KEY `idx_quotation_id` (`quotation_id_fk`),
  KEY `idx_properties_id` (`properties_id_fk`),
  KEY `idx_quotation_confirmation_id` (`quotation_confirmation_id_fk`),
  KEY `idx_booking_number` (`booking_number`),
  KEY `idx_check_in_date` (`check_in_date`),
  KEY `idx_blocking_status` (`blocking_status`),
  KEY `idx_confirmation_status` (`confirmation_status`),
  KEY `idx_reconfirmation_status` (`reconfirmation_status`),
  KEY `idx_status` (`property_reservation_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- =====================================================
-- Property Payment Scheduler
-- Mirrors the client-side `receipt_scheduler` design so both
-- payment flows share the same structure & logic.
-- payment_type: FULL = single payment, EMI = installments
-- =====================================================

-- --------------------------------------------------------
-- Table: property_payment_scheduler
-- Payment header for what WE pay the property owner.
-- One scheduler per property reservation (Level 2 = Confirmed).
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `property_payment_scheduler` (
  `property_payment_scheduler_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_reservation_id_fk` int(11) NOT NULL COMMENT 'FK to property_reservation',
  `quotation_id_fk` int(11) NOT NULL COMMENT 'FK to quotation (for easy lookup)',
  `payment_type` enum('FULL','EMI') NOT NULL COMMENT 'FULL = single payment, EMI = installments',
  `total_amount` double NOT NULL DEFAULT 0 COMMENT 'Total amount payable to property',
  `currency` varchar(10) NOT NULL DEFAULT 'INR',
  `max_emi_count` int(11) DEFAULT NULL COMMENT 'Max EMI count (EMI only)',
  `split_type` enum('AMOUNT','PERCENTAGE') DEFAULT NULL COMMENT 'How EMI is split (EMI only)',
  `property_payment_scheduler_remarks` text DEFAULT NULL,
  `property_payment_scheduler_created_by_userid` int(11) NOT NULL,
  `property_payment_scheduler_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `property_payment_scheduler_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',
  PRIMARY KEY (`property_payment_scheduler_id`),
  KEY `idx_property_reservation_id` (`property_reservation_id_fk`),
  KEY `idx_quotation_id` (`quotation_id_fk`),
  KEY `idx_status` (`property_payment_scheduler_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- Table: property_payment_scheduler_installments
-- 1:N installment rows. FULL = single row with cutoff/due date,
-- EMI = multiple rows with amount/percentage + due dates.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `property_payment_scheduler_installments` (
  `installment_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_payment_scheduler_id_fk` int(11) NOT NULL COMMENT 'FK to property_payment_scheduler',
  `installment_number` int(11) NOT NULL DEFAULT 1 COMMENT 'EMI number (1 for FULL)',
  `installment_amount` double DEFAULT NULL COMMENT 'Fixed amount (if split_type=AMOUNT)',
  `installment_percentage` double DEFAULT NULL COMMENT 'Percentage (if split_type=PERCENTAGE)',
  `calculated_amount` double NOT NULL DEFAULT 0 COMMENT 'Actual amount to pay (calculated)',
  `due_date` date NOT NULL COMMENT 'Cutoff date for FULL / Due date for EMI',
  `payment_status` enum('PENDING','PARTIAL','PAID','OVERDUE') NOT NULL DEFAULT 'PENDING',
  `paid_amount` double NOT NULL DEFAULT 0,
  `paid_date` date DEFAULT NULL,
  `payment_reference` varchar(255) DEFAULT NULL COMMENT 'Transaction/receipt reference',
  `payment_method` varchar(100) DEFAULT NULL COMMENT 'Cash/Card/UPI/Bank Transfer etc.',
  `installment_remarks` text DEFAULT NULL,
  `installment_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `installment_updated_date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `installment_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',
  PRIMARY KEY (`installment_id`),
  KEY `idx_scheduler_id` (`property_payment_scheduler_id_fk`),
  KEY `idx_due_date` (`due_date`),
  KEY `idx_payment_status` (`payment_status`),
  KEY `idx_status` (`installment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- Table: property_payment_scheduler_payments
-- Payment transactions log (audit trail) for property payments.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `property_payment_scheduler_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `installment_id_fk` int(11) NOT NULL COMMENT 'FK to property_payment_scheduler_installments',
  `property_payment_scheduler_id_fk` int(11) NOT NULL COMMENT 'FK to property_payment_scheduler (for easy lookup)',
  `payment_amount` double NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `payment_reference` varchar(255) DEFAULT NULL,
  `payment_remarks` text DEFAULT NULL,
  `payment_paid_by_userid` int(11) NOT NULL,
  `payment_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted/reversed',
  PRIMARY KEY (`payment_id`),
  KEY `idx_installment_id` (`installment_id_fk`),
  KEY `idx_scheduler_id` (`property_payment_scheduler_id_fk`),
  KEY `idx_payment_date` (`payment_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- Table: property_reservation_comments
-- 1:N — multiple comment entries per reservation over time.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `property_reservation_comments` (
  `property_reservation_comments_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_reservation_id_fk` int(11) NOT NULL COMMENT 'FK to property_reservation',
  `comment_text` text NOT NULL,
  `comment_created_by_userid` int(11) NOT NULL,
  `comment_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `comment_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',
  PRIMARY KEY (`property_reservation_comments_id`),
  KEY `idx_property_reservation_id` (`property_reservation_id_fk`),
  KEY `idx_status` (`comment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- Foreign Key Constraints
-- --------------------------------------------------------

ALTER TABLE `property_reservation`
  ADD CONSTRAINT `fk_prop_res_quotation`
  FOREIGN KEY (`quotation_id_fk`) REFERENCES `quotation` (`quotation_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `property_reservation`
  ADD CONSTRAINT `fk_prop_res_quotation_confirmation`
  FOREIGN KEY (`quotation_confirmation_id_fk`) REFERENCES `quotation_confirmation` (`id`)
  ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `property_reservation`
  ADD CONSTRAINT `fk_prop_res_properties`
  FOREIGN KEY (`properties_id_fk`) REFERENCES `properties` (`properties_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `property_payment_scheduler`
  ADD CONSTRAINT `fk_prop_pay_scheduler_reservation`
  FOREIGN KEY (`property_reservation_id_fk`) REFERENCES `property_reservation` (`property_reservation_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `property_payment_scheduler`
  ADD CONSTRAINT `fk_prop_pay_scheduler_quotation`
  FOREIGN KEY (`quotation_id_fk`) REFERENCES `quotation` (`quotation_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `property_payment_scheduler_installments`
  ADD CONSTRAINT `fk_prop_pay_installment_scheduler`
  FOREIGN KEY (`property_payment_scheduler_id_fk`) REFERENCES `property_payment_scheduler` (`property_payment_scheduler_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `property_payment_scheduler_payments`
  ADD CONSTRAINT `fk_prop_pay_payment_installment`
  FOREIGN KEY (`installment_id_fk`) REFERENCES `property_payment_scheduler_installments` (`installment_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `property_reservation_comments`
  ADD CONSTRAINT `fk_prop_res_comments_reservation`
  FOREIGN KEY (`property_reservation_id_fk`) REFERENCES `property_reservation` (`property_reservation_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;
