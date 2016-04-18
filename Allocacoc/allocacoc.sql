-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Apr 18, 2016 at 01:00 AM
-- Server version: 10.1.6-MariaDB-cll-lve
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `trussswt_allocacoc`
--

-- --------------------------------------------------------

--
-- Table structure for table `address`
--

CREATE TABLE IF NOT EXISTS `address` (
  `address_no` int(5) NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `street` varchar(50) NOT NULL,
  `block_no` varchar(30) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `building_name` varchar(30) DEFAULT NULL,
  `company_name` varchar(30) DEFAULT NULL,
  `postal_code` varchar(6) NOT NULL,
  `instruction` varchar(256) NOT NULL,
  PRIMARY KEY (`address_no`,`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `address`
--

INSERT INTO `address` (`address_no`, `customer_id`, `first_name`, `last_name`, `street`, `block_no`, `floor`, `unit`, `building_name`, `company_name`, `postal_code`, `instruction`) VALUES
(1, 'fengxin@smu.com', 'hou yin', 'chak', 'Serangoon Avenue 4', '218', '11', '182', NULL, NULL, '550218', ''),
(5918, 'issac@smu.com', 'Zhai', 'Haoxian', 'Serangoon Ave 4', '218', '11', '182', '', '', '550218', '');

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
('michael', '123');

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE IF NOT EXISTS `cart` (
  `customer_id` varchar(30) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `color` varchar(7) NOT NULL,
  `quantity` int(5) NOT NULL,
  `create_time` datetime NOT NULL,
  `pay_time` datetime DEFAULT NULL,
  PRIMARY KEY (`customer_id`,`product_id`,`create_time`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `credit_history`
--

CREATE TABLE IF NOT EXISTS `credit_history` (
  `sender_id` varchar(50) NOT NULL,
  `receiver_id` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  PRIMARY KEY (`sender_id`,`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `credit_history`
--

INSERT INTO `credit_history` (`sender_id`, `receiver_id`, `status`) VALUES
('haoxian@smu.com', '253291619@qq.com', 'false'),
('haoxian@smu.com', 'yuzhe@smu.com', 'false'),
('issac@smu.com', 'haoxian@smu.com', 'true'),
('issac@smu.com', 'yuzhe@smu.com', 'false'),
('yuzhe@smu.com', 'fengxin@smu.com', 'false'),
('yuzhe@smu.com', 'issac@smu.com', 'false');

-- --------------------------------------------------------

--
-- Table structure for table `customer`
--

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `alternative_email` varchar(50) NOT NULL,
  `first_name` varchar(30) DEFAULT NULL,
  `last_name` varchar(30) DEFAULT NULL,
  `contact_no` varchar(20) DEFAULT NULL,
  `credit` float DEFAULT NULL,
  `invitation_link` varchar(100) NOT NULL,
  `verified` varchar(5) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `customer`
--

INSERT INTO `customer` (`customer_id`, `password`, `alternative_email`, `first_name`, `last_name`, `contact_no`, `credit`, `invitation_link`, `verified`) VALUES
('253291619@qq.com', '123', '253291619@qq.com', '', '', '', 10, 'invite.php?src=8240969554', 'true'),
('fengxin@smu.com', '123', 'fengxin@smu.com', 'Xin', 'Feng', '12345678', 10, 'invite.php?src=741394559', 'true'),
('haoxian@smu.com', '123', 'haoxian@smu.com', 'haoxian', 'zhai', '90909090', 10, 'invite.php?src=1200027284', 'true'),
('issac@smu.com', '1234', 'issac@smu.com', 'Haoxian', 'Zhai', '123345678', 10, 'invite.php?src=1089392574', 'true'),
('monalisa4518@gmail.com', '123', 'monalisa4518@gmail.com', '', '', '', 0, 'invite.php?src=8823890337', 'true'),
('yuzhe@smu.com', '123', 'yuzhe@smu.com', '', '', '', 20, 'invite.php?src=859344672', 'true');

-- --------------------------------------------------------

--
-- Table structure for table `free_delivery_price`
--

CREATE TABLE IF NOT EXISTS `free_delivery_price` (
  `price` float DEFAULT NULL,
  `delivery_charge` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `free_delivery_price`
--

INSERT INTO `free_delivery_price` (`price`, `delivery_charge`) VALUES
(70, 5);

-- --------------------------------------------------------

--
-- Table structure for table `optional_code`
--

CREATE TABLE IF NOT EXISTS `optional_code` (
  `product_id` varchar(20) NOT NULL,
  `color` varchar(7) NOT NULL,
  `optional_code` varchar(20) NOT NULL,
  PRIMARY KEY (`product_id`,`color`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `optional_code`
--

INSERT INTO `optional_code` (`product_id`, `color`, `optional_code`) VALUES
('AL5120', 'FF2F0F', 'red'),
('AL5120', 'FF5112', 'orange'),
('AL5828', '150DFF', 'BLUE'),
('AL5828', 'FF2212', 'RED'),
('AL9384', '999966', 'DB'),
('AL9384', 'FF0000', 'R');

-- --------------------------------------------------------

--
-- Table structure for table `order`
--

CREATE TABLE IF NOT EXISTS `order` (
  `order_id` varchar(10) NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `color` varchar(7) NOT NULL,
  `quantity` int(5) NOT NULL,
  `price` double NOT NULL,
  `address_no` int(5) NOT NULL,
  `payment_time` datetime NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`order_id`,`customer_id`,`product_id`,`color`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `order`
--

INSERT INTO `order` (`order_id`, `customer_id`, `product_id`, `color`, `quantity`, `price`, `address_no`, `payment_time`, `status`) VALUES
('BHXVES', 'fengxin@smu.com', 'AL9384', '999966', 3, 7.11, 1, '2015-08-20 00:15:48', 'pending'),
('BHXVES', 'fengxin@smu.com', 'AL9384', 'FF0000', 4, 10, 1, '2015-08-20 00:15:48', 'pending');

-- --------------------------------------------------------

--
-- Table structure for table `photo`
--

CREATE TABLE IF NOT EXISTS `photo` (
  `product_id` varchar(20) NOT NULL,
  `photo_type` varchar(20) NOT NULL,
  `photo_url` varchar(300) NOT NULL,
  PRIMARY KEY (`product_id`,`photo_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `photo`
--

INSERT INTO `photo` (`product_id`, `photo_type`, `photo_url`) VALUES
('AL5120', 'FF2F0F', 'public_html/img/detailImg/71266_01_h2016041800550861086detail.jpg'),
('AL5120', 'FF5112', 'public_html/img/detailImg/71266_01_h2016041800550867181detail.jpg'),
('AL5120', 'thumbnail', 'public_html/img/productImg/wuliangye1618_b_main2016041800550899240thumbnail.jpg'),
('AL5828', '150DFF', 'public_html/img/detailImg/22016041800495080115detail.jpg'),
('AL5828', 'FF2212', 'public_html/img/detailImg/22016041800505035624detail.jpg'),
('AL5828', 'thumbnail', 'public_html/img/productImg/12016041800495047959thumbnail.png');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE IF NOT EXISTS `product` (
  `product_id` varchar(20) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `symbol_code` varchar(20) NOT NULL,
  `price` float NOT NULL,
  `color` varchar(60) NOT NULL,
  `description` text NOT NULL,
  `stock` int(11) NOT NULL,
  PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `product`
--

INSERT INTO `product` (`product_id`, `product_name`, `symbol_code`, `price`, `color`, `description`, `stock`) VALUES
('AL5120', 'Wuliangye Test longlonglonglonglonglong name', 'WLY', 200, 'FF5112,FF2F0F', 'Wuliangye is chosen as National Wine', 100),
('AL5828', 'Powercube with outlet', 'PO', 28, '150DFF,FF2212', 'This PowerCube can only be used in combination with the PowerCube Extended or Extended USB, providing five additional outlets. This PowerCube will not fit in the wall socket or other sockets besides the sockets of the PowerCube Extended and Extended USB.<br>', 60);

-- --------------------------------------------------------

--
-- Table structure for table `reward`
--

CREATE TABLE IF NOT EXISTS `reward` (
  `code` varchar(100) NOT NULL,
  `product_name` varchar(50) NOT NULL,
  `worth` double NOT NULL,
  `photo` varchar(300) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reward`
--

INSERT INTO `reward` (`code`, `product_name`, `worth`, `photo`) VALUES
('0TDPDH', 'Nike T-shirt', 39.9, 'http://images3.nike.com/is/image/DotCom/PDP_HERO_S/Nike-BETRUE-Just-Do-It-Mens-T-Shirt-707025_010_C.jpg'),
('0VTZP8', 'powerremote', 10, 'public_html/img/productImg/1.jpg20150815100111746gift.jpg'),
('93UJ2Q', '', 0, ''),
('F555YV', '', 0, ''),
('IVK8BV', '', 0, ''),
('TQ6NO9', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `reward_history`
--

CREATE TABLE IF NOT EXISTS `reward_history` (
  `customer_id` varchar(50) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`customer_id`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `reward_history`
--

INSERT INTO `reward_history` (`customer_id`, `code`) VALUES
('haoxian@smu.com', '0TDPDH');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
