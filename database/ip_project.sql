-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2020 at 06:05 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ip_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `academicyear`
--

CREATE TABLE `academicyear` (
  `id` int(11) NOT NULL,
  `academicyear` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `academicyear`
--

INSERT INTO `academicyear` (`id`, `academicyear`) VALUES
(52, '2015-2016'),
(46, '2016-2017'),
(47, '2017-2018'),
(45, '2018-2019'),
(48, '2019-2020');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(10) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `Name`, `Username`, `Email`, `Password`) VALUES
(1, 'Shubham', 'admin', 'shubham@vcet.edu.in', '7815696ecbf1c96e6894b779456d330e');

-- --------------------------------------------------------

--
-- Table structure for table `assignment`
--

CREATE TABLE `assignment` (
  `id` int(11) NOT NULL,
  `topicname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `directory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `submission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `deadline_on` datetime NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int(10) NOT NULL,
  `DeptID` varchar(255) NOT NULL,
  `DeptName` varchar(255) NOT NULL,
  `DeptYear` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `DeptID`, `DeptName`, `DeptYear`) VALUES
(15, 'DEPT01', 'Mechanical', '1994'),
(16, 'DEPT02', 'Electronics and Telecommunication', '1994'),
(17, 'DEPT03', 'Instrumentation', '1994'),
(18, 'DEPT04', 'Computer Engineering', '1999'),
(19, 'DEPT05', 'Information Technology', '1999'),
(20, 'DEPT06', 'Civil', '2013'),
(21, 'DEPT07', 'Data Science', '2020'),
(22, 'DEPT08', 'Artificial Intelligence', '2020');

-- --------------------------------------------------------

--
-- Table structure for table `pdfmaterials`
--

CREATE TABLE `pdfmaterials` (
  `id` int(11) NOT NULL,
  `topicname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `directory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `pptmaterials`
--

CREATE TABLE `pptmaterials` (
  `id` int(11) NOT NULL,
  `topicname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `file_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `directory` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `topicname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `deadline_no` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `subjectdetails`
--

CREATE TABLE `subjectdetails` (
  `id` int(10) NOT NULL,
  `subjectid` varchar(255) NOT NULL,
  `subjectname` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `semtype` varchar(255) NOT NULL,
  `FoundedYear` int(4) NOT NULL,
  `ValidTill` int(4) NOT NULL,
  `academicyear` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subjectdetails`
--

INSERT INTO `subjectdetails` (`id`, `subjectid`, `subjectname`, `department`, `year`, `semtype`, `FoundedYear`, `ValidTill`, `academicyear`) VALUES
(15, 'ITC301', 'Engineering Mathematics-III', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(16, 'ITC302', 'Data Structure and Analysis', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(17, 'ITC303', 'Database Management System', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(18, 'ITC304', 'Principle of Communication', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(19, 'ITC305', 'Paradigms and Computer Programming Fundamentals', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(20, 'ITL301', 'Data Structure Lab', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(21, 'ITL302', 'SQL Lab', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(22, 'ITL303', 'Computer Programming Paradigms Lab', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(24, 'ITL304', 'Java Lab', 'Information Technology', 'Second Year', 'Odd Sem', 2016, 2020, '2016-2020'),
(25, 'DS001', 'Python Programming', 'Data Science', 'Second Year', 'Odd Sem', 2020, 2024, '2020-2024');

-- --------------------------------------------------------

--
-- Table structure for table `teachersubject`
--

CREATE TABLE `teachersubject` (
  `id` int(10) NOT NULL,
  `collegeid` varchar(255) NOT NULL,
  `teachername` varchar(255) NOT NULL,
  `subjectname` varchar(255) NOT NULL,
  `academicyear` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `CollegeID` varchar(255) NOT NULL,
  `Name` varchar(255) NOT NULL,
  `Username` varchar(255) NOT NULL,
  `Email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `Department` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `id` int(11) NOT NULL,
  `topicname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `URL` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `subject_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `department` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cay` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uploaded_on` datetime NOT NULL,
  `status` enum('1','0') COLLATE utf8_unicode_ci NOT NULL DEFAULT '1',
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academicyear`
--
ALTER TABLE `academicyear`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `academicyear` (`academicyear`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `assignment`
--
ALTER TABLE `assignment`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `DeptID` (`DeptID`);

--
-- Indexes for table `pdfmaterials`
--
ALTER TABLE `pdfmaterials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pptmaterials`
--
ALTER TABLE `pptmaterials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `subjectdetails`
--
ALTER TABLE `subjectdetails`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teachersubject`
--
ALTER TABLE `teachersubject`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD UNIQUE KEY `Email` (`Email`),
  ADD UNIQUE KEY `Username_2` (`Username`),
  ADD UNIQUE KEY `CollegeID` (`CollegeID`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academicyear`
--
ALTER TABLE `academicyear`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assignment`
--
ALTER TABLE `assignment`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `pdfmaterials`
--
ALTER TABLE `pdfmaterials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `pptmaterials`
--
ALTER TABLE `pptmaterials`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjectdetails`
--
ALTER TABLE `subjectdetails`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `teachersubject`
--
ALTER TABLE `teachersubject`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
