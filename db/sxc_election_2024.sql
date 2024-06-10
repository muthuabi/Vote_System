-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 09, 2024 at 08:03 PM
-- Server version: 10.4.28-MariaDB-log
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sxc_election_2024`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(30) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(15) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `email`, `password`, `created_at`) VALUES
(1, 'muthuabi', 'Muthu M', 'muthuabi292@gmail.com ', '12345', '2024-06-07 22:25:07');

-- --------------------------------------------------------

--
-- Table structure for table `candidates`
--

CREATE TABLE `candidates` (
  `candidate_id` int(11) NOT NULL,
  `regno` varchar(10) NOT NULL,
  `name` varchar(150) NOT NULL,
  `course` varchar(100) NOT NULL,
  `year` int(1) NOT NULL DEFAULT 3,
  `post_id` int(11) NOT NULL,
  `vote_count` int(11) DEFAULT NULL,
  `image_url` varchar(500) NOT NULL,
  `shift` enum('Shift-I','Shift-II') NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `regno`, `name`, `course`, `year`, `post_id`, `vote_count`, `image_url`, `shift`, `created_on`, `updated_on`) VALUES
(73, '21UCS107', 'Muthukrishnan  M', 'BSC COMPUTER SCIENCE', 3, 20, 0, '../assets/images/candidate_images/2024/IMG-20220324-WA0018_084946.jpg', 'Shift-I', '2024-06-08 20:26:34', '2024-06-08 20:26:34'),
(74, '21UCS109', 'Krish', 'BSC COMPUTER SCIENCE', 3, 21, 0, '../assets/images/candidate_images/2024/.jpg', 'Shift-II', '2024-06-09 17:09:22', '2024-06-09 17:09:22'),
(75, '21UCS110', 'Krish', 'BSC COMPUTER SCIENCE', 3, 20, 0, '../assets/images/candidate_images/2024/0-simple-business-multi-media-elegant-powerpoint-background_6c637418c1__960_540.jpg', 'Shift-I', '2024-06-09 20:39:10', '2024-06-09 20:39:10'),
(76, '21UCS111', 'Someone', 'BSC COMPUTER SCIENCE', 3, 19, 0, '../assets/images/candidate_images/2024/62debc4fff3c6e4b8b5de8d3.png', 'Shift-I', '2024-06-09 20:39:41', '2024-06-09 20:39:41'),
(77, '21UCS103', 'Another One for', 'BSC CHEMISTRY', 3, 19, 0, '../assets/images/candidate_images/2024/1651769314735.jpg', 'Shift-I', '2024-06-09 20:40:21', '2024-06-09 20:41:14'),
(78, '21UCS123', 'Another One', 'BSC CHEMISTRY', 3, 21, 0, '../assets/images/candidate_images/2024/360_F_103028005_QClGAJ0pdaS9xINIYccragSpkQUY1emI.jpg', 'Shift-II', '2024-06-09 20:40:56', '2024-06-09 20:40:56'),
(79, '21UCS129', 'Join Someone', 'BSC COMMERCE', 3, 24, 0, '../assets/images/candidate_images/2024/360_F_184150518_n7nMgXVC3hwqj15DCT2cc6cx94oT9K4n.jpg', 'Shift-I', '2024-06-09 20:41:57', '2024-06-09 20:41:57'),
(80, '21UCS108', 'Join Sec II', 'BSC ECONOMICS', 3, 24, 0, '../assets/images/candidate_images/2024/62debc4fff3c6e4b8b5de8d3.png', 'Shift-I', '2024-06-09 20:42:43', '2024-06-09 20:42:43'),
(81, '21UCS138', 'Join Sec S II', 'BSC ECONOMICS', 3, 22, 0, '../assets/images/candidate_images/2024/21UCS107 Maximum of Three numbers.png', 'Shift-II', '2024-06-09 20:43:24', '2024-06-09 20:43:24'),
(82, '21UCS143', 'Jero', 'BSC COMPUTER SCIENCE', 3, 22, 0, '../assets/images/candidate_images/2024/1652352563185.jpg', 'Shift-II', '2024-06-09 20:44:09', '2024-06-09 20:44:09'),
(83, '21UCS144', 'Bharath', 'BSC COMPUTER SCIENCE', 3, 23, 0, '../assets/images/candidate_images/2024/0-simple-business-multi-media-elegant-powerpoint-background_6c637418c1__960_540.jpg', 'Shift-I', '2024-06-09 21:01:14', '2024-06-09 21:01:14'),
(84, '21UCS145', 'Bharath', 'BSC COMPUTER SCIENCE', 3, 23, 0, '../assets/images/candidate_images/2024/360_F_103028005_QClGAJ0pdaS9xINIYccragSpkQUY1emI.jpg', 'Shift-I', '2024-06-09 21:01:50', '2024-06-09 21:01:50');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `post_id` int(11) NOT NULL,
  `post` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `post_shift` enum('Shift-I','Shift-II') NOT NULL,
  `who_can_vote` enum('MF','M','F') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`post_id`, `post`, `description`, `post_shift`, `who_can_vote`, `created_at`, `updated_on`) VALUES
(19, 'President', 'Serves', 'Shift-I', 'MF', '2024-06-08 09:00:37', '2024-06-08 09:00:37'),
(20, 'Vice President', 'Serves', 'Shift-I', 'MF', '2024-06-08 09:00:37', '2024-06-08 09:00:37'),
(21, 'Secretary', 'Serves', 'Shift-II', 'M', '2024-06-08 09:00:37', '2024-06-09 20:21:20'),
(22, 'Join Secretary', 'Serves', 'Shift-II', 'F', '2024-06-08 09:00:37', '2024-06-09 20:21:20'),
(23, 'Secretary', 'Serves', 'Shift-I', 'M', '2024-06-09 20:22:21', '2024-06-09 20:22:21'),
(24, 'Join Secretary', 'Serves', 'Shift-I', 'F', '2024-06-09 20:22:21', '2024-06-09 20:22:21');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `vote_id` int(11) NOT NULL,
  `vote` int(11) NOT NULL,
  `candidate_id` int(11) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `last_voted_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`vote_id`, `vote`, `candidate_id`, `created_on`, `last_voted_on`) VALUES
(13, 2103, 73, '2024-06-09 17:50:13', '2024-06-09 23:32:33'),
(14, 2100, 74, '2024-06-09 17:50:13', '2024-06-09 20:38:01'),
(15, 5, 77, '2024-06-09 23:01:44', '2024-06-09 23:05:47'),
(16, 6, 75, '2024-06-09 23:01:47', '2024-06-09 23:31:16'),
(17, 5, 84, '2024-06-09 23:01:49', '2024-06-09 23:11:06'),
(18, 4, 83, '2024-06-09 23:09:47', '2024-06-09 23:32:34'),
(19, 4, 76, '2024-06-09 23:10:17', '2024-06-09 23:32:32');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `candidates`
--
ALTER TABLE `candidates`
  ADD PRIMARY KEY (`candidate_id`),
  ADD UNIQUE KEY `regno` (`regno`),
  ADD KEY `fk_post_candidate` (`post_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`post_id`),
  ADD UNIQUE KEY `post_shift_unique` (`post`,`post_shift`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`vote_id`),
  ADD UNIQUE KEY `candidate_id` (`candidate_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=85;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `fk_post_candidate` FOREIGN KEY (`post_id`) REFERENCES `position` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_candidate_votes` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
