CREATE TABLE IF NOT EXISTS `reward` (
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `reward_history` (
  `customer_id` varchar(50) NOT NULL,
  `code` varchar(100) NOT NULL,
  PRIMARY KEY (`customer_id`,`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;