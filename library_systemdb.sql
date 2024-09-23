CREATE DATABASE  IF NOT EXISTS `library_systemdb` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `library_systemdb`;
-- MySQL dump 10.13  Distrib 8.0.28, for Win64 (x86_64)
--
-- Host: localhost    Database: library_systemdb
-- ------------------------------------------------------
-- Server version	8.0.28

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `books` (
  `id` int NOT NULL AUTO_INCREMENT,
  `accesion` int DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `publisher` varchar(255) DEFAULT NULL,
  `year` varchar(45) DEFAULT NULL,
  `availability` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,1001,'Heat and Thermodynamics','Pearson','2012',10,NULL,'2024-09-22 21:14:21'),(2,1002,'General Theory of Relativity','Pearson','2010',10,NULL,'2024-09-22 21:14:50'),(3,1003,'Machine Design','International','2006',10,NULL,'2024-09-22 21:14:53'),(4,1004,'Anatomy 101','NYU','2011',10,NULL,'2024-09-22 21:14:55'),(5,1005,'Atomic and Nuclear Systems','Sharma','2010',10,NULL,'2024-09-22 21:14:33'),(6,1006,'Computer System Architecture','Rob Williams ','1996',10,NULL,'2024-09-22 21:14:36'),(7,1007,'Theory of Machines','Sandhu Singh ','1998',10,NULL,'2024-09-22 21:14:39'),(8,1008,'C: How to program','Deiteil ','1995',10,NULL,'2024-09-22 21:14:41'),(9,1009,'Database Processing','Auer Davil J. ','1990',10,NULL,'2024-09-22 21:14:48'),(10,1010,'Nuclear Physics','Prasad','1992',10,NULL,'2024-09-22 21:15:00'),(11,1011,'The Pragmatic Programmer','Andy Hunt','1999',10,NULL,'2024-09-22 21:15:05'),(12,1012,'The Mythical Man-Month','Frederick P. Brooks','1975',10,NULL,'2024-09-22 21:15:09'),(13,1013,'The DevOps Handbook','Gene Kim','2015',10,NULL,'2024-09-22 21:15:16'),(14,1014,'Code','Charles Petzold','1999',10,NULL,'2024-09-22 21:15:21'),(15,1015,'Structure and Interpretation of Computer Programs','Harold Abelson','1984',10,NULL,'2024-09-22 21:15:26'),(16,1016,'Designing Data-Intensive Applications','Martin Kleppmann','2015',10,NULL,'2024-09-22 21:15:30'),(17,1017,'Fundamentals of Software Architecture','Mark Richards','2020',10,NULL,'2024-09-22 21:15:36'),(18,1018,'Software Architecture: The Hard Parts','Neal Ford','2021',10,NULL,'2024-09-22 21:15:42'),(19,1019,'Modern Software Engineering','David Farley','2021',10,NULL,'2024-09-22 21:15:49'),(20,1020,'Computer Networking','James F. Kurose','2000',10,NULL,'2024-09-22 21:15:54'),(21,1021,'Database System Concepts','Abraham Silberschatz','1987',10,NULL,'2024-09-22 21:16:00'),(22,1022,'Computer Organization and Architecture','William Stallings','1987',10,NULL,'2024-09-22 21:16:06'),(23,1023,'Design Patterns','Erich Gamma','1994',10,NULL,'2024-09-22 21:16:12'),(24,1024,'Site Reliability Engineering','Betsy Beyer','2016',10,NULL,'2024-09-22 21:16:17');
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `messages` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` varchar(45) DEFAULT NULL,
  `content` text,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `records`
--

DROP TABLE IF EXISTS `records`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `records` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` varchar(45) DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `date_of_issue` date DEFAULT NULL,
  `due_date` date DEFAULT NULL,
  `date_of_return` date DEFAULT NULL,
  `dues` int DEFAULT NULL,
  `renewals_left` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `records`
--

LOCK TABLES `records` WRITE;
/*!40000 ALTER TABLE `records` DISABLE KEYS */;
/*!40000 ALTER TABLE `records` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `renew`
--

DROP TABLE IF EXISTS `renew`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `renew` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` varchar(45) DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=60 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `renew`
--

LOCK TABLES `renew` WRITE;
/*!40000 ALTER TABLE `renew` DISABLE KEYS */;
/*!40000 ALTER TABLE `renew` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `returns`
--

DROP TABLE IF EXISTS `returns`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `returns` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` varchar(45) DEFAULT NULL,
  `book_id` int DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=77 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `returns`
--

LOCK TABLES `returns` WRITE;
/*!40000 ALTER TABLE `returns` DISABLE KEYS */;
/*!40000 ALTER TABLE `returns` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `school_id` varchar(45) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `contact_number` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `user_level` varchar(45) DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'11111111','admin','09656204367','admin@gmail.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','admin','2024-09-05 02:34:29','2024-09-21 20:27:02'),(2,'06192001172','cherry ann nepomuceno','09656204311','cherry@phinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-05 02:42:02',NULL),(3,'06192001175','Mark Ivan Balote','09096123651','mark@phinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 22:53:11',NULL),(4,'06192001166','Bryan Gloda','09181234565','bryan@phinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 22:56:17',NULL),(5,'06192001180','Kate Silvestre','09191234590','kate@phinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 22:57:43',NULL),(6,'06192001163','Grexter Galino','09174560190','grexter@phinamed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 22:59:23',NULL),(7,'06192001160','Daiel Sarmiento','09167890134','daniel@ohinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 23:03:09',NULL),(8,'06192001176','Dahna Israel','09152347811','dahna@phinamed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 23:04:05',NULL),(9,'06192001181','Henry Boado','09091239011','henry@phinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 23:04:52',NULL),(10,'06192001169','Liezel Abcedo','09181238854','liezel@phinamed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 23:05:47',NULL),(11,'06192001170','Aldrin De guzman','09198801922','aldrin@phinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','student','2024-09-08 23:06:54',NULL),(12,'06192001171','Ami Laman','09199911234','ami@phinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','faculty','2024-09-21 21:28:25',NULL),(13,'06192001173','kristine reyna','09188812345','kristine@phinmaed.com','$2y$10$7HLGJzVD/a.6FSN2Em.wFOA2VYOKOej.5TO8t83yTYmE8LKKFuyG.','faculty','2024-09-21 21:32:12',NULL),(14,'06192001174','Helen lewis','09157789101','helen@phinmaed.com','$2y$10$pfrk28.9y5GSrL1vlUjgF.UG8RenPn5btREWItmLtmPWkWRJfjWPe','faculty','2024-09-21 23:54:54',NULL),(15,'06192001177','ayang santos','09102012399','ayang@phimaed.com','$2y$10$meFA8gtJsFIGzsj42BVwduoXOccvxOjVZbM7KYnpPC1qG/GagtdA6','faculty','2024-09-21 23:57:05',NULL),(16,'06192001178','Roderic nepomuceno','09187890456','roderic@phinmaed.com','$2y$10$CQxa2K8acHCnNFVRxJ5kFeoUSLd6dub9pFHHWKkbvwe7ZjcfLkIjO','student','2024-09-22 00:04:15',NULL);
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

-- Dump completed on 2024-09-23 20:06:08
