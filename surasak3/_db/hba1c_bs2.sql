/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 80017
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 80017
File Encoding         : 65001

Date: 2023-10-24 08:08:27
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for hba1c_bs2
-- ----------------------------
DROP TABLE IF EXISTS `hba1c_bs2`;
CREATE TABLE `hba1c_bs2` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autonumber` int(11) DEFAULT NULL,
  `labcode` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `orderdate` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `yearchk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `autonumber` (`autonumber`),
  KEY `labcode` (`labcode`),
  KEY `hn` (`hn`),
  KEY `yearchk` (`yearchk`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
