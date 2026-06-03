-- Create languages table
CREATE TABLE IF NOT EXISTS `languages` (
  `language_id` int(11) NOT NULL AUTO_INCREMENT,
  `language_name` varchar(100) NOT NULL,
  `language_code` varchar(10) NOT NULL,
  `language_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`language_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Insert common languages
INSERT INTO `languages` (`language_id`, `language_name`, `language_code`, `language_status`) VALUES
(1, 'Tamil', 'ta', 1),
(2, 'English', 'en', 1),
(3, 'Hindi', 'hi', 1),
(4, 'Malayalam', 'ml', 1),
(5, 'Telugu', 'te', 1),
(6, 'Kannada', 'kn', 1),
(7, 'Arabic', 'ar', 1),
(8, 'French', 'fr', 1);

-- Create staff_languages relationship table
CREATE TABLE IF NOT EXISTS `staff_languages` (
  `staff_language_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id_fk` int(11) NOT NULL,
  `language_id_fk` int(11) NOT NULL,
  PRIMARY KEY (`staff_language_id`),
  KEY `user_id_fk` (`user_id_fk`),
  KEY `language_id_fk` (`language_id_fk`),
  CONSTRAINT `fk_staff_languages_user` FOREIGN KEY (`user_id_fk`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_staff_languages_language` FOREIGN KEY (`language_id_fk`) REFERENCES `languages` (`language_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
