/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50731
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50731
File Encoding         : 874

Date: 2021-12-14 15:36:57
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for pt_opd_eye
-- ----------------------------
DROP TABLE IF EXISTS `pt_opd_eye`;
CREATE TABLE `pt_opd_eye` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thdatehn` varchar(255) DEFAULT NULL,
  `opd` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `antiplatelet` varchar(255) DEFAULT NULL,
  `antiplatelet_txt` varchar(255) DEFAULT NULL,
  `esr` varchar(255) DEFAULT NULL,
  `esr_ph` varchar(255) DEFAULT NULL,
  `esr_glass` varchar(255) DEFAULT NULL,
  `esr_not` varchar(255) DEFAULT NULL,
  `esl` varchar(255) DEFAULT NULL,
  `esl_ph` varchar(255) DEFAULT NULL,
  `esl_glass` varchar(255) DEFAULT NULL,
  `esl_not` varchar(255) DEFAULT NULL,
  `nurse_dx1` varchar(255) DEFAULT NULL,
  `nurse_dx1_txt` text,
  `nurse_dx2` varchar(255) DEFAULT NULL,
  `nurse_dx2_txt` text,
  `nurse_dx3` varchar(255) DEFAULT NULL,
  `nurse_dx3_txt` text,
  `nurse_dx4` varchar(255) DEFAULT NULL,
  `nurse_dx5` varchar(255) DEFAULT NULL,
  `imp1` varchar(255) DEFAULT NULL,
  `imp2` varchar(255) DEFAULT NULL,
  `imp2_txt` text,
  `imp3` varchar(255) DEFAULT NULL,
  `imp4` varchar(255) DEFAULT NULL,
  `imp5` varchar(255) DEFAULT NULL,
  `imp6` varchar(255) DEFAULT NULL,
  `imp6_txt` text,
  `eva1` varchar(255) DEFAULT NULL,
  `eva2` varchar(255) DEFAULT NULL,
  `eva3` varchar(255) DEFAULT NULL,
  `eva4` varchar(255) DEFAULT NULL,
  `eva5` varchar(255) DEFAULT NULL,
  `eva6` varchar(255) DEFAULT NULL,
  `eva7` varchar(255) DEFAULT NULL,
  `eva8` varchar(255) DEFAULT NULL,
  `eva9` varchar(255) DEFAULT NULL,
  `eva10` varchar(255) DEFAULT NULL,
  `eva10_txt` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
