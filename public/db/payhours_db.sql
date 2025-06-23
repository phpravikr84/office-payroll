-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 22, 2024 at 01:57 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `payhours_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `allowances`
--

CREATE TABLE `allowances` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `description` text NOT NULL,
  `amount` double(11,2) NOT NULL,
  `taxable` text NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `allowances`
--

INSERT INTO `allowances` (`id`, `created_by`, `description`, `amount`, `taxable`, `created_at`, `updated_at`) VALUES
(1, 0, 'Vehicle with Fuel', 125.00, 'Y', '2024-02-02 05:55:29', '2024-02-02 05:55:29'),
(2, 0, 'Vehicle without Fuel', 95.00, 'Y', '2024-02-02 05:55:29', '2024-02-02 05:55:29'),
(3, 0, 'Meals', 30.00, 'Y', '2024-02-02 05:56:48', '2024-02-02 05:56:48'),
(4, 0, 'Domestic Servants', 0.00, 'Y', '2024-02-02 06:56:07', '2024-02-02 06:56:07'),
(5, 0, 'Electricity', 0.00, 'Y', '2024-02-02 06:56:07', '2024-02-02 06:56:07'),
(6, 0, 'Telephone', 0.00, 'Y', '2024-02-02 06:56:07', '2024-02-02 06:56:07'),
(7, 0, 'Entertaining', 0.00, 'Y', '2024-02-02 06:56:07', '2024-02-02 06:56:07'),
(8, 0, 'Medical Insurance', 0.00, 'Y', '2024-02-02 06:56:07', '2024-02-02 06:56:07'),
(9, 0, 'Sales Commission', 0.00, 'Y', '2024-02-02 06:56:07', '2024-02-02 06:56:07');

-- --------------------------------------------------------

--
-- Table structure for table `attendances`
--

CREATE TABLE `attendances` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance_date` date NOT NULL,
  `attendance_status` tinyint(4) DEFAULT NULL,
  `leave_category_id` int(11) DEFAULT NULL,
  `check_in` time DEFAULT NULL,
  `check_out` time DEFAULT NULL,
  `shift_in` time NOT NULL,
  `shift_out` time NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `attendances`
--

INSERT INTO `attendances` (`id`, `created_by`, `user_id`, `attendance_date`, `attendance_status`, `leave_category_id`, `check_in`, `check_out`, `shift_in`, `shift_out`, `created_at`, `updated_at`) VALUES
(1, 1, 6, '2019-08-27', 1, 1, '10:11:00', NULL, '00:00:00', '00:00:00', '2019-08-31 23:32:02', '2019-08-31 23:32:02'),
(2, 1, 4, '2019-08-27', 1, 0, '10:10:00', NULL, '00:00:00', '00:00:00', '2019-08-31 23:32:02', '2019-08-31 23:32:02'),
(3, 1, 5, '2019-08-27', 1, 0, '10:11:00', NULL, '00:00:00', '00:00:00', '2019-08-31 23:32:02', '2019-08-31 23:32:02'),
(4, 1, 3, '2019-08-27', 1, 0, '10:10:00', NULL, '00:00:00', '00:00:00', '2019-08-31 23:32:03', '2019-08-31 23:32:03'),
(5, 1, 11, '2019-08-27', 1, 0, '10:10:00', NULL, '00:00:00', '00:00:00', '2019-08-31 23:32:03', '2019-08-31 23:32:03'),
(6, 1, 2, '2019-08-27', 1, 0, '10:10:00', NULL, '00:00:00', '00:00:00', '2019-08-31 23:32:03', '2019-08-31 23:32:03'),
(7, 1, 13, '2019-09-07', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 03:18:30', '2019-09-07 05:26:26'),
(8, 1, 6, '2019-09-07', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 03:18:30', '2019-09-07 05:27:44'),
(9, 1, 4, '2019-09-07', 0, 1, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 03:18:30', '2019-09-07 05:07:56'),
(10, 1, 5, '2019-09-07', 0, 1, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 03:18:30', '2019-09-07 05:07:56'),
(11, 1, 3, '2019-09-07', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 03:18:30', '2019-09-07 05:07:56'),
(12, 1, 11, '2019-09-07', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 03:18:30', '2019-09-07 05:07:56'),
(13, 1, 2, '2019-09-07', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 03:18:30', '2019-09-07 05:07:56'),
(14, 1, 13, '2019-09-08', 1, 0, NULL, NULL, '00:00:00', '00:00:00', '2019-09-07 03:20:39', '2019-09-07 03:20:39'),
(15, 1, 6, '2019-09-08', 1, 0, NULL, NULL, '00:00:00', '00:00:00', '2019-09-07 03:20:39', '2019-09-07 03:20:39'),
(16, 1, 4, '2019-09-08', 1, 0, NULL, NULL, '00:00:00', '00:00:00', '2019-09-07 03:20:39', '2019-09-07 03:20:39'),
(17, 1, 5, '2019-09-08', 0, 1, NULL, NULL, '00:00:00', '00:00:00', '2019-09-07 03:20:39', '2019-09-07 03:20:39'),
(18, 1, 3, '2019-09-08', 0, 1, NULL, NULL, '00:00:00', '00:00:00', '2019-09-07 03:20:39', '2019-09-07 03:20:39'),
(19, 1, 11, '2019-09-08', 0, 0, NULL, NULL, '00:00:00', '00:00:00', '2019-09-07 03:20:39', '2019-09-07 03:20:39'),
(20, 1, 2, '2019-09-08', 0, 0, NULL, NULL, '00:00:00', '00:00:00', '2019-09-07 03:20:39', '2019-09-07 03:20:39'),
(21, 1, 13, '2019-09-01', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:08:48', '2019-09-07 07:23:50'),
(22, 1, 6, '2019-09-01', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:08:48', '2019-09-07 07:23:51'),
(23, 1, 4, '2019-09-01', 1, 1, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:08:48', '2019-09-07 07:23:51'),
(24, 1, 5, '2019-09-01', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:08:48', '2019-09-07 07:23:51'),
(25, 1, 3, '2019-09-01', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:08:48', '2019-09-07 07:23:51'),
(26, 1, 11, '2019-09-01', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:08:48', '2019-09-07 07:23:51'),
(27, 1, 2, '2019-09-01', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:08:48', '2019-09-07 07:23:51'),
(28, 1, 13, '2019-09-03', 0, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:09:44', '2019-09-07 07:09:44'),
(29, 1, 6, '2019-09-03', 0, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:09:44', '2019-09-07 07:09:44'),
(30, 1, 4, '2019-09-03', 0, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:09:44', '2019-09-07 07:09:44'),
(31, 1, 5, '2019-09-03', 0, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:09:44', '2019-09-07 07:09:44'),
(32, 1, 3, '2019-09-03', 0, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:09:44', '2019-09-07 07:09:44'),
(33, 1, 11, '2019-09-03', 0, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:09:44', '2019-09-07 07:09:44'),
(34, 1, 2, '2019-09-03', 0, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:09:44', '2019-09-07 07:09:44'),
(35, 1, 13, '2019-09-02', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:10:01', '2019-09-07 07:24:10'),
(36, 1, 6, '2019-09-02', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:10:01', '2019-09-07 07:24:10'),
(37, 1, 4, '2019-09-02', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:10:01', '2019-09-07 07:24:10'),
(38, 1, 5, '2019-09-02', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:10:01', '2019-09-07 07:24:10'),
(39, 1, 3, '2019-09-02', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:10:01', '2019-09-07 07:24:10'),
(40, 1, 11, '2019-09-02', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:10:01', '2019-09-07 07:24:10'),
(41, 1, 2, '2019-09-02', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:10:01', '2019-09-07 07:24:10'),
(42, 1, 13, '2019-09-04', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:24:31', '2019-09-07 07:24:45'),
(43, 1, 6, '2019-09-04', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:24:31', '2019-09-07 07:24:45'),
(44, 1, 4, '2019-09-04', 0, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:24:31', '2019-09-07 07:24:45'),
(45, 1, 5, '2019-09-04', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:24:31', '2019-09-07 07:24:45'),
(46, 1, 3, '2019-09-04', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:24:31', '2019-09-07 07:24:45'),
(47, 1, 11, '2019-09-04', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:24:31', '2019-09-07 07:24:45'),
(48, 1, 2, '2019-09-04', 1, 0, '09:12:00', '17:12:00', '00:00:00', '00:00:00', '2019-09-07 07:24:31', '2019-09-07 07:24:45'),
(49, 1, 13, '2019-09-09', 0, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:29:18', '2019-09-07 07:29:18'),
(50, 1, 6, '2019-09-09', 0, 0, '11:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:29:18', '2019-09-07 07:29:18'),
(51, 1, 4, '2019-09-09', 1, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:29:18', '2019-09-07 07:29:18'),
(52, 1, 5, '2019-09-09', 1, 1, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:29:18', '2019-09-07 07:29:18'),
(53, 1, 3, '2019-09-09', 0, 1, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:29:18', '2019-09-07 07:29:18'),
(54, 1, 11, '2019-09-09', 1, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:29:18', '2019-09-07 07:29:18'),
(55, 1, 2, '2019-09-09', 1, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:29:18', '2019-09-07 07:29:18'),
(56, 1, 13, '2019-09-10', 1, 0, '10:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:50:20', '2019-09-07 07:50:20'),
(57, 1, 6, '2019-09-10', 1, 0, '11:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:50:20', '2019-09-07 07:50:20'),
(58, 1, 4, '2019-09-10', 1, 0, '11:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:50:20', '2019-09-07 07:50:20'),
(59, 1, 5, '2019-09-10', 1, 0, '11:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:50:20', '2019-09-07 07:50:20'),
(60, 1, 3, '2019-09-10', 1, 0, '11:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:50:20', '2019-09-07 07:50:20'),
(61, 1, 11, '2019-09-10', 1, 0, '11:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:50:20', '2019-09-07 07:50:20'),
(62, 1, 2, '2019-09-10', 1, 0, '11:12:00', '18:05:00', '00:00:00', '00:00:00', '2019-09-07 07:50:20', '2019-09-07 07:50:20'),
(63, 1, 13, '2023-12-26', 1, 0, '09:00:00', '17:00:00', '00:00:00', '00:00:00', '2023-12-24 06:51:02', '2023-12-24 06:51:02'),
(64, 1, 11, '2023-12-26', 1, 0, '09:00:00', '17:00:00', '00:00:00', '00:00:00', '2023-12-24 06:51:02', '2023-12-24 06:51:02'),
(65, 1, 13, '2023-12-23', 0, 0, '09:00:00', '17:00:00', '00:00:00', '00:00:00', '2023-12-24 06:57:07', '2023-12-24 06:57:07'),
(66, 1, 11, '2023-12-23', 1, 0, '09:10:00', '18:00:00', '00:00:00', '00:00:00', '2023-12-24 06:57:07', '2023-12-24 06:57:07'),
(67, 1, 13, '2023-12-01', 1, 0, '09:00:00', '18:15:00', '00:00:00', '00:00:00', '2023-12-24 18:44:50', '2023-12-24 18:44:50'),
(68, 1, 11, '2023-12-01', 1, 0, '09:35:00', '18:15:00', '00:00:00', '00:00:00', '2023-12-24 18:44:50', '2023-12-24 18:44:50'),
(69, 1, 13, '2023-12-02', 1, 0, '09:00:00', '17:00:00', '07:00:00', '15:00:00', '2023-12-25 16:02:30', '2023-12-25 16:02:30'),
(70, 1, 11, '2023-12-02', 1, 0, '09:00:00', '17:00:00', '09:00:00', '17:00:00', '2023-12-25 16:02:42', '2023-12-25 16:02:42'),
(71, 1, 13, '2024-01-15', 1, 0, '09:00:00', '17:00:00', '07:00:00', '15:00:00', '2024-02-01 08:29:31', '2024-02-01 08:29:31'),
(72, 1, 11, '2024-01-15', 1, 0, '09:00:00', '17:00:00', '09:00:00', '17:00:00', '2024-02-01 08:29:31', '2024-02-01 08:29:31'),
(73, 1, 13, '2024-01-16', 1, 2, '09:00:00', '17:00:00', '07:00:00', '15:00:00', '2024-02-01 08:31:03', '2024-02-01 08:31:03'),
(74, 1, 11, '2024-01-16', 0, 2, '09:00:00', '17:00:00', '09:00:00', '17:00:00', '2024-02-01 08:31:03', '2024-02-01 08:31:03'),
(75, 1, 13, '2024-01-17', 0, 0, '09:00:00', '17:00:00', '07:00:00', '15:00:00', '2024-02-01 08:31:22', '2024-02-01 08:31:22'),
(76, 1, 11, '2024-01-17', 0, 0, '09:00:00', '17:00:00', '09:00:00', '17:00:00', '2024-02-01 08:31:22', '2024-02-01 08:31:22'),
(77, 1, 13, '2024-01-18', 1, 0, '09:00:00', '16:00:00', '07:00:00', '15:00:00', '2024-02-01 08:32:08', '2024-02-01 08:32:08'),
(78, 1, 11, '2024-01-18', 1, 0, '09:00:00', '19:00:00', '09:00:00', '17:00:00', '2024-02-01 08:32:08', '2024-02-01 08:32:08'),
(79, 1, 13, '2024-01-19', 1, 0, '08:30:00', '17:00:00', '07:00:00', '15:00:00', '2024-02-01 08:33:13', '2024-02-01 08:33:13'),
(80, 1, 11, '2024-01-19', 1, 0, '09:01:00', '17:00:00', '09:00:00', '17:00:00', '2024-02-01 08:33:13', '2024-02-01 08:33:13'),
(81, 1, 12, '2024-02-21', 1, 0, '09:12:00', '17:12:00', '09:00:00', '17:00:00', '2024-02-21 13:16:54', '2024-02-21 13:17:51'),
(82, 1, 13, '2024-02-21', 1, 0, '09:12:00', '17:12:00', '07:00:00', '15:00:00', '2024-02-21 13:16:54', '2024-02-21 13:17:51'),
(83, 1, 11, '2024-02-21', 1, 0, '09:12:00', '17:12:00', '09:00:00', '17:00:00', '2024-02-21 13:16:54', '2024-02-21 13:17:51'),
(84, 1, 14, '2024-02-21', 1, 0, '09:12:00', '17:12:00', '07:00:00', '15:00:00', '2024-02-21 13:16:54', '2024-02-21 13:17:51'),
(85, 1, 12, '2024-03-20', 0, 1, '09:00:00', '17:00:00', '09:00:00', '00:00:00', '2024-03-20 10:33:01', '2024-03-20 10:51:27'),
(86, 1, 13, '2024-03-20', 0, 2, '09:00:00', '17:00:00', '07:00:00', '15:00:00', '2024-03-20 10:33:01', '2024-03-20 10:51:27'),
(87, 1, 11, '2024-03-20', 0, 3, '09:00:00', '17:00:00', '09:00:00', '17:00:00', '2024-03-20 10:33:01', '2024-03-20 10:51:27'),
(88, 1, 14, '2024-03-20', 1, 0, '09:00:00', '19:12:00', '07:00:00', '15:00:00', '2024-03-20 10:33:01', '2024-03-20 10:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `award_categories`
--

CREATE TABLE `award_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `award_title` varchar(255) NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `award_categories`
--

INSERT INTO `award_categories` (`id`, `created_by`, `award_title`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Best Seller', 1, 0, '2019-08-31 23:30:17', '2019-09-25 03:20:58');

-- --------------------------------------------------------

--
-- Table structure for table `bonuses`
--

CREATE TABLE `bonuses` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `bonus_name` varchar(255) NOT NULL,
  `bonus_month` date NOT NULL,
  `bonus_amount` varchar(255) NOT NULL,
  `bonus_description` text NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bonuses`
--

INSERT INTO `bonuses` (`id`, `created_by`, `user_id`, `bonus_name`, `bonus_month`, `bonus_amount`, `bonus_description`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'Eid', '2023-11-01', '7000', 'Testing', 0, '2023-09-04 12:42:34', '2019-09-03 12:42:34'),
(2, 1, 11, 'Working Perf.', '2023-11-01', '4000', 'Testing', 0, '2023-09-04 12:53:31', '2019-09-03 12:53:31'),
(3, 1, 11, 'DDR', '2023-10-01', '5000', 'Testing', 0, '2023-09-04 12:54:36', '2019-09-25 02:43:26');

-- --------------------------------------------------------

--
-- Table structure for table `client_types`
--

CREATE TABLE `client_types` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `client_type` varchar(100) NOT NULL,
  `client_type_description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `client_types`
--

INSERT INTO `client_types` (`id`, `created_by`, `client_type`, `client_type_description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'sed', 'Repellendus voluptatem distinctio atque voluptas veritatis. Et amet non sapiente enim voluptates ut reprehenderit. Id ipsum ut nam magnam quaerat sequi praesentium. Occaecati dolore sapiente consequatur esse. Et tempore neque ipsam perferendis facere et.', 1, 0, '2018-04-12 06:25:15', '2019-09-24 10:14:19'),
(2, 1, 'repellat', 'Voluptas vero quasi quam et sed. Maxime voluptatibus molestias non in veniam magni magnam. Quidem temporibus molestiae ipsam sint voluptatem. In architecto numquam quis aut ut.', 1, 0, '2018-04-12 06:25:15', '2019-09-25 02:25:36'),
(3, 1, 'earum', 'Qui similique ea quisquam. Omnis qui molestiae totam ex omnis doloremque et. Ea doloribus ipsam corrupti accusantium id voluptas harum.', 1, 0, '2018-04-12 06:25:15', '2019-09-24 10:14:36'),
(4, 1, 'qui', 'Autem autem dolorem quis sed iure. Exercitationem magnam illum eos ullam fugit. Unde quo tenetur omnis voluptatem qui minima.', 1, 0, '2018-04-12 06:25:15', '2019-09-25 02:27:38'),
(5, 1, 'corporis', 'Minima voluptatem iusto unde aliquid in. Natus enim ad aut cum reprehenderit ex fugiat. Architecto est in cumque quia veniam dignissimos.', 1, 0, '2018-04-12 06:25:15', '2018-04-12 06:25:15'),
(6, 1, 'est', 'Accusamus quae quisquam non doloribus nemo quisquam sunt. Nostrum a non perferendis consequuntur. Commodi et non aut earum autem molestiae veniam.', 1, 0, '2018-04-12 06:25:15', '2019-09-24 10:14:30'),
(7, 1, 'quia', 'Dolorem porro est dicta eveniet. Odit totam sunt et. Error non possimus non accusantium harum. Molestiae est est consequatur eum alias nesciunt.', 1, 0, '2018-04-12 06:25:15', '2019-09-24 10:14:25'),
(8, 1, 'sint', 'Aliquam aliquid totam quaerat illum nemo voluptatem. Soluta odit eligendi omnis beatae aliquam eum et hic. Ut debitis pariatur est quidem. Vitae nobis veritatis cum. Vel sit qui sit quia.', 0, 1, '2018-04-12 06:25:15', '2019-08-31 11:08:36'),
(9, 1, 'ut', 'Excepturi et excepturi quia sunt hic. Impedit incidunt ratione est velit.', 1, 0, '2018-04-12 06:25:16', '2019-09-24 10:13:50'),
(10, 1, 'porro', 'Ad quia qui id nobis qui consequatur. Eos et enim itaque nihil quasi ipsa aut. Est veniam inventore in fugit facilis asperiores iusto. Non nihil aperiam nemo nostrum eos perferendis porro. Quas iusto qui cumque tempore.', 1, 0, '2018-04-12 06:25:16', '2018-04-12 06:25:16'),
(11, 1, 'Full tyime', '<p>fdgfdgffgd<br></p>', 1, 0, '2019-08-31 11:04:28', '2019-08-31 11:04:28'),
(12, 1, 'Karim Bond', 'Excepturi et excepturi quia sunt hic. Impedit incidunt ratione est velit.', 1, 0, '2019-09-02 09:58:13', '2019-09-02 09:58:13');

-- --------------------------------------------------------

--
-- Table structure for table `deductions`
--

CREATE TABLE `deductions` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `deduction_name` varchar(255) NOT NULL,
  `deduction_month` date NOT NULL,
  `deduction_amount` varchar(255) NOT NULL,
  `deduction_description` text NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `deductions`
--

INSERT INTO `deductions` (`id`, `created_by`, `user_id`, `deduction_name`, `deduction_month`, `deduction_amount`, `deduction_description`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 13, 'Absence', '2024-02-01', '34', 'hjkjjjhk', 0, '2023-09-01 11:02:50', '2024-02-01 07:59:32'),
(2, 1, 13, 'Deduction 1', '2024-02-01', '200', 'Deduction testing', 0, '2024-02-01 07:58:57', '2024-02-01 07:58:57');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `department` varchar(100) NOT NULL,
  `department_description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `created_by`, `department`, `department_description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 'Admin', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:22:22'),
(2, 1, 'Information Technology', 'Information Technology', 1, 0, '2023-11-12 06:25:16', '2018-04-12 06:25:16'),
(3, 1, 'Accounts', 'Accounts', 1, 0, '2023-11-12 06:25:16', '2018-04-12 06:25:16'),
(4, 1, 'HR', 'Human Resource', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:22:27'),
(5, 1, 'Purchase', 'Purchase', 1, 0, '2023-11-12 06:25:16', '2018-04-12 06:25:16'),
(6, 1, 'Marketing', 'Marketing', 1, 0, '2023-11-30 11:04:47', '2019-08-31 11:04:47'),
(7, 1, 'Sales', 'Sales', 1, 0, '2023-11-30 11:09:23', '2019-09-25 03:38:15');

-- --------------------------------------------------------

--
-- Table structure for table `dependent_rebates`
--

CREATE TABLE `dependent_rebates` (
  `id` int(11) NOT NULL,
  `no_of_dependent` int(11) NOT NULL,
  `rebate_amt1` int(11) NOT NULL,
  `rebate_amt2` int(11) NOT NULL,
  `per_of_tax` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dependent_rebates`
--

INSERT INTO `dependent_rebates` (`id`, `no_of_dependent`, `rebate_amt1`, `rebate_amt2`, `per_of_tax`, `created_at`, `updated_at`) VALUES
(1, 1, 45, 450, 15, '2024-02-02 05:55:29', '2024-02-02 05:55:29'),
(2, 2, 75, 750, 25, '2024-02-02 05:55:29', '2024-02-02 05:55:29'),
(3, 3, 105, 1050, 35, '2024-02-02 05:56:48', '2024-02-02 05:56:48');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `designation` varchar(100) NOT NULL,
  `designation_description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `created_by`, `department_id`, `designation`, `designation_description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'Sr Web Developer', 'Sr Web Developer', 1, 0, '2023-11-12 06:25:16', '2019-09-24 09:59:43'),
(2, 1, 4, 'Sr. HR', 'Sr. HR', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:24:15'),
(3, 1, 3, 'Manager', 'Manager', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:24:03'),
(4, 1, 5, 'Sr. Manager', 'Sr. Manager', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:23:52'),
(5, 1, 3, 'Sr. Acct', 'Sr. Acct', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:24:25'),
(6, 1, 3, 'Jr. Acct', 'Jr. Acct', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:23:58'),
(7, 1, 2, 'Full Stack Developer', 'Full Stack Developer', 1, 0, '2023-11-12 06:25:16', '2018-04-12 06:25:16'),
(8, 1, 4, 'Jr. HR', 'Jr. HR', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:24:20'),
(9, 1, 3, 'Officer', 'Officer', 1, 0, '2023-11-12 06:25:16', '2018-04-12 06:25:16'),
(10, 1, 2, 'Jr. Developer', 'Jr. Developer', 1, 0, '2023-11-12 06:25:16', '2019-09-24 10:24:09'),
(11, 1, 5, 'Executive', 'Executive', 1, 0, '2023-11-12 11:02:32', '2019-08-31 11:02:32'),
(12, 1, 6, 'Sr. Executive', 'Sr. Executive', 1, 0, '2023-11-12 11:05:14', '2019-08-31 11:05:14');

-- --------------------------------------------------------

--
-- Table structure for table `employee_awards`
--

CREATE TABLE `employee_awards` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `award_category_id` int(11) NOT NULL,
  `gift_item` varchar(255) DEFAULT NULL,
  `select_month` date NOT NULL,
  `description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_awards`
--

INSERT INTO `employee_awards` (`id`, `created_by`, `employee_id`, `award_category_id`, `gift_item`, `select_month`, `description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 1, '20000', '2023-11-25', 'nice performance', 1, 0, '2023-11-24 23:30:53', '2019-09-25 02:57:14');

-- --------------------------------------------------------

--
-- Table structure for table `expence_managements`
--

CREATE TABLE `expence_managements` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `item_name` varchar(255) DEFAULT NULL,
  `purchased_from` varchar(255) DEFAULT NULL,
  `purchased_date` date NOT NULL,
  `amount_spent` int(11) NOT NULL,
  `purchased_details` text DEFAULT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `expence_managements`
--

INSERT INTO `expence_managements` (`id`, `created_by`, `employee_id`, `item_name`, `purchased_from`, `purchased_date`, `amount_spent`, `purchased_details`, `deletion_status`, `created_at`, `updated_at`) VALUES
(2, 1, 11, '1', 'wer', '2023-11-04', 34, '<p>vfvx<br></p>', 0, '2019-09-04 05:41:23', '2019-09-04 05:41:23'),
(3, 1, 11, 'Marketing', NULL, '2023-11-04', 567, '<p>fgdgdf<br></p>', 0, '2019-09-04 06:53:32', '2019-09-04 06:53:32'),
(4, 1, 11, 'Purchase', 're', '2023-11-04', 34, '<p>reter<br></p>', 0, '2019-09-04 11:02:50', '2019-09-04 11:02:50');

-- --------------------------------------------------------

--
-- Table structure for table `exp_purposes`
--

CREATE TABLE `exp_purposes` (
  `id` int(11) NOT NULL,
  `exp_name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exp_purposes`
--

INSERT INTO `exp_purposes` (`id`, `exp_name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Purchase', 1, '2019-09-04 06:09:43', '2019-09-04 06:51:04'),
(2, 'Marketing', 1, '2019-09-04 06:40:01', '2019-09-04 06:50:50');

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `folder_id` int(11) NOT NULL,
  `caption` varchar(255) NOT NULL,
  `file_name` varchar(100) NOT NULL,
  `publication_status` tinyint(4) DEFAULT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `created_by`, `folder_id`, `caption`, `file_name`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'Test', '1567309252.png', 1, 0, '2019-09-01 14:40:52', '2019-09-01 14:40:52'),
(2, 1, 2, 'Testing', '1703391956.docx', 1, 0, '2023-12-24 04:55:56', '2023-12-24 04:55:56'),
(3, 1, 2, 'Testing 2', '1703391979.pdf', 1, 0, '2023-12-24 04:56:19', '2023-12-24 04:56:19');

-- --------------------------------------------------------

--
-- Table structure for table `folders`
--

CREATE TABLE `folders` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `folder_name` varchar(100) NOT NULL,
  `folder_description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `folders`
--

INSERT INTO `folders` (`id`, `created_by`, `folder_name`, `folder_description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'My File', '<p>sdfsdfsdfsdfsdfs<br></p>', 1, 0, '2019-09-01 14:40:24', '2019-09-01 14:40:24'),
(2, 1, 'sudip', 'Testing', 1, 0, '2023-12-24 04:54:04', '2023-12-24 04:54:04');

-- --------------------------------------------------------

--
-- Table structure for table `general_settings`
--

CREATE TABLE `general_settings` (
  `id` int(10) UNSIGNED NOT NULL,
  `updated_by` int(11) NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `address_one` varchar(255) NOT NULL,
  `address_two` varchar(255) NOT NULL,
  `contact_no` varchar(30) NOT NULL,
  `web` varchar(255) NOT NULL,
  `logo` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `holiday_name` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `created_by`, `holiday_name`, `date`, `description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Christmas', '2023-12-25', 'Christmas, the holiday commemorating the birth of Jesus Christ, is celebrated by a majority of Christians on December 25 in the Gregorian calendar.', 1, 0, '2023-12-23 23:35:41', '2023-12-24 03:20:25');

-- --------------------------------------------------------

--
-- Table structure for table `hra_area_places`
--

CREATE TABLE `hra_area_places` (
  `id` int(1) NOT NULL,
  `created_by` int(11) NOT NULL,
  `loca_name` varchar(50) NOT NULL,
  `places` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `hra_area_places`
--

INSERT INTO `hra_area_places` (`id`, `created_by`, `loca_name`, `places`) VALUES
(1, 0, 'Area 1', 'Alotau'),
(2, 0, 'Area 1', 'Goroka'),
(3, 0, 'Area 1', 'Kokopo'),
(4, 0, 'Area 1', 'Lae'),
(6, 0, 'Area 1', 'Madang'),
(7, 0, 'Area 1', 'Mount Hagen'),
(8, 0, 'Area 1', 'Port Moresby'),
(9, 0, 'Area 2', 'Arwa'),
(10, 0, 'Area 2', 'Buka'),
(11, 0, 'Area 2', 'Bulodo'),
(12, 0, 'Area 2', 'Daru'),
(13, 0, 'Area 2', 'Kainantu'),
(14, 0, 'Area 2', 'Kavieng'),
(15, 0, 'Area 2', 'Kerema'),
(16, 0, 'Area 2', 'Kiunga'),
(17, 0, 'Area 2', 'Kundiawa'),
(18, 0, 'Area 2', 'Lihir'),
(19, 0, 'Area 2', 'Lorengau'),
(20, 0, 'Area 2', 'Mendi'),
(21, 0, 'Area 2', 'Popondetta'),
(22, 0, 'Area 2', 'Porgera'),
(23, 0, 'Area 2', 'Rabul'),
(24, 0, 'Area 2', 'Tabubil'),
(25, 0, 'Area 2', 'Vanimo'),
(26, 0, 'Area 2', 'Wabag'),
(27, 0, 'Area 2', 'Wau'),
(28, 0, 'Area 2', 'Wewak'),
(29, 0, 'Area 3', 'Other than Area1 & Area2');

-- --------------------------------------------------------

--
-- Table structure for table `hra_rates`
--

CREATE TABLE `hra_rates` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `hra_type` text NOT NULL,
  `hra_amt` int(11) DEFAULT NULL,
  `area_type` text DEFAULT NULL,
  `wkly_hra_min_val` int(11) NOT NULL,
  `wkly_hra_max_val` int(11) NOT NULL,
  `house_min_val` int(11) NOT NULL,
  `house_max_val` int(11) NOT NULL,
  `chk_amt` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hra_rates`
--

INSERT INTO `hra_rates` (`id`, `created_by`, `hra_type`, `hra_amt`, `area_type`, `wkly_hra_min_val`, `wkly_hra_max_val`, `house_min_val`, `house_max_val`, `chk_amt`, `created_at`, `updated_at`) VALUES
(1, 0, 'Very High Cost House or Flat', 2500, 'Area 1', 7001, 999999, 3000001, 999999999, 4000, '2024-01-31 04:31:56', '2024-02-07 11:38:31'),
(2, 0, 'Up-Market Cost House or Flat', 1500, 'Area 1', 5001, 7000, 1500001, 3000000, 4000, '2023-12-28 11:24:02', '2024-02-07 11:38:31'),
(3, 0, 'HIGH COST House or flat', 700, 'Area 1', 3001, 5000, 800001, 1500000, 4000, '2023-12-28 11:24:02', '2024-02-07 11:38:31'),
(4, 0, 'MEDIUM COST House or flat', 400, 'Area 1', 1001, 3000, 400001, 800000, 4000, '2024-01-31 04:40:30', '2024-02-07 11:38:31'),
(5, 0, 'LOW COST House or flat', 160, 'Area 1', 1, 1000, 1, 400000, 4000, '2024-01-31 04:40:30', '2024-02-07 11:38:31'),
(6, 0, 'MESS OR BARRACK STYLE BASIC ACC', 60, 'Area 1', 0, 0, 0, 0, 4000, '2024-01-31 04:40:30', '2024-02-07 11:38:31'),
(7, 0, 'GOVERNMENT MESS OR BARACK STYLE', 7, 'Area 1', 0, 0, 0, 0, 4000, '2024-01-31 04:46:24', '2024-02-07 11:38:31'),
(8, 0, 'EMPLOYEES INVOLVED IN AN APPROVED CITIZEN EMPLOYEE FIRST TIME HOME BUYER SCHEME', 0, 'Area 1', 0, 0, 0, 0, 4000, '2024-01-31 04:46:24', '2024-02-07 11:38:31'),
(9, 0, 'Very High Cost House or Flat', 1500, 'Area 2', 7001, 999999, 3000001, 999999999, 4000, '2024-01-31 04:31:56', '2024-02-07 11:38:31'),
(10, 0, 'Up-Market Cost House or Flat', 1000, 'Area 2', 5001, 7000, 1500001, 3000000, 4000, '2023-12-28 11:24:02', '2024-02-07 11:38:31'),
(11, 0, 'HIGH COST House or flat', 500, 'Area 2', 3001, 5000, 800001, 1500000, 4000, '2023-12-28 11:24:02', '2024-02-07 11:38:31'),
(12, 0, 'MEDIUM COST House or flat', 300, 'Area 2', 1001, 3000, 400001, 800000, 4000, '2024-01-31 04:40:30', '2024-02-07 11:38:31'),
(13, 0, 'LOW COST House or flat', 150, 'Area 2', 1, 1000, 1, 400000, 4000, '2024-01-31 04:40:30', '2024-02-07 11:38:31'),
(14, 0, 'MESS OR BARRACK STYLE BASIC ACC', 50, 'Area 2', 0, 0, 0, 0, 4000, '2024-01-31 04:40:30', '2024-02-07 11:38:31'),
(15, 0, 'GOVERNMENT MESS OR BARACK STYLE', 7, 'Area 2', 0, 0, 0, 0, 4000, '2024-01-31 04:46:24', '2024-02-07 11:38:31'),
(16, 0, 'EMPLOYEES INVOLVED IN AN APPROVED CITIZEN EMPLOYEE FIRST TIME HOME BUYER SCHEME', 0, 'Area 2', 0, 0, 0, 0, 4000, '2024-01-31 04:46:24', '2024-02-07 11:38:31');

-- --------------------------------------------------------

--
-- Table structure for table `increments`
--

CREATE TABLE `increments` (
  `id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `amount` double DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `incr_purpose` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `increments`
--

INSERT INTO `increments` (`id`, `created_by`, `amount`, `emp_id`, `date`, `incr_purpose`, `created_at`, `updated_at`) VALUES
(2, 1, 12, 11, '2023-09', 'Testing', '2023-10-04 08:34:19', '2019-09-04 08:34:19'),
(3, 1, 12, 11, '2023-09', 'Testing', '2023-10-04 08:34:34', '2019-09-04 08:34:34'),
(12, 1, 56, 11, '2023-09', 'Testing', '2023-10-04 09:06:14', '2019-09-04 09:06:14'),
(13, 1, 55, 11, '2023-12', 'Testing', '2023-10-04 09:06:55', '2019-09-04 09:06:55'),
(14, 1, 60, 11, '2023-10', 'Testing', '2023-10-04 10:01:54', '2019-09-04 10:01:54'),
(15, 1, 60, 11, '2023-09', 'Testing', '2023-10-04 10:04:29', '2019-09-04 10:04:29'),
(16, 1, 60, 11, '2023-09', 'Testing', '2023-10-04 10:08:24', '2019-09-04 10:08:24'),
(17, 1, 2000, 11, '2023-09', 'Yearly', '2023-10-04 10:09:14', '2019-09-04 10:09:14'),
(18, 1, 3000, 11, '2023-10', 'Performance', '2023-10-04 11:01:14', '2019-09-04 11:01:14');

-- --------------------------------------------------------

--
-- Table structure for table `leave_applications`
--

CREATE TABLE `leave_applications` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `leave_category_id` int(11) NOT NULL,
  `last_leave_category_id` varchar(20) DEFAULT NULL,
  `last_leave_period` varchar(20) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `leave_address` text DEFAULT NULL,
  `last_leave_date` text DEFAULT NULL,
  `reason` text NOT NULL,
  `during_leave` varchar(20) DEFAULT NULL,
  `publication_status` tinyint(4) NOT NULL DEFAULT 0,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_applications`
--

INSERT INTO `leave_applications` (`id`, `created_by`, `leave_category_id`, `last_leave_category_id`, `last_leave_period`, `start_date`, `end_date`, `leave_address`, `last_leave_date`, `reason`, `during_leave`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 1, '1', 'ddfgfdg', '2019-09-16', '2019-09-23', 'fdgfdgfg', '2019-09-13', 'dfgdfgdfg', 'gdfgdfgd', 2, 0, '2019-09-24 11:24:12', '2019-09-24 12:00:49'),
(2, 13, 1, '1', '2', '2023-12-01', '2023-12-05', 'Testing leave', '2023-11-26', 'Reason of leave', 'NA', 1, 0, '2023-12-24 18:13:18', '2023-12-26 06:44:56');

-- --------------------------------------------------------

--
-- Table structure for table `leave_categories`
--

CREATE TABLE `leave_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `leave_category` varchar(100) NOT NULL,
  `leave_category_description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_categories`
--

INSERT INTO `leave_categories` (`id`, `created_by`, `leave_category`, `leave_category_description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sick Leave', 'Sick Leave', 1, 0, '2023-12-16 11:50:01', '2024-03-08 14:39:13'),
(2, 1, 'Casual Leave', 'Casual Leave', 1, 0, '2023-12-27 09:17:57', '2023-12-27 09:17:57'),
(3, 1, 'Leave Without Pay', 'Leave Without Pay', 1, 0, '2024-03-08 14:40:21', '2024-03-08 14:40:21');

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `loan_name` varchar(255) NOT NULL,
  `loan_amount` varchar(255) NOT NULL,
  `number_of_installments` varchar(255) NOT NULL,
  `remaining_installments` varchar(255) NOT NULL,
  `loan_description` text NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loans`
--

INSERT INTO `loans` (`id`, `created_by`, `user_id`, `loan_name`, `loan_amount`, `number_of_installments`, `remaining_installments`, `loan_description`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 'Car', '100', '5', '2', '<p>dfgdf<br></p>', 0, '2023-11-30 11:38:58', '2019-09-03 12:55:10'),
(2, 1, 13, 'Housing', '500', '4', '4', 'hfghfhfg', 0, '2023-12-01 00:12:40', '2019-09-24 11:06:15');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `notice_title` varchar(255) NOT NULL,
  `description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notices`
--

INSERT INTO `notices` (`id`, `created_by`, `notice_title`, `description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Office Party', 'We are excited to announce that our company will be hosting an office party. This is a fantastic opportunity for us to come together, unwind, and enjoy some quality time together outside of the usual work environment. Your attendance is highly encouraged, and we hope to see you all there!', 1, 0, '2023-12-24 19:59:04', '2023-12-24 19:59:04'),
(2, 1, 'Office Holidays', 'We\'re delighted to inform you that our company will be observing [holiday name] as an official holiday. This day provides us with an opportunity to rest, relax, and spend quality time with our loved ones.', 1, 0, '2023-12-25 06:28:44', '2023-12-25 06:28:44');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `payrolls`
--

CREATE TABLE `payrolls` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_type` tinyint(4) NOT NULL COMMENT '1 for Provision & 2 for Permanent',
  `resident_status` text NOT NULL COMMENT '1 for Resident & 2 for Non-Resident',
  `no_of_dependent` int(11) DEFAULT NULL,
  `declaration_lodge_status` text DEFAULT NULL COMMENT 'Y/N',
  `hrly_salary_rate` varchar(255) DEFAULT NULL,
  `overtime_hr` varchar(255) DEFAULT NULL,
  `overtime_rate` varchar(255) DEFAULT NULL,
  `overtime_amt` varchar(255) DEFAULT NULL,
  `sales_comm` varchar(255) DEFAULT NULL,
  `basic_salary` varchar(255) DEFAULT NULL,
  `house_rent_allowance` varchar(255) DEFAULT NULL,
  `medical_allowance` varchar(255) DEFAULT NULL,
  `special_allowance` varchar(255) DEFAULT NULL COMMENT 'Telephone allowance',
  `provident_fund_contribution` varchar(255) DEFAULT NULL,
  `other_allowance` varchar(255) DEFAULT NULL COMMENT 'Servant Allowance',
  `electricity_allowance` varchar(255) DEFAULT NULL,
  `security_allowance` varchar(255) DEFAULT NULL,
  `tax_deduction_a` varchar(255) DEFAULT NULL,
  `tax_deduction_b` varchar(255) DEFAULT NULL,
  `provident_fund_deduction` varchar(255) DEFAULT NULL,
  `other_deduction` varchar(255) DEFAULT NULL COMMENT 'Extra (not used)',
  `activation_status` tinyint(4) NOT NULL DEFAULT 0,
  `hr_place` int(11) DEFAULT NULL,
  `hr_area` varchar(255) DEFAULT NULL,
  `hra_type` int(11) DEFAULT NULL COMMENT '1 for Rent, 2 for Kind & 3 for Not Applicable',
  `hra_amount_per_week` varchar(255) DEFAULT NULL,
  `va_type` int(11) DEFAULT NULL COMMENT '1 - With Fuel, 2 - Without Fuel & 3 - Not Applicable',
  `vehicle_allowance` varchar(255) DEFAULT NULL,
  `meals_tag` int(11) DEFAULT 0 COMMENT '0 - Not Applicable, 1 - Applicable',
  `meals_allowance` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `created_by`, `user_id`, `employee_type`, `resident_status`, `no_of_dependent`, `declaration_lodge_status`, `hrly_salary_rate`, `overtime_hr`, `overtime_rate`, `overtime_amt`, `sales_comm`, `basic_salary`, `house_rent_allowance`, `medical_allowance`, `special_allowance`, `provident_fund_contribution`, `other_allowance`, `electricity_allowance`, `security_allowance`, `tax_deduction_a`, `tax_deduction_b`, `provident_fund_deduction`, `other_deduction`, `activation_status`, `hr_place`, `hr_area`, `hra_type`, `hra_amount_per_week`, `va_type`, `vehicle_allowance`, `meals_tag`, `meals_allowance`, `created_at`, `updated_at`) VALUES
(1, 1, 11, 3, '', 0, 'N', '0.00', '', '', '', '', '8080', '44', '444', '44', '44', '444', '', '', '2', '', '4', '50', 0, 0, '', 0, '', 0, '', 0, '', NULL, NULL),
(2, 1, 6, 3, '', 0, 'N', '0.00', '', '', '', '', '55000', '210', '254', '200', '300', '580', '', '', '250', '', '500', '200', 0, 0, '', 0, '', 0, '', 0, '', NULL, NULL),
(3, 1, 4, 2, '', 0, 'N', '0.00', '', '', '', '', '15000', '5000', NULL, NULL, '1000', '500', '', '', '2500', '', NULL, NULL, 0, 0, '', 0, '', 0, '', 0, '', NULL, NULL),
(16, 1, 12, 3, '1', 3, NULL, NULL, '11', NULL, '66', '100', '1500', '150', '50', '35', '200', '25', '45', '15', '412.04', '1', '100', NULL, 0, 9, NULL, 1, '500', 1, '125', NULL, '30', '2024-02-20 08:08:01', '2024-02-25 04:25:06');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'hrm-setting', 'HRM Setting', 'HRM Setting', '2018-04-12 06:29:04', '2018-04-12 06:29:04'),
(2, 'role', 'Role Setting', 'Role Setting Details', '2018-04-12 06:29:04', '2018-04-12 06:29:04'),
(3, 'people', 'People', 'People', '2018-04-12 06:29:04', '2018-04-12 06:29:04'),
(4, 'manage-employee', 'Manage employee', 'Manage employee', '2018-04-12 06:29:04', '2018-04-12 06:29:04'),
(5, 'manage-clients', 'Manage clients', 'Manage clients', '2018-04-12 06:29:04', '2018-04-12 06:29:04'),
(6, 'manage-references', 'Manage references', 'Manage references', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(7, 'file-upload', 'File Upload', 'File Upload', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(8, 'sms', 'SMS', 'SMS', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(9, 'payroll-management', 'Payroll Management', 'Payroll Management', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(10, 'manage-salary', 'Manage Salary', 'Manage Salary', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(11, 'salary-list', 'Salary List', 'Salary List', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(12, 'make-payment', 'Make Payment', 'Make Payment', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(13, 'generate-payslip', 'Generate Payslip', 'Generate Payslip', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(14, 'manage-bonus', 'Manage Bonus', 'Manage Bonus', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(15, 'manage-deduction', 'Manage Deduction', 'Manage Deduction', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(16, 'loan-management', 'Loan Management', 'Loan Management', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(17, 'provident-fund', 'Provident Fund', 'Provident Fund', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(18, 'attendance-management', 'Attendance Management', 'Attendance Management', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(19, 'manage-attendance', 'Manage Attendance ', 'Manage Attendance', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(20, 'attendance-report', 'Attendance Report', 'Attendance Report', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(21, 'manage-expense', 'Manage Expense', 'Manage Expense', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(22, 'manage-award', 'Manage Award', 'Manage Award', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(23, 'leave-application', 'Leave Application', 'Leave Application', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(24, 'manage-leave-application', 'Manage Leave Application List', 'Application List', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(25, 'my-leave-application', 'My Leave Application List', 'Application List', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(26, 'notice', 'Notice', 'Notice', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(27, 'manage-notice', 'Manage Notice', 'Manage Notice', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(28, 'notice-board', 'Notice Board', 'Notice Board', '2018-04-12 06:29:05', '2018-04-12 06:29:05'),
(29, 'leave-reports', 'Leave Reports', 'Leave Reports', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `permission_role`
--

CREATE TABLE `permission_role` (
  `permission_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permission_role`
--

INSERT INTO `permission_role` (`permission_id`, `role_id`) VALUES
(1, 1),
(2, 1),
(3, 1),
(4, 1),
(5, 1),
(6, 1),
(7, 1),
(8, 1),
(9, 1),
(10, 1),
(11, 1),
(12, 1),
(13, 1),
(14, 1),
(15, 1),
(16, 3),
(17, 3),
(18, 1),
(19, 1),
(20, 1),
(21, 3),
(22, 1),
(23, 1),
(23, 2),
(24, 1),
(25, 1),
(25, 2),
(26, 1),
(26, 2),
(27, 1),
(28, 1),
(28, 2),
(29, 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_events`
--

CREATE TABLE `personal_events` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `personal_event` varchar(100) NOT NULL,
  `personal_event_description` text NOT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_events`
--

INSERT INTO `personal_events` (`id`, `created_by`, `personal_event`, `personal_event_description`, `start_date`, `end_date`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Office Party', 'details...', '2019-09-25', '2019-09-25', 1, 0, '2018-04-16 05:45:40', '2019-09-25 03:20:40');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(100) NOT NULL,
  `display_name` varchar(255) DEFAULT NULL,
  `description` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `display_name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'superadmin', 'Superadmin', 'Superadmin Details', '2023-12-12 06:35:05', '2018-04-12 06:35:05'),
(2, 'employee', 'Employee', 'Employee Details...', '2023-12-16 05:47:29', '2018-04-16 05:47:29'),
(3, 'admin', 'Admin', 'Admin Details', '2023-12-25 19:37:33', '2023-12-25 19:37:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_user`
--

CREATE TABLE `role_user` (
  `user_id` int(10) UNSIGNED NOT NULL,
  `role_id` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `role_user`
--

INSERT INTO `role_user` (`user_id`, `role_id`) VALUES
(1, 1),
(11, 1),
(13, 2),
(14, 2);

-- --------------------------------------------------------

--
-- Table structure for table `salary_payments`
--

CREATE TABLE `salary_payments` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `gross_salary` varchar(255) NOT NULL,
  `total_deduction` varchar(255) NOT NULL,
  `net_salary` varchar(255) NOT NULL,
  `provident_fund` varchar(255) DEFAULT NULL,
  `payment_amount` varchar(255) NOT NULL,
  `payment_month` date NOT NULL,
  `payment_type` tinyint(4) NOT NULL COMMENT '1 for cash payment, 2 for chaque payment & 3 for bank payment',
  `note` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_payments`
--

INSERT INTO `salary_payments` (`id`, `created_by`, `user_id`, `gross_salary`, `total_deduction`, `net_salary`, `provident_fund`, `payment_amount`, `payment_month`, `payment_type`, `note`, `created_at`, `updated_at`) VALUES
(1, 1, 11, '3976.00', '56.00', '3920', '48', '3920', '2023-12-12', 1, 'gdfg', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(2, 1, 11, '3976.00', '56.00', '3920', '48', '3920', '2023-12-13', 1, 'fgdfg', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(3, 1, 11, '3976.00', '56.00', '3920', '48', '3920', '2023-12-14', 3, 'rgdfgfdgd', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(4, 1, 11, '3976.00', '56.00', '3920', '48', '3920', '2023-12-15', 2, 'dfgdggg', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(5, 1, 11, '3976.00', '56.00', '3920', '48', '3920', '2023-12-18', 2, 'dfgdggg', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(6, 1, 11, '3976.00', '56.00', '3920', '48', '3920', '2023-12-19', 1, 'gdfgdf', '2019-08-31 11:37:10', '2019-08-31 11:37:10'),
(7, 1, 11, '3976.00', '56.00', '3920', '48', '3920', '2023-12-20', 1, 'gdfgdf', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(8, 1, 11, '3976.00', '76.00', '3900', '48', '3900', '2023-12-21', 1, 'dgdfgdfgdg', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(10, 1, 11, '3976.00', '76.00', '3900', '48', '3900', '2023-12-21', 1, NULL, '2019-09-01 00:13:27', '2019-09-01 00:13:27'),
(11, 1, 11, '8976.00', '76.00', '8900', '48', '8900', '2023-12-22', 1, 'sdfdfsdf', '2019-09-03 12:55:10', '2019-09-03 12:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `salary_payment_details`
--

CREATE TABLE `salary_payment_details` (
  `id` int(10) UNSIGNED NOT NULL,
  `salary_payment_id` int(10) UNSIGNED NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `amount` int(10) UNSIGNED NOT NULL,
  `status` varchar(15) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `salary_payment_details`
--

INSERT INTO `salary_payment_details` (`id`, `salary_payment_id`, `item_name`, `amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Basic Salary', 3000, 'credits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(2, 1, 'House Rent Allowance', 44, 'credits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(3, 1, 'Medical Allowance', 444, 'credits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(4, 1, 'Special Allowance', 44, 'credits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(5, 1, 'Provident Fund Contribution', 44, 'credits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(6, 1, 'Other Allowance', 444, 'credits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(7, 1, 'Tax Deduction', 2, 'debits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(8, 1, 'Provident Fund Deduction', 4, 'debits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(9, 1, 'Other Deduction', 50, 'debits', '2019-08-31 11:29:48', '2019-08-31 11:29:48'),
(10, 2, 'Basic Salary', 3000, 'credits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(11, 2, 'House Rent Allowance', 44, 'credits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(12, 2, 'Medical Allowance', 444, 'credits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(13, 2, 'Special Allowance', 44, 'credits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(14, 2, 'Provident Fund Contribution', 44, 'credits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(15, 2, 'Other Allowance', 444, 'credits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(16, 2, 'Tax Deduction', 2, 'debits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(17, 2, 'Provident Fund Deduction', 4, 'debits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(18, 2, 'Other Deduction', 50, 'debits', '2019-08-31 11:30:09', '2019-08-31 11:30:09'),
(19, 3, 'Basic Salary', 3000, 'credits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(20, 3, 'House Rent Allowance', 44, 'credits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(21, 3, 'Medical Allowance', 444, 'credits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(22, 3, 'Special Allowance', 44, 'credits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(23, 3, 'Provident Fund Contribution', 44, 'credits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(24, 3, 'Other Allowance', 444, 'credits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(25, 3, 'Tax Deduction', 2, 'debits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(26, 3, 'Provident Fund Deduction', 4, 'debits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(27, 3, 'Other Deduction', 50, 'debits', '2019-08-31 11:31:38', '2019-08-31 11:31:38'),
(28, 4, 'Basic Salary', 3000, 'credits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(29, 4, 'House Rent Allowance', 44, 'credits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(30, 4, 'Medical Allowance', 444, 'credits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(31, 4, 'Special Allowance', 44, 'credits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(32, 4, 'Provident Fund Contribution', 44, 'credits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(33, 4, 'Other Allowance', 444, 'credits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(34, 4, 'Tax Deduction', 2, 'debits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(35, 4, 'Provident Fund Deduction', 4, 'debits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(36, 4, 'Other Deduction', 50, 'debits', '2019-08-31 11:32:40', '2019-08-31 11:32:40'),
(37, 5, 'Basic Salary', 3000, 'credits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(38, 5, 'House Rent Allowance', 44, 'credits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(39, 5, 'Medical Allowance', 444, 'credits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(40, 5, 'Special Allowance', 44, 'credits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(41, 5, 'Provident Fund Contribution', 44, 'credits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(42, 5, 'Other Allowance', 444, 'credits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(43, 5, 'Tax Deduction', 2, 'debits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(44, 5, 'Provident Fund Deduction', 4, 'debits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(45, 5, 'Other Deduction', 50, 'debits', '2019-08-31 11:35:00', '2019-08-31 11:35:00'),
(46, 6, 'Basic Salary', 3000, 'credits', '2019-08-31 11:37:10', '2019-08-31 11:37:10'),
(47, 6, 'House Rent Allowance', 44, 'credits', '2019-08-31 11:37:11', '2019-08-31 11:37:11'),
(48, 6, 'Medical Allowance', 444, 'credits', '2019-08-31 11:37:11', '2019-08-31 11:37:11'),
(49, 6, 'Special Allowance', 44, 'credits', '2019-08-31 11:37:11', '2019-08-31 11:37:11'),
(50, 6, 'Provident Fund Contribution', 44, 'credits', '2019-08-31 11:37:11', '2019-08-31 11:37:11'),
(51, 6, 'Other Allowance', 444, 'credits', '2019-08-31 11:37:11', '2019-08-31 11:37:11'),
(52, 6, 'Tax Deduction', 2, 'debits', '2019-08-31 11:37:11', '2019-08-31 11:37:11'),
(53, 6, 'Provident Fund Deduction', 4, 'debits', '2019-08-31 11:37:11', '2019-08-31 11:37:11'),
(54, 6, 'Other Deduction', 50, 'debits', '2019-08-31 11:37:11', '2019-08-31 11:37:11'),
(55, 7, 'Basic Salary', 3000, 'credits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(56, 7, 'House Rent Allowance', 44, 'credits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(57, 7, 'Medical Allowance', 444, 'credits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(58, 7, 'Special Allowance', 44, 'credits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(59, 7, 'Provident Fund Contribution', 44, 'credits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(60, 7, 'Other Allowance', 444, 'credits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(61, 7, 'Tax Deduction', 2, 'debits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(62, 7, 'Provident Fund Deduction', 4, 'debits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(63, 7, 'Other Deduction', 50, 'debits', '2019-08-31 11:38:23', '2019-08-31 11:38:23'),
(64, 8, 'Basic Salary', 3000, 'credits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(65, 8, 'House Rent Allowance', 44, 'credits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(66, 8, 'Medical Allowance', 444, 'credits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(67, 8, 'Special Allowance', 44, 'credits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(68, 8, 'Provident Fund Contribution', 44, 'credits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(69, 8, 'Other Allowance', 444, 'credits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(70, 8, 'Tax Deduction', 2, 'debits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(71, 8, 'Provident Fund Deduction', 4, 'debits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(72, 8, 'Other Deduction', 50, 'debits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(73, 8, 'Install', 20, 'debits', '2019-08-31 11:39:46', '2019-08-31 11:39:46'),
(74, 9, 'Basic Salary', 55000, 'credits', '2019-09-01 00:11:27', '2019-09-01 00:11:27'),
(75, 9, 'House Rent Allowance', 210, 'credits', '2019-09-01 00:11:27', '2019-09-01 00:11:27'),
(76, 9, 'Medical Allowance', 254, 'credits', '2019-09-01 00:11:27', '2019-09-01 00:11:27'),
(77, 9, 'Special Allowance', 200, 'credits', '2019-09-01 00:11:28', '2019-09-01 00:11:28'),
(78, 9, 'Provident Fund Contribution', 300, 'credits', '2019-09-01 00:11:28', '2019-09-01 00:11:28'),
(79, 9, 'Other Allowance', 580, 'credits', '2019-09-01 00:11:28', '2019-09-01 00:11:28'),
(80, 9, 'Tax Deduction', 250, 'debits', '2019-09-01 00:11:28', '2019-09-01 00:11:28'),
(81, 9, 'Provident Fund Deduction', 500, 'debits', '2019-09-01 00:11:28', '2019-09-01 00:11:28'),
(82, 9, 'Other Deduction', 200, 'debits', '2019-09-01 00:11:28', '2019-09-01 00:11:28'),
(83, 10, 'Basic Salary', 3000, 'credits', '2019-09-01 00:13:27', '2019-09-01 00:13:27'),
(84, 10, 'House Rent Allowance', 44, 'credits', '2019-09-01 00:13:27', '2019-09-01 00:13:27'),
(85, 10, 'Medical Allowance', 444, 'credits', '2019-09-01 00:13:27', '2019-09-01 00:13:27'),
(86, 10, 'Special Allowance', 44, 'credits', '2019-09-01 00:13:27', '2019-09-01 00:13:27'),
(87, 10, 'Provident Fund Contribution', 44, 'credits', '2019-09-01 00:13:28', '2019-09-01 00:13:28'),
(88, 10, 'Other Allowance', 444, 'credits', '2019-09-01 00:13:28', '2019-09-01 00:13:28'),
(89, 10, 'Tax Deduction', 2, 'debits', '2019-09-01 00:13:28', '2019-09-01 00:13:28'),
(90, 10, 'Provident Fund Deduction', 4, 'debits', '2019-09-01 00:13:28', '2019-09-01 00:13:28'),
(91, 10, 'Other Deduction', 50, 'debits', '2019-09-01 00:13:28', '2019-09-01 00:13:28'),
(92, 10, 'Install', 20, 'debits', '2019-09-01 00:13:28', '2019-09-01 00:13:28'),
(93, 11, 'Basic Salary', 3000, 'credits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(94, 11, 'House Rent Allowance', 44, 'credits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(95, 11, 'Medical Allowance', 444, 'credits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(96, 11, 'Special Allowance', 44, 'credits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(97, 11, 'Provident Fund Contribution', 44, 'credits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(98, 11, 'Other Allowance', 444, 'credits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(99, 11, 'Tax Deduction', 2, 'debits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(100, 11, 'Provident Fund Deduction', 4, 'debits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(101, 11, 'Other Deduction', 50, 'debits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(102, 11, 'DDR', 5000, 'credits', '2019-09-03 12:55:10', '2019-09-03 12:55:10'),
(103, 11, 'Install', 20, 'debits', '2019-09-03 12:55:10', '2019-09-03 12:55:10');

-- --------------------------------------------------------

--
-- Table structure for table `set_times`
--

CREATE TABLE `set_times` (
  `id` int(11) NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `set_times`
--

INSERT INTO `set_times` (`id`, `created_by`, `in_time`, `out_time`, `created_at`, `updated_at`) VALUES
(1, 1, '07:00:00', '15:00:00', '2023-09-07 06:49:45', '2023-12-24 17:22:33'),
(2, 1, '09:00:00', '17:00:00', '2023-12-24 19:29:12', '2023-12-24 19:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `tax_residents`
--

CREATE TABLE `tax_residents` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `resi_status` int(11) NOT NULL COMMENT '1 - Resident, 2 - Non_Resedent',
  `min_amt` int(7) NOT NULL,
  `max_amt` int(7) NOT NULL,
  `gross_tax_per` double(5,2) NOT NULL,
  `deduted_amt` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_residents`
--

INSERT INTO `tax_residents` (`id`, `created_by`, `resi_status`, `min_amt`, `max_amt`, `gross_tax_per`, `deduted_amt`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 1, 20000, 0.00, 0, '2023-12-28 11:22:22', '2023-12-28 11:22:22'),
(2, 1, 1, 20001, 33000, 30.00, 6000, '2023-12-28 11:24:02', '2023-12-28 11:24:02'),
(3, 1, 1, 33001, 70000, 35.00, 7650, '2023-12-28 11:24:02', '2023-12-28 11:24:02'),
(4, 1, 1, 70001, 250000, 40.00, 11150, '2023-12-28 11:30:45', '2023-12-28 11:30:53'),
(5, 1, 1, 250001, 1000000000, 42.00, 16150, '2023-12-28 11:31:01', '2023-12-28 11:31:08'),
(6, 1, 2, 1, 20000, 22.00, 0, '2023-12-28 11:22:22', '2023-12-28 11:22:22'),
(7, 1, 2, 20001, 33000, 30.00, 1600, '2023-12-28 11:24:02', '2023-12-28 11:24:02'),
(8, 1, 2, 33001, 70000, 35.00, 3250, '2023-12-28 11:24:02', '2023-12-28 11:24:02'),
(9, 1, 2, 70001, 250000, 40.00, 6750, '2023-12-28 11:30:45', '2023-12-28 11:30:53'),
(10, 1, 2, 250001, 1000000000, 42.00, 11150, '2023-12-28 11:31:01', '2023-12-28 11:31:08');

-- --------------------------------------------------------

--
-- Table structure for table `tax_table_salary_wise`
--

CREATE TABLE `tax_table_salary_wise` (
  `id` int(11) NOT NULL,
  `created_by` int(11) NOT NULL,
  `slab_min` int(11) NOT NULL,
  `slab_max` int(11) NOT NULL,
  `nres_tax_amt` double(11,2) DEFAULT NULL,
  `nres_tax_plus` double(11,2) DEFAULT NULL,
  `res_tax_no_declr_amt` decimal(11,2) DEFAULT NULL,
  `res_tax_no_declr_plus` double(11,2) DEFAULT NULL,
  `res_tax_declr_amt_0` double(11,2) DEFAULT NULL,
  `res_tax_declr_plus_0` decimal(11,2) DEFAULT NULL,
  `res_tax_declr_amt_1` double(11,2) DEFAULT NULL,
  `res_tax_declr_plus_1` double(11,2) DEFAULT NULL,
  `res_tax_declr_amt_2` double(11,2) DEFAULT NULL,
  `res_tax_declr_plus_2` double(11,2) DEFAULT NULL,
  `res_tax_declr_amt_3` double(11,2) DEFAULT NULL,
  `res_tax_declr_plus_3` double(11,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tax_table_salary_wise`
--

INSERT INTO `tax_table_salary_wise` (`id`, `created_by`, `slab_min`, `slab_max`, `nres_tax_amt`, `nres_tax_plus`, `res_tax_no_declr_amt`, `res_tax_no_declr_plus`, `res_tax_declr_amt_0`, `res_tax_declr_plus_0`, `res_tax_declr_amt_1`, `res_tax_declr_plus_1`, `res_tax_declr_amt_2`, `res_tax_declr_plus_2`, `res_tax_declr_amt_3`, `res_tax_declr_plus_3`, `created_at`, `updated_at`) VALUES
(1, 1, 0, 0, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 1, 1, 3, 0.90, 0.00, 1.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 1, 3, 5, 1.50, 0.00, 2.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 1, 5, 7, 2.10, 0.00, 2.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 1, 7, 9, 2.70, 0.00, 3.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 1, 9, 11, 3.30, 0.00, 4.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 1, 11, 13, 3.90, 0.00, 5.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 1, 13, 15, 4.50, 0.00, 6.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(9, 1, 15, 17, 5.10, 0.00, 7.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(10, 1, 17, 19, 5.70, 0.00, 7.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(11, 1, 19, 21, 6.30, 0.00, 8.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(12, 1, 21, 23, 6.90, 0.00, 9.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(13, 1, 23, 25, 7.50, 0.00, 10.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(14, 1, 25, 27, 8.10, 0.00, 11.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(15, 1, 27, 29, 8.70, 0.00, 12.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(16, 1, 29, 31, 9.30, 0.00, 13.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(17, 1, 31, 33, 9.90, 0.00, 13.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(18, 1, 33, 35, 10.50, 0.00, 14.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(19, 1, 35, 37, 11.10, 0.00, 15.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(20, 1, 37, 39, 11.70, 0.00, 16.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(21, 1, 39, 41, 12.30, 0.00, 17.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(22, 1, 41, 43, 12.90, 0.00, 18.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(23, 1, 43, 45, 13.50, 0.00, 18.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(24, 1, 45, 47, 14.10, 0.00, 19.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(25, 1, 47, 49, 14.70, 0.00, 20.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(26, 1, 49, 51, 15.30, 0.00, 21.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(27, 1, 51, 53, 15.90, 0.00, 22.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(28, 1, 53, 55, 16.50, 0.00, 23.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(29, 1, 55, 57, 17.10, 0.00, 23.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(30, 1, 57, 59, 17.70, 0.00, 24.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(31, 1, 59, 61, 18.30, 0.00, 25.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(32, 1, 61, 63, 18.90, 0.00, 26.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(33, 1, 63, 65, 19.50, 0.00, 27.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(34, 1, 65, 67, 20.10, 0.00, 28.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(35, 1, 67, 69, 20.70, 0.00, 28.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(36, 1, 69, 71, 21.30, 0.00, 29.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(37, 1, 71, 73, 21.90, 0.00, 30.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(38, 1, 73, 75, 22.50, 0.00, 31.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(39, 1, 75, 77, 23.10, 0.00, 32.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(40, 1, 77, 79, 23.70, 0.00, 33.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(41, 1, 79, 81, 24.30, 0.00, 34.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(42, 1, 81, 83, 24.90, 0.00, 34.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(43, 1, 83, 85, 25.50, 0.00, 35.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(44, 1, 85, 87, 26.10, 0.00, 36.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(45, 1, 87, 89, 26.70, 0.00, 37.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(46, 1, 89, 91, 27.30, 0.00, 38.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(47, 1, 91, 93, 27.90, 0.00, 39.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(48, 1, 93, 95, 28.50, 0.00, 39.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(49, 1, 95, 97, 29.10, 0.00, 40.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(50, 1, 97, 99, 29.70, 0.00, 41.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(51, 1, 99, 101, 30.30, 0.00, 42.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(52, 1, 101, 103, 30.90, 0.00, 43.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(53, 1, 103, 105, 31.50, 0.00, 44.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(54, 1, 105, 107, 32.10, 0.00, 44.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(55, 1, 107, 109, 32.70, 0.00, 45.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(56, 1, 109, 111, 33.30, 0.00, 46.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(57, 1, 111, 113, 33.90, 0.00, 47.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(58, 1, 113, 115, 34.50, 0.00, 48.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(59, 1, 115, 117, 35.10, 0.00, 49.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(60, 1, 117, 119, 35.70, 0.00, 49.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(61, 1, 119, 121, 36.30, 0.00, 50.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(62, 1, 121, 123, 36.90, 0.00, 51.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(63, 1, 123, 125, 37.50, 0.00, 52.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(64, 1, 125, 127, 38.10, 0.00, 53.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(65, 1, 127, 129, 38.70, 0.00, 54.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(66, 1, 129, 131, 39.30, 0.00, 55.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(67, 1, 131, 133, 39.90, 0.00, 55.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(68, 1, 133, 135, 40.50, 0.00, 56.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(69, 1, 135, 137, 41.10, 0.00, 57.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(70, 1, 137, 139, 41.70, 0.00, 58.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(71, 1, 139, 141, 42.30, 0.00, 59.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(72, 1, 141, 143, 42.90, 0.00, 60.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(73, 1, 143, 145, 43.50, 0.00, 60.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(74, 1, 145, 147, 44.10, 0.00, 61.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(75, 1, 147, 149, 44.70, 0.00, 62.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(76, 1, 149, 151, 45.30, 0.00, 63.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(77, 1, 151, 153, 45.90, 0.00, 64.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(78, 1, 153, 155, 46.50, 0.00, 65.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(79, 1, 155, 157, 47.10, 0.00, 65.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(80, 1, 157, 159, 47.70, 0.00, 66.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(81, 1, 159, 161, 48.30, 0.00, 67.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(82, 1, 161, 163, 48.90, 0.00, 68.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(83, 1, 163, 165, 49.50, 0.00, 69.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(84, 1, 165, 167, 50.10, 0.00, 70.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(85, 1, 167, 169, 50.70, 0.00, 70.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(86, 1, 169, 171, 51.30, 0.00, 71.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(87, 1, 171, 173, 51.90, 0.00, 72.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(88, 1, 173, 175, 52.50, 0.00, 73.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(89, 1, 175, 177, 53.10, 0.00, 74.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(90, 1, 177, 179, 53.70, 0.00, 75.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(91, 1, 179, 181, 54.30, 0.00, 76.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(92, 1, 181, 183, 54.90, 0.00, 76.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(93, 1, 183, 185, 55.50, 0.00, 77.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(94, 1, 185, 187, 56.10, 0.00, 78.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(95, 1, 187, 189, 56.70, 0.00, 79.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(96, 1, 189, 191, 57.30, 0.00, 80.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(97, 1, 191, 193, 57.90, 0.00, 81.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(98, 1, 193, 195, 58.50, 0.00, 81.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(99, 1, 195, 197, 59.10, 0.00, 82.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(100, 1, 197, 199, 59.70, 0.00, 83.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(101, 1, 199, 201, 60.30, 0.00, 84.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(102, 1, 201, 203, 60.90, 0.00, 85.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(103, 1, 203, 205, 61.50, 0.00, 86.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(104, 1, 205, 207, 62.10, 0.00, 86.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(105, 1, 207, 209, 62.70, 0.00, 87.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(106, 1, 209, 211, 63.30, 0.00, 88.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(107, 1, 211, 213, 63.90, 0.00, 89.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(108, 1, 213, 215, 64.50, 0.00, 90.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(109, 1, 215, 217, 65.10, 0.00, 91.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(110, 1, 217, 219, 65.70, 0.00, 91.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(111, 1, 219, 221, 66.30, 0.00, 92.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(112, 1, 221, 223, 66.90, 0.00, 93.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(113, 1, 223, 225, 67.50, 0.00, 94.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(114, 1, 225, 227, 68.10, 0.00, 95.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(115, 1, 227, 229, 68.70, 0.00, 96.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(116, 1, 229, 231, 69.30, 0.00, 97.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(117, 1, 231, 233, 69.90, 0.00, 97.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(118, 1, 233, 235, 70.50, 0.00, 98.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(119, 1, 235, 237, 71.10, 0.00, 99.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(120, 1, 237, 239, 71.70, 0.00, 100.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(121, 1, 239, 241, 72.30, 0.00, 101.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(122, 1, 241, 243, 72.90, 0.00, 102.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(123, 1, 243, 245, 73.50, 0.00, 102.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(124, 1, 245, 247, 74.10, 0.00, 103.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(125, 1, 247, 249, 74.70, 0.00, 104.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(126, 1, 249, 251, 75.30, 0.00, 105.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(127, 1, 251, 253, 75.90, 0.00, 106.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(128, 1, 253, 255, 76.50, 0.00, 107.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(129, 1, 255, 257, 77.10, 0.00, 107.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(130, 1, 257, 259, 77.70, 0.00, 108.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(131, 1, 259, 261, 78.30, 0.00, 109.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(132, 1, 261, 263, 78.90, 0.00, 110.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(133, 1, 263, 265, 79.50, 0.00, 111.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(134, 1, 265, 267, 80.10, 0.00, 112.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(135, 1, 267, 269, 80.70, 0.00, 112.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(136, 1, 269, 271, 81.30, 0.00, 113.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(137, 1, 271, 273, 81.90, 0.00, 114.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(138, 1, 273, 275, 82.50, 0.00, 115.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(139, 1, 275, 277, 83.10, 0.00, 116.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(140, 1, 277, 279, 83.70, 0.00, 117.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(141, 1, 279, 281, 84.30, 0.00, 118.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(142, 1, 281, 283, 84.90, 0.00, 118.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(143, 1, 283, 285, 85.50, 0.00, 119.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(144, 1, 285, 287, 86.10, 0.00, 120.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(145, 1, 287, 289, 86.70, 0.00, 121.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(146, 1, 289, 291, 87.30, 0.00, 122.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(147, 1, 291, 293, 87.90, 0.00, 123.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(148, 1, 293, 295, 88.50, 0.00, 123.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(149, 1, 295, 297, 89.10, 0.00, 124.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(150, 1, 297, 299, 89.70, 0.00, 125.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(151, 1, 299, 301, 90.30, 0.00, 126.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(152, 1, 301, 303, 90.90, 0.00, 127.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(153, 1, 303, 305, 91.50, 0.00, 128.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(154, 1, 305, 307, 92.10, 0.00, 128.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(155, 1, 307, 309, 92.70, 0.00, 129.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(156, 1, 309, 311, 93.30, 0.00, 130.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(157, 1, 311, 313, 93.90, 0.00, 131.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(158, 1, 313, 315, 94.50, 0.00, 132.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(159, 1, 315, 317, 95.10, 0.00, 133.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(160, 1, 317, 319, 95.70, 0.00, 133.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(161, 1, 319, 321, 96.30, 0.00, 134.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(162, 1, 321, 323, 96.90, 0.00, 135.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(163, 1, 323, 325, 97.50, 0.00, 136.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(164, 1, 325, 327, 98.10, 0.00, 137.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(165, 1, 327, 329, 98.70, 0.00, 138.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(166, 1, 329, 331, 99.30, 0.00, 139.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(167, 1, 331, 333, 99.90, 0.00, 139.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(168, 1, 333, 335, 100.50, 0.00, 140.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(169, 1, 335, 337, 101.10, 0.00, 141.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(170, 1, 337, 339, 101.70, 0.00, 142.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(171, 1, 339, 341, 102.30, 0.00, 143.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(172, 1, 341, 343, 102.90, 0.00, 144.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(173, 1, 343, 345, 103.50, 0.00, 144.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(174, 1, 345, 347, 104.10, 0.00, 145.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(175, 1, 347, 349, 104.70, 0.00, 146.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(176, 1, 349, 351, 105.30, 0.00, 147.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(177, 1, 351, 353, 105.90, 0.00, 148.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(178, 1, 353, 355, 106.50, 0.00, 149.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(179, 1, 355, 357, 107.10, 0.00, 149.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(180, 1, 357, 359, 107.70, 0.00, 150.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(181, 1, 359, 361, 108.30, 0.00, 151.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(182, 1, 361, 363, 108.90, 0.00, 152.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(183, 1, 363, 365, 109.50, 0.00, 153.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(184, 1, 365, 367, 110.10, 0.00, 154.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(185, 1, 367, 369, 110.70, 0.00, 154.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(186, 1, 369, 371, 111.30, 0.00, 155.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(187, 1, 371, 373, 111.90, 0.00, 156.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(188, 1, 373, 375, 112.50, 0.00, 157.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(189, 1, 375, 377, 113.10, 0.00, 158.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(190, 1, 377, 379, 113.70, 0.00, 159.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(191, 1, 379, 381, 114.30, 0.00, 160.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(192, 1, 381, 383, 114.90, 0.00, 160.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(193, 1, 383, 385, 115.50, 0.00, 161.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(194, 1, 385, 387, 116.10, 0.00, 162.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(195, 1, 387, 389, 116.70, 0.00, 163.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(196, 1, 389, 391, 117.30, 0.00, 164.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(197, 1, 391, 393, 117.90, 0.00, 165.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(198, 1, 393, 395, 118.50, 0.00, 165.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(199, 1, 395, 397, 119.10, 0.00, 166.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(200, 1, 397, 399, 119.70, 0.00, 167.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(201, 1, 399, 401, 120.30, 0.00, 168.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(202, 1, 401, 403, 120.90, 0.00, 169.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(203, 1, 403, 405, 121.50, 0.00, 170.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(204, 1, 405, 407, 122.10, 0.00, 170.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(205, 1, 407, 409, 122.70, 0.00, 171.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(206, 1, 409, 411, 123.30, 0.00, 172.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(207, 1, 411, 413, 123.90, 0.00, 173.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(208, 1, 413, 415, 124.50, 0.00, 174.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(209, 1, 415, 417, 125.10, 0.00, 175.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(210, 1, 417, 419, 125.70, 0.00, 175.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(211, 1, 419, 421, 126.30, 0.00, 176.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(212, 1, 421, 423, 126.90, 0.00, 177.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(213, 1, 423, 425, 127.50, 0.00, 178.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(214, 1, 425, 427, 128.10, 0.00, 179.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(215, 1, 427, 429, 128.70, 0.00, 180.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(216, 1, 429, 431, 129.30, 0.00, 181.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(217, 1, 431, 433, 129.90, 0.00, 181.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(218, 1, 433, 435, 130.50, 0.00, 182.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(219, 1, 435, 437, 131.10, 0.00, 183.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(220, 1, 437, 439, 131.70, 0.00, 184.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(221, 1, 439, 441, 132.30, 0.00, 185.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(222, 1, 441, 443, 132.90, 0.00, 186.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(223, 1, 443, 445, 133.50, 0.00, 186.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(224, 1, 445, 447, 134.10, 0.00, 187.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(225, 1, 447, 449, 134.70, 0.00, 188.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(226, 1, 449, 451, 135.30, 0.00, 189.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(227, 1, 451, 453, 135.90, 0.00, 190.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(228, 1, 453, 455, 136.50, 0.00, 191.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(229, 1, 455, 457, 137.10, 0.00, 191.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(230, 1, 457, 459, 137.70, 0.00, 192.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(231, 1, 459, 461, 138.30, 0.00, 193.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(232, 1, 461, 463, 138.90, 0.00, 194.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(233, 1, 463, 465, 139.50, 0.00, 195.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(234, 1, 465, 467, 140.10, 0.00, 196.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(235, 1, 467, 469, 140.70, 0.00, 196.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(236, 1, 469, 471, 141.30, 0.00, 197.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(237, 1, 471, 473, 141.90, 0.00, 198.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(238, 1, 473, 475, 142.50, 0.00, 199.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(239, 1, 475, 477, 143.10, 0.00, 200.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(240, 1, 477, 479, 143.70, 0.00, 201.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(241, 1, 479, 481, 144.30, 0.00, 202.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(242, 1, 481, 483, 144.90, 0.00, 202.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(243, 1, 483, 485, 145.50, 0.00, 203.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(244, 1, 485, 487, 146.10, 0.00, 204.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(245, 1, 487, 489, 146.70, 0.00, 205.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(246, 1, 489, 491, 147.30, 0.00, 206.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(247, 1, 491, 493, 147.90, 0.00, 207.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(248, 1, 493, 495, 148.50, 0.00, 207.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(249, 1, 495, 497, 149.10, 0.00, 208.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(250, 1, 497, 499, 149.70, 0.00, 209.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(251, 1, 499, 501, 150.30, 0.00, 210.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(252, 1, 501, 503, 150.90, 0.00, 211.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(253, 1, 503, 505, 151.50, 0.00, 212.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(254, 1, 505, 507, 152.10, 0.00, 212.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(255, 1, 507, 509, 152.70, 0.00, 213.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(256, 1, 509, 511, 153.30, 0.00, 214.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(257, 1, 511, 513, 153.90, 0.00, 215.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(258, 1, 513, 515, 154.50, 0.00, 216.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(259, 1, 515, 517, 155.10, 0.00, 217.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(260, 1, 517, 519, 155.70, 0.00, 217.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(261, 1, 519, 521, 156.30, 0.00, 218.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(262, 1, 521, 523, 156.90, 0.00, 219.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(263, 1, 523, 525, 157.50, 0.00, 220.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(264, 1, 525, 527, 158.10, 0.00, 221.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(265, 1, 527, 529, 158.70, 0.00, 222.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(266, 1, 529, 531, 159.30, 0.00, 223.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(267, 1, 531, 533, 159.90, 0.00, 223.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(268, 1, 533, 535, 160.50, 0.00, 224.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(269, 1, 535, 537, 161.10, 0.00, 225.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(270, 1, 537, 539, 161.70, 0.00, 226.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(271, 1, 539, 541, 162.30, 0.00, 227.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(272, 1, 541, 543, 162.90, 0.00, 228.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(273, 1, 543, 545, 163.50, 0.00, 228.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(274, 1, 545, 547, 164.10, 0.00, 229.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(275, 1, 547, 549, 164.70, 0.00, 230.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(276, 1, 549, 551, 165.30, 0.00, 231.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(277, 1, 551, 553, 165.90, 0.00, 232.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(278, 1, 553, 555, 166.50, 0.00, 233.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(279, 1, 555, 557, 167.10, 0.00, 233.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(280, 1, 557, 559, 167.70, 0.00, 234.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(281, 1, 559, 561, 168.30, 0.00, 235.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(282, 1, 561, 563, 168.90, 0.00, 236.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(283, 1, 563, 565, 169.50, 0.00, 237.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(284, 1, 565, 567, 170.10, 0.00, 238.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(285, 1, 567, 569, 170.70, 0.00, 238.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(286, 1, 569, 571, 171.30, 0.00, 239.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(287, 1, 571, 573, 171.90, 0.00, 240.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(288, 1, 573, 575, 172.50, 0.00, 241.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(289, 1, 575, 577, 173.10, 0.00, 242.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(290, 1, 577, 579, 173.70, 0.00, 243.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(291, 1, 579, 581, 174.30, 0.00, 244.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(292, 1, 581, 583, 174.90, 0.00, 244.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(293, 1, 583, 585, 175.50, 0.00, 245.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(294, 1, 585, 587, 176.10, 0.00, 246.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(295, 1, 587, 589, 176.70, 0.00, 247.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(296, 1, 589, 591, 177.30, 0.00, 248.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(297, 1, 591, 593, 177.90, 0.00, 249.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(298, 1, 593, 595, 178.50, 0.00, 249.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(299, 1, 595, 597, 179.10, 0.00, 250.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(300, 1, 597, 599, 179.70, 0.00, 251.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(301, 1, 599, 601, 180.30, 0.00, 252.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(302, 1, 601, 603, 180.90, 0.00, 253.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(303, 1, 603, 605, 181.50, 0.00, 254.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(304, 1, 605, 607, 182.10, 0.00, 254.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(305, 1, 607, 609, 182.70, 0.00, 255.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(306, 1, 609, 611, 183.30, 0.00, 256.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(307, 1, 611, 613, 183.90, 0.00, 257.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(308, 1, 613, 615, 184.50, 0.00, 258.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(309, 1, 615, 617, 185.10, 0.00, 259.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(310, 1, 617, 619, 185.70, 0.00, 259.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(311, 1, 619, 621, 186.30, 0.00, 260.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(312, 1, 621, 623, 186.90, 0.00, 261.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(313, 1, 623, 625, 187.50, 0.00, 262.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(314, 1, 625, 627, 188.10, 0.00, 263.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(315, 1, 627, 629, 188.70, 0.00, 264.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(316, 1, 629, 631, 189.30, 0.00, 265.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(317, 1, 631, 633, 189.90, 0.00, 265.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(318, 1, 633, 635, 190.50, 0.00, 266.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(319, 1, 635, 637, 191.10, 0.00, 267.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(320, 1, 637, 639, 191.70, 0.00, 268.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(321, 1, 639, 641, 192.30, 0.00, 269.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(322, 1, 641, 643, 192.90, 0.00, 270.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(323, 1, 643, 645, 193.50, 0.00, 270.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(324, 1, 645, 647, 194.10, 0.00, 271.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(325, 1, 647, 649, 194.70, 0.00, 272.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(326, 1, 649, 651, 195.30, 0.00, 273.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(327, 1, 651, 653, 195.90, 0.00, 274.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(328, 1, 653, 655, 196.50, 0.00, 275.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(329, 1, 655, 657, 197.10, 0.00, 275.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(330, 1, 657, 659, 197.70, 0.00, 276.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(331, 1, 659, 661, 198.30, 0.00, 277.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(332, 1, 661, 663, 198.90, 0.00, 278.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(333, 1, 663, 665, 199.50, 0.00, 279.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(334, 1, 665, 667, 200.10, 0.00, 280.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(335, 1, 667, 669, 200.70, 0.00, 280.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(336, 1, 669, 671, 201.30, 0.00, 281.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(337, 1, 671, 673, 201.90, 0.00, 282.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(338, 1, 673, 675, 202.50, 0.00, 283.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(339, 1, 675, 677, 203.10, 0.00, 284.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(340, 1, 677, 679, 203.70, 0.00, 285.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(341, 1, 679, 681, 204.30, 0.00, 286.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(342, 1, 681, 683, 204.90, 0.00, 286.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(343, 1, 683, 685, 205.50, 0.00, 287.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(344, 1, 685, 687, 206.10, 0.00, 288.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(345, 1, 687, 689, 206.70, 0.00, 289.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(346, 1, 689, 691, 207.30, 0.00, 290.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(347, 1, 691, 693, 207.90, 0.00, 291.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(348, 1, 693, 695, 208.50, 0.00, 291.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(349, 1, 695, 697, 209.10, 0.00, 292.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(350, 1, 697, 699, 209.70, 0.00, 293.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(351, 1, 699, 701, 210.30, 0.00, 294.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(352, 1, 701, 703, 210.90, 0.00, 295.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(353, 1, 703, 705, 211.50, 0.00, 296.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(354, 1, 705, 707, 212.10, 0.00, 296.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(355, 1, 707, 709, 212.70, 0.00, 297.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(356, 1, 709, 711, 213.30, 0.00, 298.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(357, 1, 711, 713, 213.90, 0.00, 299.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(358, 1, 713, 715, 214.50, 0.00, 300.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `tax_table_salary_wise` (`id`, `created_by`, `slab_min`, `slab_max`, `nres_tax_amt`, `nres_tax_plus`, `res_tax_no_declr_amt`, `res_tax_no_declr_plus`, `res_tax_declr_amt_0`, `res_tax_declr_plus_0`, `res_tax_declr_amt_1`, `res_tax_declr_plus_1`, `res_tax_declr_amt_2`, `res_tax_declr_plus_2`, `res_tax_declr_amt_3`, `res_tax_declr_plus_3`, `created_at`, `updated_at`) VALUES
(359, 1, 715, 717, 215.10, 0.00, 301.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(360, 1, 717, 719, 215.70, 0.00, 301.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(361, 1, 719, 721, 216.30, 0.00, 302.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(362, 1, 721, 723, 216.90, 0.00, 303.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(363, 1, 723, 725, 217.50, 0.00, 304.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(364, 1, 725, 727, 218.10, 0.00, 305.34, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(365, 1, 727, 729, 218.70, 0.00, 306.18, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(366, 1, 729, 731, 219.30, 0.00, 307.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(367, 1, 731, 733, 219.90, 0.00, 307.86, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(368, 1, 733, 735, 220.50, 0.00, 308.70, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(369, 1, 735, 737, 221.10, 0.00, 309.54, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(370, 1, 737, 739, 221.70, 0.00, 310.38, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(371, 1, 739, 741, 222.30, 0.00, 311.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(372, 1, 741, 743, 222.90, 0.00, 312.06, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(373, 1, 743, 745, 223.50, 0.00, 312.90, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(374, 1, 745, 747, 224.10, 0.00, 313.74, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(375, 1, 747, 749, 224.70, 0.00, 314.58, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(376, 1, 749, 751, 225.30, 0.00, 315.42, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(377, 1, 751, 753, 225.90, 0.00, 316.26, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(378, 1, 753, 755, 226.50, 0.00, 317.10, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(379, 1, 755, 757, 227.10, 0.00, 317.94, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(380, 1, 757, 759, 227.70, 0.00, 318.78, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(381, 1, 759, 761, 228.30, 0.00, 319.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(382, 1, 761, 763, 228.90, 0.00, 320.46, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(383, 1, 763, 765, 229.50, 0.00, 321.30, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(384, 1, 765, 767, 230.10, 0.00, 322.14, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(385, 1, 767, 769, 230.70, 0.00, 322.98, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(386, 1, 769, 771, 231.30, 0.00, 323.82, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(387, 1, 771, 773, 231.90, 0.00, 324.66, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(388, 1, 773, 775, 232.50, 0.00, 325.50, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(389, 1, 775, 777, 233.10, 0.00, 326.34, 0.00, 0.02, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(390, 1, 777, 779, 233.70, 0.00, 327.18, 0.00, 0.62, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(391, 1, 779, 781, 234.30, 0.00, 328.02, 0.00, 1.22, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(392, 1, 781, 783, 234.90, 0.00, 328.86, 0.00, 1.82, 0.00, 0.09, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(393, 1, 783, 785, 235.50, 0.00, 329.70, 0.00, 2.42, 0.00, 0.69, 0.00, 0.00, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(394, 1, 785, 787, 236.10, 0.00, 330.54, 0.00, 3.02, 0.00, 1.29, 0.00, 0.14, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(395, 1, 787, 789, 236.70, 0.00, 331.38, 0.00, 3.62, 0.00, 1.89, 0.00, 0.74, 0.00, 0.00, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(396, 1, 789, 791, 237.30, 0.00, 332.22, 0.00, 4.22, 0.00, 2.49, 0.00, 1.34, 0.00, 0.18, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(397, 1, 791, 793, 237.90, 0.00, 333.06, 0.00, 4.82, 0.00, 3.09, 0.00, 1.94, 0.00, 0.78, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(398, 1, 793, 795, 238.50, 0.00, 333.90, 0.00, 5.42, 0.00, 3.69, 0.00, 2.54, 0.00, 1.38, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(399, 1, 795, 797, 239.10, 0.00, 334.74, 0.00, 6.02, 0.00, 4.29, 0.00, 3.14, 0.00, 1.98, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(400, 1, 797, 799, 239.70, 0.00, 335.58, 0.00, 6.62, 0.00, 4.89, 0.00, 3.74, 0.00, 2.58, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(401, 1, 799, 801, 240.30, 0.00, 336.42, 0.00, 7.22, 0.00, 5.49, 0.00, 4.34, 0.00, 3.18, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(402, 1, 801, 803, 240.90, 0.00, 337.26, 0.00, 7.82, 0.00, 6.09, 0.00, 4.94, 0.00, 3.78, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(403, 1, 803, 805, 241.50, 0.00, 338.10, 0.00, 8.42, 0.00, 6.69, 0.00, 5.54, 0.00, 4.38, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(404, 1, 805, 807, 242.10, 0.00, 338.94, 0.00, 9.02, 0.00, 7.29, 0.00, 6.14, 0.00, 4.98, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(405, 1, 807, 809, 242.70, 0.00, 339.78, 0.00, 9.62, 0.00, 7.89, 0.00, 6.74, 0.00, 5.58, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(406, 1, 809, 811, 243.30, 0.00, 340.62, 0.00, 10.22, 0.00, 8.49, 0.00, 7.34, 0.00, 6.18, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(407, 1, 811, 813, 243.90, 0.00, 341.46, 0.00, 10.82, 0.00, 9.09, 0.00, 7.94, 0.00, 6.78, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(408, 1, 813, 815, 244.50, 0.00, 342.30, 0.00, 11.42, 0.00, 9.69, 0.00, 8.54, 0.00, 7.38, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(409, 1, 815, 817, 245.10, 0.00, 343.14, 0.00, 12.02, 0.00, 10.22, 0.00, 9.02, 0.00, 7.81, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(410, 1, 817, 819, 245.70, 0.00, 343.98, 0.00, 12.62, 0.00, 10.73, 0.00, 9.47, 0.00, 8.20, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(411, 1, 819, 821, 246.30, 0.00, 344.82, 0.00, 13.22, 0.00, 11.24, 0.00, 9.92, 0.00, 8.60, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(412, 1, 821, 823, 246.90, 0.00, 345.66, 0.00, 13.82, 0.00, 11.75, 0.00, 10.37, 0.00, 8.98, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(413, 1, 823, 825, 247.50, 0.00, 346.50, 0.00, 14.42, 0.00, 12.26, 0.00, 10.82, 0.00, 9.38, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(414, 1, 825, 827, 248.10, 0.00, 347.34, 0.00, 15.02, 0.00, 12.77, 0.00, 11.27, 0.00, 9.76, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(415, 1, 827, 829, 248.70, 0.00, 348.18, 0.00, 15.62, 0.00, 13.28, 0.00, 11.72, 0.00, 10.16, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(416, 1, 829, 831, 249.30, 0.00, 349.02, 0.00, 16.22, 0.00, 13.79, 0.00, 12.17, 0.00, 10.55, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(417, 1, 831, 833, 249.90, 0.00, 349.86, 0.00, 16.82, 0.00, 14.30, 0.00, 12.62, 0.00, 10.94, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(418, 1, 833, 835, 250.50, 0.00, 350.70, 0.00, 17.42, 0.00, 14.81, 0.00, 13.07, 0.00, 11.33, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(419, 1, 835, 837, 251.10, 0.00, 351.54, 0.00, 18.02, 0.00, 15.32, 0.00, 13.52, 0.00, 11.72, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(420, 1, 837, 839, 251.70, 0.00, 352.38, 0.00, 18.62, 0.00, 15.83, 0.00, 13.97, 0.00, 12.11, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(421, 1, 839, 841, 252.30, 0.00, 353.22, 0.00, 19.22, 0.00, 16.34, 0.00, 14.42, 0.00, 12.50, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(422, 1, 841, 843, 252.90, 0.00, 354.06, 0.00, 19.82, 0.00, 16.85, 0.00, 14.87, 0.00, 12.89, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(423, 1, 843, 845, 253.50, 0.00, 354.90, 0.00, 20.42, 0.00, 17.36, 0.00, 15.32, 0.00, 13.28, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(424, 1, 845, 847, 254.10, 0.00, 355.74, 0.00, 21.02, 0.00, 17.87, 0.00, 15.77, 0.00, 13.67, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(425, 1, 847, 849, 254.70, 0.00, 356.58, 0.00, 21.62, 0.00, 18.38, 0.00, 16.22, 0.00, 14.06, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(426, 1, 849, 851, 255.30, 0.00, 357.42, 0.00, 22.22, 0.00, 18.89, 0.00, 16.67, 0.00, 14.45, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(427, 1, 851, 853, 255.90, 0.00, 358.26, 0.00, 22.82, 0.00, 19.40, 0.00, 17.12, 0.00, 14.84, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(428, 1, 853, 855, 256.50, 0.00, 359.10, 0.00, 23.42, 0.00, 19.91, 0.00, 17.57, 0.00, 15.23, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(429, 1, 855, 857, 257.10, 0.00, 359.94, 0.00, 24.02, 0.00, 20.42, 0.00, 18.02, 0.00, 15.62, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(430, 1, 857, 859, 257.70, 0.00, 360.78, 0.00, 24.62, 0.00, 20.93, 0.00, 18.47, 0.00, 16.01, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(431, 1, 859, 861, 258.30, 0.00, 361.62, 0.00, 25.22, 0.00, 21.44, 0.00, 18.92, 0.00, 16.40, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(432, 1, 861, 863, 258.90, 0.00, 362.46, 0.00, 25.82, 0.00, 21.95, 0.00, 19.37, 0.00, 16.79, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(433, 1, 863, 865, 259.50, 0.00, 363.30, 0.00, 26.42, 0.00, 22.46, 0.00, 19.82, 0.00, 17.18, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(434, 1, 865, 867, 260.10, 0.00, 364.14, 0.00, 27.02, 0.00, 22.97, 0.00, 20.27, 0.00, 17.57, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(435, 1, 867, 869, 260.70, 0.00, 364.98, 0.00, 27.62, 0.00, 23.48, 0.00, 20.72, 0.00, 17.96, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(436, 1, 869, 871, 261.30, 0.00, 365.82, 0.00, 28.22, 0.00, 23.99, 0.00, 21.17, 0.00, 18.35, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(437, 1, 871, 873, 261.90, 0.00, 366.66, 0.00, 28.82, 0.00, 24.50, 0.00, 21.62, 0.00, 18.74, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(438, 1, 873, 875, 262.50, 0.00, 367.50, 0.00, 29.42, 0.00, 25.01, 0.00, 22.07, 0.00, 19.13, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(439, 1, 875, 877, 263.10, 0.00, 368.34, 0.00, 30.02, 0.00, 25.52, 0.00, 22.52, 0.00, 19.52, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(440, 1, 877, 879, 263.70, 0.00, 369.18, 0.00, 30.62, 0.00, 26.03, 0.00, 22.97, 0.00, 19.91, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(441, 1, 879, 881, 264.30, 0.00, 370.02, 0.00, 31.22, 0.00, 26.54, 0.00, 23.42, 0.00, 20.30, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(442, 1, 881, 883, 264.90, 0.00, 370.86, 0.00, 31.82, 0.00, 27.05, 0.00, 23.87, 0.00, 20.69, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(443, 1, 883, 885, 265.50, 0.00, 371.70, 0.00, 32.42, 0.00, 27.56, 0.00, 24.32, 0.00, 21.08, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(444, 1, 885, 887, 266.10, 0.00, 372.54, 0.00, 33.02, 0.00, 28.07, 0.00, 24.77, 0.00, 21.47, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(445, 1, 887, 889, 266.70, 0.00, 373.38, 0.00, 33.62, 0.00, 28.58, 0.00, 25.22, 0.00, 21.86, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(446, 1, 889, 891, 267.30, 0.00, 374.22, 0.00, 34.22, 0.00, 29.09, 0.00, 25.67, 0.00, 22.25, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(447, 1, 891, 893, 267.90, 0.00, 375.06, 0.00, 34.82, 0.00, 29.60, 0.00, 26.12, 0.00, 22.64, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(448, 1, 893, 895, 268.50, 0.00, 375.90, 0.00, 35.42, 0.00, 30.11, 0.00, 26.57, 0.00, 23.03, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(449, 1, 895, 897, 269.10, 0.00, 376.74, 0.00, 36.02, 0.00, 30.62, 0.00, 27.02, 0.00, 23.42, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(450, 1, 897, 899, 269.70, 0.00, 377.58, 0.00, 36.62, 0.00, 31.13, 0.00, 27.47, 0.00, 23.81, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(451, 1, 899, 901, 270.30, 0.00, 378.42, 0.00, 37.22, 0.00, 31.64, 0.00, 27.92, 0.00, 24.20, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(452, 1, 901, 903, 270.90, 0.00, 379.26, 0.00, 37.82, 0.00, 32.15, 0.00, 28.37, 0.00, 24.59, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(453, 1, 903, 905, 271.50, 0.00, 380.10, 0.00, 38.42, 0.00, 32.66, 0.00, 28.82, 0.00, 24.98, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(454, 1, 905, 907, 272.10, 0.00, 380.94, 0.00, 39.02, 0.00, 33.17, 0.00, 29.27, 0.00, 25.37, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(455, 1, 907, 909, 272.70, 0.00, 381.78, 0.00, 39.62, 0.00, 33.68, 0.00, 29.72, 0.00, 25.76, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(456, 1, 909, 911, 273.30, 0.00, 382.62, 0.00, 40.22, 0.00, 34.19, 0.00, 30.17, 0.00, 26.15, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(457, 1, 911, 913, 273.90, 0.00, 383.46, 0.00, 40.82, 0.00, 34.70, 0.00, 30.62, 0.00, 26.54, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(458, 1, 913, 915, 274.50, 0.00, 384.30, 0.00, 41.42, 0.00, 35.21, 0.00, 31.07, 0.00, 26.93, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(459, 1, 915, 917, 275.10, 0.00, 385.14, 0.00, 42.02, 0.00, 35.72, 0.00, 31.52, 0.00, 27.32, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(460, 1, 917, 919, 275.70, 0.00, 385.98, 0.00, 42.62, 0.00, 36.23, 0.00, 31.97, 0.00, 27.71, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(461, 1, 919, 921, 276.30, 0.00, 386.82, 0.00, 43.22, 0.00, 36.74, 0.00, 32.42, 0.00, 28.10, 0.00, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `father_name` varchar(255) DEFAULT NULL,
  `mother_name` varchar(255) DEFAULT NULL,
  `spouse_name` varchar(255) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `present_address` varchar(255) NOT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `home_district` varchar(255) DEFAULT NULL,
  `academic_qualification` text DEFAULT NULL,
  `professional_qualification` text DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `reference` text DEFAULT NULL,
  `id_name` tinyint(4) DEFAULT NULL COMMENT '1 for NID, 2 Passport, 3 for Driving License',
  `id_number` varchar(255) DEFAULT NULL,
  `contact_no_one` varchar(30) NOT NULL,
  `contact_no_two` varchar(30) DEFAULT NULL,
  `emergency_contact` varchar(30) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `gender` varchar(1) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `marital_status` tinyint(4) DEFAULT NULL COMMENT '1 for Married, Single, 3 for Divorced, 4 for Separated, 5 for Widowed',
  `avatar` varchar(255) DEFAULT NULL,
  `client_type_id` int(11) DEFAULT NULL,
  `designation_id` int(11) DEFAULT NULL,
  `joining_position` int(11) DEFAULT NULL,
  `access_label` tinyint(4) NOT NULL COMMENT '1 for superadmin, 2 for associates, 3 for employees, 4 for references and 5 for clients',
  `role` varchar(255) DEFAULT NULL,
  `activation_status` tinyint(4) NOT NULL DEFAULT 0,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `remember_token` varchar(100) DEFAULT NULL,
  `shift_id` int(2) NOT NULL DEFAULT 1,
  `date_of_leaving` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_by`, `employee_id`, `name`, `father_name`, `mother_name`, `spouse_name`, `email`, `password`, `present_address`, `permanent_address`, `home_district`, `academic_qualification`, `professional_qualification`, `joining_date`, `experience`, `reference`, `id_name`, `id_number`, `contact_no_one`, `contact_no_two`, `emergency_contact`, `web`, `gender`, `date_of_birth`, `marital_status`, `avatar`, `client_type_id`, `designation_id`, `joining_position`, `access_label`, `role`, `activation_status`, `deletion_status`, `remember_token`, `shift_id`, `date_of_leaving`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'A. Sen', NULL, NULL, NULL, 'admin@mail.com', '$2y$10$Y17jCoozWQAi0i5jDK65D.JSAyd0JbvznZ4vp3lnZC3Ck6CIVLGBu', '123 Bidhan Sarani\nKolkata, West Bengal 700006', '123 Bidhan Sarani\nKolkata, West Bengal 700006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01921588567', NULL, NULL, 'http://demo.com', 'm', '2023-12-24', NULL, '', 9, 8, NULL, 1, NULL, 1, 0, 'PbX2XlfUbyPFYbQUNE3Nnm5LzD6vUkCxxTxsKSDp9Nyhc59u4RKMAaN0R3cm', 0, NULL, '2019-09-07 06:25:15', '2023-12-24 18:51:51'),
(8, 1, NULL, 'C. Dutta', NULL, NULL, NULL, 'testdemo@demo.org', '$2y$10$Y17jCoozWQAi0i5jDK65D.JSAyd0JbvznZ4vp3lnZC3Ck6CIVLGBu', '456 Park Street\nSiliguri, West Bengal 734001', '456 Park Street\nSiliguri, West Bengal 734001', NULL, NULL, NULL, NULL, NULL, NULL, NULL, '235641', '1-624-402-9842', NULL, NULL, '', 'm', '2019-09-25', NULL, NULL, 3, 1, NULL, 4, '2', 1, 0, '', 2, NULL, '2018-04-12 06:25:15', '2019-09-25 02:01:09'),
(11, 1, 11, 'Nikhil Basak', 'gfdfg', 'fggfdgfd', 'gfdgdgd', 'nikhil@demo.com', '$2y$10$Y17jCoozWQAi0i5jDK65D.JSAyd0JbvznZ4vp3lnZC3Ck6CIVLGBu', 'dfgdfg', 'fdgfdgdf', 'Buka', 'gujg', 'gjhjghjghj', '2018-08-29', 'jghjghjg', 'jghjghj', 1, '223214414', '6546454', NULL, '455', NULL, 'm', '2019-08-31', 1, NULL, NULL, 12, 6, 2, '1', 0, 0, NULL, 2, NULL, '2019-08-31 11:28:18', '2019-09-18 02:38:18'),
(12, 1, 12, 'B. Das', NULL, NULL, NULL, 'demo1@demo.com', '$2y$10$gzyjCI1Hn0f1ZqPIuxleS.43GZcVW3sar8bdmumg.GTGSJU4fp1K.', '789 Salt Lake City\nKolkata, West Bengal 700091', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '123', NULL, NULL, '', 'm', '2019-09-25', NULL, NULL, 11, 12, NULL, 2, '2', 0, 0, NULL, 2, NULL, '2019-09-01 00:58:00', '2019-09-25 02:00:54'),
(13, 1, 13, 'Biplob', 'akjsdh kajsd', 'dsklfjs lsdkf', 'sjkdhsd fskd', 'employee@gmail.com', '$2y$10$Y17jCoozWQAi0i5jDK65D.JSAyd0JbvznZ4vp3lnZC3Ck6CIVLGBu', '101 MG Road\nDarjeeling, West Bengal 734101', '101 MG Road\nDarjeeling, West Bengal 734101', 'Port Moresby', 'hgjggj', 'jhgjhjg', '2018-08-01', 'ghjghjh', 'Dr. Wasi', 1, '3213423534543645645', '01921588567', NULL, '01921588567', '', 'm', '2019-09-08', 1, '', NULL, 12, 6, 2, '2', 0, 0, '', 1, NULL, '2019-09-07 02:16:25', '2019-09-18 02:38:41'),
(14, 1, 13, 'Testing', 'Testing Father', 'Testing Mother', 'Testing Spouse', 'testing@testing.com', '$2y$10$M9CyuSdRNzz5ghSemZeGse4tVsIQ/.mEohNx2KqQUg6FLqbqADZqi', 'Testing Present Address', 'Testing Permanent Address', 'None', 'test1, test2', NULL, '2024-01-01', '2 yrs', 'C. Dutta', 1, '456789898744', '12345678', NULL, NULL, NULL, 'm', '1989-02-08', 2, NULL, NULL, 11, 4, 2, 'employee', 0, 0, 'ecoMmXYSD0YvVD5fUGRLpKoqBJrahn5xmgcpukLPMEDmhLN20YUdZmB2MnYW', 1, NULL, '2024-02-20 12:41:32', '2024-02-20 12:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `working_days`
--

CREATE TABLE `working_days` (
  `id` int(10) UNSIGNED NOT NULL,
  `updated_by` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `working_status` tinyint(4) NOT NULL COMMENT '0 for holiday & 1 for working day',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_days`
--

INSERT INTO `working_days` (`id`, `updated_by`, `day`, `working_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sun', 0, '2018-04-12 06:25:16', '2019-09-01 16:08:46'),
(2, 1, 'Mon', 1, '2018-04-12 06:25:16', '2019-09-01 16:08:47'),
(3, 1, 'Tue', 1, '2018-04-12 06:25:17', '2019-09-01 16:08:47'),
(4, 1, 'Wed', 1, '2018-04-12 06:25:17', '2019-09-01 16:08:47'),
(5, 1, 'Thu', 1, '2018-04-12 06:25:17', '2019-09-01 16:08:47'),
(6, 1, 'Fri', 1, '2018-04-12 06:25:17', '2019-09-01 16:08:47'),
(7, 1, 'Sat', 1, '2018-04-12 06:25:17', '2019-09-01 16:08:47');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `award_categories`
--
ALTER TABLE `award_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `client_types`
--
ALTER TABLE `client_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_types_client_type_unique` (`client_type`);

--
-- Indexes for table `deductions`
--
ALTER TABLE `deductions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_department_unique` (`department`);

--
-- Indexes for table `dependent_rebates`
--
ALTER TABLE `dependent_rebates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `designations_designation_unique` (`designation`);

--
-- Indexes for table `employee_awards`
--
ALTER TABLE `employee_awards`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `expence_managements`
--
ALTER TABLE `expence_managements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `exp_purposes`
--
ALTER TABLE `exp_purposes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `folders`
--
ALTER TABLE `folders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `general_settings`
--
ALTER TABLE `general_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hra_area_places`
--
ALTER TABLE `hra_area_places`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `hra_rates`
--
ALTER TABLE `hra_rates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `increments`
--
ALTER TABLE `increments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_applications`
--
ALTER TABLE `leave_applications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_categories`
--
ALTER TABLE `leave_categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `leave_categories_leave_category_unique` (`leave_category`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `payrolls`
--
ALTER TABLE `payrolls`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `permissions_name_unique` (`name`);

--
-- Indexes for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD PRIMARY KEY (`permission_id`,`role_id`),
  ADD KEY `permission_role_role_id_foreign` (`role_id`);

--
-- Indexes for table `personal_events`
--
ALTER TABLE `personal_events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_name_unique` (`name`);

--
-- Indexes for table `role_user`
--
ALTER TABLE `role_user`
  ADD PRIMARY KEY (`user_id`,`role_id`),
  ADD KEY `role_user_role_id_foreign` (`role_id`);

--
-- Indexes for table `salary_payments`
--
ALTER TABLE `salary_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary_payment_details`
--
ALTER TABLE `salary_payment_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `set_times`
--
ALTER TABLE `set_times`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_residents`
--
ALTER TABLE `tax_residents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tax_table_salary_wise`
--
ALTER TABLE `tax_table_salary_wise`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `working_days`
--
ALTER TABLE `working_days`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=89;

--
-- AUTO_INCREMENT for table `award_categories`
--
ALTER TABLE `award_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `client_types`
--
ALTER TABLE `client_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `dependent_rebates`
--
ALTER TABLE `dependent_rebates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `employee_awards`
--
ALTER TABLE `employee_awards`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `expence_managements`
--
ALTER TABLE `expence_managements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `exp_purposes`
--
ALTER TABLE `exp_purposes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `folders`
--
ALTER TABLE `folders`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `general_settings`
--
ALTER TABLE `general_settings`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `hra_area_places`
--
ALTER TABLE `hra_area_places`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `hra_rates`
--
ALTER TABLE `hra_rates`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `increments`
--
ALTER TABLE `increments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `leave_categories`
--
ALTER TABLE `leave_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `personal_events`
--
ALTER TABLE `personal_events`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `salary_payments`
--
ALTER TABLE `salary_payments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `salary_payment_details`
--
ALTER TABLE `salary_payment_details`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=104;

--
-- AUTO_INCREMENT for table `set_times`
--
ALTER TABLE `set_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tax_residents`
--
ALTER TABLE `tax_residents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `tax_table_salary_wise`
--
ALTER TABLE `tax_table_salary_wise`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=462;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `working_days`
--
ALTER TABLE `working_days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `permission_role`
--
ALTER TABLE `permission_role`
  ADD CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `role_user`
--
ALTER TABLE `role_user`
  ADD CONSTRAINT `role_user_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `role_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
