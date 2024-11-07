-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 11:46 PM
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
-- Database: `e-commerce`
--
CREATE DATABASE IF NOT EXISTS `e-commerce` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `e-commerce`;

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

DROP TABLE IF EXISTS `cart`;
CREATE TABLE `cart` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `CustomerID` bigint(20) UNSIGNED NOT NULL,
  `productID` bigint(20) UNSIGNED NOT NULL,
  `prdtName` text NOT NULL,
  `prdtImg` text DEFAULT NULL COMMENT 'image',
  `price` decimal(10,0) NOT NULL DEFAULT 0,
  `CountOfProductID` bigint(20) UNSIGNED NOT NULL,
  `Paid` tinyint(1) UNSIGNED NOT NULL DEFAULT 0,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `CustomerID`, `productID`, `prdtName`, `prdtImg`, `price`, `CountOfProductID`, `Paid`, `created_at`, `updated_at`) VALUES
(40, 54, 13, 'GOUGAR-EGY Bluetooth Wireless Mouse', 'images/prdImgs/1730791822.jpg', 259, 1, 0, '2024-11-07 15:38:33', '2024-11-07 15:38:33'),
(41, 54, 9, 'Acer Nitro Core i5-12500H', 'images/prdImgs/1730791219.jpg', 34999, 1, 0, '2024-11-07 15:39:12', '2024-11-07 15:39:12'),
(42, 75, 14, 'Magnetic Phone Holder Mount for Computer', 'images/prdImgs/1730791931.jpg', 150, 1, 0, '2024-11-07 20:25:43', '2024-11-07 20:25:43'),
(44, 75, 15, 'Cooling Pad', 'images/prdImgs/1730792013.jpg', 1099, 1, 0, '2024-11-07 20:26:03', '2024-11-07 20:26:03');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
CREATE TABLE `category` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Programming laptop', '2024-11-03 04:54:36', '2024-11-03 16:00:55'),
(7, 'student laptop', '2024-11-05 05:08:28', '2024-11-05 05:08:28'),
(8, 'Business Laptop', '2024-11-05 05:08:34', '2024-11-05 05:08:34'),
(9, 'Gaming laptop', '2024-11-05 05:08:48', '2024-11-07 20:30:02'),
(10, 'graphics laptop', '2024-11-05 05:08:57', '2024-11-05 05:08:57'),
(12, 'accessories', '2024-11-05 05:29:12', '2024-11-05 05:29:12');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
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

DROP TABLE IF EXISTS `migrations`;
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
(5, '2024_10_26_114216_product', 2),
(6, '2024_10_26_114646_category', 3),
(7, '2024_10_26_115148_product', 4),
(8, '2024_10_26_162853_cart', 5),
(9, '2024_10_26_170646_create_carts_table', 6),
(10, '2024_10_26_170738_create_customers_table', 6),
(11, '2024_10_26_170753_create_sellers_table', 6),
(12, '2024_10_26_170843_create_products_table', 6),
(13, '2014_10_12_100000_create_password_resets_table', 7),
(14, '2024_11_02_132921_product_view', 8);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
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
-- Table structure for table `product`
--

DROP TABLE IF EXISTS `product`;
CREATE TABLE `product` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `categoryID` bigint(20) UNSIGNED NOT NULL,
  `price` bigint(20) NOT NULL,
  `sellerAddedIt` bigint(20) UNSIGNED NOT NULL,
  `quantityAvailable` bigint(20) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `pImage` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`id`, `name`, `description`, `categoryID`, `price`, `sellerAddedIt`, `quantityAvailable`, `created_at`, `updated_at`, `pImage`) VALUES
(5, 'MSI Thin GF63 12UC Raptor Lake', 'Intel i7-12650H 16GB DDR4 RAM 512GB NVMe PCIe Gen-4 SSD RTX 3050 4GB GDDR6 Graphics, 15.6-Inch FHD Display ,with M88 Gaming Mouse, Black', 9, 32750, 48, 1, '2024-11-05 05:12:49', '2024-11-05 05:12:49', 'images/prdImgs/1730790769.jpg'),
(6, 'Dell Inspiron 14-7430 2n1 X360 Laptop', '13th Intel Core i7-1355U 10 Cores, 16GB DDR5 RAM, 1TB SSD, Intel Iris Graphics, 14\" FHD (1920x1200) Touch, Backlit KB, FinderPrint, windows 11 - Silver', 8, 55931, 48, 2, '2024-11-05 05:15:34', '2024-11-07 12:01:11', 'images/prdImgs/1730790934.jpg'),
(7, 'HP Victus', '(15-fb1004ne), CPU: Ryzen 5-7535HS, 16GB DDR5 2DM 4800 Graphics Card: NVIDIA GeForce RTX 2050, VRAM: 4GB, Display: 15.6 FHD Antiglare IPS 250 nits 144Hz, 512GB, Windows 11', 9, 33999, 48, 3, '2024-11-05 05:16:52', '2024-11-05 05:16:52', 'images/prdImgs/1730791012.jpg'),
(8, 'Asus FA506NF-HN005W TUF', 'A15 AMD Ryzen-5 7535HS Processor 8GB RAM 512GB SSD NVIDIA GeForce RTX 2050 4GB Graphics Windows 11 15.6-inch FHD 16:9 144Hz Display Gaming Laptop, Graphite Black', 9, 31999, 55, 2, '2024-11-05 05:18:37', '2024-11-05 05:18:37', 'images/prdImgs/1730791117.jpg'),
(9, 'Acer Nitro Core i5-12500H', '512GB PCIe NVMe SSD| 8GB RAM DDR4 3200Mhz| NVIDIA RTX 3050 VRAM GDDR6 4GB| 15.6\" FHD IPS 144Hz SlimBezel| Backlit Arabic Keyboard| DOS (1 Year Local Warranty)', 7, 34999, 55, 1, '2024-11-05 05:20:19', '2024-11-05 05:20:19', 'images/prdImgs/1730791219.jpg'),
(13, 'GOUGAR-EGY Bluetooth Wireless Mouse', 'dual mode Bluetooth Wireless Mouse for Laptop with USB C Adapter, 3 in 1 (Bluetooth, 2.4G,Type C) LED Wireless Mouse Rechargeable with 3200 DPI, RGB Light,Mouse for PC,laptop X8 - Black', 12, 259, 55, 7, '2024-11-05 05:30:22', '2024-11-05 05:30:22', 'images/prdImgs/1730791822.jpg'),
(14, 'Magnetic Phone Holder Mount for Computer', 'Aporia International - Stick on Laptop Invisible Foldable Side Arm Magnetic Phone Holder Mount for Computer | Instant 2nd Monitor Mobile Solution | Aluminum Alloy with Strong Magnet', 12, 150, 55, 4, '2024-11-05 05:32:11', '2024-11-05 05:32:11', 'images/prdImgs/1730791931.jpg'),
(15, 'Cooling Pad', 'Standard ICE08 Cooling Pad Gaming Laptop Stand With Mobile Holder – 6x Blue LED Fans Multi Speed – LCD Screen – RGB Side Lights – 2 x USB -12 UP to 17 Inch | Black', 12, 1099, 48, 3, '2024-11-05 05:33:33', '2024-11-05 05:33:33', 'images/prdImgs/1730792013.jpg'),
(16, 'Havit Mouse Pad', 'HV-MP838 Mouse Pad\r\nPremium Materials With Anti Slip Rubber Base, 900 300 ” 3mm Black', 12, 56, 48, 9, '2024-11-05 05:35:37', '2024-11-05 16:21:47', 'images/prdImgs/1730792137.jpg'),
(17, 'Lenovo LOQ 15IRX9', 'LA1 Ai Chip | NVIDIA GeForce RTX 3050 6GB | Intel 13th Gen i7-13650HX | 15.6 Inch FHD IPS 144Hz 100% sRGB with G-Sync | 16GB DDR5 RAM | 512GB PCIe SSD | FHD Camera| Backlit Keyboard | Wi-Fi 6 | Luna Grey\r\nGraphics Card	\r\nNVIDIA® GeForce RTX™ 3050 6GB GDDR6, Boost Clock 1732MHz, TGP 95W, 142 AI TOPS\r\nMemory (RAM)	\r\n1x 16GB SO-DIMM DDR5-4800, Two DDR5 SO-DIMM slots, dual-channel capable\r\nStorage	\r\n512GB SSD M.2 2242 PCIe® 4.0x4 NVMe®', 9, 45999, 48, 2, '2024-11-05 06:43:20', '2024-11-05 06:43:20', 'images/prdImgs/1730796200.jpg'),
(22, 'hp victus', '15-fa1097ne Intel® Core™ i7-13700H RTX™ 4050 6GB 16GB 512GB SSD 15.6\" FHD Free Dos Silver 86J65EA', 8, 53322, 48, 3, '2024-11-07 20:27:28', '2024-11-07 20:27:49', 'images/prdImgs/1731018448.jpg');

-- --------------------------------------------------------

--
-- Stand-in structure for view `product_view`
-- (See below for the actual view)
--
DROP VIEW IF EXISTS `product_view`;
CREATE TABLE `product_view` (
`id` bigint(20) unsigned
,`productName` varchar(255)
,`CategoryName` varchar(255)
,`sellerName` varchar(255)
,`description` longtext
,`price` bigint(20)
,`quantityAvailable` bigint(20)
,`productImage` text
,`SellerID` bigint(20) unsigned
,`productImg` text
);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `Fname` varchar(255) NOT NULL,
  `userName` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `identity` tinyint(1) NOT NULL DEFAULT 0 COMMENT '0 is seller , 1 is customer',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `Fname`, `userName`, `email`, `password`, `identity`, `email_verified_at`, `remember_token`, `created_at`, `updated_at`) VALUES
(48, 'seller 1', 'seller1', 'seller1@ghkm.com', '$2y$12$OH8D0nNUJ/yPeb/tvp/.g.aQD2QAMfa2Hqnr9fWXEnl9emkEbX9eC', 0, NULL, NULL, '2024-11-01 19:57:24', '2024-11-01 19:57:24'),
(53, 'Administrator', 'admin', 'admin@ghkm.com', '$2y$12$Kge7KOyImtbeofY3otZxo.JA0PyXoVGbZ2SlkJSAyQkrKNGLJEfkW', 2, NULL, NULL, NULL, NULL),
(54, 'Customer 1', 'Customer1', 'Customer1@ghkm.com', '$2y$12$hP4oZ39hyAi2D33doq9Ha./H4BcHoPYtbTDk6K.PtcUFV0GpJe22y', 1, NULL, NULL, '2024-11-03 15:36:39', '2024-11-03 15:36:39'),
(55, 'seller 2', 'seller2', 'seller2@ghkm.com', '$2y$12$p7kk/nOTUB2DQkGDNRJ5Xuz4kI8BbmtOjzUxAghz7yaKq4jEou.2G', 0, NULL, NULL, '2024-11-05 05:17:24', '2024-11-05 05:17:24'),
(65, 'customer 3', 'customer3', 'customer3@ghkm.com', '$2y$12$xROHA/G3u/bQ/11ko445o.oaOYSuOjU91X3dyH8GxG7EQqFUh6JC6', 1, NULL, NULL, '2024-11-07 11:57:49', '2024-11-07 11:57:49'),
(75, 'customer 3', 'customer3', 'doddda16@gmail.com', '$2y$12$.iACs59P459NAUMu5WMZSuCTxhWVvJzcE3jeVq6xIGD8eBzFIcFki', 1, NULL, 'UZK1ZHhZvyet3zgZ3QTrJiEY3NBo6Hx4pGJDj3GkP94oUDDhbTfypEEtRWRg', '2024-11-07 20:24:38', '2024-11-07 20:25:06');

-- --------------------------------------------------------

--
-- Structure for view `product_view`
--
DROP TABLE IF EXISTS `product_view`;

DROP VIEW IF EXISTS `product_view`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `product_view`  AS SELECT `product`.`id` AS `id`, `product`.`name` AS `productName`, `category`.`name` AS `CategoryName`, `users`.`Fname` AS `sellerName`, `product`.`description` AS `description`, `product`.`price` AS `price`, `product`.`quantityAvailable` AS `quantityAvailable`, `product`.`pImage` AS `productImage`, `product`.`sellerAddedIt` AS `SellerID`, `product`.`pImage` AS `productImg` FROM ((`product` join `users`) join `category`) WHERE `product`.`categoryID` = `category`.`id` AND `product`.`sellerAddedIt` = `users`.`id` ORDER BY `category`.`name` ASC ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `CustomerID` (`CustomerID`,`productID`),
  ADD KEY `cart_productid_foreign` (`productID`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
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
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

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
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`),
  ADD KEY `forKey1` (`categoryID`),
  ADD KEY `forKey2` (`sellerAddedIt`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_customerid_foreign` FOREIGN KEY (`CustomerID`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cart_productid_foreign` FOREIGN KEY (`productID`) REFERENCES `product` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product`
--
ALTER TABLE `product`
  ADD CONSTRAINT `forKey1` FOREIGN KEY (`categoryID`) REFERENCES `category` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `forKey2` FOREIGN KEY (`sellerAddedIt`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
