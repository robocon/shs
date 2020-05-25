/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50562
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50562
File Encoding         : 874

Date: 2020-05-25 13:07:12
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for default_drug
-- ----------------------------
DROP TABLE IF EXISTS `default_drug`;
CREATE TABLE `default_drug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctorcode` varchar(255) DEFAULT NULL,
  `drugcode` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `slcode` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `tradname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `drugcode` (`drugcode`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
