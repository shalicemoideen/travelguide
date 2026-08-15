-- Migration: Add trip_code column to quotation table
ALTER TABLE `quotation` ADD COLUMN `trip_code` VARCHAR(50) NULL DEFAULT NULL AFTER `quotation_number`;
