-- =========================================================
-- Template Master Schema
-- Master tables for template category name, design type,
-- destination, properties, and rooms (no day count / no template_id FK)
-- =========================================================

-- Drop tables if they already exist (safe for fresh setup / re-run)
DROP TABLE IF EXISTS `template_master_destination_property_room`;
DROP TABLE IF EXISTS `template_master_destination_property`;
DROP TABLE IF EXISTS `template_master_destination`;
DROP TABLE IF EXISTS `template_master`;

-- =========================================================
-- 1. Template Master
-- Stores category name and design type as a standalone master
-- =========================================================
CREATE TABLE IF NOT EXISTS `template_master` (
  `template_master_id` INT(11) NOT NULL AUTO_INCREMENT,
  `template_master_category_name` VARCHAR(255) NOT NULL COMMENT 'e.g. Luxury Option, Standard Option',
  `template_master_design_type` VARCHAR(255) NOT NULL COMMENT 'e.g. Premium, Budget',
  `template_master_status` INT(11) NOT NULL DEFAULT 1 COMMENT '1 = active, 0 = inactive',
  `template_master_created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  `template_master_updated_date` DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`template_master_id`),
  KEY `idx_template_master_category_name` (`template_master_category_name`),
  KEY `idx_template_master_design_type` (`template_master_design_type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- =========================================================
-- 2. Template Master Destinations
-- Links a template master to one or more destinations (district master)
-- No day count / no day limit
-- =========================================================
CREATE TABLE IF NOT EXISTS `template_master_destination` (
  `template_master_destination_id` INT(11) NOT NULL AUTO_INCREMENT,
  `template_master_id_fk` INT(11) NOT NULL,
  `district_id_fk` INT(11) NOT NULL COMMENT 'FK to district master',
  `template_master_destination_status` INT(11) NOT NULL DEFAULT 1,
  `template_master_destination_created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`template_master_destination_id`),
  KEY `idx_tmd_template_master_id` (`template_master_id_fk`),
  KEY `idx_tmd_district_id` (`district_id_fk`),
  CONSTRAINT `fk_tmd_template_master` FOREIGN KEY (`template_master_id_fk`) REFERENCES `template_master` (`template_master_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tmd_district` FOREIGN KEY (`district_id_fk`) REFERENCES `district` (`district_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- =========================================================
-- 3. Template Master Destination Properties
-- Properties linked to each destination of a template master
-- =========================================================
CREATE TABLE IF NOT EXISTS `template_master_destination_property` (
  `template_master_destination_property_id` INT(11) NOT NULL AUTO_INCREMENT,
  `template_master_destination_id_fk` INT(11) NOT NULL,
  `properties_id_fk` INT(11) NOT NULL COMMENT 'FK to properties master',
  `template_master_destination_property_status` INT(11) NOT NULL DEFAULT 1,
  `template_master_destination_property_created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`template_master_destination_property_id`),
  KEY `idx_tmdp_destination_id` (`template_master_destination_id_fk`),
  KEY `idx_tmdp_property_id` (`properties_id_fk`),
  CONSTRAINT `fk_tmdp_destination` FOREIGN KEY (`template_master_destination_id_fk`) REFERENCES `template_master_destination` (`template_master_destination_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tmdp_property` FOREIGN KEY (`properties_id_fk`) REFERENCES `properties` (`properties_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- =========================================================
-- 4. Template Master Destination Property Rooms
-- Room categories linked to each property of a template master destination
-- =========================================================
CREATE TABLE IF NOT EXISTS `template_master_destination_property_room` (
  `template_master_destination_property_room_id` INT(11) NOT NULL AUTO_INCREMENT,
  `template_master_destination_property_id_fk` INT(11) NOT NULL,
  `properties_room_category_id_fk` INT(11) NOT NULL COMMENT 'FK to properties_room_category master',
  `template_master_destination_property_room_status` INT(11) NOT NULL DEFAULT 1,
  `template_master_destination_property_room_created_date` DATETIME DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`template_master_destination_property_room_id`),
  KEY `idx_tmdpr_dest_property_id` (`template_master_destination_property_id_fk`),
  KEY `idx_tmdpr_room_category_id` (`properties_room_category_id_fk`),
  CONSTRAINT `fk_tmdpr_dest_property` FOREIGN KEY (`template_master_destination_property_id_fk`) REFERENCES `template_master_destination_property` (`template_master_destination_property_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `fk_tmdpr_room_category` FOREIGN KEY (`properties_room_category_id_fk`) REFERENCES `properties_room_category` (`properties_room_category_id`) ON DELETE RESTRICT ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;
