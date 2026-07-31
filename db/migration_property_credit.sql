-- =====================================================
-- Property Credit Ledger Module
-- =====================================================
-- Introduces a supplier credit ledger so that when a property
-- keeps the cancelled booking amount as credit for future
-- bookings, the credit is tracked, applied, and reported.
--
-- Design principles (consistent with booking_cancellation):
--   * New tables — no existing table is altered.
--   * Money columns use DECIMAL(14,2).
--   * Soft deletes via *_status column (1=active, 0=deleted).
--   * Credit applications are reversible (reversed flag, never
--     UPDATE/DELETE the original row).
--   * Ledger amounts (used_amount, remaining_amount) are
--     recomputed from property_credit_application inside the
--     same transaction as the application/reversal.
-- =====================================================


-- --------------------------------------------------------
-- Table: property_credit_ledger  (header / one per credit)
-- Created when a cancellation property refund is recorded
-- with refund_mode = 'PROPERTY_CREDIT'.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `property_credit_ledger` (
  `property_credit_id`            int(11) NOT NULL AUTO_INCREMENT,
  `properties_id_fk`              int(11) NOT NULL,
  `booking_cancellation_id_fk`    int(11) NOT NULL,
  `cancellation_property_id_fk`   int(11) NOT NULL,
  `property_reservation_id_fk`    int(11) DEFAULT NULL
                                  COMMENT 'original reservation that was cancelled (nullable for partial)',
  `quotation_id_fk`               int(11) NOT NULL
                                  COMMENT 'denormalised: the cancelled booking',

  `credit_amount`                 decimal(14,2) NOT NULL,
  `used_amount`                   decimal(14,2) NOT NULL DEFAULT 0.00,
  `remaining_amount`              decimal(14,2) NOT NULL DEFAULT 0.00,
  `credit_status`                 enum('AVAILABLE','PARTIALLY_USED','FULLY_UTILIZED','EXPIRED','CANCELLED')
                                  NOT NULL DEFAULT 'AVAILABLE',

  `expiry_date`                   date DEFAULT NULL COMMENT 'optional; NULL = no expiry',
  `reference_number`              varchar(255) DEFAULT NULL COMMENT 'hotel credit reference',
  `remarks`                       text DEFAULT NULL,

  `created_by_userid`             int(11) NOT NULL,
  `created_by_username`           varchar(200) NOT NULL,
  `created_datetime`              datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `property_credit_status`        int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',

  PRIMARY KEY (`property_credit_id`),
  KEY `idx_properties_id` (`properties_id_fk`),
  KEY `idx_cancellation_id` (`booking_cancellation_id_fk`),
  KEY `idx_cancellation_property` (`cancellation_property_id_fk`),
  KEY `idx_quotation_id` (`quotation_id_fk`),
  KEY `idx_credit_status` (`credit_status`),
  KEY `idx_expiry_date` (`expiry_date`),
  KEY `idx_status` (`property_credit_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Table: property_credit_application
-- One row each time a credit (full or partial) is consumed
-- against a new booking / reservation.
-- Reversals set reversed=1 and restore the ledger amounts —
-- the original application row is never deleted.
-- --------------------------------------------------------

CREATE TABLE IF NOT EXISTS `property_credit_application` (
  `credit_application_id`         int(11) NOT NULL AUTO_INCREMENT,
  `property_credit_id_fk`         int(11) NOT NULL,
  `quotation_id_fk`               int(11) NOT NULL
                                  COMMENT 'new booking consuming the credit',
  `property_reservation_id_fk`    int(11) DEFAULT NULL
                                  COMMENT 'new reservation (nullable until allocated)',
  `properties_id_fk`              int(11) NOT NULL
                                  COMMENT 'denormalised for property-wise reports',

  `applied_amount`                decimal(14,2) NOT NULL,
  `application_type`              enum('FULL','PARTIAL') NOT NULL DEFAULT 'PARTIAL',

  `applied_by_userid`             int(11) NOT NULL,
  `applied_by_username`           varchar(200) NOT NULL,
  `applied_datetime`              datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,

  `reversed`                      tinyint(1) NOT NULL DEFAULT 0,
  `reversed_by_userid`            int(11) DEFAULT NULL,
  `reversed_by_username`          varchar(200) DEFAULT NULL,
  `reversed_datetime`             datetime DEFAULT NULL,
  `reversal_reason`               varchar(500) DEFAULT NULL,

  `credit_application_status`     int(11) NOT NULL DEFAULT 1 COMMENT '1=active, 0=deleted',

  PRIMARY KEY (`credit_application_id`),
  KEY `idx_property_credit_id` (`property_credit_id_fk`),
  KEY `idx_quotation_id` (`quotation_id_fk`),
  KEY `idx_reservation_id` (`property_reservation_id_fk`),
  KEY `idx_properties_id` (`properties_id_fk`),
  KEY `idx_reversed` (`reversed`),
  KEY `idx_status` (`credit_application_status`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;


-- --------------------------------------------------------
-- Foreign Key Constraints
-- --------------------------------------------------------

ALTER TABLE `property_credit_ledger`
  ADD CONSTRAINT `fk_pcl_property`
  FOREIGN KEY (`properties_id_fk`) REFERENCES `properties` (`properties_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `property_credit_ledger`
  ADD CONSTRAINT `fk_pcl_cancellation`
  FOREIGN KEY (`booking_cancellation_id_fk`) REFERENCES `booking_cancellation` (`booking_cancellation_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `property_credit_ledger`
  ADD CONSTRAINT `fk_pcl_cancellation_property`
  FOREIGN KEY (`cancellation_property_id_fk`) REFERENCES `booking_cancellation_property` (`cancellation_property_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `property_credit_ledger`
  ADD CONSTRAINT `fk_pcl_quotation`
  FOREIGN KEY (`quotation_id_fk`) REFERENCES `quotation` (`quotation_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `property_credit_ledger`
  ADD CONSTRAINT `fk_pcl_reservation`
  FOREIGN KEY (`property_reservation_id_fk`) REFERENCES `property_reservation` (`property_reservation_id`)
  ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `property_credit_application`
  ADD CONSTRAINT `fk_pca_credit`
  FOREIGN KEY (`property_credit_id_fk`) REFERENCES `property_credit_ledger` (`property_credit_id`)
  ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `property_credit_application`
  ADD CONSTRAINT `fk_pca_quotation`
  FOREIGN KEY (`quotation_id_fk`) REFERENCES `quotation` (`quotation_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;

ALTER TABLE `property_credit_application`
  ADD CONSTRAINT `fk_pca_reservation`
  FOREIGN KEY (`property_reservation_id_fk`) REFERENCES `property_reservation` (`property_reservation_id`)
  ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `property_credit_application`
  ADD CONSTRAINT `fk_pca_property`
  FOREIGN KEY (`properties_id_fk`) REFERENCES `properties` (`properties_id`)
  ON DELETE RESTRICT ON UPDATE CASCADE;
