-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               10.4.32-MariaDB - mariadb.org binary distribution
-- Server OS:                    Win64
-- HeidiSQL Version:             12.6.0.6765
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Dumping database structure for bbcars
CREATE DATABASE IF NOT EXISTS `bbcars` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bbcars`;

-- Dumping structure for table bbcars.kontakt
CREATE TABLE IF NOT EXISTS `kontakt` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `imeprez` varchar(100) DEFAULT NULL,
  `adresa` varchar(100) DEFAULT NULL,
  `fon` varchar(100) DEFAULT NULL,
  `osobe` varchar(100) DEFAULT NULL,
  `auto` varchar(100) DEFAULT NULL,
  `napomena` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bbcars.kontakt: ~0 rows (approximately)
DELETE FROM `kontakt`;

-- Dumping structure for table bbcars.salon
CREATE TABLE IF NOT EXISTS `salon` (
  `salon_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `salon_title` varchar(255) NOT NULL,
  `duzina` varchar(50) DEFAULT NULL,
  `snaga` varchar(50) DEFAULT NULL,
  `potrosnja` varchar(50) DEFAULT NULL,
  `cena` int(11) DEFAULT NULL,
  `recenzija` varchar(5000) DEFAULT NULL,
  PRIMARY KEY (`salon_id`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bbcars.salon: ~3 rows (approximately)
DELETE FROM `salon`;
INSERT INTO `salon` (`salon_id`, `salon_title`, `duzina`, `snaga`, `potrosnja`, `cena`, `recenzija`) VALUES
	(1, 'AUDI A3', '4343', '140', '3,9', 35162, '<iframe width="1280" height="720" src="https://www.youtube.com/embed/fueHz41q26o" title="Audi A3 review - better than a Golf, 1 Series or A-Class?" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'),
	(2, 'AUDI A4', '4762', '110', '6,5', 45137, '<iframe width="1280" height="720" src="https://www.youtube.com/embed/uDAIfOWAwUc" title="Audi A4 2020 in-depth review | carwow Reviews" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>'),
	(3, 'AUDI A6', '4939', '195', '6,8', 57874, '<iframe width="1280" height="720" src="https://www.youtube.com/embed/4K4Is06NRfk" title="Audi A6 2020 in-depth review | carwow Reviews" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>');

-- Dumping structure for table bbcars.users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_level` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bbcars.users: ~1 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `user_level`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
