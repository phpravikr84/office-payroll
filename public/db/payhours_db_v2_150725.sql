-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 15, 2025 at 02:42 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

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
-- Table structure for table `anz_bank_transfer_setups`
--

CREATE TABLE `anz_bank_transfer_setups` (
  `id` int(10) UNSIGNED NOT NULL,
  `anz_customer_reference` varchar(255) DEFAULT NULL,
  `anz_folder_directory` varchar(255) DEFAULT NULL,
  `gl_code_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anz_bank_transfer_setups`
--

INSERT INTO `anz_bank_transfer_setups` (`id`, `anz_customer_reference`, `anz_folder_directory`, `gl_code_id`, `created_at`, `updated_at`) VALUES
(1, '123456788', 'd://ravi', 4, '2024-08-30 10:58:35', '2025-07-10 16:22:16'),
(2, '', '', NULL, '2024-08-30 11:02:22', '2024-08-30 11:02:22'),
(3, '', '', NULL, '2024-08-30 11:02:29', '2024-08-30 11:02:29'),
(4, '', '', NULL, '2024-08-30 11:02:31', '2024-08-30 11:02:31'),
(5, '', '', NULL, '2024-08-30 11:02:34', '2024-08-30 11:02:34'),
(6, '', '', NULL, '2024-08-30 11:03:11', '2024-08-30 11:03:11'),
(7, '', '', NULL, '2024-08-30 11:03:14', '2024-08-30 11:03:14'),
(8, '', '', NULL, '2024-08-30 11:03:41', '2024-08-30 11:03:41');

-- --------------------------------------------------------

--
-- Table structure for table `anz_setting_banks`
--

CREATE TABLE `anz_setting_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `anz_setting_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_fee` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `anz_setting_banks`
--

INSERT INTO `anz_setting_banks` (`id`, `anz_setting_id`, `bank_id`, `transaction_fee`, `created_at`, `updated_at`) VALUES
(1, 1, 4, 50.00, '2024-08-30 11:11:00', '2024-08-30 11:23:39'),
(5, 1, 1, NULL, '2024-10-01 16:17:33', '2024-10-01 16:17:33'),
(6, 1, 5, NULL, '2024-10-04 08:43:08', '2024-10-04 08:43:08');

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

-- --------------------------------------------------------

--
-- Table structure for table `attendance_records`
--

CREATE TABLE `attendance_records` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `work_time` varchar(100) DEFAULT NULL,
  `overtime_hours` varchar(100) DEFAULT NULL,
  `shift_in` time DEFAULT NULL,
  `shift_out` time DEFAULT NULL,
  `late` decimal(8,2) NOT NULL DEFAULT 0.00,
  `early` decimal(8,2) NOT NULL DEFAULT 0.00,
  `absence` tinyint(1) NOT NULL DEFAULT 0,
  `attendance_status` varchar(255) NOT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `is_process` tinyint(4) DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attendance_reports`
--

CREATE TABLE `attendance_reports` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `employee_name` varchar(255) DEFAULT NULL,
  `attendance_date` date DEFAULT NULL,
  `in_time` time DEFAULT NULL,
  `out_time` time DEFAULT NULL,
  `work_time` varchar(255) DEFAULT NULL,
  `late` time DEFAULT NULL,
  `early` time DEFAULT NULL,
  `absence` tinyint(1) NOT NULL DEFAULT 0,
  `absence_type` varchar(255) DEFAULT NULL,
  `leave_id` bigint(20) UNSIGNED DEFAULT NULL,
  `leave_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `leave_status` tinyint(4) DEFAULT NULL,
  `leave_reason` text DEFAULT NULL,
  `late_count_flag` tinyint(4) DEFAULT NULL,
  `holiday_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_holiday` tinyint(1) NOT NULL DEFAULT 0,
  `working_days_id` bigint(20) UNSIGNED DEFAULT NULL,
  `working_hours` decimal(8,2) DEFAULT NULL,
  `working_day_name` varchar(255) DEFAULT NULL,
  `paid_hours` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `banks`
--

CREATE TABLE `banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `bank_code` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `bank_details`
--

CREATE TABLE `bank_details` (
  `id` int(11) NOT NULL,
  `bank_detail_code` varchar(255) NOT NULL,
  `bank_detail_name` varchar(255) NOT NULL,
  `bsb_number` varchar(255) NOT NULL,
  `bank_type` varchar(255) NOT NULL,
  `bank_address` varchar(255) NOT NULL,
  `bank_phone` varchar(255) NOT NULL,
  `employment_account_number` varchar(255) NOT NULL,
  `account_suffix` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_details`
--

INSERT INTO `bank_details` (`id`, `bank_detail_code`, `bank_detail_name`, `bsb_number`, `bank_type`, `bank_address`, `bank_phone`, `employment_account_number`, `account_suffix`, `status`, `created_at`, `updated_at`) VALUES
(2, '032002', 'Test West Pac Bank', '032002', '1', 'Testing addresss', '1234567890', '256666', '112', '1', '2024-08-28 11:22:56', '2024-08-28 11:22:56'),
(3, '032005', 'Test Kina Bank Detail', '032005', '5', 'New Address Kina', '1234567890', '2569696', '114', '1', '2024-08-28 11:23:54', '2024-08-28 11:46:34');

-- --------------------------------------------------------

--
-- Table structure for table `bank_list`
--

CREATE TABLE `bank_list` (
  `id` int(11) NOT NULL,
  `bank_code` varchar(255) NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bank_list`
--

INSERT INTO `bank_list` (`id`, `bank_code`, `bank_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'BSP', 'Bank South Pacific', '1', '2024-08-21 14:47:22', '2024-08-21 14:51:01'),
(3, 'WPC', 'WestPac Bank', '1', '2024-08-28 11:12:06', '2024-08-28 11:12:06'),
(4, 'ANZ', 'Australia & New Zealand Bank', '1', '2024-08-28 11:12:24', '2024-08-28 11:12:24'),
(5, 'KINA', 'KINA BANK', '1', '2024-08-28 11:12:46', '2024-08-28 11:12:46');

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
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` int(10) UNSIGNED NOT NULL,
  `branch_code` varchar(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_address` text NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_code`, `branch_name`, `branch_address`, `status`, `created_at`, `updated_at`) VALUES
(2, 'PNG-1', 'Port Moresby', 'Port Moresby, Papua New Guinea', '1', '2024-08-21 13:46:50', '2024-08-21 14:07:32'),
(3, 'PNG-2', 'PNG New Branch', '50 River Esplanade', '1', '2024-08-28 11:25:08', '2024-08-28 11:25:08'),
(4, 'POM 1', 'ADZGURU POM', 'LEVEL 2, CROWN HOTEL PORT MORES', '1', '2024-08-28 11:26:19', '2024-08-28 11:26:19'),
(5, 'LAE', 'ADZGURU LAE', 'ERIKU STREET LAE', '1', '2024-08-28 11:27:11', '2024-08-28 11:27:11'),
(6, 'HAGEN & GKA', 'ADGURU HAGEN & GOROKA', 'GOROKA', '1', '2024-08-28 11:28:04', '2024-08-28 11:28:04'),
(7, 'KOL-1', 'Kolkata', 'Kolkata, India', '1', '2024-08-28 11:29:10', '2024-08-28 11:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `bsp_bank_transfer_setups`
--

CREATE TABLE `bsp_bank_transfer_setups` (
  `id` int(10) UNSIGNED NOT NULL,
  `bsp_customer_reference` varchar(255) DEFAULT NULL,
  `bsp_folder_directory` varchar(255) DEFAULT NULL,
  `gl_account_code` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bsp_bank_transfer_setups`
--

INSERT INTO `bsp_bank_transfer_setups` (`id`, `bsp_customer_reference`, `bsp_folder_directory`, `gl_account_code`, `created_at`, `updated_at`) VALUES
(1, '123456789', 'C://ravi', 4, '2024-08-29 14:15:24', '2024-08-30 09:26:31'),
(2, '1234567', 'C://ravi', 3, '2024-08-29 14:43:26', '2024-08-29 14:43:26'),
(3, '12345678', 'C://ravi', 3, '2024-08-29 14:44:01', '2024-08-29 14:44:01'),
(4, '12345678', 'C://ravi', 3, '2024-08-29 14:44:55', '2024-08-29 14:44:55'),
(5, '123456789', 'C://ravi', 3, '2024-08-29 14:45:47', '2024-08-29 14:45:47'),
(6, '', '', NULL, '2024-10-03 09:58:16', '2024-10-03 09:58:16'),
(7, '', '', NULL, '2024-10-09 16:15:00', '2024-10-09 16:15:00'),
(8, '', '', NULL, '2024-11-29 04:21:19', '2024-11-29 04:21:19'),
(9, '', '', NULL, '2025-06-20 16:13:59', '2025-06-20 16:13:59'),
(10, '', '', NULL, '2025-06-20 16:14:04', '2025-06-20 16:14:04'),
(11, '', '', NULL, '2025-06-20 16:15:47', '2025-06-20 16:15:47');

-- --------------------------------------------------------

--
-- Table structure for table `bsp_setting_banks`
--

CREATE TABLE `bsp_setting_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `bsp_setting_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_fee` float(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bsp_setting_banks`
--

INSERT INTO `bsp_setting_banks` (`id`, `bsp_setting_id`, `bank_id`, `transaction_fee`, `created_at`, `updated_at`) VALUES
(53, 1, 1, 5.00, '2024-08-30 14:25:02', '2025-06-20 16:15:35'),
(54, 1, 4, 1.00, '2024-08-30 16:50:26', '2025-06-20 16:15:59');

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `trading_name` varchar(255) DEFAULT NULL,
  `phone1` varchar(255) DEFAULT NULL,
  `phone2` varchar(255) DEFAULT NULL,
  `fax1` varchar(255) DEFAULT NULL,
  `fax2` varchar(255) DEFAULT NULL,
  `tax_number` varchar(255) DEFAULT NULL,
  `business_number` varchar(255) DEFAULT NULL,
  `initial_payroll_year` int(11) DEFAULT NULL,
  `current_payroll_year` int(11) DEFAULT NULL,
  `employee_limit` int(11) DEFAULT NULL,
  `contact_person` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `address_street_no` varchar(255) DEFAULT NULL,
  `address_street_name` varchar(255) DEFAULT NULL,
  `address_city` varchar(255) DEFAULT NULL,
  `address_state` varchar(255) DEFAULT NULL,
  `address_postcode` varchar(255) DEFAULT NULL,
  `address_country` varchar(255) DEFAULT NULL,
  `mailing_street_no` varchar(255) DEFAULT NULL,
  `mailing_street_name` varchar(255) DEFAULT NULL,
  `mailing_city` varchar(255) DEFAULT NULL,
  `mailing_state` varchar(255) DEFAULT NULL,
  `mailing_postcode` varchar(255) DEFAULT NULL,
  `mailing_country` varchar(255) DEFAULT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `bank_detail_id` int(11) DEFAULT NULL,
  `setting_table_name` varchar(255) DEFAULT NULL,
  `bank_setting_id` int(11) DEFAULT NULL,
  `transaction_fee` decimal(10,2) DEFAULT NULL,
  `superannuation_id` int(11) DEFAULT NULL,
  `superannuation_fund` varchar(255) DEFAULT NULL,
  `superannuation_number` varchar(255) DEFAULT NULL,
  `ncsl_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `name`, `trading_name`, `phone1`, `phone2`, `fax1`, `fax2`, `tax_number`, `business_number`, `initial_payroll_year`, `current_payroll_year`, `employee_limit`, `contact_person`, `email`, `address_street_no`, `address_street_name`, `address_city`, `address_state`, `address_postcode`, `address_country`, `mailing_street_no`, `mailing_street_name`, `mailing_city`, `mailing_state`, `mailing_postcode`, `mailing_country`, `bank_id`, `bank_detail_id`, `setting_table_name`, `bank_setting_id`, `transaction_fee`, `superannuation_id`, `superannuation_fund`, `superannuation_number`, `ncsl_number`, `created_at`, `updated_at`) VALUES
(1, 'Adzguru (PNG) Limited', 'Adzguru', '3200030', NULL, NULL, NULL, '5000903', '1-137723', 2024, 2024, 20, 'Sayantan Chatterjee', 'reachus@adzguru.co', 'P O Box 6149,  Boroko 111', 'Hunter Street', 'Port Moresby', 'National Capital District', '74856', 'Papua New Guinea', 'P O Box 6149,  Boroko 111', 'Hunter Street', 'Port Moresby', 'National Capital District', '23456', 'Papua New Guinea', 1, 2, 'bsp_setting_banks', 53, 0.01, 1, '8.5', '123456', '123456', '2024-11-05 15:16:27', '2024-11-11 14:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `cost_centers`
--

CREATE TABLE `cost_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `cost_center_code` varchar(255) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1 COMMENT '0 => disable, 1 => enable',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_centers`
--

INSERT INTO `cost_centers` (`id`, `name`, `cost_center_code`, `status`, `created_at`, `updated_at`) VALUES
(3, 'Sales & Marketing', 'SALMAR', 1, '2025-02-06 15:22:57', '2025-02-06 15:57:07'),
(4, 'Administration', 'ADMIN', 1, '2025-02-06 15:57:45', '2025-02-06 15:57:45'),
(5, 'Operations', 'OPS', 1, '2025-02-06 17:27:14', '2025-02-06 17:27:14'),
(6, 'HR & Purchase', 'HRP', 1, '2025-02-07 09:39:31', '2025-02-07 09:39:31');

-- --------------------------------------------------------

--
-- Table structure for table `cost_center_department_rel`
--

CREATE TABLE `cost_center_department_rel` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `cost_center_id` bigint(20) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cost_center_department_rel`
--

INSERT INTO `cost_center_department_rel` (`id`, `cost_center_id`, `department_id`, `created_at`, `updated_at`) VALUES
(7, 3, 6, NULL, NULL),
(8, 3, 7, NULL, NULL),
(9, 4, 1, NULL, NULL),
(10, 5, 2, NULL, NULL),
(11, 5, 3, NULL, NULL),
(12, 5, 4, NULL, NULL),
(13, 6, 4, NULL, NULL),
(14, 6, 5, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `currencies`
--

CREATE TABLE `currencies` (
  `id` int(10) UNSIGNED NOT NULL,
  `currency_code` varchar(255) NOT NULL,
  `currency_name` varchar(255) NOT NULL,
  `exchange_rate` decimal(15,6) NOT NULL DEFAULT 1.000000,
  `exchange_currency` varchar(255) NOT NULL DEFAULT 'USD',
  `last_er_update` date NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `currencies`
--

INSERT INTO `currencies` (`id`, `currency_code`, `currency_name`, `exchange_rate`, `exchange_currency`, `last_er_update`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PGK', 'PNG Kina', 21.170000, 'INR', '2024-09-02', 1, '2024-09-02 14:11:52', '2024-09-02 14:11:52');

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
(7, 1, 'Sales', 'Sales', 1, 0, '2023-11-30 11:09:23', '2019-09-25 03:38:15'),
(8, 1, 'Operations', 'Operations', 1, 0, '2025-02-06 16:03:26', '2025-02-06 16:03:26');

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

-- --------------------------------------------------------

--
-- Table structure for table `employee_bank_rels`
--

CREATE TABLE `employee_bank_rels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `bank_id` bigint(20) UNSIGNED NOT NULL,
  `account_no` varchar(255) NOT NULL,
  `bank_code` varchar(255) DEFAULT NULL,
  `ifsc_code` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `account_holder_name` varchar(255) NOT NULL,
  `address` varchar(255) DEFAULT NULL,
  `city` varchar(255) DEFAULT NULL,
  `state` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `email_address` varchar(255) DEFAULT NULL,
  `country_code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_bank_rels`
--

INSERT INTO `employee_bank_rels` (`id`, `emp_id`, `bank_id`, `account_no`, `bank_code`, `ifsc_code`, `swift_code`, `account_holder_name`, `address`, `city`, `state`, `branch_name`, `email_address`, `country_code`, `created_at`, `updated_at`) VALUES
(1, 4, 3, '15896355', '', NULL, 'BSP 12589', 'JP', 'Lokenath Apartment', 'Kolkata', NULL, NULL, 'php.ravikr84@gmail.com', 'Ind', '2025-07-15 16:23:10', '2025-07-15 16:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `employee_contacts`
--

CREATE TABLE `employee_contacts` (
  `id` int(10) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `employee_contact_name` varchar(255) NOT NULL,
  `employee_contact_address` text NOT NULL,
  `employee_contact_phone` varchar(255) NOT NULL,
  `employee_contact_mobile` varchar(255) NOT NULL,
  `employee_contact_email` varchar(255) NOT NULL,
  `employee_contact_relationship` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_contacts`
--

INSERT INTO `employee_contacts` (`id`, `employee_id`, `employee_contact_name`, `employee_contact_address`, `employee_contact_phone`, `employee_contact_mobile`, `employee_contact_email`, `employee_contact_relationship`, `created_at`, `updated_at`) VALUES
(12, 66, 'Falguni Di', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '12345789', '07439272532', 'falguni@gmail.com', 'Friend', '2024-10-28 15:41:44', '2024-10-28 15:41:44'),
(13, 67, 'Prajti Chakarborty', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '07439272532', '123456789', 'php.ravikr84@gmail.com', 'Friend', '2024-10-28 15:53:25', '2024-10-28 15:53:25'),
(14, 68, 'Ravi Kumar', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '07439272532', '07439272532', 'php.ravikr84@gmail.com', 'wife', '2024-11-07 09:33:47', '2024-11-07 09:33:47'),
(15, 70, 'Ravi Kumar', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '07439272532', '07439272532', 'php.ravikr84@gmail.com', 'husband', '2024-11-07 12:18:44', '2024-11-07 12:18:44'),
(16, 71, 'Ravi Kumar', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '07439272532', '07439272532', 'php.ravikr84@gmail.com', 'teacher', '2024-11-08 09:35:40', '2024-11-08 09:35:40'),
(17, 72, 'Ravi Kumar', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '07439272532', '07439272532', 'php.ravikr84@gmail.com', 'Friend', '2024-11-08 16:17:53', '2024-11-08 16:17:53'),
(18, 73, 'Ravi Kumar', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '07439272532', '07439272532', 'php.ravikr84@gmail.com', 'Friend', '2024-11-08 16:27:35', '2024-11-08 16:27:35'),
(19, 78, 'Ravi Kumar', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '07439272532', '07439272532', 'php.ravikr84@gmail.com', 'friend', '2024-11-13 23:22:56', '2024-11-13 23:22:56'),
(21, 79, 'Jeremiah Iru', '9 mile, NCD, Port Moresby', '72175767', '72175767', 'jeremiah@adzguru.com.au', 'Employee', '2024-11-15 17:37:39', '2024-11-15 17:37:39'),
(22, 82, 'John Macalan', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '123456789', '123456789', 'johnmc@gmail.com', 'Friend', '2024-11-21 21:19:05', '2024-11-21 21:19:05'),
(23, 83, 'Francis Fedora', 'testing france villa', '1234567890', '1234567890', 'florida@gmail.com', 'teacher', '2024-11-21 21:28:45', '2024-11-21 21:28:45'),
(24, 84, 'Voghus', '11A RAMESHWAR GUHA STREET, TIRUPATI TOWER', '1234567772', '589636955', 'bhogus@gmail.com', 'teacher', '2024-11-21 21:39:14', '2024-11-21 21:41:09'),
(25, 85, 'Shailey Johnsan', 'Testing Christina Villa', '1234567890', '1234567890', 'shailey@gmail.com', 'Friend', '2024-11-21 22:07:55', '2024-11-21 22:07:55'),
(26, 86, 'Jeremiah Testing', '9 mile, NCD, Port Moresby', '123456789', '123456789', 'jeremiah@gmail.com', 'Employee', '2024-11-21 22:35:18', '2024-11-21 22:35:18'),
(29, 126, 'Ravi Kumar', 'Lokenath Apartment', '08582957232', '08582957232', 'php.ravikr84@gmail.com', 'teacher', '2025-07-10 16:11:13', '2025-07-10 16:11:13'),
(33, 127, 'Ravi Kumar', 'Lokenath Apartment', '08582957232', '08582957232', 'php.ravikr84@gmail.com', 'wife', '2025-07-14 16:21:42', '2025-07-14 16:21:42'),
(37, 130, 'Ravi Kumar', 'Lokenath Apartment', '08582957232', '08582957232', 'php.ravikr84@gmail.com', 'Friend', '2025-07-14 16:30:30', '2025-07-14 16:30:30'),
(49, 4, 'Ravi Kumar', 'Lokenath Apartment', '08582957232', '08582957232', 'php.ravikr84@gmail.com', 'teacher', '2025-07-15 16:41:27', '2025-07-15 16:41:27');

-- --------------------------------------------------------

--
-- Table structure for table `employee_cost_centers`
--

CREATE TABLE `employee_cost_centers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `cost_center_id` bigint(20) UNSIGNED DEFAULT NULL,
  `department_id` bigint(20) UNSIGNED DEFAULT NULL,
  `share_percentage` decimal(5,2) DEFAULT NULL,
  `payroll_location_id` bigint(20) UNSIGNED DEFAULT NULL,
  `payroll_batch_id` bigint(20) UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_cost_centers`
--

INSERT INTO `employee_cost_centers` (`id`, `employee_id`, `cost_center_id`, `department_id`, `share_percentage`, `payroll_location_id`, `payroll_batch_id`, `created_at`, `updated_at`) VALUES
(4, 4, 3, 6, 100.00, 2, 1, '2025-07-15 16:41:25', '2025-07-15 16:41:25');

-- --------------------------------------------------------

--
-- Table structure for table `employee_leave_msts`
--

CREATE TABLE `employee_leave_msts` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `leave_category_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_leave_msts`
--

INSERT INTO `employee_leave_msts` (`id`, `emp_id`, `leave_category_id`, `created_at`, `updated_at`) VALUES
(7, 4, 1, '2025-07-15 16:41:29', '2025-07-15 16:41:29'),
(8, 4, 2, '2025-07-15 16:41:29', '2025-07-15 16:41:29'),
(9, 4, 4, '2025-07-15 16:41:29', '2025-07-15 16:41:29');

-- --------------------------------------------------------

--
-- Table structure for table `employee_relations`
--

CREATE TABLE `employee_relations` (
  `id` int(10) UNSIGNED NOT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `payroll_location_id` int(11) DEFAULT NULL,
  `payroll_batch_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `employee_relations`
--

INSERT INTO `employee_relations` (`id`, `emp_id`, `department_id`, `branch_id`, `payroll_location_id`, `payroll_batch_id`, `created_at`, `updated_at`) VALUES
(3, 4, 6, 2, 2, 1, '2025-07-15 16:23:10', '2025-07-15 16:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `empl_superannuation_rels`
--

CREATE TABLE `empl_superannuation_rels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` bigint(20) UNSIGNED NOT NULL,
  `superannuation_id` bigint(20) UNSIGNED NOT NULL,
  `employer_contribution_percentage` varchar(255) DEFAULT NULL,
  `employer_contribution_fixed_amount` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `employer_superannuation_no` varchar(255) DEFAULT NULL,
  `employer_superannuation_id` int(11) DEFAULT NULL,
  `employer_superannuation_code` varchar(255) DEFAULT NULL,
  `employer_superannuation_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empl_superannuation_rels`
--

INSERT INTO `empl_superannuation_rels` (`id`, `employee_id`, `superannuation_id`, `employer_contribution_percentage`, `employer_contribution_fixed_amount`, `bank_name`, `bank_address`, `bank_account_number`, `employer_superannuation_no`, `employer_superannuation_id`, `employer_superannuation_code`, `employer_superannuation_name`, `created_at`, `updated_at`) VALUES
(4, 4, 1, '8.4', '0', NULL, NULL, NULL, '123456', NULL, NULL, NULL, '2025-07-15 16:41:32', '2025-07-15 16:41:32');

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
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
-- Table structure for table `gl_codes`
--

CREATE TABLE `gl_codes` (
  `id` int(10) UNSIGNED NOT NULL,
  `gl_code` varchar(255) NOT NULL,
  `gl_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gl_codes`
--

INSERT INTO `gl_codes` (`id`, `gl_code`, `gl_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'GST', 'Goods & Services Tax', 1, '2024-08-28 11:34:30', '2024-08-28 11:34:30'),
(2, 'GST-Free', 'Goods & Service Tax Free', 1, '2024-08-28 11:34:56', '2024-08-28 11:35:18'),
(3, 'SAL', 'Salary & Wages', 1, '2024-08-28 11:35:41', '2024-08-28 11:35:41'),
(4, 'Super', 'Superannuation', 1, '2024-08-28 11:35:58', '2024-08-28 11:35:58'),
(5, 'NA', 'None', 1, '2024-10-21 09:51:20', '2024-10-21 09:51:20');

-- --------------------------------------------------------

--
-- Table structure for table `gl_interface_control_files`
--

CREATE TABLE `gl_interface_control_files` (
  `id` int(10) UNSIGNED NOT NULL,
  `control_setup_name` varchar(255) DEFAULT NULL,
  `gl_code_account_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `gl_interface_control_files`
--

INSERT INTO `gl_interface_control_files` (`id`, `control_setup_name`, `gl_code_account_name`, `created_at`, `updated_at`) VALUES
(1, 'Tax Payabe GL Account', '1', '2024-08-30 14:20:17', '2024-08-30 14:20:17'),
(2, 'Bank Payabe GL Account', '3', '2024-08-30 14:20:54', '2024-08-30 14:24:37'),
(3, 'Cheque Payabe GL Account', '1', '2024-08-30 14:21:03', '2024-08-30 14:21:03'),
(4, 'Cash Payabe GL Account', '1', '2024-08-30 14:21:14', '2024-08-30 14:21:14'),
(5, 'Superannuation Expense GL Account', '4', '2024-08-30 14:21:29', '2024-08-30 14:24:46');

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
(1, 1, 'Christmas', '2025-12-25', 'Christmas, the holiday commemorating the birth of Jesus Christ, is celebrated by a majority of Christians on December 25 in the Gregorian calendar.', 1, 0, '2023-12-23 23:35:41', '2023-12-24 03:20:25'),
(2, 1, 'Independence Day', '2025-08-15', 'Independence Day', 1, 0, '2024-08-16 11:53:50', NULL),
(3, 1, 'Rakshabandhan', '2025-08-09', 'Rakshabandhan', 0, 0, NULL, NULL),
(4, 1, 'Janmastami', '2025-08-16', 'Sri Krishna janmastmi', 1, 0, NULL, NULL);

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

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kina_bank_transfer_setups`
--

CREATE TABLE `kina_bank_transfer_setups` (
  `id` int(10) UNSIGNED NOT NULL,
  `kina_customer_reference` varchar(255) DEFAULT NULL,
  `kina_folder_directory` varchar(255) DEFAULT NULL,
  `gl_code_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kina_bank_transfer_setups`
--

INSERT INTO `kina_bank_transfer_setups` (`id`, `kina_customer_reference`, `kina_folder_directory`, `gl_code_id`, `created_at`, `updated_at`) VALUES
(1, '123456788', 'g://test', NULL, '2024-08-30 14:09:41', '2024-08-30 14:09:41');

-- --------------------------------------------------------

--
-- Table structure for table `kina_setting_banks`
--

CREATE TABLE `kina_setting_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `kina_setting_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_fee` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `kina_setting_banks`
--

INSERT INTO `kina_setting_banks` (`id`, `kina_setting_id`, `bank_id`, `transaction_fee`, `created_at`, `updated_at`) VALUES
(3, 1, 5, 20.00, '2024-08-30 14:25:35', '2024-08-30 14:25:46'),
(4, 1, 3, 10.00, '2025-07-03 16:13:01', '2025-07-03 16:13:19'),
(5, 1, 4, 5.00, '2025-07-03 16:13:06', '2025-07-03 16:13:31');

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

-- --------------------------------------------------------

--
-- Table structure for table `leave_categories`
--

CREATE TABLE `leave_categories` (
  `id` int(10) UNSIGNED NOT NULL,
  `created_by` int(11) NOT NULL,
  `leave_category` varchar(100) NOT NULL,
  `item` varchar(255) NOT NULL,
  `qty` int(50) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `type_of_leave` varchar(255) NOT NULL DEFAULT '' COMMENT '''carry_forward'',''paid''',
  `leave_category_description` text NOT NULL,
  `publication_status` tinyint(4) NOT NULL,
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `leave_categories`
--

INSERT INTO `leave_categories` (`id`, `created_by`, `leave_category`, `item`, `qty`, `remarks`, `type_of_leave`, `leave_category_description`, `publication_status`, `deletion_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sick Leaves (SL)/Medical Leaves (ML)', 'As these leaves are prone to misuse, employers usually seek a medical certificate if the number of days of leave exceeds two or three days at a time.', 14, 'Half pay every year', 'paid', 'These are provided on the grounds of sickness or in case of accidents.\n\nSick Leave is another common leave type mandated by the law. As these leaves are prone to misuse, employers usually seek a medical certificate if the number of days of leave exceeds two or three days at a time.', 1, 0, '2023-12-16 11:50:01', '2024-08-09 11:46:33'),
(2, 1, 'Casual Leave (CL)', '1,0.5,0.25', 10, 'full pay every year', 'paid', 'Such leaves accommodate any urgent/ unforeseen personal requirements as against EL being planned leaves.\n\nUrgent plumbing issue at the house? Take half or full day of CL and get the problem sorted out. Need to go to the kid\'s school for some admission related work? CL comes to the rescue.', 1, 0, '2023-12-27 09:17:57', '2024-08-09 11:42:19'),
(4, 1, 'Privilege Leave (PL) / Earned Leave (EL) / Annual Leave (AL)', 'Leave Entitlement', 14, 'After 12 months of continuous service', 'paid', 'This leave type is called Earned Leave because you \'earn\' these leaves for days worked.\n\nThis kind of leave is also known as Vacation Leave (VL) or Privilege Leave (PL) or Flexi Holiday, or Annual Leave (AL).\n\nThe EL leave type is typically used for personal reasons such as vacation, to observe festivals that are not declared holidays, etc.\n\nLeave availed for a week or more is considered as \"long leave.” Since work may get disrupted if a team member goes on extended leave, this type of leave needs to be planned ahead of time, and the team or manager informed about it in advance.\n\nProviding earned leaves is mandatory as per labour laws, though the quantum of such leaves vary state by state. The leave entitlement is calculated based on a certain number of days worked (e.g., 20 workdays). Days worked shall not include holidays, weekends, or days when the employee does not work.\n\nA unique feature of earned leaves is that the leave balance at the end of the leave-year is carried forward to the next year. Again, state laws govern the quantum of leave to be carried forward to the following year.\n\nEarned Leaves can also be converted to cash through a process called Leave Encashment. The basic salary is usually considered as the unit of exchange to encash leaves. One day of EL balance converts to one day\'s basic pay. In some organizations, gross income is considered instead of basic salary.', 1, 0, '2024-08-09 09:53:18', '2024-08-09 11:44:38');

-- --------------------------------------------------------

--
-- Table structure for table `leave_details`
--

CREATE TABLE `leave_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `leave_name` varchar(255) NOT NULL,
  `leave_days` int(11) NOT NULL,
  `is_carryforward` tinyint(1) NOT NULL,
  `is_paycash` tinyint(1) NOT NULL,
  `user_type` varchar(255) NOT NULL,
  `published` tinyint(1) DEFAULT 0,
  `created_on` timestamp NULL DEFAULT NULL,
  `deleted_on` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `leave_managements`
--

CREATE TABLE `leave_managements` (
  `id` int(10) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `leave_category_id` int(10) UNSIGNED NOT NULL,
  `leave_type` varchar(255) NOT NULL,
  `leave_option` varchar(255) DEFAULT NULL,
  `start_date` date NOT NULL,
  `end_date` date NOT NULL,
  `reason` text DEFAULT NULL,
  `loss_of_pay_days` int(11) DEFAULT 0,
  `is_sandwich_leave` varchar(100) DEFAULT NULL,
  `sandwich_leave_days` int(50) DEFAULT NULL,
  `holiday_count` int(50) DEFAULT NULL,
  `pending_leave` decimal(5,2) DEFAULT 0.00,
  `leave_applied_days` int(50) DEFAULT NULL,
  `leave_cancel_days` int(11) DEFAULT NULL,
  `leave_disapprove_days` int(50) DEFAULT NULL,
  `status` tinyint(4) DEFAULT 0 COMMENT '''0''=>''pending'', ''1''=>''approved'',''2''=>''disapprove'',''3''=>''cancel''',
  `message` text DEFAULT NULL,
  `applied_by` int(50) DEFAULT NULL,
  `authorize_by` int(50) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `number_of_installments` varchar(255) DEFAULT NULL,
  `remaining_installments` varchar(255) DEFAULT NULL,
  `loan_description` text DEFAULT NULL,
  `loan_master_id` int(11) DEFAULT NULL,
  `loan_date` date DEFAULT NULL,
  `deduction_start_date` date DEFAULT NULL,
  `deduction_amount` varchar(255) DEFAULT NULL,
  `outstanding_amount` varchar(255) DEFAULT NULL,
  `loan_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1 = active, 2 = onhold, 3 = close',
  `deletion_status` tinyint(4) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_master`
--

CREATE TABLE `loan_master` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_code` varchar(255) NOT NULL,
  `loan_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_master`
--

INSERT INTO `loan_master` (`id`, `loan_code`, `loan_name`, `created_at`, `updated_at`) VALUES
(1, 'CAD', 'Salary Advance', '2024-10-10 12:35:48', '2024-11-16 02:36:24'),
(2, 'HML', 'Home Loan', '2024-10-11 09:30:08', '2024-10-11 09:52:26'),
(3, 'PL', 'Personal Loan', '2024-10-14 08:32:59', '2024-10-14 08:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `loan_payments`
--

CREATE TABLE `loan_payments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `loan_code` varchar(255) NOT NULL,
  `loan_name` varchar(255) NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `loan_amount` decimal(15,2) NOT NULL,
  `balance_amount` decimal(15,2) NOT NULL,
  `amount_to_pay` decimal(15,2) NOT NULL,
  `reference` varchar(255) DEFAULT NULL,
  `repayment_paid_on` date DEFAULT NULL,
  `payment_schedule` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=>Auto, 2=>Manual',
  `payment_status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '1=>Success, 2=>Hold, 3=>Failure',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2017_10_16_064138_create_client_types_table', 2),
(4, '2017_10_16_072245_create_designations_table', 2),
(5, '2017_11_11_090618_create_general_settings_table', 3),
(6, '2017_11_17_083029_create_files_table', 3),
(7, '2017_11_17_083147_create_folders_table', 3),
(8, '2017_12_29_092609_create_departments_table', 4),
(9, '2017_12_29_114115_create_leave_categories_table', 4),
(10, '2017_12_29_124702_create_attendances_table', 4),
(11, '2017_12_29_185757_create_working_days_table', 4),
(12, '2017_12_29_215610_create_holidays_table', 4),
(13, '2017_12_29_233919_create_personal_events_table', 4),
(14, '2017_12_30_161317_create_payrolls_table', 4),
(15, '2017_12_30_174811_create_notices_table', 4),
(16, '2017_12_31_185730_create_leave_applications_table', 4),
(17, '2018_01_03_081227_create_bonuses_table', 5),
(18, '2018_01_03_104224_create_deductions_table', 5),
(19, '2018_01_03_114151_create_loans_table', 5),
(20, '2018_01_03_153120_create_expence_managements_table', 5),
(21, '2018_01_04_061104_create_salary_payments_table', 5),
(22, '2018_01_04_173403_create_award_categories_table', 5),
(23, '2018_01_05_164319_create_employee_awards_table', 6),
(24, '2018_02_03_073729_entrust_setup_tables', 6),
(25, '2018_03_24_100116_create_salary_payment_details_table', 6),
(26, '2024_06_12_223552_add_working_hours_to_working_days_table', 7),
(27, '2024_06_13_160851_add_employee_type_resident_dependent_table', 7),
(28, '2024_06_13_211237_add_user_payroll_rel_id_table', 7),
(29, '2024_06_14_203605_create_bank_list_table', 7),
(30, '2024_06_14_203734_create_bank_details_table', 7),
(31, '2024_06_14_203812_create_overtime_list_table', 7),
(32, '2024_06_17_151905_create_employee_contact_table', 7),
(33, '2024_06_20_223024_create_leave_details_table', 8),
(34, '2024_08_09_154020_add_column_leave_categories', 8),
(35, '2024_08_09_172717_create_leave_applications_table', 8),
(36, '2024_08_12_161645_create_leave_managements_table', 8),
(37, '2014_10_12_000000_create_users_table', 1),
(38, '2014_10_12_100000_create_password_resets_table', 1),
(39, '2017_10_16_064138_create_client_types_table', 2),
(40, '2017_10_16_072245_create_designations_table', 2),
(41, '2017_11_11_090618_create_general_settings_table', 3),
(42, '2017_11_17_083029_create_files_table', 3),
(43, '2017_11_17_083147_create_folders_table', 3),
(44, '2017_12_29_092609_create_departments_table', 4),
(45, '2017_12_29_114115_create_leave_categories_table', 4),
(46, '2017_12_29_124702_create_attendances_table', 4),
(47, '2017_12_29_185757_create_working_days_table', 4),
(48, '2017_12_29_215610_create_holidays_table', 4),
(49, '2017_12_29_233919_create_personal_events_table', 4),
(50, '2017_12_30_161317_create_payrolls_table', 4),
(51, '2017_12_30_174811_create_notices_table', 4),
(52, '2017_12_31_185730_create_leave_applications_table', 4),
(53, '2018_01_03_081227_create_bonuses_table', 5),
(54, '2018_01_03_104224_create_deductions_table', 5),
(55, '2018_01_03_114151_create_loans_table', 5),
(56, '2018_01_03_153120_create_expence_managements_table', 5),
(57, '2018_01_04_061104_create_salary_payments_table', 5),
(58, '2018_01_04_173403_create_award_categories_table', 5),
(59, '2018_01_05_164319_create_employee_awards_table', 6),
(60, '2018_02_03_073729_entrust_setup_tables', 6),
(61, '2018_03_24_100116_create_salary_payment_details_table', 6),
(62, '2024_06_12_223552_add_working_hours_to_working_days_table', 7),
(63, '2024_06_13_160851_add_employee_type_resident_dependent_table', 7),
(64, '2024_06_13_211237_add_user_payroll_rel_id_table', 7),
(65, '2024_06_14_203605_create_bank_list_table', 7),
(66, '2024_06_14_203734_create_bank_details_table', 7),
(67, '2024_06_14_203812_create_overtime_list_table', 7),
(68, '2024_06_17_151905_create_employee_contact_table', 7),
(69, '2024_06_20_223024_create_leave_details_table', 8),
(70, '2024_08_09_154020_add_column_leave_categories', 8),
(71, '2024_08_09_172717_create_leave_applications_table', 8),
(72, '2024_08_12_161645_create_leave_managements_table', 8),
(73, '2024_08_21_183826_create_branches_table', 9),
(74, '2024_08_21_192444_add_column_status_branches_tbl', 10),
(75, '2024_08_21_193907_create_banks_table', 11),
(77, '2024_08_21_194348_add_column_status', 12),
(78, '2024_08_21_200202_add_column_status_bank_list', 13),
(79, '2024_08_21_205650_create_pay_batch_numbers_table', 14),
(80, '2024_08_21_211107_create_pay_locations_table', 14),
(81, '2024_08_21_213648_create_gl_codes_table', 15),
(82, '2024_08_21_221438_create_pay_accumulators_table', 15),
(83, '2024_08_21_222816_create_superannuations_table', 16),
(84, '2024_08_21_224322_create_currencies_table', 17),
(90, '2024_08_28_141827_create_g_l_interface_control_files_table', 18),
(91, '2024_08_28_141910_create_b_s_p_bank_transfer_setups_table', 18),
(92, '2024_08_28_141935_create_a_n_z_bank_transfer_setups_table', 18),
(93, '2024_08_28_142032_create_k_i_n_a_bank_transfer_setups_table', 18),
(94, '2024_08_28_142134_w_p_a_c_bank_transfer_setups_table', 18),
(95, '2024_08_28_144215_create_bsp_setting_banks_table', 19),
(96, '2024_08_28_144229_create_anz_setting_banks_table', 19),
(97, '2024_08_28_144240_create_kina_setting_banks_table', 19),
(98, '2024_08_28_144251_create_wpac_setting_banks_table', 20),
(99, '2024_08_28_150508_create_period_defination_rates_table', 21),
(100, '2024_08_28_154819_create_pay_items_table', 22),
(101, '2024_08_29_221213_remove_foreign_key_table_anz_setting_banks', 23),
(102, '2024_08_29_221316_remove_foreign_key_table_wpac_setting_banks', 23),
(103, '2024_08_29_221347_remove_foreign_key_table_kina_setting_banks', 23),
(104, '2024_08_30_165156_add_column_transaction_fee', 24),
(105, '2024_08_30_172937_add_column_transaction_fee_wpac', 25),
(106, '2024_08_30_173000_add_column_transaction_fee_kina', 25),
(107, '2024_08_30_192358_change_column_name_kina_bank_transfer_setups', 26),
(108, '2024_08_30_215934_drop_foriegn_keytable_pay_items', 27),
(109, '2024_09_02_200650_create_pay_references_table', 28),
(110, '2024_09_02_200718_create_pay_reference_department_rels_table', 28),
(111, '2024_09_02_200731_create_pay_reference_pay_location_rels_table', 28),
(112, '2024_09_05_201500_create_employee_relations_table', 29),
(113, '2024_09_06_152752_create_pay_reference_empl_relations_table', 30),
(114, '2024_09_20_155237_create_employee_leave_msts_table', 31),
(115, '2024_09_30_155408_create_pay_reference_update_leaves_table', 32),
(117, '2024_10_01_204651_create_attendance_records_table', 33),
(119, '2024_10_07_152517_create_attendance_reports', 34),
(120, '2024_10_09_202409_create_pay_reference_pay_slips_table', 35),
(122, '2024_10_10_151203_add_column_payref_status', 36),
(123, '2024_10_10_173824_create_loan_master_table', 37),
(125, '2024_10_11_153225_add_column_new_table_loans', 38),
(126, '2024_10_14_211257_create_loan_payments_table', 39),
(127, '2024_10_15_184738_add_column_user_id_loan_payments', 40),
(128, '2024_10_15_221431_create_pay_reference_update_loans_table', 41),
(130, '2024_10_16_150450_add_column_new_twelve_columns_pay_reference_pay_slips', 42),
(131, '2024_10_16_170158_add_new_column_total_benefits_taxes', 43),
(132, '2024_10_16_193221_create_employee_bank_rels_table', 44),
(133, '2024_10_16_213514_add_salary_days_count_to_period_defination_rates_table', 45),
(134, '2024_10_17_165754_remove_unique_constraint_from_loan_code_in_loan_payments_table', 46),
(135, '2024_10_17_174627_add_column_loan_deduction_installment', 47),
(136, '2024_10_18_145333_add_column_bank_id_bank_detail_id', 48),
(137, '2024_10_21_173313_create_pay_reference_payitems_table', 49),
(138, '2024_10_21_204146_add_column_user_id_payitems', 50),
(139, '2024_10_21_213446_add_column_add_pay_items_tbl', 51),
(140, '2024_10_23_190038_create_empl_superannuation_rels_table', 52),
(141, '2024_10_24_171836_add_column_is_process', 53),
(142, '2024_10_26_190309_add_column_paid_on', 54),
(143, '2024_10_26_192210_create_pay_reference_emp_superannuation_rels_table', 55),
(144, '2024_10_29_214119_add_column_dependents', 56),
(145, '2024_10_30_161744_add_column_benefits', 57),
(146, '2024_11_04_222112_create_companies_table', 58),
(147, '2024_11_05_213756_add_column_payref_payslips_status', 59),
(148, '2024_11_07_164741_add_column_employer_superannuation_no', 60),
(149, '0001_01_01_000001_create_cache_table', 61),
(150, '0001_01_01_000002_create_jobs_table', 61),
(151, '2025_01_14_202637_create_permission_tables', 62),
(152, '2025_02_06_154001_create_cost_centers_table', 63),
(154, '2025_02_06_202346_remove_department_id_from_cost_centers_table', 64),
(155, '2025_02_06_203517_create_cost_center_department_rel_table', 65),
(156, '2025_02_06_211343_add_column_cost_center_code', 66),
(157, '2025_02_10_203038_create_user_details_table', 67),
(158, '2025_07_02_211912_create_tax_rates_table', 68),
(159, '2025_07_10_181000_create_employee_cost_centers_table', 69),
(160, '2025_07_10_201031_add_end_date_to_users_table', 70),
(161, '2025_07_10_201831_add_branch_to_users_table', 71),
(162, '2025_07_10_203607_add_passport_and_visa_number_to_users_table', 72),
(163, '2025_07_15_191008_add_two_columns_payrolls_table', 73);

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
-- Table structure for table `overtime_list`
--

CREATE TABLE `overtime_list` (
  `id` int(11) NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `fixed_amount` decimal(10,2) NOT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `overtime_list`
--

INSERT INTO `overtime_list` (`id`, `code`, `name`, `fixed_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'OT1', 'Overtime 1', 6.00, '1', '2024-06-14 15:54:49', '2024-06-14 11:44:38'),
(2, 'OT2', 'Overtime 2', 6.00, '1', '2024-06-14 15:58:34', '2024-06-14 16:05:33');

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
  `employee_type` tinyint(4) DEFAULT NULL COMMENT '1 for Provision & 2 for Permanent',
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
  `annual_salary` varchar(255) DEFAULT NULL,
  `empl_superannuation_id` bigint(20) UNSIGNED DEFAULT NULL,
  `employer_contribution_percentage` decimal(5,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `payrolls`
--

INSERT INTO `payrolls` (`id`, `created_by`, `user_id`, `employee_type`, `resident_status`, `no_of_dependent`, `declaration_lodge_status`, `hrly_salary_rate`, `overtime_hr`, `overtime_rate`, `overtime_amt`, `sales_comm`, `basic_salary`, `house_rent_allowance`, `medical_allowance`, `special_allowance`, `provident_fund_contribution`, `other_allowance`, `electricity_allowance`, `security_allowance`, `tax_deduction_a`, `tax_deduction_b`, `provident_fund_deduction`, `other_deduction`, `activation_status`, `hr_place`, `hr_area`, `hra_type`, `hra_amount_per_week`, `va_type`, `vehicle_allowance`, `meals_tag`, `meals_allowance`, `annual_salary`, `empl_superannuation_id`, `employer_contribution_percentage`, `created_at`, `updated_at`) VALUES
(3, 1, 4, 2, '1', 3, NULL, '34.34', NULL, NULL, NULL, NULL, '3846.15', '400.00', NULL, NULL, NULL, NULL, NULL, NULL, '1288.15', NULL, NULL, NULL, 0, 8, 'Area 1', 1, '1600', 1, '125.00', 1, '30', '100000', NULL, NULL, '2025-07-15 16:23:10', '2025-07-15 16:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `pay_accumulators`
--

CREATE TABLE `pay_accumulators` (
  `id` int(10) UNSIGNED NOT NULL,
  `pay_accumulator_code` varchar(255) NOT NULL,
  `pay_accumulator_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_accumulators`
--

INSERT INTO `pay_accumulators` (`id`, `pay_accumulator_code`, `pay_accumulator_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NO', 'Normal Pay / Ordinary Pay', 1, '2024-08-28 11:37:09', '2024-08-28 11:37:09'),
(2, 'O1', 'Overtime 1', 1, '2024-08-28 11:37:30', '2024-08-28 11:37:30'),
(3, 'OT2', 'Overtime 2', 1, '2024-08-28 11:37:51', '2024-08-28 11:37:51'),
(4, 'S1', 'Special Rate 1', 1, '2024-08-28 11:38:22', '2024-08-28 11:38:22'),
(5, 'S2', 'Special Rate 2', 1, '2024-08-28 11:38:38', '2024-08-28 11:38:38'),
(6, 'TA', 'Taxable Benefits & Allowance', 1, '2024-08-28 11:39:03', '2024-08-28 11:39:03'),
(7, 'NA', 'Non Taxable Benefits & Allowance', 1, '2024-08-28 11:39:26', '2024-08-28 11:39:26'),
(8, 'SE', 'Superannuation Employee', 1, '2024-08-28 11:39:49', '2024-08-28 11:39:49'),
(9, 'SR', 'Superannuation Employer', 1, '2024-08-28 11:40:23', '2024-08-28 11:40:23'),
(10, 'MV', 'Motor Vehicle Notional Allowances', 1, '2024-08-28 11:40:52', '2024-08-28 11:40:52');

-- --------------------------------------------------------

--
-- Table structure for table `pay_batch_numbers`
--

CREATE TABLE `pay_batch_numbers` (
  `id` int(10) UNSIGNED NOT NULL,
  `pay_batch_number_code` varchar(255) NOT NULL,
  `pay_batch_number_name` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_batch_numbers`
--

INSERT INTO `pay_batch_numbers` (`id`, `pay_batch_number_code`, `pay_batch_number_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'PB-1', 'Pay Batch 1', 1, '2024-08-28 11:30:42', '2024-08-28 11:30:42'),
(2, 'POM', 'ADZGURU PORT MORESBY', 1, '2024-08-28 11:31:19', '2024-08-28 11:31:19'),
(3, 'LAE', 'ADZGURU LAE', 1, '2024-08-28 11:31:42', '2024-08-28 11:31:42'),
(4, 'HAGEN & GKA', 'ADZGURU GOROKA & HAGEN', 1, '2024-08-28 11:32:23', '2024-08-28 11:32:23');

-- --------------------------------------------------------

--
-- Table structure for table `pay_items`
--

CREATE TABLE `pay_items` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `accumulator` int(10) UNSIGNED DEFAULT NULL,
  `glaccount` int(10) UNSIGNED DEFAULT NULL,
  `tax_rate` decimal(8,2) DEFAULT NULL,
  `spread_code` varchar(255) DEFAULT NULL,
  `taxflag` varchar(255) DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_detail_id` int(11) DEFAULT NULL,
  `superannuation_fund_id` int(10) UNSIGNED DEFAULT NULL,
  `payment_mode` varchar(255) DEFAULT NULL,
  `fixed_amount` decimal(8,2) DEFAULT NULL,
  `percentage` decimal(8,2) DEFAULT NULL,
  `sequence` varchar(255) DEFAULT NULL,
  `will_accure_leave` enum('0','1') DEFAULT '1' COMMENT '0: No, 1: Yes',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_items`
--

INSERT INTO `pay_items` (`id`, `code`, `name`, `accumulator`, `glaccount`, `tax_rate`, `spread_code`, `taxflag`, `bank_id`, `bank_detail_id`, `superannuation_fund_id`, `payment_mode`, `fixed_amount`, `percentage`, `sequence`, `will_accure_leave`, `created_at`, `updated_at`) VALUES
(8, 'BNS', 'Bonus 2024', 1, 3, NULL, NULL, 'TA', 1, 2, 1, 'F', 6000.00, NULL, NULL, '0', '2024-09-02 13:46:05', '2024-09-02 13:46:30'),
(9, 'LSL2', 'Long Service Leave @ 2%', 1, 3, NULL, NULL, 'TA', 1, 2, 1, 'P', NULL, 4.00, NULL, '0', '2024-09-02 14:02:00', '2024-09-02 14:03:45'),
(10, 'BACK', 'Back Pay', 6, 5, NULL, NULL, 'TA', 1, 2, 1, 'F', NULL, NULL, NULL, '0', '2024-10-21 09:51:45', '2024-10-21 09:51:45'),
(11, 'OT1', 'Overtime 1', 2, 3, NULL, NULL, 'TA', 1, 2, 1, 'F', 11.00, NULL, NULL, '0', '2024-10-26 13:14:21', '2024-10-26 13:16:07'),
(12, 'COMM', 'Commission', 1, 3, NULL, NULL, 'NA', 1, 2, 1, 'F', 45.00, NULL, NULL, '0', '2024-10-28 16:19:29', '2024-10-28 16:19:29');

-- --------------------------------------------------------

--
-- Table structure for table `pay_locations`
--

CREATE TABLE `pay_locations` (
  `id` int(10) UNSIGNED NOT NULL,
  `payroll_location_code` varchar(255) NOT NULL,
  `payroll_location_name` varchar(255) NOT NULL,
  `bank_id` int(11) DEFAULT NULL,
  `bank_detail_id` int(11) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pay_locations`
--

INSERT INTO `pay_locations` (`id`, `payroll_location_code`, `payroll_location_name`, `bank_id`, `bank_detail_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'LAE', 'LAE', NULL, NULL, 1, '2024-08-28 11:33:16', '2024-08-28 11:33:16'),
(2, 'PORT MORESBY', 'PORT MORESBY', NULL, NULL, 1, '2024-08-28 11:33:30', '2024-08-28 11:33:30'),
(3, 'HAGEN & GOROKA', 'HAGEN & GOROKA', NULL, NULL, 1, '2024-08-28 11:33:44', '2024-08-28 11:33:44'),
(4, 'Pay Location Mumbai', 'Mumbai', NULL, NULL, 1, '2024-10-18 11:54:43', '2024-10-18 11:54:43'),
(5, 'Pay Location Chennai', 'Chennai', NULL, NULL, 1, '2024-10-18 12:00:27', '2024-10-18 12:00:27'),
(6, 'Pay Location Pune', 'Pune', 5, 3, 1, '2024-10-18 12:06:55', '2024-10-18 12:06:55');

-- --------------------------------------------------------

--
-- Table structure for table `pay_references`
--

CREATE TABLE `pay_references` (
  `id` int(10) UNSIGNED NOT NULL,
  `pay_reference_name` varchar(255) NOT NULL,
  `branch_id` bigint(20) UNSIGNED NOT NULL,
  `payroll_number` varchar(255) NOT NULL,
  `pay_period_start_date` date NOT NULL,
  `pay_period_end_date` date NOT NULL,
  `payref_status` int(11) NOT NULL DEFAULT 1 COMMENT '1 = new, 2 = progress, 3 = complete, 4 = cancel',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reference_department_rels`
--

CREATE TABLE `pay_reference_department_rels` (
  `id` int(10) UNSIGNED NOT NULL,
  `pay_reference_id` int(10) UNSIGNED NOT NULL,
  `pay_reference_department_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reference_empl_relations`
--

CREATE TABLE `pay_reference_empl_relations` (
  `id` int(10) UNSIGNED NOT NULL,
  `pay_reference_id` int(11) DEFAULT NULL,
  `emp_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reference_emp_superannuation_rels`
--

CREATE TABLE `pay_reference_emp_superannuation_rels` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `payref_id` bigint(20) UNSIGNED NOT NULL,
  `emp_id` bigint(20) UNSIGNED NOT NULL,
  `superannuation_id` bigint(20) UNSIGNED NOT NULL,
  `employer_contribution_percentage` decimal(5,2) DEFAULT NULL,
  `employee_contribution_percentage` decimal(5,2) DEFAULT NULL,
  `employer_contribution_amount` decimal(10,2) DEFAULT NULL,
  `employee_contribution_amount` decimal(10,2) DEFAULT NULL,
  `contribution_paid_on` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reference_payitems`
--

CREATE TABLE `pay_reference_payitems` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pay_reference_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pay_item_id` bigint(20) UNSIGNED DEFAULT NULL,
  `empid` int(11) DEFAULT NULL,
  `payitem_unit` int(11) NOT NULL,
  `payitem_amount` decimal(10,2) NOT NULL,
  `paid_on` date DEFAULT NULL,
  `payitem_summary` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reference_pay_location_rels`
--

CREATE TABLE `pay_reference_pay_location_rels` (
  `id` int(10) UNSIGNED NOT NULL,
  `pay_reference_id` int(10) UNSIGNED NOT NULL,
  `pay_reference_pay_location_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reference_pay_slips`
--

CREATE TABLE `pay_reference_pay_slips` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pay_ref_id` int(11) DEFAULT NULL,
  `employee_id` varchar(255) DEFAULT NULL,
  `hourly_rate` varchar(255) DEFAULT NULL,
  `total_working_hours` varchar(255) DEFAULT NULL,
  `total_working_days` varchar(255) DEFAULT NULL,
  `late_count` varchar(255) DEFAULT NULL,
  `late_deduction` varchar(255) DEFAULT NULL,
  `sandwich_leave_count` varchar(255) DEFAULT NULL,
  `sandwich_leave_deduction` varchar(255) DEFAULT NULL,
  `loss_of_pay_days` varchar(255) DEFAULT NULL,
  `loss_of_pay_amount` varchar(255) DEFAULT NULL,
  `house_rent_allowance` int(11) DEFAULT 0,
  `medical_allowance` int(11) DEFAULT 0,
  `special_allowance` int(11) DEFAULT 0,
  `other_allowance` int(11) DEFAULT 0,
  `electricity_allowance` int(11) DEFAULT 0,
  `security_allowance` int(11) DEFAULT 0,
  `totalVehicleAllowance` decimal(10,2) DEFAULT NULL,
  `tax_deduction_a` int(11) DEFAULT 0,
  `hra_type` int(11) DEFAULT 0,
  `va_type` int(11) DEFAULT 0,
  `vehicle_allowance` int(11) DEFAULT 0,
  `meal_tag` int(11) DEFAULT 0,
  `meals_allowance` int(11) DEFAULT 0,
  `total_benefits_payable` bigint(20) UNSIGNED DEFAULT 0,
  `total_taxable_deduct_wdays` bigint(20) UNSIGNED DEFAULT 0,
  `loan_deduction_installment` decimal(8,2) DEFAULT NULL,
  `payItems` longtext DEFAULT NULL,
  `dependents` int(11) DEFAULT NULL,
  `dependent_rebate` int(11) DEFAULT NULL,
  `superannuation_id` int(10) DEFAULT NULL,
  `superannuation_name` varchar(255) DEFAULT NULL,
  `super_employer_amount` decimal(10,2) DEFAULT NULL,
  `super_employee_amount` decimal(10,2) DEFAULT NULL,
  `total_payable_amount` varchar(255) DEFAULT NULL,
  `payref_finalStatus` tinyint(4) DEFAULT 0 COMMENT '0=pending, 1=approved',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reference_update_leaves`
--

CREATE TABLE `pay_reference_update_leaves` (
  `id` int(10) UNSIGNED NOT NULL,
  `pay_reference_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `total_loss_of_pay_days` int(11) DEFAULT NULL,
  `total_sandwich_leave` int(11) DEFAULT NULL,
  `total_sandwich_leave_days` int(11) DEFAULT NULL,
  `total_holiday_count` int(11) DEFAULT NULL,
  `total_leave_applied_days` int(11) DEFAULT NULL,
  `total_pending_leave` int(11) DEFAULT NULL,
  `total_leave_cancel_days` int(11) DEFAULT NULL,
  `total_leave_disapprove_days` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pay_reference_update_loans`
--

CREATE TABLE `pay_reference_update_loans` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `pay_reference_id` bigint(20) UNSIGNED NOT NULL,
  `loan_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `loan_name` varchar(255) NOT NULL,
  `loan_master_id` bigint(20) UNSIGNED NOT NULL,
  `loan_date` date NOT NULL,
  `deduction_start_date` date NOT NULL,
  `deduction_amount` decimal(10,2) NOT NULL,
  `outstanding_amount` decimal(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `period_defination_rates`
--

CREATE TABLE `period_defination_rates` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(100) NOT NULL,
  `name` varchar(255) NOT NULL,
  `pay_unit` varchar(255) NOT NULL,
  `pays_per_year` decimal(8,2) DEFAULT NULL,
  `hours_per_day` decimal(8,2) DEFAULT NULL,
  `hours_per_pay` decimal(8,2) DEFAULT NULL,
  `days_per_pay` decimal(8,2) DEFAULT NULL,
  `rate_per_pay_unit_hours` decimal(8,2) DEFAULT NULL,
  `overtime_rate_one` decimal(8,2) DEFAULT NULL,
  `overtime_rate_two` decimal(8,2) DEFAULT NULL,
  `special_rate_one` decimal(8,2) DEFAULT NULL,
  `special_rate_two` decimal(8,2) DEFAULT NULL,
  `annual_leave_flag` enum('0','1') DEFAULT '0' COMMENT '0: False, 1: True',
  `casual_leave_flag` enum('0','1') DEFAULT '0' COMMENT '0: False, 1: True',
  `sick_leave_flag` enum('0','1') DEFAULT '0' COMMENT '0: False, 1: True',
  `accurate_type` varchar(255) DEFAULT NULL,
  `compensate_leave` decimal(8,2) DEFAULT NULL,
  `salary_days_count` int(11) DEFAULT NULL,
  `status` enum('0','1') DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `period_defination_rates`
--

INSERT INTO `period_defination_rates` (`id`, `code`, `name`, `pay_unit`, `pays_per_year`, `hours_per_day`, `hours_per_pay`, `days_per_pay`, `rate_per_pay_unit_hours`, `overtime_rate_one`, `overtime_rate_two`, `special_rate_one`, `special_rate_two`, `annual_leave_flag`, `casual_leave_flag`, `sick_leave_flag`, `accurate_type`, `compensate_leave`, `salary_days_count`, `status`, `created_at`, `updated_at`) VALUES
(1, 'FN84', 'Fortnightly 84 Hours', 'hour', 26.00, 8.00, 84.00, 10.50, NULL, NULL, NULL, NULL, NULL, '1', '1', '1', 'based_on_last_pay_date', NULL, 14, '1', '2024-08-28 16:22:28', '2024-11-21 22:20:29');

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
(29, 'leave-reports', 'Leave Reports', 'Leave Reports', NULL, NULL),
(30, 'manage-bankdetails', 'Bank Details', 'Bank Details', '2024-06-18 05:45:53', '2024-06-18 05:45:53');

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
(29, 1),
(30, 1);

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
(4, 2);

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
-- Table structure for table `superannuations`
--

CREATE TABLE `superannuations` (
  `id` int(10) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `employer_contribution_percentage` decimal(5,2) DEFAULT NULL,
  `employer_contribution_fixed_amount` decimal(15,2) DEFAULT NULL,
  `tax_method_for_employee_contribution` varchar(255) DEFAULT NULL,
  `included_bank_transfer` tinyint(1) NOT NULL DEFAULT 0,
  `bank_account_number` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `employer_name` varchar(255) DEFAULT NULL,
  `employer_superannuation_no` varchar(255) DEFAULT NULL,
  `registration_date` date DEFAULT NULL,
  `employee_contrib_percent` decimal(10,2) DEFAULT NULL,
  `employee_contrib_amount` decimal(15,2) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `superannuations`
--

INSERT INTO `superannuations` (`id`, `code`, `name`, `employer_contribution_percentage`, `employer_contribution_fixed_amount`, `tax_method_for_employee_contribution`, `included_bank_transfer`, `bank_account_number`, `account_name`, `bank_name`, `employer_name`, `employer_superannuation_no`, `registration_date`, `employee_contrib_percent`, `employee_contrib_amount`, `status`, `created_at`, `updated_at`) VALUES
(1, 'NPF', 'NATIONAL SUPERANNUATION FUND', 8.40, 0.00, 'post-tax', 0, NULL, NULL, '1', NULL, NULL, NULL, 6.50, 0.00, 1, '2024-08-28 11:59:48', '2025-07-01 14:07:19'),
(2, 'NPFH', 'NASFUND HOUSING', 0.00, 0.00, 'post-tax', 0, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-28 12:02:09', '2024-08-28 12:02:09'),
(3, 'NSL', 'NAMBAWAN SUPERANUATION FUND', 8.40, 1.00, 'post-tax', 0, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-28 12:03:25', '2024-08-28 13:27:48'),
(4, 'NSLH', 'Nambawan Super Limited Housing', 0.00, 0.00, 'pre-tax', 0, NULL, NULL, '1', NULL, NULL, NULL, NULL, NULL, 1, '2024-08-28 12:04:15', '2024-08-28 12:04:15');

-- --------------------------------------------------------

--
-- Table structure for table `tax_rates`
--

CREATE TABLE `tax_rates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `salary_min` decimal(10,2) NOT NULL,
  `salary_max` decimal(10,2) NOT NULL,
  `non_resident_taxrate` decimal(10,2) DEFAULT NULL,
  `no_declaration_taxrate` decimal(10,2) DEFAULT NULL,
  `tax_none` decimal(10,2) NOT NULL,
  `tax_one` decimal(10,2) NOT NULL,
  `tax_two` decimal(10,2) NOT NULL,
  `tax_three_or_more` decimal(10,2) NOT NULL,
  `table_type` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tax_rates`
--

INSERT INTO `tax_rates` (`id`, `salary_min`, `salary_max`, `non_resident_taxrate`, `no_declaration_taxrate`, `tax_none`, `tax_one`, `tax_two`, `tax_three_or_more`, `table_type`, `created_at`, `updated_at`) VALUES
(1, 0.00, 1.00, 0.22, 0.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(2, 1.00, 3.00, 0.66, 1.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(3, 3.00, 5.00, 1.10, 2.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(4, 5.00, 7.00, 1.54, 2.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(5, 7.00, 9.00, 1.98, 3.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(6, 9.00, 11.00, 2.42, 4.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(7, 11.00, 13.00, 2.86, 5.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(8, 13.00, 15.00, 3.30, 6.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(9, 15.00, 17.00, 3.74, 7.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(10, 17.00, 19.00, 4.18, 7.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(11, 19.00, 21.00, 4.62, 8.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(12, 21.00, 23.00, 5.06, 9.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(13, 23.00, 25.00, 5.50, 10.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(14, 25.00, 27.00, 5.94, 11.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(15, 27.00, 29.00, 6.38, 12.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(16, 29.00, 31.00, 6.82, 13.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(17, 31.00, 33.00, 7.26, 13.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(18, 33.00, 35.00, 7.70, 14.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(19, 35.00, 37.00, 8.14, 15.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(20, 37.00, 39.00, 8.58, 16.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(21, 39.00, 41.00, 9.02, 17.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(22, 41.00, 43.00, 9.46, 18.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(23, 43.00, 45.00, 9.90, 18.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(24, 45.00, 47.00, 10.34, 19.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(25, 47.00, 49.00, 10.78, 20.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(26, 49.00, 51.00, 11.22, 21.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(27, 51.00, 53.00, 11.66, 22.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(28, 53.00, 55.00, 12.10, 23.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(29, 55.00, 57.00, 12.54, 23.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(30, 57.00, 59.00, 12.98, 24.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(31, 59.00, 61.00, 13.42, 25.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(32, 61.00, 63.00, 13.86, 26.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(33, 63.00, 65.00, 14.30, 27.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(34, 65.00, 67.00, 14.74, 28.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(35, 67.00, 69.00, 15.18, 28.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(36, 69.00, 71.00, 15.62, 29.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(37, 71.00, 73.00, 16.06, 30.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(38, 73.00, 75.00, 16.50, 31.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(39, 75.00, 77.00, 16.94, 32.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(40, 77.00, 79.00, 17.38, 33.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(41, 79.00, 81.00, 17.82, 34.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(42, 81.00, 83.00, 18.26, 34.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(43, 83.00, 85.00, 18.70, 35.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(44, 85.00, 87.00, 19.14, 36.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(45, 87.00, 89.00, 19.58, 37.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(46, 89.00, 91.00, 20.02, 38.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(47, 91.00, 93.00, 20.46, 39.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(48, 93.00, 95.00, 20.90, 39.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(49, 95.00, 97.00, 21.34, 40.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(50, 97.00, 99.00, 21.78, 41.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(51, 99.00, 101.00, 22.22, 42.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(52, 101.00, 103.00, 22.66, 43.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(53, 103.00, 105.00, 23.10, 44.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(54, 105.00, 107.00, 23.54, 44.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(55, 107.00, 109.00, 23.98, 45.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(56, 109.00, 111.00, 24.42, 46.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(57, 111.00, 113.00, 24.86, 47.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(58, 113.00, 115.00, 25.30, 48.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(59, 115.00, 117.00, 25.74, 49.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(60, 117.00, 119.00, 26.18, 49.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(61, 119.00, 121.00, 26.62, 50.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(62, 121.00, 123.00, 27.06, 51.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(63, 123.00, 125.00, 27.50, 52.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(64, 125.00, 127.00, 27.94, 53.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(65, 127.00, 129.00, 28.38, 54.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(66, 129.00, 131.00, 28.82, 55.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(67, 131.00, 133.00, 29.26, 55.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(68, 133.00, 135.00, 29.70, 56.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(69, 135.00, 137.00, 30.14, 57.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(70, 137.00, 139.00, 30.58, 58.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(71, 139.00, 141.00, 31.02, 59.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(72, 141.00, 143.00, 31.46, 60.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(73, 143.00, 145.00, 31.90, 60.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(74, 145.00, 147.00, 32.34, 61.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(75, 147.00, 149.00, 32.78, 62.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(76, 149.00, 151.00, 33.22, 63.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(77, 151.00, 153.00, 33.66, 64.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(78, 153.00, 155.00, 34.10, 65.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(79, 155.00, 157.00, 34.54, 65.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(80, 157.00, 159.00, 34.98, 66.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(81, 159.00, 161.00, 35.42, 67.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(82, 161.00, 163.00, 35.86, 68.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(83, 163.00, 165.00, 36.30, 69.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(84, 165.00, 167.00, 36.74, 70.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(85, 167.00, 169.00, 37.18, 70.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(86, 169.00, 171.00, 37.62, 71.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(87, 171.00, 173.00, 38.06, 72.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(88, 173.00, 175.00, 38.50, 73.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(89, 175.00, 177.00, 38.94, 74.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(90, 177.00, 179.00, 39.38, 75.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(91, 179.00, 181.00, 39.82, 76.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(92, 181.00, 183.00, 40.26, 76.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(93, 183.00, 185.00, 40.70, 77.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(94, 185.00, 187.00, 41.14, 78.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(95, 187.00, 189.00, 41.58, 79.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(96, 189.00, 191.00, 42.02, 80.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(97, 191.00, 193.00, 42.46, 81.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(98, 193.00, 195.00, 42.90, 81.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(99, 195.00, 197.00, 43.34, 82.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(100, 197.00, 199.00, 43.78, 83.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(101, 199.00, 201.00, 44.22, 84.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(102, 201.00, 203.00, 44.66, 85.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(103, 203.00, 205.00, 45.10, 86.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(104, 205.00, 207.00, 45.54, 86.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(105, 207.00, 209.00, 45.98, 87.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(106, 209.00, 211.00, 46.42, 88.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(107, 211.00, 213.00, 46.86, 89.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(108, 213.00, 215.00, 47.30, 90.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(109, 215.00, 217.00, 47.74, 91.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(110, 217.00, 219.00, 48.18, 91.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(111, 219.00, 221.00, 48.62, 92.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(112, 221.00, 223.00, 49.06, 93.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(113, 223.00, 225.00, 49.50, 94.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(114, 225.00, 227.00, 49.94, 95.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(115, 227.00, 229.00, 50.38, 96.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(116, 229.00, 231.00, 50.82, 97.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(117, 231.00, 233.00, 51.26, 97.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(118, 233.00, 235.00, 51.70, 98.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(119, 235.00, 237.00, 52.14, 99.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(120, 237.00, 239.00, 52.58, 100.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(121, 239.00, 241.00, 53.02, 101.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(122, 241.00, 243.00, 53.46, 102.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(123, 243.00, 245.00, 53.90, 102.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(124, 245.00, 247.00, 54.34, 103.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(125, 247.00, 249.00, 54.78, 104.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(126, 249.00, 251.00, 55.22, 105.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(127, 251.00, 253.00, 55.66, 106.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(128, 253.00, 255.00, 56.10, 107.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(129, 255.00, 257.00, 56.54, 107.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(130, 257.00, 259.00, 56.98, 108.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(131, 259.00, 261.00, 57.42, 109.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(132, 261.00, 263.00, 57.86, 110.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(133, 263.00, 265.00, 58.30, 111.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(134, 265.00, 267.00, 58.74, 112.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(135, 267.00, 269.00, 59.18, 112.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(136, 269.00, 271.00, 59.62, 113.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(137, 271.00, 273.00, 60.06, 114.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(138, 273.00, 275.00, 60.50, 115.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(139, 275.00, 277.00, 60.94, 116.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(140, 277.00, 279.00, 61.38, 117.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(141, 279.00, 281.00, 61.82, 118.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(142, 281.00, 283.00, 62.26, 118.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(143, 283.00, 285.00, 62.70, 119.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(144, 285.00, 287.00, 63.14, 120.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(145, 287.00, 289.00, 63.58, 121.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(146, 289.00, 291.00, 64.02, 122.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(147, 291.00, 293.00, 64.46, 123.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(148, 293.00, 295.00, 64.90, 123.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(149, 295.00, 297.00, 65.34, 124.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(150, 297.00, 299.00, 65.78, 125.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(151, 299.00, 301.00, 66.22, 126.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(152, 301.00, 303.00, 66.66, 127.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(153, 303.00, 305.00, 67.10, 128.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(154, 305.00, 307.00, 67.54, 128.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(155, 307.00, 309.00, 67.98, 129.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(156, 309.00, 311.00, 68.42, 130.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(157, 311.00, 313.00, 68.86, 131.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(158, 313.00, 315.00, 69.30, 132.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(159, 315.00, 317.00, 69.74, 133.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(160, 317.00, 319.00, 70.18, 133.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(161, 319.00, 321.00, 70.62, 134.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(162, 321.00, 323.00, 71.06, 135.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(163, 323.00, 325.00, 71.50, 136.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(164, 325.00, 327.00, 71.94, 137.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(165, 327.00, 329.00, 72.38, 138.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(166, 329.00, 331.00, 72.82, 139.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(167, 331.00, 333.00, 73.26, 139.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(168, 333.00, 335.00, 73.70, 140.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(169, 335.00, 337.00, 74.14, 141.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(170, 337.00, 339.00, 74.58, 142.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(171, 339.00, 341.00, 75.02, 143.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(172, 341.00, 343.00, 75.46, 144.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(173, 343.00, 345.00, 75.90, 144.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(174, 345.00, 347.00, 76.34, 145.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(175, 347.00, 349.00, 76.78, 146.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(176, 349.00, 351.00, 77.22, 147.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(177, 351.00, 353.00, 77.66, 148.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(178, 353.00, 355.00, 78.10, 149.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(179, 355.00, 357.00, 78.54, 149.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(180, 357.00, 359.00, 78.98, 150.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(181, 359.00, 361.00, 79.42, 151.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(182, 361.00, 363.00, 79.86, 152.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(183, 363.00, 365.00, 80.30, 153.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(184, 365.00, 367.00, 80.74, 154.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(185, 367.00, 369.00, 81.18, 154.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(186, 369.00, 371.00, 81.62, 155.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(187, 371.00, 373.00, 82.06, 156.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(188, 373.00, 375.00, 82.50, 157.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(189, 375.00, 377.00, 82.94, 158.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(190, 377.00, 379.00, 83.38, 159.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(191, 379.00, 381.00, 83.82, 160.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(192, 381.00, 383.00, 84.26, 160.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(193, 383.00, 385.00, 84.70, 161.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(194, 385.00, 387.00, 85.14, 162.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(195, 387.00, 389.00, 85.58, 163.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(196, 389.00, 391.00, 86.02, 164.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(197, 391.00, 393.00, 86.46, 165.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(198, 393.00, 395.00, 86.90, 165.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(199, 395.00, 397.00, 87.34, 166.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(200, 397.00, 399.00, 87.78, 167.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(201, 399.00, 401.00, 88.22, 168.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(202, 401.00, 403.00, 88.66, 169.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(203, 403.00, 405.00, 89.10, 170.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(204, 405.00, 407.00, 89.54, 170.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(205, 407.00, 409.00, 89.98, 171.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(206, 409.00, 411.00, 90.42, 172.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(207, 411.00, 413.00, 90.86, 173.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(208, 413.00, 415.00, 91.30, 174.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(209, 415.00, 417.00, 91.74, 175.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(210, 417.00, 419.00, 92.18, 175.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(211, 419.00, 421.00, 92.62, 176.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(212, 421.00, 423.00, 93.06, 177.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(213, 423.00, 425.00, 93.50, 178.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(214, 425.00, 427.00, 93.94, 179.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(215, 427.00, 429.00, 94.38, 180.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(216, 429.00, 431.00, 94.82, 181.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(217, 431.00, 433.00, 95.26, 181.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(218, 433.00, 435.00, 95.70, 182.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(219, 435.00, 437.00, 96.14, 183.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(220, 437.00, 439.00, 96.58, 184.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(221, 439.00, 441.00, 97.02, 185.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(222, 441.00, 443.00, 97.46, 186.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(223, 443.00, 445.00, 97.90, 186.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(224, 445.00, 447.00, 98.34, 187.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(225, 447.00, 449.00, 98.78, 188.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(226, 449.00, 451.00, 99.22, 189.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(227, 451.00, 453.00, 99.66, 190.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(228, 453.00, 455.00, 100.10, 191.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(229, 455.00, 457.00, 100.54, 191.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(230, 457.00, 459.00, 100.98, 192.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(231, 459.00, 461.00, 101.42, 193.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(232, 461.00, 463.00, 101.86, 194.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(233, 463.00, 465.00, 102.30, 195.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(234, 465.00, 467.00, 102.74, 196.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(235, 467.00, 469.00, 103.18, 196.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(236, 469.00, 471.00, 103.62, 197.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(237, 471.00, 473.00, 104.06, 198.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(238, 473.00, 475.00, 104.50, 199.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(239, 475.00, 477.00, 104.94, 200.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(240, 477.00, 479.00, 105.38, 201.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(241, 479.00, 481.00, 105.82, 202.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(242, 481.00, 483.00, 106.26, 202.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(243, 483.00, 485.00, 106.70, 203.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(244, 485.00, 487.00, 107.14, 204.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(245, 487.00, 489.00, 107.58, 205.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(246, 489.00, 491.00, 108.02, 206.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(247, 491.00, 493.00, 108.46, 207.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(248, 493.00, 495.00, 108.90, 207.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(249, 495.00, 497.00, 109.34, 208.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(250, 497.00, 499.00, 109.78, 209.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(251, 499.00, 501.00, 110.22, 210.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(252, 501.00, 503.00, 110.66, 211.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(253, 503.00, 505.00, 111.10, 212.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(254, 505.00, 507.00, 111.54, 212.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(255, 507.00, 509.00, 111.98, 213.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(256, 509.00, 511.00, 112.42, 214.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(257, 511.00, 513.00, 112.86, 215.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(258, 513.00, 515.00, 113.30, 216.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(259, 515.00, 517.00, 113.74, 217.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(260, 517.00, 519.00, 114.18, 217.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(261, 519.00, 521.00, 114.62, 218.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(262, 521.00, 523.00, 115.06, 219.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(263, 523.00, 525.00, 115.50, 220.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(264, 525.00, 527.00, 115.94, 221.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(265, 527.00, 529.00, 116.38, 222.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(266, 529.00, 531.00, 116.82, 223.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(267, 531.00, 533.00, 117.26, 223.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(268, 533.00, 535.00, 117.70, 224.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(269, 535.00, 537.00, 118.14, 225.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(270, 537.00, 539.00, 118.58, 226.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(271, 539.00, 541.00, 119.02, 227.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(272, 541.00, 543.00, 119.46, 228.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(273, 543.00, 545.00, 119.90, 228.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(274, 545.00, 547.00, 120.34, 229.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(275, 547.00, 549.00, 120.78, 230.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(276, 549.00, 551.00, 121.22, 231.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(277, 551.00, 553.00, 121.66, 232.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(278, 553.00, 555.00, 122.10, 233.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(279, 555.00, 557.00, 122.54, 233.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(280, 557.00, 559.00, 122.98, 234.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(281, 559.00, 561.00, 123.42, 235.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(282, 561.00, 563.00, 123.86, 236.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(283, 563.00, 565.00, 124.30, 237.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(284, 565.00, 567.00, 124.74, 238.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(285, 567.00, 569.00, 125.18, 238.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(286, 569.00, 571.00, 125.62, 239.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(287, 571.00, 573.00, 126.06, 240.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(288, 573.00, 575.00, 126.50, 241.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(289, 575.00, 577.00, 126.94, 242.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(290, 577.00, 579.00, 127.38, 243.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(291, 579.00, 581.00, 127.82, 244.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(292, 581.00, 583.00, 128.26, 244.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(293, 583.00, 585.00, 128.70, 245.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(294, 585.00, 587.00, 129.14, 246.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(295, 587.00, 589.00, 129.58, 247.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(296, 589.00, 591.00, 130.02, 248.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(297, 591.00, 593.00, 130.46, 249.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(298, 593.00, 595.00, 130.90, 249.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(299, 595.00, 597.00, 131.34, 250.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(300, 597.00, 599.00, 131.78, 251.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(301, 599.00, 601.00, 132.22, 252.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(302, 601.00, 603.00, 132.66, 253.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(303, 603.00, 605.00, 133.10, 254.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(304, 605.00, 607.00, 133.54, 254.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(305, 607.00, 609.00, 133.98, 255.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(306, 609.00, 611.00, 134.42, 256.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(307, 611.00, 613.00, 134.86, 257.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(308, 613.00, 615.00, 135.30, 258.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(309, 615.00, 617.00, 135.74, 259.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(310, 617.00, 619.00, 136.18, 259.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(311, 619.00, 621.00, 136.62, 260.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(312, 621.00, 623.00, 137.06, 261.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(313, 623.00, 625.00, 137.50, 262.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(314, 625.00, 627.00, 137.94, 263.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(315, 627.00, 629.00, 138.38, 264.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(316, 629.00, 631.00, 138.82, 265.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(317, 631.00, 633.00, 139.26, 265.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(318, 633.00, 635.00, 139.70, 266.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(319, 635.00, 637.00, 140.14, 267.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(320, 637.00, 639.00, 140.58, 268.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(321, 639.00, 641.00, 141.02, 269.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(322, 641.00, 643.00, 141.46, 270.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(323, 643.00, 645.00, 141.90, 270.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(324, 645.00, 647.00, 142.34, 271.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(325, 647.00, 649.00, 142.78, 272.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(326, 649.00, 651.00, 143.22, 273.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(327, 651.00, 653.00, 143.66, 274.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(328, 653.00, 655.00, 144.10, 275.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(329, 655.00, 657.00, 144.54, 275.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(330, 657.00, 659.00, 144.98, 276.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(331, 659.00, 661.00, 145.42, 277.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(332, 661.00, 663.00, 145.86, 278.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(333, 663.00, 665.00, 146.30, 279.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(334, 665.00, 667.00, 146.74, 280.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(335, 667.00, 669.00, 147.18, 280.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(336, 669.00, 671.00, 147.62, 281.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(337, 671.00, 673.00, 148.06, 282.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(338, 673.00, 675.00, 148.50, 283.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(339, 675.00, 677.00, 148.94, 284.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(340, 677.00, 679.00, 149.38, 285.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(341, 679.00, 681.00, 149.82, 286.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(342, 681.00, 683.00, 150.26, 286.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(343, 683.00, 685.00, 150.70, 287.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(344, 685.00, 687.00, 151.14, 288.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(345, 687.00, 689.00, 151.58, 289.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(346, 689.00, 691.00, 152.02, 290.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(347, 691.00, 693.00, 152.46, 291.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(348, 693.00, 695.00, 152.90, 291.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(349, 695.00, 697.00, 153.34, 292.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(350, 697.00, 699.00, 153.78, 293.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(351, 699.00, 701.00, 154.22, 294.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(352, 701.00, 703.00, 154.66, 295.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(353, 703.00, 705.00, 155.10, 296.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(354, 705.00, 707.00, 155.54, 296.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(355, 707.00, 709.00, 155.98, 297.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(356, 709.00, 711.00, 156.42, 298.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(357, 711.00, 713.00, 156.86, 299.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(358, 713.00, 715.00, 157.30, 300.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(359, 715.00, 717.00, 157.74, 301.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(360, 717.00, 719.00, 158.18, 301.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(361, 719.00, 721.00, 158.62, 302.82, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(362, 721.00, 723.00, 159.06, 303.66, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(363, 723.00, 725.00, 159.50, 304.50, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(364, 725.00, 727.00, 159.94, 305.34, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(365, 727.00, 729.00, 160.38, 306.18, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(366, 729.00, 731.00, 160.82, 307.02, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(367, 731.00, 733.00, 161.26, 307.86, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(368, 733.00, 735.00, 161.70, 308.70, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(369, 735.00, 737.00, 162.14, 309.54, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(370, 737.00, 739.00, 162.58, 310.38, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(371, 739.00, 741.00, 163.02, 311.22, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(372, 741.00, 743.00, 163.46, 312.06, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(373, 743.00, 745.00, 163.90, 312.90, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(374, 745.00, 747.00, 164.34, 313.74, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(375, 747.00, 749.00, 164.78, 314.58, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(376, 749.00, 751.00, 165.22, 315.42, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(377, 751.00, 753.00, 165.66, 316.26, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(378, 753.00, 755.00, 166.10, 317.10, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(379, 755.00, 757.00, 166.54, 317.94, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(380, 757.00, 759.00, 166.98, 318.78, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(381, 759.00, 761.00, 167.42, 319.62, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(382, 761.00, 763.00, 167.86, 320.46, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(383, 763.00, 765.00, 168.30, 321.30, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(384, 765.00, 767.00, 168.74, 322.14, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(385, 767.00, 769.00, 169.18, 322.98, 0.00, 0.00, 0.00, 0.00, 'A', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(386, 769.00, 771.00, 169.83, 323.82, 1.00, 1.00, 1.00, 1.00, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(387, 771.00, 773.00, 170.43, 324.66, 1.20, 1.08, 1.02, 1.00, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(388, 773.00, 775.00, 171.03, 325.50, 1.80, 1.62, 1.53, 1.17, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(389, 775.00, 777.00, 171.63, 326.34, 2.40, 2.16, 2.04, 1.56, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(390, 777.00, 779.00, 172.23, 327.18, 3.00, 2.70, 2.55, 1.95, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(391, 779.00, 781.00, 172.83, 328.02, 3.60, 3.24, 3.06, 2.34, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(392, 781.00, 783.00, 173.43, 328.86, 4.20, 3.78, 3.57, 2.73, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(393, 783.00, 785.00, 174.03, 329.70, 4.80, 4.32, 4.08, 3.12, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(394, 785.00, 787.00, 174.63, 330.54, 5.40, 4.86, 4.59, 3.51, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(395, 787.00, 789.00, 175.23, 331.38, 6.00, 5.40, 5.10, 3.90, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(396, 789.00, 791.00, 175.83, 332.22, 6.60, 5.94, 5.61, 4.29, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(397, 791.00, 793.00, 176.43, 333.06, 7.20, 6.48, 6.12, 4.68, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(398, 793.00, 795.00, 177.03, 333.90, 7.80, 7.02, 6.63, 5.07, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(399, 795.00, 797.00, 177.63, 334.74, 8.40, 7.56, 7.14, 5.46, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(400, 797.00, 799.00, 178.23, 335.58, 9.00, 8.10, 7.65, 5.85, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(401, 799.00, 801.00, 178.83, 336.42, 9.60, 8.64, 8.16, 6.24, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(402, 801.00, 803.00, 179.43, 337.26, 10.20, 9.18, 8.67, 6.63, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(403, 803.00, 805.00, 180.03, 338.10, 10.80, 9.72, 9.18, 7.02, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(404, 805.00, 807.00, 180.63, 338.94, 11.40, 10.26, 9.69, 7.41, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(405, 807.00, 809.00, 181.23, 339.78, 12.00, 10.80, 10.20, 7.80, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(406, 809.00, 811.00, 181.83, 340.62, 12.60, 11.34, 10.71, 8.19, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(407, 811.00, 813.00, 182.43, 341.46, 13.20, 11.88, 11.22, 8.58, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(408, 813.00, 815.00, 183.03, 342.30, 13.80, 12.42, 11.73, 8.97, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(409, 815.00, 817.00, 183.63, 343.14, 14.40, 12.96, 12.24, 9.36, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(410, 817.00, 819.00, 184.23, 343.98, 15.00, 13.50, 12.75, 9.75, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(411, 819.00, 821.00, 184.83, 344.82, 15.60, 14.04, 13.26, 10.14, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(412, 821.00, 823.00, 185.43, 345.66, 16.20, 14.58, 13.77, 10.53, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(413, 823.00, 825.00, 186.03, 346.50, 16.80, 15.12, 14.28, 10.92, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(414, 825.00, 827.00, 186.63, 347.34, 17.40, 15.66, 14.79, 11.31, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(415, 827.00, 829.00, 187.23, 348.18, 18.00, 16.20, 15.30, 11.70, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(416, 829.00, 831.00, 187.83, 349.02, 18.60, 16.74, 15.81, 12.09, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(417, 831.00, 833.00, 188.43, 349.86, 19.20, 17.28, 16.32, 12.48, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(418, 833.00, 835.00, 189.03, 350.70, 19.80, 17.82, 16.83, 12.87, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(419, 835.00, 837.00, 189.63, 351.54, 20.40, 18.36, 17.34, 13.26, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(420, 837.00, 839.00, 190.23, 352.38, 21.00, 18.90, 17.85, 13.65, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(421, 839.00, 841.00, 190.83, 353.22, 21.60, 19.44, 18.36, 14.04, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(422, 841.00, 843.00, 191.43, 354.06, 22.20, 19.98, 18.87, 14.43, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(423, 843.00, 845.00, 192.03, 354.90, 22.80, 20.52, 19.38, 14.82, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(424, 845.00, 847.00, 192.63, 355.74, 23.40, 21.06, 19.89, 15.21, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(425, 847.00, 849.00, 193.23, 356.58, 24.00, 21.60, 20.40, 15.60, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(426, 849.00, 851.00, 193.83, 357.42, 24.60, 22.14, 20.91, 15.99, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(427, 851.00, 853.00, 194.43, 358.26, 25.20, 22.68, 21.42, 16.38, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(428, 853.00, 855.00, 195.03, 359.10, 25.80, 23.22, 21.93, 16.77, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(429, 855.00, 857.00, 195.63, 359.94, 26.40, 23.76, 22.44, 17.16, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(430, 857.00, 859.00, 196.23, 360.78, 27.00, 24.30, 22.95, 17.55, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(431, 859.00, 861.00, 196.83, 361.62, 27.60, 24.84, 23.46, 17.94, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(432, 861.00, 863.00, 197.43, 362.46, 28.20, 25.38, 23.97, 18.33, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(433, 863.00, 865.00, 198.03, 363.30, 28.80, 25.92, 24.48, 18.72, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(434, 865.00, 867.00, 198.63, 364.14, 29.40, 26.46, 24.99, 19.11, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(435, 867.00, 869.00, 199.23, 364.98, 30.00, 27.00, 25.50, 19.50, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(436, 869.00, 871.00, 199.83, 365.82, 30.60, 27.54, 26.01, 19.89, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(437, 871.00, 873.00, 200.43, 366.66, 31.20, 28.08, 26.52, 20.28, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(438, 873.00, 875.00, 201.03, 367.50, 31.80, 28.62, 27.03, 20.67, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(439, 875.00, 877.00, 201.63, 368.34, 32.40, 29.16, 27.54, 21.06, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(440, 877.00, 879.00, 202.23, 369.18, 33.00, 29.70, 28.05, 21.45, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(441, 879.00, 881.00, 202.83, 370.02, 33.60, 30.24, 28.56, 21.84, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(442, 881.00, 883.00, 203.43, 370.86, 34.20, 30.78, 29.07, 22.23, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(443, 883.00, 885.00, 204.03, 371.70, 34.80, 31.32, 29.58, 22.62, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(444, 885.00, 887.00, 204.63, 372.54, 35.40, 31.86, 30.09, 23.01, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(445, 887.00, 889.00, 205.23, 373.38, 36.00, 32.40, 30.60, 23.40, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(446, 889.00, 891.00, 205.83, 374.22, 36.60, 32.94, 31.11, 23.79, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(447, 891.00, 893.00, 206.43, 375.06, 37.20, 33.48, 31.62, 24.18, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(448, 893.00, 895.00, 207.03, 375.90, 37.80, 34.02, 32.13, 24.57, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06');
INSERT INTO `tax_rates` (`id`, `salary_min`, `salary_max`, `non_resident_taxrate`, `no_declaration_taxrate`, `tax_none`, `tax_one`, `tax_two`, `tax_three_or_more`, `table_type`, `created_at`, `updated_at`) VALUES
(449, 895.00, 897.00, 207.63, 376.74, 38.40, 34.56, 32.64, 24.96, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(450, 897.00, 899.00, 208.23, 377.58, 39.00, 35.10, 33.15, 25.35, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(451, 899.00, 901.00, 208.83, 378.42, 39.60, 35.64, 33.66, 25.74, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(452, 901.00, 903.00, 209.43, 379.26, 40.20, 36.18, 34.17, 26.13, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(453, 903.00, 905.00, 210.03, 380.10, 40.80, 36.72, 34.68, 26.52, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(454, 905.00, 907.00, 210.63, 380.94, 41.40, 37.26, 35.19, 26.91, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(455, 907.00, 909.00, 211.23, 381.78, 42.00, 37.80, 35.70, 27.30, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(456, 909.00, 911.00, 211.83, 382.62, 42.60, 38.34, 36.21, 27.69, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(457, 911.00, 913.00, 212.43, 383.46, 43.20, 38.88, 36.72, 28.08, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(458, 913.00, 915.00, 213.03, 384.30, 43.80, 39.42, 37.23, 28.47, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(459, 915.00, 917.00, 213.63, 385.14, 44.40, 39.96, 37.74, 28.86, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(460, 917.00, 919.00, 214.23, 385.98, 45.00, 40.50, 38.25, 29.25, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(461, 919.00, 921.00, 214.83, 386.82, 45.60, 41.04, 38.76, 29.64, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(462, 921.00, 923.00, 215.43, 387.66, 46.20, 41.58, 39.27, 30.03, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(463, 923.00, 925.00, 216.03, 388.50, 46.80, 42.12, 39.78, 30.42, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(464, 925.00, 927.00, 216.63, 389.34, 47.40, 42.66, 40.29, 30.81, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(465, 927.00, 929.00, 217.23, 390.18, 48.00, 43.20, 40.80, 31.20, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(466, 929.00, 931.00, 217.83, 391.02, 48.60, 43.74, 41.31, 31.59, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(467, 931.00, 933.00, 218.43, 391.86, 49.20, 44.28, 41.82, 31.98, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(468, 933.00, 935.00, 219.03, 392.70, 49.80, 44.82, 42.33, 32.37, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(469, 935.00, 937.00, 219.63, 393.54, 50.40, 45.36, 42.84, 32.76, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(470, 937.00, 939.00, 220.23, 394.38, 51.00, 45.90, 43.35, 33.15, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(471, 939.00, 941.00, 220.83, 395.22, 51.60, 46.44, 43.86, 33.54, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(472, 941.00, 943.00, 221.43, 396.06, 52.20, 46.98, 44.37, 33.93, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(473, 943.00, 945.00, 222.03, 396.90, 52.80, 47.52, 44.88, 34.32, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(474, 945.00, 947.00, 222.63, 397.74, 53.40, 48.06, 45.39, 34.71, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(475, 947.00, 949.00, 223.23, 398.58, 54.00, 48.60, 45.90, 35.10, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(476, 949.00, 951.00, 223.83, 399.42, 54.60, 49.14, 46.41, 35.49, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(477, 951.00, 953.00, 224.43, 400.26, 55.20, 49.68, 46.92, 35.88, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(478, 953.00, 955.00, 225.03, 401.10, 55.80, 50.22, 47.43, 36.27, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(479, 955.00, 957.00, 225.63, 401.94, 56.40, 50.76, 47.94, 36.66, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(480, 957.00, 959.00, 226.23, 402.78, 57.00, 51.30, 48.45, 37.05, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(481, 959.00, 961.00, 226.83, 403.62, 57.60, 51.84, 48.96, 37.44, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(482, 961.00, 963.00, 227.43, 404.46, 58.20, 52.38, 49.47, 37.83, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(483, 963.00, 965.00, 228.03, 405.30, 58.80, 52.92, 49.98, 38.22, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(484, 965.00, 967.00, 228.63, 406.14, 59.40, 53.46, 50.49, 38.61, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(485, 967.00, 969.00, 229.23, 406.98, 60.00, 54.00, 51.00, 39.00, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(486, 969.00, 971.00, 229.83, 407.82, 60.60, 54.54, 51.51, 39.39, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(487, 971.00, 973.00, 230.43, 408.66, 61.20, 55.08, 52.02, 39.78, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(488, 973.00, 975.00, 231.03, 409.50, 61.80, 55.62, 52.53, 40.17, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(489, 975.00, 977.00, 231.63, 410.34, 62.40, 56.16, 53.04, 40.56, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(490, 977.00, 979.00, 232.23, 411.18, 63.00, 56.70, 53.55, 40.95, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(491, 979.00, 981.00, 232.83, 412.02, 63.60, 57.24, 54.06, 41.34, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(492, 981.00, 983.00, 233.43, 412.86, 64.20, 57.78, 54.57, 41.73, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(493, 983.00, 985.00, 234.03, 413.70, 64.80, 58.32, 55.08, 42.12, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(494, 985.00, 987.00, 234.63, 414.54, 65.40, 58.86, 55.59, 42.51, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(495, 987.00, 989.00, 235.23, 415.38, 66.00, 59.40, 56.10, 42.90, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(496, 989.00, 991.00, 235.83, 416.22, 66.60, 59.94, 56.61, 43.29, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(497, 991.00, 993.00, 236.43, 417.06, 67.20, 60.48, 57.12, 43.68, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(498, 993.00, 995.00, 237.03, 417.90, 67.80, 61.02, 57.63, 44.07, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(499, 995.00, 997.00, 237.63, 418.74, 68.40, 61.56, 58.14, 44.46, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(500, 997.00, 999.00, 238.23, 419.58, 69.00, 62.10, 58.65, 44.85, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(501, 999.00, 1001.00, 238.83, 420.42, 69.60, 62.64, 59.16, 45.24, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(502, 1001.00, 1003.00, 239.43, 421.26, 70.20, 63.18, 59.67, 45.63, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(503, 1003.00, 1005.00, 240.03, 422.10, 70.80, 63.72, 60.18, 46.02, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(504, 1005.00, 1007.00, 240.63, 422.94, 71.40, 64.26, 60.69, 46.41, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(505, 1007.00, 1009.00, 241.23, 423.78, 72.00, 64.80, 61.20, 46.80, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(506, 1009.00, 1011.00, 241.83, 424.62, 72.60, 65.34, 61.71, 47.19, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(507, 1011.00, 1013.00, 242.43, 425.46, 73.20, 65.88, 62.22, 47.58, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(508, 1013.00, 1015.00, 243.03, 426.30, 73.80, 66.42, 62.73, 47.97, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(509, 1015.00, 1017.00, 243.63, 427.14, 74.40, 66.96, 63.24, 48.36, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(510, 1017.00, 1019.00, 244.23, 427.98, 75.00, 67.50, 63.75, 48.75, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(511, 1019.00, 1021.00, 244.83, 428.82, 75.60, 68.04, 64.26, 49.14, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(512, 1021.00, 1023.00, 245.43, 429.66, 76.20, 68.58, 64.77, 49.53, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(513, 1023.00, 1025.00, 246.03, 430.50, 76.80, 69.12, 65.28, 49.92, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(514, 1025.00, 1027.00, 246.63, 431.34, 77.40, 69.66, 65.79, 50.31, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(515, 1027.00, 1029.00, 247.23, 432.18, 78.00, 70.20, 66.30, 50.70, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(516, 1029.00, 1031.00, 247.83, 433.02, 78.60, 70.74, 66.81, 51.09, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(517, 1031.00, 1033.00, 248.43, 433.86, 79.20, 71.28, 67.32, 51.48, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(518, 1033.00, 1035.00, 249.03, 434.70, 79.80, 71.82, 67.83, 51.87, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(519, 1035.00, 1037.00, 249.63, 435.54, 80.40, 72.36, 68.34, 52.26, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(520, 1037.00, 1039.00, 250.23, 436.38, 81.00, 72.90, 68.85, 52.65, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(521, 1039.00, 1041.00, 250.83, 437.22, 81.60, 73.44, 69.36, 53.04, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(522, 1041.00, 1043.00, 251.43, 438.06, 82.20, 73.98, 69.87, 53.43, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(523, 1043.00, 1045.00, 252.03, 438.90, 82.80, 74.52, 70.38, 53.82, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(524, 1045.00, 1047.00, 252.63, 439.74, 83.40, 75.06, 70.89, 54.21, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(525, 1047.00, 1049.00, 253.23, 440.58, 84.00, 75.60, 71.40, 54.60, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(526, 1049.00, 1051.00, 253.83, 441.42, 84.60, 76.14, 71.91, 54.99, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(527, 1051.00, 1053.00, 254.43, 442.26, 85.20, 76.68, 72.42, 55.38, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(528, 1053.00, 1055.00, 255.03, 443.10, 85.80, 77.22, 72.93, 55.77, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(529, 1055.00, 1057.00, 255.63, 443.94, 86.40, 77.76, 73.44, 56.16, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(530, 1057.00, 1059.00, 256.23, 444.78, 87.00, 78.30, 73.95, 56.55, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(531, 1059.00, 1061.00, 256.83, 445.62, 87.60, 78.84, 74.46, 56.94, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(532, 1061.00, 1063.00, 257.43, 446.46, 88.20, 79.38, 74.97, 57.33, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(533, 1063.00, 1065.00, 258.03, 447.30, 88.80, 79.92, 75.48, 57.72, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(534, 1065.00, 1067.00, 258.63, 448.14, 89.40, 80.46, 75.99, 58.11, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(535, 1067.00, 1069.00, 259.23, 448.98, 90.00, 81.00, 76.50, 58.50, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(536, 1069.00, 1071.00, 259.83, 449.82, 90.60, 81.54, 77.01, 58.89, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(537, 1071.00, 1073.00, 260.43, 450.66, 91.20, 82.08, 77.52, 59.28, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(538, 1073.00, 1075.00, 261.03, 451.50, 91.80, 82.62, 78.03, 59.67, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(539, 1075.00, 1077.00, 261.63, 452.34, 92.40, 83.16, 78.54, 60.06, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(540, 1077.00, 1079.00, 262.23, 453.18, 93.00, 83.70, 79.05, 60.45, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(541, 1079.00, 1081.00, 262.83, 454.02, 93.60, 84.24, 79.56, 60.84, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(542, 1081.00, 1083.00, 263.43, 454.86, 94.20, 84.78, 80.07, 61.23, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(543, 1083.00, 1085.00, 264.03, 455.70, 94.80, 85.32, 80.58, 61.62, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(544, 1085.00, 1087.00, 264.63, 456.54, 95.40, 85.86, 81.09, 62.01, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(545, 1087.00, 1089.00, 265.23, 457.38, 96.00, 86.40, 81.60, 62.40, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(546, 1089.00, 1091.00, 265.83, 458.22, 96.60, 86.94, 82.11, 62.79, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(547, 1091.00, 1093.00, 266.43, 459.06, 97.20, 87.48, 82.62, 63.18, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(548, 1093.00, 1095.00, 267.03, 459.90, 97.80, 88.02, 83.13, 63.57, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(549, 1095.00, 1097.00, 267.63, 460.74, 98.40, 88.56, 83.64, 63.96, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(550, 1097.00, 1099.00, 268.23, 461.58, 99.00, 89.10, 84.15, 64.35, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(551, 1099.00, 1101.00, 268.83, 462.42, 99.60, 89.64, 84.66, 64.74, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(552, 1101.00, 1103.00, 269.43, 463.26, 100.20, 90.18, 85.17, 65.13, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(553, 1103.00, 1105.00, 270.03, 464.10, 100.80, 90.72, 85.68, 65.52, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(554, 1105.00, 1107.00, 270.63, 464.94, 101.40, 91.26, 86.19, 65.91, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(555, 1107.00, 1109.00, 271.23, 465.78, 102.00, 91.80, 86.70, 66.30, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(556, 1109.00, 1111.00, 271.83, 466.62, 102.60, 92.34, 87.21, 66.69, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(557, 1111.00, 1113.00, 272.43, 467.46, 103.20, 92.88, 87.72, 67.08, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(558, 1113.00, 1115.00, 273.03, 468.30, 103.80, 93.42, 88.23, 67.47, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(559, 1115.00, 1117.00, 273.63, 469.14, 104.40, 93.96, 88.74, 67.86, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(560, 1117.00, 1119.00, 274.23, 469.98, 105.00, 94.50, 89.25, 68.25, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(561, 1119.00, 1121.00, 274.83, 470.82, 105.60, 95.04, 89.76, 68.64, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(562, 1121.00, 1123.00, 275.43, 471.66, 106.20, 95.58, 90.27, 69.03, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(563, 1123.00, 1125.00, 276.03, 472.50, 106.80, 96.12, 90.78, 69.42, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(564, 1125.00, 1127.00, 276.63, 473.34, 107.40, 96.66, 91.29, 69.81, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(565, 1127.00, 1129.00, 277.23, 474.18, 108.00, 97.20, 91.80, 70.20, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(566, 1129.00, 1131.00, 277.83, 475.02, 108.60, 97.74, 92.31, 70.59, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(567, 1131.00, 1133.00, 278.43, 475.86, 109.20, 98.28, 92.82, 70.98, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(568, 1133.00, 1135.00, 279.03, 476.70, 109.80, 98.82, 93.33, 71.37, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(569, 1135.00, 1137.00, 279.63, 477.54, 110.40, 99.36, 93.84, 71.76, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(570, 1137.00, 1139.00, 280.23, 478.38, 111.00, 99.90, 94.35, 72.15, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(571, 1139.00, 1141.00, 280.83, 479.22, 111.60, 100.44, 94.86, 72.54, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(572, 1141.00, 1143.00, 281.43, 480.06, 112.20, 100.98, 95.37, 72.93, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(573, 1143.00, 1145.00, 282.03, 480.90, 112.80, 101.52, 95.88, 73.32, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(574, 1145.00, 1147.00, 282.63, 481.74, 113.40, 102.06, 96.39, 73.71, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(575, 1147.00, 1149.00, 283.23, 482.58, 114.00, 102.60, 96.90, 74.10, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(576, 1149.00, 1151.00, 283.83, 483.42, 114.60, 103.14, 97.41, 74.49, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(577, 1151.00, 1153.00, 284.43, 484.26, 115.20, 103.68, 97.92, 74.88, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(578, 1153.00, 1155.00, 285.03, 485.10, 115.80, 104.22, 98.43, 75.27, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(579, 1155.00, 1157.00, 285.63, 485.94, 116.40, 104.76, 98.94, 75.66, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(580, 1157.00, 1159.00, 286.23, 486.78, 117.00, 105.30, 99.45, 76.05, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(581, 1159.00, 1161.00, 286.83, 487.62, 117.60, 105.84, 99.96, 76.44, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(582, 1161.00, 1163.00, 287.43, 488.46, 118.20, 106.38, 100.47, 76.83, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(583, 1163.00, 1165.00, 288.03, 489.30, 118.80, 106.92, 100.98, 77.22, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(584, 1165.00, 1167.00, 288.63, 490.14, 119.40, 107.46, 101.49, 77.61, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(585, 1167.00, 1169.00, 289.23, 490.98, 120.00, 108.00, 102.00, 78.00, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(586, 1169.00, 1171.00, 289.83, 491.82, 120.60, 108.54, 102.51, 78.39, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(587, 1171.00, 1173.00, 290.43, 492.66, 121.20, 109.08, 103.02, 78.78, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(588, 1173.00, 1175.00, 291.03, 493.50, 121.80, 109.62, 103.53, 79.17, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(589, 1175.00, 1177.00, 291.63, 494.34, 122.40, 110.16, 104.04, 79.56, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(590, 1177.00, 1179.00, 292.23, 495.18, 123.00, 110.70, 104.55, 79.95, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(591, 1179.00, 1181.00, 292.83, 496.02, 123.60, 111.24, 105.06, 80.34, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(592, 1181.00, 1183.00, 293.43, 496.86, 124.20, 111.78, 105.57, 80.73, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(593, 1183.00, 1185.00, 294.03, 497.70, 124.80, 112.32, 106.08, 81.12, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(594, 1185.00, 1187.00, 294.63, 498.54, 125.40, 112.86, 106.59, 81.51, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(595, 1187.00, 1189.00, 295.23, 499.38, 126.00, 113.40, 107.10, 81.90, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(596, 1189.00, 1191.00, 295.83, 500.22, 126.60, 113.94, 107.61, 82.29, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(597, 1191.00, 1193.00, 296.43, 501.06, 127.20, 114.48, 108.12, 82.68, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(598, 1193.00, 1195.00, 297.03, 501.90, 127.80, 115.02, 108.63, 83.07, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(599, 1195.00, 1197.00, 297.63, 502.74, 128.40, 115.56, 109.14, 83.46, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(600, 1197.00, 1199.00, 298.23, 503.58, 129.00, 116.10, 109.65, 83.85, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(601, 1199.00, 1201.00, 298.83, 504.42, 129.60, 116.64, 110.16, 84.24, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(602, 1201.00, 1203.00, 299.43, 505.26, 130.20, 117.18, 110.67, 84.63, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(603, 1203.00, 1205.00, 300.03, 506.10, 130.80, 117.72, 111.18, 85.02, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(604, 1205.00, 1207.00, 300.63, 506.94, 131.40, 118.26, 111.69, 85.41, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(605, 1207.00, 1209.00, 301.23, 507.78, 132.00, 118.80, 112.20, 85.80, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(606, 1209.00, 1211.00, 301.83, 508.62, 132.60, 119.34, 112.71, 86.19, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(607, 1211.00, 1213.00, 302.43, 509.46, 133.20, 119.88, 113.22, 86.58, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(608, 1213.00, 1215.00, 303.03, 510.30, 133.80, 120.42, 113.73, 86.97, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(609, 1215.00, 1217.00, 303.63, 511.14, 134.40, 120.96, 114.24, 87.36, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(610, 1217.00, 1219.00, 304.23, 511.98, 135.00, 121.50, 114.75, 87.75, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(611, 1219.00, 1221.00, 304.83, 512.82, 135.60, 122.04, 115.26, 88.14, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(612, 1221.00, 1223.00, 305.43, 513.66, 136.20, 122.58, 115.77, 88.53, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(613, 1223.00, 1225.00, 306.03, 514.50, 136.80, 123.12, 116.28, 88.92, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(614, 1225.00, 1227.00, 306.63, 515.34, 137.40, 123.66, 116.79, 89.31, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(615, 1227.00, 1229.00, 307.23, 516.18, 138.00, 124.20, 117.30, 89.70, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(616, 1229.00, 1231.00, 307.83, 517.02, 138.60, 124.74, 117.81, 90.09, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(617, 1231.00, 1233.00, 308.43, 517.86, 139.20, 125.28, 118.32, 90.48, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(618, 1233.00, 1235.00, 309.03, 518.70, 139.80, 125.82, 118.83, 90.87, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(619, 1235.00, 1237.00, 309.63, 519.54, 140.40, 126.36, 119.34, 91.26, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(620, 1237.00, 1239.00, 310.23, 520.38, 141.00, 126.90, 119.85, 91.65, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(621, 1239.00, 1241.00, 310.83, 521.22, 141.60, 127.44, 120.36, 92.04, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(622, 1241.00, 1243.00, 311.43, 522.06, 142.20, 127.98, 120.87, 92.43, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(623, 1243.00, 1245.00, 312.03, 522.90, 142.80, 128.52, 121.38, 92.82, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(624, 1245.00, 1247.00, 312.63, 523.74, 143.40, 129.06, 121.89, 93.21, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(625, 1247.00, 1249.00, 313.23, 524.58, 144.00, 129.60, 122.40, 93.60, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(626, 1249.00, 1251.00, 313.83, 525.42, 144.60, 130.14, 122.91, 93.99, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(627, 1251.00, 1253.00, 314.43, 526.26, 145.20, 130.68, 123.42, 94.38, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(628, 1253.00, 1255.00, 315.03, 527.10, 145.80, 131.22, 123.93, 94.77, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(629, 1255.00, 1257.00, 315.63, 527.94, 146.40, 131.76, 124.44, 95.16, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(630, 1257.00, 1259.00, 316.23, 528.78, 147.00, 132.30, 124.95, 95.55, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(631, 1259.00, 1261.00, 316.83, 529.62, 147.60, 132.84, 125.46, 95.94, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(632, 1261.00, 1263.00, 317.43, 530.46, 148.20, 133.38, 125.97, 96.33, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(633, 1263.00, 1265.00, 318.03, 531.30, 148.80, 133.92, 126.48, 96.72, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(634, 1265.00, 1267.00, 318.63, 532.14, 149.40, 134.46, 126.99, 97.11, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(635, 1267.00, 1269.00, 319.23, 532.98, 150.00, 135.00, 127.50, 97.50, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06'),
(636, 1269.00, 1271.00, 319.83, 533.82, 150.60, 135.54, 128.01, 97.89, 'B', '2025-07-07 07:27:06', '2025-07-07 07:27:06');

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
-- Table structure for table `time_logs`
--

CREATE TABLE `time_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` int(10) UNSIGNED NOT NULL,
  `log_date` date NOT NULL,
  `login_time` time DEFAULT NULL,
  `logout_time` time DEFAULT NULL,
  `break_start` time DEFAULT NULL,
  `break_end` time DEFAULT NULL,
  `total_work_seconds` int(11) NOT NULL DEFAULT 0,
  `total_break_seconds` int(11) NOT NULL DEFAULT 0,
  `year` year(4) NOT NULL,
  `month` tinyint(3) UNSIGNED NOT NULL,
  `day` tinyint(3) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `present_address` varchar(255) DEFAULT NULL,
  `permanent_address` varchar(255) DEFAULT NULL,
  `home_district` varchar(255) DEFAULT NULL,
  `academic_qualification` text DEFAULT NULL,
  `professional_qualification` text DEFAULT NULL,
  `joining_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `experience` text DEFAULT NULL,
  `reference` text DEFAULT NULL,
  `id_name` tinyint(4) DEFAULT NULL COMMENT '1 for NID, 2 Passport, 3 for Driving License',
  `id_number` varchar(255) DEFAULT NULL,
  `contact_no_one` varchar(30) DEFAULT NULL,
  `contact_no_two` varchar(30) DEFAULT NULL,
  `emergency_contact` varchar(30) DEFAULT NULL,
  `web` varchar(255) DEFAULT NULL,
  `gender` varchar(1) DEFAULT NULL,
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
  `employee_type` tinyint(1) DEFAULT NULL COMMENT '1 for Provision & 2 for Permanent',
  `resident_status` varchar(255) DEFAULT NULL COMMENT '1 for Resident & 2 for Non-Resident',
  `no_of_dependent` int(11) DEFAULT NULL,
  `user_payroll_rel_id` int(11) DEFAULT 0,
  `company_id` int(11) DEFAULT 1,
  `user_type` int(50) DEFAULT 2,
  `passport_number` varchar(255) DEFAULT NULL,
  `visa_number` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `created_by`, `employee_id`, `name`, `father_name`, `mother_name`, `spouse_name`, `email`, `password`, `present_address`, `permanent_address`, `home_district`, `academic_qualification`, `professional_qualification`, `joining_date`, `end_date`, `branch`, `experience`, `reference`, `id_name`, `id_number`, `contact_no_one`, `contact_no_two`, `emergency_contact`, `web`, `gender`, `date_of_birth`, `marital_status`, `avatar`, `client_type_id`, `designation_id`, `joining_position`, `access_label`, `role`, `activation_status`, `deletion_status`, `remember_token`, `shift_id`, `date_of_leaving`, `employee_type`, `resident_status`, `no_of_dependent`, `user_payroll_rel_id`, `company_id`, `user_type`, `passport_number`, `visa_number`, `created_at`, `updated_at`) VALUES
(1, 1, NULL, 'Admin', NULL, NULL, NULL, 'admin@mail.com', '$2y$12$TQgjdGT6XycPExJ4redfU.I/vSx.WThEvYPXUB4fjwolBmNzfndK6', '123 Bidhan Sarani\nKolkata, West Bengal 700006', '123 Bidhan Sarani\nKolkata, West Bengal 700006', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '01921588567', NULL, NULL, 'http://demo.com', 'm', '2023-12-24', NULL, '', 9, 8, NULL, 1, NULL, 1, 0, 'wy9ntdWngq3e3bVhsGKydvsuKEQUeeV7pk8hrZRQ4dFovgWaCO3y30nN2DWX', 0, NULL, NULL, NULL, NULL, 0, 1, 1, NULL, NULL, '2019-09-07 00:55:15', '2025-02-05 16:58:38'),
(4, NULL, 4, 'Joseph Fernanindis', 'Mike Fernandis', 'Shelly Fernandis', 'Mam Fernandis', 'johnFr88@gmail.com', '$2y$12$/rB3bEiAPblEa7CrBYNLQuT3dbLMlCLL72NM/fckenYDqtUNBeDC2', 'Lokenath Apartment', 'Lokenath Apartment', NULL, 'Master of Computer Application', 'Software Engineering', '2025-01-06', NULL, '2', '13 years experience in software development', NULL, NULL, NULL, '1234567890', NULL, '1234567890', NULL, 'm', '1984-01-02', 1, NULL, NULL, 7, NULL, 3, NULL, 0, 0, NULL, 1, NULL, 2, '1', NULL, 3, 1, 2, 'TP1256933', 'test12356', '2025-07-15 16:23:10', '2025-07-15 16:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `user_details`
--

CREATE TABLE `user_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(10) UNSIGNED NOT NULL,
  `present_address` varchar(250) DEFAULT NULL,
  `city_pr` varchar(100) DEFAULT NULL,
  `state_pr` varchar(100) DEFAULT NULL,
  `postcode_pr` varchar(20) DEFAULT NULL,
  `country_pr` varchar(100) DEFAULT NULL,
  `permanent_address` varchar(250) DEFAULT NULL,
  `city` varchar(100) DEFAULT NULL,
  `state` varchar(100) DEFAULT NULL,
  `postcode` varchar(20) DEFAULT NULL,
  `country` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_details`
--

INSERT INTO `user_details` (`id`, `user_id`, `present_address`, `city_pr`, `state_pr`, `postcode_pr`, `country_pr`, `permanent_address`, `city`, `state`, `postcode`, `country`, `created_at`, `updated_at`) VALUES
(3, 4, 'Lokenath Apartment', 'Kolkata', 'West Bengal', '700028', 'India', 'Lokenath Apartment', 'Kolkata', 'West Bengal', '700028', 'India', '2025-07-15 16:23:10', '2025-07-15 16:23:10');

-- --------------------------------------------------------

--
-- Table structure for table `working_days`
--

CREATE TABLE `working_days` (
  `id` int(10) UNSIGNED NOT NULL,
  `updated_by` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `working_status` tinyint(4) NOT NULL COMMENT '0 for holiday & 1 for working day',
  `working_hours` int(50) NOT NULL,
  `grace_periods` int(10) DEFAULT 10,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `working_days`
--

INSERT INTO `working_days` (`id`, `updated_by`, `day`, `working_status`, `working_hours`, `grace_periods`, `created_at`, `updated_at`) VALUES
(1, 1, 'Sun', 0, 0, 0, '2018-04-12 06:25:16', '2024-10-26 10:51:23'),
(2, 1, 'Mon', 1, 8, 10, '2018-04-12 06:25:16', '2024-10-26 10:51:23'),
(3, 1, 'Tue', 1, 8, 10, '2018-04-12 06:25:17', '2024-10-26 10:51:23'),
(4, 1, 'Wed', 1, 8, 10, '2018-04-12 06:25:17', '2024-10-26 10:51:23'),
(5, 1, 'Thu', 1, 8, 10, '2018-04-12 06:25:17', '2024-10-26 10:51:23'),
(6, 1, 'Fri', 1, 8, 10, '2018-04-12 06:25:17', '2024-10-26 10:51:23'),
(7, 1, 'Sat', 0, 0, 0, '2018-04-12 06:25:17', '2024-10-26 10:51:23');

-- --------------------------------------------------------

--
-- Table structure for table `wpac_bank_transfer_setups`
--

CREATE TABLE `wpac_bank_transfer_setups` (
  `id` int(10) UNSIGNED NOT NULL,
  `wpac_customer_reference` varchar(255) DEFAULT NULL,
  `wpac_folder_directory` varchar(255) DEFAULT NULL,
  `gl_code_id` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wpac_bank_transfer_setups`
--

INSERT INTO `wpac_bank_transfer_setups` (`id`, `wpac_customer_reference`, `wpac_folder_directory`, `gl_code_id`, `created_at`, `updated_at`) VALUES
(1, '123456789', 'e://ravi', 3, '2024-08-30 13:30:19', '2024-08-30 13:30:19');

-- --------------------------------------------------------

--
-- Table structure for table `wpac_setting_banks`
--

CREATE TABLE `wpac_setting_banks` (
  `id` int(10) UNSIGNED NOT NULL,
  `wpac_setting_id` int(10) UNSIGNED DEFAULT NULL,
  `bank_id` int(10) UNSIGNED DEFAULT NULL,
  `transaction_fee` decimal(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wpac_setting_banks`
--

INSERT INTO `wpac_setting_banks` (`id`, `wpac_setting_id`, `bank_id`, `transaction_fee`, `created_at`, `updated_at`) VALUES
(9, 1, 3, 20.00, '2024-08-30 13:48:53', '2024-08-30 13:49:04'),
(10, 1, 1, NULL, '2024-10-21 15:05:09', '2024-10-21 15:05:09'),
(11, 1, 5, 0.20, '2024-11-29 04:31:46', '2024-11-29 04:32:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `allowances`
--
ALTER TABLE `allowances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anz_bank_transfer_setups`
--
ALTER TABLE `anz_bank_transfer_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `anz_setting_banks`
--
ALTER TABLE `anz_setting_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `anz_setting_banks_anz_setting_id_foreign` (`anz_setting_id`),
  ADD KEY `anz_setting_banks_bank_id_foreign` (`bank_id`);

--
-- Indexes for table `attendances`
--
ALTER TABLE `attendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_records`
--
ALTER TABLE `attendance_records`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance_reports`
--
ALTER TABLE `attendance_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `award_categories`
--
ALTER TABLE `award_categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `banks`
--
ALTER TABLE `banks`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `banks_bank_code_unique` (`bank_code`);

--
-- Indexes for table `bank_details`
--
ALTER TABLE `bank_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bank_list`
--
ALTER TABLE `bank_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `bank_code` (`bank_code`);

--
-- Indexes for table `bonuses`
--
ALTER TABLE `bonuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `branches_branch_code_unique` (`branch_code`);

--
-- Indexes for table `bsp_bank_transfer_setups`
--
ALTER TABLE `bsp_bank_transfer_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bsp_setting_banks`
--
ALTER TABLE `bsp_setting_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bsp_setting_banks_bsp_setting_id_foreign` (`bsp_setting_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `client_types`
--
ALTER TABLE `client_types`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `client_types_client_type_unique` (`client_type`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_centers`
--
ALTER TABLE `cost_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cost_center_department_rel`
--
ALTER TABLE `cost_center_department_rel`
  ADD PRIMARY KEY (`id`),
  ADD KEY `cost_center_department_rel_cost_center_id_index` (`cost_center_id`),
  ADD KEY `cost_center_department_rel_department_id_index` (`department_id`);

--
-- Indexes for table `currencies`
--
ALTER TABLE `currencies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `currencies_currency_code_unique` (`currency_code`);

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
-- Indexes for table `employee_bank_rels`
--
ALTER TABLE `employee_bank_rels`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `employee_bank_rels_account_no_unique` (`account_no`);

--
-- Indexes for table `employee_contacts`
--
ALTER TABLE `employee_contacts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `employee_cost_centers`
--
ALTER TABLE `employee_cost_centers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_leave_msts`
--
ALTER TABLE `employee_leave_msts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employee_relations`
--
ALTER TABLE `employee_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empl_superannuation_rels`
--
ALTER TABLE `empl_superannuation_rels`
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
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

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
-- Indexes for table `gl_codes`
--
ALTER TABLE `gl_codes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gl_codes_gl_code_unique` (`gl_code`);

--
-- Indexes for table `gl_interface_control_files`
--
ALTER TABLE `gl_interface_control_files`
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
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kina_bank_transfer_setups`
--
ALTER TABLE `kina_bank_transfer_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kina_setting_banks`
--
ALTER TABLE `kina_setting_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `kina_setting_banks_kina_setting_id_foreign` (`kina_setting_id`),
  ADD KEY `kina_setting_banks_bank_id_foreign` (`bank_id`);

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
-- Indexes for table `leave_details`
--
ALTER TABLE `leave_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leave_managements`
--
ALTER TABLE `leave_managements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `leave_category_id` (`leave_category_id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_master`
--
ALTER TABLE `loan_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `loan_master_loan_code_unique` (`loan_code`);

--
-- Indexes for table `loan_payments`
--
ALTER TABLE `loan_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `overtime_list`
--
ALTER TABLE `overtime_list`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

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
-- Indexes for table `pay_accumulators`
--
ALTER TABLE `pay_accumulators`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pay_accumulators_pay_accumulator_code_unique` (`pay_accumulator_code`);

--
-- Indexes for table `pay_batch_numbers`
--
ALTER TABLE `pay_batch_numbers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pay_batch_numbers_pay_batch_number_code_unique` (`pay_batch_number_code`);

--
-- Indexes for table `pay_items`
--
ALTER TABLE `pay_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `pay_items_accumulator_foreign` (`accumulator`),
  ADD KEY `pay_items_glaccount_foreign` (`glaccount`),
  ADD KEY `pay_items_bank_id_foreign` (`bank_id`),
  ADD KEY `pay_items_bank_detail_id_foreign` (`bank_detail_id`),
  ADD KEY `pay_items_superannuation_fund_id_foreign` (`superannuation_fund_id`);

--
-- Indexes for table `pay_locations`
--
ALTER TABLE `pay_locations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `pay_locations_payroll_location_code_unique` (`payroll_location_code`);

--
-- Indexes for table `pay_references`
--
ALTER TABLE `pay_references`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_reference_department_rels`
--
ALTER TABLE `pay_reference_department_rels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_reference_empl_relations`
--
ALTER TABLE `pay_reference_empl_relations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_reference_emp_superannuation_rels`
--
ALTER TABLE `pay_reference_emp_superannuation_rels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_reference_payitems`
--
ALTER TABLE `pay_reference_payitems`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_reference_pay_location_rels`
--
ALTER TABLE `pay_reference_pay_location_rels`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_reference_pay_slips`
--
ALTER TABLE `pay_reference_pay_slips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_reference_update_leaves`
--
ALTER TABLE `pay_reference_update_leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pay_reference_update_loans`
--
ALTER TABLE `pay_reference_update_loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `period_defination_rates`
--
ALTER TABLE `period_defination_rates`
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
-- Indexes for table `superannuations`
--
ALTER TABLE `superannuations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `superannuations_code_unique` (`code`);

--
-- Indexes for table `tax_rates`
--
ALTER TABLE `tax_rates`
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
-- Indexes for table `time_logs`
--
ALTER TABLE `time_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_details`
--
ALTER TABLE `user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_details_user_id_foreign` (`user_id`);

--
-- Indexes for table `working_days`
--
ALTER TABLE `working_days`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpac_bank_transfer_setups`
--
ALTER TABLE `wpac_bank_transfer_setups`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `wpac_setting_banks`
--
ALTER TABLE `wpac_setting_banks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wpac_setting_banks_wpac_setting_id_foreign` (`wpac_setting_id`),
  ADD KEY `wpac_setting_banks_bank_id_foreign` (`bank_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `allowances`
--
ALTER TABLE `allowances`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `anz_bank_transfer_setups`
--
ALTER TABLE `anz_bank_transfer_setups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `anz_setting_banks`
--
ALTER TABLE `anz_setting_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `attendances`
--
ALTER TABLE `attendances`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_records`
--
ALTER TABLE `attendance_records`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `attendance_reports`
--
ALTER TABLE `attendance_reports`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `award_categories`
--
ALTER TABLE `award_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `banks`
--
ALTER TABLE `banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `bank_details`
--
ALTER TABLE `bank_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bank_list`
--
ALTER TABLE `bank_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `bonuses`
--
ALTER TABLE `bonuses`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `bsp_bank_transfer_setups`
--
ALTER TABLE `bsp_bank_transfer_setups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `bsp_setting_banks`
--
ALTER TABLE `bsp_setting_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=57;

--
-- AUTO_INCREMENT for table `client_types`
--
ALTER TABLE `client_types`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `cost_centers`
--
ALTER TABLE `cost_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `cost_center_department_rel`
--
ALTER TABLE `cost_center_department_rel`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `currencies`
--
ALTER TABLE `currencies`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `deductions`
--
ALTER TABLE `deductions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_bank_rels`
--
ALTER TABLE `employee_bank_rels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `employee_contacts`
--
ALTER TABLE `employee_contacts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `employee_cost_centers`
--
ALTER TABLE `employee_cost_centers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employee_leave_msts`
--
ALTER TABLE `employee_leave_msts`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `employee_relations`
--
ALTER TABLE `employee_relations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `empl_superannuation_rels`
--
ALTER TABLE `empl_superannuation_rels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `expence_managements`
--
ALTER TABLE `expence_managements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `exp_purposes`
--
ALTER TABLE `exp_purposes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `gl_codes`
--
ALTER TABLE `gl_codes`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `gl_interface_control_files`
--
ALTER TABLE `gl_interface_control_files`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kina_bank_transfer_setups`
--
ALTER TABLE `kina_bank_transfer_setups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `kina_setting_banks`
--
ALTER TABLE `kina_setting_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `leave_applications`
--
ALTER TABLE `leave_applications`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_categories`
--
ALTER TABLE `leave_categories`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `leave_details`
--
ALTER TABLE `leave_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `leave_managements`
--
ALTER TABLE `leave_managements`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_master`
--
ALTER TABLE `loan_master`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `loan_payments`
--
ALTER TABLE `loan_payments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=164;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `overtime_list`
--
ALTER TABLE `overtime_list`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `payrolls`
--
ALTER TABLE `payrolls`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `pay_accumulators`
--
ALTER TABLE `pay_accumulators`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `pay_batch_numbers`
--
ALTER TABLE `pay_batch_numbers`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `pay_items`
--
ALTER TABLE `pay_items`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `pay_locations`
--
ALTER TABLE `pay_locations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `pay_references`
--
ALTER TABLE `pay_references`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_reference_department_rels`
--
ALTER TABLE `pay_reference_department_rels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_reference_empl_relations`
--
ALTER TABLE `pay_reference_empl_relations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_reference_emp_superannuation_rels`
--
ALTER TABLE `pay_reference_emp_superannuation_rels`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_reference_payitems`
--
ALTER TABLE `pay_reference_payitems`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_reference_pay_location_rels`
--
ALTER TABLE `pay_reference_pay_location_rels`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_reference_pay_slips`
--
ALTER TABLE `pay_reference_pay_slips`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_reference_update_leaves`
--
ALTER TABLE `pay_reference_update_leaves`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pay_reference_update_loans`
--
ALTER TABLE `pay_reference_update_loans`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `period_defination_rates`
--
ALTER TABLE `period_defination_rates`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

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
-- AUTO_INCREMENT for table `superannuations`
--
ALTER TABLE `superannuations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tax_rates`
--
ALTER TABLE `tax_rates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=637;

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
-- AUTO_INCREMENT for table `time_logs`
--
ALTER TABLE `time_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `user_details`
--
ALTER TABLE `user_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `working_days`
--
ALTER TABLE `working_days`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `wpac_bank_transfer_setups`
--
ALTER TABLE `wpac_bank_transfer_setups`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `wpac_setting_banks`
--
ALTER TABLE `wpac_setting_banks`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bsp_setting_banks`
--
ALTER TABLE `bsp_setting_banks`
  ADD CONSTRAINT `bsp_setting_banks_bsp_setting_id_foreign` FOREIGN KEY (`bsp_setting_id`) REFERENCES `bsp_bank_transfer_setups` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `cost_center_department_rel`
--
ALTER TABLE `cost_center_department_rel`
  ADD CONSTRAINT `cost_center_department_rel_cost_center_id_foreign` FOREIGN KEY (`cost_center_id`) REFERENCES `cost_centers` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cost_center_department_rel_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `employee_contacts`
--
ALTER TABLE `employee_contacts`
  ADD CONSTRAINT `employee_contacts_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `leave_managements`
--
ALTER TABLE `leave_managements`
  ADD CONSTRAINT `leave_managements_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `leave_managements_ibfk_2` FOREIGN KEY (`leave_category_id`) REFERENCES `leave_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `pay_items`
--
ALTER TABLE `pay_items`
  ADD CONSTRAINT `pay_items_accumulator_foreign` FOREIGN KEY (`accumulator`) REFERENCES `pay_accumulators` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `pay_items_glaccount_foreign` FOREIGN KEY (`glaccount`) REFERENCES `gl_codes` (`id`) ON DELETE CASCADE;

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

--
-- Constraints for table `user_details`
--
ALTER TABLE `user_details`
  ADD CONSTRAINT `user_details_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
