-- phpMyAdmin SQL Dump
-- version 4.0.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 31, 2016 at 08:37 AM
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
-- Table structure for table `admin`
--

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `profilePic` text NOT NULL,
  `email` text NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `profilePic`, `email`) VALUES
('pingtanAdmin', '40bd001563085fc35165329ea1ff5c5ecbdbbeef', 'img/Administrator-icon.png', '');

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
  `startDate` text NOT NULL,
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
('186950', 'Headquarters for NTUC Foodfare', '2015-09-03', '2016-01-01', '12577000', 'Total Sub', 'Proposed Erection of a Factory and Headquarters for NTUC Foodfare on Lot 0711w Mk 13 at 10 Senoko Way Singapore 758031(Design & Build)', 'MA Builders Pte Ltd / NTUC', '{"234362":"images\\/project\\/186950\\/201603101630147856ntuc.png"}', 'Ongoing'),
('263336', 'PLC 8 Development', '2013-02-01', '2014-02-01', '1,161,605', 'Reinforced Concrete & External Works', 'Proposed Mixed-Use Development Comprising 1 Block of 14-Storey & 1 Block of 17-Storey Towers With Part 2/3 Storey Podium On Lots 02643V,01277X PT, 0266N PT, 02644P PT & 02795P PT T.S 17 At Lavender Street / Kallang Avenue (Kallang Planning Area)', 'PLC 8 Development Pte Ltd', '{"632479":"images\\/project\\/263336\\/201603101705063772PLC 8 Development.png"}', 'Completed'),
('303497', 'Kuehne+Nagel', '2015-01-01', '2015-09-01', '2900000', 'Wet Architectural Works', 'Proposed Erection of a 7-Storey Single-User Warehouse with Ancillary Office Development (Business 2) On Lot 4417C PT MK06 at Pioneer Crescent for Kuehne+Nagel Real', 'Kuehne+Nagel Real Estate Pte Ltd', '{"208956":"images\\/project\\/303497\\/201603101645466923Kuehne+Nagel.jpg"}', 'Completed'),
('315460', 'Westbuild Construction', '2015-01-01', '2015-07-01', '3,235,771.26', 'Wet & Dry Architectural Works and External Works', 'Proposed New Erection of A Block of 9-Storey Multiple-User Light Industrial Development (Total 55 units) with Staff Canteen At 2nd Storey At No.56 Kallang Pudding Road On Lot(s) 03163W, 03165P, 08056W, 08057V, 08058P & 08059T MK24 At 56 Kallang Pudding Road, HH @ Kallang, Singapore 349328 (Geylang Planning Area)', 'Westbuild Construction Pte Ltd', '{"101950":"images\\/project\\/315460\\/201603101650288713Westbuild Construction.jpg"}', 'Completed'),
('431732', 'Seagate Singapore International Headquarter', '2014-01-01', '2014-09-01', '9,480,000', 'Wet Architectural Works', 'Proposed New Erection of A Part 6 Storey, Part 9 Storey Single-User Business Park Development with Ancillary Facilities and 3 Basement Carpark Floors On MK 03 Lot 5068L & 5065K At Ayer Rajah Avenue for BP-Seagate Singapore International Headquarter Pte Ltd', 'Seagate Singapore International Headquarter Pte Ltd', '{"205276":"images\\/project\\/431732\\/201603101658172636Seagate.jpg"}', 'Completed'),
('539307', 'Commonwealth Food Services Pte Ltd', '2014-12-01', '2015-11-01', '5055469', 'Wet Architectural Works', 'Proposed Erection of a 7-Storey Single-User Warehouse with Ancillary Office Development (Business 2) On Lot 4417c Pt Mk06 at Jalan Buroh Lane for Commonwealth Food Services Pte Ltd', 'Commonwealth Food Services Pte Ltd', '{"485125":"images\\/project\\/539307\\/20160310163751361Commonwealth Food Services Pte Ltd.jpg"}', 'Completed'),
('675995', 'Applied Materials', '2015-01-01', '2015-09-01', '188000', 'Wet Architectural & RC Works ', 'Proposed New Erection Of Toilet Area At 4th Storey Outdoor For Applied Material South East Asia Pte Ltd At Upper Changi North / Changi Road St 2', 'Applied Materials (SEA) Pte Ltd', '{"619351":"images\\/project\\/675995\\/201603101641153258Applied Materials.jpg"}', 'Completed'),
('712067', 'Jurong Cold Storage', '2015-12-01', '2016-07-01', '29687000', 'Total Sub', 'Proposed Additions and Alteration to the Existing Single User General Industrial Factory Involving Erection of a 5-Storey Single User General Industrial Factory with Cold Storage Facilities on Lot D2492C MK06 at 11 Chin Bee Drive', 'Jurong Cold Storage', '{"512509":"images\\/project\\/712067\\/201603101634445389jurong cold storage.png"}', 'Ongoing'),
('817108', 'ST Electronics', '2012-04-01', '2013-04-01', '3,936,856', 'Wet & Dry Architectural Works', 'Proposed Erection of a 7-Storey Single-User Industrial Development (Business 2) With Roof Amenities & A Semi-Basement Carpark on Lot 1478A PT MK18 at Ang Mo Kio Street 65 for ST Electronics (Info-Software Systems) Pte Ltd', 'ST Electronics', '{"679556":"images\\/project\\/817108\\/201603101709084571ST Electronics.png"}', 'Completed'),
('819092', 'Breadtalk Group', '2012-03-01', '2013-03-01', '1,280,000', 'Wet Architectural Works', 'Proposed Erection of a 10-Storey Headquarters Building for Breadtalk Group at Parcel 1a, Paya Lebar I-Park Singapore', 'Breadtalk Group', '{"149822":"images\\/project\\/819092\\/201603101707372827Breadtalk Group.jpg"}', 'Completed'),
('861267', 'SB (Westview) Investment', '2014-01-01', '2014-09-01', '2,212,355.60', 'Reinforced Concrete Works', 'Proposed Erection of Multiple-User General Light Industrial Development Comprising A Block of 9-Storey Ramp Up Factory Building (Total 68 Factory Units), A Temporary Ancillary Staff Canteen (Total 1 Unit) and Other Ancillary Facilities On Lot 8788L MK 05 At Bukit Batok Street 23 (Bukit Batok Planning Area)', 'SB (Westview) Investment Pte Ltd', '{"282263":"images\\/project\\/861267\\/20160310170029361SB (Westview) Investment.jpg"}', 'Completed'),
('947815', 'Xin Ming Hua', '2015-01-01', '2015-09-01', '2900000', 'RC Works to Ramp & Wet Architectural Works  ', 'Proposed Erection of a Single-User Ramp up Industrial Development with a Block of 7 Storey Factory Building with Ancillary Office and Ancillary Facilities on Lot 02743W PT Mukim 07 at Tuas Crescent (Tuas Planning Area) for Xin Ming Hua', 'Xin Ming Hua', '{"417285":"images\\/project\\/947815\\/201603101643146573Xin Ming Hua.jpg"}', 'Completed'),
('989319', 'Huang Pu', '2012-10-01', '2013-10-01', '536,300', 'Wet Architectural Works', 'Erection of a 4-storey Single User Warehouse with 2 Level of Ancillary Offices on Lot 00802x Mk 30 at Tampines Road in Tampines Logispark (Paya Lebar Planning Area) ', 'Huang Pu Construction Pte Ltd', '{"964404":"images\\/project\\/989319\\/201603101711169313Huang Pu.png"}', 'Completed');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
