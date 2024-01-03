-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: May 23, 2023 at 08:49 PM
-- Server version: 5.7.39
-- PHP Version: 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `Renting`
--

-- --------------------------------------------------------

--
-- Table structure for table `ApplicationStatus`
--

CREATE TABLE `ApplicationStatus` (
  `id` int(10) NOT NULL,
  `status` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ApplicationStatus`
--

INSERT INTO `ApplicationStatus` (`id`, `status`) VALUES
(0, 'accepted'),
(1, 'declined'),
(2, 'under consideration');

-- --------------------------------------------------------

--
-- Table structure for table `HomeOwner`
--

CREATE TABLE `HomeOwner` (
  `id` int(10) NOT NULL,
  `name` varchar(15) NOT NULL,
  `phone_number` varchar(12) NOT NULL,
  `email_address` varchar(45) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `HomeOwner`
--

INSERT INTO `HomeOwner` (`id`, `name`, `phone_number`, `email_address`, `password`) VALUES
(0, 'Sarah Ahmad', '0501800021', 'SarahAhmad@gmail.com', '$2y$10$4GzJAbYF2lb4ItQCcj//vudry2P/GciCu94w8xV6S/mTcSKWpW9Zy'),
(1, 'Leena Mohammed', '0505198512', 'LeenaMohammed@gmail.com', '$2y$10$F/AOaZge2aIQSjeT.NDNv.8zvvVDA6Tu02UlbQFOWWYVZRN.ifWsO'),
(2, 'Ahmad Fahad', '0561947002', 'AhmadFahad@gmail.com', '$2y$10$mkwhfd4LFw9/QrAMFYvwNeoyxzegNDRNImk/E.oIT2eWYX2ewde1q');

-- --------------------------------------------------------

--
-- Table structure for table `HomeSeeker`
--

CREATE TABLE `HomeSeeker` (
  `id` int(10) NOT NULL,
  `first_name` varchar(15) NOT NULL,
  `last_name` varchar(15) NOT NULL,
  `age` int(11) NOT NULL,
  `family_member` int(11) NOT NULL,
  `income` float NOT NULL,
  `job` varchar(20) NOT NULL,
  `phone_number` varchar(13) NOT NULL,
  `email_address` varchar(45) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `HomeSeeker`
--

INSERT INTO `HomeSeeker` (`id`, `first_name`, `last_name`, `age`, `family_member`, `income`, `job`, `phone_number`, `email_address`, `password`) VALUES
(111, 'Reem', 'Abdulaziz', 32, 5, 25000, 'Doctor', '0501812325', 'ReemAbdulaziz@gmail.com', '$2y$10$tmkjN4traoGVsf.xUS2tsuS/5.9twN6qfOz4U3OVHVYNtMFwXJK6C'),
(112, 'Saleh', 'Riyadh', 45, 9, 45000, 'Engineer', '0554515932', 'Saleh1@gmail.com', '$2y$10$ELRZbtXfWawJJ16IHGCkhuovKw5g2ONEtTtr7KZV0YUhG5.OOrLyK'),
(113, 'Abdulilah', 'Abdullah', 58, 7, 50000, 'software developer', '0555587643', 'abdulilah1@gmail.com', '$2y$10$Yo7a6bOdbMKa8FOjbYNQrueZxB3P88eoLtG/6xr8/uDo176DQzX/m'),
(114, 'REEM', 'ALMUSHARRAF', 21, 7, 3, 'student', '0501800025', 'reemo.m.2002@gmail.com', '$2y$10$5me5WRG0i9kNzt4t1cE8hOfLr.GA5cZZuO4M6Zh4dVJRExZ3rhzve'),
(115, 'alanoud', 'alqabbani', 11, 6, 10, 'student', '0566662161', '2012alanoud2012@gmail.com', '$2y$10$rAQW2fNKhP7fQ2FFAZ7qQ.NdDkJfWFve4lqyDs8znAh8tyHO2A/1O');

-- --------------------------------------------------------

--
-- Table structure for table `Property`
--

CREATE TABLE `Property` (
  `id` int(10) NOT NULL,
  `homeowner_id` int(10) NOT NULL,
  `property_category_id` int(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `rooms` int(11) NOT NULL,
  `rent_cost` float NOT NULL,
  `location` text NOT NULL,
  `max_tenants` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Property`
--

INSERT INTO `Property` (`id`, `homeowner_id`, `property_category_id`, `name`, `rooms`, `rent_cost`, `location`, `max_tenants`, `description`) VALUES
(1234, 0, 13241, 'Holiday Villa', 6, 7000, 'Riyadh,Al-Aqeeq District', 30, '  Holiday Villa Hail  in Riyadh has 4-star accommodation with a terrace and a restaurant. The property is situated 6.5 km from Riyadh Stadium, 7.1 km from Aerf Castle and 8.3 km from Riyadh University. The accommodation features a 24-hour front desk, airport transfers, room service and free WiFi.  '),
(1254, 1, 13243, 'Najd alriyadh', 5, 4000, ' riyadh', 15, '    great chalet    '),
(1257, 2, 13243, 'The palm', 5, 2000, ' riyadh', 20, '              Situated 19 km from Al Nakheel Mall, The Palms Resort (2) features accommodation in Riyadh with access to a hot tub. This chalet has a private pool and a garden.\r\n\r\nThe air-conditioned chalet is composed of 1 separate bedroom, a living room, a fully equipped kitchen, and 2 bathrooms. A flat-screen TV is available.               '),
(1258, 2, 13241, ' Vivian ', 6, 12000, ' riyadh', 6, '     features a sauna and a fitness room, as well as air-conditioned accommodation in Riyadh, 1.4 km from Al Rajhi Grand Mosque. There is a private entrance at the aparthotel for the convenience of those who stay. The aparthotel also provides free WiFi, free private parking and facilities for disabled guests.     ');

-- --------------------------------------------------------

--
-- Table structure for table `PropertyCategory`
--

CREATE TABLE `PropertyCategory` (
  `id` int(10) NOT NULL,
  `category` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PropertyCategory`
--

INSERT INTO `PropertyCategory` (`id`, `category`) VALUES
(13241, 'villa'),
(13242, 'Apartment'),
(13243, 'Chalet');

-- --------------------------------------------------------

--
-- Table structure for table `PropertyImage`
--

CREATE TABLE `PropertyImage` (
  `id` int(10) NOT NULL,
  `property_id` int(10) NOT NULL,
  `path` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `PropertyImage`
--

INSERT INTO `PropertyImage` (`id`, `property_id`, `path`) VALUES
(1, 1234, 'villa.jpeg'),
(9, 1254, 'Chalet2.jpeg'),
(12, 1257, 'chalet1.jpg'),
(13, 1258, 'vivian.webp');

-- --------------------------------------------------------

--
-- Table structure for table `RentalApplication`
--

CREATE TABLE `RentalApplication` (
  `id` varchar(10) NOT NULL,
  `property_id` int(10) NOT NULL,
  `home_seeker_id` int(10) NOT NULL,
  `application_status_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `RentalApplication`
--

INSERT INTO `RentalApplication` (`id`, `property_id`, `home_seeker_id`, `application_status_id`) VALUES
('ra000', 1234, 111, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ApplicationStatus`
--
ALTER TABLE `ApplicationStatus`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HomeOwner`
--
ALTER TABLE `HomeOwner`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `HomeSeeker`
--
ALTER TABLE `HomeSeeker`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Property`
--
ALTER TABLE `Property`
  ADD PRIMARY KEY (`id`),
  ADD KEY `homeowner_id` (`homeowner_id`),
  ADD KEY `property_category_id` (`property_category_id`);

--
-- Indexes for table `PropertyCategory`
--
ALTER TABLE `PropertyCategory`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `PropertyImage`
--
ALTER TABLE `PropertyImage`
  ADD PRIMARY KEY (`id`),
  ADD KEY `property_id` (`property_id`);

--
-- Indexes for table `RentalApplication`
--
ALTER TABLE `RentalApplication`
  ADD PRIMARY KEY (`id`),
  ADD KEY `application_status_id` (`application_status_id`),
  ADD KEY `home_seeker_id` (`home_seeker_id`),
  ADD KEY `property_id` (`property_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `HomeSeeker`
--
ALTER TABLE `HomeSeeker`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- AUTO_INCREMENT for table `Property`
--
ALTER TABLE `Property`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1259;

--
-- AUTO_INCREMENT for table `PropertyImage`
--
ALTER TABLE `PropertyImage`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
