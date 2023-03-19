-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Mar 19, 2023 at 12:04 PM
-- Server version: 8.0.32
-- PHP Version: 8.1.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinebidding`
--

-- --------------------------------------------------------

--
-- Table structure for table `bidded_items`
--

CREATE TABLE `bidded_items` (
  `id` int NOT NULL,
  `item_id` int NOT NULL,
  `price` int NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `bid_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `bidded_items`
--

INSERT INTO `bidded_items` (`id`, `item_id`, `price`, `item_name`, `user_id`, `bid_id`) VALUES
(1, 3, 25000, 'Cow', 26, 2),
(2, 4, 34600, 'Friesian', 26, 3),
(7, 2, 3600, 'Sheep', 31, 8);

-- --------------------------------------------------------

--
-- Table structure for table `biddings`
--

CREATE TABLE `biddings` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `item_id` int NOT NULL,
  `bid_amount` int NOT NULL,
  `date` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `status` tinyint NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `biddings`
--

INSERT INTO `biddings` (`id`, `user_id`, `item_name`, `item_id`, `bid_amount`, `date`, `time`, `status`) VALUES
(1, 6, 'Cow', 3, 24321, '04-03-23', '23:46:10', 1),
(2, 26, 'Cow', 3, 25000, '08-03-23', '11:25:21', 1),
(3, 26, 'Friesian', 4, 34600, '08-03-23', '11:33:26', 1),
(4, 26, 'Donkey', 7, 23000, '08-03-23', '11:38:21', 0),
(5, 28, 'Donkey', 7, 24000, '08-03-23', '11:41:01', 0),
(6, 30, 'Sheep', 2, 3400, '10-03-23', '06:31:30', 1),
(7, 6, 'Sheep', 2, 3400, '16-03-23', '14:34:56', 1),
(8, 31, 'Sheep', 2, 3600, '19-03-23', '11:38:24', 1),
(10, 31, 'Friesian', 6, 35000, '19-03-23', '11:47:07', 0);

-- --------------------------------------------------------

--
-- Table structure for table `items`
--

CREATE TABLE `items` (
  `id` int NOT NULL,
  `item_name` varchar(255) NOT NULL,
  `min_price` int NOT NULL,
  `max_price` int NOT NULL,
  `livestock_name` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `photo` varchar(255) NOT NULL,
  `user_id` int NOT NULL,
  `bidders` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `items`
--

INSERT INTO `items` (`id`, `item_name`, `min_price`, `max_price`, `livestock_name`, `photo`, `user_id`, `bidders`, `status`) VALUES
(2, 'Sheep', 3000, 4000, 'sheep', '106403a2f2e7a450.73489841ssa.jpg', 1, 3, 1),
(3, 'Cow', 24000, 30000, 'cow', '106403a8e3ec63a6.81925878sa.jpg', 1, 2, 1),
(4, 'Friesian', 30000, 36000, 'cow', '106403b64fd7a553.59917648cds.jpeg', 1, 1, 1),
(5, 'Donkey', 40000, 45000, 'donkey', '106403ed0978edf2.59908680new-feature.png', 1, 0, 0),
(6, 'Friesian', 34500, 40000, 'cow', '10640847c5e0b4f7.43092277download.jpeg', 1, 2, 0),
(7, 'Donkey', 20200, 25000, 'donkey', '10640849223c0a02.66132150sa.jpg', 1, 2, 0),
(9, 'Keefe Johns', 4567, 5467, 'sheep', '106410c2f1cd99f5.23816582cow-1278889__340.jpg', 1, 0, 0),
(10, 'Eden Wood', 208, 377, 'sheep', '106410c30100a176.74817425lamb-2216160__340.jpg', 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` int NOT NULL DEFAULT '0',
  `status` int NOT NULL DEFAULT '1',
  `phone` int DEFAULT NULL,
  `town` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `profile_image` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  `otp` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `role`, `status`, `phone`, `town`, `profile_image`, `otp`) VALUES
(1, 'sekalutu', 'fiwe@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(2, 'fobezobux', 'xedapol@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(3, 'nogobyzose', 'fevys@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(4, 'terirypa', 'qoholazy@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(5, 'bamejan', 'dakyby@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(6, 'Abraham', 'abukbt13@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 1, 1, 234567, '', '1798040119cow.jpeg', 1743432695),
(7, 'xasydija', 'bezutocura@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(8, 'piwofasi', 'pewomocoru@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(9, 'nutujo', 'tehar@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(10, 'tuzuve', 'wejurodoz@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(11, 'tufuxoja', 'bynaqac@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(12, 'qotugi', 'higofuwo@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(13, 'jelivyvoce', 'misuvy@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(14, 'Alexa', 'qakyxy@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, 768946595, '', '557912131cv.jpeg', NULL),
(15, 'nosuzovo', 'xyfyxalub@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, 45678, '', '580906870hgj.jpg', NULL),
(16, 'ALex', 'abukbt13@gmail.yahoo', '81dc9bdb52d04dc20036dbd8313ed055', 0, 1, 728548760, '', '2135586625bg2.jpeg', NULL),
(18, 'cyfipiwik', 'bixefemubo@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, 728548760, '', '17095065091662696220134.jpg', NULL),
(19, 'Abraham', 'cuqidybuwu@mailinator.com', 'bffa6eac4b9f3f3c6a3c4efc2b4baf4f', 0, 1, 728548760, 'Kitale', '13836826281664363502190.jpg', NULL),
(21, 'xudyr', 'qemoc@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(22, 'xeluqisi', 'xuboj@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(23, 'cypaj', 'jazuti@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(24, 'wusali', 'zyfok@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(25, 'muxulu', 'lugefumiwa@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(27, 'sowos', 'pagezicomo@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(28, 'Bryther', 'bryfa2001@gmail.com', '50657b0405566519e16753b7b95405ee', 0, 1, 73552552, '', '1740517129IMG_20230112_154145.jpg', NULL),
(29, 'curaqes', 'bagifiruru@mailinator.com', 'f3ed11bbdb94fd9ebdefbaf646ab94d3', 0, 1, NULL, NULL, NULL, NULL),
(30, 'nzukibreather01@gmail.com', 'nzukibreather01@gmail.com', '0e30babe623d4e9f1b9a57c7e6cbe3a5', 0, 1, NULL, NULL, NULL, NULL),
(31, 'Infortect', 'infotechnologyss@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 0, 1, 735645673, 'Kapsowar', '948874643zulu_crafts.jpg', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bidded_items`
--
ALTER TABLE `bidded_items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `biddings`
--
ALTER TABLE `biddings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `items`
--
ALTER TABLE `items`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bidded_items`
--
ALTER TABLE `bidded_items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `biddings`
--
ALTER TABLE `biddings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `items`
--
ALTER TABLE `items`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
