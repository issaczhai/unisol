-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 11, 2016 at 03:24 PM
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
  `type` varchar(200) NOT NULL,
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
-- Table structure for table `course_cn`
--

CREATE TABLE IF NOT EXISTS `course_cn` (
  `courseID` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `displayPic` text NOT NULL,
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
-- Dumping data for table `course_cn`
--

INSERT INTO `course_cn` (`courseID`, `name`, `instructor`, `price`, `displayPic`, `description`, `syllabus`, `objective`, `documents`, `requiredCert`, `receivedCert`, `prerequisite`) VALUES
('CAN101', '广东话', '翟浩贤', 222, 'public_html/course/CAN101/displayPic/Cantonese-Student-Association2016011115132588884displayPic.jpg', '基本廣東話會話', '{"\\u5355\\u5143\\u4e00":"\\u4ecb\\u7ecd","\\u5355\\u5143\\u4e8c":"\\u65e5\\u5e38\\u7528\\u8bed","\\u5355\\u5143\\u4e09":"\\u7c97\\u53e3"}', '面向人群：广东话初学者', '["public_html\\/course\\/CAN101\\/documents\\/CAN101_1452422744_canton_rtt.001.jpg","public_html\\/course\\/CAN101\\/documents\\/CAN101_1452422587_cantonese-basic.pdf","public_html\\/course\\/CAN101\\/documents\\/CAN101_1452422744_House_in_Cantonese_and_Mandarin.png"]', '无', 'CAN101', '无');

-- --------------------------------------------------------

--
-- Table structure for table `course_en`
--

CREATE TABLE IF NOT EXISTS `course_en` (
  `courseID` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `instructor` varchar(100) NOT NULL,
  `price` double NOT NULL,
  `displayPic` text NOT NULL,
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
-- Dumping data for table `course_en`
--

INSERT INTO `course_en` (`courseID`, `name`, `instructor`, `price`, `displayPic`, `description`, `syllabus`, `objective`, `documents`, `requiredCert`, `receivedCert`, `prerequisite`) VALUES
('CAN101', 'Cantonese', 'Issac Zhai', 222, 'public_html/course/CAN101/displayPic/Cantonese-Student-Association2016011115131380905displayPic.jpg', 'Elementary Course for Cantonese', '{"Unit 1":"Intro","Unit 2":"Daily Phrase","Unit 3":"Vulgar"}', 'For Cantonese Beginner', '["public_html\\/course\\/CAN101\\/documents\\/CAN101_1452422587_canton_rtt.001.jpg","public_html\\/course\\/CAN101\\/documents\\/CAN101_1452422587_cantonese-basic.pdf","public_html\\/course\\/CAN101\\/documents\\/CAN101_1452422587_House_in_Cantonese_and_Mandarin.png"]', 'No', 'CAN101', 'No');

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
-- Table structure for table `session_cn`
--

CREATE TABLE IF NOT EXISTS `session_cn` (
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

--
-- Dumping data for table `session_cn`
--

INSERT INTO `session_cn` (`courseID`, `sessionID`, `fulltime`, `parttime`, `startDate`, `venue`, `vacancy`, `languages`, `classlist`) VALUES
('CAN101', 'G1', '周一到周四晚 7点至10点', '', '2016-01-25', '平潭办公室', 20, '英语，广东话', ''),
('CAN101', 'G2', '', '週六下午三點至五點', '2016-01-30', '平潭办公室', 20, '英语，廣東話', '');

-- --------------------------------------------------------

--
-- Table structure for table `session_en`
--

CREATE TABLE IF NOT EXISTS `session_en` (
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

--
-- Dumping data for table `session_en`
--

INSERT INTO `session_en` (`courseID`, `sessionID`, `fulltime`, `parttime`, `startDate`, `venue`, `vacancy`, `languages`, `classlist`) VALUES
('CAN101', 'G1', '', 'Mon - Thur 7pm - 9pm', '2016-01-25', 'PingTan Office', 30, 'English,Cantonese', ''),
('CAN101', 'G2', '', 'Saturday 3pm-5pm', '2016-01-30', 'PingTan Office', 20, 'English,Cantonese', '');

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
