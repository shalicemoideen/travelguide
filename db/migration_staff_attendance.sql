-- Staff Attendance System Database Migration
-- Created for biometric device API integration

-- Table: attendance_api_config
-- Stores configuration for biometric device API connection
CREATE TABLE IF NOT EXISTS `attendance_api_config` (
    `config_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `api_name` VARCHAR(100) NOT NULL DEFAULT 'Biometric Device API',
    `api_endpoint` VARCHAR(255) NOT NULL,
    `api_key` VARCHAR(255) DEFAULT NULL,
    `api_secret` VARCHAR(255) DEFAULT NULL,
    `device_id` VARCHAR(100) DEFAULT NULL,
    `sync_interval_minutes` INT(11) DEFAULT 60,
    `last_sync_datetime` DATETIME DEFAULT NULL,
    `last_sync_status` ENUM('success', 'failed', 'pending') DEFAULT 'pending',
    `last_sync_message` TEXT DEFAULT NULL,
    `is_active` TINYINT(1) DEFAULT 1,
    `created_date` DATE DEFAULT NULL,
    `created_time` VARCHAR(20) DEFAULT NULL,
    `updated_date` DATE DEFAULT NULL,
    `updated_time` VARCHAR(20) DEFAULT NULL,
    `created_by_user_id` INT(11) DEFAULT NULL COMMENT 'FK to user_details - who created config',
    PRIMARY KEY (`config_id`),
    CONSTRAINT `fk_api_config_created_by` FOREIGN KEY (`created_by_user_id`) REFERENCES `user_details`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: attendance_records
-- Stores staff attendance records from biometric device
-- Note: Audit fields (created_by_*, updated_by_*) track who made manual entries
CREATE TABLE IF NOT EXISTS `attendance_records` (
    `attendance_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id_fk` INT(11) NOT NULL COMMENT 'FK to user_details table',
    `device_user_id` VARCHAR(50) DEFAULT NULL COMMENT 'User ID from biometric device',
    `punch_date` DATE NOT NULL,
    `first_punch_in` TIME DEFAULT NULL,
    `last_punch_out` TIME DEFAULT NULL,
    `total_working_hours` DECIMAL(5,2) DEFAULT 0.00,
    `break_hours` DECIMAL(4,2) DEFAULT 0.00,
    `net_working_hours` DECIMAL(5,2) DEFAULT 0.00,
    `status` ENUM('present', 'absent', 'half_day', 'late', 'on_leave', 'holiday', 'weekend') DEFAULT 'present',
    `shift_id_fk` INT(11) DEFAULT NULL,
    `is_manual_entry` TINYINT(1) DEFAULT 0 COMMENT '1=manual entry by user, 0=device API',
    `manual_entry_reason` TEXT DEFAULT NULL COMMENT 'Reason for manual entry (audit trail)',
    `device_punch_count` INT(11) DEFAULT 0,
    `raw_punch_data` TEXT DEFAULT NULL COMMENT 'JSON data from API',
    `created_date` DATE DEFAULT NULL,
    `created_time` VARCHAR(20) DEFAULT NULL,
    `updated_date` DATE DEFAULT NULL,
    `updated_time` VARCHAR(20) DEFAULT NULL,
    -- Audit trail: FK to user_details to track who created/updated (JOIN to get username)
    `created_by_user_id` INT(11) DEFAULT NULL COMMENT 'FK to user_details - who created record',
    `updated_by_user_id` INT(11) DEFAULT NULL COMMENT 'FK to user_details - who last updated',
    PRIMARY KEY (`attendance_id`),
    UNIQUE KEY `unique_user_date` (`user_id_fk`, `punch_date`),
    KEY `idx_punch_date` (`punch_date`),
    KEY `idx_user_id` (`user_id_fk`),
    KEY `idx_status` (`status`),
    -- Foreign keys ensure referential integrity
    CONSTRAINT `fk_attendance_user` FOREIGN KEY (`user_id_fk`) REFERENCES `user_details`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_attendance_created_by` FOREIGN KEY (`created_by_user_id`) REFERENCES `user_details`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE,
    CONSTRAINT `fk_attendance_updated_by` FOREIGN KEY (`updated_by_user_id`) REFERENCES `user_details`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: attendance_raw_logs
-- Raw punch logs from biometric device before processing
CREATE TABLE IF NOT EXISTS `attendance_raw_logs` (
    `log_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `device_user_id` VARCHAR(50) NOT NULL,
    `user_id_fk` INT(11) DEFAULT NULL COMMENT 'FK to user_details table',
    `punch_datetime` DATETIME NOT NULL,
    `punch_type` ENUM('in', 'out', 'break_out', 'break_in', 'other') DEFAULT 'in',
    `device_id` VARCHAR(50) DEFAULT NULL,
    `verification_mode` VARCHAR(20) DEFAULT NULL COMMENT 'fingerprint, face, card',
    `is_processed` TINYINT(1) DEFAULT 0,
    `processed_date` DATETIME DEFAULT NULL,
    `raw_data` TEXT DEFAULT NULL,
    PRIMARY KEY (`log_id`),
    KEY `idx_device_user` (`device_user_id`),
    KEY `idx_punch_datetime` (`punch_datetime`),
    KEY `idx_is_processed` (`is_processed`),
    CONSTRAINT `fk_raw_logs_user` FOREIGN KEY (`user_id_fk`) REFERENCES `user_details`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Table: attendance_leave_requests
-- Manual leave requests by staff
CREATE TABLE IF NOT EXISTS `attendance_leave_requests` (
    `leave_id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
    `user_id_fk` INT(11) NOT NULL COMMENT 'FK to user_details - staff requesting leave',
    `leave_type` ENUM('sick', 'casual', 'paid', 'unpaid', 'half_day', 'other') NOT NULL,
    `leave_start_date` DATE NOT NULL,
    `leave_end_date` DATE NOT NULL,
    `total_days` DECIMAL(4,1) DEFAULT 1.0,
    `reason` TEXT NOT NULL,
    `status` ENUM('pending', 'approved', 'rejected') DEFAULT 'pending',
    `approved_by_user_id` INT(11) DEFAULT NULL COMMENT 'FK to user_details - who approved/rejected',
    `approved_date` DATE DEFAULT NULL,
    `rejection_reason` TEXT DEFAULT NULL,
    `created_date` DATE DEFAULT NULL,
    `created_time` VARCHAR(20) DEFAULT NULL,
    `updated_date` DATE DEFAULT NULL,
    `updated_time` VARCHAR(20) DEFAULT NULL,
    PRIMARY KEY (`leave_id`),
    KEY `idx_user_id` (`user_id_fk`),
    KEY `idx_status` (`status`),
    CONSTRAINT `fk_leave_user` FOREIGN KEY (`user_id_fk`) REFERENCES `user_details`(`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
    CONSTRAINT `fk_leave_approved_by` FOREIGN KEY (`approved_by_user_id`) REFERENCES `user_details`(`user_id`) ON DELETE SET NULL ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Add device_user_id column to user_details for mapping staff to biometric device
-- Note: Run this only once. If column already exists, this will throw an error (safe to ignore)
SET @dbname = DATABASE();
SET @tablename = 'user_details';
SET @columnname = 'device_user_id';
SET @preparedStatement = (SELECT IF(
    (SELECT COUNT(*) FROM INFORMATION_SCHEMA.COLUMNS 
     WHERE TABLE_SCHEMA = @dbname AND TABLE_NAME = @tablename AND COLUMN_NAME = @columnname) > 0,
    'SELECT 1',
    CONCAT('ALTER TABLE `', @tablename, '` ADD COLUMN `', @columnname, '` VARCHAR(50) DEFAULT NULL COMMENT \'Employee Code from biometric device (eSSL)\' AFTER `user_id`')
));
PREPARE alterIfNotExists FROM @preparedStatement;
EXECUTE alterIfNotExists;
DEALLOCATE PREPARE alterIfNotExists;

-- Create index for faster lookups (ignore error if already exists)
CREATE INDEX `idx_device_user_id` ON `user_details`(`device_user_id`);

-- Insert default API config (inactive by default)
INSERT INTO `attendance_api_config` (`api_name`, `api_endpoint`, `is_active`) 
VALUES ('eSSL Biometric Device', 'http://192.168.1.140/iclock/WebAPIService.asmx', 0)
ON DUPLICATE KEY UPDATE `api_endpoint` = `api_endpoint`;
