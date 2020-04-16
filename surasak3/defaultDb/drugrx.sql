# phpMyAdmin SQL Dump
# version 2.5.6
# http://www.phpmyadmin.net
#
# โฮสต์: localhost
# เวลาในการสร้าง: 16 เม.ย. 2020  16:18น.
# รุ่นของเซิร์ฟเวอร์: 5.0.77
# รุ่นของ PHP: 5.1.6
# 
# ฐานข้อมูล : `smdb`
# 

# --------------------------------------------------------

#
# โครงสร้างตาราง `drugrx`
#

CREATE TABLE `drugrx` (
  `row_id` int(11) NOT NULL auto_increment,
  `date` varchar(30) default NULL,
  `hn` varchar(12) default NULL,
  `an` varchar(12) default NULL,
  `drugcode` varchar(10) default NULL,
  `tradname` varchar(40) default NULL,
  `amount` int(6) default NULL,
  `price` double(10,2) default NULL,
  `item` int(2) default NULL,
  `slcode` varchar(20) default NULL,
  `part` varchar(8) default NULL,
  `idno` int(11) NOT NULL default '0',
  `stock` float default '0',
  `statcon` varchar(5) default NULL,
  `DPY` varchar(10) default NULL,
  `DPN` varchar(10) default NULL,
  `reason` varchar(100) NOT NULL,
  `drug_inject_amount` varchar(50) NOT NULL,
  `drug_inject_unit` varchar(50) NOT NULL,
  `drug_inject_amount2` varchar(50) NOT NULL,
  `drug_inject_unit2` varchar(50) NOT NULL,
  `drug_inject_time` varchar(50) NOT NULL,
  `drug_inject_slip` varchar(50) NOT NULL,
  `drug_inject_type` varchar(50) NOT NULL,
  `drug_inject_etc` varchar(50) NOT NULL,
  `status` varchar(3) default 'Y',
  `drug_status` varchar(20) NOT NULL,
  `mainstk` int(8) NOT NULL,
  `reject` varchar(2) NOT NULL,
  `datedr` varchar(20) NOT NULL,
  `DSY` varchar(10) NOT NULL,
  `DSN` varchar(10) NOT NULL,
  PRIMARY KEY  (`row_id`),
  KEY `date` (`date`),
  KEY `idno` (`idno`),
  KEY `hn` (`hn`),
  KEY `part` (`part`),
  KEY `drugcode` (`drugcode`)
) ENGINE=MyISAM AUTO_INCREMENT=8431357 DEFAULT CHARSET=utf8;
