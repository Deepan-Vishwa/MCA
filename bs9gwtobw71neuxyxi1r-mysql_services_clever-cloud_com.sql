-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bs9gwtobw71neuxyxi1r-mysql.services.clever-cloud.com:3306
-- Generation Time: Oct 08, 2022 at 09:55 AM
-- Server version: 8.0.22-13
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bs9gwtobw71neuxyxi1r`
--
CREATE DATABASE IF NOT EXISTS `bs9gwtobw71neuxyxi1r` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `bs9gwtobw71neuxyxi1r`;

-- --------------------------------------------------------

--
-- Table structure for table `checkin`
--

CREATE TABLE `checkin` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `height` float NOT NULL,
  `weight` float NOT NULL,
  `waist` float NOT NULL,
  `hip` float NOT NULL,
  `neck` float NOT NULL,
  `cheat_meal` enum('yes','no') NOT NULL,
  `fat` float NOT NULL,
  `muscle` float NOT NULL,
  `bmr` int NOT NULL,
  `tdee` int NOT NULL,
  `entry_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `client_id`, `height`, `weight`, `waist`, `hip`, `neck`, `cheat_meal`, `fat`, `muscle`, `bmr`, `tdee`, `entry_date`) VALUES
(1, 1, 173, 96.9, 114, 121, 44.5, 'no', 32, 65, 0, 0, '2022-08-04'),
(2, 1, 173, 93.5, 105, 115, 42, 'no', 28, 67, 0, 0, '2022-09-04'),
(3, 1, 173, 88.2, 102, 110, 40.5, 'no', 28, 63, 0, 0, '2022-10-04'),
(4, 1, 173, 85, 89, 95, 40, 'no', 19, 69, 0, 0, '2022-10-06'),
(5, 1, 173, 79, 87, 90, 35, 'no', 21, 62, 0, 0, '2022-10-06'),
(6, 1, 173, 75, 85, 90, 37, 'no', 18, 61, 0, 0, '2022-10-06'),
(7, 1, 173, 82, 90, 98, 41, 'no', 19, 66, 0, 0, '2022-10-06'),
(8, 1, 173, 89, 97, 99, 35, 'no', 28, 64, 0, 0, '2022-10-06'),
(9, 1, 173, 79, 97, 100, 35, 'no', 28, 57, 0, 0, '2022-10-06'),
(16, 6, 163, 69, 89, 95, 40, 'no', 31, 48, 1512, 2079, '2022-10-07'),
(17, 1, 173, 89, 89, 89, 67, 'no', 11, 79, 1722, 2066, '2022-10-08'),
(18, 1, 173, 89, 89, 90, 40, 'no', 26, 66, 1722, 2066, '2022-10-08');

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `id` int NOT NULL,
  `trainer_id` int NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(10) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(15) NOT NULL,
  `gender` enum('male','female') CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  `Address` varchar(100) NOT NULL,
  `alcohol` enum('yes','no') NOT NULL,
  `smoke` enum('yes','no') NOT NULL,
  `activity_level` enum('1.2','1.375','1.55','1.725','1.9') NOT NULL,
  `goal` enum('Fat Loss','Weight Gain') NOT NULL,
  `profession` varchar(70) NOT NULL,
  `meal_type` enum('Veg','Non-veg') NOT NULL,
  `medical` longtext
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `trainer_id`, `email`, `name`, `contact`, `dob`, `password`, `gender`, `Address`, `alcohol`, `smoke`, `activity_level`, `goal`, `profession`, `meal_type`, `medical`) VALUES
(1, 1, 'srdeepansr@gmail.com', 'Deepan Vishwa S R', '7550188018', '2001-01-01', '1234567890', 'male', '', 'yes', 'yes', '1.2', 'Fat Loss', '', 'Veg', NULL),
(6, 1, 'kiruthigait2000@gmail.com', 'Kiruthiga', '0987654321', '2000-12-03', '1234567890', 'female', 'chennai', 'no', 'no', '1.2', 'Fat Loss', 'student', 'Veg', '');

-- --------------------------------------------------------

--
-- Table structure for table `diet_chart`
--

CREATE TABLE `diet_chart` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `trainer_id` int NOT NULL,
  `meal` enum('1','2','3','4','5') NOT NULL,
  `item` varchar(70) NOT NULL,
  `quantity` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `diet_chart`
--

INSERT INTO `diet_chart` (`id`, `client_id`, `trainer_id`, `meal`, `item`, `quantity`) VALUES
(53, 1, 1, '1', 'oats', '30 g');

-- --------------------------------------------------------

--
-- Table structure for table `paymet_info`
--

CREATE TABLE `paymet_info` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `date` date NOT NULL,
  `sub_type` enum('1','3','6','12') NOT NULL,
  `due` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `paymet_info`
--

INSERT INTO `paymet_info` (`id`, `client_id`, `date`, `sub_type`, `due`) VALUES
(1, 1, '2022-09-26', '1', '0000-00-00'),
(5, 6, '2022-10-07', '6', '2023-01-07'),
(6, 1, '2022-10-08', '1', '2022-11-08'),
(7, 1, '2022-10-08', '1', '2022-11-08');

-- --------------------------------------------------------

--
-- Table structure for table `trainer`
--

CREATE TABLE `trainer` (
  `id` int NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(60) NOT NULL,
  `password` varchar(50) NOT NULL,
  `contact` varchar(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `trainer`
--

INSERT INTO `trainer` (`id`, `name`, `email`, `password`, `contact`) VALUES
(1, 'Admin', 'admin@gmail.com', '1234567890', '87841224');

-- --------------------------------------------------------

--
-- Table structure for table `workout_chart`
--

CREATE TABLE `workout_chart` (
  `id` int NOT NULL,
  `client_id` int NOT NULL,
  `trainer_id` int NOT NULL,
  `workout` varchar(50) NOT NULL,
  `sets` int NOT NULL,
  `rep` int NOT NULL,
  `day` enum('1','2','3','4','5','6','7') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `workout_chart`
--

INSERT INTO `workout_chart` (`id`, `client_id`, `trainer_id`, `workout`, `sets`, `rep`, `day`) VALUES
(13, 1, 1, 'test3', 25, 1, '3');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkin`
--
ALTER TABLE `checkin`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `diet_chart`
--
ALTER TABLE `diet_chart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `diet_chart_ibfk_1` (`client_id`),
  ADD KEY `diet_chart_ibfk_2` (`trainer_id`);

--
-- Indexes for table `paymet_info`
--
ALTER TABLE `paymet_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`);

--
-- Indexes for table `trainer`
--
ALTER TABLE `trainer`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workout_chart`
--
ALTER TABLE `workout_chart`
  ADD PRIMARY KEY (`id`),
  ADD KEY `client_id` (`client_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkin`
--
ALTER TABLE `checkin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `diet_chart`
--
ALTER TABLE `diet_chart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `paymet_info`
--
ALTER TABLE `paymet_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workout_chart`
--
ALTER TABLE `workout_chart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `checkin`
--
ALTER TABLE `checkin`
  ADD CONSTRAINT `checkin_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `client`
--
ALTER TABLE `client`
  ADD CONSTRAINT `client_ibfk_1` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `diet_chart`
--
ALTER TABLE `diet_chart`
  ADD CONSTRAINT `diet_chart_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `diet_chart_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `paymet_info`
--
ALTER TABLE `paymet_info`
  ADD CONSTRAINT `paymet_info_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;

--
-- Constraints for table `workout_chart`
--
ALTER TABLE `workout_chart`
  ADD CONSTRAINT `workout_chart_ibfk_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT,
  ADD CONSTRAINT `workout_chart_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `trainer` (`id`) ON DELETE RESTRICT ON UPDATE RESTRICT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
