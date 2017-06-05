-- phpMyAdmin SQL Dump
-- version 4.6.6
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2017 at 08:30 AM
-- Server version: 10.1.20-MariaDB
-- PHP Version: 7.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id1867110_perevozniy`
--

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(50) NOT NULL,
  `start` varchar(30) NOT NULL,
  `end` varchar(30) NOT NULL,
  `description` text NOT NULL,
  `author` bigint(10) UNSIGNED NOT NULL,
  `status` enum('inprogress','done','new','') NOT NULL DEFAULT 'new',
  `color` varchar(10) NOT NULL DEFAULT '#FFFFFF'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `title`, `start`, `end`, `description`, `author`, `status`, `color`) VALUES
(9, 'June', '2017-06-07 15:00:00', '2017-06-07 18:00:00', 'June', 30, 'new', '#c509e9'),
(10, '44', '2017-06-08 16:00:00', '2017-06-08 18:00:00', '234234', 30, 'new', '#aa0909'),
(11, '1212', '2017-06-08 16:00:00', '2017-06-08 18:00:00', '23123', 30, 'new', '#5c1717'),
(12, 'wssd', '2017-06-04 15:00:00', '2017-06-04 17:15:00', 'asdasd', 30, 'done', '#09e234'),
(13, 'new', '2017-06-08 20:15:00', '2017-06-08 23:15:00', 'dlskfsdjf\';', 30, 'new', '#ca3636'),
(14, 'asasdf', '2017-05-30 19:00:00', '2017-05-31 20:29:59', 'sdgsdfghdf', 30, 'done', '#9b2d2d'),
(17, 'New event', '2017-06-06 20:00:00', '2017-06-06 22:00:00', 'as', 30, 'new', '#e9e900'),
(18, 'New Event', '2017-06-08 22:00:00', '2017-06-08 23:00:00', 'New description', 36, 'new', '#abafd6'),
(19, 'New event', '2017-06-06 19:00:00', '2017-06-06 22:00:00', 'New description', 36, 'new', '#1f2891'),
(22, 'new event', '2017-06-08 18:00:00', '2017-06-08 21:00:00', 'qqwewe', 36, 'new', '#3ef7f7'),
(26, 'Long One', '2017-06-14 23:00:00', '2017-06-23 23:59:59', 'Very very long event', 30, 'new', '#ffff00'),
(29, 'New event', '2017-06-06 10:30:00', '2017-06-06 11:30:00', 'sadasdas', 30, 'new', '#ffeb00'),
(30, 'dfsdfsd', '2017-06-09 04:00:00', '2017-06-09 05:00:00', 'sdfsdfsdf', 36, 'new', '#f724f7'),
(35, 'New event)', '2017-06-01 03:00:00', '2017-06-01 06:00:00', 'Beautiful event!', 38, 'done', '#f61fff'),
(37, 'new onee22', '2017-06-05 04:00:00', '2017-06-05 11:15:00', 'asdasdasd', 30, 'inprogress', '#2600eb'),
(39, 'er', '2017-06-09 07:45:00', '2017-06-09 10:30:00', 'wer', 30, 'new', '#af4444'),
(40, 'new', '2017-06-07 13:00:00', '2017-06-07 14:00:00', 'newOne', 36, 'new', '#ff0000');

-- --------------------------------------------------------

--
-- Table structure for table `invite`
--

CREATE TABLE `invite` (
  `id` int(10) UNSIGNED NOT NULL,
  `hash` varchar(50) NOT NULL,
  `email` varchar(30) NOT NULL,
  `fk_inviter` bigint(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(20) DEFAULT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `authKey` char(50) DEFAULT NULL,
  `isAdmin` int(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password`, `authKey`, `isAdmin`) VALUES
(30, 'Andrey', 'admin@admin.com', '$2y$13$zruEgqnp.9e.Fm9K/da.R.Vmqq8O6FYQeJ4b8R3a7jxf6FjhpjX4S', 'Y5UoCEFj6j84BPIzhgmSqSx7iKE2Y8zf', 1),
(36, NULL, 'muflon_bot@ukr.net', '$2y$13$p.fthUev0CVZatK7.gD4ku1I8n6KKUE8dX00S/QMBvPFdSUksniRy', 'ycXRVAw1-0ewdxxANN9X-Z9TlrUgkTW5', 0),
(37, NULL, 'perevozniy@ukr.net', '$2y$13$Fn4kX.jO3VFJ7tMGXIFL8eLph7/2ICbnapo3uEy3CWi7Y77SfwQ2u', 'GGCKb_lzbgClkFdK4Ap7vICfiOLgGPD_', 0),
(38, NULL, 'czzzech@gmail.com', '$2y$13$VslOF1UQz21K636ey4acxeimVRlNbu6Z0MoLoEWdasFA.nORpY82C', 'Wguwyivqbeellw4uQmuuU58XnR8CUAjw', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `event_name` (`title`),
  ADD KEY `author` (`author`);

--
-- Indexes for table `invite`
--
ALTER TABLE `invite`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invite_email` (`email`),
  ADD UNIQUE KEY `invite_hash` (`hash`),
  ADD KEY `fk_inviter` (`fk_inviter`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `authKey` (`authKey`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;
--
-- AUTO_INCREMENT for table `invite`
--
ALTER TABLE `invite`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `event`
--
ALTER TABLE `event`
  ADD CONSTRAINT `event_ibfk_1` FOREIGN KEY (`author`) REFERENCES `user` (`id`);

--
-- Constraints for table `invite`
--
ALTER TABLE `invite`
  ADD CONSTRAINT `invite_ibfk_1` FOREIGN KEY (`fk_inviter`) REFERENCES `user` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
