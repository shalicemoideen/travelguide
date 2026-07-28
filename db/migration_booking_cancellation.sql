-- =====================================================
-- Booking Cancellation Module
-- =====================================================
-- Cancellation is an EVENT, not a deletion.
--   * No existing table is altered (except two optional indexes at the bottom).
--   * receipt_scheduler_* and property_payment_scheduler_* rows are NEVER
--     modified or deleted by this module -- they are referenced only.
--   * Financial figures are SNAPSHOT into the cancellation record so the
--     P&L that was approved stays reproducible even if late payments arrive.
--   * Refund rows are append-only; corrections are contra rows
--     (refund_entry_type = 'REVERSAL'), never UPDATE/DELETE.
--
-- Booking status reuses the existing quotation.quotation_current_status = 6
-- (Cancelled). No new booking status value is introduced.
--
-- Money columns use DECIMAL(14,2). The legacy tables use `double`, which
-- drifts on partial refunds -- cast at the join boundary, not in storage.
-- =====================================================


-- --------------------------------------------------------
-- Table: booking_cancellation_reason  (master)
-- reason_category drives whether the charge is guest-fault (charge applies)
-- or company-fault (full refund, loss booked to the company).
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `booking_cancellation_reason` (
  `cancellation_reason_id`       int(11) NOT NULL AUTO_INCREMENT,
  `reason_code`                  varchar(50)  NOT NULL,
  `reason_name`                  varchar(255) NOT NULL,
  `reason_category`              enum('GUEST','COMPANY','SUPPLIER','FORCE_MAJEURE','NO_SHOW','OTHER')
                                 NOT NULL DEFAULT 'GUEST',
  `is_charge_waivable`           tinyint(1) NOT NULL DEFAULT 0
                                 COMMENT '1 = allows zero-charge full refund without extra approval',
  `reason_sort_order`            int(11) NOT NULL DEFAULT 0,
  `reason_created_by_userid`     int(11) NOT NULL DEFAULT 1,
  `reason_created_datetime`      datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancellation_reason_status`   int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',
  PRIMARY KEY (`cancellation_reason_id`),
  UNIQUE KEY `uq_reason_code` (`reason_code`),
  KEY `idx_status` (`cancellation_reason_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Table: booking_cancellation  (header)
-- One ACTIVE cancellation per booking; historical rows may coexist.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `booking_cancellation` (
  `booking_cancellation_id`       int(11) NOT NULL AUTO_INCREMENT,
  `cancellation_number`           varchar(50) NOT NULL COMMENT 'CAN-2026-00001',

  -- Booking context
  `quotation_id_fk`               int(11) NOT NULL,
  `leads_id_fk`                   int(11) NOT NULL COMMENT 'denormalised for report joins',
  `quotation_options_id_fk`       int(11) DEFAULT NULL COMMENT 'confirmed option being cancelled',
  `cancellation_scope`            enum('FULL','PARTIAL') NOT NULL DEFAULT 'FULL',

  -- Reason & dates
  `cancellation_reason_id_fk`     int(11) DEFAULT NULL,
  `cancellation_reason_notes`     text DEFAULT NULL,
  `cancellation_request_date`     date NOT NULL COMMENT 'date the guest requested',
  `cancellation_effective_date`   date NOT NULL COMMENT 'date used for policy slab calc',
  `travel_start_date`             date DEFAULT NULL COMMENT 'snapshot of leads.start_date',
  `days_before_travel`            int(11) DEFAULT NULL COMMENT 'signed; negative = after departure',

  -- Customer snapshot
  `snap_package_value`            decimal(14,2) NOT NULL DEFAULT 0.00,
  `snap_customer_received`        decimal(14,2) NOT NULL DEFAULT 0.00,
  `snap_customer_outstanding`     decimal(14,2) NOT NULL DEFAULT 0.00,
  `customer_cancellation_charge`  decimal(14,2) NOT NULL DEFAULT 0.00
                                  COMMENT 'amount the company retains from the customer',
  `customer_charge_is_override`   tinyint(1) NOT NULL DEFAULT 0,
  `customer_charge_override_note` varchar(500) DEFAULT NULL,
  `customer_refund_due`           decimal(14,2) NOT NULL DEFAULT 0.00
                                  COMMENT 'negative = customer still owes the company',
  `customer_refund_paid`          decimal(14,2) NOT NULL DEFAULT 0.00,
  `customer_settlement_status`    enum('NOT_APPLICABLE','PENDING','PARTIAL','COMPLETED','WRITTEN_OFF')
                                  NOT NULL DEFAULT 'PENDING',

  -- Supplier snapshot
  `snap_supplier_booked`          decimal(14,2) NOT NULL DEFAULT 0.00,
  `snap_supplier_paid`            decimal(14,2) NOT NULL DEFAULT 0.00,
  `supplier_cancellation_charge`  decimal(14,2) NOT NULL DEFAULT 0.00,
  `supplier_refund_expected`      decimal(14,2) NOT NULL DEFAULT 0.00,
  `supplier_refund_received`      decimal(14,2) NOT NULL DEFAULT 0.00,
  `supplier_still_payable`        decimal(14,2) NOT NULL DEFAULT 0.00
                                  COMMENT 'charge exceeded what we had paid -> we still owe them',
  `supplier_settlement_status`    enum('NOT_APPLICABLE','PENDING','PARTIAL','COMPLETED','WRITTEN_OFF')
                                  NOT NULL DEFAULT 'PENDING',

  -- Final P&L (recomputed on every money event)
  `net_retained_from_customer`    decimal(14,2) NOT NULL DEFAULT 0.00,
  `net_paid_to_suppliers`         decimal(14,2) NOT NULL DEFAULT 0.00,
  `net_other_cost`                decimal(14,2) NOT NULL DEFAULT 0.00
                                  COMMENT 'transport, visa, gateway fees, non-recoverable services',
  `net_adjustment_total`          decimal(14,2) NOT NULL DEFAULT 0.00,
  `net_result`                    decimal(14,2) NOT NULL DEFAULT 0.00
                                  COMMENT 'positive = company profit, negative = loss',
  `pnl_last_computed_datetime`    datetime DEFAULT NULL,

  -- Workflow
  `cancellation_status`           enum('DRAFT','PENDING_APPROVAL','APPROVED','SETTLED','REJECTED','REVERSED')
                                  NOT NULL DEFAULT 'DRAFT',
  `previous_quotation_status`     int(11) DEFAULT NULL COMMENT 'for safe reversal',
  `requested_by_userid`           int(11) NOT NULL,
  `requested_by_username`         varchar(200) NOT NULL,
  `approved_by_userid`            int(11) DEFAULT NULL,
  `approved_by_username`          varchar(200) DEFAULT NULL,
  `approved_datetime`             datetime DEFAULT NULL,
  `rejected_reason`               varchar(500) DEFAULT NULL,
  `settled_datetime`              datetime DEFAULT NULL,
  `reversed_by_userid`            int(11) DEFAULT NULL,
  `reversed_by_username`          varchar(200) DEFAULT NULL,
  `reversed_reason`               varchar(500) DEFAULT NULL,
  `reversed_datetime`             datetime DEFAULT NULL,

  -- Record audit
  `booking_cancellation_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `booking_cancellation_updated_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `booking_cancellation_status`   int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',

  PRIMARY KEY (`booking_cancellation_id`),
  UNIQUE KEY `uq_cancellation_number` (`cancellation_number`),
  KEY `idx_quotation_id` (`quotation_id_fk`),
  KEY `idx_leads_id` (`leads_id_fk`),
  KEY `idx_reason` (`cancellation_reason_id_fk`),
  KEY `idx_cancellation_status` (`cancellation_status`),
  KEY `idx_effective_date` (`cancellation_effective_date`),
  KEY `idx_cust_settlement` (`customer_settlement_status`),
  KEY `idx_supp_settlement` (`supplier_settlement_status`),
  KEY `idx_requested_by` (`requested_by_userid`),
  KEY `idx_status` (`booking_cancellation_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Table: booking_cancellation_customer_refund
-- Append-only. Multiple refund transactions per cancellation.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `booking_cancellation_customer_refund` (
  `customer_refund_id`            int(11) NOT NULL AUTO_INCREMENT,
  `booking_cancellation_id_fk`    int(11) NOT NULL,
  `quotation_id_fk`               int(11) NOT NULL COMMENT 'denormalised for report joins',

  `refund_amount`                 decimal(14,2) NOT NULL,
  `refund_date`                   date NOT NULL,
  `refund_mode`                   varchar(100) NOT NULL
                                  COMMENT 'CASH/UPI/NEFT/CARD_REVERSAL/CHEQUE/CREDIT_NOTE',
  `refund_reference`              varchar(255) DEFAULT NULL COMMENT 'UTR / txn id / cheque no',
  `refund_bank_account`           varchar(255) DEFAULT NULL,
  `refund_remarks`                text DEFAULT NULL,
  `refund_proof_file`             varchar(255) DEFAULT NULL
                                  COMMENT 'uploads/cancellation_proofs/',

  -- reversal instead of edit/delete
  `refund_entry_type`             enum('REFUND','REVERSAL') NOT NULL DEFAULT 'REFUND',
  `reverses_refund_id_fk`         int(11) DEFAULT NULL,

  -- optional accountant approval, mirrors receipt_scheduler_payments
  `accountant_approval_status`    enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `accountant_approved_by_userid` int(11) DEFAULT NULL,
  `accountant_approved_by_username` varchar(255) DEFAULT NULL,
  `accountant_approved_at`        datetime DEFAULT NULL,

  `refund_paid_by_userid`         int(11) NOT NULL,
  `refund_paid_by_username`       varchar(200) NOT NULL,
  `customer_refund_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `customer_refund_status`        int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=voided',

  PRIMARY KEY (`customer_refund_id`),
  KEY `idx_cancellation_id` (`booking_cancellation_id_fk`),
  KEY `idx_quotation_id` (`quotation_id_fk`),
  KEY `idx_refund_date` (`refund_date`),
  KEY `idx_approval` (`accountant_approval_status`),
  KEY `idx_reverses` (`reverses_refund_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Table: booking_cancellation_property
-- One line per property_reservation in scope, with a frozen snapshot.
-- still_payable_to_property covers the case where the hotel's charge
-- exceeds what we had already paid -- that is a liability, not a refund.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `booking_cancellation_property` (
  `cancellation_property_id`      int(11) NOT NULL AUTO_INCREMENT,
  `booking_cancellation_id_fk`    int(11) NOT NULL,
  `property_reservation_id_fk`    int(11) NOT NULL,
  `properties_id_fk`              int(11) NOT NULL,
  `property_payment_scheduler_id_fk` int(11) DEFAULT NULL,

  -- Snapshot (never recomputed once APPROVED)
  `snap_property_name`            varchar(255) NOT NULL,
  `snap_check_in_date`            date DEFAULT NULL,
  `snap_check_out_date`           date DEFAULT NULL,
  `snap_duration_nights`          int(11) NOT NULL DEFAULT 1,
  `snap_confirmation_number`      varchar(255) DEFAULT NULL,
  `snap_cutoff_date`              date DEFAULT NULL COMMENT 'blocking_cutoff_date at cancellation time',
  `snap_reservation_amount`       decimal(14,2) NOT NULL DEFAULT 0.00,
  `snap_amount_paid`              decimal(14,2) NOT NULL DEFAULT 0.00,
  `snap_outstanding_payable`      decimal(14,2) NOT NULL DEFAULT 0.00,

  -- Cancellation assessment
  `cancellation_charge`           decimal(14,2) NOT NULL DEFAULT 0.00,
  `charge_basis`                  enum('POLICY_SLAB','NEGOTIATED','FULL_RETENTION','NO_CHARGE','NO_SHOW')
                                  NOT NULL DEFAULT 'NEGOTIATED',
  `charge_percentage`             decimal(6,2) DEFAULT NULL,
  `charge_proof_file`             varchar(255) DEFAULT NULL,
  `charge_confirmed_by`           varchar(255) DEFAULT NULL COMMENT 'hotel contact person',
  `charge_confirmed_date`         date DEFAULT NULL,

  -- Derived (maintained by the model, never trusted from the client)
  `refund_expected`               decimal(14,2) NOT NULL DEFAULT 0.00
                                  COMMENT 'max(0, snap_amount_paid - cancellation_charge)',
  `refund_received`               decimal(14,2) NOT NULL DEFAULT 0.00,
  `refund_pending`                decimal(14,2) NOT NULL DEFAULT 0.00,
  `still_payable_to_property`     decimal(14,2) NOT NULL DEFAULT 0.00
                                  COMMENT 'max(0, cancellation_charge - snap_amount_paid)',
  `amount_written_off`            decimal(14,2) NOT NULL DEFAULT 0.00,

  `line_status`                   enum('PENDING_INTIMATION','INTIMATED','CHARGE_CONFIRMED',
                                       'REFUND_PENDING','PARTIALLY_REFUNDED','FULLY_REFUNDED',
                                       'REFUSED','WRITTEN_OFF','NO_REFUND_DUE','PAYABLE_PENDING')
                                  NOT NULL DEFAULT 'PENDING_INTIMATION',
  `refusal_reason`                varchar(500) DEFAULT NULL,
  `expected_refund_by_date`       date DEFAULT NULL COMMENT 'drives the ageing / follow-up worklist',
  `last_followup_date`            date DEFAULT NULL,
  `followup_count`                int(11) NOT NULL DEFAULT 0,
  `line_remarks`                  text DEFAULT NULL,

  `cancellation_property_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancellation_property_updated_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `cancellation_property_status`  int(11) NOT NULL DEFAULT 1,

  PRIMARY KEY (`cancellation_property_id`),
  UNIQUE KEY `uq_cancellation_reservation` (`booking_cancellation_id_fk`,`property_reservation_id_fk`),
  KEY `idx_properties_id` (`properties_id_fk`),
  KEY `idx_reservation_id` (`property_reservation_id_fk`),
  KEY `idx_line_status` (`line_status`),
  KEY `idx_expected_by` (`expected_refund_by_date`),
  KEY `idx_status` (`cancellation_property_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Table: booking_cancellation_property_refund
-- N refund receipts per property line -- refunds trickle in over weeks.
-- adjusted_against_quotation_id covers the very common case where the
-- hotel adjusts the credit into a future booking instead of paying back.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `booking_cancellation_property_refund` (
  `property_refund_id`            int(11) NOT NULL AUTO_INCREMENT,
  `cancellation_property_id_fk`   int(11) NOT NULL,
  `booking_cancellation_id_fk`    int(11) NOT NULL COMMENT 'denormalised for header rollups',
  `properties_id_fk`              int(11) NOT NULL COMMENT 'denormalised for property-wise reports',

  `refund_amount`                 decimal(14,2) NOT NULL,
  `refund_date`                   date NOT NULL,
  `refund_mode`                   varchar(100) NOT NULL
                                  COMMENT 'NEFT/UPI/CHEQUE/CASH/CREDIT_NOTE/ADJUSTED',
  `refund_reference`              varchar(255) DEFAULT NULL,
  `refund_remarks`                text DEFAULT NULL,
  `refund_proof_file`             varchar(255) DEFAULT NULL,

  `refund_entry_type`             enum('REFUND','REVERSAL') NOT NULL DEFAULT 'REFUND',
  `reverses_refund_id_fk`         int(11) DEFAULT NULL,
  `adjusted_against_quotation_id` int(11) DEFAULT NULL
                                  COMMENT 'set when the hotel adjusts credit into another booking',

  `refund_received_by_userid`     int(11) NOT NULL,
  `refund_received_by_username`   varchar(200) NOT NULL,
  `property_refund_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `property_refund_status`        int(11) NOT NULL DEFAULT 1,

  PRIMARY KEY (`property_refund_id`),
  KEY `idx_cancellation_property` (`cancellation_property_id_fk`),
  KEY `idx_cancellation_id` (`booking_cancellation_id_fk`),
  KEY `idx_properties_id` (`properties_id_fk`),
  KEY `idx_refund_date` (`refund_date`),
  KEY `idx_reverses` (`reverses_refund_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Table: booking_cancellation_service
-- Non-property suppliers (transport, inclusions, special requirements,
-- visa, guide). Without these the cancellation P&L is understated.
-- Polymorphic source_table + source_row_id points back at the origin row.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `booking_cancellation_service` (
  `cancellation_service_id`       int(11) NOT NULL AUTO_INCREMENT,
  `booking_cancellation_id_fk`    int(11) NOT NULL,
  `service_type`                  enum('TRANSPORT','INCLUSION','SPECIAL_REQUIREMENT','FLIGHT',
                                       'VISA','GUIDE','OTHER') NOT NULL DEFAULT 'OTHER',
  `source_table`                  varchar(100) DEFAULT NULL COMMENT 'origin table name',
  `source_row_id`                 int(11) DEFAULT NULL      COMMENT 'origin PK, polymorphic',
  `vendor_name`                   varchar(255) DEFAULT NULL,
  `service_description`           varchar(500) DEFAULT NULL,
  `snap_service_amount`           decimal(14,2) NOT NULL DEFAULT 0.00,
  `snap_amount_paid`              decimal(14,2) NOT NULL DEFAULT 0.00,
  `cancellation_charge`           decimal(14,2) NOT NULL DEFAULT 0.00,
  `refund_expected`               decimal(14,2) NOT NULL DEFAULT 0.00,
  `refund_received`               decimal(14,2) NOT NULL DEFAULT 0.00,
  `is_recoverable`                tinyint(1) NOT NULL DEFAULT 1,
  `line_status`                   enum('PENDING','PARTIALLY_REFUNDED','FULLY_REFUNDED',
                                       'REFUSED','NON_RECOVERABLE','WRITTEN_OFF')
                                  NOT NULL DEFAULT 'PENDING',
  `service_remarks`               text DEFAULT NULL,
  `cancellation_service_created_datetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancellation_service_updated_datetime` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `cancellation_service_status`   int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cancellation_service_id`),
  KEY `idx_cancellation_id` (`booking_cancellation_id_fk`),
  KEY `idx_service_type` (`service_type`),
  KEY `idx_status` (`cancellation_service_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Table: booking_cancellation_adjustment
-- Write-offs, goodwill, gateway fees, tax adjustments, incentive clawback.
-- adjustment_direction: CREDIT increases company income,
--                       DEBIT increases company cost.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `booking_cancellation_adjustment` (
  `cancellation_adjustment_id`    int(11) NOT NULL AUTO_INCREMENT,
  `booking_cancellation_id_fk`    int(11) NOT NULL,
  `adjustment_type`               enum('WRITE_OFF','GOODWILL_DISCOUNT','ADDITIONAL_CHARGE',
                                       'BANK_CHARGE','GATEWAY_FEE','TAX_ADJUSTMENT',
                                       'CREDIT_NOTE_ISSUED','INCENTIVE_CLAWBACK','ROUNDING','OTHER')
                                  NOT NULL DEFAULT 'OTHER',
  `adjustment_side`               enum('CUSTOMER','SUPPLIER','COMPANY') NOT NULL DEFAULT 'COMPANY',
  `adjustment_direction`          enum('DEBIT','CREDIT') NOT NULL DEFAULT 'DEBIT',
  `adjustment_amount`             decimal(14,2) NOT NULL DEFAULT 0.00,
  `adjustment_reason`             varchar(500) NOT NULL,
  `related_property_id_fk`        int(11) DEFAULT NULL
                                  COMMENT 'FK to booking_cancellation_property when scoped to one line',
  `approved_by_userid`            int(11) DEFAULT NULL,
  `approved_datetime`             datetime DEFAULT NULL,
  `adjustment_created_by_userid`  int(11) NOT NULL,
  `adjustment_created_by_username` varchar(200) NOT NULL,
  `adjustment_created_datetime`   datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cancellation_adjustment_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`cancellation_adjustment_id`),
  KEY `idx_cancellation_id` (`booking_cancellation_id_fk`),
  KEY `idx_type` (`adjustment_type`),
  KEY `idx_related_property` (`related_property_id_fk`),
  KEY `idx_status` (`cancellation_adjustment_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Foreign Key Constraints
-- RESTRICT on property_reservation guarantees at DB level that a
-- reservation carrying cancellation history can never be deleted.
-- --------------------------------------------------------

ALTER TABLE `booking_cancellation`
  ADD CONSTRAINT `fk_bc_quotation`
  FOREIGN KEY (`quotation_id_fk`) REFERENCES `quotation` (`quotation_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation`
  ADD CONSTRAINT `fk_bc_leads`
  FOREIGN KEY (`leads_id_fk`) REFERENCES `leads` (`leads_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation`
  ADD CONSTRAINT `fk_bc_reason`
  FOREIGN KEY (`cancellation_reason_id_fk`) REFERENCES `booking_cancellation_reason` (`cancellation_reason_id`)
  ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_customer_refund`
  ADD CONSTRAINT `fk_bccr_cancellation`
  FOREIGN KEY (`booking_cancellation_id_fk`) REFERENCES `booking_cancellation` (`booking_cancellation_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_customer_refund`
  ADD CONSTRAINT `fk_bccr_reversal`
  FOREIGN KEY (`reverses_refund_id_fk`) REFERENCES `booking_cancellation_customer_refund` (`customer_refund_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_property`
  ADD CONSTRAINT `fk_bcp_cancellation`
  FOREIGN KEY (`booking_cancellation_id_fk`) REFERENCES `booking_cancellation` (`booking_cancellation_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_property`
  ADD CONSTRAINT `fk_bcp_reservation`
  FOREIGN KEY (`property_reservation_id_fk`) REFERENCES `property_reservation` (`property_reservation_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_property`
  ADD CONSTRAINT `fk_bcp_property`
  FOREIGN KEY (`properties_id_fk`) REFERENCES `properties` (`properties_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_property_refund`
  ADD CONSTRAINT `fk_bcpr_line`
  FOREIGN KEY (`cancellation_property_id_fk`) REFERENCES `booking_cancellation_property` (`cancellation_property_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_property_refund`
  ADD CONSTRAINT `fk_bcpr_cancellation`
  FOREIGN KEY (`booking_cancellation_id_fk`) REFERENCES `booking_cancellation` (`booking_cancellation_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_service`
  ADD CONSTRAINT `fk_bcs_cancellation`
  FOREIGN KEY (`booking_cancellation_id_fk`) REFERENCES `booking_cancellation` (`booking_cancellation_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `booking_cancellation_adjustment`
  ADD CONSTRAINT `fk_bca_cancellation`
  FOREIGN KEY (`booking_cancellation_id_fk`) REFERENCES `booking_cancellation` (`booking_cancellation_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;


-- --------------------------------------------------------
-- Optional supporting indexes on existing tables (non-breaking).
-- Safe to skip if the index already exists.
-- --------------------------------------------------------

ALTER TABLE `quotation` ADD KEY `idx_current_status` (`quotation_current_status`);
ALTER TABLE `property_payment_scheduler_payments` ADD KEY `idx_payment_status` (`payment_status`);


-- --------------------------------------------------------
-- Seed: cancellation reasons
-- --------------------------------------------------------

INSERT INTO `booking_cancellation_reason`
  (`reason_code`, `reason_name`, `reason_category`, `is_charge_waivable`, `reason_sort_order`, `reason_created_by_userid`)
VALUES
  ('GUEST_PERSONAL',    'Guest personal reason',              'GUEST',         0,  1, 1),
  ('GUEST_MEDICAL',     'Medical emergency',                  'GUEST',         1,  2, 1),
  ('GUEST_PRICE',       'Price too high / found cheaper',     'GUEST',         0,  3, 1),
  ('GUEST_DATE_CHANGE', 'Date change not possible',           'GUEST',         0,  4, 1),
  ('GUEST_VISA',        'Visa rejected',                      'GUEST',         1,  5, 1),
  ('NO_SHOW',           'Guest no-show',                      'NO_SHOW',       0,  6, 1),
  ('COMPANY_ERROR',     'Company booking error',              'COMPANY',       1,  7, 1),
  ('COMPANY_SERVICE',   'Service could not be arranged',      'COMPANY',       1,  8, 1),
  ('SUPPLIER_UNAVAIL',  'Property / supplier unavailable',    'SUPPLIER',      1,  9, 1),
  ('FORCE_MAJEURE',     'Natural calamity / force majeure',   'FORCE_MAJEURE', 1, 10, 1),
  ('OTHER',             'Other',                              'OTHER',         0, 99, 1)
ON DUPLICATE KEY UPDATE `reason_name` = VALUES(`reason_name`);
