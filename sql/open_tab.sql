/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 80017
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 80017
File Encoding         : 65001

Date: 2024-09-12 21:38:23
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for open_tab
-- ----------------------------
DROP TABLE IF EXISTS `open_tab`;
CREATE TABLE `open_tab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `tab` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
