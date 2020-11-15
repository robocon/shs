/*
Navicat MySQL Data Transfer

Source Server         : LocalPort80
Source Server Version : 50560
Source Host           : localhost:3306
Source Database       : tawaiprapon

Target Server Type    : MYSQL
Target Server Version : 50560
File Encoding         : 65001

Date: 2020-08-05 13:54:02
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for message
-- ----------------------------
DROP TABLE IF EXISTS `message`;
CREATE TABLE `message` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `intro` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;
