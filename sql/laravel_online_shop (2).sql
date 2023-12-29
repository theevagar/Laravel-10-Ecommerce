-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 29, 2023 at 07:52 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.1.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `laravel_online_shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

CREATE TABLE `brands` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `status` varchar(255) NOT NULL DEFAULT '1',
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `image`, `status`, `showHome`, `created_at`, `updated_at`) VALUES
(114, 'Hindi Actor', 'hindi-actor', '114.jpeg', '1', 'Yes', '2023-12-25 02:35:35', '2023-12-25 02:35:35'),
(115, 'Telugu Actor', 'telugu-actor', '115.jpg', '1', 'Yes', '2023-12-25 02:36:19', '2023-12-25 02:36:20'),
(116, 'Malaiyalam Actor', 'malaiyalam-actor', '116.jpeg', '1', 'Yes', '2023-12-25 02:37:11', '2023-12-25 02:37:11'),
(117, 'Tamil Actor', 'tamil-actor', '117.jpg', '1', 'Yes', '2023-12-25 02:38:19', '2023-12-25 02:38:19');

-- --------------------------------------------------------

--
-- Table structure for table `countries`
--

CREATE TABLE `countries` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `countries`
--

INSERT INTO `countries` (`id`, `name`, `code`, `created_at`, `updated_at`) VALUES
(1, 'United States', 'US', NULL, NULL),
(2, 'Canada', 'CA', NULL, NULL),
(3, 'Afghanistan', 'AF', NULL, NULL),
(4, 'Albania', 'AL', NULL, NULL),
(5, 'Algeria', 'DZ', NULL, NULL),
(6, 'American Samoa', 'AS', NULL, NULL),
(7, 'Andorra', 'AD', NULL, NULL),
(8, 'Angola', 'AO', NULL, NULL),
(9, 'Anguilla', 'AI', NULL, NULL),
(10, 'Antarctica', 'AQ', NULL, NULL),
(11, 'Antigua and/or Barbuda', 'AG', NULL, NULL),
(12, 'Argentina', 'AR', NULL, NULL),
(13, 'Armenia', 'AM', NULL, NULL),
(14, 'Aruba', 'AW', NULL, NULL),
(15, 'Australia', 'AU', NULL, NULL),
(16, 'Austria', 'AT', NULL, NULL),
(17, 'Azerbaijan', 'AZ', NULL, NULL),
(18, 'Bahamas', 'BS', NULL, NULL),
(19, 'Bahrain', 'BH', NULL, NULL),
(20, 'Bangladesh', 'BD', NULL, NULL),
(21, 'Barbados', 'BB', NULL, NULL),
(22, 'Belarus', 'BY', NULL, NULL),
(23, 'Belgium', 'BE', NULL, NULL),
(24, 'Belize', 'BZ', NULL, NULL),
(25, 'Benin', 'BJ', NULL, NULL),
(26, 'Bermuda', 'BM', NULL, NULL),
(27, 'Bhutan', 'BT', NULL, NULL),
(28, 'Bolivia', 'BO', NULL, NULL),
(29, 'Bosnia and Herzegovina', 'BA', NULL, NULL),
(30, 'Botswana', 'BW', NULL, NULL),
(31, 'Bouvet Island', 'BV', NULL, NULL),
(32, 'Brazil', 'BR', NULL, NULL),
(33, 'British lndian Ocean Territory', 'IO', NULL, NULL),
(34, 'Brunei Darussalam', 'BN', NULL, NULL),
(35, 'Bulgaria', 'BG', NULL, NULL),
(36, 'Burkina Faso', 'BF', NULL, NULL),
(37, 'Burundi', 'BI', NULL, NULL),
(38, 'Cambodia', 'KH', NULL, NULL),
(39, 'Cameroon', 'CM', NULL, NULL),
(40, 'Cape Verde', 'CV', NULL, NULL),
(41, 'Cayman Islands', 'KY', NULL, NULL),
(42, 'Central African Republic', 'CF', NULL, NULL),
(43, 'Chad', 'TD', NULL, NULL),
(44, 'Chile', 'CL', NULL, NULL),
(45, 'China', 'CN', NULL, NULL),
(46, 'Christmas Island', 'CX', NULL, NULL),
(47, 'Cocos (Keeling) Islands', 'CC', NULL, NULL),
(48, 'Colombia', 'CO', NULL, NULL),
(49, 'Comoros', 'KM', NULL, NULL),
(50, 'Congo', 'CG', NULL, NULL),
(51, 'Cook Islands', 'CK', NULL, NULL),
(52, 'Costa Rica', 'CR', NULL, NULL),
(53, 'Croatia (Hrvatska)', 'HR', NULL, NULL),
(54, 'Cuba', 'CU', NULL, NULL),
(55, 'Cyprus', 'CY', NULL, NULL),
(56, 'Czech Republic', 'CZ', NULL, NULL),
(57, 'Democratic Republic of Congo', 'CD', NULL, NULL),
(58, 'Denmark', 'DK', NULL, NULL),
(59, 'Djibouti', 'DJ', NULL, NULL),
(60, 'Dominica', 'DM', NULL, NULL),
(61, 'Dominican Republic', 'DO', NULL, NULL),
(62, 'East Timor', 'TP', NULL, NULL),
(63, 'Ecudaor', 'EC', NULL, NULL),
(64, 'Egypt', 'EG', NULL, NULL),
(65, 'El Salvador', 'SV', NULL, NULL),
(66, 'Equatorial Guinea', 'GQ', NULL, NULL),
(67, 'Eritrea', 'ER', NULL, NULL),
(68, 'Estonia', 'EE', NULL, NULL),
(69, 'Ethiopia', 'ET', NULL, NULL),
(70, 'Falkland Islands (Malvinas)', 'FK', NULL, NULL),
(71, 'Faroe Islands', 'FO', NULL, NULL),
(72, 'Fiji', 'FJ', NULL, NULL),
(73, 'Finland', 'FI', NULL, NULL),
(74, 'France', 'FR', NULL, NULL),
(75, 'France, Metropolitan', 'FX', NULL, NULL),
(76, 'French Guiana', 'GF', NULL, NULL),
(77, 'French Polynesia', 'PF', NULL, NULL),
(78, 'French Southern Territories', 'TF', NULL, NULL),
(79, 'Gabon', 'GA', NULL, NULL),
(80, 'Gambia', 'GM', NULL, NULL),
(81, 'Georgia', 'GE', NULL, NULL),
(82, 'Germany', 'DE', NULL, NULL),
(83, 'Ghana', 'GH', NULL, NULL),
(84, 'Gibraltar', 'GI', NULL, NULL),
(85, 'Greece', 'GR', NULL, NULL),
(86, 'Greenland', 'GL', NULL, NULL),
(87, 'Grenada', 'GD', NULL, NULL),
(88, 'Guadeloupe', 'GP', NULL, NULL),
(89, 'Guam', 'GU', NULL, NULL),
(90, 'Guatemala', 'GT', NULL, NULL),
(91, 'Guinea', 'GN', NULL, NULL),
(92, 'Guinea-Bissau', 'GW', NULL, NULL),
(93, 'Guyana', 'GY', NULL, NULL),
(94, 'Haiti', 'HT', NULL, NULL),
(95, 'Heard and Mc Donald Islands', 'HM', NULL, NULL),
(96, 'Honduras', 'HN', NULL, NULL),
(97, 'Hong Kong', 'HK', NULL, NULL),
(98, 'Hungary', 'HU', NULL, NULL),
(99, 'Iceland', 'IS', NULL, NULL),
(100, 'India', 'IN', NULL, NULL),
(101, 'Indonesia', 'ID', NULL, NULL),
(102, 'Iran (Islamic Republic of)', 'IR', NULL, NULL),
(103, 'Iraq', 'IQ', NULL, NULL),
(104, 'Ireland', 'IE', NULL, NULL),
(105, 'Israel', 'IL', NULL, NULL),
(106, 'Italy', 'IT', NULL, NULL),
(107, 'Ivory Coast', 'CI', NULL, NULL),
(108, 'Jamaica', 'JM', NULL, NULL),
(109, 'Japan', 'JP', NULL, NULL),
(110, 'Jordan', 'JO', NULL, NULL),
(111, 'Kazakhstan', 'KZ', NULL, NULL),
(112, 'Kenya', 'KE', NULL, NULL),
(113, 'Kiribati', 'KI', NULL, NULL),
(114, 'Korea, Democratic People\'s Republic of', 'KP', NULL, NULL),
(115, 'Korea, Republic of', 'KR', NULL, NULL),
(116, 'Kuwait', 'KW', NULL, NULL),
(117, 'Kyrgyzstan', 'KG', NULL, NULL),
(118, 'Lao People\'s Democratic Republic', 'LA', NULL, NULL),
(119, 'Latvia', 'LV', NULL, NULL),
(120, 'Lebanon', 'LB', NULL, NULL),
(121, 'Lesotho', 'LS', NULL, NULL),
(122, 'Liberia', 'LR', NULL, NULL),
(123, 'Libyan Arab Jamahiriya', 'LY', NULL, NULL),
(124, 'Liechtenstein', 'LI', NULL, NULL),
(125, 'Lithuania', 'LT', NULL, NULL),
(126, 'Luxembourg', 'LU', NULL, NULL),
(127, 'Macau', 'MO', NULL, NULL),
(128, 'Macedonia', 'MK', NULL, NULL),
(129, 'Madagascar', 'MG', NULL, NULL),
(130, 'Malawi', 'MW', NULL, NULL),
(131, 'Malaysia', 'MY', NULL, NULL),
(132, 'Maldives', 'MV', NULL, NULL),
(133, 'Mali', 'ML', NULL, NULL),
(134, 'Malta', 'MT', NULL, NULL),
(135, 'Marshall Islands', 'MH', NULL, NULL),
(136, 'Martinique', 'MQ', NULL, NULL),
(137, 'Mauritania', 'MR', NULL, NULL),
(138, 'Mauritius', 'MU', NULL, NULL),
(139, 'Mayotte', 'TY', NULL, NULL),
(140, 'Mexico', 'MX', NULL, NULL),
(141, 'Micronesia, Federated States of', 'FM', NULL, NULL),
(142, 'Moldova, Republic of', 'MD', NULL, NULL),
(143, 'Monaco', 'MC', NULL, NULL),
(144, 'Mongolia', 'MN', NULL, NULL),
(145, 'Montserrat', 'MS', NULL, NULL),
(146, 'Morocco', 'MA', NULL, NULL),
(147, 'Mozambique', 'MZ', NULL, NULL),
(148, 'Myanmar', 'MM', NULL, NULL),
(149, 'Namibia', 'NA', NULL, NULL),
(150, 'Nauru', 'NR', NULL, NULL),
(151, 'Nepal', 'NP', NULL, NULL),
(152, 'Netherlands', 'NL', NULL, NULL),
(153, 'Netherlands Antilles', 'AN', NULL, NULL),
(154, 'New Caledonia', 'NC', NULL, NULL),
(155, 'New Zealand', 'NZ', NULL, NULL),
(156, 'Nicaragua', 'NI', NULL, NULL),
(157, 'Niger', 'NE', NULL, NULL),
(158, 'Nigeria', 'NG', NULL, NULL),
(159, 'Niue', 'NU', NULL, NULL),
(160, 'Norfork Island', 'NF', NULL, NULL),
(161, 'Northern Mariana Islands', 'MP', NULL, NULL),
(162, 'Norway', 'NO', NULL, NULL),
(163, 'Oman', 'OM', NULL, NULL),
(164, 'Pakistan', 'PK', NULL, NULL),
(165, 'Palau', 'PW', NULL, NULL),
(166, 'Panama', 'PA', NULL, NULL),
(167, 'Papua New Guinea', 'PG', NULL, NULL),
(168, 'Paraguay', 'PY', NULL, NULL),
(169, 'Peru', 'PE', NULL, NULL),
(170, 'Philippines', 'PH', NULL, NULL),
(171, 'Pitcairn', 'PN', NULL, NULL),
(172, 'Poland', 'PL', NULL, NULL),
(173, 'Portugal', 'PT', NULL, NULL),
(174, 'Puerto Rico', 'PR', NULL, NULL),
(175, 'Qatar', 'QA', NULL, NULL),
(176, 'Republic of South Sudan', 'SS', NULL, NULL),
(177, 'Reunion', 'RE', NULL, NULL),
(178, 'Romania', 'RO', NULL, NULL),
(179, 'Russian Federation', 'RU', NULL, NULL),
(180, 'Rwanda', 'RW', NULL, NULL),
(181, 'Saint Kitts and Nevis', 'KN', NULL, NULL),
(182, 'Saint Lucia', 'LC', NULL, NULL),
(183, 'Saint Vincent and the Grenadines', 'VC', NULL, NULL),
(184, 'Samoa', 'WS', NULL, NULL),
(185, 'San Marino', 'SM', NULL, NULL),
(186, 'Sao Tome and Principe', 'ST', NULL, NULL),
(187, 'Saudi Arabia', 'SA', NULL, NULL),
(188, 'Senegal', 'SN', NULL, NULL),
(189, 'Serbia', 'RS', NULL, NULL),
(190, 'Seychelles', 'SC', NULL, NULL),
(191, 'Sierra Leone', 'SL', NULL, NULL),
(192, 'Singapore', 'SG', NULL, NULL),
(193, 'Slovakia', 'SK', NULL, NULL),
(194, 'Slovenia', 'SI', NULL, NULL),
(195, 'Solomon Islands', 'SB', NULL, NULL),
(196, 'Somalia', 'SO', NULL, NULL),
(197, 'South Africa', 'ZA', NULL, NULL),
(198, 'South Georgia South Sandwich Islands', 'GS', NULL, NULL),
(199, 'Spain', 'ES', NULL, NULL),
(200, 'Sri Lanka', 'LK', NULL, NULL),
(201, 'St. Helena', 'SH', NULL, NULL),
(202, 'St. Pierre and Miquelon', 'PM', NULL, NULL),
(203, 'Sudan', 'SD', NULL, NULL),
(204, 'Suriname', 'SR', NULL, NULL),
(205, 'Svalbarn and Jan Mayen Islands', 'SJ', NULL, NULL),
(206, 'Swaziland', 'SZ', NULL, NULL),
(207, 'Sweden', 'SE', NULL, NULL),
(208, 'Switzerland', 'CH', NULL, NULL),
(209, 'Syrian Arab Republic', 'SY', NULL, NULL),
(210, 'Taiwan', 'TW', NULL, NULL),
(211, 'Tajikistan', 'TJ', NULL, NULL),
(212, 'Tanzania, United Republic of', 'TZ', NULL, NULL),
(213, 'Thailand', 'TH', NULL, NULL),
(214, 'Togo', 'TG', NULL, NULL),
(215, 'Tokelau', 'TK', NULL, NULL),
(216, 'Tonga', 'TO', NULL, NULL),
(217, 'Trinidad and Tobago', 'TT', NULL, NULL),
(218, 'Tunisia', 'TN', NULL, NULL),
(219, 'Turkey', 'TR', NULL, NULL),
(220, 'Turkmenistan', 'TM', NULL, NULL),
(221, 'Turks and Caicos Islands', 'TC', NULL, NULL),
(222, 'Tuvalu', 'TV', NULL, NULL),
(223, 'Uganda', 'UG', NULL, NULL),
(224, 'Ukraine', 'UA', NULL, NULL),
(225, 'United Arab Emirates', 'AE', NULL, NULL),
(226, 'United Kingdom', 'GB', NULL, NULL),
(227, 'United States minor outlying islands', 'UM', NULL, NULL),
(228, 'Uruguay', 'UY', NULL, NULL),
(229, 'Uzbekistan', 'UZ', NULL, NULL),
(230, 'Vanuatu', 'VU', NULL, NULL),
(231, 'Vatican City State', 'VA', NULL, NULL),
(232, 'Venezuela', 'VE', NULL, NULL),
(233, 'Vietnam', 'VN', NULL, NULL),
(234, 'Virgin Islands (British)', 'VG', NULL, NULL),
(235, 'Virgin Islands (U.S.)', 'VI', NULL, NULL),
(236, 'Wallis and Futuna Islands', 'WF', NULL, NULL),
(237, 'Western Sahara', 'EH', NULL, NULL),
(238, 'Yemen', 'YE', NULL, NULL),
(239, 'Yugoslavia', 'YU', NULL, NULL),
(240, 'Zaire', 'ZR', NULL, NULL),
(241, 'Zambia', 'ZM', NULL, NULL),
(242, 'Zimbabwe', 'ZW', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `customer_addresses`
--

CREATE TABLE `customer_addresses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) NOT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `customer_addresses`
--

INSERT INTO `customer_addresses` (`id`, `user_id`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `created_at`, `updated_at`) VALUES
(16, 20, 'theevagar2', 'a2', 'thee2@gmail.com', '222222222', 190, 'i ama theevagar from pondicherry i am working in software engineering2222', 'new appartment22222', 'pondicherry2222', 'pondicherry22222', '22222222', '2023-12-25 05:04:27', '2023-12-27 01:17:27');

-- --------------------------------------------------------

--
-- Table structure for table `discount_coupons`
--

CREATE TABLE `discount_coupons` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `code` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `max_uses` int(11) DEFAULT NULL,
  `max_uses_user` int(11) DEFAULT NULL,
  `type` enum('percent','fixed') NOT NULL DEFAULT 'fixed',
  `discount_amount` double(10,2) NOT NULL,
  `min_amount` double(10,2) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `starts_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discount_coupons`
--

INSERT INTO `discount_coupons` (`id`, `code`, `name`, `description`, `max_uses`, `max_uses_user`, `type`, `discount_amount`, `min_amount`, `status`, `starts_at`, `expires_at`, `created_at`, `updated_at`) VALUES
(13, 'IND2020', 'India', 'new descripton', 5, 2, 'fixed', 10.00, 100.00, 1, '2023-12-19 13:33:58', '2023-12-31 13:34:01', '2023-12-19 08:04:14', '2023-12-19 08:04:14'),
(14, 'IND30', 'Dummy Name 30', NULL, 11, 3, 'percent', 10.00, 300.00, 1, '2023-12-27 18:30:58', '2023-12-30 23:30:01', '2023-12-19 08:05:04', '2023-12-25 04:24:10');

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
(5, '2023_12_05_130800_create_categories_table', 2),
(6, '2023_12_07_064753_create_temp_image_table', 3),
(7, '2023_12_07_114632_create_sub_categories_table', 4),
(8, '2023_12_08_052403_create_brands_table', 5),
(9, '2023_12_08_080036_create_products_table', 6),
(10, '2023_12_08_080109_create_product_images_table', 6),
(11, '2023_12_10_055049_alter_categories_table', 7),
(12, '2023_12_10_070525_alter_products_table', 8),
(13, '2023_12_10_071126_alter_sub_categoriess_table', 9),
(14, '2023_12_14_065030_alter_products_table', 10),
(15, '2023_12_15_061826_alter_users_table', 11),
(16, '2023_12_15_101605_create_countries_table', 12),
(17, '2023_12_15_114540_create_orders_table', 13),
(18, '2023_12_15_114604_create_orders_item_table', 13),
(19, '2023_12_15_120109_create_customer_addresses_table', 14),
(20, '2023_12_16_085130_create_order_item_table', 15),
(21, '2023_12_16_085941_create_order_items_table', 16),
(22, '2023_12_17_035144_create_shipping_charges_table', 17),
(23, '2023_12_19_032346_create_discount_coupons_table', 18),
(24, '2023_12_20_120750_alter_orders_table', 19),
(25, '2023_12_21_115133_alter_orders_table', 20),
(26, '2023_12_26_094857_create_wishlists_table', 21),
(27, '2023_12_27_071020_alter_users_table', 22),
(28, '2023_12_27_104220_create_pages_table', 23),
(29, '2023_12_29_015929_create_product_ratings_table', 24);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `shipping` double(10,2) NOT NULL,
  `coupon_code` varchar(255) DEFAULT NULL,
  `coupon_code_id` int(20) DEFAULT NULL,
  `discount` double(10,2) DEFAULT NULL,
  `grand_total` double(10,2) DEFAULT NULL,
  `payment_status` enum('paid','not paid') NOT NULL DEFAULT 'not paid',
  `status` enum('pending','shipped','delivered','cancelled') NOT NULL DEFAULT 'pending',
  `shipped_date` timestamp NULL DEFAULT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `address` text NOT NULL,
  `apartment` varchar(255) DEFAULT NULL,
  `city` varchar(255) NOT NULL,
  `state` varchar(255) NOT NULL,
  `zip` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `subtotal`, `shipping`, `coupon_code`, `coupon_code_id`, `discount`, `grand_total`, `payment_status`, `status`, `shipped_date`, `first_name`, `last_name`, `email`, `mobile`, `country_id`, `address`, `apartment`, `city`, `state`, `zip`, `notes`, `created_at`, `updated_at`) VALUES
(8, 20, 1000.00, 50.00, 'IND2020', 13, 10.00, 1040.00, 'not paid', 'pending', NULL, 'theevagar', 'a', 'theevagar@gmail.com', '65448488', 100, 'i ama theevagar from pondicherry i am working in software engineering', 'new appartment', 'pondicherry', 'pondicherry', '154444', 'new order', '2023-12-25 05:04:27', '2023-12-25 05:04:27'),
(9, 20, 500.00, 50.00, '', NULL, 0.00, 550.00, 'not paid', 'pending', NULL, 'theevagar', 'a', 'theevagar@gmail.com', '65448488', 100, 'i ama theevagar from pondicherry i am working in software engineering', 'new appartment', 'pondicherry', 'pondicherry', '154444', NULL, '2023-12-26 09:00:29', '2023-12-26 09:00:29'),
(10, 20, 500.00, 50.00, '', NULL, 0.00, 550.00, 'not paid', 'pending', NULL, 'theevagar', 'a', 'theevagar@gmail.com', '65448488', 100, 'i ama theevagar from pondicherry i am working in software engineering', 'new appartment', 'pondicherry', 'pondicherry', '154444', NULL, '2023-12-26 09:01:07', '2023-12-26 09:01:07'),
(11, 20, 500.00, 50.00, '', NULL, 0.00, 550.00, 'not paid', 'pending', NULL, 'theevagar', 'a', 'theevagar@gmail.com', '65448488', 100, 'i ama theevagar from pondicherry i am working in software engineering', 'new appartment', 'pondicherry', 'pondicherry', '154444', NULL, '2023-12-26 09:03:51', '2023-12-26 09:03:51'),
(12, 20, 1000.00, 100.00, '', NULL, 0.00, 1100.00, 'not paid', 'pending', NULL, 'theevagar', 'a', 'theevagar@gmail.com', '65448488', 100, 'i ama theevagar from pondicherry i am working in software engineering', 'new appartment', 'pondicherry', 'pondicherry', '154444', NULL, '2023-12-26 09:11:10', '2023-12-26 09:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` bigint(11) NOT NULL,
  `product_id` bigint(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `qty` int(11) NOT NULL,
  `price` double(10,2) NOT NULL,
  `total` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `name`, `qty`, `price`, `total`, `created_at`, `updated_at`) VALUES
(16, 8, 91, 'Tamil Actor MG.Ramachandran', 1, 1000.00, 1000.00, '2023-12-25 05:04:27', '2023-12-25 05:04:27'),
(17, 9, 98, 'Dulquer Salmaan', 1, 500.00, 500.00, '2023-12-26 09:00:30', '2023-12-26 09:00:30'),
(18, 10, 98, 'Dulquer Salmaan', 1, 500.00, 500.00, '2023-12-26 09:01:07', '2023-12-26 09:01:07'),
(19, 11, 98, 'Dulquer Salmaan', 1, 500.00, 500.00, '2023-12-26 09:03:51', '2023-12-26 09:03:51'),
(20, 12, 98, 'Dulquer Salmaan', 2, 500.00, 1000.00, '2023-12-26 09:11:10', '2023-12-26 09:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `content` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `name`, `slug`, `content`, `created_at`, `updated_at`) VALUES
(6, 'Contact Us', 'contact-us', '<p>I am theevagar from pondicherry. I am working in software Engineering and program developer. Laravel&nbsp; PHP framework .</p><p>A.Theevagar</p><p>Pondicherry</p>', '2023-12-27 07:08:50', '2023-12-28 01:25:19'),
(7, 'About Us', 'about-us', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Mollitia accusantium non culpa. Rerum eaque fugiat recusandae atque ipsa, maxime neque quis quasi cupiditate esse corporis mollitia, nostrum sit officia quaerat.', '2023-12-27 07:09:13', '2023-12-27 07:16:28'),
(8, 'Terms & Conditions', 'terms-conditions', '<p>terms and conditions page</p>', '2023-12-27 07:33:20', '2023-12-27 07:33:20');

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
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `short_description` text DEFAULT NULL,
  `shipping_returns` text DEFAULT NULL,
  `related_products` text DEFAULT NULL,
  `price` double(10,2) NOT NULL,
  `compare_price` double(10,2) DEFAULT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `sub_category_id` bigint(20) UNSIGNED DEFAULT NULL,
  `brand_id` bigint(20) UNSIGNED DEFAULT NULL,
  `is_featured` enum('Yes','No') NOT NULL DEFAULT 'No',
  `sku` varchar(255) NOT NULL,
  `barcode` varchar(255) DEFAULT NULL,
  `track_qty` enum('Yes','NO') NOT NULL DEFAULT 'Yes',
  `qty` int(11) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `title`, `slug`, `description`, `short_description`, `shipping_returns`, `related_products`, `price`, `compare_price`, `category_id`, `sub_category_id`, `brand_id`, `is_featured`, `sku`, `barcode`, `track_qty`, `qty`, `status`, `created_at`, `updated_at`) VALUES
(91, 'Tamil Actor MG.Ramachandran', 'tamil-actor-mgramachandran', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">He acted as hero in the Tamil film industry\'s first ever full length Gevacolor film, the 1955 Alibabavum 40 Thirudargalum. He won the National Film Award for Best Actor for the film Rickshawkaran in 1972. His 1973 blockbuster Ulagam Sutrum Valiban broke the previous box office records of his films.</span><br></p>', 'He acted as hero in the Tamil film industry\'s first ever full length Gevacolor film, the 1955 Alibabavum 40 Thirudargalum. He won the National Film Award for Best Actor for the film Rickshawkaran in 1972. His 1973 blockbuster Ulagam Sutrum Valiban broke the previous box office records of his films.', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">He acted as hero in the Tamil film industry\'s first ever full length Gevacolor film, the 1955 Alibabavum 40 Thirudargalum.&nbsp;</span><br></p>', '', 1000.00, 200.00, 117, 44, NULL, 'Yes', 'MGR-123', 'MGR-1234', 'Yes', 1, 1, '2023-12-25 03:19:29', '2023-12-25 03:19:29'),
(92, 'Sivaji Ganesan', 'sivaji-ganesan', '<p><span class=\"d9FyLd\" style=\"padding: 0px 0px 10px; color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px; display: block;\">Sivaji GanesanRoja Muthiah Research Library</span><span class=\"hgKElc\" style=\"padding: 0px 8px 0px 0px; color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">He continued to act in dramas even after he became a successful film actor.&nbsp;<span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40);\">He acted in more than 300 Tamil movies, 9 Telugu movies and 2 Hindi movies</span>. Sivaji Ganesan and MGR, the two acclaimed actors of their time, acted together only in one movie, namely, Koondu Kizhi.</span><br></p>', '<p><span class=\"d9FyLd\" style=\"padding: 0px 0px 10px; color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px; display: block;\">Sivaji GanesanRoja Muthiah Research Library</span><span class=\"hgKElc\" style=\"padding: 0px 8px 0px 0px; color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">He continued to act in dramas even after he became a successful film actor.&nbsp;<span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40);\">He acted in more than 300 Tamil movies, 9 Telugu movies and 2 Hindi movies</span>.&nbsp;</span><br></p>', '<p><span class=\"d9FyLd\" style=\"padding: 0px 0px 10px; color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px; display: block;\">Sivaji GanesanRoja Muthiah Research Library</span><span class=\"hgKElc\" style=\"padding: 0px 8px 0px 0px; color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">He continued to act in dramas even after he became a successful film actor.&nbsp;<span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40);\">He acted in more than 300 Tamil movies, 9 Telugu movies and 2 Hindi movies</span>.&nbsp;</span><br></p>', '', 2000.00, 200.00, 117, 45, NULL, 'Yes', 'SI-13', 'SI-123', 'Yes', 1, 1, '2023-12-25 03:22:07', '2023-12-25 03:22:07'),
(93, 'Rajini Kanth', 'rajini-kanth', '<p><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Rajnikanth won the Tamil Nadu State Film Award for Best Actor</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">, the highest accolade for an actor in Tamil cinema, numerous times. In 2000 he received the Padma Bhushan for his contributions to Indian film. The Editors of&nbsp;</span><span jsaction=\"click:sKUsF\" role=\"tooltip\" tabindex=\"0\" style=\"outline: 0px; color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\"><g-bubble jscontroller=\"QVaUhf\" data-ci=\"\" data-du=\"200\" data-tp=\"5\" jsaction=\"R9S7w:VqIRre;\" jsshadow=\"\"><span jsname=\"d6wfac\" class=\"c5aZPb\" data-enable-toggle-animation=\"true\" data-extra-container-classes=\"ZLo7Eb\" data-hover-hide-delay=\"1000\" data-hover-open-delay=\"500\" data-send-open-event=\"true\" data-theme=\"0\" data-width=\"250\" role=\"button\" tabindex=\"0\" jsaction=\"vQLyHf\" jsslot=\"\" data-ved=\"2ahUKEwj36JiKm6qDAxVJTWwGHQdECuAQmpgGegQIDxAH\" style=\"outline: 0px;\"><span jsname=\"ukx3I\" class=\"JPfdse\" data-bubble-link=\"\" data-segment-text=\"Encyclopaedia Britannica\" style=\"border-bottom: 1px dashed rgba(4, 12, 40, 0.5);\">Encyclopaedia Britannica</span></span></g-bubble></span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">&nbsp;This article was most recently revised and updated by Amy Tikkanen.</span><br></p>', '<p><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Rajnikanth won the Tamil Nadu State Film Award for Best Actor</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">, the highest accolade for an actor in Tamil cinema, numerous times. In 2000 he received the Padma Bhushan for his contributions to Indian film.&nbsp;</span><br></p>', '<p><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Rajnikanth won the Tamil Nadu State Film Award for Best Actor</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">, the highest accolade for an actor in Tamil cinema, numerous times. In 2000 he received the Padma Bhushan for his contributions to Indian film.&nbsp;</span><br></p>', '', 3000.00, 300.00, 117, 46, NULL, 'Yes', 'RA-12', 'RA-154', 'Yes', 1, 1, '2023-12-25 03:23:59', '2023-12-25 03:23:59'),
(94, 'Kamal Haasan', 'kamal-haasan', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Mini Bio. Kamal Haasan was&nbsp;</span><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">born November 7, 1954 in Paramakudi, Ramanathapuram District, Tamil Nadu</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">. He debuted as a child artiste in the film \"Kalathoor Kannamma\" (1960). Since then, he has starred in nearly 220 films in the major Indian languages - Tamil, Telugu, Kannada, Malayalam and Hindi.</span><br></p>', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Mini Bio. Kamal Haasan was&nbsp;</span><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">born November 7, 1954 in Paramakudi, Ramanathapuram District, Tamil Nadu</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">.&nbsp;</span><br></p>', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">He debuted as a child artiste in the film \"Kalathoor Kannamma\" (1960). Since then, he has starred in nearly 220 films in the major Indian languages - Tamil, Telugu, Kannada, Malayalam and Hindi.</span><br></p>', '', 4000.00, 400.00, 117, 47, NULL, 'Yes', 'KA-12', 'KA-134', 'Yes', 1, 1, '2023-12-25 03:25:56', '2023-12-25 03:25:56'),
(95, 'Mammootty', 'mammootty', '<p><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">A three-time winner of the National Film Award for Best Actor, Mammootty has appeared in close to 400 films in the course of a career spanning over four decades</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">. He has also won 7 Kerala State Film Awards and numerous Filmfare Awards (South), and is often considered as one of the greatest living actors in the country.</span><br></p>', '<p><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">A three-time winner of the National Film Award for Best Actor, Mammootty has appeared in close to 400 films in the course of a career spanning over four decades</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">.&nbsp;</span><br></p>', '<p><span style=\"background-color: rgba(80, 151, 255, 0.18); color: rgb(4, 12, 40); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">A three-time winner of the National Film Award for Best Actor, Mammootty has appeared in close to 400 films in the course of a career spanning over four decades</span><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">.&nbsp;</span><br></p>', '', 100.00, 20.00, 116, 40, NULL, 'Yes', 'Mamoo-123', 'Mamoo-1', 'Yes', 1, 1, '2023-12-25 03:29:19', '2023-12-25 03:29:19'),
(96, 'Mohan Laal', 'mohan-laal', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Mohanlal began acting at the age of 18 in a brief role in the then-unreleased film Thiranottam (1978), released a quarter century later. He made his cinematic debut in 1980 as an antagonist in the romantic thriller Manjil Virinja Pookkal.</span><br></p>', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Mohanlal began acting at the age of 18 in a brief role in the then-unreleased film Thiranottam (1978), released a quarter century later.&nbsp;</span><br></p>', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Mohanlal began acting at the age of 18 in a brief role in the then-unreleased film Thiranottam (1978), released a quarter century later.&nbsp;</span><br></p>', '', 300.00, 30.00, 116, 41, NULL, 'Yes', 'Moh-12', 'Moh-12333', 'Yes', 1, 1, '2023-12-25 03:32:16', '2023-12-25 03:32:16'),
(97, 'Prithviraj', 'prithviraj', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Prithviraj made his acting debut with Nandanam (2002), a commercial success. He established himself as a leading Malayalam actor with Classmates (2006), the highest-grossing Malayalam film of the year. The Kerala State Film Award for Best Actor for Vaasthavam made him its youngest recipient at 24.</span><br></p>', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Prithviraj made his acting debut with Nandanam (2002), a commercial success. He established himself as a leading Malayalam actor with Classmates (2006), the highest-grossing Malayalam film of the year.&nbsp;</span><br></p>', '<p><span style=\"color: rgb(32, 33, 36); font-family: &quot;Google Sans&quot;, arial, sans-serif; font-size: 20px;\">Prithviraj made his acting debut with Nandanam (2002), a commercial success. He established himself as a leading Malayalam actor with Classmates (2006), the highest-grossing Malayalam film of the year.&nbsp;</span><br></p>', '', 400.00, 40.00, 116, 42, NULL, 'Yes', 'PR-125555', 'PR-1255', 'Yes', 0, 1, '2023-12-25 03:34:54', '2023-12-26 09:34:06'),
(98, 'Dulquer Salmaan', 'dulquer-salmaan', '<p><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">Dulquer Salmaan was born on 28 July 1983/1986 in&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Kochi\" title=\"Kochi\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Kochi</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">.</span><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;He is the youngest son of legendary actor&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Mammootty\" title=\"Mammootty\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Mammootty</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">. He completed his&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Primary_education\" title=\"Primary education\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">primary level education</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;at&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Toc-H_Public_School\" title=\"Toc-H Public School\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Toc-H Public School</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Vyttila\" title=\"Vyttila\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Vyttila</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Kochi\" title=\"Kochi\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Kochi</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;and his&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Secondary_education\" title=\"Secondary education\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">secondary level education</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;at&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Sishya_School\" title=\"Sishya School\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Sishya School</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;in&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Chennai\" title=\"Chennai\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Chennai</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">.</span><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 11.2px; text-wrap: nowrap;\">&nbsp;</span><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">He has a bachelor\'s degree in Business Management from&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Purdue_University\" title=\"Purdue University\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Purdue University</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;and worked at an IT firm in&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Dubai\" title=\"Dubai\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Dubai</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">.</span><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 11.2px; text-wrap: nowrap;\">&nbsp;</span><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;Later, bored by the monotony of corporate life, he decided to pursue a career in acting and attended a three-month course at the&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Barry_John_(theatre_director)\" title=\"Barry John (theatre director)\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Barry John</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;Acting Studio in&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Mumbai\" title=\"Mumbai\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Mumbai</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">.</span><br></p>', '<p><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">Dulquer Salmaan was born on 28 July 1983/1986 in&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Kochi\" title=\"Kochi\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Kochi</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">.</span><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;He is the youngest son of legendary actor&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Mammootty\" title=\"Mammootty\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Mammootty</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">. He completed his&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Primary_education\" title=\"Primary education\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">primary level education</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;at&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Toc-H_Public_School\" title=\"Toc-H Public School\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Toc-H Public School</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Vyttila\" title=\"Vyttila\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Vyttila</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">,&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Kochi\" title=\"Kochi\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Kochi</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;and his&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Secondary_education\" title=\"Secondary education\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">secondary level education</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;at&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Sishya_School\" title=\"Sishya School\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Sishya School</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">&nbsp;in&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Chennai\" title=\"Chennai\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Chennai</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">.</span><br></p>', '<p><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">Dulquer Salmaan was born on 28 July 1983/1986 in&nbsp;</span><a href=\"https://en.wikipedia.org/wiki/Kochi\" title=\"Kochi\" style=\"color: rgb(51, 102, 204); background: none rgb(255, 255, 255); overflow-wrap: break-word; font-family: sans-serif; font-size: 14px;\">Kochi</a><span style=\"color: rgb(32, 33, 34); font-family: sans-serif; font-size: 14px;\">.</span><br></p>', '', 500.00, 50.00, 116, 43, NULL, 'Yes', 'DU-12', 'DU-12333', 'Yes', 0, 1, '2023-12-25 03:38:32', '2023-12-26 09:11:10');

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

CREATE TABLE `product_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `image` varchar(255) NOT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`id`, `product_id`, `image`, `sort_order`, `created_at`, `updated_at`) VALUES
(74, 91, '91-74-1703494169.jpg', NULL, '2023-12-25 03:19:29', '2023-12-25 03:19:29'),
(75, 92, '92-75-1703494328.jpg', NULL, '2023-12-25 03:22:07', '2023-12-25 03:22:08'),
(76, 93, '93-76-1703494439.jpg', NULL, '2023-12-25 03:23:59', '2023-12-25 03:23:59'),
(77, 94, '94-77-1703494557.jpg', NULL, '2023-12-25 03:25:57', '2023-12-25 03:25:57'),
(78, 95, '95-78-1703494759.jpeg', NULL, '2023-12-25 03:29:19', '2023-12-25 03:29:19'),
(79, 96, '96-79-1703494936.png', NULL, '2023-12-25 03:32:16', '2023-12-25 03:32:16'),
(80, 97, '97-80-1703495094.jpg', NULL, '2023-12-25 03:34:54', '2023-12-25 03:34:54'),
(81, 98, '98-81-1703495313.jpg', NULL, '2023-12-25 03:38:32', '2023-12-25 03:38:33'),
(82, 94, '94-82-1703495943.jpg', NULL, '2023-12-25 03:49:03', '2023-12-25 03:49:03'),
(83, 91, '91-83-1703496439.jpg', NULL, '2023-12-25 03:57:19', '2023-12-25 03:57:19');

-- --------------------------------------------------------

--
-- Table structure for table `product_ratings`
--

CREATE TABLE `product_ratings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `comment` varchar(255) NOT NULL,
  `rating` double(3,2) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_ratings`
--

INSERT INTO `product_ratings` (`id`, `product_id`, `username`, `email`, `comment`, `rating`, `status`, `created_at`, `updated_at`) VALUES
(1, 98, 'Theevagar', 'thee2@gmail.com', 'hi i am theevagar from pondicherry', 3.00, 0, '2023-12-28 21:44:55', '2023-12-29 00:33:53'),
(2, 93, 'arumugam', 'aru@gmail.com', 'Hi i am arumugam your site is very nice', 5.00, 1, '2023-12-28 23:06:13', '2023-12-29 00:33:58');

-- --------------------------------------------------------

--
-- Table structure for table `shipping_charges`
--

CREATE TABLE `shipping_charges` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` varchar(255) NOT NULL,
  `amount` double(10,2) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shipping_charges`
--

INSERT INTO `shipping_charges` (`id`, `country_id`, `amount`, `created_at`, `updated_at`) VALUES
(9, '100', 50.00, '2023-12-25 04:42:24', '2023-12-25 04:42:24');

-- --------------------------------------------------------

--
-- Table structure for table `sub_categories`
--

CREATE TABLE `sub_categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
  `status` int(11) NOT NULL,
  `showHome` enum('Yes','No') NOT NULL DEFAULT 'No',
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sub_categories`
--

INSERT INTO `sub_categories` (`id`, `name`, `slug`, `status`, `showHome`, `category_id`, `created_at`, `updated_at`) VALUES
(36, 'Amitha Batchan', 'amitha-batchan', 1, 'Yes', 114, '2023-12-25 03:08:50', '2023-12-25 03:08:50'),
(37, 'Sharu Khan', 'sharu-khan', 1, 'Yes', 114, '2023-12-25 03:09:31', '2023-12-25 03:09:31'),
(38, 'Amir Khan', 'amir-khan', 1, 'Yes', 114, '2023-12-25 03:09:48', '2023-12-25 03:09:48'),
(39, 'Salmaan Khan', 'salmaan-khan', 1, 'Yes', 114, '2023-12-25 03:10:05', '2023-12-25 03:10:05'),
(40, 'Mamooty', 'mamooty', 1, 'Yes', 116, '2023-12-25 03:10:35', '2023-12-25 03:10:35'),
(41, 'Mohan Lal', 'mohan-lal', 1, 'Yes', 116, '2023-12-25 03:10:50', '2023-12-25 03:10:50'),
(42, 'Prithivi Raj', 'prithivi-raj', 1, 'Yes', 116, '2023-12-25 03:11:36', '2023-12-25 03:11:36'),
(43, 'thulkar Salman', 'thulkar-salman', 1, 'Yes', 116, '2023-12-25 03:12:23', '2023-12-25 03:12:23'),
(44, 'MGR', 'mgr', 1, 'Yes', 117, '2023-12-25 03:12:50', '2023-12-25 03:12:50'),
(45, 'Sivaji', 'sivaji', 1, 'Yes', 117, '2023-12-25 03:13:04', '2023-12-25 03:13:04'),
(46, 'Rajini', 'rajini', 1, 'Yes', 117, '2023-12-25 03:13:19', '2023-12-25 03:13:19'),
(47, 'Kamal', 'kamal', 1, 'Yes', 117, '2023-12-25 03:13:32', '2023-12-25 03:13:32'),
(48, 'Sirinjivi', 'sirinjivi', 1, 'Yes', 115, '2023-12-25 03:13:51', '2023-12-25 03:13:51'),
(49, 'Nagarjuna', 'nagarjuna', 1, 'Yes', 115, '2023-12-25 03:14:19', '2023-12-25 03:14:19'),
(50, 'Raamsaran', 'raamsaran', 1, 'Yes', 115, '2023-12-25 03:15:12', '2023-12-25 03:15:12'),
(51, 'Magesh Babu', 'magesh-babu', 1, 'Yes', 115, '2023-12-25 03:15:35', '2023-12-25 03:15:35');

-- --------------------------------------------------------

--
-- Table structure for table `temp_images`
--

CREATE TABLE `temp_images` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(255) DEFAULT NULL,
  `role` int(11) NOT NULL DEFAULT 1,
  `status` int(11) NOT NULL DEFAULT 1,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `phone`, `role`, `status`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'admin', 'admin@gmail.com', NULL, 2, 1, NULL, '$2y$12$YAnGB.z.mFGa0GybGpOBaOIwbBxGOmyc8pjOAlUypZyOVIWzhPsaW', NULL, '2023-12-05 04:42:10', '2023-12-28 00:34:47'),
(20, 'theevagar', 'thee@gmail.com', '123456789', 1, 1, NULL, '$2y$12$rLyF96JE37uecJ7Tengtw.BOZ0n7qGM9eb1HPZ7cvrgeC7lJc23jO', NULL, '2023-12-25 05:02:23', '2023-12-26 23:42:16'),
(21, 'selva', 'selva@gmail.com', '12345847', 1, 1, NULL, '$2y$12$apmfD5Zkf7oSHQFULtR.budlntDyBNeU.KemfpTlCwUwSHKPtuu7m', NULL, '2023-12-26 23:46:02', '2023-12-28 04:44:33');

-- --------------------------------------------------------

--
-- Table structure for table `wishlists`
--

CREATE TABLE `wishlists` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `wishlists`
--

INSERT INTO `wishlists` (`id`, `user_id`, `product_id`, `created_at`, `updated_at`) VALUES
(12, 20, 92, '2023-12-26 06:55:57', '2023-12-26 06:55:57'),
(13, 20, 97, '2023-12-26 06:56:09', '2023-12-26 06:56:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `brands`
--
ALTER TABLE `brands`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `countries`
--
ALTER TABLE `countries`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `customer_addresses_user_id_foreign` (`user_id`),
  ADD KEY `customer_addresses_country_id_foreign` (`country_id`);

--
-- Indexes for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
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
  ADD PRIMARY KEY (`id`),
  ADD KEY `orders_user_id_foreign` (`user_id`),
  ADD KEY `orders_country_id_foreign` (`country_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
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
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `products_category_id_foreign` (`category_id`),
  ADD KEY `products_sub_category_id_foreign` (`sub_category_id`),
  ADD KEY `products_brand_id_foreign` (`brand_id`);

--
-- Indexes for table `product_images`
--
ALTER TABLE `product_images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_images_product_id_foreign` (`product_id`);

--
-- Indexes for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_ratings_product_id_foreign` (`product_id`);

--
-- Indexes for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sub_categories_category_id_foreign` (`category_id`);

--
-- Indexes for table `temp_images`
--
ALTER TABLE `temp_images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD PRIMARY KEY (`id`),
  ADD KEY `wishlists_user_id_foreign` (`user_id`),
  ADD KEY `wishlists_product_id_foreign` (`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `brands`
--
ALTER TABLE `brands`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=118;

--
-- AUTO_INCREMENT for table `countries`
--
ALTER TABLE `countries`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=243;

--
-- AUTO_INCREMENT for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `discount_coupons`
--
ALTER TABLE `discount_coupons`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `product_images`
--
ALTER TABLE `product_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT for table `product_ratings`
--
ALTER TABLE `product_ratings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `shipping_charges`
--
ALTER TABLE `shipping_charges`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `sub_categories`
--
ALTER TABLE `sub_categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `temp_images`
--
ALTER TABLE `temp_images`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `wishlists`
--
ALTER TABLE `wishlists`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `customer_addresses`
--
ALTER TABLE `customer_addresses`
  ADD CONSTRAINT `customer_addresses_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `customer_addresses_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `orders_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `products`
--
ALTER TABLE `products`
  ADD CONSTRAINT `products_brand_id_foreign` FOREIGN KEY (`brand_id`) REFERENCES `brands` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `products_sub_category_id_foreign` FOREIGN KEY (`sub_category_id`) REFERENCES `sub_categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_images`
--
ALTER TABLE `product_images`
  ADD CONSTRAINT `product_images_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_ratings`
--
ALTER TABLE `product_ratings`
  ADD CONSTRAINT `product_ratings_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `sub_categories`
--
ALTER TABLE `sub_categories`
  ADD CONSTRAINT `sub_categories_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `wishlists`
--
ALTER TABLE `wishlists`
  ADD CONSTRAINT `wishlists_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `wishlists_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
