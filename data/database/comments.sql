-- phpMyAdmin SQL Dump
-- version 5.2.1-4.fc40
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 24, 2024 at 08:44 AM
-- Server version: 8.0.36
-- PHP Version: 8.3.7

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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL COMMENT 'Comment Id',
  `comment_content` text COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Comment Content',
  `comment_status` tinyint DEFAULT '0' COMMENT 'Based On It, The Comment Appear Or Disappear On Website',
  `add_date` date DEFAULT NULL COMMENT 'Comment Date Modified',
  `item_connect` int DEFAULT NULL COMMENT 'Refer To Item Id',
  `user_connect` int DEFAULT NULL COMMENT 'Refer To User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_status`, `add_date`, `item_connect`, `user_connect`) VALUES
(1, 'Thank You Very Much', 1, '2024-05-23', 9, 1),
(2, 'Nice Product', 1, '2024-05-23', 10, 70),
(3, 'Not Bad, It\'s Work ', 1, '2024-05-23', 13, 1),
(6, 'Nice phone, Good bettery health', 0, '2024-05-24', 18, 65),
(7, 'Nice Phone, With a Good Camera', 0, '2024-05-23', 15, 53),
(8, 'Nice Phone', 0, '2024-05-23', 15, 39);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `COMMENT_FK_ITEMS` (`item_connect`),
  ADD KEY `COMMENT_FK_USERS` (`user_connect`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT COMMENT 'Comment Id', AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `COMMENT_FK_ITEMS` FOREIGN KEY (`item_connect`) REFERENCES `items` (`item_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `COMMENT_FK_USERS` FOREIGN KEY (`user_connect`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
