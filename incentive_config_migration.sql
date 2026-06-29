-- Incentive configuration table
CREATE TABLE IF NOT EXISTS `incentive_config` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `slab_label` varchar(100) NOT NULL,
  `min_profit` decimal(15,2) NOT NULL DEFAULT '0.00',
  `max_profit` decimal(15,2) DEFAULT NULL COMMENT 'NULL means no upper limit',
  `calculation_type` enum('fixed','percentage') NOT NULL DEFAULT 'fixed',
  `incentive_value` decimal(10,2) NOT NULL DEFAULT '0.00',
  `deduction` decimal(10,2) NOT NULL DEFAULT '0.00',
  `status` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- Default incentive slabs
INSERT INTO `incentive_config` (`slab_label`, `min_profit`, `max_profit`, `calculation_type`, `incentive_value`, `deduction`) VALUES
('Upto 5000',     0.00,     5000.00, 'fixed',      500.00, 0.00),
('5000 to 10000', 5000.01, 10000.00, 'percentage',  10.00, 500.00),
('10000 to 20000',10000.01,20000.00, 'percentage',  20.00, 500.00);
