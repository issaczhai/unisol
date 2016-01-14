-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Jan 14, 2016 at 01:51 PM
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
('LAN101', 'Basic English', 'Snow Chen', 120, 'public_html/course/LAN101/displayPic/English12016011413272552162displayPic.jpg', 'This course teaches basic English including vocabulary and conversational sentences.', '{"Unit 1":"Introduction","Unit 2":"English History","Unit 3":"Vocabulary","Unit 4":"Conversation","Unit 5":"Review"}', 'Prepared for English beginner', '', 'No', 'BasicEng', 'No'),
('LAN201', 'Cantonese', 'Issac Zhai', 9999, 'public_html/course/LAN201/displayPic/unnamed2016011413305696055displayPic.png', 'This course teaches basic Cantonese including vocabulary and conversational sentences.', '{"Unit 1":"Introduction","Unit 2":"Vocabulary"}', 'Prepare for learners who are interested in Cantonese', '', 'No', 'BasicCan', 'No'),
('LAN301', 'Sichuanese', 'Feng Xin', 200, 'public_html/course/LAN301/displayPic/Sichuanese_in_China2016011413341958375displayPic.png', 'This course teaches basic Sichuanese including vocabulary and conversational sentences.', '{"Unit 1":"Introduction","Unit 2":"Pick up Girls Sentence"}', 'For Single people', '', 'No', 'BasicSC', 'LAN401'),
('LAN401', 'Conversational Mandarin', 'Issac Zhai', 999, 'public_html/course/LAN401/displayPic/chinese32016011413353089810displayPic.jpg', 'This course teaches basic Mandarin including vocabulary and conversational sentences.', '{"Unit 1":"Introduction","Unit 2":"Pinyin","Unit 3":"Writing"}', 'For Foreigner', '', 'No', 'BasicMan', 'No'),
('SPORTS101', 'Soccer Foundation', 'Feng Xin', 200, 'public_html/course/SPORTS101/displayPic/soccertips2016011413412632903displayPic.jpg', 'This course teaches basic Soccer Skills including passing, holding, shooting, dribbling. However, this coach might be a bit lousy.', '{"Unit 1":"What is soccer","Unit 2":"Game"}', 'For kids', '', 'No', 'No', 'No'),
('SPORTS201', 'Soccer Tactics and Formation', 'Issac Zhai', 300, 'public_html/course/SPORTS201/displayPic/crisis-prevention-tactics2016011413461472446displayPic.jpg', 'This course teaches basic soccer tactics and formation with a lot of well-explained real game example from Guangzhou Evergrande FC.', '{"Unit 1":"Introduction","Unit 2":"Basic Formation","Unit 3":"In-Game Tactic"}', 'For people who are interested to be coach', '', 'No', 'No', 'SPORTS101'),
('SPORTS301', 'Soccer Team Management', 'Issac', 500, 'public_html/course/SPORTS301/displayPic/football-manager-2014-arrives-on-linux-on-october-31-383609-2-21193292016011413492378052displayPic.jpg', 'This course teaches basic Sports Team Management principles including how to handle trouble-maker players such as Diego Costa.', '{"Unit 1":"Introduction","Unit 2":"Art of Management"}', 'For Soccer Savvy', '', 'No', 'No', 'SPORTS101,SPORTS201');

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
('LAN101', 'G1', 'Mon - Thur 7pm - 10pm', '', '2016-01-18', 'SMU SOE Seminar Room 2-9', 45, 'English', ''),
('LAN101', 'G2', 'Fri - Sat 5 pm - 8 pm', '', '2016-01-22', 'SMU SOE Seminar Room 2-9', 30, 'English', ''),
('LAN201', 'G1', '', 'Every Wednesday 8-10pm', '2016-01-27', 'SMU SOE Seminar Room 3-1', 45, 'Cantonese,English', ''),
('LAN201', 'G2 (in Mandarin)', '', 'Every Thursday 8-10pm', '2016-01-28', 'SMU SOE Seminar Room 2-9', 45, 'Mandarin,Cantonese', ''),
('LAN301', 'G1', 'Mon - Sat 3pm - 5pm', '', '2016-01-18', 'SMU SOE Seminar Room 2-1', 45, 'Mandarin', ''),
('LAN301', 'G2', '', 'Every Thur 8-11pm', '2016-01-21', 'SMU SOE Seminar Room 2-1', 30, 'Mandarin', ''),
('LAN301', 'G3', '', 'Sunday 1pm - 4pm', '2016-01-24', 'PingTan Office', 45, 'Mandarin', ''),
('LAN401', 'G1', 'Mon - Tue 7pm - 10pm', '', '2016-01-18', 'SMU SOE Seminar Room 2-8', 45, 'Mandarin,English', ''),
('LAN401', 'G2', 'Mon - Thur 2pm - 4pm', '', '2016-01-25', 'SMU SOE Seminar Room 3-2', 45, 'English,Mandarin', ''),
('SPORTS101', 'G1', 'Saturday 7pm-9pm', '', '2016-01-23', 'Jelan Basa Stadium', 22, 'Mandarin,English', ''),
('SPORTS101', 'G2', 'Sunday 7 pm - 9 pm', '', '2016-01-24', 'Jelan Basa Stadium', 22, 'Mandarin,English', ''),
('SPORTS301', 'G1', 'Saturday 10 am - 1 pm', '', '2016-01-23', 'SMU SOE Seminar Room 2-4', 45, 'Mandarin,Cantonese,English', ''),
('SPORTS301', 'G2', 'Friday 8 - 10pm', '', '2016-01-22', 'SMU SOE Seminar Room 2-4', 45, 'Mandarin,Cantonese,English', '');

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
