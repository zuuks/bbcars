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
DROP DATABASE IF EXISTS `bbcars`;
CREATE DATABASE IF NOT EXISTS `bbcars` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;
USE `bbcars`;

-- Dumping structure for table bbcars.kontakt
DROP TABLE IF EXISTS `kontakt`;
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

-- Dumping structure for table bbcars.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(20) NOT NULL,
  `password` varchar(32) NOT NULL,
  `user_level` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bbcars.users: ~2 rows (approximately)
DELETE FROM `users`;
INSERT INTO `users` (`id`, `username`, `password`, `user_level`) VALUES
	(1, 'admin', '21232f297a57a5a743894a0e4a801fc3', 1),
	(16, 'dejan', 'b7bc5176c1ea7208ddf7e8c4994ae47c', 0);

-- Dumping structure for table bbcars.vozila
DROP TABLE IF EXISTS `salon`;
CREATE TABLE IF NOT EXISTS `vozila` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cena` int(11) DEFAULT NULL,
  `marka` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `vrsta_goriva` enum('benzin','dizel','hibrid','elektricni') DEFAULT NULL,
  `godiste` year(4) DEFAULT NULL,
  `predjeni_kilometri` int(11) DEFAULT NULL,
  `kubikaza` int(11) DEFAULT NULL,
  `snaga_motora` int(11) DEFAULT NULL,
  `novo_polovno` enum('novo','polovno') DEFAULT NULL,
  `uvoz_domace` enum('uvoz','domace') DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=124 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Dumping data for table bbcars.vozila: ~99 rows (approximately)
DELETE FROM `vozila`;
INSERT INTO `vozila` (`id`, `cena`, `marka`, `model`, `vrsta_goriva`, `godiste`, `predjeni_kilometri`, `kubikaza`, `snaga_motora`, `novo_polovno`, `uvoz_domace`) VALUES
	(20, 7500, 'Volkswagen', 'Golf 6', 'dizel', '2010', 180000, 1598, 77, 'polovno', 'uvoz'),
	(21, 8500, 'Opel', 'Astra J', 'benzin', '2012', 120000, 1364, 103, 'polovno', 'domace'),
	(22, 11000, 'Audi', 'A3', 'dizel', '2015', 160000, 1968, 110, 'polovno', 'uvoz'),
	(23, 13000, 'BMW', '320d', 'dizel', '2014', 150000, 1995, 135, 'polovno', 'uvoz'),
	(24, 5000, 'Fiat', 'Punto', 'benzin', '2008', 140000, 1242, 51, 'polovno', 'domace'),
	(25, 7800, 'Peugeot', '308', 'dizel', '2011', 170000, 1560, 82, 'polovno', 'uvoz'),
	(26, 8700, 'Skoda', 'Octavia', 'dizel', '2014', 190000, 1968, 105, 'polovno', 'domace'),
	(27, 9000, 'Ford', 'Focus', 'benzin', '2012', 110000, 1596, 92, 'polovno', 'uvoz'),
	(28, 6200, 'Renault', 'Clio 4', 'benzin', '2013', 130000, 1149, 66, 'polovno', 'uvoz'),
	(29, 19000, 'Mercedes', 'C200', 'dizel', '2017', 140000, 1950, 110, 'polovno', 'uvoz'),
	(30, 25000, 'Volkswagen', 'Golf 8', 'benzin', '2023', 0, 1498, 96, 'novo', 'uvoz'),
	(31, 31000, 'Audi', 'A4', 'dizel', '2023', 0, 1968, 140, 'novo', 'uvoz'),
	(32, 22000, 'Toyota', 'Corolla', 'hibrid', '2023', 0, 1798, 85, 'novo', 'uvoz'),
	(33, 27000, 'Hyundai', 'Tucson', 'benzin', '2023', 0, 1591, 110, 'novo', 'domace'),
	(34, 18000, 'Dacia', 'Sandero', 'benzin', '2023', 0, 1332, 74, 'novo', 'domace'),
	(35, 45000, 'Mercedes', 'GLA', 'dizel', '2023', 0, 1950, 120, 'novo', 'uvoz'),
	(36, 23000, 'Kia', 'Sportage', 'benzin', '2023', 0, 1598, 132, 'novo', 'uvoz'),
	(37, 40000, 'BMW', 'X3', 'dizel', '2023', 0, 1995, 135, 'novo', 'uvoz'),
	(38, 30000, 'Skoda', 'Kodiaq', 'dizel', '2023', 0, 1968, 110, 'novo', 'uvoz'),
	(39, 27000, 'Mazda', 'CX-5', 'benzin', '2023', 0, 1998, 141, 'novo', 'uvoz'),
	(40, 8500, 'Honda', 'Civic', 'benzin', '2017', 95000, 1498, 96, 'polovno', 'domace'),
	(41, 4500, 'Dacia', 'Duster', 'dizel', '2010', 200000, 1461, 81, 'polovno', 'uvoz'),
	(42, 14000, 'Subaru', 'Impreza', 'benzin', '2015', 125000, 1995, 110, 'polovno', 'uvoz'),
	(43, 6700, 'Chevrolet', 'Cruze', 'benzin', '2013', 150000, 1598, 91, 'polovno', 'uvoz'),
	(44, 5400, 'Volkswagen', 'Passat B6', 'dizel', '2009', 210000, 1896, 77, 'polovno', 'domace'),
	(45, 7600, 'Ford', 'Fiesta', 'benzin', '2012', 100000, 1242, 60, 'polovno', 'domace'),
	(46, 9700, 'Opel', 'Insignia', 'dizel', '2014', 170000, 1956, 125, 'polovno', 'uvoz'),
	(47, 5900, 'Suzuki', 'Vitara', 'benzin', '2011', 180000, 1586, 82, 'polovno', 'uvoz'),
	(48, 7400, 'Fiat', '500L', 'benzin', '2013', 130000, 1242, 51, 'polovno', 'uvoz'),
	(50, 6300, 'Renault', 'Megane', 'dizel', '2012', 150000, 1461, 66, 'polovno', 'uvoz'),
	(51, 4600, 'Volkswagen', 'Polo', 'benzin', '2009', 180000, 1198, 55, 'polovno', 'domace'),
	(52, 5800, 'Opel', 'Corsa', 'benzin', '2011', 140000, 1229, 63, 'polovno', 'uvoz'),
	(53, 9900, 'Hyundai', 'Elantra', 'benzin', '2014', 130000, 1591, 94, 'polovno', 'uvoz'),
	(54, 11300, 'Peugeot', '3008', 'dizel', '2015', 120000, 1560, 88, 'polovno', 'uvoz'),
	(55, 4300, 'Fiat', 'Grande Punto', 'benzin', '2008', 200000, 1242, 57, 'polovno', 'domace'),
	(56, 7500, 'Nissan', 'Juke', 'benzin', '2013', 110000, 1598, 86, 'polovno', 'domace'),
	(57, 12000, 'Ford', 'Mondeo', 'dizel', '2016', 160000, 1997, 110, 'polovno', 'uvoz'),
	(58, 9600, 'Mazda', '6', 'dizel', '2013', 170000, 2200, 129, 'polovno', 'uvoz'),
	(59, 8900, 'Suzuki', 'Ignis', 'benzin', '2014', 100000, 1242, 66, 'polovno', 'domace'),
	(60, 6700, 'Chevrolet', 'Aveo', 'benzin', '2012', 150000, 1399, 74, 'polovno', 'uvoz'),
	(61, 11200, 'Honda', 'HR-V', 'benzin', '2016', 110000, 1599, 96, 'polovno', 'uvoz'),
	(62, 4500, 'Skoda', 'Fabia', 'benzin', '2010', 180000, 1198, 55, 'polovno', 'domace'),
	(63, 15000, 'Mercedes', 'E200', 'dizel', '2015', 140000, 2143, 120, 'polovno', 'uvoz'),
	(64, 8100, 'BMW', '116i', 'benzin', '2013', 130000, 1598, 100, 'polovno', 'uvoz'),
	(65, 12500, 'Toyota', 'RAV4', 'hibrid', '2017', 95000, 2494, 145, 'polovno', 'uvoz'),
	(66, 9800, 'Renault', 'Kadjar', 'dizel', '2015', 120000, 1461, 81, 'polovno', 'uvoz'),
	(67, 4600, 'Dacia', 'Logan', 'benzin', '2010', 170000, 1149, 55, 'polovno', 'domace'),
	(68, 15000, 'Volkswagen', 'Tiguan', 'dizel', '2016', 140000, 1968, 110, 'polovno', 'uvoz'),
	(69, 5800, 'Fiat', 'Tipo', 'benzin', '2014', 150000, 1368, 70, 'polovno', 'domace'),
	(71, 35000, 'Toyota', 'Camry', 'hibrid', '2023', 0, 2487, 160, 'novo', 'uvoz'),
	(73, 48000, 'Mercedes', 'GLC', 'dizel', '2023', 0, 1950, 145, 'novo', 'uvoz'),
	(74, 28000, 'Kia', 'Niro', 'hibrid', '2023', 0, 1598, 104, 'novo', 'domace'),
	(75, 37000, 'Audi', 'Q3', 'benzin', '2023', 0, 1984, 140, 'novo', 'uvoz'),
	(76, 52000, 'BMW', 'X5', 'dizel', '2023', 0, 2993, 210, 'novo', 'uvoz'),
	(77, 23000, 'Dacia', 'Jogger', 'benzin', '2023', 0, 1333, 96, 'novo', 'domace'),
	(80, 8500, 'Volkswagen', 'Golf 6', 'dizel', '2011', 180000, 1598, 77, 'polovno', 'uvoz'),
	(81, 13000, 'Audi', 'A3', 'dizel', '2015', 160000, 1968, 110, 'polovno', 'uvoz'),
	(82, 9000, 'Ford', 'Focus', 'benzin', '2012', 110000, 1596, 92, 'polovno', 'uvoz'),
	(83, 5000, 'Fiat', 'Punto', 'benzin', '2008', 140000, 1242, 51, 'polovno', 'domace'),
	(84, 19000, 'Mercedes', 'C200', 'dizel', '2017', 140000, 1950, 110, 'polovno', 'uvoz'),
	(85, 25000, 'Volkswagen', 'Golf 8', 'benzin', '2023', 0, 1498, 96, 'novo', 'uvoz'),
	(86, 45000, 'Mercedes', 'GLA', 'dizel', '2023', 0, 1950, 120, 'novo', 'uvoz'),
	(87, 9800, 'Renault', 'Kadjar', 'dizel', '2015', 120000, 1461, 81, 'polovno', 'uvoz'),
	(88, 5800, 'Fiat', 'Tipo', 'benzin', '2014', 150000, 1368, 70, 'polovno', 'domace'),
	(89, 48000, 'Mercedes', 'GLC', 'dizel', '2023', 0, 1950, 145, 'novo', 'uvoz'),
	(90, 8700, 'Mazda', '3', 'benzin', '2012', 125000, 1598, 85, 'polovno', 'uvoz'),
	(91, 31000, 'Toyota', 'Prius', 'hibrid', '2023', 0, 1798, 90, 'novo', 'uvoz'),
	(92, 9500, 'Hyundai', 'i30', 'benzin', '2014', 110000, 1591, 92, 'polovno', 'domace'),
	(93, 39000, 'Kia', 'EV6', 'elektricni', '2023', 0, NULL, 200, 'novo', 'uvoz'),
	(94, 11200, 'Honda', 'CR-V', 'benzin', '2017', 90000, 1997, 120, 'polovno', 'uvoz'),
	(95, 7000, 'Chevrolet', 'Spark', 'benzin', '2013', 95000, 1206, 59, 'polovno', 'domace'),
	(96, 21000, 'Skoda', 'Superb', 'dizel', '2020', 60000, 1968, 140, 'polovno', 'uvoz'),
	(97, 4500, 'Dacia', 'Sandero', 'benzin', '2009', 160000, 1149, 55, 'polovno', 'domace'),
	(98, 34000, 'Tesla', 'Model 3', 'elektricni', '2023', 0, NULL, 211, 'novo', 'uvoz'),
	(99, 10000, 'Suzuki', 'Vitara', 'benzin', '2016', 120000, 1586, 88, 'polovno', 'uvoz'),
	(100, 5800, 'Opel', 'Corsa', 'benzin', '2011', 140000, 1229, 63, 'polovno', 'uvoz'),
	(101, 8700, 'Skoda', 'Octavia', 'dizel', '2014', 190000, 1968, 105, 'polovno', 'domace'),
	(102, 9900, 'Hyundai', 'Elantra', 'benzin', '2014', 130000, 1591, 94, 'polovno', 'uvoz'),
	(103, 11200, 'Honda', 'HR-V', 'benzin', '2016', 110000, 1599, 96, 'polovno', 'uvoz'),
	(104, 4300, 'Fiat', 'Grande Punto', 'benzin', '2008', 200000, 1242, 57, 'polovno', 'domace'),
	(105, 32000, 'Toyota', 'Corolla', 'hibrid', '2023', 0, 1798, 85, 'novo', 'uvoz'),
	(106, 9600, 'Mazda', '6', 'dizel', '2013', 170000, 2200, 129, 'polovno', 'uvoz'),
	(107, 21000, 'BMW', '320i', 'benzin', '2020', 80000, 1998, 135, 'polovno', 'uvoz'),
	(108, 37000, 'Audi', 'Q5', 'dizel', '2023', 0, 1968, 150, 'novo', 'uvoz'),
	(109, 13500, 'Volkswagen', 'Golf 7', 'benzin', '2016', 120000, 1598, 92, 'polovno', 'uvoz'),
	(110, 12000, 'Audi', 'A4', 'dizel', '2015', 150000, 1968, 105, 'polovno', 'uvoz'),
	(111, 8000, 'Opel', 'Insignia', 'dizel', '2013', 140000, 1956, 88, 'polovno', 'domace'),
	(112, 11000, 'Ford', 'Mondeo', 'benzin', '2015', 120000, 1596, 95, 'polovno', 'uvoz'),
	(113, 9500, 'Renault', 'Laguna', 'dizel', '2012', 160000, 1995, 100, 'polovno', 'domace'),
	(114, 20000, 'BMW', '520d', 'dizel', '2018', 100000, 1995, 140, 'polovno', 'uvoz'),
	(115, 16000, 'Mercedes', 'E-Class', 'benzin', '2017', 90000, 1991, 120, 'polovno', 'domace'),
	(116, 12500, 'Skoda', 'Octavia', 'benzin', '2016', 110000, 1395, 85, 'polovno', 'uvoz'),
	(117, 10500, 'Mazda', 'CX-5', 'dizel', '2014', 130000, 2191, 130, 'polovno', 'domace'),
	(118, 14000, 'Volkswagen', 'Passat', 'dizel', '2016', 100000, 1968, 120, 'polovno', 'uvoz'),
	(119, 11500, 'Peugeot', '508', 'benzin', '2015', 110000, 1598, 90, 'polovno', 'domace'),
	(120, 17000, 'Audi', 'Q7', 'dizel', '2016', 110000, 2967, 180, 'polovno', 'uvoz'),
	(121, 13000, 'BMW', 'X5', 'dizel', '2016', 120000, 2993, 160, 'polovno', 'domace'),
	(122, 11000, 'Ford', 'Kuga', 'benzin', '2014', 100000, 1999, 120, 'polovno', 'uvoz'),
	(123, 13000, 'Mazda', '6', 'benzin', '2017', 90000, 1998, 120, 'polovno', 'domace');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;