-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               8.0.30 - MySQL Community Server - GPL
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


-- Dumping database structure for online_shop
CREATE DATABASE IF NOT EXISTS `online_shop` /*!40100 DEFAULT CHARACTER SET utf8mb3 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `online_shop`;

-- Dumping structure for table online_shop.admin
CREATE TABLE IF NOT EXISTS `admin` (
  `fname` varchar(45) DEFAULT NULL,
  `lname` varchar(45) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `vcode` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.admin: ~1 rows (approximately)
INSERT INTO `admin` (`fname`, `lname`, `email`, `vcode`) VALUES
	('Sanithu', 'ruwanpathirana', 'sanithuruwanpathirana0@gmail.com', '66b6ccbf16ae7');

-- Dumping structure for table online_shop.brand
CREATE TABLE IF NOT EXISTS `brand` (
  `brand_id` int NOT NULL AUTO_INCREMENT,
  `brand_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`brand_id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.brand: ~7 rows (approximately)
INSERT INTO `brand` (`brand_id`, `brand_name`) VALUES
	(1, 'Apple'),
	(2, 'Samsung'),
	(3, 'ASUS'),
	(4, 'MSI'),
	(5, 'DJI'),
	(6, 'Crocadile'),
	(7, 'Dhamro');

-- Dumping structure for table online_shop.cart
CREATE TABLE IF NOT EXISTS `cart` (
  `cart_id` int NOT NULL AUTO_INCREMENT,
  `qty` int DEFAULT NULL,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`cart_id`),
  KEY `fk_cart_user1_idx` (`user_email`),
  KEY `fk_cart_product1_idx` (`product_id`),
  CONSTRAINT `fk_cart_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_cart_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.cart: ~7 rows (approximately)
INSERT INTO `cart` (`cart_id`, `qty`, `user_email`, `product_id`) VALUES
	(26, 3, 'sanithuruwanpathirana@gmail.com', 4),
	(27, 1, 'sanithuruwanpathirana@gmail.com', 16),
	(28, 1, 'sanithuruwanpathirana0@gmail.com', 18),
	(29, 1, 'sanithuruwanpathirana0@gmail.com', 4),
	(30, 2, 'sanithuruwanpathirana@gmail.com', 6),
	(32, 3, 'sanithuruwanpathirana@gmail.com', 20),
	(45, 2, 'sanithuruwanpathirana@gmail.com', 8);

-- Dumping structure for table online_shop.category
CREATE TABLE IF NOT EXISTS `category` (
  `cat_id` int NOT NULL AUTO_INCREMENT,
  `cat_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`cat_id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.category: ~6 rows (approximately)
INSERT INTO `category` (`cat_id`, `cat_name`) VALUES
	(1, 'Mobiles'),
	(2, 'Laptops'),
	(3, 'Drones'),
	(5, 'fashion'),
	(8, 'Furniture'),
	(9, 'Computers');

-- Dumping structure for table online_shop.category_has_brand
CREATE TABLE IF NOT EXISTS `category_has_brand` (
  `category_cat_id` int NOT NULL,
  `brand_brand_id` int NOT NULL,
  KEY `fk_category_has_brand_brand1_idx` (`brand_brand_id`),
  KEY `fk_category_has_brand_category1_idx` (`category_cat_id`),
  CONSTRAINT `fk_category_has_brand_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_category_has_brand_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.category_has_brand: ~7 rows (approximately)
INSERT INTO `category_has_brand` (`category_cat_id`, `brand_brand_id`) VALUES
	(1, 1),
	(1, 2),
	(2, 3),
	(2, 4),
	(3, 5),
	(5, 6),
	(9, 3);

-- Dumping structure for table online_shop.city
CREATE TABLE IF NOT EXISTS `city` (
  `city_id` int NOT NULL AUTO_INCREMENT,
  `city_name` varchar(45) DEFAULT NULL,
  `district_district_id` int NOT NULL,
  PRIMARY KEY (`city_id`),
  KEY `fk_city_district1_idx` (`district_district_id`),
  CONSTRAINT `fk_city_district1` FOREIGN KEY (`district_district_id`) REFERENCES `district` (`district_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.city: ~2 rows (approximately)
INSERT INTO `city` (`city_id`, `city_name`, `district_district_id`) VALUES
	(1, 'Dikwella', 2),
	(2, 'Piliyandala', 1);

-- Dumping structure for table online_shop.color
CREATE TABLE IF NOT EXISTS `color` (
  `clr_id` int NOT NULL AUTO_INCREMENT,
  `clr_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`clr_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.color: ~4 rows (approximately)
INSERT INTO `color` (`clr_id`, `clr_name`) VALUES
	(1, 'Black'),
	(2, 'Blue'),
	(3, 'White'),
	(4, 'Pink');

-- Dumping structure for table online_shop.condition
CREATE TABLE IF NOT EXISTS `condition` (
  `condition_id` int NOT NULL AUTO_INCREMENT,
  `condition_name` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`condition_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.condition: ~2 rows (approximately)
INSERT INTO `condition` (`condition_id`, `condition_name`) VALUES
	(1, 'Brand New'),
	(2, 'Used');

-- Dumping structure for table online_shop.district
CREATE TABLE IF NOT EXISTS `district` (
  `district_id` int NOT NULL AUTO_INCREMENT,
  `district_name` varchar(45) DEFAULT NULL,
  `province_province_id` int NOT NULL,
  PRIMARY KEY (`district_id`),
  KEY `fk_district_province1_idx` (`province_province_id`),
  CONSTRAINT `fk_district_province1` FOREIGN KEY (`province_province_id`) REFERENCES `province` (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.district: ~2 rows (approximately)
INSERT INTO `district` (`district_id`, `district_name`, `province_province_id`) VALUES
	(1, 'Colombo', 1),
	(2, 'Mathara', 2);

-- Dumping structure for table online_shop.feedback
CREATE TABLE IF NOT EXISTS `feedback` (
  `feed_id` int NOT NULL AUTO_INCREMENT,
  `type` int DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `feed` varchar(250) DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`feed_id`),
  KEY `fk_feedback_product1_idx` (`product_id`),
  KEY `fk_feedback_user1_idx` (`user_email`),
  CONSTRAINT `fk_feedback_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_feedback_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.feedback: ~8 rows (approximately)
INSERT INTO `feedback` (`feed_id`, `type`, `date`, `feed`, `product_id`, `user_email`) VALUES
	(1, 1, '2024-01-25 22:11:09', 'good product', 7, 'sanithuruwanpathirana@gmail.com'),
	(2, 2, '2024-01-25 23:12:26', 'Amazing Product', 7, 'sanithuruwanpathirana@gmail.com'),
	(3, 2, '2024-07-19 23:40:12', 'beautiful', 4, 'sanithuruwanpathirana@gmail.com'),
	(4, 2, '2024-07-19 23:45:01', 'perfect', 4, 'sanithuruwanpathirana@gmail.com'),
	(5, 2, '2024-07-19 23:48:20', 'awsome', 4, 'sanithuruwanpathirana@gmail.com'),
	(6, 2, '2024-07-19 23:48:24', 'weldone', 4, 'sanithuruwanpathirana@gmail.com'),
	(7, 1, '2024-08-08 21:23:00', 'Good Product', 4, 'sanithuruwanpathirana@gmail.com'),
	(8, 1, '2024-08-08 21:24:45', 'Good Quality', 10, 'sanithuruwanpathirana@gmail.com');

-- Dumping structure for table online_shop.gender
CREATE TABLE IF NOT EXISTS `gender` (
  `gender_id` int NOT NULL AUTO_INCREMENT,
  `gender_name` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`gender_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.gender: ~2 rows (approximately)
INSERT INTO `gender` (`gender_id`, `gender_name`) VALUES
	(1, 'Male'),
	(2, 'Female');

-- Dumping structure for table online_shop.invoice
CREATE TABLE IF NOT EXISTS `invoice` (
  `invoice_id` int NOT NULL AUTO_INCREMENT,
  `order_id` varchar(20) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `total` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `status` int DEFAULT NULL,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`invoice_id`),
  KEY `fk_invoice_product1_idx` (`product_id`),
  KEY `fk_invoice_user1_idx` (`user_email`),
  CONSTRAINT `fk_invoice_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_invoice_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.invoice: ~7 rows (approximately)
INSERT INTO `invoice` (`invoice_id`, `order_id`, `date`, `total`, `qty`, `status`, `product_id`, `user_email`) VALUES
	(10, '66b4ea0f0c930', '2024-08-08 21:24:21', 2300, 1, 0, 10, 'sanithuruwanpathirana@gmail.com'),
	(11, 'hfghfghfghf', '2024-05-08 22:46:07', 6000, 5, 0, 8, 'sanithuruwanpathirana@gmail.com'),
	(12, '66b6233b46e42', '2024-08-09 19:40:33', 5500, 1, 0, 4, 'sanithuruwanpathirana0@gmail.com'),
	(13, '66b62876eb737', '2024-08-09 20:03:00', 2300, 1, 0, 10, 'sanithuruwanpathirana0@gmail.com'),
	(14, '66b6498b58601', '2024-08-09 22:24:05', 19000, 1, 0, 6, 'sanithuruwanpathirana@gmail.com'),
	(15, '66b64e6f98474', '2024-08-09 22:44:58', 19000, 1, 0, 6, 'sanithuruwanpathirana@gmail.com'),
	(16, '66b67bde86b13', '2024-08-10 01:59:37', 5500, 1, 0, 4, 'sanithuruwanpathirana@gmail.com');

-- Dumping structure for table online_shop.model
CREATE TABLE IF NOT EXISTS `model` (
  `model_id` int NOT NULL AUTO_INCREMENT,
  `model_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.model: ~13 rows (approximately)
INSERT INTO `model` (`model_id`, `model_name`) VALUES
	(1, 'iPhone 11'),
	(2, 'iPhone 8'),
	(3, 'iPhone 12'),
	(4, 'iPhone 13'),
	(5, 'iPhone x'),
	(6, 'MSI Katana'),
	(7, 'ASUS TUF'),
	(8, 'DJI Mavic 3 Pro'),
	(9, 'DJI Phantom 4 Pro'),
	(10, 'Galaxy Z Fold'),
	(11, 'Touser'),
	(12, 'Sofa'),
	(13, 'Cupboard');

-- Dumping structure for table online_shop.model_has_brand
CREATE TABLE IF NOT EXISTS `model_has_brand` (
  `model_model_id` int NOT NULL,
  `brand_brand_id` int NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`),
  KEY `fk_model_has_brand_brand1_idx` (`brand_brand_id`),
  KEY `fk_model_has_brand_model1_idx` (`model_model_id`),
  CONSTRAINT `fk_model_has_brand_brand1` FOREIGN KEY (`brand_brand_id`) REFERENCES `brand` (`brand_id`),
  CONSTRAINT `fk_model_has_brand_model1` FOREIGN KEY (`model_model_id`) REFERENCES `model` (`model_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.model_has_brand: ~12 rows (approximately)
INSERT INTO `model_has_brand` (`model_model_id`, `brand_brand_id`, `id`) VALUES
	(1, 1, 1),
	(2, 1, 2),
	(5, 1, 3),
	(6, 4, 6),
	(7, 3, 7),
	(8, 5, 8),
	(10, 2, 9),
	(9, 5, 10),
	(11, 6, 11),
	(7, 3, 12),
	(12, 7, 13),
	(13, 7, 14);

-- Dumping structure for table online_shop.product
CREATE TABLE IF NOT EXISTS `product` (
  `id` int NOT NULL AUTO_INCREMENT,
  `price` double DEFAULT NULL,
  `qty` int DEFAULT NULL,
  `description` text,
  `title` varchar(100) DEFAULT NULL,
  `datetime_added` datetime DEFAULT NULL,
  `delivery_fee_colombo` double DEFAULT NULL,
  `delivery_fee_other` double DEFAULT NULL,
  `category_cat_id` int NOT NULL,
  `model_has_brand_id` int NOT NULL,
  `condition_condition_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  `warrenty` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_product_category1_idx` (`category_cat_id`),
  KEY `fk_product_model_has_brand1_idx` (`model_has_brand_id`),
  KEY `fk_product_condition1_idx` (`condition_condition_id`),
  KEY `fk_product_status1_idx` (`status_status_id`),
  KEY `fk_product_user1_idx` (`user_email`),
  CONSTRAINT `fk_product_category1` FOREIGN KEY (`category_cat_id`) REFERENCES `category` (`cat_id`),
  CONSTRAINT `fk_product_condition1` FOREIGN KEY (`condition_condition_id`) REFERENCES `condition` (`condition_id`),
  CONSTRAINT `fk_product_model_has_brand1` FOREIGN KEY (`model_has_brand_id`) REFERENCES `model_has_brand` (`id`),
  CONSTRAINT `fk_product_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`),
  CONSTRAINT `fk_product_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.product: ~14 rows (approximately)
INSERT INTO `product` (`id`, `price`, `qty`, `description`, `title`, `datetime_added`, `delivery_fee_colombo`, `delivery_fee_other`, `category_cat_id`, `model_has_brand_id`, `condition_condition_id`, `status_status_id`, `user_email`, `warrenty`) VALUES
	(1, 10000, 18, 'Condition Used\r\nSeller Notes    These phones are in Fair cosmetic condition and could show some cosmetic imperfections on housing ... Read moreabout the seller notes\r\nBrand   Apple\r\nModel   Iphone 11\r\nStorage Capacity   64GB\r\nColor    Black / white / Red / Green / Yellow / Purpule\r\nNetwork     Unlocked, Verizon, AT&T, T-Mobile, TMobile, Cricket, Boost, Sprint\r\nCamera Resolution    12.0 MP\r\nMPN   NA\r\nConnectivity    LTE, 2G, 3G, 4G, 5G, WI-FI, NFC, GPS, Bluetooth\r\nOperating System   iOS\r\nSIM Card Slot    Single SIM\r\nLock Status   Factory Unlocked\r\nContract   Without Contract\r\nRAM   2 GB\r\nFeatures   Speakerphone, Accelerometer, Camera, Front Camera, 3D Depth Camera, Bluetooth Enabled, Digital Compass, Fingerprint Sensor, GPS, MMS (Multimedia Messaging), Motion & Gesture Control, OLED Display, Pressure Sensor, Retina Display, Streaming Video, Wi-Fi Capable', 'iPhone 11', '2024-01-21 01:11:25', 1000, 1500, 1, 1, 1, 1, 'sanithuruwanpathirana@gmail.com', '5 Mounths'),
	(2, 6000, 10, '', 'iPhone 8', '2024-01-21 02:08:02', 1500, 2000, 1, 2, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(4, 4000, 35, '', 'iPhone x', '2024-01-22 11:32:43', 1000, 1500, 1, 3, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(5, 4000, 18, '', 'MSI Katana Gaming Laptop', '2024-01-22 11:42:19', 5000, 6000, 2, 6, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(6, 7000, 10, '', 'ASUS TUF Gaming Laptop', '2024-01-22 11:44:39', 10000, 12000, 2, 7, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(7, 3000, 4, '', 'DJI Mavic 3Pro', '2024-01-22 12:03:17', 2000, 3000, 3, 8, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(8, 25000, 2, '', 'Samsung Galaxy Z Fold', '2024-01-22 14:00:16', 10000, 11000, 1, 9, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(9, 20000, 55, '', 'DJI Phantom 4 Pro', '2024-01-22 15:56:58', 12000, 15000, 3, 10, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(10, 2000, 27, 'Metarial :  Silk / Cotton', 'Crocadile Trouser', '2024-07-18 23:08:04', 100, 300, 5, 11, 1, 1, 'sanithuruwanpathirana0@gmail.com', '2 Mounths'),
	(11, 150000, 25, 'Processor i5 13th gen\r\nRam 16 Gb\r\nRTX 4090 8Gb Graphic Card\r\nROG Thor 1000W Power Supply', 'I5 Gaming Computer', '2024-07-19 22:45:24', 5000, 6000, 9, 12, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(15, 1000, 16, '\r\nType	Conventional\r\nUpholstery	Fabric\r\nMaterial	Solid Wood, Fabric, Foam\r\nSofa Frame Material	Solid Wood\r\nSofa Legs Material	Solid Wood\r\nFinish	Fabric Cotton\r\nSeater Combination	3+1+1\r\nDesign	Modern Classic\r\nTechnology / Conversion	Ready To Use\r\nSeats Up To	5\r\nIdeal/Suitable For	Living Room\r\nComfort Level	Plush\r\nSet Includes	3 Pieces\r\nCare Instrcutions	Professional Dry Cleaning In Dry-Cleaning Fluids (Tetrachloroethene And Hydrocarbons) Normal Process, Do Not Wash, Bleach, Tumble, Dry, Iron\r\nCountry Of Origin	Sri Lanka\r\nDimensions	3 Seater L-203cm, W-81cm, H-71cm | 1 Seater L-81cm, W-81cm, H-71cm\r\nColors	Beige & Blue Colour', 'Dhamro Sofa', '2024-08-01 17:12:30', 100, 500, 8, 13, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(16, 2000, 10, 'Dimensions\r\nLength – 196cm | Width – 37cm | Height – 199cm\r\nWarranty\r\n3 year comprehensive Warranty\r\nWarranty Covers Only Manufacturing Defect', 'Executive Cupboard', '2024-08-02 12:55:46', 150, 300, 8, 14, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(18, 2000, 20, 'Metarial :  Silk / Cotton', 'Crocadile Trouser', '2024-08-08 21:35:15', 100, 150, 5, 11, 1, 1, 'sanithuruwanpathirana@gmail.com', '2 Mounths'),
	(20, 6000, 5, 'wood\r\nmatel', 'Pantry CupBoard', '2024-08-09 22:17:01', 100, 200, 8, 14, 1, 1, 'sanithuruwanpathirana0@gmail.com', '1 year');

-- Dumping structure for table online_shop.product_has_color
CREATE TABLE IF NOT EXISTS `product_has_color` (
  `product_id` int NOT NULL,
  `color_clr_id` int NOT NULL,
  KEY `fk_product_has_color_color1_idx` (`color_clr_id`),
  KEY `fk_product_has_color_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_has_color_color1` FOREIGN KEY (`color_clr_id`) REFERENCES `color` (`clr_id`),
  CONSTRAINT `fk_product_has_color_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.product_has_color: ~13 rows (approximately)
INSERT INTO `product_has_color` (`product_id`, `color_clr_id`) VALUES
	(2, 1),
	(1, 3),
	(4, 4),
	(5, 1),
	(6, 2),
	(7, 3),
	(8, 2),
	(11, 1),
	(10, 3),
	(15, 1),
	(16, 3),
	(18, 3),
	(20, 2);

-- Dumping structure for table online_shop.product_img
CREATE TABLE IF NOT EXISTS `product_img` (
  `img_path` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`img_path`),
  KEY `fk_product_img_product1_idx` (`product_id`),
  CONSTRAINT `fk_product_img_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.product_img: ~31 rows (approximately)
INSERT INTO `product_img` (`img_path`, `product_id`) VALUES
	('resource//mobile_images//iPhone 11_0_65adf812ed090.jpeg', 1),
	('resource//mobile_images//iPhone 8_0_65ae02ba40287.jpeg', 2),
	('resource//mobile_images//iPhone 8_1_65ae02ba40e80.jpeg', 2),
	('resource//mobile_images//iPhone 8_2_65ae02ba4173c.jpeg', 2),
	('resource//mobile_images//iPhone x_0_65ae0503987e7.jpeg', 4),
	('resource//mobile_images//MSI Katana Gaming Laptop_0_65ae0743e9e24.jpeg', 5),
	('resource//mobile_images//MSI Katana Gaming Laptop_1_65ae0743ea548.jpeg', 5),
	('resource//mobile_images//MSI Katana Gaming Laptop_2_65ae0743eac4b.jpeg', 5),
	('resource//mobile_images//ASUS TUF Gaming Laptop_0_65ae07cf5349f.jpeg', 6),
	('resource//mobile_images//ASUS TUF Gaming Laptop_1_65ae07cf53e73.jpeg', 6),
	('resource//mobile_images//ASUS TUF Gaming Laptop_2_65ae07cf54757.jpeg', 6),
	('resource//mobile_images//DJI Mavic 3Pro_0_65ae0c2d1f209.jpeg', 7),
	('resource//mobile_images//Samsung Galaxy Z Fold_0_65ae279828ce7.jpeg', 8),
	('resource//mobile_images//Samsung Galaxy Z Fold_1_65ae279829469.jpeg', 8),
	('resource//mobile_images//Samsung Galaxy Z Fold_2_65ae279829a78.jpeg', 8),
	('resource//mobile_images//Crocadile Trouser_0_669952fc3a7ba.jpeg', 10),
	('resource//mobile_images//Crocadile Trouser_1_669952fc3b28d.jpeg', 10),
	('resource//mobile_images//Crocadile Trouser_2_669952fc3ba0f.jpeg', 10),
	('resource//mobile_images//I5 Gaming Computer_0_669a9f2cb0c9d.jpeg', 11),
	('resource//mobile_images//Dhamro Sofa_0_66ab74a6365b6.jpeg', 15),
	('resource//mobile_images//Dhamro Sofa_1_66ab74a636f18.jpeg', 15),
	('resource//mobile_images//Dhamro Sofa_2_66ab74a637914.jpeg', 15),
	('resource//mobile_images//Executive Cupboard_0_66ac8a1f228fa.jpeg', 16),
	('resource//mobile_images//Executive Cupboard_1_66ac8a1f233e0.jpeg', 16),
	('resource//mobile_images//Executive Cupboard_2_66ac8a1f23cce.jpeg', 16),
	('resource//mobile_images//Crocadile Trouser_0_66b4ecbbadf5f.jpeg', 18),
	('resource//mobile_images//Crocadile Trouser_1_66b4ecbbaea40.jpeg', 18),
	('resource//mobile_images//Crocadile Trouser_2_66b4ecbbaf284.jpeg', 18),
	('resource//mobile_images//Pantry CupBoard_0_66b64805b54ca.jpeg', 20),
	('resource//mobile_images//Pantry CupBoard_1_66b64805b6644.jpeg', 20),
	('resource//mobile_images//Pantry CupBoard_2_66b64805b6db7.jpeg', 20);

-- Dumping structure for table online_shop.profile_img
CREATE TABLE IF NOT EXISTS `profile_img` (
  `path` varchar(100) NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`path`),
  KEY `fk_profile_img_user1_idx` (`user_email`),
  CONSTRAINT `fk_profile_img_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.profile_img: ~3 rows (approximately)
INSERT INTO `profile_img` (`path`, `user_email`) VALUES
	('resource//profile_images//sajeewa_65b9e8461de08.jpeg', 'sajeewarocell@gmail.com'),
	('resource//profile_images//Nithika_66733aeb4c10a.jpeg', 'sanithuruwanpathirana0@gmail.com'),
	('resource//profile_images//Sanithu_66a66d4cc87ba.jpeg', 'sanithuruwanpathirana@gmail.com');

-- Dumping structure for table online_shop.province
CREATE TABLE IF NOT EXISTS `province` (
  `province_id` int NOT NULL AUTO_INCREMENT,
  `province_name` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`province_id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.province: ~4 rows (approximately)
INSERT INTO `province` (`province_id`, `province_name`) VALUES
	(1, 'Western Province'),
	(2, 'Sourthern Province'),
	(3, 'North Province'),
	(4, 'Central Province');

-- Dumping structure for table online_shop.recent
CREATE TABLE IF NOT EXISTS `recent` (
  `r_id` int NOT NULL AUTO_INCREMENT,
  `product_id` int NOT NULL,
  `user_email` varchar(100) NOT NULL,
  PRIMARY KEY (`r_id`),
  KEY `fk_recent_product1_idx` (`product_id`),
  KEY `fk_recent_user1_idx` (`user_email`),
  CONSTRAINT `fk_recent_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_recent_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=69 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.recent: ~65 rows (approximately)
INSERT INTO `recent` (`r_id`, `product_id`, `user_email`) VALUES
	(4, 8, 'sanithuruwanpathirana0@gmail.com'),
	(5, 8, 'sanithuruwanpathirana0@gmail.com'),
	(6, 8, 'sanithuruwanpathirana0@gmail.com'),
	(7, 8, 'sanithuruwanpathirana0@gmail.com'),
	(8, 8, 'sanithuruwanpathirana0@gmail.com'),
	(9, 8, 'sanithuruwanpathirana0@gmail.com'),
	(10, 8, 'sanithuruwanpathirana0@gmail.com'),
	(11, 8, 'sanithuruwanpathirana0@gmail.com'),
	(12, 8, 'sanithuruwanpathirana0@gmail.com'),
	(13, 2, 'sanithuruwanpathirana0@gmail.com'),
	(14, 1, 'sanithuruwanpathirana0@gmail.com'),
	(15, 6, 'sanithuruwanpathirana0@gmail.com'),
	(16, 5, 'sanithuruwanpathirana0@gmail.com'),
	(17, 7, 'sanithuruwanpathirana0@gmail.com'),
	(18, 9, 'sanithuruwanpathirana0@gmail.com'),
	(19, 8, 'sanithuruwanpathirana0@gmail.com'),
	(20, 8, 'sanithuruwanpathirana0@gmail.com'),
	(21, 8, 'sanithuruwanpathirana0@gmail.com'),
	(22, 8, 'sanithuruwanpathirana0@gmail.com'),
	(23, 8, 'sanithuruwanpathirana0@gmail.com'),
	(24, 8, 'sanithuruwanpathirana0@gmail.com'),
	(25, 8, 'sanithuruwanpathirana0@gmail.com'),
	(26, 8, 'sanithuruwanpathirana0@gmail.com'),
	(27, 1, 'sanithuruwanpathirana0@gmail.com'),
	(28, 2, 'sanithuruwanpathirana0@gmail.com'),
	(29, 4, 'sanithuruwanpathirana0@gmail.com'),
	(30, 8, 'sanithuruwanpathirana0@gmail.com'),
	(31, 2, 'sanithuruwanpathirana0@gmail.com'),
	(32, 8, 'sanithuruwanpathirana0@gmail.com'),
	(33, 6, 'sanithuruwanpathirana0@gmail.com'),
	(34, 8, 'sanithuruwanpathirana0@gmail.com'),
	(35, 8, 'sanithuruwanpathirana0@gmail.com'),
	(36, 8, 'sanithuruwanpathirana0@gmail.com'),
	(37, 4, 'sanithuruwanpathirana0@gmail.com'),
	(38, 8, 'sanithuruwanpathirana0@gmail.com'),
	(39, 7, 'sanithuruwanpathirana0@gmail.com'),
	(40, 10, 'sanithuruwanpathirana@gmail.com'),
	(41, 10, 'sanithuruwanpathirana@gmail.com'),
	(42, 10, 'sanithuruwanpathirana@gmail.com'),
	(43, 10, 'sanithuruwanpathirana@gmail.com'),
	(44, 11, 'sanithuruwanpathirana@gmail.com'),
	(45, 11, 'sanithuruwanpathirana@gmail.com'),
	(46, 11, 'sanithuruwanpathirana@gmail.com'),
	(47, 10, 'sanithuruwanpathirana@gmail.com'),
	(48, 11, 'sanithuruwanpathirana@gmail.com'),
	(49, 8, 'sanithuruwanpathirana@gmail.com'),
	(50, 10, 'sanithuruwanpathirana@gmail.com'),
	(51, 9, 'sanithuruwanpathirana@gmail.com'),
	(52, 6, 'sanithuruwanpathirana@gmail.com'),
	(53, 15, 'sanithuruwanpathirana@gmail.com'),
	(54, 10, 'sanithuruwanpathirana@gmail.com'),
	(55, 2, 'sanithuruwanpathirana@gmail.com'),
	(56, 11, 'sanithuruwanpathirana0@gmail.com'),
	(57, 8, 'sanithuruwanpathirana0@gmail.com'),
	(58, 8, 'sanithuruwanpathirana0@gmail.com'),
	(59, 8, 'sanithuruwanpathirana0@gmail.com'),
	(60, 8, 'sanithuruwanpathirana0@gmail.com'),
	(61, 10, 'sanithuruwanpathirana0@gmail.com'),
	(62, 10, 'sanithuruwanpathirana0@gmail.com'),
	(63, 18, 'sanithuruwanpathirana0@gmail.com'),
	(64, 18, 'sanithuruwanpathirana0@gmail.com'),
	(65, 6, 'sanithuruwanpathirana@gmail.com'),
	(66, 9, 'sanithuruwanpathirana@gmail.com'),
	(67, 9, 'sanithuruwanpathirana@gmail.com'),
	(68, 8, 'sanithuruwanpathirana@gmail.com');

-- Dumping structure for table online_shop.status
CREATE TABLE IF NOT EXISTS `status` (
  `status_id` int NOT NULL AUTO_INCREMENT,
  `status` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.status: ~2 rows (approximately)
INSERT INTO `status` (`status_id`, `status`) VALUES
	(1, 'Active'),
	(2, 'Inactive');

-- Dumping structure for table online_shop.user
CREATE TABLE IF NOT EXISTS `user` (
  `fname` varchar(50) NOT NULL,
  `lname` varchar(45) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(20) NOT NULL,
  `mobile` varchar(10) NOT NULL,
  `joined_date` datetime NOT NULL,
  `verification_code` varchar(20) DEFAULT NULL,
  `gender_gender_id` int NOT NULL,
  `status_status_id` int NOT NULL,
  PRIMARY KEY (`email`),
  KEY `fk_user_gender_idx` (`gender_gender_id`),
  KEY `fk_user_status1_idx` (`status_status_id`),
  CONSTRAINT `fk_user_gender` FOREIGN KEY (`gender_gender_id`) REFERENCES `gender` (`gender_id`),
  CONSTRAINT `fk_user_status1` FOREIGN KEY (`status_status_id`) REFERENCES `status` (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.user: ~6 rows (approximately)
INSERT INTO `user` (`fname`, `lname`, `email`, `password`, `mobile`, `joined_date`, `verification_code`, `gender_gender_id`, `status_status_id`) VALUES
	('Sanithu', 'Ruwanpathirana', 'anscakes2023@gmail.com', '963258', '0718672006', '2024-07-30 19:30:58', NULL, 1, 1),
	('Aruna', 'Ruwanpathirana', 'arunaruwanpathirana@gmail.com', 'Priyangi1', '0774772732', '2024-07-23 12:06:31', NULL, 1, 1),
	('sajeewa', 'niroshan', 'sajeewarocell@gmail.com', 'sajeewa2009', '0754299330', '2024-01-31 11:52:14', '65b9ecaa75753', 1, 1),
	('Nithika', 'Ruwanpathirana', 'sanithuruwanpathirana0@gmail.com', 'abcd', '0764663597', '2024-01-28 14:29:50', '669528513577a', 1, 1),
	('Sanithu', 'Ruwanpathirana', 'sanithuruwanpathirana@gmail.com', 'Sanithu@2005', '0764663597', '2024-01-21 01:03:50', '66b6793382b6a', 1, 1),
	('Sheron', 'Randew', 'sheron@gmail.com', '123', '0715862347', '2024-08-07 03:15:03', NULL, 1, 1);

-- Dumping structure for table online_shop.user_has_address
CREATE TABLE IF NOT EXISTS `user_has_address` (
  `user_email` varchar(100) NOT NULL,
  `city_city_id` int NOT NULL,
  `address_id` int NOT NULL AUTO_INCREMENT,
  `line1` text,
  `line2` text,
  `postal_code` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`address_id`),
  KEY `fk_user_has_city_city1_idx` (`city_city_id`),
  KEY `fk_user_has_city_user1_idx` (`user_email`),
  CONSTRAINT `fk_user_has_city_city1` FOREIGN KEY (`city_city_id`) REFERENCES `city` (`city_id`),
  CONSTRAINT `fk_user_has_city_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.user_has_address: ~3 rows (approximately)
INSERT INTO `user_has_address` (`user_email`, `city_city_id`, `address_id`, `line1`, `line2`, `postal_code`) VALUES
	('sanithuruwanpathirana@gmail.com', 2, 2, '225/1, Sarwodaya Mawatha,', 'Makandana, Madapatha', '10306'),
	('sajeewarocell@gmail.com', 2, 3, '32.8 nawala', 'narahempita', '1985'),
	('sanithuruwanpathirana0@gmail.com', 2, 4, '225/1, Sarwodaya Mawatha, ', 'Makandana, Madapatha.', '10306');

-- Dumping structure for table online_shop.watchlist
CREATE TABLE IF NOT EXISTS `watchlist` (
  `w_id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `product_id` int NOT NULL,
  PRIMARY KEY (`w_id`) USING BTREE,
  KEY `fk_watchlist_user1_idx` (`user_email`),
  KEY `fk_watchlist_product1_idx` (`product_id`),
  CONSTRAINT `fk_watchlist_product1` FOREIGN KEY (`product_id`) REFERENCES `product` (`id`),
  CONSTRAINT `fk_watchlist_user1` FOREIGN KEY (`user_email`) REFERENCES `user` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb3;

-- Dumping data for table online_shop.watchlist: ~3 rows (approximately)
INSERT INTO `watchlist` (`w_id`, `user_email`, `product_id`) VALUES
	(24, 'sanithuruwanpathirana@gmail.com', 9),
	(25, 'sanithuruwanpathirana@gmail.com', 6),
	(26, 'sanithuruwanpathirana@gmail.com', 8);

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
