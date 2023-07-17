-- MariaDB dump 10.19  Distrib 10.6.12-MariaDB, for debian-linux-gnu (x86_64)
--
-- Host: localhost    Database: XPanel_plus
-- ------------------------------------------------------
-- Server version	10.6.12-MariaDB-0ubuntu0.22.10.1

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
-- Table structure for table `admins`
--

DROP TABLE IF EXISTS `admins`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `admins` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `permission` varchar(255) NOT NULL,
  `credit` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `admins`
--

LOCK TABLES `admins` WRITE;
/*!40000 ALTER TABLE `admins` DISABLE KEYS */;
INSERT INTO `admins` VALUES (1,'alireza','$2y$10$6yaWiA2F1sFaTEAogtlTeekLteqcoGRI8DHMKZpp74ZOJs/XfZ7y6','admin','','active',NULL,'2023-07-15 08:02:30');
/*!40000 ALTER TABLE `admins` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `apis`
--

DROP TABLE IF EXISTS `apis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `apis` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `description` varchar(255) DEFAULT NULL,
  `allow_ip` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `apis`
--

LOCK TABLES `apis` WRITE;
/*!40000 ALTER TABLE `apis` DISABLE KEYS */;
/*!40000 ALTER TABLE `apis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `iplists`
--

DROP TABLE IF EXISTS `iplists`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `iplists` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `ip_status` varchar(255) NOT NULL,
  `ip_desc` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `iplists`
--

LOCK TABLES `iplists` WRITE;
/*!40000 ALTER TABLE `iplists` DISABLE KEYS */;
/*!40000 ALTER TABLE `iplists` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (45,'2014_10_12_000000_create_users_table',1),(46,'2014_10_12_100000_create_password_reset_tokens_table',1),(47,'2014_10_12_100000_create_password_resets_table',1),(48,'2019_08_19_000000_create_failed_jobs_table',1),(49,'2019_12_14_000001_create_personal_access_tokens_table',1),(50,'2023_07_11_010147_create_traffic_table',1),(51,'2023_07_11_014755_create_admins_table',1),(52,'2023_07_11_014902_create_apis_table',1),(53,'2023_07_11_015003_create_iplists_table',1),(54,'2023_07_11_015151_create_requests_table',1),(55,'2023_07_11_015228_create_settings_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_reset_tokens`
--

DROP TABLE IF EXISTS `password_reset_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_reset_tokens`
--

LOCK TABLES `password_reset_tokens` WRITE;
/*!40000 ALTER TABLE `password_reset_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_reset_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `requests`
--

DROP TABLE IF EXISTS `requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `requests` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(255) NOT NULL,
  `timestamp` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `requests`
--

LOCK TABLES `requests` WRITE;
/*!40000 ALTER TABLE `requests` DISABLE KEYS */;
/*!40000 ALTER TABLE `requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `ssh_port` varchar(255) DEFAULT NULL,
  `tls_port` varchar(255) DEFAULT NULL,
  `t_token` varchar(255) DEFAULT NULL,
  `t_id` varchar(255) DEFAULT NULL,
  `language` varchar(255) DEFAULT NULL,
  `multiuser` varchar(255) DEFAULT NULL,
  `ststus_multiuser` varchar(255) DEFAULT NULL,
  `home_url` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
INSERT INTO `settings` VALUES (1,NULL,NULL,'6189771898:AAEBi2jlZDhA7XDTg65fTlZeiFbmflsThiM','555',NULL,'deactive',NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `traffic`
--

DROP TABLE IF EXISTS `traffic`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `traffic` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `download` varchar(255) NOT NULL,
  `upload` varchar(255) NOT NULL,
  `total` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=164 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `traffic`
--

LOCK TABLES `traffic` WRITE;
/*!40000 ALTER TABLE `traffic` DISABLE KEYS */;
INSERT INTO `traffic` VALUES (1,'hnh','0','0','0',NULL,NULL),(2,'hvh','0','0','0',NULL,NULL),(3,'5100','0','0','0',NULL,NULL),(4,'5100','0','0','0',NULL,NULL),(5,'5100','0','0','0',NULL,NULL),(6,'5100','0','0','0',NULL,NULL),(7,'5100','0','0','0',NULL,NULL),(8,'xpuser100','0','0','0',NULL,NULL),(9,'xpuser100','0','0','0',NULL,NULL),(10,'xpuser100','0','0','0',NULL,NULL),(11,'xpuser101','0','0','0',NULL,NULL),(12,'xpuser102','0','0','0',NULL,NULL),(13,'fggf','0','0','0',NULL,NULL),(14,'ddd','0','0','0',NULL,NULL),(15,'dfv','0','0','0',NULL,NULL),(16,'km','0','0','0',NULL,NULL),(17,'km1','0','0','0',NULL,NULL),(18,'km2','0','0','0',NULL,NULL),(19,'km3','0','0','0',NULL,NULL),(20,'km4','0','0','0',NULL,NULL),(21,'km5','0','0','0',NULL,NULL),(22,'km6','0','0','0',NULL,NULL),(23,'km7','0','0','0',NULL,NULL),(24,'jm8','0','0','0',NULL,NULL),(25,'km9','0','0','0',NULL,NULL),(26,'km10','0','0','0',NULL,NULL),(27,'ftf','0','0','0',NULL,NULL),(28,'ali','15112','22620','37732',NULL,NULL),(29,'alorezap','101189','83152','184341',NULL,NULL),(30,'amirr3','101889','110521','212410',NULL,NULL),(31,'arash','13','0','13',NULL,NULL),(32,'arash2','780','709','1489',NULL,NULL),(33,'ashkan','90457','59528','149985',NULL,NULL),(35,'ashkanm4','23064','24256','47320',NULL,NULL),(36,'baba','0','0','0',NULL,NULL),(37,'bahremand','81679','92905','174584',NULL,NULL),(38,'behzad','102383','93726','196109',NULL,NULL),(39,'dostkani1','22177','8422','30599',NULL,NULL),(40,'dostkani2','901','5118','6019',NULL,NULL),(41,'douskani','65025','52065','117090',NULL,NULL),(42,'esmaeil','36179','43719','79898',NULL,NULL),(43,'faridn','49436','42853','92289',NULL,NULL),(44,'hamed2','65737','56109','121846',NULL,NULL),(45,'hamedm2','131346','128958','260304',NULL,NULL),(46,'hani3','7237','4796','12033',NULL,NULL),(47,'hgholipour2','5963','3840','9803',NULL,NULL),(48,'isa','29473','30008','59481',NULL,NULL),(49,'javan4','108901','76478','185379',NULL,NULL),(50,'javan6','12610','9759','22369',NULL,NULL),(51,'javan7','17347','31851','49198',NULL,NULL),(52,'mahdi2','39659','50821','90480',NULL,NULL),(53,'mahdif2','118914','127377','246291',NULL,NULL),(55,'mdab','50340','62065','112405',NULL,NULL),(56,'miladek','29397','26660','56057',NULL,NULL),(57,'miladek2','30358','18255','48613',NULL,NULL),(58,'milads10','41616','47103','88719',NULL,NULL),(59,'milads11','97275','75410','172685',NULL,NULL),(60,'milads12','17956','31762','49718',NULL,NULL),(61,'milads3','4156','4605','8761',NULL,NULL),(62,'milads4','3735','4080','7815',NULL,NULL),(63,'milads5','51','39','90',NULL,NULL),(64,'milads8','52750','37123','89873',NULL,NULL),(65,'milads9','73498','39856','113354',NULL,NULL),(66,'mohsenh','6816','8633','15449',NULL,NULL),(67,'mpourshahidi2','48767','37339','86106',NULL,NULL),(68,'mshahidi','3136','2840','5976',NULL,NULL),(69,'myaghouti2','13309','27621','40930',NULL,NULL),(70,'naeimf','45243','54896','100139',NULL,NULL),(71,'pedram3','170693','161336','332029',NULL,NULL),(72,'peyman2','495','1662','2157',NULL,NULL),(73,'rezaf','1542','2522','4064',NULL,NULL),(74,'rzandaei','18564','15789','34353',NULL,NULL),(75,'samiyar','110942','118592','229534',NULL,NULL),(76,'samiyar2','1136','6321','7457',NULL,NULL),(77,'samiyar4','15212','21159','36371',NULL,NULL),(78,'samiyar6','19325','12889','32214',NULL,NULL),(79,'shahin','57504','45955','103459',NULL,NULL),(80,'sina2','30296','34395','64691',NULL,NULL),(82,'sinaf','12222','9395','21617',NULL,NULL),(83,'taghi2','106213','85100','191313',NULL,NULL),(84,'tahat','36164','44903','81067',NULL,NULL),(85,'test2','13721','17783','31504',NULL,NULL),(86,'test3','8489','8957','17446',NULL,NULL),(87,'tohidj2','74224','61026','135250',NULL,NULL),(88,'vahid','127741','146050','273791',NULL,NULL),(89,'yaderd2','0','0','0',NULL,NULL),(90,'yazdan2','9795','8279','18074',NULL,NULL),(91,'yazdan3','89651','58968','148619',NULL,NULL),(92,'yazdan4','11887','12678','24565',NULL,NULL),(93,'zahra','280','343','623',NULL,NULL),(97,'zahrad','195989','202095','398084\n',NULL,NULL);
/*!40000 ALTER TABLE `traffic` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  `multiuser` varchar(255) NOT NULL,
  `start_date` varchar(255) DEFAULT NULL,
  `end_date` varchar(255) DEFAULT NULL,
  `date_one_connect` varchar(255) DEFAULT NULL,
  `customer_user` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL,
  `traffic` varchar(255) NOT NULL,
  `referral` varchar(255) DEFAULT NULL,
  `desc` longtext DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=159 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'hnh','yuEAzWQh',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(2,'hvh','dl7vD0TF',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(3,'5100','sjg40uz2trdvkyh3q157c8mwefnoa69xlbip','','','1','2023-07-12','2023-07-15','30','1','active','0','','',NULL,NULL),(4,'5100','xv8o4dpbnlcjwse73hk02yrgmt51i9qafu6z','','','1','2023-07-12','2023-07-15','30','1','active','0','','',NULL,NULL),(5,'5100','wntv4u0se6pgaj2o9qzxyhrkib31mlc5f8d7','','','1','2023-07-12','2023-07-15','30','1','active','0','','',NULL,NULL),(6,'5100','xt0kljwzf2o7vg951hdc6ypm8ebq3niusar4','','','1','2023-07-12','2023-07-15','30','1','active','0','','',NULL,NULL),(7,'5100','ph24bkzd7oeiw1vcqnjt6lr0s8am93uyx5fg','','','1','2023-07-12','2023-07-15','30','1','active','0','','',NULL,NULL),(8,'xpuser100','405178','','','1','','','30','1','active','0','','',NULL,NULL),(9,'xpuser100','732681','','','1','','','30','1','active','0','','',NULL,NULL),(10,'xpuser100','417350','','','1','','','30','1','active','0','','',NULL,NULL),(11,'xpuser101','948316','','','1','','','30','1','active','0','','',NULL,NULL),(12,'xpuser102','UIw03Npe',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(13,'fggf','ytYr7MAT',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(14,'ddd','VBuxhots',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(15,'dfv','mi9ZzLwW',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(16,'km','3hG1P8ws',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(17,'km1','C0pxkPa1',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(18,'km2','Di16Stw2',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(19,'km3','RVCAyXnj',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(20,'km4','SIckLJMW',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(21,'km5','XyCYnhNb',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(22,'km6','jf9dZxGv',NULL,NULL,'1','2023-07-12',NULL,NULL,'1','active','0','',NULL,NULL,NULL),(23,'km7','45lDbnjw','info.bestgraph@gmail.com','09190215387','1','2023-07-12','2023-07-17',NULL,'1','active','0','',NULL,NULL,NULL),(27,'ftf','Wa8O32S1',NULL,NULL,'1','2023-07-13',NULL,NULL,'alireza','active','0','',NULL,NULL,NULL),(28,'1','ali','456520','info.bestgraph@gmail.com','09190215387','2','2023-04-14','','','NULL','true','0','',NULL,NULL),(29,'2','yazdan3','354786','info.bestgraph@gmail.com','09190215397','1','2023-04-14','2023-06-18','NULL','NULL','expired','0','',NULL,NULL),(30,'4','bahremand','441209','info.bestgraph@gmail.com','09190215397','1','2023-04-14','2023-7-19','NULL','NULL','true','0','',NULL,NULL),(31,'5','samiyar','345325','info.bestgraph@gmail.com','09190215397','2','2023-04-15','2023-7-19','','NULL','true','0','',NULL,NULL),(32,'6','behzad','206753','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-7-19','NULL','NULL','true','0','',NULL,NULL),(33,'7','yazdan2','389365','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-05-15','NULL','NULL','expired','0','',NULL,NULL),(34,'8','hgholipour2','447766','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-05-15','NULL','NULL','expired','0','',NULL,NULL),(35,'9','pedram3','432678','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-07-31','','NULL','true','0','',NULL,NULL),(36,'10','milads3','332096','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16','NULL','NULL','expired','0','',NULL,NULL),(37,'11','milads4','267785','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16','NULL','NULL','expired','0','',NULL,NULL),(38,'12','milads5','453467','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16','NULL','NULL','expired','0','',NULL,NULL),(39,'13','vahid','334565','info.bestgraph@gmail.com','09190215397','4','2023-04-17','2023-12-31','NULL','NULL','true','0','',NULL,NULL),(40,'14','shahin','409087','info.bestgraph@gmail.com','09190215397','3','2023-04-17','2023-7-31','NULL','NULL','true','0','',NULL,NULL),(41,'15','arash','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2024-02-29','NULL','NULL','true','0','',NULL,NULL),(42,'16','arash2','330989','info.bestgraph@gmail.com','09190215397','5','2023-04-17','2024-02-29','NULL','NULL','true','0','',NULL,NULL),(43,'17','zahra','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-05-31','NULL','NULL','expired','0','',NULL,NULL),(44,'18','mahdi2','332099','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-7-22','NULL','NULL','true','0','',NULL,NULL),(45,'19','hani3','443781','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-05-17','','NULL','expired','0','',NULL,NULL),(46,'22','alorezap','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-20','','NULL','NULL','true','0','',NULL,NULL),(47,'23','mshahidi','202080','info.bestgraph@gmail.com','09190215397','1','2023-04-20','2023-05-20','NULL','NULL','expired','0','',NULL,NULL),(48,'24','ashkan','202020','info.bestgraph@gmail.com','09190215397','1','2023-04-21','2023-11-17','NULL','NULL','true','0','',NULL,NULL),(49,'25','samiyar4','225678','info.bestgraph@gmail.com','09190215397','2','2023-04-21','2023-7-2','NULL','NULL','expired','0','',NULL,NULL),(50,'26','hamed2','458745','info.bestgraph@gmail.com','09190215387','1','2023-04-23','2023-09-30','NULL','NULL','true','0','',NULL,NULL),(51,'28','mpourshahidi2','565623','info.bestgraph@gmail.com','09190215397','1','2023-04-24','2023-06-24','NULL','NULL','expired','0','',NULL,NULL),(52,'29','samiyar2','556476','info.bestgraph@gmail.com','09190215397','1','2023-04-25','2023-6-25','NULL','NULL','expired','0','',NULL,NULL),(53,'47','hamedm2','334563','info.bestgraph@gmail.com','9190215397','1','2023-04-30','2023-9-2','','NULL','true','0','',NULL,NULL),(54,'49','yazdan4','456378','info.bestgraph@gmail.com','09190215397','1','2023-05-03','2023-06-04','','NULL','expired','0','',NULL,NULL),(55,'50','rezaf','109090','','','1','2023-07-10','2023-08-09','','NULL','true','0','',NULL,NULL),(56,'51','mahdif2','334265','info.bestgraph@gmail.com','09190215397','1','2023-05-07','2023-09-30','','NULL','true','0','',NULL,NULL),(57,'53','mdab','109088','info.bestgraph@gmail.com','09190215397','1','2023-05-08','2023-12-31','','NULL','true','0','',NULL,NULL),(58,'57','myaghouti2','448908','info.bestgraph@gmail.com','09190215397','1','2023-05-11','2023-12-30','','NULL','true','0','',NULL,NULL),(59,'58','taghi2','347687','info.bestgraph@gmail.com','9190215397','1','2023-05-11','2023-08-12','','NULL','true','0','',NULL,NULL),(60,'59','tahat','101010','info.bestgraph@gmail.com','9190215397','1','2023-05-11','','','NULL','false','0','',NULL,NULL),(61,'60','rzandaei','454567','','','1','2023-05-18','2023-11-30','','NULL','true','0','',NULL,NULL),(62,'61','douskani','345476','info.bestgraph@gmail.com','09190215397','1','2023-05-19','2023-08-20','','NULL','true','0','',NULL,NULL),(63,'62','mohsenh','856632','info.bestgraph@gmail.com','09190215397','1','2023-05-19','2023-06-19','','NULL','expired','0','',NULL,NULL),(64,'63','sinaf','345476','info.bestgraph@gmail.com','09190215397','1','2023-05-20','2024-02-29','','NULL','true','0','',NULL,NULL),(65,'65','esmaeil','458709','info.bestgraph@gmail.com','09190215397','1','2023-05-20','2023-08-20','','NULL','true','0','',NULL,NULL),(66,'66','javan4','568792','info.bestgraph@gmail.com','09190215387','2','2023-05-21','2023-09-18','120','NULL','true','0','',NULL,NULL),(67,'67','amirr3','547690','info.bestgraph@gmail.com','09190215397','1','2023-05-21','2023-7-21','30','NULL','true','0','',NULL,NULL),(68,'76','javan6','342686','info.bestgraph@gmail.com','9190215397','1','2023-07-05','2023-08-04','','NULL','true','0','',NULL,NULL),(69,'77','yaderd2','453487','info.bestgraph@gmail.com','9190215397','2','2023-07-10','2023-08-09','','NULL','false','0','',NULL,NULL),(70,'78','javan7','443876','info.bestgraph@gmail.com','9190215397','1','2023-07-04','2023-08-03','','NULL','true','0','',NULL,NULL),(71,'80','ashkanm4','126509','info.bestgraph@gmail.com','9190215397','1','2023-06-04','2023-7-5','','NULL','expired','0','',NULL,NULL),(72,'81','zahrad','101010','info.bestgraph@gmail.com','09190215387','1','2023-06-07','','','NULL','true','0','',NULL,NULL),(73,'83','tohidj2','234389','info.bestgraph@gmail.com','9190215397','1','2023-06-10','2023-9-11','','NULL','true','0','',NULL,NULL),(74,'84','samiyar6','443558','info.bestgraph@gmail.com','9190215397','1','2023-06-10','2023-7-11','','NULL','expired','0','',NULL,NULL),(75,'85','milads8','547954','info.bestgraph@gmail.com','9190215397','1','2023-06-14','2023-7-15','','NULL','true','0','',NULL,NULL),(76,'86','milads9','546987','info.bestgraph@gmail.com','9190215397','1','2023-06-14','2023-7-15','','NULL','true','0','',NULL,NULL),(77,'87','milads10','564689','info.bestgraph@gmail.com','9190215397','1','2023-06-16','2023-7-18','','NULL','true','0','',NULL,NULL),(78,'88','naeimf','450987','info.bestgraph@gmail.com','9190215397','1','2023-06-17','2023-7-18','','NULL','true','0','',NULL,NULL),(79,'89','peyman2','457689','info.bestgraph@gmail.com','9190215397','1','2023-06-18','2023-7-21','','NULL','true','0','',NULL,NULL),(80,'90','baba','1010','','','1','2023-06-18','','','NULL','true','0','',NULL,NULL),(81,'91','milads11','547689','info.bestgraph@gmail.com','9190215397','1','2023-06-18','2023-7-19','','NULL','true','0','',NULL,NULL),(82,'92','faridn','449867','info.bestgraph@gmail.com','9190215397','1','2023-06-19','2023-7-20','','NULL','true','0','',NULL,NULL),(83,'93','milads12','547898','info.bestgraph@gmail.com','9190215397','1','2023-06-21','2023-7-22','','NULL','true','0','',NULL,NULL),(84,'94','isa','509807','info.bestgraph@gmail.com','9190215397','1','2023-06-24','2023-7-25','','NULL','true','0','',NULL,NULL),(85,'95','dostkani1','457689','info.bestgraph@gmail.com','9190215397','1','2023-06-25','2023-7-26','','NULL','true','0','',NULL,NULL),(86,'96','dostkani2','345478','info.bestgraph@gmail.com','9190215397','1','2023-06-25','2023-7-26','','NULL','true','0','',NULL,NULL),(87,'97','sina2','456578','info.bestgraph@gmail.com','9190215397','1','2023-06-28','2023-07-30','','Alireza','true','0','',NULL,NULL),(88,'98','miladek','230986','info.bestgraph@gmail.com','9190215397','1','2023-06-30','2023-07-20','','Alireza','true','0','',NULL,NULL),(89,'99','miladek2','335480','info.bestgraph@gmail.com','9190215397','1','2023-07-01','2023-07-31','','Alireza','true','0','',NULL,NULL),(90,'100','ashkanm2','437809','info.bestgraph@gmail.com','9190215397','1','2023-07-02','2023-08-02','','Alireza','true','0','',NULL,NULL),(91,'101','sina3','657898','info.bestgraph@gmail.com','9190215397','1','2023-07-03','2023-10-04','','Alireza','true','0','',NULL,NULL),(92,'103','matin','347865','info.bestgraph@gmail.com','9190215397','1','2023-07-06','2023-08-06','','Alireza','true','0','',NULL,NULL),(93,'ali','456520','info.bestgraph@gmail.com','09190215387','2','2023-04-14','','','NULL','true','0','','',NULL,NULL),(94,'yazdan3','354786','info.bestgraph@gmail.com','09190215397','1','2023-04-14','2023-06-18','NULL','NULL','expired','0','','',NULL,NULL),(95,'bahremand','441209','info.bestgraph@gmail.com','09190215397','1','2023-04-14','2023-7-19','NULL','NULL','true','0','','پرستو بهرمند',NULL,NULL),(96,'samiyar','345325','info.bestgraph@gmail.com','09190215397','2','2023-04-15','2023-7-19','','NULL','true','0','','',NULL,NULL),(97,'behzad','206753','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-7-19','NULL','NULL','true','0','','',NULL,NULL),(98,'yazdan2','389365','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-05-15','NULL','NULL','expired','0','','',NULL,NULL),(99,'hgholipour2','447766','info.bestgraph@gmail.com','09190215397','1','2023-04-15','2023-05-15','NULL','NULL','expired','0','','حسین قلی پور',NULL,NULL),(100,'pedram3','432678','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-07-31','','NULL','true','0','','',NULL,NULL),(101,'milads3','332096','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16','NULL','NULL','expired','0','','',NULL,NULL),(102,'milads4','267785','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16','NULL','NULL','expired','0','','',NULL,NULL),(103,'milads5','453467','info.bestgraph@gmail.com','09190215397','1','2023-04-16','2023-05-16','NULL','NULL','expired','0','','',NULL,NULL),(104,'vahid','334565','info.bestgraph@gmail.com','09190215397','4','2023-04-17','2023-12-31','NULL','NULL','true','0','','',NULL,NULL),(105,'shahin','409087','info.bestgraph@gmail.com','09190215397','3','2023-04-17','2023-7-31','NULL','NULL','true','0','','',NULL,NULL),(106,'arash','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2024-02-29','NULL','NULL','true','0','','',NULL,NULL),(107,'arash2','330989','info.bestgraph@gmail.com','09190215397','5','2023-04-17','2024-02-29','NULL','NULL','true','0','','',NULL,NULL),(108,'zahra','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-05-31','NULL','NULL','expired','0','','',NULL,NULL),(109,'mahdi2','332099','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-7-22','NULL','NULL','true','0','','',NULL,NULL),(110,'hani3','443781','info.bestgraph@gmail.com','09190215397','1','2023-04-17','2023-05-17','','NULL','expired','0','','',NULL,NULL),(111,'alorezap','309088','info.bestgraph@gmail.com','09190215397','1','2023-04-20','','NULL','NULL','true','0','','',NULL,NULL),(112,'mshahidi','202080','info.bestgraph@gmail.com','09190215397','1','2023-04-20','2023-05-20','NULL','NULL','expired','0','','',NULL,NULL),(113,'ashkan','202020','info.bestgraph@gmail.com','09190215397','1','2023-04-21','2023-11-17','NULL','NULL','true','0','','',NULL,NULL),(114,'samiyar4','225678','info.bestgraph@gmail.com','09190215397','2','2023-04-21','2023-7-2','NULL','NULL','expired','0','','',NULL,NULL),(115,'hamed2','458745','info.bestgraph@gmail.com','09190215387','1','2023-04-23','2023-09-30','NULL','NULL','true','0','','دوست حامد صفری',NULL,NULL),(116,'mpourshahidi2','565623','info.bestgraph@gmail.com','09190215397','1','2023-04-24','2023-06-24','NULL','NULL','expired','0','','',NULL,NULL),(117,'samiyar2','556476','info.bestgraph@gmail.com','09190215397','1','2023-04-25','2023-6-25','NULL','NULL','expired','0','','خانم دوستکانی',NULL,NULL),(118,'hamedm2','334563','info.bestgraph@gmail.com','9190215397','1','2023-04-30','2023-9-2','','NULL','true','0','','',NULL,NULL),(119,'yazdan4','456378','info.bestgraph@gmail.com','09190215397','1','2023-05-03','2023-06-04','','NULL','expired','0','','',NULL,NULL),(120,'rezaf','109090','','','1','2023-07-10','2023-08-09','','NULL','true','0','','',NULL,NULL),(121,'mahdif2','334265','info.bestgraph@gmail.com','09190215397','1','2023-05-07','2023-09-30','','NULL','true','0','','',NULL,NULL),(122,'mdab','109088','info.bestgraph@gmail.com','09190215397','1','2023-05-08','2023-12-31','','NULL','true','0','','',NULL,NULL),(123,'myaghouti2','448908','info.bestgraph@gmail.com','09190215397','1','2023-05-11','2023-12-30','','NULL','true','0','','',NULL,NULL),(124,'taghi2','347687','info.bestgraph@gmail.com','9190215397','1','2023-05-11','2023-08-12','','NULL','true','0','','',NULL,NULL),(125,'tahat','101010','info.bestgraph@gmail.com','9190215397','1','2023-05-11','','','NULL','false','0','','',NULL,NULL),(126,'rzandaei','454567','','','1','2023-05-18','2023-11-30','','NULL','true','0','','',NULL,NULL),(127,'douskani','345476','info.bestgraph@gmail.com','09190215397','1','2023-05-19','2023-08-20','','NULL','true','0','','',NULL,NULL),(128,'mohsenh','856632','info.bestgraph@gmail.com','09190215397','1','2023-05-19','2023-06-19','','NULL','expired','0','','',NULL,NULL),(129,'sinaf','345476','info.bestgraph@gmail.com','09190215397','1','2023-05-20','2024-02-29','','NULL','true','0','','',NULL,NULL),(130,'esmaeil','458709','info.bestgraph@gmail.com','09190215397','1','2023-05-20','2023-08-20','','NULL','true','0','','',NULL,NULL),(131,'javan4','568792','info.bestgraph@gmail.com','09190215387','2','2023-05-21','2023-09-18','120','NULL','true','0','','',NULL,NULL),(132,'amirr3','547690','info.bestgraph@gmail.com','09190215397','1','2023-05-21','2023-7-21','30','NULL','true','0','','',NULL,NULL),(133,'javan6','342686','info.bestgraph@gmail.com','9190215397','1','2023-07-05','2023-08-04','','NULL','true','0','','',NULL,NULL),(134,'yaderd2','453487','info.bestgraph@gmail.com','9190215397','2','2023-07-10','2023-08-09','','NULL','false','0','','',NULL,NULL),(135,'javan7','443876','info.bestgraph@gmail.com','9190215397','1','2023-07-04','2023-08-03','','NULL','true','0','','',NULL,NULL),(136,'ashkanm4','126509','info.bestgraph@gmail.com','9190215397','1','2023-06-04','2023-7-5','','NULL','expired','0','','خواهر اشکان',NULL,NULL),(137,'zahrad','101010','info.bestgraph@gmail.com','09190215387','1','2023-06-07','','','NULL','true','0','','',NULL,NULL),(138,'tohidj2','234389','info.bestgraph@gmail.com','9190215397','1','2023-06-10','2023-9-11','','NULL','true','0','','خانم توحید جنگلی',NULL,NULL),(139,'samiyar6','443558','info.bestgraph@gmail.com','9190215397','1','2023-06-10','2023-7-11','','NULL','expired','0','','',NULL,NULL),(140,'milads8','547954','info.bestgraph@gmail.com','9190215397','1','2023-06-14','2023-7-15','','NULL','true','0','','',NULL,NULL),(141,'milads9','546987','info.bestgraph@gmail.com','9190215397','1','2023-06-14','2023-7-15','','NULL','true','0','','',NULL,NULL),(142,'milads10','564689','info.bestgraph@gmail.com','9190215397','1','2023-06-16','2023-7-18','','NULL','true','0','','',NULL,NULL),(143,'naeimf','450987','info.bestgraph@gmail.com','9190215397','1','2023-06-17','2023-7-18','','NULL','true','0','','نعیم فیضی',NULL,NULL),(144,'peyman2','457689','info.bestgraph@gmail.com','9190215397','1','2023-06-18','2023-7-21','','NULL','true','0','','رحمان حسن پور',NULL,NULL),(145,'baba','1010','','','1','2023-06-18','','','NULL','true','0','','',NULL,NULL),(146,'milads11','547689','info.bestgraph@gmail.com','9190215397','1','2023-06-18','2023-7-19','','NULL','true','0','','',NULL,NULL),(147,'faridn','449867','info.bestgraph@gmail.com','9190215397','1','2023-06-19','2023-7-20','','NULL','true','0','','',NULL,NULL),(148,'milads12','547898','info.bestgraph@gmail.com','9190215397','1','2023-06-21','2023-7-22','','NULL','true','0','','',NULL,NULL),(149,'isa','509807','info.bestgraph@gmail.com','9190215397','1','2023-06-24','2023-7-25','','NULL','true','0','','',NULL,NULL),(150,'dostkani1','457689','info.bestgraph@gmail.com','9190215397','1','2023-06-25','2023-7-26','','NULL','true','0','','دوستکانی سردخانه',NULL,NULL),(151,'dostkani2','345478','info.bestgraph@gmail.com','9190215397','1','2023-06-25','2023-7-26','','NULL','true','0','','دوستکانی سردخانه',NULL,NULL),(152,'sina2','456578','info.bestgraph@gmail.com','9190215397','1','2023-06-28','2023-07-30','','Alireza','true','0','','',NULL,NULL),(153,'miladek','230986','info.bestgraph@gmail.com','9190215397','1','2023-06-30','2023-07-20','','Alireza','true','0','','',NULL,NULL),(154,'miladek2','335480','info.bestgraph@gmail.com','9190215397','1','2023-07-01','2023-07-31','','Alireza','true','0','','',NULL,NULL),(158,'matin','347865','info.bestgraph@gmail.com','9190215397','1','2023-07-06','2023-08-06','','Alireza','true','0','','پسر دایی سینا\n',NULL,NULL);
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

-- Dump completed on 2023-07-15 13:53:29
