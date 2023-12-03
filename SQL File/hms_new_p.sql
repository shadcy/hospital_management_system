-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 30, 2023 at 06:44 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hms_new`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int(11) NOT NULL,
  `doctorId` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `consultancyFees` int(11) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `time` varchar(255) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT 1,
  `patientStatus` int(11) DEFAULT 1,
  `doctorStatus` int(11) DEFAULT 1,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `doctorId`, `patientId`, `consultancyFees`, `date`, `time`, `status`, `patientStatus`, `doctorStatus`, `postingDate`, `updationDate`) VALUES
(1, 2, 3, 50, '2023-11-16', '8:30 PM', 3, 1, 1, '2023-11-14 14:57:17', '2023-11-30 05:23:34'),
(2, 2, 3, 50, '2023-11-23', '8:30 PM', 1, 0, 1, '2023-11-14 15:00:10', '2023-11-14 15:00:19');

-- --------------------------------------------------------

--
-- Table structure for table `contact_us`
--

CREATE TABLE `contact_us` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(15) DEFAULT NULL,
  `message` mediumtext DEFAULT NULL,
  `postingDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `adminRemark` mediumtext DEFAULT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isRead` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_us`
--

INSERT INTO `contact_us` (`id`, `fullName`, `email`, `contactNumber`, `message`, `postingDate`, `adminRemark`, `updationDate`, `isRead`) VALUES
(1, 'Bhupendra Jogi', 'bpj@fake.com', '5677812345', 'I have gone to many places in USA', '2023-11-14 14:45:31', 'What are there names?', '2023-11-14 14:46:30', 1),
(2, 'Test', 'test@fake.com', '9999977777', 'Test', '2023-11-16 12:39:40', NULL, '2023-11-16 12:39:40', 0),
(3, 'Bhupendra Jogi', 'bpj@fake.com', '5677812345', 'lol', '2023-11-16 17:54:16', NULL, '2023-11-16 17:54:16', 0);

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`) VALUES
(1, 'Computer Science and Engineering'),
(2, 'Electrical Engineering'),
(3, 'Mechanical Engineering'),
(4, 'Engineering Physics'),
(5, 'Mathematics'),
(6, 'Aerospace Engineering'),
(7, 'Chemical Engineering'),
(8, 'Chemistry'),
(9, 'Civil Engineering'),
(10, 'Environmental Science and Engineering'),
(11, 'Metallurgical Engineering and Materials Science');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int(11) NOT NULL,
  `specializationId` int(11) DEFAULT NULL,
  `fees` varchar(255) DEFAULT NULL,
  `contactNumber` varchar(15) DEFAULT NULL,
  `nonce` binary(48) NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `specializationId`, `fees`, `contactNumber`, `nonce`, `creationDate`, `updationDate`) VALUES
(2, 1, '50', '9877676762', 0x4fd2441fdc50647b9e41623486fbd72d1455303b784a1e2eceee96169d4ea7be3520e2cc45088adfda91a485dae6e2fe, '2023-11-14 14:31:38', '2023-11-14 23:11:23'),
(4, 1, '5000', '9877676765', 0x9094387494d76bc3bfd4826b02ea36998d7097ae563bfe34bd8e8c64ae7c787d0d6521745b4493aea5acba3e25342a6d, '2023-11-14 22:37:45', '2023-11-14 23:11:23');

-- --------------------------------------------------------

--
-- Table structure for table `logs`
--

CREATE TABLE `logs` (
  `id` int(11) NOT NULL,
  `userId` int(11) DEFAULT NULL,
  `type` tinyint(1) NOT NULL DEFAULT 0,
  `username` varchar(255) DEFAULT NULL,
  `ip` binary(16) DEFAULT NULL,
  `loginTime` timestamp NULL DEFAULT current_timestamp(),
  `logout` varchar(255) DEFAULT NULL,
  `status` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `logs`
--

INSERT INTO `logs` (`id`, `userId`, `type`, `username`, `ip`, `loginTime`, `logout`, `status`) VALUES
(1, NULL, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-13 20:25:24', NULL, 0),
(2, 1, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-13 20:27:16', '14-11-2023 06:47:05 PM', 1),
(3, NULL, 2, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-13 21:21:50', NULL, 0),
(4, 1, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-14 13:17:16', NULL, 1),
(5, 3, 0, 'normal@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-14 14:54:16', '14-11-2023 08:32:04 PM', 1),
(6, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-14 15:03:53', NULL, 1),
(7, 1, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-14 22:37:02', NULL, 1),
(8, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-14 23:56:14', NULL, 1),
(9, 3, 0, 'normal@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-16 08:21:10', NULL, 1),
(10, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-16 08:23:08', NULL, 1),
(11, 1, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-16 08:30:06', NULL, 1),
(12, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-16 16:40:23', '17-11-2023 12:27:21 AM', 1),
(13, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-16 19:02:59', '19-11-2023 01:24:07 AM', 1),
(14, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-23 21:44:50', NULL, 1),
(15, 1, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-23 21:45:18', '24-11-2023 08:29:07 AM', 1),
(16, 3, 0, 'normal@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-24 02:59:17', NULL, 1),
(17, 1, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-24 15:26:25', NULL, 1),
(18, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-28 17:20:51', NULL, 1),
(19, 3, 0, 'normal@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-28 23:15:44', '29-11-2023 04:47:45 AM', 1),
(20, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-28 23:18:05', NULL, 1),
(21, 1, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-29 03:23:03', NULL, 1),
(22, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-30 00:25:06', NULL, 1),
(23, NULL, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-30 03:25:16', NULL, 0),
(24, 1, 1, 'admin', 0x3a3a3100000000000000000000000000, '2023-11-30 03:25:20', NULL, 1),
(25, 2, 2, 'shreyashw@fake.com', 0x3a3a3100000000000000000000000000, '2023-11-30 03:34:59', NULL, 1);

-- --------------------------------------------------------

--
-- Table structure for table `medical_history`
--

CREATE TABLE `medical_history` (
  `id` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `bloodPressure` varchar(200) DEFAULT NULL,
  `bloodSugar` varchar(200) NOT NULL,
  `weight` varchar(100) DEFAULT NULL,
  `temperature` varchar(200) DEFAULT NULL,
  `medicalPrescription` mediumtext DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `type` enum('about','contact') NOT NULL,
  `title` varchar(200) DEFAULT NULL,
  `description` mediumtext DEFAULT NULL,
  `email` varchar(120) DEFAULT NULL,
  `contactNumber` varchar(15) DEFAULT NULL,
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `openingTime` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`type`, `title`, `description`, `email`, `contactNumber`, `updationDate`, `openingTime`) VALUES
('about', 'A Hospital', 'This is a hospital', NULL, NULL, '2023-11-14 13:24:01', NULL),
('contact', 'A Hospital', 'This hospital can be contacted', 'contact@hospital.com', '9988776655', '2023-11-14 13:24:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `id` int(11) NOT NULL,
  `patientId` int(11) NOT NULL,
  `appointmentId` int(11) DEFAULT NULL,
  `fileName` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`id`, `patientId`, `appointmentId`, `fileName`) VALUES
(4, 3, 1, 'prescriptions/1_3.png');

-- --------------------------------------------------------

--
-- Table structure for table `specializations`
--

CREATE TABLE `specializations` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specializations`
--

INSERT INTO `specializations` (`id`, `name`, `creationDate`, `updationDate`) VALUES
(1, 'Cardiology', '2023-11-14 14:19:08', '2023-11-14 14:19:08');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `rollNumber` varchar(10) NOT NULL,
  `departmentId` int(11) NOT NULL,
  `validUntil` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `rollNumber`, `departmentId`, `validUntil`) VALUES
(3, '22B3945', 2, '2027-08-07'),
(7, '22b1304', 2, '2027-08-07'),
(19, '22B3926', 2, '2027-08-07'),
(20, '22b3904', 2, '2027-08-07');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `fullName` varchar(255) DEFAULT NULL,
  `gender` varchar(255) DEFAULT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `contactNumber` varchar(15) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `registrationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `isAdmin` tinyint(1) NOT NULL DEFAULT 0,
  `type` tinyint(2) NOT NULL DEFAULT 0,
  `isActive` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `fullName`, `gender`, `email`, `password`, `contactNumber`, `address`, `registrationDate`, `updationDate`, `isAdmin`, `type`, `isActive`) VALUES
(1, 'Admin', 'Male', 'admin', '21232f297a57a5a743894a0e4a801fc3', '9345677890', 'Here', '2023-11-13 20:27:04', '2023-11-29 17:27:40', 1, 1, 1),
(2, 'Shreyash Wanjari', NULL, 'shreyashw@fake.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9877676765', 'Here, at IITB Hospital', '2023-11-14 14:31:38', '2023-11-14 14:40:03', 0, 2, 1),
(3, 'Normal', 'female', 'normal@fake.com', '5f4dcc3b5aa765d61d8327deb882cf99', NULL, 't', '2023-11-14 14:51:05', '2023-11-14 14:51:05', 0, 0, 1),
(4, 'Sanat Agarwal', NULL, 'sanat@mailfake.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9877676765', 'Here', '2023-11-14 22:37:45', '2023-11-14 22:37:45', 0, 2, 1),
(7, 'Pratham Sonekar', 'male', 'prs@fake.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9595959595', 'Here', '2023-11-29 05:08:53', '2023-11-29 05:08:53', 0, 0, 1),
(8, 'Harsh Sanjay Roniyar', 'male', 'hrsh@fake.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9595959595', 'H3', '2023-11-29 05:16:31', '2023-11-29 05:16:31', 0, 0, 1),
(19, 'Shreyash Wanjari', 'male', 'srysh@fake.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9595959595', 'H2', '2023-11-29 11:44:13', '2023-11-29 11:44:13', 0, 0, 1),
(20, 'Devtanu Barman', 'male', 'dev@fake.com', '5f4dcc3b5aa765d61d8327deb882cf99', '9595959595', 'H2', '2023-11-29 12:24:14', '2023-11-29 12:24:14', 0, 0, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `doctorId` (`doctorId`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `contact_us`
--
ALTER TABLE `contact_us`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `doctors_nonce_uq` (`nonce`),
  ADD KEY `specilizationId` (`specializationId`);

--
-- Indexes for table `logs`
--
ALTER TABLE `logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userId` (`userId`);

--
-- Indexes for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patientId` (`patientId`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`type`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `patient_prescriptions` (`patientId`),
  ADD KEY `fk_prescriptions_appointments` (`appointmentId`);

--
-- Indexes for table `specializations`
--
ALTER TABLE `specializations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `students_roll_number_uq` (`rollNumber`),
  ADD KEY `fk_students_departments` (`departmentId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `contact_us`
--
ALTER TABLE `contact_us`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `logs`
--
ALTER TABLE `logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `medical_history`
--
ALTER TABLE `medical_history`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `specializations`
--
ALTER TABLE `specializations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `fk_appointment_doctors1` FOREIGN KEY (`doctorId`) REFERENCES `doctors` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_appointments_users1` FOREIGN KEY (`patientId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `fk_doctors_doctorspecilization1` FOREIGN KEY (`specializationId`) REFERENCES `specializations` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_doctors_users` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `logs`
--
ALTER TABLE `logs`
  ADD CONSTRAINT `fk_logs_users1` FOREIGN KEY (`userId`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `medical_history`
--
ALTER TABLE `medical_history`
  ADD CONSTRAINT `fk_medical_history_users1` FOREIGN KEY (`patientId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `fk_prescriptions_appointments` FOREIGN KEY (`appointmentId`) REFERENCES `appointments` (`id`) ON DELETE SET NULL ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_prescriptions_users` FOREIGN KEY (`patientId`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints for table `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `fk_students_departments` FOREIGN KEY (`departmentId`) REFERENCES `departments` (`id`) ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_students_users` FOREIGN KEY (`id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
