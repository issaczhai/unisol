-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jun 29, 2015 at 01:22 PM
-- Server version: 5.6.12-log
-- PHP Version: 5.4.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dmx_db`
--
CREATE DATABASE IF NOT EXISTS `dmx_db` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `dmx_db`;

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`) VALUES
('nishishabi', 'nitamacaishishabi');

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE IF NOT EXISTS `contact` (
  `contact_id` varchar(10) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `tel` varchar(20) DEFAULT NULL,
  `fax` varchar(20) DEFAULT NULL,
  `profile_pic` varchar(300) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `project_id` varchar(30) NOT NULL,
  `photo_no` varchar(5) NOT NULL,
  `photo_url` varchar(300) NOT NULL,
  PRIMARY KEY (`project_id`,`photo_no`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE IF NOT EXISTS `project` (
  `project_id` varchar(30) NOT NULL,
  `project_name` varchar(30) NOT NULL,
  `type` varchar(100) NOT NULL,
  `year` varchar(10) NOT NULL,
  `country` varchar(30) NOT NULL,
  `location` varchar(100) NOT NULL,
  `size` varchar(30) NOT NULL,
  `completion_date` datetime NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`project_id`, `project_name`, `type`, `year`, `country`, `location`, `size`, `completion_date`, `description`) VALUES
('P0001', 'SAMPLE 1', 'Corporate', '2013', 'Singapore', '', '1000 sqft', '2013-12-25 00:00:00', 'This is the sample project for testing'),
('P0002', 'TESTING PROJECT2', 'Corporate', '2014', 'China', '', '2000 sqft', '2014-10-15 00:00:00', 'This is the second sample project'),
('P0003', 'NEW PROJECT3', 'Corporate', '2012', 'Indonesia', '', '1000 sqft', '2015-01-07 00:00:00', 'This is the third sample project'),
('P0004', 'Fourth SAMPLE', 'Commercial', '2014', 'Singapore', '', '3000 sqft', '2015-06-01 00:00:00', 'This is the fourth sample project'),
('P0005', 'A1 BUILDER', 'Commercial', '2015', 'Singapore', '', '2000 sqft', '2015-01-08 00:00:00', 'A1 Builder office project'),
('P0006', 'DMX STUDIO', 'Corporate', '2015', 'Singapore', '', '500 sqft', '2015-06-03 00:00:00', 'This is DMX sample project'),
('P0007', 'YUE XIU Restaurant 2009', 'Commercial', '2009', 'Singapore', 'Star Vista level 2', '4000 sqft', '2010-01-01 00:00:00', 'This is Restaurant sample project'),
('P0008', 'Tang Dynasty KTV', 'Commercial', '2008', 'Singapore', 'City Plaza', '6000 sqft', '2008-09-011 00:00:00', 'This is DMX sample ktv project'),
('P0009', 'Defred Boutique', 'Commercial', '2008', 'Singapore', 'Hyatt Hotel', '1100 sqft', '2008-06-04 00:00:00', 'This is DMX sample project'),
('P0010', 'Bailian Shopping Mall Shanghai', 'Commercial', '2014', 'China', 'Bailian Shopping Mall Shanghai', '80000 sqft', '2014-09-09 00:00:00', 'This is DMX sample project of Shanghai shopping mall'),
('P0011', 'IAH Icafe', 'Commercial', '2007', 'Singapore', 'Funan Digitalife Mall', '1600 sqft', '2007-05-03 00:00:00', 'This is Icafe in Funan Digitalife Mall'),
('P0012', 'Cable Road House', 'Residential', '2015', 'Singapore', 'Cable Road', '12000 sqft', '2015-06-03 00:00:00', 'This is House sample'),
('P0013', 'Novelis Condo', 'Residential', '2012', 'Singapore', 'Mayfield Avenue', '1 Room 527 sqft 2 Rooms 807 sqft Penthouse 1216 sqft', '2012-06-03 00:00:00', 'This is Condo sample project'),
('P0014', '22 Jalan Salang', 'Architecture', '2008', 'Singapore', '22 Jalan Salang', '5500 sqft', '2008-12-03 00:00:00', 'This is DMX sample project'),
('P0015', 'Mayfield Avenue', 'Architecture', '2011', 'Singapore', 'Mayfield Avenue', '6800', '2011-07-07 00:00:00', 'This is DMX sample project'),
('P0016', 'STA', 'Corporate', '2009', 'Singapore', 'Jalan Boon Lay', '1200 sqft', '2009-09-03 00:00:00', 'This is DMX sample project for corporate'),
('P0017', 'Star Automotive', 'Corporate', '2009', 'Singapore', '', '4800', '2009-06-09 00:00:00', 'This is DMX sample project'),
('P0018', 'IAH Games', 'Corporate', '2010', 'Singapore', 'Tai Seng ST', '15000 sqft', '2010-09-18 00:00:00', 'This is IAH Games project'),
('P0019', 'ASE Global', 'Corporate', '2015', 'Singapore', '', '9000 sqft', '2015-07-14 00:00:00', 'This is DMX sample project'),
('P0020', 'Safe2Travel Pte Ltd', 'Corporate', '2008', 'Singapore', 'Tampines Concourse', '11100 sqft', '2008-08-08 00:00:00', 'This is DMX sample project'),
('P0021', 'Mone Pte Ltd', 'Corporate', '2006', 'China', 'Shanghai, Yin Cheng Zhong Road', 'approx. 62000 sqft', '2006-06-03 00:00:00', 'This is a huge oversea project'),
('P0022', 'Edcha Showroom', 'Corporate', '2007', 'China', 'Shanghai, South Jiangyang Road', '1100 sqft', '2007-06-03 00:00:00', 'This is DMX sample project'),
('P0023', 'Partay Club', 'Commercial', '2008', 'Singapore', 'Commonwealth Street', '80000 sqft', '2008-10-14 00:00:00', 'This is DMX sample project'),
('P0024', 'Holiday Inn Atrium', 'Commercial', '2007', 'Singapore', 'Outram Road', '12000 sqft', '2007-09-03 00:00:00', 'This is DMX sample project for commercial'),
('P0025', 'Hliday Inn Hotel President Suite', 'Commercial', '2007', 'Singapore', 'Outram Road', '3000', '2007-06-09 00:00:00', 'This is DMX sample project'),
('P0026', 'As Home Shenzhen', 'Commercial', '2011', 'China', 'Shenzhen, Huaqiang North Road', '10000 sqft', '2011-09-18 00:00:00', 'This is Hotel project in China'),
('P0027', 'As Home Guangzhou', 'Commercial', '2011', 'China', 'Guangzhou, Tianhe North Road', '9000 sqft', '2011-07-14 00:00:00', 'This is Hotel project in China'),
('P0028', '7 Days Shenzhen', 'Corporate', '2012', 'China', 'Shenzhen, Huaqiang North Road', '11000 sqft', '2012-08-08 00:00:00', 'This is DMX sample project'),
('P0029', 'Tin Ho Mall', 'Architecture', '2005', 'China', 'Guangzhou, Tianhe', 'approx. 820000 sqft', '2005-06-06 00:00:00', 'This is a huge oversea project'),
('P0030', 'Tim Hou Wun', 'Commercial', '2013', 'Singapore', 'Plaza Singapura', '1100 sqft', '2013-09-10 00:00:00', 'This is DMX sample project');


/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
