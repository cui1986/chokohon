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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `books`
--

LOCK TABLES `books` WRITE;
/*!40000 ALTER TABLE `books` DISABLE KEYS */;
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `fril_rules`
--

LOCK TABLES `fril_rules` WRITE;
/*!40000 ALTER TABLE `fril_rules` DISABLE KEYS */;
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
  `sale_status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `del_flg` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_id_UNIQUE` (`book_id`),
  KEY `fk_merukari_rules_key_idx` (`book_id`),
  CONSTRAINT `fk_merukari_rules_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `merukari_rules`
--

LOCK TABLES `merukari_rules` WRITE;
/*!40000 ALTER TABLE `merukari_rules` DISABLE KEYS */;
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
  `book_status` int(11) DEFAULT NULL,
  `delivery_id` int(11) DEFAULT NULL,
  `sale_status` int(11) DEFAULT NULL,
  `created` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `del_flg` smallint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `book_id_UNIQUE` (`book_id`),
  KEY `fk_rakuma_rules_1_idx` (`book_id`),
  CONSTRAINT `fk_rakuma_rules_1` FOREIGN KEY (`book_id`) REFERENCES `books` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rakuma_rules`
--

LOCK TABLES `rakuma_rules` WRITE;
/*!40000 ALTER TABLE `rakuma_rules` DISABLE KEYS */;
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

-- Dump completed on 2017-09-07 13:06:29
