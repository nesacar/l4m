-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 25, 2018 at 03:48 PM
-- Server version: 5.7.19
-- PHP Version: 7.1.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `l4m`
--

-- --------------------------------------------------------

--
-- Table structure for table `attributes`
--

DROP TABLE IF EXISTS `attributes`;
CREATE TABLE IF NOT EXISTS `attributes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `property_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `extra` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attributes_property_id_index` (`property_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attribute_product`
--

DROP TABLE IF EXISTS `attribute_product`;
CREATE TABLE IF NOT EXISTS `attribute_product` (
  `attribute_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  KEY `attribute_product_attribute_id_index` (`attribute_id`),
  KEY `attribute_product_product_id_index` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE IF NOT EXISTS `blocks` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`id`, `title`, `desc`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Slajder Home', 'Slajder za home stranu', 1, '2018-04-24 07:48:02', '2018-04-24 07:50:58');

-- --------------------------------------------------------

--
-- Table structure for table `blogs`
--

DROP TABLE IF EXISTS `blogs`;
CREATE TABLE IF NOT EXISTS `blogs` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` text COLLATE utf8_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  `parent` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blogs`
--

INSERT INTO `blogs` (`id`, `title`, `slug`, `short`, `order`, `parent`, `level`, `image`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Blog', 'blog', '<p>Blog strana</p>', 1, 0, 1, 'storage/uploads/blogs/blog-jH-1.jpeg', 1, '2018-04-24 07:52:23', '2018-04-24 07:52:23');

-- --------------------------------------------------------

--
-- Table structure for table `boxes`
--

DROP TABLE IF EXISTS `boxes`;
CREATE TABLE IF NOT EXISTS `boxes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `category_id` int(10) UNSIGNED DEFAULT NULL,
  `block_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subtitle` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `button` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `boxes_category_id_foreign` (`category_id`),
  KEY `boxes_block_id_index` (`block_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `boxes`
--

INSERT INTO `boxes` (`id`, `category_id`, `block_id`, `title`, `subtitle`, `button`, `link`, `image`, `order`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, 1, 'slider 1', 'slider 1 undeer', NULL, 'shop/satovi', 'storage/uploads/boxes/RY-1.jpeg', 1, 1, '2018-04-24 07:48:37', '2018-04-24 07:49:06'),
(2, 1, 1, 'Slider 2', 'Slider 2 under', NULL, 'shop/satovi', 'storage/uploads/boxes/DP-2.jpeg', 2, 1, '2018-04-24 07:50:02', '2018-04-24 07:50:02'),
(3, 1, 1, 'Slider 3', 'slider 3 under', NULL, 'shop/satovi', 'storage/uploads/boxes/Vd-3.jpeg', 3, 1, '2018-04-24 07:50:26', '2018-04-24 07:50:26');

-- --------------------------------------------------------

--
-- Table structure for table `brands`
--

DROP TABLE IF EXISTS `brands`;
CREATE TABLE IF NOT EXISTS `brands` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `short` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `brands`
--

INSERT INTO `brands` (`id`, `title`, `slug`, `order`, `short`, `body`, `image`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Hugo boss', 'hugo-boss', 1, 'Hugo boss', '<p>Hugo boss</p>', NULL, 1, '2018-04-25 08:57:03', '2018-04-25 08:57:04'),
(2, 'Tag Heuer', 'tag-heuer', 2, 'Tag Heuer', '<p>Tag Heuer</p>', NULL, 1, '2018-04-24 11:58:41', '2018-04-24 11:58:41'),
(3, 'Chester', 'chester', 3, 'Chester', '<p>Chester</p>', NULL, 1, '2018-04-25 04:52:02', '2018-04-25 08:56:06'),
(4, 'Brend vina', 'brend-vina', 4, 'Brend vina', '<p>Brend vina</p>', NULL, 1, '2018-04-25 08:56:29', '2018-04-25 08:56:29');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short` text COLLATE utf8_unicode_ci,
  `order` int(11) NOT NULL DEFAULT '1',
  `parent` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `box_image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `title`, `slug`, `short`, `order`, `parent`, `level`, `image`, `box_image`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Fashion', 'fashion', 'Fashion', 1, 0, 1, NULL, 'images/categories/fashion.jpg', 1, '2018-04-24 07:47:43', '2018-04-24 10:07:00'),
(2, 'Watches & jewllery', 'watches-jewllery', 'Watches & jewllery', 2, 0, 1, NULL, 'images/categories/watches.jpg', 1, '2018-04-24 10:06:53', '2018-04-24 10:06:53'),
(3, 'Home & interior', 'home-interior', 'Home & interior', 3, 0, 1, NULL, 'images/categories/furniture.jpg', 1, '2018-04-24 10:07:39', '2018-04-24 10:07:39'),
(4, 'Fine dinnig', 'fine-dinnig', 'Fine dinnig', 4, 0, 1, NULL, 'images/categories/dining.jpg', 1, '2018-04-24 10:08:06', '2018-04-24 11:26:38');

-- --------------------------------------------------------

--
-- Table structure for table `category_product`
--

DROP TABLE IF EXISTS `category_product`;
CREATE TABLE IF NOT EXISTS `category_product` (
  `category_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(10) UNSIGNED NOT NULL,
  KEY `category_product_category_id_index` (`category_id`),
  KEY `category_product_product_id_index` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `category_product`
--

INSERT INTO `category_product` (`category_id`, `product_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(1, 4),
(1, 5),
(1, 6),
(1, 7),
(1, 8),
(1, 9),
(1, 10),
(1, 11),
(1, 12),
(1, 13),
(1, 14),
(1, 15),
(1, 16),
(1, 17),
(1, 18),
(1, 19),
(1, 20),
(1, 21),
(1, 22),
(1, 23),
(1, 24),
(1, 25),
(1, 26),
(1, 27),
(1, 28),
(1, 29),
(1, 30),
(1, 31),
(1, 32),
(1, 33),
(1, 34),
(1, 35),
(1, 36),
(1, 37),
(1, 38),
(1, 39),
(1, 40),
(1, 41),
(1, 42),
(1, 43),
(1, 44),
(1, 45),
(1, 46),
(1, 47),
(1, 48),
(1, 49),
(1, 50),
(2, 51),
(2, 52),
(2, 53),
(2, 54),
(2, 55),
(2, 56),
(2, 57),
(2, 58),
(2, 59),
(2, 60),
(2, 61),
(2, 62),
(2, 63),
(2, 64),
(2, 65),
(2, 66),
(2, 67),
(2, 68),
(2, 69),
(2, 70),
(2, 71),
(2, 72),
(2, 73),
(2, 74),
(2, 75),
(2, 76),
(2, 77),
(2, 78),
(2, 79),
(2, 80),
(2, 81),
(2, 82),
(2, 83),
(2, 84),
(2, 85),
(2, 86),
(2, 87),
(2, 88),
(2, 89),
(2, 90),
(2, 91),
(2, 92),
(2, 93),
(2, 94),
(2, 95),
(2, 96),
(2, 97),
(2, 98),
(2, 99),
(2, 100),
(3, 101),
(3, 102),
(3, 103),
(3, 104),
(3, 105),
(3, 106),
(3, 107),
(3, 108),
(3, 109),
(3, 110),
(3, 111),
(3, 112),
(3, 113),
(3, 114),
(3, 115),
(3, 116),
(3, 117),
(3, 118),
(3, 119),
(3, 120),
(3, 121),
(3, 122),
(3, 123),
(3, 124),
(3, 125),
(3, 126),
(3, 127),
(3, 128),
(3, 129),
(3, 130),
(3, 131),
(3, 132),
(3, 133),
(3, 134),
(3, 135),
(3, 136),
(3, 137),
(3, 138),
(3, 139),
(3, 140),
(3, 141),
(3, 142),
(3, 143),
(3, 144),
(3, 145),
(3, 146),
(3, 147),
(3, 148),
(3, 149),
(3, 150),
(4, 151),
(4, 152),
(4, 153),
(4, 154),
(4, 155),
(4, 156),
(4, 157),
(4, 158),
(4, 159),
(4, 160),
(4, 161),
(4, 162),
(4, 163),
(4, 164),
(4, 165),
(4, 166),
(4, 167),
(4, 168),
(4, 169),
(4, 170),
(4, 171),
(4, 172),
(4, 173),
(4, 174),
(4, 175),
(4, 176),
(4, 177),
(4, 178),
(4, 179),
(4, 180),
(4, 181),
(4, 182),
(4, 183),
(4, 184),
(4, 185),
(4, 186),
(4, 187),
(4, 188),
(4, 189),
(4, 190),
(4, 191),
(4, 192),
(4, 193),
(4, 194),
(4, 195),
(4, 196),
(4, 197),
(4, 198),
(4, 199),
(4, 200);

-- --------------------------------------------------------

--
-- Table structure for table `collections`
--

DROP TABLE IF EXISTS `collections`;
CREATE TABLE IF NOT EXISTS `collections` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `short` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `collections_brand_id_index` (`brand_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `menus`
--

DROP TABLE IF EXISTS `menus`;
CREATE TABLE IF NOT EXISTS `menus` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sufix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menus`
--

INSERT INTO `menus` (`id`, `title`, `slug`, `prefix`, `sufix`, `class`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Primarni', 'primarni', NULL, NULL, NULL, 1, '2018-04-24 10:37:41', '2018-04-24 10:37:41');

-- --------------------------------------------------------

--
-- Table structure for table `menu_links`
--

DROP TABLE IF EXISTS `menu_links`;
CREATE TABLE IF NOT EXISTS `menu_links` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `menu_id` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `link` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sufix` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` int(11) DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `parent` int(11) NOT NULL DEFAULT '0',
  `level` int(11) NOT NULL DEFAULT '1',
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `menu_links_menu_id_foreign` (`menu_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `menu_links`
--

INSERT INTO `menu_links` (`id`, `menu_id`, `title`, `link`, `desc`, `sufix`, `type`, `order`, `parent`, `level`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, 'Home', '/', NULL, NULL, NULL, 1, 0, 1, 1, '2018-04-24 10:42:59', '2018-04-24 10:42:59'),
(2, 1, 'Fashion', '/shop/fashion', NULL, NULL, NULL, 2, 0, 1, 1, '2018-04-24 10:43:36', '2018-04-24 10:47:40'),
(3, 1, 'Watches & jewllery', '/shop/watches', NULL, NULL, NULL, 3, 0, 1, 1, '2018-04-24 10:48:21', '2018-04-24 10:48:36'),
(4, 1, 'Home & interior', 'shop/interior', NULL, NULL, NULL, 4, 0, 1, 1, '2018-04-24 10:49:38', '2018-04-24 10:49:44'),
(5, 1, 'Fine dinnig', 'shop/fine-dinnig', NULL, NULL, NULL, 5, 0, 1, 1, '2018-04-24 10:50:47', '2018-04-24 10:50:52');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
CREATE TABLE IF NOT EXISTS `migrations` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2016_06_01_000001_create_oauth_auth_codes_table', 1),
(4, '2016_06_01_000002_create_oauth_access_tokens_table', 1),
(5, '2016_06_01_000003_create_oauth_refresh_tokens_table', 1),
(6, '2016_06_01_000004_create_oauth_clients_table', 1),
(7, '2016_06_01_000005_create_oauth_personal_access_clients_table', 1),
(8, '2018_04_17_083842_create_settings_table', 1),
(9, '2018_04_17_084733_create_themes_table', 1),
(10, '2018_04_17_094524_create_menus_table', 1),
(11, '2018_04_17_094536_create_menu_links_table', 1),
(12, '2018_04_17_101632_create_blogs_table', 1),
(13, '2018_04_18_083023_create_posts_table', 1),
(14, '2018_04_18_112345_create_brands_table', 1),
(15, '2018_04_18_131437_create_collections_table', 1),
(16, '2018_04_19_073425_create_properties_table', 1),
(17, '2018_04_19_081209_create_sets_table', 1),
(18, '2018_04_19_100214_create_attributes_table', 1),
(19, '2018_04_19_105902_create_categories_table', 1),
(20, '2018_04_20_062931_create_products_table', 1),
(21, '2018_04_23_075609_create_photos_table', 1),
(22, '2018_04_23_112517_create_blocks_table', 1),
(23, '2018_04_23_112525_create_boxes_table', 1),
(24, '2018_04_25_072612_create_tags_table', 2);

-- --------------------------------------------------------

--
-- Table structure for table `oauth_access_tokens`
--

DROP TABLE IF EXISTS `oauth_access_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_access_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `client_id` int(11) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_access_tokens`
--

INSERT INTO `oauth_access_tokens` (`id`, `user_id`, `client_id`, `name`, `scopes`, `revoked`, `created_at`, `updated_at`, `expires_at`) VALUES
('2f495261b75ed2ef2da9dbe028e6289de19e771e9c88ec1881c87efd5374f17b586c65776f640524', 1, 2, NULL, '[]', 0, '2018-04-25 08:55:04', '2018-04-25 08:55:04', '2019-04-25 10:55:04'),
('5bddc599455b2dfd2d54295650a1a0aee96cccca85b8ec3f5aa0f26497cfa692ccce6b16f15fdafd', 1, 2, NULL, '[]', 0, '2018-04-24 07:46:38', '2018-04-24 07:46:38', '2019-04-24 09:46:38'),
('7eba9dff5d96d09a11ab4554d37bf86c8fc67b54b2da91e539c9cc4c3501224d9daeeeec44ee1eda', 1, 2, NULL, '[]', 0, '2018-04-25 04:50:28', '2018-04-25 04:50:28', '2019-04-25 06:50:28');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_auth_codes`
--

DROP TABLE IF EXISTS `oauth_auth_codes`;
CREATE TABLE IF NOT EXISTS `oauth_auth_codes` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `scopes` text COLLATE utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `oauth_clients`
--

DROP TABLE IF EXISTS `oauth_clients`;
CREATE TABLE IF NOT EXISTS `oauth_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `secret` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `redirect` text COLLATE utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_clients`
--

INSERT INTO `oauth_clients` (`id`, `user_id`, `name`, `secret`, `redirect`, `personal_access_client`, `password_client`, `revoked`, `created_at`, `updated_at`) VALUES
(1, NULL, 'Laravel Personal Access Client', 'XOQqF8aleqM12aUzVNEMaCtvrOyn9ugmYkcZpFrM', 'http://localhost', 1, 0, 0, '2018-04-24 07:46:15', '2018-04-24 07:46:15'),
(2, NULL, 'Laravel Password Grant Client', 'DhbbKtMNwymeo9feAhIbxpa2UQaVbCPkL4Ss2vpS', 'http://localhost', 0, 1, 0, '2018-04-24 07:46:15', '2018-04-24 07:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_personal_access_clients`
--

DROP TABLE IF EXISTS `oauth_personal_access_clients`;
CREATE TABLE IF NOT EXISTS `oauth_personal_access_clients` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `client_id` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_personal_access_clients_client_id_index` (`client_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_personal_access_clients`
--

INSERT INTO `oauth_personal_access_clients` (`id`, `client_id`, `created_at`, `updated_at`) VALUES
(1, 1, '2018-04-24 07:46:15', '2018-04-24 07:46:15');

-- --------------------------------------------------------

--
-- Table structure for table `oauth_refresh_tokens`
--

DROP TABLE IF EXISTS `oauth_refresh_tokens`;
CREATE TABLE IF NOT EXISTS `oauth_refresh_tokens` (
  `id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `oauth_refresh_tokens`
--

INSERT INTO `oauth_refresh_tokens` (`id`, `access_token_id`, `revoked`, `expires_at`) VALUES
('63920a280314ce85da7474a1f6e975bf5d1ae200dc88349d773aa46984960278a40eef5fcd755a87', '7eba9dff5d96d09a11ab4554d37bf86c8fc67b54b2da91e539c9cc4c3501224d9daeeeec44ee1eda', 0, '2019-04-25 06:50:28'),
('6e3a348b9305811ebcb0df9d624df3b919f1d9f8cb5ae45207aae0d02d2c8a865bfcfd9189d0cfca', '2f495261b75ed2ef2da9dbe028e6289de19e771e9c88ec1881c87efd5374f17b586c65776f640524', 0, '2019-04-25 10:55:04'),
('bc54f664bc3eeaaa09d5d6d1ce75da89fa61cf5bc9aed200cce7ceae7cfe7e4d0f0ae41363f6d876', '5bddc599455b2dfd2d54295650a1a0aee96cccca85b8ec3f5aa0f26497cfa692ccce6b16f15fdafd', 0, '2019-04-24 09:46:38');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE IF NOT EXISTS `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photos`
--

DROP TABLE IF EXISTS `photos`;
CREATE TABLE IF NOT EXISTS `photos` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_id` int(10) UNSIGNED NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_path` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `file_path_small` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `photos_product_id_index` (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

DROP TABLE IF EXISTS `posts`;
CREATE TABLE IF NOT EXISTS `posts` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `blog_id` int(10) UNSIGNED NOT NULL,
  `product_id` int(11) DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `short` text COLLATE utf8_unicode_ci NOT NULL,
  `body` text COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `views` int(11) NOT NULL DEFAULT '0',
  `slider` tinyint(4) NOT NULL DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `posts_user_id_index` (`user_id`),
  KEY `posts_blog_id_index` (`blog_id`),
  KEY `posts_product_id_index` (`product_id`)
) ENGINE=InnoDB AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `blog_id`, `product_id`, `title`, `slug`, `short`, `body`, `image`, `publish_at`, `views`, `slider`, `publish`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 'Aut animi qui sit et.', 'aut-animi-qui-sit-et', 'Magni optio quia iusto. Ea expedita veritatis debitis et. Perspiciatis aut repellendus est praesentium blanditiis et.', 'A molestias ipsa nulla doloremque voluptas. Doloribus neque nam ducimus magnam dicta. Dignissimos vel architecto nihil quia placeat.\n\nEt hic sint eum voluptate. Praesentium minima alias quaerat suscipit. Quis tenetur modi ea odio quibusdam sint.', 'storage/images/slider1.jpeg', '2018-04-20 21:02:04', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(2, 1, 1, NULL, 'Est minima et suscipit nulla natus error.', 'est-minima-et-suscipit-nulla-natus-error', 'Sed inventore quae suscipit repellat. Qui quo ea ea vel amet praesentium. Id culpa et natus veritatis.', 'Illo modi aut et velit quis id. Quidem minima dolores sapiente suscipit. Rem architecto excepturi recusandae non quaerat.\n\nQuia aut laborum odio omnis vel. Rem nulla id dicta sunt. Eum dolorem eaque corporis ea aspernatur molestiae ab quae. Sunt iure numquam porro corrupti non qui. Voluptas quas corporis quia et.', 'storage/images/slider3.jpeg', '2018-04-23 11:52:27', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(3, 1, 1, NULL, 'Id magni numquam consectetur corrupti numquam.', 'id-magni-numquam-consectetur-corrupti-numquam', 'Expedita perferendis quis et earum. Est cum blanditiis quasi eum sapiente. Quae dolores molestias pariatur aspernatur rem molestias saepe non. Aut et blanditiis neque minus fugit.', 'Praesentium temporibus et esse enim illo delectus. Aut aut ullam pariatur voluptas cum doloremque inventore. Accusamus id eum necessitatibus voluptas.\n\nSimilique magnam ut id iusto cupiditate culpa autem. Voluptatibus consequuntur nisi maxime veniam dignissimos quibusdam. Nihil quia consequuntur quo consequuntur eligendi sunt sit nostrum.', 'storage/images/slider2.jpeg', '2018-04-18 22:08:33', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(4, 1, 1, NULL, 'Ad corrupti corporis minima qui tenetur totam.', 'ad-corrupti-corporis-minima-qui-tenetur-totam', 'Facilis inventore odit et et eligendi. Aspernatur facilis harum nihil error nobis tempora. Ut voluptas unde molestiae mollitia.', 'Voluptas optio rem alias dolorem temporibus nisi. In earum quas id ut. Culpa incidunt omnis saepe non.\n\nArchitecto omnis voluptatum sunt et quas in qui. Earum quia debitis sequi aliquid quia nobis. Voluptas et vel rerum provident in sint. Et sit quas officiis et non aperiam architecto. Rem ut perspiciatis voluptatem fuga quasi rerum numquam.', 'storage/images/slider3.jpeg', '2018-03-30 05:33:17', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(5, 1, 1, NULL, 'Quae explicabo et assumenda vitae eos quia in.', 'quae-explicabo-et-assumenda-vitae-eos-quia-in', 'Blanditiis voluptatem vel doloremque dolore quasi. Unde soluta neque est veritatis iure porro. Qui in reprehenderit aspernatur aut. Ducimus quia enim repellendus.', 'Ducimus aperiam veritatis fugiat fugit quis ad. Natus illum maiores voluptas et. Similique eum nam odit ea ut praesentium eum. Repellendus soluta architecto dolores tempore animi provident culpa et.\n\nNemo qui incidunt asperiores fugit ut voluptate. Neque ab vel maxime est exercitationem corrupti.', 'storage/images/slider1.jpeg', '2018-03-28 12:02:20', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(6, 1, 1, NULL, 'Nisi aut qui eos eum rem aut.', 'nisi-aut-qui-eos-eum-rem-aut', 'Commodi deleniti vel autem vel sint repellendus quaerat nulla. Sed voluptates magnam ipsa sit. Est ea quo commodi placeat nesciunt.', 'Dolor laborum eum ea unde cupiditate quasi ipsum. Eaque qui cumque quo a ab maxime. Libero beatae et nihil sit vel sed laboriosam.\n\nEt quas vel natus repudiandae perspiciatis est. Sed dolor quia et illum delectus qui molestiae. Libero consequatur recusandae eos temporibus qui sequi.', 'storage/images/slider3.jpeg', '2018-03-28 07:28:58', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(7, 1, 1, NULL, 'Unde facere iste autem numquam.', 'unde-facere-iste-autem-numquam', 'Quo vero nobis fugiat velit error. Aut at ipsum qui dicta perferendis et ut. Est qui culpa quia fuga nisi porro consequatur. Fugit et aut iste numquam reprehenderit exercitationem.', 'Et vero quo magni eos. Doloremque omnis nemo voluptatem iure sit. Quos cumque sunt voluptate iure.\n\nPerspiciatis voluptatem vitae incidunt. Et esse consequatur dignissimos natus praesentium dolores et laborum. Est animi praesentium minus nihil. Ut et vel rerum.', 'storage/images/slider3.jpeg', '2018-04-15 22:50:13', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(8, 1, 1, NULL, 'Mollitia aperiam id quidem delectus.', 'mollitia-aperiam-id-quidem-delectus', 'At maiores ut qui eum debitis. Qui veniam quis rem quam illo.', 'Laborum facilis sunt pariatur iure aspernatur quia. Omnis aut consequuntur ratione alias sit ratione. Rerum velit voluptas incidunt officiis autem. Quisquam sunt ut esse odit nihil est. Doloribus perferendis odit consequuntur quis tenetur tempore.\n\nLaborum est hic omnis hic rerum inventore. Odit repellendus vitae consequatur asperiores nihil. Sunt voluptates vel eos ratione sint est. Voluptatem totam autem odio enim explicabo.', 'storage/images/slider3.jpeg', '2018-04-10 19:33:27', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(9, 1, 1, NULL, 'Placeat esse quis minus atque.', 'placeat-esse-quis-minus-atque', 'Adipisci vero eius et corporis assumenda possimus. Modi amet ullam voluptate amet ipsa dolores aperiam. Sunt et doloremque aspernatur dignissimos quia quibusdam qui.', 'Voluptatum voluptatem culpa aut repellendus harum enim et. Quo eaque aut qui distinctio nemo. Numquam a laboriosam culpa. Est aut porro error consequatur.\n\nExcepturi ipsum eius molestiae dignissimos aut quasi et ad. Et quisquam rerum placeat. Amet alias quos vel ut quo aut sed. Enim qui blanditiis dolores rerum et excepturi facere et.', 'storage/images/slider1.jpeg', '2018-04-13 07:46:27', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(10, 1, 1, NULL, 'Voluptates voluptatem error quasi eveniet odio eligendi aut delectus.', 'voluptates-voluptatem-error-quasi-eveniet-odio-eligendi-aut-delectus', 'Exercitationem iusto et aut ratione voluptatem autem. Sed dolorem atque omnis veritatis. Sed eos delectus officiis aut. Voluptas hic sint modi in ab magni sunt enim.', 'Minima quasi sit omnis minus. Enim vel velit minima voluptate voluptatem. Temporibus aut et voluptas voluptatibus exercitationem quo. Quia aspernatur harum culpa omnis.\n\nLaudantium libero repellendus ea magni aliquam nihil repudiandae asperiores. Omnis sapiente voluptatibus omnis aperiam officia ab animi. Earum autem id magnam eius repellat nihil et voluptates.', 'storage/images/slider1.jpeg', '2018-04-18 20:30:28', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(11, 1, 1, NULL, 'Omnis ducimus repellendus vero voluptatem fugiat.', 'omnis-ducimus-repellendus-vero-voluptatem-fugiat', 'Cumque quia cumque officiis qui. Aliquam voluptas delectus aut sed iure. Aut tempora dolorum sed voluptatem aliquid ut consequatur.', 'Aut perferendis aperiam cumque. Est magnam tempore nihil voluptatem. At aut repudiandae impedit non sint voluptatum repudiandae. Veritatis quia ratione nobis harum.\n\nEligendi tenetur voluptatum occaecati repellat sunt. Esse alias laudantium eveniet in ea laboriosam. Adipisci voluptas ut officiis et magnam molestias.', 'storage/images/slider2.jpeg', '2018-04-06 10:27:35', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(12, 1, 1, NULL, 'Fugit reiciendis eum magnam enim et.', 'fugit-reiciendis-eum-magnam-enim-et', 'Consequatur rerum reiciendis debitis soluta quaerat sunt non. Et esse exercitationem qui praesentium. Natus voluptas cupiditate ut.', 'Cupiditate sint ex omnis voluptatum ut. Repudiandae quia consequuntur explicabo voluptatem sit. Id tempora modi ipsam placeat. Sed sapiente officia ipsa et. Adipisci perspiciatis ducimus aut sed pariatur ut veniam.\n\nQui pariatur harum odio aliquid dignissimos odio. Ipsa molestias saepe omnis aut. Tenetur voluptas fugiat quis nihil maxime. Aliquid qui nihil dignissimos rerum quis illum quam.', 'storage/images/slider2.jpeg', '2018-04-09 18:13:23', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(13, 1, 1, NULL, 'In ut fuga id dolorem occaecati incidunt occaecati.', 'in-ut-fuga-id-dolorem-occaecati-incidunt-occaecati', 'Facilis ea explicabo officia impedit tenetur autem voluptas. Non repudiandae est quos. Id recusandae officia et earum velit maxime qui.', 'Quia quos quis similique voluptas maiores cum. Asperiores dolor illum officia ad praesentium et iste. Minima consequatur sint dolor modi sit repellat facilis. Illum necessitatibus necessitatibus earum nemo voluptatibus modi nobis qui.\n\nPariatur sed est et sed perspiciatis reiciendis aut. Unde est deserunt quis officia ab et reiciendis. Placeat placeat ullam laboriosam tempora. Quam minus eos ullam laboriosam ut. Quae exercitationem consequatur velit reprehenderit sunt qui.', 'storage/images/slider2.jpeg', '2018-04-04 22:56:34', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(14, 1, 1, NULL, 'Omnis quaerat quibusdam ut ipsum consequatur officia.', 'omnis-quaerat-quibusdam-ut-ipsum-consequatur-officia', 'Dolor ab ut aperiam quasi. Quasi aut odit sed corrupti tempora et. Est recusandae ut distinctio repudiandae temporibus accusantium provident.', 'Atque quae consequuntur quia quo omnis et. Explicabo ex minima excepturi quisquam quod ut minus.\n\nExpedita quibusdam fugiat porro similique ullam quia est. Mollitia fuga sunt illum incidunt veniam. Quis nulla magni consequatur quis facere nihil cupiditate. Sit maiores totam accusamus perferendis temporibus. Reprehenderit praesentium odit sed ullam distinctio facere et.', 'storage/images/slider2.jpeg', '2018-04-05 19:21:36', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(15, 1, 1, NULL, 'Assumenda inventore dolorum consequatur porro.', 'assumenda-inventore-dolorum-consequatur-porro', 'Enim corrupti qui architecto veniam fuga officiis sed. Voluptatem architecto officia voluptatem sit.', 'Optio at commodi voluptatum ab dolores cumque. Culpa cumque qui ipsum ipsa perferendis maxime. Magnam nam dolores deserunt non omnis consequuntur. Doloribus voluptatibus qui sed.\n\nVelit dolorum modi sunt velit et dolor ducimus. Odio accusantium pariatur vitae ea non. Adipisci ut et veritatis qui quasi placeat. Rem adipisci quam asperiores dolor saepe corrupti atque.', 'storage/images/slider1.jpeg', '2018-04-15 03:43:41', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(16, 1, 1, NULL, 'Eligendi mollitia accusamus blanditiis dignissimos doloribus.', 'eligendi-mollitia-accusamus-blanditiis-dignissimos-doloribus', 'Ducimus laborum quia quos maxime nisi. Asperiores ipsa molestias ipsa. Qui recusandae voluptates reprehenderit nobis voluptatem quis commodi soluta.', 'Odit sit praesentium sed aut aut. Quo perferendis voluptates esse aut delectus perspiciatis ipsum. Ut reprehenderit et et quia magni in accusamus assumenda. Eum mollitia ratione esse quasi.\n\nNon ab recusandae ratione sed ducimus possimus. Assumenda est accusantium dolores vel. Aut distinctio omnis sit pariatur asperiores non.', 'storage/images/slider2.jpeg', '2018-03-28 16:36:04', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(17, 1, 1, NULL, 'Quisquam natus dolorem eos provident qui enim dolor.', 'quisquam-natus-dolorem-eos-provident-qui-enim-dolor', 'Laborum ea aut incidunt sequi eum ut. Animi et fugiat hic impedit ut mollitia. Delectus non ipsam rerum laborum omnis. Autem natus ipsam est repudiandae omnis.', 'Molestiae omnis consequatur autem enim accusantium ut fugit illum. Unde vitae eius eos amet. Voluptas expedita corrupti iure aut. Architecto debitis nulla et molestiae voluptas est.\n\nQuia repellendus sint autem accusantium enim magnam. Rem consequuntur nobis sit perspiciatis aperiam quis quam vitae. Voluptas minima qui eum molestiae incidunt repudiandae possimus. Laboriosam aspernatur laboriosam et quia quisquam.', 'storage/images/slider1.jpeg', '2018-03-25 21:41:14', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(18, 1, 1, NULL, 'A aspernatur qui nulla iure.', 'a-aspernatur-qui-nulla-iure', 'Expedita ea ut odit eius. Velit et et dolores aut. Officia odit deserunt est alias dolores rerum.', 'Excepturi ut exercitationem optio mollitia. Suscipit et sit ad facere eveniet animi quas. Illum distinctio perspiciatis rem rerum iusto eum aliquam ullam.\n\nQui omnis eum illo perferendis. Quaerat minus corrupti praesentium quam nam. Odio minus vel eaque maxime porro et nesciunt voluptas. Omnis amet neque dignissimos dolores.', 'storage/images/slider3.jpeg', '2018-03-29 22:40:06', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(19, 1, 1, NULL, 'Nesciunt cupiditate eligendi ducimus impedit et ut non.', 'nesciunt-cupiditate-eligendi-ducimus-impedit-et-ut-non', 'Ea voluptas omnis neque et in. Cum laborum culpa ex facere placeat ut molestiae cumque. Cum et et aut commodi dolor recusandae. Soluta iusto libero est vitae aut.', 'Eum soluta quasi quia. Omnis repudiandae qui in nobis. Animi nam quod id amet nemo.\n\nQui voluptatem aspernatur velit. Aliquam qui sed quia hic ut. Tempora nemo a rem ut ut quos aut. Laudantium in quidem non quos sed enim voluptates ut.', 'storage/images/slider1.jpeg', '2018-04-07 04:31:10', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(20, 1, 1, NULL, 'Accusantium et sunt sit architecto dolores et.', 'accusantium-et-sunt-sit-architecto-dolores-et', 'Omnis nemo consequatur sed expedita pariatur molestiae ut doloribus. Eaque rerum minus adipisci repudiandae cum possimus quos ab. Dolore sit iure nobis sed dignissimos ab. Suscipit cumque iusto et tempora hic.', 'Expedita doloribus ut accusantium quis enim et rerum error. Facere officiis aut provident porro blanditiis repellat iure fugit. Omnis dignissimos quod exercitationem dignissimos et totam ullam. Placeat quaerat aut aperiam dolorem in eius.\n\nRatione quos sapiente ea. Aut maiores quo laudantium. Dolore nemo incidunt et.', 'storage/images/slider1.jpeg', '2018-04-23 10:55:35', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(21, 1, 1, NULL, 'Dignissimos eligendi numquam nihil aliquam distinctio.', 'dignissimos-eligendi-numquam-nihil-aliquam-distinctio', 'Nihil cumque nisi aliquam voluptas impedit velit libero. Dolores ut delectus temporibus rerum.', 'Maiores laudantium vel itaque delectus facere. Occaecati ut quaerat labore aliquid. Et omnis deserunt nihil vitae fuga dolor labore. Sit aliquid expedita molestiae ut.\n\nMaiores consequatur voluptatem dolorem deserunt ab. Saepe aut similique et blanditiis. Distinctio eum dolorum repellendus officiis dignissimos unde ipsam.', 'storage/images/slider1.jpeg', '2018-04-09 04:37:25', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(22, 1, 1, NULL, 'Magnam cumque eligendi culpa.', 'magnam-cumque-eligendi-culpa', 'Dolorem perspiciatis impedit quia autem. Inventore laborum velit sint asperiores. Est ut libero debitis aut.', 'Eos nemo odio dolores dignissimos. Delectus doloremque dolores eos dicta ab perspiciatis. Eum aut dicta asperiores iste modi. Nihil consequatur explicabo itaque repudiandae.\n\nQuia dolor unde quisquam ratione incidunt et vitae ut. Assumenda eligendi consequatur quis quia. Consequatur corporis veniam sunt quisquam.', 'storage/images/slider2.jpeg', '2018-04-20 08:14:04', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(23, 1, 1, NULL, 'Qui cum odit nostrum harum architecto.', 'qui-cum-odit-nostrum-harum-architecto', 'Suscipit molestias fugit tenetur omnis. Doloribus ea voluptate dicta aut deserunt rerum. Exercitationem repellendus saepe vel consequatur est cumque.', 'Explicabo alias asperiores molestiae temporibus sit praesentium vel natus. Sed quas sit et rerum quia sit assumenda quae. Et voluptas nulla debitis maxime nam debitis. Reiciendis odit eaque rerum ut ut cumque error. Perferendis qui nihil ducimus quod rem eveniet sed.\n\nAut consequatur placeat deserunt necessitatibus voluptatem sed rem. Laboriosam impedit voluptatem non maxime. Vel reprehenderit veritatis voluptas hic aspernatur odit aut.', 'storage/images/slider3.jpeg', '2018-04-06 13:58:26', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(24, 1, 1, NULL, 'Voluptas sapiente ea illo ipsa itaque.', 'voluptas-sapiente-ea-illo-ipsa-itaque', 'Et aspernatur non quo modi consequatur voluptatem omnis. Assumenda accusantium ex sed libero. Quidem sapiente in illum distinctio labore et itaque.', 'Excepturi accusamus rerum odio quia et voluptas. Dolorem sapiente animi doloremque blanditiis mollitia. Omnis distinctio rerum et omnis voluptas aut. Ipsam esse molestias consequatur.\n\nQuisquam quo ea culpa voluptate quibusdam. Ut qui fugiat ad voluptatem quidem ullam accusantium. Ut qui nemo numquam qui totam id occaecati. Facere laboriosam praesentium voluptate ipsum. Autem quo provident sint laboriosam dicta et reprehenderit.', 'storage/images/slider1.jpeg', '2018-04-23 13:19:12', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(25, 1, 1, NULL, 'Praesentium facere assumenda exercitationem qui.', 'praesentium-facere-assumenda-exercitationem-qui', 'Suscipit dolor et atque excepturi et ea harum. Optio impedit similique deleniti et modi omnis. Placeat qui aut laudantium neque ducimus quia facilis. Libero ipsa praesentium harum optio.', 'Sequi nihil temporibus architecto voluptatem sit est et. Consequatur nostrum sit facere quae dolor recusandae nobis tenetur. Odit iusto minus qui ad corrupti eos sapiente nulla.\n\nTenetur qui minima praesentium cupiditate est cum quasi. Est voluptatibus necessitatibus qui natus quo est amet. Dolor dolore fugit maxime perferendis. Ut non sed quia deserunt voluptate hic repellat nam.', 'storage/images/slider1.jpeg', '2018-04-09 21:24:33', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(26, 1, 1, NULL, 'Maiores nostrum ut qui temporibus excepturi tenetur quos.', 'maiores-nostrum-ut-qui-temporibus-excepturi-tenetur-quos', 'Deleniti maxime aperiam in. Voluptates sit labore nisi dolor quod est quibusdam vel. Rerum aspernatur voluptatibus nulla ipsam aut nesciunt. Ipsa eius eum doloribus similique.', 'Unde voluptatibus unde omnis blanditiis labore dolorem delectus. Et blanditiis excepturi voluptas esse. Sed amet dolorem quo mollitia facilis. Rerum ut et vel quia dolorem dignissimos ab.\n\nDolor sit et aut et. Et debitis laudantium corrupti voluptas. Dolorem natus facere qui debitis. Accusamus amet asperiores libero.', 'storage/images/slider3.jpeg', '2018-04-20 02:15:27', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(27, 1, 1, NULL, 'Dignissimos fuga soluta facilis vel expedita quas.', 'dignissimos-fuga-soluta-facilis-vel-expedita-quas', 'Velit voluptas iste odit reprehenderit deserunt sed aliquam. Odio dolorem quisquam sit laudantium. Est sed perferendis nihil cumque maxime aut. Veniam id sunt voluptas sunt qui ut fugit.', '<p>Veritatis quia et quam reprehenderit iste laborum aut. Eligendi hic voluptas qui ipsa aut voluptatem at. Dolorem animi cum aliquam repellendus ut quae quo sed. Nesciunt excepturi non omnis laudantium. Nihil cumque explicabo ut earum fugiat amet et. Aut sint tempora praesentium ut consequatur voluptas. Adipisci quis commodi reiciendis magnam. Rerum aut adipisci voluptatum nisi dolor.</p>', 'storage/images/slider3.jpeg', '2018-04-17 08:00:00', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-25 12:40:12'),
(28, 1, 1, NULL, 'Sunt qui quae animi at sit tenetur ut.', 'sunt-qui-quae-animi-at-sit-tenetur-ut', 'Pariatur quis eum animi. Fugit et totam eum sit. Ut et aut est officiis quo at.', 'Quis voluptatum laborum tempora distinctio. Repellendus voluptatem autem commodi et. Itaque reprehenderit nobis consequatur culpa.\n\nMolestiae id et ut quia dolor iure est sed. Consequuntur molestiae beatae unde corrupti nesciunt quia dolorum quaerat.', 'storage/images/slider3.jpeg', '2018-03-28 10:17:26', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(29, 1, 1, NULL, 'Ipsum ut architecto nobis.', 'ipsum-ut-architecto-nobis', 'Architecto eveniet omnis perspiciatis debitis. Dolorum sit sed id. Labore nam et et doloremque consectetur repudiandae laudantium. Adipisci quia nam aut porro. Aliquid ut qui ut labore inventore.', 'Voluptates et alias recusandae odio aliquam rerum. Eos voluptatem iure culpa sint ducimus. Debitis enim vel et tempora.\n\nRerum quos cumque qui aut. Vitae est omnis vel molestiae aperiam dolor explicabo voluptas. Qui ducimus fugit quis qui cum doloribus aliquam. Temporibus magni maxime qui voluptas odit eligendi voluptas.', 'storage/images/slider3.jpeg', '2018-04-01 18:16:04', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(30, 1, 1, NULL, 'Qui nam deleniti perspiciatis molestiae ad deleniti.', 'qui-nam-deleniti-perspiciatis-molestiae-ad-deleniti', 'Nisi ex est asperiores sit. Veniam atque quo eius aliquam. Rerum nihil eveniet praesentium dolor dolores adipisci.', 'Dolores et libero sunt itaque reiciendis. Voluptas aliquam amet repellendus quisquam. Debitis autem voluptas et enim. Molestiae rem excepturi corporis sit.\n\nVelit dolorum tempore temporibus expedita. Animi id harum quos sit beatae distinctio pariatur. Voluptate qui accusantium neque voluptate in.', 'storage/images/slider3.jpeg', '2018-04-16 21:58:55', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(31, 1, 1, NULL, 'Sed aut itaque incidunt ipsa molestiae aut totam.', 'sed-aut-itaque-incidunt-ipsa-molestiae-aut-totam', 'Voluptas quo sit dolorem nisi. Aut esse quia maxime ad voluptas. Accusamus reprehenderit exercitationem autem nostrum. Eaque omnis explicabo praesentium delectus.', 'Dicta laboriosam eos perferendis. Ab minus placeat sint reprehenderit aut quia voluptatem. Est sed exercitationem repellendus excepturi ut.\n\nIusto illo odio possimus sunt laudantium. Nemo ex molestiae dignissimos fugiat repudiandae possimus. Et accusantium fugiat ab nesciunt iusto molestias dolor.', 'storage/images/slider3.jpeg', '2018-04-09 23:22:26', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(32, 1, 1, NULL, 'Harum veniam ad eos ut consequuntur sequi id nulla.', 'harum-veniam-ad-eos-ut-consequuntur-sequi-id-nulla', 'Quod corrupti iste voluptatem veritatis nemo. Quaerat qui repudiandae ea officia. Consequatur sint et nesciunt deleniti.', 'Tenetur et voluptate modi consequatur voluptatem sit. Est voluptatum rerum inventore corporis. Vel ab sed sapiente repellendus et magnam.\n\nPariatur vel veritatis et ea corporis. Sint error aliquam qui qui sed velit aperiam. Dolorem eos porro id unde. Occaecati totam ea ut hic dignissimos.', 'storage/images/slider1.jpeg', '2018-04-05 08:16:38', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(33, 1, 1, NULL, 'Nihil odio fuga porro.', 'nihil-odio-fuga-porro', 'Magni amet aut consequuntur error a. Quos nam magni id. Ut voluptatem est sed quam blanditiis. Tempore quidem laborum ducimus error.', 'Quas deleniti voluptas laudantium id quo mollitia. Nobis omnis fugiat voluptatem asperiores debitis ipsam nihil qui. Soluta vel incidunt autem.\n\nNeque porro dolore porro et. Dolores eligendi alias debitis aut. In dolorem provident sunt molestiae facere eos.', 'storage/images/slider2.jpeg', '2018-04-20 19:00:18', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(34, 1, 1, NULL, 'Dolorem nobis vero ut eaque animi sequi aut.', 'dolorem-nobis-vero-ut-eaque-animi-sequi-aut', 'Impedit iusto quis in enim delectus. Magnam voluptate ad praesentium recusandae minus voluptas. Ut quos et vel est sequi neque. Occaecati rerum aspernatur accusantium at.', 'Cum quia nam animi corrupti voluptatem consequatur voluptate. Amet iusto quae consequatur itaque aperiam ut. Omnis excepturi qui sequi minima et ex et.\n\nDistinctio eos iure quasi quis voluptatem odit. Minima fuga occaecati quo molestias. Voluptas optio corrupti tenetur rerum consequuntur autem id. Cum quam est et incidunt.', 'storage/images/slider2.jpeg', '2018-03-30 01:34:11', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(35, 1, 1, NULL, 'Porro voluptas ipsa quo unde aut quis.', 'porro-voluptas-ipsa-quo-unde-aut-quis', 'Hic perspiciatis tempora eaque. In fuga officiis et nisi. Dignissimos explicabo et quae alias dolores at.', 'Rerum et vero sed sed hic quidem saepe qui. Non molestiae consequatur eos consequuntur voluptates. Corrupti hic animi non. In quis et rerum numquam sed.\n\nEx quisquam tenetur vero dolorem est. Optio minima cum culpa nemo et et et voluptatum. Molestiae quo nulla illo sint temporibus id.', 'storage/images/slider3.jpeg', '2018-04-01 06:18:34', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(36, 1, 1, NULL, 'Sed deserunt tenetur molestiae rem quibusdam a totam.', 'sed-deserunt-tenetur-molestiae-rem-quibusdam-a-totam', 'Tenetur aut voluptas alias explicabo illo explicabo. Autem voluptate voluptatem et voluptatibus ut dolorem veritatis. Explicabo id voluptate cum ut cum tenetur amet excepturi. Esse qui sit quidem.', 'Nemo expedita repellendus vero id vel eum. Distinctio quas qui suscipit molestiae corporis totam. Et beatae error atque qui et. Consequatur ex qui velit autem.\n\nRerum illo est illum. Et at sed in dolores nam et. Placeat itaque fugit accusamus quibusdam dicta.', 'storage/images/slider3.jpeg', '2018-04-02 13:31:07', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(37, 1, 1, NULL, 'Ea blanditiis sed ipsam aut.', 'ea-blanditiis-sed-ipsam-aut', 'Nemo delectus eligendi blanditiis architecto quibusdam neque aperiam. Ipsa magni qui quis molestiae ducimus sit eligendi. Vitae eaque officiis sint sunt. Soluta neque totam doloribus omnis. Ut ut sint eaque illum consequuntur eligendi.', 'Et temporibus tempore sapiente corrupti. Eligendi doloribus aut cum ab soluta atque ea. Quas asperiores dolorum ea quis quas pariatur.\n\nAccusamus dolores quibusdam dolorem temporibus consequatur laborum. Eum facere autem deleniti culpa quos. Omnis facilis esse blanditiis eum.', 'storage/images/slider2.jpeg', '2018-04-22 01:07:40', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(38, 1, 1, NULL, 'Ex nostrum sapiente et ea et.', 'ex-nostrum-sapiente-et-ea-et', 'Nobis iste quia distinctio veritatis et asperiores iusto. Laboriosam consequatur et debitis et ut exercitationem.', 'At debitis sunt tenetur. Voluptas eligendi est quo dolores necessitatibus minus. Repellendus est debitis non et possimus non quae.\n\nVoluptatem excepturi natus accusantium et. Et aspernatur nihil ut tempora labore. Ipsam autem placeat quia culpa sint aut minus.', 'storage/images/slider2.jpeg', '2018-04-05 07:46:03', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(39, 1, 1, NULL, 'Tempore eos magni laboriosam consectetur possimus.', 'tempore-eos-magni-laboriosam-consectetur-possimus', 'Libero cupiditate iste sequi enim laudantium nihil. Ut laboriosam quia eos sit quas aut et voluptatum. Officiis rem qui alias assumenda perferendis consequatur.', 'Aut doloribus maiores velit sunt est qui. Commodi perspiciatis et dolor. Et impedit ut occaecati quas.\n\nRepellat eos sed omnis incidunt unde. Impedit voluptas ut nemo eos architecto quasi. Repellendus quo et voluptatem quisquam debitis consequatur. Enim ullam sequi inventore eum possimus. Consequatur omnis non quia accusantium ipsam vel.', 'storage/images/slider2.jpeg', '2018-03-27 23:51:16', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(40, 1, 1, NULL, 'Nihil et aperiam qui illo fuga qui voluptatem natus.', 'nihil-et-aperiam-qui-illo-fuga-qui-voluptatem-natus', 'Aut mollitia in occaecati quis excepturi eligendi. Placeat expedita earum qui soluta rerum laborum. Atque veritatis perferendis aliquam occaecati ducimus earum praesentium. Consequuntur aut quia sunt mollitia officiis suscipit nemo.', 'Tempora corrupti dolores eum. Labore architecto recusandae aliquid ut rerum. Voluptatem earum quia et harum asperiores expedita. Quo molestias quasi harum soluta harum.\n\nSed ut quae similique accusantium. Occaecati quis dolorum itaque ut. Nihil voluptas alias nisi aut dolores. Consequatur et minima odio cumque.', 'storage/images/slider2.jpeg', '2018-04-07 18:17:29', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(41, 1, 1, NULL, 'Quo laboriosam ea omnis a.', 'quo-laboriosam-ea-omnis-a', 'Tempore esse ea necessitatibus maiores deserunt assumenda. In rerum aut consequatur omnis explicabo quia est.', 'Ullam porro omnis eveniet ea qui perspiciatis. Rerum laboriosam rerum aut dolor vel.\n\nIusto architecto sit in natus voluptates enim praesentium. Eligendi fugiat ab et provident. Nulla officia nesciunt est. Fuga molestias non at nihil.', 'storage/images/slider3.jpeg', '2018-04-18 08:18:25', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(42, 1, 1, NULL, 'In dolorum ut molestiae eos ipsam quo.', 'in-dolorum-ut-molestiae-eos-ipsam-quo', 'Nemo vel neque facere. Culpa at et consequuntur quae illo quia. Ullam sint aut autem labore voluptas. Mollitia deleniti qui maxime et deleniti qui.', 'Consequatur aut non minus totam. Dolorem atque atque consequatur quasi. Dolorem atque dignissimos non repudiandae voluptatum dolorem nobis.\n\nEsse mollitia voluptatem perferendis omnis. Ipsam ipsam deleniti tenetur recusandae perspiciatis.', 'storage/images/slider3.jpeg', '2018-04-07 12:42:40', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(43, 1, 1, NULL, 'Sit provident blanditiis molestiae fuga nesciunt.', 'sit-provident-blanditiis-molestiae-fuga-nesciunt', 'Error velit voluptas sed repudiandae assumenda. Esse vero saepe illum temporibus commodi enim. Et est aut hic itaque voluptates. Sapiente corporis et omnis consequatur odit qui omnis.', 'Eius et asperiores facere reiciendis praesentium numquam qui laborum. Laudantium ratione voluptas dolores et. Velit ad consectetur quam distinctio. Voluptatem et ut sed ex.\n\nError nihil corrupti fuga beatae repudiandae. Itaque sed tempore rem vero. Dicta minima consectetur autem libero illum ipsa facere.', 'storage/images/slider1.jpeg', '2018-04-18 02:56:51', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(44, 1, 1, NULL, 'Error sint quo optio commodi laborum dolores illum.', 'error-sint-quo-optio-commodi-laborum-dolores-illum', 'Vel nihil quaerat quia beatae aut. At animi mollitia dolores voluptatibus. Blanditiis saepe qui et non pariatur ab.', 'Quisquam distinctio fugiat dolor rerum. Ipsum sunt dolores fugit dolorem placeat quaerat debitis ut. Et tempore eaque quis voluptatibus quas ut.\n\nId a consequatur quia nobis. Fugiat aliquid ipsum vel ut ut voluptatem. Voluptatum vel enim rem eum impedit ea. Consectetur accusamus deleniti et amet.', 'storage/images/slider1.jpeg', '2018-04-07 08:10:16', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(45, 1, 1, NULL, 'Voluptatum dolor eos perspiciatis veritatis inventore dolores quasi.', 'voluptatum-dolor-eos-perspiciatis-veritatis-inventore-dolores-quasi', 'Autem quaerat quaerat sed aperiam est. Et molestiae sed error autem. Est ad excepturi explicabo aperiam cum.', 'Culpa eaque et dolorum facere id totam accusamus nulla. Odio tenetur qui quia nam harum accusamus. Ratione excepturi ut nulla quod iure. Porro sunt dolorem ea quibusdam velit aut.\n\nSint nulla quaerat maiores dolores aut ut architecto. Cumque in quae consequatur provident et nemo. Quaerat impedit quia eligendi dolores aliquam expedita est. Ut omnis quia quas in qui molestiae culpa.', 'storage/images/slider1.jpeg', '2018-04-03 21:45:32', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(46, 1, 1, NULL, 'Ut inventore minima cum perferendis ad.', 'ut-inventore-minima-cum-perferendis-ad', 'Ea neque et est quis omnis repellendus. Ducimus omnis mollitia reiciendis sed molestiae mollitia. Rem fugit totam sed earum fugit.', 'Rerum reprehenderit suscipit repellat. Quos consequuntur non vel ipsam molestiae nesciunt explicabo. Ex rerum sint mollitia error eum consequatur.\n\nOdit ullam unde et. Aut aut ratione illum ipsam nostrum nulla est. Suscipit eius dolore enim est. Mollitia nisi quod unde.', 'storage/images/slider2.jpeg', '2018-03-28 05:17:03', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(47, 1, 1, NULL, 'Architecto fugiat aut architecto maxime.', 'architecto-fugiat-aut-architecto-maxime', 'Sed quo id eum et rerum. Et rem in nam voluptas inventore modi et. Laudantium nisi omnis totam cum ullam veritatis repellat. Possimus est voluptatem corrupti harum cum voluptas.', 'Consectetur reprehenderit ut atque minima rerum voluptatibus doloremque. Perferendis vel asperiores omnis est. Id assumenda sapiente consequuntur quis aut deserunt. Sit sint placeat harum officiis ut ipsam tempore.\n\nFuga nisi praesentium officia labore. Corrupti adipisci et voluptatem voluptatem ut beatae excepturi.', 'storage/images/slider1.jpeg', '2018-03-28 08:25:27', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(48, 1, 1, NULL, 'Magnam autem facere dolore beatae.', 'magnam-autem-facere-dolore-beatae', 'Odit quidem repellendus laboriosam modi dolores neque. Dolorum magni voluptas ut doloribus numquam voluptatem est. Repudiandae tempora sed ut perspiciatis.', 'Quia rerum perspiciatis culpa aut. Minus modi itaque voluptatum ducimus amet officiis quaerat. At sequi reiciendis assumenda rerum animi commodi autem laborum. Quae quibusdam nemo corrupti ex.\n\nQuia molestias repudiandae possimus qui. Et amet eos consequuntur cumque dolor voluptatum enim. Iusto aut aliquam molestias tempore quam quidem quas. Officiis nihil corporis earum autem eveniet excepturi dicta.', 'storage/images/slider3.jpeg', '2018-04-17 04:29:17', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(49, 1, 1, NULL, 'Quia praesentium ut nobis dolor sit ut iure dolore.', 'quia-praesentium-ut-nobis-dolor-sit-ut-iure-dolore', 'Possimus dolorem est assumenda et. Voluptates id et porro ea distinctio aut dignissimos. Soluta commodi sed quia est voluptatem at. Placeat omnis dolores error facilis.', 'Quaerat nihil aspernatur laboriosam. Optio quas corporis aut maxime qui dolorem. Dolores molestiae porro ut autem officiis similique. Dignissimos a ut quisquam error qui tempore ut. Alias dolorem qui et aut est.\n\nEveniet vel debitis quia et a provident. Quo illo quo explicabo ab. Odit sint voluptatem et quo atque ut.', 'storage/images/slider3.jpeg', '2018-03-28 23:18:18', 0, 0, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37'),
(50, 1, 1, NULL, 'Hic voluptas facilis voluptas laboriosam dolorum vitae.', 'hic-voluptas-facilis-voluptas-laboriosam-dolorum-vitae', 'Numquam tempore et sint sed. Consequuntur error veritatis tempore consequatur quod dolor quia repellendus. Accusantium dolorem quisquam itaque a dolore quia. Laboriosam deserunt qui temporibus dicta. Qui quidem esse ullam est quis voluptatum blanditiis sequi.', 'Pariatur dignissimos dolore dicta illum voluptatem fugit perspiciatis. Ipsum non qui saepe vero temporibus. Voluptas enim animi quas optio laudantium molestias.\n\nMaxime nam sit non ad voluptatum quasi veniam. In quae eveniet ab. Eos illum fugit neque accusamus minima. Id quae et quisquam quia nesciunt mollitia quis.', 'storage/images/slider2.jpeg', '2018-04-06 08:11:10', 0, 1, 1, '2018-04-24 08:22:37', '2018-04-24 08:22:37');

-- --------------------------------------------------------

--
-- Table structure for table `post_tag`
--

DROP TABLE IF EXISTS `post_tag`;
CREATE TABLE IF NOT EXISTS `post_tag` (
  `post_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  KEY `post_tag_post_id_index` (`post_id`),
  KEY `post_tag_tag_id_index` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(10) UNSIGNED NOT NULL,
  `brand_id` int(10) UNSIGNED NOT NULL,
  `collection_id` int(10) UNSIGNED DEFAULT NULL,
  `set_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `body` text COLLATE utf8_unicode_ci,
  `body2` text COLLATE utf8_unicode_ci,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `price_outlet` int(11) DEFAULT NULL,
  `views` int(11) NOT NULL DEFAULT '0',
  `amount` int(11) NOT NULL DEFAULT '0',
  `color` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `discount` tinyint(1) NOT NULL DEFAULT '0',
  `sold` int(11) NOT NULL DEFAULT '0',
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `publish_at` timestamp NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `products_user_id_index` (`user_id`),
  KEY `products_brand_id_index` (`brand_id`),
  KEY `products_collection_id_index` (`collection_id`)
) ENGINE=InnoDB AUTO_INCREMENT=201 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `user_id`, `brand_id`, `collection_id`, `set_id`, `title`, `slug`, `short`, `body`, `body2`, `code`, `image`, `price`, `price_outlet`, `views`, `amount`, `color`, `discount`, `sold`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, 0, 'Exercitationem doloribus amet id ratione enim optio.', 'exercitationem-doloribus-amet-id-ratione-enim-optio', 'Id explicabo et velit autem. Incidunt quas doloribus facere. Qui et nihil distinctio ullam excepturi.', 'Magni totam veritatis corrupti rerum eos dolor. Quibusdam explicabo rerum magnam dolor harum. Ipsa enim aut vel dolor. Consequatur officia quos unde et doloremque.\n\nSequi cum quo quia ut neque omnis. Ut cum minus eos iste dolorem aut nostrum. Porro consequatur in repellendus enim totam laboriosam vero.\n\nOmnis voluptate consectetur minima rerum ut officiis facere. Provident sunt eligendi quibusdam in unde. Placeat id distinctio incidunt ipsum dolore amet soluta. Non quo praesentium maiores nisi id beatae. Natus voluptatem in non libero provident alias eos est.', 'Autem autem facere repellat doloribus pariatur. Labore velit corrupti minus accusantium qui. Molestiae incidunt et quaerat veniam animi aut et.\n\nSimilique est et et molestias officia error. Aliquam doloremque harum tenetur illo quia voluptatem quos. Eos quia id sed dolorem quidem quaerat. Vitae enim est accusantium fugiat nulla.\n\nQuis sit corporis aut qui deserunt consequatur cum. Est corrupti dolore quia aperiam similique voluptate. Et est sequi sunt. Maxime consequatur qui cupiditate sapiente nostrum et aliquid.', 'consequatur', 'images/fashion/4.jpg', 124, 112, 0, 3, NULL, 0, 0, 1, '2018-04-07 14:20:53', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(2, 1, 1, NULL, 0, 'Sit aperiam odio totam voluptas amet.', 'sit-aperiam-odio-totam-voluptas-amet', 'Et ut commodi neque rerum voluptatum enim. Corporis debitis error repudiandae sint repellat delectus est. Placeat quis aut mollitia vel.', 'Quibusdam quia voluptatem officiis occaecati. Modi et non eius quasi velit.\n\nIpsa ut nulla ex deserunt voluptatibus odio. Ut inventore non id ipsa. Minima et itaque vitae nam distinctio.\n\nDebitis enim dolores dolore qui cumque. Eos perferendis ipsa neque voluptas in eos aut. Atque quidem consectetur similique reiciendis consequatur.', 'Dolor quo minus placeat perspiciatis ut iure et. Unde eos odit eaque voluptatem ut error. Odit repellat a accusamus ut qui et.\n\nIllo saepe molestias animi omnis. Consectetur adipisci inventore voluptas dignissimos enim explicabo maiores occaecati. Aperiam sint culpa nulla qui. Voluptatem est id sequi voluptas aut qui quia.\n\nNihil consequatur sed sed minus beatae veritatis. Id modi illum accusamus et magnam est fugit. Blanditiis temporibus aut facere amet temporibus qui.', 'ipsum', 'images/fashion/4.jpg', 220, 122, 0, 1, NULL, 0, 0, 1, '2018-04-16 16:38:51', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(3, 1, 1, NULL, 0, 'Quia cupiditate dolores in reiciendis enim veniam consequuntur ad.', 'quia-cupiditate-dolores-in-reiciendis-enim-veniam-consequuntur-ad', 'Facilis tempore ipsum laudantium ipsum. Ipsa perferendis eum maxime assumenda et eos tenetur alias. Rerum veniam fuga cumque a. Iste quae officiis ullam quia possimus.', 'Ipsam aut omnis voluptatibus sequi sed ipsum. Sunt voluptates ut autem. Maxime blanditiis reiciendis est maxime a.\n\nDicta dolorum iusto placeat alias eaque est molestiae molestiae. Reiciendis placeat minima beatae sed ea at corporis. Doloremque cupiditate quo totam doloremque id molestiae est. Alias laudantium omnis fugit enim aut necessitatibus.\n\nEt et quo voluptatem qui est. Eaque porro ex ut aliquid quia error voluptas. Praesentium excepturi ut quibusdam aut. Eos cum eius sit perspiciatis rerum facere.', 'Itaque veritatis sit eaque voluptatem aliquam quo possimus. Consectetur consectetur itaque iusto culpa tempora recusandae deserunt maiores. Ea explicabo nostrum ratione odio. Quasi sit quis magnam tempore eius minima harum.\n\nProvident illum ut sit cum voluptatem aut est. Voluptatum quidem dolor dolor et cumque natus voluptatem. Quidem velit praesentium est deserunt.\n\nDucimus quaerat eius qui est ut voluptas occaecati adipisci. Ea suscipit non nesciunt fugiat dignissimos libero libero. Ut ab commodi autem aut.', 'at', 'images/fashion/4.jpg', 222, 119, 0, 2, NULL, 0, 0, 1, '2018-04-03 22:48:43', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(4, 1, 1, NULL, 0, 'A maiores cupiditate sit incidunt.', 'a-maiores-cupiditate-sit-incidunt', 'In sunt assumenda earum mollitia sint aliquid voluptatem voluptas. Possimus aut placeat aut id. Corrupti repudiandae alias corrupti enim.', 'Error et sint debitis accusamus dolorem. Ex magni aperiam non quaerat rerum dicta. Quasi porro sit debitis ut distinctio quos qui. Et vel eligendi dolores voluptas minima.\n\nIste fugit aut sed et. Fuga aut hic molestiae odio cum tempora dolor. Et tenetur ducimus libero sapiente minima nobis. Voluptatem molestias alias adipisci dolores.\n\nQuae nemo ea minima animi eos facilis voluptas. Impedit ut deserunt cupiditate eligendi maxime asperiores neque. Est quod consequatur accusamus qui quam omnis cupiditate. Quaerat ex consequatur voluptate ut magni odio.', 'Sunt tempore atque qui dolores. Quod quibusdam omnis aut ut. Aut explicabo quaerat molestiae aliquam qui. Quo aspernatur consequatur necessitatibus voluptas.\n\nError velit blanditiis eaque aut laboriosam. Ad ut harum quaerat quo labore. Saepe adipisci sint tempora dolorem exercitationem architecto inventore consequatur.\n\nOdio doloremque quidem expedita eos omnis mollitia omnis. Laboriosam aut beatae aut dolores fuga nihil. Illo suscipit ipsa perferendis omnis et molestias dolor illum. Qui facilis doloribus unde rerum.', 'alias', 'images/fashion/4.jpg', 155, 146, 0, 2, NULL, 0, 0, 1, '2018-04-15 02:14:29', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(5, 1, 1, NULL, 0, 'Rerum atque atque aut id aut aut.', 'rerum-atque-atque-aut-id-aut-aut', 'Asperiores sit quod autem sunt similique in atque ut. Facilis et veniam praesentium quas laborum perspiciatis pariatur. Ut voluptatem illum adipisci magnam. Officiis explicabo dicta voluptatem et ipsa eveniet.', 'Similique sed ad repudiandae exercitationem. Necessitatibus est maxime modi aperiam non. Illum suscipit excepturi nisi explicabo temporibus expedita. Autem dolorem dolor eum unde placeat ducimus est.\n\nLibero itaque rerum eum non quis. Sit repellendus voluptas ea. Est ut molestias est sit dolor illum. Quam consequatur cumque perferendis minus ut.\n\nVoluptatem dolorum et non et est. Impedit impedit sed quam. Aut impedit sed aut corporis nulla ea voluptatem.', 'Veniam voluptate praesentium consectetur beatae harum mollitia accusantium. Officia quia molestiae fugiat corporis id exercitationem maiores. Non adipisci sint odit.\n\nReprehenderit sed porro vero commodi omnis porro corrupti. Rerum odio neque iure in praesentium cum. Consectetur aut et sit recusandae provident ipsam qui. Fugiat voluptas veniam eum minus dolorum sit.\n\nIncidunt dolores magnam omnis eum. Mollitia vel inventore sint voluptates. Voluptas sint earum accusamus molestiae alias porro. Tenetur ut id ea consequatur dolorem. Quo dolores id velit.', 'est', 'images/fashion/4.jpg', 270, 150, 0, 2, NULL, 0, 0, 1, '2018-03-31 23:45:59', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(6, 1, 1, NULL, 0, 'Debitis est illum ut nulla tenetur hic.', 'debitis-est-illum-ut-nulla-tenetur-hic', 'Maiores aut sapiente voluptatem. Qui eveniet quisquam cupiditate sit sed molestias asperiores perspiciatis. Iste sit quae magni voluptas. Rem porro et explicabo nihil rerum.', 'Non ut rerum ea et suscipit. Nihil reprehenderit ducimus reiciendis dignissimos perferendis neque.\n\nQuisquam natus ipsum et maxime. Quis nisi maxime error iure illo a et. Nisi voluptatum et numquam. Quidem eum aut voluptatem dignissimos.\n\nAlias iusto nemo alias alias rerum. Expedita et quia enim velit deleniti aut nulla. Sunt provident dolore et neque nulla voluptatem totam. Ut totam autem et et mollitia.', 'Dolorem placeat aperiam esse nobis tenetur odit. Recusandae excepturi nihil laboriosam. Harum eum ab qui ut ea. Nostrum numquam quis deserunt pariatur libero eos.\n\nSimilique placeat quisquam alias repellendus odit veritatis. Rem officiis et possimus consequuntur sint omnis similique voluptatem.\n\nCorrupti qui eum nobis rerum et ut voluptatum. Veniam sit amet labore laudantium et qui molestiae praesentium. Vel et sint voluptates non est exercitationem. Soluta exercitationem hic accusantium nesciunt sed quae voluptatem.', 'deleniti', 'images/fashion/4.jpg', 102, 92, 0, 1, NULL, 0, 0, 1, '2018-03-30 01:39:36', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(7, 1, 1, NULL, 0, 'Exercitationem qui ipsa dolor recusandae voluptas.', 'exercitationem-qui-ipsa-dolor-recusandae-voluptas', 'Ut blanditiis et quibusdam. Tempora rerum nostrum quo dolor voluptatem. Illum nostrum iste molestiae blanditiis ut. Voluptatum ipsum nostrum sunt rerum consequatur.', 'Animi sunt quo corporis aliquid. Nemo et et recusandae quasi consequatur soluta molestiae. Voluptatibus omnis qui placeat maxime. Velit rerum voluptas laudantium quam et et.\n\nPorro voluptatum error et placeat ipsum vero odit. Omnis repellendus dolor animi atque officia laudantium vitae. Molestias quas voluptas fuga cupiditate harum rerum voluptas sed.\n\nAccusamus quia doloribus et nemo sequi. Non sed cum commodi voluptatibus iusto aut. Enim quia impedit enim aut non. Voluptatem autem et incidunt et voluptas. Suscipit at consectetur consequatur.', 'Necessitatibus modi eligendi voluptatem. Blanditiis qui doloremque aliquam. Qui enim non aut veniam ut. Quibusdam quia tempora ab velit aut voluptas quae.\n\nVelit laboriosam reiciendis ducimus dignissimos mollitia. Maiores porro minus quasi.\n\nRerum omnis suscipit consequatur debitis enim voluptatem dicta dolores. Et quam deserunt neque rem. Minima nobis ut et consequatur.', 'voluptas', 'images/fashion/4.jpg', 174, 95, 0, 1, NULL, 0, 0, 1, '2018-04-12 11:52:08', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(8, 1, 1, NULL, 0, 'Dolorem aut blanditiis quia nihil.', 'dolorem-aut-blanditiis-quia-nihil', 'Explicabo animi aut eius quo repellendus. Perspiciatis nam deleniti occaecati recusandae natus reprehenderit. Sunt nihil exercitationem ea iure molestiae repellat eligendi expedita.', 'Ut ut dolorem praesentium non libero est dolores qui. Sit beatae autem minima qui qui.\n\nEt nulla vitae non qui. Id placeat nihil est. At dignissimos ipsam quis autem qui aut aut non.\n\nNesciunt nostrum nostrum quod ut voluptas enim. Voluptatem ad sed officiis at velit. Molestiae iusto consequatur ut delectus quia vel nulla. Rerum eos molestiae quia quidem tempore.', 'Eum eius porro quia et est ipsam repudiandae. Aut non facilis neque id. Exercitationem reiciendis labore dolores recusandae eius rerum. Culpa nam maiores et minima.\n\nOdit iure sit et. Dolorem inventore aut non accusamus. Qui fuga et rem quaerat eveniet aut consequuntur perspiciatis.\n\nConsectetur ex labore voluptatem facere vel laboriosam consequatur. Facere sequi ipsam sunt vero ut debitis ratione necessitatibus. Dolor autem minima molestias dolor minima iusto quis.', 'enim', 'images/fashion/4.jpg', 142, 91, 0, 1, NULL, 0, 0, 1, '2018-04-20 10:36:54', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(9, 1, 1, NULL, 0, 'Optio sed non cumque quod et.', 'optio-sed-non-cumque-quod-et', 'Modi ut velit quia perspiciatis. Fugiat nobis quia sequi. Et quis eos corporis esse sunt eius veniam.', 'Quia placeat neque ducimus quisquam. Non quisquam pariatur culpa est accusamus iusto sapiente. Iste voluptatem est quasi dignissimos eaque excepturi voluptas. Culpa iure at aperiam aut natus.\n\nEos recusandae iste nesciunt. Iusto eos voluptatem deserunt corrupti est et molestiae. Cum rerum et iure magnam. Neque dolore ut repudiandae magni doloribus aliquam. Illo unde nihil iste reiciendis.\n\nQuia accusantium aliquam itaque at. Quaerat quidem occaecati voluptas ut illum reiciendis rem. Aut amet eos in natus.', 'Sit animi maiores sit sapiente aut impedit velit eos. Voluptas dicta voluptatem laboriosam aut odio perferendis unde. Incidunt totam doloremque et quo.\n\nSed amet dolor aspernatur ut. Molestiae esse velit non reprehenderit sit nostrum aperiam aspernatur. Alias sed sed temporibus sequi in dolorum ut.\n\nRepellat fuga ut eos. Tenetur eligendi accusantium eaque velit dolorum. Itaque commodi optio sit et.', 'laudantium', 'images/fashion/4.jpg', 126, 130, 0, 2, NULL, 0, 0, 1, '2018-04-03 12:26:25', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(10, 1, 1, NULL, 0, 'Similique ullam consequuntur voluptatibus aliquid quasi ad.', 'similique-ullam-consequuntur-voluptatibus-aliquid-quasi-ad', 'Laboriosam neque dolorum voluptas at quia suscipit dolorem et. Eos impedit quae suscipit sunt officiis. Nostrum sunt voluptatem dignissimos consequuntur quia aut. Ut nobis voluptatibus enim voluptatem sequi et.', 'Non eum consequuntur nobis beatae facere sed. Dicta delectus velit sunt. Inventore et asperiores itaque.\n\nIllum et cupiditate provident cumque. Molestias itaque ducimus velit voluptatibus. Molestias placeat voluptate labore eum sed. Illo optio animi aperiam et est earum.\n\nReprehenderit labore neque veritatis ut maiores. Aliquam asperiores aperiam necessitatibus quia enim recusandae. Repellat facere accusantium expedita.', 'Voluptatem asperiores qui vel maxime quas omnis quia minus. Voluptatibus dolore est temporibus corrupti vitae id sint. Quia ad eaque sunt et ipsa voluptatibus quasi nihil. Qui eos recusandae sit laborum voluptas nemo beatae sit.\n\nHarum in illum tempore. Quo corporis sapiente possimus cupiditate saepe. Odit voluptatem tenetur facere. Ducimus repudiandae rerum animi asperiores.\n\nVel amet sit sed nemo aut. Et quo dolorum quae consectetur ducimus velit. Numquam ut eos nisi soluta qui nihil eius.', 'quod', 'images/fashion/4.jpg', 151, 126, 0, 2, NULL, 0, 0, 1, '2018-03-26 14:42:46', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(11, 1, 1, NULL, 0, 'Inventore ut repellat quia impedit.', 'inventore-ut-repellat-quia-impedit', 'Et veritatis vitae atque ea. Dolor vero porro voluptate quis sed tempore at. Aspernatur assumenda quam itaque aliquam consectetur corrupti. Asperiores cum et consequatur esse quidem repudiandae quam.', 'Aut minima neque consectetur sit aspernatur. Aut et molestiae qui odio nemo accusamus est. Incidunt in qui enim.\n\nDolorem illum illo possimus inventore quasi quasi. Harum temporibus nam doloremque nihil modi. Delectus labore animi aliquam soluta. Quibusdam laudantium quam eligendi ducimus officiis excepturi officiis a.\n\nUt accusantium et ducimus quo et. Unde omnis nemo voluptate. Quo et quia omnis praesentium quo assumenda est.', 'Consequatur molestias ipsam repellat. Enim tempora ad sunt vel laudantium quaerat totam nulla. Dolorem dolorem aut adipisci iste.\n\nUllam sit dolorum non et dolorem. Non et illo et sint. Molestiae voluptas aliquam quaerat et omnis a.\n\nNatus cumque qui rem. Tempora consequatur dolorem impedit ducimus.', 'veniam', 'images/fashion/4.jpg', 159, 137, 0, 3, NULL, 0, 0, 1, '2018-04-14 14:10:22', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(12, 1, 1, NULL, 0, 'Iste omnis voluptatem vel aspernatur.', 'iste-omnis-voluptatem-vel-aspernatur', 'Illum quis vel in explicabo itaque. Molestiae molestias veniam ea sunt. Aut veniam occaecati aut sint incidunt consequatur nisi.', 'Accusamus odit ut harum quia possimus. Harum aut animi optio et. Dolorum soluta autem illum aliquam aspernatur aut vitae.\n\nVoluptatem nobis perferendis est nihil et id minima. Vero est dolor voluptatem. In voluptas enim rerum quo.\n\nConsequatur quae commodi fugiat quis rerum sunt quo. Non est neque itaque quia veniam provident et. Totam veniam non et iure temporibus doloremque.', 'Et soluta praesentium enim est sed ipsa aliquid. Doloremque quaerat deleniti quaerat molestiae magni est qui. Et qui voluptas vel cupiditate.\n\nRerum eveniet qui nihil numquam ut quo numquam. Cumque explicabo harum qui voluptatem repellendus velit. Facere quidem quaerat ratione odio totam culpa exercitationem.\n\nRecusandae in soluta ut modi odit facilis iusto. Nulla soluta sit praesentium voluptas animi. Nisi iure suscipit itaque.', 'debitis', 'images/fashion/4.jpg', 102, 143, 0, 2, NULL, 0, 0, 1, '2018-04-03 20:57:30', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(13, 1, 1, NULL, 0, 'Deleniti sunt unde officiis aliquid et doloribus.', 'deleniti-sunt-unde-officiis-aliquid-et-doloribus', 'Voluptatem voluptas voluptas voluptatem reprehenderit. Necessitatibus ab ratione dolores nihil aut est aut. Ut repudiandae et et vero consequatur.', 'Autem sed voluptatem voluptas repellat aut quia aspernatur. Itaque quos amet laborum non excepturi. Voluptates facere et debitis illum adipisci. Accusamus explicabo neque voluptatem quos. Nam molestias aut quod aut.\n\nEt quod dolores est corrupti nisi quia. Nisi dolores quis velit impedit eum ex. Sapiente cupiditate excepturi dicta dolorem aut omnis amet debitis.\n\nQuisquam rerum et quia quo impedit. At unde quidem eos consequatur. Voluptas tempora ut repellat voluptas recusandae. Perspiciatis fugit voluptatibus facilis occaecati a.', 'Harum dolor qui sint numquam. Dolores qui sint libero vero laboriosam. Earum debitis qui sunt quasi accusantium.\n\nEt nemo omnis quaerat quae saepe. Dolores hic cupiditate vero omnis maxime. Excepturi earum repellendus nihil et quia aut architecto sequi. Repudiandae distinctio repellendus sit necessitatibus provident alias commodi.\n\nQuis sint minima molestias neque quidem voluptas. Ea saepe ea quasi ut. Reiciendis occaecati et laudantium dolorem sunt.', 'voluptatem', 'images/fashion/4.jpg', 158, 107, 0, 2, NULL, 0, 0, 1, '2018-04-09 16:07:48', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(14, 1, 1, NULL, 0, 'Minus quibusdam molestias asperiores placeat perspiciatis dolorem.', 'minus-quibusdam-molestias-asperiores-placeat-perspiciatis-dolorem', 'Sint nihil sunt ipsum magni assumenda neque. Commodi cupiditate at est iste ab fugit aspernatur. Eum soluta voluptatem saepe qui deleniti impedit nisi. Et nostrum sunt quia esse et autem id ut.', 'Non quidem est debitis dolorem eum qui nobis. Laboriosam voluptate veritatis eum consequatur incidunt. Officia dolorem quidem rem quibusdam dignissimos velit reiciendis. Ipsa repellendus et fuga ut.\n\nQuis est non soluta necessitatibus molestias est. Perferendis dolorem molestiae id ipsa voluptatem dolor officiis. Non itaque commodi cumque nobis quos sit exercitationem.\n\nAspernatur qui quia officia impedit sapiente facere placeat. Iste repellendus nostrum soluta modi perspiciatis.', 'Dolorum consequatur sed quod ex quisquam deleniti. Quia eum voluptates vero omnis hic ipsam. Fuga modi nostrum cupiditate rem. Sit accusantium nisi atque illo et. Voluptatem corrupti iure accusamus magni est totam.\n\nDolor eligendi quia nobis quo tempore quia. Quasi voluptatem et quas voluptas. Quam ut ab saepe nihil commodi totam facere.\n\nOfficiis eum itaque odio minima totam exercitationem dolorem. Et dignissimos omnis praesentium et soluta et error. Quis exercitationem perferendis dolorem vitae. Possimus quis id omnis voluptatem.', 'minus', 'images/fashion/4.jpg', 161, 143, 0, 3, NULL, 0, 0, 1, '2018-04-03 12:29:15', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(15, 1, 1, NULL, 0, 'Laborum ut qui amet est accusantium et vitae.', 'laborum-ut-qui-amet-est-accusantium-et-vitae', 'Alias est qui quia est eum. Vel quae animi cumque nesciunt et architecto ipsam aspernatur. Vel et perspiciatis aliquam sequi voluptas sint blanditiis. Rerum sit qui sed repellendus vero. Recusandae dicta dicta provident porro.', 'Nisi in harum sint sit. Rem officia et corporis aut dolor. Aut cumque voluptatem laudantium dicta debitis velit ducimus. Officiis a enim exercitationem ut nulla porro omnis.\n\nVero eaque ut ea. Veniam doloribus officia nihil recusandae. Ut ut ipsa distinctio temporibus.\n\nAccusantium excepturi iste omnis. Ipsam maxime qui nam perspiciatis facilis. Autem non fugiat ipsum architecto voluptatibus eum. Cupiditate eum dolores harum et est vel quo.', 'Facere culpa fugit tenetur optio est hic. Ea voluptas enim veritatis labore eius ut voluptas alias. Nostrum iure in tenetur nobis. Cumque beatae culpa ut temporibus exercitationem quaerat repudiandae.\n\nFugiat itaque recusandae et quo. Quidem aut perferendis et est voluptatem. Atque perferendis aut magnam blanditiis.\n\nEst nisi ad officiis fuga a. Impedit omnis quia illum porro sit aliquam. Illo temporibus ex quae quas.', 'ab', 'images/fashion/4.jpg', 129, 97, 0, 2, NULL, 0, 0, 1, '2018-04-25 02:43:22', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(16, 1, 1, NULL, 0, 'Quia recusandae recusandae et ut vitae.', 'quia-recusandae-recusandae-et-ut-vitae', 'Fugit velit exercitationem aut rerum eveniet non. Autem voluptatibus dolor sed repellat. Sed ducimus est aut. Et fugiat aut non voluptate.', 'Nulla perspiciatis quibusdam saepe consequatur placeat saepe voluptates. Quia saepe consectetur architecto ex at dicta quos. Nemo tenetur explicabo et quam officiis. Est amet ex assumenda consequatur quo sint deserunt. Ut reprehenderit nisi harum earum repellendus.\n\nDolorem animi sed dignissimos dicta. Deleniti et repellendus illum quod. Quaerat ut ut sed dolores et vel autem. Commodi aut quia debitis praesentium dolores. Ullam soluta qui iste vero vitae consequuntur accusantium.\n\nCumque necessitatibus perspiciatis libero earum tenetur ab. Est ducimus natus tempora neque est sint. Dolores commodi magni in eius autem. Itaque officiis voluptas iusto ut velit.', 'Unde accusantium incidunt beatae et fugit et. Consequatur aperiam non libero ad. Necessitatibus itaque et explicabo molestias. Corporis minima praesentium voluptates minus.\n\nVoluptatum perspiciatis laudantium non repellat magnam quasi saepe. Enim tempore accusamus cumque eos et. Quasi in architecto consequatur dolores eaque. Placeat est totam molestiae unde atque dolore.\n\nMagnam provident dicta labore rerum exercitationem qui. Dolorem ex maiores consequatur exercitationem aut.', 'nemo', 'images/fashion/4.jpg', 206, 87, 0, 2, NULL, 0, 0, 1, '2018-03-31 16:39:54', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(17, 1, 1, NULL, 0, 'Ipsum rerum est porro minima est.', 'ipsum-rerum-est-porro-minima-est', 'Aut qui veritatis repellat error. Maxime ex adipisci voluptas. Reiciendis omnis commodi tenetur id sint dignissimos.', 'Temporibus possimus nesciunt iste nam dolor tempora. Dolorem nisi sit molestiae laudantium et. Et sapiente et sit ratione saepe. In dolorem ab iure quasi.\n\nCommodi ea qui fugit deserunt nostrum et excepturi. Ut qui molestias magnam. Libero omnis voluptas ut quia consequatur harum qui. Consectetur ipsam eligendi optio fugiat eos delectus.\n\nVel magnam similique eligendi et voluptas nobis nulla. Est omnis quod rem sequi aut. Quibusdam vero sed et deleniti suscipit explicabo blanditiis odit. Minus et dolorem aut consequatur quis.', 'Cumque veniam sapiente modi ut. Nam delectus sit id. Molestias consectetur exercitationem accusamus quis. Molestiae eligendi consequatur quia odio. Ut voluptatem nulla sit aperiam.\n\nNostrum sit modi necessitatibus modi. Fuga sit in maxime est perferendis facere. Minus molestiae enim nisi molestias veritatis sequi. Blanditiis expedita quo nemo voluptatem. Enim dicta et dolore et.\n\nEa porro dolore autem consequuntur omnis ullam rerum. Laudantium id aut ea ea quia nostrum quos ipsum. Tempore velit dolore debitis est. Temporibus quia aut labore et ipsum aspernatur dicta molestiae.', 'explicabo', 'images/fashion/4.jpg', 254, 98, 0, 2, NULL, 0, 0, 1, '2018-04-01 15:03:03', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(18, 1, 1, NULL, 0, 'Et vero quis reiciendis perspiciatis eaque quisquam quaerat.', 'et-vero-quis-reiciendis-perspiciatis-eaque-quisquam-quaerat', 'Ab veniam mollitia voluptatem consequatur exercitationem vel pariatur totam. Perspiciatis aliquam quia animi nostrum error nostrum dicta. Itaque ex unde est numquam.', 'Minus qui enim animi aut odit corrupti. Placeat qui nihil voluptatem quia. Et qui repudiandae natus harum voluptates quos. Ut tenetur harum perspiciatis dolor sunt porro.\n\nEum quae atque et. Tempore rerum provident qui quas cum sequi veniam cum. Est amet ab at dignissimos vero. Pariatur provident consequatur et excepturi veniam in.\n\nCum deserunt cumque officia non. Aut autem est et blanditiis autem sit pariatur laudantium. Consequatur nihil occaecati doloribus voluptatem quis aut.', 'Laborum quis ea nulla. Quis voluptas blanditiis quas iure nostrum optio consequuntur. Voluptatem qui nam labore quia possimus. Reprehenderit vero ut non iste qui quae dolorum.\n\nVoluptate neque quam sint eos est modi dignissimos. Nulla nesciunt repellat ut. Natus aut est eius repudiandae. Fugiat odio iure modi non necessitatibus vitae.\n\nNostrum rem fugiat vero. Consequuntur rerum totam eius natus. Provident pariatur necessitatibus alias modi tempora quasi aut.', 'numquam', 'images/fashion/4.jpg', 137, 115, 0, 3, NULL, 0, 0, 1, '2018-04-14 21:52:51', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(19, 1, 1, NULL, 0, 'Incidunt accusantium culpa quas exercitationem harum qui sunt.', 'incidunt-accusantium-culpa-quas-exercitationem-harum-qui-sunt', 'Ipsum magni commodi et dolores ducimus autem explicabo. Possimus odit repudiandae et repellendus laborum fugit qui. Commodi vel consequatur quibusdam voluptatum nisi possimus ea quis.', 'Sit eaque et id voluptates omnis nesciunt voluptatem. Alias amet asperiores qui labore et.\n\nEa quas consequatur dolor illum vel harum qui sed. Rem quia nesciunt sint nam illo. Perspiciatis maxime esse quia quo.\n\nQuae repudiandae sequi cum qui eveniet voluptatem. Tempora quaerat unde tenetur officia. Sit tempora id quo debitis possimus vel voluptatibus. Nam magni aut ab laudantium. Qui saepe incidunt qui autem molestiae qui officia.', 'Et dolorem voluptatum itaque in nostrum molestias nisi. Dolorum dignissimos odio eum nulla nihil quia officia ea. Consequatur asperiores magni qui ut odio accusantium ipsam. Quibusdam facere necessitatibus similique facere voluptatem qui ut sit.\n\nSed magnam quam placeat totam consequatur rerum quo. Molestias et autem error. Ut sed ut maiores ex ut nisi.\n\nAtque mollitia enim illo unde ut corrupti rem. Libero dolorem error rem fuga rerum commodi similique. Soluta voluptates assumenda cupiditate quia sunt incidunt.', 'qui', 'images/fashion/4.jpg', 106, 130, 0, 1, NULL, 0, 0, 1, '2018-04-16 13:38:08', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(20, 1, 1, NULL, 0, 'Provident sapiente ut minima aspernatur aliquam provident.', 'provident-sapiente-ut-minima-aspernatur-aliquam-provident', 'Alias ea laborum vitae ut ut reiciendis. Nam et quia nesciunt sit. Aut repellendus dolorum ad quas autem ut. Sequi qui eum cum eaque nostrum autem consequuntur.', 'Ut sapiente qui voluptas nihil libero dolor animi. Tempore nihil aut sunt id ut deserunt ea. Dolor et nemo quas odio quia. Et corporis consequatur omnis ea ut et at.\n\nAt sint voluptas soluta eius. Facere est repellendus eligendi enim ea modi placeat. Dolor incidunt velit libero repudiandae cum quae. Dignissimos optio perferendis sit est ad distinctio quia.\n\nCommodi ipsum qui sequi totam officiis est. Rerum quo aut et qui enim ipsam doloremque. Hic et recusandae officia cum sed iure.', 'Ut dolor doloribus in quo explicabo. Asperiores voluptatem distinctio earum suscipit est. Velit deserunt recusandae perspiciatis necessitatibus. Voluptatem debitis amet enim vitae.\n\nAnimi dignissimos molestiae ad quos repudiandae. Vitae ullam autem sint ab modi illo. Nobis in deleniti expedita aut.\n\nDeserunt alias sit commodi ut amet ut. Sunt est in vel doloribus eius eligendi. Delectus quo explicabo vel quaerat. Voluptatibus et sed modi itaque qui non qui.', 'vel', 'images/fashion/4.jpg', 123, 123, 0, 2, NULL, 0, 0, 1, '2018-04-21 13:40:13', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(21, 1, 1, NULL, 0, 'Dolores aliquid vero quam.', 'dolores-aliquid-vero-quam', 'Itaque sit quo quo deleniti. Fugiat molestiae sequi qui facere odio rerum ea. Voluptate consectetur illum tempore voluptatem et. Illo perspiciatis assumenda est neque eius.', 'Dolores nemo nihil itaque maxime minus. Veniam ut autem pariatur pariatur aliquam explicabo. Et minima qui aspernatur ipsa consequatur qui. Doloribus impedit architecto voluptatibus perferendis occaecati.\n\nAtque deserunt nulla perferendis earum omnis voluptas. Voluptatum voluptas aspernatur nostrum corporis sed.\n\nSunt quaerat beatae laudantium ut. Id impedit dolorem magni voluptatem magni corporis. Ea beatae est eveniet.', 'Voluptas reiciendis aut exercitationem. Earum consequuntur quia necessitatibus suscipit hic qui. Debitis sed voluptate assumenda consequatur non dolores. Tempore deserunt sint labore odio est neque.\n\nRepellendus nihil nobis consequatur ducimus pariatur repellat. Exercitationem autem et repellat sequi quis. Qui dolor neque omnis eaque minima. Numquam voluptatibus facilis enim rerum.\n\nNumquam qui sint soluta aspernatur architecto aut dolorum. Minima natus est quis quasi quaerat autem rerum. Aspernatur dolorum sunt et alias.', 'omnis', 'images/fashion/4.jpg', 298, 103, 0, 1, NULL, 0, 0, 1, '2018-03-29 19:00:21', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(22, 1, 1, NULL, 0, 'Facere fugit aperiam ut ducimus.', 'facere-fugit-aperiam-ut-ducimus', 'Quia aut cupiditate molestiae. Non possimus molestias tempora reprehenderit quis placeat sapiente. Aspernatur optio ea sit qui est.', 'Repellat magnam ut ut itaque doloremque. Blanditiis doloribus ut eveniet tempore. Autem velit quae voluptatem reiciendis voluptate illo molestiae. Natus hic voluptas tempore recusandae labore.\n\nNam sed voluptatibus provident inventore rerum. Id laudantium ex et dignissimos eum enim quo. Ex est in tempore qui beatae voluptas.\n\nExpedita occaecati molestiae inventore quidem sit. Hic distinctio iusto in et consequatur quo magni. Omnis esse quos dignissimos enim eligendi voluptatem cupiditate. Et blanditiis placeat veniam laborum. Assumenda qui similique quaerat doloribus mollitia.', 'Quibusdam officia suscipit sint qui velit et. Incidunt est et quidem rerum. Sed ratione non eum eos quidem sit vel. Dolores assumenda atque et repellendus itaque amet omnis.\n\nVoluptas similique perspiciatis laborum esse quibusdam praesentium ipsa. Rerum illum voluptatem est consequatur voluptatem quia animi. Error cumque est magnam repudiandae. Illo praesentium voluptatum eos saepe porro cupiditate. Atque accusamus omnis incidunt quis et pariatur.\n\nFugit aut et exercitationem quia libero laboriosam inventore. Rerum dolorem non a et eum. Omnis sint veniam earum. Voluptates fuga vero animi esse voluptas magnam.', 'velit', 'images/fashion/4.jpg', 268, 86, 0, 2, NULL, 0, 0, 1, '2018-03-27 20:40:31', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(23, 1, 1, NULL, 0, 'Et quod nulla est cum optio.', 'et-quod-nulla-est-cum-optio', 'Aut dolore quam impedit quibusdam soluta. Vel impedit odio architecto dolorem aspernatur fugiat autem. Vero non aut quia itaque. Praesentium numquam quia nemo eos dolor expedita commodi.', 'Qui repellat est consequatur porro non minima rem et. Et earum facilis dicta expedita optio suscipit. Sed ullam at blanditiis delectus qui et accusantium sed. Magnam et ducimus enim sint voluptatum quis consequatur.\n\nFacere voluptates rerum praesentium. Esse odio ex vel quae laboriosam ut aut. Culpa ab expedita perferendis cumque vel. Odit molestiae et voluptatem quia.\n\nTenetur velit ad commodi cumque porro ut veniam in. Non dolores sapiente unde tempore ratione ut dicta reiciendis. Numquam ipsam debitis quae id odit ad provident sit.', 'Et vero omnis aut dolorum. Delectus odio eos quasi dolor quis eos. Nihil iusto deleniti eum quae soluta.\n\nMagnam qui possimus et nulla aut. Omnis ut officiis impedit.\n\nMagnam dolores a molestias totam. Sed omnis nobis qui ut voluptas ea aut inventore. Optio voluptatibus sint qui pariatur. Cupiditate repudiandae saepe libero et laborum eos deserunt molestiae.', 'veniam', 'images/fashion/4.jpg', 188, 146, 0, 2, NULL, 0, 0, 1, '2018-04-01 18:54:05', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(24, 1, 1, NULL, 0, 'Dolore dolorem rerum qui culpa deleniti sit facere incidunt.', 'dolore-dolorem-rerum-qui-culpa-deleniti-sit-facere-incidunt', 'Minus perferendis suscipit libero modi. Placeat numquam culpa nostrum fuga ipsam ut esse. Cumque atque et doloribus. Praesentium culpa autem temporibus consectetur. Qui aut ut delectus consequatur.', 'Cumque quia voluptas dicta distinctio quidem. Nostrum provident dicta ex tenetur quas consequatur. In corrupti est nihil pariatur voluptatem. Vero omnis est earum magnam qui rerum.\n\nVel quibusdam ab qui aliquam quia ut. Minima culpa occaecati esse veritatis veniam non nostrum. Fuga non et quaerat voluptate aperiam. Officiis nisi perferendis similique autem itaque accusantium.\n\nEx et aspernatur quam a labore enim omnis tenetur. Assumenda ut voluptatum aspernatur delectus nobis eligendi occaecati. Id aut illo ipsa harum.', 'Architecto nisi dolorem excepturi consequatur. Consequuntur delectus est quis blanditiis et corrupti tempore. Corrupti beatae minima aspernatur occaecati provident. Magnam non veritatis fugit.\n\nIure fugit facere illo nemo est eos. Labore debitis voluptas omnis. Fugit corrupti ducimus id delectus consequatur et architecto. Aspernatur reprehenderit excepturi atque ratione culpa recusandae.\n\nVoluptates perspiciatis minus et accusamus. Eaque ratione tenetur vitae quia sit blanditiis consequatur. Est et culpa perspiciatis est quasi voluptatem qui. Facilis aut aspernatur ea est ducimus omnis ad rerum.', 'et', 'images/fashion/4.jpg', 191, 83, 0, 1, NULL, 0, 0, 1, '2018-04-18 14:33:00', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(25, 1, 1, NULL, 0, 'Cumque voluptatem sit voluptas ut quaerat pariatur accusamus.', 'cumque-voluptatem-sit-voluptas-ut-quaerat-pariatur-accusamus', 'Rem aliquid error et omnis illo illum unde. Incidunt odit necessitatibus odit aut iure pariatur. Sed dolorem harum dolore velit nisi fuga.', 'Placeat amet molestias cum recusandae et esse. Ut praesentium commodi labore et. Vel cumque porro ex cumque nobis. Voluptatem fugit autem facilis qui. Ipsa quia similique nam nihil.\n\nDebitis veniam et nihil qui autem. Dolorum cumque aut dolores at.\n\nError magnam quasi quia modi enim. Aut dolorem assumenda vero. Quo occaecati eos ipsum provident dolor ullam. Nesciunt autem deserunt hic praesentium at eius sint dignissimos.', 'Occaecati omnis iste corrupti aut. Ipsa repellat neque voluptate nisi exercitationem. Dolores rerum omnis deserunt veritatis libero sapiente voluptates.\n\nEum minus fuga porro facilis vero voluptatem. Aut error unde alias est repellat voluptatem. Culpa praesentium molestias repudiandae consectetur delectus.\n\nSit sed placeat esse. Laboriosam debitis inventore quisquam eos aliquid. Iusto occaecati consequatur nemo quis quo accusantium minus ut. Et quas aut quo quas.', 'facilis', 'images/fashion/4.jpg', 154, 150, 0, 3, NULL, 0, 0, 1, '2018-04-25 01:46:30', '2018-04-25 13:45:57', '2018-04-25 13:45:57'),
(26, 1, 1, NULL, 0, 'Libero aliquam alias itaque nostrum ut.', 'libero-aliquam-alias-itaque-nostrum-ut', 'Dolor labore quo perspiciatis expedita quia. Quia dicta sit omnis dicta. Voluptatem voluptates necessitatibus pariatur est animi est perferendis.', 'Omnis minima exercitationem tempore amet. Aliquam iusto mollitia accusantium sequi nesciunt. Aliquam omnis sequi repellendus delectus non. Dolores est similique voluptates non maiores.\n\nNemo qui quos dolorem pariatur. Qui magni et corrupti provident officia sint enim dignissimos. Qui autem ea rerum quo.\n\nFacilis sunt fugit et distinctio labore earum. At quia doloremque minus consequatur est. In consequatur corporis non a. Suscipit sit officiis et repellendus.', 'Mollitia et sit vel reiciendis. Numquam et eos non. Quae voluptas voluptas voluptatibus in expedita dolorem est. Ut tempora nesciunt occaecati omnis est ut dolor. Saepe et tempore placeat.\n\nIusto veritatis ipsa tempora consequuntur numquam quia asperiores. Eveniet officiis modi in fuga ut illum autem. Et ut vitae eum sed nam voluptatem consequatur. Eum sunt voluptas autem accusamus. Eveniet deleniti quae dolore nihil quis.\n\nConsequatur ipsum perferendis inventore porro qui. Recusandae quia fugit asperiores.', 'voluptates', 'images/fashion/4.jpg', 141, 123, 0, 3, NULL, 0, 0, 1, '2018-03-30 07:45:11', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(27, 1, 1, NULL, 0, 'Animi placeat in cumque corporis assumenda autem quis.', 'animi-placeat-in-cumque-corporis-assumenda-autem-quis', 'Ipsam doloremque autem aut non aut. Labore earum mollitia minima. In perferendis repellat quia maiores animi fugit dolorem repellat.', 'Et aut vero assumenda quas. Et voluptatem quia est est voluptas. Cupiditate harum quo eos ut tempore dolores. Voluptatem iste dolorem laudantium quasi ipsa.\n\nPerferendis ut quis quam vel odio. Est officiis explicabo ipsum deleniti. Dolore non non ut rerum. Voluptas quaerat iusto molestiae tenetur tempora reprehenderit.\n\nNon eum deserunt ut eum explicabo odit. Architecto nobis hic dolorem nihil maxime. Repellat ipsum ut commodi odit quia.', 'Voluptates rem harum veniam. Possimus aliquam qui laudantium quo. Sed eum et qui quae quae molestiae qui.\n\nCommodi magni et vel itaque aperiam sunt. Odit at suscipit accusamus aut voluptas laboriosam doloribus. Doloribus est laborum excepturi praesentium.\n\nAutem exercitationem quidem tempore aut ut nihil. Architecto est aut perspiciatis quis reprehenderit et quia. Temporibus quia sit reprehenderit quis officiis et. Et amet ad quaerat ut. Et ea et qui nesciunt eum.', 'odio', 'images/fashion/4.jpg', 250, 112, 0, 2, NULL, 0, 0, 1, '2018-04-02 16:37:33', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(28, 1, 1, NULL, 0, 'Quos ullam doloribus ut accusantium eligendi qui officia.', 'quos-ullam-doloribus-ut-accusantium-eligendi-qui-officia', 'Et nesciunt aut culpa non quia repellendus labore. Iste quisquam nisi odio. Beatae voluptas quia similique itaque nobis dolorem. Dolorem accusamus ad dolores quisquam ex in.', 'Qui voluptate asperiores labore pariatur ea. Error dolores et molestias voluptatibus cum. Laudantium ratione ducimus aspernatur unde.\n\nAnimi et possimus atque sequi saepe sint. Fuga voluptatum excepturi exercitationem commodi et quis numquam ea. Iusto nihil ipsum laboriosam fuga et sint fuga.\n\nVoluptas praesentium dolorem eos. Aut autem consequatur explicabo consequatur.', 'Nemo molestias velit eius voluptatibus eaque. Eos blanditiis vitae velit suscipit sunt et et. Libero veniam nesciunt quis voluptate quam voluptatem. Atque nobis ad eum quae voluptatem similique.\n\nNihil tempore debitis asperiores dolore. Ratione totam consequatur voluptate reiciendis possimus. Amet minus et modi recusandae quam recusandae ut.\n\nAperiam libero accusamus soluta quos. Provident non ratione esse delectus. Aut ea quod minus. Et itaque quibusdam odio nihil ea dignissimos.', 'deleniti', 'images/fashion/4.jpg', 219, 84, 0, 3, NULL, 0, 0, 1, '2018-04-08 20:46:30', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(29, 1, 1, NULL, 0, 'Magnam et hic dolorem.', 'magnam-et-hic-dolorem', 'Consequuntur laboriosam ad sint quisquam. Dolorem ut ut quae commodi temporibus. Nihil cupiditate at doloremque aliquid veniam est. Quis ea quod vel minima asperiores.', 'Dicta ea et laudantium corrupti. Unde et repellat quia est. Nam dicta aut cupiditate nihil. Velit iure dolorem iste explicabo id cum voluptatem. Et itaque labore explicabo id animi neque nostrum.\n\nAnimi sint iste id sed expedita. Voluptas non sit sunt ipsa eius magnam possimus error. Est expedita qui alias et libero quia.\n\nNesciunt molestias enim ab laudantium ullam nostrum. Non tempora aperiam cum ad dolor. Optio et mollitia est quasi incidunt.', 'Ea exercitationem accusantium eius modi repellendus quae culpa. Vel alias rerum aut laudantium.\n\nLaboriosam error ut aperiam dolores. Ab accusamus architecto a accusantium repudiandae eum. Consequatur dignissimos libero fugit provident ut et.\n\nAliquam distinctio sit minus unde quaerat error dolor soluta. Voluptas est at autem fuga aut. Culpa officia ut adipisci voluptatem distinctio.', 'sapiente', 'images/fashion/4.jpg', 172, 87, 0, 3, NULL, 0, 0, 1, '2018-04-24 10:38:16', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(30, 1, 1, NULL, 0, 'Aut et facere voluptatum.', 'aut-et-facere-voluptatum', 'Dignissimos est non iure ut iste exercitationem provident sed. Reprehenderit quia architecto alias reprehenderit error ut illo. Nam id tempore qui saepe aut odit. Aliquam earum accusantium et.', 'Fugiat ullam quo mollitia aliquid minus cupiditate. At provident iusto et. Consectetur est quos sint qui sapiente sed. Et rem quidem nihil quam ipsam.\n\nSit quisquam porro dolor assumenda. Est dolores voluptatem molestias aut voluptas illum. Eum repudiandae distinctio explicabo non minima dolorum. Ut sit enim vitae sint sunt enim consequatur voluptatem.\n\nEt et nobis temporibus quo aut eum numquam. Dolorum dolores dolores eum et. Eveniet qui odit omnis ad illum consectetur. Recusandae deleniti aut autem earum voluptates modi qui. Temporibus et deleniti rerum eveniet possimus quis ipsum.', 'Ut quasi repellendus numquam id et ut. Non repellat enim dolores alias ut soluta eveniet. Sed in eius sit aut id ipsa facilis. Atque commodi sed sed quam quisquam.\n\nDicta molestiae occaecati tempore et nesciunt explicabo. Sunt esse optio esse eum.\n\nQuod nesciunt dicta sed blanditiis dolor quia ipsa. Molestiae odio officiis sit esse ducimus saepe velit saepe. Earum aperiam ducimus sit non et eum quibusdam.', 'necessitatibus', 'images/fashion/4.jpg', 283, 94, 0, 1, NULL, 0, 0, 1, '2018-04-08 09:27:27', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(31, 1, 1, NULL, 0, 'Et dolorum aliquid sunt aspernatur et voluptatibus voluptatem.', 'et-dolorum-aliquid-sunt-aspernatur-et-voluptatibus-voluptatem', 'Eos accusamus voluptas repudiandae dolores consectetur. Aut id cumque tempore non quidem sunt cupiditate.', 'Iusto consequuntur magni ut alias. Libero adipisci explicabo voluptate dolorum aperiam. Deserunt aut aliquid occaecati rerum officiis veniam.\n\nUt nihil autem et quibusdam molestiae sit tempore et. Ea dolore eligendi qui ratione tempore.\n\nMolestiae velit deleniti veritatis et reprehenderit. Et nesciunt est veniam atque. Saepe doloremque et maiores possimus placeat beatae. Eum exercitationem et dolorem cumque dolorem sed accusamus quaerat. Natus autem accusantium quae nisi omnis.', 'Enim asperiores aspernatur voluptatem culpa. Repellat libero similique cumque ut architecto est. Dolorem sed modi exercitationem qui vel veritatis.\n\nAd neque tenetur quod labore modi cupiditate qui. Ut ipsam ipsam sint est quis quis quia. Consequuntur reprehenderit laborum cum veniam ipsum reprehenderit. Quam voluptatem ut dolorem alias beatae totam ipsum. Tempore qui quia nihil.\n\nDignissimos cupiditate qui nam. Accusamus cumque qui sequi id voluptates est. Incidunt et reprehenderit voluptatem. Optio ut quasi id eveniet et. A autem non eius sequi.', 'nam', 'images/fashion/4.jpg', 225, 122, 0, 3, NULL, 0, 0, 1, '2018-04-02 22:55:53', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(32, 1, 1, NULL, 0, 'Commodi ipsum corporis aliquam numquam iusto facilis error quo.', 'commodi-ipsum-corporis-aliquam-numquam-iusto-facilis-error-quo', 'Labore laborum nulla minima voluptatem cumque. Minima nobis magnam voluptatem culpa sed explicabo aut. Corporis iusto quis veniam eos repudiandae iusto. Ab rerum assumenda ut nostrum.', 'Odio veritatis ea dolorum. Nesciunt et doloremque aliquam. Ratione fugit sint rem qui rerum magnam officiis. Placeat et rerum provident ducimus nihil corrupti minus.\n\nOmnis blanditiis sed eaque reiciendis qui numquam. Autem molestiae distinctio aut et assumenda libero. Officia et facere nobis fugiat.\n\nSed tempore cum est voluptatum quas minima saepe expedita. Quis ducimus delectus est in occaecati reprehenderit eaque. Fugit commodi in molestiae quae.', 'Reprehenderit libero officia quasi natus dolores. A qui mollitia suscipit doloribus eius. Ad ratione et a esse. Ex mollitia dignissimos rerum quae ad esse suscipit illum.\n\nConsequatur dolores optio amet magnam vel blanditiis qui. Odit dignissimos ea praesentium veritatis nihil odit. Voluptas ex cumque enim suscipit. Ea aut reiciendis repellat eum.\n\nMinus voluptates accusamus ut ut odit et. Iusto voluptatem nemo sequi aspernatur eos quidem autem. Veritatis at eligendi deleniti qui molestiae voluptatibus eius.', 'laborum', 'images/fashion/4.jpg', 126, 85, 0, 3, NULL, 0, 0, 1, '2018-04-23 12:23:00', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(33, 1, 1, NULL, 0, 'Animi tempora velit id sit.', 'animi-tempora-velit-id-sit', 'Ut dolorum nisi consequatur. Enim non est sint sit nisi. Placeat assumenda quam a velit labore vel placeat. Sit earum non sequi sit atque possimus.', 'Eaque veniam possimus omnis repellat esse quod. Nesciunt debitis cum dolorem accusantium incidunt veritatis. Ut ut natus numquam quam dolor. Amet quia optio officia repellendus similique iure est officia.\n\nDucimus velit iste libero libero alias ab nihil non. Corrupti ut omnis facere alias culpa. Nihil numquam dolor tempora nihil.\n\nIste eligendi nesciunt sed. Necessitatibus ad rem aut. Consequuntur quis aliquam in distinctio. Neque incidunt iste minima fugit nulla quis.', 'Est quo debitis omnis ipsa modi sunt et. Ut rerum odit quis reiciendis. Dolorem odio nostrum molestiae.\n\nFugiat pariatur porro architecto optio inventore. Vel id autem ut adipisci. Vero dolor non magni quo odio voluptatem quia labore. Sequi eaque ut velit in qui nisi velit rerum.\n\nDoloribus exercitationem molestiae consectetur dolorum. Ea ratione non rerum illo et in. Et et natus repudiandae tenetur fuga exercitationem atque. Ea qui reiciendis nihil hic et.', 'hic', 'images/fashion/4.jpg', 228, 80, 0, 1, NULL, 0, 0, 1, '2018-04-18 16:20:43', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(34, 1, 1, NULL, 0, 'Enim natus ut qui eligendi qui officia.', 'enim-natus-ut-qui-eligendi-qui-officia', 'Corrupti laboriosam autem architecto perspiciatis eveniet sunt. Cumque aut vitae commodi. Facilis iste quod quia mollitia occaecati est.', 'Voluptate ut nemo in similique amet temporibus fugiat. Dolorum dolor qui sunt dolores pariatur excepturi. Ut quo atque similique qui commodi. Distinctio qui a nihil quo.\n\nQuisquam occaecati similique autem voluptates voluptates omnis. Est autem consequatur voluptas amet dignissimos quam. Deserunt accusamus ad alias aut.\n\nBlanditiis delectus assumenda ea voluptatem. Officia est et nesciunt est molestias quas eligendi quidem. Rerum voluptates et aut dolorem et.', 'Rerum quia et beatae laboriosam tempore. Beatae nihil molestiae tenetur voluptatem aut. Nisi eos nam vero aliquam est doloribus.\n\nIpsum dignissimos nobis doloribus quia. Aut ab consequuntur qui nulla voluptas itaque aut. Totam magnam distinctio tempora et accusamus ut ratione.\n\nConsequatur ut excepturi quasi ut voluptatem ut voluptate. Dolorem odit nesciunt eligendi tempora est eligendi porro. Nisi dolore et cumque magnam illum ut nisi. Quia eum eos quia cumque.', 'eligendi', 'images/fashion/4.jpg', 175, 88, 0, 1, NULL, 0, 0, 1, '2018-04-09 19:52:42', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(35, 1, 1, NULL, 0, 'Quia accusantium unde deserunt et velit quo.', 'quia-accusantium-unde-deserunt-et-velit-quo', 'Aspernatur ipsum rerum cum aut omnis. Eos voluptatum qui et.', 'Laudantium voluptas tenetur quibusdam incidunt dolores ut at. Iste officiis adipisci aperiam ullam facilis ut consequuntur ut. Rem quisquam velit illo vero voluptatem voluptas. Earum sunt sapiente dolor ea commodi qui corporis. Voluptas aut et rem sint ut.\n\nAmet nobis ut earum quasi commodi. Sunt laborum corporis est quisquam. Rerum error ut molestiae aliquid. Eaque error vel quidem distinctio accusantium nostrum.\n\nOfficia qui dolorem non ullam repudiandae. Voluptatem et reprehenderit eos dolor vel est et. Facere id tempora ut eos.', 'Aut laboriosam voluptatibus est est ratione dolores aut. Tempora mollitia molestiae corporis vel fuga sit. Qui ut quae ea aut velit corporis ratione. Consectetur quasi eum vero qui recusandae.\n\nAdipisci in sed incidunt eos dolore asperiores ipsa perspiciatis. Laborum corporis eum dolorem. Repudiandae iste facere iure quo impedit velit. Qui quos nihil provident magni facere qui.\n\nAb neque praesentium non asperiores. Qui rerum sint harum distinctio maiores est. Fugiat facilis voluptas non id voluptates nobis. Et consequuntur hic quod quidem.', 'et', 'images/fashion/4.jpg', 164, 104, 0, 2, NULL, 0, 0, 1, '2018-04-08 01:33:41', '2018-04-25 13:45:58', '2018-04-25 13:45:58');
INSERT INTO `products` (`id`, `user_id`, `brand_id`, `collection_id`, `set_id`, `title`, `slug`, `short`, `body`, `body2`, `code`, `image`, `price`, `price_outlet`, `views`, `amount`, `color`, `discount`, `sold`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(36, 1, 1, NULL, 0, 'Sapiente voluptatem deserunt et tempore ipsum maiores quam omnis.', 'sapiente-voluptatem-deserunt-et-tempore-ipsum-maiores-quam-omnis', 'Atque temporibus fuga error et ut blanditiis. Quia cum quidem et. Consequatur ea soluta sint facere voluptas quia.', 'Sed iste ullam numquam quod. Eos eius quisquam quo. Voluptatum sit tempore et aut praesentium rem nobis reprehenderit. Distinctio quas voluptatum adipisci libero quaerat.\n\nDolor qui alias voluptatem optio dolorem consequatur omnis. Sapiente perferendis animi recusandae modi voluptas architecto. Sit iste enim alias. Est placeat earum libero voluptas distinctio non.\n\nQuasi odit id autem odio dolorem fuga. Alias eveniet alias animi sit sunt doloremque. Autem laudantium impedit temporibus ut dicta id.', 'Qui possimus molestiae et et. Voluptatem rerum ut molestiae suscipit. Natus sequi velit minus molestias et et eum. Sed sint ut consequatur est.\n\nCommodi ipsa consequatur placeat temporibus. Ea veniam ut autem dolores sint natus. Fugit est placeat alias pariatur et consequatur.\n\nCum asperiores ratione aut sit sunt iste. Non aut quia quis nihil deleniti. Sunt non maiores hic autem.', 'reprehenderit', 'images/fashion/4.jpg', 202, 80, 0, 3, NULL, 0, 0, 1, '2018-04-07 04:36:56', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(37, 1, 1, NULL, 0, 'Assumenda id non molestiae.', 'assumenda-id-non-molestiae', 'Ullam dolores eveniet placeat placeat nemo corrupti rem. Et doloribus ipsam saepe aut totam nam eum omnis. Quisquam enim libero et natus sit nulla. Est facere mollitia ut voluptatum illo est.', 'Sint natus sunt et dolores sunt modi. Est architecto aut ratione. Occaecati maxime ducimus dolores voluptatibus.\n\nEst voluptatibus tenetur pariatur iste voluptas. Est modi amet necessitatibus non neque iure alias officia. Rerum minus facere ducimus necessitatibus sed molestias et maiores.\n\nIpsum nesciunt voluptatum et cupiditate est. Ut aliquid aut ex est. Voluptate natus impedit aspernatur molestiae aut est vel odit.', 'Dolorem eum doloribus et eos et error. Consequatur qui nesciunt repudiandae eius sed ipsam. Assumenda dolor voluptatem aliquid repudiandae rem quasi eos.\n\nDolor nemo dolor tenetur quas. Autem accusantium temporibus quia suscipit repellat possimus. Doloribus sed tempora doloremque non totam corrupti. Est sit molestiae ab excepturi cumque eaque.\n\nDolor quia quis et ut ut. Voluptates velit repellat dignissimos. Aut est facilis voluptatem consectetur nostrum autem. Illum eveniet aut aspernatur ut.', 'voluptatibus', 'images/fashion/4.jpg', 129, 89, 0, 1, NULL, 0, 0, 1, '2018-04-17 00:47:54', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(38, 1, 1, NULL, 0, 'Porro placeat explicabo aut maiores.', 'porro-placeat-explicabo-aut-maiores', 'Minima inventore qui ducimus aliquam amet. Minima autem doloremque sed temporibus asperiores placeat consectetur. Doloremque voluptas et exercitationem nostrum. Quibusdam placeat nobis harum ea.', 'Nobis minus est et corporis aliquid aut eos. Excepturi voluptatem fugiat nisi eveniet officia.\n\nCorrupti architecto omnis rerum nostrum voluptas nihil nobis. Animi nobis rem sequi. Consequuntur atque autem nam alias facere.\n\nEos beatae consectetur atque qui. Qui quo voluptatem molestias non atque consequuntur est.', 'Id eligendi magni et et atque ut magni. Fugit explicabo ad voluptatem veritatis. Nihil pariatur et deleniti vitae nihil nihil. Qui cupiditate non perferendis ut.\n\nEst totam tempora occaecati aut sunt et. Aut molestiae explicabo quia tempora necessitatibus beatae quibusdam. At accusamus est cum occaecati repellat. Consectetur doloremque omnis voluptatem et.\n\nOptio qui expedita accusamus consequuntur quaerat consectetur. Porro culpa non recusandae. Optio et sed nam nisi. Quae itaque dolorem quisquam.', 'ad', 'images/fashion/4.jpg', 239, 131, 0, 2, NULL, 0, 0, 1, '2018-04-24 00:33:28', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(39, 1, 1, NULL, 0, 'Facilis atque perspiciatis magni maxime et.', 'facilis-atque-perspiciatis-magni-maxime-et', 'Et quam eius vitae quis est sed expedita. Nobis possimus unde reiciendis. Debitis temporibus sapiente aut.', 'Voluptate voluptatem reiciendis sint odio. Dignissimos possimus vitae quae recusandae deserunt aut. Ut sint consequatur repudiandae qui est tenetur at unde.\n\nReprehenderit quos consequatur omnis sit et repudiandae. Quo qui qui non odit ut voluptas. Placeat consequatur excepturi neque officiis necessitatibus saepe incidunt. Molestiae et non quibusdam non cum provident quidem.\n\nPariatur est quasi eos aut est doloribus. Quia fugit dignissimos ipsam sit qui. Nulla labore inventore exercitationem dolor occaecati dolore aliquid.', 'Unde veniam amet dolores aut ducimus. Voluptatem voluptas possimus ipsum facere libero. Suscipit qui earum harum qui cumque. Dolor blanditiis cum modi eveniet rem exercitationem.\n\nIste qui quasi beatae animi rerum et itaque. Veniam eligendi repellendus sit perferendis et ut. Dolores aperiam porro voluptas quo ullam voluptatibus harum.\n\nUt earum odit et voluptatem qui quod atque rerum. Placeat nemo accusantium nesciunt deserunt sapiente libero. Voluptates qui numquam ut voluptatum. Nesciunt possimus qui minus qui.', 'sed', 'images/fashion/4.jpg', 126, 120, 0, 1, NULL, 0, 0, 1, '2018-04-11 17:09:35', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(40, 1, 1, NULL, 0, 'Repellat non nostrum vitae hic non labore.', 'repellat-non-nostrum-vitae-hic-non-labore', 'Et impedit veniam et accusamus totam in inventore enim. Quo accusantium minus illum recusandae voluptatibus. Ex et adipisci in vel harum est.', 'Laudantium dolorem dolor sunt molestiae rerum officiis facere. Error mollitia hic qui et libero. Rem officiis enim harum ut. Pariatur quis placeat quia quia fugiat.\n\nEst aspernatur sed laborum possimus iste repellendus qui. Rerum repudiandae labore dolorum minus dolorem assumenda. Quibusdam voluptatum qui sunt numquam.\n\nPlaceat soluta et deleniti qui non velit veniam qui. Iste est error optio et. Rem aut enim molestiae.', 'Accusamus voluptates velit debitis eum sed iusto. Nemo laudantium dolor voluptas id aliquid praesentium. Rerum inventore et eum quo.\n\nAut cumque repellat quasi numquam aspernatur quod qui. Est voluptatem ex aspernatur dolor esse expedita. Ab aliquam non eum dolores sed provident. Sapiente quia perferendis itaque esse aut.\n\nEst dolorem illo porro consectetur quibusdam eius. Et aperiam aut dolore itaque nihil dolorem omnis. Rerum itaque maiores id ab quia a.', 'molestiae', 'images/fashion/4.jpg', 263, 125, 0, 2, NULL, 0, 0, 1, '2018-04-20 00:58:58', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(41, 1, 1, NULL, 0, 'Rerum ad ullam cumque placeat.', 'rerum-ad-ullam-cumque-placeat', 'Quis reprehenderit deleniti ut perferendis repudiandae amet voluptatem. Sequi odit non voluptatum tempore debitis sit. Non et natus deleniti quia. Accusantium consequuntur inventore sit sapiente inventore.', 'Minus officiis sunt doloribus ab. Id et quasi qui dolor. Velit delectus consequatur esse autem voluptas dolor. Quis in enim et.\n\nRatione perferendis maxime soluta saepe sequi. Et reprehenderit id in dolor totam.\n\nAt facilis reiciendis voluptate voluptatem facilis. Sunt quo odit et pariatur debitis est nemo tempora. Autem ut nemo veniam repellendus eligendi laborum laudantium.', 'Dicta aut nostrum impedit ut deleniti minus corrupti. Quis optio nemo sed ipsa sit id et. Tempore sunt et voluptates est et voluptatem.\n\nDicta minus velit sit aspernatur minus. Fugit est dignissimos aut. Omnis eaque ut sit iste unde deleniti eos aut.\n\nQuidem ipsa nulla qui quaerat nihil et voluptas sit. Maiores modi omnis necessitatibus. Quia dolore enim earum quia dolorem omnis. At velit in est reprehenderit unde aspernatur corrupti.', 'aspernatur', 'images/fashion/4.jpg', 245, 122, 0, 2, NULL, 0, 0, 1, '2018-04-15 18:18:36', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(42, 1, 1, NULL, 0, 'Modi qui ad voluptas ducimus quas autem et.', 'modi-qui-ad-voluptas-ducimus-quas-autem-et', 'Vitae laboriosam esse omnis ea amet repudiandae sit. Et facere eaque alias autem illo ex. Quaerat iure numquam error atque.', 'Consectetur facere voluptatem autem voluptates consequuntur qui ad dolorem. Ducimus fuga odio sit vel fugit est omnis. Quia dolorum voluptatem modi fugit.\n\nNesciunt earum omnis est unde. Necessitatibus eaque incidunt aliquid. Maiores molestiae accusantium enim magnam. Voluptatum voluptas et eum quo eveniet facere hic.\n\nUt ipsa omnis aliquam eligendi beatae consequatur soluta eos. Voluptatem voluptas sed sint non et exercitationem veritatis. Laboriosam ex vero laborum est.', 'Accusamus quae explicabo et voluptas fuga occaecati ratione. Velit ipsa voluptatem molestias qui. Placeat accusantium id cumque doloremque. Autem consequuntur facilis ut veniam illum perspiciatis dolore.\n\nConsequatur excepturi consequatur cupiditate voluptates suscipit facere odio. Minus officiis qui quia voluptatem consequuntur. Quo atque natus quis vero voluptates. Reprehenderit et provident quibusdam suscipit.\n\nNecessitatibus excepturi quia sit nostrum atque eligendi ratione. Quasi quis modi eveniet incidunt blanditiis quo. Aut nihil voluptate eos.', 'sed', 'images/fashion/4.jpg', 274, 112, 0, 2, NULL, 0, 0, 1, '2018-03-26 19:43:26', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(43, 1, 1, NULL, 0, 'Corporis voluptatibus placeat aliquid voluptatum iure quae.', 'corporis-voluptatibus-placeat-aliquid-voluptatum-iure-quae', 'Vero sit omnis est rerum. Debitis rem et ea itaque. Veniam ullam sit debitis reiciendis dignissimos sit explicabo.', 'Pariatur dolore aut aut dolore quia voluptatem nam. Fuga eum omnis debitis excepturi voluptatum. Totam ut culpa quo error ut. Sint et qui excepturi quibusdam commodi modi. Consequatur vel dolore eligendi quaerat quam praesentium omnis.\n\nVoluptatibus sit voluptates ex vitae ducimus. Distinctio magnam et provident placeat quod. Aperiam at molestiae ut accusantium asperiores quam sit.\n\nEligendi odit accusamus ratione occaecati eum esse. Cupiditate dolores ipsum amet ut ut corporis. Ratione molestiae sapiente eum animi qui debitis dolor.', 'Autem sit sed libero aut et vero qui. Tempora qui commodi hic ipsa reiciendis culpa. Voluptatibus aperiam aut mollitia.\n\nAnimi nihil architecto consectetur. Quia magni aut quae voluptatem. Aut sapiente tempora porro.\n\nSuscipit molestiae nisi sit consequatur. Est ut tempore quibusdam et perferendis mollitia dolores. Est sint autem rerum consequatur saepe qui. Suscipit harum velit veniam et.', 'eum', 'images/fashion/4.jpg', 280, 127, 0, 1, NULL, 0, 0, 1, '2018-04-23 09:05:10', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(44, 1, 1, NULL, 0, 'Porro est molestiae id a voluptatem cumque suscipit.', 'porro-est-molestiae-id-a-voluptatem-cumque-suscipit', 'Fugiat explicabo est repellat aliquid ratione provident. Nemo facilis velit voluptas eos dolores. Dolor est sunt voluptatibus mollitia dolorem.', 'Voluptas dignissimos ipsam vel. Laboriosam quos dolor beatae. Architecto laboriosam quos qui optio. Quos placeat aspernatur illum.\n\nVoluptas delectus eveniet dolorem tempore veniam nulla. Pariatur nihil nemo quasi corrupti accusantium. Eum ullam similique omnis ducimus.\n\nEos et magni corrupti. Sit voluptate maxime in fuga. Ducimus velit quis earum reiciendis amet ea dolor ullam. Nisi aut dicta repellendus iusto ducimus dolorem qui. Aut et distinctio sit ut repudiandae.', 'Neque provident optio dolores saepe quia a voluptas. Corporis dolorem dolor eos commodi at molestiae. Dolor in hic harum ab fuga nam. Harum numquam ullam tenetur sed totam suscipit maiores est.\n\nExcepturi et soluta consequatur aut. Sunt facilis totam velit eveniet eos. Amet velit dolores minus ut rerum aperiam id. Nisi numquam qui possimus blanditiis.\n\nMinima provident qui dicta qui. Rerum doloremque error aperiam qui ipsum deserunt amet praesentium. Deleniti voluptate eveniet ut consequatur quod aperiam et.', 'beatae', 'images/fashion/4.jpg', 148, 84, 0, 3, NULL, 0, 0, 1, '2018-03-29 10:33:24', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(45, 1, 1, NULL, 0, 'Dicta veniam soluta aut beatae.', 'dicta-veniam-soluta-aut-beatae', 'Exercitationem officia temporibus enim vel voluptatem impedit inventore. Eaque quam architecto asperiores omnis adipisci temporibus. Error ducimus iusto sunt voluptatem.', 'Quo ea et commodi sit voluptatem omnis. Voluptatem voluptas in ut quia. Voluptas ut harum veniam quas porro. Ut neque adipisci voluptatem quos ab sunt nam at.\n\nVoluptatibus harum voluptate et consequuntur ut ex voluptas officiis. Laborum assumenda error dolorum sed vitae minima eius. Magnam itaque omnis veritatis illum perferendis.\n\nRerum fugit velit sed quia quae in laborum. Sunt suscipit illum quis adipisci. Itaque consequuntur autem sequi.', 'Aspernatur magni molestiae quae illum tenetur doloremque. Temporibus qui illum modi totam reprehenderit modi labore et. Molestias omnis explicabo eum neque eum. Minus maxime voluptatum voluptas quo nam.\n\nTemporibus sapiente sint quaerat quo sed. Rerum ipsum quisquam qui at temporibus voluptates non. Similique cum doloribus aut neque. Voluptas architecto eaque quidem dolores fugit distinctio nesciunt.\n\nLaudantium error sed facilis excepturi consequatur. Deserunt sed reiciendis et laudantium doloremque corporis. Est et exercitationem mollitia iste.', 'omnis', 'images/fashion/4.jpg', 212, 115, 0, 2, NULL, 0, 0, 1, '2018-04-19 20:16:20', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(46, 1, 1, NULL, 0, 'Recusandae corporis veniam possimus.', 'recusandae-corporis-veniam-possimus', 'Sint rerum recusandae quia nesciunt. Tempore est cupiditate explicabo eum quis doloremque. Temporibus et autem autem a.', 'Eligendi sed beatae nisi vel sunt. Sint repellendus qui voluptatem excepturi sint molestias ducimus.\n\nEt eligendi eveniet magnam autem numquam quis consequatur. Est dolores maiores aperiam. Quo quam sunt fugit iure illo et possimus quia.\n\nSint et illo corrupti sint. Magni quos natus dolorem unde. Aliquam tempora odio qui et debitis ut dolores et.', 'Sunt quae adipisci incidunt est. Ea minima impedit molestiae. Aut impedit dolorem dolor et numquam.\n\nVoluptas suscipit dolor deserunt vitae deserunt qui. Vero explicabo incidunt soluta esse ipsum et illum. Vel ad tempora non.\n\nTotam illum vel non voluptatem. Quibusdam at quasi commodi aliquid excepturi. Earum nostrum mollitia molestias enim nemo sunt consequatur. Est illum sunt omnis deserunt.', 'quae', 'images/fashion/4.jpg', 149, 98, 0, 2, NULL, 0, 0, 1, '2018-03-28 00:28:50', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(47, 1, 1, NULL, 0, 'Porro dignissimos ad consequatur fuga nobis.', 'porro-dignissimos-ad-consequatur-fuga-nobis', 'Vel quos qui est aut consequatur corrupti. Inventore aut et quia distinctio. Aut quo et et sint expedita minus.', 'Commodi reiciendis sapiente quo hic vero sequi. Omnis voluptates animi distinctio dolorum. Eos qui recusandae tempore suscipit similique sit. Nostrum quae qui dolores.\n\nDolorem dolorum quidem soluta ut id fugit est est. Doloribus maiores eius magni eaque deleniti omnis cumque. Enim cupiditate deleniti sint quae ea et.\n\nNon tempore consequatur magnam autem quo id. Dicta rem blanditiis et necessitatibus odio sint ratione. Voluptatibus tenetur nisi natus.', 'Rerum labore incidunt error consequuntur recusandae numquam. Officiis reprehenderit consectetur omnis modi. Maxime voluptatum est possimus maiores nemo enim animi. Placeat incidunt corrupti consequatur in autem non.\n\nEt totam ut quia dignissimos cum. Iure laudantium atque aut consequatur voluptatum dolore. Eum excepturi accusamus quis ad ut sit id corporis. Ratione eaque aut autem quo natus. Debitis qui sint est distinctio.\n\nNon labore delectus et illo distinctio ut. Eos dolores veritatis ab dolores. Est non sit dolor et omnis eaque rerum. Maxime porro aut dolore commodi.', 'sit', 'images/fashion/4.jpg', 283, 107, 0, 3, NULL, 0, 0, 1, '2018-04-16 19:16:33', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(48, 1, 1, NULL, 0, 'Corporis facere beatae vero et quo repudiandae rerum.', 'corporis-facere-beatae-vero-et-quo-repudiandae-rerum', 'Reiciendis laboriosam facilis eius ad. Non officia eaque animi sit non labore impedit. Dolore aliquam quaerat quis vitae. Ea quia magni ea ea mollitia et.', 'Illum molestias illum veniam ratione et. Iure veritatis dolorum quas est. Est ipsum consequatur eum eum excepturi. Autem voluptate repudiandae nam pariatur qui enim quasi. Nobis a occaecati qui excepturi tempora ipsam placeat.\n\nFuga mollitia deleniti voluptas quaerat. Consequatur labore quia in rerum nulla autem deserunt. Ullam consequatur fugit nemo cupiditate facilis. Vel odio tenetur rerum autem dolor pariatur.\n\nDolores delectus ad nemo sequi dignissimos vel inventore. Est inventore vitae et consequuntur quia quis tempora. In in laboriosam cum velit eaque sit. Corrupti numquam et debitis ipsum neque.', 'Tempore tempore nisi perspiciatis in. A corporis aliquam distinctio aut omnis a cupiditate. Impedit non voluptas cumque doloremque. Necessitatibus est eius et ipsum reiciendis ex.\n\nIllo quibusdam architecto dolore eum illum numquam non et. Quis excepturi dolores ut tempora temporibus. Est delectus magni vitae ex. Consequuntur aut hic quam sint. Voluptatem et iusto aspernatur qui maiores voluptates.\n\nTenetur voluptatibus impedit sunt minus. Nisi inventore temporibus in id cum aut dolor. Minus maiores est nulla et. Et sint quod temporibus aut quia est a.', 'omnis', 'images/fashion/4.jpg', 152, 146, 0, 3, NULL, 0, 0, 1, '2018-04-25 08:15:17', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(49, 1, 1, NULL, 0, 'Tempore quia est ut molestiae.', 'tempore-quia-est-ut-molestiae', 'Ratione consequuntur dolorum ipsam culpa facilis et. Delectus qui molestias sit fugit. Voluptatibus rem iusto corporis eum sint. Dolores qui est minima sequi nihil minima et.', 'Asperiores distinctio deserunt dolorem sed. Minima voluptatum atque et est ut voluptates iste. Dignissimos eveniet sequi eligendi esse aut autem. Rem asperiores occaecati voluptas dolorem autem ut cumque fuga.\n\nPlaceat sunt nulla tenetur repudiandae tempore aperiam molestias. Vero ut inventore voluptates officia et. Aut ipsam dignissimos quod totam eligendi non dolorum. Nemo in similique nihil. Id et repellat libero dolores fugiat.\n\nRepellat repellendus repudiandae repellat. Consectetur et nihil autem expedita nulla odio. Nemo qui nihil sint modi optio voluptas.', 'Voluptas voluptatem cum quo quas quam. Unde atque nisi minus. Voluptas saepe labore ut rerum et rerum accusamus. Atque qui quis quibusdam beatae est voluptatem est ex.\n\nVoluptatem voluptatem aspernatur voluptatibus aut. Ut et quibusdam velit quia. Minus placeat quisquam molestias rem. Aut et repellat assumenda porro qui a.\n\nIpsam repudiandae praesentium vero impedit fugit reiciendis. Qui suscipit laborum maxime necessitatibus ratione facere ad. Nihil vel voluptas incidunt.', 'occaecati', 'images/fashion/4.jpg', 257, 124, 0, 1, NULL, 0, 0, 1, '2018-04-17 04:02:07', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(50, 1, 1, NULL, 0, 'Suscipit odit eligendi labore voluptate iste minima magni.', 'suscipit-odit-eligendi-labore-voluptate-iste-minima-magni', 'Nam laboriosam quia voluptatum vel quas unde non. Aut labore similique ipsum hic suscipit et. Quasi quasi modi tenetur et est.', 'Exercitationem id hic eum unde ut assumenda. Mollitia quia sed sunt non eligendi et corrupti. Quia et consequatur qui.\n\nOptio fuga consequatur dolorem. Accusantium amet vero voluptatibus vero necessitatibus et necessitatibus. Molestiae et ratione dolorem ex omnis quae. Consequatur nesciunt dolorum et aut veniam possimus corrupti. Alias voluptatum et dolorem laborum non consequuntur.\n\nNon quaerat aut vel accusamus. Odit dignissimos sit molestiae illum.', 'Amet perspiciatis quisquam sed omnis cumque libero dolore. Quia voluptatem et qui culpa eos molestiae aut.\n\nQuam veniam recusandae tenetur. Quis necessitatibus laboriosam eligendi rerum enim tempora non sed. Quisquam et quibusdam amet temporibus. Quo possimus deserunt facilis dolores tempore soluta ut.\n\nDolorem quia voluptatem totam accusamus sed minima aut. Quidem quam omnis corrupti facere nam vero. Suscipit aut consequatur rem nihil.', 'molestias', 'images/fashion/4.jpg', 281, 130, 0, 3, NULL, 0, 0, 1, '2018-04-10 15:01:03', '2018-04-25 13:45:58', '2018-04-25 13:45:58'),
(51, 1, 2, NULL, 0, 'Explicabo est impedit rerum.', 'explicabo-est-impedit-rerum', 'Laudantium repudiandae accusamus qui ratione perferendis. Fuga corporis sint perferendis harum earum vero porro vel. Non rerum eius eos voluptas aspernatur. Et nihil amet officia dolorem dolorem magnam sit.', 'Dolores nam ex nisi quia et sint voluptatem. Quibusdam quaerat ipsam voluptates ea nisi aliquid voluptatem est. Dolorem repellat ducimus quis fuga beatae enim cum aspernatur.\n\nAut deleniti tenetur nisi qui. Doloribus qui quibusdam qui eaque ut ex. Optio doloremque corrupti atque repellat in. Et deserunt omnis ipsa aut est.\n\nLaudantium dolores voluptatem sint est facilis sequi. Vel rerum sit ducimus repudiandae et autem. Qui quaerat iure molestiae enim qui numquam.', 'Necessitatibus perferendis vero est doloremque laborum quae. Beatae repellendus nobis aut aut atque et molestias. Necessitatibus nihil suscipit dolor natus id. Repudiandae unde ea sed sed.\n\nEum dolorem veniam eius et eligendi. Autem consequuntur nihil odio. Nobis enim fugit reprehenderit reiciendis. Officia soluta eos in enim atque.\n\nArchitecto et provident praesentium inventore possimus distinctio. Fuga ipsum vitae dolor nam. Dicta possimus optio in tempora dolore. Maxime eveniet in nemo animi aspernatur iste.', 'iusto', 'images/watches/5.jpg', 239, 147, 0, 3, NULL, 0, 0, 1, '2018-04-19 18:46:54', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(52, 1, 2, NULL, 0, 'Sint beatae ullam sint quaerat.', 'sint-beatae-ullam-sint-quaerat', 'Aperiam sequi et qui qui incidunt ut magni. Libero quasi asperiores debitis ut voluptas. Consequatur iure sed possimus voluptatem.', 'Non maxime placeat ipsa ducimus harum officia. Necessitatibus totam animi debitis magnam ipsam qui rerum. Molestias quod autem sed quos cupiditate consequatur rem. Voluptatum inventore placeat modi. Rem quisquam aut quasi accusamus laudantium totam blanditiis.\n\nVero voluptatibus dolorem architecto enim aspernatur nemo. Dolorum aut eum porro magni fugit voluptas. Et dolorem magnam voluptas impedit totam aliquid et.\n\nCum libero tempora repellendus aut cumque velit. Quis voluptatum quod eveniet aliquam sunt quam. Sapiente laboriosam nemo exercitationem sit. Autem eius qui et saepe tenetur quis.', 'Ipsum dolore laborum voluptas eos ipsum. Temporibus temporibus dolor repudiandae sit. Eaque quam rerum sit sed.\n\nRecusandae qui natus inventore maxime molestias. Itaque saepe nulla aspernatur natus. Unde doloremque consequuntur quo est vel provident tempora. Quis ut consequuntur corporis eaque. Amet cumque omnis consectetur fugiat impedit.\n\nRerum reprehenderit nisi sed non quod eligendi aut. Est vero dolores odit veniam eos autem. Quae nobis reprehenderit aut earum perferendis.', 'omnis', 'images/watches/5.jpg', 202, 111, 0, 2, NULL, 0, 0, 1, '2018-03-31 14:28:35', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(53, 1, 2, NULL, 0, 'Tempora voluptas id nihil in.', 'tempora-voluptas-id-nihil-in', 'Sequi aut eligendi sed sit eos laborum tenetur. Et blanditiis est dolore quis amet. Quia libero veritatis molestias provident qui enim. Sequi numquam et et aspernatur impedit.', 'Laboriosam molestias ut dolorum ipsam. Beatae earum id molestias quis. Asperiores recusandae cupiditate aut error.\n\nEos praesentium nemo suscipit sint consequatur saepe officiis. Est maxime tempora quos fugiat eaque ipsa. Est dolores nulla earum quo est. Iure necessitatibus aut iste debitis.\n\nQuidem rem et maxime ducimus. Laudantium non deleniti delectus consequatur consectetur ea. Non itaque rerum assumenda temporibus enim. In et officiis est et eveniet.', 'Eum consectetur sit est odio. Adipisci amet tempora voluptas sunt quo consequuntur. Dolorum et qui dolor alias iure delectus. Expedita qui dolores tempora unde corporis.\n\nAt sed dolorum voluptatum natus temporibus rerum. Dolorem consequatur dolor qui est nihil et. Non aspernatur numquam qui mollitia modi qui impedit ipsa.\n\nOdio corporis quos doloremque. Rerum nobis sit quis. Vitae consequuntur asperiores ipsa et illum vitae. Omnis dignissimos quis voluptates odit sed iure explicabo.', 'adipisci', 'images/watches/5.jpg', 270, 137, 0, 2, NULL, 0, 0, 1, '2018-04-11 01:05:54', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(54, 1, 2, NULL, 0, 'Ipsum sit ut rerum nihil tempore.', 'ipsum-sit-ut-rerum-nihil-tempore', 'Qui temporibus veritatis est quo quia. Et quibusdam harum aliquid iusto sunt mollitia. Nulla aspernatur et vel sint tenetur praesentium. Aut molestiae vel et.', 'Et rem repellendus explicabo. Doloremque est praesentium aut id laudantium rerum animi. Delectus fuga unde maxime deleniti a est ducimus non. Non voluptas ut labore aut et sit corrupti odio.\n\nRerum assumenda est placeat repellat libero. Ullam et fugit quas itaque. Consequatur voluptatum rerum voluptatem nemo sint a consequatur.\n\nLaboriosam perspiciatis perferendis rem hic aut ea veniam. Laborum cum est cumque ipsam.', 'Earum rerum rerum reprehenderit non omnis. Veritatis quaerat aut esse. Numquam provident vel possimus enim impedit consectetur.\n\nAdipisci ex accusamus unde quo quo vitae. At est in rerum quasi unde est. Placeat quae ut doloremque odio. Animi est maiores excepturi occaecati.\n\nId sed eligendi ratione accusantium. Vel ad quibusdam officiis quod id ea. Aspernatur cum dicta qui est omnis. Necessitatibus magnam sint vitae esse illum. Provident possimus id ad dolores.', 'animi', 'images/watches/5.jpg', 113, 124, 0, 2, NULL, 0, 0, 1, '2018-04-25 06:45:53', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(55, 1, 2, NULL, 0, 'Magni necessitatibus rem eum quia.', 'magni-necessitatibus-rem-eum-quia', 'Dolorem nostrum qui quasi exercitationem. Enim quia qui qui rem. Voluptas laboriosam culpa dolor.', 'In minima et assumenda blanditiis ea. Dolorem est unde sint rem ut. Qui quae odit rerum illum tenetur. Qui consequatur qui commodi animi ipsam molestiae qui.\n\nDelectus officia non adipisci ea. Et beatae debitis aperiam. Autem eos suscipit sit praesentium ut et accusantium voluptas. Voluptatem explicabo repellendus et.\n\nUnde quam nesciunt sequi et reiciendis. Facilis possimus quaerat sapiente ab. Ut libero consectetur tempora aut.', 'Aliquid voluptates suscipit quae impedit cumque hic odit dolores. Omnis minus quia laudantium laborum labore in distinctio. Sit est tempora non itaque.\n\nEst corrupti quos consequatur exercitationem adipisci nemo aut sed. Autem et molestias consequuntur est. Expedita sit asperiores quia eos labore ex. A rem vel pariatur.\n\nQuas explicabo ad dolore. Iste maiores exercitationem harum vitae facere et.', 'dolore', 'images/watches/5.jpg', 133, 128, 0, 1, NULL, 0, 0, 1, '2018-04-20 19:59:42', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(56, 1, 2, NULL, 0, 'Accusamus sit quos sunt ad.', 'accusamus-sit-quos-sunt-ad', 'Perspiciatis ipsa aut corporis esse non voluptate nesciunt. Quasi veniam perferendis vel nemo voluptatem. Voluptatem perspiciatis consequatur corrupti. Rerum explicabo quisquam dolor quae.', 'Vero optio tempore et et enim ipsa dolorum provident. Iusto velit ut eligendi odit explicabo commodi. Itaque ea est consequatur tempore suscipit rerum sit. Fuga ipsam voluptas ut.\n\nMaiores illum ipsam voluptas. Nihil nobis omnis consequatur voluptatem neque.\n\nNam perspiciatis eligendi voluptatem aliquam dolores vero. Odit ipsam ut illum in non. Aut aspernatur dolor eveniet praesentium sint dolorem.', 'Itaque ea sint saepe et tenetur possimus reprehenderit. Corrupti est aliquid est. Aliquid voluptatem asperiores nesciunt in. Dolores et quo nihil officiis.\n\nAliquid numquam sed quasi sit dolorem occaecati pariatur. Quod nihil modi voluptatem.\n\nQuibusdam ratione aliquid sint blanditiis minus. Quis aut officiis ipsum. Neque est nisi est rerum odit officiis ut. Nesciunt tempore autem nesciunt.', 'dolor', 'images/watches/5.jpg', 183, 137, 0, 1, NULL, 0, 0, 1, '2018-04-06 06:23:28', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(57, 1, 2, NULL, 0, 'Totam quia mollitia consequuntur amet ut.', 'totam-quia-mollitia-consequuntur-amet-ut', 'Beatae ratione et consequatur dolorum possimus placeat facere. Exercitationem odio non numquam laboriosam praesentium assumenda molestias corporis. Repellendus facere aliquid iste consequatur explicabo voluptates. Vel accusantium est voluptas molestias. H', 'Inventore aut cumque possimus repudiandae. Ut quisquam nulla deserunt nam facere ut dolores nulla. Modi nemo reprehenderit quo rerum. Est dolor iure occaecati nostrum vitae omnis quod earum. Dolor ab provident enim qui.\n\nDolores nam error est atque. Est autem ducimus repellat quo illo. Molestiae dicta ratione dolorem facilis.\n\nAtque quaerat est sunt vel. Veritatis quia beatae accusamus non aliquam. Explicabo delectus quis accusantium vel dignissimos earum. Ut minus id recusandae expedita praesentium non deserunt. Quibusdam quo modi est tenetur sapiente laboriosam.', 'Ipsum molestiae voluptas saepe quia dicta praesentium optio. Itaque est beatae sed quisquam quis. Quod qui sed dolorum alias. Et et delectus corrupti molestiae maxime esse.\n\nPlaceat ut numquam odit quod. Perspiciatis praesentium ut ducimus neque impedit autem aut. Ratione blanditiis qui vitae eius.\n\nIusto perspiciatis dolor delectus beatae ullam nostrum qui. Ad temporibus harum maiores consequuntur totam minus itaque. Optio quos nisi modi perferendis voluptas. Modi officia velit incidunt sit et.', 'voluptatibus', 'images/watches/5.jpg', 280, 103, 0, 3, NULL, 0, 0, 1, '2018-03-31 06:43:40', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(58, 1, 2, NULL, 0, 'Non sequi commodi nam aut sint architecto.', 'non-sequi-commodi-nam-aut-sint-architecto', 'Facere consequuntur voluptatem corporis sequi. Sapiente blanditiis sint esse omnis. Architecto similique magnam temporibus. Dolor cupiditate ratione maxime nostrum molestias autem autem sint. Suscipit velit mollitia doloremque commodi repellendus autem no', 'Vero quo dolores quae aut corrupti eligendi est repudiandae. Consequuntur similique quia maxime culpa consequuntur. Et reiciendis earum exercitationem quasi nisi.\n\nIpsam quidem qui amet. Consequatur quaerat voluptatem quia.\n\nDelectus suscipit voluptatum et veniam in. Accusamus velit aliquid eius odit voluptates consequatur. Omnis unde molestiae facilis nihil voluptate. Reprehenderit fugit ea molestias animi.', 'Tempora dolorem et minima inventore facilis. Quia quia itaque est ad consequuntur minima illum. Quod eaque harum ab corrupti. Repellat explicabo officiis minus cumque modi sit.\n\nDucimus dolore ut dignissimos quia quia. Nihil aperiam deserunt ratione aliquid. Molestiae eum assumenda numquam sed nam inventore est. Ex consequatur ut tempore.\n\nSuscipit qui nostrum sunt ipsam quod ut iste sint. Quo neque neque in voluptatem. Et suscipit debitis consequatur accusantium non cum sint.', 'placeat', 'images/watches/5.jpg', 215, 98, 0, 2, NULL, 0, 0, 1, '2018-04-04 17:08:58', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(59, 1, 2, NULL, 0, 'Autem amet libero hic nostrum neque nostrum itaque.', 'autem-amet-libero-hic-nostrum-neque-nostrum-itaque', 'Inventore eligendi voluptas fuga. Deserunt eligendi qui ab aspernatur ut. Tempora voluptas rerum animi minus. Est consequatur enim voluptatum consequatur perspiciatis perspiciatis ipsum explicabo. Rerum et ipsum reiciendis sed.', 'Accusamus et quis odit rerum enim quaerat quae. Laborum aspernatur porro illum praesentium ipsa provident.\n\nQuos esse deleniti et unde laboriosam. Vero consectetur iusto nemo adipisci. Repellat adipisci et quae ut quae voluptates tenetur. Explicabo veritatis accusantium blanditiis hic doloribus odio aut est.\n\nVoluptatum autem et tempore laboriosam maxime numquam sit dolorem. Asperiores nihil placeat et in dicta quo veritatis. Similique et deserunt minima. Corrupti excepturi ut qui nam laborum repellat ratione.', 'Est natus ut maiores qui. Ab vero dicta architecto dolorem quia corporis impedit. Eos enim quibusdam minus animi natus.\n\nCorporis pariatur unde rerum sint officiis. Minima voluptatibus voluptas optio accusamus voluptates. Recusandae corporis expedita magni et amet et. Velit voluptas consequatur sint rerum rerum. Et qui id sed quia.\n\nDeserunt maiores iste aliquid sint quisquam iste. Itaque fugiat et labore quia. Reiciendis sit debitis et repellat ab.', 'cupiditate', 'images/watches/5.jpg', 204, 125, 0, 2, NULL, 0, 0, 1, '2018-04-05 04:09:32', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(60, 1, 2, NULL, 0, 'Aliquid id sunt ut et placeat vel id.', 'aliquid-id-sunt-ut-et-placeat-vel-id', 'Inventore quisquam incidunt illo accusantium. Qui in non eum ut sint. Beatae nam fugit sed fugit magni animi. Placeat quae aliquid ut hic temporibus. Illum id ad reprehenderit et reprehenderit occaecati.', 'Laudantium doloremque velit voluptatem delectus sit vero. Aut atque aut quis cupiditate. Quia a quis alias consequuntur fugit reprehenderit neque. Velit ex voluptatem blanditiis debitis et blanditiis.\n\nIllo voluptatum rem tenetur quo. Adipisci modi explicabo eligendi rerum nisi praesentium. Maiores id nobis accusantium eveniet illo perferendis.\n\nBeatae facere voluptate tempora quia. Accusamus consequuntur voluptatem alias sunt quae maiores. Voluptas sint hic dolor ut. Non voluptatem occaecati quibusdam aut.', 'Aut aut iste eos rem. Voluptatem qui et totam ipsa eligendi. Eveniet ipsa voluptatum itaque repellendus molestiae.\n\nAutem repellat magni optio provident. Et voluptates aliquam voluptates consequatur sint alias earum. Velit et blanditiis consectetur enim. Nobis ut voluptatem voluptatibus perferendis provident.\n\nCommodi sunt quam sunt ipsam dignissimos vel. Occaecati quasi excepturi in dolorum eaque est repellat. Velit laborum laborum nihil atque. Doloremque vero rerum vel odio accusantium.', 'nulla', 'images/watches/5.jpg', 210, 130, 0, 1, NULL, 0, 0, 1, '2018-04-12 17:32:40', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(61, 1, 2, NULL, 0, 'Voluptatem sequi qui ut dolorem fuga omnis.', 'voluptatem-sequi-qui-ut-dolorem-fuga-omnis', 'Natus et fugiat explicabo perspiciatis eveniet temporibus velit molestiae. Necessitatibus autem voluptatem eveniet dolores mollitia natus. Libero rerum atque impedit enim. Similique modi impedit enim consequuntur occaecati est.', 'Corporis quos rerum et ipsum in porro blanditiis. Corporis error qui ratione occaecati excepturi. Magni fuga ut cum excepturi soluta. Possimus qui ea voluptatem et aliquid.\n\nMollitia voluptas ut dolor perferendis. Soluta ratione maiores laborum eaque.\n\nAlias autem qui mollitia voluptas. Voluptas et ipsum molestiae dolorem corrupti voluptatibus voluptatem. Dolor est dignissimos vel rerum et fuga. Ut magni eveniet sapiente quibusdam.', 'Nihil molestiae aut veritatis. Quisquam dolores in a architecto. Consequatur saepe quia quia animi hic sed. Eum recusandae vel rerum laboriosam repellendus nihil.\n\nRatione rem eius reiciendis repellendus maxime numquam quod. Molestiae autem facere atque voluptas cupiditate quidem corrupti. Qui adipisci sed libero. Cum molestiae veniam vel vitae.\n\nExpedita ea quae sit. Nostrum et iusto facere excepturi neque blanditiis. Facilis id provident dignissimos veniam. Enim et ut consequatur et quibusdam vel sit.', 'adipisci', 'images/watches/5.jpg', 291, 101, 0, 2, NULL, 0, 0, 1, '2018-04-23 16:22:25', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(62, 1, 2, NULL, 0, 'Numquam esse ducimus aut molestiae qui fuga quod.', 'numquam-esse-ducimus-aut-molestiae-qui-fuga-quod', 'Ut sit dicta veritatis a. Veniam saepe consequuntur beatae aliquid suscipit ipsum. Eaque quae culpa corrupti omnis. Reiciendis aliquid maiores repellat dolores eum et.', 'Occaecati in soluta ipsa aut. Quis suscipit fuga corrupti ut aperiam pariatur nostrum. Iure harum dolorum dicta perferendis neque quidem voluptatem. Omnis est et et reiciendis error voluptatem. Veritatis quia in molestias et blanditiis.\n\nQuisquam non nobis voluptatibus. Nulla iste ut amet eaque rerum. Rerum assumenda adipisci ut et exercitationem in.\n\nMolestiae dolore omnis aliquid nostrum. Et expedita impedit veritatis architecto natus et ad. Sit eos repudiandae sequi fugiat id deleniti. Qui nesciunt dolore quo.', 'Incidunt sapiente quo odit voluptas. Ipsum voluptate est rerum officia. Animi quisquam officiis ut voluptates quidem. Fuga dolores quaerat nihil facere officia.\n\nNihil nam nulla commodi quia quaerat mollitia sit. Sed et facilis fuga ut modi incidunt. Quo eum voluptate et vel.\n\nVeniam quis rerum amet molestiae voluptatum sit dolor quia. Sed et sunt tempora quo tempore. Necessitatibus minus et deserunt.', 'numquam', 'images/watches/5.jpg', 135, 93, 0, 2, NULL, 0, 0, 1, '2018-04-19 13:27:40', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(63, 1, 2, NULL, 0, 'Quo nulla sunt quod laborum.', 'quo-nulla-sunt-quod-laborum', 'Officiis impedit exercitationem beatae necessitatibus. Tenetur ut magnam hic quo atque aspernatur error. Aut quaerat sed et vitae. In nisi sapiente velit at quia non.', 'Neque earum nihil est dolore incidunt dolorem non. Aut quo enim eum commodi eum veniam sit. Amet et quis qui distinctio labore nihil voluptates. Fugiat vel aperiam quia ut voluptas corrupti.\n\nAdipisci corporis sunt commodi beatae laudantium qui. Excepturi dolorem numquam delectus et quisquam aut. Odit sunt fugit impedit veniam est et occaecati. Laboriosam velit voluptatem nemo nihil omnis.\n\nAut ex mollitia est voluptas. Sed odio voluptatibus aliquid.', 'Non odio omnis dolorem quos perspiciatis consequatur harum sed. Est labore maxime ea quod et. Eveniet saepe perspiciatis repudiandae reprehenderit facere. Quos voluptatibus autem dolor reprehenderit.\n\nVoluptatum et voluptatum sequi. Reiciendis similique omnis maxime asperiores hic. Omnis et omnis non veritatis expedita.\n\nNesciunt error porro laborum itaque consequatur. Magni quo nisi animi nostrum. Ipsam est molestias laborum ut. Esse sit quam aut.', 'sed', 'images/watches/5.jpg', 145, 128, 0, 3, NULL, 0, 0, 1, '2018-04-19 01:27:22', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(64, 1, 2, NULL, 0, 'Sed et voluptatum voluptatem aut ut est.', 'sed-et-voluptatum-voluptatem-aut-ut-est', 'Laudantium distinctio labore ut ipsa porro. Repellat iste aperiam deserunt sint est. Ipsa consequatur perferendis ipsa molestiae necessitatibus praesentium voluptas.', 'Illum iure minima ut exercitationem vel. Accusamus cumque laboriosam occaecati pariatur est itaque. Beatae voluptatum nihil qui vitae facilis. Fuga eos exercitationem et sunt ad rerum. Et aut est eum distinctio corrupti.\n\nSit facere sunt quos aut repellat eligendi. Quis at voluptatibus magni numquam ut. Tempora est iure tempore deleniti nihil optio eveniet.\n\nLaboriosam voluptatibus facere quidem excepturi qui sunt fuga. Dolores asperiores ut ut ab nemo aut ex. Officiis omnis nihil hic corrupti numquam qui. Quis quibusdam quis dolor nostrum.', 'Similique perferendis voluptas earum. Possimus nostrum quis reiciendis quaerat incidunt. Dolorum et minus sed.\n\nQuia id iure consequatur consequatur nesciunt. Architecto vitae et quaerat sint. Aut doloremque quae sequi odio minus.\n\nRem eum et dignissimos. Sapiente quos possimus saepe tempore nam.', 'qui', 'images/watches/5.jpg', 263, 99, 0, 1, NULL, 0, 0, 1, '2018-04-05 16:19:10', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(65, 1, 2, NULL, 0, 'Recusandae blanditiis est dolores cumque ad ipsa ratione.', 'recusandae-blanditiis-est-dolores-cumque-ad-ipsa-ratione', 'Voluptas sint rem quasi. Numquam quibusdam et amet quasi deleniti sed. Eius ut omnis rem. Eligendi eum voluptas odio suscipit veritatis fuga. Repellat soluta consequatur molestiae eum explicabo.', 'Odit magni cumque corrupti mollitia occaecati recusandae. Excepturi et quas illum nihil. Vel explicabo reprehenderit cum qui velit qui autem nam. Nam et sapiente magnam omnis dolorem aliquam enim.\n\nLaudantium fugiat nihil veritatis qui ut minima. Ipsam vel dolores qui illum quia ea. Repellat amet deserunt ab et qui.\n\nNumquam autem laudantium et amet voluptatem. Unde necessitatibus molestiae et quod dolor architecto.', 'Itaque occaecati et mollitia. Sint eaque vel est beatae perferendis aut repellat aut. Aperiam sequi esse reprehenderit sapiente voluptatem aliquam. Aliquam impedit nam qui eius distinctio quis consequatur.\n\nDolorum laboriosam saepe ducimus omnis. Sed aut aperiam atque aperiam. Ullam at saepe dolor exercitationem voluptatem.\n\nFacilis voluptatem possimus itaque hic culpa sunt. Laborum incidunt quis et quis quis rerum. Consequuntur quasi voluptate voluptatem excepturi accusantium.', 'est', 'images/watches/5.jpg', 158, 120, 0, 3, NULL, 0, 0, 1, '2018-04-06 16:55:24', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(66, 1, 2, NULL, 0, 'Autem sunt id dolore distinctio.', 'autem-sunt-id-dolore-distinctio', 'Voluptates rerum sit et excepturi corrupti quidem. Qui dolor consectetur rerum error rerum velit. Dignissimos ipsa ipsa sint aut blanditiis iste natus. Alias provident accusamus et occaecati et minus.', 'Consectetur et exercitationem est et. Labore odit et beatae. Quis enim harum voluptatum. Quia laudantium consequuntur ab debitis ullam.\n\nModi in voluptatem expedita nihil est dolorem. Sequi voluptas ipsam dolorem facilis recusandae.\n\nAccusamus explicabo repellendus ea assumenda iure qui. Nam blanditiis maiores et tempora veritatis ut. Ut iure doloremque vitae delectus corporis quia vero. Aspernatur animi recusandae nemo est. Veritatis placeat expedita aut et necessitatibus et.', 'Dolor magni et at laboriosam laboriosam. Est delectus odit est tempora minima eveniet voluptas illo. Eum enim fugit sit reiciendis. Odio dolores illo porro perspiciatis esse.\n\nCorrupti tenetur et commodi molestias. Incidunt dolor error sed dolores velit. Dignissimos omnis alias commodi saepe eos. Possimus reprehenderit animi excepturi quis rerum distinctio est voluptatem.\n\nEst occaecati voluptas necessitatibus eos quibusdam consequuntur. Quis consequatur libero qui. Atque corporis accusantium ad ut rerum consequatur tempora.', 'quia', 'images/watches/5.jpg', 113, 107, 0, 1, NULL, 0, 0, 1, '2018-04-15 22:41:23', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(67, 1, 2, NULL, 0, 'Veritatis quis exercitationem ratione porro.', 'veritatis-quis-exercitationem-ratione-porro', 'Mollitia eum omnis animi sed iure. Voluptatem inventore quod earum animi sint nam fugiat. Assumenda adipisci vel quas nam sed. Aut accusamus provident modi velit suscipit eum qui laborum.', 'Atque est distinctio qui voluptas. At sit numquam dolore. Distinctio maiores rerum voluptatem id quos sit. Sed at vitae iusto et et aut eos.\n\nEnim autem fugit sapiente ut similique necessitatibus. Tempore magni nihil ut occaecati culpa nisi odit.\n\nMolestiae molestias autem corporis sint voluptas voluptas aut. Fuga inventore aperiam animi.', 'Unde architecto ea id voluptas. Qui exercitationem assumenda quis eum asperiores et. Ducimus animi vero et excepturi. Consequatur hic qui et consectetur.\n\nExplicabo quam quae voluptatibus sunt eveniet. Ut dolores vel et modi saepe amet molestiae. Magni et eum nemo et saepe nihil atque.\n\nTenetur odit veritatis voluptates est est maiores. Minus sunt dolore saepe ut ratione iste error.', 'quidem', 'images/watches/5.jpg', 184, 91, 0, 3, NULL, 0, 0, 1, '2018-03-29 15:58:33', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(68, 1, 2, NULL, 0, 'Dignissimos voluptatem ea molestiae dicta nulla.', 'dignissimos-voluptatem-ea-molestiae-dicta-nulla', 'Molestias est debitis sed modi et nemo reprehenderit. Alias sunt voluptatibus distinctio rerum reiciendis omnis. Qui odio dolor libero tempora et commodi. Et non omnis commodi et deserunt.', 'Et similique eos distinctio cum aperiam quis. Reprehenderit aliquam rem asperiores. Quia tempore ipsa odit nisi.\n\nDoloribus rerum dignissimos similique. Quo autem porro est dicta. Ut animi unde veniam nesciunt.\n\nUt et deserunt et nulla veniam distinctio doloremque quisquam. Vitae et ut sint est. Accusamus tempore modi omnis. Atque molestiae nihil qui voluptates voluptas.', 'Dolores sunt voluptas autem quis sit. Voluptatum consequatur nulla sed esse id quia. Quo molestias tempora sed temporibus.\n\nOdio molestias recusandae voluptatum minima. Ab maxime non aspernatur rerum explicabo est facilis. Officia autem provident aut mollitia voluptate in ratione. Laudantium voluptate ut nostrum dolorem voluptatem repudiandae incidunt.\n\nAutem et sunt expedita pariatur est incidunt asperiores. Corrupti id aut ipsum consequatur eum nisi vel. Voluptatibus quia velit suscipit a quo. Velit quo molestiae velit iste.', 'facilis', 'images/watches/5.jpg', 151, 129, 0, 1, NULL, 0, 0, 1, '2018-04-15 01:25:52', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(69, 1, 2, NULL, 0, 'Omnis impedit error laudantium deserunt sequi quis.', 'omnis-impedit-error-laudantium-deserunt-sequi-quis', 'Aut eligendi id voluptas tenetur veniam aliquid. Qui omnis dignissimos beatae vel et. Provident ut corporis omnis quo necessitatibus esse.', 'Dolores occaecati reiciendis dignissimos ut quam. Facere et quibusdam consectetur et maiores.\n\nTotam quos ad accusantium sit unde ipsam fugit. Quo voluptatem beatae quaerat enim quod. Placeat id tenetur a alias non.\n\nQuo velit et aut reiciendis nobis. Et quia reiciendis magni sit hic corrupti. Vel facilis possimus quasi omnis. Repellendus inventore vel est.', 'Mollitia amet voluptatem tempora eum expedita incidunt magni. Sunt ut inventore aliquam.\n\nIllum veniam odit eaque quos accusantium ea fugit. Dolore et officia architecto dolores. Culpa at non eveniet incidunt quasi ut.\n\nConsectetur sequi aut et aperiam. Facere exercitationem autem ut aut eligendi vel magnam. Commodi ut inventore ut sint sit a. Eos commodi quo illum necessitatibus laboriosam et aut.', 'quasi', 'images/watches/5.jpg', 286, 93, 0, 2, NULL, 0, 0, 1, '2018-04-03 20:15:32', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(70, 1, 2, NULL, 0, 'Ducimus molestiae quis laborum veritatis eum.', 'ducimus-molestiae-quis-laborum-veritatis-eum', 'Ad voluptatem illum maiores quis ipsa. Ut aliquid dicta consectetur in vel omnis perferendis fugiat. Cum tempora quisquam iste ipsum atque accusantium.', 'Qui illum dolor eveniet. Exercitationem impedit et nisi et.\n\nPorro qui quod consequuntur. Repellat quia non et dolorem. Quae voluptatum corrupti vel dolores harum voluptatibus necessitatibus.\n\nVero unde nesciunt alias commodi modi aperiam alias voluptas. Veniam cum et voluptas animi esse ipsum adipisci et. Quia eum asperiores totam expedita alias mollitia aut. Accusantium nostrum earum enim commodi.', 'Voluptatem magnam odit hic officiis in. Et dolore nulla quis fugit id quia facere aperiam. Ullam nemo facilis ipsum itaque exercitationem. Necessitatibus sequi libero modi temporibus fuga.\n\nEnim iste recusandae molestiae voluptatem. Et impedit nisi ut cum deleniti. Inventore qui perspiciatis fuga qui sed. Provident exercitationem sunt blanditiis sit.\n\nCorporis possimus velit dolores eum. Id aut alias et corrupti voluptates perferendis in.', 'soluta', 'images/watches/5.jpg', 270, 97, 0, 1, NULL, 0, 0, 1, '2018-03-31 00:41:34', '2018-04-25 13:46:08', '2018-04-25 13:46:08'),
(71, 1, 2, NULL, 0, 'Veritatis nihil quia aut.', 'veritatis-nihil-quia-aut', 'Voluptatem nisi est minima molestiae qui atque omnis nulla. Quas pariatur amet facilis ducimus. Laboriosam eos praesentium explicabo reiciendis quae qui eaque.', 'Ut molestias eaque et nisi autem ratione totam molestiae. Iusto saepe error quas voluptas. Eligendi at voluptatum qui molestias. Impedit praesentium et corrupti dolores soluta.\n\nNostrum nam et ea pariatur autem. Officia veritatis voluptas tempore. Ullam nihil deserunt id quo vero.\n\nAliquid eveniet aliquid aut assumenda ut et. Qui magni enim autem. Qui qui non doloremque blanditiis voluptate quas.', 'Distinctio non dolorem molestiae temporibus ipsam aut est quas. Occaecati perspiciatis ducimus provident facere eligendi. Sint dicta voluptatem molestiae debitis eligendi inventore quam. Quia perspiciatis commodi quis incidunt enim possimus.\n\nAut non rerum eos dolore maxime non ea. Exercitationem vel facere voluptate quae voluptatem. Autem ipsum doloribus magni in et.\n\nQuisquam dolores tempora est recusandae cum rerum quasi. Ipsum qui architecto aspernatur consectetur quos voluptate. Nostrum et sunt harum eum ut ducimus qui eveniet. Accusantium esse quas molestias et enim.', 'beatae', 'images/watches/5.jpg', 259, 98, 0, 1, NULL, 0, 0, 1, '2018-04-01 15:59:10', '2018-04-25 13:46:08', '2018-04-25 13:46:08');
INSERT INTO `products` (`id`, `user_id`, `brand_id`, `collection_id`, `set_id`, `title`, `slug`, `short`, `body`, `body2`, `code`, `image`, `price`, `price_outlet`, `views`, `amount`, `color`, `discount`, `sold`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(72, 1, 2, NULL, 0, 'Nihil nobis error a reprehenderit libero odit.', 'nihil-nobis-error-a-reprehenderit-libero-odit', 'Provident repellendus qui beatae consectetur nihil at perferendis est. Beatae sequi temporibus voluptas qui. Eum architecto optio doloribus expedita ipsam.', 'Corporis nesciunt quam deleniti quae voluptates exercitationem. Qui commodi et illum ut dolores qui nisi. Est illum omnis harum ut cum.\n\nQuia distinctio molestiae ab fugiat dolorem. Quidem dolor doloribus eveniet atque fugiat. Provident molestiae molestiae voluptas fuga et ea non.\n\nPerferendis qui dolorem modi officiis ullam debitis. Ipsum voluptas dolores mollitia rerum autem. Rem qui eum qui placeat consectetur. Odit aspernatur tenetur dolorem libero incidunt est omnis.', 'Quisquam et tempora nihil nostrum magnam. Modi expedita et est voluptas quibusdam eos. Aperiam dignissimos consectetur error ut consequatur.\n\nQuasi dolores sint qui rerum vitae. Molestias sit velit animi id est maxime quia. Vero veritatis veritatis dolorem nihil consectetur qui voluptatem maxime.\n\nEius repellat est quo totam animi quam itaque numquam. Numquam neque quas aut error qui dolor et. Voluptas rerum praesentium fugit assumenda molestiae pariatur.', 'sint', 'images/watches/5.jpg', 259, 111, 0, 2, NULL, 0, 0, 1, '2018-04-10 01:48:56', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(73, 1, 2, NULL, 0, 'Alias recusandae voluptatem culpa voluptas sint sit consequuntur.', 'alias-recusandae-voluptatem-culpa-voluptas-sint-sit-consequuntur', 'Dolor dolore sunt amet voluptates quisquam occaecati incidunt molestiae. Qui non eum eos sequi consequatur. Assumenda maxime quae earum error voluptate incidunt fugiat. Voluptate et nihil ducimus repellendus voluptas.', 'Officiis atque in non eum labore nihil. Ullam corporis enim voluptas voluptas. Sapiente nam necessitatibus rem distinctio voluptas. Necessitatibus expedita ex modi aut quam.\n\nAutem earum dolorem reiciendis quae. Ullam et voluptates modi fuga. Aperiam optio sint nisi. Fugit ut optio voluptas est.\n\nVoluptatem itaque et modi aperiam sequi. Dolor magni sequi numquam autem similique voluptatum nihil ea. Voluptate molestiae provident beatae ut nulla.', 'Cumque iste inventore sit excepturi maiores aliquid. Ex repudiandae culpa velit occaecati. Omnis expedita autem sapiente consectetur dignissimos. Sunt sed cum aut sunt sunt quas pariatur.\n\nVel totam ut ad dolorem tenetur autem quas. Error tempore et placeat quia ut. Ut soluta nihil veniam ut at in. Nihil odio ipsa fugit qui at optio.\n\nEst nihil ut voluptatum non ducimus. Mollitia ex repellendus perferendis rerum et eveniet quibusdam.', 'tenetur', 'images/watches/5.jpg', 207, 122, 0, 3, NULL, 0, 0, 1, '2018-04-12 17:57:31', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(74, 1, 2, NULL, 0, 'Sequi quasi quisquam veritatis quia.', 'sequi-quasi-quisquam-veritatis-quia', 'Neque reiciendis nobis culpa vero molestiae qui voluptatem. Vel et omnis et. Perspiciatis libero saepe veniam rem animi in nemo. Necessitatibus dolorem consequatur alias molestias quia.', 'Et laudantium hic magnam eveniet. Dolorem dolor praesentium voluptas ipsam. Ipsa est et molestias rem id et aut dolor.\n\nUllam quia voluptate quasi blanditiis quae aperiam. Nisi facere et maiores ab culpa consequuntur architecto. Possimus veniam dolorem magni molestiae eligendi quaerat.\n\nDebitis pariatur eveniet deserunt deserunt quisquam et molestiae. Temporibus vel sint nobis ratione neque. Magnam modi quas minus amet eius a odit.', 'Ab qui consequatur quis eum. A porro aut itaque maiores rem asperiores ipsa. Error nisi harum rerum quo eos molestiae.\n\nQui labore quod est voluptatem doloremque. Consequatur quam ea est atque aut error. Dolorum ut tempora nesciunt quae doloribus fuga repudiandae est.\n\nQuo doloribus consequuntur ea id explicabo. Et ut eos atque non saepe officiis. Harum numquam repudiandae at eveniet facere sint adipisci.', 'non', 'images/watches/5.jpg', 226, 142, 0, 3, NULL, 0, 0, 1, '2018-03-31 22:46:23', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(75, 1, 2, NULL, 0, 'Eius natus dolorum autem dignissimos praesentium et illum tenetur.', 'eius-natus-dolorum-autem-dignissimos-praesentium-et-illum-tenetur', 'Optio nihil quod quis. Consectetur sapiente quia animi vitae vel culpa sunt. Ut enim autem sequi quisquam odio sint illum sint.', 'Nobis necessitatibus voluptatibus quos consequuntur repellat sint. Eos reiciendis rerum sint ut aliquid pariatur. Quis eum sit adipisci. Sint dolores officia dolores nesciunt.\n\nEt aliquam ducimus cum eos. Et soluta in modi sint quia.\n\nBlanditiis beatae dignissimos laborum dolorem. Fuga omnis aut dicta reiciendis reprehenderit similique voluptatem voluptatum.', 'Quo et dolore numquam sunt vero qui debitis. In adipisci nam ut. Et a magni dolore. Fugit voluptatibus dolores minus nam ratione.\n\nNihil excepturi dolor eos quibusdam cumque molestiae provident. Eos nihil qui error ut laboriosam quis laborum. Quia dicta iusto et est perferendis aut.\n\nQuo illum voluptates vitae eaque eos. Similique illum qui quod debitis qui dolorem.', 'sed', 'images/watches/5.jpg', 214, 144, 0, 2, NULL, 0, 0, 1, '2018-04-07 23:56:54', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(76, 1, 2, NULL, 0, 'Architecto ad laudantium autem molestias consequatur nihil eum architecto.', 'architecto-ad-laudantium-autem-molestias-consequatur-nihil-eum-architecto', 'Odit exercitationem ipsum quis. Voluptatibus odio laudantium ea eum quos accusantium nulla. Eos est repellendus velit et laborum.', 'Ab repudiandae ea et quam aut. Et et totam qui deleniti iure expedita aspernatur iure. Rerum iste iste omnis ea ipsam molestiae quasi. Sit inventore ut cumque doloremque temporibus odio.\n\nEarum veritatis et sapiente recusandae eveniet quidem. Libero distinctio deleniti minus commodi beatae. Magni rerum hic unde hic sint numquam.\n\nDelectus velit dolore et non aut a. Ut accusantium alias earum aliquid.', 'Quia sunt tempora magni sunt assumenda minima dolores quod. Aut vitae odio impedit ipsa temporibus quibusdam. Sint harum est excepturi quo.\n\nQui repudiandae et blanditiis repudiandae ab nostrum. Vel dolore vero officiis magnam soluta. Optio nesciunt est hic atque officia.\n\nSuscipit illo repellendus amet non itaque quaerat. Porro nulla asperiores dolore recusandae qui molestiae. Ratione accusantium error ipsam sit. Sunt fugit voluptatem quia adipisci error quisquam.', 'fuga', 'images/watches/5.jpg', 176, 86, 0, 3, NULL, 0, 0, 1, '2018-03-31 01:41:18', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(77, 1, 2, NULL, 0, 'Et ullam voluptate aut quo.', 'et-ullam-voluptate-aut-quo', 'Explicabo quasi consequatur quis dolor et. Quam ea aliquam vitae quaerat ex. Qui voluptatibus rerum rem. Corrupti et quia quas dolore.', 'Dolores error distinctio perspiciatis et fugiat perspiciatis exercitationem quas. Minus aspernatur culpa temporibus. Cupiditate rerum est quo odio tenetur magni molestiae dolor. In qui voluptas corporis et odit.\n\nInventore excepturi exercitationem rem nesciunt inventore eos numquam. Omnis consequatur quibusdam velit facilis. Reprehenderit tenetur et sit enim. Sapiente dolores autem ut a.\n\nRerum quibusdam impedit corrupti qui. Quam perferendis aperiam repellat esse eum dolorem ab harum. Necessitatibus perferendis et nisi aut qui voluptas harum velit.', 'Possimus ut laborum esse aut numquam quibusdam et. Nisi et dolores quaerat rerum voluptates ab quia.\n\nRepellat enim est rem voluptatem voluptas consequuntur. Sed enim voluptates et est fuga est ullam. Placeat omnis quia tempora ea et amet.\n\nVeniam ut dolorem dolor et. Velit porro nulla voluptatibus sit id. Debitis autem quos ad beatae non optio numquam.', 'eum', 'images/watches/5.jpg', 146, 107, 0, 3, NULL, 0, 0, 1, '2018-04-20 06:49:15', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(78, 1, 2, NULL, 0, 'Debitis ut ab quas qui sint praesentium necessitatibus.', 'debitis-ut-ab-quas-qui-sint-praesentium-necessitatibus', 'Nesciunt cupiditate ipsa maxime adipisci blanditiis. Voluptatibus voluptatem omnis quia hic doloribus. Aut tempore temporibus consequatur vero atque.', 'Recusandae sint consequatur nemo praesentium hic molestias architecto. Saepe aut et eveniet voluptatem. Veniam et esse molestias blanditiis voluptatem.\n\nDolor ipsum deleniti pariatur doloribus aperiam doloribus non. Dolorem nesciunt non in dolorem fugit ut. Corrupti rerum amet et similique temporibus libero. Rerum culpa rerum exercitationem deleniti quia.\n\nFacilis sit qui dolor quia aperiam architecto ut consequatur. Animi delectus quia numquam dolorem.', 'Ut provident nulla pariatur qui ducimus facere. Et qui saepe et labore nisi. Totam quo saepe totam qui est sed.\n\nVeritatis exercitationem culpa aut voluptate omnis. Ea alias et earum quibusdam id recusandae. Aut in expedita quisquam repellendus ducimus alias tempora voluptatem. Aut sed molestias itaque repellendus dolor consequuntur expedita.\n\nEt enim sunt minima maiores ex voluptatem. Ipsa ipsa non aut commodi at animi sit.', 'itaque', 'images/watches/5.jpg', 176, 93, 0, 3, NULL, 0, 0, 1, '2018-04-15 10:50:45', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(79, 1, 2, NULL, 0, 'Debitis exercitationem sed earum qui dolores.', 'debitis-exercitationem-sed-earum-qui-dolores', 'Qui sint quis aperiam. Unde voluptatem voluptate et sequi sapiente deserunt quia. Maxime alias molestiae quisquam similique magni velit dolorum. Et saepe nulla porro totam debitis eos porro.', 'Architecto minima occaecati officia aliquam tempora enim vitae aut. Quisquam at harum et sunt autem sit ut. Mollitia laudantium natus quia quidem. Ut ea rerum iure veniam tempore enim quas.\n\nIure numquam velit magni molestias non sed similique distinctio. Doloremque voluptate ullam et aliquid ex quibusdam et. Adipisci deserunt aut veniam debitis sed dignissimos repellendus. Aut nostrum ut dolorum cumque itaque facilis id.\n\nDeleniti voluptates optio provident quia aliquam. Esse sapiente tenetur consectetur aut expedita odit. Perferendis omnis expedita ratione est nulla. Sapiente similique cupiditate similique fuga alias temporibus sit.', 'Est et voluptate pariatur possimus rerum. Sed natus sit sint sunt. Ut qui quia ullam vero et error.\n\nEveniet dolore dolorem maxime consectetur ut. Sit enim eaque enim animi est. Facilis necessitatibus ut adipisci repellendus. Fuga eos modi non voluptas.\n\nExcepturi quia et sint ut ut expedita qui. Iste facere in adipisci et sunt sequi. Et consequuntur inventore occaecati sit consequuntur voluptatibus quidem ut.', 'earum', 'images/watches/5.jpg', 261, 100, 0, 2, NULL, 0, 0, 1, '2018-03-26 15:15:34', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(80, 1, 2, NULL, 0, 'At eos doloribus voluptates dolorum ut.', 'at-eos-doloribus-voluptates-dolorum-ut', 'Velit omnis ut in non. Consequuntur facere cupiditate consectetur aut non tempora saepe ipsam. Accusamus alias quo eum quibusdam est illum omnis et. Dolores qui delectus accusamus saepe sint a explicabo. Ea laborum nihil et et ratione sed aliquam.', 'A excepturi aut quis. Labore nihil nobis voluptatem voluptate facere facere aut omnis. In unde quam et voluptas. Quia animi voluptatum esse officia ut eligendi.\n\nEos quos ullam et eius dolor. Labore dignissimos numquam perferendis. Vitae odio ut non nesciunt sit iste quod.\n\nAut cupiditate eveniet debitis modi esse quas. Dolorem sit distinctio nam aspernatur. Quia sapiente aut quia aliquid et culpa.', 'Non aspernatur est quas possimus eum. Non aut omnis omnis asperiores consequatur pariatur laborum. Facere molestiae nemo sapiente odit illum quia debitis. Qui fugit officia nihil qui eum et animi rerum.\n\nAutem eligendi at odit ut. Consequatur nam facere vitae modi sunt est assumenda. Quis a sit earum. Cum nisi consequuntur ipsa enim doloremque molestiae.\n\nQui nam repellat commodi. Enim maiores facilis vel laudantium quasi. Quos est totam eos sed quibusdam omnis similique.', 'eaque', 'images/watches/5.jpg', 103, 130, 0, 2, NULL, 0, 0, 1, '2018-04-06 05:41:54', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(81, 1, 2, NULL, 0, 'Dolores sint provident perferendis excepturi.', 'dolores-sint-provident-perferendis-excepturi', 'Magnam maiores corrupti ut. Sed hic id sed est quis ducimus. Blanditiis velit fuga aut error quo adipisci sapiente aut. Saepe cumque nihil sed doloremque blanditiis minima quas.', 'Quos enim quidem aut facere placeat. Ullam saepe omnis adipisci. Placeat id enim ut architecto et vel.\n\nDolorum commodi ex voluptatem qui. Quisquam laborum ipsum excepturi provident sit voluptas architecto dolor.\n\nAutem quas perspiciatis facilis aut cumque quis. Qui voluptate cumque facilis voluptatibus dolores facere. Earum tempore omnis aut ex atque.', 'Illum tenetur molestiae doloribus consectetur officia. Enim debitis et distinctio porro corporis repellendus. Totam qui quibusdam corrupti asperiores quo eos.\n\nDebitis neque officiis optio et. Totam in rerum ipsum adipisci modi consequatur. Impedit quibusdam porro doloribus perspiciatis. Repudiandae pariatur quaerat suscipit veritatis accusamus voluptatibus dolore nemo.\n\nDolore cum autem delectus dolorem. Quidem asperiores tempore sunt officia est. Aliquam ut molestias cupiditate quidem harum.', 'beatae', 'images/watches/5.jpg', 128, 123, 0, 2, NULL, 0, 0, 1, '2018-04-10 15:27:01', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(82, 1, 2, NULL, 0, 'Quia corporis iste sint unde.', 'quia-corporis-iste-sint-unde', 'Nemo molestias rerum ut enim dicta similique natus aliquam. Ut quia et laudantium assumenda minus aspernatur saepe. Nemo repudiandae sint maxime et.', 'Nihil nisi repudiandae illum harum at sapiente. Dolorem ad voluptas quod dolores doloremque. Tempore praesentium ex eius rerum.\n\nFugiat illo odit est. A repellendus quidem quos iure est quisquam minima. Rerum est quisquam aut ipsa hic sunt omnis. Qui nostrum incidunt laborum architecto reiciendis.\n\nIn corrupti voluptas sunt libero veritatis aut. Quam asperiores sapiente vel eum. Veritatis consequuntur earum modi mollitia nihil mollitia velit. Et neque consequatur magni non quia quae sint.', 'Magnam dolores recusandae quidem consequuntur. Quis veritatis consequatur a temporibus. Blanditiis aut est natus nisi nihil omnis eos dolor.\n\nLaudantium eligendi in voluptates architecto. Necessitatibus omnis consectetur suscipit in dolores quibusdam numquam in. Vel sit quia ab cumque saepe alias. Et repellendus dolorem ut praesentium in incidunt reprehenderit ullam.\n\nPorro voluptates commodi architecto saepe corrupti. Suscipit dignissimos qui aut numquam facilis voluptas qui nisi.', 'ea', 'images/watches/5.jpg', 150, 133, 0, 1, NULL, 0, 0, 1, '2018-04-18 05:45:19', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(83, 1, 2, NULL, 0, 'Ratione porro tempora et quo in consequatur.', 'ratione-porro-tempora-et-quo-in-consequatur', 'Sit assumenda quis eligendi velit facilis. Vero vel velit amet qui corrupti voluptas corrupti. Sunt doloribus itaque praesentium dolorem et.', 'Molestiae a illum eius asperiores. Laborum labore voluptatem distinctio vel sunt nihil. Dolores quod laborum natus delectus sunt. Rerum eius ipsum reprehenderit debitis reiciendis et tempora dolor.\n\nCum sit voluptas aliquid amet delectus fugiat aperiam. Cum dolorum error recusandae sit hic minima totam. Veritatis magnam ducimus dolores aperiam. Laborum numquam minus molestiae rerum enim aperiam nostrum.\n\nConsectetur necessitatibus et laudantium quos quia delectus veritatis. Veritatis quam beatae quod commodi a. Doloremque quasi molestiae quis consequuntur aut.', 'Unde dolores maxime voluptas et fugiat. Cupiditate animi sint tempore sit. Pariatur minus occaecati aut rerum beatae corporis dignissimos. Quo et est porro autem facere mollitia.\n\nMaxime eveniet rerum temporibus assumenda aspernatur sed. Quidem laudantium corrupti nisi dolorem alias. Voluptatem tempore consectetur fugit qui omnis.\n\nEst commodi est voluptatem fuga nam dicta. Commodi incidunt accusamus totam similique. Non aliquam quia libero autem totam cum.', 'in', 'images/watches/5.jpg', 297, 139, 0, 2, NULL, 0, 0, 1, '2018-04-02 16:52:36', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(84, 1, 2, NULL, 0, 'Quia magni qui id exercitationem rerum.', 'quia-magni-qui-id-exercitationem-rerum', 'Ut dolor aspernatur sapiente voluptatum. Corrupti voluptate voluptatem facilis quasi vel placeat quae consequatur. Eaque ex repudiandae amet. Provident molestiae provident aliquid qui id. Ut consectetur aut enim laborum atque incidunt a.', 'Aut consequatur quisquam quos labore aut accusamus. Odit dolore nostrum veniam repellendus. In quis assumenda non harum necessitatibus.\n\nExcepturi hic omnis asperiores. Eum aut consequuntur et qui saepe pariatur debitis dolor. Eligendi ea exercitationem ex accusamus animi iure sed. Magni blanditiis aut cumque eum.\n\nEa suscipit ut nemo. Et voluptatem reiciendis voluptas laudantium nisi enim possimus. Et vel eius est modi fugiat sunt ad quia.', 'Sint aut maxime ab non et excepturi. Corporis est veniam in et a dolore possimus quasi. Error maxime dolores architecto fugit et. Reiciendis aut totam nam et sit.\n\nQuo qui qui iusto dolores praesentium sed sed repellat. Ipsam quo ad quibusdam et hic voluptate aut. Est eos ipsum facere exercitationem rerum temporibus.\n\nItaque deleniti consequatur et id sint corrupti. Ipsam maiores inventore enim id ratione. Maxime dolorem quis laborum itaque.', 'natus', 'images/watches/5.jpg', 168, 90, 0, 2, NULL, 0, 0, 1, '2018-03-28 09:51:48', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(85, 1, 2, NULL, 0, 'Dolor fugit enim a similique.', 'dolor-fugit-enim-a-similique', 'Ut voluptas et sed quas. Eius iure corrupti deserunt quidem assumenda. Qui qui autem odit asperiores repellendus aut.', 'Perspiciatis alias qui consequatur qui est voluptas. Sit aut sit reiciendis dolorem. Id voluptatibus sequi qui inventore quis quidem.\n\nEos ratione ut culpa unde. Omnis rerum ipsum recusandae ipsum laborum. Est beatae expedita libero maiores et. Delectus omnis provident placeat nostrum autem suscipit velit aliquam.\n\nSed sit voluptatem quasi aut voluptas accusantium. Ducimus natus facilis ad soluta qui ut sit. Et iste officiis ullam repellat. Consequuntur cupiditate porro repellat ea nam voluptas numquam.', 'Eos excepturi sint dignissimos corrupti cumque nam. Deleniti eos est ut quia illum est. Facere voluptates est earum exercitationem.\n\nIllo fugit minima reprehenderit ipsa quae. Qui expedita velit et. Ipsam vitae doloremque perspiciatis quidem dolor architecto.\n\nNisi a quia et ducimus excepturi laborum officia. Officiis molestiae laudantium officiis sint. Consequatur rerum ut accusamus placeat unde ratione blanditiis.', 'non', 'images/watches/5.jpg', 270, 97, 0, 2, NULL, 0, 0, 1, '2018-03-28 16:06:51', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(86, 1, 2, NULL, 0, 'Nemo temporibus aut quos.', 'nemo-temporibus-aut-quos', 'Ea tempore velit assumenda vitae dolor quam. Reiciendis debitis ea qui aut. Commodi asperiores saepe rerum dicta. Illum debitis aut ex omnis iusto.', 'Enim atque aut ullam veritatis. Voluptas maiores fuga porro deleniti.\n\nMinima dolores vel perspiciatis recusandae non consequatur nihil. Quod voluptates ullam eius non dolores similique consequatur incidunt. Accusamus quas quia voluptatem rerum magni voluptates.\n\nRepudiandae sit libero delectus sequi. Labore qui culpa nisi. Quos impedit est consequuntur rerum aspernatur. Beatae ut nesciunt et nemo delectus qui.', 'Nesciunt libero iure ut. Itaque illum aut aspernatur saepe et. Deleniti qui aliquid ut ut non. Amet necessitatibus rerum facilis rem ut odit.\n\nEa repellendus quos inventore et aut qui. Maxime nam mollitia possimus non eveniet eaque sed quo. Odio aut quasi at quo aut id rerum. Libero aperiam dicta saepe quas asperiores quos.\n\nEt id voluptatem et unde. At velit sed at suscipit sit similique aut. Voluptatem omnis temporibus est omnis porro et. Recusandae maiores error esse similique quo corporis.', 'ut', 'images/watches/5.jpg', 128, 133, 0, 1, NULL, 0, 0, 1, '2018-04-06 23:05:30', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(87, 1, 2, NULL, 0, 'Cumque id eligendi voluptate iste veritatis.', 'cumque-id-eligendi-voluptate-iste-veritatis', 'Laudantium magni eligendi distinctio est beatae. Vitae fuga distinctio praesentium eaque commodi esse ea corrupti. Qui voluptates omnis vero deserunt officiis aut.', 'Et vel explicabo ut sapiente molestias sed maiores. Nulla adipisci non quis molestiae non temporibus distinctio. Dolor ullam eum error molestias dolores.\n\nCumque deleniti in dolorum quidem. Quibusdam dolores magnam odio expedita doloribus ut. Quos adipisci facilis quae praesentium.\n\nHarum ea veritatis vitae voluptas nam. Id molestias voluptatem ex magnam error. Ut non est consequatur rerum autem.', 'Blanditiis ab aliquid aut iusto ratione aliquam. Doloremque quibusdam consequuntur quo quia quae ad. Sint a ut aliquid blanditiis. Omnis beatae repudiandae possimus enim maxime perferendis.\n\nQui qui eos qui nobis possimus et qui. Sunt explicabo doloribus vero. Qui adipisci et ab.\n\nMagni officia ipsum esse est. Necessitatibus et nihil sit tempora. Sequi soluta voluptatem ea. Est aut dolorem debitis quibusdam ut placeat et.', 'quas', 'images/watches/5.jpg', 166, 94, 0, 2, NULL, 0, 0, 1, '2018-04-05 19:40:26', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(88, 1, 2, NULL, 0, 'Earum pariatur sed sit ut.', 'earum-pariatur-sed-sit-ut', 'Ea voluptatibus blanditiis sint modi praesentium non ipsa ducimus. Laborum quo ut eligendi ratione. Odio aut sunt delectus quisquam quia error.', 'Non adipisci sequi et reiciendis molestiae est vero. Tempora placeat similique vel suscipit. Nihil eius eveniet dolorem sit dolores.\n\nEveniet est voluptatem minima non ab. Voluptate voluptas qui odit autem. Eos saepe eos et doloribus quam.\n\nEveniet quis iusto et rerum tempore nobis qui. Veritatis occaecati qui eos doloribus et et distinctio. Nulla nulla distinctio consectetur aut qui facere magnam. Error officia deserunt assumenda omnis.', 'Magnam vitae maiores adipisci. Vel dolorem sed nihil reiciendis et ex. Nobis ipsum atque voluptates iusto labore et veniam. Magnam cumque ipsam hic veritatis occaecati dignissimos rerum.\n\nUnde ab inventore et voluptas non quam. Ea ea cum iusto voluptatem omnis quam. Provident in aut corporis ut est sapiente.\n\nTempora est atque dicta minus molestiae nemo eius ipsum. Repellendus provident quae aut ipsum nihil error eum. Nisi repudiandae vel optio expedita tempore soluta. Ipsam alias quam eius est quidem.', 'cupiditate', 'images/watches/5.jpg', 279, 81, 0, 1, NULL, 0, 0, 1, '2018-04-11 23:17:50', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(89, 1, 2, NULL, 0, 'Aut asperiores unde labore minima.', 'aut-asperiores-unde-labore-minima', 'Itaque autem velit laborum. In voluptatem odit vitae rem tempore in iusto. Natus non et dolor qui aut sit. Quibusdam ipsam architecto id pariatur ea dolorum aliquid.', 'Velit aliquam quo sint facere natus blanditiis. Velit autem mollitia asperiores veritatis sit aut. Fugiat dolore quibusdam modi est fugiat voluptas reprehenderit.\n\nSunt id quod numquam sed iure et. Culpa et explicabo rerum voluptas ut id doloribus. Voluptatem amet aut aut qui voluptate voluptatem. Voluptatem magnam fugiat ut.\n\nDolores suscipit alias rerum nihil aliquid autem. Blanditiis eos explicabo quia cumque. Cum quasi enim repudiandae temporibus amet dignissimos.', 'Optio qui possimus accusamus voluptas reiciendis ut est. Sequi illum dolore molestias consequuntur. A earum quos aut enim ab hic nesciunt. Perspiciatis aut veniam odit aliquam.\n\nRatione sit quam et temporibus excepturi pariatur. Possimus ea cupiditate eos a quae tempore iste. Velit esse molestiae voluptatem ut reiciendis sequi.\n\nSed est reprehenderit quia qui et libero explicabo qui. Omnis nemo ea veniam illum et. Nam laborum enim repellendus iure. Ut quaerat sint id.', 'delectus', 'images/watches/5.jpg', 159, 131, 0, 3, NULL, 0, 0, 1, '2018-04-06 10:37:54', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(90, 1, 2, NULL, 0, 'Tenetur ut et illo.', 'tenetur-ut-et-illo', 'Id vero voluptatem sit ut ut vero nostrum. Quae ipsum est aperiam sed laudantium. Accusamus illo eum dignissimos inventore possimus et sed. Et dicta est voluptatum omnis omnis.', 'Dolores et quis unde eos expedita sit. Vero delectus aut facere fugiat enim consectetur. Unde debitis optio qui inventore. Consectetur consequatur totam rem velit.\n\nQuam ut est illum beatae magni accusamus dolores quos. Et iste fugit similique deleniti. Accusamus veniam excepturi et quia est aut reprehenderit. Sint eius itaque voluptatem eveniet sed alias est. Ut voluptas non vel omnis et ut.\n\nQuia aliquam in laudantium ab. Et omnis praesentium qui nam ipsa. Amet sequi et ea a.', 'Quam vel facilis occaecati nostrum. Eum soluta dignissimos fugiat sapiente ut. A quisquam non in sunt. Provident fuga molestias qui quaerat.\n\nProvident nemo omnis id non est. Aspernatur non nihil tenetur et quia. Et corrupti non et iusto sunt.\n\nAutem repellat dolore cum. Eveniet dolor natus non sequi soluta delectus repudiandae. Qui ipsam id vero ex aliquam et. Quo officia velit dolor molestiae mollitia rem sapiente.', 'dolor', 'images/watches/5.jpg', 239, 86, 0, 2, NULL, 0, 0, 1, '2018-04-08 03:54:05', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(91, 1, 2, NULL, 0, 'Fuga eum ut iusto quam voluptatum dicta.', 'fuga-eum-ut-iusto-quam-voluptatum-dicta', 'Quia provident accusantium soluta. Eius magnam magni officiis sed. Laborum quam similique culpa quia tempora nihil pariatur.', 'Illum sunt eos ipsam praesentium voluptatibus. Natus quis eum quia saepe non. Beatae sint vitae quidem ut. Ex velit illum vel quod quos.\n\nEt ratione ipsum ducimus et. Est commodi aut qui velit dolore et veniam eaque. Tempora vero placeat consequatur quod dolores doloremque.\n\nSed eos culpa repellat voluptas voluptas necessitatibus. Explicabo rerum ex atque quia. Voluptatem aperiam eum sunt occaecati et non error. Consequatur ut et sed natus et.', 'Aut est consequuntur velit ipsa. Nemo optio aspernatur asperiores sapiente porro. Provident quibusdam error sed cumque reiciendis nihil.\n\nQuis sequi accusantium exercitationem et nobis dolore vero. Nostrum maiores quo atque laboriosam. Voluptatibus incidunt et ratione incidunt soluta et atque. Fugit sed commodi quasi.\n\nIllo animi sint et ea. Suscipit est fuga nemo modi. Est expedita sed necessitatibus facere repudiandae rerum iste. Quibusdam earum necessitatibus quos voluptatem odio aut qui ut.', 'saepe', 'images/watches/5.jpg', 234, 150, 0, 2, NULL, 0, 0, 1, '2018-03-27 17:58:36', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(92, 1, 2, NULL, 0, 'Et dolor eligendi quia eaque hic vitae est.', 'et-dolor-eligendi-quia-eaque-hic-vitae-est', 'Ut debitis sit voluptatem. Magnam soluta beatae qui. Maiores sint cumque assumenda. Et iusto pariatur optio asperiores corporis porro est et. Repellendus ex eos ut pariatur quis voluptatem.', 'Consequuntur ut reiciendis quae ratione. Animi cupiditate autem rerum placeat labore a veritatis. Voluptatem corporis expedita dolore reiciendis enim nostrum neque natus.\n\nMollitia voluptatem nesciunt et et impedit reprehenderit nisi cumque. Exercitationem ut inventore explicabo et velit quis. Aut qui necessitatibus quaerat dolorem. Dolorem et nemo quibusdam explicabo porro repudiandae hic quidem.\n\nEsse assumenda ut ipsam perferendis. Molestias laborum ullam minus et. Aspernatur voluptates nihil aliquam dolore voluptas perferendis. Quia aut ducimus id qui aut earum quos.', 'Voluptas fugit ut qui aut. Temporibus rem ea est eius.\n\nDolor nihil qui nihil ipsa voluptatibus fugiat eaque. Sed itaque eligendi delectus corporis ut tempora officiis aut. Sint consequatur facilis nam beatae. Velit quae incidunt non et nobis.\n\nConsectetur harum sapiente cum. Quia quia et dicta. Iusto aliquid praesentium nulla eligendi rem in. Nostrum nihil aspernatur et facere.', 'numquam', 'images/watches/5.jpg', 222, 145, 0, 3, NULL, 0, 0, 1, '2018-04-22 11:32:35', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(93, 1, 2, NULL, 0, 'Tenetur sunt illo accusantium officiis in eius quo doloribus.', 'tenetur-sunt-illo-accusantium-officiis-in-eius-quo-doloribus', 'Reprehenderit ipsum voluptatem facere ut voluptatem. Dolore repellendus quo modi natus veritatis saepe rerum. Optio qui est veritatis deleniti accusamus dolore.', 'Dolores aut amet aut vitae et sunt sit voluptate. Vel nihil asperiores sequi eos aspernatur inventore assumenda.\n\nSint illo est suscipit eum non. Voluptatum aut aspernatur cupiditate saepe consequuntur.\n\nFacere natus temporibus minus necessitatibus at. Ex odit aut consectetur aut quia aperiam. Autem optio dicta et. Temporibus vel ut doloribus ipsam qui voluptas voluptatem aperiam.', 'Ullam quisquam magni error. Sint nisi mollitia adipisci molestiae et voluptatibus laudantium.\n\nMinus soluta molestiae numquam asperiores dolorum. Explicabo iste quaerat facere quae dolor dolor. Cum aut beatae eveniet natus quis vel sit. Assumenda ut nemo sunt voluptatibus sequi recusandae tempore.\n\nOfficia vel deleniti et esse officiis. Possimus asperiores non possimus perferendis quos. Laborum in laborum dolor nostrum.', 'sit', 'images/watches/5.jpg', 212, 115, 0, 2, NULL, 0, 0, 1, '2018-04-17 05:59:38', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(94, 1, 2, NULL, 0, 'Quis sint est cupiditate voluptatibus rerum ipsa ipsa et.', 'quis-sint-est-cupiditate-voluptatibus-rerum-ipsa-ipsa-et', 'Molestias velit nobis et aperiam nihil non iure. Animi voluptatem est sint minus. Illo ut quis alias et.', 'Architecto impedit aut libero nemo qui necessitatibus inventore cum. Illo eum est repellendus saepe sit.\n\nHarum aliquid voluptatem placeat qui eos. Consequatur vitae quod libero illo aut. Odit voluptatem dolor accusantium aspernatur voluptas quis veritatis. Quaerat minus dolore reiciendis expedita impedit. Odio quod vel nihil dolorum blanditiis aut.\n\nLaudantium illo maxime enim et. Nam aliquid officiis placeat. Ipsum natus qui natus autem.', 'Voluptatem ipsam ad in est numquam cumque voluptatem deserunt. Soluta unde temporibus ea autem et quod. Expedita rerum ut reiciendis quo magni.\n\nMinus accusantium similique nisi. Quo excepturi corrupti aperiam magnam qui sunt in. In sed quisquam et enim. Doloribus eos veritatis et et eveniet nihil veritatis iusto.\n\nInventore eius aut corporis iusto aut. Inventore odio dolore consequatur hic sit. Qui vel aut voluptatum voluptatem odio mollitia.', 'occaecati', 'images/watches/5.jpg', 166, 140, 0, 2, NULL, 0, 0, 1, '2018-03-27 15:47:13', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(95, 1, 2, NULL, 0, 'Dolorem libero natus et voluptatem cupiditate tenetur tempore atque.', 'dolorem-libero-natus-et-voluptatem-cupiditate-tenetur-tempore-atque', 'Maiores nobis in dolor cupiditate. Quisquam ipsam delectus ex et sit mollitia provident. Aperiam ab quasi laboriosam impedit. Fugiat alias tempora vero quidem aliquam odit sed.', 'Ea neque voluptatem sit est amet et consectetur. Iure mollitia provident impedit ducimus. Eaque nulla deleniti ex sint perspiciatis voluptatem.\n\nVoluptas nihil enim explicabo adipisci. Quas perferendis aut molestiae commodi sint. Temporibus quas placeat molestiae sint.\n\nVelit molestiae aut dignissimos fuga. Ducimus inventore eum et adipisci officiis cum cum. Harum ea ratione nihil eos eaque.', 'Non ab id quos quia voluptatem. Iure ut consequatur dolore ea nesciunt. Quis dolorum et soluta eos autem. Magnam nam tenetur accusantium est dolore ad voluptatum.\n\nNon distinctio in ipsam doloribus illum. Temporibus architecto enim qui. Est qui enim ipsum molestias ipsam ab. Quisquam mollitia iure cum fugiat.\n\nVelit nobis veritatis numquam explicabo dolores. Dignissimos rem voluptatem iste. Est odio hic est ut aut fugiat voluptatem officiis.', 'et', 'images/watches/5.jpg', 294, 140, 0, 1, NULL, 0, 0, 1, '2018-04-17 16:43:50', '2018-04-25 13:46:09', '2018-04-25 13:46:09'),
(96, 1, 2, NULL, 0, 'Pariatur et in est fugiat rem earum repellat.', 'pariatur-et-in-est-fugiat-rem-earum-repellat', 'Quia neque voluptatem laudantium quia molestiae rerum explicabo. Sit consectetur tenetur dolorem amet assumenda ut itaque. Fugit doloribus vitae qui voluptate aut voluptatem voluptatem. Et consequatur odit blanditiis.', 'Et exercitationem repellat aperiam repudiandae laboriosam. Autem enim sint molestiae consequatur quo beatae autem enim. Cupiditate nulla magni et molestiae sapiente at.\n\nVel saepe nulla recusandae autem. Eum ut similique hic et. Qui dignissimos ducimus sit amet et sequi sed.\n\nMolestiae doloribus velit sunt. Voluptatem sint atque omnis doloribus. Ducimus voluptatibus dignissimos deleniti sit. Possimus itaque recusandae est architecto suscipit voluptates est voluptatem. Qui beatae enim tempora.', 'Id harum rerum modi ut necessitatibus expedita. Occaecati voluptas aut expedita recusandae sunt doloremque sit. Blanditiis aut dignissimos vitae porro laborum asperiores modi.\n\nNisi neque velit et et quibusdam. Quis vel consequatur non numquam. Minus tempore itaque quaerat quibusdam eos aut molestiae. Voluptatibus rerum voluptatum ipsum.\n\nNon error pariatur enim facilis minus qui. Nemo exercitationem sint dolores qui ea quisquam. Odit est saepe beatae aspernatur velit illo magni.', 'similique', 'images/watches/5.jpg', 162, 84, 0, 1, NULL, 0, 0, 1, '2018-04-17 21:01:16', '2018-04-25 13:46:10', '2018-04-25 13:46:10'),
(97, 1, 2, NULL, 0, 'Culpa iste animi voluptatibus est inventore ullam corrupti.', 'culpa-iste-animi-voluptatibus-est-inventore-ullam-corrupti', 'Et non nihil voluptas. Soluta accusamus odio sunt. Voluptas nam rerum nulla ratione autem tempore ex.', 'Rerum aut voluptatibus quasi voluptatem atque. Consectetur et ut facilis id sapiente sit. Quia architecto sapiente temporibus.\n\nEt ipsa enim nihil minus corrupti et. Eos officiis ab animi necessitatibus. Eligendi architecto eveniet ut id nihil ea praesentium.\n\nUt dolor nihil beatae ullam alias mollitia illum. Dolorum non est dolore. Nihil qui quia incidunt et sit ducimus commodi. Maiores incidunt sint tempore labore.', 'Consequuntur in aliquid soluta ad et. Illo voluptatem ea enim iusto in atque in. Laudantium dicta rerum maxime dignissimos voluptatem cumque exercitationem.\n\nRerum distinctio id omnis. Aut et in aut dolore. Nihil ratione et commodi. Voluptatum reiciendis assumenda omnis illum rerum exercitationem.\n\nQui et vero expedita nostrum rerum enim voluptatem. Rerum sit atque est facere. In corrupti autem iste et sunt facilis. Eos facere dolor reiciendis consequatur. Ea enim placeat illum.', 'temporibus', 'images/watches/5.jpg', 206, 130, 0, 2, NULL, 0, 0, 1, '2018-04-11 15:36:47', '2018-04-25 13:46:10', '2018-04-25 13:46:10'),
(98, 1, 2, NULL, 0, 'Tempore omnis nihil laboriosam eligendi incidunt facilis.', 'tempore-omnis-nihil-laboriosam-eligendi-incidunt-facilis', 'Fugiat nam soluta libero autem qui. Autem nemo quos ipsa tenetur. Consequatur aperiam autem rerum adipisci aperiam.', 'Natus quidem et incidunt. Impedit quas molestias beatae corporis omnis. Molestiae qui at accusamus sit laborum.\n\nFacilis numquam et velit eos similique corrupti magnam. Maiores expedita voluptatem atque dolorem illo.\n\nNeque rerum amet veritatis et omnis id est sed. Alias voluptatem ipsam animi perferendis ipsam sint. Voluptatem et modi et architecto dolorem quaerat sint. Ut aliquam maxime fugiat rerum consequuntur dolorem sit expedita.', 'Est asperiores magni et et natus aut optio. Odio corporis eos ducimus et deleniti facere dolorem. Expedita temporibus similique expedita est dolor rerum veritatis.\n\nEt illo quas unde enim neque impedit. Ea voluptatibus vero ratione odio. Eos adipisci sapiente ut deserunt aut. Pariatur sunt facere optio sint natus voluptatibus dolorem.\n\nEt in quod in quasi modi. Magni quo et qui consequuntur ea quo. Qui non distinctio voluptatem eos velit.', 'itaque', 'images/watches/5.jpg', 180, 131, 0, 1, NULL, 0, 0, 1, '2018-04-24 14:13:25', '2018-04-25 13:46:10', '2018-04-25 13:46:10'),
(99, 1, 2, NULL, 0, 'Sint est error explicabo impedit.', 'sint-est-error-explicabo-impedit', 'Nulla ut eaque et voluptatem voluptates est. Necessitatibus aliquid molestias id. Sit quia nisi quis labore exercitationem eveniet ea. Delectus ut vel occaecati consectetur sint aliquid.', 'Iure debitis ipsa quia reprehenderit vitae fugit ipsum voluptatem. Culpa eaque ut quos quaerat qui voluptatem. Officiis alias eveniet deleniti harum facere provident. Perspiciatis quisquam nisi est.\n\nEaque adipisci aut numquam placeat tenetur necessitatibus. Fuga minima ut saepe voluptas excepturi temporibus nostrum quam.\n\nUt quidem inventore odit distinctio corporis qui sit. Aliquam quod quis qui sit quia qui. Culpa eveniet deleniti aut qui.', 'Non natus explicabo ratione accusamus voluptas. Adipisci aut minima cumque id. Labore voluptates inventore qui temporibus a quo. Facilis eum aut sunt voluptate eos aut maxime.\n\nFugiat occaecati laboriosam fuga et aut. Id rerum sapiente quia iure facere. Aut voluptates modi enim perferendis laboriosam.\n\nNemo est aut distinctio rerum iste et. Blanditiis ullam voluptatem laborum praesentium. Qui eum eum eos doloremque dolorum dicta. Ut tempore et nostrum veritatis. Provident quia sit in minima.', 'earum', 'images/watches/5.jpg', 248, 91, 0, 2, NULL, 0, 0, 1, '2018-03-29 05:52:20', '2018-04-25 13:46:10', '2018-04-25 13:46:10'),
(100, 1, 2, NULL, 0, 'Neque harum voluptatem assumenda.', 'neque-harum-voluptatem-assumenda', 'Alias non quasi deserunt. Eos minus exercitationem commodi doloremque perferendis. In debitis consectetur modi ipsa quia sapiente praesentium.', 'Et iste voluptatem labore numquam in illo. Quasi reprehenderit soluta provident mollitia est ab. Aliquam ad sequi voluptas atque maxime fuga.\n\nFacilis eaque suscipit incidunt alias esse. Ut voluptatem perferendis culpa accusantium repellat aut dolores. Vero facere et et et vel qui id. Unde consequatur et nam.\n\nVel et itaque qui laboriosam est nulla et. Et placeat laboriosam quo quia at dolorem iusto. Consequatur accusantium quos inventore nesciunt eos. Blanditiis recusandae ut quos consequatur dolor similique et. Voluptas nulla eaque id dolorem consectetur et rerum dolore.', 'Et ducimus omnis occaecati quaerat non quaerat. Ut neque illo et dicta debitis odit occaecati reprehenderit. Est sit eos nostrum rerum quis tempora rerum. Repellendus dolor magnam unde.\n\nUt facilis voluptas autem. Tempora accusantium qui maxime reiciendis error architecto. Facilis accusamus sint non numquam veritatis sed iste voluptatem. Ut ipsam impedit dolores omnis sed repudiandae.\n\nMolestiae eaque molestiae voluptatibus rerum. Vero quasi quis aut sint beatae tempore. Dignissimos soluta molestiae autem dignissimos quia.', 'et', 'images/watches/5.jpg', 132, 123, 0, 2, NULL, 0, 0, 1, '2018-03-27 12:44:39', '2018-04-25 13:46:10', '2018-04-25 13:46:10'),
(101, 1, 3, NULL, 0, 'Dolor rerum aut omnis a est.', 'dolor-rerum-aut-omnis-a-est', 'Sit exercitationem est velit magni sunt fuga qui. Officia odio excepturi consequatur cupiditate ducimus. Quis dolores sequi qui omnis corrupti. Eligendi iure rerum ipsam illum ut aut molestias.', 'Quisquam cupiditate dicta nam nesciunt facere harum quam. Et et ipsam unde et.\n\nAut aut totam veniam. Blanditiis alias consequatur nesciunt qui numquam. Repudiandae earum non soluta earum quidem pariatur. Sit repudiandae voluptatum tenetur.\n\nAut tempore sequi velit id nostrum unde quas. Sit inventore quis magni aut velit est. Itaque est eos nihil quasi. Id mollitia eaque distinctio cupiditate sint.', 'Odio officia veritatis voluptas tempora. Tempora officia itaque vel ullam eum facere facilis nulla. Quis minus non blanditiis nihil voluptatem officia. Velit vitae quisquam nihil molestiae porro sint.\n\nQuisquam fugit quia maxime velit atque nobis. Omnis maiores occaecati impedit et. Harum officia libero optio ab ducimus voluptatibus.\n\nTotam id iure consectetur ratione dolores rerum soluta. Soluta deserunt accusamus ipsam eveniet et sequi occaecati non. Dicta ea at veritatis mollitia distinctio et sit.', 'dolorem', 'images/furniture/1.jpg', 284, 83, 0, 3, NULL, 0, 0, 1, '2018-04-01 07:57:26', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(102, 1, 3, NULL, 0, 'Magnam ab est harum voluptatem.', 'magnam-ab-est-harum-voluptatem', 'Qui eius velit molestias rerum totam quia ratione vel. Distinctio porro praesentium vitae officia. Amet assumenda porro unde non fugit odio quaerat eum. Ut eum alias dicta fugit.', 'Qui fuga consequuntur velit modi inventore ullam sed. Non ut sed sunt veritatis natus molestias. Ut officiis accusamus repellat at. Velit dolorem voluptatem velit aliquid illum velit enim.\n\nIpsam porro nesciunt impedit sed fuga et. Voluptatem et debitis possimus atque suscipit natus id. Mollitia atque qui dicta rerum inventore maiores.\n\nEt distinctio rerum nisi. Facere pariatur est sed eveniet asperiores quis. Suscipit laboriosam dolores labore et possimus facilis. Et qui vitae qui magnam voluptatem animi ut quam.', 'Officia quia omnis totam maiores dolor voluptas. Non alias et qui et fugiat. Sunt illo ea at eveniet quod voluptatem a quidem.\n\nNihil inventore soluta inventore eveniet. In qui eius ut id assumenda accusamus. Omnis incidunt non alias aut nulla et ut.\n\nHic modi ut non modi. Labore aperiam qui labore porro. Natus rerum id error. Animi voluptatem fugiat est sint libero ea.', 'vel', 'images/furniture/1.jpg', 285, 80, 0, 3, NULL, 0, 0, 1, '2018-04-19 02:16:17', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(103, 1, 3, NULL, 0, 'Perferendis qui aut placeat doloribus quia repudiandae.', 'perferendis-qui-aut-placeat-doloribus-quia-repudiandae', 'Qui ea est harum minus officiis tenetur debitis dolorem. Blanditiis perspiciatis et possimus. Quo qui pariatur exercitationem quod id.', 'Aperiam facilis inventore commodi animi quo mollitia. Est et aperiam ad ab. Eum consequatur eligendi cumque quia qui qui corrupti. Nam praesentium tempora earum asperiores facere a.\n\nTenetur explicabo facere voluptates corporis provident voluptas recusandae impedit. Autem unde qui ut blanditiis non officia. Laudantium sit quod sit autem accusantium harum. Voluptatem et suscipit quis dolore et.\n\nQuo deleniti et et error saepe. Omnis aut ducimus voluptate dolor nobis consequuntur. Exercitationem quia et qui molestiae et dolor eos et.', 'Est repellat hic rerum. Alias repudiandae eum omnis soluta. Inventore alias dolores tenetur possimus ut omnis non iure.\n\nExcepturi minima inventore et molestiae. Ut omnis numquam numquam sit non praesentium labore. Quis id eos quis nulla culpa aut molestias.\n\nMolestiae corporis a optio voluptatum id distinctio fugit. Perspiciatis earum ut atque aliquam cupiditate rerum. Unde officiis quia vitae voluptatum qui velit esse. Nihil omnis dolores suscipit.', 'unde', 'images/furniture/1.jpg', 216, 121, 0, 3, NULL, 0, 0, 1, '2018-04-19 09:58:55', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(104, 1, 3, NULL, 0, 'Reprehenderit quasi cum a sunt quaerat voluptate.', 'reprehenderit-quasi-cum-a-sunt-quaerat-voluptate', 'Quod quasi libero nesciunt qui fuga voluptatem eum. Modi numquam illum laborum eveniet architecto in rerum. Cum officia ex earum est.', 'Voluptatibus dolor nisi iure voluptatem recusandae. Aspernatur quod eaque nulla libero esse. Aut itaque et ipsa.\n\nLaborum ut provident aut est. Eveniet id aperiam consectetur qui. Reprehenderit autem minus eos impedit.\n\nIpsum sunt officiis doloribus ipsam iste voluptas. Voluptates architecto consequuntur et quo et. Libero voluptas voluptatum recusandae explicabo repellat.', 'Et veritatis dolores omnis fugit voluptate. Et labore tempora deserunt nihil. Minima deserunt accusantium officia. Et voluptatem saepe omnis non provident consequatur quia.\n\nVoluptatem id et numquam vitae vel tenetur. Corporis magni aliquam dolorem. Aliquid quas in quos ut sit. Architecto enim id nostrum aut aperiam vel.\n\nQuia possimus cupiditate qui dolores id. Dignissimos laborum rem adipisci quia odit tempora at est. Dolores sint enim inventore velit.', 'repudiandae', 'images/furniture/1.jpg', 280, 92, 0, 3, NULL, 0, 0, 1, '2018-04-14 15:51:49', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(105, 1, 3, NULL, 0, 'Aut nam harum quaerat aliquid fugit.', 'aut-nam-harum-quaerat-aliquid-fugit', 'Quis rerum architecto porro et. Ratione in veritatis culpa repudiandae repudiandae nobis quis impedit. Tenetur error ut vel est. Adipisci enim et ut et consequatur.', 'Dolor aut nemo quia dignissimos ipsam ducimus. Odit commodi suscipit deserunt dolores vero est nobis. Itaque quis odio consequatur voluptatem ullam numquam quos. Non odit labore qui omnis accusantium dicta.\n\nUt dicta maxime omnis dolores rerum. Et quasi et error labore et voluptatem iste. Ea illum eos nobis illum. Voluptatum mollitia id quae quam dolor enim ipsam.\n\nSuscipit tempora placeat necessitatibus corporis voluptatem excepturi quis. Corrupti voluptatibus impedit et tempora. Aut pariatur aut totam blanditiis hic debitis quis quia. Dolor reiciendis maiores unde quia blanditiis.', 'Sunt fuga laboriosam assumenda aut voluptate esse. Ullam voluptas exercitationem voluptas est ipsam rerum quod. Facilis iure hic adipisci voluptatem aut minus. Ducimus vel sit minus reprehenderit et dolor aut dolorem.\n\nEa facere voluptatum et libero occaecati. Voluptates tempore maxime rerum sit et. Et dolore velit nostrum et voluptates sint est. Doloribus ea nemo suscipit saepe doloribus.\n\nNon porro rerum laborum natus. Vitae numquam et ut nulla assumenda. Est accusamus aut doloremque sint fugiat dolore nisi. Et blanditiis porro repellendus et nemo ratione quisquam.', 'ut', 'images/furniture/1.jpg', 270, 110, 0, 3, NULL, 0, 0, 1, '2018-04-22 22:39:54', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(106, 1, 3, NULL, 0, 'Quae beatae voluptatum dolorum necessitatibus animi consequatur.', 'quae-beatae-voluptatum-dolorum-necessitatibus-animi-consequatur', 'Provident numquam occaecati corporis corporis quasi mollitia. Minima dolorum et in facilis ad similique. Quia tempora eaque et est quam deleniti rerum. Repellendus eveniet repudiandae asperiores et.', 'Recusandae sequi dolorem omnis nam. Eos molestiae omnis sunt commodi harum laudantium. Omnis facilis consequuntur soluta expedita delectus dolorem. Qui aut alias non quo.\n\nDolores facilis repellat ducimus vero. Cumque quod ducimus et numquam facilis quisquam facilis non. Et nihil consequuntur et et. Voluptas sit consectetur molestiae et a quasi reprehenderit.\n\nCorporis velit praesentium vel iste dolorem ab cum. Ut fugit voluptatibus accusantium quis labore aut blanditiis quo. Quam reiciendis animi est dolores reprehenderit est qui. Molestiae qui minus amet occaecati sed fugiat.', 'Eaque a non sed qui qui officia sed. Aut aspernatur minima possimus tempore blanditiis dolor. Accusantium est sit maiores illo beatae.\n\nSunt ipsam dolorem reiciendis et consectetur qui. Quas et non aliquid numquam omnis eum. Et tenetur ut natus hic.\n\nHarum dignissimos distinctio officiis. Provident dolorem neque sed laboriosam nam. Culpa et omnis incidunt molestiae nulla velit. Debitis quo mollitia iusto molestiae et et aliquam qui.', 'saepe', 'images/furniture/1.jpg', 191, 127, 0, 1, NULL, 0, 0, 1, '2018-04-16 18:13:22', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(107, 1, 3, NULL, 0, 'Accusamus omnis aut repellat sunt eum commodi sequi.', 'accusamus-omnis-aut-repellat-sunt-eum-commodi-sequi', 'Aut eum nostrum modi enim quaerat molestiae culpa. Optio et inventore accusamus exercitationem. Dolor consequatur est nemo et.', 'Voluptatibus voluptas veritatis commodi esse. Sunt qui porro maiores eius aut labore tempore. Minus neque qui eum aut in dicta ea. Perspiciatis repellendus odit neque consequatur. In velit quia facilis corrupti rerum libero id omnis.\n\nEligendi nostrum et odit voluptatem minima praesentium. Aut recusandae blanditiis voluptas at dolor nulla. Aut eveniet commodi eum sit vel nam ipsa.\n\nQui suscipit quis ullam quia consequatur qui placeat. Consequatur animi sit sit ut fuga voluptatum. Nihil corrupti omnis dolores autem molestiae odit et.', 'Et et et provident quas aut. Culpa similique et repellendus cumque. Ut voluptas eaque beatae velit quaerat necessitatibus nostrum.\n\nQuaerat animi quia voluptas. Explicabo ipsam officiis ut aperiam quam ab temporibus.\n\nEst quia hic aperiam asperiores. Deserunt eos numquam et nam quaerat. Ut nihil repudiandae alias dolorum.', 'recusandae', 'images/furniture/1.jpg', 236, 116, 0, 1, NULL, 0, 0, 1, '2018-04-11 07:36:34', '2018-04-25 13:46:19', '2018-04-25 13:46:19');
INSERT INTO `products` (`id`, `user_id`, `brand_id`, `collection_id`, `set_id`, `title`, `slug`, `short`, `body`, `body2`, `code`, `image`, `price`, `price_outlet`, `views`, `amount`, `color`, `discount`, `sold`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(108, 1, 3, NULL, 0, 'Earum culpa possimus illo impedit iure animi ipsam.', 'earum-culpa-possimus-illo-impedit-iure-animi-ipsam', 'Nihil doloribus a esse ipsam et veritatis. Dolores ea facilis voluptate accusamus et exercitationem. Illo aperiam quidem et distinctio odio.', 'Ullam incidunt ad ad accusantium et voluptates est. Quis et sed odit omnis repellendus soluta nemo. Et qui adipisci molestiae aut. Ullam et aut qui ut qui.\n\nFugiat ea veniam nemo dicta id hic iusto porro. Recusandae quia quisquam occaecati nisi repudiandae sit. Quo voluptatem laboriosam sequi blanditiis quis.\n\nUt maxime nam est corporis voluptatem eum unde. Recusandae voluptatem deleniti tempora at harum.', 'Totam sit iure iure vel dolore vitae itaque. Possimus et et nostrum ex molestiae. Aut et aut id eos quo recusandae est facere. Nisi ducimus labore ut consequatur.\n\nRepudiandae quo maiores quae ullam. Aliquam maxime voluptatem adipisci quaerat. Et harum autem quidem repellendus. Consequatur officiis corrupti laborum nesciunt consequuntur enim cum omnis. Consectetur labore qui autem rerum perspiciatis suscipit.\n\nEst non dolorem est. Non et nesciunt quisquam est optio dolores. Qui et quia non omnis debitis et id.', 'doloribus', 'images/furniture/1.jpg', 271, 107, 0, 1, NULL, 0, 0, 1, '2018-04-08 23:10:23', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(109, 1, 3, NULL, 0, 'Eos aperiam omnis atque.', 'eos-aperiam-omnis-atque', 'Enim inventore quas nesciunt nesciunt quod vel. Beatae qui illo magnam quisquam qui adipisci. Dolore neque eius non et vel temporibus vitae numquam.', 'Aut tempora quia molestiae animi qui inventore ea fugiat. Autem vitae qui totam rerum aut minima quo.\n\nExpedita quam aliquid est minima. Temporibus a veniam ullam iure voluptas voluptatibus omnis. Quas qui molestias ducimus ad quos.\n\nDucimus eaque pariatur necessitatibus. Fugit dolor quis eos ad error. Tenetur incidunt necessitatibus delectus ducimus voluptas cum voluptatem. Qui sint reiciendis animi omnis enim.', 'Earum ullam nisi quo harum vel. Assumenda et earum non animi eveniet et. Ad non odit error necessitatibus pariatur ullam. Sint dolore accusamus asperiores natus sit vel.\n\nDolorem corporis voluptatibus voluptatem. Maxime quo reprehenderit quia nesciunt explicabo veritatis quisquam. Dolores ut at et velit veniam quia. Sed consequatur ut saepe esse dolor repudiandae.\n\nSuscipit in ut qui occaecati libero ipsum est. Reprehenderit ipsum perferendis voluptate ut. Iure ut praesentium fugiat suscipit in ratione asperiores.', 'non', 'images/furniture/1.jpg', 281, 130, 0, 2, NULL, 0, 0, 1, '2018-04-17 15:10:28', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(110, 1, 3, NULL, 0, 'Omnis dolores qui quisquam quibusdam rem consequatur quae qui.', 'omnis-dolores-qui-quisquam-quibusdam-rem-consequatur-quae-qui', 'Velit dignissimos totam dolor repellendus aliquam. Dolor aut sit facilis reiciendis sit rerum illum.', 'Veniam voluptatem numquam nostrum labore in ut enim molestiae. Velit explicabo totam non eos et consequuntur aut ad. Et voluptas aperiam sint dolores sapiente.\n\nQui labore iusto sit voluptas. Nobis tempore laudantium tempore fugiat asperiores doloremque id eos. Eos deleniti aut amet consequuntur cupiditate facere.\n\nIpsam saepe eius mollitia porro. Exercitationem est nam ut occaecati incidunt doloremque. Sequi aliquid sapiente dolorem a totam soluta nam. Doloremque occaecati ipsa eum dolor repudiandae voluptatibus.', 'Fuga rerum voluptatem et autem. Possimus nobis iure autem asperiores est voluptatem velit ea. Officia accusamus eum officia sequi vero quis. Aut aut harum consectetur maiores impedit commodi.\n\nUt molestiae corrupti eum recusandae sed qui qui. Laboriosam est quis doloribus dolorem quidem distinctio non. Exercitationem modi natus recusandae fugit impedit architecto provident quo. Itaque dolores asperiores commodi voluptatem est in.\n\nQuis totam voluptatem in tenetur nihil quasi. Tempora magnam unde maiores eius ut nemo et. Maxime reprehenderit iusto cum et. Tenetur qui libero corporis provident occaecati.', 'voluptatem', 'images/furniture/1.jpg', 133, 142, 0, 3, NULL, 0, 0, 1, '2018-04-02 03:03:08', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(111, 1, 3, NULL, 0, 'Quaerat quae non nostrum aliquid.', 'quaerat-quae-non-nostrum-aliquid', 'Assumenda ratione omnis accusantium magnam. Voluptas sed corrupti excepturi ipsum assumenda voluptatum.', 'Veritatis hic perferendis quidem. Mollitia doloremque excepturi ea nihil recusandae. Nam et inventore non.\n\nEt quas dolor quo autem. Et repellat non aut enim consectetur quaerat fugiat. Quis error voluptatem repellendus autem quidem maiores quia. Vel magnam sunt optio praesentium voluptatem.\n\nNon earum pariatur minima est. Explicabo quia dolore sit.', 'Et qui dolor ut dignissimos enim. Praesentium aut molestias quia repellendus quos. Officia eveniet architecto tempore voluptatem ut voluptatibus sed. Vel quae ducimus alias rerum aliquid officiis.\n\nReprehenderit dolorem aliquid voluptatem aut provident facilis in pariatur. Dicta omnis ipsa est amet harum doloribus enim facilis. Esse qui dolor soluta perspiciatis.\n\nQuia ipsa vel harum sapiente magni perferendis suscipit. Nobis voluptatem dolor vitae et voluptatem impedit placeat fugit. Mollitia qui voluptatem qui sed numquam molestias.', 'id', 'images/furniture/1.jpg', 119, 109, 0, 1, NULL, 0, 0, 1, '2018-04-15 04:41:56', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(112, 1, 3, NULL, 0, 'Est autem provident molestiae ratione.', 'est-autem-provident-molestiae-ratione', 'Aperiam nostrum dolores impedit ut nemo. Quo sed laboriosam quidem minus. Incidunt qui architecto dicta quos cumque sit. Enim tempore sed facilis dolores minus hic quam.', 'Maiores labore et asperiores ipsa. Maiores iusto deleniti corrupti. Tempore molestiae voluptatem soluta harum. Ratione earum maiores velit voluptas adipisci.\n\nSaepe libero quisquam ea ut ipsa perferendis hic sit. Autem aperiam molestiae nostrum omnis impedit ea cumque. Dolores cupiditate odio porro sit aut error.\n\nRem autem non aliquid fuga sequi nihil iste soluta. Itaque sapiente nesciunt dolorem totam cupiditate vero. Dolorem voluptas qui aut. Debitis adipisci vel tempora vel voluptatem.', 'Veritatis ad qui odio qui fugit ea. Nam similique excepturi sunt eum. Quibusdam consequatur unde quisquam repellendus enim. Aut dolorem illo et amet. In necessitatibus illum et provident deserunt in.\n\nAmet non odio excepturi voluptatem consequatur assumenda qui. Quam repellat vel sunt in veritatis. Qui mollitia repellendus quis id a labore officia.\n\nDolorum expedita et omnis officiis officiis minima. Ducimus magni sit molestias asperiores dolorem. Quod similique cumque sed odit eius et quo qui. Officiis perferendis et non enim perspiciatis eveniet.', 'tempore', 'images/furniture/1.jpg', 145, 87, 0, 2, NULL, 0, 0, 1, '2018-04-07 02:36:26', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(113, 1, 3, NULL, 0, 'Possimus illo quisquam expedita.', 'possimus-illo-quisquam-expedita', 'Facere odit ullam fugiat ab sint placeat. Corporis hic quos voluptatem est in sapiente.', 'Sit et aliquid aliquid quidem neque. Sit quam numquam sed qui sed maxime ut. Aut rerum rem aliquam ullam ex ullam consequuntur iusto. Qui asperiores ad quis saepe.\n\nNobis temporibus suscipit et voluptatem sapiente sed cumque. Eius culpa fuga nulla sequi officia et. Neque maxime non ut delectus qui.\n\nQuis adipisci deserunt molestias iure rerum ea. Molestiae maxime est sequi quasi vel. Non sed vel quae molestias corrupti.', 'In accusamus soluta aut deleniti ipsam ut voluptates. Illum ut id impedit enim quos. Aliquid nihil ea odio ut.\n\nQui temporibus et neque eveniet. Expedita possimus sed cumque laborum. Laborum et et quam. Voluptas enim porro quia.\n\nAspernatur ut recusandae voluptate. Eos numquam molestiae vel aut doloremque in. Et veritatis qui qui quibusdam. Molestiae debitis voluptatem sed aliquam eos sit velit.', 'nostrum', 'images/furniture/1.jpg', 204, 105, 0, 2, NULL, 0, 0, 1, '2018-03-27 20:54:40', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(114, 1, 3, NULL, 0, 'Deleniti qui provident fugit repellat magnam et eveniet.', 'deleniti-qui-provident-fugit-repellat-magnam-et-eveniet', 'Temporibus sequi eos tenetur cum illo. Sit non nisi quia dicta magnam possimus quo culpa. Sint quia est sed facere magni itaque.', 'Corrupti culpa soluta assumenda commodi minus voluptatem. Et et omnis repellat nostrum officia. Enim unde nam voluptas autem et occaecati voluptates. Qui est dolorem ipsum qui laborum.\n\nVeniam nihil ipsa et necessitatibus numquam dolores ut. Dolore vero vel a voluptas odit alias. Omnis aliquid quia ab sunt aut et.\n\nConsequatur officia possimus quia consectetur a qui ipsum sed. Repellat officia enim architecto dolorem et tempore. Sunt earum nemo non. Ut omnis quia quia quo.', 'Ipsam minima omnis tenetur nulla doloribus dolores eligendi. Sint fugiat dolorem eaque sunt. Ea quo dolorum hic qui.\n\nQui laudantium excepturi et est est perferendis ea dolorem. Iusto qui corporis quae reprehenderit libero ea maiores.\n\nNam dolorem occaecati earum est consequatur non. Occaecati magnam molestias explicabo voluptas nulla. Eos ex perspiciatis aut odit tempora eos ab.', 'iste', 'images/furniture/1.jpg', 160, 95, 0, 2, NULL, 0, 0, 1, '2018-04-07 01:49:16', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(115, 1, 3, NULL, 0, 'Ut repudiandae asperiores est et in in.', 'ut-repudiandae-asperiores-est-et-in-in', 'Rerum hic quo quia voluptas est laudantium quas. Illum labore harum inventore et. Perferendis molestiae sint quod asperiores perferendis repudiandae. Temporibus quia neque alias consequatur ut beatae.', 'Quae facere ex consequatur laboriosam omnis eius soluta amet. Neque molestiae omnis mollitia quis magnam consequatur. Ut voluptatibus eaque perspiciatis a ex id. Dolorem qui omnis adipisci et distinctio.\n\nEnim ut consequatur mollitia illo labore. Culpa quam cumque soluta consectetur veritatis. Id officia maiores pariatur accusamus. Suscipit harum a ut doloremque voluptate illo.\n\nDoloremque et quibusdam animi dolor quaerat amet. Eum sint ut aliquid debitis eligendi. Fugiat impedit illo exercitationem facilis.', 'Nesciunt quis quis deserunt veritatis sint nulla sed. Aut nulla rem beatae nihil dolorum. Sit voluptates veniam tempore qui voluptas voluptatem doloremque nostrum.\n\nNecessitatibus molestiae molestiae quam accusantium earum. Et maiores aspernatur fuga. Quasi expedita praesentium doloremque.\n\nFugit deleniti eum totam ad. Deserunt reprehenderit dolorum est asperiores et dolor. Est veniam voluptatem amet et eveniet. Libero eos aut laboriosam fugit.', 'non', 'images/furniture/1.jpg', 145, 150, 0, 2, NULL, 0, 0, 1, '2018-04-15 14:45:07', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(116, 1, 3, NULL, 0, 'Voluptatem quis qui neque esse quis.', 'voluptatem-quis-qui-neque-esse-quis', 'Laborum et dolorum repellat maxime. Quis tempora ducimus vero facere.', 'Et aliquid molestias quibusdam et. Et omnis voluptas laboriosam modi consequatur aut. Enim quo eum laboriosam perspiciatis rerum ipsam aperiam.\n\nNobis rerum aut nisi vero minus explicabo nobis. Nisi beatae et totam ratione sint at unde voluptatum. Sed corporis sed consequatur tempore nostrum incidunt in.\n\nReprehenderit dolorum vel quo et alias rerum et. Quos expedita corporis qui consequatur atque recusandae minima. Numquam quia et impedit non dolores illum rerum.', 'Molestiae quae praesentium itaque incidunt rerum. Culpa sit officia suscipit ut. Sint quia magnam dolor ut sint deleniti quidem velit. Fugit et nobis minus recusandae.\n\nLaboriosam quibusdam dolores rem iusto ullam sed. Non temporibus natus cupiditate et deserunt. Nobis rerum doloremque voluptatem tenetur architecto tempora quo.\n\nIn ipsam sit fuga ut sint. Tenetur nisi fuga repudiandae dolorum. Numquam perspiciatis explicabo aliquid porro.', 'nostrum', 'images/furniture/1.jpg', 294, 95, 0, 2, NULL, 0, 0, 1, '2018-04-02 07:56:54', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(117, 1, 3, NULL, 0, 'Dolores magni tempore consequatur in ab quia quo.', 'dolores-magni-tempore-consequatur-in-ab-quia-quo', 'Doloribus numquam sequi provident culpa esse voluptatem culpa. Et labore quas ratione neque. Ut modi quia quaerat perferendis animi eaque.', 'Necessitatibus adipisci occaecati explicabo consequuntur. Enim illo et provident eligendi. Rerum molestiae dolorum dolor omnis.\n\nNihil numquam doloribus eum ut sint unde. Molestiae ipsam recusandae ab error labore ut in labore. Error vel modi voluptas labore unde eum. Consequatur ad aut quam voluptatem sint cupiditate ab.\n\nCumque ex delectus quas. Est minima modi non sunt hic asperiores recusandae libero. Eum et in rerum harum facilis corrupti qui.', 'Provident illum eligendi magnam vel maxime perferendis non nemo. Earum sequi at fugiat rerum ipsum et voluptas.\n\nEt consectetur voluptatibus nostrum magni. Omnis vel cum ipsa autem. Quae harum autem magni est dolorem.\n\nEius vel consequatur id error doloribus. Reiciendis quae culpa officiis voluptas quis accusamus. Minus ducimus autem voluptatem et amet.', 'repellendus', 'images/furniture/1.jpg', 123, 136, 0, 1, NULL, 0, 0, 1, '2018-04-21 20:11:02', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(118, 1, 3, NULL, 0, 'Voluptatem pariatur qui culpa esse.', 'voluptatem-pariatur-qui-culpa-esse', 'Et qui animi labore facere asperiores qui odio. Saepe ex minima voluptas nihil nulla provident est. A totam eum autem doloribus et sed. Dolores molestiae nam sed explicabo.', 'Beatae voluptatem sunt minima vitae consequatur voluptas similique maxime. Ea est aut vitae molestiae. Sequi enim ut et sit.\n\nAliquam non modi et corrupti labore. Dicta autem accusantium blanditiis expedita pariatur. Enim delectus et tempora qui voluptates debitis dolores.\n\nVoluptatem rerum fugiat vitae nam aliquam. Amet qui earum distinctio eligendi vero. Iure autem earum voluptas unde non iure. Quia et repellat voluptas vitae quisquam et qui.', 'Qui asperiores saepe voluptas. Ratione enim ut aut.\n\nCommodi voluptas sint et. Recusandae incidunt enim dolore at. Vel nulla modi voluptas enim. Accusantium magnam dicta nobis vel.\n\nEligendi sed aspernatur in necessitatibus provident. Ducimus eius quis et in aperiam aut. Aspernatur ea enim id.', 'molestiae', 'images/furniture/1.jpg', 141, 102, 0, 3, NULL, 0, 0, 1, '2018-04-24 08:06:38', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(119, 1, 3, NULL, 0, 'Quam quo sapiente magni molestiae minus.', 'quam-quo-sapiente-magni-molestiae-minus', 'Corrupti deleniti est cupiditate illo. Nobis magni impedit laudantium autem quo. Est in eum quos voluptate sit et et deserunt. Ea et id saepe debitis fugit et.', 'Occaecati delectus in incidunt et placeat ut. Et repellendus ut molestias. Laboriosam quae ducimus atque non sequi eos. Iure quis sunt et necessitatibus quibusdam expedita sint. Aut atque commodi reiciendis magnam quibusdam quia eligendi.\n\nQui quia exercitationem laborum. Pariatur ducimus eius occaecati iure error corporis unde. Et rerum quisquam dolor nemo non possimus. Minima alias iure sint perspiciatis consequatur. Sit velit nihil cupiditate est cupiditate.\n\nRecusandae quasi ea maiores nesciunt. Quam dolorum deleniti impedit. Dignissimos sit est consectetur. Quaerat nihil esse rem expedita et reprehenderit.', 'Vel iusto qui reiciendis. Harum et id impedit necessitatibus. Reiciendis molestiae ut laborum rem quae perferendis est.\n\nMollitia molestiae sed animi eaque quod. Libero architecto et sint sit maiores fugit necessitatibus ea. Maxime adipisci earum soluta illo sunt. Est molestiae et omnis consectetur. Possimus rem sed consectetur totam architecto inventore.\n\nAccusantium quis necessitatibus possimus praesentium voluptatibus eos. Vitae consequatur maiores temporibus dolorem incidunt. Explicabo maxime quo vel.', 'qui', 'images/furniture/1.jpg', 227, 94, 0, 1, NULL, 0, 0, 1, '2018-04-12 09:07:55', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(120, 1, 3, NULL, 0, 'Vel blanditiis tempora unde qui.', 'vel-blanditiis-tempora-unde-qui', 'Sit eaque quia ut eos nemo doloremque qui. Et repudiandae delectus voluptatum ab. Harum ducimus nulla modi. Deserunt rerum sunt eaque unde.', 'Fugiat commodi voluptatem laboriosam tempore. Beatae placeat tenetur magni minus et incidunt voluptatem.\n\nNulla cupiditate omnis enim nulla. Voluptatem tempore asperiores rerum dolores consequatur ad.\n\nMolestiae impedit rem doloribus sed. Itaque consequatur quia inventore tempore delectus reiciendis. Nisi sit recusandae est dolorum perspiciatis debitis mollitia facere. Quae voluptas possimus velit aut. Maxime eius maxime rerum excepturi aut accusantium culpa.', 'Dolorum aut voluptates et. Adipisci soluta nesciunt quis illum. Et iure cumque laborum rerum ut aut. Adipisci voluptatem dignissimos eveniet veritatis laborum.\n\nMinima et adipisci dolores nulla quibusdam incidunt. Odio occaecati minima vel aspernatur eaque alias.\n\nModi qui ut atque maxime vero ipsa aut. Quo sit fuga qui id. A facilis dolorum ab quas.', 'quis', 'images/furniture/1.jpg', 278, 99, 0, 2, NULL, 0, 0, 1, '2018-04-03 22:32:01', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(121, 1, 3, NULL, 0, 'Sit dignissimos quaerat dolores voluptatem voluptatum quas ut.', 'sit-dignissimos-quaerat-dolores-voluptatem-voluptatum-quas-ut', 'Porro quia reiciendis autem necessitatibus. Dicta distinctio labore nulla qui. Quisquam maxime officiis quam enim asperiores aut. Nulla eius deleniti omnis reprehenderit quidem et est.', 'Ex natus omnis quo et. Cum provident amet natus dolor ipsa aliquam hic animi. Est aut quasi aliquam aut qui similique unde.\n\nExcepturi praesentium possimus velit in dolores aut qui. Rerum tempore quia non earum quia mollitia. Natus itaque sunt qui eius quos modi.\n\nNihil at quo at blanditiis aut quisquam. Quaerat aut quaerat sit vitae commodi. Aliquam neque minima et.', 'Optio accusantium beatae ratione rerum assumenda. Reprehenderit officiis placeat voluptatibus quis. Eum et quo nostrum.\n\nCumque maxime dolores vero sapiente occaecati maxime. Et libero magni distinctio totam. Sit suscipit nam necessitatibus. Eos quo quisquam itaque omnis laudantium debitis et doloremque.\n\nFacere similique quae non quidem ratione adipisci. Nobis autem repudiandae omnis soluta.', 'temporibus', 'images/furniture/1.jpg', 105, 127, 0, 1, NULL, 0, 0, 1, '2018-03-27 00:02:27', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(122, 1, 3, NULL, 0, 'Fugit aut odio dolor molestiae vel.', 'fugit-aut-odio-dolor-molestiae-vel', 'Sit neque sit eligendi consequatur et laudantium aut. Et voluptatum id voluptas ad impedit. Necessitatibus eius nostrum soluta eos inventore ut accusamus.', 'Et commodi sed doloremque voluptatibus omnis dicta a dolor. Rerum ad illo vitae. Voluptas officia et omnis blanditiis omnis repudiandae. Velit deleniti ad et.\n\nA atque veniam qui consequuntur dolores sit quo. Velit non quidem assumenda atque quasi delectus. Quibusdam id omnis odio aut assumenda. Mollitia rerum molestias voluptatem in.\n\nQui reiciendis tempore atque voluptatem at autem explicabo. Nemo cumque laborum velit consequatur. Nihil magnam reprehenderit necessitatibus exercitationem doloremque commodi.', 'Voluptatem molestiae nesciunt eveniet deserunt tempore consequatur suscipit dolor. Accusantium odit consequatur culpa voluptas quibusdam voluptatem et. Est fugiat quae dolorum culpa. Qui rerum aliquam dolor libero quisquam voluptatem voluptatum. Nulla quia amet voluptatum quam dicta.\n\nVoluptatem laudantium sunt soluta nostrum cumque sed est. Aspernatur qui quo molestiae et vel. Soluta hic nemo est distinctio. Dolor quaerat eos tempora quam non officia.\n\nUt quasi qui et debitis autem. Repellendus ut ea et aut laborum deserunt. Magnam voluptas perspiciatis omnis exercitationem.', 'et', 'images/furniture/1.jpg', 116, 105, 0, 2, NULL, 0, 0, 1, '2018-04-18 13:42:23', '2018-04-25 13:46:19', '2018-04-25 13:46:19'),
(123, 1, 3, NULL, 0, 'Dolorem delectus tempore exercitationem in.', 'dolorem-delectus-tempore-exercitationem-in', 'Earum veritatis consequatur voluptatem sed. Repudiandae corrupti officiis qui dolorem. Voluptate consequatur qui et repellat cum. Dolorum dicta voluptate adipisci voluptatem molestiae rerum itaque.', 'Velit eum deleniti tempore sed maiores. Adipisci quae incidunt hic magni amet voluptate iusto. Voluptas sunt consectetur ea qui. Odit corporis eum tempore veniam. Consequatur eius quod nihil voluptas et.\n\nEligendi quo voluptatem vel est adipisci et. Qui in accusantium dolor et. Quaerat dicta ab labore.\n\nEst tempora harum dolor ex illum. Pariatur omnis facere enim debitis enim. Accusamus qui nostrum quisquam minima autem. Inventore quis odit est quis rerum.', 'Placeat recusandae nobis harum culpa quod temporibus saepe. Ipsa qui eum animi ut asperiores magni. Nemo labore sed eveniet dicta praesentium praesentium.\n\nUllam voluptas quos ab debitis expedita nobis. Sunt veritatis eaque nihil. Corporis sequi alias autem voluptatum qui.\n\nEst et suscipit neque non. Ut eveniet consectetur hic ipsa culpa. Atque doloremque modi rem earum quo vel eum.', 'qui', 'images/furniture/1.jpg', 187, 101, 0, 1, NULL, 0, 0, 1, '2018-04-02 22:16:08', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(124, 1, 3, NULL, 0, 'Atque aperiam necessitatibus commodi ea incidunt.', 'atque-aperiam-necessitatibus-commodi-ea-incidunt', 'Dolor eum consequatur in omnis doloribus. Deleniti perferendis reiciendis ipsa. Natus dolor fugiat laudantium odit possimus dolores.', 'Iure nihil numquam accusamus et molestiae et nulla. Optio nihil molestias et ullam qui quia. Pariatur ullam enim maiores inventore vero. Sed doloremque et occaecati in.\n\nFugit reiciendis nihil vitae laboriosam quia aperiam. Dolores doloribus dignissimos eius in adipisci. Sunt rerum enim et nihil.\n\nQui voluptatibus nulla cupiditate enim occaecati recusandae animi. Et voluptas commodi voluptatem amet. Enim itaque sunt temporibus molestias expedita voluptatum. Cumque quis est voluptatem id.', 'Et consectetur nihil et repudiandae delectus facilis. Aspernatur fuga libero odit vel atque molestias quia. Doloremque est sit sit quam eius in.\n\nDolore iusto autem molestias ipsa unde. Tenetur aut delectus iusto molestiae esse facilis dolor atque. Mollitia ipsam aut itaque deleniti eos consequatur. Incidunt quia asperiores voluptas corporis.\n\nEt mollitia quia dolores voluptatem velit aut atque. Nostrum et maxime consectetur laboriosam exercitationem non. Nostrum expedita temporibus reprehenderit repellat.', 'aut', 'images/furniture/1.jpg', 228, 126, 0, 1, NULL, 0, 0, 1, '2018-03-30 12:46:43', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(125, 1, 3, NULL, 0, 'Hic delectus soluta non adipisci ab deserunt.', 'hic-delectus-soluta-non-adipisci-ab-deserunt', 'Aliquid ipsum nam sit adipisci nihil. Laboriosam doloremque omnis commodi. Veritatis eius rem ipsam id voluptatibus rem sunt.', 'Impedit qui omnis in magni. Dolores repudiandae dolore molestias vel alias neque quis. Voluptas doloremque dolorum nemo facilis.\n\nAt maxime esse odio. Saepe magni id similique possimus perspiciatis nihil ut qui. Dolorem voluptas ipsa magnam perspiciatis illum modi est eveniet. Dignissimos repellat nobis aspernatur alias vel. Praesentium quo doloribus molestiae nisi dolor sunt.\n\nUt expedita ut voluptates rerum eius dolorem. Perferendis iure voluptatem fugit in. Illo rem fuga maxime molestiae non omnis id at. Quia ratione ad officia sed beatae commodi.', 'Quam deserunt nobis iste aliquid consectetur. Voluptatem recusandae odio velit assumenda quasi quo. Sunt natus delectus voluptatem voluptatem sunt dolores sunt.\n\nAut perspiciatis sunt et quis non magnam velit. Vel aliquid consequatur sint omnis totam illum quod. Beatae minus eveniet ducimus aspernatur. Consectetur nihil ea quia quia nostrum.\n\nNon doloremque non fuga dicta neque aut. Sapiente qui quia consequatur consequatur. Quis ad eum laudantium sed natus. Ut libero velit ipsum quia veritatis. Officia maxime deleniti est.', 'vel', 'images/furniture/1.jpg', 254, 94, 0, 3, NULL, 0, 0, 1, '2018-04-08 08:02:22', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(126, 1, 3, NULL, 0, 'Hic dolore alias vel eos quia commodi fugiat.', 'hic-dolore-alias-vel-eos-quia-commodi-fugiat', 'Quo dignissimos autem consequatur quas itaque libero magnam. Est velit consequuntur quas et et. Numquam necessitatibus assumenda inventore a velit.', 'Consequatur quaerat dolor magnam doloribus laboriosam voluptatum. Voluptatum tenetur quia reiciendis enim commodi velit. Aut consequatur sequi ea et assumenda consectetur ut aut. Provident consequatur nostrum velit cumque ut molestiae consectetur est.\n\nQuibusdam harum harum tenetur aut doloribus distinctio. Quo laborum voluptas iusto. Rem adipisci blanditiis perferendis mollitia dolor.\n\nNihil aut illum cum nulla nihil. Sequi voluptatem deleniti et voluptate facilis rerum recusandae odio. Harum deleniti similique reiciendis eos.', 'Occaecati natus animi nesciunt deserunt et inventore ut. Corporis voluptatum sed consequuntur rerum maxime. Dolore vel eligendi maxime ut sed neque in. Quia dolorem vitae nesciunt voluptatibus ex.\n\nReiciendis voluptatibus mollitia eos corrupti accusamus aut occaecati. Et eum voluptatem deleniti quia suscipit minima aut. Aspernatur qui dolor quisquam reprehenderit dolores enim. Quam laborum dolores tempora magnam nobis eum. Distinctio aperiam consequatur quod accusantium.\n\nSint inventore ullam ut inventore quaerat. Possimus atque repudiandae suscipit quo tenetur sed maiores. Magni asperiores excepturi in beatae adipisci ab.', 'deserunt', 'images/furniture/1.jpg', 293, 100, 0, 2, NULL, 0, 0, 1, '2018-04-13 01:51:12', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(127, 1, 3, NULL, 0, 'Ipsum amet atque aperiam nisi reprehenderit tempora.', 'ipsum-amet-atque-aperiam-nisi-reprehenderit-tempora', 'Veniam sunt at maiores et nam omnis magni. Occaecati et ea et ratione inventore qui itaque consequatur. Odit rerum temporibus qui nihil molestiae sed.', 'Sit voluptatem consequatur eveniet. Aut sed a et enim hic optio officia. Voluptas soluta et quo eaque doloribus eos. Numquam sit non sit dolor atque non.\n\nEum id laborum rerum voluptatum beatae quibusdam et. Quos dolor iusto in dolores delectus. Quisquam sed ducimus autem possimus omnis eligendi. Minus inventore ipsa mollitia in. Tempore sed reprehenderit illum eos ut labore vel.\n\nSimilique rerum inventore neque illo. Sit ea libero ex molestiae. Voluptate veritatis at reprehenderit voluptate nulla.', 'Consequuntur non quis et aut aliquam numquam. Cumque cupiditate est itaque nihil. Neque deleniti culpa totam laboriosam non.\n\nQuam ut quia recusandae fuga corporis aut. Suscipit atque aut soluta fugiat possimus nisi et. Nihil temporibus voluptates distinctio qui quidem minus. Velit et sint non tempore. Distinctio labore vel tenetur reiciendis molestias corporis aliquid consequatur.\n\nDistinctio id nulla in. Corrupti commodi autem porro ipsum enim nisi eum.', 'animi', 'images/furniture/1.jpg', 232, 125, 0, 3, NULL, 0, 0, 1, '2018-04-02 03:20:52', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(128, 1, 3, NULL, 0, 'Placeat tempore quod esse totam provident provident.', 'placeat-tempore-quod-esse-totam-provident-provident', 'Iure est eos quidem neque consequatur. Et aspernatur beatae qui hic molestiae saepe. Enim adipisci alias sunt illo. Est unde ut qui in.', 'Ut dolorem commodi quia voluptatem. Distinctio cum ratione ea id. Nostrum expedita sed culpa corrupti.\n\nVoluptas minus explicabo nihil rerum labore eaque enim. Et ab dicta aliquid. Eum tempora non ullam similique.\n\nError animi possimus sunt ut alias accusamus earum. Consequatur sed temporibus blanditiis possimus quia soluta. Dolor molestias provident voluptatibus eius. Tempora aut necessitatibus ratione a esse.', 'Quisquam labore blanditiis qui in reiciendis facere. Quibusdam velit veniam voluptatem voluptas.\n\nId minus minima accusamus repudiandae dolores culpa. Non expedita veniam quis esse voluptatibus. Dolor nam maxime ut nemo odit quos.\n\nUt reprehenderit esse quis rerum iure non. Consequatur nulla ipsa reiciendis tenetur. Velit qui tempore qui deleniti dolor quidem et.', 'fugit', 'images/furniture/1.jpg', 216, 108, 0, 3, NULL, 0, 0, 1, '2018-04-19 00:57:29', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(129, 1, 3, NULL, 0, 'Qui natus dolorem modi.', 'qui-natus-dolorem-modi', 'Quae error molestiae aut illum dignissimos nihil. Facilis praesentium consectetur sint est maxime enim doloremque qui. Et et quo tempora optio explicabo et deserunt. Occaecati laborum distinctio molestias perspiciatis tempora labore. Non maiores voluptas ', 'Aut dolorum odit non vel quod ea ut. Qui dolor rem ad ipsum corporis. Fugiat porro voluptate consequatur optio.\n\nRem exercitationem voluptatem id aliquid. Impedit cupiditate minima molestiae dolore distinctio temporibus sed fuga. Accusantium id inventore placeat inventore sed possimus qui unde. Dignissimos debitis quasi sit.\n\nDolorem quis eum beatae voluptatibus quia voluptate expedita. Optio enim cupiditate et natus sit maiores odit. Rem rem quis asperiores rerum sunt magnam.', 'Eos consequatur dolor culpa maxime. Ut dolorem dolor ullam sed doloremque quos aut eius. Voluptatibus blanditiis quasi tempore rerum.\n\nQuisquam quis asperiores aut sed. Est aut ut repellat. Quisquam quis iste rem et.\n\nVoluptatibus voluptatibus iste pariatur repellendus ipsa adipisci alias et. Vel ad velit tempora voluptas. Vitae sint voluptas sapiente corrupti non. Ducimus ad perferendis magni facere.', 'doloribus', 'images/furniture/1.jpg', 133, 146, 0, 1, NULL, 0, 0, 1, '2018-03-28 21:26:57', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(130, 1, 3, NULL, 0, 'Et animi animi consectetur atque accusantium soluta qui quos.', 'et-animi-animi-consectetur-atque-accusantium-soluta-qui-quos', 'Aliquam voluptatem iure ducimus nemo quia illo. Accusantium quas ut aut culpa asperiores in. Odit officia minus mollitia aut incidunt modi autem atque. Magni tempora vero velit quae.', 'Laborum expedita vitae ipsam occaecati aut sit quidem. Sed explicabo sapiente odit necessitatibus ut. Voluptas dolorum quos inventore.\n\nEos soluta nam quos quidem et. Illum dignissimos dolor id minima. Perspiciatis accusamus quia iure corporis quis. Architecto ad quia quia officiis. Culpa aut nisi doloribus voluptates et maiores nesciunt consequuntur.\n\nIn laboriosam aspernatur dolores neque totam. Architecto molestias aut distinctio dolorum delectus sit. Totam molestiae totam consequuntur impedit nisi dolor nemo et. Asperiores eaque nemo fuga doloremque qui omnis.', 'Dolor ipsum et optio impedit natus. Sit quaerat expedita et eos quas quod. Voluptatibus minima ut nostrum eum. Rem voluptatibus dolor aliquid excepturi rerum maxime est.\n\nAperiam voluptatem quidem ab illum error hic. Eius qui molestiae blanditiis iure dolor dolore. Qui earum sed harum enim deleniti.\n\nAliquid at excepturi suscipit nostrum modi. Illum ut nobis placeat neque perferendis quia hic. Enim iste nesciunt voluptatum voluptatem at. Temporibus harum dolor ut maiores ex hic veniam.', 'totam', 'images/furniture/1.jpg', 241, 90, 0, 3, NULL, 0, 0, 1, '2018-04-22 03:31:35', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(131, 1, 3, NULL, 0, 'Tenetur tempore autem sint inventore corrupti sit dolorum.', 'tenetur-tempore-autem-sint-inventore-corrupti-sit-dolorum', 'Ut veritatis maiores quia est sit eius repellendus. Eum neque molestiae odio totam qui non esse voluptates. Inventore voluptas iusto ipsam id non libero.', 'Animi recusandae aliquid mollitia commodi aut omnis omnis corporis. Quibusdam laboriosam ipsum aut quam culpa quo molestias. Voluptas doloremque aut qui.\n\nIusto beatae nostrum error cupiditate eum ut qui. Voluptas modi mollitia culpa mollitia maiores. Qui repellendus cupiditate magni sed error id repellat.\n\nConsequatur earum quas illo rerum. Enim commodi illum voluptates numquam incidunt doloremque sit. Et voluptates doloribus quidem ut tenetur excepturi id.', 'Qui neque doloremque nemo. Esse culpa dolor voluptates necessitatibus dolorem quaerat. Beatae consectetur deleniti quia ut.\n\nDolorem ut vel quia ad. Totam eaque totam accusamus. Excepturi facere eaque inventore non rerum dicta ipsam.\n\nIllo qui quisquam nemo in ad nemo. Aliquam commodi quo officiis non aut consequatur eos at. Sint et quo quisquam sequi tenetur delectus ad. Iste sed nesciunt sequi aperiam esse aut. Est reiciendis expedita suscipit rerum iste.', 'iste', 'images/furniture/1.jpg', 186, 137, 0, 2, NULL, 0, 0, 1, '2018-04-09 10:21:36', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(132, 1, 3, NULL, 0, 'Corrupti non saepe harum reiciendis.', 'corrupti-non-saepe-harum-reiciendis', 'Molestiae provident rerum consectetur amet praesentium. Dolores quia sunt nihil aut omnis id expedita sed. Qui vitae reiciendis neque dolor ipsam et repellendus. Maiores adipisci dolores facere harum nisi.', 'Nemo minus et voluptatem qui hic non rerum eos. Voluptatibus et et et numquam id nobis explicabo quas. Fuga voluptates magnam error cum eum. Excepturi facilis laborum harum. Commodi exercitationem iure quos maxime eum unde.\n\nMinima officiis sit molestias. Accusantium ipsam dolores dolorum sed ut. Quis asperiores nihil voluptatibus quibusdam. Eum ut et sed amet. Expedita ut reiciendis esse omnis molestiae libero ab.\n\nConsequatur ratione similique eum explicabo qui repudiandae molestiae incidunt. Qui voluptatum vitae laudantium accusamus aut et. Minus quis qui earum dolorem alias labore qui.', 'Explicabo distinctio non quia ipsa alias et nesciunt. Non eligendi consequatur placeat magni sunt et. Est porro occaecati voluptatibus totam accusamus eos enim. Delectus vitae ut eum id accusamus necessitatibus voluptas sapiente.\n\nSit qui explicabo facere quia provident a sint. Voluptatibus rerum nobis consequatur odio. Voluptatibus vel voluptatem ut rerum animi ea.\n\nAmet voluptatem occaecati sunt mollitia quos vero qui. Repudiandae aut omnis id. Unde inventore voluptas et aut.', 'voluptatem', 'images/furniture/1.jpg', 226, 122, 0, 2, NULL, 0, 0, 1, '2018-04-10 15:38:03', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(133, 1, 3, NULL, 0, 'Quae hic amet distinctio sapiente dolor odio.', 'quae-hic-amet-distinctio-sapiente-dolor-odio', 'Ad quibusdam deleniti ipsa illo voluptas. Sequi aspernatur nihil id. Eius blanditiis ad ab ipsa. Ut eum autem quibusdam repudiandae labore qui.', 'Quia odit commodi autem eum dolorem officiis sed. Beatae ut blanditiis doloribus quisquam fuga occaecati. Dolorem quasi accusamus corporis.\n\nDoloremque consequuntur esse quia nesciunt enim sed. Ut velit similique hic dolor aliquam dolor praesentium. Et nihil temporibus dolorum doloribus beatae omnis aspernatur.\n\nQui sed quos debitis voluptate voluptatum incidunt asperiores. Sed voluptate occaecati qui quo qui sit sit quo. Libero omnis id accusantium.', 'Magni quaerat id accusamus qui illum maxime commodi deleniti. Nihil quaerat fugit autem corrupti. Officiis eaque explicabo consequatur at enim.\n\nDolore vel rerum dolorem quod. Voluptas veniam sit nulla non odit repudiandae. Minima aut enim quidem quibusdam ducimus.\n\nEt reprehenderit aperiam veritatis fuga consequatur. Beatae qui adipisci sit et. Animi architecto velit voluptas odit numquam deleniti unde.', 'velit', 'images/furniture/1.jpg', 148, 93, 0, 1, NULL, 0, 0, 1, '2018-03-30 21:44:22', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(134, 1, 3, NULL, 0, 'Eligendi et quo temporibus ut.', 'eligendi-et-quo-temporibus-ut', 'Qui repellendus et illo possimus officiis. Ex nihil cumque et perferendis velit. Nam in quis excepturi necessitatibus ullam aut et labore.', 'Eos assumenda et unde rerum. Molestiae veritatis nam recusandae dolores odit iste. Et unde labore dignissimos et. Consectetur quia ipsum nesciunt aspernatur.\n\nNon quod ut rerum placeat modi. Provident dicta provident nihil omnis quo maiores cumque dolorem. Nostrum velit id explicabo laboriosam sunt debitis.\n\nOmnis eaque totam doloribus id libero fugit. Eos similique tempore quae unde eveniet sunt. Odio aperiam maxime deleniti sit repellendus natus sit. Eaque sed molestiae pariatur ipsum provident.', 'Corporis a sed animi. Earum at laudantium mollitia assumenda. Sapiente consequatur voluptatem aut ex et quasi. Distinctio autem ut magni et dolorem.\n\nSint accusamus quis est. Itaque esse aut quia beatae quia. Quaerat dolorem commodi consequuntur fuga ut qui qui. Maiores recusandae ut molestiae deserunt et minus ipsum.\n\nEligendi nemo numquam voluptas eaque. Ut voluptate quidem non corporis soluta dolorem ut.', 'vero', 'images/furniture/1.jpg', 122, 121, 0, 2, NULL, 0, 0, 1, '2018-04-14 11:30:14', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(135, 1, 3, NULL, 0, 'Eaque quo quis necessitatibus facilis.', 'eaque-quo-quis-necessitatibus-facilis', 'Quas voluptas voluptas consectetur esse. Sed dolorem asperiores aliquam magnam dolor et. Earum hic inventore voluptatem voluptas. Vel sunt aut labore animi maxime sapiente.', 'Minima enim officia aut soluta sunt nobis. Nihil consectetur qui qui rerum officia repudiandae. Aut temporibus omnis neque officia dolore. Natus ut et quibusdam natus et ut.\n\nQui voluptatum dolorum harum repellat atque et. Recusandae eum ipsa ut qui nemo quasi. Voluptas perspiciatis dignissimos in amet. Accusantium numquam dolore voluptatem quia aliquid veniam natus nostrum.\n\nSoluta nesciunt iste ipsam nisi quaerat id sit culpa. Blanditiis quas est eaque et. Laborum nulla magni omnis tempore fugiat.', 'Facere et totam soluta exercitationem. Rerum unde voluptatem quibusdam provident quibusdam modi similique nesciunt. Ea atque qui quo officiis excepturi tempore.\n\nVeniam eaque rem et sed rerum voluptatem molestiae. Et ut ullam veritatis et. Iure atque explicabo qui fuga sed voluptatem iusto.\n\nBlanditiis blanditiis asperiores sit vel quisquam natus excepturi. Iure reiciendis beatae iusto repellat ducimus sint a cum. Debitis veniam velit quia esse veritatis velit.', 'repudiandae', 'images/furniture/1.jpg', 272, 80, 0, 1, NULL, 0, 0, 1, '2018-04-24 13:58:04', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(136, 1, 3, NULL, 0, 'Vero earum sint maiores et incidunt quas.', 'vero-earum-sint-maiores-et-incidunt-quas', 'Est facere autem voluptatum. Aut fugiat praesentium libero ipsam. Modi est est qui molestiae saepe.', 'Ut magni voluptatibus aperiam corporis eaque. Fuga cum dolores ea fugiat amet ut. Quis ullam molestias voluptatem modi qui numquam aut.\n\nSapiente reiciendis molestiae suscipit cum quidem rerum qui. Voluptas delectus minima temporibus repudiandae natus. Dolorum voluptas provident ducimus odit perferendis possimus animi.\n\nUt nihil est aut perferendis quisquam sunt. Debitis perspiciatis qui dolore ea non ut cum. Repellat qui quia quia magni eaque ipsum.', 'In dolor quidem in rerum. Recusandae sed aut sit. Veritatis libero totam consequatur cupiditate beatae eligendi aliquid.\n\nMaxime excepturi et quis id deleniti. Rem et accusamus ea et eius itaque sint. Qui veniam minima quo quis velit sunt. Voluptatem et autem distinctio ipsam ut consequatur ratione.\n\nCulpa cupiditate est molestias voluptas iste ea repellat illo. Voluptas voluptatem minima ut enim reprehenderit numquam id. Omnis earum iusto quae perspiciatis omnis culpa ut. Porro porro minus cupiditate minus delectus aut ut.', 'sequi', 'images/furniture/1.jpg', 118, 99, 0, 2, NULL, 0, 0, 1, '2018-03-31 16:48:20', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(137, 1, 3, NULL, 0, 'Blanditiis mollitia voluptas delectus quis harum eum sed.', 'blanditiis-mollitia-voluptas-delectus-quis-harum-eum-sed', 'Officia qui ut praesentium eligendi sed. Voluptate aliquid ut nisi deserunt dolores nesciunt. Nam numquam nobis perspiciatis est quia voluptates corrupti atque.', 'Laborum ea unde perferendis ipsum laborum quisquam cupiditate. Odio voluptate aut voluptatem nam. Voluptas velit et ut maxime non assumenda dignissimos. Quia esse magni soluta voluptas nostrum. Accusantium in voluptas animi perspiciatis deleniti quisquam repudiandae nobis.\n\nSed et voluptatem consequatur rem. Facere rem similique a aut. Quaerat laudantium illum doloribus temporibus voluptas. Nisi debitis animi debitis aut.\n\nEa iure dolores commodi molestias quis sit. Modi itaque sequi sed est dolorum sed qui. Reprehenderit tenetur culpa non. Eum qui iste consequatur similique libero ut nobis.', 'Quis accusantium quis est qui omnis. Amet quo voluptatem qui sed maxime similique eos. Maiores ut optio quis. Iusto modi expedita recusandae id impedit autem aut. Fuga impedit rerum laudantium similique provident.\n\nTotam neque dolores sunt sint ut repellat. Nihil quia sit praesentium magnam aperiam ullam magnam culpa. Ea vero animi ut molestiae. Nihil vel quia cum et suscipit. Atque tempore qui pariatur.\n\nNeque repellendus ut sed itaque rerum molestiae voluptatibus repudiandae. Est molestiae molestias possimus sed molestias est dolorem. Ut commodi est quibusdam dolor tempora totam officiis soluta.', 'consequuntur', 'images/furniture/1.jpg', 190, 114, 0, 1, NULL, 0, 0, 1, '2018-03-28 00:35:28', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(138, 1, 3, NULL, 0, 'Dolores voluptatem officiis rerum ratione consequatur molestias quia sequi.', 'dolores-voluptatem-officiis-rerum-ratione-consequatur-molestias-quia-sequi', 'Architecto sint vel iure. Qui quod distinctio consequuntur at commodi dolores. Aut aliquam id praesentium culpa totam. Eum voluptatem ut voluptatem culpa quo.', 'Voluptate aut minus aut beatae minus. Iure et minima ex unde. Aperiam quis alias dolorem totam ut. Qui nesciunt ut voluptas ut neque. Ut debitis magnam perspiciatis accusamus et dolorum numquam.\n\nId tenetur quas expedita molestias sunt quod repudiandae ut. Quia accusantium consequuntur consequuntur et assumenda magnam. Voluptas perspiciatis cumque aut quia. Unde eum vitae et aut sint omnis.\n\nSed et quos maiores qui voluptates ut dicta. Fugiat corporis voluptatem vel. Possimus dolor rem dolor ipsum nemo. Quia alias tenetur ipsum nihil voluptatem recusandae.', 'Possimus quia ipsum deserunt illum soluta commodi nostrum similique. Rerum ducimus numquam velit expedita. Eos deserunt qui dolor velit laudantium omnis vel.\n\nAspernatur porro delectus veniam doloribus natus omnis officia. Nulla alias rerum dolore omnis nulla ut. Doloremque cupiditate adipisci saepe dolores quibusdam.\n\nBlanditiis rerum quia ad quaerat ex sunt. Quam tenetur aut ut est cumque temporibus quia at. Autem omnis eum aut vel quas non. Ea nihil ab repellat cupiditate in dolorem.', 'eum', 'images/furniture/1.jpg', 185, 118, 0, 1, NULL, 0, 0, 1, '2018-04-17 08:48:15', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(139, 1, 3, NULL, 0, 'Officiis facilis harum ratione deserunt.', 'officiis-facilis-harum-ratione-deserunt', 'Architecto repellat sequi qui. Distinctio cupiditate doloribus id et saepe qui. Saepe adipisci aut et veniam. Excepturi itaque nesciunt et praesentium a.', 'Earum quibusdam quae exercitationem cumque. Incidunt molestias libero ipsum ut recusandae quisquam. Aperiam qui ut vel voluptate adipisci consequuntur. Repellat necessitatibus consequatur quia iusto soluta eveniet aut.\n\nQuam laboriosam et et ratione. Ea reprehenderit veritatis nisi delectus fuga ipsum. Ad delectus excepturi qui rerum aspernatur mollitia. Earum incidunt explicabo ullam dolor maxime rerum quis.\n\nQuasi omnis soluta fugiat ea fugit facilis autem. Impedit voluptas illum et quam quia ut. Soluta iure ut eligendi iure est odit tenetur. Voluptatum ut nulla maiores suscipit soluta aliquid velit.', 'Numquam optio et occaecati non aperiam suscipit. Fugit dolor blanditiis praesentium. Cupiditate et sint omnis voluptate reprehenderit et. Voluptates quidem aliquid et labore sint sint voluptatibus.\n\nEsse nostrum illo qui occaecati qui est ducimus. Voluptatem suscipit sequi est doloremque accusantium. Dolorem eum voluptas qui autem aut qui.\n\nA debitis est dolor at aut incidunt est necessitatibus. Dolorum quasi recusandae autem ipsum et blanditiis. Error et corporis excepturi repellendus aut. Vero sunt voluptates et.', 'ut', 'images/furniture/1.jpg', 195, 126, 0, 3, NULL, 0, 0, 1, '2018-04-14 22:20:18', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(140, 1, 3, NULL, 0, 'Amet provident excepturi sit quis.', 'amet-provident-excepturi-sit-quis', 'Delectus quod sint totam ullam praesentium iure. Non maxime accusantium assumenda facere iste. Officia voluptas necessitatibus maiores ab. Incidunt magni ut molestiae. Ut molestiae eaque repudiandae maiores et explicabo aspernatur.', 'Quas sequi id ut et modi ea eaque. Eos id a architecto hic animi eos. Voluptatem molestiae quia sit inventore provident nemo est.\n\nEos saepe expedita quam voluptas ea error. Quaerat et voluptatem ea est dicta voluptatem. Nihil incidunt expedita sint voluptas cumque.\n\nLaboriosam quia non voluptatibus. Est autem velit cumque itaque culpa. Et rerum et mollitia molestiae qui omnis perferendis perspiciatis.', 'Est dolores qui et itaque rem. Non incidunt quisquam enim tempora illo sunt molestias. Et dolore omnis possimus deserunt vel consequatur aspernatur. Modi pariatur et culpa et.\n\nAtque id quia aut sit ea voluptate. Harum quam nam in rerum. Debitis similique repudiandae ut ab. Tempore vel rerum enim a alias.\n\nEt ratione qui et dignissimos itaque eveniet. Rerum ea voluptas enim velit consectetur explicabo sed voluptatem. Aut enim delectus repudiandae dolores voluptatem.', 'et', 'images/furniture/1.jpg', 187, 112, 0, 2, NULL, 0, 0, 1, '2018-03-30 16:54:22', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(141, 1, 3, NULL, 0, 'Vel sunt iusto illum non earum eos.', 'vel-sunt-iusto-illum-non-earum-eos', 'Recusandae itaque beatae incidunt eius. Dolores minus quam consequuntur aperiam quod. Ducimus et consectetur et quaerat temporibus temporibus. Ut laborum quis necessitatibus repellendus earum.', 'Voluptatem aspernatur enim natus. Rerum est omnis ut dignissimos ut. Maxime pariatur omnis quia alias. Aut aut quisquam aspernatur qui.\n\nEt dolorem excepturi maxime. Consequatur commodi et in eaque nesciunt qui vitae. Nesciunt sit deleniti debitis iure.\n\nAsperiores possimus nesciunt voluptatem recusandae dolorum. Culpa voluptatem velit numquam. Sunt qui ut eligendi aut asperiores.', 'Dicta porro eveniet accusantium voluptas illo optio rerum nihil. Eligendi aut sed sunt aperiam assumenda voluptatem voluptas. Excepturi maxime non ea explicabo.\n\nOccaecati blanditiis tenetur aut quia veritatis cum voluptatem. Assumenda rerum tempore sapiente dicta suscipit ipsa sapiente consequatur. Eaque tempore maxime molestiae non quia labore temporibus. Sit rerum fugiat adipisci iste pariatur deserunt. Modi pariatur molestiae sequi totam est porro ut.\n\nNam beatae atque ut. Quo totam provident incidunt at possimus at. Est fuga voluptatibus ad laudantium nam. Eligendi odit et fugiat deserunt.', 'numquam', 'images/furniture/1.jpg', 207, 80, 0, 3, NULL, 0, 0, 1, '2018-04-08 22:18:24', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(142, 1, 3, NULL, 0, 'Cumque tempora repellat impedit.', 'cumque-tempora-repellat-impedit', 'Velit sint vitae ut sed excepturi necessitatibus qui. Totam totam odio et qui maxime illum eaque quibusdam. Molestias aliquam sed asperiores ut qui eius est.', 'Sed tenetur aperiam molestiae ut aliquid. Nam itaque excepturi sed. Ipsam aut quia provident a. Et ut quia laboriosam esse.\n\nRecusandae nisi autem atque harum enim facere repudiandae. Magni accusamus dolor quaerat debitis qui. Non hic culpa a in placeat ut itaque.\n\nQuaerat nemo nihil reprehenderit deserunt tempora delectus dignissimos. Maiores alias est consequatur unde. Nemo ut quas blanditiis est hic nesciunt temporibus.', 'Molestias ex quia voluptatem. Quia sunt dolores sit quasi omnis ipsa. Aspernatur laudantium doloribus et modi distinctio.\n\nDistinctio natus qui quia dolor corrupti. Id expedita ea sequi sint ea occaecati dolor. Tenetur eveniet qui sint ut. Et aspernatur qui dolorem eos.\n\nDignissimos rerum reprehenderit praesentium dolore eaque. Et iure ut id. Itaque ab ipsam dolores nisi. Aperiam et doloremque repellat.', 'consectetur', 'images/furniture/1.jpg', 174, 146, 0, 3, NULL, 0, 0, 1, '2018-04-12 10:53:49', '2018-04-25 13:46:20', '2018-04-25 13:46:20');
INSERT INTO `products` (`id`, `user_id`, `brand_id`, `collection_id`, `set_id`, `title`, `slug`, `short`, `body`, `body2`, `code`, `image`, `price`, `price_outlet`, `views`, `amount`, `color`, `discount`, `sold`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(143, 1, 3, NULL, 0, 'Officia a pariatur quasi recusandae aperiam animi.', 'officia-a-pariatur-quasi-recusandae-aperiam-animi', 'Saepe exercitationem ut qui facilis. Corporis voluptas quo molestiae doloremque. Neque alias id voluptas fugiat voluptas laudantium. Doloremque iusto incidunt quasi laudantium ut quibusdam omnis rerum. Ut architecto sunt ipsum.', 'Consequatur culpa eos voluptatum occaecati quisquam qui sit. Et aut eum omnis et eum aut voluptate. Repellat tempore excepturi nobis facere. Temporibus dolorem natus velit id non commodi.\n\nIncidunt et sint atque non. Delectus reprehenderit autem totam nihil. Assumenda nostrum nostrum qui voluptates dolore. Et magnam deleniti dignissimos sit quisquam at consectetur aut. Ipsa mollitia incidunt aut quia ipsa ut.\n\nOfficiis et error enim provident voluptas omnis molestias. Dolorem commodi sunt fugit. Recusandae quod quia sequi amet. Amet voluptatibus sapiente id aut et dolor.', 'Fuga architecto animi quidem tempora id eos officiis amet. Aliquam adipisci explicabo dolorem et et amet.\n\nId saepe in incidunt vel vel voluptas deleniti. Occaecati accusantium quidem voluptatum blanditiis sed. At pariatur ut quis voluptatem. Fugit velit itaque fugiat vero velit sunt. Incidunt perspiciatis debitis quo molestias placeat atque.\n\nTemporibus commodi necessitatibus aut nihil sit. Et error explicabo neque adipisci inventore. Architecto explicabo voluptas ut consequatur corporis nisi recusandae. Quo ea nam cupiditate reprehenderit aperiam. Officiis nihil sed beatae sequi officia.', 'facere', 'images/furniture/1.jpg', 228, 142, 0, 3, NULL, 0, 0, 1, '2018-04-23 16:14:35', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(144, 1, 3, NULL, 0, 'Omnis qui dolores rem et saepe.', 'omnis-qui-dolores-rem-et-saepe', 'Placeat in eos expedita optio beatae. Aut dignissimos perferendis voluptatum ipsam consequatur. Ut laborum voluptatem qui rerum.', 'Architecto et et aut incidunt quia praesentium. Animi fugit vel est dolores. Molestiae consectetur ut iste optio.\n\nAtque omnis quod fugit deserunt ipsam beatae. Enim ad provident qui qui perferendis tenetur repellat dolores. Provident beatae est perspiciatis eum delectus ipsum deserunt. Voluptatem tenetur enim autem delectus fugit qui cupiditate.\n\nError qui est iusto culpa quam. Repudiandae laudantium molestiae doloremque eum corporis. Reprehenderit numquam aut cumque. Nam laudantium possimus explicabo iusto aspernatur tempore expedita.', 'Aut quis veritatis omnis similique quia et. Nihil corporis est earum voluptas possimus magnam et dignissimos. Eius esse rerum consequatur aliquid eos et nostrum quasi.\n\nQuo est nostrum deserunt corporis est totam dolorem. Autem dolores minus aut velit ab corrupti nisi. Est dolor voluptate error non maxime. Perspiciatis odit eaque fuga cupiditate molestias qui.\n\nQuia voluptatem veritatis magnam odio aut. Libero est nihil omnis quia est eaque vel. Laborum eligendi corrupti officia illum. Distinctio aliquam id quos sit aspernatur.', 'et', 'images/furniture/1.jpg', 278, 141, 0, 1, NULL, 0, 0, 1, '2018-03-28 00:55:46', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(145, 1, 3, NULL, 0, 'Voluptas officiis ad sint esse nam.', 'voluptas-officiis-ad-sint-esse-nam', 'Non aut ut expedita natus saepe. Nostrum ex ea et voluptatem praesentium est totam. Rerum pariatur repellendus assumenda est dolores dolorem repudiandae quibusdam. Est qui architecto et dolor.', 'Numquam voluptate et facilis et. Velit repellendus laudantium eligendi non. Culpa labore nihil omnis eveniet. Esse iure blanditiis molestiae id sit aliquam aut.\n\nLaborum amet soluta eos exercitationem harum labore beatae. Inventore natus eligendi consequatur cum beatae quidem. Enim totam ut est quam reiciendis explicabo.\n\nTempore cum atque similique sunt saepe. Voluptate laborum voluptatem dolores qui modi est. Dolorem odio doloremque dolor placeat a rerum possimus eligendi.', 'Corrupti aliquam pariatur omnis ut vel nesciunt. Vero qui ut harum. Et eveniet sint porro ex natus autem. Quisquam architecto perferendis alias fugit ut.\n\nNecessitatibus id labore vitae hic in. Optio libero qui neque quisquam quos velit. Neque sequi suscipit explicabo dolore. Sed quo dolorem neque at.\n\nVoluptatem odit explicabo recusandae eligendi placeat nemo nostrum. Ut recusandae voluptate ut.', 'inventore', 'images/furniture/1.jpg', 235, 83, 0, 3, NULL, 0, 0, 1, '2018-04-24 23:45:25', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(146, 1, 3, NULL, 0, 'Minus ullam optio rerum qui ipsum rerum laboriosam dicta.', 'minus-ullam-optio-rerum-qui-ipsum-rerum-laboriosam-dicta', 'Vitae facere suscipit omnis molestiae impedit. Qui dolorum porro quae eius ut odio impedit. Et nobis adipisci et dolorem corrupti fugit. Dicta rem possimus quidem aperiam aut natus tempore.', 'Eius dignissimos deleniti autem nesciunt. Reprehenderit deserunt nemo qui quaerat quia. Deserunt eligendi et est maxime dolorum veniam. Deserunt fugit soluta adipisci.\n\nNumquam sit saepe aut vitae tempore dolore et. Iusto nobis quam ea ad. Et incidunt aliquid aut. Iusto rerum sed quas quia.\n\nSunt hic aperiam ut et. Quia natus quos qui corrupti ut et.', 'Dolores nulla autem ducimus dolorum amet. Neque nisi sunt voluptatem vero amet. Molestiae provident quis accusamus et ipsam in explicabo.\n\nVoluptatem molestias ad ipsum eos est qui harum. In harum cum nulla ad. Dolores voluptatem quo suscipit sunt eaque. Debitis ducimus labore et sint quasi aperiam in.\n\nVoluptate est et perspiciatis qui aliquam. Maiores nesciunt ut maxime pariatur. Repellat non voluptatem dolores et consectetur architecto sequi. Ad et officia et aut et nulla. Consequatur quis maiores sit blanditiis saepe nihil ex.', 'facere', 'images/furniture/1.jpg', 115, 109, 0, 3, NULL, 0, 0, 1, '2018-04-17 22:36:47', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(147, 1, 3, NULL, 0, 'Et recusandae et ut ab nisi sed.', 'et-recusandae-et-ut-ab-nisi-sed', 'Architecto voluptatem ea voluptatum quo velit necessitatibus sunt. Repellat dolor at qui adipisci ex quidem. Veniam culpa sunt quis et.', 'Impedit minus laboriosam fugiat vitae. Sapiente facere rerum et facere. Eum aut aliquam sit dolores et id accusamus porro. Vero error et quia molestiae excepturi cupiditate aut.\n\nCulpa laudantium est vel eos. Qui qui nemo natus sint et. Sed deserunt officia dolorem enim natus et. Eos a autem vero. In earum provident maxime laborum aut voluptatum quam ea.\n\nQuis repellat mollitia sit eaque sit. Labore sit delectus maxime voluptatem aut facilis. Eligendi cupiditate consequatur ut vitae iusto vel est molestiae. Iure et similique et illum saepe autem alias.', 'Aut ut quia ab eligendi sequi aliquid et quae. Aut ratione fugiat quia sed ut. Fuga odit dolorem ducimus. Mollitia omnis aut accusamus omnis minima voluptatem enim.\n\nSit ullam dicta tempora autem animi in. Velit voluptate facilis perferendis eaque. Voluptas ab deleniti nisi expedita omnis. Dolor repellat in ea ratione quidem aspernatur esse facere.\n\nVoluptas et et itaque ullam ad rem doloribus. Cumque voluptas qui dolor et aut odio. Qui ea sed aut velit aut. Dolores enim consequuntur eum suscipit.', 'doloribus', 'images/furniture/1.jpg', 298, 80, 0, 1, NULL, 0, 0, 1, '2018-04-10 03:30:09', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(148, 1, 3, NULL, 0, 'A eaque sapiente ducimus pariatur veniam quo tempora quae.', 'a-eaque-sapiente-ducimus-pariatur-veniam-quo-tempora-quae', 'Dolor qui soluta accusamus rerum neque minima. Consequatur enim consequatur optio et et id aliquid veniam. Velit voluptatum impedit quibusdam impedit unde a explicabo.', 'Quis autem incidunt reiciendis autem maiores repudiandae ab. Quia laboriosam ut ad dolores. Possimus cum impedit sed qui quis impedit nobis voluptatibus. Soluta velit facilis placeat minima nulla. Nesciunt impedit dignissimos ullam illo temporibus.\n\nVelit sed perspiciatis optio debitis. Non occaecati quisquam corporis et repellendus quia possimus. Et hic voluptatibus quod sed eligendi reiciendis iste. Ut consequuntur cum itaque.\n\nSapiente quia cupiditate voluptatem id. Sunt ea rem nulla libero reiciendis consequatur harum. Incidunt consequatur eius error in.', 'Fuga qui hic facilis. Adipisci ut veniam dolorum molestias excepturi et. Quasi ratione id ut incidunt est voluptatum. Eligendi incidunt qui labore impedit et dolor.\n\nRatione ratione ea quo unde. Tempora inventore voluptatem quia rem. Ut quam eos eaque in assumenda.\n\nRepellendus harum nostrum dolorem. Tempore ut dicta vero corporis ut maiores at. Quo illo libero tenetur inventore. Repellendus placeat inventore voluptatem.', 'ut', 'images/furniture/1.jpg', 108, 82, 0, 2, NULL, 0, 0, 1, '2018-03-28 19:05:01', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(149, 1, 3, NULL, 0, 'Voluptatem ipsam adipisci quia perferendis molestias.', 'voluptatem-ipsam-adipisci-quia-perferendis-molestias', 'Odit qui numquam nisi qui soluta temporibus. Nostrum ab esse mollitia molestias. Quo a ratione qui magni. Laudantium molestiae neque non dolor aut nulla.', 'Iusto illo velit dolor. Dicta minus ullam ipsum. Temporibus quaerat explicabo voluptatem velit est. Odio sit aut rerum dicta corporis quis. Et sunt deleniti sapiente esse in nisi itaque.\n\nNisi id natus soluta est ab. Aut ut quibusdam iusto delectus et. Necessitatibus natus sint consequuntur a. Doloribus doloribus placeat labore et doloribus veritatis sit dolorem.\n\nTenetur pariatur culpa et accusamus repellat. Sed omnis deleniti laboriosam blanditiis. Magnam nostrum eos consequuntur ipsa repellat totam sed. Velit minima dolorum laborum iste.', 'Sequi minima qui ut labore. Ut doloremque velit error nihil. Consequuntur in blanditiis est omnis quam culpa. Illo omnis officia repellat voluptate doloribus enim expedita dolores. Praesentium laudantium eaque nihil hic explicabo aspernatur.\n\nItaque fuga qui quis enim non quisquam optio. Aut maxime et eos inventore.\n\nRem aut qui ut perferendis tempore praesentium dolores. Voluptatem recusandae cumque aut facere qui quia eaque nesciunt.', 'rerum', 'images/furniture/1.jpg', 162, 140, 0, 2, NULL, 0, 0, 1, '2018-04-19 11:32:18', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(150, 1, 3, NULL, 0, 'Necessitatibus quisquam odio quasi ea non iusto.', 'necessitatibus-quisquam-odio-quasi-ea-non-iusto', 'Perferendis qui ipsam quos ullam facilis corrupti blanditiis. Aut qui incidunt sit alias quia. Doloremque totam autem aut quidem perspiciatis ut autem.', 'Nihil quidem labore omnis quis totam beatae eligendi. Fuga eos ex ab sint esse. Sit error quis molestiae.\n\nLabore amet adipisci aut ab. Nihil quae quae qui incidunt delectus totam quae. Consectetur tempora velit officiis cum inventore maiores cum. Est ducimus in veniam est ab eligendi.\n\nQuis quidem atque exercitationem sint modi atque. Soluta id et qui. Et debitis nihil voluptatem atque neque consequatur. Rerum voluptatem iure enim hic tempora. Exercitationem ipsam laborum sit porro consequatur ut facilis.', 'Sapiente aut rerum eos sit architecto. Expedita quo aut soluta repellat. Laboriosam enim aut et est aliquid iste suscipit.\n\nNobis et quia quod officiis. Amet labore natus repellendus dolor. Aperiam iste eum minus magni a. Voluptate impedit illum aut.\n\nLibero dolor alias id voluptatem provident eos. Ratione rerum est eum doloremque placeat autem. Qui perferendis neque excepturi. Ut voluptatibus est illum aperiam.', 'asperiores', 'images/furniture/1.jpg', 291, 84, 0, 1, NULL, 0, 0, 1, '2018-04-11 04:26:39', '2018-04-25 13:46:20', '2018-04-25 13:46:20'),
(151, 1, 4, NULL, 0, 'Nostrum ratione ullam autem est voluptatem.', 'nostrum-ratione-ullam-autem-est-voluptatem', 'Facere sunt dolor et quia enim fugit at consequatur. Rerum exercitationem velit repellat voluptatibus fugiat et soluta. Ab repudiandae delectus odio eveniet sapiente reprehenderit aliquam dolor. Ducimus aperiam at sunt quia numquam odit quam. Odio qui ali', 'Perferendis sed minima autem aspernatur vero voluptatem unde nulla. Corporis ut mollitia harum dolore eius ut quo. Ea quod qui esse unde.\n\nEst quaerat officiis natus beatae eos sunt impedit iure. Est facere earum earum qui quaerat. Cum assumenda non ratione nulla mollitia et et. Labore blanditiis consectetur aperiam aliquam.\n\nAb ex non et ipsam in ipsum consequatur laborum. Et sit reiciendis nesciunt saepe.', 'Autem placeat nihil esse et vel quibusdam saepe dolores. Ea odio sint dolores dolore hic nemo quo. Odit dolore possimus numquam sed. Et qui in vel voluptas id atque deserunt.\n\nPorro sed qui velit perferendis ab. Corporis ut recusandae dolorem labore aut et aspernatur. Cum architecto nesciunt in similique. Tempore exercitationem porro pariatur molestiae magnam aut. Quas impedit voluptatem perferendis.\n\nUt explicabo earum tenetur omnis est. Et beatae id in et fugiat dolor impedit neque. Itaque assumenda voluptatem iusto explicabo magnam inventore. Voluptas nam cumque doloremque ratione repellendus autem.', 'ad', 'images/dining/3.jpg', 191, 113, 0, 3, NULL, 0, 0, 1, '2018-04-06 01:54:05', '2018-04-25 13:46:29', '2018-04-25 13:46:29'),
(152, 1, 4, NULL, 0, 'Iste aut tempora ipsum excepturi.', 'iste-aut-tempora-ipsum-excepturi', 'Earum rerum vitae soluta recusandae fugiat id. Qui cum earum qui voluptatum.', 'Vitae itaque qui et perferendis. Possimus harum dignissimos exercitationem est quibusdam rerum. Temporibus quo tempore accusantium sunt dolorem occaecati. Error temporibus omnis quisquam enim corrupti officia eaque. Voluptas et architecto officiis.\n\nAutem autem nihil accusantium eveniet officia. Velit voluptas nostrum qui similique pariatur dolore. Minus reiciendis quia aspernatur dolore temporibus omnis officia.\n\nAlias quas sit error doloribus. Velit excepturi maiores animi et rem sunt repudiandae.', 'Ad ea quia voluptatum voluptatem qui aut. Molestiae molestiae voluptas itaque. Aut eveniet corrupti voluptas. Ullam sapiente velit porro officia et commodi architecto.\n\nExercitationem minus ratione ut. Sed deleniti incidunt voluptatum et qui. Magni sed sunt soluta ut corporis similique. Consequatur facere occaecati est nam incidunt rerum.\n\nIpsum dignissimos corrupti exercitationem et. Soluta facere culpa in optio. Dolorem qui nostrum vel.', 'aliquam', 'images/dining/3.jpg', 137, 95, 0, 2, NULL, 0, 0, 1, '2018-03-28 23:49:33', '2018-04-25 13:46:29', '2018-04-25 13:46:29'),
(153, 1, 4, NULL, 0, 'Voluptatem rerum et sit.', 'voluptatem-rerum-et-sit', 'Iusto aut earum aliquam voluptas sit totam rerum. Temporibus veritatis corrupti est et aliquid in est. Et autem et repellat laborum velit sunt. Quaerat sint odio quo quas qui impedit necessitatibus.', 'Et magnam est natus voluptas exercitationem. Nostrum quia laboriosam sit repudiandae id unde.\n\nRatione nemo harum fugiat vel ipsam dolorum. Adipisci voluptatum deleniti animi occaecati omnis ab pariatur. Repellat hic nulla excepturi. Aliquam alias qui labore delectus.\n\nEt itaque inventore eaque beatae doloribus architecto non. Dicta odit minima eos voluptatum nobis earum quia. Aliquam debitis distinctio aut ut porro ullam saepe est. Dolor hic quo hic magni soluta natus vel.', 'Voluptates doloremque debitis eius architecto vero. Repellendus rerum ullam harum aliquid voluptas molestiae omnis. Deserunt qui minus soluta est sit.\n\nDolores et optio blanditiis maxime accusantium totam. Ipsum sit veniam ea eos omnis eum. Aut veniam dicta sit impedit.\n\nMolestiae quod ipsam et iure illo quae maxime. Corrupti qui culpa et et veniam.', 'velit', 'images/dining/3.jpg', 104, 98, 0, 3, NULL, 0, 0, 1, '2018-04-16 09:27:47', '2018-04-25 13:46:29', '2018-04-25 13:46:29'),
(154, 1, 4, NULL, 0, 'Cum quas ratione cupiditate.', 'cum-quas-ratione-cupiditate', 'Id sapiente cumque minima tempore. Eos fugit sunt possimus qui quasi maxime et. Deserunt et et sit soluta voluptate. Repudiandae minima ipsa incidunt temporibus amet quaerat aut unde.', 'Sequi et ex quo dolorum voluptas eligendi. Rerum consequatur perspiciatis qui eum. Expedita consequatur molestiae laudantium et qui vitae. Distinctio quo sint exercitationem voluptatem. In rerum nobis neque et ipsum in quaerat.\n\nCorrupti magnam officia sed qui facere natus. Cum reiciendis ut consectetur illum iste. Dolores nihil unde consectetur deleniti tempora id rerum.\n\nQui non beatae eos sed quia aut. Qui minima sunt excepturi non atque. Beatae et ut dolores.', 'Eaque dolores voluptatibus tempora culpa. Quis nisi est quasi consectetur repellendus voluptatem. Est illo similique quisquam nobis assumenda aliquid non. Voluptate pariatur voluptatem adipisci maiores quasi ea accusantium.\n\nItaque et minima et voluptatem id id. Nemo qui eum ducimus animi sint. Blanditiis et corrupti dolores eum natus id sit. Aperiam laboriosam rerum est mollitia facere dicta ipsum. Eligendi aut explicabo sit soluta odio non officiis.\n\nAut a eos sint voluptatem qui aut. Pariatur accusantium aut ut ea hic eveniet. Omnis repellendus nobis nam voluptatem.', 'et', 'images/dining/3.jpg', 226, 132, 0, 2, NULL, 0, 0, 1, '2018-03-30 12:27:34', '2018-04-25 13:46:29', '2018-04-25 13:46:29'),
(155, 1, 4, NULL, 0, 'Labore occaecati molestiae repellendus facilis excepturi.', 'labore-occaecati-molestiae-repellendus-facilis-excepturi', 'Voluptatem velit nemo perferendis magnam iusto autem. Odit debitis deserunt molestiae autem est. Consequatur officiis qui possimus architecto beatae aut.', 'Hic ea natus tempore molestiae nesciunt sed exercitationem. Quaerat tenetur voluptatem magnam quaerat voluptas. Omnis veritatis distinctio nemo quas eum.\n\nNihil et excepturi nihil. Praesentium doloremque optio et quidem. Vel blanditiis sit repellat voluptatem eius. Adipisci maxime esse officiis qui officiis perferendis voluptas.\n\nSequi ad nam minima tenetur ut maxime omnis. Nobis sint iste id ut accusantium est earum nobis. Fugiat nostrum nihil quia tempora est voluptate veritatis.', 'Molestiae sint distinctio mollitia sint modi qui. Et quasi rerum est sequi molestias. Vel placeat fugiat corporis sit numquam doloremque.\n\nSunt enim molestias blanditiis et aliquid quia ea. Consectetur repellat et ad culpa ut omnis dolor earum. Neque quisquam omnis consequuntur dolore ex.\n\nUt et eos ipsam soluta architecto. Dicta aut eum et aspernatur qui ab. Cum ut harum adipisci quae et occaecati. Vitae cumque debitis dolorum. Consequatur ut labore odio voluptates.', 'voluptatibus', 'images/dining/3.jpg', 169, 83, 0, 3, NULL, 0, 0, 1, '2018-04-10 04:16:59', '2018-04-25 13:46:29', '2018-04-25 13:46:29'),
(156, 1, 4, NULL, 0, 'Labore temporibus et vitae eum autem aliquam.', 'labore-temporibus-et-vitae-eum-autem-aliquam', 'Quibusdam dolor maxime expedita quod. Assumenda eos eaque nihil voluptas velit ut. Rerum dolorem delectus est temporibus. Cumque aut blanditiis cupiditate doloremque.', 'Dolor inventore quo inventore at neque. Commodi consequatur mollitia voluptas quis. Itaque reprehenderit suscipit vero eaque.\n\nNam nisi consequatur ut voluptate reprehenderit assumenda. Consequatur aliquam dolorem iusto et iure hic.\n\nAutem recusandae et natus nulla. Sit tenetur velit eum distinctio sunt ut. Autem necessitatibus excepturi atque eligendi.', 'Eaque officiis itaque est eos voluptas. Quis rerum corrupti non aliquid doloremque qui aut. Quod recusandae mollitia qui at totam. Sunt magnam libero doloremque alias vero.\n\nQuia sed ipsa harum et sed. Sit reiciendis modi expedita voluptas qui dolores. Vero qui quidem nihil sed nobis occaecati et. Praesentium et voluptatibus sit soluta id.\n\nLabore beatae ut numquam eum. Hic et aliquam ab. Et blanditiis corrupti voluptatibus esse iure cum.', 'ut', 'images/dining/3.jpg', 293, 119, 0, 2, NULL, 0, 0, 1, '2018-04-01 23:59:14', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(157, 1, 4, NULL, 0, 'Voluptatibus at ex recusandae ullam accusamus.', 'voluptatibus-at-ex-recusandae-ullam-accusamus', 'Possimus ut voluptatem non ea voluptatem. Sed velit ex maxime minus. Placeat expedita ipsam similique odio impedit maxime voluptas sit. Sed iste rerum quae omnis harum.', 'Neque ut ipsa quidem ex quia. Et doloribus facilis consectetur et nobis. Et ratione vitae ullam molestiae aut.\n\nEt consequatur velit quidem. Consequatur sapiente nisi possimus et quod quidem saepe. Veritatis reprehenderit neque vitae qui praesentium fuga neque rerum.\n\nAssumenda qui voluptatem necessitatibus sunt deleniti. Deleniti iusto et est sunt consequuntur velit asperiores. Repellendus iusto quos recusandae eos.', 'Ullam itaque qui maxime autem accusamus et minus. Alias at facilis alias est nesciunt. Illum ut fugit eaque.\n\nIste qui unde vitae modi. Et tempora mollitia quos.\n\nCum quidem sed odit nostrum. Qui distinctio nihil porro. Nemo dolorum vel similique debitis itaque consequatur.', 'ut', 'images/dining/3.jpg', 227, 84, 0, 3, NULL, 0, 0, 1, '2018-04-24 09:41:55', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(158, 1, 4, NULL, 0, 'Et voluptatem est incidunt earum.', 'et-voluptatem-est-incidunt-earum', 'Praesentium deleniti veritatis voluptas libero. Ad quia officia natus consequatur quidem ut. Tenetur delectus dignissimos et alias rerum omnis molestiae. Aut officiis autem error eum.', 'Vel velit possimus pariatur aut explicabo est voluptas. Et aut quod magnam molestias.\n\nConsectetur ex ipsum nemo. Perferendis laboriosam doloremque distinctio minima. Dolore earum neque itaque doloremque consectetur animi in.\n\nOmnis deserunt commodi voluptates. Similique et reiciendis iure consequatur qui cum quia. Sit et ipsum dolorem eveniet.', 'Necessitatibus et excepturi quisquam quibusdam sit velit. Soluta et quis deleniti. Consequatur et nisi modi et velit ut repellendus.\n\nSunt a reprehenderit cupiditate repellat itaque. Voluptatem hic provident magni rerum explicabo aliquam. Dignissimos adipisci et omnis vitae ipsum numquam. Laboriosam voluptatem perspiciatis dolorem blanditiis cumque odit nesciunt. Occaecati nulla nesciunt ut qui sunt eveniet.\n\nEnim non vel non maiores voluptatibus in. A soluta et velit rem officia accusamus. Beatae sint aut in est voluptatem ut. Nobis illo officiis dignissimos vel.', 'eos', 'images/dining/3.jpg', 267, 134, 0, 2, NULL, 0, 0, 1, '2018-04-20 10:56:34', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(159, 1, 4, NULL, 0, 'Qui soluta sed explicabo.', 'qui-soluta-sed-explicabo', 'Tempore et et aliquam deleniti et nulla placeat. Earum ut delectus vero. Deserunt veritatis officia quibusdam et.', 'Aut qui similique dolorum rerum. Quibusdam aut voluptates optio et eius est. Quia ullam consequuntur voluptatibus minima enim.\n\nId est provident enim et omnis optio. Odit dolor ad odio. Ipsam quae saepe in ipsam eum molestiae possimus saepe.\n\nCupiditate et facere et fuga vel neque id. Earum quo harum omnis ipsam quibusdam. Consectetur odit aspernatur architecto et et. Consectetur molestiae enim dolores qui illo laboriosam.', 'Ea cupiditate vero eum qui incidunt sunt. Atque minima enim qui doloribus neque. Id repudiandae eum amet accusantium. Quia sit ratione reprehenderit.\n\nRatione dignissimos placeat laboriosam. Quo saepe ea nisi veritatis. Laudantium deleniti suscipit quam non facilis similique ipsa.\n\nEos aut repellat modi vero reprehenderit reprehenderit. Et ullam consequatur beatae mollitia quos et quo. Vero dicta rerum magni at ad at vel at. Et et error qui consequatur corrupti fuga.', 'illum', 'images/dining/3.jpg', 142, 109, 0, 1, NULL, 0, 0, 1, '2018-04-16 03:09:50', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(160, 1, 4, NULL, 0, 'A fugiat necessitatibus non non consequatur quidem.', 'a-fugiat-necessitatibus-non-non-consequatur-quidem', 'Neque sunt ut iste. Vero et ad eum non omnis repellendus qui dolore. Sed similique et error qui aut temporibus. Impedit ab est non excepturi beatae et.', 'Cumque maxime labore ut tempore est ducimus. Odio voluptas et ea totam sit laudantium. Ad repellat sequi minima dolorum sapiente.\n\nAsperiores dolorem ducimus commodi velit consequuntur autem. Rem sed quisquam asperiores voluptate. Animi nesciunt quos molestiae. Id et repellendus officia et sunt quidem itaque.\n\nEt eos qui tenetur qui impedit ducimus. Nostrum nulla eos quis voluptas. Officia commodi sit voluptatem velit voluptates.', 'Est ducimus eaque nihil consequuntur excepturi quos in. Accusamus sit et accusamus sed aut odio quis.\n\nPossimus quia laudantium repudiandae quam totam sint consequatur. Sapiente porro ut sequi et voluptas. Dolorem unde laboriosam fugiat autem.\n\nAut iste omnis voluptates voluptatem est magnam quas vitae. Quis animi nobis harum rerum pariatur. Et vitae voluptatibus quod libero. Labore omnis dolore ea dolores.', 'eum', 'images/dining/3.jpg', 218, 116, 0, 2, NULL, 0, 0, 1, '2018-04-02 08:38:41', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(161, 1, 4, NULL, 0, 'Totam dolor doloribus ut incidunt doloremque.', 'totam-dolor-doloribus-ut-incidunt-doloremque', 'Dolorum explicabo consequuntur non et. Labore culpa sed consequuntur laboriosam et autem possimus. Voluptatem cumque unde voluptas. Non atque dolor sapiente in aut.', 'Aut consequatur deleniti sint cum ea. Non qui quibusdam dicta deleniti libero et. Adipisci qui laboriosam est exercitationem eius provident.\n\nAb accusantium quam corrupti. Rerum placeat placeat assumenda repudiandae laborum quam consequatur ut. Delectus eius aut ullam voluptatem aliquid qui. Autem deleniti iure dignissimos temporibus.\n\nIusto qui ea ex libero non. Ipsa libero at et rerum sit qui est. Et est ut dolores odio ad distinctio molestiae impedit. Eveniet recusandae adipisci eum labore et at in.', 'Fugit commodi corporis earum in officia vel voluptatem. Laboriosam optio quas maiores eaque quis sint eos reiciendis. Et id perferendis dicta est aut repellendus sint. Est excepturi recusandae eaque eos.\n\nTenetur esse ut velit ut. Tempora quidem id suscipit voluptatem. Ut ut tenetur at nam animi tempora esse.\n\nSuscipit sequi qui cumque corrupti assumenda. Possimus aut soluta quam vel molestiae omnis. Mollitia in reiciendis quod voluptas a corrupti architecto.', 'ut', 'images/dining/3.jpg', 177, 125, 0, 2, NULL, 0, 0, 1, '2018-03-27 16:50:28', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(162, 1, 4, NULL, 0, 'Enim aut quia autem id dolores doloribus.', 'enim-aut-quia-autem-id-dolores-doloribus', 'Cumque et est hic impedit. Perspiciatis culpa quis cumque qui aspernatur sint excepturi.', 'Velit sit veniam voluptas aliquam. Molestiae voluptatem corrupti omnis quo. Qui vitae minima et praesentium. Autem ut earum sint illum vitae aliquid molestiae tenetur.\n\nIn minus id consectetur ut quia eveniet. Magnam adipisci iste consequatur nihil voluptas eligendi perferendis. Ratione repellendus minus delectus deserunt tempore et quia. Vero possimus itaque aspernatur iusto qui tenetur. Nisi hic natus molestias dolorem blanditiis.\n\nAutem voluptates ut impedit totam dignissimos suscipit eligendi et. Id consequatur voluptas voluptates unde. Quod nobis aut ea commodi iure voluptas. Odio non qui aliquid et atque.', 'Quia eligendi accusantium doloribus quis perferendis ratione modi. Numquam ad eaque labore earum qui velit. Mollitia sequi dolor incidunt sed ea voluptatem.\n\nEarum temporibus nihil repudiandae vero magnam blanditiis ex. Repellat ex nihil officiis eos fugit. Ex et ratione sed reiciendis magni unde.\n\nLaboriosam officiis neque accusamus excepturi. Eos sed aut tenetur est. Qui itaque expedita sunt. Ut cum consectetur ut beatae voluptatem et consequatur.', 'non', 'images/dining/3.jpg', 218, 92, 0, 2, NULL, 0, 0, 1, '2018-04-17 02:02:03', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(163, 1, 4, NULL, 0, 'Facilis voluptas sed quia consectetur omnis.', 'facilis-voluptas-sed-quia-consectetur-omnis', 'Quia ipsum tempora possimus est quaerat. Dolorum autem sunt voluptas. Facere modi exercitationem et porro laboriosam. Autem sit dignissimos quod aut dolore autem quaerat molestiae.', 'Eos voluptatum enim voluptas dolorum corporis vel. Eveniet culpa repudiandae necessitatibus at.\n\nSit natus molestias nemo. Et consectetur voluptatem optio assumenda nostrum laudantium ut. Omnis facilis sapiente modi et repellendus quo.\n\nEst placeat qui consequatur. Et sit quod iure.', 'Praesentium et nulla voluptatem culpa qui reprehenderit aliquam. Tempora rerum libero cum quia vel adipisci. Recusandae quis minima magni voluptate quibusdam exercitationem est. Eligendi aliquid illum illum omnis debitis nam.\n\nMaiores minima veritatis voluptatem laudantium et aliquam nemo earum. Ea neque ut exercitationem consequuntur officiis autem. Quae natus voluptatum exercitationem doloribus. Blanditiis praesentium recusandae cumque.\n\nOmnis pariatur sed officiis suscipit quidem et. Et at occaecati accusamus molestiae sunt sit consequuntur deleniti.', 'id', 'images/dining/3.jpg', 213, 85, 0, 3, NULL, 0, 0, 1, '2018-04-16 13:34:47', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(164, 1, 4, NULL, 0, 'Eos architecto magni quis impedit.', 'eos-architecto-magni-quis-impedit', 'Temporibus aut assumenda aperiam et ullam facilis. Qui vel quibusdam autem sint quia enim veniam aspernatur. Et laudantium voluptatum aut iste accusamus maiores.', 'Debitis qui inventore ex et quis veniam voluptas. Qui ea distinctio praesentium laboriosam.\n\nSint aspernatur laboriosam consequatur tenetur eveniet. Tempora tenetur placeat voluptatem optio excepturi nihil. Quia sit quasi fugit unde iusto.\n\nOmnis ut dolor officiis quod magni architecto exercitationem omnis. Consequuntur impedit vitae harum qui. Reiciendis et consequatur et ut architecto magnam aliquid sit. Magnam id tempore qui cumque.', 'Cumque ea culpa aspernatur omnis et ratione. Illum non laborum repudiandae praesentium fugiat atque. Voluptas eum aliquam vel at facilis.\n\nEt non magnam laudantium quia quia rerum nam ut. Eos nam sint facilis ut inventore iure. Et suscipit excepturi eos dolorem voluptatem exercitationem mollitia.\n\nError molestiae est eum exercitationem velit. Omnis delectus adipisci est aliquam ut. Nisi voluptas qui harum.', 'nihil', 'images/dining/3.jpg', 181, 133, 0, 3, NULL, 0, 0, 1, '2018-04-13 00:49:26', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(165, 1, 4, NULL, 0, 'Occaecati et ipsa perspiciatis temporibus.', 'occaecati-et-ipsa-perspiciatis-temporibus', 'Voluptatem itaque cupiditate rem eius tempore. Nihil quia enim ea quaerat modi quis. Similique explicabo aperiam iste eum.', 'Molestias hic et corrupti officia in fuga doloremque illum. Perferendis optio ut ut velit. Iusto ipsam veniam est iste.\n\nEnim laboriosam numquam a sequi culpa. Provident vitae cumque tempora laboriosam odio. Enim maiores iste unde laborum dicta optio voluptatem.\n\nEt hic reprehenderit nobis aperiam. Alias minima veritatis facilis sit unde reiciendis.', 'Voluptatum soluta laboriosam ducimus amet accusamus placeat adipisci inventore. Magni dignissimos natus odit odit laudantium voluptas. Quod vel officiis aut quia.\n\nNon rerum aut deserunt omnis nisi provident. Quod qui provident quia ut. Id ipsum harum vero. Aliquam iste omnis tenetur quasi vitae aspernatur.\n\nAd deleniti sunt veritatis quis. Sed et et sint rerum eos. Qui libero omnis nesciunt in numquam facere eligendi.', 'consequatur', 'images/dining/3.jpg', 246, 115, 0, 3, NULL, 0, 0, 1, '2018-04-22 19:53:49', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(166, 1, 4, NULL, 0, 'Necessitatibus ex incidunt facilis sunt quam minus similique.', 'necessitatibus-ex-incidunt-facilis-sunt-quam-minus-similique', 'Ea rerum iste natus repellendus quibusdam est. Praesentium omnis id tempora voluptate. Et saepe sint expedita voluptatem. At eos neque et magnam.', 'Ea et necessitatibus odio eligendi nobis enim. Voluptate enim consequuntur numquam necessitatibus expedita beatae. Et dolorem similique explicabo voluptate quidem.\n\nVelit iste quod eveniet aspernatur fuga nihil sint. Aut unde officiis voluptas soluta quod aut asperiores. Qui sapiente ipsa quibusdam omnis.\n\nNostrum modi magni et debitis in praesentium eos consequatur. Dolor sit facilis sint vitae provident. Vel facere dolor autem tempora.', 'Eos sed a quia. Officiis modi quod voluptatum sint velit. Sunt ipsam labore est quam.\n\nNumquam dolorem dolore sit iste. Laborum omnis nihil asperiores animi praesentium natus. Ullam commodi molestias ex consectetur adipisci quia magni. Provident porro error ad voluptatibus reprehenderit.\n\nVeritatis tempore dicta magni rem aut quisquam. Sit in minima molestiae. Ut asperiores est nemo suscipit saepe. Reprehenderit reiciendis deleniti est dolor ipsum odit.', 'illo', 'images/dining/3.jpg', 131, 117, 0, 3, NULL, 0, 0, 1, '2018-04-14 13:10:59', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(167, 1, 4, NULL, 0, 'Sapiente sint rerum quo excepturi molestiae.', 'sapiente-sint-rerum-quo-excepturi-molestiae', 'Et totam necessitatibus magnam quidem. Optio sit voluptatem consequuntur laboriosam. Nam minima aperiam nihil dolores et praesentium. Molestiae voluptatem dolore ut adipisci ipsam quia delectus molestiae.', 'Omnis rem vel perferendis. Et quas necessitatibus reiciendis velit. Ad suscipit deserunt eum quae voluptatem architecto. Accusamus quia esse tempore et.\n\nQuis cum corporis reprehenderit minus dolore neque. Sint exercitationem odit nulla quis. Dolor saepe qui et modi doloribus repudiandae tempore. In aut nihil accusamus suscipit eveniet.\n\nCum voluptatibus ut aperiam. Qui aperiam pariatur ea ut. Id voluptatem ut magnam ut et sint culpa.', 'Nam autem voluptatum est in. Iste veniam eos neque laboriosam vel quisquam. Molestias et debitis quis sit libero.\n\nPlaceat dolore ipsa ipsam harum vitae nihil. Mollitia numquam maiores maiores. Qui voluptatem repellendus id excepturi.\n\nMolestias perspiciatis ut officiis voluptatem est qui. Aut quae occaecati libero aut qui iure. Nostrum vel et sint iure in et. Praesentium praesentium voluptas aspernatur rem molestias ut.', 'pariatur', 'images/dining/3.jpg', 204, 114, 0, 3, NULL, 0, 0, 1, '2018-04-15 01:41:18', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(168, 1, 4, NULL, 0, 'Iste optio odit ut qui.', 'iste-optio-odit-ut-qui', 'Omnis quaerat quam officia eum fugit id. Similique nisi totam molestiae aut et. At quae minima optio sit occaecati.', 'Sed id voluptates mollitia consequuntur ab ut. Corrupti id corrupti fugiat ab magnam harum. Tempora quos ea repudiandae qui sint.\n\nSoluta cumque id adipisci rem qui qui. Voluptatem quaerat harum atque ad quam eos. Nulla et consequatur non. Numquam et mollitia esse enim rerum et.\n\nQuidem est inventore excepturi. Qui laborum dignissimos molestiae aliquid. Aut autem illum non sit.', 'Aliquam dolorem optio maiores suscipit architecto. Fugit quo expedita voluptatem qui. Pariatur ut laboriosam qui pariatur.\n\nEt magnam nihil qui ut quia. Aliquid saepe unde non ea eligendi minima officiis. Similique laborum id natus.\n\nUt maxime velit molestiae illum quae animi. Omnis veniam quia at non ea occaecati libero. Aut animi autem voluptatem soluta non odit.', 'sit', 'images/dining/3.jpg', 108, 142, 0, 3, NULL, 0, 0, 1, '2018-04-09 00:38:07', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(169, 1, 4, NULL, 0, 'Et rem corporis laudantium fugiat nostrum.', 'et-rem-corporis-laudantium-fugiat-nostrum', 'Et nesciunt molestiae laudantium praesentium ut. Corporis earum aut expedita saepe nam. Consequatur eos odit quo blanditiis.', 'Rerum voluptas consequatur soluta quia id occaecati qui. Quisquam molestiae exercitationem enim quia impedit veritatis inventore. Enim quia iusto accusamus ratione.\n\nDolorem soluta autem pariatur nesciunt alias aperiam asperiores. Ut dolores ullam iusto consequatur ea. Fugiat qui perferendis voluptas natus.\n\nQuia molestias voluptatem id error. Ipsa esse ut commodi exercitationem aut iure. Et vel aperiam occaecati magni. Excepturi sed ea sed consequatur et quia iure.', 'Rerum itaque reprehenderit qui qui aliquid. Nemo voluptas optio veniam ut inventore. Autem distinctio dignissimos beatae reiciendis voluptas.\n\nNam ut distinctio maxime veritatis aut quibusdam. Molestias eaque enim eius sint sit. A sapiente et ut totam eligendi sed maiores. Voluptas voluptas labore sunt laborum nesciunt sit modi.\n\nLabore in aut incidunt illum. Occaecati facilis dolorem sed consectetur. Omnis non sed labore voluptatem quaerat molestiae voluptatem ut.', 'autem', 'images/dining/3.jpg', 257, 111, 0, 2, NULL, 0, 0, 1, '2018-03-27 11:57:37', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(170, 1, 4, NULL, 0, 'Facilis tempora vitae at.', 'facilis-tempora-vitae-at', 'Repudiandae omnis nulla sunt sequi maxime facilis. Voluptatem sequi perferendis eum qui. Sequi totam eius optio dolores.', 'Quos aut debitis aut. Officiis vel beatae facilis suscipit reprehenderit. Pariatur aut quis excepturi dolores. Voluptas cupiditate veritatis eum optio unde sit esse.\n\nA autem architecto culpa sed voluptates. Voluptate minus ab ipsa consequatur nisi quo nisi. Fuga temporibus fuga rem maiores sed ut omnis et.\n\nIllum rem incidunt non nisi. Voluptatibus quos qui aspernatur tempora vero et debitis ducimus. Voluptas ut occaecati voluptatem enim consequatur fugit. Voluptatibus praesentium culpa quod delectus.', 'Molestiae tenetur repudiandae qui quos corrupti quia ab non. Ab asperiores eum veritatis. Dolores ut provident qui quis dolorem nihil. Sit nihil a voluptate ut eos amet. Quod nobis at explicabo debitis amet.\n\nVoluptas odit officia quia dicta. Tempora quis dolores possimus illo vel quasi. Est aliquam ut mollitia fugiat autem culpa corporis. Expedita debitis minus nam sequi earum minima nihil.\n\nQuo et placeat et dolor minima rerum. Ut nulla accusantium cupiditate vitae veritatis. Eos occaecati expedita velit sit est. Repellat nemo delectus a veniam. Reprehenderit dolorem est autem ratione.', 'molestias', 'images/dining/3.jpg', 300, 100, 0, 2, NULL, 0, 0, 1, '2018-04-15 19:29:43', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(171, 1, 4, NULL, 0, 'Quaerat voluptatem id voluptatem vero nihil quis.', 'quaerat-voluptatem-id-voluptatem-vero-nihil-quis', 'Et veniam quas cum. Quasi temporibus corporis dolorem rerum porro cum itaque consequuntur. Consequatur nisi optio laudantium est placeat aspernatur voluptate. Autem et itaque repellat nemo vel.', 'Nulla molestias voluptatum nulla natus ad voluptas mollitia. Et corrupti et nihil sit. Qui sed rerum nemo est veritatis id.\n\nDoloribus ducimus est cum itaque veritatis inventore. Quibusdam similique ut provident ut. Quo illo sequi et ea delectus. Officiis quia numquam ut voluptate veritatis doloribus.\n\nItaque maiores reiciendis voluptas omnis maxime mollitia. Nostrum laudantium et ut et. Consequatur facere quia natus quam excepturi corrupti vitae.', 'Nesciunt explicabo ab aut nobis architecto sint. Rerum ut velit maxime recusandae ea dolorem consequatur. Qui occaecati magni autem voluptates eaque et facilis inventore.\n\nUllam facilis exercitationem voluptas officia ut facere consequuntur. Doloremque amet est sunt odio ducimus eos.\n\nSuscipit quidem consequatur sit voluptatem ut. Suscipit accusamus ut qui eveniet blanditiis dolor sed. Repudiandae suscipit suscipit asperiores aut atque est quis. Exercitationem exercitationem nisi atque dolorum illum.', 'nam', 'images/dining/3.jpg', 288, 96, 0, 3, NULL, 0, 0, 1, '2018-04-02 01:15:51', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(172, 1, 4, NULL, 0, 'Voluptas unde reprehenderit aut dicta.', 'voluptas-unde-reprehenderit-aut-dicta', 'Explicabo voluptate vitae totam magnam inventore voluptatem. Porro quasi expedita sapiente. Esse ad et consequatur reiciendis fugit quasi sit. Voluptatem consectetur vel doloremque quia.', 'Omnis voluptatem nam eligendi ut vero. Vel aut incidunt ipsam molestiae doloribus molestiae. Magni deleniti et illum placeat quasi fugit ut.\n\nEarum adipisci eos dolorem sapiente enim. Est et rerum quia excepturi neque. Omnis quis eos eveniet.\n\nEst eveniet velit aliquam dolor cupiditate. Ad temporibus enim exercitationem et. Aut sint hic quia facilis omnis ut.', 'Voluptatem occaecati atque est adipisci rem non. Doloremque et possimus quo qui sequi harum molestias. Minima non saepe doloremque eveniet. Et odit molestiae dolorem quo esse corrupti optio ullam.\n\nId nesciunt necessitatibus illo quasi consequatur aperiam. Sed architecto optio quo fuga. Qui aut iure animi vero. Enim laborum consectetur nemo id temporibus id id.\n\nMagni debitis earum nesciunt totam consequuntur. Quam nihil earum atque. Perferendis aliquam aliquid ducimus aut aut. Sunt expedita doloremque quas omnis dignissimos.', 'eius', 'images/dining/3.jpg', 158, 128, 0, 2, NULL, 0, 0, 1, '2018-04-18 10:54:08', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(173, 1, 4, NULL, 0, 'Qui assumenda inventore eius aspernatur laudantium iusto.', 'qui-assumenda-inventore-eius-aspernatur-laudantium-iusto', 'Blanditiis tempora et nihil porro est aliquid enim. Saepe veritatis est perferendis corporis voluptas iusto tempore eligendi. Modi dolorum tenetur ut aperiam qui et sunt sed.', 'Sit cupiditate cupiditate voluptatem vel. Dolorem dicta veritatis rem iure qui velit. Placeat autem voluptas quia repellendus est reprehenderit qui.\n\nQuos tenetur ab repellat. Eos aut qui consequatur sed vel. Magni nesciunt quisquam dolore repellat quisquam laudantium. Et dolor quasi dolorem quisquam rerum accusamus.\n\nNihil blanditiis illum sunt autem sed. Quaerat enim at sint sint earum accusantium dolores facere.', 'Qui vel non atque autem fugit consequatur nulla. Nesciunt eum suscipit eius. Doloribus delectus fuga expedita neque.\n\nQui pariatur sequi vero nisi est quidem tempore. Unde aspernatur eius accusamus est inventore aut. Aliquid deserunt libero ea cumque nihil voluptatem harum ab.\n\nQuia recusandae dignissimos id aliquam. Culpa ut labore atque pariatur et laborum qui. Ut asperiores officia voluptatem ipsam tempora quo a.', 'assumenda', 'images/dining/3.jpg', 133, 103, 0, 1, NULL, 0, 0, 1, '2018-03-26 21:59:30', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(174, 1, 4, NULL, 0, 'Consequatur ipsum sequi et quae.', 'consequatur-ipsum-sequi-et-quae', 'Magni eligendi sint commodi sapiente quas est numquam. Ratione eos et labore id ut velit et. Vel nisi adipisci adipisci.', 'Occaecati maxime neque blanditiis doloribus soluta neque odio. Quia sint ut voluptatem sed. Eius et soluta incidunt tempora.\n\nOccaecati reprehenderit quisquam in facere molestiae rerum labore autem. Sit atque incidunt iure voluptatibus quo. Et sed quod ea eligendi rerum illum.\n\nEt dolore consequatur ullam et. Officiis sit soluta qui iusto dolorum quis ut. Minima inventore tempore ducimus pariatur quas eveniet quia. Aut quo repellendus dolores et.', 'Libero debitis facere ut eum. Aperiam blanditiis illum est facere. Omnis qui alias aut quam. Laborum eius accusamus ipsam laboriosam sed nihil eaque non.\n\nTotam in enim sit alias aut maiores aut aliquam. Aut vero soluta ut qui consequatur culpa temporibus.\n\nQui consequuntur nemo quas aliquid ut est aut. Aspernatur et est quasi sit temporibus officiis pariatur. Dicta et quia sed illo sit nostrum. Repellendus sit fugit reprehenderit corporis non officia non dolores.', 'nam', 'images/dining/3.jpg', 162, 97, 0, 2, NULL, 0, 0, 1, '2018-04-20 04:06:37', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(175, 1, 4, NULL, 0, 'Qui necessitatibus cumque ex aut aperiam inventore ipsum.', 'qui-necessitatibus-cumque-ex-aut-aperiam-inventore-ipsum', 'Repudiandae aut ipsum perspiciatis quis aut minus. Expedita et voluptas et cupiditate dolore. Et at quia blanditiis accusamus autem aliquid tempore vel. Sunt dolor dolores ducimus reprehenderit.', 'Consequatur voluptatum sequi sunt praesentium. Dolorum magni ut et est ducimus sit accusamus provident.\n\nNumquam qui soluta id. Dicta rem veniam praesentium. Repudiandae provident ut error reprehenderit vel a optio.\n\nQui minima sint at natus vel mollitia commodi. Beatae recusandae et adipisci et enim magni alias. Vero nostrum in eaque. Aliquid eius in quae aut vitae.', 'Enim quis corporis et ipsa. Cupiditate reiciendis commodi ab libero et. Est molestias placeat omnis ducimus a. Voluptatem voluptatem architecto architecto omnis cumque eligendi.\n\nEt ratione amet hic nesciunt culpa non. Impedit sunt placeat eligendi est.\n\nQuae qui quaerat ut voluptates. Ex facilis exercitationem velit cumque accusamus in nemo. Molestiae similique non et eos in voluptatem labore. Dolorum veniam qui quidem alias sunt.', 'necessitatibus', 'images/dining/3.jpg', 295, 137, 0, 1, NULL, 0, 0, 1, '2018-04-04 04:47:59', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(176, 1, 4, NULL, 0, 'Iusto corrupti sed dolor necessitatibus et quaerat odit.', 'iusto-corrupti-sed-dolor-necessitatibus-et-quaerat-odit', 'Corporis quia a amet maiores molestiae perspiciatis. Aut mollitia est sapiente qui id maiores commodi molestias. Nostrum qui eveniet officia dolorem iste minima.', 'Maiores saepe rem reiciendis quaerat modi. Similique quas aut labore sint dolorem aspernatur exercitationem dolore. Impedit laboriosam quas est sit. Voluptates fugiat cumque dolor animi dolore nisi hic.\n\nOdit recusandae voluptatum ducimus et expedita. Et corrupti aspernatur alias quasi sit dolores. Molestiae dolores quos quaerat ea atque odio qui.\n\nVoluptas quia repellat quisquam rem corporis ut. Expedita perferendis iure eum et aut. Rerum autem nobis praesentium voluptatem facilis.', 'Omnis quo deleniti ipsam totam molestiae eos. Consequatur voluptates natus consequatur aperiam et. Quaerat ut magni quaerat a. Adipisci est totam id rem quod molestias autem.\n\nVelit quo sunt quod distinctio vel quas at. Dolorem facilis omnis reprehenderit natus voluptas illum.\n\nMagnam quod qui excepturi maxime quis esse occaecati. Repudiandae ut ut cum et consequatur aliquam numquam ut. Possimus voluptatem accusantium esse accusantium. Culpa qui et nostrum suscipit in consequatur eius.', 'aliquam', 'images/dining/3.jpg', 216, 97, 0, 3, NULL, 0, 0, 1, '2018-04-04 17:48:19', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(177, 1, 4, NULL, 0, 'Dolor et quis qui necessitatibus voluptas.', 'dolor-et-quis-qui-necessitatibus-voluptas', 'Molestiae quasi voluptatem expedita. Non natus magni et iusto architecto tenetur quam. Voluptas est itaque dignissimos vitae qui quo saepe voluptatem.', 'Praesentium voluptates magni fuga nam officiis. In odio ad sequi minima aliquam. Modi praesentium eum sed quod qui reiciendis quia odio. Aut perspiciatis velit labore corrupti facere eum aspernatur modi.\n\nExpedita vero veniam quaerat pariatur voluptates beatae praesentium. Quasi voluptas voluptatem numquam reprehenderit soluta quisquam quam fuga. Et placeat officia est.\n\nEt illo magnam non voluptatibus similique autem voluptas. Explicabo voluptatem voluptas assumenda quia.', 'Corrupti et quam ipsum aut iste facere. Omnis provident corporis repudiandae deleniti et.\n\nAut sapiente vel nobis sed minima nihil ratione. Tenetur nam est aperiam corporis assumenda minima. Quod ullam accusantium est ut exercitationem nihil.\n\nSit qui dolorem aut consequatur. Qui perspiciatis et reprehenderit perspiciatis sit numquam. Vel dolore blanditiis ullam dolores quod cumque dolorem ut.', 'dignissimos', 'images/dining/3.jpg', 168, 129, 0, 3, NULL, 0, 0, 1, '2018-04-21 08:26:47', '2018-04-25 13:46:30', '2018-04-25 13:46:30'),
(178, 1, 4, NULL, 0, 'Sit aut consectetur sit fuga sunt eius.', 'sit-aut-consectetur-sit-fuga-sunt-eius', 'Voluptatem velit nobis excepturi voluptates. In cupiditate molestiae sit doloremque ut. Error eligendi est rem sunt dolores corporis voluptatem.', 'Qui reiciendis sit iste aut magnam. Architecto aliquam voluptate maxime inventore tenetur est. Eum cupiditate pariatur non pariatur. Rerum excepturi non nihil.\n\nEt molestiae quas aut deserunt nesciunt libero. Voluptatem in ut harum molestiae et dolor eveniet. Quas ut ipsa reiciendis non a. Nesciunt est voluptatem non tenetur.\n\nHic aperiam qui nam qui explicabo. Exercitationem sed occaecati qui veritatis quia. Et sit veniam eligendi eum in perspiciatis. Sint quisquam nulla modi illum maxime.', 'Repellat sed sed impedit vitae. Consequatur saepe ipsum eos vero labore est nihil. Voluptatem veritatis ab sed animi ducimus est. Ut aut sunt adipisci sapiente suscipit.\n\nEst distinctio laudantium accusantium deleniti quo voluptatem. Officiis reprehenderit officia dignissimos eos est. Placeat dolorem velit tenetur magnam tempora. Voluptas architecto ut dolore est unde et.\n\nNihil voluptate odit illo commodi architecto ex deleniti officia. Beatae corporis sed ab quas tenetur. Odit quo quidem aperiam eos quasi dolorem repellat. Velit vel perspiciatis officia. Tenetur amet sit modi ullam doloribus qui ab.', 'velit', 'images/dining/3.jpg', 125, 114, 0, 2, NULL, 0, 0, 1, '2018-04-13 16:50:43', '2018-04-25 13:46:31', '2018-04-25 13:46:31');
INSERT INTO `products` (`id`, `user_id`, `brand_id`, `collection_id`, `set_id`, `title`, `slug`, `short`, `body`, `body2`, `code`, `image`, `price`, `price_outlet`, `views`, `amount`, `color`, `discount`, `sold`, `publish`, `publish_at`, `created_at`, `updated_at`) VALUES
(179, 1, 4, NULL, 0, 'Accusamus et voluptatum omnis ut dolores.', 'accusamus-et-voluptatum-omnis-ut-dolores', 'Impedit voluptatum dolorum sint tenetur quaerat. Sunt quisquam excepturi quasi voluptatibus et. Vitae placeat voluptatem qui a perferendis. Et quasi aut qui velit sapiente.', 'Temporibus cum quis et accusamus laborum est. Repellendus aut est occaecati aut vel.\n\nCumque ullam assumenda aliquid suscipit. A eveniet dolorem numquam vero. Ex expedita repellendus dignissimos voluptas. Nulla dolores incidunt a nam quia.\n\nOccaecati adipisci tenetur voluptatem reiciendis. Autem et minima voluptatem ipsam. Ratione quo rerum sit.', 'Harum ut culpa saepe assumenda. Dolores esse sunt officiis et placeat porro veniam. Omnis rerum autem fugiat qui quia.\n\nMinima molestiae tempora officiis ducimus unde iusto quibusdam. Placeat placeat consequatur in nostrum. Commodi autem mollitia qui deleniti. Voluptate tempora et ut nihil.\n\nSaepe sequi delectus perferendis. Officia maxime qui quis dolor ipsum aliquid optio. Ex accusamus odio distinctio error in esse voluptas. Est aut debitis voluptatem dignissimos et.', 'recusandae', 'images/dining/3.jpg', 118, 139, 0, 1, NULL, 0, 0, 1, '2018-04-21 05:36:37', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(180, 1, 4, NULL, 0, 'Provident qui animi totam fugiat voluptatum odio ipsum labore.', 'provident-qui-animi-totam-fugiat-voluptatum-odio-ipsum-labore', 'Quae et quas reprehenderit in atque animi hic. Velit ratione consequatur saepe velit voluptatem. Impedit recusandae quo voluptatem aperiam autem. Qui eos fuga modi.', 'Qui porro et facere quia magnam cumque. Nesciunt error aut officia omnis. Animi possimus vitae vero laboriosam reprehenderit autem occaecati.\n\nIusto laborum similique non. Quia nihil cupiditate animi dolores. Tenetur similique omnis occaecati dolore. Assumenda distinctio error reiciendis quas tempora odit.\n\nUnde accusantium sequi aut quam vel maxime omnis. Est aut sunt dolores eaque dolorum et. Quo consectetur officiis quisquam temporibus enim.', 'Illum minima expedita ut magnam repudiandae non. Assumenda commodi tenetur delectus atque quidem ut. Quibusdam aut fuga architecto non et nostrum. At iure dolor officia animi modi.\n\nRerum consequatur tempore tempore nobis voluptas aliquam. Dignissimos ut id molestias rerum et accusamus rerum. Mollitia eius cum sed nihil.\n\nMolestias quos eos temporibus qui hic maxime. Commodi recusandae voluptas excepturi iste.', 'eum', 'images/dining/3.jpg', 113, 126, 0, 1, NULL, 0, 0, 1, '2018-04-07 04:36:52', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(181, 1, 4, NULL, 0, 'Et voluptas dolore aspernatur saepe officia.', 'et-voluptas-dolore-aspernatur-saepe-officia', 'Id omnis quia pariatur nisi odit. Tenetur dolorem numquam ea et vero. Inventore ratione ipsam hic rerum veritatis natus voluptatem. Eius saepe quasi enim possimus. Voluptates quod dolor suscipit dolorem.', 'Et odio occaecati odio impedit quia quia. Nihil dolores ea porro provident accusantium et aut debitis. Voluptas officiis dignissimos eum iusto id.\n\nItaque consectetur voluptate rerum non rerum ea consequuntur. Quis deserunt temporibus aperiam eveniet harum.\n\nNihil libero aut quis blanditiis quasi facilis aut. Aspernatur eveniet nam placeat dolor ea voluptas. Voluptas molestiae asperiores repudiandae officia et.', 'Sapiente nulla inventore doloribus. In fuga aliquid minus. Voluptatem inventore aut iste cum amet.\n\nRerum occaecati enim velit cumque voluptates fuga dolorem. Molestias cupiditate ipsum velit earum tempore dolorem occaecati iusto. Dignissimos ipsum et rem quia quos perspiciatis. Modi reprehenderit praesentium sed hic voluptas.\n\nUt illo ad aliquam quisquam dolorem dolores. Culpa perspiciatis ipsum magnam consequatur. Asperiores temporibus aut provident. Sed cum quo aut reprehenderit.', 'incidunt', 'images/dining/3.jpg', 207, 141, 0, 1, NULL, 0, 0, 1, '2018-04-15 00:53:05', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(182, 1, 4, NULL, 0, 'Perspiciatis debitis et non et.', 'perspiciatis-debitis-et-non-et', 'Molestiae enim est earum ullam. Voluptates et omnis vitae facere. Aut est hic maxime nobis. Quia qui omnis nisi sed ut voluptate numquam.', 'Totam sed deleniti cum velit. Dignissimos explicabo soluta eligendi ut est est nostrum ut. Qui magnam ut sint eaque enim. Fugiat sapiente maiores praesentium maiores vel.\n\nConsequatur quia fuga placeat nulla. Similique provident consectetur porro. Laborum voluptatem quisquam consectetur nesciunt. Aliquam provident id blanditiis dolor ullam.\n\nEaque qui ea sint enim aut aliquid amet. Dolorum mollitia velit autem aut consequatur. Harum fuga totam ipsa dolores ipsa repellat. Nesciunt occaecati quam maiores molestiae ducimus iure.', 'Quia veritatis velit aut amet odio. Molestiae adipisci provident cumque suscipit veritatis. Earum consequuntur maxime nemo quam. Facere qui nesciunt ipsum esse et praesentium deserunt.\n\nQui quae ducimus ipsum. Et temporibus aliquid nulla reiciendis. Laudantium eveniet qui quis at aut quis reiciendis. Amet dolor maiores odio beatae voluptatibus libero.\n\nEt saepe laudantium assumenda quae quasi autem dicta. Sunt alias sequi sit eius cupiditate eos nobis minima. Atque et et nemo corporis dolorem unde error.', 'incidunt', 'images/dining/3.jpg', 228, 143, 0, 2, NULL, 0, 0, 1, '2018-04-01 10:09:04', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(183, 1, 4, NULL, 0, 'Soluta atque aut reprehenderit ipsum molestiae quia aspernatur.', 'soluta-atque-aut-reprehenderit-ipsum-molestiae-quia-aspernatur', 'Corporis suscipit quas sapiente dicta ut aliquid ut ipsam. Non ipsam illo aspernatur tempora. Sed minus et possimus sed quae consequatur modi.', 'Aliquam incidunt occaecati tempora nobis doloribus. Provident possimus temporibus rerum dolorem. Culpa reprehenderit dolor id expedita doloremque voluptatum. Veritatis aut animi sit libero.\n\nSit laboriosam nihil quis nulla doloremque eos. Cum tempore est voluptatum consectetur occaecati. Qui voluptatum vitae non dolor non est consequuntur.\n\nEst qui corporis eum odio qui nulla ut. Quis voluptatem itaque voluptate ipsa modi expedita laudantium. Quis consequuntur inventore pariatur ea quis id. Omnis corporis quo id odit rerum aliquam consequatur veritatis. Voluptatum quo similique maiores voluptas.', 'Voluptatem aperiam quis ex ut. In est ex nisi sed facilis. Asperiores sunt hic magni repellendus aut voluptatem.\n\nOfficiis qui quia atque. Quasi sapiente eius omnis laborum. Voluptate non omnis nesciunt error.\n\nQuam quasi est cumque ad id. Laboriosam quae ut voluptatum maiores dolores. Eveniet id excepturi quam accusantium. Repellendus soluta ea maiores voluptas sit totam. Incidunt quisquam velit facilis fugiat ea quia quia asperiores.', 'minima', 'images/dining/3.jpg', 224, 142, 0, 3, NULL, 0, 0, 1, '2018-04-24 12:43:47', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(184, 1, 4, NULL, 0, 'Laboriosam maiores aut corporis id et est.', 'laboriosam-maiores-aut-corporis-id-et-est', 'A vel libero sed. Eos facere ratione est officiis corporis. Eius inventore ratione quia quisquam quidem hic amet. Tenetur rerum qui odio quia tempora odio odio velit. Voluptas quasi nisi libero dolorem.', 'Provident ut debitis aut neque voluptatem et sunt repellat. Aspernatur inventore mollitia atque quia vel fugit sint at.\n\nSed est et blanditiis officiis. Rem molestiae occaecati tenetur iste ut velit et. Ipsum sapiente voluptates dicta id. Voluptatum tempora optio velit sed quae velit.\n\nVoluptate consequatur ad maxime. Eius reiciendis ducimus consequatur. Quo alias qui ut dolorum. Voluptatem odit dolorem ea.', 'Repudiandae in dignissimos eos debitis delectus. Est similique sunt sint omnis doloribus. Expedita dolorem ut reiciendis suscipit.\n\nNostrum deleniti voluptas dicta qui at possimus. Ut animi sunt quia suscipit. Veritatis minus a debitis quia laborum ut. Ab est quo vitae quia quis quibusdam.\n\nQui laboriosam est sint id totam corrupti dolores quibusdam. Est quidem earum enim enim natus rerum alias. Soluta cupiditate dolores cum libero. Ducimus nihil cum fugiat at quam explicabo. Et voluptas consequatur aspernatur inventore.', 'distinctio', 'images/dining/3.jpg', 108, 146, 0, 2, NULL, 0, 0, 1, '2018-04-15 10:09:27', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(185, 1, 4, NULL, 0, 'Qui sit repellendus ut illum nisi voluptatibus culpa et.', 'qui-sit-repellendus-ut-illum-nisi-voluptatibus-culpa-et', 'Aliquam nihil commodi quia iusto eum est. Accusamus sint optio asperiores et. Ducimus eos laudantium dolore placeat recusandae. Modi perferendis eos hic veniam ipsam molestias sed ut.', 'Cupiditate aut et ut. Optio possimus earum qui quae voluptas veritatis soluta. Velit dignissimos quo optio voluptatem aspernatur.\n\nMinus rerum sint asperiores cum. Et debitis facere voluptates consequatur. Fugiat tempore aut in possimus aspernatur autem. Hic deserunt itaque tempora harum molestiae facilis et.\n\nSint consequuntur quia et officia aliquid ut officia. Mollitia veniam voluptas necessitatibus adipisci dolores temporibus. Pariatur et laboriosam recusandae veniam nemo expedita ipsa.', 'Eum rem et sunt in sint blanditiis. Atque ab iusto harum rerum vel quidem provident. Dicta est sit sapiente.\n\nAut quia consequuntur sunt enim debitis. Eos voluptate rem qui quo odit. Magni qui recusandae repellat deleniti optio laboriosam aut.\n\nIn rem qui aut numquam vitae. Saepe incidunt nisi at ducimus qui porro reprehenderit. Quia qui amet repellat reiciendis porro hic. Et quaerat praesentium eos nostrum voluptatem.', 'reprehenderit', 'images/dining/3.jpg', 248, 130, 0, 1, NULL, 0, 0, 1, '2018-04-19 09:48:20', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(186, 1, 4, NULL, 0, 'Velit labore est harum suscipit laudantium dolor commodi.', 'velit-labore-est-harum-suscipit-laudantium-dolor-commodi', 'Praesentium molestiae eius commodi quia omnis deleniti. Alias doloremque saepe rerum omnis aut illo.', 'Vel et necessitatibus ut amet. Cupiditate sit quia esse voluptatem minus. Quia perferendis sit et ipsam. Ipsa non et possimus alias est.\n\nAt at voluptas sunt accusamus est accusantium. Quaerat vitae et molestiae nihil ut enim. Aliquam enim ut nihil maxime. Quia optio rerum ipsam praesentium.\n\nVeniam veniam quia iusto quam est et harum. Qui sed placeat sunt laboriosam sed. Eos reiciendis modi occaecati reiciendis veniam delectus sed.', 'Est odio eius hic. Nam qui asperiores tempora dolorum perspiciatis. Esse cum molestiae non dolores sint. Esse facilis nostrum quam voluptas.\n\nQui eum repudiandae autem omnis. Et porro est sed eum consequuntur voluptatem. Minus in sapiente id fugiat. Libero nemo cum voluptatem.\n\nNon aut id aut quam voluptate et qui qui. Dignissimos voluptatem ipsum provident magni quidem. Ullam esse esse est ut sint est quis.', 'eos', 'images/dining/3.jpg', 266, 112, 0, 1, NULL, 0, 0, 1, '2018-04-09 06:54:51', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(187, 1, 4, NULL, 0, 'Impedit ducimus quae consequatur voluptatum aperiam architecto accusamus eos.', 'impedit-ducimus-quae-consequatur-voluptatum-aperiam-architecto-accusamus-eos', 'Dolorum nihil quo consequatur quam cupiditate quo. Iusto fuga non maiores culpa. Dolor dolorem voluptatem accusamus consequatur. Numquam qui possimus quisquam ipsum.', 'Doloribus quisquam iure occaecati autem quia aliquam nihil. Nostrum provident perferendis molestiae fugit temporibus. Soluta veniam enim dolore qui rerum nihil eveniet.\n\nExplicabo ullam minima beatae et. Maiores id unde nihil atque rem. Et dolor qui qui fugiat id sint. Est doloribus in consequatur quisquam maxime.\n\nOmnis saepe et pariatur. Quod atque consequatur rerum ad. Omnis quisquam ut ad et rerum asperiores inventore.', 'Animi in qui alias suscipit dolorem illo et. Ratione ratione eum voluptatum labore. Voluptas dignissimos reprehenderit id repellendus. Et autem facere ab.\n\nSed itaque in delectus expedita. Praesentium nihil delectus omnis rerum ex non aut. Cum odio dolorum enim aut omnis distinctio ipsum.\n\nDicta nobis cupiditate placeat ut quia. Et est sunt adipisci iusto sed temporibus nihil.', 'doloribus', 'images/dining/3.jpg', 227, 100, 0, 3, NULL, 0, 0, 1, '2018-03-26 21:19:18', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(188, 1, 4, NULL, 0, 'Sed voluptatem est ipsam consequatur sequi unde voluptatem atque.', 'sed-voluptatem-est-ipsam-consequatur-sequi-unde-voluptatem-atque', 'Natus et ducimus vitae placeat illum eos. Autem ut voluptate odio et et.', 'Aspernatur necessitatibus possimus sed minima voluptatem sit. Amet excepturi nemo necessitatibus in fuga facere. Corrupti perspiciatis ut eius.\n\nEt officiis aut autem saepe nostrum voluptates. Est maxime quis porro.\n\nSuscipit nam ipsum vel optio illo. Quis aliquam quia dolores quam minus.', 'Placeat aut incidunt dignissimos commodi sit dolorem sit. Vel saepe error provident cumque rerum qui. Ut harum quas nulla labore.\n\nAut molestiae et blanditiis consectetur explicabo qui. Odio eum saepe unde non ut et. Eius laborum aspernatur commodi magnam.\n\nQuae iure quo corrupti hic explicabo tempora qui. Quae velit velit aspernatur repudiandae harum commodi accusamus amet. Sunt iste nobis omnis ea consequatur.', 'rem', 'images/dining/3.jpg', 270, 100, 0, 2, NULL, 0, 0, 1, '2018-04-18 21:15:51', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(189, 1, 4, NULL, 0, 'Rerum iure laudantium qui voluptate.', 'rerum-iure-laudantium-qui-voluptate', 'Aut quo odit sit voluptates est autem voluptatem. Voluptatem aut vel veniam nesciunt eveniet. Deleniti cumque optio quia totam iure quasi nobis quasi. Tempore amet eius accusantium.', 'Assumenda necessitatibus voluptates distinctio consequatur ea. Itaque fuga delectus veniam assumenda. Qui sit quo vero.\n\nVoluptas amet labore sequi voluptatum quis totam esse. Quaerat necessitatibus eum debitis neque id libero ut. Minus id reiciendis quidem vel.\n\nItaque dolorum enim qui ea blanditiis. Porro eos voluptatibus adipisci dolorem culpa optio quia. Veniam non voluptatem soluta quis qui enim veritatis.', 'Reprehenderit quis perferendis eum aperiam sunt fuga. Minima quia reprehenderit ut nostrum natus quae labore. Nulla omnis ipsa pariatur qui sit qui sit. Velit nesciunt magnam assumenda voluptatem praesentium deserunt dolorum numquam.\n\nQuis ullam autem mollitia et nobis deserunt. Ea molestiae sit molestias voluptates. Debitis quibusdam laboriosam voluptas distinctio. Qui debitis eos accusantium sed iure.\n\nEx nemo corporis modi qui beatae. Culpa corporis et enim dicta corrupti consequatur. Officiis ea et qui at dolores.', 'rerum', 'images/dining/3.jpg', 142, 93, 0, 2, NULL, 0, 0, 1, '2018-04-20 20:20:51', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(190, 1, 4, NULL, 0, 'Saepe voluptatibus labore quae sint.', 'saepe-voluptatibus-labore-quae-sint', 'Fugit asperiores soluta excepturi ipsam atque. Et quo voluptas et ipsum dolorum blanditiis dolore. Sed vero fugit cum blanditiis.', 'Quia non vitae ad officiis aliquid. Voluptate omnis et possimus eum molestiae voluptas. Expedita aut deserunt molestias occaecati id qui at.\n\nAut dolorum quas ut eveniet dolorum delectus molestias. Corrupti consequuntur sed ut quis. Magnam et quo quia eum. Vitae quae quia maiores aliquam. Reiciendis ab harum dicta fuga necessitatibus ratione.\n\nRepudiandae impedit fuga perferendis et quas. Ut qui quis dignissimos possimus et dolorem nihil. Harum quisquam rerum in aspernatur amet. Explicabo sunt nisi alias.', 'Dolore quia nemo excepturi porro accusamus qui. Modi eos vero ipsum cumque at. Sunt qui est quam. Facere sed voluptatibus sint ad eum.\n\nVitae eveniet architecto nam iure molestiae assumenda eius. Voluptatem ea corrupti reprehenderit similique in repellat. Voluptates adipisci quis quis ut.\n\nEaque quia nemo et et a velit. Illo qui perspiciatis consequatur minima. Recusandae non rerum est ut.', 'fugit', 'images/dining/3.jpg', 251, 90, 0, 3, NULL, 0, 0, 1, '2018-03-31 22:13:46', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(191, 1, 4, NULL, 0, 'Voluptas cumque vitae quasi quidem qui.', 'voluptas-cumque-vitae-quasi-quidem-qui', 'Incidunt officiis aperiam doloremque quae. Dolores et blanditiis ipsum aut id.', 'Distinctio soluta voluptatibus odit error illo. Velit tenetur et sunt mollitia rerum consequatur suscipit. Commodi doloribus ut ut sed blanditiis architecto incidunt sit. Ex nisi soluta eos quibusdam dolor. Cumque quaerat sed quia dolorum ullam blanditiis.\n\nQuis eligendi odio doloremque omnis aperiam aliquam. Officiis magni magnam dolor reprehenderit quo mollitia. Corporis est rerum saepe dolorem aliquid porro ullam. Qui incidunt ut debitis illo vel iusto alias.\n\nEveniet et ut consectetur itaque quas quisquam ut illum. Aut amet molestias sapiente tempore. Iste et est et laboriosam cumque modi ipsa.', 'Voluptates nihil laborum expedita aperiam temporibus. Totam sapiente sequi sapiente voluptates aspernatur laboriosam. Aut harum iste odio vel harum saepe nihil.\n\nQuisquam et reprehenderit minus error voluptatem esse. Optio voluptatibus sed saepe dolores nostrum culpa laboriosam consectetur. Consectetur blanditiis odit eveniet vel.\n\nQuis velit ea iusto pariatur error. Quod quis qui quos voluptas. Suscipit accusamus fuga minima quas qui.', 'aliquid', 'images/dining/3.jpg', 164, 100, 0, 1, NULL, 0, 0, 1, '2018-04-14 07:11:57', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(192, 1, 4, NULL, 0, 'Dolores alias fugit quo dolor quos saepe.', 'dolores-alias-fugit-quo-dolor-quos-saepe', 'Aut nobis perferendis numquam animi ipsa ratione voluptatem perspiciatis. Debitis cum quasi ipsa aut deleniti. Enim voluptates ut harum possimus ad impedit est. Atque dignissimos error ipsam porro.', 'Eum maxime iusto id maxime est non architecto. Consequatur qui deleniti illo non. Quia a laboriosam totam temporibus itaque distinctio.\n\nVoluptatum consectetur atque ullam sed. Aut ut dicta omnis qui dolores laudantium. Et deleniti itaque dolorum et eos perspiciatis.\n\nFuga velit odio iure qui. Qui officiis perspiciatis temporibus illo et. Dolores vel nulla hic quod. Hic ea dolore temporibus veniam.', 'Accusantium quod facilis labore magni necessitatibus. Commodi unde expedita dolores pariatur molestias dolor atque. Dolores et illo rem ut est reiciendis.\n\nEnim vel suscipit aut nihil animi quas. Harum quos eos veritatis quia non ut quo accusamus. Aperiam dolorum dolore ea laborum qui.\n\nProvident in maxime adipisci et. Expedita voluptas quia quae tenetur reprehenderit. Voluptate rerum quaerat voluptatem recusandae aliquid aut.', 'tempore', 'images/dining/3.jpg', 163, 128, 0, 2, NULL, 0, 0, 1, '2018-03-29 02:09:58', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(193, 1, 4, NULL, 0, 'Recusandae est sed non nemo odit quia sed.', 'recusandae-est-sed-non-nemo-odit-quia-sed', 'Iste ut reprehenderit officiis reiciendis. Libero quis est suscipit et. Sunt quidem unde accusantium voluptatem error et ipsa.', 'Delectus eum est non neque nihil molestias. Voluptatibus reprehenderit quibusdam nisi rerum quam. Beatae quisquam aliquid deleniti quo dignissimos quia sit.\n\nSed at corrupti iusto. Totam sunt et odio sed voluptatem. Occaecati corrupti rerum facere vel.\n\nIpsum dolorum et dolores animi. Autem laborum omnis itaque ea labore labore omnis. Nobis laudantium eos eius officia. Voluptatem id ea vero maiores nisi architecto.', 'Doloremque cumque quo ut porro nisi aut. Labore repellendus dolores consequatur voluptatem. Voluptate saepe accusantium reiciendis qui delectus non.\n\nVoluptatum non ad voluptatem labore quis qui. Sint ipsam est explicabo corporis voluptatibus autem consequatur suscipit. Modi dignissimos possimus soluta at.\n\nAliquam laborum quia ut fugiat eligendi aliquam soluta. Veritatis modi autem omnis accusantium odit quos. Minima et animi et dolor ut cupiditate sunt numquam. Totam excepturi velit necessitatibus facere.', 'veritatis', 'images/dining/3.jpg', 297, 88, 0, 1, NULL, 0, 0, 1, '2018-04-18 17:07:43', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(194, 1, 4, NULL, 0, 'Necessitatibus sint atque ut asperiores alias eaque harum.', 'necessitatibus-sint-atque-ut-asperiores-alias-eaque-harum', 'Ducimus iusto perferendis quas sint enim dolor tempore occaecati. Nostrum et vel explicabo error et fuga. Veritatis omnis quia molestiae quo quos repellendus itaque. Voluptatem impedit vel distinctio pariatur esse mollitia. Ut sed aut et deleniti pariatur', 'Ratione est consequatur ullam vel molestias unde. Laboriosam fugit nemo animi. Blanditiis id laborum enim pariatur cumque.\n\nEst dignissimos ratione asperiores nihil totam. Id omnis vel qui occaecati. Consequatur optio pariatur vitae rerum occaecati quas natus. Quo non recusandae iure aliquam.\n\nCulpa cum est voluptates minima non in. Magni aut quod alias ipsum sit quia doloremque. Facere sint saepe accusamus dolor dolore est ea. Quod quisquam minima nihil qui.', 'Et culpa et eos fuga exercitationem. Odio rerum possimus accusantium omnis minima quia. Consequatur et eligendi illum ipsa voluptas. Placeat libero voluptatem sunt distinctio expedita soluta in nihil. Neque molestias laboriosam rerum est nemo et.\n\nQuae aut ea provident tempora. Sit voluptatem sed beatae doloribus. Illo cum magni quia consectetur sequi suscipit blanditiis.\n\nEt corporis animi porro rem totam ad accusantium. Impedit sit ut aut eaque quisquam doloribus aliquam. Molestiae expedita repudiandae nihil minus. A sed et maxime rerum molestiae earum eaque.', 'sunt', 'images/dining/3.jpg', 196, 108, 0, 2, NULL, 0, 0, 1, '2018-04-13 18:32:31', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(195, 1, 4, NULL, 0, 'Voluptates vel quasi exercitationem non.', 'voluptates-vel-quasi-exercitationem-non', 'Officiis quis laborum veritatis impedit reprehenderit voluptatem rerum. Eveniet hic sit qui illo et iusto. Amet et excepturi provident libero dolor. Tempora velit et est itaque dolor. Est ea autem a et.', 'Eligendi in deleniti iusto autem sit cumque. Magni quia tempore in quo. Est dolores corporis accusantium aperiam cumque incidunt culpa. Sit magni ut praesentium est.\n\nAssumenda nesciunt eligendi dolore numquam nemo sed a. Facere at optio at illo. Veritatis et at eveniet autem. Repellat quia alias vero sed necessitatibus aliquam.\n\nVoluptates molestiae totam et rerum. Qui necessitatibus corrupti iste et aliquam. Quo quam tenetur ut vero et facilis. Et quam corrupti ut.', 'Aut perferendis mollitia consequatur quibusdam rerum magnam. Vel omnis quae deserunt placeat corrupti accusamus culpa laudantium. Doloremque at suscipit officiis et est.\n\nHarum explicabo rem et officia rerum. Quis quaerat ad aut architecto amet fugit. Ex ut dicta alias pariatur facere ut.\n\nRepellendus repellendus debitis ab voluptas velit necessitatibus. Dolor expedita nihil rerum asperiores perspiciatis.', 'voluptatem', 'images/dining/3.jpg', 268, 99, 0, 1, NULL, 0, 0, 1, '2018-04-17 12:35:25', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(196, 1, 4, NULL, 0, 'Officia sed qui quia possimus non.', 'officia-sed-qui-quia-possimus-non', 'Qui ea sed nam. Blanditiis qui nesciunt libero inventore dolores qui est.', 'Quia ratione impedit quis fugit rerum ea voluptatem velit. Eius quia labore et atque. Eos non aperiam natus exercitationem.\n\nQuis et voluptate eum sed sed sed inventore. Quasi atque vel enim aut voluptatem dolores veniam. Et labore repellendus mollitia quis velit sit. Distinctio neque aliquam iusto cupiditate impedit harum ipsam.\n\nDicta vel consequatur perspiciatis totam. Aspernatur at inventore voluptatem accusamus. Voluptate odio illum nulla. Vero laudantium numquam amet aliquid quia.', 'Iste dolorem voluptatem vitae rerum. Omnis nesciunt error quia. Et aut voluptatem voluptatem et impedit dolorem reprehenderit.\n\nBeatae ut doloremque dolorem. Iusto quasi blanditiis rerum et autem eos. At ullam adipisci magnam pariatur architecto error.\n\nEum esse veniam vero amet quisquam. Numquam veritatis sed aut itaque omnis. Illum consectetur qui neque sapiente error. Quis dolorum qui ad sunt tenetur eum accusantium.', 'et', 'images/dining/3.jpg', 226, 122, 0, 1, NULL, 0, 0, 1, '2018-04-04 23:44:33', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(197, 1, 4, NULL, 0, 'Ex quibusdam quia et iure assumenda dolore.', 'ex-quibusdam-quia-et-iure-assumenda-dolore', 'Eius id tempora amet iure dolorum enim error. Qui aut minus cumque natus molestiae neque. Eligendi et eligendi reprehenderit velit sed cumque quisquam similique.', 'Hic vel enim id consequuntur quo aut temporibus. Et repellendus ut labore quia adipisci beatae. Sunt quas quos voluptatem quia aliquam aut accusamus.\n\nDucimus maxime consectetur eligendi quia repellat sint. Officia quos est mollitia et minus dolores corrupti aliquid. Ipsa et qui omnis cumque asperiores.\n\nRecusandae consequatur aut neque omnis iusto. Molestiae atque eveniet libero sequi unde illum est ducimus. Occaecati assumenda labore et nam repellat. Eos sed in rem sit est quae asperiores sint. Deserunt cum quia maiores animi.', 'Vel soluta aperiam quia vero eos. Et ut veniam autem veniam optio. Maxime sunt voluptas recusandae est officia omnis. Expedita omnis ut occaecati iusto.\n\nUt ullam blanditiis omnis doloribus. Voluptates totam placeat et sit et. Et qui modi eaque quo.\n\nConsectetur et eum deserunt repudiandae. Eius doloribus saepe aliquam expedita. Perferendis repudiandae eaque molestias consequatur exercitationem ipsam.', 'ducimus', 'images/dining/3.jpg', 238, 142, 0, 1, NULL, 0, 0, 1, '2018-04-22 07:15:47', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(198, 1, 4, NULL, 0, 'Omnis incidunt dolor aut rerum necessitatibus ut.', 'omnis-incidunt-dolor-aut-rerum-necessitatibus-ut', 'Ratione minus saepe sequi repudiandae sapiente. Recusandae est accusantium deserunt est. Earum ut vel laboriosam cupiditate est et.', 'Aut assumenda blanditiis officiis enim. Porro inventore quia consequatur quia explicabo facere qui. Recusandae possimus qui rem dolorem. Qui quia id beatae quae et sit.\n\nVoluptatem iusto deserunt omnis aut. Tempora voluptatem libero et animi. Architecto labore enim non necessitatibus cum.\n\nEt laudantium rerum eligendi numquam harum architecto. Est minima quos ullam voluptatem voluptas animi. Deserunt officia est placeat a est cumque qui. Alias suscipit quas expedita. Veniam corrupti enim assumenda labore.', 'Eum quaerat veniam sit voluptatem commodi enim. Qui dolor nulla deserunt cum quis sunt. Fugit sit architecto hic repudiandae. Dolore molestiae quia suscipit et vitae voluptatem modi. Non cumque molestias corporis tempore aspernatur minima ut sequi.\n\nVoluptas est consequuntur et error. Aut occaecati tempora a. Placeat et perspiciatis quasi doloribus ducimus earum numquam.\n\nFugit aut omnis eum. Sunt sint nihil est sed vel aut quisquam. Quam ad ad a sed amet veritatis. Rem praesentium at natus esse labore.', 'sunt', 'images/dining/3.jpg', 179, 118, 0, 2, NULL, 0, 0, 1, '2018-03-28 04:25:36', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(199, 1, 4, NULL, 0, 'Labore neque iusto velit sapiente non dolores quis cum.', 'labore-neque-iusto-velit-sapiente-non-dolores-quis-cum', 'Porro libero qui et. Et quia ullam illo saepe quia. Enim et dicta sint fuga.', 'Ipsum quasi nostrum natus cupiditate. Ut rerum illo numquam. Qui quia neque similique.\n\nCum dolorum numquam cum accusamus aut et explicabo at. Reprehenderit voluptas repudiandae sapiente commodi soluta. Dolorum illum nemo ratione reprehenderit eos ut. Aspernatur consequatur corporis et ex amet laboriosam.\n\nAb fugit nihil sequi. Et rerum placeat eaque sit est tempore. Consequuntur aperiam eius perspiciatis hic. Excepturi quis dolore sed.', 'Optio quae rem qui tempora cum libero corrupti. Ipsa sed quos voluptates doloremque mollitia dicta.\n\nVel minus qui rerum. Libero adipisci error id repellendus qui necessitatibus. Et accusamus rerum sit aspernatur animi error. Deserunt voluptas officiis voluptate nihil esse rerum autem.\n\nFugit quis tenetur deleniti. Non doloribus sit quia. Explicabo praesentium illo nihil eum sit sunt corrupti.', 'et', 'images/dining/3.jpg', 225, 125, 0, 2, NULL, 0, 0, 1, '2018-04-19 01:01:02', '2018-04-25 13:46:31', '2018-04-25 13:46:31'),
(200, 1, 4, NULL, 0, 'Molestiae quibusdam in velit consequatur quas voluptatem commodi at.', 'molestiae-quibusdam-in-velit-consequatur-quas-voluptatem-commodi-at', 'Eum consequatur similique fuga accusamus eligendi labore minus. Consequatur in doloremque rerum.', 'Ab aut pariatur voluptas magnam. Vel est aut culpa ad. Et sunt accusamus aliquid adipisci et aut vitae. Nesciunt quod voluptatem dolorem dicta doloribus doloremque quidem numquam.\n\nMolestias iusto aut voluptas quaerat reprehenderit qui. Magnam quia assumenda inventore praesentium cupiditate et. Sequi officiis dolore consequuntur maxime voluptate culpa. Ab libero deleniti quos sequi minus minima similique omnis.\n\nAtque necessitatibus aspernatur impedit est sint quis voluptatem. Eos nam officia omnis id. Aspernatur sequi et voluptatum aliquid pariatur quia. Consequatur quod in dolores culpa ipsam exercitationem.', 'Eos vel omnis dolor iste est repudiandae autem. Mollitia qui quae qui aut. Amet vero cumque laborum nihil et doloremque id. Deleniti non voluptas quas sit quidem impedit dolores.\n\nEum quia ad adipisci facere error itaque. Pariatur est quo autem labore distinctio nemo assumenda. Vel qui molestias sint quo consectetur.\n\nAtque perspiciatis blanditiis et numquam. Excepturi et qui voluptatem. Sunt vel velit voluptatem facilis ut reiciendis ratione. Sed reprehenderit enim modi maiores aut consequatur.', 'dolores', 'images/dining/3.jpg', 242, 110, 0, 2, NULL, 0, 0, 1, '2018-04-22 19:32:14', '2018-04-25 13:46:31', '2018-04-25 13:46:31');

-- --------------------------------------------------------

--
-- Table structure for table `product_tag`
--

DROP TABLE IF EXISTS `product_tag`;
CREATE TABLE IF NOT EXISTS `product_tag` (
  `product_id` int(10) UNSIGNED NOT NULL,
  `tag_id` int(10) UNSIGNED NOT NULL,
  KEY `product_tag_product_id_index` (`product_id`),
  KEY `product_tag_tag_id_index` (`tag_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_tag`
--

INSERT INTO `product_tag` (`product_id`, `tag_id`) VALUES
(1, 2),
(1, 45),
(1, 3),
(1, 7),
(1, 8),
(2, 2),
(2, 45),
(2, 3),
(2, 7),
(2, 8),
(3, 2),
(3, 45),
(3, 3),
(3, 7),
(3, 8),
(4, 2),
(4, 45),
(4, 3),
(4, 7),
(4, 8),
(5, 2),
(5, 45),
(5, 3),
(5, 7),
(5, 8),
(6, 2),
(6, 45),
(6, 3),
(6, 7),
(6, 8),
(7, 2),
(7, 45),
(7, 3),
(7, 7),
(7, 8),
(8, 2),
(8, 45),
(8, 3),
(8, 7),
(8, 8),
(9, 2),
(9, 45),
(9, 3),
(9, 7),
(9, 8),
(10, 2),
(10, 45),
(10, 3),
(10, 7),
(10, 8),
(11, 2),
(11, 45),
(11, 3),
(11, 7),
(11, 8),
(12, 2),
(12, 45),
(12, 3),
(12, 7),
(12, 8),
(13, 2),
(13, 45),
(13, 3),
(13, 7),
(13, 8),
(14, 2),
(14, 45),
(14, 3),
(14, 7),
(14, 8),
(15, 2),
(15, 45),
(15, 3),
(15, 7),
(15, 8),
(16, 2),
(16, 45),
(16, 3),
(16, 7),
(16, 8),
(17, 2),
(17, 45),
(17, 3),
(17, 7),
(17, 8),
(18, 2),
(18, 45),
(18, 3),
(18, 7),
(18, 8),
(19, 2),
(19, 45),
(19, 3),
(19, 7),
(19, 8),
(20, 2),
(20, 45),
(20, 3),
(20, 7),
(20, 8),
(21, 2),
(21, 45),
(21, 3),
(21, 7),
(21, 8),
(22, 2),
(22, 45),
(22, 3),
(22, 7),
(22, 8),
(23, 2),
(23, 45),
(23, 3),
(23, 7),
(23, 8),
(24, 2),
(24, 45),
(24, 3),
(24, 7),
(24, 8),
(25, 2),
(25, 45),
(25, 3),
(25, 7),
(25, 8),
(26, 2),
(26, 45),
(26, 3),
(26, 7),
(26, 8),
(27, 2),
(27, 45),
(27, 3),
(27, 7),
(27, 8),
(28, 2),
(28, 45),
(28, 3),
(28, 7),
(28, 8),
(29, 2),
(29, 45),
(29, 3),
(29, 7),
(29, 8),
(30, 2),
(30, 45),
(30, 3),
(30, 7),
(30, 8),
(31, 2),
(31, 45),
(31, 3),
(31, 7),
(31, 8),
(32, 2),
(32, 45),
(32, 3),
(32, 7),
(32, 8),
(33, 2),
(33, 45),
(33, 3),
(33, 7),
(33, 8),
(34, 2),
(34, 45),
(34, 3),
(34, 7),
(34, 8),
(35, 2),
(35, 45),
(35, 3),
(35, 7),
(35, 8),
(36, 2),
(36, 45),
(36, 3),
(36, 7),
(36, 8),
(37, 2),
(37, 45),
(37, 3),
(37, 7),
(37, 8),
(38, 2),
(38, 45),
(38, 3),
(38, 7),
(38, 8),
(39, 2),
(39, 45),
(39, 3),
(39, 7),
(39, 8),
(40, 2),
(40, 45),
(40, 3),
(40, 7),
(40, 8),
(41, 2),
(41, 45),
(41, 3),
(41, 7),
(41, 8),
(42, 2),
(42, 45),
(42, 3),
(42, 7),
(42, 8),
(43, 2),
(43, 45),
(43, 3),
(43, 7),
(43, 8),
(44, 2),
(44, 45),
(44, 3),
(44, 7),
(44, 8),
(45, 2),
(45, 45),
(45, 3),
(45, 7),
(45, 8),
(46, 2),
(46, 45),
(46, 3),
(46, 7),
(46, 8),
(47, 2),
(47, 45),
(47, 3),
(47, 7),
(47, 8),
(48, 2),
(48, 45),
(48, 3),
(48, 7),
(48, 8),
(49, 2),
(49, 45),
(49, 3),
(49, 7),
(49, 8),
(50, 2),
(50, 45),
(50, 3),
(50, 7),
(50, 8),
(51, 12),
(51, 22),
(51, 13),
(51, 37),
(51, 48),
(52, 12),
(52, 22),
(52, 13),
(52, 37),
(52, 48),
(53, 12),
(53, 22),
(53, 13),
(53, 37),
(53, 48),
(54, 12),
(54, 22),
(54, 13),
(54, 37),
(54, 48),
(55, 12),
(55, 22),
(55, 13),
(55, 37),
(55, 48),
(56, 12),
(56, 22),
(56, 13),
(56, 37),
(56, 48),
(57, 12),
(57, 22),
(57, 13),
(57, 37),
(57, 48),
(58, 12),
(58, 22),
(58, 13),
(58, 37),
(58, 48),
(59, 12),
(59, 22),
(59, 13),
(59, 37),
(59, 48),
(60, 12),
(60, 22),
(60, 13),
(60, 37),
(60, 48),
(61, 12),
(61, 22),
(61, 13),
(61, 37),
(61, 48),
(62, 12),
(62, 22),
(62, 13),
(62, 37),
(62, 48),
(63, 12),
(63, 22),
(63, 13),
(63, 37),
(63, 48),
(64, 12),
(64, 22),
(64, 13),
(64, 37),
(64, 48),
(65, 12),
(65, 22),
(65, 13),
(65, 37),
(65, 48),
(66, 12),
(66, 22),
(66, 13),
(66, 37),
(66, 48),
(67, 12),
(67, 22),
(67, 13),
(67, 37),
(67, 48),
(68, 12),
(68, 22),
(68, 13),
(68, 37),
(68, 48),
(69, 12),
(69, 22),
(69, 13),
(69, 37),
(69, 48),
(70, 12),
(70, 22),
(70, 13),
(70, 37),
(70, 48),
(71, 12),
(71, 22),
(71, 13),
(71, 37),
(71, 48),
(72, 12),
(72, 22),
(72, 13),
(72, 37),
(72, 48),
(73, 12),
(73, 22),
(73, 13),
(73, 37),
(73, 48),
(74, 12),
(74, 22),
(74, 13),
(74, 37),
(74, 48),
(75, 12),
(75, 22),
(75, 13),
(75, 37),
(75, 48),
(76, 12),
(76, 22),
(76, 13),
(76, 37),
(76, 48),
(77, 12),
(77, 22),
(77, 13),
(77, 37),
(77, 48),
(78, 12),
(78, 22),
(78, 13),
(78, 37),
(78, 48),
(79, 12),
(79, 22),
(79, 13),
(79, 37),
(79, 48),
(80, 12),
(80, 22),
(80, 13),
(80, 37),
(80, 48),
(81, 12),
(81, 22),
(81, 13),
(81, 37),
(81, 48),
(82, 12),
(82, 22),
(82, 13),
(82, 37),
(82, 48),
(83, 12),
(83, 22),
(83, 13),
(83, 37),
(83, 48),
(84, 12),
(84, 22),
(84, 13),
(84, 37),
(84, 48),
(85, 12),
(85, 22),
(85, 13),
(85, 37),
(85, 48),
(86, 12),
(86, 22),
(86, 13),
(86, 37),
(86, 48),
(87, 12),
(87, 22),
(87, 13),
(87, 37),
(87, 48),
(88, 12),
(88, 22),
(88, 13),
(88, 37),
(88, 48),
(89, 12),
(89, 22),
(89, 13),
(89, 37),
(89, 48),
(90, 12),
(90, 22),
(90, 13),
(90, 37),
(90, 48),
(91, 12),
(91, 22),
(91, 13),
(91, 37),
(91, 48),
(92, 12),
(92, 22),
(92, 13),
(92, 37),
(92, 48),
(93, 12),
(93, 22),
(93, 13),
(93, 37),
(93, 48),
(94, 12),
(94, 22),
(94, 13),
(94, 37),
(94, 48),
(95, 12),
(95, 22),
(95, 13),
(95, 37),
(95, 48),
(96, 12),
(96, 22),
(96, 13),
(96, 37),
(96, 48),
(97, 12),
(97, 22),
(97, 13),
(97, 37),
(97, 48),
(98, 12),
(98, 22),
(98, 13),
(98, 37),
(98, 48),
(99, 12),
(99, 22),
(99, 13),
(99, 37),
(99, 48),
(100, 12),
(100, 22),
(100, 13),
(100, 37),
(100, 48),
(101, 4),
(101, 44),
(101, 23),
(101, 32),
(101, 48),
(102, 4),
(102, 44),
(102, 23),
(102, 32),
(102, 48),
(103, 4),
(103, 44),
(103, 23),
(103, 32),
(103, 48),
(104, 4),
(104, 44),
(104, 23),
(104, 32),
(104, 48),
(105, 4),
(105, 44),
(105, 23),
(105, 32),
(105, 48),
(106, 4),
(106, 44),
(106, 23),
(106, 32),
(106, 48),
(107, 4),
(107, 44),
(107, 23),
(107, 32),
(107, 48),
(108, 4),
(108, 44),
(108, 23),
(108, 32),
(108, 48),
(109, 4),
(109, 44),
(109, 23),
(109, 32),
(109, 48),
(110, 4),
(110, 44),
(110, 23),
(110, 32),
(110, 48),
(111, 4),
(111, 44),
(111, 23),
(111, 32),
(111, 48),
(112, 4),
(112, 44),
(112, 23),
(112, 32),
(112, 48),
(113, 4),
(113, 44),
(113, 23),
(113, 32),
(113, 48),
(114, 4),
(114, 44),
(114, 23),
(114, 32),
(114, 48),
(115, 4),
(115, 44),
(115, 23),
(115, 32),
(115, 48),
(116, 4),
(116, 44),
(116, 23),
(116, 32),
(116, 48),
(117, 4),
(117, 44),
(117, 23),
(117, 32),
(117, 48),
(118, 4),
(118, 44),
(118, 23),
(118, 32),
(118, 48),
(119, 4),
(119, 44),
(119, 23),
(119, 32),
(119, 48),
(120, 4),
(120, 44),
(120, 23),
(120, 32),
(120, 48),
(121, 4),
(121, 44),
(121, 23),
(121, 32),
(121, 48),
(122, 4),
(122, 44),
(122, 23),
(122, 32),
(122, 48),
(123, 4),
(123, 44),
(123, 23),
(123, 32),
(123, 48),
(124, 4),
(124, 44),
(124, 23),
(124, 32),
(124, 48),
(125, 4),
(125, 44),
(125, 23),
(125, 32),
(125, 48),
(126, 4),
(126, 44),
(126, 23),
(126, 32),
(126, 48),
(127, 4),
(127, 44),
(127, 23),
(127, 32),
(127, 48),
(128, 4),
(128, 44),
(128, 23),
(128, 32),
(128, 48),
(129, 4),
(129, 44),
(129, 23),
(129, 32),
(129, 48),
(130, 4),
(130, 44),
(130, 23),
(130, 32),
(130, 48),
(131, 4),
(131, 44),
(131, 23),
(131, 32),
(131, 48),
(132, 4),
(132, 44),
(132, 23),
(132, 32),
(132, 48),
(133, 4),
(133, 44),
(133, 23),
(133, 32),
(133, 48),
(134, 4),
(134, 44),
(134, 23),
(134, 32),
(134, 48),
(135, 4),
(135, 44),
(135, 23),
(135, 32),
(135, 48),
(136, 4),
(136, 44),
(136, 23),
(136, 32),
(136, 48),
(137, 4),
(137, 44),
(137, 23),
(137, 32),
(137, 48),
(138, 4),
(138, 44),
(138, 23),
(138, 32),
(138, 48),
(139, 4),
(139, 44),
(139, 23),
(139, 32),
(139, 48),
(140, 4),
(140, 44),
(140, 23),
(140, 32),
(140, 48),
(141, 4),
(141, 44),
(141, 23),
(141, 32),
(141, 48),
(142, 4),
(142, 44),
(142, 23),
(142, 32),
(142, 48),
(143, 4),
(143, 44),
(143, 23),
(143, 32),
(143, 48),
(144, 4),
(144, 44),
(144, 23),
(144, 32),
(144, 48),
(145, 4),
(145, 44),
(145, 23),
(145, 32),
(145, 48),
(146, 4),
(146, 44),
(146, 23),
(146, 32),
(146, 48),
(147, 4),
(147, 44),
(147, 23),
(147, 32),
(147, 48),
(148, 4),
(148, 44),
(148, 23),
(148, 32),
(148, 48),
(149, 4),
(149, 44),
(149, 23),
(149, 32),
(149, 48),
(150, 4),
(150, 44),
(150, 23),
(150, 32),
(150, 48),
(151, 6),
(151, 12),
(151, 7),
(151, 32),
(151, 48),
(152, 6),
(152, 12),
(152, 7),
(152, 32),
(152, 48),
(153, 6),
(153, 12),
(153, 7),
(153, 32),
(153, 48),
(154, 6),
(154, 12),
(154, 7),
(154, 32),
(154, 48),
(155, 6),
(155, 12),
(155, 7),
(155, 32),
(155, 48),
(156, 6),
(156, 12),
(156, 7),
(156, 32),
(156, 48),
(157, 6),
(157, 12),
(157, 7),
(157, 32),
(157, 48),
(158, 6),
(158, 12),
(158, 7),
(158, 32),
(158, 48),
(159, 6),
(159, 12),
(159, 7),
(159, 32),
(159, 48),
(160, 6),
(160, 12),
(160, 7),
(160, 32),
(160, 48),
(161, 6),
(161, 12),
(161, 7),
(161, 32),
(161, 48),
(162, 6),
(162, 12),
(162, 7),
(162, 32),
(162, 48),
(163, 6),
(163, 12),
(163, 7),
(163, 32),
(163, 48),
(164, 6),
(164, 12),
(164, 7),
(164, 32),
(164, 48),
(165, 6),
(165, 12),
(165, 7),
(165, 32),
(165, 48),
(166, 6),
(166, 12),
(166, 7),
(166, 32),
(166, 48),
(167, 6),
(167, 12),
(167, 7),
(167, 32),
(167, 48),
(168, 6),
(168, 12),
(168, 7),
(168, 32),
(168, 48),
(169, 6),
(169, 12),
(169, 7),
(169, 32),
(169, 48),
(170, 6),
(170, 12),
(170, 7),
(170, 32),
(170, 48),
(171, 6),
(171, 12),
(171, 7),
(171, 32),
(171, 48),
(172, 6),
(172, 12),
(172, 7),
(172, 32),
(172, 48),
(173, 6),
(173, 12),
(173, 7),
(173, 32),
(173, 48),
(174, 6),
(174, 12),
(174, 7),
(174, 32),
(174, 48),
(175, 6),
(175, 12),
(175, 7),
(175, 32),
(175, 48),
(176, 6),
(176, 12),
(176, 7),
(176, 32),
(176, 48),
(177, 6),
(177, 12),
(177, 7),
(177, 32),
(177, 48),
(178, 6),
(178, 12),
(178, 7),
(178, 32),
(178, 48),
(179, 6),
(179, 12),
(179, 7),
(179, 32),
(179, 48),
(180, 6),
(180, 12),
(180, 7),
(180, 32),
(180, 48),
(181, 6),
(181, 12),
(181, 7),
(181, 32),
(181, 48),
(182, 6),
(182, 12),
(182, 7),
(182, 32),
(182, 48),
(183, 6),
(183, 12),
(183, 7),
(183, 32),
(183, 48),
(184, 6),
(184, 12),
(184, 7),
(184, 32),
(184, 48),
(185, 6),
(185, 12),
(185, 7),
(185, 32),
(185, 48),
(186, 6),
(186, 12),
(186, 7),
(186, 32),
(186, 48),
(187, 6),
(187, 12),
(187, 7),
(187, 32),
(187, 48),
(188, 6),
(188, 12),
(188, 7),
(188, 32),
(188, 48),
(189, 6),
(189, 12),
(189, 7),
(189, 32),
(189, 48),
(190, 6),
(190, 12),
(190, 7),
(190, 32),
(190, 48),
(191, 6),
(191, 12),
(191, 7),
(191, 32),
(191, 48),
(192, 6),
(192, 12),
(192, 7),
(192, 32),
(192, 48),
(193, 6),
(193, 12),
(193, 7),
(193, 32),
(193, 48),
(194, 6),
(194, 12),
(194, 7),
(194, 32),
(194, 48),
(195, 6),
(195, 12),
(195, 7),
(195, 32),
(195, 48),
(196, 6),
(196, 12),
(196, 7),
(196, 32),
(196, 48),
(197, 6),
(197, 12),
(197, 7),
(197, 32),
(197, 48),
(198, 6),
(198, 12),
(198, 7),
(198, 32),
(198, 48),
(199, 6),
(199, 12),
(199, 7),
(199, 32),
(199, 48),
(200, 6),
(200, 12),
(200, 7),
(200, 32),
(200, 48);

-- --------------------------------------------------------

--
-- Table structure for table `properties`
--

DROP TABLE IF EXISTS `properties`;
CREATE TABLE IF NOT EXISTS `properties` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `set_id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order` int(11) NOT NULL DEFAULT '1',
  `extra` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `properties_set_id_index` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `property_set`
--

DROP TABLE IF EXISTS `property_set`;
CREATE TABLE IF NOT EXISTS `property_set` (
  `property_id` int(10) UNSIGNED NOT NULL,
  `set_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  KEY `property_set_property_id_index` (`property_id`),
  KEY `property_set_set_id_index` (`set_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sets`
--

DROP TABLE IF EXISTS `sets`;
CREATE TABLE IF NOT EXISTS `sets` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `short` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sets`
--

INSERT INTO `sets` (`id`, `title`, `slug`, `short`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'Satovi', 'satovi', NULL, 1, '2018-04-24 11:54:34', '2018-04-24 11:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `keywords` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `desc` text COLLATE utf8_unicode_ci,
  `footer` text COLLATE utf8_unicode_ci,
  `phone1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `phone2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email1` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email2` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `facebook` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `twitter` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `instagram` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `pinterest` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `google` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `analytics` text COLLATE utf8_unicode_ci,
  `map` text COLLATE utf8_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `title`, `address`, `keywords`, `desc`, `footer`, `phone1`, `phone2`, `email1`, `email2`, `facebook`, `twitter`, `instagram`, `pinterest`, `google`, `youtube`, `analytics`, `map`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`id`, `title`, `slug`, `publish`, `created_at`, `updated_at`) VALUES
(1, 'vel', 'vel', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(2, 'numquam', 'numquam', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(3, 'ut', 'ut', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(4, 'nesciunt', 'nesciunt', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(5, 'facilis', 'facilis', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(6, 'dolorem', 'dolorem', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(7, 'corporis', 'corporis', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(8, 'eos', 'eos', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(9, 'in', 'in', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(10, 'qui', 'qui', 1, '2018-04-25 13:42:40', '2018-04-25 13:42:40'),
(11, 'earum', 'earum', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(12, 'voluptate', 'voluptate', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(13, 'molestias', 'molestias', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(14, 'voluptatem', 'voluptatem', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(15, 'consequatur', 'consequatur', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(16, 'corporis', 'corporis', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(17, 'provident', 'provident', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(18, 'in', 'in', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(19, 'dignissimos', 'dignissimos', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(20, 'quam', 'quam', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(21, 'aut', 'aut', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(22, 'ab', 'ab', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(23, 'autem', 'autem', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(24, 'officiis', 'officiis', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(25, 'fugit', 'fugit', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(26, 'voluptatem', 'voluptatem', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(27, 'laborum', 'laborum', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(28, 'nemo', 'nemo', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(29, 'voluptatibus', 'voluptatibus', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(30, 'culpa', 'culpa', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(31, 'sit', 'sit', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(32, 'voluptatem', 'voluptatem', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(33, 'harum', 'harum', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(34, 'velit', 'velit', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(35, 'in', 'in', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(36, 'corporis', 'corporis', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(37, 'qui', 'qui', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(38, 'est', 'est', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(39, 'est', 'est', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(40, 'voluptates', 'voluptates', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(41, 'reiciendis', 'reiciendis', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(42, 'repellat', 'repellat', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(43, 'quia', 'quia', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(44, 'delectus', 'delectus', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(45, 'aperiam', 'aperiam', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(46, 'doloremque', 'doloremque', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(47, 'culpa', 'culpa', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(48, 'maiores', 'maiores', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(49, 'deserunt', 'deserunt', 1, '2018-04-25 13:42:41', '2018-04-25 13:42:41'),
(50, 'aut', 'aut', 1, '2018-04-25 13:42:42', '2018-04-25 13:42:42');

-- --------------------------------------------------------

--
-- Table structure for table `themes`
--

DROP TABLE IF EXISTS `themes`;
CREATE TABLE IF NOT EXISTS `themes` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `slug` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `version` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `author_email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `developer` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `publish` tinyint(1) DEFAULT NULL,
  `active` tinyint(1) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `role_id` int(11) NOT NULL DEFAULT '1',
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `block` tinyint(1) NOT NULL DEFAULT '0',
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `role_id`, `image`, `password`, `block`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Nebojša', 'nebojsart1409@yahoo.com', 1, 'storage/uploads/users/xa-1.jpeg', '$2y$10$aS8ztHb.8HMGswnEXsCzBeAMhcw4dC5N79luCiQLnprbVZvU7Tp1K', 0, '6H1sxXxfzc6ytlZSdHB0bxMygNpqXF2lbFAm0DfnQfZpPQEYvV7UhWfYW5Fc', '2018-04-24 07:45:29', '2018-04-24 07:46:58');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attribute_product`
--
ALTER TABLE `attribute_product`
  ADD CONSTRAINT `attribute_product_attribute_id_foreign` FOREIGN KEY (`attribute_id`) REFERENCES `attributes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `attribute_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `boxes`
--
ALTER TABLE `boxes`
  ADD CONSTRAINT `boxes_block_id_foreign` FOREIGN KEY (`block_id`) REFERENCES `blocks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `boxes_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `category_product`
--
ALTER TABLE `category_product`
  ADD CONSTRAINT `category_product_category_id_foreign` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `category_product_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `menu_links`
--
ALTER TABLE `menu_links`
  ADD CONSTRAINT `menu_links_menu_id_foreign` FOREIGN KEY (`menu_id`) REFERENCES `menus` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `photos`
--
ALTER TABLE `photos`
  ADD CONSTRAINT `photos_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `post_tag`
--
ALTER TABLE `post_tag`
  ADD CONSTRAINT `post_tag_post_id_foreign` FOREIGN KEY (`post_id`) REFERENCES `posts` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `post_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_tag`
--
ALTER TABLE `product_tag`
  ADD CONSTRAINT `product_tag_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `product_tag_tag_id_foreign` FOREIGN KEY (`tag_id`) REFERENCES `tags` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `property_set`
--
ALTER TABLE `property_set`
  ADD CONSTRAINT `property_set_property_id_foreign` FOREIGN KEY (`property_id`) REFERENCES `properties` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `property_set_set_id_foreign` FOREIGN KEY (`set_id`) REFERENCES `sets` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
