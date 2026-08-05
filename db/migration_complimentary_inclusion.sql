ALTER TABLE `packages_properties_common`
ADD COLUMN `packages_properties_common_complimentary_inclusion` TEXT NULL
AFTER `packages_properties_common_design_type`;

ALTER TABLE `quotation_options`
ADD COLUMN `quotation_options_complimentary_inclusion` TEXT NULL DEFAULT NULL
AFTER `quotation_options_design_type`;

ALTER TABLE `quotation_options`
ADD COLUMN `quotation_options_cab_amount_not_required` TINYINT(1) NOT NULL DEFAULT 0
AFTER `quotation_options_cab_amount`;
