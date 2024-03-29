-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 29, 2024 at 07:04 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `votingdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `clerk_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`clerk_id`, `name`, `email`, `password`, `timestamp`) VALUES
(1, 'ABC', 'abcxyz@gmail.com', '12345678', '2024-03-04 09:09:59.011994');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_reviews`
--

CREATE TABLE `tbl_reviews` (
  `rev_id` int(255) NOT NULL,
  `rev_by` bigint(255) NOT NULL,
  `rating` decimal(5,2) NOT NULL,
  `rev_to` int(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_reviews`
--

INSERT INTO `tbl_reviews` (`rev_id`, `rev_by`, `rating`, `rev_to`, `course_code`, `department`, `section`, `timestamp`) VALUES
(4, 12021002029135, 4.00, 21, 'PCCCSE401', 'CSE', 'A', '2024-03-09 13:48:39.738691'),
(10, 12021002028122, 4.00, 22, 'ICE2020', 'CSE IOT', 'A', '2024-03-15 12:02:10.119989'),
(11, 12021002028122, 5.00, 21, 'HSMC401', 'CSE IOT', 'A', '2024-03-15 16:50:43.013336'),
(12, 12021002028122, 4.00, 20, 'HSMC501', 'CSE IOT', 'A', '2024-03-29 17:29:26.231612'),
(13, 12021002029135, 4.00, 20, 'ICE2020', 'CSE IOT', 'C', '2024-03-29 17:46:48.648452'),
(14, 12021002029135, 4.00, 21, 'HSMC401', 'CSE IOT', 'C', '2024-03-29 17:46:55.013387'),
(15, 12021002029139, 3.00, 20, 'HSMC401', 'CSE IOT', 'A', '2024-03-29 17:54:58.677144'),
(16, 12021002029137, 5.00, 21, 'HSMC401', 'CSE IOT', 'A', '2024-03-29 17:57:40.186503'),
(17, 12021002029137, 3.00, 20, 'HSMC501', 'CSE IOT', 'A', '2024-03-29 17:57:51.978384'),
(18, 12021002029137, 4.00, 22, 'ICE2020', 'CSE IOT', 'A', '2024-03-29 17:57:59.134740');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_student`
--

CREATE TABLE `tbl_student` (
  `Enrollment` bigint(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `Phone` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `Section` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Attendance` int(255) NOT NULL,
  `semester` int(255) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_student`
--

INSERT INTO `tbl_student` (`Enrollment`, `name`, `Phone`, `Department`, `Section`, `Password`, `Attendance`, `semester`, `timestamp`) VALUES
(12021002028122, 'Swastika Sen', '9831349142', 'CSE IOT', 'A', '123456@', 89, 3, '2024-03-15 07:56:22.242695'),
(12021002029134, 'Sayak Raha', '9007382357', 'CSE IOT', 'B', 'Sr12@2003', 25, 5, '2024-03-02 15:14:51.066377'),
(12021002029135, 'Argha saha', '342342524234', 'CSE IOT', 'C', '123456789', 85, 3, '2024-03-07 15:35:32.398964'),
(12021002029136, 'Prabuddha chowdhury', '3423423423423', 'it', 'A', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029137, 'sdfsa', '4234', 'CSE IOT', 'A', '123456789', 85, 3, '2024-03-07 15:35:32.398964'),
(12021002029138, 'sdfasdf', '2342', 'it', 'B', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029139, 'asraf ali', '34', 'CSE IOT', 'A', '123456789', 85, 4, '2024-03-07 15:35:32.398964'),
(12021002029140, 'dfas', '2342', 'iot', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029141, 'asxcasqwe', '342', 'iot', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029142, 'acasdas', '34', 'iot', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029144, 'sdf', '41234123234234', 'iot', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029145, 'sdfsdf', '2342342342', 'iot', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029146, 'sdfs', '3423', 'iot', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029147, 'sdfsdfs', '42', 'cse', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029148, 'sdfs', '34234234', 'cse', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029150, 'edrg', '423', 'cse', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029151, 'esdfse', '423423', 'mechanical', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964'),
(12021002029152, 'fsdfwef', '23423', 'mechanical', '', '123456789', 85, 0, '2024-03-07 15:35:32.398964');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_subject`
--

CREATE TABLE `tbl_subject` (
  `course_code` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `inclusion_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_subject`
--

INSERT INTO `tbl_subject` (`course_code`, `course_name`, `inclusion_date`) VALUES
('HSMC401', 'ESP - IV', '2024-03-15 11:54:51.060343'),
('HSMC501', 'ESP - V', '2024-03-15 11:54:38.221926'),
('ICE2020', 'International Language - Theory', '2024-03-09 18:56:25.162700'),
('PCCCSE401', 'Data Base Management System', '2024-03-10 18:49:11.992505');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher`
--

CREATE TABLE `tbl_teacher` (
  `teacher_id` int(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `timestamp` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_teacher`
--

INSERT INTO `tbl_teacher` (`teacher_id`, `name`, `email`, `timestamp`) VALUES
(20, 'sandip mondal', 'sdmbkl@gmail.com', '2024-03-09 09:02:54.075452'),
(21, 'Sukalyan Goswami', 'skgmkl@gmail.com', '2024-03-09 13:31:06.346478'),
(22, 'Sweta Saha', 'sweta12@gmail.com', '2024-03-15 09:02:06.774849');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_teacher_assignment`
--

CREATE TABLE `tbl_teacher_assignment` (
  `id` int(255) NOT NULL,
  `course_code` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `semester` int(255) NOT NULL,
  `section` varchar(255) NOT NULL,
  `assigned_to` int(255) NOT NULL,
  `assignment_date` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_teacher_assignment`
--

INSERT INTO `tbl_teacher_assignment` (`id`, `course_code`, `department`, `semester`, `section`, `assigned_to`, `assignment_date`) VALUES
(3, 'ICE2020', 'CSE IOT', 3, 'A', 22, '2024-03-15 11:42:21.544192'),
(4, 'HSMC401', 'CSE IOT', 3, 'A', 21, '2024-03-15 11:55:04.602408'),
(5, 'HSMC501', 'CSE IOT', 3, 'A', 20, '2024-03-15 11:55:14.760156'),
(6, 'HSMC501', 'CSE IOT', 5, 'A', 21, '2024-03-29 17:32:17.962596'),
(7, 'ICE2020', 'CSE IOT', 3, 'C', 20, '2024-03-29 17:46:22.915979'),
(8, 'HSMC401', 'CSE IOT', 3, 'C', 21, '2024-03-29 17:46:40.372427'),
(10, 'HSMC401', 'CSE IOT', 4, 'A', 20, '2024-03-29 17:51:42.711367');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`clerk_id`);

--
-- Indexes for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  ADD PRIMARY KEY (`rev_id`);

--
-- Indexes for table `tbl_student`
--
ALTER TABLE `tbl_student`
  ADD PRIMARY KEY (`Enrollment`);

--
-- Indexes for table `tbl_subject`
--
ALTER TABLE `tbl_subject`
  ADD PRIMARY KEY (`course_code`);

--
-- Indexes for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  ADD PRIMARY KEY (`teacher_id`);

--
-- Indexes for table `tbl_teacher_assignment`
--
ALTER TABLE `tbl_teacher_assignment`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `clerk_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tbl_reviews`
--
ALTER TABLE `tbl_reviews`
  MODIFY `rev_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `tbl_student`
--
ALTER TABLE `tbl_student`
  MODIFY `Enrollment` bigint(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12022002001066;

--
-- AUTO_INCREMENT for table `tbl_teacher`
--
ALTER TABLE `tbl_teacher`
  MODIFY `teacher_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tbl_teacher_assignment`
--
ALTER TABLE `tbl_teacher_assignment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
