-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: bs9gwtobw71neuxyxi1r-mysql.services.clever-cloud.com:3306
-- Generation Time: Nov 06, 2022 at 03:28 PM
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
  `entry_date` date NOT NULL,
  `status` enum('done','pending') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkin`
--

INSERT INTO `checkin` (`id`, `client_id`, `height`, `weight`, `waist`, `hip`, `neck`, `cheat_meal`, `fat`, `muscle`, `bmr`, `tdee`, `entry_date`, `status`) VALUES
(31, 1, 173, 96, 114, 121, 44, 'no', 49, 49, 1789, 2147, '2022-10-21', 'done'),
(32, 1, 173, 93, 107, 114, 40, 'no', 45, 51, 1761, 2113, '2022-10-21', 'done'),
(33, 1, 173, 88, 102, 110, 40, 'no', 41, 52, 1713, 2056, '2022-10-21', 'done'),
(34, 1, 173, 78, 89, 102, 37, 'no', 33, 52, 1617, 1940, '2022-10-21', 'done'),
(35, 1, 173, 78, 117, 38, 40, 'no', 13, 68, 1617, 1940, '2022-10-21', 'done'),
(36, 7, 170, 71, 95, 100, 45, 'no', 20, 57, 1739, 2087, '2022-11-05', 'done'),
(37, 1, 171, 77, 82, 90, 40, 'no', 23, 59, 1603, 1924, '2022-11-05', 'done'),
(38, 8, 172, 75, 100, 92, 45, 'no', 30, 52, 1581, 1897, '2022-11-05', 'pending'),
(39, 9, 158, 47, 70, 75, 40, 'no', 11, 42, 1292, 1550, '2022-11-05', 'pending'),
(40, 10, 166, 65, 70, 80, 40, 'no', 12, 57, 1474, 1769, '2022-11-05', 'pending'),
(41, 11, 172, 60, 80, 80, 45, 'no', 7, 56, 1598, 1918, '2022-11-05', 'pending');

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
  `medical` longtext,
  `tdc` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`id`, `trainer_id`, `email`, `name`, `contact`, `dob`, `password`, `gender`, `Address`, `alcohol`, `smoke`, `activity_level`, `goal`, `profession`, `meal_type`, `medical`, `tdc`) VALUES
(1, 1, 'srdeepansr@gmail.com', 'Deepan Vishwa S R', '7550188018', '2001-01-01', '1234567890', 'male', 'Chennai', 'yes', 'yes', '1.2', 'Fat Loss', '', 'Veg', NULL, 2000),
(7, 1, 'r.sudharsanramesh2000@gmail.com', 'Sudharsan R', '8870176294', '2000-04-20', '1234567890', 'male', 'chennai , valasaravakam', 'yes', 'no', '1.2', 'Fat Loss', 'student', 'Veg', 'NA', NULL),
(8, 1, 'kiruthigait2000@gmail.com', 'Kiruthiga D', '8870176294', '2000-04-20', '1234567890', 'female', 'chennai , valasaravakam', 'yes', 'no', '1.2', 'Fat Loss', 'student ', 'Veg', 'NA', NULL),
(9, 1, 'priya@gmail.com', 'Priya', '6090407088', '2001-01-05', '1234567890', 'female', 'golden street,sembanarkovil ', 'no', 'no', '1.2', 'Weight Gain', 'doctor', 'Veg', 'NA', NULL),
(10, 1, 'kd1721@gmail.com', 'Deepika', '7788411520', '2000-05-04', '1234567890', 'female', 'west road ,kodambakam', 'yes', 'yes', '1.2', 'Fat Loss', 'student', 'Veg', 'NA', NULL),
(11, 1, 'adithya@gmail.com', 'Adithiya', '770156485', '2000-11-04', '1234567890', 'male', 'urrapakkam', 'yes', 'yes', '1.2', 'Weight Gain', 'student ', 'Veg', 'NA', NULL);

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
(60, 1, 1, '1', 'pasteurized Toned Milk', '250.0 ml'),
(61, 1, 1, '1', 'Raisins', '10.0 g'),
(62, 1, 1, '1', 'Dates', '3'),
(63, 1, 1, '1', 'Oats', '50 g'),
(64, 1, 1, '1', 'Soaked Almonds', '12'),
(65, 1, 1, '1', 'Boiled Egg White', '4'),
(66, 1, 1, '2', 'Papaya', '100 g'),
(67, 1, 1, '3', 'Boiled Egg', '2'),
(68, 1, 1, '3', 'Pickle', '1 tablespoon'),
(69, 1, 1, '3', 'Plain Curd', '7 tablespoon'),
(70, 1, 1, '4', 'Carrot Raw', '1'),
(71, 1, 1, '4', 'Cucumber', '1'),
(72, 1, 1, '5', 'Pasteurized Toned Milk', '1 glass'),
(73, 1, 1, '5', 'Boiled Egg White', '4'),
(74, 1, 1, '5', 'Chicken Breast', '250 g'),
(75, 1, 1, '3', 'White Rice', '200 g');

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
(33, 1, '2022-10-21', '1', '2022-11-21'),
(34, 7, '2022-11-05', '1', '2022-12-05'),
(35, 8, '2022-11-05', '1', '2022-12-05'),
(36, 9, '2022-11-05', '1', '2022-12-05'),
(37, 10, '2022-11-05', '1', '2022-12-05'),
(39, 11, '2022-11-05', '6', '2023-02-05');

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
(1, 'Sudharsan', 'sudharsan@gmail.com', '1234567890', '87841224');

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
(32, 1, 1, 'Dumbbell Bench Press', 4, 15, '1'),
(33, 1, 1, 'Dumbbell incline Press', 3, 15, '1'),
(34, 1, 1, 'Dumbbell flat fly', 3, 15, '1'),
(35, 1, 1, 'Cable Crossover', 3, 15, '1'),
(36, 1, 1, 'Triceps pushdown(Rope)', 3, 15, '1'),
(37, 1, 1, 'Machine dips', 3, 15, '1'),
(38, 1, 1, 'Pull ups', 4, 15, '2'),
(39, 1, 1, 'Barbell row', 3, 15, '2'),
(40, 1, 1, 'close/reverse lat pulldown', 3, 15, '2'),
(41, 1, 1, 'one arm dumbell row', 3, 12, '2'),
(42, 1, 1, 'Incline dumbbell curl', 3, 15, '2'),
(43, 1, 1, 'Dumbbell hammer curl', 3, 15, '2'),
(44, 1, 1, 'smith m/c shoulder press', 3, 15, '3'),
(45, 1, 1, 'Dumbbell hammer raise', 3, 15, '3'),
(46, 1, 1, 'Dumbbell lateral raise', 3, 15, '3'),
(47, 1, 1, 'Facepull', 3, 15, '3'),
(48, 1, 1, 'Uprigt row', 3, 15, '3'),
(49, 1, 1, 'Dumbbell Wrist flexion', 3, 15, '3'),
(50, 1, 1, 'Smith back squat', 4, 15, '4'),
(51, 1, 1, 'Leg press', 3, 15, '4'),
(52, 1, 1, 'Leg extension', 3, 15, '4'),
(53, 1, 1, 'Leg curl', 3, 12, '4'),
(54, 1, 1, 'Standing calf raise', 3, 15, '4'),
(55, 1, 1, 'Decline sit-ups', 3, 20, '5'),
(56, 1, 1, 'Hunderds', 3, 15, '5'),
(57, 1, 1, 'Leg raise', 4, 20, '5'),
(58, 1, 1, 'Scissors', 4, 20, '5'),
(59, 1, 1, 'Puise up', 4, 15, '5'),
(60, 1, 1, 'jumping jack', 3, 15, '6'),
(61, 1, 1, 'Butkick', 3, 15, '6'),
(62, 1, 1, 'stepper', 3, 15, '6'),
(63, 1, 1, 'Ball drop', 3, 15, '6'),
(64, 1, 1, 'plank', 3, 15, '6'),
(65, 1, 1, 'High knees', 3, 15, '6'),
(66, 1, 1, 'Cross Crunches', 3, 15, '5');

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
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `diet_chart`
--
ALTER TABLE `diet_chart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `paymet_info`
--
ALTER TABLE `paymet_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `trainer`
--
ALTER TABLE `trainer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `workout_chart`
--
ALTER TABLE `workout_chart`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;

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
