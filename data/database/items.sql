-- phpMyAdmin SQL Dump
-- version 5.2.1-4.fc40
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 23, 2024 at 11:24 AM
-- Server version: 8.0.39
-- PHP Version: 8.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `eCommerce`
--

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `item_id` int NOT NULL COMMENT 'Item Id',
  `item_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Name',
  `item_description` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Description',
  `item_price` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Price',
  `add_date` date DEFAULT NULL COMMENT 'Item Date Modified',
  `country_made` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Item Made Country',
  `item_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Item Image',
  `item_status` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Status',
  `item_rating` tinyint DEFAULT NULL COMMENT 'Item Rating',
  `item_approve` int NOT NULL DEFAULT '0',
  `category_connect` int NOT NULL COMMENT 'Refer To Category ID',
  `user_connect` int NOT NULL COMMENT 'Refer To User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`item_id`, `item_name`, `item_description`, `item_price`, `add_date`, `country_made`, `item_image`, `item_status`, `item_rating`, `item_approve`, `category_connect`, `user_connect`) VALUES
(2, 'iphone 12 pro max', 'color: gray | ram: 6 G | Storage: 128 G', '650', '2024-06-19', 'USA', NULL, '3', NULL, 1, 3, 79),
(3, 'Dell Inspiron 3593', 'Ram: 16 | Storage: 1 T | Graphic: Nvidia', '500', '2024-06-19', 'China', NULL, '3', NULL, 1, 1, 79),
(4, 'macbook air m1', 'color: mint green | ram: 6 G | Storage: 128 G', '800', '2024-08-06', 'USA', NULL, '2', NULL, 1, 1, 79),
(6, 'iPad Air 4', '8G Ram | Selver ', '300', '2024-08-08', 'USA', NULL, '3', NULL, 1, 2, 1),
(8, 'Shirt', 'Black Shirt', '10', '2024-08-10', 'Egypt', NULL, '1', NULL, 1, 5, 1),
(9, 'BMW X6', 'Black Car Model 2023', '15000', '2024-08-11', 'Germany', NULL, '2', NULL, 1, 6, 1),
(10, 'Macbook Pro M3', 'Apple M3 chip  8-core CPU with 4 performance cores and 4 efficiency cores 10-core GPU Hardware-accelerated ray tracing 16-core Neural Engine 100GB/s memory bandwidth', '1100', '2024-08-14', 'USA', NULL, '1', NULL, 1, 1, 1),
(11, 'NoteBook', 'NoteBook To Write Your Days Tasks', '2', '2024-08-16', 'China', NULL, '1', NULL, 1, 5, 1),
(12, 'macbook air m2', 'Ram: 16 | Storage: 1 T', '800', '2024-08-17', 'USA', NULL, '2', NULL, 1, 1, 54),
(13, 'MateBook X Pro', '980 g Ultralight1  |  Flexible OLED Display2  |  Intel® Core™ Ultra 9 Processor3', '1000', '2024-08-17', 'China', NULL, '1', NULL, 1, 1, 54),
(14, 'samsung s22', 'Versions: SM-S901B, SM-S901B/DS (International); SM-S901U (USA); SM-S901U1 (USA unlocked); SM-S901W (Canada); SM-S901N (Korea); SM-S9010 (China); SM-S901E', '600', '2024-08-17', 'China', NULL, '1', NULL, 1, 3, 54),
(18, 'ipad air 3', 'Available in three color options (including Silver, Space Gray and Gold), the gold color option of the third-generation iPad Air is now updated introduced with the iPhone 8.', '200', '2024-08-18', 'USA', NULL, '3', NULL, 1, 2, 54),
(19, 'corolla gr sport', 'Sport Red Car', '25000', '2024-08-19', 'Japan', NULL, '1', NULL, 1, 6, 1),
(20, 'testtset', 'testtsettesttset', '10', '2024-08-19', 'China', NULL, '4', NULL, 0, 1, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`item_id`),
  ADD KEY `FK_CATEGORIES` (`category_connect`),
  ADD KEY `FK_USERS` (`user_connect`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT COMMENT 'Item Id', AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `items`
--
ALTER TABLE `items`
  ADD CONSTRAINT `FK_CATEGORIES` FOREIGN KEY (`category_connect`) REFERENCES `categories` (`cat_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `FK_USERS` FOREIGN KEY (`user_connect`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
