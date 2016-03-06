-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 06, 2016 at 07:55 AM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pingtan_construction_db`
--
CREATE DATABASE IF NOT EXISTS `pingtan_construction_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `pingtan_construction_db`;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contactId` varchar(5) NOT NULL,
  `address` text NOT NULL,
  `freephone` varchar(20) NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `fax` varchar(20) NOT NULL,
  `email` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`contactId`, `address`, `freephone`, `telephone`, `fax`, `email`) VALUES
('1', '1 Singapore', '+65 12345678', '+65 12345678', '+65 12345678', 'abc@abc.com');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `projectId` varchar(10) NOT NULL,
  `projectName` varchar(100) NOT NULL,
  `startDate` date NOT NULL,
  `endDate` date NOT NULL,
  `value` varchar(16) NOT NULL,
  `scopeOfWork` varchar(100) NOT NULL,
  `contract` text NOT NULL,
  `client` varchar(100) NOT NULL,
  `photo` text NOT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`projectId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`projectId`, `projectName`, `startDate`, `endDate`, `value`, `scopeOfWork`, `contract`, `client`, `photo`, `status`) VALUES
('474823', 'DMX', '2016-04-01', '2016-12-01', '30000000', 'Office Renovation', 'New Contract with DMX', 'DMX', '{"508609":"images\\/project\\/474823\\/201603060510253981ANACLE_1.jpg","763656":"images\\/project\\/474823\\/201603060510255357ANACLE_2.jpg","740530":"images\\/project\\/474823\\/20160306051025810ANACLE_3.jpg","984152":"images\\/project\\/474823\\/201603060510251864ANACLE_4.jpg","211318":"images\\/project\\/474823\\/201603060510258481ANACLE_5.jpg","485702":"images\\/project\\/474823\\/201603060510256556ANACLE_6.jpg","692849":"images\\/project\\/474823\\/201603060510255427ANACLE_7.jpg","815182":"images\\/project\\/474823\\/201603060510255368ANACLE_8.jpg","806997":"images\\/project\\/474823\\/201603060510255089ANACLE_9.jpg"}', 'upcoming'),
('789826', 'AMK Library', '2016-01-01', '2016-07-09', '1000000', 'Library', 'This is contract with Ang Mo Kio public library, we are working on the renovation for Level 3', 'AMK Library', '{"266964":"images\\/project\\/789826\\/201603060502497021Dredging_1.jpg","506631":"images\\/project\\/789826\\/201603060502499887Dredging_2.jpg","893515":"images\\/project\\/789826\\/201603060502494212Dredging_3.jpg","313162":"images\\/project\\/789826\\/201603060502499334Dredging_4.jpg","547994":"images\\/project\\/789826\\/201603060502495524Dredging_5.jpg"}', 'Ongoing'),
('904328', 'SIS', '2016-06-02', '2017-02-02', '50000000', 'Office Renovation', 'This is the SIS FYP room renovation project. We aim to bring the SMU SIS student''s more comfortable room for final year project.', 'SMU', '{"399899":"images\\/project\\/904328\\/201603060514465578aet2_1.jpg","177261":"images\\/project\\/904328\\/201603060514464635aet2_2.jpg","622152":"images\\/project\\/904328\\/201603060514469059aet2_3.jpg","732620":"images\\/project\\/904328\\/201603060514464434aet2_4.jpg"}', 'upcoming'),
('915528', 'SMU Administration Office Renovation', '2015-01-01', '2016-01-01', '2000000', 'Office Renovation', 'This is project for SMU administration office', 'SMU ', '{"150482":"images\\/project\\/915528\\/201603060509014192dt_1.jpg","468151":"images\\/project\\/915528\\/201603060509015219dt_2.jpg","832843":"images\\/project\\/915528\\/20160306050901265dt_3.jpg","509790":"images\\/project\\/915528\\/201603060509014759dt_4.jpg","648602":"images\\/project\\/915528\\/201603060509018819dt_5.jpg"}', 'Completed'),
('923890', 'AET Project Management', '2016-01-08', '2016-08-12', '40000000', 'Project Management', 'Project Management Contract', 'AET', '{"631298":"images\\/project\\/923890\\/201603060512452994aet1_1.jpg","469525":"images\\/project\\/923890\\/201603060512454729aet1_2.jpg","217663":"images\\/project\\/923890\\/201603060512456616aet1_3.jpg","181573":"images\\/project\\/923890\\/201603060512451896aet1_4.jpg","976489":"images\\/project\\/923890\\/20160306051245999aet1_5.jpg"}', 'Ongoing');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
