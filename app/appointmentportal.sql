-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2023 at 06:57 PM
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
(3, '6dc82d73234c5b9fe58e', '2023-12-05 11:17:50', 14),
(4, '44c8d212cbfd4513cd68', '2023-12-11 14:38:00', 16);

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
(3, 'admin', 'admin@test.com', '$2y$12$.eQ9eIVrr4mrPeGP.PgS6OJgR2txHfCsh4dTt0knh0WahW6XuX36m');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_appointments`
--

CREATE TABLE `tbl_appointments` (
  `appointment_id` int NOT NULL,
  `date` date NOT NULL,
  `time` time NOT NULL,
  `appointment_reason` text NOT NULL,
  `status` varchar(20) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT 'Pending',
  `patient_id` int DEFAULT NULL,
  `doctor` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_appointments`
--

INSERT INTO `tbl_appointments` (`appointment_id`, `date`, `time`, `appointment_reason`, `status`, `patient_id`, `doctor`) VALUES
(8, '2023-12-15', '10:45:00', 'Braces Consultation', 'Accepted', 3, 16),
(9, '2023-12-15', '10:45:00', 'Tooth Canal Replacement', 'Accepted', 3, 16),
(10, '2023-12-15', '10:25:00', 'Pregnancy', 'Accepted', 3, 16),
(12, '2023-12-19', '10:20:00', 'Covid Awareness', 'Accepted', 3, 16),
(13, '2023-12-21', '10:20:00', 'Covid Test', 'Rejected', 3, 16),
(14, '2023-12-22', '21:45:00', 'Medical Examination for work', 'Accepted', 3, 16),
(15, '2023-12-19', '10:30:00', 'Covid 19 Awareness', 'Accepted', 3, 16),
(16, '2023-12-20', '08:30:00', 'Malaria Diagnosis', 'Pending', 3, 16);

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
(14, 'John Doe', 'johnDoe@gmail.com', '0700728492', 'vdoe', '$2y$12$C8FWDOvxbYtTs925pU8qbecmLu7ZLNYgLsRm14xDcfmobtCITLeWW', 2, 1),
(16, 'Grace Mwangi', 'gracemwangi1449@gmail.com', '0752564490', 'gmwangi', '$2y$12$WeClXKBaZuFrsUmHdoI7LekvE6uMzdGXBVxW.VsfNS3AprqbiJXle', 3, 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_password_reset_token`
--

CREATE TABLE `tbl_password_reset_token` (
  `token_id` int NOT NULL,
  `username` varchar(255) NOT NULL,
  `token` varchar(100) NOT NULL,
  `expires_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_password_reset_token`
--

INSERT INTO `tbl_password_reset_token` (`token_id`, `username`, `token`, `expires_at`) VALUES
(2, 'admin', '3eaf723cd8cb7b561728', '2023-12-18 12:13:53'),
(3, 'gmwangi', '86f15a4d31bc71136592', '2023-12-18 14:26:29'),
(4, 'admin', 'a002aad6fb791142464d', '2023-12-18 14:57:07'),
(5, 'gmwangi', '4995c62a6657df161fd1', '2023-12-18 15:07:24'),
(6, 'mkamau', '7775ff0836554176a6f9', '2023-12-18 18:47:05');

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
(3, 'Mike', 'Kamau', 'alexKamau@gmail.com', 'mkamau', '0752564497', '$2y$12$4n9ZeYbHB48l28tN9ajqO.WlAPmFx75EJjCUc77xy4Jwufbsa4yI.');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_sessions`
--

CREATE TABLE `tbl_sessions` (
  `session_id` int NOT NULL,
  `session_date` date NOT NULL,
  `session_time` time NOT NULL,
  `session_title` varchar(100) NOT NULL,
  `appointment_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `tbl_sessions`
--

INSERT INTO `tbl_sessions` (`session_id`, `session_date`, `session_time`, `session_title`, `appointment_id`) VALUES
(1, '2023-12-15', '10:25:00', 'Pregnancy', 10),
(2, '2023-12-19', '10:20:00', 'Covid Awareness', 12),
(4, '2023-12-22', '21:45:00', 'Medical Examination for work', 14),
(5, '2023-12-19', '10:30:00', 'Covid 19 Awareness', 15);

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
(4, 'Accident and Emergency Medicine', 'Accident and Emergency Medicine is a emergency response faculty'),
(6, 'pediatrician', 'pediatrician ');

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
(16, 'vdoe', 'Doctor'),
(17, 'gmwangi', 'Doctor'),
(18, 'gmwangi', 'Doctor');

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
-- Indexes for table `tbl_password_reset_token`
--
ALTER TABLE `tbl_password_reset_token`
  ADD PRIMARY KEY (`token_id`),
  ADD UNIQUE KEY `token` (`token`);

--
-- Indexes for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  ADD PRIMARY KEY (`session_id`),
  ADD KEY `fk_session_appointment` (`appointment_id`);

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
  MODIFY `token_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_appointments`
--
ALTER TABLE `tbl_appointments`
  MODIFY `appointment_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_doctors`
--
ALTER TABLE `tbl_doctors`
  MODIFY `doctor_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `tbl_password_reset_token`
--
ALTER TABLE `tbl_password_reset_token`
  MODIFY `token_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_patients`
--
ALTER TABLE `tbl_patients`
  MODIFY `patient_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  MODIFY `session_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `tbl_speciality`
--
ALTER TABLE `tbl_speciality`
  MODIFY `speciality_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `userID` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `tbl_user_roles`
--
ALTER TABLE `tbl_user_roles`
  MODIFY `instance_id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

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

--
-- Constraints for table `tbl_sessions`
--
ALTER TABLE `tbl_sessions`
  ADD CONSTRAINT `fk_session_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `tbl_appointments` (`appointment_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
