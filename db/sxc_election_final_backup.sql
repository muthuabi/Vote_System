-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 19, 2024 at 06:22 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sxc_election`
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
  `role` enum('admin','sub-admin','viewer','restricted') NOT NULL DEFAULT 'viewer',
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `name`, `email`, `password`, `role`, `created_on`, `updated_on`) VALUES
(2, 'muthuabi', 'Muthukrishnan M', 'muthuabi292@gmail.com', 'bXV0aHUxMjM=', 'admin', '2024-06-11 19:04:31', '2024-06-16 21:34:55'),
(3, 'leo', 'Leolin', 'leo@gmail.com', 'bGVvMTIz', 'viewer', '2024-06-11 19:21:24', '2024-06-16 21:34:55'),
(5, 'muthu  ', 'someone', 'muthuabi027@gmail.com', 'bXV0aHUxMjM=', 'restricted', '2024-06-16 21:41:11', '2024-06-16 21:57:10');

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
  `election_year` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `candidates`
--

INSERT INTO `candidates` (`candidate_id`, `regno`, `name`, `course`, `year`, `post_id`, `vote_count`, `image_url`, `shift`, `election_year`, `created_on`, `updated_on`) VALUES
(89, '21UCS107', 'Muthukrishnan M', 'BSC COMPUTER SCIENCE', 3, 26, 0, '../assets/images/candidate_images/2024/KrishProfile.jpg', 'Shift-I', '2024-25', '2024-06-19 09:44:17', '2024-06-19 09:44:17'),
(90, '21UCS102', 'Meenakshinathan', 'BSC COMPUTER SCIENCE', 3, 26, 0, '../assets/images/candidate_images/2024/boy_image2.webp', 'Shift-I', '2024-25', '2024-06-19 09:44:36', '2024-06-19 09:44:36'),
(91, '21UCS103', 'Thanush', 'BSC COMPUTER SCIENCE', 3, 26, 0, '../assets/images/candidate_images/2024/boy_image1.jfif', 'Shift-I', '2024-25', '2024-06-19 09:44:58', '2024-06-19 09:44:58'),
(92, '21UCS104', 'Abishek', 'BSC COMPUTER SCIENCE', 3, 27, 0, '../assets/images/candidate_images/2024/KrishProfile.jpg', 'Shift-I', '2024-25', '2024-06-19 09:45:26', '2024-06-19 09:45:26'),
(93, '21UCS105', 'Antony', 'BSC COMPUTER SCIENCE', 3, 27, 0, '../assets/images/candidate_images/2024/boy_image1.jfif', 'Shift-I', '2024-25', '2024-06-19 09:45:44', '2024-06-19 09:45:44'),
(94, '21UCS110', 'Srinithi', 'BSC COMPUTER SCIENCE', 3, 28, 0, '../assets/images/candidate_images/2024/girl_image2.jpg', 'Shift-I', '2024-25', '2024-06-19 09:46:18', '2024-06-19 09:46:18'),
(95, '21UCS111', 'Atchiya', 'BSC COMPUTER SCIENCE', 3, 28, 0, '../assets/images/candidate_images/2024/girl_image1.jpg', 'Shift-I', '2024-25', '2024-06-19 09:46:49', '2024-06-19 09:46:49'),
(96, '21UCS113', 'Saran', 'BSC COMPUTER SCIENCE', 3, 29, 0, '../assets/images/candidate_images/2024/boy_image1.jfif', 'Shift-I', '2024-25', '2024-06-19 09:47:24', '2024-06-19 09:47:24'),
(97, '21UCS114', 'Atharsh', 'BSC COMPUTER SCIENCE', 3, 29, 0, '../assets/images/candidate_images/2024/boy_image2.webp', 'Shift-I', '2024-25', '2024-06-19 09:47:48', '2024-06-19 09:47:48'),
(98, '21UCS514', 'Rahini', 'BSC COMPUTER SCIENCE', 3, 30, 0, '../assets/images/candidate_images/2024/girl_image1.jpg', 'Shift-II', '2024-25', '2024-06-19 09:48:18', '2024-06-19 09:48:18'),
(99, '21UCS524', 'Ranitha', 'BSC COMPUTER SCIENCE', 3, 30, 0, '../assets/images/candidate_images/2024/girl_image2.jpg', 'Shift-II', '2024-25', '2024-06-19 09:49:01', '2024-06-19 09:49:01'),
(100, '21UCS516', 'Rajan', 'BSC COMPUTER SCIENCE', 3, 31, 0, '../assets/images/candidate_images/2024/boy_image2.webp', 'Shift-II', '2024-25', '2024-06-19 09:49:34', '2024-06-19 09:49:34'),
(101, '21UCS517', 'Lenin', 'BSC COMPUTER SCIENCE', 3, 31, 0, '../assets/images/candidate_images/2024/boy_image1.jfif', 'Shift-I', '2024-25', '2024-06-19 09:49:56', '2024-06-19 09:49:56');

-- --------------------------------------------------------

--
-- Table structure for table `old_data_table`
--

CREATE TABLE `old_data_table` (
  `id` int(11) NOT NULL,
  `regno` varchar(10) NOT NULL,
  `post_with_shift` varchar(100) NOT NULL,
  `votes` int(11) NOT NULL,
  `election_year` varchar(10) NOT NULL,
  `created_on` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `old_data_table`
--

INSERT INTO `old_data_table` (`id`, `regno`, `post_with_shift`, `votes`, `election_year`, `created_on`) VALUES
(144, '21UCS111', 'Chairman Both', 25, '2024-25', '2024-06-13 23:05:57'),
(145, '21UCS103', 'Chairman Both', 19, '2024-25', '2024-06-13 23:05:57'),
(146, '21UCS129', 'Join Secretary Shift-I', 1, '2024-25', '2024-06-13 23:05:57'),
(147, '21UCS108', 'Join Secretary Shift-I', 1, '2024-25', '2024-06-13 23:05:57'),
(148, '21UCS138', 'Join Secretary Shift-II', 1, '2024-25', '2024-06-13 23:05:57'),
(149, '21UCS143', 'Join Secretary Shift-II', 1, '2024-25', '2024-06-13 23:05:57'),
(150, '21UCS150', 'Join Secretary Shift-II', 6, '2024-25', '2024-06-13 23:05:57'),
(151, '21UCS151', 'Join Secretary Shift-II', 0, '2024-25', '2024-06-13 23:05:57'),
(152, '21UCS144', 'Secretary Shift-I', 13, '2024-25', '2024-06-13 23:05:57'),
(153, '21UCS145', 'Secretary Shift-I', 18, '2024-25', '2024-06-13 23:05:57'),
(154, '21UCS109', 'Secretary Shift-II', 2, '2024-25', '2024-06-13 23:05:57'),
(155, '21UCS123', 'Secretary Shift-II', 0, '2024-25', '2024-06-13 23:05:57'),
(156, '21UCS107', 'Vice Chairman Both', 12, '2024-25', '2024-06-13 23:05:57'),
(157, '21UCS110', 'Vice Chairman Both', 30, '2024-25', '2024-06-13 23:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `post_id` int(11) NOT NULL,
  `post` varchar(100) NOT NULL,
  `description` varchar(200) NOT NULL,
  `post_shift` enum('Shift-I','Shift-II','Both') NOT NULL,
  `who_can_vote` enum('MF','M','F') NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_on` datetime DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`post_id`, `post`, `description`, `post_shift`, `who_can_vote`, `created_at`, `updated_on`) VALUES
(26, 'Chairman', 'Serves', 'Both', 'MF', '2024-06-19 09:41:33', '2024-06-19 09:41:33'),
(27, 'Vice Chairman', 'Serves', 'Both', 'MF', '2024-06-19 09:41:41', '2024-06-19 09:41:41'),
(28, 'Secretary', 'Serves', 'Shift-I', 'F', '2024-06-19 09:42:01', '2024-06-19 09:42:01'),
(29, 'Join Secretary', 'Serves', 'Shift-I', 'M', '2024-06-19 09:42:17', '2024-06-19 09:42:17'),
(30, 'Secretary', 'Serves', 'Shift-II', 'F', '2024-06-19 09:42:32', '2024-06-19 09:42:32'),
(31, 'Join Secretary', 'Serves', 'Shift-II', 'M', '2024-06-19 09:42:41', '2024-06-19 09:42:41');

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
(112, 1, 90, '2024-06-19 09:52:01', '2024-06-19 09:52:01'),
(113, 1, 92, '2024-06-19 09:52:02', '2024-06-19 09:52:02'),
(114, 1, 96, '2024-06-19 09:52:04', '2024-06-19 09:52:04');

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
  ADD KEY `candidat_id_index` (`candidate_id`),
  ADD KEY `fk_post_candidate` (`post_id`);

--
-- Indexes for table `old_data_table`
--
ALTER TABLE `old_data_table`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `uk_regno_year` (`regno`,`election_year`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `candidates`
--
ALTER TABLE `candidates`
  MODIFY `candidate_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=102;

--
-- AUTO_INCREMENT for table `old_data_table`
--
ALTER TABLE `old_data_table`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=176;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `post_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `vote_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=115;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `candidates`
--
ALTER TABLE `candidates`
  ADD CONSTRAINT `fk_post_candidate` FOREIGN KEY (`post_id`) REFERENCES `position` (`post_id`) ON UPDATE CASCADE;

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `fk_candidate_votes` FOREIGN KEY (`candidate_id`) REFERENCES `candidates` (`candidate_id`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
