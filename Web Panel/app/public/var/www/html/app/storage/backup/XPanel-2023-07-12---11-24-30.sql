-- MySQL dump 10.19  Distrib 10.3.38-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: XPanel
-- ------------------------------------------------------
-- Server version	10.3.38-MariaDB-0ubuntu0.20.04.1

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
-- Table structure for table `ApiToken`
--

DROP TABLE IF EXISTS `ApiToken`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ApiToken` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `Token` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Allowips` varchar(100) NOT NULL,
  `enable` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ApiToken`
--

LOCK TABLES `ApiToken` WRITE;
/*!40000 ALTER TABLE `ApiToken` DISABLE KEYS */;
INSERT INTO `ApiToken` VALUES (1,'2DO8Cqz9BBpjkAOe','est','0.0.0.0/0','true');
/*!40000 ALTER TABLE `ApiToken` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Traffic`
--

DROP TABLE IF EXISTS `Traffic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Traffic` (
  `user` varchar(100) NOT NULL,
  `download` varchar(100) NOT NULL,
  `upload` varchar(100) NOT NULL,
  `total` varchar(100) NOT NULL,
  PRIMARY KEY (`user`),
  UNIQUE KEY `reference_unique` (`user`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Traffic`
--

LOCK TABLES `Traffic` WRITE;
/*!40000 ALTER TABLE `Traffic` DISABLE KEYS */;
INSERT INTO `Traffic` VALUES ('ali','15112','22620','37732'),('alorezap','101189','83152','184341'),('amirr3','101889','110521','212410'),('arash','13','0','13'),('arash2','780','709','1489'),('ashkan','90457','59528','149985'),('ashkanm2','6888','6224','13112'),('ashkanm4','23064','24256','47320'),('baba','0','0','0'),('bahremand','81679','92905','174584'),('behzad','102383','93726','196109'),('dostkani1','22177','8422','30599'),('dostkani2','901','5118','6019'),('douskani','65025','52065','117090'),('esmaeil','36179','43719','79898'),('faridn','49436','42853','92289'),('hamed2','65737','56109','121846'),('hamedm2','131346','128958','260304'),('hani3','7237','4796','12033'),('hgholipour2','5963','3840','9803'),('isa','29473','30008','59481'),('javan4','108901','76478','185379'),('javan6','12610','9759','22369'),('javan7','17347','31851','49198'),('mahdi2','39659','50821','90480'),('mahdif2','118914','127377','246291'),('matin','25177','13332','38509'),('mdab','50340','62065','112405'),('miladek','29397','26660','56057'),('miladek2','30358','18255','48613'),('milads10','41616','47103','88719'),('milads11','97275','75410','172685'),('milads12','17956','31762','49718'),('milads3','4156','4605','8761'),('milads4','3735','4080','7815'),('milads5','51','39','90'),('milads8','52750','37123','89873'),('milads9','73498','39856','113354'),('mohsenh','6816','8633','15449'),('mpourshahidi2','48767','37339','86106'),('mshahidi','3136','2840','5976'),('myaghouti2','13309','27621','40930'),('naeimf','45243','54896','100139'),('pedram3','170693','161336','332029'),('peyman2','495','1662','2157'),('rezaf','1542','2522','4064'),('rzandaei','18564','15789','34353'),('samiyar','110942','118592','229534'),('samiyar2','1136','6321','7457'),('samiyar4','15212','21159','36371'),('samiyar6','19325','12889','32214'),('shahin','57504','45955','103459'),('sina2','30296','34395','64691'),('sina3','17637','17264','34901'),('sinaf','12222','9395','21617'),('taghi2','106213','85100','191313'),('tahat','36164','44903','81067'),('test2','13721','17783','31504'),('test3','8489','8957','17446'),('tohidj2','74224','61026','135250'),('vahid','127741','146050','273791'),('yaderd2','0','0','0'),('yazdan2','9795','8279','18074'),('yazdan3','89651','58968','148619'),('yazdan4','11887','12678','24565'),('zahra','280','343','623'),('zahrad','195989','202095','398084');
/*!40000 ALTER TABLE `Traffic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username_u` varchar(100) NOT NULL,
  `password_u` varchar(100) DEFAULT NULL,
  `permission_u` varchar(100) DEFAULT NULL,
  `credit_u` varchar(250) DEFAULT NULL,
  `condition_u` varchar(100) DEFAULT NULL,
  `login_key` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (2,'ali','1245','admin','0','active','ali:XPlogin1684874742');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ip_list`
--

DROP TABLE IF EXISTS `ip_list`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ip_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL,
  `ip_status` varchar(100) DEFAULT NULL,
  `ip_desc` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ip_list`
--

LOCK TABLES `ip_list` WRITE;
/*!40000 ALTER TABLE `ip_list` DISABLE KEYS */;
/*!40000 ALTER TABLE `ip_list` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(100) NOT NULL,
  `timestamp` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
INSERT INTO `requests` VALUES (1,'37.63.195.174','1689183327'),(2,'37.63.195.174','1689183359'),(3,'37.63.195.174','1689183388'),(4,'37.63.195.174','1689183685'),(5,'37.63.195.174','1689183770'),(6,'37.63.195.174','1689183819'),(7,'37.63.195.174','1689183829'),(8,'37.63.195.174','1689183865'),(9,'37.63.195.174','1689183934'),(10,'37.63.195.174','1689183939'),(11,'37.63.195.174','1689183963'),(12,'37.63.195.174','1689184890'),(13,'37.63.195.174','1689184980'),(14,'37.63.195.174','1689185014'),(15,'37.63.195.174','1689185048'),(16,'37.63.195.174','1689185143'),(17,'37.63.195.174','1689185184'),(18,'37.63.195.174','1689185196'),(19,'37.63.195.174','1689185243'),(20,'37.63.195.174','1689185255'),(21,'37.63.195.174','1689185303'),(22,'37.63.195.174','1689188070');
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servers`
--

DROP TABLE IF EXISTS `servers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `servers` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `serverip` varchar(100) NOT NULL,
  `serverlocation` varchar(100) NOT NULL,
  `serverusername` varchar(100) NOT NULL,
  `serverpassword` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servers`
--

LOCK TABLES `servers` WRITE;
/*!40000 ALTER TABLE `servers` DISABLE KEYS */;
/*!40000 ALTER TABLE `servers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `setting`
--

DROP TABLE IF EXISTS `setting`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `setting` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `adminuser` varchar(30) NOT NULL,
  `adminpassword` varchar(30) DEFAULT NULL,
  `sshport` varchar(30) DEFAULT NULL,
  `tgtoken` varchar(100) DEFAULT NULL,
  `tgid` varchar(30) DEFAULT NULL,
  `language` varchar(30) DEFAULT NULL,
  `permissions` varchar(300) DEFAULT NULL,
  `credit` varchar(300) DEFAULT NULL,
  `multiuser` varchar(100) DEFAULT NULL,
  `ststus_multiuser` varchar(100) DEFAULT NULL,
  `login_key` varchar(100) DEFAULT NULL,
  `dropb_tls_port` varchar(100) DEFAULT NULL,
  `ssh_tls_port` varchar(100) DEFAULT NULL,
  `dropb_port` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`adminuser`),
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `setting`
--

LOCK TABLES `setting` WRITE;
/*!40000 ALTER TABLE `setting` DISABLE KEYS */;
INSERT INTO `setting` VALUES (1,'Alireza','Alireza2020','22',NULL,NULL,NULL,NULL,NULL,'on',NULL,'Alireza:XPlogin1689185255',NULL,NULL,NULL);
/*!40000 ALTER TABLE `setting` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tgmessage`
--

DROP TABLE IF EXISTS `tgmessage`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tgmessage` (
  `id` enum('1') NOT NULL,
  `account1m` varchar(900) DEFAULT NULL,
  `account2m` varchar(900) DEFAULT NULL,
  `account3m` varchar(900) DEFAULT NULL,
  `account6m` varchar(900) DEFAULT NULL,
  `account12m` varchar(900) DEFAULT NULL,
  `contactadmin` varchar(900) DEFAULT NULL,
  `rahnama` varchar(900) DEFAULT NULL,
  `tamdid` varchar(900) DEFAULT NULL,
  UNIQUE KEY `id` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tgmessage`
--

LOCK TABLES `tgmessage` WRITE;
/*!40000 ALTER TABLE `tgmessage` DISABLE KEYS */;
INSERT INTO `tgmessage` VALUES ('1','','','','','','','','');
/*!40000 ALTER TABLE `tgmessage` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `mobile` varchar(100) DEFAULT NULL,
  `multiuser` varchar(100) DEFAULT NULL,
  `startdate` varchar(100) DEFAULT NULL,
  `finishdate` varchar(100) DEFAULT NULL,
  `finishdate_one_connect` varchar(100) DEFAULT NULL,
  `customer_user` varchar(100) DEFAULT NULL,
  `enable` varchar(30) DEFAULT NULL,
  `traffic` varchar(100) DEFAULT NULL,
  `referral` varchar(100) DEFAULT NULL,
  `info` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `reference_unique` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=112 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'ali','456520','info.bestgraph@gmail.com','09190215387','2','2023-04-14','','',NULL,'true','0','',''),(2,'yazdan3','354786','info.bestgraph@gmail.com','09190215397','1','2023-04-14','2023-06-18',NULL,NULL,'expired','0','',''),(4,'bahremand','441209','info.bestgraph@gmail.com','09190215397','1','2023-04-14','2023-7-19',NULL,NULL,'true','0','','پرستو بهرمند'),(5,'samiyar','345325','info.bestgraph@gmail.com','09190215397','2','2023-04-15','2023-7-19','',NULL,'true','0','',''),(6,'behzad','206753','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-7-19',NULL,NULL,'true','0','',''),(7,'yazdan2','389365','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-05-15',NULL,NULL,'expired','0','',''),(8,'hgholipour2','447766','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-05-15',NULL,NULL,'expired','0','','حسین قلی پور'),(9,'pedram3','432678','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-07-31','',NULL,'true','0','',''),(10,'milads3','332096','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16',NULL,NULL,'expired','0','',''),(11,'milads4','267785','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16',NULL,NULL,'expired','0','',''),(12,'milads5','453467','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16',NULL,NULL,'expired','0','',''),(13,'vahid','334565','info.bestgraph@gmail.com','09190215397','4','2023-04-17','2023-12-31',NULL,NULL,'true','0','',''),(14,'shahin','409087','info.bestgraph@gmail.com','09190215397','3','2023-04-17','2023-7-31',NULL,NULL,'true','0','',''),(15,'arash','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2024-02-29',NULL,NULL,'true','0','',''),(16,'arash2','330989','info.bestgraph@gmail.com','09190215397','5','2023-04-17','2024-02-29',NULL,NULL,'true','0','',''),(17,'zahra','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-05-31',NULL,NULL,'expired','0','',''),(18,'mahdi2','332099','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-7-22',NULL,NULL,'true','0','',''),(19,'hani3','443781','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-05-17','',NULL,'expired','0','',''),(22,'alorezap','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-20','',NULL,NULL,'true','0','',''),(23,'mshahidi','202080','info.bestgraph@gmail.com','09190215397','1','2023-04-20','2023-05-20',NULL,NULL,'expired','0','',''),(24,'ashkan','202020','info.bestgraph@gmail.com','09190215397','1','2023-04-21','2023-11-17',NULL,NULL,'true','0','',''),(25,'samiyar4','225678','info.bestgraph@gmail.com','09190215397','2','2023-04-21','2023-7-2',NULL,NULL,'expired','0','',''),(26,'hamed2','458745','info.bestgraph@gmail.com','09190215387','1','2023-04-23','2023-09-30',NULL,NULL,'true','0','','دوست حامد صفری'),(28,'mpourshahidi2','565623','info.bestgraph@gmail.com','09190215397','1','2023-04-24','2023-06-24',NULL,NULL,'expired','0','',''),(29,'samiyar2','556476','info.bestgraph@gmail.com','09190215397','1','2023-04-25','2023-6-25',NULL,NULL,'expired','0','','خانم دوستکانی'),(47,'hamedm2','334563','info.bestgraph@gmail.com','9190215397','1','2023-04-30','2023-9-2','',NULL,'true','0','',''),(49,'yazdan4','456378','info.bestgraph@gmail.com','09190215397','1','2023-05-03','2023-06-04','',NULL,'expired','0','',''),(50,'rezaf','109090','','','1','2023-07-10','2023-08-09','',NULL,'true','0','',''),(51,'mahdif2','334265','info.bestgraph@gmail.com','09190215397','1','2023-05-07','2023-09-30','',NULL,'true','0','',''),(53,'mdab','109088','info.bestgraph@gmail.com','09190215397','1','2023-05-08','2023-12-31','',NULL,'true','0','',''),(57,'myaghouti2','448908','info.bestgraph@gmail.com','09190215397','1','2023-05-11','2023-12-30','',NULL,'true','0','',''),(58,'taghi2','347687','info.bestgraph@gmail.com','9190215397','1','2023-05-11','2023-08-12','',NULL,'true','0','',''),(59,'tahat','101010','info.bestgraph@gmail.com','9190215397','1','2023-05-11','','',NULL,'false','0','',''),(60,'rzandaei','454567','','','1','2023-05-18','2023-11-30','',NULL,'true','0','',''),(61,'douskani','345476','info.bestgraph@gmail.com','09190215397','1','2023-05-19','2023-08-20','',NULL,'true','0','',''),(62,'mohsenh','856632','info.bestgraph@gmail.com','09190215397','1','2023-05-19','2023-06-19','',NULL,'expired','0','',''),(63,'sinaf','345476','info.bestgraph@gmail.com','09190215397','1','2023-05-20','2024-02-29','',NULL,'true','0','',''),(65,'esmaeil','458709','info.bestgraph@gmail.com','09190215397','1','2023-05-20','2023-08-20','',NULL,'true','0','',''),(66,'javan4','568792','info.bestgraph@gmail.com','09190215387','2','2023-05-21','2023-09-18','120',NULL,'true','0','',''),(67,'amirr3','547690','info.bestgraph@gmail.com','09190215397','1','2023-05-21','2023-7-21','30',NULL,'true','0','',''),(76,'javan6','342686','info.bestgraph@gmail.com','9190215397','1','2023-07-05','2023-08-04','',NULL,'true','0','',''),(77,'yaderd2','453487','info.bestgraph@gmail.com','9190215397','2','2023-07-10','2023-08-09','',NULL,'false','0','',''),(78,'javan7','443876','info.bestgraph@gmail.com','9190215397','1','2023-07-04','2023-08-03','',NULL,'true','0','',''),(80,'ashkanm4','126509','info.bestgraph@gmail.com','9190215397','1','2023-06-04','2023-7-5','',NULL,'expired','0','','خواهر اشکان'),(81,'zahrad','101010','info.bestgraph@gmail.com','09190215387','1','2023-06-07','','',NULL,'true','0','',''),(83,'tohidj2','234389','info.bestgraph@gmail.com','9190215397','1','2023-06-10','2023-9-11','',NULL,'true','0','','خانم توحید جنگلی'),(84,'samiyar6','443558','info.bestgraph@gmail.com','9190215397','1','2023-06-10','2023-7-11','',NULL,'expired','0','',''),(85,'milads8','547954','info.bestgraph@gmail.com','9190215397','1','2023-06-14','2023-7-15','',NULL,'true','0','',''),(86,'milads9','546987','info.bestgraph@gmail.com','9190215397','1','2023-06-14','2023-7-15','',NULL,'true','0','',''),(87,'milads10','564689','info.bestgraph@gmail.com','9190215397','1','2023-06-16','2023-7-18','',NULL,'true','0','',''),(88,'naeimf','450987','info.bestgraph@gmail.com','9190215397','1','2023-06-17','2023-7-18','',NULL,'true','0','','نعیم فیضی'),(89,'peyman2','457689','info.bestgraph@gmail.com','9190215397','1','2023-06-18','2023-7-21','',NULL,'true','0','','رحمان حسن پور'),(90,'baba','1010','','','1','2023-06-18','','',NULL,'true','0','',''),(91,'milads11','547689','info.bestgraph@gmail.com','9190215397','1','2023-06-18','2023-7-19','',NULL,'true','0','',''),(92,'faridn','449867','info.bestgraph@gmail.com','9190215397','1','2023-06-19','2023-7-20','',NULL,'true','0','',''),(93,'milads12','547898','info.bestgraph@gmail.com','9190215397','1','2023-06-21','2023-7-22','',NULL,'true','0','',''),(94,'isa','509807','info.bestgraph@gmail.com','9190215397','1','2023-06-24','2023-7-25','',NULL,'true','0','',''),(95,'dostkani1','457689','info.bestgraph@gmail.com','9190215397','1','2023-06-25','2023-7-26','',NULL,'true','0','','دوستکانی سردخانه'),(96,'dostkani2','345478','info.bestgraph@gmail.com','9190215397','1','2023-06-25','2023-7-26','',NULL,'true','0','','دوستکانی سردخانه'),(97,'sina2','456578','info.bestgraph@gmail.com','9190215397','1','2023-06-28','2023-07-30','','Alireza','true','0','',''),(98,'miladek','230986','info.bestgraph@gmail.com','9190215397','1','2023-06-30','2023-07-20','','Alireza','true','0','',''),(99,'miladek2','335480','info.bestgraph@gmail.com','9190215397','1','2023-07-01','2023-07-31','','Alireza','true','0','',''),(100,'ashkanm2','437809','info.bestgraph@gmail.com','9190215397','1','2023-07-02','2023-08-02','','Alireza','true','0','','خانم اشکان'),(101,'sina3','657898','info.bestgraph@gmail.com','9190215397','1','2023-07-03','2023-10-04','','Alireza','true','0','',''),(103,'matin','347865','info.bestgraph@gmail.com','9190215397','1','2023-07-06','2023-08-06','','Alireza','true','0','','پسر دایی سینا');
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

-- Dump completed on 2023-07-12 20:54:30
