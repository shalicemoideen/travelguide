-- Migration: Move transporter/driver allocation fields from quotation into a separate table

CREATE TABLE IF NOT EXISTS `quotation_transport_allocation` (
    `id` INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    `quotation_id_fk` INT(11) NOT NULL,
    `transporter_id_fk` INT(11) NULL DEFAULT NULL,
    `driver_name` VARCHAR(255) NULL DEFAULT NULL,
    `driver_mobile` VARCHAR(50) NULL DEFAULT NULL,
    `cab_number` VARCHAR(100) NULL DEFAULT NULL,
    `status` TINYINT(1) NOT NULL DEFAULT 1,
    `created_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP,
    `updated_at` DATETIME NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
    INDEX `idx_quotation_id_fk` (`quotation_id_fk`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

DELIMITER $$

DROP PROCEDURE IF EXISTS migrate_quotation_transport_allocation$$

CREATE PROCEDURE migrate_quotation_transport_allocation()
BEGIN
    IF EXISTS (
        SELECT 1
        FROM information_schema.COLUMNS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = 'quotation'
          AND COLUMN_NAME = 'quotation_transporter_id_fk'
    ) THEN
        INSERT INTO `quotation_transport_allocation`
            (`quotation_id_fk`, `transporter_id_fk`, `driver_name`, `driver_mobile`, `cab_number`, `status`, `created_at`, `updated_at`)
        SELECT
            `quotation_id`,
            `quotation_transporter_id_fk`,
            `quotation_driver_name`,
            `quotation_driver_mobile`,
            `quotation_cab_number`,
            1,
            NOW(),
            NOW()
        FROM `quotation`
        WHERE `quotation_transporter_id_fk` IS NOT NULL
           OR `quotation_driver_name` IS NOT NULL
           OR `quotation_driver_mobile` IS NOT NULL
           OR `quotation_cab_number` IS NOT NULL;

        ALTER TABLE `quotation`
            DROP COLUMN `quotation_transporter_id_fk`,
            DROP COLUMN `quotation_driver_name`,
            DROP COLUMN `quotation_driver_mobile`,
            DROP COLUMN `quotation_cab_number`;
    END IF;
END$$

DELIMITER ;

CALL migrate_quotation_transport_allocation();

DROP PROCEDURE IF EXISTS migrate_quotation_transport_allocation;

-- Link transporter_id_fk to the transporter login user (transporter.user_id_fk)

DELIMITER $$

DROP PROCEDURE IF EXISTS add_qta_transporter_user_fk$$

CREATE PROCEDURE add_qta_transporter_user_fk()
BEGIN
    IF NOT EXISTS (
        SELECT 1 FROM information_schema.STATISTICS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = 'transporter'
          AND INDEX_NAME = 'uk_transporter_user_id_fk'
    ) THEN
        ALTER TABLE `transporter` ADD UNIQUE INDEX `uk_transporter_user_id_fk` (`user_id_fk`);
    END IF;

    UPDATE `quotation_transport_allocation` qta
    JOIN `transporter` t ON t.transporter_id = qta.transporter_id_fk
    SET qta.transporter_id_fk = t.user_id_fk
    WHERE t.user_id_fk IS NOT NULL;

    UPDATE `quotation_transport_allocation` qta
    LEFT JOIN `transporter` t ON t.user_id_fk = qta.transporter_id_fk
    SET qta.transporter_id_fk = NULL
    WHERE qta.transporter_id_fk IS NOT NULL
      AND t.transporter_id IS NULL;

    IF NOT EXISTS (
        SELECT 1 FROM information_schema.TABLE_CONSTRAINTS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = 'quotation_transport_allocation'
          AND CONSTRAINT_NAME = 'fk_qta_transporter_user'
    ) THEN
        ALTER TABLE `quotation_transport_allocation`
            ADD CONSTRAINT `fk_qta_transporter_user`
            FOREIGN KEY (`transporter_id_fk`)
            REFERENCES `transporter` (`user_id_fk`)
            ON DELETE SET NULL
            ON UPDATE CASCADE;
    END IF;
END$$

DELIMITER ;

CALL add_qta_transporter_user_fk();

DROP PROCEDURE IF EXISTS add_qta_transporter_user_fk;
