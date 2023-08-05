/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 50731
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50731
File Encoding         : 65001

Date: 2023-06-09 15:15:20
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for indicator_main
-- ----------------------------
DROP TABLE IF EXISTS `indicator_main`;
CREATE TABLE `indicator_main` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  `date_create` varchar(255) DEFAULT NULL,
  `date_edit` varchar(255) DEFAULT NULL,
  `creater` varchar(255) DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of indicator_main
-- ----------------------------
INSERT INTO `indicator_main` VALUES ('1', 'ตัวชี้วัดของทีม HRD', 'n', '2023-05-02 13:36:34', '2023-06-01 08:49:47', 'krit', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('2', 'Acute Coronary Syndrome', 'n', '2023-05-02 13:37:11', '2023-05-09 09:46:45', 'krit', 'krit', null, null);
INSERT INTO `indicator_main` VALUES ('3', 'ER', 'n', '2023-05-10 09:21:40', '2023-05-10 09:21:40', '', '', null, null);
INSERT INTO `indicator_main` VALUES ('9', 'ตัวชี้วัด ทีม PCT OB-Gyne', 'y', '2023-05-26 11:00:14', '2023-05-26 11:00:14', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('10', 'ตัวชี้วัด ทีม PCT Ped', 'y', '2023-05-26 11:00:43', '2023-05-26 11:00:43', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('11', 'ตัวชี้วัด ทีม PCT Med ( COPD )', 'y', '2023-05-26 11:02:33', '2023-05-26 11:13:17', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('12', 'ตัวชี้วัด ทีม PCT Med ( ACS )', 'y', '2023-05-26 11:02:51', '2023-05-26 11:18:34', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('13', 'ตัวชี้วัด ทีม PCT Med ( Sepsis )', 'y', '2023-05-26 11:03:16', '2023-05-26 11:18:56', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('14', 'ตัวชี้วัด ทีม PCT Med ( DM )', 'y', '2023-05-26 11:19:22', '2023-05-26 11:19:22', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('15', 'ตัวชี้วัด ทีม PCT Med ( ห้องไตเทียม )', 'y', '2023-05-26 11:20:24', '2023-05-26 11:20:24', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('16', 'ตัวชี้วัด ทีม PCT Med ( Acute Stroke )', 'y', '2023-05-26 11:20:47', '2023-05-26 11:20:47', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('17', 'ตัวชี้วัด ทีม PCT Med ( Heat stroke )', 'y', '2023-05-26 11:21:14', '2023-05-26 11:21:14', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('18', 'ตัวชี้วัด ทีม PCT Med ( HIV/AIDS )', 'y', '2023-05-26 11:21:49', '2023-05-26 11:21:49', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('19', 'ตัวชี้วัด ทีม PCT Med ( HT )', 'y', '2023-05-26 11:22:16', '2023-05-26 11:22:16', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('20', 'ตัวชี้วัดทีมนำโรงพยาบาล', 'y', '2023-05-26 12:35:22', '2023-05-26 12:35:22', 'สุมีนา', 'สุมีนา', null, null);
INSERT INTO `indicator_main` VALUES ('21', 'PCT Main', 'y', '2023-01-01', '2023-01-01', 'test', 'test', null, null);
