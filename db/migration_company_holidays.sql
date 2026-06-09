-- Migration script for company_holidays table
-- This table will store company holidays to prevent staff assignment on those dates

CREATE TABLE IF NOT EXISTS `company_holidays` (
  `company_holiday_id` int(11) NOT NULL AUTO_INCREMENT,
  `holiday_name` varchar(255) NOT NULL,
  `holiday_date` date NOT NULL,
  `holiday_description` text,
  `holiday_type` enum('fixed','recurring') DEFAULT 'fixed',
  `holiday_created_by_user_id` int(11) NOT NULL,
  `holiday_created_by_username` varchar(255) NOT NULL,
  `holiday_created_date` date NOT NULL,
  `holiday_created_time` time NOT NULL,
  `holiday_status` int(11) NOT NULL DEFAULT 1,
  PRIMARY KEY (`company_holiday_id`),
  UNIQUE KEY `holiday_date` (`holiday_date`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Configuration table for recurring holiday settings
CREATE TABLE IF NOT EXISTS `holiday_settings` (
  `setting_id` int(11) NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) NOT NULL,
  `setting_value` varchar(10) NOT NULL DEFAULT '0',
  `setting_description` varchar(255) NOT NULL,
  `setting_updated_date` date NOT NULL,
  `setting_updated_time` time NOT NULL,
  `setting_updated_by_user_id` int(11) NOT NULL,
  `setting_updated_by_username` varchar(255) NOT NULL,
  PRIMARY KEY (`setting_id`),
  UNIQUE KEY `setting_key` (`setting_key`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Insert default settings for recurring holidays
INSERT INTO `holiday_settings` (`setting_key`, `setting_value`, `setting_description`, `setting_updated_date`, `setting_updated_time`, `setting_updated_by_user_id`, `setting_updated_by_username`) VALUES
('enable_sunday_holiday', '1', 'Enable all Sundays as holidays', CURDATE(), CURTIME(), 1, 'Super admin'),
('enable_second_saturday_holiday', '1', 'Enable 2nd Saturday of every month as holiday', CURDATE(), CURTIME(), 1, 'Super admin');

-- Insert some sample holidays
INSERT INTO `company_holidays` (`holiday_name`, `holiday_date`, `holiday_description`, `holiday_type`, `holiday_created_by_user_id`, `holiday_created_by_username`, `holiday_created_date`, `holiday_created_time`, `holiday_status`) VALUES
('New Year', '2026-01-01', 'New Year Day', 'fixed', 1, 'Super admin', CURDATE(), CURTIME(), 1),
('Republic Day', '2026-01-26', 'Republic Day', 'fixed', 1, 'Super admin', CURDATE(), CURTIME(), 1);
