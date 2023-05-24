/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 50731
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50731
File Encoding         : 65001

Date: 2023-05-24 16:17:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dt_rechallenge
-- ----------------------------
DROP TABLE IF EXISTS `dt_rechallenge`;
CREATE TABLE `dt_rechallenge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `datehn` varchar(255) DEFAULT NULL,
  `drugcode` varchar(255) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `dt_code` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `returnstr` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`),
  KEY `doctor` (`doctor`),
  KEY `drugcode` (`drugcode`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
