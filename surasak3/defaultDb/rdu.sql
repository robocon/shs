# phpMyAdmin SQL Dump
# version 2.5.6
# http://www.phpmyadmin.net
#
# ��ʵ�: localhost
# ����㹡�����ҧ: 14 ��.�. 2020  12:39�.
# ��蹢ͧ���������: 5.0.95
# ��蹢ͧ PHP: 5.3.29
# 
# �ҹ������ : `rdu`
# 

# --------------------------------------------------------

#
# �ç���ҧ���ҧ `diag`
#

CREATE TABLE `diag` (
  `id` int(11) NOT NULL auto_increment,
  `diag_id` bigint(20) default NULL,
  `svdate` varchar(50) default NULL,
  `hn` varchar(20) default NULL,
  `ptname` varchar(255) default NULL,
  `age` int(11) default NULL,
  `an` varchar(20) default NULL,
  `diag` varchar(255) default NULL,
  `icd10` varchar(10) default NULL,
  `type` varchar(50) default NULL,
  `doctor` varchar(255) default NULL,
  `date_hn` varchar(100) default NULL,
  `date_generate` datetime default NULL,
  `quarter` tinyint(4) default NULL,
  `year` int(4) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=713040 DEFAULT CHARSET=utf8 AUTO_INCREMENT=713040 ;

# --------------------------------------------------------

#
# �ç���ҧ���ҧ `drugrx`
#

CREATE TABLE `drugrx` (
  `id` bigint(20) NOT NULL auto_increment,
  `row_id` bigint(20) NOT NULL,
  `date` varchar(255) NOT NULL,
  `hn` varchar(255) NOT NULL,
  `drugcode` varchar(255) NOT NULL,
  `part` varchar(255) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date_hn` varchar(255) NOT NULL,
  `date_generate` datetime NOT NULL,
  `quarter` tinyint(1) NOT NULL,
  `year` varchar(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date_hn` USING BTREE (`date_hn`)
) ENGINE=MyISAM AUTO_INCREMENT=1172982 DEFAULT CHARSET=utf8 AUTO_INCREMENT=1172982 ;

# --------------------------------------------------------

#
# �ç���ҧ���ҧ `lab`
#

CREATE TABLE `lab` (
  `id` int(11) NOT NULL auto_increment,
  `autonumber` int(11) NOT NULL,
  `orderdate` datetime NOT NULL,
  `hn` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `egfr` varchar(255) NOT NULL,
  `date_hn` varchar(255) NOT NULL,
  `quarter` tinyint(1) NOT NULL,
  `year` varchar(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date_hn` (`date_hn`)
) ENGINE=MyISAM AUTO_INCREMENT=74356 DEFAULT CHARSET=utf8 AUTO_INCREMENT=74356 ;

# --------------------------------------------------------

#
# �ç���ҧ���ҧ `opday`
#

CREATE TABLE `opday` (
  `id` bigint(20) NOT NULL auto_increment,
  `row_id` bigint(20) NOT NULL,
  `date` varchar(255) NOT NULL,
  `hn` varchar(255) NOT NULL,
  `ptname` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `age` varchar(255) NOT NULL,
  `diag` varchar(255) NOT NULL,
  `icd10` varchar(255) NOT NULL,
  `doctor` varchar(255) NOT NULL,
  `toborow` varchar(50) default NULL,
  `date_hn` varchar(255) NOT NULL,
  `date_generate` datetime NOT NULL,
  `quarter` tinyint(1) NOT NULL,
  `year` varchar(4) NOT NULL,
  PRIMARY KEY  (`id`),
  KEY `date_hn` USING BTREE (`date_hn`)
) ENGINE=MyISAM AUTO_INCREMENT=594374 DEFAULT CHARSET=utf8 AUTO_INCREMENT=594374 ;

# --------------------------------------------------------

#
# �ç���ҧ���ҧ `trauma`
#

CREATE TABLE `trauma` (
  `id` bigint(20) NOT NULL auto_increment,
  `trauma_id` int(11) NOT NULL,
  `date` varchar(50) default NULL,
  `hn` varchar(50) default NULL,
  `ptright` varchar(10) default NULL,
  `dx` longtext,
  `organ` longtext,
  `maintenance` longtext,
  `cure` varchar(30) default NULL,
  `doctor` varchar(50) default NULL,
  `trauma` varchar(10) default NULL,
  `type_wounded` varchar(10) default NULL,
  `type_wounded2` varchar(10) default NULL,
  `date_hn` varchar(50) default NULL,
  `quarter` tinyint(4) default NULL,
  `year` int(11) default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=29620 DEFAULT CHARSET=utf8 AUTO_INCREMENT=29620 ;
