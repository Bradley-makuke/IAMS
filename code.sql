-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 06, 2024 at 02:16 PM
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
-- Table structure for table `company_preferences`
--

CREATE TABLE `company_preferences` (
  `company_name` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `locations` varchar(255) NOT NULL,
  `projects` text NOT NULL,
  `available_slots` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `company_preferences`
--

INSERT INTO `company_preferences` (`company_name`, `email`, `skills`, `locations`, `projects`, `available_slots`) VALUES
('', '', 'Java,Python,C++', 'Gaborone,Lobatse', '', ''),
('', '', 'C++,JavaScript,SQL', 'Mahalapye', 'Free Masonry', ''),
('Nthabi', '', 'Python,JavaScript', 'Gaborone,Mahalapye,Kanye', 'Snow bunny', '');

-- --------------------------------------------------------

--
-- Table structure for table `coordinator`
--

CREATE TABLE `coordinator` (
  `username` varchar(50) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `coordinator`
--

INSERT INTO `coordinator` (`username`, `firstname`, `surname`, `email`, `phone_number`) VALUES
('Coordinat0r', 'Mookamedi', 'Overseer', 'Coor@din.ator', '78777576');

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
-- Table structure for table `matches`
--

CREATE TABLE `matches` (
  `company` varchar(255) NOT NULL,
  `student` varchar(255) NOT NULL,
  `skills` varchar(255) DEFAULT NULL,
  `locations` varchar(255) DEFAULT NULL,
  `projects` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organisation`
--

CREATE TABLE `organisation` (
  `username` varchar(250) NOT NULL,
  `email` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `organisation`
--

INSERT INTO `organisation` (`username`, `email`) VALUES
('CEDA', 'adim@ceda.co.bw'),
('Amaree', 'Am@ar.ee'),
('botswood', 'bots@wood.bw'),
('BIHL', 'info@bihl.co.bw'),
('ojoiji', 'info@botswood.co.bw'),
('LongWood', 'Long@Wo.od'),
('mymom', 'mamam@yonko.piece'),
('Nthabi', 'Nt@ha.bi');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `username` varchar(50) NOT NULL,
  `email` varchar(250) NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `studentId` varchar(9) NOT NULL,
  `phone_number` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`username`, `email`, `firstname`, `surname`, `studentId`, `phone_number`) VALUES
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('JJBA2', 'jj@ba.bw', 'Joe', 'Joe', 'Joe', '12345678'),
('m3n', 'na@hm.an', 'nah', 'man', '989898989', '90898978'),
('thabang2', 'tha@ba.ng', 'thabang', 'makuke', '201600898', '76191050');

-- --------------------------------------------------------

--
-- Table structure for table `student_preferences`
--

CREATE TABLE `student_preferences` (
  `username` varchar(50) NOT NULL,
  `skills` varchar(255) NOT NULL,
  `locations` varchar(255) NOT NULL,
  `projects` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student_preferences`
--

INSERT INTO `student_preferences` (`username`, `skills`, `locations`, `projects`) VALUES
('', 'Java,Python,C++', 'Lobatse, Gaborone', 'Web Development, Software Development'),
('thabang2', 'Java,Python,JavaScript', 'Lobatse', 'System Administration');

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
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `email`, `user_type`, `password`) VALUES
('Amaree', 'Am@ar.ee', 'organisation', '$2y$10$qdfp7UVMudAJkFy8NjJ0i.KGrE43paAKVAKl8MNwBcfOJzY0h5mNC'),
('Coordinator', 'Coor@din.ator', 'coordinator', '$2y$10$RZSYWi3GtMCsgx30YkBi7.kRDq75bb0fxGorp.3YqQPjWP60539gi'),
('JJBA2', 'jj@ba.bw', 'student', '$2y$10$FKjxWCY1AUXn2oW22pSZ5uVRKgHoFfUt6pjofPAiPIZWNwB8u2t.O'),
('LongWood', 'Long@Wo.od', 'organisation', '$2y$10$zY3QUbYbAkNTiG3GW8PNbe00wpvxbMA0xG7NklB8RQLFwg1CnhYqS'),
('m3n', 'na@hm.an', 'student', '$2y$10$sDqCr2Ycl37T8Nkxytq5xucOdxhfohOSd8jWZdlJ18TJGIFMvAsbC'),
('Nthabi', 'Nt@ha.bi', 'organisation', '$2y$10$IFYxRuXrgnBtbJx9Q51.7OKfaa/..L9aPZLwX2SFt.Ze6mbuAfpCu'),
('thabang2', 'tha@ba.ng', 'student', '$2y$10$Dtxm6vhvgzoh5KxUMg7dCehh7ZXY7U6TpTNqGeJG3r3OKoYMhkHvO');

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
