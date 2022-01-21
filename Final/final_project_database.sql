-- MySQL dump 10.13  Distrib 8.0.18, for Win64 (x86_64)
--
-- Host: localhost    Database: final_project_database
-- ------------------------------------------------------
-- Server version	8.0.18

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
  `CustomerKey` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CustFirstName` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `CustLastName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `CustStreetAddress` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `CustCity` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `CustState` char(2) COLLATE utf8mb4_general_ci NOT NULL,
  `CustZip` varchar(5) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`CustomerKey`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Mary','Anderson','1255 Oak st.','Bemidji','MN','56601'),(2,'John','Smith','1010 Ralph st.','Elk River','MN','55330'),(3,'Joe','Rogan','140 Elk ave.','Clearwater','MN','55320'),(4,'Sam','Hogan','210 Deer st.','Clearwater','MN','55320'),(5,'Lily','Smith','151 Lake st.','Paynesville','MN','56362'),(6,'Jane','Doe','123 Elk st.','Elk River','MN','55330');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orderdetails`
--

DROP TABLE IF EXISTS `orderdetails`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orderdetails` (
  `OrderKey` int(10) unsigned NOT NULL,
  `ProductKey` int(10) unsigned NOT NULL,
  `OrderQty` int(11) NOT NULL,
  PRIMARY KEY (`OrderKey`,`ProductKey`),
  KEY `fk_ProductKey` (`ProductKey`),
  CONSTRAINT `fk_Orderkey` FOREIGN KEY (`OrderKey`) REFERENCES `orders` (`OrderKey`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_ProductKey` FOREIGN KEY (`ProductKey`) REFERENCES `products` (`ProductKey`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orderdetails`
--

LOCK TABLES `orderdetails` WRITE;
/*!40000 ALTER TABLE `orderdetails` DISABLE KEYS */;
INSERT INTO `orderdetails` VALUES (1,1,1),(1,2,2),(2,3,1),(3,4,3),(4,5,2),(5,6,1),(6,1,1),(7,3,1),(7,5,1),(7,6,2),(8,3,1),(8,4,1);
/*!40000 ALTER TABLE `orderdetails` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `orders`
--

DROP TABLE IF EXISTS `orders`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `orders` (
  `OrderKey` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Total` decimal(5,2) NOT NULL,
  `OrderDate` date NOT NULL,
  `CustomerKey` int(10) unsigned NOT NULL,
  `PaymentKey` int(10) unsigned NOT NULL,
  PRIMARY KEY (`OrderKey`),
  KEY `fk_CustomerKey` (`CustomerKey`),
  KEY `fk_PaymentKey` (`PaymentKey`),
  CONSTRAINT `fk_CustomerKey` FOREIGN KEY (`CustomerKey`) REFERENCES `customer` (`CustomerKey`) ON DELETE CASCADE ON UPDATE RESTRICT,
  CONSTRAINT `fk_PaymentKey` FOREIGN KEY (`PaymentKey`) REFERENCES `payment` (`PaymentKey`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `orders`
--

LOCK TABLES `orders` WRITE;
/*!40000 ALTER TABLE `orders` DISABLE KEYS */;
INSERT INTO `orders` VALUES (1,58.00,'2021-12-10',1,1),(2,10.00,'2021-12-15',2,2),(3,32.00,'2021-12-15',3,3),(4,106.00,'2021-12-15',4,4),(5,48.00,'2021-12-15',2,2),(6,16.00,'2021-12-15',5,5),(7,160.00,'2021-12-15',5,5),(8,21.00,'2021-12-15',6,6);
/*!40000 ALTER TABLE `orders` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `payment` (
  `PaymentKey` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CustomerKey` int(10) unsigned NOT NULL,
  `CardNum` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `CVV` char(3) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ExpiryDate` char(5) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`PaymentKey`),
  KEY `fk_PayCustomerKey` (`CustomerKey`),
  CONSTRAINT `fk_PayCustomerKey` FOREIGN KEY (`CustomerKey`) REFERENCES `customer` (`CustomerKey`) ON DELETE CASCADE ON UPDATE RESTRICT
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,1,'1478 9987 1212 9874','774','01/22'),(2,2,'4458 1256 5587 1247','258','06/23'),(3,3,'1456 7852 4567 8910','123','04/22'),(4,4,'1234 7891 4456 1121','753','02/23'),(5,5,' 9987 6554 3332 221','652','08/23'),(6,6,'1234 5678 9101 1213','456','07/22');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `products` (
  `ProductKey` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ProductImage` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL COMMENT 'Stores filename',
  `ProductName` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `ProductDescription` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `ProductPrice` decimal(5,2) NOT NULL,
  `InventoryQty` int(11) NOT NULL,
  PRIMARY KEY (`ProductKey`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,'Gen_1_Pokemon_Poster.jpg','Pokemon Poster','A poster showing Gen 1 Pokemon.',15.00,25),(2,'Pikachu_Plush.jpg','Pikachu Plush','A plush of the pokemon Pikachu.',20.00,30),(3,'Mario_Cap.png','Mario Cap','A baseball cap with the Mario icon.',10.00,30),(4,'Luigi_Cap.png','Luigi Cap','A basebal cap with the Luigi icon.',10.00,30),(5,'Master_Chief_Figurine.jpg','Master Chief Figurine','A 12in. Figurine of Master Chief from Halo.',50.00,20),(6,'Steve_Figurine.jpg','Steve Figurine','A 12 in. figurine of Steve from Minecraft.',45.00,20);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `UserKey` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `Username` varchar(30) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `UserPassword` varchar(500) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `AccountType` varchar(10) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `UserFirstName` varchar(10) COLLATE utf8mb4_general_ci NOT NULL,
  `UserLastName` varchar(30) COLLATE utf8mb4_general_ci NOT NULL,
  `UserEmail` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  PRIMARY KEY (`UserKey`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'NewUser','$2y$10$JVAYlRjok.qGl7JmKZzNjOv0SCTHaa8nOwaT7csb9Z982cQIYPYZK','admin','Test','User','newuser@example.com'),(4,'AnotherUser','$2y$10$yp6BjIX2B05nC6gxAonZaemduUypRjJKq.3lfpwFPaPYGUK2KYXEa','admin','Test','User','anotheruser@example.com'),(5,'TestUser','$2y$10$ONNyF3W2vJsUzs7ASe/6geUnYfhBf45R8gatZicfQWfhQEGg8aTg6','admin','Test','User','test@example.com');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-12-19 14:01:49
