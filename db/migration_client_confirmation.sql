-- Client Confirmation System for Quotations
-- This allows clients to confirm which property is fixed for each day and room category details

-- Main client confirmation table
CREATE TABLE IF NOT EXISTS `client_confirmation` (
  `client_confirmation_id` int(11) NOT NULL AUTO_INCREMENT,
  `quotation_id_fk` int(11) NOT NULL,
  `confirmation_token` varchar(255) NOT NULL,
  `confirmation_status` enum('pending','confirmed','rejected') NOT NULL DEFAULT 'pending',
  `client_name` varchar(255) NOT NULL,
  `client_email` varchar(255) DEFAULT NULL,
  `client_phone` varchar(50) DEFAULT NULL,
  `client_comments` text DEFAULT NULL,
  `confirmation_date` datetime DEFAULT NULL,
  `created_date` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `client_confirmation_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`client_confirmation_id`),
  KEY `quotation_id_fk` (`quotation_id_fk`),
  CONSTRAINT `fk_client_confirmation_quotation` FOREIGN KEY (`quotation_id_fk`) REFERENCES `quotation` (`quotation_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Client confirmation for each day (which property is confirmed)
CREATE TABLE IF NOT EXISTS `client_confirmation_days` (
  `client_confirmation_days_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_confirmation_id_fk` int(11) NOT NULL,
  `quotation_properties_days_id_fk` int(11) NOT NULL,
  `confirmed_quotation_properties_id_fk` int(11) NOT NULL,
  `day_number` int(11) NOT NULL,
  `client_confirmation_days_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`client_confirmation_days_id`),
  KEY `client_confirmation_id_fk` (`client_confirmation_id_fk`),
  KEY `quotation_properties_days_id_fk` (`quotation_properties_days_id_fk`),
  KEY `confirmed_quotation_properties_id_fk` (`confirmed_quotation_properties_id_fk`),
  CONSTRAINT `fk_client_confirmation_days_confirmation` FOREIGN KEY (`client_confirmation_id_fk`) REFERENCES `client_confirmation` (`client_confirmation_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_client_confirmation_days_properties_days` FOREIGN KEY (`quotation_properties_days_id_fk`) REFERENCES `quotation_properties_days` (`quotation_properties_days_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_client_confirmation_days_properties` FOREIGN KEY (`confirmed_quotation_properties_id_fk`) REFERENCES `quotation_properties` (`quotation_properties_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Client confirmation for room categories (which room category is confirmed for each property)
CREATE TABLE IF NOT EXISTS `client_confirmation_rooms` (
  `client_confirmation_rooms_id` int(11) NOT NULL AUTO_INCREMENT,
  `client_confirmation_days_id_fk` int(11) NOT NULL,
  `confirmed_quotation_properties_rooms_id_fk` int(11) NOT NULL,
  `room_category_name` varchar(255) NOT NULL,
  `client_confirmation_rooms_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`client_confirmation_rooms_id`),
  KEY `client_confirmation_days_id_fk` (`client_confirmation_days_id_fk`),
  KEY `confirmed_quotation_properties_rooms_id_fk` (`confirmed_quotation_properties_rooms_id_fk`),
  CONSTRAINT `fk_client_confirmation_rooms_days` FOREIGN KEY (`client_confirmation_days_id_fk`) REFERENCES `client_confirmation_days` (`client_confirmation_days_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_client_confirmation_rooms_rooms` FOREIGN KEY (`confirmed_quotation_properties_rooms_id_fk`) REFERENCES `quotation_properties_rooms` (`quotation_properties_rooms_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
