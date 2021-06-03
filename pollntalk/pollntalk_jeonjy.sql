-- MariaDB dump 10.17  Distrib 10.4.14-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: pollntalk
-- ------------------------------------------------------
-- Server version	10.4.14-MariaDB

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
-- Current Database: `pollntalk`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `pollntalk` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `pollntalk`;

--
-- Table structure for table `BANK_ACCOUNT`
--

DROP TABLE IF EXISTS `BANK_ACCOUNT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BANK_ACCOUNT` (
  `ACCOUNT_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `ACCOUNT_NAME` varchar(30) DEFAULT NULL,
  `ACCOUNT_NUMBER` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`ACCOUNT_SEQ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BANK_ACCOUNT`
--

LOCK TABLES `BANK_ACCOUNT` WRITE;
/*!40000 ALTER TABLE `BANK_ACCOUNT` DISABLE KEYS */;
/*!40000 ALTER TABLE `BANK_ACCOUNT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `CATEGORY`
--

DROP TABLE IF EXISTS `CATEGORY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `CATEGORY` (
  `CATE_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `CATE_NAME` varchar(10) DEFAULT NULL,
  `CATE_PARENT_SEQ` int(11) DEFAULT NULL,
  `CATE_TEXT` varchar(250) DEFAULT NULL,
  `CATE_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `CATE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`CATE_SEQ`),
  KEY `IDX_CATE_X01` (`CATE_PARENT_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='카테고리';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORY`
--

LOCK TABLES `CATEGORY` WRITE;
/*!40000 ALTER TABLE `CATEGORY` DISABLE KEYS */;
INSERT INTO `CATEGORY` VALUES (1,'테스트2',0,'테스트 입니다.2','app/file/20200818223940263.jpg','2020-08-17 18:58:01'),(2,'테스트1-2',2,'테스트 입니다.1-2','app/file/20200818235747263.jpg','2020-08-18 19:16:12'),(3,'테스트2-1',1,'테스트 입니다.2-1','app/file/20200818191637263.jpg','2020-08-18 19:16:43'),(4,'테스트3',0,'테스트 입니다.3','app/file/20200818235628263.png','2020-08-18 23:56:35'),(5,'테스트1-1',2,'테스트 입니다.1-1','app/file/20200818235714263.jpg','2020-08-18 23:57:23'),(6,'테스트4',0,'테스트 입니다.4','app/file/20200819022144263.png','2020-08-19 02:21:51'),(7,'테스트4-1',6,'테스트 입니다.4-1','app/file/20200819022216263.png','2020-08-19 02:22:27'),(8,'테스트1',0,'테스트 입니다.1','app/file/20200819022255263.jpg','2020-08-19 02:22:59'),(9,'테스터5',0,'테스터 입니다.5','app/file/20200819022508263.png','2020-08-19 02:25:19'),(10,'테스트6',0,'테스트 입니다.6','app/file/20200819022619263.png','2020-08-19 02:26:26'),(11,'테스트7',0,'테스트7','/app/images/admin/photo.png','2020-08-19 02:26:59'),(12,'테스트8',0,'테스트 입니다.8','app/file/20200819022914263.png','2020-08-19 02:29:21'),(13,'테스트9',0,'테스트 입니다.9','app/file/20200819023001263.png','2020-08-19 02:30:09'),(14,'테스터10',0,'테스트 입니다.10','app/file/20200819023043263.png','2020-08-19 02:30:50'),(15,'테스터11',0,'테스트 입니다.11','app/file/20200819023126263.jpg','2020-08-19 02:31:36'),(16,'테스터12',0,'테스트 입니다.12','app/file/20200819023252263.jpg','2020-08-19 02:33:00'),(17,'테스트13',0,'테스트 입니다.13','app/file/20200819023556263.jpg','2020-08-19 02:36:03'),(18,'테스트10-1',14,'테스트10-1 입니다.','app/file/20200819025042263.jpg','2020-08-19 02:50:43'),(19,'테스트14',0,'테스트 입니다.14','app/file/20200819025103263.gif','2020-08-19 02:51:12'),(20,'테스트2-2',1,'테스트 입니다.2-2','app/file/20200827190006263.jpg','2020-08-27 19:00:14'),(21,'테스트2-3',1,'테스트 입니다.2-3','app/file/20200827191533263.jpg','2020-08-27 19:15:37');
/*!40000 ALTER TABLE `CATEGORY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MEMBER`
--

DROP TABLE IF EXISTS `MEMBER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MEMBER` (
  `member_seq` int(10) unsigned NOT NULL AUTO_INCREMENT COMMENT '키',
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `uname` varchar(16) DEFAULT NULL,
  `nname` varchar(16) DEFAULT NULL COMMENT '닉네임',
  `birthday` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `abode` char(2) DEFAULT NULL COMMENT '거주지',
  `grade` char(1) DEFAULT NULL,
  `agree` char(1) DEFAULT NULL,
  `pic` char(36) DEFAULT NULL,
  `regidate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`member_seq`),
  KEY `IDX_MEMBER_X01` (`email`,`birthday`,`gender`,`abode`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='회원정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MEMBER`
--

LOCK TABLES `MEMBER` WRITE;
/*!40000 ALTER TABLE `MEMBER` DISABLE KEYS */;
INSERT INTO `MEMBER` VALUES (1,'test01@test.com','*EF4B25DE463D6C8E8BE07C2506E3BBFECF200D4B','테스트01','테스트01','2002-03-18','f','17','0','1',NULL,'2020-08-12 06:22:10'),(2,'jyjeon@plustheplus.net','*0262F498E91CA294A8BA96084EEEDB5F635B23A3','테스트01','테스트01','2004-04-19','f','05','0','1','pic/default.png','2020-10-14 04:24:57');
/*!40000 ALTER TABLE `MEMBER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PRODUCT`
--

DROP TABLE IF EXISTS `PRODUCT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PRODUCT` (
  `SERVICE_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SERVICE_TYPE` char(1) DEFAULT NULL,
  `SERVICE_NAME` varchar(100) DEFAULT NULL,
  `SERVICE_CONTEXT` varchar(500) DEFAULT NULL,
  `SERVICE_PAYMENT_TYPE` char(1) DEFAULT NULL,
  `SERVICE_PRICE` int(11) DEFAULT NULL,
  `SERVICE_IS_OPEN` char(1) DEFAULT NULL,
  PRIMARY KEY (`SERVICE_SEQ`),
  KEY `IDX_PRODUCT_X01` (`SERVICE_NAME`,`SERVICE_PAYMENT_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='상품 정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUCT`
--

LOCK TABLES `PRODUCT` WRITE;
/*!40000 ALTER TABLE `PRODUCT` DISABLE KEYS */;
INSERT INTO `PRODUCT` VALUES (1,'1','1개월 / 9,900원','테스트 서비스입니다.','1',9900,'1'),(2,'1','2개월 / 17,000원','테스트 서비스입니다.','1',17000,'1');
/*!40000 ALTER TABLE `PRODUCT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PTP_IR`
--

DROP TABLE IF EXISTS `PTP_IR`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PTP_IR` (
  `IR_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `IR_COMP_NAME` varchar(50) DEFAULT NULL,
  `IR_COMP_PHONE` varchar(13) DEFAULT NULL,
  `IR_COMP_EMAIL` varchar(100) DEFAULT NULL,
  `IR_COMP_CONTEXT` text DEFAULT NULL,
  `IR_COMP_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`IR_SEQ`),
  UNIQUE KEY `IR_SEQ_UNIQUE` (`IR_SEQ`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PTP_IR`
--

LOCK TABLES `PTP_IR` WRITE;
/*!40000 ALTER TABLE `PTP_IR` DISABLE KEYS */;
/*!40000 ALTER TABLE `PTP_IR` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PTP_IR_VIEW`
--

DROP TABLE IF EXISTS `PTP_IR_VIEW`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PTP_IR_VIEW` (
  `IR_VIEW_SEQ` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `IR_VIEW_COUNT` int(11) DEFAULT NULL,
  `IR_VIEW_DATE` date DEFAULT NULL,
  PRIMARY KEY (`IR_VIEW_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='IR 페이지 정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PTP_IR_VIEW`
--

LOCK TABLES `PTP_IR_VIEW` WRITE;
/*!40000 ALTER TABLE `PTP_IR_VIEW` DISABLE KEYS */;
INSERT INTO `PTP_IR_VIEW` VALUES (1,1,'2020-05-30'),(2,1,'2020-05-31'),(3,1,'2020-06-01'),(4,1,'2020-06-15');
/*!40000 ALTER TABLE `PTP_IR_VIEW` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE`
--

DROP TABLE IF EXISTS `VOTE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE` (
  `VOTE_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VOTE_WRITER_SEQ` int(11) DEFAULT NULL,
  `VOTE_KIND` char(1) DEFAULT NULL,
  `VOTE_TYPE` char(1) NOT NULL,
  `VOTE_SUBJECT` varchar(200) DEFAULT NULL,
  `VOTE_CATE_SEQ` int(10) DEFAULT NULL,
  `VOTE_CATE_SUB_SEQ` int(10) DEFAULT NULL,
  `VOTE_RESOURCE_PATH` varchar(100) DEFAULT NULL,
  `VOTE_RESOURCE_TYPE` char(1) DEFAULT NULL,
  `VOTE_URL` varchar(100) DEFAULT NULL,
  `VOTE_VIEW_COUNT` int(11) DEFAULT NULL,
  `VOTE_PARTICIPATE_COUNT` int(11) DEFAULT NULL,
  `VOTE_END_DATE` date DEFAULT NULL,
  `VOTE_IS_OPEN` char(1) DEFAULT NULL,
  `VOTE_IS_PREMIUM` char(1) DEFAULT NULL,
  `VOTE_IS_START` char(1) DEFAULT NULL,
  `VOTE_SECURITY_CODE` varchar(200) DEFAULT NULL,
  `VOTE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`VOTE_SEQ`),
  KEY `IDX_VOTE_X01` (`VOTE_SEQ`,`VOTE_WRITER_SEQ`,`VOTE_SECURITY_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COMMENT='투표';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE`
--

LOCK TABLES `VOTE` WRITE;
/*!40000 ALTER TABLE `VOTE` DISABLE KEYS */;
INSERT INTO `VOTE` VALUES (1,0,'1','1','테스트 투표양식7 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'9999-12-31','1',NULL,NULL,NULL,'2020-10-20 12:40:50'),(2,0,'1','1','테스트 투표 양식8 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-20 18:04:01'),(3,0,'1','1','테스트 투표 양식8 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-20 18:21:46'),(4,0,'1','2','테스트 투표8 테스트 투표 입니다.',20,20,'app/file/20201020192128263.png','1','naver.com',0,0,'2020-10-23','1',NULL,NULL,NULL,'2020-10-20 19:23:59'),(5,0,'1','1','테스트 투표 8 테스트 투표 입니다.',20,20,'app/file/20201020225352263.jpg','1','naver.com',0,0,'2020-10-24','1',NULL,NULL,NULL,'2020-10-20 22:56:31'),(6,0,'1','1','테스트 투표9 테스트 투표 입니다.',3,3,'app/file/20201020231133263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-20 23:12:30'),(7,0,'1','1','테스트 투표9 테스트 투표 입니다.',3,3,'app/file/20201020231133263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-20 23:16:20'),(8,0,'1','1','테스트 투표9 테스트 투표 입니다.',3,3,'app/file/20201020231133263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-20 23:17:01'),(9,0,'1','1','테스트 투표9 테스트 투표 입니다.',3,3,'app/file/20201020231133263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-20 23:24:10'),(10,0,'1','1','테스트 투표9 테스트 투표 입니다.',3,3,'app/file/20201020231133263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-20 23:27:07'),(11,0,'1','1','테스트 투표9 테스트 투표 입니다.',3,3,'app/file/20201020231133263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-20 23:42:47'),(12,0,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:08:59'),(13,0,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:10:00'),(14,0,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:10:40'),(15,0,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:17:33'),(16,0,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:18:33'),(17,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:37:56'),(18,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:38:49'),(19,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:39:06'),(20,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 11:42:32'),(21,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 15:33:04'),(22,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 15:33:45'),(23,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:17:58'),(24,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:29:48'),(25,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:30:07'),(26,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:30:25'),(27,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:30:52'),(28,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:31:21'),(29,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:31:23'),(30,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:31:23'),(31,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:31:23'),(32,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:33:16'),(33,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,NULL,'2020-10-21 16:33:37'),(34,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,'b3RtcC9uUGFPcytXYkwxYUQ4TExSQTRONVlvPQ==','2020-10-21 16:36:05'),(35,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,'L2poaFNRU00xMkgzTVVjMWZPMlJ3WWpwUVRZPQ==','2020-10-21 16:36:08'),(36,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,'dWNzPQ==','2020-10-21 16:36:59'),(37,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,'a1NNPQ==','2020-10-21 16:37:00'),(38,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,'TG9ZPQ==','2020-10-21 16:37:01'),(39,0,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-30','1',NULL,NULL,'eDhRRjJXQnZ0TFN2cUhvPQ==','2020-10-21 16:38:19'),(40,2,'1','1','테스트 투표 9 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'2020-10-31','1',NULL,NULL,'NXNUTkFRN2VFaldEU25ZPQ==','2020-10-22 11:34:15'),(41,0,'1','1','테스트 투표양식7 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'9999-12-31','1',NULL,NULL,'SEU1NU83dVdaZFRPOXlNPQ==','2020-10-23 11:40:58'),(42,0,'1','1','테스트 투표 양식9 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'9999-12-31','1',NULL,NULL,'VUttaS9iS0tpelBXVkUwPQ==','2020-10-24 16:00:22'),(43,2,'1','1','테스트 투표양식7 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'9999-12-31',NULL,NULL,NULL,'TjJ3SUdYY2tDakVPMHdRPQ==','2020-10-25 15:31:42'),(44,0,'1','1','테스트 투표양식7 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,'9999-12-31',NULL,NULL,NULL,'ZVpSRlYzUGhPR2FpYjJZPQ==','2020-10-25 22:56:11');
/*!40000 ALTER TABLE `VOTE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_ANSWERS`
--

DROP TABLE IF EXISTS `VOTE_ANSWERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_ANSWERS` (
  `ANSWERS_SEQ` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `VOTE_TYPE` char(1) DEFAULT NULL,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `QUESTION_SEQ` int(11) DEFAULT NULL,
  `ANSWER_INDEX` int(11) DEFAULT NULL,
  `ANSWER_TEXT` varchar(250) DEFAULT NULL,
  `ANSWER_TYPE` char(1) DEFAULT NULL,
  `IS_CORRECT` char(1) DEFAULT NULL,
  `ANSWER_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `ANSWER_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ANSWERS_SEQ`),
  KEY `IDX_ANSWER_X01` (`VOTE_SEQ`,`QUESTION_SEQ`,`ANSWER_REGI_DATE`)
) ENGINE=InnoDB AUTO_INCREMENT=451 DEFAULT CHARSET=utf8 COMMENT='투표 질문의 응답';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_ANSWERS`
--

LOCK TABLES `VOTE_ANSWERS` WRITE;
/*!40000 ALTER TABLE `VOTE_ANSWERS` DISABLE KEYS */;
INSERT INTO `VOTE_ANSWERS` VALUES (298,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'app/file/20200927183339263.jpg','2020-10-20 11:56:39'),(299,'2',0,165,0,'테스트7 질문1 응답1','1','0','app/file/20200927183339263.jpg','2020-10-20 12:40:50'),(300,'2',0,165,1,'테스트7 질문1 응답2','1','0','app/file/20200927183339263.jpg','2020-10-20 12:40:50'),(301,'2',0,166,0,'테스트7 질문2 응답1','1','0','app/file/20200927183339263.jpg','2020-10-20 12:40:50'),(302,'2',0,166,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-20 12:40:50'),(303,'2',0,167,0,'테스트7 질문3 응답1','1','0','app/file/20201020123443263.png','2020-10-20 12:40:50'),(304,'2',0,167,1,'테스트7 질문3 응답2','1','0','app/file/20201020123458263.jpg','2020-10-20 12:40:50'),(305,'2',0,168,0,'테스트8질문1 응답1','1','0','app/file/20200927183339263.jpg','2020-10-20 18:04:01'),(306,'2',0,168,1,'테스트8 질문1 응답2','1','0','app/file/20201020180106263.jpg','2020-10-20 18:04:01'),(307,'2',0,169,0,'테스트8 질문2 응답1','1','0','app/file/20201020180135263.png','2020-10-20 18:04:01'),(308,'2',0,169,1,'테스트8 질문2 응답2','1','0','app/file/20201020180144263.jpg','2020-10-20 18:04:01'),(309,'2',0,170,0,'테스트8질문1 응답1','1','0','app/file/20200927183339263.jpg','2020-10-20 18:21:46'),(310,'2',0,170,1,'테스트8 질문1 응답2','1','0','app/file/20201020180106263.jpg','2020-10-20 18:21:46'),(311,'2',0,171,0,'테스트8 질문2 응답1','1','0','app/file/20201020180135263.png','2020-10-20 18:21:46'),(312,'2',0,171,1,'테스트8 질문2 응답2','1','0','app/file/20201020180144263.jpg','2020-10-20 18:21:46'),(313,'2',0,172,0,'테스트8 질문1 응답1','1','0','app/file/20201020192339263.png','2020-10-20 19:23:59'),(314,'2',0,172,1,'테스트8 질문1 응답2','1','0','app/file/20201020192351263.png','2020-10-20 19:23:59'),(315,'2',0,173,0,'테스트 투표 8 질문1 응답1입니다.','1','0','app/file/20201020225612263.png','2020-10-20 22:56:31'),(316,'2',0,173,1,'테스트 투표 8 질문1 응답2입니다.','1','0','app/file/20201020225625263.png','2020-10-20 22:56:31'),(317,'2',0,174,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png','2020-10-20 23:12:30'),(318,'2',0,174,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png','2020-10-20 23:12:30'),(319,'2',7,175,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png','2020-10-20 23:16:20'),(320,'2',7,175,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png','2020-10-20 23:16:20'),(321,'2',8,176,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png','2020-10-20 23:17:01'),(322,'2',8,176,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png','2020-10-20 23:17:01'),(323,'2',9,177,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png','2020-10-20 23:24:10'),(324,'2',9,177,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png','2020-10-20 23:24:10'),(325,'2',10,178,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png','2020-10-20 23:27:07'),(326,'2',10,178,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png','2020-10-20 23:27:07'),(327,'2',11,179,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png','2020-10-20 23:42:47'),(328,'2',11,179,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png','2020-10-20 23:42:47'),(329,'2',12,180,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png','2020-10-21 11:08:59'),(330,'2',12,180,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:08:59'),(331,'2',13,181,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png','2020-10-21 11:10:00'),(332,'2',13,181,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:10:00'),(333,'2',14,182,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png','2020-10-21 11:10:40'),(334,'2',14,182,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:10:40'),(335,'2',15,183,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png','2020-10-21 11:17:33'),(336,'2',15,183,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:17:33'),(337,'2',16,184,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png','2020-10-21 11:18:33'),(338,'2',16,184,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:18:33'),(339,'2',17,185,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 11:37:56'),(340,'2',17,185,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 11:37:56'),(341,'2',17,186,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 11:37:56'),(342,'2',17,186,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:37:56'),(343,'2',18,187,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 11:38:49'),(344,'2',18,187,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 11:38:49'),(345,'2',18,188,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 11:38:49'),(346,'2',18,188,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:38:49'),(347,'2',19,189,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 11:39:06'),(348,'2',19,189,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 11:39:06'),(349,'2',19,190,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 11:39:06'),(350,'2',19,190,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:39:06'),(351,'2',20,191,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 11:42:32'),(352,'2',20,191,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 11:42:32'),(353,'2',20,192,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 11:42:32'),(354,'2',20,192,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 11:42:32'),(355,'2',21,193,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 15:33:04'),(356,'2',21,193,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 15:33:04'),(357,'2',21,194,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 15:33:04'),(358,'2',21,194,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 15:33:04'),(359,'2',22,195,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 15:33:45'),(360,'2',22,195,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 15:33:45'),(361,'2',22,196,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 15:33:45'),(362,'2',22,196,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 15:33:45'),(363,'2',23,197,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:17:58'),(364,'2',23,197,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:17:58'),(365,'2',23,198,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:17:58'),(366,'2',23,198,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:17:58'),(367,'2',24,199,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:29:48'),(368,'2',24,199,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:29:48'),(369,'2',24,200,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:29:48'),(370,'2',24,200,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:29:48'),(371,'2',25,201,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:30:07'),(372,'2',25,201,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:30:07'),(373,'2',25,202,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:30:07'),(374,'2',25,202,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:30:07'),(375,'2',26,203,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:30:25'),(376,'2',26,203,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:30:25'),(377,'2',26,204,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:30:25'),(378,'2',26,204,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:30:25'),(379,'2',27,205,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:30:52'),(380,'2',27,205,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:30:52'),(381,'2',27,206,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:30:52'),(382,'2',27,206,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:30:52'),(383,'2',28,207,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:31:21'),(384,'2',28,207,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:31:21'),(385,'2',28,208,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:31:21'),(386,'2',28,208,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:31:21'),(387,'2',29,209,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:31:23'),(388,'2',29,209,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:31:23'),(389,'2',29,210,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:31:23'),(390,'2',29,210,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:31:23'),(391,'2',30,211,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:31:23'),(392,'2',30,211,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:31:23'),(393,'2',30,212,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:31:23'),(394,'2',30,212,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:31:23'),(395,'2',31,213,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:31:23'),(396,'2',31,213,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:31:23'),(397,'2',31,214,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:31:23'),(398,'2',31,214,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:31:23'),(399,'2',32,215,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:33:16'),(400,'2',32,215,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:33:16'),(401,'2',32,216,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:33:16'),(402,'2',32,216,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:33:16'),(403,'2',33,217,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:33:38'),(404,'2',33,217,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:33:38'),(405,'2',33,218,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:33:38'),(406,'2',33,218,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:33:38'),(407,'2',34,219,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:36:05'),(408,'2',34,219,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:36:05'),(409,'2',34,220,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:36:05'),(410,'2',34,220,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:36:05'),(411,'2',35,221,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:36:08'),(412,'2',35,221,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:36:08'),(413,'2',35,222,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:36:08'),(414,'2',35,222,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:36:08'),(415,'2',36,223,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:36:59'),(416,'2',36,223,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:36:59'),(417,'2',36,224,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:36:59'),(418,'2',36,224,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:36:59'),(419,'2',37,225,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:37:00'),(420,'2',37,225,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:37:00'),(421,'2',37,226,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:37:00'),(422,'2',37,226,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:37:00'),(423,'2',38,227,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:37:01'),(424,'2',38,227,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:37:01'),(425,'2',38,228,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:37:01'),(426,'2',38,228,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:37:01'),(427,'2',39,229,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-21 16:38:19'),(428,'2',39,229,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-21 16:38:19'),(429,'2',39,230,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-21 16:38:19'),(430,'2',39,230,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-21 16:38:19'),(431,'2',40,231,0,'테스트 투표 9 질문1 응답1','1','0','app/file/20201022113239263.png','2020-10-22 11:34:15'),(432,'2',40,231,1,'테스트 투표 9 질문1 응답2','1','0','app/file/20201022113249263.jpg','2020-10-22 11:34:15'),(433,'2',40,232,0,'테스트 투표 9 질문2 응답1','1','0','app/file/20201022113352263.jpg','2020-10-22 11:34:15'),(434,'2',40,232,1,'테스트 투표 9 질문2 응답2','1','0','app/file/20201022113407263.png','2020-10-22 11:34:15'),(435,'2',41,233,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-23 11:40:58'),(436,'2',41,233,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-23 11:40:58'),(437,'2',41,234,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-23 11:40:58'),(438,'2',41,234,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-23 11:40:58'),(439,'2',42,235,0,'테스트 투표 양식9-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-24 16:00:22'),(440,'2',42,235,1,'테스트 투표 양식9-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-24 16:00:22'),(441,'2',42,236,0,'테스트 투표 양식9-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-24 16:00:22'),(442,'2',42,236,1,'테스트 투표 양식9 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-24 16:00:22'),(443,'2',43,237,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-25 15:31:42'),(444,'2',43,237,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-25 15:31:42'),(445,'2',43,238,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-25 15:31:42'),(446,'2',43,238,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-25 15:31:42'),(447,'2',44,239,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg','2020-10-25 22:56:11'),(448,'2',44,239,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png','2020-10-25 22:56:11'),(449,'2',44,240,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png','2020-10-25 22:56:11'),(450,'2',44,240,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg','2020-10-25 22:56:11');
/*!40000 ALTER TABLE `VOTE_ANSWERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_FORM`
--

DROP TABLE IF EXISTS `VOTE_FORM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_FORM` (
  `VOTE_FORM_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VOTE_WRITER_SEQ` int(10) DEFAULT NULL,
  `VOTE_FORM_KIND` char(1) DEFAULT NULL,
  `VOTE_TYPE` char(1) DEFAULT NULL,
  `VOTE_SUBJECT` varchar(200) DEFAULT NULL,
  `VOTE_CATE_SEQ` int(10) DEFAULT NULL,
  `VOTE_CATE_SUB_SEQ` int(10) DEFAULT NULL,
  `VOTE_RESOURCE_PATH` varchar(100) DEFAULT NULL,
  `VOTE_RESOURCE_TYPE` char(1) DEFAULT NULL,
  `VOTE_FORM_CONTEXT` varchar(250) DEFAULT NULL,
  `VOTE_URL` varchar(100) DEFAULT NULL,
  `VOTE_VIEW_COUNT` int(11) DEFAULT NULL,
  `VOTE_USE_COUNT` int(11) DEFAULT NULL,
  `VOTE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`VOTE_FORM_SEQ`),
  KEY `IDX_VOTE_FORM_X01` (`VOTE_CATE_SEQ`,`VOTE_CATE_SUB_SEQ`,`VOTE_REGI_DATE`,`VOTE_WRITER_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COMMENT='투표 양식';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_FORM`
--

LOCK TABLES `VOTE_FORM` WRITE;
/*!40000 ALTER TABLE `VOTE_FORM` DISABLE KEYS */;
INSERT INTO `VOTE_FORM` VALUES (14,112,'1','2','테스트 투표양식1 테스트 테스트 테스트',1,3,'app/file/20200818223940263.jpg','1','테스트 투표1 입니다. 참고하세요.','naver.com',0,0,'2020-09-26 01:41:43'),(15,112,'1','1','테스트 투표양식2',6,7,'app/file/20200819022144263.png','1','테스트 투표2입니다. 참고하세요.','naver.com',0,0,'2020-09-26 04:38:57'),(16,112,'1','1','테스트 투표양식3',1,3,'app/file/20200818223940263.jpg','1','테스트 투표3 입니다. 참고하세요.','naver.com',0,0,'2020-09-26 18:44:27'),(17,112,'1','1','테스트4 투표양식1',6,7,'app/file/20200819022144263.png','1','테스트 투표4 입니다. 참고하세요.','naver.com',0,0,'2020-09-28 12:27:37'),(18,112,'1','4','테스트 퀴즈 양식1',6,7,'app/file/20200819022144263.png','1','테스트 투표5 입니다. 참고하세요.','naver.com',0,0,'2020-10-03 01:45:35'),(19,112,'1','4','테스트 퀴즈 양식1',6,7,'app/file/20200819022144263.png','1','테스트 투표6 입니다. 참고하세요.','naver.com',0,0,'2020-10-03 01:53:57'),(20,112,'1','1','테스트 투표양식7 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','테스트 투표7 입니다. 참고하세요.','naver.com',0,0,'2020-10-08 00:17:00');
/*!40000 ALTER TABLE `VOTE_FORM` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_FORM_LOG`
--

DROP TABLE IF EXISTS `VOTE_FORM_LOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_FORM_LOG` (
  `VOTE_FORM_LOG_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MEMBER_SEQ` int(11) DEFAULT NULL,
  `VOTE_FORM_SEQ` int(11) DEFAULT NULL,
  `USE_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`VOTE_FORM_LOG_SEQ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_FORM_LOG`
--

LOCK TABLES `VOTE_FORM_LOG` WRITE;
/*!40000 ALTER TABLE `VOTE_FORM_LOG` DISABLE KEYS */;
/*!40000 ALTER TABLE `VOTE_FORM_LOG` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_QUESTIONS`
--

DROP TABLE IF EXISTS `VOTE_QUESTIONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_QUESTIONS` (
  `QUESTION_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VOTE_TYPE` char(1) DEFAULT NULL,
  `VOTE_KIND` char(1) DEFAULT NULL,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `QUESTION_INDEX` int(11) DEFAULT NULL,
  `QUESTION_ORDER` int(11) DEFAULT NULL,
  `QUESTION_SUBJECT` varchar(250) DEFAULT NULL,
  `QUESTION_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `QUESTION_RESP_TYPE` char(1) DEFAULT NULL,
  `QUESTION_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`QUESTION_SEQ`),
  KEY `IDX_QUESTIONS_X01` (`VOTE_SEQ`,`QUESTION_REGI_DATE`)
) ENGINE=InnoDB AUTO_INCREMENT=241 DEFAULT CHARSET=utf8 COMMENT='투표 질문 항목';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_QUESTIONS`
--

LOCK TABLES `VOTE_QUESTIONS` WRITE;
/*!40000 ALTER TABLE `VOTE_QUESTIONS` DISABLE KEYS */;
INSERT INTO `VOTE_QUESTIONS` VALUES (9,NULL,'1',1,13,NULL,'테스트질문1','app/file/20200927215032263.png','1','2020-09-26 04:13:21'),(10,NULL,'1',1,13,NULL,'테스트질문1','app/file/20200927215032263.png','1','2020-09-26 04:23:35'),(11,NULL,'1',1,13,NULL,'테스트질문1','app/file/20200927215032263.png','1','2020-09-26 04:24:15'),(165,'2','1',0,1,0,'테스트7 질문1','app/file/20201004192145263.png','1','2020-10-20 12:40:50'),(166,'2','1',0,2,1,'테스트7 질문2','app/file/20201004192145263.png','1','2020-10-20 12:40:50'),(167,'2','1',0,3,2,'테스트7 질문3','app/file/20201020123429263.png','1','2020-10-20 12:40:50'),(168,'2','1',0,1,0,'테스트8 질문1','app/file/20201004192145263.png','1','2020-10-20 18:04:01'),(169,'2','1',0,2,1,'테스트8 질문2','app/file/20201020180123263.jpg','1','2020-10-20 18:04:01'),(170,'2','1',0,1,0,'테스트8 질문1','app/file/20201004192145263.png','1','2020-10-20 18:21:46'),(171,'2','1',0,2,1,'테스트8 질문2','app/file/20201020180123263.jpg','1','2020-10-20 18:21:46'),(172,'2','1',0,1,0,'테스트8 질문1','app/file/20201020192312263.jpg','1','2020-10-20 19:23:59'),(173,'2','1',0,2,0,'테스트 투표 8 질문1입니다.','app/file/20201020225545263.jpg','1','2020-10-20 22:56:31'),(174,'2','1',0,1,0,'테스트9 질문1','app/file/20201020231156263.jpg','1','2020-10-20 23:12:30'),(175,'2','1',7,1,0,'테스트9 질문1','app/file/20201020231156263.jpg','1','2020-10-20 23:16:20'),(176,'2','1',8,1,0,'테스트9 질문1','app/file/20201020231156263.jpg','1','2020-10-20 23:17:01'),(177,'2','1',9,1,0,'테스트9 질문1','app/file/20201020231156263.jpg','1','2020-10-20 23:24:10'),(178,'2','1',10,1,0,'테스트9 질문1','app/file/20201020231156263.jpg','1','2020-10-20 23:27:07'),(179,'2','1',11,1,0,'테스트9 질문1','app/file/20201020231156263.jpg','1','2020-10-20 23:42:47'),(180,'2','1',12,1,0,'테스트7-2 질문1','app/file/20201021110735263.png','1','2020-10-21 11:08:59'),(181,'2','1',13,1,0,'테스트7-2 질문1','app/file/20201021110735263.png','1','2020-10-21 11:10:00'),(182,'2','1',14,1,0,'테스트7-2 질문1','app/file/20201021110735263.png','1','2020-10-21 11:10:40'),(183,'2','1',15,1,0,'테스트7-2 질문1','app/file/20201021110735263.png','1','2020-10-21 11:17:33'),(184,'2','1',16,1,0,'테스트7-2 질문1','app/file/20201021110735263.png','1','2020-10-21 11:18:33'),(185,'2','1',17,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 11:37:56'),(186,'2','1',17,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 11:37:56'),(187,'2','1',18,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 11:38:49'),(188,'2','1',18,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 11:38:49'),(189,'2','1',19,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 11:39:06'),(190,'2','1',19,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 11:39:06'),(191,'2','1',20,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 11:42:32'),(192,'2','1',20,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 11:42:32'),(193,'2','1',21,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 15:33:04'),(194,'2','1',21,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 15:33:04'),(195,'2','1',22,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 15:33:45'),(196,'2','1',22,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 15:33:45'),(197,'2','1',23,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:17:58'),(198,'2','1',23,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:17:58'),(199,'2','1',24,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:29:48'),(200,'2','1',24,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:29:48'),(201,'2','1',25,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:30:07'),(202,'2','1',25,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:30:07'),(203,'2','1',26,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:30:25'),(204,'2','1',26,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:30:25'),(205,'2','1',27,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:30:52'),(206,'2','1',27,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:30:52'),(207,'2','1',28,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:31:21'),(208,'2','1',28,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:31:21'),(209,'2','1',29,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:31:23'),(210,'2','1',29,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:31:23'),(211,'2','1',30,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:31:23'),(212,'2','1',30,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:31:23'),(213,'2','1',31,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:31:23'),(214,'2','1',31,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:31:23'),(215,'2','1',32,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:33:16'),(216,'2','1',32,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:33:16'),(217,'2','1',33,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:33:38'),(218,'2','1',33,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:33:38'),(219,'2','1',34,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:36:05'),(220,'2','1',34,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:36:05'),(221,'2','1',35,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:36:08'),(222,'2','1',35,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:36:08'),(223,'2','1',36,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:36:59'),(224,'2','1',36,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:36:59'),(225,'2','1',37,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:37:00'),(226,'2','1',37,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:37:00'),(227,'2','1',38,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:37:01'),(228,'2','1',38,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:37:01'),(229,'2','1',39,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-21 16:38:19'),(230,'2','1',39,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-21 16:38:19'),(231,'2','1',40,3,0,'테스트 투표 9 질문1','app/file/20201022113224263.jpg','1','2020-10-22 11:34:15'),(232,'2','1',40,4,1,'테스트 투표 9 질문2','app/file/20201022113310263.png','1','2020-10-22 11:34:15'),(233,'2','1',41,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-23 11:40:58'),(234,'2','1',41,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-23 11:40:58'),(235,'2','1',42,1,0,'테스트 투표 양식9-1 질문1','app/file/20201004192145263.png','1','2020-10-24 16:00:22'),(236,'2','1',42,2,1,'테스트 투표 양식9-1 질문2','app/file/20201021112927263.jpg','1','2020-10-24 16:00:22'),(237,'2','1',43,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-25 15:31:42'),(238,'2','1',43,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-25 15:31:42'),(239,'2','1',44,1,0,'테스트7-1 질문1','app/file/20201004192145263.png','1','2020-10-25 22:56:11'),(240,'2','1',44,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg','1','2020-10-25 22:56:11');
/*!40000 ALTER TABLE `VOTE_QUESTIONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_SERVICE_PREMIUM`
--

DROP TABLE IF EXISTS `VOTE_SERVICE_PREMIUM`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_SERVICE_PREMIUM` (
  `SERVICE_PREM_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SERVICE_MEMBER_SEQ` int(11) DEFAULT NULL,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `SERVICE_TYPE` char(1) DEFAULT NULL,
  `SERVICE_END_DATE` date DEFAULT NULL,
  `SERVICE_PRICE` int(11) DEFAULT NULL,
  `SERVICE_PAYMENT_TYPE` char(1) DEFAULT NULL,
  `SERVICE_ACCOUNT_TYPE` varchar(50) DEFAULT NULL,
  `SERVICE_ACCOUNT` varchar(50) DEFAULT NULL,
  `SERVICE_PAYER` varchar(10) DEFAULT NULL,
  `SERVICE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`SERVICE_PREM_SEQ`),
  KEY `IDX_VOTE_SERVICE_PREM_X01` (`SERVICE_PREM_SEQ`,`VOTE_SEQ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='프리미엄 서비스 목록';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_SERVICE_PREMIUM`
--

LOCK TABLES `VOTE_SERVICE_PREMIUM` WRITE;
/*!40000 ALTER TABLE `VOTE_SERVICE_PREMIUM` DISABLE KEYS */;
/*!40000 ALTER TABLE `VOTE_SERVICE_PREMIUM` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ptp_admin`
--

DROP TABLE IF EXISTS `ptp_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ptp_admin` (
  `ADMIN_SEQ` int(10) unsigned NOT NULL,
  `ADMINID` varchar(25) DEFAULT NULL,
  `ADMINPW` varchar(100) DEFAULT NULL,
  `ADMINNAME` varchar(25) DEFAULT NULL,
  `PIC` varchar(100) DEFAULT NULL,
  `GRADE` char(1) DEFAULT NULL,
  `LAST_LOGIN` datetime DEFAULT NULL,
  `LOGIN_COUNT` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='plustheplust 홈페이지 관리자';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ptp_admin`
--

LOCK TABLES `ptp_admin` WRITE;
/*!40000 ALTER TABLE `ptp_admin` DISABLE KEYS */;
INSERT INTO `ptp_admin` VALUES (112,'admin','*0262F498E91CA294A8BA96084EEEDB5F635B23A3','관리자',NULL,'1',NULL,1);
/*!40000 ALTER TABLE `ptp_admin` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-10-26  2:58:40
