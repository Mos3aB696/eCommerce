-- phpMyAdmin SQL Dump
-- version 5.2.1-4.fc40
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 30, 2024 at 03:50 PM
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
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL COMMENT 'identify user',
  `user_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'username to login',
  `pass` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'password to login',
  `email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `full_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `group_id` int DEFAULT '0' COMMENT 'identify user group',
  `trust_status` int DEFAULT '0' COMMENT 'seller rank',
  `reg_status` int DEFAULT '0' COMMENT 'user approval',
  `date` date NOT NULL COMMENT 'Signup Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `pass`, `email`, `full_name`, `group_id`, `trust_status`, `reg_status`, `date`) VALUES
(1, 'mos3ab', 'b6589fc6ab0dc82cf12099d1c2d40ab994e8410c', 'm@m.com', 'mosaab abdelkader', 1, 0, 1, '2024-04-26'),
(39, 'hamdy', '601f1889667efaebb33b8c12572835da3f027f78', 'hamdy@yahoo.com', 'hamdy mohammed', 0, 0, 1, '2024-04-27'),
(40, 'yousif', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'yousif@hotmail.com', 'yousif elsayed', 0, 0, 1, '2024-04-27'),
(41, 'Soha23', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'soha@yahoo.com', 'soha mohammed', 0, 0, 1, '2024-04-27'),
(42, 'sama33', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sama@yahoo.com', 'sama mohamed', 0, 0, 1, '2024-04-27'),
(43, 'ahmed22', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'ahmed@hotmail.com', 'ahmed mohammed', 0, 0, 1, '2024-04-27'),
(49, 'reboot', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'reboot@hotmail.com', 'test', 0, 0, 1, '2024-04-28'),
(53, 'sameh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 's@s.com', 'samed mohammed', 0, 0, 1, '2024-04-30'),
(54, 'Salah89', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'salah@yahoo.com', 'Salah Ali', 0, 0, 1, '2024-04-30'),
(55, 'Mamdoh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Mamdoh@yahoo.com', 'Mamdoh Alsayed Mohmmed', 0, 0, 1, '2024-04-30'),
(56, 'Hasan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hasan34@hotmail.com', 'hasan mohamed', 0, 0, 1, '2024-04-30'),
(57, 'Fayz3', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'fayz@f.com', 'fayz ali', 0, 0, 1, '2024-04-30');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'identify user', AUTO_INCREMENT=61;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
