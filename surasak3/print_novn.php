<?php

include 'bootstrap.php';

$db = Mysql::load();

/**
 * hn
 * date appoint
 * 
 */
$hn = input_get('hn');

/*
$date_appoint = urldecode(input_get('date_appoint'));
$sql = "SELECT * 
FROM `appoint` 
WHERE `hn` = '$hn' 
AND `appdate` = '$date_appoint' 
AND `apptime` != 'ยกเลิกการนัด' 
LIMIT 1;";
$db->select($sql);
$items = $db->get_items();
*/

$sql = "SELECT *, CONCAT(`yot`,' ',`name`,' ',`surname`) AS `ptname` FROM opcard WHERE hn = '$hn';";
$db->select($sql);
$item = $db->get_item();

$cHn = $item['hn'];
$cYot = $item['yot'];
$cName = $item['name'];
$cSurname = $item['surname'];
$cPtname = $item['ptname'];
$cPtright = $item['ptright'];
$cGoup = $item['goup'];
$cCamp = $item['camp'];
$cNote = $item['note'];
$cAge = $item['dbirth'];
$cIdguard = $item['idguard'];
$cIdcard = $item['idcard'];

?>
<meta http-equiv="refresh" content="0;URL=vnprint.php?toborow=EX10 ไตเทียม" />





