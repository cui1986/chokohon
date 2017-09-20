-- MySQL dump 10.13  Distrib 5.7.19, for Linux (x86_64)
--
-- Host: localhost    Database: book_kagaku
-- ------------------------------------------------------
-- Server version	5.7.19-0ubuntu0.16.04.1

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
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `books` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_isbn` varchar(20) DEFAULT NULL,
  `book_asin` varchar(15) NOT NULL,
  `book_name` longtext,
  `book_comment` longtext,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `del_flg` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_asin_UNIQUE` (`book_asin`),
  UNIQUE KEY `book_isn_UNIQUE` (`book_isbn`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
INSERT INTO `books` VALUES (1,'11111111111','4834083535','yao','hao kan ','2017-09-01 00:00:00','2017-09-15 09:17:35',0),(2,'4575519944','4575519944','君の膵臓をたべたい (双葉文庫) (文庫) ','君の膵臓をたべたい (双葉文庫) (文庫) ','2017-09-19 02:41:52','2017-09-19 02:41:52',0),(3,'408890740X','408890740X','干物妹! うまるちゃん 11 (ヤングジャンプコミックス) (コミック) ','干物妹! うまるちゃん 11 (ヤングジャンプコミックス) (コミック) ','2017-09-19 06:37:07','2017-09-19 06:37:07',0),(4,'4799734911','4799734911','豪華客船で恋は始まる 13','豪華客船で恋は始まる 13','2017-09-19 07:44:25','2017-09-19 07:44:25',0),(5,'4594077889','4594077889','日本を救う最強の経済論','日本を救う最強の経済論','2017-09-19 08:47:29','2017-09-19 08:47:29',0),(6,'4167909170','4167909170','銀翼のイカロス','銀翼のイカロス','2017-09-19 08:48:51','2017-09-19 08:48:51',0);
/*!40000 ALTER TABLE `books` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `fril_rules`
--

DROP TABLE IF EXISTS `fril_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `fril_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `key_words` longtext,
  `category_id` int(11) DEFAULT NULL,
  `book_status` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `del_flg` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_id_UNIQUE` (`book_id`),
  KEY `fk_fril_rules_1_idx` (`book_id`),
  CONSTRAINT `fk_fril_rules_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fril_rules`
--

LOCK TABLES `fril_rules` WRITE;
/*!40000 ALTER TABLE `fril_rules` DISABLE KEYS */;
INSERT INTO `fril_rules` VALUES (1,2,'君の膵臓をたべたい (双葉文庫) (文庫) ',NULL,NULL,NULL,'2017-09-19 02:41:52','2017-09-19 02:41:52',0),(2,3,'干物妹! うまるちゃん 11 (ヤングジャンプコミックス) (コミック) ',NULL,NULL,NULL,'2017-09-19 06:37:07','2017-09-19 06:37:07',0),(3,4,'豪華客船で恋は始まる 13',NULL,NULL,NULL,'2017-09-19 07:44:26','2017-09-19 07:44:26',0),(4,5,'日本を救う最強の経済論',NULL,NULL,NULL,'2017-09-19 08:47:29','2017-09-19 08:47:29',0),(5,6,'銀翼のイカロス',NULL,NULL,NULL,'2017-09-19 08:48:51','2017-09-19 08:48:51',0);
/*!40000 ALTER TABLE `fril_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `merukari_rules`
--

DROP TABLE IF EXISTS `merukari_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `merukari_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `key_words` longtext,
  `category_id` int(11) DEFAULT NULL,
  `book_status` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `on_sale` int(11) DEFAULT NULL,
  `sold_out` int(11) DEFAULT NULL,
  `sale_status` varchar(20) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `del_flg` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_id_UNIQUE` (`book_id`),
  KEY `fk_merukari_rules_key_idx` (`book_id`),
  CONSTRAINT `fk_merukari_rules_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merukari_rules`
--

LOCK TABLES `merukari_rules` WRITE;
/*!40000 ALTER TABLE `merukari_rules` DISABLE KEYS */;
INSERT INTO `merukari_rules` VALUES (1,1,'cakephp',674,1,NULL,1,NULL,'販売中','2017-09-01 00:00:00','2017-09-19 08:24:18',0),(2,2,'君の膵臓をたべたい',NULL,NULL,NULL,NULL,1,'売り切れ','2017-09-19 02:41:52','2017-09-19 08:13:27',0),(3,3,'干物妹!',668,NULL,NULL,1,NULL,'販売中','2017-09-19 06:37:07','2017-09-19 08:19:01',0),(4,4,'豪華客船で恋は始まる',NULL,NULL,NULL,NULL,1,'売り切れ','2017-09-19 07:44:26','2017-09-19 08:01:13',0),(5,5,'日本を救う最強の経済論',NULL,NULL,NULL,NULL,NULL,NULL,'2017-09-19 08:47:29','2017-09-19 08:47:29',0),(6,6,'銀翼のイカロス',NULL,NULL,NULL,NULL,NULL,NULL,'2017-09-19 08:48:51','2017-09-19 08:48:51',0);
/*!40000 ALTER TABLE `merukari_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rakuma_rules`
--

DROP TABLE IF EXISTS `rakuma_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rakuma_rules` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `book_id` int(11) NOT NULL,
  `key_words` longtext,
  `category_id` int(11) DEFAULT NULL,
  `condition_type` int(11) DEFAULT NULL,
  `postage_type` int(11) DEFAULT NULL,
  `selling_status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `del_flg` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_id_UNIQUE` (`book_id`),
  KEY `fk_rakuma_rules_1_idx` (`book_id`),
  CONSTRAINT `fk_rakuma_rules_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rakuma_rules`
--

LOCK TABLES `rakuma_rules` WRITE;
/*!40000 ALTER TABLE `rakuma_rules` DISABLE KEYS */;
INSERT INTO `rakuma_rules` VALUES (1,1,'日本',39,NULL,NULL,0,'2017-09-12 15:12:39','2017-09-19 08:24:47',0),(2,5,'日本を救う最強の経済論',NULL,NULL,NULL,NULL,'2017-09-19 08:47:29','2017-09-19 08:47:29',0),(3,6,'銀翼のイカロス',NULL,NULL,NULL,NULL,'2017-09-19 08:48:51','2017-09-19 08:48:51',0);
/*!40000 ALTER TABLE `rakuma_rules` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2017-09-19 17:50:41
