-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 13, 2021 at 06:59 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `evolt1`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `userId` char(6) NOT NULL,
  `name` varchar(20) NOT NULL,
  `surname` varchar(20) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`userId`, `name`, `surname`, `password`) VALUES
('51h0xA', 'Asim', 'Asimić', 'afghsdf'),
('4iW3wx', 'Denis', 'Denisić', 'dscab'),
('tL1lM4', 'Dževad', 'Dževadić', 'zutkld'),
('siaDwH', 'Husein', 'Fazlić', 'qwertz'),
('8JnovJ', 'Ismet', 'Ismetić', 'ghfjd'),
('UtA1Pn', 'Jasmin', 'Jasminić', 'opsdiu');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `messageId` int(10) UNSIGNED NOT NULL,
  `text` char(255) NOT NULL,
  `writer` char(6) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`messageId`, `text`, `writer`, `date`) VALUES
(1, 'Super', '51h0xA', '2021-10-10 20:20:00'),
(2, 'OK!', '4iW3wx', '2021-10-11 09:17:05'),
(24, 'Odlično', 'UtA1Pn', '2021-10-11 22:48:16'),
(25, 'Sjajno', 'tL1lM4', '2021-10-11 22:49:46'),
(26, 'Bravo', '8JnovJ', '2021-10-11 22:55:54'),
(31, 'Sport', 'siaDwH', '2021-10-12 23:09:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`userId`),
  ADD UNIQUE KEY `name` (`name`,`surname`,`password`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`messageId`),
  ADD KEY `FOREIGN` (`writer`) USING BTREE;

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `messageId` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `message`
--
ALTER TABLE `message`
  ADD CONSTRAINT `FOREIGN` FOREIGN KEY (`writer`) REFERENCES `account` (`userId`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
