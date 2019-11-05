-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 05, 2019 at 11:48 AM
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
  `client_name` varchar(40) NOT NULL,
  `location_id` int(11) DEFAULT NULL,
  `photographer_id` int(11) DEFAULT NULL,
  `model_id` int(11) DEFAULT NULL,
  `description` text NOT NULL,
  `location_approve` text NOT NULL,
  `photographer_approve` text NOT NULL,
  `model_approve` text NOT NULL,
  `completed` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `booking_date`, `start_time`, `end_time`, `client_name`, `location_id`, `photographer_id`, `model_id`, `description`, `location_approve`, `photographer_approve`, `model_approve`, `completed`) VALUES
(1, '2019-11-22', '12:50:00', '15:50:00', 'riengski_', 1, 1, 1, '', 'YES', '', 'YES', ''),
(2, '2019-10-24', '12:54:00', '18:54:00', 'omiesh105', 1, 1, 1, 'Magazine Photoshoot', '', '', '', ''),
(3, '2020-09-23', '07:45:00', '11:44:00', 'g_cooker', 1, 1, 1, 'Instagram revamp', 'YES', '', '', ''),
(5, '2020-10-27', '15:43:00', '20:45:00', 'j_makabala', 4, 5, 1, 'Wedding after party', '', 'YES', '', ''),
(7, '2020-10-02', '12:20:00', '16:40:00', 'riengski_', 4, 5, 1, 'Magazine Photoshoot', '', 'YES', 'YES', ''),
(8, '2019-10-02', '13:20:00', '17:30:00', 'riengski_', 1, 2, 1, 'Kujibamba', 'NO', 'YES', '', ''),
(18, '2019-12-05', '09:50:00', '10:50:00', 'client', 4, 4, 1, 'Wedding after party', '', '', '', ''),
(19, '2019-11-05', '09:51:00', '09:51:00', 'client', 4, 4, 0, 'Magazine Photoshoot', '', '', '', ''),
(22, '0000-00-00', '00:00:00', '00:00:00', '', 3, 4, 4, '', '', '', '', ''),
(24, '2019-11-05', '02:55:00', '09:55:00', 'client', 1, 4, 0, 'Instagram revamp', '', '', '', ''),
(25, '2019-11-05', '10:03:00', '10:03:00', 'client', 1, 4, 0, 'Wedding after party', '', '', '', ''),
(26, '2019-11-05', '10:16:00', '10:16:00', 'client', 4, 5, 0, 'Instagram revamp', '', '', '', ''),
(27, '2019-11-05', '10:18:00', '10:18:00', 'client', 4, 1, 0, 'Kujibamba', '', '', '', ''),
(28, '2019-11-05', '10:19:00', '10:19:00', 'client', 1, 5, 0, 'Instagram revamp', '', 'YES', '', ''),
(29, '2019-11-05', '10:19:00', '10:19:00', 'client', 1, 5, 0, 'Instagram revamp', '', '', '', ''),
(31, '2019-11-05', '10:21:00', '10:21:00', 'y_sobhuza@gmail.com', 1, 5, 4, 'Instagram revamp', '', '', '', ''),
(32, '2019-11-05', '10:26:00', '10:26:00', 'n_mungai@gmail.com', 1, 5, 4, 'Final clubbing', '', '', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `client_id` int(11) NOT NULL,
  `first_name` tinytext DEFAULT NULL,
  `last_name` tinytext DEFAULT NULL,
  `email` varchar(40) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `profile_image` text DEFAULT NULL,
  `verified` tinytext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(11) NOT NULL,
  `event_name` text NOT NULL,
  `event_date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `event_location` text NOT NULL,
  `complete` char(1) NOT NULL,
  `cancelled` char(1) NOT NULL,
  `do` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(10, 'IMG_0009.JPG', 1, 1, 1, '', '2019-10-24 09:31:04'),
(11, 'dp1.jpg', 4, 1, 5, 'Washa!', '2019-10-27 18:04:00'),
(12, 'MARPIC.jpg', 4, 3, 5, 'Kichwa', '2019-10-27 18:56:59'),
(13, 'MARPIC.jpg', 5, 4, 5, 'Wowowo', '2019-10-29 13:13:47'),
(14, 'dp3.jpg', 4, 5, 5, 'Stretcher', '2019-10-29 13:15:04'),
(15, 'dp1.jpg', 4, 3, 2, 'Fire', '2019-10-31 08:34:43');

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `location_id` int(11) NOT NULL,
  `location_name` text NOT NULL,
  `city` text NOT NULL,
  `description` text NOT NULL,
  `image_name` text NOT NULL,
  `verified` text NOT NULL,
  `owner_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`location_id`, `location_name`, `city`, `description`, `image_name`, `verified`, `owner_id`) VALUES
(1, 'Home', 'Nairobi', 'East or West...', '', '', 3),
(3, '', '', '', '', '', NULL),
(4, 'Maasai Lodge', 'Narok', 'One with nature', 'MARPIC.jpg', '', 2),
(5, 'Uhuru Gardens', 'Nairobi', '', 'dp1.jpg', '', 2);

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
(0, '', '', '', '', '', ''),
(1, 'Karma', 'Vishnu', 'k_vishnu4', 'vishnu4@gmail.com', '', ''),
(3, 'Jane', 'Makabala', 'j_makabala', 'jmakabala@gmail.com', 'ab47ea0a7ec86aafc28df89f35a2df20', ''),
(4, 'Michelle', 'Kalundu', 'm_kalundu', 'mkalundu@gmail.com', 'f8294eaaabcf580e1c473c0ad0a786d2', ''),
(5, 'Yolanda', 'Sobhuza', 'y_sobhuza', 'y_sobhuza@gmail.com', 'bb72bfc406effe7131fa1fb38ea36001', '');

-- --------------------------------------------------------

--
-- Table structure for table `owner`
--

CREATE TABLE `owner` (
  `owner_id` int(11) NOT NULL,
  `first_name` tinytext DEFAULT NULL,
  `last_name` tinytext DEFAULT NULL,
  `username` text NOT NULL,
  `phone_number` text DEFAULT NULL,
  `email` varchar(35) DEFAULT NULL,
  `password` text DEFAULT NULL,
  `verified` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `owner`
--

INSERT INTO `owner` (`owner_id`, `first_name`, `last_name`, `username`, `phone_number`, `email`, `password`, `verified`) VALUES
(1, 'Jack', 'Bauer', 'j_bauer', '0722123457', 'jbauer@gmail.com', NULL, 'YES'),
(2, 'Ngugi', 'Mungai', 'n_mungai', '', 'n_mungai@gmail.com', '2095c674c9542cb2e84772d831edeb7d', ''),
(3, 'Fredrick', 'Masoups', 'f_masoups', '0727348104', 'f_masoups@gmail.com', NULL, '');

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
(4, 'Antony', 'Michaels', 'a_michaels', 'amichaels@gmail.com', 'Urban fashion', '', 'a657a64b2ef13ed9fcc1657aa74769fc', ''),
(5, 'Gas', 'Cooker', 'g_cooker', 'gcooker@gmail.com', 'Scenery', 'Mimi ndimi mimi', 'f972f2c3c48bbec0210f9f4fa14ed23e', '');

-- --------------------------------------------------------

--
-- Table structure for table `profileimages`
--

CREATE TABLE `profileimages` (
  `image_id` int(11) NOT NULL,
  `image_name` varchar(60) DEFAULT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profileimages`
--

INSERT INTO `profileimages` (`image_id`, `image_name`, `username`) VALUES
(1, 'cupcake.jpg', 'root'),
(2, 'IMG_0009.JPG', 'root'),
(3, 'IMG_0008.JPG', 'root'),
(4, 'IMG_0028.JPG', 'a_michaels'),
(5, 'gascooker.png', 'g_cooker'),
(6, 'dp1.jpg', 'm_kalundu'),
(7, 'dp2.jpg', 'y_sobhuza'),
(8, 'dp3.jpg', 'n_mungai'),
(9, 'dp3.jpg', 'riengski_');

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
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

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
  ADD PRIMARY KEY (`location_id`),
  ADD KEY `owner_id` (`owner_id`);

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
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `location`
--
ALTER TABLE `location`
  MODIFY `location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `model`
--
ALTER TABLE `model`
  MODIFY `model_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `owner`
--
ALTER TABLE `owner`
  MODIFY `owner_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `photographers`
--
ALTER TABLE `photographers`
  MODIFY `photographer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `profileimages`
--
ALTER TABLE `profileimages`
  MODIFY `image_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

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

--
-- Constraints for table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `location_ibfk_1` FOREIGN KEY (`owner_id`) REFERENCES `owner` (`owner_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
