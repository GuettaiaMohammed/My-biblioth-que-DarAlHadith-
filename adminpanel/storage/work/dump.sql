-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: daralhadith
-- ------------------------------------------------------
-- Server version 	5.7.17-log
-- Date: Fri, 27 Apr 2018 16:37:33 +0100

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `account`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `account` (
  `account_id` int(11) NOT NULL AUTO_INCREMENT,
  `libuser_id` int(11) DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_password` varchar(255) NOT NULL,
  `account_isonline` tinyint(1) NOT NULL DEFAULT '0',
  `account_role` varchar(255) NOT NULL DEFAULT 'user',
  PRIMARY KEY (`account_id`),
  UNIQUE KEY `account_name` (`account_name`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `account`
--

LOCK TABLES `account` WRITE;
/*!40000 ALTER TABLE `account` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `account` VALUES (1,1,'admin','$2y$10$p8oMO5i/PFCycyTY2QeDJOTKWotfi0EcAWMnsX8LY4y0WbW6C1c2W',1,'admin'),(2,2,'mohammed','$2y$10$r3OObAXRo9XK3kV3Z14F5.jQdRIrasyFBHwr/ZDhaJuHPkArhB.SK',0,'admin'),(3,3,'alguennoun','$2y$10$W0d7fC7nzOGe5RN9Qwg8NOfEEVXJR2ui9EjQvazxj2ulYcrIwkDl6',0,'user'),(4,27,'omar','$2y$10$aM3c7wm2q4RCurnVT88CL.UHYJLXm14HR3DO1BI2T3ErxIE6k7ulG',0,'user'),(5,26,'omar1','$2y$10$rQBjUi2zf7N8oMv04MhHieNSzUPFuVY1QUY0CtIDtxfLJ0j6mw21O',0,'user');
/*!40000 ALTER TABLE `account` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `article`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `article` (
  `article_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_titel` varchar(255) NOT NULL,
  `article_synopsis` mediumtext NOT NULL,
  `article_publisher` varchar(255) NOT NULL,
  `article_keywords` varchar(255) NOT NULL,
  `article_tags` varchar(255) NOT NULL,
  `article_cover` varchar(255) NOT NULL,
  `article_urlpdf` varchar(255) NOT NULL,
  `article_urlaudio` varchar(255) NOT NULL,
  `article_pages` int(11) NOT NULL,
  `article_publishingdate` date NOT NULL,
  `article_category` varchar(255) NOT NULL,
  `article_author` varchar(255) NOT NULL,
  PRIMARY KEY (`article_id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `article`
--

LOCK TABLES `article` WRITE;
/*!40000 ALTER TABLE `article` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `article` VALUES (1,'زعفريزع','derhtrftdh','زعفريزع','keywords','tags','pics/books/DRXOAaBWsAAmLxY.jpg','gh','hgf',255,'2018-04-02','science','author'),(2,'محجز','loremipsum','publisher1','keywords','tags','pics/books/book%20(2).jpg','gh','hgf',255,'2018-04-02','science','author'),(3,'titel4','loremipsum','publisher1','keywords','tags','pics/books/book%20(3).jpg','gh','hgf',255,'2018-04-02','science','author'),(4,'titel8','loremipsum','publisher1','keywords','tags','pics/books/book%20(4).jpg','gh','hgf',255,'2018-04-02','science','author'),(5,'titel5','loremipsum','publisher1','keywords','tags','pics/books/book%20(4).jpg','gh','hgf',255,'2018-04-02','science','author'),(6,'titel4','loremipsum','publisher1','keywords','tags','pics/books/book%20(1).jpg','gh','hgf',255,'2018-04-02','science','author'),(7,'titel7','loremipsum','publisher1','keywords','tags','pics/books/book%20(1).jpg','gh','hgf',255,'2018-04-02','science','author'),(8,'titel20','loremipsum','publisher1','keywords','tags','pics/books/book%20(1).jpg','gh','hgf',255,'2018-04-02','science','author'),(9,'tite7','loremipsum','publisher1','keywords','tags','pics/books/book%20(1).jpg','gh','hgf',20,'2018-04-02','science','author'),(10,'sqzfg','loremipsum','publisher1','feqa','tags','pics/books/wallpapersden.com_poly-lakeside-minimal_3840x2160.jpg','gh','hgf',255,'1010-10-10','qaf','authssor');
/*!40000 ALTER TABLE `article` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `borrow`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `borrow` (
  `borrow_id` int(11) NOT NULL AUTO_INCREMENT,
  `copy_id` int(11) DEFAULT NULL,
  `libuser_id` int(11) DEFAULT NULL,
  `borrow_date` datetime NOT NULL,
  `borrow_returndate` datetime NOT NULL,
  `borrow_returned` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`borrow_id`)
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `borrow`
--

LOCK TABLES `borrow` WRITE;
/*!40000 ALTER TABLE `borrow` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `borrow` VALUES (19,1,1,'2018-03-31 00:00:00','2018-04-25 00:00:00',1),(20,1,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(21,1,1,'2018-03-31 00:00:00','2018-01-12 05:24:18',1),(22,1,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(23,2,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(24,2,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(25,2,1,'2018-03-31 00:00:00','2018-01-22 00:00:00',1),(26,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(27,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(28,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(29,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(30,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(31,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(32,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(33,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(34,3,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(35,6,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(36,6,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(37,6,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(38,6,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(39,6,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(40,6,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(41,6,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(42,10,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(43,10,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(44,10,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(45,14,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(46,14,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(47,14,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(48,14,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(49,14,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(50,14,1,'2018-03-31 00:00:00','0000-00-00 00:00:00',1),(51,14,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(52,14,1,'0000-00-00 00:00:00','0000-00-00 00:00:00',1),(53,14,1,'2018-10-10 20:20:20','0000-00-00 00:00:00',1),(54,2,26,'0000-00-00 00:00:00','2018-04-22 20:46:26',0),(55,4,26,'0000-00-00 00:00:00','2018-04-22 20:46:26',0),(56,3,1,'0000-00-00 00:00:00','2018-04-22 22:56:11',0),(57,5,27,'0000-00-00 00:00:00','2018-04-22 22:57:55',0),(58,6,27,'0000-00-00 00:00:00','2018-04-22 23:00:49',0),(59,12,27,'0000-00-00 00:00:00','2018-04-22 23:41:05',0),(60,3,27,'0000-00-00 00:00:00','2018-04-22 23:41:05',0),(61,7,3,'0000-00-00 00:00:00','2018-05-12 08:27:28',0),(62,9,3,'0000-00-00 00:00:00','2018-05-12 08:27:41',0);
/*!40000 ALTER TABLE `borrow` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `copy`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `copy` (
  `copy_id` int(11) NOT NULL AUTO_INCREMENT,
  `article_id` int(11) DEFAULT NULL,
  `copy_state` varchar(255) NOT NULL DEFAULT 'idle',
  `copy_position` int(11) NOT NULL,
  `copy_price` float NOT NULL,
  `copy_source` varchar(255) NOT NULL,
  `copy_enteringdate` date NOT NULL,
  PRIMARY KEY (`copy_id`)
) ENGINE=InnoDB AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `copy`
--

LOCK TABLES `copy` WRITE;
/*!40000 ALTER TABLE `copy` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `copy` VALUES (1,1,'مسروق',0,0,'univ','1010-10-10'),(2,1,'معار',0,0,'zerg','0010-10-10'),(3,1,'معار',0,0,'univ','0010-10-10'),(4,1,'معار',0,0,'univ','0010-10-10'),(5,1,'معار',0,0,'univ','0010-10-10'),(6,2,'معار',150,41,'univ','2801-10-20'),(7,2,'معار',25,25.25,'univ','1000-06-05'),(9,8,'معار',2,0,'محجز','1111-01-21'),(10,8,'متوفر',0,0,'univ','0485-01-05'),(11,8,'متوفر',0,0,'univ','0510-10-20'),(12,4,'معار',0,0,'univ','0020-02-10'),(13,4,'متوفر',0,0,'univ','0100-12-20'),(14,4,'متوفر',0,0,'univ','0012-12-12'),(15,4,'متوفر',0,0,'univ','0012-12-12'),(28,1,'متوفر',150,2500,'زعفريزع','2018-04-01'),(29,1,'متوفر',150,2500,'زعفريزع','2018-04-04'),(30,1,'متوفر',150,2500,'زعفريزع','2018-04-04'),(31,1,'متوفر',150,2500,'زعفريزع','2018-04-04'),(32,2,'متوفر',15020,2500.5,'univ','2018-04-04'),(33,2,'متوفر',150,2500,'univ','2018-04-04'),(34,2,'متوفر',150,2500,'univ','2018-04-04'),(35,2,'متوفر',150,542,'univ','2018-04-04'),(36,8,'متوفر',150,2500,'مصدر الكتاب','2018-04-05'),(37,10,'مسروق',150,2500,'مصدر الكتاب','2018-04-06');
/*!40000 ALTER TABLE `copy` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `libreturn`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libreturn` (
  `libreturn_id` int(11) NOT NULL AUTO_INCREMENT,
  `libuser_id` int(11) DEFAULT NULL,
  `copy_id` int(11) DEFAULT NULL,
  `libreturn_date` datetime NOT NULL,
  PRIMARY KEY (`libreturn_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libreturn`
--

LOCK TABLES `libreturn` WRITE;
/*!40000 ALTER TABLE `libreturn` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `libreturn` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `libuser`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `libuser` (
  `libuser_id` int(11) NOT NULL AUTO_INCREMENT,
  `libuser_firstname` varchar(255) NOT NULL,
  `libuser_lastname` varchar(255) NOT NULL,
  `libuser_adress` varchar(255) NOT NULL,
  `libuser_birthdate` date NOT NULL,
  `libuser_birthplace` varchar(255) NOT NULL,
  `libuser_susbcriptiondate` varchar(255) NOT NULL,
  `libuser_speciality` varchar(255) NOT NULL,
  `libuser_phonenumber` varchar(255) NOT NULL,
  `libuser_email` varchar(255) NOT NULL,
  `libuser_maxarticles` int(11) NOT NULL,
  PRIMARY KEY (`libuser_id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `libuser`
--

LOCK TABLES `libuser` WRITE;
/*!40000 ALTER TABLE `libuser` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `libuser` VALUES (1,'med','guennoun','sdwtght','1994-10-20','maghnia','2010-10-10','student','07777777','email@gmail.com',2),(2,'haytam','samet','blabla','1994-10-20','mahraz','1111-10-20','worker','8998','msenta7@email.com',2),(3,'mohammed','guettaia','blabla','1987-10-10','maghnia','2010-10-10','student','0777777777','makach@fih.fayda',2),(4,'mohammed','guennoun','blabla','1944-01-25','maghnia','1990-10-20','etudiant','74525','email@email.com',2),(5,'mayonais','ketchup','blabla','1994-10-20','maghnia','2018-03-31','student','0777777777','email@email.com',2),(26,'omar','daoud','Fellaoucene','1996-08-23','Tlemcen','2018-04-06','student','07789208456','sniperfromdz@gmail.com',0),(27,'omar','daoud','Fellaoucene','1996-08-23','Tlemcen','2018-04-06','student','07789208456','sniperfromdz@gmail.com',0);
/*!40000 ALTER TABLE `libuser` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `reservation`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `reservation` (
  `reservation_id` int(11) NOT NULL AUTO_INCREMENT,
  `libuser_id` int(11) DEFAULT NULL,
  `copy_id` int(11) DEFAULT NULL,
  `reservation_date` datetime NOT NULL,
  `reservation_returndate` datetime NOT NULL,
  PRIMARY KEY (`reservation_id`)
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `reservation`
--

LOCK TABLES `reservation` WRITE;
/*!40000 ALTER TABLE `reservation` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `reservation` VALUES (1,1,1,'2018-04-05 15:34:40','1970-01-02 01:00:00'),(2,1,1,'2018-04-05 15:35:37','2018-04-06 15:35:37'),(3,1,1,'2018-04-05 15:35:56','2018-04-07 15:35:56'),(4,1,1,'2018-04-05 15:35:58','2018-04-07 15:35:58'),(5,1,1,'2018-04-05 15:35:58','2018-04-07 15:35:58'),(6,1,1,'2018-04-05 15:35:59','2018-04-07 15:35:59'),(7,1,1,'2018-04-05 15:37:37','2018-04-07 15:37:37'),(8,1,1,'2018-04-05 15:37:37','2018-04-07 15:37:37'),(9,1,1,'2018-04-05 15:37:38','2018-04-07 15:37:38'),(10,1,1,'2018-04-05 15:37:38','2018-04-07 15:37:38'),(11,1,1,'2018-04-05 15:37:38','2018-04-07 15:37:38'),(12,1,1,'2018-04-05 15:37:38','2018-04-07 15:37:38'),(13,1,1,'2018-04-05 15:37:39','2018-04-07 15:37:39'),(14,1,1,'2018-04-05 15:37:39','2018-04-07 15:37:39'),(15,1,1,'2018-04-05 15:37:39','2018-04-07 15:37:39'),(16,1,1,'2018-04-05 15:37:39','2018-04-07 15:37:39'),(17,1,1,'2018-04-05 15:37:39','2018-04-07 15:37:39'),(18,1,1,'2018-04-05 15:37:40','2018-04-07 15:37:40'),(19,1,1,'2018-04-05 15:37:40','2018-04-07 15:37:40'),(20,1,1,'2018-04-05 15:37:40','2018-04-07 15:37:40'),(21,1,1,'2018-04-05 15:37:49','2018-04-07 15:37:49'),(22,1,4,'2018-04-05 15:37:50','2018-04-07 15:37:50'),(23,1,5,'2018-04-05 15:37:50','2018-04-07 15:37:50'),(24,1,1,'2018-04-05 15:49:23','2018-04-07 15:49:23'),(25,1,4,'2018-04-05 15:49:24','2018-04-07 15:49:24'),(26,1,5,'2018-04-05 15:49:25','2018-04-07 15:49:25'),(27,1,1,'2018-04-05 15:51:05','2018-04-07 15:51:05'),(28,1,4,'2018-04-05 15:51:05','2018-04-07 15:51:05'),(29,1,5,'2018-04-05 15:51:06','2018-04-07 15:51:06'),(30,1,6,'2018-04-05 15:54:28','2018-04-07 15:54:28'),(31,1,32,'2018-04-05 15:54:29','2018-04-07 15:54:29'),(32,1,34,'2018-04-05 15:54:30','2018-04-07 15:54:30'),(33,1,35,'2018-04-05 15:54:30','2018-04-07 15:54:30'),(34,1,6,'2018-04-05 15:54:59','2018-04-07 15:54:59'),(35,1,32,'2018-04-05 15:55:00','2018-04-07 15:55:00'),(36,1,34,'2018-04-05 15:55:01','2018-04-07 15:55:01'),(37,1,35,'2018-04-05 15:55:01','2018-04-07 15:55:01'),(38,1,6,'2018-04-05 16:08:20','2018-04-07 16:08:20'),(39,1,32,'2018-04-05 16:08:21','2018-04-07 16:08:21'),(40,1,9,'2018-04-05 16:39:23','2018-04-07 16:39:23'),(41,1,10,'2018-04-05 16:39:23','2018-04-07 16:39:23'),(42,1,11,'2018-04-05 16:39:24','2018-04-07 16:39:24'),(43,1,9,'2018-04-05 16:44:37','2018-04-07 16:44:37'),(44,1,10,'2018-04-05 16:44:38','2018-04-07 16:44:38'),(45,1,11,'2018-04-05 16:44:38','2018-04-07 16:44:38'),(46,1,9,'2018-04-05 16:46:25','2018-04-07 16:46:25'),(47,1,10,'2018-04-05 16:46:25','2018-04-07 16:46:25'),(48,1,11,'2018-04-05 16:46:26','2018-04-07 16:46:26'),(49,1,1,'2018-04-05 16:48:19','2018-04-07 16:48:19'),(50,1,2,'2018-04-05 16:48:27','2018-04-07 16:48:27'),(51,1,9,'2018-04-06 15:08:06','2018-04-08 15:08:06'),(52,1,10,'2018-04-06 15:08:07','2018-04-08 15:08:07'),(53,1,11,'2018-04-06 15:08:08','2018-04-08 15:08:08'),(54,1,36,'2018-04-06 15:08:09','2018-04-08 15:08:09'),(55,1,1,'2018-04-06 15:08:37','2018-04-08 15:08:37'),(56,1,2,'2018-04-06 15:08:38','2018-04-08 15:08:38'),(57,1,6,'2018-04-06 15:08:49','2018-04-08 15:08:49'),(58,1,7,'2018-04-06 15:08:50','2018-04-08 15:08:50'),(59,1,32,'2018-04-06 15:08:50','2018-04-08 15:08:50'),(60,1,33,'2018-04-06 15:08:52','2018-04-08 15:08:52'),(61,1,34,'2018-04-06 15:08:52','2018-04-08 15:08:52'),(62,1,35,'2018-04-06 15:08:53','2018-04-08 15:08:53'),(63,27,6,'2018-04-07 07:32:45','2018-04-09 07:32:45'),(64,1,12,'2018-04-07 11:02:07','2018-04-09 11:02:07');
/*!40000 ALTER TABLE `reservation` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Fri, 27 Apr 2018 16:37:33 +0100
