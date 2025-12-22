-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 22, 2025 at 02:28 PM
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
-- Database: `fumboerp`
--

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `subject` varchar(200) DEFAULT NULL,
  `message` text NOT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `status` enum('new','read','replied','archived') DEFAULT 'new',
  `created_at` datetime DEFAULT current_timestamp(),
  `replied_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`id`, `name`, `email`, `phone`, `company`, `subject`, `message`, `ip_address`, `status`, `created_at`, `replied_at`) VALUES
(1, 'James Nyongesa Wekesa', 'jamesweks2019@gmail.com', '0723007834', 'Pamoja', 'TEst', 'It is a test!', '::1', 'new', '2025-12-20 18:44:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `demo_requests`
--

CREATE TABLE `demo_requests` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `employees` int(11) DEFAULT NULL,
  `industry` varchar(100) DEFAULT NULL,
  `preferred_date` date DEFAULT NULL,
  `message` text DEFAULT NULL,
  `status` enum('pending','scheduled','completed') DEFAULT 'pending',
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `slug` varchar(100) NOT NULL,
  `icon` varchar(50) DEFAULT NULL,
  `short_desc` varchar(200) DEFAULT NULL,
  `full_desc` text DEFAULT NULL,
  `features` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`features`)),
  `display_order` int(11) DEFAULT 0,
  `is_active` tinyint(1) DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `modules`
--

INSERT INTO `modules` (`id`, `name`, `slug`, `icon`, `short_desc`, `full_desc`, `features`, `display_order`, `is_active`, `created_at`) VALUES
(1, 'Accounting & Finance', 'financial', '💰', 'Track income, expenses, and financial ', 'Comprehensive financial tools for real-time tracking of all monetary transactions, automated invoicing, and financial reporting.', '[\"Expense Tracking\", \"Invoice Generation\", \"Cash Flow Analysis\", \"Tax Calculations\"]', 1, 1, '2025-12-20 13:47:01'),
(2, 'Inventory', 'inventory', '📦', 'Manage stock levels and orders', 'Monitor inventory levels across multiple warehouses, set reorder points, and track item movement.', '[\"Stock Tracking\", \"Auto Reordering\", \"Multi-location\", \"Barcode Support\"]', 2, 1, '2025-12-20 13:47:01'),
(3, 'Human Resources', 'hr', '👥', 'Oversee: Employees records and payrolls', 'Streamline HR processes from recruitment to retirement with automated workflows.', '[\"Employee Database\", \"Payroll Processing\", \"Leave Management\", \"Performance Reviews\"]', 3, 1, '2025-12-20 13:47:01'),
(4, 'CRM', 'crm', '🤝', 'Customer relationship management and sales pipeline', 'Manage customer interactions, track leads, and automate follow-ups for increased sales.', '[\"Lead Management\", \"Customer Database\", \"Sales Pipeline\", \"Communication Logs\"]', 4, 1, '2025-12-20 13:47:01'),
(5, 'Project Management', 'projects', '📋', 'Plan, track, and collaborate on projects efficiently', 'Assign tasks, set deadlines, and monitor project progress with Gantt charts and reports.', '[\"Task Assignment\", \"Gantt Charts\", \"Time Tracking\", \"Milestone Tracking\"]', 5, 1, '2025-12-20 13:47:01'),
(9, 'Tax Management', 'tax', '🏷️', 'Manage taxes and tax rates', 'Configure and apply taxes to transactions.', '[\"Tax Rates\", \"Automatic Tax Calculation\", \"Tax Reports\"]', 6, 1, '2025-12-22 10:58:38');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` int(11) NOT NULL,
  `client_name` varchar(100) NOT NULL,
  `company` varchar(100) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `content` text NOT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `avatar` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT 0,
  `display_order` int(11) DEFAULT 0,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `client_name`, `company`, `position`, `content`, `rating`, `avatar`, `is_featured`, `display_order`, `created_at`) VALUES
(1, 'Sarah Mungai', 'TechGrow Inc.', 'Operations Director', 'FUMBO ERP transformed our business operations. The inventory module alone saved us 20 hours per week!', 5, NULL, 1, 1, '2025-12-20 13:47:01'),
(2, 'Michael Kipkemoi', 'RetailPlus', 'CFO', 'Financial reporting that used to take days now takes hours. The dashboards are incredibly intuitive.', 4, NULL, 1, 2, '2025-12-20 13:47:01'),
(3, 'David Oduor', 'ManufacturePro', 'CEO', 'We scaled from 50 to 200 employees seamlessly thanks to the HR and project modules. Highly recommended!', 5, NULL, 1, 3, '2025-12-20 13:47:01');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `full_name` varchar(100) DEFAULT NULL,
  `company_name` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `avatar` varchar(255) DEFAULT NULL,
  `is_trial_active` tinyint(1) DEFAULT 1,
  `trial_start_date` datetime DEFAULT current_timestamp(),
  `trial_end_date` datetime DEFAULT (current_timestamp() + interval 14 day),
  `subscription_plan` enum('trial','basic','premium','enterprise') DEFAULT 'trial',
  `account_status` enum('active','suspended','cancelled') DEFAULT 'active',
  `created_at` datetime DEFAULT current_timestamp(),
  `last_login` datetime DEFAULT NULL,
  `reset_token` varchar(100) DEFAULT NULL,
  `reset_expiry` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password_hash`, `full_name`, `company_name`, `phone`, `avatar`, `is_trial_active`, `trial_start_date`, `trial_end_date`, `subscription_plan`, `account_status`, `created_at`, `last_login`, `reset_token`, `reset_expiry`) VALUES
(1, 'jameswekesa002@gmail.com', '$2y$10$qbivvydNHF0kAfdibnB9jO47P8TQSLV5wuEUcf6b2ynoP3vobWz4G', 'James wekesa', 'CORTECH SYSTEMS', '0723007834', NULL, 1, '2025-12-20 14:21:55', '2026-01-03 14:21:55', 'trial', 'active', '2025-12-20 14:21:55', '2025-12-20 14:21:55', '7489f1b595eb7047300b5ee2472e2533763f7af7260a60349e7fc9945cdcc366', '2025-12-22 14:17:57'),
(2, 'jamesweks2019@gmail.com', '$2y$10$/whb9RtbZKUGYyYWDvY9KOT7aJcdSUf0F1QX0PS7/0moAfC4Q5zxq', 'James wekesa', 'CORTECH SYSTEMS', '0723007834', NULL, 1, '2025-12-22 14:26:16', '2026-01-05 14:26:16', 'trial', 'active', '2025-12-22 14:26:16', '2025-12-22 14:26:16', 'b14aff511c559634ee430c58e6560a2e64f5c11d98edd5e25b6408291ddbb1e8', '2025-12-22 14:13:08');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `demo_requests`
--
ALTER TABLE `demo_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `demo_requests`
--
ALTER TABLE `demo_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
