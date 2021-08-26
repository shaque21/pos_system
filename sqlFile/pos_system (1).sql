-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 10, 2021 at 05:11 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 7.4.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pos_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `companies`
--

CREATE TABLE `companies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Roshans Shop',
  `company_address` text COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Roshans Shop',
  `company_phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+8801627309821',
  `company_email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'roshans.shop@gmail.com',
  `company_fax` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '+880265789561',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2021_03_13_055638_create_orders_table', 1),
(5, '2021_03_13_055729_create_order_details_table', 1),
(6, '2021_03_13_055850_create_products_table', 1),
(7, '2021_03_13_055916_create_suppliers_table', 1),
(8, '2021_03_13_060005_create_transactions_table', 1),
(9, '2021_03_13_060040_create_companies_table', 2),
(10, '2021_03_13_060122_create_settings_table', 2),
(11, '2021_04_09_215338_create_user_roles_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `name`, `mobile`, `created_at`, `updated_at`) VALUES
(1, 'Samsul Haque', '01627309821', '2021-03-26 12:08:29', '2021-03-26 12:08:29'),
(2, NULL, NULL, '2021-03-26 12:46:12', '2021-03-26 12:46:12'),
(3, 'Osama Sharif', NULL, '2021-03-26 12:48:17', '2021-03-26 12:48:17'),
(5, 'Jafrin', NULL, '2021-03-27 17:09:58', '2021-03-27 17:09:58'),
(7, 'Mayen', NULL, '2021-03-27 17:52:05', '2021-03-27 17:52:05'),
(8, NULL, NULL, '2021-03-27 18:59:31', '2021-03-27 18:59:31'),
(9, NULL, NULL, '2021-03-27 19:06:22', '2021-03-27 19:06:22'),
(13, 'Samsul Haque', '01627309821', '2021-04-06 17:42:47', '2021-04-06 17:42:47'),
(14, 'Osama Sharif', '01627309821', '2021-04-06 17:43:59', '2021-04-06 17:43:59'),
(15, 'Kayser Uddin', '--', '2021-04-08 01:29:57', '2021-04-08 01:29:57'),
(16, 'Samsul Haque', '01627309821', '2021-04-08 02:36:09', '2021-04-08 02:36:09'),
(17, 'Kayser Uddin', '--', '2021-04-08 03:05:13', '2021-04-08 03:05:13'),
(18, 'Samsul Haque', '01627309821', '2021-04-08 10:06:42', '2021-04-08 10:06:42'),
(19, 'Happy', '--', '2021-04-08 10:09:54', '2021-04-08 10:09:54'),
(20, 'Samsul Haque', '01627309821', '2021-04-08 10:10:32', '2021-04-08 10:10:32'),
(21, 'Samsul Haque', '01627309821', '2021-04-08 12:49:56', '2021-04-08 12:49:56'),
(22, 'Happy', '--', '2021-04-09 15:45:25', '2021-04-09 15:45:25'),
(23, 'Mr. X', '--', '2021-04-10 08:15:51', '2021-04-10 08:15:51'),
(24, 'Muhib', '--', '2021-04-10 08:25:57', '2021-04-10 08:25:57'),
(25, '--', '--', '2021-04-10 09:30:22', '2021-04-10 09:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` int(11) NOT NULL,
  `amount` int(11) NOT NULL,
  `discount` int(11) DEFAULT 0,
  `order_date` date NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_details`
--

INSERT INTO `order_details` (`id`, `order_id`, `product_id`, `quantity`, `unit_price`, `amount`, `discount`, `order_date`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 5, 120, 600, 0, '2021-03-26', '2021-03-26 12:08:29', '2021-03-26 12:08:29'),
(2, 1, 1, 1, 15, 15, 0, '2021-03-26', '2021-03-26 12:08:29', '2021-03-26 12:08:29'),
(3, 1, 4, 6, 50, 300, 0, '2021-03-26', '2021-03-26 12:08:29', '2021-03-26 12:08:29'),
(4, 2, 4, 1, 50, 50, 0, '2021-03-26', '2021-03-26 12:46:12', '2021-03-26 12:46:12'),
(5, 3, 2, 10, 120, 1140, 5, '2021-03-26', '2021-03-26 12:48:17', '2021-03-26 12:48:17'),
(6, 5, 1, 5, 15, 75, NULL, '2021-03-27', '2021-03-27 17:09:59', '2021-03-27 17:09:59'),
(7, 5, 3, 3, 40, 120, NULL, '2021-03-27', '2021-03-27 17:09:59', '2021-03-27 17:09:59'),
(8, 5, 6, 7, 20, 140, NULL, '2021-03-27', '2021-03-27 17:09:59', '2021-03-27 17:09:59'),
(11, 7, 1, 10, 15, 135, 10, '2021-04-27', '2021-03-27 17:52:05', '2021-03-27 17:52:05'),
(12, 7, 2, 10, 120, 960, 20, '2021-04-27', '2021-03-27 17:52:05', '2021-03-27 17:52:05'),
(13, 8, 9, 1, 10, 10, NULL, '2021-04-28', '2021-03-27 18:59:31', '2021-03-27 18:59:31'),
(14, 9, 2, 1, 120, 114, 5, '2021-03-28', '2021-03-27 19:06:22', '2021-03-27 19:06:22'),
(15, 9, 7, 1, 80, 80, NULL, '2021-03-28', '2021-03-27 19:06:22', '2021-03-27 19:06:22'),
(19, 13, 1, 5, 15, 75, NULL, '2021-04-08', '2021-04-06 17:42:47', '2021-04-06 17:42:47'),
(20, 14, 1, 10, 15, 150, NULL, '2021-04-08', '2021-04-06 17:43:59', '2021-04-06 17:43:59'),
(21, 14, 2, 2, 120, 240, NULL, '2021-04-08', '2021-04-06 17:43:59', '2021-04-06 17:43:59'),
(22, 14, 16, 2, 45, 90, NULL, '2021-04-08', '2021-04-06 17:43:59', '2021-04-06 17:43:59'),
(23, 14, 6, 5, 20, 100, NULL, '2021-04-08', '2021-04-06 17:43:59', '2021-04-06 17:43:59'),
(24, 15, 3, 5, 40, 200, NULL, '2021-04-08', '2021-04-08 01:29:57', '2021-04-08 01:29:57'),
(25, 15, 12, 10, 10, 98, 2, '2021-04-08', '2021-04-08 01:29:57', '2021-04-08 01:29:57'),
(26, 15, 4, 2, 50, 100, NULL, '2021-04-08', '2021-04-08 01:29:57', '2021-04-08 01:29:57'),
(27, 15, 15, 6, 10, 60, NULL, '2021-04-08', '2021-04-08 01:29:57', '2021-04-08 01:29:57'),
(28, 16, 2, 5, 120, 600, NULL, '2021-04-08', '2021-04-08 02:36:09', '2021-04-08 02:36:09'),
(29, 17, 1, 5, 15, 75, NULL, '2021-04-08', '2021-04-08 03:05:13', '2021-04-08 03:05:13'),
(30, 17, 16, 5, 45, 225, NULL, '2021-04-08', '2021-04-08 03:05:13', '2021-04-08 03:05:13'),
(31, 17, 12, 10, 10, 100, NULL, '2021-04-08', '2021-04-08 03:05:13', '2021-04-08 03:05:13'),
(32, 17, 15, 10, 10, 100, NULL, '2021-04-08', '2021-04-08 03:05:13', '2021-04-08 03:05:13'),
(33, 18, 1, 50, 15, 750, NULL, '2021-04-08', '2021-04-08 10:06:42', '2021-04-08 10:06:42'),
(34, 19, 1, 10, 15, 135, 10, '2021-04-08', '2021-04-08 10:09:54', '2021-04-08 10:09:54'),
(35, 20, 2, 10, 120, 1140, 5, '2021-04-08', '2021-04-08 10:10:32', '2021-04-08 10:10:32'),
(36, 21, 3, 5, 40, 200, NULL, '2021-04-08', '2021-04-08 12:49:56', '2021-04-08 12:49:56'),
(37, 21, 1, 4, 15, 60, NULL, '2021-04-08', '2021-04-08 12:49:56', '2021-04-08 12:49:56'),
(38, 21, 6, 10, 20, 190, 5, '2021-04-08', '2021-04-08 12:49:57', '2021-04-08 12:49:57'),
(39, 21, 14, 5, 45, 225, NULL, '2021-04-08', '2021-04-08 12:49:57', '2021-04-08 12:49:57'),
(40, 22, 5, 2, 55, 110, NULL, '2021-04-09', '2021-04-09 15:45:25', '2021-04-09 15:45:25'),
(41, 22, 10, 1, 75, 75, NULL, '2021-04-09', '2021-04-09 15:45:26', '2021-04-09 15:45:26'),
(42, 22, 14, 4, 45, 180, NULL, '2021-04-09', '2021-04-09 15:45:26', '2021-04-09 15:45:26'),
(43, 22, 15, 10, 10, 100, NULL, '2021-04-09', '2021-04-09 15:45:26', '2021-04-09 15:45:26'),
(44, 23, 2, 2, 120, 240, NULL, '2021-04-10', '2021-04-10 08:15:51', '2021-04-10 08:15:51'),
(45, 23, 4, 1, 50, 50, NULL, '2021-04-10', '2021-04-10 08:15:51', '2021-04-10 08:15:51'),
(46, 23, 10, 1, 75, 75, NULL, '2021-04-10', '2021-04-10 08:15:51', '2021-04-10 08:15:51'),
(47, 23, 14, 2, 45, 90, NULL, '2021-04-10', '2021-04-10 08:15:51', '2021-04-10 08:15:51'),
(48, 24, 1, 1, 15, 15, NULL, '2021-04-10', '2021-04-10 08:25:57', '2021-04-10 08:25:57'),
(49, 25, 2, 5, 120, 600, NULL, '2021-04-10', '2021-04-10 09:30:22', '2021-04-10 09:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_resets`
--

INSERT INTO `password_resets` (`email`, `token`, `created_at`) VALUES
('hshamsul894@gmail.com', '$2y$10$pPfwlxT8Y3NEZP1vlI5Mn.b8XZAySR4EdCXC3AVz2DSdE3ecsko3e', '2021-04-06 11:45:34');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `brand` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `price` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `product_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `barcode` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_img` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `alert_stock` int(11) NOT NULL DEFAULT 100,
  `product_slug` varchar(175) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `product_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `description`, `brand`, `price`, `quantity`, `product_code`, `barcode`, `product_img`, `alert_stock`, `product_slug`, `product_status`, `created_at`, `updated_at`) VALUES
(1, 'Champion Biscuits', 'Champion Biscuits from COCACOLA', 'COCACOLA', 15, 15, 'PC-104863', 'champion-biscuits-PC-104863.jpg', '1616516803.jpg', 50, 'champion-biscuits', 1, '2021-03-23 10:26:43', '2021-04-06 13:52:28'),
(2, 'Chini Gura Chal', 'Chini Gura Chal from Pran', 'Pran', 120, 26, 'PC-104011', 'chini-gura-chal-PC-104011.jpg', '1616558971-Chini Gura Chal.jpg', 20, 'chini-gura-chal', 1, '2021-03-23 10:30:08', '2021-04-06 13:52:18'),
(3, 'Frooto 500ml', 'Frooto 500ml from Pran', 'Pran', 40, 190, 'PC-100676', 'frooto-500ml-PC-100676.jpg', '1616517105.jpg', 100, 'frooto-500ml', 1, '2021-03-23 10:31:45', '2021-04-06 13:52:02'),
(4, 'Pran Toast', 'Pran Toast from Pran', 'Pran', 50, 297, 'PC-103254', 'pran-toast-PC-103254.jpg', '1616517170.jpg', 100, 'pran-toast', 1, '2021-03-23 10:32:50', '2021-04-06 13:51:51'),
(5, 'Ghee Toast', 'Ghee Toast from All Time', 'All Time', 55, 8, 'PC-102178', 'ghee-toast-PC-102178.jpg', '1616517355.jpg', 50, 'ghee-toast', 1, '2021-03-23 10:35:55', '2021-04-06 13:51:41'),
(6, 'Honey Combo', 'Honey Combo from All Time', 'All Time', 20, 35, 'PC-104471', 'honey-combo-PC-104471.jpg', '1616558934-Honey Combo.jpg', 10, 'honey-combo', 1, '2021-03-23 10:37:14', '2021-04-06 13:51:30'),
(7, 'Pran Cookes', 'Pran Cookes from Pran', 'Pran', 80, 10, 'PC-103567', 'pran-cookes-PC-103567.jpg', '1616522754.jpg', 80, 'pran-cookes', 1, '2021-03-23 12:05:54', '2021-04-06 13:51:17'),
(9, 'Pran Jhal Chanachur', 'Pran Jhal Chanachur from pran group', 'Pran', 10, 500, 'PC-102269', 'pran-jhal-chanachur-PC-102269.jpg', '1616692503.jpg', 100, 'pran-jhal-chanachur', 1, '2021-03-25 17:15:04', '2021-04-06 13:50:58'),
(10, 'pran Hot Tomato Souce', 'Lorem Ipsum is simply dummy text', 'Pran', 75, 98, 'PC-101861', 'pran-hot-tomato-souce-PC-101861.jpg', '1617083201.jpg', 50, 'pran-hot-tomato-souce', 1, '2021-03-30 05:46:41', '2021-04-06 13:50:43'),
(12, 'Pran Jhal Muri', 'Lorem Ipsum is simply dummy text of the printing and', 'Pran', 10, 480, 'PC-101295', 'pran-jhal-muri-PC-101295.jpg', '1617083642.jpg', 100, 'pran-jhal-muri', 1, '2021-03-30 05:54:02', '2021-04-06 13:54:13'),
(13, 'Pran Dal', 'Pran Dal from Pran', 'Pran', 10, 500, 'PC-102433', 'pran-dal-PC-102433.jpg', '1617085533.jpg', 100, 'pran-dal', 1, '2021-03-30 06:25:33', '2021-04-06 12:15:48'),
(14, 'Pran Milk 500ml', 'Exp Date:02.04.2021', 'Pran', 45, 39, 'PC-102421', 'pran-milk-500ml-PC-102421.jpg', '1617090243.jpg', 10, 'pran-milk-500ml', 1, '2021-03-30 07:44:03', '2021-04-06 14:54:15'),
(15, 'Butter Bun', 'All Time Butter Bun From All Time.', 'All Time', 10, 74, 'PC-103011', 'Butter Bun-PC-103011.jpg', '1617710818.jpg', 20, 'butter-bun', 1, '2021-04-06 12:06:58', NULL),
(16, 'Milk Bread', 'Milk Bread From All Time.', 'All Time', 45, 43, 'PC-101589', 'milk-bread-PC-101589.jpg', '1617721056-Milk Bread.jpg', 10, 'milk-bread', 1, '2021-04-06 12:10:49', '2021-04-06 14:57:36');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `suppliers`
--

CREATE TABLE `suppliers` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `supplier_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_brand` varchar(175) COLLATE utf8mb4_unicode_ci NOT NULL,
  `address` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `supplier_img` varchar(175) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_slug` varchar(150) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `supplier_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `suppliers`
--

INSERT INTO `suppliers` (`id`, `supplier_name`, `supplier_brand`, `address`, `phone`, `email`, `supplier_img`, `supplier_slug`, `supplier_status`, `created_at`, `updated_at`) VALUES
(1, 'Md. Ahmed Khan', 'Pran', '210/A, Middle Badda, Dhaka', '01627309821', 'ahmed@gmail.com', 'md-ahmed-khan(1)1617902430.jpg', 'md-ahmed-khan', 1, '2021-04-08 15:19:58', '2021-04-08 17:20:30'),
(2, 'Md. Asraful Islam', 'All Time', 'Rampura,    Dhaka, Bangladesh', '+8801823-625189', 'asraful@gmail.com', 'md-asraful-islam(2)1617902251.jpg', 'md-asraful-islam', 1, '2021-04-08 15:35:20', '2021-04-08 17:17:31'),
(5, 'Mominul Haque', 'Fresh', 'Dhaka, Bangladesh', '+8801723-625189', 'mominul@gmail.com', 'mominul-haque(5)-1617900718.jpg', 'mominul-haque', 1, '2021-04-08 16:51:57', '2021-04-08 16:51:58');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` int(11) NOT NULL,
  `paid_amount` int(11) NOT NULL,
  `change_balance` int(11) NOT NULL,
  `payment_method` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'cash',
  `user_id` int(11) NOT NULL,
  `transaction_date` date NOT NULL,
  `transaction_amount` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `order_id`, `paid_amount`, `change_balance`, `payment_method`, `user_id`, `transaction_date`, `transaction_amount`, `created_at`, `updated_at`) VALUES
(1, 1, 1000, 85, 'cash', 1, '2021-03-26', 915, '2021-03-26 12:08:29', '2021-03-26 12:08:29'),
(2, 2, 50, 0, 'cash', 1, '2021-03-26', 50, '2021-03-26 12:46:12', '2021-03-26 12:46:12'),
(3, 3, 1200, 60, 'credit card', 1, '2021-03-26', 1140, '2021-03-26 12:48:17', '2021-03-26 12:48:17'),
(4, 5, 500, 165, 'cash', 1, '2021-03-27', 335, '2021-03-27 17:09:59', '2021-03-27 17:09:59'),
(6, 7, 1500, 405, 'cash', 1, '2021-03-27', 1095, '2021-03-27 17:52:05', '2021-03-27 17:52:05'),
(7, 8, 10, 0, 'cash', 1, '2021-03-28', 10, '2021-03-27 18:59:31', '2021-03-27 18:59:31'),
(8, 9, 200, 6, 'cash', 1, '2021-03-28', 194, '2021-03-27 19:06:23', '2021-03-27 19:06:23'),
(9, 13, 100, 25, 'cash', 1, '2021-04-06', 75, '2021-04-06 17:42:47', '2021-04-06 17:42:47'),
(10, 14, 600, 20, 'cash', 1, '2021-04-06', 580, '2021-04-06 17:43:59', '2021-04-06 17:43:59'),
(11, 15, 500, 42, 'cash', 1, '2021-04-08', 458, '2021-04-08 01:29:57', '2021-04-08 01:29:57'),
(12, 16, 600, 0, 'cash', 1, '2021-04-08', 600, '2021-04-08 02:36:09', '2021-04-08 02:36:09'),
(13, 17, 500, 0, 'cash', 1, '2021-04-08', 500, '2021-04-08 03:05:13', '2021-04-08 03:05:13'),
(14, 18, 800, 88, 'cash', 1, '2021-04-08', 713, '2021-04-08 10:06:42', '2021-04-08 10:06:42'),
(15, 19, 200, 58, 'cash', 1, '2021-04-08', 143, '2021-04-08 10:09:54', '2021-04-08 10:09:54'),
(16, 20, 1500, 360, 'cash', 1, '2021-04-08', 1140, '2021-04-08 10:10:32', '2021-04-08 10:10:32'),
(17, 21, 700, 25, 'cash', 1, '2021-04-08', 675, '2021-04-08 12:49:57', '2021-04-08 12:49:57'),
(18, 22, 500, 35, 'cash', 1, '2021-04-09', 465, '2021-04-09 15:45:26', '2021-04-09 15:45:26'),
(19, 23, 500, 45, 'cash', 4, '2021-04-10', 455, '2021-04-10 08:15:51', '2021-04-10 08:15:51'),
(20, 24, 15, 0, 'cash', 1, '2021-04-10', 15, '2021-04-10 08:25:57', '2021-04-10 08:25:57'),
(21, 25, 600, 0, 'cash', 4, '2021-04-10', 600, '2021-04-10 09:30:22', '2021-04-10 09:30:22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `mobile` varchar(15) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `slug` varchar(175) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` tinyint(4) NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `mobile`, `photo`, `status`, `slug`, `role_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Samsul Haque', 'hshamsul894@gmail.com', NULL, '$2y$10$ZdC9yK4RhAvk6ySjGWuo1uBz4XK3z1m16vgcAHuRW2ZWek.q05./6', '+880162-7309821', 'samsul-haque(1)1618066510.png', 1, 'samsul-haque', 1, '766HA8uAXzJjlk3KmBZJPIao65qM9iia2XbwgYSDrQD6CZFaTrj7wvLLu5A8', '2021-03-13 11:26:28', '2021-04-10 14:55:10'),
(3, 'Hanin Tahsin', 'hanin@gmail.com', NULL, '$2y$10$uYT3P9G5zzPca/A83.p.bek3KQyFnGqqaAfTKlf5y4at/dGz02iE6', '01677102422', 'hanin-tahsin(3)1617993983.jpg', 0, 'hanin-tahsin', 2, NULL, '2021-04-09 17:03:03', '2021-04-10 04:57:49'),
(4, 'Osama Sharif', 'osama@gmail.com', NULL, '$2y$10$HXa00s.sw1WGLKayheSZ.um.1dUlB6oc0RBeo0nagz.m1W2NYxyVi', '01677102433', 'osama-sharif(4)1618048850.jpg', 1, 'osama-sharif', 2, NULL, '2021-04-09 17:06:20', '2021-04-10 14:41:35'),
(5, 'Hussain Mahmud', 'hussain.mahmud@gmail.com', NULL, '$2y$10$ZRdhpSWiFesXXRyQ70No0e2TWiEEb0mWVpfpB0g/t/uZ.1nNgUtBK', '+880192-7309821', 'hussain-mahmud(5)-1618034975.jpg', 1, 'hussain-mahmud', 1, NULL, '2021-04-10 06:09:35', '2021-04-10 06:09:36');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role_status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `role_id`, `role_name`, `role_status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Admin', 1, '2021-04-09 16:04:25', NULL),
(2, 2, 'Employee', 1, '2021-04-09 16:12:44', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `companies`
--
ALTER TABLE `companies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `suppliers`
--
ALTER TABLE `suppliers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `supplier_slug` (`supplier_slug`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `slug` (`slug`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `role_id` (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `companies`
--
ALTER TABLE `companies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `suppliers`
--
ALTER TABLE `suppliers`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
