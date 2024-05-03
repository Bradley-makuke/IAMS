-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 03, 2024 at 08:56 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `code`
--

-- --------------------------------------------------------

--
-- Table structure for table `accepted_applicants`
--

CREATE TABLE `accepted_applicants` (
  `companyName` varchar(250) NOT NULL,
  `studentid` varchar(9) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `skills` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `applicant`
--

CREATE TABLE `applicant` (
  `studentId` varchar(9) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `resume_path` varchar(255) NOT NULL,
  `resume` longblob NOT NULL,
  `cover_letter_path` varchar(255) NOT NULL,
  `cover_letter` longblob NOT NULL,
  `academic_transcript_path` varchar(255) NOT NULL,
  `academic_transcript` longblob NOT NULL,
  `skills` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `applicant`
--

INSERT INTO `applicant` (`studentId`, `firstname`, `lastname`, `email`, `resume_path`, `resume`, `cover_letter_path`, `cover_letter`, `academic_transcript_path`, `academic_transcript`, `skills`) VALUES
('202103045', 'Bradley', 'Makuke', '202103045@ub.ac.bw', '', 0x5b76616c75652d355d, '', 0x5b76616c75652d365d, '', 0x5b76616c75652d375d, 'Java, HTML, CSS, Javascript, PHP, SQL');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `id` int(11) NOT NULL,
  `certification` varchar(255) DEFAULT NULL,
  `subject_name` varchar(255) NOT NULL,
  `subject_grade` char(1) DEFAULT NULL CHECK (`subject_grade` in ('A','B','C','D','E','F','G','U','X')),
  `subject_points` int(11) DEFAULT NULL,
  `government_support` enum('yes','no') DEFAULT NULL,
  `category` varchar(255) DEFAULT NULL,
  `proof_of_category_path` varchar(255) DEFAULT NULL,
  `accommodation_needed` enum('yes','no') DEFAULT NULL,
  `medical_issues` enum('yes','no') DEFAULT NULL,
  `proof_of_medical_issues_path` varchar(255) DEFAULT NULL,
  `registration_fee_receipt_path` varchar(255) DEFAULT NULL,
  `registration_fee_data` longblob DEFAULT NULL,
  `certified_senior_school_certificate_path` varchar(255) DEFAULT NULL,
  `certified_senior_school_certificate_data` longblob DEFAULT NULL,
  `certified_id_copy_path` varchar(255) DEFAULT NULL,
  `certified_id_copy_data` longblob DEFAULT NULL,
  `certified_academic_reference1_path` varchar(255) DEFAULT NULL,
  `certified_academic_reference1_data` longblob DEFAULT NULL,
  `certified_academic_reference2_path` varchar(255) DEFAULT NULL,
  `certified_academic_reference2_data` longblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`username`, `email`, `password`) VALUES
('BIHL', 'info@bihl.co.bw', '$2y$10$AhYml4grUAlinTehqZlfGOpe1JGtWRNA59V/vEseL4tuM1NTHZnkC'),
('botswood', 'bots@wood.bw', '$2y$10$zQH7LELqtfopiX63W3UpsuPL9zWdQCo4h1jKnTA9BsyHMJxKHn2Ky'),
('CEDA', 'adim@ceda.co.bw', '$2y$10$gBY6TgLaBwD.o2muuzyzDuqG257QpMn13Z2Iot9Kdzsq4dwKl6TMS'),
('mymom', 'mamam@yonko.piece', '$2y$10$OGHF88gXKjH/Z9LaP1Opvuxj1Bap/G.AX8Hz2la9SWINT8ma0Cj0e'),
('ojoiji', 'info@botswood.co.bw', '$2y$10$jeeZSnQxR7xcx6YO6DKfsusks2oIQB61GbQP4q/N37sQOkCA2VM6a');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `username` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `studentId` varchar(9) NOT NULL,
  `phoneNumber` text NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`username`, `email`, `studentId`, `phoneNumber`, `password`) VALUES
('Bosele', '', '202020987', '0', '$2y$10$mWQMdwYvk/TMnxB79APrq.SmurHdWd4a9XjP.cb0ajpU8NxTMlD9y'),
('Ogone', '202100073@ub.ac.bw', '202100073', '72552152', '$2y$10$lxtgoiQjC49vqCyP5hTqNOM.0TTOMJ/Zah/.vZ81FKqxT1jHeV2RS'),
('amantle', '', '202101619', '0', '$2y$10$mizxIG5vjaFzChIEcWxqmOc/30oHiGqZuxGSTZ9iObHF7gz9oDl5m'),
('bradley', '', '202103045', '0', '$2y$10$H87/kl52a3XRk7wxOHFX1uHgB84zpa2DFkyl4ZRD2QzQAT8fTo7RG'),
('Rachel', '', '202309089', '0', '$2y$10$l8RxyXI2km9IkoYHYUv9EuXbCNR.c4PpEurgisLE7.xIO/tBBhAee'),
('hahahaha', '', '292020202', '0', '$2y$10$A1q3uttAXHQLG8De2sQ6FudAIEj0S5JLd6OxQx0CFT2WwBRPJunHm'),
('123', '112@as.as', '345678908', '123456456', '$2y$10$kxlvf8hX/TCi58jupxL2duXqy98uC6ocWy.6ftcxHjreUWPkoojOe');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `user_type` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `accepted_applicants`
--
ALTER TABLE `accepted_applicants`
  ADD PRIMARY KEY (`studentid`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `comp_fkey` (`companyName`);

--
-- Indexes for table `applicant`
--
ALTER TABLE `applicant`
  ADD PRIMARY KEY (`studentId`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organisation`
--
ALTER TABLE `organisation`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`studentId`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `accepted_applicants`
--
ALTER TABLE `accepted_applicants`
  ADD CONSTRAINT `accept_key` FOREIGN KEY (`studentid`) REFERENCES `applicant` (`studentId`),
  ADD CONSTRAINT `comp_fkey` FOREIGN KEY (`companyName`) REFERENCES `organisation` (`username`),
  ADD CONSTRAINT `stu_id` FOREIGN KEY (`studentid`) REFERENCES `student` (`studentId`);

--
-- Constraints for table `applicant`
--
ALTER TABLE `applicant`
  ADD CONSTRAINT `stu_key` FOREIGN KEY (`studentId`) REFERENCES `student` (`studentId`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
