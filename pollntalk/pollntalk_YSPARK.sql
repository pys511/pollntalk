-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- 생성 시간: 20-10-29 16:44
-- 서버 버전: 10.3.8-MariaDB
-- PHP 버전: 7.2.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 데이터베이스: `pollntalk`
--
CREATE DATABASE IF NOT EXISTS `pollntalk` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `pollntalk`;

-- --------------------------------------------------------

--
-- 테이블 구조 `category`
--

CREATE TABLE IF NOT EXISTS `category` (
  `CATE_SEQ` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `CATE_NAME` varchar(10) DEFAULT NULL,
  `CATE_PARENT_SEQ` int(11) DEFAULT NULL,
  `CATE_TEXT` varchar(250) DEFAULT NULL,
  `CATE_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `CATE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`CATE_SEQ`),
  KEY `IDX_CATE_X01` (`CATE_PARENT_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COMMENT='카테고리';

-- --------------------------------------------------------

--
-- 테이블 구조 `member`
--

CREATE TABLE IF NOT EXISTS `member` (
  `member_seq` int(10) UNSIGNED NOT NULL AUTO_INCREMENT COMMENT '키',
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(125) DEFAULT NULL,
  `uname` varchar(16) DEFAULT NULL,
  `nname` varchar(16) DEFAULT NULL COMMENT '닉네임',
  `birthday` date DEFAULT NULL,
  `gender` char(1) DEFAULT NULL,
  `abode` char(2) DEFAULT NULL COMMENT '거주지',
  `grade` char(1) DEFAULT NULL,
  `agree` char(1) DEFAULT NULL,
  `pic` char(36) NOT NULL,
  `regidate` timestamp NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`member_seq`),
  KEY `IDX_MEMBER_X01` (`email`,`birthday`,`gender`,`abode`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COMMENT='회원정보';

--
-- 테이블의 덤프 데이터 `member`
--

INSERT INTO `member` (`member_seq`, `email`, `password`, `uname`, `nname`, `birthday`, `gender`, `abode`, `grade`, `agree`, `pic`, `regidate`) VALUES
(2, 'shaman511@nate.com', '*FB495FCA5055AE781916EBC6D041E7ED34942D33', '박윤식', '김치', '1980-05-11', 'm', '11', '0', '1', '', '2020-09-17 00:53:56'),
(3, 'her_jjang@nate.com', '*FB495FCA5055AE781916EBC6D041E7ED34942D33', '감수광', '감감감', '1971-05-04', 'f', '05', '0', '1', '', '2020-09-22 01:54:35'),
(4, 'nknkjin@nioknikn.com', '*FB495FCA5055AE781916EBC6D041E7ED34942D33', '김상', '상상', '1902-12-30', 'f', '13', '0', '1', 'pic/default.png', '2020-09-28 02:01:23'),
(5, 'sssd@sssd.com', '*FB495FCA5055AE781916EBC6D041E7ED34942D33', '장강', '장강', '2008-08-11', 'f', '16', '0', '1', 'pic/default.png', '2020-09-28 02:04:11'),
(6, 'qwe@qwe.com', '*FB495FCA5055AE781916EBC6D041E7ED34942D33', '김쓰쓰', '끄끄끄', '1997-06-03', 'm', '13', '0', '1', 'pic/pic_6.png', '2020-10-06 01:05:50'),
(7, 'test01@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트01', '테스트01', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 02:30:57'),
(8, 'test02@test.com', '*EF4B25DE463D6C8E8BE07C2506E3BBFECF200D4B', '테스트2', '테스트2', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:24:53'),
(10, 'test03@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트3', '테스트3', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:26:15'),
(11, 'test04@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트4', '테스트4', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:26:28'),
(12, 'test05@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트5', '테스트5', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:26:39'),
(13, 'test06@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트6', '테스트6', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:26:49'),
(14, 'test07@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트7', '테스트7', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:27:01'),
(15, 'test08@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트8', '테스트8', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:27:13'),
(16, 'test09@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트9', '테스트9', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:33:04'),
(17, 'test10@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트10', '테스트10', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:33:31'),
(18, 'test11@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트11', '테스트11', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:33:44'),
(19, 'test12@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트12', '테스트12', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:33:57'),
(20, 'test13@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트13', '테스트13', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:34:08'),
(21, 'test14@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트14', '테스트14', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:34:20'),
(22, 'test15@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트15', '테스트15', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:34:32'),
(23, 'test16@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트16', '테스트16', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:35:59'),
(24, 'test17@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트17', '테스트17', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:36:10'),
(25, 'test18@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트18', '테스트18', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:36:22'),
(26, 'test19@test.com', '*EF5DC2AA092C29097EC6D474E612E5F1BE0D04E0', '테스트19', '테스트19', '2002-03-18', 'f', '17', '0', '1', 'pic/default.png', '2020-10-14 03:36:34');

-- --------------------------------------------------------

--
-- 테이블 구조 `message_box`
--

CREATE TABLE IF NOT EXISTS `message_box` (
  `idx` int(11) NOT NULL AUTO_INCREMENT,
  `recv_seq` int(10) NOT NULL,
  `send_seq` int(10) NOT NULL,
  `title` varchar(100) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `read_chk` int(1) NOT NULL,
  `date` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`idx`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- 테이블 구조 `notice`
--

CREATE TABLE IF NOT EXISTS `notice` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) DEFAULT NULL,
  `context` text DEFAULT NULL,
  `ADMINNAME` varchar(25) NOT NULL,
  `creat_date` date DEFAULT current_timestamp(),
  `count` int(8) NOT NULL DEFAULT 0,
  PRIMARY KEY (`num`),
  UNIQUE KEY `num` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=253 DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `notice`
--

INSERT INTO `notice` (`num`, `subject`, `context`, `ADMINNAME`, `creat_date`, `count`) VALUES
(1, '이것은 테스트입니다.', '이것은 테스트입니다. 이것은 테스트입니다.', '관리자', '2020-10-19', 4),
(2, '테스트데이터 1', '이것은 테스1입니다.', '관리자2', '2020-10-26', 2),
(3, '테스트데이터1', '테스트데이터입니다.........', '관리자', '2020-10-26', 0),
(4, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '0000-00-00', 0),
(5, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '0000-00-00', 0),
(6, '테스트페이지3', '테스트페이지입니다.\r\n3\r\n3', '관리자', '0000-00-00', 0),
(7, '테스트페이지4', '테스트페이지입니다.\r\n3\r\n4', '관리자', '0000-00-00', 0),
(8, '테스트페이지5', '테스트페이지입니다.\r\n3\r\n5', '관리자', '0000-00-00', 0),
(9, '테스트페이지6', '테스트페이지입니다.\r\n3\r\n6', '관리자', '0000-00-00', 0),
(10, '테스트페이지7', '테스트페이지입니다.\r\n3\r\n7', '관리자', '0000-00-00', 0),
(11, '테스트페이지8', '테스트페이지입니다.\r\n3\r\n8', '관리자', '0000-00-00', 0),
(12, '테스트페이지9', '테스트페이지입니다.\r\n3\r\n9', '관리자', '0000-00-00', 0),
(13, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '0000-00-00', 0),
(14, '테스트페이지11', '테스트페이지입니다.\r\n3\r\n11', '관리자', '0000-00-00', 0),
(15, '이것은 테스트입니다.', '이것은 테스트입니다. 이것은 테스트입니다.', '관리자', '2020-10-28', 0),
(16, '테스트데이터 1', '이것은 테스1입니다.', '관리자2', '2020-10-28', 0),
(17, '테스트데이터1', '테스트데이터입니다.........', '관리자', '2020-10-28', 0),
(18, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(19, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(20, '테스트페이지3', '테스트페이지입니다.\r\n3\r\n3', '관리자', '2020-10-28', 0),
(21, '테스트페이지4', '테스트페이지입니다.\r\n3\r\n4', '관리자', '2020-10-28', 4),
(22, '테스트페이지5', '테스트페이지입니다.\r\n3\r\n5', '관리자', '2020-10-28', 0),
(23, '테스트페이지6', '테스트페이지입니다.\r\n3\r\n6', '관리자', '2020-10-28', 0),
(24, '테스트페이지7', '테스트페이지입니다.\r\n3\r\n7', '관리자', '2020-10-28', 0),
(25, '테스트페이지8', '테스트페이지입니다.</br>\r\n3</br>\r\n8</br>', '관리자', '2020-10-28', 1),
(26, '테스트페이지9', '테스트페이지입니다.\r\n3\r\n9', '관리자', '2020-10-28', 0),
(27, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(28, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(29, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(30, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(31, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(32, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(33, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(34, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(35, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(36, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(37, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(38, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(39, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(40, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(41, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(42, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(43, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(44, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(45, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(46, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(47, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(48, '테스트페이지11', '테스트페이지입니다.\r\n3\r\n11', '관리자', '2020-10-28', 0),
(49, '이것은 테스트입니다.', '이것은 테스트입니다. 이것은 테스트입니다.', '관리자', '2020-10-28', 0),
(50, '테스트데이터 1', '이것은 테스1입니다.', '관리자2', '2020-10-28', 0),
(51, '테스트데이터1', '테스트데이터입니다.........', '관리자', '2020-10-28', 0),
(52, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(53, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(54, '테스트페이지3', '테스트페이지입니다.\r\n3\r\n3', '관리자', '2020-10-28', 0),
(55, '테스트페이지4', '테스트페이지입니다.\r\n3\r\n4', '관리자', '2020-10-28', 0),
(56, '테스트페이지5', '테스트페이지입니다.\r\n3\r\n5', '관리자', '2020-10-28', 0),
(57, '테스트페이지6', '테스트페이지입니다.\r\n3\r\n6', '관리자', '2020-10-28', 0),
(58, '테스트페이지7', '테스트페이지입니다.\r\n3\r\n7', '관리자', '2020-10-28', 0),
(59, '테스트페이지8', '테스트페이지입니다.\r\n3\r\n8', '관리자', '2020-10-28', 0),
(60, '테스트페이지9', '테스트페이지입니다.\r\n3\r\n9', '관리자', '2020-10-28', 0),
(61, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(62, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(63, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(64, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(65, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(66, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(67, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(68, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(69, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(70, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(71, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(72, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(73, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(74, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(75, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(76, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(77, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(78, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(79, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(80, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(81, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(82, '테스트페이지11', '테스트페이지입니다.\r\n3\r\n11', '관리자', '2020-10-28', 0),
(83, '이것은 테스트입니다.', '이것은 테스트입니다. 이것은 테스트입니다.', '관리자', '2020-10-28', 0),
(84, '테스트데이터 1', '이것은 테스1입니다.', '관리자2', '2020-10-28', 0),
(85, '테스트데이터1', '테스트데이터입니다.........', '관리자', '2020-10-28', 0),
(86, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(87, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(88, '테스트페이지3', '테스트페이지입니다.\r\n3\r\n3', '관리자', '2020-10-28', 0),
(89, '테스트페이지4', '테스트페이지입니다.\r\n3\r\n4', '관리자', '2020-10-28', 0),
(90, '테스트페이지5', '테스트페이지입니다.\r\n3\r\n5', '관리자', '2020-10-28', 0),
(91, '테스트페이지6', '테스트페이지입니다.\r\n3\r\n6', '관리자', '2020-10-28', 0),
(92, '테스트페이지7', '테스트페이지입니다.\r\n3\r\n7', '관리자', '2020-10-28', 0),
(93, '테스트페이지8', '테스트페이지입니다.\r\n3\r\n8', '관리자', '2020-10-28', 0),
(94, '테스트페이지9', '테스트페이지입니다.\r\n3\r\n9', '관리자', '2020-10-28', 0),
(95, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(96, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(97, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(98, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(99, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(100, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(101, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(102, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(103, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(104, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(105, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(106, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(107, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(108, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(109, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(110, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(111, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(112, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(113, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(114, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(115, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(116, '테스트페이지11', '테스트페이지입니다.\r\n3\r\n11', '관리자', '2020-10-28', 0),
(117, '이것은 테스트입니다.', '이것은 테스트입니다. 이것은 테스트입니다.', '관리자', '2020-10-28', 0),
(118, '테스트데이터 1', '이것은 테스1입니다.', '관리자2', '2020-10-28', 0),
(119, '테스트데이터1', '테스트데이터입니다.........', '관리자', '2020-10-28', 0),
(120, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(121, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(122, '테스트페이지3', '테스트페이지입니다.\r\n3\r\n3', '관리자', '2020-10-28', 0),
(123, '테스트페이지4', '테스트페이지입니다.\r\n3\r\n4', '관리자', '2020-10-28', 0),
(124, '테스트페이지5', '테스트페이지입니다.\r\n3\r\n5', '관리자', '2020-10-28', 0),
(125, '테스트페이지6', '테스트페이지입니다.\r\n3\r\n6', '관리자', '2020-10-28', 0),
(126, '테스트페이지7', '테스트페이지입니다.\r\n3\r\n7', '관리자', '2020-10-28', 0),
(127, '테스트페이지8', '테스트페이지입니다.\r\n3\r\n8', '관리자', '2020-10-28', 0),
(128, '테스트페이지9', '테스트페이지입니다.\r\n3\r\n9', '관리자', '2020-10-28', 0),
(129, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(130, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(131, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(132, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(133, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(134, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(135, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(136, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(137, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(138, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(139, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(140, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(141, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(142, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(143, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(144, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(145, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(146, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(147, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(148, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(149, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(150, '테스트페이지11', '테스트페이지입니다.\r\n3\r\n11', '관리자', '2020-10-28', 0),
(151, '이것은 테스트입니다.', '이것은 테스트입니다. 이것은 테스트입니다.', '관리자', '2020-10-28', 0),
(152, '테스트데이터 1', '이것은 테스1입니다.', '관리자2', '2020-10-28', 0),
(153, '테스트데이터1', '테스트데이터입니다.........', '관리자', '2020-10-28', 0),
(154, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(155, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(156, '테스트페이지3', '테스트페이지입니다.\r\n3\r\n3', '관리자', '2020-10-28', 0),
(157, '테스트페이지4', '테스트페이지입니다.\r\n3\r\n4', '관리자', '2020-10-28', 0),
(158, '테스트페이지5', '테스트페이지입니다.\r\n3\r\n5', '관리자', '2020-10-28', 0),
(159, '테스트페이지6', '테스트페이지입니다.\r\n3\r\n6', '관리자', '2020-10-28', 0),
(160, '테스트페이지7', '테스트페이지입니다.\r\n3\r\n7', '관리자', '2020-10-28', 0),
(161, '테스트페이지8', '테스트페이지입니다.\r\n3\r\n8', '관리자', '2020-10-28', 0),
(162, '테스트페이지9', '테스트페이지입니다.\r\n3\r\n9', '관리자', '2020-10-28', 0),
(163, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(164, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(165, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(166, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(167, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(168, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(169, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(170, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(171, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(172, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(173, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(174, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(175, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(176, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(177, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(178, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(179, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(180, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(181, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(182, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(183, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(184, '테스트페이지11', '테스트페이지입니다.\r\n3\r\n11', '관리자', '2020-10-28', 0),
(185, '이것은 테스트입니다.', '이것은 테스트입니다. 이것은 테스트입니다.', '관리자', '2020-10-28', 0),
(186, '테스트데이터 1', '이것은 테스1입니다.', '관리자2', '2020-10-28', 0),
(187, '테스트데이터1', '테스트데이터입니다.........', '관리자', '2020-10-28', 0),
(188, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(189, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(190, '테스트페이지3', '테스트페이지입니다.\r\n3\r\n3', '관리자', '2020-10-28', 0),
(191, '테스트페이지4', '테스트페이지입니다.\r\n3\r\n4', '관리자', '2020-10-28', 0),
(192, '테스트페이지5', '테스트페이지입니다.\r\n3\r\n5', '관리자', '2020-10-28', 0),
(193, '테스트페이지6', '테스트페이지입니다.\r\n3\r\n6', '관리자', '2020-10-28', 0),
(194, '테스트페이지7', '테스트페이지입니다.\r\n3\r\n7', '관리자', '2020-10-28', 0),
(195, '테스트페이지8', '테스트페이지입니다.\r\n3\r\n8', '관리자', '2020-10-28', 0),
(196, '테스트페이지9', '테스트페이지입니다.\r\n3\r\n9', '관리자', '2020-10-28', 0),
(197, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(198, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(199, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(200, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(201, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(202, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(203, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(204, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(205, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(206, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(207, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(208, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(209, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(210, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(211, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(212, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(213, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(214, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(215, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(216, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(217, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(218, '테스트페이지11', '테스트페이지입니다.\r\n3\r\n11', '관리자', '2020-10-28', 0),
(219, '이것은 테스트입니다.', '이것은 테스트입니다. 이것은 테스트입니다.', '관리자', '2020-10-28', 0),
(220, '테스트데이터 1', '이것은 테스1입니다.', '관리자2', '2020-10-28', 0),
(221, '테스트데이터1', '테스트데이터입니다.........', '관리자', '2020-10-28', 0),
(222, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(223, '테스트페이지2', '테스트페이지입니다.\r\n2\r\n2', '관리자', '2020-10-28', 0),
(224, '테스트페이지3', '테스트페이지입니다.\r\n3\r\n3', '관리자', '2020-10-28', 0),
(225, '테스트페이지4', '테스트페이지입니다.\r\n3\r\n4', '관리자', '2020-10-28', 0),
(226, '테스트페이지5', '테스트페이지입니다.\r\n3\r\n5', '관리자', '2020-10-28', 0),
(227, '테스트페이지6', '테스트페이지입니다.\r\n3\r\n6', '관리자', '2020-10-28', 0),
(228, '테스트페이지7', '테스트페이지입니다.\r\n3\r\n7', '관리자', '2020-10-28', 0),
(229, '테스트페이지8', '테스트페이지입니다.\r\n3\r\n8', '관리자', '2020-10-28', 0),
(230, '테스트페이지9', '테스트페이지입니다.\r\n3\r\n9', '관리자', '2020-10-28', 0),
(231, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(232, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(233, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(234, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(235, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(236, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(237, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 0),
(238, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(239, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(240, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 8),
(241, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(242, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(243, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(244, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(245, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(246, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(247, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(248, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 1),
(249, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 10),
(250, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 3),
(251, '테스트페이지10', '테스트페이지입니다.\r\n3\r\n10', '관리자', '2020-10-28', 3),
(252, '테스트페이지11', '테스트페이지입니다.\r\n3\r\n11', '관리자', '2020-10-28', 9);

-- --------------------------------------------------------

--
-- 테이블 구조 `ptp_admin`
--

CREATE TABLE IF NOT EXISTS `ptp_admin` (
  `ADMIN_SEQ` int(10) UNSIGNED NOT NULL,
  `ADMINID` varchar(25) DEFAULT NULL,
  `ADMINPW` varchar(100) DEFAULT NULL,
  `ADMINNAME` varchar(25) DEFAULT NULL,
  `PIC` varchar(100) DEFAULT NULL,
  `GRADE` char(1) DEFAULT NULL,
  `LAST_LOGIN` datetime DEFAULT NULL,
  `LOGIN_COUNT` int(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='plustheplust 홈페이지 관리자';

--
-- 테이블의 덤프 데이터 `ptp_admin`
--

INSERT INTO `ptp_admin` (`ADMIN_SEQ`, `ADMINID`, `ADMINPW`, `ADMINNAME`, `PIC`, `GRADE`, `LAST_LOGIN`, `LOGIN_COUNT`) VALUES
(112, 'admin', '*FB495FCA5055AE781916EBC6D041E7ED34942D33', '관리자', NULL, '1', NULL, 1),
(0, 'admin1', '*0262F498E91CA294A8BA96084EEEDB5F635B23A3', '관리자1', NULL, '1', NULL, NULL);

-- --------------------------------------------------------

--
-- 테이블 구조 `ptp_ir`
--

CREATE TABLE IF NOT EXISTS `ptp_ir` (
  `IR_SEQ` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IR_COMP_NAME` varchar(50) DEFAULT NULL,
  `IR_COMP_PHONE` varchar(13) DEFAULT NULL,
  `IR_COMP_EMAIL` varchar(100) DEFAULT NULL,
  `IR_COMP_CONTEXT` text DEFAULT NULL,
  `IR_COMP_DATE` datetime DEFAULT NULL,
  PRIMARY KEY (`IR_SEQ`),
  UNIQUE KEY `IR_SEQ_UNIQUE` (`IR_SEQ`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- 테이블 구조 `ptp_ir_view`
--

CREATE TABLE IF NOT EXISTS `ptp_ir_view` (
  `IR_VIEW_SEQ` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `IR_VIEW_COUNT` int(11) DEFAULT NULL,
  `IR_VIEW_DATE` date DEFAULT NULL,
  PRIMARY KEY (`IR_VIEW_SEQ`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='IR 페이지 정보';

-- --------------------------------------------------------

--
-- 테이블 구조 `qna`
--

CREATE TABLE IF NOT EXISTS `qna` (
  `num` int(8) NOT NULL AUTO_INCREMENT,
  `subject` varchar(100) DEFAULT NULL,
  `context` text DEFAULT NULL,
  `ADMINNAME` varchar(25) NOT NULL,
  `creat_date` date DEFAULT current_timestamp(),
  `count` int(8) NOT NULL DEFAULT 0,
  PRIMARY KEY (`num`),
  UNIQUE KEY `num` (`num`)
) ENGINE=InnoDB AUTO_INCREMENT=293 DEFAULT CHARSET=utf8mb4;

--
-- 테이블의 덤프 데이터 `qna`
--

INSERT INTO `qna` (`num`, `subject`, `context`, `ADMINNAME`, `creat_date`, `count`) VALUES
(253, '테스트입니다.1', '테스트를 위한 데이터 입니다.</br>1', '관리자', '2020-10-29', 0),
(254, '테스트입니다.2', '테스트를 위한 데이터 입니다.</br>2', '관리자', '2020-10-29', 0),
(255, '테스트입니다.3', '테스트를 위한 데이터 입니다.</br>3', '관리자', '2020-10-29', 0),
(256, '테스트입니다.4', '테스트를 위한 데이터 입니다.</br>4', '관리자', '2020-10-29', 0),
(257, '테스트입니다.5', '테스트를 위한 데이터 입니다.</br>5', '관리자', '2020-10-29', 0),
(258, '테스트입니다.6', '테스트를 위한 데이터 입니다.</br>6', '관리자', '2020-10-29', 0),
(259, '테스트입니다.7', '테스트를 위한 데이터 입니다.</br>7', '관리자', '2020-10-29', 0),
(260, '테스트입니다.8', '테스트를 위한 데이터 입니다.</br>8', '관리자', '2020-10-29', 0),
(261, '테스트입니다.9', '테스트를 위한 데이터 입니다.</br>9', '관리자', '2020-10-29', 0),
(262, '테스트입니다.10', '테스트를 위한 데이터 입니다.</br>10', '관리자', '2020-10-29', 0),
(263, '테스트입니다.11', '테스트를 위한 데이터 입니다.</br>11', '관리자', '2020-10-29', 0),
(264, '테스트입니다.12', '테스트를 위한 데이터 입니다.</br>12', '관리자', '2020-10-29', 0),
(265, '테스트입니다.13', '테스트를 위한 데이터 입니다.</br>13', '관리자', '2020-10-29', 0),
(266, '테스트입니다.14', '테스트를 위한 데이터 입니다.</br>14', '관리자', '2020-10-29', 0),
(267, '테스트입니다.15', '테스트를 위한 데이터 입니다.</br>15', '관리자', '2020-10-29', 0),
(268, '테스트입니다.16', '테스트를 위한 데이터 입니다.</br>16', '관리자', '2020-10-29', 0),
(269, '테스트입니다.17', '테스트를 위한 데이터 입니다.</br>17', '관리자', '2020-10-29', 0),
(270, '테스트입니다.18', '테스트를 위한 데이터 입니다.</br>18', '관리자', '2020-10-29', 0),
(271, '테스트입니다.19', '테스트를 위한 데이터 입니다.</br>19', '관리자', '2020-10-29', 0),
(272, '테스트입니다.20', '테스트를 위한 데이터 입니다.</br>20', '관리자', '2020-10-29', 1),
(273, '테스트입니다.21', '테스트를 위한 데이터 입니다.</br>21', '관리자', '2020-10-29', 1),
(274, '테스트입니다.22', '테스트를 위한 데이터 입니다.</br>22', '관리자', '2020-10-29', 1),
(275, '테스트입니다.23', '테스트를 위한 데이터 입니다.</br>23', '관리자', '2020-10-29', 1),
(276, '테스트입니다.24', '테스트를 위한 데이터 입니다.</br>24', '관리자', '2020-10-29', 1),
(277, '테스트입니다.25', '테스트를 위한 데이터 입니다.</br>25', '관리자', '2020-10-29', 1),
(278, '테스트입니다.26', '테스트를 위한 데이터 입니다.</br>26', '관리자', '2020-10-29', 1),
(279, '테스트입니다.27', '테스트를 위한 데이터 입니다.</br>27', '관리자', '2020-10-29', 1),
(280, '테스트입니다.28', '테스트를 위한 데이터 입니다.</br>28', '관리자', '2020-10-29', 0),
(281, '테스트입니다.29', '테스트를 위한 데이터 입니다.</br>29', '관리자', '2020-10-29', 0),
(282, '테스트입니다.30', '테스트를 위한 데이터 입니다.</br>30', '관리자', '2020-10-29', 0),
(283, '테스트입니다.31', '테스트를 위한 데이터 입니다.</br>31', '관리자', '2020-10-29', 0),
(284, '테스트입니다.32', '테스트를 위한 데이터 입니다.</br>32', '관리자', '2020-10-29', 0),
(285, '테스트입니다.33', '테스트를 위한 데이터 입니다.</br>33', '관리자', '2020-10-29', 0),
(286, '테스트입니다.34', '테스트를 위한 데이터 입니다.</br>34', '관리자', '2020-10-29', 0),
(287, '테스트입니다.35', '테스트를 위한 데이터 입니다.</br>35', '관리자', '2020-10-29', 0),
(288, '테스트입니다.36', '테스트를 위한 데이터 입니다.</br>36', '관리자', '2020-10-29', 0),
(289, '테스트입니다.37', '테스트를 위한 데이터 입니다.</br>37', '관리자', '2020-10-29', 0),
(290, '테스트입니다.38', '테스트를 위한 데이터 입니다.</br>38', '관리자', '2020-10-29', 0),
(291, '테스트입니다.39', '테스트를 위한 데이터 입니다.</br>39', '관리자', '2020-10-29', 2),
(292, '테스트입니다.40', '테스트를 위한 데이터 입니다.</br>40', '관리자', '2020-10-29', 1);

-- --------------------------------------------------------

--
-- 테이블 구조 `vote_answers`
--

CREATE TABLE IF NOT EXISTS `vote_answers` (
  `ANSWERS_SEQ` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `QUESTION_SEQ` int(11) DEFAULT NULL,
  `ANSWER_TEXT` varchar(250) DEFAULT NULL,
  `ANSWER_TYPE` char(1) DEFAULT NULL,
  `IS_CORRECT` char(1) DEFAULT NULL,
  `ANSWER_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `ANSWER_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`ANSWERS_SEQ`),
  KEY `IDX_ANSWER_X01` (`VOTE_SEQ`,`QUESTION_SEQ`,`ANSWER_REGI_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='투표 질문의 응답';

-- --------------------------------------------------------

--
-- 테이블 구조 `vote_form`
--

CREATE TABLE IF NOT EXISTS `vote_form` (
  `VOTE_FORM_SEQ` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `VOTE_WRITER_ID` int(10) DEFAULT NULL,
  `VOTE_FORM_KIND` char(1) DEFAULT NULL,
  `VOTE_TYPE` char(1) DEFAULT NULL,
  `VOTE_SUBJECT` varchar(200) DEFAULT NULL,
  `VOTE_CATE_SEQ` int(10) DEFAULT NULL,
  `VOTE_CATE_SUB_SEQ` int(10) DEFAULT NULL,
  `VOTE_RESOURCE_PATH` varchar(100) DEFAULT NULL,
  `VOTE_RESOURCE_TYPE` char(1) DEFAULT NULL,
  `VOTE_URL` varchar(100) DEFAULT NULL,
  `VOTE_VIEW_COUNT` int(11) DEFAULT NULL,
  `VOTE_USE_COUNT` int(11) DEFAULT NULL,
  `VOTE_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`VOTE_FORM_SEQ`),
  KEY `IDX_VOTE_FORM_X01` (`VOTE_CATE_SEQ`,`VOTE_CATE_SUB_SEQ`,`VOTE_REGI_DATE`,`VOTE_WRITER_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='투표 양식';

-- --------------------------------------------------------

--
-- 테이블 구조 `vote_questions`
--

CREATE TABLE IF NOT EXISTS `vote_questions` (
  `QUESTIONS_SEQ` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `VOTE_KIND` char(1) DEFAULT NULL,
  `VOTE_SEQ` int(11) DEFAULT NULL,
  `QUESTION_SUBJECT` varchar(250) DEFAULT NULL,
  `QUESTION_IMAGE_PATH` varchar(100) DEFAULT NULL,
  `QUESTION_RESP_TYPE` char(1) DEFAULT NULL,
  `QUESTION_REGI_DATE` datetime DEFAULT current_timestamp(),
  PRIMARY KEY (`QUESTIONS_SEQ`),
  KEY `IDX_QUESTIONS_X01` (`VOTE_SEQ`,`QUESTION_REGI_DATE`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='투표 질문 항목';
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
