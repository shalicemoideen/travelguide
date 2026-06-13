-- =====================================================
-- Receipt Scheduler Tables for Payment Tracking
-- This activates after quotation is confirmed (status=5)
-- =====================================================

-- --------------------------------------------------------
-- Table: receipt_scheduler
-- Main table to define payment type for a confirmed quotation
-- --------------------------------------------------------

CREATE TABLE `receipt_scheduler` (
  `receipt_scheduler_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id_fk` int(11) NOT NULL COMMENT 'FK to quotation table',
  `payment_type` enum('FULL','EMI') NOT NULL COMMENT 'FULL = single payment, EMI = installments',
  `total_amount` double NOT NULL DEFAULT 0 COMMENT 'Total amount to be collected',
  `max_emi_count` int(11) DEFAULT NULL COMMENT 'Maximum EMI count (only for EMI type)',
  `split_type` enum('AMOUNT','PERCENTAGE') DEFAULT NULL COMMENT 'How EMI is split (only for EMI type)',
  `receipt_scheduler_remarks` text DEFAULT NULL,
  `receipt_scheduler_created_by_userid` int(11) NOT NULL,
  `receipt_scheduler_created_by_username` varchar(200) NOT NULL,
  `receipt_scheduler_created_date` date NOT NULL,
  `receipt_scheduler_created_time` time NOT NULL,
  `receipt_scheduler_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',
  PRIMARY KEY (`receipt_scheduler_id`),
  KEY `idx_quotation_id` (`quotation_id_fk`),
  KEY `idx_status` (`receipt_scheduler_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- Table: receipt_scheduler_installments
-- Tracks individual payment installments (FULL or EMI entries)
-- For FULL: single entry with cutoff_date
-- For EMI: multiple entries with due_date and amount/percentage
-- --------------------------------------------------------

CREATE TABLE `receipt_scheduler_installments` (
  `installment_id` int(11) NOT NULL AUTO_INCREMENT,
  `receipt_scheduler_id_fk` int(11) NOT NULL COMMENT 'FK to receipt_scheduler',
  `installment_number` int(11) NOT NULL DEFAULT 1 COMMENT 'EMI number (1 for FULL payment)',
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
  KEY `idx_scheduler_id` (`receipt_scheduler_id_fk`),
  KEY `idx_due_date` (`due_date`),
  KEY `idx_payment_status` (`payment_status`),
  KEY `idx_status` (`installment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- Table: receipt_scheduler_payments (Payment Transactions Log)
-- Records all payment transactions for audit trail
-- --------------------------------------------------------

CREATE TABLE `receipt_scheduler_payments` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `installment_id_fk` int(11) NOT NULL COMMENT 'FK to receipt_scheduler_installments',
  `receipt_scheduler_id_fk` int(11) NOT NULL COMMENT 'FK to receipt_scheduler (for easy lookup)',
  `payment_amount` double NOT NULL,
  `payment_date` date NOT NULL,
  `payment_method` varchar(100) DEFAULT NULL,
  `payment_reference` varchar(255) DEFAULT NULL,
  `payment_remarks` text DEFAULT NULL,
  `payment_received_by_userid` int(11) NOT NULL,
  `payment_received_by_username` varchar(200) NOT NULL,
  `payment_created_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `payment_status` int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted/reversed',
  PRIMARY KEY (`payment_id`),
  KEY `idx_installment_id` (`installment_id_fk`),
  KEY `idx_scheduler_id` (`receipt_scheduler_id_fk`),
  KEY `idx_payment_date` (`payment_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------
-- Add foreign key constraints (optional - uncomment if needed)
-- --------------------------------------------------------

ALTER TABLE `receipt_scheduler`
  ADD CONSTRAINT `fk_receipt_scheduler_quotation`
  FOREIGN KEY (`quotation_id_fk`) REFERENCES `quotation` (`quotation_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `receipt_scheduler_installments`
  ADD CONSTRAINT `fk_installment_scheduler`
  FOREIGN KEY (`receipt_scheduler_id_fk`) REFERENCES `receipt_scheduler` (`receipt_scheduler_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `receipt_scheduler_payments`
  ADD CONSTRAINT `fk_payment_installment`
  FOREIGN KEY (`installment_id_fk`) REFERENCES `receipt_scheduler_installments` (`installment_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;
