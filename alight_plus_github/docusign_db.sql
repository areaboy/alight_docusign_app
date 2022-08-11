-- MariaDB dump 10.19  Distrib 10.4.19-MariaDB, for Win64 (AMD64)
--
-- Host: localhost    Database: docusign_db
-- ------------------------------------------------------
-- Server version	10.4.19-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `fullname` varchar(200) DEFAULT NULL,
  `msg` text DEFAULT NULL,
  `timing` varchar(20) DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `title` text DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (3,'Alight-NGO..','Message from Alight Humanitarian Services, hello. Email: Alight','1659510703','sms','14','SMS from Alight Humanitarian Services'),(5,'Alight-NGO..','Message from Alight Humanitarian Services, hi. Sender: Alight','1659911666','sms','33','SMS from Alight Humanitarian Services');
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notification`
--

DROP TABLE IF EXISTS `notification`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notification` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `post_id` varchar(255) CHARACTER SET utf8 NOT NULL,
  `userid` int(30) DEFAULT NULL,
  `fullname` varchar(100) DEFAULT NULL,
  `photo` text DEFAULT NULL,
  `user_rank` varchar(100) DEFAULT NULL,
  `reciever_id` varchar(100) DEFAULT NULL,
  `status` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `timing` varchar(100) DEFAULT NULL,
  `title` varchar(255) CHARACTER SET utf8 NOT NULL,
  `title_seo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notification`
--

LOCK TABLES `notification` WRITE;
/*!40000 ALTER TABLE `notification` DISABLE KEYS */;
/*!40000 ALTER TABLE `notification` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `refugees`
--

DROP TABLE IF EXISTS `refugees`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `refugees` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `reg_no` varchar(200) DEFAULT NULL,
  `case_no` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `lastname` varchar(200) DEFAULT NULL,
  `firstname` varchar(200) DEFAULT NULL,
  `middlename` varchar(200) DEFAULT NULL,
  `dob` varchar(200) DEFAULT NULL,
  `pob` varchar(200) DEFAULT NULL,
  `address` varchar(200) DEFAULT NULL,
  `gender` varchar(200) DEFAULT NULL,
  `citizenship` varchar(200) DEFAULT NULL,
  `ethinicity` varchar(200) DEFAULT NULL,
  `status` varchar(200) DEFAULT NULL,
  `religion` varchar(200) DEFAULT NULL,
  `country` varchar(200) DEFAULT NULL,
  `timing` varchar(200) DEFAULT NULL,
  `lat` float(10,6) DEFAULT NULL,
  `lng` float(10,6) DEFAULT NULL,
  `language` varchar(200) DEFAULT NULL,
  `other_language` varchar(200) DEFAULT NULL,
  `name_doc` varchar(200) DEFAULT NULL,
  `doc_no` varchar(200) DEFAULT NULL,
  `doc_type` varchar(200) DEFAULT NULL,
  `place_issuance` varchar(200) DEFAULT NULL,
  `issuing_authority` varchar(200) DEFAULT NULL,
  `sms_count` varchar(20) DEFAULT NULL,
  `email_count` varchar(20) DEFAULT NULL,
  `phone_no` varchar(20) DEFAULT NULL,
  `needy` varchar(10) DEFAULT NULL,
  `comments` text DEFAULT NULL,
  `house_type` varchar(200) DEFAULT NULL,
  `people` varchar(200) DEFAULT NULL,
  `pet` varchar(200) DEFAULT NULL,
  `smokers` varchar(200) DEFAULT NULL,
  `city` varchar(200) DEFAULT NULL,
  `userid` varchar(100) DEFAULT NULL,
  `photo` varchar(200) DEFAULT NULL,
  `docusign_envelope_id` text DEFAULT NULL,
  `docusign_account_id` varchar(100) DEFAULT NULL,
  `docusign_base_url` varchar(300) DEFAULT NULL,
  `document_name` varchar(300) DEFAULT NULL,
  `document_id` varchar(100) DEFAULT NULL,
  `document_status` varchar(50) DEFAULT NULL,
  `download_filename` varchar(200) DEFAULT NULL,
  `download_filename_summary` varchar(200) DEFAULT NULL,
  `download_status` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `refugees`
--

LOCK TABLES `refugees` WRITE;
/*!40000 ALTER TABLE `refugees` DISABLE KEYS */;
INSERT INTO `refugees` VALUES (30,'1659909006','16599090065416','esedofredrick@gmail.com','Ann','Ball','Joy','1959-06-22','Ukraine','15 km of Zhytomyr highway 3179 kiev city, ukraine','Female','Ukraine','Ukrainian','Closed','Christian','Ukraine','1659909338',50.254650,28.658667,'Ukrainian','English','Ann Ball Joy','12345','National Identity card','Ukraine','Ukranian Immigration','0','0','+2349135775247','1','',NULL,NULL,NULL,NULL,NULL,NULL,'1659909336.png','10eac564-aa21-4c90-9230-9ac316344581','0570c4c7-db1b-4804-a7e3-edea7593a5f4','https://demo.docusign.net','Ball1659909006.pdf','1659909328','Completed','0','0',NULL),(31,'1659909385','16599093856971','esedofredrick@gmail.com','Richard','Anthony','Carrots','1959-06-22','Ukraine','15 km of Zhytomyr highway 3179 kiev city, ukraine','Male','Ukraine','Ukrainian','Open','Christian','Ukraine','1659909523',50.254650,28.658667,'Ukrainian','English','Richard Anthony','12345','National Identity card','Ukraine','Ukranian Immigration','0','0','+2349135775247','1','',NULL,NULL,NULL,NULL,NULL,NULL,'1659909522.png','1f87d7dd-88c3-40a8-a121-b43b7e2127a4','0570c4c7-db1b-4804-a7e3-edea7593a5f4','https://demo.docusign.net','Anthony1659909385.pdf','1659909515','Sent','0','0',NULL),(32,'1659909385','16599093856971','esedofredrick@gmail.com','Venus ','Johnson','Lucy','1959-06-22','Ukraine','15 km of Zhytomyr highway 3179 kiev city, ukraine','Male','Ukraine','Ukrainian','Open','Christian','Ukraine','1659910078',50.254650,28.658667,'Ukrainian','English','Venus Johnson Lucy','12345','National Identity card','Ukraine','Ukranian Immigration','0','0','+2349135775247','1','',NULL,NULL,NULL,NULL,NULL,NULL,'1659910077.png','7254b76a-5763-45bc-bc2b-f5e753b83330','0570c4c7-db1b-4804-a7e3-edea7593a5f4','https://demo.docusign.net','Johnson1659909385.pdf','1659910070','Completed','Venus _Johnson1659909385.pdf.pdf','Venus _Summary.pdf','ok'),(33,'1659910528','16599105289415','esedofredrick@gmail.com','Esedo','Fredrick','Chijioke','1959-06-22','Ukraine','15 km of Zhytomyr highway 3179 kiev city, ukraine','Male','Ukraine','Ukrainian','Closed','Christian','Ukraine','1659911464',50.254650,28.658667,'Ukrainian','English','Esedo Fredrick Chijioke','12345','National Identity card','Ukraine','Ukranian Immigration','1','0','+2349135775247','1','',NULL,NULL,NULL,NULL,NULL,NULL,'1659911463.png','ef051d24-abcb-4b6e-b0b3-6d73fd9c0fe9','0570c4c7-db1b-4804-a7e3-edea7593a5f4','https://demo.docusign.net','Fredrick1659910528.pdf','1659911455','Completed','0','0',NULL);
/*!40000 ALTER TABLE `refugees` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `all_refugee` varchar(30) DEFAULT NULL,
  `open_refugee` varchar(30) DEFAULT NULL,
  `closed_refugee` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (3,'4','2','2');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(200) DEFAULT NULL,
  `fullname` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `created_time` varchar(200) DEFAULT NULL,
  `timing` varchar(200) DEFAULT NULL,
  `phone_no` varchar(200) DEFAULT NULL,
  `status` varchar(30) DEFAULT NULL,
  `access_token` text DEFAULT NULL,
  `refresh_token` text DEFAULT NULL,
  `expires_in` varchar(100) DEFAULT NULL,
  `account_id` varchar(200) DEFAULT NULL,
  `base_uri` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'docusign_db'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-08-09 21:46:10
