-- phpMyAdmin SQL Dump
-- version 4.9.7
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Apr 18, 2026 at 07:47 PM
-- Server version: 5.7.44
-- PHP Version: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `test_db`
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
  `property_day_id_fk` int(11) NOT NULL,
  `accommodation_date` date NOT NULL,
  `accommodation_day_name` varchar(255) NOT NULL,
  `stay_destination_id_fk` int(11) NOT NULL,
  `meal_plan_id_fk` int(11) NOT NULL,
  `accomodation_required_staus` varchar(200) NOT NULL,
  `accommodation_plan_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `accommodation_plan`
--

INSERT INTO `accommodation_plan` (`accommodation_plan_id`, `guset_count_details_id_fk`, `lead_id_fk`, `pacakage_id_fk`, `day_id_fk`, `property_day_id_fk`, `accommodation_date`, `accommodation_day_name`, `stay_destination_id_fk`, `meal_plan_id_fk`, `accomodation_required_staus`, `accommodation_plan_status`) VALUES
(1, 1, 1, 1, 28, 0, '2026-03-15', 'Sunday', 4, 1, 'R', 1),
(2, 1, 1, 1, 29, 0, '2026-03-16', 'Monday', 1, 1, 'R', 1),
(3, 2, 2, 5, 58, 64, '2026-04-01', 'Wednesday', 4, 1, 'R', 1),
(4, 2, 2, 5, 59, 0, '2026-04-02', 'Thursday', 1, 1, 'R', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(480, 2, 0, 0, 'Lead_registration', '', 'Added leads: snns', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-06', '2026-02-06 03:18:54', 1),
(481, 7, 0, 0, 'Staff_registration', '', 'Added staff: zsmsn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-06', '2026-02-06 04:47:55', 1),
(482, 5, 0, 0, 'Destination_registration', '', 'Added Destination: tets', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-07', '2026-02-07 12:59:04', 1),
(483, 5, 0, 0, 'Destination_registration', '', 'Edited Destination: tetseedd', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-07', '2026-02-07 12:59:13', 1),
(484, 5, 0, 0, 'Destination_registration', '', 'Deleted Destination: tetseedd', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-07', '2026-02-07 12:59:17', 1),
(485, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Janath', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 12:15:27', 1),
(486, 6, 0, 0, 'Property_registration', '', 'Added property: sdds', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 02:08:39', 1),
(487, 6, 0, 0, 'Property_registration', '', 'Edited property: sddsxx', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:09:26', 1),
(488, 12, 0, 0, 'Room_category_registration', '', 'Added room category: newmm', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-08', '2026-02-08 02:10:12', 1),
(489, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmen', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:10:29', 1),
(490, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmen', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:12:47', 1),
(491, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmenqq', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:12:57', 1),
(492, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmenioqoq', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:13:07', 1),
(493, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmen', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:13:17', 1),
(494, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmen', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:13:29', 1),
(495, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmen', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:16:26', 1),
(496, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmen', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:17:27', 1),
(497, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmenjajjaja', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:17:49', 1),
(498, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmm', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:19:32', 1),
(499, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmm', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:19:59', 1),
(500, 12, 0, 0, 'Room_category_registration', '', 'Edited room category: newmmsss', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-08', '2026-02-08 02:23:48', 1),
(501, 5, 0, 0, 'Itinerary_registration', '', 'Added itinerary: new itinireary', '127.0.0.1', 'Add', 0, '', '2026-02-13', '2026-02-13 09:18:48', 1),
(502, 6, 0, 0, 'Itinerary_registration', '', 'Added itinerary: New my itimnj', '127.0.0.1', 'Add', 0, '', '2026-02-13', '2026-02-13 09:25:50', 1),
(503, 7, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: mnbb', '127.0.0.1', 'Delete', 0, '', '2026-02-14', '2026-02-14 10:09:46', 1),
(504, 7, 0, 0, 'Itinerary_registration', '', 'Deleted itinerary: mnbb', '127.0.0.1', 'Delete', 0, '', '2026-02-14', '2026-02-14 10:13:49', 1),
(505, 2, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Majestic', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-14', '2026-02-14 01:18:42', 1),
(506, 3, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Test propery_Edited', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-14', '2026-02-14 01:45:49', 1),
(507, 4, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Trret', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-14', '2026-02-14 01:58:51', 1),
(508, 1, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Janath', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-14', '2026-02-14 08:25:45', 1),
(509, 2, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Majestic', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-14', '2026-02-14 08:45:25', 1),
(510, 3, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Majestic', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-14', '2026-02-14 08:48:28', 1),
(511, 4, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Majestic', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-14', '2026-02-14 08:52:18', 1),
(512, 5, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sddsxx', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-15', '2026-02-15 01:32:47', 1),
(513, 6, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sddsxx', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-15', '2026-02-15 01:36:02', 1),
(514, 7, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sddsxx', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-15', '2026-02-15 01:38:29', 1),
(515, 0, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-15', '2026-02-15 08:23:21', 1),
(516, 0, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-15', '2026-02-15 08:23:43', 1),
(517, 0, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-15', '2026-02-15 08:24:05', 1),
(518, 7, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-15', '2026-02-15 08:35:37', 1),
(519, 7, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: sddsxx', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-15', '2026-02-15 10:00:16', 1),
(520, 7, 0, 0, 'Property_registration', '', 'Added property: sss', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 07:53:14', 1),
(521, 8, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 09:14:51', 1),
(522, 9, 0, 0, 'Property_registration', '', 'Added property: najsj', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 09:18:30', 1),
(523, 9, 0, 0, 'Property_registration', '', 'Edited property: najsj', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 09:19:37', 1),
(524, 9, 0, 0, 'Property_registration', '', 'Edited property: najsj', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 09:30:00', 1),
(525, 10, 0, 0, 'Property_registration', '', 'Added property: kkalla', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 09:32:33', 1),
(526, 11, 0, 0, 'Property_registration', '', 'Added property: Nuiia', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 09:33:41', 1),
(527, 12, 0, 0, 'Property_registration', '', 'Added property: k mskks', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 09:38:29', 1),
(528, 13, 0, 0, 'Property_registration', '', 'Added property: nmmn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 09:45:23', 1),
(529, 14, 0, 0, 'Property_registration', '', 'Added property: Kamam', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 09:48:27', 1),
(530, 13, 0, 0, 'Property_registration', '', 'Edited property: nmmn', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 09:55:58', 1),
(531, 15, 0, 0, 'Property_registration', '', 'Added property: msms', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 10:14:13', 1),
(532, 16, 0, 0, 'Property_registration', '', 'Added property: ds', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 10:16:32', 1),
(533, 16, 0, 0, 'Property_registration', '', 'Edited property: ds', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 10:17:00', 1),
(534, 16, 0, 0, 'Property_registration', '', 'Edited property: ds', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 10:17:37', 1),
(535, 17, 0, 0, 'Property_registration', '', 'Added property: yqqu', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 10:18:41', 1),
(536, 17, 0, 0, 'Property_registration', '', 'Edited property: yqqu', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 10:19:16', 1),
(537, 17, 0, 0, 'Property_registration', '', 'Edited property: yqqu_edird', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 10:19:51', 1),
(538, 17, 0, 0, 'Property_registration', '', 'Edited property: yqqu_edird', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 10:20:06', 1),
(539, 17, 0, 0, 'Property_registration', '', 'Edited property: yqqu_edird', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 10:20:24', 1),
(540, 18, 0, 0, 'Property_registration', '', 'Added property: sd', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 10:34:08', 1),
(541, 19, 0, 0, 'Property_registration', '', 'Added property: jj', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-16', '2026-02-16 10:40:54', 1),
(542, 19, 0, 0, 'Property_registration', '', 'Edited property: jj', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-16', '2026-02-16 10:41:23', 1),
(543, 20, 0, 0, 'Property_registration', '', 'Added property: jsj', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 08:35:34', 1),
(544, 20, 0, 0, 'Property_registration', '', 'Edited property: jsj', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-17', '2026-02-17 09:07:56', 1),
(545, 21, 0, 0, 'Property_registration', '', 'Added property: shhs', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-17', '2026-02-17 09:10:00', 1),
(546, 21, 0, 0, 'Property_registration', '', 'Edited property: shhs', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-18', '2026-02-18 11:17:29', 1),
(547, 8, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Janath', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 11:57:34', 1),
(548, 8, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: Janath', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-18', '2026-02-18 11:58:30', 1),
(549, 5, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-10 to date 2026-02-26', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-18', '2026-02-18 11:59:00', 1),
(550, 5, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-10 to date 2026-02-26', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-18', '2026-02-18 11:59:18', 1),
(551, 6, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: --19 February, 2026 to date --28 February, 2026', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:41:01', 1),
(552, 7, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: --19 February, 2026 to date --28 February, 2026', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:41:21', 1),
(553, 8, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: --19 February, 2026 to date --28 February, 2026', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 07:41:29', 1),
(554, 13, 0, 0, 'Room_category_registration', '', 'Added room category: nbn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 08:40:56', 1),
(555, 9, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: shhs', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 08:41:36', 1),
(556, 10, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: shhs', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 08:42:32', 1),
(557, 11, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: shhs', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 08:43:08', 1),
(558, 22, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:42:59', 1),
(559, 23, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:43:42', 1),
(560, 24, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:44:03', 1),
(561, 25, 0, 0, 'Property_registration', '', 'Added property: snsn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:44:50', 1),
(562, 26, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:45:10', 1),
(563, 27, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:45:32', 1),
(564, 28, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:46:30', 1),
(565, 9, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-19 to date 2026-02-28', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:52:29', 1),
(566, 12, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: shhs', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 10:54:09', 1),
(567, 29, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:10:10', 1),
(568, 8, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-19 to date 2026-02-20', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 11:10:44', 1),
(569, 14, 0, 0, 'Room_category_registration', '', 'Added room category: nms', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:11:19', 1),
(570, 30, 0, 0, 'Property_registration', '', 'Added property: ', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:11:55', 1),
(571, 31, 0, 0, 'Property_registration', '', 'Added property: nns', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:14:51', 1),
(572, 32, 0, 0, 'Property_registration', '', 'Added property: hjnmn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 11:43:25', 1),
(573, 1, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: jjs', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 03:08:41', 1),
(574, 1, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: jjsed', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 03:10:05', 1),
(575, 1, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: jjsedDD', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 03:12:17', 1),
(576, 1, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: jjsedDD', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 03:13:00', 1),
(577, 1, 0, 0, 'Property_Inclusions_registration', '', 'Deleted property inclusion: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 03:15:43', 1),
(578, 1, 0, 0, 'Property_Inclusions_registration', '', 'Deleted property inclusion: jjsedDD', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 03:17:21', 1),
(579, 2, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: dnnm', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 03:19:31', 1),
(580, 1, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: jjsedDD', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 03:19:39', 1),
(581, 2, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: dnnms', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 03:22:30', 1),
(582, 2, 0, 0, 'Property_Inclusions_registration', '', 'Deleted property inclusion: dnnms', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 03:23:50', 1),
(583, 15, 0, 0, 'Room_category_registration', '', 'Added room category: nsm', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 03:25:26', 1),
(584, 15, 0, 0, 'Room_category_registration', '', 'Edited room category: nsm', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 03:26:17', 1),
(585, 15, 0, 0, 'Room_category_registration', '', 'Edited room category: nsm', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 03:26:30', 1),
(586, 10, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-19 to date 2026-02-27', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 03:26:47', 1),
(587, 10, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-19 to date 2026-02-27', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-19', '2026-02-19 03:26:58', 1),
(588, 10, 0, 0, 'Room_tariff_document_registration', '', 'Deleted room tariff from date: 2026-02-19 to date 2026-02-27', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 03:27:11', 1),
(589, 13, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: hjnmn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-19', '2026-02-19 03:27:35', 1),
(590, 13, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: hjnmn', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-19', '2026-02-19 03:28:12', 1),
(591, 16, 0, 0, 'Room_category_registration', '', 'Added room category: ajja', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-20', '2026-02-20 11:57:08', 1),
(592, 16, 0, 0, 'Room_category_registration', '', 'Edited room category: ajja', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-20', '2026-02-20 11:58:02', 1),
(593, 11, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-20 to date 2026-02-19', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-20', '2026-02-20 11:58:18', 1),
(594, 11, 0, 0, 'Room_tariff_document_registration', '', 'Edited room tariff from date: 2026-02-20 to date 2026-02-28', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-20', '2026-02-20 11:58:31', 1),
(595, 14, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Majestic', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-20', '2026-02-20 11:59:27', 1),
(596, 3, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: nan', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-20', '2026-02-20 12:00:05', 1),
(597, 3, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: nanedi', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-20', '2026-02-20 12:00:15', 1),
(598, 3, 0, 0, 'Property_Inclusions_registration', '', 'Deleted property inclusion: nanedi', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-20', '2026-02-20 12:00:20', 1),
(599, 15, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: hjnmn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-26', '2026-02-26 08:20:28', 1),
(600, 4, 0, 0, 'Room_tariff_registration', '', 'Deleted room tariff details of property: Majestic', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-26', '2026-02-26 11:31:44', 1),
(601, 3, 0, 0, 'Room_tariff_hike_registration', '', 'Deleted room tariff hike details of property: hjnmn', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-27', '2026-02-27 12:06:38', 1),
(602, 1, 0, 0, 'Room_tariff_hike_registration', '', 'Deleted room tariff hike details of property: hjnmn', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-27', '2026-02-27 12:10:25', 1),
(603, 2, 0, 0, 'Room_tariff_hike_registration', '', 'Deleted room tariff hike details of property: hjnmn', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-27', '2026-02-27 12:12:14', 1),
(604, 5, 0, 0, 'Room_tariff_hike_registration', '', 'Deleted room tariff hike details of property: hjnmn', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-27', '2026-02-27 12:13:14', 1),
(605, 12, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-12 to date 2026-02-27', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 03:12:08', 1),
(606, 13, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-18 to date 2026-02-12', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 03:12:40', 1),
(607, 14, 0, 0, 'Room_tariff_document_registration', '', 'Added room tariff from date: 2026-02-06 to date 2026-02-13', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 03:21:11', 1),
(608, 4, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: kk', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 03:29:18', 1),
(609, 4, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: kk', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-27', '2026-02-27 03:29:30', 1),
(610, 4, 0, 0, 'Property_Inclusions_registration', '', 'Deleted property inclusion: kk', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-02-27', '2026-02-27 03:29:48', 1),
(611, 5, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: kk', '127.0.0.1', 'Add', 1, 'Super admin', '2026-02-27', '2026-02-27 03:29:52', 1),
(612, 5, 0, 0, 'Property_Inclusions_registration', '', 'Edited property inclusion: kk', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-02-27', '2026-02-27 03:30:00', 1),
(613, 21, 0, 0, 'Itinerary_registration', '', 'Added itinerary: ds2', '127.0.0.1', 'Add', 0, '', '2026-02-27', '2026-02-27 11:37:06', 1),
(614, 8, 0, 0, 'Staff_registration', '', 'Added staff: ns', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-01', '2026-03-01 01:28:48', 1),
(615, 8, 0, 0, 'Staff_registration', '', 'Edited staff: ns', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-01', '2026-03-01 01:29:53', 1),
(616, 8, 0, 0, 'Staff_registration', '', 'Edited staff: ns', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-01', '2026-03-01 01:30:29', 1),
(617, 8, 0, 0, 'Staff_registration', '', 'Edited staff: ns', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-01', '2026-03-01 01:30:38', 1),
(618, 0, 0, 0, 'Package_registration', '', 'Deleted package: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-03-01', '2026-03-01 11:57:40', 1),
(619, 1, 0, 0, 'Package_registration', '', 'Deleted package: gadd', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-03-02', '2026-03-02 12:09:52', 1),
(620, 3, 0, 0, 'Lead_registration', '', 'Added leads: namma', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-06', '2026-03-06 10:28:01', 1),
(621, 22, 0, 0, 'Itinerary_registration', '', 'Added itinerary: mkk', '127.0.0.1', 'Add', 0, '', '2026-03-08', '2026-03-08 10:32:29', 1),
(622, 1, 0, 0, 'Package_registration', '', 'Deleted package: nnw', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-03-08', '2026-03-08 12:44:56', 1),
(623, 3, 0, 0, 'Inclusion_exclusion_registration', '', 'Added inclusions and exclusions with title: FOR KERALA - CP PLAN', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-09', '2026-03-09 10:25:41', 1),
(624, 5, 0, 0, 'Payment_policies_registration', '', 'Added payment policies: KERALA - PP - 30%', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-09', '2026-03-09 10:26:42', 1),
(625, 4, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: KERALA - PC', '127.0.0.1', 'Add', 0, '', '2026-03-09', '2026-03-09 10:27:56', 1),
(626, 3, 0, 0, 'Cancellation_policies_registration', '', 'Added cancellation and policies: KERALA - CP', '127.0.0.1', 'Add', 0, '', '2026-03-09', '2026-03-09 10:28:39', 1),
(627, 1, 0, 0, 'Lead_registration', '', 'Added leads: ss', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-10', '2026-03-10 10:05:13', 1),
(628, 2, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-2', '127.0.0.1', 'Add', 7, 'zsmsn', '2026-03-13', '2026-03-13 01:43:14', 1),
(629, 3, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-3', '127.0.0.1', 'Add', 7, 'zsmsn', '2026-03-13', '2026-03-13 01:48:37', 1),
(630, 3, 0, 0, 'Lead_registration', '', 'Edited B2C leads: mmnmmned', '127.0.0.1', 'Edit', 7, 'zsmsn', '2026-03-13', '2026-03-13 02:31:34', 1),
(631, 3, 0, 0, 'Lead_registration', '', 'Edited B2C leads: mmnmmned', '127.0.0.1', 'Edit', 7, 'zsmsn', '2026-03-13', '2026-03-13 02:36:42', 1),
(632, 3, 0, 0, 'Lead_registration', '', 'Edited B2C leads: mmnmmned', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 11:36:16', 1),
(633, 2, 0, 0, 'Lead_registration', '', 'Edited B2C leads: nbn', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 11:36:29', 1),
(634, 2, 0, 0, 'Lead_registration', '', 'Edited B2C leads: nbn', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 11:36:49', 1),
(635, 4, 0, 0, 'Lead_registration', '', 'Added B2B leads: Jaffarghg', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-13', '2026-03-13 12:50:58', 1),
(636, 5, 0, 0, 'Lead_registration', '', 'Added B2B leads: Jaffarghg', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-13', '2026-03-13 12:52:41', 1),
(637, 0, 0, 0, 'Lead_registration', '', 'Edited B2B leads: Nabeel', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 12:57:54', 1),
(638, 0, 0, 0, 'Lead_registration', '', 'Edited B2B leads: Nabeel', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 12:59:41', 1),
(639, 0, 0, 0, 'Lead_registration', '', 'Edited B2B leads: Nabeel', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 01:00:49', 1),
(640, 0, 0, 0, 'Lead_registration', '', 'Edited B2B leads: Nabeel', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 01:01:08', 1),
(641, 0, 0, 0, 'Lead_registration', '', 'Edited B2B leads: Nabeel', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 01:02:44', 1),
(642, 5, 0, 0, 'Lead_registration', '', 'Edited B2B leads: Nabeel', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-03-13', '2026-03-13 01:04:17', 1),
(643, 6, 0, 0, 'Lead_registration', '', 'Added B2B leads: New agent_edited', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-13', '2026-03-13 01:04:43', 1),
(644, 3, 0, 0, 'Lead_registration', '', 'Deleted lead: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-03-13', '2026-03-13 03:49:44', 1),
(645, 2, 0, 0, 'Lead_registration', '', 'Deleted lead: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-03-13', '2026-03-13 03:49:53', 1),
(646, 6, 0, 0, 'Lead_registration', '', 'Deleted lead: ', '127.0.0.1', 'Delete', 1, 'Super admin', '2026-03-13', '2026-03-13 03:50:01', 1),
(647, 1, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-1', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-13', '2026-03-13 09:30:17', 1),
(648, 2, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-2', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-13', '2026-03-13 09:44:59', 1),
(649, 3, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-3', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-13', '2026-03-13 11:31:59', 1),
(650, 1, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-1', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-14', '2026-03-14 12:51:43', 1),
(651, 2, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-2', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-14', '2026-03-14 12:52:21', 1),
(652, 3, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-3', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-14', '2026-03-14 01:53:43', 1),
(653, 4, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-4', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-14', '2026-03-14 09:15:56', 1),
(654, 5, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-5', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-14', '2026-03-14 09:24:42', 1),
(655, 1, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-1', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-15', '2026-03-15 12:10:44', 1),
(656, 1, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', '127.0.0.1', 'Add', 0, '', '2026-03-15', '2026-03-15 01:15:11', 1),
(657, 1, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-1', '127.0.0.1', 'Add', 1, 'Super admin', '2026-03-15', '2026-03-15 01:45:34', 1),
(658, 2, 0, 0, 'Itinerary_registration', '', 'Added itinerary: Namma', '127.0.0.1', 'Add', 0, '', '2026-03-17', '2026-03-17 05:30:40', 1),
(659, 16, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: Trret', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-01', '2026-04-01 02:52:55', 1),
(660, 17, 0, 0, 'Room_tariff_registration', '', 'Added room tariff details of property: sds', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-01', '2026-04-01 02:53:49', 1),
(661, 2, 0, 0, 'Lead_registration', '', 'Added B2C leads: LD-2', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-01', '2026-04-01 02:56:57', 1),
(662, 3, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 5N6D - MUNNAR THEKKADY ALAPPEY VARKALA TRIVANDRUM', '127.0.0.1', 'Add', 0, '', '2026-04-04', '2026-04-04 12:14:35', 1),
(663, 5, 0, 0, 'Terms_condition_registration', '', 'Added terms and conditions: Kerala -pS', '127.0.0.1', 'Add', 0, '', '2026-04-06', '2026-04-06 07:04:34', 1),
(664, 6, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: Jaja', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-06', '2026-04-06 08:22:09', 1);
INSERT INTO `activity` (`activity_id`, `id_fk`, `activity_staff_id_fk`, `activity_company_id_fk`, `activity_type`, `activity_order_number`, `activity_description`, `activity_ip`, `activity_action`, `activity_by_userid`, `activity_by_username`, `activity_date`, `activity_date_time`, `activity_status`) VALUES
(665, 7, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: ksks', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-06', '2026-04-06 08:22:37', 1),
(666, 3, 0, 0, 'Special_requirements_registration', '', 'Added special requirement: dffd', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-07', '2026-04-07 06:20:50', 1),
(667, 8, 0, 0, 'Property_Inclusions_registration', '', 'Added property inclusion: mnnm', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-07', '2026-04-07 01:17:17', 1),
(668, 1, 0, 0, 'Meta_ads_setting_registration', '', 'Added meta ads setting: nsns', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-08', '2026-04-08 12:21:14', 1),
(669, 1, 0, 0, 'Meta_ads_setting_registration', '', 'Edited meta ads setting: nsnsss', '127.0.0.1', 'Edit', 1, 'Super admin', '2026-04-08', '2026-04-08 12:28:03', 1),
(670, 2, 0, 0, 'Meta_ads_setting_registration', '', 'Added meta ads setting:  s', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-08', '2026-04-08 12:33:55', 1),
(671, 3, 0, 0, 'Meta_ads_setting_registration', '', 'Added meta ads setting: nnsn', '127.0.0.1', 'Add', 1, 'Super admin', '2026-04-08', '2026-04-08 12:36:14', 1),
(672, 4, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 5N6D - MUNNAR THEKKADY ALAPPEY VARKALA TRIVANDRUM - Copy', '127.0.0.1', 'Add', 0, '', '2026-04-09', '2026-04-09 12:53:55', 1),
(673, 5, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN - duplicated', '127.0.0.1', 'Add', 0, '', '2026-04-09', '2026-04-09 12:57:02', 1),
(674, 6, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN - Copy', '127.0.0.1', 'Add', 0, '', '2026-04-09', '2026-04-09 12:59:40', 1),
(675, 7, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN - Copy', '127.0.0.1', 'Add', 0, '', '2026-04-09', '2026-04-09 01:46:45', 1),
(676, 8, 0, 0, 'Itinerary_registration', '', 'Added itinerary: sf', '127.0.0.1', 'Add', 0, '', '2026-04-09', '2026-04-09 02:04:58', 1),
(677, 9, 0, 0, 'Itinerary_registration', '', 'Added itinerary: sf', '127.0.0.1', 'Add', 0, '', '2026-04-09', '2026-04-09 02:05:57', 1),
(678, 10, 0, 0, 'Itinerary_registration', '', 'Added itinerary: 4N5D - MUNNAR THEKKADY ALAPPEY COCHIN - Copyd', '127.0.0.1', 'Add', 0, '', '2026-04-09', '2026-04-09 05:48:46', 1),
(679, 1, 0, 0, 'Permission_registration', '', 'Added Permission: ADD_PROPERTY', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-12', '2026-04-12 11:23:07', 1),
(680, 2, 0, 0, 'Permission_registration', '', 'Added Permission: update_property', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-12', '2026-04-12 11:33:55', 1),
(681, 1, 0, 0, 'Destination_registration', '', 'Edited Destination: ', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-13', '2026-04-13 06:45:31', 1),
(682, 1, 0, 0, 'Destination_registration', '', 'Edited Destination: ', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-13', '2026-04-13 06:46:39', 1),
(683, 1, 0, 0, 'Permission_registration', '', 'Updated Permission: ADD_PROPERTY_button', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-13', '2026-04-13 06:47:35', 1),
(684, 2, 0, 0, 'Permission_registration', '', 'Updated Permission: update_property', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-13', '2026-04-13 06:47:58', 1),
(685, 2, 0, 0, 'Permission_registration', '', 'Deleted Permission: update_property', '172.20.0.1', 'Delete', 1, 'Super admin', '2026-04-13', '2026-04-13 07:06:24', 1),
(686, 3, 0, 0, 'Permission_registration', '', 'Added Permission: LIST_PROPERTY', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-14', '2026-04-14 07:01:34', 1),
(687, 4, 0, 0, 'Permission_registration', '', 'Added Permission: LIST_STAFF_MANAGEMENT', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-14', '2026-04-14 07:01:58', 1),
(688, 5, 0, 0, 'Permission_registration', '', 'Added Permission: CREAT_ITINARY_CATEGORY', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-14', '2026-04-14 07:02:20', 1),
(689, 6, 0, 0, 'Permission_registration', '', 'Added Permission: CREATE_TEMPLATE_OPERATION_TEST_LENGTH', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-14', '2026-04-14 07:02:42', 1),
(690, 1, 0, 0, 'Role_registration', '', 'Added Role: HR ADMIN', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-14', '2026-04-14 09:25:15', 1),
(691, 1, 0, 0, 'Permission_registration', '', 'Updated Permission: ', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-16', '2026-04-16 08:54:37', 1),
(692, 1, 0, 0, 'Permission_registration', '', 'Updated Permission: ', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-16', '2026-04-16 08:55:00', 1),
(693, 1, 0, 0, 'Permission_registration', '', 'Updated Permission: ', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-16', '2026-04-16 08:57:20', 1),
(694, 1, 0, 0, 'Permission_registration', '', 'Updated Role: HR ADMIN', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-16', '2026-04-16 12:14:24', 1),
(695, 1, 0, 0, 'Permission_registration', '', 'Updated Role: HR ADMIN test', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-16', '2026-04-16 12:17:05', 1),
(696, 1, 0, 0, 'Permission_registration', '', 'Updated Role: HR ADMIN test', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-16', '2026-04-16 12:17:55', 1),
(697, 2, 0, 0, 'Role_registration', '', 'Added Role: ADMIN', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-17', '2026-04-17 07:00:25', 1),
(698, 1, 0, 0, 'Permission_registration', '', 'Updated Role: HR ADMIN test', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-17', '2026-04-17 07:01:06', 1),
(699, 3, 0, 0, 'Role_registration', '', 'Added Role: Operational staff', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-17', '2026-04-17 07:05:13', 1),
(700, 4, 0, 0, 'Role_registration', '', 'Added Role: Payroll admin', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-17', '2026-04-17 07:06:34', 1),
(701, 1, 0, 0, 'Permission_registration', '', 'Updated Role: HR ADMIN test', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-17', '2026-04-17 07:06:45', 1),
(702, 1, 0, 0, 'Permission_registration', '', 'Updated Role: HR ADMIN test', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-17', '2026-04-17 07:06:54', 1),
(703, 5, 0, 0, 'Role_registration', '', 'Added Role: test', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-17', '2026-04-17 07:31:47', 1),
(704, 6, 0, 0, 'Role_registration', '', 'Added Role: fsre', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-17', '2026-04-17 07:35:56', 1),
(705, 6, 0, 0, 'Permission_registration', '', 'Updated Role: fsre', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-17', '2026-04-17 07:36:17', 1),
(706, 6, 0, 0, 'Role_registration', '', 'Deleted Role: ', '172.20.0.1', 'Delete', 1, 'Super admin', '2026-04-17', '2026-04-17 08:44:06', 1),
(707, 6, 0, 0, 'Role_registration', '', 'Deleted Role: ', '172.20.0.1', 'Delete', 1, 'Super admin', '2026-04-17', '2026-04-17 08:47:24', 1),
(708, 5, 0, 0, 'Role_registration', '', 'Deleted Role: ', '172.20.0.1', 'Delete', 1, 'Super admin', '2026-04-17', '2026-04-17 08:50:33', 1),
(709, 3, 0, 0, 'Staff_registration', '', 'Edited staff: Monisha Pramod', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-18', '2026-04-18 07:07:36', 1),
(710, 9, 0, 0, 'Staff_registration', '', 'Added staff: Shalis', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-18', '2026-04-18 07:09:31', 1),
(711, 1, 0, 0, 'Permission_registration', '', 'Added Permission: STAFF_MANAGEMENT', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-18', '2026-04-18 12:23:42', 1),
(712, 2, 0, 0, 'Permission_registration', '', 'Added Permission: PROPERTY_MANAGEMENT', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-18', '2026-04-18 12:24:28', 1),
(713, 1, 0, 0, 'Role_registration', '', 'Added Role: staff', '172.20.0.1', 'Add', 1, 'Super admin', '2026-04-19', '2026-04-19 12:24:15', 1),
(714, 9, 0, 0, 'Staff_registration', '', 'Edited staff: Shalis', '172.20.0.1', 'Edit', 1, 'Super admin', '2026-04-19', '2026-04-19 12:48:45', 1),
(715, 1, 0, 0, 'Permission_registration', '', 'Updated Role: staff', '172.20.0.1', 'Edit', 9, 'Shalis', '2026-04-19', '2026-04-19 12:56:20', 1),
(716, 1, 0, 0, 'Permission_registration', '', 'Updated Role: staff', '172.20.0.1', 'Edit', 9, 'Shalis', '2026-04-19', '2026-04-19 12:56:30', 1),
(717, 1, 0, 0, 'Permission_registration', '', 'Updated Role: staff', '172.20.0.1', 'Edit', 9, 'Shalis', '2026-04-19', '2026-04-19 01:00:46', 1),
(718, 6, 0, 0, 'Destination_registration', '', 'Added Destination: test', '172.20.0.1', 'Add', 9, 'Shalis', '2026-04-19', '2026-04-19 01:02:59', 1),
(719, 1, 0, 0, 'Permission_registration', '', 'Updated Role: staff', '172.20.0.1', 'Edit', 9, 'Shalis', '2026-04-19', '2026-04-19 01:05:53', 1),
(720, 1, 0, 0, 'Permission_registration', '', 'Updated Role: staff', '172.20.0.1', 'Edit', 9, 'Shalis', '2026-04-19', '2026-04-19 01:10:17', 1),
(721, 1, 0, 0, 'Permission_registration', '', 'Updated Role: staff', '172.20.0.1', 'Edit', 9, 'Shalis', '2026-04-19', '2026-04-19 01:10:49', 1),
(722, 1, 0, 0, 'Permission_registration', '', 'Updated Role: staff', '172.20.0.1', 'Edit', 9, 'Shalis', '2026-04-19', '2026-04-19 01:16:34', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `b2b_partner`
--

INSERT INTO `b2b_partner` (`b2b_partner_id`, `b2b_partner_agent_name`, `b2b_partner_address`, `b2b_partner_country_id_fk`, `b2b_partner_location_id_fk`, `b2b_partner_person_name`, `b2b_partner_contact_number`, `b2b_partner_email_address`, `b2b_partner_description`, `b2b_partner_createdby_user_id`, `b2b_partner_createdby_user_name`, `b2b_partner_created_date`, `b2b_partner_created_time`, `b2b_partner_status`) VALUES
(1, 'Dahgg', 'hghg', 99, 4, 'gf', 'gfgf', 'fgfg', 'fg', 0, '', '2025-07-22', '02:23:42', 0),
(2, 'Jaffarghg', 'hfg', 99, 4, 'Gafoor', '433400', 's@sr', 'hg', 0, '', '2025-07-22', '08:15:09', 0),
(3, 'Nabeel', 'Ena', 0, 0, '', '', '', '', 1, 'Super admin', '2026-01-24', '08:28:27', 1),
(4, 'New agent_edited', 'jjj_edited', 12, 1, 'jamal_edited', '199119099', 'sh_edited@gmail.com', '_edited', 1, 'Super admin', '2026-01-25', '02:52:59', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `cancellation_policies`
--

INSERT INTO `cancellation_policies` (`cancellation_policies_id`, `cancellation_policies_name`, `cancellation_policies_createdby_user_id`, `cancellation_policies_createdby_user_name`, `cancellation_policies_created_date`, `cancellation_policies_created_time`, `cancellation_policies_status`) VALUES
(1, 'hffh_edir', 1, 'Super admin', '0000-00-00', '00:00:00', 1),
(2, 'nana', 1, 'Super admin', '2026-01-25', '04:47:44', 1),
(3, 'KERALA - CP', 1, 'Super admin', '2026-03-09', '10:28:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_policies_item`
--

CREATE TABLE `cancellation_policies_item` (
  `cancellation_policies_item_id` int(11) NOT NULL,
  `cancellation_policies_id_fk` int(11) NOT NULL,
  `cancellation_policies_item_name` text NOT NULL,
  `cancellation_policies_item_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `child_age_break_up`
--

INSERT INTO `child_age_break_up` (`child_age_break_up_id`, `guset_count_details_id_fk`, `age`, `count`, `child_age_break_up_status`) VALUES
(1, 1, 1, 1, 1),
(2, 2, 1, 2, 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `designation_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `designation`
--

INSERT INTO `designation` (`designation_id`, `designation_name`, `designation_description`, `designation_status`) VALUES
(1, 'Office staff', '', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guset_count`
--

INSERT INTO `guset_count` (`guset_count_id`, `guset_count_lead_id_fk`, `guset_count_package_id_fk`, `guset_count_type`, `guset_count_total`, `guset_count_created_by_userid`, `guset_count_created_by_username`, `guset_count_created_date`, `guset_count_created_time`, `guset_count_status`) VALUES
(1, 1, 1, 'S', 3, 1, 'Super admin', '2026-03-15', '01:45:48', 1),
(2, 2, 5, 'S', 3, 1, 'Super admin', '2026-04-01', '02:57:09', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guset_count_details`
--

INSERT INTO `guset_count_details` (`guset_count_details_id`, `guset_count_id_fk`, `guset_count_details_type`, `pax_count_plan`, `adults`, `children`, `total_count`, `guset_count_details_status`) VALUES
(1, 1, 'S', 'Plan 1', 2, 1, 3, 1),
(2, 2, 'S', 'Plan 1', 1, 2, 3, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hike_room_tariff_hike`
--

INSERT INTO `hike_room_tariff_hike` (`hike_room_tariff_hike_id`, `room_tariff_hike_id_fk`, `hike_properties_id_fk`, `hike_room_tariff_hike_from_date`, `hike_room_tariff_hike_to_date`, `hike_room_tariff_hike_breakfast_rate_adult`, `hike_room_tariff_hike_breakfast_rate_child`, `hike_room_tariff_hike_lunch_rate_adult`, `hike_room_tariff_hike_lunch_rate_child`, `hike_room_tariff_hike_dinner_rate_adult`, `hike_room_tariff_hike_dinner_rate_child`, `hike_room_tariff_hike_description`, `hike_room_tariff_hike_createdby_user_id`, `hike_room_tariff_hike_createdby_user_name`, `hike_room_tariff_hike_created_date`, `hike_room_tariff_hike_created_time`, `hike_room_tariff_hike_status`) VALUES
(1, 15, 32, '2026-02-03', '2026-02-10', 2, 2, 2, 2, 2, 2, 's', 1, 'Super admin', '2026-02-26', '03:54:25', 0),
(2, 15, 32, '2026-02-16', '2026-02-17', 390, 99, 99, 29, 99, 299, 'eds', 1, 'Super admin', '2026-02-26', '12:45:19', 0),
(3, 15, 32, '2026-02-20', '2026-02-21', 2, 88, 8, 8, 8, 8, 'ds', 1, 'Super admin', '2026-02-26', '14:10:19', 0),
(4, 15, 32, '2026-02-11', '2026-02-15', 8, 8, 88, 8, 8, 8, '8', 1, 'Super admin', '2026-02-26', '14:13:31', 0),
(5, 15, 32, '2026-02-19', '2026-02-19', 40, 20, 30, 30, 30, 50, 'f0', 1, 'Super admin', '2026-02-26', '17:37:27', 0),
(6, 15, 32, '2026-02-11', '2026-02-13', 6, 6, 6, 6, 6, 6, 's', 1, 'Super admin', '2026-02-26', '20:00:45', 1),
(7, 15, 32, '2026-02-14', '2026-02-15', 8, 8, 8, 8, 8, 8, '8', 1, 'Super admin', '2026-02-27', '10:19:29', 1),
(8, 15, 32, '2026-02-16', '2026-02-17', 8, 8, 8, 8, 8, 8, 'b', 1, 'Super admin', '2026-02-27', '10:33:41', 1),
(9, 15, 32, '2026-02-21', '2026-02-21', 9, 9, 9, 9, 9, 9, '9', 1, 'Super admin', '2026-02-27', '10:34:44', 1),
(10, 15, 32, '2026-02-23', '2026-02-23', 9, 9, 9, 99, 9, 9, '', 1, 'Super admin', '2026-02-27', '10:35:14', 1),
(11, 15, 32, '2026-02-03', '2026-02-04', 90, 90, 90, 990, 90, 90, '', 1, 'Super admin', '2026-03-03', '17:51:19', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hike_room_tariff_hike_rate`
--

INSERT INTO `hike_room_tariff_hike_rate` (`hike_room_tariff_hike_rate_id`, `hike_room_tariff_hike_id_fk`, `hike_room_id_fk`, `hike_room_tariff_hike_rate_room_rate`, `hike_room_tariff_hike_rate_adult_with_extra_bed`, `hike_room_tariff_hike_rate_child_with_extra_bed`, `hike_room_tariff_hike_rate_child_sharing_bed`, `hike_room_tariff_hike_rate_single_occupancy`, `hike_room_tariff_hike_rate_some_days_type`, `hike_room_tariff_hike_rate_status`) VALUES
(1, 1, 15, 3, 3, 3, 3, 3, 'Y', 0),
(2, 2, 15, 28, 28, 28, 28, 28, 'Y', 0),
(3, 3, 15, 8, 9, 9, 9, 9, 'N', 0),
(4, 4, 15, 8, 8, 88, 8, 8, 'N', 0),
(5, 5, 15, 20, 30, 30, 40, 30, 'Y', 0),
(6, 6, 15, 7, 7, 7, 7, 7, 'Y', 1),
(7, 7, 15, 8, 8, 8, 8, 8, 'N', 1),
(8, 8, 15, 8, 8, 8, 8, 8, 'N', 1),
(9, 9, 15, 9, 9, 99, 9, 9, 'N', 1),
(10, 10, 15, 9, 9, 9, 9, 9, 'N', 1),
(11, 11, 15, 90, 9, 9, 90, 90, 'Y', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `hike_room_tariff_week_days_rate`
--

INSERT INTO `hike_room_tariff_week_days_rate` (`hike_room_tariff_week_days_rate_id`, `hike_room_tariff_hike_rate_id_fk`, `hike_week_days_room_id_fk`, `hike_week_days_id_fk`, `hike_room_tariff_week_days_rate_room_amount`, `hike_room_tariff_week_days_rate_adult_with_extra_bed`, `hike_room_tariff_week_days_rate_child_with_extra_bed`, `hike_room_tariff_week_days_rate_child_sharing_bed`, `hike_room_tariff_week_days_rate_single_occupancy`, `hike_room_tariff_week_days_rate_status`) VALUES
(1, 1, 15, 1, 2, 2, 2, 3, 3, 0),
(2, 2, 15, 1, 29, 29, 29, 29, 29, 0),
(3, 5, 15, 1, 60, 60, 60, 60, 60, 0),
(4, 5, 15, 2, 660, 660, 660, 660, 660, 0),
(5, 6, 15, 1, 7, 7, 7, 7, 7, 1),
(6, 6, 15, 2, 7, 7, 77, 7, 7, 1),
(7, 11, 15, 1, 89, 89, 89, 89, 89, 1);

-- --------------------------------------------------------

--
-- Table structure for table `inclusions`
--

CREATE TABLE `inclusions` (
  `inclusions_id` int(11) NOT NULL,
  `inclusion_exclusion_common_id_fk1` int(11) NOT NULL,
  `inclusions_details` text NOT NULL,
  `inclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `inclusion_exclusion_common`
--

INSERT INTO `inclusion_exclusion_common` (`inclusion_exclusion_common_id`, `inclusion_exclusion_common_title`, `inclusion_exclusion_common_createdby_user_id`, `inclusion_exclusion_common_createdby_user_name`, `inclusion_exclusion_common_created_date`, `inclusion_exclusion_common_created_time`, `inclusion_exclusion_common_status`) VALUES
(1, 'ghjjg', 1, 'Super admin', 2025, 9, 1),
(2, 'Gajd', 1, 'Super admin', 2026, 4, 1),
(3, 'FOR KERALA - CP PLAN', 1, 'Super admin', 2026, 10, 1);

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
  `cover_title_html` varchar(255) NOT NULL,
  `itineraries_createdby_user_id` int(11) NOT NULL,
  `itineraries_created_by_user_name` varchar(255) NOT NULL,
  `itineraries_created_date` date NOT NULL,
  `itineraries_created_time` time NOT NULL,
  `itineraries_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itineraries`
--

INSERT INTO `itineraries` (`itineraries_id`, `itineraries_category_id_fk`, `itineraries_name`, `itineraries_duration_nights`, `itineraries_description`, `itineraries_first_cover_page`, `itineraries_last_cover_page`, `cover_title_html`, `itineraries_createdby_user_id`, `itineraries_created_by_user_name`, `itineraries_created_date`, `itineraries_created_time`, `itineraries_status`) VALUES
(1, 2, '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', '2', 'dsjj', '1.jpg', '2.jpg', '', 1, 'Super admin', '2026-03-15', '01:15:11', 1),
(2, 2, 'Namma', '2', 'sd', '', '', '', 1, 'Super admin', '2026-03-17', '05:30:40', 1),
(3, 2, '5N6D - MUNNAR THEKKADY ALAPPEY VARKALA TRIVANDRUM', '5', 's', '1749716093684a8c7d42359.jpeg', 'pic7.jpg', 'ddd', 1, 'Super admin', '2026-04-04', '12:14:35', 1),
(4, 2, '5N6D - MUNNAR THEKKADY ALAPPEY VARKALA TRIVANDRUM - Copy', '5', 's', '1749716093684a8c7d42359.jpeg', 'pic7.jpg', '', 1, 'Super admin', '2026-04-09', '12:53:55', 1),
(5, 1, '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN - duplicated', '3', 'dsjjduplicated', '1.jpg', 'pic3.jpg', '', 1, 'Super admin', '2026-04-09', '12:57:02', 1),
(6, 2, '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN - Copy', '2', 'dsjj', '1.jpg', '2.jpg', '', 1, 'Super admin', '2026-04-09', '12:59:40', 1),
(7, 2, '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN - Copy', '2', 'dsjj', '1.jpg', '2.jpg', '', 1, 'Super admin', '2026-04-09', '01:46:45', 1),
(8, 1, 'sf', '1', 'df', 'b1f616032916842332544c13dc390ac5.jpg', 'ba91e7d8d425c5d089047469be63439c.jpg', '', 1, 'Super admin', '2026-04-09', '02:04:58', 1),
(9, 2, 'sf', '1', 'df', '0fc1ff6aa2e94813ca747770ca1f5eac.jpg', '43842ac86309dac80d65ecf5cfd799ad.jpg', '', 1, 'Super admin', '2026-04-09', '02:05:57', 1),
(10, 2, '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN - Copyd', '1', 'fd', '6f06168e69247d3e177eeb51701cbbe8.jpeg', 'f9eb40e9ac08b115e2337325fb409223.jpg', '', 1, 'Super admin', '2026-04-09', '05:48:46', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itineraries_days`
--

INSERT INTO `itineraries_days` (`itineraries_days_id`, `itineraries_id_fk`, `itineraries_days_day`, `itineraries_days_destination_id_fk`, `itineraries_days_title`, `itineraries_days_image`, `itineraries_days_description`, `itineraries_days_travel_back`, `itineraries_days_status`) VALUES
(1, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', '56e57c5acd99a1be4282dd154ece5ddf.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 1),
(2, 1, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'b644ec5c42d149af815db3e8a0f11a01.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 1),
(3, 1, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'd248cc77235495a45a9849246a28d386.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 1),
(4, 2, 'Day 1', 4, 'vdffd', '', '<p>dffd</p>', '', 1),
(5, 2, 'Day 2', 1, 'gffg', '', '<p>fdf</p>', '', 1),
(6, 2, 'Day 3', 1, 'fdf', '', '<p>fd</p>', 'TB', 1),
(7, 3, 'Day 1', 4, 'COCHIN TO MUNNAR', '69106e32bf95c30278941ac497c8d148.webp', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</p><p>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- <strong>Adventure Park</strong> (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 1),
(8, 3, 'Day 2', 1, 'MUNNAR SIGHTSEEING', '13b311ff986564247e7d47d5d9b9eb14.webp', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 1),
(9, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', '48e0ec7002f21844fe28c96f7e2a44dd.jpg', '<ul><li>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</li><li>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to spot wildlife like elephants, deer, and birds.</li><li>Experience a memorable <strong>Elephant encounter with rides, bathing, and feeding</strong></li><li>End the evening with mesmerizing cultural performances of <strong>Kathakali and Kerala’s traditional martial arts</strong></li><li>Overnight stay in the Hotel/ Resort.</li></ul>', '', 1),
(10, 3, 'Day 4', 1, 'THEKKADY TO ALAPPEY', '643aa1397558b6d242a9c0531031a55f.png', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East.</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerabl lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 1),
(11, 3, 'Day 5', 1, 'ALAPPEY TO VARKALA', 'd5e237fbcec49a213fd0432376fefd14.webp', '<ul><li>After breakfast, check-out from the Houseboat &amp; From the ‘Backwater Capital , today you will be driving to <strong>Varkala</strong>.</li><li>On the way, we will Drive to Chadayamangalam to explore the <strong>Jatayu earth Centre</strong>. The giant concrete statue of Jatayu is built on a mighty rock named Jatayupara (para means rock in Malayalam).</li><li>Reach Varkala, explore <strong>Varkala Cliff &amp; Beach, Black Sand Beach, Sri Janardhana Swami Temple, Kappil Beach.</strong></li><li>You can explore variety of <strong>water sports</strong> icluding Jet skiing, Parasailing, Banana boat rides and kayaking.</li><li>Overnight Stay at the resort/hotel in Varkala/Trivandrum</li></ul>', '', 1),
(12, 3, 'Day 6', 4, 'VARKALA TO TRIVANDRUM', '1aa4b936ec21c20ef071d7bd0e735a2f.jpeg', '<ul><li>Checkout from Resort &amp; Get ready to explore Trivandrum Visit to the iconic <strong>Sree Padmanabhaswamy Temple</strong>, one of the richest and most famous temples in India. (Men need to wear a dhoti and women a saree or a long skirt and blouse)</li><li>Visit the <strong>Napier Museum</strong>, which houses a vast collection of historical artifacts, bronze idols, ancient ornaments, and a temple chariot.</li><li>Explore the <strong>Trivandrum Zoo</strong>, one of the oldest zoos in India, located within the museum complex. It houses a wide variety of animals, birds, and reptiles in lush, green surroundings.</li><li>Local shopping &amp; Drop at Trivandrum Airport/ Railway</li></ul>', 'TB', 1),
(13, 4, 'Day 1', 4, 'COCHIN TO MUNNAR', '', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</p><p>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- <strong>Adventure Park</strong> (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 1),
(14, 4, 'Day 2', 1, 'MUNNAR SIGHTSEEING', '', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 1),
(15, 4, 'Day 3', 4, 'MUNNAR TO THEKKADY', '', '<ul><li>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</li><li>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to spot wildlife like elephants, deer, and birds.</li><li>Experience a memorable <strong>Elephant encounter with rides, bathing, and feeding</strong></li><li>End the evening with mesmerizing cultural performances of <strong>Kathakali and Kerala’s traditional martial arts</strong></li><li>Overnight stay in the Hotel/ Resort.</li></ul>', '', 1),
(16, 4, 'Day 4', 1, 'THEKKADY TO ALAPPEY', '', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East.</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerabl lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 1),
(17, 4, 'Day 5', 1, 'ALAPPEY TO VARKALA', '', '<ul><li>After breakfast, check-out from the Houseboat &amp; From the ‘Backwater Capital , today you will be driving to <strong>Varkala</strong>.</li><li>On the way, we will Drive to Chadayamangalam to explore the <strong>Jatayu earth Centre</strong>. The giant concrete statue of Jatayu is built on a mighty rock named Jatayupara (para means rock in Malayalam).</li><li>Reach Varkala, explore <strong>Varkala Cliff &amp; Beach, Black Sand Beach, Sri Janardhana Swami Temple, Kappil Beach.</strong></li><li>You can explore variety of <strong>water sports</strong> icluding Jet skiing, Parasailing, Banana boat rides and kayaking.</li><li>Overnight Stay at the resort/hotel in Varkala/Trivandrum</li></ul>', '', 1),
(18, 4, 'Day 6', 4, 'VARKALA TO TRIVANDRUM', '', '<ul><li>Checkout from Resort &amp; Get ready to explore Trivandrum Visit to the iconic <strong>Sree Padmanabhaswamy Temple</strong>, one of the richest and most famous temples in India. (Men need to wear a dhoti and women a saree or a long skirt and blouse)</li><li>Visit the <strong>Napier Museum</strong>, which houses a vast collection of historical artifacts, bronze idols, ancient ornaments, and a temple chariot.</li><li>Explore the <strong>Trivandrum Zoo</strong>, one of the oldest zoos in India, located within the museum complex. It houses a wide variety of animals, birds, and reptiles in lush, green surroundings.</li><li>Local shopping &amp; Drop at Trivandrum Airport/ Railway</li></ul>', 'TB', 1),
(19, 5, 'Day 1', 4, 'COCHIN TO MUNNAR', '', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 1),
(20, 5, 'Day 2', 1, 'MUNNAR SIGHTSEEING', '', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 1),
(21, 5, 'Day 3', 4, 'MUNNAR TO THEKKADY', '', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', '', 1),
(22, 5, 'Day 4', 1, 'mnnmmn', 'f33d874981bc9a4d42872bbef7c86d3c.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort</p>', 'TB', 1),
(23, 6, 'Day 1', 4, 'COCHIN TO MUNNAR', '', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 1),
(24, 6, 'Day 2', 1, 'MUNNAR SIGHTSEEING', '', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 1),
(25, 6, 'Day 3', 4, 'MUNNAR TO THEKKADY', '', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 1),
(26, 7, 'Day 1', 4, 'COCHIN TO MUNNAR', '', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 1),
(27, 7, 'Day 2', 1, 'MUNNAR SIGHTSEEING', '', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 1),
(28, 7, 'Day 3', 4, 'MUNNAR TO THEKKADY', '', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 1),
(29, 8, 'Day 1', 4, 'sd', 'f5e23e90d4ce83200e694aea5a4369f0.webp', '<p>ds</p>', '', 1),
(30, 8, 'Day 2', 1, 'sd', '2f19885657b0805d8c5e73e5dc237ec1.png', '<p>sd</p>', '', 1),
(31, 9, 'Day 1', 4, 'sd', '06b909f77cdb7a617cfda1003f0074dd.webp', '<p>dsss</p>', '', 1),
(32, 9, 'Day 2', 1, 'sd', '2e9992d05abccc801d3680f67b28b3b3.png', '<p>sdsss</p>', '', 1),
(33, 10, 'Day 1', 1, 'COCHIN TO MUNNAR', '223437956abfcbfd8e0d74f1c5378b9b.webp', '<h4>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</h4><h4>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</h4><h4>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</h4><h4>Overnight stay at the Hotel / Resort</h4>', '', 1),
(34, 10, 'Day 2', 4, 'MUNNAR SIGHTSEEING', '761d6071d67c231bbd0df1fea81af7fa.webp', '<h4>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</h4><h4>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</h4><h4>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</h4><h4>Overnight stay At Munnar</h4>', '', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `itinerary_category`
--

INSERT INTO `itinerary_category` (`itinerary_category_id`, `itinerary_category_name`, `itinerary_category_description`, `itinerary_category_createdby_user_id`, `itinerary_category_createdby_user_name`, `itinerary_category_created_date`, `itinerary_category_created_time`, `itinerary_category_status`) VALUES
(1, 'gghj', 'gjgjh', 1, 'Super admin', '2025-08-30', '10:11:11', 1),
(2, 'Nama_edited', 'wjjw_edited', 1, 'Super admin', '2026-01-25', '03:19:39', 1);

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
  `leads_accomodation_status` int(11) NOT NULL DEFAULT '0',
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
  `raw_meta_json` longtext
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leads`
--

INSERT INTO `leads` (`leads_id`, `staff_id_fk`, `source_id_fk`, `package_id_fk`, `country_id_fk`, `priority_status_id_fk`, `stage_id_fk`, `agent_id_fk`, `leads_number`, `lead_type`, `guest_name`, `lead_register_date`, `date_type`, `start_date`, `end_date`, `duration`, `whats_number`, `alternative_number`, `leads_email`, `leads_address`, `total_package_cost`, `expense`, `margin`, `lead_current_status`, `leads_accomodation_status`, `description`, `leads_created_date`, `leads_created_time`, `leads_createdby_userid`, `leads_createdby_username`, `leads_status`, `meta_leadgen_id`, `meta_page_id`, `meta_form_id`, `meta_ad_id`, `lead_source`, `raw_meta_json`) VALUES
(1, 3, 1, 1, 99, 1, 1, 0, 'LD-1', 'B2C', 'Gafoor', '2026-03-15', 'WITH', '2026-03-15', '2026-03-16', '2', '9191919191991', '', '', '', 0, 0, 0, 1, 2, 'ds', '2026-03-15', '01:45:34', 1, 'Super admin', 1, NULL, NULL, NULL, NULL, NULL, NULL),
(2, 3, 1, 5, 99, 1, 1, 0, 'LD-2', 'B2C', 'jkka', '2026-04-01', 'WITH', '2026-04-01', '2026-04-02', '2', '18818199191919', '', '', '', 0, 0, 0, 1, 2, 'cx', '2026-04-01', '02:56:57', 1, 'Super admin', 1, NULL, NULL, NULL, NULL, NULL, NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(100, 1, 'ee33c64634cbe883c1c9dd834364daa75b8253f2', 'A', 'Super admin', '2026-02-06', '2026-02-06 03:18:50', '0000-00-00 00:00:00', 1),
(101, 1, 'd0a5cc6381444d25a3d5e8a04abf04c21de9b0fb', 'A', 'Super admin', '2026-02-06', '2026-02-06 03:23:49', '0000-00-00 00:00:00', 1),
(102, 1, 'b68f8a015ac39359cc3669ee352c7d57cb2e32a4', 'A', 'Super admin', '2026-02-07', '2026-02-07 12:29:05', '0000-00-00 00:00:00', 1),
(103, 1, '40a870c95032fcb6ae576e171f677f2ce2d66a81', 'A', 'Super admin', '2026-02-08', '2026-02-08 12:15:22', '0000-00-00 00:00:00', 1),
(104, 1, '7b705ada60f00df8edcb8d828b4ae6c76fb82698', 'A', 'Super admin', '2026-02-08', '2026-02-08 10:15:23', '0000-00-00 00:00:00', 1),
(105, 1, '85aba980b464ab57c24a88d9aede69c8d609f869', 'A', 'Super admin', '2026-02-09', '2026-02-09 10:30:01', '0000-00-00 00:00:00', 1),
(106, 1, '7eeb9fb7192ae2e9070ac83a607cddcc7ba7638d', 'A', 'Super admin', '2026-02-12', '2026-02-12 08:50:02', '0000-00-00 00:00:00', 1),
(107, 1, 'fb84d32b257a53a1f259d6ea606ed57d9d4e0d9b', 'A', 'Super admin', '2026-02-13', '2026-02-13 09:03:50', '0000-00-00 00:00:00', 1),
(108, 1, '66236b2a47b9cdd72b75f6fd3072f5a86669b178', 'A', 'Super admin', '2026-02-14', '2026-02-14 01:24:41', '0000-00-00 00:00:00', 1),
(109, 1, '3f1242f56278fe43e0fb1ea3a1125f25555faa58', 'A', 'Super admin', '2026-02-14', '2026-02-14 01:18:37', '0000-00-00 00:00:00', 1),
(110, 1, '7e3fe76be88320c3ee1af06a024abe4b3e0f3b4b', 'A', 'Super admin', '2026-02-14', '2026-02-14 08:25:24', '0000-00-00 00:00:00', 1),
(111, 1, 'd1e935b894387bb1c5fa2cc7969bc1fb1cd97dd8', 'A', 'Super admin', '2026-02-15', '2026-02-15 10:18:01', '0000-00-00 00:00:00', 1),
(112, 1, '3a00342e66b56153d9cbd81a009444ec00210d2b', 'A', 'Super admin', '2026-02-15', '2026-02-15 01:32:42', '0000-00-00 00:00:00', 1),
(113, 1, 'be1088b146aff5661ebf8f1254ac770f4048750c', 'A', 'Super admin', '2026-02-15', '2026-02-15 08:23:18', '0000-00-00 00:00:00', 1),
(114, 1, '774185918dee2a0e634ed1afb647f8caf9467724', 'A', 'Super admin', '2026-02-16', '2026-02-16 08:27:06', '0000-00-00 00:00:00', 1),
(115, 1, '5d5902c87ecd30f99262bfc2087e0917c6a9ce58', 'A', 'Super admin', '2026-02-16', '2026-02-16 07:53:06', '0000-00-00 00:00:00', 1),
(116, 1, '95041931a5ab056f357d8953e85db14efa5e14bf', 'A', 'Super admin', '2026-02-17', '2026-02-17 07:17:34', '0000-00-00 00:00:00', 1),
(117, 1, '2f797b98cf67f16ef3a1fbcf14a7b835c068ef99', 'A', 'Super admin', '2026-02-17', '2026-02-17 08:16:05', '0000-00-00 00:00:00', 1),
(118, 1, 'a95799b7b0bd14826e27efeb836f63a28d58983f', 'A', 'Super admin', '2026-02-18', '2026-02-18 10:24:18', '0000-00-00 00:00:00', 1),
(119, 1, '142c0ff2eb88df7ab79795236aae222e5dc33657', 'A', 'Super admin', '2026-02-18', '2026-02-18 11:17:24', '0000-00-00 00:00:00', 1),
(120, 1, '0fc378bb29710e8728acdbe74332f550e45492c1', 'A', 'Super admin', '2026-02-19', '2026-02-19 07:05:07', '0000-00-00 00:00:00', 1),
(121, 1, '6bd1fa168ae1ce94ffb8cc54d7943c5067ea92ed', 'A', 'Super admin', '2026-02-19', '2026-02-19 07:41:16', '0000-00-00 00:00:00', 1),
(122, 1, '1a63a5b70b0acd91da4e7a60870de8cc752bb13f', 'A', 'Super admin', '2026-02-19', '2026-02-19 11:25:54', '0000-00-00 00:00:00', 1),
(123, 1, '5b8909ff36081428cfc4ed5e3009c1da191746e0', 'A', 'Super admin', '2026-02-19', '2026-02-19 03:08:33', '0000-00-00 00:00:00', 1),
(124, 1, '36c427ea7b5deceaabd125eea338deea08230253', 'A', 'Super admin', '2026-02-20', '2026-02-20 10:02:35', '2026-02-20 05:32:53', 1),
(125, 1, '8286ab53c3099439683a8b8574969639bebe697e', 'A', 'Super admin', '2026-02-20', '2026-02-20 11:12:32', '0000-00-00 00:00:00', 1),
(126, 1, '6110fee134e17af88ffb985e7439d34ffd29b604', 'A', 'Super admin', '2026-02-20', '2026-02-20 11:27:39', '2026-02-20 06:57:55', 1),
(127, 1, 'd416f9d4a7971bb191630610b7e2d0ade7406023', 'A', 'Super admin', '2026-02-20', '2026-02-20 11:32:01', '2026-02-20 07:02:26', 1),
(128, 1, 'd877e94e1fbb945d5bdc48265f7103870205a4e0', 'A', 'Super admin', '2026-02-20', '2026-02-20 11:46:58', '0000-00-00 00:00:00', 1),
(129, 1, 'd95c7bc7168b0ad39e9473944ce6cb1624e58942', 'A', 'Super admin', '2026-02-20', '2026-02-20 05:11:13', '0000-00-00 00:00:00', 1),
(130, 1, '2b659af4f4092e6d9c4e42a83f9cf68ac734744b', 'A', 'Super admin', '2026-02-20', '2026-02-20 09:15:32', '0000-00-00 00:00:00', 1),
(131, 1, '21b35ea619e419b0a2a76b79208b16c56198a946', 'A', 'Super admin', '2026-02-20', '2026-02-20 11:22:14', '0000-00-00 00:00:00', 1),
(132, 1, 'a738bb6dbee6baa2bf9874c6b7eed34a0049910e', 'A', 'Super admin', '2026-02-21', '2026-02-21 09:45:37', '0000-00-00 00:00:00', 1),
(133, 1, 'cf8a6f278532387750903a52c5e0efd9dfaeee38', 'A', 'Super admin', '2026-02-21', '2026-02-21 11:23:35', '0000-00-00 00:00:00', 1),
(134, 1, '82119d82856bce4f06e09c2ad56f98afc1b60319', 'A', 'Super admin', '2026-02-22', '2026-02-22 10:58:58', '0000-00-00 00:00:00', 1),
(135, 1, '3292830059d3c1bf1131befbd849ea09142d56db', 'A', 'Super admin', '2026-02-22', '2026-02-22 06:03:26', '0000-00-00 00:00:00', 1),
(136, 1, 'b4f4b051eea74c3e8ca009c351c356d4a8bcab3f', 'A', 'Super admin', '2026-02-22', '2026-02-22 09:18:19', '0000-00-00 00:00:00', 1),
(137, 1, '4c475b76073b8362e7546ea5fe1675a6c2fd9105', 'A', 'Super admin', '2026-02-22', '2026-02-22 10:28:20', '0000-00-00 00:00:00', 1),
(138, 1, '64108810f2c7b9823bf7d6c3f0a73bb38953396e', 'A', 'Super admin', '2026-02-23', '2026-02-23 06:26:38', '0000-00-00 00:00:00', 1),
(139, 1, 'b712b519c0e057325445c3cf3d6e938bced40479', 'A', 'Super admin', '2026-02-23', '2026-02-23 10:53:58', '0000-00-00 00:00:00', 1),
(140, 1, 'b99cb5c4cd47fec5670f12083f2dad0d9b66e716', 'A', 'Super admin', '2026-02-24', '2026-02-24 04:47:17', '0000-00-00 00:00:00', 1),
(141, 1, '007af7abe5601c06960ecfb4d3f22b8657defed7', 'A', 'Super admin', '2026-02-24', '2026-02-24 08:54:10', '0000-00-00 00:00:00', 1),
(142, 1, 'c45f739bbe9b16f6aedd3192e29b79fe4d7aa946', 'A', 'Super admin', '2026-02-25', '2026-02-25 06:02:55', '0000-00-00 00:00:00', 1),
(143, 1, '8dac4913cb5dd0876c45c38ee6d85e0f751021a0', 'A', 'Super admin', '2026-02-26', '2026-02-26 06:59:29', '0000-00-00 00:00:00', 1),
(144, 1, '199592f718327bff7ac96d5ca8f95262429876f2', 'A', 'Super admin', '2026-02-26', '2026-02-26 01:38:22', '0000-00-00 00:00:00', 1),
(145, 1, '03cefc98b66949daec8507b659f2a1cdcf498db2', 'A', 'Super admin', '2026-02-26', '2026-02-26 09:58:03', '0000-00-00 00:00:00', 1),
(146, 1, '2aebc335ff7fd36cd18d6d8dfddbad5bf2fa7c58', 'A', 'Super admin', '2026-02-26', '2026-02-26 10:58:15', '0000-00-00 00:00:00', 1),
(147, 1, '6109b4d0ed1441f509daea2bb7865ccd3891da35', 'A', 'Super admin', '2026-02-27', '2026-02-27 02:48:46', '0000-00-00 00:00:00', 1),
(148, 1, '76270391109dba6ab1ce7d84248a035ccdf63644', 'A', 'Super admin', '2026-02-27', '2026-02-27 09:07:32', '0000-00-00 00:00:00', 1),
(149, 1, '0cd1ce34d1f371ab1309023e442d5a83c4122b2e', 'A', 'Super admin', '2026-02-28', '2026-02-28 09:39:58', '0000-00-00 00:00:00', 1),
(150, 1, '3a8c7044ee0a06857c925707f71a364dcdbc1f96', 'A', 'Super admin', '2026-02-28', '2026-02-28 01:53:05', '0000-00-00 00:00:00', 1),
(151, 1, 'a0ac95b2986d9809cfafe32dff4f85447ce06fe6', 'A', 'Super admin', '2026-02-28', '2026-02-28 09:07:02', '0000-00-00 00:00:00', 1),
(152, 1, '03f7fe82d6b257263ede32240ed4b876f5562b6c', 'A', 'Super admin', '2026-03-01', '2026-03-01 08:09:38', '0000-00-00 00:00:00', 1),
(153, 1, '79831eeb02fd5428f35d23849df0bcc0999ae93e', 'A', 'Super admin', '2026-03-01', '2026-03-01 09:00:53', '0000-00-00 00:00:00', 1),
(154, 1, '4b23fc6df1852478e105663bfe452902cf8f07d5', 'A', 'Super admin', '2026-03-01', '2026-03-01 01:39:17', '2026-03-01 09:09:57', 1),
(155, 1, '20cc3e427360138e11fac7a5af2ac6510450d78e', 'A', 'Super admin', '2026-03-01', '2026-03-01 01:40:03', '0000-00-00 00:00:00', 1),
(156, 1, '30314f545834a90782493bca4690c518f689ec28', 'A', 'Super admin', '2026-03-01', '2026-03-01 04:08:24', '0000-00-00 00:00:00', 1),
(157, 1, '24807c310aca1188d34a1c5ae2b343d4032532c5', 'A', 'Super admin', '2026-03-01', '2026-03-01 09:27:07', '0000-00-00 00:00:00', 1),
(158, 1, '00af00a87ba79beb60fa02aaf7cd8dca3c97f9b7', 'A', 'Super admin', '2026-03-01', '2026-03-01 10:08:52', '0000-00-00 00:00:00', 1),
(159, 1, '1194f58a1114edb1c0c09e849b522d8b9874a27f', 'A', 'Super admin', '2026-03-01', '2026-03-01 10:17:53', '0000-00-00 00:00:00', 1),
(160, 1, 'a1fc6f835d9740f4f695bf9ec0e321f04d424de4', 'A', 'Super admin', '2026-03-02', '2026-03-02 09:39:24', '0000-00-00 00:00:00', 1),
(161, 1, '1db3438daaf4dea12bd692b22e376af956a4a335', 'A', 'Super admin', '2026-03-02', '2026-03-02 01:19:30', '0000-00-00 00:00:00', 1),
(162, 1, '24d79689b1f6d35c089ba47551bdafc99ac8b144', 'A', 'Super admin', '2026-03-02', '2026-03-02 01:58:13', '0000-00-00 00:00:00', 1),
(163, 1, '6682ef856001eba9aa1503f57a77e480742e10cf', 'A', 'Super admin', '2026-03-02', '2026-03-02 05:05:26', '0000-00-00 00:00:00', 1),
(164, 1, 'b2c8e609437a74602e2c2caab77093b488875382', 'A', 'Super admin', '2026-03-02', '2026-03-02 08:48:41', '0000-00-00 00:00:00', 1),
(165, 1, '3a71d1c52d62a0625d28500b884cb4bec6982169', 'A', 'Super admin', '2026-03-03', '2026-03-03 05:26:57', '0000-00-00 00:00:00', 1),
(166, 1, '4f285ce04b740ccee6c634b6480e751a82f62b43', 'A', 'Super admin', '2026-03-03', '2026-03-03 06:09:17', '0000-00-00 00:00:00', 1),
(167, 1, '699f3452be6c6c2c43a53f67e947e9d27734e6eb', 'A', 'Super admin', '2026-03-03', '2026-03-03 09:07:43', '0000-00-00 00:00:00', 1),
(168, 1, '52ed99ea5c90a59f45075ab276b4fe1824c28a25', 'A', 'Super admin', '2026-03-04', '2026-03-04 12:55:45', '0000-00-00 00:00:00', 1),
(169, 1, '712442a44a2a87c69b45864aaac28f6321392be1', 'A', 'Super admin', '2026-03-04', '2026-03-04 12:56:35', '0000-00-00 00:00:00', 1),
(170, 1, '8baa9150842b3cc8c07da61321bc5cb862d8680d', 'A', 'Super admin', '2026-03-04', '2026-03-04 03:18:06', '0000-00-00 00:00:00', 1),
(171, 1, '52cba27a6487c5a246289f6f2d754260b6bdea16', 'A', 'Super admin', '2026-03-04', '2026-03-04 03:25:45', '0000-00-00 00:00:00', 1),
(172, 1, '2888a715dfec4eda62941e3d76ccff6ba5f7f071', 'A', 'Super admin', '2026-03-05', '2026-03-05 02:53:56', '0000-00-00 00:00:00', 1),
(173, 1, '08a538d69c535c5b6335c122999b8fae7115e08a', 'A', 'Super admin', '2026-03-06', '2026-03-06 11:10:03', '0000-00-00 00:00:00', 1),
(174, 1, '144ded7a6dc062900876c3c85d6a1aff1d14e833', 'A', 'Super admin', '2026-03-06', '2026-03-06 06:35:15', '0000-00-00 00:00:00', 1),
(175, 1, '4cdc1a7cabcf19b5ccb3fe5e0637bd64f447d1d3', 'A', 'Super admin', '2026-03-06', '2026-03-06 09:14:51', '0000-00-00 00:00:00', 1),
(176, 1, 'fb2489df3adc591aea374ce78983cfeb61bed117', 'A', 'Super admin', '2026-03-07', '2026-03-07 11:18:37', '0000-00-00 00:00:00', 1),
(177, 1, '43eb3f0891c406f67af3f2dc030e7e585105a328', 'A', 'Super admin', '2026-03-07', '2026-03-07 06:26:12', '0000-00-00 00:00:00', 1),
(178, 1, '280628829303467e7e640453d2c91d20b7a48533', 'A', 'Super admin', '2026-03-07', '2026-03-07 09:03:02', '0000-00-00 00:00:00', 1),
(179, 1, 'ed6ac4e2c730bb973b56a4fbbe450a09bab5714f', 'A', 'Super admin', '2026-03-08', '2026-03-08 10:18:45', '0000-00-00 00:00:00', 1),
(180, 1, '8c0ae5d069c56887c72e37388e07daec1034ef74', 'A', 'Super admin', '2026-03-09', '2026-03-09 02:26:08', '0000-00-00 00:00:00', 1),
(181, 1, '43d0b8d9c2fcdbdddb449238f3e2464dc41a863f', 'A', 'Super admin', '2026-03-09', '2026-03-09 09:16:56', '0000-00-00 00:00:00', 1),
(182, 1, 'd09e8797b46d5f9c06aa86ff429cd156d0c8a1ae', 'A', 'Super admin', '2026-03-10', '2026-03-10 05:19:42', '0000-00-00 00:00:00', 1),
(183, 1, '49c164dad068869482f43a2cb21bbea70c1186d5', 'A', 'Super admin', '2026-03-10', '2026-03-10 09:32:43', '0000-00-00 00:00:00', 1),
(184, 7, '0ea19d4d7eb3bd02c16d9569be589b8bedfaf2eb', 'S', 'zsmsn', '2026-03-10', '2026-03-10 09:50:18', '0000-00-00 00:00:00', 1),
(185, 1, 'ad90f6f7f46ba663d7efd83a69de8a94fa2009cd', 'A', 'Super admin', '2026-03-10', '2026-03-10 10:02:00', '0000-00-00 00:00:00', 1),
(186, 1, 'b04966948b814ae481ea58fa44398ec334e33e8d', 'A', 'Super admin', '2026-03-11', '2026-03-11 10:01:18', '0000-00-00 00:00:00', 1),
(187, 1, '1aa8623d12d302e79b65fb8732dd8dc28e1b7754', 'A', 'Super admin', '2026-03-12', '2026-03-12 05:34:49', '0000-00-00 00:00:00', 1),
(188, 1, 'eda1a0c9f6c6ba4455cc70db28831374bc24d087', 'A', 'Super admin', '2026-03-12', '2026-03-12 09:28:51', '0000-00-00 00:00:00', 1),
(189, 1, '44e0bada3531affb46df51a1d4482d806ae8fc5c', 'A', 'Super admin', '2026-03-13', '2026-03-13 12:18:01', '0000-00-00 00:00:00', 1),
(190, 7, 'b33ea3cd07df03792637a86f79f2965393fe36ff', 'S', 'zsmsn', '2026-03-13', '2026-03-13 12:41:17', '0000-00-00 00:00:00', 1),
(191, 1, '8dae211b8d2da89a0438898c1d5a36ad3371c16f', 'A', 'Super admin', '2026-03-13', '2026-03-13 10:39:16', '0000-00-00 00:00:00', 1),
(192, 1, 'bede3362923e692406f578707ce3adf62d1ff091', 'A', 'Super admin', '2026-03-13', '2026-03-13 03:47:08', '0000-00-00 00:00:00', 1),
(193, 1, '542f4c23e915ad2fc0e8d3b4cce80ef8c6c35b2c', 'A', 'Super admin', '2026-03-13', '2026-03-13 09:29:32', '0000-00-00 00:00:00', 1),
(194, 1, 'bb2f52dea1b77ce4195ab86d9f2e742bd533c745', 'A', 'Super admin', '2026-03-14', '2026-03-14 10:31:14', '0000-00-00 00:00:00', 1),
(195, 1, 'b5da8503eee07265461f7b75897472bf28f7660f', 'A', 'Super admin', '2026-03-14', '2026-03-14 06:20:07', '0000-00-00 00:00:00', 1),
(196, 1, '259bd584842fe29e74d90e204e34469c48bb53aa', 'A', 'Super admin', '2026-03-14', '2026-03-14 09:14:42', '0000-00-00 00:00:00', 1),
(197, 1, '25c58e452fa620530eeef9f869c0561f15a44226', 'A', 'Super admin', '2026-03-15', '2026-03-15 10:39:42', '0000-00-00 00:00:00', 1),
(198, 1, 'd25eb57d34262272544b9a2a65a8a803c4fde1db', 'A', 'Super admin', '2026-03-16', '2026-03-16 06:35:41', '0000-00-00 00:00:00', 1),
(199, 1, 'be76a57eebb47fff1aa98b920e91e6664e7dd189', 'A', 'Super admin', '2026-03-16', '2026-03-16 08:58:55', '0000-00-00 00:00:00', 1),
(200, 1, '7970032cd3e12fac4c2acbc89a0be59eb6cad10c', 'A', 'Super admin', '2026-03-17', '2026-03-17 04:37:36', '0000-00-00 00:00:00', 1),
(201, 1, '41b7d04d38e7ec048b6d364134de3c3c8515846d', 'A', 'Super admin', '2026-03-17', '2026-03-17 09:19:05', '0000-00-00 00:00:00', 1),
(202, 1, 'edd0f431d1114114ddf7a7df82f2557d5d3f32da', 'A', 'Super admin', '2026-03-28', '2026-03-28 07:31:49', '0000-00-00 00:00:00', 1),
(203, 1, 'e8be5dae66c63bb3c7ca0b278db654c4071ff276', 'A', 'Super admin', '2026-03-31', '2026-03-31 07:48:49', '0000-00-00 00:00:00', 1),
(204, 1, 'ea1854b0dc3352d7e3da71616aa2477a39fa987e', 'A', 'Super admin', '2026-03-31', '2026-03-31 01:41:00', '0000-00-00 00:00:00', 1),
(205, 1, '84353c062fc2ebd5051f77f848b8fefa86a91994', 'A', 'Super admin', '2026-03-31', '2026-03-31 08:40:35', '0000-00-00 00:00:00', 1),
(206, 1, 'e6ef8a1af44b75ee2d271635635143540f936b82', 'A', 'Super admin', '2026-04-01', '2026-04-01 11:56:18', '0000-00-00 00:00:00', 1),
(207, 1, '7b776d4e27f6758749f8ffdd805ac0308c686771', 'A', 'Super admin', '2026-04-01', '2026-04-01 02:51:21', '0000-00-00 00:00:00', 1),
(208, 1, '94ed4334e0a536037a013f4dcdc6faab71218544', 'A', 'Super admin', '2026-04-01', '2026-04-01 09:21:22', '0000-00-00 00:00:00', 1),
(209, 1, '0a3142d936232e50b5cdd00c951c98f26481c1c7', 'A', 'Super admin', '2026-04-02', '2026-04-02 03:05:12', '0000-00-00 00:00:00', 1),
(210, 1, '5206e3176071b7504360f96920b69de50df3d93c', 'A', 'Super admin', '2026-04-02', '2026-04-02 07:49:01', '0000-00-00 00:00:00', 1),
(211, 1, 'ca64a5e02775e777be2796d2e3b5449a8690888d', 'A', 'Super admin', '2026-04-02', '2026-04-02 10:28:09', '0000-00-00 00:00:00', 1),
(212, 1, '474f4bcc22ef04caee89d194f0da6c54508332be', 'A', 'Super admin', '2026-04-03', '2026-04-03 09:44:12', '0000-00-00 00:00:00', 1),
(213, 1, 'fcc54ced94f6bee69d10b0aa68cf200a21ec00c8', 'A', 'Super admin', '2026-04-03', '2026-04-03 12:12:09', '0000-00-00 00:00:00', 1),
(214, 1, '3317aa6a4567e1b30923572e51f53a91821a1df1', 'A', 'Super admin', '2026-04-03', '2026-04-03 08:42:52', '0000-00-00 00:00:00', 1),
(215, 1, 'dcf4ee9c659c3d13feaabc36932c7e1c42c9924f', 'A', 'Super admin', '2026-04-04', '2026-04-04 12:17:35', '0000-00-00 00:00:00', 1),
(216, 1, '9ac32f922a0a6adbb2835d690ac11102b93435d6', 'A', 'Super admin', '2026-04-04', '2026-04-04 11:41:43', '0000-00-00 00:00:00', 1),
(217, 1, '6a7f67b7660779016b8a5b0f185fb371629c890d', 'A', 'Super admin', '2026-04-04', '2026-04-04 06:23:47', '0000-00-00 00:00:00', 1),
(218, 1, '185ccc3dccd5dcc54094da46f8a58ccaf14813aa', 'A', 'Super admin', '2026-04-05', '2026-04-05 11:51:29', '0000-00-00 00:00:00', 1),
(219, 1, '77cd02a708f5606a00da1686e546eba805efe7b9', 'A', 'Super admin', '2026-04-05', '2026-04-05 11:43:34', '0000-00-00 00:00:00', 1),
(220, 1, '4214cfd583d91288350190e83563391dca712924', 'A', 'Super admin', '2026-04-06', '2026-04-06 11:34:55', '0000-00-00 00:00:00', 1),
(221, 1, '1c8193e5db6bbcd13ed7f05d3718146a2c23f32c', 'A', 'Super admin', '2026-04-06', '2026-04-06 06:26:28', '0000-00-00 00:00:00', 1),
(222, 1, '04887a11190a07df3faab46bcf5723443ba7fced', 'A', 'Super admin', '2026-04-07', '2026-04-07 06:10:29', '0000-00-00 00:00:00', 1),
(223, 1, '95f2656645f66dab2eae45556aca9e6d5149579f', 'A', 'Super admin', '2026-04-07', '2026-04-07 12:45:02', '0000-00-00 00:00:00', 1),
(224, 1, '9fb9dee7d7a3a105e603d87d975496c4deb849a7', 'A', 'Super admin', '2026-04-07', '2026-04-07 01:45:23', '0000-00-00 00:00:00', 1),
(225, 1, 'f76cff43645aea06c1a512fc6cd934606f7c2297', 'A', 'Super admin', '2026-04-07', '2026-04-07 10:17:05', '0000-00-00 00:00:00', 1),
(226, 1, 'f1ad7142d4c49453b06e576253a993094600a330', 'A', 'Super admin', '2026-04-08', '2026-04-08 07:15:22', '0000-00-00 00:00:00', 1),
(227, 1, 'e19d4f94a81ee812947fc2f5e101f80c53df3653', 'A', 'Super admin', '2026-04-08', '2026-04-08 08:48:57', '0000-00-00 00:00:00', 1),
(228, 1, 'aa93be8365751dedc471b4be6da286d4beeb4eaa', 'A', 'Super admin', '2026-04-08', '2026-04-08 01:01:43', '0000-00-00 00:00:00', 1),
(229, 1, 'b6cb770777427bddb60cfa9577646b4f03991731', 'A', 'Super admin', '2026-04-08', '2026-04-08 01:50:56', '0000-00-00 00:00:00', 1),
(230, 1, '7da710febe612fac1a985f7e31dc4db85dce7e97', 'A', 'Super admin', '2026-04-08', '2026-04-08 09:08:24', '0000-00-00 00:00:00', 1),
(231, 1, 'd88028d0c0dcb23c116ea55554b7328411cb5c70', 'A', 'Super admin', '2026-04-09', '2026-04-09 06:59:28', '0000-00-00 00:00:00', 1),
(232, 1, '80b503d9a6c9d3767c45552760a54c8b156dddb7', 'A', 'Super admin', '2026-04-09', '2026-04-09 09:08:07', '0000-00-00 00:00:00', 1),
(233, 1, 'ec10bfdf00b5b082751e5f76fe9f431f6b839265', 'A', 'Super admin', '2026-04-09', '2026-04-09 11:59:56', '0000-00-00 00:00:00', 1),
(234, 1, '1d715ff8ff3644ed2b56a53c38451fba9ccd018d', 'A', 'Super admin', '2026-04-10', '2026-04-10 07:24:45', '0000-00-00 00:00:00', 1),
(235, 1, '90cdc5e2cdad35e0e7f4d1a55ebffbd926b6ec93', 'A', 'Super admin', '2026-04-10', '2026-04-10 12:44:39', '0000-00-00 00:00:00', 1),
(236, 1, '006cee1d1c646c57cf68dc92a957acf08511d68d', 'A', 'Super admin', '2026-04-10', '2026-04-10 07:09:11', '0000-00-00 00:00:00', 1),
(237, 1, '54cc036e6485249ffb6fbab9e42dbb99d0bc6ada', 'A', 'Super admin', '2026-04-11', '2026-04-11 08:32:11', '0000-00-00 00:00:00', 1),
(238, 1, 'e65b720645ed2f58f3454d4cdefee2e827327404', 'A', 'Super admin', '2026-04-11', '2026-04-11 09:48:10', '0000-00-00 00:00:00', 1),
(239, 1, '291bb6c6912c6dba9d51dd528fea5813e50fc684', 'A', 'Super admin', '2026-04-11', '2026-04-11 04:47:13', '0000-00-00 00:00:00', 1),
(240, 1, 'd78c6f06b6fb18e0f2ee16a050b7f8d40f6b1101', 'A', 'Super admin', '2026-04-12', '2026-04-12 06:37:26', '0000-00-00 00:00:00', 1),
(241, 1, '546ecab26a85ce27909b56486e977a521584c96e', 'A', 'Super admin', '2026-04-12', '2026-04-12 10:41:48', '0000-00-00 00:00:00', 1),
(242, 1, '3e77201e5a4a6a73fac0ff4a3138bffd40822394', 'A', 'Super admin', '2026-04-13', '2026-04-13 06:42:29', '0000-00-00 00:00:00', 1),
(243, 1, '3559197341875da18e2c7ff9841b9a6977a47dc0', 'A', 'Super admin', '2026-04-13', '2026-04-13 10:20:11', '0000-00-00 00:00:00', 1),
(244, 1, 'c5a08d0f84b14c04caa3df73e1acf673e0afced3', 'A', 'Super admin', '2026-04-14', '2026-04-14 06:51:31', '0000-00-00 00:00:00', 1),
(245, 1, '9bd1ea0e3a1cdcac2d5d677295743a33463a8f44', 'A', 'Super admin', '2026-04-16', '2026-04-16 08:51:52', '0000-00-00 00:00:00', 1),
(246, 1, 'e96adbdca65c89278b1af778f2cdd8b09dd70b8d', 'A', 'Super admin', '2026-04-16', '2026-04-16 12:14:12', '0000-00-00 00:00:00', 1),
(247, 1, '8e3cb9a9332d16fb5945a43f0b0589356b1ba430', 'A', 'Super admin', '2026-04-17', '2026-04-17 06:59:56', '0000-00-00 00:00:00', 1),
(248, 1, 'bd4d1fcd9f8a1d325abab54ffa98639db51652b0', 'A', 'Super admin', '2026-04-18', '2026-04-18 06:59:38', '0000-00-00 00:00:00', 1),
(249, 1, '285454bc330a0a168311fc464b897d132becb773', 'A', 'Super admin', '2026-04-18', '2026-04-18 08:44:25', '0000-00-00 00:00:00', 1),
(250, 1, 'e9f144d1571dce4a07704b4ff2cdd62bcb18f171', 'A', 'Super admin', '2026-04-18', '2026-04-18 08:55:55', '0000-00-00 00:00:00', 1),
(251, 1, 'fb1098a1ade19f8f749950836056f7a0ea70f911', 'A', 'Super admin', '2026-04-18', '2026-04-18 10:58:56', '0000-00-00 00:00:00', 1),
(252, 1, 'd5b1d6fe2cdc5b2d8c092149736d8df35b766964', 'A', 'Super admin', '2026-04-18', '2026-04-18 04:11:46', '0000-00-00 00:00:00', 1),
(253, 1, '602e4fd24e73d985d4fd0b570401112843db0f3c', 'A', 'Super admin', '2026-04-18', '2026-04-18 07:40:37', '0000-00-00 00:00:00', 1),
(254, 1, 'f90a66dc0ee292e52c0cc59160b0f5a2f994b8b8', 'A', 'Super admin', '2026-04-18', '2026-04-18 11:45:53', '0000-00-00 00:00:00', 1),
(255, 9, '71d91cea2103232ca6231572aebb2a5cfb92fdca', 'S', 'Shalis', '2026-04-19', '2026-04-19 12:48:59', '0000-00-00 00:00:00', 1),
(256, 9, '453c3ae61220ae186be91cc714f6d5ee00d3ef06', 'S', 'Shalis', '2026-04-19', '2026-04-19 01:01:25', '2026-04-19 01:06:03', 1),
(257, 9, '123803eaff51f6c3e92a9b0d7608e7243729d6d3', 'S', 'Shalis', '2026-04-19', '2026-04-19 01:06:09', '2026-04-19 01:10:21', 1),
(258, 9, 'eab809c315d25bbe02de3a0ee574a7d4ca62674b', 'S', 'Shalis', '2026-04-19', '2026-04-19 01:10:26', '2026-04-19 01:10:53', 1),
(259, 9, 'a86ff24a6b64e4989fa02e07b482ed2dbee3a37b', 'S', 'Shalis', '2026-04-19', '2026-04-19 01:10:57', '0000-00-00 00:00:00', 1),
(260, 9, '4d8590e5f3606e6bd2da0174b2d5463ee2c76c82', 'S', 'Shalis', '2026-04-19', '2026-04-19 01:16:47', '0000-00-00 00:00:00', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meta_ads_setting`
--

INSERT INTO `meta_ads_setting` (`meta_ads_setting_id`, `meta_ads_setting_name`, `facebook_form_id`, `meta_ads_setting_description`, `meta_ads_setting_created_by_userid`, `meta_ads_setting_created_by_username`, `meta_ads_setting_created_by_date`, `meta_ads_setting_created_by_time`, `meta_ads_setting_status`) VALUES
(1, 'nsnsss', '99920', 'sdss', 1, 'Super admin', '2026-04-08', '12:21:14', 1),
(2, ' s', '3', '', 1, 'Super admin', '2026-04-08', '12:33:55', 1),
(3, 'nnsn', 'dd', 's', 1, 'Super admin', '2026-04-08', '12:36:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meta_ads_setting_staff`
--

CREATE TABLE `meta_ads_setting_staff` (
  `meta_ads_setting_staff_id` int(11) NOT NULL,
  `meta_ads_setting_id_fk` int(11) NOT NULL,
  `meta_ads_setting_staff_id_fk` int(11) NOT NULL,
  `meta_ads_setting_staff_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `meta_ads_setting_staff`
--

INSERT INTO `meta_ads_setting_staff` (`meta_ads_setting_staff_id`, `meta_ads_setting_id_fk`, `meta_ads_setting_staff_id_fk`, `meta_ads_setting_staff_status`) VALUES
(3, 1, 3, 1),
(4, 1, 7, 1),
(5, 1, 8, 1),
(6, 2, 3, 1),
(7, 3, 7, 1);

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
  `raw_payload` longtext,
  `status` varchar(20) DEFAULT 'received',
  `error_message` longtext,
  `created_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `packages_description` text,
  `packages_createdby_user_id` int(11) NOT NULL,
  `packages_createdby_user_name` varchar(255) NOT NULL,
  `packages_created_date` date NOT NULL,
  `packages_created_time` time NOT NULL,
  `packages_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages`
--

INSERT INTO `packages` (`packages_id`, `packages_category_id_fk`, `packages_itinerary_category_id_fk`, `packages_itinerary_id_fk`, `packages_inclusion_exclusion_common_id_fk`, `packages_inclusion_exclusion_checked_type`, `packages_optional_add_on_checked_type`, `packages_special_requirment_checked_type`, `packages_payment_policies_checked_type`, `packages_terms_conditions_checked_type`, `packages_cancellation_policy_checked_type`, `packages_notes_checked_type`, `packages_property_checked_type`, `packages_title`, `packages_duration_in_nights`, `packages_bank_details`, `packages_qr_code_doc`, `packages_first_cover_page`, `packages_last_cover_page`, `packages_description`, `packages_createdby_user_id`, `packages_createdby_user_name`, `packages_created_date`, `packages_created_time`, `packages_status`) VALUES
(1, 2, 2, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'COCHIN TO MUNNAR', 2, '', '', 'pkg_cover_copy_1773561390_3605.jpg', 'pkg_cover_copy_1773561390_5721.jpg', NULL, 1, 'Super admin', '2026-03-15', '01:26:30', 1),
(2, 2, 2, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'Fasss', 2, '', '', 'pkg_cover_copy_1773564262_9010.jpg', 'pkg_cover_copy_1773564262_8676.jpg', NULL, 1, 'Super admin', '2026-03-15', '02:14:22', 1),
(3, 2, 2, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'Najnan', 2, '', '', 'pkg_cover_copy_1773675104_8193.jpg', 'pkg_cover_copy_1773675104_4384.jpg', NULL, 1, 'Super admin', '2026-03-16', '09:01:44', 1),
(4, 2, 2, 1, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Y', 'Gagaggahaha', 2, '', '', 'pkg_cover_copy_1773749069_3465.jpg', 'pkg_cover_copy_1773749069_4667.jpg', NULL, 1, 'Super admin', '2026-03-17', '05:34:29', 1),
(5, 2, 2, 1, 3, 'Y', 'Y', NULL, 'Y', 'Y', 'Y', 'Y', 'Y', 'new templ', 2, '', '', 'pkg_cover_copy_1775035568_9051.jpg', 'pkg_cover_copy_1775035568_2120.jpg', NULL, 1, 'Super admin', '2026-04-01', '02:56:08', 1),
(6, 2, 2, 3, 3, 'Y', 'Y', NULL, 'Y', 'Y', 'Y', 'Y', 'Y', '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', 5, '', '', 'pkg_cover_copy_1775376883_7285.jpeg', 'pkg_cover_copy_1775376883_2743.jpg', NULL, 1, 'Super admin', '2026-04-05', '01:44:43', 1),
(7, 2, 2, 3, 3, 'Y', 'Y', NULL, 'Y', 'Y', 'Y', 'Y', 'Y', '4N5D - MUNNAR THEKKADY ALAPPEY COCHIN', 5, '', '', 'pkg_cover_copy_1775482744_5572.jpeg', 'pkg_cover_copy_1775482744_4461.jpg', NULL, 1, 'Super admin', '2026-04-06', '07:09:04', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_cancellation_policies`
--

INSERT INTO `packages_cancellation_policies` (`packages_cancellation_policies_id`, `packages_cancellation_policies_packages_id_fk`, `cancellation_policies_id_fk`, `cancellation_policies_item_id_fk`, `packages_cancellation_policies_type`, `packages_cancellation_policies_details`, `packages_cancellation_policies_status`) VALUES
(1, 6, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1),
(2, 7, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1),
(3, 5, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_exclusions`
--

INSERT INTO `packages_exclusions` (`packages_exclusions_id`, `packages_id_fk`, `exclusions_common_id_fk`, `exclusions_id_fk`, `packages_exclusions_type`, `packages_exclusions_details`, `packages_exclusions_status`) VALUES
(1, 6, 3, NULL, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(2, 6, 3, NULL, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(3, 6, 3, NULL, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(4, 6, 3, NULL, 'Y', 'Any entry fees/Camera Fees.', 1),
(5, 6, 3, NULL, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(6, 7, 3, NULL, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(7, 7, 3, NULL, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(8, 7, 3, NULL, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(9, 7, 3, NULL, 'Y', 'Any entry fees/Camera Fees.', 1),
(10, 7, 3, NULL, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(11, 5, 3, NULL, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(12, 5, 3, NULL, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(13, 5, 3, NULL, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(14, 5, 3, NULL, 'Y', 'Any entry fees/Camera Fees.', 1),
(15, 5, 3, NULL, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_inclusions`
--

INSERT INTO `packages_inclusions` (`packages_inclusions_id`, `packages_id_fk`, `inclusion_common_id_fk`, `inclusions_id_fk`, `packages_inclusions_type`, `packages_inclusions_details`, `packages_inclusions_status`) VALUES
(1, 6, 3, NULL, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(2, 6, 3, NULL, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(3, 6, 3, NULL, 'Y', 'Resort with Breakfast', 1),
(4, 6, 3, NULL, 'Y', 'Houseboat with all meals', 1),
(5, 6, 3, NULL, 'Y', 'Sightseeing as per itinerary', 1),
(6, 6, 3, NULL, 'Y', 'A Professional Driver cum Guide', 1),
(7, 7, 3, NULL, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(8, 7, 3, NULL, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(9, 7, 3, NULL, 'Y', 'Resort with Breakfast', 1),
(10, 7, 3, NULL, 'Y', 'Houseboat with all meals', 1),
(11, 7, 3, NULL, 'Y', 'Sightseeing as per itinerary', 1),
(12, 7, 3, NULL, 'Y', 'A Professional Driver cum Guide', 1),
(13, 5, 3, NULL, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(14, 5, 3, NULL, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(15, 5, 3, NULL, 'Y', 'Resort with Breakfast', 1),
(16, 5, 3, NULL, 'Y', 'Houseboat with all meals', 1),
(17, 5, 3, NULL, 'Y', 'Sightseeing as per itinerary', 1),
(18, 5, 3, NULL, 'Y', 'A Professional Driver cum Guide', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_itinerary`
--

CREATE TABLE `packages_itinerary` (
  `packages_itinerary_id` int(11) NOT NULL,
  `packages_id_fk` int(11) NOT NULL,
  `itineraries_id_fk` int(11) NOT NULL,
  `packages_itinerary_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_itinerary`
--

INSERT INTO `packages_itinerary` (`packages_itinerary_id`, `packages_id_fk`, `itineraries_id_fk`, `packages_itinerary_status`) VALUES
(10, 2, 1, 1),
(11, 1, 1, 1),
(12, 3, 1, 1),
(14, 4, 1, 1),
(16, 6, 3, 1),
(17, 7, 3, 1),
(19, 5, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_itinerary_days`
--

INSERT INTO `packages_itinerary_days` (`packages_itinerary_days_id`, `packages_itinerary_id_fk`, `itineraries_days_id_fk`, `packages_itineraries_days_day`, `packages_itineraries_days_destination_id_fk`, `packages_itineraries_days_title`, `packages_itineraries_days_image`, `packages_itineraries_days_description`, `packages_itineraries_days_travel_back`, `packages_itineraries_days_required_status`, `packages_itinerary_days_status`) VALUES
(25, 10, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'pkgday_69b67166ed6761.58494074.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(26, 10, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'pkgday_69b67166eec8b3.29612319.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(27, 10, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'pkgday_69b67166f18bd3.74703842.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 1, 1),
(28, 11, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'pkgday_69b6662e794b69.33759922.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(29, 11, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'pkgday_69b6662e7bbdf7.14205694.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(30, 11, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'pkgday_69b6662e806e68.41754846.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 2, 1),
(31, 12, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'pkgday_69b822604f25c3.59002043.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(32, 12, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'pkgday_69b82260548705.54513085.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(33, 12, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'pkgday_69b8226059f379.58666110.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 1, 1),
(37, 14, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'pkgday_69b9434ddac599.50410500.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(38, 14, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'pkgday_69b9434ddc6fc6.36006033.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(39, 14, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'pkgday_69b9434dde2990.68527878.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 1, 1),
(43, 16, 7, 'Day 1', 4, 'COCHIN TO MUNNAR', 'pkgday_69d219f3b39c35.68853366.webp', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</p><p>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- <strong>Adventure Park</strong> (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(44, 16, 8, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'pkgday_69d219f3b76972.47562072.webp', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 0, 1),
(45, 16, 9, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'pkgday_69d219f3b92154.38976971.jpg', '<ul><li>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</li><li>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to spot wildlife like elephants, deer, and birds.</li><li>Experience a memorable <strong>Elephant encounter with rides, bathing, and feeding</strong></li><li>End the evening with mesmerizing cultural performances of <strong>Kathakali and Kerala’s traditional martial arts</strong></li><li>Overnight stay in the Hotel/ Resort.</li></ul>', '', 0, 1),
(46, 16, 10, 'Day 4', 1, 'THEKKADY TO ALAPPEY', 'pkgday_69d219f3bb7375.26105516.png', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East.</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerabl lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 0, 1),
(47, 16, 11, 'Day 5', 1, 'ALAPPEY TO VARKALA', 'pkgday_69d219f3bdc044.71093189.webp', '<ul><li>After breakfast, check-out from the Houseboat &amp; From the ‘Backwater Capital , today you will be driving to <strong>Varkala</strong>.</li><li>On the way, we will Drive to Chadayamangalam to explore the <strong>Jatayu earth Centre</strong>. The giant concrete statue of Jatayu is built on a mighty rock named Jatayupara (para means rock in Malayalam).</li><li>Reach Varkala, explore <strong>Varkala Cliff &amp; Beach, Black Sand Beach, Sri Janardhana Swami Temple, Kappil Beach.</strong></li><li>You can explore variety of <strong>water sports</strong> icluding Jet skiing, Parasailing, Banana boat rides and kayaking.</li><li>Overnight Stay at the resort/hotel in Varkala/Trivandrum</li></ul>', '', 0, 1),
(48, 16, 12, 'Day 6', 4, 'VARKALA TO TRIVANDRUM', 'pkgday_69d219f3c014c4.05895612.jpeg', '<ul><li>Checkout from Resort &amp; Get ready to explore Trivandrum Visit to the iconic <strong>Sree Padmanabhaswamy Temple</strong>, one of the richest and most famous temples in India. (Men need to wear a dhoti and women a saree or a long skirt and blouse)</li><li>Visit the <strong>Napier Museum</strong>, which houses a vast collection of historical artifacts, bronze idols, ancient ornaments, and a temple chariot.</li><li>Explore the <strong>Trivandrum Zoo</strong>, one of the oldest zoos in India, located within the museum complex. It houses a wide variety of animals, birds, and reptiles in lush, green surroundings.</li><li>Local shopping &amp; Drop at Trivandrum Airport/ Railway</li></ul>', 'TB', 2, 1),
(49, 17, 7, 'Day 1', 4, 'COCHIN TO MUNNAR', 'pkgday_69d3b7780df448.80402190.webp', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills.</p><p>Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- <strong>Adventure Park</strong> (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(50, 17, 8, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'pkgday_69d3b7781299b9.32153004.webp', '<ul><li>After breakfast get ready to explore the city of Munnar, Visit <strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</strong></li><li>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</li><li>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</li><li>Overnight stay At Munnar</li></ul>', '', 0, 1),
(51, 17, 9, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'pkgday_69d3b778149756.17668083.jpg', '<ul><li>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</li><li>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to spot wildlife like elephants, deer, and birds.</li><li>Experience a memorable <strong>Elephant encounter with rides, bathing, and feeding</strong></li><li>End the evening with mesmerizing cultural performances of <strong>Kathakali and Kerala’s traditional martial arts</strong></li><li>Overnight stay in the Hotel/ Resort.</li></ul>', '', 0, 1),
(52, 17, 10, 'Day 4', 1, 'THEKKADY TO ALAPPEY', 'pkgday_69d3b778168449.40974631.png', '<ul><li>After breakfast, checkout from the hotel/ Resort and drive towards <strong>Alappey</strong>; the Backwater capital of India</li><li>Arriving in Alappey, check-in into a houseboat and get settle down, lunch will be served. Alappey is known for its mesmerizing beauty and charm &amp; also called the ‘Venice of the East.</li><li>After this, you can take an exciting backwater cruise and enjoy the skim past ancient Chinese fishing nets; water Lillie’s, lush paddy fields, coir villages,rustic homes, temples, coconut groves, Innumerabl lagoons, lakes, canals and estuaries.</li><li>Dinner &amp; Overnight stay in the houseboat.</li></ul><p>(Checkin time: 12 pm &amp; Checkout time: 09 am &amp; Cruising time 12pm - 5 pm)</p>', '', 0, 1),
(53, 17, 11, 'Day 5', 1, 'ALAPPEY TO VARKALA', 'pkgday_69d3b778192376.27978641.webp', '<ul><li>After breakfast, check-out from the Houseboat &amp; From the ‘Backwater Capital , today you will be driving to <strong>Varkala</strong>.</li><li>On the way, we will Drive to Chadayamangalam to explore the <strong>Jatayu earth Centre</strong>. The giant concrete statue of Jatayu is built on a mighty rock named Jatayupara (para means rock in Malayalam).</li><li>Reach Varkala, explore <strong>Varkala Cliff &amp; Beach, Black Sand Beach, Sri Janardhana Swami Temple, Kappil Beach.</strong></li><li>You can explore variety of <strong>water sports</strong> icluding Jet skiing, Parasailing, Banana boat rides and kayaking.</li><li>Overnight Stay at the resort/hotel in Varkala/Trivandrum</li></ul>', '', 0, 1),
(54, 17, 12, 'Day 6', 4, 'VARKALA TO TRIVANDRUM', 'pkgday_69d3b7781ad675.29273872.jpeg', '<ul><li>Checkout from Resort &amp; Get ready to explore Trivandrum Visit to the iconic <strong>Sree Padmanabhaswamy Temple</strong>, one of the richest and most famous temples in India. (Men need to wear a dhoti and women a saree or a long skirt and blouse)</li><li>Visit the <strong>Napier Museum</strong>, which houses a vast collection of historical artifacts, bronze idols, ancient ornaments, and a temple chariot.</li><li>Explore the <strong>Trivandrum Zoo</strong>, one of the oldest zoos in India, located within the museum complex. It houses a wide variety of animals, birds, and reptiles in lush, green surroundings.</li><li>Local shopping &amp; Drop at Trivandrum Airport/ Railway</li></ul>', 'TB', 2, 1),
(58, 19, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'pkgday_69cce4b068f397.79824738.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(59, 19, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'pkgday_69cce4b06b3e70.31437601.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(60, 19, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'pkgday_69cce4b06dde87.61421663.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_notes`
--

CREATE TABLE `packages_notes` (
  `packages_notes_id` int(11) NOT NULL,
  `packages_notes_packages_id_fk` int(11) NOT NULL,
  `packages_notes_details` text NOT NULL,
  `packages_notes_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_notes`
--

INSERT INTO `packages_notes` (`packages_notes_id`, `packages_notes_packages_id_fk`, `packages_notes_details`, `packages_notes_status`) VALUES
(1, 6, 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(2, 6, 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(3, 6, 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(4, 7, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(5, 7, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(6, 7, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(7, 7, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(8, 7, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(9, 5, 'Any entry fees/Camera Fees.', 1),
(10, 5, 'Any entry fees/Camera Fees.', 1),
(11, 5, 'Any entry fees/Camera Fees.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_optional_add_on`
--

CREATE TABLE `packages_optional_add_on` (
  `packages_optional_add_on_id` int(11) NOT NULL,
  `packages_optional_add_on_packages_id_fk` int(11) NOT NULL,
  `packages_optional_add_on_details` text NOT NULL,
  `packages_optional_add_on_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_optional_add_on`
--

INSERT INTO `packages_optional_add_on` (`packages_optional_add_on_id`, `packages_optional_add_on_packages_id_fk`, `packages_optional_add_on_details`, `packages_optional_add_on_status`) VALUES
(1, 6, 'A Professional Driver cum Guide', 1),
(2, 6, 'Sightseeing as per itinerary', 1),
(3, 6, 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(4, 6, 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(5, 7, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(6, 7, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(7, 7, 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(8, 7, 'Anything else that is not mentioned in the inclusions', 1),
(9, 7, 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(10, 5, 'Any entry fees/Camera Fees.', 1),
(11, 5, 'Any entry fees/Camera Fees.', 1),
(12, 5, 'Any entry fees/Camera Fees.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_payment_policies`
--

INSERT INTO `packages_payment_policies` (`packages_payment_policies_id`, `packages_payment_policies_packages_id_fk`, `payment_policies_id_fk`, `payment_policies_items_id_fk`, `packages_payment_policies_type`, `packages_payment_policies_details`, `packages_payment_policies_status`) VALUES
(1, 6, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(2, 6, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(3, 6, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(4, 6, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(5, 7, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(6, 7, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(7, 7, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(8, 7, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(9, 5, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(10, 5, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(11, 5, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(12, 5, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_properties`
--

CREATE TABLE `packages_properties` (
  `packages_properties_id` int(11) NOT NULL,
  `packages_properties_days_id_fk` int(11) NOT NULL,
  `properties_id_fk` int(11) NOT NULL,
  `packages_properties_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_properties`
--

INSERT INTO `packages_properties` (`packages_properties_id`, `packages_properties_days_id_fk`, `properties_id_fk`, `packages_properties_status`) VALUES
(48, 40, 2, 1),
(49, 41, 6, 1),
(50, 42, 2, 1),
(51, 42, 1, 1),
(52, 43, 2, 1),
(53, 44, 6, 1),
(54, 46, 2, 1),
(55, 47, 6, 1),
(56, 49, 1, 1),
(57, 49, 2, 1),
(58, 50, 6, 1),
(59, 50, 3, 1),
(60, 51, 4, 1),
(61, 52, 1, 1),
(62, 52, 2, 1),
(63, 53, 6, 1),
(64, 53, 3, 1),
(65, 54, 2, 1),
(66, 54, 1, 1),
(70, 58, 4, 1),
(71, 59, 6, 1),
(72, 60, 1, 1),
(73, 61, 4, 1),
(74, 62, 3, 1),
(75, 63, 2, 1),
(78, 67, 2, 1),
(79, 68, 3, 1),
(80, 69, 2, 1),
(81, 70, 6, 1),
(82, 71, 6, 1),
(83, 73, 2, 1),
(84, 74, 3, 1),
(85, 75, 2, 1),
(86, 76, 6, 1),
(87, 77, 3, 1),
(88, 79, 2, 1),
(89, 80, 6, 1),
(90, 81, 2, 1),
(91, 82, 6, 1),
(92, 83, 32, 1),
(93, 85, 2, 1),
(94, 86, 6, 1),
(95, 87, 4, 1),
(96, 88, 6, 1),
(97, 89, 3, 1),
(100, 94, 4, 1),
(101, 95, 6, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_properties_common`
--

INSERT INTO `packages_properties_common` (`packages_properties_common_id`, `packages_properties_common_packages_id_fk`, `packages_properties_common_category_name`, `packages_properties_common_design_type`, `packages_properties_common_status`) VALUES
(14, 2, 'Stanadrd1', 'Standard', 1),
(15, 1, 'Standard', 'Standard', 1),
(16, 1, 'Exclusive', 'Exclusive', 1),
(17, 3, 'Fann', 'Standard', 1),
(18, 3, 'Hmamam', 'Exclusive', 1),
(20, 4, 'Ghajah', 'Standard', 1),
(21, 4, 'jjkj', 'Exclusive', 1),
(23, 6, 'STANDARD PACKAGE', 'Standard', 1),
(24, 6, 'PRIMIUEM PACKAGE', 'Exclusive', 1),
(25, 7, 'STANDARD PACKAGE', 'Standard', 1),
(26, 7, 'PREMIUM PACKAGE', 'Exclusive', 1),
(28, 5, 'first--', 'Standard', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_properties_days`
--

INSERT INTO `packages_properties_days` (`packages_properties_days_id`, `packages_properties_common_id_fk`, `packages_itinerary_days_id_fk`, `packages_properties_days_day`, `packages_properties_days_destination_id_fk`, `packages_properties_days_travel_back`, `packages_properties_days_status`) VALUES
(40, 14, 25, 'Day 1', 4, '', 1),
(41, 14, 26, 'Day 2', 1, '', 1),
(42, 14, 27, 'Day 3', 4, 'TB', 1),
(43, 15, 28, 'Day 1', 4, '', 1),
(44, 15, 29, 'Day 2', 1, '', 1),
(45, 15, 30, 'Day 3', 4, 'TB', 1),
(46, 16, 28, 'Day 1', 4, '', 1),
(47, 16, 29, 'Day 2', 1, '', 1),
(48, 16, 30, 'Day 3', 4, 'TB', 1),
(49, 17, 31, 'Day 1', 4, '', 1),
(50, 17, 32, 'Day 2', 1, '', 1),
(51, 17, 33, 'Day 3', 4, 'TB', 1),
(52, 18, 31, 'Day 1', 4, '', 1),
(53, 18, 32, 'Day 2', 1, '', 1),
(54, 18, 33, 'Day 3', 4, 'TB', 1),
(58, 20, 37, 'Day 1', 4, '', 1),
(59, 20, 38, 'Day 2', 1, '', 1),
(60, 20, 39, 'Day 3', 4, 'TB', 1),
(61, 21, 37, 'Day 1', 4, '', 1),
(62, 21, 38, 'Day 2', 1, '', 1),
(63, 21, 39, 'Day 3', 4, 'TB', 1),
(67, 23, 43, 'Day 1', 4, '', 1),
(68, 23, 44, 'Day 2', 1, '', 1),
(69, 23, 45, 'Day 3', 4, '', 1),
(70, 23, 46, 'Day 4', 1, '', 1),
(71, 23, 47, 'Day 5', 1, '', 1),
(72, 23, 48, 'Day 6', 4, 'TB', 1),
(73, 24, 43, 'Day 1', 4, '', 1),
(74, 24, 44, 'Day 2', 1, '', 1),
(75, 24, 45, 'Day 3', 4, '', 1),
(76, 24, 46, 'Day 4', 1, '', 1),
(77, 24, 47, 'Day 5', 1, '', 1),
(78, 24, 48, 'Day 6', 4, 'TB', 1),
(79, 25, 49, 'Day 1', 4, '', 1),
(80, 25, 50, 'Day 2', 1, '', 1),
(81, 25, 51, 'Day 3', 4, '', 1),
(82, 25, 52, 'Day 4', 1, '', 1),
(83, 25, 53, 'Day 5', 1, '', 1),
(84, 25, 54, 'Day 6', 4, 'TB', 1),
(85, 26, 49, 'Day 1', 4, '', 1),
(86, 26, 50, 'Day 2', 1, '', 1),
(87, 26, 51, 'Day 3', 4, '', 1),
(88, 26, 52, 'Day 4', 1, '', 1),
(89, 26, 53, 'Day 5', 1, '', 1),
(90, 26, 54, 'Day 6', 4, 'TB', 1),
(94, 28, 58, 'Day 1', 4, '', 1),
(95, 28, 59, 'Day 2', 1, '', 1),
(96, 28, 60, 'Day 3', 4, 'TB', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages_properties_rooms`
--

CREATE TABLE `packages_properties_rooms` (
  `packages_properties_rooms_id` int(11) NOT NULL,
  `packages_properties_id_fk` int(11) NOT NULL,
  `packages_properties_rooms_id_fk` int(11) NOT NULL,
  `packages_properties_rooms_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_properties_rooms`
--

INSERT INTO `packages_properties_rooms` (`packages_properties_rooms_id`, `packages_properties_id_fk`, `packages_properties_rooms_id_fk`, `packages_properties_rooms_status`) VALUES
(52, 48, 6, 1),
(53, 49, 12, 1),
(54, 50, 6, 1),
(55, 51, 1, 1),
(56, 52, 6, 1),
(57, 53, 12, 1),
(58, 54, 6, 1),
(59, 55, 12, 1),
(60, 56, 1, 1),
(61, 57, 7, 1),
(62, 58, 12, 1),
(63, 59, 3, 1),
(64, 60, 8, 1),
(65, 61, 1, 1),
(66, 62, 6, 1),
(67, 63, 12, 1),
(68, 64, 3, 1),
(69, 64, 4, 1),
(70, 65, 6, 1),
(71, 66, 1, 1),
(72, 66, 2, 1),
(76, 70, 9, 1),
(77, 71, 12, 1),
(78, 72, 2, 1),
(79, 73, 8, 1),
(80, 74, 4, 1),
(81, 75, 7, 1),
(86, 78, 6, 1),
(87, 79, 3, 1),
(88, 80, 6, 1),
(89, 81, 12, 1),
(90, 82, 12, 1),
(91, 83, 7, 1),
(92, 84, 3, 1),
(93, 85, 6, 1),
(94, 86, 12, 1),
(95, 87, 3, 1),
(96, 88, 6, 1),
(97, 89, 12, 1),
(98, 90, 7, 1),
(99, 91, 12, 1),
(100, 92, 15, 1),
(101, 93, 6, 1),
(102, 94, 12, 1),
(103, 95, 9, 1),
(104, 96, 12, 1),
(105, 97, 4, 1),
(109, 100, 8, 1),
(110, 101, 12, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `packages_terms_condition`
--

INSERT INTO `packages_terms_condition` (`packages_terms_condition_id`, `packages_terms_condition_packages_id_fk`, `terms_condition_id_fk`, `terms_condition_item_id_fk`, `packages_terms_condition_type`, `packages_terms_condition_details`, `packages_terms_condition_status`) VALUES
(1, 6, 4, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.\r\nHotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).\r\nExtra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.\r\nIf your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.\r\nProperties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.\r\nCab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.\r\nA photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.\r\nFor Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.\r\nKindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1),
(2, 7, 5, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(3, 7, 5, 0, 'Y', 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(4, 7, 5, 0, 'Y', 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(5, 7, 5, 0, 'Y', 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(6, 7, 5, 0, 'Y', 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(7, 7, 5, 0, 'Y', 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(8, 7, 5, 0, 'Y', 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(9, 7, 5, 0, 'Y', 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(10, 7, 5, 0, 'Y', 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1),
(11, 5, 5, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(12, 5, 5, 0, 'Y', 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(13, 5, 5, 0, 'Y', 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(14, 5, 5, 0, 'Y', 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(15, 5, 5, 0, 'Y', 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(16, 5, 5, 0, 'Y', 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(17, 5, 5, 0, 'Y', 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(18, 5, 5, 0, 'Y', 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(19, 5, 5, 0, 'Y', 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `package_category`
--

INSERT INTO `package_category` (`package_category_id`, `package_category_name`, `package_category_description`, `package_category_createdby_user_id`, `package_category_createdby_user_name`, `package_category_created_date`, `package_category_created_time`, `package_category_status`) VALUES
(1, 'gghjjjk', 'gj', 1, 'Super admin', '2025-08-29', '11:42:01', 0),
(2, 'JAm_edited', 'nn_edited', 1, 'Super admin', '2026-01-25', '03:23:34', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment_policies`
--

INSERT INTO `payment_policies` (`payment_policies_id`, `payment_policies_name`, `payment_policies_createdby_user_id`, `payment_policies_createdby_user_name`, `payment_policies_created_date`, `payment_policies_created_time`, `payment_policies_status`) VALUES
(1, 'cbc', 0, '', '2025-07-25', '08:22:16', 1),
(2, 'yuyu', 1, 'Super admin', '2025-09-13', '12:04:36', 1),
(3, 'a', 0, '', '2026-01-25', '03:45:18', 1),
(4, 'Test onr_edited', 0, '', '2026-01-25', '04:02:36', 0),
(5, 'KERALA - PP - 30%', 0, '', '2026-03-09', '10:26:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_policies_items`
--

CREATE TABLE `payment_policies_items` (
  `payment_policies_items_id` int(11) NOT NULL,
  `payment_policies_id_fk` int(11) NOT NULL,
  `payment_policies_items_name` varchar(255) NOT NULL,
  `payment_policies_items_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(10, 5, 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(11, 5, 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(12, 5, 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(13, 5, 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `priority_status`
--

INSERT INTO `priority_status` (`priority_status_id`, `priority_status_name`, `priority_status_button`, `priority_status_description`, `priority_status_created_date`, `priority_status_created_time`, `priority_status_created_user_id`, `priority_status_created_username`, `priority_status_created_status`) VALUES
(1, 'Hot', '<center><span class=\"btn btn-sm\" style=\"background-color:#ff0606\"><span style=\"color:white\">Hot</span></span></center>', '', '2024-11-19', '05:25:20', 1, 'Super admin', 1),
(2, 'cold', '<center><span class=\"btn btn-sm\" style=\"background-color:#bbcf30\"><span style=\"color:white\">cold</span></span></center>', 'sd', '2026-01-27', '19:50:56', 1, 'Super admin', 1),
(3, 'sd', '<center><span class=\"btn btn-sm\" style=\"background-color:#ff0000\"><span style=\"color:white\">sd</span></span></center>', '', '2026-01-27', '20:09:13', 1, 'Super admin', 1),
(4, 'snns', '<center><span class=\"btn btn-sm\" style=\"background-color:#3f13ec\"><span style=\"color:white\">snns</span></span></center>', 'asd', '2026-01-27', '20:22:13', 1, 'Super admin', 1),
(5, 'nn', '<center><span class=\"btn btn-sm\" style=\"background-color:#ff0000\"><span style=\"color:white\">nn</span></span></center>', 'n', '2026-01-28', '12:08:45', 1, 'Super admin', 1),
(6, 'mmm', '<center><span class=\"btn btn-sm\" style=\"background-color:#ff0000\"><span style=\"color:white\">mmm</span></span></center>', '', '2026-03-12', '21:12:57', 7, 'zsmsn', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`properties_id`, `property_category_id_fk`, `country_id_fk`, `state_id_fk`, `properties_destination_id_fk`, `properties_house_boat_type`, `properties_hotel_url`, `properties_name`, `properties_check_type`, `properties_check_in_time`, `properties_check_out_time`, `properties_sales_contact_name`, `properties_sales_contact_phone_number`, `properties_sales_contact_email`, `properties_reservation_contact_name`, `properties_reservation_contact_phone_number`, `properties_reservation_contact_email`, `properties_google_map_location`, `properties_hotel_logo`, `properties_photos`, `properties_description`, `properties_createdby_userid`, `properties_createdby_username`, `properties_create_date`, `properties_create_time`, `properties_status`) VALUES
(1, 1, 3, 4, 4, 'N', 'khk', 'Janath', 'T', '00:00:00', '00:00:00', 'gj', '5656', 'ggk', 'sfsdfsd', '34343', 'dfg_edited', 'uououo', 'Edappally_Monthly_Report_June_2025.pdf', 'Doc1.pdf', 'dgd', 0, '', '2025-07-31', '07:21:53', 1),
(2, 2, 3, 1, 4, 'Y', '', 'Majestic', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-31', '08:44:45', 1),
(3, 2, 3, 4, 1, 'Y', '', 'sds', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-08-01', '06:57:03', 1),
(4, 1, 2, 4, 4, 'Y', '', 'Trret', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-08-01', '10:31:20', 1),
(5, 2, 4, 4, 4, 'Y', 'sd_Edited', 'Test propery_Edited', 'T', '03:10:00', '13:15:00', 'sd_Edited', '20', 'sd@s_Edited', 'ds_Edited', '20', 'sd_Edited', 'sdf_Edited', '', '', 'sdf_Edited', 1, 'Super admin', '2026-01-25', '06:21:01', 1),
(6, 1, 99, 1, 1, 'Y', '', 'sddsxx', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-08', '02:08:39', 1),
(7, 1, 1, 1, 1, 'Y', '', 'sss', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', 'Polygon2.png', 'Polygon3.png', '', 1, 'Super admin', '2026-02-16', '07:53:14', 1),
(8, 1, 1, 1, 1, 'Y', '', 'anna', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '0ff023fa542bed1781b4d4b9c17590a9.png', 'e46a1aa1dfc9f76ea116d52343a0f9a5.png', '', 1, 'Super admin', '2026-02-16', '09:14:51', 1),
(9, 1, 3, 1, 1, 'Y', '', 'najsj', 'O', '00:00:00', '00:00:00', '', '', '', '', '', '', '', 'bf11a3874c552690118d2609aaafd207.png', '3c27097aca9694123280520d6d1da8d1.png', '', 1, 'Super admin', '2026-02-16', '09:18:30', 1),
(10, 1, 1, 1, 1, 'Y', '', 'kkalla', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', 'ecc665d1a33b3c779e4764304884fb5f.png', 'e5d4ab2e089e482b62a741b5b91eb170.png', '', 1, 'Super admin', '2026-02-16', '09:32:33', 1),
(11, 2, 1, 1, 4, 'Y', '', 'Nuiia', 'O', '11:29:00', '10:30:00', '', '', '', '', '', '', '', '79d97622bb6213f326d6b759314f4a5a.png', '06f024283855d81e8e33670897d0b312.png', '', 1, 'Super admin', '2026-02-16', '09:33:41', 1),
(12, 1, 1, 1, 1, 'Y', '', 'k mskks', 'O', '10:10:00', '22:50:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-16', '09:38:29', 1),
(13, 1, 1, 4, 1, 'Y', '', 'nmmn', 'O', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-16', '09:45:23', 1),
(14, 1, 2, 1, 1, 'Y', '', 'Kamam', 'O', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-16', '09:48:27', 1),
(15, 1, 1, 4, 4, 'Y', '', 'msms', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '49512e82add143c937e214fc426d0bdd.png', '', 1, 'Super admin', '2026-02-16', '10:14:13', 1),
(16, 1, 1, 1, 4, 'Y', '', 'ds', 'O', '10:05:00', '22:50:00', '', '', '', '', '', '', '', '29aeb09f12c6f332a8b11c0edfda745a.png', 'bc72a23f2f87253eb1d9dac80571fecb.png', '', 1, 'Super admin', '2026-02-16', '10:16:32', 1),
(17, 1, 1, 1, 1, 'Y', '_edird', 'yqqu_edird', 'T', NULL, NULL, 'sd m_edird', 'nm_edird', 'mnnm_edird', 'mnm_edird', 'mnnm_edird', 'mnmn_edird', 'mnmmn_edird', '965e7654a44e32f6ca151598681944af.pdf', 'a77ab4dbff420b38628451873e981904.png', 'sd_edird', 1, 'Super admin', '2026-02-16', '10:18:41', 1),
(18, 1, 1, 1, 1, 'Y', '', 'sd', 'T', NULL, NULL, '', '', '', '', '', '', '', 'dcc93515e985b563ea72eaf8736c2f89.pdf', '', '', 1, 'Super admin', '2026-02-16', '10:34:08', 1),
(19, 1, 1, 1, 1, 'Y', '', 'jj', 'O', '10:20:00', '09:25:00', '', '', '', '', '', '', '', 'ae99bfe2d44aa879cbd600e2b4ded270.pdf', 'e9f51edf07b19d16e1ffd7521851f6cd.pdf', '', 1, 'Super admin', '2026-02-16', '10:40:54', 1),
(20, 1, 10, 1, 1, 'Y', '', 'jsj', 'T', NULL, NULL, '', '', '', '', '', '', '', 'cd76063c7c1dcb3c70bd6736286fe87e.png', '', '', 1, 'Super admin', '2026-02-17', '08:35:34', 1),
(21, 1, 1, 1, 1, 'Y', '', 'shhs', 'T', NULL, NULL, '', '', '', '', '', '', '', 'da5960528f3e8bbe05ff07d8a7bb461e.jpg', 'ce4021bbf51059ac69e23c8d42325473.png', '', 1, 'Super admin', '2026-02-17', '09:10:00', 1),
(22, 0, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '10:42:59', 1),
(23, 0, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '10:43:42', 1),
(24, 0, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '10:44:03', 1),
(25, 1, 99, 1, 4, 'Y', '', 'snsn', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '10:44:50', 1),
(26, 0, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '10:45:10', 1),
(27, 0, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '10:45:32', 1),
(28, 0, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '10:46:30', 1),
(29, 0, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '11:10:10', 1),
(30, 2, 99, 0, 0, '', '', '', 'T', NULL, NULL, '', '', '', '', '', '', '', '', '', '', 1, 'Super admin', '2026-02-19', '11:11:55', 1),
(31, 1, 99, 1, 1, 'Y', '', 'nns', 'T', NULL, NULL, 'n', '9', '', '', '', '', '', 'e240fbd58658412156f56ff77bd90a59.jpg', 'a43f9b92a38a00f3b1f34794c88236a9.pdf', '', 1, 'Super admin', '2026-02-19', '11:14:51', 1),
(32, 1, 99, 4, 1, 'Y', '', 'hjnmn', 'T', NULL, NULL, '', '', '', '', '', '', '', '8d9140cdb31cc8b3f0f17316362457f0.png', '436804bca3fce4205f61107475095236.png', '', 1, 'Super admin', '2026-02-19', '11:43:25', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `properties_room_category`
--

INSERT INTO `properties_room_category` (`properties_room_category_id`, `properties_id_fk`, `room_meal_plan_id_fk`, `properties_room_category_name`, `properties_room_category_inventory`, `properties_room_category_number_of_adults_allowed`, `properties_room_category_children_allowed_on_bed_sharing_basis`, `properties_room_category_extra_bed_mattress_allowed_in_room`, `properties_room_category_welcomes_child_all_ages`, `properties_room_category_admission_restricted_guests_under_age`, `properties_room_category_complimentary_guest_between_type`, `properties_room_category_complimentary_guest_between_from_year`, `properties_room_category_complimentary_guest_between_to_year`, `properties_room_category_child_rate_applied_guest_between_type`, `properties_room_category_child_rate_applied_guest_from_year`, `properties_room_category_child_rate_applied_guest_to_year`, `properties_room_category_adult_rate_applied_guest_over`, `properties_room_category_photo`, `properties_room_category_description`, `properties_room_category_createdby_user_id`, `properties_room_category_createdby_user_name`, `properties_room_category_created_date`, `properties_room_category_created_time`, `properties_room_category_status`) VALUES
(1, 1, 1, 'Deluxe premium', '3', 3, 4, 5, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '6', '7', '', '', 0, '', '2025-08-12', '08:20:27', 1),
(2, 1, 1, 'Standard room', '3', 7, 8, 8, 'N', '7', 'N', '', NULL, 'N', '', NULL, '7', '', '', 0, '', '2025-08-12', '08:21:51', 1),
(3, 3, 2, 'Jaguar room deluxe', '0', 6, 7, 6, 'Y', NULL, 'N', '', NULL, 'N', '', NULL, '', '', '', 0, '', '2025-08-12', '08:37:08', 1),
(4, 3, 1, 'Large room', '0', 7, 8, 8, 'Y', NULL, 'N', '', NULL, 'N', '', NULL, '', '', '', 0, '', '2025-08-12', '08:38:21', 1),
(5, 1, 1, 'lp', '7', 7, 7, 8, 'Y', NULL, 'Y', '0', '8', 'Y', '9', '9', '10', '', 'h', 1, 'Super admin', '2025-09-06', '04:20:48', 0),
(6, 2, 1, 'Standard', '1', 1, 2, 2, 'Y', NULL, 'N', '', NULL, 'Y', '', '1', '2', '', '', 1, 'Super admin', '2025-12-22', '02:19:31', 1),
(7, 2, 1, 'High Premium', '', 1, 2, 2, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '4', '5', '', '', 1, 'Super admin', '2025-12-22', '02:22:53', 1),
(8, 4, 1, 'Classic', '', 1, 2, 2, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '3', '4', '', '', 1, 'Super admin', '2025-12-22', '02:32:48', 1),
(9, 4, 1, 'Modern', '', 2, 3, 2, 'Y', NULL, 'Y', '0', '3', 'Y', '4', '2', '4', '', '', 1, 'Super admin', '2025-12-22', '02:33:25', 1),
(10, 1, 1, 'Realastic', '', 1, 2, 2, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '3', '4', '', '', 1, 'Super admin', '2025-12-22', '03:25:04', 1),
(11, 5, 1, 'Test room', '9', 9, 9, 9, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '4', '5', '', 's', 1, 'Super admin', '2026-01-25', '06:53:16', 0),
(12, 6, 2, 'newmmsss', '', 2, 3, 2, 'Y', '', 'Y', '0', '5', 'Y', '6', '11', '12', '', '', 1, 'Super admin', '2026-02-08', '02:23:48', 1),
(13, 21, 1, 'nbn', '', 1, 2, 2, 'Y', NULL, 'Y', '0', '1', 'Y', '2', '2', '3', '', '', 1, 'Super admin', '2026-02-19', '08:40:56', 1),
(14, 21, 1, 'nms', '1', 1, 2, 2, 'Y', NULL, 'Y', '0', '2', 'Y', '3', '3', '4', '', '', 1, 'Super admin', '2026-02-19', '11:11:19', 1),
(15, 32, 1, 'nsm', '1', 1, 9, 8, 'Y', '', 'Y', '0', '8', 'Y', '9', '12', '13', '', 'sdaqq', 1, 'Super admin', '2026-02-19', '03:26:30', 1),
(16, 2, 2, 'ajja', '19', 18, 8, 18, 'Y', NULL, 'Y', '0', '4', 'Y', '5', '9', '10', '', 'ds', 1, 'Super admin', '2026-02-20', '11:58:02', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_category`
--

INSERT INTO `property_category` (`property_category_id`, `property_category_name`, `property_category_description`, `property_category_createdby_user_id`, `property_category_createdby_user_name`, `property_category_created_date`, `property_category_created_time`, `property_category_status`) VALUES
(1, '5 star', 'hk', 0, '', '2025-07-20', '10:06:07', 1),
(2, '3 star dxffd', 'sds', 0, '', '2025-07-20', '10:06:28', 1),
(3, 'jhjh', 'hj', 0, '', '2025-07-20', '10:06:58', 0),
(4, 'jhbhj', 'hg', 0, '', '2025-07-20', '10:07:39', 0),
(5, 'Test name_edited', 'nedited', 1, 'Super admin', '2026-01-24', '08:19:40', 0);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `property_inclusions`
--

INSERT INTO `property_inclusions` (`property_inclusions_id`, `property_id_fk`, `property_inclusions_name`, `property_inclusions_amount`, `property_inclusions_description`, `property_inclusions_created_date`, `property_inclusions_created_time`, `property_inclusions_created_by_userid`, `property_inclusions_created_by_username`, `property_inclusions_status`) VALUES
(1, 32, 'jjsedDD', 911991, 'asaDDS', '2026-02-19', '03:08:41', 1, 'Super admin', 0),
(2, 32, 'dnnms', 192, 'fsd', '2026-02-19', '03:19:31', 1, 'Super admin', 0),
(3, 2, 'nanedi', 172, 'dds', '2026-02-20', '12:00:05', 1, 'Super admin', 0),
(4, 32, 'kk', 4, '', '2026-02-27', '03:29:18', 1, 'Super admin', 0),
(5, 32, 'kk', 5, '', '2026-02-27', '03:29:52', 1, 'Super admin', 1),
(6, 4, 'Jaja', 100, 'ds', '2026-04-06', '08:22:09', 1, 'Super admin', 1),
(7, 3, 'ksks', 100, '', '2026-04-06', '08:22:37', 1, 'Super admin', 1),
(8, 6, 'mnnm', 200, '', '2026-04-07', '01:17:17', 1, 'Super admin', 1);

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
  `quotation_special_requirement_type` varchar(255) NOT NULL,
  `quotation_property_inclusion_type` varchar(255) NOT NULL,
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation`
--

INSERT INTO `quotation` (`quotation_id`, `leads_id_fk`, `package_id_fk`, `quotation_date`, `arriving_destination`, `departuring_destination`, `quotation_number`, `quotation_current_status`, `total_inclusion_amount`, `total_special_requirment_amount`, `quotation_special_requirement_type`, `quotation_property_inclusion_type`, `quotation_inclusion_exclusion_common_id_fk`, `quotation_inclusion_exclusion_checked_type`, `quotation_optional_add_on_checked_type`, `quotation_payment_policies_checked_type`, `quotation_terms_conditions_checked_type`, `quotation_cancellation_policy_checked_type`, `quotation_notes_checked_type`, `quotation_title`, `quotation_first_cover_page`, `quotation_last_cover_page`, `quotation_remarks`, `quotation_created_by_userid`, `quotation_created_by_username`, `quotation_created_date`, `quotation_created_time`, `quotation_status`) VALUES
(1, 2, 5, '2026-04-09', 'mn', 'nb', 'Quot-1', 1, 0, 0, '', '', '3', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'new templ', 'quotation_cover_69d74f53eacc2.jpg', 'quotation_cover_69d74f53f0449.jpg', '', 1, 'Super admin', '2026-04-09', '12:33:47', 1),
(2, 2, 5, '2026-04-09', 'hgv', 'hg', 'Quot-2', 1, 0, 0, '', '', '3', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'new templ', 'quotation_cover_69d7752be93e4.jpg', 'quotation_cover_69d7752bee761.jpg', '', 1, 'Super admin', '2026-04-09', '03:15:15', 1),
(3, 2, 5, '2026-04-09', 'ghvg', 'gfgf', 'Quot-3', 1, 0, 0, '', '', '3', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'new templ', 'quotation_cover_69d776aa42351.jpg', 'quotation_cover_69d776aa44b80.jpg', 'ng', 1, 'Super admin', '2026-04-09', '03:21:38', 1),
(4, 2, 5, '2026-04-09', 'hjj', 'jhhj', 'Quot-4', 4, 100, 20, '', '', '3', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'new templ', 'quotation_cover_69d7795dcccb2.jpg', 'quotation_cover_69d7795dcf3fe.jpg', '', 1, 'Super admin', '2026-04-09', '03:33:09', 1),
(5, 2, 5, '2026-04-09', 'nbn', 'nnbh', 'Quot-5', 1, 300, 97, '', '', '3', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'new templ', 'quotation_cover_69d7aa0e1fb55.jpg', 'quotation_cover_69d7aa0e23729.jpg', '', 1, 'Super admin', '2026-04-09', '07:00:54', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_cancellation_policies`
--

INSERT INTO `quotation_cancellation_policies` (`quotation_cancellation_policies_id`, `quotation_id_fk`, `packages_cancellation_policies_id_fk`, `quotation_cancellation_policies_id_fk`, `quotation_cancellation_policies_item_id_fk`, `quotation_cancellation_policies_type`, `quotation_cancellation_policies_details`, `quotation_cancellation_policies_status`) VALUES
(1, 1, 3, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1),
(2, 1, 3, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1),
(3, 2, 3, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1),
(4, 3, 3, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1),
(5, 4, 3, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1),
(6, 5, 3, 3, 0, 'Y', 'If the client is willing to amend or cancel his/her booking because of\r\nwhatsoever reasons including accident, illness or any other personal\r\nreasons ,the charges levied will be as follows :-\r\n30 to 20 days prior to departure of the tour, 50% of total tour cost.\r\n19 to 10 days prior to departure of the tour, 75% of total tour cost.\r\n09 to 01 days prior to departure of the tour, 100% of total tour cost.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_exclusion`
--

INSERT INTO `quotation_exclusion` (`quotation_exclusion_id`, `quotation_id_fk`, `packages_exclusions_id_fk`, `quotation_exclusions_common_id_fk`, `quotation_exclusions_id_fk`, `quotation_exclusions_type`, `quotation_exclusions_details`, `quotation_exclusion_status`) VALUES
(1, 1, 11, 3, 0, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(2, 1, 12, 3, 0, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(3, 1, 13, 3, 0, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(4, 1, 14, 3, 0, 'Y', 'Any entry fees/Camera Fees.', 1),
(5, 1, 15, 3, 0, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(6, 1, 11, 3, 0, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(7, 1, 12, 3, 0, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(8, 1, 13, 3, 0, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(9, 1, 14, 3, 0, 'Y', 'Any entry fees/Camera Fees.', 1),
(10, 1, 15, 3, 0, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(11, 2, 11, 3, 0, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(12, 2, 12, 3, 0, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(13, 2, 13, 3, 0, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(14, 2, 14, 3, 0, 'Y', 'Any entry fees/Camera Fees.', 1),
(15, 2, 15, 3, 0, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(16, 3, 11, 3, 0, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(17, 3, 12, 3, 0, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(18, 3, 13, 3, 0, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(19, 3, 14, 3, 0, 'Y', 'Any entry fees/Camera Fees.', 1),
(20, 3, 15, 3, 0, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(21, 4, 11, 3, 0, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(22, 4, 12, 3, 0, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(23, 4, 13, 3, 0, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(24, 4, 14, 3, 0, 'Y', 'Any entry fees/Camera Fees.', 1),
(25, 4, 15, 3, 0, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1),
(26, 5, 11, 3, 0, 'Y', 'Extra Meals other than mentioned in inclusions', 1),
(27, 5, 12, 3, 0, 'Y', 'Anything else that is not mentioned in the inclusions', 1),
(28, 5, 13, 3, 0, 'Y', 'Personal expenses such as tips, telephone calls, laundry, medication etc.', 1),
(29, 5, 14, 3, 0, 'Y', 'Any entry fees/Camera Fees.', 1),
(30, 5, 15, 3, 0, 'Y', 'Any Activities like Adventure activity, Jungle Safari, Boating, Water\r\nSports..etc charges', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_inclusions`
--

INSERT INTO `quotation_inclusions` (`quotation_inclusions`, `quotation_id_fk`, `packages_inclusions_id_fk`, `quotation_inclusion_common_id_fk`, `quotation_inclusions_id_fk`, `quotation_inclusions_type`, `quotation_inclusions_details`, `quotation_inclusions_status`) VALUES
(1, 1, 13, 3, 0, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(2, 1, 14, 3, 0, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(3, 1, 15, 3, 0, 'Y', 'Resort with Breakfast', 1),
(4, 1, 16, 3, 0, 'Y', 'Houseboat with all meals', 1),
(5, 1, 17, 3, 0, 'Y', 'Sightseeing as per itinerary', 1),
(6, 1, 18, 3, 0, 'Y', 'A Professional Driver cum Guide', 1),
(7, 1, 13, 3, 0, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(8, 1, 14, 3, 0, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(9, 1, 15, 3, 0, 'Y', 'Resort with Breakfast', 1),
(10, 1, 16, 3, 0, 'Y', 'Houseboat with all meals', 1),
(11, 1, 17, 3, 0, 'Y', 'Sightseeing as per itinerary', 1),
(12, 1, 18, 3, 0, 'Y', 'A Professional Driver cum Guide', 1),
(13, 2, 13, 3, 0, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(14, 2, 14, 3, 0, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(15, 2, 15, 3, 0, 'Y', 'Resort with Breakfast', 1),
(16, 2, 16, 3, 0, 'Y', 'Houseboat with all meals', 1),
(17, 2, 17, 3, 0, 'Y', 'Sightseeing as per itinerary', 1),
(18, 2, 18, 3, 0, 'Y', 'A Professional Driver cum Guide', 1),
(19, 3, 13, 3, 0, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(20, 3, 14, 3, 0, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(21, 3, 15, 3, 0, 'Y', 'Resort with Breakfast', 1),
(22, 3, 16, 3, 0, 'Y', 'Houseboat with all meals', 1),
(23, 3, 17, 3, 0, 'Y', 'Sightseeing as per itinerary', 1),
(24, 3, 18, 3, 0, 'Y', 'A Professional Driver cum Guide', 1),
(25, 4, 13, 3, 0, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(26, 4, 14, 3, 0, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(27, 4, 15, 3, 0, 'Y', 'Resort with Breakfast', 1),
(28, 4, 16, 3, 0, 'Y', 'Houseboat with all meals', 1),
(29, 4, 17, 3, 0, 'Y', 'Sightseeing as per itinerary', 1),
(30, 4, 18, 3, 0, 'Y', 'A Professional Driver cum Guide', 1),
(31, 5, 13, 3, 0, 'Y', 'Airport pick up and drop as per your flight/Train timings Private Taxi\r\nbased on number of people (Fuel ,parking , Tax Permit & toll taxes all\r\nincluded)', 1),
(32, 5, 14, 3, 0, 'Y', 'Accommodation (3 NIGHTS )\r\n2 nights in Hotel/Resort stay & 1 night Houseboat stay', 1),
(33, 5, 15, 3, 0, 'Y', 'Resort with Breakfast', 1),
(34, 5, 16, 3, 0, 'Y', 'Houseboat with all meals', 1),
(35, 5, 17, 3, 0, 'Y', 'Sightseeing as per itinerary', 1),
(36, 5, 18, 3, 0, 'Y', 'A Professional Driver cum Guide', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_itinerary`
--

INSERT INTO `quotation_itinerary` (`quotation_itinerary_id`, `quotation_id_fk`, `packages_itinerary_id_fk`, `quotation_itineraries_id_fk`, `quotation_itinerary_status`) VALUES
(1, 1, 19, 1, 1),
(2, 2, 19, 1, 1),
(3, 3, 19, 1, 1),
(4, 4, 19, 1, 1),
(5, 5, 19, 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_itinerary_days`
--

INSERT INTO `quotation_itinerary_days` (`quotation_itinerary_days_id`, `quotation_id_fk`, `packages_itinerary_days_id_fk`, `quotation_itinerary_id_fk`, `quotation_days_id_fk`, `quotation_itineraries_days_day`, `quotation_itineraries_days_destination_id_fk`, `quotation_itineraries_days_title`, `quotation_itineraries_days_image`, `quotation_itineraries_days_description`, `quotation_itineraries_days_travel_back`, `quotation_itineraries_days_required_status`, `quotation_itinerary_days_status`) VALUES
(1, 1, 58, 1, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'quotation_day_69d74f5408143.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(2, 1, 59, 1, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'quotation_day_69d74f540e1ec.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(3, 1, 60, 1, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'quotation_day_69d74f54168c5.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 2, 1),
(4, 2, 58, 2, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'quotation_day_69d7752c062f0.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(5, 2, 59, 2, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'quotation_day_69d7752c0a6d5.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(6, 2, 60, 2, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'quotation_day_69d7752c0fce4.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 2, 1),
(7, 3, 58, 3, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'quotation_day_69d776aa49232.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(8, 3, 59, 3, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'quotation_day_69d776aa4b971.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(9, 3, 60, 3, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'quotation_day_69d776aa4f98c.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 2, 1),
(10, 4, 58, 4, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'quotation_day_69d7795dd6b66.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(11, 4, 59, 4, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'quotation_day_69d7795dd89c9.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(12, 4, 60, 4, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'quotation_day_69d7795ddb3e4.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 2, 1),
(13, 5, 58, 5, 1, 'Day 1', 4, 'COCHIN TO MUNNAR', 'quotation_day_69d7aa0e2a57a.jpg', '<p>After arrival in Cochin International Airport/Railway. Pickup and proceed to <strong>Munnar</strong> (The green Paradise of Kerala)</p><p>On the way visit <strong>Neriamangalam Forest, Cheeyappara and Valara Waterfalls</strong> along with the lovely valleys and foggy hills. Enjoy a guided tour of the lush <strong>Spice Garden</strong>, where you will learn about various spices, herbs and medicinal plants.</p><p>Other Sightseeing/Activity places:- Adventure Park (Zip line, Giant Swing, Bali swing..etc) , Handloom &amp; Chocolate Factory, Hot Air Balloon</p><p>Overnight stay at the Hotel / Resort</p>', '', 0, 1),
(14, 5, 59, 5, 2, 'Day 2', 1, 'MUNNAR SIGHTSEEING', 'quotation_day_69d7aa0e2d873.jpg', '<p>After breakfast get ready to explore the city of Mu<strong>nnar, Visit </strong>Rose Garden, Boating in Mattupetty Dam, Tea Factory/ Museum, Photo Point, Elephant Park, Echo Point.</p><p>Afternoon you will head towards the <strong>Eravikulam National park</strong> where the endangering Nilgiri Tahr is conserved and which also the prime attraction of Munnar to have a soft trekking.</p><p>You can enjoy the breath taking view of entire Munnar hills. Later drive back to your hotel/resort</p><p>Overnight stay At Munnar</p>', '', 0, 1),
(15, 5, 60, 5, 3, 'Day 3', 4, 'MUNNAR TO THEKKADY', 'quotation_day_69d7aa0e3190d.jpeg', '<p>After breakfast, checkout from the hotel/Resort and drive towards <strong>Thekkady</strong>; Gateway to the Periyar National Park</p><p>Take a boat cruise on Periyar Lake in <strong>Periyar Tiger Reserve</strong>, which offers stunning views of the surrounding forests and the chance to</p><p>spot wildlife like elephants, deer, and birds. Experience a memorable <strong>Elephant encounter</strong> with rides, bathing, and feeding</p><ol><li>End the evening with mesmerizing cultural performances of <i>Kathakali and Kerala’s traditional martial arts</i></li></ol><p>Overnight stay in the Hotel/ Resort.</p>', 'TB', 2, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_notes`
--

INSERT INTO `quotation_notes` (`quotation_notes_id`, `quotation_id_fk`, `packages_notes_id_fk`, `quotation_notes_details`, `quotation_notes_status`) VALUES
(1, 1, 9, 'Any entry fees/Camera Fees.', 1),
(2, 1, 10, 'Any entry fees/Camera Fees.', 1),
(3, 1, 11, 'Any entry fees/Camera Fees.', 1),
(4, 1, 9, 'Any entry fees/Camera Fees.', 1),
(5, 1, 10, 'Any entry fees/Camera Fees.', 1),
(6, 1, 11, 'Any entry fees/Camera Fees.', 1),
(7, 2, 9, 'Any entry fees/Camera Fees.', 1),
(8, 2, 10, 'Any entry fees/Camera Fees.', 1),
(9, 2, 11, 'Any entry fees/Camera Fees.', 1),
(10, 3, 9, 'Any entry fees/Camera Fees.', 1),
(11, 3, 10, 'Any entry fees/Camera Fees.', 1),
(12, 3, 11, 'Any entry fees/Camera Fees.', 1),
(13, 4, 9, 'Any entry fees/Camera Fees.', 1),
(14, 4, 10, 'Any entry fees/Camera Fees.', 1),
(15, 4, 11, 'Any entry fees/Camera Fees.', 1),
(16, 5, 9, 'Any entry fees/Camera Fees.', 1),
(17, 5, 10, 'Any entry fees/Camera Fees.', 1),
(18, 5, 11, 'Any entry fees/Camera Fees.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_optional_add_on`
--

INSERT INTO `quotation_optional_add_on` (`quotation_optional_add_on_id`, `quotation_id_fk`, `packages_optional_add_on_id_fk`, `quotation_optional_add_on_details`, `quotation_optional_add_on_status`) VALUES
(1, 1, 10, 'Any entry fees/Camera Fees.', 1),
(2, 1, 11, 'Any entry fees/Camera Fees.', 1),
(3, 1, 12, 'Any entry fees/Camera Fees.', 1),
(4, 1, 10, 'Any entry fees/Camera Fees.', 1),
(5, 1, 11, 'Any entry fees/Camera Fees.', 1),
(6, 1, 12, 'Any entry fees/Camera Fees.', 1),
(7, 2, 10, 'Any entry fees/Camera Fees.', 1),
(8, 2, 11, 'Any entry fees/Camera Fees.', 1),
(9, 2, 12, 'Any entry fees/Camera Fees.', 1),
(10, 3, 10, 'Any entry fees/Camera Fees.', 1),
(11, 3, 11, 'Any entry fees/Camera Fees.', 1),
(12, 3, 12, 'Any entry fees/Camera Fees.', 1),
(13, 4, 10, 'Any entry fees/Camera Fees.', 1),
(14, 4, 11, 'Any entry fees/Camera Fees.', 1),
(15, 4, 12, 'Any entry fees/Camera Fees.', 1),
(16, 5, 10, 'Any entry fees/Camera Fees.', 1),
(17, 5, 11, 'Any entry fees/Camera Fees.', 1),
(18, 5, 12, 'Any entry fees/Camera Fees.', 1);

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
  `quotation_options_total_cost` double NOT NULL,
  `quotation_options_margin_type` varchar(250) NOT NULL,
  `quotation_options_margin_value` double NOT NULL,
  `quotation_options_total_quote_rate` double NOT NULL,
  `quotation_options_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_options`
--

INSERT INTO `quotation_options` (`quotation_options_id`, `quotation_id_fk`, `packages_properties_common_id_fk`, `quotation_options_title`, `quotation_options_cab_amount`, `quotation_options_design_type`, `quotation_options_vehicle_id_fk`, `quotation_options_room_category_display`, `quotation_options_meal_plan_display`, `quotation_options_total_cost`, `quotation_options_margin_type`, `quotation_options_margin_value`, `quotation_options_total_quote_rate`, `quotation_options_status`) VALUES
(1, 1, 28, 'mn', 9, 'Standard', 10, '1', '1', 142, 'amount', 10, 152, 1),
(2, 2, 28, 'nbbn', 55, 'Standard', 1, '1', '1', 222, 'amount', 77, 299, 1),
(3, 3, 28, 'mhjjh', 6, 'Standard', 10, '1', '1', 167, 'amount', 66, 233, 1),
(4, 4, 28, 'jhhj', 44, 'Standard', 1, '1', '1', 204, 'amount', 6, 210, 1),
(5, 5, 28, 'bbbn', 66, 'Standard', 13, '1', '1', 221, 'amount', 7, 228, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_payment_policies`
--

INSERT INTO `quotation_payment_policies` (`quotation_payment_policies_id`, `quotation_id_fk`, `packages_payment_policies_id_fk`, `quotation_policies_id_fk`, `quotation_policies_items_id_fk`, `quotation_payment_policies_type`, `quotation_payment_policies_details`, `quotation_payment_policies_status`) VALUES
(1, 1, 9, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(2, 1, 10, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(3, 1, 11, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(4, 1, 12, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(5, 1, 9, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(6, 1, 10, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(7, 1, 11, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(8, 1, 12, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(9, 2, 9, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(10, 2, 10, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(11, 2, 11, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(12, 2, 12, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(13, 3, 9, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(14, 3, 10, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(15, 3, 11, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(16, 3, 12, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(17, 4, 9, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(18, 4, 10, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(19, 4, 11, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(20, 4, 12, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(21, 5, 9, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(22, 5, 10, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(23, 5, 11, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1),
(24, 5, 12, 5, 0, 'Y', 'Book your seat by an advance payment of 30% of the total tour cost\r\nand the full remaining amount has to be paid after arrival.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_properties`
--

INSERT INTO `quotation_properties` (`quotation_properties_id`, `quotation_properties_days_id_fk`, `packages_properties_id_fk`, `properties_id_fk`, `quotation_properties_status`) VALUES
(1, 1, 100, 4, 1),
(2, 2, 101, 6, 1),
(3, 3, 100, 4, 1),
(4, 4, 101, 6, 1),
(5, 5, 100, 4, 1),
(6, 6, 101, 6, 1),
(7, 7, 100, 4, 1),
(8, 8, 101, 6, 1),
(9, 9, 100, 4, 1),
(10, 10, 101, 6, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_properties_days`
--

INSERT INTO `quotation_properties_days` (`quotation_properties_days_id`, `quotation_id_fk`, `quotation_options_id_fk`, `packages_properties_days_id_fk`, `quotation_itinerary_days_id_fk`, `quotation_properties_days_day`, `quotation_properties_days_destination_id_fk`, `quotation_properties_days_status`) VALUES
(1, 1, 1, 94, 0, 'Day 1', 4, 1),
(2, 1, 1, 95, 0, 'Day 2', 1, 1),
(3, 2, 2, 94, 0, 'Day 1', 4, 1),
(4, 2, 2, 95, 0, 'Day 2', 1, 1),
(5, 3, 3, 94, 0, 'Day 1', 4, 1),
(6, 3, 3, 95, 0, 'Day 2', 1, 1),
(7, 4, 4, 94, 0, 'Day 1', 4, 1),
(8, 4, 4, 95, 0, 'Day 2', 1, 1),
(9, 5, 5, 94, 0, 'Day 1', 4, 1),
(10, 5, 5, 95, 0, 'Day 2', 1, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_properties_rooms`
--

INSERT INTO `quotation_properties_rooms` (`quotation_properties_rooms_id`, `quotation_properties_id_fk`, `packages_properties_rooms_id_fk`, `quotation_properties_rooms_id_fk`, `total_room_cost`, `quotation_properties_rooms_status`) VALUES
(1, 1, 109, 8, 129, 1),
(2, 2, 110, 12, 4, 1),
(3, 3, 109, 8, 129, 1),
(4, 3, 0, 9, 137, 1),
(5, 4, 110, 12, 30, 1),
(6, 5, 109, 8, 129, 1),
(7, 5, 0, 9, 137, 1),
(8, 6, 110, 12, 24, 1),
(9, 7, 109, 8, 129, 1),
(10, 8, 110, 12, 31, 1),
(11, 9, 109, 8, 129, 1),
(12, 10, 110, 12, 26, 1);

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
  `inclusion_name` varchar(255) NOT NULL,
  `inclusion_amount` double NOT NULL,
  `quotation_property_inclusions_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_property_inclusions`
--

INSERT INTO `quotation_property_inclusions` (`quotation_property_inclusions_id`, `quotation_id_fk`, `packages_properties_days_id_fk`, `quotation_itinerary_days_id_fk`, `quotation_properties_days_id_fk`, `stay_destination_id_fk`, `accommodation_date`, `inclusion_property_id_fk`, `property_inclusions_id_fk`, `inclusion_name`, `inclusion_amount`, `quotation_property_inclusions_status`) VALUES
(1, 4, 58, 0, 0, 4, '2026-04-01', 4, 6, 'Jaja', 100, 1),
(2, 5, 58, 13, 9, 4, '2026-04-01', 4, 6, 'Jaja', 100, 1),
(3, 5, 59, 14, 10, 1, '2026-04-02', 6, 8, 'mnnm', 200, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_room_tariff_details`
--

INSERT INTO `quotation_room_tariff_details` (`quotation_room_tariff_details_id`, `quotation_id_fk`, `packages_properties_days_id_fk`, `quotation_properties_rooms_id_fk`, `pax_wise_bed_adult_db_count`, `pax_wise_bed_adult_eb_count`, `pax_wise_bed_adult_sgl_count`, `pax_wise_bed_child_db_count`, `pax_wise_bed_child_eb_count`, `pax_wise_bed_child_sb_count`, `pax_wise_bed_baby_db_count`, `pax_wise_bed_baby_eb_count`, `pax_wise_bed_baby_sb_count`, `room_unit_auto_count`, `room_unit_auto_rate`, `room_unit_auto_total_rate`, `room_unit_manual_count`, `room_unit_manual_rate`, `room_unit_manual_total_rate`, `extra_bed_adult_auto_count`, `extra_bed_adult_auto_rate`, `extra_bed_adult_auto_total_rate`, `extra_bed_adult_manual_count`, `extra_bed_adult_manual_rate`, `extra_bed_adult_manual_total_rate`, `extra_bed_child_auto_count`, `extra_bed_child_auto_rate`, `extra_bed_child_auto_total_rate`, `extra_bed_child_manual_count`, `extra_bed_child_manual_rate`, `extra_bed_child_manual_total_rate`, `child_sharing_bed_auto_count`, `child_sharing_bed_auto_rate`, `child_sharing_bed_auto_total_rate`, `child_sharing_bed_manual_count`, `child_sharing_bed_manual_rate`, `child_sharing_bed_manual_total_rate`, `single_occupancy_auto_count`, `single_occupancy_auto_rate`, `single_occupancy_auto_total_rate`, `single_occupancy_manual_count`, `single_occupancy_manual_rate`, `single_occupancy_manual_total_rate`, `supplyment_auto_cost`, `supplyment_auto_total_cost`, `supplyment_manual_cost`, `supplyment_manual_total_cost`, `auto_total_rate`, `manual_total_rate`, `quotation_room_tariff_details_status`) VALUES
(1, 0, 58, 109, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 9, 0, '0', 9, 0, '2', 8, 16, '2', 8, 16, '0', 9, 0, '0', 9, 0, 105, 105, 105, 105, 129, 129, 1),
(2, 1, 58, 109, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 9, 0, '0', 9, 0, '2', 8, 16, '2', 8, 16, '0', 9, 0, '0', 9, 0, 105, 105, 105, 105, 129, 129, 1),
(3, 1, 59, 110, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 0, 0, '1', 1, 1, '0', 0, 0, '0', 0, 0, '0', 0, 0, '0', 0, 0, '2', 0, 0, '2', 1, 2, '1', 0, 0, '1', 1, 1, 0, 0, 0, 0, 0, 4, 1),
(4, 2, 58, 109, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 9, 0, '0', 9, 0, '2', 8, 16, '2', 8, 16, '0', 9, 0, '0', 9, 0, 105, 105, 105, 105, 129, 129, 1),
(5, 2, 58, 0, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 8, 0, '0', 8, 0, '2', 8, 16, '2', 8, 16, '1', 8, 8, '1', 8, 8, 105, 105, 105, 105, 137, 137, 1),
(6, 2, 59, 110, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 0, 0, '1', 6, 6, '0', 0, 0, '0', 0, 0, '0', 0, 0, '0', 0, 0, '2', 0, 0, '2', 8, 16, '1', 0, 0, '1', 8, 8, 0, 0, 0, 0, 0, 30, 1),
(7, 3, 58, 6, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 9, 0, '0', 9, 0, '2', 8, 16, '2', 8, 16, '0', 9, 0, '0', 9, 0, 105, 105, 105, 105, 129, 129, 1),
(8, 3, 58, 7, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 8, 0, '0', 8, 0, '2', 8, 16, '2', 8, 16, '1', 8, 8, '1', 8, 8, 105, 105, 105, 105, 137, 137, 1),
(9, 3, 59, 8, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 0, 0, '1', 6, 6, '0', 0, 0, '0', 0, 0, '0', 0, 0, '0', 0, 0, '2', 0, 0, '2', 6, 12, '1', 0, 0, '1', 6, 6, 0, 0, 0, 0, 0, 24, 1),
(10, 4, 58, 9, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 9, 0, '0', 9, 0, '2', 8, 16, '2', 8, 16, '0', 9, 0, '0', 9, 0, 105, 105, 105, 105, 129, 129, 1),
(11, 4, 59, 10, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 0, 0, '1', 7, 7, '0', 0, 0, '0', 0, 0, '0', 0, 0, '0', 0, 0, '2', 0, 0, '2', 8, 16, '1', 0, 0, '1', 8, 8, 0, 0, 0, 0, 0, 31, 1),
(12, 5, 58, 11, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 9, 0, '0', 9, 0, '2', 8, 16, '2', 8, 16, '0', 9, 0, '0', 9, 0, 105, 105, 105, 105, 129, 129, 1),
(13, 5, 59, 12, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 0, 0, '1', 7, 7, '0', 0, 0, '0', 0, 0, '0', 0, 0, '0', 0, 0, '2', 0, 0, '2', 6, 12, '1', 0, 0, '1', 7, 7, 0, 0, 0, 0, 0, 26, 1),
(14, 0, 58, 109, '1', '0', '0', '0', '0', '2', '0', '0', '0', '1', 8, 8, '1', 8, 8, '0', 8, 0, '0', 8, 0, '0', 9, 0, '0', 9, 0, '2', 8, 16, '2', 8, 16, '0', 9, 0, '0', 9, 0, 105, 105, 105, 105, 129, 129, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_special_requirements`
--

INSERT INTO `quotation_special_requirements` (`quotation_special_requirements_id`, `quotation_id_fk`, `packages_properties_days_id_fk`, `quotation_itinerary_days_id_fk`, `quotation_properties_days_id_fk`, `stay_destination_id_fk`, `quotation_special_requirements_id_fk`, `accommodation_date`, `quotation_special_requirements_cost`, `quotation_special_requirements_status`) VALUES
(1, 4, 59, 0, 0, 1, 3, '2026-04-02', 20, 1),
(2, 5, 58, 13, 9, 4, 3, '2026-04-01', 20, 1),
(3, 5, 59, 14, 10, 1, 1, '2026-04-02', 77, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `quotation_terms_condition`
--

INSERT INTO `quotation_terms_condition` (`quotation_terms_condition_id`, `quotation_id_fk`, `packages_terms_condition_id_fk`, `quotation_terms_condition_id_fk`, `quotation_terms_condition_item_id_fk`, `quotation_terms_condition_type`, `quotation_terms_condition_details`, `quotation_terms_condition_status`) VALUES
(1, 1, 11, 5, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(2, 1, 12, 5, 0, 'Y', 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(3, 1, 13, 5, 0, 'Y', 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(4, 1, 14, 5, 0, 'Y', 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(5, 1, 15, 5, 0, 'Y', 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(6, 1, 16, 5, 0, 'Y', 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(7, 1, 17, 5, 0, 'Y', 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(8, 1, 18, 5, 0, 'Y', 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(9, 1, 19, 5, 0, 'Y', 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1),
(10, 1, 11, 5, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(11, 1, 12, 5, 0, 'Y', 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(12, 1, 13, 5, 0, 'Y', 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(13, 1, 14, 5, 0, 'Y', 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(14, 1, 15, 5, 0, 'Y', 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(15, 1, 16, 5, 0, 'Y', 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(16, 1, 17, 5, 0, 'Y', 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(17, 1, 18, 5, 0, 'Y', 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(18, 1, 19, 5, 0, 'Y', 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1),
(19, 2, 11, 5, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(20, 2, 12, 5, 0, 'Y', 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(21, 2, 13, 5, 0, 'Y', 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(22, 2, 14, 5, 0, 'Y', 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(23, 2, 15, 5, 0, 'Y', 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(24, 2, 16, 5, 0, 'Y', 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(25, 2, 17, 5, 0, 'Y', 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(26, 2, 18, 5, 0, 'Y', 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(27, 2, 19, 5, 0, 'Y', 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1),
(28, 3, 11, 5, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(29, 3, 12, 5, 0, 'Y', 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(30, 3, 13, 5, 0, 'Y', 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(31, 3, 14, 5, 0, 'Y', 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(32, 3, 15, 5, 0, 'Y', 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(33, 3, 16, 5, 0, 'Y', 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(34, 3, 17, 5, 0, 'Y', 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(35, 3, 18, 5, 0, 'Y', 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(36, 3, 19, 5, 0, 'Y', 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1),
(37, 4, 11, 5, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(38, 4, 12, 5, 0, 'Y', 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(39, 4, 13, 5, 0, 'Y', 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(40, 4, 14, 5, 0, 'Y', 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(41, 4, 15, 5, 0, 'Y', 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(42, 4, 16, 5, 0, 'Y', 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(43, 4, 17, 5, 0, 'Y', 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(44, 4, 18, 5, 0, 'Y', 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(45, 4, 19, 5, 0, 'Y', 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1),
(46, 5, 11, 5, 0, 'Y', 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(47, 5, 12, 5, 0, 'Y', 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(48, 5, 13, 5, 0, 'Y', 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(49, 5, 14, 5, 0, 'Y', 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(50, 5, 15, 5, 0, 'Y', 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(51, 5, 16, 5, 0, 'Y', 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(52, 5, 17, 5, 0, 'Y', 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(53, 5, 18, 5, 0, 'Y', 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(54, 5, 19, 5, 0, 'Y', 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
  `proposal_delete` varchar(255) NOT NULL,
  `estimate_add` varchar(255) NOT NULL,
  `estimate_edit` varchar(255) NOT NULL,
  `estimate_view` varchar(255) NOT NULL,
  `estimate_delete` varchar(255) NOT NULL,
  `invoice_add` varchar(255) NOT NULL,
  `invoice_edit` varchar(255) NOT NULL,
  `invoice_view` varchar(255) NOT NULL,
  `invoice_delete` varchar(255) NOT NULL,
  `item_registration_add` varchar(255) NOT NULL,
  `item_registration_edit` varchar(255) NOT NULL,
  `item_registration_view` varchar(255) NOT NULL,
  `item_registration_delete` varchar(255) NOT NULL,
  `support_add` varchar(255) NOT NULL,
  `support_edit` varchar(255) NOT NULL,
  `support_view` varchar(255) NOT NULL,
  `support_delete` varchar(255) NOT NULL,
  `news_announcement_add` varchar(255) NOT NULL,
  `news_announcement_edit` varchar(255) NOT NULL,
  `news_announcement_delete` varchar(255) NOT NULL,
  `notice_add` varchar(255) NOT NULL,
  `notice_edit` varchar(255) NOT NULL,
  `notice_delete` varchar(255) NOT NULL,
  `role_add` varchar(255) NOT NULL,
  `role_edit` varchar(255) NOT NULL,
  `role_delete` varchar(255) NOT NULL,
  `payment_add` varchar(255) NOT NULL,
  `payment_edit` varchar(255) NOT NULL,
  `payment_view` varchar(255) NOT NULL,
  `payment_delete` varchar(255) NOT NULL,
  `staff_add` varchar(255) NOT NULL,
  `staff_edit` varchar(255) NOT NULL,
  `staff_view` varchar(255) NOT NULL,
  `staff_delete` varchar(255) NOT NULL,
  `menu_dashboard` varchar(255) NOT NULL,
  `menu_lead` varchar(255) NOT NULL,
  `menu_customer` varchar(255) NOT NULL,
  `menu_proposal` varchar(255) NOT NULL,
  `menu_estimate` varchar(255) NOT NULL,
  `menu_invoice` varchar(255) NOT NULL,
  `menu_item_registration` varchar(255) NOT NULL,
  `menu_support` varchar(255) NOT NULL,
  `menu_news_announcement` varchar(255) NOT NULL,
  `menu_notice` varchar(255) NOT NULL,
  `menu_payments` varchar(255) NOT NULL,
  `menu_staff` varchar(255) NOT NULL,
  `menu_setting_role` varchar(255) NOT NULL,
  `menu_report_activities` varchar(255) NOT NULL,
  `roles_privilege_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles_privilege`
--

INSERT INTO `roles_privilege` (`roles_privilege_id`, `roles_id_fk`, `leads_add`, `leads_edit`, `leads_view`, `leads_delete`, `customer_add`, `customer_edit`, `customer_view`, `customer_delete`, `proposal_add`, `proposal_edit`, `proposal_view`, `proposal_delete`, `estimate_add`, `estimate_edit`, `estimate_view`, `estimate_delete`, `invoice_add`, `invoice_edit`, `invoice_view`, `invoice_delete`, `item_registration_add`, `item_registration_edit`, `item_registration_view`, `item_registration_delete`, `support_add`, `support_edit`, `support_view`, `support_delete`, `news_announcement_add`, `news_announcement_edit`, `news_announcement_delete`, `notice_add`, `notice_edit`, `notice_delete`, `role_add`, `role_edit`, `role_delete`, `payment_add`, `payment_edit`, `payment_view`, `payment_delete`, `staff_add`, `staff_edit`, `staff_view`, `staff_delete`, `menu_dashboard`, `menu_lead`, `menu_customer`, `menu_proposal`, `menu_estimate`, `menu_invoice`, `menu_item_registration`, `menu_support`, `menu_news_announcement`, `menu_notice`, `menu_payments`, `menu_staff`, `menu_setting_role`, `menu_report_activities`, `roles_privilege_status`) VALUES
(1, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_tariff_hike`
--

INSERT INTO `room_tariff_hike` (`room_tariff_hike_id`, `properties_id_fk`, `room_tariff_hike_from_date`, `room_tariff_hike_to_date`, `room_tariff_hike_breakfast_rate_adult`, `room_tariff_hike_breakfast_rate_child`, `room_tariff_hike_lunch_rate_adult`, `room_tariff_hike_lunch_rate_child`, `room_tariff_hike_dinner_rate_adult`, `room_tariff_hike_dinner_rate_child`, `room_tariff_hike_description`, `room_tariff_hike_createdby_user_id`, `room_tariff_hike_createdby_user_name`, `room_tariff_hike_created_date`, `room_tariff_hike_created_time`, `room_tariff_hike_status`) VALUES
(1, 1, '2026-02-01', '2026-02-19', 200, 200, 200, 200, 200, 200, 'd', 1, 'Super admin', '2026-02-14', '08:25:45', 1),
(2, 2, '2026-02-01', '2026-02-14', 300, 300, 300, 300, 300, 300, 'd', 1, 'Super admin', '2026-02-14', '08:45:25', 1),
(3, 2, '2026-04-02', '2026-04-30', 400, 400, 400, 400, 400, 400, 'd', 1, 'Super admin', '2026-02-14', '08:48:28', 1),
(4, 2, '2026-05-01', '2026-05-30', 500, 500, 500, 500, 500, 500, 'd', 1, 'Super admin', '2026-02-14', '08:52:18', 0),
(5, 6, '2026-02-01', '2026-02-28', 10, 10, 10, 20, 20, 20, 's', 1, 'Super admin', '2026-02-15', '01:32:47', 1),
(6, 6, '2026-03-01', '2026-03-31', 100, 100, 100, 200, 200, 200, 's0', 1, 'Super admin', '2026-02-15', '01:36:02', 1),
(7, 6, '2026-05-01', '2026-05-30', 100, 100, 100, 200, 200, 200, 's0', 1, 'Super admin', '2026-02-15', '01:38:29', 0),
(8, 1, '2026-04-24', '2026-05-08', 200, 200, 200, 200, 200, 199, 'd', 1, 'Super admin', '2026-02-18', '11:57:34', 0),
(9, 21, '2026-02-01', '2026-09-30', 0, 0, 0, 0, 1, 99, '', 1, 'Super admin', '2026-02-19', '08:41:36', 1),
(10, 21, '2026-10-01', '2026-12-19', 0, 0, 0, 0, 1, 99, '', 1, 'Super admin', '2026-02-19', '08:42:32', 1),
(11, 21, '2026-12-20', '2026-12-31', 0, 0, 0, 0, 1, 99, '', 1, 'Super admin', '2026-02-19', '08:43:08', 1),
(12, 21, '2027-04-01', '2027-05-19', 0, 0, 0, 0, 1, 99, '', 1, 'Super admin', '2026-02-19', '10:54:09', 1),
(13, 32, '2026-02-19', '2026-02-28', 0, 0, 0, 0, 29, 29, 'sdds', 1, 'Super admin', '2026-02-19', '03:27:35', 0),
(14, 2, '2026-02-19', '2026-02-28', 300, 300, 300, 300, 300, 300, 'dasas', 1, 'Super admin', '2026-02-20', '11:59:27', 1),
(15, 32, '2026-02-01', '2026-02-26', 2, 22, 2, 2, 2, 2, '', 1, 'Super admin', '2026-02-26', '08:20:28', 1),
(16, 4, '2026-04-01', '2026-04-03', 89, 8, 8, 8, 8, 8, '', 1, 'Super admin', '2026-04-01', '02:52:55', 1),
(17, 3, '2026-04-01', '2026-04-03', 10, 10, 19, 19, 19, 19, 'sd', 1, 'Super admin', '2026-04-01', '02:53:49', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_tariff_hike_rate`
--

INSERT INTO `room_tariff_hike_rate` (`room_tariff_hike_rate_id`, `room_tariff_hike_id_fk`, `room_id_fk`, `room_tariff_hike_rate_room_rate`, `room_tariff_hike_rate_adult_with_extra_bed`, `room_tariff_hike_rate_child_with_extra_bed`, `room_tariff_hike_rate_child_sharing_bed`, `room_tariff_hike_rate_single_occupancy`, `room_tariff_hike_rate_some_days_type`, `room_tariff_hike_rate_status`) VALUES
(1, 1, 1, 200, 200, 200, 200, 300, 'N', 1),
(2, 1, 2, 200, 300, 300, 3, 200, 'N', 1),
(3, 1, 10, 200, 200, 20, 200, 300, 'N', 1),
(4, 2, 6, 300, 300, 300, 300, 300, 'Y', 1),
(5, 2, 7, 300, 300, 300, 300, 300, 'Y', 1),
(6, 3, 6, 400, 400, 400, 400, 400, 'N', 1),
(7, 3, 7, 400, 400, 400, 400, 400, 'N', 1),
(8, 4, 6, 500, 500, 500, 500, 500, 'N', 0),
(9, 4, 7, 500, 500, 500, 500, 500, 'N', 0),
(10, 5, 12, 10, 20, 20, 20, 20, 'Y', 1),
(11, 6, 12, 100, 200, 200, 200, 200, 'N', 1),
(12, 7, 12, 100, 200, 200, 200, 200, 'Y', 0),
(13, 8, 1, 200, 200, 200, 200, 300, 'N', 0),
(14, 8, 2, 200, 300, 300, 3, 200, 'N', 0),
(15, 8, 10, 200, 200, 20, 200, 300, 'N', 0),
(16, 9, 13, 19, 92929, 29, 29, 292, 'N', 1),
(17, 10, 13, 19, 92929, 29, 29, 292, 'N', 1),
(18, 11, 13, 19, 92929, 29, 29, 292, 'N', 1),
(19, 12, 13, 19, 92929, 29, 29, 292, 'Y', 1),
(20, 13, 15, 10, 10, 19, 92, 9, 'Y', 0),
(21, 14, 6, 300, 300, 300, 300, 300, 'Y', 1),
(22, 14, 7, 300, 300, 300, 300, 300, 'Y', 1),
(23, 14, 16, 188, 288, 28, 28, 8, 'N', 1),
(24, 15, 15, 22, 2, 2, 22, 2, 'N', 1),
(25, 16, 8, 8, 8, 9, 8, 9, 'N', 1),
(26, 16, 9, 8, 8, 8, 8, 8, 'N', 1),
(27, 17, 3, 1, 10, 290, 299, 299, 'N', 1),
(28, 17, 4, 219, 29, 292, 29, 29, 'N', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `room_tariff_week_days_rate`
--

INSERT INTO `room_tariff_week_days_rate` (`room_tariff_week_days_rate_id`, `week_days_room_tariff_hike_id_fk`, `week_days_room_id_fk`, `week_days_id_fk`, `room_tariff_week_days_rate_room_amount`, `room_tariff_week_days_rate_adult_with_extra_bed`, `room_tariff_week_days_rate_child_with_extra_bed`, `room_tariff_week_days_rate_child_sharing_bed`, `room_tariff_week_days_rate_single_occupancy`, `room_tariff_week_days_rate_status`) VALUES
(1, 4, 0, 1, 300, 300, 300, 300, 300, 1),
(2, 4, 0, 2, 300, 300, 300, 300, 300, 1),
(3, 5, 0, 6, 300, 300, 300, 300, 300, 1),
(4, 5, 0, 7, 300, 300, 300, 300, 300, 1),
(5, 6, 0, 1, 300, 300, 300, 300, 300, 1),
(6, 6, 0, 2, 300, 300, 300, 300, 300, 1),
(7, 7, 0, 6, 300, 300, 300, 300, 300, 1),
(8, 7, 0, 7, 300, 300, 300, 300, 300, 1),
(9, 8, 0, 1, 300, 300, 300, 300, 300, 0),
(10, 8, 0, 2, 300, 300, 300, 300, 300, 0),
(11, 9, 0, 6, 300, 300, 300, 300, 300, 0),
(12, 9, 0, 7, 300, 300, 300, 300, 300, 0),
(13, 10, 0, 1, 20, 20, 20, 20, 20, 1),
(14, 11, 0, 1, 20, 20, 20, 20, 20, 1),
(15, 12, 12, 1, 20, 20, 30, 30, 30, 0),
(16, 12, 12, 7, 20, 20, 20, 200, 20, 0),
(17, 19, 0, 1, 28, 828, 28, 282, 28, 1),
(18, 20, 15, 1, 19, 19, 29, 292, 19, 0),
(19, 21, 6, 1, 300, 300, 300, 300, 300, 1),
(20, 21, 6, 2, 300, 300, 300, 300, 300, 1),
(21, 22, 7, 6, 300, 300, 300, 300, 300, 1),
(22, 22, 7, 7, 300, 300, 300, 300, 300, 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`source_id`, `source_name`, `source_created_date`, `source_created_time`, `source_created_user_id`, `source_created_username`, `source_status`) VALUES
(1, 'Social media ', '0000-00-00', '00:00:00', 0, '', 1),
(2, 'Whatsaap Ad', '0000-00-00', '00:00:00', 0, '', 1),
(3, 'Google', '0000-00-00', '00:00:00', 0, '', 1),
(4, 'Reference', '0000-00-00', '00:00:00', 0, '', 1),
(5, 'Brochures or Notice', '0000-00-00', '00:00:00', 0, '', 1),
(6, 'Google', '0000-00-00', '00:00:00', 0, '', 1),
(7, 'Twitter', '2026-01-27', '19:33:49', 1, 'Super admin', 1),
(8, 'ds', '2026-01-27', '20:09:21', 1, 'Super admin', 1),
(9, 'fd', '2026-01-27', '20:09:34', 1, 'Super admin', 1),
(10, 'nna', '2026-01-27', '20:20:59', 1, 'Super admin', 1),
(11, 'nn', '2026-01-28', '12:08:53', 1, 'Super admin', 1),
(12, 'nn', '2026-03-12', '21:12:45', 7, 'zsmsn', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `special_requirements`
--

INSERT INTO `special_requirements` (`special_requirements_id`, `special_requirements_name`, `special_requirements_cost`, `special_requirements_description`, `special_requirements_createdby_user_id`, `special_requirements_createdby_user_name`, `special_requirements_created_date`, `special_requirements_created_time`, `special_requirements_status`) VALUES
(1, 'jkh', 77, 'hk', 1, 'Super admin', '2025-08-31', '07:51:07', 1),
(2, 'hana_edites', 7880, 'sab_edoted', 1, 'Super admin', '2026-01-25', '03:27:20', 0),
(3, 'dffd', 20, '', 1, 'Super admin', '2026-04-07', '06:20:50', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(21, 'klala', '<center><span class=\"btn btn-sm\" style=\"background-color:#1e0a36\"><span style=\"color:white\">klala</span></span></center>', 'mma', '2026-01-29', '06:56:39', 1, 'Super admin', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stage_flow`
--

INSERT INTO `stage_flow` (`stage_flow_id`, `stage_flow_lead_id_fk`, `stage_flow_cur_stage_id_fk`, `stage_flow_prev_stage_id_fk`, `stage_flow_description`, `stage_flow_created_user_id`, `stage_flow_created_username`, `stage_flow_created_date`, `stage_flow_created_time`, `stage_flow_status`) VALUES
(1, 1, 2, 1, '', 1, 'Super admin', '2026-01-29', '14:51:28', 1),
(2, 3, 2, 1, '', 7, 'zsmsn', '2026-03-12', '21:19:28', 1),
(3, 3, 4, 2, 'nnm', 7, 'zsmsn', '2026-03-12', '21:21:10', 1),
(4, 1, 2, 1, 'ss', 1, 'Super admin', '2026-03-13', '17:14:09', 1),
(5, 2, 4, 1, 'nb', 1, 'Super admin', '2026-03-13', '17:16:54', 1),
(6, 1, 4, 2, '', 1, 'Super admin', '2026-03-13', '17:34:56', 1),
(7, 1, 1, 4, '', 1, 'Super admin', '2026-03-13', '17:35:39', 1),
(8, 2, 2, 4, '', 1, 'Super admin', '2026-03-13', '17:36:01', 1),
(9, 2, 5, 2, '', 1, 'Super admin', '2026-03-13', '17:36:51', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id_fk`, `state_name`, `state_description`, `state_created_date`, `state_created_time`, `state_created_user_id`, `state_created_user_name`, `state_status`) VALUES
(1, 99, 'KERALA', '', '0000-00-00', '00:00:00', 0, '', 1),
(4, 99, 'KARNATAKA', 'DDF', '2024-08-28', '08:15:47', 1, 'Super admin', 1),
(5, 0, 'tetseedd', 'sdd', '2026-02-07', '12:59:04', 1, 'Super admin', 0),
(6, 0, 'test', 'munnar', '2026-04-19', '01:02:59', 9, 'Shalis', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `terms_condition`
--

INSERT INTO `terms_condition` (`terms_condition_id`, `terms_condition_name`, `terms_condition_createdby_user_id`, `terms_condition_createdby_user_name`, `terms_condition_created_date`, `terms_condition_created_time`, `terms_condition_status`) VALUES
(1, 'vcvc', 1, 'Super admin', '2025-09-29', '07:55:04', 1),
(2, 'jaj', 1, 'Super admin', '2026-01-25', '04:44:21', 1),
(3, 'Jka', 1, 'Super admin', '2026-01-25', '04:44:41', 0),
(4, 'KERALA - PC', 1, 'Super admin', '2026-03-09', '10:27:56', 1),
(5, 'Kerala -pS', 1, 'Super admin', '2026-04-06', '07:04:34', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terms_condition_items`
--

CREATE TABLE `terms_condition_items` (
  `terms_condition_items_id` int(11) NOT NULL,
  `terms_condition_id_fk` int(11) NOT NULL,
  `terms_condition_items_name` text NOT NULL,
  `terms_condition_items_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(8, 4, 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.\r\nHotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).\r\nExtra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.\r\nIf your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.\r\nProperties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.\r\nCab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.\r\nA photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.\r\nFor Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.\r\nKindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1),
(9, 5, 'In case the mentioned hotels are unavailable, alternate accommodations of the\r\nsame standard will be arranged without compromising on quality.', 1),
(10, 5, 'Hotel check-in is at 14:00 hrs and check-out at 11:00 hrs. Houseboat check-in is at\r\n12:00 hrs and check-out at 09:00 hrs. (For houseboats, AC operates from 21:00 hrs\r\nto 06:00 hrs).', 1),
(11, 5, 'Extra beds provided in hotels or houseboats are usually in the form of floor\r\nmattresses.', 1),
(12, 5, 'If your package includes a sharing houseboat, please ensure timely arrival at\r\nAlleppey. In case of delay, you may have to arrange a speedboat or other transport\r\nat your own expense.', 1),
(13, 5, 'Properties in hill stations like Munnar, Thekkady, and Vagamon usually do not have\r\nAC, as the climate is naturally cool.', 1),
(14, 5, 'Cab service is available daily from 8:00 AM to 7:00 PM. On Day 1, pickup starts at\r\n6:00 AM, and on the last day, the drop-off will be completed by 7:00 PM. Kindly\r\nfollow the driver’s instructions and daily plan for a smooth experience.', 1),
(15, 5, 'A photoshoot is scheduled at Echo Point, Munnar with 20 edited photos included.\r\nThe Eravikulam National Park’s operational status is subject to the forest authority\'s\r\ndecision during the Nilgiri Tahr breeding season. Please check for updates in\r\nadvance.', 1),
(16, 5, 'For Periyar Tiger Reserve boating (Thekkady), pre-book the 01:45 PM – 03:30 PM slot\r\nonline at “www.periyartigerreserve.org”\r\nSpecial dinners or events (e.g., Gala Dinners on December 24th or 31st, or other\r\nfestive celebrations) are not included in the package. If you wish to attend such\r\nevents, you will need to make the payment directly at the hotel, as per their\r\npolicies.', 1),
(17, 5, 'Kindly take care of your valuables, as we are not responsible for any lost items.\r\nA dedicated Point of Contact (POC) will be available throughout your trip for any\r\nassistance you may require.', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `transporter`
--

INSERT INTO `transporter` (`transporter_id`, `transporter_name`, `transporter_base_station_id_fk`, `transporter_address`, `transporter_contact_person_name1`, `transporter_contact_person_email1`, `transporter_contact_person_contact_num1`, `transporter_contact_person_contact_num12`, `transporter_contact_person_name2`, `transporter_contact_person_email2`, `transporter_contact_person_contact_num2`, `transporter_contact_person_contact_num22`, `transporter_bank_name`, `transporter_bank_account_number`, `transporter_bank_account_name`, `transporter_bank_account_ifsc_code`, `transporter_bank_account_branch`, `transporter_bank_swift_code`, `transporter_createdby_user_id`, `transporter_createdby_user_name`, `transporter_created_date`, `transporter_created_time`, `transporter_status`) VALUES
(1, 'Fahadhh', 4, 'sfds', 'hsdf', 'gh@', '33', '434', 'dfsfd', 'dfd@', '34433', '434', 'dggf', '454545', 'fgdg', '4545', 'fdg', 'gfd334', 0, '', '2025-07-23', '05:16:37', 0),
(2, 'hjhj', 1, 'hj', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-24', '08:16:09', 0),
(3, 'jkhj', 1, 'hk', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-24', '08:28:07', 0),
(4, 'Ganfoor_edited', 4, 'Ernau_edited', 'Saj_edited', 'aha@gmail.com_edited', '88199', '19910', 'hah@gmail.com_edited', 'anna@gmail.com_edited', '19910', '19910', 'Najath_edited', '9191910', 'Eajj_edited', '19910', 'Hjk_edited', '9920', 1, 'Super admin', '2026-01-25', '03:12:08', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transporter_vehicle`
--

CREATE TABLE `transporter_vehicle` (
  `transporter_vehicle_id` int(11) NOT NULL,
  `transporter_id_fk` int(11) NOT NULL,
  `vehicle_id_fk` int(11) NOT NULL,
  `transporter_vehicle_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(16, 4, 4, 1);

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
  `status` tinyint(4) DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_permissions`
--

INSERT INTO `tr_permissions` (`id`, `name`, `module`, `sub_module`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'STAFF_VIEW', 'STAFF_MANAGEMENT', 'STAFF', 'STAFF_MANAGEMENT menu', 1, 1, NULL, '2026-04-18 12:23:42', '2026-04-18 10:59:39'),
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
(74, 'QUOTATION_DELETE', 'QUOTATION', 'QUOTATION', 'QUOTATION_DELETE', 1, 1, NULL, '2026-04-18 18:47:35', '2026-04-18 18:47:35');

-- --------------------------------------------------------

--
-- Table structure for table `tr_roles`
--

CREATE TABLE `tr_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `created_by` int(11) DEFAULT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_roles`
--

INSERT INTO `tr_roles` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'staff', '', 1, 1, 9, '2026-04-19 12:24:15', '2026-04-19 01:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `tr_role_permissions`
--

CREATE TABLE `tr_role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tr_role_permissions`
--

INSERT INTO `tr_role_permissions` (`id`, `role_id`, `permission_id`, `status`, `assigned_by`, `assigned_at`, `updated_at`) VALUES
(61, 1, 3, 1, 9, '2026-04-18 19:46:34', '2026-04-19 01:16:34'),
(62, 1, 7, 1, 9, '2026-04-18 19:46:34', '2026-04-19 01:16:34'),
(63, 1, 8, 1, 9, '2026-04-18 19:46:34', '2026-04-19 01:16:34'),
(64, 1, 11, 1, 9, '2026-04-18 19:46:34', '2026-04-19 01:16:34'),
(65, 1, 67, 1, 9, '2026-04-18 19:46:34', '2026-04-19 01:16:34'),
(66, 1, 68, 1, 9, '2026-04-18 19:46:34', '2026-04-19 01:16:34'),
(67, 1, 69, 1, 9, '2026-04-18 19:46:34', '2026-04-19 01:16:34'),
(68, 1, 70, 1, 9, '2026-04-18 19:46:34', '2026-04-19 01:16:34');

-- --------------------------------------------------------

--
-- Table structure for table `tr_user_roles`
--

CREATE TABLE `tr_user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `status` tinyint(4) DEFAULT '1' COMMENT '1 = Active, 0 = Inactive',
  `assigned_by` int(11) DEFAULT NULL,
  `assigned_at` datetime DEFAULT CURRENT_TIMESTAMP,
  `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `upload_tariff_document`
--

INSERT INTO `upload_tariff_document` (`upload_tariff_document_id`, `property_id_fk`, `upload_tariff_document_from_date`, `upload_tariff_document_to_date`, `upload_tariff_document_name`, `upload_tariff_document_description`, `upload_tariff_document_created_by_user_id`, `upload_tariff_document_created_by_user_name`, `upload_tariff_document_created_date`, `upload_tariff_document_created_time`, `upload_tariff_document_status`) VALUES
(1, 1, '2025-09-07', '2025-09-08', 'src-3.jpeg', 'gh', 1, 'Super admin', '2025-09-07', '06:23:17', 1),
(2, 1, '2025-09-07', '0000-00-00', 'src-25.jpeg', 'gh', 1, 'Super admin', '2025-09-07', '06:25:03', 0),
(3, 1, '2025-09-08', '2025-09-17', 'src-1.jpeg', '', 1, 'Super admin', '2025-09-07', '06:28:23', 0),
(4, 5, '2026-01-25', '2026-01-31', '', '', 1, 'Super admin', '2026-01-25', '06:54:23', 0),
(5, 1, '2026-02-10', '2026-02-26', 'screenshot-1.png', '', 1, 'Super admin', '2026-02-18', '11:59:00', 1),
(6, 21, '0000-00-00', '0000-00-00', 'Polygon1.png', '', 1, 'Super admin', '2026-02-19', '07:41:01', 1),
(7, 21, '0000-00-00', '0000-00-00', 'Polygon2.png', '', 1, 'Super admin', '2026-02-19', '07:41:21', 1),
(8, 21, '2026-02-19', '2026-02-20', 'Polygon3.png', '', 1, 'Super admin', '2026-02-19', '07:41:29', 1),
(9, 25, '2026-02-19', '2026-02-28', 'screenshot-11.png', '', 1, 'Super admin', '2026-02-19', '10:52:29', 1),
(10, 32, '2026-02-19', '2026-02-27', 'banner11-mobile.jpg', 'aa', 1, 'Super admin', '2026-02-19', '03:26:47', 0),
(11, 2, '2026-02-20', '2026-02-28', 'Polygon5.png', 'a', 1, 'Super admin', '2026-02-20', '11:58:18', 1),
(12, 32, '2026-02-12', '2026-02-27', 'Travel_Itinerary.pdf', '', 1, 'Super admin', '2026-02-27', '03:12:08', 1),
(13, 32, '2026-02-18', '2026-02-12', '', '', 1, 'Super admin', '2026-02-27', '03:12:40', 1),
(14, 32, '2026-02-06', '2026-02-13', 'Laptop-details.xlsx', '', 1, 'Super admin', '2026-02-27', '03:21:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `user_id` int(11) NOT NULL,
  `admin_name` varchar(255) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
  `meta_force_stop` varchar(50) NOT NULL COMMENT 'N->not stoped, Y->stopped',
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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `admin_name`, `user_id_fk`, `meta_force_stop`, `user_unique_id`, `company_name`, `main_head_staff_id`, `main_head_staff_name`, `user_type`, `user_address`, `user_email_address`, `user_phone_number`, `user_lan_number`, `user_city`, `user_state`, `user_zipcode`, `country_id_fk`, `role_id_fk`, `designation_id_fk`, `user_date_of_joining`, `user_profile_pic`, `user_name`, `password`, `user_description`, `user_created_date`, `user_created_time`, `user_status`) VALUES
(1, 'Super admin', 0, '', '', '', 0, '', 'A', 'ernakula_edited																																																																							', '_edited', '', '24', '', '', '', 0, 2, 0, '0000-00-00', 'Polygon.png', 'admin', 'admin', '									nill_edited																																																																							', '2020-11-26', '04:19:21', 1),
(2, 'Tiffin box', 0, '', '', '', 0, '', 'C', 'KERALA', '', '', '', '', '', '', 0, 0, 0, '0000-00-00', '', 'tiffin@123', 'tiffin@123', 'nill', '2020-11-26', '11:22:20', 1),
(3, 'Monisha Pramod', 2, '', 'MD3', 'Tiffin box', 0, '', 'S', 'Poyillathu House\r\nPalloorkkavu PO', 'monishapramod5@gmail.com', '919744571400', '', 'Mundakkayam', 'Kerala', '685532', 99, 3, 1, '2024-11-16', '', 'Monisha', 'Monisha', '', '2024-11-17', '10:26:45', 1),
(4, 'Shalat Mol Shaji', 2, '', 'MD4', 'Tiffin box', 0, '', 'MH', 'Puthenparambil House\r\nMadukka', 'shalatshaluz@gmail.com', '919074221370', '', 'Mundakkayam', 'Kerala', '686513', 99, 1, 1, '2024-05-06', 'WhatsApp_Image_2024-11-18_at_16_41_17_339ade35.jpg', 'Shalat', 'Shalat', '', '2024-11-18', '04:42:48', 1),
(5, 'Anjala Basheer', 2, '', 'MD5', 'Tiffin box', 0, '', 'MH', 'Thiriyalapatta\r\nMuttil South\r\nWayanad', 'anjalafathimakm00@gmail.com', '918848588861', '', 'Wayanad', 'Kerala', '673122', 99, 1, 1, '2025-01-01', '', 'Anjala', 'Anjala', '', '2025-01-02', '10:51:50', 1),
(6, 'Anshida C A', 2, '', 'MD6', 'Tiffin box', 0, '', 'MH', 'CHAKKUNNAN\r\nNAROKKAVU\r\nNilambur ', 'anshidaachu406@gmail.com', '+918281572809', '', 'Malappuram', 'Kerala', '679331', 99, 1, 1, '2025-04-14', '', 'Anshida', 'Anshida@123', '', '2025-04-08', '04:00:44', 1),
(7, 'zsmsn', 0, '', '', '', 0, '', 'S', 'sns', 'dds', '191919', '', '', '', '', 0, 1, 1, '2026-02-06', '', 'asm', 'wmw', '', '2026-02-06', '04:47:55', 1),
(8, 'ns', 0, '', '', '', 0, '', 'S', '', '', '', '', '', '', '', 0, 1, 1, '1970-01-01', '', 's', '22', '', '2026-03-01', '01:28:48', 1),
(9, 'Shalis', 0, '', '', '', 0, '', 'S', 'Kothamangalam', '', '', '', '', '', '', 0, 1, 1, '1970-01-01', '', 'shalis', 'shalis', '', '2026-04-18', '07:09:31', 1);

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
  `user_proposal_add` varchar(255) NOT NULL,
  `user_proposal_edit` varchar(255) NOT NULL,
  `user_proposal_view` varchar(255) NOT NULL,
  `user_proposal_delete` varchar(255) NOT NULL,
  `user_estimate_add` varchar(255) NOT NULL,
  `user_estimate_edit` varchar(255) NOT NULL,
  `user_estimate_view` varchar(255) NOT NULL,
  `user_estimate_delete` varchar(255) NOT NULL,
  `user_invoice_add` varchar(255) NOT NULL,
  `user_invoice_edit` varchar(255) NOT NULL,
  `user_invoice_view` varchar(255) NOT NULL,
  `user_invoice_delete` varchar(255) NOT NULL,
  `user_item_registration_add` varchar(255) NOT NULL,
  `user_item_registration_edit` varchar(255) NOT NULL,
  `user_item_registration_view` varchar(255) NOT NULL,
  `user_item_registration_delete` varchar(255) NOT NULL,
  `user_support_add` varchar(255) NOT NULL,
  `user_support_edit` varchar(255) NOT NULL,
  `user_support_view` varchar(255) NOT NULL,
  `user_support_delete` varchar(255) NOT NULL,
  `user_news_announcement_add` varchar(255) NOT NULL,
  `user_news_announcement_edit` varchar(255) NOT NULL,
  `user_news_announcement_delete` varchar(255) NOT NULL,
  `user_notice_add` varchar(255) NOT NULL,
  `user_notice_edit` varchar(255) NOT NULL,
  `user_notice_delete` varchar(255) NOT NULL,
  `user_role_add` varchar(255) NOT NULL,
  `user_role_edit` varchar(255) NOT NULL,
  `user_role_delete` varchar(255) NOT NULL,
  `user_payment_add` varchar(255) NOT NULL,
  `user_payment_edit` varchar(255) NOT NULL,
  `user_payment_view` varchar(255) NOT NULL,
  `user_payment_delete` varchar(255) NOT NULL,
  `user_staff_add` varchar(255) NOT NULL,
  `user_staff_edit` varchar(255) NOT NULL,
  `user_staff_view` varchar(255) NOT NULL,
  `user_staff_delete` varchar(255) NOT NULL,
  `user_menu_dashboard` varchar(255) NOT NULL,
  `user_menu_lead` varchar(255) NOT NULL,
  `user_menu_customer` varchar(255) NOT NULL,
  `user_menu_proposal` varchar(255) NOT NULL,
  `user_menu_estimate` varchar(255) NOT NULL,
  `user_menu_invoice` varchar(255) NOT NULL,
  `user_menu_item_registration` varchar(255) NOT NULL,
  `user_menu_support` varchar(255) NOT NULL,
  `user_menu_news_announcement` varchar(255) NOT NULL,
  `user_menu_notice` varchar(255) NOT NULL,
  `user_menu_payments` varchar(255) NOT NULL,
  `user_menu_staff` varchar(255) NOT NULL,
  `user_menu_setting_role` varchar(255) NOT NULL,
  `user_menu_report_activities` varchar(255) NOT NULL,
  `user_privilege_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_privilege`
--

INSERT INTO `user_privilege` (`user_privilege_id`, `user_id_fk`, `user_leads_add`, `user_leads_edit`, `user_leads_view`, `user_leads_delete`, `user_customer_add`, `user_customer_edit`, `user_customer_view`, `user_customer_delete`, `user_proposal_add`, `user_proposal_edit`, `user_proposal_view`, `user_proposal_delete`, `user_estimate_add`, `user_estimate_edit`, `user_estimate_view`, `user_estimate_delete`, `user_invoice_add`, `user_invoice_edit`, `user_invoice_view`, `user_invoice_delete`, `user_item_registration_add`, `user_item_registration_edit`, `user_item_registration_view`, `user_item_registration_delete`, `user_support_add`, `user_support_edit`, `user_support_view`, `user_support_delete`, `user_news_announcement_add`, `user_news_announcement_edit`, `user_news_announcement_delete`, `user_notice_add`, `user_notice_edit`, `user_notice_delete`, `user_role_add`, `user_role_edit`, `user_role_delete`, `user_payment_add`, `user_payment_edit`, `user_payment_view`, `user_payment_delete`, `user_staff_add`, `user_staff_edit`, `user_staff_view`, `user_staff_delete`, `user_menu_dashboard`, `user_menu_lead`, `user_menu_customer`, `user_menu_proposal`, `user_menu_estimate`, `user_menu_invoice`, `user_menu_item_registration`, `user_menu_support`, `user_menu_news_announcement`, `user_menu_notice`, `user_menu_payments`, `user_menu_staff`, `user_menu_setting_role`, `user_menu_report_activities`, `user_privilege_status`) VALUES
(1, 1, 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 'Y', 1),
(2, 2, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', 1),
(3, 3, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', 1),
(4, 4, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', 1),
(5, 5, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', 1),
(6, 6, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `vehicle`
--

INSERT INTO `vehicle` (`vehicle_id`, `vehicle_name`, `vehicle_number_seat`, `vehicle_description`, `vehicle_createdby_user_id`, `vehicle_createdby_user_name`, `vehicle_created_date`, `vehicle_created_time`, `vehicle_status`) VALUES
(1, 'Ertiga', '', '', 0, '', '2025-07-19', '07:31:45', 1),
(2, 'mmn', '', 'vv', 0, '', '2025-07-19', '07:31:55', 1),
(3, 'fhfh', '', '', 0, '', '2025-07-19', '07:47:22', 0),
(4, 'gffgnn', '', 'gfghf', 0, '', '2025-07-19', '07:47:39', 1),
(5, 'kk', '', '', 0, '', '2025-07-19', '07:50:51', 1),
(6, 'gffg', '', '', 0, '', '2025-07-19', '07:51:01', 0),
(7, 'gdd', '', 'dd', 0, '', '2025-07-19', '07:51:23', 1),
(8, 'hghgh', '', '', 0, '', '2025-07-19', '07:51:28', 1),
(9, 'qwfdf', '', '', 0, '', '2025-07-19', '07:51:41', 1),
(10, 'fdf', '', '', 0, '', '2025-07-19', '07:51:52', 1),
(11, 'tyt', '', '', 0, '', '2025-07-19', '07:52:04', 1),
(12, 'etythhh', '', '', 0, '', '2025-07-19', '07:52:11', 0),
(13, 'eet', '', '', 0, '', '2025-07-19', '07:52:22', 1),
(14, 'fhfh', '', '', 0, '', '2025-07-19', '07:53:17', 1),
(15, 'mbbnhghgfh', '', '', 0, '', '2025-07-19', '07:53:28', 1),
(16, 'hfhg', '', '', 0, '', '2025-07-19', '07:53:57', 1),
(17, 'saasdfdf', '', 'ads', 0, '', '2025-07-19', '07:54:08', 1),
(18, 'fsfsdffd', '', 'dffd', 0, '', '2025-07-19', '07:54:20', 1),
(19, 'fgf', '', '', 0, '', '2025-07-19', '07:54:33', 1),
(20, 'hghgfg', '', '', 0, '', '2025-07-19', '07:54:54', 0),
(21, 'sdf', '', '', 0, '', '2025-07-19', '08:01:00', 1),
(22, 'gfgfdgdfgf0', '', 'fgdgdfgff', 0, '', '2025-07-19', '08:01:19', 1),
(23, 'dd', '', '', 0, '', '2025-07-19', '08:02:03', 0),
(24, 'gdgddf', '', 'dg', 0, '', '2025-07-19', '08:02:12', 0),
(25, '3w', '', '', 0, '', '2025-07-19', '08:08:55', 1),
(26, 'gdfg', '3', 'dgdg', 0, '', '2025-07-19', '08:52:53', 0),
(27, 'dsd', '4', 'gd', 0, '', '2025-07-19', '08:54:30', 0),
(28, 'hhg', '454', 'd', 0, '', '2025-07-19', '08:54:39', 0),
(29, 'gfg', 'ds', '', 0, '', '2025-07-19', '09:17:00', 0),
(30, 'jhjh', 'hjh', 'hjhj', 0, '', '2025-07-19', '09:17:18', 0),
(31, 'dfggf', '44', 'fd', 0, '', '2025-07-19', '09:18:29', 0),
(32, 'KL-010-23_edited', '12', 'sd_edited', 1, 'Super admin', '2026-01-25', '03:01:46', 1),
(33, 'KL-10-202', '2', 'sd', 1, 'Super admin', '2026-01-25', '03:02:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `week_days`
--

CREATE TABLE `week_days` (
  `week_days_id` int(11) NOT NULL,
  `week_days_name` varchar(255) NOT NULL,
  `week_days_description` text NOT NULL,
  `week_days_status` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
-- Indexes for table `tr_user_roles`
--
ALTER TABLE `tr_user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_user_role` (`user_id`,`role_id`),
  ADD KEY `role_id` (`role_id`),
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
  MODIFY `accommodation_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `activity`
--
ALTER TABLE `activity`
  MODIFY `activity_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=723;

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
  MODIFY `child_age_break_up_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `guset_count_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `guset_count_details`
--
ALTER TABLE `guset_count_details`
  MODIFY `guset_count_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `hike_room_tariff_hike`
--
ALTER TABLE `hike_room_tariff_hike`
  MODIFY `hike_room_tariff_hike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hike_room_tariff_hike_rate`
--
ALTER TABLE `hike_room_tariff_hike_rate`
  MODIFY `hike_room_tariff_hike_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `hike_room_tariff_week_days_rate`
--
ALTER TABLE `hike_room_tariff_week_days_rate`
  MODIFY `hike_room_tariff_week_days_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

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
  MODIFY `itineraries_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `itineraries_days`
--
ALTER TABLE `itineraries_days`
  MODIFY `itineraries_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `itinerary_category`
--
ALTER TABLE `itinerary_category`
  MODIFY `itinerary_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leads`
--
ALTER TABLE `leads`
  MODIFY `leads_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login_logs`
--
ALTER TABLE `login_logs`
  MODIFY `login_logs_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=261;

--
-- AUTO_INCREMENT for table `meal_plan`
--
ALTER TABLE `meal_plan`
  MODIFY `meal_plan_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `meta_ads_setting`
--
ALTER TABLE `meta_ads_setting`
  MODIFY `meta_ads_setting_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `meta_ads_setting_staff`
--
ALTER TABLE `meta_ads_setting_staff`
  MODIFY `meta_ads_setting_staff_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `meta_lead_logs`
--
ALTER TABLE `meta_lead_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages`
--
ALTER TABLE `packages`
  MODIFY `packages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `packages_cancellation_policies`
--
ALTER TABLE `packages_cancellation_policies`
  MODIFY `packages_cancellation_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `packages_exclusions`
--
ALTER TABLE `packages_exclusions`
  MODIFY `packages_exclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `packages_inclusions`
--
ALTER TABLE `packages_inclusions`
  MODIFY `packages_inclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `packages_itinerary`
--
ALTER TABLE `packages_itinerary`
  MODIFY `packages_itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `packages_itinerary_days`
--
ALTER TABLE `packages_itinerary_days`
  MODIFY `packages_itinerary_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `packages_notes`
--
ALTER TABLE `packages_notes`
  MODIFY `packages_notes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `packages_optional_add_on`
--
ALTER TABLE `packages_optional_add_on`
  MODIFY `packages_optional_add_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `packages_payment_policies`
--
ALTER TABLE `packages_payment_policies`
  MODIFY `packages_payment_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `packages_properties`
--
ALTER TABLE `packages_properties`
  MODIFY `packages_properties_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `packages_properties_common`
--
ALTER TABLE `packages_properties_common`
  MODIFY `packages_properties_common_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `packages_properties_days`
--
ALTER TABLE `packages_properties_days`
  MODIFY `packages_properties_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=97;

--
-- AUTO_INCREMENT for table `packages_properties_rooms`
--
ALTER TABLE `packages_properties_rooms`
  MODIFY `packages_properties_rooms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111;

--
-- AUTO_INCREMENT for table `packages_special_requirements`
--
ALTER TABLE `packages_special_requirements`
  MODIFY `packages_special_requirements_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `packages_terms_condition`
--
ALTER TABLE `packages_terms_condition`
  MODIFY `packages_terms_condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `package_category`
--
ALTER TABLE `package_category`
  MODIFY `package_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payment_policies`
--
ALTER TABLE `payment_policies`
  MODIFY `payment_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `payment_policies_items`
--
ALTER TABLE `payment_policies_items`
  MODIFY `payment_policies_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `priority_status`
--
ALTER TABLE `priority_status`
  MODIFY `priority_status_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `properties`
--
ALTER TABLE `properties`
  MODIFY `properties_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `properties_room_category`
--
ALTER TABLE `properties_room_category`
  MODIFY `properties_room_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `property_category`
--
ALTER TABLE `property_category`
  MODIFY `property_category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `property_inclusions`
--
ALTER TABLE `property_inclusions`
  MODIFY `property_inclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `quotation`
--
ALTER TABLE `quotation`
  MODIFY `quotation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotation_cancellation_policies`
--
ALTER TABLE `quotation_cancellation_policies`
  MODIFY `quotation_cancellation_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `quotation_exclusion`
--
ALTER TABLE `quotation_exclusion`
  MODIFY `quotation_exclusion_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `quotation_inclusions`
--
ALTER TABLE `quotation_inclusions`
  MODIFY `quotation_inclusions` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `quotation_itinerary`
--
ALTER TABLE `quotation_itinerary`
  MODIFY `quotation_itinerary_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotation_itinerary_days`
--
ALTER TABLE `quotation_itinerary_days`
  MODIFY `quotation_itinerary_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `quotation_notes`
--
ALTER TABLE `quotation_notes`
  MODIFY `quotation_notes_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quotation_optional_add_on`
--
ALTER TABLE `quotation_optional_add_on`
  MODIFY `quotation_optional_add_on_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `quotation_options`
--
ALTER TABLE `quotation_options`
  MODIFY `quotation_options_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `quotation_payment_policies`
--
ALTER TABLE `quotation_payment_policies`
  MODIFY `quotation_payment_policies_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `quotation_properties`
--
ALTER TABLE `quotation_properties`
  MODIFY `quotation_properties_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quotation_properties_days`
--
ALTER TABLE `quotation_properties_days`
  MODIFY `quotation_properties_days_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `quotation_properties_rooms`
--
ALTER TABLE `quotation_properties_rooms`
  MODIFY `quotation_properties_rooms_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `quotation_property_inclusions`
--
ALTER TABLE `quotation_property_inclusions`
  MODIFY `quotation_property_inclusions_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quotation_room_tariff_details`
--
ALTER TABLE `quotation_room_tariff_details`
  MODIFY `quotation_room_tariff_details_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `quotation_special_requirements`
--
ALTER TABLE `quotation_special_requirements`
  MODIFY `quotation_special_requirements_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quotation_terms_condition`
--
ALTER TABLE `quotation_terms_condition`
  MODIFY `quotation_terms_condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

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
  MODIFY `room_tariff_hike_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `room_tariff_hike_rate`
--
ALTER TABLE `room_tariff_hike_rate`
  MODIFY `room_tariff_hike_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `room_tariff_week_days_rate`
--
ALTER TABLE `room_tariff_week_days_rate`
  MODIFY `room_tariff_week_days_rate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `source`
--
ALTER TABLE `source`
  MODIFY `source_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `special_requirements`
--
ALTER TABLE `special_requirements`
  MODIFY `special_requirements_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `stages`
--
ALTER TABLE `stages`
  MODIFY `stages_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `stage_flow`
--
ALTER TABLE `stage_flow`
  MODIFY `stage_flow_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `state`
--
ALTER TABLE `state`
  MODIFY `state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `terms_condition`
--
ALTER TABLE `terms_condition`
  MODIFY `terms_condition_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `terms_condition_items`
--
ALTER TABLE `terms_condition_items`
  MODIFY `terms_condition_items_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `transporter`
--
ALTER TABLE `transporter`
  MODIFY `transporter_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `transporter_vehicle`
--
ALTER TABLE `transporter_vehicle`
  MODIFY `transporter_vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tr_permissions`
--
ALTER TABLE `tr_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT for table `tr_roles`
--
ALTER TABLE `tr_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tr_role_permissions`
--
ALTER TABLE `tr_role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `tr_user_roles`
--
ALTER TABLE `tr_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `upload_tariff_document`
--
ALTER TABLE `upload_tariff_document`
  MODIFY `upload_tariff_document_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `user_privilege`
--
ALTER TABLE `user_privilege`
  MODIFY `user_privilege_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `vehicle`
--
ALTER TABLE `vehicle`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

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

--
-- Constraints for table `tr_role_permissions`
--
ALTER TABLE `tr_role_permissions`
  ADD CONSTRAINT `tr_role_permissions_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `tr_roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tr_role_permissions_ibfk_2` FOREIGN KEY (`permission_id`) REFERENCES `tr_permissions` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tr_role_permissions_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `user_details` (`user_id`) ON DELETE SET NULL;

--
-- Constraints for table `tr_user_roles`
--
ALTER TABLE `tr_user_roles`
  ADD CONSTRAINT `tr_user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user_details` (`user_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tr_user_roles_ibfk_2` FOREIGN KEY (`role_id`) REFERENCES `tr_roles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `tr_user_roles_ibfk_3` FOREIGN KEY (`assigned_by`) REFERENCES `user_details` (`user_id`) ON DELETE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
