CREATE DATABASE IF NOT EXISTS allocacoc;
USE allocacoc;

CREATE TABLE IF NOT EXISTS `admin` (
  `username` varchar(30) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `admin` (`username`, `password`) VALUES
('michael', '123');

CREATE TABLE IF NOT EXISTS `customer` (
  `customer_id` varchar(50) NOT NULL,
  `password` varchar(30) NOT NULL,
  `alternative_email` varchar(50) NOT NULL,
  `first_name` varchar(30),
  `last_name` varchar(30),
  `contact_no` varchar(20) DEFAULT NULL,
  `credit` float,
  `invitation_link` varchar(100) NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


CREATE TABLE IF NOT EXISTS `address` (
  `address_no` int(5) NOT NULL,
  `customer_id` varchar(30) NOT NULL,
  `first_name` varchar(30) NOT NULL,
  `last_name` varchar(30) NOT NULL,
  `street` varchar(50) NOT NULL,
  `block_no` varchar(30) NOT NULL,
  `floor` varchar(10) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `building_name` varchar(30),
  `company_name` varchar(30),
  `postal_code` varchar(6) NOT NULL,
  `instruction` varchar(256) NOT NULL,
  PRIMARY KEY (`address_no`,`customer_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `product` (
 `product_id` varchar(20) NOT NULL,
 `product_name` varchar(50) NOT NULL,
 `price` float NOT NULL,
 `color` varchar(20) NOT NULL,
 `description` text NOT NULL,
 `stock` int NOT NULL,
 PRIMARY KEY (`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `order` (
  `customer_id` varchar(30) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `cart` (
  `customer_id` varchar(30) NOT NULL,
  `product_id` varchar(20) NOT NULL,
  `quantity` int(5) NOT NULL,
  PRIMARY KEY (`customer_id`,`product_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `photo` (
  `product_id` varchar(20) NOT NULL,
  `photo_type` varchar(20) NOT NULL,
  `photo_url` varchar(300) NOT NULL,
  PRIMARY KEY (`product_id`,`photo_type`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `free_delivery_price` (
`price` float
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `credit_history` (
  `sender_id` varchar(50) NOT NULL,
  `receiver_id` varchar(50) NOT NULL,
  `status` varchar(5) NOT NULL,
  PRIMARY KEY (`sender_id`,`receiver_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;