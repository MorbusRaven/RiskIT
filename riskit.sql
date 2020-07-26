-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 29, 2020 at 06:00 PM
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
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `post_id` int(11) NOT NULL,
  `user_name` text NOT NULL,
  `user_comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `post_id` int(11) NOT NULL,
  `post_name` text NOT NULL,
  `post_msg` text NOT NULL
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
  `description` varchar(200) NOT NULL,
  `controlEnv` enum('Internal','External') NOT NULL,
  `riskCat` varchar(200) NOT NULL,
  `rtype` enum('Threat','Opportunity') NOT NULL,
  `phase` varchar(200) NOT NULL,
  `fullname` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `risktable`
--

INSERT INTO `risktable` (`id`, `riskName`, `description`, `controlEnv`, `riskCat`, `rtype`, `phase`, `fullname`) VALUES
(1, 'Time', 'Time for the implementation of the project is not enough', 'External', 'Blah', 'Threat', 'Implementation', 'Christos Dileris'),
(2, 'Market', 'Market for this product is under-developed', 'External', 'Economical', 'Threat', 'Sales', 'Morbus'),
(3, 'Techs', 'Programmers will have to use new language', 'Internal', 'Technological', 'Opportunity', 'Implementation', 'Special One'),
(4, 'Budget', 'Client\'s Budget is small for this project', 'External', 'Economical', 'Threat', 'First', 'Chris D'),
(5, 'Product', 'The product is useless', 'External', 'Industrial', 'Threat', 'First', 'Christos Dileris'),
(6, 'Team', 'Programmers are few and will not be available to get the job done in the time that we have', 'Internal', 'Technological', 'Threat', 'Implementation', 'Christos Dileris'),
(7, 'Blah', 'fdsafds', 'Internal', 'Blah', 'Opportunity', 'Blah', 'Siri Siri');

-- --------------------------------------------------------

--
-- Table structure for table `roundtable`
--

CREATE TABLE `roundtable` (
  `id` int(11) NOT NULL,
  `riskName` varchar(200) NOT NULL,
  `description` varchar(200) NOT NULL,
  `impact` int(11) NOT NULL,
  `probability` decimal(3,2) NOT NULL,
  `exposure` double(5,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roundtable`
--

INSERT INTO `roundtable` (`id`, `riskName`, `description`, `impact`, `probability`, `exposure`) VALUES
(1, 'Techs', 'Programmers will have to use new language', 3, '0.40', 1.20),
(2, 'Budget', 'Client\'s Budget is small for this project', 5, '0.65', 3.25);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_comment`
--

CREATE TABLE `tbl_comment` (
  `comment_id` int(11) NOT NULL,
  `parent_comment_id` int(11) NOT NULL,
  `comment` varchar(200) NOT NULL,
  `comment_sender_name` varchar(40) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_comment`
--

INSERT INTO `tbl_comment` (`comment_id`, `parent_comment_id`, `comment`, `comment_sender_name`, `date`) VALUES
(5, 0, 'Hello', 'Chris', '2020-05-29 15:51:55'),
(6, 5, 'This is just for discussions', 'Chris', '2020-05-29 15:52:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `fullname`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Chris', 'gimly123@hotmail.com', 'fullname', '098f6bcd4621d373cade4e832627b4f6', '2020-05-29 15:27:27', '2020-05-29 15:27:27');

--
-- Indexes for dumped tables
--

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
  ADD KEY `description` (`description`);

--
-- Indexes for table `roundtable`
--
ALTER TABLE `roundtable`
  ADD PRIMARY KEY (`id`),
  ADD KEY `impact` (`impact`),
  ADD KEY `exposure` (`exposure`),
  ADD KEY `risks_ibfk_1` (`riskName`),
  ADD KEY `risks_ibfk_2` (`description`),
  ADD KEY `probability` (`probability`);

--
-- Indexes for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `riskavg`
--
ALTER TABLE `riskavg`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `risktable`
--
ALTER TABLE `risktable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roundtable`
--
ALTER TABLE `roundtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_comment`
--
ALTER TABLE `tbl_comment`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `riskavg`
--
ALTER TABLE `riskavg`
  ADD CONSTRAINT `riskavg_ibfk_1` FOREIGN KEY (`riskName`) REFERENCES `risktable` (`riskName`),
  ADD CONSTRAINT `riskavg_ibfk_2` FOREIGN KEY (`description`) REFERENCES `risktable` (`description`),
  ADD CONSTRAINT `riskavg_ibfk_3` FOREIGN KEY (`impact`) REFERENCES `risks` (`impact`),
  ADD CONSTRAINT `riskavg_ibfk_4` FOREIGN KEY (`probability`) REFERENCES `risks` (`probability`),
  ADD CONSTRAINT `riskavg_ibfk_5` FOREIGN KEY (`exposure`) REFERENCES `risks` (`exposure`),
  ADD CONSTRAINT `riskavg_ibfk_6` FOREIGN KEY (`id`) REFERENCES `risktable` (`id`);

--
-- Constraints for table `roundtable`
--
ALTER TABLE `roundtable`
  ADD CONSTRAINT `risks_ibfk_1` FOREIGN KEY (`riskName`) REFERENCES `risktable` (`riskName`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risks_ibfk_2` FOREIGN KEY (`description`) REFERENCES `risktable` (`description`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `risks_ibfk_3` FOREIGN KEY (`id`) REFERENCES `risktable` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
