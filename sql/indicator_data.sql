/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 50731
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50731
File Encoding         : 65001

Date: 2023-06-09 15:15:34
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for indicator_data
-- ----------------------------
DROP TABLE IF EXISTS `indicator_data`;
CREATE TABLE `indicator_data` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_id` int(11) DEFAULT NULL,
  `field_id` int(11) DEFAULT NULL,
  `value` varchar(255) DEFAULT NULL,
  `year` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `date_create` varchar(255) DEFAULT NULL,
  `date_edit` varchar(255) DEFAULT NULL,
  `creater` varchar(255) DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `main_id` (`main_id`),
  KEY `field_id` (`field_id`),
  KEY `year` (`year`),
  KEY `month` (`month`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of indicator_data
-- ----------------------------
INSERT INTO `indicator_data` VALUES ('1', '1', '3', '1', '2023', '05', '2023-05-03 15:01:29', '2023-05-23 12:06:45', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('2', '1', '5', '5', '2023', '05', '2023-05-03 15:01:29', '2023-05-23 12:06:45', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('3', '1', '6', '3', '2023', '05', '2023-05-03 15:01:29', '2023-05-23 12:06:45', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('4', '1', '13', '99', '2023', '05', '2023-05-03 15:01:29', '2023-05-23 12:06:45', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('5', '1', '14', '60', '2023', '05', '2023-05-03 15:01:29', '2023-05-23 12:06:45', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('6', '1', '15', '60', '2023', '05', '2023-05-03 15:01:29', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('7', '3', '47', '99', '2023', '05', '2023-05-10 09:22:29', '2023-05-11 16:47:35', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('8', '3', '48', '99', '2023', '05', '2023-05-10 09:22:29', '2023-05-11 16:47:35', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('9', '3', '49', '99', '2023', '05', '2023-05-10 09:22:29', '2023-05-11 16:47:35', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('12', '1', '3', '11', '2023', '04', '2023-05-16 12:00:36', '2023-05-16 12:00:36', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('13', '1', '5', '11', '2023', '04', '2023-05-16 12:00:36', '2023-05-16 12:00:36', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('14', '1', '6', '11', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('15', '1', '13', '11', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('16', '1', '14', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('17', '1', '15', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('18', '1', '16', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('19', '1', '17', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('20', '1', '18', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('21', '1', '19', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('22', '1', '20', '11', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('23', '1', '21', '11', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('24', '1', '22', '11', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('25', '1', '23', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('26', '1', '24', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('27', '1', '25', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('28', '1', '26', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('29', '1', '27', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('30', '1', '28', '11', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('31', '1', '29', '11', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('32', '1', '30', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('33', '1', '31', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('34', '1', '32', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('35', '1', '33', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('36', '1', '34', '', '2023', '04', '2023-05-16 12:00:37', '2023-05-16 12:00:37', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('37', '1', '3', '11', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('38', '1', '5', '11', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('39', '1', '6', '11', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('40', '1', '13', '11', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('41', '1', '14', '11', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('42', '1', '15', '', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('43', '1', '16', '', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('44', '1', '17', '', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('45', '1', '18', '', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('46', '1', '19', '', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('47', '1', '20', '', '2023', '01', '2023-05-19 10:40:00', '2023-05-19 10:40:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('48', '1', '21', '', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('49', '1', '22', '11', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('50', '1', '23', '11', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('51', '1', '24', '11', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('52', '1', '25', '', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('53', '1', '26', '', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('54', '1', '27', '', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('55', '1', '28', '', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('56', '1', '29', '', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('57', '1', '30', '11', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('58', '1', '31', '11', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('59', '1', '32', '11', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('60', '1', '33', '', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('61', '1', '34', '', '2023', '01', '2023-05-19 10:40:01', '2023-05-19 10:40:01', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('62', '3', '48', '11', '2023', '', '2023-05-19 10:41:00', '2023-05-19 10:41:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('63', '3', '49', '22', '2023', '', '2023-05-19 10:41:00', '2023-05-19 10:41:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('64', '3', '50', '33', '2023', '', '2023-05-19 10:41:00', '2023-05-19 10:41:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('65', '3', '51', '44', '2023', '', '2023-05-19 10:41:00', '2023-05-19 10:41:00', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('66', '3', '48', '11', '2022', '', '2023-05-19 10:41:10', '2023-05-19 10:41:10', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('67', '3', '49', '22', '2022', '', '2023-05-19 10:41:10', '2023-05-19 10:41:10', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('68', '3', '50', '33', '2022', '', '2023-05-19 10:41:10', '2023-05-19 10:41:10', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('69', '3', '51', '44', '2022', '', '2023-05-19 10:41:10', '2023-05-19 10:41:10', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('70', '3', '48', '11', '2021', '', '2023-05-19 10:41:17', '2023-05-19 10:41:17', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('71', '3', '49', '22', '2021', '', '2023-05-19 10:41:17', '2023-05-19 10:41:17', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('72', '3', '50', '33', '2021', '', '2023-05-19 10:41:17', '2023-05-19 10:41:17', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('73', '3', '51', '44', '2021', '', '2023-05-19 10:41:18', '2023-05-19 10:41:18', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('74', '1', '3', '11', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('75', '1', '5', '22', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('76', '1', '6', '33', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('77', '1', '13', '44', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('78', '1', '14', '55', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('79', '1', '15', '', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('80', '1', '16', '', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('81', '1', '17', '', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('82', '1', '18', '', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('83', '1', '19', '', '2022', '01', '2023-05-22 10:26:19', '2023-05-22 10:26:19', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('84', '1', '20', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('85', '1', '21', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('86', '1', '22', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('87', '1', '23', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('88', '1', '24', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('89', '1', '25', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('90', '1', '26', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('91', '1', '27', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('92', '1', '28', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('93', '1', '29', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('94', '1', '30', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('95', '1', '31', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('96', '1', '32', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('97', '1', '33', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('98', '1', '34', '', '2022', '01', '2023-05-22 10:26:20', '2023-05-22 10:26:20', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('124', '1', '16', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('125', '1', '17', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('126', '1', '18', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('127', '1', '19', '8', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('128', '1', '20', '6', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('129', '1', '21', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('130', '1', '22', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('131', '1', '23', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('132', '1', '24', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('133', '1', '25', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('134', '1', '26', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('135', '1', '27', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('136', '1', '28', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('137', '1', '29', '', '2023', '05', '2023-05-23 11:18:42', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('138', '1', '30', '', '2023', '05', '2023-05-23 11:18:43', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('139', '1', '31', '', '2023', '05', '2023-05-23 11:18:43', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('140', '1', '32', '', '2023', '05', '2023-05-23 11:18:43', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('141', '1', '33', '', '2023', '05', '2023-05-23 11:18:43', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('142', '1', '34', '', '2023', '05', '2023-05-23 11:18:43', '2023-05-23 12:06:46', 'krit', 'krit');
INSERT INTO `indicator_data` VALUES ('143', '11', '72', '1', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('144', '11', '73', '2', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('145', '11', '74', '2', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('146', '11', '75', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('147', '11', '76', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('148', '11', '77', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('149', '11', '78', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('150', '11', '79', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('151', '11', '80', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('152', '11', '81', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('153', '11', '82', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('154', '11', '83', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('155', '11', '84', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('156', '11', '85', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('157', '11', '86', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('158', '11', '87', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('159', '11', '88', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('160', '11', '89', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('161', '11', '90', '', '2023', '04', '2023-05-26 15:22:42', '2023-05-26 15:22:42', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('162', '11', '72', '1', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('163', '11', '73', '1', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('164', '11', '74', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('165', '11', '75', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('166', '11', '76', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('167', '11', '77', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('168', '11', '78', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('169', '11', '79', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('170', '11', '80', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('171', '11', '81', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('172', '11', '82', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('173', '11', '83', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('174', '11', '84', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('175', '11', '85', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('176', '11', '86', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('177', '11', '87', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('178', '11', '88', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('179', '11', '89', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
INSERT INTO `indicator_data` VALUES ('180', '11', '90', '', '2023', '05', '2023-05-31 13:14:16', '2023-05-31 13:14:16', 'สุมีนา', 'สุมีนา');
