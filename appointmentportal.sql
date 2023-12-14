-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 11, 2023 at 04:34 PM
-- Server version: 8.0.34
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `appointmentportal`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_account_tokens`
--

CREATE TABLE `tbl_account_tokens` (
  `token_id` int NOT NULL,
  `token` varchar(20) NOT NULL,
  `verified_at` timestamp NULL DEFAULT NULL,
  `user_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_account_tokens`
--

INSERT INTO `tbl_account_tokens` (`token_id`, `token`, `verified_at`, `user_id`) VALUES
(3, '6dc82d73234c5b9fe58e', '2023-12-05 11:17:50', 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_username`, `email_address`, `password`) VALUES
(3, 'admin', 'admin@test.com', '$2a$12$og3ytKpJOFn/TOvK7ldvUOQCEwo/dR/c/HMURzrNWI8S/uR9PlQ4.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointments`
--

CREATE TABLE `tbl_appointments` (
  `appointment_id` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `appointment_reason` text NOT NULL,
  `patient_id` int DEFAULT NULL,
  `doctor` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_appointments`
--

INSERT INTO `tbl_appointments` (`appointment_id`, `date`, `time`, `appointment_reason`, `patient_id`, `doctor`) VALUES
(5, '2023-12-12', '10:30:00', 'Tooth Replacement', 3, 14),
(6, '2023-12-13', '10:20:00', 'Test Appointment', 3, 14);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_doctors`
--

CREATE TABLE `tbl_doctors` (
  `doctor_id` int NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_address` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `speciality` int DEFAULT NULL,
  `availability_status` tinyint(1) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_doctors`
--

INSERT INTO `tbl_doctors` (`doctor_id`, `name`, `email_address`, `phoneNumber`, `username`, `password`, `speciality`, `availability_status`) VALUES
(1, 'John Doe', 'kamau@gmail.com', '0752564498', 'jdoe', NULL, 2, 1),
(14, 'John Doe', 'johnDoe@gmail.com', '0700728497', 'vdoe', '$2y$12$C8FWDOvxbYtTs925pU8qbecmLu7ZLNYgLsRm14xDcfmobtCITLeWW', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_patients`
--

CREATE TABLE `tbl_patients` (
  `patient_id` int NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_patients`
--

INSERT INTO `tbl_patients` (`patient_id`, `firstName`, `lastName`, `emailAddress`, `username`, `phoneNumber`, `password`) VALUES
(3, 'Mike', 'Kamau', 'alexKamau@gmail.com', 'mkamau', '0752564497', '$2y$12$noUChoTWhm0pPV2JW1ZSXO1tVyHRcWbsm0Z7dApTt10e51S8fZafK'),
(4, 'Alex', 'Mwendwa', 'alexmwenda@gmail.com', 'amwendwa', '0752564490', '$2y$12$8aePHrV.Ab4FSeEr1tWZDe.V0We/ve0G7r5n0ckzFD222s9aBAkwa');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_speciality`
--

CREATE TABLE `tbl_speciality` (
  `speciality_id` int NOT NULL,
  `speciality_name` varchar(255) NOT NULL,
  `speciality_description` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_speciality`
--

INSERT INTO `tbl_speciality` (`speciality_id`, `speciality_name`, `speciality_description`) VALUES
(1, 'General Practice', 'General Practice'),
(2, 'Dental Surgery', 'Dental Surgery'),
(3, 'Infectious Disease', 'Infectious Disease'),
(4, 'Accident and Emergency Medicine', 'Accident and Emergency Medicine is a emergency response faculty');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `userID` int NOT NULL,
  `firstName` varchar(255) NOT NULL,
  `lastName` varchar(255) NOT NULL,
  `emailAddress` varchar(255) NOT NULL,
  `phoneNumber` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`userID`, `firstName`, `lastName`, `emailAddress`, `phoneNumber`, `password`, `username`) VALUES
(7, 'Mike', 'Mukiri', 'kamau@gmail.com', '0752564495', '$2y$12$KCmnh5c8U8IWz0G1XeEISefRs70k0pU1XdMU.u8.LFupI5JbfIe.i', 'mkamau');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_user_roles`
--

CREATE TABLE `tbl_user_roles` (
  `instance_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_user_roles`
--

INSERT INTO `tbl_user_roles` (`instance_id`, `username`, `role`) VALUES
(1, 'amwendwa', 'Patient'),
(2, 'mkamau', 'Patient'),
(3, 'admin', 'Admin'),
(4, 'inewton', 'Doctor'),
(5, 'amwendwa', 'Patient'),
(6, 'vdoe', 'Doctor'),
(7, 'akinuthia', 'Doctor'),
(8, 'akinuthia', 'Doctor'),
(9, 'inewton', 'Doctor'),
(10, 'vdoe', 'Doctor'),
(11, 'vdoe', 'Doctor'),
(12, 'vdoe', 'Doctor'),
(13, 'vdoe', 'Doctor'),
(14, 'vdoe', 'Doctor'),
(15, 'vdoe', 'Doctor'),
(16, 'vdoe', 'Doctor');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_account_tokens`
--
ALTER TABLE `tbl_account_tokens`
  ADD PRIMARY KEY (`token_id`),
  ADD KEY `fk_token_doctor` (`user_id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `doctor` (`doctor`);

--
-- Indexes for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email_address` (`email_address`),
  ADD UNIQUE KEY `phoneNumber` (`phoneNumber`),
  ADD KEY `speciality` (`speciality`);

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `tbl_speciality`
--
ALTER TABLE `tbl_speciality`
  ADD PRIMARY KEY (`speciality_id`),
  ADD UNIQUE KEY `speciality_name` (`speciality_name`);

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`userID`);

--
-- Indexes for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  ADD PRIMARY KEY (`instance_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_account_tokens`
--
ALTER TABLE `tbl_account_tokens`
  MODIFY `token_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  MODIFY `doctor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `patient_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_speciality`
--
ALTER TABLE `tbl_speciality`
  MODIFY `speciality_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  MODIFY `instance_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tbl_account_tokens`
--
ALTER TABLE `tbl_account_tokens`
  ADD CONSTRAINT `fk_token_doctor` FOREIGN KEY (`user_id`) REFERENCES `tbl_doctors` (`doctor_id`);

--
-- Constraints for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  ADD CONSTRAINT `tbl_appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `tbl_patients` (`patient_id`),
  ADD CONSTRAINT `tbl_appointments_ibfk_2` FOREIGN KEY (`doctor`) REFERENCES `tbl_doctors` (`doctor_id`);

--
-- Constraints for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  ADD CONSTRAINT `tbl_doctors_ibfk_1` FOREIGN KEY (`speciality`) REFERENCES `tbl_speciality` (`speciality_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
