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
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BANK_ACCOUNT`
--

LOCK TABLES `BANK_ACCOUNT` WRITE;
/*!40000 ALTER TABLE `BANK_ACCOUNT` DISABLE KEYS */;
INSERT INTO `BANK_ACCOUNT` VALUES (3,'우리은행','1002-454-787845');
/*!40000 ALTER TABLE `BANK_ACCOUNT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BLOCK_MESSAGE_MEMBER`
--

DROP TABLE IF EXISTS `BLOCK_MESSAGE_MEMBER`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BLOCK_MESSAGE_MEMBER` (
  `BLOCK_MEMBER_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MEMBER_SEQ` int(11) DEFAULT NULL,
  `TARGET_SEQ` int(11) DEFAULT NULL,
  `BLOCK_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`BLOCK_MEMBER_SEQ`),
  KEY `IDX_BLOCK_MESSAGE_MEMBER_X01` (`MEMBER_SEQ`,`TARGET_SEQ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='메시지 차단';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BLOCK_MESSAGE_MEMBER`
--

LOCK TABLES `BLOCK_MESSAGE_MEMBER` WRITE;
/*!40000 ALTER TABLE `BLOCK_MESSAGE_MEMBER` DISABLE KEYS */;
/*!40000 ALTER TABLE `BLOCK_MESSAGE_MEMBER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BOARD`
--

DROP TABLE IF EXISTS `BOARD`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BOARD` (
  `NUM` int(11) NOT NULL AUTO_INCREMENT,
  `KIND` char(1) DEFAULT NULL COMMENT '게시판 종류',
  `TYPE` char(1) DEFAULT NULL COMMENT '관리자 1\n사용자 2',
  `PARENT_NUM` int(11) DEFAULT NULL,
  `MEMBER_SEQ` int(11) DEFAULT NULL,
  `NAME` varchar(25) NOT NULL,
  `SUBJECT` varchar(100) DEFAULT NULL,
  `CONTEXT` text DEFAULT NULL,
  `COUNT` int(11) NOT NULL DEFAULT 0,
  `CREATE_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`NUM`),
  UNIQUE KEY `num` (`NUM`),
  KEY `IDX_BOARD_X01` (`MEMBER_SEQ`,`KIND`)
) ENGINE=InnoDB AUTO_INCREMENT=268 DEFAULT CHARSET=utf8mb4;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BOARD`
--

LOCK TABLES `BOARD` WRITE;
/*!40000 ALTER TABLE `BOARD` DISABLE KEYS */;
INSERT INTO `BOARD` VALUES (253,'1','1',NULL,112,'관리자','hejhe34agsgsgsd','aeaaagag<img style=\"width:95%;\" src=\"app/file/20210309015649263.jpg\"><img style=\"width:95%;\" src=\"app/file/20210309015700263.JPG\">',2,'2021-03-09 00:00:00'),(254,'1','1',NULL,112,'관리자','hejhe34agsgsgsd','aeaaagag<img style=\"width:95%;\" src=\"app/file/20210309015649263.jpg\"><img style=\"width:95%;\" src=\"app/file/20210309015700263.JPG\">',1,'2021-03-09 00:00:00'),(255,'1','1',NULL,112,'관리자','hejhe34agsgsgsd','aeaaagag<img style=\"width:95%;\" src=\"app/file/20210309015649263.jpg\"><img style=\"width:95%;\" src=\"app/file/20210309015700263.JPG\">',0,'2021-03-09 00:00:00'),(256,'1','1',NULL,112,'관리자','aheh5435dhrehe','ashrshsehsehsh<div><img style=\"width:95%;\" src=\"app/file/20210309023401263.jpg\"></div>',2,'2021-03-09 00:00:00'),(257,'1','1',NULL,112,'관리자','aheh5435dhrehe','ashrshsehsehsh<div><img style=\"width:95%;\" src=\"app/file/20210309023401263.jpg\"></div>',0,'2021-03-09 00:00:00'),(258,'1','1',NULL,112,'관리자','kk656sdfsfgsdf','<span style=\"font-size: 10pt;\">swbgsdfsf</span><div style=\"\"><font color=\"#b0c4de\" style=\"\" size=\"7\">sgagaweg</font></div><div style=\"\"><img style=\"width:95%;\" src=\"app/file/20210309023847263.jpg\"></div>',7,'2021-03-09 00:00:00'),(259,'1','1',NULL,112,'관리자','kk656sdfsfgsdfdddddd!!!!','ashga<div><br></div><div>s</div><div><br></div><div>s</div><div><br></div><div><img style=\"width:95%;\" src=\"app/file/20210309033430263.jpg\"></div>',30,'2021-03-09 00:00:00'),(260,'3','2',NULL,2,'테스트01',NULL,'<font face=\"arial, sans-serif\"><span style=\"font-size: 13.3333px;\">테스트입니다.2</span></font><img style=\"width:95%;\" src=\"app/file/20210318012819263.jpg\">',0,'2021-03-18 00:00:00'),(261,'3','2',NULL,2,'테스트01','테스트입니다.3','테스트입니다.3<img style=\"width:75%;\" src=\"app/file/20210318015016263.jpg\">',0,'2021-03-18 00:00:00'),(262,'3','2',NULL,2,'테스트01','테스트입니다.7','<img style=\"width:75%;\" src=\"app/file/20210319010100263.png\">.<div><br></div><div>ㅁㅎㅁㄷㅈㅎㅁㅈㅎㄷㅁㅈ</div>',21,'2021-03-18 00:00:00'),(263,'3','2',NULL,2,'테스트01','테스트입니다.4','',11,'2021-03-18 00:00:00'),(264,'1','1',262,112,'관리자','테스트 입니다.8','<img style=\"width:75%;\" src=\"app/file/20210319010924263.png\"><div><br></div><div>ㅇㄴㄻㄹㄷ</div><div><br></div><div><br></div><div><img style=\"width:75%;\" src=\"app/file/20210319010943263.jpg\"></div>',0,'2021-03-19 00:00:00'),(265,'3','2',NULL,2,'테스트01','테스트 입니다.9','ㅁㅈㄷㅎㅁㅈㅎㄷㅁㅈㅎ<img style=\"width:75%;\" src=\"app/file/20210320015007263.jpg\">',17,'2021-03-20 00:00:00'),(266,'1','1',265,112,'관리자','ㅁㅈㄷㅎㅁㅈㅎㅁㅈㅎㅁㅈㅎ','ㅁㅎㅁㅎㅁㅈㅎ<img style=\"width:75%;\" src=\"app/file/20210320015203263.png\">',29,'2021-03-20 00:00:00'),(267,'2','1',NULL,112,'관리자','ㅁㅎㅁㅎㅈㄷ조ㅜ우','<div>ㅁㅎㄷㅁㅈㅎㅁㅈㅎㅁㅈㄷㅎ</div>ㅁㅎㅁㅎㅈㄷㅎㅈㅁ<img style=\"width:75%;\" src=\"app/file/20210321025411263.png\">',10,'2021-03-21 00:00:00');
/*!40000 ALTER TABLE `BOARD` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `BOARD_ATTACH_FILE`
--

DROP TABLE IF EXISTS `BOARD_ATTACH_FILE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `BOARD_ATTACH_FILE` (
  `ATTACH_FILE_SEQ` int(11) NOT NULL AUTO_INCREMENT,
  `BOARD_SEQ` int(11) DEFAULT NULL,
  `FILE_PATH` varchar(1000) DEFAULT NULL,
  `FILE_NAME` varchar(250) DEFAULT NULL,
  `REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ATTACH_FILE_SEQ`),
  KEY `IDX_BOARD_ATTACH_FILE_X01` (`BOARD_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COMMENT='게시판 첨부파일';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `BOARD_ATTACH_FILE`
--

LOCK TABLES `BOARD_ATTACH_FILE` WRITE;
/*!40000 ALTER TABLE `BOARD_ATTACH_FILE` DISABLE KEYS */;
INSERT INTO `BOARD_ATTACH_FILE` VALUES (1,NULL,'app/file/20210309013335263.pdf','2019_동향보고서_3호.pdf','2021-03-09 01:46:34'),(2,NULL,'app/file/20210309013338263.pdf','colinlow-adepthofbeginning-190323161332.pdf','2021-03-09 01:46:34'),(3,NULL,'app/file/20210309015709263.pdf','9781783746774.pdf','2021-03-09 01:57:17'),(4,NULL,'app/file/20210309015709263.pdf','9781783746774.pdf','2021-03-09 01:58:52'),(5,NULL,'app/file/20210309015709263.pdf','9781783746774.pdf','2021-03-09 02:02:15'),(6,253,'app/file/20210309015709263.pdf','9781783746774.pdf','2021-03-09 02:10:04'),(7,254,'app/file/20210309015709263.pdf','9781783746774.pdf','2021-03-09 02:11:15'),(8,254,'app/file/20210309015715263.jpeg','pasteboardmasquerade_com -&nbspThis website is for sale! -&nbsppasteboardmasquerade Resources and Information_.jpeg','2021-03-09 02:11:15'),(9,255,'app/file/20210309015709263.pdf','9781783746774.pdf','2021-03-09 02:12:58'),(10,255,'app/file/20210309015715263.jpeg','pasteboardmasquerade_com -&nbspThis website is for sale! -&nbsppasteboardmasquerade Resources and Information_.jpeg','2021-03-09 02:12:58'),(11,256,'app/file/20210309023406263.pdf','2019_동향보고서_3호.pdf','2021-03-09 02:34:30'),(12,256,'app/file/20210309023410263.pdf','9781783746774.pdf','2021-03-09 02:34:30'),(13,257,'app/file/20210309023406263.pdf','2019_동향보고서_3호.pdf','2021-03-09 02:36:42'),(14,257,'app/file/20210309023410263.pdf','9781783746774.pdf','2021-03-09 02:36:42'),(15,258,'app/file/20210309023827263.pdf','colinlow-adepthofbeginning-190323161332.pdf','2021-03-09 02:38:53'),(16,258,'app/file/20210309023832263.pdf','2019_동향보고서_3호.pdf','2021-03-09 02:38:53'),(17,258,'app/file/20210309023836263.pdf','9781783746774.pdf','2021-03-09 02:38:53'),(18,259,'ATTACH_FILE_SEQ','colinlow-adepthofbeginning-190323161332.pdf','2021-03-09 03:29:44'),(19,259,'ATTACH_FILE_SEQ','2019_동향보고서_3호.pdf','2021-03-09 03:29:44'),(20,259,'ATTACH_FILE_SEQ','9781783746774.pdf','2021-03-09 03:29:44'),(21,260,'app/file/20210318012804263.PDF','EC56155.PDF','2021-03-18 01:35:56'),(22,260,'app/file/20210318012808263.pdf','Gematria.pdf','2021-03-18 01:35:56'),(23,261,'app/file/20210318014957263.pdf','Aleister Crowley - The book of Thoth.pdf','2021-03-18 01:50:23'),(24,261,'app/file/20210318015004263.pdf','9781783746774.pdf','2021-03-18 01:50:23'),(25,262,'app/file/20210318015222263.pdf','Aleister Crowley - The book of Thoth.pdf','2021-03-18 01:52:31'),(26,263,'app/file/20210318015222263.pdf','Aleister Crowley - The book of Thoth.pdf','2021-03-18 01:53:12'),(27,264,'app/file/20210319010930263.pdf','2019_동향보고서_3호.pdf','2021-03-19 01:09:46'),(28,264,'app/file/20210319010934263.pdf','the-mystery-of-the-hebrew-language-appendix.pdf','2021-03-19 01:09:46'),(29,265,'app/file/20210320014939263.0_20210315','pomecon_아키텍처_초안_v1.0_20210315.pptx','2021-03-20 01:50:11'),(30,266,'app/file/20210320015154263.pdf','2019_동향보고서_3호.pdf','2021-03-20 01:52:06'),(31,267,'app/file/20210321025419263.pdf','Kabbalah_Dictionary_LetterAlephOnly.pdf','2021-03-21 02:54:23');
/*!40000 ALTER TABLE `BOARD_ATTACH_FILE` ENABLE KEYS */;
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
  `CATE_REAL_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `CATE_ORIGIN_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `CATE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`CATE_SEQ`),
  KEY `IDX_CATE_X01` (`CATE_PARENT_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COMMENT='카테고리';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CATEGORY`
--

LOCK TABLES `CATEGORY` WRITE;
/*!40000 ALTER TABLE `CATEGORY` DISABLE KEYS */;
INSERT INTO `CATEGORY` VALUES (1,'테스트2',0,'테스트 입니다.2','app/file/20200818223940263.jpg','app/file/20200818223940263.jpg','2020-08-17 18:58:01'),(2,'테스트1-2',2,'테스트 입니다.1-2','app/file/20200818235747263.jpg','app/file/20200818235747263.jpg','2020-08-18 19:16:12'),(3,'테스트2-1',1,'테스트 입니다.2-1','app/file/20200818191637263.jpg','app/file/20200818191637263.jpg','2020-08-18 19:16:43'),(4,'테스트3',0,'테스트 입니다.3','app/file/20200818235628263.png','app/file/20200818235628263.png','2020-08-18 23:56:35'),(5,'테스트1-1',2,'테스트 입니다.1-1','app/file/20200818235714263.jpg','app/file/20200818235714263.jpg','2020-08-18 23:57:23'),(6,'테스트4',0,'테스트 입니다.4','app/file/20200819022144263.png','app/file/20200819022144263.png','2020-08-19 02:21:51'),(7,NULL,NULL,NULL,NULL,'app/file/20200819022216263.png','2020-08-19 02:22:27'),(8,'테스트1',0,'테스트 입니다.1','app/file/20200819022255263.jpg','app/file/20200819022255263.jpg','2020-08-19 02:22:59'),(9,'테스터5',0,'테스터 입니다.5','app/file/20200819022508263.png','app/file/20200819022508263.png','2020-08-19 02:25:19'),(10,'테스트6',0,'테스트 입니다.6','app/file/20200819022619263.png','app/file/20200819022619263.png','2020-08-19 02:26:26'),(11,'테스트7',0,'테스트7','/app/images/admin/photo.png','/app/images/admin/photo.png','2020-08-19 02:26:59'),(12,'테스트8',0,'테스트 입니다.8','app/file/real_20201203165801263.jpeg','app/file/20201203165801263.jpeg','2020-08-19 02:29:21'),(13,'테스트9',0,'테스트 입니다.9','app/file/20200819023001263.png','app/file/20200819023001263.png','2020-08-19 02:30:09'),(14,'테스터10',0,'테스트 입니다.10','app/file/20200819023043263.png','app/file/20200819023043263.png','2020-08-19 02:30:50'),(15,'테스터11',0,'테스트 입니다.11','app/file/20200819023126263.jpg','app/file/20200819023126263.jpg','2020-08-19 02:31:36'),(16,'테스터12',0,'테스트 입니다.12','app/file/20200819023252263.jpg','app/file/20200819023252263.jpg','2020-08-19 02:33:00'),(17,'테스트13',0,'테스트 입니다.13','app/file/20200819023556263.jpg','app/file/20200819023556263.jpg','2020-08-19 02:36:03'),(18,'테스트10-1',14,'테스트10-1 입니다.','app/file/20200819025042263.jpg','app/file/20200819025042263.jpg','2020-08-19 02:50:43'),(19,'테스트14',0,'테스트 입니다.14','app/file/20200819025103263.gif','app/file/20200819025103263.gif','2020-08-19 02:51:12'),(20,'테스트2-2',1,'테스트 입니다.2-2','app/file/20200827190006263.jpg','app/file/20200827190006263.jpg','2020-08-27 19:00:14'),(21,'테스트2-3',1,'테스트 입니다.2-3','app/file/20200827191533263.jpg','app/file/20200827191533263.jpg','2020-08-27 19:15:37'),(22,'테스트4-2',6,'테스트 입니다.4-2','app/file/20201028160105263.png','app/file/20201028160105263.png','2020-10-28 16:01:52'),(23,'테스트4-1',6,'테스트 입니다.4-1','app/file/20201028160233263.jpg','app/file/20201028160233263.jpg','2020-10-28 16:02:35'),(24,'테스트3-1',4,'테스트 입니다.3-1','app/file/real_20201028170210263.jpg','app/file/20201028170210263.jpg','2020-10-28 18:22:07'),(25,'테스트4-3',6,'테스트 입니다.4-3','app/file/real_20201028184214263.jpg','app/file/20201028184214263.jpg','2020-10-28 18:42:40'),(26,'테스터5-1',9,'테스트 입니다.5-1','app/file/real_20201028184521263.jpg','app/file/20201028184521263.jpg','2020-10-28 18:45:27'),(27,'테스트1-1',8,'테스트 입니다.1','app/file/real_20201119173404263.jpg','app/file/20201119173404263.jpg','2020-11-19 17:34:12'),(28,'테스트1-2',8,'테스트 입니다.1-2','app/file/real_20201119173433263.jpg','app/file/20201119173433263.jpg','2020-11-19 17:34:41'),(29,'테스트 7-1',11,'테스트 입니다.7-1','app/file/real_20201125190744263.jpg','app/file/20201125190744263.jpg','2020-11-25 19:08:00'),(31,'테스트 13-1',17,'테스트 입니다.13','app/file/real_20201201121919263.jpg','app/file/20201201121919263.jpg','2020-12-01 12:19:28'),(32,'테스트8-2',12,'테스트 입니다.8-2','app/file/real_20201203165830263.jpg','app/file/20201203165830263.jpg','2020-12-03 16:49:24'),(33,'테스트8-1',12,'테스트 입니다.8-1','app/file/real_20201203164942263.jpeg','app/file/20201203164942263.jpeg','2020-12-03 16:49:43'),(34,'테스트2-4',1,'테스트 입니다.2-4','app/file/20201206163311263.png','app/file/20201206163311263.png','2020-12-06 16:33:17'),(35,'테스트2-5',1,'테스트 입니다.2','app/file/20201207111251263.png','app/file/20201207111251263.png','2020-12-07 11:12:53'),(36,'테스트2-6',1,'테스트 입니다.2','app/file/real_20201207182315263.jpg','app/file/20201207182315263.jpg','2020-12-07 18:23:18'),(37,'테스트2-7',1,'테스트 입니다.2-7','app/file/20201208180407263.jpg','app/file/20201208180407263.jpg','2020-12-08 18:04:15'),(38,'테스트9-1',13,'테스트 입니다.9-1','app/file/real_20201209173351263.jpg','app/file/20201209173351263.jpg','2020-12-09 17:33:21'),(39,'테스트11-1',15,'테스트 입니다.11-1','app/file/real_20201217154420263.jpeg','app/file/20201217154420263.jpeg','2020-12-17 15:44:27'),(40,'테스트14-1',19,'테스트14-1 카테고리 입니다.','app/file/real_20201219190047263.jpeg','app/file/20201219190047263.jpeg','2020-12-19 19:00:57'),(41,'테스트12-1',16,'테스트 입니다.12-1','app/file/20201220171326263.png','app/file/20201220171326263.png','2020-12-20 17:13:36'),(42,'테스트13-2',17,'테스트 입니다.13-2','app/file/20201221172410263.png','app/file/20201221172410263.png','2020-12-21 17:24:22'),(43,'테스트5-2',9,'테스트5-2 입니다.','app/file/real_20201222135711263.png','app/file/20201222135711263.png','2020-12-22 13:57:22'),(44,'테스트15',0,'테스트 입니다.15','app/file/real_20201223120950263.jpg','app/file/20201223120950263.jpg','2020-12-23 12:09:59'),(45,'테스트15-1',44,'테스트 입니다.15-1','app/file/real_20201223121026263.jpeg','app/file/20201223121026263.jpeg','2020-12-23 12:10:17'),(46,'테스트16',0,'테스트 입니다.16','app/file/real_20201224110555263.png','app/file/20201224110555263.png','2020-12-24 11:06:01'),(47,'테스트6-1',10,'테스트 입니다.6-1','app/file/20210107173025263.jpg','app/file/20210107173025263.jpg','2021-01-07 17:30:48');
/*!40000 ALTER TABLE `CATEGORY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COUPON`
--

DROP TABLE IF EXISTS `COUPON`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COUPON` (
  `COUPON_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `COUPON_INDEX` varchar(13) DEFAULT NULL,
  `COUPON_TYPE` char(1) DEFAULT NULL,
  `COUPON_STATUS` char(1) DEFAULT '0',
  `COUPON_NAME` varchar(50) DEFAULT NULL,
  `COUPON_CONTEXT` varchar(500) DEFAULT NULL,
  `COUPON_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `COUPON_COUNT` int(11) DEFAULT NULL,
  `COUPON_USED_POINT` int(11) DEFAULT NULL,
  `COUPON_EXT_COUNT` int(11) DEFAULT NULL,
  `COUPON_LIMITED_DATE` datetime DEFAULT current_timestamp(),
  `COUPON_IS_LIMIT` char(1) DEFAULT NULL,
  `COUPON_EXPIRE_DATE` datetime DEFAULT current_timestamp(),
  `COUPON_NO_EXPIRE` char(1) DEFAULT NULL,
  `COUPON_MODI_DATE` datetime DEFAULT current_timestamp(),
  `COUPON_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`COUPON_SEQ`),
  KEY `IDX_COUPON_X01` (`COUPON_INDEX`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COMMENT='쿠폰 정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COUPON`
--

LOCK TABLES `COUPON` WRITE;
/*!40000 ALTER TABLE `COUPON` DISABLE KEYS */;
INSERT INTO `COUPON` VALUES (1,'20201211001','2','2','테스트 쿠폰1','테스트 쿠폰1입니다. 이 쿠폰 테스트입니다. 참고하세요.','app/file/real_20201211120041263.jpeg',25,125,25,'2020-12-24 00:00:00',NULL,'2020-12-30 00:00:00',NULL,'2020-12-15 15:24:42','2020-12-11 12:03:00'),(2,'0002','1','1','테스트 쿠폰2','테스트 쿠폰2 입니다. 이 쿠폰은 테스트입니다. 참고하세요.ㅇㅇㅇ','app/file/real_20201211183521263.jpg',45,10,45,'2020-12-30 00:00:00',NULL,'2020-12-30 00:00:00',NULL,'2020-12-15 17:20:13','2020-12-11 18:38:28'),(3,'20201211002','2',NULL,'테스트 쿠폰3','테스트 쿠폰3 입니다. 테스트 쿠폰입니다.참고하세요.','app/file/real_20201212190746263.jpg',125,NULL,125,NULL,NULL,'2020-12-25 00:00:00',NULL,'2020-12-12 19:08:10','2020-12-12 19:08:10'),(4,'202012120003','1',NULL,'테스트 쿠폰4','테스트 쿠폰4 입니다. 테스트 쿠폰입니다. 참고하세요.','app/file/real_20201212191709263.jpg',125,NULL,125,NULL,NULL,'2020-12-25 00:00:00',NULL,'2020-12-12 19:19:12','2020-12-12 19:19:12'),(5,'202012170004','1','2','테스트 쿠폰5','테스트 쿠폰 5 입니다. 테스트 쿠폰이니 참고하세요. 테스트 5','app/file/real_20201217132314263.jpg',125,25,125,'2020-12-25 00:00:00',NULL,'2020-12-28 00:00:00',NULL,'2020-12-17 13:23:51','2020-12-17 13:23:51'),(6,'202012190005','1','2','테스트 쿠폰6','테스트 쿠폰6 입니다. 테스트 쿠폰인 만큼 참고하세요. 테스트 쿠폰을 받으려면 설명을 참고하세요.','app/file/real_20201219144512263.jpg',125,10,125,'2020-12-25 00:00:00',NULL,'2020-12-28 00:00:00',NULL,'2020-12-19 14:46:44','2020-12-19 14:46:33'),(7,'202012190006','1','2','테스트 쿠폰7','테스트 쿠폰7 입니다. 테스트 쿠폰인 만큼 참고하세요. 설명을 참고하시고 포인트로 구매하세요. 그럼 됩니다.','app/file/real_20201219144710263.jpeg',110,25,110,'0000-00-00 00:00:00','1','0000-00-00 00:00:00','1','2020-12-19 14:48:59','2020-12-19 14:48:59');
/*!40000 ALTER TABLE `COUPON` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `COUPON_LOG`
--

DROP TABLE IF EXISTS `COUPON_LOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `COUPON_LOG` (
  `COUPON_LOG_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `COUPON_SEQ` int(11) DEFAULT NULL,
  `COUPON_MEMBER_SEQ` int(11) DEFAULT NULL,
  `COUPON_ISSUED_TYPE` char(1) DEFAULT NULL,
  `COUPON_ISSUED_POSITION` char(1) DEFAULT NULL,
  `COUPON_EVENT_VOTE_SEQ` int(11) DEFAULT NULL,
  `COUPON_LOG_STATUS` char(1) DEFAULT '0',
  `COUPON_USED_POINT` int(11) DEFAULT 0,
  `COUPON_ISSUED_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`COUPON_LOG_SEQ`),
  KEY `IDX_COUPON_LOG_X01` (`COUPON_SEQ`,`COUPON_MEMBER_SEQ`,`COUPON_EVENT_VOTE_SEQ`,`COUPON_ISSUED_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='쿠폰 발급 이력';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `COUPON_LOG`
--

LOCK TABLES `COUPON_LOG` WRITE;
/*!40000 ALTER TABLE `COUPON_LOG` DISABLE KEYS */;
INSERT INTO `COUPON_LOG` VALUES (1,1,2,'2','2',2,'1',NULL,'2020-12-13 19:12:54'),(2,1,2,'2','2',2,'1',NULL,'2020-12-14 11:57:04'),(3,1,2,'2','2',2,'1',NULL,'2020-12-14 12:11:38'),(4,1,2,'2','2',2,'1',NULL,'2020-12-14 12:16:48'),(5,1,2,'2','2',2,'1',NULL,'2020-12-14 12:24:56'),(6,5,2,'1','1',NULL,'0',25,'2020-12-18 17:46:22'),(7,7,2,'1','1',NULL,'0',25,'2020-12-19 18:21:49'),(8,1,2,'2','2',77,'0',0,'2021-01-03 02:06:11'),(9,2,2,'2','2',76,'0',0,'2021-03-18 04:07:06'),(10,6,2,'1','1',NULL,'0',10,'2021-03-18 04:08:53');
/*!40000 ALTER TABLE `COUPON_LOG` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='회원정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MEMBER`
--

LOCK TABLES `MEMBER` WRITE;
/*!40000 ALTER TABLE `MEMBER` DISABLE KEYS */;
INSERT INTO `MEMBER` VALUES (2,'jyjeon@plustheplus.net','*0262F498E91CA294A8BA96084EEEDB5F635B23A3','테스트01','테스트01','2004-04-19','f','05','0','1','pic/default.png','2020-10-14 04:24:57'),(3,'insoonyi@naver.com','*0262F498E91CA294A8BA96084EEEDB5F635B23A3','테스트02','테스트02','1979-04-15','f','11','0','1','pic/pic_3.png','2021-01-29 03:53:25'),(4,'test02@test.com','*0262F498E91CA294A8BA96084EEEDB5F635B23A3','테스트02','테스트02','1979-02-16','f','18','0','1','pic/default.png','2021-02-23 17:29:48');
/*!40000 ALTER TABLE `MEMBER` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `MESSAGE`
--

DROP TABLE IF EXISTS `MESSAGE`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `MESSAGE` (
  `MESSAGE_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MESSAGE_TYPE` char(2) DEFAULT NULL,
  `SENDER` int(11) DEFAULT NULL,
  `RECVER` int(11) DEFAULT NULL,
  `VIEW_CHECK` char(1) DEFAULT NULL,
  `MESSAGE_POS` varchar(30) DEFAULT NULL,
  `MESSAGE_CONTEXT` varchar(1000) DEFAULT NULL,
  `MESSAGE_REF_URL` varchar(1000) DEFAULT NULL,
  `MESSAGE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`MESSAGE_SEQ`),
  KEY `IDX_MESSAGE_X01` (`SENDER`,`RECVER`,`VIEW_CHECK`,`MESSAGE_TYPE`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COMMENT='쪽지';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `MESSAGE`
--

LOCK TABLES `MESSAGE` WRITE;
/*!40000 ALTER TABLE `MESSAGE` DISABLE KEYS */;
INSERT INTO `MESSAGE` VALUES (3,'2',2,2,'0','votelist','ㅁㅎㄷㅁㅎㅁㅎ',NULL,'2021-01-28 02:06:57'),(4,'2',2,2,'0','votelist','ㅗ너ㅓ것ㄱ',NULL,'2021-01-28 02:09:45'),(5,'2',2,2,'0','votelist','ㅓㅇ사ㅛㅅ료ㅏ',NULL,'2021-01-28 02:10:29'),(6,'2',2,2,'0','votelist','ㄴㅇㄹㄴㄹ',NULL,'2021-01-28 02:35:21'),(7,'2',2,2,'0','votelist','ㅁㅎㄷㅁㅈㅎㅁㅈㅎ',NULL,'2021-01-28 02:35:28'),(8,'2',3,2,'0','votelist','daggag',NULL,'2021-01-29 12:54:38'),(9,'2',3,2,'0','votelist','ㅇㄻㅎㄷㅁㅈㅎㅁㅎ',NULL,'2021-01-29 17:09:00'),(10,'2',2,2,'0','votelist','aegawgawg',NULL,'2021-01-29 17:09:13'),(11,'2',2,2,'0','votelist','ageagag',NULL,'2021-01-29 17:10:17'),(12,'2',2,3,'0','votelist','agawegaga',NULL,'2021-01-29 17:18:28'),(13,'1',112,12,'0','admin',NULL,NULL,'2021-02-03 03:20:10'),(14,'1',112,11,'0','admin',NULL,NULL,'2021-02-03 03:20:11'),(15,'1',112,10,'0','admin',NULL,NULL,'2021-02-03 03:20:11'),(16,'1',112,9,'0','admin',NULL,NULL,'2021-02-03 03:20:11'),(17,'1',112,8,'0','admin',NULL,NULL,'2021-02-03 03:20:11'),(18,'1',112,7,'0','admin',NULL,NULL,'2021-02-03 03:20:11'),(19,'1',112,6,'0','admin',NULL,NULL,'2021-02-03 03:20:11'),(21,'1',112,4,'0','admin',NULL,NULL,'2021-02-03 03:20:11'),(23,'2',2,2,'1','votelist','agawegaw',NULL,'2021-03-25 03:18:53');
/*!40000 ALTER TABLE `MESSAGE` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `OUT_MEMBER_LIST`
--

DROP TABLE IF EXISTS `OUT_MEMBER_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `OUT_MEMBER_LIST` (
  `OUT_MEMBER_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MEMBER_SEQ` int(11) DEFAULT NULL,
  `EMAIL` varchar(100) DEFAULT NULL,
  `JOIN_DATE` timestamp NULL DEFAULT NULL,
  `REGI_DATE` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`OUT_MEMBER_SEQ`),
  KEY `IDX)OUT_MEMBER_LIST_X01` (`MEMBER_SEQ`,`EMAIL`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COMMENT='탈퇴회원';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `OUT_MEMBER_LIST`
--

LOCK TABLES `OUT_MEMBER_LIST` WRITE;
/*!40000 ALTER TABLE `OUT_MEMBER_LIST` DISABLE KEYS */;
INSERT INTO `OUT_MEMBER_LIST` VALUES (1,1,'test01@test.com','2020-08-12 06:22:10','2021-02-23 18:04:45'),(2,1,'test01@test.com','2020-08-12 06:22:10','2021-02-23 18:07:05');
/*!40000 ALTER TABLE `OUT_MEMBER_LIST` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `POINT_INFO`
--

DROP TABLE IF EXISTS `POINT_INFO`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POINT_INFO` (
  `POINT_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `POINT_POSITION` char(3) DEFAULT NULL,
  `POINT` int(11) DEFAULT NULL,
  `POINT_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`POINT_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COMMENT='포인트 관리';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `POINT_INFO`
--

LOCK TABLES `POINT_INFO` WRITE;
/*!40000 ALTER TABLE `POINT_INFO` DISABLE KEYS */;
INSERT INTO `POINT_INFO` VALUES (1,'101',130,'2020-11-30 11:32:53'),(3,'102',52,'2020-11-30 16:51:11');
/*!40000 ALTER TABLE `POINT_INFO` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `POINT_LOG`
--

DROP TABLE IF EXISTS `POINT_LOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `POINT_LOG` (
  `POINT_LOG_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MEMBER_SEQ` int(11) DEFAULT NULL,
  `POINT_POSITION` char(3) DEFAULT NULL,
  `POINT_KIND` char(1) DEFAULT NULL COMMENT '1: 자동\n2: 관리자',
  `POINT_TYPE` char(1) DEFAULT NULL COMMENT '1:증감\n2:차감',
  `POINT` int(11) DEFAULT NULL,
  `POINT_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`POINT_LOG_SEQ`),
  KEY `IDX_POINT_LOG_X01` (`MEMBER_SEQ`,`POINT_POSITION`,`POINT_REGI_DATE`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COMMENT='포인트 지급 이력';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `POINT_LOG`
--

LOCK TABLES `POINT_LOG` WRITE;
/*!40000 ALTER TABLE `POINT_LOG` DISABLE KEYS */;
INSERT INTO `POINT_LOG` VALUES (1,2,'101','2','1',122,'2020-12-01 11:33:49'),(2,2,'101','2','1',130,'2020-12-01 14:48:16'),(3,2,'102','2','1',52,'2020-12-01 17:17:08'),(4,2,'101','2','1',130,'2020-12-01 23:11:20'),(5,2,'102','2','1',52,'2020-12-01 23:12:21'),(6,2,'101','1','1',130,'2020-12-05 18:09:15'),(7,NULL,'101','1','1',130,'2020-12-06 18:16:59'),(8,2,'101','1','1',130,'2020-12-06 18:51:11'),(9,NULL,'101','1','1',130,'2020-12-07 14:14:10'),(10,2,'102','1','1',52,'2020-12-07 15:24:50'),(11,2,'101','1','1',130,'2020-12-07 18:45:43'),(12,2,'102','1','1',52,'2020-12-07 18:45:56'),(13,2,'102','1','1',52,'2020-12-12 19:34:39'),(14,2,'102','1','1',52,'2020-12-12 19:35:23'),(15,2,'102','1','1',52,'2020-12-13 17:36:54'),(16,2,'102','1','1',52,'2020-12-13 19:07:52'),(17,2,'102','1','1',52,'2020-12-13 19:08:11'),(18,2,'102','1','1',52,'2020-12-13 19:10:25'),(19,2,'102','1','1',52,'2020-12-13 19:11:00'),(20,NULL,'101','1','1',130,'2021-01-07 17:59:56'),(21,NULL,'101','1','1',130,'2021-01-07 18:00:28'),(22,NULL,'101','1','1',130,'2021-01-07 18:26:57'),(23,2,'102','1','1',52,'2021-01-07 19:24:11'),(24,3,'101','1','1',130,'2021-01-29 17:08:23'),(25,2,'102','1','1',52,'2021-03-18 04:04:52'),(26,2,'101','1','1',130,'2021-03-27 02:29:42'),(27,2,'102','1','1',52,'2021-03-27 03:29:14'),(28,4,'102','1','1',52,'2021-03-27 03:32:15'),(29,4,'102','1','1',52,'2021-03-27 03:32:34');
/*!40000 ALTER TABLE `POINT_LOG` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COMMENT='상품 정보';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PRODUCT`
--

LOCK TABLES `PRODUCT` WRITE;
/*!40000 ALTER TABLE `PRODUCT` DISABLE KEYS */;
INSERT INTO `PRODUCT` VALUES (1,'1','1개월 / 9,900원','테스트 서비스입니다.','1',9900,'1'),(2,'1','2개월 / 17,000원','테스트 서비스입니다.','1',17000,'1'),(3,'2','1개월 / 33,000원','테스트 서비스입니다.','1',33000,'1'),(4,'2','6개월 / 41,600원','6개월 이벤트 투표 입니다.','1',41600,'1');
/*!40000 ALTER TABLE `PRODUCT` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `REPLY`
--

DROP TABLE IF EXISTS `REPLY`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `REPLY` (
  `REPLY_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `HOST_KIND` char(1) DEFAULT NULL,
  `REPLY_TYPE` char(1) DEFAULT NULL,
  `REPLY_WRITER_SEQ` int(11) DEFAULT NULL,
  `HOST_SEQ` int(11) DEFAULT NULL,
  `PARENT_SEQ` int(11) DEFAULT NULL,
  `REPLY_CONTEXT` varchar(500) DEFAULT NULL,
  `REPLY_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`REPLY_SEQ`),
  KEY `IDX_REPLY_X01` (`REPLY_TYPE`,`REPLY_WRITER_SEQ`,`PARENT_SEQ`,`HOST_SEQ`,`HOST_KIND`)
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COMMENT='답글';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `REPLY`
--

LOCK TABLES `REPLY` WRITE;
/*!40000 ALTER TABLE `REPLY` DISABLE KEYS */;
INSERT INTO `REPLY` VALUES (1,NULL,'1',2,77,0,'ㄶㅁㅎㅁㅈㄷㅎㅁ','2021-01-03 02:25:41'),(2,NULL,'1',2,77,0,'테스트 토스트 트롯트','2021-01-06 00:25:24'),(3,NULL,'1',2,77,0,'다시 테스트 다시 토스트 다시 트롯트','2021-01-06 00:38:27'),(4,'1','1',2,71,0,'테스트는 테스트이고 테스트인데 왜 테스트인지 잘 모르겠다.','2021-01-06 16:14:53'),(5,'1','1',2,71,0,'작가님이 너무나 옳으신 말씀을 하십니다.\r\n사필귀정이란 말씀 동감입니다.\r\n화이팅 입니다 ','2021-01-06 16:15:12'),(7,NULL,'1',2,75,0,'이런 중에 더해서 온라인쇼핑몰 영업시간제한 오프라인쇼핑몰 강제 휴무 추진 이런 기사가 뜨네요 오늘 넘 화나서 대깨문 친구들이랑 싸울 각오하고 퍼 나르고 있습니다ㅜㅅㅜ','2021-01-07 01:01:51'),(9,'2','1',0,42,0,'떠먹여준대도  혼자 다 처먹으려다 밥상 다 엎는 무능하고 욕심만 많은 노망난 노인네.는 누굴까~요?','2021-01-07 17:52:08'),(10,'2','1',0,42,0,'떠먹여준대도  혼자 다 처먹으려다 밥상 다 엎는 무능하고 욕심만 많은 노망난 노인네.는 누굴까~요?','2021-01-07 17:53:12'),(11,'2','1',0,42,0,'떠먹여준대도  혼자 다 처먹으려다 밥상 다 엎는 무능하고 욕심만 많은 노망난 노인네.는 누굴까~요?','2021-01-07 17:54:14'),(12,'2','1',2,42,0,'떠먹여준대도  혼자 다 처먹으려다 밥상 다 엎는 무능하고 욕심만 많은 노망난 노인네.는 누굴까~요?','2021-01-07 17:55:44'),(13,'1','1',2,89,0,' 자칭 \"한을 담은\" 이상민님 성대모사 : 문재인 조국 이재명 홍준표 이명박 박근혜 안철수 \r\n정말 똑같ㅋㅋㅋㅋㅋ 이상민TV 화이팅!!','2021-01-08 00:03:34'),(15,'1','1',0,89,0,'테스트 합니다.','2021-01-08 18:00:29'),(16,'1','1',0,89,0,'테스트 합니다.','2021-01-08 18:00:59'),(17,NULL,NULL,0,NULL,16,'ㅇㅁㅎㄷㅁㅎㅁㅎ','2021-01-13 18:16:59'),(18,'1','1',0,89,16,'dageawg','2021-01-15 18:40:08'),(19,'1','1',0,89,13,'ageagag','2021-01-15 18:40:36'),(20,'1','1',0,89,0,'ㅁㅎㄷㅁㅈㅎㅁㅈㅎ','2021-01-15 18:50:07'),(21,'1','1',0,89,20,'ㅁㄷㅎㅁㅎㅁㅈㅎㅁㅈㅎㄷ','2021-01-15 18:50:13'),(22,'1','1',0,89,20,'ㅁㄷㅎㅁㅎㅁㅈㅎㅁㅈㅎㄷ','2021-01-15 18:52:02'),(23,'1','1',0,89,0,'ㅁㅎㅁㅎㄷㅁㅈㅎㅈ3243','2021-01-15 18:55:46'),(24,'1','1',0,89,23,'ㅁㅈㄷㅎㅁㅈㅎㅁㅈㄷㅎㅁ','2021-01-15 18:56:01'),(25,'1','1',0,89,23,'ㅁㄷㅎㅁㅈㅎㅁㅈㅎ','2021-01-15 18:56:07'),(26,'1','1',0,89,23,'ㅁㅈㄷㅁㅎㅁㅈㅎ도모모모','2021-01-15 18:56:12'),(27,'1','1',2,89,26,'테스트입니다.','2021-01-19 02:08:46'),(28,'1','1',2,89,15,'ageagaga','2021-01-19 02:47:11'),(29,'2','1',2,37,0,'테스트입니다.','2021-01-19 03:13:52'),(30,'2','1',2,37,29,'x테스티ㅓㅣㅓㅣㄻㄹ','2021-01-19 03:21:04'),(31,'1','1',2,89,0,'ssdsfs','2021-03-18 04:05:17'),(32,'2','1',2,43,0,'agewagawgawg','2021-03-27 01:33:52'),(33,'2','1',2,43,32,'ageagagawg','2021-03-27 01:34:05'),(34,'1','1',4,91,0,'ㅌㅁㅎㅁㅎㄷㅁㅈㅎ','2021-03-27 03:33:08');
/*!40000 ALTER TABLE `REPLY` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SUBSCRIBE_VOTE_LIST`
--

DROP TABLE IF EXISTS `SUBSCRIBE_VOTE_LIST`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SUBSCRIBE_VOTE_LIST` (
  `SUBSCRIBE_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `MEMBER_SEQ` int(11) DEFAULT NULL COMMENT '투표 개설자',
  `USER_SEQ` int(11) DEFAULT NULL COMMENT '구독 신청자',
  `REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`SUBSCRIBE_SEQ`),
  KEY `IDX_SUBSCRIBE_VOTE_LIST_X01` (`MEMBER_SEQ`,`USER_SEQ`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='구독';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SUBSCRIBE_VOTE_LIST`
--

LOCK TABLES `SUBSCRIBE_VOTE_LIST` WRITE;
/*!40000 ALTER TABLE `SUBSCRIBE_VOTE_LIST` DISABLE KEYS */;
/*!40000 ALTER TABLE `SUBSCRIBE_VOTE_LIST` ENABLE KEYS */;
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
  `VOTE_CONTEXT` varchar(250) DEFAULT NULL,
  `VOTE_CATE_SEQ` int(10) DEFAULT NULL,
  `VOTE_CATE_SUB_SEQ` int(10) DEFAULT NULL,
  `VOTE_RESOURCE_PATH` varchar(1000) DEFAULT NULL,
  `VOTE_RESOURCE_TYPE` char(1) DEFAULT NULL,
  `VOTE_URL` varchar(100) DEFAULT NULL,
  `VOTE_VIEW_COUNT` int(11) DEFAULT 0,
  `VOTE_PARTICIPATE_COUNT` int(11) DEFAULT 0,
  `VOTE_RECOMM_COUNT` int(11) DEFAULT 0,
  `VOTE_END_DATE` date DEFAULT NULL,
  `VOTE_EVENT_MOVIE_URL` varchar(1000) DEFAULT NULL,
  `VOTE_EVENT_PHONE` varchar(15) DEFAULT NULL,
  `VOTE_EVENT_REAL_FILE` varchar(100) DEFAULT NULL,
  `VOTE_EVENT_FILE` varchar(100) DEFAULT NULL,
  `VOTE_IS_OPEN` char(1) DEFAULT NULL,
  `VOTE_IS_PREMIUM` char(1) DEFAULT NULL,
  `VOTE_IS_START` char(1) DEFAULT NULL,
  `VOTE_IS_EVENT` char(1) DEFAULT NULL,
  `VOTE_IS_HOT` char(1) DEFAULT NULL,
  `VOTE_EVENT_CONTEXT_SEQ` int(11) DEFAULT NULL,
  `VOTE_SECURITY_CODE` varchar(200) DEFAULT NULL,
  `VOTE_OPEN_POINT` int(11) DEFAULT NULL,
  `VOTE_RESP_POINT` int(11) DEFAULT NULL,
  `COUPON_SEQ` int(11) DEFAULT NULL,
  `VOTE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`VOTE_SEQ`),
  KEY `IDX_VOTE_X01` (`VOTE_SEQ`,`VOTE_WRITER_SEQ`,`VOTE_SECURITY_CODE`)
) ENGINE=InnoDB AUTO_INCREMENT=92 DEFAULT CHARSET=utf8 COMMENT='투표';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE`
--

LOCK TABLES `VOTE` WRITE;
/*!40000 ALTER TABLE `VOTE` DISABLE KEYS */;
INSERT INTO `VOTE` VALUES (1,2,'1','1','테스트 투표양식7 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 12:40:50'),(2,2,'1','1','테스트 투표 양식8 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 18:04:01'),(3,2,'1','1','테스트 투표 양식8 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 18:21:46'),(4,2,'1','2','테스트 투표8 테스트 투표 입니다.',NULL,20,20,'app/file/20201020192128263.png','1','naver.com',0,0,0,'2020-10-23',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 19:23:59'),(5,2,'1','1','테스트 투표 8 테스트 투표 입니다.',NULL,20,20,'app/file/20201020225352263.jpg','1','naver.com',0,0,0,'2020-10-24',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 22:56:31'),(6,2,'1','1','테스트 투표9 테스트 투표 입니다.',NULL,3,3,'app/file/20201020231133263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 23:12:30'),(7,2,'1','1','테스트 투표9 테스트 투표 입니다.',NULL,3,3,'app/file/20201020231133263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 23:16:20'),(8,2,'1','1','테스트 투표9 테스트 투표 입니다.',NULL,3,3,'app/file/20201020231133263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 23:17:01'),(9,2,'1','1','테스트 투표9 테스트 투표 입니다.',NULL,3,3,'app/file/20201020231133263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 23:24:10'),(10,2,'1','1','테스트 투표9 테스트 투표 입니다.',NULL,3,3,'app/file/20201020231133263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 23:27:07'),(11,2,'1','1','테스트 투표9 테스트 투표 입니다.',NULL,3,3,'app/file/20201020231133263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-20 23:42:47'),(12,2,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:08:59'),(13,2,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:10:00'),(14,2,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:10:40'),(15,2,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:17:33'),(16,2,'1','1','테스트 투표양식7-2 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:18:33'),(17,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:37:56'),(18,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:38:49'),(19,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:39:06'),(20,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 11:42:32'),(21,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 15:33:04'),(22,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 15:33:45'),(23,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:17:58'),(24,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:29:48'),(25,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:30:07'),(26,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:30:25'),(27,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:30:52'),(28,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:31:21'),(29,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:31:23'),(30,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:31:23'),(31,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:31:23'),(32,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:33:16'),(33,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-10-21 16:33:37'),(34,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'b3RtcC9uUGFPcytXYkwxYUQ4TExSQTRONVlvPQ==',NULL,NULL,NULL,'2020-10-21 16:36:05'),(35,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'L2poaFNRU00xMkgzTVVjMWZPMlJ3WWpwUVRZPQ==',NULL,NULL,NULL,'2020-10-21 16:36:08'),(36,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'dWNzPQ==',NULL,NULL,NULL,'2020-10-21 16:36:59'),(37,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'a1NNPQ==',NULL,NULL,NULL,'2020-10-21 16:37:00'),(38,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'TG9ZPQ==',NULL,NULL,NULL,'2020-10-21 16:37:01'),(39,2,'1','1','테스트 투표양식7-1 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'eDhRRjJXQnZ0TFN2cUhvPQ==',NULL,NULL,NULL,'2020-10-21 16:38:19'),(40,2,'1','1','테스트 투표 9 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-31',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'NXNUTkFRN2VFaldEU25ZPQ==',NULL,NULL,NULL,'2020-10-22 11:34:15'),(41,2,'1','1','테스트 투표양식7 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'SEU1NU83dVdaZFRPOXlNPQ==',NULL,NULL,NULL,'2020-10-23 11:40:58'),(42,2,'1','1','테스트 투표 양식9 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'VUttaS9iS0tpelBXVkUwPQ==',NULL,NULL,NULL,'2020-10-24 16:00:22'),(43,2,'1','1','테스트 투표양식7 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'TjJ3SUdYY2tDakVPMHdRPQ==',NULL,NULL,NULL,'2020-10-25 15:31:42'),(44,2,'1','1','테스트 투표양식7 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'ZVpSRlYzUGhPR2FpYjJZPQ==',NULL,NULL,NULL,'2020-10-25 22:56:11'),(45,2,'1','1','테스트 투표양식7 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,'0','1',NULL,NULL,NULL,NULL,'UzFzb2NPWGFTMlgxZ0ZnPQ==',NULL,NULL,NULL,'2020-10-26 11:45:47'),(46,2,'1','1','테스트 투표양식7 테스트 투표 입니다.',NULL,14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,'1',NULL,NULL,NULL,NULL,NULL,'QWt1Mlpwc0Zpc2ZvN3ZBPQ==',NULL,NULL,NULL,'2020-10-26 23:16:53'),(47,2,'1','1','테스트 투표양식7 테스트 투표 입니다.','테스트 투표7 입니다. 참고하세요.',14,18,'app/file/20200819023043263.png','1','naver.com',0,0,0,'2020-10-29',NULL,NULL,NULL,NULL,'0','1',NULL,NULL,NULL,NULL,'NnFSU24yeGxTdkV0N1FnPQ==',NULL,NULL,NULL,'2020-10-27 11:13:01'),(48,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,0,0,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-11-08 02:16:53'),(49,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,0,0,NULL,NULL,NULL,NULL,NULL,'0','1',NULL,NULL,NULL,NULL,'UVJubzhHKzQvclkrVEN3PQ==',NULL,NULL,NULL,'2020-11-08 02:28:44'),(50,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,0,0,NULL,NULL,NULL,NULL,NULL,'1',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-11-09 19:21:39'),(51,2,'1','2','테스트 투표 양식12 테스트 투표 입니다. 관리자3','테스트 투표 양식12 테스트 투표 입니다. 관리자3',6,22,'https://www.youtube.com/embed/-vBniaKo-Uk',NULL,'naver.com',0,0,0,'2020-11-29',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'cm9iQ0xSUGs3dmY5dHF3PQ==',NULL,NULL,NULL,'2020-11-09 19:28:19'),(52,2,'1','2','테스트 투표 양식12 테스트 투표 입니다. 관리자2','테스트 투표 양식12 테스트 투표 입니다. 관리자2',23,23,'https://www.youtube.com/embed/-vBniaKo-Uk',NULL,'naver.com',0,0,0,'2020-11-26',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'RURsRm12U0EvMFQ1VlVnPQ==',NULL,NULL,NULL,'2020-11-10 00:45:18'),(53,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다. 관리자1',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk',NULL,'naver.com',0,0,0,'2020-11-20',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'ZVcwNFRpNnR5VTlqRkdzPQ==',NULL,NULL,NULL,'2020-11-10 01:28:28'),(54,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',14,18,'https://www.youtube.com/embed/Wm3clZgbifY','3','naver.com',0,0,0,'2020-12-30',NULL,NULL,NULL,NULL,NULL,'1','0',NULL,NULL,NULL,'WEJ5Mkl4TXo1WXBHZ2E4PQ==',NULL,NULL,NULL,'2020-11-10 01:50:10'),(55,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',14,18,NULL,'3','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'S3dVNDkwbzkyalp1VDA0PQ==',NULL,NULL,NULL,'2020-11-14 00:26:45'),(56,2,'1','2','테스트 투표 양식13 테스트 투표 입니다.','테스트 투표 양식13 테스트 투표 입니다.',14,18,'https://www.youtube.com/embed/Wm3clZgbifY','3','naver.com',0,0,0,'2020-11-30',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'RXJ4TnpUTCtWZE5aV1VZPQ==',NULL,NULL,NULL,'2020-11-14 17:40:59'),(57,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,0,0,'2020-10-30',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'T09xMks0cXQ4dDFYeXFnPQ==',NULL,NULL,NULL,'2020-11-14 18:14:52'),(58,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'enU0K2phck94M3Z0SDUwPQ==',NULL,NULL,NULL,'2020-11-15 20:35:28'),(59,2,'1','2','테스트 투표 양식14 테스트 투표 입니다.','테스트 투표 양식14 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,0,0,'2020-11-30',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'K1Uxd0dNbXJMVXZQeElVPQ==',NULL,NULL,NULL,'2020-11-16 11:39:54'),(60,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,'1',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-11-16 17:43:46'),(61,2,'1','2','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,2,0,'9999-12-31',NULL,NULL,NULL,NULL,'1',NULL,'0',NULL,NULL,NULL,'cUxKUks2QnU3a1dlblhNPQ==',NULL,NULL,NULL,'2020-11-16 17:45:03'),(62,2,'1','1','테스트 투표 양식11 테스트 투표 입니다.','테스트 투표 양식11 테스트 투표 입니다.',9,26,'app/file/20200819023043263.png','1','naver.com',0,24,0,'2020-11-30',NULL,NULL,NULL,NULL,'1',NULL,'0',NULL,NULL,NULL,'c3I2R0dNNVZWcnY4bExVPQ==',NULL,NULL,NULL,'2020-11-17 11:58:00'),(63,2,'1','2','테스트 투표 양식14 테스트 투표 입니다.','테스트 투표 양식14 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,13,0,'2020-11-30',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'SEtZSm55MXVlQjg4WHUwPQ==',NULL,NULL,NULL,'2020-11-18 12:05:12'),(64,2,'1','1','테스트 투표 양식14 테스트 투표 입니다.','테스트 투표 양식14 테스트 투표 입니다.',8,27,'https://i.ytimg.com/vi/yY6XnbWnK4o/maxresdefault.jpg','2','naver.com',0,5,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'SCtEVTg2UGp5NWJPRnZJPQ==',NULL,NULL,NULL,'2020-11-21 00:00:30'),(65,2,'1','3','테스트 투표 양식15 테스트 투표 입니다.','테스트 투표 양식15 테스트 투표 입니다.',11,29,'app/file/real_20201125190744263.jpg','','naver.com',0,1,0,'2020-11-30',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'RTB2eUJoZzZUMUdhRG1zPQ==',NULL,NULL,NULL,'2020-11-26 17:11:18'),(66,2,'1','1','테스트 투표 16 테스트 투표 입니다.','테스트 투표 16 테스트 투표 입니다.',12,30,'app/file/20200819022914263.png','','naver.com',0,0,0,'2020-11-30',NULL,NULL,NULL,NULL,'1',NULL,'0',NULL,NULL,NULL,NULL,NULL,NULL,NULL,'2020-11-27 17:42:03'),(67,2,'1','1','테스트 투표 16 테스트 투표 입니다.','테스트 투표 16 테스트 투표 입니다.',12,30,'app/file/20200819022914263.png','','naver.com',0,15,0,'2020-11-30',NULL,NULL,NULL,NULL,'0','1','0',NULL,NULL,NULL,'SlZRQ1htMGtHaVVySW9BPQ==',252,52,NULL,'2020-11-27 17:46:43'),(68,2,'1','1','테스트 투표 17 테스트 투표 입니다.','테스트 투표 17 테스트 투표 입니다.',17,31,'app/file/real_20201201144350263.jpg','','naver.com',0,0,0,'2020-12-05',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'1',NULL,NULL,NULL,NULL,NULL,'2020-12-01 14:47:12'),(69,2,'1','1','테스트 투표 17 테스트 투표 입니다.','테스트 투표 17 테스트 투표 입니다.',17,31,'app/file/real_20201201144350263.jpg','','naver.com',0,2,0,'2020-12-05',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'RDIvd3RMVDdPY2hnanFNPQ==',252,52,NULL,'2020-12-01 14:48:16'),(70,2,'1','1','테스트 투표 18 테스트 투표 입니다.','테스트 투표 18 테스트 투표 입니다.',17,31,'https://i.ytimg.com/vi/yY6XnbWnK4o/maxresdefault.jpg','2','naver.com',0,1,0,'2020-12-10',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'UVRFWWdubm1hbTJaOEw0PQ==',130,52,NULL,'2020-12-01 23:11:20'),(71,2,'1','4','테스트 투표 양식16 테스트 투표 입니다.','테스트 투표 양식16 테스트 투표 입니다.',12,32,'app/file/real_20201203165830263.jpg','','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'Qllxa25ualkxdkd1LytNPQ==',130,52,NULL,'2020-12-05 18:09:15'),(72,2,'1','4','테스트 투표 양식17 테스트 투표 입니다.','테스트 투표 양식17 테스트 투표 입니다.',1,34,'app/file/20201206163311263.png','','naver.com',0,0,0,'2020-12-10',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,'1',NULL,'NmZqWVdXQ3NpaGYyUDBjPQ==',130,52,NULL,'2020-12-06 18:16:59'),(73,2,'1','4','테스트 투표 양식17 테스트 투표 입니다.','테스트 투표 양식17 테스트 투표 입니다.',1,34,'app/file/20201206163311263.png','','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'SWdlNmVpNzF0WFd1allvPQ==',130,52,NULL,'2020-12-06 18:51:11'),(74,2,'1','4','테스트 투표 양식18 테스트 투표 입니다.','테스트 투표 양식18 테스트 투표 입니다.',1,35,'app/file/20201207111251263.png','','naver.com',0,1,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'em02QzFJWWpVMjQrKzBFPQ==',130,52,NULL,'2020-12-07 14:14:10'),(75,2,'1','2','테스트 투표 양식19 테스트 투표 입니다.','테스트 투표 양식19 테스트 투표 입니다.',1,36,'https://www.incimages.com/uploaded_files/image/1024x576/getty_615524918_379849.jpg','2','daum.net',0,1,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,'0',NULL,NULL,NULL,'MDR5d3JTSWs3ZTFMY3hrPQ==',130,52,NULL,'2020-12-07 18:45:43'),(76,2,'2','1','테스트 투표 20 테스트 투표 입니다.','테스트 투표 20 테스트 투표 입니다.',1,37,'app/file/20201208180407263.jpg','','naver.com',0,1,0,'2020-12-31','https://youtu.be/f4T8JOVcw0g','01045457878','undefined','플러스더플러스_일정표_20201028.xlsx','1',NULL,'0',NULL,NULL,NULL,'WjBJTXRIVHdhVjk4MUx3PQ==',130,52,2,'2020-12-08 18:21:04'),(77,2,'2','1','테스트 투표 21 이벤트 투표 입니다.','테스트 투표 21 이벤트 투표 입니다.',13,38,'app/file/real_20201209173351263.jpg','','daum.net',0,15,0,'2020-12-23','https://youtu.be/f4T8JOVcw0g','01045457878','app/file/real_20201209173813263.hwp','틀리기쉬운띄어쓰기[1].hwp',NULL,NULL,'0',NULL,NULL,NULL,'Kzg4bDljOVBjYTNRZk53PQ==',130,52,1,'2020-12-09 17:39:19'),(78,2,'2','2','테스트 투표 22 테스트 투표 입니다.','테스트 투표 22 테스트 투표 입니다. 테스트인 만큼 참고하시고 아래의 질문을 보고 답을 해보세요.',17,31,'https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','daum.net',0,0,0,'2020-12-24','https://youtu.be/f4T8JOVcw0g','01045457878','app/file/real_20201219183809263.0_20201214','모아투미_기획_초안_v1.0_20201214.pptx',NULL,NULL,'0',NULL,NULL,NULL,NULL,130,52,NULL,'2020-12-19 18:49:51'),(79,2,'2','1','테스트 투표 22 테스트 투표 입니다.','테스트 투표 22 테스트 투표 입니다. 여러분들에게 머리 속에 그리고 생각해보세요. 그럼 얼마나 해야 할까요? 얼마나 노력해야 할까요?',19,40,'https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','naver.com',0,0,0,'2020-12-29','https://youtu.be/f4T8JOVcw0g','01045457878','app/file/real_20201219190210263.1','플러스더플러스프로젝트_디자인제작_ᄀ ᅨ약서_20201210_v.1.1.doc',NULL,NULL,'0',NULL,NULL,NULL,'dDdGODVzZTRrMXNTQ0ljPQ==',130,52,NULL,'2020-12-19 19:25:22'),(80,0,'2','2','테스트 투표 23 테스트 투표 입니다.','테스트 투표 23 테스트 투표 입니다. 참고하세요. 제발 좀 연락 좀 해라~!!!',16,41,'https://youtu.be/-vBniaKo-Uk','3','daum.net',0,0,0,'2020-12-30','https://youtu.be/f4T8JOVcw0g','01045457878','app/file/real_20201220171515263.hwp','틀리기쉬운띄어쓰기[1].hwp',NULL,NULL,'0',NULL,NULL,NULL,'bkEyemRyMmhMMlJRbEpBPQ==',130,52,NULL,'2020-12-20 17:36:17'),(81,2,'2','2','테스트 투표 23 투표 입니다.','테스트 투표 23 테스트 투표 입니다. 정말 테스트입니다.\r\n테스트 알아주세요. 테스트 입니다.',17,42,'app/file/real_20201221172515263.jpg','1','naver.com',0,0,0,'2020-12-21',NULL,'01045457878','app/file/real_20201221172536263.hwp','틀리기쉬운띄어쓰기[1].hwp',NULL,NULL,'0',NULL,NULL,NULL,'RkFoMkdNY25CZnVrcUdrPQ==',130,52,NULL,'2020-12-21 17:26:42'),(82,2,'2','2','테스트 투표 24 투표 입니다.','테스트 투표 24 테스트 투표 입니다. 정말 테스트입니다.\r\n테스트 알아주세요. 테스트 입니다.',17,NULL,'https://i.ytimg.com/vi/yY6XnbWnK4o/maxresdefault.jpg','2','naver.com',0,0,0,'2020-12-21',NULL,'01045457878','','틀리기쉬운띄어쓰기[1].hwp',NULL,NULL,'0','1',NULL,NULL,'OGVHNllseXE2elZKZm9vPQ==',130,52,NULL,'2020-12-21 18:58:48'),(83,2,'2','2','테스트 투표 양식20 테스트 투표 입니다.','테스트 투표 양식20 테스트 투표 입니다.',9,43,'app/file/real_20201222135711263.png','','daum.net',0,0,0,'2020-12-25',NULL,'01045457878','app/file/real_20201222141338263.hwp','틀리기쉬운띄어쓰기[1].hwp','0','1','0','1',NULL,NULL,'ay9BR3RqNGIxWUd5aU8wPQ==',130,52,NULL,'2020-12-22 14:18:44'),(84,2,'2','2','테스트 투표 양식21 테스트 투표 입니다.','테스트 투표 양식21 테스트 투표 입니다.',44,45,'https://www.youtube.com/embed/-vBniaKo-Uk','3','naver.com',0,0,0,'2020-12-30',NULL,'01045457878','app/file/real_20201223174134263.hwp','틀리기쉬운띄어쓰기[1].hwp','0','1','0','1',NULL,NULL,'eVJPTm1WQ0tyNWpDVFQwPQ==',130,52,NULL,'2020-12-23 17:43:03'),(85,2,'2','1','테스트 투표17 테스트 투표 입니다.','테스트 투표17 테스트 투표 입니다. 참고하세요. 모르면 안됩니다. 꼭 하세요. ㅎㅎㅎㅎ',12,33,'https://youtu.be/Nivm0Rs_lAA','3','daum.net',0,0,0,'2020-12-25',NULL,'01045457878','app/file/real_20201224122542263.hwp','틀리기쉬운띄어쓰기[1].hwp','0','1','0','1',NULL,NULL,'UDUvY0xBa05NNklSWTkwPQ==',130,52,NULL,'2020-12-24 12:25:56'),(86,2,'2','2','테스트 투표 양식20 테스트 투표25 입니다.','테스트 투표 양식20 테스트 투표25 입니다.',4,24,'https://i.ytimg.com/vi/yY6XnbWnK4o/maxresdefault.jpg','2','naver.com',0,0,0,'2020-12-31',NULL,'01045457878','app/file/real_20201226183245263.hwp','틀리기쉬운띄어쓰기[1].hwp','0',NULL,'0','1',NULL,NULL,'azhEMi9pWGdkaTJtWFJRPQ==',130,52,7,'2020-12-26 18:33:36'),(87,0,'1','1','테스트 투표 양식22 테스트 투표 입니다.','테스트 투표 양식22 테스트 투표 입니다',10,47,'app/file/20210107173025263.jpg','','naver.com',0,0,0,'2021-01-29',NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,NULL,'QnJIaGR2NTN6czJhN3ZzPQ==',130,52,NULL,'2021-01-07 17:59:56'),(88,2,'1','1','테스트 투표 양식22 테스트 투표 입니다.','테스트 투표 양식22 테스트 투표 입니다',10,47,'app/file/20210107173025263.jpg','','naver.com',0,0,0,'9999-12-31',NULL,NULL,NULL,NULL,NULL,NULL,'0','0',NULL,NULL,'WkwySzRmRXVzNEJzbFVZPQ==',130,52,NULL,'2021-01-07 18:00:28'),(89,2,'1','1','테스트 투표 양식22 테스트 투표 입니다.','테스트 투표 양식22 테스트 투표 입니다',10,47,'app/file/20210107173025263.jpg','','naver.com',0,2,0,'9999-12-31',NULL,NULL,NULL,NULL,'0','1','0','0',NULL,NULL,'N2twNDg3SzZkM091QSt3PQ==',130,52,NULL,'2021-01-07 18:26:57'),(90,3,'1','1','테스트 투표 양식12 테스트 투표 입니다.','테스트 투표 양식12 테스트 투표 입니다.',9,26,'app/file/real_20201028184521263.jpg','1','naver.com',0,0,0,'2021-01-21',NULL,NULL,NULL,NULL,NULL,NULL,'0','0','1',NULL,'dDBLdjVTbFA5SjlpdHpjPQ==',130,52,NULL,'2021-01-29 17:08:23'),(91,2,'1','2','테스트 투표 양식25 테스트 투표 입니다.','테스트 투표 양식25 테스트 투표 입니다.',4,24,'https://img.kr.news.samsung.com/kr/wp-content/uploads/2018/06/0705story1.jpg','2','naver.com',0,3,0,'2021-03-31',NULL,NULL,NULL,NULL,'0','1','0','0',NULL,NULL,'OGNoSWpNMjlyd3hMa2ZBPQ==',130,52,NULL,'2021-03-27 02:29:42');
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
  `VOTE_CLASS` char(1) DEFAULT NULL,
  `VOTE_TYPE` char(1) DEFAULT NULL,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `QUESTION_SEQ` int(11) DEFAULT NULL,
  `ANSWER_INDEX` int(11) DEFAULT NULL,
  `ANSWER_TEXT` varchar(250) DEFAULT NULL,
  `ANSWER_TYPE` char(1) DEFAULT NULL,
  `IS_CORRECT` char(1) DEFAULT NULL,
  `ANSWER_RESOURCE_PATH` varchar(1000) DEFAULT NULL,
  `ANSWER_RESOURCE_TYPE` char(1) DEFAULT NULL,
  `ANSWER_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ANSWERS_SEQ`),
  KEY `IDX_ANSWER_X01` (`VOTE_SEQ`,`QUESTION_SEQ`,`ANSWER_REGI_DATE`)
) ENGINE=InnoDB AUTO_INCREMENT=793 DEFAULT CHARSET=utf8 COMMENT='투표 질문의 응답';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_ANSWERS`
--

LOCK TABLES `VOTE_ANSWERS` WRITE;
/*!40000 ALTER TABLE `VOTE_ANSWERS` DISABLE KEYS */;
INSERT INTO `VOTE_ANSWERS` VALUES (298,NULL,NULL,NULL,NULL,NULL,NULL,NULL,NULL,'app/file/20200927183339263.jpg',NULL,'2020-10-20 11:56:39'),(299,NULL,'2',0,165,0,'테스트7 질문1 응답1','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-20 12:40:50'),(300,NULL,'2',0,165,1,'테스트7 질문1 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-20 12:40:50'),(301,NULL,'2',0,166,0,'테스트7 질문2 응답1','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-20 12:40:50'),(302,NULL,'2',0,166,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-20 12:40:50'),(303,NULL,'2',0,167,0,'테스트7 질문3 응답1','1','0','app/file/20201020123443263.png',NULL,'2020-10-20 12:40:50'),(304,NULL,'2',0,167,1,'테스트7 질문3 응답2','1','0','app/file/20201020123458263.jpg',NULL,'2020-10-20 12:40:50'),(305,NULL,'2',0,168,0,'테스트8질문1 응답1','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-20 18:04:01'),(306,NULL,'2',0,168,1,'테스트8 질문1 응답2','1','0','app/file/20201020180106263.jpg',NULL,'2020-10-20 18:04:01'),(307,NULL,'2',0,169,0,'테스트8 질문2 응답1','1','0','app/file/20201020180135263.png',NULL,'2020-10-20 18:04:01'),(308,NULL,'2',0,169,1,'테스트8 질문2 응답2','1','0','app/file/20201020180144263.jpg',NULL,'2020-10-20 18:04:01'),(309,NULL,'2',0,170,0,'테스트8질문1 응답1','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-20 18:21:46'),(310,NULL,'2',0,170,1,'테스트8 질문1 응답2','1','0','app/file/20201020180106263.jpg',NULL,'2020-10-20 18:21:46'),(311,NULL,'2',0,171,0,'테스트8 질문2 응답1','1','0','app/file/20201020180135263.png',NULL,'2020-10-20 18:21:46'),(312,NULL,'2',0,171,1,'테스트8 질문2 응답2','1','0','app/file/20201020180144263.jpg',NULL,'2020-10-20 18:21:46'),(313,NULL,'2',0,172,0,'테스트8 질문1 응답1','1','0','app/file/20201020192339263.png',NULL,'2020-10-20 19:23:59'),(314,NULL,'2',0,172,1,'테스트8 질문1 응답2','1','0','app/file/20201020192351263.png',NULL,'2020-10-20 19:23:59'),(315,NULL,'2',0,173,0,'테스트 투표 8 질문1 응답1입니다.','1','0','app/file/20201020225612263.png',NULL,'2020-10-20 22:56:31'),(316,NULL,'2',0,173,1,'테스트 투표 8 질문1 응답2입니다.','1','0','app/file/20201020225625263.png',NULL,'2020-10-20 22:56:31'),(317,NULL,'2',0,174,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png',NULL,'2020-10-20 23:12:30'),(318,NULL,'2',0,174,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png',NULL,'2020-10-20 23:12:30'),(319,NULL,'2',7,175,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png',NULL,'2020-10-20 23:16:20'),(320,NULL,'2',7,175,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png',NULL,'2020-10-20 23:16:20'),(321,NULL,'2',8,176,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png',NULL,'2020-10-20 23:17:01'),(322,NULL,'2',8,176,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png',NULL,'2020-10-20 23:17:01'),(323,NULL,'2',9,177,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png',NULL,'2020-10-20 23:24:10'),(324,NULL,'2',9,177,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png',NULL,'2020-10-20 23:24:10'),(325,NULL,'2',10,178,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png',NULL,'2020-10-20 23:27:07'),(326,NULL,'2',10,178,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png',NULL,'2020-10-20 23:27:07'),(327,NULL,'2',11,179,0,'테스트9 질문1 응답1','1','0','app/file/20201020231213263.png',NULL,'2020-10-20 23:42:47'),(328,NULL,'2',11,179,1,'테스트9 질문1 응답2','1','0','app/file/20201020231222263.png',NULL,'2020-10-20 23:42:47'),(329,NULL,'2',12,180,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png',NULL,'2020-10-21 11:08:59'),(330,NULL,'2',12,180,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:08:59'),(331,NULL,'2',13,181,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png',NULL,'2020-10-21 11:10:00'),(332,NULL,'2',13,181,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:10:00'),(333,NULL,'2',14,182,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png',NULL,'2020-10-21 11:10:40'),(334,NULL,'2',14,182,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:10:40'),(335,NULL,'2',15,183,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png',NULL,'2020-10-21 11:17:33'),(336,NULL,'2',15,183,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:17:33'),(337,NULL,'2',16,184,0,'테스트7-2 질문1 응답1','1','0','app/file/20201021110730263.png',NULL,'2020-10-21 11:18:33'),(338,NULL,'2',16,184,1,'테스트7-2 질문1 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:18:33'),(339,NULL,'2',17,185,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-21 11:37:56'),(340,NULL,'2',17,185,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-21 11:37:56'),(341,NULL,'2',17,186,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-21 11:37:56'),(342,NULL,'2',17,186,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:37:56'),(343,NULL,'2',18,187,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-21 11:38:49'),(344,NULL,'2',18,187,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-21 11:38:49'),(345,NULL,'2',18,188,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-21 11:38:49'),(346,NULL,'2',18,188,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:38:49'),(347,NULL,'2',19,189,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-21 11:39:06'),(348,NULL,'2',19,189,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-21 11:39:06'),(349,NULL,'2',19,190,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-21 11:39:06'),(350,NULL,'2',19,190,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:39:06'),(351,NULL,'2',20,191,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-21 11:42:32'),(352,NULL,'2',20,191,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-21 11:42:32'),(353,NULL,'2',20,192,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-21 11:42:32'),(354,NULL,'2',20,192,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 11:42:32'),(355,NULL,'2',21,193,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-21 15:33:04'),(356,NULL,'2',21,193,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-21 15:33:04'),(357,NULL,'2',21,194,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-21 15:33:04'),(358,NULL,'2',21,194,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 15:33:04'),(359,NULL,'2',22,195,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-21 15:33:45'),(360,NULL,'2',22,195,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-21 15:33:45'),(361,NULL,'2',22,196,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-21 15:33:45'),(362,NULL,'2',22,196,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-21 15:33:45'),(447,NULL,'2',44,239,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-25 22:56:11'),(448,NULL,'2',44,239,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-25 22:56:11'),(449,NULL,'2',44,240,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-25 22:56:11'),(450,NULL,'2',44,240,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-25 22:56:11'),(451,NULL,'2',45,241,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-26 11:45:47'),(452,NULL,'2',45,241,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-26 11:45:47'),(453,NULL,'2',45,242,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-26 11:45:47'),(454,NULL,'2',45,242,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-26 11:45:47'),(455,NULL,'2',46,243,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-26 23:16:53'),(456,NULL,'2',46,243,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-26 23:16:53'),(457,NULL,'2',46,244,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-26 23:16:53'),(458,NULL,'2',46,244,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-26 23:16:53'),(459,NULL,'2',47,245,0,'테스트7-1 질문1 응답1','1','0','app/file/20201021112823263.jpg',NULL,'2020-10-27 11:13:01'),(460,NULL,'2',47,245,1,'테스트7-1 질문1 응답2','1','0','app/file/20201021112837263.png',NULL,'2020-10-27 11:13:01'),(461,NULL,'2',47,246,0,'테스트7-1 질문2 응답1','1','0','app/file/20201021112919263.png',NULL,'2020-10-27 11:13:01'),(462,NULL,'2',47,246,1,'테스트7 질문2 응답2','1','0','app/file/20200927183339263.jpg',NULL,'2020-10-27 11:13:01'),(463,'2','1',25,248,0,'테스트 투표 양식10 질문 1 응답 1','1','0','https://youtu.be/bZgYvJ5UvnQ','3','2020-11-03 22:29:43'),(464,'2','1',25,248,1,'테스트 투표 양식10 질문 1 응답 2','1','0','https://youtu.be/EBqVTk-Lj9s','3','2020-11-03 22:29:43'),(465,'2','1',26,249,0,'테스트 투표 양식11 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-04 16:05:58'),(466,'2','1',26,249,1,'테스트 투표 양식11 질문 1 응답 2','1','0','https://youtu.be/bZgYvJ5UvnQ','3','2020-11-04 16:05:58'),(467,'2','2',27,250,0,'테스트 투표 양식12 질문 1 응답 1','1','0','','4','2020-11-04 16:23:12'),(468,'2','2',27,250,1,'테스트 투표 양식12 질문 1 응답 2','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-04 16:23:12'),(469,'2','2',27,251,0,'테스트 투표 양식12 질문 2 응답 1','1','0','app/file/20201104162228263.png','1','2020-11-04 16:23:12'),(470,'2','2',27,251,1,'테스트 투표 양식12 질문 2 응답 2','1','0','https://t1.daumcdn.net/cfile/tistory/996F2A465ED519DE10','2','2020-11-04 16:23:12'),(483,'2','2',28,256,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-05 12:58:03'),(484,'2','2',28,256,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-05 12:58:03'),(485,'2','2',28,256,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-05 12:58:03'),(486,'2','2',28,256,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-05 12:58:03'),(487,NULL,'2',49,257,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-08 02:28:44'),(488,NULL,'2',49,257,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-08 02:28:44'),(489,NULL,'2',49,257,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-08 02:28:44'),(490,NULL,'2',49,257,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-08 02:28:44'),(491,NULL,'2',49,257,4,'테스트 투표 양식12 질문 1 응답 5','1','0','','','2020-11-08 02:28:44'),(492,'1','2',51,259,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-09 19:28:19'),(493,'1','2',51,259,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-09 19:28:19'),(494,'1','2',51,259,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-09 19:28:19'),(495,'1','2',51,259,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-09 19:28:19'),(496,'1','2',51,260,0,'테스트 투표 양식12 질문 2 응답 1','1','0','','','2020-11-09 19:28:19'),(497,'1','2',51,260,1,'테스트 투표 양식12 질문 2 응답 2','1','0','https://youtu.be/UKpxPkLCCL8','3','2020-11-09 19:28:19'),(498,'1','2',52,261,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-10 00:45:19'),(499,'1','2',52,261,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-10 00:45:19'),(500,'1','2',52,261,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-10 00:45:19'),(501,'1','2',52,261,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-10 00:45:19'),(502,'1','2',53,262,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-10 01:28:28'),(503,'1','2',53,262,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-10 01:28:28'),(504,'1','2',53,262,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-10 01:28:28'),(505,'1','2',53,262,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-10 01:28:28'),(510,'2','2',30,264,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-13 12:45:54'),(511,'2','2',30,264,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-13 12:45:54'),(512,'2','2',30,264,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-13 12:45:54'),(513,'2','2',30,264,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-13 12:45:54'),(514,'2','2',31,266,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-13 12:50:36'),(515,'2','2',31,266,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-13 12:50:36'),(516,'2','2',31,266,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-13 12:50:36'),(517,'2','2',31,266,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-13 12:50:36'),(518,'2','2',31,267,0,'테스트 투표 양식12 질문 2 응답 1','1','0','https://youtu.be/KX-0ymTN4F0','3','2020-11-13 12:50:36'),(519,'2','2',31,267,1,'테스트 투표 양식12 질문 2 응답 2','1','0','','4','2020-11-13 12:50:36'),(542,'1','2',54,276,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-13 18:59:31'),(543,'1','2',54,276,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-13 18:59:31'),(544,'1','2',54,276,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-13 18:59:31'),(545,'1','2',54,276,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-13 18:59:31'),(546,'1','2',54,277,0,'테스트 투표 양식12 질문 2 응답 1','1','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-11-13 18:59:31'),(547,'1','2',54,277,1,'테스트 투표 양식12 질문 2 응답 2','1','0','app/file/real_20201113185310263.jpg','1','2020-11-13 18:59:31'),(548,'1','2',55,278,0,'테스트 투표 양식12 질문 1 응답 1','1','0','','2','2020-11-14 00:26:45'),(549,'1','2',55,278,1,'테스트 투표 양식12 질문 1 응답 2','1','0','','1','2020-11-14 00:26:45'),(550,'1','2',55,278,2,'테스트 투표 양식12 질문 1 응답 3','1','0','','3','2020-11-14 00:26:45'),(551,'1','2',55,278,3,'테스트 투표 양식12 질문 1 응답 4','1','0','','1','2020-11-14 00:26:45'),(552,'1','2',55,279,0,'테스트 투표 양식12 질문 2 응답 1','1','0','','3','2020-11-14 00:26:45'),(553,'1','2',55,279,1,'테스트 투표 양식12 질문 2 응답 2','1','0','app/file/real_20201114002640263.jpg','1','2020-11-14 00:26:45'),(554,'1','2',56,280,0,'테스트 투표 양식13 질문 1 응답 1','1','0','','2','2020-11-14 17:40:59'),(555,'1','2',56,280,1,'테스트 투표 양식13 질문 1 응답 2','1','0','','1','2020-11-14 17:40:59'),(556,'1','2',56,280,2,'테스트 투표 양식13 질문 1 응답 3','1','0','','3','2020-11-14 17:40:59'),(557,'1','2',56,280,3,'테스트 투표 양식13 질문 1 응답 4','1','0','','1','2020-11-14 17:40:59'),(558,'1','2',56,281,0,'테스트 투표 양식13 질문 2응답 1','1','0','','3','2020-11-14 17:40:59'),(559,'1','2',56,281,1,'테스트 투표 양식13 질문 2응답 2','1','0','app/file/real_20201114174055263.jpg','','2020-11-14 17:40:59'),(560,'1','2',57,282,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-14 18:14:52'),(561,'1','2',57,282,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-14 18:14:52'),(562,'1','2',57,282,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-14 18:14:52'),(563,'1','2',57,282,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-14 18:14:52'),(564,'1','2',58,283,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-15 20:35:28'),(565,'1','2',58,283,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-15 20:35:28'),(566,'1','2',58,283,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-15 20:35:28'),(567,'1','2',58,283,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-15 20:35:28'),(568,'1','2',58,284,0,'테스트 투표 양식12 질문 2 응답 1','1','0','app/file/real_20201115203503263.jpg','','2020-11-15 20:35:28'),(569,'1','2',58,284,1,'테스트 투표 양식12 질문 2 응답 2','1','0','','3','2020-11-15 20:35:28'),(570,'1','2',59,285,0,'테스트 투표 양식14 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-16 11:39:54'),(571,'1','2',59,285,1,'테스트 투표 양식14 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-16 11:39:54'),(572,'1','2',59,285,2,'테스트 투표 양식14 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-16 11:39:54'),(573,'1','2',59,285,3,'테스트 투표 양식14 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-16 11:39:54'),(574,'1','2',59,286,0,'테스트 투표 양식14 질문 2 응답 1','2','0','app/file/real_20201116113748263.jpg','','2020-11-16 11:39:54'),(575,'1','2',59,286,1,'테스트 투표 양식14 질문 2 응답 2','2','0','','3','2020-11-16 11:39:54'),(576,'1','2',59,286,2,'테스트 투표 양식14 질문 2 응답 3','2','0','','2','2020-11-16 11:39:54'),(577,'1','2',60,287,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-16 17:43:46'),(578,'1','2',60,287,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-16 17:43:46'),(579,'1','2',60,287,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-16 17:43:46'),(580,'1','2',60,287,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-16 17:43:46'),(581,'1','2',61,288,0,'테스트 투표 양식12 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-16 17:45:03'),(582,'1','2',61,288,1,'테스트 투표 양식12 질문 1 응답 2','1','0','app/file/20201105122134263.png','1','2020-11-16 17:45:03'),(583,'1','2',61,288,2,'테스트 투표 양식12 질문 1 응답 3','1','0','https://youtu.be/k5roWR4wMzM','3','2020-11-16 17:45:03'),(584,'1','2',61,288,3,'테스트 투표 양식12 질문 1 응답 4','1','0','app/file/20201105125453263.png','1','2020-11-16 17:45:03'),(585,'1','2',61,289,0,'테스트 투표 양식12 질문 2 응답 1','1','0','https://youtu.be/ug93PwNgJEQ','3','2020-11-16 17:45:03'),(586,'1','2',61,289,1,'테스트 투표 양식12 질문 2 응답 2','1','0','app/file/real_20201116174239263.jpg','','2020-11-16 17:45:03'),(587,'1','1',62,290,0,'테스트 투표 양식11 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-17 11:58:00'),(588,'1','1',62,290,1,'테스트 투표 양식11 질문 1 응답 2','1','0','https://youtu.be/bZgYvJ5UvnQ','3','2020-11-17 11:58:00'),(589,'1','2',63,291,0,'테스트 투표 양식12 질문 1 응답 1','2','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-11-18 12:05:12'),(590,'1','2',63,291,1,'테스트 투표 양식12 질문 1 응답 2','2','0','app/file/20201105122134263.png','1','2020-11-18 12:05:12'),(591,'1','2',63,291,2,'테스트 투표 양식12 질문 1 응답 3','2','0','https://youtu.be/k5roWR4wMzM','3','2020-11-18 12:05:12'),(592,'1','2',63,291,3,'테스트 투표 양식12 질문 1 응답 4','2','0','app/file/20201105125453263.png','1','2020-11-18 12:05:12'),(597,'2','1',32,297,0,'테스트 투표 양식14 질문 2 응답 1','1','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-11-20 22:30:53'),(598,'2','1',32,297,1,'테스트 투표 양식14 질문 2 응답 2','1','0','https://data.ac-illust.com/data/thumbnails/b1/b1a29f808b4d2a0561d2eae4aad74e25_t.jpeg','2','2020-11-20 22:30:53'),(599,'1','1',64,299,0,'테스트 투표 양식14 질문 2 응답 1','1','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-11-21 00:00:30'),(600,'1','1',64,299,1,'테스트 투표 양식14 질문 2 응답 2','1','0','https://data.ac-illust.com/data/thumbnails/b1/b1a29f808b4d2a0561d2eae4aad74e25_t.jpeg','2','2020-11-21 00:00:30'),(601,'2','3',33,300,0,'테스트 투표 양식15 테스트 투표 질문1 응답1','1','0','https://youtu.be/gdh-OkQEggM','3','2020-11-26 15:00:57'),(602,'2','3',33,300,1,'테스트 투표 양식15 테스트 투표 질문1 응답2','1','0','https://health.chosun.com/site/data/img_dir/2018/01/16/2018011601336_0.jpg','2','2020-11-26 15:00:57'),(603,'2','3',33,300,2,'테스트 투표 양식15 테스트 투표 질문1 응답3','1','0','','4','2020-11-26 15:00:57'),(604,'2','3',33,300,3,'테스트 투표 양식15 테스트 투표 질문1 응답4','1','0','https://youtu.be/R_J7yLUVUG8','3','2020-11-26 15:00:57'),(605,'1','3',65,302,0,'테스트 투표 양식15 테스트 투표 질문1 응답1','1','0','https://youtu.be/gdh-OkQEggM','3','2020-11-26 17:11:18'),(606,'1','3',65,302,1,'테스트 투표 양식15 테스트 투표 질문1 응답2','1','0','https://health.chosun.com/site/data/img_dir/2018/01/16/2018011601336_0.jpg','2','2020-11-26 17:11:18'),(607,'1','3',65,302,2,'테스트 투표 양식15 테스트 투표 질문1 응답3','1','0','','4','2020-11-26 17:11:18'),(608,'1','3',65,302,3,'테스트 투표 양식15 테스트 투표 질문1 응답4','1','0','https://youtu.be/R_J7yLUVUG8','3','2020-11-26 17:11:18'),(609,'1','3',65,304,0,'테스트 투표 양식15 테스트 투표 질문3 응답 1','3','0','app/file/real_20201126171057263.jpeg','','2020-11-26 17:11:18'),(610,'1','3',65,304,1,'테스트 투표 양식15 테스트 투표 질문3 응답 2','3','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-11-26 17:11:18'),(611,'1','1',66,305,0,'테스트 투표 16 테스트 투표 질문 1 응답 1','4','0','https://youtu.be/gdh-OkQEggM','3','2020-11-27 17:42:03'),(612,'1','1',67,306,0,'테스트 투표 16 테스트 투표 질문 1 응답 1','4','0','https://youtu.be/gdh-OkQEggM','3','2020-11-27 17:46:43'),(613,'1','1',67,306,1,'테스트 투표 16 테스트 투표 질문 1 응답 2','4','0','https://images-wixmp-ed30a86b8c4ca887773594c2.wixmp.com/f/9fc21b75-4efc-4d3c-ab80-710999d45c62/ddvbt4b-587dd503-a9aa-402d-b180-105ff07bd0c0.jpg/v1/fill/w_800,h_412,q_75,strp/light_a_dream_and_let_it_burn_in_you_by_laysa_ddvbt4b-fullview.jpg?token=eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJzdWIiOiJ1cm46YXBwOiIsImlzcyI6InVybjphcHA6Iiwib2JqIjpbW3siaGVpZ2h0IjoiPD00MTIiLCJwYXRoIjoiXC9mXC85ZmMyMWI3NS00ZWZjLTRkM2MtYWI4MC03MTA5OTlkNDVjNjJcL2RkdmJ0NGItNTg3ZGQ1MDMtYTlhYS00MDJkLWIxODAtMTA1ZmYwN2JkMGMwLmpwZyIsIndpZHRoIjoiPD04MDAifV1dLCJhdWQiOlsidXJuOnNlcnZpY2U6aW1hZ2Uub3BlcmF0aW9ucyJdfQ.Nxyr2DpVQ4MvjR5ynm7sPz7_bBTUlYRKM5XRs4cNA9c','2','2020-11-27 17:46:43'),(614,'1','1',68,307,0,'테스트 투표 17 테스트 투표 질문1 응답 1','2','0','https://youtu.be/gdh-OkQEggM','3','2020-12-01 14:47:13'),(615,'1','1',68,307,1,'테스트 투표 17 테스트 투표 질문1 응답 2','2','0','app/file/real_20201201144449263.jpg','1','2020-12-01 14:47:13'),(616,'1','1',68,308,0,'테스트 투표 17 테스트 투표 질문2 응답1','2','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-01 14:47:13'),(617,'1','1',68,308,1,'테스트 투표 17 테스트 투표 질문2 응답2','2','0','https://youtu.be/KX-0ymTN4F0','3','2020-12-01 14:47:13'),(618,'1','1',68,308,2,'테스트 투표 17 테스트 투표 질문2 응답3','2','0','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7Ycwp5zc-uxAmxdygw_iYcF1dKQYIOCCS8Q&usqp=CAU','2','2020-12-01 14:47:13'),(619,'1','1',69,309,0,'테스트 투표 17 테스트 투표 질문1 응답 1','2','0','https://youtu.be/gdh-OkQEggM','3','2020-12-01 14:48:16'),(620,'1','1',69,309,1,'테스트 투표 17 테스트 투표 질문1 응답 2','2','0','app/file/real_20201201144449263.jpg','1','2020-12-01 14:48:16'),(621,'1','1',69,310,0,'테스트 투표 17 테스트 투표 질문2 응답1','2','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-01 14:48:16'),(622,'1','1',69,310,1,'테스트 투표 17 테스트 투표 질문2 응답2','2','0','https://youtu.be/KX-0ymTN4F0','3','2020-12-01 14:48:16'),(623,'1','1',69,310,2,'테스트 투표 17 테스트 투표 질문2 응답3','2','0','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcT7Ycwp5zc-uxAmxdygw_iYcF1dKQYIOCCS8Q&usqp=CAU','2','2020-12-01 14:48:16'),(624,'1','1',70,311,0,'테스트 투표 18 테스트 투표 응답1','1','0','https://youtu.be/IEZeXI7o51Y','3','2020-12-01 23:11:20'),(625,'1','1',70,311,1,'테스트 투표 18 테스트 투표 응답2','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-12-01 23:11:20'),(641,'2','4',34,318,0,'테스트 투표 양식16 테스트 투표 질문 2 응답 1','2','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-04 00:32:55'),(642,'2','4',34,318,1,'테스트 투표 양식16 테스트 투표 질문 2 응답 2','2','1','app/file/real_20201204002539263.jpg','1','2020-12-04 00:32:55'),(643,'2','4',34,318,2,'테스트 투표 양식16 테스트 투표 질문 2 응답 3','2','1','https://youtu.be/6IR59g_jUeA','3','2020-12-04 00:32:55'),(644,'2','4',34,319,0,'테스트 투표 양식16 테스트 투표 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-12-04 00:32:55'),(645,'2','4',34,319,1,'테스트 투표 양식16 테스트 투표 질문 1 응답 2','1','1','https://youtu.be/gdh-OkQEggM','3','2020-12-04 00:32:55'),(646,'1','4',71,320,0,'테스트 투표 양식16 테스트 투표 질문 2 응답 1','2','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-05 18:09:15'),(647,'1','4',71,320,1,'테스트 투표 양식16 테스트 투표 질문 2 응답 2','2','1','app/file/real_20201204002539263.jpg','1','2020-12-05 18:09:15'),(648,'1','4',71,320,2,'테스트 투표 양식16 테스트 투표 질문 2 응답 3','2','1','https://youtu.be/6IR59g_jUeA','3','2020-12-05 18:09:15'),(649,'1','4',71,321,0,'테스트 투표 양식16 테스트 투표 질문 3 응답 1','1','0','app/file/real_20201205180633263.jpeg','','2020-12-05 18:09:15'),(650,'1','4',71,321,1,'테스트 투표 양식16 테스트 투표 질문 3 응답 2','1','0','https://health.chosun.com/site/data/img_dir/2018/01/16/2018011601336_0.jpg','2','2020-12-05 18:09:15'),(651,'1','4',71,321,2,'테스트 투표 양식16 테스트 투표 질문 3 응답 3','1','0','https://youtu.be/g0LxCekRbAM','3','2020-12-05 18:09:15'),(652,'1','4',71,322,0,'테스트 투표 양식16 테스트 투표 질문 1 응답 1','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-12-05 18:09:15'),(653,'1','4',71,322,1,'테스트 투표 양식16 테스트 투표 질문 1 응답 2','1','1','https://youtu.be/gdh-OkQEggM','3','2020-12-05 18:09:15'),(654,'2','4',35,323,0,'테스트 투표 양식17 테스트 투표 질문 3 응답 1','1','0','https://health.chosun.com/site/data/img_dir/2018/01/16/2018011601336_0.jpg','2','2020-12-06 17:45:59'),(655,'2','4',35,323,1,'테스트 투표 양식17 테스트 투표 질문 3 응답 2','1','1','app/file/real_20201206174529263.jpg','1','2020-12-06 17:45:59'),(656,'2','4',35,324,0,'테스트 투표 양식17 테스트 투표 질문 1 응답 1','1','0','https://t3.daumcdn.net/thumb/R720x0/?fname=http://t1.daumcdn.net/brunch/service/user/iDz/image/Fl9lw53HJzyQgVRl4MfIJVjO4LU.jpg','2','2020-12-06 17:45:59'),(657,'2','4',35,324,1,'테스트 투표 양식17 테스트 투표 질문 1 응답 2','1','1','https://youtu.be/gdh-OkQEggM','3','2020-12-06 17:45:59'),(658,'2','4',35,325,0,'테스트 투표 양식17 테스트 투표 질문 2 응답 1','2','0','https://youtu.be/ug93PwNgJEQ','3','2020-12-06 17:45:59'),(659,'2','4',35,325,1,'테스트 투표 양식17 테스트 투표 질문 2 응답 2','2','1','app/file/20201206174357263.png','1','2020-12-06 17:45:59'),(660,'2','4',35,325,2,'테스트 투표 양식17 테스트 투표 질문 2 응답 3','2','1','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-06 17:45:59'),(661,'1','4',72,326,0,'테스트 투표 양식17 테스트 투표 질문 3 응답 1','1','0','https://health.chosun.com/site/data/img_dir/2018/01/16/2018011601336_0.jpg','2','2020-12-06 18:16:59'),(662,'1','4',72,326,1,'테스트 투표 양식17 테스트 투표 질문 3 응답 2','1','1','app/file/real_20201206174529263.jpg','1','2020-12-06 18:16:59'),(663,'1','4',72,327,0,'테스트 투표 양식17 테스트 투표 질문 1 응답 1','1','0','https://t3.daumcdn.net/thumb/R720x0/?fname=http://t1.daumcdn.net/brunch/service/user/iDz/image/Fl9lw53HJzyQgVRl4MfIJVjO4LU.jpg','2','2020-12-06 18:16:59'),(664,'1','4',72,327,1,'테스트 투표 양식17 테스트 투표 질문 1 응답 2','1','1','https://youtu.be/gdh-OkQEggM','3','2020-12-06 18:16:59'),(665,'1','4',72,328,0,'테스트 투표 양식17 테스트 투표 질문 2 응답 1','2','0','https://youtu.be/ug93PwNgJEQ','3','2020-12-06 18:16:59'),(666,'1','4',72,328,1,'테스트 투표 양식17 테스트 투표 질문 2 응답 2','2','1','app/file/20201206174357263.png','1','2020-12-06 18:16:59'),(667,'1','4',72,328,2,'테스트 투표 양식17 테스트 투표 질문 2 응답 3','2','1','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-06 18:16:59'),(668,'1','4',73,329,0,'테스트 투표 양식17 테스트 투표 질문 3 응답 1','1','0','https://health.chosun.com/site/data/img_dir/2018/01/16/2018011601336_0.jpg','2','2020-12-06 18:51:11'),(669,'1','4',73,329,1,'테스트 투표 양식17 테스트 투표 질문 3 응답 2','1','1','app/file/real_20201206174529263.jpg','1','2020-12-06 18:51:11'),(670,'1','4',73,330,0,'테스트 투표 양식17 테스트 투표 질문 1 응답 1','1','0','https://t3.daumcdn.net/thumb/R720x0/?fname=http://t1.daumcdn.net/brunch/service/user/iDz/image/Fl9lw53HJzyQgVRl4MfIJVjO4LU.jpg','2','2020-12-06 18:51:11'),(671,'1','4',73,330,1,'테스트 투표 양식17 테스트 투표 질문 1 응답 2','1','1','https://youtu.be/gdh-OkQEggM','3','2020-12-06 18:51:11'),(672,'1','4',73,331,0,'테스트 투표 양식17 테스트 투표 질문 2 응답 1','2','0','https://youtu.be/ug93PwNgJEQ','3','2020-12-06 18:51:11'),(673,'1','4',73,331,1,'테스트 투표 양식17 테스트 투표 질문 2 응답 2','2','1','app/file/20201206174357263.png','1','2020-12-06 18:51:11'),(674,'1','4',73,331,2,'테스트 투표 양식17 테스트 투표 질문 2 응답 3','2','1','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-06 18:51:11'),(680,'2','4',36,334,0,'테스트 투표 양식18 테스트 투표 질문 1 응답 1','1','0','app/file/real_20201207112633263.jpg','1','2020-12-07 11:28:57'),(681,'2','4',36,334,1,'테스트 투표 양식18 테스트 투표 질문 1 응답 2','1','1','https://t3.daumcdn.net/thumb/R720x0/?fname=http://t1.daumcdn.net/brunch/service/user/iDz/image/Fl9lw53HJzyQgVRl4MfIJVjO4LU.jpg','2','2020-12-07 11:28:57'),(682,'2','4',36,335,0,'테스트 투표 양식18 테스트 투표 질문 2 응답 1','2','1','https://youtu.be/6IR59g_jUeA','3','2020-12-07 11:28:57'),(683,'2','4',36,335,1,'테스트 투표 양식18 테스트 투표 질문 2 응답 2','2','0','app/file/real_20201207112751263.png','1','2020-12-07 11:28:57'),(684,'2','4',36,335,2,'테스트 투표 양식18 테스트 투표 질문 2 응답 3','2','1','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-07 11:28:57'),(685,'1','4',74,336,0,'테스트 투표 양식18 테스트 투표 질문 1 응답 1','1','0','app/file/real_20201207112633263.jpg','1','2020-12-07 14:14:10'),(686,'1','4',74,336,1,'테스트 투표 양식18 테스트 투표 질문 1 응답 2','1','1','https://t3.daumcdn.net/thumb/R720x0/?fname=http://t1.daumcdn.net/brunch/service/user/iDz/image/Fl9lw53HJzyQgVRl4MfIJVjO4LU.jpg','2','2020-12-07 14:14:10'),(687,'1','4',74,337,0,'테스트 투표 양식18 테스트 투표 질문 2 응답 1','2','1','https://youtu.be/6IR59g_jUeA','3','2020-12-07 14:14:10'),(688,'1','4',74,337,1,'테스트 투표 양식18 테스트 투표 질문 2 응답 2','2','0','app/file/real_20201207112751263.png','1','2020-12-07 14:14:10'),(689,'1','4',74,337,2,'테스트 투표 양식18 테스트 투표 질문 2 응답 3','2','1','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-07 14:14:10'),(690,'2','2',37,338,0,'테스트 투표 양식19 테스트 투표 질문1 응답1','1','0','','0','2020-12-07 18:36:33'),(691,'2','2',37,338,1,'테스트 투표 양식19 테스트 투표 질문1 응답2','1','0','','0','2020-12-07 18:36:33'),(692,'2','2',37,338,2,'테스트 투표 양식19 테스트 투표 질문1 응답3','1','0','','0','2020-12-07 18:36:33'),(693,'1','2',75,339,0,'테스트 투표 양식19 테스트 투표 질문1 응답1','1','0','','0','2020-12-07 18:45:43'),(694,'1','2',75,339,1,'테스트 투표 양식19 테스트 투표 질문1 응답2','1','0','','0','2020-12-07 18:45:43'),(695,'1','2',75,339,2,'테스트 투표 양식19 테스트 투표 질문1 응답3','1','0','','0','2020-12-07 18:45:43'),(696,'1','1',76,340,0,'테스트 투표 20 테스트 투표 질문1 응답1','1','0','','0','2020-12-08 18:21:04'),(697,'1','1',76,340,1,'테스트 투표 20 테스트 투표 질문1 응답2','1','0','','0','2020-12-08 18:21:04'),(698,'1','1',77,341,0,'테스트 투표 21 이벤트 투표 질문 1 응답 1','1','0','','0','2020-12-09 17:39:19'),(699,'1','1',77,341,1,'테스트 투표 21 이벤트 투표 질문 1 응답 2','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-12-09 17:39:19'),(700,'1','2',78,342,0,'테스트 투표 22 테스트 투표 질문 1 응답 1','2','0','','0','2020-12-19 18:49:51'),(701,'1','2',78,342,1,'테스트 투표 22 테스트 투표 질문 1 응답 2','2','0','','0','2020-12-19 18:49:51'),(702,'1','2',78,342,2,'테스트 투표 22 테스트 투표 질문 1 응답 3','2','0','','0','2020-12-19 18:49:51'),(703,'1','1',79,343,0,'테스트 투표 22 질문 1 응답 1','2','0','','0','2020-12-19 19:25:22'),(704,'1','1',79,343,1,'테스트 투표 22 질문 1 응답 2','2','0','','0','2020-12-19 19:25:22'),(705,'1','1',79,343,2,'테스트 투표 22 질문 1 응답 3','2','0','','0','2020-12-19 19:25:22'),(706,'1','1',79,343,3,'테스트 투표 22 질문 1 응답 4','2','0','','0','2020-12-19 19:25:22'),(707,'1','1',79,344,0,'테스트 투표 22 질문 2 응답 1','1','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-19 19:25:22'),(708,'1','1',79,344,1,'테스트 투표 22 질문 2 응답 2','1','0','https://encrypted-tbn0.gstatic.com/images?q=tbn:ANd9GcSDMplwWujUB_8eXNEYAa1OIHraWvEmtLGZ5A&usqp=CAU','2','2020-12-19 19:25:22'),(709,'1','2',80,345,0,'테스트 투표 23 테스트 투표 응답 1','2','0','','0','2020-12-20 17:36:17'),(710,'1','2',80,345,1,'테스트 투표 23 테스트 투표 응답 2','2','0','','0','2020-12-20 17:36:17'),(711,'1','2',80,345,2,'테스트 투표 23 테스트 투표 응답 3','2','0','','0','2020-12-20 17:36:17'),(712,'1','2',80,345,3,'테스트 투표 23 테스트 투표 응답 4','2','0','','0','2020-12-20 17:36:17'),(713,'1','2',80,346,0,'테스트 투표 23 테스트 투표 응답 1','1','0','https://thumbs.dreamstime.com/b/hiker-hurts-knee-man-leg-join-immobilizer-stay-summit-raise-medicine-crutch-above-head-hiker-achieved-mountain-100936817.jpg','2','2020-12-20 17:36:17'),(714,'1','2',80,346,1,'테스트 투표 23 테스트 투표 응답 2','1','0','https://t1.daumcdn.net/thumb/R720x0/?fname=http://t1.daumcdn.net/brunch/service/user/W7u/image/nQukkysIr3S6w-GHkCJ8J-b5LZY.jpg','2','2020-12-20 17:36:17'),(715,'1','2',81,347,0,'테스트 투표 23 투표 응답2','1','0','https://youtu.be/gdh-OkQEggM','3','2020-12-21 17:26:42'),(716,'1','2',81,347,1,'테스트 투표 23 투표 응답3','1','0','https://youtu.be/IEZeXI7o51Y','3','2020-12-21 17:26:42'),(717,'1','2',82,348,0,'테스트 투표 24 질문1 응답1','1','0','https://youtu.be/gdh-OkQEggM','3','2020-12-21 18:58:48'),(718,'1','2',82,348,1,'테스트 투표 24 질문1 응답2','1','0','https://youtu.be/IEZeXI7o51Y','3','2020-12-21 18:58:48'),(719,'2','3',38,349,0,'테스트 투표 양식20 질문1 응답1 입니다.','1','0','https://youtu.be/IEZeXI7o51Y','3','2020-12-22 13:59:06'),(720,'2','3',38,349,1,'테스트 투표 양식20 질문1 응답2 입니다','1','0','https://youtu.be/gdh-OkQEggM','3','2020-12-22 13:59:06'),(721,'1','2',83,350,0,'테스트 투표 양식20 테스트 질문1 테스트 응답1 입니다.','1','0','https://youtu.be/IEZeXI7o51Y','3','2020-12-22 14:18:44'),(722,'1','2',83,350,1,'테스트 투표 양식20 테스트 질문1 테스트 응답2 입니다','1','0','https://youtu.be/gdh-OkQEggM','3','2020-12-22 14:18:44'),(723,'1','2',83,351,0,'테스트 투표 양식20 테스트 질문1 응답 1입니다.','2','0','','0','2020-12-22 14:18:44'),(724,'1','2',83,351,1,'테스트 투표 양식20 테스트 질문1 응답 2입니다.','2','0','','0','2020-12-22 14:18:44'),(725,'1','2',83,351,2,'테스트 투표 양식20 테스트 질문1 응답 3입니다.','2','0','','0','2020-12-22 14:18:44'),(726,'2','2',39,352,0,'테스트 투표 양식21 질문 1 응답 1','1','0','','0','2020-12-23 17:23:54'),(727,'2','2',39,352,1,'테스트 투표 양식21 질문 1 응답 2','1','0','','0','2020-12-23 17:23:54'),(728,'1','2',84,353,0,'테스트 투표 양식21 질문 1 응답 1','1','0','','0','2020-12-23 17:43:03'),(729,'1','2',84,353,1,'테스트 투표 양식21 질문 1 응답 2','1','0','','0','2020-12-23 17:43:03'),(730,'1','2',84,354,0,'테스트 투표 양식21 질문 2 응답1','3','0','','0','2020-12-23 17:43:03'),(731,'1','2',84,354,1,'테스트 투표 양식21 질문 2 응답2','3','0','','0','2020-12-23 17:43:03'),(732,'2','1',40,355,0,'테스트 투표 양식17 테스트 투표 질문 21 응답1','3','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-12-24 12:24:20'),(733,'2','1',40,355,1,'테스트 투표 양식17 테스트 투표 질문 21 응답2','3','0','https://t3.daumcdn.net/thumb/R720x0/?fname=http://t1.daumcdn.net/brunch/service/user/iDz/image/Fl9lw53HJzyQgVRl4MfIJVjO4LU.jpg','2','2020-12-24 12:24:20'),(734,'2','1',40,356,0,'테스트 투표 양식17 테스트 투표 질문 2 응답 1','4','0','','0','2020-12-24 12:24:20'),(735,'2','1',40,356,1,'테스트 투표 양식17 테스트 투표 질문 2 응답 2','4','0','','0','2020-12-24 12:24:20'),(736,'2','1',40,356,2,'테스트 투표 양식17 테스트 투표 질문 2 응답 3','4','0','','0','2020-12-24 12:24:20'),(737,'2','1',40,356,3,'테스트 투표 양식17 테스트 투표 질문 2 응답 4','4','0','','0','2020-12-24 12:24:20'),(738,'1','1',85,357,0,'테스트 투표 양식17 테스트 투표 질문 21 응답1','3','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','2','2020-12-24 12:25:56'),(739,'1','1',85,357,1,'테스트 투표 양식17 테스트 투표 질문 21 응답2','3','0','https://t3.daumcdn.net/thumb/R720x0/?fname=http://t1.daumcdn.net/brunch/service/user/iDz/image/Fl9lw53HJzyQgVRl4MfIJVjO4LU.jpg','2','2020-12-24 12:25:56'),(740,'1','1',85,358,0,'테스트 투표 양식17 테스트 투표 질문 2 응답 1','4','0','','0','2020-12-24 12:25:56'),(741,'1','1',85,358,1,'테스트 투표 양식17 테스트 투표 질문 2 응답 2','4','0','','0','2020-12-24 12:25:56'),(742,'1','1',85,358,2,'테스트 투표 양식17 테스트 투표 질문 2 응답 3','4','0','','0','2020-12-24 12:25:56'),(743,'1','1',85,358,3,'테스트 투표 양식17 테스트 투표 질문 2 응답 4','4','0','','0','2020-12-24 12:25:56'),(744,'2','2',41,359,0,'테스트 투표 양식20 테스트25 투표 질문1 응답1','2','0','','0','2020-12-26 18:20:02'),(745,'2','2',41,359,1,'테스트 투표 양식20 테스트25 투표 질문1 응답2','2','0','','0','2020-12-26 18:20:02'),(746,'2','2',41,359,2,'테스트 투표 양식20 테스트25 투표 질문1 응답3','2','0','','0','2020-12-26 18:20:02'),(747,'2','2',41,359,3,'테스트 투표 양식20 테스트25 투표 질문1 응답4','2','0','','0','2020-12-26 18:20:02'),(748,'1','2',86,360,0,'테스트 투표 양식20 테스트25 투표 질문1 응답1','2','0','','0','2020-12-26 18:33:36'),(749,'1','2',86,360,1,'테스트 투표 양식20 테스트25 투표 질문1 응답2','2','0','','0','2020-12-26 18:33:36'),(750,'1','2',86,360,2,'테스트 투표 양식20 테스트25 투표 질문1 응답3','2','0','','0','2020-12-26 18:33:36'),(751,'1','2',86,360,3,'테스트 투표 양식20 테스트25 투표 질문1 응답4','2','0','','0','2020-12-26 18:33:36'),(752,'1','2',86,361,0,'테스트 투표 양식20 테스트25 투표 질문2 응답1','1','0','https://youtu.be/UKpxPkLCCL8','3','2020-12-26 18:33:36'),(753,'1','2',86,361,1,'테스트 투표 양식20 테스트25 투표 질문2 응답2','1','0','https://youtu.be/6IR59g_jUeA','3','2020-12-26 18:33:36'),(754,'2','1',42,362,0,'테스트 투표 양식22 질문 1 응답1','1','0','','0','2021-01-07 17:33:27'),(755,'2','1',42,362,1,'테스트 투표 양식22 질문 1 응답2','1','0','','0','2021-01-07 17:33:27'),(756,'2','1',42,362,2,'테스트 투표 양식22 질문 1 응답3','1','0','','0','2021-01-07 17:33:27'),(757,'2','1',42,363,0,'테스트 투표 양식22 질문 2 응답1','2','0','','0','2021-01-07 17:33:27'),(758,'2','1',42,363,1,'테스트 투표 양식22 질문 2 응답2','2','0','','0','2021-01-07 17:33:27'),(759,'2','1',42,363,2,'테스트 투표 양식22 질문 2 응답3','2','0','','0','2021-01-07 17:33:27'),(760,'2','1',42,363,3,'테스트 투표 양식22 질문 2 응답4','2','0','','0','2021-01-07 17:33:27'),(761,'1','1',87,364,0,'테스트 투표 양식22 질문 1 응답1','1','0','','0','2021-01-07 17:59:56'),(762,'1','1',87,364,1,'테스트 투표 양식22 질문 1 응답2','1','0','','0','2021-01-07 17:59:56'),(763,'1','1',87,364,2,'테스트 투표 양식22 질문 1 응답3','1','0','','0','2021-01-07 17:59:56'),(764,'1','1',87,365,0,'테스트 투표 양식22 질문 2 응답1','2','0','','0','2021-01-07 17:59:56'),(765,'1','1',87,365,1,'테스트 투표 양식22 질문 2 응답2','2','0','','0','2021-01-07 17:59:56'),(766,'1','1',87,365,2,'테스트 투표 양식22 질문 2 응답3','2','0','','0','2021-01-07 17:59:56'),(767,'1','1',87,365,3,'테스트 투표 양식22 질문 2 응답4','2','0','','0','2021-01-07 17:59:56'),(768,'1','1',88,366,0,'테스트 투표 양식22 질문 1 응답1','1','0','','0','2021-01-07 18:00:28'),(769,'1','1',88,366,1,'테스트 투표 양식22 질문 1 응답2','1','0','','0','2021-01-07 18:00:28'),(770,'1','1',88,366,2,'테스트 투표 양식22 질문 1 응답3','1','0','','0','2021-01-07 18:00:28'),(771,'1','1',88,367,0,'테스트 투표 양식22 질문 2 응답1','2','0','','0','2021-01-07 18:00:28'),(772,'1','1',88,367,1,'테스트 투표 양식22 질문 2 응답2','2','0','','0','2021-01-07 18:00:28'),(773,'1','1',88,367,2,'테스트 투표 양식22 질문 2 응답3','2','0','','0','2021-01-07 18:00:28'),(774,'1','1',88,367,3,'테스트 투표 양식22 질문 2 응답4','2','0','','0','2021-01-07 18:00:28'),(775,'1','1',89,368,0,'테스트 투표 양식22 질문 1 응답1','1','0','','0','2021-01-07 18:26:57'),(776,'1','1',89,368,1,'테스트 투표 양식22 질문 1 응답2','1','0','','0','2021-01-07 18:26:57'),(777,'1','1',89,368,2,'테스트 투표 양식22 질문 1 응답3','1','0','','0','2021-01-07 18:26:57'),(778,'1','1',89,369,0,'테스트 투표 양식22 질문 2 응답1','2','0','','0','2021-01-07 18:26:57'),(779,'1','1',89,369,1,'테스트 투표 양식22 질문 2 응답2','2','0','','0','2021-01-07 18:26:57'),(780,'1','1',89,369,2,'테스트 투표 양식22 질문 2 응답3','2','0','','0','2021-01-07 18:26:57'),(781,'1','1',89,369,3,'테스트 투표 양식22 질문 2 응답4','2','0','','0','2021-01-07 18:26:57'),(782,'1','1',90,370,0,'테스트 투표 양식12 질문 1 응답 1','1','0','','0','2021-01-29 17:08:23'),(783,'1','1',90,370,1,'테스트 투표 양식12 질문 1 응답 2','1','0','https://img.seoul.co.kr/img/upload/2020/06/02/SSI_20200602172852_O2.jpg','0','2021-01-29 17:08:23'),(784,'1','1',90,371,0,'테스트 투표 양식12 질문 2 응답 1','1','0','app/file/20201104162228263.png','0','2021-01-29 17:08:23'),(785,'1','1',90,371,1,'테스트 투표 양식12 질문 2 응답 2','1','0','https://t1.daumcdn.net/cfile/tistory/996F2A465ED519DE10','0','2021-01-29 17:08:23'),(786,'2','2',43,372,0,'테스트 투표 양식25 테스트 투표 질문1 응답1','1','0','https://youtu.be/AdnIwK7WCp4','3','2021-03-27 01:33:04'),(787,'2','2',43,372,1,'테스트 투표 양식25 테스트 투표 질문1 응답2','1','0','https://image-cdn.hypb.st/https%3A%2F%2Fkr.hypebeast.com%2Ffiles%2F2021%2F03%2Fwarner-bros-godzilla-vs-kong-movie-korea-release-date-info-00.jpg?q=90&w=1400&cbr=1&fit=max','2','2021-03-27 01:33:04'),(788,'1','2',91,374,0,'테스트 투표 양식25 테스트 투표 질문3 응답1','2','0','','0','2021-03-27 02:29:42'),(789,'1','2',91,374,1,'테스트 투표 양식25 테스트 투표 질문3 응답2','2','0','','0','2021-03-27 02:29:42'),(790,'1','2',91,374,2,'테스트 투표 양식25 테스트 투표 질문3 응답3','2','0','','0','2021-03-27 02:29:42'),(791,'1','2',91,375,0,'테스트 투표 양식25 테스트 투표 질문1 응답1','1','0','https://youtu.be/AdnIwK7WCp4','3','2021-03-27 02:29:42'),(792,'1','2',91,375,1,'테스트 투표 양식25 테스트 투표 질문1 응답2','1','0','https://image-cdn.hypb.st/https%3A%2F%2Fkr.hypebeast.com%2Ffiles%2F2021%2F03%2Fwarner-bros-godzilla-vs-kong-movie-korea-release-date-info-00.jpg?q=90&w=1400&cbr=1&fit=max','2','2021-03-27 02:29:42');
/*!40000 ALTER TABLE `VOTE_ANSWERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_EVENT_CONTEXT`
--

DROP TABLE IF EXISTS `VOTE_EVENT_CONTEXT`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_EVENT_CONTEXT` (
  `VOTE_EVENT_CONTEXT_SEQ` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `VOTE_EVENT_SUBJECT` varchar(250) DEFAULT NULL,
  `VOTE_EVENT_TEXT` text DEFAULT NULL,
  `VOTE_PRESENT_PATH` varchar(250) DEFAULT NULL,
  `VOTE_BANNER_PATH` varchar(250) DEFAULT NULL,
  `VOTE_EVENT_URL` varchar(250) DEFAULT NULL,
  `VOTE_EVENT_CONTEXT_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`VOTE_EVENT_CONTEXT_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COMMENT='이벤트 내용';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_EVENT_CONTEXT`
--

LOCK TABLES `VOTE_EVENT_CONTEXT` WRITE;
/*!40000 ALTER TABLE `VOTE_EVENT_CONTEXT` DISABLE KEYS */;
INSERT INTO `VOTE_EVENT_CONTEXT` VALUES (1,83,'테스트 1 이벤트 입니다.','■ 내용    \r\n  - 테스트 이벤트 입니다. \r\n■ 선물 \r\n  - 테스트 이벤트 선물입니다.\r\n■ 선물 제공인원\r\n  - 50명입니다.\r\n■ 응모기간\r\n  - 12.22 / 12.30\r\n■ 응모자격\r\n  - 아무나 다 됩니다.\r\n■ 당첨기준\r\n  - 말만하세요.\r\n■ 당첨자 발표일\r\n  - 01.01\r\n■ 당첨자 발표장소\r\n  - 우리집\r\n■ 선물 제공방법\r\n  - 직접\r\n','/app/file/real_20201222181318263.jpeg','/app/file/real_20201222181321263.jpg','https://youtu.be/f4T8JOVcw0g','2020-12-28 19:00:14'),(2,84,'테스트 2 이벤트 입니다.','■ 내용\r<br/>  - 테스트 내용입니다. \r<br/>■ 선물\r<br/>  - 테스트 선물입니다.\r<br/>■ 선물 제공인원\r<br/>  - 20명\r<br/>■ 응모기간\r<br/>  - 2020.12.01 / 2020.12.31\r<br/>■ 응모자격\r<br/>  - 테스트 응모 자격 입니다.\r<br/>■ 당첨기준\r<br/>  - 테스트 담첨기준 입니다.\r<br/>■ 당첨자 발표일\r<br/>  - 2021.01.01\r<br/>■ 당첨자 발표장소\r<br/>  - 없음\r<br/>■ 선물 제공방법\r<br/>  - 택배\r<br/>','/app/file/real_20201223174759263.jpg','/app/file/real_20201223174802263.jpg','https://youtu.be/f4T8JOVcw0g','2020-12-28 19:00:14'),(3,85,'테스트 3 이벤트 입니다. 참고하세요. 안그럼 하지마세요.','■ 내용\r<br/>  - 테스트 내용입니다. \r<br/>■ 선물\r<br/>  - 테스트 선물입니다.\r<br/>■ 선물 제공인원\r<br/>  - 20명\r<br/>■ 응모기간\r<br/>  - 2020.12.01 / 2020.12.31\r<br/>■ 응모자격\r<br/>  - 테스트 응모 자격 입니다.\r<br/>■ 당첨기준\r<br/>  - 테스트 담첨기준 입니다.\r<br/>■ 당첨자 발표일\r<br/>  - 2021.01.01\r<br/>■ 당첨자 발표장소\r<br/>  - 없음\r<br/>■ 선물 제공방법\r<br/>  - 택배\r<br/>','/app/file/real_20201224151956263.jpeg','/app/file/real_20201224152000263.jpg','https://youtu.be/f4T8JOVcw0g','2020-12-28 19:00:14'),(4,86,'테스트 4 이벤트 입니다. 참고하세요. 안그럼 하지마세요.','■ 내용<br/>  - 테스트 내용입니다. <br/>■ 선물<br/>  - 테스트 선물입니다.<br/>■ 선물 제공인원<br/>  - 20명<br/>■ 응모기간<br/>  - 2020.12.01 / 2020.12.31<br/>■ 응모자격<br/>  - 테스트 응모 자격 입니다.1111<br/>■ 당첨기준<br/>  - 테스트 담첨기준 입니다.<br/>■ 당첨자 발표일<br/>  - 2021.01.01<br/>■ 당첨자 발표장소<br/>  - 없음<br/>■ 선물 제공방법<br/>  - 택배','/app/file/real_20201226184015263.jpg','/app/file/real_20201226184021263.jpg','https://youtu.be/f4T8JOVcw0g','2020-12-28 19:00:14'),(5,86,'테스트 4 이벤트 입니다. 참고하세요. 안그럼 하지마세요.','■ 내용\r<br/>\r<br/>  - 테스트 내용입니다. \r<br/>\r<br/>■ 선물\r<br/>\r<br/>  - 테스트 선물입니다.\r<br/>\r<br/>■ 선물 제공인원\r<br/>\r<br/>  - 20명\r<br/>\r<br/>■ 응모기간\r<br/>\r<br/>  - 2020.12.01 / 2020.12.31\r<br/>\r<br/>■ 응모자격\r<br/>\r<br/>  - 테스트 응모 자격 입니다.\r<br/>\r<br/>■ 당첨기준\r<br/>\r<br/>  - 테스트 담첨기준 입니다.\r<br/>\r<br/>■ 당첨자 발표일\r<br/>\r<br/>  - 2021.01.01\r<br/>\r<br/>■ 당첨자 발표장소\r<br/>\r<br/>  - 없음\r<br/>\r<br/>■ 선물 제공방법\r<br/>\r<br/>  - 택배','/app/file/real_20201226184015263.jpg','/app/file/real_20201226184021263.jpg','https://youtu.be/f4T8JOVcw0g','2020-12-28 19:00:14'),(6,86,'테스트 4 이벤트 입니다. 참고하세요. 안그럼 하지마세요.','■ 내용\r<br/>\r<br/>  - 테스트 내용입니다. \r<br/>\r<br/>■ 선물\r<br/>\r<br/>  - 테스트 선물입니다.\r<br/>\r<br/>■ 선물 제공인원\r<br/>\r<br/>  - 20명\r<br/>\r<br/>■ 응모기간\r<br/>\r<br/>  - 2020.12.01 / 2020.12.31\r<br/>\r<br/>■ 응모자격\r<br/>\r<br/>  - 테스트 응모 자격 입니다.\r<br/>\r<br/>■ 당첨기준\r<br/>\r<br/>  - 테스트 담첨기준 입니다.\r<br/>\r<br/>■ 당첨자 발표일\r<br/>\r<br/>  - 2021.01.01\r<br/>\r<br/>■ 당첨자 발표장소\r<br/>\r<br/>  - 없음\r<br/>\r<br/>■ 선물 제공방법\r<br/>\r<br/>  - 택배','/app/file/real_20201226184015263.jpg','/app/file/real_20201226184021263.jpg','https://youtu.be/CkuG0FLleB8','2020-12-28 19:00:14'),(7,86,'테스트 4 이벤트 입니다. 참고하세요. 안그럼 하지마세요.','■ 내용\r<br/>\r<br/>  - 테스트 내용입니다. \r<br/>\r<br/>■ 선물\r<br/>\r<br/>  - 테스트 선물입니다.\r<br/>\r<br/>■ 선물 제공인원\r<br/>\r<br/>  - 20명\r<br/>\r<br/>■ 응모기간\r<br/>\r<br/>  - 2020.12.01 / 2020.12.31\r<br/>\r<br/>■ 응모자격\r<br/>\r<br/>  - 테스트 응모 자격 입니다.11111\r<br/>\r<br/>■ 당첨기준\r<br/>\r<br/>  - 테스트 담첨기준 입니다.\r<br/>\r<br/>■ 당첨자 발표일\r<br/>\r<br/>  - 2021.01.01\r<br/>\r<br/>■ 당첨자 발표장소\r<br/>\r<br/>  - 없음\r<br/>\r<br/>■ 선물 제공방법\r<br/>\r<br/>  - 택배','/app/file/real_20201226184015263.jpg','/app/file/real_20201226184021263.jpg','https://youtu.be/f4T8JOVcw0g','2020-12-28 19:00:14'),(8,86,'테스트 4 이벤트 입니다. 참고하세요. 안그럼 하지마세요.','■ 내용\r<br/>\r<br/>  - 테스트 내용입니다. \r<br/>\r<br/>■ 선물\r<br/>\r<br/>  - 테스트 선물입니다.\r<br/>\r<br/>■ 선물 제공인원\r<br/>\r<br/>  - 20명\r<br/>\r<br/>■ 응모기간\r<br/>\r<br/>  - 2020.12.01 / 2020.12.31\r<br/>\r<br/>■ 응모자격\r<br/>\r<br/>  - 테스트 응모 자격 입니다.\r<br/>\r<br/>■ 당첨기준\r<br/>\r<br/>  - 테스트 담첨기준 입니다.11111\r<br/>\r<br/>■ 당첨자 발표일\r<br/>\r<br/>  - 2021.01.01\r<br/>\r<br/>■ 당첨자 발표장소\r<br/>\r<br/>  - 없음\r<br/>\r<br/>■ 선물 제공방법\r<br/>\r<br/>  - 택배','/app/file/real_20201226184015263.jpg','/app/file/real_20201226184021263.jpg','https://youtu.be/CkuG0FLleB8','2020-12-28 19:00:14');
/*!40000 ALTER TABLE `VOTE_EVENT_CONTEXT` ENABLE KEYS */;
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COMMENT='투표 양식';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_FORM`
--

LOCK TABLES `VOTE_FORM` WRITE;
/*!40000 ALTER TABLE `VOTE_FORM` DISABLE KEYS */;
INSERT INTO `VOTE_FORM` VALUES (14,112,'1','2','테스트 투표양식1 테스트 테스트 테스트',1,3,'app/file/20200818223940263.jpg','1','테스트 투표1 입니다. 참고하세요.','naver.com',0,0,'2020-09-26 01:41:43'),(15,112,'1','1','테스트 투표양식2',6,7,'app/file/20200819022144263.png','1','테스트 투표2입니다. 참고하세요.','naver.com',0,0,'2020-09-26 04:38:57'),(16,112,'1','1','테스트 투표양식3',1,3,'app/file/20200818223940263.jpg','1','테스트 투표3 입니다. 참고하세요.','naver.com',0,0,'2020-09-26 18:44:27'),(17,112,'1','1','테스트4 투표양식1',6,7,'app/file/20200819022144263.png','1','테스트 투표4 입니다. 참고하세요.','naver.com',0,0,'2020-09-28 12:27:37'),(18,112,'1','4','테스트 퀴즈 양식1',6,7,'app/file/20200819022144263.png','1','테스트 투표5 입니다. 참고하세요.','naver.com',0,0,'2020-10-03 01:45:35'),(19,112,'1','4','테스트 퀴즈 양식1',6,7,'app/file/20200819022144263.png','1','테스트 투표6 입니다. 참고하세요.','naver.com',0,0,'2020-10-03 01:53:57'),(20,112,'1','1','테스트 투표양식7 테스트 투표 입니다.',14,18,'app/file/20200819023043263.png','1','테스트 투표7 입니다. 참고하세요.','naver.com',0,0,'2020-10-08 00:17:00'),(23,112,'1','1','테스트 투표 양식10 테스트 투표 입니다.',3,3,'app/file/20200819023043263.png','1','테스트 투표 양식10 테스트 투표 입니다.','naver.com',0,0,'2020-11-03 22:18:33'),(24,112,'1','1','테스트 투표 양식10 테스트 투표 입니다.',3,3,'app/file/20200819023043263.png','1','테스트 투표 양식10 테스트 투표 입니다.','naver.com',0,0,'2020-11-03 22:27:59'),(25,112,'1','1','테스트 투표 양식10 테스트 투표 입니다.',3,3,'app/file/20200819023043263.png','1','테스트 투표 양식10 테스트 투표 입니다.','naver.com',0,0,'2020-11-03 22:29:43'),(26,112,'1','1','테스트 투표 양식11 테스트 투표 입니다.',9,26,'app/file/20200819023043263.png','1','테스트 투표 양식11 테스트 투표 입니다.','naver.com',0,0,'2020-11-04 16:05:58'),(27,112,'1','2','테스트 투표 양식12 테스트 투표 입니다.',9,26,'app/file/real_20201028184521263.jpg','1','테스트 투표 양식12 테스트 투표 입니다.','naver.com',1,1,'2020-11-04 16:23:12'),(28,112,'1','2','테스트 투표 양식12 테스트 투표 입니다.',9,26,'https://www.youtube.com/embed/-vBniaKo-Uk','3','테스트 투표 양식12 테스트 투표 입니다.','naver.com',1,0,'2020-11-04 16:44:16'),(29,112,'1','2','테스트 투표 양식12 테스트 투표 입니다.',23,23,'https://www.youtube.com/embed/-vBniaKo-Uk','3','테스트 투표 양식12 테스트 투표 입니다. 관리자','naver.com',0,0,'2020-11-12 21:48:21'),(30,112,'1','2','테스트 투표 양식12 테스트 투표 입니다.',14,18,'https://www.youtube.com/embed/-vBniaKo-Uk','3','테스트 투표 양식12 테스트 투표 입니다.','naver.com',0,0,'2020-11-13 12:45:54'),(31,112,'1','2','테스트 투표 양식12 테스트 투표 입니다.',14,18,'https://www.youtube.com/embed/-vBniaKo-Uk','3','테스트 투표 양식12 테스트 투표 입니다.','naver.com',0,0,'2020-11-13 12:50:36'),(32,112,'1','1','테스트 투표 양식14 테스트 투표 입니다.',8,27,'https://i.ytimg.com/vi/yY6XnbWnK4o/maxresdefault.jpg','2','테스트 투표 양식14 테스트 투표 입니다.','naver.com',0,0,'2020-11-20 16:23:53'),(33,112,'1','3','테스트 투표 양식15 테스트 투표 입니다.',11,29,'app/file/real_20201125190744263.jpg','','테스트 투표 양식15 테스트 투표 입니다.','naver.com',0,0,'2020-11-26 15:00:57'),(34,112,'1','4','테스트 투표 양식16 테스트 투표 입니다.',12,32,'app/file/real_20201203165830263.jpg','','테스트 투표 양식16 테스트 투표 입니다.','naver.com',0,0,'2020-12-04 00:07:49'),(35,112,'1','4','테스트 투표 양식17 테스트 투표 입니다.',1,34,'app/file/20201206163311263.png','','테스트 투표 양식17 테스트 투표 입니다.','naver.com',4,2,'2020-12-06 17:45:59'),(36,112,'1','4','테스트 투표 양식18 테스트 투표 입니다.',1,35,'app/file/20201207111251263.png','','테스트 투표 양식18 테스트 투표 입니다.','naver.com',10,1,'2020-12-07 11:28:23'),(37,112,'1','2','테스트 투표 양식19 테스트 투표 입니다.',1,36,'https://www.incimages.com/uploaded_files/image/1024x576/getty_615524918_379849.jpg','2','테스트 투표 양식19 테스트 투표 입니다.','daum.net',16,1,'2020-12-07 18:36:33'),(38,112,'2','2','테스트 투표 양식20 테스트 투표 입니다.',9,43,'app/file/real_20201222135711263.png','','테스트 투표 양식20 테스트 투표 입니다.','daum.net',1,1,'2020-12-22 13:59:06'),(39,112,'2','2','테스트 투표 양식21 테스트 투표 입니다.',44,45,'https://youtu.be/-vBniaKo-Uk','3','테스트 투표 양식21 테스트 투표 입니다.','naver.com',1,1,'2020-12-23 17:23:54'),(40,112,'2','1','테스트 투표 양식17 테스트 투표 입니다.',12,33,'app/file/real_20201203164942263.jpeg','','테스트 투표 양식17 테스트 투표 입니다.','daum.net',1,1,'2020-12-24 12:24:20'),(41,112,'2','2','테스트 투표 양식20 테스트 투표25 입니다.',4,24,'https://i.ytimg.com/vi/yY6XnbWnK4o/maxresdefault.jpg','2','테스트 투표 양식20 테스트 투표25 입니다.','naver.com',1,1,'2020-12-26 18:20:02'),(42,112,'1','1','테스트 투표 양식22 테스트 투표 입니다.',10,47,'app/file/20210107173025263.jpg','','테스트 투표 양식22 테스트 투표 입니다','naver.com',15,3,'2021-01-07 17:33:27'),(43,112,'1','2','테스트 투표 양식25 테스트 투표 입니다.',4,24,'https://img.kr.news.samsung.com/kr/wp-content/uploads/2018/06/0705story1.jpg','2','테스트 투표 양식25 테스트 투표 입니다.','naver.com',7,1,'2021-03-27 01:33:03');
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
-- Table structure for table `VOTE_FREE_ANSWERS`
--

DROP TABLE IF EXISTS `VOTE_FREE_ANSWERS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_FREE_ANSWERS` (
  `VOTE_FREE_ANSWERS_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VOTE_MEMBER_SEQ` int(11) DEFAULT NULL,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `VOTE_QUESTION_SEQ` int(11) DEFAULT NULL,
  `VOTE_QUESTION_INDEX` int(11) DEFAULT NULL,
  `VOTE_ANSWER_TEXT` varchar(500) DEFAULT NULL,
  `VOTE_ANSWER_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`VOTE_FREE_ANSWERS_SEQ`),
  KEY `IDX_VOTE_FREE_ANSWERS_X01` (`VOTE_SEQ`,`VOTE_QUESTION_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COMMENT='설문 질문에 대한 자유 응답';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_FREE_ANSWERS`
--

LOCK TABLES `VOTE_FREE_ANSWERS` WRITE;
/*!40000 ALTER TABLE `VOTE_FREE_ANSWERS` DISABLE KEYS */;
INSERT INTO `VOTE_FREE_ANSWERS` VALUES (1,1,298,1,5,'테스트 투표 양식14 질문 1 응답 1 입니다.','2020-11-23 22:21:51'),(2,1,64,298,1,'테스트 투표 양식14 질문 1 응답 1 입니다.','2020-11-23 22:24:32'),(3,1,64,298,1,'테스트 투표 양식14 질문 1 응답 1 입니다.','2020-11-23 22:25:06'),(4,2,64,298,1,'테스트 투표 양식14 질문 1 응답 2 입니다.','2020-11-23 23:26:53'),(7,2,65,304,2,'테스트 투표 양식15 테스트 투표 질문2 테스트 응답','2020-11-26 17:22:48'),(8,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 18:17:38'),(9,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 21:21:21'),(10,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 21:24:50'),(11,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 21:26:11'),(12,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 21:27:48'),(13,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 21:28:33'),(14,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:43:21'),(15,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:44:28'),(16,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:45:06'),(17,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:46:03'),(18,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:46:27'),(19,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:49:14'),(20,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:50:09'),(21,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:50:10'),(22,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:50:11'),(23,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:50:35'),(24,2,67,306,1,'테스트 투표 16 테스트 투표 질문 1 테스트 응답글','2020-11-27 22:52:59'),(25,2,91,376,2,'테스트 답변 입니다.','2021-03-27 03:29:14'),(26,4,91,376,2,'테스트 답변 1 입니다.','2021-03-27 03:32:15'),(27,4,91,376,2,'테스트 답변 1 입니다.','2021-03-27 03:32:34');
/*!40000 ALTER TABLE `VOTE_FREE_ANSWERS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_PAYMENT_LOG`
--

DROP TABLE IF EXISTS `VOTE_PAYMENT_LOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_PAYMENT_LOG` (
  `SERVICE_PAYMENT_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `SERVICE_MEMBER_SEQ` int(11) DEFAULT NULL,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `SERVICE_TYPE` char(1) DEFAULT NULL,
  `PRODUCT_SEQ` int(11) DEFAULT NULL,
  `SERVICE_END_DATE` date DEFAULT NULL,
  `SERVICE_ACCOUNT_SEQ` int(11) DEFAULT NULL,
  `SERVICE_PRICE` int(11) DEFAULT NULL,
  `SERVICE_PAYMENT_TYPE` char(1) DEFAULT NULL,
  `SERVICE_ACCOUNT_TYPE` varchar(50) DEFAULT NULL,
  `SERVICE_ACCOUNT` varchar(50) DEFAULT NULL,
  `SERVICE_PAYER` varchar(10) DEFAULT NULL,
  `SERVICE_PAYMENT_DATE` datetime DEFAULT NULL,
  `SERVICE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`SERVICE_PAYMENT_SEQ`),
  KEY `IDX_VOTE_SERVICE_PREM_X01` (`SERVICE_PAYMENT_SEQ`,`VOTE_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COMMENT='결제 목록';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_PAYMENT_LOG`
--

LOCK TABLES `VOTE_PAYMENT_LOG` WRITE;
/*!40000 ALTER TABLE `VOTE_PAYMENT_LOG` DISABLE KEYS */;
INSERT INTO `VOTE_PAYMENT_LOG` VALUES (5,2,37,'1',1,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 16:53:19'),(6,2,38,'1',2,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 16:53:47'),(7,2,39,'1',1,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 16:54:12'),(8,2,40,'1',2,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 16:56:02'),(9,2,2,'1',1,'2020-10-30',1,2222,'1','1','1002-454-787845','333',NULL,'2020-10-26 16:57:02'),(10,2,41,'1',2,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 16:57:10'),(11,2,42,'1',1,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 16:57:58'),(12,2,43,'1',2,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 18:09:13'),(13,2,44,'1',1,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 18:17:13'),(14,2,45,'1',2,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-10-26 18:47:47'),(15,NULL,47,'1',2,'2020-10-29',3,17000,'1','3','1002-454-787845','아무개',NULL,'2020-10-27 11:17:06'),(16,NULL,49,'1',1,NULL,3,0,'1','3','1002-454-787845','아무개',NULL,'2020-11-08 02:29:15'),(17,NULL,51,'1',1,NULL,3,0,'1','3','1002-454-787845','아무개',NULL,'2020-11-09 19:28:34'),(18,NULL,51,'1',1,NULL,3,0,'1','3','1002-454-787845','아무개',NULL,'2020-11-09 19:31:03'),(19,2,52,'1',1,'2020-11-26',3,0,'1','3','1002-454-787845','아무개',NULL,'2020-11-10 01:28:01'),(20,2,53,'1',2,'9999-12-31',3,17000,'1','3','1002-454-787845','아무개',NULL,'2020-11-10 01:32:58'),(21,2,54,'1',2,'2020-12-30',3,17000,'1','3','1002-454-787845','아무개',NULL,'2020-11-10 01:50:19'),(22,0,56,'1',2,'2020-11-30',3,17000,'1','3','1002-454-787845','아무개',NULL,'2020-11-14 17:45:40'),(23,0,57,'1',1,'2020-10-30',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-11-14 18:15:08'),(24,2,58,'1',1,'9999-12-31',3,9900,'1','3','1002-454-787845','아무개',NULL,'2020-11-15 20:42:11'),(25,2,63,'1',2,'2020-11-30',3,17000,'1','3','1002-454-787845','아무개',NULL,'2020-11-18 12:05:25'),(26,0,65,'1',2,'2020-11-30',3,17000,'1','3','1002-454-787845','아무개',NULL,'2020-11-26 17:11:31'),(27,0,67,'1',1,'2020-11-30',3,17000,'1','3','1002-454-787845','아무개',NULL,'2020-11-27 17:46:59'),(28,2,83,'2',4,'2020-12-25',3,41600,'1','3','1002-454-787845','아무개',NULL,'2020-12-22 18:14:34'),(29,2,84,'2',4,'2020-12-30',3,41600,'1','3','1002-454-787845','아무개',NULL,'2020-12-23 17:48:34'),(30,2,85,'1',3,'2020-12-25',3,33000,'1','3','1002-454-787845','아무개',NULL,'2020-12-24 15:20:20'),(31,2,86,'2',4,'2020-12-31',3,41600,'1','3','1002-454-787845','아무개',NULL,'2020-12-26 18:40:39'),(32,2,89,'1',2,'9999-12-31',3,17000,'1','3','1002-454-787845','아무개',NULL,'2021-01-07 18:30:51'),(33,2,91,'2',2,'2021-03-31',3,17000,'1','3','1002-454-787845','아무개',NULL,'2021-03-27 02:30:31');
/*!40000 ALTER TABLE `VOTE_PAYMENT_LOG` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_QUESTIONS`
--

DROP TABLE IF EXISTS `VOTE_QUESTIONS`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_QUESTIONS` (
  `QUESTION_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VOTE_CLASS` char(1) DEFAULT NULL,
  `VOTE_TYPE` char(1) DEFAULT NULL,
  `VOTE_KIND` char(1) DEFAULT NULL,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `QUESTION_INDEX` int(11) DEFAULT NULL,
  `QUESTION_ORDER` int(11) DEFAULT NULL,
  `QUESTION_SUBJECT` varchar(250) DEFAULT NULL,
  `QUESTION_RESOURCE_PATH` varchar(1000) DEFAULT NULL,
  `QUESTION_RESOURCE_TYPE` char(1) DEFAULT NULL,
  `QUESTION_RESP_TYPE` char(1) DEFAULT NULL,
  `QUESTION_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`QUESTION_SEQ`),
  KEY `IDX_QUESTIONS_X01` (`VOTE_SEQ`,`QUESTION_REGI_DATE`)
) ENGINE=InnoDB AUTO_INCREMENT=377 DEFAULT CHARSET=utf8 COMMENT='투표 질문 항목';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_QUESTIONS`
--

LOCK TABLES `VOTE_QUESTIONS` WRITE;
/*!40000 ALTER TABLE `VOTE_QUESTIONS` DISABLE KEYS */;
INSERT INTO `VOTE_QUESTIONS` VALUES (9,NULL,'1','1',1,13,NULL,'테스트질문1','app/file/20200927215032263.png',NULL,'1','2020-09-26 04:13:21'),(10,NULL,'1','1',1,13,NULL,'테스트질문1','app/file/20200927215032263.png',NULL,'1','2020-09-26 04:23:35'),(11,NULL,'1','1',1,13,NULL,'테스트질문1','app/file/20200927215032263.png',NULL,'1','2020-09-26 04:24:15'),(165,NULL,'2','1',0,1,0,'테스트7 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-20 12:40:50'),(166,NULL,'2','1',0,2,1,'테스트7 질문2','app/file/20201004192145263.png',NULL,'1','2020-10-20 12:40:50'),(167,NULL,'2','1',0,3,2,'테스트7 질문3','app/file/20201020123429263.png',NULL,'1','2020-10-20 12:40:50'),(168,NULL,'2','1',0,1,0,'테스트8 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-20 18:04:01'),(169,NULL,'2','1',0,2,1,'테스트8 질문2','app/file/20201020180123263.jpg',NULL,'1','2020-10-20 18:04:01'),(170,NULL,'2','1',0,1,0,'테스트8 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-20 18:21:46'),(171,NULL,'2','1',0,2,1,'테스트8 질문2','app/file/20201020180123263.jpg',NULL,'1','2020-10-20 18:21:46'),(172,NULL,'2','1',0,1,0,'테스트8 질문1','app/file/20201020192312263.jpg',NULL,'1','2020-10-20 19:23:59'),(173,NULL,'2','1',0,2,0,'테스트 투표 8 질문1입니다.','app/file/20201020225545263.jpg',NULL,'1','2020-10-20 22:56:31'),(174,NULL,'2','1',0,1,0,'테스트9 질문1','app/file/20201020231156263.jpg',NULL,'1','2020-10-20 23:12:30'),(175,NULL,'2','1',7,1,0,'테스트9 질문1','app/file/20201020231156263.jpg',NULL,'1','2020-10-20 23:16:20'),(176,NULL,'2','1',8,1,0,'테스트9 질문1','app/file/20201020231156263.jpg',NULL,'1','2020-10-20 23:17:01'),(177,NULL,'2','1',9,1,0,'테스트9 질문1','app/file/20201020231156263.jpg',NULL,'1','2020-10-20 23:24:10'),(178,NULL,'2','1',10,1,0,'테스트9 질문1','app/file/20201020231156263.jpg',NULL,'1','2020-10-20 23:27:07'),(179,NULL,'2','1',11,1,0,'테스트9 질문1','app/file/20201020231156263.jpg',NULL,'1','2020-10-20 23:42:47'),(180,NULL,'2','1',12,1,0,'테스트7-2 질문1','app/file/20201021110735263.png',NULL,'1','2020-10-21 11:08:59'),(181,NULL,'2','1',13,1,0,'테스트7-2 질문1','app/file/20201021110735263.png',NULL,'1','2020-10-21 11:10:00'),(182,NULL,'2','1',14,1,0,'테스트7-2 질문1','app/file/20201021110735263.png',NULL,'1','2020-10-21 11:10:40'),(183,NULL,'2','1',15,1,0,'테스트7-2 질문1','app/file/20201021110735263.png',NULL,'1','2020-10-21 11:17:33'),(184,NULL,'2','1',16,1,0,'테스트7-2 질문1','app/file/20201021110735263.png',NULL,'1','2020-10-21 11:18:33'),(185,NULL,'2','1',17,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-21 11:37:56'),(186,NULL,'2','1',17,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-21 11:37:56'),(187,NULL,'2','1',18,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-21 11:38:49'),(188,NULL,'2','1',18,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-21 11:38:49'),(189,NULL,'2','1',19,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-21 11:39:06'),(190,NULL,'2','1',19,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-21 11:39:06'),(191,NULL,'2','1',20,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-21 11:42:32'),(192,NULL,'2','1',20,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-21 11:42:32'),(193,NULL,'2','1',21,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-21 15:33:04'),(194,NULL,'2','1',21,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-21 15:33:04'),(195,NULL,'2','1',22,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-21 15:33:45'),(196,NULL,'2','1',22,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-21 15:33:45'),(239,NULL,'2','1',44,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-25 22:56:11'),(240,NULL,'2','1',44,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-25 22:56:11'),(241,NULL,'2','1',45,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-26 11:45:47'),(242,NULL,'2','1',45,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-26 11:45:47'),(243,NULL,'2','1',46,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-26 23:16:53'),(244,NULL,'2','1',46,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-26 23:16:53'),(245,NULL,'2','1',47,1,0,'테스트7-1 질문1','app/file/20201004192145263.png',NULL,'1','2020-10-27 11:13:01'),(246,NULL,'2','1',47,2,1,'테스트7-1 질문2','app/file/20201021112927263.jpg',NULL,'1','2020-10-27 11:13:01'),(247,'2','1','1',24,1,0,'테스트 투표 양식10 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-03 22:27:59'),(248,'2','1','1',25,1,0,'테스트 투표 양식10 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-03 22:29:43'),(249,'2','1','1',26,1,0,'테스트 투표 양식11 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-04 16:05:58'),(250,'2','2','1',27,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-04 16:23:12'),(251,'2','2','1',27,2,1,'테스트 투표 양식12 질문 2','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-04 16:23:12'),(256,'2','2','1',28,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-05 12:58:03'),(257,'1','2','1',49,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-08 02:28:44'),(259,'1','2','1',51,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-09 19:28:19'),(260,'1','2','1',51,2,1,'테스트 투표 양식12 질문 2','https://img.newspim.com/news/2019/04/24/1904241453056910.jpg','2','1','2020-11-09 19:28:19'),(261,'1','2','1',52,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-10 00:45:19'),(262,'1','2','1',53,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-10 01:28:28'),(264,'2','2','1',30,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-13 12:45:54'),(265,'2','2','1',30,2,1,'테스트 투표 양식12 질문 2','https://youtu.be/KX-0ymTN4F0','3','1','2020-11-13 12:45:54'),(266,'2','2','1',31,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-13 12:50:36'),(267,'2','2','1',31,2,1,'테스트 투표 양식12 질문 2','app/file/real_20201113124911263.jpg','1','1','2020-11-13 12:50:36'),(276,'1','2','1',54,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-13 18:59:31'),(277,'1','2','1',54,2,1,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-13 18:59:31'),(278,'1','2','1',55,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-14 00:26:45'),(279,'1','2','1',55,2,1,'테스트 투표 양식12 질문 2','app/file/real_20201113124911263.jpg','1','1','2020-11-14 00:26:45'),(280,'1','2','1',56,1,0,'테스트 투표 양식13 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-14 17:40:59'),(281,'1','2','1',56,2,1,'테스트 투표 양식13 질문 2','','2','1','2020-11-14 17:40:59'),(282,'1','2','1',57,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-14 18:14:52'),(283,'1','2','1',58,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-15 20:35:28'),(284,'1','2','1',58,2,1,'테스트 투표 양식12 질문 2','','2','1','2020-11-15 20:35:28'),(285,'1','2','1',59,1,0,'테스트 투표 양식14 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-16 11:39:54'),(286,'1','2','1',59,3,1,'테스트 투표 양식14 질문 2','','2','2','2020-11-16 11:39:54'),(287,'1','2','1',60,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-16 17:43:46'),(288,'1','2','1',61,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-16 17:45:03'),(289,'1','2','1',61,2,1,'테스트 투표 양식12 질문 2','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','1','2020-11-16 17:45:03'),(290,'1','1','1',62,1,0,'테스트 투표 양식11 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2020-11-17 11:58:00'),(291,'1','2','1',63,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','2','2020-11-18 12:05:12'),(296,'2','1','1',32,1,0,'테스트 투표 양식14 질문 1','https://youtu.be/pmeVfyHWVyE','3','5','2020-11-20 22:30:53'),(297,'2','1','1',32,2,1,'테스트 투표 양식14 질문 2','app/file/20201120192038263.jpg','1','1','2020-11-20 22:30:53'),(298,'1','1','1',64,1,0,'테스트 투표 양식14 질문 1','https://youtu.be/pmeVfyHWVyE','3','5','2020-11-21 00:00:30'),(299,'1','1','1',64,2,1,'테스트 투표 양식14 질문 2','app/file/20201120192038263.jpg','1','1','2020-11-21 00:00:30'),(300,'2','3','1',33,1,0,'테스트 투표 양식15 테스트 투표 질문1','','4','1','2020-11-26 15:00:57'),(301,'2','3','1',33,3,1,'테스트 투표 양식15 테스트 투표 질문2','https://youtu.be/KX-0ymTN4F0','3','5','2020-11-26 15:00:57'),(302,'1','3','1',65,1,0,'테스트 투표 양식15 테스트 투표 질문1','','4','1','2020-11-26 17:11:18'),(303,'1','3','1',65,3,1,'테스트 투표 양식15 테스트 투표 질문2','https://youtu.be/KX-0ymTN4F0','3','5','2020-11-26 17:11:18'),(304,'1','3','1',65,2,2,'테스트 투표 양식15 테스트 투표 질문3','https://youtu.be/ITNQ51cNJgw','3','3','2020-11-26 17:11:18'),(305,'1','1','1',66,1,0,'테스트 투표 16 테스트 투표 질문 1','app/file/real_20201127173648263.jpg','','4','2020-11-27 17:42:03'),(306,'1','1','1',67,1,0,'테스트 투표 16 테스트 투표 질문 1','app/file/real_20201127173648263.jpg','','4','2020-11-27 17:46:43'),(307,'1','1','1',68,1,0,'테스트 투표 17 테스트 투표 질문1','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','2','2020-12-01 14:47:12'),(308,'1','1','1',68,2,1,'테스트 투표 17 테스트 투표 질문2','https://youtu.be/AwmLQNiwwRI','3','2','2020-12-01 14:47:13'),(309,'1','1','1',69,1,0,'테스트 투표 17 테스트 투표 질문1','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','2','2020-12-01 14:48:16'),(310,'1','1','1',69,2,1,'테스트 투표 17 테스트 투표 질문2','https://youtu.be/AwmLQNiwwRI','3','2','2020-12-01 14:48:16'),(311,'1','1','1',70,1,0,'테스트 투표 18 테스트 투표 ','app/file/real_20201201231033263.jpg','','1','2020-12-01 23:11:20'),(318,'2','4','1',34,2,0,'테스트 투표 양식16 테스트 투표 질문 2','https://youtu.be/AwmLQNiwwRI','3','2','2020-12-04 00:32:55'),(319,'2','4','1',34,1,1,'테스트 투표 양식16 테스트 투표 질문 1','app/file/real_20201203234416263.jpeg','1','1','2020-12-04 00:32:55'),(320,'1','4','1',71,2,0,'테스트 투표 양식16 테스트 투표 질문 2','https://youtu.be/AwmLQNiwwRI','3','2','2020-12-05 18:09:15'),(321,'1','4','1',71,3,1,'테스트 투표 양식16 테스트 투표 질문 3','','0','1','2020-12-05 18:09:15'),(322,'1','4','1',71,1,2,'테스트 투표 양식16 테스트 투표 질문 1','app/file/real_20201203234416263.jpeg','1','1','2020-12-05 18:09:15'),(323,'2','4','1',35,3,0,'테스트 투표 양식17 테스트 투표 질문 3','https://youtu.be/AwmLQNiwwRI','3','1','2020-12-06 17:45:59'),(324,'2','4','1',35,1,1,'테스트 투표 양식17 테스트 투표 질문 1','app/file/real_20201206165050263.jpg','1','1','2020-12-06 17:45:59'),(325,'2','4','1',35,2,2,'테스트 투표 양식17 테스트 투표 질문 2','','4','2','2020-12-06 17:45:59'),(326,'1','4','1',72,3,0,'테스트 투표 양식17 테스트 투표 질문 3','https://youtu.be/AwmLQNiwwRI','3','1','2020-12-06 18:16:59'),(327,'1','4','1',72,1,1,'테스트 투표 양식17 테스트 투표 질문 1','app/file/real_20201206165050263.jpg','1','1','2020-12-06 18:16:59'),(328,'1','4','1',72,2,2,'테스트 투표 양식17 테스트 투표 질문 2','','4','2','2020-12-06 18:16:59'),(329,'1','4','1',73,3,0,'테스트 투표 양식17 테스트 투표 질문 3','https://youtu.be/AwmLQNiwwRI','3','1','2020-12-06 18:51:11'),(330,'1','4','1',73,1,1,'테스트 투표 양식17 테스트 투표 질문 1','app/file/real_20201206165050263.jpg','1','1','2020-12-06 18:51:11'),(331,'1','4','1',73,2,2,'테스트 투표 양식17 테스트 투표 질문 2','','0','2','2020-12-06 18:51:11'),(334,'2','4','1',36,1,0,'테스트 투표 양식18 테스트 투표 질문 1','','0','1','2020-12-07 11:28:57'),(335,'2','4','1',36,2,1,'테스트 투표 양식18 테스트 투표 질문 2','https://youtu.be/ITNQ51cNJgw','3','2','2020-12-07 11:28:57'),(336,'1','4','1',74,1,0,'테스트 투표 양식18 테스트 투표 질문 1','','0','1','2020-12-07 14:14:10'),(337,'1','4','1',74,2,1,'테스트 투표 양식18 테스트 투표 질문 2','https://youtu.be/ITNQ51cNJgw','3','2','2020-12-07 14:14:10'),(338,'2','2','1',37,1,0,'테스트 투표 양식19 테스트 투표 질문 1','','0','1','2020-12-07 18:36:33'),(339,'1','2','1',75,1,0,'테스트 투표 양식19 테스트 투표 질문 1','','0','1','2020-12-07 18:45:43'),(340,'1','1','2',76,1,0,'테스트 투표 20 테스트 투표 질문1','','0','1','2020-12-08 18:21:04'),(341,'1','1','2',77,1,0,'테스트 투표 21 이벤트 투표 질문 1','app/file/real_20201209173857263.jpeg','1','1','2020-12-09 17:39:19'),(342,'1','2','2',78,1,0,'테스트 투표 22 테스트 투표 질문 1','https://youtu.be/pmeVfyHWVyE','3','2','2020-12-19 18:49:51'),(343,'1','1','2',79,1,0,'테스트 투표 22 질문 1','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','2','2020-12-19 19:25:22'),(344,'1','1','2',79,2,1,'테스트 투표 22 질문 2','app/file/real_20201219192329263.jpeg','','1','2020-12-19 19:25:22'),(345,'1','2','2',80,1,0,'테스트 투표 23 테스트 투표 질문 1','','0','2','2020-12-20 17:36:17'),(346,'1','2','2',80,2,1,'테스트 투표 23 테스트 투표 질문 2','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','1','2020-12-20 17:36:17'),(347,'1','2','2',81,1,0,'테스트 투표 23 투표 응답1','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','1','2020-12-21 17:26:42'),(348,'1','2','2',82,1,0,'테스트 투표 24 질문1','https://youtu.be/pmeVfyHWVyE','3','1','2020-12-21 18:58:48'),(349,'2','3','2',38,1,0,'테스트 투표 양식20 질문1 입니다.','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','1','2020-12-22 13:59:06'),(350,'1','2','2',83,1,0,'테스트 투표 양식20 테스트 질문1 입니다.','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','1','2020-12-22 14:18:44'),(351,'1','2','2',83,2,1,'테스트 투표 양식20 테스트 질문2 입니다.','','0','2','2020-12-22 14:18:44'),(352,'2','2','2',39,1,0,'테스트 투표 양식21 질문 1','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','1','2020-12-23 17:23:54'),(353,'1','2','2',84,1,0,'테스트 투표 양식21 질문 1','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','1','2020-12-23 17:43:03'),(354,'1','2','2',84,2,1,'테스트 투표 양식21 질문 2','app/file/real_20201223174207263.jpg','','3','2020-12-23 17:43:03'),(355,'2','1','2',40,1,0,'테스트 투표 양식17 테스트 투표 질문 1','app/file/real_20201224122031263.jpeg','1','3','2020-12-24 12:24:20'),(356,'2','1','2',40,2,1,'테스트 투표 양식17 테스트 투표 질문 2','app/file/real_20201224122330263.jpg','1','4','2020-12-24 12:24:20'),(357,'1','1','2',85,1,0,'테스트 투표 양식17 테스트 투표 질문 1','app/file/real_20201224122031263.jpeg','1','3','2020-12-24 12:25:56'),(358,'1','1','2',85,2,1,'테스트 투표 양식17 테스트 투표 질문 2','app/file/real_20201224122330263.jpg','1','4','2020-12-24 12:25:56'),(359,'2','2','2',41,1,0,'테스트 투표 양식20 테스트25 투표 질문1','app/file/real_20201226181926263.jpg','1','2','2020-12-26 18:20:02'),(360,'1','2','2',86,1,0,'테스트 투표 양식20 테스트25 투표 질문1','app/file/real_20201226181926263.jpg','1','2','2020-12-26 18:33:36'),(361,'1','2','2',86,2,1,'테스트 투표 양식20 테스트25 투표 질문2','https://www.learnreligions.com/thmb/QjJf69xIH0O9112R1oilFwEef4U=/3494x3494/smart/filters:no_upscale()/woman-with-angel-wings-108263480-5837a4d33df78c6f6ae9fd7f.jpg','2','1','2020-12-26 18:33:36'),(362,'2','1','1',42,1,0,'테스트 투표 양식22 질문 1','app/file/20210107173206263.jpg','1','1','2021-01-07 17:33:27'),(363,'2','1','1',42,2,1,'테스트 투표 양식22 질문 2','app/file/20210107173252263.png','1','2','2021-01-07 17:33:27'),(364,'1','1','1',87,1,0,'테스트 투표 양식22 질문 1','app/file/20210107173206263.jpg','1','1','2021-01-07 17:59:56'),(365,'1','1','1',87,2,1,'테스트 투표 양식22 질문 2','app/file/20210107173252263.png','1','2','2021-01-07 17:59:56'),(366,'1','1','1',88,1,0,'테스트 투표 양식22 질문 1','app/file/20210107173206263.jpg','1','1','2021-01-07 18:00:28'),(367,'1','1','1',88,2,1,'테스트 투표 양식22 질문 2','app/file/20210107173252263.png','1','2','2021-01-07 18:00:28'),(368,'1','1','1',89,1,0,'테스트 투표 양식22 질문 1','app/file/20210107173206263.jpg','1','1','2021-01-07 18:26:57'),(369,'1','1','1',89,2,1,'테스트 투표 양식22 질문 2','app/file/20210107173252263.png','1','2','2021-01-07 18:26:57'),(370,'1','1','1',90,1,0,'테스트 투표 양식12 질문 1','https://youtu.be/pmeVfyHWVyE','3','1','2021-01-29 17:08:23'),(371,'1','1','1',90,2,1,'테스트 투표 양식12 질문 2','https://youtu.be/pmeVfyHWVyE','0','1','2021-01-29 17:08:23'),(372,'2','2','1',43,1,0,'테스트 투표 양식25 테스트 투표 질문1','app/file/20210327012955263.jpg','1','1','2021-03-27 01:33:04'),(373,'2','2','1',43,2,1,'테스트 투표 양식25 테스트 투표 질문2','app/file/20210327013255263.jpg','1','5','2021-03-27 01:33:04'),(374,'1','2','1',91,3,0,'테스트 투표 양식25 테스트 투표 질문3','app/file/20210327022845263.png','','2','2021-03-27 02:29:42'),(375,'1','2','1',91,1,1,'테스트 투표 양식25 테스트 투표 질문1','app/file/20210327012955263.jpg','1','1','2021-03-27 02:29:42'),(376,'1','2','1',91,2,2,'테스트 투표 양식25 테스트 투표 질문2','app/file/20210327013255263.jpg','1','5','2021-03-27 02:29:42');
/*!40000 ALTER TABLE `VOTE_QUESTIONS` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `VOTE_RESP_LOG`
--

DROP TABLE IF EXISTS `VOTE_RESP_LOG`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `VOTE_RESP_LOG` (
  `VOTE_RESP_SEQ` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `VOTE_QUESTION_SEQ` int(11) DEFAULT NULL,
  `VOTE_QUESTION_RESP_TYPE` char(1) DEFAULT NULL,
  `VOTE_QUESTION_INDEX` int(11) DEFAULT NULL,
  `VOTE_ANSWER_SELECT_SEQ` int(11) DEFAULT NULL,
  `VOTE_MEMBER_SEQ` int(11) DEFAULT NULL,
  `VOTE_RESP_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`VOTE_RESP_SEQ`),
  KEY `IDX_VOTE_RESP_SEQ_X01` (`VOTE_SEQ`,`VOTE_QUESTION_SEQ`,`VOTE_ANSWER_SELECT_SEQ`,`VOTE_MEMBER_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=140 DEFAULT CHARSET=utf8 COMMENT='투표 응답 데이터';
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `VOTE_RESP_LOG`
--

LOCK TABLES `VOTE_RESP_LOG` WRITE;
/*!40000 ALTER TABLE `VOTE_RESP_LOG` DISABLE KEYS */;
INSERT INTO `VOTE_RESP_LOG` VALUES (25,62,290,'1',1,587,2,'2020-11-17 17:23:48'),(26,62,290,'1',1,587,2,'2020-11-17 17:25:39'),(27,62,290,'1',1,587,2,'2020-11-17 17:25:48'),(28,62,290,'1',1,588,2,'2020-11-17 17:25:55'),(29,62,290,'1',1,588,2,'2020-11-17 17:26:56'),(30,62,290,'1',1,587,2,'2020-11-17 17:28:04'),(31,62,290,'1',1,587,2,'2020-11-17 17:28:13'),(32,62,290,'1',1,588,2,'2020-11-17 17:28:18'),(33,62,290,'1',1,588,2,'2020-11-17 17:30:17'),(34,62,290,'1',1,587,2,'2020-11-17 17:30:22'),(35,62,290,'1',1,588,2,'2020-11-17 17:30:28'),(36,62,290,'1',1,588,2,'2020-11-17 17:30:32'),(37,62,290,'1',1,588,2,'2020-11-17 17:30:37'),(38,62,290,'1',1,587,2,'2020-11-17 17:30:41'),(39,63,291,'2',1,592,2,'2020-11-18 12:06:44'),(40,63,291,'2',1,590,2,'2020-11-18 12:07:09'),(41,63,291,'2',1,591,2,'2020-11-18 12:07:21'),(42,63,291,'2',1,590,2,'2020-11-18 12:07:27'),(43,63,291,'2',1,591,2,'2020-11-18 12:09:37'),(44,63,291,'2',1,590,2,'2020-11-18 12:09:47'),(45,63,291,'2',1,590,2,'2020-11-18 12:09:54'),(46,63,291,'2',1,589,2,'2020-11-18 12:10:01'),(47,63,291,'2',1,589,2,'2020-11-18 12:10:07'),(48,63,291,'2',1,589,2,'2020-11-18 12:10:14'),(49,63,291,'2',1,591,2,'2020-11-18 12:10:25'),(50,63,291,'2',1,590,2,'2020-11-18 12:10:32'),(51,63,291,'2',1,591,2,'2020-11-18 12:10:44'),(52,64,298,'5',1,4,2,'2020-11-23 19:26:27'),(53,64,298,'5',1,2,2,'2020-11-23 19:28:42'),(54,64,298,'5',1,3,2,'2020-11-23 19:30:24'),(55,64,298,'5',1,2,2,'2020-11-23 19:30:48'),(56,64,298,'5',1,3,2,'2020-11-23 19:31:28'),(57,64,298,'5',1,3,2,'2020-11-23 22:25:06'),(58,64,299,'1',2,599,2,'2020-11-23 22:25:06'),(59,61,288,'1',1,582,2,'2020-11-23 22:28:12'),(60,61,289,'1',2,586,2,'2020-11-23 22:28:12'),(61,64,298,'5',1,4,2,'2020-11-23 23:26:53'),(62,64,299,'1',2,599,2,'2020-11-23 23:26:53'),(63,64,298,'5',1,3,2,'2020-11-24 18:02:45'),(64,64,299,'1',2,599,2,'2020-11-24 18:02:45'),(65,64,298,'5',1,2,2,'2020-11-24 22:31:57'),(66,64,299,'1',2,600,2,'2020-11-24 22:31:57'),(67,64,298,'5',1,3,2,'2020-11-24 22:42:01'),(68,64,299,'1',2,600,2,'2020-11-24 22:42:01'),(69,65,302,'1',1,607,2,'2020-11-26 17:22:48'),(70,65,304,'3',2,612,2,'2020-11-26 17:22:48'),(71,65,303,'5',3,613,2,'2020-11-26 17:22:48'),(72,67,306,'4',1,23,NULL,'2020-11-27 18:17:38'),(73,67,306,'4',1,612,NULL,'2020-11-27 21:21:21'),(74,67,306,'4',1,613,NULL,'2020-11-27 21:24:50'),(75,67,306,'4',1,23,NULL,'2020-11-27 21:26:11'),(76,67,306,'4',1,612,NULL,'2020-11-27 22:43:21'),(77,67,306,'4',1,613,NULL,'2020-11-27 22:44:28'),(78,67,306,'4',1,612,NULL,'2020-11-27 22:45:06'),(79,67,306,'4',1,613,NULL,'2020-11-27 22:46:03'),(80,67,306,'4',1,23,NULL,'2020-11-27 22:46:27'),(81,67,306,'4',1,612,NULL,'2020-11-27 22:49:14'),(82,67,306,'4',1,613,NULL,'2020-11-27 22:49:14'),(83,67,306,'4',1,23,NULL,'2020-11-27 22:49:14'),(84,67,306,'4',1,612,NULL,'2020-11-27 22:50:09'),(85,67,306,'4',1,613,NULL,'2020-11-27 22:50:09'),(86,67,306,'4',1,23,NULL,'2020-11-27 22:50:09'),(87,67,306,'4',1,612,NULL,'2020-11-27 22:50:10'),(88,67,306,'4',1,613,NULL,'2020-11-27 22:50:10'),(89,67,306,'4',1,23,NULL,'2020-11-27 22:50:10'),(90,67,306,'4',1,612,NULL,'2020-11-27 22:50:11'),(91,67,306,'4',1,613,NULL,'2020-11-27 22:50:11'),(92,67,306,'4',1,23,NULL,'2020-11-27 22:50:11'),(93,67,306,'4',1,612,NULL,'2020-11-27 22:50:35'),(94,67,306,'4',1,613,NULL,'2020-11-27 22:50:35'),(95,67,306,'4',1,23,NULL,'2020-11-27 22:50:35'),(96,67,306,'4',1,612,NULL,'2020-11-27 22:52:59'),(97,67,306,'4',1,613,NULL,'2020-11-27 22:52:59'),(98,67,306,'4',1,24,NULL,'2020-11-27 22:52:59'),(99,69,309,'2',1,619,2,'2020-12-01 17:04:30'),(100,69,310,'2',2,622,2,'2020-12-01 17:04:30'),(101,69,309,'2',1,619,2,'2020-12-01 17:17:08'),(102,69,310,'2',2,623,2,'2020-12-01 17:17:08'),(103,70,311,'1',1,624,2,'2020-12-01 23:12:20'),(104,74,336,'1',1,685,2,'2020-12-07 15:24:50'),(105,74,337,'2',2,688,2,'2020-12-07 15:24:50'),(106,75,339,'1',1,694,2,'2020-12-07 18:45:56'),(107,77,341,'1',1,NULL,2,'2020-12-12 19:34:39'),(108,77,341,'1',1,698,2,'2020-12-12 19:35:23'),(109,77,341,'1',1,699,2,'2020-12-13 17:36:54'),(110,77,341,'1',1,699,2,'2020-12-13 19:07:52'),(111,77,341,'1',1,699,2,'2020-12-13 19:08:11'),(112,77,341,'1',1,699,2,'2020-12-13 19:10:25'),(113,77,341,'1',1,699,2,'2020-12-13 19:11:00'),(114,77,341,'1',1,699,2,'2020-12-13 19:12:26'),(115,77,341,'1',1,699,2,'2020-12-13 19:12:45'),(116,77,341,'1',1,699,2,'2020-12-13 19:12:54'),(117,77,341,'1',1,NULL,NULL,'2020-12-14 11:57:04'),(118,77,341,'1',1,NULL,NULL,'2020-12-14 12:11:38'),(119,77,341,'1',1,698,NULL,'2020-12-14 12:16:48'),(120,77,341,'1',1,698,2,'2020-12-14 12:24:56'),(121,77,341,'1',1,699,2,'2021-01-03 02:06:11'),(122,89,368,'1',1,777,2,'2021-01-07 19:24:11'),(123,89,369,'2',2,779,2,'2021-01-07 19:24:11'),(124,89,369,'2',2,780,2,'2021-01-07 19:24:11'),(125,89,368,'1',1,776,2,'2021-03-18 04:04:52'),(126,89,369,'2',2,780,2,'2021-03-18 04:04:52'),(127,76,340,'1',1,696,2,'2021-03-18 04:07:06'),(128,91,375,'1',1,791,2,'2021-03-27 03:29:14'),(129,91,376,'5',2,NULL,2,'2021-03-27 03:29:14'),(130,91,374,'2',3,788,2,'2021-03-27 03:29:14'),(131,91,374,'2',3,789,2,'2021-03-27 03:29:14'),(132,91,375,'1',1,792,4,'2021-03-27 03:32:15'),(133,91,376,'5',2,NULL,4,'2021-03-27 03:32:15'),(134,91,374,'2',3,788,4,'2021-03-27 03:32:15'),(135,91,374,'2',3,790,4,'2021-03-27 03:32:15'),(136,91,375,'1',1,792,4,'2021-03-27 03:32:34'),(137,91,376,'5',2,NULL,4,'2021-03-27 03:32:34'),(138,91,374,'2',3,788,4,'2021-03-27 03:32:34'),(139,91,374,'2',3,790,4,'2021-03-27 03:32:34');
/*!40000 ALTER TABLE `VOTE_RESP_LOG` ENABLE KEYS */;
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
  `PHONENUMBER` varchar(45) DEFAULT NULL,
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
INSERT INTO `ptp_admin` VALUES (112,'admin','*0262F498E91CA294A8BA96084EEEDB5F635B23A3','관리자',NULL,NULL,'1',NULL,1);
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

-- Dump completed on 2021-03-27  4:19:38
