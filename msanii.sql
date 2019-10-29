-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 24, 2019 at 12:31 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.1.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `msanii`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `booking_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `photographer_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `approved` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_date`, `start_time`, `end_time`, `location_id`, `photographer_id`, `model_id`, `description`, `approved`) VALUES
(1, '2019-11-22', '12:50:00', '15:50:00', 1, 1, 1, '', ''),
(2, '2019-10-24', '12:54:00', '18:54:00', 1, 1, 1, 'Magazine Photoshoot', ''),
(3, '2020-09-23', '07:45:00', '11:44:00', 1, 1, 1, 'Instagram revamp', '');

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(60) DEFAULT NULL,
  `location_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `photographer_id` int(11) DEFAULT NULL,
  `caption` text NOT NULL,
  `date_uploaded` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`image_id`, `image_name`, `location_id`, `model_id`, `photographer_id`, `caption`, `date_uploaded`) VALUES
(7, 'AARH5561.JPG', 1, 1, 1, 'babyshoweress', '2019-10-21 17:39:26'),
(10, 'IMG_0009.JPG', 1, 1, 1, '', '2019-10-24 09:31:04');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` text NOT NULL,
  `city` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `description` text NOT NULL,
  `verified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `city`, `email`, `description`, `verified`) VALUES
(1, 'Home', 'Nairobi', 'home@mtaani.com', 'East or West...', '');

-- --------------------------------------------------------

--
-- Table structure for table `model`
--

CREATE TABLE `model` (
  `model_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` text NOT NULL,
  `email` text NOT NULL,
  `password` text NOT NULL,
  `verified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `model`
--

INSERT INTO `model` (`model_id`, `first_name`, `last_name`, `username`, `email`, `password`, `verified`) VALUES
(1, 'Karma', 'Vishnu', 'k_vishnu4', 'vishnu4@gmail.com', '', ''),
(3, 'Jane', 'Makabala', 'j_makabala', 'jmakabala@gmail.com', 'ab47ea0a7ec86aafc28df89f35a2df20', '');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `first_name` tinytext DEFAULT NULL,
  `last_name` tinytext DEFAULT NULL,
  `phone_number` text DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `verified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `first_name`, `last_name`, `phone_number`, `email`, `password`, `verified`) VALUES
(1, 'Jack', 'Bauer', '0722123457', 'jbauer@gmail.com', NULL, 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `photographers`
--

CREATE TABLE `photographers` (
  `photographer_id` int(11) NOT NULL,
  `first_name` text NOT NULL,
  `last_name` text NOT NULL,
  `username` text NOT NULL,
  `email` varchar(40) NOT NULL,
  `expertise` text NOT NULL,
  `bio` text NOT NULL,
  `password` text NOT NULL,
  `verified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `photographers`
--

INSERT INTO `photographers` (`photographer_id`, `first_name`, `last_name`, `username`, `email`, `expertise`, `bio`, `password`, `verified`) VALUES
(1, 'John', 'Mark', 'omiesh105', 'omiesh@gmail.com', 'Urban fashion', '', '', 'YES'),
(2, 'Matthew', 'Orieng', 'riengski_', 'morieng@gmail.com', 'Scenery', '', 'c1ff0c2134ce2661edb0ebfc0722ab5f', ''),
(3, '', '', '', '', '', '', 'd41d8cd98f00b204e9800998ecf8427e', '');

-- --------------------------------------------------------

--
-- Table structure for table `profileimages`
--

CREATE TABLE `profileimages` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(60) DEFAULT NULL,
  `username` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profileimages`
--

INSERT INTO `profileimages` (`image_id`, `image_name`, `username`) VALUES
(1, 'cupcake.jpg', 'root'),
(2, 'IMG_0009.JPG', 'root');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `photographer_id` (`photographer_id`),
  ADD KEY `model_id` (`model_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`image_id`),
  ADD KEY `location_id` (`location_id`),
  ADD KEY `model_id` (`model_id`),
  ADD KEY `photographer_id` (`photographer_id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`location_id`);

--
-- Indexes for table `model`
--
ALTER TABLE `model`
  ADD PRIMARY KEY (`model_id`);

--
-- Indexes for table `owner`
--
ALTER TABLE `owner`
  ADD PRIMARY KEY (`owner_id`);

--
-- Indexes for table `photographers`
--
ALTER TABLE `photographers`
  ADD PRIMARY KEY (`photographer_id`);

--
-- Indexes for table `profileimages`
--
ALTER TABLE `profileimages`
  ADD PRIMARY KEY (`image_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `photographers`
--
ALTER TABLE `photographers`
  MODIFY `photographer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `profileimages`
--
ALTER TABLE `profileimages`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`photographer_id`) REFERENCES `photographers` (`photographer_id`),
  ADD CONSTRAINT `bookings_ibfk_3` FOREIGN KEY (`model_id`) REFERENCES `model` (`model_id`);

--
-- Constraints for table `images`
--
ALTER TABLE `images`
  ADD CONSTRAINT `images_ibfk_1` FOREIGN KEY (`location_id`) REFERENCES `location` (`location_id`),
  ADD CONSTRAINT `images_ibfk_2` FOREIGN KEY (`model_id`) REFERENCES `model` (`model_id`),
  ADD CONSTRAINT `images_ibfk_3` FOREIGN KEY (`photographer_id`) REFERENCES `photographers` (`photographer_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
