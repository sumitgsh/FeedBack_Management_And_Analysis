-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 20, 2021 at 11:19 AM
-- Server version: 5.7.26
-- PHP Version: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `feedback_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumni`
--

DROP TABLE IF EXISTS `alumni`;
CREATE TABLE IF NOT EXISTS `alumni` (
  `alumni_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `program_Id` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`alumni_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

DROP TABLE IF EXISTS `course`;
CREATE TABLE IF NOT EXISTS `course` (
  `course_Name` varchar(100) NOT NULL,
  `course_Code` varchar(11) NOT NULL,
  `department_Id` varchar(11) NOT NULL,
  PRIMARY KEY (`course_Code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_Name`, `course_Code`, `department_Id`) VALUES
('Computer Network', 'CS519', 'cse');

-- --------------------------------------------------------

--
-- Table structure for table `coursetaken`
--

DROP TABLE IF EXISTS `coursetaken`;
CREATE TABLE IF NOT EXISTS `coursetaken` (
  `course_Taken_Id` int(11) NOT NULL AUTO_INCREMENT,
  `course_Code` varchar(11) NOT NULL,
  `student_Id` bigint(11) NOT NULL,
  PRIMARY KEY (`course_Taken_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `coursetaught`
--

DROP TABLE IF EXISTS `coursetaught`;
CREATE TABLE IF NOT EXISTS `coursetaught` (
  `course_Taught_Id` bigint(11) NOT NULL AUTO_INCREMENT,
  `teacher_Id` varchar(11) NOT NULL,
  `course_Code` varchar(11) NOT NULL,
  `session` varchar(11) NOT NULL,
  `year` int(11) NOT NULL,
  PRIMARY KEY (`course_Taught_Id`),
  KEY `course_Id` (`course_Code`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `coursetaught`
--

INSERT INTO `coursetaught` (`course_Taught_Id`, `teacher_Id`, `course_Code`, `session`, `year`) VALUES
(1, 'a5', 'CS519', 'autumn', 2021);

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `department_Id` varchar(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  PRIMARY KEY (`department_Id`),
  UNIQUE KEY `department_Id` (`department_Id`,`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`department_Id`, `name`) VALUES
('cse', 'Cse');

-- --------------------------------------------------------

--
-- Table structure for table `employers`
--

DROP TABLE IF EXISTS `employers`;
CREATE TABLE IF NOT EXISTS `employers` (
  `employers_Id` bigint(11) NOT NULL AUTO_INCREMENT,
  `organization_Name` varchar(255) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `designation` varchar(50) NOT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`employers_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

DROP TABLE IF EXISTS `feedback`;
CREATE TABLE IF NOT EXISTS `feedback` (
  `feedback_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `feedbacker_id` bigint(11) NOT NULL,
  `question_Id` int(5) NOT NULL,
  `answer` varchar(2000) NOT NULL,
  PRIMARY KEY (`feedback_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `feedback_receiveables`
--

DROP TABLE IF EXISTS `feedback_receiveables`;
CREATE TABLE IF NOT EXISTS `feedback_receiveables` (
  `feedback_R_Id` int(11) NOT NULL AUTO_INCREMENT,
  `course_Code` varchar(11) NOT NULL,
  `question_Id` int(5) NOT NULL,
  `status` varchar(11) NOT NULL,
  PRIMARY KEY (`feedback_R_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `program_Id` varchar(11) NOT NULL,
  `program_Name` varchar(50) NOT NULL,
  `department_Id` varchar(11) NOT NULL,
  PRIMARY KEY (`program_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`program_Id`, `program_Name`, `department_Id`) VALUES
('', '', 'cse');

-- --------------------------------------------------------

--
-- Table structure for table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `question_Id` int(5) NOT NULL AUTO_INCREMENT,
  `question` varchar(1000) NOT NULL,
  `question_Type` varchar(11) NOT NULL,
  PRIMARY KEY (`question_Id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `question`
--

INSERT INTO `question` (`question_Id`, `question`, `question_Type`) VALUES
(3, 'hi', 'rating'),
(4, 'hi', 'rating'),
(5, 'hi', 'rating'),
(6, 'hi', 'rating'),
(7, 'ji', 'rating'),
(8, 'ji', 'rating'),
(9, 'ji', 'rating'),
(10, 'ji', 'rating'),
(11, 'ji', 'rating'),
(12, 'ji', 'rating'),
(13, 'ji', 'rating'),
(14, 'ji', 'rating'),
(15, 'lllo', 'long_Answer'),
(16, 'lllo', 'long_Answer');

-- --------------------------------------------------------

--
-- Table structure for table `questioncategory`
--

DROP TABLE IF EXISTS `questioncategory`;
CREATE TABLE IF NOT EXISTS `questioncategory` (
  `category_Id` varchar(11) NOT NULL,
  `question_Id` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `questioncategory`
--

INSERT INTO `questioncategory` (`category_Id`, `question_Id`) VALUES
('alumni', 14),
('teacher', 15),
('alumni', 16),
('teacher', 16);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `student_Id` int(11) NOT NULL,
  `roll_No` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `program_Id` varchar(11) NOT NULL,
  `parent_Phone_No` bigint(10) NOT NULL,
  `parent_Name` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `verified` tinyint(1) DEFAULT NULL,
  `semester` int(2) NOT NULL,
  `relation` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `super_admin`
--

DROP TABLE IF EXISTS `super_admin`;
CREATE TABLE IF NOT EXISTS `super_admin` (
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

DROP TABLE IF EXISTS `teacher`;
CREATE TABLE IF NOT EXISTS `teacher` (
  `teacher_Id` varchar(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `department_Id` varchar(11) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT '1',
  `role` varchar(11) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`teacher_Id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_Id`, `name`, `email`, `department_Id`, `verified`, `role`, `password`) VALUES
('a5', 'Arunav', 'a@gmail.com', 'cse', 1, 'hod', '$2y$10$g45BDqlimPUIYSuCqvDymePSZWX592MgwzfuSPn4MGisJ11Wp9KDu');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
