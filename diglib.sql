-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 22, 2021 at 05:07 PM
-- Server version: 10.4.17-MariaDB
-- PHP Version: 8.0.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `diglib`
--

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE `claims` (
  `user_email` longtext NOT NULL,
  `claim_name` longtext NOT NULL,
  `reproduce` longtext NOT NULL,
  `sourcecode` longtext NOT NULL,
  `datasets` longtext NOT NULL,
  `expresults` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp(),
  `handleId` bigint(8) NOT NULL,
  `claim_number` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`user_email`, `claim_name`, `reproduce`, `sourcecode`, `datasets`, `expresults`, `timestamp`, `handleId`, `claim_number`) VALUES
('ssang004@odu.edu', 'my 1st claim', 'Yes', 'test', 'test', 'loili', '2021-04-22 04:58:42', 25954, 1),
('ssang004@odu.edu', 'tkl,', 'Yes', 'hj', 'hjk', 'hjkhjk', '2021-04-22 04:59:00', 25954, 2),
('ssang004@odu.edu', 'my 1st claim', 'No', 'test', 'test', 'cgfghfgh', '2021-04-22 08:31:16', 25954, 3),
('ssang004@odu.edu', 'fdsgdfhdfgh', 'Partially', 'hg', 'sdffgv', 'fbgvdfg', '2021-04-22 08:31:49', 25954, 4);

-- --------------------------------------------------------

--
-- Table structure for table `favourites`
--

CREATE TABLE `favourites` (
  `email` longtext NOT NULL,
  `handleId` bigint(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `favourites`
--

INSERT INTO `favourites` (`email`, `handleId`) VALUES
('ssang004@odu.edu', 25954),
('ssang004@odu.edu', 28980),
('ssang004@odu.edu', 28319),
('ssang004@odu.edu', 26181);

-- --------------------------------------------------------

--
-- Table structure for table `like_dislike`
--

CREATE TABLE `like_dislike` (
  `user_email` longtext NOT NULL,
  `handleId` bigint(255) NOT NULL,
  `claim_number` bigint(255) NOT NULL,
  `like_claim` bigint(255) NOT NULL DEFAULT 0,
  `dislike_claim` bigint(255) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `like_dislike`
--

INSERT INTO `like_dislike` (`user_email`, `handleId`, `claim_number`, `like_claim`, `dislike_claim`) VALUES
('ssang004@odu.edu', 25954, 1, 0, 1),
('ssang004@odu.edu', 25954, 2, 1, 0),
('ssang004@odu.edu', 25954, 3, 0, 1),
('ssang004@odu.edu', 25954, 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `hash` varchar(1000) NOT NULL,
  `active` int(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `lname`, `email`, `password`, `hash`, `active`) VALUES
('Sai Kiran Sangam', '', 'kiransai1111@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('Sai Kiran Sangam', '', 'kiransai111@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('Sai Kiran Sangam', '', 'kiransai112@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('Sai Kiran Sangam', '', 'kiransai11@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('kiran', '', 'kiransai1@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('Sangam Sai Kiran', '', 'sai45@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('sai', '', 'sai@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('Sai Kiran', 'Sangam', 'saikiran.sangam7@gmail.com', '098306566be9c3d1626c418c77096201', '07cdfd23373b17c6b337251c22b7ea57', 1),
('saikiran', '', 'saikiran@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('sai', '', 'saitest@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('saikiran', '', 'sangam77@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('SAikiran', '', 'sangam7@gmail.com', 'c1d9f50f86825a1a2302ec2449c17196', '', 0),
('skrn', '', 'skrnsangam@gmail.com', '364cc5dc26f5b73e2c1b538822c31374', '43fa7f58b7eac7ac872209342e62e8f1', 1),
('Sukesh', 'Sangam', 'skshsngm@gmail.com', '6fabedd7fc0186175c2360638fc3d446', 'f7664060cc52bc6f3d620bcedc94a4b6', 1),
('Sai Kiran', 'Sangam', 'ssang004@odu.edu', 'cbfcdf6865b58d28c232b6a5ec27b550', '46922a0880a8f11f8f69cbb52b1396be', 1),
('test', '', 'test1@g.com', 'c1d9f50f86825a1a2302ec2449c17196', '8c235f89a8143a28a1d6067e959dd858', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD UNIQUE KEY `UC_users` (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
