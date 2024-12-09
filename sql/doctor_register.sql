/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 50731
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50731
File Encoding         : 65001

Date: 2024-08-23 15:15:48
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for doctor_register
-- ----------------------------
DROP TABLE IF EXISTS `doctor_register`;
CREATE TABLE `doctor_register` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) DEFAULT NULL,
  `idcard` varchar(13) NOT NULL,
  `prefix` varchar(20) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `prefix_doctor_number` varchar(255) NOT NULL,
  `doctor_number` varchar(20) NOT NULL,
  `depart` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `intern` varchar(10) DEFAULT NULL,
  `hem` varchar(10) DEFAULT NULL,
  `status` varchar(10) DEFAULT NULL COMMENT 'สถานะ\r\nA:Accept\r\nR:Reject\r\nH:Hold',
  `officer` varchar(255) DEFAULT NULL,
  `request_login` varchar(10) DEFAULT NULL,
  `date_generate` varchar(20) DEFAULT NULL,
  `officer_generate` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
