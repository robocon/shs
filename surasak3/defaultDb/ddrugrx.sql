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
# โครงสร้างตาราง `ddrugrx`
#

CREATE TABLE `ddrugrx` (
  `row_id` int(11) NOT NULL auto_increment,
  `date` varchar(30) default NULL,
  `hn` varchar(12) default NULL,
  `an` varchar(12) default NULL,
  `drugcode` varchar(10) default NULL,
  `tradname` varchar(40) default NULL,
  `salepri` double(10,2) NOT NULL default '0.00',
  `freepri` double(10,2) NOT NULL default '0.00',
  `amount` int(6) default NULL,
  `price` double(10,2) default NULL,
  `item` int(2) default NULL,
  `slcode` varchar(20) default NULL,
  `part` varchar(8) default NULL,
  `idno` int(11) NOT NULL default '0',
  `drug_inject_amount` varchar(50) default NULL,
  `drug_inject_unit` varchar(50) NOT NULL,
  `drug_inject_amount2` varchar(50) NOT NULL,
  `drug_inject_unit2` varchar(50) NOT NULL,
  `drug_inject_time` varchar(50) NOT NULL,
  `drug_inject_slip` varchar(50) default NULL,
  `drug_inject_type` varchar(50) default NULL,
  `drug_inject_etc` varchar(50) default NULL,
  `office` varchar(50) default NULL,
  `reason` varchar(100) NOT NULL,
  `drug_return` varchar(1) NOT NULL default '0',
  `DPY` varchar(10) NOT NULL,
  `DPN` varchar(10) NOT NULL,
  `drugorderdr` int(6) NOT NULL default '0',
  `date_notsk` varchar(30) NOT NULL,
  `injno` varchar(20) NOT NULL,
  `indicator` varchar(20) NOT NULL,
  PRIMARY KEY  (`row_id`),
  KEY `date` (`date`),
  KEY `idno` (`idno`),
  KEY `drugcode` (`drugcode`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=4845615 DEFAULT CHARSET=utf8;
