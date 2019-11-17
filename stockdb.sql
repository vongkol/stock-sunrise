-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 17, 2019 at 04:12 PM
-- Server version: 5.7.27-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `newstock`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `active`, `create_at`) VALUES
(1, 'Computer', 1, '2019-09-22 09:15:33'),
(2, 'Mouse', 1, '2019-09-22 09:15:36'),
(3, 'Keyboard', 1, '2019-09-22 09:15:39'),
(4, 'Monitor', 1, '2019-09-22 09:15:43'),
(5, 'VGA', 1, '2019-09-22 09:15:45'),
(6, 'Cable', 1, '2019-09-22 09:15:49'),
(7, 'Router', 1, '2019-09-22 09:15:52'),
(8, 'Switch', 1, '2019-09-22 09:15:55'),
(9, 'Power Supply', 1, '2019-09-22 09:15:59'),
(10, 'RAM', 1, '2019-09-22 09:16:02'),
(11, 'CPU Core i7', 1, '2019-09-22 09:16:03'),
(12, 'Phone', 0, '2019-09-22 09:16:53'),
(13, 'TEST', 0, '2019-10-05 10:31:39'),
(14, 'hello world', 0, '2019-10-05 10:32:29'),
(15, 'hello', 1, '2019-10-27 07:49:46'),
(16, 'hello', 1, '2019-10-27 07:49:51'),
(17, 'sdfsdfsdf', 1, '2019-10-27 07:50:29'),
(18, 'abc', 1, '2019-10-27 07:50:44'),
(19, 'Printer', 1, '2019-10-27 07:52:53'),
(20, 'Monitor 4K', 1, '2019-10-27 07:53:39');

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` tinyint(4) NOT NULL,
  `kh_name` varchar(120) NOT NULL,
  `en_name` varchar(120) NOT NULL,
  `address` text,
  `email` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `logo` varchar(120) DEFAULT NULL,
  `header_text` varchar(200) DEFAULT NULL,
  `foot_text` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `kh_name`, `en_name`, `address`, `email`, `phone`, `logo`, `header_text`, `foot_text`) VALUES
(1, 'ក្រុមហ៊ុន ABCDE', 'ABCDE Co., Ltd', 'Phnom Penh, Cambodia', 'abcde@gmail.com', '017837754', 'logo.png', 'Header Text of The Company!', 'Footer Text of The Company!');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `name` varchar(120) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(200) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `name`, `alias`) VALUES
(1, 'role', 'Roles'),
(2, 'user', 'Users'),
(3, 'dashboard', 'Dashboard');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `barcode` varchar(30) COLLATE utf8_unicode_ci DEFAULT NULL,
  `qrcode` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `brand` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `onhand` int(11) NOT NULL DEFAULT '0',
  `photo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` float NOT NULL DEFAULT '0',
  `cost` float NOT NULL DEFAULT '0',
  `description` text COLLATE utf8_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `code`, `name`, `barcode`, `qrcode`, `brand`, `category_id`, `unit_id`, `onhand`, `photo`, `price`, `cost`, `description`, `active`, `create_at`) VALUES
(1, '123', 'Dell XPS', NULL, NULL, 'TT', 1, 1, 3, NULL, 0, 0, 'Test', 1, '2019-10-06 10:04:57'),
(2, 't12', 'b', NULL, NULL, 'TT', 1, 1, 12, NULL, 0, 1, 'Test', 1, '2019-10-06 10:04:57');

-- --------------------------------------------------------

--
-- Table structure for table `product_warehouses`
--

CREATE TABLE `product_warehouses` (
  `id` int(11) NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `product_warehouses`
--

INSERT INTO `product_warehouses` (`id`, `warehouse_id`, `product_id`, `total`) VALUES
(1, 1, 1, -10),
(2, 2, 1, 13),
(3, 2, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` int(11) NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `active`, `create_at`) VALUES
(1, 'Root Level', 1, '2019-09-21 06:10:12'),
(2, 'Administrator', 1, '2019-09-21 06:11:11'),
(3, 'Manager', 1, '2019-09-21 06:11:14'),
(4, 'Officer', 1, '2019-09-21 06:11:19'),
(5, 'Sale Manager', 1, '2019-09-21 06:11:21'),
(6, 'Accountant', 1, '2019-09-21 06:11:24'),
(7, 'IT Admin', 1, '2019-09-21 06:11:28');

-- --------------------------------------------------------

--
-- Table structure for table `role_permissions`
--

CREATE TABLE `role_permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `permission_id` int(11) NOT NULL,
  `list` tinyint(4) NOT NULL DEFAULT '0',
  `create` tinyint(4) NOT NULL DEFAULT '0',
  `edit` tinyint(4) NOT NULL DEFAULT '0',
  `delete` tinyint(4) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `role_permissions`
--

INSERT INTO `role_permissions` (`id`, `role_id`, `permission_id`, `list`, `create`, `edit`, `delete`) VALUES
(1, 7, 1, 1, 1, 1, 1),
(2, 7, 2, 1, 1, 0, 1),
(3, 3, 1, 1, 1, 1, 1),
(4, 3, 2, 1, 1, 1, 1),
(5, 2, 2, 1, 1, 1, 1),
(6, 4, 1, 1, 0, 0, 0),
(7, 4, 2, 1, 0, 0, 0),
(8, 4, 3, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `stock_ins`
--

CREATE TABLE `stock_ins` (
  `id` int(11) NOT NULL,
  `in_date` date NOT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `po_no` varchar(50) DEFAULT NULL,
  `in_by` int(11) DEFAULT NULL,
  `description` text,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `warehouse_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_ins`
--

INSERT INTO `stock_ins` (`id`, `in_date`, `reference`, `po_no`, `in_by`, `description`, `active`, `create_at`, `warehouse_id`) VALUES
(4, '2019-11-17', '0022896', 'P002', 1, NULL, 1, '2019-10-26 07:45:19', 2);

-- --------------------------------------------------------

--
-- Table structure for table `stock_in_details`
--

CREATE TABLE `stock_in_details` (
  `id` int(11) NOT NULL,
  `stock_in_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_in_details`
--

INSERT INTO `stock_in_details` (`id`, `stock_in_id`, `product_id`, `quantity`, `warehouse_id`, `create_at`) VALUES
(4, 4, 1, 3, 2, '2019-10-26 07:45:19'),
(5, 4, 2, 2, 2, '2019-10-27 08:15:45'),
(6, 4, 1, 10, 2, '2019-10-27 08:16:08');

-- --------------------------------------------------------

--
-- Table structure for table `stock_outs`
--

CREATE TABLE `stock_outs` (
  `id` int(11) NOT NULL,
  `out_date` date NOT NULL,
  `reference` varchar(50) DEFAULT NULL,
  `out_by` int(11) DEFAULT NULL,
  `description` text,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `warehouse_id` int(11) NOT NULL,
  `request_code` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_outs`
--

INSERT INTO `stock_outs` (`id`, `out_date`, `reference`, `out_by`, `description`, `active`, `create_at`, `warehouse_id`, `request_code`) VALUES
(2, '2019-11-16', 'RF009', 1, 'some description or note here...', 1, '2019-11-15 17:08:54', 1, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `stock_out_details`
--

CREATE TABLE `stock_out_details` (
  `id` int(11) NOT NULL,
  `stock_out_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` float NOT NULL,
  `warehouse_id` int(11) NOT NULL,
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `stock_out_details`
--

INSERT INTO `stock_out_details` (`id`, `stock_out_id`, `product_id`, `quantity`, `warehouse_id`, `create_at`) VALUES
(3, 2, 1, 1, 1, '2019-11-15 17:08:54');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` int(11) NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `name`, `active`, `create_at`) VALUES
(1, 'Kg', 1, '2019-10-06 01:11:18'),
(2, 'm', 1, '2019-10-06 01:11:18'),
(3, 'TEST', 0, '2019-10-06 01:13:38'),
(4, 'PCS', 1, '2019-10-27 07:57:35'),
(5, 'Ton', 1, '2019-10-27 07:57:45'),
(6, 'Cm', 1, '2019-10-27 07:58:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `photo` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `language` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'en'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `username`, `email`, `email_verified_at`, `photo`, `password`, `remember_token`, `created_at`, `updated_at`, `role_id`, `language`) VALUES
(1, 'Admin', 'admin', 'admin@gmail.com', NULL, 'uploads/users/kY3xUMWwuWCb8yD4PsvOOB80JmIsxsDG4QcZrP7O.jpeg', '$2y$10$meVrmT1qcjMhT.FoLU795uP6TTnhIQea18t4icl441g4Aw3eqgjyq', NULL, '2019-09-20 21:03:37', '2019-09-20 21:03:37', 7, 'en'),
(4, 'Sopheak', 'sopheak', 'sopheak@gmail.com', NULL, 'uploads/users/L6iPzsItRCJTiY9OiuN1Mieo976WJbxOFxJ9LsqQ.png', '$2y$10$8ePT8pJtRqo4SQbVNtnanORsaSfHhvxSPo4X8Cl/wntNPIV0cjwpi', NULL, NULL, NULL, 7, 'km');

-- --------------------------------------------------------

--
-- Table structure for table `warehouses`
--

CREATE TABLE `warehouses` (
  `id` int(11) NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `active` tinyint(4) NOT NULL DEFAULT '1',
  `create_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `warehouses`
--

INSERT INTO `warehouses` (`id`, `code`, `name`, `address`, `active`, `create_at`) VALUES
(1, 'WH001', 'Warehouse 1', NULL, 1, '2019-10-05 11:43:35'),
(2, 'WH002', 'Warehouse 2', NULL, 1, '2019-10-05 11:43:35'),
(9, 'TEST', 'Test', 'test', 0, '2019-10-06 00:51:02'),
(10, 'TEST2', 'test3', 'test1', 0, '2019-10-06 00:52:27');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- Indexes for table `product_warehouses`
--
ALTER TABLE `product_warehouses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permissions`
--
ALTER TABLE `role_permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_ins`
--
ALTER TABLE `stock_ins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_in_details`
--
ALTER TABLE `stock_in_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_outs`
--
ALTER TABLE `stock_outs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `stock_out_details`
--
ALTER TABLE `stock_out_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `warehouses`
--
ALTER TABLE `warehouses`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `code` (`code`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` tinyint(4) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `product_warehouses`
--
ALTER TABLE `product_warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `role_permissions`
--
ALTER TABLE `role_permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `stock_ins`
--
ALTER TABLE `stock_ins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `stock_in_details`
--
ALTER TABLE `stock_in_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `stock_outs`
--
ALTER TABLE `stock_outs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `stock_out_details`
--
ALTER TABLE `stock_out_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `warehouses`
--
ALTER TABLE `warehouses`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
