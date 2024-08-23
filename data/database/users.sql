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
  `add_date` date NOT NULL COMMENT 'Signup Date'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_name`, `pass`, `email`, `full_name`, `group_id`, `trust_status`, `reg_status`, `add_date`) VALUES
(1, 'mos3ab', 'b6589fc6ab0dc82cf12099d1c2d40ab994e8410c', 'mos3ab696@gmail.com', 'mosaab abdelkader', 1, 0, 1, '2024-04-26'),
(40, 'yousif55', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'yousif@hotmail.com', 'yousif elsayed', 0, 0, 1, '2024-04-27'),
(41, 'Sayed89', 'bc53b5813c49642762c251319405523e399e6176', 'sayed89@gmail.com', 'Sayed Mohamed', 0, 0, 1, '2024-04-27'),
(42, 'salma', '601f1889667efaebb33b8c12572835da3f027f78', 'salma@yahoo.com', 'salma mohamd', 0, 0, 1, '2024-04-27'),
(43, 'ahmed22', '5f6955d227a320c7f1f6c7da2a6d96a851a8118f', 'ahmed@hotmail.com', 'ahmed mohammed', 0, 0, 1, '2024-04-27'),
(53, 'sameh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 's@s.com', 'samed mohammed', 0, 0, 1, '2024-04-30'),
(54, 'Salah89', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'salah@yahoo.com', 'Salah Ali', 0, 0, 1, '2024-04-30'),
(55, 'Mamdoh', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'Mamdoh@yahoo.com', 'Mamdoh Alsayed Mohmmed', 0, 0, 1, '2024-04-30'),
(56, 'Hasan', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hasan34@hotmail.com', 'hasan mohamed', 0, 0, 1, '2024-04-30'),
(57, 'Fayz3', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'fayz@f.com', 'fayz ali', 0, 0, 1, '2024-04-30'),
(61, 'hamody88', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'hamody@hotmail.com', 'hamody mohammed', 0, 0, 1, '2024-05-02'),
(62, 'yasmen', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'yasmen@yahoo.com', 'yasmen mohamed', 0, 0, 1, '2024-05-02'),
(65, 'fawz', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'f@f.com', 'fawz mohamedd', 0, 0, 1, '2024-05-04'),
(66, 'nourhan ', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'n@n.com', 'nourhan ali ', 0, 0, 1, '2024-05-05'),
(67, 'sameh98', '601f1889667efaebb33b8c12572835da3f027f78', 'sameh@yahoo.com', 'samed ibrahem', 0, 0, 1, '2024-05-05'),
(69, 'Ibrahem77', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'ibrahem77@hotmail.com', 'Ibrahem Ali', 0, 0, 1, '2024-05-07'),
(70, 'abdelkader', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'abdelkader@yahoo.com', 'Abdelkader Elsayed', 0, 0, 1, '2024-05-07'),
(75, 'sara34', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'sara@gmail.com', 'sara ahmed', 0, 0, 1, '2024-05-11'),
(76, 'ibrahim69', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'i@i.com', 'ibrahim mohamed', 0, 0, 1, '2024-05-11'),
(77, 'omar23', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'omar@yahoo.com', 'omar ', 0, 0, 1, '2024-05-11'),
(78, 'abobakr', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'abobakr@yahoo.com', 'abo bakr', 0, 0, 1, '2024-05-11'),
(79, 'uthman', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'uthman@hotmail.com', 'uthman sayed', 0, 0, 1, '2024-05-11'),
(86, 'Sara88', '7110eda4d09e062aa5e4a390b0a572ac0d2c0220', 's@s.com', 'Sara Ali', 0, 0, 0, '2024-08-19');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_name` (`user_name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT COMMENT 'identify user', AUTO_INCREMENT=87;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
