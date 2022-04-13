-- phpMyAdmin SQL Dump
-- version 5.1.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 13, 2022 at 02:30 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `assetsmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
CREATE TABLE IF NOT EXISTS `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assets_number` varchar(255) NOT NULL,
  `asset_name` varchar(255) NOT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `year_of_budget` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `qr-code` varchar(255) DEFAULT NULL,
  `value_asset` varchar(255) NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `status` varchar(255) DEFAULT NULL,
  `number_delivery` varchar(255) NOT NULL,
  `serial_number` varchar(255) DEFAULT NULL,
  `date_admit` date NOT NULL,
  `expiration_date` date NOT NULL,
  `assets_types_id` int(11) NOT NULL,
  `unit_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `money_source_id` int(11) NOT NULL,
  `detail_borrow_and_return_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_detail_borrow_and_return_id_idx` (`detail_borrow_and_return_id`),
  KEY `fk_department_id_idx` (`department_id`),
  KEY `fk_unit_id_idx` (`unit_id`),
  KEY `fk_asset_type_id_idx` (`assets_types_id`),
  KEY `fk_money_source_id_idx` (`money_source_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `assets_types`
--

DROP TABLE IF EXISTS `assets_types`;
CREATE TABLE IF NOT EXISTS `assets_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assets_types_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `borrow_and_return`
--

DROP TABLE IF EXISTS `borrow_and_return`;
CREATE TABLE IF NOT EXISTS `borrow_and_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `personel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff_id_idx` (`staff_id`),
  KEY `fk_personel_id_idx` (`personel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_borrow_and_return`
--

DROP TABLE IF EXISTS `detail_borrow_and_return`;
CREATE TABLE IF NOT EXISTS `detail_borrow_and_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) NOT NULL,
  `borrow_and_return_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_borrow_and_return_id_idx` (`borrow_and_return_id`),
  KEY `fk_place_id_idx` (`place_id`),
  KEY `fk_assetsss_id_idx` (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `detail_repair_notice`
--

DROP TABLE IF EXISTS `detail_repair_notice`;
CREATE TABLE IF NOT EXISTS `detail_repair_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `asset_id` int(11) NOT NULL,
  `repair_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_repair_id` (`repair_id`),
  KEY `fk_asset_id` (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `detail_sells`
--

DROP TABLE IF EXISTS `detail_sells`;
CREATE TABLE IF NOT EXISTS `detail_sells` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sell_id_idx` (`sell_id`),
  KEY `fk_assetss_id_idx` (`asset_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `money_source`
--

DROP TABLE IF EXISTS `money_source`;
CREATE TABLE IF NOT EXISTS `money_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money_source_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
CREATE TABLE IF NOT EXISTS `personnels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personnel_firstname` varchar(255) NOT NULL,
  `personnel_lastname` varchar(255) NOT NULL,
  `telephone_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_department_idx` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
CREATE TABLE IF NOT EXISTS `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `repair_notice`
--

DROP TABLE IF EXISTS `repair_notice`;
CREATE TABLE IF NOT EXISTS `repair_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `image` text NOT NULL,
  `date_notice` date NOT NULL,
  `status` char(1) NOT NULL,
  `detail` varchar(255) NOT NULL,
  `personel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personels_id_idx` (`personel_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sells`
--

DROP TABLE IF EXISTS `sells`;
CREATE TABLE IF NOT EXISTS `sells` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selling_date` date NOT NULL,
  `number_of_allow_selling` varchar(255) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff_idx` (`staff_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
CREATE TABLE IF NOT EXISTS `staffs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `staff_firstname` varchar(255) NOT NULL,
  `staff_lastname` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_department_id_idx` (`department_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
CREATE TABLE IF NOT EXISTS `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assets`
--
ALTER TABLE `assets`
  ADD CONSTRAINT `fk_asset_type_id` FOREIGN KEY (`assets_types_id`) REFERENCES `assets_types` (`id`),
  ADD CONSTRAINT `fk_departments_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  ADD CONSTRAINT `fk_detail_borrow_and_return_id` FOREIGN KEY (`detail_borrow_and_return_id`) REFERENCES `detail_borrow_and_return` (`id`),
  ADD CONSTRAINT `fk_money_source_id` FOREIGN KEY (`money_source_id`) REFERENCES `money_source` (`id`),
  ADD CONSTRAINT `fk_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`);

--
-- Constraints for table `borrow_and_return`
--
ALTER TABLE `borrow_and_return`
  ADD CONSTRAINT `fk_personel_id` FOREIGN KEY (`personel_id`) REFERENCES `personnels` (`id`),
  ADD CONSTRAINT `fk_staffs_id` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);

--
-- Constraints for table `detail_borrow_and_return`
--
ALTER TABLE `detail_borrow_and_return`
  ADD CONSTRAINT `fk_assetsss_id` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  ADD CONSTRAINT `fk_borrow_and_return_id` FOREIGN KEY (`borrow_and_return_id`) REFERENCES `borrow_and_return` (`id`),
  ADD CONSTRAINT `fk_place_id` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`);

--
-- Constraints for table `detail_repair_notice`
--
ALTER TABLE `detail_repair_notice`
  ADD CONSTRAINT `fk_asset_id` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_repair_id` FOREIGN KEY (`repair_id`) REFERENCES `repair_notice` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `detail_sells`
--
ALTER TABLE `detail_sells`
  ADD CONSTRAINT `fk_assetss_id` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  ADD CONSTRAINT `fk_sell_id` FOREIGN KEY (`sell_id`) REFERENCES `sells` (`id`);

--
-- Constraints for table `personnels`
--
ALTER TABLE `personnels`
  ADD CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);

--
-- Constraints for table `repair_notice`
--
ALTER TABLE `repair_notice`
  ADD CONSTRAINT `fk_personels_id` FOREIGN KEY (`personel_id`) REFERENCES `personnels` (`id`);

--
-- Constraints for table `sells`
--
ALTER TABLE `sells`
  ADD CONSTRAINT `fk_staff_id` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`);

--
-- Constraints for table `staffs`
--
ALTER TABLE `staffs`
  ADD CONSTRAINT `fk_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
