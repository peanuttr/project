-- MySQL dump 10.13  Distrib 8.0.27, for Win64 (x86_64)
--
-- Host: localhost    Database: assetsmanagement
-- ------------------------------------------------------
-- Server version	8.0.17

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `assets`
--

DROP TABLE IF EXISTS `assets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assets` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assets_number` varchar(255) NOT NULL,
  `asset_name` varchar(255) NOT NULL,
  `detail` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `year_of_budget` varchar(255) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `qr-code` varchar(255) DEFAULT NULL,
  `value_asset` varchar(255) NOT NULL,
  `seller_name` varchar(255) NOT NULL,
  `status` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `number_delivery` varchar(255) NOT NULL,
  `serial_number` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
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
  KEY `fk_money_source_id_idx` (`money_source_id`),
  CONSTRAINT `fk_asset_type_id` FOREIGN KEY (`assets_types_id`) REFERENCES `assets_types` (`id`),
  CONSTRAINT `fk_departments_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`),
  CONSTRAINT `fk_detail_borrow_and_return_id` FOREIGN KEY (`detail_borrow_and_return_id`) REFERENCES `detail_borrow_and_return` (`id`),
  CONSTRAINT `fk_money_source_id` FOREIGN KEY (`money_source_id`) REFERENCES `money_source` (`id`),
  CONSTRAINT `fk_unit_id` FOREIGN KEY (`unit_id`) REFERENCES `unit` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets`
--

LOCK TABLES `assets` WRITE;
/*!40000 ALTER TABLE `assets` DISABLE KEYS */;
INSERT INTO `assets` VALUES (1,'412000010025-30801-00001','ระบบปรับอากาศพร้อมอุปกรณ์ติดตั้ง',' ยี่ห้อ Trane','2551','../../assets/uploads/valorant-(1).jpg','','1.789.000','บริษัท เอช.เค.เนชั่นแนลโปรดัคทส์  จำกัด','ถูกยืม','5106-039','-','2008-06-19','2009-06-18',1,1,1,1,NULL),(2,'723000010004-30801-00001','ม่านปรับแสง ชั้น 2-5  จำนวน 66  ชุด','-','2551','',NULL,'420,000.00','บริษัท วินโด้ แอนด์ เฮ้าส์ จำกัด','อยู่ในคลัง','IN51061580','-','2008-06-27','0000-00-00',2,2,1,1,NULL),(3,'744000010004-30801-00002','เครื่องไมโครคอมพิวเตอร์ประมวลผลทั่วไป (จอ LCD)','ยี่ห้อ Dell Vostro 200','2551','../../assets/uploads/medium03.jpg',NULL,'33,170.00','บริษัท คอมพิวเตอร์ โปรดักส์ ยูไนเต็ด จำกัด','จำหน่าย','CPU5103112','-','2008-03-14','2009-03-13',3,3,1,1,NULL),(4,'744000010004-30801-00003','เครื่องไมโครคอมพิวเตอร์ประมวลผลทั่วไป (จอ LCD)','-','2551','../../assets/uploads/97bf0992bc875e593af4203e21d5bc4b.jpg',NULL,'33,170.00','บริษัท คอมพิวเตอร์ โปรดักส์ ยูไนเต็ด จำกัด','อยู่ในคลัง','CPU5103112','-','2008-03-13','2008-03-12',3,3,1,1,NULL),(5,'744000010004-30801-00004','เครื่องไมโครคอมพิวเตอร์ประมวลผลทั่วไป (จอ LCD)','ยี่ห้อ Dell Vostro 200','2551','../../assets/uploads/97bf0992bc875e593af4203e21d5bc4b.jpg',NULL,'33,170.00','บริษัท คอมพิวเตอร์ โปรดักส์ ยูไนเต็ด จำกัด','อยู่ในคลัง','IN51061580','-','2008-03-14','2008-03-13',3,3,1,1,NULL),(6,'744000010004-30801-00005','เครื่องไมโครคอมพิวเตอร์ประมวลผลทั่วไป (จอ LCD)','ยี่ห้อ Dell Vostro 200','2551','../../assets/uploads/logo kmutnb final.png',NULL,'33,170.00','บริษัท คอมพิวเตอร์ โปรดักส์ ยูไนเต็ด จำกัด','อยู่ในคลัง','CPU5103112','-','2323-02-13','3323-12-31',3,3,4,12,NULL),(7,'744000010004-30801-00006','เครื่องไมโครคอมพิวเตอร์ประมวลผลทั่วไป (จอ LCD)','-','2551','../../assets/uploads/logo kmutnb final.png',NULL,'33,170.00','บริษัท คอมพิวเตอร์ โปรดักส์ ยูไนเต็ด จำกัด','อยู่ในคลัง','CPU5103112','-','2021-11-23','2021-12-04',3,1,1,1,NULL),(8,'744000010004-30801-00007','เครื่องไมโครคอมพิวเตอร์ประมวลผลทั่วไป (จอ LCD)','-','2551','../../assets/uploads/logo kmutnb final.png',NULL,'33,170.00','บริษัท คอมพิวเตอร์ โปรดักส์ ยูไนเต็ด จำกัด','อยู่ในคลัง','CPU5103112','-','2021-11-24','2021-11-24',2,3,1,1,NULL),(9,'744000010004-30801-00008','เครื่องไมโครคอมพิวเตอร์ประมวลผลทั่วไป (จอ LCD)','-','2551','',NULL,'33,170.00','บริษัท คอมพิวเตอร์ โปรดักส์ ยูไนเต็ด จำกัด','อยู่ในคลัง','CPU5103112','-','2021-11-23','2021-11-30',3,3,1,1,NULL);
/*!40000 ALTER TABLE `assets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `assets_types`
--

DROP TABLE IF EXISTS `assets_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `assets_types` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `assets_types_name` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `assets_types`
--

LOCK TABLES `assets_types` WRITE;
/*!40000 ALTER TABLE `assets_types` DISABLE KEYS */;
INSERT INTO `assets_types` VALUES (1,'ครุภัณฑ์ไฟฟ้าและวิทยุ'),(2,'ครุภัณฑ์สำนักงาน'),(3,'ครุภัณฑ์คอมพิวเตอร์'),(4,'ครุภัณฑ์โฆษณาและเผยแพร่'),(5,'ครุภัณฑ์การศึกษา'),(6,'ครุภัณฑ์วิทยาศาสตร์และการแพทย์'),(7,'ครุภัณฑ์งานบ้านงานครัว'),(8,'โปรแกรมคอมพิวเตอร์ (ครุภัณฑ์)'),(9,'ครุภัณฑ์ยานพาหนะและขนส่ง');
/*!40000 ALTER TABLE `assets_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `borrow_and_return`
--

DROP TABLE IF EXISTS `borrow_and_return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `borrow_and_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `borrow_date` date NOT NULL,
  `return_date` date NOT NULL,
  `staff_id` int(11) NOT NULL,
  `personel_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff_id_idx` (`staff_id`),
  KEY `fk_personel_id_idx` (`personel_id`),
  CONSTRAINT `fk_personel_id` FOREIGN KEY (`personel_id`) REFERENCES `personnels` (`id`),
  CONSTRAINT `fk_staffs_id` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrow_and_return`
--

LOCK TABLES `borrow_and_return` WRITE;
/*!40000 ALTER TABLE `borrow_and_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `borrow_and_return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `department` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `department`
--

LOCK TABLES `department` WRITE;
/*!40000 ALTER TABLE `department` DISABLE KEYS */;
INSERT INTO `department` VALUES (1,'สำนักงานคณบดี'),(2,'ภาควิชาเทคโนโลยีอุตสาหกรรมเกษตรและการจัดการ'),(3,'ภาควิชานวัตกรรมและเทคโนโลยีการพัฒนาผลิตภัณฑ์'),(4,'ศูนย์วิจัยอุตสาหกรรมเกษตร');
/*!40000 ALTER TABLE `department` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_borrow_and_return`
--

DROP TABLE IF EXISTS `detail_borrow_and_return`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_borrow_and_return` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) NOT NULL,
  `borrow_and_return_id` int(11) NOT NULL,
  `place_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_borrow_and_return_id_idx` (`borrow_and_return_id`),
  KEY `fk_place_id_idx` (`place_id`),
  KEY `fk_assetsss_id_idx` (`asset_id`),
  CONSTRAINT `fk_assetsss_id` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  CONSTRAINT `fk_borrow_and_return_id` FOREIGN KEY (`borrow_and_return_id`) REFERENCES `borrow_and_return` (`id`),
  CONSTRAINT `fk_place_id` FOREIGN KEY (`place_id`) REFERENCES `place` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_borrow_and_return`
--

LOCK TABLES `detail_borrow_and_return` WRITE;
/*!40000 ALTER TABLE `detail_borrow_and_return` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_borrow_and_return` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `detail_sells`
--

DROP TABLE IF EXISTS `detail_sells`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `detail_sells` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `sell_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_sell_id_idx` (`sell_id`),
  KEY `fk_assetss_id_idx` (`asset_id`),
  CONSTRAINT `fk_assetss_id` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  CONSTRAINT `fk_sell_id` FOREIGN KEY (`sell_id`) REFERENCES `sells` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `detail_sells`
--

LOCK TABLES `detail_sells` WRITE;
/*!40000 ALTER TABLE `detail_sells` DISABLE KEYS */;
/*!40000 ALTER TABLE `detail_sells` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `money_source`
--

DROP TABLE IF EXISTS `money_source`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `money_source` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `money_source_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `money_source`
--

LOCK TABLES `money_source` WRITE;
/*!40000 ALTER TABLE `money_source` DISABLE KEYS */;
INSERT INTO `money_source` VALUES (1,'เงินงบประมาณแผ่นดิน-เงินจัดสรร'),(2,'เงินจัดสรรให้หน่วยงาน'),(3,'เงินอื่นๆ (หน่วยงาน)'),(4,'เงินเหลือจ่าย (หน่วยงาน)'),(5,'เงินเหลือจ่าย-เงินจัดสรรให้หน่วยงาน (หน่วยงาน)'),(6,'เงินจัดสรรโครงการพัฒนาสถาบันฯ'),(7,'เงินจัดสรรพัฒนาวิชาการ 10%'),(8,'เงินอื่นๆ (บริหารส่วนกลาง)'),(9,'เงินเหลือจ่าย - เงินจัดสรรให้บริการส่วนกลาง (บริหารส่วนกลาง)'),(10,'เงินเหลือจ่าย - เงินจัดสรรโครงการพัฒนาสถาบันฯ'),(11,'เงินเหลือจ่าย - เงินรับสมัครนักศึกษาใหม่ (บริหารส่วนกลาง)'),(12,'เงินงบประมาณแผ่นดิน-เงินกันเหลื่อม');
/*!40000 ALTER TABLE `money_source` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personnels`
--

DROP TABLE IF EXISTS `personnels`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personnels` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `personnel_firstname` varchar(255) NOT NULL,
  `personnel_lastname` varchar(255) NOT NULL,
  `telephone_number` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `department_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_department_idx` (`department_id`),
  CONSTRAINT `fk_department` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personnels`
--

LOCK TABLES `personnels` WRITE;
/*!40000 ALTER TABLE `personnels` DISABLE KEYS */;
INSERT INTO `personnels` VALUES (1,'test','ตั้งนะโมละโก้จริงๆ','0970315911','ทำงานอยู่','6106021610081@fitm.kmutnb.ac.th',1),(2,'test','test','0970315911','ทำงานอยู่','6106021610081@fitm.kmutnb.ac.th',1);
/*!40000 ALTER TABLE `personnels` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `place`
--

DROP TABLE IF EXISTS `place`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `place` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `placename` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `place`
--

LOCK TABLES `place` WRITE;
/*!40000 ALTER TABLE `place` DISABLE KEYS */;
/*!40000 ALTER TABLE `place` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `repair_notice`
--

DROP TABLE IF EXISTS `repair_notice`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `repair_notice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail` varchar(255) NOT NULL,
  `image` text NOT NULL,
  `date_notice` date NOT NULL,
  `status` varchar(255) NOT NULL,
  `personel_id` int(11) NOT NULL,
  `asset_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_personels_id_idx` (`personel_id`),
  KEY `fk_assets_id_idx` (`asset_id`),
  CONSTRAINT `fk_assets_id` FOREIGN KEY (`asset_id`) REFERENCES `assets` (`id`),
  CONSTRAINT `fk_personels_id` FOREIGN KEY (`personel_id`) REFERENCES `personnels` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `repair_notice`
--

LOCK TABLES `repair_notice` WRITE;
/*!40000 ALTER TABLE `repair_notice` DISABLE KEYS */;
INSERT INTO `repair_notice` VALUES (1,'test','','2022-03-15','1',1,1),(3,'test','','2022-03-15','1',1,1);
/*!40000 ALTER TABLE `repair_notice` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sells`
--

DROP TABLE IF EXISTS `sells`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `sells` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `selling_date` date NOT NULL,
  `number_of_allow_selling` varchar(255) NOT NULL,
  `staff_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_staff_idx` (`staff_id`),
  CONSTRAINT `fk_staff_id` FOREIGN KEY (`staff_id`) REFERENCES `staffs` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sells`
--

LOCK TABLES `sells` WRITE;
/*!40000 ALTER TABLE `sells` DISABLE KEYS */;
/*!40000 ALTER TABLE `sells` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `staffs`
--

DROP TABLE IF EXISTS `staffs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `staffs` (
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
  KEY `fk_department_id_idx` (`department_id`),
  CONSTRAINT `fk_department_id` FOREIGN KEY (`department_id`) REFERENCES `department` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `staffs`
--

LOCK TABLES `staffs` WRITE;
/*!40000 ALTER TABLE `staffs` DISABLE KEYS */;
INSERT INTO `staffs` VALUES (45,'test','test','test','test','staff','+661231233123','6106021610081@fitm.kmutnb.ac.th',1);
/*!40000 ALTER TABLE `staffs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `unit`
--

DROP TABLE IF EXISTS `unit`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `unit` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `unit_name` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `unit`
--

LOCK TABLES `unit` WRITE;
/*!40000 ALTER TABLE `unit` DISABLE KEYS */;
INSERT INTO `unit` VALUES (1,'ระบบ'),(2,'ผืน'),(3,'เครื่องทดสอบ'),(4,'ชุด'),(5,'ตัว'),(6,'กล้อง'),(7,'ตู้'),(8,'ที่'),(9,'อัน'),(10,'คัน'),(18,'test');
/*!40000 ALTER TABLE `unit` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-03-15 22:59:59
