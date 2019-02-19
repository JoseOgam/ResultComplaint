-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Feb 16, 2019 at 07:46 PM
-- Server version: 10.0.36-MariaDB-0ubuntu0.16.04.1
-- PHP Version: 7.0.32-3+ubuntu16.04.1+deb.sury.org+1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trello`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `role` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admins`
--

INSERT INTO `admins` (`id`, `username`, `email`, `status`, `role`, `password`) VALUES
(1, 'john', 'john@example.com', 'Active', 'Admin', '12345'),
(2, 'jane', 'jane@example.com', 'Active', 'Admin', '12345');

-- --------------------------------------------------------

--
-- Table structure for table `issues`
--

CREATE TABLE `issues` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `regno` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `date_raised` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `date_closed` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `issues`
--

INSERT INTO `issues` (`id`, `title`, `description`, `regno`, `status`, `date_raised`, `date_closed`) VALUES
(1, 'Exam Card', 'i am unable to download my exam card', 'IN16/20268/15', 'in_que', '2018-12-16 15:20:35', '0000-00-00 00:00:00'),
(2, 'Report card', 'requesting for my second year report card', 'IN16/20268/15', 'in_que', '2018-12-16 15:24:23', '0000-00-00 00:00:00'),
(3, 'graduation', 'how much is the graduation gawn', 'IN16/20268/15', 'complete', '2018-12-16 17:44:14', '0000-00-00 00:00:00'),
(4, 'Bursary ', 'my bursary is not reflecting in the system', 'IN16/20268/15', 'in_que', '2018-12-16 17:44:14', '0000-00-00 00:00:00'),
(5, 'laptop lost', 'sdgfhgghjhkjk', 'IN16/20268/15', 'complete', '2018-12-26 17:33:35', '0000-00-00 00:00:00'),
(6, 'Transcript', 'requesting for my second year transcript in16/12234/15', 'IN16/20268/15', 'in_que', '2019-01-23 08:36:45', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `issue_progress`
--

CREATE TABLE `issue_progress` (
  `id` int(11) NOT NULL,
  `issue_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `time_received` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `progress` varchar(255) NOT NULL,
  `remarks` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `regno` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `adm_year` date NOT NULL,
  `end_year` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `regno`, `email`, `password`, `status`, `adm_year`, `end_year`) VALUES
(1, 'IN16/20268/15', 'script@example.com', '12345', 'Active', '2015-09-03', '2019-04-12'),
(2, 'IN16/20265/15', 'robin@example.com', '12345', 'Active', '2015-09-03', '2019-04-12'),
(3, 'IN16/20266/15', 'decco@example.com', '12345', 'Active', '2015-09-03', '2019-04-12'),
(4, 'IN16/20281/15', 'brian@example.com', '12345', 'Active', '2015-09-03', '2019-04-12');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issues`
--
ALTER TABLE `issues`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `issue_progress`
--
ALTER TABLE `issue_progress`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `issues`
--
ALTER TABLE `issues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `issue_progress`
--
ALTER TABLE `issue_progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
