-- Quotation Confirmation Table
-- Based on schema from client confirmation requirements

CREATE TABLE IF NOT EXISTS `quotation_confirmation` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id_fk` int(11) NOT NULL,
  `option_id_fk` int(11) NOT NULL,
  `properties_day_id_fk` int(11) NOT NULL,
  `properties_id_fk` int(11) NOT NULL,
  `properties_room_id_fk` int(11) NOT NULL,
  `description` text DEFAULT NULL,
  `property_confirmation_status` int(11) NOT NULL DEFAULT 1,
  `confirmation_token` varchar(255) NOT NULL,
  `confirmation_status` enum('pending','confirmed','rejected') NOT NULL DEFAULT 'pending',
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `quotation_id_fk` (`quotation_id_fk`),
  KEY `option_id_fk` (`option_id_fk`),
  KEY `properties_day_id_fk` (`properties_day_id_fk`),
  KEY `properties_id_fk` (`properties_id_fk`),
  KEY `properties_room_id_fk` (`properties_room_id_fk`),
  CONSTRAINT `fk_quotation_confirmation_quotation` FOREIGN KEY (`quotation_id_fk`) REFERENCES `quotation` (`quotation_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_quotation_confirmation_option` FOREIGN KEY (`option_id_fk`) REFERENCES `quotation_options` (`quotation_options_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_quotation_confirmation_properties_days` FOREIGN KEY (`properties_day_id_fk`) REFERENCES `quotation_properties_days` (`quotation_properties_days_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_quotation_confirmation_properties` FOREIGN KEY (`properties_id_fk`) REFERENCES `quotation_properties` (`quotation_properties_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_quotation_confirmation_properties_rooms` FOREIGN KEY (`properties_room_id_fk`) REFERENCES `quotation_properties_rooms` (`quotation_properties_rooms_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
