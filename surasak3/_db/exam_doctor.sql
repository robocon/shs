/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 50731
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50731
File Encoding         : 65001

Date: 2023-10-21 09:43:38
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for exam_doctor
-- ----------------------------
DROP TABLE IF EXISTS `exam_doctor`;
CREATE TABLE `exam_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `day` text,
  `detail` varchar(255) DEFAULT NULL,
  `time_start` varchar(255) DEFAULT NULL,
  `time_end` varchar(255) DEFAULT NULL,
  `clinic` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exam_doctor
-- ----------------------------
INSERT INTO `exam_doctor` VALUES ('18', 'MD006 เลือก ด่านสว่าง', '12891', '2,4', '', '10:00', '12:00', 'อายุรกรรม');
INSERT INTO `exam_doctor` VALUES ('19', 'MD007 ณรงค์ ปรีดาอนันทสุข', '12456', '1,2,3,5', '', '10:00', '12:00', 'อายุรกรรม');
INSERT INTO `exam_doctor` VALUES ('20', 'MD036 ศุภสิทธิ์ คงมีผล', '20278', '4', 'คลินิกนอนกรน test', '13:00', '15:30', 'แพทย์ โสด คอ นาสิก');
