<?php
include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT `code`,`detail`,COUNT(`code`) AS `rows` 
FROM  `patdata` 
WHERE ( `date` >= '2556-10-01' AND `date` <= '2557-09-30' )  
AND `depart` = 'EYE' 
AND ( `doctor` LIKE  'MD089%' OR `doctor` LIKE  'MD065%' ) 
GROUP BY `code` 
ORDER BY COUNT(`code`) DESC";
$db->select($sql);

$items = $db->get_items();

dump($items);