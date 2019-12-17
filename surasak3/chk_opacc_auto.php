<?php 

include 'bootstrap.php';

$db = Mysql::load();

SELECT a.* 
FROM `log_opcardchk` AS a 
WHERE a.`part` = 'สอบตำรวจ63' 

$Thidate2 =(date("Y")+543).date("-m-d H:i:s");
$depart = "OTHER";
$detail = "ค่าบริการตรวจสุขภาพตำรวจ";
$price = 880;
$paid  = 880;
$idname='นางพวงเพ็ชร โนใจปิง';
$credit="เงินสด";

$sql = "INSERT INTO `opacc` ( 
    `date` , `txdate` , `hn` , `depart` , `detail` , 
    `price` , `paid` , `idname` , `credit` , `ptright` , 
    `credit_detail` , `billno`
) VALUES ( 
    '$Thidate2', '$Thidate2', '$hn', '$depart', '$detail', 
    '$price', '$paid', '$idname',  '$credit', 'R01 เงินสด', 
    '', '$billno'
);";
	