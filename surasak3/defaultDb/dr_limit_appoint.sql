/*
Navicat MySQL Data Transfer

Source Server         : localhost_3306
Source Server Version : 50562
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50562
File Encoding         : 874

Date: 2020-04-14 09:09:19
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for dr_limit_appoint
-- ----------------------------
DROP TABLE IF EXISTS `dr_limit_appoint`;
CREATE TABLE `dr_limit_appoint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dr_id` varchar(255) NOT NULL,
  `dr_name` varchar(255) NOT NULL,
  `type` varchar(50) DEFAULT '0',
  `date` tinyint(4) DEFAULT NULL,
  `user_row` int(11) DEFAULT NULL,
  `date_lock` date DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `create_by` varchar(255) DEFAULT NULL,
  `edit_by` varchar(255) DEFAULT NULL,
  `dr_contact` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=84 DEFAULT CHARSET=utf8;
