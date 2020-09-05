-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 06, 2020 at 01:33 AM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `riskit`
--

-- --------------------------------------------------------

--
-- Table structure for table `estimations`
--

CREATE TABLE `estimations` (
  `riskName` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `impact` int(11) NOT NULL,
  `probability` decimal(5,2) NOT NULL,
  `exposure` double(5,2) NOT NULL,
  `id` int(11) NOT NULL,
  `riskId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `estimations_comments`
--

CREATE TABLE `estimations_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `estimations_posts`
--

CREATE TABLE `estimations_posts` (
  `post_id` int(11) NOT NULL,
  `post_name` text NOT NULL,
  `post_msg` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mitigation_strat_comments`
--

CREATE TABLE `mitigation_strat_comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `mitigation_strat_posts`
--

CREATE TABLE `mitigation_strat_posts` (
  `post_id` int(11) NOT NULL,
  `risk_name` varchar(200) NOT NULL,
  `post_msg` text NOT NULL,
  `riskId` int(11) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `projectname` text NOT NULL,
  `clientname` text NOT NULL,
  `description` text NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`projectname`, `clientname`, `description`, `created_at`, `id`) VALUES
('Something', 'Someone', 'Time for the implementation of the project is not enough', '2020-08-31 15:50:40', 1),
('Risk Assistant', 'Ntroula', 'Ntroula is hungry', '2020-08-31 16:23:28', 2),
('fe', 'gfsd', 'Tech', '2020-09-05 08:57:36', 3),
('Anything', 'Anyone', 'Any Description', '2020-09-05 21:02:18', 4),
('Blue', 'Blue', 'Blue blue', '2020-09-05 21:33:18', 5),
('Ble', 'Ble', 'Ble ble', '2020-09-05 21:36:49', 6);

-- --------------------------------------------------------

--
-- Table structure for table `project_stakeholders`
--

CREATE TABLE `project_stakeholders` (
  `project_id` int(11) DEFAULT NULL,
  `stakeholder_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `riskavg`
--

CREATE TABLE `riskavg` (
  `id` int(11) NOT NULL,
  `riskName` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `impact` int(11) NOT NULL,
  `probability` decimal(3,2) NOT NULL,
  `exposure` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `risktable`
--

CREATE TABLE `risktable` (
  `id` int(11) NOT NULL,
  `riskName` varchar(200) NOT NULL,
  `projectId` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `controlEnv` enum('Internal','External') NOT NULL,
  `riskCat` varchar(200) NOT NULL,
  `rtype` enum('Threat','Opportunity') NOT NULL,
  `phase` varchar(200) NOT NULL,
  `userId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `risktable`
--

INSERT INTO `risktable` (`id`, `riskName`, `projectId`, `description`, `controlEnv`, `riskCat`, `rtype`, `phase`, `userId`) VALUES
(1, 'Time', 0, 'External', '', 'Threat', '', '1', 1),
(2, 'Market', 0, 'External', '', 'Threat', '', '1', 1),
(3, 'Techs', 0, 'Internal', '', 'Opportunity', '', '1', 2);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL,
  `fullname` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`, `updated_at`, `fullname`) VALUES
(1, 'morbus', 'morbus13@gmail.com', '098f6bcd4621d373cade4e832627b4f6', '2020-08-22 12:51:41', '2020-08-22 12:51:41', 'Morbus'),
(2, 'chris', 'c.dileris@hotmail.com', 'test', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 'Christos Dileris');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `estimations`
--
ALTER TABLE `estimations`
  ADD KEY `riskId` (`riskId`),
  ADD KEY `riskName` (`riskName`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `estimations_comments`
--
ALTER TABLE `estimations_comments`
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `mitigation_strat_comments`
--
ALTER TABLE `mitigation_strat_comments`
  ADD KEY `user_name` (`user_name`);

--
-- Indexes for table `mitigation_strat_posts`
--
ALTER TABLE `mitigation_strat_posts`
  ADD KEY `risk_name` (`risk_name`),
  ADD KEY `riskId` (`riskId`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `project_stakeholders`
--
ALTER TABLE `project_stakeholders`
  ADD KEY `FK_users` (`stakeholder_id`),
  ADD KEY `FK_projects` (`project_id`);

--
-- Indexes for table `riskavg`
--
ALTER TABLE `riskavg`
  ADD PRIMARY KEY (`id`),
  ADD KEY `riskName` (`riskName`),
  ADD KEY `description` (`description`),
  ADD KEY `impact` (`impact`),
  ADD KEY `probability` (`probability`),
  ADD KEY `exposure` (`exposure`);

--
-- Indexes for table `risktable`
--
ALTER TABLE `risktable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `riskName` (`riskName`),
  ADD KEY `description` (`description`),
  ADD KEY `projectId` (`projectId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `fullname` (`fullname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `estimations`
--
ALTER TABLE `estimations`
  ADD CONSTRAINT `estimations_ibfk_1` FOREIGN KEY (`riskId`) REFERENCES `risktable` (`id`),
  ADD CONSTRAINT `estimations_ibfk_2` FOREIGN KEY (`riskName`) REFERENCES `risktable` (`riskName`),
  ADD CONSTRAINT `estimations_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `estimations_comments`
--
ALTER TABLE `estimations_comments`
  ADD CONSTRAINT `estimations_comments_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`fullname`);

--
-- Constraints for table `mitigation_strat_comments`
--
ALTER TABLE `mitigation_strat_comments`
  ADD CONSTRAINT `mitigation_strat_comments_ibfk_1` FOREIGN KEY (`user_name`) REFERENCES `users` (`fullname`);

--
-- Constraints for table `mitigation_strat_posts`
--
ALTER TABLE `mitigation_strat_posts`
  ADD CONSTRAINT `mitigation_strat_posts_ibfk_1` FOREIGN KEY (`risk_name`) REFERENCES `risktable` (`riskName`),
  ADD CONSTRAINT `mitigation_strat_posts_ibfk_2` FOREIGN KEY (`riskId`) REFERENCES `risktable` (`id`),
  ADD CONSTRAINT `mitigation_strat_posts_ibfk_3` FOREIGN KEY (`userId`) REFERENCES `users` (`id`);

--
-- Constraints for table `risktable`
--
ALTER TABLE `risktable`
  ADD CONSTRAINT `risktable_ibfk_1` FOREIGN KEY (`projectId`) REFERENCES `projects` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
