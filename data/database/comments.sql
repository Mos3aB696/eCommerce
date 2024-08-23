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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int NOT NULL COMMENT 'Comment Id',
  `comment_content` text CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Comment Content',
  `comment_status` tinyint DEFAULT '0' COMMENT 'Based On It, The Comment Appear Or Disappear On Website',
  `add_date` date DEFAULT NULL COMMENT 'Comment Date Modified',
  `item_connect` int DEFAULT NULL COMMENT 'Refer To Item Id',
  `user_connect` int DEFAULT NULL COMMENT 'Refer To User ID'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_content`, `comment_status`, `add_date`, `item_connect`, `user_connect`) VALUES
(9, 'good item', 1, '2024-06-27', 3, 1),
(10, 'nice phone', 1, '2024-06-19', 2, 54),
(11, 'Nice Laptop', 1, '2024-08-06', 4, 79),
(12, 'Prefect For Programming', 1, '2024-08-05', 3, 79),
(36, 'nice laptop', 1, '2024-08-16', 10, 1),
(39, 'The New Generation of M3 Is Really Really Wonderful ', 1, '2024-08-16', 10, 69),
(40, '\"I love using my iPad daily for work and watching videos.\"', 1, '2024-08-16', 6, 54),
(42, 'Nice Sporting Car\r\n', 1, '2024-08-20', 19, 1),
(43, 'Nice Phone For Recording Reels', 1, '2024-08-20', 14, 54);

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
  MODIFY `comment_id` int NOT NULL AUTO_INCREMENT COMMENT 'Comment Id', AUTO_INCREMENT=44;

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
