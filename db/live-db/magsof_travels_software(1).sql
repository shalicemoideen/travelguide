-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2026 at 04:32 AM
-- Server version: 10.4.34-MariaDB
-- PHP Version: 7.2.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `magsof_travels_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `accommodation_plan`
--

CREATE TABLE `accommodation_plan` (
  `accommodation_plan_id` int(11) NOT NULL,
  `guset_count_details_id_fk` int(11) NOT NULL,
  `lead_id_fk` int(11) NOT NULL,
  `pacakage_id_fk` int(11) NOT NULL,
  `day_id_fk` int(11) NOT NULL,
  `property_day_id_fk` int(11) DEFAULT NULL,
  `accommodation_date` date NOT NULL,
  `accommodation_day_name` varchar(255) NOT NULL,
  `stay_destination_id_fk` int(11) NOT NULL,
  `meal_plan_id_fk` int(11) NOT NULL,
  `accomodation_required_staus` varchar(200) NOT NULL,
  `accommodation_plan_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `account_details_id` int(11) NOT NULL,
  `qr_code` varchar(255) NOT NULL,
  `bank_logo` varchar(255) NOT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `ifsc_code` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `account_details_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`account_details_id`, `qr_code`, `bank_logo`, `account_name`, `account_number`, `ifsc_code`, `branch_name`, `account_details_status`) VALUES
(1, 'QR-code.png', 'SBI-Logo.png', 'ROYALE INDIA', '18188119199929', 'SBI0001380', 'ALUVA', 1);

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE `activity` (
  `activity_id` int(11) NOT NULL,
  `id_fk` int(11) NOT NULL,
  `activity_staff_id_fk` int(11) NOT NULL,
  `activity_company_id_fk` int(11) NOT NULL,
  `activity_type` varchar(255) NOT NULL,
  `activity_order_number` varchar(255) NOT NULL,
  `activity_description` text NOT NULL,
  `activity_ip` varchar(255) NOT NULL,
  `activity_action` varchar(255) NOT NULL,
  `activity_by_userid` int(11) NOT NULL,
  `activity_by_username` varchar(255) NOT NULL,
  `activity_date` date NOT NULL,
  `activity_date_time` datetime NOT NULL,
  `activity_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `activity`
--

INSERT INTO `activity` (`activity_id`, `id_fk`, `activity_staff_id_fk`, `activity_company_id_fk`, `activity_type`, `activity_order_number`, `activity_description`, `activity_ip`, `activity_action`, `activity_by_userid`, `activity_by_username`, `activity_date`, `activity_date_time`, `activity_status`) VALUES
(1, 25, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: fhfhed', '127.0.0.1', 'Edit', 0, '', '2025-07-17', '2025-07-17 10:21:30', 1),
(2, 25, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fhfhed', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 10:31:01', 1),
(3, 24, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: fhfh', '127.0.0.1', 'Edit', 0, '', '2025-07-17', '2025-07-17 10:32:05', 1),
(4, 1, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 10:34:12', 1),
(5, 2, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Innova', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 10:50:32', 1),
(6, 3, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Sedan', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 10:50:53', 1),
(7, 4, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Buke', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 10:58:33', 1),
(8, 5, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 10:59:06', 1),
(9, 6, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:05:26', 1),
(10, 7, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:07:52', 1),
(11, 8, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:08:17', 1),
(12, 9, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:12:48', 1),
(13, 10, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:14:20', 1),
(14, 11, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:14:53', 1),
(15, 12, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:15:18', 1),
(16, 13, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:15:51', 1),
(17, 14, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:18:19', 1),
(18, 15, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:18:59', 1),
(19, 16, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:19:15', 1),
(20, 16, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: fhfh', '127.0.0.1', 'Edit', 0, '', '2025-07-17', '2025-07-17 11:20:06', 1),
(21, 17, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:25:10', 1),
(22, 17, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle kk', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:32:01', 1),
(23, 16, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fhfh', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:32:05', 1),
(24, 15, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle mmn', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:32:41', 1),
(25, 14, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle mmn', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:32:44', 1),
(26, 13, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle mmn', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:39:11', 1),
(27, 12, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle kk', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:39:14', 1),
(28, 1, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:39:33', 1),
(29, 1, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle Ertiga', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:43:19', 1),
(30, 0, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle ', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:43:36', 1),
(31, 2, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:45:13', 1),
(32, 2, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle mmn', '127.0.0.1', 'Delete', 0, '', '2025-07-17', '2025-07-17 11:52:01', 1),
(33, 3, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:52:10', 1),
(34, 4, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-17', '2025-07-17 11:52:22', 1),
(35, 5, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:06:08', 1),
(36, 5, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fhfh', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 11:07:15', 1),
(37, 6, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:22:10', 1),
(38, 7, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:23:07', 1),
(39, 8, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:23:37', 1),
(40, 9, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:31:07', 1),
(41, 10, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:32:19', 1),
(42, 11, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:34:40', 1),
(43, 1, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:36:46', 1),
(44, 2, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:37:37', 1),
(45, 3, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:38:39', 1),
(46, 4, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:39:01', 1),
(47, 5, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:39:22', 1),
(48, 6, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:42:05', 1),
(49, 7, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:42:13', 1),
(50, 8, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 11:43:35', 1),
(51, 9, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:13:39', 1),
(52, 10, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:13:58', 1),
(53, 11, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:14:29', 1),
(54, 12, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:14:53', 1),
(55, 13, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:15:09', 1),
(56, 14, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:15:35', 1),
(57, 15, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:17:13', 1),
(58, 16, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:19:43', 1),
(59, 17, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:21:06', 1),
(60, 18, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:21:54', 1),
(61, 19, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:22:28', 1),
(62, 20, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:25:00', 1),
(63, 21, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:25:13', 1),
(64, 22, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:25:19', 1),
(65, 23, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:25:30', 1),
(66, 24, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:25:37', 1),
(67, 25, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:25:59', 1),
(68, 26, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:26:06', 1),
(69, 27, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:26:11', 1),
(70, 27, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: mmncfcv', '127.0.0.1', 'Edit', 0, '', '2025-07-18', '2025-07-18 12:26:19', 1),
(71, 28, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:26:43', 1),
(72, 29, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:26:53', 1),
(73, 1, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:27:13', 1),
(74, 2, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:27:37', 1),
(75, 3, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:27:44', 1),
(76, 4, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:28:00', 1),
(77, 5, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:28:13', 1),
(78, 6, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:28:59', 1),
(79, 7, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:29:05', 1),
(80, 8, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:29:15', 1),
(81, 9, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:29:20', 1),
(82, 10, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:29:39', 1),
(83, 11, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 12:29:57', 1),
(84, 12, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 01:05:11', 1),
(85, 12, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hjk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 01:05:28', 1),
(86, 11, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle mmn', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 03:58:08', 1),
(87, 10, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fhfh', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:08:34', 1),
(88, 9, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gffg', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:08:44', 1),
(89, 8, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hjk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:11:19', 1),
(90, 7, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fhfh', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:13:19', 1),
(91, 6, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle kk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:21:13', 1),
(92, 5, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle kk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:25:19', 1),
(93, 4, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gffg', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:32:12', 1),
(94, 3, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hjk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:48:41', 1),
(95, 2, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle mmn', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 04:55:42', 1),
(96, 13, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 04:58:47', 1),
(97, 14, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:00:30', 1),
(98, 15, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:22:53', 1),
(99, 15, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle Ertiga', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 05:22:59', 1),
(100, 16, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:23:06', 1),
(101, 17, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gjj', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:55:55', 1),
(102, 18, 0, 0, 'Vehicle_registration', '', 'Added vehicle: jgj', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:55:59', 1),
(103, 19, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gj', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:56:05', 1),
(104, 20, 0, 0, 'Vehicle_registration', '', 'Added vehicle: ghjh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:56:11', 1),
(105, 21, 0, 0, 'Vehicle_registration', '', 'Added vehicle: ghj', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:56:25', 1),
(106, 22, 0, 0, 'Vehicle_registration', '', 'Added vehicle: jhjhk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:56:30', 1),
(107, 22, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle jhjhk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 05:56:48', 1),
(108, 23, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:57:00', 1),
(109, 24, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:58:16', 1),
(110, 25, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:58:21', 1),
(111, 26, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:58:25', 1),
(112, 27, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:58:30', 1),
(113, 28, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 05:58:34', 1),
(114, 29, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:00:32', 1),
(115, 29, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hjk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 06:00:36', 1),
(116, 30, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:00:54', 1),
(117, 31, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:00:58', 1),
(118, 32, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:02:50', 1),
(119, 33, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:03:20', 1),
(120, 34, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:03:25', 1),
(121, 35, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:03:30', 1),
(122, 36, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:03:37', 1),
(123, 37, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:03:42', 1),
(124, 38, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:03:48', 1),
(125, 39, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:04:01', 1),
(126, 40, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:04:16', 1),
(127, 41, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:04:21', 1),
(128, 42, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:04:26', 1),
(129, 42, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle Ertiga', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 06:06:01', 1),
(130, 43, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:07:09', 1),
(131, 44, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:07:16', 1),
(132, 45, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:07:37', 1),
(133, 46, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:07:42', 1),
(134, 46, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle kk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 06:07:46', 1),
(135, 45, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle Ertiga', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 06:08:20', 1),
(136, 44, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle Ertiga', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 06:08:24', 1),
(137, 47, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:08:29', 1),
(138, 48, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:08:35', 1),
(139, 49, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:09:06', 1),
(140, 50, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:09:23', 1),
(141, 51, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hjk', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:09:33', 1),
(142, 51, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: hjk', '127.0.0.1', 'Edit', 0, '', '2025-07-18', '2025-07-18 06:09:40', 1),
(143, 52, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:11:38', 1),
(144, 52, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: Ertigass', '127.0.0.1', 'Edit', 0, '', '2025-07-18', '2025-07-18 06:11:45', 1),
(145, 52, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle Ertigass', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 06:11:50', 1),
(146, 51, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hjk', '127.0.0.1', 'Delete', 0, '', '2025-07-18', '2025-07-18 06:11:53', 1),
(147, 53, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:14:06', 1),
(148, 54, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-18', '2025-07-18 06:14:40', 1),
(149, 1, 0, 0, 'Vehicle_registration', '', 'Added vehicle: Ertiga', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:31:45', 1),
(150, 2, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mmn', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:31:55', 1),
(151, 3, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:47:22', 1),
(152, 3, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fhfh', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 07:47:28', 1),
(153, 4, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:47:39', 1),
(154, 4, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: gffgnn', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:47:49', 1),
(155, 4, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: gffgnn', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:48:25', 1),
(156, 5, 0, 0, 'Vehicle_registration', '', 'Added vehicle: kk', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:50:51', 1),
(157, 6, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gffg', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:51:01', 1),
(158, 6, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gffg', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 07:51:06', 1),
(159, 7, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gdd', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:51:23', 1),
(160, 8, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hghgh', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:51:28', 1),
(161, 9, 0, 0, 'Vehicle_registration', '', 'Added vehicle: qw', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:51:41', 1),
(162, 9, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: qwfdf', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:51:47', 1),
(163, 10, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fdf', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:51:52', 1),
(164, 11, 0, 0, 'Vehicle_registration', '', 'Added vehicle: tyt', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:52:04', 1),
(165, 12, 0, 0, 'Vehicle_registration', '', 'Added vehicle: etyt', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:52:11', 1),
(166, 12, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: etythhh', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:52:16', 1),
(167, 13, 0, 0, 'Vehicle_registration', '', 'Added vehicle: eet', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:52:22', 1),
(168, 14, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fhfh', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:53:17', 1),
(169, 15, 0, 0, 'Vehicle_registration', '', 'Added vehicle: mbbn', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:53:28', 1),
(170, 15, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: mbbnhgh', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:53:36', 1),
(171, 15, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: mbbnhghgfh', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:53:48', 1),
(172, 16, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hfhg', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:53:57', 1),
(173, 17, 0, 0, 'Vehicle_registration', '', 'Added vehicle: saasd', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:54:08', 1),
(174, 17, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: saasdfdf', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:54:14', 1),
(175, 18, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fsfsdf', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:54:20', 1),
(176, 18, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: fsfsdffd', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:54:27', 1),
(177, 19, 0, 0, 'Vehicle_registration', '', 'Added vehicle: fgf', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:54:33', 1),
(178, 19, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: fgf', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:54:47', 1),
(179, 20, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hghg', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 07:54:54', 1),
(180, 20, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: hghgfg', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:57:39', 1),
(181, 20, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: hghgfg', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 07:58:03', 1),
(182, 21, 0, 0, 'Vehicle_registration', '', 'Added vehicle: sdf', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 08:01:00', 1),
(183, 21, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: sdf', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 08:01:05', 1),
(184, 22, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gfgf', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 08:01:19', 1),
(185, 22, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: gfgfdgdf', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 08:01:55', 1),
(186, 23, 0, 0, 'Vehicle_registration', '', 'Added vehicle: dd', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 08:02:03', 1),
(187, 23, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle dd', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 08:02:07', 1),
(188, 24, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gdgd', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 08:02:12', 1),
(189, 24, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: gdgddf', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 08:02:16', 1),
(190, 24, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gdgddf', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 08:02:19', 1),
(191, 22, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: gfgfdgdfgf', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 08:02:25', 1),
(192, 12, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle etythhh', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 08:08:30', 1),
(193, 22, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: gfgfdgdfgf0', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 08:08:45', 1),
(194, 25, 0, 0, 'Vehicle_registration', '', 'Added vehicle: 3w', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 08:08:55', 1),
(195, 26, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gdfg', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 08:52:53', 1),
(196, 27, 0, 0, 'Vehicle_registration', '', 'Added vehicle: dsd', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 08:54:30', 1),
(197, 28, 0, 0, 'Vehicle_registration', '', 'Added vehicle: hhg', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 08:54:39', 1),
(198, 28, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: hhg', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 08:54:46', 1),
(199, 29, 0, 0, 'Vehicle_registration', '', 'Added vehicle: gfg', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 09:17:00', 1),
(200, 30, 0, 0, 'Vehicle_registration', '', 'Added vehicle: jhjh', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 09:17:18', 1),
(201, 31, 0, 0, 'Vehicle_registration', '', 'Added vehicle: dfg', '127.0.0.1', 'Add', 0, '', '2025-07-19', '2025-07-19 09:18:29', 1),
(202, 31, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: dfggf', '127.0.0.1', 'Edit', 0, '', '2025-07-19', '2025-07-19 09:18:34', 1),
(203, 31, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle dfggf', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 09:18:39', 1),
(204, 30, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle jhjh', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 12:01:36', 1),
(205, 29, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gfg', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 12:01:43', 1),
(206, 28, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hhg', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 12:07:54', 1),
(207, 27, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle dsd', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 12:07:57', 1),
(208, 26, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gdfg', '127.0.0.1', 'Delete', 0, '', '2025-07-19', '2025-07-19 12:08:03', 1),
(209, 1, 0, 0, 'Property_category_registration', '', 'Added property category: 5 star', '127.0.0.1', 'Add', 0, '', '2025-07-20', '2025-07-20 10:06:07', 1),
(210, 2, 0, 0, 'Property_category_registration', '', 'Added property category: 3 star', '127.0.0.1', 'Add', 0, '', '2025-07-20', '2025-07-20 10:06:28', 1),
(211, 2, 0, 0, 'Property_category_registration', '', 'Edited property category: 3 star dxffd', '127.0.0.1', 'Edit', 0, '', '2025-07-20', '2025-07-20 10:06:52', 1),
(212, 3, 0, 0, 'Property_category_registration', '', 'Added property category: jhjh', '127.0.0.1', 'Add', 0, '', '2025-07-20', '2025-07-20 10:06:58', 1),
(213, 3, 0, 0, 'Property_category_registration', '', 'Deleted property category jhjh', '127.0.0.1', 'Delete', 0, '', '2025-07-20', '2025-07-20 10:07:33', 1),
(214, 4, 0, 0, 'Property_category_registration', '', 'Added property category: jhbhj', '127.0.0.1', 'Add', 0, '', '2025-07-20', '2025-07-20 10:07:39', 1),
(215, 1, 0, 0, 'B2B_partner_registration', '', 'Added b2b partner: fgdf', '127.0.0.1', 'Add', 0, '', '2025-07-22', '2025-07-22 02:06:06', 1),
(216, 1, 0, 0, 'B2B_partner_registration', '', 'Edited b2b partner: fgdfggh', '127.0.0.1', 'Edit', 0, '', '2025-07-22', '2025-07-22 02:22:19', 1),
(217, 1, 0, 0, 'B2B_partner_registration', '', 'Edited b2b partner: fgdfggh', '127.0.0.1', 'Edit', 0, '', '2025-07-22', '2025-07-22 02:22:50', 1),
(218, 1, 0, 0, 'B2B_partner_registration', '', 'Added b2b partner: Dahgg', '127.0.0.1', 'Add', 0, '', '2025-07-22', '2025-07-22 02:23:42', 1),
(219, 1, 0, 0, 'B2B_partner_registration', '', 'Edited b2b partner: Dahgg', '127.0.0.1', 'Edit', 0, '', '2025-07-22', '2025-07-22 02:26:12', 1),
(220, 1, 0, 0, 'B2B_partner_registration', '', 'Deleted b2b partner: Dahgg', '127.0.0.1', 'Delete', 0, '', '2025-07-22', '2025-07-22 08:14:22', 1),
(221, 2, 0, 0, 'B2B_partner_registration', '', 'Added b2b partner: Jaffar', '127.0.0.1', 'Add', 0, '', '2025-07-22', '2025-07-22 08:15:09', 1),
(222, 2, 0, 0, 'B2B_partner_registration', '', 'Edited b2b partner: Jaffarghg', '127.0.0.1', 'Edit', 0, '', '2025-07-22', '2025-07-22 08:15:24', 1),
(223, 1, 0, 0, 'Transporter_registration', '', 'Added transporter: Fahad', '127.0.0.1', 'Add', 0, '', '2025-07-23', '2025-07-23 05:16:37', 1),
(224, 1, 0, 0, 'Transporter_registration', '', 'Edited transporter: Fahad', '127.0.0.1', 'Edit', 0, '', '2025-07-24', '2025-07-24 08:15:09', 1),
(225, 1, 0, 0, 'Transporter_registration', '', 'Edited transporter: Fahadhh', '127.0.0.1', 'Edit', 0, '', '2025-07-24', '2025-07-24 08:15:24', 1),
(226, 1, 0, 0, 'Transporter_registration', '', 'Edited transporter: Fahadhh', '127.0.0.1', 'Edit', 0, '', '2025-07-24', '2025-07-24 08:15:33', 1),
(227, 2, 0, 0, 'Transporter_registration', '', 'Added transporter: hjhj', '127.0.0.1', 'Add', 0, '', '2025-07-24', '2025-07-24 08:16:09', 1),
(228, 1, 0, 0, 'Transporter_registration', '', 'Deleted transporter: Fahadhh', '127.0.0.1', 'Delete', 0, '', '2025-07-24', '2025-07-24 08:26:37', 1),
(229, 2, 0, 0, 'Transporter_registration', '', 'Deleted transporter: hjhj', '127.0.0.1', 'Delete', 0, '', '2025-07-24', '2025-07-24 08:27:36', 1),
(230, 3, 0, 0, 'Transporter_registration', '', 'Added transporter: jkhj', '127.0.0.1', 'Add', 0, '', '2025-07-24', '2025-07-24 08:28:07', 1),
(231, 3, 0, 0, 'Transporter_registration', '', 'Deleted transporter: jkhj', '127.0.0.1', 'Delete', 0, '', '2025-07-24', '2025-07-24 08:28:12', 1),
(232, 20, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hghgfg', '127.0.0.1', 'Delete', 0, '', '2025-07-24', '2025-07-24 08:29:00', 1),
(233, 1, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: jgh', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 08:32:55', 1),
(234, 4, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: gh', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 08:38:18', 1),
(235, 1, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: jjkjj', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 08:39:20', 1),
(236, 2, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: dsd', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 08:40:37', 1),
(237, 3, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: cbc', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 08:41:33', 1),
(238, 1, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: policiy', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 10:13:24', 1),
(239, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: policiy', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 03:26:37', 1),
(240, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: policiy', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 03:26:47', 1),
(241, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: policiy', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 03:27:45', 1),
(242, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: policiy', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 03:28:39', 1),
(243, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: policiy', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 03:29:00', 1),
(244, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: policiy', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 03:29:08', 1),
(245, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: policiy', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 03:29:30', 1),
(246, 1, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: cbc', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 06:20:03', 1),
(247, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:20:21', 1),
(248, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:20:37', 1),
(249, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:21:05', 1),
(250, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:22:56', 1),
(251, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:23:27', 1),
(252, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:23:43', 1),
(253, 1, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: bcv', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 06:24:12', 1),
(254, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:24:22', 1),
(255, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:24:54', 1),
(256, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:25:08', 1),
(257, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:26:05', 1),
(258, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:26:25', 1),
(259, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:27:40', 1),
(260, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:28:16', 1),
(261, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:28:57', 1),
(262, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:30:44', 1),
(263, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:30:57', 1),
(264, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:38:21', 1),
(265, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 06:41:34', 1),
(266, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: bcv', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 07:03:51', 1),
(267, 1, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: cbc', '127.0.0.1', 'Add', 0, '', '2025-07-25', '2025-07-25 08:22:16', 1),
(268, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 08:22:29', 1),
(269, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 08:22:58', 1),
(270, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 08:23:28', 1),
(271, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 08:23:38', 1),
(272, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 08:24:24', 1),
(273, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 08:25:01', 1),
(274, 1, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: cbc', '127.0.0.1', 'Edit', 0, '', '2025-07-25', '2025-07-25 08:26:15', 1),
(275, 1, 0, 0, 'Property_registration', '', 'Added property: hkhk', '127.0.0.1', 'Add', 0, '', '2025-07-30', '2025-07-30 11:11:08', 1),
(276, 1, 0, 0, 'Property_registration', '', 'Edited property: hkhk', '127.0.0.1', 'Edit', 0, '', '2025-07-30', '2025-07-30 01:14:02', 1),
(277, 1, 0, 0, 'Property_registration', '', 'Added property: Trret', '127.0.0.1', 'Add', 0, '', '2025-07-30', '2025-07-30 04:48:26', 1),
(278, 2, 0, 0, 'Property_registration', '', 'Added property: Trret', '127.0.0.1', 'Add', 0, '', '2025-07-30', '2025-07-30 04:49:31', 1),
(279, 3, 0, 0, 'Property_registration', '', 'Added property: jllljk', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 10:11:39', 1),
(280, 4, 0, 0, 'Property_registration', '', 'Added property: jghkjk', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 10:24:43', 1),
(281, 1, 0, 0, 'Property_registration', '', 'Added property: hjghjghj', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 10:39:33', 1),
(282, 1, 0, 0, 'Property_registration', '', 'Added property: kkhkhj', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 10:44:45', 1),
(283, 1, 0, 0, 'Property_registration', '', 'Added property: Trret', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 10:45:45', 1),
(284, 1, 0, 0, 'Property_registration', '', 'Added property: hkhk', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 10:55:24', 1),
(285, 2, 0, 0, 'Property_registration', '', 'Added property: bnmn', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 10:56:42', 1),
(286, 1, 0, 0, 'Property_registration', '', 'Added property: Trret', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 11:03:07', 1),
(287, 1, 0, 0, 'Property_registration', '', 'Added property: Trret', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 11:06:59', 1),
(288, 1, 0, 0, 'Property_registration', '', 'Added property: hjkhk', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 11:09:11', 1),
(289, 2, 0, 0, 'Property_registration', '', 'Added property: hjhj', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 11:13:33', 1),
(290, 3, 0, 0, 'Property_registration', '', 'Added property: kklkjl', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 11:14:24', 1),
(291, 1, 0, 0, 'Property_registration', '', 'Added property: Trret', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 02:51:43', 1),
(292, 1, 0, 0, 'Property_registration', '', 'Edited property: Trret_edited', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 02:53:53', 1),
(293, 1, 0, 0, 'Property_registration', '', 'Edited property: Trret_edited', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 02:55:43', 1),
(294, 1, 0, 0, 'Property_registration', '', 'Edited property: Trret_edited', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 02:56:41', 1),
(295, 1, 0, 0, 'Property_registration', '', 'Edited property: Trret_edited', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 02:59:01', 1),
(296, 1, 0, 0, 'Property_registration', '', 'Edited property: Trret_edited', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 03:00:10', 1),
(297, 1, 0, 0, 'Property_registration', '', 'Edited property: Trret_edited', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 03:02:32', 1),
(298, 1, 0, 0, 'Property_registration', '', 'Added property: Janath', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 03:09:02', 1),
(299, 1, 0, 0, 'Property_registration', '', 'Edited property: Janath', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 03:10:03', 1),
(300, 1, 0, 0, 'Property_registration', '', 'Edited property: Janath', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 03:10:12', 1),
(301, 2, 0, 0, 'Property_registration', '', 'Added property: Majestic', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 06:21:25', 1),
(302, 2, 0, 0, 'Property_registration', '', 'Edited property: Majestic', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 06:21:59', 1),
(303, 2, 0, 0, 'Property_registration', '', 'Edited property: Majestic', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 06:22:22', 1),
(304, 1, 0, 0, 'Property_registration', '', 'Added property: Janath', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 06:31:46', 1),
(305, 1, 0, 0, 'Property_registration', '', 'Added property: Majestic', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 06:38:19', 1),
(306, 2, 0, 0, 'Property_registration', '', 'Added property: Janath', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 06:39:58', 1),
(307, 2, 0, 0, 'Property_registration', '', 'Edited property: Janath', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 06:48:25', 1),
(308, 2, 0, 0, 'Property_registration', '', 'Edited property: Janath', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 06:48:58', 1),
(309, 1, 0, 0, 'Property_registration', '', 'Edited property: Majestic', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 06:49:25', 1),
(310, 1, 0, 0, 'Property_registration', '', 'Edited property: Majestic', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 06:49:43', 1),
(311, 1, 0, 0, 'Property_registration', '', 'Edited property: Majestic', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 06:50:05', 1),
(312, 1, 0, 0, 'Property_registration', '', 'Added property: Janath', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 07:21:53', 1),
(313, 1, 0, 0, 'Property_registration', '', 'Edited property: Janath', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 07:37:12', 1),
(314, 1, 0, 0, 'Property_registration', '', 'Edited property: Janath', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 07:38:26', 1),
(315, 1, 0, 0, 'Property_registration', '', 'Edited property: Janath', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 07:45:15', 1),
(316, 2, 0, 0, 'Property_registration', '', 'Added property: Majestic', '127.0.0.1', 'Add', 0, '', '2025-07-31', '2025-07-31 08:44:45', 1),
(317, 2, 0, 0, 'Property_registration', '', 'Edited property: Majestic', '127.0.0.1', 'Edit', 0, '', '2025-07-31', '2025-07-31 08:46:33', 1),
(318, 2, 0, 0, 'Property_registration', '', 'Deleted property: Majestic', '127.0.0.1', 'Delete', 0, '', '2025-08-01', '2025-08-01 10:02:56', 1),
(319, 3, 0, 0, 'Property_registration', '', 'Added property: sds', '127.0.0.1', 'Add', 0, '', '2025-08-01', '2025-08-01 06:57:03', 1),
(320, 4, 0, 0, 'Property_registration', '', 'Added property: Trret', '127.0.0.1', 'Add', 0, '', '2025-08-01', '2025-08-01 10:31:20', 1),
(321, 1, 0, 0, 'Room_category_registration', '', 'Added room category: sddf', '127.0.0.1', 'Add', 0, '', '2025-08-04', '2025-08-04 11:21:57', 1),
(322, 2, 0, 0, 'Room_category_registration', '', 'Added room category: dsfs', '127.0.0.1', 'Add', 0, '', '2025-08-04', '2025-08-04 11:43:27', 1),
(323, 3, 0, 0, 'Room_category_registration', '', 'Added room category: sddf', '127.0.0.1', 'Add', 0, '', '2025-08-04', '2025-08-04 11:46:14', 1),
(324, 4, 0, 0, 'Room_category_registration', '', 'Added room category: kjkj', '127.0.0.1', 'Add', 0, '', '2025-08-04', '2025-08-04 11:50:17', 1),
(325, 5, 0, 0, 'Room_category_registration', '', 'Added room category: dsfs', '127.0.0.1', 'Add', 0, '', '2025-08-04', '2025-08-04 11:51:47', 1),
(326, 6, 0, 0, 'Room_category_registration', '', 'Added room category: hkjhk', '127.0.0.1', 'Add', 0, '', '2025-08-06', '2025-08-06 01:17:51', 1),
(327, 1, 0, 0, 'Room_category_registration', '', 'Added room category: yrtr', '127.0.0.1', 'Add', 0, '', '2025-08-06', '2025-08-06 05:17:32', 1),
(328, 2, 0, 0, 'Room_category_registration', '', 'Added room category: yghj', '127.0.0.1', 'Add', 0, '', '2025-08-06', '2025-08-06 05:44:30', 1),
(329, 3, 0, 0, 'Room_category_registration', '', 'Added room category: kjkj', '127.0.0.1', 'Add', 0, '', '2025-08-06', '2025-08-06 06:29:10', 1),
(330, 1, 0, 0, 'Room_category_registration', '', 'Edited room category: yrtr', '127.0.0.1', 'Edit', 0, '', '2025-08-06', '2025-08-06 06:34:01', 1),
(331, 1, 0, 0, 'Room_category_registration', '', 'Edited room category: yrtr', '127.0.0.1', 'Edit', 0, '', '2025-08-06', '2025-08-06 06:34:12', 1),
(332, 1, 0, 0, 'Room_category_registration', '', 'Edited room category: yrtr', '127.0.0.1', 'Edit', 0, '', '2025-08-06', '2025-08-06 06:34:46', 1),
(333, 1, 0, 0, 'Room_category_registration', '', 'Edited room category: yrtr', '127.0.0.1', 'Edit', 0, '', '2025-08-06', '2025-08-06 06:35:29', 1),
(334, 1, 0, 0, 'Room_category_registration', '', 'Edited room category: yrtr', '127.0.0.1', 'Edit', 0, '', '2025-08-06', '2025-08-06 06:35:59', 1),
(335, 2, 0, 0, 'Room_category_registration', '', 'Deleted room category: yghj', '127.0.0.1', 'Delete', 0, '', '2025-08-06', '2025-08-06 06:44:55', 1),
(336, 1, 0, 0, 'Room_category_registration', '', 'Added room category: Deluxe premium', '127.0.0.1', 'Add', 0, '', '2025-08-12', '2025-08-12 08:20:27', 1),
(337, 2, 0, 0, 'Room_category_registration', '', 'Added room category: Standard room', '127.0.0.1', 'Add', 0, '', '2025-08-12', '2025-08-12 08:21:51', 1),
(338, 3, 0, 0, 'Room_category_registration', '', 'Added room category: Jaguar room deluxe', '127.0.0.1', 'Add', 0, '', '2025-08-12', '2025-08-12 08:37:08', 1),
(339, 4, 0, 0, 'Room_category_registration', '', 'Added room category: Large room', '127.0.0.1', 'Add', 0, '', '2025-08-12', '2025-08-12 08:38:21', 1),
(340, 1, 0, 0, 'Package_category_registration', '', 'Added package category: ggh', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-29', '2025-08-29 11:42:01', 1),
(341, 1, 0, 0, 'Package_category_registration', '', 'Edited package category: gghjjjk', '127.0.0.1', 'Edit', 1, 'Super admin', '2025-08-29', '2025-08-29 11:42:07', 1),
(342, 1, 0, 0, 'Package_category_registration', '', 'Deleted package category gghjjjk', '127.0.0.1', 'Delete', 1, 'Super admin', '2025-08-29', '2025-08-29 11:42:12', 1),
(343, 1, 0, 0, 'Itinerary_category_registration', '', 'Added itinerary category: g', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-30', '2025-08-30 10:11:11', 1),
(344, 1, 0, 0, 'Itinerary_category_registration', '', 'Edited itinerary category: gghj', '127.0.0.1', 'Edit', 1, 'Super admin', '2025-08-30', '2025-08-30 10:11:19', 1),
(345, 1, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: hgj', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-30', '2025-08-30 08:06:08', 1),
(346, 2, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: fhghf', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-30', '2025-08-30 08:10:19', 1),
(347, 3, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: fgf', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-30', '2025-08-30 08:11:05', 1),
(348, 4, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: dsd', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-30', '2025-08-30 08:41:12', 1),
(349, 5, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: hh', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-30', '2025-08-30 08:44:16', 1),
(350, 1, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: ghjjg', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-30', '2025-08-30 09:05:00', 1),
(351, 1, 0, 0, 'Special_requirements_registration', '', 'Added special requirement: jkh', '127.0.0.1', 'Add', 1, 'Super admin', '2025-08-31', '2025-08-31 07:51:07', 1),
(352, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: dfdf', '127.0.0.1', 'Add', 0, '', '2025-09-03', '2025-09-03 08:06:40', 1),
(353, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: dfgdfg', '127.0.0.1', 'Add', 0, '', '2025-09-03', '2025-09-03 09:21:30', 1),
(354, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: uikyu', '127.0.0.1', 'Add', 0, '', '2025-09-04', '2025-09-04 08:03:44', 1),
(355, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: jghgj', '127.0.0.1', 'Add', 0, '', '2025-09-04', '2025-09-04 08:04:23', 1),
(356, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: kkhjk', '127.0.0.1', 'Add', 0, '', '2025-09-04', '2025-09-04 08:05:03', 1);
INSERT INTO `activity` (`activity_id`, `id_fk`, `activity_staff_id_fk`, `activity_company_id_fk`, `activity_type`, `activity_order_number`, `activity_description`, `activity_ip`, `activity_action`, `activity_by_userid`, `activity_by_username`, `activity_date`, `activity_date_time`, `activity_status`) VALUES
(357, 2, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: khh', '127.0.0.1', 'Add', 0, '', '2025-09-04', '2025-09-04 08:05:53', 1),
(358, 4, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: gjgj', '127.0.0.1', 'Add', 0, '', '2025-09-04', '2025-09-04 08:57:34', 1),
(359, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: errt', '127.0.0.1', 'Add', 0, '', '2025-09-04', '2025-09-04 09:01:41', 1),
(360, 1, 0, 0, 'Terms_condition_registration', '', 'Edited terms and conditions: errt', '127.0.0.1', 'Edit', 0, '', '2025-09-04', '2025-09-04 09:11:04', 1),
(361, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: iyiuyiy', '127.0.0.1', 'Add', 0, '', '2025-09-04', '2025-09-04 09:11:39', 1),
(362, 1, 0, 0, 'Terms_condition_registration', '', 'Edited terms and conditions: iyiuyiy', '127.0.0.1', 'Edit', 0, '', '2025-09-04', '2025-09-04 09:11:57', 1),
(363, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: fhgf', '127.0.0.1', 'Add', 0, '', '2025-09-04', '2025-09-04 09:13:06', 1),
(364, 1, 0, 0, 'Terms_condition_registration', '', 'Edited terms and conditions: fhgf', '127.0.0.1', 'Edit', 0, '', '2025-09-04', '2025-09-04 09:22:18', 1),
(365, 1, 0, 0, 'Terms_condition_registration', '', 'Edited terms and conditions: fhgf', '127.0.0.1', 'Edit', 0, '', '2025-09-04', '2025-09-04 09:22:53', 1),
(366, 1, 0, 0, 'Terms_condition_registration', '', 'Edited terms and conditions: fhgf', '127.0.0.1', 'Edit', 0, '', '2025-09-04', '2025-09-04 09:23:45', 1),
(367, 1, 0, 0, 'Cancellation_policies_registration', '', 'Added cancellation and policies: hffh', '127.0.0.1', 'Add', 0, '', '2025-09-05', '2025-09-05 12:22:35', 1),
(368, 1, 0, 0, 'Cancellation_policies_registration', '', 'Edited cancellation and policies: hffh', '127.0.0.1', 'Edit', 0, '', '2025-09-05', '2025-09-05 12:23:27', 1),
(369, 4, 0, 0, 'Itinerary_registration', '', 'Added itinerary: jii', '127.0.0.1', 'Add', 0, '', '2025-09-06', '2025-09-06 12:44:08', 1),
(370, 1, 0, 0, 'Itinerary_registration', '', 'Added itinerary: ghgf', '127.0.0.1', 'Add', 0, '', '2025-09-06', '2025-09-06 12:44:45', 1),
(371, 5, 0, 0, 'Room_category_registration', '', 'Added room category: lp', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-06', '2025-09-06 04:20:48', 1),
(372, 2, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2025-09-07 to date 2025-09-08', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-07', '2025-09-07 06:25:03', 1),
(373, 3, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2025-09-08 to date 2025-09-17', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-07', '2025-09-07 06:28:23', 1),
(374, 3, 0, 0, 'Room_tariff_document_registration', '', 'Deleted room tariff from date: --08-09-2025 to date --17-09-2025', '127.0.0.1', 'Delete', 1, 'Super admin', '2025-09-07', '2025-09-07 06:33:00', 1),
(375, 2, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2025-09-07 to date --08-09-2025', '127.0.0.1', 'Edit', 1, 'Super admin', '2025-09-07', '2025-09-07 06:34:35', 1),
(376, 2, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2025-09-07 to date --08-09-2025', '127.0.0.1', 'Edit', 1, 'Super admin', '2025-09-07', '2025-09-07 06:34:44', 1),
(377, 1, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2025-09-07 to date 2025-09-08', '127.0.0.1', 'Edit', 1, 'Super admin', '2025-09-07', '2025-09-07 06:37:48', 1),
(378, 1, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2025-09-07 to date 2025-09-08', '127.0.0.1', 'Edit', 1, 'Super admin', '2025-09-07', '2025-09-07 06:39:09', 1),
(379, 1, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2025-09-07 to date 2025-09-08', '127.0.0.1', 'Edit', 1, 'Super admin', '2025-09-07', '2025-09-07 06:39:25', 1),
(380, 2, 0, 0, 'Room_tariff_document_registration', '', 'Deleted room tariff from date: 2025-09-07 to date 0000-00-00', '127.0.0.1', 'Delete', 1, 'Super admin', '2025-09-07', '2025-09-07 06:39:36', 1),
(381, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Janath', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-08', '2025-09-08 09:17:22', 1),
(382, 4, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-08', '2025-09-08 11:36:02', 1),
(383, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-08', '2025-09-08 11:37:52', 1),
(384, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-08', '2025-09-08 11:41:31', 1),
(385, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 12:04:46', 1),
(386, 2, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 12:05:20', 1),
(387, 3, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 12:12:01', 1),
(388, 4, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 12:17:18', 1),
(389, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 07:50:36', 1),
(390, 3, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 07:54:49', 1),
(391, 4, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 07:56:27', 1),
(392, 7, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 08:02:25', 1),
(393, 10, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 09:23:06', 1),
(394, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 09:28:12', 1),
(395, 2, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 09:31:29', 1),
(396, 3, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 10:05:07', 1),
(397, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 10:06:24', 1),
(398, 2, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 10:08:31', 1),
(399, 6, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 10:12:21', 1),
(400, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 10:16:13', 1),
(401, 2, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 11:03:02', 1),
(402, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-09', '2025-09-09 11:04:21', 1),
(403, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-12', '2025-09-12 08:50:43', 1),
(404, 2, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: yuyu', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-13', '2025-09-13 12:04:36', 1),
(405, 2, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: yuyu', '127.0.0.1', 'Edit', 1, 'Super admin', '2025-09-13', '2025-09-13 12:05:24', 1),
(406, 1, 0, 0, 'Itinerary_registration', '', 'Added itinerary: sfsd', '127.0.0.1', 'Add', 0, '', '2025-09-22', '2025-09-22 07:48:42', 1),
(407, 2, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2025-09-27', '2025-09-27 08:18:21', 1),
(408, 1, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: vcvc', '127.0.0.1', 'Add', 0, '', '2025-09-29', '2025-09-29 07:55:04', 1),
(409, 1, 0, 0, 'Itinerary_registration', '', 'Added itinerary: addas', '127.0.0.1', 'Add', 0, '', '2025-09-30', '2025-09-30 10:11:56', 1),
(410, 1, 0, 0, 'Lead_registration', '', 'Added leads: ssdsd', '127.0.0.1', 'Add', 1, 'Super admin', '2025-10-26', '2025-10-26 04:23:03', 1),
(411, 2, 0, 0, 'Lead_registration', '', 'Added leads: ', '127.0.0.1', 'Add', 1, 'Super admin', '2025-10-27', '2025-10-27 08:25:21', 1),
(412, 6, 0, 0, 'Room_category_registration', '', 'Added room category: Standard', '127.0.0.1', 'Add', 1, 'Super admin', '2025-12-22', '2025-12-22 02:19:31', 1),
(413, 7, 0, 0, 'Room_category_registration', '', 'Added room category: High Premium', '127.0.0.1', 'Add', 1, 'Super admin', '2025-12-22', '2025-12-22 02:22:53', 1),
(414, 8, 0, 0, 'Room_category_registration', '', 'Added room category: Classic', '127.0.0.1', 'Add', 1, 'Super admin', '2025-12-22', '2025-12-22 02:32:48', 1),
(415, 9, 0, 0, 'Room_category_registration', '', 'Added room category: Modern', '127.0.0.1', 'Add', 1, 'Super admin', '2025-12-22', '2025-12-22 02:33:25', 1),
(416, 10, 0, 0, 'Room_category_registration', '', 'Added room category: Realastic', '127.0.0.1', 'Add', 1, 'Super admin', '2025-12-22', '2025-12-22 03:25:04', 1),
(417, 2, 0, 0, 'Itinerary_registration', '', 'Added itinerary: kmam', '127.0.0.1', 'Add', 0, '', '2026-01-02', '2026-01-02 08:35:20', 1),
(418, 3, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-22', '2026-01-22 01:14:33', 1),
(419, 5, 0, 0, 'Property_category_registration', '', 'Added property category: Test name', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-24', '2026-01-24 08:19:40', 1),
(420, 5, 0, 0, 'Property_category_registration', '', 'Edited property category: Test name_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-24', '2026-01-24 08:22:42', 1),
(421, 5, 0, 0, 'Property_category_registration', '', 'Deleted property category Test name_edited', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-24', '2026-01-24 08:26:42', 1),
(422, 3, 0, 0, 'B2B_partner_registration', '', 'Added b2b partner: Nabeel', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-24', '2026-01-24 08:28:27', 1),
(423, 4, 0, 0, 'B2B_partner_registration', '', 'Added b2b partner: New agent', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 02:52:59', 1),
(424, 4, 0, 0, 'B2B_partner_registration', '', 'Edited b2b partner: New agent_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 02:57:31', 1),
(425, 32, 0, 0, 'Vehicle_registration', '', 'Added vehicle: KL-010-23', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 03:01:46', 1),
(426, 33, 0, 0, 'Vehicle_registration', '', 'Added vehicle: KL-10-202', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 03:02:02', 1),
(427, 32, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: KL-010-23_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 03:02:51', 1),
(428, 32, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: KL-010-23_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 03:05:00', 1),
(429, 33, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle KL-10-202', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-25', '2026-01-25 03:05:40', 1),
(430, 4, 0, 0, 'Transporter_registration', '', 'Added transporter: Ganfoor', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 03:12:08', 1),
(431, 4, 0, 0, 'Transporter_registration', '', 'Edited transporter: Ganfoor_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 03:15:40', 1),
(432, 4, 0, 0, 'Transporter_registration', '', 'Deleted transporter: Ganfoor_edited', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-25', '2026-01-25 03:16:05', 1),
(433, 2, 0, 0, 'Itinerary_category_registration', '', 'Added itinerary category: Nama', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 03:19:39', 1),
(434, 2, 0, 0, 'Itinerary_category_registration', '', 'Edited itinerary category: Nama_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 03:20:25', 1),
(435, 0, 0, 0, 'Itinerary_category_registration', '', 'Deleted itinerary category Nama_edited', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-25', '2026-01-25 03:21:36', 1),
(436, 2, 0, 0, 'Package_category_registration', '', 'Added package category: JAm', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 03:23:34', 1),
(437, 1, 0, 0, 'Package_category_registration', '', 'Deleted package category gghjjjk', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-25', '2026-01-25 03:24:11', 1),
(438, 2, 0, 0, 'Package_category_registration', '', 'Edited package category: JAm_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 03:24:43', 1),
(439, 2, 0, 0, 'Special_requirements_registration', '', 'Added special requirement: hana', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 03:27:20', 1),
(440, 2, 0, 0, 'Special_requirements_registration', '', 'Edited special requirement: hana_edites', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 03:28:28', 1),
(441, 2, 0, 0, 'Special_requirements_registration', '', 'Deleted special requirement hana_edites', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-25', '2026-01-25 03:28:56', 1),
(442, 3, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: a', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 03:45:18', 1),
(443, 4, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: Test onr', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 04:02:36', 1),
(444, 4, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: Test onr', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 04:39:43', 1),
(445, 4, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: Test onr', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 04:39:58', 1),
(446, 4, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: Test onr_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 04:41:52', 1),
(447, 4, 0, 0, 'Payment_policies_registration', '', 'Edited payment policies: Test onr_edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 04:42:08', 1),
(448, 4, 0, 0, 'Payment_policies_registration', '', 'Deleted payment policies: Test onr_edited', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-25', '2026-01-25 04:42:28', 1),
(449, 2, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: jaj', '127.0.0.1', 'Add', 0, '', '2026-01-25', '2026-01-25 04:44:21', 1),
(450, 3, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: Jka', '127.0.0.1', 'Add', 0, '', '2026-01-25', '2026-01-25 04:44:41', 1),
(451, 3, 0, 0, 'Terms_condition_registration', '', 'Edited terms and conditions: Jka', '127.0.0.1', 'Edit', 0, '', '2026-01-25', '2026-01-25 04:45:47', 1),
(452, 3, 0, 0, 'Terms_condition_registration', '', 'Edited terms and conditions: Jka', '127.0.0.1', 'Edit', 0, '', '2026-01-25', '2026-01-25 04:46:01', 1),
(453, 3, 0, 0, 'Terms_condition_registration', '', 'Deleted terms and conditions: Jka', '127.0.0.1', 'Delete', 0, '', '2026-01-25', '2026-01-25 04:46:30', 1),
(454, 2, 0, 0, 'Cancellation_policies_registration', '', 'Added cancellation and policies: nana', '127.0.0.1', 'Add', 0, '', '2026-01-25', '2026-01-25 04:47:44', 1),
(455, 1, 0, 0, 'Cancellation_policies_registration', '', 'Edited cancellation and policies: hffh_edir', '127.0.0.1', 'Edit', 0, '', '2026-01-25', '2026-01-25 04:48:23', 1),
(456, 1, 0, 0, 'Cancellation_policies_registration', '', 'Edited cancellation and policies: hffh_edir', '127.0.0.1', 'Edit', 0, '', '2026-01-25', '2026-01-25 04:48:34', 1),
(457, 2, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: Gajd', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 04:52:04', 1),
(458, 5, 0, 0, 'Property_registration', '', 'Added property: Test propery', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 06:18:33', 1),
(459, 5, 0, 0, 'Property_registration', '', 'Edited property: Test propery_Edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 06:21:01', 1),
(460, 5, 0, 0, 'Property_registration', '', 'Edited property: Test propery_Edited', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-01-25', '2026-01-25 06:21:16', 1),
(461, 11, 0, 0, 'Room_category_registration', '', 'Added room category: Test room', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 06:53:16', 1),
(462, 4, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-01-25 to date 2026-01-31', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-25', '2026-01-25 06:54:23', 1),
(463, 4, 0, 0, 'Room_tariff_document_registration', '', 'Deleted room tariff from date: 2026-01-25 to date 2026-01-31', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-25', '2026-01-25 06:56:11', 1),
(464, 11, 0, 0, 'Room_category_registration', '', 'Deleted room category: Test room', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-01-25', '2026-01-25 07:00:02', 1),
(465, 3, 0, 0, 'Lead_registration', '', 'Added leads: nsan', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-28', '2026-01-28 04:33:29', 1),
(466, 4, 0, 0, 'Lead_registration', '', 'Added leads: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-28', '2026-01-28 04:33:52', 1),
(467, 5, 0, 0, 'Lead_registration', '', 'Added leads: dn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-28', '2026-01-28 04:36:09', 1),
(468, 1, 0, 0, 'Lead_registration', '', 'Added leads: Santhosh', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-28', '2026-01-28 08:07:00', 1),
(469, 2, 0, 0, 'Lead_registration', '', 'Added leads: jkk', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-29', '2026-01-29 12:24:24', 1),
(470, 1, 0, 0, 'Lead_registration', '', 'Added leads: Jaffar', '127.0.0.1', 'Add', 1, 'Super admin', '2026-01-29', '2026-01-29 12:35:16', 1),
(471, 1, 0, 0, 'Lead_registration', '', 'Added leads: Jafzr', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-01', '2026-02-01 03:15:00', 1),
(472, 1, 0, 0, 'Itinerary_registration', '', 'Added itinerary: New one', '127.0.0.1', 'Add', 0, '', '2026-02-01', '2026-02-01 03:46:50', 1),
(473, 1, 0, 0, 'Lead_registration', '', 'Added leads: Jmamma', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-01', '2026-02-01 03:51:56', 1),
(474, 1, 0, 0, 'Lead_registration', '', 'Added leads: Hmeed', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-03', '2026-02-03 07:05:34', 1),
(475, 1, 0, 0, 'Lead_registration', '', 'Added leads: Kamal', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-04', '2026-02-04 02:23:54', 1),
(476, 1, 0, 0, 'Lead_registration', '', 'Added leads: jameer', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-05', '2026-02-05 12:11:40', 1),
(477, 2, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 2 days ititmmmm', '127.0.0.1', 'Add', 0, '', '2026-02-05', '2026-02-05 11:13:29', 1),
(478, 3, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 1 durartion', '127.0.0.1', 'Add', 0, '', '2026-02-05', '2026-02-05 11:19:21', 1),
(479, 4, 0, 0, 'Itinerary_registration', '', 'Added itinerary: dssd', '127.0.0.1', 'Add', 0, '', '2026-02-05', '2026-02-05 11:37:32', 1),
(480, 5, 0, 0, 'Itinerary_registration', '', 'Added itinerary: Kerala 4 days - 5 nights', '2.51.246.86', 'Add', 0, '', '2026-02-06', '2026-02-06 09:06:06', 1),
(481, 6, 0, 0, 'Property_registration', '', 'Added property: Mithra', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-06', '2026-02-06 09:18:18', 1),
(482, 12, 0, 0, 'Room_category_registration', '', 'Added room category: Deluxe', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-06', '2026-02-06 09:20:54', 1),
(483, 13, 0, 0, 'Room_category_registration', '', 'Added room category: Classic', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-06', '2026-02-06 09:21:57', 1),
(484, 4, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Mithra', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-06', '2026-02-06 09:29:40', 1),
(485, 2, 0, 0, 'Lead_registration', '', 'Added leads: Jabeer', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-06', '2026-02-06 09:38:25', 1),
(486, 13, 0, 0, 'Room_category_registration', '', 'Deleted room category: Classic', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:06', 1),
(487, 12, 0, 0, 'Room_category_registration', '', 'Deleted room category: Deluxe', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:10', 1),
(488, 10, 0, 0, 'Room_category_registration', '', 'Deleted room category: Realastic', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:15', 1),
(489, 9, 0, 0, 'Room_category_registration', '', 'Deleted room category: Modern', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:19', 1),
(490, 8, 0, 0, 'Room_category_registration', '', 'Deleted room category: Classic', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:23', 1),
(491, 7, 0, 0, 'Room_category_registration', '', 'Deleted room category: High Premium', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:28', 1),
(492, 6, 0, 0, 'Room_category_registration', '', 'Deleted room category: Standard', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:32', 1),
(493, 4, 0, 0, 'Room_category_registration', '', 'Deleted room category: Large room', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:36', 1),
(494, 3, 0, 0, 'Room_category_registration', '', 'Deleted room category: Jaguar room deluxe', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:41', 1),
(495, 2, 0, 0, 'Room_category_registration', '', 'Deleted room category: Standard room', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:46', 1),
(496, 1, 0, 0, 'Room_category_registration', '', 'Deleted room category: Deluxe premium', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:24:50', 1),
(497, 1, 0, 0, 'Property_category_registration', '', 'Deleted property category 5 star', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:25:31', 1),
(498, 2, 0, 0, 'Property_category_registration', '', 'Deleted property category 3 star dxffd', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:25:34', 1),
(499, 6, 0, 0, 'Property_category_registration', '', 'Added property category: TREE HOUSE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:25:54', 1),
(500, 7, 0, 0, 'Property_category_registration', '', 'Added property category: 3 STAR', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:26:04', 1),
(501, 8, 0, 0, 'Property_category_registration', '', 'Added property category: DELUXE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:26:18', 1),
(502, 9, 0, 0, 'Property_category_registration', '', 'Added property category: PREMIUM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:26:25', 1),
(503, 10, 0, 0, 'Property_category_registration', '', 'Added property category: 4 STAR', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:26:31', 1),
(504, 11, 0, 0, 'Property_category_registration', '', 'Added property category: 5 STAR', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:26:41', 1),
(505, 12, 0, 0, 'Property_category_registration', '', 'Added property category: BUDGETED', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:26:48', 1),
(506, 4, 0, 0, 'B2B_partner_registration', '', 'Deleted b2b partner: New agent_edited', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:27:07', 1),
(507, 32, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle KL-010-23_edited', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:24', 1),
(508, 25, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle 3w', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:27', 1),
(509, 22, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gfgfdgdfgf0', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:30', 1),
(510, 21, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle sdf', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:32', 1),
(511, 19, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fgf', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:35', 1),
(512, 18, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fsfsdffd', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:38', 1),
(513, 17, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle saasdfdf', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:40', 1),
(514, 16, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hfhg', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:42', 1),
(515, 15, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle mbbnhghgfh', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:44', 1),
(516, 14, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fhfh', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:46', 1),
(517, 13, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle eet', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:48', 1),
(518, 11, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle tyt', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:51', 1),
(519, 10, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle fdf', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:53', 1),
(520, 9, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle qwfdf', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:57', 1),
(521, 8, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle hghgh', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:37:59', 1),
(522, 7, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gdd', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:38:01', 1),
(523, 5, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle kk', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:38:04', 1),
(524, 4, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle gffgnn', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:38:06', 1),
(525, 2, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle mmn', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:38:08', 1),
(526, 1, 0, 0, 'Vehicle_registration', '', 'Deleted vehicle Ertiga', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 11:38:10', 1),
(527, 34, 0, 0, 'Vehicle_registration', '', 'Added vehicle: SEDAN', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:38:31', 1),
(528, 34, 0, 0, 'Vehicle_registration', '', 'Edited vehicle: AC SEDAN', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 11:38:57', 1),
(529, 35, 0, 0, 'Vehicle_registration', '', 'Added vehicle: AC ERTIGA', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:39:39', 1),
(530, 36, 0, 0, 'Vehicle_registration', '', 'Added vehicle: AC INNOVA', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:39:53', 1),
(531, 37, 0, 0, 'Vehicle_registration', '', 'Added vehicle: AC 12 SEATER TEMPO', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:40:17', 1),
(532, 38, 0, 0, 'Vehicle_registration', '', 'Added vehicle: AC 17 SEATER TEMPO', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:43:46', 1),
(533, 39, 0, 0, 'Vehicle_registration', '', 'Added vehicle: AC 26 SEATER TEMPO', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 11:44:18', 1),
(534, 0, 0, 0, 'Itinerary_category_registration', '', 'Deleted itinerary category Nama_edited', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 12:17:18', 1),
(535, 0, 0, 0, 'Itinerary_category_registration', '', 'Deleted itinerary category gghj', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 12:17:24', 1),
(536, 0, 0, 0, 'Itinerary_category_registration', '', 'Deleted itinerary category Nama_edited', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 12:17:41', 1),
(537, 0, 0, 0, 'Itinerary_category_registration', '', 'Deleted itinerary category gghj', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 12:17:47', 1),
(538, 0, 0, 0, 'Itinerary_category_registration', '', 'Deleted itinerary category Nama_edited', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 12:18:06', 1),
(539, 3, 0, 0, 'Itinerary_category_registration', '', 'Added itinerary category: HONEYMOON', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 12:18:42', 1),
(540, 7, 0, 0, 'Property_registration', '', 'Added property: SPICE JUNGLE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 12:24:50', 1),
(541, 14, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 12:30:45', 1),
(542, 15, 0, 0, 'Room_category_registration', '', 'Added room category: SUPER DELUXE ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 12:35:25', 1),
(543, 5, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SPICE JUNGLE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 12:41:20', 1),
(544, 8, 0, 0, 'Property_registration', '', 'Added property: SANDRA', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 12:53:49', 1),
(545, 16, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 12:54:25', 1),
(546, 6, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SANDRA', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 01:01:32', 1),
(547, 6, 0, 0, 'Property_registration', '', 'Deleted property: Mithra', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:00:24', 1),
(548, 5, 0, 0, 'Property_registration', '', 'Deleted property: Test propery_Edited', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:00:59', 1),
(549, 3, 0, 0, 'Property_registration', '', 'Deleted property: sds', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:01:06', 1),
(550, 4, 0, 0, 'Property_registration', '', 'Deleted property: Trret', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:01:15', 1),
(551, 14, 0, 0, 'Room_category_registration', '', 'Edited room category: DELUXE ROOM', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 05:07:00', 1),
(552, 4, 0, 0, 'Destination_registration', '', 'Deleted Destination: KARNATAKA', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:11:17', 1),
(553, 1, 0, 0, 'Destination_registration', '', 'Deleted Destination: KERALA', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:11:20', 1),
(554, 5, 0, 0, 'Destination_registration', '', 'Added Destination: MUNNAR', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:11:28', 1),
(555, 6, 0, 0, 'Destination_registration', '', 'Added Destination: THEKKADY', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:11:33', 1),
(556, 7, 0, 0, 'Destination_registration', '', 'Added Destination: ALAPPEY', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:11:38', 1),
(557, 8, 0, 0, 'Destination_registration', '', 'Added Destination: VARKALA', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:11:44', 1),
(558, 9, 0, 0, 'Destination_registration', '', 'Added Destination: TRIVANDRUM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:11:48', 1),
(559, 10, 0, 0, 'Destination_registration', '', 'Added Destination: KOVALAM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:11:55', 1),
(560, 11, 0, 0, 'Destination_registration', '', 'Added Destination: ATHIRAPPILLY', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:12:00', 1),
(561, 12, 0, 0, 'Destination_registration', '', 'Added Destination: VAGAMON', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:12:11', 1),
(562, 13, 0, 0, 'Destination_registration', '', 'Added Destination: WAYANADU', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:12:16', 1),
(563, 14, 0, 0, 'Destination_registration', '', 'Added Destination: GURUVAYOOR', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:12:23', 1),
(564, 15, 0, 0, 'Destination_registration', '', 'Added Destination: MUNROE ISLAND', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:12:32', 1),
(565, 16, 0, 0, 'Destination_registration', '', 'Added Destination: VATTAVADA', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:12:39', 1),
(566, 17, 0, 0, 'Destination_registration', '', 'Added Destination: SURYANELLI', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:12:50', 1),
(567, 18, 0, 0, 'Destination_registration', '', 'Added Destination: KANTHALLOOR', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:12:57', 1),
(568, 19, 0, 0, 'Destination_registration', '', 'Added Destination: KUMARAKOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:13:01', 1),
(569, 7, 0, 0, 'Property_registration', '', 'Edited property: SPICE JUNGLE', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 05:13:43', 1),
(570, 17, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:14:58', 1),
(571, 16, 0, 0, 'Room_category_registration', '', 'Edited room category: SUPER DELUXE ROOM', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 05:15:27', 1),
(572, 5, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-01 to date 2026-02-28', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 05:16:04', 1),
(573, 16, 0, 0, 'Room_category_registration', '', 'Edited room category: SUPER DELUXE ROOM', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 05:18:47', 1),
(574, 1, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:33:17', 1),
(575, 2, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:33:23', 1),
(576, 3, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:33:28', 1),
(577, 4, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:33:33', 1),
(578, 14, 0, 0, 'Room_category_registration', '', 'Edited room category: DELUXE ROOM', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 05:36:49', 1),
(579, 17, 0, 0, 'Room_category_registration', '', 'Deleted room category: DELUXE ROOM', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:42:43', 1),
(580, 16, 0, 0, 'Room_category_registration', '', 'Deleted room category: SUPER DELUXE ROOM', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:42:49', 1),
(581, 8, 0, 0, 'Property_registration', '', 'Deleted property: SANDRA', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 05:43:03', 1),
(582, 7, 0, 0, 'Property_registration', '', 'Edited property: SPICE JUNGLE', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 05:43:13', 1),
(583, 14, 0, 0, 'Room_category_registration', '', 'Edited room category: DELUXE ROOM', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 05:49:46', 1),
(584, 8, 0, 0, 'Property_registration', '', 'Deleted property: SANDRA', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 07:31:34', 1),
(585, 6, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-01 to date 2026-02-28', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 07:32:27', 1),
(586, 6, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 07:34:53', 1),
(587, 3, 0, 0, 'Lead_registration', '', 'Added leads: ASAD', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 10:17:33', 1),
(588, 15, 0, 0, 'Room_category_registration', '', 'Edited room category: SUPER DELUXE ROOM', '2.51.246.86', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:31:19', 1),
(589, 6, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 2 N - 3 Days Kerala', '2.51.246.86', 'Add', 0, '', '2026-02-08', '2026-02-08 03:19:32', 1),
(590, 9, 0, 0, 'Property_registration', '', 'Added property: View munnar', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 03:40:51', 1),
(591, 18, 0, 0, 'Room_category_registration', '', 'Added room category: Delux', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 03:42:49', 1),
(592, 7, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: View munnar', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 04:01:10', 1),
(593, 8, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: View munnar', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 04:03:03', 1),
(594, 4, 0, 0, 'Lead_registration', '', 'Added leads: Sameer', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 04:11:42', 1),
(595, 5, 0, 0, 'Lead_registration', '', 'Added leads: Gafoor', '2.51.246.86', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 04:13:15', 1),
(596, 7, 0, 0, 'Staff_registration', '', 'Added staff: NISHA', '103.203.73.117', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 01:28:56', 1),
(597, 10, 0, 0, 'Property_registration', '', 'Added property: VELVET VISTA', '103.203.73.117', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 01:31:35', 1),
(598, 5, 0, 0, 'Transporter_registration', '', 'Added transporter: ANAS', '103.203.73.117', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 01:33:51', 1),
(599, 6, 0, 0, 'Lead_registration', '', 'Added leads: YASH', '103.203.73.117', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 01:35:18', 1),
(600, 3, 0, 0, 'Staff_registration', '', 'Deleted staff Monisha Pramod', '86.97.196.130', 'Delete', 1, 'Super admin', '2026-02-16', '2026-02-16 07:01:24', 1),
(601, 11, 0, 0, 'Property_registration', '', 'Added property: NAVNEETHAM VILLA STAY', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 06:50:56', 1),
(602, 12, 0, 0, 'Property_registration', '', 'Added property: WHITE FORT ', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 07:05:59', 1),
(603, 13, 0, 0, 'Property_registration', '', 'Added property: deluxe houseboat', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 07:06:56', 1),
(604, 40, 0, 0, 'Vehicle_registration', '', 'Added vehicle: AC TEMPO TRAVELLER', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 07:07:41', 1),
(605, 20, 0, 0, 'Destination_registration', '', 'Added Destination: COCHIN', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 07:20:36', 1),
(606, 3, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: FOR KERALA - CP PLAN', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 07:25:53', 1),
(607, 5, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: KERALA - PP - 30%', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 07:26:21', 1),
(608, 4, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: KERALA - PC', '178.248.116.184', 'Add', 0, '', '2026-02-17', '2026-02-17 07:26:54', 1),
(609, 3, 0, 0, 'Cancellation_policies_registration', '', 'Added cancellation and policies: KERALA - CP', '178.248.116.184', 'Add', 0, '', '2026-02-17', '2026-02-17 07:27:14', 1),
(610, 3, 0, 0, 'Special_requirements_registration', '', 'Added special requirement: MALARICKAL EXCURSION', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 07:27:59', 1),
(611, 7, 0, 0, 'Lead_registration', '', 'Added leads: gsg', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 07:39:44', 1),
(612, 13, 0, 0, 'Property_registration', '', 'Edited property: deluxe houseboat', '92.99.155.94', 'Edit', 1, 'Super admin', '2026-02-17', '2026-02-17 09:21:51', 1),
(613, 14, 0, 0, 'Property_registration', '', 'Added property: test', '83.111.121.136', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 10:59:15', 1),
(614, 14, 0, 0, 'Property_registration', '', 'Deleted property: test', '83.111.121.136', 'Delete', 1, 'Super admin', '2026-02-18', '2026-02-18 10:59:53', 1),
(615, 8, 0, 0, 'Staff_registration', '', 'Added staff: REEHAL', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 11:07:05', 1),
(616, 9, 0, 0, 'Staff_registration', '', 'Added staff: SETHU', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 11:07:49', 1),
(617, 10, 0, 0, 'Staff_registration', '', 'Added staff: SANI', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 11:08:21', 1),
(618, 15, 0, 0, 'Property_registration', '', 'Added property: QUALITY INN', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 11:30:22', 1),
(619, 16, 0, 0, 'Property_registration', '', 'Added property: Test', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:11:45', 1),
(620, 19, 0, 0, 'Room_category_registration', '', 'Added room category: Test', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:22:11', 1),
(621, 20, 0, 0, 'Room_category_registration', '', 'Added room category: Test 2', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:23:32', 1),
(622, 21, 0, 0, 'Room_category_registration', '', 'Added room category: Test 3', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:24:10', 1),
(623, 7, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-18 to date 2026-02-27', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:25:45', 1),
(624, 8, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-01 to date 2026-02-06', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:27:40', 1),
(625, 9, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Test', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:31:56', 1),
(626, 10, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Test', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:34:08', 1),
(627, 17, 0, 0, 'Property_registration', '', 'Added property: Test', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 05:50:09', 1),
(628, 18, 0, 0, 'Property_registration', '', 'Added property: nuu', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 06:27:15', 1),
(629, 19, 0, 0, 'Property_registration', '', 'Added property: jdjjd', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 06:53:26', 1),
(630, 18, 0, 0, 'Property_registration', '', 'Edited property: nuu', '92.99.155.94', 'Edit', 1, 'Super admin', '2026-02-18', '2026-02-18 09:22:21', 1),
(631, 9, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-11 to date 2026-02-18', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 12:06:06', 1),
(632, 9, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-11 to date 2026-02-18', '92.99.155.94', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 12:06:26', 1),
(633, 9, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-11 to date 2026-02-18', '92.99.155.94', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 12:10:16', 1),
(634, 9, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-11 to date 2026-02-18', '92.99.155.94', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 12:10:34', 1),
(635, 10, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-04 to date 2026-02-27', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 12:13:23', 1),
(636, 11, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-11 to date 2026-02-27', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 12:20:55', 1),
(637, 12, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-18 to date 2026-02-27', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 12:24:04', 1),
(638, 13, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-18 to date 2026-02-26', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 12:26:03', 1),
(639, 14, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-18 to date 2026-02-18', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 12:40:07', 1),
(640, 15, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-18 to date 2026-02-27', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 12:50:23', 1),
(641, 15, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-18 to date 2026-02-27', '92.99.155.94', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 12:51:39', 1),
(642, 16, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-20 to date 2026-02-27', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 12:54:08', 1),
(643, 16, 0, 0, 'Room_tariff_document_registration', '', 'Deleted room tariff from date: 2026-02-20 to date 2026-02-27', '92.99.155.94', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 12:54:28', 1),
(644, 19, 0, 0, 'Property_registration', '', 'Deleted property: jdjjd', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:08', 1),
(645, 18, 0, 0, 'Property_registration', '', 'Deleted property: nuu', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:14', 1),
(646, 17, 0, 0, 'Property_registration', '', 'Deleted property: Test', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:19', 1),
(647, 16, 0, 0, 'Property_registration', '', 'Deleted property: Test', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:24', 1),
(648, 15, 0, 0, 'Property_registration', '', 'Deleted property: QUALITY INN', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:30', 1),
(649, 13, 0, 0, 'Property_registration', '', 'Deleted property: deluxe houseboat', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:34', 1),
(650, 12, 0, 0, 'Property_registration', '', 'Deleted property: WHITE FORT ', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:39', 1),
(651, 11, 0, 0, 'Property_registration', '', 'Deleted property: NAVNEETHAM VILLA STAY', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:44', 1),
(652, 10, 0, 0, 'Property_registration', '', 'Deleted property: VELVET VISTA', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:49', 1),
(653, 9, 0, 0, 'Property_registration', '', 'Deleted property: View munnar', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:53', 1),
(654, 7, 0, 0, 'Property_registration', '', 'Deleted property: SPICE JUNGLE', '178.248.116.184', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 06:28:58', 1),
(655, 20, 0, 0, 'Property_registration', '', 'Added property: VELVET VISTA', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 06:35:38', 1),
(656, 22, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 06:38:02', 1);
INSERT INTO `activity` (`activity_id`, `id_fk`, `activity_staff_id_fk`, `activity_company_id_fk`, `activity_type`, `activity_order_number`, `activity_description`, `activity_ip`, `activity_action`, `activity_by_userid`, `activity_by_username`, `activity_date`, `activity_date_time`, `activity_status`) VALUES
(657, 11, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: VELVET VISTA', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 06:40:26', 1),
(658, 13, 0, 0, 'Property_category_registration', '', 'Added property category: 3 STAR PREMIUM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 06:43:38', 1),
(659, 21, 0, 0, 'Property_registration', '', 'Added property: THE ARBOUR RESORT', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 06:49:57', 1),
(660, 23, 0, 0, 'Room_category_registration', '', 'Added room category: CLUB ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 06:55:05', 1),
(661, 24, 0, 0, 'Room_category_registration', '', 'Added room category: CLUB ROOM AC', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:00:30', 1),
(662, 25, 0, 0, 'Room_category_registration', '', 'Added room category: CLUB WITH VALLEY VIEW AC', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:04:12', 1),
(663, 26, 0, 0, 'Room_category_registration', '', 'Added room category: GARDEN COTTAGE AC', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:06:46', 1),
(664, 27, 0, 0, 'Room_category_registration', '', 'Added room category: JACUZZI SUIT AC', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:08:30', 1),
(665, 17, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-01 to date 2026-02-28', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:09:52', 1),
(666, 12, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: THE ARBOUR RESORT', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:13:16', 1),
(667, 14, 0, 0, 'Property_category_registration', '', 'Added property category: DELUXE COTTAGE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:16:33', 1),
(668, 22, 0, 0, 'Property_registration', '', 'Added property: DESHADAN CLIFF & BEACH RESORT', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:21:43', 1),
(669, 28, 0, 0, 'Room_category_registration', '', 'Added room category: POOL SIDE ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:25:36', 1),
(670, 13, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN CLIFF & BEACH RESORT', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:29:46', 1),
(671, 23, 0, 0, 'Property_registration', '', 'Added property: NAVANEETHAM VILLA STAY', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:39:05', 1),
(672, 29, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE DOUBLE ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:42:44', 1),
(673, 14, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: NAVANEETHAM VILLA STAY', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:43:43', 1),
(674, 15, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: NAVANEETHAM VILLA STAY', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:44:12', 1),
(675, 16, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: NAVANEETHAM VILLA STAY', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:44:31', 1),
(676, 21, 0, 0, 'Destination_registration', '', 'Added Destination: TRIVANDRUM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:13:35', 1),
(677, 24, 0, 0, 'Property_registration', '', 'Added property: ANANTHAPURAM RESIDENCY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:19:33', 1),
(678, 30, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM NON AC', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:20:59', 1),
(679, 31, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM AC', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:21:15', 1),
(680, 18, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: --01-02-2026 to date --30-09-2026', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:21:42', 1),
(681, 19, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: --01-02-2026 to date --30-09-2026', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:21:45', 1),
(682, 20, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: --01-02-2026 to date --30-09-2026', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:21:55', 1),
(683, 21, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: --01-02-2026 to date --30-09-2026', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:23:10', 1),
(684, 20, 0, 0, 'Room_tariff_document_registration', '', 'Deleted room tariff from date: 0000-00-00 to date 0000-00-00', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 10:23:30', 1),
(685, 31, 0, 0, 'Room_category_registration', '', 'Edited room category: DELUXE ROOM AC', '103.203.73.51', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 10:25:13', 1),
(686, 30, 0, 0, 'Room_category_registration', '', 'Edited room category: DELUXE ROOM NON AC', '103.203.73.51', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 10:25:20', 1),
(687, 17, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: ANANTHAPURAM RESIDENCY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:26:35', 1),
(688, 9, 0, 0, 'Destination_registration', '', 'Deleted Destination: TRIVANDRUM', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 10:27:08', 1),
(689, 21, 0, 0, 'Property_registration', '', 'Edited property: THE ARBOUR RESORT', '103.203.73.51', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 10:36:01', 1),
(690, 25, 0, 0, 'Property_registration', '', 'Added property: ', '83.111.121.136', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:47:05', 1),
(691, 18, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN CLIFF & BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:03:52', 1),
(692, 19, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN CLIFF & BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:04:18', 1),
(693, 20, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN CLIFF & BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:05:07', 1),
(694, 21, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN CLIFF & BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:06:14', 1),
(695, 22, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN CLIFF & BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:08:01', 1),
(696, 26, 0, 0, 'Property_registration', '', 'Added property: DESHADAN MOUNTAIN RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:16:39', 1),
(697, 32, 0, 0, 'Room_category_registration', '', 'Added room category: MOUNTAIN VIEW ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:18:03', 1),
(698, 33, 0, 0, 'Room_category_registration', '', 'Added room category: SUPERIOR MOUNTAIN VIEW ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:18:34', 1),
(699, 22, 0, 0, 'Property_registration', '', 'Edited property: DESHADAN CLIFF & BEACH RESORT', '83.111.121.136', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 11:20:12', 1),
(700, 20, 0, 0, 'Property_registration', '', 'Edited property: VELVET VISTA', '83.111.121.136', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 11:20:30', 1),
(701, 34, 0, 0, 'Room_category_registration', '', 'Added room category: STANDARD FAMILY COTTAGE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:27:53', 1),
(702, 35, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE COTTAGE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:29:01', 1),
(703, 22, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-01-06 to date 2026-03-31', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:29:48', 1),
(704, 23, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-04-01 to date 2027-03-31', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:30:40', 1),
(705, 22, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-04-01 to date 2026-03-31', '103.203.73.51', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 11:31:16', 1),
(706, 23, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN MOUNTAIN RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:33:40', 1),
(707, 21, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-01 to date 2026-02-19', '83.111.121.136', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 11:34:39', 1),
(708, 24, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN MOUNTAIN RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:36:49', 1),
(709, 25, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN MOUNTAIN RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:37:55', 1),
(710, 26, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN MOUNTAIN RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:39:58', 1),
(711, 27, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN MOUNTAIN RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:42:12', 1),
(712, 27, 0, 0, 'Property_registration', '', 'Added property: MUNNAR VALLEY NEST STAY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:48:15', 1),
(713, 27, 0, 0, 'Property_registration', '', 'Edited property: MUNNAR VALLEY NEST STAY', '103.203.73.51', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 11:51:53', 1),
(714, 3, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 04:29:33', 1),
(715, 4, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 04:29:55', 1),
(716, 5, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 04:30:17', 1),
(717, 8, 0, 0, 'Lead_registration', '', 'Added leads: Fajhad', '92.99.155.94', 'Add', 1, 'Super admin', '2026-02-20', '2026-02-20 05:02:15', 1),
(718, 28, 0, 0, 'Property_registration', '', 'Added property: JASMIN PALACE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 04:05:57', 1),
(719, 36, 0, 0, 'Room_category_registration', '', 'Added room category: JASMINE AC DELUXE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:04:30', 1),
(720, 37, 0, 0, 'Room_category_registration', '', 'Added room category: JASMINE AC SUPERIOR', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:04:48', 1),
(721, 28, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: JASMIN PALACE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:07:38', 1),
(722, 29, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: JASMIN PALACE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:08:41', 1),
(723, 6, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:09:48', 1),
(724, 7, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:10:07', 1),
(725, 8, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:10:17', 1),
(726, 9, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER, FLOWER BED DECORATION, HONEYMOON CAKE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:10:41', 1),
(727, 9, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: CANDLE LIGHT DINNER, FLOWER BED DECORATION, HONEYMOON CAKE', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-22', '2026-02-22 05:10:55', 1),
(728, 10, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: GALA DINNER - 31st DEC NIGHT (PER ADULT)', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:11:51', 1),
(729, 11, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: GALA DINNER - 31st DEC NIGHT (PER CHILD)', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:12:02', 1),
(730, 24, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-01 to date 2026-03-04', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:20:05', 1),
(731, 29, 0, 0, 'Property_registration', '', 'Added property: SWAGATH HOLIDAYS', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:36:48', 1),
(732, 38, 0, 0, 'Room_category_registration', '', 'Added room category: PAWN BASE DOUBLE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:43:25', 1),
(733, 39, 0, 0, 'Room_category_registration', '', 'Added room category: PAWN STANDARD DOUBLE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:47:05', 1),
(734, 38, 0, 0, 'Room_category_registration', '', 'Edited room category: PAWN BASE DOUBLE', '178.248.116.184', 'Edit', 1, 'Super admin', '2026-02-22', '2026-02-22 05:47:11', 1),
(735, 40, 0, 0, 'Room_category_registration', '', 'Added room category: PAWN DELUXE DOUBLE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:47:40', 1),
(736, 41, 0, 0, 'Room_category_registration', '', 'Added room category: PAWN EXECUTIVE DOUBLE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:47:58', 1),
(737, 30, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SWAGATH HOLIDAYS', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:51:21', 1),
(738, 12, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION, CAKE, FRUIT BASKET', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:52:36', 1),
(739, 13, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:52:46', 1),
(740, 14, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:52:57', 1),
(741, 15, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:53:08', 1),
(742, 16, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:53:23', 1),
(743, 30, 0, 0, 'Property_registration', '', 'Added property: OPALO KAILAS', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 05:58:36', 1),
(744, 42, 0, 0, 'Room_category_registration', '', 'Added room category: STANDARD DELUXE ROOM', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:03:30', 1),
(745, 31, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: OPALO KAILAS', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:06:16', 1),
(746, 25, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-01 to date 2026-01-27', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:06:39', 1),
(747, 31, 0, 0, 'Property_registration', '', 'Added property: BLACK BEACH RESORT', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:31:12', 1),
(748, 43, 0, 0, 'Room_category_registration', '', 'Added room category: STANDARD NON AC', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:31:54', 1),
(749, 44, 0, 0, 'Room_category_registration', '', 'Added room category: STANDARD AC', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:32:10', 1),
(750, 45, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM AC', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:32:24', 1),
(751, 46, 0, 0, 'Room_category_registration', '', 'Added room category: SEA VIEW COTTAGE', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:32:45', 1),
(752, 47, 0, 0, 'Room_category_registration', '', 'Added room category: SEA VIEW SUIT', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:33:00', 1),
(753, 48, 0, 0, 'Room_category_registration', '', 'Added room category: FAMILY SUIT', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:33:23', 1),
(754, 49, 0, 0, 'Room_category_registration', '', 'Added room category: PREMIUM SEA VIEW', '178.248.116.184', 'Add', 1, 'Super admin', '2026-02-22', '2026-02-22 06:33:42', 1),
(755, 32, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SWAGATH HOLIDAYS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 03:59:48', 1),
(756, 33, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SWAGATH HOLIDAYS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:01:00', 1),
(757, 34, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SWAGATH HOLIDAYS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:02:20', 1),
(758, 35, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SWAGATH HOLIDAYS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:04:26', 1),
(759, 36, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SWAGATH HOLIDAYS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:06:24', 1),
(760, 37, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SWAGATH HOLIDAYS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:12:04', 1),
(761, 38, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: OPALO KAILAS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:18:13', 1),
(762, 39, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: OPALO KAILAS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:19:07', 1),
(763, 40, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: OPALO KAILAS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:20:12', 1),
(764, 41, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: OPALO KAILAS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:20:47', 1),
(765, 32, 0, 0, 'Property_registration', '', 'Added property: TRIVERS MUNNAR', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 04:25:29', 1),
(766, 50, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE A/C', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:13:58', 1),
(767, 51, 0, 0, 'Room_category_registration', '', 'Added room category: PREMIUM A/C', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:14:33', 1),
(768, 52, 0, 0, 'Room_category_registration', '', 'Added room category: PREMIUM SUIT A/C', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:14:55', 1),
(769, 53, 0, 0, 'Room_category_registration', '', 'Added room category: ATTIC PREMIUM A/C', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:15:58', 1),
(770, 54, 0, 0, 'Room_category_registration', '', 'Added room category: ATTIC SUITES A/C', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:16:21', 1),
(771, 42, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: TRIVERS MUNNAR', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:22:18', 1),
(772, 43, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: TRIVERS MUNNAR', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:24:28', 1),
(773, 44, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: TRIVERS MUNNAR', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:25:19', 1),
(774, 17, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:25:54', 1),
(775, 18, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:26:08', 1),
(776, 19, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:26:23', 1),
(777, 20, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET & BADAM MILK', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:26:42', 1),
(778, 21, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: WINE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:26:52', 1),
(779, 26, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-01 to date 2026-09-30', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:27:27', 1),
(780, 33, 0, 0, 'Property_registration', '', 'Added property: WEST BAY MARISOL', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-24', '2026-02-24 05:32:16', 1),
(781, 34, 0, 0, 'Property_registration', '', 'Added property: WHITE FORT ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:06:16', 1),
(782, 55, 0, 0, 'Room_category_registration', '', 'Added room category: DOUBLE ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:06:48', 1),
(783, 56, 0, 0, 'Room_category_registration', '', 'Added room category: TRIPLE SHARING ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:07:08', 1),
(784, 57, 0, 0, 'Room_category_registration', '', 'Added room category: QUAD ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:07:31', 1),
(785, 45, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: WHITE FORT ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:08:44', 1),
(786, 46, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: WHITE FORT ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:09:08', 1),
(787, 22, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CAMP FIRE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:10:04', 1),
(788, 58, 0, 0, 'Room_category_registration', '', 'Added room category: STANDARD ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:17:05', 1),
(789, 59, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:19:43', 1),
(790, 60, 0, 0, 'Room_category_registration', '', 'Added room category: SUIT ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:19:54', 1),
(791, 47, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: MUNNAR VALLEY NEST STAY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:25:52', 1),
(792, 48, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: MUNNAR VALLEY NEST STAY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:27:08', 1),
(793, 49, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: MUNNAR VALLEY NEST STAY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 02:27:41', 1),
(794, 35, 0, 0, 'Property_registration', '', 'Added property: BELITA INFINITY POOL RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:02:02', 1),
(795, 61, 0, 0, 'Room_category_registration', '', 'Added room category: STANDARD ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:03:19', 1),
(796, 62, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE NON AC WITH BALCONY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:03:50', 1),
(797, 63, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE AC WITH BALCONY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:04:09', 1),
(798, 64, 0, 0, 'Room_category_registration', '', 'Added room category: VALLEY VIEW AC WITH BALCONY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:04:45', 1),
(799, 65, 0, 0, 'Room_category_registration', '', 'Added room category: JUNIOR SUIT AC WITH BALCONY', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:05:08', 1),
(800, 50, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BELITA INFINITY POOL RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:11:02', 1),
(801, 51, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BELITA INFINITY POOL RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:12:26', 1),
(802, 52, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BELITA INFINITY POOL RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:13:49', 1),
(803, 36, 0, 0, 'Property_registration', '', 'Added property: BRIGHT MEADOW DAM VIEW RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:26:15', 1),
(804, 66, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE DOUBLE ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:26:53', 1),
(805, 53, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BRIGHT MEADOW DAM VIEW RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:27:36', 1),
(806, 37, 0, 0, 'Property_registration', '', 'Added property: LIVINNS ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:38:22', 1),
(807, 67, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE NON AC', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:39:53', 1),
(808, 54, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: LIVINNS ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:40:31', 1),
(809, 15, 0, 0, 'Property_category_registration', '', 'Added property category: HOUSEBOAT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:46:13', 1),
(810, 38, 0, 0, 'Property_registration', '', 'Added property: DELUXE HUSEBOAT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:47:02', 1),
(811, 68, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:48:01', 1),
(812, 69, 0, 0, 'Room_category_registration', '', 'Added room category: PREMIUM ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:48:30', 1),
(813, 69, 0, 0, 'Room_category_registration', '', 'Edited room category: PREMIUM ROOM', '103.203.73.51', 'Edit', 1, 'Super admin', '2026-02-25', '2026-02-25 03:49:09', 1),
(814, 68, 0, 0, 'Room_category_registration', '', 'Edited room category: DELUXE ROOM', '103.203.73.51', 'Edit', 1, 'Super admin', '2026-02-25', '2026-02-25 03:49:15', 1),
(815, 55, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DELUXE HUSEBOAT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 03:49:54', 1),
(816, 15, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 3 N - 4Day Munnar Thekkady', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:22', 1),
(817, 16, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 2 day munnar to thekkady', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:25', 1),
(818, 14, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 4N5D - MUNNAR ALAPPEY VARKALA TRIVANDRUM', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:28', 1),
(819, 13, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 3N4D - MUNNAR ALAPPEY ATHIRAPPILLY', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:30', 1),
(820, 6, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 2 N - 3 Days Kerala', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:33', 1),
(821, 1, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: New one', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:36', 1),
(822, 3, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 1 durartion', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:38', 1),
(823, 5, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: Kerala 4 days - 5 nights', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:40', 1),
(824, 2, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 2 days ititmmmm', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:42', 1),
(825, 4, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: dssd', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:46', 1),
(826, 7, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:50', 1),
(827, 12, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: New ieuweu Test', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:53', 1),
(828, 8, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:38:56', 1),
(829, 39, 0, 0, 'Property_registration', '', 'Added property: PATIO ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 04:42:16', 1),
(830, 70, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 04:43:48', 1),
(831, 71, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE AC', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 04:47:48', 1),
(832, 72, 0, 0, 'Room_category_registration', '', 'Added room category: SUIT ROOM AC', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 04:48:20', 1),
(833, 56, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: PATIO ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 04:51:29', 1),
(834, 9, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 04:51:53', 1),
(835, 10, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 05:05:06', 1),
(836, 11, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: New ieuweu Test', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 05:05:12', 1),
(837, 2, 0, 0, 'Package_category_registration', '', 'Deleted package category JAm_edited', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-25', '2026-02-25 05:08:23', 1),
(838, 3, 0, 0, 'Package_category_registration', '', 'Added package category: HONEYMOON', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 05:08:31', 1),
(839, 4, 0, 0, 'Package_category_registration', '', 'Added package category: NORMAL', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-25', '2026-02-25 05:08:39', 1),
(840, 40, 0, 0, 'Property_registration', '', 'Added property: GODS OWN VILLA', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 12:47:25', 1),
(841, 73, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE DOUBLE AC', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 12:48:38', 1),
(842, 74, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE DOUB;E NON AC', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 12:48:53', 1),
(843, 57, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: GODS OWN VILLA', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 12:49:52', 1),
(844, 58, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: GODS OWN VILLA', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 12:51:13', 1),
(845, 27, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-04-01 to date 2026-10-31', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 12:51:47', 1),
(846, 28, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-11-01 to date 2027-03-31', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 12:52:30', 1),
(847, 59, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BLACK BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 02:26:57', 1),
(848, 60, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BLACK BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 02:29:40', 1),
(849, 61, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BLACK BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 02:31:50', 1),
(850, 62, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BLACK BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 02:34:39', 1),
(851, 63, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BLACK BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 02:37:25', 1),
(852, 29, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-01 to date 2027-01-31', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 02:38:01', 1),
(853, 41, 0, 0, 'Property_registration', '', 'Added property: DESHADAN BACKWATER RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 12:14:23', 1),
(854, 75, 0, 0, 'Room_category_registration', '', 'Added room category: PAVILION ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 12:15:21', 1),
(855, 76, 0, 0, 'Room_category_registration', '', 'Added room category: LAKE VIEW ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 12:15:40', 1),
(856, 77, 0, 0, 'Room_category_registration', '', 'Added room category: SUPERIOR LAKE VIEW ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 12:16:02', 1),
(857, 78, 0, 0, 'Room_category_registration', '', 'Added room category: LAKE VIEW WITH PLUNG POOL', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 12:16:35', 1),
(858, 64, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN BACKWATER RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 12:20:24', 1),
(859, 65, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN BACKWATER RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 12:21:34', 1),
(860, 1, 0, 0, 'Room_tariff_hike_registration', '', 'Deleted room tariff hike details of property: DESHADAN BACKWATER RESORT', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-27', '2026-02-27 12:35:41', 1),
(861, 66, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN BACKWATER RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 12:42:18', 1),
(862, 23, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 01:05:07', 1),
(863, 24, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 01:05:22', 1),
(864, 25, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 01:05:41', 1),
(865, 26, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET ', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 01:05:57', 1),
(866, 27, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: EVENING TEA & SNACKS', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 01:06:26', 1),
(867, 28, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: SHIKARA RIDE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 01:07:23', 1),
(868, 22, 0, 0, 'Destination_registration', '', 'Added Destination: KANTHALLOOR', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 01:57:45', 1),
(869, 22, 0, 0, 'Destination_registration', '', 'Deleted Destination: KANTHALLOOR', '103.203.73.51', 'Delete', 1, 'Super admin', '2026-02-27', '2026-02-27 01:58:32', 1),
(870, 42, 0, 0, 'Property_registration', '', 'Added property: DESHADAN ECO VALLEY RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:01:15', 1),
(871, 79, 0, 0, 'Room_category_registration', '', 'Added room category: SUPERIOR ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:02:01', 1),
(872, 80, 0, 0, 'Room_category_registration', '', 'Added room category: PRIVATE VILLA', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:02:22', 1),
(873, 81, 0, 0, 'Room_category_registration', '', 'Added room category: SUPERIOR VILLA', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:02:38', 1),
(874, 67, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: DESHADAN ECO VALLEY RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:04:34', 1),
(875, 29, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: LOCAL JEEP SAFARI', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:18:29', 1),
(876, 30, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CHINNAR JEEP SAFARI', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:19:11', 1),
(877, 31, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: BIRDING WITH GUIDE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:19:41', 1),
(878, 32, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: SOFT TREK', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:19:57', 1),
(879, 32, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: SOFT TREK', '103.203.73.51', 'Edit', 1, 'Super admin', '2026-02-27', '2026-02-27 02:20:09', 1),
(880, 43, 0, 0, 'Property_registration', '', 'Added property: ELIXER CLIFF & BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:36:57', 1),
(881, 82, 0, 0, 'Room_category_registration', '', 'Added room category: SEA VIEW DELUXE ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:37:38', 1),
(882, 83, 0, 0, 'Room_category_registration', '', 'Added room category: JUNIOR SEA VIEW SUIT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:38:05', 1),
(883, 84, 0, 0, 'Room_category_registration', '', 'Added room category: NON SEA VIEW STANDARD ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:38:31', 1),
(884, 85, 0, 0, 'Room_category_registration', '', 'Added room category: SEA VIEW SUIT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:38:51', 1),
(885, 30, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-04-01 to date 2027-03-31', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:39:22', 1),
(886, 68, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: ELIXER CLIFF & BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:49:01', 1),
(887, 69, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: ELIXER CLIFF & BEACH RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:50:42', 1),
(888, 33, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON PACKAGE (CANDLE LIGHT DINNER IN GAZEBO, FLOWER BED, FRUIT BASKET, BADAM MILK)', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:51:49', 1),
(889, 34, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:52:08', 1),
(890, 35, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:52:21', 1),
(891, 36, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: SURFING TRAINING (1.5 HRS)', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:53:20', 1),
(892, 37, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: BOAT RIDE IN SEA', '103.203.73.51', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 02:54:03', 1),
(893, 5, 0, 0, 'Package_registration', '', 'Deleted package: Test', '2.51.250.4', 'Delete', 1, 'Super admin', '2026-03-02', '2026-03-02 09:48:56', 1),
(894, 44, 0, 0, 'Property_registration', '', 'Added property: SPICE JUNGLE RESORT', '103.203.73.51', 'Add', 1, 'Super admin', '2026-03-02', '2026-03-02 03:55:25', 1),
(895, 86, 0, 0, 'Room_category_registration', '', 'Added room category: STANDARD ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-03-02', '2026-03-02 03:56:30', 1),
(896, 87, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-03-02', '2026-03-02 03:56:47', 1),
(897, 88, 0, 0, 'Room_category_registration', '', 'Added room category: SUPER DELUXE ROOM', '103.203.73.51', 'Add', 1, 'Super admin', '2026-03-02', '2026-03-02 03:57:13', 1),
(898, 89, 0, 0, 'Room_category_registration', '', 'Added room category: FAMILY COTTAGE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-03-02', '2026-03-02 03:57:31', 1),
(899, 90, 0, 0, 'Room_category_registration', '', 'Added room category: 3 BED ROOM COTTAGE', '103.203.73.51', 'Add', 1, 'Super admin', '2026-03-02', '2026-03-02 03:58:16', 1),
(900, 70, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SPICE JUNGLE RESORT', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:09:42', 1),
(901, 71, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SPICE JUNGLE RESORT', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:12:01', 1),
(902, 72, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: SPICE JUNGLE RESORT', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:13:00', 1),
(903, 31, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-03-01 to date 2026-09-30', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:13:41', 1),
(904, 38, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:14:31', 1),
(905, 39, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:14:46', 1),
(906, 40, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:15:02', 1),
(907, 41, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:15:21', 1),
(908, 45, 0, 0, 'Property_registration', '', 'Added property: BLUE BELLS', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:19:15', 1),
(909, 91, 0, 0, 'Room_category_registration', '', 'Added room category: PLANTATION VIEW ROOM', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:20:16', 1),
(910, 92, 0, 0, 'Room_category_registration', '', 'Added room category: VALLEY VIEW ROOM', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:20:35', 1),
(911, 32, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-01-01 to date 2026-09-30', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:21:03', 1),
(912, 73, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: BLUE BELLS', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:21:56', 1),
(913, 42, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:22:12', 1),
(914, 43, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:22:25', 1),
(915, 44, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:22:35', 1),
(916, 45, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:22:45', 1),
(917, 46, 0, 0, 'Property_registration', '', 'Added property: VIEW MUNNAR', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:29:34', 1),
(918, 93, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:30:25', 1),
(919, 94, 0, 0, 'Room_category_registration', '', 'Added room category: VALLEY VIEW COTTAGE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:30:47', 1),
(920, 95, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE VALLEY VIEW ROOMS', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:31:26', 1),
(921, 95, 0, 0, 'Room_category_registration', '', 'Edited room category: DELUXE VALLEY VIEW ROOM', '103.203.73.163', 'Edit', 1, 'Super admin', '2026-03-03', '2026-03-03 12:31:33', 1),
(922, 33, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-03-01 to date 2026-09-30', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:32:46', 1),
(923, 74, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: VIEW MUNNAR', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:33:46', 1),
(924, 75, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: VIEW MUNNAR', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:34:21', 1),
(925, 76, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: VIEW MUNNAR', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:34:53', 1),
(926, 46, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:35:15', 1),
(927, 47, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:35:36', 1),
(928, 48, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:35:50', 1),
(929, 49, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:36:07', 1);
INSERT INTO `activity` (`activity_id`, `id_fk`, `activity_staff_id_fk`, `activity_company_id_fk`, `activity_type`, `activity_order_number`, `activity_description`, `activity_ip`, `activity_action`, `activity_by_userid`, `activity_by_username`, `activity_date`, `activity_date_time`, `activity_status`) VALUES
(930, 47, 0, 0, 'Property_registration', '', 'Added property: THE AUTUMN', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:50:11', 1),
(931, 96, 0, 0, 'Room_category_registration', '', 'Added room category: GARDEN VIEW COTTAGE WITH PATIO', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:51:30', 1),
(932, 96, 0, 0, 'Room_category_registration', '', 'Edited room category: GARDEN VIEW COTTAGE WITH PATIO', '103.203.73.163', 'Edit', 1, 'Super admin', '2026-03-03', '2026-03-03 12:52:06', 1),
(933, 97, 0, 0, 'Room_category_registration', '', 'Added room category: VALLEY VIEW COTTAGE WITH BALCONY', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:53:35', 1),
(934, 98, 0, 0, 'Room_category_registration', '', 'Added room category: 2 BED ROOM COTTAGE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 12:54:29', 1),
(935, 77, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: THE AUTUMN', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:14:19', 1),
(936, 78, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: THE AUTUMN', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:23:55', 1),
(937, 79, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: THE AUTUMN', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:24:32', 1),
(938, 50, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:25:03', 1),
(939, 51, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:25:14', 1),
(940, 52, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:25:26', 1),
(941, 53, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:25:38', 1),
(942, 48, 0, 0, 'Property_registration', '', 'Added property: THE LAKE ', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:32:03', 1),
(943, 99, 0, 0, 'Room_category_registration', '', 'Added room category: LAKE VIEW DELUXE AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:41:10', 1),
(944, 80, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: THE LAKE ', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:43:56', 1),
(945, 81, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: THE LAKE ', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:44:16', 1),
(946, 82, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: THE LAKE ', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:44:41', 1),
(947, 34, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-03-01 to date 2026-06-30', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:45:15', 1),
(948, 54, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:45:37', 1),
(949, 55, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:45:55', 1),
(950, 56, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:46:15', 1),
(951, 57, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON CAKE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:46:25', 1),
(952, 58, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: HONEYMOON INCLUSION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:48:12', 1),
(953, 59, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:49:19', 1),
(954, 58, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', '103.203.73.163', 'Edit', 1, 'Super admin', '2026-03-03', '2026-03-03 01:50:00', 1),
(955, 60, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:51:30', 1),
(956, 61, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:52:04', 1),
(957, 62, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 01:53:31', 1),
(958, 49, 0, 0, 'Property_registration', '', 'Added property: LINCOLN SQUARE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:06:42', 1),
(959, 100, 0, 0, 'Room_category_registration', '', 'Added room category: PREMIUM ROOM', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:09:19', 1),
(960, 101, 0, 0, 'Room_category_registration', '', 'Added room category: PREMIUM AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:09:31', 1),
(961, 102, 0, 0, 'Room_category_registration', '', 'Added room category: LUXURY ROOM', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:09:49', 1),
(962, 103, 0, 0, 'Room_category_registration', '', 'Added room category: LUXURY AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:10:01', 1),
(963, 104, 0, 0, 'Room_category_registration', '', 'Added room category: INTERCONNECTED ROOM', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:10:29', 1),
(964, 105, 0, 0, 'Room_category_registration', '', 'Added room category: INTERCONNECTED AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:10:45', 1),
(965, 35, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-03-01 to date 2027-03-31', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:11:08', 1),
(966, 83, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: LINCOLN SQUARE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:13:15', 1),
(967, 84, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: LINCOLN SQUARE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:14:16', 1),
(968, 85, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: LINCOLN SQUARE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:15:12', 1),
(969, 86, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: LINCOLN SQUARE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:16:36', 1),
(970, 87, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: LINCOLN SQUARE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:18:11', 1),
(971, 63, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: BIRTHDAY CELEBRATION ARRANGEMENTS', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:26:03', 1),
(972, 64, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: WEDDING ANNIVERSARY SPECIAL ARRANGEMENTS', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:26:26', 1),
(973, 65, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:26:41', 1),
(974, 66, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:26:56', 1),
(975, 67, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FRUIT BASKET ', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:27:07', 1),
(976, 66, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Edit', 1, 'Super admin', '2026-03-03', '2026-03-03 02:27:20', 1),
(977, 66, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Edit', 1, 'Super admin', '2026-03-03', '2026-03-03 02:27:32', 1),
(978, 68, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLORAL DECORATION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:27:47', 1),
(979, 69, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CAKE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:27:56', 1),
(980, 70, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: BADAM MILK', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:28:08', 1),
(981, 71, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER, FLOWER BED DECORATION, FRUIT BASKET, BADAM MILK, CAKE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:28:51', 1),
(982, 50, 0, 0, 'Property_registration', '', 'Added property: CLOUD CASTLE RESORT & SPA', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:33:49', 1),
(983, 106, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:36:04', 1),
(984, 107, 0, 0, 'Room_category_registration', '', 'Added room category: PREMIUM AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:36:14', 1),
(985, 108, 0, 0, 'Room_category_registration', '', 'Added room category: VALLEY VIEW AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:37:14', 1),
(986, 109, 0, 0, 'Room_category_registration', '', 'Added room category: POOL VIEW AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:37:28', 1),
(987, 110, 0, 0, 'Room_category_registration', '', 'Added room category: INTERCONNECTED AC', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:37:47', 1),
(988, 36, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-03-01 to date 2027-02-28', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:38:08', 1),
(989, 88, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: CLOUD CASTLE RESORT & SPA', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:42:12', 1),
(990, 89, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: CLOUD CASTLE RESORT & SPA', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:43:03', 1),
(991, 90, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: CLOUD CASTLE RESORT & SPA', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:43:51', 1),
(992, 91, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: CLOUD CASTLE RESORT & SPA', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:50:09', 1),
(993, 72, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:56:09', 1),
(994, 73, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:56:31', 1),
(995, 74, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CAKE', '103.203.73.163', 'Add', 1, 'Super admin', '2026-03-03', '2026-03-03 02:56:42', 1),
(996, 51, 0, 0, 'Property_registration', '', 'Added property: PEPPERWINE ', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:46:04', 1),
(997, 111, 0, 0, 'Room_category_registration', '', 'Added room category: DELUXE ROOM', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:47:54', 1),
(998, 112, 0, 0, 'Room_category_registration', '', 'Added room category: SUIT', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:48:09', 1),
(999, 37, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-04-01 to date 2026-09-30', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:48:37', 1),
(1000, 92, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: PEPPERWINE ', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:50:34', 1),
(1001, 75, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CANDLE LIGHT DINNER', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:51:23', 1),
(1002, 76, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: CAKE', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:51:38', 1),
(1003, 77, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: EXCLUSIVE CANDLE LIGHT DINNER WITH WINE', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:52:06', 1),
(1004, 78, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: FLOWER BED DECORATION', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:52:24', 1),
(1005, 77, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: EXCLUSIVE CANDLE LIGHT DINNER WITH WINE', '202.141.45.6', 'Edit', 1, 'Super admin', '2026-03-05', '2026-03-05 01:52:31', 1),
(1006, 79, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: ORIENTAL FRUIT BASKET', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 01:52:46', 1),
(1007, 52, 0, 0, 'Property_registration', '', 'Added property: THE ELEPHANT COURT', '202.141.45.6', 'Add', 1, 'Super admin', '2026-03-05', '2026-03-05 02:08:19', 1),
(1008, 18, 0, 0, 'Itinerary_registration', '', 'Added itinerary: Gaddd', '2.51.212.168', 'Add', 0, '', '2026-03-18', '2026-03-18 08:30:42', 1),
(1009, 1, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', '152.58.200.240', 'Add', 0, '', '2026-03-21', '2026-03-21 09:34:56', 1),
(1010, 19, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-19', '152.58.200.227', 'Add', 1, 'Super admin', '2026-03-21', '2026-03-21 09:47:46', 1),
(1011, 2, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 3N4D - MUNNAR ALAPPEY COCHIN', '202.141.45.145', 'Add', 0, '', '2026-03-23', '2026-03-23 06:48:23', 1),
(1012, 3, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 2N3D - MUNNAR ALAPPEY COCHIN', '202.141.45.145', 'Add', 0, '', '2026-03-23', '2026-03-23 06:55:03', 1),
(1013, 4, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 2N3D - MUNNNAR', '202.141.45.145', 'Add', 0, '', '2026-03-23', '2026-03-23 07:12:29', 1),
(1014, 5, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 5N6D - MUNNAR THEKKADY VAGAMON ALAPPEY COCHIN', '202.141.45.145', 'Add', 0, '', '2026-03-23', '2026-03-23 07:45:25', 1),
(1015, 6, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 4N5D - MUNNAR ALAPPEY VARKALA TRIVANDRUM', '202.141.45.145', 'Add', 0, '', '2026-03-23', '2026-03-23 07:56:49', 1),
(1016, 7, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 5N6D - MUNNAR THEKKADY ALAPPEY VARKALA TRIVANDRUM', '202.141.45.145', 'Add', 0, '', '2026-03-23', '2026-03-23 08:05:48', 1),
(1017, 52, 0, 0, 'Property_registration', '', 'Edited property: The Elephant Court', '103.203.73.106', 'Edit', 1, 'Super admin', '2026-04-08', '2026-04-08 05:33:55', 1),
(1018, 15, 0, 0, 'Property_category_registration', '', 'Edited property category: Houseboat', '103.203.73.106', 'Edit', 1, 'Super admin', '2026-04-08', '2026-04-08 05:37:51', 1),
(1019, 11, 0, 0, 'Property_category_registration', '', 'Edited property category: 5 Star', '103.203.73.106', 'Edit', 1, 'Super admin', '2026-04-08', '2026-04-08 05:38:04', 1),
(1020, 14, 0, 0, 'Property_category_registration', '', 'Edited property category: Deluxe Cottage', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:36:56', 1),
(1021, 13, 0, 0, 'Property_category_registration', '', 'Edited property category: 3 Star Premium', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:37:40', 1),
(1022, 12, 0, 0, 'Property_category_registration', '', 'Edited property category: Budgeted Stay', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:37:52', 1),
(1023, 10, 0, 0, 'Property_category_registration', '', 'Edited property category: 4 Star', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:38:00', 1),
(1024, 9, 0, 0, 'Property_category_registration', '', 'Edited property category: Premium', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:38:06', 1),
(1025, 8, 0, 0, 'Property_category_registration', '', 'Edited property category: Deluxe', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:38:18', 1),
(1026, 7, 0, 0, 'Property_category_registration', '', 'Edited property category: 3 Star', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:38:29', 1),
(1027, 6, 0, 0, 'Property_category_registration', '', 'Edited property category: Tree House', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:38:39', 1),
(1028, 6, 0, 0, 'Property_category_registration', '', 'Edited property category: Private Stay', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:38:55', 1),
(1029, 16, 0, 0, 'Property_category_registration', '', 'Added property category: Tree House', '178.248.114.103', 'Add', 1, 'Super admin', '2026-04-09', '2026-04-09 06:39:26', 1),
(1030, 17, 0, 0, 'Property_category_registration', '', 'Added property category: Glamping', '178.248.114.103', 'Add', 1, 'Super admin', '2026-04-09', '2026-04-09 06:39:35', 1),
(1031, 51, 0, 0, 'Property_registration', '', 'Edited property: Pepperwine', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:39:58', 1),
(1032, 50, 0, 0, 'Property_registration', '', 'Edited property: Cloud Castle Resort & Spa', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:40:29', 1),
(1033, 49, 0, 0, 'Property_registration', '', 'Edited property: Lincoln Square', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:40:40', 1),
(1034, 48, 0, 0, 'Property_registration', '', 'Edited property: The Lake', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:41:52', 1),
(1035, 47, 0, 0, 'Property_registration', '', 'Edited property: The Autumn by Maat Hotels', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:42:08', 1),
(1036, 46, 0, 0, 'Property_registration', '', 'Edited property: The View', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:42:19', 1),
(1037, 45, 0, 0, 'Property_registration', '', 'Edited property: Blue Bells', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:42:31', 1),
(1038, 45, 0, 0, 'Property_registration', '', 'Edited property: Blue Bells Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:42:43', 1),
(1039, 44, 0, 0, 'Property_registration', '', 'Edited property: Spice Jungle Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:43:04', 1),
(1040, 43, 0, 0, 'Property_registration', '', 'Edited property: Elixer Cliff & Beach Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:43:22', 1),
(1041, 42, 0, 0, 'Property_registration', '', 'Edited property: Deshadan Eco Valley Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:44:06', 1),
(1042, 41, 0, 0, 'Property_registration', '', 'Edited property: Deshadan Backwater Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:44:42', 1),
(1043, 41, 0, 0, 'Property_registration', '', 'Edited property: Deshadan Backwater Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:44:48', 1),
(1044, 40, 0, 0, 'Property_registration', '', 'Edited property: Gods Own Villa', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:45:01', 1),
(1045, 39, 0, 0, 'Property_registration', '', 'Edited property: The Patio', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:45:09', 1),
(1046, 38, 0, 0, 'Property_registration', '', 'Edited property: Deluxe Houseboat', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:45:22', 1),
(1047, 37, 0, 0, 'Property_registration', '', 'Edited property: Livinns', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:45:35', 1),
(1048, 36, 0, 0, 'Property_registration', '', 'Edited property: Bright Meadow Dam View', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:45:48', 1),
(1049, 35, 0, 0, 'Property_registration', '', 'Edited property: Belita Infinity Pool Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:46:03', 1),
(1050, 34, 0, 0, 'Property_registration', '', 'Edited property: White Fort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:46:13', 1),
(1051, 33, 0, 0, 'Property_registration', '', 'Edited property: West Bay Marisol', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:46:25', 1),
(1052, 32, 0, 0, 'Property_registration', '', 'Edited property: Trivers Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:46:42', 1),
(1053, 31, 0, 0, 'Property_registration', '', 'Edited property: Black Beach Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:46:57', 1),
(1054, 30, 0, 0, 'Property_registration', '', 'Edited property: Opalo Kailas', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:47:10', 1),
(1055, 29, 0, 0, 'Property_registration', '', 'Edited property: Swagath Holidays', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:47:21', 1),
(1056, 28, 0, 0, 'Property_registration', '', 'Edited property: Jasmin Palace', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:47:36', 1),
(1057, 27, 0, 0, 'Property_registration', '', 'Edited property: Munnar Valley Nest Stay', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:48:08', 1),
(1058, 26, 0, 0, 'Property_registration', '', 'Edited property: Deshadan Mountain Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:48:25', 1),
(1059, 24, 0, 0, 'Property_registration', '', 'Edited property: Ananthapuram Residency', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:48:58', 1),
(1060, 23, 0, 0, 'Property_registration', '', 'Edited property: Navaneetham Villa Stay', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:49:28', 1),
(1061, 22, 0, 0, 'Property_registration', '', 'Edited property: Deshadan Cliff & Beach Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:49:48', 1),
(1062, 21, 0, 0, 'Property_registration', '', 'Edited property: The Arbour Resort', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:50:43', 1),
(1063, 20, 0, 0, 'Property_registration', '', 'Edited property: Velvet Vista', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:50:54', 1),
(1064, 21, 0, 0, 'Destination_registration', '', 'Edited Destination: Trivandrum', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:51:12', 1),
(1065, 20, 0, 0, 'Destination_registration', '', 'Edited Destination: Cochin', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:51:21', 1),
(1066, 19, 0, 0, 'Destination_registration', '', 'Edited Destination: Kumarakom', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:51:27', 1),
(1067, 18, 0, 0, 'Destination_registration', '', 'Edited Destination: Kanthalloor', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:51:36', 1),
(1068, 17, 0, 0, 'Destination_registration', '', 'Edited Destination: Suryanelli', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:51:46', 1),
(1069, 16, 0, 0, 'Destination_registration', '', 'Edited Destination: Vattavada', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:51:57', 1),
(1070, 15, 0, 0, 'Destination_registration', '', 'Edited Destination: Munroe Island', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:52:06', 1),
(1071, 14, 0, 0, 'Destination_registration', '', 'Edited Destination: Guruvayoor', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:52:13', 1),
(1072, 13, 0, 0, 'Destination_registration', '', 'Edited Destination: Wayanadu', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:52:23', 1),
(1073, 12, 0, 0, 'Destination_registration', '', 'Edited Destination: Vagamon', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:52:29', 1),
(1074, 11, 0, 0, 'Destination_registration', '', 'Edited Destination: Athirappilly', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:52:42', 1),
(1075, 10, 0, 0, 'Destination_registration', '', 'Edited Destination: Kovalam', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:52:51', 1),
(1076, 8, 0, 0, 'Destination_registration', '', 'Edited Destination: Varkala', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:52:57', 1),
(1077, 7, 0, 0, 'Destination_registration', '', 'Edited Destination: Alappey', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:53:06', 1),
(1078, 6, 0, 0, 'Destination_registration', '', 'Edited Destination: Thekkady', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:53:12', 1),
(1079, 5, 0, 0, 'Destination_registration', '', 'Edited Destination: Munnar', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:53:18', 1),
(1080, 2, 0, 0, 'Itinerary_category_registration', '', 'Edited itinerary category: Family', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:55:06', 1),
(1081, 1, 0, 0, 'Itinerary_category_registration', '', 'Edited itinerary category: Friends', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:55:14', 1),
(1082, 3, 0, 0, 'Itinerary_category_registration', '', 'Edited itinerary category: Honeymoon', '178.248.114.103', 'Edit', 1, 'Super admin', '2026-04-09', '2026-04-09 06:55:20', 1),
(1083, 10, 0, 0, 'Staff_registration', '', 'Edited staff: SANI', '83.111.121.136', 'Edit', 1, 'Super admin', '2026-04-14', '2026-04-14 03:05:44', 1),
(1084, 11, 0, 0, 'Staff_registration', '', 'Added staff: Fahad', '83.111.121.136', 'Add', 1, 'Super admin', '2026-04-14', '2026-04-14 03:08:52', 1),
(1085, 9, 0, 0, 'Staff_registration', '', 'Edited staff: SETHU', '83.111.121.136', 'Edit', 1, 'Super admin', '2026-04-14', '2026-04-14 03:11:40', 1),
(1086, 8, 0, 0, 'Staff_registration', '', 'Edited staff: REEHAL', '83.111.121.136', 'Edit', 1, 'Super admin', '2026-04-14', '2026-04-14 03:11:50', 1),
(1087, 7, 0, 0, 'Staff_registration', '', 'Edited staff: NISHA', '83.111.121.136', 'Edit', 1, 'Super admin', '2026-04-14', '2026-04-14 03:12:03', 1),
(1088, 1, 0, 0, 'Meta_ads_setting_registration', '', 'Added meta ads setting: Honey moon Normal', '83.111.121.136', 'Add', 1, 'Super admin', '2026-04-14', '2026-04-14 15:16:15', 1),
(1089, 1, 0, 0, 'Meta_ads_setting_registration', '', 'Added meta ads setting: Honey moon Normal', '83.111.121.136', 'Add', 1, 'Super admin', '2026-04-14', '2026-04-14 15:17:41', 1),
(1090, 15, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-15', '2.51.212.168', 'Add', 1, 'Super admin', '2026-04-18', '2026-04-18 01:35:50', 1),
(1091, 12, 0, 0, 'Staff_registration', '', 'Added staff: SHANIMOL', '202.141.45.250', 'Add', 1, 'Super admin', '2026-04-19', '2026-04-19 05:57:09', 1),
(1092, 11, 0, 0, 'Staff_registration', '', 'Deleted staff Fahad', '202.141.45.250', 'Delete', 1, 'Super admin', '2026-04-19', '2026-04-19 05:57:21', 1),
(1093, 10, 0, 0, 'Staff_registration', '', 'Deleted staff SANI', '202.141.45.250', 'Delete', 1, 'Super admin', '2026-04-19', '2026-04-19 05:57:25', 1),
(1094, 8, 0, 0, 'Staff_registration', '', 'Deleted staff REEHAL', '202.141.45.250', 'Delete', 1, 'Super admin', '2026-04-19', '2026-04-19 05:57:31', 1),
(1095, 9, 0, 0, 'Staff_registration', '', 'Deleted staff SETHU', '202.141.45.250', 'Delete', 1, 'Super admin', '2026-04-19', '2026-04-19 05:57:35', 1),
(1096, 16, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-16', '202.141.45.250', 'Add', 12, 'SHANIMOL', '2026-04-19', '2026-04-19 06:10:02', 1),
(1097, 2, 0, 0, 'Role_registration', '', 'Added Role: Super admin', '2.51.212.168', 'Add', 1, 'Super admin', '2026-04-19', '2026-04-19 07:38:57', 1),
(1098, 8, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 1 Days Traveling', '2.51.212.168', 'Add', 0, '', '2026-04-19', '2026-04-19 09:18:25', 1),
(1099, 17, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-17', '2.51.212.168', 'Add', 1, 'Super admin', '2026-04-19', '2026-04-19 10:02:09', 1),
(1100, 18, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-18', '2.51.212.168', 'Add', 1, 'Super admin', '2026-04-21', '2026-04-21 07:52:54', 1),
(1101, 357, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-357', '103.183.83.67', 'Add', 1, 'Super admin', '2026-04-25', '2026-04-25 08:20:43', 1),
(1102, 622, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-622', '2.51.212.168', 'Add', 1, 'Super admin', '2026-04-28', '2026-04-28 08:13:07', 1),
(1103, 53, 0, 0, 'Property_registration', '', 'Added property: abs', '202.141.45.250', 'Add', 1, 'Super admin', '2026-04-29', '2026-04-29 09:15:41', 1),
(1104, 623, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-623', '202.141.45.250', 'Add', 1, 'Super admin', '2026-04-29', '2026-04-29 09:23:54', 1),
(1105, 2, 0, 0, 'Permission_registration', '', 'Updated Role: Super admin', '2.51.212.168', 'Edit', 1, 'Super admin', '2026-04-30', '2026-04-30 09:02:33', 1);

-- --------------------------------------------------------

--
-- Table structure for table `b2b_partner`
--

CREATE TABLE `b2b_partner` (
  `b2b_partner_id` int(11) NOT NULL,
  `b2b_partner_agent_name` varchar(255) NOT NULL,
  `b2b_partner_address` text NOT NULL,
  `b2b_partner_country_id_fk` int(11) NOT NULL,
  `b2b_partner_location_id_fk` int(11) NOT NULL,
  `b2b_partner_person_name` varchar(255) NOT NULL,
  `b2b_partner_contact_number` varchar(255) NOT NULL,
  `b2b_partner_email_address` varchar(255) NOT NULL,
  `b2b_partner_description` text NOT NULL,
  `b2b_partner_createdby_user_id` int(11) NOT NULL,
  `b2b_partner_createdby_user_name` varchar(255) NOT NULL,
  `b2b_partner_created_date` date NOT NULL,
  `b2b_partner_created_time` time NOT NULL,
  `b2b_partner_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `b2b_partner`
--

INSERT INTO `b2b_partner` (`b2b_partner_id`, `b2b_partner_agent_name`, `b2b_partner_address`, `b2b_partner_country_id_fk`, `b2b_partner_location_id_fk`, `b2b_partner_person_name`, `b2b_partner_contact_number`, `b2b_partner_email_address`, `b2b_partner_description`, `b2b_partner_createdby_user_id`, `b2b_partner_createdby_user_name`, `b2b_partner_created_date`, `b2b_partner_created_time`, `b2b_partner_status`) VALUES
(1, 'Dahgg', 'hghg', 99, 4, 'gf', 'gfgf', 'fgfg', 'fg', 0, '', '2025-07-22', '02:23:42', 0),
(2, 'Jaffarghg', 'hfg', 99, 4, 'Gafoor', '433400', 's@sr', 'hg', 0, '', '2025-07-22', '08:15:09', 0),
(3, 'Nabeel', 'Ena', 0, 0, '', '', '', '', 1, 'Super admin', '2026-01-24', '08:28:27', 1),
(4, 'New agent_edited', 'jjj_edited', 12, 1, 'jamal_edited', '199119099', 'sh_edited@gmail.com', '_edited', 1, 'Super admin', '2026-01-25', '02:52:59', 0);

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_policies`
--

CREATE TABLE `cancellation_policies` (
  `cancellation_policies_id` int(11) NOT NULL,
  `cancellation_policies_name` varchar(255) NOT NULL,
  `cancellation_policies_createdby_user_id` int(11) NOT NULL,
  `cancellation_policies_createdby_user_name` varchar(255) NOT NULL,
  `cancellation_policies_created_date` date NOT NULL,
  `cancellation_policies_created_time` time NOT NULL,
  `cancellation_policies_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cancellation_policies`
--

INSERT INTO `cancellation_policies` (`cancellation_policies_id`, `cancellation_policies_name`, `cancellation_policies_createdby_user_id`, `cancellation_policies_createdby_user_name`, `cancellation_policies_created_date`, `cancellation_policies_created_time`, `cancellation_policies_status`) VALUES
(1, 'hffh_edir', 1, 'Super admin', '0000-00-00', '00:00:00', 1),
(2, 'nana', 1, 'Super admin', '2026-01-25', '04:47:44', 1),
(3, 'KERALA - CP', 1, 'Super admin', '2026-02-17', '07:27:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_policies_item`
--

CREATE TABLE `cancellation_policies_item` (
  `cancellation_policies_item_id` int(11) NOT NULL,
  `cancellation_policies_id_fk` int(11) NOT NULL,
  `cancellation_policies_item_name` text NOT NULL,
  `cancellation_policies_item_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `cancellation_policies_item`
--

INSERT INTO `cancellation_policies_item` (`cancellation_policies_item_id`, `cancellation_policies_id_fk`, `cancellation_policies_item_name`, `cancellation_policies_item_status`) VALUES
(1, 1, 'fh_edj', 1),
(2, 1, 'fh_snds', 1),
(4, 2, 'mnsa', 1),
(5, 2, 'msam', 1),
(6, 1, 'ssj', 1),
(7, 3, 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `child_age_break_up`
--

CREATE TABLE `child_age_break_up` (
  `child_age_break_up_id` int(11) NOT NULL,
  `guset_count_details_id_fk` int(11) NOT NULL,
  `age` int(11) NOT NULL,
  `count` int(11) NOT NULL,
  `child_age_break_up_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `iso`, `name`, `nicename`, `iso3`, `numcode`, `phonecode`) VALUES
(1, 'AF', 'AFGHANISTAN', 'Afghanistan', 'AFG', 4, 93),
(2, 'AL', 'ALBANIA', 'Albania', 'ALB', 8, 355),
(3, 'DZ', 'ALGERIA', 'Algeria', 'DZA', 12, 213),
(4, 'AS', 'AMERICAN SAMOA', 'American Samoa', 'ASM', 16, 1684),
(5, 'AD', 'ANDORRA', 'Andorra', 'AND', 20, 376),
(6, 'AO', 'ANGOLA', 'Angola', 'AGO', 24, 244),
(7, 'AI', 'ANGUILLA', 'Anguilla', 'AIA', 660, 1264),
(8, 'AQ', 'ANTARCTICA', 'Antarctica', NULL, NULL, 0),
(9, 'AG', 'ANTIGUA AND BARBUDA', 'Antigua and Barbuda', 'ATG', 28, 1268),
(10, 'AR', 'ARGENTINA', 'Argentina', 'ARG', 32, 54),
(11, 'AM', 'ARMENIA', 'Armenia', 'ARM', 51, 374),
(12, 'AW', 'ARUBA', 'Aruba', 'ABW', 533, 297),
(13, 'AU', 'AUSTRALIA', 'Australia', 'AUS', 36, 61),
(14, 'AT', 'AUSTRIA', 'Austria', 'AUT', 40, 43),
(15, 'AZ', 'AZERBAIJAN', 'Azerbaijan', 'AZE', 31, 994),
(16, 'BS', 'BAHAMAS', 'Bahamas', 'BHS', 44, 1242),
(17, 'BH', 'BAHRAIN', 'Bahrain', 'BHR', 48, 973),
(18, 'BD', 'BANGLADESH', 'Bangladesh', 'BGD', 50, 880),
(19, 'BB', 'BARBADOS', 'Barbados', 'BRB', 52, 1246),
(20, 'BY', 'BELARUS', 'Belarus', 'BLR', 112, 375),
(21, 'BE', 'BELGIUM', 'Belgium', 'BEL', 56, 32),
(22, 'BZ', 'BELIZE', 'Belize', 'BLZ', 84, 501),
(23, 'BJ', 'BENIN', 'Benin', 'BEN', 204, 229),
(24, 'BM', 'BERMUDA', 'Bermuda', 'BMU', 60, 1441),
(25, 'BT', 'BHUTAN', 'Bhutan', 'BTN', 64, 975),
(26, 'BO', 'BOLIVIA', 'Bolivia', 'BOL', 68, 591),
(27, 'BA', 'BOSNIA AND HERZEGOVINA', 'Bosnia and Herzegovina', 'BIH', 70, 387),
(28, 'BW', 'BOTSWANA', 'Botswana', 'BWA', 72, 267),
(29, 'BV', 'BOUVET ISLAND', 'Bouvet Island', NULL, NULL, 0),
(30, 'BR', 'BRAZIL', 'Brazil', 'BRA', 76, 55),
(31, 'IO', 'BRITISH INDIAN OCEAN TERRITORY', 'British Indian Ocean Territory', NULL, NULL, 246),
(32, 'BN', 'BRUNEI DARUSSALAM', 'Brunei Darussalam', 'BRN', 96, 673),
(33, 'BG', 'BULGARIA', 'Bulgaria', 'BGR', 100, 359),
(34, 'BF', 'BURKINA FASO', 'Burkina Faso', 'BFA', 854, 226),
(35, 'BI', 'BURUNDI', 'Burundi', 'BDI', 108, 257),
(36, 'KH', 'CAMBODIA', 'Cambodia', 'KHM', 116, 855),
(37, 'CM', 'CAMEROON', 'Cameroon', 'CMR', 120, 237),
(38, 'CA', 'CANADA', 'Canada', 'CAN', 124, 1),
(39, 'CV', 'CAPE VERDE', 'Cape Verde', 'CPV', 132, 238),
(40, 'KY', 'CAYMAN ISLANDS', 'Cayman Islands', 'CYM', 136, 1345),
(41, 'CF', 'CENTRAL AFRICAN REPUBLIC', 'Central African Republic', 'CAF', 140, 236),
(42, 'TD', 'CHAD', 'Chad', 'TCD', 148, 235),
(43, 'CL', 'CHILE', 'Chile', 'CHL', 152, 56),
(44, 'CN', 'CHINA', 'China', 'CHN', 156, 86),
(45, 'CX', 'CHRISTMAS ISLAND', 'Christmas Island', NULL, NULL, 61),
(46, 'CC', 'COCOS (KEELING) ISLANDS', 'Cocos (Keeling) Islands', NULL, NULL, 672),
(47, 'CO', 'COLOMBIA', 'Colombia', 'COL', 170, 57),
(48, 'KM', 'COMOROS', 'Comoros', 'COM', 174, 269),
(49, 'CG', 'CONGO', 'Congo', 'COG', 178, 242),
(50, 'CD', 'CONGO, THE DEMOCRATIC REPUBLIC OF THE', 'Congo, the Democratic Republic of the', 'COD', 180, 242),
(51, 'CK', 'COOK ISLANDS', 'Cook Islands', 'COK', 184, 682),
(52, 'CR', 'COSTA RICA', 'Costa Rica', 'CRI', 188, 506),
(53, 'CI', 'COTE D\'IVOIRE', 'Cote D\'Ivoire', 'CIV', 384, 225),
(54, 'HR', 'CROATIA', 'Croatia', 'HRV', 191, 385),
(55, 'CU', 'CUBA', 'Cuba', 'CUB', 192, 53),
(56, 'CY', 'CYPRUS', 'Cyprus', 'CYP', 196, 357),
(57, 'CZ', 'CZECH REPUBLIC', 'Czech Republic', 'CZE', 203, 420),
(58, 'DK', 'DENMARK', 'Denmark', 'DNK', 208, 45),
(59, 'DJ', 'DJIBOUTI', 'Djibouti', 'DJI', 262, 253),
(60, 'DM', 'DOMINICA', 'Dominica', 'DMA', 212, 1767),
(61, 'DO', 'DOMINICAN REPUBLIC', 'Dominican Republic', 'DOM', 214, 1809),
(62, 'EC', 'ECUADOR', 'Ecuador', 'ECU', 218, 593),
(63, 'EG', 'EGYPT', 'Egypt', 'EGY', 818, 20),
(64, 'SV', 'EL SALVADOR', 'El Salvador', 'SLV', 222, 503),
(65, 'GQ', 'EQUATORIAL GUINEA', 'Equatorial Guinea', 'GNQ', 226, 240),
(66, 'ER', 'ERITREA', 'Eritrea', 'ERI', 232, 291),
(67, 'EE', 'ESTONIA', 'Estonia', 'EST', 233, 372),
(68, 'ET', 'ETHIOPIA', 'Ethiopia', 'ETH', 231, 251),
(69, 'FK', 'FALKLAND ISLANDS (MALVINAS)', 'Falkland Islands (Malvinas)', 'FLK', 238, 500),
(70, 'FO', 'FAROE ISLANDS', 'Faroe Islands', 'FRO', 234, 298),
(71, 'FJ', 'FIJI', 'Fiji', 'FJI', 242, 679),
(72, 'FI', 'FINLAND', 'Finland', 'FIN', 246, 358),
(73, 'FR', 'FRANCE', 'France', 'FRA', 250, 33),
(74, 'GF', 'FRENCH GUIANA', 'French Guiana', 'GUF', 254, 594),
(75, 'PF', 'FRENCH POLYNESIA', 'French Polynesia', 'PYF', 258, 689),
(76, 'TF', 'FRENCH SOUTHERN TERRITORIES', 'French Southern Territories', NULL, NULL, 0),
(77, 'GA', 'GABON', 'Gabon', 'GAB', 266, 241),
(78, 'GM', 'GAMBIA', 'Gambia', 'GMB', 270, 220),
(79, 'GE', 'GEORGIA', 'Georgia', 'GEO', 268, 995),
(80, 'DE', 'GERMANY', 'Germany', 'DEU', 276, 49),
(81, 'GH', 'GHANA', 'Ghana', 'GHA', 288, 233),
(82, 'GI', 'GIBRALTAR', 'Gibraltar', 'GIB', 292, 350),
(83, 'GR', 'GREECE', 'Greece', 'GRC', 300, 30),
(84, 'GL', 'GREENLAND', 'Greenland', 'GRL', 304, 299),
(85, 'GD', 'GRENADA', 'Grenada', 'GRD', 308, 1473),
(86, 'GP', 'GUADELOUPE', 'Guadeloupe', 'GLP', 312, 590),
(87, 'GU', 'GUAM', 'Guam', 'GUM', 316, 1671),
(88, 'GT', 'GUATEMALA', 'Guatemala', 'GTM', 320, 502),
(89, 'GN', 'GUINEA', 'Guinea', 'GIN', 324, 224),
(90, 'GW', 'GUINEA-BISSAU', 'Guinea-Bissau', 'GNB', 624, 245),
(91, 'GY', 'GUYANA', 'Guyana', 'GUY', 328, 592),
(92, 'HT', 'HAITI', 'Haiti', 'HTI', 332, 509),
(93, 'HM', 'HEARD ISLAND AND MCDONALD ISLANDS', 'Heard Island and Mcdonald Islands', NULL, NULL, 0),
(94, 'VA', 'HOLY SEE (VATICAN CITY STATE)', 'Holy See (Vatican City State)', 'VAT', 336, 39),
(95, 'HN', 'HONDURAS', 'Honduras', 'HND', 340, 504),
(96, 'HK', 'HONG KONG', 'Hong Kong', 'HKG', 344, 852),
(97, 'HU', 'HUNGARY', 'Hungary', 'HUN', 348, 36),
(98, 'IS', 'ICELAND', 'Iceland', 'ISL', 352, 354),
(99, 'IN', 'INDIA', 'India', 'IND', 356, 91),
(100, 'ID', 'INDONESIA', 'Indonesia', 'IDN', 360, 62),
(101, 'IR', 'IRAN, ISLAMIC REPUBLIC OF', 'Iran, Islamic Republic of', 'IRN', 364, 98),
(102, 'IQ', 'IRAQ', 'Iraq', 'IRQ', 368, 964),
(103, 'IE', 'IRELAND', 'Ireland', 'IRL', 372, 353),
(104, 'IL', 'ISRAEL', 'Israel', 'ISR', 376, 972),
(105, 'IT', 'ITALY', 'Italy', 'ITA', 380, 39),
(106, 'JM', 'JAMAICA', 'Jamaica', 'JAM', 388, 1876),
(107, 'JP', 'JAPAN', 'Japan', 'JPN', 392, 81),
(108, 'JO', 'JORDAN', 'Jordan', 'JOR', 400, 962),
(109, 'KZ', 'KAZAKHSTAN', 'Kazakhstan', 'KAZ', 398, 7),
(110, 'KE', 'KENYA', 'Kenya', 'KEN', 404, 254),
(111, 'KI', 'KIRIBATI', 'Kiribati', 'KIR', 296, 686),
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE\'S REPUBLIC OF', 'Korea, Democratic People\'s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE\'S DEMOCRATIC REPUBLIC', 'Lao People\'s Democratic Republic', 'LAO', 418, 856),
(117, 'LV', 'LATVIA', 'Latvia', 'LVA', 428, 371),
(118, 'LB', 'LEBANON', 'Lebanon', 'LBN', 422, 961),
(119, 'LS', 'LESOTHO', 'Lesotho', 'LSO', 426, 266),
(120, 'LR', 'LIBERIA', 'Liberia', 'LBR', 430, 231),
(121, 'LY', 'LIBYAN ARAB JAMAHIRIYA', 'Libyan Arab Jamahiriya', 'LBY', 434, 218),
(122, 'LI', 'LIECHTENSTEIN', 'Liechtenstein', 'LIE', 438, 423),
(123, 'LT', 'LITHUANIA', 'Lithuania', 'LTU', 440, 370),
(124, 'LU', 'LUXEMBOURG', 'Luxembourg', 'LUX', 442, 352),
(125, 'MO', 'MACAO', 'Macao', 'MAC', 446, 853),
(126, 'MK', 'MACEDONIA, THE FORMER YUGOSLAV REPUBLIC OF', 'Macedonia, the Former Yugoslav Republic of', 'MKD', 807, 389),
(127, 'MG', 'MADAGASCAR', 'Madagascar', 'MDG', 450, 261),
(128, 'MW', 'MALAWI', 'Malawi', 'MWI', 454, 265),
(129, 'MY', 'MALAYSIA', 'Malaysia', 'MYS', 458, 60),
(130, 'MV', 'MALDIVES', 'Maldives', 'MDV', 462, 960),
(131, 'ML', 'MALI', 'Mali', 'MLI', 466, 223),
(132, 'MT', 'MALTA', 'Malta', 'MLT', 470, 356),
(133, 'MH', 'MARSHALL ISLANDS', 'Marshall Islands', 'MHL', 584, 692),
(134, 'MQ', 'MARTINIQUE', 'Martinique', 'MTQ', 474, 596),
(135, 'MR', 'MAURITANIA', 'Mauritania', 'MRT', 478, 222),
(136, 'MU', 'MAURITIUS', 'Mauritius', 'MUS', 480, 230),
(137, 'YT', 'MAYOTTE', 'Mayotte', NULL, NULL, 269),
(138, 'MX', 'MEXICO', 'Mexico', 'MEX', 484, 52),
(139, 'FM', 'MICRONESIA, FEDERATED STATES OF', 'Micronesia, Federated States of', 'FSM', 583, 691),
(140, 'MD', 'MOLDOVA, REPUBLIC OF', 'Moldova, Republic of', 'MDA', 498, 373),
(141, 'MC', 'MONACO', 'Monaco', 'MCO', 492, 377),
(142, 'MN', 'MONGOLIA', 'Mongolia', 'MNG', 496, 976),
(143, 'MS', 'MONTSERRAT', 'Montserrat', 'MSR', 500, 1664),
(144, 'MA', 'MOROCCO', 'Morocco', 'MAR', 504, 212),
(145, 'MZ', 'MOZAMBIQUE', 'Mozambique', 'MOZ', 508, 258),
(146, 'MM', 'MYANMAR', 'Myanmar', 'MMR', 104, 95),
(147, 'NA', 'NAMIBIA', 'Namibia', 'NAM', 516, 264),
(148, 'NR', 'NAURU', 'Nauru', 'NRU', 520, 674),
(149, 'NP', 'NEPAL', 'Nepal', 'NPL', 524, 977),
(150, 'NL', 'NETHERLANDS', 'Netherlands', 'NLD', 528, 31),
(151, 'AN', 'NETHERLANDS ANTILLES', 'Netherlands Antilles', 'ANT', 530, 599),
(152, 'NC', 'NEW CALEDONIA', 'New Caledonia', 'NCL', 540, 687),
(153, 'NZ', 'NEW ZEALAND', 'New Zealand', 'NZL', 554, 64),
(154, 'NI', 'NICARAGUA', 'Nicaragua', 'NIC', 558, 505),
(155, 'NE', 'NIGER', 'Niger', 'NER', 562, 227),
(156, 'NG', 'NIGERIA', 'Nigeria', 'NGA', 566, 234),
(157, 'NU', 'NIUE', 'Niue', 'NIU', 570, 683),
(158, 'NF', 'NORFOLK ISLAND', 'Norfolk Island', 'NFK', 574, 672),
(159, 'MP', 'NORTHERN MARIANA ISLANDS', 'Northern Mariana Islands', 'MNP', 580, 1670),
(160, 'NO', 'NORWAY', 'Norway', 'NOR', 578, 47),
(161, 'OM', 'OMAN', 'Oman', 'OMN', 512, 968),
(162, 'PK', 'PAKISTAN', 'Pakistan', 'PAK', 586, 92),
(163, 'PW', 'PALAU', 'Palau', 'PLW', 585, 680),
(164, 'PS', 'PALESTINIAN TERRITORY, OCCUPIED', 'Palestinian Territory, Occupied', NULL, NULL, 970),
(165, 'PA', 'PANAMA', 'Panama', 'PAN', 591, 507),
(166, 'PG', 'PAPUA NEW GUINEA', 'Papua New Guinea', 'PNG', 598, 675),
(167, 'PY', 'PARAGUAY', 'Paraguay', 'PRY', 600, 595),
(168, 'PE', 'PERU', 'Peru', 'PER', 604, 51),
(169, 'PH', 'PHILIPPINES', 'Philippines', 'PHL', 608, 63),
(170, 'PN', 'PITCAIRN', 'Pitcairn', 'PCN', 612, 0),
(171, 'PL', 'POLAND', 'Poland', 'POL', 616, 48),
(172, 'PT', 'PORTUGAL', 'Portugal', 'PRT', 620, 351),
(173, 'PR', 'PUERTO RICO', 'Puerto Rico', 'PRI', 630, 1787),
(174, 'QA', 'QATAR', 'Qatar', 'QAT', 634, 974),
(175, 'RE', 'REUNION', 'Reunion', 'REU', 638, 262),
(176, 'RO', 'ROMANIA', 'Romania', 'ROM', 642, 40),
(177, 'RU', 'RUSSIAN FEDERATION', 'Russian Federation', 'RUS', 643, 70),
(178, 'RW', 'RWANDA', 'Rwanda', 'RWA', 646, 250),
(179, 'SH', 'SAINT HELENA', 'Saint Helena', 'SHN', 654, 290),
(180, 'KN', 'SAINT KITTS AND NEVIS', 'Saint Kitts and Nevis', 'KNA', 659, 1869),
(181, 'LC', 'SAINT LUCIA', 'Saint Lucia', 'LCA', 662, 1758),
(182, 'PM', 'SAINT PIERRE AND MIQUELON', 'Saint Pierre and Miquelon', 'SPM', 666, 508),
(183, 'VC', 'SAINT VINCENT AND THE GRENADINES', 'Saint Vincent and the Grenadines', 'VCT', 670, 1784),
(184, 'WS', 'SAMOA', 'Samoa', 'WSM', 882, 684),
(185, 'SM', 'SAN MARINO', 'San Marino', 'SMR', 674, 378),
(186, 'ST', 'SAO TOME AND PRINCIPE', 'Sao Tome and Principe', 'STP', 678, 239),
(187, 'SA', 'SAUDI ARABIA', 'Saudi Arabia', 'SAU', 682, 966),
(188, 'SN', 'SENEGAL', 'Senegal', 'SEN', 686, 221),
(189, 'CS', 'SERBIA AND MONTENEGRO', 'Serbia and Montenegro', NULL, NULL, 381),
(190, 'SC', 'SEYCHELLES', 'Seychelles', 'SYC', 690, 248),
(191, 'SL', 'SIERRA LEONE', 'Sierra Leone', 'SLE', 694, 232),
(192, 'SG', 'SINGAPORE', 'Singapore', 'SGP', 702, 65),
(193, 'SK', 'SLOVAKIA', 'Slovakia', 'SVK', 703, 421),
(194, 'SI', 'SLOVENIA', 'Slovenia', 'SVN', 705, 386),
(195, 'SB', 'SOLOMON ISLANDS', 'Solomon Islands', 'SLB', 90, 677),
(196, 'SO', 'SOMALIA', 'Somalia', 'SOM', 706, 252),
(197, 'ZA', 'SOUTH AFRICA', 'South Africa', 'ZAF', 710, 27),
(198, 'GS', 'SOUTH GEORGIA AND THE SOUTH SANDWICH ISLANDS', 'South Georgia and the South Sandwich Islands', NULL, NULL, 0),
(199, 'ES', 'SPAIN', 'Spain', 'ESP', 724, 34),
(200, 'LK', 'SRI LANKA', 'Sri Lanka', 'LKA', 144, 94),
(201, 'SD', 'SUDAN', 'Sudan', 'SDN', 736, 249),
(202, 'SR', 'SURINAME', 'Suriname', 'SUR', 740, 597),
(203, 'SJ', 'SVALBARD AND JAN MAYEN', 'Svalbard and Jan Mayen', 'SJM', 744, 47),
(204, 'SZ', 'SWAZILAND', 'Swaziland', 'SWZ', 748, 268),
(205, 'SE', 'SWEDEN', 'Sweden', 'SWE', 752, 46),
(206, 'CH', 'SWITZERLAND', 'Switzerland', 'CHE', 756, 41),
(207, 'SY', 'SYRIAN ARAB REPUBLIC', 'Syrian Arab Republic', 'SYR', 760, 963),
(208, 'TW', 'TAIWAN, PROVINCE OF CHINA', 'Taiwan, Province of China', 'TWN', 158, 886),
(209, 'TJ', 'TAJIKISTAN', 'Tajikistan', 'TJK', 762, 992),
(210, 'TZ', 'TANZANIA, UNITED REPUBLIC OF', 'Tanzania, United Republic of', 'TZA', 834, 255),
(211, 'TH', 'THAILAND', 'Thailand', 'THA', 764, 66),
(212, 'TL', 'TIMOR-LESTE', 'Timor-Leste', NULL, NULL, 670),
(213, 'TG', 'TOGO', 'Togo', 'TGO', 768, 228),
(214, 'TK', 'TOKELAU', 'Tokelau', 'TKL', 772, 690),
(215, 'TO', 'TONGA', 'Tonga', 'TON', 776, 676),
(216, 'TT', 'TRINIDAD AND TOBAGO', 'Trinidad and Tobago', 'TTO', 780, 1868),
(217, 'TN', 'TUNISIA', 'Tunisia', 'TUN', 788, 216),
(218, 'TR', 'TURKEY', 'Turkey', 'TUR', 792, 90),
(219, 'TM', 'TURKMENISTAN', 'Turkmenistan', 'TKM', 795, 7370),
(220, 'TC', 'TURKS AND CAICOS ISLANDS', 'Turks and Caicos Islands', 'TCA', 796, 1649),
(221, 'TV', 'TUVALU', 'Tuvalu', 'TUV', 798, 688),
(222, 'UG', 'UGANDA', 'Uganda', 'UGA', 800, 256),
(223, 'UA', 'UKRAINE', 'Ukraine', 'UKR', 804, 380),
(224, 'AE', 'UNITED ARAB EMIRATES', 'United Arab Emirates', 'ARE', 784, 971),
(225, 'GB', 'UNITED KINGDOM', 'United Kingdom', 'GBR', 826, 44),
(226, 'US', 'UNITED STATES', 'United States', 'USA', 840, 1),
(227, 'UM', 'UNITED STATES MINOR OUTLYING ISLANDS', 'United States Minor Outlying Islands', NULL, NULL, 1),
(228, 'UY', 'URUGUAY', 'Uruguay', 'URY', 858, 598),
(229, 'UZ', 'UZBEKISTAN', 'Uzbekistan', 'UZB', 860, 998),
(230, 'VU', 'VANUATU', 'Vanuatu', 'VUT', 548, 678),
(231, 'VE', 'VENEZUELA', 'Venezuela', 'VEN', 862, 58),
(232, 'VN', 'VIET NAM', 'Viet Nam', 'VNM', 704, 84),
(233, 'VG', 'VIRGIN ISLANDS, BRITISH', 'Virgin Islands, British', 'VGB', 92, 1284),
(234, 'VI', 'VIRGIN ISLANDS, U.S.', 'Virgin Islands, U.s.', 'VIR', 850, 1340),
(235, 'WF', 'WALLIS AND FUTUNA', 'Wallis and Futuna', 'WLF', 876, 681),
(236, 'EH', 'WESTERN SAHARA', 'Western Sahara', 'ESH', 732, 212),
(237, 'YE', 'YEMEN', 'Yemen', 'YEM', 887, 967),
(238, 'ZM', 'ZAMBIA', 'Zambia', 'ZMB', 894, 260),
(239, 'ZW', 'ZIMBABWE', 'Zimbabwe', 'ZWE', 716, 263);

-- --------------------------------------------------------

--
-- Table structure for table `designation`
--

CREATE TABLE `designation` (
  `designation_id` int(11) NOT NULL,
  `designation_name` varchar(255) NOT NULL,
  `designation_description` text NOT NULL,
  `designation_created_by_user_id` int(11) NOT NULL,
  `designation_created_by_username` varchar(255) NOT NULL,
  `designation_created_date` date NOT NULL,
  `designation_created_time` time NOT NULL,
  `designation_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`, `designation_description`, `designation_created_by_user_id`, `designation_created_by_username`, `designation_created_date`, `designation_created_time`, `designation_status`) VALUES
(1, 'Office staff', '', 0, '', '0000-00-00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `district`
--

CREATE TABLE `district` (
  `district_id` int(11) NOT NULL,
  `state_id_fk` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `district_description` text NOT NULL,
  `district_created_date` date NOT NULL,
  `district_created_time` time NOT NULL,
  `district_created_user_id` int(11) NOT NULL,
  `district_created_user_name` varchar(255) NOT NULL,
  `district_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `district`
--

INSERT INTO `district` (`district_id`, `state_id_fk`, `district_name`, `district_description`, `district_created_date`, `district_created_time`, `district_created_user_id`, `district_created_user_name`, `district_status`) VALUES
(1, 1, 'TRIVANDRUM', '', '0000-00-00', '00:00:00', 0, '', 1),
(2, 1, 'KOLLAM', '', '0000-00-00', '00:00:00', 0, '', 1),
(3, 1, 'PATHANAMTHITTA', '', '0000-00-00', '00:00:00', 0, '', 1),
(4, 1, 'ALLEPY', '', '0000-00-00', '00:00:00', 0, '', 1),
(5, 1, 'KOTTAYAM', '', '0000-00-00', '00:00:00', 0, '', 1),
(6, 1, 'IDUKKI', '', '0000-00-00', '00:00:00', 0, '', 1),
(7, 1, 'COCHIN', '', '0000-00-00', '00:00:00', 0, '', 1),
(8, 1, 'THRISSUR', '', '0000-00-00', '00:00:00', 0, '', 1),
(9, 1, 'PALAKKAD', '', '0000-00-00', '00:00:00', 0, '', 1),
(10, 1, 'MALAPPURAM', '', '0000-00-00', '00:00:00', 0, '', 1),
(11, 1, 'KOZHIKODE', '', '0000-00-00', '00:00:00', 0, '', 1),
(12, 1, 'WAYANAD', '', '0000-00-00', '00:00:00', 0, '', 1),
(13, 1, 'KANNUR', '', '0000-00-00', '00:00:00', 0, '', 1),
(14, 1, 'KASARGOD', '', '0000-00-00', '00:00:00', 0, '', 1),
(16, 4, 'Bangloore', 'hh', '2024-08-28', '08:21:32', 1, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `exclusions`
--

CREATE TABLE `exclusions` (
  `exclusions_id` int(11) NOT NULL,
  `inclusion_exclusion_common_id_fk2` int(11) NOT NULL,
  `exclusions_details` text NOT NULL,
  `exclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exclusions`
--

INSERT INTO `exclusions` (`exclusions_id`, `inclusion_exclusion_common_id_fk2`, `exclusions_details`, `exclusions_status`) VALUES
(1, 1, 'jhjg', 1),
(2, 1, 'jjhg', 1),
(3, 2, 'jkjkas', 1),
(4, 2, 'nnsa', 1),
(5, 2, 'mz', 1),
(6, 3, 'Extra Meals other than mentioned in inclusions', 1),
(7, 3, 'Anything else that is not mentioned in the inclusions', 1),
(8, 3, 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(9, 3, 'Any entry fees/Camera Fees.', 1),
(10, 3, 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1);

-- --------------------------------------------------------

--
-- Table structure for table `guset_count`
--

CREATE TABLE `guset_count` (
  `guset_count_id` int(11) NOT NULL,
  `guset_count_lead_id_fk` int(11) NOT NULL,
  `guset_count_package_id_fk` int(11) NOT NULL,
  `guset_count_type` varchar(255) NOT NULL,
  `guset_count_total` int(11) NOT NULL,
  `guset_count_created_by_userid` int(11) NOT NULL,
  `guset_count_created_by_username` varchar(200) NOT NULL,
  `guset_count_created_date` date NOT NULL,
  `guset_count_created_time` time NOT NULL,
  `guset_count_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guset_count_details`
--

CREATE TABLE `guset_count_details` (
  `guset_count_details_id` int(11) NOT NULL,
  `guset_count_id_fk` int(11) NOT NULL,
  `guset_count_details_type` varchar(250) NOT NULL,
  `pax_count_plan` varchar(255) NOT NULL,
  `adults` int(11) NOT NULL,
  `children` int(11) NOT NULL,
  `total_count` int(11) NOT NULL,
  `guset_count_details_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `hike_room_tariff_hike`
--

CREATE TABLE `hike_room_tariff_hike` (
  `hike_room_tariff_hike_id` int(11) NOT NULL,
  `room_tariff_hike_id_fk` int(11) NOT NULL,
  `hike_properties_id_fk` int(11) NOT NULL,
  `hike_room_tariff_hike_from_date` date NOT NULL,
  `hike_room_tariff_hike_to_date` date NOT NULL,
  `hike_room_tariff_hike_breakfast_rate_adult` double NOT NULL,
  `hike_room_tariff_hike_breakfast_rate_child` double NOT NULL,
  `hike_room_tariff_hike_lunch_rate_adult` double NOT NULL,
  `hike_room_tariff_hike_lunch_rate_child` double NOT NULL,
  `hike_room_tariff_hike_dinner_rate_adult` double NOT NULL,
  `hike_room_tariff_hike_dinner_rate_child` double NOT NULL,
  `hike_room_tariff_hike_description` text NOT NULL,
  `hike_room_tariff_hike_createdby_user_id` int(11) NOT NULL,
  `hike_room_tariff_hike_createdby_user_name` varchar(255) NOT NULL,
  `hike_room_tariff_hike_created_date` date NOT NULL,
  `hike_room_tariff_hike_created_time` time NOT NULL,
  `hike_room_tariff_hike_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hike_room_tariff_hike`
--

INSERT INTO `hike_room_tariff_hike` (`hike_room_tariff_hike_id`, `room_tariff_hike_id_fk`, `hike_properties_id_fk`, `hike_room_tariff_hike_from_date`, `hike_room_tariff_hike_to_date`, `hike_room_tariff_hike_breakfast_rate_adult`, `hike_room_tariff_hike_breakfast_rate_child`, `hike_room_tariff_hike_lunch_rate_adult`, `hike_room_tariff_hike_lunch_rate_child`, `hike_room_tariff_hike_dinner_rate_adult`, `hike_room_tariff_hike_dinner_rate_child`, `hike_room_tariff_hike_description`, `hike_room_tariff_hike_createdby_user_id`, `hike_room_tariff_hike_createdby_user_name`, `hike_room_tariff_hike_created_date`, `hike_room_tariff_hike_created_time`, `hike_room_tariff_hike_status`) VALUES
(1, 65, 41, '2026-10-01', '2026-12-19', 0, 0, 800, 800, 800, 800, '', 1, 'Super admin', '2026-02-27', '12:33:49', 0),
(2, 66, 41, '2026-12-20', '2027-01-05', 0, 0, 800, 800, 800, 800, '', 1, 'Super admin', '2026-02-27', '13:03:10', 1),
(3, 67, 42, '2026-06-01', '2026-09-30', 0, 0, 750, 750, 750, 750, '', 1, 'Super admin', '2026-02-27', '14:05:32', 1),
(4, 67, 42, '2026-12-20', '2027-01-05', 0, 0, 750, 750, 750, 750, '', 1, 'Super admin', '2026-02-27', '14:17:52', 1),
(5, 87, 49, '2026-10-16', '2026-10-21', 0, 0, 600, 500, 600, 500, '', 1, 'Super admin', '2026-03-03', '14:21:02', 1),
(6, 87, 49, '2026-11-06', '2026-11-15', 0, 0, 600, 500, 600, 500, '', 1, 'Super admin', '2026-03-03', '14:23:48', 1),
(7, 87, 49, '2026-12-20', '2026-12-31', 0, 0, 600, 500, 600, 500, '', 1, 'Super admin', '2026-03-03', '14:25:20', 1),
(8, 88, 50, '2026-04-10', '2026-04-15', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '14:45:37', 1),
(9, 90, 50, '2026-08-14', '2026-08-16', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '14:47:18', 1),
(10, 90, 50, '2026-08-25', '2026-08-28', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '14:49:04', 1),
(11, 91, 50, '2026-10-16', '2026-10-21', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '14:51:35', 1),
(12, 91, 50, '2026-11-06', '2026-11-15', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '14:53:09', 1),
(13, 91, 50, '2026-12-20', '2026-12-23', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '14:54:42', 1),
(14, 91, 50, '2026-12-24', '2026-12-31', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '14:55:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hike_room_tariff_hike_rate`
--

CREATE TABLE `hike_room_tariff_hike_rate` (
  `hike_room_tariff_hike_rate_id` int(11) NOT NULL,
  `hike_room_tariff_hike_id_fk` int(11) NOT NULL,
  `hike_room_id_fk` int(11) NOT NULL,
  `hike_room_tariff_hike_rate_room_rate` double NOT NULL,
  `hike_room_tariff_hike_rate_adult_with_extra_bed` double NOT NULL,
  `hike_room_tariff_hike_rate_child_with_extra_bed` double NOT NULL,
  `hike_room_tariff_hike_rate_child_sharing_bed` double NOT NULL,
  `hike_room_tariff_hike_rate_single_occupancy` double NOT NULL,
  `hike_room_tariff_hike_rate_some_days_type` varchar(255) NOT NULL,
  `hike_room_tariff_hike_rate_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hike_room_tariff_hike_rate`
--

INSERT INTO `hike_room_tariff_hike_rate` (`hike_room_tariff_hike_rate_id`, `hike_room_tariff_hike_id_fk`, `hike_room_id_fk`, `hike_room_tariff_hike_rate_room_rate`, `hike_room_tariff_hike_rate_adult_with_extra_bed`, `hike_room_tariff_hike_rate_child_with_extra_bed`, `hike_room_tariff_hike_rate_child_sharing_bed`, `hike_room_tariff_hike_rate_single_occupancy`, `hike_room_tariff_hike_rate_some_days_type`, `hike_room_tariff_hike_rate_status`) VALUES
(1, 1, 75, 5500, 1500, 850, 850, 5500, 'N', 0),
(2, 1, 76, 6000, 1500, 850, 850, 6000, 'N', 0),
(3, 1, 77, 6500, 1500, 850, 850, 6500, 'N', 0),
(4, 1, 78, 9000, 1500, 850, 850, 9000, 'N', 0),
(5, 2, 75, 8000, 2500, 1000, 1000, 8000, 'N', 1),
(6, 2, 76, 9500, 2500, 1000, 1000, 9500, 'N', 1),
(7, 2, 77, 10500, 2500, 1000, 1000, 10500, 'N', 1),
(8, 2, 78, 15000, 2500, 1000, 1000, 15000, 'N', 1),
(9, 3, 79, 3500, 1500, 750, 750, 3500, 'N', 1),
(10, 3, 80, 6000, 1500, 750, 750, 6000, 'N', 1),
(11, 3, 81, 7500, 1500, 750, 750, 7500, 'N', 1),
(12, 4, 79, 6500, 2500, 750, 750, 6500, 'N', 1),
(13, 4, 80, 9000, 2500, 750, 750, 9000, 'N', 1),
(14, 4, 81, 10500, 2500, 750, 750, 10500, 'N', 1),
(15, 5, 100, 3500, 800, 650, 450, 3500, 'N', 1),
(16, 5, 101, 3800, 800, 650, 450, 3800, 'N', 1),
(17, 5, 102, 3800, 800, 650, 450, 3800, 'N', 1),
(18, 5, 103, 4000, 800, 650, 450, 4000, 'N', 1),
(19, 5, 104, 7000, 800, 650, 450, 7000, 'N', 1),
(20, 5, 105, 7500, 800, 650, 450, 7500, 'N', 1),
(21, 6, 100, 4300, 800, 650, 450, 4300, 'N', 1),
(22, 6, 101, 4800, 800, 650, 450, 4800, 'N', 1),
(23, 6, 102, 4800, 800, 650, 450, 4800, 'N', 1),
(24, 6, 103, 5000, 800, 650, 450, 5000, 'N', 1),
(25, 6, 104, 9000, 800, 650, 450, 9000, 'N', 1),
(26, 6, 105, 9500, 800, 650, 450, 9500, 'N', 1),
(27, 7, 100, 4300, 800, 650, 450, 4300, 'N', 1),
(28, 7, 101, 4800, 800, 650, 450, 4800, 'N', 1),
(29, 7, 102, 4800, 800, 650, 450, 4800, 'N', 1),
(30, 7, 103, 5000, 800, 650, 450, 5000, 'N', 1),
(31, 7, 104, 9000, 800, 650, 450, 9000, 'N', 1),
(32, 7, 105, 9500, 800, 650, 450, 9500, 'N', 1),
(33, 8, 106, 3000, 800, 600, 500, 3000, 'N', 1),
(34, 8, 107, 3300, 800, 600, 500, 3300, 'N', 1),
(35, 8, 108, 3600, 800, 600, 500, 3600, 'N', 1),
(36, 8, 109, 3800, 800, 600, 500, 3800, 'N', 1),
(37, 8, 110, 8000, 800, 600, 500, 8000, 'N', 1),
(38, 9, 106, 3000, 800, 600, 500, 3000, 'N', 1),
(39, 9, 107, 3300, 800, 600, 500, 3300, 'N', 1),
(40, 9, 108, 3600, 800, 600, 500, 3600, 'N', 1),
(41, 9, 109, 3800, 800, 600, 500, 3800, 'N', 1),
(42, 9, 110, 8000, 800, 600, 500, 8000, 'N', 1),
(43, 10, 106, 3000, 800, 600, 500, 3000, 'N', 1),
(44, 10, 107, 3300, 800, 600, 500, 3300, 'N', 1),
(45, 10, 108, 3600, 800, 600, 500, 3600, 'N', 1),
(46, 10, 109, 3800, 800, 600, 500, 3800, 'N', 1),
(47, 10, 110, 8000, 800, 600, 500, 8000, 'N', 1),
(48, 11, 106, 3500, 800, 600, 500, 3500, 'N', 1),
(49, 11, 107, 3700, 800, 600, 500, 3700, 'N', 1),
(50, 11, 108, 3800, 800, 600, 500, 3800, 'N', 1),
(51, 11, 109, 4000, 800, 600, 500, 4000, 'N', 1),
(52, 11, 110, 8000, 800, 600, 500, 8000, 'N', 1),
(53, 12, 106, 4500, 800, 600, 500, 4500, 'N', 1),
(54, 12, 107, 4800, 800, 600, 500, 4800, 'N', 1),
(55, 12, 108, 5000, 800, 600, 500, 5000, 'N', 1),
(56, 12, 109, 5200, 800, 600, 500, 5200, 'N', 1),
(57, 12, 110, 10000, 800, 600, 500, 10000, 'N', 1),
(58, 13, 106, 4500, 800, 600, 500, 4500, 'N', 1),
(59, 13, 107, 4800, 800, 600, 500, 4800, 'N', 1),
(60, 13, 108, 5000, 800, 600, 500, 5000, 'N', 1),
(61, 13, 109, 5200, 800, 600, 500, 5200, 'N', 1),
(62, 13, 110, 10000, 800, 600, 500, 10000, 'N', 1),
(63, 14, 106, 4800, 800, 600, 500, 4800, 'N', 1),
(64, 14, 107, 5000, 800, 600, 500, 5000, 'N', 1),
(65, 14, 108, 5000, 800, 600, 500, 5200, 'N', 1),
(66, 14, 109, 5200, 800, 600, 500, 5200, 'N', 1),
(67, 14, 110, 10000, 800, 600, 500, 10000, 'N', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hike_room_tariff_week_days_rate`
--

CREATE TABLE `hike_room_tariff_week_days_rate` (
  `hike_room_tariff_week_days_rate_id` int(11) NOT NULL,
  `hike_room_tariff_hike_rate_id_fk` int(11) NOT NULL,
  `hike_week_days_room_id_fk` int(11) NOT NULL,
  `hike_week_days_id_fk` int(11) NOT NULL,
  `hike_room_tariff_week_days_rate_room_amount` double NOT NULL,
  `hike_room_tariff_week_days_rate_adult_with_extra_bed` double NOT NULL,
  `hike_room_tariff_week_days_rate_child_with_extra_bed` double NOT NULL,
  `hike_room_tariff_week_days_rate_child_sharing_bed` double NOT NULL,
  `hike_room_tariff_week_days_rate_single_occupancy` double NOT NULL,
  `hike_room_tariff_week_days_rate_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `inclusions`
--

CREATE TABLE `inclusions` (
  `inclusions_id` int(11) NOT NULL,
  `inclusion_exclusion_common_id_fk1` int(11) NOT NULL,
  `inclusions_details` text NOT NULL,
  `inclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inclusions`
--

INSERT INTO `inclusions` (`inclusions_id`, `inclusion_exclusion_common_id_fk1`, `inclusions_details`, `inclusions_status`) VALUES
(1, 1, 'gjh', 1),
(2, 1, 'jgg', 1),
(3, 1, 'kkh', 1),
(4, 2, 'nnsa', 1),
(5, 2, 'zxnnzx', 1),
(6, 2, 'zxn', 1),
(7, 3, 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(8, 3, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(9, 3, 'Resort with Breakfast', 1),
(10, 3, 'Houseboat with all meals', 1),
(11, 3, 'Sightseeing as per itinerary', 1),
(12, 3, 'A Professional Driver cum Guide', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inclusion_exclusion_common`
--

CREATE TABLE `inclusion_exclusion_common` (
  `inclusion_exclusion_common_id` int(11) NOT NULL,
  `inclusion_exclusion_common_title` varchar(255) NOT NULL,
  `inclusion_exclusion_common_createdby_user_id` int(11) NOT NULL,
  `inclusion_exclusion_common_createdby_user_name` varchar(255) NOT NULL,
  `inclusion_exclusion_common_created_date` int(11) NOT NULL,
  `inclusion_exclusion_common_created_time` int(11) NOT NULL,
  `inclusion_exclusion_common_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `inclusion_exclusion_common`
--

INSERT INTO `inclusion_exclusion_common` (`inclusion_exclusion_common_id`, `inclusion_exclusion_common_title`, `inclusion_exclusion_common_createdby_user_id`, `inclusion_exclusion_common_createdby_user_name`, `inclusion_exclusion_common_created_date`, `inclusion_exclusion_common_created_time`, `inclusion_exclusion_common_status`) VALUES
(1, 'ghjjg', 1, 'Super admin', 2025, 9, 1),
(2, 'Gajd', 1, 'Super admin', 2026, 4, 1),
(3, 'FOR KERALA - CP PLAN', 1, 'Super admin', 2026, 7, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE `itineraries` (
  `itineraries_id` int(11) NOT NULL,
  `itineraries_category_id_fk` int(11) NOT NULL,
  `itineraries_name` varchar(255) NOT NULL,
  `itineraries_duration_nights` varchar(50) NOT NULL,
  `itineraries_description` text NOT NULL,
  `itineraries_first_cover_page` varchar(255) NOT NULL,
  `itineraries_last_cover_page` varchar(255) NOT NULL,
  `itineraries_createdby_user_id` int(11) NOT NULL,
  `itineraries_created_by_user_name` varchar(255) NOT NULL,
  `itineraries_created_date` date NOT NULL,
  `itineraries_created_time` time NOT NULL,
  `itineraries_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `itineraries`
--

INSERT INTO `itineraries` (`itineraries_id`, `itineraries_category_id_fk`, `itineraries_name`, `itineraries_duration_nights`, `itineraries_description`, `itineraries_first_cover_page`, `itineraries_last_cover_page`, `itineraries_createdby_user_id`, `itineraries_created_by_user_name`, `itineraries_created_date`, `itineraries_created_time`, `itineraries_status`) VALUES
(1, 3, '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', '4', 'HONEYMOON', 'kerala-honeymoon.jpg', 'Kerala-Honeymoon-Package-Price.jpg', 1, 'Super admin', '2026-03-21', '09:34:56', 1),
(2, 3, '3N4D - MUNNAR ALAPPEY COCHIN', '3', 'HONEYMOON', '', 'CommonBRuEXq.png', 1, 'Super admin', '2026-03-23', '06:48:23', 1),
(3, 3, '2N3D - MUNNAR ALAPPEY COCHIN', '2', 'HONEYMOON', '', '', 1, 'Super admin', '2026-03-23', '06:55:03', 1),
(4, 3, '2N3D - MUNNNAR', '2', 'HONEYMOON', 'front_cover.png', 'last_page.png', 1, 'Super admin', '2026-03-23', '07:12:29', 1),
(5, 3, '5N6D - MUNNAR THEKKADY VAGAMON ALAPPEY COCHIN', '5', 'HONEYMOON', 'kerala-honeymoon.jpg', 'Kerala-Honeymoon-Package-Price.jpg', 1, 'Super admin', '2026-03-23', '07:45:25', 1),
(6, 3, '4N5D - MUNNAR ALAPPEY VARKALA TRIVANDRUM', '4', 'HONEYMOON', 'kerala-honeymoon.jpg', 'thekkady-name.jpg', 1, 'Super admin', '2026-03-23', '07:56:49', 1),
(7, 3, '5N6D - MUNNAR THEKKADY ALAPPEY VARKALA TRIVANDRUM', '5', 'HONEYMOON', '1749716093684a8c7d42359.jpeg', 'Hill-Stations-in-kerala-1.jpg', 1, 'Super admin', '2026-03-23', '08:05:48', 1),
(8, 1, '1 Days Traveling', '1', 'n', '25fc85a1b470874fcfa109c4eba03d17.png', 'af399e852a2c0797c6dd404f813c697e.png', 1, 'Super admin', '2026-04-19', '09:18:25', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itineraries_days`
--

CREATE TABLE `itineraries_days` (
  `itineraries_days_id` int(11) NOT NULL,
  `itineraries_id_fk` int(11) NOT NULL,
  `itineraries_days_day` varchar(50) NOT NULL,
  `itineraries_days_destination_id_fk` int(11) NOT NULL,
  `itineraries_days_title` varchar(255) NOT NULL,
  `itineraries_days_image` varchar(255) NOT NULL,
  `itineraries_days_description` text NOT NULL,
  `itineraries_days_travel_back` varchar(255) NOT NULL,
  `itineraries_days_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `itineraries_days`
--

INSERT INTO `itineraries_days` (`itineraries_days_id`, `itineraries_id_fk`, `itineraries_days_day`, `itineraries_days_destination_id_fk`, `itineraries_days_title`, `itineraries_days_image`, `itineraries_days_description`, `itineraries_days_travel_back`, `itineraries_days_status`) VALUES
(1, 1, 'Day 1', 5, 'COCHIN TO MUNNAR', '4961f15ce02e32b288a683f44b54e1d0.webp', '<ul><li>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</li><li>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</li><li>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</li><li>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</li><li>Overnight stay at the Hotel / Resort</li></ul>', '', 1),
(2, 1, 'Day 2', 5, 'MUNNAR SIGHTSEEING', 'a2250a3d8c29ec5a9b0805fb960af566.webp', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park </strong>where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 1),
(3, 1, 'Day 3', 6, 'MUNNAR TO THEKKADY', '723b18f4256acdbdc2f52b3b37440337.jpg', '<ul><li>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</li><li>Take a boat cruise on <strong>Periyar Lake in Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to spot wildlife like elephants, deer, and birds.</li><li>Experience a memorable <strong>Elephant encounter with rides, bathing, and feeding</strong></li><li>End the evening with mesmerizing cultural performances of <strong>Kathakaliand Kerala’s traditional martial arts</strong></li><li>Overnight stay in the Hotel/ Resort.</li></ul>', '', 1),
(4, 1, 'Day 4', 7, 'THEKKADY TO ALAPPEY', '344eb76794ff5af0d0984cbeb6234f99.jpg', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East’</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerable lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 1),
(5, 1, 'Day 5', 20, 'ALAPPEY TO COCHIN', '1e37b6fa643f490880c9df9b646fc9d0.webp', '<ul><li>After breakfast, checkout from the Houseboat and drive towards <strong>Cochin</strong>; the Queen of the Arabian Sea</li><li>On the sightsseen:- <strong>Marari Beach, Arthunkal Basilica</strong></li><li>Arriving in Cochin, Visit <strong>Forklore Museum, Cochin Backwaters, St Francis Church, Mattanchery Palace (Dutch Palace), Jewish Synagogue and Jew Town, Fort Kochi Beach.</strong></li><li>Take a stroll along the fort kochi waterfront to see the iconic chineese fishing nets</li><li>Local shopping and drop at Ernakulam Railway/ Cochin Airport</li></ul>', 'TB', 1),
(6, 2, 'Day 1', 5, 'COCHIN TO MUNNAR', '88bcc943e87259e4bca91fc7c86db5f7.webp', '<ul><li>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</li><li>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</li><li>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</li><li>Other Sightseeing/Activity places:- <strong>Adventure Park</strong> (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</li><li>Overnight stay at the Hotel / Resort</li></ul>', '', 1),
(7, 2, 'Day 2', 5, 'MUNNAR SIGHTSEEING', 'eff47e035f4baf32c14880835e9e9776.jpg', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 1),
(8, 2, 'Day 3', 7, 'MUNNAR TO ALAPPEY', 'd042c803ed73ec0356da663781e704cf.png', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East’</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerable lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 1),
(9, 2, 'Day 4', 20, 'ALAPPEY TO COCHIN', 'caa0808b8b789a44fd06bd9f28ae4761.jpg', '<ul><li>After breakfast, checkout from the Houseboat and drive towards <strong>Cochin</strong>; the Queen of the Arabian Sea</li><li>On the sightsseen:- <strong>Marari Beach, Arthunkal Basilica</strong></li><li>Arriving in Cochin, Visit <strong>Forklore Museum, Cochin Backwaters, St Francis Church, Mattanchery Palace (Dutch Palace), Jewish Synagogue and Jew Town, Fort Kochi Beach.</strong></li><li>Take a stroll along the fort kochi waterfront to see the iconic chineese fishing nets</li><li>Local shopping and drop at Ernakulam Railway/ Cochin Airport</li></ul>', 'TB', 1),
(10, 3, 'Day 1', 5, 'COCHIN TO MUNNAR', '1c27c5ad80ac9e33f11c3fe05f697ae0.webp', '<ul><li>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</li><li>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</li><li>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</li><li>After Arriving Munnar, Get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Overnight stay At Munnar</li></ul>', '', 1),
(11, 3, 'Day 2', 7, 'MUNNAR TO ALAPPEY', 'd98c9c6cd19224f050bbf55da268c546.png', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East’</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerable lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 1),
(12, 3, 'Day 3', 20, 'ALAPPEY TO COCHIN', '6ea5940f527a7032729438bcc706d93a.jpg', '<ul><li>After breakfast, checkout from the Houseboat and drive towards <strong>Cochin</strong>; the Queen of the Arabian Sea</li><li>On the sightsseen:- <strong>Marari Beach, Arthunkal Basilica</strong></li><li>Arriving in Cochin, Visit <strong>Forklore Museum, Cochin Backwaters, St Francis Church, Mattanchery Palace (Dutch Palace), Jewish Synagogue and Jew Town, Fort Kochi Beach.</strong></li><li>Take a stroll along the fort kochi waterfront to see the iconic chineese fishing nets</li><li>Local shopping and drop at Ernakulam Railway/ Cochin Airport</li></ul>', 'TB', 1),
(13, 4, 'Day 1', 5, 'COCHIN TO MUNNAR', '0c101f32f20448ed5592333648e93673.webp', '<ul><li>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</li><li>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</li><li>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</li><li>Experience the rich cultural heritage of Kerala with a captivating <strong>Kathakali performance</strong> followed by an exhilarating Kalaripayattu <strong>martial arts </strong>demonstration.</li><li>Overnight stay at the Hotel / Resort</li></ul>', '', 1),
(14, 4, 'Day 2', 5, 'MUNNAR SIGHTSEEING', 'fd1e9a9a4bec13e0819fa038011f58fb.png', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park </strong>where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 1),
(15, 4, 'Day 3', 5, 'MUNNAR TO COCHIN', '5664186db683f2bdc97595a144845351.png', '<ul><li>After Checkout, Experience breathtaking views of the tea gardens and rolling hills with a <strong>Hot air balloon ride</strong>. Ensure you book this in advance as it might be weather-dependent.</li><li>Visit a local <strong>handloom factory</strong> to see traditional weaving techniques and purchase some beautiful handwoven textiles.</li><li>Head to a <strong>chocolate factory</strong> to see how local chocolates are made and sample some delicious treats.</li><li>Head back to Kochi for your onward journey or return home.</li></ul>', 'TB', 1),
(16, 5, 'Day 1', 5, 'COCHIN TO MUNNAR', 'eb3edba77ee12196216895657c4ee490.webp', '<ul><li>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</li><li>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</li><li>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</li><li>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</li><li>Overnight stay at the Hotel / Resort</li></ul>', '', 1),
(17, 5, 'Day 2', 5, 'MUNNAR SIGHTSEEING', 'b05d531f4756c122728d6a48705de715.jpg', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</li><li>Afternoon you will head towards the Eravikulam National park where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 1),
(18, 5, 'Day 3', 6, 'MUNNAR TO THEKKADY', '639fd1afab009ab7931e4906b644db7b.jpg', '<ul><li>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</li><li>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to spot wildlife like elephants, deer, and birds.</li><li>Experience a memorable <strong>Elephant encounter with rides, bathing, and feeding.</strong></li><li>End the evening with mesmerizing cultural performances of <strong>Kathakali and Kerala’s traditional martial arts.</strong></li><li>Overnight stay in the Hotel/ Resort.</li></ul>', '', 1),
(19, 5, 'Day 4', 12, 'THEKKADY TO VAGAMON', 'a8919702279d13a4335983d01c966377.avif', '<p>Checkout from Resort and Head to <strong>Vagamon</strong>. Arriving in Vagamon,</p><p>Head to<strong> Vagamon Meadows</strong>. Spend time walking through the lush green meadows, taking in the serene landscape, and capturing beautiful photos.</p><p>Visit the Vagamon <strong>Pine Forests</strong>. Enjoy a peaceful walk among the towering pine trees and appreciate the cool, fresh air.</p><p>Visit <strong>Thangalpara</strong>, a sacred site for Muslims and a place of historical significance.</p><p>Overnight stay at Vagamon</p>', '', 1),
(20, 5, 'Day 5', 7, 'VAGAMON TO ALAPPEY', '0516a506c2c74858565cbab83163eb45.png', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East’</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerable lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 1),
(21, 5, 'Day 6', 20, 'ALAPPEY TO COCHIN', '04f9162ac10bf1b2ce7963181f3e457a.jpg', '<ul><li>After breakfast, checkout from the Houseboat and drive towards <strong>Cochin</strong>; the Queen of the Arabian Sea</li><li>On the sightsseen:- <strong>Marari Beach, Arthunkal Basilica</strong></li><li>Arriving in Cochin, Visit <strong>Forklore Museum, Cochin Backwaters, St Francis Church, Mattanchery Palace (Dutch Palace), Jewish Synagogue and Jew Town, Fort Kochi Beach.</strong></li><li>Take a stroll along the fort kochi waterfront to see the iconic chineese fishing nets</li><li>Local shopping and drop at Ernakulam Railway/ Cochin Airport</li></ul>', 'TB', 1),
(22, 6, 'Day 1', 5, 'COCHIN TO MUNNAR', '5075df7dbbc41e91b17f18c9a8a31ed9.webp', '<ul><li>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</li><li>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</li><li>Enjoy a guided tour of the lush<strong> Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</li><li>Other Sightseeing/Activity places:- <strong>Adventure Park</strong> (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</li><li>Overnight stay at the Hotel / Resort</li></ul>', '', 1),
(23, 6, 'Day 2', 5, 'MUNNAR SIGHTSEEING', '5e26b3a31e1aef39a3e19d43346f524d.jpg', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.&nbsp;</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 1),
(24, 6, 'Day 3', 7, 'MUNNAR TO ALAPPEY', '49bf3b25654660061561e28345810ef0.png', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East’</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerable lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 1),
(25, 6, 'Day 4', 8, 'ALAPPEY TO VARKALA', '4478cc275b0d50d50a537dd6bd0c5916.webp', '<ul><li>After breakfast, check-out from the Houseboat &amp; From the ‘Backwater Capital , today you will be driving to <strong>Varkala</strong>.</li><li>On the way, we will Drive to Chadayamangalam to explore the <strong>Jatayu earth Centre</strong>. The giant concrete statue of Jatayu is built on a mighty rock named Jatayupara (para means rock in Malayalam).</li><li>Reach Varkala, explore <strong>Varkala Cliff &amp; Beach, Black Sand Beach, Sri Janardhana Swami Temple, Kappil Beach</strong>.</li><li>You can explore variety of <strong>water sports</strong> icluding Jet skiing, Parasailing, Banana boat rides and kayaking.</li><li>Overnight Stay at the resort/hotel in Varkala/Trivandrum</li></ul>', '', 1),
(26, 6, 'Day 5', 21, 'VARKALA TO TRIVANDRUM', 'ca88ad007bf314ed0bc3bc7871f94515.jpeg', '<ul><li>Checkout from Resort &amp; Get ready to explore <strong>Trivandrum</strong></li><li>Visit to the iconic <strong>Sree Padmanabhaswamy Temple</strong>, one of the richest and most famous temples in India. (Men need to wear a dhoti and women a saree or a long skirt and blouse)</li><li>Visit the <strong>Napier Museum</strong>, which houses a vast collection of historical artifacts, bronze idols, ancient ornaments, and a temple chariot.</li><li>Explore the <strong>Trivandrum Zoo</strong>, one of the oldest zoos in India, located within the museum complex. It houses a wide variety of animals, birds, and reptiles in lush, green surroundings.</li><li>Local shopping &amp; Drop at Trivandrum Airport/ Railway</li></ul>', 'TB', 1),
(27, 7, 'Day 1', 5, 'COCHIN TO MUNNAR', '0f327aaefdbc2d66532aff5ef5c557a8.webp', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</p><p>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- <strong>Adventure Park</strong> (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 1),
(28, 7, 'Day 2', 5, 'MUNNAR SIGHTSEEING', '202f144417cd377abb1ee50f4df7ccfc.webp', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 1),
(29, 7, 'Day 3', 6, 'MUNNAR TO THEKKADY', '8f2ded93a157587b47363cd685368715.jpg', '<ul><li>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</li><li>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to spot wildlife like elephants, deer, and birds.</li><li>Experience a memorable <strong>Elephant encounter with rides, bathing, and feeding</strong></li><li>End the evening with mesmerizing cultural performances of <strong>Kathakali and Kerala’s traditional martial arts</strong></li><li>Overnight stay in the Hotel/ Resort.</li></ul>', '', 1),
(30, 7, 'Day 4', 7, 'THEKKADY TO ALAPPEY', '9b471bdc0cf7474a258113011dc43ed1.png', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East.</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerabl lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 1),
(31, 7, 'Day 5', 8, 'ALAPPEY TO VARKALA', 'fe19cd206e29ba135dff0ea23676096b.webp', '<ul><li>After breakfast, check-out from the Houseboat &amp; From the ‘Backwater Capital , today you will be driving to <strong>Varkala</strong>.</li><li>On the way, we will Drive to Chadayamangalam to explore the <strong>Jatayu earth Centre</strong>. The giant concrete statue of Jatayu is built on a mighty rock named Jatayupara (para means rock in Malayalam).</li><li>Reach Varkala, explore <strong>Varkala Cliff &amp; Beach, Black Sand Beach, Sri Janardhana Swami Temple, Kappil Beach.</strong></li><li>You can explore variety of <strong>water sports</strong> icluding Jet skiing, Parasailing, Banana boat rides and kayaking.</li><li>Overnight Stay at the resort/hotel in Varkala/Trivandrum</li></ul>', '', 1),
(32, 7, 'Day 6', 21, 'VARKALA TO TRIVANDRUM', 'ca3dc1d9e5ca6dcee62c432e3276de87.jpeg', '<ul><li>Checkout from Resort &amp; Get ready to explore Trivandrum Visit to the iconic <strong>Sree Padmanabhaswamy Temple</strong>, one of the richest and most famous temples in India. (Men need to wear a dhoti and women a saree or a long skirt and blouse)</li><li>Visit the <strong>Napier Museum</strong>, which houses a vast collection of historical artifacts, bronze idols, ancient ornaments, and a temple chariot.</li><li>Explore the <strong>Trivandrum Zoo</strong>, one of the oldest zoos in India, located within the museum complex. It houses a wide variety of animals, birds, and reptiles in lush, green surroundings.</li><li>Local shopping &amp; Drop at Trivandrum Airport/ Railway</li></ul>', 'TB', 1),
(33, 8, 'Day 1', 7, 'Travel from Alappey', '7c1acf1aac3d8da7132da74e757dea5a.jpeg', '<p>Travel description</p>', '', 1),
(34, 8, 'Day 2', 11, 'Athirapilly', '380c69aebe71325615fd7f963f731f39.jpeg', '<p>Description&nbsp;</p>', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itinerary_category`
--

CREATE TABLE `itinerary_category` (
  `itinerary_category_id` int(11) NOT NULL,
  `itinerary_category_name` varchar(255) NOT NULL,
  `itinerary_category_description` text NOT NULL,
  `itinerary_category_createdby_user_id` int(11) NOT NULL,
  `itinerary_category_createdby_user_name` varchar(255) NOT NULL,
  `itinerary_category_created_date` date NOT NULL,
  `itinerary_category_created_time` time NOT NULL,
  `itinerary_category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `itinerary_category`
--

INSERT INTO `itinerary_category` (`itinerary_category_id`, `itinerary_category_name`, `itinerary_category_description`, `itinerary_category_createdby_user_id`, `itinerary_category_createdby_user_name`, `itinerary_category_created_date`, `itinerary_category_created_time`, `itinerary_category_status`) VALUES
(1, 'Friends', '', 1, 'Super admin', '2025-08-30', '10:11:11', 1),
(2, 'Family', '', 1, 'Super admin', '2026-01-25', '03:19:39', 1),
(3, 'Honeymoon', '', 1, 'Super admin', '2026-02-07', '12:18:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE `leads` (
  `leads_id` int(11) NOT NULL,
  `staff_id_fk` int(11) NOT NULL,
  `source_id_fk` int(11) NOT NULL,
  `package_id_fk` int(11) NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `priority_status_id_fk` int(11) NOT NULL,
  `stage_id_fk` int(11) NOT NULL,
  `agent_id_fk` int(11) NOT NULL,
  `leads_number` varchar(255) NOT NULL,
  `lead_type` varchar(50) NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `lead_register_date` date NOT NULL,
  `date_type` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` varchar(50) NOT NULL,
  `whats_number` varchar(255) NOT NULL,
  `alternative_number` varchar(255) NOT NULL,
  `leads_email` varchar(255) NOT NULL,
  `leads_address` text NOT NULL,
  `total_package_cost` double NOT NULL,
  `expense` double NOT NULL,
  `margin` double NOT NULL,
  `lead_current_status` int(11) NOT NULL,
  `leads_accomodation_status` int(11) NOT NULL DEFAULT 0,
  `leads_quotation_status` int(11) NOT NULL,
  `description` text NOT NULL,
  `leads_created_date` date NOT NULL,
  `leads_created_time` time NOT NULL,
  `leads_createdby_userid` int(11) NOT NULL,
  `leads_createdby_username` varchar(255) NOT NULL,
  `leads_status` int(11) NOT NULL,
  `meta_leadgen_id` varchar(50) DEFAULT NULL,
  `meta_page_id` varchar(50) DEFAULT NULL,
  `meta_form_id` varchar(50) DEFAULT NULL,
  `meta_ad_id` varchar(50) DEFAULT NULL,
  `lead_source` varchar(100) DEFAULT NULL,
  `raw_meta_json` longtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE `login_logs` (
  `login_logs_id` int(11) NOT NULL,
  `login_logs_user_id_fk` int(11) NOT NULL,
  `login_logs_session_id` varchar(500) NOT NULL,
  `login_logs_user_type` varchar(250) NOT NULL,
  `login_logs_admin_name` varchar(255) NOT NULL,
  `login_logs_date` date NOT NULL,
  `login_logs_date_time` datetime NOT NULL,
  `logout_logs_date_time` datetime NOT NULL,
  `login_logs_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_logs`
--

INSERT INTO `login_logs` (`login_logs_id`, `login_logs_user_id_fk`, `login_logs_session_id`, `login_logs_user_type`, `login_logs_admin_name`, `login_logs_date`, `login_logs_date_time`, `logout_logs_date_time`, `login_logs_status`) VALUES
(1, 1, 'ecd8ffda8d0025c9bbb51456b129ecf09b2dfaed', 'A', 'Super admin', '2025-08-29', '2025-08-29 11:03:23', '0000-00-00 00:00:00', 1),
(2, 1, 'ecd8ffda8d0025c9bbb51456b129ecf09b2dfaed', 'A', 'Super admin', '2025-08-29', '2025-08-29 11:03:57', '0000-00-00 00:00:00', 1),
(3, 1, '5456b182d2106584a1fd9f9b36add01f22a5522f', 'A', 'Super admin', '2025-08-30', '2025-08-30 10:10:50', '0000-00-00 00:00:00', 1),
(4, 1, 'd3b58dfac9f5759603f3eb53efc1be428e2e662d', 'A', 'Super admin', '2025-08-30', '2025-08-30 08:04:41', '0000-00-00 00:00:00', 1),
(5, 1, '7fb95b5fa94b81467bab7b32831c60243968eca5', 'A', 'Super admin', '2025-08-31', '2025-08-31 07:50:44', '0000-00-00 00:00:00', 1),
(6, 1, 'a027a75ffa2b07024260e18602c43d91e47ae90e', 'A', 'Super admin', '2025-09-01', '2025-09-01 08:09:56', '0000-00-00 00:00:00', 1),
(7, 1, '81f7a06d0c858de1e028f0fc9416d0317cce339f', 'A', 'Super admin', '2025-09-01', '2025-09-01 11:29:00', '0000-00-00 00:00:00', 1),
(8, 1, '81f7a06d0c858de1e028f0fc9416d0317cce339f', 'A', 'Super admin', '2025-09-01', '2025-09-01 11:29:47', '0000-00-00 00:00:00', 1),
(9, 1, 'a1e68a19f0f6699d05f8824c0d1b6d2fe1012625', 'A', 'Super admin', '2025-09-03', '2025-09-03 08:06:26', '0000-00-00 00:00:00', 1),
(10, 1, 'dbc7caee99a6c4205b5cc4d75127123537183246', 'A', 'Super admin', '2025-09-03', '2025-09-03 09:21:05', '0000-00-00 00:00:00', 1),
(11, 1, '667837569b8057a9b69f12d95df9aa5c60b13505', 'A', 'Super admin', '2025-09-04', '2025-09-04 08:03:26', '0000-00-00 00:00:00', 1),
(12, 1, 'ee9bdd9c7f8d7e715314156ab84a991faecf191b', 'A', 'Super admin', '2025-09-04', '2025-09-04 08:32:21', '0000-00-00 00:00:00', 1),
(13, 1, '0b7a26d67d1061db9ae32eb7114f8d24d01b85af', 'A', 'Super admin', '2025-09-05', '2025-09-05 12:22:09', '0000-00-00 00:00:00', 1),
(14, 1, 'f96ae56f3616de732c8e12ac7cad6b3062b81600', 'A', 'Super admin', '2025-09-06', '2025-09-06 12:40:25', '0000-00-00 00:00:00', 1),
(15, 1, '009a17eb9be090d8e468d094fcec13432c6841eb', 'A', 'Super admin', '2025-09-06', '2025-09-06 04:20:03', '0000-00-00 00:00:00', 1),
(16, 1, '4a95805a3c731c7ff7dcb95a7d94cbfc243510be', 'A', 'Super admin', '2025-09-07', '2025-09-07 06:23:09', '0000-00-00 00:00:00', 1),
(17, 1, 'beddee48d60c0e9ebc91658a47322f8827c038fd', 'A', 'Super admin', '2025-09-08', '2025-09-08 09:17:04', '0000-00-00 00:00:00', 1),
(18, 1, '0ec639c3a5e74b7c95ecee5cc225bed1f379b00d', 'A', 'Super admin', '2025-09-09', '2025-09-09 07:50:31', '0000-00-00 00:00:00', 1),
(19, 1, '72342981364d02b016ebd9c6a9cf1afc61a05350', 'A', 'Super admin', '2025-09-12', '2025-09-12 08:50:37', '0000-00-00 00:00:00', 1),
(20, 1, 'acf08ca327dc284fd3f5b756c0faa2074c103e06', 'A', 'Super admin', '2025-09-13', '2025-09-13 12:04:33', '0000-00-00 00:00:00', 1),
(21, 1, 'e4001e31720e5001e919dab8c5d01d34f4ed54c0', 'A', 'Super admin', '2025-09-16', '2025-09-16 12:08:36', '0000-00-00 00:00:00', 1),
(22, 1, '8f0b03ee8688c8d46b4dad77132f67970454ca36', 'A', 'Super admin', '2025-09-20', '2025-09-20 09:55:33', '0000-00-00 00:00:00', 1),
(23, 1, '586175ab546f0c67fd196eb6d33c7a74f5c7a403', 'A', 'Super admin', '2025-09-22', '2025-09-22 07:48:19', '0000-00-00 00:00:00', 1),
(24, 1, '61c8efd903741044a944916a2b9eaa9f4e4bb538', 'A', 'Super admin', '2025-09-25', '2025-09-25 08:08:31', '0000-00-00 00:00:00', 1),
(25, 1, '61c8efd903741044a944916a2b9eaa9f4e4bb538', 'A', 'Super admin', '2025-09-25', '2025-09-25 08:08:31', '0000-00-00 00:00:00', 1),
(26, 1, 'ce7409faa3f88e1079613547ac66e67d30c3ca5d', 'A', 'Super admin', '2025-09-27', '2025-09-27 05:46:26', '0000-00-00 00:00:00', 1),
(27, 1, '2fa605d34edc3dba6a958ac56147a9579d9f135c', 'A', 'Super admin', '2025-09-29', '2025-09-29 07:54:44', '0000-00-00 00:00:00', 1),
(28, 1, '842fbccfa735c03814156dd41f5ffbaa849f530b', 'A', 'Super admin', '2025-09-29', '2025-09-29 02:11:26', '0000-00-00 00:00:00', 1),
(29, 1, '1e00d79a1881dd962fe1135d0dd5cee9771fe8d4', 'A', 'Super admin', '2025-09-30', '2025-09-30 10:11:35', '0000-00-00 00:00:00', 1),
(30, 1, '550f79d1d68093cf8dfe4c4daa5e798a1ad48890', 'A', 'Super admin', '2025-10-01', '2025-10-01 09:45:42', '0000-00-00 00:00:00', 1),
(31, 1, '72bcda7022f706f9a9814a5e593bed955b75d65a', 'A', 'Super admin', '2025-10-05', '2025-10-05 08:39:44', '0000-00-00 00:00:00', 1),
(32, 1, '732d2cdc83e27f9dcf8483887f369d4e9ef59aad', 'A', 'Super admin', '2025-10-07', '2025-10-07 10:12:04', '0000-00-00 00:00:00', 1),
(33, 1, '9db6d61c72d17e9aedae31fd839b0cf04e409b9f', 'A', 'Super admin', '2025-10-09', '2025-10-09 07:57:50', '0000-00-00 00:00:00', 1),
(34, 1, '77441f3ed6e6dad309ef57e96c71eabf5ead20fb', 'A', 'Super admin', '2025-10-21', '2025-10-21 07:50:16', '0000-00-00 00:00:00', 1),
(35, 1, 'bb140646360d8fbf971ded7b0df777bf826d37e1', 'A', 'Super admin', '2025-10-26', '2025-10-26 04:22:15', '0000-00-00 00:00:00', 1),
(36, 1, '129c53126c84460c4c2277332fb56a781af9ca0a', 'A', 'Super admin', '2025-10-27', '2025-10-27 08:21:53', '0000-00-00 00:00:00', 1),
(37, 1, '39076b2251ff9cead38890ba7b428934d26ac939', 'A', 'Super admin', '2025-11-01', '2025-11-01 02:37:32', '0000-00-00 00:00:00', 1),
(38, 1, '7b633e83d9d95a1c77a8d16220dcee3aa3fcb3c9', 'A', 'Super admin', '2025-11-07', '2025-11-07 08:27:10', '0000-00-00 00:00:00', 1),
(39, 1, '0c10d151aad795ee41afa547328552125612b93c', 'A', 'Super admin', '2025-11-08', '2025-11-08 12:39:19', '0000-00-00 00:00:00', 1),
(40, 1, '264283eeff99e8f092c16ec5484e769f72429e7c', 'A', 'Super admin', '2025-11-10', '2025-11-10 09:16:22', '0000-00-00 00:00:00', 1),
(41, 1, 'f36a3183983cf1594448043da1a17cf10e73d6f6', 'A', 'Super admin', '2025-11-12', '2025-11-12 01:00:46', '0000-00-00 00:00:00', 1),
(42, 1, '21724873dfb93e7e1e252241d5c1a12a096c2bb3', 'A', 'Super admin', '2025-11-20', '2025-11-20 12:32:57', '0000-00-00 00:00:00', 1),
(43, 1, '75ea0a564e8d3420fc6a22094180df099ae59778', 'A', 'Super admin', '2025-11-21', '2025-11-21 11:22:28', '0000-00-00 00:00:00', 1),
(44, 1, '2002906c142864612b489d62e22f349891a6d339', 'A', 'Super admin', '2025-12-05', '2025-12-05 08:32:02', '0000-00-00 00:00:00', 1),
(45, 1, 'eafde657e15adf07fe0a9fd5abacab9c85f188c3', 'A', 'Super admin', '2025-12-16', '2025-12-16 02:50:13', '0000-00-00 00:00:00', 1),
(46, 1, '65187221285d061a69cddef3bdb583b4d881b343', 'A', 'Super admin', '2025-12-21', '2025-12-21 09:13:50', '0000-00-00 00:00:00', 1),
(47, 1, '3e4d973600db7a658a3ec4d9967704c58fa32dc1', 'A', 'Super admin', '2025-12-21', '2025-12-21 09:39:46', '0000-00-00 00:00:00', 1),
(48, 1, '5ef8ef10195ce823975626b62cca6d94469490eb', 'A', 'Super admin', '2025-12-22', '2025-12-22 02:19:26', '0000-00-00 00:00:00', 1),
(49, 1, '3315636a995504613079fffe7a1e360bef973c30', 'A', 'Super admin', '2025-12-25', '2025-12-25 08:22:40', '0000-00-00 00:00:00', 1),
(50, 1, '0d06f22738306542c75720319defdbde219d2a8c', 'A', 'Super admin', '2025-12-26', '2025-12-26 09:45:10', '0000-00-00 00:00:00', 1),
(51, 1, 'e733d3ca8c4edf00dcc233bbb6ce639fb0e4ceed', 'A', 'Super admin', '2025-12-27', '2025-12-27 01:01:06', '0000-00-00 00:00:00', 1),
(52, 1, '07a5579e9b02ad6d297b7593db62dc0b4d121e6a', 'A', 'Super admin', '2025-12-31', '2025-12-31 06:54:50', '0000-00-00 00:00:00', 1),
(53, 1, '08f10039491d45a19c719c1cf45258805b2b1317', 'A', 'Super admin', '2026-01-01', '2026-01-01 10:39:39', '0000-00-00 00:00:00', 1),
(54, 1, '2fb848c5d9da94d75d6e8f3ee17e3e3fad87ff41', 'A', 'Super admin', '2026-01-02', '2026-01-02 07:43:12', '0000-00-00 00:00:00', 1),
(55, 1, '054ec98f50c3805a3a7609cb7ff5ac53862b6d14', 'A', 'Super admin', '2026-01-02', '2026-01-02 08:34:47', '0000-00-00 00:00:00', 1),
(56, 1, 'c65326338195bd77db223e33632a9fef663a67ae', 'A', 'Super admin', '2026-01-05', '2026-01-05 01:39:18', '0000-00-00 00:00:00', 1),
(57, 1, '59467f18e97c72576083f80867590bfbc8b20f77', 'A', 'Super admin', '2026-01-08', '2026-01-08 09:35:14', '0000-00-00 00:00:00', 1),
(58, 1, '62bd715b1d2464027f8449c1694366860ee90228', 'A', 'Super admin', '2026-01-08', '2026-01-08 01:16:42', '0000-00-00 00:00:00', 1),
(59, 1, '2a60b9bf7fe925ac209ad41639959fc37b2d4dd0', 'A', 'Super admin', '2026-01-10', '2026-01-10 09:11:54', '0000-00-00 00:00:00', 1),
(60, 1, '9beb4b433a184f84d3e840757b57ab64d90ba9d8', 'A', 'Super admin', '2026-01-12', '2026-01-12 04:55:40', '0000-00-00 00:00:00', 1),
(61, 1, '77dab9b3346a4d4a0c3820381934191cb4055b23', 'A', 'Super admin', '2026-01-14', '2026-01-14 10:31:32', '0000-00-00 00:00:00', 1),
(62, 1, '58c3f42bab77a30e9c61073ffbb93e83b504ada1', 'A', 'Super admin', '2026-01-14', '2026-01-14 02:29:41', '0000-00-00 00:00:00', 1),
(63, 1, '79972f288b4223bff7350eca14067f53743c96b7', 'A', 'Super admin', '2026-01-17', '2026-01-17 09:01:33', '0000-00-00 00:00:00', 1),
(64, 1, '380cb80dacfd191ddbea742273bb6fe73faedb35', 'A', 'Super admin', '2026-01-18', '2026-01-18 09:38:24', '0000-00-00 00:00:00', 1),
(65, 1, 'd747b7f0fb6540b74b435aea95605535387ac85a', 'A', 'Super admin', '2026-01-20', '2026-01-20 12:12:47', '0000-00-00 00:00:00', 1),
(66, 1, '10caf9c5404646edbddd044b690572dd001323bf', 'A', 'Super admin', '2026-01-22', '2026-01-22 01:14:28', '0000-00-00 00:00:00', 1),
(67, 1, '715e854d9b5fb0c388cb011838d0b912376e306f', 'A', 'Super admin', '2026-01-22', '2026-01-22 10:48:21', '0000-00-00 00:00:00', 1),
(68, 1, '8fb23202d0ab8ccb1836936efb6a1bfb20f19405', 'A', 'Super admin', '2026-01-23', '2026-01-23 11:58:12', '0000-00-00 00:00:00', 1),
(69, 1, '7a145fb65deade5df4c8572e29042093df6417e9', 'A', 'Super admin', '2026-01-23', '2026-01-23 04:58:49', '0000-00-00 00:00:00', 1),
(70, 1, '90e84779425d799da160feadb380d38d692f72c3', 'A', 'Super admin', '2026-01-23', '2026-01-23 08:43:19', '0000-00-00 00:00:00', 1),
(71, 1, '71fe932711aa9cc787b4482cfb132d12aa7994d8', 'A', 'Super admin', '2026-01-23', '2026-01-23 08:47:13', '0000-00-00 00:00:00', 1),
(72, 1, 'eb7e012db4994dac1ab3e3dad70a97fd9b4671ca', 'A', 'Super admin', '2026-01-24', '2026-01-24 01:35:52', '0000-00-00 00:00:00', 1),
(73, 1, 'c9d2256d2cd560089aa39d8df578d66951732767', 'A', 'Super admin', '2026-01-24', '2026-01-24 08:19:36', '0000-00-00 00:00:00', 1),
(74, 1, 'edb6a1129f7f7cf165e75735cc7c7b4cfc0dead5', 'A', 'Super admin', '2026-01-25', '2026-01-25 02:48:25', '0000-00-00 00:00:00', 1),
(75, 1, '858ce1f7f4dbba9d3017fef04452f2e987605c55', 'A', 'Super admin', '2026-01-26', '2026-01-26 10:07:55', '0000-00-00 00:00:00', 1),
(76, 1, 'a3bd1397e0a35b7817c3da4c6999ba03046a9c5a', 'A', 'Super admin', '2026-01-27', '2026-01-27 11:59:59', '0000-00-00 00:00:00', 1),
(77, 1, 'd067c6a949f47c8cadc61210406cfcdb7a72441d', 'A', 'Super admin', '2026-01-28', '2026-01-28 12:03:28', '0000-00-00 00:00:00', 1),
(78, 1, 'f19391643251705aab2fb5dd6cb6ffc2f9e906a1', 'A', 'Super admin', '2026-01-28', '2026-01-28 04:32:40', '0000-00-00 00:00:00', 1),
(79, 1, 'd8f48c2592bfad1cc0dfd49cd148bc1b17e55534', 'A', 'Super admin', '2026-01-28', '2026-01-28 08:02:06', '0000-00-00 00:00:00', 1),
(80, 1, '81e2380814714053d8fc22e8c1a22262eb0c8d53', 'A', 'Super admin', '2026-01-29', '2026-01-29 12:31:27', '0000-00-00 00:00:00', 1),
(81, 1, '79a4b0f762900a9d14cf36ea866401c6f2865f1d', 'A', 'Super admin', '2026-01-29', '2026-01-29 09:44:18', '0000-00-00 00:00:00', 1),
(82, 1, '6ee1d3306fd9e5b999e5a7f69fab5f6352e00bf9', 'A', 'Super admin', '2026-01-29', '2026-01-29 07:21:22', '0000-00-00 00:00:00', 1),
(83, 1, '7cf1dc9aba8876613595d95d54100c2bc27ec544', 'A', 'Super admin', '2026-01-30', '2026-01-30 09:36:41', '0000-00-00 00:00:00', 1),
(84, 1, 'f256525fc414ef574728b38d8f0ec84f6a5f96ec', 'A', 'Super admin', '2026-01-30', '2026-01-30 07:56:51', '0000-00-00 00:00:00', 1),
(85, 1, '625d0dcbfcc3df2877babab30c6243284086ba11', 'A', 'Super admin', '2026-01-31', '2026-01-31 12:36:49', '0000-00-00 00:00:00', 1),
(86, 1, '04653d2b8051ea52bb3b89151e2221b24e2486b5', 'A', 'Super admin', '2026-01-31', '2026-01-31 09:12:41', '0000-00-00 00:00:00', 1),
(87, 1, '97f4a7229d1149ab9c70da55851cffe272161f2d', 'A', 'Super admin', '2026-01-31', '2026-01-31 06:11:52', '0000-00-00 00:00:00', 1),
(88, 1, '72024c2298ec5402546960a80253e670fd3f5389', 'A', 'Super admin', '2026-02-01', '2026-02-01 01:30:17', '0000-00-00 00:00:00', 1),
(89, 1, '2c37171d08d0434a391051cb2129dab7577a3d1e', 'A', 'Super admin', '2026-02-01', '2026-02-01 03:13:25', '0000-00-00 00:00:00', 1),
(90, 1, '1389d3023259cf3df00f6fd8012d5cf3614103e9', 'A', 'Super admin', '2026-02-02', '2026-02-02 07:59:57', '0000-00-00 00:00:00', 1),
(91, 1, 'fda2e1d2cfe57a4cb606094adc3ab4dd1a25d612', 'A', 'Super admin', '2026-02-03', '2026-02-03 12:17:17', '0000-00-00 00:00:00', 1),
(92, 1, '8c43a2bdacc3ac0150a584a50f5f488173d0622d', 'A', 'Super admin', '2026-02-03', '2026-02-03 11:12:43', '0000-00-00 00:00:00', 1),
(93, 1, '455b18a20d488e4fe1612743902fd8e9df9395a9', 'A', 'Super admin', '2026-02-03', '2026-02-03 01:53:37', '0000-00-00 00:00:00', 1),
(94, 1, 'e46632365ad620b1b224933890d3b144760c983c', 'A', 'Super admin', '2026-02-04', '2026-02-04 09:59:59', '0000-00-00 00:00:00', 1),
(95, 1, 'b5dd45615409f953e408c8251edef338754d4f74', 'A', 'Super admin', '2026-02-04', '2026-02-04 08:13:37', '0000-00-00 00:00:00', 1),
(96, 1, 'edee83733d9e4a5bd2daa59b7cfd14a0590d8871', 'A', 'Super admin', '2026-02-05', '2026-02-05 09:50:16', '0000-00-00 00:00:00', 1),
(97, 1, 'a413b44e3283cf0081c9b115fb816d82f7e0193e', 'A', 'Super admin', '2026-02-05', '2026-02-05 11:46:52', '0000-00-00 00:00:00', 1),
(98, 1, 'f61090f3312c8a3f82fe8336225cc6a1407bf3f0', 'A', 'Super admin', '2026-02-05', '2026-02-05 02:54:08', '0000-00-00 00:00:00', 1),
(99, 1, '8304c3b4d6f9ec56abe89fae3a178b9b2536cb81', 'A', 'Super admin', '2026-02-05', '2026-02-05 08:52:20', '0000-00-00 00:00:00', 1),
(100, 1, '3315b5b447fc3927795b003ac3facded4cb0ce0a', 'A', 'Super admin', '2026-02-06', '2026-02-06 08:48:53', '0000-00-00 00:00:00', 1),
(101, 1, 'c3d58c392ce3f7ffbc8ce8a1bbb5ac0645f3ac53', 'A', 'Super admin', '2026-02-07', '2026-02-07 10:43:14', '0000-00-00 00:00:00', 1),
(102, 1, 'aa7cc7c118e71cd1469b1f55fcaf3602884c769e', 'A', 'Super admin', '2026-02-07', '2026-02-07 11:48:22', '0000-00-00 00:00:00', 1),
(103, 1, '9bae0d199bdf2ef578a4d39512f58ed381bf1ced', 'A', 'Super admin', '2026-02-07', '2026-02-07 01:04:38', '0000-00-00 00:00:00', 1),
(104, 1, '2e6cb4ab2c31314747e518f21b2250476c0a8942', 'A', 'Super admin', '2026-02-07', '2026-02-07 01:07:37', '0000-00-00 00:00:00', 1),
(105, 1, '8bccec4b22927430a9c36add03383167e28f78dd', 'A', 'Super admin', '2026-02-07', '2026-02-07 04:59:40', '0000-00-00 00:00:00', 1),
(106, 1, 'cf100f42b5758386dc08a6244cdb7d0f7986b863', 'A', 'Super admin', '2026-02-07', '2026-02-07 08:14:33', '0000-00-00 00:00:00', 1),
(107, 1, '98e89c44f4626c436aee011194d2a683ad9abc02', 'A', 'Super admin', '2026-02-08', '2026-02-08 07:41:19', '0000-00-00 00:00:00', 1),
(108, 1, '7b36432f445ad86ac155f139867f7ef15a316ae7', 'A', 'Super admin', '2026-02-08', '2026-02-08 08:19:52', '0000-00-00 00:00:00', 1),
(109, 1, 'cbd7cc58fec6973cdea2d4eec4e9fb25146a953c', 'A', 'Super admin', '2026-02-08', '2026-02-08 10:15:34', '0000-00-00 00:00:00', 1),
(110, 1, 'de4c3353263fd2e67a46896cd2648b3b265d3428', 'A', 'Super admin', '2026-02-08', '2026-02-08 10:23:15', '0000-00-00 00:00:00', 1),
(111, 1, 'ab18683c58b27f44d2174d56bb85dcc632f822dc', 'A', 'Super admin', '2026-02-08', '2026-02-08 02:30:35', '0000-00-00 00:00:00', 1),
(112, 1, '6f699c42ef25f8a0d58d84fe540ebc8eee2d09b6', 'A', 'Super admin', '2026-02-16', '2026-02-16 10:07:59', '0000-00-00 00:00:00', 1),
(113, 1, 'ed74bae2e3d26645a723255a0e83dbe0f04e2178', 'A', 'Super admin', '2026-02-16', '2026-02-16 10:44:46', '0000-00-00 00:00:00', 1),
(114, 1, '4979d6a4ba72dc75d0fbf5df9109be42c2b54342', 'A', 'Super admin', '2026-02-16', '2026-02-16 01:27:51', '0000-00-00 00:00:00', 1),
(115, 1, '75396973e9bc7375109e727a753befdf343fef3f', 'A', 'Super admin', '2026-02-16', '2026-02-16 05:23:42', '0000-00-00 00:00:00', 1),
(116, 1, '3d0849ca29d2f68bbe725be7216e1c10e861ccc5', 'A', 'Super admin', '2026-02-16', '2026-02-16 09:19:57', '0000-00-00 00:00:00', 1),
(117, 1, '9eb5cd781e2f71c421429b3b23f62a9215bf927a', 'A', 'Super admin', '2026-02-17', '2026-02-17 12:31:16', '0000-00-00 00:00:00', 1),
(118, 1, '319201b22801daa8616986934d9a467fa74ffab9', 'A', 'Super admin', '2026-02-17', '2026-02-17 06:41:00', '0000-00-00 00:00:00', 1),
(119, 1, 'd85f25c35d64260c929e7ecc1ee8dbf47ec165ae', 'A', 'Super admin', '2026-02-17', '2026-02-17 07:19:43', '0000-00-00 00:00:00', 1),
(120, 1, '434f90782749931a0927f92d299f2a47a8ff1eee', 'A', 'Super admin', '2026-02-17', '2026-02-17 11:51:04', '0000-00-00 00:00:00', 1),
(121, 1, '8fe7abd559dbf20f109683fb16299ae7002becbe', 'A', 'Super admin', '2026-02-17', '2026-02-17 07:13:26', '0000-00-00 00:00:00', 1),
(122, 1, '1ce903798702efcaca9caf008a6b1a6829386ed9', 'A', 'Super admin', '2026-02-17', '2026-02-17 07:38:19', '0000-00-00 00:00:00', 1),
(123, 1, '4d4ada060619621cd8998a28b5001a50428b5b63', 'A', 'Super admin', '2026-02-18', '2026-02-18 09:39:50', '0000-00-00 00:00:00', 1),
(124, 1, '60a8671d6fc2ee840f2def88b111214dae36fcc1', 'A', 'Super admin', '2026-02-18', '2026-02-18 10:35:59', '0000-00-00 00:00:00', 1),
(125, 1, '83b8ef0e5389a75a9671f86c66de0e8f6da9b3a3', 'A', 'Super admin', '2026-02-18', '2026-02-18 04:53:40', '0000-00-00 00:00:00', 1),
(126, 1, '70125aef24e8bd545848a5e5c673fa7d29c0cf0e', 'A', 'Super admin', '2026-02-18', '2026-02-18 09:21:11', '2026-02-18 09:21:26', 1),
(127, 1, '573e9d55f548c7002407949b6679c8cb29605cc8', 'A', 'Super admin', '2026-02-18', '2026-02-18 09:21:32', '0000-00-00 00:00:00', 1),
(128, 1, '573e9d55f548c7002407949b6679c8cb29605cc8', 'A', 'Super admin', '2026-02-18', '2026-02-18 09:24:00', '0000-00-00 00:00:00', 1),
(129, 1, 'd57af08b8125f105b24f80f436366f7f31541766', 'A', 'Super admin', '2026-02-19', '2026-02-19 12:05:57', '0000-00-00 00:00:00', 1),
(130, 1, '8ba64071cf904623daf4bdff6d2f48577077d04c', 'A', 'Super admin', '2026-02-19', '2026-02-19 06:27:12', '0000-00-00 00:00:00', 1),
(131, 1, '1eeeed306d15be014fea82745c44d71b333fdf90', 'A', 'Super admin', '2026-02-19', '2026-02-19 07:11:22', '0000-00-00 00:00:00', 1),
(132, 1, '47f6557d79b9510b3393cd92506cfaa359f27206', 'A', 'Super admin', '2026-02-19', '2026-02-19 07:17:40', '0000-00-00 00:00:00', 1),
(133, 1, 'fef697f8c73f41602cb205e8be604d26cbd6a605', 'A', 'Super admin', '2026-02-19', '2026-02-19 10:12:32', '0000-00-00 00:00:00', 1),
(134, 1, '2ac873b72856c0f8b9af33130b60d970ba1a2a25', 'A', 'Super admin', '2026-02-19', '2026-02-19 10:30:38', '0000-00-00 00:00:00', 1),
(135, 1, 'c7a342152ebc8743eeb54b32cdbf5a2585d6acaf', 'A', 'Super admin', '2026-02-19', '2026-02-19 10:46:02', '0000-00-00 00:00:00', 1),
(136, 1, '54871ce1d5f8e6e5300ef7f5e39bc9786581ea91', 'A', 'Super admin', '2026-02-19', '2026-02-19 11:33:17', '0000-00-00 00:00:00', 1),
(137, 1, 'fcdbafce022d48aebeb8da3d553c0a879f133c3d', 'A', 'Super admin', '2026-02-19', '2026-02-19 04:02:35', '0000-00-00 00:00:00', 1),
(138, 1, '6b90f9f782d28010f97441f3934c6bb48ae14f24', 'A', 'Super admin', '2026-02-19', '2026-02-19 04:27:39', '0000-00-00 00:00:00', 1),
(139, 1, '6376880c1c9320ba630338eb2dbc6e5ea1ec0557', 'A', 'Super admin', '2026-02-19', '2026-02-19 06:23:04', '0000-00-00 00:00:00', 1),
(140, 1, 'd691ec99d70c97db777dd11c2ac267ce5da1e525', 'A', 'Super admin', '2026-02-19', '2026-02-19 11:23:39', '0000-00-00 00:00:00', 1),
(141, 1, 'afb40ed46a6ffb79b2fab35229091a64bb3cf0d6', 'A', 'Super admin', '2026-02-20', '2026-02-20 09:07:53', '0000-00-00 00:00:00', 1),
(142, 1, '92ab92bc711ff4f56c7d75e0c89a713613cc17a0', 'A', 'Super admin', '2026-02-20', '2026-02-20 04:15:45', '0000-00-00 00:00:00', 1),
(143, 1, 'b5178e26f24b2bdf900489f13b3be8468eeee03c', 'A', 'Super admin', '2026-02-20', '2026-02-20 04:26:02', '0000-00-00 00:00:00', 1),
(144, 1, 'd6c1550b5a88510e5562966c612d91e5e62e3724', 'A', 'Super admin', '2026-02-20', '2026-02-20 04:56:07', '0000-00-00 00:00:00', 1),
(145, 1, 'd6c1550b5a88510e5562966c612d91e5e62e3724', 'A', 'Super admin', '2026-02-20', '2026-02-20 04:57:07', '0000-00-00 00:00:00', 1),
(146, 1, '4f77612a9ecf3589fa93c10cf3fc2cfd1c38798d', 'A', 'Super admin', '2026-02-21', '2026-02-21 09:50:52', '0000-00-00 00:00:00', 1),
(147, 1, '208860744db56732d14cf43ab7ad6cab49dddf61', 'A', 'Super admin', '2026-02-22', '2026-02-22 09:06:43', '0000-00-00 00:00:00', 1),
(148, 1, '0373177f16ba96010e3d25f4b2a792b4a705dd51', 'A', 'Super admin', '2026-02-22', '2026-02-22 11:04:27', '0000-00-00 00:00:00', 1),
(149, 1, '4c9b007cd4ad8864aa767a1906f282ed4d351626', 'A', 'Super admin', '2026-02-22', '2026-02-22 03:30:46', '0000-00-00 00:00:00', 1),
(150, 1, '8f60d5f6b0b84edfdbf5109d461046a5ddf5b8f8', 'A', 'Super admin', '2026-02-22', '2026-02-22 10:50:35', '0000-00-00 00:00:00', 1),
(151, 1, '97616d673ef7b011f48ea7ad0e2d9184008bc996', 'A', 'Super admin', '2026-02-23', '2026-02-23 06:29:57', '0000-00-00 00:00:00', 1),
(152, 1, '26b10fb4bb16604a46f283fafe685523c2963335', 'A', 'Super admin', '2026-02-24', '2026-02-24 03:44:06', '0000-00-00 00:00:00', 1),
(153, 1, 'e836ad68d04580987e2f2611a5c4a1952c09979e', 'A', 'Super admin', '2026-02-24', '2026-02-24 04:50:27', '0000-00-00 00:00:00', 1),
(154, 1, 'b7d86a0be2f5b8fbcb826f535fac9ca0b563ee23', 'A', 'Super admin', '2026-02-25', '2026-02-25 11:38:33', '0000-00-00 00:00:00', 1),
(155, 1, 'bdf7bee680ed6cb0621f43cb964dc2641fbf704a', 'A', 'Super admin', '2026-02-25', '2026-02-25 01:54:21', '0000-00-00 00:00:00', 1),
(156, 1, 'a1869daa226d3299dd0ac9d75e5461d39ddb936f', 'A', 'Super admin', '2026-02-25', '2026-02-25 05:16:02', '0000-00-00 00:00:00', 1),
(157, 1, '0f1ccc5b8cd0c3469401bdb50fa957b71d68a94d', 'A', 'Super admin', '2026-02-25', '2026-02-25 05:58:28', '0000-00-00 00:00:00', 1),
(158, 1, 'a4927cf1910d336ebad3db4a3b8ceeb6410e0d76', 'A', 'Super admin', '2026-02-25', '2026-02-25 09:35:27', '0000-00-00 00:00:00', 1),
(159, 1, 'ec432f425ab0d0116ed775519278ca67a39d72e9', 'A', 'Super admin', '2026-02-26', '2026-02-26 12:41:28', '0000-00-00 00:00:00', 1),
(160, 1, '5c65f7f1aad381f05a8ca8d87b4f55ba73236aec', 'A', 'Super admin', '2026-02-26', '2026-02-26 12:56:47', '0000-00-00 00:00:00', 1),
(161, 1, 'e76a0115a15bbf495a8c2792a9f3bc44f669fddf', 'A', 'Super admin', '2026-02-26', '2026-02-26 01:28:11', '0000-00-00 00:00:00', 1),
(162, 1, '0d5a09858a96ecd126aea15daf4719b5fac16b13', 'A', 'Super admin', '2026-02-26', '2026-02-26 01:50:04', '0000-00-00 00:00:00', 1),
(163, 1, '5b459d117ba72aee31cfcf686d4c379eb54ed9a5', 'A', 'Super admin', '2026-02-27', '2026-02-27 12:47:04', '0000-00-00 00:00:00', 1),
(164, 1, 'f529a55889cb888777f4255aff26498504557b54', 'A', 'Super admin', '2026-02-27', '2026-02-27 01:29:35', '0000-00-00 00:00:00', 1),
(165, 1, 'd987c152e9ec9d84b151b5e149c393003d24cfe2', 'A', 'Super admin', '2026-02-27', '2026-02-27 07:41:18', '0000-00-00 00:00:00', 1),
(166, 1, '49e6e96498bd9d70b226764435833dcb226c6775', 'A', 'Super admin', '2026-02-27', '2026-02-27 11:09:39', '0000-00-00 00:00:00', 1),
(167, 1, '471c18e9bdab944ffa39beb4e7f4fa36191eef7b', 'A', 'Super admin', '2026-02-27', '2026-02-27 12:01:48', '0000-00-00 00:00:00', 1),
(168, 1, '4086233522c2707ce9ef8ca07dd2ab7f4b0fc9da', 'A', 'Super admin', '2026-02-27', '2026-02-27 01:00:57', '0000-00-00 00:00:00', 1),
(169, 1, '43fb7631e606286bb0f995f62dd555483a5a20af', 'A', 'Super admin', '2026-02-27', '2026-02-27 03:12:55', '0000-00-00 00:00:00', 1),
(170, 1, '6151158a450d8c190fa164c0d893994839036f52', 'A', 'Super admin', '2026-02-27', '2026-02-27 09:11:05', '0000-00-00 00:00:00', 1),
(171, 1, 'edacb8d7573522d70bfb3e8b4946e72829d6027f', 'A', 'Super admin', '2026-02-28', '2026-02-28 10:42:06', '0000-00-00 00:00:00', 1),
(172, 1, '34cf3905d68f687c82fb7ec1c1c7769a7e0122dc', 'A', 'Super admin', '2026-03-01', '2026-03-01 12:34:31', '0000-00-00 00:00:00', 1),
(173, 1, '9150624afdac46bda18c0fc8c890254a6c7ee660', 'A', 'Super admin', '2026-03-01', '2026-03-01 02:00:22', '0000-00-00 00:00:00', 1),
(174, 1, '76e728ab4088fdea1a61d8cda1cd31f1f5ebe7aa', 'A', 'Super admin', '2026-03-02', '2026-03-02 09:40:10', '0000-00-00 00:00:00', 1),
(175, 1, '6c5270c04bfb93ba29c101ae1d8fdb134ae366db', 'A', 'Super admin', '2026-03-02', '2026-03-02 01:06:01', '0000-00-00 00:00:00', 1),
(176, 1, '4e2e8fbb7c4c6a78c957ebb0032a8b30d74a2959', 'A', 'Super admin', '2026-03-02', '2026-03-02 01:21:03', '0000-00-00 00:00:00', 1),
(177, 1, 'c56b09a2c37ce31a09d16f7ca995697611a5a153', 'A', 'Super admin', '2026-03-02', '2026-03-02 01:23:52', '0000-00-00 00:00:00', 1),
(178, 1, 'a134ac6ce16f92abc1eddf0c7704fcc31ac99c9b', 'A', 'Super admin', '2026-03-02', '2026-03-02 02:12:55', '2026-03-02 02:13:29', 1),
(179, 1, 'b12a3c77cc7f5738430deb679908748437b7efd8', 'A', 'Super admin', '2026-03-02', '2026-03-02 02:23:26', '0000-00-00 00:00:00', 1),
(180, 1, '1e4f91ddb868be0e5abe96df03ab01e7837d254a', 'A', 'Super admin', '2026-03-02', '2026-03-02 05:14:08', '0000-00-00 00:00:00', 1),
(181, 1, '82a2b9d49cc50838ad5d0593b72f96ad153c77f0', 'A', 'Super admin', '2026-03-02', '2026-03-02 08:53:02', '0000-00-00 00:00:00', 1),
(182, 1, '5341882f36dd64300efbd39740244ea29ec5f013', 'A', 'Super admin', '2026-03-03', '2026-03-03 11:23:01', '0000-00-00 00:00:00', 1),
(183, 1, '7e81d1ad57864a68f9eea5a2af9214aff4aaaf46', 'A', 'Super admin', '2026-03-03', '2026-03-03 06:18:06', '0000-00-00 00:00:00', 1),
(184, 1, 'd57f6dd6c9a98041f1377f0d5ae1b81bb714242e', 'A', 'Super admin', '2026-03-04', '2026-03-04 11:00:22', '0000-00-00 00:00:00', 1),
(185, 1, '585aa154c344c77b6a70c383ec14db6eb776ef65', 'A', 'Super admin', '2026-03-04', '2026-03-04 03:02:35', '0000-00-00 00:00:00', 1),
(186, 1, '37f9aae4fefaaf74995dbe276daf2491cf2aecf6', 'A', 'Super admin', '2026-03-04', '2026-03-04 03:32:27', '0000-00-00 00:00:00', 1),
(187, 1, '32f2cb1dbfaf716ef5b8654978057cbe19a7d101', 'A', 'Super admin', '2026-03-04', '2026-03-04 03:38:02', '0000-00-00 00:00:00', 1),
(188, 1, '2b4dcb0cc6ea410853a62f0727ef8dac8c2df6a8', 'A', 'Super admin', '2026-03-05', '2026-03-05 12:36:40', '0000-00-00 00:00:00', 1),
(189, 1, '2ea05005853d0a05e54f55d97855d152538379a3', 'A', 'Super admin', '2026-03-05', '2026-03-05 07:11:46', '0000-00-00 00:00:00', 1),
(190, 1, 'b338b2870a2c3a04352f719093585047eefe576b', 'A', 'Super admin', '2026-03-05', '2026-03-05 09:18:54', '0000-00-00 00:00:00', 1),
(191, 1, '3cb05239db4a17950f44d4f7f77edcbbe4c23e2c', 'A', 'Super admin', '2026-03-06', '2026-03-06 09:56:13', '0000-00-00 00:00:00', 1),
(192, 1, 'b3f8fff16502677ebc353585cbf8110d7abeaaac', 'A', 'Super admin', '2026-03-06', '2026-03-06 03:20:20', '0000-00-00 00:00:00', 1),
(193, 1, 'c8111d4002287c6a2599d805979e05631f4b61b6', 'A', 'Super admin', '2026-03-09', '2026-03-09 02:49:32', '0000-00-00 00:00:00', 1),
(194, 1, '8ba549d9af27be00c4d1a3f4af0302e56453afba', 'A', 'Super admin', '2026-03-09', '2026-03-09 10:25:12', '0000-00-00 00:00:00', 1),
(195, 1, '09dc9b0ab97c5cb2ae417e738a1a04f8aa920522', 'A', 'Super admin', '2026-03-10', '2026-03-10 10:21:42', '0000-00-00 00:00:00', 1),
(196, 1, 'a2dc2b63ae8365a7c1fa3a0890c28e749cf57c81', 'A', 'Super admin', '2026-03-11', '2026-03-11 10:26:03', '0000-00-00 00:00:00', 1),
(197, 1, 'fcd51233a2fe5991cc4d40d7a1c010646dbc5d64', 'A', 'Super admin', '2026-03-11', '2026-03-11 11:56:17', '0000-00-00 00:00:00', 1),
(198, 1, 'fcd51233a2fe5991cc4d40d7a1c010646dbc5d64', 'A', 'Super admin', '2026-03-11', '2026-03-11 11:56:35', '0000-00-00 00:00:00', 1),
(199, 1, 'fcd51233a2fe5991cc4d40d7a1c010646dbc5d64', 'A', 'Super admin', '2026-03-11', '2026-03-11 11:57:37', '0000-00-00 00:00:00', 1),
(200, 1, '22443b93edfb06deb9248a28be10135a774a1e8e', 'A', 'Super admin', '2026-03-12', '2026-03-12 06:47:20', '0000-00-00 00:00:00', 1),
(201, 1, '17c57ae3d2c0948d54a75c0d050763473c37832a', 'A', 'Super admin', '2026-03-12', '2026-03-12 11:01:23', '0000-00-00 00:00:00', 1),
(202, 1, '0a25de1433a517b05904e3a547e605a49c9c3780', 'A', 'Super admin', '2026-03-13', '2026-03-13 04:11:13', '0000-00-00 00:00:00', 1),
(203, 1, '1621aba94a8a1638fd555cf57053f365c3faed1b', 'A', 'Super admin', '2026-03-13', '2026-03-13 09:18:23', '0000-00-00 00:00:00', 1),
(204, 1, '6bc1ec976262510ffda0689db29871d2a28c30db', 'A', 'Super admin', '2026-03-14', '2026-03-14 10:35:33', '0000-00-00 00:00:00', 1),
(205, 1, '51eea8398876fbc024360c408820d18cdeb3c7ac', 'A', 'Super admin', '2026-03-14', '2026-03-14 12:45:13', '0000-00-00 00:00:00', 1),
(206, 1, 'a0bc6eaf3e139eccae5d7eb0802210208f42ca91', 'A', 'Super admin', '2026-03-14', '2026-03-14 06:51:49', '0000-00-00 00:00:00', 1),
(207, 1, 'cf6501c654a6a37bef40186def3597116a64d416', 'A', 'Super admin', '2026-03-14', '2026-03-14 09:12:27', '0000-00-00 00:00:00', 1),
(208, 1, '98d674a366ab2f8aff68679d121197cc5331dbdd', 'A', 'Super admin', '2026-03-15', '2026-03-15 01:11:39', '0000-00-00 00:00:00', 1),
(209, 1, 'b2785d2f168d470f821ec462e7677106d9b12838', 'A', 'Super admin', '2026-03-15', '2026-03-15 06:25:39', '0000-00-00 00:00:00', 1),
(210, 1, '453659ae4f9885d0da8d84a4c4b8d047b786ddd6', 'A', 'Super admin', '2026-03-15', '2026-03-15 07:33:13', '0000-00-00 00:00:00', 1),
(211, 1, 'd3d0913f18616df8cef74d11d256dcb6c11de8c3', 'A', 'Super admin', '2026-03-18', '2026-03-18 08:23:53', '0000-00-00 00:00:00', 1),
(212, 1, '4f90cd9f1bf92afe7696fdaf46a3d391cd8ee2a9', 'A', 'Super admin', '2026-03-18', '2026-03-18 12:56:58', '0000-00-00 00:00:00', 1),
(213, 1, 'fd8d5ac0461797ea765e2c20c768f5fa88a30306', 'A', 'Super admin', '2026-03-18', '2026-03-18 06:39:27', '0000-00-00 00:00:00', 1),
(214, 1, 'c9db7567b34afd467f599a037393a520759e0ec8', 'A', 'Super admin', '2026-03-18', '2026-03-18 10:23:49', '0000-00-00 00:00:00', 1),
(215, 1, 'e97611fc6d013574a0a78240420c5fc102a4b233', 'A', 'Super admin', '2026-03-21', '2026-03-21 06:55:10', '2026-03-21 06:56:18', 1),
(216, 1, '87aedc91d8134441c2393424f5256643174a4689', 'A', 'Super admin', '2026-03-21', '2026-03-21 09:15:09', '0000-00-00 00:00:00', 1),
(217, 1, '494dfb208a9eb78ac2b95bec4465c76c451f6fa2', 'A', 'Super admin', '2026-03-21', '2026-03-21 10:00:09', '0000-00-00 00:00:00', 1),
(218, 1, '4d80497ad71319ffe41c48a2d9be61471711933e', 'A', 'Super admin', '2026-03-21', '2026-03-21 07:35:33', '0000-00-00 00:00:00', 1),
(219, 1, '9bc2a6bd1d1da77d0854ba59e2df25625cb82bbd', 'A', 'Super admin', '2026-03-22', '2026-03-22 06:24:49', '0000-00-00 00:00:00', 1),
(220, 1, 'aab178c75728dc1ec11db73c669a952f09a73987', 'A', 'Super admin', '2026-03-22', '2026-03-22 12:01:15', '0000-00-00 00:00:00', 1),
(221, 1, '74c0e3bb4cf860afeca6853edf8e7047ad25b939', 'A', 'Super admin', '2026-03-22', '2026-03-22 08:00:09', '0000-00-00 00:00:00', 1),
(222, 1, '84119cde36eec0177e6b83164ec0d4d783547b6a', 'A', 'Super admin', '2026-03-22', '2026-03-22 11:10:54', '0000-00-00 00:00:00', 1),
(223, 1, '6e846f941ecdb1cecfbc909cd67c4e73d13e1d17', 'A', 'Super admin', '2026-03-23', '2026-03-23 03:38:18', '0000-00-00 00:00:00', 1),
(224, 1, 'f8c4c57dbf435287a4b2420657337ad268d40dc6', 'A', 'Super admin', '2026-03-23', '2026-03-23 03:55:17', '0000-00-00 00:00:00', 1),
(225, 1, '436600f96ba0ac20d535b459014720d23bea6ffc', 'A', 'Super admin', '2026-03-23', '2026-03-23 04:14:03', '0000-00-00 00:00:00', 1),
(226, 1, 'bd998f1685b0bfc1d4cbdfbac8c3d7f2bd6d9f9e', 'A', 'Super admin', '2026-03-23', '2026-03-23 06:39:08', '0000-00-00 00:00:00', 1),
(227, 1, '073a5c898ddb5050f33992f7514abae0cbf07b57', 'A', 'Super admin', '2026-03-23', '2026-03-23 11:41:39', '0000-00-00 00:00:00', 1),
(228, 1, '6187a5c98eeea1179f3ffae6a399e7882d396bcd', 'A', 'Super admin', '2026-03-24', '2026-03-24 09:18:32', '0000-00-00 00:00:00', 1),
(229, 1, '6187a5c98eeea1179f3ffae6a399e7882d396bcd', 'A', 'Super admin', '2026-03-24', '2026-03-24 09:18:33', '0000-00-00 00:00:00', 1),
(230, 1, 'cac8ddbc63eac92fc548d3b3b443ced3c2698f2f', 'A', 'Super admin', '2026-03-24', '2026-03-24 11:39:10', '0000-00-00 00:00:00', 1),
(231, 1, '450df01228278f2a6f8a8f90678f72b19605c5a1', 'A', 'Super admin', '2026-03-24', '2026-03-24 11:58:06', '0000-00-00 00:00:00', 1),
(232, 1, 'da6772338e65cf85074abffc4a05905a2839625b', 'A', 'Super admin', '2026-03-24', '2026-03-24 03:30:01', '0000-00-00 00:00:00', 1),
(233, 1, '0173eb10df5d521a31c587a347d6e0dd6166d980', 'A', 'Super admin', '2026-03-24', '2026-03-24 08:44:55', '0000-00-00 00:00:00', 1),
(234, 1, 'd09549bd89009c405352efeb5779da591a7038db', 'A', 'Super admin', '2026-03-25', '2026-03-25 07:26:08', '0000-00-00 00:00:00', 1),
(235, 1, 'bb3ba95939f1c9d2c568ab883aebcfa982392c21', 'A', 'Super admin', '2026-03-25', '2026-03-25 05:08:33', '0000-00-00 00:00:00', 1),
(236, 1, 'b8de07b33605054453657625236b2724da2ebc6c', 'A', 'Super admin', '2026-03-27', '2026-03-27 08:47:31', '0000-00-00 00:00:00', 1),
(237, 1, 'f0d880227e525ed064fc4e0cf7c90d40337d65a3', 'A', 'Super admin', '2026-03-31', '2026-03-31 08:48:44', '0000-00-00 00:00:00', 1),
(238, 1, 'e3be6ac53e65362160a451fbe748355c591b041b', 'A', 'Super admin', '2026-04-01', '2026-04-01 02:57:13', '0000-00-00 00:00:00', 1),
(239, 1, '80755a595a2482d424896a2a8efb4983102aa493', 'A', 'Super admin', '2026-04-02', '2026-04-02 10:41:37', '0000-00-00 00:00:00', 1),
(240, 1, '4cacda053f4f905c3fe9de5b910a8b3af97f563c', 'A', 'Super admin', '2026-04-04', '2026-04-04 01:27:33', '0000-00-00 00:00:00', 1),
(241, 1, '57f6aa73e3b14bd27fa7b3206ad233f15e9e63ed', 'A', 'Super admin', '2026-04-04', '2026-04-04 10:36:53', '0000-00-00 00:00:00', 1),
(242, 1, '7f3fba13e3f451740c4d950b5fffe35d672a8a2c', 'A', 'Super admin', '2026-04-06', '2026-04-06 10:55:34', '0000-00-00 00:00:00', 1),
(243, 1, '646171199fadbd0819d6286c74797811ae362fd6', 'A', 'Super admin', '2026-04-06', '2026-04-06 03:03:22', '0000-00-00 00:00:00', 1),
(244, 1, 'fd8e50d951e8a20415ed1788dc05514d2a0beb61', 'A', 'Super admin', '2026-04-06', '2026-04-06 08:51:07', '0000-00-00 00:00:00', 1),
(245, 1, '4e61cdacff905f76467a1b0ee3b14a7b7feaf756', 'A', 'Super admin', '2026-04-07', '2026-04-07 12:56:25', '0000-00-00 00:00:00', 1),
(246, 1, 'a55ad3bdf57e50b5285cbc1e3893385de3042668', 'A', 'Super admin', '2026-04-07', '2026-04-07 06:17:27', '0000-00-00 00:00:00', 1),
(247, 1, 'a0c1a72bf16f6fea9f88df11f19d62a38031fede', 'A', 'Super admin', '2026-04-07', '2026-04-07 12:46:57', '0000-00-00 00:00:00', 1),
(248, 1, 'fb409547563abdaea44718618df5e15b92a1168c', 'A', 'Super admin', '2026-04-07', '2026-04-07 10:31:20', '0000-00-00 00:00:00', 1),
(249, 1, 'a376aef31df5e5167cbb5541fc07722ca6861615', 'A', 'Super admin', '2026-04-08', '2026-04-08 07:10:59', '0000-00-00 00:00:00', 1),
(250, 1, '5e4b8cae6aef74ad5d831ba7555a47ed0698b5e8', 'A', 'Super admin', '2026-04-08', '2026-04-08 05:05:44', '0000-00-00 00:00:00', 1),
(251, 1, '4d0e592774fd4d2cc79d9a1bb18def503ca29d0e', 'A', 'Super admin', '2026-04-08', '2026-04-08 05:31:22', '0000-00-00 00:00:00', 1),
(252, 1, '2cbf181719450bc7dabdd8e3d251a866a2cb5b7c', 'A', 'Super admin', '2026-04-08', '2026-04-08 07:38:06', '0000-00-00 00:00:00', 1),
(253, 1, '06851b455002ac2664445861611539976375d2f5', 'A', 'Super admin', '2026-04-09', '2026-04-09 06:36:24', '0000-00-00 00:00:00', 1),
(254, 1, '552f87ea60777ecfad106cee092973b190aec02c', 'A', 'Super admin', '2026-04-09', '2026-04-09 07:08:17', '0000-00-00 00:00:00', 1),
(255, 1, '1b7af2878165073cb091277520103d483a4da209', 'A', 'Super admin', '2026-04-09', '2026-04-09 06:11:07', '0000-00-00 00:00:00', 1),
(256, 1, '8f6cfbf13cfd6104937c7a7577791e43fad5391a', 'A', 'Super admin', '2026-04-09', '2026-04-09 08:46:17', '0000-00-00 00:00:00', 1),
(257, 1, 'd372951bdcb83b820783424fd78e6ac35cb8fc47', 'A', 'Super admin', '2026-04-10', '2026-04-10 07:55:34', '0000-00-00 00:00:00', 1),
(258, 1, '0ba600afa608d0e33084be88267a9377c2479d33', 'A', 'Super admin', '2026-04-10', '2026-04-10 12:00:54', '0000-00-00 00:00:00', 1),
(259, 1, 'f7dff8cd892a210efc7e0052e6248df02b72638e', 'A', 'Super admin', '2026-04-10', '2026-04-10 07:32:15', '0000-00-00 00:00:00', 1),
(260, 1, 'd74628ee0ac96ae26b5466593144b530acda1f5b', 'A', 'Super admin', '2026-04-11', '2026-04-11 08:28:20', '0000-00-00 00:00:00', 1),
(261, 1, '95f24634a222d3d321b88472cbdc36242128da7e', 'A', 'Super admin', '2026-04-11', '2026-04-11 10:41:06', '0000-00-00 00:00:00', 1),
(262, 1, '24a45dfa0d3ace922a08009892dc74c8f655bad7', 'A', 'Super admin', '2026-04-12', '2026-04-12 01:10:58', '0000-00-00 00:00:00', 1),
(263, 1, '1328da451d996784b451c05810546ec492ffb600', 'A', 'Super admin', '2026-04-12', '2026-04-12 08:06:56', '0000-00-00 00:00:00', 1),
(264, 1, '92f4741df9963fbb7db01984567ad3c355862ad9', 'A', 'Super admin', '2026-04-12', '2026-04-12 09:30:58', '0000-00-00 00:00:00', 1),
(265, 1, '647aa4e68e6aa5385bd6dd1caa38a957b7220611', 'A', 'Super admin', '2026-04-13', '2026-04-13 07:19:32', '0000-00-00 00:00:00', 1),
(266, 10, '6af9543c7241e0493946aa0ebfbc3997d7791b82', 'S', 'SANI', '2026-04-13', '2026-04-13 07:23:01', '0000-00-00 00:00:00', 1),
(267, 1, '2fd594ed942d02a18e29e093050a51313e904550', 'A', 'Super admin', '2026-04-13', '2026-04-13 09:21:35', '0000-00-00 00:00:00', 1),
(268, 1, '90411f0c1dd3cdd711f7e7761fd2356647b5c957', 'A', 'Super admin', '2026-04-14', '2026-04-14 12:33:09', '0000-00-00 00:00:00', 1),
(269, 1, 'b2c76877a8239533b53d600216fd3b3d108a0007', 'A', 'Super admin', '2026-04-14', '2026-04-14 07:59:22', '0000-00-00 00:00:00', 1),
(270, 1, '8eca8ece4e079a2b29e1758186bf8769a2d242d5', 'A', 'Super admin', '2026-04-15', '2026-04-15 07:36:44', '0000-00-00 00:00:00', 1),
(271, 1, 'a63809a22830f965cc5bd35532dba8c7977fa316', 'A', 'Super admin', '2026-04-15', '2026-04-15 07:33:09', '0000-00-00 00:00:00', 1),
(272, 1, '6dc52a516531b2b8eac10d50b9604b13b24623da', 'A', 'Super admin', '2026-04-17', '2026-04-17 07:47:56', '0000-00-00 00:00:00', 1),
(273, 1, '05b7e4ccf19b96080d299c720b7b6c9b643a39d4', 'A', 'Super admin', '2026-04-18', '2026-04-18 08:33:11', '0000-00-00 00:00:00', 1),
(274, 1, 'fb2335721835242c5c56da21d7c6b4fa4fb22c3c', 'A', 'Super admin', '2026-04-18', '2026-04-18 01:27:39', '0000-00-00 00:00:00', 1),
(275, 1, '1899ea298871ef055e73a467fb54cef9253ccdf8', 'A', 'Super admin', '2026-04-18', '2026-04-18 07:12:39', '0000-00-00 00:00:00', 1),
(276, 10, '9056abf73f244201081fa1cdf05693b9a53065d1', 'S', 'SANI', '2026-04-18', '2026-04-18 07:38:27', '2026-04-18 07:38:54', 1),
(277, 7, '325aa66e0447e4438e7c29c80834b6597ad8223d', 'S', 'NISHA', '2026-04-18', '2026-04-18 07:39:01', '0000-00-00 00:00:00', 1),
(278, 1, '06534a485394f1c4d7701b9ae1414e79e57825e6', 'A', 'Super admin', '2026-04-18', '2026-04-18 10:00:16', '2026-04-18 10:03:03', 1),
(279, 10, '7dd483e6f040a7449fc9f0e02acdee2c061d2054', 'S', 'SANI', '2026-04-18', '2026-04-18 10:03:10', '2026-04-18 10:03:41', 1),
(280, 1, 'f8a7a8a9908813a788c7df7e8c6334a069a879c9', 'A', 'Super admin', '2026-04-18', '2026-04-18 10:03:49', '0000-00-00 00:00:00', 1),
(281, 1, '713c71d3d659dc1773d67034ceebee1d047697d3', 'A', 'Super admin', '2026-04-19', '2026-04-19 11:31:00', '0000-00-00 00:00:00', 1),
(282, 1, '1707d29f2e22e1baff3b44cd24939f4359d8ddd0', 'A', 'Super admin', '2026-04-19', '2026-04-19 02:58:42', '0000-00-00 00:00:00', 1),
(283, 1, '2f45909d9d12e34bdfe120230fd7718fe5f2b7b7', 'A', 'Super admin', '2026-04-19', '2026-04-19 05:49:02', '0000-00-00 00:00:00', 1),
(284, 12, '5e56820331acab251f960cd2b7c47945b208c0c5', 'S', 'SHANIMOL', '2026-04-19', '2026-04-19 05:58:35', '0000-00-00 00:00:00', 1),
(285, 1, 'fad713f5cb28693018a397276ee158000c17f4dd', 'A', 'Super admin', '2026-04-19', '2026-04-19 06:17:44', '2026-04-19 06:18:21', 1),
(286, 1, '6e5aa034b81e19b2b4f6eb614989358481f7a106', 'A', 'Super admin', '2026-04-19', '2026-04-19 06:52:25', '0000-00-00 00:00:00', 1),
(287, 1, 'b8426d2825894659f85dccdcca5ab51812c21a81', 'A', 'Super admin', '2026-04-19', '2026-04-19 07:07:41', '0000-00-00 00:00:00', 1),
(288, 1, 'd1c929e427bac659462da135dc6e91b733a598dc', 'A', 'Super admin', '2026-04-19', '2026-04-19 07:07:56', '0000-00-00 00:00:00', 1),
(289, 1, 'b8426d2825894659f85dccdcca5ab51812c21a81', 'A', 'Super admin', '2026-04-19', '2026-04-19 07:08:18', '0000-00-00 00:00:00', 1),
(290, 1, 'fa24249482ada55fc7a7efae0a75cf7f456edcf8', 'A', 'Super admin', '2026-04-19', '2026-04-19 07:17:18', '0000-00-00 00:00:00', 1),
(291, 1, 'fa24249482ada55fc7a7efae0a75cf7f456edcf8', 'A', 'Super admin', '2026-04-19', '2026-04-19 07:17:21', '0000-00-00 00:00:00', 1),
(292, 1, 'b232adbc7f4842e5d6cf5b4b506e81abbb0780bc', 'A', 'Super admin', '2026-04-19', '2026-04-19 07:20:02', '0000-00-00 00:00:00', 1),
(293, 1, 'f35e612552af1fec007873a4d9f7aafff095e5b8', 'A', 'Super admin', '2026-04-19', '2026-04-19 07:28:52', '0000-00-00 00:00:00', 1),
(294, 1, 'f3075e901085420f04ddd5cfb76e7539b6a998a0', 'A', 'Super admin', '2026-04-19', '2026-04-19 07:40:08', '2026-04-19 07:44:54', 1),
(295, 12, '989a7fd2d6b5aba848657de986ba5041f3ff0515', 'S', 'SHANIMOL', '2026-04-19', '2026-04-19 07:45:08', '0000-00-00 00:00:00', 1),
(296, 1, 'ea3027f241a6dc504a7da249140bb4efbf319278', 'A', 'Super admin', '2026-04-19', '2026-04-19 08:02:18', '0000-00-00 00:00:00', 1),
(297, 1, '238e7c8cd4117eb7ff75ac489e86e4a44f7cf33b', 'A', 'Super admin', '2026-04-19', '2026-04-19 08:46:05', '0000-00-00 00:00:00', 1),
(298, 1, 'e75f85b22dd693fa9f46ad9e81cd350b0dce4ed9', 'A', 'Super admin', '2026-04-19', '2026-04-19 08:51:52', '0000-00-00 00:00:00', 1),
(299, 1, '909128cbcca5c85612919e5a5d7afe6177731207', 'A', 'Super admin', '2026-04-19', '2026-04-19 09:24:06', '0000-00-00 00:00:00', 1),
(300, 1, '6c8be07638697cabad55929d5f4c7b0e16319dfb', 'A', 'Super admin', '2026-04-20', '2026-04-20 10:05:18', '0000-00-00 00:00:00', 1),
(301, 1, 'ff50bd7fce2dc249d089613b5c0b2f131bc7f311', 'A', 'Super admin', '2026-04-20', '2026-04-20 07:18:11', '0000-00-00 00:00:00', 1),
(302, 1, '2705d830e5af7787a095cb40ad60c2aa11803876', 'A', 'Super admin', '2026-04-20', '2026-04-20 09:44:14', '0000-00-00 00:00:00', 1),
(303, 1, '1b949d128d383dd2f4b60e6a83f4953a1695f9b4', 'A', 'Super admin', '2026-04-21', '2026-04-21 07:09:27', '0000-00-00 00:00:00', 1),
(304, 1, '311f41ec72c1586b189b37e814f7b30b8c5672d0', 'A', 'Super admin', '2026-04-21', '2026-04-21 02:40:28', '0000-00-00 00:00:00', 1),
(305, 1, 'e1e6f5947414e15d5d21ace1dc9bc3fc0cb69007', 'A', 'Super admin', '2026-04-22', '2026-04-22 10:04:50', '0000-00-00 00:00:00', 1),
(306, 1, 'b81267814edcd1d5a0db6defa846c9d69125b2b0', 'A', 'Super admin', '2026-04-22', '2026-04-22 04:33:13', '0000-00-00 00:00:00', 1),
(307, 1, '986487ec3bd502683fa877e3e50a9bc9a96b517a', 'A', 'Super admin', '2026-04-23', '2026-04-23 07:37:34', '0000-00-00 00:00:00', 1),
(308, 1, '3c93e09c10131185bda79429ca51e8abd47abc4f', 'A', 'Super admin', '2026-04-23', '2026-04-23 11:25:24', '0000-00-00 00:00:00', 1),
(309, 1, 'cdea103d2396d67293271ae944f13f11e593ac8b', 'A', 'Super admin', '2026-04-23', '2026-04-23 04:01:22', '0000-00-00 00:00:00', 1),
(310, 1, 'd297561b0fa18f788a01df6a00664702b7b4e531', 'A', 'Super admin', '2026-04-23', '2026-04-23 06:37:47', '0000-00-00 00:00:00', 1),
(311, 1, '705ac9f0e7336e4502189ea57d01ffac3bf3849e', 'A', 'Super admin', '2026-04-24', '2026-04-24 12:22:16', '0000-00-00 00:00:00', 1),
(312, 1, '4184947e710d116052a32760eeb129fb46ea4ae2', 'A', 'Super admin', '2026-04-24', '2026-04-24 07:37:41', '0000-00-00 00:00:00', 1),
(313, 1, 'fff73b996a013f54569890c31692f3ce36e547f1', 'A', 'Super admin', '2026-04-24', '2026-04-24 07:59:38', '0000-00-00 00:00:00', 1),
(314, 1, '6396e82ef0fae6e5bef2425e88ff73ba1d242434', 'A', 'Super admin', '2026-04-25', '2026-04-25 02:26:54', '0000-00-00 00:00:00', 1),
(315, 1, 'cde24564fbe2e55513c97583b165fdb8e96618b7', 'A', 'Super admin', '2026-04-25', '2026-04-25 04:53:22', '0000-00-00 00:00:00', 1),
(316, 1, 'c6ab5ba9c3c8ec0241991862ab7c67aeafd2eb2e', 'A', 'Super admin', '2026-04-25', '2026-04-25 07:56:29', '0000-00-00 00:00:00', 1),
(317, 1, '2467a9f80d19966c3442b8d0c411192814b82939', 'A', 'Super admin', '2026-04-26', '2026-04-26 08:07:44', '0000-00-00 00:00:00', 1),
(318, 1, '44cc863406043abce6c63fac092b0237cc43da4e', 'A', 'Super admin', '2026-04-26', '2026-04-26 02:45:54', '0000-00-00 00:00:00', 1),
(319, 1, 'a997011b2e222744a587c4ce784f7ecb659c4639', 'A', 'Super admin', '2026-04-26', '2026-04-26 05:22:40', '0000-00-00 00:00:00', 1),
(320, 1, '7fdb5f371ebef853ee61ba86d34e2a0adbd4baeb', 'A', 'Super admin', '2026-04-26', '2026-04-26 08:44:50', '0000-00-00 00:00:00', 1),
(321, 1, 'e736584dff870edad636b54e92e4f26f614057a4', 'A', 'Super admin', '2026-04-27', '2026-04-27 07:16:06', '0000-00-00 00:00:00', 1),
(322, 1, '6e7fc04e56aa43fdd76747ea721192df90b3f955', 'A', 'Super admin', '2026-04-27', '2026-04-27 02:22:30', '0000-00-00 00:00:00', 1),
(323, 1, '0f6bce45d8f49a28107ac68d2f981e953892ac7c', 'A', 'Super admin', '2026-04-27', '2026-04-27 07:22:27', '0000-00-00 00:00:00', 1),
(324, 1, 'df63fbe3faf8fbdd2db95586e5d792753209fd0f', 'A', 'Super admin', '2026-04-28', '2026-04-28 08:11:31', '0000-00-00 00:00:00', 1),
(325, 1, 'd18151ab1e7a328fd380a62b6a1a2c769af24330', 'A', 'Super admin', '2026-04-28', '2026-04-28 04:38:19', '0000-00-00 00:00:00', 1),
(326, 1, '2d0a94d0fcd164a3e808a49b535407bdb97dc3c5', 'A', 'Super admin', '2026-04-29', '2026-04-29 12:25:37', '0000-00-00 00:00:00', 1),
(327, 1, '24f3c24d229c0141141cb15e3a009eb9ba825d64', 'A', 'Super admin', '2026-04-29', '2026-04-29 09:05:45', '0000-00-00 00:00:00', 1),
(328, 1, '649129c293d3f5ad69b7eeb075ec2227866bf8f0', 'A', 'Super admin', '2026-04-30', '2026-04-30 08:50:21', '0000-00-00 00:00:00', 1),
(329, 1, 'e2478c7af497d17817546ce9db95485f0f9240c6', 'A', 'Super admin', '2026-04-30', '2026-04-30 09:06:11', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meal_plan`
--

CREATE TABLE `meal_plan` (
  `meal_plan_id` int(11) NOT NULL,
  `meal_plan_name` varchar(255) NOT NULL,
  `meal_plan_descrption` text NOT NULL,
  `meal_plan_createdby_user_id` int(11) NOT NULL,
  `meal_plan_createdby_user_name` varchar(255) NOT NULL,
  `meal_plan_created_date` date NOT NULL,
  `meal_plan_created_time` time NOT NULL,
  `meal_plan_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `meal_plan`
--

INSERT INTO `meal_plan` (`meal_plan_id`, `meal_plan_name`, `meal_plan_descrption`, `meal_plan_createdby_user_id`, `meal_plan_createdby_user_name`, `meal_plan_created_date`, `meal_plan_created_time`, `meal_plan_status`) VALUES
(1, 'CP(B)', 'jj', 0, '', '0000-00-00', '00:00:00', 1),
(2, 'EP(Room only)', '', 0, '', '2026-01-20', '00:00:09', 1),
(3, 'MAP(B+D)', '', 0, '', '2026-01-20', '00:00:00', 1),
(4, 'AP(B+L+D)', '', 1, '', '2026-01-20', '00:00:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meta_ads_setting`
--

CREATE TABLE `meta_ads_setting` (
  `meta_ads_setting_id` int(11) NOT NULL,
  `meta_ads_setting_name` varchar(255) NOT NULL,
  `facebook_form_id` varchar(255) NOT NULL,
  `meta_ads_setting_description` text NOT NULL,
  `meta_ads_setting_created_by_userid` int(11) NOT NULL,
  `meta_ads_setting_created_by_username` varchar(255) NOT NULL,
  `meta_ads_setting_created_by_date` date NOT NULL,
  `meta_ads_setting_created_by_time` time NOT NULL,
  `meta_ads_setting_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `meta_ads_setting`
--

INSERT INTO `meta_ads_setting` (`meta_ads_setting_id`, `meta_ads_setting_name`, `facebook_form_id`, `meta_ads_setting_description`, `meta_ads_setting_created_by_userid`, `meta_ads_setting_created_by_username`, `meta_ads_setting_created_by_date`, `meta_ads_setting_created_by_time`, `meta_ads_setting_status`) VALUES
(1, 'Honey moon Normal', '1231429298910459', '', 1, 'Super admin', '2026-04-14', '15:17:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meta_ads_setting_staff`
--

CREATE TABLE `meta_ads_setting_staff` (
  `meta_ads_setting_staff_id` int(11) NOT NULL,
  `meta_ads_setting_id_fk` int(11) NOT NULL,
  `meta_ads_setting_staff_id_fk` int(11) NOT NULL,
  `meta_ads_setting_staff_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `meta_ads_setting_staff`
--

INSERT INTO `meta_ads_setting_staff` (`meta_ads_setting_staff_id`, `meta_ads_setting_id_fk`, `meta_ads_setting_staff_id_fk`, `meta_ads_setting_staff_status`) VALUES
(1, 1, 7, 1),
(2, 1, 8, 1),
(3, 1, 9, 1),
(4, 1, 11, 1);

-- --------------------------------------------------------

--
-- Table structure for table `meta_lead_logs`
--

CREATE TABLE `meta_lead_logs` (
  `id` int(11) NOT NULL,
  `leadgen_id` varchar(50) NOT NULL,
  `page_id` varchar(50) DEFAULT NULL,
  `form_id` varchar(50) DEFAULT NULL,
  `ad_id` varchar(50) DEFAULT NULL,
  `raw_payload` longtext DEFAULT NULL,
  `status` varchar(20) DEFAULT 'received',
  `error_message` longtext DEFAULT NULL,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE `packages` (
  `packages_id` int(11) NOT NULL,
  `packages_category_id_fk` int(11) NOT NULL,
  `packages_itinerary_category_id_fk` int(11) NOT NULL,
  `packages_itinerary_id_fk` int(11) NOT NULL,
  `packages_inclusion_exclusion_common_id_fk` int(11) DEFAULT NULL,
  `packages_inclusion_exclusion_checked_type` varchar(50) DEFAULT NULL,
  `packages_optional_add_on_checked_type` varchar(50) DEFAULT NULL,
  `packages_special_requirment_checked_type` varchar(50) DEFAULT NULL,
  `packages_payment_policies_checked_type` varchar(50) DEFAULT NULL,
  `packages_terms_conditions_checked_type` varchar(50) DEFAULT NULL,
  `packages_cancellation_policy_checked_type` varchar(50) DEFAULT NULL,
  `packages_notes_checked_type` varchar(50) DEFAULT NULL,
  `packages_property_checked_type` varchar(50) DEFAULT NULL,
  `packages_title` text NOT NULL,
  `packages_duration_in_nights` int(11) NOT NULL,
  `packages_bank_details` text NOT NULL,
  `packages_qr_code_doc` varchar(255) NOT NULL,
  `packages_first_cover_page` varchar(255) NOT NULL,
  `packages_last_cover_page` varchar(255) NOT NULL,
  `packages_description` text DEFAULT NULL,
  `packages_createdby_user_id` int(11) NOT NULL,
  `packages_createdby_user_name` varchar(255) NOT NULL,
  `packages_created_date` date NOT NULL,
  `packages_created_time` time NOT NULL,
  `packages_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`packages_id`, `packages_category_id_fk`, `packages_itinerary_category_id_fk`, `packages_itinerary_id_fk`, `packages_inclusion_exclusion_common_id_fk`, `packages_inclusion_exclusion_checked_type`, `packages_optional_add_on_checked_type`, `packages_special_requirment_checked_type`, `packages_payment_policies_checked_type`, `packages_terms_conditions_checked_type`, `packages_cancellation_policy_checked_type`, `packages_notes_checked_type`, `packages_property_checked_type`, `packages_title`, `packages_duration_in_nights`, `packages_bank_details`, `packages_qr_code_doc`, `packages_first_cover_page`, `packages_last_cover_page`, `packages_description`, `packages_createdby_user_id`, `packages_createdby_user_name`, `packages_created_date`, `packages_created_time`, `packages_status`) VALUES
(1, 3, 3, 1, 3, 'Y', NULL, NULL, 'Y', 'Y', 'Y', NULL, 'Y', '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', 4, '', '', 'pkg_cover_copy_1774066380_1223.jpg', 'pkg_cover_copy_1774066380_8922.jpg', NULL, 1, 'Super admin', '2026-03-21', '09:43:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_cancellation_policies`
--

CREATE TABLE `packages_cancellation_policies` (
  `packages_cancellation_policies_id` int(11) NOT NULL,
  `packages_cancellation_policies_packages_id_fk` int(11) NOT NULL,
  `cancellation_policies_id_fk` int(11) NOT NULL,
  `cancellation_policies_item_id_fk` int(11) NOT NULL,
  `packages_cancellation_policies_type` varchar(50) NOT NULL,
  `packages_cancellation_policies_details` text NOT NULL,
  `packages_cancellation_policies_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_cancellation_policies`
--

INSERT INTO `packages_cancellation_policies` (`packages_cancellation_policies_id`, `packages_cancellation_policies_packages_id_fk`, `cancellation_policies_id_fk`, `cancellation_policies_item_id_fk`, `packages_cancellation_policies_type`, `packages_cancellation_policies_details`, `packages_cancellation_policies_status`) VALUES
(1, 1, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_exclusions`
--

CREATE TABLE `packages_exclusions` (
  `packages_exclusions_id` int(11) NOT NULL,
  `packages_id_fk` int(11) NOT NULL,
  `exclusions_common_id_fk` int(11) DEFAULT NULL,
  `exclusions_id_fk` int(11) DEFAULT NULL,
  `packages_exclusions_type` varchar(50) NOT NULL,
  `packages_exclusions_details` text NOT NULL,
  `packages_exclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_exclusions`
--

INSERT INTO `packages_exclusions` (`packages_exclusions_id`, `packages_id_fk`, `exclusions_common_id_fk`, `exclusions_id_fk`, `packages_exclusions_type`, `packages_exclusions_details`, `packages_exclusions_status`) VALUES
(1, 1, 3, NULL, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(2, 1, 3, NULL, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(3, 1, 3, NULL, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(4, 1, 3, NULL, 'Y', 'Any entry fees/Camera Fees.', 1),
(5, 1, 3, NULL, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_inclusions`
--

CREATE TABLE `packages_inclusions` (
  `packages_inclusions_id` int(11) NOT NULL,
  `packages_id_fk` int(11) NOT NULL,
  `inclusion_common_id_fk` int(11) DEFAULT NULL,
  `inclusions_id_fk` int(11) DEFAULT NULL,
  `packages_inclusions_type` varchar(50) NOT NULL,
  `packages_inclusions_details` text NOT NULL,
  `packages_inclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_inclusions`
--

INSERT INTO `packages_inclusions` (`packages_inclusions_id`, `packages_id_fk`, `inclusion_common_id_fk`, `inclusions_id_fk`, `packages_inclusions_type`, `packages_inclusions_details`, `packages_inclusions_status`) VALUES
(1, 1, 3, NULL, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(2, 1, 3, NULL, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(3, 1, 3, NULL, 'Y', 'Resort with Breakfast', 1),
(4, 1, 3, NULL, 'Y', 'Houseboat with all meals', 1),
(5, 1, 3, NULL, 'Y', 'Sightseeing as per itinerary', 1),
(6, 1, 3, NULL, 'Y', 'A Professional Driver cum Guide', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_itinerary`
--

CREATE TABLE `packages_itinerary` (
  `packages_itinerary_id` int(11) NOT NULL,
  `packages_id_fk` int(11) NOT NULL,
  `itineraries_id_fk` int(11) NOT NULL,
  `packages_itinerary_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_itinerary`
--

INSERT INTO `packages_itinerary` (`packages_itinerary_id`, `packages_id_fk`, `itineraries_id_fk`, `packages_itinerary_status`) VALUES
(1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_itinerary_days`
--

CREATE TABLE `packages_itinerary_days` (
  `packages_itinerary_days_id` int(11) NOT NULL,
  `packages_itinerary_id_fk` int(11) NOT NULL,
  `itineraries_days_id_fk` int(11) NOT NULL,
  `packages_itineraries_days_day` varchar(50) NOT NULL,
  `packages_itineraries_days_destination_id_fk` int(11) NOT NULL,
  `packages_itineraries_days_title` varchar(255) NOT NULL,
  `packages_itineraries_days_image` varchar(255) NOT NULL,
  `packages_itineraries_days_description` text NOT NULL,
  `packages_itineraries_days_travel_back` varchar(255) NOT NULL,
  `packages_itineraries_days_required_status` int(11) NOT NULL COMMENT '1->required,2->not required',
  `packages_itinerary_days_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_itinerary_days`
--

INSERT INTO `packages_itinerary_days` (`packages_itinerary_days_id`, `packages_itinerary_id_fk`, `itineraries_days_id_fk`, `packages_itineraries_days_day`, `packages_itineraries_days_destination_id_fk`, `packages_itineraries_days_title`, `packages_itineraries_days_image`, `packages_itineraries_days_description`, `packages_itineraries_days_travel_back`, `packages_itineraries_days_required_status`, `packages_itinerary_days_status`) VALUES
(1, 1, 1, 'Day 1', 5, 'COCHIN TO MUNNAR', 'pkgday_69be1acc338016.81352938.webp', '<ul><li>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</li><li>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</li><li>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</li><li>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</li><li>Overnight stay at the Hotel / Resort</li></ul>', '', 0, 1),
(2, 1, 2, 'Day 2', 5, 'MUNNAR SIGHTSEEING', 'pkgday_69be1acc343912.11110904.webp', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park </strong>where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 0, 1),
(3, 1, 3, 'Day 3', 6, 'MUNNAR TO THEKKADY', 'pkgday_69be1acc3460c3.33932979.jpg', '<ul><li>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</li><li>Take a boat cruise on <strong>Periyar Lake in Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to spot wildlife like elephants, deer, and birds.</li><li>Experience a memorable <strong>Elephant encounter with rides, bathing, and feeding</strong></li><li>End the evening with mesmerizing cultural performances of <strong>Kathakaliand Kerala’s traditional martial arts</strong></li><li>Overnight stay in the Hotel/ Resort.</li></ul>', '', 0, 1),
(4, 1, 4, 'Day 4', 7, 'THEKKADY TO ALAPPEY', 'pkgday_69be1acc348b07.48768789.jpg', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East’</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerable lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 0, 1),
(5, 1, 5, 'Day 5', 20, 'ALAPPEY TO COCHIN', 'pkgday_69be1acc34ad87.60139813.webp', '<ul><li>After breakfast, checkout from the Houseboat and drive towards <strong>Cochin</strong>; the Queen of the Arabian Sea</li><li>On the sightsseen:- <strong>Marari Beach, Arthunkal Basilica</strong></li><li>Arriving in Cochin, Visit <strong>Forklore Museum, Cochin Backwaters, St Francis Church, Mattanchery Palace (Dutch Palace), Jewish Synagogue and Jew Town, Fort Kochi Beach.</strong></li><li>Take a stroll along the fort kochi waterfront to see the iconic chineese fishing nets</li><li>Local shopping and drop at Ernakulam Railway/ Cochin Airport</li></ul>', 'TB', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_notes`
--

CREATE TABLE `packages_notes` (
  `packages_notes_id` int(11) NOT NULL,
  `packages_notes_packages_id_fk` int(11) NOT NULL,
  `packages_notes_details` text NOT NULL,
  `packages_notes_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages_optional_add_on`
--

CREATE TABLE `packages_optional_add_on` (
  `packages_optional_add_on_id` int(11) NOT NULL,
  `packages_optional_add_on_packages_id_fk` int(11) NOT NULL,
  `packages_optional_add_on_details` text NOT NULL,
  `packages_optional_add_on_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages_payment_policies`
--

CREATE TABLE `packages_payment_policies` (
  `packages_payment_policies_id` int(11) NOT NULL,
  `packages_payment_policies_packages_id_fk` int(11) NOT NULL,
  `payment_policies_id_fk` int(11) NOT NULL,
  `payment_policies_items_id_fk` int(11) NOT NULL,
  `packages_payment_policies_type` varchar(50) NOT NULL,
  `packages_payment_policies_details` text NOT NULL,
  `packages_payment_policies_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_payment_policies`
--

INSERT INTO `packages_payment_policies` (`packages_payment_policies_id`, `packages_payment_policies_packages_id_fk`, `payment_policies_id_fk`, `payment_policies_items_id_fk`, `packages_payment_policies_type`, `packages_payment_policies_details`, `packages_payment_policies_status`) VALUES
(1, 1, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_properties`
--

CREATE TABLE `packages_properties` (
  `packages_properties_id` int(11) NOT NULL,
  `packages_properties_days_id_fk` int(11) NOT NULL,
  `properties_id_fk` int(11) NOT NULL,
  `packages_properties_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_properties`
--

INSERT INTO `packages_properties` (`packages_properties_id`, `packages_properties_days_id_fk`, `properties_id_fk`, `packages_properties_status`) VALUES
(1, 1, 20, 1),
(2, 1, 21, 1),
(3, 1, 35, 1),
(4, 2, 20, 1),
(5, 2, 21, 1),
(6, 2, 35, 1),
(7, 3, 37, 1),
(8, 3, 39, 1),
(9, 4, 38, 1),
(10, 6, 26, 1),
(11, 6, 50, 1),
(12, 7, 26, 1),
(13, 7, 50, 1),
(14, 8, 51, 1),
(15, 8, 49, 1),
(16, 9, 38, 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_properties_common`
--

CREATE TABLE `packages_properties_common` (
  `packages_properties_common_id` int(11) NOT NULL,
  `packages_properties_common_packages_id_fk` int(11) NOT NULL,
  `packages_properties_common_category_name` varchar(255) NOT NULL,
  `packages_properties_common_design_type` varchar(50) NOT NULL,
  `packages_properties_common_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_properties_common`
--

INSERT INTO `packages_properties_common` (`packages_properties_common_id`, `packages_properties_common_packages_id_fk`, `packages_properties_common_category_name`, `packages_properties_common_design_type`, `packages_properties_common_status`) VALUES
(1, 1, 'STANDARD PACKAGE', 'Standard', 1),
(2, 1, 'PREMIUM PACKAGE', 'Exclusive', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_properties_days`
--

CREATE TABLE `packages_properties_days` (
  `packages_properties_days_id` int(11) NOT NULL,
  `packages_properties_common_id_fk` int(11) NOT NULL,
  `packages_itinerary_days_id_fk` int(11) NOT NULL,
  `packages_properties_days_day` varchar(50) NOT NULL,
  `packages_properties_days_destination_id_fk` int(11) NOT NULL,
  `packages_properties_days_travel_back` varchar(255) NOT NULL,
  `packages_properties_days_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_properties_days`
--

INSERT INTO `packages_properties_days` (`packages_properties_days_id`, `packages_properties_common_id_fk`, `packages_itinerary_days_id_fk`, `packages_properties_days_day`, `packages_properties_days_destination_id_fk`, `packages_properties_days_travel_back`, `packages_properties_days_status`) VALUES
(1, 1, 1, 'Day 1', 5, '', 1),
(2, 1, 2, 'Day 2', 5, '', 1),
(3, 1, 3, 'Day 3', 6, '', 1),
(4, 1, 4, 'Day 4', 7, '', 1),
(5, 1, 5, 'Day 5', 20, 'TB', 1),
(6, 2, 1, 'Day 1', 5, '', 1),
(7, 2, 2, 'Day 2', 5, '', 1),
(8, 2, 3, 'Day 3', 6, '', 1),
(9, 2, 4, 'Day 4', 7, '', 1),
(10, 2, 5, 'Day 5', 20, 'TB', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_properties_rooms`
--

CREATE TABLE `packages_properties_rooms` (
  `packages_properties_rooms_id` int(11) NOT NULL,
  `packages_properties_id_fk` int(11) NOT NULL,
  `packages_properties_rooms_id_fk` int(11) NOT NULL,
  `packages_properties_rooms_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_properties_rooms`
--

INSERT INTO `packages_properties_rooms` (`packages_properties_rooms_id`, `packages_properties_id_fk`, `packages_properties_rooms_id_fk`, `packages_properties_rooms_status`) VALUES
(1, 1, 22, 1),
(2, 2, 23, 1),
(3, 3, 62, 1),
(4, 4, 22, 1),
(5, 5, 23, 1),
(6, 6, 62, 1),
(7, 7, 67, 1),
(8, 8, 70, 1),
(9, 9, 68, 1),
(10, 10, 33, 1),
(11, 11, 106, 1),
(12, 12, 32, 1),
(13, 13, 106, 1),
(14, 14, 111, 1),
(15, 15, 100, 1),
(16, 16, 69, 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_special_requirements`
--

CREATE TABLE `packages_special_requirements` (
  `packages_special_requirements_id` int(11) NOT NULL,
  `packages_special_requirements_packages_id_fk` int(11) NOT NULL,
  `special_requirements_id_fk` int(11) NOT NULL,
  `packages_special_requirements_cost` double NOT NULL,
  `packages_special_requirements_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `packages_terms_condition`
--

CREATE TABLE `packages_terms_condition` (
  `packages_terms_condition_id` int(11) NOT NULL,
  `packages_terms_condition_packages_id_fk` int(11) NOT NULL,
  `terms_condition_id_fk` int(11) NOT NULL,
  `terms_condition_item_id_fk` int(11) NOT NULL,
  `packages_terms_condition_type` varchar(50) NOT NULL,
  `packages_terms_condition_details` text NOT NULL,
  `packages_terms_condition_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `packages_terms_condition`
--

INSERT INTO `packages_terms_condition` (`packages_terms_condition_id`, `packages_terms_condition_packages_id_fk`, `terms_condition_id_fk`, `terms_condition_item_id_fk`, `packages_terms_condition_type`, `packages_terms_condition_details`, `packages_terms_condition_status`) VALUES
(1, 1, 4, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.\r\nHotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).\r\nExtra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.\r\nIf your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.\r\nProperties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.\r\nCab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.\r\nA photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.\r\nFor Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.\r\nKindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `package_category`
--

CREATE TABLE `package_category` (
  `package_category_id` int(11) NOT NULL,
  `package_category_name` varchar(255) NOT NULL,
  `package_category_description` text NOT NULL,
  `package_category_createdby_user_id` int(11) NOT NULL,
  `package_category_createdby_user_name` varchar(255) NOT NULL,
  `package_category_created_date` date NOT NULL,
  `package_category_created_time` time NOT NULL,
  `package_category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `package_category`
--

INSERT INTO `package_category` (`package_category_id`, `package_category_name`, `package_category_description`, `package_category_createdby_user_id`, `package_category_createdby_user_name`, `package_category_created_date`, `package_category_created_time`, `package_category_status`) VALUES
(1, 'gghjjjk', 'gj', 1, 'Super admin', '2025-08-29', '11:42:01', 0),
(2, 'JAm_edited', 'nn_edited', 1, 'Super admin', '2026-01-25', '03:23:34', 0),
(3, 'HONEYMOON', '', 1, 'Super admin', '2026-02-25', '05:08:31', 1),
(4, 'NORMAL', '', 1, 'Super admin', '2026-02-25', '05:08:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_policies`
--

CREATE TABLE `payment_policies` (
  `payment_policies_id` int(11) NOT NULL,
  `payment_policies_name` varchar(255) NOT NULL,
  `payment_policies_createdby_user_id` int(11) NOT NULL,
  `payment_policies_createdby_user_name` varchar(255) NOT NULL,
  `payment_policies_created_date` date NOT NULL,
  `payment_policies_created_time` time NOT NULL,
  `payment_policies_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_policies`
--

INSERT INTO `payment_policies` (`payment_policies_id`, `payment_policies_name`, `payment_policies_createdby_user_id`, `payment_policies_createdby_user_name`, `payment_policies_created_date`, `payment_policies_created_time`, `payment_policies_status`) VALUES
(1, 'cbc', 0, '', '2025-07-25', '08:22:16', 1),
(2, 'yuyu', 1, 'Super admin', '2025-09-13', '12:04:36', 1),
(3, 'a', 0, '', '2026-01-25', '03:45:18', 1),
(4, 'Test onr_edited', 0, '', '2026-01-25', '04:02:36', 0),
(5, 'KERALA - PP - 30%', 0, '', '2026-02-17', '07:26:21', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_policies_items`
--

CREATE TABLE `payment_policies_items` (
  `payment_policies_items_id` int(11) NOT NULL,
  `payment_policies_id_fk` int(11) NOT NULL,
  `payment_policies_items_name` varchar(255) NOT NULL,
  `payment_policies_items_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `payment_policies_items`
--

INSERT INTO `payment_policies_items` (`payment_policies_items_id`, `payment_policies_id_fk`, `payment_policies_items_name`, `payment_policies_items_status`) VALUES
(1, 1, 'vn', 1),
(2, 1, 'gx', 1),
(3, 2, 'yutyu', 1),
(4, 2, 'utyu', 1),
(5, 2, 'l;l', 1),
(6, 2, 'l;;l', 1),
(7, 3, '', 1),
(8, 4, 'mma_edited', 1),
(9, 4, 'hsns_edited', 1),
(10, 5, 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `priority_status`
--

CREATE TABLE `priority_status` (
  `priority_status_id` int(11) NOT NULL,
  `priority_status_name` varchar(255) NOT NULL,
  `priority_status_button` text NOT NULL,
  `priority_status_description` text NOT NULL,
  `priority_status_created_date` date NOT NULL,
  `priority_status_created_time` time NOT NULL,
  `priority_status_created_user_id` int(11) NOT NULL,
  `priority_status_created_username` varchar(255) NOT NULL,
  `priority_status_created_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `priority_status`
--

INSERT INTO `priority_status` (`priority_status_id`, `priority_status_name`, `priority_status_button`, `priority_status_description`, `priority_status_created_date`, `priority_status_created_time`, `priority_status_created_user_id`, `priority_status_created_username`, `priority_status_created_status`) VALUES
(1, 'HOT', '<center><span class=\"btn btn-sm\" style=\"background-color:#ff0000\"><span style=\"color:white\">HOT</span></span></center>', '', '2026-04-19', '22:01:42', 1, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE `properties` (
  `properties_id` int(11) NOT NULL,
  `property_category_id_fk` int(11) NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `state_id_fk` int(11) NOT NULL,
  `properties_destination_id_fk` int(11) NOT NULL,
  `properties_house_boat_type` varchar(50) NOT NULL,
  `properties_hotel_url` varchar(255) NOT NULL,
  `properties_name` varchar(255) NOT NULL,
  `properties_check_type` varchar(50) NOT NULL,
  `properties_check_in_time` time DEFAULT NULL,
  `properties_check_out_time` time DEFAULT NULL,
  `properties_sales_contact_name` varchar(255) NOT NULL,
  `properties_sales_contact_phone_number` varchar(255) NOT NULL,
  `properties_sales_contact_email` varchar(255) NOT NULL,
  `properties_reservation_contact_name` varchar(255) NOT NULL,
  `properties_reservation_contact_phone_number` varchar(255) NOT NULL,
  `properties_reservation_contact_email` varchar(255) NOT NULL,
  `properties_google_map_location` varchar(255) NOT NULL,
  `properties_hotel_logo` varchar(255) NOT NULL,
  `properties_photos` varchar(255) NOT NULL,
  `properties_description` text NOT NULL,
  `properties_createdby_userid` int(11) NOT NULL,
  `properties_createdby_username` varchar(255) NOT NULL,
  `properties_create_date` date NOT NULL,
  `properties_create_time` time NOT NULL,
  `properties_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`properties_id`, `property_category_id_fk`, `country_id_fk`, `state_id_fk`, `properties_destination_id_fk`, `properties_house_boat_type`, `properties_hotel_url`, `properties_name`, `properties_check_type`, `properties_check_in_time`, `properties_check_out_time`, `properties_sales_contact_name`, `properties_sales_contact_phone_number`, `properties_sales_contact_email`, `properties_reservation_contact_name`, `properties_reservation_contact_phone_number`, `properties_reservation_contact_email`, `properties_google_map_location`, `properties_hotel_logo`, `properties_photos`, `properties_description`, `properties_createdby_userid`, `properties_createdby_username`, `properties_create_date`, `properties_create_time`, `properties_status`) VALUES
(1, 1, 3, 4, 4, 'N', 'khk', 'Janath', 'T', '00:00:00', '00:00:00', 'gj', '5656', 'ggk', 'sfsdfsd', '34343', 'dfg_edited', 'uououo', 'Edappally_Monthly_Report_June_2025.pdf', 'Doc1.pdf', 'dgd', 0, '', '2025-07-31', '07:21:53', 0),
(2, 2, 3, 1, 4, 'Y', '', 'Majestic', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-31', '08:44:45', 0),
(3, 2, 3, 4, 1, 'Y', '', 'sds', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-08-01', '06:57:03', 0),
(4, 1, 2, 4, 4, 'Y', '', 'Trret', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-08-01', '10:31:20', 0),
(5, 2, 4, 4, 4, 'Y', 'sd_Edited', 'Test propery_Edited', 'T', '03:10:00', '13:15:00', 'sd_Edited', '20', 'sd@s_Edited', 'ds_Edited', '20', 'sd_Edited', 'sdf_Edited', '', '', 'sdf_Edited', 1, 'Super admin', '2026-01-25', '06:21:01', 0),
(6, 1, 99, 1, 1, 'Y', '', 'Mithra', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-06', '09:18:18', 0),
(7, 7, 99, 5, 5, 'N', '', 'SPICE JUNGLE', 'O', '14:00:00', '11:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-07', '05:43:13', 0),
(8, 9, 99, 4, 4, 'N', '', 'SANDRA', 'O', '14:00:00', '11:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-07', '12:53:49', 0),
(9, 7, 99, 5, 5, 'N', '', 'View munnar', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-08', '03:40:51', 0),
(10, 7, 99, 5, 5, 'N', '', 'VELVET VISTA', 'O', '14:00:00', '11:00:00', '8989878789', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-16', '01:31:35', 0),
(11, 8, 99, 5, 5, 'N', '', 'NAVNEETHAM VILLA STAY', 'O', '14:00:00', '11:00:00', '', '', '', '', '', '', 'https://www.google.co.in/travel/search?ts=CAESCgoCCAMKAggDEAAaHBIaEhQKBwjqDxACGBQSBwjqDxACGBUYATICEAAqBwoFOgNJTlI&qs=CAEyFENnc0k1WWZtbXN5ZWllYjhBUkFCOAhCCRFLis-vrvYoAUIJEcai26UKJg0K&utm_campaign=sharing&utm_medium=link_btn&utm_source=htls', '', '', '', 1, 'Super admin', '2026-02-17', '06:50:56', 0),
(12, 8, 99, 6, 6, 'N', '', 'WHITE FORT ', 'O', '14:00:00', '11:00:00', 'aakak', '8988989808', '', '', '', '', '', '080b486447649e4723caab59a8149522.jpeg', '', '', 1, 'Super admin', '2026-02-17', '07:05:59', 0),
(13, 8, 99, 7, 7, 'Y', '', 'deluxe houseboat', 'O', '00:00:00', '09:00:00', '', '', '', '', '', '', '', '', 'ac9f59cb85a1bd4eca2c0e921c4570ef.jpg', '', 1, 'Super admin', '2026-02-17', '07:06:56', 0),
(14, 6, 3, 5, 6, 'Y', '', 'test', 'T', NULL, NULL, '', '', '', '', '', '', '', '387255a5e540b3caafebabc032042466.png', 'f43f61b9b4d222eea332cbe90e9d601c.jpg', '', 1, 'Super admin', '2026-02-18', '10:59:15', 0),
(15, 8, 99, 8, 8, 'N', '', 'QUALITY INN', 'O', '14:00:00', '11:00:00', '', '', '', '', '', '', '', '', '6951e4f622e7cacba9ca3efba552f199.jpeg', '', 1, 'Super admin', '2026-02-18', '11:30:22', 0),
(16, 6, 99, 6, 5, 'N', '', 'Test', 'T', NULL, NULL, '', '', '', '', '', '', '', 'a10183dc95c7272c6026392b8b978c2a.jpg', '18f0692a2b26d86d42d09cefc8428587.jpg', '', 1, 'Super admin', '2026-02-18', '05:11:45', 0),
(17, 6, 1, 6, 7, 'Y', '', 'Test', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '0780d5bd0e3b3adf96a6904a220ad0b6.png', '', 1, 'Super admin', '2026-02-18', '05:50:09', 0),
(18, 7, 1, 6, 5, 'Y', '', 'nuu', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '34bed06cbb3dc9444160b2d4ee23dfed.pdf', '', 1, 'Super admin', '2026-02-18', '06:27:15', 0),
(19, 6, 1, 7, 7, 'Y', '', 'jdjjd', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '0c783d4303ae305a9d1e524a1163367a.pdf', '', 1, 'Super admin', '2026-02-18', '06:53:26', 0),
(20, 7, 99, 5, 5, 'N', '', 'Velvet Vista', 'O', '14:00:00', '11:00:00', 'JACKSON', '+91 94971 09571', '', 'JACKSON', '+91 94971 09571', '', 'https://share.google/TQvWAUZleOe5No9W0', '', '49f0226fa7839b53911cf034e32ea75e.pdf', '', 1, 'Super admin', '2026-02-19', '06:35:38', 1),
(21, 13, 99, 5, 5, 'N', 'https://arbourresortmunnar.com', 'The Arbour Resort', 'O', '14:00:00', '11:00:00', 'RAINWOOD', '+91 85929 69698', 'sales@rainwoodhotels.com', 'Anjana', '+91 85929 69698', 'sales@rainwoodhotels.com', 'https://share.google/0CbH87Iz9ewTjBZYr', 'bb071d50de235cfa6e8d0c734d3ac1cf.jpg', '56e757b3869deab64d11b28541858280.pdf', '', 1, 'Super admin', '2026-02-19', '06:49:57', 1),
(22, 9, 99, 8, 8, 'N', 'https://www.deshadan.com/varkala.php', 'Deshadan Cliff & Beach Resort', 'O', '14:00:00', '11:00:00', 'DESHADAN', '9447459912', '', '', '', '', 'https://share.google/PtTZ8rXhhqZaJmMpy', '596a4bbb84f6623ade2fa85d19ac31ad.png', '627a1a5505962c53eb6b49b46a646648.pdf', '', 1, 'Super admin', '2026-02-19', '07:21:43', 1),
(23, 8, 99, 5, 5, 'N', '', 'Navaneetham Villa Stay', 'O', '14:00:00', '11:00:00', 'NAVANEETHAM', '+91 95260 37270', '', '', '', '', 'https://www.google.com/travel/hotels/s/w7wZd5inf3szoukK9', '', 'aa5b3bb5370560939ae02b6bbe3aa09a.pdf', '', 1, 'Super admin', '2026-02-19', '07:39:05', 1),
(24, 7, 99, 21, 21, 'N', '', 'Ananthapuram Residency', 'O', '14:00:00', '11:00:00', 'PRAGATHY HOSPITALITY', '8592929230', 'sales@pragathihospitality.com', 'PRAGATHY HOSPITALITY', '', '', 'https://share.google/vQGcSQJKFDNfBs53b', '', '', '', 1, 'Super admin', '2026-02-19', '10:19:33', 1),
(25, 0, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '10:47:05', 1),
(26, 13, 99, 5, 5, 'N', 'https://www.deshadan.com/munnar.php', 'Deshadan Mountain Resort', 'O', '14:00:00', '11:00:00', 'DESHADAN', '9447459912', 'reservations@deshadan.com', 'DESHADAN', '9447459912', 'reservations@deshadan.com', 'https://share.google/KwsOBMsLNLIOK34MY', '8eaa404c850033c58ecb5f29969c01fc.png', '5939702b969abec3246268277c452514.pdf', '', 1, 'Super admin', '2026-02-19', '11:16:39', 1),
(27, 8, 99, 5, 5, 'N', '', 'Munnar Valley Nest Stay', 'O', '14:00:00', '11:00:00', 'YOUSUF', '+91 94471 66356', '', '', '9497025001', '', 'https://share.google/S5xDX8yXLxNABMUVZ', '', '32c6b567945ac5721872c5bd7d263598.pdf', '', 1, 'Super admin', '2026-02-19', '11:48:15', 1),
(28, 13, 99, 10, 10, 'N', 'https://jasminepalacekovalam.com', 'Jasmin Palace', 'O', '14:00:00', '11:00:00', 'SRIKANTH', '+91 94959 43941', 'jasminepalace@rudraleisure.com', 'RESHMA', '+91 6235 001 823', 'jasminepalace@rudraleisure.com', 'https://share.google/qjnwTX7tukzMYxxQf', '', 'b0f8d57cfcad28baf343b8e17dfb04ab.pdf', '', 1, 'Super admin', '2026-02-22', '04:05:57', 1),
(29, 13, 99, 10, 10, 'N', 'http://www.swagathresort.com', 'Swagath Holidays', 'O', '14:00:00', '11:00:00', 'SWAGATH', '+91 999 508 8883', 'swagathresort@gmail.com', 'SWAGATH', '91 799 496 9997', 'swagathresort@gmail.com', 'https://share.google/ZHxOVfUHXACUXY6KX', '1dd69f68b718d47e605049752f84c2fd.png', '09db63639e214855cb3648993971b3bc.pdf', '', 1, 'Super admin', '2026-02-22', '05:36:48', 1),
(30, 7, 99, 10, 10, 'N', 'https://www.opalohotels.com/Kovalam/', 'Opalo Kailas', 'O', '14:00:00', '11:00:00', 'MANJUSHA', '+91 94974 97577', 'bookings@opalohospitality.com', '', '', '', '', '', '344499671b3f047d5c772d62d8f082c9.pdf', '', 1, 'Super admin', '2026-02-22', '05:58:36', 1),
(31, 7, 99, 8, 8, 'N', 'https://www.blackbeachresort.in', 'Black Beach Resort', 'O', '14:00:00', '11:00:00', 'BLACK BEACH', '+91 96455 52677', '', '', '', '', 'https://share.google/A6qAHFQNmfYAp2r53', '04276b04f2d7a1725ff65d447792fa3f.png', 'dd1a33f4ac47f52c7edcc6647bde33cc.pdf', '', 1, 'Super admin', '2026-02-22', '06:31:12', 1),
(32, 10, 99, 5, 5, 'N', 'https://triversmunnar.com', 'Trivers Resort', 'O', '14:00:00', '11:00:00', 'Dhanya', '+91 990611 00400', 'reservations@triversmunnar.com', 'shan', '+91 79071 65576', 'sales@zitronehotels.com', 'https://share.google/ZdEt0MaP7q2HNL9x3', 'b27c41e9d90a7de1649bfb304ab7c8b9.png', '3bd868899d4b29a8967996bb39b4f26f.pdf', '', 1, 'Super admin', '2026-02-24', '04:25:29', 1),
(33, 10, 99, 8, 8, 'N', 'https://marisolhotels.com', 'West Bay Marisol', 'O', '14:00:00', '11:00:00', 'GOPIKA', '+91 97785 11734', 'sales@zitronehotels.com', 'SHAN ZITRON', '+91 79071 65576', 'sales@zitronehotels.com', 'https://share.google/IuEe7mHhpXN1ERllB', 'dfc1e210c824d27f2a1e263e0c4878f6.png', '68c0731beed83242b4b1cb019e20a644.pdf', '', 1, 'Super admin', '2026-02-24', '05:32:16', 1),
(34, 8, 99, 6, 6, 'N', '', 'White Fort', 'O', '14:00:00', '11:00:00', 'WHITE FORT', '+91 85472 44772', '', '', '', '', 'https://share.google/HQUMsDiCDLIIbo3V8', '', 'af1f6618f5c7e0fbc16309347163aad4.pdf', '', 1, 'Super admin', '2026-02-25', '02:06:16', 1),
(35, 7, 99, 5, 5, 'N', '', 'Belita Infinity Pool Resort', 'O', '14:00:00', '11:00:00', 'BELITA', '+91 89211 51840', '', 'BELITA', '?+91 85904 52542?', '', 'https://share.google/A4tQdPPQ4MIk8bqem', '5349f003992064c6a6254f3bd32c33fd.png', '226d0a0d62844c1c1678b27298adb915.pdf', '', 1, 'Super admin', '2026-02-25', '03:02:02', 1),
(36, 7, 99, 5, 5, 'N', 'https://brightmeadowresorts.com', 'Bright Meadow Dam View', 'O', '14:00:00', '11:00:00', 'BRIGHT MEADOW', '?+91 88489 78848?', '', 'MIDHUN', '+91 97782 67783', '', 'https://share.google/1czKDMl7oJoWozN2g', '89540c42f21b54b81927041775e72c8e.png', '418042e30d9132eb2a90aa37ff28d971.pdf', '', 1, 'Super admin', '2026-02-25', '03:26:15', 1),
(37, 7, 99, 6, 6, 'N', '', 'Livinns', 'O', '14:00:00', '11:00:00', 'LIVINNS', '+91 83049 02013', '', '', '', '', 'https://share.google/vRj61D5BR5jEnjU16', '1c43e2e61ebc0c4bee444aa3076de1d3.jpeg', '791bab04d4249c637d7f38ac6f048c5f.pdf', '', 1, 'Super admin', '2026-02-25', '03:38:22', 1),
(38, 15, 99, 7, 7, 'Y', '', 'Deluxe Houseboat', 'O', '12:00:00', '09:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-25', '03:47:02', 1),
(39, 7, 99, 6, 6, 'N', 'https://www.rainwoodpatio.com', 'The Patio', 'O', '14:00:00', '11:00:00', 'RAINWOOD', '+91 85929 69632', 'sales@rainwoodhotels.com', '', '', '', '', '', 'cd67043c0c407670c46b8e8504ec49b6.pdf', '', 1, 'Super admin', '2026-02-25', '04:42:16', 1),
(40, 7, 99, 10, 10, 'N', 'https://www.godsownvilla.com', 'Gods Own Villa', 'O', '14:00:00', '11:00:00', '', '', '', '', '', '', 'https://share.google/B4Y3hr0wkylGqaMoS', 'af601b705492fc15e1739c0be006d069.jpeg', '3a8b6a794f36aca8abbfc56d583cd9e8.pdf', '', 1, 'Super admin', '2026-02-26', '12:47:25', 1),
(41, 10, 99, 7, 7, 'N', 'https://www.deshadan.com/muhamma.php', 'Deshadan Backwater Resort', 'O', '14:00:00', '11:00:00', 'DESHADAN', '9447459912', '	reservations@deshadan.com', '', '', '', 'https://share.google/8d2gyi72Z48Me2VpS', '3139a2b313b7286389ab13d3de247d61.png', '', '', 1, 'Super admin', '2026-02-27', '12:14:23', 1),
(42, 13, 99, 18, 18, 'N', 'https://www.deshadan.com/kanthalloor.php', 'Deshadan Eco Valley Resort', 'O', '14:00:00', '11:00:00', '', '9447459912', '', '', '99950 55567', '', 'https://share.google/DvWENvuH6I9YeM7ha', '19a3cb70d1ac125969465983d3beb1e0.png', '', '', 1, 'Super admin', '2026-02-27', '02:01:15', 1),
(43, 11, 99, 8, 8, 'N', 'https://elixircliff.com', 'Elixer Cliff & Beach Resort', 'O', '14:00:00', '11:00:00', '', '9188519780', 'reservation@elixircliff.com', '', '', '', 'https://share.google/eglcndfAvFzOTYSi3', '5fd292ad41fb180f35573071408da533.png', '8c761fb4eca727e755da67f5a1b02c17.pdf', '', 1, 'Super admin', '2026-02-27', '02:36:57', 1),
(44, 7, 99, 5, 5, 'N', 'https://www.maathotels.com/spice-jungle-resort', 'Spice Jungle Resort', 'O', '14:00:00', '11:00:00', '', '+919526200081', '', '', '+919526200082', '', '', '1f741d15db5f4dca4c9013324773daf8.jpeg', 'dd94f065c10d6a9d2a9f4e4a0f1934d5.pdf', '', 1, 'Super admin', '2026-03-02', '03:55:25', 1),
(45, 7, 99, 5, 5, 'N', 'https://www.maathotels.com/resort/bluebells-munnar', 'Blue Bells Resort', 'O', '14:00:00', '11:00:00', '', '9526200081', '', '', '', '', 'https://share.google/2aCWf97UQjuPUVBYp', '973d0748e709d6ad009b5f40ab5ebaf9.jpg', '0279f5820c7222c2147a3fd2d1cbce5b.pdf', '', 1, 'Super admin', '2026-03-03', '12:19:15', 1),
(46, 7, 99, 5, 5, 'N', 'https://www.maathotels.com/the-view-munnar', 'The View', 'O', '14:00:00', '11:00:00', '', '9526200087', '', '', '', '', 'https://share.google/8cvwpZdhjNCLLvoEG', '0f8e6e3c319a263337e2ddaefebe63d9.jpeg', 'e73bb384efddd4155aafdf6e5cdfc889.pdf', '', 1, 'Super admin', '2026-03-03', '12:29:34', 1),
(47, 7, 99, 12, 12, 'N', 'https://www.maathotels.com/the-autumn', 'The Autumn by Maat Hotels', 'O', '14:00:00', '11:00:00', '', '9526200082', '', '', '', '', 'https://share.google/wz8fNPWXKToOcsjF9', '', 'f175de160c761a9c0bce4c737829c74b.pdf', '', 1, 'Super admin', '2026-03-03', '12:50:11', 1),
(48, 7, 99, 7, 7, 'N', 'https://www.maathotels.com/the-lake-resort-alleppey', 'The Lake', 'O', '14:00:00', '11:00:00', '', '9526200083', '', '', '', '', 'https://share.google/yiqwvpd75ndv6EQuU', 'dc546b627432696a7b7a4ffcce4a5051.jpg', '319dc8adcabe86134b6eef785c2b59a5.pdf', '', 1, 'Super admin', '2026-03-03', '01:32:03', 1),
(49, 10, 99, 6, 6, 'N', '', 'Lincoln Square', 'O', '14:00:00', '11:00:00', '', '8111869943', '', '', '', '', 'https://share.google/3flq4dLk2lotSkN9x', 'd9ff03b79d12748eb753812854bf10c5.jpeg', '7057fbad9da8d723c2c1ec70b5ed22d5.pdf', '', 1, 'Super admin', '2026-03-03', '02:06:42', 1),
(50, 10, 99, 5, 5, 'N', '', 'Cloud Castle Resort & Spa', 'O', '14:00:00', '11:00:00', '', '+91 81119 27256', '', '', '', '', 'https://share.google/xmlHLFxcU9OaPvvex', 'd222c46116ea6f70532e8446bf13f410.jpeg', '7615ce9404eff7975c69690c5905ab23.pdf', '', 1, 'Super admin', '2026-03-03', '02:33:49', 1),
(51, 10, 99, 6, 6, 'N', 'https://peppervine.in', 'Pepperwine', 'O', '14:00:00', '11:00:00', '', '8086419199', 'sales@intergrandehotels.com', '', '8086418199', 'reservations@intergrandehotels.com', 'https://share.google/57RycpSbTbPkN3dcC', '', '7bce0c5745a7a0ea0f7a437acff4b7e6.pdf', '', 1, 'Super admin', '2026-03-05', '01:46:04', 1),
(52, 11, 99, 6, 6, 'N', 'http://www.resavenue.com/bookingNew/servlet/checkAvailable.resBookings?regCode=IZXA0123&targetTemplate=3', 'The Elephant Court', 'O', '14:00:00', '11:00:00', '', '919745670011', '', '', ' +918086418199', 'reservations@intergrandehotels.com', 'https://share.google/3hfRnwiaxU8aVOJad', '', 'a9bbba2ebf962fb22d52ac9e0f11eb9b.pdf', '', 1, 'Super admin', '2026-03-05', '02:08:19', 1),
(53, 7, 99, 5, 5, 'N', '', 'abs', 'O', '14:00:00', '11:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-04-29', '09:15:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties_room_category`
--

CREATE TABLE `properties_room_category` (
  `properties_room_category_id` int(11) NOT NULL,
  `properties_id_fk` int(11) NOT NULL,
  `room_meal_plan_id_fk` int(11) NOT NULL,
  `properties_room_category_name` varchar(255) NOT NULL,
  `properties_room_category_inventory` varchar(50) NOT NULL,
  `properties_room_category_number_of_adults_allowed` int(11) NOT NULL COMMENT '(without extra bed / mattress)',
  `properties_room_category_children_allowed_on_bed_sharing_basis` int(11) NOT NULL,
  `properties_room_category_extra_bed_mattress_allowed_in_room` int(11) NOT NULL COMMENT 'Extra bed /mattress allowed in the room',
  `properties_room_category_welcomes_child_all_ages` varchar(255) DEFAULT NULL COMMENT 'Room welcomes child of all ages',
  `properties_room_category_admission_restricted_guests_under_age` varchar(255) DEFAULT NULL COMMENT 'Admission is restricted for guests under',
  `properties_room_category_complimentary_guest_between_type` varchar(50) NOT NULL,
  `properties_room_category_complimentary_guest_between_from_year` varchar(255) DEFAULT NULL COMMENT 'Complimentary for guest between',
  `properties_room_category_complimentary_guest_between_to_year` varchar(255) DEFAULT NULL COMMENT 'Child rate applied for guest between from age',
  `properties_room_category_child_rate_applied_guest_between_type` varchar(50) NOT NULL,
  `properties_room_category_child_rate_applied_guest_from_year` varchar(255) DEFAULT NULL,
  `properties_room_category_child_rate_applied_guest_to_year` varchar(255) DEFAULT NULL,
  `properties_room_category_adult_rate_applied_guest_over` varchar(255) DEFAULT NULL COMMENT 'Child rate applied for guest between to age',
  `properties_room_category_photo` varchar(255) NOT NULL COMMENT 'Adult rate applied guest over',
  `properties_room_category_description` text NOT NULL,
  `properties_room_category_createdby_user_id` int(11) NOT NULL,
  `properties_room_category_createdby_user_name` varchar(255) NOT NULL,
  `properties_room_category_created_date` date NOT NULL,
  `properties_room_category_created_time` time NOT NULL,
  `properties_room_category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `properties_room_category`
--

INSERT INTO `properties_room_category` (`properties_room_category_id`, `properties_id_fk`, `room_meal_plan_id_fk`, `properties_room_category_name`, `properties_room_category_inventory`, `properties_room_category_number_of_adults_allowed`, `properties_room_category_children_allowed_on_bed_sharing_basis`, `properties_room_category_extra_bed_mattress_allowed_in_room`, `properties_room_category_welcomes_child_all_ages`, `properties_room_category_admission_restricted_guests_under_age`, `properties_room_category_complimentary_guest_between_type`, `properties_room_category_complimentary_guest_between_from_year`, `properties_room_category_complimentary_guest_between_to_year`, `properties_room_category_child_rate_applied_guest_between_type`, `properties_room_category_child_rate_applied_guest_from_year`, `properties_room_category_child_rate_applied_guest_to_year`, `properties_room_category_adult_rate_applied_guest_over`, `properties_room_category_photo`, `properties_room_category_description`, `properties_room_category_createdby_user_id`, `properties_room_category_createdby_user_name`, `properties_room_category_created_date`, `properties_room_category_created_time`, `properties_room_category_status`) VALUES
(1, 1, 1, 'Deluxe premium', '3', 3, 4, 5, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '6', '7', '', '', 0, '', '2025-08-12', '08:20:27', 0),
(2, 1, 1, 'Standard room', '3', 7, 8, 8, 'N', '7', 'N', '', NULL, 'N', '', NULL, '7', '', '', 0, '', '2025-08-12', '08:21:51', 0),
(3, 3, 2, 'Jaguar room deluxe', '0', 6, 7, 6, 'Y', NULL, 'N', '', NULL, 'N', '', NULL, '', '', '', 0, '', '2025-08-12', '08:37:08', 0),
(4, 3, 1, 'Large room', '0', 7, 8, 8, 'Y', NULL, 'N', '', NULL, 'N', '', NULL, '', '', '', 0, '', '2025-08-12', '08:38:21', 0),
(5, 1, 1, 'lp', '7', 7, 7, 8, 'Y', NULL, 'Y', '0', '8', 'Y', '9', '9', '10', '', 'h', 1, 'Super admin', '2025-09-06', '04:20:48', 0),
(6, 2, 1, 'Standard', '1', 1, 2, 2, 'Y', NULL, 'N', '', NULL, 'Y', '', '1', '2', '', '', 1, 'Super admin', '2025-12-22', '02:19:31', 0),
(7, 2, 1, 'High Premium', '', 1, 2, 2, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '4', '5', '', '', 1, 'Super admin', '2025-12-22', '02:22:53', 0),
(8, 4, 1, 'Classic', '', 1, 2, 2, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '3', '4', '', '', 1, 'Super admin', '2025-12-22', '02:32:48', 0),
(9, 4, 1, 'Modern', '', 2, 3, 2, 'Y', NULL, 'Y', '0', '3', 'Y', '4', '2', '4', '', '', 1, 'Super admin', '2025-12-22', '02:33:25', 0),
(10, 1, 1, 'Realastic', '', 1, 2, 2, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '3', '4', '', '', 1, 'Super admin', '2025-12-22', '03:25:04', 0),
(11, 5, 1, 'Test room', '9', 9, 9, 9, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '4', '5', '', 's', 1, 'Super admin', '2026-01-25', '06:53:16', 0),
(12, 6, 1, 'Deluxe', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-06', '09:20:54', 0),
(13, 6, 1, 'Classic', '', 1, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-06', '09:21:57', 0),
(14, 8, 1, 'DELUXE ROOM', '10', 2, 1, 1, 'Y', '', 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-07', '05:07:00', 1),
(15, 7, 1, 'SUPER DELUXE ROOM', '5', 2, 1, 1, 'Y', '', 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-08', '02:31:19', 1),
(16, 8, 1, 'SUPER DELUXE ROOM', '6', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-07', '05:18:47', 0),
(17, 8, 1, 'DELUXE ROOM', '19', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-07', '05:14:58', 0),
(18, 9, 1, 'Delux', '5', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-08', '03:42:49', 1),
(19, 16, 1, 'Test', '', 1, 2, 2, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-18', '05:22:11', 1),
(20, 16, 1, 'Test 2', '1', 1, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-18', '05:23:32', 1),
(21, 16, 1, 'Test 3', '', 1, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-18', '05:24:10', 1),
(22, 20, 1, 'DELUXE ROOM', '12', 2, 1, 2, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '06:38:02', 1),
(23, 21, 1, 'CLUB ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '06:55:05', 1),
(24, 21, 1, 'CLUB ROOM AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '07:00:30', 1),
(25, 21, 1, 'CLUB WITH VALLEY VIEW AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '07:04:12', 1),
(26, 21, 1, 'GARDEN COTTAGE AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '07:06:46', 1),
(27, 21, 1, 'JACUZZI SUIT AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '07:08:30', 1),
(28, 22, 1, 'POOL SIDE ROOM', '12', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '07:25:36', 1),
(29, 23, 1, 'DELUXE DOUBLE ROOM', '3', 2, 1, 2, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '07:42:44', 1),
(30, 24, 2, 'DELUXE ROOM NON AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '10:25:20', 1),
(31, 24, 2, 'DELUXE ROOM AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '10:25:13', 1),
(32, 26, 1, 'MOUNTAIN VIEW ROOM', '3', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '11:18:03', 1),
(33, 26, 1, 'SUPERIOR MOUNTAIN VIEW ROOM', '3', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '11:18:34', 1),
(34, 26, 1, 'STANDARD FAMILY COTTAGE', '1', 4, 2, 2, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '11:27:53', 1),
(35, 26, 1, 'DELUXE COTTAGE', '3', 4, 2, 2, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-19', '11:29:01', 1),
(36, 28, 1, 'JASMINE AC DELUXE', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '05:04:30', 1),
(37, 28, 1, 'JASMINE AC SUPERIOR', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '05:04:48', 1),
(38, 29, 1, 'PAWN BASE DOUBLE', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '05:47:11', 1),
(39, 29, 1, 'PAWN STANDARD DOUBLE', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '05:47:05', 1),
(40, 29, 1, 'PAWN DELUXE DOUBLE', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '05:47:40', 1),
(41, 29, 1, 'PAWN EXECUTIVE DOUBLE', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '05:47:58', 1),
(42, 30, 1, 'STANDARD DELUXE ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '06:03:30', 1),
(43, 31, 1, 'STANDARD NON AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '06:31:54', 1),
(44, 31, 1, 'STANDARD AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '06:32:10', 1),
(45, 31, 1, 'DELUXE ROOM AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '06:32:24', 1),
(46, 31, 1, 'SEA VIEW COTTAGE', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '06:32:45', 1),
(47, 31, 1, 'SEA VIEW SUIT', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '06:33:00', 1),
(48, 31, 1, 'FAMILY SUIT', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '06:33:23', 1),
(49, 31, 1, 'PREMIUM SEA VIEW', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-22', '06:33:42', 1),
(50, 32, 1, 'DELUXE A/C', '9', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-24', '05:13:58', 1),
(51, 32, 1, 'PREMIUM A/C', '12', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-24', '05:14:33', 1),
(52, 32, 1, 'PREMIUM SUIT A/C', '6', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-24', '05:14:55', 1),
(53, 32, 1, 'ATTIC PREMIUM A/C', '6', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-24', '05:15:58', 1),
(54, 32, 1, 'ATTIC SUITES A/C', '3', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-24', '05:16:21', 1),
(55, 34, 1, 'DOUBLE ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '02:06:48', 1),
(56, 34, 1, 'TRIPLE SHARING ROOM', '', 3, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '02:07:08', 1),
(57, 34, 1, 'QUAD ROOM', '', 4, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '02:07:31', 1),
(58, 27, 1, 'STANDARD ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '02:17:05', 1),
(59, 27, 1, 'DELUXE ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '02:19:43', 1),
(60, 27, 1, 'SUIT ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '02:19:54', 1),
(61, 35, 1, 'STANDARD ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '03:03:19', 1),
(62, 35, 1, 'DELUXE NON AC WITH BALCONY', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '03:03:50', 1),
(63, 35, 1, 'DELUXE AC WITH BALCONY', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '03:04:09', 1),
(64, 35, 1, 'VALLEY VIEW AC WITH BALCONY', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '03:04:45', 1),
(65, 35, 1, 'JUNIOR SUIT AC WITH BALCONY', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '03:05:08', 1),
(66, 36, 1, 'DELUXE DOUBLE ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '03:26:53', 1),
(67, 37, 1, 'DELUXE NON AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '03:39:53', 1),
(68, 38, 4, 'DELUXE ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '4', 'Y', '5', '11', '5', '', '', 1, 'Super admin', '2026-02-25', '03:49:15', 1),
(69, 38, 4, 'PREMIUM ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '4', 'Y', '5', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '03:49:09', 1),
(70, 39, 1, 'DELUXE ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '04:43:48', 1),
(71, 39, 1, 'DELUXE AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '04:47:48', 1),
(72, 39, 1, 'SUIT ROOM AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-25', '04:48:20', 1),
(73, 40, 1, 'DELUXE DOUBLE AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-26', '12:48:38', 1),
(74, 40, 1, 'DELUXE DOUB;E NON AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-26', '12:48:53', 1),
(75, 41, 1, 'PAVILION ROOM', '8', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '12:15:21', 1),
(76, 41, 1, 'LAKE VIEW ROOM', '7', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '12:15:40', 1),
(77, 41, 1, 'SUPERIOR LAKE VIEW ROOM', '5', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '12:16:02', 1),
(78, 41, 1, 'LAKE VIEW WITH PLUNG POOL', '2', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '12:16:35', 1),
(79, 42, 1, 'SUPERIOR ROOM', '3', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '02:02:01', 1),
(80, 42, 1, 'PRIVATE VILLA', '1', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '02:02:22', 1),
(81, 42, 1, 'SUPERIOR VILLA', '1', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '02:02:38', 1),
(82, 43, 1, 'SEA VIEW DELUXE ROOM', '20', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '02:37:38', 1),
(83, 43, 1, 'JUNIOR SEA VIEW SUIT', '3', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '02:38:05', 1),
(84, 43, 1, 'NON SEA VIEW STANDARD ROOM', '6', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '02:38:31', 1),
(85, 43, 1, 'SEA VIEW SUIT', '2', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-27', '02:38:51', 1),
(86, 44, 1, 'STANDARD ROOM', '4', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-02', '03:56:30', 1),
(87, 44, 1, 'DELUXE ROOM', '15', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-02', '03:56:47', 1),
(88, 44, 1, 'SUPER DELUXE ROOM', '6', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-02', '03:57:13', 1),
(89, 44, 1, 'FAMILY COTTAGE', '1', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-02', '03:57:31', 1),
(90, 44, 1, '3 BED ROOM COTTAGE', '1', 6, 3, 3, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-02', '03:58:16', 1),
(91, 45, 1, 'PLANTATION VIEW ROOM', '4', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '12:20:16', 1),
(92, 45, 1, 'VALLEY VIEW ROOM', '4', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '12:20:35', 1),
(93, 46, 1, 'DELUXE ROOM', '8', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '12:30:25', 1),
(94, 46, 1, 'VALLEY VIEW COTTAGE', '5', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '12:30:47', 1),
(95, 46, 1, 'DELUXE VALLEY VIEW ROOM', '8', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '12:31:33', 1),
(96, 47, 1, 'GARDEN VIEW COTTAGE WITH PATIO', '3', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', 'The_Autumn_by_Maat_Hotels.pdf', '', 1, 'Super admin', '2026-03-03', '12:52:06', 1),
(97, 47, 1, 'VALLEY VIEW COTTAGE WITH BALCONY', '3', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '12:53:35', 1),
(98, 47, 1, '2 BED ROOM COTTAGE', '3', 4, 2, 2, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '12:54:29', 1),
(99, 48, 1, 'LAKE VIEW DELUXE AC', '6', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '01:41:10', 1),
(100, 49, 1, 'PREMIUM ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:09:19', 1),
(101, 49, 1, 'PREMIUM AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:09:31', 1),
(102, 49, 1, 'LUXURY ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:09:49', 1),
(103, 49, 1, 'LUXURY AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:10:01', 1),
(104, 49, 1, 'INTERCONNECTED ROOM', '', 4, 2, 2, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:10:29', 1),
(105, 49, 1, 'INTERCONNECTED AC', '', 4, 2, 2, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:10:45', 1),
(106, 50, 1, 'DELUXE AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:36:04', 1),
(107, 50, 1, 'PREMIUM AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:36:14', 1),
(108, 50, 1, 'VALLEY VIEW AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:37:14', 1),
(109, 50, 1, 'POOL VIEW AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:37:28', 1),
(110, 50, 1, 'INTERCONNECTED AC', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-03', '02:37:47', 1),
(111, 51, 1, 'DELUXE ROOM', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-05', '01:47:54', 1),
(112, 51, 1, 'SUIT', '', 2, 1, 1, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-03-05', '01:48:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_category`
--

CREATE TABLE `property_category` (
  `property_category_id` int(11) NOT NULL,
  `property_category_name` varchar(255) NOT NULL,
  `property_category_description` text NOT NULL,
  `property_category_createdby_user_id` int(11) NOT NULL,
  `property_category_createdby_user_name` varchar(255) NOT NULL,
  `property_category_created_date` date NOT NULL,
  `property_category_created_time` time NOT NULL,
  `property_category_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `property_category`
--

INSERT INTO `property_category` (`property_category_id`, `property_category_name`, `property_category_description`, `property_category_createdby_user_id`, `property_category_createdby_user_name`, `property_category_created_date`, `property_category_created_time`, `property_category_status`) VALUES
(1, '5 star', 'hk', 0, '', '2025-07-20', '10:06:07', 0),
(2, '3 star dxffd', 'sds', 0, '', '2025-07-20', '10:06:28', 0),
(3, 'jhjh', 'hj', 0, '', '2025-07-20', '10:06:58', 0),
(4, 'jhbhj', 'hg', 0, '', '2025-07-20', '10:07:39', 0),
(5, 'Test name_edited', 'nedited', 1, 'Super admin', '2026-01-24', '08:19:40', 0),
(6, 'Private Stay', '', 1, 'Super admin', '2026-02-07', '11:25:54', 1),
(7, '3 Star', '', 1, 'Super admin', '2026-02-07', '11:26:04', 1),
(8, 'Deluxe', '', 1, 'Super admin', '2026-02-07', '11:26:18', 1),
(9, 'Premium', '', 1, 'Super admin', '2026-02-07', '11:26:25', 1),
(10, '4 Star', '', 1, 'Super admin', '2026-02-07', '11:26:31', 1),
(11, '5 Star', '', 1, 'Super admin', '2026-02-07', '11:26:41', 1),
(12, 'Budgeted Stay', '', 1, 'Super admin', '2026-02-07', '11:26:48', 1),
(13, '3 Star Premium', '', 1, 'Super admin', '2026-02-19', '06:43:38', 1),
(14, 'Deluxe Cottage', '', 1, 'Super admin', '2026-02-19', '07:16:33', 1),
(15, 'Houseboat', '', 1, 'Super admin', '2026-02-25', '03:46:13', 1),
(16, 'Tree House', '', 1, 'Super admin', '2026-04-09', '06:39:26', 1),
(17, 'Glamping', '', 1, 'Super admin', '2026-04-09', '06:39:35', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_inclusions`
--

CREATE TABLE `property_inclusions` (
  `property_inclusions_id` int(11) NOT NULL,
  `property_id_fk` int(11) NOT NULL,
  `property_inclusions_name` varchar(255) NOT NULL,
  `property_inclusions_amount` double NOT NULL,
  `property_inclusions_description` text NOT NULL,
  `property_inclusions_created_date` date NOT NULL,
  `property_inclusions_created_time` time NOT NULL,
  `property_inclusions_created_by_userid` int(11) NOT NULL,
  `property_inclusions_created_by_username` varchar(255) NOT NULL,
  `property_inclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `property_inclusions`
--

INSERT INTO `property_inclusions` (`property_inclusions_id`, `property_id_fk`, `property_inclusions_name`, `property_inclusions_amount`, `property_inclusions_description`, `property_inclusions_created_date`, `property_inclusions_created_time`, `property_inclusions_created_by_userid`, `property_inclusions_created_by_username`, `property_inclusions_status`) VALUES
(1, 32, 'jjsedDD', 911991, 'asaDDS', '2026-02-19', '03:08:41', 1, 'Super admin', 0),
(2, 32, 'dnnms', 192, 'fsd', '2026-02-19', '03:19:31', 1, 'Super admin', 0),
(3, 21, 'CANDLE LIGHT DINNER', 2500, '', '2026-02-19', '04:29:33', 1, 'Super admin', 1),
(4, 21, 'FLOWER BED DECORATION', 1500, '', '2026-02-19', '04:29:55', 1, 'Super admin', 1),
(5, 21, 'HONEYMOON CAKE', 1250, '', '2026-02-19', '04:30:17', 1, 'Super admin', 1),
(6, 28, 'CANDLE LIGHT DINNER', 2000, '', '2026-02-22', '05:09:48', 1, 'Super admin', 1),
(7, 28, 'FLOWER BED DECORATION', 1000, '', '2026-02-22', '05:10:07', 1, 'Super admin', 1),
(8, 28, 'HONEYMOON CAKE', 1000, '', '2026-02-22', '05:10:17', 1, 'Super admin', 1),
(9, 28, 'CANDLE LIGHT DINNER, FLOWER BED DECORATION, HONEYMOON CAKE', 3500, '', '2026-02-22', '05:10:41', 1, 'Super admin', 1),
(10, 28, 'GALA DINNER - 31st DEC NIGHT (PER ADULT)', 2500, '', '2026-02-22', '05:11:51', 1, 'Super admin', 1),
(11, 28, 'GALA DINNER - 31st DEC NIGHT (PER CHILD)', 1250, '', '2026-02-22', '05:12:02', 1, 'Super admin', 1),
(12, 29, 'FLOWER BED DECORATION, CAKE, FRUIT BASKET', 3000, '', '2026-02-22', '05:52:36', 1, 'Super admin', 1),
(13, 29, 'FLOWER BED DECORATION', 1500, '', '2026-02-22', '05:52:46', 1, 'Super admin', 1),
(14, 29, 'HONEYMOON CAKE', 1000, '', '2026-02-22', '05:52:57', 1, 'Super admin', 1),
(15, 29, 'FRUIT BASKET', 750, '', '2026-02-22', '05:53:08', 1, 'Super admin', 1),
(16, 29, 'CANDLE LIGHT DINNER', 1500, '', '2026-02-22', '05:53:23', 1, 'Super admin', 1),
(17, 32, 'CANDLE LIGHT DINNER', 2500, '', '2026-02-24', '05:25:54', 1, 'Super admin', 1),
(18, 32, 'FLOWER BED DECORATION', 1500, '', '2026-02-24', '05:26:08', 1, 'Super admin', 1),
(19, 32, 'HONEYMOON CAKE ', 1200, '', '2026-02-24', '05:26:23', 1, 'Super admin', 1),
(20, 32, 'FRUIT BASKET & BADAM MILK', 500, '', '2026-02-24', '05:26:42', 1, 'Super admin', 1),
(21, 32, 'WINE', 2500, '', '2026-02-24', '05:26:52', 1, 'Super admin', 1),
(22, 34, 'CAMP FIRE', 1500, '', '2026-02-25', '02:10:04', 1, 'Super admin', 1),
(23, 41, 'CANDLE LIGHT DINNER', 2500, '', '2026-02-27', '01:05:07', 1, 'Super admin', 1),
(24, 41, 'HONEYMOON CAKE', 850, '', '2026-02-27', '01:05:22', 1, 'Super admin', 1),
(25, 41, 'FLOWER BED DECORATION', 1000, '', '2026-02-27', '01:05:41', 1, 'Super admin', 1),
(26, 41, 'FRUIT BASKET ', 200, '', '2026-02-27', '01:05:57', 1, 'Super admin', 1),
(27, 41, 'EVENING TEA & SNACKS', 200, '', '2026-02-27', '01:06:26', 1, 'Super admin', 1),
(28, 41, 'SHIKARA RIDE', 400, 'its per person rate, min 2 pax required', '2026-02-27', '01:07:23', 1, 'Super admin', 1),
(29, 42, 'LOCAL JEEP SAFARI', 3000, 'PER JEEP COST', '2026-02-27', '02:18:29', 1, 'Super admin', 1),
(30, 42, 'CHINNAR JEEP SAFARI', 5000, 'PER JEEP COST', '2026-02-27', '02:19:11', 1, 'Super admin', 1),
(31, 42, 'BIRDING WITH GUIDE', 1000, 'PER 4 PAX', '2026-02-27', '02:19:41', 1, 'Super admin', 1),
(32, 42, 'SOFT TREK', 1500, 'PER 4 PAX', '2026-02-27', '02:19:57', 1, 'Super admin', 1),
(33, 43, 'HONEYMOON PACKAGE (CANDLE LIGHT DINNER IN GAZEBO, FLOWER BED, FRUIT BASKET, BADAM MILK)', 6000, '', '2026-02-27', '02:51:49', 1, 'Super admin', 1),
(34, 43, 'CANDLE LIGHT DINNER', 3000, '', '2026-02-27', '02:52:08', 1, 'Super admin', 1),
(35, 43, 'FLOWER BED DECORATION', 2000, '', '2026-02-27', '02:52:21', 1, 'Super admin', 1),
(36, 43, 'SURFING TRAINING (1.5 HRS)', 2000, 'AVAILABLE ON FROM EVERYDAY FROM OCTOBER TO APRIL', '2026-02-27', '02:53:20', 1, 'Super admin', 1),
(37, 43, 'BOAT RIDE IN SEA', 1500, '1500 PER HEAD (MIN 2 PAX REQUIRED)', '2026-02-27', '02:54:03', 1, 'Super admin', 1),
(38, 44, 'CANDLE LIGHT DINNER', 1500, '', '2026-03-03', '12:14:31', 1, 'Super admin', 1),
(39, 44, 'FLOWER BED DECORATION', 1000, '', '2026-03-03', '12:14:46', 1, 'Super admin', 1),
(40, 44, 'FRUIT BASKET', 500, '', '2026-03-03', '12:15:02', 1, 'Super admin', 1),
(41, 44, 'HONEYMOON CAKE', 800, '', '2026-03-03', '12:15:21', 1, 'Super admin', 1),
(42, 45, 'CANDLE LIGHT DINNER', 1500, '', '2026-03-03', '12:22:12', 1, 'Super admin', 1),
(43, 45, 'FLOWER BED DECORATION', 1000, '', '2026-03-03', '12:22:25', 1, 'Super admin', 1),
(44, 45, 'FRUIT BASKET', 500, '', '2026-03-03', '12:22:35', 1, 'Super admin', 1),
(45, 45, 'HONEYMOON CAKE', 800, '', '2026-03-03', '12:22:45', 1, 'Super admin', 1),
(46, 46, 'CANDLE LIGHT DINNER', 1500, '', '2026-03-03', '12:35:15', 1, 'Super admin', 1),
(47, 46, 'FLOWER BED DECORATION', 1000, '', '2026-03-03', '12:35:36', 1, 'Super admin', 1),
(48, 46, 'FRUIT BASKET', 500, '', '2026-03-03', '12:35:50', 1, 'Super admin', 1),
(49, 46, 'HONEYMOON CAKE', 800, '', '2026-03-03', '12:36:07', 1, 'Super admin', 1),
(50, 47, 'CANDLE LIGHT DINNER', 1500, '', '2026-03-03', '01:25:03', 1, 'Super admin', 1),
(51, 47, 'FLOWER BED DECORATION', 1000, '', '2026-03-03', '01:25:14', 1, 'Super admin', 1),
(52, 47, 'FRUIT BASKET', 500, '', '2026-03-03', '01:25:26', 1, 'Super admin', 1),
(53, 47, 'HONEYMOON CAKE', 800, '', '2026-03-03', '01:25:38', 1, 'Super admin', 1),
(54, 48, 'CANDLE LIGHT DINNER', 1500, '', '2026-03-03', '01:45:37', 1, 'Super admin', 1),
(55, 48, 'FLOWER BED DECORATION', 1000, '', '2026-03-03', '01:45:55', 1, 'Super admin', 1),
(56, 48, 'FRUIT BASKET', 500, '', '2026-03-03', '01:46:15', 1, 'Super admin', 1),
(57, 48, 'HONEYMOON CAKE', 800, '', '2026-03-03', '01:46:25', 1, 'Super admin', 1),
(58, 48, 'CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', 3500, '', '2026-03-03', '01:48:12', 1, 'Super admin', 1),
(59, 47, 'CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', 3500, '', '2026-03-03', '01:49:19', 1, 'Super admin', 1),
(60, 46, 'CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', 3500, '', '2026-03-03', '01:51:30', 1, 'Super admin', 1),
(61, 45, 'CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', 3500, '', '2026-03-03', '01:52:04', 1, 'Super admin', 1),
(62, 44, 'CANDLE LIGHT DINNER, FLOWER BED, FRUIT BASKET, HONEYMOON CAKE, WARM MILK, CHOCOLATES', 3500, '', '2026-03-03', '01:53:31', 1, 'Super admin', 1),
(63, 49, 'BIRTHDAY CELEBRATION ARRANGEMENTS', 4000, '', '2026-03-03', '02:26:03', 1, 'Super admin', 1),
(64, 49, 'WEDDING ANNIVERSARY SPECIAL ARRANGEMENTS', 5000, '', '2026-03-03', '02:26:26', 1, 'Super admin', 1),
(65, 49, 'CANDLE LIGHT DINNER', 2000, '', '2026-03-03', '02:26:41', 1, 'Super admin', 1),
(66, 49, 'FLOWER BED DECORATION', 1200, '', '2026-03-03', '02:26:56', 1, 'Super admin', 1),
(67, 49, 'FRUIT BASKET ', 600, '', '2026-03-03', '02:27:07', 1, 'Super admin', 1),
(68, 49, 'FLORAL DECORATION', 1500, '', '2026-03-03', '02:27:47', 1, 'Super admin', 1),
(69, 49, 'CAKE', 800, '', '2026-03-03', '02:27:56', 1, 'Super admin', 1),
(70, 49, 'BADAM MILK', 300, '', '2026-03-03', '02:28:08', 1, 'Super admin', 1),
(71, 49, 'CANDLE LIGHT DINNER, FLOWER BED DECORATION, FRUIT BASKET, BADAM MILK, CAKE', 3500, '', '2026-03-03', '02:28:51', 1, 'Super admin', 1),
(72, 50, 'CANDLE LIGHT DINNER', 2200, '', '2026-03-03', '02:56:09', 1, 'Super admin', 1),
(73, 50, 'FLOWER BED DECORATION', 1500, '', '2026-03-03', '02:56:31', 1, 'Super admin', 1),
(74, 50, 'CAKE', 800, '', '2026-03-03', '02:56:42', 1, 'Super admin', 1),
(75, 51, 'CANDLE LIGHT DINNER', 3500, '', '2026-03-05', '01:51:23', 1, 'Super admin', 1),
(76, 51, 'CAKE', 750, '500 gm', '2026-03-05', '01:51:38', 1, 'Super admin', 1),
(77, 51, 'EXCLUSIVE CANDLE LIGHT DINNER WITH WINE', 6000, '', '2026-03-05', '01:52:06', 1, 'Super admin', 1),
(78, 51, 'FLOWER BED DECORATION', 3500, '', '2026-03-05', '01:52:24', 1, 'Super admin', 1),
(79, 51, 'ORIENTAL FRUIT BASKET', 400, '', '2026-03-05', '01:52:46', 1, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `quotation`
--

CREATE TABLE `quotation` (
  `quotation_id` int(11) NOT NULL,
  `leads_id_fk` int(11) NOT NULL,
  `package_id_fk` int(11) NOT NULL,
  `quotation_date` date NOT NULL,
  `arriving_destination` varchar(255) NOT NULL,
  `departuring_destination` varchar(255) NOT NULL,
  `quotation_number` varchar(255) NOT NULL,
  `quotation_current_status` int(11) NOT NULL COMMENT '1->generated,2->draft,3->sent->,4->rejected,5->accepted',
  `total_inclusion_amount` double NOT NULL,
  `total_special_requirment_amount` double NOT NULL,
  `quotation_special_requirement_type` varchar(255) DEFAULT NULL,
  `quotation_property_inclusion_type` varchar(255) DEFAULT NULL,
  `quotation_inclusion_exclusion_common_id_fk` varchar(50) NOT NULL,
  `quotation_inclusion_exclusion_checked_type` varchar(50) NOT NULL,
  `quotation_optional_add_on_checked_type` varchar(50) NOT NULL,
  `quotation_payment_policies_checked_type` varchar(50) NOT NULL,
  `quotation_terms_conditions_checked_type` varchar(50) NOT NULL,
  `quotation_cancellation_policy_checked_type` varchar(50) NOT NULL,
  `quotation_notes_checked_type` varchar(50) NOT NULL,
  `quotation_title` varchar(255) NOT NULL,
  `quotation_first_cover_page` varchar(255) NOT NULL,
  `quotation_last_cover_page` varchar(255) NOT NULL,
  `quotation_remarks` text NOT NULL,
  `quotation_created_by_userid` int(11) NOT NULL,
  `quotation_created_by_username` varchar(200) NOT NULL,
  `quotation_created_date` date NOT NULL,
  `quotation_created_time` time NOT NULL,
  `quotation_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_cancellation_policies`
--

CREATE TABLE `quotation_cancellation_policies` (
  `quotation_cancellation_policies_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_cancellation_policies_id_fk` int(11) NOT NULL,
  `quotation_cancellation_policies_id_fk` int(11) NOT NULL,
  `quotation_cancellation_policies_item_id_fk` int(11) NOT NULL,
  `quotation_cancellation_policies_type` varchar(200) NOT NULL,
  `quotation_cancellation_policies_details` text NOT NULL,
  `quotation_cancellation_policies_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_exclusion`
--

CREATE TABLE `quotation_exclusion` (
  `quotation_exclusion_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_exclusions_id_fk` int(11) NOT NULL,
  `quotation_exclusions_common_id_fk` int(11) NOT NULL,
  `quotation_exclusions_id_fk` int(11) NOT NULL,
  `quotation_exclusions_type` varchar(200) NOT NULL,
  `quotation_exclusions_details` text NOT NULL,
  `quotation_exclusion_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_inclusions`
--

CREATE TABLE `quotation_inclusions` (
  `quotation_inclusions` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_inclusions_id_fk` int(11) NOT NULL,
  `quotation_inclusion_common_id_fk` int(11) NOT NULL,
  `quotation_inclusions_id_fk` int(11) NOT NULL,
  `quotation_inclusions_type` varchar(200) NOT NULL,
  `quotation_inclusions_details` text NOT NULL,
  `quotation_inclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_itinerary`
--

CREATE TABLE `quotation_itinerary` (
  `quotation_itinerary_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_itinerary_id_fk` int(11) NOT NULL,
  `quotation_itineraries_id_fk` int(11) NOT NULL,
  `quotation_itinerary_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_itinerary_days`
--

CREATE TABLE `quotation_itinerary_days` (
  `quotation_itinerary_days_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_itinerary_days_id_fk` int(11) NOT NULL,
  `quotation_itinerary_id_fk` int(11) NOT NULL,
  `quotation_days_id_fk` int(11) NOT NULL,
  `quotation_itineraries_days_day` varchar(200) NOT NULL,
  `quotation_itineraries_days_destination_id_fk` int(11) NOT NULL,
  `quotation_itineraries_days_title` varchar(200) NOT NULL,
  `quotation_itineraries_days_image` varchar(255) NOT NULL,
  `quotation_itineraries_days_description` text NOT NULL,
  `quotation_itineraries_days_travel_back` varchar(255) NOT NULL,
  `quotation_itineraries_days_required_status` int(11) NOT NULL,
  `quotation_itinerary_days_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_notes`
--

CREATE TABLE `quotation_notes` (
  `quotation_notes_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_notes_id_fk` int(11) NOT NULL,
  `quotation_notes_details` text NOT NULL,
  `quotation_notes_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_optional_add_on`
--

CREATE TABLE `quotation_optional_add_on` (
  `quotation_optional_add_on_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_optional_add_on_id_fk` int(11) NOT NULL,
  `quotation_optional_add_on_details` text NOT NULL,
  `quotation_optional_add_on_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_options`
--

CREATE TABLE `quotation_options` (
  `quotation_options_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_properties_common_id_fk` int(11) NOT NULL,
  `quotation_options_title` varchar(255) NOT NULL,
  `quotation_options_cab_amount` double NOT NULL,
  `quotation_options_design_type` varchar(100) NOT NULL,
  `quotation_options_vehicle_id_fk` int(11) NOT NULL,
  `quotation_options_room_category_display` varchar(100) NOT NULL,
  `quotation_options_meal_plan_display` varchar(100) NOT NULL,
  `quotation_options_vehicle_display` varchar(50) NOT NULL,
  `quotation_options_total_cost` double NOT NULL,
  `quotation_options_margin_type` varchar(250) NOT NULL,
  `quotation_options_margin_value` double NOT NULL,
  `quotation_options_total_quote_rate` double NOT NULL,
  `quotation_options_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_payment_policies`
--

CREATE TABLE `quotation_payment_policies` (
  `quotation_payment_policies_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_payment_policies_id_fk` int(11) NOT NULL,
  `quotation_policies_id_fk` int(11) NOT NULL,
  `quotation_policies_items_id_fk` int(11) NOT NULL,
  `quotation_payment_policies_type` varchar(200) NOT NULL,
  `quotation_payment_policies_details` text NOT NULL,
  `quotation_payment_policies_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_properties`
--

CREATE TABLE `quotation_properties` (
  `quotation_properties_id` int(11) NOT NULL,
  `quotation_properties_days_id_fk` int(11) NOT NULL,
  `packages_properties_id_fk` int(11) NOT NULL,
  `properties_id_fk` int(11) NOT NULL,
  `quotation_properties_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_properties_days`
--

CREATE TABLE `quotation_properties_days` (
  `quotation_properties_days_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `quotation_options_id_fk` int(11) NOT NULL,
  `packages_properties_days_id_fk` int(11) NOT NULL,
  `quotation_itinerary_days_id_fk` int(11) NOT NULL,
  `quotation_properties_days_day` varchar(200) NOT NULL,
  `quotation_properties_days_destination_id_fk` int(11) NOT NULL,
  `quotation_properties_days_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_properties_rooms`
--

CREATE TABLE `quotation_properties_rooms` (
  `quotation_properties_rooms_id` int(11) NOT NULL,
  `quotation_properties_id_fk` int(11) NOT NULL,
  `packages_properties_rooms_id_fk` int(11) NOT NULL,
  `quotation_properties_rooms_id_fk` int(11) NOT NULL,
  `total_room_cost` double NOT NULL,
  `quotation_properties_rooms_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_property_inclusions`
--

CREATE TABLE `quotation_property_inclusions` (
  `quotation_property_inclusions_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_properties_days_id_fk` int(11) NOT NULL,
  `quotation_itinerary_days_id_fk` int(11) NOT NULL,
  `quotation_properties_days_id_fk` int(11) NOT NULL,
  `stay_destination_id_fk` int(11) NOT NULL,
  `accommodation_date` date NOT NULL,
  `inclusion_property_id_fk` int(11) NOT NULL,
  `property_inclusions_id_fk` int(11) NOT NULL,
  `package_option_id_fk` int(11) NOT NULL,
  `quotation_options_id_fk` int(11) NOT NULL,
  `inclusion_name` varchar(255) NOT NULL,
  `inclusion_amount` double NOT NULL,
  `quotation_property_inclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_room_tariff_details`
--

CREATE TABLE `quotation_room_tariff_details` (
  `quotation_room_tariff_details_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_properties_days_id_fk` int(11) NOT NULL,
  `quotation_properties_rooms_id_fk` int(11) NOT NULL,
  `pax_wise_bed_adult_db_count` varchar(250) NOT NULL,
  `pax_wise_bed_adult_eb_count` varchar(250) NOT NULL,
  `pax_wise_bed_adult_sgl_count` varchar(250) NOT NULL,
  `pax_wise_bed_child_db_count` varchar(250) NOT NULL,
  `pax_wise_bed_child_eb_count` varchar(250) NOT NULL,
  `pax_wise_bed_child_sb_count` varchar(250) NOT NULL,
  `pax_wise_bed_baby_db_count` varchar(250) NOT NULL,
  `pax_wise_bed_baby_eb_count` varchar(250) NOT NULL,
  `pax_wise_bed_baby_sb_count` varchar(250) NOT NULL,
  `room_unit_auto_count` varchar(250) NOT NULL,
  `room_unit_auto_rate` double NOT NULL,
  `room_unit_auto_total_rate` double NOT NULL,
  `room_unit_manual_count` varchar(250) NOT NULL,
  `room_unit_manual_rate` double NOT NULL,
  `room_unit_manual_total_rate` double NOT NULL,
  `extra_bed_adult_auto_count` varchar(250) NOT NULL,
  `extra_bed_adult_auto_rate` double NOT NULL,
  `extra_bed_adult_auto_total_rate` double NOT NULL,
  `extra_bed_adult_manual_count` varchar(250) NOT NULL,
  `extra_bed_adult_manual_rate` double NOT NULL,
  `extra_bed_adult_manual_total_rate` double NOT NULL,
  `extra_bed_child_auto_count` varchar(250) NOT NULL,
  `extra_bed_child_auto_rate` double NOT NULL,
  `extra_bed_child_auto_total_rate` double NOT NULL,
  `extra_bed_child_manual_count` varchar(250) NOT NULL,
  `extra_bed_child_manual_rate` double NOT NULL,
  `extra_bed_child_manual_total_rate` double NOT NULL,
  `child_sharing_bed_auto_count` varchar(250) NOT NULL,
  `child_sharing_bed_auto_rate` double NOT NULL,
  `child_sharing_bed_auto_total_rate` double NOT NULL,
  `child_sharing_bed_manual_count` varchar(250) NOT NULL,
  `child_sharing_bed_manual_rate` double NOT NULL,
  `child_sharing_bed_manual_total_rate` double NOT NULL,
  `single_occupancy_auto_count` varchar(250) NOT NULL,
  `single_occupancy_auto_rate` double NOT NULL,
  `single_occupancy_auto_total_rate` double NOT NULL,
  `single_occupancy_manual_count` varchar(250) NOT NULL,
  `single_occupancy_manual_rate` double NOT NULL,
  `single_occupancy_manual_total_rate` double NOT NULL,
  `supplyment_auto_cost` double NOT NULL,
  `supplyment_auto_total_cost` double NOT NULL,
  `supplyment_manual_cost` double NOT NULL,
  `supplyment_manual_total_cost` double NOT NULL,
  `auto_total_rate` double NOT NULL,
  `manual_total_rate` double NOT NULL,
  `quotation_room_tariff_details_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_special_requirements`
--

CREATE TABLE `quotation_special_requirements` (
  `quotation_special_requirements_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_properties_days_id_fk` int(11) NOT NULL,
  `quotation_itinerary_days_id_fk` int(11) NOT NULL,
  `quotation_properties_days_id_fk` int(11) NOT NULL,
  `stay_destination_id_fk` int(11) NOT NULL,
  `quotation_special_requirements_id_fk` int(11) NOT NULL,
  `accommodation_date` date NOT NULL,
  `quotation_special_requirements_cost` double NOT NULL,
  `quotation_special_requirements_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quotation_terms_condition`
--

CREATE TABLE `quotation_terms_condition` (
  `quotation_terms_condition_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `packages_terms_condition_id_fk` int(11) NOT NULL,
  `quotation_terms_condition_id_fk` int(11) NOT NULL,
  `quotation_terms_condition_item_id_fk` int(11) NOT NULL,
  `quotation_terms_condition_type` varchar(200) NOT NULL,
  `quotation_terms_condition_details` text NOT NULL,
  `quotation_terms_condition_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `roles_id` int(11) NOT NULL,
  `company_user_id_fk_role` int(11) NOT NULL,
  `roles_name` varchar(255) NOT NULL,
  `roles_description` text NOT NULL,
  `roles_created_by_userid` int(11) NOT NULL,
  `roles_created_by_username` varchar(255) NOT NULL,
  `roles_created_by_usertype` varchar(255) NOT NULL,
  `roles_created_date` date NOT NULL,
  `roles_created_by_time` time NOT NULL,
  `roles_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `company_user_id_fk_role`, `roles_name`, `roles_description`, `roles_created_by_userid`, `roles_created_by_username`, `roles_created_by_usertype`, `roles_created_date`, `roles_created_by_time`, `roles_status`) VALUES
(1, 2, 'Sales and Telecalling', '', 1, 'Super admin', 'A', '2024-11-17', '10:22:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles_privilege`
--

CREATE TABLE `roles_privilege` (
  `roles_privilege_id` int(11) NOT NULL,
  `roles_id_fk` int(11) NOT NULL,
  `leads_add` varchar(255) NOT NULL,
  `leads_edit` varchar(255) NOT NULL,
  `leads_view` varchar(255) NOT NULL,
  `leads_delete` varchar(255) NOT NULL,
  `customer_add` varchar(255) NOT NULL,
  `customer_edit` varchar(255) NOT NULL,
  `customer_view` varchar(255) NOT NULL,
  `customer_delete` varchar(255) NOT NULL,
  `proposal_add` varchar(255) NOT NULL,
  `proposal_edit` varchar(255) NOT NULL,
  `proposal_view` varchar(255) NOT NULL,
  `roles_privilege_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `room_tariff_hike`
--

CREATE TABLE `room_tariff_hike` (
  `room_tariff_hike_id` int(11) NOT NULL,
  `properties_id_fk` int(11) NOT NULL,
  `room_tariff_hike_from_date` date NOT NULL,
  `room_tariff_hike_to_date` date NOT NULL,
  `room_tariff_hike_breakfast_rate_adult` double NOT NULL,
  `room_tariff_hike_breakfast_rate_child` double NOT NULL,
  `room_tariff_hike_lunch_rate_adult` double NOT NULL,
  `room_tariff_hike_lunch_rate_child` double NOT NULL,
  `room_tariff_hike_dinner_rate_adult` double NOT NULL,
  `room_tariff_hike_dinner_rate_child` double NOT NULL,
  `room_tariff_hike_description` text NOT NULL,
  `room_tariff_hike_createdby_user_id` int(11) NOT NULL,
  `room_tariff_hike_createdby_user_name` varchar(255) NOT NULL,
  `room_tariff_hike_created_date` date NOT NULL,
  `room_tariff_hike_created_time` time NOT NULL,
  `room_tariff_hike_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room_tariff_hike`
--

INSERT INTO `room_tariff_hike` (`room_tariff_hike_id`, `properties_id_fk`, `room_tariff_hike_from_date`, `room_tariff_hike_to_date`, `room_tariff_hike_breakfast_rate_adult`, `room_tariff_hike_breakfast_rate_child`, `room_tariff_hike_lunch_rate_adult`, `room_tariff_hike_lunch_rate_child`, `room_tariff_hike_dinner_rate_adult`, `room_tariff_hike_dinner_rate_child`, `room_tariff_hike_description`, `room_tariff_hike_createdby_user_id`, `room_tariff_hike_createdby_user_name`, `room_tariff_hike_created_date`, `room_tariff_hike_created_time`, `room_tariff_hike_status`) VALUES
(1, 3, '2025-09-12', '2025-09-13', 2, 3, 3, 4, 4, 3, '', 1, 'Super admin', '2025-09-12', '08:50:43', 0),
(2, 3, '2025-09-27', '2025-09-29', 2, 2, 2, 2, 2, 3, 'df', 1, 'Super admin', '2025-09-27', '08:18:21', 0),
(3, 3, '2026-01-21', '2026-01-24', 100, 50, 200, 150, 200, 150, 'ds', 1, 'Super admin', '2026-01-22', '01:14:33', 0),
(4, 6, '2026-02-01', '2026-02-28', 100, 50, 100, 50, 100, 50, 'nna', 1, 'Super admin', '2026-02-06', '09:29:40', 0),
(5, 7, '2026-02-01', '2026-02-28', 0, 0, 500, 500, 500, 500, 'HHII', 1, 'Super admin', '2026-02-07', '12:41:20', 1),
(6, 8, '2026-02-01', '2026-02-28', 0, 0, 500, 500, 500, 500, 'HH', 1, 'Super admin', '2026-02-07', '01:01:32', 0),
(7, 9, '2026-02-01', '2026-02-28', 0, 0, 0, 0, 0, 0, 'd', 1, 'Super admin', '2026-02-08', '04:01:10', 1),
(8, 9, '2026-03-01', '2026-03-31', 0, 0, 0, 0, 0, 0, 'nil', 1, 'Super admin', '2026-02-08', '04:03:03', 1),
(9, 16, '2026-02-01', '2026-02-28', 0, 0, 0, 0, 0, 0, 'n', 1, 'Super admin', '2026-02-18', '05:31:56', 1),
(10, 16, '2026-03-01', '2026-03-31', 0, 0, 0, 0, 0, 0, 'n', 1, 'Super admin', '2026-02-18', '05:34:08', 1),
(11, 20, '2026-01-01', '2026-12-19', 0, 0, 400, 400, 400, 400, '.', 1, 'Super admin', '2026-02-19', '06:40:26', 1),
(12, 21, '2026-02-01', '2026-02-28', 0, 0, 500, 500, 500, 500, '.', 1, 'Super admin', '2026-02-19', '07:13:16', 1),
(13, 22, '2026-02-01', '2026-03-31', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '07:29:46', 1),
(14, 23, '2026-02-01', '2026-09-30', 0, 0, 300, 300, 300, 300, '', 1, 'Super admin', '2026-02-19', '07:43:43', 1),
(15, 23, '2026-10-01', '2026-12-19', 0, 0, 300, 300, 300, 300, '', 1, 'Super admin', '2026-02-19', '07:44:12', 1),
(16, 23, '2026-12-20', '2026-12-31', 0, 0, 300, 300, 300, 300, '', 1, 'Super admin', '2026-02-19', '07:44:31', 1),
(17, 24, '2026-02-01', '2026-09-30', 250, 250, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-19', '10:26:35', 1),
(18, 22, '2026-04-01', '2026-05-31', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:03:52', 1),
(19, 22, '2026-06-01', '2026-08-31', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:04:18', 1),
(20, 22, '2026-10-01', '2026-12-19', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:05:07', 1),
(21, 22, '2026-12-20', '2027-01-05', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:06:14', 1),
(22, 22, '2027-01-06', '2027-03-31', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:08:01', 1),
(23, 26, '2026-01-06', '2026-03-31', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:33:40', 1),
(24, 26, '2026-04-01', '2026-05-31', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:36:49', 1),
(25, 26, '2026-06-01', '2026-09-30', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:37:55', 1),
(26, 26, '2026-10-01', '2026-12-19', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:39:58', 1),
(27, 26, '2026-12-20', '2027-01-05', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-19', '11:42:12', 1),
(28, 28, '2026-01-01', '2026-03-31', 0, 0, 750, 350, 750, 350, '', 1, 'Super admin', '2026-02-22', '05:07:38', 1),
(29, 28, '2026-04-01', '2026-09-30', 0, 0, 750, 350, 750, 350, '', 1, 'Super admin', '2026-02-22', '05:08:41', 1),
(30, 29, '2026-02-01', '2026-03-31', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-22', '05:51:21', 1),
(31, 30, '2026-02-01', '2026-03-31', 0, 0, 400, 400, 400, 400, '', 1, 'Super admin', '2026-02-22', '06:06:16', 1),
(32, 29, '2026-04-01', '2026-09-30', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '03:59:48', 1),
(33, 29, '2026-10-01', '2026-10-10', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '04:01:00', 1),
(34, 29, '2026-10-11', '2026-11-21', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '04:02:20', 1),
(35, 29, '2026-11-22', '2026-12-19', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '04:04:26', 1),
(36, 29, '2026-12-20', '2027-01-10', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '04:06:24', 1),
(37, 29, '2027-01-11', '2027-03-31', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '04:12:04', 1),
(38, 30, '2026-04-01', '2026-09-30', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '04:18:13', 1),
(39, 30, '2026-10-01', '2026-12-19', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '04:19:07', 1),
(40, 30, '2026-12-20', '2027-01-05', 0, 0, 750, 750, 750, 750, '', 1, 'Super admin', '2026-02-24', '04:20:12', 1),
(41, 30, '2027-01-06', '2027-03-31', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-02-24', '04:20:47', 1),
(42, 32, '2026-03-01', '2026-04-10', 0, 0, 750, 750, 750, 750, '', 1, 'Super admin', '2026-02-24', '05:22:18', 1),
(43, 32, '2026-04-11', '2026-06-10', 0, 0, 750, 750, 750, 750, '', 1, 'Super admin', '2026-02-24', '05:24:28', 1),
(44, 32, '2026-06-11', '2026-09-30', 0, 0, 750, 750, 750, 750, '', 1, 'Super admin', '2026-02-24', '05:25:19', 1),
(45, 34, '2026-02-01', '2026-09-30', 0, 0, 350, 350, 350, 350, '', 1, 'Super admin', '2026-02-25', '02:08:44', 1),
(46, 34, '2026-10-01', '2027-03-31', 0, 0, 350, 350, 350, 350, '', 1, 'Super admin', '2026-02-25', '02:09:08', 1),
(47, 27, '2026-02-01', '2026-12-19', 0, 0, 350, 350, 350, 350, '', 1, 'Super admin', '2026-02-25', '02:25:52', 1),
(48, 27, '2026-12-20', '2027-01-05', 0, 0, 350, 350, 350, 350, '', 1, 'Super admin', '2026-02-25', '02:27:08', 1),
(49, 27, '2027-01-06', '2027-09-30', 0, 0, 350, 350, 350, 350, '', 1, 'Super admin', '2026-02-25', '02:27:41', 1),
(50, 35, '2026-02-01', '2026-12-19', 0, 0, 400, 400, 400, 400, '', 1, 'Super admin', '2026-02-25', '03:11:02', 1),
(51, 35, '2026-12-20', '2027-01-05', 0, 0, 400, 400, 400, 400, '', 1, 'Super admin', '2026-02-25', '03:12:26', 1),
(52, 35, '2027-01-06', '2027-03-31', 0, 0, 400, 400, 400, 400, '', 1, 'Super admin', '2026-02-25', '03:13:49', 1),
(53, 36, '2026-02-01', '2026-12-19', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-02-25', '03:27:36', 1),
(54, 37, '2026-03-01', '2026-09-30', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-02-25', '03:40:31', 1),
(55, 38, '2026-02-08', '2026-09-30', 0, 0, 0, 0, 0, 0, '', 1, 'Super admin', '2026-02-25', '03:49:54', 1),
(56, 39, '2026-04-01', '2026-09-30', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-02-25', '04:51:29', 1),
(57, 40, '2026-04-01', '2026-10-31', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-02-26', '12:49:52', 1),
(58, 40, '2026-11-01', '2027-03-31', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-02-26', '12:51:13', 1),
(59, 31, '2026-02-01', '2026-07-31', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-26', '02:26:57', 1),
(60, 31, '2026-08-01', '2026-12-20', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-26', '02:29:40', 1),
(61, 31, '2026-12-21', '2026-12-28', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-26', '02:31:50', 1),
(62, 31, '2026-12-29', '2027-01-03', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-26', '02:34:39', 1),
(63, 31, '2027-01-04', '2027-01-31', 0, 0, 650, 650, 650, 650, '', 1, 'Super admin', '2026-02-26', '02:37:25', 1),
(64, 41, '2026-04-01', '2026-05-31', 0, 0, 800, 800, 800, 800, '', 1, 'Super admin', '2026-02-27', '12:20:24', 1),
(65, 41, '2026-06-01', '2026-09-30', 0, 0, 800, 800, 800, 800, '', 1, 'Super admin', '2026-02-27', '12:21:34', 1),
(66, 41, '2026-10-01', '2027-03-31', 0, 0, 800, 800, 800, 800, '', 1, 'Super admin', '2026-02-27', '12:42:18', 1),
(67, 42, '2026-04-01', '2027-03-31', 0, 0, 750, 750, 750, 750, '', 1, 'Super admin', '2026-02-27', '02:04:34', 1),
(68, 43, '2026-04-01', '2026-09-30', 0, 0, 1000, 1000, 1000, 1000, '', 1, 'Super admin', '2026-02-27', '02:49:01', 1),
(69, 43, '2026-10-01', '2027-03-31', 0, 0, 1300, 1300, 1300, 1300, '', 1, 'Super admin', '2026-02-27', '02:50:42', 1),
(70, 44, '2026-03-01', '2026-03-31', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '12:09:42', 1),
(71, 44, '2026-04-01', '2026-06-09', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '12:12:01', 1),
(72, 44, '2026-06-10', '2026-09-30', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '12:13:00', 1),
(73, 45, '2026-01-01', '2026-09-30', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '12:21:56', 1),
(74, 46, '2026-03-01', '2026-03-31', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '12:33:46', 1),
(75, 46, '2026-04-01', '2026-06-09', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '12:34:21', 1),
(76, 46, '2026-06-10', '2026-09-30', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '12:34:53', 1),
(77, 47, '2026-03-01', '2026-03-31', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '01:14:19', 1),
(78, 47, '2026-04-01', '2026-06-09', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '01:23:55', 1),
(79, 47, '2026-06-10', '2026-09-30', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '01:24:32', 1),
(80, 48, '2026-03-01', '2026-03-31', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '01:43:56', 1),
(81, 48, '2026-04-01', '2026-06-09', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '01:44:16', 1),
(82, 48, '2026-06-10', '2026-09-30', 0, 0, 500, 500, 500, 500, '', 1, 'Super admin', '2026-03-03', '01:44:41', 1),
(83, 49, '2026-03-01', '2026-03-31', 0, 0, 600, 500, 600, 500, '', 1, 'Super admin', '2026-03-03', '02:13:15', 1),
(84, 49, '2026-04-01', '2026-04-30', 0, 0, 600, 500, 600, 500, '', 1, 'Super admin', '2026-03-03', '02:14:16', 1),
(85, 49, '2026-05-01', '2026-05-31', 0, 0, 600, 500, 600, 500, '', 1, 'Super admin', '2026-03-03', '02:15:12', 1),
(86, 49, '2026-06-01', '2026-09-30', 0, 0, 600, 500, 600, 500, '', 1, 'Super admin', '2026-03-03', '02:16:36', 1),
(87, 49, '2026-10-01', '2027-02-28', 0, 0, 600, 500, 600, 500, '', 1, 'Super admin', '2026-03-03', '02:18:11', 1),
(88, 50, '2026-04-01', '2026-04-30', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '02:42:12', 1),
(89, 50, '2026-05-01', '2026-05-31', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '02:43:03', 1),
(90, 50, '2026-06-01', '2026-09-30', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '02:43:51', 1),
(91, 50, '2026-10-01', '2027-02-28', 0, 0, 600, 600, 600, 600, '', 1, 'Super admin', '2026-03-03', '02:50:09', 1),
(92, 51, '2026-04-01', '2026-09-30', 0, 0, 600, 300, 600, 300, '', 1, 'Super admin', '2026-03-05', '01:50:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_tariff_hike_rate`
--

CREATE TABLE `room_tariff_hike_rate` (
  `room_tariff_hike_rate_id` int(11) NOT NULL,
  `room_tariff_hike_id_fk` int(11) NOT NULL,
  `room_id_fk` int(11) NOT NULL,
  `room_tariff_hike_rate_room_rate` double NOT NULL,
  `room_tariff_hike_rate_adult_with_extra_bed` double NOT NULL,
  `room_tariff_hike_rate_child_with_extra_bed` double NOT NULL,
  `room_tariff_hike_rate_child_sharing_bed` double NOT NULL,
  `room_tariff_hike_rate_single_occupancy` double NOT NULL,
  `room_tariff_hike_rate_some_days_type` varchar(50) NOT NULL,
  `room_tariff_hike_rate_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room_tariff_hike_rate`
--

INSERT INTO `room_tariff_hike_rate` (`room_tariff_hike_rate_id`, `room_tariff_hike_id_fk`, `room_id_fk`, `room_tariff_hike_rate_room_rate`, `room_tariff_hike_rate_adult_with_extra_bed`, `room_tariff_hike_rate_child_with_extra_bed`, `room_tariff_hike_rate_child_sharing_bed`, `room_tariff_hike_rate_single_occupancy`, `room_tariff_hike_rate_some_days_type`, `room_tariff_hike_rate_status`) VALUES
(1, 1, 3, 3, 3, 3, 4, 4, 'Y', 1),
(2, 1, 4, 4, 4, 2, 4, 2, 'Y', 1),
(3, 2, 3, 3, 3, 3, 3, 3, 'Y', 1),
(4, 2, 4, 3, 3, 3, 3, 3, 'Y', 1),
(5, 3, 3, 1000, 500, 300, 200, 1200, 'N', 1),
(6, 3, 4, 1200, 500, 200, 200, 300, 'N', 1),
(7, 4, 12, 1000, 150, 100, 50, 1200, 'N', 1),
(8, 4, 13, 2000, 150, 100, 50, 1200, 'N', 1),
(9, 5, 14, 2000, 800, 600, 400, 2000, 'N', 1),
(10, 5, 15, 2500, 800, 600, 400, 2500, 'N', 1),
(11, 6, 16, 3000, 800, 600, 400, 3000, 'N', 1),
(12, 7, 18, 100, 1001, 100, 100, 1000, 'N', 1),
(13, 8, 18, 1000, 100, 100, 100, 1200, 'N', 1),
(14, 9, 19, 100, 100, 100, 100, 100, 'Y', 1),
(15, 9, 20, 100, 100, 100, 100, 100, 'N', 1),
(16, 9, 21, 100, 100, 100, 100, 100, 'N', 1),
(17, 10, 19, 100, 100, 100, 100, 100, 'N', 1),
(18, 10, 20, 100, 100, 100, 100, 100, 'N', 1),
(19, 10, 21, 100, 100, 100, 100, 100, 'N', 1),
(20, 11, 22, 2000, 750, 500, 400, 2000, 'N', 1),
(21, 12, 23, 3000, 1000, 800, 500, 3000, 'N', 1),
(22, 12, 24, 3300, 1000, 800, 500, 3300, 'N', 1),
(23, 12, 25, 4000, 1000, 800, 500, 4000, 'N', 1),
(24, 12, 26, 5000, 1000, 800, 500, 5000, 'N', 1),
(25, 12, 27, 6000, 1000, 800, 500, 6000, 'N', 1),
(26, 13, 28, 4500, 1000, 750, 750, 4500, 'N', 1),
(27, 14, 29, 1500, 300, 300, 200, 1500, 'N', 1),
(28, 15, 29, 1700, 300, 300, 200, 1500, 'N', 1),
(29, 16, 29, 2000, 300, 300, 200, 1500, 'N', 1),
(30, 17, 30, 2000, 400, 400, 400, 2000, 'N', 1),
(31, 17, 31, 2500, 400, 400, 400, 2500, 'N', 1),
(32, 18, 28, 4250, 1500, 750, 750, 4250, 'N', 1),
(33, 19, 28, 3750, 1500, 750, 750, 3750, 'N', 1),
(34, 20, 28, 4500, 1500, 750, 750, 4500, 'N', 1),
(35, 21, 28, 9000, 2500, 1000, 1000, 9000, 'N', 1),
(36, 22, 28, 4500, 1500, 750, 750, 4500, 'N', 1),
(37, 23, 32, 4000, 1000, 750, 7501, 4000, 'N', 1),
(38, 23, 33, 4750, 1000, 750, 750, 4750, 'N', 1),
(39, 23, 34, 7500, 1000, 750, 750, 7500, 'N', 1),
(40, 23, 35, 8500, 1000, 750, 750, 8500, 'N', 1),
(41, 24, 32, 4500, 1500, 850, 850, 4000, 'N', 1),
(42, 24, 33, 5500, 1500, 850, 850, 5500, 'N', 1),
(43, 24, 34, 9000, 1500, 850, 850, 9000, 'N', 1),
(44, 24, 35, 10000, 1500, 850, 850, 10000, 'N', 1),
(45, 25, 32, 3750, 1500, 850, 850, 3750, 'N', 1),
(46, 25, 33, 4500, 1500, 850, 850, 4500, 'N', 1),
(47, 25, 34, 6500, 1500, 850, 850, 6500, 'N', 1),
(48, 25, 35, 7500, 1500, 850, 850, 7500, 'N', 1),
(49, 26, 32, 4500, 1500, 850, 850, 4500, 'N', 1),
(50, 26, 33, 5500, 1500, 850, 850, 5500, 'N', 1),
(51, 26, 34, 9000, 1500, 850, 850, 9000, 'N', 1),
(52, 26, 35, 10000, 1500, 850, 850, 10000, 'N', 1),
(53, 27, 32, 6500, 2500, 1000, 1000, 6500, 'N', 1),
(54, 27, 33, 7500, 2500, 1000, 1000, 7500, 'N', 1),
(55, 27, 34, 10000, 2500, 1000, 1000, 10000, 'N', 1),
(56, 27, 35, 12000, 2500, 850, 1000, 12000, 'N', 1),
(57, 28, 36, 3250, 900, 900, 450, 3250, 'N', 1),
(58, 28, 37, 3500, 900, 900, 450, 3500, 'N', 1),
(59, 29, 36, 2200, 900, 900, 450, 2200, 'N', 1),
(60, 29, 37, 2500, 900, 900, 450, 2500, 'N', 1),
(61, 30, 38, 3250, 1000, 750, 400, 3250, 'N', 1),
(62, 30, 39, 3750, 1000, 750, 400, 3750, 'N', 1),
(63, 30, 40, 4500, 1000, 750, 400, 4500, 'N', 1),
(64, 30, 41, 5000, 1000, 750, 400, 5000, 'N', 1),
(65, 31, 42, 3000, 750, 750, 300, 3000, 'N', 1),
(66, 32, 38, 0, 0, 0, 0, 0, 'N', 1),
(67, 32, 39, 3000, 1000, 750, 400, 3000, 'N', 1),
(68, 32, 40, 3500, 1000, 750, 400, 3500, 'N', 1),
(69, 32, 41, 4000, 1000, 750, 400, 4000, 'N', 1),
(70, 33, 38, 0, 0, 0, 0, 0, 'N', 1),
(71, 33, 39, 4000, 1000, 750, 400, 4000, 'N', 1),
(72, 33, 40, 4500, 1000, 750, 400, 4500, 'N', 1),
(73, 33, 41, 5000, 1000, 750, 400, 5000, 'N', 1),
(74, 34, 38, 0, 0, 0, 0, 0, 'N', 1),
(75, 34, 39, 4500, 1000, 750, 400, 4500, 'N', 1),
(76, 34, 40, 5000, 1000, 750, 400, 5000, 'N', 1),
(77, 34, 41, 5500, 1000, 750, 400, 5500, 'N', 1),
(78, 35, 38, 0, 0, 0, 0, 0, 'N', 1),
(79, 35, 39, 4000, 1000, 750, 400, 4000, 'N', 1),
(80, 35, 40, 4500, 1000, 750, 400, 4500, 'N', 1),
(81, 35, 41, 5000, 1000, 750, 400, 5000, 'N', 1),
(82, 36, 38, 0, 0, 0, 0, 0, 'N', 1),
(83, 36, 39, 5000, 1000, 750, 400, 5000, 'N', 1),
(84, 36, 40, 5500, 1000, 750, 400, 5500, 'N', 1),
(85, 36, 41, 6000, 1000, 750, 400, 6000, 'N', 1),
(86, 37, 38, 0, 0, 0, 0, 0, 'N', 1),
(87, 37, 39, 4000, 1000, 750, 400, 4000, 'N', 1),
(88, 37, 40, 4500, 1000, 750, 400, 4500, 'N', 1),
(89, 37, 41, 5000, 1000, 750, 400, 5000, 'N', 1),
(90, 38, 42, 2500, 500, 300, 300, 2500, 'N', 1),
(91, 39, 42, 3000, 800, 500, 300, 3000, 'N', 1),
(92, 40, 42, 3500, 800, 750, 400, 3500, 'N', 1),
(93, 41, 42, 3000, 800, 500, 300, 3000, 'N', 1),
(94, 42, 50, 3000, 1000, 750, 500, 3000, 'N', 1),
(95, 42, 51, 3400, 1000, 750, 500, 3400, 'N', 1),
(96, 42, 52, 4250, 1000, 750, 500, 4250, 'N', 1),
(97, 42, 53, 4700, 1000, 750, 500, 4700, 'N', 1),
(98, 42, 54, 5500, 1200, 1000, 750, 5500, 'N', 1),
(99, 43, 50, 3500, 1000, 750, 500, 3000, 'N', 1),
(100, 43, 51, 4000, 1000, 750, 500, 3400, 'N', 1),
(101, 43, 52, 4500, 1000, 750, 500, 4250, 'N', 1),
(102, 43, 53, 5000, 1000, 750, 500, 4700, 'N', 1),
(103, 43, 54, 6000, 1200, 1000, 750, 5500, 'N', 1),
(104, 44, 50, 3000, 1000, 750, 500, 3000, 'N', 1),
(105, 44, 51, 3400, 1000, 750, 500, 3400, 'N', 1),
(106, 44, 52, 4250, 1000, 750, 500, 4250, 'N', 1),
(107, 44, 53, 4700, 1000, 750, 500, 4700, 'N', 1),
(108, 44, 54, 5500, 1200, 1000, 750, 5500, 'N', 1),
(109, 45, 55, 1500, 500, 500, 300, 1500, 'N', 1),
(110, 45, 56, 2000, 500, 500, 300, 2000, 'N', 1),
(111, 45, 57, 2500, 500, 500, 300, 2500, 'N', 1),
(112, 46, 55, 1700, 500, 500, 300, 1500, 'N', 1),
(113, 46, 56, 2000, 500, 500, 300, 2000, 'N', 1),
(114, 46, 57, 2500, 500, 500, 300, 2500, 'N', 1),
(115, 47, 58, 1500, 500, 500, 300, 1500, 'N', 1),
(116, 47, 59, 2000, 500, 500, 300, 2000, 'N', 1),
(117, 47, 60, 2500, 500, 500, 300, 2500, 'N', 1),
(118, 48, 58, 1800, 500, 500, 300, 1800, 'N', 1),
(119, 48, 59, 2500, 500, 500, 300, 2500, 'N', 1),
(120, 48, 60, 3000, 500, 500, 300, 3000, 'N', 1),
(121, 49, 58, 1500, 500, 500, 300, 1500, 'N', 1),
(122, 49, 59, 2000, 500, 500, 300, 2000, 'N', 1),
(123, 49, 60, 2500, 500, 500, 300, 2500, 'N', 1),
(124, 50, 61, 2200, 750, 500, 300, 2200, 'N', 1),
(125, 50, 62, 2500, 750, 500, 300, 2500, 'N', 1),
(126, 50, 63, 3000, 750, 500, 300, 3000, 'N', 1),
(127, 50, 64, 3300, 750, 500, 300, 3300, 'N', 1),
(128, 50, 65, 3500, 750, 500, 300, 3500, 'N', 1),
(129, 51, 61, 2500, 750, 500, 300, 2500, 'N', 1),
(130, 51, 62, 2800, 750, 500, 300, 2800, 'N', 1),
(131, 51, 63, 3300, 750, 500, 300, 3500, 'N', 1),
(132, 51, 64, 4000, 750, 500, 300, 4000, 'N', 1),
(133, 51, 65, 4200, 750, 500, 300, 4200, 'N', 1),
(134, 52, 61, 2200, 750, 500, 300, 2200, 'N', 1),
(135, 52, 62, 2500, 750, 500, 300, 2500, 'N', 1),
(136, 52, 63, 3000, 750, 500, 300, 3000, 'N', 1),
(137, 52, 64, 3300, 750, 500, 300, 3300, 'N', 1),
(138, 52, 65, 3500, 750, 500, 300, 3500, 'N', 1),
(139, 53, 66, 2300, 750, 500, 300, 2300, 'N', 1),
(140, 54, 67, 1800, 800, 600, 400, 1800, 'N', 1),
(141, 55, 68, 5000, 750, 750, 750, 5000, 'N', 1),
(142, 55, 69, 7000, 1000, 1000, 1000, 7000, 'N', 1),
(143, 56, 70, 1800, 900, 700, 500, 1800, 'N', 1),
(144, 56, 71, 2300, 900, 700, 500, 2300, 'N', 1),
(145, 56, 72, 3000, 900, 700, 500, 3000, 'N', 1),
(146, 57, 73, 2300, 850, 850, 500, 2300, 'N', 1),
(147, 57, 74, 2000, 850, 850, 500, 2000, 'N', 1),
(148, 58, 73, 2700, 850, 850, 500, 2700, 'N', 1),
(149, 58, 74, 2300, 850, 850, 500, 2300, 'N', 1),
(150, 59, 43, 2250, 1000, 750, 500, 2250, 'N', 1),
(151, 59, 44, 3000, 1000, 750, 500, 3000, 'N', 1),
(152, 59, 45, 3500, 1000, 750, 500, 3500, 'N', 1),
(153, 59, 46, 4750, 1000, 750, 500, 4750, 'N', 1),
(154, 59, 47, 5250, 1000, 700, 500, 5250, 'N', 1),
(155, 59, 48, 6000, 1000, 750, 500, 6000, 'N', 1),
(156, 59, 49, 7000, 1000, 750, 500, 7000, 'N', 1),
(157, 60, 43, 2750, 1000, 750, 500, 2750, 'N', 1),
(158, 60, 44, 3500, 1000, 750, 500, 3500, 'N', 1),
(159, 60, 45, 4250, 1000, 750, 500, 4250, 'N', 1),
(160, 60, 46, 5000, 1000, 750, 500, 5000, 'N', 1),
(161, 60, 47, 5500, 1000, 700, 500, 5500, 'N', 1),
(162, 60, 48, 6500, 1000, 750, 500, 6500, 'N', 1),
(163, 60, 49, 7500, 1000, 750, 500, 7500, 'N', 1),
(164, 61, 43, 3000, 1000, 750, 500, 3000, 'N', 1),
(165, 61, 44, 4500, 1000, 750, 500, 4500, 'N', 1),
(166, 61, 45, 5000, 1000, 750, 500, 5000, 'N', 1),
(167, 61, 46, 5250, 1000, 750, 500, 5250, 'N', 1),
(168, 61, 47, 6000, 1000, 700, 500, 6000, 'N', 1),
(169, 61, 48, 7500, 1000, 750, 500, 7500, 'N', 1),
(170, 61, 49, 8000, 1000, 750, 500, 8000, 'N', 1),
(171, 62, 43, 4000, 1000, 750, 500, 4000, 'N', 1),
(172, 62, 44, 5500, 1000, 750, 500, 5500, 'N', 1),
(173, 62, 45, 6000, 1000, 750, 500, 6000, 'N', 1),
(174, 62, 46, 8000, 1000, 750, 500, 8000, 'N', 1),
(175, 62, 47, 9000, 1000, 700, 500, 9000, 'N', 1),
(176, 62, 48, 10000, 1000, 750, 500, 10000, 'N', 1),
(177, 62, 49, 10500, 1000, 750, 500, 10500, 'N', 1),
(178, 63, 43, 2750, 1000, 750, 500, 2750, 'N', 1),
(179, 63, 44, 4000, 1000, 750, 500, 4000, 'N', 1),
(180, 63, 45, 4500, 1000, 750, 500, 4500, 'N', 1),
(181, 63, 46, 5500, 1000, 750, 500, 5500, 'N', 1),
(182, 63, 47, 6000, 1000, 700, 500, 6000, 'N', 1),
(183, 63, 48, 7000, 1000, 750, 500, 7000, 'N', 1),
(184, 63, 49, 7500, 1000, 750, 500, 7500, 'N', 1),
(185, 64, 75, 5000, 1500, 850, 850, 5000, 'N', 1),
(186, 64, 76, 5500, 1500, 850, 850, 5500, 'N', 1),
(187, 64, 77, 6000, 1500, 850, 850, 6000, 'N', 1),
(188, 64, 78, 9000, 1500, 850, 850, 9000, 'N', 1),
(189, 65, 75, 4000, 1500, 850, 850, 4000, 'N', 1),
(190, 65, 76, 4750, 1500, 850, 850, 4750, 'N', 1),
(191, 65, 77, 5250, 1500, 850, 850, 5250, 'N', 1),
(192, 65, 78, 8000, 1500, 850, 850, 8000, 'N', 1),
(193, 66, 75, 5500, 1500, 850, 850, 5500, 'N', 1),
(194, 66, 76, 6000, 1500, 850, 850, 6000, 'N', 1),
(195, 66, 77, 6500, 1500, 850, 850, 6500, 'N', 1),
(196, 66, 78, 9000, 1500, 850, 850, 9000, 'N', 1),
(197, 67, 79, 4500, 1500, 750, 750, 4500, 'N', 1),
(198, 67, 80, 6250, 1500, 750, 750, 6250, 'N', 1),
(199, 67, 81, 8000, 1500, 750, 750, 8000, 'N', 1),
(200, 68, 82, 6500, 1500, 750, 750, 6500, 'N', 1),
(201, 68, 83, 7500, 1500, 750, 750, 7500, 'N', 1),
(202, 68, 84, 5500, 1500, 750, 750, 5500, 'N', 1),
(203, 68, 85, 7875, 1500, 750, 750, 7875, 'N', 1),
(204, 69, 82, 7000, 1500, 750, 750, 7000, 'N', 1),
(205, 69, 83, 7875, 1500, 750, 750, 7875, 'N', 1),
(206, 69, 84, 6000, 1500, 750, 750, 6000, 'N', 1),
(207, 69, 85, 7875, 1500, 750, 750, 7875, 'N', 1),
(208, 70, 86, 1800, 800, 600, 400, 1800, 'N', 1),
(209, 70, 87, 2000, 800, 600, 400, 2000, 'N', 1),
(210, 70, 88, 2500, 800, 600, 400, 2500, 'N', 1),
(211, 70, 89, 2500, 800, 600, 400, 2500, 'N', 1),
(212, 70, 90, 5500, 800, 600, 400, 5500, 'N', 1),
(213, 71, 86, 2000, 800, 600, 400, 2000, 'N', 1),
(214, 71, 87, 2250, 800, 600, 400, 2250, 'N', 1),
(215, 71, 88, 3000, 800, 600, 400, 3000, 'N', 1),
(216, 71, 89, 3000, 800, 600, 400, 3000, 'N', 1),
(217, 71, 90, 6000, 800, 600, 400, 6000, 'N', 1),
(218, 72, 86, 1800, 800, 600, 400, 1800, 'N', 1),
(219, 72, 87, 2000, 800, 600, 400, 2000, 'N', 1),
(220, 72, 88, 2500, 800, 600, 400, 2500, 'N', 1),
(221, 72, 89, 2500, 800, 600, 400, 2500, 'N', 1),
(222, 72, 90, 5500, 800, 600, 400, 5500, 'N', 1),
(223, 73, 91, 2000, 800, 600, 400, 2000, 'N', 1),
(224, 73, 92, 2500, 800, 600, 400, 2500, 'N', 1),
(225, 74, 93, 1800, 800, 600, 400, 1800, 'N', 1),
(226, 74, 94, 1800, 800, 600, 400, 1800, 'N', 1),
(227, 74, 95, 2300, 800, 600, 400, 2300, 'N', 1),
(228, 75, 93, 2000, 800, 600, 400, 2000, 'N', 1),
(229, 75, 94, 2000, 800, 600, 400, 2000, 'N', 1),
(230, 75, 95, 2500, 800, 600, 400, 2500, 'N', 1),
(231, 76, 93, 1800, 800, 600, 400, 1800, 'N', 1),
(232, 76, 94, 1800, 800, 600, 400, 1800, 'N', 1),
(233, 76, 95, 2300, 800, 600, 400, 2300, 'N', 1),
(234, 77, 96, 2000, 1000, 800, 600, 2000, 'N', 1),
(235, 77, 97, 2500, 1000, 800, 600, 2500, 'N', 1),
(236, 77, 98, 4500, 1000, 800, 600, 4500, 'N', 1),
(237, 78, 96, 2500, 1000, 800, 600, 2500, 'N', 1),
(238, 78, 97, 3000, 1000, 800, 600, 3000, 'N', 1),
(239, 78, 98, 5500, 1000, 800, 600, 5500, 'N', 1),
(240, 79, 96, 2000, 1000, 800, 600, 2000, 'N', 1),
(241, 79, 97, 2500, 1000, 800, 600, 2500, 'N', 1),
(242, 79, 98, 4500, 1000, 800, 600, 4500, 'N', 1),
(243, 80, 99, 2000, 800, 600, 400, 2000, 'N', 1),
(244, 81, 99, 2500, 800, 600, 400, 2500, 'N', 1),
(245, 82, 99, 2000, 800, 600, 400, 2000, 'N', 1),
(246, 83, 100, 2000, 800, 650, 450, 2000, 'N', 1),
(247, 83, 101, 2300, 800, 650, 450, 2300, 'N', 1),
(248, 83, 102, 2300, 800, 650, 450, 2300, 'N', 1),
(249, 83, 103, 2700, 800, 650, 450, 2700, 'N', 1),
(250, 83, 104, 4200, 800, 650, 450, 4200, 'N', 1),
(251, 83, 105, 5000, 800, 650, 450, 5000, 'N', 1),
(252, 84, 100, 2200, 800, 650, 450, 2200, 'N', 1),
(253, 84, 101, 2400, 800, 650, 450, 2400, 'N', 1),
(254, 84, 102, 2700, 800, 650, 450, 2700, 'N', 1),
(255, 84, 103, 3000, 800, 650, 450, 3000, 'N', 1),
(256, 84, 104, 4600, 800, 650, 450, 4600, 'N', 1),
(257, 84, 105, 5400, 800, 650, 450, 5400, 'N', 1),
(258, 85, 100, 2700, 800, 650, 450, 2700, 'N', 1),
(259, 85, 101, 3000, 800, 650, 450, 3000, 'N', 1),
(260, 85, 102, 3200, 800, 650, 450, 3200, 'N', 1),
(261, 85, 103, 3200, 800, 650, 450, 3200, 'N', 1),
(262, 85, 104, 5600, 800, 650, 450, 5600, 'N', 1),
(263, 85, 105, 7000, 800, 650, 450, 7000, 'N', 1),
(264, 86, 100, 2000, 800, 650, 450, 2000, 'N', 1),
(265, 86, 101, 2300, 800, 650, 450, 2300, 'N', 1),
(266, 86, 102, 2300, 800, 650, 450, 2300, 'N', 1),
(267, 86, 103, 2700, 800, 650, 450, 2700, 'N', 1),
(268, 86, 104, 4200, 800, 650, 450, 4200, 'N', 1),
(269, 86, 105, 5000, 800, 650, 450, 5000, 'N', 1),
(270, 87, 100, 3200, 800, 650, 450, 3200, 'N', 1),
(271, 87, 101, 3400, 800, 650, 450, 3400, 'N', 1),
(272, 87, 102, 3600, 800, 650, 450, 3600, 'N', 1),
(273, 87, 103, 4000, 800, 650, 450, 4000, 'N', 1),
(274, 87, 104, 7000, 800, 650, 450, 7000, 'N', 1),
(275, 87, 105, 7500, 800, 650, 450, 7500, 'N', 1),
(276, 88, 106, 2800, 800, 600, 500, 2800, 'N', 1),
(277, 88, 107, 3000, 800, 600, 500, 3000, 'N', 1),
(278, 88, 108, 3300, 800, 600, 500, 3300, 'N', 1),
(279, 88, 109, 3500, 800, 600, 500, 3500, 'N', 1),
(280, 88, 110, 7000, 800, 600, 500, 7000, 'N', 1),
(281, 89, 106, 3300, 800, 600, 500, 3300, 'N', 1),
(282, 89, 107, 3600, 800, 600, 500, 3600, 'N', 1),
(283, 89, 108, 3800, 800, 600, 500, 3800, 'N', 1),
(284, 89, 109, 4000, 800, 600, 500, 4000, 'N', 1),
(285, 89, 110, 7500, 800, 600, 500, 7500, 'N', 1),
(286, 90, 106, 2600, 800, 600, 500, 2600, 'N', 1),
(287, 90, 107, 2800, 800, 600, 500, 2800, 'N', 1),
(288, 90, 108, 2900, 800, 600, 500, 2900, 'N', 1),
(289, 90, 109, 3200, 800, 600, 500, 3200, 'N', 1),
(290, 90, 110, 6500, 800, 600, 500, 6500, 'N', 1),
(291, 91, 106, 3300, 800, 600, 500, 3300, 'N', 1),
(292, 91, 107, 3600, 800, 600, 500, 3600, 'N', 1),
(293, 91, 108, 3800, 800, 600, 500, 3800, 'N', 1),
(294, 91, 109, 4000, 800, 600, 500, 4000, 'N', 1),
(295, 91, 110, 8000, 800, 600, 500, 8000, 'N', 1),
(296, 92, 111, 3150, 1250, 660, 410, 3150, 'N', 1),
(297, 92, 112, 4620, 1250, 660, 410, 4620, 'N', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_tariff_week_days_rate`
--

CREATE TABLE `room_tariff_week_days_rate` (
  `room_tariff_week_days_rate_id` int(11) NOT NULL,
  `week_days_room_tariff_hike_id_fk` int(11) NOT NULL,
  `week_days_room_id_fk` int(11) NOT NULL,
  `week_days_id_fk` int(11) NOT NULL,
  `room_tariff_week_days_rate_room_amount` double NOT NULL,
  `room_tariff_week_days_rate_adult_with_extra_bed` double NOT NULL,
  `room_tariff_week_days_rate_child_with_extra_bed` double NOT NULL,
  `room_tariff_week_days_rate_child_sharing_bed` double NOT NULL,
  `room_tariff_week_days_rate_single_occupancy` double NOT NULL,
  `room_tariff_week_days_rate_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `room_tariff_week_days_rate`
--

INSERT INTO `room_tariff_week_days_rate` (`room_tariff_week_days_rate_id`, `week_days_room_tariff_hike_id_fk`, `week_days_room_id_fk`, `week_days_id_fk`, `room_tariff_week_days_rate_room_amount`, `room_tariff_week_days_rate_adult_with_extra_bed`, `room_tariff_week_days_rate_child_with_extra_bed`, `room_tariff_week_days_rate_child_sharing_bed`, `room_tariff_week_days_rate_single_occupancy`, `room_tariff_week_days_rate_status`) VALUES
(1, 1, 0, 1, 4, 4, 4, 4, 2, 1),
(2, 1, 0, 2, 4, 4, 2, 4, 4, 1),
(3, 2, 0, 1, 4, 2, 4, 2, 4, 1),
(4, 2, 0, 2, 2, 4, 2, 4, 2, 1),
(5, 2, 0, 3, 3, 4, 2, 4, 2, 1),
(6, 3, 0, 1, 3, 3, 3, 3, 3, 1),
(7, 4, 0, 6, 3, 3, 3, 3, 3, 1),
(8, 14, 0, 1, 100, 100, 100, 100, 100, 1),
(9, 17, 0, 1, 100, 100, 100, 100, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `shift`
--

CREATE TABLE `shift` (
  `shift_id` int(11) NOT NULL,
  `shift_start_time` time NOT NULL,
  `shift_end_time` time NOT NULL DEFAULT '00:00:00',
  `shift_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `shift`
--

INSERT INTO `shift` (`shift_id`, `shift_start_time`, `shift_end_time`, `shift_status`) VALUES
(1, '10:30:00', '18:30:00', 1),
(2, '12:30:00', '20:30:00', 1),
(3, '20:31:00', '09:59:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE `source` (
  `source_id` int(11) NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `source_created_date` date NOT NULL,
  `source_created_time` time NOT NULL,
  `source_created_user_id` int(11) NOT NULL,
  `source_created_username` varchar(255) NOT NULL,
  `source_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`source_id`, `source_name`, `source_created_date`, `source_created_time`, `source_created_user_id`, `source_created_username`, `source_status`) VALUES
(1, 'Facebook', '2026-04-19', '21:11:34', 1, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `special_requirements`
--

CREATE TABLE `special_requirements` (
  `special_requirements_id` int(11) NOT NULL,
  `special_requirements_name` varchar(255) NOT NULL,
  `special_requirements_cost` double NOT NULL,
  `special_requirements_description` text NOT NULL,
  `special_requirements_createdby_user_id` int(11) NOT NULL,
  `special_requirements_createdby_user_name` varchar(255) NOT NULL,
  `special_requirements_created_date` date NOT NULL,
  `special_requirements_created_time` time NOT NULL,
  `special_requirements_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `special_requirements`
--

INSERT INTO `special_requirements` (`special_requirements_id`, `special_requirements_name`, `special_requirements_cost`, `special_requirements_description`, `special_requirements_createdby_user_id`, `special_requirements_createdby_user_name`, `special_requirements_created_date`, `special_requirements_created_time`, `special_requirements_status`) VALUES
(1, 'jkh', 77, 'hk', 1, 'Super admin', '2025-08-31', '07:51:07', 1),
(2, 'hana_edites', 7880, 'sab_edoted', 1, 'Super admin', '2026-01-25', '03:27:20', 0),
(3, 'MALARICKAL EXCURSION', 1000, '', 1, 'Super admin', '2026-02-17', '07:27:59', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_order_assign`
--

CREATE TABLE `staff_order_assign` (
  `staff_order_assign_id` int(11) NOT NULL,
  `shift_id_fk` int(11) NOT NULL,
  `meta_campain_id_fk` int(11) NOT NULL,
  `staff_id_fk` int(11) NOT NULL,
  `staff_order` varchar(50) NOT NULL,
  `staff_order_assign_created_date` date NOT NULL,
  `staff_order_assign_created_time` time NOT NULL,
  `staff_order_assign_creaded_by_user_id` int(11) NOT NULL,
  `staff_order_assign_created_by_username` varchar(255) NOT NULL,
  `staff_order_assign_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `staff_order_assign`
--

INSERT INTO `staff_order_assign` (`staff_order_assign_id`, `shift_id_fk`, `meta_campain_id_fk`, `staff_id_fk`, `staff_order`, `staff_order_assign_created_date`, `staff_order_assign_created_time`, `staff_order_assign_creaded_by_user_id`, `staff_order_assign_created_by_username`, `staff_order_assign_status`) VALUES
(1, 1, 1, 7, '1', '2026-04-14', '15:17:41', 1, 'Super admin', 1),
(2, 3, 1, 7, '1', '2026-04-14', '15:17:41', 1, 'Super admin', 1),
(3, 2, 1, 8, '1', '2026-04-14', '15:17:41', 1, 'Super admin', 1),
(4, 3, 1, 8, '2', '2026-04-14', '15:17:41', 1, 'Super admin', 1),
(5, 1, 1, 9, '2', '2026-04-14', '15:17:41', 1, 'Super admin', 1),
(6, 3, 1, 9, '3', '2026-04-14', '15:17:41', 1, 'Super admin', 1),
(7, 2, 1, 11, '2', '2026-04-14', '15:17:41', 1, 'Super admin', 1),
(8, 3, 1, 11, '4', '2026-04-14', '15:17:41', 1, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `staff_order_assign_details`
--

CREATE TABLE `staff_order_assign_details` (
  `staff_order_assign_details_id` int(11) NOT NULL,
  `staff_order_assign_id_fk` int(11) NOT NULL,
  `staff_id_fk` int(11) NOT NULL,
  `staff_order` varchar(50) NOT NULL,
  `staff_order_assign_details_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE `stages` (
  `stages_id` int(11) NOT NULL,
  `stages_name` varchar(255) NOT NULL,
  `stages_button` text NOT NULL,
  `stages_description` text NOT NULL,
  `stages_created_date` date NOT NULL,
  `stages_created_time` time NOT NULL,
  `stages_created_user_id` int(11) NOT NULL,
  `stages_created_username` varchar(255) NOT NULL,
  `stages_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`stages_id`, `stages_name`, `stages_button`, `stages_description`, `stages_created_date`, `stages_created_time`, `stages_created_user_id`, `stages_created_username`, `stages_status`) VALUES
(1, 'New Lead', '<center><span class=\"btn btn-sm\" style=\"background-color:#0b754e\"><span style=\"color:white\">New Lead</span></span></center>', 'First stage', '2026-01-28', '15:32:10', 1, 'Super admin', 1),
(2, 'Contacted', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">Contacted</span></span></center>', 'fd', '2026-01-28', '20:00:41', 1, 'Super admin', 1),
(3, 'sss', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">sss</span></span></center>', 's', '2026-01-29', '05:42:50', 1, 'Super admin', 1),
(4, 'ds', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">ds</span></span></center>', 'sa', '2026-01-29', '05:46:10', 1, 'Super admin', 1),
(5, 'sm', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">sm</span></span></center>', 's', '2026-01-29', '05:48:54', 1, 'Super admin', 1),
(6, 'dda', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">dda</span></span></center>', 's', '2026-01-29', '05:51:38', 1, 'Super admin', 1),
(7, 'kaak', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">kaak</span></span></center>', 'ma', '2026-01-29', '05:52:06', 1, 'Super admin', 1),
(8, 'aja', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">aja</span></span></center>', '', '2026-01-29', '05:56:15', 1, 'Super admin', 1),
(9, 'mma', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">mma</span></span></center>', 's', '2026-01-29', '05:58:03', 1, 'Super admin', 1),
(10, 'mam', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">mam</span></span></center>', 'ma', '2026-01-29', '06:02:26', 1, 'Super admin', 1),
(11, 'mmty', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">mmty</span></span></center>', 'gh', '2026-01-29', '06:05:55', 1, 'Super admin', 1),
(12, 'jbj', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">jbj</span></span></center>', '', '2026-01-29', '06:06:54', 1, 'Super admin', 1),
(13, 'mmaa', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">mmaa</span></span></center>', 'mma', '2026-01-29', '06:09:17', 1, 'Super admin', 1),
(14, 'uiiqquq', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">uiiqquq</span></span></center>', '', '2026-01-29', '06:09:29', 1, 'Super admin', 1),
(15, 'iooo', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">iooo</span></span></center>', '', '2026-01-29', '06:19:19', 1, 'Super admin', 1),
(16, 'kakasa', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">kakasa</span></span></center>', '', '2026-01-29', '06:21:18', 1, 'Super admin', 1),
(17, 'iiiq', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">iiiq</span></span></center>', '', '2026-01-29', '06:22:17', 1, 'Super admin', 1),
(18, 'retteha', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">retteha</span></span></center>', '', '2026-01-29', '06:23:08', 1, 'Super admin', 1),
(19, 'kka', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">kka</span></span></center>', '', '2026-01-29', '06:31:06', 1, 'Super admin', 1),
(20, 'mnakwkwk', '<center><span class=\"btn btn-sm\" style=\"background-color:#007bff\"><span style=\"color:white\">mnakwkwk</span></span></center>', '', '2026-01-29', '06:35:50', 1, 'Super admin', 1),
(21, 'klala', '<center><span class=\"btn btn-sm\" style=\"background-color:#1e0a36\"><span style=\"color:white\">klala</span></span></center>', 'mma', '2026-01-29', '06:56:39', 1, 'Super admin', 1),
(22, 'Good response', '<center><span class=\"btn btn-sm\" style=\"background-color:#55cc33\"><span style=\"color:white\">Good response</span></span></center>', '', '2026-02-06', '21:39:36', 1, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stage_flow`
--

CREATE TABLE `stage_flow` (
  `stage_flow_id` int(11) NOT NULL,
  `stage_flow_lead_id_fk` int(11) NOT NULL,
  `stage_flow_cur_stage_id_fk` int(11) NOT NULL,
  `stage_flow_prev_stage_id_fk` int(11) NOT NULL,
  `stage_flow_description` text NOT NULL,
  `stage_flow_created_user_id` int(11) NOT NULL,
  `stage_flow_created_username` varchar(255) NOT NULL,
  `stage_flow_created_date` date NOT NULL,
  `stage_flow_created_time` time NOT NULL,
  `stage_flow_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `stage_flow`
--

INSERT INTO `stage_flow` (`stage_flow_id`, `stage_flow_lead_id_fk`, `stage_flow_cur_stage_id_fk`, `stage_flow_prev_stage_id_fk`, `stage_flow_description`, `stage_flow_created_user_id`, `stage_flow_created_username`, `stage_flow_created_date`, `stage_flow_created_time`, `stage_flow_status`) VALUES
(1, 1, 2, 1, '', 1, 'Super admin', '2026-01-29', '14:51:28', 1),
(2, 2, 22, 1, '', 1, 'Super admin', '2026-02-06', '21:39:39', 1),
(3, 7, 2, 1, 'bvb', 1, 'Super admin', '2026-04-14', '16:07:33', 1),
(4, 16, 2, 1, '', 12, 'SHANIMOL', '2026-04-19', '18:12:33', 1),
(5, 14, 2, 1, '', 1, 'Super admin', '2026-04-21', '14:49:15', 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE `state` (
  `state_id` int(11) NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_description` text NOT NULL,
  `state_created_date` date NOT NULL,
  `state_created_time` time NOT NULL,
  `state_created_user_id` int(11) NOT NULL,
  `state_created_user_name` varchar(255) NOT NULL,
  `state_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id_fk`, `state_name`, `state_description`, `state_created_date`, `state_created_time`, `state_created_user_id`, `state_created_user_name`, `state_status`) VALUES
(1, 99, 'KERALA', '', '0000-00-00', '00:00:00', 0, '', 0),
(4, 99, 'KARNATAKA', 'DDF', '2024-08-28', '08:15:47', 1, 'Super admin', 0),
(5, 0, 'Munnar', '', '2026-02-07', '05:11:28', 1, 'Super admin', 1),
(6, 0, 'Thekkady', '', '2026-02-07', '05:11:33', 1, 'Super admin', 1),
(7, 0, 'Alappey', '', '2026-02-07', '05:11:38', 1, 'Super admin', 1),
(8, 0, 'Varkala', '', '2026-02-07', '05:11:44', 1, 'Super admin', 1),
(9, 0, 'TRIVANDRUM', '', '2026-02-07', '05:11:48', 1, 'Super admin', 0),
(10, 0, 'Kovalam', '', '2026-02-07', '05:11:55', 1, 'Super admin', 1),
(11, 0, 'Athirappilly', '', '2026-02-07', '05:12:00', 1, 'Super admin', 1),
(12, 0, 'Vagamon', '', '2026-02-07', '05:12:11', 1, 'Super admin', 1),
(13, 0, 'Wayanadu', '', '2026-02-07', '05:12:16', 1, 'Super admin', 1),
(14, 0, 'Guruvayoor', '', '2026-02-07', '05:12:23', 1, 'Super admin', 1),
(15, 0, 'Munroe Island', '', '2026-02-07', '05:12:32', 1, 'Super admin', 1),
(16, 0, 'Vattavada', '', '2026-02-07', '05:12:39', 1, 'Super admin', 1),
(17, 0, 'Suryanelli', '', '2026-02-07', '05:12:50', 1, 'Super admin', 1),
(18, 0, 'Kanthalloor', '', '2026-02-07', '05:12:57', 1, 'Super admin', 1),
(19, 0, 'Kumarakom', '', '2026-02-07', '05:13:01', 1, 'Super admin', 1),
(20, 0, 'Cochin', '', '2026-02-17', '07:20:36', 1, 'Super admin', 1),
(21, 0, 'Trivandrum', '', '2026-02-19', '10:13:35', 1, 'Super admin', 1),
(22, 0, 'KANTHALLOOR', '', '2026-02-27', '01:57:45', 1, 'Super admin', 0);

-- --------------------------------------------------------

--
-- Table structure for table `status_flow`
--

CREATE TABLE `status_flow` (
  `status_flow_id` int(11) NOT NULL,
  `status_flow_lead_id_fk` int(11) NOT NULL,
  `status_flow_cur` varchar(250) NOT NULL,
  `status_flow_prev` varchar(250) NOT NULL,
  `status_flow_description` text NOT NULL,
  `status_flow_created_user_id` int(11) NOT NULL,
  `status_flow_created_username` varchar(255) NOT NULL,
  `status_flow_created_date` date NOT NULL,
  `status_flow_created_time` time NOT NULL,
  `status_flow_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `status_flow`
--

INSERT INTO `status_flow` (`status_flow_id`, `status_flow_lead_id_fk`, `status_flow_cur`, `status_flow_prev`, `status_flow_description`, `status_flow_created_user_id`, `status_flow_created_username`, `status_flow_created_date`, `status_flow_created_time`, `status_flow_status`) VALUES
(1, 2, '3', '1', 'mnn', 1, 'Super admin', '2026-04-14', '18:35:54', 1),
(2, 2, '4', '3', '', 1, 'Super admin', '2026-04-14', '18:40:13', 1),
(3, 2, '3', '4', '', 1, 'Super admin', '2026-04-14', '18:42:17', 1),
(4, 2, '5', '3', 's', 1, 'Super admin', '2026-04-14', '18:46:10', 1),
(5, 2, '4', '5', 'x', 1, 'Super admin', '2026-04-14', '18:50:02', 1),
(6, 2, 'Converted to trip', 'Not Qualified', 'sss', 1, 'Super admin', '2026-04-14', '18:53:57', 1),
(7, 2, 'Not Qualified', 'Converted to trip', '', 1, 'Super admin', '2026-04-14', '18:54:30', 1),
(8, 2, 'Lost', 'Not Qualified', '', 1, 'Super admin', '2026-04-15', '03:18:28', 1),
(9, 2, 'Converted to trip', 'Lost', '', 1, 'Super admin', '2026-04-15', '06:44:57', 1),
(10, 2, 'Lost', 'Converted to trip', '', 1, 'Super admin', '2026-04-15', '06:45:08', 1),
(11, 14, 'Converted to trip', 'In take', '', 1, 'Super admin', '2026-04-21', '14:48:18', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terms_condition`
--

CREATE TABLE `terms_condition` (
  `terms_condition_id` int(11) NOT NULL,
  `terms_condition_name` varchar(255) NOT NULL,
  `terms_condition_createdby_user_id` int(11) NOT NULL,
  `terms_condition_createdby_user_name` varchar(255) NOT NULL,
  `terms_condition_created_date` date NOT NULL,
  `terms_condition_created_time` time NOT NULL,
  `terms_condition_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `terms_condition`
--

INSERT INTO `terms_condition` (`terms_condition_id`, `terms_condition_name`, `terms_condition_createdby_user_id`, `terms_condition_createdby_user_name`, `terms_condition_created_date`, `terms_condition_created_time`, `terms_condition_status`) VALUES
(1, 'vcvc', 1, 'Super admin', '2025-09-29', '07:55:04', 1),
(2, 'jaj', 1, 'Super admin', '2026-01-25', '04:44:21', 1),
(3, 'Jka', 1, 'Super admin', '2026-01-25', '04:44:41', 0),
(4, 'KERALA - PC', 1, 'Super admin', '2026-02-17', '07:26:54', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terms_condition_items`
--

CREATE TABLE `terms_condition_items` (
  `terms_condition_items_id` int(11) NOT NULL,
  `terms_condition_id_fk` int(11) NOT NULL,
  `terms_condition_items_name` text NOT NULL,
  `terms_condition_items_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `terms_condition_items`
--

INSERT INTO `terms_condition_items` (`terms_condition_items_id`, `terms_condition_id_fk`, `terms_condition_items_name`, `terms_condition_items_status`) VALUES
(1, 1, 'cv', 1),
(2, 1, 'cvcv', 1),
(3, 2, '', 1),
(4, 3, 'as', 1),
(5, 3, 'as', 1),
(7, 3, 'haan', 1),
(8, 4, 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.\r\nHotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).\r\nExtra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.\r\nIf your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.\r\nProperties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.\r\nCab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.\r\nA photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.\r\nFor Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.\r\nKindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transporter`
--

CREATE TABLE `transporter` (
  `transporter_id` int(11) NOT NULL,
  `transporter_name` varchar(255) NOT NULL,
  `transporter_base_station_id_fk` int(11) NOT NULL,
  `transporter_address` text NOT NULL,
  `transporter_contact_person_name1` varchar(255) NOT NULL,
  `transporter_contact_person_email1` varchar(255) NOT NULL,
  `transporter_contact_person_contact_num1` varchar(255) NOT NULL,
  `transporter_contact_person_contact_num12` varchar(255) NOT NULL,
  `transporter_contact_person_name2` varchar(255) NOT NULL,
  `transporter_contact_person_email2` varchar(255) NOT NULL,
  `transporter_contact_person_contact_num2` varchar(255) NOT NULL,
  `transporter_contact_person_contact_num22` varchar(255) NOT NULL,
  `transporter_bank_name` varchar(255) NOT NULL,
  `transporter_bank_account_number` varchar(255) NOT NULL,
  `transporter_bank_account_name` varchar(255) NOT NULL,
  `transporter_bank_account_ifsc_code` varchar(255) NOT NULL,
  `transporter_bank_account_branch` varchar(255) NOT NULL,
  `transporter_bank_swift_code` varchar(255) NOT NULL,
  `transporter_createdby_user_id` int(11) NOT NULL,
  `transporter_createdby_user_name` varchar(255) NOT NULL,
  `transporter_created_date` date NOT NULL,
  `transporter_created_time` time NOT NULL,
  `transporter_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transporter`
--

INSERT INTO `transporter` (`transporter_id`, `transporter_name`, `transporter_base_station_id_fk`, `transporter_address`, `transporter_contact_person_name1`, `transporter_contact_person_email1`, `transporter_contact_person_contact_num1`, `transporter_contact_person_contact_num12`, `transporter_contact_person_name2`, `transporter_contact_person_email2`, `transporter_contact_person_contact_num2`, `transporter_contact_person_contact_num22`, `transporter_bank_name`, `transporter_bank_account_number`, `transporter_bank_account_name`, `transporter_bank_account_ifsc_code`, `transporter_bank_account_branch`, `transporter_bank_swift_code`, `transporter_createdby_user_id`, `transporter_createdby_user_name`, `transporter_created_date`, `transporter_created_time`, `transporter_status`) VALUES
(1, 'Fahadhh', 4, 'sfds', 'hsdf', 'gh@', '33', '434', 'dfsfd', 'dfd@', '34433', '434', 'dggf', '454545', 'fgdg', '4545', 'fdg', 'gfd334', 0, '', '2025-07-23', '05:16:37', 0),
(2, 'hjhj', 1, 'hj', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-24', '08:16:09', 0),
(3, 'jkhj', 1, 'hk', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-24', '08:28:07', 0),
(4, 'Ganfoor_edited', 4, 'Ernau_edited', 'Saj_edited', 'aha@gmail.com_edited', '88199', '19910', 'hah@gmail.com_edited', 'anna@gmail.com_edited', '19910', '19910', 'Najath_edited', '9191910', 'Eajj_edited', '19910', 'Hjk_edited', '9920', 1, 'Super admin', '2026-01-25', '03:12:08', 0),
(5, 'ANAS', 5, 'MUVATUPUZHA', '', '', '674545757537', '574575475', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-16', '01:33:51', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transporter_vehicle`
--

CREATE TABLE `transporter_vehicle` (
  `transporter_vehicle_id` int(11) NOT NULL,
  `transporter_id_fk` int(11) NOT NULL,
  `vehicle_id_fk` int(11) NOT NULL,
  `transporter_vehicle_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `transporter_vehicle`
--

INSERT INTO `transporter_vehicle` (`transporter_vehicle_id`, `transporter_id_fk`, `vehicle_id_fk`, `transporter_vehicle_status`) VALUES
(8, 1, 4, 1),
(9, 2, 11, 1),
(10, 2, 13, 1),
(11, 3, 2, 1),
(12, 3, 5, 1),
(15, 4, 1, 1),
(16, 4, 4, 1),
(17, 5, 34, 1);

-- --------------------------------------------------------

--
-- Table structure for table `trips`
--

CREATE TABLE `trips` (
  `trips_id` int(11) NOT NULL,
  `quotation_id_fk` int(11) NOT NULL,
  `lead_id_fk` int(11) NOT NULL,
  `trips_travel_start_date` date NOT NULL,
  `trips_travel_duration` varchar(50) NOT NULL,
  `trips_travel_end_date` date NOT NULL,
  `trips_current_status` int(11) NOT NULL,
  `trips_created_by_userid` int(11) NOT NULL,
  `trips_created_by_username` varchar(255) NOT NULL,
  `trips_created_date` date NOT NULL,
  `trips_created_time` time NOT NULL,
  `trips_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tr_permissions`
--

CREATE TABLE `tr_permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `module` varchar(22) NOT NULL,
  `sub_module` varchar(50) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1 = Active, 0 = Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tr_permissions`
--

INSERT INTO `tr_permissions` (`id`, `name`, `module`, `sub_module`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'STAFF_VIEW', 'STAFF_MANAGEMENT', 'STAFF', 'STAFF_MANAGEMENT menu', 0, 1, NULL, '2026-04-18 12:23:42', '2026-04-19 13:59:24'),
(2, 'STAFF_CREATE', 'STAFF_MANAGEMENT', 'STAFF', 'STAFF menu', 1, 1, NULL, '2026-04-18 12:24:28', '2026-04-18 11:00:11'),
(3, 'PROPERTY_VIEW', 'MASTERS', 'PROPERTY', 'PROPERTY', 1, 1, NULL, '2026-04-18 11:01:33', '2026-04-18 11:01:33'),
(4, 'DESTINATION_VIEW', 'MASTERS', 'DESTINATION', 'DESTINATION_VIEW', 1, 1, NULL, '2026-04-18 11:01:33', '2026-04-18 11:01:33'),
(5, 'STAFF_UPDATE', 'STAFF_MANAGEMENT', 'STAFF', 'STAFF_UPDATE', 1, 1, NULL, '2026-04-18 11:03:59', '2026-04-18 11:03:59'),
(6, 'STAFF_DELETE', 'STAFF_MANAGEMENT', 'STAFF', NULL, 1, 1, NULL, '2026-04-18 11:03:59', '2026-04-18 11:03:59'),
(7, 'PROPERTY_UPDATE', 'MASTERS', 'PROPERTY', 'PROPERTY_UPDATE', 1, 1, NULL, '2026-04-18 11:05:50', '2026-04-18 11:05:50'),
(8, 'PROPERTY_DELETE', 'MASTERS', 'PROPERTY', 'PROPERTY_DELETE', 1, 1, NULL, '2026-04-18 11:05:50', '2026-04-18 11:05:50'),
(9, 'DESTINATION_UPDATE', 'MASTERS', 'DESTINATION', 'DESTINATION_UPDATE', 1, 1, NULL, '2026-04-18 11:07:14', '2026-04-18 11:07:14'),
(10, 'DESTINATION_DELETE', 'MASTERS', 'DESTINATION', 'DESTINATION_delete', 1, 1, NULL, '2026-04-18 11:07:14', '2026-04-18 11:07:14'),
(11, 'PROPERTY_CREATE', 'MASTERS', 'PROPERTY', 'PROPERTY_CREATE', 1, 1, NULL, '2026-04-18 14:11:59', '2026-04-18 14:11:59'),
(12, 'DESTINATION_CREATE', 'MASTERS', 'DESTINATION', 'DESTINATION_CREATE', 1, 1, NULL, '2026-04-18 14:11:59', '2026-04-18 14:11:59'),
(13, 'VEHICLE_VIEW', 'MASTERS', 'VEHICLE', 'VEHICLE_VIEW', 1, 1, NULL, '2026-04-18 14:13:27', '2026-04-18 14:13:27'),
(14, 'VEHICLE_CREATE', 'MASTERS', 'VEHICLE', 'VEHICLE_CREATE', 1, 1, NULL, '2026-04-18 14:13:27', '2026-04-18 14:13:27'),
(15, 'VEHICLE_UPDATE', 'MASTERS', 'VEHICLE', 'VEHICLE_UPDATE', 1, 1, NULL, '2026-04-18 14:14:36', '2026-04-18 14:14:36'),
(16, 'VEHICLE_DELETE', 'MASTERS', 'VEHICLE', 'VEHICLE_DELETE', 1, NULL, NULL, '2026-04-18 14:14:36', '2026-04-18 14:14:36'),
(17, 'TRANSPORTER_VIEW', 'MASTERS', 'TRANSPORTER', 'TRANSPORTER_VIEW', 1, 1, NULL, '2026-04-18 14:17:35', '2026-04-18 14:25:05'),
(18, 'TRANSPORTER_CREATE', 'MASTERS', 'TRANSPORTER', 'TRANSPORTER_CREATE', 1, 1, NULL, '2026-04-18 14:17:35', '2026-04-18 14:25:20'),
(19, 'TRANSPORTER_UPDATE', 'MASTERS', 'TRANSPORTER', 'TRANSPORTER_UPDATE', 1, 1, NULL, '2026-04-18 14:18:49', '2026-04-18 14:25:38'),
(20, 'TRANSPORTER_DELETE', 'MASTERS', 'TRANSPORTER', 'TRANSPORTER_DELETE', 1, 1, NULL, '2026-04-18 14:18:49', '2026-04-18 14:25:49'),
(21, 'B2B_PARTNER_VIEW', 'MASTERS', 'B2B_PARTNER', 'PARTNER_VIEW', 1, 1, NULL, '2026-04-18 14:20:10', '2026-04-18 14:22:45'),
(22, 'B2B_PARTNER_CREATE', 'MASTERS', 'B2B_PARTNER', 'PARTNER_CREATE', 1, 1, NULL, '2026-04-18 14:20:10', '2026-04-18 14:23:36'),
(23, 'B2B_PARTNER_UPDATE', 'MASTERS', 'B2B_PARTNER', 'B2BPARTNER_UPDATE', 1, 1, NULL, '2026-04-18 14:21:54', '2026-04-18 14:23:56'),
(24, 'B2B_PARTNER_DELETE', 'MASTERS', 'B2B_PARTNER', 'B2BPARTNER_DELETE', 1, 1, NULL, '2026-04-18 14:21:54', '2026-04-18 14:24:05'),
(25, 'ROLE_VIEW', 'MASTERS', 'ROLE', 'ROLE_VIEW', 1, 1, NULL, '2026-04-18 14:27:00', '2026-04-18 14:27:00'),
(26, 'ROLE_CREATE', 'MASTERS', 'ROLE', 'ROLE_CREATE', 1, 1, NULL, '2026-04-18 14:27:00', '2026-04-18 14:27:00'),
(27, 'ITINERARY_VIEW', 'ITINERARY', 'ITINERARY', 'ITINERARY_VIEW', 1, 1, NULL, '2026-04-18 18:18:13', '2026-04-18 18:18:13'),
(28, 'ITINERARY_CREATE', 'ITINERARY', 'ITINERARY', 'ITINERARY_CREATE', 1, 1, NULL, '2026-04-18 18:18:13', '2026-04-18 18:18:13'),
(29, 'ITINERARY_UPDATE', 'ITINERARY', 'ITINERARY', 'ITINERARY_UPDATE', 1, 1, NULL, '2026-04-18 18:19:49', '2026-04-18 18:19:49'),
(30, 'ITINERARY_DELETE', 'ITINERARY', 'ITINERARY', 'ITINERARY_DELETE', 1, 1, NULL, '2026-04-18 18:19:49', '2026-04-18 18:19:49'),
(31, 'CATEGORY_VIEW', 'ITINERARY', 'CATEGORY', 'ITINERARY_CATEGORY_VIEW', 1, 1, NULL, '2026-04-18 18:23:05', '2026-04-18 18:25:17'),
(32, 'CATEGORY_CREATE', 'ITINERARY', 'CATEGORY', 'ITINERARY_CATEGORY_CREATE', 1, 1, NULL, '2026-04-18 18:23:05', '2026-04-18 18:25:41'),
(33, 'CATEGORY_UPDATE', 'ITINERARY', 'CATEGORY', 'CATEGORY_UPDATE', 1, 1, NULL, '2026-04-18 18:24:39', '2026-04-18 18:24:39'),
(34, 'CATEGORY_DELETE', 'ITINERARY', 'CATEGORY', 'CATEGORY_DELETE', 1, 1, NULL, '2026-04-18 18:24:39', '2026-04-18 18:24:39'),
(35, 'INCLUSION_AND_EXCLUSION_VIEW', 'ITINERARY', 'INCLUSION_AND_EXCLUSION', 'INCLUSION_AND_EXCLUSION_VIEW', 1, 1, NULL, '2026-04-18 18:27:44', '2026-04-18 18:27:44'),
(36, 'INCLUSION_AND_EXCLUSION_CREATE', 'ITINERARY', 'INCLUSION_AND_EXCLUSION', 'INCLUSION_AND_EXCLUSION_CREATE', 1, 1, NULL, '2026-04-18 18:27:44', '2026-04-18 18:27:44'),
(37, 'INCLUSION_AND_EXCLUSION_UPDATE', 'ITINERARY', 'INCLUSION_AND_EXCLUSION', NULL, 1, 1, NULL, '2026-04-18 18:28:52', '2026-04-18 18:28:52'),
(38, 'INCLUSION_AND_EXCLUSION_DELETE', 'ITINERARY', 'INCLUSION_AND_EXCLUSION', 'INCLUSION_AND_EXCLUSION_DELETE', 1, 1, NULL, '2026-04-18 18:28:52', '2026-04-18 18:28:52'),
(39, 'PAYMENT_POLICY_VIEW', 'ITINERARY', 'PAYMENT_POLICY', 'PAYMENT_POLICY_VIEW', 1, 1, NULL, '2026-04-18 18:31:20', '2026-04-18 18:31:20'),
(40, 'PAYMENT_POLICY_CREATE', 'ITINERARY', 'PAYMENT_POLICY', 'PAYMENT_POLICY_CREATE', 1, 1, NULL, '2026-04-18 18:31:20', '2026-04-18 18:31:20'),
(41, 'PAYMENT_POLICY_UPDATE', 'ITINERARY', 'PAYMENT_POLICY', 'PAYMENT_POLICY_UPDATE', 1, 1, NULL, '2026-04-18 18:31:20', '2026-04-18 18:31:20'),
(42, 'PAYMENT_POLICY_DELETE', 'ITINERARY', 'PAYMENT_POLICY', 'PAYMENT_POLICY_DELETE', 1, 1, NULL, '2026-04-18 18:31:20', '2026-04-18 18:31:20'),
(43, 'TERMS_AND_CONDITIONS_VIEW', 'ITINERARY', 'TERMS_AND_CONDITIONS', 'TERMS_AND_CONDITIONS_VIEW', 1, 1, NULL, '2026-04-18 18:33:34', '2026-04-18 18:33:34'),
(44, 'TERMS_AND_CONDITIONS_CREATE', 'ITINERARY', 'TERMS_AND_CONDITIONS', 'TERMS_AND_CONDITIONS_CREATE', 1, 1, NULL, '2026-04-18 18:33:34', '2026-04-18 18:33:34'),
(45, 'TERMS_AND_CONDITIONS_UPDATE', 'ITINERARY', 'TERMS_AND_CONDITIONS', 'TERMS_AND_CONDITIONS_UPDATE', 1, 1, NULL, '2026-04-18 18:33:34', '2026-04-18 18:33:34'),
(46, 'TERMS_AND_CONDITIONS_DELETE', 'ITINERARY', 'TERMS_AND_CONDITIONS', 'TERMS_AND_CONDITIONS_DELETE', 1, 1, NULL, '2026-04-18 18:33:34', '2026-04-18 18:33:34'),
(47, 'CANCELLATION_AND_POLICY_VIEW', 'ITINERARY', 'CANCELLATION_AND_POLICY', 'CANCELLATION_AND_POLICY_VIEW', 1, NULL, NULL, '2026-04-18 18:35:51', '2026-04-18 18:35:51'),
(48, 'CANCELLATION_AND_POLICY_CREATE', 'ITINERARY', 'CANCELLATION_AND_POLICY', 'CANCELLATION_AND_POLICY_CREATE', 1, 1, NULL, '2026-04-18 18:35:51', '2026-04-18 18:35:51'),
(49, 'CANCELLATION_AND_POLICY_UPDATE', 'ITINERARY', 'CANCELLATION_AND_POLICY', 'CANCELLATION_AND_POLICY_UPDATE', 1, 1, NULL, '2026-04-18 18:35:51', '2026-04-18 18:35:51'),
(50, 'CANCELLATION_AND_POLICY_DELETE', 'ITINERARY', 'CANCELLATION_AND_POLICY', 'CANCELLATION_AND_POLICY_DELETE', 1, 1, NULL, '2026-04-18 18:35:51', '2026-04-18 18:35:51'),
(51, 'SPECIAL_REQUIREMENTS_VIEW', 'ITINERARY', 'SPECIAL_REQUIREMENTS', 'SPECIAL_REQUIREMENTS', 1, 1, NULL, '2026-04-18 18:39:29', '2026-04-18 18:39:29'),
(52, 'SPECIAL_REQUIREMENTS_CREATE', 'ITINERARY', 'SPECIAL_REQUIREMENTS', 'SPECIAL_REQUIREMENTS_CREATE', 1, 1, NULL, '2026-04-18 18:39:29', '2026-04-18 18:39:29'),
(53, 'SPECIAL_REQUIREMENTS_UPDATE', 'ITINERARY', 'SPECIAL_REQUIREMENTS', 'SPECIAL_REQUIREMENTS_UPDATE', 1, 1, NULL, '2026-04-18 18:39:29', '2026-04-18 18:39:29'),
(54, 'SPECIAL_REQUIREMENTS_DELETE', 'ITINERARY', 'SPECIAL_REQUIREMENTS', 'SPECIAL_REQUIREMENTS_DELETE', 1, 1, NULL, '2026-04-18 18:39:29', '2026-04-18 18:39:29'),
(55, 'TEMPLATES_VIEW', 'TEMPLATES', 'TEMPLATES', 'TEMPLATES_VIEW', 1, 1, NULL, '2026-04-18 18:41:16', '2026-04-18 18:41:16'),
(56, 'TEMPLATES_CREATE', 'TEMPLATES', 'TEMPLATES', 'TEMPLATES_CREATE', 1, 1, NULL, '2026-04-18 18:41:16', '2026-04-18 18:41:16'),
(57, 'TEMPLATES_UPDATE', 'TEMPLATES', 'TEMPLATES', 'TEMPLATES_UPDATE', 1, 1, NULL, '2026-04-18 18:41:16', '2026-04-18 18:41:16'),
(58, 'TEMPLATES_DELETE', 'TEMPLATES', 'TEMPLATES', 'TEMPLATES_DELETE', 1, 1, NULL, '2026-04-18 18:41:16', '2026-04-18 18:41:16'),
(63, 'TEMPLATES_CATEGORY_VIEW', 'TEMPLATES', 'CATEGORY', 'CATEGORY_VIEW', 1, 1, NULL, '2026-04-18 18:44:02', '2026-04-18 18:44:02'),
(64, 'TEMPLATES_CATEGORY_CREATE', 'TEMPLATES', 'CATEGORY', 'CATEGORY_CREATE', 1, 1, NULL, '2026-04-18 18:44:02', '2026-04-18 18:44:02'),
(65, 'TEMPLATES_CATEGORY_UPDATE', 'TEMPLATES', 'CATEGORY', 'CATEGORY_UPDATE', 1, 1, NULL, '2026-04-18 18:44:02', '2026-04-18 18:44:02'),
(66, 'TEMPLATES_CATEGORY_DELETE', 'TEMPLATES', 'CATEGORY', 'CATEGORY_DELETE', 1, 1, NULL, '2026-04-18 18:44:02', '2026-04-18 18:44:02'),
(67, 'LEADS_VIEW', 'LEADS', 'LEADS', 'LEADS_VIEW', 1, 1, NULL, '2026-04-18 18:46:02', '2026-04-18 18:46:02'),
(68, 'LEADS_CREATE', 'LEADS', 'LEADS', 'LEADS_CREATE', 1, 1, NULL, '2026-04-18 18:46:02', '2026-04-18 18:46:02'),
(69, 'LEADS_UPDATE', 'LEADS', 'LEADS', 'LEADS_UPDATE', 1, 1, NULL, '2026-04-18 18:46:02', '2026-04-18 18:46:02'),
(70, 'LEADS_DELETE', 'LEADS', 'LEADS', 'LEADS_DELETE', 1, 1, NULL, '2026-04-18 18:46:02', '2026-04-18 18:46:02'),
(71, 'QUOTATION_VIEW', 'QUOTATION', 'QUOTATION', 'QUOTATION_VIEW', 1, 1, NULL, '2026-04-18 18:47:35', '2026-04-18 18:47:35'),
(72, 'QUOTATION_CREATE', 'QUOTATION', 'QUOTATION', 'QUOTATION_CREATE', 1, 1, NULL, '2026-04-18 18:47:35', '2026-04-18 18:47:35'),
(73, 'QUOTATION_UPDATE', 'QUOTATION', 'QUOTATION', 'QUOTATION_UPDATE', 1, 1, NULL, '2026-04-18 18:47:35', '2026-04-18 18:47:35'),
(74, 'QUOTATION_DELETE', 'QUOTATION', 'QUOTATION', 'QUOTATION_DELETE', 1, 1, NULL, '2026-04-18 18:47:35', '2026-04-18 18:47:35'),
(77, 'PROPERTY_CATEGORY_CREATE', 'MASTERS', 'PROPERTY', 'PROPERTY_CATEGORY_CREATE', 1, 1, 1, '2026-04-19 14:18:47', '2026-04-19 14:18:47'),
(78, 'PROPERTY_CATEGORY_UPDATE', 'MASTERS', 'PROPERTY', 'PROPERTY_CATEGORY_UPDATE', 1, 1, 1, '2026-04-19 14:18:47', '2026-04-19 14:18:47'),
(79, 'PROPERTY_CATEGORY_DELETE', 'MASTERS', 'PROPERTY', 'PROPERTY_CATEGORY_DELETE', 1, 1, 1, '2026-04-19 14:23:11', '2026-04-19 14:23:11'),
(80, 'SOURCE_CREATE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:32:58', '2026-04-27 13:59:23'),
(81, 'SOURCE_UPDATE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:32:58', '2026-04-27 14:00:07'),
(82, 'SOURCE_DELETE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:34:29', '2026-04-27 13:59:30'),
(83, 'STAGE_CREATE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:34:29', '2026-04-27 13:59:32'),
(84, 'STAGE_UPDATE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:36:06', '2026-04-27 13:59:36'),
(85, 'STAGE_DELETE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:36:06', '2026-04-27 13:59:39'),
(86, 'STAGE_VIEW', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:37:37', '2026-04-27 13:59:41'),
(87, 'SOURCE_VIEW', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:37:37', '2026-04-27 13:59:44'),
(88, 'PRIORITY_STATUS_CREATE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:39:12', '2026-04-27 13:59:48'),
(89, 'PRIORITY_STATUS_UPDATE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:39:12', '2026-04-27 13:59:51'),
(90, 'PRIORITY_STATUS_DELETE', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:40:23', '2026-04-27 13:59:54'),
(91, 'PRIORITY_STATUS_VIEW', 'MASTERS', 'LEADS', 'LEADS_MANAGEMENT menu', 1, 1, 1, '2026-04-27 13:40:23', '2026-04-27 13:59:57'),
(92, 'PROPERTY_DETAILS', 'MASTERS', 'PROPERTY', 'PROPERTY_DETAILS', 1, 1, 1, '2026-04-27 14:06:24', '2026-04-27 14:06:24'),
(93, 'PROPERTY_PHOTO', 'MASTERS', 'PROPERTY', 'PROPERTY_PHOTO', 1, 1, 1, '2026-04-27 14:06:24', '2026-04-27 14:06:24'),
(94, 'PROPERTY_CATEGORY_VIEW', 'MASTERS', 'PROPERTY', 'PROPERTY_CATEGORY_CREATE', 1, 1, 1, '2026-04-27 15:13:09', '2026-04-27 15:13:09'),
(95, 'ITINERARY_DUPLICATE', 'ITINERARY', 'ITINERARY', 'ITINERARY_DUPLICATE', 1, 1, 1, '2026-04-27 15:27:30', '2026-04-27 15:27:30'),
(96, 'ITINERARY_PREVIEW', 'ITINERARY', 'ITINERARY', 'ITINERARY_PREVIEW', 1, 1, 1, '2026-04-27 15:27:30', '2026-04-27 15:27:30'),
(97, 'TEMPLATES_DUPLICATE', 'TEMPLATES', 'TEMPLATES', 'TEMPLATES_DUPLICATE', 1, 1, 1, '2026-04-27 17:28:29', '2026-04-27 17:28:29'),
(98, 'TEMPLATES_PREVIEW', 'TEMPLATES', 'TEMPLATES', 'TEMPLATES_PREVIEW', 1, 1, 1, '2026-04-27 17:28:29', '2026-04-27 17:28:29'),
(99, 'QUOTATION_UPDATE_ITINERARY', 'QUOTATION', 'QUOTATION', 'QUOTATION_UPDATE_ITINERARY', 1, 1, 1, '2026-04-29 23:52:20', '2026-04-29 23:52:20'),
(100, 'QUOTATION_CHANGE_STATUS', 'QUOTATION', 'QUOTATION', 'QUOTATION_CHANGE_STATUS', 1, 1, 1, '2026-04-29 23:52:20', '2026-04-29 23:52:20'),
(101, 'QUOTATION_PREVIEW', 'QUOTATION', 'QUOTATION', 'QUOTATION_PREVIEW', 1, 1, 1, '2026-04-29 23:52:48', '2026-04-29 23:52:48'),
(102, 'LEADS_CHANGE_STATUS', 'LEADS', 'LEADS', 'LEADS_CHANGE_STATUS', 1, 1, 1, '2026-04-30 06:55:30', '2026-04-30 06:55:30'),
(103, 'LEADS_SHOW_STATUS', 'LEADS', 'LEADS', 'LEADS_SHOW_STATUS', 1, 1, 1, '2026-04-30 06:55:30', '2026-04-30 06:55:30'),
(104, 'LEADS_CHANGE_STAGE', 'LEADS', 'LEADS', 'LEADS_CHANGE_STAGE', 1, 1, 1, '2026-04-30 06:56:51', '2026-04-30 06:56:51'),
(105, 'LEADS_SHOW_STAGE', 'LEADS', 'LEADS', 'LEADS_SHOW_STAGE', 1, 1, 1, '2026-04-30 06:56:51', '2026-04-30 06:56:51'),
(106, 'LEADS_DETAILS', 'LEADS', 'LEADS', 'LEADS_DETAILS', 1, 1, 1, '2026-04-30 06:58:00', '2026-04-30 06:58:00'),
(107, 'LEADS_GUEST_COUNT', 'LEADS', 'LEADS', 'LEADS_GUEST_COUNT', 1, 1, 1, '2026-04-30 06:58:00', '2026-04-30 06:58:00'),
(108, 'LEADS_ACCOMODATION_PLAN', 'LEADS', 'LEADS', 'LEADS_ACCOMODATION_PLAN', 1, 1, 1, '2026-04-30 07:00:02', '2026-04-30 07:00:02'),
(109, 'LEADS_QUOTATION', 'LEADS', 'LEADS', 'LEADS_QUOTATION', 1, 1, 1, '2026-04-30 07:00:02', '2026-04-30 07:00:02');

-- --------------------------------------------------------

--
-- Table structure for table `tr_roles`
--

CREATE TABLE `tr_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1 = Active, 0 = Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tr_roles`
--

INSERT INTO `tr_roles` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'staff-telecommunication', '', 1, 1, NULL, '2026-04-19 03:15:58', '2026-04-19 13:45:58'),
(2, 'Super admin', '', 1, 1, 1, '2026-04-20 11:11:55', '2026-04-30 09:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `tr_role_permissions`
--

CREATE TABLE `tr_role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT 1 COMMENT '1 = Active, 0 = Inactive',
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_at` datetime DEFAULT current_timestamp(),
  `updated_at` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `tr_role_permissions`
--

INSERT INTO `tr_role_permissions` (`id`, `role_id`, `permission_id`, `status`, `assigned_by`, `assigned_at`, `updated_at`) VALUES
(1, 1, 5, 1, 1, '2026-04-19 13:45:58', '2026-04-19 13:57:21'),
(2, 1, 6, 1, 1, '2026-04-19 13:45:58', '2026-04-19 13:57:59'),
(3, 1, 2, 1, 1, '2026-04-19 13:45:58', '2026-04-19 13:58:47'),
(4, 1, 3, 1, 1, '2026-04-19 13:45:58', '2026-04-19 13:58:47'),
(5, 1, 77, 1, 1, '2026-04-19 13:45:58', '2026-04-19 14:43:56'),
(6, 1, 78, 1, 1, '2026-04-19 13:45:58', '2026-04-19 14:43:56'),
(7, 1, 79, 1, 1, '2026-04-19 13:45:58', '2026-04-19 14:43:56'),
(8, 1, 12, 1, 1, '2026-04-19 13:45:58', '2026-04-19 14:43:56'),
(9, 1, 1388, 1, 1, '2026-04-19 13:45:58', '2026-04-19 15:10:13'),
(10, 1, 1755, 1, 1, '2026-04-19 13:45:58', '2026-04-19 15:10:37'),
(84, 2, 1, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(85, 2, 2, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(86, 2, 5, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(87, 2, 6, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(88, 2, 3, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(89, 2, 7, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(90, 2, 8, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(91, 2, 11, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(92, 2, 77, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(93, 2, 78, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(94, 2, 79, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(95, 2, 92, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(96, 2, 93, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(97, 2, 94, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(98, 2, 4, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(99, 2, 9, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(100, 2, 10, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(101, 2, 12, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(102, 2, 13, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(103, 2, 14, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(104, 2, 15, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(105, 2, 16, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(106, 2, 17, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(107, 2, 18, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(108, 2, 19, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(109, 2, 20, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(110, 2, 21, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(111, 2, 22, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(112, 2, 23, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(113, 2, 24, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(114, 2, 25, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(115, 2, 26, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(116, 2, 80, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(117, 2, 81, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(118, 2, 82, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(119, 2, 83, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(120, 2, 84, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(121, 2, 85, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(122, 2, 86, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(123, 2, 87, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(124, 2, 88, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(125, 2, 89, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(126, 2, 90, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(127, 2, 91, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(128, 2, 27, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(129, 2, 28, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(130, 2, 29, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(131, 2, 30, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(132, 2, 95, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(133, 2, 96, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(134, 2, 31, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(135, 2, 32, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(136, 2, 33, 1, 1, '2026-04-30 09:02:33', '2026-04-30 09:02:33'),
(137, 2, 34, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(138, 2, 35, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(139, 2, 36, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(140, 2, 37, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(141, 2, 38, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(142, 2, 39, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(143, 2, 40, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(144, 2, 41, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(145, 2, 42, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(146, 2, 43, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(147, 2, 44, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(148, 2, 45, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(149, 2, 46, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(150, 2, 47, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(151, 2, 48, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(152, 2, 49, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(153, 2, 50, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(154, 2, 51, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(155, 2, 52, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(156, 2, 53, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(157, 2, 54, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(158, 2, 55, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(159, 2, 56, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(160, 2, 57, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(161, 2, 58, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(162, 2, 97, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(163, 2, 98, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(164, 2, 63, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(165, 2, 64, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(166, 2, 65, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(167, 2, 66, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(168, 2, 67, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(169, 2, 68, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(170, 2, 69, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(171, 2, 70, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(172, 2, 102, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(173, 2, 103, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(174, 2, 104, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(175, 2, 105, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(176, 2, 106, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(177, 2, 107, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(178, 2, 108, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(179, 2, 109, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(180, 2, 71, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(181, 2, 72, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(182, 2, 73, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(183, 2, 74, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(184, 2, 99, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(185, 2, 100, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33'),
(186, 2, 101, 1, 1, '2026-04-30 09:02:34', '2026-04-30 09:02:33');

-- --------------------------------------------------------

--
-- Table structure for table `upload_tariff_document`
--

CREATE TABLE `upload_tariff_document` (
  `upload_tariff_document_id` int(11) NOT NULL,
  `property_id_fk` int(11) NOT NULL,
  `upload_tariff_document_from_date` date NOT NULL,
  `upload_tariff_document_to_date` date NOT NULL,
  `upload_tariff_document_name` varchar(255) NOT NULL,
  `upload_tariff_document_description` text NOT NULL,
  `upload_tariff_document_created_by_user_id` int(11) NOT NULL,
  `upload_tariff_document_created_by_user_name` varchar(255) NOT NULL,
  `upload_tariff_document_created_date` date NOT NULL,
  `upload_tariff_document_created_time` time NOT NULL,
  `upload_tariff_document_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `upload_tariff_document`
--

INSERT INTO `upload_tariff_document` (`upload_tariff_document_id`, `property_id_fk`, `upload_tariff_document_from_date`, `upload_tariff_document_to_date`, `upload_tariff_document_name`, `upload_tariff_document_description`, `upload_tariff_document_created_by_user_id`, `upload_tariff_document_created_by_user_name`, `upload_tariff_document_created_date`, `upload_tariff_document_created_time`, `upload_tariff_document_status`) VALUES
(1, 1, '2025-09-07', '2025-09-08', 'src-3.jpeg', 'gh', 1, 'Super admin', '2025-09-07', '06:23:17', 1),
(2, 1, '2025-09-07', '0000-00-00', 'src-25.jpeg', 'gh', 1, 'Super admin', '2025-09-07', '06:25:03', 0),
(3, 1, '2025-09-08', '2025-09-17', 'src-1.jpeg', '', 1, 'Super admin', '2025-09-07', '06:28:23', 0),
(4, 5, '2026-01-25', '2026-01-31', '', '', 1, 'Super admin', '2026-01-25', '06:54:23', 0),
(5, 8, '2026-02-01', '2026-02-28', '', '', 1, 'Super admin', '2026-02-07', '05:16:04', 1),
(6, 7, '2026-02-01', '2026-02-28', '', '', 1, 'Super admin', '2026-02-07', '07:32:27', 1),
(7, 16, '2026-02-18', '2026-02-27', '', '', 1, 'Super admin', '2026-02-18', '05:25:45', 1),
(8, 16, '2026-02-01', '2026-02-06', '', '', 1, 'Super admin', '2026-02-18', '05:27:40', 1),
(9, 19, '2026-02-11', '2026-02-18', '', '', 1, 'Super admin', '2026-02-19', '12:06:06', 1),
(10, 19, '2026-02-04', '2026-02-27', '', '', 1, 'Super admin', '2026-02-19', '12:13:23', 1),
(11, 19, '2026-02-11', '2026-02-27', '', '', 1, 'Super admin', '2026-02-19', '12:20:55', 1),
(12, 19, '2026-02-18', '2026-02-27', '', '', 1, 'Super admin', '2026-02-19', '12:24:04', 1),
(13, 19, '2026-02-18', '2026-02-26', '', '', 1, 'Super admin', '2026-02-19', '12:26:03', 1),
(14, 19, '2026-02-18', '2026-02-18', '', '', 1, 'Super admin', '2026-02-19', '12:40:07', 1),
(15, 19, '2026-02-18', '2026-02-27', 'e9f51edf07b19d16e1ffd7521851f6cd.pdf', '', 1, 'Super admin', '2026-02-19', '12:50:23', 1),
(16, 19, '2026-02-20', '2026-02-27', 'e9f51edf07b19d16e1ffd7521851f6cd1.pdf', '', 1, 'Super admin', '2026-02-19', '12:54:08', 0),
(17, 21, '2026-02-01', '2026-02-28', 'Special_rates-Season-_1st_October_To_March_2026_-Age.pdf', '', 1, 'Super admin', '2026-02-19', '07:09:52', 1),
(18, 24, '0000-00-00', '0000-00-00', 'FIT_RATES_2026_Ananthapuram_.pdf', '', 1, 'Super admin', '2026-02-19', '10:21:42', 1),
(19, 24, '0000-00-00', '0000-00-00', 'FIT_RATES_2026_Ananthapuram_1.pdf', '', 1, 'Super admin', '2026-02-19', '10:21:45', 1),
(20, 24, '0000-00-00', '0000-00-00', 'FIT_RATES_2026_Ananthapuram_2.pdf', '', 1, 'Super admin', '2026-02-19', '10:21:55', 0),
(21, 24, '2026-02-01', '2026-02-19', 'FIT_RATES_2026_Ananthapuram_3.pdf', '', 1, 'Super admin', '2026-02-19', '10:23:10', 1),
(22, 26, '2026-04-01', '2026-03-31', 'Deshadan_Kerala_-SPECIAL_RATES_2026-20271.pdf', '', 1, 'Super admin', '2026-02-19', '11:29:48', 1),
(23, 26, '2026-04-01', '2027-03-31', 'Deshadan_Kerala_-SPECIAL_RATES_2026-2027.pdf', '', 1, 'Super admin', '2026-02-19', '11:30:40', 1),
(24, 28, '2026-02-01', '2026-03-04', 'Off_Season_Season_Special_Rates_2025-2026_Rudra_Leisure_Services_Pvt_L___.pdf', '', 1, 'Super admin', '2026-02-22', '05:20:05', 1),
(25, 30, '2026-02-01', '2026-01-27', 'OPALO_KVLM_B2B_202526.pdf', '', 1, 'Super admin', '2026-02-22', '06:06:39', 1),
(26, 32, '2026-02-01', '2026-09-30', 'Trivers_Munnnar.pdf', '', 1, 'Super admin', '2026-02-24', '05:27:27', 1),
(27, 40, '2026-04-01', '2026-10-31', 'Off_Season_Special_rate_April_(2026)_to_October_(2026).pdf', '', 1, 'Super admin', '2026-02-26', '12:51:47', 1),
(28, 40, '2026-11-01', '2027-03-31', 'Off_Season_Special_rate_April_(2026)_to_October_(2026)1.pdf', 'HIKE DATES RATES - NEED TO CHECK WITH HOTEL RESERVATION\r\n', 1, 'Super admin', '2026-02-26', '12:52:30', 1),
(29, 31, '2026-02-01', '2027-01-31', '', '', 1, 'Super admin', '2026-02-26', '02:38:01', 1),
(30, 43, '2026-04-01', '2027-03-31', '', '', 1, 'Super admin', '2026-02-27', '02:39:22', 1),
(31, 44, '2026-03-01', '2026-09-30', 'Special_Rate_Maat_Hotels_and_Resorts_2026.pdf', '', 1, 'Super admin', '2026-03-03', '12:13:41', 1),
(32, 45, '2026-01-01', '2026-09-30', 'Special_Rate_Maat_Hotels_and_Resorts_20261.pdf', '', 1, 'Super admin', '2026-03-03', '12:21:03', 1),
(33, 46, '2026-03-01', '2026-09-30', 'Special_Rate_Maat_Hotels_and_Resorts_20262.pdf', '', 1, 'Super admin', '2026-03-03', '12:32:46', 1),
(34, 48, '2026-03-01', '2026-06-30', 'Special_Rate_Maat_Hotels_and_Resorts_20263.pdf', '', 1, 'Super admin', '2026-03-03', '01:45:15', 1),
(35, 49, '2026-03-01', '2027-03-31', 'WhatsApp_Image_2026-03-03_at_13_39_32.jpeg', '', 1, 'Super admin', '2026-03-03', '02:11:08', 1),
(36, 50, '2026-03-01', '2027-02-28', 'WhatsApp_Image_2026-03-03_at_13_33_43.jpeg', '', 1, 'Super admin', '2026-03-03', '02:38:08', 1),
(37, 51, '2026-04-01', '2026-09-30', 'Peppervine_-_Special_Net_Rates_2026-27.pdf', '', 1, 'Super admin', '2026-03-05', '01:48:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `shift_id_fk` int(11) NOT NULL,
  `meta_force_stop` varchar(50) NOT NULL,
  `tamil_speak` varchar(50) NOT NULL,
  `user_unique_id` varchar(255) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `main_head_staff_id` int(11) NOT NULL,
  `main_head_staff_name` varchar(255) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `user_address` text NOT NULL,
  `user_email_address` varchar(255) NOT NULL,
  `user_phone_number` varchar(255) NOT NULL,
  `user_lan_number` varchar(255) NOT NULL,
  `user_city` varchar(255) NOT NULL,
  `user_state` varchar(255) NOT NULL,
  `user_zipcode` varchar(255) NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `role_id_fk` int(11) NOT NULL,
  `designation_id_fk` int(11) NOT NULL,
  `user_date_of_joining` date NOT NULL,
  `user_profile_pic` varchar(255) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_description` text NOT NULL,
  `user_created_date` date NOT NULL,
  `user_created_time` time NOT NULL,
  `user_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `admin_name`, `user_id_fk`, `shift_id_fk`, `meta_force_stop`, `tamil_speak`, `user_unique_id`, `company_name`, `main_head_staff_id`, `main_head_staff_name`, `user_type`, `user_address`, `user_email_address`, `user_phone_number`, `user_lan_number`, `user_city`, `user_state`, `user_zipcode`, `country_id_fk`, `role_id_fk`, `designation_id_fk`, `user_date_of_joining`, `user_profile_pic`, `user_name`, `password`, `user_description`, `user_created_date`, `user_created_time`, `user_status`) VALUES
(1, 'Super admin', 0, 0, '', '', '', '', 0, '', 'A', '																																																																																				ernakulam																																																																								', '', '', '', '', '', '', 0, 2, 0, '0000-00-00', '', 'admin', 'admin', '																																																																																				nill																																																																								', '2020-11-26', '04:19:21', 1),
(2, 'Tiffin box', 0, 0, '', '', '', '', 0, '', 'C', 'KERALA', '', '', '', '', '', '', 0, 0, 0, '0000-00-00', '', 'tiffin@123', 'tiffin@123', 'nill', '2020-11-26', '11:22:20', 1),
(3, 'Monisha Pramod', 2, 0, '', '', 'MD3', 'Tiffin box', 0, '', 'S', 'Poyillathu House\r\nPalloorkkavu PO', 'monishapramod5@gmail.com', '919744571400', '', 'Mundakkayam', 'Kerala', '685532', 99, 1, 1, '2024-11-16', 'WhatsApp_Image_2024-11-17_at_10_22_22_f1ac71b7.jpg', 'Monisha', 'Monisha', '', '2024-11-17', '10:26:45', 0),
(4, 'Shalat Mol Shaji', 2, 0, '', '', 'MD4', 'Tiffin box', 0, '', 'MH', 'Puthenparambil House\r\nMadukka', 'shalatshaluz@gmail.com', '919074221370', '', 'Mundakkayam', 'Kerala', '686513', 99, 1, 1, '2024-05-06', 'WhatsApp_Image_2024-11-18_at_16_41_17_339ade35.jpg', 'Shalat', 'Shalat', '', '2024-11-18', '04:42:48', 1),
(5, 'Anjala Basheer', 2, 0, '', '', 'MD5', 'Tiffin box', 0, '', 'MH', 'Thiriyalapatta\r\nMuttil South\r\nWayanad', 'anjalafathimakm00@gmail.com', '918848588861', '', 'Wayanad', 'Kerala', '673122', 99, 1, 1, '2025-01-01', '', 'Anjala', 'Anjala', '', '2025-01-02', '10:51:50', 1),
(6, 'Anshida C A', 2, 0, '', '', 'MD6', 'Tiffin box', 0, '', 'MH', 'CHAKKUNNAN\r\nNAROKKAVU\r\nNilambur ', 'anshidaachu406@gmail.com', '+918281572809', '', 'Malappuram', 'Kerala', '679331', 99, 1, 1, '2025-04-14', '', 'Anshida', 'Anshida@123', '', '2025-04-08', '04:00:44', 1),
(7, 'NISHA', 0, 1, 'N', 'N', '', '', 0, '', 'S', 'ALUVA', '', '6767676767', '', '', '', '', 0, 1, 1, '2026-02-04', '', 'nisha', 'Nisha', '', '2026-02-16', '01:28:56', 1),
(8, 'REEHAL', 0, 2, 'N', 'N', '', '', 0, '', 'S', '', 'FFEEE@GMAIL.COM', '7676544332', '', '', '', '', 0, 1, 1, '2026-02-20', '', 'WAR', 'WAR', '', '2026-02-18', '11:07:05', 0),
(9, 'SETHU', 0, 1, 'N', 'N', '', '', 0, '', 'S', 'CHENNAI', 'SETHU@GMAIL.COM', '7876546765', '', '', '', '', 0, 1, 1, '2026-02-27', '', 'SETHU', 'SETHU', '', '2026-02-18', '11:07:49', 0),
(10, 'SANI', 0, 2, 'N', 'N', '', '', 0, '', 'S', 'HYD', 'SANI&HOTMAIL.COM', '6554322123', '', '', '', '', 0, 1, 1, '1970-01-01', '', 'SANI', 'SANI', '', '2026-02-18', '11:08:21', 0),
(11, 'Fahad', 0, 2, 'N', 'N', '', '', 0, '', 'S', '', '', '', '', '', '', '', 0, 1, 0, '1970-01-01', '', 'fahad', 'fahd', '', '2026-04-14', '03:08:52', 0),
(12, 'SHANIMOL', 0, 2, 'Y', 'Y', '', '', 0, '', 'S', '', '', '9072609246', '9072609246', '', '', '', 0, 1, 1, '2026-03-10', '', 'royaleshani', '1234', '', '2026-04-19', '05:57:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege`
--

CREATE TABLE `user_privilege` (
  `user_privilege_id` int(11) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `user_leads_add` varchar(255) NOT NULL,
  `user_leads_edit` varchar(255) NOT NULL,
  `user_leads_view` varchar(255) NOT NULL,
  `user_leads_delete` varchar(255) NOT NULL,
  `user_customer_add` varchar(255) NOT NULL,
  `user_customer_edit` varchar(255) NOT NULL,
  `user_customer_view` varchar(255) NOT NULL,
  `user_customer_delete` varchar(255) NOT NULL,
  `user_privilege_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicle`
--

CREATE TABLE `vehicle` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_name` varchar(255) NOT NULL,
  `vehicle_number_seat` varchar(50) NOT NULL,
  `vehicle_description` text NOT NULL,
  `vehicle_createdby_user_id` int(11) NOT NULL,
  `vehicle_createdby_user_name` varchar(255) NOT NULL,
  `vehicle_created_date` date NOT NULL,
  `vehicle_created_time` time NOT NULL,
  `vehicle_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_name`, `vehicle_number_seat`, `vehicle_description`, `vehicle_createdby_user_id`, `vehicle_createdby_user_name`, `vehicle_created_date`, `vehicle_created_time`, `vehicle_status`) VALUES
(1, 'Ertiga', '', '', 0, '', '2025-07-19', '07:31:45', 0),
(2, 'mmn', '', 'vv', 0, '', '2025-07-19', '07:31:55', 0),
(3, 'fhfh', '', '', 0, '', '2025-07-19', '07:47:22', 0),
(4, 'gffgnn', '', 'gfghf', 0, '', '2025-07-19', '07:47:39', 0),
(5, 'kk', '', '', 0, '', '2025-07-19', '07:50:51', 0),
(6, 'gffg', '', '', 0, '', '2025-07-19', '07:51:01', 0),
(7, 'gdd', '', 'dd', 0, '', '2025-07-19', '07:51:23', 0),
(8, 'hghgh', '', '', 0, '', '2025-07-19', '07:51:28', 0),
(9, 'qwfdf', '', '', 0, '', '2025-07-19', '07:51:41', 0),
(10, 'fdf', '', '', 0, '', '2025-07-19', '07:51:52', 0),
(11, 'tyt', '', '', 0, '', '2025-07-19', '07:52:04', 0),
(12, 'etythhh', '', '', 0, '', '2025-07-19', '07:52:11', 0),
(13, 'eet', '', '', 0, '', '2025-07-19', '07:52:22', 0),
(14, 'fhfh', '', '', 0, '', '2025-07-19', '07:53:17', 0),
(15, 'mbbnhghgfh', '', '', 0, '', '2025-07-19', '07:53:28', 0),
(16, 'hfhg', '', '', 0, '', '2025-07-19', '07:53:57', 0),
(17, 'saasdfdf', '', 'ads', 0, '', '2025-07-19', '07:54:08', 0),
(18, 'fsfsdffd', '', 'dffd', 0, '', '2025-07-19', '07:54:20', 0),
(19, 'fgf', '', '', 0, '', '2025-07-19', '07:54:33', 0),
(20, 'hghgfg', '', '', 0, '', '2025-07-19', '07:54:54', 0),
(21, 'sdf', '', '', 0, '', '2025-07-19', '08:01:00', 0),
(22, 'gfgfdgdfgf0', '', 'fgdgdfgff', 0, '', '2025-07-19', '08:01:19', 0),
(23, 'dd', '', '', 0, '', '2025-07-19', '08:02:03', 0),
(24, 'gdgddf', '', 'dg', 0, '', '2025-07-19', '08:02:12', 0),
(25, '3w', '', '', 0, '', '2025-07-19', '08:08:55', 0),
(26, 'gdfg', '3', 'dgdg', 0, '', '2025-07-19', '08:52:53', 0),
(27, 'dsd', '4', 'gd', 0, '', '2025-07-19', '08:54:30', 0),
(28, 'hhg', '454', 'd', 0, '', '2025-07-19', '08:54:39', 0),
(29, 'gfg', 'ds', '', 0, '', '2025-07-19', '09:17:00', 0),
(30, 'jhjh', 'hjh', 'hjhj', 0, '', '2025-07-19', '09:17:18', 0),
(31, 'dfggf', '44', 'fd', 0, '', '2025-07-19', '09:18:29', 0),
(32, 'KL-010-23_edited', '12', 'sd_edited', 1, 'Super admin', '2026-01-25', '03:01:46', 0),
(33, 'KL-10-202', '2', 'sd', 1, 'Super admin', '2026-01-25', '03:02:02', 0),
(34, 'AC SEDAN', '4', '', 1, 'Super admin', '2026-02-07', '11:38:31', 1),
(35, 'AC ERTIGA', '6', '', 1, 'Super admin', '2026-02-07', '11:39:39', 1),
(36, 'AC INNOVA', '7', '', 1, 'Super admin', '2026-02-07', '11:39:53', 1),
(37, 'AC 12 SEATER TEMPO', '12', '', 1, 'Super admin', '2026-02-07', '11:40:17', 1),
(38, 'AC 17 SEATER TEMPO', '17', '', 1, 'Super admin', '2026-02-07', '11:43:46', 1),
(39, 'AC 26 SEATER TEMPO', '26', '', 1, 'Super admin', '2026-02-07', '11:44:18', 1),
(40, 'AC TEMPO TRAVELLER', '12', '', 1, 'Super admin', '2026-02-17', '07:07:41', 1);

-- --------------------------------------------------------

--
-- Table structure for table `week_days`
--

CREATE TABLE `week_days` (
  `week_days_id` int(11) NOT NULL,
  `week_days_name` varchar(255) NOT NULL,
  `week_days_description` text NOT NULL,
  `week_days_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `week_days`
--

INSERT INTO `week_days` (`week_days_id`, `week_days_name`, `week_days_description`, `week_days_status`) VALUES
(1, 'Sunday', '', 1),
(2, 'Monday', '', 1),
(3, 'Tuesday', '', 1),
(4, 'Wednesday', '', 1),
(5, 'Thursday', '', 1),
(6, 'Friday', '', 1),
(7, 'Saturday', '', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accommodation_plan`
--
ALTER TABLE `accommodation_plan`
  ADD PRIMARY KEY (`accommodation_plan_id`);

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`account_details_id`);

--
-- Indexes for table `activity`
--
ALTER TABLE `activity`
  ADD PRIMARY KEY (`activity_id`);

--
-- Indexes for table `b2b_partner`
--
ALTER TABLE `b2b_partner`
  ADD PRIMARY KEY (`b2b_partner_id`);

--
-- Indexes for table `cancellation_policies`
--
ALTER TABLE `cancellation_policies`
  ADD PRIMARY KEY (`cancellation_policies_id`);

--
-- Indexes for table `cancellation_policies_item`
--
ALTER TABLE `cancellation_policies_item`
  ADD PRIMARY KEY (`cancellation_policies_item_id`);

--
-- Indexes for table `child_age_break_up`
--
ALTER TABLE `child_age_break_up`
  ADD PRIMARY KEY (`child_age_break_up_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designation`
--
ALTER TABLE `designation`
  ADD PRIMARY KEY (`designation_id`);

--
-- Indexes for table `district`
--
ALTER TABLE `district`
  ADD PRIMARY KEY (`district_id`);

--
-- Indexes for table `exclusions`
--
ALTER TABLE `exclusions`
  ADD PRIMARY KEY (`exclusions_id`);

--
-- Indexes for table `guset_count`
--
ALTER TABLE `guset_count`
  ADD PRIMARY KEY (`guset_count_id`);

--
-- Indexes for table `guset_count_details`
--
ALTER TABLE `guset_count_details`
  ADD PRIMARY KEY (`guset_count_details_id`);

--
-- Indexes for table `hike_room_tariff_hike`
--
ALTER TABLE `hike_room_tariff_hike`
  ADD PRIMARY KEY (`hike_room_tariff_hike_id`);

--
-- Indexes for table `hike_room_tariff_hike_rate`
--
ALTER TABLE `hike_room_tariff_hike_rate`
  ADD PRIMARY KEY (`hike_room_tariff_hike_rate_id`);

--
-- Indexes for table `hike_room_tariff_week_days_rate`
--
ALTER TABLE `hike_room_tariff_week_days_rate`
  ADD PRIMARY KEY (`hike_room_tariff_week_days_rate_id`);

--
-- Indexes for table `inclusions`
--
ALTER TABLE `inclusions`
  ADD PRIMARY KEY (`inclusions_id`);

--
-- Indexes for table `inclusion_exclusion_common`
--
ALTER TABLE `inclusion_exclusion_common`
  ADD PRIMARY KEY (`inclusion_exclusion_common_id`);

--
-- Indexes for table `itineraries`
--
ALTER TABLE `itineraries`
  ADD PRIMARY KEY (`itineraries_id`);

--
-- Indexes for table `itineraries_days`
--
ALTER TABLE `itineraries_days`
  ADD PRIMARY KEY (`itineraries_days_id`);

--
-- Indexes for table `itinerary_category`
--
ALTER TABLE `itinerary_category`
  ADD PRIMARY KEY (`itinerary_category_id`);

--
-- Indexes for table `leads`
--
ALTER TABLE `leads`
  ADD PRIMARY KEY (`leads_id`),
  ADD UNIQUE KEY `uniq_meta_leadgen_id` (`meta_leadgen_id`);

--
-- Indexes for table `login_logs`
--
ALTER TABLE `login_logs`
  ADD PRIMARY KEY (`login_logs_id`);

--
-- Indexes for table `meal_plan`
--
ALTER TABLE `meal_plan`
  ADD PRIMARY KEY (`meal_plan_id`);

--
-- Indexes for table `meta_ads_setting`
--
ALTER TABLE `meta_ads_setting`
  ADD PRIMARY KEY (`meta_ads_setting_id`);

--
-- Indexes for table `meta_ads_setting_staff`
--
ALTER TABLE `meta_ads_setting_staff`
  ADD PRIMARY KEY (`meta_ads_setting_staff_id`);

--
-- Indexes for table `meta_lead_logs`
--
ALTER TABLE `meta_lead_logs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uniq_leadgen_id` (`leadgen_id`);

--
-- Indexes for table `packages`
--
ALTER TABLE `packages`
  ADD PRIMARY KEY (`packages_id`);

--
-- Indexes for table `packages_cancellation_policies`
--
ALTER TABLE `packages_cancellation_policies`
  ADD PRIMARY KEY (`packages_cancellation_policies_id`);

--
-- Indexes for table `packages_exclusions`
--
ALTER TABLE `packages_exclusions`
  ADD PRIMARY KEY (`packages_exclusions_id`);

--
-- Indexes for table `packages_inclusions`
--
ALTER TABLE `packages_inclusions`
  ADD PRIMARY KEY (`packages_inclusions_id`);

--
-- Indexes for table `packages_itinerary`
--
ALTER TABLE `packages_itinerary`
  ADD PRIMARY KEY (`packages_itinerary_id`);

--
-- Indexes for table `packages_itinerary_days`
--
ALTER TABLE `packages_itinerary_days`
  ADD PRIMARY KEY (`packages_itinerary_days_id`);

--
-- Indexes for table `packages_notes`
--
ALTER TABLE `packages_notes`
  ADD PRIMARY KEY (`packages_notes_id`);

--
-- Indexes for table `packages_optional_add_on`
--
ALTER TABLE `packages_optional_add_on`
  ADD PRIMARY KEY (`packages_optional_add_on_id`);

--
-- Indexes for table `packages_payment_policies`
--
ALTER TABLE `packages_payment_policies`
  ADD PRIMARY KEY (`packages_payment_policies_id`);

--
-- Indexes for table `packages_properties`
--
ALTER TABLE `packages_properties`
  ADD PRIMARY KEY (`packages_properties_id`);

--
-- Indexes for table `packages_properties_common`
--
ALTER TABLE `packages_properties_common`
  ADD PRIMARY KEY (`packages_properties_common_id`);

--
-- Indexes for table `packages_properties_days`
--
ALTER TABLE `packages_properties_days`
  ADD PRIMARY KEY (`packages_properties_days_id`);

--
-- Indexes for table `packages_properties_rooms`
--
ALTER TABLE `packages_properties_rooms`
  ADD PRIMARY KEY (`packages_properties_rooms_id`);

--
-- Indexes for table `packages_special_requirements`
--
ALTER TABLE `packages_special_requirements`
  ADD PRIMARY KEY (`packages_special_requirements_id`);

--
-- Indexes for table `packages_terms_condition`
--
ALTER TABLE `packages_terms_condition`
  ADD PRIMARY KEY (`packages_terms_condition_id`);

--
-- Indexes for table `package_category`
--
ALTER TABLE `package_category`
  ADD PRIMARY KEY (`package_category_id`);

--
-- Indexes for table `payment_policies`
--
ALTER TABLE `payment_policies`
  ADD PRIMARY KEY (`payment_policies_id`);

--
-- Indexes for table `payment_policies_items`
--
ALTER TABLE `payment_policies_items`
  ADD PRIMARY KEY (`payment_policies_items_id`);

--
-- Indexes for table `priority_status`
--
ALTER TABLE `priority_status`
  ADD PRIMARY KEY (`priority_status_id`);

--
-- Indexes for table `properties`
--
ALTER TABLE `properties`
  ADD PRIMARY KEY (`properties_id`);

--
-- Indexes for table `properties_room_category`
--
ALTER TABLE `properties_room_category`
  ADD PRIMARY KEY (`properties_room_category_id`);

--
-- Indexes for table `property_category`
--
ALTER TABLE `property_category`
  ADD PRIMARY KEY (`property_category_id`);

--
-- Indexes for table `property_inclusions`
--
ALTER TABLE `property_inclusions`
  ADD PRIMARY KEY (`property_inclusions_id`);

--
-- Indexes for table `quotation`
--
ALTER TABLE `quotation`
  ADD PRIMARY KEY (`quotation_id`);

--
-- Indexes for table `quotation_cancellation_policies`
--
ALTER TABLE `quotation_cancellation_policies`
  ADD PRIMARY KEY (`quotation_cancellation_policies_id`);

--
-- Indexes for table `quotation_exclusion`
--
ALTER TABLE `quotation_exclusion`
  ADD PRIMARY KEY (`quotation_exclusion_id`);

--
-- Indexes for table `quotation_inclusions`
--
ALTER TABLE `quotation_inclusions`
  ADD PRIMARY KEY (`quotation_inclusions`);

--
-- Indexes for table `quotation_itinerary`
--
ALTER TABLE `quotation_itinerary`
  ADD PRIMARY KEY (`quotation_itinerary_id`);

--
-- Indexes for table `quotation_itinerary_days`
--
ALTER TABLE `quotation_itinerary_days`
  ADD PRIMARY KEY (`quotation_itinerary_days_id`);

--
-- Indexes for table `quotation_notes`
--
ALTER TABLE `quotation_notes`
  ADD PRIMARY KEY (`quotation_notes_id`);

--
-- Indexes for table `quotation_optional_add_on`
--
ALTER TABLE `quotation_optional_add_on`
  ADD PRIMARY KEY (`quotation_optional_add_on_id`);

--
-- Indexes for table `quotation_options`
--
ALTER TABLE `quotation_options`
  ADD PRIMARY KEY (`quotation_options_id`);

--
-- Indexes for table `quotation_payment_policies`
--
ALTER TABLE `quotation_payment_policies`
  ADD PRIMARY KEY (`quotation_payment_policies_id`);

--
-- Indexes for table `quotation_properties`
--
ALTER TABLE `quotation_properties`
  ADD PRIMARY KEY (`quotation_properties_id`);

--
-- Indexes for table `quotation_properties_days`
--
ALTER TABLE `quotation_properties_days`
  ADD PRIMARY KEY (`quotation_properties_days_id`);

--
-- Indexes for table `quotation_properties_rooms`
--
ALTER TABLE `quotation_properties_rooms`
  ADD PRIMARY KEY (`quotation_properties_rooms_id`);

--
-- Indexes for table `quotation_property_inclusions`
--
ALTER TABLE `quotation_property_inclusions`
  ADD PRIMARY KEY (`quotation_property_inclusions_id`);

--
-- Indexes for table `quotation_room_tariff_details`
--
ALTER TABLE `quotation_room_tariff_details`
  ADD PRIMARY KEY (`quotation_room_tariff_details_id`);

--
-- Indexes for table `quotation_special_requirements`
--
ALTER TABLE `quotation_special_requirements`
  ADD PRIMARY KEY (`quotation_special_requirements_id`);

--
-- Indexes for table `quotation_terms_condition`
--
ALTER TABLE `quotation_terms_condition`
  ADD PRIMARY KEY (`quotation_terms_condition_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`roles_id`);

--
-- Indexes for table `roles_privilege`
--
ALTER TABLE `roles_privilege`
  ADD PRIMARY KEY (`roles_privilege_id`);

--
-- Indexes for table `room_tariff_hike`
--
ALTER TABLE `room_tariff_hike`
  ADD PRIMARY KEY (`room_tariff_hike_id`);

--
-- Indexes for table `room_tariff_hike_rate`
--
ALTER TABLE `room_tariff_hike_rate`
  ADD PRIMARY KEY (`room_tariff_hike_rate_id`);

--
-- Indexes for table `room_tariff_week_days_rate`
--
ALTER TABLE `room_tariff_week_days_rate`
  ADD PRIMARY KEY (`room_tariff_week_days_rate_id`);

--
-- Indexes for table `shift`
--
ALTER TABLE `shift`
  ADD PRIMARY KEY (`shift_id`);

--
-- Indexes for table `source`
--
ALTER TABLE `source`
  ADD PRIMARY KEY (`source_id`);

--
-- Indexes for table `special_requirements`
--
ALTER TABLE `special_requirements`
  ADD PRIMARY KEY (`special_requirements_id`);

--
-- Indexes for table `staff_order_assign`
--
ALTER TABLE `staff_order_assign`
  ADD PRIMARY KEY (`staff_order_assign_id`);

--
-- Indexes for table `staff_order_assign_details`
--
ALTER TABLE `staff_order_assign_details`
  ADD PRIMARY KEY (`staff_order_assign_details_id`);

--
-- Indexes for table `stages`
--
ALTER TABLE `stages`
  ADD PRIMARY KEY (`stages_id`);

--
-- Indexes for table `stage_flow`
--
ALTER TABLE `stage_flow`
  ADD PRIMARY KEY (`stage_flow_id`);

--
-- Indexes for table `state`
--
ALTER TABLE `state`
  ADD PRIMARY KEY (`state_id`);

--
-- Indexes for table `status_flow`
--
ALTER TABLE `status_flow`
  ADD PRIMARY KEY (`status_flow_id`);

--
-- Indexes for table `terms_condition`
--
ALTER TABLE `terms_condition`
  ADD PRIMARY KEY (`terms_condition_id`);

--
-- Indexes for table `terms_condition_items`
--
ALTER TABLE `terms_condition_items`
  ADD PRIMARY KEY (`terms_condition_items_id`);

--
-- Indexes for table `transporter`
--
ALTER TABLE `transporter`
  ADD PRIMARY KEY (`transporter_id`);

--
-- Indexes for table `transporter_vehicle`
--
ALTER TABLE `transporter_vehicle`
  ADD PRIMARY KEY (`transporter_vehicle_id`);

--
-- Indexes for table `trips`
--
ALTER TABLE `trips`
  ADD PRIMARY KEY (`trips_id`);

--
-- Indexes for table `tr_permissions`
--
ALTER TABLE `tr_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `fk_permissions_created_by` (`created_by`),
  ADD KEY `fk_permissions_updated_by` (`updated_by`);

--
-- Indexes for table `tr_roles`
--
ALTER TABLE `tr_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`),
  ADD KEY `created_by` (`created_by`),
  ADD KEY `updated_by` (`updated_by`);

--
-- Indexes for table `tr_role_permissions`
--
ALTER TABLE `tr_role_permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_role_permission` (`role_id`,`permission_id`),
  ADD KEY `permission_id` (`permission_id`),
  ADD KEY `assigned_by` (`assigned_by`);

--
-- Indexes for table `upload_tariff_document`
--
ALTER TABLE `upload_tariff_document`
  ADD PRIMARY KEY (`upload_tariff_document_id`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_privilege`
--
ALTER TABLE `user_privilege`
  ADD PRIMARY KEY (`user_privilege_id`);

--
-- Indexes for table `vehicle`
--
ALTER TABLE `vehicle`
  ADD PRIMARY KEY (`vehicle_id`);

--
-- Indexes for table `week_days`
--
ALTER TABLE `week_days`
  ADD PRIMARY KEY (`week_days_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `accommodation_plan`
--
ALTER TABLE `accommodation_plan`
  MODIFY `accommodation_plan_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `account_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1106;

--
-- AUTO_INCREMENT for table `b2b_partner`
--
ALTER TABLE `b2b_partner`
  MODIFY `b2b_partner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `cancellation_policies`
--
ALTER TABLE `cancellation_policies`
  MODIFY `cancellation_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `cancellation_policies_item`
--
ALTER TABLE `cancellation_policies_item`
  MODIFY `cancellation_policies_item_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `child_age_break_up`
--
ALTER TABLE `child_age_break_up`
  MODIFY `child_age_break_up_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=240;

--
-- AUTO_INCREMENT for table `designation`
--
ALTER TABLE `designation`
  MODIFY `designation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `district`
--
ALTER TABLE `district`
  MODIFY `district_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `exclusions`
--
ALTER TABLE `exclusions`
  MODIFY `exclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `guset_count`
--
ALTER TABLE `guset_count`
  MODIFY `guset_count_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guset_count_details`
--
ALTER TABLE `guset_count_details`
  MODIFY `guset_count_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `hike_room_tariff_hike`
--
ALTER TABLE `hike_room_tariff_hike`
  MODIFY `hike_room_tariff_hike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `hike_room_tariff_hike_rate`
--
ALTER TABLE `hike_room_tariff_hike_rate`
  MODIFY `hike_room_tariff_hike_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=68;

--
-- AUTO_INCREMENT for table `hike_room_tariff_week_days_rate`
--
ALTER TABLE `hike_room_tariff_week_days_rate`
  MODIFY `hike_room_tariff_week_days_rate_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `inclusions`
--
ALTER TABLE `inclusions`
  MODIFY `inclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `inclusion_exclusion_common`
--
ALTER TABLE `inclusion_exclusion_common`
  MODIFY `inclusion_exclusion_common_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itineraries`
--
ALTER TABLE `itineraries`
  MODIFY `itineraries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `itineraries_days`
--
ALTER TABLE `itineraries_days`
  MODIFY `itineraries_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `itinerary_category`
--
ALTER TABLE `itinerary_category`
  MODIFY `itinerary_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `leads_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `login_logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=330;

--
-- AUTO_INCREMENT for table `meal_plan`
--
ALTER TABLE `meal_plan`
  MODIFY `meal_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meta_ads_setting`
--
ALTER TABLE `meta_ads_setting`
  MODIFY `meta_ads_setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `meta_ads_setting_staff`
--
ALTER TABLE `meta_ads_setting_staff`
  MODIFY `meta_ads_setting_staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meta_lead_logs`
--
ALTER TABLE `meta_lead_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `packages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages_cancellation_policies`
--
ALTER TABLE `packages_cancellation_policies`
  MODIFY `packages_cancellation_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages_exclusions`
--
ALTER TABLE `packages_exclusions`
  MODIFY `packages_exclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `packages_inclusions`
--
ALTER TABLE `packages_inclusions`
  MODIFY `packages_inclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `packages_itinerary`
--
ALTER TABLE `packages_itinerary`
  MODIFY `packages_itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages_itinerary_days`
--
ALTER TABLE `packages_itinerary_days`
  MODIFY `packages_itinerary_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `packages_notes`
--
ALTER TABLE `packages_notes`
  MODIFY `packages_notes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages_optional_add_on`
--
ALTER TABLE `packages_optional_add_on`
  MODIFY `packages_optional_add_on_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages_payment_policies`
--
ALTER TABLE `packages_payment_policies`
  MODIFY `packages_payment_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `packages_properties`
--
ALTER TABLE `packages_properties`
  MODIFY `packages_properties_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `packages_properties_common`
--
ALTER TABLE `packages_properties_common`
  MODIFY `packages_properties_common_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `packages_properties_days`
--
ALTER TABLE `packages_properties_days`
  MODIFY `packages_properties_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `packages_properties_rooms`
--
ALTER TABLE `packages_properties_rooms`
  MODIFY `packages_properties_rooms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `packages_special_requirements`
--
ALTER TABLE `packages_special_requirements`
  MODIFY `packages_special_requirements_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages_terms_condition`
--
ALTER TABLE `packages_terms_condition`
  MODIFY `packages_terms_condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `package_category`
--
ALTER TABLE `package_category`
  MODIFY `package_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `payment_policies`
--
ALTER TABLE `payment_policies`
  MODIFY `payment_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_policies_items`
--
ALTER TABLE `payment_policies_items`
  MODIFY `payment_policies_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `priority_status`
--
ALTER TABLE `priority_status`
  MODIFY `priority_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `properties_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `properties_room_category`
--
ALTER TABLE `properties_room_category`
  MODIFY `properties_room_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `property_category`
--
ALTER TABLE `property_category`
  MODIFY `property_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `property_inclusions`
--
ALTER TABLE `property_inclusions`
  MODIFY `property_inclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_cancellation_policies`
--
ALTER TABLE `quotation_cancellation_policies`
  MODIFY `quotation_cancellation_policies_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_exclusion`
--
ALTER TABLE `quotation_exclusion`
  MODIFY `quotation_exclusion_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_inclusions`
--
ALTER TABLE `quotation_inclusions`
  MODIFY `quotation_inclusions` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_itinerary`
--
ALTER TABLE `quotation_itinerary`
  MODIFY `quotation_itinerary_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_itinerary_days`
--
ALTER TABLE `quotation_itinerary_days`
  MODIFY `quotation_itinerary_days_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_notes`
--
ALTER TABLE `quotation_notes`
  MODIFY `quotation_notes_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_optional_add_on`
--
ALTER TABLE `quotation_optional_add_on`
  MODIFY `quotation_optional_add_on_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_options`
--
ALTER TABLE `quotation_options`
  MODIFY `quotation_options_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_payment_policies`
--
ALTER TABLE `quotation_payment_policies`
  MODIFY `quotation_payment_policies_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_properties`
--
ALTER TABLE `quotation_properties`
  MODIFY `quotation_properties_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_properties_days`
--
ALTER TABLE `quotation_properties_days`
  MODIFY `quotation_properties_days_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_properties_rooms`
--
ALTER TABLE `quotation_properties_rooms`
  MODIFY `quotation_properties_rooms_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_property_inclusions`
--
ALTER TABLE `quotation_property_inclusions`
  MODIFY `quotation_property_inclusions_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_room_tariff_details`
--
ALTER TABLE `quotation_room_tariff_details`
  MODIFY `quotation_room_tariff_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_special_requirements`
--
ALTER TABLE `quotation_special_requirements`
  MODIFY `quotation_special_requirements_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `quotation_terms_condition`
--
ALTER TABLE `quotation_terms_condition`
  MODIFY `quotation_terms_condition_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `roles_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles_privilege`
--
ALTER TABLE `roles_privilege`
  MODIFY `roles_privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `room_tariff_hike`
--
ALTER TABLE `room_tariff_hike`
  MODIFY `room_tariff_hike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=93;

--
-- AUTO_INCREMENT for table `room_tariff_hike_rate`
--
ALTER TABLE `room_tariff_hike_rate`
  MODIFY `room_tariff_hike_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=298;

--
-- AUTO_INCREMENT for table `room_tariff_week_days_rate`
--
ALTER TABLE `room_tariff_week_days_rate`
  MODIFY `room_tariff_week_days_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `shift`
--
ALTER TABLE `shift`
  MODIFY `shift_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `source_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `special_requirements`
--
ALTER TABLE `special_requirements`
  MODIFY `special_requirements_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `staff_order_assign`
--
ALTER TABLE `staff_order_assign`
  MODIFY `staff_order_assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `staff_order_assign_details`
--
ALTER TABLE `staff_order_assign_details`
  MODIFY `staff_order_assign_details_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `stages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `stage_flow`
--
ALTER TABLE `stage_flow`
  MODIFY `stage_flow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `status_flow`
--
ALTER TABLE `status_flow`
  MODIFY `status_flow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `terms_condition`
--
ALTER TABLE `terms_condition`
  MODIFY `terms_condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `terms_condition_items`
--
ALTER TABLE `terms_condition_items`
  MODIFY `terms_condition_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `transporter`
--
ALTER TABLE `transporter`
  MODIFY `transporter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transporter_vehicle`
--
ALTER TABLE `transporter_vehicle`
  MODIFY `transporter_vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `trips`
--
ALTER TABLE `trips`
  MODIFY `trips_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tr_permissions`
--
ALTER TABLE `tr_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=110;

--
-- AUTO_INCREMENT for table `tr_roles`
--
ALTER TABLE `tr_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tr_role_permissions`
--
ALTER TABLE `tr_role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=187;

--
-- AUTO_INCREMENT for table `upload_tariff_document`
--
ALTER TABLE `upload_tariff_document`
  MODIFY `upload_tariff_document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `user_privilege`
--
ALTER TABLE `user_privilege`
  MODIFY `user_privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT for table `week_days`
--
ALTER TABLE `week_days`
  MODIFY `week_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tr_permissions`
--
ALTER TABLE `tr_permissions`
  ADD CONSTRAINT `fk_permissions_created_by` FOREIGN KEY (`created_by`) REFERENCES `user_details` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `fk_permissions_updated_by` FOREIGN KEY (`updated_by`) REFERENCES `user_details` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `tr_roles`
--
ALTER TABLE `tr_roles`
  ADD CONSTRAINT `tr_roles_ibfk_1` FOREIGN KEY (`created_by`) REFERENCES `user_details` (`user_id`) ON DELETE SET NULL,
  ADD CONSTRAINT `tr_roles_ibfk_2` FOREIGN KEY (`updated_by`) REFERENCES `user_details` (`user_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
