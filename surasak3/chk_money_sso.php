<?php 

include 'bootstrap.php';

$db = Mysql::load($shs_configs);

$part = input('part');

$sql = "SELECT a.* 
FROM `opcardchk` AS a 
LEFT JOIN `chk_company_list` AS c ON c.`code` = a.`part` 
LEFT JOIN `chk_doctor` AS b ON b.`hn` = a.`HN` 
WHERE a.`part` = '$part'  
AND b.`yearchk` = SUBSTRING(c.`yearchk`,3,2) 
ORDER BY a.`row`";
dump($sql);
$db->select($sql);
$items = $db->get_items();


dump($items);