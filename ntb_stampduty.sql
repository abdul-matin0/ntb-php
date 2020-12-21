-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 28, 2020 at 11:17 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ntb_stampduty`
--

-- --------------------------------------------------------

--
-- Table structure for table `building_details`
--

CREATE TABLE `building_details` (
  `id` int(11) NOT NULL,
  `building_id` varchar(255) NOT NULL,
  `land_id` varchar(255) NOT NULL,
  `type_of_building` varchar(255) NOT NULL,
  `name_of_building` varchar(255) NOT NULL,
  `building_location` varchar(255) NOT NULL,
  `num_of_floors` varchar(255) NOT NULL,
  `num_of_rooms` varchar(255) NOT NULL,
  `date_building_constructed` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `building_details`
--

INSERT INTO `building_details` (`id`, `building_id`, `land_id`, `type_of_building`, `name_of_building`, `building_location`, `num_of_floors`, `num_of_rooms`, `date_building_constructed`) VALUES
(2, 'building68d85', 'landafeec', 'Residential Complex', 'Lapa Hotel', 'Lekki', '3', '19', '2020-10-21');

-- --------------------------------------------------------

--
-- Table structure for table `building_status`
--

CREATE TABLE `building_status` (
  `id` int(11) NOT NULL,
  `building_id` varchar(255) NOT NULL,
  `constructed_completely` varchar(255) NOT NULL,
  `occupancy_permit` varchar(255) NOT NULL,
  `occupancy_permit_received` varchar(255) NOT NULL,
  `sold` varchar(255) NOT NULL,
  `date_occupancy_permit_received` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `cost` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `building_status`
--

INSERT INTO `building_status` (`id`, `building_id`, `constructed_completely`, `occupancy_permit`, `occupancy_permit_received`, `sold`, `date_occupancy_permit_received`, `area`, `cost`) VALUES
(1, 'building68d85', 'Not Completed', 'Applied', 'Received', 'Not Sold', '2020-10-16', '20', '$4000');

-- --------------------------------------------------------

--
-- Table structure for table `land_details`
--

CREATE TABLE `land_details` (
  `id` int(11) NOT NULL,
  `land_id` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `cost_when_purchased` varchar(255) NOT NULL,
  `cost_at_present` varchar(255) NOT NULL,
  `landmark` varchar(255) NOT NULL,
  `area` varchar(255) NOT NULL,
  `date_purchased` date NOT NULL DEFAULT current_timestamp(),
  `location` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `land_details`
--

INSERT INTO `land_details` (`id`, `land_id`, `address`, `cost_when_purchased`, `cost_at_present`, `landmark`, `area`, `date_purchased`, `location`) VALUES
(1, 'landafeec', 'New Example Address', '$2.95', '$7.95', 'National Stadium', 'Surulere', '2020-10-12', 'Abuja');

-- --------------------------------------------------------

--
-- Table structure for table `land_status`
--

CREATE TABLE `land_status` (
  `id` int(11) NOT NULL,
  `land_id` varchar(255) NOT NULL,
  `building_permit` varchar(255) NOT NULL,
  `building_permit_received` varchar(255) NOT NULL,
  `building_constructed` varchar(255) NOT NULL,
  `occupancy_permit` varchar(255) NOT NULL,
  `occupancy_permit_received` varchar(255) NOT NULL,
  `sold` varchar(255) NOT NULL,
  `date_building_permit_received` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `land_status`
--

INSERT INTO `land_status` (`id`, `land_id`, `building_permit`, `building_permit_received`, `building_constructed`, `occupancy_permit`, `occupancy_permit_received`, `sold`, `date_building_permit_received`) VALUES
(4, 'landafeec', 'Applied', 'Received', 'Not Constructed', 'Applied', 'Not Received', 'Sold', '2020-10-22');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_id`, `name`, `password`, `email`, `phone_number`) VALUES
(1, 'admin', 'Adebayo Abdul-matin', '1234', 'ayo@gmail.com', '08109853985'),
(2, 'admin2', 'Deji Ola', '1234', 'deji@gmail.com', '08109853985'),
(3, 'admin3', 'Ade Ayo', '1234', 'lexico3real@gmail.com', '0908877654');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `building_details`
--
ALTER TABLE `building_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `building_status`
--
ALTER TABLE `building_status`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_details`
--
ALTER TABLE `land_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `land_status`
--
ALTER TABLE `land_status`
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
-- AUTO_INCREMENT for table `building_details`
--
ALTER TABLE `building_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `building_status`
--
ALTER TABLE `building_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `land_details`
--
ALTER TABLE `land_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `land_status`
--
ALTER TABLE `land_status`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
