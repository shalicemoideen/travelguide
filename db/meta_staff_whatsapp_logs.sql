-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 21, 2026 at 08:36 AM
-- Server version: 10.1.38-MariaDB
-- PHP Version: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `travels_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `meta_staff_whatsapp_logs`
--

CREATE TABLE `meta_staff_whatsapp_logs` (
  `id` int(11) NOT NULL,
  `lead_id_fk` int(11) NOT NULL,
  `staff_id_fk` int(11) NOT NULL,
  `lead_number` varchar(100) DEFAULT NULL,
  `staff_name` varchar(255) DEFAULT NULL,
  `staff_whatsapp_number` varchar(50) DEFAULT NULL,
  `template_name` varchar(255) DEFAULT NULL,
  `language_code` varchar(20) DEFAULT NULL,
  `template_params` longtext,
  `api_status` varchar(20) DEFAULT NULL,
  `http_code` int(11) DEFAULT NULL,
  `message_id` varchar(255) DEFAULT NULL,
  `wa_id` varchar(100) DEFAULT NULL,
  `api_response` longtext,
  `api_error` longtext,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `meta_staff_whatsapp_logs`
--
ALTER TABLE `meta_staff_whatsapp_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_lead_id_fk` (`lead_id_fk`),
  ADD KEY `idx_staff_id_fk` (`staff_id_fk`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `meta_staff_whatsapp_logs`
--
ALTER TABLE `meta_staff_whatsapp_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `meta_staff_whatsapp_logs`
--
ALTER TABLE `meta_staff_whatsapp_logs`
  ADD CONSTRAINT `fk_meta_whatsapp_log_lead` FOREIGN KEY (`lead_id_fk`) REFERENCES `leads` (`leads_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_meta_whatsapp_log_staff` FOREIGN KEY (`staff_id_fk`) REFERENCES `user_details` (`user_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
