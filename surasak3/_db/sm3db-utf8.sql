/*
Navicat MySQL Data Transfer

Source Server         : 01-Main-192.168.131.240
Source Server Version : 50562
Source Host           : 192.168.131.240:3306
Source Database       : sm3db-utf8

Target Server Type    : MYSQL
Target Server Version : 50562
File Encoding         : 65001

Date: 2023-10-18 10:02:29
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for 43dental
-- ----------------------------
DROP TABLE IF EXISTS `43dental`;
CREATE TABLE `43dental` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SEQ` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DATE_SERV` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DENTTYPE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SERVPLACE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PTEETH` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PCARIES` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PFILLING` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PEXTRACT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DTEETH` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DCARIES` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DFILLING` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DEXTRACT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NEED_FLUORIDE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NEED_SCALING` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NEED_SEALANT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NEED_PFILLING` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NEED_DFILLING` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NEED_PEXTRACT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NEED_DEXTRACT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NPROSTHESIS` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PERMANENT_PERMANENT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PERMANENT_PROSTHESIS` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PROSTHESIS_PROSTHESIS` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `GUM` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SCHOOLTYPE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CLASS` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PROVIDER` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `D_UPDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `opday_id` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for 43epi
-- ----------------------------
DROP TABLE IF EXISTS `43epi`;
CREATE TABLE `43epi` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SEQ` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DATE_SERV` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `VACCINETYPE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `VACCINEPLACE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PROVIDER` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `D_UPDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `opday_id` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5852 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for 43fp
-- ----------------------------
DROP TABLE IF EXISTS `43fp`;
CREATE TABLE `43fp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SEQ` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DATE_SERV` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `FPTYPE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `FPPLACE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PROVIDER` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `D_UPDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `opday_id` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `CID` (`CID`),
  KEY `DATE_SERV` (`DATE_SERV`)
) ENGINE=MyISAM AUTO_INCREMENT=109 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for 43labor
-- ----------------------------
DROP TABLE IF EXISTS `43labor`;
CREATE TABLE `43labor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `GRAVIDA` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `LMP` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `EDC` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `BDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `BRESULT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `BPLACE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `BHOSP` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `BTYPE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `BDOCTOR` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `LBORN` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SBORN` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `D_UPDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ipcard_id` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ipcard_date` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM AUTO_INCREMENT=128 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for 43newborn
-- ----------------------------
DROP TABLE IF EXISTS `43newborn`;
CREATE TABLE `43newborn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) DEFAULT NULL,
  `PID` varchar(15) DEFAULT NULL,
  `MPID` varchar(15) DEFAULT NULL,
  `GRAVIDA` varchar(11) DEFAULT NULL,
  `GA` varchar(2) DEFAULT NULL,
  `BDATE` varchar(8) DEFAULT NULL,
  `BTIME` varchar(6) DEFAULT NULL,
  `BPLACE` varchar(1) DEFAULT NULL,
  `BHOSP` varchar(5) DEFAULT NULL,
  `BIRTHNO` varchar(1) DEFAULT NULL,
  `BTYPE` varchar(1) DEFAULT NULL,
  `BDOCTOR` varchar(1) DEFAULT NULL,
  `BWEIGHT` varchar(4) DEFAULT NULL,
  `ASPHYXIA` varchar(2) DEFAULT NULL,
  `VITK` varchar(1) DEFAULT NULL,
  `TSH` varchar(1) DEFAULT NULL,
  `TSHRESULT` varchar(5) DEFAULT NULL,
  `D_UPDATE` varchar(14) DEFAULT NULL,
  `CID` varchar(13) DEFAULT NULL,
  `date_visit` datetime DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `an` varchar(50) DEFAULT NULL,
  `latest_edit` datetime DEFAULT NULL,
  `gyn_id` int(11) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `LENGTH` varchar(5) DEFAULT NULL,
  `HEADCIRCUM` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `MPID` (`MPID`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM AUTO_INCREMENT=303 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for 43newborncare
-- ----------------------------
DROP TABLE IF EXISTS `43newborncare`;
CREATE TABLE `43newborncare` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) DEFAULT NULL,
  `PID` varchar(15) DEFAULT NULL,
  `SEQ` varchar(16) DEFAULT NULL,
  `BDATE` varchar(8) DEFAULT NULL,
  `BCARE` varchar(8) DEFAULT NULL,
  `BCPLACE` varchar(5) DEFAULT NULL,
  `BCARERESULT` varchar(1) DEFAULT NULL,
  `FOOD` varchar(1) DEFAULT NULL,
  `PROVIDER` varchar(15) DEFAULT NULL,
  `D_UPDATE` varchar(14) DEFAULT NULL,
  `CID` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM AUTO_INCREMENT=304 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for 43nutrition
-- ----------------------------
DROP TABLE IF EXISTS `43nutrition`;
CREATE TABLE `43nutrition` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SEQ` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `DATE_SERV` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NUTRITIONPLACE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `WEIGHT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `HEIGHT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `HEADCIRCUM` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CHILDDEVELOP` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `FOOD` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `BOTTLE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PROVIDER` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `D_UPDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `opday_id` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=757 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for 43policy
-- ----------------------------
DROP TABLE IF EXISTS `43policy`;
CREATE TABLE `43policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `policy_id` varchar(3) DEFAULT NULL,
  `policy_year` text,
  `policy_data` text,
  `d_update` varchar(14) DEFAULT NULL,
  `opday_id` varchar(50) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=340 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for 43postnatal
-- ----------------------------
DROP TABLE IF EXISTS `43postnatal`;
CREATE TABLE `43postnatal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `SEQ` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `GRAVIDA` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `BDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PPCARE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PPPLACE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PPRESULT` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PROVIDER` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `D_UPDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `opday_id` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM AUTO_INCREMENT=118 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for 43prenatal
-- ----------------------------
DROP TABLE IF EXISTS `43prenatal`;
CREATE TABLE `43prenatal` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `PID` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `GRAVIDA` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `LMP` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `EDC` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `VDRL_RESULT` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `HB_RESULT` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `HIV_RESULT` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `DATE_HCT` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `HCT_RESULT` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `THALASSEMIA` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `D_UPDATE` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `PROVIDER` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `HEIGHT` float DEFAULT NULL,
  `opday_id` varchar(255) COLLATE utf8_bin DEFAULT NULL,
  `date_serv` varchar(8) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for 43women
-- ----------------------------
DROP TABLE IF EXISTS `43women`;
CREATE TABLE `43women` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `PID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `FPTYPE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NOFPCAUSE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `TOTALSON` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `NUMBERSON` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `ABORTION` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `STILLBIRTH` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `D_UPDATE` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `CID` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `CID` (`CID`)
) ENGINE=MyISAM AUTO_INCREMENT=113 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- ----------------------------
-- Table structure for accident
-- ----------------------------
DROP TABLE IF EXISTS `accident`;
CREATE TABLE `accident` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) DEFAULT NULL,
  `PID` varchar(15) DEFAULT NULL,
  `SEQ` varchar(16) DEFAULT NULL,
  `DATETIME_SERV` varchar(14) DEFAULT NULL,
  `DATETIME_AE` varchar(14) DEFAULT NULL,
  `AETYPE` varchar(2) DEFAULT NULL,
  `AEPLACE` varchar(2) DEFAULT NULL,
  `TYPEIN_AE` varchar(1) DEFAULT NULL,
  `TRAFFIC` varchar(1) DEFAULT NULL,
  `VEHICLE` varchar(2) DEFAULT NULL,
  `ALCOHOL` varchar(1) DEFAULT NULL,
  `NACROTIC_DRUG` varchar(1) DEFAULT NULL,
  `BELT` varchar(1) DEFAULT NULL,
  `HELMET` varchar(1) DEFAULT NULL,
  `AIRWAY` varchar(1) DEFAULT NULL,
  `STOPBLEED` varchar(1) DEFAULT NULL,
  `SPLINT` varchar(1) DEFAULT NULL,
  `FLUID` int(1) DEFAULT NULL,
  `URGENCY` varchar(1) DEFAULT NULL,
  `COMA_EYE` varchar(1) DEFAULT NULL,
  `COMA_SPEAK` varchar(1) DEFAULT NULL,
  `COMA_MOVEMENT` varchar(1) DEFAULT NULL,
  `D_UPDATE` varchar(14) DEFAULT NULL,
  `CID` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=71875 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for accidents
-- ----------------------------
DROP TABLE IF EXISTS `accidents`;
CREATE TABLE `accidents` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for accrued
-- ----------------------------
DROP TABLE IF EXISTS `accrued`;
CREATE TABLE `accrued` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `txdate` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `detail` varchar(40) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `vn` varchar(4) DEFAULT NULL,
  `status_pay` varchar(20) NOT NULL,
  `billno` varchar(20) NOT NULL,
  `detail_acc` varchar(100) NOT NULL,
  `officer` varchar(50) NOT NULL,
  `pay_date` varchar(20) NOT NULL,
  `money_trust` double(12,2) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `inxdate` (`date`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=21693 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for accrued_pt
-- ----------------------------
DROP TABLE IF EXISTS `accrued_pt`;
CREATE TABLE `accrued_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `txdate` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `detail` varchar(40) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `vn` varchar(4) DEFAULT NULL,
  `status_pay` varchar(20) NOT NULL,
  `billno` varchar(20) NOT NULL,
  `detail_acc` varchar(100) NOT NULL,
  `officer` varchar(50) NOT NULL,
  `pay_date` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `inxdate` (`date`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for admit
-- ----------------------------
DROP TABLE IF EXISTS `admit`;
CREATE TABLE `admit` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `name` varchar(30) NOT NULL,
  `surname` varchar(30) NOT NULL,
  `age` varchar(20) DEFAULT NULL,
  `ptright` varchar(30) NOT NULL,
  `type` varchar(20) NOT NULL,
  `clinic` varchar(20) NOT NULL,
  `room` varchar(20) NOT NULL,
  `doctor` varchar(50) DEFAULT NULL,
  `comment` varchar(80) NOT NULL,
  `D_UPDATE` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for allergic_list
-- ----------------------------
DROP TABLE IF EXISTS `allergic_list`;
CREATE TABLE `allergic_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_code` varchar(50) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `author_edit` varchar(255) DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `drug_code` (`drug_code`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for amphur_new
-- ----------------------------
DROP TABLE IF EXISTS `amphur_new`;
CREATE TABLE `amphur_new` (
  `AMPHUR_ID` int(5) NOT NULL AUTO_INCREMENT,
  `AMPHUR_CODE` varchar(4) DEFAULT NULL,
  `AMPHUR_NAME` varchar(150) DEFAULT NULL,
  `GEO_ID` int(5) DEFAULT '0',
  `PROVINCE_ID` int(5) DEFAULT '0',
  PRIMARY KEY (`AMPHUR_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=999 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for amphurs
-- ----------------------------
DROP TABLE IF EXISTS `amphurs`;
CREATE TABLE `amphurs` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `geo_id` int(5) NOT NULL DEFAULT '0',
  `province_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=999 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for anc
-- ----------------------------
DROP TABLE IF EXISTS `anc`;
CREATE TABLE `anc` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(10) DEFAULT NULL,
  `seq` varchar(16) DEFAULT NULL,
  `date_serv` varchar(8) DEFAULT NULL,
  `gravida` varchar(2) DEFAULT NULL,
  `ancno` varchar(1) DEFAULT NULL,
  `ga` varchar(3) DEFAULT NULL,
  `ancres` varchar(1) DEFAULT NULL,
  `aplace` varchar(5) DEFAULT NULL,
  `provider` varchar(15) DEFAULT NULL,
  `d_update` varchar(14) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `height` float DEFAULT NULL,
  `opday_id` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=297 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for api_authen
-- ----------------------------
DROP TABLE IF EXISTS `api_authen`;
CREATE TABLE `api_authen` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pid` varchar(255) DEFAULT NULL,
  `claimType` varchar(255) DEFAULT NULL,
  `correlationId` varchar(255) DEFAULT NULL,
  `createdDate` varchar(255) DEFAULT NULL,
  `claimCode` varchar(255) DEFAULT NULL,
  `officer` varchar(255) DEFAULT NULL,
  `dateIdcard` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `hcode` varchar(255) DEFAULT NULL,
  `mobile` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pid` (`pid`),
  KEY `dateIdcard` (`dateIdcard`),
  KEY `hn` (`hn`)
) ENGINE=InnoDB AUTO_INCREMENT=8705 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for applist
-- ----------------------------
DROP TABLE IF EXISTS `applist`;
CREATE TABLE `applist` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `appvalue` varchar(200) NOT NULL,
  `applist` varchar(200) NOT NULL,
  `status` varchar(2) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for appoint
-- ----------------------------
DROP TABLE IF EXISTS `appoint`;
CREATE TABLE `appoint` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `officer` varchar(32) DEFAULT NULL,
  `hn` varchar(12) NOT NULL DEFAULT '',
  `ptname` varchar(40) DEFAULT NULL,
  `age` varchar(24) DEFAULT NULL,
  `doctor` varchar(50) DEFAULT NULL,
  `appdate` varchar(20) DEFAULT NULL,
  `apptime` varchar(20) DEFAULT NULL,
  `room` varchar(50) DEFAULT NULL,
  `detail` varchar(40) DEFAULT NULL,
  `detail2` varchar(255) DEFAULT NULL,
  `advice` varchar(255) DEFAULT NULL,
  `patho` varchar(255) DEFAULT NULL,
  `xray` varchar(40) DEFAULT NULL,
  `other` varchar(40) DEFAULT NULL,
  `depcode` varchar(32) DEFAULT NULL,
  `came` char(1) DEFAULT 'N',
  `diag` varchar(80) DEFAULT NULL,
  `remark` varchar(80) DEFAULT NULL,
  `labextra` varchar(200) DEFAULT NULL,
  `injno` varchar(20) NOT NULL,
  `detail_etc` text,
  `appdate_en` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `appdate` (`appdate`),
  KEY `apptime` (`apptime`),
  KEY `doctor` (`doctor`),
  KEY `other` (`other`),
  KEY `hn` (`hn`),
  KEY `appdate_en` (`appdate_en`)
) ENGINE=MyISAM AUTO_INCREMENT=2003880 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for appoint_lab
-- ----------------------------
DROP TABLE IF EXISTS `appoint_lab`;
CREATE TABLE `appoint_lab` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `id` int(11) NOT NULL DEFAULT '0',
  `code` varchar(10) NOT NULL DEFAULT '',
  PRIMARY KEY (`row_id`),
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2402281 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for army_8q9q
-- ----------------------------
DROP TABLE IF EXISTS `army_8q9q`;
CREATE TABLE `army_8q9q` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ptname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `camp` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `yearchkup` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `ph9q_result` int(6) DEFAULT NULL,
  `ph9q` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `ph8q_result` int(6) NOT NULL,
  `ph8q` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1279 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for armychkup
-- ----------------------------
DROP TABLE IF EXISTS `armychkup`;
CREATE TABLE `armychkup` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `registerdate` datetime NOT NULL,
  `hn` varchar(10) NOT NULL,
  `yot` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `idcard` varchar(13) DEFAULT NULL,
  `chunyot` varchar(50) NOT NULL,
  `camp` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `ratchakarn` varchar(50) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `birthday` date NOT NULL,
  `age` int(3) NOT NULL,
  `dxptright` varchar(1) NOT NULL,
  `hospitalcongenital_disease` varchar(100) NOT NULL,
  `hospitaldrugreact` varchar(50) NOT NULL,
  `weight` float NOT NULL,
  `height` float DEFAULT NULL,
  `bmi` float NOT NULL,
  `waist` float NOT NULL,
  `temperature` float NOT NULL,
  `pulse` int(4) NOT NULL,
  `rate` int(4) NOT NULL,
  `bp1` varchar(7) NOT NULL,
  `bp2` varchar(7) NOT NULL,
  `prawat` varchar(1) NOT NULL,
  `prawat_ht` varchar(1) NOT NULL,
  `prawat_dm` varchar(1) NOT NULL,
  `prawat_cad` varchar(1) NOT NULL,
  `prawat_dlp` varchar(1) NOT NULL,
  `congenital_disease` varchar(50) NOT NULL,
  `hospital` varchar(50) NOT NULL,
  `diagtype` varchar(20) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `exercise` varchar(1) NOT NULL,
  `bmr` float DEFAULT NULL,
  `tbw` float NOT NULL,
  `fat` float NOT NULL,
  `fat_mass` float NOT NULL,
  `visceral_fat` float NOT NULL,
  `muscle_mass` float NOT NULL,
  `vfa_level` float NOT NULL,
  `result_fat` varchar(1) NOT NULL,
  `hand1` float NOT NULL,
  `hand2` float DEFAULT NULL,
  `result_hand` varchar(1) NOT NULL,
  `leg1` float NOT NULL,
  `leg2` float DEFAULT NULL,
  `result_leg` varchar(1) NOT NULL,
  `steptest1` float DEFAULT NULL,
  `steptest2` float DEFAULT NULL,
  `steptest3` float DEFAULT NULL,
  `result_steptest` varchar(1) NOT NULL,
  `pressure_test` float NOT NULL,
  `pressure_result` varchar(10) NOT NULL,
  `situp_test` float NOT NULL,
  `situp_result` varchar(10) NOT NULL,
  `run_test` float NOT NULL,
  `run_result` varchar(10) NOT NULL,
  `xray` varchar(20) DEFAULT NULL,
  `xray_detail` varchar(100) NOT NULL,
  `result_dental` varchar(10) DEFAULT NULL,
  `dental_disease1` varchar(1) NOT NULL,
  `dental_disease2` varchar(1) NOT NULL,
  `dental_disease3` varchar(1) NOT NULL,
  `gum_disease1` varchar(1) NOT NULL,
  `gum_disease2` varchar(1) NOT NULL,
  `ua_lab` varchar(10) DEFAULT NULL,
  `cbc_lab` varchar(10) DEFAULT NULL,
  `glu_result` float NOT NULL,
  `glu_flag` varchar(1) NOT NULL,
  `glu_lab` varchar(10) NOT NULL,
  `chol_result` float NOT NULL,
  `chol_flag` varchar(1) NOT NULL,
  `chol_lab` varchar(10) NOT NULL,
  `trig_result` float NOT NULL,
  `trig_flag` varchar(1) NOT NULL,
  `trig_lab` varchar(10) NOT NULL,
  `hdl_result` float NOT NULL,
  `hdl_flag` varchar(1) NOT NULL,
  `hdl_lab` varchar(10) NOT NULL,
  `ldl_result` float NOT NULL,
  `ldl_flag` varchar(1) NOT NULL,
  `ldl_lab` varchar(10) NOT NULL,
  `bun_result` float NOT NULL,
  `bun_flag` varchar(1) NOT NULL,
  `bun_lab` varchar(10) NOT NULL,
  `crea_result` float NOT NULL,
  `crea_flag` varchar(1) NOT NULL,
  `crea_lab` varchar(10) NOT NULL,
  `alp_result` float NOT NULL,
  `alp_flag` varchar(1) NOT NULL,
  `alp_lab` varchar(10) NOT NULL,
  `alt_result` float NOT NULL,
  `alt_flag` varchar(1) NOT NULL,
  `alt_lab` varchar(10) NOT NULL,
  `ast_result` float NOT NULL,
  `ast_flag` varchar(1) NOT NULL,
  `ast_lab` varchar(10) NOT NULL,
  `uric_result` float NOT NULL,
  `uric_flag` varchar(1) NOT NULL,
  `uric_lab` varchar(10) NOT NULL,
  `health_risk` varchar(10) NOT NULL,
  `accident_risk` varchar(10) NOT NULL,
  `addictive_risk` varchar(10) NOT NULL,
  `score_stress` int(3) DEFAULT NULL,
  `result_stress` varchar(20) DEFAULT NULL,
  `diabetes_risk` varchar(10) NOT NULL,
  `kidney_risk` varchar(10) NOT NULL,
  `tb_risk` varchar(10) NOT NULL,
  `heart_risk` varchar(10) NOT NULL,
  `cancer_risk` varchar(10) NOT NULL,
  `hiv_risk` varchar(10) NOT NULL,
  `liver_risk` varchar(10) NOT NULL,
  `stroke_risk` varchar(10) NOT NULL,
  `gout_risk` varchar(10) NOT NULL,
  `knee_risk` varchar(10) NOT NULL,
  `bone_risk` varchar(10) NOT NULL,
  `resultdiag_normal` varchar(1) NOT NULL,
  `resultdiag_risk` varchar(1) NOT NULL,
  `risk_dm` varchar(1) NOT NULL,
  `risk_ht` varchar(1) NOT NULL,
  `risk_dlp` varchar(1) NOT NULL,
  `risk_stroke` varchar(1) NOT NULL,
  `risk_obesity` varchar(1) NOT NULL,
  `resultdiag_diseases` varchar(1) NOT NULL,
  `diseases_dm` varchar(1) NOT NULL,
  `diseases_ht` varchar(1) NOT NULL,
  `diseases_dlp` varchar(1) NOT NULL,
  `diseases_stroke` varchar(1) NOT NULL,
  `diseases_obesity` varchar(1) NOT NULL,
  `register_officer` varchar(50) DEFAULT NULL,
  `lastupdate` datetime NOT NULL,
  `lastupdate_officer` varchar(50) NOT NULL,
  `yearchkup` varchar(2) DEFAULT NULL,
  `status_print` int(3) DEFAULT NULL,
  `typechkup` varchar(10) NOT NULL,
  `level_dental` varchar(10) DEFAULT NULL,
  `other_disease1` varchar(1) NOT NULL,
  `other_disease2` varchar(1) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2513 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for audit-sso
-- ----------------------------
DROP TABLE IF EXISTS `audit-sso`;
CREATE TABLE `audit-sso` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `no` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `idcard` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `ptname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hn` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=197 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for bacteria_resistant
-- ----------------------------
DROP TABLE IF EXISTS `bacteria_resistant`;
CREATE TABLE `bacteria_resistant` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `Pt_Name` varchar(100) NOT NULL,
  `Ward` varchar(50) NOT NULL,
  `Date_Send` varchar(10) NOT NULL,
  `Company_Name` varchar(100) NOT NULL,
  `Bacteria_Name` varchar(100) NOT NULL,
  `Bacteria_Source` varchar(100) NOT NULL,
  `Drug_Name` varchar(50) NOT NULL,
  `Officer_Name` varchar(50) NOT NULL,
  `Last_Update` varchar(50) NOT NULL,
  `Flag_Use` varchar(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COMMENT='สถิติเชื้อดื้อยา';

-- ----------------------------
-- Table structure for bed
-- ----------------------------
DROP TABLE IF EXISTS `bed`;
CREATE TABLE `bed` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `bed` varchar(11) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `age` varchar(24) DEFAULT NULL,
  `idcard` varchar(16) DEFAULT NULL,
  `address` varchar(50) DEFAULT NULL,
  `muang` varchar(100) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `doctor` varchar(48) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `diagnos` varchar(48) DEFAULT NULL,
  `bedcode` varchar(10) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `debt` double(12,2) DEFAULT NULL,
  `caldate` varchar(30) DEFAULT NULL,
  `food` varchar(250) DEFAULT NULL,
  `officer` varchar(32) DEFAULT NULL,
  `chgdate` varchar(30) DEFAULT NULL,
  `bedname` varchar(40) DEFAULT NULL,
  `bedpri` double(8,2) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `ajrw` varchar(20) DEFAULT NULL,
  `diag1` varchar(50) DEFAULT NULL,
  `last_drug` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `chgwdate` varchar(30) DEFAULT NULL,
  `status_detail` varchar(30) DEFAULT NULL,
  `lastcalroom` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `days` int(11) NOT NULL,
  `c19status` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `bedcode` (`bedcode`)
) ENGINE=MyISAM AUTO_INCREMENT=463 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for bed_copy
-- ----------------------------
DROP TABLE IF EXISTS `bed_copy`;
CREATE TABLE `bed_copy` (
  `row_id` int(11) DEFAULT NULL,
  `bed` varchar(8) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `age` varchar(24) DEFAULT NULL,
  `idcard` varchar(16) DEFAULT NULL,
  `address` varchar(40) DEFAULT NULL,
  `muang` varchar(32) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `doctor` varchar(48) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `diagnos` varchar(48) DEFAULT NULL,
  `bedcode` varchar(10) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `debt` double(12,2) DEFAULT NULL,
  `caldate` varchar(30) DEFAULT NULL,
  `food` varchar(250) DEFAULT NULL,
  `officer` varchar(32) DEFAULT NULL,
  `chgdate` varchar(30) DEFAULT NULL,
  `bedname` varchar(40) DEFAULT NULL,
  `bedpri` double(8,2) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `status` varchar(25) DEFAULT NULL,
  `ajrw` varchar(20) DEFAULT NULL,
  `diag1` varchar(50) DEFAULT NULL,
  `last_drug` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `chgwdate` varchar(30) DEFAULT NULL,
  `status_detail` varchar(30) DEFAULT NULL,
  `lastcalroom` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `days` int(11) NOT NULL,
  `c19status` varchar(5) DEFAULT NULL,
  KEY `bedcode` (`bedcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for billtran
-- ----------------------------
DROP TABLE IF EXISTS `billtran`;
CREATE TABLE `billtran` (
  `station` varchar(4) CHARACTER SET utf8 NOT NULL,
  `authcode` varchar(7) CHARACTER SET utf8 NOT NULL,
  `dttran` varchar(19) CHARACTER SET utf8 NOT NULL,
  `hcode` varchar(5) CHARACTER SET utf8 NOT NULL,
  `invno` varchar(50) CHARACTER SET utf8 NOT NULL,
  `billno` varchar(50) CHARACTER SET utf8 NOT NULL,
  `hn` varchar(20) CHARACTER SET utf8 NOT NULL,
  `memberno` varchar(20) CHARACTER SET utf8 NOT NULL,
  `amount` double(10,2) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `vercode` varchar(20) CHARACTER SET utf8 NOT NULL,
  `tflag` varchar(1) CHARACTER SET utf8 NOT NULL,
  `pid` varchar(13) CHARACTER SET utf8 NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `hmain` varchar(5) CHARACTER SET utf8 NOT NULL,
  `payplan` varchar(20) CHARACTER SET utf8 NOT NULL,
  `claimamount` double(10,2) NOT NULL,
  `otherpayplan` varchar(20) CHARACTER SET utf8 NOT NULL,
  `otherpay` varchar(20) CHARACTER SET utf8 NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for billtranx
-- ----------------------------
DROP TABLE IF EXISTS `billtranx`;
CREATE TABLE `billtranx` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `officer` char(32) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`)
) ENGINE=MyISAM AUTO_INCREMENT=58566 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for bloodgroup
-- ----------------------------
DROP TABLE IF EXISTS `bloodgroup`;
CREATE TABLE `bloodgroup` (
  `code` int(2) unsigned zerofill NOT NULL DEFAULT '00',
  `detail` varchar(50) NOT NULL,
  `detail2` varchar(100) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for booking
-- ----------------------------
DROP TABLE IF EXISTS `booking`;
CREATE TABLE `booking` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `bdate` varchar(30) NOT NULL,
  `age` varchar(50) NOT NULL,
  `diag` varchar(100) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `bed` varchar(50) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `date_in` varchar(50) NOT NULL,
  `booking_name` varchar(100) NOT NULL,
  `booking_office` varchar(100) NOT NULL,
  `date_booking` varchar(50) NOT NULL,
  `date_regis` varchar(50) NOT NULL,
  `status` varchar(10) NOT NULL,
  `comment` text NOT NULL,
  `officer_con` varchar(100) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11017 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for borrowan
-- ----------------------------
DROP TABLE IF EXISTS `borrowan`;
CREATE TABLE `borrowan` (
  `borrowAN_year` varchar(2) NOT NULL DEFAULT '',
  `borrowAN_id` int(5) NOT NULL DEFAULT '0',
  `HN` varchar(20) NOT NULL DEFAULT '',
  `AN` varchar(20) NOT NULL DEFAULT '',
  `borrower` varchar(200) NOT NULL DEFAULT '',
  `receiver` varchar(200) DEFAULT NULL,
  `borrowAN_startdate` varchar(30) DEFAULT '0000-00-00',
  `borrowAN_enddate` varchar(30) DEFAULT '0000-00-00',
  `idname` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`borrowAN_id`,`borrowAN_year`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for botdata
-- ----------------------------
DROP TABLE IF EXISTS `botdata`;
CREATE TABLE `botdata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `emp_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `emp_ptname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_idcard` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `emp_status` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `emp_position` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15141 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for bring
-- ----------------------------
DROP TABLE IF EXISTS `bring`;
CREATE TABLE `bring` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `bring_no` varchar(10) NOT NULL,
  `bring_date` varchar(30) DEFAULT NULL,
  `office` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `bring_no` (`bring_no`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for bring_detail
-- ----------------------------
DROP TABLE IF EXISTS `bring_detail`;
CREATE TABLE `bring_detail` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `bring_id` int(5) NOT NULL,
  `drugcode` varchar(15) NOT NULL,
  `bring_amount` int(2) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for browser_log
-- ----------------------------
DROP TABLE IF EXISTS `browser_log`;
CREATE TABLE `browser_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `client` varchar(255) NOT NULL,
  `login_time` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for c19_count
-- ----------------------------
DROP TABLE IF EXISTS `c19_count`;
CREATE TABLE `c19_count` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `hn` varchar(50) DEFAULT NULL,
  `vn` int(11) DEFAULT NULL,
  `opd_queue` varchar(50) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `idcard` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`),
  KEY `idcard` (`idcard`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=2754 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for c19_patients
-- ----------------------------
DROP TABLE IF EXISTS `c19_patients`;
CREATE TABLE `c19_patients` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `staff` varchar(255) DEFAULT NULL,
  `vaccine_name` varchar(255) DEFAULT NULL,
  `barcode_no` varchar(255) NOT NULL,
  `lot_no` varchar(255) DEFAULT NULL,
  `serial_no` varchar(255) DEFAULT NULL,
  `vaccine_plant_no` int(11) DEFAULT NULL,
  `toborow` varchar(255) DEFAULT NULL,
  `countdown_c19` datetime DEFAULT NULL,
  `staff_edit` varchar(255) DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `bottle_no` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5390 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for camp
-- ----------------------------
DROP TABLE IF EXISTS `camp`;
CREATE TABLE `camp` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `reportpst` varchar(1) NOT NULL,
  `date_lab` date NOT NULL,
  `date_doctor` date NOT NULL,
  `officer` varchar(100) NOT NULL,
  `datekey` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for cancer
-- ----------------------------
DROP TABLE IF EXISTS `cancer`;
CREATE TABLE `cancer` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(40) NOT NULL,
  `hn` varchar(20) DEFAULT NULL,
  `id` varchar(20) DEFAULT NULL,
  `doctor_date` varchar(40) NOT NULL,
  `date_diag` varchar(30) DEFAULT NULL,
  `lab_name` varchar(30) DEFAULT NULL,
  `lab_no` varchar(30) DEFAULT NULL,
  `diag_type` varchar(30) DEFAULT NULL,
  `position` longtext,
  `lab_detail` longtext,
  `stage` varchar(20) DEFAULT NULL,
  `a` varchar(30) DEFAULT NULL,
  `b` varchar(30) DEFAULT NULL,
  `t` varchar(50) NOT NULL,
  `n` varchar(50) NOT NULL,
  `m` varchar(50) NOT NULL,
  `grade` varchar(50) NOT NULL,
  `side` varchar(50) NOT NULL,
  `cure_surgery` varchar(10) NOT NULL,
  `date1` varchar(40) NOT NULL,
  `cure_radiation` varchar(10) NOT NULL,
  `date2` varchar(40) NOT NULL,
  `cure_chemotherapy` varchar(10) NOT NULL,
  `date3` varchar(40) NOT NULL,
  `cure_targeted` varchar(40) NOT NULL,
  `date4` varchar(40) NOT NULL,
  `cure_hormone` varchar(10) NOT NULL,
  `date5` varchar(40) NOT NULL,
  `cure_immuno` varchar(10) NOT NULL,
  `date6` varchar(40) NOT NULL,
  `cure_intervention` varchar(20) NOT NULL,
  `date7` varchar(40) NOT NULL,
  `cure_other` varchar(10) NOT NULL,
  `date8` varchar(40) NOT NULL,
  `cure_support` varchar(10) NOT NULL,
  `date9` varchar(40) NOT NULL,
  `status` varchar(20) DEFAULT NULL,
  `last_update` varchar(30) DEFAULT NULL,
  `dead` varchar(30) DEFAULT NULL,
  `diag_type1` varchar(50) NOT NULL,
  `diag_type2` varchar(50) NOT NULL,
  `diag_type3` varchar(50) NOT NULL,
  `diag_type4` varchar(50) NOT NULL,
  `diag_type5` varchar(50) NOT NULL,
  `diag_type6` varchar(50) NOT NULL,
  `diag_type7` varchar(50) NOT NULL,
  `diag_type8` varchar(50) NOT NULL,
  `diag_type9` varchar(50) NOT NULL,
  `register_date` varchar(40) NOT NULL,
  `officer` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=825 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for certificate
-- ----------------------------
DROP TABLE IF EXISTS `certificate`;
CREATE TABLE `certificate` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `bookid` varchar(20) DEFAULT NULL,
  `noid` varchar(20) DEFAULT NULL,
  `hn` varchar(50) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `diag` text,
  `doctor` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `thaidate` varchar(40) NOT NULL,
  `regisdate` varchar(40) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45935 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for certificate_number
-- ----------------------------
DROP TABLE IF EXISTS `certificate_number`;
CREATE TABLE `certificate_number` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(50) NOT NULL,
  `an` varchar(50) NOT NULL,
  `no1` varchar(50) NOT NULL,
  `no2` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45215 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chart
-- ----------------------------
DROP TABLE IF EXISTS `chart`;
CREATE TABLE `chart` (
  `id` int(11) NOT NULL,
  `province` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `men` int(11) NOT NULL,
  `wemen` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chk_chest
-- ----------------------------
DROP TABLE IF EXISTS `chk_chest`;
CREATE TABLE `chk_chest` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `FVC` varchar(5) NOT NULL,
  `FEV` varchar(5) NOT NULL,
  `FFV` varchar(5) DEFAULT NULL,
  `reason` varchar(100) NOT NULL,
  `yearchk` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for chk_company_list
-- ----------------------------
DROP TABLE IF EXISTS `chk_company_list`;
CREATE TABLE `chk_company_list` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `code` varchar(255) DEFAULT NULL,
  `date_checkup` varchar(255) DEFAULT NULL,
  `yearchk` varchar(255) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `report` varchar(255) DEFAULT NULL,
  `report_all` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=396 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chk_cxr
-- ----------------------------
DROP TABLE IF EXISTS `chk_cxr`;
CREATE TABLE `chk_cxr` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `cxr` varchar(255) DEFAULT NULL,
  `detail` text,
  `officer` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `edit_date` datetime DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `year_chk` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3712 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chk_doctor
-- ----------------------------
DROP TABLE IF EXISTS `chk_doctor`;
CREATE TABLE `chk_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(255) DEFAULT NULL,
  `vn` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `surname` varchar(255) DEFAULT NULL,
  `idcard` varchar(255) DEFAULT NULL,
  `address` text,
  `date_chk` datetime DEFAULT NULL,
  `yearchk` varchar(255) DEFAULT NULL,
  `ear` varchar(255) DEFAULT '0',
  `breast` varchar(255) DEFAULT '0',
  `eye` varchar(255) DEFAULT '0',
  `snell_eye` varchar(255) DEFAULT '0',
  `cxr` varchar(255) DEFAULT '0',
  `conclution` varchar(255) DEFAULT '0',
  `normal_suggest` varchar(255) DEFAULT '0',
  `normal_suggest_date` date DEFAULT '0000-00-00',
  `abnormal_suggest` varchar(255) DEFAULT '0',
  `abnormal_suggest_date` date DEFAULT '0000-00-00',
  `doctor` varchar(255) DEFAULT NULL,
  `officer` varchar(255) DEFAULT NULL,
  `res_cbc` tinyint(2) DEFAULT '0',
  `res_ua` tinyint(2) DEFAULT '0',
  `res_glu` tinyint(2) DEFAULT '0',
  `res_crea` tinyint(2) DEFAULT '0',
  `res_chol` tinyint(2) DEFAULT '0',
  `res_hdl` tinyint(2) DEFAULT '0',
  `res_hbsag` tinyint(2) DEFAULT '0',
  `res_occult` tinyint(4) NOT NULL DEFAULT '0',
  `diag` text,
  `cxr_detail` text NOT NULL,
  `dxofyear_out_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7213 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chk_eye
-- ----------------------------
DROP TABLE IF EXISTS `chk_eye`;
CREATE TABLE `chk_eye` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) DEFAULT NULL,
  `stat_eye` varchar(100) NOT NULL,
  `yearchk` varchar(5) NOT NULL,
  `eye1_ext` text NOT NULL,
  `eye2_ext` text NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=866 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chk_hb
-- ----------------------------
DROP TABLE IF EXISTS `chk_hb`;
CREATE TABLE `chk_hb` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `hbsag` varchar(100) NOT NULL,
  `hbsab` varchar(100) NOT NULL,
  `hbcab` varchar(100) NOT NULL,
  `leadlevel` varchar(5) NOT NULL,
  `yearchk` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for chk_hear
-- ----------------------------
DROP TABLE IF EXISTS `chk_hear`;
CREATE TABLE `chk_hear` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `hear500R` varchar(5) NOT NULL,
  `hear500L` varchar(5) NOT NULL,
  `hear1000R` varchar(5) NOT NULL,
  `hear1000L` varchar(5) NOT NULL,
  `hear2000R` varchar(5) NOT NULL,
  `hear2000L` varchar(5) NOT NULL,
  `hear3000R` varchar(5) NOT NULL,
  `hear3000L` varchar(5) NOT NULL,
  `hear4000R` varchar(5) NOT NULL,
  `hear4000L` varchar(5) NOT NULL,
  `hear6000R` varchar(5) NOT NULL,
  `hear6000L` varchar(5) NOT NULL,
  `hear8000R` varchar(5) NOT NULL,
  `hear8000L` varchar(5) NOT NULL,
  `Lowright` varchar(20) NOT NULL,
  `Lowleft` varchar(20) NOT NULL,
  `Highright` varchar(20) NOT NULL,
  `Highleft` varchar(20) NOT NULL,
  `ptaright1` varchar(5) NOT NULL,
  `ptaleft1` varchar(5) NOT NULL,
  `ptaright2` varchar(5) NOT NULL,
  `ptaleft2` varchar(5) NOT NULL,
  `yearchk` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for chk_lab_items
-- ----------------------------
DROP TABLE IF EXISTS `chk_lab_items`;
CREATE TABLE `chk_lab_items` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `labnumber` varchar(255) DEFAULT NULL,
  `item_sso` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `status` varchar(5) NOT NULL DEFAULT 'N',
  `dob` datetime NOT NULL,
  `sex` varchar(5) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=43775 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chk_mouth
-- ----------------------------
DROP TABLE IF EXISTS `chk_mouth`;
CREATE TABLE `chk_mouth` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) DEFAULT NULL,
  `stat` varchar(100) NOT NULL,
  `advice1` varchar(100) NOT NULL,
  `advice2` varchar(100) NOT NULL,
  `stat2` varchar(20) NOT NULL,
  `advice3` varchar(20) NOT NULL,
  `advice4` varchar(20) NOT NULL,
  `stat3` varchar(20) NOT NULL,
  `advice5` varchar(20) NOT NULL,
  `advice6` varchar(20) NOT NULL,
  `stat4` varchar(20) NOT NULL,
  `advice7` varchar(20) NOT NULL,
  `advice8` varchar(20) NOT NULL,
  `advice9` varchar(20) NOT NULL,
  `advice10` varchar(30) DEFAULT NULL,
  `yearchk` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=174 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chk_pap
-- ----------------------------
DROP TABLE IF EXISTS `chk_pap`;
CREATE TABLE `chk_pap` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `stat` varchar(100) NOT NULL,
  `yearchk` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for chk_pt
-- ----------------------------
DROP TABLE IF EXISTS `chk_pt`;
CREATE TABLE `chk_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `leg` varchar(50) NOT NULL,
  `back` varchar(50) NOT NULL,
  `yearchk` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for chk_stool
-- ----------------------------
DROP TABLE IF EXISTS `chk_stool`;
CREATE TABLE `chk_stool` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `colour` varchar(100) NOT NULL,
  `consis` varchar(100) NOT NULL,
  `rbc` varchar(100) NOT NULL,
  `wbc` varchar(100) NOT NULL,
  `ova` varchar(100) NOT NULL,
  `concentrated` varchar(100) NOT NULL,
  `blood` varchar(100) NOT NULL,
  `yearchk` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for chkcompany
-- ----------------------------
DROP TABLE IF EXISTS `chkcompany`;
CREATE TABLE `chkcompany` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL,
  `year` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chkprogram
-- ----------------------------
DROP TABLE IF EXISTS `chkprogram`;
CREATE TABLE `chkprogram` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chkstm
-- ----------------------------
DROP TABLE IF EXISTS `chkstm`;
CREATE TABLE `chkstm` (
  `hn` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `invno` varchar(25) COLLATE utf8_unicode_ci NOT NULL,
  `dttran` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(10,0) NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for chkup_company
-- ----------------------------
DROP TABLE IF EXISTS `chkup_company`;
CREATE TABLE `chkup_company` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `company` varchar(100) NOT NULL,
  `program` varchar(100) NOT NULL,
  `idno` varchar(10) NOT NULL,
  `lab` varchar(20) NOT NULL,
  `xray` varchar(20) NOT NULL,
  `dr` varchar(20) NOT NULL,
  `opd` varchar(20) NOT NULL,
  `qlab` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=99 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for chkup_solider
-- ----------------------------
DROP TABLE IF EXISTS `chkup_solider`;
CREATE TABLE `chkup_solider` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `yot` varchar(20) DEFAULT NULL,
  `ptname` varchar(50) NOT NULL,
  `age` varchar(2) DEFAULT NULL,
  `gender` varchar(1) NOT NULL,
  `chunyot` varchar(50) NOT NULL,
  `idcard` varchar(13) NOT NULL,
  `position` varchar(50) NOT NULL,
  `ratchakarn` varchar(50) NOT NULL,
  `dxptright` varchar(1) DEFAULT NULL,
  `camp` varchar(100) NOT NULL,
  `othercamp` varchar(100) NOT NULL,
  `goup` varchar(100) NOT NULL,
  `idno` varchar(10) NOT NULL,
  `lab` varchar(20) NOT NULL,
  `xray` varchar(20) NOT NULL,
  `dr` varchar(20) NOT NULL,
  `opd` varchar(20) NOT NULL,
  `qlab` varchar(10) DEFAULT NULL,
  `drchkup` varchar(100) NOT NULL,
  `yearchkup` varchar(50) DEFAULT NULL,
  `active` varchar(1) NOT NULL,
  `solider_no` varchar(10) NOT NULL,
  `birthday` varchar(50) NOT NULL,
  `lab_no` int(5) NOT NULL,
  `xray_no` varchar(20) NOT NULL,
  `finance_date` varchar(50) NOT NULL,
  `vn` varchar(5) NOT NULL,
  `finance_lab` varchar(1) NOT NULL,
  `finance_xray` varchar(1) NOT NULL,
  `reason` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=6645 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for chronicfu
-- ----------------------------
DROP TABLE IF EXISTS `chronicfu`;
CREATE TABLE `chronicfu` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `pcucode` varchar(5) NOT NULL,
  `hn` varchar(15) NOT NULL,
  `seq` varchar(16) NOT NULL,
  `date_serv` varchar(15) NOT NULL,
  `weight` varchar(15) NOT NULL,
  `height` varchar(15) NOT NULL,
  `waist_cm` varchar(5) NOT NULL,
  `sbp` varchar(5) NOT NULL,
  `dbp` varchar(5) NOT NULL,
  `foot` varchar(5) NOT NULL,
  `retina` varchar(5) NOT NULL,
  `d_update` varchar(50) DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for clinic
-- ----------------------------
DROP TABLE IF EXISTS `clinic`;
CREATE TABLE `clinic` (
  `code` varchar(2) NOT NULL,
  `detail` varchar(100) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for clinic_vip
-- ----------------------------
DROP TABLE IF EXISTS `clinic_vip`;
CREATE TABLE `clinic_vip` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(40) NOT NULL,
  `time` varchar(20) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `an` varchar(20) NOT NULL,
  `ptname` varchar(150) NOT NULL,
  `yot` varchar(30) NOT NULL,
  `doctor` varchar(70) NOT NULL,
  `officer` varchar(150) NOT NULL,
  `update_r` varchar(20) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=250611 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for cliniceye
-- ----------------------------
DROP TABLE IF EXISTS `cliniceye`;
CREATE TABLE `cliniceye` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime DEFAULT NULL,
  `hn` varchar(10) NOT NULL,
  `vn` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47050 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for clinicnid
-- ----------------------------
DROP TABLE IF EXISTS `clinicnid`;
CREATE TABLE `clinicnid` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime DEFAULT NULL,
  `hn` varchar(10) NOT NULL,
  `vn` varchar(10) NOT NULL,
  `groupnid` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=470 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for clinicnidgroup
-- ----------------------------
DROP TABLE IF EXISTS `clinicnidgroup`;
CREATE TABLE `clinicnidgroup` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime DEFAULT NULL,
  `hn` varchar(10) NOT NULL,
  `goup` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=80931 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for cms
-- ----------------------------
DROP TABLE IF EXISTS `cms`;
CREATE TABLE `cms` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `unit` varchar(50) NOT NULL,
  `note` text NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for com_error
-- ----------------------------
DROP TABLE IF EXISTS `com_error`;
CREATE TABLE `com_error` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `com_date` varchar(50) NOT NULL,
  `symptoms` varchar(150) NOT NULL,
  `cause` text NOT NULL,
  `correction` text NOT NULL,
  `staff` varchar(100) NOT NULL,
  `level` varchar(50) NOT NULL,
  `regisdate` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for com_support
-- ----------------------------
DROP TABLE IF EXISTS `com_support`;
CREATE TABLE `com_support` (
  `row` bigint(11) NOT NULL AUTO_INCREMENT,
  `depart` varchar(50) DEFAULT NULL,
  `head` varchar(255) DEFAULT NULL,
  `detail` text,
  `datetime` varchar(20) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'Y',
  `user` varchar(50) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `programmer` varchar(30) DEFAULT NULL,
  `phone` varchar(13) NOT NULL,
  `user1` varchar(50) DEFAULT NULL,
  `p_edit` text NOT NULL,
  `dateend` varchar(30) DEFAULT NULL,
  `hold` int(5) DEFAULT '0',
  `jobtype` varchar(20) NOT NULL,
  `ignore` varchar(10) NOT NULL,
  PRIMARY KEY (`row`)
) ENGINE=MyISAM AUTO_INCREMENT=5288 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for com_support_details
-- ----------------------------
DROP TABLE IF EXISTS `com_support_details`;
CREATE TABLE `com_support_details` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `com_id` int(11) DEFAULT NULL,
  `detail` text,
  `editor` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=121 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for com_support_imgs
-- ----------------------------
DROP TABLE IF EXISTS `com_support_imgs`;
CREATE TABLE `com_support_imgs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `detail_id` int(11) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for combill
-- ----------------------------
DROP TABLE IF EXISTS `combill`;
CREATE TABLE `combill` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `docno` varchar(12) DEFAULT NULL,
  `billno` varchar(12) DEFAULT NULL,
  `billdate` varchar(30) DEFAULT NULL,
  `comcode` varchar(10) DEFAULT NULL,
  `comname` varchar(60) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `genname` varchar(40) DEFAULT NULL,
  `lotno` varchar(12) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `amount` int(8) DEFAULT NULL,
  `stkbak` int(8) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `unitpri` double(10,4) DEFAULT NULL,
  `salepri` double(10,2) DEFAULT NULL,
  `mfdate` varchar(30) DEFAULT NULL,
  `expdate` varchar(30) DEFAULT NULL,
  `getdate` varchar(30) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `person` varchar(32) DEFAULT NULL,
  `stkno` varchar(12) DEFAULT NULL,
  `contract` double(10,2) DEFAULT NULL,
  `percent` double(6,2) DEFAULT NULL,
  `dgexplot` varchar(100) DEFAULT NULL,
  `packing` varchar(16) DEFAULT NULL,
  `packamt` int(8) DEFAULT NULL,
  `packpri` double(10,2) DEFAULT NULL,
  `packpri_vat` double(10,2) NOT NULL,
  `amountfree` int(8) NOT NULL,
  `grouptype` varchar(5) NOT NULL,
  `actual_date` datetime NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `dgexplot` (`dgexplot`),
  KEY `drugcode` (`drugcode`),
  KEY `billno` (`billno`)
) ENGINE=MyISAM AUTO_INCREMENT=87695 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for combill_pt
-- ----------------------------
DROP TABLE IF EXISTS `combill_pt`;
CREATE TABLE `combill_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `docno` varchar(12) DEFAULT NULL,
  `billno` varchar(12) DEFAULT NULL,
  `billdate` varchar(30) DEFAULT NULL,
  `comcode` varchar(10) DEFAULT NULL,
  `comname` varchar(60) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `genname` varchar(40) DEFAULT NULL,
  `lotno` varchar(12) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `amount` int(8) DEFAULT NULL,
  `stkbak` int(8) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `unitpri` double(10,2) DEFAULT NULL,
  `salepri` double(10,2) DEFAULT NULL,
  `mfdate` varchar(30) DEFAULT NULL,
  `expdate` varchar(30) DEFAULT NULL,
  `getdate` varchar(30) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `person` varchar(32) DEFAULT NULL,
  `stkno` varchar(12) DEFAULT NULL,
  `contract` double(10,2) DEFAULT NULL,
  `percent` double(6,2) DEFAULT NULL,
  `dgexplot` varchar(100) DEFAULT NULL,
  `packing` varchar(16) DEFAULT NULL,
  `packamt` int(8) DEFAULT NULL,
  `packpri` double(10,2) DEFAULT NULL,
  `packpri_vat` double(10,2) NOT NULL,
  `amountfree` int(8) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `dgexplot` (`dgexplot`),
  KEY `drugcode` (`drugcode`),
  KEY `billno` (`billno`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for company
-- ----------------------------
DROP TABLE IF EXISTS `company`;
CREATE TABLE `company` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `comcode` varchar(10) DEFAULT NULL,
  `comname` varchar(60) DEFAULT NULL,
  `comaddr` varchar(60) DEFAULT NULL,
  `ampur` varchar(40) DEFAULT NULL,
  `changwat` varchar(40) DEFAULT NULL,
  `tel` varchar(40) DEFAULT NULL,
  `fax` varchar(100) NOT NULL,
  `pobillno` varchar(20) NOT NULL,
  `pobilldate` varchar(20) NOT NULL,
  `pobillno2` varchar(20) NOT NULL,
  `pobilldate2` varchar(20) NOT NULL,
  `pobillno3` varchar(20) NOT NULL,
  `pobilldate3` varchar(20) NOT NULL,
  `comtype` varchar(5) DEFAULT NULL,
  `taxpayer` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `comcode` (`comcode`),
  KEY `compcode` (`comcode`)
) ENGINE=MyISAM AUTO_INCREMENT=609 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for company_payment
-- ----------------------------
DROP TABLE IF EXISTS `company_payment`;
CREATE TABLE `company_payment` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `txdate` varchar(50) NOT NULL,
  `hn` varchar(12) NOT NULL,
  `vn` varchar(5) NOT NULL,
  `an` varchar(10) NOT NULL,
  `ptname` varchar(255) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `company` varchar(255) NOT NULL,
  `officer` varchar(255) NOT NULL,
  `transaction_date` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 PACK_KEYS=0 COMMENT='ชื่อบริษัทที่เบิกประกันสังคมกรณี กท44';

-- ----------------------------
-- Table structure for comservice
-- ----------------------------
DROP TABLE IF EXISTS `comservice`;
CREATE TABLE `comservice` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `datework` date NOT NULL,
  `timework` varchar(5) NOT NULL,
  `depart` varchar(100) NOT NULL,
  `idsupport` int(11) DEFAULT NULL,
  `personal` varchar(100) NOT NULL,
  `detail` text NOT NULL,
  `type` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `datekey` datetime DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=566 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for condxofyear
-- ----------------------------
DROP TABLE IF EXISTS `condxofyear`;
CREATE TABLE `condxofyear` (
  `row_id` int(10) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `thdatevn` varchar(20) NOT NULL,
  `hn` varchar(8) NOT NULL,
  `vn` varchar(5) NOT NULL,
  `ptname` varchar(80) CHARACTER SET utf8 COLLATE utf8_bin DEFAULT NULL,
  `age` varchar(20) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `camp_until` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp1` varchar(10) NOT NULL,
  `bp2` varchar(10) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `congenital_disease` varchar(60) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `ua_color` varchar(10) NOT NULL,
  `ua_appear` varchar(10) NOT NULL,
  `ua_spgr` varchar(10) NOT NULL,
  `ua_phu` varchar(10) NOT NULL,
  `ua_bloodu` varchar(10) NOT NULL,
  `ua_prou` varchar(10) NOT NULL,
  `ua_gluu` varchar(10) NOT NULL,
  `ua_ketu` varchar(10) NOT NULL,
  `ua_urobil` varchar(10) NOT NULL,
  `ua_bili` varchar(10) NOT NULL,
  `ua_nitrit` varchar(10) NOT NULL,
  `ua_wbcu` varchar(10) NOT NULL,
  `ua_rbcu` varchar(10) NOT NULL,
  `ua_epiu` varchar(10) NOT NULL,
  `ua_bactu` varchar(10) NOT NULL,
  `ua_yeast` varchar(10) NOT NULL,
  `ua_mucosu` varchar(10) NOT NULL,
  `ua_amopu` varchar(10) NOT NULL,
  `ua_castu` varchar(10) NOT NULL,
  `ua_crystu` varchar(10) NOT NULL,
  `ua_otheru` varchar(10) NOT NULL,
  `stat_ua` varchar(20) NOT NULL,
  `reason_ua` varchar(100) DEFAULT NULL,
  `cbc_wbc` varchar(10) NOT NULL,
  `stat_wbc` varchar(20) NOT NULL,
  `reason_wbc` varchar(100) NOT NULL,
  `cbc_rbc` varchar(10) NOT NULL,
  `cbc_hb` varchar(10) NOT NULL,
  `cbc_hct` varchar(10) NOT NULL,
  `stat_hct` varchar(20) NOT NULL,
  `reason_hct` varchar(100) NOT NULL,
  `cbc_mcv` varchar(10) NOT NULL,
  `cbc_mch` varchar(10) NOT NULL,
  `cbc_mchc` varchar(10) NOT NULL,
  `cbc_pltc` varchar(10) NOT NULL,
  `stat_pltc` varchar(20) NOT NULL,
  `reason_pltc` varchar(100) NOT NULL,
  `cbc_plts` varchar(10) NOT NULL,
  `cbc_neu` varchar(10) NOT NULL,
  `cbc_lymp` varchar(10) NOT NULL,
  `cbc_mono` varchar(10) NOT NULL,
  `cbc_eos` varchar(10) NOT NULL,
  `cbc_baso` varchar(10) NOT NULL,
  `cbc_band` varchar(10) NOT NULL,
  `cbc_atyp` varchar(10) NOT NULL,
  `cbc_nrbc` varchar(10) NOT NULL,
  `cbc_rbcmor` varchar(10) NOT NULL,
  `cbc_other` varchar(10) NOT NULL,
  `stat_cbc` varchar(20) NOT NULL,
  `reason_cbc` varchar(100) DEFAULT NULL,
  `cxr` varchar(10) NOT NULL,
  `reason_cxr` varchar(500) DEFAULT NULL,
  `bs` varchar(10) NOT NULL,
  `stat_bs` varchar(20) NOT NULL,
  `reason_bs` varchar(100) DEFAULT NULL,
  `bun` varchar(10) NOT NULL,
  `stat_bun` varchar(20) NOT NULL,
  `reason_bun` varchar(100) DEFAULT NULL,
  `cr` varchar(10) NOT NULL,
  `stat_cr` varchar(20) NOT NULL,
  `reason_cr` varchar(100) DEFAULT NULL,
  `uric` varchar(10) NOT NULL,
  `stat_uric` varchar(20) NOT NULL,
  `reason_uric` varchar(100) DEFAULT NULL,
  `chol` varchar(10) NOT NULL,
  `stat_chol` varchar(20) NOT NULL,
  `reason_chol` varchar(100) DEFAULT NULL,
  `tg` varchar(10) NOT NULL,
  `stat_tg` varchar(20) NOT NULL,
  `reason_tg` varchar(100) DEFAULT NULL,
  `sgot` varchar(10) NOT NULL,
  `stat_sgot` varchar(20) NOT NULL,
  `reason_sgot` varchar(100) DEFAULT NULL,
  `sgpt` varchar(10) NOT NULL,
  `stat_sgpt` varchar(20) NOT NULL,
  `reason_sgpt` varchar(100) DEFAULT NULL,
  `alk` varchar(10) NOT NULL,
  `stat_alk` varchar(20) NOT NULL,
  `reason_alk` varchar(100) DEFAULT NULL,
  `general` varchar(10) DEFAULT NULL,
  `reason_general` varchar(100) DEFAULT NULL,
  `pap` varchar(10) NOT NULL,
  `reason_pap` varchar(100) DEFAULT NULL,
  `other1` varchar(10) NOT NULL,
  `stat_other1` varchar(20) NOT NULL,
  `reason_other1` varchar(100) DEFAULT NULL,
  `other2` varchar(10) NOT NULL,
  `stat_other2` varchar(20) NOT NULL,
  `reason_other2` varchar(100) DEFAULT NULL,
  `dx` text NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `summary` varchar(100) DEFAULT NULL,
  `company` varchar(100) NOT NULL,
  `type_check` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `hear500R` varchar(10) DEFAULT NULL,
  `hear500L` varchar(10) DEFAULT NULL,
  `hear1000R` varchar(10) DEFAULT NULL,
  `hear1000L` varchar(10) DEFAULT NULL,
  `hear2000R` varchar(10) DEFAULT NULL,
  `hear2000L` varchar(10) DEFAULT NULL,
  `hear3000R` varchar(10) DEFAULT NULL,
  `hear3000L` varchar(10) DEFAULT NULL,
  `hear4000R` varchar(10) DEFAULT NULL,
  `hear4000L` varchar(10) DEFAULT NULL,
  `hear6000R` varchar(10) DEFAULT NULL,
  `hear6000L` varchar(10) DEFAULT NULL,
  `hear8000R` varchar(10) DEFAULT NULL,
  `hear8000L` varchar(10) DEFAULT NULL,
  `LowRight` varchar(20) NOT NULL,
  `LowLeft` varchar(20) NOT NULL,
  `HighRight` varchar(20) NOT NULL,
  `HighLeft` varchar(20) NOT NULL,
  `ptaRight1` varchar(10) NOT NULL,
  `ptaLeft1` varchar(10) NOT NULL,
  `ptaRight2` varchar(10) NOT NULL,
  `ptaLeft2` varchar(10) NOT NULL,
  `FVC1` varchar(10) DEFAULT NULL,
  `FVC2` varchar(10) NOT NULL,
  `FVC3` varchar(10) NOT NULL,
  `FEV1` varchar(10) NOT NULL,
  `FEV2` varchar(10) NOT NULL,
  `FEV3` varchar(10) NOT NULL,
  `RO1` varchar(10) DEFAULT NULL,
  `RO2` varchar(10) NOT NULL,
  `RO3` varchar(10) NOT NULL,
  `PEF1` varchar(10) DEFAULT NULL,
  `PEF2` varchar(10) NOT NULL,
  `PEF3` varchar(10) NOT NULL,
  `reason_chest` varchar(100) NOT NULL,
  `stat_chest` varchar(100) DEFAULT NULL,
  `lead` varchar(100) DEFAULT NULL,
  `resultlead` varchar(100) NOT NULL,
  `cadmium` varchar(100) DEFAULT NULL,
  `resultcadmium` varchar(100) NOT NULL,
  `chromium` varchar(100) DEFAULT NULL,
  `resultchromium` varchar(100) NOT NULL,
  `arsenic` varchar(100) DEFAULT NULL,
  `resultarsenic` varchar(100) NOT NULL,
  `mercury` varchar(100) DEFAULT NULL,
  `resultmercury` varchar(100) NOT NULL,
  `copper` varchar(100) DEFAULT NULL,
  `resultcopper` varchar(100) NOT NULL,
  `nickel` varchar(100) DEFAULT NULL,
  `resultnickel` varchar(100) NOT NULL,
  `antimony` varchar(100) DEFAULT NULL,
  `resultantimony` varchar(100) NOT NULL,
  `status_con` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=787 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for condxofyear_emp
-- ----------------------------
DROP TABLE IF EXISTS `condxofyear_emp`;
CREATE TABLE `condxofyear_emp` (
  `row_id` int(10) NOT NULL AUTO_INCREMENT,
  `thidate` datetime DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `thdatevn` varchar(20) NOT NULL,
  `hn` varchar(8) NOT NULL,
  `vn` varchar(5) NOT NULL,
  `ptname` varchar(80) NOT NULL,
  `age` varchar(20) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `camp_until` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp1` varchar(10) NOT NULL,
  `bp2` varchar(10) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `congenital_disease` varchar(60) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `ua_color` varchar(10) NOT NULL,
  `ua_appear` varchar(10) NOT NULL,
  `ua_spgr` varchar(10) NOT NULL,
  `ua_phu` varchar(10) NOT NULL,
  `ua_bloodu` varchar(10) NOT NULL,
  `ua_prou` varchar(10) NOT NULL,
  `ua_gluu` varchar(10) NOT NULL,
  `ua_ketu` varchar(10) NOT NULL,
  `ua_urobil` varchar(10) NOT NULL,
  `ua_bili` varchar(10) NOT NULL,
  `ua_nitrit` varchar(10) NOT NULL,
  `ua_wbcu` varchar(10) NOT NULL,
  `ua_rbcu` varchar(10) NOT NULL,
  `ua_epiu` varchar(10) NOT NULL,
  `ua_bactu` varchar(10) NOT NULL,
  `ua_yeast` varchar(10) NOT NULL,
  `ua_mucosu` varchar(10) NOT NULL,
  `ua_amopu` varchar(10) NOT NULL,
  `ua_castu` varchar(10) NOT NULL,
  `ua_crystu` varchar(10) NOT NULL,
  `ua_otheru` varchar(10) NOT NULL,
  `stat_ua` varchar(20) NOT NULL,
  `reason_ua` varchar(100) DEFAULT NULL,
  `cbc_wbc` varchar(10) NOT NULL,
  `stat_wbc` varchar(20) NOT NULL,
  `reason_wbc` varchar(100) NOT NULL,
  `wbcrange` varchar(20) NOT NULL,
  `wbcflag` varchar(20) NOT NULL,
  `cbc_rbc` varchar(10) NOT NULL,
  `cbc_hb` varchar(10) NOT NULL,
  `cbc_hct` varchar(10) NOT NULL,
  `stat_hct` varchar(20) NOT NULL,
  `reason_hct` varchar(100) NOT NULL,
  `hctrange` varchar(20) NOT NULL,
  `hctflag` varchar(20) NOT NULL,
  `cbc_mcv` varchar(10) NOT NULL,
  `cbc_mch` varchar(10) NOT NULL,
  `cbc_mchc` varchar(10) NOT NULL,
  `cbc_pltc` varchar(10) NOT NULL,
  `stat_pltc` varchar(20) NOT NULL,
  `reason_pltc` varchar(100) NOT NULL,
  `pltcrange` varchar(20) NOT NULL,
  `pltcflag` varchar(20) NOT NULL,
  `cbc_plts` varchar(10) NOT NULL,
  `cbc_neu` varchar(10) NOT NULL,
  `cbc_lymp` varchar(10) NOT NULL,
  `cbc_mono` varchar(10) NOT NULL,
  `cbc_eos` varchar(10) NOT NULL,
  `cbc_baso` varchar(10) NOT NULL,
  `cbc_band` varchar(10) NOT NULL,
  `cbc_atyp` varchar(10) NOT NULL,
  `cbc_nrbc` varchar(10) NOT NULL,
  `cbc_rbcmor` varchar(10) NOT NULL,
  `cbc_other` varchar(10) NOT NULL,
  `stat_cbc` varchar(20) NOT NULL,
  `reason_cbc` varchar(100) DEFAULT NULL,
  `cxr` varchar(10) NOT NULL,
  `reason_cxr` varchar(100) DEFAULT NULL,
  `bs` varchar(10) NOT NULL,
  `stat_bs` varchar(20) NOT NULL,
  `reason_bs` varchar(100) DEFAULT NULL,
  `bsrange` varchar(20) NOT NULL,
  `bsflag` varchar(20) NOT NULL,
  `bun` varchar(10) NOT NULL,
  `stat_bun` varchar(20) NOT NULL,
  `reason_bun` varchar(100) DEFAULT NULL,
  `bunrange` varchar(20) NOT NULL,
  `bunflag` varchar(20) NOT NULL,
  `cr` varchar(10) NOT NULL,
  `stat_cr` varchar(20) NOT NULL,
  `reason_cr` varchar(100) DEFAULT NULL,
  `crrange` varchar(20) NOT NULL,
  `crflag` varchar(20) NOT NULL,
  `uric` varchar(10) NOT NULL,
  `stat_uric` varchar(20) NOT NULL,
  `reason_uric` varchar(100) DEFAULT NULL,
  `uricrange` varchar(20) NOT NULL,
  `uricflag` varchar(20) NOT NULL,
  `chol` varchar(10) NOT NULL,
  `stat_chol` varchar(20) NOT NULL,
  `reason_chol` varchar(100) DEFAULT NULL,
  `cholrange` varchar(20) NOT NULL,
  `cholflag` varchar(20) NOT NULL,
  `tg` varchar(10) NOT NULL,
  `stat_tg` varchar(20) NOT NULL,
  `reason_tg` varchar(100) DEFAULT NULL,
  `tgrange` varchar(20) NOT NULL,
  `tgflag` varchar(20) NOT NULL,
  `sgot` varchar(10) NOT NULL,
  `stat_sgot` varchar(20) NOT NULL,
  `reason_sgot` varchar(100) DEFAULT NULL,
  `sgotrange` varchar(20) NOT NULL,
  `sgotflag` varchar(20) NOT NULL,
  `sgpt` varchar(10) NOT NULL,
  `stat_sgpt` varchar(20) NOT NULL,
  `reason_sgpt` varchar(100) DEFAULT NULL,
  `sgptrange` varchar(20) NOT NULL,
  `sgptflag` varchar(20) NOT NULL,
  `alk` varchar(10) NOT NULL,
  `stat_alk` varchar(20) NOT NULL,
  `reason_alk` varchar(100) DEFAULT NULL,
  `alkrange` varchar(20) NOT NULL,
  `alkflag` varchar(20) NOT NULL,
  `general` varchar(10) DEFAULT NULL,
  `reason_general` varchar(100) DEFAULT NULL,
  `reason_pap` varchar(100) DEFAULT NULL,
  `pap` varchar(100) NOT NULL,
  `dx` text NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `summary` varchar(100) DEFAULT NULL,
  `diag` varchar(200) DEFAULT NULL,
  `stat_mouth1` varchar(100) NOT NULL,
  `stat_mouth2` varchar(100) NOT NULL,
  `stat_mouth3` varchar(100) NOT NULL,
  `stat_mouth4` varchar(100) NOT NULL,
  `reason_mouth` varchar(100) NOT NULL,
  `stat_hbsag` varchar(100) NOT NULL,
  `stat_hbsab` varchar(100) NOT NULL,
  `stat_hbcab` varchar(100) NOT NULL,
  `stat_lead` varchar(100) NOT NULL,
  `stat_stool` varchar(100) NOT NULL,
  `stat_hear1` varchar(100) NOT NULL,
  `stat_hear2` varchar(100) NOT NULL,
  `stat_hear3` varchar(100) NOT NULL,
  `stat_hear4` varchar(100) NOT NULL,
  `reason_hear` varchar(100) NOT NULL,
  `stat_eye` varchar(100) NOT NULL,
  `reason_eye` varchar(100) NOT NULL,
  `stat_chest` varchar(100) NOT NULL,
  `reason_chest` varchar(100) NOT NULL,
  `status_dr` varchar(20) NOT NULL,
  `yearcheck` varchar(4) NOT NULL,
  `printok` varchar(5) NOT NULL DEFAULT 'N',
  `ldl` varchar(10) NOT NULL,
  `stat_ldl` varchar(20) NOT NULL,
  `reason_ldl` varchar(100) DEFAULT NULL,
  `ldlrange` varchar(20) NOT NULL,
  `ldlflag` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=469 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for condxofyear_out
-- ----------------------------
DROP TABLE IF EXISTS `condxofyear_out`;
CREATE TABLE `condxofyear_out` (
  `row_id` int(10) NOT NULL AUTO_INCREMENT,
  `thidate` datetime DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `thdatevn` varchar(20) NOT NULL,
  `hn` varchar(8) NOT NULL,
  `vn` varchar(5) NOT NULL,
  `ptname` varchar(80) NOT NULL,
  `age` varchar(20) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `camp_until` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp1` varchar(10) NOT NULL,
  `bp2` varchar(10) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `prawat` varchar(1) NOT NULL,
  `congenital_disease` varchar(255) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `ua_color` varchar(10) NOT NULL,
  `ua_appear` varchar(10) NOT NULL,
  `ua_spgr` varchar(10) NOT NULL,
  `ua_phu` varchar(10) NOT NULL,
  `ua_bloodu` varchar(10) NOT NULL,
  `ua_prou` varchar(10) NOT NULL,
  `ua_gluu` varchar(10) NOT NULL,
  `ua_ketu` varchar(10) NOT NULL,
  `ua_urobil` varchar(10) NOT NULL,
  `ua_bili` varchar(10) NOT NULL,
  `ua_nitrit` varchar(10) NOT NULL,
  `ua_wbcu` varchar(10) NOT NULL,
  `ua_rbcu` varchar(10) NOT NULL,
  `ua_epiu` varchar(10) NOT NULL,
  `ua_bactu` varchar(10) NOT NULL,
  `ua_yeast` varchar(10) NOT NULL,
  `ua_mucosu` varchar(10) NOT NULL,
  `ua_amopu` varchar(10) NOT NULL,
  `ua_castu` varchar(10) NOT NULL,
  `ua_crystu` varchar(10) NOT NULL,
  `ua_otheru` varchar(10) NOT NULL,
  `stat_ua` varchar(20) NOT NULL,
  `reason_ua` varchar(100) DEFAULT NULL,
  `cbc_wbc` varchar(10) NOT NULL,
  `stat_wbc` varchar(20) NOT NULL,
  `reason_wbc` varchar(100) NOT NULL,
  `wbcrange` varchar(20) NOT NULL,
  `wbcflag` varchar(20) NOT NULL,
  `cbc_rbc` varchar(10) NOT NULL,
  `cbc_hb` varchar(10) NOT NULL,
  `cbc_hct` varchar(10) NOT NULL,
  `stat_hct` varchar(20) NOT NULL,
  `reason_hct` varchar(100) NOT NULL,
  `hctrange` varchar(20) NOT NULL,
  `hctflag` varchar(20) NOT NULL,
  `cbc_mcv` varchar(10) NOT NULL,
  `cbc_mch` varchar(10) NOT NULL,
  `cbc_mchc` varchar(10) NOT NULL,
  `cbc_pltc` varchar(10) NOT NULL,
  `stat_pltc` varchar(20) NOT NULL,
  `reason_pltc` varchar(100) NOT NULL,
  `pltcrange` varchar(20) NOT NULL,
  `pltcflag` varchar(20) NOT NULL,
  `cbc_plts` varchar(10) NOT NULL,
  `cbc_neu` varchar(10) NOT NULL,
  `cbc_lymp` varchar(10) NOT NULL,
  `cbc_mono` varchar(10) NOT NULL,
  `cbc_eos` varchar(10) NOT NULL,
  `cbc_baso` varchar(10) NOT NULL,
  `cbc_band` varchar(10) NOT NULL,
  `cbc_atyp` varchar(10) NOT NULL,
  `cbc_nrbc` varchar(10) NOT NULL,
  `cbc_rbcmor` varchar(10) NOT NULL,
  `cbc_other` varchar(10) NOT NULL,
  `stat_cbc` varchar(20) NOT NULL,
  `reason_cbc` varchar(100) DEFAULT NULL,
  `cxr` varchar(10) NOT NULL,
  `reason_cxr` varchar(100) DEFAULT NULL,
  `bs` varchar(10) NOT NULL,
  `stat_bs` varchar(20) NOT NULL,
  `reason_bs` varchar(100) DEFAULT NULL,
  `bsrange` varchar(20) NOT NULL,
  `bsflag` varchar(20) NOT NULL,
  `bun` varchar(10) NOT NULL,
  `stat_bun` varchar(20) NOT NULL,
  `reason_bun` varchar(100) DEFAULT NULL,
  `bunrange` varchar(20) NOT NULL,
  `bunflag` varchar(20) NOT NULL,
  `cr` varchar(10) NOT NULL,
  `stat_cr` varchar(20) NOT NULL,
  `reason_cr` varchar(100) DEFAULT NULL,
  `crrange` varchar(20) NOT NULL,
  `crflag` varchar(20) NOT NULL,
  `uric` varchar(10) NOT NULL,
  `stat_uric` varchar(20) NOT NULL,
  `reason_uric` varchar(100) DEFAULT NULL,
  `uricrange` varchar(20) NOT NULL,
  `uricflag` varchar(20) NOT NULL,
  `chol` varchar(10) NOT NULL,
  `stat_chol` varchar(20) NOT NULL,
  `reason_chol` varchar(100) DEFAULT NULL,
  `cholrange` varchar(20) NOT NULL,
  `cholflag` varchar(20) NOT NULL,
  `tg` varchar(10) NOT NULL,
  `stat_tg` varchar(20) NOT NULL,
  `reason_tg` varchar(100) DEFAULT NULL,
  `tgrange` varchar(20) NOT NULL,
  `tgflag` varchar(20) NOT NULL,
  `sgot` varchar(10) NOT NULL,
  `stat_sgot` varchar(20) NOT NULL,
  `reason_sgot` varchar(100) DEFAULT NULL,
  `sgotrange` varchar(20) NOT NULL,
  `sgotflag` varchar(20) NOT NULL,
  `sgpt` varchar(10) NOT NULL,
  `stat_sgpt` varchar(20) NOT NULL,
  `reason_sgpt` varchar(100) DEFAULT NULL,
  `sgptrange` varchar(20) NOT NULL,
  `sgptflag` varchar(20) NOT NULL,
  `alk` varchar(10) NOT NULL,
  `stat_alk` varchar(20) NOT NULL,
  `reason_alk` varchar(100) DEFAULT NULL,
  `alkrange` varchar(20) NOT NULL,
  `alkflag` varchar(20) NOT NULL,
  `general` varchar(10) DEFAULT NULL,
  `reason_general` varchar(100) DEFAULT NULL,
  `pap` varchar(10) NOT NULL,
  `reason_pap` varchar(100) DEFAULT NULL,
  `other1` varchar(100) DEFAULT NULL,
  `stat_other1` varchar(100) DEFAULT NULL,
  `reason_other1` varchar(100) DEFAULT NULL,
  `other2` varchar(100) DEFAULT NULL,
  `stat_other2` varchar(100) DEFAULT NULL,
  `reason_other2` varchar(100) DEFAULT NULL,
  `other3` varchar(100) NOT NULL,
  `stat_other3` varchar(100) NOT NULL,
  `reason_other3` varchar(100) NOT NULL,
  `other4` varchar(100) NOT NULL,
  `stat_other4` varchar(100) NOT NULL,
  `reason_other4` varchar(100) NOT NULL,
  `other5` varchar(100) NOT NULL,
  `stat_other5` varchar(100) NOT NULL,
  `reason_other5` varchar(100) NOT NULL,
  `other6` varchar(100) NOT NULL,
  `stat_other6` varchar(100) NOT NULL,
  `reason_other6` varchar(100) NOT NULL,
  `other7` varchar(100) NOT NULL,
  `stat_other7` varchar(100) NOT NULL,
  `reason_other7` varchar(100) NOT NULL,
  `dx` text NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `exercise` varchar(1) DEFAULT NULL,
  `summary` varchar(100) DEFAULT NULL,
  `diag` varchar(200) DEFAULT NULL,
  `soldier1` varchar(20) NOT NULL,
  `reason_sol1` varchar(100) NOT NULL,
  `soldier2` varchar(20) NOT NULL,
  `reason_sol2` varchar(100) NOT NULL,
  `soldier3` varchar(20) NOT NULL,
  `reason_sol3` varchar(100) NOT NULL,
  `soldier4` varchar(20) NOT NULL,
  `reason_sol4` varchar(100) NOT NULL,
  `soldier5` varchar(20) NOT NULL,
  `reason_sol5` varchar(100) NOT NULL,
  `soldier6` varchar(20) NOT NULL,
  `reason_sol6` varchar(100) NOT NULL,
  `soldier7` varchar(20) NOT NULL,
  `reason_sol7` varchar(100) NOT NULL,
  `soldier8` varchar(20) NOT NULL,
  `reason_sol8` varchar(100) NOT NULL,
  `soldier9` varchar(20) NOT NULL,
  `reason_sol9` varchar(100) NOT NULL,
  `soldier10` varchar(20) NOT NULL,
  `reason_sol10` varchar(100) NOT NULL,
  `status_dr` varchar(20) NOT NULL,
  `yearcheck` varchar(4) NOT NULL,
  `smbasic` varchar(100) NOT NULL,
  `smdm` varchar(5) NOT NULL,
  `smht` varchar(5) NOT NULL,
  `smstr` varchar(5) NOT NULL,
  `smobe` varchar(5) NOT NULL,
  `solution` varchar(100) NOT NULL,
  `printok` varchar(5) NOT NULL DEFAULT 'N',
  `sol1` varchar(100) NOT NULL,
  `sol2` varchar(100) NOT NULL,
  `sol3` varchar(100) NOT NULL,
  `sol4` varchar(100) NOT NULL,
  `sol41` varchar(100) NOT NULL,
  `sol5` varchar(100) NOT NULL,
  `sol51` varchar(100) NOT NULL,
  `sum1` varchar(100) NOT NULL,
  `sum2` varchar(100) NOT NULL,
  `rs_sum21` varchar(100) NOT NULL,
  `rs_sum22` varchar(100) NOT NULL,
  `rs_sum23` varchar(100) NOT NULL,
  `rs_sum24` varchar(100) NOT NULL,
  `rs_sum25` varchar(100) NOT NULL,
  `sum3` varchar(100) NOT NULL,
  `sum4` varchar(100) NOT NULL,
  `sum5` varchar(100) NOT NULL,
  `rs_sum51` varchar(100) NOT NULL,
  `rs_sum52` varchar(100) NOT NULL,
  `rs_sum53` varchar(100) NOT NULL,
  `sum6` varchar(100) NOT NULL,
  `rs_sum61` varchar(100) NOT NULL,
  `anemia` varchar(1) DEFAULT NULL,
  `cirrhosis` varchar(1) DEFAULT NULL,
  `hepatitis` varchar(1) DEFAULT NULL,
  `cardiomegaly` varchar(1) DEFAULT NULL,
  `allergy` varchar(1) DEFAULT NULL,
  `gout` varchar(1) DEFAULT NULL,
  `waistline` varchar(1) DEFAULT NULL,
  `asthma` varchar(1) DEFAULT NULL,
  `muscle` varchar(1) DEFAULT NULL,
  `ihd` varchar(1) DEFAULT NULL,
  `thyroid` varchar(1) DEFAULT NULL,
  `heart` varchar(1) DEFAULT NULL,
  `emphysema` varchar(1) DEFAULT NULL,
  `herniated` varchar(1) DEFAULT NULL,
  `conjunctivitis` varchar(1) DEFAULT NULL,
  `cystitis` varchar(1) DEFAULT NULL,
  `epilepsy` varchar(1) DEFAULT NULL,
  `fracture` varchar(1) DEFAULT NULL,
  `cardiac` varchar(1) DEFAULT NULL,
  `spine` varchar(1) DEFAULT NULL,
  `dermatitis` varchar(1) DEFAULT NULL,
  `degeneration` varchar(1) DEFAULT NULL,
  `alcoholic` varchar(1) DEFAULT NULL,
  `copd` varchar(1) DEFAULT NULL,
  `bph` varchar(1) DEFAULT NULL,
  `kidney` varchar(1) DEFAULT NULL,
  `pterygium` varchar(1) DEFAULT NULL,
  `tonsil` varchar(1) DEFAULT NULL,
  `paralysis` varchar(1) DEFAULT NULL,
  `blood` varchar(1) DEFAULT NULL,
  `conanemia` varchar(1) DEFAULT NULL,
  `ht` varchar(1) DEFAULT NULL,
  `stat_pressure` varchar(20) DEFAULT NULL,
  `reason_pressure` varchar(100) DEFAULT NULL,
  `stat_bmi` varchar(20) DEFAULT NULL,
  `reason_bmi` varchar(100) DEFAULT NULL,
  `report_status` varchar(1) NOT NULL,
  `statusdata` varchar(1) NOT NULL,
  `dental_exam` varchar(255) DEFAULT NULL,
  `color_blind` varchar(255) DEFAULT NULL,
  `audiogram` varchar(255) DEFAULT NULL,
  `ekg` varchar(255) DEFAULT NULL,
  `res_ekg` varchar(50) DEFAULT NULL,
  `hdl` varchar(50) DEFAULT NULL,
  `hdl_range` varchar(50) DEFAULT NULL,
  `stat_hdl` varchar(255) DEFAULT NULL,
  `reason_hdl` varchar(255) DEFAULT NULL,
  `ldlc` varchar(50) DEFAULT NULL,
  `ldlc_range` varchar(50) DEFAULT NULL,
  `stat_ldlc` varchar(50) DEFAULT NULL,
  `reason_ldlc` varchar(50) DEFAULT NULL,
  `malari` varchar(50) DEFAULT NULL,
  `malari_range` varchar(50) DEFAULT NULL,
  `stat_malari` varchar(255) DEFAULT NULL,
  `metamp` varchar(50) DEFAULT NULL,
  `metamp_range` varchar(50) DEFAULT NULL,
  `stat_metamp` varchar(255) DEFAULT NULL,
  `hbsag` varchar(50) DEFAULT NULL,
  `hbsag_range` varchar(50) DEFAULT NULL,
  `stat_hbsag` varchar(255) DEFAULT NULL,
  `hcvab` varchar(50) DEFAULT NULL,
  `hcvab_range` varchar(50) DEFAULT NULL,
  `stat_hcvab` varchar(255) DEFAULT NULL,
  `hiv` varchar(50) DEFAULT NULL,
  `hiv_range` varchar(50) DEFAULT NULL,
  `stat_hiv` varchar(255) DEFAULT NULL,
  `vdrl` varchar(50) DEFAULT NULL,
  `vdrl_range` varchar(50) DEFAULT NULL,
  `stat_vdrl` varchar(255) DEFAULT NULL,
  `parasi` varchar(50) DEFAULT NULL,
  `parasi_range` varchar(50) DEFAULT NULL,
  `stat_parasi` varchar(255) DEFAULT NULL,
  `groupt` varchar(50) DEFAULT NULL,
  `groupt_range` varchar(50) DEFAULT NULL,
  `stat_groupt` varchar(255) DEFAULT NULL,
  `rh` varchar(50) DEFAULT NULL,
  `rh_range` varchar(50) DEFAULT NULL,
  `stat_rh` varchar(255) DEFAULT NULL,
  `upt` varchar(50) DEFAULT NULL,
  `upt_range` varchar(50) DEFAULT NULL,
  `stat_upt` varchar(255) DEFAULT NULL,
  `antihb` varchar(255) DEFAULT NULL,
  `antihb_range` varchar(255) DEFAULT NULL,
  `stat_antihb` varchar(255) DEFAULT NULL,
  `ldl` varchar(50) DEFAULT NULL,
  `ldl_range` varchar(50) DEFAULT NULL,
  `stat_ldl` varchar(50) DEFAULT NULL,
  `reason_ldl` varchar(50) DEFAULT NULL,
  `stocc` varchar(255) DEFAULT NULL,
  `stoccflag` varchar(5) DEFAULT NULL,
  `stat_stocc` varchar(255) DEFAULT NULL,
  `doctor_ans` varchar(255) NOT NULL,
  `hba1c` varchar(50) DEFAULT NULL,
  `hba1c_range` varchar(50) DEFAULT NULL,
  `stat_hba1c` varchar(255) DEFAULT NULL,
  `reason_hba1c` varchar(50) DEFAULT NULL,
  `CEA` varchar(50) DEFAULT NULL,
  `CEArange` varchar(50) DEFAULT NULL,
  `stat_cea` varchar(255) DEFAULT NULL,
  `PSA` varchar(50) DEFAULT NULL,
  `PSArange` varchar(255) DEFAULT NULL,
  `stat_psa` varchar(255) DEFAULT NULL,
  `AFP` varchar(50) DEFAULT NULL,
  `AFPrange` varchar(50) DEFAULT NULL,
  `stat_afp` varchar(50) DEFAULT NULL,
  `TP` varchar(50) DEFAULT NULL,
  `TPrange` varchar(50) DEFAULT NULL,
  `stat_tp` varchar(50) DEFAULT NULL,
  `ALB` varchar(50) DEFAULT NULL,
  `ALBrange` varchar(50) DEFAULT NULL,
  `stat_alb` varchar(50) DEFAULT NULL,
  `TB` varchar(50) DEFAULT NULL,
  `TBPrange` varchar(50) DEFAULT NULL,
  `stat_tb` varchar(50) DEFAULT NULL,
  `DB` varchar(50) DEFAULT NULL,
  `DBrange` varchar(50) DEFAULT NULL,
  `stat_db` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14383 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for condxofyear_so
-- ----------------------------
DROP TABLE IF EXISTS `condxofyear_so`;
CREATE TABLE `condxofyear_so` (
  `row_id` int(10) NOT NULL AUTO_INCREMENT,
  `thidate` datetime DEFAULT NULL,
  `thdatehn` varchar(30) DEFAULT NULL,
  `thdatevn` varchar(20) NOT NULL,
  `hn` varchar(15) DEFAULT NULL,
  `vn` varchar(5) NOT NULL,
  `ptname` varchar(80) NOT NULL,
  `age` varchar(20) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `camp_until` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp1` varchar(10) NOT NULL,
  `bp2` varchar(10) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `prawat` varchar(1) NOT NULL,
  `congenital_disease` varchar(60) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `ua_color` varchar(10) NOT NULL,
  `ua_appear` varchar(10) NOT NULL,
  `ua_spgr` varchar(10) NOT NULL,
  `ua_phu` varchar(10) NOT NULL,
  `ua_bloodu` varchar(10) NOT NULL,
  `ua_prou` varchar(10) NOT NULL,
  `ua_gluu` varchar(10) NOT NULL,
  `ua_ketu` varchar(10) NOT NULL,
  `ua_urobil` varchar(10) NOT NULL,
  `ua_bili` varchar(10) NOT NULL,
  `ua_nitrit` varchar(10) NOT NULL,
  `ua_wbcu` varchar(10) NOT NULL,
  `ua_rbcu` varchar(10) NOT NULL,
  `ua_epiu` varchar(10) NOT NULL,
  `ua_bactu` varchar(10) NOT NULL,
  `ua_yeast` varchar(10) NOT NULL,
  `ua_mucosu` varchar(10) NOT NULL,
  `ua_amopu` varchar(10) NOT NULL,
  `ua_castu` varchar(10) NOT NULL,
  `ua_crystu` varchar(10) NOT NULL,
  `ua_otheru` varchar(10) NOT NULL,
  `stat_ua` varchar(20) NOT NULL,
  `reason_ua` varchar(100) DEFAULT NULL,
  `cbc_wbc` varchar(10) NOT NULL,
  `stat_wbc` varchar(20) NOT NULL,
  `reason_wbc` varchar(100) NOT NULL,
  `wbcrange` varchar(20) NOT NULL,
  `wbcflag` varchar(20) NOT NULL,
  `cbc_rbc` varchar(10) NOT NULL,
  `cbc_hb` varchar(10) NOT NULL,
  `cbc_hct` varchar(10) NOT NULL,
  `stat_hct` varchar(20) NOT NULL,
  `reason_hct` varchar(100) NOT NULL,
  `hctrange` varchar(20) NOT NULL,
  `hctflag` varchar(20) NOT NULL,
  `cbc_mcv` varchar(10) NOT NULL,
  `cbc_mch` varchar(10) NOT NULL,
  `cbc_mchc` varchar(10) NOT NULL,
  `cbc_pltc` varchar(10) NOT NULL,
  `stat_pltc` varchar(20) NOT NULL,
  `reason_pltc` varchar(100) NOT NULL,
  `pltcrange` varchar(20) NOT NULL,
  `pltcflag` varchar(20) NOT NULL,
  `cbc_plts` varchar(10) NOT NULL,
  `cbc_neu` varchar(10) NOT NULL,
  `cbc_lymp` varchar(10) NOT NULL,
  `cbc_mono` varchar(10) NOT NULL,
  `cbc_eos` varchar(10) NOT NULL,
  `cbc_baso` varchar(10) NOT NULL,
  `cbc_band` varchar(10) NOT NULL,
  `cbc_atyp` varchar(10) NOT NULL,
  `cbc_nrbc` varchar(10) NOT NULL,
  `cbc_rbcmor` varchar(10) NOT NULL,
  `cbc_other` varchar(10) NOT NULL,
  `stat_cbc` varchar(20) NOT NULL,
  `reason_cbc` varchar(100) DEFAULT NULL,
  `cxr` varchar(10) NOT NULL,
  `reason_cxr` varchar(100) DEFAULT NULL,
  `bs` varchar(10) NOT NULL,
  `stat_bs` varchar(20) NOT NULL,
  `reason_bs` varchar(100) DEFAULT NULL,
  `bsrange` varchar(20) NOT NULL,
  `bsflag` varchar(20) NOT NULL,
  `bun` varchar(10) NOT NULL,
  `stat_bun` varchar(20) NOT NULL,
  `reason_bun` varchar(100) DEFAULT NULL,
  `bunrange` varchar(20) NOT NULL,
  `bunflag` varchar(20) NOT NULL,
  `cr` varchar(10) NOT NULL,
  `stat_cr` varchar(20) NOT NULL,
  `reason_cr` varchar(100) DEFAULT NULL,
  `crrange` varchar(20) NOT NULL,
  `crflag` varchar(20) NOT NULL,
  `uric` varchar(10) NOT NULL,
  `stat_uric` varchar(20) NOT NULL,
  `reason_uric` varchar(100) DEFAULT NULL,
  `uricrange` varchar(20) NOT NULL,
  `uricflag` varchar(20) NOT NULL,
  `chol` varchar(10) NOT NULL,
  `stat_chol` varchar(20) NOT NULL,
  `reason_chol` varchar(100) DEFAULT NULL,
  `cholrange` varchar(20) NOT NULL,
  `cholflag` varchar(20) NOT NULL,
  `tg` varchar(10) NOT NULL,
  `stat_tg` varchar(20) NOT NULL,
  `reason_tg` varchar(100) DEFAULT NULL,
  `tgrange` varchar(20) NOT NULL,
  `tgflag` varchar(20) NOT NULL,
  `sgot` varchar(10) NOT NULL,
  `stat_sgot` varchar(20) NOT NULL,
  `reason_sgot` varchar(100) DEFAULT NULL,
  `sgotrange` varchar(20) NOT NULL,
  `sgotflag` varchar(20) NOT NULL,
  `sgpt` varchar(10) NOT NULL,
  `stat_sgpt` varchar(20) NOT NULL,
  `reason_sgpt` varchar(100) DEFAULT NULL,
  `sgptrange` varchar(20) NOT NULL,
  `sgptflag` varchar(20) NOT NULL,
  `alk` varchar(10) NOT NULL,
  `stat_alk` varchar(20) NOT NULL,
  `reason_alk` varchar(100) DEFAULT NULL,
  `alkrange` varchar(20) NOT NULL,
  `alkflag` varchar(20) NOT NULL,
  `general` varchar(10) DEFAULT NULL,
  `reason_general` varchar(100) DEFAULT NULL,
  `pap` varchar(10) NOT NULL,
  `reason_pap` varchar(100) DEFAULT NULL,
  `other1` varchar(100) DEFAULT NULL,
  `stat_other1` varchar(100) DEFAULT NULL,
  `reason_other1` varchar(100) DEFAULT NULL,
  `other2` varchar(100) DEFAULT NULL,
  `stat_other2` varchar(100) DEFAULT NULL,
  `reason_other2` varchar(100) DEFAULT NULL,
  `other3` varchar(100) NOT NULL,
  `stat_other3` varchar(100) NOT NULL,
  `reason_other3` varchar(100) NOT NULL,
  `other4` varchar(100) NOT NULL,
  `stat_other4` varchar(100) NOT NULL,
  `reason_other4` varchar(100) NOT NULL,
  `other5` varchar(100) NOT NULL,
  `stat_other5` varchar(100) NOT NULL,
  `reason_other5` varchar(100) NOT NULL,
  `other6` varchar(100) NOT NULL,
  `stat_other6` varchar(100) NOT NULL,
  `reason_other6` varchar(100) NOT NULL,
  `other7` varchar(100) NOT NULL,
  `stat_other7` varchar(100) NOT NULL,
  `reason_other7` varchar(100) NOT NULL,
  `dx` text NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `exercise` varchar(1) DEFAULT NULL,
  `summary` varchar(100) DEFAULT NULL,
  `diag` varchar(200) DEFAULT NULL,
  `soldier1` varchar(20) NOT NULL,
  `reason_sol1` varchar(100) NOT NULL,
  `soldier2` varchar(20) NOT NULL,
  `reason_sol2` varchar(100) NOT NULL,
  `soldier3` varchar(20) NOT NULL,
  `reason_sol3` varchar(100) NOT NULL,
  `soldier4` varchar(20) NOT NULL,
  `reason_sol4` varchar(100) NOT NULL,
  `soldier5` varchar(20) NOT NULL,
  `reason_sol5` varchar(100) NOT NULL,
  `soldier6` varchar(20) NOT NULL,
  `reason_sol6` varchar(100) NOT NULL,
  `soldier7` varchar(20) NOT NULL,
  `reason_sol7` varchar(100) NOT NULL,
  `soldier8` varchar(20) NOT NULL,
  `reason_sol8` varchar(100) NOT NULL,
  `soldier9` varchar(20) NOT NULL,
  `reason_sol9` varchar(100) NOT NULL,
  `soldier10` varchar(20) NOT NULL,
  `reason_sol10` varchar(100) NOT NULL,
  `status_dr` varchar(20) NOT NULL,
  `yearcheck` varchar(4) NOT NULL,
  `smbasic` varchar(100) NOT NULL,
  `smdm` varchar(5) NOT NULL,
  `smht` varchar(5) NOT NULL,
  `smstr` varchar(5) NOT NULL,
  `smobe` varchar(5) NOT NULL,
  `solution` varchar(100) NOT NULL,
  `printok` varchar(5) NOT NULL DEFAULT 'N',
  `sol1` varchar(100) NOT NULL,
  `sol2` varchar(100) NOT NULL,
  `sol3` varchar(100) NOT NULL,
  `sol4` varchar(100) NOT NULL,
  `sol41` varchar(100) NOT NULL,
  `sol5` varchar(100) NOT NULL,
  `sol51` varchar(100) NOT NULL,
  `sum1` varchar(100) NOT NULL,
  `sum2` varchar(100) NOT NULL,
  `rs_sum21` varchar(100) NOT NULL,
  `rs_sum22` varchar(100) NOT NULL,
  `rs_sum23` varchar(100) NOT NULL,
  `rs_sum24` varchar(100) NOT NULL,
  `rs_sum25` varchar(100) NOT NULL,
  `sum3` varchar(100) NOT NULL,
  `sum4` varchar(100) NOT NULL,
  `sum5` varchar(100) NOT NULL,
  `rs_sum51` varchar(100) NOT NULL,
  `rs_sum52` varchar(100) NOT NULL,
  `rs_sum53` varchar(100) NOT NULL,
  `sum6` varchar(100) NOT NULL,
  `rs_sum61` varchar(100) NOT NULL,
  `anemia` varchar(1) DEFAULT NULL,
  `cirrhosis` varchar(1) DEFAULT NULL,
  `hepatitis` varchar(1) DEFAULT NULL,
  `cardiomegaly` varchar(1) DEFAULT NULL,
  `allergy` varchar(1) DEFAULT NULL,
  `gout` varchar(1) DEFAULT NULL,
  `waistline` varchar(1) DEFAULT NULL,
  `asthma` varchar(1) DEFAULT NULL,
  `muscle` varchar(1) DEFAULT NULL,
  `ihd` varchar(1) DEFAULT NULL,
  `thyroid` varchar(1) DEFAULT NULL,
  `heart` varchar(1) DEFAULT NULL,
  `emphysema` varchar(1) DEFAULT NULL,
  `herniated` varchar(1) DEFAULT NULL,
  `conjunctivitis` varchar(1) DEFAULT NULL,
  `cystitis` varchar(1) DEFAULT NULL,
  `epilepsy` varchar(1) DEFAULT NULL,
  `fracture` varchar(1) DEFAULT NULL,
  `cardiac` varchar(1) DEFAULT NULL,
  `spine` varchar(1) DEFAULT NULL,
  `dermatitis` varchar(1) DEFAULT NULL,
  `degeneration` varchar(1) DEFAULT NULL,
  `alcoholic` varchar(1) DEFAULT NULL,
  `copd` varchar(1) DEFAULT NULL,
  `bph` varchar(1) DEFAULT NULL,
  `kidney` varchar(1) DEFAULT NULL,
  `pterygium` varchar(1) DEFAULT NULL,
  `tonsil` varchar(1) DEFAULT NULL,
  `paralysis` varchar(1) DEFAULT NULL,
  `blood` varchar(1) DEFAULT NULL,
  `conanemia` varchar(1) DEFAULT NULL,
  `ht` varchar(1) DEFAULT NULL,
  `stat_pressure` varchar(20) DEFAULT NULL,
  `reason_pressure` varchar(100) DEFAULT NULL,
  `stat_bmi` varchar(20) DEFAULT NULL,
  `reason_bmi` varchar(100) DEFAULT NULL,
  `report_status` varchar(1) NOT NULL,
  `statusdata` varchar(1) NOT NULL,
  `cure_disease` varchar(100) NOT NULL,
  `appoint` varchar(50) NOT NULL,
  `camp1` varchar(100) NOT NULL,
  `chunyot1` varchar(100) NOT NULL,
  `keymanual` varchar(1) NOT NULL,
  `gender` varchar(1) NOT NULL,
  `hdl` varchar(10) NOT NULL,
  `stat_hdl` varchar(20) NOT NULL,
  `reason_hdl` varchar(100) NOT NULL,
  `hdlrange` varchar(20) NOT NULL,
  `hdlflag` varchar(20) NOT NULL,
  `ldl` varchar(10) NOT NULL,
  `stat_ldl` varchar(20) NOT NULL,
  `reason_ldl` varchar(100) NOT NULL,
  `ldlrange` varchar(20) NOT NULL,
  `ldlflag` varchar(20) NOT NULL,
  `gfr` varchar(10) NOT NULL,
  `stat_gfr` varchar(20) NOT NULL,
  `reason_gfr` varchar(100) NOT NULL,
  `gfrrange` varchar(20) NOT NULL,
  `gfrflag` varchar(20) NOT NULL,
  `idcard` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `thdatehn` (`thdatehn`),
  KEY `thdatevn` (`thdatevn`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=12143 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for content
-- ----------------------------
DROP TABLE IF EXISTS `content`;
CREATE TABLE `content` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `page` varchar(10) DEFAULT NULL,
  `title` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=228 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for content_pst5
-- ----------------------------
DROP TABLE IF EXISTS `content_pst5`;
CREATE TABLE `content_pst5` (
  `row_id` int(6) NOT NULL AUTO_INCREMENT,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `code1` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code3` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code4` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code5` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code6` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code7` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code8` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code9` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code10` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code11` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code12` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code13` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code14` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code15` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code16` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code17` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code18` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code19` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code20` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code21` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code22` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code23` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code24` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code25` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code26` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code27` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code28` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code29` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code30` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code31` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code32` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code33` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code34` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code35` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code36` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code37` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code38` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code39` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code40` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code41` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code42` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code43` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code44` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code45` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code46` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code47` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code48` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code49` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code50` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code51` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code52` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code53` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code54` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code55` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code56` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code57` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code58` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code59` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code60` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code61` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code62` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code63` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code64` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code65` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code66` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code67` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code68` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code69` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code70` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code71` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code72` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code73` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code74` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code75` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code76` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code77` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code78` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code79` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code80` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code81` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code82` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code83` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code84` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code85` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code86` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code87` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code88` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code89` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code90` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code91` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code92` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code93` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code94` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code95` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code96` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code97` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code98` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code99` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=309 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for cscddata
-- ----------------------------
DROP TABLE IF EXISTS `cscddata`;
CREATE TABLE `cscddata` (
  `hn` varchar(30) DEFAULT NULL,
  `id` varchar(15) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `dateend` varchar(50) DEFAULT NULL,
  `status` char(2) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for datacscdcon
-- ----------------------------
DROP TABLE IF EXISTS `datacscdcon`;
CREATE TABLE `datacscdcon` (
  `hn` varchar(20) NOT NULL,
  `date` varchar(20) NOT NULL,
  `price` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dataset_clinic
-- ----------------------------
DROP TABLE IF EXISTS `dataset_clinic`;
CREATE TABLE `dataset_clinic` (
  `row_id` int(3) NOT NULL AUTO_INCREMENT,
  `code` int(2) unsigned zerofill NOT NULL,
  `name` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for dcstatus
-- ----------------------------
DROP TABLE IF EXISTS `dcstatus`;
CREATE TABLE `dcstatus` (
  `date` varchar(30) NOT NULL,
  `an` varchar(10) NOT NULL,
  `status` varchar(50) NOT NULL,
  `office` varchar(50) NOT NULL,
  `status2` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ddepart
-- ----------------------------
DROP TABLE IF EXISTS `ddepart`;
CREATE TABLE `ddepart` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `doctor` varchar(40) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `detail` varchar(40) DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `sumyprice` double(11,2) DEFAULT NULL,
  `sumnprice` double(11,2) DEFAULT NULL,
  `paid` double(11,2) DEFAULT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `diag` varchar(48) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `tvn` varchar(12) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `whokey` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ddrugrx
-- ----------------------------
DROP TABLE IF EXISTS `ddrugrx`;
CREATE TABLE `ddrugrx` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `salepri` double(10,2) NOT NULL DEFAULT '0.00',
  `freepri` double(10,2) NOT NULL DEFAULT '0.00',
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `slcode` varchar(20) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `drug_inject_amount` varchar(50) DEFAULT NULL,
  `drug_inject_unit` varchar(50) NOT NULL,
  `drug_inject_amount2` varchar(50) NOT NULL,
  `drug_inject_unit2` varchar(50) NOT NULL,
  `drug_inject_time` varchar(50) NOT NULL,
  `drug_inject_slip` varchar(50) DEFAULT NULL,
  `drug_inject_type` varchar(50) DEFAULT NULL,
  `drug_inject_etc` varchar(50) DEFAULT NULL,
  `office` varchar(50) DEFAULT NULL,
  `reason` varchar(100) NOT NULL,
  `drug_return` varchar(1) NOT NULL DEFAULT '0',
  `DPY` varchar(10) NOT NULL,
  `DPN` varchar(10) NOT NULL,
  `drugorderdr` int(6) NOT NULL DEFAULT '0',
  `date_notsk` varchar(30) NOT NULL,
  `injno` varchar(20) NOT NULL,
  `indicator` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `idno` (`idno`),
  KEY `drugcode` (`drugcode`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=6160692 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ddrugrx_pt
-- ----------------------------
DROP TABLE IF EXISTS `ddrugrx_pt`;
CREATE TABLE `ddrugrx_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `salepri` double(10,2) NOT NULL DEFAULT '0.00',
  `freepri` double(10,2) NOT NULL DEFAULT '0.00',
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `slcode` varchar(10) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `drug_inject_amount` varchar(50) DEFAULT NULL,
  `drug_inject_unit` varchar(50) NOT NULL,
  `drug_inject_amount2` varchar(50) NOT NULL,
  `drug_inject_unit2` varchar(50) NOT NULL,
  `drug_inject_time` varchar(50) NOT NULL,
  `drug_inject_slip` varchar(50) DEFAULT NULL,
  `drug_inject_type` varchar(50) DEFAULT NULL,
  `drug_inject_etc` varchar(50) DEFAULT NULL,
  `office` varchar(50) DEFAULT NULL,
  `reason` varchar(100) NOT NULL,
  `drug_return` varchar(1) NOT NULL DEFAULT '0',
  `DPY` varchar(10) NOT NULL,
  `DPN` varchar(10) NOT NULL,
  `drugorderdr` int(6) NOT NULL DEFAULT '0',
  `date_notsk` varchar(30) NOT NULL,
  `injno` varchar(20) NOT NULL,
  `indicator` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `idno` (`idno`),
  KEY `drugcode` (`drugcode`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for death
-- ----------------------------
DROP TABLE IF EXISTS `death`;
CREATE TABLE `death` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) NOT NULL,
  `pid` varchar(14) DEFAULT NULL,
  `runno` varchar(50) NOT NULL,
  `hn` varchar(50) NOT NULL,
  `hospdeath` varchar(5) DEFAULT NULL,
  `an` varchar(10) DEFAULT NULL,
  `seq` varchar(8) DEFAULT NULL,
  `ddeath` date DEFAULT NULL,
  `cdeath_a` varchar(6) DEFAULT NULL,
  `cdeath_b` varchar(6) DEFAULT NULL,
  `cdeath_c` varchar(6) DEFAULT NULL,
  `cdeath_d` varchar(6) DEFAULT NULL,
  `odisease` varchar(6) DEFAULT NULL,
  `cdeath` varchar(6) DEFAULT NULL,
  `pregdeath` varchar(1) DEFAULT NULL,
  `pdeath` varchar(1) DEFAULT NULL,
  `provider` varchar(15) NOT NULL,
  `d_update` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=440 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for death43
-- ----------------------------
DROP TABLE IF EXISTS `death43`;
CREATE TABLE `death43` (
  `id` bigint(8) unsigned zerofill NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) DEFAULT NULL,
  `PID` varchar(15) DEFAULT NULL,
  `HOSPDEATH` varchar(5) DEFAULT NULL,
  `AN` varchar(9) DEFAULT NULL,
  `SEQ` varchar(16) DEFAULT NULL,
  `DDEATH` varchar(8) DEFAULT NULL,
  `CDEATH_A` varchar(6) DEFAULT NULL,
  `CDEATH_B` varchar(6) DEFAULT NULL,
  `CDEATH_C` varchar(6) DEFAULT NULL,
  `CDEATH_D` varchar(6) DEFAULT NULL,
  `ODISEASE` varchar(6) DEFAULT NULL,
  `CDEATH` varchar(6) DEFAULT NULL,
  `PREGDEATH` varchar(1) DEFAULT NULL,
  `PDEATH` varchar(1) DEFAULT NULL,
  `PROVIDER` varchar(15) DEFAULT NULL,
  `D_UPDATE` datetime DEFAULT NULL,
  `CID` varchar(13) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=157 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for debug
-- ----------------------------
DROP TABLE IF EXISTS `debug`;
CREATE TABLE `debug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for default_drug
-- ----------------------------
DROP TABLE IF EXISTS `default_drug`;
CREATE TABLE `default_drug` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `doctorcode` varchar(255) DEFAULT NULL,
  `drugcode` varchar(255) DEFAULT NULL,
  `amount` int(11) DEFAULT NULL,
  `slcode` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `tradname` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=321 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for den_agesurvey
-- ----------------------------
DROP TABLE IF EXISTS `den_agesurvey`;
CREATE TABLE `den_agesurvey` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_add` date DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `age` int(11) DEFAULT NULL,
  `hn` varchar(45) DEFAULT NULL,
  `data` text,
  `doctor` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `date_save` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for depart
-- ----------------------------
DROP TABLE IF EXISTS `depart`;
CREATE TABLE `depart` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `doctor` varchar(40) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `detail` varchar(100) DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `sumyprice` double(11,2) DEFAULT NULL,
  `sumnprice` double(11,2) DEFAULT NULL,
  `paid` double(11,2) NOT NULL DEFAULT '0.00',
  `idname` varchar(32) DEFAULT NULL,
  `diag` varchar(48) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `tvn` varchar(12) DEFAULT NULL,
  `ptright` varchar(30) DEFAULT NULL,
  `lab` varchar(4) DEFAULT NULL,
  `cashok` varchar(20) DEFAULT NULL,
  `detailbydr` text NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `priority` varchar(2) NOT NULL,
  `patient_from` varchar(10) NOT NULL,
  `staf_massage` varchar(50) NOT NULL,
  `lastupdate` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=4703834 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for depart_log
-- ----------------------------
DROP TABLE IF EXISTS `depart_log`;
CREATE TABLE `depart_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idno` int(11) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=80 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for departments
-- ----------------------------
DROP TABLE IF EXISTS `departments`;
CREATE TABLE `departments` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'y',
  `statusdc` varchar(1) NOT NULL,
  `cms` varchar(1) NOT NULL,
  `sOr` varchar(1) DEFAULT NULL,
  `phar` varchar(1) NOT NULL,
  `pc` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for detail_ofyear
-- ----------------------------
DROP TABLE IF EXISTS `detail_ofyear`;
CREATE TABLE `detail_ofyear` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` varchar(20) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `camp` varchar(100) NOT NULL,
  `dbirth` varchar(100) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `address` varchar(20) DEFAULT NULL,
  `tambol` varchar(20) DEFAULT NULL,
  `amphur` varchar(20) DEFAULT NULL,
  `province` varchar(20) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `sex` varchar(10) NOT NULL,
  `education` varchar(100) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `round` varchar(10) NOT NULL,
  `bs` varchar(10) NOT NULL,
  `bs2` varchar(5) NOT NULL,
  `hours` varchar(10) NOT NULL,
  `pause` varchar(5) NOT NULL,
  `bp1` varchar(5) NOT NULL,
  `bp2` varchar(5) NOT NULL,
  `bp3` varchar(5) NOT NULL,
  `bp4` varchar(5) NOT NULL,
  `excercise` varchar(100) NOT NULL,
  `detailex` varchar(200) NOT NULL,
  `exother` varchar(100) DEFAULT NULL,
  `food` varchar(100) NOT NULL,
  `cig` varchar(50) NOT NULL,
  `detailcig1` varchar(20) NOT NULL,
  `detailcig2` varchar(20) NOT NULL,
  `detailcig3` varchar(20) NOT NULL,
  `detailcig4` varchar(20) DEFAULT NULL,
  `alco` varchar(50) NOT NULL,
  `detailalco` varchar(10) NOT NULL,
  `unitname` varchar(100) NOT NULL,
  `unitpro` varchar(100) NOT NULL,
  `unitdate` varchar(100) NOT NULL,
  `yearchk` varchar(4) DEFAULT NULL,
  `dental` varchar(10) NOT NULL,
  `den1` varchar(100) DEFAULT NULL,
  `den2` varchar(100) DEFAULT NULL,
  `adviceden1` varchar(100) NOT NULL,
  `adviceden2` varchar(100) NOT NULL,
  `adviceden3` varchar(100) NOT NULL,
  `adviceden4` varchar(100) NOT NULL,
  `otherden` varchar(100) NOT NULL,
  `smbasic` varchar(100) NOT NULL,
  `smdm` varchar(20) NOT NULL,
  `smht` varchar(20) NOT NULL,
  `smstr` varchar(20) NOT NULL,
  `smobe` varchar(20) NOT NULL,
  `smchol` varchar(20) NOT NULL,
  `smchol2` varchar(20) NOT NULL,
  `cholresult` varchar(20) NOT NULL,
  `solution` varchar(100) NOT NULL,
  `solution2` varchar(200) NOT NULL,
  `solution3` varchar(200) NOT NULL,
  `summary` varchar(100) NOT NULL,
  `diag` varchar(200) NOT NULL,
  `selfresult` varchar(100) NOT NULL,
  `chkold` varchar(100) NOT NULL,
  `detailold` varchar(100) NOT NULL,
  `accept` varchar(100) NOT NULL,
  `unithos` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1041 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for detail_ofyear2
-- ----------------------------
DROP TABLE IF EXISTS `detail_ofyear2`;
CREATE TABLE `detail_ofyear2` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` varchar(20) DEFAULT NULL,
  `typerelative` varchar(20) DEFAULT NULL,
  `dm` varchar(100) DEFAULT NULL,
  `drugdm` varchar(100) DEFAULT NULL,
  `ht` varchar(100) DEFAULT NULL,
  `drught` varchar(100) NOT NULL,
  `mi` varchar(100) DEFAULT NULL,
  `gout` varchar(100) DEFAULT NULL,
  `crf` varchar(100) DEFAULT NULL,
  `copd` varchar(100) DEFAULT NULL,
  `stroke` varchar(100) DEFAULT NULL,
  `non` varchar(100) DEFAULT NULL,
  `other` varchar(100) DEFAULT NULL,
  `nothave` varchar(100) NOT NULL,
  `liver` varchar(100) DEFAULT NULL,
  `drugliver` varchar(100) DEFAULT NULL,
  `palsy` varchar(100) DEFAULT NULL,
  `drugpalsy` varchar(100) NOT NULL,
  `heart` varchar(100) DEFAULT NULL,
  `drugheart` varchar(100) NOT NULL,
  `fat` varchar(100) DEFAULT NULL,
  `drugfat` varchar(100) NOT NULL,
  `foot` varchar(100) DEFAULT NULL,
  `confined` varchar(100) DEFAULT NULL,
  `otherself` varchar(100) NOT NULL,
  `pa1heart` varchar(100) NOT NULL,
  `pa2heart` varchar(100) NOT NULL,
  `boyheart` varchar(100) NOT NULL,
  `girlheart` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3127 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for detail_ofyear3
-- ----------------------------
DROP TABLE IF EXISTS `detail_ofyear3`;
CREATE TABLE `detail_ofyear3` (
  `cid` varchar(20) NOT NULL DEFAULT '',
  `cid1` varchar(10) NOT NULL DEFAULT '',
  `cid2` varchar(10) DEFAULT NULL,
  `cid3` varchar(10) DEFAULT NULL,
  `cid4` varchar(10) DEFAULT NULL,
  `cid5` varchar(10) DEFAULT NULL,
  `cid6` varchar(10) DEFAULT NULL,
  `cid7` varchar(10) NOT NULL,
  `cid8` varchar(10) NOT NULL,
  `cid9` varchar(10) NOT NULL,
  `cid10` varchar(10) NOT NULL,
  `cid11` varchar(10) NOT NULL,
  `cid12` varchar(10) NOT NULL,
  `cid13` varchar(10) NOT NULL,
  `cid14` varchar(10) NOT NULL,
  `cid15` varchar(10) NOT NULL,
  `cid16` varchar(10) NOT NULL,
  `cid17` varchar(10) NOT NULL,
  `cid18` varchar(10) NOT NULL,
  `cid19` varchar(10) NOT NULL,
  `cid20` varchar(10) NOT NULL,
  `cid21` varchar(10) NOT NULL,
  `otherself2` varchar(100) NOT NULL,
  PRIMARY KEY (`cid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for detail_receipt
-- ----------------------------
DROP TABLE IF EXISTS `detail_receipt`;
CREATE TABLE `detail_receipt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `row_receipt` varchar(50) NOT NULL,
  `detail_pay` varchar(100) NOT NULL,
  `cashy` double(10,2) NOT NULL,
  `cashn` double(10,2) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13329 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for detail_receipt2
-- ----------------------------
DROP TABLE IF EXISTS `detail_receipt2`;
CREATE TABLE `detail_receipt2` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `row_receipt` int(11) NOT NULL,
  `1y` double(10,2) NOT NULL,
  `1n` double(10,2) NOT NULL,
  `1sy` double(10,2) NOT NULL,
  `1sn` double(10,2) NOT NULL,
  `2y` double(10,2) NOT NULL,
  `2n` double(10,2) NOT NULL,
  `3y` double(10,2) NOT NULL,
  `3n` double(10,2) NOT NULL,
  `4y` double(10,2) NOT NULL,
  `4n` double(10,2) NOT NULL,
  `5y` double(10,2) NOT NULL,
  `5n` double(10,2) NOT NULL,
  `6y` double(10,2) NOT NULL,
  `6n` double(10,2) NOT NULL,
  `7y` double(10,2) NOT NULL,
  `7n` double(10,2) NOT NULL,
  `8y` double(10,2) NOT NULL,
  `8n` double(10,2) NOT NULL,
  `9y` double(10,2) NOT NULL,
  `9n` double(10,2) NOT NULL,
  `10y` double(10,2) NOT NULL,
  `10n` double(10,2) NOT NULL,
  `11y` double(10,2) NOT NULL,
  `11n` double(10,2) NOT NULL,
  `12y` double(10,2) NOT NULL,
  `12n` double(10,2) NOT NULL,
  `13y` double(10,2) NOT NULL,
  `13n` double(10,2) NOT NULL,
  `14y` double(10,2) NOT NULL,
  `14n` double(10,2) NOT NULL,
  `15y` double(10,2) NOT NULL,
  `15n` double(10,2) NOT NULL,
  `16y` double(10,2) NOT NULL,
  `16n` double(10,2) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dgprofile
-- ----------------------------
DROP TABLE IF EXISTS `dgprofile`;
CREATE TABLE `dgprofile` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `salepri` double(10,2) DEFAULT NULL,
  `freepri` double(10,2) NOT NULL DEFAULT '0.00',
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `slcode` varchar(10) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `statcon` varchar(5) DEFAULT NULL,
  `onoff` varchar(4) DEFAULT NULL,
  `dateoff` datetime DEFAULT NULL,
  `officer` varchar(32) DEFAULT NULL,
  `firstdate` date NOT NULL,
  `enddate` date NOT NULL,
  `ranktime` varchar(50) NOT NULL,
  `ranktime1` varchar(10) NOT NULL,
  `ranktime2` varchar(10) NOT NULL,
  `ranktime3` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `an` (`an`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=854707 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for dgprofile_approve
-- ----------------------------
DROP TABLE IF EXISTS `dgprofile_approve`;
CREATE TABLE `dgprofile_approve` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) NOT NULL,
  `an` varchar(12) DEFAULT NULL,
  `period` varchar(20) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `nurse` varchar(100) DEFAULT NULL,
  `lastupdate` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for dgprofile_mar
-- ----------------------------
DROP TABLE IF EXISTS `dgprofile_mar`;
CREATE TABLE `dgprofile_mar` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `slcode` varchar(10) NOT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `nurse1` varchar(100) DEFAULT NULL,
  `nurse2` varchar(100) DEFAULT NULL,
  `ranktime` varchar(50) NOT NULL,
  `register_time` varchar(20) NOT NULL,
  `comment` text NOT NULL,
  `lastupdate` datetime NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `an` (`an`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for diabetes_clinic
-- ----------------------------
DROP TABLE IF EXISTS `diabetes_clinic`;
CREATE TABLE `diabetes_clinic` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `dm_no` int(11) DEFAULT NULL,
  `thidate` varchar(50) NOT NULL,
  `dateN` varchar(20) DEFAULT NULL,
  `hn` varchar(30) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `dbbirt` varchar(30) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `diagnosis` varchar(10) NOT NULL,
  `diagdetail` varchar(50) NOT NULL,
  `ht` varchar(10) NOT NULL,
  `htdetail` varchar(50) NOT NULL,
  `smork` varchar(10) NOT NULL,
  `bw` varchar(20) NOT NULL,
  `bmi` varchar(20) NOT NULL,
  `retinal` varchar(20) NOT NULL,
  `foot` varchar(20) NOT NULL,
  `l_bs` varchar(20) NOT NULL,
  `l_hbalc` varchar(20) NOT NULL,
  `l_ldl` varchar(20) NOT NULL,
  `l_creatinine` varchar(20) NOT NULL,
  `l_urine` varchar(20) NOT NULL,
  `l_microal` varchar(20) NOT NULL,
  `foot_care` varchar(10) NOT NULL,
  `nutrition` varchar(10) NOT NULL,
  `exercise` varchar(10) NOT NULL,
  `smoking` varchar(10) NOT NULL,
  `admit_dia` varchar(10) NOT NULL,
  `dt_heart` varchar(10) NOT NULL,
  `dt_brain` varchar(10) NOT NULL,
  `height` varchar(30) NOT NULL,
  `weight` varchar(30) NOT NULL,
  `round` varchar(30) NOT NULL,
  `temperature` varchar(30) NOT NULL,
  `pause` varchar(30) NOT NULL,
  `rate` varchar(30) NOT NULL,
  `bp1` varchar(30) NOT NULL,
  `bp2` varchar(30) NOT NULL,
  `officer` varchar(100) NOT NULL,
  `officer_edit` varchar(100) NOT NULL,
  `register_date` varchar(40) NOT NULL,
  `ht_etc` text NOT NULL,
  `retinal_date` datetime NOT NULL,
  `foot_date` datetime NOT NULL,
  `tooth_date` date NOT NULL,
  `tooth` varchar(1) NOT NULL,
  `l_ua` varchar(255) DEFAULT NULL,
  `date_footcare` date DEFAULT NULL,
  `date_nutrition` date DEFAULT NULL,
  `date_exercise` date DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `thidate` (`thidate`),
  KEY `dateN` (`dateN`)
) ENGINE=MyISAM AUTO_INCREMENT=4004 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for diabetes_clinic_history
-- ----------------------------
DROP TABLE IF EXISTS `diabetes_clinic_history`;
CREATE TABLE `diabetes_clinic_history` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `dm_no` int(11) DEFAULT NULL,
  `thidate` varchar(50) NOT NULL,
  `dateN` varchar(20) DEFAULT NULL,
  `hn` varchar(30) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `dbbirt` varchar(30) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `diagnosis` varchar(10) NOT NULL,
  `diagdetail` varchar(50) NOT NULL,
  `ht` varchar(10) NOT NULL,
  `htdetail` varchar(50) NOT NULL,
  `smork` varchar(10) NOT NULL,
  `bw` varchar(20) NOT NULL,
  `bmi` varchar(20) NOT NULL,
  `retinal` varchar(20) NOT NULL,
  `foot` varchar(20) NOT NULL,
  `l_bs` varchar(20) NOT NULL,
  `l_hbalc` varchar(20) NOT NULL,
  `l_ldl` varchar(20) NOT NULL,
  `l_creatinine` varchar(20) NOT NULL,
  `l_urine` varchar(20) NOT NULL,
  `l_microal` varchar(20) NOT NULL,
  `foot_care` varchar(10) NOT NULL,
  `nutrition` varchar(10) NOT NULL,
  `exercise` varchar(10) NOT NULL,
  `smoking` varchar(10) NOT NULL,
  `admit_dia` varchar(10) NOT NULL,
  `dt_heart` varchar(10) NOT NULL,
  `dt_brain` varchar(10) NOT NULL,
  `height` varchar(30) NOT NULL,
  `weight` varchar(30) NOT NULL,
  `round` varchar(30) NOT NULL,
  `temperature` varchar(30) NOT NULL,
  `pause` varchar(30) NOT NULL,
  `rate` varchar(30) NOT NULL,
  `bp1` varchar(30) NOT NULL,
  `bp2` varchar(30) NOT NULL,
  `officer` varchar(100) NOT NULL,
  `officer_edit` varchar(100) NOT NULL,
  `register_date` varchar(40) NOT NULL,
  `added_date` datetime NOT NULL,
  `edited_date` datetime NOT NULL,
  `ht_etc` text NOT NULL,
  `edited_user` varchar(255) NOT NULL,
  `retinal_date` datetime NOT NULL,
  `foot_date` datetime NOT NULL,
  `dummy_no` varchar(255) NOT NULL,
  `tooth_date` date NOT NULL,
  `tooth` varchar(1) NOT NULL,
  `l_ua` varchar(255) DEFAULT NULL,
  `date_footcare` date DEFAULT NULL,
  `date_nutrition` date DEFAULT NULL,
  `date_exercise` date DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `thidate` (`thidate`),
  KEY `hn` (`hn`),
  KEY `dateN` (`dateN`),
  KEY `dummy_no` (`dummy_no`)
) ENGINE=MyISAM AUTO_INCREMENT=22864 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for diabetes_lab
-- ----------------------------
DROP TABLE IF EXISTS `diabetes_lab`;
CREATE TABLE `diabetes_lab` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `dm_no` varchar(10) NOT NULL,
  `labname` varchar(50) NOT NULL,
  `result_lab` varchar(50) NOT NULL,
  `dateY` varchar(50) NOT NULL,
  `dummy_no` varchar(255) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `dm_no` (`dm_no`),
  KEY `labname` (`labname`),
  KEY `dateY` (`dateY`),
  KEY `dummy_no` (`dummy_no`)
) ENGINE=MyISAM AUTO_INCREMENT=111553 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for diag
-- ----------------------------
DROP TABLE IF EXISTS `diag`;
CREATE TABLE `diag` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `regisdate` varchar(20) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `an` varchar(20) NOT NULL,
  `diag` varchar(100) NOT NULL,
  `icd10` varchar(50) NOT NULL,
  `type` varchar(50) NOT NULL,
  `office` varchar(100) DEFAULT NULL,
  `diag_thai` varchar(100) NOT NULL,
  `svdate` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  `regisdate_en` varchar(10) DEFAULT NULL,
  `svdate_en` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `an` (`an`),
  KEY `icd10` (`icd10`),
  KEY `svdate_en` (`svdate_en`),
  KEY `regisdate_en` (`regisdate_en`)
) ENGINE=MyISAM AUTO_INCREMENT=3117513 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for digital_opcard
-- ----------------------------
DROP TABLE IF EXISTS `digital_opcard`;
CREATE TABLE `digital_opcard` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `opcard_id` int(11) NOT NULL,
  `opday_id` int(11) NOT NULL,
  `doctor` text NOT NULL,
  `clinic` text NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `actual_date` datetime NOT NULL,
  `last_update` datetime NOT NULL,
  `upload_type` varchar(10) NOT NULL,
  `officer` text NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB AUTO_INCREMENT=167947 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for disabilities
-- ----------------------------
DROP TABLE IF EXISTS `disabilities`;
CREATE TABLE `disabilities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for DISABILITY
-- ----------------------------
DROP TABLE IF EXISTS `DISABILITY`;
CREATE TABLE `DISABILITY` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) NOT NULL,
  `DISABTYPE` int(11) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for disability43
-- ----------------------------
DROP TABLE IF EXISTS `disability43`;
CREATE TABLE `disability43` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `disabid` varchar(13) DEFAULT NULL,
  `pid` varchar(15) DEFAULT NULL,
  `disabtype` varchar(1) DEFAULT NULL,
  `disabcause` varchar(1) DEFAULT NULL,
  `diagcode` varchar(6) DEFAULT NULL,
  `date_detect` varchar(8) DEFAULT NULL,
  `date_disab` varchar(8) DEFAULT NULL,
  `d_update` varchar(14) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `opday_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2717 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for disabled_user
-- ----------------------------
DROP TABLE IF EXISTS `disabled_user`;
CREATE TABLE `disabled_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(255) DEFAULT NULL,
  `idcard` varchar(255) DEFAULT NULL,
  `disabid` varchar(255) DEFAULT NULL,
  `icf` varchar(255) DEFAULT NULL,
  `disabtype` varchar(255) DEFAULT NULL,
  `disabcause` varchar(255) DEFAULT NULL,
  `date_detect` varchar(255) DEFAULT NULL,
  `date_disab` varchar(255) DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=690 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for district_new
-- ----------------------------
DROP TABLE IF EXISTS `district_new`;
CREATE TABLE `district_new` (
  `DISTRICT_ID` int(5) NOT NULL AUTO_INCREMENT,
  `DISTRICT_CODE` varchar(6) DEFAULT NULL,
  `DISTRICT_NAME` varchar(150) DEFAULT NULL,
  `AMPHUR_ID` int(5) DEFAULT '0',
  `PROVINCE_ID` int(5) DEFAULT '0',
  `GEO_ID` int(5) DEFAULT '0',
  PRIMARY KEY (`DISTRICT_ID`),
  KEY `AMPHUR_ID` (`AMPHUR_ID`),
  KEY `district_new_NAME` (`DISTRICT_NAME`)
) ENGINE=MyISAM AUTO_INCREMENT=8861 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for districts
-- ----------------------------
DROP TABLE IF EXISTS `districts`;
CREATE TABLE `districts` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `amphur_id` int(5) NOT NULL DEFAULT '0',
  `province_id` int(5) NOT NULL DEFAULT '0',
  `geo_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8861 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for doctor
-- ----------------------------
DROP TABLE IF EXISTS `doctor`;
CREATE TABLE `doctor` (
  `row_id` int(10) NOT NULL AUTO_INCREMENT,
  `yot` varchar(50) NOT NULL,
  `yot2` varchar(120) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `doctorcode` varchar(5) DEFAULT NULL,
  `position2` varchar(120) NOT NULL,
  `status` varchar(1) DEFAULT NULL,
  `menucode` varchar(30) NOT NULL DEFAULT 'ADM',
  `position` varchar(50) NOT NULL,
  `monday` varchar(1) NOT NULL,
  `tuesday` varchar(1) NOT NULL,
  `wednesday` varchar(1) NOT NULL,
  `thursday` varchar(1) NOT NULL,
  `friday` varchar(1) NOT NULL,
  `room` varchar(50) DEFAULT NULL,
  `rowshow` varchar(2) NOT NULL,
  `room_app` varchar(20) DEFAULT NULL,
  `erstatus` varchar(1) NOT NULL,
  `opdstatus` varchar(1) NOT NULL,
  `rg_status` varchar(2) NOT NULL,
  `clinic` varchar(100) NOT NULL,
  `queue_code` varchar(2) NOT NULL,
  `queue_status` varchar(1) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=201 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for doctor_off
-- ----------------------------
DROP TABLE IF EXISTS `doctor_off`;
CREATE TABLE `doctor_off` (
  `row_id` int(2) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `part` varchar(70) NOT NULL DEFAULT '',
  `date_off` varchar(30) DEFAULT '0000-00-00',
  `doctor` varchar(50) NOT NULL DEFAULT '',
  `office` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=207 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for document
-- ----------------------------
DROP TABLE IF EXISTS `document`;
CREATE TABLE `document` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(20) NOT NULL,
  `depart` varchar(50) NOT NULL,
  `doc_name` varchar(255) DEFAULT NULL,
  `post_name` varchar(50) NOT NULL,
  `doc_date` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4101 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for document_file
-- ----------------------------
DROP TABLE IF EXISTS `document_file`;
CREATE TABLE `document_file` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(20) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `name_thai` varchar(100) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4928 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dorderbmd
-- ----------------------------
DROP TABLE IF EXISTS `dorderbmd`;
CREATE TABLE `dorderbmd` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `an` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `code` varchar(10) NOT NULL,
  `item` varchar(5) NOT NULL,
  `detail` varchar(200) NOT NULL,
  `price` double(10,2) NOT NULL,
  `sumyprice` double(10,2) NOT NULL,
  `sumnprice` double(10,2) NOT NULL,
  `tvn` varchar(5) NOT NULL,
  `ptright` varchar(100) DEFAULT NULL,
  `idno` varchar(10) NOT NULL,
  `status` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dpatdata
-- ----------------------------
DROP TABLE IF EXISTS `dpatdata`;
CREATE TABLE `dpatdata` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `ptname` varchar(30) DEFAULT NULL,
  `copy` char(1) DEFAULT NULL,
  `doctor` varchar(40) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `detail` varchar(40) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `yprice` double(10,2) DEFAULT NULL,
  `nprice` double(10,2) DEFAULT NULL,
  `paid` double(10,2) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `labcode` varchar(5) DEFAULT NULL,
  `report` mediumtext,
  `part` varchar(8) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `picture` varchar(32) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dphardep
-- ----------------------------
DROP TABLE IF EXISTS `dphardep`;
CREATE TABLE `dphardep` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) NOT NULL DEFAULT '0.00',
  `doctor` varchar(40) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `idname` varchar(50) DEFAULT NULL,
  `diag` varchar(48) DEFAULT NULL,
  `essd` double(10,2) DEFAULT NULL,
  `nessdy` double(10,2) DEFAULT NULL,
  `nessdn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `dgtake` datetime DEFAULT NULL,
  `tvn` varchar(12) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `whokey` varchar(8) DEFAULT NULL,
  `stkcutdate` varchar(30) DEFAULT NULL,
  `dr_cancle` char(1) DEFAULT NULL,
  `kew` varchar(4) DEFAULT NULL,
  `pharin` varchar(30) DEFAULT NULL,
  `pharout` varchar(30) DEFAULT NULL,
  `kewphar` varchar(20) NOT NULL DEFAULT '',
  `pharout1` varchar(30) NOT NULL,
  `department` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=1835107 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dphardep_pt
-- ----------------------------
DROP TABLE IF EXISTS `dphardep_pt`;
CREATE TABLE `dphardep_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) NOT NULL DEFAULT '0.00',
  `doctor` varchar(40) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `idname` varchar(50) DEFAULT NULL,
  `diag` varchar(48) DEFAULT NULL,
  `essd` double(10,2) DEFAULT NULL,
  `nessdy` double(10,2) DEFAULT NULL,
  `nessdn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `dgtake` datetime DEFAULT NULL,
  `tvn` varchar(12) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `whokey` varchar(8) DEFAULT NULL,
  `stkcutdate` varchar(30) DEFAULT NULL,
  `dr_cancle` char(1) DEFAULT NULL,
  `kew` varchar(4) DEFAULT NULL,
  `pharin` varchar(30) DEFAULT NULL,
  `pharout` varchar(30) DEFAULT NULL,
  `kewphar` varchar(20) NOT NULL DEFAULT '',
  `pharout1` varchar(30) NOT NULL,
  `cashok` varchar(10) DEFAULT NULL,
  `borrow` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dpy
-- ----------------------------
DROP TABLE IF EXISTS `dpy`;
CREATE TABLE `dpy` (
  `code` varchar(10) DEFAULT NULL,
  `detail` varchar(200) DEFAULT NULL,
  `price` float NOT NULL,
  `ex` varchar(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dr_colonoscopy
-- ----------------------------
DROP TABLE IF EXISTS `dr_colonoscopy`;
CREATE TABLE `dr_colonoscopy` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(40) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `an` varchar(20) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `ptright` varchar(30) NOT NULL,
  `datehn` varchar(40) NOT NULL,
  `gender` varchar(20) NOT NULL,
  `ward` varchar(30) NOT NULL,
  `financial` varchar(100) NOT NULL,
  `endo1` varchar(100) NOT NULL,
  `endo2` varchar(100) NOT NULL,
  `consul` varchar(100) NOT NULL,
  `anesthesist` varchar(100) NOT NULL,
  `instrument` varchar(100) NOT NULL,
  `anesthesiaa` varchar(100) NOT NULL,
  `medication` varchar(100) NOT NULL,
  `indication` varchar(100) NOT NULL,
  `pre_diagnosis` varchar(100) NOT NULL,
  `brief` varchar(100) NOT NULL,
  `consent` varchar(100) NOT NULL,
  `anal` varchar(100) NOT NULL,
  `rectun` varchar(100) NOT NULL,
  `sigmoid` varchar(100) NOT NULL,
  `desending` varchar(100) NOT NULL,
  `splenic` varchar(100) NOT NULL,
  `transverse` varchar(100) NOT NULL,
  `hepatic` varchar(100) NOT NULL,
  `ascending` varchar(100) NOT NULL,
  `cecum` varchar(100) NOT NULL,
  `terminal` varchar(100) NOT NULL,
  `bowel` varchar(100) NOT NULL,
  `post_diag` varchar(100) NOT NULL,
  `complication` varchar(100) NOT NULL,
  `histopatho` varchar(100) NOT NULL,
  `therapy` varchar(100) NOT NULL,
  `recommen` varchar(100) NOT NULL,
  `note` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=273 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dr_daily
-- ----------------------------
DROP TABLE IF EXISTS `dr_daily`;
CREATE TABLE `dr_daily` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor` text,
  `date_daily` varchar(50) NOT NULL,
  `time_daily` varchar(50) NOT NULL,
  `room_no` varchar(50) NOT NULL,
  `apppoint` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dr_drugsuit
-- ----------------------------
DROP TABLE IF EXISTS `dr_drugsuit`;
CREATE TABLE `dr_drugsuit` (
  `row_id` int(2) NOT NULL AUTO_INCREMENT,
  `date_formula` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `name_formula` varchar(80) NOT NULL DEFAULT '',
  `code_dr` varchar(50) NOT NULL DEFAULT '',
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1011 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dr_drugsuit_detail
-- ----------------------------
DROP TABLE IF EXISTS `dr_drugsuit_detail`;
CREATE TABLE `dr_drugsuit_detail` (
  `row_id` int(2) NOT NULL AUTO_INCREMENT,
  `for_id` int(2) NOT NULL DEFAULT '0',
  `drugcode` varchar(50) NOT NULL DEFAULT '',
  `amount` double NOT NULL DEFAULT '0',
  `slcode` varchar(10) NOT NULL DEFAULT '',
  `drug_inject_amount` varchar(5) NOT NULL,
  `drug_inject_slip` varchar(10) NOT NULL,
  `drug_inject_type` varchar(12) NOT NULL,
  `drug_inject_etc` varchar(70) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4638 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dr_esophago
-- ----------------------------
DROP TABLE IF EXISTS `dr_esophago`;
CREATE TABLE `dr_esophago` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(10) NOT NULL,
  `an` varchar(10) NOT NULL,
  `datehn` varchar(20) NOT NULL,
  `ptname` varchar(150) NOT NULL,
  `age` varchar(20) NOT NULL,
  `gender` varchar(8) NOT NULL,
  `no` smallint(5) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `medication` varchar(254) NOT NULL,
  `indication` varchar(254) NOT NULL,
  `pre_diagnosis` varchar(254) NOT NULL,
  `brief_history` varchar(254) NOT NULL,
  `oropha` varchar(254) NOT NULL,
  `esophagus` varchar(254) NOT NULL,
  `eg_junction` varchar(254) NOT NULL,
  `cardia` varchar(254) NOT NULL,
  `fundus` varchar(254) NOT NULL,
  `body` varchar(254) NOT NULL,
  `antrum` varchar(254) NOT NULL,
  `pylorus` varchar(254) NOT NULL,
  `bulb` varchar(254) NOT NULL,
  `2nd_portion` varchar(254) NOT NULL,
  `post_diagnosis_dx1` varchar(254) NOT NULL,
  `complication` varchar(254) NOT NULL,
  `histopathology` varchar(254) NOT NULL,
  `clo_test` varchar(254) NOT NULL,
  `therapy` varchar(254) NOT NULL,
  `recommendation` varchar(254) NOT NULL,
  `notes_comments` varchar(254) NOT NULL,
  `endoscopist` varchar(254) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=931 DEFAULT CHARSET=utf8;

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
) ENGINE=MyISAM AUTO_INCREMENT=348 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dr_nid_log
-- ----------------------------
DROP TABLE IF EXISTS `dr_nid_log`;
CREATE TABLE `dr_nid_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_add` datetime DEFAULT NULL,
  `nid_name` varchar(255) DEFAULT NULL,
  `depart_id` varchar(50) DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dr_offline
-- ----------------------------
DROP TABLE IF EXISTS `dr_offline`;
CREATE TABLE `dr_offline` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `dateoffline` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `dateoffline` (`dateoffline`)
) ENGINE=MyISAM AUTO_INCREMENT=4760 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drdglst
-- ----------------------------
DROP TABLE IF EXISTS `drdglst`;
CREATE TABLE `drdglst` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `genname` varchar(40) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `salepri` double(10,2) DEFAULT NULL,
  `part` varchar(5) DEFAULT NULL,
  `slcode` varchar(10) DEFAULT NULL,
  `bcode` varchar(10) DEFAULT NULL,
  `drugtype` varchar(4) DEFAULT NULL,
  `amount` int(4) DEFAULT NULL,
  `doctor` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `drugcode` (`drugcode`),
  KEY `dgcode` (`drugcode`),
  KEY `tradname` (`tradname`),
  KEY `genname` (`genname`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_control_log
-- ----------------------------
DROP TABLE IF EXISTS `drug_control_log`;
CREATE TABLE `drug_control_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `author` varchar(255) NOT NULL,
  `min` int(11) NOT NULL,
  `max` int(11) NOT NULL,
  `drugcode` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=41420 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_control_user
-- ----------------------------
DROP TABLE IF EXISTS `drug_control_user`;
CREATE TABLE `drug_control_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) DEFAULT NULL,
  `min` int(11) DEFAULT NULL,
  `max` int(11) DEFAULT NULL,
  `drugcode` varchar(255) DEFAULT NULL,
  `druglst_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `username` (`username`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=35397 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_edit_log
-- ----------------------------
DROP TABLE IF EXISTS `drug_edit_log`;
CREATE TABLE `drug_edit_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `update_code` longtext NOT NULL,
  `date_edit` datetime NOT NULL,
  `user_edit` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11701 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_erythro
-- ----------------------------
DROP TABLE IF EXISTS `drug_erythro`;
CREATE TABLE `drug_erythro` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `age` varchar(20) NOT NULL,
  `ward` varchar(20) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `target` varchar(1) NOT NULL,
  `target_value` varchar(10) NOT NULL,
  `drug` varchar(10) NOT NULL,
  `listdrug` varchar(1) NOT NULL,
  `listvalue` varchar(2) NOT NULL,
  `output` varchar(1) NOT NULL,
  `outvalue` varchar(1) NOT NULL,
  `outday` varchar(10) DEFAULT NULL,
  `baseline` varchar(10) NOT NULL,
  `base_data` varchar(10) NOT NULL,
  `current` varchar(10) NOT NULL,
  `current_data` varchar(10) NOT NULL,
  `bp` varchar(10) NOT NULL,
  `prca` varchar(10) NOT NULL,
  `other` varchar(10) NOT NULL,
  `serum` varchar(10) NOT NULL,
  `tsat` varchar(10) NOT NULL,
  `officer` varchar(50) NOT NULL,
  `userlogin` varchar(50) NOT NULL,
  `dateup` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4661 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_gruco
-- ----------------------------
DROP TABLE IF EXISTS `drug_gruco`;
CREATE TABLE `drug_gruco` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `name_doc` varchar(100) NOT NULL,
  `num_doc` varchar(100) NOT NULL,
  `fac` varchar(1) NOT NULL,
  `hospital` varchar(100) NOT NULL,
  `province` varchar(100) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `name_pt` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `reason1` varchar(10) DEFAULT NULL,
  `reason2` varchar(10) DEFAULT NULL,
  `reason3` varchar(10) NOT NULL,
  `ch1` varchar(10) NOT NULL,
  `week1` varchar(10) NOT NULL,
  `date11` varchar(10) NOT NULL,
  `date12` varchar(10) NOT NULL,
  `ch2` varchar(10) NOT NULL,
  `week2` varchar(10) NOT NULL,
  `date21` varchar(10) NOT NULL,
  `date22` varchar(10) NOT NULL,
  `week3` varchar(10) NOT NULL,
  `date31` varchar(10) NOT NULL,
  `date32` varchar(10) NOT NULL,
  `week4` varchar(10) NOT NULL,
  `date41` varchar(10) NOT NULL,
  `date42` varchar(10) NOT NULL,
  `week5` varchar(10) NOT NULL,
  `date51` varchar(10) NOT NULL,
  `date52` varchar(10) NOT NULL,
  `ch3` varchar(10) NOT NULL,
  `week6` varchar(10) NOT NULL,
  `date61` varchar(10) NOT NULL,
  `date62` varchar(10) NOT NULL,
  `week7` varchar(10) NOT NULL,
  `date71` varchar(10) NOT NULL,
  `date72` varchar(10) NOT NULL,
  `week8` varchar(10) NOT NULL,
  `date81` varchar(10) NOT NULL,
  `date82` varchar(10) NOT NULL,
  `week9` varchar(10) NOT NULL,
  `date91` varchar(10) NOT NULL,
  `date92` varchar(10) NOT NULL,
  `dateup` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4684 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_interaction
-- ----------------------------
DROP TABLE IF EXISTS `drug_interaction`;
CREATE TABLE `drug_interaction` (
  `first_drugcode` varchar(10) NOT NULL DEFAULT '',
  `between_drugcode` varchar(10) NOT NULL DEFAULT '',
  `first_tradname` varchar(100) DEFAULT NULL,
  `between_tradname` varchar(100) DEFAULT NULL,
  `first_genname` varchar(100) NOT NULL,
  `between_genname` varchar(100) DEFAULT NULL,
  `effect` varchar(80) NOT NULL DEFAULT '',
  `action` varchar(80) NOT NULL DEFAULT '',
  `follow` varchar(80) NOT NULL DEFAULT '',
  `onset` varchar(80) NOT NULL DEFAULT '',
  `violence` varchar(80) NOT NULL DEFAULT '',
  `referable` varchar(80) NOT NULL DEFAULT '',
  `status` varchar(20) NOT NULL,
  PRIMARY KEY (`first_drugcode`,`between_drugcode`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_pharlock
-- ----------------------------
DROP TABLE IF EXISTS `drug_pharlock`;
CREATE TABLE `drug_pharlock` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `drugcode` varchar(15) NOT NULL,
  `detail` text NOT NULL,
  `datekey` datetime NOT NULL,
  `userkey` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_pregnancy
-- ----------------------------
DROP TABLE IF EXISTS `drug_pregnancy`;
CREATE TABLE `drug_pregnancy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_id` int(11) DEFAULT NULL,
  `drugcode` varchar(255) DEFAULT NULL,
  `pregnancy` varchar(50) DEFAULT NULL,
  `lactation` varchar(50) DEFAULT NULL,
  `lastupdate` varchar(255) DEFAULT NULL,
  `byuser` varchar(255) DEFAULT NULL,
  `status` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_return
-- ----------------------------
DROP TABLE IF EXISTS `drug_return`;
CREATE TABLE `drug_return` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `an` varchar(10) NOT NULL,
  `camp` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `indate` varchar(20) NOT NULL,
  `dcdate` varchar(20) DEFAULT NULL,
  `txtdate` varchar(20) NOT NULL,
  `phardate` varchar(20) DEFAULT NULL,
  `rowref` varchar(10) NOT NULL,
  `tradname` varchar(50) NOT NULL,
  `slcode` varchar(10) NOT NULL,
  `unit` varchar(10) NOT NULL,
  `amount` varchar(5) NOT NULL,
  `price` varchar(5) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `my_ward` varchar(20) NOT NULL,
  `bed` varchar(5) NOT NULL,
  `officer` varchar(50) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=137898 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_typeg
-- ----------------------------
DROP TABLE IF EXISTS `drug_typeg`;
CREATE TABLE `drug_typeg` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) DEFAULT NULL,
  `hn` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `age` varchar(100) DEFAULT NULL,
  `ptright` varchar(100) DEFAULT NULL,
  `value1` varchar(10) DEFAULT NULL,
  `value2` varchar(10) DEFAULT NULL,
  `value3` varchar(10) DEFAULT NULL,
  `value4` varchar(10) DEFAULT NULL,
  `value5` varchar(10) DEFAULT NULL,
  `officer` varchar(100) DEFAULT NULL,
  `userlogin` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=87 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drug_user_ward
-- ----------------------------
DROP TABLE IF EXISTS `drug_user_ward`;
CREATE TABLE `drug_user_ward` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=58 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drugallergy
-- ----------------------------
DROP TABLE IF EXISTS `drugallergy`;
CREATE TABLE `drugallergy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) DEFAULT NULL,
  `PID` varchar(15) DEFAULT NULL,
  `DATERECORD` varchar(8) DEFAULT NULL,
  `DRUGALLERGY` varchar(24) DEFAULT NULL,
  `DNAME` varchar(255) DEFAULT NULL,
  `TYPEDX` varchar(1) DEFAULT NULL,
  `ALEVEL` varchar(1) DEFAULT NULL,
  `SYMPTOM` varchar(255) DEFAULT NULL,
  `INFORMANT` varchar(1) DEFAULT NULL,
  `INFORMHOSP` varchar(255) DEFAULT NULL,
  `D_UPDATE` varchar(14) DEFAULT NULL,
  `PROVIDER` varchar(255) DEFAULT NULL,
  `CID` varchar(13) DEFAULT NULL,
  `drugcode` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9743 DEFAULT CHARSET=utf8 ROW_FORMAT=DYNAMIC;

-- ----------------------------
-- Table structure for drughad
-- ----------------------------
DROP TABLE IF EXISTS `drughad`;
CREATE TABLE `drughad` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(200) DEFAULT NULL,
  `detail` text NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `drugcode` (`drugcode`),
  KEY `dgcode` (`drugcode`),
  KEY `tradname` (`tradname`)
) ENGINE=MyISAM AUTO_INCREMENT=38 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drugimport
-- ----------------------------
DROP TABLE IF EXISTS `drugimport`;
CREATE TABLE `drugimport` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(20) NOT NULL,
  `drugcode` varchar(50) NOT NULL,
  `tradname` varchar(200) NOT NULL,
  `min` varchar(10) NOT NULL,
  `max` varchar(10) NOT NULL,
  `stock` varchar(10) NOT NULL,
  `mainstk` varchar(10) NOT NULL,
  `dispense` varchar(20) NOT NULL,
  `amountrx` varchar(10) NOT NULL,
  `idno` varchar(10) NOT NULL,
  `usercontrol` varchar(100) NOT NULL,
  `datesearch` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=327352 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for druginteraction_cross
-- ----------------------------
DROP TABLE IF EXISTS `druginteraction_cross`;
CREATE TABLE `druginteraction_cross` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) NOT NULL,
  `parent` varchar(50) NOT NULL,
  `children` text NOT NULL,
  `add_by` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL,
  `last_edit` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for druginteraction_info
-- ----------------------------
DROP TABLE IF EXISTS `druginteraction_info`;
CREATE TABLE `druginteraction_info` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) NOT NULL,
  `detail` text NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for druglst
-- ----------------------------
DROP TABLE IF EXISTS `druglst`;
CREATE TABLE `druglst` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `comcode` varchar(10) DEFAULT NULL,
  `comname` varchar(60) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(200) DEFAULT NULL,
  `genname` varchar(200) DEFAULT NULL,
  `drugname` varchar(100) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `minimum` int(8) NOT NULL DEFAULT '0',
  `stock` int(8) NOT NULL DEFAULT '0',
  `unitpri` double(10,4) DEFAULT NULL,
  `oldsalepri` double(10,2) DEFAULT NULL,
  `calsalepri` double(10,2) DEFAULT NULL,
  `salepri` double(10,2) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `part` varchar(5) DEFAULT NULL,
  `specno` varchar(16) DEFAULT NULL,
  `mainstk` int(11) NOT NULL DEFAULT '0',
  `totalstk` int(11) NOT NULL DEFAULT '0',
  `rxaccum` int(11) NOT NULL DEFAULT '0',
  `rx1day` int(8) NOT NULL DEFAULT '0',
  `rxrate` int(8) NOT NULL DEFAULT '0',
  `stkpmon` double(6,1) NOT NULL DEFAULT '0.0',
  `slcode` varchar(10) DEFAULT NULL,
  `bcode` varchar(10) DEFAULT NULL,
  `edpri` double(10,4) DEFAULT NULL,
  `pack` varchar(30) DEFAULT NULL,
  `packpri` double(10,2) DEFAULT NULL,
  `packpri_vat` double(10,2) DEFAULT NULL,
  `freepri` double(10,2) DEFAULT NULL,
  `freelimit` double(10,2) DEFAULT NULL,
  `contract` double(10,2) DEFAULT NULL,
  `subunit` varchar(24) DEFAULT NULL,
  `packing` varchar(16) DEFAULT NULL,
  `packamt` int(8) NOT NULL DEFAULT '0',
  `drugnote` varchar(48) DEFAULT NULL,
  `drugtype` varchar(4) DEFAULT NULL,
  `edit_date` date NOT NULL DEFAULT '0000-00-00',
  `edit_user` varchar(30) NOT NULL DEFAULT '',
  `datetranx` varchar(30) DEFAULT NULL,
  `oldstock` int(8) NOT NULL DEFAULT '0',
  `spec` varchar(20) DEFAULT NULL,
  `snspec` varchar(20) DEFAULT NULL,
  `default_order` int(4) NOT NULL DEFAULT '0',
  `code24` varchar(30) DEFAULT NULL,
  `bring_max` int(2) NOT NULL DEFAULT '0',
  `lock` varchar(3) DEFAULT 'Y',
  `lock_dr` varchar(20) DEFAULT 'Y',
  `dpy_code` varchar(6) NOT NULL,
  `medical_sup_free` varchar(1) NOT NULL DEFAULT '0',
  `asu` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `typedrug` varchar(100) NOT NULL,
  `dosecode` varchar(3) NOT NULL,
  `strength` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `manufac` varchar(200) NOT NULL,
  `packsize` varchar(20) NOT NULL,
  `packprice` varchar(20) NOT NULL,
  `updateflag` varchar(1) NOT NULL,
  `ised` varchar(5) NOT NULL,
  `lockptright` varchar(5) NOT NULL,
  `usercontrol` varchar(100) NOT NULL,
  `min` varchar(100) NOT NULL,
  `max` varchar(100) NOT NULL,
  `cash` varchar(20) NOT NULL,
  `cscd` varchar(20) NOT NULL,
  `local` varchar(20) NOT NULL,
  `uc_sso` varchar(20) NOT NULL,
  `lockptright_detail` varchar(200) NOT NULL,
  `tmt` varchar(10) NOT NULL,
  `had` varchar(20) NOT NULL,
  `original` varchar(50) NOT NULL,
  `sso` varchar(2) NOT NULL,
  `pay` varchar(2) NOT NULL,
  `productcat` varchar(50) DEFAULT NULL,
  `specprep` varchar(2) NOT NULL,
  `dateupdate` varchar(10) NOT NULL,
  `unitpriold` double(10,2) DEFAULT NULL,
  `product_category` varchar(1) NOT NULL,
  `status_pha` varchar(50) NOT NULL,
  `narcotic` varchar(2) NOT NULL,
  `codevs` varchar(10) NOT NULL,
  `limit_pay` varchar(3) NOT NULL,
  `limit_ptright` varchar(3) NOT NULL,
  `drugcatstatus` varchar(1) NOT NULL,
  `unitsize` varchar(20) NOT NULL,
  `drug_condition` int(11) NOT NULL,
  `drug_minstock` int(11) NOT NULL,
  `drug_lacktime` int(1) NOT NULL,
  `drug_lockucsso` int(1) NOT NULL,
  `drug_lockintern` varchar(1) NOT NULL,
  `edpri_from` int(11) NOT NULL,
  `product_drugtype` varchar(1) NOT NULL,
  `grouptype` varchar(5) NOT NULL,
  `drug_nature` varchar(100) NOT NULL,
  `drug_properties` varchar(200) NOT NULL,
  `drug_active` varchar(1) DEFAULT NULL,
  `lock_ipd` varchar(1) NOT NULL DEFAULT 'Y',
  `drug_innovation` varchar(1) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `drugcode` (`drugcode`),
  KEY `comcode` (`comcode`),
  KEY `dgcode` (`drugcode`),
  KEY `tradname` (`tradname`),
  KEY `genname` (`genname`)
) ENGINE=MyISAM AUTO_INCREMENT=4497 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for druglst_pt
-- ----------------------------
DROP TABLE IF EXISTS `druglst_pt`;
CREATE TABLE `druglst_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `comcode` varchar(10) DEFAULT NULL,
  `comname` varchar(60) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(200) DEFAULT NULL,
  `genname` varchar(200) DEFAULT NULL,
  `drugname` varchar(100) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `minimum` int(8) NOT NULL DEFAULT '0',
  `stock` int(8) NOT NULL DEFAULT '0',
  `unitpri` double(10,2) DEFAULT NULL,
  `oldsalepri` double(10,2) DEFAULT NULL,
  `calsalepri` double(10,2) DEFAULT NULL,
  `salepri` double(10,2) DEFAULT NULL,
  `type` varchar(2) DEFAULT NULL,
  `part` varchar(5) DEFAULT NULL,
  `specno` varchar(16) DEFAULT NULL,
  `mainstk` int(11) NOT NULL DEFAULT '0',
  `totalstk` int(11) NOT NULL DEFAULT '0',
  `rxaccum` int(11) NOT NULL DEFAULT '0',
  `rx1day` int(8) NOT NULL DEFAULT '0',
  `rxrate` int(8) NOT NULL DEFAULT '0',
  `stkpmon` double(6,1) NOT NULL DEFAULT '0.0',
  `slcode` varchar(10) DEFAULT NULL,
  `bcode` varchar(10) DEFAULT NULL,
  `edpri` double(10,2) DEFAULT NULL,
  `pack` varchar(30) DEFAULT NULL,
  `packpri` double(10,2) DEFAULT NULL,
  `packpri_vat` double(10,2) DEFAULT NULL,
  `freepri` double(10,2) DEFAULT NULL,
  `freelimit` double(10,2) DEFAULT NULL,
  `contract` double(10,2) DEFAULT NULL,
  `subunit` varchar(24) DEFAULT NULL,
  `packing` varchar(16) DEFAULT NULL,
  `packamt` int(8) NOT NULL DEFAULT '0',
  `drugnote` varchar(48) DEFAULT NULL,
  `drugtype` varchar(4) DEFAULT NULL,
  `edit_date` date NOT NULL DEFAULT '0000-00-00',
  `edit_user` varchar(30) NOT NULL DEFAULT '',
  `datetranx` varchar(30) DEFAULT NULL,
  `oldstock` int(8) NOT NULL DEFAULT '0',
  `spec` varchar(20) DEFAULT NULL,
  `snspec` varchar(20) DEFAULT NULL,
  `default_order` int(4) NOT NULL DEFAULT '0',
  `code24` varchar(30) DEFAULT NULL,
  `bring_max` int(2) NOT NULL DEFAULT '0',
  `lock` varchar(3) DEFAULT 'Y',
  `lock_dr` varchar(20) DEFAULT 'Y',
  `dpy_code` varchar(6) NOT NULL,
  `medical_sup_free` varchar(1) NOT NULL DEFAULT '0',
  `asu` varchar(1) NOT NULL,
  `status` varchar(1) NOT NULL,
  `typedrug` varchar(100) NOT NULL,
  `dosecode` varchar(3) NOT NULL,
  `strength` varchar(100) NOT NULL,
  `content` varchar(100) NOT NULL,
  `manufac` varchar(200) NOT NULL,
  `packsize` varchar(20) NOT NULL,
  `packprice` varchar(20) NOT NULL,
  `updateflag` varchar(1) NOT NULL,
  `ised` varchar(5) NOT NULL,
  `lockptright` varchar(5) NOT NULL,
  `usercontrol` varchar(100) NOT NULL,
  `min` varchar(100) NOT NULL,
  `max` varchar(100) NOT NULL,
  `cash` varchar(20) NOT NULL,
  `cscd` varchar(20) NOT NULL,
  `local` varchar(20) NOT NULL,
  `uc_sso` varchar(20) NOT NULL,
  `lockptright_detail` varchar(200) NOT NULL,
  `tmt` varchar(10) NOT NULL,
  `had` varchar(20) NOT NULL,
  `original` varchar(50) NOT NULL,
  `sso` varchar(2) NOT NULL,
  `pay` varchar(2) NOT NULL,
  `productcat` varchar(50) DEFAULT NULL,
  `specprep` varchar(2) NOT NULL,
  `dateupdate` varchar(10) NOT NULL,
  `unitpriold` double(10,2) DEFAULT NULL,
  `product_category` varchar(1) NOT NULL,
  `status_pha` varchar(50) NOT NULL,
  `narcotic` varchar(2) NOT NULL,
  `codevs` varchar(10) NOT NULL,
  `limit_pay` varchar(3) NOT NULL,
  `limit_ptright` varchar(3) NOT NULL,
  `drugcatstatus` varchar(1) NOT NULL,
  `grouptype` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `drugcode` (`drugcode`),
  KEY `comcode` (`comcode`),
  KEY `dgcode` (`drugcode`),
  KEY `tradname` (`tradname`),
  KEY `genname` (`genname`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drugoutside
-- ----------------------------
DROP TABLE IF EXISTS `drugoutside`;
CREATE TABLE `drugoutside` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `runno` int(11) NOT NULL,
  `regisdate` varchar(40) NOT NULL,
  `dateadd` varchar(30) NOT NULL,
  `yot` varchar(30) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `type` varchar(30) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `hn` varchar(30) NOT NULL,
  `an` varchar(30) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `diag` varchar(100) NOT NULL,
  `action` varchar(20) NOT NULL,
  `action_detail` varchar(50) NOT NULL,
  `ref_id` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `name2` varchar(50) NOT NULL,
  `position` varchar(100) NOT NULL,
  `typeopd` varchar(50) NOT NULL,
  `typedoc` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2172 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for drugoutside_list
-- ----------------------------
DROP TABLE IF EXISTS `drugoutside_list`;
CREATE TABLE `drugoutside_list` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` int(11) DEFAULT NULL,
  `list_detail` text NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2180 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drugreact
-- ----------------------------
DROP TABLE IF EXISTS `drugreact`;
CREATE TABLE `drugreact` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(12) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `advreact` varchar(255) DEFAULT NULL,
  `asses` varchar(2) DEFAULT NULL,
  `reporter` varchar(32) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `officer` varchar(100) NOT NULL,
  `genname` varchar(100) NOT NULL,
  `groupname` varchar(255) NOT NULL,
  `sideeffects` varchar(255) NOT NULL,
  `officer1` varchar(100) NOT NULL,
  `g6pd` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=23419 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drugreact_group
-- ----------------------------
DROP TABLE IF EXISTS `drugreact_group`;
CREATE TABLE `drugreact_group` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='กลุ่มยาที่มีโอกาสแพ้';

-- ----------------------------
-- Table structure for drugreact_group_list
-- ----------------------------
DROP TABLE IF EXISTS `drugreact_group_list`;
CREATE TABLE `drugreact_group_list` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `drugcode` varchar(10) NOT NULL,
  `drugreact_group` varchar(2) NOT NULL,
  `officer` varchar(100) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COMMENT='ยาที่อยู่ในกลุ่มที่มีโอกาสแพ้';

-- ----------------------------
-- Table structure for drugrp5
-- ----------------------------
DROP TABLE IF EXISTS `drugrp5`;
CREATE TABLE `drugrp5` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `getdate` date NOT NULL,
  `drugcode` varchar(10) NOT NULL,
  `tradname` varchar(40) NOT NULL,
  `billno` varchar(12) NOT NULL,
  `detail` text NOT NULL,
  `stkno` varchar(20) NOT NULL,
  `drug_unitprice` double(10,2) DEFAULT NULL,
  `drug_num` int(11) NOT NULL,
  `drug_price` double(10,2) DEFAULT NULL,
  `pay_unitprice` double(10,2) DEFAULT NULL,
  `pay_num` int(11) NOT NULL,
  `pay_price` double(10,2) DEFAULT NULL,
  `rest_unitprice` double(10,2) DEFAULT NULL,
  `rest_num` int(11) NOT NULL,
  `rest_price` double(10,2) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15007 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drugrx
-- ----------------------------
DROP TABLE IF EXISTS `drugrx`;
CREATE TABLE `drugrx` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `slcode` varchar(20) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `stock` float DEFAULT '0',
  `statcon` varchar(5) DEFAULT NULL,
  `DPY` varchar(10) DEFAULT NULL,
  `DPN` varchar(10) DEFAULT NULL,
  `reason` varchar(100) NOT NULL,
  `drug_inject_amount` varchar(50) NOT NULL,
  `drug_inject_unit` varchar(50) NOT NULL,
  `drug_inject_amount2` varchar(50) NOT NULL,
  `drug_inject_unit2` varchar(50) NOT NULL,
  `drug_inject_time` varchar(50) NOT NULL,
  `drug_inject_slip` varchar(50) NOT NULL,
  `drug_inject_type` varchar(50) NOT NULL,
  `drug_inject_etc` varchar(50) NOT NULL,
  `status` varchar(3) DEFAULT 'Y',
  `drug_status` varchar(20) NOT NULL,
  `mainstk` int(8) NOT NULL,
  `reject` varchar(2) NOT NULL,
  `datedr` varchar(20) NOT NULL,
  `DSY` varchar(10) NOT NULL,
  `DSN` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `idno` (`idno`),
  KEY `hn` (`hn`),
  KEY `part` (`part`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=10157614 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drugrx_pt
-- ----------------------------
DROP TABLE IF EXISTS `drugrx_pt`;
CREATE TABLE `drugrx_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `slcode` varchar(10) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `stock` int(8) NOT NULL DEFAULT '0',
  `statcon` varchar(5) DEFAULT NULL,
  `DPY` varchar(10) DEFAULT NULL,
  `DPN` varchar(10) DEFAULT NULL,
  `reason` varchar(100) NOT NULL,
  `drug_inject_amount` varchar(50) NOT NULL,
  `drug_inject_unit` varchar(50) NOT NULL,
  `drug_inject_amount2` varchar(50) NOT NULL,
  `drug_inject_unit2` varchar(50) NOT NULL,
  `drug_inject_time` varchar(50) NOT NULL,
  `drug_inject_slip` varchar(50) NOT NULL,
  `drug_inject_type` varchar(50) NOT NULL,
  `drug_inject_etc` varchar(50) NOT NULL,
  `status` varchar(3) DEFAULT 'Y',
  `drug_status` varchar(20) NOT NULL,
  `mainstk` int(8) NOT NULL,
  `reject` varchar(2) NOT NULL,
  `datedr` varchar(20) NOT NULL,
  `DSY` varchar(10) NOT NULL,
  `DSN` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `idno` (`idno`),
  KEY `drugcode` (`drugcode`),
  KEY `hn` (`hn`),
  KEY `part` (`part`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drugslip
-- ----------------------------
DROP TABLE IF EXISTS `drugslip`;
CREATE TABLE `drugslip` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `slcode` char(20) DEFAULT NULL,
  `detail1` char(40) DEFAULT NULL,
  `detail2` char(40) DEFAULT NULL,
  `detail3` char(40) DEFAULT NULL,
  `detail4` char(40) DEFAULT NULL,
  `amount` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `slcode` (`slcode`),
  KEY `slipcode` (`slcode`)
) ENGINE=MyISAM AUTO_INCREMENT=3882 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for drugslip_inject
-- ----------------------------
DROP TABLE IF EXISTS `drugslip_inject`;
CREATE TABLE `drugslip_inject` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `type` varchar(20) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COMMENT='วิธีใช้ยาแบบฉีด';

-- ----------------------------
-- Table structure for drugslip_ipd
-- ----------------------------
DROP TABLE IF EXISTS `drugslip_ipd`;
CREATE TABLE `drugslip_ipd` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `slcode` char(20) DEFAULT NULL,
  `ranktime` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for drugstartrp5
-- ----------------------------
DROP TABLE IF EXISTS `drugstartrp5`;
CREATE TABLE `drugstartrp5` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `getdate` date NOT NULL,
  `drugcode` varchar(10) NOT NULL,
  `tradname` varchar(40) NOT NULL,
  `detail` text NOT NULL,
  `rest_unitprice` double(10,2) NOT NULL,
  `rest_num` int(11) NOT NULL,
  `rest_price` double(10,2) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=47 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for drxremain
-- ----------------------------
DROP TABLE IF EXISTS `drxremain`;
CREATE TABLE `drxremain` (
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(20) NOT NULL,
  `drugcode` varchar(20) NOT NULL,
  `drugname` varchar(50) NOT NULL,
  `amount` varchar(4) NOT NULL,
  `slcode` varchar(10) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `price` varchar(10) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dt_daily
-- ----------------------------
DROP TABLE IF EXISTS `dt_daily`;
CREATE TABLE `dt_daily` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `doctor_id` int(11) DEFAULT NULL,
  `doctor_code` varchar(255) DEFAULT NULL,
  `doctor_name` varchar(255) DEFAULT NULL,
  `day` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `time_start` varchar(255) DEFAULT NULL,
  `time_end` varchar(255) DEFAULT NULL,
  `type_name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dt_drugadd
-- ----------------------------
DROP TABLE IF EXISTS `dt_drugadd`;
CREATE TABLE `dt_drugadd` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `drugname` varchar(500) DEFAULT NULL,
  `name_patient` varchar(100) DEFAULT NULL,
  `HN` varchar(10) DEFAULT NULL,
  `AN` varchar(10) DEFAULT NULL,
  `age` varchar(3) DEFAULT NULL,
  `ptright` varchar(100) DEFAULT NULL,
  `diag` varchar(500) DEFAULT NULL,
  `ex1` varchar(500) DEFAULT NULL,
  `ex2` varchar(500) DEFAULT NULL,
  `ex3` varchar(500) DEFAULT NULL,
  `ex4` varchar(500) DEFAULT NULL,
  `ex5` varchar(500) DEFAULT NULL,
  `date` varchar(500) DEFAULT NULL,
  `doctor` varchar(100) DEFAULT NULL,
  `type` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=18810 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dt_logs
-- ----------------------------
DROP TABLE IF EXISTS `dt_logs`;
CREATE TABLE `dt_logs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thdatehn` varchar(255) DEFAULT NULL,
  `endatehn` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `vn` varchar(255) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `room` varchar(255) DEFAULT NULL,
  `time` varchar(8) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `thdatehn` (`thdatehn`),
  KEY `endatehn` (`endatehn`),
  KEY `doctor` (`doctor`),
  KEY `room` (`room`)
) ENGINE=MyISAM AUTO_INCREMENT=132675 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dt_rechallenge
-- ----------------------------
DROP TABLE IF EXISTS `dt_rechallenge`;
CREATE TABLE `dt_rechallenge` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `an` varchar(255) DEFAULT NULL,
  `datehn` varchar(255) DEFAULT NULL,
  `drugcode` varchar(255) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `dt_code` varchar(255) DEFAULT NULL,
  `reason` varchar(255) DEFAULT NULL,
  `returnstr` varchar(255) DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`),
  KEY `doctor` (`doctor`),
  KEY `drugcode` (`drugcode`),
  KEY `an` (`an`),
  KEY `datehn` (`datehn`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for duecompany
-- ----------------------------
DROP TABLE IF EXISTS `duecompany`;
CREATE TABLE `duecompany` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `podate` varchar(30) DEFAULT NULL,
  `billdate` varchar(30) DEFAULT NULL,
  `docno` varchar(12) DEFAULT NULL,
  `comname` varchar(60) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `billno` varchar(12) DEFAULT NULL,
  `getdate` varchar(30) DEFAULT NULL,
  `chequeok` varchar(20) DEFAULT NULL,
  `items` int(2) DEFAULT NULL,
  `officer` varchar(40) DEFAULT NULL,
  `grouptype` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=44783 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for duecompany_pt
-- ----------------------------
DROP TABLE IF EXISTS `duecompany_pt`;
CREATE TABLE `duecompany_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `podate` varchar(30) DEFAULT NULL,
  `billdate` varchar(30) DEFAULT NULL,
  `docno` varchar(12) DEFAULT NULL,
  `comname` varchar(60) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `billno` varchar(12) DEFAULT NULL,
  `getdate` varchar(30) DEFAULT NULL,
  `chequeok` varchar(20) DEFAULT NULL,
  `items` int(2) DEFAULT NULL,
  `officer` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dxofyear
-- ----------------------------
DROP TABLE IF EXISTS `dxofyear`;
CREATE TABLE `dxofyear` (
  `row_id` int(3) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(30) DEFAULT NULL,
  `thdatevn` varchar(20) NOT NULL,
  `hn` varchar(15) DEFAULT NULL,
  `vn` varchar(5) NOT NULL,
  `ptname` varchar(80) NOT NULL,
  `age` varchar(20) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `camp_until` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp1` varchar(10) NOT NULL,
  `bp2` varchar(10) NOT NULL,
  `bp21` varchar(20) NOT NULL,
  `bp22` varchar(20) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `prawat` varchar(1) NOT NULL,
  `congenital_disease` varchar(60) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `ua_color` varchar(10) NOT NULL,
  `ua_appear` varchar(10) NOT NULL,
  `ua_spgr` varchar(10) NOT NULL,
  `ua_phu` varchar(10) NOT NULL,
  `ua_bloodu` varchar(10) NOT NULL,
  `ua_prou` varchar(10) NOT NULL,
  `ua_gluu` varchar(10) NOT NULL,
  `ua_ketu` varchar(10) NOT NULL,
  `ua_urobil` varchar(10) NOT NULL,
  `ua_bili` varchar(10) NOT NULL,
  `ua_nitrit` varchar(10) NOT NULL,
  `ua_wbcu` varchar(10) NOT NULL,
  `ua_rbcu` varchar(10) NOT NULL,
  `ua_epiu` varchar(10) NOT NULL,
  `ua_bactu` varchar(10) NOT NULL,
  `ua_yeast` varchar(10) NOT NULL,
  `ua_mucosu` varchar(10) NOT NULL,
  `ua_amopu` varchar(10) NOT NULL,
  `ua_castu` varchar(10) NOT NULL,
  `ua_crystu` varchar(10) NOT NULL,
  `ua_otheru` varchar(10) NOT NULL,
  `stat_ua` varchar(20) NOT NULL,
  `reason_ua` varchar(100) DEFAULT NULL,
  `cbc_wbc` varchar(10) NOT NULL,
  `stat_wbc` varchar(20) NOT NULL,
  `reason_wbc` varchar(100) NOT NULL,
  `wbcrange` varchar(20) NOT NULL,
  `wbcflag` varchar(20) NOT NULL,
  `cbc_rbc` varchar(10) NOT NULL,
  `cbc_hb` varchar(10) NOT NULL,
  `cbc_hct` varchar(10) NOT NULL,
  `stat_hct` varchar(20) NOT NULL,
  `reason_hct` varchar(100) NOT NULL,
  `hctrange` varchar(20) NOT NULL,
  `hctflag` varchar(20) NOT NULL,
  `cbc_mcv` varchar(10) NOT NULL,
  `cbc_mch` varchar(10) NOT NULL,
  `cbc_mchc` varchar(10) NOT NULL,
  `cbc_pltc` varchar(10) NOT NULL,
  `stat_pltc` varchar(20) NOT NULL,
  `reason_pltc` varchar(100) NOT NULL,
  `pltcrange` varchar(20) NOT NULL,
  `pltcflag` varchar(20) NOT NULL,
  `cbc_plts` varchar(10) NOT NULL,
  `cbc_neu` varchar(10) NOT NULL,
  `cbc_lymp` varchar(10) NOT NULL,
  `cbc_mono` varchar(10) NOT NULL,
  `cbc_eos` varchar(10) NOT NULL,
  `cbc_baso` varchar(10) NOT NULL,
  `cbc_band` varchar(10) NOT NULL,
  `cbc_atyp` varchar(10) NOT NULL,
  `cbc_nrbc` varchar(10) NOT NULL,
  `cbc_rbcmor` varchar(10) NOT NULL,
  `cbc_other` varchar(10) NOT NULL,
  `stat_cbc` varchar(20) NOT NULL,
  `reason_cbc` varchar(100) DEFAULT NULL,
  `cxr` varchar(10) NOT NULL,
  `reason_cxr` varchar(100) DEFAULT NULL,
  `bs` varchar(10) NOT NULL,
  `stat_bs` varchar(20) NOT NULL,
  `reason_bs` varchar(100) DEFAULT NULL,
  `bsrange` varchar(20) NOT NULL,
  `bsflag` varchar(20) NOT NULL,
  `bun` varchar(10) NOT NULL,
  `stat_bun` varchar(20) NOT NULL,
  `reason_bun` varchar(100) DEFAULT NULL,
  `bunrange` varchar(20) NOT NULL,
  `bunflag` varchar(20) NOT NULL,
  `cr` varchar(10) NOT NULL,
  `stat_cr` varchar(20) NOT NULL,
  `reason_cr` varchar(100) DEFAULT NULL,
  `crrange` varchar(20) NOT NULL,
  `crflag` varchar(20) NOT NULL,
  `uric` varchar(10) NOT NULL,
  `stat_uric` varchar(20) NOT NULL,
  `reason_uric` varchar(100) DEFAULT NULL,
  `uricrange` varchar(20) NOT NULL,
  `uricflag` varchar(20) NOT NULL,
  `chol` varchar(10) NOT NULL,
  `stat_chol` varchar(20) NOT NULL,
  `reason_chol` varchar(100) DEFAULT NULL,
  `cholrange` varchar(20) NOT NULL,
  `cholflag` varchar(20) NOT NULL,
  `tg` varchar(10) NOT NULL,
  `stat_tg` varchar(20) NOT NULL,
  `reason_tg` varchar(100) DEFAULT NULL,
  `tgrange` varchar(20) NOT NULL,
  `tgflag` varchar(20) NOT NULL,
  `sgot` varchar(10) NOT NULL,
  `stat_sgot` varchar(20) NOT NULL,
  `reason_sgot` varchar(100) DEFAULT NULL,
  `sgotrange` varchar(20) NOT NULL,
  `sgotflag` varchar(20) NOT NULL,
  `sgpt` varchar(10) NOT NULL,
  `stat_sgpt` varchar(20) NOT NULL,
  `reason_sgpt` varchar(100) DEFAULT NULL,
  `sgptrange` varchar(20) NOT NULL,
  `sgptflag` varchar(20) NOT NULL,
  `alk` varchar(10) NOT NULL,
  `stat_alk` varchar(20) NOT NULL,
  `reason_alk` varchar(100) DEFAULT NULL,
  `alkrange` varchar(20) NOT NULL,
  `alkflag` varchar(20) NOT NULL,
  `general` varchar(10) DEFAULT NULL,
  `reason_general` varchar(100) DEFAULT NULL,
  `pap` varchar(10) NOT NULL,
  `reason_pap` varchar(100) DEFAULT NULL,
  `other1` varchar(10) NOT NULL,
  `stat_other1` varchar(20) NOT NULL,
  `reason_other1` varchar(100) DEFAULT NULL,
  `other2` varchar(10) NOT NULL,
  `stat_other2` varchar(20) NOT NULL,
  `reason_other2` varchar(100) DEFAULT NULL,
  `dx` text NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `exercise` varchar(1) DEFAULT NULL,
  `summary` varchar(20) NOT NULL,
  `officer` varchar(100) DEFAULT NULL,
  `yearchk` varchar(10) NOT NULL,
  `hdl` varchar(10) NOT NULL,
  `stat_hdl` varchar(20) NOT NULL,
  `reason_hdl` varchar(100) NOT NULL,
  `hdlrange` varchar(20) NOT NULL,
  `hdlflag` varchar(20) NOT NULL,
  `ldl` varchar(10) NOT NULL,
  `stat_ldl` varchar(20) NOT NULL,
  `reason_ldl` varchar(100) NOT NULL,
  `ldlrange` varchar(20) NOT NULL,
  `ldlflag` varchar(20) NOT NULL,
  `gfr` varchar(10) NOT NULL,
  `stat_gfr` varchar(20) NOT NULL,
  `reason_gfr` varchar(100) NOT NULL,
  `gfrrange` varchar(20) NOT NULL,
  `gfrflag` varchar(20) NOT NULL,
  `cigok` varchar(1) NOT NULL,
  `smoke_amount` int(11) NOT NULL,
  `drink_amount` int(11) NOT NULL,
  `covaccine_amount` int(2) NOT NULL,
  `covaccine_1` varchar(20) NOT NULL,
  `covaccine_2` varchar(20) NOT NULL,
  `covaccine_3` varchar(20) NOT NULL,
  `covaccine_4` varchar(20) NOT NULL,
  `covaccine_5` varchar(20) NOT NULL,
  `covaccine_6` varchar(20) NOT NULL,
  `idcard` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=11920 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for dxofyear_emp
-- ----------------------------
DROP TABLE IF EXISTS `dxofyear_emp`;
CREATE TABLE `dxofyear_emp` (
  `row_id` int(3) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `thdatevn` varchar(20) NOT NULL,
  `hn` varchar(8) NOT NULL,
  `vn` varchar(5) NOT NULL,
  `ptname` varchar(80) NOT NULL,
  `age` varchar(20) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `camp_until` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp1` varchar(10) NOT NULL,
  `bp2` varchar(10) NOT NULL,
  `bp21` varchar(20) NOT NULL,
  `bp22` varchar(20) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `prawat` varchar(1) NOT NULL,
  `congenital_disease` varchar(60) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `ua_color` varchar(10) NOT NULL,
  `ua_appear` varchar(10) NOT NULL,
  `ua_spgr` varchar(10) NOT NULL,
  `ua_phu` varchar(10) NOT NULL,
  `ua_bloodu` varchar(10) NOT NULL,
  `ua_prou` varchar(10) NOT NULL,
  `ua_gluu` varchar(10) NOT NULL,
  `ua_ketu` varchar(10) NOT NULL,
  `ua_urobil` varchar(10) NOT NULL,
  `ua_bili` varchar(10) NOT NULL,
  `ua_nitrit` varchar(10) NOT NULL,
  `ua_wbcu` varchar(10) NOT NULL,
  `ua_rbcu` varchar(10) NOT NULL,
  `ua_epiu` varchar(10) NOT NULL,
  `ua_bactu` varchar(10) NOT NULL,
  `ua_yeast` varchar(10) NOT NULL,
  `ua_mucosu` varchar(10) NOT NULL,
  `ua_amopu` varchar(10) NOT NULL,
  `ua_castu` varchar(10) NOT NULL,
  `ua_crystu` varchar(10) NOT NULL,
  `ua_otheru` varchar(10) NOT NULL,
  `stat_ua` varchar(20) NOT NULL,
  `reason_ua` varchar(100) DEFAULT NULL,
  `cbc_wbc` varchar(10) NOT NULL,
  `stat_wbc` varchar(20) NOT NULL,
  `reason_wbc` varchar(100) NOT NULL,
  `wbcrange` varchar(20) NOT NULL,
  `wbcflag` varchar(20) NOT NULL,
  `cbc_rbc` varchar(10) NOT NULL,
  `cbc_hb` varchar(10) NOT NULL,
  `cbc_hct` varchar(10) NOT NULL,
  `stat_hct` varchar(20) NOT NULL,
  `reason_hct` varchar(100) NOT NULL,
  `hctrange` varchar(20) NOT NULL,
  `hctflag` varchar(20) NOT NULL,
  `cbc_mcv` varchar(10) NOT NULL,
  `cbc_mch` varchar(10) NOT NULL,
  `cbc_mchc` varchar(10) NOT NULL,
  `cbc_pltc` varchar(10) NOT NULL,
  `stat_pltc` varchar(20) NOT NULL,
  `reason_pltc` varchar(100) NOT NULL,
  `pltcrange` varchar(20) NOT NULL,
  `pltcflag` varchar(20) NOT NULL,
  `cbc_plts` varchar(10) NOT NULL,
  `cbc_neu` varchar(10) NOT NULL,
  `cbc_lymp` varchar(10) NOT NULL,
  `cbc_mono` varchar(10) NOT NULL,
  `cbc_eos` varchar(10) NOT NULL,
  `cbc_baso` varchar(10) NOT NULL,
  `cbc_band` varchar(10) NOT NULL,
  `cbc_atyp` varchar(10) NOT NULL,
  `cbc_nrbc` varchar(10) NOT NULL,
  `cbc_rbcmor` varchar(10) NOT NULL,
  `cbc_other` varchar(10) NOT NULL,
  `stat_cbc` varchar(20) NOT NULL,
  `reason_cbc` varchar(100) DEFAULT NULL,
  `cxr` varchar(20) DEFAULT NULL,
  `reason_cxr` varchar(100) DEFAULT NULL,
  `bs` varchar(10) NOT NULL,
  `stat_bs` varchar(20) NOT NULL,
  `reason_bs` varchar(100) DEFAULT NULL,
  `bsrange` varchar(20) NOT NULL,
  `bsflag` varchar(20) NOT NULL,
  `bun` varchar(10) NOT NULL,
  `stat_bun` varchar(20) NOT NULL,
  `reason_bun` varchar(100) DEFAULT NULL,
  `bunrange` varchar(20) NOT NULL,
  `bunflag` varchar(20) NOT NULL,
  `cr` varchar(10) NOT NULL,
  `stat_cr` varchar(20) NOT NULL,
  `reason_cr` varchar(100) DEFAULT NULL,
  `crrange` varchar(20) NOT NULL,
  `crflag` varchar(20) NOT NULL,
  `uric` varchar(10) NOT NULL,
  `stat_uric` varchar(20) NOT NULL,
  `reason_uric` varchar(100) DEFAULT NULL,
  `uricrange` varchar(20) NOT NULL,
  `uricflag` varchar(20) NOT NULL,
  `chol` varchar(10) NOT NULL,
  `stat_chol` varchar(20) NOT NULL,
  `reason_chol` varchar(100) DEFAULT NULL,
  `cholrange` varchar(20) NOT NULL,
  `cholflag` varchar(20) NOT NULL,
  `tg` varchar(10) NOT NULL,
  `stat_tg` varchar(20) NOT NULL,
  `reason_tg` varchar(100) DEFAULT NULL,
  `tgrange` varchar(20) NOT NULL,
  `tgflag` varchar(20) NOT NULL,
  `sgot` varchar(10) NOT NULL,
  `stat_sgot` varchar(20) NOT NULL,
  `reason_sgot` varchar(100) DEFAULT NULL,
  `sgotrange` varchar(20) NOT NULL,
  `sgotflag` varchar(20) NOT NULL,
  `sgpt` varchar(10) NOT NULL,
  `stat_sgpt` varchar(20) NOT NULL,
  `reason_sgpt` varchar(100) DEFAULT NULL,
  `sgptrange` varchar(20) NOT NULL,
  `sgptflag` varchar(20) NOT NULL,
  `alk` varchar(10) NOT NULL,
  `stat_alk` varchar(20) NOT NULL,
  `reason_alk` varchar(100) DEFAULT NULL,
  `alkrange` varchar(20) NOT NULL,
  `alkflag` varchar(20) NOT NULL,
  `general` varchar(10) DEFAULT NULL,
  `reason_general` varchar(100) DEFAULT NULL,
  `pap` varchar(10) NOT NULL,
  `reason_pap` varchar(100) DEFAULT NULL,
  `other1` varchar(10) NOT NULL,
  `stat_other1` varchar(20) NOT NULL,
  `reason_other1` varchar(100) DEFAULT NULL,
  `other2` varchar(10) NOT NULL,
  `stat_other2` varchar(20) NOT NULL,
  `reason_other2` varchar(100) DEFAULT NULL,
  `dx` text NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `exercise` varchar(1) DEFAULT NULL,
  `summary` varchar(20) NOT NULL,
  `officer` varchar(20) NOT NULL,
  `yearchk` varchar(10) NOT NULL,
  `ldl` varchar(10) NOT NULL,
  `stat_ldl` varchar(20) NOT NULL,
  `reason_ldl` varchar(100) DEFAULT NULL,
  `ldlrange` varchar(20) NOT NULL,
  `ldlflag` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=316 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dxofyear_lab
-- ----------------------------
DROP TABLE IF EXISTS `dxofyear_lab`;
CREATE TABLE `dxofyear_lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `thdatehn` varchar(255) DEFAULT NULL,
  `thdatevn` varchar(255) DEFAULT NULL,
  `dxofyear_out_id` bigint(20) DEFAULT NULL,
  `profilecode` varchar(255) DEFAULT NULL,
  `labcode` varchar(255) DEFAULT NULL,
  `labname` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `range` varchar(255) DEFAULT NULL,
  `flag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `thdatehn` (`thdatehn`),
  KEY `dxofyear_out_id` (`dxofyear_out_id`),
  KEY `thdatevn` (`thdatevn`),
  KEY `profilecode` (`profilecode`),
  KEY `labcode` (`labcode`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for dxofyear_out
-- ----------------------------
DROP TABLE IF EXISTS `dxofyear_out`;
CREATE TABLE `dxofyear_out` (
  `row_id` int(3) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `thdatevn` varchar(20) NOT NULL,
  `hn` varchar(8) NOT NULL,
  `vn` varchar(5) NOT NULL,
  `ptname` varchar(80) NOT NULL,
  `age` varchar(20) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `camp_until` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp1` varchar(10) NOT NULL,
  `bp2` varchar(10) NOT NULL,
  `bp21` varchar(20) NOT NULL,
  `bp22` varchar(20) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `prawat` varchar(1) NOT NULL,
  `congenital_disease` varchar(255) NOT NULL,
  `accident_surgery` varchar(200) NOT NULL,
  `treat_hospital` varchar(60) NOT NULL,
  `epilepsy` varchar(60) NOT NULL,
  `treat_other` varchar(60) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `ua_color` varchar(10) NOT NULL,
  `ua_appear` varchar(10) NOT NULL,
  `ua_spgr` varchar(10) NOT NULL,
  `ua_phu` varchar(10) NOT NULL,
  `ua_bloodu` varchar(10) NOT NULL,
  `ua_prou` varchar(10) NOT NULL,
  `ua_gluu` varchar(10) NOT NULL,
  `ua_ketu` varchar(10) NOT NULL,
  `ua_urobil` varchar(10) NOT NULL,
  `ua_bili` varchar(10) NOT NULL,
  `ua_nitrit` varchar(10) NOT NULL,
  `ua_wbcu` varchar(10) NOT NULL,
  `ua_rbcu` varchar(10) NOT NULL,
  `ua_epiu` varchar(10) NOT NULL,
  `ua_bactu` varchar(10) NOT NULL,
  `ua_yeast` varchar(10) NOT NULL,
  `ua_mucosu` varchar(10) NOT NULL,
  `ua_amopu` varchar(10) NOT NULL,
  `ua_castu` varchar(10) NOT NULL,
  `ua_crystu` varchar(10) NOT NULL,
  `ua_otheru` varchar(10) NOT NULL,
  `stat_ua` varchar(20) NOT NULL,
  `reason_ua` varchar(100) DEFAULT NULL,
  `cbc_wbc` varchar(10) NOT NULL,
  `stat_wbc` varchar(20) NOT NULL,
  `reason_wbc` varchar(100) NOT NULL,
  `wbcrange` varchar(20) NOT NULL,
  `wbcflag` varchar(20) NOT NULL,
  `cbc_rbc` varchar(10) NOT NULL,
  `cbc_hb` varchar(10) NOT NULL,
  `cbc_hct` varchar(10) NOT NULL,
  `stat_hct` varchar(20) NOT NULL,
  `reason_hct` varchar(100) NOT NULL,
  `hctrange` varchar(20) NOT NULL,
  `hctflag` varchar(20) NOT NULL,
  `cbc_mcv` varchar(10) NOT NULL,
  `cbc_mch` varchar(10) NOT NULL,
  `cbc_mchc` varchar(10) NOT NULL,
  `cbc_pltc` varchar(10) NOT NULL,
  `stat_pltc` varchar(20) NOT NULL,
  `reason_pltc` varchar(100) NOT NULL,
  `pltcrange` varchar(20) NOT NULL,
  `pltcflag` varchar(20) NOT NULL,
  `cbc_plts` varchar(10) NOT NULL,
  `cbc_neu` varchar(10) NOT NULL,
  `cbc_lymp` varchar(10) NOT NULL,
  `cbc_mono` varchar(10) NOT NULL,
  `cbc_eos` varchar(10) NOT NULL,
  `cbc_baso` varchar(10) NOT NULL,
  `cbc_band` varchar(10) NOT NULL,
  `cbc_atyp` varchar(10) NOT NULL,
  `cbc_nrbc` varchar(10) NOT NULL,
  `cbc_rbcmor` varchar(10) NOT NULL,
  `cbc_other` varchar(10) NOT NULL,
  `stat_cbc` varchar(20) NOT NULL,
  `reason_cbc` varchar(100) DEFAULT NULL,
  `cxr` varchar(10) NOT NULL,
  `reason_cxr` varchar(100) DEFAULT NULL,
  `bs` varchar(10) NOT NULL,
  `stat_bs` varchar(20) NOT NULL,
  `reason_bs` varchar(100) DEFAULT NULL,
  `bsrange` varchar(20) NOT NULL,
  `bsflag` varchar(20) NOT NULL,
  `bun` varchar(10) NOT NULL,
  `stat_bun` varchar(20) NOT NULL,
  `reason_bun` varchar(100) DEFAULT NULL,
  `bunrange` varchar(20) NOT NULL,
  `bunflag` varchar(20) NOT NULL,
  `cr` varchar(10) NOT NULL,
  `stat_cr` varchar(20) NOT NULL,
  `reason_cr` varchar(100) DEFAULT NULL,
  `crrange` varchar(20) NOT NULL,
  `crflag` varchar(20) NOT NULL,
  `uric` varchar(10) NOT NULL,
  `stat_uric` varchar(20) NOT NULL,
  `reason_uric` varchar(100) DEFAULT NULL,
  `uricrange` varchar(20) NOT NULL,
  `uricflag` varchar(20) NOT NULL,
  `chol` varchar(10) NOT NULL,
  `stat_chol` varchar(20) NOT NULL,
  `reason_chol` varchar(100) DEFAULT NULL,
  `cholrange` varchar(20) NOT NULL,
  `cholflag` varchar(20) NOT NULL,
  `tg` varchar(10) NOT NULL,
  `stat_tg` varchar(20) NOT NULL,
  `reason_tg` varchar(100) DEFAULT NULL,
  `tgrange` varchar(20) NOT NULL,
  `tgflag` varchar(20) NOT NULL,
  `sgot` varchar(10) NOT NULL,
  `stat_sgot` varchar(20) NOT NULL,
  `reason_sgot` varchar(100) DEFAULT NULL,
  `sgotrange` varchar(20) NOT NULL,
  `sgotflag` varchar(20) NOT NULL,
  `sgpt` varchar(10) NOT NULL,
  `stat_sgpt` varchar(20) NOT NULL,
  `reason_sgpt` varchar(100) DEFAULT NULL,
  `sgptrange` varchar(20) NOT NULL,
  `sgptflag` varchar(20) NOT NULL,
  `alk` varchar(10) NOT NULL,
  `stat_alk` varchar(20) NOT NULL,
  `reason_alk` varchar(100) DEFAULT NULL,
  `alkrange` varchar(20) NOT NULL,
  `alkflag` varchar(20) NOT NULL,
  `general` varchar(10) DEFAULT NULL,
  `reason_general` varchar(100) DEFAULT NULL,
  `pap` varchar(10) NOT NULL,
  `reason_pap` varchar(100) DEFAULT NULL,
  `other1` varchar(10) NOT NULL,
  `stat_other1` varchar(20) NOT NULL,
  `reason_other1` varchar(100) DEFAULT NULL,
  `other2` varchar(10) NOT NULL,
  `stat_other2` varchar(20) NOT NULL,
  `reason_other2` varchar(100) DEFAULT NULL,
  `dx` text NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `exercise` varchar(1) DEFAULT NULL,
  `summary` varchar(20) NOT NULL,
  `officer` varchar(20) NOT NULL,
  `yearchk` varchar(10) NOT NULL,
  `labin_date` date DEFAULT NULL,
  `dental_exam` varchar(255) DEFAULT NULL,
  `color_blind` varchar(255) DEFAULT NULL,
  `audiogram` varchar(255) DEFAULT NULL,
  `ekg` varchar(255) DEFAULT NULL,
  `pft` varchar(255) NOT NULL,
  `hdl` varchar(50) DEFAULT NULL,
  `hdl_range` varchar(50) DEFAULT NULL,
  `hdl_flag` varchar(50) DEFAULT NULL,
  `10001` varchar(50) DEFAULT NULL,
  `10001_range` varchar(50) DEFAULT NULL,
  `10001_flag` varchar(50) DEFAULT NULL,
  `malari` varchar(50) DEFAULT NULL,
  `malari_range` varchar(50) DEFAULT NULL,
  `malari_flag` varchar(50) DEFAULT NULL,
  `metamp` varchar(50) DEFAULT NULL,
  `metamp_range` varchar(50) DEFAULT NULL,
  `metamp_flag` varchar(50) DEFAULT NULL,
  `hbsag` varchar(50) DEFAULT NULL,
  `hbsag_range` varchar(50) DEFAULT NULL,
  `hbsag_flag` varchar(50) DEFAULT NULL,
  `hcvab` varchar(50) DEFAULT NULL,
  `hcvab_range` varchar(50) DEFAULT NULL,
  `hcvab_flag` varchar(50) DEFAULT NULL,
  `hiv` varchar(50) DEFAULT NULL,
  `hiv_range` varchar(50) DEFAULT NULL,
  `hiv_flag` varchar(50) DEFAULT NULL,
  `vdrl` varchar(50) DEFAULT NULL,
  `vdrl_range` varchar(50) DEFAULT NULL,
  `vdrl_flag` varchar(50) DEFAULT NULL,
  `parasi` varchar(50) DEFAULT NULL,
  `parasi_range` varchar(50) DEFAULT NULL,
  `parasi_flag` varchar(50) DEFAULT NULL,
  `groupt` varchar(50) DEFAULT NULL,
  `groupt_range` varchar(50) DEFAULT NULL,
  `groupt_flag` varchar(50) DEFAULT NULL,
  `rh` varchar(50) DEFAULT NULL,
  `rh_range` varchar(50) DEFAULT NULL,
  `rh_flag` varchar(50) DEFAULT NULL,
  `upt` varchar(50) DEFAULT NULL,
  `upt_range` varchar(50) DEFAULT NULL,
  `upt_flag` varchar(50) DEFAULT NULL,
  `antihb` varchar(255) DEFAULT NULL,
  `antihb_flag` varchar(255) DEFAULT NULL,
  `ldl` varchar(50) NOT NULL,
  `ldl_range` varchar(50) NOT NULL,
  `ldl_flag` varchar(50) NOT NULL,
  `stocc` varchar(255) DEFAULT NULL,
  `stoccflag` varchar(5) DEFAULT NULL,
  `HBA1CC` varchar(100) DEFAULT NULL,
  `HBA1CCrange` varchar(100) DEFAULT NULL,
  `HBA1CCflag` varchar(100) DEFAULT NULL,
  `CEA` varchar(255) DEFAULT NULL,
  `CEArange` varchar(255) DEFAULT NULL,
  `CEAflag` varchar(255) DEFAULT NULL,
  `PSA` varchar(255) DEFAULT NULL,
  `PSArange` varchar(255) DEFAULT NULL,
  `PSAflag` varchar(255) DEFAULT NULL,
  `AFP` varchar(255) DEFAULT NULL,
  `AFPrange` varchar(255) DEFAULT NULL,
  `AFPflag` varchar(255) DEFAULT NULL,
  `TP` varchar(255) DEFAULT NULL,
  `TPrange` varchar(255) DEFAULT NULL,
  `TPflag` varchar(255) DEFAULT NULL,
  `ALB` varchar(255) DEFAULT NULL,
  `ALBrange` varchar(255) DEFAULT NULL,
  `ALBflag` varchar(255) DEFAULT NULL,
  `TB` varchar(255) DEFAULT NULL,
  `TBrange` varchar(255) DEFAULT NULL,
  `TBflag` varchar(255) DEFAULT NULL,
  `DB` varchar(255) DEFAULT NULL,
  `DBrange` varchar(255) DEFAULT NULL,
  `DBflag` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12417 DEFAULT CHARSET=utf8 PACK_KEYS=0 COMMENT='HBsAb';

-- ----------------------------
-- Table structure for echo_cardio
-- ----------------------------
DROP TABLE IF EXISTS `echo_cardio`;
CREATE TABLE `echo_cardio` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thdatehn` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ptname` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `hn` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vn` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `pause` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bp` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
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
  `staff` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(5) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=554 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for edc
-- ----------------------------
DROP TABLE IF EXISTS `edc`;
CREATE TABLE `edc` (
  `hoscode` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `hcg` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hosname1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `edc1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hosname2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `b` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `edccode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chkdate1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chktime1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chkdate2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chktime2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idcard1` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `surname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idcard2` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `null1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `null2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `null3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menu1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `menu2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bdate` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `datechk` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `edcid` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `fieldcode` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `payment` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `appcode` varchar(9) COLLATE utf8_unicode_ci NOT NULL,
  `field2` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chkedc` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `chkm1` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `field3` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `field4` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(50) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for education
-- ----------------------------
DROP TABLE IF EXISTS `education`;
CREATE TABLE `education` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `edu_code` varchar(3) DEFAULT NULL,
  `edu_name` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for epidem
-- ----------------------------
DROP TABLE IF EXISTS `epidem`;
CREATE TABLE `epidem` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `opsi_id` bigint(20) DEFAULT NULL,
  `an` varchar(50) DEFAULT NULL,
  `cid` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `passport_no` varchar(255) DEFAULT NULL,
  `prefix` varchar(255) DEFAULT NULL,
  `first_name` varchar(255) DEFAULT NULL,
  `last_name` varchar(255) DEFAULT NULL,
  `nationality` varchar(255) DEFAULT NULL,
  `gender` tinyint(4) DEFAULT NULL,
  `birth_date` varchar(255) DEFAULT NULL,
  `age_y` tinyint(4) DEFAULT NULL,
  `age_m` tinyint(4) DEFAULT NULL,
  `age_d` tinyint(4) DEFAULT NULL,
  `marital_status_id` tinyint(4) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `moo` varchar(255) DEFAULT NULL,
  `road` varchar(255) DEFAULT NULL,
  `chw_code` varchar(255) DEFAULT NULL,
  `amp_code` varchar(255) DEFAULT NULL,
  `tmb_code` varchar(255) DEFAULT NULL,
  `mobile_phone` varchar(255) DEFAULT NULL,
  `occupation` varchar(255) DEFAULT NULL,
  `epidem_report_guid` varchar(255) DEFAULT NULL,
  `epidem_report_group_id` int(11) DEFAULT NULL,
  `treated_hospital_code` varchar(255) DEFAULT NULL,
  `report_datetime` varchar(255) DEFAULT NULL,
  `onset_date` varchar(255) DEFAULT NULL,
  `treated_date` varchar(255) DEFAULT NULL,
  `diagnosis_date` varchar(255) DEFAULT NULL,
  `informer_name` varchar(255) DEFAULT NULL,
  `principal_diagnosis_icd10` varchar(255) DEFAULT NULL,
  `diagnosis_icd10_list` varchar(255) DEFAULT NULL,
  `epidem_person_status_id` tinyint(4) DEFAULT NULL,
  `epidem_symptom_type_id` tinyint(4) DEFAULT NULL,
  `pregnant_status` varchar(255) DEFAULT NULL,
  `respirator_status` varchar(255) DEFAULT NULL,
  `epidem_accommodation_type_id` int(11) DEFAULT NULL,
  `vaccinated_status` varchar(255) DEFAULT NULL,
  `exposure_epidemic_area_status` varchar(255) DEFAULT NULL,
  `exposure_healthcare_worker_status` varchar(255) DEFAULT NULL,
  `exposure_closed_contact_status` varchar(255) DEFAULT NULL,
  `exposure_occupation_status` varchar(255) DEFAULT NULL,
  `exposure_travel_status` varchar(255) DEFAULT NULL,
  `risk_history_type_id` int(11) DEFAULT NULL,
  `epidem_address` varchar(255) DEFAULT NULL,
  `epidem_moo` varchar(255) DEFAULT NULL,
  `epidem_road` varchar(255) DEFAULT NULL,
  `epidem_chw_code` varchar(255) DEFAULT NULL,
  `epidem_amp_code` varchar(255) DEFAULT NULL,
  `epidem_tmb_code` varchar(255) DEFAULT NULL,
  `location_gis_latitude` float DEFAULT NULL,
  `location_gis_longitude` float DEFAULT NULL,
  `isolate_chw_code` varchar(255) DEFAULT NULL,
  `isolate_place_id` tinyint(4) DEFAULT NULL,
  `patient_type` varchar(255) DEFAULT NULL,
  `epidem_covid_cluster_type_id` tinyint(4) DEFAULT NULL,
  `cluster_latitude` float DEFAULT NULL,
  `cluster_longitude` float DEFAULT NULL,
  `epidem_lab_confirm_type_id` tinyint(4) DEFAULT NULL,
  `lab_report_date` varchar(255) DEFAULT NULL,
  `lab_report_result` varchar(255) DEFAULT NULL,
  `specimen_date` varchar(255) DEFAULT NULL,
  `specimen_place_id` tinyint(4) DEFAULT NULL,
  `tests_reason_type_id` tinyint(4) DEFAULT NULL,
  `lab_his_ref_code` varchar(255) DEFAULT NULL,
  `lab_his_ref_name` varchar(255) DEFAULT NULL,
  `tmlt_code` varchar(255) DEFAULT NULL,
  `date_add` varchar(255) DEFAULT NULL,
  `date_update` varchar(255) DEFAULT NULL,
  `officer` varchar(255) DEFAULT NULL,
  `send_data` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `opsi_id` (`opsi_id`),
  KEY `cid` (`cid`),
  KEY `hn` (`hn`),
  KEY `epidem_report_guid` (`epidem_report_guid`)
) ENGINE=MyISAM AUTO_INCREMENT=2429 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for equipdev
-- ----------------------------
DROP TABLE IF EXISTS `equipdev`;
CREATE TABLE `equipdev` (
  `id` int(11) NOT NULL,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `desc` text COLLATE utf8_unicode_ci NOT NULL,
  `revclass` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `revrate` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `dateeff` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dateexp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `exdrgpay` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_last` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `billgr` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `claimup` int(10) NOT NULL,
  `daterev` varchar(20) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for equipdev_aipn
-- ----------------------------
DROP TABLE IF EXISTS `equipdev_aipn`;
CREATE TABLE `equipdev_aipn` (
  `id` int(11) NOT NULL,
  `billgrcs` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `bcode` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `cscode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `rate` double(10,2) NOT NULL,
  `revclass` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `revrate` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `daterev` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dateeff` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `dateexp` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `lastupd` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `dxcond` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `note` text COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='รายการเวชภัณฑ์อุปกรณ์ผู้ป่วยประกันสังคม';

-- ----------------------------
-- Table structure for er_acute
-- ----------------------------
DROP TABLE IF EXISTS `er_acute`;
CREATE TABLE `er_acute` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `datehn` varchar(255) DEFAULT NULL,
  `acu1` varchar(255) DEFAULT NULL,
  `acu2` varchar(255) DEFAULT NULL,
  `acu3` varchar(255) DEFAULT NULL,
  `acu4` varchar(255) DEFAULT NULL,
  `acu5` varchar(255) DEFAULT NULL,
  `acu6` varchar(255) DEFAULT NULL,
  `acu7` varchar(255) DEFAULT NULL,
  `acu_n` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `datehn` (`datehn`),
  KEY `hn` (`hn`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for er_ftw
-- ----------------------------
DROP TABLE IF EXISTS `er_ftw`;
CREATE TABLE `er_ftw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(10) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `datehn` varchar(255) DEFAULT NULL,
  `ftwa` varchar(255) DEFAULT NULL,
  `ftwb` varchar(255) DEFAULT NULL,
  `ftwn` varchar(255) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `datehn` (`datehn`) USING BTREE,
  KEY `hn` (`hn`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ex30_log
-- ----------------------------
DROP TABLE IF EXISTS `ex30_log`;
CREATE TABLE `ex30_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `vn` int(11) DEFAULT NULL,
  `hn` varchar(10) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `opday_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=426 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for f43_accident_109
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_109`;
CREATE TABLE `f43_accident_109` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_110
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_110`;
CREATE TABLE `f43_accident_110` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_111
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_111`;
CREATE TABLE `f43_accident_111` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_112
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_112`;
CREATE TABLE `f43_accident_112` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_113
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_113`;
CREATE TABLE `f43_accident_113` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_114
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_114`;
CREATE TABLE `f43_accident_114` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_115
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_115`;
CREATE TABLE `f43_accident_115` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_116
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_116`;
CREATE TABLE `f43_accident_116` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_117
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_117`;
CREATE TABLE `f43_accident_117` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_118
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_118`;
CREATE TABLE `f43_accident_118` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_119
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_119`;
CREATE TABLE `f43_accident_119` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_120
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_120`;
CREATE TABLE `f43_accident_120` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_121
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_121`;
CREATE TABLE `f43_accident_121` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_122
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_122`;
CREATE TABLE `f43_accident_122` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `score` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_123
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_123`;
CREATE TABLE `f43_accident_123` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `score` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_accident_124
-- ----------------------------
DROP TABLE IF EXISTS `f43_accident_124`;
CREATE TABLE `f43_accident_124` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `score` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_address_17
-- ----------------------------
DROP TABLE IF EXISTS `f43_address_17`;
CREATE TABLE `f43_address_17` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_address_18
-- ----------------------------
DROP TABLE IF EXISTS `f43_address_18`;
CREATE TABLE `f43_address_18` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_admission_130
-- ----------------------------
DROP TABLE IF EXISTS `f43_admission_130`;
CREATE TABLE `f43_admission_130` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_admission_131_136
-- ----------------------------
DROP TABLE IF EXISTS `f43_admission_131_136`;
CREATE TABLE `f43_admission_131_136` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_admission_132_135
-- ----------------------------
DROP TABLE IF EXISTS `f43_admission_132_135`;
CREATE TABLE `f43_admission_132_135` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_admission_137
-- ----------------------------
DROP TABLE IF EXISTS `f43_admission_137`;
CREATE TABLE `f43_admission_137` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_anc_178
-- ----------------------------
DROP TABLE IF EXISTS `f43_anc_178`;
CREATE TABLE `f43_anc_178` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_anc_179
-- ----------------------------
DROP TABLE IF EXISTS `f43_anc_179`;
CREATE TABLE `f43_anc_179` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_appointment_152
-- ----------------------------
DROP TABLE IF EXISTS `f43_appointment_152`;
CREATE TABLE `f43_appointment_152` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_thai` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_charge_opd_93_ipd_148
-- ----------------------------
DROP TABLE IF EXISTS `f43_charge_opd_93_ipd_148`;
CREATE TABLE `f43_charge_opd_93_ipd_148` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_chronic_33
-- ----------------------------
DROP TABLE IF EXISTS `f43_chronic_33`;
CREATE TABLE `f43_chronic_33` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_chronicfu_126
-- ----------------------------
DROP TABLE IF EXISTS `f43_chronicfu_126`;
CREATE TABLE `f43_chronicfu_126` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_chronicfu_127
-- ----------------------------
DROP TABLE IF EXISTS `f43_chronicfu_127`;
CREATE TABLE `f43_chronicfu_127` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_clinic
-- ----------------------------
DROP TABLE IF EXISTS `f43_clinic`;
CREATE TABLE `f43_clinic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_community_activity_207
-- ----------------------------
DROP TABLE IF EXISTS `f43_community_activity_207`;
CREATE TABLE `f43_community_activity_207` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_community_service_208
-- ----------------------------
DROP TABLE IF EXISTS `f43_community_service_208`;
CREATE TABLE `f43_community_service_208` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=297 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_death_29
-- ----------------------------
DROP TABLE IF EXISTS `f43_death_29`;
CREATE TABLE `f43_death_29` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_death_30
-- ----------------------------
DROP TABLE IF EXISTS `f43_death_30`;
CREATE TABLE `f43_death_30` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_dental_154
-- ----------------------------
DROP TABLE IF EXISTS `f43_dental_154`;
CREATE TABLE `f43_dental_154` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_dental_154_ncd_165_pp_204
-- ----------------------------
DROP TABLE IF EXISTS `f43_dental_154_ncd_165_pp_204`;
CREATE TABLE `f43_dental_154_ncd_165_pp_204` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_dental_155
-- ----------------------------
DROP TABLE IF EXISTS `f43_dental_155`;
CREATE TABLE `f43_dental_155` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_dental_156
-- ----------------------------
DROP TABLE IF EXISTS `f43_dental_156`;
CREATE TABLE `f43_dental_156` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_dental_157
-- ----------------------------
DROP TABLE IF EXISTS `f43_dental_157`;
CREATE TABLE `f43_dental_157` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_dental_158
-- ----------------------------
DROP TABLE IF EXISTS `f43_dental_158`;
CREATE TABLE `f43_dental_158` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_dental_159
-- ----------------------------
DROP TABLE IF EXISTS `f43_dental_159`;
CREATE TABLE `f43_dental_159` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_dental_160
-- ----------------------------
DROP TABLE IF EXISTS `f43_dental_160`;
CREATE TABLE `f43_dental_160` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_diagnosis_ipd_142
-- ----------------------------
DROP TABLE IF EXISTS `f43_diagnosis_ipd_142`;
CREATE TABLE `f43_diagnosis_ipd_142` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_diagnosis_ipd_85_opd_139
-- ----------------------------
DROP TABLE IF EXISTS `f43_diagnosis_ipd_85_opd_139`;
CREATE TABLE `f43_diagnosis_ipd_85_opd_139` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_disabillity_57
-- ----------------------------
DROP TABLE IF EXISTS `f43_disabillity_57`;
CREATE TABLE `f43_disabillity_57` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_disabillity_58
-- ----------------------------
DROP TABLE IF EXISTS `f43_disabillity_58`;
CREATE TABLE `f43_disabillity_58` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_drug_opd_90_ipd_144
-- ----------------------------
DROP TABLE IF EXISTS `f43_drug_opd_90_ipd_144`;
CREATE TABLE `f43_drug_opd_90_ipd_144` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=36 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_drugallergy_66
-- ----------------------------
DROP TABLE IF EXISTS `f43_drugallergy_66`;
CREATE TABLE `f43_drugallergy_66` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_drugallergy_67
-- ----------------------------
DROP TABLE IF EXISTS `f43_drugallergy_67`;
CREATE TABLE `f43_drugallergy_67` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_drugallergy_68
-- ----------------------------
DROP TABLE IF EXISTS `f43_drugallergy_68`;
CREATE TABLE `f43_drugallergy_68` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `icd10tm` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_drugallergy_69
-- ----------------------------
DROP TABLE IF EXISTS `f43_drugallergy_69`;
CREATE TABLE `f43_drugallergy_69` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_epi_198
-- ----------------------------
DROP TABLE IF EXISTS `f43_epi_198`;
CREATE TABLE `f43_epi_198` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `vaccine_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_eng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_thai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_diag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_icd10tm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=102 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_epi_198_out
-- ----------------------------
DROP TABLE IF EXISTS `f43_epi_198_out`;
CREATE TABLE `f43_epi_198_out` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `vaccine_code` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_eng` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_thai` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_type` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_group` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_diag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_icd10tm` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `vaccine_comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=69 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_fp_172
-- ----------------------------
DROP TABLE IF EXISTS `f43_fp_172`;
CREATE TABLE `f43_fp_172` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_fp_63_women_172
-- ----------------------------
DROP TABLE IF EXISTS `f43_fp_63_women_172`;
CREATE TABLE `f43_fp_63_women_172` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_fp_64
-- ----------------------------
DROP TABLE IF EXISTS `f43_fp_64`;
CREATE TABLE `f43_fp_64` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_functional_71
-- ----------------------------
DROP TABLE IF EXISTS `f43_functional_71`;
CREATE TABLE `f43_functional_71` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_functional_72
-- ----------------------------
DROP TABLE IF EXISTS `f43_functional_72`;
CREATE TABLE `f43_functional_72` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_39
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_39`;
CREATE TABLE `f43_home_39` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_40
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_40`;
CREATE TABLE `f43_home_40` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_41
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_41`;
CREATE TABLE `f43_home_41` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_42
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_42`;
CREATE TABLE `f43_home_42` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_43
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_43`;
CREATE TABLE `f43_home_43` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_44
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_44`;
CREATE TABLE `f43_home_44` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_45
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_45`;
CREATE TABLE `f43_home_45` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_46
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_46`;
CREATE TABLE `f43_home_46` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_47
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_47`;
CREATE TABLE `f43_home_47` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_48
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_48`;
CREATE TABLE `f43_home_48` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_49
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_49`;
CREATE TABLE `f43_home_49` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_50
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_50`;
CREATE TABLE `f43_home_50` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_51
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_51`;
CREATE TABLE `f43_home_51` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_52
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_52`;
CREATE TABLE `f43_home_52` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_53
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_53`;
CREATE TABLE `f43_home_53` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_home_54
-- ----------------------------
DROP TABLE IF EXISTS `f43_home_54`;
CREATE TABLE `f43_home_54` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_icf_73
-- ----------------------------
DROP TABLE IF EXISTS `f43_icf_73`;
CREATE TABLE `f43_icf_73` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=303 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_labor_181
-- ----------------------------
DROP TABLE IF EXISTS `f43_labor_181`;
CREATE TABLE `f43_labor_181` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_labor_182_newborn_187
-- ----------------------------
DROP TABLE IF EXISTS `f43_labor_182_newborn_187`;
CREATE TABLE `f43_labor_182_newborn_187` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_labor_184_newborn_190
-- ----------------------------
DROP TABLE IF EXISTS `f43_labor_184_newborn_190`;
CREATE TABLE `f43_labor_184_newborn_190` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_labor_185_newborn_191
-- ----------------------------
DROP TABLE IF EXISTS `f43_labor_185_newborn_191`;
CREATE TABLE `f43_labor_185_newborn_191` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_ncdscreen_166
-- ----------------------------
DROP TABLE IF EXISTS `f43_ncdscreen_166`;
CREATE TABLE `f43_ncdscreen_166` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_ncdscreen_167
-- ----------------------------
DROP TABLE IF EXISTS `f43_ncdscreen_167`;
CREATE TABLE `f43_ncdscreen_167` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_ncdscreen_168
-- ----------------------------
DROP TABLE IF EXISTS `f43_ncdscreen_168`;
CREATE TABLE `f43_ncdscreen_168` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_ncdscreen_169
-- ----------------------------
DROP TABLE IF EXISTS `f43_ncdscreen_169`;
CREATE TABLE `f43_ncdscreen_169` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_ncdscreen_170
-- ----------------------------
DROP TABLE IF EXISTS `f43_ncdscreen_170`;
CREATE TABLE `f43_ncdscreen_170` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_newborn_18_pp
-- ----------------------------
DROP TABLE IF EXISTS `f43_newborn_18_pp`;
CREATE TABLE `f43_newborn_18_pp` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_newborn_192
-- ----------------------------
DROP TABLE IF EXISTS `f43_newborn_192`;
CREATE TABLE `f43_newborn_192` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_newborn_193
-- ----------------------------
DROP TABLE IF EXISTS `f43_newborn_193`;
CREATE TABLE `f43_newborn_193` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_newborn_194
-- ----------------------------
DROP TABLE IF EXISTS `f43_newborn_194`;
CREATE TABLE `f43_newborn_194` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_newborncare_196
-- ----------------------------
DROP TABLE IF EXISTS `f43_newborncare_196`;
CREATE TABLE `f43_newborncare_196` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_newborncare_197
-- ----------------------------
DROP TABLE IF EXISTS `f43_newborncare_197`;
CREATE TABLE `f43_newborncare_197` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_nutrition_201
-- ----------------------------
DROP TABLE IF EXISTS `f43_nutrition_201`;
CREATE TABLE `f43_nutrition_201` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_nutrition_202
-- ----------------------------
DROP TABLE IF EXISTS `f43_nutrition_202`;
CREATE TABLE `f43_nutrition_202` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_nutrition_203
-- ----------------------------
DROP TABLE IF EXISTS `f43_nutrition_203`;
CREATE TABLE `f43_nutrition_203` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_1
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_1`;
CREATE TABLE `f43_person_1` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `abbreviations` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `dopa` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `sort` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=505 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_10
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_10`;
CREATE TABLE `f43_person_10` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_11
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_11`;
CREATE TABLE `f43_person_11` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_12
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_12`;
CREATE TABLE `f43_person_12` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_13
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_13`;
CREATE TABLE `f43_person_13` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_14
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_14`;
CREATE TABLE `f43_person_14` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_15
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_15`;
CREATE TABLE `f43_person_15` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_16
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_16`;
CREATE TABLE `f43_person_16` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_2
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_2`;
CREATE TABLE `f43_person_2` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_3
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_3`;
CREATE TABLE `f43_person_3` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_5
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_5`;
CREATE TABLE `f43_person_5` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=780 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_6_7
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_6_7`;
CREATE TABLE `f43_person_6_7` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=273 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_8
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_8`;
CREATE TABLE `f43_person_8` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_person_9
-- ----------------------------
DROP TABLE IF EXISTS `f43_person_9`;
CREATE TABLE `f43_person_9` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_policy_209
-- ----------------------------
DROP TABLE IF EXISTS `f43_policy_209`;
CREATE TABLE `f43_policy_209` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `year` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_portal
-- ----------------------------
DROP TABLE IF EXISTS `f43_portal`;
CREATE TABLE `f43_portal` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ban` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `tambon` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amphor` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `province` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`),
  KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_postnatal_186
-- ----------------------------
DROP TABLE IF EXISTS `f43_postnatal_186`;
CREATE TABLE `f43_postnatal_186` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_prenatal_174
-- ----------------------------
DROP TABLE IF EXISTS `f43_prenatal_174`;
CREATE TABLE `f43_prenatal_174` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_prenatal_175
-- ----------------------------
DROP TABLE IF EXISTS `f43_prenatal_175`;
CREATE TABLE `f43_prenatal_175` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_prenatal_176
-- ----------------------------
DROP TABLE IF EXISTS `f43_prenatal_176`;
CREATE TABLE `f43_prenatal_176` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_prenatal_177
-- ----------------------------
DROP TABLE IF EXISTS `f43_prenatal_177`;
CREATE TABLE `f43_prenatal_177` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_provider_61
-- ----------------------------
DROP TABLE IF EXISTS `f43_provider_61`;
CREATE TABLE `f43_provider_61` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_provider_62
-- ----------------------------
DROP TABLE IF EXISTS `f43_provider_62`;
CREATE TABLE `f43_provider_62` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_ptright
-- ----------------------------
DROP TABLE IF EXISTS `f43_ptright`;
CREATE TABLE `f43_ptright` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `comment` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=111 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_rehabilitation_163
-- ----------------------------
DROP TABLE IF EXISTS `f43_rehabilitation_163`;
CREATE TABLE `f43_rehabilitation_163` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_service_75
-- ----------------------------
DROP TABLE IF EXISTS `f43_service_75`;
CREATE TABLE `f43_service_75` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_service_76
-- ----------------------------
DROP TABLE IF EXISTS `f43_service_76`;
CREATE TABLE `f43_service_76` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_service_78
-- ----------------------------
DROP TABLE IF EXISTS `f43_service_78`;
CREATE TABLE `f43_service_78` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_service_80_refer_history_84
-- ----------------------------
DROP TABLE IF EXISTS `f43_service_80_refer_history_84`;
CREATE TABLE `f43_service_80_refer_history_84` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_service_81
-- ----------------------------
DROP TABLE IF EXISTS `f43_service_81`;
CREATE TABLE `f43_service_81` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_service_82
-- ----------------------------
DROP TABLE IF EXISTS `f43_service_82`;
CREATE TABLE `f43_service_82` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_specialpp_204
-- ----------------------------
DROP TABLE IF EXISTS `f43_specialpp_204`;
CREATE TABLE `f43_specialpp_204` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_specialpp_205
-- ----------------------------
DROP TABLE IF EXISTS `f43_specialpp_205`;
CREATE TABLE `f43_specialpp_205` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_surveil_105
-- ----------------------------
DROP TABLE IF EXISTS `f43_surveil_105`;
CREATE TABLE `f43_surveil_105` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_surveil_106
-- ----------------------------
DROP TABLE IF EXISTS `f43_surveil_106`;
CREATE TABLE `f43_surveil_106` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `codegroup` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `codecom` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `codename` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_surveil_107
-- ----------------------------
DROP TABLE IF EXISTS `f43_surveil_107`;
CREATE TABLE `f43_surveil_107` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `codegroup` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `codeorg` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `nameorg` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=179 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_surveillance_98
-- ----------------------------
DROP TABLE IF EXISTS `f43_surveillance_98`;
CREATE TABLE `f43_surveillance_98` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=60 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_village_55
-- ----------------------------
DROP TABLE IF EXISTS `f43_village_55`;
CREATE TABLE `f43_village_55` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for f43_village_56
-- ----------------------------
DROP TABLE IF EXISTS `f43_village_56`;
CREATE TABLE `f43_village_56` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for failed_jobs
-- ----------------------------
DROP TABLE IF EXISTS `failed_jobs`;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `connection` text COLLATE utf8_unicode_ci NOT NULL,
  `queue` text COLLATE utf8_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for file_dcorder
-- ----------------------------
DROP TABLE IF EXISTS `file_dcorder`;
CREATE TABLE `file_dcorder` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `an` varchar(10) NOT NULL,
  `fname` varchar(40) NOT NULL,
  `drugok` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`row_id`),
  KEY `thidate` (`thidate`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=473 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for food
-- ----------------------------
DROP TABLE IF EXISTS `food`;
CREATE TABLE `food` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `regisdate` varchar(40) NOT NULL,
  `an` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `bedcode` varchar(20) NOT NULL,
  `bedpri` double(8,2) NOT NULL,
  `food` varchar(250) NOT NULL,
  `typefood` varchar(50) NOT NULL,
  `bedname` varchar(100) NOT NULL,
  `officer` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=471518 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for fp
-- ----------------------------
DROP TABLE IF EXISTS `fp`;
CREATE TABLE `fp` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `seq` varchar(16) NOT NULL,
  `date_serv` varchar(14) NOT NULL,
  `fptype` varchar(1) NOT NULL,
  `did` varchar(30) NOT NULL,
  `amount` varchar(3) NOT NULL,
  `fpplace` varchar(5) NOT NULL,
  `d_update` varchar(14) NOT NULL,
  `cid` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for geography
-- ----------------------------
DROP TABLE IF EXISTS `geography`;
CREATE TABLE `geography` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for goup
-- ----------------------------
DROP TABLE IF EXISTS `goup`;
CREATE TABLE `goup` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for grouptype
-- ----------------------------
DROP TABLE IF EXISTS `grouptype`;
CREATE TABLE `grouptype` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) NOT NULL,
  `type` varchar(1) NOT NULL,
  `subtype` varchar(5) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'y',
  `mean` char(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for gsbdata
-- ----------------------------
DROP TABLE IF EXISTS `gsbdata`;
CREATE TABLE `gsbdata` (
  `Emp_Code` varchar(20) NOT NULL,
  `Title` varchar(10) DEFAULT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `Lname` varchar(50) DEFAULT NULL,
  `Idcard` varchar(13) DEFAULT NULL,
  `Start_Date` varchar(10) DEFAULT NULL,
  `Per_Status` varchar(1) DEFAULT NULL,
  `Emp_Type` varchar(50) DEFAULT NULL,
  `End_Date` varchar(10) DEFAULT NULL,
  `Pre_Age` varchar(2) DEFAULT NULL,
  `Group_Name` varchar(200) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for guardtype
-- ----------------------------
DROP TABLE IF EXISTS `guardtype`;
CREATE TABLE `guardtype` (
  `guard_id` int(5) NOT NULL AUTO_INCREMENT,
  `guard_code` varchar(10) NOT NULL,
  `guard_name` varchar(50) NOT NULL,
  `guard_comment` text NOT NULL,
  PRIMARY KEY (`guard_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for gyn_newborn
-- ----------------------------
DROP TABLE IF EXISTS `gyn_newborn`;
CREATE TABLE `gyn_newborn` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) DEFAULT NULL,
  `PID` varchar(15) DEFAULT NULL,
  `MPID` varchar(15) DEFAULT NULL,
  `GRAVIDA` varchar(11) DEFAULT NULL,
  `GA` varchar(2) DEFAULT NULL,
  `BDATE` varchar(8) DEFAULT NULL,
  `BTIME` varchar(6) DEFAULT NULL,
  `BPLACE` varchar(1) DEFAULT NULL,
  `BHOSP` varchar(5) DEFAULT NULL,
  `BIRTHNO` varchar(1) DEFAULT NULL,
  `BTYPE` varchar(1) DEFAULT NULL,
  `BDOCTOR` varchar(1) DEFAULT NULL,
  `BWEIGHT` varchar(4) DEFAULT NULL,
  `ASPHYXIA` varchar(2) DEFAULT NULL,
  `VITK` varchar(1) DEFAULT NULL,
  `TSH` varchar(1) DEFAULT NULL,
  `TSHRESULT` varchar(5) DEFAULT NULL,
  `D_UPDATE` varchar(14) DEFAULT NULL,
  `date_visit` datetime DEFAULT NULL,
  `date_added` datetime DEFAULT NULL,
  `hn` varchar(50) DEFAULT NULL,
  `an` varchar(50) DEFAULT NULL,
  `father` varchar(255) DEFAULT NULL,
  `father_id` varchar(13) DEFAULT NULL,
  `mother` varchar(255) DEFAULT NULL,
  `mother_id` varchar(13) DEFAULT NULL,
  `lborn` varchar(255) DEFAULT NULL,
  `head` varchar(255) DEFAULT NULL,
  `breast` varchar(255) DEFAULT NULL,
  `apgar5` varchar(255) DEFAULT NULL,
  `apgar10` varchar(255) DEFAULT NULL,
  `disorder` varchar(255) DEFAULT NULL,
  `disorderDetail` varchar(255) DEFAULT NULL,
  `health` varchar(255) DEFAULT NULL,
  `healthDetail` varchar(255) DEFAULT NULL,
  `pku` varchar(255) DEFAULT NULL,
  `pku_result` varchar(255) DEFAULT NULL,
  `bcgDate` varchar(255) DEFAULT NULL,
  `hbDate` varchar(255) DEFAULT NULL,
  `discharge` varchar(255) DEFAULT NULL,
  `weight_discharge` varchar(255) DEFAULT NULL,
  `latest_edit` datetime DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `MPID` (`MPID`)
) ENGINE=MyISAM AUTO_INCREMENT=303 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hba1c_bs
-- ----------------------------
DROP TABLE IF EXISTS `hba1c_bs`;
CREATE TABLE `hba1c_bs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autonumber` int(11) DEFAULT NULL,
  `labcode` varchar(255) DEFAULT NULL,
  `result` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `orderdate` varchar(255) DEFAULT NULL,
  `yearchk` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `autonumber` (`autonumber`),
  KEY `labcode` (`labcode`),
  KEY `hn` (`hn`),
  KEY `yearchk` (`yearchk`)
) ENGINE=MyISAM AUTO_INCREMENT=9929 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hiv
-- ----------------------------
DROP TABLE IF EXISTS `hiv`;
CREATE TABLE `hiv` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(20) NOT NULL,
  `hivnumber` int(11) DEFAULT NULL,
  `napnumber` varchar(20) DEFAULT NULL,
  `hn` varchar(20) DEFAULT NULL,
  `ptname` varchar(100) DEFAULT NULL,
  `address` text,
  `age` varchar(20) DEFAULT NULL,
  `ptright` varchar(50) DEFAULT NULL,
  `doctor` varchar(50) DEFAULT NULL,
  `arv_date` varchar(20) DEFAULT NULL,
  `symp_hiv` varchar(20) DEFAULT NULL,
  `cd4_start` varchar(20) DEFAULT NULL,
  `cd4_regis` varchar(20) DEFAULT NULL,
  `phar` varchar(100) DEFAULT NULL,
  `sideefect` varchar(100) DEFAULT NULL,
  `claim` varchar(30) DEFAULT NULL,
  `date_regis` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=779 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for hiv_lab
-- ----------------------------
DROP TABLE IF EXISTS `hiv_lab`;
CREATE TABLE `hiv_lab` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(20) NOT NULL,
  `labname` varchar(50) NOT NULL,
  `m1` varchar(50) NOT NULL,
  `m2` varchar(50) NOT NULL,
  `m3` varchar(50) NOT NULL,
  `m4` varchar(50) NOT NULL,
  `m5` varchar(50) NOT NULL,
  `m6` varchar(50) NOT NULL,
  `m7` varchar(50) NOT NULL,
  `m8` varchar(50) NOT NULL,
  `m9` varchar(50) NOT NULL,
  `m10` varchar(50) NOT NULL,
  `m11` varchar(50) NOT NULL,
  `m12` varchar(50) NOT NULL,
  `claim` varchar(20) NOT NULL,
  `register_date` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=9361 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for hiv_lab_nhso
-- ----------------------------
DROP TABLE IF EXISTS `hiv_lab_nhso`;
CREATE TABLE `hiv_lab_nhso` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(20) NOT NULL,
  `labname` varchar(50) NOT NULL,
  `m1` varchar(50) NOT NULL,
  `m2` varchar(50) NOT NULL,
  `m3` varchar(50) NOT NULL,
  `m4` varchar(50) NOT NULL,
  `m5` varchar(50) NOT NULL,
  `m6` varchar(50) NOT NULL,
  `m7` varchar(50) NOT NULL,
  `m8` varchar(50) NOT NULL,
  `m9` varchar(50) NOT NULL,
  `m10` varchar(50) NOT NULL,
  `m11` varchar(50) NOT NULL,
  `m12` varchar(50) NOT NULL,
  `register_date` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hiv_lab_vp
-- ----------------------------
DROP TABLE IF EXISTS `hiv_lab_vp`;
CREATE TABLE `hiv_lab_vp` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` varchar(20) NOT NULL,
  `labname` varchar(50) NOT NULL,
  `m1` varchar(50) NOT NULL,
  `m2` varchar(50) NOT NULL,
  `m3` varchar(50) NOT NULL,
  `m4` varchar(50) NOT NULL,
  `m5` varchar(50) NOT NULL,
  `m6` varchar(50) NOT NULL,
  `m7` varchar(50) NOT NULL,
  `m8` varchar(50) NOT NULL,
  `m9` varchar(50) NOT NULL,
  `m10` varchar(50) NOT NULL,
  `m11` varchar(50) NOT NULL,
  `m12` varchar(50) NOT NULL,
  `register_date` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2844 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hiv_nhso
-- ----------------------------
DROP TABLE IF EXISTS `hiv_nhso`;
CREATE TABLE `hiv_nhso` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `nhso_id` int(11) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `address` text,
  `age` varchar(20) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `arv_date` varchar(20) NOT NULL,
  `symp_hiv` varchar(20) NOT NULL,
  `cd4_start` varchar(20) NOT NULL,
  `cd4_regis` varchar(20) NOT NULL,
  `phar` varchar(100) NOT NULL,
  `sideefect` varchar(100) NOT NULL,
  `date_regis` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hiv_vo
-- ----------------------------
DROP TABLE IF EXISTS `hiv_vo`;
CREATE TABLE `hiv_vo` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `vo_id` int(11) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `address` text,
  `age` varchar(20) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `arv_date` varchar(20) NOT NULL,
  `symp_hiv` varchar(20) NOT NULL,
  `cd4_start` varchar(20) NOT NULL,
  `cd4_regis` varchar(20) NOT NULL,
  `phar` varchar(100) NOT NULL,
  `sideefect` varchar(100) NOT NULL,
  `date_regis` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=127 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hiv_vp
-- ----------------------------
DROP TABLE IF EXISTS `hiv_vp`;
CREATE TABLE `hiv_vp` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `vp_id` int(11) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `address` text,
  `age` varchar(20) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `arv_date` varchar(20) NOT NULL,
  `symp_hiv` varchar(20) NOT NULL,
  `cd4_start` varchar(20) NOT NULL,
  `cd4_regis` varchar(20) NOT NULL,
  `phar` varchar(100) NOT NULL,
  `sideefect` varchar(100) NOT NULL,
  `date_regis` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=237 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for holiday
-- ----------------------------
DROP TABLE IF EXISTS `holiday`;
CREATE TABLE `holiday` (
  `row_id` int(3) NOT NULL AUTO_INCREMENT,
  `date_holiday` varchar(30) DEFAULT '0000-00-00',
  `detail` varchar(256) DEFAULT NULL,
  `doctor` varchar(100) NOT NULL,
  `userkey` varchar(50) DEFAULT NULL,
  `datekey` datetime NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `date_holiday` (`date_holiday`)
) ENGINE=MyISAM AUTO_INCREMENT=411 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for home
-- ----------------------------
DROP TABLE IF EXISTS `home`;
CREATE TABLE `home` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `pcucode` varchar(5) DEFAULT NULL,
  `hid` varchar(15) DEFAULT NULL,
  `house_id` varchar(20) DEFAULT NULL,
  `housetype` varchar(255) DEFAULT NULL,
  `roomno` varchar(255) DEFAULT NULL,
  `condo` varchar(255) DEFAULT NULL,
  `house` varchar(100) DEFAULT NULL,
  `soisub` varchar(255) DEFAULT NULL,
  `soimain` varchar(255) DEFAULT NULL,
  `road` varchar(50) DEFAULT NULL,
  `villaname` varchar(255) DEFAULT NULL,
  `village` varchar(5) DEFAULT NULL,
  `tambon` varchar(50) DEFAULT NULL,
  `ampur` varchar(50) DEFAULT NULL,
  `changwat` varchar(50) DEFAULT NULL,
  `telephone` varchar(255) DEFAULT NULL,
  `latitude` varchar(255) DEFAULT NULL,
  `longitude` varchar(255) DEFAULT NULL,
  `nfamily` varchar(5) DEFAULT NULL,
  `locatype` varchar(5) DEFAULT NULL,
  `vhvid` varchar(13) DEFAULT NULL,
  `headid` varchar(13) DEFAULT NULL,
  `toillet` varchar(5) DEFAULT NULL,
  `water` varchar(5) DEFAULT NULL,
  `wattype` varchar(5) DEFAULT NULL,
  `garbage` varchar(5) DEFAULT NULL,
  `housing` varchar(255) DEFAULT NULL,
  `durability` varchar(255) DEFAULT NULL,
  `cleanliness` varchar(255) DEFAULT NULL,
  `ventilation` varchar(255) DEFAULT NULL,
  `light` varchar(5) DEFAULT NULL,
  `watertm` varchar(5) DEFAULT NULL,
  `mfood` varchar(5) DEFAULT NULL,
  `bcontrol` varchar(5) DEFAULT NULL,
  `acontrol` varchar(5) DEFAULT NULL,
  `chemical` varchar(255) DEFAULT NULL,
  `outdate` datetime DEFAULT NULL,
  `d_update` varchar(15) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hospcode
-- ----------------------------
DROP TABLE IF EXISTS `hospcode`;
CREATE TABLE `hospcode` (
  `amppart` char(2) DEFAULT NULL,
  `chwpart` char(2) DEFAULT NULL,
  `hospcode` varchar(5) NOT NULL DEFAULT '',
  `hosptype` varchar(50) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `tmbpart` char(2) DEFAULT NULL,
  `moopart` char(2) DEFAULT NULL,
  `sss_code` varchar(12) DEFAULT NULL,
  `sss_code_sub` varchar(12) DEFAULT NULL,
  `hospcode506` varchar(15) DEFAULT NULL,
  `hospital_type_id` int(11) DEFAULT NULL,
  `bed_count` int(11) DEFAULT NULL,
  `po_code` varchar(5) DEFAULT NULL,
  `hospital_level_id` int(11) DEFAULT NULL,
  `hospital_phone` varchar(50) DEFAULT NULL,
  `hospital_fax` varchar(50) DEFAULT NULL,
  `hos_guid` varchar(38) DEFAULT NULL,
  PRIMARY KEY (`hospcode`),
  KEY `amppart` (`amppart`),
  KEY `chwpart` (`chwpart`),
  KEY `hosptype` (`hosptype`),
  KEY `name` (`name`),
  KEY `tmbpart` (`tmbpart`),
  KEY `tmbpart_amppart` (`tmbpart`,`amppart`,`chwpart`),
  KEY `ix_hos_guid` (`hos_guid`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hypertension_clinic
-- ----------------------------
DROP TABLE IF EXISTS `hypertension_clinic`;
CREATE TABLE `hypertension_clinic` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ht_no` int(11) DEFAULT NULL,
  `thidate` varchar(50) NOT NULL,
  `dateN` varchar(20) DEFAULT NULL,
  `hn` varchar(30) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `diagnosis` varchar(10) NOT NULL,
  `ht` varchar(10) NOT NULL,
  `joint_disease` int(1) NOT NULL,
  `joint_disease_dm` varchar(1) NOT NULL,
  `joint_disease_nephritic` varchar(1) NOT NULL,
  `joint_disease_myocardial` varchar(1) NOT NULL,
  `joint_disease_paralysis` varchar(1) NOT NULL,
  `smork` varchar(10) NOT NULL,
  `bmi` varchar(20) NOT NULL,
  `height` varchar(30) NOT NULL,
  `weight` varchar(30) NOT NULL,
  `round` varchar(30) NOT NULL,
  `temperature` varchar(30) NOT NULL,
  `pause` varchar(30) NOT NULL,
  `rate` varchar(30) NOT NULL,
  `bp1` varchar(30) NOT NULL,
  `bp2` varchar(30) NOT NULL,
  `officer` varchar(100) NOT NULL,
  `officer_edit` varchar(100) NOT NULL,
  `register_date` varchar(40) NOT NULL,
  `pension` varchar(20) NOT NULL,
  `age_str` varchar(255) DEFAULT NULL,
  `diag_date` varchar(10) DEFAULT NULL,
  `bp3` int(11) DEFAULT NULL,
  `bp4` int(11) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6073 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for hypertension_history
-- ----------------------------
DROP TABLE IF EXISTS `hypertension_history`;
CREATE TABLE `hypertension_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ht_no` int(11) DEFAULT NULL,
  `thidate` varchar(50) NOT NULL,
  `dateN` varchar(20) DEFAULT NULL,
  `hn` varchar(30) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `diagnosis` varchar(10) NOT NULL,
  `ht` varchar(10) NOT NULL,
  `joint_disease` int(1) NOT NULL,
  `joint_disease_dm` varchar(1) NOT NULL,
  `joint_disease_nephritic` varchar(1) NOT NULL,
  `joint_disease_myocardial` varchar(1) NOT NULL,
  `joint_disease_paralysis` varchar(1) NOT NULL,
  `smork` varchar(10) NOT NULL,
  `bmi` varchar(20) NOT NULL,
  `height` varchar(30) NOT NULL,
  `weight` varchar(30) NOT NULL,
  `round` varchar(30) NOT NULL,
  `temperature` varchar(30) NOT NULL,
  `pause` varchar(30) NOT NULL,
  `rate` varchar(30) NOT NULL,
  `bp1` varchar(30) NOT NULL,
  `bp2` varchar(30) NOT NULL,
  `officer` varchar(100) NOT NULL,
  `officer_edit` varchar(100) NOT NULL,
  `register_date` varchar(40) NOT NULL,
  `pension` varchar(20) NOT NULL,
  `age_str` varchar(255) NOT NULL,
  `edit_date` datetime DEFAULT NULL,
  `diag_date` varchar(10) DEFAULT NULL,
  `bp3` int(11) DEFAULT NULL,
  `bp4` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `thidate` (`thidate`)
) ENGINE=MyISAM AUTO_INCREMENT=11922 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ic_accident
-- ----------------------------
DROP TABLE IF EXISTS `ic_accident`;
CREATE TABLE `ic_accident` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `regisdate` varchar(40) NOT NULL,
  `thidate` varchar(40) NOT NULL,
  `hn` varchar(30) NOT NULL,
  `depart` varchar(50) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `age` varchar(30) NOT NULL,
  `staff` varchar(50) NOT NULL,
  `staff_other` varchar(50) NOT NULL,
  `ac_type1` varchar(100) DEFAULT NULL,
  `ac_by` varchar(20) NOT NULL,
  `ac_by_detail` varchar(50) NOT NULL,
  `ac_type2` varchar(100) DEFAULT NULL,
  `ac_type3` varchar(100) NOT NULL,
  `ac_type4` varchar(100) NOT NULL,
  `ac_type5` varchar(100) NOT NULL,
  `ac_detail` text NOT NULL,
  `ac_organ` varchar(30) NOT NULL,
  `first_aid` varchar(50) NOT NULL,
  `9hivab` varchar(20) NOT NULL,
  `9hivag` varchar(20) NOT NULL,
  `9hbsag` varchar(20) NOT NULL,
  `9hbsab` varchar(20) NOT NULL,
  `9history` varchar(20) NOT NULL,
  `ac101` varchar(20) NOT NULL,
  `ac102` varchar(20) NOT NULL,
  `ac103` varchar(20) NOT NULL,
  `ac104` varchar(20) NOT NULL,
  `11hivab` varchar(20) NOT NULL,
  `11hivag` varchar(20) NOT NULL,
  `11hbsag` varchar(20) NOT NULL,
  `11hbsab` varchar(20) NOT NULL,
  `11history` varchar(20) NOT NULL,
  `12detail` varchar(50) NOT NULL,
  `19detail1` varchar(100) NOT NULL,
  `19detail2` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ic_accident_azt
-- ----------------------------
DROP TABLE IF EXISTS `ic_accident_azt`;
CREATE TABLE `ic_accident_azt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` int(11) NOT NULL,
  `start` varchar(20) NOT NULL,
  `hemoglobin` varchar(30) NOT NULL,
  `hematocrit` varchar(30) NOT NULL,
  `red_cell` varchar(30) NOT NULL,
  `wbc` varchar(30) NOT NULL,
  `neutrophil` varchar(30) NOT NULL,
  `lymphocyte` varchar(30) NOT NULL,
  `monocytes` varchar(30) NOT NULL,
  `basophil` varchar(30) NOT NULL,
  `eosinophil` varchar(30) NOT NULL,
  `band` varchar(30) NOT NULL,
  `platelet` varchar(30) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ic_accident_pi
-- ----------------------------
DROP TABLE IF EXISTS `ic_accident_pi`;
CREATE TABLE `ic_accident_pi` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ref_id` int(11) NOT NULL,
  `after_cbc` varchar(30) NOT NULL,
  `hiv_ab` varchar(30) NOT NULL,
  `hiv_ag` varchar(30) NOT NULL,
  `hbs_ag` varchar(30) NOT NULL,
  `hbs_ab` varchar(30) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=73 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ic_infection
-- ----------------------------
DROP TABLE IF EXISTS `ic_infection`;
CREATE TABLE `ic_infection` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `registerdate` varchar(40) NOT NULL,
  `an` varchar(30) NOT NULL,
  `hn` varchar(30) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `age` varchar(20) NOT NULL,
  `ptright` varchar(30) NOT NULL,
  `addate` varchar(40) NOT NULL,
  `dcdate` varchar(40) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `diag1` varchar(50) NOT NULL,
  `diag2` varchar(50) NOT NULL,
  `diag3` varchar(50) NOT NULL,
  `diag4` varchar(50) NOT NULL,
  `date1` varchar(50) NOT NULL,
  `disease` varchar(50) NOT NULL,
  `status_dc` varchar(50) NOT NULL,
  `refer_host` varchar(50) NOT NULL,
  `date2` varchar(50) NOT NULL,
  `respirator` varchar(50) NOT NULL,
  `date3` varchar(50) NOT NULL,
  `date4` varchar(50) NOT NULL,
  `surgery` varchar(50) NOT NULL,
  `surgeryor` varchar(50) NOT NULL,
  `date5` varchar(50) NOT NULL,
  `birth` varchar(50) NOT NULL,
  `date6` varchar(50) NOT NULL,
  `procedure` varchar(250) DEFAULT NULL,
  `dateproc` varchar(20) NOT NULL,
  `date7` varchar(50) NOT NULL,
  `fever` varchar(50) NOT NULL,
  `date8` varchar(50) NOT NULL,
  `urine` varchar(50) NOT NULL,
  `date9` varchar(50) NOT NULL,
  `abdominal` varchar(50) NOT NULL,
  `date10` varchar(50) NOT NULL,
  `pubis` varchar(50) NOT NULL,
  `date11` varchar(50) NOT NULL,
  `cough` varchar(50) NOT NULL,
  `date12` varchar(50) NOT NULL,
  `wound` varchar(50) NOT NULL,
  `date13` varchar(50) NOT NULL,
  `episiotomy` varchar(50) NOT NULL,
  `date14` varchar(50) NOT NULL,
  `smell` varchar(50) NOT NULL,
  `date15` varchar(50) NOT NULL,
  `skin` varchar(50) NOT NULL,
  `date16` varchar(50) DEFAULT NULL,
  `initial_diag` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for icd10
-- ----------------------------
DROP TABLE IF EXISTS `icd10`;
CREATE TABLE `icd10` (
  `code` varchar(10) NOT NULL,
  `status` varchar(5) NOT NULL,
  `status1` varchar(2) NOT NULL,
  `date` varchar(10) NOT NULL,
  `detail` varchar(150) DEFAULT NULL,
  `diag_eng` varchar(100) NOT NULL,
  `diag_thai` varchar(100) NOT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for icd506
-- ----------------------------
DROP TABLE IF EXISTS `icd506`;
CREATE TABLE `icd506` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `icd10` varchar(15) DEFAULT NULL,
  `depart_thai` varchar(150) DEFAULT NULL,
  `depart_eng` varchar(200) NOT NULL,
  `code` varchar(3) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=154 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for icd9cm
-- ----------------------------
DROP TABLE IF EXISTS `icd9cm`;
CREATE TABLE `icd9cm` (
  `code` varchar(10) DEFAULT NULL,
  `status` varchar(2) NOT NULL,
  `status1` varchar(2) NOT NULL,
  `date` varchar(10) DEFAULT NULL,
  `detail` varchar(150) DEFAULT NULL,
  KEY `code` (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for icdthai
-- ----------------------------
DROP TABLE IF EXISTS `icdthai`;
CREATE TABLE `icdthai` (
  `code` char(8) DEFAULT NULL,
  `detail` char(236) DEFAULT NULL,
  `diag_thai` char(198) DEFAULT NULL,
  `DIAG_298` decimal(10,0) DEFAULT NULL,
  `DIAG_21GRO` decimal(10,0) DEFAULT NULL,
  `DIAG_506` decimal(10,0) DEFAULT NULL,
  `DIAG_CHRON` decimal(10,0) DEFAULT NULL,
  `DIAG_SUB_C` decimal(10,0) DEFAULT NULL,
  `VALID` char(5) DEFAULT NULL,
  `diag_eng` varchar(100) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  KEY `code` (`code`),
  KEY `diag_thai` (`diag_thai`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ICF
-- ----------------------------
DROP TABLE IF EXISTS `ICF`;
CREATE TABLE `ICF` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) NOT NULL,
  `ICF` varchar(10) NOT NULL,
  `last_update` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for icf_code
-- ----------------------------
DROP TABLE IF EXISTS `icf_code`;
CREATE TABLE `icf_code` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(255) DEFAULT NULL,
  `detail` text,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=303 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for icf_icf
-- ----------------------------
DROP TABLE IF EXISTS `icf_icf`;
CREATE TABLE `icf_icf` (
  `id` varchar(10) NOT NULL,
  `detail` text NOT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for icf43
-- ----------------------------
DROP TABLE IF EXISTS `icf43`;
CREATE TABLE `icf43` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `disabid` varchar(13) DEFAULT NULL,
  `pid` varchar(15) DEFAULT NULL,
  `seq` varchar(16) DEFAULT NULL,
  `date_serv` varchar(8) DEFAULT NULL,
  `icf` varchar(6) DEFAULT NULL,
  `qualifier` varchar(1) DEFAULT NULL,
  `provider` varchar(15) DEFAULT NULL,
  `d_update` varchar(14) DEFAULT NULL,
  `cid` varchar(13) DEFAULT NULL,
  `opday_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2717 DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB AUTO_INCREMENT=435 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for indicator_field
-- ----------------------------
DROP TABLE IF EXISTS `indicator_field`;
CREATE TABLE `indicator_field` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `main_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `target` varchar(255) DEFAULT NULL,
  `depart` varchar(255) DEFAULT NULL,
  `date_create` varchar(255) DEFAULT NULL,
  `date_edit` varchar(255) DEFAULT NULL,
  `creater` varchar(255) DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `sort` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `main_id` (`main_id`)
) ENGINE=InnoDB AUTO_INCREMENT=433 DEFAULT CHARSET=utf8;

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
  `sort` int(10) DEFAULT NULL,
  `parent` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for inhale_wound
-- ----------------------------
DROP TABLE IF EXISTS `inhale_wound`;
CREATE TABLE `inhale_wound` (
  `row_id` int(50) NOT NULL AUTO_INCREMENT,
  `hn` varchar(12) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `yot` varchar(10) NOT NULL DEFAULT '',
  `name` varchar(100) DEFAULT NULL,
  `sname` varchar(100) DEFAULT NULL,
  `startdate` date DEFAULT NULL,
  `enddate` date DEFAULT NULL,
  `idname` varchar(100) DEFAULT NULL,
  `size_wound` char(1) DEFAULT NULL,
  `total_day` tinyint(12) DEFAULT NULL,
  `detail` varchar(200) DEFAULT NULL,
  `remark` varchar(100) NOT NULL DEFAULT '',
  `remark2` varchar(50) NOT NULL DEFAULT '',
  `detail2` text NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=208116 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for inputm
-- ----------------------------
DROP TABLE IF EXISTS `inputm`;
CREATE TABLE `inputm` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) DEFAULT NULL,
  `idname` varchar(40) DEFAULT NULL,
  `pword` varchar(16) DEFAULT NULL,
  `menucode` varchar(24) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `codedoctor` varchar(5) DEFAULT NULL,
  `mdcode` varchar(10) DEFAULT NULL,
  `id` varchar(15) NOT NULL,
  `room_app` varchar(1) NOT NULL,
  `date_pword` datetime NOT NULL,
  `level` varchar(6) DEFAULT NULL,
  `report_tnb` varchar(1) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `idname` (`idname`),
  KEY `id` (`idname`),
  KEY `pw` (`pword`)
) ENGINE=MyISAM AUTO_INCREMENT=1070 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for internet
-- ----------------------------
DROP TABLE IF EXISTS `internet`;
CREATE TABLE `internet` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `register` varchar(20) NOT NULL,
  `type_net` varchar(10) NOT NULL,
  `user` varchar(50) NOT NULL,
  `pass` varchar(50) NOT NULL,
  `idcard` varchar(50) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `officer` varchar(50) NOT NULL,
  `menucode` varchar(50) NOT NULL,
  `date_service` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26177 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipacc
-- ----------------------------
DROP TABLE IF EXISTS `ipacc`;
CREATE TABLE `ipacc` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `paid` double(10,2) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `yprice` double(10,2) NOT NULL,
  `nprice` double(10,2) NOT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `startdatetime` varchar(30) DEFAULT NULL,
  `enddatetime` varchar(30) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `officemon` varchar(50) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=5187088 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipacc_aipn
-- ----------------------------
DROP TABLE IF EXISTS `ipacc_aipn`;
CREATE TABLE `ipacc_aipn` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `paid` double(10,2) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `yprice` double(10,2) NOT NULL,
  `nprice` double(10,2) NOT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `startdatetime` varchar(30) DEFAULT NULL,
  `enddatetime` varchar(30) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `officemon` varchar(50) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=5164960 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipacc_cipn
-- ----------------------------
DROP TABLE IF EXISTS `ipacc_cipn`;
CREATE TABLE `ipacc_cipn` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `paid` double(10,2) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `yprice` double(10,2) NOT NULL,
  `nprice` double(10,2) NOT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `startdatetime` varchar(30) DEFAULT NULL,
  `enddatetime` varchar(30) DEFAULT NULL,
  `status` varchar(20) NOT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `officemon` varchar(50) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=5046300 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipcard
-- ----------------------------
DROP TABLE IF EXISTS `ipcard`;
CREATE TABLE `ipcard` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `an` varchar(12) NOT NULL DEFAULT '',
  `hn` varchar(12) NOT NULL DEFAULT '',
  `ptname` varchar(40) DEFAULT NULL,
  `age` varchar(24) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `goup` varchar(40) DEFAULT NULL,
  `camp` varchar(32) DEFAULT NULL,
  `bedcode` varchar(8) DEFAULT NULL,
  `dcdate` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `days` int(4) DEFAULT NULL,
  `dcstatus` varchar(4) DEFAULT NULL,
  `diag` varchar(56) DEFAULT NULL,
  `icd10` varchar(20) DEFAULT NULL,
  `comorbid` varchar(16) DEFAULT NULL,
  `complica` varchar(16) DEFAULT NULL,
  `other` varchar(20) DEFAULT NULL,
  `extcause` varchar(32) DEFAULT NULL,
  `icd9cm` varchar(20) DEFAULT NULL,
  `second` varchar(16) DEFAULT NULL,
  `result` varchar(16) DEFAULT NULL,
  `dctype` varchar(20) DEFAULT NULL,
  `doctor` varchar(48) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `calc` varchar(30) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `bed` varchar(15) DEFAULT NULL,
  `ajrw` varchar(10) DEFAULT NULL,
  `priceajrw` varchar(15) DEFAULT NULL,
  `my_ward` varchar(100) DEFAULT NULL,
  `my_bedcode` varchar(7) DEFAULT NULL,
  `my_earnest` int(2) DEFAULT NULL,
  `my_confirmbk` varchar(20) DEFAULT NULL,
  `my_food` int(2) DEFAULT NULL,
  `my_cure` int(2) DEFAULT NULL,
  `my_etc` int(2) DEFAULT NULL,
  `my_blood` int(2) DEFAULT NULL,
  `my_office` varchar(40) DEFAULT NULL,
  `adm_w` varchar(7) DEFAULT NULL,
  `clinic` varchar(50) NOT NULL,
  `fname` varchar(120) DEFAULT NULL,
  `status_log` varchar(10) NOT NULL,
  `lastcalroom` varchar(20) NOT NULL,
  `dcnumber` varchar(20) NOT NULL,
  `ipmonrep` varchar(20) NOT NULL,
  `lock_dc` varchar(20) DEFAULT NULL,
  `repadmit` varchar(20) NOT NULL,
  `hospital` varchar(100) NOT NULL,
  `dcward` varchar(20) NOT NULL,
  `opreg` varchar(20) NOT NULL,
  `authdt` datetime DEFAULT NULL,
  `typeadmit` varchar(1) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `claimcipn` varchar(1) NOT NULL,
  `adjrw` varchar(10) NOT NULL,
  `claimamt` double(12,2) DEFAULT NULL,
  `claimup` double(12,2) DEFAULT NULL,
  `claimexport_date` datetime NOT NULL,
  `claimedit_date` datetime NOT NULL,
  `reccount` varchar(5) NOT NULL,
  `hi_type` varchar(5) NOT NULL,
  `claimaipn` varchar(1) NOT NULL,
  `diag_thai` varchar(255) NOT NULL,
  `adjrw_manual` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `an` (`an`),
  KEY `admnum` (`an`),
  KEY `dcdate` (`dcdate`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=60368 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipcard_backup
-- ----------------------------
DROP TABLE IF EXISTS `ipcard_backup`;
CREATE TABLE `ipcard_backup` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `an` varchar(12) NOT NULL DEFAULT '',
  `hn` varchar(12) NOT NULL DEFAULT '',
  `ptname` varchar(40) DEFAULT NULL,
  `age` varchar(24) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `goup` varchar(40) DEFAULT NULL,
  `camp` varchar(32) DEFAULT NULL,
  `bedcode` varchar(8) DEFAULT NULL,
  `dcdate` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `days` int(4) DEFAULT NULL,
  `dcstatus` varchar(4) DEFAULT NULL,
  `diag` varchar(56) DEFAULT NULL,
  `icd10` varchar(20) DEFAULT NULL,
  `comorbid` varchar(16) DEFAULT NULL,
  `complica` varchar(16) DEFAULT NULL,
  `other` varchar(20) DEFAULT NULL,
  `extcause` varchar(32) DEFAULT NULL,
  `icd9cm` varchar(20) DEFAULT NULL,
  `second` varchar(16) DEFAULT NULL,
  `result` varchar(16) DEFAULT NULL,
  `dctype` varchar(20) DEFAULT NULL,
  `doctor` varchar(48) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `calc` varchar(30) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `bed` varchar(15) DEFAULT NULL,
  `ajrw` varchar(10) DEFAULT NULL,
  `priceajrw` varchar(15) DEFAULT NULL,
  `my_ward` varchar(20) DEFAULT NULL,
  `my_bedcode` varchar(7) DEFAULT NULL,
  `my_earnest` int(2) DEFAULT NULL,
  `my_confirmbk` varchar(20) DEFAULT NULL,
  `my_food` int(2) DEFAULT NULL,
  `my_cure` int(2) DEFAULT NULL,
  `my_etc` int(2) DEFAULT NULL,
  `my_blood` int(2) DEFAULT NULL,
  `my_office` varchar(40) DEFAULT NULL,
  `adm_w` varchar(7) DEFAULT NULL,
  `clinic` varchar(50) NOT NULL,
  `fname` varchar(120) DEFAULT NULL,
  `status_log` varchar(10) NOT NULL,
  `lastcalroom` varchar(20) NOT NULL,
  `dcnumber` varchar(20) NOT NULL,
  `ipmonrep` varchar(20) NOT NULL,
  `lock_dc` varchar(20) DEFAULT NULL,
  `repadmit` varchar(20) NOT NULL,
  `hospital` varchar(100) NOT NULL,
  `dcward` varchar(20) NOT NULL,
  `opreg` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `an` (`an`),
  KEY `admnum` (`an`),
  KEY `dcdate` (`dcdate`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=50597 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipicd9cm
-- ----------------------------
DROP TABLE IF EXISTS `ipicd9cm`;
CREATE TABLE `ipicd9cm` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `admdate` varchar(30) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `icd9cm` varchar(20) DEFAULT NULL,
  `icddate` varchar(20) DEFAULT NULL,
  `officer` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `admdate` (`admdate`)
) ENGINE=MyISAM AUTO_INCREMENT=47863 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipmonrep
-- ----------------------------
DROP TABLE IF EXISTS `ipmonrep`;
CREATE TABLE `ipmonrep` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `admit` varchar(30) DEFAULT NULL,
  `dcdate` varchar(30) DEFAULT NULL,
  `days` int(4) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `debt` double(12,2) DEFAULT NULL,
  `cash` double(12,2) DEFAULT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `bfy` double(10,2) DEFAULT NULL,
  `bfn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `ddl` double(10,2) DEFAULT NULL,
  `ddy` double(10,2) DEFAULT NULL,
  `ddn` double(10,2) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `blood` double(10,2) DEFAULT NULL,
  `lab` double(10,2) DEFAULT NULL,
  `xray` double(10,2) DEFAULT NULL,
  `sinv` double(10,2) DEFAULT NULL,
  `surg` double(10,2) DEFAULT NULL,
  `ncare` double(10,2) DEFAULT NULL,
  `denta` double(10,2) DEFAULT NULL,
  `pt` double(10,2) DEFAULT NULL,
  `stx` double(10,2) DEFAULT NULL,
  `mc` double(10,2) DEFAULT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `credit` varchar(30) NOT NULL,
  `credit_detail` varchar(30) NOT NULL,
  `tool` double(10,2) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=56759 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipmonrep_aipn
-- ----------------------------
DROP TABLE IF EXISTS `ipmonrep_aipn`;
CREATE TABLE `ipmonrep_aipn` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `admit` varchar(30) DEFAULT NULL,
  `dcdate` varchar(30) DEFAULT NULL,
  `days` int(4) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `debt` double(12,2) DEFAULT NULL,
  `cash` double(12,2) DEFAULT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `bfy` double(10,2) DEFAULT NULL,
  `bfn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `ddl` double(10,2) DEFAULT NULL,
  `ddy` double(10,2) DEFAULT NULL,
  `ddn` double(10,2) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `blood` double(10,2) DEFAULT NULL,
  `lab` double(10,2) DEFAULT NULL,
  `xray` double(10,2) DEFAULT NULL,
  `sinv` double(10,2) DEFAULT NULL,
  `surg` double(10,2) DEFAULT NULL,
  `ncare` double(10,2) DEFAULT NULL,
  `denta` double(10,2) DEFAULT NULL,
  `pt` double(10,2) DEFAULT NULL,
  `stx` double(10,2) DEFAULT NULL,
  `mc` double(10,2) DEFAULT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `credit` varchar(30) NOT NULL,
  `credit_detail` varchar(30) NOT NULL,
  `tool` double(10,2) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=56390 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ipmonrep_cipn
-- ----------------------------
DROP TABLE IF EXISTS `ipmonrep_cipn`;
CREATE TABLE `ipmonrep_cipn` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `admit` varchar(30) DEFAULT NULL,
  `dcdate` varchar(30) DEFAULT NULL,
  `days` int(4) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `debt` double(12,2) DEFAULT NULL,
  `cash` double(12,2) DEFAULT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `bfy` double(10,2) DEFAULT NULL,
  `bfn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `ddl` double(10,2) DEFAULT NULL,
  `ddy` double(10,2) DEFAULT NULL,
  `ddn` double(10,2) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `blood` double(10,2) DEFAULT NULL,
  `lab` double(10,2) DEFAULT NULL,
  `xray` double(10,2) DEFAULT NULL,
  `sinv` double(10,2) DEFAULT NULL,
  `surg` double(10,2) DEFAULT NULL,
  `ncare` double(10,2) DEFAULT NULL,
  `denta` double(10,2) DEFAULT NULL,
  `pt` double(10,2) DEFAULT NULL,
  `stx` double(10,2) DEFAULT NULL,
  `mc` double(10,2) DEFAULT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `credit` varchar(30) NOT NULL,
  `credit_detail` varchar(30) NOT NULL,
  `tool` double(10,2) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `an` (`an`)
) ENGINE=MyISAM AUTO_INCREMENT=54236 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for km
-- ----------------------------
DROP TABLE IF EXISTS `km`;
CREATE TABLE `km` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(20) NOT NULL,
  `type` varchar(50) DEFAULT NULL,
  `depart` varchar(50) NOT NULL,
  `doc_name` varchar(50) NOT NULL,
  `post_name` varchar(50) NOT NULL,
  `doc_date` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=91 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for km_file
-- ----------------------------
DROP TABLE IF EXISTS `km_file`;
CREATE TABLE `km_file` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(20) NOT NULL,
  `file_name` varchar(50) NOT NULL,
  `name_thai` varchar(100) NOT NULL,
  `file_type` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=124 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for kmcounter
-- ----------------------------
DROP TABLE IF EXISTS `kmcounter`;
CREATE TABLE `kmcounter` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `runno` int(11) DEFAULT '0',
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for kmdepart
-- ----------------------------
DROP TABLE IF EXISTS `kmdepart`;
CREATE TABLE `kmdepart` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for kmdocument
-- ----------------------------
DROP TABLE IF EXISTS `kmdocument`;
CREATE TABLE `kmdocument` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `doc_id` varchar(20) NOT NULL,
  `type` varchar(50) NOT NULL,
  `depart` varchar(50) NOT NULL,
  `doc_name` varchar(50) NOT NULL,
  `post_name` varchar(50) NOT NULL,
  `doc_date` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for kmtype
-- ----------------------------
DROP TABLE IF EXISTS `kmtype`;
CREATE TABLE `kmtype` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'y',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lab
-- ----------------------------
DROP TABLE IF EXISTS `lab`;
CREATE TABLE `lab` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `codex` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `codestk` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `unit` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `price` double(10,2) NOT NULL,
  `yprice` double(10,2) NOT NULL,
  `nprice` double(10,2) NOT NULL,
  `version` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `row_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=618 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for lab_c
-- ----------------------------
DROP TABLE IF EXISTS `lab_c`;
CREATE TABLE `lab_c` (
  `row_id` int(6) NOT NULL AUTO_INCREMENT,
  `code_c` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `detail_c` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  `code_his` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `code_new` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `detail_new` varchar(250) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for lab_cscd
-- ----------------------------
DROP TABLE IF EXISTS `lab_cscd`;
CREATE TABLE `lab_cscd` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `codelab` varchar(50) NOT NULL,
  `codecscd` varchar(5) NOT NULL,
  `yprice` double(10,2) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=619 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lab_pretest
-- ----------------------------
DROP TABLE IF EXISTS `lab_pretest`;
CREATE TABLE `lab_pretest` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `idcard` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `cbc` varchar(255) DEFAULT NULL,
  `ua` varchar(255) DEFAULT NULL,
  `bs` varchar(255) DEFAULT NULL,
  `cr` varchar(255) DEFAULT NULL,
  `chol` varchar(255) DEFAULT NULL,
  `hdl` varchar(255) DEFAULT NULL,
  `hbsag` varchar(255) DEFAULT NULL,
  `fobt` varchar(255) DEFAULT NULL,
  `cxr` varchar(255) DEFAULT NULL,
  `etc` varchar(255) DEFAULT NULL,
  `checked` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=258 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for lab_ward
-- ----------------------------
DROP TABLE IF EXISTS `lab_ward`;
CREATE TABLE `lab_ward` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `no` varchar(10) NOT NULL,
  `an` varchar(15) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `drugcode` (`an`),
  KEY `an` (`an`),
  KEY `code` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=1444 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for labcare
-- ----------------------------
DROP TABLE IF EXISTS `labcare`;
CREATE TABLE `labcare` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `numbered` varchar(10) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `part` varchar(5) DEFAULT NULL,
  `code` varchar(15) DEFAULT NULL,
  `codebak` varchar(10) DEFAULT NULL,
  `codex` varchar(10) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `olddetail` varchar(123) DEFAULT NULL,
  `icd9cm` varchar(24) DEFAULT NULL,
  `unit` varchar(18) DEFAULT NULL,
  `price` double(10,2) NOT NULL DEFAULT '0.00',
  `yprice` double(10,2) NOT NULL DEFAULT '0.00',
  `nprice` double(10,2) NOT NULL DEFAULT '0.00',
  `note` varchar(254) DEFAULT NULL,
  `oldcode` varchar(10) DEFAULT NULL,
  `lablis` varchar(20) DEFAULT NULL,
  `codelab` varchar(50) NOT NULL,
  `outlab_name` varchar(50) NOT NULL,
  `labpart` varchar(50) NOT NULL,
  `labtype` varchar(50) NOT NULL,
  `labstatus` varchar(20) NOT NULL,
  `chkup` varchar(10) DEFAULT NULL,
  `reportlabno` varchar(2) NOT NULL DEFAULT '99',
  `lab_list` int(5) DEFAULT NULL,
  `lab_listdetail` varchar(100) NOT NULL,
  `report_m` varchar(100) NOT NULL,
  `version` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `code` (`code`),
  KEY `labcode` (`code`)
) ENGINE=MyISAM AUTO_INCREMENT=4832 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for labdepart
-- ----------------------------
DROP TABLE IF EXISTS `labdepart`;
CREATE TABLE `labdepart` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `doctor` varchar(40) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `detail` varchar(40) DEFAULT NULL,
  `price` double(11,2) DEFAULT NULL,
  `sumyprice` double(11,2) DEFAULT NULL,
  `sumnprice` double(11,2) DEFAULT NULL,
  `paid` double(11,2) NOT NULL DEFAULT '0.00',
  `idname` varchar(32) DEFAULT NULL,
  `diag` varchar(48) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `tvn` varchar(12) DEFAULT NULL,
  `ptright` varchar(30) DEFAULT NULL,
  `lab` varchar(4) DEFAULT NULL,
  `cashok` varchar(20) DEFAULT NULL,
  `detailbydr` text NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `priority` varchar(2) NOT NULL,
  `patient_from` varchar(10) NOT NULL,
  `checkout` varchar(10) DEFAULT NULL,
  `officer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=34042 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for labpatdata
-- ----------------------------
DROP TABLE IF EXISTS `labpatdata`;
CREATE TABLE `labpatdata` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `ptname` varchar(30) DEFAULT NULL,
  `copy` char(1) DEFAULT NULL,
  `doctor` varchar(40) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `detail` varchar(140) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `yprice` double(10,2) DEFAULT NULL,
  `nprice` double(10,2) DEFAULT NULL,
  `paid` double(10,2) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `labcode` varchar(5) DEFAULT NULL,
  `report` mediumtext,
  `part` varchar(8) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `picture` varchar(32) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `film_size` varchar(6) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `priority` varchar(2) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `hn` (`hn`),
  KEY `depart` (`depart`,`code`)
) ENGINE=MyISAM AUTO_INCREMENT=126564 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for labsuit
-- ----------------------------
DROP TABLE IF EXISTS `labsuit`;
CREATE TABLE `labsuit` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `suitcode` varchar(255) DEFAULT NULL,
  `code` varchar(10) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `part` varchar(8) DEFAULT NULL,
  `slipcode` varchar(10) DEFAULT NULL,
  `idname` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `suitcode` (`suitcode`),
  KEY `code` (`code`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=1417 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_appoint
-- ----------------------------
DROP TABLE IF EXISTS `log_appoint`;
CREATE TABLE `log_appoint` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `lab_old` varchar(255) DEFAULT NULL,
  `lab` varchar(255) DEFAULT NULL,
  `labextra` varchar(255) DEFAULT NULL,
  `labextra_old` varchar(255) DEFAULT NULL,
  `xray` varchar(255) DEFAULT NULL,
  `xray_old` varchar(255) DEFAULT NULL,
  `office` varchar(255) DEFAULT NULL,
  `officer_old` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=11743 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_cashipcard
-- ----------------------------
DROP TABLE IF EXISTS `log_cashipcard`;
CREATE TABLE `log_cashipcard` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `an` varchar(15) NOT NULL,
  `hn` varchar(15) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `bedcode` varchar(15) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `hi_type` varchar(10) NOT NULL,
  `bedpri` double(10,2) NOT NULL,
  `officer` varchar(100) NOT NULL,
  `lastupdate` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5259 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_drugslip
-- ----------------------------
DROP TABLE IF EXISTS `log_drugslip`;
CREATE TABLE `log_drugslip` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `slcode` varchar(50) DEFAULT NULL,
  `action` varchar(20) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `menucode` varchar(20) NOT NULL,
  `datekey` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3396 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for log_ecert
-- ----------------------------
DROP TABLE IF EXISTS `log_ecert`;
CREATE TABLE `log_ecert` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `UserPrint` varchar(50) NOT NULL,
  `DatePrint` varchar(50) NOT NULL,
  `HN` varchar(50) NOT NULL,
  `Type` varchar(50) NOT NULL,
  `Desc_Type` varchar(50) NOT NULL,
  `Code_RowidVn` varchar(50) NOT NULL,
  `Flag_Reprint` varchar(1) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=MyISAM AUTO_INCREMENT=5446 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_edit
-- ----------------------------
DROP TABLE IF EXISTS `log_edit`;
CREATE TABLE `log_edit` (
  `row_id` int(11) NOT NULL,
  `thidate` varchar(30) DEFAULT NULL,
  `part` varchar(20) NOT NULL,
  `code` varchar(15) NOT NULL,
  `detail` varchar(30) NOT NULL,
  `old` varchar(30) NOT NULL,
  `new` varchar(30) NOT NULL,
  `user` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_edit_report_stktranx
-- ----------------------------
DROP TABLE IF EXISTS `log_edit_report_stktranx`;
CREATE TABLE `log_edit_report_stktranx` (
  `Id` int(11) NOT NULL AUTO_INCREMENT,
  `User_Create` varchar(50) NOT NULL,
  `DateTime_Create` varchar(50) NOT NULL,
  `DrugCode` varchar(100) NOT NULL,
  `Mainstk` varchar(50) NOT NULL,
  `row_id` varchar(100) NOT NULL,
  PRIMARY KEY (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=152 DEFAULT CHARSET=utf8 COMMENT='ข้อมูลการแก้ไขข้อมูลยาคงเหลือในรายงาน รพ.5 เท่านั้น';

-- ----------------------------
-- Table structure for log_editdiag
-- ----------------------------
DROP TABLE IF EXISTS `log_editdiag`;
CREATE TABLE `log_editdiag` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_date` datetime NOT NULL,
  `log_officer` varchar(50) NOT NULL,
  `log_datevn` varchar(30) NOT NULL,
  `log_hn` varchar(10) NOT NULL,
  `log_ptname` varchar(50) NOT NULL,
  `log_ptright` varchar(50) NOT NULL,
  `log_olddiag` varchar(100) NOT NULL,
  `log_diag` varchar(100) NOT NULL,
  `log_doctor` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `log_datevn` (`log_datevn`),
  KEY `log_hn` (`log_hn`)
) ENGINE=MyISAM AUTO_INCREMENT=11032 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for log_export_icd10_opd
-- ----------------------------
DROP TABLE IF EXISTS `log_export_icd10_opd`;
CREATE TABLE `log_export_icd10_opd` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `icd10` varchar(20) DEFAULT NULL,
  `icd101` varchar(20) DEFAULT NULL,
  `date_start` varchar(15) DEFAULT NULL,
  `date_end` varchar(15) DEFAULT NULL,
  `ptright` varchar(50) NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `menucode` varchar(20) DEFAULT NULL,
  `date_export` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2765 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for log_inputm
-- ----------------------------
DROP TABLE IF EXISTS `log_inputm`;
CREATE TABLE `log_inputm` (
  `id` bigint(11) NOT NULL AUTO_INCREMENT,
  `log_date` date NOT NULL,
  `user_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `menucode` varchar(255) NOT NULL,
  `login_date` datetime NOT NULL,
  `login_fail_date` datetime NOT NULL,
  `logout_date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=1071203 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_opcardchk
-- ----------------------------
DROP TABLE IF EXISTS `log_opcardchk`;
CREATE TABLE `log_opcardchk` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_examno` varchar(20) NOT NULL,
  `log_hn` varchar(10) NOT NULL,
  `log_ptname` varchar(50) NOT NULL,
  `log_part` varchar(50) NOT NULL,
  `log_datechk` datetime NOT NULL,
  `price` int(11) DEFAULT NULL,
  `opacc_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `book` varchar(255) DEFAULT NULL,
  `bill` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=531 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_opcardchk_64-65
-- ----------------------------
DROP TABLE IF EXISTS `log_opcardchk_64-65`;
CREATE TABLE `log_opcardchk_64-65` (
  `log_id` int(11) NOT NULL AUTO_INCREMENT,
  `log_examno` varchar(20) NOT NULL,
  `log_hn` varchar(10) NOT NULL,
  `log_ptname` varchar(50) NOT NULL,
  `log_part` varchar(50) NOT NULL,
  `log_datechk` datetime NOT NULL,
  `price` int(11) DEFAULT NULL,
  `opacc_id` int(11) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
  `book` varchar(255) DEFAULT NULL,
  `bill` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`log_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1676 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for log_patdata
-- ----------------------------
DROP TABLE IF EXISTS `log_patdata`;
CREATE TABLE `log_patdata` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `patdata_id` bigint(20) DEFAULT NULL,
  `data` longtext,
  `session` longtext,
  PRIMARY KEY (`id`),
  KEY `patdata_id` (`patdata_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mainhospital
-- ----------------------------
DROP TABLE IF EXISTS `mainhospital`;
CREATE TABLE `mainhospital` (
  `pcuid` int(11) NOT NULL AUTO_INCREMENT,
  `pcucode` varchar(5) NOT NULL,
  `pcuname` varchar(50) NOT NULL,
  `pcupart` varchar(50) NOT NULL,
  `pcuaddress` varchar(50) NOT NULL,
  `pcutel` varchar(20) NOT NULL,
  PRIMARY KEY (`pcuid`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for manual_expense
-- ----------------------------
DROP TABLE IF EXISTS `manual_expense`;
CREATE TABLE `manual_expense` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `labnumber` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `age` varchar(255) DEFAULT NULL,
  `lab_items` varchar(255) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for marrieds
-- ----------------------------
DROP TABLE IF EXISTS `marrieds`;
CREATE TABLE `marrieds` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otuser_id` int(11) NOT NULL,
  `identification_number` varchar(13) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `yot` varchar(10) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `birthdate` date NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `religion` varchar(50) NOT NULL,
  `carreer` varchar(100) NOT NULL,
  `alive` varchar(10) NOT NULL,
  `deathcer` varchar(25) NOT NULL,
  `deathdate` varchar(30) DEFAULT NULL,
  `deathprovince` int(11) NOT NULL,
  `disappearinjunction` varchar(25) NOT NULL,
  `injunctiondate` varchar(30) DEFAULT NULL,
  `marriedstatus` varchar(10) NOT NULL,
  `marriedcer` varchar(25) NOT NULL,
  `marrieddate` varchar(30) DEFAULT NULL,
  `marriedprovince` int(11) NOT NULL,
  `divorcecer` varchar(25) NOT NULL,
  `divorcedate` varchar(30) DEFAULT NULL,
  `divorceprovince` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for marriedstaus
-- ----------------------------
DROP TABLE IF EXISTS `marriedstaus`;
CREATE TABLE `marriedstaus` (
  `code` int(11) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `detail2` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for mch
-- ----------------------------
DROP TABLE IF EXISTS `mch`;
CREATE TABLE `mch` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `gravida` varchar(2) NOT NULL,
  `lmp` varchar(8) NOT NULL,
  `edc` varchar(8) NOT NULL,
  `vdrl_rs` varchar(1) NOT NULL,
  `hb_rs` varchar(1) NOT NULL,
  `hiv_rs` varchar(1) NOT NULL,
  `datehct` varchar(8) NOT NULL,
  `htc_rs` varchar(2) NOT NULL,
  `thalass` varchar(1) NOT NULL,
  `dental` varchar(1) NOT NULL,
  `tcaries` varchar(2) NOT NULL,
  `tartar` varchar(1) NOT NULL,
  `guminf` varchar(1) NOT NULL,
  `bdate` varchar(8) NOT NULL,
  `bresult` varchar(6) NOT NULL,
  `bplace` varchar(1) NOT NULL,
  `bhosp` varchar(5) NOT NULL,
  `btype` varchar(1) NOT NULL,
  `bdoctor` varchar(1) NOT NULL,
  `lborn` varchar(1) NOT NULL,
  `sborn` varchar(1) NOT NULL,
  `ppcare1` varchar(8) NOT NULL,
  `ppcare2` varchar(8) NOT NULL,
  `ppcare3` varchar(8) NOT NULL,
  `ppres` varchar(1) NOT NULL,
  `d_update` varchar(14) NOT NULL,
  `cid` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for med_scan
-- ----------------------------
DROP TABLE IF EXISTS `med_scan`;
CREATE TABLE `med_scan` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(255) DEFAULT NULL,
  `an` varchar(255) DEFAULT NULL,
  `idcard` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `filename` varchar(255) DEFAULT NULL,
  `path` varchar(255) DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL,
  `lastupdate` datetime DEFAULT NULL,
  `confirm` varchar(255) DEFAULT NULL,
  `lasteditor` varchar(255) DEFAULT NULL,
  `status` varchar(5) DEFAULT 'y',
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`),
  KEY `an` (`an`),
  KEY `idcard` (`idcard`)
) ENGINE=MyISAM AUTO_INCREMENT=57668 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for medicalcertificate
-- ----------------------------
DROP TABLE IF EXISTS `medicalcertificate`;
CREATE TABLE `medicalcertificate` (
  `thidate` varchar(30) DEFAULT NULL,
  `number` varchar(10) DEFAULT NULL,
  `hn` varchar(10) NOT NULL,
  `part` varchar(10) NOT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `date_start` date DEFAULT NULL,
  `date_end` date DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for memo_sur
-- ----------------------------
DROP TABLE IF EXISTS `memo_sur`;
CREATE TABLE `memo_sur` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `date_time` varchar(30) DEFAULT NULL,
  `thaidate` date NOT NULL,
  `hn` varchar(8) NOT NULL,
  `an` varchar(8) NOT NULL,
  `vn` varchar(8) NOT NULL,
  `ptname` varchar(80) NOT NULL,
  `timein` varchar(30) DEFAULT NULL,
  `timeout` varchar(30) DEFAULT NULL,
  `urgency` varchar(4) NOT NULL,
  `diag` varchar(50) NOT NULL,
  `opertion` varchar(50) NOT NULL,
  `ward` varchar(4) NOT NULL,
  `room` varchar(4) NOT NULL,
  `type_wounded` varchar(4) NOT NULL,
  `type_scar` varchar(4) NOT NULL,
  `ptright` varchar(4) NOT NULL,
  `doctor` varchar(50) DEFAULT NULL,
  `surgery` varchar(4) NOT NULL,
  `type_case` varchar(3) NOT NULL,
  `timeknife` varchar(30) DEFAULT NULL,
  `asa` varchar(1) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1242 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for memo_sur_drug
-- ----------------------------
DROP TABLE IF EXISTS `memo_sur_drug`;
CREATE TABLE `memo_sur_drug` (
  `fk_row_id` int(5) NOT NULL,
  `drug` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for memo_sur_patho
-- ----------------------------
DROP TABLE IF EXISTS `memo_sur_patho`;
CREATE TABLE `memo_sur_patho` (
  `fk_row_id` int(5) NOT NULL,
  `patho` varchar(20) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for menu_user
-- ----------------------------
DROP TABLE IF EXISTS `menu_user`;
CREATE TABLE `menu_user` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  `user` varchar(100) NOT NULL,
  `menucode` varchar(50) NOT NULL,
  `sort` int(20) DEFAULT NULL,
  `member_code` varchar(20) DEFAULT NULL,
  `target` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `menucode` (`menucode`),
  KEY `member_code` (`member_code`)
) ENGINE=MyISAM AUTO_INCREMENT=88354 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for menulst
-- ----------------------------
DROP TABLE IF EXISTS `menulst`;
CREATE TABLE `menulst` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `menu` varchar(255) DEFAULT NULL,
  `script` varchar(100) DEFAULT NULL,
  `menucode` varchar(16) DEFAULT NULL,
  `target` varchar(16) DEFAULT NULL,
  `detail` varchar(56) DEFAULT NULL,
  `status` char(1) DEFAULT NULL,
  `menu_sort` tinyint(10) NOT NULL DEFAULT '99',
  `menu_sort2` tinyint(10) NOT NULL DEFAULT '99',
  PRIMARY KEY (`row_id`),
  KEY `menucode` (`menucode`)
) ENGINE=MyISAM AUTO_INCREMENT=2324 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for metabolic
-- ----------------------------
DROP TABLE IF EXISTS `metabolic`;
CREATE TABLE `metabolic` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `datekey` datetime NOT NULL,
  `hn` varchar(12) NOT NULL,
  `idcard` varchar(13) NOT NULL,
  `yot` varchar(30) NOT NULL,
  `name` varchar(50) NOT NULL,
  `surname` varchar(50) NOT NULL,
  `birthday` date NOT NULL,
  `age` varchar(10) NOT NULL,
  `camp` varchar(50) NOT NULL,
  `position` varchar(50) NOT NULL,
  `tel` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp11` varchar(10) NOT NULL,
  `bp12` varchar(10) NOT NULL,
  `bp21` varchar(10) NOT NULL,
  `bp22` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `chest` varchar(10) DEFAULT NULL,
  `waist` varchar(10) DEFAULT NULL,
  `bloodsugar` varchar(10) NOT NULL,
  `diseases` varchar(1) NOT NULL,
  `diseases_name` varchar(256) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for migrations
-- ----------------------------
DROP TABLE IF EXISTS `migrations`;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for nation
-- ----------------------------
DROP TABLE IF EXISTS `nation`;
CREATE TABLE `nation` (
  `code` varchar(3) NOT NULL,
  `detail` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ncdscreen
-- ----------------------------
DROP TABLE IF EXISTS `ncdscreen`;
CREATE TABLE `ncdscreen` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `seq` varchar(15) NOT NULL,
  `dateexam` varchar(8) NOT NULL,
  `place` varchar(1) NOT NULL,
  `smoke` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `dmfamily` varchar(1) NOT NULL,
  `htfamily` varchar(1) NOT NULL,
  `weight` varchar(6) NOT NULL,
  `height` varchar(6) NOT NULL,
  `waist` varchar(3) NOT NULL,
  `bph1` varchar(3) NOT NULL,
  `bpl1` varchar(3) NOT NULL,
  `bph2` varchar(3) NOT NULL,
  `bpl2` varchar(3) NOT NULL,
  `bslevel` varchar(3) NOT NULL,
  `bstest` varchar(1) NOT NULL,
  `d_update` varchar(14) NOT NULL,
  `cid` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for new
-- ----------------------------
DROP TABLE IF EXISTS `new`;
CREATE TABLE `new` (
  `row` int(11) NOT NULL AUTO_INCREMENT,
  `depart` varchar(50) DEFAULT NULL,
  `new` text,
  `datetime` varchar(20) DEFAULT NULL,
  `status` char(1) NOT NULL DEFAULT 'Y',
  `user` varchar(50) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `file` varchar(50) NOT NULL,
  `dr` varchar(1) NOT NULL,
  `numday` varchar(50) NOT NULL,
  PRIMARY KEY (`row`)
) ENGINE=MyISAM AUTO_INCREMENT=3223 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for newpha
-- ----------------------------
DROP TABLE IF EXISTS `newpha`;
CREATE TABLE `newpha` (
  `newpha` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for news
-- ----------------------------
DROP TABLE IF EXISTS `news`;
CREATE TABLE `news` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) DEFAULT NULL,
  `folder` varchar(255) DEFAULT NULL,
  `date_start` datetime DEFAULT NULL,
  `date_end` datetime DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `owner` varchar(255) DEFAULT NULL,
  `pin` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=50 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for nhsoatk
-- ----------------------------
DROP TABLE IF EXISTS `nhsoatk`;
CREATE TABLE `nhsoatk` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hcode` varchar(255) DEFAULT NULL,
  `hname` varchar(255) DEFAULT NULL,
  `idcard` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `authen_code` varchar(255) DEFAULT NULL,
  `type_service` varchar(255) DEFAULT NULL,
  `service` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `an` varchar(255) DEFAULT NULL,
  `date_service` varchar(255) DEFAULT NULL,
  `date_authen` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `type_authen` varchar(255) DEFAULT NULL,
  `authen_method` varchar(255) DEFAULT NULL,
  `certifier` varchar(255) DEFAULT NULL,
  `date_authen_edit` varchar(255) DEFAULT NULL,
  `name_edit` varchar(255) DEFAULT NULL,
  `cancel` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`),
  KEY `idcard` (`idcard`)
) ENGINE=MyISAM AUTO_INCREMENT=11861 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for niddiag
-- ----------------------------
DROP TABLE IF EXISTS `niddiag`;
CREATE TABLE `niddiag` (
  `group` varchar(2) NOT NULL,
  `detail` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for nutri
-- ----------------------------
DROP TABLE IF EXISTS `nutri`;
CREATE TABLE `nutri` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `pcucode` varchar(5) NOT NULL,
  `ref_hn` varchar(15) NOT NULL,
  `seq` varchar(15) NOT NULL,
  `date_serv` varchar(15) NOT NULL,
  `agemonth` varchar(5) NOT NULL,
  `weight` varchar(5) NOT NULL,
  `height` varchar(5) NOT NULL,
  `nlevel` varchar(5) NOT NULL,
  `d_update` varchar(15) NOT NULL,
  `cid` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for occupa
-- ----------------------------
DROP TABLE IF EXISTS `occupa`;
CREATE TABLE `occupa` (
  `code` varchar(4) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `status` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for officers
-- ----------------------------
DROP TABLE IF EXISTS `officers`;
CREATE TABLE `officers` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `mancode` varchar(16) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `position2` varchar(50) DEFAULT NULL,
  `yot` varchar(40) DEFAULT NULL,
  `fullname` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `mancode` (`mancode`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for officers_purchase
-- ----------------------------
DROP TABLE IF EXISTS `officers_purchase`;
CREATE TABLE `officers_purchase` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `mancode` varchar(16) DEFAULT NULL,
  `position` varchar(100) DEFAULT NULL,
  `position2` varchar(50) DEFAULT NULL,
  `yot` varchar(40) DEFAULT NULL,
  `fullname` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `mancode` (`mancode`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opacc
-- ----------------------------
DROP TABLE IF EXISTS `opacc`;
CREATE TABLE `opacc` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `txdate` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `detail` varchar(100) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `idname` varchar(40) DEFAULT NULL,
  `essd` double(10,2) DEFAULT NULL,
  `nessdy` double(10,2) DEFAULT NULL,
  `nessdn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `credit` varchar(32) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `credit_detail` varchar(50) DEFAULT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `vn` varchar(4) DEFAULT NULL,
  `paidcscd` varchar(10) DEFAULT NULL,
  `lastupdate` varchar(30) DEFAULT NULL,
  `typecscd` varchar(1) NOT NULL,
  `typesso` varchar(1) NOT NULL,
  `icd10_cscd` varchar(1) NOT NULL,
  `stm_invno` varchar(25) NOT NULL,
  `status_stm` varchar(1) NOT NULL,
  `stm_no` varchar(50) NOT NULL,
  `reply_no` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `inxdate` (`date`),
  KEY `hn` (`hn`),
  KEY `credit` (`credit`)
) ENGINE=MyISAM AUTO_INCREMENT=5808187 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opacc2
-- ----------------------------
DROP TABLE IF EXISTS `opacc2`;
CREATE TABLE `opacc2` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `txdate` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `detail` varchar(40) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `idname` varchar(40) DEFAULT NULL,
  `essd` double(10,2) DEFAULT NULL,
  `nessdy` double(10,2) DEFAULT NULL,
  `nessdn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `credit` varchar(32) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `credit_detail` varchar(50) DEFAULT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `vn` varchar(4) DEFAULT NULL,
  `paidcscd` varchar(10) DEFAULT NULL,
  `lastupdate` varchar(30) DEFAULT NULL,
  `typecscd` varchar(1) NOT NULL,
  `typesso` varchar(1) NOT NULL,
  `icd10_cscd` varchar(1) NOT NULL,
  `stm_invno` varchar(25) NOT NULL,
  `status_stm` varchar(1) NOT NULL,
  `stm_no` varchar(50) NOT NULL,
  `reply_no` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `inxdate` (`date`),
  KEY `hn` (`hn`),
  KEY `credit` (`credit`)
) ENGINE=MyISAM AUTO_INCREMENT=3465013 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opcard
-- ----------------------------
DROP TABLE IF EXISTS `opcard`;
CREATE TABLE `opcard` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `regisdate` varchar(30) DEFAULT NULL,
  `idcard` varchar(16) DEFAULT NULL,
  `mid` varchar(20) NOT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `yot` varchar(100) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `education` varchar(50) NOT NULL,
  `goup` varchar(50) DEFAULT NULL,
  `married` varchar(8) DEFAULT NULL,
  `cbirth` varchar(15) DEFAULT NULL,
  `dbirth` varchar(30) DEFAULT NULL,
  `guardian` varchar(48) DEFAULT NULL,
  `idguard` varchar(45) DEFAULT NULL,
  `nation` varchar(16) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `career` varchar(32) DEFAULT NULL,
  `ptright` varchar(60) DEFAULT NULL,
  `ptrightdetail` varchar(100) NOT NULL,
  `HOUSENO` text,
  `VILLAGE` text,
  `SOIMAIN` text,
  `ROAD` text,
  `LOCATION_OPCARD` text,
  `POSTCODE` varchar(5) NOT NULL,
  `address` varchar(40) DEFAULT NULL,
  `tambol` varchar(28) DEFAULT NULL,
  `ampur` varchar(28) DEFAULT NULL,
  `changwat` varchar(28) DEFAULT NULL,
  `hphone` varchar(50) NOT NULL,
  `phone` varchar(28) DEFAULT NULL,
  `father` varchar(40) DEFAULT NULL,
  `mother` varchar(40) DEFAULT NULL,
  `couple` varchar(40) DEFAULT NULL,
  `note` text,
  `sex` char(1) DEFAULT NULL,
  `camp` varchar(32) DEFAULT NULL,
  `race` varchar(16) DEFAULT NULL,
  `history` longtext,
  `ptf` varchar(30) DEFAULT NULL,
  `ptfadd` varchar(10) DEFAULT NULL,
  `ptffone` varchar(28) DEFAULT NULL,
  `ptfmon` varchar(15) DEFAULT NULL,
  `ptright1` varchar(60) DEFAULT NULL,
  `status` char(1) DEFAULT 'Y',
  `lastupdate` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `officer` varchar(40) DEFAULT NULL,
  `inrxform` varchar(80) NOT NULL,
  `congenital_disease` text,
  `cancer` varchar(50) DEFAULT NULL,
  `date_cancer` varchar(30) DEFAULT NULL,
  `blood` varchar(50) DEFAULT NULL,
  `drugreact` text NOT NULL,
  `phone2` varchar(15) NOT NULL,
  `hd` varchar(3) NOT NULL,
  `pension_status` varchar(50) NOT NULL,
  `idguard2` varchar(100) NOT NULL,
  `ptright2` varchar(100) NOT NULL,
  `no_card` varchar(5) NOT NULL,
  `ptrcode` varchar(20) NOT NULL,
  `hospcode` varchar(100) DEFAULT NULL,
  `opcardstatus` varchar(50) NOT NULL,
  `typeservice` varchar(50) NOT NULL,
  `subgroup` varchar(100) NOT NULL,
  `employee` varchar(1) NOT NULL,
  `typearea` varchar(5) DEFAULT NULL,
  `vstatus` int(4) NOT NULL,
  `father_id` varchar(13) NOT NULL,
  `mother_id` varchar(13) NOT NULL,
  `couple_id` varchar(13) NOT NULL,
  `note_vip` text NOT NULL,
  `prename` varchar(50) DEFAULT NULL,
  `name_eng` varchar(100) NOT NULL,
  `surname_eng` varchar(100) DEFAULT NULL,
  `passport` varchar(20) NOT NULL,
  `house_no` varchar(20) NOT NULL,
  `address_moo` varchar(10) NOT NULL,
  `address_soi` varchar(10) NOT NULL,
  `address_road` varchar(50) NOT NULL,
  `tambol_eng` varchar(50) DEFAULT NULL,
  `ampur_eng` varchar(50) DEFAULT NULL,
  `changwat_eng` varchar(50) DEFAULT NULL,
  `guid` varchar(36) DEFAULT NULL,
  `document` text,
  `approve_document` text NOT NULL,
  `ptright_nhso` varchar(50) NOT NULL,
  `allergy` text NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `hn` (`hn`),
  KEY `hosnum` (`hn`),
  KEY `name` (`name`),
  KEY `surname` (`surname`),
  KEY `idcard` (`idcard`)
) ENGINE=MyISAM AUTO_INCREMENT=247232 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opcard_backup
-- ----------------------------
DROP TABLE IF EXISTS `opcard_backup`;
CREATE TABLE `opcard_backup` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `regisdate` varchar(30) DEFAULT NULL,
  `idcard` varchar(16) DEFAULT NULL,
  `mid` varchar(20) NOT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `yot` varchar(100) DEFAULT NULL,
  `name` varchar(20) DEFAULT NULL,
  `surname` varchar(20) DEFAULT NULL,
  `education` varchar(50) NOT NULL,
  `goup` varchar(50) DEFAULT NULL,
  `married` varchar(8) DEFAULT NULL,
  `cbirth` varchar(15) DEFAULT NULL,
  `dbirth` varchar(30) DEFAULT NULL,
  `guardian` varchar(48) DEFAULT NULL,
  `idguard` varchar(45) DEFAULT NULL,
  `nation` varchar(16) DEFAULT NULL,
  `religion` varchar(10) DEFAULT NULL,
  `career` varchar(32) DEFAULT NULL,
  `ptright` varchar(60) DEFAULT NULL,
  `ptrightdetail` varchar(100) NOT NULL,
  `address` varchar(40) DEFAULT NULL,
  `tambol` varchar(28) DEFAULT NULL,
  `ampur` varchar(28) DEFAULT NULL,
  `changwat` varchar(28) DEFAULT NULL,
  `hphone` varchar(50) NOT NULL,
  `phone` varchar(28) DEFAULT NULL,
  `father` varchar(40) DEFAULT NULL,
  `mother` varchar(40) DEFAULT NULL,
  `couple` varchar(40) DEFAULT NULL,
  `note` text,
  `sex` char(1) DEFAULT NULL,
  `camp` varchar(32) DEFAULT NULL,
  `race` varchar(16) DEFAULT NULL,
  `history` longtext,
  `ptf` varchar(30) DEFAULT NULL,
  `ptfadd` varchar(10) DEFAULT NULL,
  `ptffone` varchar(28) DEFAULT NULL,
  `ptfmon` varchar(15) DEFAULT NULL,
  `ptright1` varchar(60) DEFAULT NULL,
  `status` char(1) DEFAULT 'Y',
  `lastupdate` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `officer` varchar(40) DEFAULT NULL,
  `inrxform` varchar(80) DEFAULT NULL,
  `congenital_disease` text,
  `cancer` varchar(50) DEFAULT NULL,
  `date_cancer` varchar(30) DEFAULT NULL,
  `blood` varchar(50) DEFAULT NULL,
  `drugreact` text NOT NULL,
  `phone2` varchar(15) NOT NULL,
  `hd` varchar(3) NOT NULL,
  `pension_status` varchar(50) NOT NULL,
  `idguard2` varchar(100) NOT NULL,
  `ptright2` varchar(100) NOT NULL,
  `no_card` varchar(5) NOT NULL,
  `ptrcode` varchar(20) NOT NULL,
  `hospcode` varchar(100) DEFAULT NULL,
  `opcardstatus` varchar(50) NOT NULL,
  `typeservice` varchar(50) NOT NULL,
  `subgroup` varchar(100) NOT NULL,
  `employee` varchar(1) NOT NULL,
  `typearea` varchar(5) DEFAULT NULL,
  `vstatus` int(4) NOT NULL,
  `father_id` varchar(13) NOT NULL,
  `mother_id` varchar(13) NOT NULL,
  `couple_id` varchar(13) NOT NULL,
  `note_vip` text NOT NULL,
  `prename` varchar(50) DEFAULT NULL,
  `name_eng` varchar(100) NOT NULL,
  `surname_eng` varchar(100) DEFAULT NULL,
  `passport` varchar(20) NOT NULL,
  `house_no` varchar(20) NOT NULL,
  `address_moo` varchar(10) NOT NULL,
  `address_soi` varchar(10) NOT NULL,
  `address_road` varchar(50) NOT NULL,
  `tambol_eng` varchar(50) DEFAULT NULL,
  `ampur_eng` varchar(50) DEFAULT NULL,
  `changwat_eng` varchar(50) DEFAULT NULL,
  `guid` varchar(36) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `hn` (`hn`),
  KEY `hosnum` (`hn`),
  KEY `name` (`name`),
  KEY `surname` (`surname`),
  KEY `idcard` (`idcard`)
) ENGINE=MyISAM AUTO_INCREMENT=236605 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for opcard_update
-- ----------------------------
DROP TABLE IF EXISTS `opcard_update`;
CREATE TABLE `opcard_update` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(45) DEFAULT NULL,
  `detail` text,
  `status` varchar(45) DEFAULT 'N',
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=119 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opcardchk
-- ----------------------------
DROP TABLE IF EXISTS `opcardchk`;
CREATE TABLE `opcardchk` (
  `HN` varchar(10) NOT NULL,
  `row` int(10) DEFAULT NULL,
  `exam_no` varchar(20) DEFAULT NULL,
  `pid` varchar(50) NOT NULL,
  `idcard` varchar(20) DEFAULT NULL,
  `yot` varchar(30) DEFAULT NULL,
  `name` varchar(50) DEFAULT NULL,
  `surname` varchar(50) DEFAULT NULL,
  `dbirth` varchar(50) DEFAULT NULL,
  `agey` varchar(50) DEFAULT NULL,
  `agem` varchar(50) DEFAULT NULL,
  `Religion` varchar(50) DEFAULT NULL,
  `height` varchar(50) DEFAULT NULL,
  `weight` varchar(50) DEFAULT NULL,
  `address` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `part` varchar(255) DEFAULT NULL,
  `course` varchar(100) NOT NULL,
  `branch` varchar(100) NOT NULL,
  `datechkup` varchar(100) NOT NULL,
  `active` varchar(1) NOT NULL,
  KEY `HN` (`HN`),
  KEY `part` (`part`)
) ENGINE=MyISAM AUTO_INCREMENT=4109 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for opcards
-- ----------------------------
DROP TABLE IF EXISTS `opcards`;
CREATE TABLE `opcards` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for opd
-- ----------------------------
DROP TABLE IF EXISTS `opd`;
CREATE TABLE `opd` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `vn` int(5) DEFAULT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `temperature` varchar(5) NOT NULL,
  `pause` varchar(5) NOT NULL,
  `rate` varchar(5) NOT NULL,
  `spo2` varchar(5) NOT NULL,
  `weight` varchar(5) DEFAULT NULL,
  `height` varchar(5) DEFAULT NULL,
  `bmi` varchar(5) NOT NULL,
  `bp1` varchar(5) DEFAULT NULL,
  `bp2` varchar(5) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `congenital_disease` varchar(60) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `officer` varchar(30) NOT NULL,
  `dc_diag` varchar(30) DEFAULT NULL,
  `toborow` varchar(35) NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `exercise` varchar(1) DEFAULT NULL,
  `dx_mc_soldier` text,
  `dr1_mc_soldier` varchar(60) DEFAULT NULL,
  `dr2_mc_soldier` varchar(60) DEFAULT NULL,
  `dr3_mc_soldier` varchar(60) DEFAULT NULL,
  `address` varchar(200) NOT NULL,
  `rule` text NOT NULL,
  `cigok` varchar(1) NOT NULL,
  `waist` varchar(5) NOT NULL,
  `chkup` varchar(50) NOT NULL,
  `room` varchar(50) NOT NULL,
  `painscore` varchar(3) NOT NULL,
  `age` varchar(20) NOT NULL,
  `bp3` varchar(5) DEFAULT NULL,
  `bp4` varchar(5) DEFAULT NULL,
  `mens` varchar(50) DEFAULT NULL,
  `mens_date` date DEFAULT NULL,
  `vaccine` varchar(50) DEFAULT NULL,
  `parent_smoke` varchar(50) DEFAULT NULL,
  `parent_smoke_amount` int(11) DEFAULT NULL,
  `parent_drink` varchar(50) DEFAULT NULL,
  `parent_drink_amount` int(11) DEFAULT NULL,
  `smoke_amount` int(11) DEFAULT NULL,
  `drink_amount` int(11) DEFAULT NULL,
  `hpi` text,
  `ht_amount` varchar(50) DEFAULT NULL,
  `dm_amount` varchar(50) DEFAULT NULL,
  `grade` tinyint(4) DEFAULT NULL,
  `mind` varchar(50) DEFAULT NULL,
  `the_pill` tinyint(4) DEFAULT NULL,
  `cvriskscore` varchar(10) NOT NULL,
  `cvriskscore_lab` varchar(10) NOT NULL,
  `pregnancy` varchar(50) DEFAULT NULL,
  `smoke_ncd` varchar(100) DEFAULT NULL,
  `drink_ncd` varchar(100) DEFAULT NULL,
  `staff` varchar(50) NOT NULL,
  `cvrisk_area` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `thdatehn` (`thdatehn`)
) ENGINE=MyISAM AUTO_INCREMENT=915362 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opd_advice
-- ----------------------------
DROP TABLE IF EXISTS `opd_advice`;
CREATE TABLE `opd_advice` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `hn` varchar(255) NOT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `opd_id` varchar(11) NOT NULL,
  `thdatehn` varchar(255) NOT NULL,
  `officer` varchar(255) NOT NULL,
  `document` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `thdatehn` (`thdatehn`),
  KEY `hn` (`hn`),
  KEY `opd_id` (`opd_id`)
) ENGINE=InnoDB AUTO_INCREMENT=1443 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opd_advice_form_i
-- ----------------------------
DROP TABLE IF EXISTS `opd_advice_form_i`;
CREATE TABLE `opd_advice_form_i` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) NOT NULL,
  `hn` varchar(255) NOT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `opd_device_id` varchar(11) NOT NULL,
  `thdatehn` varchar(255) NOT NULL,
  `officer` varchar(255) NOT NULL,
  `advice_organ` varchar(255) DEFAULT NULL,
  `advice_painscore1` varchar(10) DEFAULT NULL,
  `advice_rx` varchar(255) DEFAULT NULL,
  `advice_rxtime` varchar(20) DEFAULT NULL,
  `advice_activetime` varchar(20) DEFAULT NULL,
  `advice_painscore2` varchar(10) DEFAULT NULL,
  `edit_by` varchar(50) NOT NULL,
  `edit_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thdatehn` (`thdatehn`),
  KEY `hn` (`hn`),
  KEY `opd_device_id` (`opd_device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=329 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opd_advice_form_j
-- ----------------------------
DROP TABLE IF EXISTS `opd_advice_form_j`;
CREATE TABLE `opd_advice_form_j` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `ptname` varchar(100) DEFAULT NULL,
  `opd_device_id` varchar(11) NOT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `officer` varchar(100) NOT NULL,
  `advice_inject1` varchar(1) DEFAULT NULL,
  `advice_inject1_name` varchar(50) NOT NULL,
  `advice_inject1_unit` varchar(50) NOT NULL,
  `advice_inject2` varchar(1) DEFAULT NULL,
  `advice_inject2_name` varchar(50) NOT NULL,
  `advice_inject2_unit` varchar(50) NOT NULL,
  `advice_inject3` varchar(1) DEFAULT NULL,
  `advice_inject3_name` varchar(50) NOT NULL,
  `edit_by` varchar(50) NOT NULL,
  `edit_time` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `thdatehn` (`thdatehn`),
  KEY `hn` (`hn`),
  KEY `opd_device_id` (`opd_device_id`)
) ENGINE=InnoDB AUTO_INCREMENT=108 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opd_expert
-- ----------------------------
DROP TABLE IF EXISTS `opd_expert`;
CREATE TABLE `opd_expert` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `vn` int(5) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `temperature` varchar(5) NOT NULL,
  `pause` varchar(5) NOT NULL,
  `rate` varchar(5) NOT NULL,
  `weight` varchar(5) DEFAULT NULL,
  `height` varchar(5) DEFAULT NULL,
  `bp1` varchar(5) DEFAULT NULL,
  `bp2` varchar(5) NOT NULL,
  `bp3` varchar(5) DEFAULT NULL,
  `bp4` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `thdatehn` (`thdatehn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opd_eye
-- ----------------------------
DROP TABLE IF EXISTS `opd_eye`;
CREATE TABLE `opd_eye` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `register` varchar(50) NOT NULL,
  `date_eye` varchar(20) NOT NULL,
  `hn` varchar(50) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `fbs` varchar(50) NOT NULL,
  `hba1c` varchar(50) NOT NULL,
  `dr` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `officer` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `date_eye` (`date_eye`)
) ENGINE=MyISAM AUTO_INCREMENT=1565 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for opd_hd
-- ----------------------------
DROP TABLE IF EXISTS `opd_hd`;
CREATE TABLE `opd_hd` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_hd` varchar(20) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `stage` varchar(50) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `bp1` int(11) NOT NULL,
  `bp2` int(11) NOT NULL,
  `bs` int(11) DEFAULT NULL,
  `hba1c` varchar(20) NOT NULL,
  `ldl` varchar(20) NOT NULL,
  `Calcium` varchar(30) NOT NULL,
  `ca_p` varchar(20) NOT NULL,
  `hct` varchar(20) NOT NULL,
  `hb` varchar(20) NOT NULL,
  `serum_phose` varchar(20) NOT NULL,
  `serum_bio` varchar(20) NOT NULL,
  `pth` varchar(20) NOT NULL,
  `hepatitis` varchar(20) NOT NULL,
  `vascular` varchar(20) NOT NULL,
  `guid_hd` varchar(20) NOT NULL,
  `gfr` varchar(20) NOT NULL,
  `cigarette` int(11) NOT NULL,
  `diet` int(11) NOT NULL,
  `physical` int(11) NOT NULL,
  `comment` text NOT NULL,
  `register` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=173 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for opd_hd_stage
-- ----------------------------
DROP TABLE IF EXISTS `opd_hd_stage`;
CREATE TABLE `opd_hd_stage` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(30) NOT NULL,
  `gfr` varchar(20) NOT NULL,
  `stage` varchar(20) NOT NULL,
  `start_date` varchar(30) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=289 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opd_no_visit
-- ----------------------------
DROP TABLE IF EXISTS `opd_no_visit`;
CREATE TABLE `opd_no_visit` (
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `bp1` varchar(5) DEFAULT NULL,
  `bp2` varchar(5) DEFAULT NULL,
  `pause` varchar(5) DEFAULT NULL,
  `weight` varchar(5) DEFAULT NULL,
  `height` varchar(5) DEFAULT NULL,
  `bmi` varchar(5) DEFAULT NULL,
  `spo2` varchar(5) DEFAULT NULL,
  `rate` varchar(5) DEFAULT NULL,
  `temperature` varchar(5) DEFAULT NULL,
  `waist` varchar(5) DEFAULT NULL,
  `ptname` varchar(50) DEFAULT NULL,
  `status` tinyint(255) NOT NULL DEFAULT '0',
  `staff` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`thdatehn`,`status`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='ข้อมูล Vs ก่อน Visit';

-- ----------------------------
-- Table structure for opd_show
-- ----------------------------
DROP TABLE IF EXISTS `opd_show`;
CREATE TABLE `opd_show` (
  `unit` varchar(6) NOT NULL,
  `queue` varchar(4) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  PRIMARY KEY (`unit`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opday
-- ----------------------------
DROP TABLE IF EXISTS `opday`;
CREATE TABLE `opday` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) DEFAULT NULL,
  `hn` varchar(12) NOT NULL DEFAULT '',
  `vn` varchar(5) DEFAULT NULL,
  `thdatevn` varchar(13) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `age` varchar(30) NOT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `goup` varchar(50) DEFAULT NULL,
  `camp` varchar(32) DEFAULT NULL,
  `dxgroup` varchar(2) DEFAULT NULL,
  `diag` varchar(100) DEFAULT NULL,
  `diag_morbidity` varchar(200) DEFAULT NULL,
  `diag_complication` varchar(200) DEFAULT NULL,
  `diag_other` varchar(200) DEFAULT NULL,
  `external_cause` varchar(200) DEFAULT NULL,
  `icd10` varchar(16) DEFAULT NULL,
  `icd10_morbidity` varchar(16) DEFAULT NULL,
  `icd10_complication` varchar(16) DEFAULT NULL,
  `icd10_other` varchar(16) DEFAULT NULL,
  `icd10_external_cause` varchar(16) DEFAULT NULL,
  `icd9cm` varchar(16) DEFAULT NULL,
  `doctor` varchar(40) DEFAULT NULL,
  `waittime` int(8) DEFAULT NULL,
  `okopd` char(1) DEFAULT 'N',
  `PHAR` double(10,2) NOT NULL DEFAULT '0.00',
  `xray` double(10,2) NOT NULL DEFAULT '0.00',
  `patho` double(10,2) NOT NULL DEFAULT '0.00',
  `emer` double(10,2) NOT NULL DEFAULT '0.00',
  `surg` double(10,2) NOT NULL DEFAULT '0.00',
  `physi` double(10,2) NOT NULL DEFAULT '0.00',
  `denta` double(10,2) NOT NULL DEFAULT '0.00',
  `other` double(10,2) NOT NULL DEFAULT '0.00',
  `note` varchar(40) DEFAULT NULL,
  `idcard` varchar(15) DEFAULT NULL,
  `borow` varchar(30) DEFAULT NULL,
  `toborow` varchar(35) DEFAULT NULL,
  `inopdday` varchar(15) DEFAULT NULL,
  `officer` varchar(30) DEFAULT NULL,
  `erok` char(1) DEFAULT 'N',
  `erdiag` varchar(30) DEFAULT NULL,
  `kew` varchar(10) DEFAULT NULL,
  `phaok` char(1) DEFAULT 'Y',
  `time1` varchar(20) DEFAULT NULL,
  `time2` varchar(20) DEFAULT NULL,
  `clinic` varchar(255) DEFAULT NULL,
  `icd101` varchar(20) DEFAULT NULL,
  `withdraw` varchar(10) DEFAULT NULL,
  `history` text,
  `diagicd10` varchar(250) NOT NULL,
  `diagtype` varchar(30) DEFAULT NULL,
  `ref_icd10` varchar(50) NOT NULL,
  `officer2` varchar(50) DEFAULT NULL,
  `checkdx` varchar(10) NOT NULL,
  `diag_eng` varchar(300) NOT NULL,
  `diag_thai` varchar(100) NOT NULL,
  `dr_input` varchar(10) NOT NULL,
  `typeservice` varchar(50) NOT NULL,
  `subgroup` varchar(100) NOT NULL,
  `opdreg` varchar(1) NOT NULL DEFAULT 'N',
  `opdtype` varchar(5) NOT NULL,
  `opdcolor` varchar(30) NOT NULL,
  `ptright_nhso` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `admno` (`an`),
  KEY `thdatehn` (`thdatehn`),
  KEY `thdatevn` (`thdatevn`),
  KEY `thidate` (`thidate`),
  KEY `diag` (`diag`),
  KEY `doctor` (`doctor`),
  KEY `hn` (`hn`),
  KEY `icd10` (`icd10`)
) ENGINE=MyISAM AUTO_INCREMENT=3081368 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opday2
-- ----------------------------
DROP TABLE IF EXISTS `opday2`;
CREATE TABLE `opday2` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) DEFAULT NULL,
  `hn` varchar(12) NOT NULL DEFAULT '',
  `vn` varchar(5) DEFAULT NULL,
  `thdatevn` varchar(13) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `age` varchar(30) NOT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `goup` varchar(40) DEFAULT NULL,
  `camp` varchar(32) DEFAULT NULL,
  `dxgroup` varchar(2) DEFAULT NULL,
  `diag` varchar(40) DEFAULT NULL,
  `icd10` varchar(16) DEFAULT NULL,
  `icd9cm` varchar(16) DEFAULT NULL,
  `doctor` varchar(40) DEFAULT NULL,
  `waittime` int(8) DEFAULT NULL,
  `okopd` char(1) DEFAULT 'N',
  `PHAR` double(10,2) NOT NULL DEFAULT '0.00',
  `xray` double(10,2) NOT NULL DEFAULT '0.00',
  `patho` double(10,2) NOT NULL DEFAULT '0.00',
  `emer` double(10,2) NOT NULL DEFAULT '0.00',
  `surg` double(10,2) NOT NULL DEFAULT '0.00',
  `physi` double(10,2) NOT NULL DEFAULT '0.00',
  `denta` double(10,2) NOT NULL DEFAULT '0.00',
  `other` double(10,2) NOT NULL DEFAULT '0.00',
  `note` varchar(40) DEFAULT NULL,
  `idcard` varchar(15) DEFAULT NULL,
  `borow` varchar(30) DEFAULT NULL,
  `toborow` varchar(35) DEFAULT NULL,
  `inopdday` varchar(15) DEFAULT NULL,
  `officer` varchar(30) DEFAULT NULL,
  `erok` char(1) DEFAULT 'N',
  `erdiag` varchar(30) DEFAULT NULL,
  `kew` varchar(10) DEFAULT NULL,
  `phaok` char(1) DEFAULT 'Y',
  `time1` varchar(20) DEFAULT NULL,
  `time2` varchar(20) DEFAULT NULL,
  `clinic` varchar(20) DEFAULT NULL,
  `icd101` varchar(20) DEFAULT NULL,
  `withdraw` varchar(2) DEFAULT NULL,
  `history` text,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `thdatehn` (`thdatehn`),
  KEY `thidate` (`thidate`),
  KEY `thdatevn` (`thdatevn`)
) ENGINE=MyISAM AUTO_INCREMENT=2470652 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opicd9cm
-- ----------------------------
DROP TABLE IF EXISTS `opicd9cm`;
CREATE TABLE `opicd9cm` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `admdate` varchar(30) NOT NULL,
  `hn` varchar(12) NOT NULL,
  `vn` varchar(10) NOT NULL,
  `icd9cm` varchar(20) NOT NULL,
  `icddate` varchar(20) NOT NULL,
  `officer` varchar(30) NOT NULL,
  `svdate` varchar(20) NOT NULL,
  `status` varchar(10) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `icd9cm` (`icd9cm`),
  KEY `icd9cm_2` (`icd9cm`)
) ENGINE=MyISAM AUTO_INCREMENT=1122759 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for opmonrep
-- ----------------------------
DROP TABLE IF EXISTS `opmonrep`;
CREATE TABLE `opmonrep` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) DEFAULT NULL,
  `idname` char(32) DEFAULT NULL,
  `phar` double(12,2) DEFAULT NULL,
  `pharpaid` double(12,2) DEFAULT NULL,
  `essd` double(12,2) DEFAULT NULL,
  `nessdy` double(12,2) DEFAULT NULL,
  `nessdn` double(12,2) DEFAULT NULL,
  `dsy` double(12,2) DEFAULT NULL,
  `dsn` double(12,2) DEFAULT NULL,
  `dpy` double(12,2) DEFAULT NULL,
  `dpn` double(12,2) DEFAULT NULL,
  `labo` double(12,2) DEFAULT NULL,
  `labopaid` double(12,2) DEFAULT NULL,
  `xray` double(12,2) DEFAULT NULL,
  `xraypaid` double(12,2) DEFAULT NULL,
  `surg` double(12,2) DEFAULT NULL,
  `surgpaid` double(12,2) DEFAULT NULL,
  `emer` double(12,2) DEFAULT NULL,
  `emerpaid` double(12,2) DEFAULT NULL,
  `dent` double(12,2) DEFAULT NULL,
  `dentpaid` double(12,2) DEFAULT NULL,
  `physi` double(12,2) DEFAULT NULL,
  `physipd` double(12,2) DEFAULT NULL,
  `hemo` double(12,2) DEFAULT NULL,
  `hemopd` double(12,2) DEFAULT NULL,
  `other` double(12,2) DEFAULT NULL,
  `otherpd` double(12,2) DEFAULT NULL,
  `ward` double(12,2) DEFAULT NULL,
  `wardpd` double(12,2) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=685 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opselfisolation
-- ----------------------------
DROP TABLE IF EXISTS `opselfisolation`;
CREATE TABLE `opselfisolation` (
  `row_id` int(6) NOT NULL AUTO_INCREMENT,
  `registerdate` date NOT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `vn` varchar(12) NOT NULL,
  `ptname` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `ptright` varchar(100) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `plandate1` date NOT NULL,
  `plandate2` date NOT NULL,
  `officer` varchar(255) NOT NULL,
  `officer_date` datetime NOT NULL,
  `startdate` datetime DEFAULT NULL,
  `status_day1` varchar(1) NOT NULL,
  `follower_name1` varchar(255) NOT NULL,
  `enddate` datetime DEFAULT NULL,
  `status_day2` varchar(1) NOT NULL,
  `follower_name2` varchar(255) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=4205 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for opselfisolation_detail
-- ----------------------------
DROP TABLE IF EXISTS `opselfisolation_detail`;
CREATE TABLE `opselfisolation_detail` (
  `row_id` int(6) NOT NULL AUTO_INCREMENT,
  `hosname` varchar(100) NOT NULL,
  `hoscode` varchar(5) NOT NULL,
  `registerdate` date NOT NULL,
  `symptom_date` date NOT NULL,
  `dcdate` date NOT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `idcard` varchar(13) NOT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `vn` varchar(12) NOT NULL,
  `ptname` varchar(255) NOT NULL,
  `age` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `ptright` varchar(100) NOT NULL,
  `address` varchar(255) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `idline` varchar(30) NOT NULL,
  `organ` varchar(255) NOT NULL,
  `patient_vaccine` varchar(255) DEFAULT NULL,
  `risk` varchar(1) NOT NULL,
  `typerisk1` varchar(50) NOT NULL,
  `typerisk2` varchar(50) NOT NULL,
  `typerisk3` varchar(50) NOT NULL,
  `typerisk4` varchar(50) NOT NULL,
  `typerisk5` varchar(50) NOT NULL,
  `typerisk6` varchar(50) NOT NULL,
  `typerisk7` varchar(50) NOT NULL,
  `typerisk8` varchar(50) NOT NULL,
  `typerisk9` varchar(50) NOT NULL,
  `typerisk10` varchar(50) NOT NULL,
  `typerisk11` varchar(50) NOT NULL,
  `typerisk12` varchar(50) NOT NULL,
  `typerisk13` varchar(50) NOT NULL,
  `typerisk14` varchar(50) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bp1` varchar(5) NOT NULL,
  `bp2` varchar(5) NOT NULL,
  `mens_date` varchar(20) NOT NULL,
  `xray` varchar(1) NOT NULL,
  `xrayresult` varchar(1) NOT NULL,
  `xrayresult_other` varchar(255) NOT NULL,
  `atk` varchar(1) NOT NULL,
  `atkdate` varchar(20) DEFAULT NULL,
  `atkunit` varchar(100) NOT NULL,
  `rtpcr` varchar(1) NOT NULL,
  `rtpcr_result` varchar(100) NOT NULL,
  `rtpcr_date` varchar(20) DEFAULT NULL,
  `rtpcr_unit` varchar(100) NOT NULL,
  `phar1` varchar(50) NOT NULL,
  `phar_other1` varchar(100) NOT NULL,
  `phar2` varchar(50) NOT NULL,
  `phar_other2` varchar(100) NOT NULL,
  `phar3` varchar(50) NOT NULL,
  `phar_other3` varchar(100) NOT NULL,
  `phar4` varchar(50) NOT NULL,
  `phar_other4` varchar(100) NOT NULL,
  `phar5` varchar(50) NOT NULL,
  `phar_other5` varchar(100) NOT NULL,
  `phar6` varchar(50) NOT NULL,
  `phar_other6` varchar(100) NOT NULL,
  `phar7` varchar(50) NOT NULL,
  `phar_other7` varchar(100) NOT NULL,
  `phar8` varchar(50) NOT NULL,
  `phar_other8` varchar(100) NOT NULL,
  `phar9` varchar(50) NOT NULL,
  `phar_other9` varchar(100) NOT NULL,
  `diagnosis` text NOT NULL,
  `plan` text NOT NULL,
  `plandate1` date NOT NULL,
  `plantime1` varchar(10) NOT NULL,
  `plandate2` date NOT NULL,
  `plantime2` varchar(10) NOT NULL,
  `consent` varchar(100) NOT NULL,
  `consent_witness` varchar(100) NOT NULL,
  `consent_tel` varchar(50) NOT NULL,
  `consent_social` varchar(100) NOT NULL,
  `consent_date` varchar(20) DEFAULT NULL,
  `complications_before1` varchar(50) NOT NULL,
  `complications_before2` varchar(50) NOT NULL,
  `complications_before3` varchar(50) NOT NULL,
  `complications_before4` varchar(50) NOT NULL,
  `complications_before5` varchar(50) NOT NULL,
  `complications_before6` varchar(50) NOT NULL,
  `treatment_before` text NOT NULL,
  `complications_after1` varchar(50) NOT NULL,
  `complications_after2` varchar(50) NOT NULL,
  `complications_after3` varchar(50) NOT NULL,
  `complications_after4` varchar(50) NOT NULL,
  `complications_after5` varchar(50) NOT NULL,
  `complications_after6` varchar(50) NOT NULL,
  `treatment_after` text NOT NULL,
  `refer` varchar(100) NOT NULL,
  `refer_detail` varchar(255) NOT NULL,
  `refer_cause` varchar(255) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `doctor_licenses` varchar(20) NOT NULL,
  `nurse` varchar(100) NOT NULL,
  `nurse_licenses` varchar(20) NOT NULL,
  `typeservice` varchar(50) NOT NULL,
  `location` varchar(50) NOT NULL,
  `location_other` varchar(50) NOT NULL,
  `officer` varchar(255) NOT NULL,
  `officer_license` varchar(20) NOT NULL,
  `officer_date` datetime NOT NULL,
  `lastupdate_officer` varchar(255) NOT NULL,
  `lastupdate_date` datetime NOT NULL,
  `dcdate_log` varchar(50) NOT NULL,
  `atkdate_log` varchar(50) NOT NULL,
  `drugreact` varchar(50) DEFAULT NULL,
  `opdtype` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3192 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for optdata
-- ----------------------------
DROP TABLE IF EXISTS `optdata`;
CREATE TABLE `optdata` (
  `hn` varchar(10) DEFAULT NULL,
  `id` varchar(15) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `flag` varchar(1) DEFAULT NULL,
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3010 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for orderbmd
-- ----------------------------
DROP TABLE IF EXISTS `orderbmd`;
CREATE TABLE `orderbmd` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `partbmd` varchar(200) NOT NULL,
  `headsub` varchar(200) NOT NULL,
  `sub1` varchar(200) NOT NULL,
  `sub2` varchar(200) NOT NULL,
  `detail_sub2` varchar(200) NOT NULL,
  `sub3` varchar(200) NOT NULL,
  `sub4` varchar(200) NOT NULL,
  `detail_sub4` varchar(200) NOT NULL,
  `sub5` varchar(200) NOT NULL,
  `detail_sub5` varchar(200) NOT NULL,
  `sub6` varchar(200) NOT NULL,
  `sub7` varchar(200) NOT NULL,
  `detail_sub7` varchar(200) NOT NULL,
  `sub8` varchar(200) NOT NULL,
  `detail_sub8` varchar(200) NOT NULL,
  `detail_sub81` varchar(200) NOT NULL,
  `lastchk` varchar(20) NOT NULL,
  `status` varchar(5) NOT NULL,
  `appdate` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=131 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for orderdetail
-- ----------------------------
DROP TABLE IF EXISTS `orderdetail`;
CREATE TABLE `orderdetail` (
  `labnumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `labcode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `labcode1` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `labname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `orderhead_autonumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for orderhead
-- ----------------------------
DROP TABLE IF EXISTS `orderhead`;
CREATE TABLE `orderhead` (
  `autonumber` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `orderdate` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `labnumber` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `hn` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patienttype` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `patientname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `dob` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `sourcecode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sourcename` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `room` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cliniciancode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `clinicianname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `priority` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `clinicalinfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `isquery` int(11) NOT NULL,
  `comment` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`autonumber`)
) ENGINE=MyISAM AUTO_INCREMENT=109658 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for orderhead_log
-- ----------------------------
DROP TABLE IF EXISTS `orderhead_log`;
CREATE TABLE `orderhead_log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `orderhead` int(11) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=116 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for otperiods
-- ----------------------------
DROP TABLE IF EXISTS `otperiods`;
CREATE TABLE `otperiods` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(50) NOT NULL,
  `code` varchar(11) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ottransections
-- ----------------------------
DROP TABLE IF EXISTS `ottransections`;
CREATE TABLE `ottransections` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `actual_date` varchar(30) DEFAULT NULL,
  `ot_date` varchar(30) DEFAULT NULL,
  `otuser_id` int(11) NOT NULL,
  `otperiod_id` int(11) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `update_user` varchar(50) NOT NULL,
  `paid` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for otuser_childs
-- ----------------------------
DROP TABLE IF EXISTS `otuser_childs`;
CREATE TABLE `otuser_childs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otuser_id` varchar(13) DEFAULT NULL,
  `childno` int(11) DEFAULT NULL,
  `yot` varchar(10) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `surname` varchar(100) DEFAULT NULL,
  `sex` varchar(20) DEFAULT NULL,
  `birthdate` date DEFAULT NULL,
  `nationality` varchar(50) DEFAULT NULL,
  `religion` varchar(50) DEFAULT NULL,
  `career` varchar(100) DEFAULT NULL,
  `province` int(11) DEFAULT NULL,
  `zipcode` varchar(10) DEFAULT NULL,
  `f_marriedcer` varchar(25) DEFAULT NULL,
  `f_marrieddate` date DEFAULT NULL,
  `f_marriedprovince` int(11) DEFAULT NULL,
  `f_sentence` varchar(25) DEFAULT NULL,
  `f_sentencedate` date DEFAULT NULL,
  `f_certification` varchar(25) DEFAULT NULL,
  `f_certificationdate` date DEFAULT NULL,
  `f_certificationprovince` int(11) DEFAULT NULL,
  `f_protagecer` varchar(25) NOT NULL,
  `f_protagedate` date NOT NULL,
  `f_protageprovince` int(11) NOT NULL,
  `m_registration` varchar(25) NOT NULL,
  `m_registrationdate` date NOT NULL,
  `m_birthcer` varchar(25) NOT NULL,
  `m_birthdatecer` datetime NOT NULL,
  `m_protagecer` int(11) NOT NULL,
  `m_protagedate` date NOT NULL,
  `m_protageprovince` int(11) NOT NULL,
  `alive` varchar(10) NOT NULL,
  `deathcer` varchar(25) NOT NULL,
  `deathdate` varchar(25) NOT NULL,
  `deathprovince` int(11) NOT NULL,
  `disappearinjunction` varchar(25) NOT NULL,
  `disappeardate` date NOT NULL,
  `incompetent` varchar(25) NOT NULL,
  `incompetentdate` date NOT NULL,
  `married` varchar(10) NOT NULL,
  `marriedcer` varchar(25) NOT NULL,
  `marriedcerdate` date NOT NULL,
  `marriedcerprovince` int(11) NOT NULL,
  `divorcecer` varchar(25) NOT NULL,
  `divorcecerdate` date NOT NULL,
  `divorcecerprovince` int(11) NOT NULL,
  `widoweddeathcer` varchar(25) NOT NULL,
  `widoweddate` date NOT NULL,
  `widowedprovince` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for otuser_parents
-- ----------------------------
DROP TABLE IF EXISTS `otuser_parents`;
CREATE TABLE `otuser_parents` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otuser_id` int(11) NOT NULL,
  `f_yot` varchar(10) DEFAULT NULL,
  `f_identification_number` varchar(13) DEFAULT NULL,
  `f_name` varchar(50) DEFAULT NULL,
  `f_surname` varchar(50) DEFAULT NULL,
  `f_birthdate` varchar(30) DEFAULT NULL,
  `f_nationality` varchar(50) DEFAULT NULL,
  `f_religion` varchar(50) DEFAULT NULL,
  `f_career` varchar(100) DEFAULT NULL,
  `f_marriedm` varchar(25) DEFAULT NULL,
  `f_marriedmcer` varchar(25) DEFAULT NULL,
  `f_marriedmdate` varchar(30) DEFAULT NULL,
  `f_marriedmprovince` int(11) NOT NULL,
  `f_childcer` varchar(25) DEFAULT NULL,
  `f_childcerdate` varchar(30) DEFAULT NULL,
  `f_childcerprovince` int(11) NOT NULL,
  `f_marriedbefore2478` varchar(25) DEFAULT NULL,
  `f_marriedbefore2478date` varchar(30) DEFAULT NULL,
  `f_marriedbefore2478province` int(11) NOT NULL,
  `f_sentencechild` varchar(25) DEFAULT NULL,
  `f_sentencechilddate` varchar(30) DEFAULT NULL,
  `f_protagecer` varchar(25) DEFAULT NULL,
  `f_protagedate` varchar(30) DEFAULT NULL,
  `f_protageprovince` int(11) NOT NULL,
  `f_alive` varchar(10) DEFAULT NULL,
  `f_deathcer` varchar(25) DEFAULT NULL,
  `f_deathdate` varchar(30) DEFAULT NULL,
  `f_deathprovince` int(11) NOT NULL,
  `f_disappearcer` varchar(25) DEFAULT NULL,
  `f_disappeardate` varchar(30) DEFAULT NULL,
  `f_married` varchar(25) DEFAULT NULL,
  `f_marriedcer` varchar(25) DEFAULT NULL,
  `f_marrieddate` varchar(30) DEFAULT NULL,
  `f_marriedprovince` int(11) NOT NULL,
  `f_divorcecer` varchar(25) DEFAULT NULL,
  `f_divorcedate` varchar(30) DEFAULT NULL,
  `f_divorceprovince` int(11) NOT NULL,
  `f_widoweddeathcer` varchar(25) DEFAULT NULL,
  `f_widoweddate` varchar(30) DEFAULT NULL,
  `f_widowedprovince` int(11) NOT NULL,
  `m_identification_number` varchar(13) DEFAULT NULL,
  `m_yot` varchar(10) DEFAULT NULL,
  `m_name` varchar(50) DEFAULT NULL,
  `m_surname` varchar(50) DEFAULT NULL,
  `m_birthdate` varchar(30) DEFAULT NULL,
  `m_nationality` varchar(100) DEFAULT NULL,
  `m_religion` varchar(100) DEFAULT NULL,
  `m_career` varchar(250) DEFAULT NULL,
  `m_registration` varchar(25) DEFAULT NULL,
  `m_registrationdate` varchar(30) DEFAULT NULL,
  `m_birthcer` varchar(25) DEFAULT NULL,
  `m_birthcerdate` varchar(30) DEFAULT NULL,
  `m_protagecer` varchar(25) DEFAULT NULL,
  `m_protagedate` varchar(30) DEFAULT NULL,
  `m_protageprovince` int(11) NOT NULL,
  `m_alive` varchar(10) DEFAULT NULL,
  `m_deathcer` varchar(25) DEFAULT NULL,
  `m_deathdate` datetime NOT NULL,
  `m_deathprovince` int(11) NOT NULL,
  `m_married` varchar(10) DEFAULT NULL,
  `m_marriedcer` varchar(25) DEFAULT NULL,
  `m_marrieddate` varchar(30) DEFAULT NULL,
  `m_marriedprovince` int(11) NOT NULL,
  `m_divorce` varchar(25) DEFAULT NULL,
  `m_divorcedate` varchar(30) DEFAULT NULL,
  `m_divorceprovince` int(11) NOT NULL,
  `m_widoweddeathcer` varchar(25) DEFAULT NULL,
  `m_widoweddate` varchar(30) DEFAULT NULL,
  `m_widowedprovince` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for otusers
-- ----------------------------
DROP TABLE IF EXISTS `otusers`;
CREATE TABLE `otusers` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `otuser_code` varchar(11) DEFAULT NULL,
  `name` varchar(150) NOT NULL,
  `position` varchar(150) NOT NULL,
  `department_id` int(11) NOT NULL DEFAULT '0',
  `identification_number` varchar(15) NOT NULL,
  `officertype` varchar(250) NOT NULL,
  `govermentcode` varchar(11) NOT NULL,
  `govprovince` int(11) NOT NULL,
  `office` varchar(250) NOT NULL,
  `ministry` varchar(250) NOT NULL,
  `withdrawregis_unit` varchar(250) NOT NULL,
  `officerpromotedate` date NOT NULL,
  `pensionmember` varchar(25) NOT NULL,
  `pensioncumulative` varchar(25) NOT NULL,
  `email` varchar(100) NOT NULL,
  `surname` varchar(100) NOT NULL,
  `yot` varchar(20) NOT NULL,
  `sex` varchar(2) NOT NULL,
  `birthdate` date NOT NULL,
  `telephone` varchar(20) NOT NULL,
  `class` varchar(250) NOT NULL,
  `part` varchar(250) NOT NULL,
  `group` varchar(250) NOT NULL,
  `intitute` varchar(250) NOT NULL,
  `nationality` varchar(100) NOT NULL,
  `religion` varchar(100) NOT NULL,
  `career` varchar(250) NOT NULL,
  `alive` varchar(25) NOT NULL,
  `deathcer` varchar(50) NOT NULL,
  `deathdate` varchar(30) DEFAULT NULL,
  `deathprovince` int(11) NOT NULL,
  `disappearinjunction` varchar(25) NOT NULL,
  `disappeardate` varchar(30) DEFAULT NULL,
  `married` varchar(25) NOT NULL,
  `marriedcer` varchar(25) NOT NULL,
  `marrieddate` varchar(30) DEFAULT NULL,
  `marriedprovince` int(11) NOT NULL,
  `houseno` varchar(10) NOT NULL,
  `moo` varchar(10) NOT NULL,
  `village` varchar(100) NOT NULL,
  `building` varchar(100) NOT NULL,
  `room` varchar(25) NOT NULL,
  `soi` varchar(100) NOT NULL,
  `road` varchar(100) NOT NULL,
  `tambol` varchar(100) NOT NULL,
  `district` varchar(100) NOT NULL,
  `province` int(11) NOT NULL,
  `zipcode` varchar(6) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for out_result_chkup
-- ----------------------------
DROP TABLE IF EXISTS `out_result_chkup`;
CREATE TABLE `out_result_chkup` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(50) NOT NULL,
  `weight` varchar(30) NOT NULL,
  `height` varchar(30) NOT NULL,
  `bp1` varchar(30) NOT NULL,
  `bp2` varchar(30) NOT NULL,
  `p` varchar(20) DEFAULT NULL,
  `cxr` text,
  `hiv` varchar(30) NOT NULL,
  `cbc` varchar(30) NOT NULL,
  `vdrl` varchar(30) NOT NULL,
  `ua` varchar(30) NOT NULL,
  `amp` varchar(30) NOT NULL,
  `stool` varchar(30) NOT NULL,
  `afp` varchar(100) DEFAULT NULL,
  `cea` varchar(100) DEFAULT NULL,
  `psa` varchar(100) DEFAULT NULL,
  `testolerone` varchar(100) DEFAULT NULL,
  `estradiol` varchar(100) DEFAULT NULL,
  `hpv` varchar(100) DEFAULT NULL,
  `mammogram` varchar(100) DEFAULT NULL,
  `ca125` varchar(100) DEFAULT NULL,
  `ekg` varchar(255) DEFAULT NULL,
  `pft` varchar(255) NOT NULL,
  `altra` varchar(255) DEFAULT NULL,
  `altradown` varchar(255) DEFAULT NULL,
  `doctor_result` varchar(256) DEFAULT NULL,
  `year_chk` char(2) DEFAULT NULL,
  `officer` varchar(50) NOT NULL,
  `register` varchar(30) DEFAULT NULL,
  `part` varchar(255) DEFAULT NULL,
  `va` varchar(255) DEFAULT NULL,
  `42702` text,
  `temp` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `prawat` varchar(100) NOT NULL,
  `accident_surgery` varchar(60) NOT NULL,
  `treat_hospital` varchar(60) NOT NULL,
  `epilepsy` varchar(60) NOT NULL,
  `treat_other` varchar(60) NOT NULL,
  `cigga` varchar(20) NOT NULL,
  `alcohol` varchar(20) NOT NULL,
  `exercise` varchar(20) NOT NULL,
  `allergic` varchar(100) NOT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `bp3` varchar(30) NOT NULL,
  `bp4` varchar(30) NOT NULL,
  `eye` varchar(20) NOT NULL,
  `eye_detail` varchar(255) DEFAULT NULL,
  `pt` varchar(255) DEFAULT NULL,
  `pt_detail` varchar(255) NOT NULL,
  `last_officer` varchar(50) DEFAULT NULL,
  `last_update` datetime NOT NULL,
  `seq` int(11) DEFAULT NULL,
  `cs` varchar(255) DEFAULT NULL,
  `result_cs` varchar(255) DEFAULT NULL,
  `blindness` text,
  `hearing` text,
  `metal` text,
  `metal_result` text NOT NULL,
  `benzene` varchar(255) NOT NULL,
  `benzene_result` varchar(255) NOT NULL,
  `bone_density` text NOT NULL,
  `occupa_health` varchar(255) DEFAULT NULL,
  `outAfp` varchar(50) NOT NULL,
  `outAfpResult` varchar(50) NOT NULL,
  `outPsa` varchar(50) NOT NULL,
  `outPsaResult` varchar(50) NOT NULL,
  `cimt` varchar(255) DEFAULT NULL,
  `echo` varchar(255) DEFAULT NULL,
  `abi` varchar(255) DEFAULT NULL,
  `eye_pressure` varchar(255) DEFAULT NULL,
  `eye_pressure_detail` text,
  `eye_vision` varchar(255) DEFAULT NULL,
  `eye_vision_detail` text,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `part` (`part`)
) ENGINE=MyISAM AUTO_INCREMENT=27008 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for outlab_company
-- ----------------------------
DROP TABLE IF EXISTS `outlab_company`;
CREATE TABLE `outlab_company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `labcare_name` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for outlab_company_part
-- ----------------------------
DROP TABLE IF EXISTS `outlab_company_part`;
CREATE TABLE `outlab_company_part` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `company_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for outlab_list
-- ----------------------------
DROP TABLE IF EXISTS `outlab_list`;
CREATE TABLE `outlab_list` (
  `lab_id` int(11) DEFAULT NULL,
  `company_part_id` int(11) DEFAULT NULL,
  `company` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for password_resets
-- ----------------------------
DROP TABLE IF EXISTS `password_resets`;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for patdata
-- ----------------------------
DROP TABLE IF EXISTS `patdata`;
CREATE TABLE `patdata` (
  `row_id` bigint(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `ptname` varchar(30) DEFAULT NULL,
  `copy` char(1) DEFAULT NULL,
  `doctor` varchar(40) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `code` varchar(20) DEFAULT NULL,
  `detail` varchar(140) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `yprice` double(10,2) DEFAULT NULL,
  `nprice` double(10,2) DEFAULT NULL,
  `paid` double(10,2) DEFAULT NULL,
  `depart` varchar(5) DEFAULT NULL,
  `labcode` varchar(5) DEFAULT NULL,
  `report` mediumtext,
  `part` varchar(8) DEFAULT NULL,
  `idno` int(11) NOT NULL DEFAULT '0',
  `picture` varchar(32) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `film_size` varchar(6) DEFAULT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `priority` varchar(2) NOT NULL,
  `tranipacc` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`),
  KEY `hn` (`hn`),
  KEY `depart` (`depart`,`code`),
  KEY `idno` (`idno`)
) ENGINE=MyISAM AUTO_INCREMENT=8387905 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for patient_vaccine_covid19
-- ----------------------------
DROP TABLE IF EXISTS `patient_vaccine_covid19`;
CREATE TABLE `patient_vaccine_covid19` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `idcard` varchar(13) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `covid19_vaccine` varchar(1) NOT NULL,
  `amount1` varchar(1) DEFAULT NULL,
  `vaccine_name1` varchar(50) NOT NULL,
  `amount2` varchar(1) DEFAULT NULL,
  `vaccine_name2` varchar(50) NOT NULL,
  `amount3` varchar(1) DEFAULT NULL,
  `vaccine_name3` varchar(50) NOT NULL,
  `amount4` varchar(1) DEFAULT NULL,
  `vaccine_name4` varchar(50) NOT NULL,
  `amount5` varchar(1) DEFAULT NULL,
  `vaccine_name5` varchar(50) NOT NULL,
  `amount6` varchar(1) DEFAULT NULL,
  `vaccine_name6` varchar(50) NOT NULL,
  `officer` varchar(100) DEFAULT NULL,
  `officer_date` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=29660 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pdxofyearxray
-- ----------------------------
DROP TABLE IF EXISTS `pdxofyearxray`;
CREATE TABLE `pdxofyearxray` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `name` varchar(100) NOT NULL,
  `idcard` varchar(13) NOT NULL,
  `address` text NOT NULL,
  `type` varchar(50) NOT NULL,
  `company` varchar(50) DEFAULT NULL,
  `datechkup` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pername
-- ----------------------------
DROP TABLE IF EXISTS `pername`;
CREATE TABLE `pername` (
  `code` varchar(3) NOT NULL,
  `detail1` varchar(50) NOT NULL,
  `detail2` varchar(50) NOT NULL,
  `detail3` varchar(50) NOT NULL,
  `detail4` varchar(50) NOT NULL,
  `status` char(5) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for PERSON
-- ----------------------------
DROP TABLE IF EXISTS `PERSON`;
CREATE TABLE `PERSON` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `date_hn` varchar(255) DEFAULT NULL,
  `HOSTPCODE` varchar(255) NOT NULL,
  `CID` varchar(255) NOT NULL,
  `PID` varchar(255) NOT NULL,
  `HID` varchar(255) DEFAULT NULL,
  `PRENAME` varchar(255) NOT NULL,
  `NAME` varchar(255) NOT NULL,
  `LNAME` varchar(255) NOT NULL,
  `HN` varchar(255) DEFAULT NULL,
  `SEX` varchar(255) NOT NULL,
  `BIRTH` varchar(255) NOT NULL,
  `MSTATUS` varchar(255) DEFAULT NULL,
  `OCCUPATION_OLD` varchar(255) DEFAULT NULL,
  `OCCUPATION_NEW` varchar(255) DEFAULT NULL,
  `RACE` varchar(255) DEFAULT NULL,
  `NATION` varchar(255) NOT NULL,
  `RELIGION` varchar(255) DEFAULT NULL,
  `EDUCATION` varchar(255) DEFAULT NULL,
  `FSTATUS` varchar(255) DEFAULT NULL,
  `FATHER` varchar(255) DEFAULT NULL,
  `MOTHER` varchar(255) DEFAULT NULL,
  `COUPLE` varchar(255) DEFAULT NULL,
  `VSTATUS` varchar(255) DEFAULT NULL,
  `MOVEIN` varchar(255) DEFAULT NULL,
  `DISCHARGE` varchar(255) DEFAULT NULL,
  `DDISCHARGE` varchar(255) DEFAULT NULL,
  `ABOGROUP` varchar(255) DEFAULT NULL,
  `RHGROUP` varchar(255) DEFAULT NULL,
  `LABOR` varchar(255) DEFAULT NULL,
  `PASSPORT` varchar(255) DEFAULT NULL,
  `TYPEAREA` varchar(255) NOT NULL,
  `D_UPDATE` varchar(255) DEFAULT NULL,
  `TELEPHONE` varchar(255) DEFAULT NULL,
  `MOBILE` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `PID` (`PID`),
  KEY `CID` (`CID`),
  KEY `HN` (`HN`)
) ENGINE=MyISAM AUTO_INCREMENT=95253 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for personal_access_tokens
-- ----------------------------
DROP TABLE IF EXISTS `personal_access_tokens`;
CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for phar_allergic
-- ----------------------------
DROP TABLE IF EXISTS `phar_allergic`;
CREATE TABLE `phar_allergic` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_save` datetime NOT NULL,
  `hn` varchar(50) NOT NULL,
  `drug_code` varchar(50) NOT NULL,
  `phardep_id` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_save` (`date_save`,`hn`,`drug_code`),
  KEY `hn` (`hn`),
  KEY `drug_code` (`drug_code`)
) ENGINE=MyISAM AUTO_INCREMENT=2392 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for phar_intervention
-- ----------------------------
DROP TABLE IF EXISTS `phar_intervention`;
CREATE TABLE `phar_intervention` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `phar_id` int(11) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_inter` datetime NOT NULL,
  `detail` text,
  PRIMARY KEY (`id`),
  KEY `phar_id` (`phar_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for phar_user
-- ----------------------------
DROP TABLE IF EXISTS `phar_user`;
CREATE TABLE `phar_user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_add` datetime NOT NULL,
  `hn` varchar(10) NOT NULL,
  `drugid` varchar(50) NOT NULL,
  `drugdate` datetime NOT NULL,
  `drugcode` varchar(10) NOT NULL,
  `orderdate` datetime NOT NULL,
  `autonumber` varchar(255) NOT NULL,
  `labcode` varchar(50) NOT NULL,
  `result` float NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`),
  KEY `drugcode` (`drugcode`),
  KEY `autonumber` (`autonumber`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for phardep
-- ----------------------------
DROP TABLE IF EXISTS `phardep`;
CREATE TABLE `phardep` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) NOT NULL DEFAULT '0.00',
  `doctor` varchar(40) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `diag` varchar(48) DEFAULT NULL,
  `essd` double(10,2) DEFAULT NULL,
  `nessdy` double(10,2) DEFAULT NULL,
  `nessdn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `dgtake` varchar(30) DEFAULT NULL,
  `tvn` varchar(12) DEFAULT NULL,
  `ptright` varchar(30) DEFAULT NULL,
  `phapt` varchar(30) DEFAULT NULL,
  `borrow` char(1) DEFAULT NULL,
  `cashok` varchar(40) DEFAULT NULL,
  `inj` varchar(5) DEFAULT NULL,
  `datedr` varchar(20) NOT NULL,
  `department` varchar(5) NOT NULL,
  `lastupdate` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`),
  KEY `hn` (`hn`),
  KEY `ptright` (`ptright`),
  KEY `row_id` (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2311989 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for phardep_pt
-- ----------------------------
DROP TABLE IF EXISTS `phardep_pt`;
CREATE TABLE `phardep_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `hn` varchar(12) DEFAULT NULL,
  `an` varchar(12) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `paid` double(12,2) NOT NULL DEFAULT '0.00',
  `doctor` varchar(40) DEFAULT NULL,
  `item` int(2) DEFAULT NULL,
  `idname` varchar(32) DEFAULT NULL,
  `diag` varchar(48) DEFAULT NULL,
  `essd` double(10,2) DEFAULT NULL,
  `nessdy` double(10,2) DEFAULT NULL,
  `nessdn` double(10,2) DEFAULT NULL,
  `dpy` double(10,2) DEFAULT NULL,
  `dpn` double(10,2) DEFAULT NULL,
  `accno` int(4) DEFAULT NULL,
  `dsy` double(10,2) DEFAULT NULL,
  `dsn` double(10,2) DEFAULT NULL,
  `dgtake` varchar(30) DEFAULT NULL,
  `tvn` varchar(12) DEFAULT NULL,
  `ptright` varchar(30) DEFAULT NULL,
  `phapt` varchar(30) DEFAULT NULL,
  `borrow` char(1) DEFAULT NULL,
  `cashok` varchar(40) DEFAULT NULL,
  `inj` varchar(5) DEFAULT NULL,
  `datedr` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`),
  KEY `hn` (`hn`),
  KEY `ptright` (`ptright`),
  KEY `row_id` (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pharinj_history
-- ----------------------------
DROP TABLE IF EXISTS `pharinj_history`;
CREATE TABLE `pharinj_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(255) NOT NULL,
  `dphardep_id` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=28058 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pharkew
-- ----------------------------
DROP TABLE IF EXISTS `pharkew`;
CREATE TABLE `pharkew` (
  `row_id` int(11) NOT NULL DEFAULT '0',
  `date` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `hn` varchar(12) NOT NULL DEFAULT '',
  `intime` varchar(30) DEFAULT '00:00:00',
  `outtime` varchar(30) DEFAULT '00:00:00',
  `kew` varchar(12) NOT NULL DEFAULT '',
  `vn` varchar(12) NOT NULL DEFAULT '',
  `an` varchar(10) NOT NULL DEFAULT ''
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for physi_cert_history
-- ----------------------------
DROP TABLE IF EXISTS `physi_cert_history`;
CREATE TABLE `physi_cert_history` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_save` date NOT NULL,
  `number` varchar(50) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `physi_dt_name` varchar(255) DEFAULT NULL,
  `physi_license` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `diag` varchar(255) DEFAULT NULL,
  `file_path` varchar(255) DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `officer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date` (`date`),
  KEY `hn` (`hn`),
  KEY `physi_license` (`physi_license`)
) ENGINE=MyISAM AUTO_INCREMENT=363 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pocompany
-- ----------------------------
DROP TABLE IF EXISTS `pocompany`;
CREATE TABLE `pocompany` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `depart` varchar(32) DEFAULT NULL,
  `departno` varchar(32) DEFAULT NULL,
  `departdate` varchar(32) DEFAULT NULL,
  `prepono` varchar(16) DEFAULT NULL,
  `prepodate` varchar(20) DEFAULT NULL,
  `comcode` varchar(10) DEFAULT NULL,
  `comname` varchar(60) DEFAULT NULL,
  `items` int(2) DEFAULT NULL,
  `netprice` double(12,2) DEFAULT NULL,
  `pono` varchar(16) DEFAULT NULL,
  `podate` varchar(20) DEFAULT NULL,
  `bounddate` varchar(20) DEFAULT NULL,
  `officer` varchar(40) DEFAULT NULL,
  `hponame` varchar(20) DEFAULT NULL,
  `hponum` varchar(20) DEFAULT NULL,
  `hpodate` varchar(20) DEFAULT NULL,
  `ponoyear` varchar(5) NOT NULL,
  `chkindate` varchar(20) NOT NULL,
  `senddate` varchar(20) NOT NULL,
  `borrowdate` varchar(20) DEFAULT NULL,
  `pobillno` varchar(20) NOT NULL,
  `pobilldate` varchar(20) NOT NULL,
  `potype` varchar(5) DEFAULT NULL,
  `fixdate` varchar(20) NOT NULL,
  `reportdate` varchar(20) NOT NULL,
  `user_edit` varchar(100) NOT NULL,
  `lastupdate` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=42679 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for poitems
-- ----------------------------
DROP TABLE IF EXISTS `poitems`;
CREATE TABLE `poitems` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(80) DEFAULT NULL,
  `packing` varchar(16) DEFAULT NULL,
  `pack` varchar(20) DEFAULT NULL,
  `amount` double(6,0) DEFAULT NULL,
  `minimum` int(8) DEFAULT NULL,
  `totalstk` int(11) DEFAULT NULL,
  `packpri` double(12,2) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `free` double(6,1) DEFAULT NULL,
  `specno` varchar(16) DEFAULT NULL,
  `idno` int(11) DEFAULT NULL,
  `potype` varchar(5) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `idno` (`idno`)
) ENGINE=MyISAM AUTO_INCREMENT=84752 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for policy
-- ----------------------------
DROP TABLE IF EXISTS `policy`;
CREATE TABLE `policy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hospcode` varchar(5) DEFAULT NULL,
  `policy_id` varchar(3) DEFAULT NULL,
  `policy_year` text,
  `policy_data` text,
  `d_update` varchar(14) DEFAULT NULL,
  `opday_id` varchar(50) DEFAULT NULL,
  `last_update` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pp
-- ----------------------------
DROP TABLE IF EXISTS `pp`;
CREATE TABLE `pp` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `pcucode` varchar(10) NOT NULL,
  `ref_pid` varchar(15) NOT NULL,
  `ref_hn` varchar(15) NOT NULL,
  `gravida` varchar(5) NOT NULL,
  `bdate` varchar(15) NOT NULL,
  `bplace` varchar(5) NOT NULL,
  `bhost` varchar(5) NOT NULL,
  `btype` varchar(5) NOT NULL,
  `bdoctor` varchar(5) NOT NULL,
  `bweight` varchar(5) NOT NULL,
  `asphyxia` varchar(5) NOT NULL,
  `vitk` varchar(5) NOT NULL,
  `bcare1` varchar(5) NOT NULL,
  `bcare2` varchar(5) NOT NULL,
  `bcare3` varchar(5) NOT NULL,
  `bcres` varchar(5) NOT NULL,
  `d_update` varchar(50) DEFAULT NULL,
  `cid` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for pre_home
-- ----------------------------
DROP TABLE IF EXISTS `pre_home`;
CREATE TABLE `pre_home` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `opcard_id` int(11) DEFAULT NULL,
  `home_number` varchar(255) DEFAULT NULL,
  `road` varchar(255) DEFAULT NULL,
  `moo` varchar(255) DEFAULT NULL,
  `tambon` varchar(255) DEFAULT NULL,
  `amphoe` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  `etc` varchar(255) DEFAULT NULL,
  `update` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=897 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for predxofyear
-- ----------------------------
DROP TABLE IF EXISTS `predxofyear`;
CREATE TABLE `predxofyear` (
  `row_id` int(3) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT NULL,
  `thdatehn` varchar(20) NOT NULL,
  `thdatevn` varchar(20) NOT NULL,
  `hn` varchar(8) NOT NULL,
  `vn` varchar(5) NOT NULL,
  `ptname` varchar(80) NOT NULL,
  `age` varchar(20) NOT NULL,
  `camp` varchar(60) NOT NULL,
  `camp_until` varchar(10) NOT NULL,
  `height` varchar(10) NOT NULL,
  `weight` varchar(10) NOT NULL,
  `round_` varchar(10) NOT NULL,
  `temperature` varchar(10) NOT NULL,
  `pause` varchar(10) NOT NULL,
  `rate` varchar(10) NOT NULL,
  `bmi` varchar(10) NOT NULL,
  `bp1` varchar(10) NOT NULL,
  `bp2` varchar(10) NOT NULL,
  `drugreact` varchar(1) NOT NULL,
  `congenital_disease` varchar(60) NOT NULL,
  `type` varchar(10) NOT NULL,
  `organ` text NOT NULL,
  `doctor` varchar(40) NOT NULL,
  `ua_color` varchar(10) NOT NULL,
  `ua_appear` varchar(10) NOT NULL,
  `ua_spgr` varchar(10) NOT NULL,
  `ua_phu` varchar(10) NOT NULL,
  `ua_bloodu` varchar(10) NOT NULL,
  `ua_prou` varchar(10) NOT NULL,
  `ua_gluu` varchar(10) NOT NULL,
  `ua_ketu` varchar(10) NOT NULL,
  `ua_urobil` varchar(10) NOT NULL,
  `ua_bili` varchar(10) NOT NULL,
  `ua_nitrit` varchar(10) NOT NULL,
  `ua_wbcu` varchar(10) NOT NULL,
  `ua_rbcu` varchar(10) NOT NULL,
  `ua_epiu` varchar(10) NOT NULL,
  `ua_bactu` varchar(10) NOT NULL,
  `ua_yeast` varchar(10) NOT NULL,
  `ua_mucosu` varchar(10) NOT NULL,
  `ua_amopu` varchar(10) NOT NULL,
  `ua_castu` varchar(10) NOT NULL,
  `ua_crystu` varchar(10) NOT NULL,
  `ua_otheru` varchar(10) NOT NULL,
  `stat_ua` varchar(20) NOT NULL,
  `reason_ua` varchar(100) DEFAULT NULL,
  `cbc_wbc` varchar(10) NOT NULL,
  `stat_wbc` varchar(20) NOT NULL,
  `reason_wbc` varchar(100) NOT NULL,
  `cbc_rbc` varchar(10) NOT NULL,
  `cbc_hb` varchar(10) NOT NULL,
  `cbc_hct` varchar(10) NOT NULL,
  `stat_hct` varchar(20) NOT NULL,
  `reason_hct` varchar(100) NOT NULL,
  `cbc_mcv` varchar(10) NOT NULL,
  `cbc_mch` varchar(10) NOT NULL,
  `cbc_mchc` varchar(10) NOT NULL,
  `cbc_pltc` varchar(10) NOT NULL,
  `stat_pltc` varchar(20) NOT NULL,
  `reason_pltc` varchar(100) NOT NULL,
  `cbc_plts` varchar(10) NOT NULL,
  `cbc_neu` varchar(10) NOT NULL,
  `cbc_lymp` varchar(10) NOT NULL,
  `cbc_mono` varchar(10) NOT NULL,
  `cbc_eos` varchar(10) NOT NULL,
  `cbc_baso` varchar(10) NOT NULL,
  `cbc_band` varchar(10) NOT NULL,
  `cbc_atyp` varchar(10) NOT NULL,
  `cbc_nrbc` varchar(10) NOT NULL,
  `cbc_rbcmor` varchar(10) NOT NULL,
  `cbc_other` varchar(10) NOT NULL,
  `stat_cbc` varchar(20) NOT NULL,
  `reason_cbc` varchar(100) DEFAULT NULL,
  `cxr` varchar(10) NOT NULL,
  `reason_cxr` varchar(100) DEFAULT NULL,
  `bs` varchar(10) NOT NULL,
  `stat_bs` varchar(20) NOT NULL,
  `reason_bs` varchar(100) DEFAULT NULL,
  `bun` varchar(10) NOT NULL,
  `stat_bun` varchar(20) NOT NULL,
  `reason_bun` varchar(100) DEFAULT NULL,
  `cr` varchar(10) NOT NULL,
  `stat_cr` varchar(20) NOT NULL,
  `reason_cr` varchar(100) DEFAULT NULL,
  `uric` varchar(10) NOT NULL,
  `stat_uric` varchar(20) NOT NULL,
  `reason_uric` varchar(100) DEFAULT NULL,
  `chol` varchar(10) NOT NULL,
  `stat_chol` varchar(20) NOT NULL,
  `reason_chol` varchar(100) DEFAULT NULL,
  `tg` varchar(10) NOT NULL,
  `stat_tg` varchar(20) NOT NULL,
  `reason_tg` varchar(100) DEFAULT NULL,
  `sgot` varchar(10) NOT NULL,
  `stat_sgot` varchar(20) NOT NULL,
  `reason_sgot` varchar(100) DEFAULT NULL,
  `sgpt` varchar(10) NOT NULL,
  `stat_sgpt` varchar(20) NOT NULL,
  `reason_sgpt` varchar(100) DEFAULT NULL,
  `alk` varchar(10) NOT NULL,
  `stat_alk` varchar(20) NOT NULL,
  `reason_alk` varchar(100) DEFAULT NULL,
  `general` varchar(10) DEFAULT NULL,
  `reason_general` varchar(100) DEFAULT NULL,
  `pap` varchar(10) NOT NULL,
  `reason_pap` varchar(100) DEFAULT NULL,
  `other1` varchar(10) NOT NULL,
  `stat_other1` varchar(20) NOT NULL,
  `reason_other1` varchar(100) DEFAULT NULL,
  `other2` varchar(10) NOT NULL,
  `stat_other2` varchar(20) NOT NULL,
  `reason_other2` varchar(100) DEFAULT NULL,
  `dx` text NOT NULL,
  `clinic` varchar(30) NOT NULL,
  `cigarette` varchar(1) NOT NULL,
  `alcohol` varchar(1) NOT NULL,
  `summary` varchar(100) DEFAULT NULL,
  `company` varchar(100) NOT NULL,
  `type_check` varchar(100) NOT NULL,
  `comment` varchar(100) NOT NULL,
  `datechkup` varchar(100) NOT NULL,
  `price` varchar(10) NOT NULL,
  `hear500R` varchar(10) DEFAULT NULL,
  `hear500L` varchar(10) DEFAULT NULL,
  `hear1000R` varchar(10) DEFAULT NULL,
  `hear1000L` varchar(10) DEFAULT NULL,
  `hear2000R` varchar(10) DEFAULT NULL,
  `hear2000L` varchar(10) DEFAULT NULL,
  `hear3000R` varchar(10) DEFAULT NULL,
  `hear3000L` varchar(10) DEFAULT NULL,
  `hear4000R` varchar(10) DEFAULT NULL,
  `hear4000L` varchar(10) DEFAULT NULL,
  `hear6000R` varchar(10) DEFAULT NULL,
  `hear6000L` varchar(10) DEFAULT NULL,
  `hear8000R` varchar(10) DEFAULT NULL,
  `hear8000L` varchar(10) DEFAULT NULL,
  `LowRight` varchar(20) NOT NULL,
  `LowLeft` varchar(20) NOT NULL,
  `HighRight` varchar(20) NOT NULL,
  `HighLeft` varchar(20) NOT NULL,
  `ptaRight1` varchar(10) NOT NULL,
  `ptaLeft1` varchar(10) NOT NULL,
  `ptaRight2` varchar(10) NOT NULL,
  `ptaLeft2` varchar(10) NOT NULL,
  `FVC1` varchar(10) DEFAULT NULL,
  `FVC2` varchar(10) NOT NULL,
  `FVC3` varchar(10) NOT NULL,
  `FEV1` varchar(10) NOT NULL,
  `FEV2` varchar(10) NOT NULL,
  `FEV3` varchar(10) NOT NULL,
  `RO1` varchar(10) DEFAULT NULL,
  `RO2` varchar(10) NOT NULL,
  `RO3` varchar(10) NOT NULL,
  `PEF1` varchar(10) DEFAULT NULL,
  `PEF2` varchar(10) NOT NULL,
  `PEF3` varchar(10) NOT NULL,
  `reason_chest` varchar(100) NOT NULL,
  `stat_chest` varchar(100) NOT NULL,
  `lead` varchar(100) DEFAULT NULL,
  `resultlead` varchar(100) NOT NULL,
  `cadmium` varchar(100) DEFAULT NULL,
  `resultcadmium` varchar(100) NOT NULL,
  `chromium` varchar(100) DEFAULT NULL,
  `resultchromium` varchar(100) NOT NULL,
  `arsenic` varchar(100) DEFAULT NULL,
  `resultarsenic` varchar(100) NOT NULL,
  `mercury` varchar(100) DEFAULT NULL,
  `resultmercury` varchar(100) NOT NULL,
  `copper` varchar(100) DEFAULT NULL,
  `resultcopper` varchar(100) NOT NULL,
  `nickel` varchar(100) DEFAULT NULL,
  `resultnickel` varchar(100) NOT NULL,
  `antimony` varchar(100) DEFAULT NULL,
  `resultantimony` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=1893 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for prename
-- ----------------------------
DROP TABLE IF EXISTS `prename`;
CREATE TABLE `prename` (
  `code` varchar(3) NOT NULL,
  `detail1` varchar(50) NOT NULL,
  `detail2` varchar(50) NOT NULL,
  `status` varchar(20) NOT NULL,
  KEY `detail1` (`detail1`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for province
-- ----------------------------
DROP TABLE IF EXISTS `province`;
CREATE TABLE `province` (
  `PROVINCE2_ID` int(5) NOT NULL AUTO_INCREMENT,
  `PROVINCE2_CODE` varchar(2) DEFAULT NULL,
  `PROVINCE2_NAME` varchar(150) DEFAULT NULL,
  `GEO_ID` int(5) DEFAULT '0',
  PRIMARY KEY (`PROVINCE2_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for province_new
-- ----------------------------
DROP TABLE IF EXISTS `province_new`;
CREATE TABLE `province_new` (
  `PROVINCE_ID` int(5) NOT NULL AUTO_INCREMENT,
  `PROVINCE_CODE` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PROVINCE_NAME` varchar(150) COLLATE utf8_unicode_ci DEFAULT NULL,
  `GEO_ID` int(5) DEFAULT '0',
  PRIMARY KEY (`PROVINCE_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for provinces
-- ----------------------------
DROP TABLE IF EXISTS `provinces`;
CREATE TABLE `provinces` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `name` varchar(150) CHARACTER SET utf8 DEFAULT NULL,
  `geo_id` int(5) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=77 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for pstmax
-- ----------------------------
DROP TABLE IF EXISTS `pstmax`;
CREATE TABLE `pstmax` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date_time` datetime NOT NULL,
  `yrmonth` varchar(7) NOT NULL,
  `diag` varchar(256) NOT NULL,
  `case1` int(11) NOT NULL,
  `case2` int(11) NOT NULL,
  `case3` int(11) NOT NULL,
  `sumcase` int(11) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=960 DEFAULT CHARSET=utf8;

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
  `nurse_dx6` varchar(255) DEFAULT NULL,
  `nurse_dx7` varchar(255) DEFAULT NULL,
  `nurse_dx8` varchar(255) DEFAULT NULL,
  `nurse_dx9_txt` text,
  `nurse_dx10` varchar(255) DEFAULT NULL,
  `imp1` varchar(255) DEFAULT NULL,
  `imp2` varchar(255) DEFAULT NULL,
  `imp2_txt` text,
  `imp3` varchar(255) DEFAULT NULL,
  `imp4` varchar(255) DEFAULT NULL,
  `imp5` varchar(255) DEFAULT NULL,
  `imp6` varchar(255) DEFAULT NULL,
  `imp6_txt` text,
  `imp7` varchar(255) DEFAULT NULL,
  `imp8` varchar(255) DEFAULT NULL,
  `imp9` varchar(255) DEFAULT NULL,
  `imp10` varchar(255) DEFAULT NULL,
  `imp11` varchar(255) DEFAULT NULL,
  `imp12` varchar(255) DEFAULT NULL,
  `imp13_txt` text,
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
  `eva11` varchar(255) DEFAULT NULL,
  `eva11_txt` text,
  `eva12` varchar(255) DEFAULT NULL,
  `eva13` varchar(255) DEFAULT NULL,
  `eva14` varchar(255) DEFAULT NULL,
  `eva15` varchar(255) DEFAULT NULL,
  `eva16` varchar(255) DEFAULT NULL,
  `eva17` varchar(255) DEFAULT NULL,
  `eva18` varchar(255) DEFAULT NULL,
  `officer` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `thdatehn` (`thdatehn`),
  KEY `opd` (`opd`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=7258 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ptright
-- ----------------------------
DROP TABLE IF EXISTS `ptright`;
CREATE TABLE `ptright` (
  `code` varchar(3) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `status` varchar(1) NOT NULL,
  `chk_up` varchar(1) NOT NULL,
  `opd` varchar(1) NOT NULL,
  `pay` varchar(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ptrightdetail
-- ----------------------------
DROP TABLE IF EXISTS `ptrightdetail`;
CREATE TABLE `ptrightdetail` (
  `code` varchar(5) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `sort` varchar(5) DEFAULT NULL,
  KEY `detail` (`detail`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for qr_drugs
-- ----------------------------
DROP TABLE IF EXISTS `qr_drugs`;
CREATE TABLE `qr_drugs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `drug_code` varchar(50) DEFAULT NULL,
  `qr_pic_id` int(11) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  `pic_parth` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=96 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for qr_pics
-- ----------------------------
DROP TABLE IF EXISTS `qr_pics`;
CREATE TABLE `qr_pics` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) DEFAULT NULL,
  `parth` varchar(255) DEFAULT NULL,
  `status` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=35 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for queue_chanel
-- ----------------------------
DROP TABLE IF EXISTS `queue_chanel`;
CREATE TABLE `queue_chanel` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for queue_clinic
-- ----------------------------
DROP TABLE IF EXISTS `queue_clinic`;
CREATE TABLE `queue_clinic` (
  `code` varchar(2) NOT NULL,
  `detail` varchar(100) NOT NULL,
  `status` varchar(1) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for queue_doctor
-- ----------------------------
DROP TABLE IF EXISTS `queue_doctor`;
CREATE TABLE `queue_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_date` date DEFAULT NULL,
  `hn` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `vn` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ptname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ptright` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `patient_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `typename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `queue_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `roomname` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `queue_room` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `queue_no` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `queue_room_new` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `queue_no_new` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `staff_opd` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `staff_date` datetime NOT NULL,
  `call_status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `call_room` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_fontroom` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call_date` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `queue_room` (`queue_room`)
) ENGINE=MyISAM AUTO_INCREMENT=130762 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

-- ----------------------------
-- Table structure for queue_doctor_today
-- ----------------------------
DROP TABLE IF EXISTS `queue_doctor_today`;
CREATE TABLE `queue_doctor_today` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `register_date` date NOT NULL,
  `doctor_range` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `doctor_time` time NOT NULL,
  `doctor_room` int(6) NOT NULL,
  `doctor_name` int(6) NOT NULL,
  `staff_opd` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `staff_date` datetime NOT NULL,
  `staff_opd_edit` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `staff_date_edit` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=7117 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

-- ----------------------------
-- Table structure for queue_er
-- ----------------------------
DROP TABLE IF EXISTS `queue_er`;
CREATE TABLE `queue_er` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_date` date DEFAULT NULL,
  `register_time` varchar(10) NOT NULL,
  `hn` varchar(20) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `vn` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ptname` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(20) DEFAULT NULL,
  `ptright` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `typecolor` varchar(20) DEFAULT NULL,
  `typename` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `queue_type` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `queue_no` varchar(15) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_medical` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `staff_date` datetime NOT NULL,
  `call_status` varchar(1) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `call_chanel` varchar(10) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `chanel_status` varchar(50) DEFAULT NULL,
  `staff_opd` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `call_date` datetime NOT NULL,
  `doctor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2647 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for queue_marquee
-- ----------------------------
DROP TABLE IF EXISTS `queue_marquee`;
CREATE TABLE `queue_marquee` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for queue_opd
-- ----------------------------
DROP TABLE IF EXISTS `queue_opd`;
CREATE TABLE `queue_opd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `register_date` date DEFAULT NULL,
  `hn` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `vn` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ptname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ptright` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `typename` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `queue_type` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `queue_no` varchar(15) COLLATE utf8_unicode_ci DEFAULT NULL,
  `staff_medical` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `staff_date` datetime NOT NULL,
  `call_status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `call_chanel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `staff_opd` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `call_date` datetime NOT NULL,
  `doctor_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=83385 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

-- ----------------------------
-- Table structure for queue_room
-- ----------------------------
DROP TABLE IF EXISTS `queue_room`;
CREATE TABLE `queue_room` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `code_walkin` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `code_followup` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `detail` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `doctor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor1` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

-- ----------------------------
-- Table structure for queue_runno
-- ----------------------------
DROP TABLE IF EXISTS `queue_runno`;
CREATE TABLE `queue_runno` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `title` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `prefix` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `runno` int(11) DEFAULT NULL,
  `startdate` date NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=61 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for queue_type
-- ----------------------------
DROP TABLE IF EXISTS `queue_type`;
CREATE TABLE `queue_type` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

-- ----------------------------
-- Table structure for queue_type_er
-- ----------------------------
DROP TABLE IF EXISTS `queue_type_er`;
CREATE TABLE `queue_type_er` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `code` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `color` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=14 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

-- ----------------------------
-- Table structure for race
-- ----------------------------
DROP TABLE IF EXISTS `race`;
CREATE TABLE `race` (
  `code` varchar(3) NOT NULL,
  `detail` varchar(50) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rdu_diag
-- ----------------------------
DROP TABLE IF EXISTS `rdu_diag`;
CREATE TABLE `rdu_diag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `diag_id` bigint(20) DEFAULT NULL,
  `svdate` varchar(50) DEFAULT NULL,
  `hn` varchar(20) DEFAULT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `age` varchar(50) DEFAULT NULL,
  `an` varchar(20) DEFAULT NULL,
  `diag` text,
  `icd10` varchar(10) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `date_hn` varchar(100) DEFAULT NULL,
  `date_generate` datetime DEFAULT NULL,
  `quarter` tinyint(4) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `date_en` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_hn` (`date_hn`),
  KEY `hn` (`hn`),
  KEY `icd10` (`icd10`),
  KEY `type` (`type`),
  KEY `date_en` (`date_en`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=1472598 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rdu_drugrx
-- ----------------------------
DROP TABLE IF EXISTS `rdu_drugrx`;
CREATE TABLE `rdu_drugrx` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `row_id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `hn` varchar(255) CHARACTER SET utf8 NOT NULL,
  `drugcode` varchar(255) CHARACTER SET utf8 NOT NULL,
  `part` varchar(255) CHARACTER SET utf8 NOT NULL,
  `amount` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_hn` varchar(255) CHARACTER SET utf8 NOT NULL,
  `date_generate` datetime NOT NULL,
  `quarter` tinyint(1) NOT NULL,
  `year` varchar(4) CHARACTER SET utf8 NOT NULL,
  `date_en` varchar(10) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_hn` (`date_hn`) USING BTREE,
  KEY `hn` (`hn`),
  KEY `drugcode` (`drugcode`),
  KEY `date_en` (`date_en`),
  KEY `part` (`part`)
) ENGINE=InnoDB AUTO_INCREMENT=1293816 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for rdu_form6
-- ----------------------------
DROP TABLE IF EXISTS `rdu_form6`;
CREATE TABLE `rdu_form6` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `dateHn` varchar(255) DEFAULT NULL,
  `icd10` varchar(255) DEFAULT NULL,
  `drugcode` varchar(255) DEFAULT NULL,
  `in1_1` varchar(255) DEFAULT NULL,
  `in1_2` varchar(255) DEFAULT NULL,
  `in1_3` varchar(255) DEFAULT NULL,
  `in1_4` varchar(255) DEFAULT NULL,
  `in2_1` varchar(255) DEFAULT NULL,
  `in2_2` varchar(255) DEFAULT NULL,
  `in2_3` varchar(255) DEFAULT NULL,
  `in3_1` varchar(255) DEFAULT NULL,
  `in3_2` varchar(255) DEFAULT NULL,
  `in4_1` varchar(255) DEFAULT NULL,
  `in4_2` varchar(255) DEFAULT NULL,
  `noChoise` varchar(255) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `dateHn` (`dateHn`),
  KEY `drugcode` (`drugcode`),
  KEY `hn` (`hn`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rdu_lab
-- ----------------------------
DROP TABLE IF EXISTS `rdu_lab`;
CREATE TABLE `rdu_lab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `autonumber` int(11) NOT NULL,
  `orderdate` datetime NOT NULL,
  `hn` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) DEFAULT NULL,
  `egfr` varchar(255) NOT NULL,
  `date_hn` varchar(255) NOT NULL,
  `quarter` tinyint(1) NOT NULL,
  `year` varchar(4) NOT NULL,
  `date_en` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_hn` (`date_hn`) USING BTREE,
  KEY `hn` (`hn`),
  KEY `date_en` (`date_en`)
) ENGINE=InnoDB AUTO_INCREMENT=81710 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rdu_opday
-- ----------------------------
DROP TABLE IF EXISTS `rdu_opday`;
CREATE TABLE `rdu_opday` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `row_id` bigint(20) NOT NULL,
  `date` datetime NOT NULL,
  `hn` varchar(255) NOT NULL,
  `ptname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `diag` varchar(255) NOT NULL,
  `icd10` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `toborow` varchar(50) DEFAULT NULL,
  `date_hn` varchar(255) NOT NULL,
  `date_generate` datetime NOT NULL,
  `quarter` tinyint(1) NOT NULL,
  `year` varchar(4) NOT NULL,
  `date_en` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_hn` (`date_hn`) USING BTREE,
  KEY `hn` (`hn`),
  KEY `date_en` (`date_en`)
) ENGINE=InnoDB AUTO_INCREMENT=565988 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rdu_trauma
-- ----------------------------
DROP TABLE IF EXISTS `rdu_trauma`;
CREATE TABLE `rdu_trauma` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `trauma_id` int(11) NOT NULL,
  `date` varchar(50) DEFAULT NULL,
  `hn` varchar(50) DEFAULT NULL,
  `ptright` varchar(10) DEFAULT NULL,
  `dx` longtext,
  `organ` longtext,
  `maintenance` longtext,
  `cure` varchar(30) DEFAULT NULL,
  `doctor` varchar(50) DEFAULT NULL,
  `trauma` varchar(10) DEFAULT NULL,
  `type_wounded` varchar(10) DEFAULT NULL,
  `type_wounded2` varchar(10) DEFAULT NULL,
  `date_hn` varchar(50) DEFAULT NULL,
  `quarter` tinyint(4) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `date_en` varchar(10) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `date_hn` (`date_hn`),
  KEY `hn` (`hn`),
  KEY `date_en` (`date_en`)
) ENGINE=InnoDB AUTO_INCREMENT=65388 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for receipt
-- ----------------------------
DROP TABLE IF EXISTS `receipt`;
CREATE TABLE `receipt` (
  `row_receipt` int(11) NOT NULL AUTO_INCREMENT,
  `type_receipt` varchar(10) NOT NULL,
  `ref_type` varchar(50) NOT NULL,
  `billno` varchar(20) NOT NULL,
  `no_cheque` varchar(20) NOT NULL,
  `bank` varchar(100) NOT NULL,
  `from_name` varchar(256) DEFAULT NULL,
  `hn` varchar(20) NOT NULL,
  `an` varchar(20) NOT NULL,
  `type_pay` varchar(20) NOT NULL,
  `company` varchar(50) NOT NULL,
  `sing_name` varchar(100) NOT NULL,
  `thidate` varchar(50) NOT NULL,
  `indate` varchar(20) NOT NULL,
  `dcdate` varchar(20) NOT NULL,
  `sumtotal` varchar(20) NOT NULL,
  `diag` varchar(100) NOT NULL,
  PRIMARY KEY (`row_receipt`)
) ENGINE=MyISAM AUTO_INCREMENT=9898 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for refer
-- ----------------------------
DROP TABLE IF EXISTS `refer`;
CREATE TABLE `refer` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) DEFAULT NULL,
  `an` varchar(10) DEFAULT NULL,
  `clinic` varchar(20) DEFAULT NULL,
  `referh` varchar(20) DEFAULT NULL,
  `refertype` varchar(10) DEFAULT NULL,
  `dateopd` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `name` varchar(20) DEFAULT NULL,
  `sname` varchar(20) DEFAULT NULL,
  `idcard` varchar(15) DEFAULT NULL,
  `pttype` varchar(10) DEFAULT NULL,
  `diag` varchar(100) DEFAULT NULL,
  `ptnote` varchar(100) DEFAULT NULL,
  `exrefer` varchar(100) DEFAULT NULL,
  `refercar` varchar(20) DEFAULT NULL,
  `office` varchar(20) DEFAULT NULL,
  `doctor` varchar(30) DEFAULT NULL,
  `ward` varchar(10) NOT NULL,
  `trauma_id` int(3) NOT NULL,
  `age` varchar(15) NOT NULL,
  `type_wound` varchar(4) NOT NULL,
  `time_refer` varchar(30) DEFAULT NULL,
  `problem_refer` text NOT NULL,
  `list_type_patient` varchar(20) NOT NULL,
  `follow_refer` text NOT NULL,
  `organ` text NOT NULL,
  `maintenance` text NOT NULL,
  `doc_refer` varchar(1) NOT NULL,
  `nurse` varchar(1) NOT NULL,
  `assistant_nurse` varchar(1) NOT NULL,
  `estimate` varchar(1) NOT NULL,
  `no_estimate` varchar(5) NOT NULL,
  `cradle` varchar(1) NOT NULL,
  `doc_txt` varchar(1) NOT NULL,
  `suggestion` varchar(1) NOT NULL,
  `officer` varchar(30) NOT NULL,
  `refer_runno` varchar(10) NOT NULL,
  `target_refer` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=7900 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for refer_mi
-- ----------------------------
DROP TABLE IF EXISTS `refer_mi`;
CREATE TABLE `refer_mi` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `refer_no` varchar(50) NOT NULL,
  `refer_date` varchar(50) NOT NULL,
  `refer_from` varchar(100) NOT NULL,
  `refer_to` varchar(100) NOT NULL,
  `hn` varchar(30) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `sex` varchar(20) NOT NULL,
  `age` varchar(50) NOT NULL,
  `mark` varchar(50) NOT NULL,
  `camp` varchar(70) NOT NULL,
  `address` varchar(50) NOT NULL,
  `street` varchar(50) NOT NULL,
  `amphur` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `location` varchar(100) NOT NULL,
  `for` varchar(30) NOT NULL,
  `history1` text NOT NULL,
  `history2` text NOT NULL,
  `result` text NOT NULL,
  `diag` tinyint(4) NOT NULL,
  `treatment` text NOT NULL,
  `cause` text NOT NULL,
  `otherdetail` text NOT NULL,
  `infection` varchar(50) NOT NULL,
  `sign` varchar(100) NOT NULL,
  `register_date` varchar(20) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for religion
-- ----------------------------
DROP TABLE IF EXISTS `religion`;
CREATE TABLE `religion` (
  `code` int(2) unsigned zerofill NOT NULL DEFAULT '00',
  `detail` varchar(50) NOT NULL,
  `detail2` varchar(50) NOT NULL,
  PRIMARY KEY (`code`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for resultdetail
-- ----------------------------
DROP TABLE IF EXISTS `resultdetail`;
CREATE TABLE `resultdetail` (
  `autonumber` int(10) NOT NULL,
  `labcode` varchar(15) NOT NULL,
  `labname` varchar(120) NOT NULL,
  `result` varchar(50) DEFAULT NULL,
  `unit` varchar(10) NOT NULL,
  `normalrange` varchar(20) DEFAULT NULL,
  `flag` varchar(10) NOT NULL,
  `parentcode` varchar(10) NOT NULL,
  `parentname` varchar(60) NOT NULL,
  `specimencode` varchar(10) NOT NULL,
  `specimenname` varchar(60) NOT NULL,
  `releaseby` varchar(10) NOT NULL,
  `releasename` varchar(60) NOT NULL,
  `authoriseby` varchar(10) NOT NULL,
  `authorisename` varchar(60) NOT NULL,
  `authorisedate` varchar(30) DEFAULT NULL,
  `seq` int(11) NOT NULL,
  KEY `autonumber` (`autonumber`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for resultdetails
-- ----------------------------
DROP TABLE IF EXISTS `resultdetails`;
CREATE TABLE `resultdetails` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for resulthead
-- ----------------------------
DROP TABLE IF EXISTS `resulthead`;
CREATE TABLE `resulthead` (
  `autonumber` int(10) NOT NULL AUTO_INCREMENT,
  `orderdate` varchar(30) DEFAULT NULL,
  `labnumber` varchar(15) NOT NULL,
  `hn` varchar(12) NOT NULL,
  `patientname` varchar(60) NOT NULL,
  `sex` varchar(1) NOT NULL,
  `dob` varchar(30) DEFAULT NULL,
  `sourcecode` varchar(5) NOT NULL,
  `sourcename` varchar(20) NOT NULL,
  `cliniciancode` varchar(40) NOT NULL,
  `clinicianname` varchar(40) NOT NULL,
  `priority` varchar(1) NOT NULL,
  `clinicalinfo` varchar(100) NOT NULL,
  `testtype` varchar(1) NOT NULL,
  `profilecode` varchar(10) NOT NULL,
  `testgroupcode` varchar(10) NOT NULL,
  `testgroupname` varchar(40) NOT NULL,
  `checkindate` varchar(30) DEFAULT NULL,
  `comment` text NOT NULL,
  PRIMARY KEY (`autonumber`),
  KEY `hn` (`hn`),
  KEY `cliniciancode` (`cliniciancode`),
  KEY `orderdate` (`orderdate`),
  KEY `labnumber` (`labnumber`)
) ENGINE=MyISAM AUTO_INCREMENT=10341040 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for resultheads
-- ----------------------------
DROP TABLE IF EXISTS `resultheads`;
CREATE TABLE `resultheads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for rg_doctor
-- ----------------------------
DROP TABLE IF EXISTS `rg_doctor`;
CREATE TABLE `rg_doctor` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `soldier_id` int(11) DEFAULT NULL,
  `yot` varchar(50) DEFAULT NULL,
  `doctor` varchar(255) DEFAULT NULL,
  `code` varchar(55) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `soldier_id` (`soldier_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for rg_soldier
-- ----------------------------
DROP TABLE IF EXISTS `rg_soldier`;
CREATE TABLE `rg_soldier` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime DEFAULT NULL,
  `hn` varchar(45) DEFAULT NULL,
  `address` text,
  `regular_number` text,
  `regular` text,
  `last_update` datetime DEFAULT NULL,
  `yot_pt` varchar(50) NOT NULL,
  `ptname` varchar(255) DEFAULT NULL,
  `yearchk` varchar(45) DEFAULT NULL,
  `idcard_img` varchar(255) DEFAULT NULL,
  `pic_patient` varchar(255) DEFAULT NULL,
  `book_id` varchar(50) NOT NULL,
  `number_id` varchar(50) NOT NULL,
  `yot1` varchar(50) NOT NULL,
  `doctor1` varchar(255) NOT NULL,
  `code1` varchar(50) NOT NULL,
  `yot2` varchar(50) NOT NULL,
  `doctor2` varchar(255) NOT NULL,
  `code2` varchar(50) NOT NULL,
  `yot3` varchar(50) NOT NULL,
  `doctor3` varchar(255) NOT NULL,
  `code3` varchar(50) NOT NULL,
  `diag` text NOT NULL,
  `province` varchar(255) NOT NULL,
  `editor` varchar(255) NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `date_certificate` date NOT NULL,
  `amed_stat` varchar(255) DEFAULT NULL,
  `print_status` varchar(1) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=693 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for runno
-- ----------------------------
DROP TABLE IF EXISTS `runno`;
CREATE TABLE `runno` (
  `title` char(10) DEFAULT NULL,
  `prefix` char(5) DEFAULT NULL,
  `runno` int(11) DEFAULT NULL,
  `startday` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for runno_copy
-- ----------------------------
DROP TABLE IF EXISTS `runno_copy`;
CREATE TABLE `runno_copy` (
  `title` char(10) DEFAULT NULL,
  `prefix` char(5) DEFAULT NULL,
  `runno` int(11) DEFAULT NULL,
  `startday` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for runno_copy1
-- ----------------------------
DROP TABLE IF EXISTS `runno_copy1`;
CREATE TABLE `runno_copy1` (
  `title` char(10) DEFAULT NULL,
  `prefix` char(5) DEFAULT NULL,
  `runno` int(11) DEFAULT NULL,
  `startday` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for runno_token
-- ----------------------------
DROP TABLE IF EXISTS `runno_token`;
CREATE TABLE `runno_token` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cid` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `token` varchar(255) DEFAULT NULL,
  `update_datetime` varchar(255) DEFAULT NULL,
  `is_invalid` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for screen_cvdrisk
-- ----------------------------
DROP TABLE IF EXISTS `screen_cvdrisk`;
CREATE TABLE `screen_cvdrisk` (
  `row_id` int(6) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ptname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `date_active` date NOT NULL,
  `officer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  `cvrisk_score` double(5,2) NOT NULL,
  `cvrisk_area` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB AUTO_INCREMENT=707 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ข้อมูลการประเมินโอกาสเสี่ยงต่อการเกิดโรคหัวใจและหัวใจ';

-- ----------------------------
-- Table structure for screen_dm
-- ----------------------------
DROP TABLE IF EXISTS `screen_dm`;
CREATE TABLE `screen_dm` (
  `row_id` int(6) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `date_active` date NOT NULL,
  `officer` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for screen_ht
-- ----------------------------
DROP TABLE IF EXISTS `screen_ht`;
CREATE TABLE `screen_ht` (
  `row_id` int(6) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `age` varchar(100) NOT NULL,
  `date_active` date NOT NULL,
  `officer` varchar(100) NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for serviel
-- ----------------------------
DROP TABLE IF EXISTS `serviel`;
CREATE TABLE `serviel` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `pcucode` varchar(5) NOT NULL,
  `cid` varchar(15) NOT NULL,
  `hn` varchar(15) NOT NULL,
  `seq` varchar(15) NOT NULL,
  `date_serv` varchar(20) NOT NULL,
  `diagcode` varchar(20) NOT NULL,
  `code506` varchar(20) NOT NULL,
  `illdate` varchar(20) NOT NULL,
  `illhouse` varchar(100) NOT NULL,
  `illvill` varchar(50) NOT NULL,
  `illtamb` varchar(50) NOT NULL,
  `illampu` varchar(50) NOT NULL,
  `illchan` varchar(50) NOT NULL,
  `ptstat` varchar(10) NOT NULL,
  `date_death` varchar(15) NOT NULL,
  `complica` varchar(20) NOT NULL,
  `organism` varchar(20) NOT NULL,
  `d_update` varchar(15) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for set_or
-- ----------------------------
DROP TABLE IF EXISTS `set_or`;
CREATE TABLE `set_or` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `ward` varchar(20) NOT NULL,
  `hn` varchar(20) NOT NULL,
  `an` varchar(20) NOT NULL,
  `ptname` varchar(50) NOT NULL,
  `age` varchar(50) NOT NULL,
  `ptright` varchar(50) NOT NULL,
  `diag` varchar(100) NOT NULL,
  `surg` varchar(100) NOT NULL,
  `doctor` varchar(50) NOT NULL,
  `inhalation_type` varchar(50) NOT NULL,
  `date_surg` varchar(50) NOT NULL,
  `time` varchar(20) NOT NULL,
  `officer` varchar(50) NOT NULL,
  `comment` text NOT NULL,
  `status` varchar(2) NOT NULL,
  `lastupdate` varchar(30) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `an` (`an`),
  KEY `doctor` (`doctor`)
) ENGINE=MyISAM AUTO_INCREMENT=6578 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for soundpha
-- ----------------------------
DROP TABLE IF EXISTS `soundpha`;
CREATE TABLE `soundpha` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `kew` varchar(5) NOT NULL,
  `status` varchar(1) NOT NULL,
  `hn` varchar(15) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=454404 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sso_checkup
-- ----------------------------
DROP TABLE IF EXISTS `sso_checkup`;
CREATE TABLE `sso_checkup` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `code` varchar(45) DEFAULT NULL,
  `code_lab` varchar(255) DEFAULT NULL,
  `detail` varchar(255) DEFAULT NULL,
  `onetime` int(11) DEFAULT NULL,
  `frequence` int(11) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `yprice` double(10,2) DEFAULT NULL,
  `nprice` double(10,2) DEFAULT NULL,
  `age_year` year(4) DEFAULT NULL,
  `age_min` int(11) DEFAULT NULL,
  `age_max` int(11) DEFAULT NULL,
  `special` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for sso30
-- ----------------------------
DROP TABLE IF EXISTS `sso30`;
CREATE TABLE `sso30` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `idcard` varchar(13) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `surname` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `date_start` date NOT NULL,
  `date_expire` date NOT NULL,
  PRIMARY KEY (`id`),
  KEY `idcard` (`idcard`)
) ENGINE=MyISAM AUTO_INCREMENT=6105 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ssodata
-- ----------------------------
DROP TABLE IF EXISTS `ssodata`;
CREATE TABLE `ssodata` (
  `id` varchar(255) NOT NULL,
  `textname` varchar(255) NOT NULL,
  `lastupdate` varchar(30) DEFAULT '0000-00-00 00:00:00'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for staf_massage
-- ----------------------------
DROP TABLE IF EXISTS `staf_massage`;
CREATE TABLE `staf_massage` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(70) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(11) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for stat_cscd
-- ----------------------------
DROP TABLE IF EXISTS `stat_cscd`;
CREATE TABLE `stat_cscd` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `stat` varchar(50) NOT NULL,
  `station` varchar(50) NOT NULL,
  `line` varchar(50) NOT NULL,
  `authcode` varchar(50) NOT NULL,
  `dttran` varchar(50) NOT NULL,
  `invno` varchar(50) DEFAULT NULL,
  `billno` varchar(50) DEFAULT NULL,
  `hn` varchar(50) NOT NULL,
  `memberno` varchar(50) NOT NULL,
  `claimamt` double(10,2) NOT NULL,
  `chkcode` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=26 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for stat_sso
-- ----------------------------
DROP TABLE IF EXISTS `stat_sso`;
CREATE TABLE `stat_sso` (
  `row_id` int(6) NOT NULL AUTO_INCREMENT,
  `stat` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `station` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `hcode` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hmain` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `authcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `dttran` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `invno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `idcard` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bp` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `claimamt` double(10,2) NOT NULL,
  `paid` double(10,2) NOT NULL,
  `chkcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=504 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for stiker_prepack
-- ----------------------------
DROP TABLE IF EXISTS `stiker_prepack`;
CREATE TABLE `stiker_prepack` (
  `prepack_id` int(5) NOT NULL DEFAULT '0',
  `drugcode` varchar(10) NOT NULL DEFAULT '',
  `total` varchar(7) NOT NULL DEFAULT '',
  `lot` varchar(7) NOT NULL DEFAULT '',
  `startdate` varchar(11) NOT NULL DEFAULT '',
  `enddate` varchar(11) NOT NULL DEFAULT '',
  PRIMARY KEY (`prepack_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for stkbill
-- ----------------------------
DROP TABLE IF EXISTS `stkbill`;
CREATE TABLE `stkbill` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `chktranx` int(11) DEFAULT NULL,
  `date` varchar(30) DEFAULT NULL,
  `depcode` varchar(40) DEFAULT NULL,
  `billno` varchar(10) DEFAULT NULL,
  `item` int(4) DEFAULT NULL,
  `price` double(12,2) DEFAULT NULL,
  `idname` varchar(32) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=1447 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for stkdata
-- ----------------------------
DROP TABLE IF EXISTS `stkdata`;
CREATE TABLE `stkdata` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `billno` varchar(50) DEFAULT NULL,
  `depcode` varchar(100) DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `amount` int(6) DEFAULT NULL,
  `price` double(10,2) DEFAULT NULL,
  `part` varchar(5) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  KEY `date` (`date`)
) ENGINE=MyISAM AUTO_INCREMENT=162773 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for stkprepack
-- ----------------------------
DROP TABLE IF EXISTS `stkprepack`;
CREATE TABLE `stkprepack` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(20) NOT NULL,
  `drugcode` varchar(100) NOT NULL,
  `tradname` varchar(100) NOT NULL,
  `mftdate` varchar(20) NOT NULL,
  `expdate` varchar(20) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `pack` varchar(20) NOT NULL,
  `datecut` varchar(20) NOT NULL,
  `expcut` varchar(20) NOT NULL,
  `lotno` varchar(20) NOT NULL,
  `officer` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=94 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for stktranx
-- ----------------------------
DROP TABLE IF EXISTS `stktranx`;
CREATE TABLE `stktranx` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `expdate` date DEFAULT NULL,
  `lotno` varchar(12) DEFAULT NULL,
  `stkcut` int(10) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `officer` varchar(32) DEFAULT NULL,
  `billno` varchar(50) DEFAULT NULL,
  `department` varchar(40) DEFAULT NULL,
  `unitpri` double(10,4) DEFAULT NULL,
  `amount` int(8) DEFAULT '0',
  `netlotno` int(8) NOT NULL DEFAULT '0',
  `getdate` date DEFAULT NULL,
  `mainstk` int(8) DEFAULT NULL,
  `stock` int(8) NOT NULL DEFAULT '0',
  `totalstk` int(8) DEFAULT NULL,
  `amountfree` int(8) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  `active` varchar(1) NOT NULL,
  `grouptype` varchar(5) NOT NULL,
  `pack` varchar(30) NOT NULL,
  `actual_date` datetime NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=578347 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for stktranx_pt
-- ----------------------------
DROP TABLE IF EXISTS `stktranx_pt`;
CREATE TABLE `stktranx_pt` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` date DEFAULT NULL,
  `drugcode` varchar(10) DEFAULT NULL,
  `tradname` varchar(40) DEFAULT NULL,
  `expdate` date DEFAULT NULL,
  `lotno` varchar(12) DEFAULT NULL,
  `stkcut` int(10) DEFAULT NULL,
  `unit` varchar(10) DEFAULT NULL,
  `officer` varchar(32) DEFAULT NULL,
  `billno` varchar(12) DEFAULT NULL,
  `department` varchar(40) DEFAULT NULL,
  `unitpri` double(10,2) DEFAULT NULL,
  `amount` int(8) DEFAULT NULL,
  `netlotno` int(8) NOT NULL DEFAULT '0',
  `getdate` date DEFAULT NULL,
  `mainstk` int(8) DEFAULT NULL,
  `stock` int(8) NOT NULL DEFAULT '0',
  `totalstk` int(8) DEFAULT NULL,
  `amountfree` int(8) NOT NULL,
  `status` varchar(1) NOT NULL DEFAULT 'Y',
  PRIMARY KEY (`row_id`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for stm_cscd
-- ----------------------------
DROP TABLE IF EXISTS `stm_cscd`;
CREATE TABLE `stm_cscd` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `invno` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `dttran` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `amount` double(10,2) NOT NULL,
  `paid` int(5) NOT NULL,
  `extp` int(5) NOT NULL,
  `code` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `rid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `stm_no` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `date_active` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=293022 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for surgery_set
-- ----------------------------
DROP TABLE IF EXISTS `surgery_set`;
CREATE TABLE `surgery_set` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` datetime NOT NULL,
  `hn` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `an` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `ptname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `age` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `sex` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ptright` varchar(30) COLLATE utf8_unicode_ci NOT NULL,
  `weight` double(5,1) NOT NULL,
  `height` double(5,1) NOT NULL,
  `bmi` double(5,2) NOT NULL,
  `diag` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `operation` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `inhalation_ga` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inhalation_sa` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inhalation_bb` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inhalation_iva` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inhalation_la` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inhalation_ta` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inhalation_other` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `inhalation_detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `doctor` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `ward` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_surg` date NOT NULL,
  `surgery_time` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `date_npotime` date NOT NULL,
  `npo_time` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `surgery_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `consent` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `glascow_coma_scal_e` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `glascow_coma_scal_v` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `glascow_coma_scal_m` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `respire` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `disease` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_ht` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_dm` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_dlp` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_asthma` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_copd` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_kidney` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_cad` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_cad_echo` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_cad_detail` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `disease_thyroid` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_thyroid_ft3` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `disease_thyroid_ft4` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `disease_thyroid_tsh` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ft3_detail` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `ft4_detail` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `tsh_detail` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `disease_other` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `disease_other_detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `xray_cxr` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `xray_kub` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `xray_mri` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `xray_ct` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `xray_film_ortho` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `ct_detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `film_ortho_detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `booking_blood` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `blood_group` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `blood_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `prc_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ffp_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `wb_unit` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `other_detail` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `blood` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `drugreact` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `drugreact_opcard` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `consultmed` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `premed` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `premed_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `antiplatelet` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `antiplatelet_drug` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `withhold` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `holdtime` date NOT NULL,
  `booking_icu` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `untrasound` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `xray_c_arm` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `detail` text COLLATE utf8_unicode_ci NOT NULL,
  `status` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `active` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `officer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `officer_update` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  `officer_surgery` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `approve_date` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=InnoDB AUTO_INCREMENT=409 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci COMMENT='ตารางข้อมูลการเซตผ่าตัด';

-- ----------------------------
-- Table structure for survey_nofat
-- ----------------------------
DROP TABLE IF EXISTS `survey_nofat`;
CREATE TABLE `survey_nofat` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `idcard` varchar(20) DEFAULT NULL,
  `hn` varchar(20) NOT NULL,
  `ptname` varchar(100) NOT NULL,
  `bdate` varchar(20) NOT NULL,
  `age` varchar(100) DEFAULT NULL,
  `father` varchar(50) NOT NULL,
  `addwork1` varchar(100) NOT NULL,
  `tell1` varchar(20) NOT NULL,
  `phone1` varchar(20) NOT NULL,
  `mother` varchar(100) NOT NULL,
  `phone2` varchar(20) NOT NULL,
  `number` varchar(50) DEFAULT NULL,
  `street` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `amphur` varchar(50) NOT NULL,
  `province` varchar(50) NOT NULL,
  `weight` varchar(20) NOT NULL,
  `height` varchar(20) NOT NULL,
  `waistline` varchar(20) NOT NULL,
  `bmi` varchar(20) NOT NULL,
  `bp` varchar(20) NOT NULL,
  `diag` varchar(100) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for survey_oral
-- ----------------------------
DROP TABLE IF EXISTS `survey_oral`;
CREATE TABLE `survey_oral` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `section` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `etc` text NOT NULL,
  `den_health` varchar(5) DEFAULT NULL,
  `officer` varchar(255) NOT NULL,
  `mouth_detail` text NOT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `max_status` varchar(5) NOT NULL DEFAULT '0',
  `add_by` varchar(255) DEFAULT NULL,
  `yearcheck` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `yearcheck` (`yearcheck`)
) ENGINE=MyISAM AUTO_INCREMENT=4437 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for survey_oral_category
-- ----------------------------
DROP TABLE IF EXISTS `survey_oral_category`;
CREATE TABLE `survey_oral_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=93 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for survey_oral_patient
-- ----------------------------
DROP TABLE IF EXISTS `survey_oral_patient`;
CREATE TABLE `survey_oral_patient` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `section` varchar(255) NOT NULL,
  `fullname` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `id_card` varchar(255) NOT NULL,
  `etc` text NOT NULL,
  `den_health` varchar(5) DEFAULT NULL,
  `officer` varchar(255) NOT NULL,
  `mouth_detail` text NOT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '0',
  `max_status` varchar(5) NOT NULL DEFAULT '0',
  `add_by` varchar(255) DEFAULT NULL,
  `yearcheck` varchar(2) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `yearcheck` (`yearcheck`)
) ENGINE=MyISAM AUTO_INCREMENT=106 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for survey_oral_patient_category
-- ----------------------------
DROP TABLE IF EXISTS `survey_oral_patient_category`;
CREATE TABLE `survey_oral_patient_category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime DEFAULT NULL,
  KEY `id` (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tambon
-- ----------------------------
DROP TABLE IF EXISTS `tambon`;
CREATE TABLE `tambon` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `lgo_code` varchar(255) DEFAULT NULL,
  `lgo_name` varchar(255) DEFAULT NULL,
  `amphur` varchar(255) DEFAULT NULL,
  `province` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `province` (`province`),
  KEY `amphur` (`amphur`),
  KEY `lgo_name` (`lgo_name`)
) ENGINE=MyISAM AUTO_INCREMENT=8442 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tb_assess
-- ----------------------------
DROP TABLE IF EXISTS `tb_assess`;
CREATE TABLE `tb_assess` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `row_id` varchar(20) DEFAULT NULL,
  `q1` varchar(1) NOT NULL,
  `q2` varchar(1) NOT NULL,
  `q3` varchar(1) NOT NULL,
  `q4` varchar(1) NOT NULL,
  `q5` varchar(1) NOT NULL,
  `q6` varchar(1) NOT NULL,
  `q7` varchar(1) NOT NULL,
  `q8` varchar(1) NOT NULL,
  `q9` varchar(1) NOT NULL,
  `q10` varchar(1) NOT NULL,
  `q11` varchar(1) NOT NULL,
  `q12` varchar(1) NOT NULL,
  `q13` varchar(1) NOT NULL,
  `q14` varchar(1) NOT NULL,
  `q15` varchar(1) NOT NULL,
  `q16` varchar(1) NOT NULL,
  `ip` varchar(15) NOT NULL,
  `date` varchar(20) NOT NULL,
  `com1` varchar(200) NOT NULL,
  `year` varchar(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=306 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tb_community_activity_42
-- ----------------------------
DROP TABLE IF EXISTS `tb_community_activity_42`;
CREATE TABLE `tb_community_activity_42` (
  `ROW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `VID` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_START` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_FINISH` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `COMACTIVITY` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDER` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `D_UPDATE` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ROW_ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tb_community_service_43
-- ----------------------------
DROP TABLE IF EXISTS `tb_community_service_43`;
CREATE TABLE `tb_community_service_43` (
  `ROW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SEQ` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_SERV` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `COMSERVICE` varchar(7) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDER` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `D_UPDATE` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `CID` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ROW_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tb_dental_29
-- ----------------------------
DROP TABLE IF EXISTS `tb_dental_29`;
CREATE TABLE `tb_dental_29` (
  `ROW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SEQ` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_SERV` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `DENTTYPE` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `SERVPLACE` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `PTEETH` int(2) NOT NULL,
  `PCARIES` int(2) NOT NULL,
  `PFILLING` int(2) NOT NULL,
  `PEXTRACT` int(2) NOT NULL,
  `DTEETH` int(2) NOT NULL,
  `DCARIES` int(2) NOT NULL,
  `DFILLING` int(2) NOT NULL,
  `DEXTRACT` int(2) NOT NULL,
  `NEED_FLUORIDE` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `NEED_SCALING` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `NEED_SEALANT` int(2) NOT NULL,
  `NEED_PFILLING` int(2) NOT NULL,
  `NEED_DFILLING` int(2) NOT NULL,
  `NEED_PEXTRACT` int(2) NOT NULL,
  `NEED_DEXTRACT` int(2) NOT NULL,
  `NPROSTHESIS` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `PERMANENT_PERMANENT` int(2) NOT NULL,
  `PERMANENT_PROSTHESIS` int(2) NOT NULL,
  `PROSTHESIS_PROSTHESIS` int(2) NOT NULL,
  `GUM` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `SCHOOLTYPE` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `CLASS` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDER` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `D_UPDATE` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `CID` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ROW_ID`),
  KEY `PID` (`PID`,`DATE_SERV`)
) ENGINE=MyISAM AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tb_fp_32
-- ----------------------------
DROP TABLE IF EXISTS `tb_fp_32`;
CREATE TABLE `tb_fp_32` (
  `ROW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SEQ` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_SERV` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `FPTYPE` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `FPPLACE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDER` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `D_UPDATE` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `CID` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ROW_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tb_functional_12
-- ----------------------------
DROP TABLE IF EXISTS `tb_functional_12`;
CREATE TABLE `tb_functional_12` (
  `ROW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SEQ` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_SERV` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `FUNCTIONAL_TEST` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `TESTRESULT` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `DEPENDENT` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDER` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `D_UPDATE` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `CID` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ROW_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tb_provider_9
-- ----------------------------
DROP TABLE IF EXISTS `tb_provider_9`;
CREATE TABLE `tb_provider_9` (
  `ROW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDER` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `REGISTERNO` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `COUNCIL` varchar(2) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CID` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `PRENAME` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `NAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `LNAME` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `SEX` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `BIRTH` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDERTYPE` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `STARTDATE` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `OUTDATE` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `MOVEFROM` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `MOVETO` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `D_UPDATE` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ROW_ID`),
  KEY `PROVIDER` (`PROVIDER`)
) ENGINE=MyISAM AUTO_INCREMENT=366 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tb_service
-- ----------------------------
DROP TABLE IF EXISTS `tb_service`;
CREATE TABLE `tb_service` (
  `id_s` int(11) NOT NULL AUTO_INCREMENT,
  `date_ser` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hn` varchar(50) CHARACTER SET utf8 DEFAULT NULL,
  `id_vac` int(11) NOT NULL,
  `num` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `unit` int(11) DEFAULT NULL,
  `name_doc` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lotno` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `date_end` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `lotno2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_end2` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `date_insert` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id_s`)
) ENGINE=MyISAM AUTO_INCREMENT=8485 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci PACK_KEYS=0;

-- ----------------------------
-- Table structure for tb_specialpp_41
-- ----------------------------
DROP TABLE IF EXISTS `tb_specialpp_41`;
CREATE TABLE `tb_specialpp_41` (
  `ROW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SEQ` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_SERV` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `SERVPLACE` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `PPSPECIAL` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `PPSPLACE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDER` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `D_UPDATE` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `CID` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ROW_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tb_surveillance_19
-- ----------------------------
DROP TABLE IF EXISTS `tb_surveillance_19`;
CREATE TABLE `tb_surveillance_19` (
  `ROW_ID` int(6) NOT NULL AUTO_INCREMENT,
  `HOSPCODE` varchar(5) COLLATE utf8_unicode_ci NOT NULL,
  `PID` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `SEQ` varchar(16) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_SERV` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `AN` varchar(9) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DATETIME_ADMIT` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `SYNDROME` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `DIAGCODE` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `CODE506` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `DIAGCODELAST` varchar(6) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CODE506LAST` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ILLDATE` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `ILLHOUSE` varchar(75) COLLATE utf8_unicode_ci NOT NULL,
  `ILLVILLAGE` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ILLTAMBON` varchar(4) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ILLAMPUR` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `ILLCHANGWAT` varchar(2) COLLATE utf8_unicode_ci NOT NULL,
  `LATITUDE` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `LONGITUDE` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `PTSTATUS` varchar(1) COLLATE utf8_unicode_ci NOT NULL,
  `DATE_DEATH` varchar(8) COLLATE utf8_unicode_ci NOT NULL,
  `COMPLICATION` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `ORGANISM` varchar(4) COLLATE utf8_unicode_ci NOT NULL,
  `PROVIDER` varchar(15) COLLATE utf8_unicode_ci NOT NULL,
  `D_UPDATE` varchar(14) COLLATE utf8_unicode_ci NOT NULL,
  `CID` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`ROW_ID`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for test
-- ----------------------------
DROP TABLE IF EXISTS `test`;
CREATE TABLE `test` (
  `id` tinyint(4) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for test_images
-- ----------------------------
DROP TABLE IF EXISTS `test_images`;
CREATE TABLE `test_images` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `file` varchar(255) DEFAULT NULL,
  `pdfId` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for test_orderdetail
-- ----------------------------
DROP TABLE IF EXISTS `test_orderdetail`;
CREATE TABLE `test_orderdetail` (
  `labnumber` varchar(15) DEFAULT NULL,
  `labcode` varchar(15) DEFAULT NULL,
  `labcode1` varchar(8) DEFAULT NULL,
  `labname` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for test_orderhead
-- ----------------------------
DROP TABLE IF EXISTS `test_orderhead`;
CREATE TABLE `test_orderhead` (
  `autonumber` int(11) NOT NULL AUTO_INCREMENT,
  `orderdate` varchar(30) DEFAULT NULL,
  `labnumber` varchar(15) DEFAULT NULL,
  `hn` varchar(15) DEFAULT NULL,
  `patienttype` varchar(15) DEFAULT NULL,
  `patientname` varchar(50) DEFAULT NULL,
  `sex` varchar(1) DEFAULT NULL,
  `dob` varchar(30) DEFAULT NULL,
  `sourcecode` varchar(10) DEFAULT NULL,
  `sourcename` varchar(20) DEFAULT NULL,
  `room` varchar(10) DEFAULT NULL,
  `cliniciancode` varchar(10) DEFAULT NULL,
  `clinicianname` varchar(50) DEFAULT NULL,
  `priority` varchar(1) DEFAULT NULL,
  `clinicalinfo` varchar(100) DEFAULT NULL,
  `isquery` int(1) DEFAULT '0',
  PRIMARY KEY (`autonumber`),
  KEY `Labno` (`labnumber`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for test_pdf
-- ----------------------------
DROP TABLE IF EXISTS `test_pdf`;
CREATE TABLE `test_pdf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `dateSave` varchar(255) DEFAULT NULL,
  `dateTM` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `file` varchar(255) DEFAULT NULL,
  `creator` varchar(255) DEFAULT NULL,
  `lastSave` varchar(255) DEFAULT NULL,
  `editor` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for test_runno
-- ----------------------------
DROP TABLE IF EXISTS `test_runno`;
CREATE TABLE `test_runno` (
  `title` char(8) DEFAULT NULL,
  `prefix` char(5) DEFAULT NULL,
  `runno` int(11) DEFAULT NULL,
  `startday` varchar(30) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for test_trauma_inject
-- ----------------------------
DROP TABLE IF EXISTS `test_trauma_inject`;
CREATE TABLE `test_trauma_inject` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `thidate_regis` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `hn` varchar(12) DEFAULT NULL,
  `ptname` varchar(40) DEFAULT NULL,
  `age` varchar(15) DEFAULT NULL,
  `ptright` varchar(40) DEFAULT NULL,
  `TYPE` varchar(2) DEFAULT NULL,
  `drugcode` varchar(20) DEFAULT NULL,
  `tradname` varchar(50) DEFAULT NULL,
  `number` varchar(2) DEFAULT NULL,
  `opd` tinyint(4) DEFAULT NULL,
  `toborow` varchar(255) DEFAULT NULL,
  `status_c19` varchar(5) DEFAULT NULL,
  `countdown_c19` datetime DEFAULT NULL,
  `ldlc` varchar(50) DEFAULT NULL,
  `ldl` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=41 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for testmatch
-- ----------------------------
DROP TABLE IF EXISTS `testmatch`;
CREATE TABLE `testmatch` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(255) NOT NULL,
  `age` varchar(10) NOT NULL,
  `company` varchar(255) NOT NULL,
  `company_code` varchar(255) NOT NULL,
  `date_start` date NOT NULL,
  `date_end` date NOT NULL,
  `list` text NOT NULL,
  PRIMARY KEY (`id`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=67 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for thaibaht
-- ----------------------------
DROP TABLE IF EXISTS `thaibaht`;
CREATE TABLE `thaibaht` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `fld1` char(1) DEFAULT NULL,
  `fld2` char(5) DEFAULT NULL,
  `fld3` char(5) DEFAULT NULL,
  `fld4` char(5) DEFAULT NULL,
  `fld5` char(4) DEFAULT NULL,
  `fld6` char(4) DEFAULT NULL,
  `fld7` char(4) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for tmtlab
-- ----------------------------
DROP TABLE IF EXISTS `tmtlab`;
CREATE TABLE `tmtlab` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LCCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `BillGroup` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `CsCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TMLT` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `LOINC` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Panel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `SFlag` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ChargeCat` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `UnitPrice` double(10,2) NOT NULL,
  `BenefitPlan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ReimbPrice` double(10,2) NOT NULL,
  `UpdateFlag` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UPDateBeg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UPDateEnd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `RPDateBeg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `RPDateEnd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DateUpd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=696 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tmtlab_copy
-- ----------------------------
DROP TABLE IF EXISTS `tmtlab_copy`;
CREATE TABLE `tmtlab_copy` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `LCCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `BillGroup` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `CsCode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `TMLT` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `LOINC` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Panel` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci DEFAULT '',
  `SFlag` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ChargeCat` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `UnitPrice` double(10,2) NOT NULL,
  `BenefitPlan` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ReimbPrice` double(10,2) NOT NULL,
  `UpdateFlag` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UPDateBeg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `UPDateEnd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `RPDateBeg` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `RPDateEnd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `DateUpd` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=666 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for tmtlab_demo
-- ----------------------------
DROP TABLE IF EXISTS `tmtlab_demo`;
CREATE TABLE `tmtlab_demo` (
  `f1` varchar(255) DEFAULT NULL,
  `f2` varchar(255) DEFAULT NULL,
  `f3` varchar(255) DEFAULT NULL,
  `f4` varchar(255) DEFAULT NULL,
  `f5` varchar(255) DEFAULT NULL,
  `f6` varchar(255) DEFAULT NULL,
  `f7` varchar(255) DEFAULT NULL,
  `f8` varchar(255) DEFAULT NULL,
  `f9` varchar(255) DEFAULT NULL,
  `f10` varchar(255) DEFAULT NULL,
  `f11` varchar(255) DEFAULT NULL,
  `f12` varchar(255) DEFAULT NULL,
  `f13` varchar(255) DEFAULT NULL,
  `f14` varchar(255) DEFAULT NULL,
  `f15` varchar(255) DEFAULT NULL,
  `f16` varchar(255) DEFAULT NULL,
  `f17` varchar(255) DEFAULT NULL,
  `f18` varchar(255) DEFAULT NULL,
  `f19` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for to_pdf
-- ----------------------------
DROP TABLE IF EXISTS `to_pdf`;
CREATE TABLE `to_pdf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=345 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for trauma
-- ----------------------------
DROP TABLE IF EXISTS `trauma`;
CREATE TABLE `trauma` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `vn` varchar(5) NOT NULL DEFAULT '',
  `hn` varchar(10) NOT NULL DEFAULT '',
  `an` varchar(10) NOT NULL DEFAULT '',
  `age` varchar(30) NOT NULL DEFAULT '',
  `list_ptright` varchar(3) NOT NULL DEFAULT '',
  `list_ptright2` varchar(3) DEFAULT NULL,
  `disease_people` text NOT NULL,
  `drug_alert` text NOT NULL,
  `dx` text NOT NULL,
  `organ` text NOT NULL,
  `maintenance` text NOT NULL,
  `doctor` varchar(40) NOT NULL DEFAULT '',
  `type_accident` varchar(3) NOT NULL DEFAULT '',
  `wounded_vehicle` varchar(3) NOT NULL DEFAULT '',
  `wounded_detail` varchar(3) NOT NULL DEFAULT '',
  `cause_accident` varchar(3) NOT NULL DEFAULT '',
  `with_cause_accident` varchar(40) DEFAULT NULL,
  `list_with_cause_accident` varchar(6) NOT NULL,
  `spirits` varchar(3) NOT NULL DEFAULT '',
  `belt` varchar(3) NOT NULL DEFAULT '',
  `helmet` varchar(3) NOT NULL DEFAULT '',
  `sender` varchar(3) NOT NULL DEFAULT '',
  `als_sender` varchar(70) NOT NULL,
  `etc_sender` varchar(40) NOT NULL DEFAULT '',
  `cure` varchar(10) NOT NULL DEFAULT '',
  `time_diag` varchar(30) DEFAULT NULL,
  `time_in` varchar(30) DEFAULT '00:00:00',
  `time_out` varchar(30) DEFAULT '00:00:00',
  `officer` varchar(70) NOT NULL DEFAULT '',
  `trauma` varchar(10) NOT NULL DEFAULT '',
  `obs` varchar(3) NOT NULL DEFAULT '',
  `type_wounded` varchar(3) NOT NULL DEFAULT '',
  `type_wounded2` varchar(2) NOT NULL DEFAULT '',
  `accident_detail` varchar(3) NOT NULL DEFAULT '',
  `date_in` varchar(30) DEFAULT '0000-00-00',
  `admit_ward` varchar(20) DEFAULT NULL,
  `refer_hospital` varchar(50) DEFAULT NULL,
  `next_ka` varchar(1) NOT NULL DEFAULT '0',
  `repeat` varchar(1) NOT NULL DEFAULT '',
  `cause_refer` varchar(50) DEFAULT NULL,
  `type_patient` varchar(50) DEFAULT NULL,
  `means_refer` varchar(10) DEFAULT NULL,
  `take_care` char(1) DEFAULT NULL,
  `doc_refer` char(1) DEFAULT NULL,
  `nurse` char(1) DEFAULT NULL,
  `assistant_nurse` char(1) DEFAULT NULL,
  `estimate` char(1) DEFAULT NULL,
  `no_estimate` int(1) NOT NULL DEFAULT '0',
  `cradle` char(1) DEFAULT NULL,
  `doc_txt` char(1) NOT NULL DEFAULT '',
  `consult` varchar(150) DEFAULT NULL,
  `to_or` char(1) NOT NULL DEFAULT '',
  `to_lr` char(1) NOT NULL DEFAULT '',
  `to_etc` varchar(20) NOT NULL,
  `to_hpt_lp` varchar(1) NOT NULL,
  `er_tell` varchar(11) DEFAULT NULL,
  `problem_refer` text,
  `suggestion` varchar(1) NOT NULL,
  `follow_refer` text NOT NULL,
  `out_changwat` varchar(1) NOT NULL,
  `comment_admit` text NOT NULL,
  `fresh_wound` tinyint(4) DEFAULT NULL,
  `wound_hours` tinyint(4) DEFAULT NULL,
  `weight` double(10,2) NOT NULL,
  `height` double(10,2) NOT NULL,
  `bmi` double(10,2) NOT NULL,
  `temperature` varchar(5) NOT NULL,
  `pause` varchar(5) NOT NULL,
  `rate` varchar(5) NOT NULL,
  `bp1` varchar(5) NOT NULL,
  `bp2` varchar(5) NOT NULL,
  `o2sat` varchar(10) NOT NULL,
  `painscore` varchar(5) NOT NULL,
  `condition` text,
  PRIMARY KEY (`row_id`),
  KEY `hn` (`hn`),
  KEY `doctor` (`doctor`)
) ENGINE=MyISAM AUTO_INCREMENT=265726 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for trauma_cpg
-- ----------------------------
DROP TABLE IF EXISTS `trauma_cpg`;
CREATE TABLE `trauma_cpg` (
  `for_id` int(11) NOT NULL,
  `datetime` varchar(30) DEFAULT NULL,
  `date_in` varchar(30) DEFAULT NULL,
  `time_in` varchar(30) DEFAULT NULL,
  `code_cpg` tinyint(12) NOT NULL,
  `lactate` varchar(255) DEFAULT NULL,
  `lac_time` varchar(255) DEFAULT NULL,
  `hc1_time` varchar(255) DEFAULT NULL,
  `hc2_time` varchar(255) DEFAULT NULL,
  `uauc_time` varchar(255) DEFAULT NULL,
  `ivf` varchar(255) DEFAULT NULL,
  `ivf_time` varchar(255) DEFAULT NULL,
  `atb` varchar(255) DEFAULT NULL,
  `atb_time` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`for_id`,`code_cpg`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for trauma_ds
-- ----------------------------
DROP TABLE IF EXISTS `trauma_ds`;
CREATE TABLE `trauma_ds` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `thidate_regis` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `hn` varchar(12) NOT NULL DEFAULT '',
  `ptname` varchar(40) NOT NULL DEFAULT '',
  `age` varchar(15) NOT NULL DEFAULT '',
  `ptright` varchar(40) NOT NULL DEFAULT '',
  `type` char(1) NOT NULL DEFAULT '',
  `size` varchar(2) NOT NULL DEFAULT '',
  `location` varchar(255) DEFAULT NULL,
  `opd` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=158778 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for trauma_inject
-- ----------------------------
DROP TABLE IF EXISTS `trauma_inject`;
CREATE TABLE `trauma_inject` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `thidate_regis` varchar(30) DEFAULT '0000-00-00 00:00:00',
  `hn` varchar(12) NOT NULL DEFAULT '',
  `ptname` varchar(40) NOT NULL DEFAULT '',
  `age` varchar(15) NOT NULL DEFAULT '',
  `ptright` varchar(40) NOT NULL DEFAULT '',
  `TYPE` varchar(2) NOT NULL DEFAULT '',
  `drugcode` varchar(20) NOT NULL DEFAULT '',
  `tradname` varchar(50) NOT NULL DEFAULT '',
  `number` varchar(2) NOT NULL,
  `opd` tinyint(4) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=105217 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for trauma_labcare
-- ----------------------------
DROP TABLE IF EXISTS `trauma_labcare`;
CREATE TABLE `trauma_labcare` (
  `row_id` int(2) NOT NULL AUTO_INCREMENT,
  `for_id` int(2) NOT NULL DEFAULT '0',
  `hn` varchar(10) NOT NULL DEFAULT '',
  `labcare` varchar(100) NOT NULL DEFAULT '',
  `amount` tinyint(12) NOT NULL DEFAULT '0',
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=159549 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for trauma_lst_labcare
-- ----------------------------
DROP TABLE IF EXISTS `trauma_lst_labcare`;
CREATE TABLE `trauma_lst_labcare` (
  `row_id` int(2) NOT NULL AUTO_INCREMENT,
  `for_id` int(2) NOT NULL DEFAULT '0',
  `hn` varchar(10) NOT NULL DEFAULT '',
  `lst_labcare` varchar(3) NOT NULL DEFAULT '',
  `amount` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=865862 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for traveldata
-- ----------------------------
DROP TABLE IF EXISTS `traveldata`;
CREATE TABLE `traveldata` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `emp_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `emp_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `emp_idcard` varchar(13) COLLATE utf8_unicode_ci NOT NULL,
  `emp_subposition` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_position` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `emp_relation` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `emp_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=2535 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for treatment_refrain_hd
-- ----------------------------
DROP TABLE IF EXISTS `treatment_refrain_hd`;
CREATE TABLE `treatment_refrain_hd` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `ptname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `active_date` date NOT NULL,
  `type` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `hand` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `officer` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `officer_date` datetime NOT NULL,
  `officer_update` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lastupdate` datetime NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for typecovid
-- ----------------------------
DROP TABLE IF EXISTS `typecovid`;
CREATE TABLE `typecovid` (
  `id` int(6) NOT NULL AUTO_INCREMENT,
  `code` varchar(10) NOT NULL,
  `detail` varchar(50) NOT NULL,
  `comment` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for typeopcard
-- ----------------------------
DROP TABLE IF EXISTS `typeopcard`;
CREATE TABLE `typeopcard` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(100) NOT NULL,
  `status` varchar(10) DEFAULT 'Y',
  `pt` varchar(1) NOT NULL,
  `row` varchar(2) NOT NULL,
  `gent_vn` varchar(1) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=74 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for typeservice
-- ----------------------------
DROP TABLE IF EXISTS `typeservice`;
CREATE TABLE `typeservice` (
  `ts_id` int(11) NOT NULL AUTO_INCREMENT,
  `ts_code` varchar(4) NOT NULL,
  `ts_name` varchar(50) NOT NULL,
  PRIMARY KEY (`ts_id`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for update_f43_epi
-- ----------------------------
DROP TABLE IF EXISTS `update_f43_epi`;
CREATE TABLE `update_f43_epi` (
  `f1` varchar(255) DEFAULT NULL,
  `f2` varchar(255) DEFAULT NULL,
  `f3` varchar(255) DEFAULT NULL,
  `f4` varchar(255) DEFAULT NULL,
  `f5` varchar(255) DEFAULT NULL,
  `f6` varchar(255) DEFAULT NULL,
  `f7` varchar(255) DEFAULT NULL,
  `f8` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for users
-- ----------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- ----------------------------
-- Table structure for vaccine
-- ----------------------------
DROP TABLE IF EXISTS `vaccine`;
CREATE TABLE `vaccine` (
  `id_vac` int(11) NOT NULL AUTO_INCREMENT,
  `vac_name` varchar(50) NOT NULL,
  `code` varchar(3) NOT NULL,
  PRIMARY KEY (`id_vac`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for vaccine_detail
-- ----------------------------
DROP TABLE IF EXISTS `vaccine_detail`;
CREATE TABLE `vaccine_detail` (
  `id_no` int(11) NOT NULL AUTO_INCREMENT,
  `id_vac` int(11) NOT NULL,
  `syringe_no` varchar(20) NOT NULL,
  `detail` varchar(40) NOT NULL,
  `vaccine_code` varchar(50) NOT NULL,
  PRIMARY KEY (`id_no`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for village
-- ----------------------------
DROP TABLE IF EXISTS `village`;
CREATE TABLE `village` (
  `VILL_NO` varchar(255) NOT NULL,
  `VILL_CODE` varchar(255) NOT NULL,
  `TAM_CODE` varchar(255) NOT NULL,
  `AMP_CODE` varchar(255) NOT NULL,
  `PROV_CODE` varchar(255) NOT NULL,
  `VILL_T` varchar(255) NOT NULL,
  `TAM_T` varchar(255) NOT NULL,
  `AMP_T` varchar(255) NOT NULL,
  `PROV_T` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ward_acu
-- ----------------------------
DROP TABLE IF EXISTS `ward_acu`;
CREATE TABLE `ward_acu` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `date_write` varchar(255) NOT NULL,
  `patient_num` text NOT NULL,
  `porjai` text NOT NULL,
  `auther` varchar(255) NOT NULL,
  `auther_id` varchar(255) NOT NULL,
  `auther_edit` varchar(255) DEFAULT NULL,
  `date_add` datetime NOT NULL,
  `date_edit` datetime DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `auther_id` (`auther_id`)
) ENGINE=MyISAM AUTO_INCREMENT=107 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ward_baby_stat
-- ----------------------------
DROP TABLE IF EXISTS `ward_baby_stat`;
CREATE TABLE `ward_baby_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ward_stat_id` int(11) DEFAULT NULL,
  `all_baby` int(11) DEFAULT NULL,
  `dead_baby` int(11) DEFAULT NULL,
  `dead_baby_reason` varchar(255) DEFAULT NULL,
  `baby_seven` int(11) DEFAULT NULL,
  `baby_seven_reason` varchar(255) DEFAULT NULL,
  `dead_mother` int(11) DEFAULT NULL,
  `dead_mother_reason` varchar(255) DEFAULT NULL,
  `all_mother` int(11) DEFAULT NULL,
  `all_cs` int(11) DEFAULT NULL,
  `prev_cs` int(11) DEFAULT NULL,
  `first_cs` int(11) DEFAULT NULL,
  `mother_cp` int(11) DEFAULT NULL,
  `eclampsia` int(11) DEFAULT NULL,
  `embolism` int(11) DEFAULT NULL,
  `blood_cp` int(11) DEFAULT NULL,
  `broke_cp` int(11) DEFAULT NULL,
  `infected_cp` int(11) DEFAULT NULL,
  `placenta_cp` int(11) DEFAULT NULL,
  `etc_cp` int(11) DEFAULT NULL,
  `etc_cp_reason` varchar(255) DEFAULT NULL,
  `hypoxia` float DEFAULT NULL,
  `milk` float DEFAULT NULL,
  `nl` int(11) DEFAULT NULL,
  `ve` int(11) DEFAULT NULL,
  `fe` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=100 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ward_dead_stat
-- ----------------------------
DROP TABLE IF EXISTS `ward_dead_stat`;
CREATE TABLE `ward_dead_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `ward_stat_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `hn` varchar(255) DEFAULT NULL,
  `an` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=410 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ward_log
-- ----------------------------
DROP TABLE IF EXISTS `ward_log`;
CREATE TABLE `ward_log` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `regisdate` varchar(40) NOT NULL,
  `an` varchar(30) NOT NULL,
  `hn` varchar(30) NOT NULL,
  `ward` varchar(50) NOT NULL,
  `bedcode` varchar(50) NOT NULL,
  `chgcode` varchar(50) NOT NULL,
  `old` text NOT NULL,
  `new` text NOT NULL,
  `day` varchar(30) NOT NULL,
  `lastcall` varchar(30) NOT NULL,
  `office` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=120831 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for ward_stat
-- ----------------------------
DROP TABLE IF EXISTS `ward_stat`;
CREATE TABLE `ward_stat` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `department` varchar(255) DEFAULT NULL,
  `date_write` varchar(255) DEFAULT NULL,
  `all_patient` int(11) DEFAULT NULL,
  `prev_patient` int(11) DEFAULT NULL,
  `new_patient` int(11) DEFAULT NULL,
  `all_admit` int(11) DEFAULT NULL,
  `prev_admit` int(11) DEFAULT NULL,
  `new_admit` int(11) DEFAULT NULL,
  `avg_bed` float DEFAULT NULL,
  `all_bed` int(11) DEFAULT NULL,
  `refer_patient` int(11) DEFAULT NULL,
  `disc_patient` int(11) DEFAULT NULL,
  `date_add` datetime DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL,
  `author` varchar(255) DEFAULT NULL,
  `author_id` int(11) DEFAULT NULL,
  `author_edit` varchar(255) DEFAULT NULL,
  `type` varchar(50) DEFAULT NULL,
  `status` tinyint(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=402 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for well_baby
-- ----------------------------
DROP TABLE IF EXISTS `well_baby`;
CREATE TABLE `well_baby` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `thidate` varchar(30) NOT NULL,
  `hn` varchar(30) NOT NULL,
  `age` varchar(50) NOT NULL,
  `weight` varchar(30) NOT NULL,
  `height` varchar(6) NOT NULL,
  `develop_age` varchar(70) NOT NULL,
  `growth` varchar(30) NOT NULL,
  `breastmilk` varchar(30) NOT NULL,
  `register` varchar(40) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=2195 DEFAULT CHARSET=utf8 PACK_KEYS=0;

-- ----------------------------
-- Table structure for women
-- ----------------------------
DROP TABLE IF EXISTS `women`;
CREATE TABLE `women` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `hn` varchar(10) NOT NULL,
  `fptype` varchar(1) NOT NULL,
  `nofp` varchar(1) NOT NULL,
  `numson` varchar(2) NOT NULL,
  `d_update` varchar(14) NOT NULL,
  `cid` varchar(13) NOT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xray_doctor
-- ----------------------------
DROP TABLE IF EXISTS `xray_doctor`;
CREATE TABLE `xray_doctor` (
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(15) NOT NULL,
  `vn` varchar(10) DEFAULT NULL,
  `yot` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `sname` varchar(100) NOT NULL,
  `detail` varchar(250) NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `status` varchar(2) NOT NULL DEFAULT 'N',
  `xrayno` varchar(10) NOT NULL,
  `film` varchar(15) NOT NULL,
  `type_diag` varchar(100) NOT NULL,
  `detail_all` varchar(300) DEFAULT NULL,
  `dbirth` varchar(30) DEFAULT NULL,
  `orderby` varchar(10) NOT NULL DEFAULT 'DR',
  KEY `xrayno` (`xrayno`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xray_doctor_detail
-- ----------------------------
DROP TABLE IF EXISTS `xray_doctor_detail`;
CREATE TABLE `xray_doctor_detail` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(50) NOT NULL,
  `hn` varchar(50) NOT NULL,
  `xrayno` varchar(50) NOT NULL,
  `doctor_detail` varchar(50) NOT NULL,
  `detail_all` varchar(50) NOT NULL,
  PRIMARY KEY (`row_id`),
  KEY `xrayno` (`xrayno`)
) ENGINE=MyISAM AUTO_INCREMENT=170094 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xray_stat
-- ----------------------------
DROP TABLE IF EXISTS `xray_stat`;
CREATE TABLE `xray_stat` (
  `row_id` int(5) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` varchar(10) NOT NULL,
  `xn` varchar(8) NOT NULL,
  `xn_new` varchar(8) NOT NULL,
  `ptname` varchar(120) NOT NULL,
  `age` varchar(50) NOT NULL,
  `ptright` varchar(80) NOT NULL,
  `patient_from` varchar(15) NOT NULL,
  `detail` text NOT NULL,
  `doctor` varchar(100) NOT NULL,
  `digital` tinyint(14) NOT NULL,
  `10_12` tinyint(14) NOT NULL,
  `14_14` tinyint(14) NOT NULL,
  `NONE` tinyint(14) NOT NULL,
  `filmbk` varchar(20) NOT NULL,
  `office` varchar(100) NOT NULL,
  `idno` int(5) NOT NULL,
  `remark` varchar(5) NOT NULL,
  `cancle` varchar(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=202960 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xraylist
-- ----------------------------
DROP TABLE IF EXISTS `xraylist`;
CREATE TABLE `xraylist` (
  `row_id` smallint(10) NOT NULL AUTO_INCREMENT,
  `xraycode` varchar(50) NOT NULL,
  `xraytype` varchar(1) NOT NULL,
  `xraysub` varchar(40) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=78 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xrayno
-- ----------------------------
DROP TABLE IF EXISTS `xrayno`;
CREATE TABLE `xrayno` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `date` varchar(30) DEFAULT NULL,
  `hn` char(12) DEFAULT NULL,
  `xn` char(12) DEFAULT NULL,
  `name` char(20) DEFAULT NULL,
  `surname` char(20) DEFAULT NULL,
  PRIMARY KEY (`row_id`),
  UNIQUE KEY `xn` (`xn`),
  KEY `xnum` (`xn`),
  KEY `hn` (`hn`),
  KEY `name` (`name`),
  KEY `surname` (`surname`)
) ENGINE=MyISAM AUTO_INCREMENT=35730 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Table structure for xraytype
-- ----------------------------
DROP TABLE IF EXISTS `xraytype`;
CREATE TABLE `xraytype` (
  `row_id` int(11) NOT NULL AUTO_INCREMENT,
  `h_code` varchar(20) DEFAULT NULL,
  `code` varchar(30) DEFAULT NULL,
  `detail` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`row_id`)
) ENGINE=MyISAM AUTO_INCREMENT=140 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Function structure for eGFR
-- ----------------------------
DROP FUNCTION IF EXISTS `eGFR`;
DELIMITER ;;
CREATE DEFINER=`sm3db_user`@`%` FUNCTION `eGFR`(`age` int(8),`sex` varchar(1),`crea` float(10)) RETURNS float
BEGIN

	DECLARE gfr FLOAT(10);
	
	SET @v = 0.993;
	SET @v1 = -0.329;
	SET @v2 = -1.209;
	SET @v3 = -0.411;

	SET @m = 0.9;
	SET @f = 0.7;

	IF sex = 'F' THEN 

		IF crea <= @f THEN SET gfr = 144 * POW((crea/@f),@v1) * POW(@v, age) ;
		ELSEIF crea > @f THEN SET gfr = 144 * POW((crea/@f),@v2) * POW(@v, age) ;
		END IF;

	ELSEIF sex = 'M' THEN 

		IF crea <= @m THEN SET gfr = 141 * POW((crea/@m),@v3) * POW(@v, age) ;
		ELSEIF crea > @m THEN SET gfr = 141 * POW((crea/@m),@v2) * POW(@v, age) ;
		END IF;

	END IF;
	
	RETURN gfr;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for getChkYear
-- ----------------------------
DROP FUNCTION IF EXISTS `getChkYear`;
DELIMITER ;;
CREATE DEFINER=`sm3db_user`@`%` FUNCTION `getChkYear`() RETURNS int(11)
    COMMENT 'แสดงปีโดยเป็นปีงบประมาณ 1 ต.ค. ถึง 30 ก.ย. ปีถัดไป'
BEGIN 
	DECLARE setYear INTEGER(10);
	DECLARE setMonth INTEGER(10);
	DECLARE setDay INTEGER(10);

	SET setYear = CAST(SUBSTRING(CURRENT_DATE(),1,4) AS UNSIGNED);
	SET setMonth = CAST(SUBSTRING(CURRENT_DATE(),6,2) AS UNSIGNED);
	SET setDay = CAST(SUBSTRING(CURRENT_DATE(),9,2) AS UNSIGNED);

	IF setMonth >= 10 AND setDay >= 1 THEN
		SET setYear = setYear + 1;
	END IF;

	SET setYear = setYear + 543;

	return setYear;
	
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for HMACSHA256
-- ----------------------------
DROP FUNCTION IF EXISTS `HMACSHA256`;
DELIMITER ;;
CREATE DEFINER=`sm3db_user`@`%` FUNCTION `HMACSHA256`(secret_key VARCHAR(256), val VARCHAR(2048)) RETURNS char(64) CHARSET utf8
    DETERMINISTIC
BEGIN
DECLARE ipad,opad BINARY(64);
DECLARE hexkey CHAR(128);
DECLARE hmac CHAR(64);

SET hexkey = RPAD(HEX(secret_key),128,"0");

IF LENGTH(secret_key) > 64 THEN
   SET hexkey = RPAD(SHA2(secret_key, '256'), 128, "0");
END IF;

SET ipad = UNHEX(CONCAT(
LPAD(CONV(CONV( MID(hexkey,1  ,16), 16, 10 ) ^ CONV( '3636363636363636', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,17 ,16), 16, 10 ) ^ CONV( '3636363636363636', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,33 ,16), 16, 10 ) ^ CONV( '3636363636363636', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,49 ,16), 16, 10 ) ^ CONV( '3636363636363636', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,65 ,16), 16, 10 ) ^ CONV( '3636363636363636', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,81 ,16), 16, 10 ) ^ CONV( '3636363636363636', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,97 ,16), 16, 10 ) ^ CONV( '3636363636363636', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,113,16), 16, 10 ) ^ CONV( '3636363636363636', 16, 10 ),10,16),16,"0")
));

SET opad = UNHEX(CONCAT(
LPAD(CONV(CONV( MID(hexkey,1  ,16), 16, 10 ) ^ CONV( '5c5c5c5c5c5c5c5c', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,17 ,16), 16, 10 ) ^ CONV( '5c5c5c5c5c5c5c5c', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,33 ,16), 16, 10 ) ^ CONV( '5c5c5c5c5c5c5c5c', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,49 ,16), 16, 10 ) ^ CONV( '5c5c5c5c5c5c5c5c', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,65 ,16), 16, 10 ) ^ CONV( '5c5c5c5c5c5c5c5c', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,81 ,16), 16, 10 ) ^ CONV( '5c5c5c5c5c5c5c5c', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,97 ,16), 16, 10 ) ^ CONV( '5c5c5c5c5c5c5c5c', 16, 10 ),10,16),16,"0"),
LPAD(CONV(CONV( MID(hexkey,113,16), 16, 10 ) ^ CONV( '5c5c5c5c5c5c5c5c', 16, 10 ),10,16),16,"0")
));

SET hmac = SHA2(CONCAT(opad,UNHEX(SHA2(CONCAT(ipad,val), '256'))), '256');

RETURN hmac;

END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for thDateTimeToEn
-- ----------------------------
DROP FUNCTION IF EXISTS `thDateTimeToEn`;
DELIMITER ;;
CREATE DEFINER=`sm3db_user`@`%` FUNCTION `thDateTimeToEn`(`mDate` varchar(255)) RETURNS varchar(14) CHARSET utf8
BEGIN
	DECLARE fDate VARCHAR(255) DEFAULT '';
	SET fDate = REPLACE(
		REPLACE( 
			REPLACE( 
				CONCAT((SUBSTRING(mDate, 1, 4) - 543), SUBSTRING(mDate, 5, 15)), 
				'-', 
				'' 
			), 
			':', 
			''
		), 
		' ', 
		'' 
	);
	RETURN fDate;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for thDateToEn
-- ----------------------------
DROP FUNCTION IF EXISTS `thDateToEn`;
DELIMITER ;;
CREATE DEFINER=`sm3db_user`@`%` FUNCTION `thDateToEn`(`mDate` date) RETURNS varchar(8) CHARSET utf8
BEGIN
	DECLARE fDate VARCHAR(8) DEFAULT '';
	SET fDate = REPLACE( CONCAT((SUBSTRING(mDate, 1, 4) - 543), SUBSTRING(mDate, 5, 6)), '-', '' );
	RETURN fDate;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for toEn
-- ----------------------------
DROP FUNCTION IF EXISTS `toEn`;
DELIMITER ;;
CREATE DEFINER=`sm3db_user`@`%` FUNCTION `toEn`(`mDate` varchar(10)) RETURNS varchar(10) CHARSET utf8
BEGIN
	# Support format yyyy-mm-dd to ENG DATE
	DECLARE fDate VARCHAR(10);
	SET fDate = CONCAT( (SUBSTRING(mDate,1,4) - 543), SUBSTRING(mDate,5,6)  );
	RETURN fDate;
END
;;
DELIMITER ;

-- ----------------------------
-- Function structure for toTh
-- ----------------------------
DROP FUNCTION IF EXISTS `toTh`;
DELIMITER ;;
CREATE DEFINER=`sm3db_user`@`%` FUNCTION `toTh`(`mDate` date) RETURNS date
BEGIN
	# Support format yyyy-mm-dd to THAI DATE
	DECLARE fDate VARCHAR(10);
	SET fDate = CONCAT( (SUBSTRING(mDate,1,4) + 543), SUBSTRING(mDate,5,6)  );
	RETURN fDate;
END
;;
DELIMITER ;
DROP TRIGGER IF EXISTS `test_hba1c_bs`;
DELIMITER ;;
CREATE TRIGGER `test_hba1c_bs` AFTER INSERT ON `resultdetail` FOR EACH ROW BEGIN 
	SET @yearchk = getChkYear();
	SET @hn = '';
	SET @ptname = '';
	SET @id = 0;
	SET @age = 0;
	SET @appoint = 0;
	SET @orderdate = '';

	SELECT `hn`,`patientname`,SUBSTRING(`orderdate`,1,10) AS `orderdate` INTO @hn, @ptname, @orderdate FROM `resulthead` WHERE `autonumber` = NEW.autonumber LIMIT 1;
	SELECT `id` INTO @id FROM `hba1c_bs` WHERE `hn` = @hn AND `yearchk` = @yearchk LIMIT 1;

	SELECT row_id INTO @appoint FROM appoint WHERE hn = @hn AND appdate_en = DATE_FORMAT(NOW(), "%Y-%m-%d") AND apptime != 'ยกเลิกการนัด' LIMIT 1;

	SELECT TIMESTAMPDIFF(YEAR, thDateToEn(`dbirth`), SUBSTRING(NOW(), 1, 10)) AS `age` INTO @age FROM `opcard` WHERE `hn` = @hn LIMIT 1;

	IF @id = 0 AND ( NEW.labcode='HBA1CC' OR NEW.labcode='GLU' ) AND @age >=35 AND @appoint > 0 THEN 
		INSERT INTO `hba1c_bs` (`id`, `autonumber`, `labcode`, `result`,`hn`,`ptname`,`orderdate`, `yearchk`) VALUES (NULL, NEW.autonumber, NEW.labcode, NEW.result, @hn, @ptname, @orderdate, @yearchk );
	END IF;
END
;;
DELIMITER ;
