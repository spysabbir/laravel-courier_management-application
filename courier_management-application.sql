-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 23, 2024 at 01:28 PM
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
-- Database: `courier_management-application`
--

-- --------------------------------------------------------

--
-- Table structure for table `about_us`
--

CREATE TABLE `about_us` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `headline` text NOT NULL,
  `description` longtext NOT NULL,
  `about_photo` varchar(255) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `about_us`
--

INSERT INTO `about_us` (`id`, `headline`, `description`, `about_photo`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'On-time Delivery and Customer Satisfaction 1', 'On-time Delivery and Customer Satisfaction On-time Delivery and Customer Satisfaction 1', 'About-Photo.png', 1, 1, '2023-05-21 22:51:38', '2023-05-22 00:19:18');

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
(1, 'Dhaka Branch', 'dhakabranch@email.com', '01878136530', 'Dhaka, BD', 'Active', 1, NULL, NULL, '2023-05-14 22:45:17', '2023-05-14 22:45:17', NULL),
(2, 'Khulna Branch', 'khulnabranch@email.com', '01878136530', 'Khulna, Branch', 'Active', 1, NULL, NULL, '2023-05-14 22:45:42', '2023-05-14 22:45:42', NULL);

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
(1, 'Spy IT', 'Sovon Khan', 'sovon@email.com', '01878136530', 'Dhaka, BD', 'http://spyit.com', 'spy-it.jpg', 'Active', 1, 1, NULL, '2023-05-14 22:49:42', '2023-05-14 22:55:02', NULL);

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
(1, '2', 20.00, 'Active', 1, NULL, NULL, '2023-05-14 22:46:39', '2023-05-14 22:46:39', NULL),
(2, '4', 30.00, 'Active', 1, NULL, NULL, '2023-05-14 22:48:41', '2023-05-14 22:48:41', NULL),
(3, '1', 50.00, 'Active', 1, NULL, NULL, '2023-05-14 22:48:50', '2023-05-14 22:48:50', NULL),
(4, '5', 80.00, 'Active', 1, NULL, NULL, '2023-05-14 22:48:56', '2023-05-14 22:48:56', NULL);

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
(1, 1, 'Test', 1, 5, 20.00, 100.00),
(2, 2, 'sdf', 2, 1, 30.00, 30.00);

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
(1, 200523738, 'Company', 1, 'Spy IT', 'sovon@email.com', '01878136530', 'Dhaka, BD', 2, 'Sabbir', 'sabbirahammedsovon@gmail.com', '01953321402', 'Khulna', 'Test', 100.00, 'Sender Payment', 'Paid', 100.00, 'Delivered', 7, 6, 74211, '2023-05-20 04:23:34', '2023-05-20 04:56:30'),
(2, 200523489, 'Individual', 2, 'Spy IT', 'sovon@email.com', '01878136530', 'dsff', 1, 'Sabbir', NULL, '01953321402', 'sdfsd', 'sdff', 30.00, 'Receiver Payment', 'Paid', 30.00, 'Delivered', 6, 5, 26722, '2023-05-20 04:24:29', '2023-05-20 04:55:07');

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
(1, 'Spy Courier', 'http://127.0.0.1:8000', 'UTC', 'default_favicon.png', 'default_logo_photo.png', '01878136530', '01878136530', 'info@courier.com', 'support@courier.com', 'Dhaka, BD', '<iframe src=\"https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d116834.13673771221!2d90.41928169999998!3d23.780636450000003!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3755b8b087026b81%3A0x8fa563bbdd5904c2!2sDhaka!5e0!3m2!1sen!2sbd!4v1684726021424!5m2!1sen!2sbd\" width=\"600\" height=\"450\" style=\"border:0;\" allowfullscreen=\"\" loading=\"lazy\" referrerpolicy=\"no-referrer-when-downgrade\"></iframe>', 'courier', 'courier', 'courier', 'courier', 'courier', 1, 1, '2023-05-15 04:14:42', '2023-05-21 21:28:54');

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
(1, 'smtp', 'sandbox.smtp.mailtrap.io', '2525', '071aa50653a80d', '8dd8b67f9819e0', 'tls', 'info@gmail.com', 1, 1, '2023-05-15 04:14:42', '2023-05-14 22:25:51');

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
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2023_02_28_174955_create_branches_table', 1),
(6, '2023_03_07_045824_create_units_table', 1),
(7, '2023_03_07_063929_create_costs_table', 1),
(8, '2023_03_24_091341_create_testimonials_table', 1),
(9, '2023_03_24_091818_create_services_table', 1),
(10, '2023_03_27_051111_create_companies_table', 1),
(11, '2023_03_27_094052_create_default_settings_table', 1),
(12, '2023_03_27_094255_create_mail_settings_table', 1),
(13, '2023_03_27_094347_create_sms_settings_table', 1),
(14, '2023_03_28_064600_create_contact_messages_table', 1),
(15, '2023_03_28_100719_create_courier_summaries_table', 1),
(16, '2023_03_28_101117_create_courier_details_table', 1),
(17, '2023_05_22_044456_create_about_us_table', 2),
(18, '2023_05_22_045620_create_privacy_policies_table', 3),
(19, '2023_05_22_050044_create_terms_of_services_table', 4);

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
-- Table structure for table `privacy_policies`
--

CREATE TABLE `privacy_policies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `headline` text NOT NULL,
  `description` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `privacy_policies`
--

INSERT INTO `privacy_policies` (`id`, `headline`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'On-time Delivery and Customer Satisfaction 1', 'On-time Delivery and Customer Satisfaction 1', 1, 1, '2023-05-21 22:57:35', '2023-05-22 00:04:29');

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
(1, 'Service 1', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'service-1.png', 'Active', 1, NULL, NULL, '2023-05-14 22:57:43', NULL, NULL),
(2, 'Service 2', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'service-2.png', 'Active', 1, NULL, NULL, '2023-05-14 22:57:59', NULL, NULL),
(3, 'Service 3', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'service-3.png', 'Active', 1, NULL, NULL, '2023-05-14 22:58:09', NULL, NULL),
(4, 'Service 4', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'service-4.png', 'Active', 1, NULL, NULL, '2023-05-14 22:58:21', NULL, NULL),
(5, 'Service 5', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'service-5.png', 'Active', 1, NULL, NULL, '2023-05-14 22:58:34', NULL, NULL),
(6, 'Service 6', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'service-6.png', 'Active', 1, NULL, NULL, '2023-05-14 22:58:44', NULL, NULL);

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
(1, 'VjkIEblFGYFP7yH5NyOk', '8809601004416', 1, 1, '2023-05-15 04:14:42', '2023-05-14 22:25:56');

-- --------------------------------------------------------

--
-- Table structure for table `terms_of_services`
--

CREATE TABLE `terms_of_services` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `headline` text NOT NULL,
  `description` longtext NOT NULL,
  `created_by` int(11) NOT NULL,
  `updated_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `terms_of_services`
--

INSERT INTO `terms_of_services` (`id`, `headline`, `description`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
(1, 'On-time Delivery and Customer Satisfaction 1', 'On-time Delivery and Customer Satisfaction 1', 1, 1, '2023-05-21 23:20:48', '2023-05-22 00:08:33');

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
(1, 'Sovon', 'CEO', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'Active', 1, NULL, NULL, '2023-05-14 22:59:35', '2023-05-14 22:59:35', NULL),
(2, 'Alif', 'Founder', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'Active', 1, NULL, NULL, '2023-05-14 22:59:58', '2023-05-14 22:59:58', NULL),
(3, 'Shahariya', 'Co-founder', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'Active', 1, NULL, NULL, '2023-05-14 23:00:13', '2023-05-14 23:00:13', NULL),
(4, 'Sabbir', 'Manager', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Atque repudiandae non eligendi sint laborum ab at dolores quia dolore iure totam iste, voluptatem placeat ea fugiat porro doloribus. Qui aliquid magni, non delectus molestiae earum cupiditate odio in amet? Quo esse saepe ipsam inventore, odio tempora itaque nam blanditiis aliquam!', 'Active', 1, NULL, NULL, '2023-05-14 23:00:26', '2023-05-14 23:00:26', NULL);

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
(1, '1 Kg', 'Active', 1, 1, NULL, '2023-05-14 22:46:08', '2023-05-14 22:47:04', NULL),
(2, '250 Gram', 'Active', 1, 1, NULL, '2023-05-14 22:46:14', '2023-05-14 22:46:49', NULL),
(3, 'Letter', 'Active', 1, 1, NULL, '2023-05-14 22:46:18', '2023-05-14 22:48:23', NULL),
(4, '500 Gram', 'Active', 1, NULL, NULL, '2023-05-14 22:46:57', '2023-05-14 22:46:57', NULL),
(5, '2 Kg', 'Active', 1, NULL, NULL, '2023-05-14 22:47:13', '2023-05-14 22:47:13', NULL);

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
(1, 'Super Admin', 'superadmin@email.com', '$2y$10$gfXTDxamlHRqQrbipcQUfu3gWT7WKzc.suB9BMK0f9yDL41OS0KIO', '01953321402', 'Male', '2023-05-15', 'Dhaka, BD', 'default_profile_photo.png', '2024-03-27 23:31:13', 'Super Admin', NULL, 'Active', 'axmHR1dXiaU1M9iPFHDuSW8HMo8lFFtaSn1CZVTeJfwOHzCT455fQQTmwoCJ', '2023-05-15 04:14:42', '2024-03-27 23:31:13'),
(2, 'Admin', 'admin@email.com', '$2y$10$0yFx6jO3aoOGwY5SqUcoxOOeTiSLe79Of23fcRAD2u70Gzebc2HGi', '01878136530', 'Male', '2023-05-15', 'Jessore, BD', 'default_profile_photo.png', '2024-03-27 23:31:56', 'Admin', NULL, 'Active', 'DV0x3lgnjOjmwian2I5NEuCGwubNDOqAagMBeWLSbL6pwqxoQ89hYI4Qgf1r', '2023-05-15 04:14:42', '2024-03-27 23:31:56'),
(3, 'Manager 1', 'manager1@email.com', '$2y$10$ZxntK5.zQjd.mZAG/rN3e.ONZUTzBEL6LTEhxXDrJWREYTmBdyPoO', '01878136530', 'Male', '2023-05-15', 'Dhaka, BD', 'default_profile_photo.png', '2024-03-27 23:32:28', 'Manager', 1, 'Active', NULL, '2023-05-15 04:14:42', '2024-03-27 23:32:28'),
(4, 'Manager 2', 'manager2@email.com', '$2y$10$Yv3fBtgfo9WNunTVzMSIietB9bEqX7mhFelN40PK3WWy1hisp5N9i', '01878136530', 'Male', '2023-05-15', 'Khulna, BD', 'default_profile_photo.png', '2023-12-04 23:19:24', 'Manager', 2, 'Active', NULL, '2023-05-15 04:14:42', '2023-12-04 23:19:24'),
(5, 'Staff 1', 'staff1@email.com', '$2y$10$BtzkUCp6mk6Z8D2Bv9MLd.5b7yWR/ZoqpSddVRHsrq50JTFUUEcmu', '01878136530', 'Male', '2023-05-15', 'Dhaka, BD', 'default_profile_photo.png', '2024-03-27 23:32:49', 'Staff', 1, 'Active', 'bnF2S2jRt0URZCrKjmew2XzE6g4sUqt32AjFqZwZQZOxiJLRiF1RaVnQyYew', '2023-05-15 04:14:42', '2024-03-27 23:32:49'),
(6, 'Staff 2', 'staff2@email.com', '$2y$10$g1suCd7rijpTTOM0xeUBzeP0ElpvRceIYXeADRBplpQZGWGS.G0g.', '01878136530', 'Male', '2023-05-15', 'Khulna, BD', 'default_profile_photo.png', '2023-12-04 23:17:51', 'Staff', 2, 'Active', NULL, '2023-05-15 04:14:42', '2023-12-04 23:17:51'),
(7, 'Sabbir', 'staffsabbir@email.com', '$2y$10$XBmGgtwRKRbZdnQcK3c6BecqW8WSV7KrWtSgPfe/EOOYohTflolq2', '01878136530', NULL, NULL, 'Dhaka BD', 'default_profile_photo.png', '2023-05-20 04:23:44', 'Staff', 1, 'Active', 'Yyk3rSOkJQRw4KjOi5BihoMHyRFxZheZsP4uYFOJdwbxwYklrzpMGpAV0X1p', '2023-05-20 04:13:12', '2023-05-20 04:23:44'),
(8, 'Md Sabbir Ahammed', 'staff3@email.com', '$2y$10$QDpRONaGpTn0hIEdCQm2M.RSFbsfcRwoSu/cHbD8CGm3jjfJgiRm.', '01878136530', NULL, NULL, 'DDD', 'default_profile_photo.png', '2023-05-20 10:18:30', 'Staff', 1, 'Active', NULL, '2023-05-20 04:18:30', '2023-05-20 04:18:30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `about_us`
--
ALTER TABLE `about_us`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `terms_of_services`
--
ALTER TABLE `terms_of_services`
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
-- AUTO_INCREMENT for table `about_us`
--
ALTER TABLE `about_us`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

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
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `costs`
--
ALTER TABLE `costs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courier_details`
--
ALTER TABLE `courier_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `privacy_policies`
--
ALTER TABLE `privacy_policies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `services`
--
ALTER TABLE `services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `sms_settings`
--
ALTER TABLE `sms_settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `terms_of_services`
--
ALTER TABLE `terms_of_services`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `testimonials`
--
ALTER TABLE `testimonials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

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
