-- Migration: Add quotation_options_last_day_details column to quotation_options table
ALTER TABLE `quotation_options` ADD COLUMN `quotation_options_last_day_details` VARCHAR(255) NULL DEFAULT NULL AFTER `quotation_options_complimentary_inclusion`;
