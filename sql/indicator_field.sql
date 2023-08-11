/*
Navicat MySQL Data Transfer

Source Server         : 127 Localhost
Source Server Version : 50731
Source Host           : localhost:3306
Source Database       : smdb

Target Server Type    : MYSQL
Target Server Version : 50731
File Encoding         : 65001

Date: 2023-06-09 15:15:27
*/

SET FOREIGN_KEY_CHECKS=0;

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
) ENGINE=InnoDB AUTO_INCREMENT=215 DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of indicator_field
-- ----------------------------
INSERT INTO `indicator_field` VALUES ('3', '1', 'อัตราของบุคลากรในรพ.มี Core Competency ตามเกณฑ์ที่กำหนด (SST + Discipline)', null, null, '2023-05-03 13:51:02', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('5', '1', 'อัตราบุคลากรที่ได้รับการฝึกอบรม 20 ชม./คน/ปี', null, null, '2023-05-03 13:51:02', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('6', '1', 'สัดส่วนชั่วโมงการฝึกอบรมต่อคนต่อปีของแพทย์', null, null, '2023-05-03 13:51:02', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('13', '1', 'สัดส่วนชั่วโมงการฝึกอบรมต่อคนต่อปีของพยาบาลวิชาชีพ', null, null, '2023-05-03 14:39:39', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('14', '1', 'อัตราการย้ายของบุคลากร (ข้าราชการ)', null, null, '2023-05-03 14:39:39', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('15', '1', 'อัตราการลาออกของบุคลากร (ลูกจ้างชั่วคราว)', null, null, '2023-05-03 14:39:39', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('16', '1', 'ร้อยละบุคลากรที่บาดเจ็บจากเข็มทิ่มตำ', null, null, '2023-05-09 09:39:19', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('17', '1', 'ร้อยละบุคลากรที่บาดเจ็บจากการทำงานอื่นๆ (ยกเว้นเข็มทิ่มตำ)', null, null, '2023-05-09 09:39:19', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('18', '1', 'ร้อยละบุคลากรที่เจ็บป่วยจากการทำงาน', null, null, '2023-05-09 09:39:19', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('19', '1', 'ร้อยละของการตรวจสุขภาพประจำปีของบุคลากร ข้าราชการ', null, null, '2023-05-09 09:39:19', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('20', '1', 'ร้อยละของการตรวจสุขภาพประจำปีของบุคลากร ลูกจ้าง ', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('21', '1', 'ร้อยละจำนวนบุคลากรที่มีโรคอ้วนรายใหม่ (BMI≥30) ข้าราชการ  ', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('22', '1', 'ร้อยละจำนวนบุคลากรที่มีโรคอ้วนที่คุมได้ (BMI < 30) ลูกจ้าง', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('23', '1', 'ร้อยละจำนวนบุคลากรที่มี BMI ≥23', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('24', '1', 'ร้อยละบุคลากรเพศชายที่มีภาวะอ้วนลงพุง', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('25', '1', 'ร้อยละบุคลากรเพศหญิงที่มีภาวะอ้วนลงพุง', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('26', '1', 'ร้อยละบุคลากรได้รับวัคซีนไข้หวัดใหญ่', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('27', '1', 'ร้อยละการเข้าร่วมกิจกรรมจิตอาสาเพื่อโรงพยาบาลคุณธรรม', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('28', '1', 'ร้อยละความผูกพันของบุคลากรที่มีต่อองค์กร', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('29', '1', 'ความพึงพอใจของบุคลากรที่มีต่อโรงพยาบาล', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('30', '1', '', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'n', null);
INSERT INTO `indicator_field` VALUES ('31', '1', '', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'n', null);
INSERT INTO `indicator_field` VALUES ('32', '1', '', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'n', null);
INSERT INTO `indicator_field` VALUES ('33', '1', '', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'n', null);
INSERT INTO `indicator_field` VALUES ('34', '1', '', null, null, '2023-05-09 09:39:20', '2023-05-26 11:09:37', 'krit', 'สุมีนา', 'n', null);
INSERT INTO `indicator_field` VALUES ('35', '2', 'มาถึง รพ.ภายใน 12 ชม.', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('36', '2', 'MI ที่ได้รับการดุแลตาม CPG', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('37', '2', 'EKG ภายใน 10 นาที', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('38', '2', 'STEMI ได้รับ Fibrolytic drug ใน 30 นาที', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('39', '2', 'STEMI ได้รับการส่งต่อ', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('40', '2', 'NSTEMI ได้รับยาต้านเกล็ดเลือด', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('41', '2', 'NSTEMI ได้รับยาต้านการแข็งตัวของเลือด', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('42', '2', 'MI ทีมีภาวะ CHF', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('43', '2', 'MI ที่ต้อง Refer เนื่องจากอาการทรุด', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('44', '2', 'ผู้ป่วยเสียชีวิต (ใช้ CPG)', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('45', '2', 'ได้รับการ Consult Cardiologist ', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('46', '2', 'NSTEMI ที่ได้รับการวินิจฉัยผิด', null, null, '2023-05-09 09:50:08', '2023-05-09 09:50:34', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('47', '3', 'A', null, null, '2023-05-10 09:21:59', '2023-05-23 12:06:01', '', 'krit', 'n', null);
INSERT INTO `indicator_field` VALUES ('48', '3', 'B', null, null, '2023-05-10 09:21:59', '2023-05-23 12:06:01', '', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('49', '3', 'C', null, null, '2023-05-10 09:21:59', '2023-05-23 12:06:01', '', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('50', '3', 'D', null, null, '2023-05-12 13:11:29', '2023-05-23 12:06:01', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('51', '3', 'E', null, null, '2023-05-12 13:11:30', '2023-05-23 12:06:01', 'krit', 'krit', 'y', null);
INSERT INTO `indicator_field` VALUES ('63', '9', 'อัตราการเกิดภาวะPPH', null, null, '2023-05-26 11:11:07', '2023-05-26 11:11:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('64', '9', 'อัตราการเกิดภาวะชัก ในรายที่มีภาวะPIHจากSPE', null, null, '2023-05-26 11:11:07', '2023-05-26 11:11:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('65', '9', 'อัตราการเกิดภาวะคลอดก่อนกำหนด(Preterm Labor)', null, null, '2023-05-26 11:11:07', '2023-05-26 11:11:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('66', '9', 'อัตราการเกิดภาวะ BAในทารกแรกเกิด', null, null, '2023-05-26 11:11:07', '2023-05-26 11:11:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('67', '9', 'อัตราการตรวจคัดกรองเบาหวานขณะตั้งครรภ์ตามเกณฑ์', null, null, '2023-05-26 11:11:07', '2023-05-26 11:11:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('68', '10', 'อัตราการเกิดภาวะแทรกซ้อนของทารกแรกเกิดที่มีปัญหาหายใจเร็วหลังคลอด (ภาวะน้ำตาลในเลือดต่ำ ภาวะชัก ภาวะหายใจล้มเหลว)', null, null, '2023-05-26 11:12:04', '2023-05-26 11:12:04', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('69', '10', 'อัตราตัวการเกิดตัวเหลืองในทารกแรกเกิดที่ได้รับการักษาด้วยการส่องไฟ', null, null, '2023-05-26 11:12:04', '2023-05-26 11:12:04', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('70', '10', 'อัตราตัวการเกิดตัวเหลืองในทารกแรกเกิดที่เกิดภาวะ Kernicterus และได้รับการรักษาด้วยการเปลี่ยนถ่ายเลือด ', null, null, '2023-05-26 11:12:04', '2023-05-26 11:12:04', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('71', '10', 'อัตราการเกิดภาวะช็อคในผู้ป่วยเด็กที่เกิดภาวะ Moderate to Severe Dehydrate ', null, null, '2023-05-26 11:12:04', '2023-05-26 11:12:04', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('72', '11', 'อัตราการกลับมารักษาซ้ำที่ ER  ภายใน 48 ชั่วโมงในผู้ป่วยที่มี อาการกำเริบ', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('73', '11', 'อัตราการกลับมา re Admit ใน  28 วัน หลังจากจำหน่าย', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('74', '11', 'อัตราการเกิดการหายใจล้มเหลว', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('75', '11', 'ร้อยละของผู้ป่วยที่เลิกสูบบุหรี่ *', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('76', '11', 'ร้อยละของผู้ป่วยที่สมรรถภาพปอดคงที่หรือดีขึ้น', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('77', '11', 'ร้อยละของผู้ป่วยที่มี Exercise Tolerance คงที่หรือดีขึ้น*', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('78', '11', 'ร้อยละของผู้ป่วยที่ฝึกการหายใจได้ถูกต้อง*', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('79', '11', 'ร้อยละของผู้ป่วยทีใช้ยาสูดพ่นได้ถูกต้อง Good technique', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('80', '11', 'ร้อยละของผู้ป่วยทีใช้ยาสูดพ่นได้ถูกต้อง Good  compliant', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('81', '11', 'อัตราผู้ป่วยที่มีโรคกำเริบ', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('82', '11', 'Unplanned ICU', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('83', '11', 'อัตราการเสียชีวิต', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('84', '11', 'อัตราการนอน รพ.(ครั้ง/คน/ปี)', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('85', '11', 'ร้อยละผู้ป่วยที่ได้ทำ spirometry', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('86', '11', 'ร้อยละผู้ป่วยที่ได้รับการฉีดไข้หวัดใหญ่ตามฤดูกาล', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('87', '11', 'ผู้ป่วยที่ขึ้นทะเบียนที่ COPD clinic', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('88', '11', 'ร้อยละการมาตามนัด ใน COPD clinic', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('89', '11', 'ร้อยละของการการคัดกรองผู้ป่วยถุงลมโป่งพองระยะ Stage ', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('90', '11', 'LOS', null, null, '2023-05-26 11:17:41', '2023-05-26 11:17:41', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('91', '12', 'ร้อยละผู้ป่วยมาถึง รพ.ภายใน 12 ชม.', null, null, '2023-05-26 11:23:27', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('92', '12', 'อัตราผู้ป่วย MI ที่ได้รับการดูแลตาม CPG', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('93', '12', 'อัตราการทำ EKG ภายใน 10 นาที', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('94', '12', 'อัตราผู้ป่วย STEMI ที่ได้รับ Fibrolytic  drug ภายใน 30 นาที', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('95', '12', 'อัตราผู้ป่วย STEMI ที่ได้รับการส่งต่อ', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('96', '12', 'อัตราผู้ป่วย NSTEMI ที่ได้รับยาต้านเกล็ดเลือด', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('97', '12', 'อัตราผู้ป่วย NSTEMI ที่ได้รับยาต้านการแข็งตัวของเลือด', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('98', '12', 'อัตราผู้ป่วย MI ที่มีภาวะ CHF', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('99', '12', 'อัตราผู้ป่วย MI ที่ต้อง Refer เนื่องจากอาการทรุดลง *', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('100', '12', 'อัตราผู้ป่วยเสียชีวิต  (ใช้ CPG)', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('101', '12', 'อัตราการได้รับการ Consult Cardiologist ทุกรายระหว่าง Admit', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('102', '12', 'ร้อยละผู้ป่วย STEMI ที่ได้รับการวินิจฉัยผิดตั้งแต่แรก', null, null, '2023-05-26 11:25:56', '2023-05-26 11:25:56', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('103', '13', 'ร้อยละผู้ป่วย sepsis ได้รับการวินิจฉัยใน 60  นาที', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('104', '13', 'ร้อยละผู้ป่วย sepsis ได้รับการเพาะเชื้อใน 60นาที', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('105', '13', 'ร้อยละผู้ป่วย sepsis ได้รับยาปฏิชีวนะใน 60 นาที', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('106', '13', 'ระยะเวลาเฉลี่ยผู้ป่วย sepsis ได้รับยาปฏิชีวนะ', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('107', '13', 'ร้อยละผู้ป่วย sepsis ได้รับสารน้ำอย่างเพียงพอในระยะแรก *', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('108', '13', 'ร้อยละผู้ป่วย sepsis ได้เริ่ม Sepsis Bundle ภายใน 60 นาที', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('109', '13', 'ร้อยละผู้ป่วย sepsis ได้รับการแก้ไขระบบไหลเวียนโลหิตถึงเป้าหมายได้ใน 1 ชั่วโมง', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('110', '13', 'อัตราเสียชีวิตของผู้ป่วย sepsis,Septic shock', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('111', '13', 'ร้อยละผู้ป่วยSepsis ได้รับยาหดหลอดเลือด ในกรณีระบบไหลเวียนไม่ถึง เป้าหมาย แม้ได้สารน้ำเพียงพอ', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('112', '13', 'ร้อยละผู้ป่วยSepsis ที่ได้รับการตรวจ lactate', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('113', '13', 'ระยะเวลานอนโรงพยาบาลเฉลี่ยของผู้ป่วย Sepsis', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('114', '13', 'ร้อยละการใช้ CPG', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('115', '13', 'ร้อยละการใช้ qSOFA+MEWs', null, null, '2023-05-26 11:28:33', '2023-05-26 11:28:33', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('116', '14', 'ร้อยละการคัดกรองเบาหวานในผู้ป่วยที่มีอายุ 35ปีขึ้นไป', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('117', '14', 'อัตราผู้ป่วย DM อายุน้อยกว่า 60 ปีมีระดับ HbA1c อยู่ในเกณฑ์เหมาะสม   (HbA1c≤ 7%) ', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('118', '14', 'อัตราผู้ป่วย DM อายุมากกว่าหรือเท่ากับ 60 ปี มีระดับ HbA1c อยู่ในเกณฑ์เหมาะสม   (HbA1c ≤ 8%)', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('119', '14', 'อัตราการเกิดภาวะน้ำตาลสูงอันตราย( DKA, HHS) ในผู้ป่วย DM ที่นอน รพ.', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('120', '14', 'อัตราการเกิดภาวะน้ำตาลต่ำอันตรายในผู้ป่วย DM ที่นอน รพ.', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('121', '14', 'ร้อยละผู้ป่วย DM ที่ได้รับการตรวจ urine microalbuminuria (อย่างน้อย 1 ครั้ง/ปี)', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('122', '14', 'ร้อยละผู้ป่วย DM ที่ได้รับการตรวจจอประสาทตา', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('123', '14', 'ร้อยละผู้ป่วย DM ที่ได้รับการตรวจสุขภาพช่องปาก', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('124', '14', 'อัตราผู้ป่วย DM ที่ได้รับการตรวจเท้า', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('125', '14', 'จำนวนผู้ป่วยเบาหวานที่ถูกตัดขาหรือเท้าหรือนิ้ว', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('126', '14', 'อัตราการเกิด DR ในผู้ป่วย DM', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('127', '14', 'อัตราการฟอกเลือดหรือ CAPD ในผู้ป่วย DM', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('128', '14', 'ร้อยละผู้ป่วยมาตามนัดที่ คลินิก DM', null, null, '2023-05-26 11:43:18', '2023-05-26 11:43:18', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('129', '15', 'all cause mortality in ESRD ', null, null, '2023-05-26 11:45:37', '2023-05-26 11:45:37', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('130', '15', 'อัตราความเพียงพอในการฟอกเลือด', null, null, '2023-05-26 11:45:37', '2023-05-26 11:45:37', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('131', '15', 'อัตราการติดเชื้อจากการฟอกเลือด', null, null, '2023-05-26 11:45:37', '2023-05-26 11:45:37', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('132', '15', 'อัตราการติดเชื้อจากการใส่สายสวนหลอดเลือดดำ (permanent catheter,   double lumen catheter)', null, null, '2023-05-26 11:45:37', '2023-05-26 11:45:37', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('133', '15', 'อัตราการเกิดภาวะแทรกซ้อนเฉียบพลันจากการฟอกเลือด \"Hypotension \"', null, null, '2023-05-26 11:45:37', '2023-05-26 11:45:37', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('134', '15', 'อัตราการเกิดภาวะแทรกซ้อนเฉียบพลันจากการฟอกเลือด \"Cramp\"', null, null, '2023-05-26 11:45:37', '2023-05-26 11:45:37', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('135', '15', 'อัตราการเกิดภาวะแทรกซ้อนเฉียบพลันจากการฟอกเลือด \"Bleeding\"', null, null, '2023-05-26 11:45:37', '2023-05-26 11:45:37', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('136', '16', 'จำนวนผู้ป่วย Acute ischemic stroke', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('137', '16', 'จำนวนผู้ป่วย Acute hemorrhagic stroke', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('138', '16', 'จำนวนผู้ป่วย Stroke fast track ไปรพ.ลำปาง', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('139', '16', 'ร้อยละผู้ป่วย Acute ischemic stroke ที่มาในระยะ golden period', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('140', '16', 'ร้อยละผู้ป่วย Stroke fast track refer ได้ภายใน 30 นาที', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('141', '16', 'ร้อยละผู้ป่วย Stroke fast track refer ได้ภายใน หลัง On set ( ภายใน 3.30ชม.ในผู้ป่วยอายุ18-80 ปี)', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('142', '16', 'ร้อยละผู้ป่วย Stroke fast track refer ได้ภายใน หลัง On set( ภายใน 3 ชม. ในผู้ป่วยอายุ >80 ปี)', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('143', '16', 'ร้อยละผู้ป่วยได้รับการทำ CT brain', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('144', '16', 'ร้อยละผู้ป่วย Acute ischemic stroke ได้รับยาต้านเกล็ดเลือดและยาลดไขมัน', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('145', '16', 'ร้อยละผู้ป่วย เกิดภาวะแทรกซ้อน Pneumonia', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('146', '16', 'ร้อยละผู้ป่วย เกิดภาวะแทรกซ้อน CAUTI', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('147', '16', 'ร้อยละผู้ป่วย เกิดภาวะแทรกซ้อน Bed Sore', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('148', '16', 'ร้อยละผู้ป่วย เกิดภาวะแทรกซ้อน Upper GI bleeding', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('149', '16', 'ร้อยละผู้ป่วยได้รับการทำกายภาพบำบัด ', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('150', '16', 'ร้อยละผู้ป่วยที่ได้รับการเตรียมความพร้อมหลังจำหน่าย', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('151', '16', 'ร้อยละผู้ป่วยที่ได้รับการเยี่ยมบ้าน', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('152', '16', 'อัตราตาย', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('153', '16', 'ร้อยละผู้ป่วยที่ได้รับการทำกายภาพบำบัดแล้วมีอาการคงที่หรือดีขึ้น ( ประเมินตาม Bathal index )', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('154', '16', 'ร้อยละของผู้ป่วย Acute stroke ที่มีความสามารถปฏิบัติกิจวัตรประจำวันได้ดีขึ้น 1 ระดับ ภายใน 3 เดือน', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('155', '16', 'ร้อยละของผู้ป่วย stroke ที่มีความสามารถปฏิบัติกิจวัตรประจำวันได้ตั้งแต่ ระดับ ปานกลางขึ้นไป', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('156', '16', 'ร้อยละผู้ป่วยที่ได้รับการวินิจฉัยผิดตั้งแต่แรก (miss diagnosis)', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('157', '16', 'อัตราการ re-admit ภายใน 28 วัน', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('158', '16', 'ร้อยละผู้ป่วยที่ทรุดลงและต้องส่งต่อ', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('159', '16', 'ร้อยละของผู้ป่วย stroke ที่มาตามนัดกายภาพบำบัด', null, null, '2023-05-26 11:54:39', '2023-05-26 11:54:39', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('160', '17', 'ร้อยละครูฝึก/ผู้ช่วยครูฝึกทหารใหม่ ได้รับการอบรม', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('161', '17', 'ร้อยละของคะแนนนิเทศของหน่วยฝึกทหารใหม่', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('162', '17', 'จำนวนการเกิด Heat stroke ในพลทหาร', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('163', '17', 'อัตราการปฏิบัติตาม care Map', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('164', '17', 'จำนวนการเกิดความพิการในผู้ป่วย Heat stroke', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('165', '17', 'ร้อยละของทหารกองประจำการที่เข้ารับการฝึกทหารใหม่ ที่ได้รับบาดเจ็บจากความร้อนตั้งแต่ระดับ Heat exhaustion', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('166', '17', 'ร้อยละของทหารกองประจำการที่เข้ารับการฝึกทหารใหม่ ที่ได้รับบาดเจ็บจากความร้อนตั้งแต่ระดับ minor Heat injury', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('167', '17', 'ร้อยละหน่วยฝึกนำผู้ป่วยส่งมา รพ.ได้ภายใน 10 นาที', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('168', '17', 'ร้อยละผู้ป่วยที่ได้รับการลดอุณหภูมิแกนกลาง<38 C ภายใน  3 ชม', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('169', '17', 'จำนวนการเสียชีวิตในผู้ป่วย Heat stroke', null, null, '2023-05-26 11:56:46', '2023-05-26 11:56:46', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('170', '18', 'อัตราผู้ป่วยที่ไม่มารับยาและติดตามแล้วไม่มาเกิน 3 เดือน ', null, null, '2023-05-26 11:58:07', '2023-05-26 11:58:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('171', '18', 'อัตราผู้ป่วย CD4>200 Cell/ml', null, null, '2023-05-26 11:58:07', '2023-05-26 11:58:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('172', '18', 'อัตราผู้ป่วยทีมีผลการตรวจ CD4>350 Cell/ml', null, null, '2023-05-26 11:58:07', '2023-05-26 11:58:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('173', '18', 'อัตราผู้ป่วย VL<20Copies/cumm', null, null, '2023-05-26 11:58:07', '2023-05-26 11:58:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('174', '18', 'อัตราผู้ป่วยเสียชีวิต', null, null, '2023-05-26 11:58:07', '2023-05-26 11:58:07', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('175', '19', 'ร้อยละประชากรอายุ 35 ปีขึ้นไป ที่ได้รับการตรวจคัดกรองความดันโลหิตสูง', null, null, '2023-05-26 11:59:22', '2023-05-26 11:59:25', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('176', '19', 'ร้อยละผู้ป่วยที่ควบคุมความดันโลหิตได้ดี ( <140/90 )', null, null, '2023-05-26 11:59:22', '2023-05-26 11:59:25', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('177', '19', 'ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ ECG, CXR', null, null, '2023-05-26 11:59:22', '2023-05-26 11:59:25', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('178', '19', 'ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Urine albumin', null, null, '2023-05-26 11:59:22', '2023-05-26 11:59:25', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('179', '19', 'ร้อยละผู้ป่วยความดันโลหิตสูง ที่ได้การตรวจ Serum Cr', null, null, '2023-05-26 11:59:22', '2023-05-26 11:59:25', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('180', '19', 'อัตราการเกิดภาวะ ESRD', null, null, '2023-05-26 11:59:22', '2023-05-26 11:59:25', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('181', '19', 'อัตราการเกิดภาวะ ACS', null, null, '2023-05-26 11:59:22', '2023-05-26 11:59:25', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('182', '19', 'อัตราการเกิดภาวะ Stroke', null, null, '2023-05-26 11:59:22', '2023-05-26 11:59:25', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('183', '20', 'ความเชื่อมั่นของทหารและครอบครัว', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('184', '20', 'ความพึงพอใจของผู้ป่วยนอก', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('185', '20', 'ความพึงพอใจของผู้ป่วยใน', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('186', '20', 'ได้รับการรับรองมาตรฐาน HA อย่างต่อเนื่อง', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('187', '20', 'ร้อยละผู้ป่วยโรคเบาหวาน มีค่า HBA1C <7', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('188', '20', 'ร้อยละผู้ป่วยโรคความดันโลหิตสูง ควบคุมความดันได้ดี (<140/90)', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('189', '20', 'อัตราการเสียชีวิตของผู้ป่วยไตวายเรื้อรังที่ทำ Dialysis ', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('190', '20', 'อัตราการเสียชีวิตของผู้ป่วย Sepsis', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('191', '20', 'ร้อยละผู้ป่วย Stroke fast track refer ได้ในเวลาที่กำหนด', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('192', '20', 'อัตราการเสียชีวิตของผู้ป่วย ACS ใน รพ.', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('193', '20', 'อัตราความพึงพอใจของผู้มารับบริการที่แพทย์ทางเลือก', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('194', '20', 'อัตราความพึงพอใจของผู้ป่วยที่ศูนย์ไตเทียม', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('195', '20', 'อัตราความพึงพอใจของผู้ป่วยที่ศูนย์ตา', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('196', '20', 'Military Medicine : ร้อยละจำนวนกำลังพลที่มีโรค HT รายใหม่ (BP≥140/90)', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('197', '20', 'Military Medicine : ร้อยละจำนวนกำลังพลที่มีโรค DM รายใหม่ (BS>126)', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('198', '20', 'Military Medicine : ร้อยละจำนวนกำลังพลที่มีโรคอ้วนรายใหม่ (BMI>30)', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('199', '20', 'Military Medicine : ร้อยละของการฝึกทหารใหม่ และการฝึกทหารในจังหวัดลำปางเกิด Heat exhaustion', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('200', '20', 'Military Medicine : กำลังพลที่อยู่ระหว่างปฏิบัติราชการสนาม มีผลตรวจสุขภาพจิตอยู่ในเกณฑ์ปกติ', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('201', '20', 'Military Medicine : จำนวนครั้งกำลังพลและครอบครัวป่วยด้วยโรคที่เกิดจากยุงลายเป็นพาหะที่เกิดขึ้นในชุมชนค่ายทหาร', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('202', '20', 'M-MERT : ร้อยละการตอบสนองต่อการออก EMS<10 นาที', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('203', '20', 'M-MERT : ร้อยละการสนับสนุนภารกิจช่วยเหลือภัยพิบัติที่หน่วยเหนือร้องขอ', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('204', '20', 'Core Competency: บุคลากรทุกคนมี SST Culture+ Discipline ', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('205', '20', 'Core Competency: จำนวน ชม. อบรมของบุคลากรเฉลี่ย >20 ชม./คน/ปี', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('206', '20', 'Functional Competency : สัดส่วนชั่วโมงการฝึกอบรมต่อคนต่อปีของแพทย์', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('207', '20', 'Functional Competency : สัดส่วนชั่วโมงการฝึกอบรมต่อคนต่อปีของพยาบาลวิชาชีพ', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('208', '20', 'ความพึงพอใจของบุคลากรที่มีต่อรพ.', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('209', '20', 'ความผูกพันของบุคลากรที่มีต่อองค์กร', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('210', '20', 'การรับรอง Green&Clean Hospital', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('211', '20', 'เปิดให้บริการที่ตึกใหม่อาคารเฉลิมพระเกียรติ', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('212', '20', 'ความพึงพอใจของหน่วยงานต่อระบบ IT', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('213', '20', 'ความพึงพอใจของทีมคุณภาพต่อระบบ IT', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
INSERT INTO `indicator_field` VALUES ('214', '20', 'การบริหารการเงินที่มีประสิทธิภาพ รายจ่ายคิดเป็นร้อยละของรายได้', null, null, '2023-05-26 12:43:59', '2023-05-26 12:43:59', 'สุมีนา', 'สุมีนา', 'y', null);
