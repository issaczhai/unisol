-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Dec 30, 2015 at 01:33 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pingtan_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) NOT NULL,
  `password` varchar(100) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `certificate`
--

CREATE TABLE IF NOT EXISTS `certificate` (
  `studentID` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `path` varchar(200) NOT NULL,
  PRIMARY KEY (`studentID`,`type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `company`
--

CREATE TABLE IF NOT EXISTS `company` (
  `companyID` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `address` varchar(200) NOT NULL,
  `contactPersonName` varchar(100) NOT NULL,
  `contactPersonEmail` varchar(50) NOT NULL,
  `contactPersonTel` varchar(20) NOT NULL,
  `contactPersonFax` varchar(20) NOT NULL,
  `registrationID` varchar(20) NOT NULL,
  PRIMARY KEY (`companyID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE IF NOT EXISTS `course` (
  `courseID` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `description` text NOT NULL,
  `syllabus` text NOT NULL,
  `objective` text NOT NULL,
  `documents` text NOT NULL,
  `requiredCert` text NOT NULL,
  `receivedCert` text NOT NULL,
  `prerequisite` varchar(100) NOT NULL,
  PRIMARY KEY (`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`courseID`, `name`, `instructor`, `price`, `description`, `syllabus`, `objective`, `documents`, `requiredCert`, `receivedCert`, `prerequisite`) VALUES
('SG101', 'Java Foundation', 'Lee Yeow Leong', 200, 'java foundation course', '{"week 1":"Introduction","week 2":"what is java"}', 'for java beginner', '["public_html\\/course\\/SG101\\/documents\\/SG101_1451470174_(443655544) Haoxian CV 2015.2.4","public_html\\/course\\/SG101\\/documents\\/SG101_1451470174_Haoxian Resume","public_html\\/course\\/SG101\\/documents\\/SG101_1451470174_sample job application answer"]', 'CFA,cba', 'NBA', 'IS100');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE IF NOT EXISTS `group` (
  `companyID` varchar(20) NOT NULL,
  `courseID` varchar(20) NOT NULL,
  `sessionID` varchar(20) NOT NULL,
  `studentList` text NOT NULL,
  PRIMARY KEY (`companyID`,`courseID`,`sessionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `newsID` varchar(10) NOT NULL,
  `date` date NOT NULL,
  `title` varchar(200) NOT NULL,
  `content` text NOT NULL,
  PRIMARY KEY (`newsID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE IF NOT EXISTS `session` (
  `courseID` varchar(20) NOT NULL,
  `sessionID` varchar(20) NOT NULL,
  `fulltime` text NOT NULL,
  `parttime` text NOT NULL,
  `startDate` date NOT NULL,
  `venue` varchar(100) NOT NULL,
  `vacancy` int(11) NOT NULL,
  `languages` varchar(200) NOT NULL,
  `classlist` text NOT NULL,
  PRIMARY KEY (`courseID`,`sessionID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE IF NOT EXISTS `student` (
  `studentID` varchar(20) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(100) NOT NULL,
  `email` varchar(20) NOT NULL,
  `nationality` varchar(30) NOT NULL,
  `contactNo` varchar(20) NOT NULL,
  `occupation` varchar(20) NOT NULL,
  `dateOfBirth` date NOT NULL,
  `firstname` varchar(50) NOT NULL,
  `lastname` varchar(50) NOT NULL,
  `NRIC` varchar(20) NOT NULL,
  `userStatus` varchar(10) NOT NULL,
  PRIMARY KEY (`studentID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `studentstatus`
--

CREATE TABLE IF NOT EXISTS `studentstatus` (
  `studentID` varchar(20) NOT NULL,
  `courseID` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`studentID`,`courseID`,`status`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
