<?php 

/*
DROP TABLE IF EXISTS `hemo_checkout`;
CREATE TABLE `hemo_checkout` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `input_id` int(11) DEFAULT NULL,
  `input_name` varchar(255) DEFAULT NULL,
  `date` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `depart` tinyint(4) DEFAULT NULL,
  `depart_detail` varchar(255) DEFAULT NULL,
  `date_edit` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `input_id` (`input_id`),
  KEY `input_name` (`input_name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
*/

include 'bootstrap.php';


