/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 50731
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50731
File Encoding         : 65001

Date: 2024-08-23 15:16:28
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for form_inputm
-- ----------------------------
DROP TABLE IF EXISTS `form_inputm`;
CREATE TABLE `form_inputm` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `idcard` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `department` varchar(255) NOT NULL,
  `position` varchar(255) NOT NULL,
  `perform` varchar(255) NOT NULL,
  `user` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `e_opd` varchar(255) DEFAULT NULL COMMENT 'สถานะการขอใช้ e-opd',
  `status` varchar(255) NOT NULL COMMENT 'สถานะ\r\nA:Accept\r\nR:Reject\r\nH:Hold',
  `last_update` varchar(255) DEFAULT NULL COMMENT 'วันที่อัพเดท',
  `officer` varchar(255) NOT NULL COMMENT 'ผู้ร้องขอ',
  `file` varchar(255) DEFAULT '',
  PRIMARY KEY (`id`),
  UNIQUE KEY `user` (`user`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COMMENT='ฟอร์มการร้องขอผู้ใช้งาน';
