/*
Navicat MySQL Data Transfer

Source Server         : 01-Main-192.168.131.240
Source Server Version : 50562
Source Host           : 192.168.131.240:3306
Source Database       : sm3db-utf8

Target Server Type    : MYSQL
Target Server Version : 50562
File Encoding         : 65001

Date: 2023-10-21 14:44:42
*/

SET FOREIGN_KEY_CHECKS=0;

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
-- Records of chkcompany
-- ----------------------------
INSERT INTO `chkcompany` VALUES ('1', 'C01', 'องค์การอุตสาหกรรมป่าไม้', '', '');
INSERT INTO `chkcompany` VALUES ('2', 'C02', 'ตรวจสุขภาพประจำปีข้าราชการทหาร', '', '');
INSERT INTO `chkcompany` VALUES ('3', 'C03', 'อบต.นายาง', '', '');
INSERT INTO `chkcompany` VALUES ('4', 'C04', 'บริษัท อีสท์ เวสท์ ซีด จำกัด', '', '');
INSERT INTO `chkcompany` VALUES ('5', 'C05', 'สอบตำรวจ', '', '');
INSERT INTO `chkcompany` VALUES ('6', 'C06', 'เบียร์ช้าง', '', '');
INSERT INTO `chkcompany` VALUES ('7', 'C00', '.................................', '', '');
INSERT INTO `chkcompany` VALUES ('8', 'C07', 'ฮิตาชิ', '', '');
INSERT INTO `chkcompany` VALUES ('9', 'C08', 'อิสท์ เวสท์ ซีด', '', '');
INSERT INTO `chkcompany` VALUES ('10', 'C09', 'ศูนย์ป้องกันและบรรเทาสาธารณะภัยเขต10', '', '');
INSERT INTO `chkcompany` VALUES ('11', 'C10', 'กำธรผ้าใบ', '', '');
INSERT INTO `chkcompany` VALUES ('12', 'C11', 'สถานพัฒนาและฟื้นฟูเด็ก จ.ลำปาง', '', '');
INSERT INTO `chkcompany` VALUES ('13', 'C12', 'บริษัท กลางคุ้มครองผู้ประสบภัยจากรถ จำกัด', '', '');
INSERT INTO `chkcompany` VALUES ('14', 'C13', 'มูลนิธิคืนช้างสู่ธรรมชาติ', '', '');
INSERT INTO `chkcompany` VALUES ('15', 'C14', 'แม่บ้าน รักษ์สุขภาพ', 'Y', '');
INSERT INTO `chkcompany` VALUES ('16', 'C15', 'การไฟฟ้าส่วนภูมิภาค', '', '');
INSERT INTO `chkcompany` VALUES ('17', 'C17', 'ฮักกันยามเฒ่า60', '', '');
INSERT INTO `chkcompany` VALUES ('18', 'C18', 'ดับเบิ้ลวิง', '', '');
INSERT INTO `chkcompany` VALUES ('19', 'C19', 'อัลฟ่ากรุ๊ป', '', '');
INSERT INTO `chkcompany` VALUES ('20', 'C20', 'ที.ไอ.ซี. 1991', '', '');
INSERT INTO `chkcompany` VALUES ('21', 'C21', 'ทรัพย์สินส่วนพระมหากษัตริย์', '', '');
INSERT INTO `chkcompany` VALUES ('22', 'C22', 'บริษัทบริหารสินทรัพย์กรุงเทพ', '', '');
INSERT INTO `chkcompany` VALUES ('23', 'C23', 'โรงเรียนลำปางกัลยาณี', '', '');
INSERT INTO `chkcompany` VALUES ('24', 'C24', 'ยูเอ็มโภคภัณฑ์', '', '');
INSERT INTO `chkcompany` VALUES ('25', 'C25', 'นิ่มซี่เส็งลิสซิ่ง', '', '');
INSERT INTO `chkcompany` VALUES ('26', 'C26', 'บริษัท ไทยเบฟเวอเรจ จำกัด', '', '');
INSERT INTO `chkcompany` VALUES ('27', 'C27', 'บ.เอเชี่ยนแอสฟัลท์ จำกัด', '', '');
INSERT INTO `chkcompany` VALUES ('28', 'C28', 'ตรวจสุขภาพทหารประจำปีนอกหน่วย', '', '');
INSERT INTO `chkcompany` VALUES ('29', 'C29', 'ช่อง7', '', '');
INSERT INTO `chkcompany` VALUES ('30', 'C30', 'walkin', 'y', '');
INSERT INTO `chkcompany` VALUES ('36', 'นิยมพานิช60', 'บริษัทนิยมพานิช ลำปาง', '', '60');
INSERT INTO `chkcompany` VALUES ('37', 'สง.ปรมน.ทบ.', 'สง.ปรมน.ทบ.', 'y', '');
INSERT INTO `chkcompany` VALUES ('38', 'ฝขส.มทบ', 'ฝขส.มทบ', 'y', '');
INSERT INTO `chkcompany` VALUES ('39', 'กอ.รมน.', 'กอ.รมน.', 'y', '');
INSERT INTO `chkcompany` VALUES ('40', 'ข้าราชการบำนาญ สังกัด มทบ.32', 'ข้าราชการบำนาญ สังกัด มทบ.32', 'y', '');
INSERT INTO `chkcompany` VALUES ('41', 'พล.ร.7', 'พล.ร.7', 'y', '');
INSERT INTO `chkcompany` VALUES ('42', 'ร.151 พัน1', 'ร.151 พัน1', 'y', '');
INSERT INTO `chkcompany` VALUES ('43', 'ตรวจสุขภาพประกันสังคม', 'ตรวจสุขภาพประกันสังคม', 'y', '');
INSERT INTO `chkcompany` VALUES ('44', 'รพศ.5พัน1', 'รพศ.5พัน1', 'y', '');
INSERT INTO `chkcompany` VALUES ('45', 'กรมรบพิเศษ4', 'กรมรบพิเศษ4', 'y', '');
INSERT INTO `chkcompany` VALUES ('46', 'รร.ลำปางกัลยาณี', 'รร.ลำปางกัลยาณี', 'y', '');
INSERT INTO `chkcompany` VALUES ('47', 'ตรวจสุขภาพประจำปี ข้าราชการบำนาญ ศูนย์ประสานงานนายทหารสัญญาบัตร', 'ตรวจสุขภาพประจำปี ข้าราชการบำนาญ ศูนย์ประสานงานนายทหารสัญญาบัตร', 'y', '');
INSERT INTO `chkcompany` VALUES ('48', 'ตรวจสุขภาพลูกจ้าง รพ.ค่ายฯ ปี61', 'ตรวจสุขภาพลูกจ้าง รพ.ค่ายฯ ปี61', 'n', '');
INSERT INTO `chkcompany` VALUES ('49', 'บริษัท ฮิตาชิ 61', 'บริษัท ฮิตาชิ 61', 'n', '');
INSERT INTO `chkcompany` VALUES ('50', 'Alpha Group', 'Alpha Group', 'y', '');
INSERT INTO `chkcompany` VALUES ('51', 'ฮักกันยามเฒ่า 61', 'ฮักกันยามเฒ่า 61', 'n', '');
INSERT INTO `chkcompany` VALUES ('52', 'ม.ราชภัฏลำปาง 61', 'ม.ราชภัฏลำปาง 61', 'n', '');
INSERT INTO `chkcompany` VALUES ('53', 'กรมทหารพรานที่33', 'กรมทหารพรานที่33', 'y', '');
INSERT INTO `chkcompany` VALUES ('54', 'กองบัญชาการทหารสูงสุด', 'กองบัญชาการทหารสูงสุด', 'y', '');
INSERT INTO `chkcompany` VALUES ('55', 'ธนาคารทหารไทย', 'ธนาคารทหารไทย', 'y', '');
INSERT INTO `chkcompany` VALUES ('56', 'มทบ.35', 'มทบ.35', 'y', '');
INSERT INTO `chkcompany` VALUES ('57', 'มทบ.34', 'มทบ.34', 'y', '');
INSERT INTO `chkcompany` VALUES ('58', 'ช.พัน4', 'ช.พัน4', 'y', '');
INSERT INTO `chkcompany` VALUES ('59', 'พัน สร.2 พล ร.2 รอ.', 'พัน สร.2 พล ร.2 รอ.', 'y', '');
INSERT INTO `chkcompany` VALUES ('60', 'ร3 พ.1', 'ร3 พ.1', 'y', '');
INSERT INTO `chkcompany` VALUES ('61', 'ปอรมน.', 'ปอรมน.', 'y', '');
INSERT INTO `chkcompany` VALUES ('62', 'ศศ.นศท.มทบ.32', 'ศศ.นศท.มทบ.32', 'y', '');
INSERT INTO `chkcompany` VALUES ('63', 'สรรพกำลัง มทบ.32', 'สรรพกำลัง มทบ.32', 'y', '');
INSERT INTO `chkcompany` VALUES ('64', 'มทบ.32', 'มทบ.32', 'y', '');
INSERT INTO `chkcompany` VALUES ('65', 'สลก.ทบ.', 'สลก.ทบ.', 'y', '');
INSERT INTO `chkcompany` VALUES ('66', 'กรมทพ.35', 'กรมทพ.35', 'y', '');
INSERT INTO `chkcompany` VALUES ('67', 'ข้าราชการบำนาญ', 'ข้าราชการบำนาญ', 'y', '');
INSERT INTO `chkcompany` VALUES ('68', 'กอ.รมน.', 'กอ.รมน.', 'y', '');
INSERT INTO `chkcompany` VALUES ('69', 'กองพัน บินที่1', 'กองพัน บินที่1', 'y', '');
INSERT INTO `chkcompany` VALUES ('70', 'ร.17 พัน 1', 'ร.17 พัน 1', 'y', '');
INSERT INTO `chkcompany` VALUES ('71', 'มทบ.45', 'มทบ.45', 'y', '');
INSERT INTO `chkcompany` VALUES ('72', 'กรมสรรพาวุธ ทหารบก', 'กรมสรรพาวุธ ทหารบก', 'y', '');
INSERT INTO `chkcompany` VALUES ('73', 'ตรวจสุขภาพลูกจ้าง รพ.ค่ายฯ ปี62', 'ตรวจสุขภาพลูกจ้าง รพ.ค่ายฯ ปี62', 'n', '');
INSERT INTO `chkcompany` VALUES ('74', 'ร.151 พัน1', 'ร.151 พัน1', 'y', '');
INSERT INTO `chkcompany` VALUES ('75', 'ตรวจสุขภาพประจำปี', 'ตรวจสุขภาพประจำปี', 'y', '');
INSERT INTO `chkcompany` VALUES ('76', 'ฮักกันยามเฒ่า 63', 'ฮักกันยามเฒ่า 63', 'y', '');
INSERT INTO `chkcompany` VALUES ('77', 'ใบรับรองแพทย์ 5 โรค (E_CERT-001)', 'ใบรับรองแพทย์ 5 โรค (E_CERT-001)', 'y', '');
INSERT INTO `chkcompany` VALUES ('78', 'ใบรับรองแพทย์ สำหรับใบอนุญาตขับรถ (E_CERT-002)', 'ใบรับรองแพทย์ สำหรับใบอนุญาตขับรถ (E_CERT-002)', 'y', '');
