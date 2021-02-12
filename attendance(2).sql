-- phpMyAdmin SQL Dump
-- version 4.6.6deb5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 12, 2021 at 08:33 AM
-- Server version: 5.7.30-0ubuntu0.18.04.1
-- PHP Version: 7.2.24-0ubuntu0.18.04.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance`
--

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `lecturer_id` int(11) NOT NULL,
  `lecturer_name` varchar(100) NOT NULL,
  `lecturer_email` varchar(100) NOT NULL,
  `lecturer_phone` int(11) NOT NULL,
  `lecturer_staff_id` varchar(100) NOT NULL,
  `verification_code` varchar(100) NOT NULL,
  `modified_at` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`lecturer_id`, `lecturer_name`, `lecturer_email`, `lecturer_phone`, `lecturer_staff_id`, `verification_code`, `modified_at`, `created_at`) VALUES
(1, 'James', 'james@gmail.com', 721095436, '31245609', 'eb32da3d6324b2016e4a04e8123ef958', '2021-02-09 03:47:03', '2021-02-09 08:47:03'),
(2, 'James', 'james2@gmail.com', 721095438, '31245438', '4b84a4fbb709d5887d092b74ee5d6724', '2021-02-12 02:17:17', '2021-02-12 07:17:17'),
(3, 'James', 'james4@gmail.com', 721095430, '31245604', '1a24c6e1861ae8307ff8b0860eb51c8c', '2021-02-09 03:50:01', '2021-02-09 08:50:01');

-- --------------------------------------------------------

--
-- Table structure for table `lecturers_subjects`
--

CREATE TABLE `lecturers_subjects` (
  `assign_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `modified_at` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `lecturers_subjects`
--

INSERT INTO `lecturers_subjects` (`assign_id`, `lecturer_id`, `subject_id`, `modified_at`, `created_at`) VALUES
(3, 2, 2, '2021-02-09 08:31:27', '2021-02-09 13:31:27');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `student_id` int(11) NOT NULL,
  `student_name` varchar(100) NOT NULL,
  `student_email` varchar(100) NOT NULL,
  `student_phone` int(11) NOT NULL,
  `reg_no` varchar(100) NOT NULL,
  `year` varchar(11) NOT NULL,
  `semester` varchar(11) NOT NULL,
  `course` varchar(100) NOT NULL,
  `dept` varchar(100) NOT NULL,
  `verification_code` varchar(100) NOT NULL,
  `modified_at` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`student_id`, `student_name`, `student_email`, `student_phone`, `reg_no`, `year`, `semester`, `course`, `dept`, `verification_code`, `modified_at`, `created_at`) VALUES
(1, 'mike', 'aisacsmooth@gmail.com', 721098125, '34876512', '2nd', '2nd', 'course2', 'dept3', 'ae7832c0696e99d2fbe8c9cdf4db1633', '2021-02-12 01:02:43', '2021-02-12 06:02:43'),
(2, 'James', 'mike@gmail.com', 721675098, '98765', '2nd', '2nd', 'course2', 'dept2', '8afb5804f92f8d5f149bfc66d149aa92', '2021-02-09 08:41:32', '2021-02-09 13:41:32');

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) NOT NULL,
  `subject_code` varchar(100) NOT NULL,
  `subject_course` varchar(100) NOT NULL,
  `subject_year` varchar(100) NOT NULL,
  `subject_semester` varchar(100) NOT NULL,
  `status` text NOT NULL,
  `modified_at` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`subject_id`, `subject_name`, `subject_code`, `subject_course`, `subject_year`, `subject_semester`, `status`, `modified_at`, `created_at`) VALUES
(2, 'Artificial', '009', 'course1', '2nd', '2nd', 'Assigned', '2021-02-12 03:01:01', '2021-02-12 08:01:01'),
(3, 'Test', '0098', 'course1', '1st', '1st', 'NotAssigned', '2021-02-12 03:08:33', '2021-02-12 08:08:33');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_attendance`
--

CREATE TABLE `tbl_attendance` (
  `attendance_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `attendance_status` enum('Present','Absent') NOT NULL,
  `attendance_date` date NOT NULL,
  `subject_id` int(11) NOT NULL,
  `checked_by` varchar(100) NOT NULL,
  `modified_at` varchar(100) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_attendance`
--

INSERT INTO `tbl_attendance` (`attendance_id`, `student_id`, `attendance_status`, `attendance_date`, `subject_id`, `checked_by`, `modified_at`, `created_at`) VALUES
(217, 1, 'Present', '2021-02-11', 2, 'james2@gmail.com', '2021-02-12 02:07:08', '2021-02-12 07:07:08'),
(218, 2, 'Absent', '2021-02-11', 2, 'james2@gmail.com', '2021-02-12 02:06:10', '2021-02-12 07:06:10'),
(219, 1, 'Present', '2021-02-10', 2, 'james2@gmail.com', '2021-02-12 02:07:08', '2021-02-12 07:07:08'),
(220, 2, 'Present', '2021-02-10', 2, 'james2@gmail.com', '2021-02-12 02:07:08', '2021-02-12 07:07:08');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `mobile_number` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `verification_code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0' COMMENT '1=Verified, 0=Not verified',
  `role` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `modified_at` varchar(100) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `name`, `mobile_number`, `verification_code`, `verified`, `role`, `created_at`, `modified_at`) VALUES
(19, 'admin@attendance.co.ke', 'admin', '0717007007', '5f4dcc3b5aa765d61d8327deb882cf99', 1, 'admin', '', '2021-02-12 03:23:24'),
(20, 'aisacsmooth@gmail.com', 'mike', '0721098123', 'ffba7a186e5c46af6567af2e456fc1a0', 1, 'student', '2021-02-09 02:53:07', '2021-02-12 03:23:56'),
(21, 'james@gmail.com', 'James', '0721095436', 'eb32da3d6324b2016e4a04e8123ef958', 0, 'lecturer', '2021-02-09 03:47:03', '2021-02-09 03:47:03'),
(22, 'james2@gmail.com', 'James', '0721095436', '5f4402a51a6334f3eadd94351f3b954f', 1, 'lecturer', '2021-02-09 03:48:26', '2021-02-12 01:47:46'),
(23, 'james4@gmail.com', 'James', '0721095430', '1a24c6e1861ae8307ff8b0860eb51c8c', 0, 'lecturer', '2021-02-09 03:50:01', '2021-02-09 03:50:01'),
(24, 'mike@gmail.com', 'James', '0721675098', '8afb5804f92f8d5f149bfc66d149aa92', 0, 'student', '2021-02-09 08:41:32', '2021-02-09 08:41:32'),
(25, 'samuel@gmail.com', 'Samuel', '0721345076', 'a38b0bde6ab468ab61ef6450ad7296e0', 0, 'student', '2021-02-12 02:24:09', '2021-02-12 02:24:09'),
(26, 'mary@gmail.com', 'Mary', '0721456234', 'aaa80e84ff3e484a3983d1678cec094f', 0, 'lecturer', '2021-02-12 02:28:15', '2021-02-12 02:28:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`lecturer_id`);

--
-- Indexes for table `lecturers_subjects`
--
ALTER TABLE `lecturers_subjects`
  ADD PRIMARY KEY (`assign_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`student_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  ADD PRIMARY KEY (`attendance_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `lecturer_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `lecturers_subjects`
--
ALTER TABLE `lecturers_subjects`
  MODIFY `assign_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `tbl_attendance`
--
ALTER TABLE `tbl_attendance`
  MODIFY `attendance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=221;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
