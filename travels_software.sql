-- phpMyAdmin SQL Dump
-- version 3.3.9
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 25, 2025 at 03:40 AM
-- Server version: 5.5.8
-- PHP Version: 5.3.5

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `travels_software`
--

-- --------------------------------------------------------

--
-- Table structure for table `activity`
--

CREATE TABLE IF NOT EXISTS `activity` (
  `activity_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `activity_status` int(11) NOT NULL,
  PRIMARY KEY (`activity_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=407 ;

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
(406, 1, 0, 0, 'Itinerary_registration', '', 'Added itinerary: sfsd', '127.0.0.1', 'Add', 0, '', '2025-09-22', '2025-09-22 07:48:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `b2b_partner`
--

CREATE TABLE IF NOT EXISTS `b2b_partner` (
  `b2b_partner_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `b2b_partner_status` int(11) NOT NULL,
  PRIMARY KEY (`b2b_partner_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `b2b_partner`
--

INSERT INTO `b2b_partner` (`b2b_partner_id`, `b2b_partner_agent_name`, `b2b_partner_address`, `b2b_partner_country_id_fk`, `b2b_partner_location_id_fk`, `b2b_partner_person_name`, `b2b_partner_contact_number`, `b2b_partner_email_address`, `b2b_partner_description`, `b2b_partner_createdby_user_id`, `b2b_partner_createdby_user_name`, `b2b_partner_created_date`, `b2b_partner_created_time`, `b2b_partner_status`) VALUES
(1, 'Dahgg', 'hghg', 99, 4, 'gf', 'gfgf', 'fgfg', 'fg', 0, '', '2025-07-22', '02:23:42', 0),
(2, 'Jaffarghg', 'hfg', 99, 4, 'Gafoor', '433400', 's@sr', 'hg', 0, '', '2025-07-22', '08:15:09', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_policies`
--

CREATE TABLE IF NOT EXISTS `cancellation_policies` (
  `cancellation_policies_id` int(11) NOT NULL AUTO_INCREMENT,
  `cancellation_policies_name` varchar(255) NOT NULL,
  `cancellation_policies_createdby_user_id` int(11) NOT NULL,
  `cancellation_policies_createdby_user_name` varchar(255) NOT NULL,
  `cancellation_policies_created_date` date NOT NULL,
  `cancellation_policies_created_time` time NOT NULL,
  `cancellation_policies_status` int(11) NOT NULL,
  PRIMARY KEY (`cancellation_policies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `cancellation_policies`
--

INSERT INTO `cancellation_policies` (`cancellation_policies_id`, `cancellation_policies_name`, `cancellation_policies_createdby_user_id`, `cancellation_policies_createdby_user_name`, `cancellation_policies_created_date`, `cancellation_policies_created_time`, `cancellation_policies_status`) VALUES
(1, 'hffh', 1, 'Super admin', '0000-00-00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cancellation_policies_item`
--

CREATE TABLE IF NOT EXISTS `cancellation_policies_item` (
  `cancellation_policies_item_id` int(11) NOT NULL AUTO_INCREMENT,
  `cancellation_policies_id_fk` int(11) NOT NULL,
  `cancellation_policies_item_name` text NOT NULL,
  `cancellation_policies_item_status` int(11) NOT NULL,
  PRIMARY KEY (`cancellation_policies_item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `cancellation_policies_item`
--

INSERT INTO `cancellation_policies_item` (`cancellation_policies_item_id`, `cancellation_policies_id_fk`, `cancellation_policies_item_name`, `cancellation_policies_item_status`) VALUES
(1, 1, 'fh', 1),
(2, 1, 'fh', 1),
(3, 1, 'ghhfh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE IF NOT EXISTS `country` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `iso` char(2) NOT NULL,
  `name` varchar(80) NOT NULL,
  `nicename` varchar(80) NOT NULL,
  `iso3` char(3) DEFAULT NULL,
  `numcode` smallint(6) DEFAULT NULL,
  `phonecode` int(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=240 ;

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
(53, 'CI', 'COTE D''IVOIRE', 'Cote D''Ivoire', 'CIV', 384, 225),
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
(112, 'KP', 'KOREA, DEMOCRATIC PEOPLE''S REPUBLIC OF', 'Korea, Democratic People''s Republic of', 'PRK', 408, 850),
(113, 'KR', 'KOREA, REPUBLIC OF', 'Korea, Republic of', 'KOR', 410, 82),
(114, 'KW', 'KUWAIT', 'Kuwait', 'KWT', 414, 965),
(115, 'KG', 'KYRGYZSTAN', 'Kyrgyzstan', 'KGZ', 417, 996),
(116, 'LA', 'LAO PEOPLE''S DEMOCRATIC REPUBLIC', 'Lao People''s Democratic Republic', 'LAO', 418, 856),
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
-- Table structure for table `district`
--

CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int(11) NOT NULL AUTO_INCREMENT,
  `state_id_fk` int(11) NOT NULL,
  `district_name` varchar(255) NOT NULL,
  `district_description` text NOT NULL,
  `district_created_date` date NOT NULL,
  `district_created_time` time NOT NULL,
  `district_created_user_id` int(11) NOT NULL,
  `district_created_user_name` varchar(255) NOT NULL,
  `district_status` int(11) NOT NULL,
  PRIMARY KEY (`district_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

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

CREATE TABLE IF NOT EXISTS `exclusions` (
  `exclusions_id` int(11) NOT NULL AUTO_INCREMENT,
  `inclusion_exclusion_common_id_fk2` int(11) NOT NULL,
  `exclusions_details` text NOT NULL,
  `exclusions_status` int(11) NOT NULL,
  PRIMARY KEY (`exclusions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `exclusions`
--

INSERT INTO `exclusions` (`exclusions_id`, `inclusion_exclusion_common_id_fk2`, `exclusions_details`, `exclusions_status`) VALUES
(1, 1, 'jhjg', 1),
(2, 1, 'jjhg', 1);

-- --------------------------------------------------------

--
-- Table structure for table `hike_room_tariff_hike`
--

CREATE TABLE IF NOT EXISTS `hike_room_tariff_hike` (
  `hike_room_tariff_hike_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `hike_room_tariff_hike_status` int(11) NOT NULL,
  PRIMARY KEY (`hike_room_tariff_hike_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hike_room_tariff_hike`
--


-- --------------------------------------------------------

--
-- Table structure for table `hike_room_tariff_hike_rate`
--

CREATE TABLE IF NOT EXISTS `hike_room_tariff_hike_rate` (
  `hike_room_tariff_hike_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `hike_room_tariff_hike_id_fk` int(11) NOT NULL,
  `hike_room_tariff_hike_rate_room_rate` double NOT NULL,
  `hike_room_tariff_hike_rate_adult_with_extra_bed` double NOT NULL,
  `hike_room_tariff_hike_rate_child_with_extra_bed` double NOT NULL,
  `hike_room_tariff_hike_rate_child_sharing_bed` double NOT NULL,
  `hike_room_tariff_hike_rate_single_occupancy` double NOT NULL,
  `hike_room_tariff_hike_rate_some_days_type` double NOT NULL,
  `hike_room_tariff_hike_rate_status` int(11) NOT NULL,
  PRIMARY KEY (`hike_room_tariff_hike_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hike_room_tariff_hike_rate`
--


-- --------------------------------------------------------

--
-- Table structure for table `hike_room_tariff_week_days_rate`
--

CREATE TABLE IF NOT EXISTS `hike_room_tariff_week_days_rate` (
  `hike_room_tariff_week_days_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `hike_room_tariff_hike_rate_id_fk` int(11) NOT NULL,
  `hike_week_days_room_id_fk` int(11) NOT NULL,
  `hike_week_days_id_fk` int(11) NOT NULL,
  `hike_room_tariff_week_days_rate_room_amount` double NOT NULL,
  `hike_room_tariff_week_days_rate_adult_with_extra_bed` double NOT NULL,
  `hike_room_tariff_week_days_rate_child_with_extra_bed` double NOT NULL,
  `hike_room_tariff_week_days_rate_child_sharing_bed` double NOT NULL,
  `hike_room_tariff_week_days_rate_single_occupancy` double NOT NULL,
  `hike_room_tariff_week_days_rate_status` int(11) NOT NULL,
  PRIMARY KEY (`hike_room_tariff_week_days_rate_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `hike_room_tariff_week_days_rate`
--


-- --------------------------------------------------------

--
-- Table structure for table `inclusions`
--

CREATE TABLE IF NOT EXISTS `inclusions` (
  `inclusions_id` int(11) NOT NULL AUTO_INCREMENT,
  `inclusion_exclusion_common_id_fk1` int(11) NOT NULL,
  `inclusions_details` text NOT NULL,
  `inclusions_status` int(11) NOT NULL,
  PRIMARY KEY (`inclusions_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `inclusions`
--

INSERT INTO `inclusions` (`inclusions_id`, `inclusion_exclusion_common_id_fk1`, `inclusions_details`, `inclusions_status`) VALUES
(1, 1, 'gjh', 1),
(2, 1, 'jgg', 1),
(3, 1, 'kkh', 1);

-- --------------------------------------------------------

--
-- Table structure for table `inclusion_exclusion_common`
--

CREATE TABLE IF NOT EXISTS `inclusion_exclusion_common` (
  `inclusion_exclusion_common_id` int(11) NOT NULL AUTO_INCREMENT,
  `inclusion_exclusion_common_title` varchar(255) NOT NULL,
  `inclusion_exclusion_common_createdby_user_id` int(11) NOT NULL,
  `inclusion_exclusion_common_createdby_user_name` varchar(255) NOT NULL,
  `inclusion_exclusion_common_created_date` int(11) NOT NULL,
  `inclusion_exclusion_common_created_time` int(11) NOT NULL,
  `inclusion_exclusion_common_status` int(11) NOT NULL,
  PRIMARY KEY (`inclusion_exclusion_common_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `inclusion_exclusion_common`
--

INSERT INTO `inclusion_exclusion_common` (`inclusion_exclusion_common_id`, `inclusion_exclusion_common_title`, `inclusion_exclusion_common_createdby_user_id`, `inclusion_exclusion_common_createdby_user_name`, `inclusion_exclusion_common_created_date`, `inclusion_exclusion_common_created_time`, `inclusion_exclusion_common_status`) VALUES
(1, 'ghjjg', 1, 'Super admin', 2025, 9, 1);

-- --------------------------------------------------------

--
-- Table structure for table `itineraries`
--

CREATE TABLE IF NOT EXISTS `itineraries` (
  `itineraries_id` int(11) NOT NULL AUTO_INCREMENT,
  `itineraries_category_id_fk` int(11) NOT NULL,
  `itineraries_name` varchar(255) NOT NULL,
  `itineraries_duration_nights` varchar(50) NOT NULL,
  `itineraries_description` text NOT NULL,
  `itineraries_createdby_user_id` int(11) NOT NULL,
  `itineraries_created_by_user_name` varchar(255) NOT NULL,
  `itineraries_created_date` date NOT NULL,
  `itineraries_created_time` time NOT NULL,
  `itineraries_status` int(11) NOT NULL,
  PRIMARY KEY (`itineraries_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `itineraries`
--

INSERT INTO `itineraries` (`itineraries_id`, `itineraries_category_id_fk`, `itineraries_name`, `itineraries_duration_nights`, `itineraries_description`, `itineraries_createdby_user_id`, `itineraries_created_by_user_name`, `itineraries_created_date`, `itineraries_created_time`, `itineraries_status`) VALUES
(1, 1, 'sfsd', '3', 'dfs', 1, 'Super admin', '2025-09-22', '07:48:42', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itineraries_days`
--

CREATE TABLE IF NOT EXISTS `itineraries_days` (
  `itineraries_days_id` int(11) NOT NULL AUTO_INCREMENT,
  `itineraries_id_fk` int(11) NOT NULL,
  `itineraries_days_day` varchar(50) NOT NULL,
  `itineraries_days_destination_id_fk` int(11) NOT NULL,
  `itineraries_days_title` varchar(255) NOT NULL,
  `itineraries_days_description` text NOT NULL,
  `itineraries_days_status` int(11) NOT NULL,
  PRIMARY KEY (`itineraries_days_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `itineraries_days`
--

INSERT INTO `itineraries_days` (`itineraries_days_id`, `itineraries_id_fk`, `itineraries_days_day`, `itineraries_days_destination_id_fk`, `itineraries_days_title`, `itineraries_days_description`, `itineraries_days_status`) VALUES
(1, 1, 'Day 1', 1, '', '', 1),
(2, 1, 'Day 2', 4, '', '', 1),
(3, 1, 'Day 1', 1, '', '', 1),
(4, 1, 'Day 2', 4, '', '', 1),
(5, 1, 'Day 3', 4, '', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `itinerary_category`
--

CREATE TABLE IF NOT EXISTS `itinerary_category` (
  `itinerary_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `itinerary_category_name` varchar(255) NOT NULL,
  `itinerary_category_description` text NOT NULL,
  `itinerary_category_createdby_user_id` int(11) NOT NULL,
  `itinerary_category_createdby_user_name` varchar(255) NOT NULL,
  `itinerary_category_created_date` date NOT NULL,
  `itinerary_category_created_time` time NOT NULL,
  `itinerary_category_status` int(11) NOT NULL,
  PRIMARY KEY (`itinerary_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `itinerary_category`
--

INSERT INTO `itinerary_category` (`itinerary_category_id`, `itinerary_category_name`, `itinerary_category_description`, `itinerary_category_createdby_user_id`, `itinerary_category_createdby_user_name`, `itinerary_category_created_date`, `itinerary_category_created_time`, `itinerary_category_status`) VALUES
(1, 'gghj', 'gjgjh', 1, 'Super admin', '2025-08-30', '10:11:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `leads`
--

CREATE TABLE IF NOT EXISTS `leads` (
  `leads_id` int(11) NOT NULL AUTO_INCREMENT,
  `staff_id_fk` int(11) NOT NULL,
  `source_id_fk` int(11) NOT NULL,
  `package_id_fk` int(11) NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `priority_status_id_fk` int(11) NOT NULL,
  `stage_id_fk` int(11) NOT NULL,
  `lead_type` varchar(50) NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `date_type` varchar(50) NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `duration` varchar(50) NOT NULL,
  `whats_number` varchar(255) NOT NULL,
  `alternative_number` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `leads_created_date` date NOT NULL,
  `leads_created_time` time NOT NULL,
  `leads_createdby_userid` int(11) NOT NULL,
  `leads_createdby_username` varchar(255) NOT NULL,
  `leads_status` int(11) NOT NULL,
  PRIMARY KEY (`leads_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `leads`
--


-- --------------------------------------------------------

--
-- Table structure for table `login_logs`
--

CREATE TABLE IF NOT EXISTS `login_logs` (
  `login_logs_id` int(11) NOT NULL AUTO_INCREMENT,
  `login_logs_user_id_fk` int(11) NOT NULL,
  `login_logs_session_id` varchar(500) NOT NULL,
  `login_logs_user_type` varchar(250) NOT NULL,
  `login_logs_admin_name` varchar(255) NOT NULL,
  `login_logs_date` date NOT NULL,
  `login_logs_date_time` datetime NOT NULL,
  `logout_logs_date_time` datetime NOT NULL,
  `login_logs_status` int(11) NOT NULL,
  PRIMARY KEY (`login_logs_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

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
(23, 1, '586175ab546f0c67fd196eb6d33c7a74f5c7a403', 'A', 'Super admin', '2025-09-22', '2025-09-22 07:48:19', '0000-00-00 00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `meal_plan`
--

CREATE TABLE IF NOT EXISTS `meal_plan` (
  `meal_plan_id` int(11) NOT NULL AUTO_INCREMENT,
  `meal_plan_name` varchar(255) NOT NULL,
  `meal_plan_descrption` text NOT NULL,
  `meal_plan_createdby_user_id` int(11) NOT NULL,
  `meal_plan_createdby_user_name` varchar(255) NOT NULL,
  `meal_plan_created_date` date NOT NULL,
  `meal_plan_created_time` time NOT NULL,
  `meal_plan_status` int(11) NOT NULL,
  PRIMARY KEY (`meal_plan_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `meal_plan`
--

INSERT INTO `meal_plan` (`meal_plan_id`, `meal_plan_name`, `meal_plan_descrption`, `meal_plan_createdby_user_id`, `meal_plan_createdby_user_name`, `meal_plan_created_date`, `meal_plan_created_time`, `meal_plan_status`) VALUES
(1, 'CP', 'jj', 0, '', '0000-00-00', '00:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `packages`
--

CREATE TABLE IF NOT EXISTS `packages` (
  `packages_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_category_id_fk` int(11) NOT NULL,
  `packages_itinerary_category_id_fk` int(11) NOT NULL,
  `packages_itinerary_id_fk` int(11) NOT NULL,
  `packages_inclusion_exclusion_common_id_fk` int(11) NOT NULL,
  `packages_title` text NOT NULL,
  `packages_duration_in_nights` int(11) NOT NULL,
  `packages_description` text NOT NULL,
  `packages_createdby_user_id` int(11) NOT NULL,
  `packages_createdby_user_name` varchar(255) NOT NULL,
  `packages_created_date` date NOT NULL,
  `packages_created_time` time NOT NULL,
  `packages_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_cancellation_policies`
--

CREATE TABLE IF NOT EXISTS `packages_cancellation_policies` (
  `packages_cancellation_policies_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_cancellation_policies_packages_id_fk` int(11) NOT NULL,
  `cancellation_policies_id_fk` int(11) NOT NULL,
  `cancellation_policies_item_id_fk` int(11) NOT NULL,
  `packages_cancellation_policies_type` varchar(50) NOT NULL,
  `packages_cancellation_policies_details` text NOT NULL,
  `packages_cancellation_policies_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_cancellation_policies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_cancellation_policies`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_exclusions`
--

CREATE TABLE IF NOT EXISTS `packages_exclusions` (
  `packages_exclusions_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_id_fk` int(11) NOT NULL,
  `exclusions_common_id_fk` int(11) NOT NULL,
  `exclusions_id_fk` int(11) NOT NULL,
  `packages_exclusions_type` varchar(50) NOT NULL,
  `packages_exclusions_details` text NOT NULL,
  `packages_exclusions_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_exclusions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_exclusions`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_inclusions`
--

CREATE TABLE IF NOT EXISTS `packages_inclusions` (
  `packages_inclusions_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_id_fk` int(11) NOT NULL,
  `inclusion_common_id_fk` int(11) NOT NULL,
  `inclusions_id_fk` int(11) NOT NULL,
  `packages_inclusions_type` varchar(50) NOT NULL,
  `packages_inclusions_details` text NOT NULL,
  `packages_inclusions_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_inclusions_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_inclusions`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_itinerary`
--

CREATE TABLE IF NOT EXISTS `packages_itinerary` (
  `packages_itinerary_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_id_fk` int(11) NOT NULL,
  `itineraries_id_fk` int(11) NOT NULL,
  `itineraries_days_id_fk` int(11) NOT NULL,
  `packages_itinerary_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_itinerary_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_itinerary`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_notes`
--

CREATE TABLE IF NOT EXISTS `packages_notes` (
  `packages_notes_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_notes_packages_id_fk` int(11) NOT NULL,
  `packages_notes_details` text NOT NULL,
  `packages_notes_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_notes_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_notes`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_optional_add_on`
--

CREATE TABLE IF NOT EXISTS `packages_optional_add_on` (
  `packages_optional_add_on_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_optional_add_on_packages_id_fk` int(11) NOT NULL,
  `packages_optional_add_on_details` text NOT NULL,
  `packages_optional_add_on_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_optional_add_on_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_optional_add_on`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_payment_policies`
--

CREATE TABLE IF NOT EXISTS `packages_payment_policies` (
  `packages_payment_policies_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_payment_policies_packages_id_fk` int(11) NOT NULL,
  `payment_policies_id_fk` int(11) NOT NULL,
  `payment_policies_items_id_fk` int(11) NOT NULL,
  `packages_payment_policies_type` varchar(50) NOT NULL,
  `packages_payment_policies_details` text NOT NULL,
  `packages_payment_policies_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_payment_policies_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_payment_policies`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_properties`
--

CREATE TABLE IF NOT EXISTS `packages_properties` (
  `packages_properties_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_properties_days_id_fk` int(11) NOT NULL,
  `properties_id_fk` int(11) NOT NULL,
  `packages_properties_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_properties_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_properties`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_properties_common`
--

CREATE TABLE IF NOT EXISTS `packages_properties_common` (
  `packages_properties_common_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_properties_common_packages_id_fk` int(11) NOT NULL,
  `packages_properties_common_category_name` varchar(255) NOT NULL,
  `packages_properties_common_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_properties_common_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_properties_common`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_properties_days`
--

CREATE TABLE IF NOT EXISTS `packages_properties_days` (
  `packages_properties_days_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_properties_common_id_fk` int(11) NOT NULL,
  `packages_properties_days_day` varchar(50) NOT NULL,
  `packages_properties_days_destination_id_fk` int(11) NOT NULL,
  `packages_properties_days_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_properties_days_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_properties_days`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_properties_rooms`
--

CREATE TABLE IF NOT EXISTS `packages_properties_rooms` (
  `packages_properties_rooms_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_properties_id_fk` int(11) NOT NULL,
  `packages_properties_rooms_id_fk` int(11) NOT NULL,
  `packages_properties_rooms_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_properties_rooms_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_properties_rooms`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_special_requirements`
--

CREATE TABLE IF NOT EXISTS `packages_special_requirements` (
  `packages_special_requirements_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_special_requirements_packages_id_fk` int(11) NOT NULL,
  `packages_special_requirements_cost` double NOT NULL,
  `packages_special_requirements_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_special_requirements_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_special_requirements`
--


-- --------------------------------------------------------

--
-- Table structure for table `packages_terms_condition`
--

CREATE TABLE IF NOT EXISTS `packages_terms_condition` (
  `packages_terms_condition_id` int(11) NOT NULL AUTO_INCREMENT,
  `packages_terms_condition_packages_id_fk` int(11) NOT NULL,
  `terms_condition_id_fk` int(11) NOT NULL,
  `terms_condition_item_id_fk` int(11) NOT NULL,
  `packages_terms_condition_type` varchar(50) NOT NULL,
  `packages_terms_condition_details` text NOT NULL,
  `packages_terms_condition_status` int(11) NOT NULL,
  PRIMARY KEY (`packages_terms_condition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `packages_terms_condition`
--


-- --------------------------------------------------------

--
-- Table structure for table `package_category`
--

CREATE TABLE IF NOT EXISTS `package_category` (
  `package_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `package_category_name` varchar(255) NOT NULL,
  `package_category_description` text NOT NULL,
  `package_category_createdby_user_id` int(11) NOT NULL,
  `package_category_createdby_user_name` varchar(255) NOT NULL,
  `package_category_created_date` date NOT NULL,
  `package_category_created_time` time NOT NULL,
  `package_category_status` int(11) NOT NULL,
  PRIMARY KEY (`package_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `package_category`
--

INSERT INTO `package_category` (`package_category_id`, `package_category_name`, `package_category_description`, `package_category_createdby_user_id`, `package_category_createdby_user_name`, `package_category_created_date`, `package_category_created_time`, `package_category_status`) VALUES
(1, 'gghjjjk', 'gj', 1, 'Super admin', '2025-08-29', '11:42:01', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_policies`
--

CREATE TABLE IF NOT EXISTS `payment_policies` (
  `payment_policies_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_policies_name` varchar(255) NOT NULL,
  `payment_policies_createdby_user_id` int(11) NOT NULL,
  `payment_policies_createdby_user_name` varchar(255) NOT NULL,
  `payment_policies_created_date` date NOT NULL,
  `payment_policies_created_time` time NOT NULL,
  `payment_policies_status` int(11) NOT NULL,
  PRIMARY KEY (`payment_policies_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `payment_policies`
--

INSERT INTO `payment_policies` (`payment_policies_id`, `payment_policies_name`, `payment_policies_createdby_user_id`, `payment_policies_createdby_user_name`, `payment_policies_created_date`, `payment_policies_created_time`, `payment_policies_status`) VALUES
(1, 'cbc', 0, '', '2025-07-25', '08:22:16', 1),
(2, 'yuyu', 1, 'Super admin', '2025-09-13', '12:04:36', 1);

-- --------------------------------------------------------

--
-- Table structure for table `payment_policies_items`
--

CREATE TABLE IF NOT EXISTS `payment_policies_items` (
  `payment_policies_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_policies_id_fk` int(11) NOT NULL,
  `payment_policies_items_name` varchar(255) NOT NULL,
  `payment_policies_items_status` int(11) NOT NULL,
  PRIMARY KEY (`payment_policies_items_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `payment_policies_items`
--

INSERT INTO `payment_policies_items` (`payment_policies_items_id`, `payment_policies_id_fk`, `payment_policies_items_name`, `payment_policies_items_status`) VALUES
(1, 1, 'vn', 1),
(2, 1, 'gx', 1),
(3, 2, 'yutyu', 1),
(4, 2, 'utyu', 1),
(5, 2, 'l;l', 1),
(6, 2, 'l;;l', 1);

-- --------------------------------------------------------

--
-- Table structure for table `priority_status`
--

CREATE TABLE IF NOT EXISTS `priority_status` (
  `priority_status_id` int(11) NOT NULL AUTO_INCREMENT,
  `priority_status_company_id_fk` int(11) NOT NULL,
  `priority_status_name` varchar(255) NOT NULL,
  `priority_status_button` text NOT NULL,
  `priority_status_description` text NOT NULL,
  `priority_status_created_date` date NOT NULL,
  `priority_status_created_time` time NOT NULL,
  `priority_status_created_user_id` int(11) NOT NULL,
  `priority_status_created_username` varchar(255) NOT NULL,
  `priority_status_created_status` int(11) NOT NULL,
  PRIMARY KEY (`priority_status_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `priority_status`
--

INSERT INTO `priority_status` (`priority_status_id`, `priority_status_company_id_fk`, `priority_status_name`, `priority_status_button`, `priority_status_description`, `priority_status_created_date`, `priority_status_created_time`, `priority_status_created_user_id`, `priority_status_created_username`, `priority_status_created_status`) VALUES
(1, 2, 'Hot', '<center><span class="btn btn-sm" style="background-color:#ff0606"><span style="color:white">Hot</span></span></center>', '', '2024-11-19', '05:25:20', 1, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

CREATE TABLE IF NOT EXISTS `properties` (
  `properties_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_category_id_fk` int(11) NOT NULL,
  `country_id_fk` int(11) NOT NULL,
  `state_id_fk` int(11) NOT NULL,
  `properties_destination_id_fk` int(11) NOT NULL,
  `properties_house_boat_type` varchar(50) NOT NULL,
  `properties_hotel_url` varchar(255) NOT NULL,
  `properties_name` varchar(255) NOT NULL,
  `properties_check_type` varchar(50) NOT NULL,
  `properties_check_in_time` time NOT NULL,
  `properties_check_out_time` time NOT NULL,
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
  `properties_status` int(11) NOT NULL,
  PRIMARY KEY (`properties_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `properties`
--

INSERT INTO `properties` (`properties_id`, `property_category_id_fk`, `country_id_fk`, `state_id_fk`, `properties_destination_id_fk`, `properties_house_boat_type`, `properties_hotel_url`, `properties_name`, `properties_check_type`, `properties_check_in_time`, `properties_check_out_time`, `properties_sales_contact_name`, `properties_sales_contact_phone_number`, `properties_sales_contact_email`, `properties_reservation_contact_name`, `properties_reservation_contact_phone_number`, `properties_reservation_contact_email`, `properties_google_map_location`, `properties_hotel_logo`, `properties_photos`, `properties_description`, `properties_createdby_userid`, `properties_createdby_username`, `properties_create_date`, `properties_create_time`, `properties_status`) VALUES
(1, 1, 3, 4, 4, 'N', 'khk', 'Janath', 'T', '00:00:00', '00:00:00', 'gj', '5656', 'ggk', 'sfsdfsd', '34343', 'dfg_edited', 'uououo', 'Edappally_Monthly_Report_June_2025.pdf', 'Doc1.pdf', 'dgd', 0, '', '2025-07-31', '07:21:53', 1),
(2, 2, 3, 1, 4, 'Y', '', 'Majestic', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-31', '08:44:45', 0),
(3, 2, 3, 4, 1, 'Y', '', 'sds', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-08-01', '06:57:03', 1),
(4, 1, 2, 4, 4, 'Y', '', 'Trret', 'T', '00:00:00', '00:00:00', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-08-01', '10:31:20', 1);

-- --------------------------------------------------------

--
-- Table structure for table `properties_room_category`
--

CREATE TABLE IF NOT EXISTS `properties_room_category` (
  `properties_room_category_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `properties_room_category_status` int(11) NOT NULL,
  PRIMARY KEY (`properties_room_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `properties_room_category`
--

INSERT INTO `properties_room_category` (`properties_room_category_id`, `properties_id_fk`, `room_meal_plan_id_fk`, `properties_room_category_name`, `properties_room_category_inventory`, `properties_room_category_number_of_adults_allowed`, `properties_room_category_children_allowed_on_bed_sharing_basis`, `properties_room_category_extra_bed_mattress_allowed_in_room`, `properties_room_category_welcomes_child_all_ages`, `properties_room_category_admission_restricted_guests_under_age`, `properties_room_category_complimentary_guest_between_type`, `properties_room_category_complimentary_guest_between_from_year`, `properties_room_category_complimentary_guest_between_to_year`, `properties_room_category_child_rate_applied_guest_between_type`, `properties_room_category_child_rate_applied_guest_from_year`, `properties_room_category_child_rate_applied_guest_to_year`, `properties_room_category_adult_rate_applied_guest_over`, `properties_room_category_photo`, `properties_room_category_description`, `properties_room_category_createdby_user_id`, `properties_room_category_createdby_user_name`, `properties_room_category_created_date`, `properties_room_category_created_time`, `properties_room_category_status`) VALUES
(1, 1, 1, 'Deluxe premium', '3', 3, 4, 5, 'Y', NULL, 'Y', '0', '5', 'Y', '6', '6', '7', '', '', 0, '', '2025-08-12', '08:20:27', 1),
(2, 1, 1, 'Standard room', '3', 7, 8, 8, 'N', '7', 'N', '', NULL, 'N', '', NULL, '7', '', '', 0, '', '2025-08-12', '08:21:51', 1),
(3, 3, 1, 'Jaguar room deluxe', '0', 6, 7, 6, 'Y', NULL, 'N', '', NULL, 'N', '', NULL, '', '', '', 0, '', '2025-08-12', '08:37:08', 1),
(4, 3, 1, 'Large room', '0', 7, 8, 8, 'Y', NULL, 'N', '', NULL, 'N', '', NULL, '', '', '', 0, '', '2025-08-12', '08:38:21', 1),
(5, 1, 1, 'lp', '7', 7, 7, 8, 'Y', NULL, 'Y', '0', '8', 'Y', '9', '9', '10', '', 'h', 1, 'Super admin', '2025-09-06', '04:20:48', 1);

-- --------------------------------------------------------

--
-- Table structure for table `property_category`
--

CREATE TABLE IF NOT EXISTS `property_category` (
  `property_category_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_category_name` varchar(255) NOT NULL,
  `property_category_description` text NOT NULL,
  `property_category_createdby_user_id` int(11) NOT NULL,
  `property_category_createdby_user_name` varchar(255) NOT NULL,
  `property_category_created_date` date NOT NULL,
  `property_category_created_time` time NOT NULL,
  `property_category_status` int(11) NOT NULL,
  PRIMARY KEY (`property_category_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `property_category`
--

INSERT INTO `property_category` (`property_category_id`, `property_category_name`, `property_category_description`, `property_category_createdby_user_id`, `property_category_createdby_user_name`, `property_category_created_date`, `property_category_created_time`, `property_category_status`) VALUES
(1, '5 star', 'hk', 0, '', '2025-07-20', '10:06:07', 1),
(2, '3 star dxffd', 'sds', 0, '', '2025-07-20', '10:06:28', 1),
(3, 'jhjh', 'hj', 0, '', '2025-07-20', '10:06:58', 0),
(4, 'jhbhj', 'hg', 0, '', '2025-07-20', '10:07:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `roles_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_user_id_fk_role` int(11) NOT NULL,
  `roles_name` varchar(255) NOT NULL,
  `roles_description` text NOT NULL,
  `roles_created_by_userid` int(11) NOT NULL,
  `roles_created_by_username` varchar(255) NOT NULL,
  `roles_created_by_usertype` varchar(255) NOT NULL,
  `roles_created_date` date NOT NULL,
  `roles_created_by_time` time NOT NULL,
  `roles_status` int(11) NOT NULL,
  PRIMARY KEY (`roles_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`roles_id`, `company_user_id_fk_role`, `roles_name`, `roles_description`, `roles_created_by_userid`, `roles_created_by_username`, `roles_created_by_usertype`, `roles_created_date`, `roles_created_by_time`, `roles_status`) VALUES
(1, 2, 'Sales and Telecalling', '', 1, 'Super admin', 'A', '2024-11-17', '10:22:26', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles_privilege`
--

CREATE TABLE IF NOT EXISTS `roles_privilege` (
  `roles_privilege_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `roles_privilege_status` int(11) NOT NULL,
  PRIMARY KEY (`roles_privilege_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `roles_privilege`
--

INSERT INTO `roles_privilege` (`roles_privilege_id`, `roles_id_fk`, `leads_add`, `leads_edit`, `leads_view`, `leads_delete`, `customer_add`, `customer_edit`, `customer_view`, `customer_delete`, `proposal_add`, `proposal_edit`, `proposal_view`, `proposal_delete`, `estimate_add`, `estimate_edit`, `estimate_view`, `estimate_delete`, `invoice_add`, `invoice_edit`, `invoice_view`, `invoice_delete`, `item_registration_add`, `item_registration_edit`, `item_registration_view`, `item_registration_delete`, `support_add`, `support_edit`, `support_view`, `support_delete`, `news_announcement_add`, `news_announcement_edit`, `news_announcement_delete`, `notice_add`, `notice_edit`, `notice_delete`, `role_add`, `role_edit`, `role_delete`, `payment_add`, `payment_edit`, `payment_view`, `payment_delete`, `staff_add`, `staff_edit`, `staff_view`, `staff_delete`, `menu_dashboard`, `menu_lead`, `menu_customer`, `menu_proposal`, `menu_estimate`, `menu_invoice`, `menu_item_registration`, `menu_support`, `menu_news_announcement`, `menu_notice`, `menu_payments`, `menu_staff`, `menu_setting_role`, `menu_report_activities`, `roles_privilege_status`) VALUES
(1, 1, 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', 'N', '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_tariff_hike`
--

CREATE TABLE IF NOT EXISTS `room_tariff_hike` (
  `room_tariff_hike_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `room_tariff_hike_status` int(11) NOT NULL,
  PRIMARY KEY (`room_tariff_hike_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `room_tariff_hike`
--

INSERT INTO `room_tariff_hike` (`room_tariff_hike_id`, `properties_id_fk`, `room_tariff_hike_from_date`, `room_tariff_hike_to_date`, `room_tariff_hike_breakfast_rate_adult`, `room_tariff_hike_breakfast_rate_child`, `room_tariff_hike_lunch_rate_adult`, `room_tariff_hike_lunch_rate_child`, `room_tariff_hike_dinner_rate_adult`, `room_tariff_hike_dinner_rate_child`, `room_tariff_hike_description`, `room_tariff_hike_createdby_user_id`, `room_tariff_hike_createdby_user_name`, `room_tariff_hike_created_date`, `room_tariff_hike_created_time`, `room_tariff_hike_status`) VALUES
(1, 3, '2025-09-12', '2025-09-13', 2, 3, 3, 4, 4, 3, '', 1, 'Super admin', '2025-09-12', '08:50:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_tariff_hike_rate`
--

CREATE TABLE IF NOT EXISTS `room_tariff_hike_rate` (
  `room_tariff_hike_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `room_tariff_hike_id_fk` int(11) NOT NULL,
  `room_id_fk` int(11) NOT NULL,
  `room_tariff_hike_rate_room_rate` double NOT NULL,
  `room_tariff_hike_rate_adult_with_extra_bed` double NOT NULL,
  `room_tariff_hike_rate_child_with_extra_bed` double NOT NULL,
  `room_tariff_hike_rate_child_sharing_bed` double NOT NULL,
  `room_tariff_hike_rate_single_occupancy` double NOT NULL,
  `room_tariff_hike_rate_some_days_type` varchar(50) NOT NULL,
  `room_tariff_hike_rate_status` int(11) NOT NULL,
  PRIMARY KEY (`room_tariff_hike_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `room_tariff_hike_rate`
--

INSERT INTO `room_tariff_hike_rate` (`room_tariff_hike_rate_id`, `room_tariff_hike_id_fk`, `room_id_fk`, `room_tariff_hike_rate_room_rate`, `room_tariff_hike_rate_adult_with_extra_bed`, `room_tariff_hike_rate_child_with_extra_bed`, `room_tariff_hike_rate_child_sharing_bed`, `room_tariff_hike_rate_single_occupancy`, `room_tariff_hike_rate_some_days_type`, `room_tariff_hike_rate_status`) VALUES
(1, 1, 3, 3, 3, 3, 4, 4, 'Y', 1),
(2, 1, 4, 4, 4, 2, 4, 2, 'Y', 1);

-- --------------------------------------------------------

--
-- Table structure for table `room_tariff_week_days_rate`
--

CREATE TABLE IF NOT EXISTS `room_tariff_week_days_rate` (
  `room_tariff_week_days_rate_id` int(11) NOT NULL AUTO_INCREMENT,
  `week_days_room_tariff_hike_id_fk` int(11) NOT NULL,
  `week_days_room_id_fk` int(11) NOT NULL,
  `week_days_id_fk` int(11) NOT NULL,
  `room_tariff_week_days_rate_room_amount` double NOT NULL,
  `room_tariff_week_days_rate_adult_with_extra_bed` double NOT NULL,
  `room_tariff_week_days_rate_child_with_extra_bed` double NOT NULL,
  `room_tariff_week_days_rate_child_sharing_bed` double NOT NULL,
  `room_tariff_week_days_rate_single_occupancy` double NOT NULL,
  `room_tariff_week_days_rate_status` int(11) NOT NULL,
  PRIMARY KEY (`room_tariff_week_days_rate_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `room_tariff_week_days_rate`
--

INSERT INTO `room_tariff_week_days_rate` (`room_tariff_week_days_rate_id`, `week_days_room_tariff_hike_id_fk`, `week_days_room_id_fk`, `week_days_id_fk`, `room_tariff_week_days_rate_room_amount`, `room_tariff_week_days_rate_adult_with_extra_bed`, `room_tariff_week_days_rate_child_with_extra_bed`, `room_tariff_week_days_rate_child_sharing_bed`, `room_tariff_week_days_rate_single_occupancy`, `room_tariff_week_days_rate_status`) VALUES
(1, 1, 0, 1, 4, 4, 4, 4, 2, 1),
(2, 1, 0, 2, 4, 4, 2, 4, 4, 1),
(3, 2, 0, 1, 4, 2, 4, 2, 4, 1),
(4, 2, 0, 2, 2, 4, 2, 4, 2, 1),
(5, 2, 0, 3, 3, 4, 2, 4, 2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `source`
--

CREATE TABLE IF NOT EXISTS `source` (
  `source_id` int(11) NOT NULL AUTO_INCREMENT,
  `company_user_id_fk_source` int(11) NOT NULL,
  `source_name` varchar(255) NOT NULL,
  `source_created_date` date NOT NULL,
  `source_created_time` time NOT NULL,
  `source_created_user_id` int(11) NOT NULL,
  `source_created_username` varchar(255) NOT NULL,
  `source_status` int(11) NOT NULL,
  PRIMARY KEY (`source_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `source`
--

INSERT INTO `source` (`source_id`, `company_user_id_fk_source`, `source_name`, `source_created_date`, `source_created_time`, `source_created_user_id`, `source_created_username`, `source_status`) VALUES
(1, 2, 'Social media ', '0000-00-00', '00:00:00', 0, '', 1),
(2, 2, 'Whatsaap Ad', '0000-00-00', '00:00:00', 0, '', 1),
(3, 2, 'Google', '0000-00-00', '00:00:00', 0, '', 1),
(4, 2, 'Reference', '0000-00-00', '00:00:00', 0, '', 1),
(5, 2, 'Brochures or Notice', '0000-00-00', '00:00:00', 0, '', 1),
(6, 0, 'Google', '0000-00-00', '00:00:00', 0, '', 1);

-- --------------------------------------------------------

--
-- Table structure for table `special_requirements`
--

CREATE TABLE IF NOT EXISTS `special_requirements` (
  `special_requirements_id` int(11) NOT NULL AUTO_INCREMENT,
  `special_requirements_name` varchar(255) NOT NULL,
  `special_requirements_cost` double NOT NULL,
  `special_requirements_description` text NOT NULL,
  `special_requirements_createdby_user_id` int(11) NOT NULL,
  `special_requirements_createdby_user_name` varchar(255) NOT NULL,
  `special_requirements_created_date` date NOT NULL,
  `special_requirements_created_time` time NOT NULL,
  `special_requirements_status` int(11) NOT NULL,
  PRIMARY KEY (`special_requirements_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `special_requirements`
--

INSERT INTO `special_requirements` (`special_requirements_id`, `special_requirements_name`, `special_requirements_cost`, `special_requirements_description`, `special_requirements_createdby_user_id`, `special_requirements_createdby_user_name`, `special_requirements_created_date`, `special_requirements_created_time`, `special_requirements_status`) VALUES
(1, 'jkh', 77, 'hk', 1, 'Super admin', '2025-08-31', '07:51:07', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stages`
--

CREATE TABLE IF NOT EXISTS `stages` (
  `stages_id` int(11) NOT NULL AUTO_INCREMENT,
  `stages_company_id_fk` int(11) NOT NULL,
  `pipeline_id_fk` int(11) NOT NULL,
  `stages_name` varchar(255) NOT NULL,
  `stages_button` text NOT NULL,
  `stages_description` text NOT NULL,
  `stages_created_date` date NOT NULL,
  `stages_created_time` time NOT NULL,
  `stages_created_user_id` int(11) NOT NULL,
  `stages_created_username` varchar(255) NOT NULL,
  `stages_status` int(11) NOT NULL,
  PRIMARY KEY (`stages_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=14 ;

--
-- Dumping data for table `stages`
--

INSERT INTO `stages` (`stages_id`, `stages_company_id_fk`, `pipeline_id_fk`, `stages_name`, `stages_button`, `stages_description`, `stages_created_date`, `stages_created_time`, `stages_created_user_id`, `stages_created_username`, `stages_status`) VALUES
(1, 2, 1, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#17c467"><span style="color:white">Initial called</span></span></center>', '', '2024-11-19', '05:34:27', 1, 'Super admin', 1),
(2, 2, 2, 'initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">initial called</span></span></center>', '', '2024-11-26', '03:38:09', 4, 'Shalat Mol Shaji', 1),
(3, 2, 3, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">Initial called</span></span></center>', '', '2024-11-27', '10:29:14', 4, 'Shalat Mol Shaji', 1),
(4, 2, 3, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">Initial called</span></span></center>', '', '2024-11-27', '10:29:14', 4, 'Shalat Mol Shaji', 1),
(5, 2, 4, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">Initial called</span></span></center>', '', '2024-11-27', '10:34:23', 4, 'Shalat Mol Shaji', 1),
(6, 2, 5, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#005705"><span style="color:white">Initial called</span></span></center>', '', '2024-11-28', '06:52:37', 4, 'Shalat Mol Shaji', 1),
(7, 2, 6, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">Initial called</span></span></center>', '', '2024-11-28', '07:10:10', 4, 'Shalat Mol Shaji', 1),
(8, 0, 7, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">Initial called</span></span></center>', '', '2024-11-29', '02:38:53', 4, 'Shalat Mol Shaji', 1),
(9, 2, 8, 'Initial called', '<center><span class="btn btn-sm" style="background-color:rgba(30,196,35,0.77)"><span style="color:white">Initial called</span></span></center>', '', '2024-12-03', '06:19:26', 4, 'Shalat Mol Shaji', 1),
(10, 0, 9, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">Initial called</span></span></center>', '', '2025-01-07', '07:11:33', 4, 'Shalat Mol Shaji', 1),
(11, 0, 10, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#22d936"><span style="color:white">Initial called</span></span></center>', '', '2025-01-18', '09:00:32', 4, 'Shalat Mol Shaji', 1),
(12, 0, 11, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">Initial called</span></span></center>', '', '2025-01-19', '02:17:27', 4, 'Shalat Mol Shaji', 1),
(13, 2, 12, 'Initial called', '<center><span class="btn btn-sm" style="background-color:#000000"><span style="color:white">Initial called</span></span></center>', '', '2025-01-25', '10:08:28', 4, 'Shalat Mol Shaji', 1);

-- --------------------------------------------------------

--
-- Table structure for table `stage_flow`
--

CREATE TABLE IF NOT EXISTS `stage_flow` (
  `stage_flow_id` int(11) NOT NULL AUTO_INCREMENT,
  `stage_flow_lead_id_fk` int(11) NOT NULL,
  `stage_flow_pipeline_id_fk` int(11) NOT NULL,
  `stage_flow_stage_id_fk` int(11) NOT NULL,
  `stage_flow_description` text NOT NULL,
  `stage_flow_created_user_id` int(11) NOT NULL,
  `stage_flow_created_username` varchar(255) NOT NULL,
  `stage_flow_created_date` date NOT NULL,
  `stage_flow_created_time` time NOT NULL,
  `stage_flow_status` int(11) NOT NULL,
  PRIMARY KEY (`stage_flow_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1097 ;

--
-- Dumping data for table `stage_flow`
--

INSERT INTO `stage_flow` (`stage_flow_id`, `stage_flow_lead_id_fk`, `stage_flow_pipeline_id_fk`, `stage_flow_stage_id_fk`, `stage_flow_description`, `stage_flow_created_user_id`, `stage_flow_created_username`, `stage_flow_created_date`, `stage_flow_created_time`, `stage_flow_status`) VALUES
(1, 1, 1, 1, '', 1, 'Super admin', '2024-11-19', '05:36:56', 1),
(2, 2, 1, 1, 'Daily basis needed', 4, 'Shalat Mol Shaji', '2024-11-20', '07:31:05', 1),
(3, 3, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-20', '07:48:00', 1),
(4, 4, 1, 1, 'Details Shared', 4, 'Shalat Mol Shaji', '2024-11-20', '08:15:14', 1),
(5, 5, 1, 1, 'Details shared', 4, 'Shalat Mol Shaji', '2024-11-20', '08:30:04', 1),
(6, 6, 1, 1, 'Details shared', 4, 'Shalat Mol Shaji', '2024-11-20', '08:35:34', 1),
(7, 7, 1, 1, 'Details Shared', 4, 'Shalat Mol Shaji', '2024-11-20', '08:40:16', 1),
(8, 8, 1, 1, 'Details shared', 4, 'Shalat Mol Shaji', '2024-11-21', '12:50:43', 1),
(9, 9, 1, 1, 'dail basis needed', 4, 'Shalat Mol Shaji', '2024-11-21', '12:58:00', 1),
(10, 10, 1, 1, 'Details shared', 4, 'Shalat Mol Shaji', '2024-11-21', '01:22:55', 1),
(11, 11, 1, 1, 'details shared', 4, 'Shalat Mol Shaji', '2024-11-21', '01:37:19', 1),
(12, 12, 1, 1, 'details shared', 4, 'Shalat Mol Shaji', '2024-11-21', '01:44:33', 1),
(13, 13, 1, 1, 'waiting for location confirmation', 4, 'Shalat Mol Shaji', '2024-11-22', '11:15:57', 1),
(14, 14, 1, 1, 'no delivery there', 4, 'Shalat Mol Shaji', '2024-11-22', '11:19:12', 1),
(15, 15, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '11:27:05', 1),
(16, 16, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '11:34:10', 1),
(17, 17, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '11:39:58', 1),
(18, 18, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '11:48:09', 1),
(19, 19, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '11:52:30', 1),
(20, 20, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '12:29:03', 1),
(21, 21, 1, 1, 'no needed', 4, 'Shalat Mol Shaji', '2024-11-22', '12:33:37', 1),
(22, 22, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '12:41:27', 1),
(23, 23, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '12:51:23', 1),
(24, 24, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '12:57:21', 1),
(25, 25, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:00:58', 1),
(26, 26, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:05:05', 1),
(27, 27, 1, 1, 'no needed', 4, 'Shalat Mol Shaji', '2024-11-22', '01:08:05', 1),
(28, 28, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:10:35', 1),
(29, 29, 1, 1, 'no delivery there', 4, 'Shalat Mol Shaji', '2024-11-22', '01:12:56', 1),
(30, 30, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:15:20', 1),
(31, 31, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:17:44', 1),
(32, 32, 1, 1, 'No needed', 4, 'Shalat Mol Shaji', '2024-11-22', '01:19:49', 1),
(33, 33, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-22', '01:22:06', 1),
(34, 34, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:25:29', 1),
(35, 35, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:29:07', 1),
(36, 36, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:33:34', 1),
(37, 37, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:35:59', 1),
(38, 38, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:39:39', 1),
(39, 39, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:50:58', 1),
(40, 40, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '01:59:41', 1),
(41, 41, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '02:06:38', 1),
(42, 42, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '02:08:43', 1),
(43, 43, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '02:20:55', 1),
(44, 44, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-22', '02:23:41', 1),
(45, 45, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-23', '12:34:16', 1),
(46, 46, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-23', '01:08:26', 1),
(47, 47, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-23', '01:19:50', 1),
(48, 48, 1, 1, '', 3, 'Monisha Pramod', '2024-11-23', '01:38:09', 1),
(49, 49, 1, 1, '', 3, 'Monisha Pramod', '2024-11-23', '01:42:40', 1),
(50, 50, 1, 1, '', 3, 'Monisha Pramod', '2024-11-23', '01:46:26', 1),
(51, 51, 1, 1, '', 3, 'Monisha Pramod', '2024-11-23', '01:49:20', 1),
(52, 52, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-23', '03:40:51', 1),
(53, 53, 1, 1, '', 3, 'Monisha Pramod', '2024-11-23', '03:52:03', 1),
(54, 54, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-23', '03:52:04', 1),
(55, 55, 1, 1, '', 3, 'Monisha Pramod', '2024-11-23', '03:58:33', 1),
(56, 56, 1, 1, '', 3, 'Monisha Pramod', '2024-11-23', '04:01:01', 1),
(57, 57, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-23', '05:53:10', 1),
(58, 58, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '11:28:12', 1),
(59, 59, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '11:40:56', 1),
(60, 60, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '11:58:07', 1),
(61, 61, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '12:01:17', 1),
(62, 62, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '12:03:33', 1),
(63, 63, 1, 1, 'Pure veg', 4, 'Shalat Mol Shaji', '2024-11-24', '12:08:17', 1),
(64, 64, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '12:15:33', 1),
(65, 65, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '12:37:06', 1),
(66, 66, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '12:40:43', 1),
(67, 67, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '01:00:04', 1),
(68, 68, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '01:11:24', 1),
(69, 69, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '01:34:33', 1),
(70, 70, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '01:44:03', 1),
(71, 71, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '01:44:43', 1),
(72, 72, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '01:46:50', 1),
(73, 73, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '01:47:08', 1),
(74, 74, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '01:50:30', 1),
(75, 75, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '01:50:40', 1),
(76, 76, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '02:17:11', 1),
(77, 77, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '02:21:56', 1),
(78, 78, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-24', '02:40:04', 1),
(79, 79, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '02:44:07', 1),
(80, 80, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '02:49:30', 1),
(81, 81, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '02:53:00', 1),
(82, 82, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-24', '02:58:03', 1),
(83, 83, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '03:05:38', 1),
(84, 84, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '03:08:16', 1),
(85, 85, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '03:13:14', 1),
(86, 86, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '03:16:11', 1),
(87, 87, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '03:19:55', 1),
(88, 88, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '03:31:41', 1),
(89, 89, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '03:33:41', 1),
(90, 90, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '03:36:22', 1),
(91, 91, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '04:00:36', 1),
(92, 92, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '04:14:59', 1),
(93, 93, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '04:22:09', 1),
(94, 94, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '05:41:08', 1),
(95, 95, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '06:08:34', 1),
(96, 96, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '06:25:36', 1),
(97, 97, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-24', '06:30:47', 1),
(98, 98, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-24', '06:32:28', 1),
(99, 99, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-24', '06:38:14', 1),
(100, 100, 1, 1, '', 3, 'Monisha Pramod', '2024-11-24', '10:45:06', 1),
(101, 101, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-25', '11:50:58', 1),
(102, 102, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-25', '12:23:29', 1),
(103, 103, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-25', '12:28:42', 1),
(104, 104, 1, 1, '', 3, 'Monisha Pramod', '2024-11-25', '12:37:02', 1),
(105, 105, 1, 1, '', 3, 'Monisha Pramod', '2024-11-25', '01:59:06', 1),
(106, 106, 1, 1, '10 days trial', 4, 'Shalat Mol Shaji', '2024-11-25', '03:41:30', 1),
(107, 107, 1, 1, '', 3, 'Monisha Pramod', '2024-11-25', '04:06:51', 1),
(108, 108, 1, 1, '', 3, 'Monisha Pramod', '2024-11-25', '04:11:10', 1),
(109, 109, 1, 1, '', 3, 'Monisha Pramod', '2024-11-26', '02:24:34', 1),
(110, 110, 1, 1, '', 3, 'Monisha Pramod', '2024-11-26', '02:40:11', 1),
(111, 111, 1, 1, '', 3, 'Monisha Pramod', '2024-11-26', '02:43:47', 1),
(112, 112, 1, 1, '', 3, 'Monisha Pramod', '2024-11-26', '02:52:07', 1),
(113, 113, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-26', '03:09:28', 1),
(114, 114, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-26', '03:38:13', 1),
(115, 115, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-26', '03:43:20', 1),
(116, 116, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-26', '03:49:28', 1),
(117, 117, 1, 1, 'No delivery there', 4, 'Shalat Mol Shaji', '2024-11-26', '03:53:24', 1),
(118, 118, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-27', '10:02:31', 1),
(119, 119, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-27', '10:09:44', 1),
(120, 120, 2, 2, 'Follow up for renewal', 4, 'Shalat Mol Shaji', '2024-11-27', '10:25:11', 1),
(121, 121, 3, 4, 'Cancellation error', 4, 'Shalat Mol Shaji', '2024-11-27', '10:29:22', 1),
(122, 122, 4, 5, 'Refund amount:370', 4, 'Shalat Mol Shaji', '2024-11-27', '10:35:48', 1),
(123, 123, 1, 1, '', 3, 'Monisha Pramod', '2024-11-27', '04:14:45', 1),
(124, 124, 1, 1, '', 3, 'Monisha Pramod', '2024-11-27', '07:40:54', 1),
(125, 125, 1, 1, '', 3, 'Monisha Pramod', '2024-11-27', '08:47:55', 1),
(126, 126, 1, 1, '', 3, 'Monisha Pramod', '2024-11-27', '10:30:04', 1),
(127, 127, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-28', '12:21:10', 1),
(128, 128, 4, 5, '', 3, 'Monisha Pramod', '2024-11-28', '03:49:29', 1),
(129, 129, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-28', '06:45:21', 1),
(130, 130, 5, 6, '', 4, 'Shalat Mol Shaji', '2024-11-28', '06:52:43', 1),
(131, 131, 6, 7, '', 4, 'Shalat Mol Shaji', '2024-11-28', '07:10:13', 1),
(132, 132, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-28', '08:19:02', 1),
(133, 133, 1, 1, '', 3, 'Monisha Pramod', '2024-11-28', '10:06:20', 1),
(134, 134, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-29', '11:10:45', 1),
(135, 135, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '11:49:38', 1),
(136, 136, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '11:53:00', 1),
(137, 137, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '11:56:01', 1),
(138, 138, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '02:24:10', 1),
(139, 3, 7, 8, '', 4, 'Shalat Mol Shaji', '2024-11-29', '02:38:56', 1),
(140, 139, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '02:52:21', 1),
(141, 140, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '03:10:59', 1),
(142, 141, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '03:34:54', 1),
(143, 142, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '04:52:33', 1),
(144, 143, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '04:54:25', 1),
(145, 144, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '04:55:51', 1),
(146, 145, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '04:57:26', 1),
(147, 146, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '04:58:58', 1),
(148, 147, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '05:00:24', 1),
(149, 148, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '05:02:36', 1),
(150, 149, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '05:04:49', 1),
(151, 150, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '05:06:36', 1),
(152, 151, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '05:07:57', 1),
(153, 152, 1, 1, '', 3, 'Monisha Pramod', '2024-11-29', '05:09:17', 1),
(154, 153, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '06:27:09', 1),
(155, 154, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '06:31:19', 1),
(156, 155, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '06:42:44', 1),
(157, 156, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '06:50:09', 1),
(158, 157, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-29', '07:26:43', 1),
(159, 158, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-29', '09:15:07', 1),
(160, 159, 2, 2, '', 3, 'Monisha Pramod', '2024-11-30', '08:20:32', 1),
(161, 160, 2, 2, '', 3, 'Monisha Pramod', '2024-11-30', '08:23:28', 1),
(162, 161, 1, 1, '', 3, 'Monisha Pramod', '2024-11-30', '10:43:04', 1),
(163, 162, 3, 4, '', 3, 'Monisha Pramod', '2024-11-30', '10:45:17', 1),
(164, 163, 1, 1, '', 3, 'Monisha Pramod', '2024-11-30', '11:30:02', 1),
(165, 164, 1, 1, '', 3, 'Monisha Pramod', '2024-11-30', '12:41:53', 1),
(166, 165, 1, 1, '', 3, 'Monisha Pramod', '2024-11-30', '12:45:59', 1),
(167, 166, 1, 1, '', 3, 'Monisha Pramod', '2024-11-30', '01:04:57', 1),
(168, 167, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-30', '02:26:30', 1),
(169, 168, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-30', '02:29:49', 1),
(170, 169, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-30', '05:49:13', 1),
(171, 170, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-30', '06:28:51', 1),
(172, 171, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-30', '06:34:22', 1),
(173, 172, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-30', '08:07:50', 1),
(174, 173, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-11-30', '08:33:47', 1),
(175, 174, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-11-30', '09:10:07', 1),
(176, 175, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-01', '01:34:45', 1),
(177, 176, 1, 1, '', 3, 'Monisha Pramod', '2024-12-01', '02:44:39', 1),
(178, 177, 1, 1, '', 3, 'Monisha Pramod', '2024-12-01', '02:48:53', 1),
(179, 178, 1, 1, '', 3, 'Monisha Pramod', '2024-12-01', '03:54:45', 1),
(180, 179, 1, 1, '', 3, 'Monisha Pramod', '2024-12-01', '04:02:34', 1),
(181, 180, 1, 1, '', 3, 'Monisha Pramod', '2024-12-01', '04:09:22', 1),
(182, 181, 1, 1, '', 3, 'Monisha Pramod', '2024-12-01', '04:33:44', 1),
(183, 182, 1, 1, '', 3, 'Monisha Pramod', '2024-12-01', '04:36:21', 1),
(184, 183, 1, 1, '', 3, 'Monisha Pramod', '2024-12-01', '05:02:49', 1),
(185, 184, 2, 2, '3 persons', 4, 'Shalat Mol Shaji', '2024-12-01', '05:59:24', 1),
(186, 185, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-01', '06:09:39', 1),
(187, 186, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-01', '06:22:46', 1),
(188, 187, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-01', '06:45:52', 1),
(189, 188, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-01', '06:48:59', 1),
(190, 189, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-01', '06:53:01', 1),
(191, 190, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-01', '07:05:12', 1),
(192, 191, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-01', '07:17:46', 1),
(193, 192, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-01', '08:28:01', 1),
(194, 193, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-01', '08:32:33', 1),
(195, 194, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-01', '08:36:39', 1),
(196, 195, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-01', '09:04:58', 1),
(197, 196, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-02', '12:34:47', 1),
(198, 197, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-02', '06:43:45', 1),
(199, 198, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-03', '03:35:45', 1),
(200, 199, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-03', '04:27:18', 1),
(201, 200, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-03', '04:49:32', 1),
(202, 201, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-03', '06:15:49', 1),
(203, 202, 8, 9, '', 4, 'Shalat Mol Shaji', '2024-12-03', '06:19:35', 1),
(204, 203, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-03', '06:57:11', 1),
(205, 204, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-04', '01:07:12', 1),
(206, 205, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-04', '01:10:23', 1),
(207, 206, 1, 1, '', 4, 'Shalat Mol Shaji', '2024-12-05', '09:24:02', 1),
(208, 207, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-05', '09:27:26', 1),
(209, 208, 2, 2, '', 4, 'Shalat Mol Shaji', '2024-12-05', '09:30:49', 1),
(210, 210, 2, 2, 'sdf', 4, 'Shalat Mol Shaji', '2024-12-27', '05:51:27', 1),
(211, 272, 1, 1, '', 5, 'Anjala Basheer', '2025-01-05', '11:35:42', 1),
(212, 339, 1, 1, '', 5, 'Anjala Basheer', '2025-01-05', '11:53:47', 1),
(213, 338, 1, 1, '', 5, 'Anjala Basheer', '2025-01-05', '11:54:31', 1),
(214, 328, 2, 2, '', 5, 'Anjala Basheer', '2025-01-05', '12:29:22', 1),
(215, 336, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-05', '07:17:07', 1),
(216, 350, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-05', '07:28:52', 1),
(217, 363, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-06', '05:16:47', 1),
(218, 364, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-06', '05:27:45', 1),
(219, 365, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-06', '05:30:16', 1),
(220, 366, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-06', '05:34:33', 1),
(221, 367, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-06', '05:38:27', 1),
(222, 369, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-06', '06:29:11', 1),
(223, 368, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-06', '06:36:03', 1),
(224, 370, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-06', '06:41:09', 1),
(225, 371, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-06', '06:51:16', 1),
(226, 372, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-06', '07:00:04', 1),
(227, 381, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '08:10:54', 1),
(228, 382, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '08:32:15', 1),
(229, 390, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '12:27:51', 1),
(230, 391, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '12:30:32', 1),
(231, 392, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '12:34:10', 1),
(232, 393, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '12:38:47', 1),
(233, 396, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-07', '06:00:39', 1),
(234, 397, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-07', '06:05:06', 1),
(235, 398, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-07', '06:10:48', 1),
(236, 399, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '06:14:48', 1),
(237, 400, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '06:14:48', 1),
(238, 401, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-07', '06:16:32', 1),
(239, 402, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '06:22:21', 1),
(240, 403, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '06:25:35', 1),
(241, 404, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-07', '06:34:43', 1),
(242, 405, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-07', '06:54:34', 1),
(243, 406, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-07', '07:00:14', 1),
(244, 407, 9, 10, 'write the name on food cover', 4, 'Shalat Mol Shaji', '2025-01-07', '07:12:09', 1),
(245, 408, 2, 2, '', 5, 'Anjala Basheer', '2025-01-07', '07:28:49', 1),
(246, 411, 2, 2, '', 5, 'Anjala Basheer', '2025-01-07', '08:10:59', 1),
(247, 412, 2, 2, '', 5, 'Anjala Basheer', '2025-01-07', '08:12:55', 1),
(248, 415, 1, 1, '', 5, 'Anjala Basheer', '2025-01-07', '08:37:51', 1),
(249, 421, 2, 2, '', 5, 'Anjala Basheer', '2025-01-08', '11:35:07', 1),
(250, 422, 1, 1, '', 5, 'Anjala Basheer', '2025-01-08', '11:58:53', 1),
(251, 423, 1, 1, '', 5, 'Anjala Basheer', '2025-01-08', '12:13:51', 1),
(252, 424, 1, 1, '', 5, 'Anjala Basheer', '2025-01-08', '12:49:28', 1),
(253, 431, 2, 2, '', 5, 'Anjala Basheer', '2025-01-08', '03:47:12', 1),
(254, 432, 1, 1, '', 5, 'Anjala Basheer', '2025-01-08', '04:14:20', 1),
(255, 433, 1, 1, '', 5, 'Anjala Basheer', '2025-01-08', '04:19:15', 1),
(256, 434, 1, 1, '', 5, 'Anjala Basheer', '2025-01-08', '04:20:58', 1),
(257, 435, 1, 1, '', 5, 'Anjala Basheer', '2025-01-08', '04:23:44', 1),
(258, 436, 2, 2, '', 5, 'Anjala Basheer', '2025-01-08', '04:26:34', 1),
(259, 452, 1, 1, '', 5, 'Anjala Basheer', '2025-01-09', '11:59:49', 1),
(260, 454, 1, 1, '', 5, 'Anjala Basheer', '2025-01-09', '01:25:49', 1),
(261, 457, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-09', '03:00:44', 1),
(262, 458, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-09', '03:14:46', 1),
(263, 460, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-09', '05:41:11', 1),
(264, 463, 2, 2, '', 5, 'Anjala Basheer', '2025-01-10', '04:25:40', 1),
(265, 468, 1, 1, '', 5, 'Anjala Basheer', '2025-01-10', '08:50:15', 1),
(266, 469, 2, 2, '', 5, 'Anjala Basheer', '2025-01-10', '09:29:36', 1),
(267, 474, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-11', '10:48:17', 1),
(268, 475, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-11', '10:52:34', 1),
(269, 477, 2, 2, '', 5, 'Anjala Basheer', '2025-01-12', '12:26:31', 1),
(270, 478, 1, 1, '', 5, 'Anjala Basheer', '2025-01-12', '12:28:55', 1),
(271, 479, 1, 1, '', 5, 'Anjala Basheer', '2025-01-12', '12:33:28', 1),
(272, 490, 1, 1, '', 5, 'Anjala Basheer', '2025-01-13', '04:09:00', 1),
(273, 491, 1, 1, '', 5, 'Anjala Basheer', '2025-01-13', '04:14:22', 1),
(274, 492, 1, 1, '', 5, 'Anjala Basheer', '2025-01-13', '04:16:44', 1),
(275, 500, 2, 2, '', 5, 'Anjala Basheer', '2025-01-13', '08:09:27', 1),
(276, 509, 1, 1, '', 5, 'Anjala Basheer', '2025-01-14', '05:26:30', 1),
(277, 512, 1, 1, '', 5, 'Anjala Basheer', '2025-01-14', '06:54:56', 1),
(278, 513, 1, 1, '', 5, 'Anjala Basheer', '2025-01-14', '07:04:00', 1),
(279, 517, 1, 1, '', 5, 'Anjala Basheer', '2025-01-14', '09:07:26', 1),
(280, 518, 1, 1, '', 5, 'Anjala Basheer', '2025-01-14', '10:12:27', 1),
(281, 519, 2, 2, '', 5, 'Anjala Basheer', '2025-01-15', '07:59:39', 1),
(282, 520, 3, 3, '', 5, 'Anjala Basheer', '2025-01-15', '09:36:14', 1),
(283, 521, 1, 1, '', 5, 'Anjala Basheer', '2025-01-15', '09:53:15', 1),
(284, 522, 1, 1, '', 5, 'Anjala Basheer', '2025-01-15', '10:09:43', 1),
(285, 523, 1, 1, '', 5, 'Anjala Basheer', '2025-01-15', '10:12:50', 1),
(286, 524, 2, 2, '', 5, 'Anjala Basheer', '2025-01-15', '11:09:14', 1),
(287, 526, 1, 1, '', 5, 'Anjala Basheer', '2025-01-15', '11:38:06', 1),
(288, 528, 1, 1, '', 5, 'Anjala Basheer', '2025-01-15', '12:05:42', 1),
(289, 529, 4, 5, '', 5, 'Anjala Basheer', '2025-01-15', '12:09:08', 1),
(290, 531, 1, 1, '', 5, 'Anjala Basheer', '2025-01-15', '12:51:45', 1),
(291, 533, 1, 1, '', 5, 'Anjala Basheer', '2025-01-15', '02:38:04', 1),
(292, 535, 1, 1, '', 5, 'Anjala Basheer', '2025-01-15', '02:54:16', 1),
(293, 538, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '04:41:15', 1),
(294, 539, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '04:52:28', 1),
(295, 540, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '04:56:10', 1),
(296, 541, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '05:03:45', 1),
(297, 542, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '05:08:30', 1),
(298, 543, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '05:21:04', 1),
(299, 544, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '05:27:26', 1),
(300, 547, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '07:29:10', 1),
(301, 548, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '07:32:00', 1),
(302, 549, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-15', '07:46:43', 1),
(303, 342, 3, 3, '', 4, 'Shalat Mol Shaji', '2025-01-15', '07:56:56', 1),
(304, 573, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-18', '08:31:58', 1),
(305, 574, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-18', '08:34:21', 1),
(306, 575, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-18', '08:37:28', 1),
(307, 576, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-18', '08:40:28', 1),
(308, 577, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-18', '08:45:55', 1),
(309, 578, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-18', '08:49:54', 1),
(310, 579, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-18', '08:54:40', 1),
(311, 510, 5, 6, '', 4, 'Shalat Mol Shaji', '2025-01-18', '09:01:53', 1),
(312, 580, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-18', '09:06:07', 1),
(313, 582, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-18', '10:19:06', 1),
(314, 583, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-18', '10:35:51', 1),
(315, 586, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '12:31:16', 1),
(316, 587, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '12:39:45', 1),
(317, 588, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '12:42:06', 1),
(318, 589, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '12:45:34', 1),
(319, 590, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '12:51:24', 1),
(320, 591, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '12:53:48', 1),
(321, 592, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '12:56:39', 1),
(322, 593, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '12:58:45', 1),
(323, 594, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:00:40', 1),
(324, 595, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:02:42', 1),
(325, 596, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:05:47', 1),
(326, 597, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:08:41', 1),
(327, 598, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:11:27', 1),
(328, 599, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:13:19', 1),
(329, 600, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:25:51', 1),
(330, 601, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:28:10', 1),
(331, 602, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:30:01', 1),
(332, 603, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:31:33', 1),
(333, 604, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:34:37', 1),
(334, 605, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:39:25', 1),
(335, 606, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '01:41:35', 1),
(336, 608, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '03:24:33', 1),
(337, 609, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '03:28:34', 1),
(338, 610, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '03:39:08', 1),
(339, 611, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '03:49:17', 1),
(340, 612, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:11:23', 1),
(341, 613, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:20:57', 1),
(342, 614, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:22:40', 1),
(343, 616, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:33:59', 1),
(344, 617, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:37:02', 1),
(345, 619, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:39:13', 1),
(346, 620, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:44:27', 1),
(347, 621, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:50:17', 1),
(348, 623, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '04:58:38', 1),
(349, 625, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '05:05:15', 1),
(350, 626, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '05:08:55', 1),
(351, 627, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '05:11:34', 1),
(352, 628, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '05:13:01', 1),
(353, 629, 1, 1, '', 5, 'Anjala Basheer', '2025-01-18', '05:14:53', 1),
(354, 636, 4, 5, '', 4, 'Shalat Mol Shaji', '2025-01-19', '12:53:47', 1),
(355, 634, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '12:57:12', 1),
(356, 637, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '01:27:05', 1),
(357, 638, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '01:31:16', 1),
(358, 639, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '01:34:20', 1),
(359, 640, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '01:38:59', 1),
(360, 641, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '01:42:32', 1),
(361, 642, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '01:46:21', 1),
(362, 220, 11, 12, '', 4, 'Shalat Mol Shaji', '2025-01-19', '02:17:39', 1),
(363, 643, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '02:21:51', 1),
(364, 644, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '02:27:53', 1),
(365, 645, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '02:52:32', 1),
(366, 646, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-19', '03:04:02', 1),
(367, 647, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '03:24:44', 1),
(368, 648, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '03:25:51', 1),
(369, 649, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '03:29:17', 1),
(370, 650, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '03:39:36', 1),
(371, 651, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '03:46:58', 1),
(372, 652, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '03:50:05', 1),
(373, 653, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '03:52:03', 1),
(374, 654, 2, 2, '', 5, 'Anjala Basheer', '2025-01-19', '04:11:56', 1),
(375, 655, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '04:27:42', 1),
(376, 656, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '04:30:47', 1),
(377, 657, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '04:37:03', 1),
(378, 659, 1, 1, '', 5, 'Anjala Basheer', '2025-01-19', '10:36:38', 1),
(379, 661, 3, 3, '', 1, 'Super admin', '2025-01-20', '10:43:09', 1),
(380, 662, 1, 1, '', 5, 'Anjala Basheer', '2025-01-20', '01:02:18', 1),
(381, 674, 1, 1, '', 5, 'Anjala Basheer', '2025-01-21', '02:07:14', 1),
(382, 680, 1, 1, '', 5, 'Anjala Basheer', '2025-01-22', '10:25:02', 1),
(383, 681, 1, 1, '', 5, 'Anjala Basheer', '2025-01-22', '10:28:42', 1),
(384, 684, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:19:12', 1),
(385, 686, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:22:00', 1),
(386, 687, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:27:00', 1),
(387, 688, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:29:46', 1),
(388, 689, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:34:24', 1),
(389, 690, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:39:19', 1),
(390, 692, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:48:17', 1),
(391, 693, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:51:57', 1),
(392, 694, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:54:26', 1),
(393, 695, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '01:59:04', 1),
(394, 696, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:02:49', 1),
(395, 697, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:06:22', 1),
(396, 698, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:09:14', 1),
(397, 699, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:11:23', 1),
(398, 700, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:15:00', 1),
(399, 701, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:28:04', 1),
(400, 703, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:33:57', 1),
(401, 704, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:37:00', 1),
(402, 705, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:41:15', 1),
(403, 706, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:45:27', 1),
(404, 707, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '02:52:46', 1),
(405, 708, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '03:01:39', 1),
(406, 709, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '03:43:49', 1),
(407, 710, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '03:47:50', 1),
(408, 711, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '03:50:03', 1),
(409, 712, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-22', '03:59:19', 1),
(410, 715, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '06:26:22', 1),
(411, 717, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '07:03:55', 1),
(412, 714, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '07:31:49', 1),
(413, 718, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-22', '07:53:20', 1),
(414, 725, 1, 1, '', 5, 'Anjala Basheer', '2025-01-23', '09:25:18', 1),
(415, 727, 1, 1, '', 5, 'Anjala Basheer', '2025-01-23', '10:46:55', 1),
(416, 729, 1, 1, '', 5, 'Anjala Basheer', '2025-01-23', '12:16:01', 1),
(417, 735, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '06:09:47', 1),
(418, 737, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '06:12:59', 1),
(419, 736, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '06:15:22', 1),
(420, 738, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '06:31:03', 1),
(421, 739, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '06:47:52', 1),
(422, 740, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '06:52:13', 1),
(423, 741, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '06:57:45', 1),
(424, 742, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '07:00:55', 1),
(425, 743, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '07:04:00', 1),
(426, 744, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '07:33:25', 1),
(427, 745, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '07:35:39', 1),
(428, 746, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '07:41:26', 1),
(429, 747, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '07:47:13', 1),
(430, 748, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-23', '08:52:43', 1),
(431, 755, 1, 1, '', 5, 'Anjala Basheer', '2025-01-24', '03:58:45', 1),
(432, 756, 1, 1, '', 5, 'Anjala Basheer', '2025-01-24', '04:10:52', 1),
(433, 758, 1, 1, '', 5, 'Anjala Basheer', '2025-01-24', '05:05:57', 1),
(434, 759, 1, 1, '', 5, 'Anjala Basheer', '2025-01-24', '05:36:52', 1),
(435, 761, 1, 1, '', 5, 'Anjala Basheer', '2025-01-24', '06:13:22', 1),
(436, 762, 1, 1, '', 5, 'Anjala Basheer', '2025-01-24', '06:13:23', 1),
(437, 764, 1, 1, '', 5, 'Anjala Basheer', '2025-01-24', '09:41:45', 1),
(438, 766, 1, 1, '', 5, 'Anjala Basheer', '2025-01-24', '09:49:33', 1),
(439, 767, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-25', '09:50:47', 1),
(440, 768, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-25', '09:52:04', 1),
(441, 769, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-25', '09:57:18', 1),
(442, 770, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:03:21', 1),
(443, 771, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:05:12', 1),
(444, 772, 12, 13, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:08:30', 1),
(445, 773, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:22:22', 1),
(446, 774, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:24:37', 1),
(447, 775, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:27:17', 1),
(448, 776, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:30:22', 1),
(449, 777, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:35:42', 1),
(450, 778, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-25', '10:38:12', 1),
(451, 781, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-25', '12:39:24', 1),
(452, 785, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '06:22:25', 1),
(453, 786, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '06:28:42', 1),
(454, 787, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '06:52:37', 1),
(455, 788, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '06:55:56', 1),
(456, 789, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:01:51', 1),
(457, 790, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:04:09', 1),
(458, 791, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:06:51', 1),
(459, 792, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:09:01', 1),
(460, 793, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:10:36', 1),
(461, 794, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:13:11', 1),
(462, 795, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:16:29', 1),
(463, 796, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:19:54', 1),
(464, 797, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:21:49', 1),
(465, 798, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:24:35', 1),
(466, 799, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:31:26', 1),
(467, 800, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:36:03', 1),
(468, 801, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:38:17', 1),
(469, 802, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '07:46:29', 1),
(470, 803, 3, 3, '', 5, 'Anjala Basheer', '2025-01-25', '09:04:05', 1),
(471, 804, 3, 3, '', 5, 'Anjala Basheer', '2025-01-25', '09:06:20', 1),
(472, 805, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '09:44:47', 1),
(473, 806, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '10:03:56', 1),
(474, 807, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '10:08:23', 1),
(475, 808, 1, 1, '', 5, 'Anjala Basheer', '2025-01-25', '10:20:33', 1),
(476, 236, 3, 3, '', 5, 'Anjala Basheer', '2025-01-26', '05:12:03', 1),
(477, 232, 2, 2, '', 5, 'Anjala Basheer', '2025-01-26', '06:21:31', 1),
(478, 817, 2, 2, '', 5, 'Anjala Basheer', '2025-01-26', '06:58:27', 1),
(479, 818, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '08:28:23', 1),
(480, 819, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '08:31:09', 1),
(481, 820, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '08:33:19', 1),
(482, 821, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '08:35:05', 1),
(483, 822, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '08:37:01', 1),
(484, 823, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '08:40:18', 1),
(485, 824, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '08:46:08', 1),
(486, 825, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '08:50:01', 1),
(487, 826, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '10:35:51', 1),
(488, 827, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '11:26:41', 1),
(489, 827, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-27', '11:26:42', 1),
(490, 844, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:28:16', 1),
(491, 845, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:30:29', 1),
(492, 846, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:34:10', 1),
(493, 847, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:36:43', 1),
(494, 848, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:39:24', 1),
(495, 849, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:42:22', 1),
(496, 850, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:44:16', 1),
(497, 852, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:47:02', 1),
(498, 851, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-28', '02:50:07', 1),
(499, 658, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '03:31:19', 1),
(500, 854, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '04:18:44', 1),
(501, 855, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '04:31:38', 1),
(502, 856, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '07:07:38', 1),
(503, 857, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '07:36:28', 1),
(504, 858, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '07:43:31', 1),
(505, 859, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '08:05:39', 1),
(506, 231, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '08:13:10', 1),
(507, 260, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '08:30:01', 1),
(508, 860, 1, 1, '', 5, 'Anjala Basheer', '2025-01-28', '10:07:10', 1),
(509, 863, 2, 2, '', 5, 'Anjala Basheer', '2025-01-29', '11:51:52', 1),
(510, 750, 1, 1, '', 5, 'Anjala Basheer', '2025-01-29', '12:00:41', 1),
(511, 865, 1, 1, '', 5, 'Anjala Basheer', '2025-01-29', '01:31:57', 1),
(512, 870, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-29', '07:14:42', 1),
(513, 871, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-29', '07:21:51', 1),
(514, 872, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-29', '07:26:34', 1),
(515, 879, 1, 1, '', 5, 'Anjala Basheer', '2025-01-30', '04:31:50', 1),
(516, 880, 1, 1, '', 5, 'Anjala Basheer', '2025-01-30', '07:13:37', 1),
(517, 881, 1, 1, '', 5, 'Anjala Basheer', '2025-01-30', '07:16:45', 1),
(518, 886, 1, 1, '', 5, 'Anjala Basheer', '2025-01-30', '09:11:37', 1),
(519, 887, 3, 3, '', 5, 'Anjala Basheer', '2025-01-30', '09:20:47', 1),
(520, 499, 3, 3, '', 5, 'Anjala Basheer', '2025-01-30', '10:02:02', 1),
(521, 891, 2, 2, '', 5, 'Anjala Basheer', '2025-01-31', '11:25:55', 1),
(522, 892, 3, 3, '', 5, 'Anjala Basheer', '2025-01-31', '12:48:56', 1),
(523, 691, 1, 1, '', 5, 'Anjala Basheer', '2025-01-31', '01:29:45', 1),
(524, 893, 1, 1, '', 5, 'Anjala Basheer', '2025-01-31', '01:40:15', 1),
(525, 894, 2, 2, '', 5, 'Anjala Basheer', '2025-01-31', '01:43:49', 1),
(526, 898, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-31', '07:10:10', 1),
(527, 899, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-31', '07:28:31', 1),
(528, 900, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-31', '07:33:19', 1),
(529, 895, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-31', '07:41:23', 1),
(530, 901, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-31', '07:46:08', 1),
(531, 902, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-31', '07:52:25', 1),
(532, 903, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-01-31', '08:50:42', 1),
(533, 913, 2, 2, '', 5, 'Anjala Basheer', '2025-02-01', '03:35:27', 1),
(534, 914, 1, 1, '', 5, 'Anjala Basheer', '2025-02-01', '03:39:49', 1),
(535, 915, 2, 2, '', 5, 'Anjala Basheer', '2025-02-01', '04:45:22', 1),
(536, 916, 1, 1, '', 5, 'Anjala Basheer', '2025-02-01', '06:09:20', 1),
(537, 277, 1, 1, '', 5, 'Anjala Basheer', '2025-02-01', '06:23:34', 1),
(538, 917, 1, 1, '', 5, 'Anjala Basheer', '2025-02-01', '06:41:22', 1),
(539, 918, 1, 1, '', 5, 'Anjala Basheer', '2025-02-01', '06:50:37', 1),
(540, 919, 1, 1, '', 5, 'Anjala Basheer', '2025-02-01', '07:36:24', 1),
(541, 920, 1, 1, '', 5, 'Anjala Basheer', '2025-02-01', '08:26:37', 1),
(542, 921, 1, 1, '', 5, 'Anjala Basheer', '2025-02-01', '08:58:57', 1),
(543, 925, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '09:44:00', 1),
(544, 926, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '11:29:14', 1),
(545, 883, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '11:49:22', 1),
(546, 928, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '12:42:39', 1),
(547, 930, 2, 2, '', 5, 'Anjala Basheer', '2025-02-02', '03:01:52', 1),
(548, 904, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '05:27:48', 1),
(549, 498, 3, 3, '', 5, 'Anjala Basheer', '2025-02-02', '05:59:13', 1),
(550, 932, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '06:16:52', 1),
(551, 280, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '07:35:27', 1),
(552, 933, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '07:45:58', 1),
(553, 934, 1, 1, '', 5, 'Anjala Basheer', '2025-02-02', '08:33:26', 1),
(554, 379, 1, 1, '', 5, 'Anjala Basheer', '2025-02-03', '09:39:48', 1),
(555, 731, 1, 1, '', 5, 'Anjala Basheer', '2025-02-03', '10:53:25', 1),
(556, 211, 1, 1, '', 5, 'Anjala Basheer', '2025-02-03', '11:19:41', 1),
(557, 940, 1, 1, '', 5, 'Anjala Basheer', '2025-02-03', '02:21:07', 1),
(558, 964, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-04', '12:46:55', 1),
(559, 965, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-04', '12:54:08', 1),
(560, 966, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-04', '12:56:38', 1),
(561, 970, 1, 1, '', 5, 'Anjala Basheer', '2025-02-04', '04:13:48', 1),
(562, 971, 1, 1, '', 5, 'Anjala Basheer', '2025-02-04', '04:56:08', 1),
(563, 972, 1, 1, '', 5, 'Anjala Basheer', '2025-02-04', '05:18:32', 1),
(564, 973, 1, 1, '', 5, 'Anjala Basheer', '2025-02-04', '08:33:32', 1),
(565, 974, 1, 1, '', 5, 'Anjala Basheer', '2025-02-04', '08:53:55', 1),
(566, 754, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '12:35:59', 1),
(567, 976, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '01:00:46', 1),
(568, 978, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '01:16:06', 1),
(569, 982, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '01:48:38', 1),
(570, 983, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '02:08:18', 1),
(571, 985, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-02-05', '06:16:50', 1),
(572, 986, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-05', '06:45:26', 1),
(573, 988, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '08:30:07', 1),
(574, 989, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '08:46:57', 1),
(575, 990, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '08:52:50', 1),
(576, 991, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '09:04:33', 1),
(577, 993, 1, 1, '', 5, 'Anjala Basheer', '2025-02-05', '09:17:57', 1),
(578, 995, 2, 2, '', 5, 'Anjala Basheer', '2025-02-06', '08:39:16', 1),
(579, 999, 1, 1, '', 5, 'Anjala Basheer', '2025-02-06', '10:55:20', 1),
(580, 1000, 1, 1, '', 5, 'Anjala Basheer', '2025-02-06', '12:04:30', 1),
(581, 1007, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-06', '03:13:46', 1),
(582, 1013, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '09:54:16', 1),
(583, 1014, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '10:00:42', 1),
(584, 1015, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '10:05:45', 1),
(585, 1016, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '10:11:59', 1),
(586, 1017, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '10:19:48', 1),
(587, 1018, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '10:46:25', 1),
(588, 1019, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '11:02:11', 1),
(589, 1020, 2, 2, '', 5, 'Anjala Basheer', '2025-02-07', '11:21:17', 1),
(590, 1023, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '03:30:35', 1),
(591, 1024, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '04:56:10', 1),
(592, 936, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '05:24:39', 1),
(593, 1025, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '06:11:48', 1),
(594, 1026, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '06:14:02', 1),
(595, 969, 3, 3, '', 5, 'Anjala Basheer', '2025-02-07', '07:36:46', 1),
(596, 1028, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '07:42:40', 1),
(597, 1029, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '09:28:57', 1),
(598, 1030, 1, 1, '', 5, 'Anjala Basheer', '2025-02-07', '09:37:30', 1),
(599, 1031, 1, 1, '', 5, 'Anjala Basheer', '2025-02-08', '07:58:38', 1),
(600, 1032, 1, 1, '', 5, 'Anjala Basheer', '2025-02-08', '08:02:44', 1),
(601, 1033, 1, 1, '', 5, 'Anjala Basheer', '2025-02-08', '08:11:43', 1),
(602, 1042, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '04:05:52', 1),
(603, 1043, 2, 2, '', 5, 'Anjala Basheer', '2025-02-09', '05:56:01', 1),
(604, 1044, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '06:06:19', 1),
(605, 1045, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '07:31:52', 1),
(606, 1046, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '07:41:44', 1),
(607, 1047, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '08:44:11', 1),
(608, 1048, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '08:57:42', 1),
(609, 1049, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '10:05:22', 1),
(610, 1050, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '10:36:55', 1),
(611, 1051, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '10:55:31', 1),
(612, 1052, 1, 1, '', 5, 'Anjala Basheer', '2025-02-09', '11:07:24', 1),
(613, 1067, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-10', '09:42:03', 1),
(614, 1069, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-02-10', '09:52:17', 1),
(615, 1070, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-10', '09:58:01', 1),
(616, 1071, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-10', '10:08:21', 1),
(617, 1072, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-10', '10:15:19', 1),
(618, 1073, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-10', '10:17:53', 1),
(619, 1075, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-11', '10:18:54', 1),
(620, 1096, 2, 2, '', 5, 'Anjala Basheer', '2025-02-12', '03:56:54', 1),
(621, 1097, 1, 1, '', 5, 'Anjala Basheer', '2025-02-12', '05:22:42', 1),
(622, 942, 1, 1, '', 5, 'Anjala Basheer', '2025-02-12', '05:24:45', 1),
(623, 1098, 1, 1, '', 5, 'Anjala Basheer', '2025-02-12', '05:59:27', 1),
(624, 1099, 2, 2, '', 5, 'Anjala Basheer', '2025-02-12', '06:30:41', 1),
(625, 1109, 2, 2, '', 5, 'Anjala Basheer', '2025-02-13', '09:23:10', 1),
(626, 1110, 2, 2, '', 5, 'Anjala Basheer', '2025-02-13', '09:38:22', 1),
(627, 1112, 1, 1, '', 5, 'Anjala Basheer', '2025-02-13', '10:21:54', 1),
(628, 1115, 1, 1, '', 5, 'Anjala Basheer', '2025-02-13', '01:14:09', 1),
(629, 1117, 1, 1, '', 5, 'Anjala Basheer', '2025-02-13', '06:00:42', 1),
(630, 1118, 1, 1, '', 5, 'Anjala Basheer', '2025-02-13', '07:24:17', 1),
(631, 1121, 2, 2, '', 5, 'Anjala Basheer', '2025-02-13', '08:51:11', 1),
(632, 1123, 1, 1, '', 5, 'Anjala Basheer', '2025-02-13', '09:46:07', 1),
(633, 1102, 1, 1, '', 5, 'Anjala Basheer', '2025-02-14', '10:46:10', 1),
(634, 1125, 1, 1, '', 5, 'Anjala Basheer', '2025-02-14', '12:26:27', 1),
(635, 1127, 1, 1, '', 5, 'Anjala Basheer', '2025-02-14', '01:11:26', 1),
(636, 1130, 1, 1, '', 5, 'Anjala Basheer', '2025-02-14', '03:37:13', 1),
(637, 1134, 1, 1, '', 5, 'Anjala Basheer', '2025-02-15', '11:13:28', 1),
(638, 1136, 1, 1, '', 5, 'Anjala Basheer', '2025-02-15', '02:55:30', 1),
(639, 1142, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '03:55:00', 1),
(640, 1143, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '04:49:30', 1),
(641, 1144, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '05:56:57', 1),
(642, 1145, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '06:30:32', 1),
(643, 1146, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '06:35:08', 1),
(644, 1147, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '07:02:48', 1),
(645, 1147, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '07:03:32', 1),
(646, 1148, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '07:10:21', 1),
(647, 1150, 1, 1, '', 5, 'Anjala Basheer', '2025-02-16', '08:55:04', 1),
(648, 1157, 1, 1, '', 5, 'Anjala Basheer', '2025-02-18', '11:56:37', 1),
(649, 1158, 1, 1, '', 5, 'Anjala Basheer', '2025-02-18', '12:37:36', 1),
(650, 1161, 1, 1, '', 5, 'Anjala Basheer', '2025-02-18', '01:35:39', 1),
(651, 1162, 1, 1, '', 5, 'Anjala Basheer', '2025-02-18', '01:46:56', 1),
(652, 1166, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-19', '11:10:07', 1),
(653, 1167, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-19', '11:16:13', 1),
(654, 1168, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-19', '11:18:05', 1),
(655, 1169, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-19', '11:28:52', 1),
(656, 1170, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-19', '11:31:34', 1),
(657, 1171, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-19', '11:34:56', 1),
(658, 1172, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-19', '11:39:35', 1),
(659, 1182, 1, 1, '', 5, 'Anjala Basheer', '2025-02-20', '03:59:40', 1),
(660, 1184, 1, 1, '', 5, 'Anjala Basheer', '2025-02-20', '06:35:21', 1),
(661, 1185, 1, 1, '', 5, 'Anjala Basheer', '2025-02-20', '07:26:58', 1),
(662, 1186, 1, 1, '', 5, 'Anjala Basheer', '2025-02-20', '07:33:57', 1),
(663, 1188, 1, 1, '', 5, 'Anjala Basheer', '2025-02-20', '09:46:12', 1),
(664, 1188, 2, 2, '', 5, 'Anjala Basheer', '2025-02-20', '09:47:24', 1),
(665, 1189, 2, 2, '', 5, 'Anjala Basheer', '2025-02-20', '09:51:51', 1),
(666, 1191, 1, 1, '', 5, 'Anjala Basheer', '2025-02-21', '10:12:48', 1),
(667, 1194, 1, 1, '', 5, 'Anjala Basheer', '2025-02-21', '02:45:52', 1),
(668, 1198, 1, 1, '', 5, 'Anjala Basheer', '2025-02-22', '09:57:05', 1),
(669, 1199, 1, 1, '', 5, 'Anjala Basheer', '2025-02-22', '10:03:04', 1),
(670, 1200, 1, 1, '', 5, 'Anjala Basheer', '2025-02-22', '10:21:48', 1),
(671, 1201, 1, 1, '', 5, 'Anjala Basheer', '2025-02-22', '11:17:46', 1),
(672, 1203, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-22', '03:43:15', 1),
(673, 1204, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-22', '03:48:14', 1),
(674, 1205, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-22', '04:04:05', 1),
(675, 1207, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-02-22', '06:09:32', 1),
(676, 1209, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-22', '07:24:02', 1),
(677, 1210, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-22', '07:30:32', 1),
(678, 1211, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-02-23', '09:42:27', 1),
(679, 1193, 4, 5, '', 4, 'Shalat Mol Shaji', '2025-02-23', '11:00:22', 1),
(680, 1212, 4, 5, '', 5, 'Anjala Basheer', '2025-02-23', '07:47:39', 1),
(681, 1213, 1, 1, '', 5, 'Anjala Basheer', '2025-02-23', '08:05:23', 1),
(682, 1214, 1, 1, '', 5, 'Anjala Basheer', '2025-02-23', '08:13:51', 1),
(683, 1219, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-02-24', '06:32:35', 1),
(684, 1220, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-24', '06:41:37', 1),
(685, 1225, 1, 1, '', 5, 'Anjala Basheer', '2025-02-25', '04:16:37', 1),
(686, 1226, 1, 1, '', 5, 'Anjala Basheer', '2025-02-25', '04:43:40', 1),
(687, 1228, 1, 1, '', 5, 'Anjala Basheer', '2025-02-25', '05:28:58', 1),
(688, 1231, 1, 1, '', 5, 'Anjala Basheer', '2025-02-25', '06:05:11', 1),
(689, 1232, 1, 1, '', 5, 'Anjala Basheer', '2025-02-25', '09:37:00', 1),
(690, 1011, 3, 3, '', 5, 'Anjala Basheer', '2025-02-25', '10:19:36', 1),
(691, 1234, 2, 2, '', 5, 'Anjala Basheer', '2025-02-26', '09:57:37', 1),
(692, 1235, 2, 2, '', 5, 'Anjala Basheer', '2025-02-26', '10:50:07', 1),
(693, 1236, 1, 1, '', 5, 'Anjala Basheer', '2025-02-26', '11:01:25', 1),
(694, 1237, 1, 1, '', 5, 'Anjala Basheer', '2025-02-26', '11:38:46', 1),
(695, 1238, 2, 2, '', 5, 'Anjala Basheer', '2025-02-26', '11:47:15', 1);
INSERT INTO `stage_flow` (`stage_flow_id`, `stage_flow_lead_id_fk`, `stage_flow_pipeline_id_fk`, `stage_flow_stage_id_fk`, `stage_flow_description`, `stage_flow_created_user_id`, `stage_flow_created_username`, `stage_flow_created_date`, `stage_flow_created_time`, `stage_flow_status`) VALUES
(696, 1241, 1, 1, '', 5, 'Anjala Basheer', '2025-02-26', '02:19:29', 1),
(697, 1243, 1, 1, '', 5, 'Anjala Basheer', '2025-02-26', '03:06:11', 1),
(698, 1244, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-26', '04:58:07', 1),
(699, 1246, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-26', '05:26:31', 1),
(700, 1253, 1, 1, '', 5, 'Anjala Basheer', '2025-02-27', '09:02:44', 1),
(701, 1089, 1, 1, '', 5, 'Anjala Basheer', '2025-02-27', '09:14:37', 1),
(702, 1254, 1, 1, '', 5, 'Anjala Basheer', '2025-02-27', '10:39:39', 1),
(703, 1258, 1, 1, '', 5, 'Anjala Basheer', '2025-02-27', '01:27:18', 1),
(704, 1260, 1, 1, '', 5, 'Anjala Basheer', '2025-02-27', '01:40:54', 1),
(705, 1261, 1, 1, '', 5, 'Anjala Basheer', '2025-02-27', '01:48:41', 1),
(706, 1264, 1, 1, '', 5, 'Anjala Basheer', '2025-02-27', '05:06:59', 1),
(707, 1268, 1, 1, '', 5, 'Anjala Basheer', '2025-02-27', '07:51:48', 1),
(708, 1269, 1, 1, '', 5, 'Anjala Basheer', '2025-02-28', '10:09:54', 1),
(709, 1270, 1, 1, '', 5, 'Anjala Basheer', '2025-02-28', '11:15:05', 1),
(710, 1104, 3, 3, '', 5, 'Anjala Basheer', '2025-02-28', '11:51:29', 1),
(711, 1271, 2, 2, '', 5, 'Anjala Basheer', '2025-02-28', '12:08:40', 1),
(712, 1272, 1, 1, '', 5, 'Anjala Basheer', '2025-02-28', '01:05:26', 1),
(713, 1273, 1, 1, '', 5, 'Anjala Basheer', '2025-02-28', '02:46:17', 1),
(714, 1274, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-28', '03:25:46', 1),
(715, 1278, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-28', '07:46:15', 1),
(716, 1278, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-28', '07:46:26', 1),
(717, 1282, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-02-28', '08:44:04', 1),
(718, 1283, 2, 2, '', 4, 'Shalat Mol Shaji', '2025-02-28', '08:46:52', 1),
(719, 1285, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-02-28', '10:02:37', 1),
(720, 1286, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-01', '09:53:45', 1),
(721, 1265, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-01', '09:58:42', 1),
(722, 1287, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-01', '10:00:56', 1),
(723, 1288, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-01', '10:22:28', 1),
(724, 1289, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-01', '10:25:58', 1),
(725, 1290, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-01', '10:29:08', 1),
(726, 1294, 1, 1, '', 5, 'Anjala Basheer', '2025-03-01', '05:47:53', 1),
(727, 1295, 1, 1, '', 5, 'Anjala Basheer', '2025-03-01', '08:14:47', 1),
(728, 1303, 1, 1, '', 5, 'Anjala Basheer', '2025-03-02', '01:28:12', 1),
(729, 1304, 1, 1, '', 5, 'Anjala Basheer', '2025-03-02', '01:35:54', 1),
(730, 1306, 1, 1, '', 5, 'Anjala Basheer', '2025-03-02', '02:48:11', 1),
(731, 1311, 1, 1, '', 5, 'Anjala Basheer', '2025-03-03', '10:11:56', 1),
(732, 1313, 1, 1, '', 5, 'Anjala Basheer', '2025-03-03', '12:33:19', 1),
(733, 702, 2, 2, '', 5, 'Anjala Basheer', '2025-03-03', '12:46:02', 1),
(734, 1315, 1, 1, '', 5, 'Anjala Basheer', '2025-03-03', '01:30:26', 1),
(735, 1317, 1, 1, '', 5, 'Anjala Basheer', '2025-03-03', '01:40:52', 1),
(736, 1318, 1, 1, '', 5, 'Anjala Basheer', '2025-03-03', '01:55:27', 1),
(737, 1321, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-03', '03:20:38', 1),
(738, 1324, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-03', '05:37:02', 1),
(739, 1327, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-03', '08:17:02', 1),
(740, 1329, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-03', '08:27:25', 1),
(741, 1330, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-03', '08:47:36', 1),
(742, 1331, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-03', '09:24:19', 1),
(743, 1334, 1, 1, '', 5, 'Anjala Basheer', '2025-03-03', '09:46:08', 1),
(744, 1335, 2, 2, '', 5, 'Anjala Basheer', '2025-03-03', '09:56:43', 1),
(745, 1337, 1, 1, '', 5, 'Anjala Basheer', '2025-03-03', '10:05:09', 1),
(746, 1338, 1, 1, '', 5, 'Anjala Basheer', '2025-03-03', '10:16:32', 1),
(747, 1340, 1, 1, '', 5, 'Anjala Basheer', '2025-03-04', '09:10:57', 1),
(748, 1341, 1, 1, '', 5, 'Anjala Basheer', '2025-03-04', '09:22:43', 1),
(749, 1344, 1, 1, '', 5, 'Anjala Basheer', '2025-03-04', '10:36:51', 1),
(750, 511, 1, 1, '', 5, 'Anjala Basheer', '2025-03-04', '11:29:34', 1),
(751, 1349, 2, 2, '', 5, 'Anjala Basheer', '2025-03-04', '04:40:13', 1),
(752, 1348, 1, 1, '', 5, 'Anjala Basheer', '2025-03-04', '04:44:56', 1),
(753, 1351, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-04', '05:36:56', 1),
(754, 1352, 1, 1, '', 5, 'Anjala Basheer', '2025-03-04', '05:40:50', 1),
(755, 1352, 2, 2, '', 5, 'Anjala Basheer', '2025-03-04', '05:42:22', 1),
(756, 1353, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-04', '05:48:09', 1),
(757, 1354, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-04', '06:11:08', 1),
(758, 1358, 2, 2, '', 5, 'Anjala Basheer', '2025-03-04', '10:01:06', 1),
(759, 1359, 2, 2, '', 5, 'Anjala Basheer', '2025-03-04', '10:03:21', 1),
(760, 1360, 2, 2, '', 5, 'Anjala Basheer', '2025-03-04', '10:08:15', 1),
(761, 1361, 1, 1, '', 5, 'Anjala Basheer', '2025-03-04', '10:10:55', 1),
(762, 1362, 2, 2, '', 5, 'Anjala Basheer', '2025-03-04', '10:17:55', 1),
(763, 1363, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '07:16:25', 1),
(764, 1364, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '07:27:17', 1),
(765, 1365, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '09:51:39', 1),
(766, 1366, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '10:57:57', 1),
(767, 1368, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '11:50:20', 1),
(768, 1369, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '11:53:57', 1),
(769, 1370, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '12:31:32', 1),
(770, 1371, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '12:42:26', 1),
(771, 1372, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '12:59:33', 1),
(772, 1373, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-05', '01:07:12', 1),
(773, 1376, 3, 3, '', 5, 'Anjala Basheer', '2025-03-05', '03:19:49', 1),
(774, 1378, 1, 1, '', 5, 'Anjala Basheer', '2025-03-05', '05:26:39', 1),
(775, 1379, 1, 1, '', 5, 'Anjala Basheer', '2025-03-05', '06:06:28', 1),
(776, 0, 1, 1, '', 5, 'Anjala Basheer', '2025-03-05', '07:26:44', 1),
(777, 1343, 1, 1, '', 5, 'Anjala Basheer', '2025-03-05', '08:04:02', 1),
(778, 449, 1, 1, '', 5, 'Anjala Basheer', '2025-03-06', '08:13:17', 1),
(779, 1386, 1, 1, '', 5, 'Anjala Basheer', '2025-03-06', '12:30:37', 1),
(780, 1387, 1, 1, '', 5, 'Anjala Basheer', '2025-03-06', '12:49:03', 1),
(781, 1390, 1, 1, '', 5, 'Anjala Basheer', '2025-03-06', '02:50:07', 1),
(782, 1392, 1, 1, '', 5, 'Anjala Basheer', '2025-03-06', '07:01:41', 1),
(783, 1393, 1, 1, '', 5, 'Anjala Basheer', '2025-03-06', '07:38:11', 1),
(784, 1396, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '10:13:01', 1),
(785, 1398, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '11:43:08', 1),
(786, 1401, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '01:09:48', 1),
(787, 1403, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '02:54:13', 1),
(788, 1404, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '03:08:47', 1),
(789, 1405, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '03:11:27', 1),
(790, 1406, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '03:13:42', 1),
(791, 1407, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '03:18:44', 1),
(792, 1408, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '03:21:29', 1),
(793, 1409, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '03:23:10', 1),
(794, 1410, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '08:54:10', 1),
(795, 1411, 1, 1, '', 5, 'Anjala Basheer', '2025-03-07', '09:03:02', 1),
(796, 1413, 1, 1, '', 5, 'Anjala Basheer', '2025-03-08', '11:57:23', 1),
(797, 1435, 3, 3, '', 5, 'Anjala Basheer', '2025-03-10', '08:23:31', 1),
(798, 1438, 1, 1, '', 5, 'Anjala Basheer', '2025-03-10', '08:56:13', 1),
(799, 1436, 1, 1, '', 5, 'Anjala Basheer', '2025-03-10', '09:22:09', 1),
(800, 1111, 1, 1, '', 5, 'Anjala Basheer', '2025-03-10', '10:46:03', 1),
(801, 1444, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-10', '05:13:48', 1),
(802, 1452, 2, 2, '', 5, 'Anjala Basheer', '2025-03-11', '08:28:49', 1),
(803, 1458, 1, 1, '', 5, 'Anjala Basheer', '2025-03-12', '11:39:12', 1),
(804, 1459, 1, 1, '', 5, 'Anjala Basheer', '2025-03-12', '11:46:45', 1),
(805, 1462, 1, 1, '', 5, 'Anjala Basheer', '2025-03-12', '01:13:15', 1),
(806, 1470, 1, 1, '', 5, 'Anjala Basheer', '2025-03-13', '11:04:37', 1),
(807, 1471, 1, 1, '', 5, 'Anjala Basheer', '2025-03-13', '11:48:19', 1),
(808, 1472, 1, 1, '', 5, 'Anjala Basheer', '2025-03-13', '11:51:39', 1),
(809, 1473, 1, 1, '', 5, 'Anjala Basheer', '2025-03-13', '11:55:22', 1),
(810, 1468, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-13', '05:48:45', 1),
(811, 1479, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-14', '10:38:22', 1),
(812, 1480, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-14', '10:53:19', 1),
(813, 1481, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-14', '11:05:06', 1),
(814, 1496, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-16', '12:53:02', 1),
(815, 1497, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-16', '02:29:36', 1),
(816, 1491, 1, 1, '', 5, 'Anjala Basheer', '2025-03-16', '05:12:54', 1),
(817, 1500, 1, 1, '', 5, 'Anjala Basheer', '2025-03-16', '07:13:57', 1),
(818, 1504, 1, 1, '', 5, 'Anjala Basheer', '2025-03-17', '12:05:32', 1),
(819, 1505, 1, 1, '', 5, 'Anjala Basheer', '2025-03-17', '12:42:00', 1),
(820, 1507, 1, 1, '', 5, 'Anjala Basheer', '2025-03-17', '01:10:41', 1),
(821, 1511, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-18', '04:11:45', 1),
(822, 1512, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-19', '07:24:13', 1),
(823, 1513, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-19', '07:42:22', 1),
(824, 1517, 1, 1, '', 5, 'Anjala Basheer', '2025-03-19', '05:14:51', 1),
(825, 1518, 1, 1, '', 5, 'Anjala Basheer', '2025-03-19', '05:44:36', 1),
(826, 1519, 1, 1, '', 5, 'Anjala Basheer', '2025-03-19', '05:53:53', 1),
(827, 1483, 1, 1, '', 5, 'Anjala Basheer', '2025-03-20', '11:45:42', 1),
(828, 1532, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-22', '12:13:54', 1),
(829, 1533, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-22', '12:29:12', 1),
(830, 1534, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-22', '12:34:20', 1),
(831, 1535, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-22', '12:37:04', 1),
(832, 1536, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-22', '12:38:54', 1),
(833, 1537, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-22', '12:40:54', 1),
(834, 1538, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-22', '12:45:03', 1),
(835, 1539, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-22', '05:38:40', 1),
(836, 1543, 1, 1, '', 4, 'Shalat Mol Shaji', '2025-03-23', '12:41:04', 1),
(837, 1547, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '11:09:49', 1),
(838, 1550, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '12:52:32', 1),
(839, 1551, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '12:56:23', 1),
(840, 1552, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '12:58:52', 1),
(841, 1553, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '01:01:37', 1),
(842, 1554, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '01:05:10', 1),
(843, 1555, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '01:08:52', 1),
(844, 1556, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '01:12:55', 1),
(845, 1557, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '01:16:03', 1),
(846, 1558, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '01:25:21', 1),
(847, 1559, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '01:30:03', 1),
(848, 1560, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '01:33:29', 1),
(849, 1561, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '01:38:24', 1),
(850, 1562, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '01:42:02', 1),
(851, 1563, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '01:46:01', 1),
(852, 1564, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '01:56:06', 1),
(853, 1565, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '01:59:14', 1),
(854, 1566, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '02:03:41', 1),
(855, 1567, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '03:07:46', 1),
(856, 1568, 1, 1, '', 5, 'Anjala Basheer', '2025-03-24', '03:42:31', 1),
(857, 1569, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '04:03:02', 1),
(858, 1571, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '06:30:39', 1),
(859, 1572, 2, 2, '', 5, 'Anjala Basheer', '2025-03-24', '06:36:58', 1),
(860, 1490, 1, 1, '', 5, 'Anjala Basheer', '2025-03-25', '09:35:26', 1),
(861, 1575, 1, 1, '', 5, 'Anjala Basheer', '2025-03-25', '10:08:39', 1),
(862, 326, 3, 3, '', 5, 'Anjala Basheer', '2025-03-25', '10:13:13', 1),
(863, 1579, 1, 1, '', 5, 'Anjala Basheer', '2025-03-25', '01:45:17', 1),
(864, 1581, 1, 1, '', 5, 'Anjala Basheer', '2025-03-25', '04:25:08', 1),
(865, 1582, 1, 1, '', 5, 'Anjala Basheer', '2025-03-25', '07:49:48', 1),
(866, 1583, 1, 1, '', 5, 'Anjala Basheer', '2025-03-25', '08:07:07', 1),
(867, 1594, 2, 2, '', 5, 'Anjala Basheer', '2025-03-26', '05:29:01', 1),
(868, 1604, 1, 1, '', 5, 'Anjala Basheer', '2025-03-27', '10:44:14', 1),
(869, 1606, 1, 1, '', 5, 'Anjala Basheer', '2025-03-28', '01:21:08', 1),
(870, 1609, 1, 1, '', 5, 'Anjala Basheer', '2025-03-29', '09:18:48', 1),
(871, 1610, 1, 1, '', 5, 'Anjala Basheer', '2025-03-29', '12:05:12', 1),
(872, 1618, 1, 1, '', 5, 'Anjala Basheer', '2025-03-30', '09:34:48', 1),
(873, 1061, 4, 5, '', 5, 'Anjala Basheer', '2025-04-07', '08:27:18', 1),
(874, 1680, 2, 2, '', 5, 'Anjala Basheer', '2025-04-07', '04:52:13', 1),
(875, 1681, 2, 2, '', 5, 'Anjala Basheer', '2025-04-07', '04:57:20', 1),
(876, 1684, 1, 1, '', 5, 'Anjala Basheer', '2025-04-08', '12:56:33', 1),
(877, 1685, 2, 2, '', 5, 'Anjala Basheer', '2025-04-08', '01:07:59', 1),
(878, 1686, 2, 2, '', 5, 'Anjala Basheer', '2025-04-08', '01:09:53', 1),
(879, 1687, 2, 2, '', 5, 'Anjala Basheer', '2025-04-08', '01:27:51', 1),
(880, 1688, 2, 2, '', 5, 'Anjala Basheer', '2025-04-08', '01:37:32', 1),
(881, 1689, 1, 1, '', 5, 'Anjala Basheer', '2025-04-08', '01:43:18', 1),
(882, 1690, 2, 2, '', 5, 'Anjala Basheer', '2025-04-08', '01:48:46', 1),
(883, 1691, 1, 1, '', 5, 'Anjala Basheer', '2025-04-08', '01:57:18', 1),
(884, 1692, 2, 2, '', 5, 'Anjala Basheer', '2025-04-08', '02:03:34', 1),
(885, 1693, 1, 1, '', 5, 'Anjala Basheer', '2025-04-08', '02:10:54', 1),
(886, 1694, 1, 1, '', 5, 'Anjala Basheer', '2025-04-08', '02:16:27', 1),
(887, 1702, 1, 1, '', 5, 'Anjala Basheer', '2025-04-09', '11:16:50', 1),
(888, 1706, 1, 1, '', 5, 'Anjala Basheer', '2025-04-09', '01:05:20', 1),
(889, 1712, 2, 2, '', 5, 'Anjala Basheer', '2025-04-10', '05:38:33', 1),
(890, 1713, 1, 1, '', 5, 'Anjala Basheer', '2025-04-10', '05:42:19', 1),
(891, 1714, 1, 1, '', 5, 'Anjala Basheer', '2025-04-10', '05:44:50', 1),
(892, 1715, 2, 2, '', 5, 'Anjala Basheer', '2025-04-10', '05:48:24', 1),
(893, 1716, 2, 2, '', 5, 'Anjala Basheer', '2025-04-10', '06:07:26', 1),
(894, 1717, 2, 2, '', 5, 'Anjala Basheer', '2025-04-10', '06:09:36', 1),
(895, 1718, 1, 1, '', 5, 'Anjala Basheer', '2025-04-10', '06:11:03', 1),
(896, 1719, 2, 2, '', 5, 'Anjala Basheer', '2025-04-10', '06:12:36', 1),
(897, 1720, 1, 1, '', 5, 'Anjala Basheer', '2025-04-10', '06:14:08', 1),
(898, 1721, 1, 1, '', 6, 'Anshida C A', '2025-04-10', '12:26:21', 1),
(899, 1744, 2, 2, '', 5, 'Anjala Basheer', '2025-04-15', '12:52:53', 1),
(900, 1745, 2, 2, '', 5, 'Anjala Basheer', '2025-04-15', '12:58:24', 1),
(901, 1746, 1, 1, '', 5, 'Anjala Basheer', '2025-04-15', '01:50:59', 1),
(902, 1747, 1, 1, '', 5, 'Anjala Basheer', '2025-04-15', '01:55:00', 1),
(903, 1749, 2, 2, '', 5, 'Anjala Basheer', '2025-04-15', '05:11:03', 1),
(904, 1755, 1, 1, '', 5, 'Anjala Basheer', '2025-04-16', '12:15:41', 1),
(905, 0, 1, 1, '', 5, 'Anjala Basheer', '2025-04-17', '01:57:08', 1),
(906, 1765, 1, 1, '', 6, 'Anshida C A', '2025-04-18', '05:21:53', 1),
(907, 1766, 1, 1, '', 6, 'Anshida C A', '2025-04-18', '05:33:30', 1),
(908, 1770, 1, 1, '', 6, 'Anshida C A', '2025-04-19', '11:57:56', 1),
(909, 1771, 1, 1, '', 5, 'Anjala Basheer', '2025-04-19', '12:28:12', 1),
(910, 1772, 1, 1, '', 5, 'Anjala Basheer', '2025-04-19', '12:36:15', 1),
(911, 1773, 2, 2, '', 5, 'Anjala Basheer', '2025-04-19', '03:34:23', 1),
(912, 1774, 1, 1, '', 6, 'Anshida C A', '2025-04-19', '03:53:01', 1),
(913, 1776, 1, 1, '', 6, 'Anshida C A', '2025-04-20', '09:56:29', 1),
(914, 1778, 2, 2, '', 5, 'Anjala Basheer', '2025-04-20', '01:59:35', 1),
(915, 1783, 1, 1, '', 6, 'Anshida C A', '2025-04-20', '02:34:47', 1),
(916, 1784, 1, 1, '', 6, 'Anshida C A', '2025-04-20', '02:37:09', 1),
(917, 1785, 1, 1, '', 6, 'Anshida C A', '2025-04-20', '02:43:28', 1),
(918, 1787, 1, 1, '', 6, 'Anshida C A', '2025-04-20', '02:56:46', 1),
(919, 1788, 1, 1, '', 6, 'Anshida C A', '2025-04-20', '03:10:39', 1),
(920, 1789, 1, 1, '', 6, 'Anshida C A', '2025-04-20', '03:20:37', 1),
(921, 1791, 1, 1, '', 6, 'Anshida C A', '2025-04-21', '10:52:10', 1),
(922, 1793, 1, 1, '', 6, 'Anshida C A', '2025-04-21', '11:55:34', 1),
(923, 1796, 1, 1, '', 6, 'Anshida C A', '2025-04-21', '04:28:48', 1),
(924, 1797, 1, 1, '', 6, 'Anshida C A', '2025-04-21', '04:35:54', 1),
(925, 1799, 1, 1, '', 6, 'Anshida C A', '2025-04-21', '06:10:11', 1),
(926, 1818, 1, 1, '', 5, 'Anjala Basheer', '2025-04-23', '07:46:57', 1),
(927, 1823, 1, 1, '', 5, 'Anjala Basheer', '2025-04-23', '09:18:16', 1),
(928, 1605, 1, 1, '', 5, 'Anjala Basheer', '2025-04-24', '10:21:10', 1),
(929, 1820, 1, 1, '', 5, 'Anjala Basheer', '2025-04-24', '10:38:02', 1),
(930, 1672, 1, 1, '', 5, 'Anjala Basheer', '2025-04-24', '10:42:37', 1),
(931, 1815, 1, 1, '', 5, 'Anjala Basheer', '2025-04-24', '11:38:47', 1),
(932, 1822, 1, 1, '', 5, 'Anjala Basheer', '2025-04-24', '12:31:11', 1),
(933, 1834, 1, 1, '', 5, 'Anjala Basheer', '2025-04-25', '03:22:21', 1),
(934, 1835, 2, 2, '', 5, 'Anjala Basheer', '2025-04-25', '03:31:25', 1),
(935, 1836, 2, 2, '', 5, 'Anjala Basheer', '2025-04-25', '03:34:49', 1),
(936, 1837, 2, 2, '', 5, 'Anjala Basheer', '2025-04-25', '03:41:39', 1),
(937, 1838, 1, 1, '', 5, 'Anjala Basheer', '2025-04-25', '03:49:00', 1),
(938, 1839, 2, 2, '', 5, 'Anjala Basheer', '2025-04-25', '04:07:41', 1),
(939, 1840, 1, 1, '', 5, 'Anjala Basheer', '2025-04-25', '04:14:15', 1),
(940, 1841, 2, 2, '', 5, 'Anjala Basheer', '2025-04-25', '04:22:33', 1),
(941, 448, 1, 1, '', 5, 'Anjala Basheer', '2025-04-25', '05:08:31', 1),
(942, 1843, 1, 1, '', 6, 'Anshida C A', '2025-04-26', '09:49:51', 1),
(943, 1844, 1, 1, '', 6, 'Anshida C A', '2025-04-26', '09:56:40', 1),
(944, 1846, 1, 1, '', 6, 'Anshida C A', '2025-04-26', '10:01:49', 1),
(945, 1847, 1, 1, '', 6, 'Anshida C A', '2025-04-26', '10:09:45', 1),
(946, 1853, 1, 1, '', 5, 'Anjala Basheer', '2025-04-26', '08:39:59', 1),
(947, 1863, 1, 1, '', 5, 'Anjala Basheer', '2025-04-28', '05:21:37', 1),
(948, 1864, 1, 1, '', 5, 'Anjala Basheer', '2025-04-28', '06:09:38', 1),
(949, 1751, 2, 2, '', 5, 'Anjala Basheer', '2025-04-28', '06:34:51', 1),
(950, 1867, 1, 1, '', 5, 'Anjala Basheer', '2025-04-28', '09:05:22', 1),
(951, 1868, 1, 1, '', 6, 'Anshida C A', '2025-04-29', '08:04:10', 1),
(952, 1869, 1, 1, '', 6, 'Anshida C A', '2025-04-29', '08:28:10', 1),
(953, 1870, 1, 1, '', 6, 'Anshida C A', '2025-04-29', '08:37:27', 1),
(954, 1873, 2, 2, '', 6, 'Anshida C A', '2025-04-29', '12:17:48', 1),
(955, 1874, 1, 1, '', 6, 'Anshida C A', '2025-04-29', '12:21:40', 1),
(956, 1881, 2, 2, '', 5, 'Anjala Basheer', '2025-04-29', '10:33:31', 1),
(957, 1882, 2, 2, '', 5, 'Anjala Basheer', '2025-04-29', '10:36:52', 1),
(958, 1883, 2, 2, '', 5, 'Anjala Basheer', '2025-04-29', '10:43:16', 1),
(959, 1884, 2, 2, '', 5, 'Anjala Basheer', '2025-04-29', '10:45:42', 1),
(960, 1885, 1, 1, '', 5, 'Anjala Basheer', '2025-04-30', '02:52:16', 1),
(961, 1895, 1, 1, '', 5, 'Anjala Basheer', '2025-05-01', '04:50:03', 1),
(962, 1896, 1, 1, '', 5, 'Anjala Basheer', '2025-05-01', '06:33:37', 1),
(963, 1897, 1, 1, '', 5, 'Anjala Basheer', '2025-05-01', '07:09:39', 1),
(964, 1915, 1, 1, '', 5, 'Anjala Basheer', '2025-05-05', '12:27:42', 1),
(965, 1916, 1, 1, '', 5, 'Anjala Basheer', '2025-05-05', '12:31:58', 1),
(966, 1917, 2, 2, '', 5, 'Anjala Basheer', '2025-05-05', '12:38:27', 1),
(967, 1918, 2, 2, '', 5, 'Anjala Basheer', '2025-05-05', '12:42:27', 1),
(968, 1928, 4, 5, '', 5, 'Anjala Basheer', '2025-05-06', '04:27:27', 1),
(969, 0, 1, 1, '', 5, 'Anjala Basheer', '2025-05-06', '05:36:30', 1),
(970, 1886, 1, 1, '', 5, 'Anjala Basheer', '2025-05-06', '05:44:10', 1),
(971, 1930, 1, 1, '', 5, 'Anjala Basheer', '2025-05-06', '06:56:28', 1),
(972, 1931, 1, 1, '', 5, 'Anjala Basheer', '2025-05-06', '08:18:12', 1),
(973, 672, 3, 3, '', 5, 'Anjala Basheer', '2025-05-06', '09:05:46', 1),
(974, 1934, 1, 1, '', 5, 'Anjala Basheer', '2025-05-07', '01:16:43', 1),
(975, 1935, 1, 1, '', 5, 'Anjala Basheer', '2025-05-07', '01:31:27', 1),
(976, 1936, 1, 1, '', 5, 'Anjala Basheer', '2025-05-07', '02:22:55', 1),
(977, 1176, 1, 1, '', 5, 'Anjala Basheer', '2025-05-08', '07:38:27', 1),
(978, 1947, 1, 1, '', 5, 'Anjala Basheer', '2025-05-08', '02:12:54', 1),
(979, 1948, 1, 1, '', 5, 'Anjala Basheer', '2025-05-08', '02:56:50', 1),
(980, 1957, 1, 1, '', 5, 'Anjala Basheer', '2025-05-09', '03:21:15', 1),
(981, 1958, 1, 1, '', 5, 'Anjala Basheer', '2025-05-09', '03:46:22', 1),
(982, 1960, 1, 1, '', 5, 'Anjala Basheer', '2025-05-09', '04:37:47', 1),
(983, 1961, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '04:43:19', 1),
(984, 1962, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '04:48:49', 1),
(985, 1963, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '04:57:36', 1),
(986, 1964, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '05:02:55', 1),
(987, 1965, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '05:07:25', 1),
(988, 1966, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '06:12:07', 1),
(989, 1967, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '06:15:08', 1),
(990, 1968, 1, 1, '', 5, 'Anjala Basheer', '2025-05-09', '06:24:53', 1),
(991, 1969, 1, 1, '', 5, 'Anjala Basheer', '2025-05-09', '06:30:30', 1),
(992, 1970, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '06:36:31', 1),
(993, 1971, 2, 2, '', 5, 'Anjala Basheer', '2025-05-09', '06:40:54', 1),
(994, 1974, 1, 1, '', 5, 'Anjala Basheer', '2025-05-10', '10:31:29', 1),
(995, 1975, 1, 1, '', 5, 'Anjala Basheer', '2025-05-10', '11:34:53', 1),
(996, 1976, 1, 1, '', 5, 'Anjala Basheer', '2025-05-10', '01:37:22', 1),
(997, 1925, 3, 3, '', 5, 'Anjala Basheer', '2025-05-10', '07:08:07', 1),
(998, 1980, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '09:40:36', 1),
(999, 1981, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '09:47:36', 1),
(1000, 1982, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '10:00:39', 1),
(1001, 1983, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '10:07:10', 1),
(1002, 1984, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '11:25:02', 1),
(1003, 1985, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '11:33:14', 1),
(1004, 1986, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '11:50:04', 1),
(1005, 1988, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '01:18:59', 1),
(1006, 1990, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '02:24:37', 1),
(1007, 1991, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '02:29:16', 1),
(1008, 1992, 1, 1, '', 6, 'Anshida C A', '2025-05-11', '02:37:01', 1),
(1009, 2002, 1, 1, '', 5, 'Anjala Basheer', '2025-05-12', '09:53:30', 1),
(1010, 2003, 1, 1, '', 5, 'Anjala Basheer', '2025-05-12', '10:08:18', 1),
(1011, 1180, 1, 1, '', 5, 'Anjala Basheer', '2025-05-12', '10:42:31', 1),
(1012, 2004, 1, 1, '', 5, 'Anjala Basheer', '2025-05-12', '12:38:33', 1),
(1013, 2006, 2, 2, '', 5, 'Anjala Basheer', '2025-05-12', '02:51:57', 1),
(1014, 2007, 1, 1, '', 5, 'Anjala Basheer', '2025-05-12', '02:55:40', 1),
(1015, 2008, 2, 2, '', 5, 'Anjala Basheer', '2025-05-12', '02:58:32', 1),
(1016, 2009, 2, 2, '', 5, 'Anjala Basheer', '2025-05-12', '03:02:26', 1),
(1017, 2010, 1, 1, '', 5, 'Anjala Basheer', '2025-05-12', '03:06:29', 1),
(1018, 2020, 1, 1, '', 5, 'Anjala Basheer', '2025-05-13', '03:26:06', 1),
(1019, 2022, 1, 1, '', 5, 'Anjala Basheer', '2025-05-13', '06:59:40', 1),
(1020, 0, 4, 5, '', 5, 'Anjala Basheer', '2025-05-14', '08:40:44', 1),
(1021, 2026, 1, 1, '', 5, 'Anjala Basheer', '2025-05-14', '09:01:57', 1),
(1022, 2027, 1, 1, '', 5, 'Anjala Basheer', '2025-05-14', '09:22:10', 1),
(1023, 2028, 1, 1, '', 5, 'Anjala Basheer', '2025-05-14', '11:43:11', 1),
(1024, 2029, 1, 1, '', 5, 'Anjala Basheer', '2025-05-14', '11:46:59', 1),
(1025, 2030, 1, 1, '', 5, 'Anjala Basheer', '2025-05-14', '12:15:59', 1),
(1026, 2031, 1, 1, '', 5, 'Anjala Basheer', '2025-05-14', '01:03:12', 1),
(1027, 2033, 1, 1, '', 5, 'Anjala Basheer', '2025-05-14', '01:35:51', 1),
(1028, 2034, 1, 1, '', 5, 'Anjala Basheer', '2025-05-14', '03:01:06', 1),
(1029, 2038, 1, 1, '', 5, 'Anjala Basheer', '2025-05-15', '03:21:54', 1),
(1030, 2039, 2, 2, '', 5, 'Anjala Basheer', '2025-05-15', '03:25:22', 1),
(1031, 2040, 2, 2, '', 5, 'Anjala Basheer', '2025-05-15', '03:28:26', 1),
(1032, 2041, 2, 2, '', 5, 'Anjala Basheer', '2025-05-15', '03:32:03', 1),
(1033, 2042, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '03:15:33', 1),
(1034, 2043, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '03:26:02', 1),
(1035, 2044, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '03:37:05', 1),
(1036, 2045, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '04:02:00', 1),
(1037, 2046, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '04:16:43', 1),
(1038, 2047, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '04:24:37', 1),
(1039, 2048, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '04:34:05', 1),
(1040, 2049, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '04:49:28', 1),
(1041, 2050, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '05:40:32', 1),
(1042, 2051, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '06:21:23', 1),
(1043, 2052, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '06:32:19', 1),
(1044, 2053, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '06:38:56', 1),
(1045, 2054, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '06:44:37', 1),
(1046, 2055, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '07:09:22', 1),
(1047, 2056, 1, 1, '', 6, 'Anshida C A', '2025-05-16', '07:12:59', 1),
(1048, 2076, 1, 1, '', 5, 'Anjala Basheer', '2025-05-19', '10:12:18', 1),
(1049, 2077, 2, 2, '', 5, 'Anjala Basheer', '2025-05-19', '10:18:27', 1),
(1050, 2078, 2, 2, '', 5, 'Anjala Basheer', '2025-05-19', '10:22:57', 1),
(1051, 2079, 1, 1, '', 5, 'Anjala Basheer', '2025-05-19', '10:30:31', 1),
(1052, 2080, 2, 2, '', 5, 'Anjala Basheer', '2025-05-19', '10:36:55', 1),
(1053, 2081, 1, 1, '', 5, 'Anjala Basheer', '2025-05-19', '10:48:00', 1),
(1054, 2083, 1, 1, '', 5, 'Anjala Basheer', '2025-05-19', '11:47:37', 1),
(1055, 2084, 1, 1, '', 5, 'Anjala Basheer', '2025-05-19', '11:56:45', 1),
(1056, 2088, 1, 1, '', 5, 'Anjala Basheer', '2025-05-19', '01:35:39', 1),
(1057, 2089, 1, 1, '', 5, 'Anjala Basheer', '2025-05-19', '02:43:39', 1),
(1058, 2098, 1, 1, '', 5, 'Anjala Basheer', '2025-05-20', '02:24:39', 1),
(1059, 2100, 1, 1, '', 6, 'Anshida C A', '2025-05-20', '08:14:37', 1),
(1060, 2112, 1, 1, '', 5, 'Anjala Basheer', '2025-05-21', '08:42:45', 1),
(1061, 2113, 1, 1, '', 5, 'Anjala Basheer', '2025-05-21', '09:17:34', 1),
(1062, 2118, 1, 1, '', 5, 'Anjala Basheer', '2025-05-22', '11:12:16', 1),
(1063, 2119, 2, 2, '', 5, 'Anjala Basheer', '2025-05-22', '11:15:01', 1),
(1064, 2120, 2, 2, '', 5, 'Anjala Basheer', '2025-05-22', '11:19:56', 1),
(1065, 2122, 1, 1, '', 5, 'Anjala Basheer', '2025-05-22', '11:22:40', 1),
(1066, 2123, 2, 2, '', 5, 'Anjala Basheer', '2025-05-22', '11:27:43', 1),
(1067, 2124, 1, 1, '', 5, 'Anjala Basheer', '2025-05-22', '11:31:03', 1),
(1068, 2125, 1, 1, '', 5, 'Anjala Basheer', '2025-05-22', '11:35:44', 1),
(1069, 2111, 1, 1, '', 5, 'Anjala Basheer', '2025-05-22', '03:02:42', 1),
(1070, 2152, 1, 1, '', 5, 'Anjala Basheer', '2025-05-25', '06:36:13', 1),
(1071, 2154, 1, 1, '', 5, 'Anjala Basheer', '2025-05-25', '07:22:29', 1),
(1072, 2168, 1, 1, '', 5, 'Anjala Basheer', '2025-05-27', '08:50:15', 1),
(1073, 2169, 1, 1, '', 5, 'Anjala Basheer', '2025-05-27', '08:53:56', 1),
(1074, 2190, 1, 1, '', 5, 'Anjala Basheer', '2025-05-29', '05:05:18', 1),
(1075, 2191, 1, 1, '', 5, 'Anjala Basheer', '2025-05-29', '05:11:39', 1),
(1076, 2192, 1, 1, '', 5, 'Anjala Basheer', '2025-05-29', '05:17:42', 1),
(1077, 2193, 1, 1, '', 5, 'Anjala Basheer', '2025-05-29', '05:21:50', 1),
(1078, 2194, 1, 1, '', 5, 'Anjala Basheer', '2025-05-29', '05:25:44', 1),
(1079, 2195, 2, 2, '', 5, 'Anjala Basheer', '2025-05-29', '05:37:26', 1),
(1080, 2196, 2, 2, '', 5, 'Anjala Basheer', '2025-05-29', '05:40:26', 1),
(1081, 2197, 1, 1, '', 5, 'Anjala Basheer', '2025-05-29', '05:46:23', 1),
(1082, 2198, 1, 1, '', 5, 'Anjala Basheer', '2025-05-29', '05:50:19', 1),
(1083, 2199, 1, 1, '', 5, 'Anjala Basheer', '2025-05-29', '05:54:17', 1),
(1084, 2200, 2, 2, '', 5, 'Anjala Basheer', '2025-05-29', '06:05:13', 1),
(1085, 2215, 1, 1, '', 5, 'Anjala Basheer', '2025-05-31', '08:56:11', 1),
(1086, 2257, 1, 1, '', 5, 'Anjala Basheer', '2025-06-03', '09:32:58', 1),
(1087, 2272, 1, 1, '', 5, 'Anjala Basheer', '2025-06-05', '07:51:44', 1),
(1088, 1252, 1, 1, '', 5, 'Anjala Basheer', '2025-06-05', '12:08:50', 1),
(1089, 2276, 1, 1, '', 6, 'Anshida C A', '2025-06-05', '03:26:44', 1),
(1090, 2277, 1, 1, '', 6, 'Anshida C A', '2025-06-05', '03:36:57', 1),
(1091, 2278, 1, 1, '', 6, 'Anshida C A', '2025-06-05', '03:47:03', 1),
(1092, 2279, 1, 1, '', 6, 'Anshida C A', '2025-06-05', '03:52:08', 1),
(1093, 2280, 1, 1, 'yes', 6, 'Anshida C A', '2025-06-05', '03:57:11', 1),
(1094, 2281, 1, 1, '', 6, 'Anshida C A', '2025-06-05', '04:10:32', 1),
(1095, 2283, 1, 1, '', 6, 'Anshida C A', '2025-06-05', '04:36:47', 1),
(1096, 2284, 1, 1, '', 6, 'Anshida C A', '2025-06-05', '04:41:13', 1);

-- --------------------------------------------------------

--
-- Table structure for table `state`
--

CREATE TABLE IF NOT EXISTS `state` (
  `state_id` int(11) NOT NULL AUTO_INCREMENT,
  `country_id_fk` int(11) NOT NULL,
  `state_name` varchar(255) NOT NULL,
  `state_description` text NOT NULL,
  `state_created_date` date NOT NULL,
  `state_created_time` time NOT NULL,
  `state_created_user_id` int(11) NOT NULL,
  `state_created_user_name` varchar(255) NOT NULL,
  `state_status` int(11) NOT NULL,
  PRIMARY KEY (`state_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `state`
--

INSERT INTO `state` (`state_id`, `country_id_fk`, `state_name`, `state_description`, `state_created_date`, `state_created_time`, `state_created_user_id`, `state_created_user_name`, `state_status`) VALUES
(1, 99, 'KERALA', '', '0000-00-00', '00:00:00', 0, '', 1),
(4, 99, 'KARNATAKA', 'DDF', '2024-08-28', '08:15:47', 1, 'Super admin', 1);

-- --------------------------------------------------------

--
-- Table structure for table `terms_condition`
--

CREATE TABLE IF NOT EXISTS `terms_condition` (
  `terms_condition_id` int(11) NOT NULL AUTO_INCREMENT,
  `terms_condition_name` varchar(255) NOT NULL,
  `terms_condition_createdby_user_id` int(11) NOT NULL,
  `terms_condition_createdby_user_name` varchar(255) NOT NULL,
  `terms_condition_created_date` date NOT NULL,
  `terms_condition_created_time` time NOT NULL,
  `terms_condition_status` int(11) NOT NULL,
  PRIMARY KEY (`terms_condition_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `terms_condition`
--


-- --------------------------------------------------------

--
-- Table structure for table `terms_condition_items`
--

CREATE TABLE IF NOT EXISTS `terms_condition_items` (
  `terms_condition_items_id` int(11) NOT NULL AUTO_INCREMENT,
  `terms_condition_id_fk` int(11) NOT NULL,
  `terms_condition_items_name` text NOT NULL,
  `terms_condition_items_status` int(11) NOT NULL,
  PRIMARY KEY (`terms_condition_items_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `terms_condition_items`
--

INSERT INTO `terms_condition_items` (`terms_condition_items_id`, `terms_condition_id_fk`, `terms_condition_items_name`, `terms_condition_items_status`) VALUES
(1, 1, 'gfd1_edited', 1),
(2, 1, 'da2_edited', 1),
(3, 1, 'sd3_edited', 1),
(4, 1, 'gh4', 1);

-- --------------------------------------------------------

--
-- Table structure for table `transporter`
--

CREATE TABLE IF NOT EXISTS `transporter` (
  `transporter_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `transporter_status` int(11) NOT NULL,
  PRIMARY KEY (`transporter_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `transporter`
--

INSERT INTO `transporter` (`transporter_id`, `transporter_name`, `transporter_base_station_id_fk`, `transporter_address`, `transporter_contact_person_name1`, `transporter_contact_person_email1`, `transporter_contact_person_contact_num1`, `transporter_contact_person_contact_num12`, `transporter_contact_person_name2`, `transporter_contact_person_email2`, `transporter_contact_person_contact_num2`, `transporter_contact_person_contact_num22`, `transporter_bank_name`, `transporter_bank_account_number`, `transporter_bank_account_name`, `transporter_bank_account_ifsc_code`, `transporter_bank_account_branch`, `transporter_bank_swift_code`, `transporter_createdby_user_id`, `transporter_createdby_user_name`, `transporter_created_date`, `transporter_created_time`, `transporter_status`) VALUES
(1, 'Fahadhh', 4, 'sfds', 'hsdf', 'gh@', '33', '434', 'dfsfd', 'dfd@', '34433', '434', 'dggf', '454545', 'fgdg', '4545', 'fdg', 'gfd334', 0, '', '2025-07-23', '05:16:37', 0),
(2, 'hjhj', 1, 'hj', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-24', '08:16:09', 0),
(3, 'jkhj', 1, 'hk', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 0, '', '2025-07-24', '08:28:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `transporter_vehicle`
--

CREATE TABLE IF NOT EXISTS `transporter_vehicle` (
  `transporter_vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `transporter_id_fk` int(11) NOT NULL,
  `vehicle_id_fk` int(11) NOT NULL,
  `transporter_vehicle_status` int(11) NOT NULL,
  PRIMARY KEY (`transporter_vehicle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=13 ;

--
-- Dumping data for table `transporter_vehicle`
--

INSERT INTO `transporter_vehicle` (`transporter_vehicle_id`, `transporter_id_fk`, `vehicle_id_fk`, `transporter_vehicle_status`) VALUES
(8, 1, 4, 1),
(9, 2, 11, 1),
(10, 2, 13, 1),
(11, 3, 2, 1),
(12, 3, 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `upload_tariff_document`
--

CREATE TABLE IF NOT EXISTS `upload_tariff_document` (
  `upload_tariff_document_id` int(11) NOT NULL AUTO_INCREMENT,
  `property_id_fk` int(11) NOT NULL,
  `upload_tariff_document_from_date` date NOT NULL,
  `upload_tariff_document_to_date` date NOT NULL,
  `upload_tariff_document_name` varchar(255) NOT NULL,
  `upload_tariff_document_description` text NOT NULL,
  `upload_tariff_document_created_by_user_id` int(11) NOT NULL,
  `upload_tariff_document_created_by_user_name` varchar(255) NOT NULL,
  `upload_tariff_document_created_date` date NOT NULL,
  `upload_tariff_document_created_time` time NOT NULL,
  `upload_tariff_document_status` int(11) NOT NULL,
  PRIMARY KEY (`upload_tariff_document_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `upload_tariff_document`
--

INSERT INTO `upload_tariff_document` (`upload_tariff_document_id`, `property_id_fk`, `upload_tariff_document_from_date`, `upload_tariff_document_to_date`, `upload_tariff_document_name`, `upload_tariff_document_description`, `upload_tariff_document_created_by_user_id`, `upload_tariff_document_created_by_user_name`, `upload_tariff_document_created_date`, `upload_tariff_document_created_time`, `upload_tariff_document_status`) VALUES
(1, 1, '2025-09-07', '2025-09-08', 'src-3.jpeg', 'gh', 1, 'Super admin', '2025-09-07', '06:23:17', 1),
(2, 1, '2025-09-07', '0000-00-00', 'src-25.jpeg', 'gh', 1, 'Super admin', '2025-09-07', '06:25:03', 0),
(3, 1, '2025-09-08', '2025-09-17', 'src-1.jpeg', '', 1, 'Super admin', '2025-09-07', '06:28:23', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE IF NOT EXISTS `user_details` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `admin_name` varchar(255) NOT NULL,
  `user_id_fk` int(11) NOT NULL,
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
  `user_status` int(11) NOT NULL,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`user_id`, `admin_name`, `user_id_fk`, `user_unique_id`, `company_name`, `main_head_staff_id`, `main_head_staff_name`, `user_type`, `user_address`, `user_email_address`, `user_phone_number`, `user_lan_number`, `user_city`, `user_state`, `user_zipcode`, `country_id_fk`, `role_id_fk`, `designation_id_fk`, `user_date_of_joining`, `user_profile_pic`, `user_name`, `password`, `user_description`, `user_created_date`, `user_created_time`, `user_status`) VALUES
(1, 'Super admin', 0, '', '', 0, '', 'A', '																																																																																				ernakulam																																																																								', '', '', '', '', '', '', 0, 0, 0, '0000-00-00', '', 'admin', 'admin', '																																																																																				nill																																																																								', '2020-11-26', '04:19:21', 1),
(2, 'Tiffin box', 0, '', '', 0, '', 'C', 'KERALA', '', '', '', '', '', '', 0, 0, 0, '0000-00-00', '', 'tiffin@123', 'tiffin@123', 'nill', '2020-11-26', '11:22:20', 1),
(3, 'Monisha Pramod', 2, 'MD3', 'Tiffin box', 0, '', 'MH', 'Poyillathu House\r\nPalloorkkavu PO', 'monishapramod5@gmail.com', '919744571400', '', 'Mundakkayam', 'Kerala', '685532', 99, 1, 1, '2024-11-16', 'WhatsApp_Image_2024-11-17_at_10_22_22_f1ac71b7.jpg', 'Monisha', 'Monisha', '', '2024-11-17', '10:26:45', 0),
(4, 'Shalat Mol Shaji', 2, 'MD4', 'Tiffin box', 0, '', 'MH', 'Puthenparambil House\r\nMadukka', 'shalatshaluz@gmail.com', '919074221370', '', 'Mundakkayam', 'Kerala', '686513', 99, 1, 1, '2024-05-06', 'WhatsApp_Image_2024-11-18_at_16_41_17_339ade35.jpg', 'Shalat', 'Shalat', '', '2024-11-18', '04:42:48', 1),
(5, 'Anjala Basheer', 2, 'MD5', 'Tiffin box', 0, '', 'MH', 'Thiriyalapatta\r\nMuttil South\r\nWayanad', 'anjalafathimakm00@gmail.com', '918848588861', '', 'Wayanad', 'Kerala', '673122', 99, 1, 1, '2025-01-01', '', 'Anjala', 'Anjala', '', '2025-01-02', '10:51:50', 1),
(6, 'Anshida C A', 2, 'MD6', 'Tiffin box', 0, '', 'MH', 'CHAKKUNNAN\r\nNAROKKAVU\r\nNilambur ', 'anshidaachu406@gmail.com', '+918281572809', '', 'Malappuram', 'Kerala', '679331', 99, 1, 1, '2025-04-14', '', 'Anshida', 'Anshida@123', '', '2025-04-08', '04:00:44', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_privilege`
--

CREATE TABLE IF NOT EXISTS `user_privilege` (
  `user_privilege_id` int(11) NOT NULL AUTO_INCREMENT,
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
  `user_privilege_status` int(11) NOT NULL,
  PRIMARY KEY (`user_privilege_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

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

CREATE TABLE IF NOT EXISTS `vehicle` (
  `vehicle_id` int(11) NOT NULL AUTO_INCREMENT,
  `vehicle_name` varchar(255) NOT NULL,
  `vehicle_number_seat` varchar(50) NOT NULL,
  `vehicle_description` text NOT NULL,
  `vehicle_createdby_user_id` int(11) NOT NULL,
  `vehicle_createdby_user_name` varchar(255) NOT NULL,
  `vehicle_created_date` date NOT NULL,
  `vehicle_created_time` time NOT NULL,
  `vehicle_status` int(11) NOT NULL,
  PRIMARY KEY (`vehicle_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

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
(31, 'dfggf', '44', 'fd', 0, '', '2025-07-19', '09:18:29', 0);

-- --------------------------------------------------------

--
-- Table structure for table `week_days`
--

CREATE TABLE IF NOT EXISTS `week_days` (
  `week_days_id` int(11) NOT NULL AUTO_INCREMENT,
  `week_days_name` varchar(255) NOT NULL,
  `week_days_description` text NOT NULL,
  `week_days_status` int(11) NOT NULL,
  PRIMARY KEY (`week_days_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

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
