-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 20, 2022 at 03:36 PM
-- Server version: 8.0.17
-- PHP Version: 7.3.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `wrts`
--

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_id`, `department_name`) VALUES
(1, 'Security'),
(2, 'Dispatcher'),
(3, 'Admin'),
(4, 'Ramp Staff');

-- --------------------------------------------------------

--
-- Table structure for table `parking_lot`
--

CREATE TABLE `parking_lot` (
  `parking_lot_id` int(11) NOT NULL,
  `parking_lot_name` varchar(20) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking_lot`
--

INSERT INTO `parking_lot` (`parking_lot_id`, `parking_lot_name`, `vehicle_type_id`) VALUES
(48, 'A', 1),
(49, 'B', 2);

-- --------------------------------------------------------

--
-- Table structure for table `parking_spots`
--

CREATE TABLE `parking_spots` (
  `park_id` int(5) NOT NULL,
  `park_status` varchar(11) NOT NULL,
  `vehicle_id` int(12) DEFAULT NULL,
  `vehicle_type_id` int(11) DEFAULT NULL,
  `parking_lot_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `parking_spots`
--

INSERT INTO `parking_spots` (`park_id`, `park_status`, `vehicle_id`, `vehicle_type_id`, `parking_lot_id`) VALUES
(213, 'FULL', 10, 1, 48),
(214, 'NULL', NULL, 1, 48),
(215, 'NULL', NULL, 1, 48),
(216, 'NULL', NULL, 1, 48),
(217, 'NULL', NULL, 1, 48),
(218, 'FULL', 11, 2, 49),
(219, 'NULL', NULL, 2, 49),
(220, 'NULL', NULL, 2, 49),
(221, 'NULL', NULL, 2, 49),
(222, 'NULL', NULL, 2, 49),
(223, 'NULL', NULL, 2, 49);

-- --------------------------------------------------------

--
-- Table structure for table `ramp`
--

CREATE TABLE `ramp` (
  `ramp_id` int(11) NOT NULL,
  `ramp_name` varchar(20) DEFAULT NULL,
  `ramp_states` int(11) DEFAULT NULL,
  `vehicle_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ramp`
--

INSERT INTO `ramp` (`ramp_id`, `ramp_name`, `ramp_states`, `vehicle_id`, `user_id`) VALUES
(31, '333', 2, NULL, 71),
(32, '1', 2, NULL, 71),
(33, '2', 2, NULL, 71),
(34, '3', 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `ramp_staff_notifications`
--

CREATE TABLE `ramp_staff_notifications` (
  `notification_id` int(11) NOT NULL,
  `ramp_staff_id` int(11) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle_plate_number` varchar(30) NOT NULL,
  `response_type` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ramp_staff_notifications`
--

INSERT INTO `ramp_staff_notifications` (`notification_id`, `ramp_staff_id`, `vehicle_id`, `vehicle_plate_number`, `response_type`) VALUES
(18, 71, 10, 'w', 1);

-- --------------------------------------------------------

--
-- Table structure for table `ramp_states`
--

CREATE TABLE `ramp_states` (
  `ramp_state_id` int(11) NOT NULL,
  `ramp_state_name` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ramp_states`
--

INSERT INTO `ramp_states` (`ramp_state_id`, `ramp_state_name`) VALUES
(1, 'Maintenance'),
(2, 'Available'),
(3, 'Processing'),
(4, 'Awaiting');

-- --------------------------------------------------------

--
-- Table structure for table `security_notifications`
--

CREATE TABLE `security_notifications` (
  `notification_id` int(11) NOT NULL,
  `ramp_staff_id` int(11) NOT NULL,
  `ramp_staff_name` varchar(30) NOT NULL,
  `vehicle_id` int(11) NOT NULL,
  `vehicle_plate_number` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(30) DEFAULT NULL,
  `password` varchar(15) DEFAULT NULL,
  `name` varchar(15) DEFAULT NULL,
  `surname` varchar(15) DEFAULT NULL,
  `phonenumber` varchar(15) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `name`, `surname`, `phonenumber`, `department_id`) VALUES
(1, 'a', 'a', 'a', 'a', 'a', 3),
(2, 'd', 'd', 'd', 'd', 'd', 2),
(65, 's', 's', 'security', ' ', '5425418914', 1),
(71, 'r', 'r', 'Ramp', 'ramp', '1234567890', 4),
(76, 'c', 'WLgdE3HI', 'b', 'b', 'b', 3),
(77, 'T', 'OWjXa1xG', 'T', 'T', 'T', 2),
(79, 'r2', 'r2', 'r2', 'r2', 'r2', 4);

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `vehicle_id` int(11) NOT NULL,
  `vehicle_type_id` int(11) NOT NULL,
  `company_name` varchar(30) NOT NULL,
  `waybill` varchar(30) NOT NULL,
  `plate_number` varchar(50) DEFAULT NULL,
  `trailer_number` varchar(50) DEFAULT NULL,
  `driver_name` varchar(50) DEFAULT NULL,
  `driver_surname` varchar(50) DEFAULT NULL,
  `driver_language` varchar(50) DEFAULT NULL,
  `phone_number` varchar(50) DEFAULT NULL,
  `citizenship_no` varchar(50) DEFAULT NULL,
  `arrival_time` datetime NOT NULL,
  `departure_time` datetime NOT NULL,
  `vehicle_status` int(11) NOT NULL,
  `description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicles`
--

INSERT INTO `vehicles` (`vehicle_id`, `vehicle_type_id`, `company_name`, `waybill`, `plate_number`, `trailer_number`, `driver_name`, `driver_surname`, `driver_language`, `phone_number`, `citizenship_no`, `arrival_time`, `departure_time`, `vehicle_status`, `description`) VALUES
(6, 1, 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 8, ''),
(7, 2, 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', 'b', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, ''),
(8, 1, 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', 'c', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, ''),
(10, 1, 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', 'w', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, ''),
(11, 2, 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', 'v', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 3, ''),
(12, 1, 'g', 'g', 'g', 'g', 'g', 'g', 'g', '05414764396', 'g', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, ''),
(13, 1, 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', 'f', '0000-00-00 00:00:00', '0000-00-00 00:00:00', 7, '');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_states`
--

CREATE TABLE `vehicle_states` (
  `vehicle_state_id` int(11) NOT NULL,
  `vehicle_state_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_states`
--

INSERT INTO `vehicle_states` (`vehicle_state_id`, `vehicle_state_name`) VALUES
(1, 'Not Arrived'),
(2, 'Entered Warehouse'),
(3, 'In Parking Lot'),
(4, 'Entered Ramp'),
(5, 'Getting Processed'),
(6, 'Ready to Leave'),
(7, 'Left Ramp'),
(8, 'Left Warehouse');

-- --------------------------------------------------------

--
-- Table structure for table `vehicle_types`
--

CREATE TABLE `vehicle_types` (
  `vehicle_type_id` int(11) NOT NULL,
  `vehicle_type_name` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vehicle_types`
--

INSERT INTO `vehicle_types` (`vehicle_type_id`, `vehicle_type_name`) VALUES
(1, 'Truck'),
(2, 'Non-Truck');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `parking_lot`
--
ALTER TABLE `parking_lot`
  ADD PRIMARY KEY (`parking_lot_id`),
  ADD KEY `vehicle_type_id_fk` (`vehicle_type_id`);

--
-- Indexes for table `parking_spots`
--
ALTER TABLE `parking_spots`
  ADD PRIMARY KEY (`park_id`),
  ADD KEY `park_vehicleid` (`vehicle_id`),
  ADD KEY `parking_lot_id_fk` (`parking_lot_id`),
  ADD KEY `vehicle_type_id` (`vehicle_type_id`);

--
-- Indexes for table `ramp`
--
ALTER TABLE `ramp`
  ADD PRIMARY KEY (`ramp_id`),
  ADD KEY `ramp_vehicleid` (`vehicle_id`) USING BTREE,
  ADD KEY `ramp_user_id` (`user_id`),
  ADD KEY `ramp_state` (`ramp_states`);

--
-- Indexes for table `ramp_staff_notifications`
--
ALTER TABLE `ramp_staff_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `ramp_states`
--
ALTER TABLE `ramp_states`
  ADD PRIMARY KEY (`ramp_state_id`);

--
-- Indexes for table `security_notifications`
--
ALTER TABLE `security_notifications`
  ADD PRIMARY KEY (`notification_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD KEY `test` (`department_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`vehicle_id`),
  ADD KEY `vehicle_type_id_fk_vehicles` (`vehicle_type_id`),
  ADD KEY `vehicle_stats` (`vehicle_status`);

--
-- Indexes for table `vehicle_states`
--
ALTER TABLE `vehicle_states`
  ADD PRIMARY KEY (`vehicle_state_id`);

--
-- Indexes for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  ADD PRIMARY KEY (`vehicle_type_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parking_lot`
--
ALTER TABLE `parking_lot`
  MODIFY `parking_lot_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- AUTO_INCREMENT for table `parking_spots`
--
ALTER TABLE `parking_spots`
  MODIFY `park_id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=226;

--
-- AUTO_INCREMENT for table `ramp`
--
ALTER TABLE `ramp`
  MODIFY `ramp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `ramp_staff_notifications`
--
ALTER TABLE `ramp_staff_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `ramp_states`
--
ALTER TABLE `ramp_states`
  MODIFY `ramp_state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `security_notifications`
--
ALTER TABLE `security_notifications`
  MODIFY `notification_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=80;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `vehicle_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `vehicle_states`
--
ALTER TABLE `vehicle_states`
  MODIFY `vehicle_state_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `vehicle_types`
--
ALTER TABLE `vehicle_types`
  MODIFY `vehicle_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `parking_lot`
--
ALTER TABLE `parking_lot`
  ADD CONSTRAINT `vehicle_type_id_fk` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`vehicle_type_id`);

--
-- Constraints for table `parking_spots`
--
ALTER TABLE `parking_spots`
  ADD CONSTRAINT `park_vehicleid` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`),
  ADD CONSTRAINT `parking_lot_id_fk` FOREIGN KEY (`parking_lot_id`) REFERENCES `parking_lot` (`parking_lot_id`),
  ADD CONSTRAINT `vehicle_type_id` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`vehicle_type_id`);

--
-- Constraints for table `ramp`
--
ALTER TABLE `ramp`
  ADD CONSTRAINT `ramp_state` FOREIGN KEY (`ramp_states`) REFERENCES `ramp_states` (`ramp_state_id`),
  ADD CONSTRAINT `ramp_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ramp_vehicleid` FOREIGN KEY (`vehicle_id`) REFERENCES `vehicles` (`vehicle_id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `test` FOREIGN KEY (`department_id`) REFERENCES `department` (`department_id`);

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicle_stats` FOREIGN KEY (`vehicle_status`) REFERENCES `vehicle_states` (`vehicle_state_id`),
  ADD CONSTRAINT `vehicle_type_id_fk_vehicles` FOREIGN KEY (`vehicle_type_id`) REFERENCES `vehicle_types` (`vehicle_type_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
