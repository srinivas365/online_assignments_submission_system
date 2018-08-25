-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Aug 25, 2018 at 01:08 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 5.6.36

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `college`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignments_submitted`
--

CREATE TABLE `assignments_submitted` (
  `id` int(255) NOT NULL,
  `assignment_id` varchar(255) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `file_location` varchar(255) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `assignments_submitted`
--

INSERT INTO `assignments_submitted` (`id`, `assignment_id`, `faculty_id`, `student_id`, `file_location`, `created_time`) VALUES
(4, 'ass123', '2016BCS1021', '2016BCS0021', './uploads/2016BCS0021/IMS112', '2018-08-24 09:09:24');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `course_id` varchar(255) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `year` int(10) NOT NULL,
  `object` longblob NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `id` int(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `course_name` varchar(255) NOT NULL,
  `semester` int(1) NOT NULL,
  `year` int(4) NOT NULL DEFAULT '2018',
  `branch` varchar(255) NOT NULL,
  `instructor_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `courses`
--

INSERT INTO `courses` (`id`, `course_id`, `course_name`, `semester`, `year`, `branch`, `instructor_id`) VALUES
(1, 'IMS112', 'mathematics', 1, 2018, 'cse', '2016BCS1021'),
(2, 'ICS112', 'introduction to computer science', 1, 2018, 'cse', '2016BCS1022');

-- --------------------------------------------------------

--
-- Table structure for table `course_enrollment`
--

CREATE TABLE `course_enrollment` (
  `id` int(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `student_id` varchar(255) NOT NULL,
  `year` year(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `course_enrollment`
--

INSERT INTO `course_enrollment` (`id`, `course_id`, `student_id`, `year`) VALUES
(1, 'IMS112', '2016BCS0021', 2018),
(2, 'IMS112', '2016BCS0022', 2018);

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` varchar(255) NOT NULL,
  `faculty_name` varchar(255) NOT NULL,
  `rank` varchar(255) NOT NULL,
  `department_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `faculty_name`, `rank`, `department_id`) VALUES
('2016BCS1021', 'mannem srinivas', 'professor', 'cse'),
('2016BCS1022', 'mannem ramakrishna', 'professor', 'cse');

-- --------------------------------------------------------

--
-- Table structure for table `new_assignments`
--

CREATE TABLE `new_assignments` (
  `id` int(255) NOT NULL,
  `assignment_id` varchar(255) NOT NULL,
  `faculty_id` varchar(255) NOT NULL,
  `course_id` varchar(255) NOT NULL,
  `file_location` varchar(255) NOT NULL,
  `description` varchar(700) NOT NULL,
  `last_date` date NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `new_assignments`
--

INSERT INTO `new_assignments` (`id`, `assignment_id`, `faculty_id`, `course_id`, `file_location`, `description`, `last_date`, `created_time`) VALUES
(5, 'ass123', '2016BCS1021', 'IMS112', './uploads/2016BCS1021/assigments/csv_learn.py', 'Important one', '2016-12-24', '2018-08-24 09:03:12');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` varchar(255) NOT NULL,
  `year_joined` year(4) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `stream` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `year_joined`, `student_name`, `branch`, `stream`) VALUES
('2016BCS0021', 2016, 'mannem suresh', 'cse', 'b.tech'),
('216BCS0022', 2016, 'mannem ramesh', 'cse', 'b.tech');

-- --------------------------------------------------------

--
-- Table structure for table `user_accounts`
--

CREATE TABLE `user_accounts` (
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `created_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `student` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_accounts`
--

INSERT INTO `user_accounts` (`email`, `password`, `user_id`, `created_date`, `student`) VALUES
('m.srinivas365@gmail.com', 'loveudad', '2016BCS1021', '2018-08-24 06:17:18', 0),
('suresh@gmail.com', 'loveudad', '2016BCS0021', '2018-08-24 02:40:28', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignments_submitted`
--
ALTER TABLE `assignments_submitted`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `new_assignments`
--
ALTER TABLE `new_assignments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `user_accounts`
--
ALTER TABLE `user_accounts`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignments_submitted`
--
ALTER TABLE `assignments_submitted`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `course_enrollment`
--
ALTER TABLE `course_enrollment`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `new_assignments`
--
ALTER TABLE `new_assignments`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
