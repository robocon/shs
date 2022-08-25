/*
Navicat MySQL Data Transfer

Source Server         : 192.168.131.240
Source Server Version : 50562
Source Host           : 192.168.131.240:3306
Source Database       : sm3db-utf8

Target Server Type    : MYSQL
Target Server Version : 50562
File Encoding         : 65001

Date: 2022-08-25 15:52:09
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for echo_cardio
-- ----------------------------
DROP TABLE IF EXISTS `echo_cardio`;
CREATE TABLE `echo_cardio` (
  `id` int(11) NOT NULL,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ptname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hn` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `vn` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hr` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `bp1` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `bp2` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `age` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `echo_no` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ao` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `la` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ivsd` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ivss` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lvdd` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lvds` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pwd` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pws` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `fs` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lvedv` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `lvesv` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `sv` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `co` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `ef` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `peake` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `peaka` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ea` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ms` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ms_mngrad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ms_mvapht` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ms_mva2d` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ms_mr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_pgrad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_mngrad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_ar` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `as_aipht` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ps` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ps_pgrad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ps_mngrad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ps_pr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ps_pr_pgrad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts_mngrad` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts_tvapht` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts_tva2d` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts_tr` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ts_rvsp` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cardio_finding` text COLLATE utf8_unicode_ci,
  `diag` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `doctor` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
