-- Migration script for financial_posting tables
-- Stores driver allowance, hotel day costs, other expenses, and computed totals per lead

CREATE TABLE IF NOT EXISTS `financial_posting` (
  `fp_id`            INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fp_leads_id_fk`   INT           NOT NULL,
  `fp_driver_quoted` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `fp_driver_actual` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `fp_driver_desc`   VARCHAR(255)  DEFAULT NULL,
  `fp_actual_cost`   DECIMAL(10,2) NOT NULL DEFAULT 0,
  `fp_cost_after`    DECIMAL(10,2) NOT NULL DEFAULT 0,
  `fp_margin`        DECIMAL(10,2) NOT NULL DEFAULT 0,
  `fp_notes`         TEXT          DEFAULT NULL,
  `fp_created_at`    DATETIME      DEFAULT CURRENT_TIMESTAMP,
  `fp_updated_at`    DATETIME      DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  CONSTRAINT `fk_fp_leads` FOREIGN KEY (`fp_leads_id_fk`)
    REFERENCES `leads` (`leads_id`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Stores per-day hotel costs linked to a financial_posting record
CREATE TABLE IF NOT EXISTS `financial_posting_hotel_days` (
  `fphd_id`            INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fphd_fp_id_fk`      INT           NOT NULL,
  `fphd_day_label`     VARCHAR(100)  NOT NULL DEFAULT '',
  `fphd_quoted_amount` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `fphd_actual_amount` DECIMAL(10,2) NOT NULL DEFAULT 0,
  `fphd_description`   VARCHAR(255)  DEFAULT NULL,
  `fphd_sort_order`    INT           NOT NULL DEFAULT 0,
  CONSTRAINT `fk_fphd_fp` FOREIGN KEY (`fphd_fp_id_fk`)
    REFERENCES `financial_posting` (`fp_id`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Stores miscellaneous other expenses linked to a financial_posting record
CREATE TABLE IF NOT EXISTS `financial_posting_expenses` (
  `fpe_id`          INT           NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `fpe_fp_id_fk`    INT           NOT NULL,
  `fpe_label`       VARCHAR(255)  DEFAULT NULL,
  `fpe_amount`      DECIMAL(10,2) NOT NULL DEFAULT 0,
  `fpe_description` VARCHAR(255)  DEFAULT NULL,
  CONSTRAINT `fk_fpe_fp` FOREIGN KEY (`fpe_fp_id_fk`)
    REFERENCES `financial_posting` (`fp_id`)
    ON UPDATE CASCADE ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Per-day inclusions for financial posting
CREATE TABLE IF NOT EXISTS `financial_posting_inclusions` (
  `fpi_id` INT(11) NOT NULL AUTO_INCREMENT,
  `fpi_fp_id_fk` INT(11) NOT NULL,
  `fpi_day_label` VARCHAR(100) NOT NULL,
  `fpi_quoted_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `fpi_actual_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `fpi_description` VARCHAR(500) NULL,
  `fpi_sort_order` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fpi_id`),
  KEY `fk_fpi_fp` (`fpi_fp_id_fk`),
  CONSTRAINT `fk_fpi_fp` FOREIGN KEY (`fpi_fp_id_fk`) REFERENCES `financial_posting` (`fp_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Per-day special requirements for financial posting
CREATE TABLE IF NOT EXISTS `financial_posting_special` (
  `fps_id` INT(11) NOT NULL AUTO_INCREMENT,
  `fps_fp_id_fk` INT(11) NOT NULL,
  `fps_day_label` VARCHAR(100) NOT NULL,
  `fps_quoted_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `fps_actual_amount` DECIMAL(12,2) NOT NULL DEFAULT 0.00,
  `fps_description` VARCHAR(500) NULL,
  `fps_sort_order` INT(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`fps_id`),
  KEY `fk_fps_fp` (`fps_fp_id_fk`),
  CONSTRAINT `fk_fps_fp` FOREIGN KEY (`fps_fp_id_fk`) REFERENCES `financial_posting` (`fp_id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
