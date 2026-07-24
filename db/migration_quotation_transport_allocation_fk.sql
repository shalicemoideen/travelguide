-- Migration: Link quotation_transport_allocation.transporter_id_fk to transporter.user_id_fk

DELIMITER $$

DROP PROCEDURE IF EXISTS add_qta_transporter_user_fk$$

CREATE PROCEDURE add_qta_transporter_user_fk()
BEGIN
    -- Ensure the referenced key is unique
    IF NOT EXISTS (
        SELECT 1 FROM information_schema.STATISTICS
        WHERE TABLE_SCHEMA = DATABASE()
          AND TABLE_NAME = 'transporter'
          AND INDEX_NAME = 'uk_transporter_user_id_fk'
    ) THEN
        ALTER TABLE `transporter` ADD UNIQUE INDEX `uk_transporter_user_id_fk` (`user_id_fk`);
    END IF;

    -- Convert existing transporter_id values to the linked user_id_fk values
    UPDATE `quotation_transport_allocation` qta
    JOIN `transporter` t ON t.transporter_id = qta.transporter_id_fk
    SET qta.transporter_id_fk = t.user_id_fk
    WHERE t.user_id_fk IS NOT NULL;

    -- Clear any allocations whose transporter has no linked user
    UPDATE `quotation_transport_allocation` qta
    LEFT JOIN `transporter` t ON t.user_id_fk = qta.transporter_id_fk
    SET qta.transporter_id_fk = NULL
    WHERE qta.transporter_id_fk IS NOT NULL
      AND t.transporter_id IS NULL;

    -- Add foreign key if not already present
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
