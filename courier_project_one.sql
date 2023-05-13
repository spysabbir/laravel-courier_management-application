-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2023 at 02:11 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `courier_project_one`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_email` varchar(255) NOT NULL,
  `branch_phone_number` varchar(255) NOT NULL,
  `branch_address` text NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `branch_name`, `branch_email`, `branch_phone_number`, `branch_address`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Dhaka Branch', 'dhaka@email.com', '01517805999', 'Dhaka, BD', 'Active', 2, 2, NULL, '2023-05-03 06:08:48', '2023-05-03 06:11:01', NULL),
(2, 'Jessore Branch', 'jessore@email.com', '01878136530', 'Jessore, BD', 'Active', 2, NULL, NULL, '2023-05-03 08:56:28', '2023-05-03 08:56:28', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) NOT NULL,
  `company_owner` varchar(255) NOT NULL,
  `company_email` varchar(255) NOT NULL,
  `company_phone_number` varchar(255) NOT NULL,
  `company_address` text NOT NULL,
  `company_url` varchar(255) NOT NULL,
  `company_photo` varchar(255) NOT NULL DEFAULT 'default_company_photo.jpg',
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `companies`
--

INSERT INTO `companies` (`id`, `company_name`, `company_owner`, `company_email`, `company_phone_number`, `company_address`, `company_url`, `company_photo`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Spy It', 'Sabbir', 'spyit@email.com', '01517805999', 'Dhaka', 'http://www.spyit.com', 'default_company_photo.jpg', 'Active', 2, 2, NULL, '2023-05-03 06:30:43', '2023-05-03 06:35:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contact_messages`
--

CREATE TABLE `contact_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL,
  `subject` text NOT NULL,
  `message` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Unread',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `contact_messages`
--

INSERT INTO `contact_messages` (`id`, `name`, `email`, `phone_number`, `subject`, `message`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Sabbir', 'sabbirahammed@gmail.com', '01845784525', 'Test', 'TestTestTestTestTest', 'Read', '2023-05-03 06:43:17', '2023-05-03 06:43:36');

-- --------------------------------------------------------

--
-- Table structure for table `costs`
--

CREATE TABLE `costs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_id` varchar(255) NOT NULL,
  `cost_rate` double(8,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `costs`
--

INSERT INTO `costs` (`id`, `unit_id`, `cost_rate`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, '1', 25.00, 'Active', 2, NULL, NULL, '2023-05-03 06:24:37', '2023-05-03 06:24:37', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `courier_details`
--

CREATE TABLE `courier_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `courier_summary_id` bigint(20) UNSIGNED NOT NULL,
  `item_description` text NOT NULL,
  `unit_id` int(11) NOT NULL,
  `item_quantity` int(11) NOT NULL,
  `cost_rate` double(8,2) NOT NULL,
  `total_cost_rate` double(8,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courier_details`
--

INSERT INTO `courier_details` (`id`, `courier_summary_id`, `item_description`, `unit_id`, `item_quantity`, `cost_rate`, `total_cost_rate`) VALUES
(1, 1, 'Item1', 1, 1, 25.00, 25.00),
(2, 1, 'Item2', 1, 2, 25.00, 50.00),
(3, 2, 'Item3', 1, 2, 25.00, 50.00),
(4, 2, 'Item4', 1, 2, 25.00, 50.00);

-- --------------------------------------------------------

--
-- Table structure for table `courier_summaries`
--

CREATE TABLE `courier_summaries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tracking_id` int(11) NOT NULL,
  `sender_type` varchar(255) NOT NULL,
  `sender_branch_id` int(11) NOT NULL,
  `sender_name` varchar(255) NOT NULL,
  `sender_email` varchar(255) DEFAULT NULL,
  `sender_phone_number` varchar(255) NOT NULL,
  `sender_address` text NOT NULL,
  `receiver_branch_id` int(11) NOT NULL,
  `receiver_name` varchar(255) NOT NULL,
  `receiver_email` varchar(255) DEFAULT NULL,
  `receiver_phone_number` varchar(255) NOT NULL,
  `receiver_address` text NOT NULL,
  `special_comment` longtext DEFAULT NULL,
  `grand_total` double(8,2) NOT NULL,
  `payment_type` varchar(255) NOT NULL,
  `payment_status` varchar(255) NOT NULL DEFAULT 'Unpaid',
  `payment_amount` double(8,2) DEFAULT NULL,
  `courier_status` varchar(255) NOT NULL DEFAULT 'Processing',
  `sender_agent_id` int(11) NOT NULL,
  `delivery_agent_id` int(11) DEFAULT NULL,
  `otp` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `courier_summaries`
--

INSERT INTO `courier_summaries` (`id`, `tracking_id`, `sender_type`, `sender_branch_id`, `sender_name`, `sender_email`, `sender_phone_number`, `sender_address`, `receiver_branch_id`, `receiver_name`, `receiver_email`, `receiver_phone_number`, `receiver_address`, `special_comment`, `grand_total`, `payment_type`, `payment_status`, `payment_amount`, `courier_status`, `sender_agent_id`, `delivery_agent_id`, `otp`, `created_at`, `updated_at`) VALUES
(1, 30523745, 'Individual', 1, 'Sovon', NULL, '01953321402', 'Dhaka', 2, 'Sabbir', NULL, '01517805999', 'Jessore', 'Test', 75.00, 'Sender Payment', 'Paid', 75.00, 'Shipped', 5, NULL, 46051, '2023-05-03 10:13:39', '2023-05-03 12:00:27'),
(2, 30523356, 'Company', 2, 'Spy It', 'spyit@email.com', '01517805999', 'Dhaka', 1, 'Sovon', NULL, '01517805999', 'Dhaka', NULL, 100.00, 'Receiver Payment', 'Paid', 0.00, 'Delivered', 6, 5, 99312, '2023-05-03 10:16:30', '2023-05-03 12:03:20');

-- --------------------------------------------------------

--
-- Table structure for table `default_settings`
--

CREATE TABLE `default_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `app_name` varchar(255) NOT NULL DEFAULT 'Laravel',
  `app_url` varchar(255) NOT NULL DEFAULT 'http://127.0.0.1:8000/',
  `time_zone` varchar(255) NOT NULL DEFAULT 'UTC',
  `favicon` varchar(255) NOT NULL DEFAULT 'default_favicon.png',
  `logo_photo` varchar(255) NOT NULL DEFAULT 'default_logo_photo.png',
  `main_phone` varchar(255) DEFAULT NULL,
  `support_phone` varchar(255) DEFAULT NULL,
  `main_email` varchar(255) DEFAULT NULL,
  `support_email` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `google_map_link` text DEFAULT NULL,
  `facebook_link` varchar(255) DEFAULT NULL,
  `twitter_link` varchar(255) DEFAULT NULL,
  `instagram_link` varchar(255) DEFAULT NULL,
  `linkedin_link` varchar(255) DEFAULT NULL,
  `youtube_link` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `default_settings`
--

INSERT INTO `default_settings` (`id`, `app_name`, `app_url`, `time_zone`, `favicon`, `logo_photo`, `main_phone`, `support_phone`, `main_email`, `support_email`, `address`, `google_map_link`, `facebook_link`, `twitter_link`, `instagram_link`, `linkedin_link`, `youtube_link`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'Laravel', 'http://127.0.0.1:8000', 'Asia/Dhaka', 'default_favicon.png', 'default_logo_photo.png', '01953321402', '01953321402', 'info@email.com', 'support@email.com', 'Dhaka, BD', NULL, NULL, NULL, NULL, NULL, NULL, 1, 1, '2023-05-03 04:57:15', '2023-05-02 23:45:17');

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
-- Table structure for table `mail_settings`
--

CREATE TABLE `mail_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `mailer` varchar(255) NOT NULL,
  `host` varchar(255) NOT NULL,
  `port` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `encryption` varchar(255) NOT NULL,
  `from_address` varchar(255) NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail_settings`
--

INSERT INTO `mail_settings` (`id`, `mailer`, `host`, `port`, `username`, `password`, `encryption`, `from_address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'smtp', 'sandbox.smtp.mailtrap.io', '2525', '071aa50653a80d', '8dd8b67f9819e0', 'tls', 'info@gmail.com', 1, 1, '2023-05-03 04:57:15', '2023-05-03 05:56:09');

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
(97, '2014_10_12_000000_create_users_table', 1),
(98, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(99, '2019_08_19_000000_create_failed_jobs_table', 1),
(100, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(101, '2023_02_28_174955_create_branches_table', 1),
(102, '2023_03_07_045824_create_units_table', 1),
(103, '2023_03_07_063929_create_costs_table', 1),
(104, '2023_03_24_091341_create_testimonials_table', 1),
(105, '2023_03_24_091818_create_services_table', 1),
(106, '2023_03_27_051111_create_companies_table', 1),
(107, '2023_03_27_094052_create_default_settings_table', 1),
(108, '2023_03_27_094255_create_mail_settings_table', 1),
(109, '2023_03_27_094347_create_sms_settings_table', 1),
(110, '2023_03_28_064600_create_contact_messages_table', 1),
(111, '2023_03_28_100719_create_courier_summaries_table', 1),
(112, '2023_03_28_101117_create_courier_details_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `services`
--

CREATE TABLE `services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `service_name` varchar(255) NOT NULL,
  `service_details` text NOT NULL,
  `service_photo` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `services`
--

INSERT INTO `services` (`id`, `service_name`, `service_details`, `service_photo`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Test 1', 'Test 1', 'test-1.png', 'Active', 2, NULL, NULL, '2023-05-03 06:36:23', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sms_settings`
--

CREATE TABLE `sms_settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `api_key` text NOT NULL,
  `sender_id` text NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sms_settings`
--

INSERT INTO `sms_settings` (`id`, `api_key`, `sender_id`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'VjkIEblFGYFP7yH5NyOk', '8809601004416', 1, 1, '2023-05-03 04:57:15', '2023-05-03 05:58:34');

-- --------------------------------------------------------

--
-- Table structure for table `testimonials`
--

CREATE TABLE `testimonials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `testimonial_author_name` varchar(255) NOT NULL,
  `testimonial_author_title` varchar(255) NOT NULL,
  `testimonial_content` longtext NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `testimonials`
--

INSERT INTO `testimonials` (`id`, `testimonial_author_name`, `testimonial_author_title`, `testimonial_content`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'Sabbir Saba', 'Owner', 'Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test Test', 'Active', 2, NULL, NULL, '2023-05-03 06:38:56', '2023-05-03 06:38:56', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `unit_name` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `deleted_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `deleted_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `unit_name`, `status`, `created_by`, `updated_by`, `deleted_by`, `created_at`, `updated_at`, `deleted_at`) VALUES
(1, 'KG', 'Active', 2, NULL, NULL, '2023-05-03 06:24:21', '2023-05-03 06:24:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `phone_number` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` text DEFAULT NULL,
  `profile_photo` varchar(255) NOT NULL DEFAULT 'default_profile_photo.png',
  `last_active` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` varchar(255) NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'Active',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `phone_number`, `gender`, `date_of_birth`, `address`, `profile_photo`, `last_active`, `role`, `branch_id`, `status`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Super Admin', 'superadmin@email.com', '$2y$10$t6gigB.BSeSMMFZ3gXd6M.ev37Qc2gpxVOd7m.eW0pUj26WC9AWkm', '01953321402', 'Male', '2023-05-03', 'Dhaka, BD', 'default_profile_photo.png', '2023-05-03 06:02:54', 'Super Admin', NULL, 'Active	', NULL, '2023-05-03 04:57:15', '2023-05-03 06:02:54'),
(2, 'Admin', 'admin@email.com', '$2y$10$JGckDhq55xZGgrQbzcyK1O0jqj.gJmQoiLuvyYDrlMzx7rW4mgcI2', '01953321402', 'Male', '2023-05-03', 'Dhaka, BD', 'default_profile_photo.png', '2023-05-03 10:08:49', 'Admin', NULL, 'Active	', NULL, '2023-05-03 04:57:15', '2023-05-03 10:08:49'),
(3, 'Manager 1', 'manager1@email.com', '$2y$10$n3kbKCcfLzO2HC2b9icfX.vJRXQOEYRTskNu0T8HQYl2VHRPgQS9W', '01878136530', 'Male', '2023-05-03', 'Dhaka, Bd', 'default_profile_photo.png', '2023-05-03 12:01:07', 'Manager', 1, 'Active', NULL, '2023-05-03 04:57:15', '2023-05-03 12:01:07'),
(4, 'Manager 2', 'manager2@email.com', '$2y$10$YmOvnZWFI2p2YrSq6WQIdefOOExx1.du3log5fhb.k2EbdW2yZTfe', '01878136530', 'Male', '2023-05-03', 'Dhaka, BD', 'default_profile_photo.png', '2023-05-03 12:00:19', 'Manager', 2, 'Active', NULL, '2023-05-03 04:57:15', '2023-05-03 12:00:19'),
(5, 'Staff 1', 'staff1@email.com', '$2y$10$8VgwWINJejlk6yT5B5uK1OfXPmpGOHAPAhYDQApQCwt69.iMIv3T.', '01953321402', 'Male', '2023-05-03', 'Dhaka, BD', 'default_profile_photo.png', '2023-05-03 12:09:34', 'Staff', 1, 'Active', NULL, '2023-05-03 04:57:15', '2023-05-03 12:09:34'),
(6, 'Staff 2', 'staff2@email.com', '$2y$10$LFKIs.h38xUn871IjN8so.DYAGTzTVfU8s/pk6FPMkZf3zNU.74.K', NULL, NULL, NULL, NULL, 'default_profile_photo.png', '2023-05-03 10:14:13', 'Staff', 2, 'Active', NULL, '2023-05-03 04:57:15', '2023-05-03 10:14:13');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `contact_messages`
--
ALTER TABLE `contact_messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `costs`
--
ALTER TABLE `costs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courier_details`
--
ALTER TABLE `courier_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `courier_details_courier_summary_id_foreign` (`courier_summary_id`);

--
-- Indexes for table `courier_summaries`
--
ALTER TABLE `courier_summaries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `default_settings`
--
ALTER TABLE `default_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `mail_settings`
--
ALTER TABLE `mail_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `services`
--
ALTER TABLE `services`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sms_settings`
--
ALTER TABLE `sms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `testimonials`
--
ALTER TABLE `testimonials`
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
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `contact_messages`
--
ALTER TABLE `contact_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `courier_details`
--
ALTER TABLE `courier_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courier_summaries`
--
ALTER TABLE `courier_summaries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `default_settings`
--
ALTER TABLE `default_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `mail_settings`
--
ALTER TABLE `mail_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=113;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `courier_details`
--
ALTER TABLE `courier_details`
  ADD CONSTRAINT `courier_details_courier_summary_id_foreign` FOREIGN KEY (`courier_summary_id`) REFERENCES `courier_summaries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
