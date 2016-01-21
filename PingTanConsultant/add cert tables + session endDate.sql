SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pingtan_db`
--

CREATE TABLE IF NOT EXISTS `studentCertificate` (
  `studentID` varchar(20) NOT NULL,
  `courseID` varchar(20) NOT NULL,
  `name` varchar(50) NOT NULL,
  `sessionID` varchar(20) NOT NULL,
  `path` text NOT NULL, --上传给每个学生的证书
  PRIMARY KEY (`studentID`,`courseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8; 
ALTER TABLE `session_en` ADD `endDate` date AFTER `startDate`;
UPDATE `session_en` SET `endDate` = '2016-2-28';
ALTER TABLE `session_cn` ADD `endDate` date AFTER `startDate`;
