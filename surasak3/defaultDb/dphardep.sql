# phpMyAdmin SQL Dump
# version 2.5.6
# http://www.phpmyadmin.net
#
# ��ʵ�: localhost
# ����㹡�����ҧ: 16 ��.�. 2020  16:18�.
# ��蹢ͧ���������: 5.0.77
# ��蹢ͧ PHP: 5.1.6
# 
# �ҹ������ : `smdb`
# 

# --------------------------------------------------------

#
# �ç���ҧ���ҧ `dphardep`
#

CREATE TABLE `dphardep` (
  `row_id` int(11) NOT NULL auto_increment,
  `chktranx` int(11) default NULL,
  `date` varchar(30) default NULL,
  `ptname` varchar(40) default NULL,
  `hn` varchar(12) default NULL,
  `an` varchar(12) default NULL,
  `price` double(12,2) default NULL,
  `paid` double(12,2) NOT NULL default '0.00',
  `doctor` varchar(40) default NULL,
  `item` int(2) default NULL,
  `idname` varchar(50) default NULL,
  `diag` varchar(48) default NULL,
  `essd` double(10,2) default NULL,
  `nessdy` double(10,2) default NULL,
  `nessdn` double(10,2) default NULL,
  `dpy` double(10,2) default NULL,
  `dpn` double(10,2) default NULL,
  `accno` int(4) default NULL,
  `dsy` double(10,2) default NULL,
  `dsn` double(10,2) default NULL,
  `dgtake` datetime default NULL,
  `tvn` varchar(12) default NULL,
  `ptright` varchar(40) default NULL,
  `whokey` varchar(8) default NULL,
  `stkcutdate` varchar(30) default NULL,
  `dr_cancle` char(1) default NULL,
  `kew` varchar(4) default NULL,
  `pharin` varchar(30) default NULL,
  `pharout` varchar(30) default NULL,
  `kewphar` varchar(20) NOT NULL default '',
  `pharout1` varchar(30) NOT NULL,
  `department` varchar(5) NOT NULL,
  PRIMARY KEY  (`row_id`),
  UNIQUE KEY `chktranx` (`chktranx`),
  KEY `date` (`date`),
  KEY `hn` (`hn`)
) ENGINE=MyISAM AUTO_INCREMENT=1428821 DEFAULT CHARSET=utf8;
