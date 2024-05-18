-- phpMyAdmin SQL Dump
-- version 5.2.1-4.fc40
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 11, 2024 at 07:09 PM
-- Server version: 8.0.36
-- PHP Version: 8.3.6

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
  `item_name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Name',
  `item_description` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Description',
  `item_price` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Price',
  `add_date` datetime DEFAULT NULL COMMENT 'Item Date Modified',
  `country_made` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL COMMENT 'Item Made Country',
  `item_image` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Image',
  `item_status` varchar(255) COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Item Status',
  `item_rating` tinyint DEFAULT NULL COMMENT 'Item Rating',
  `category_connect` int NOT NULL COMMENT 'Refer To Category ID',
  `user_connect` int NOT NULL COMMENT 'Refer To User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `item_id` int NOT NULL AUTO_INCREMENT COMMENT 'Item Id';

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
