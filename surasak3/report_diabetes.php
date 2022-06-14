<?php 
$dbi = new mysqli('192.168.131.250','remoteuser','','sm3report');

$sql = "SELECT a.* FROM ( SELECT * FROM `opday` WHERE `endate` >= '2022-10-01' AND `endate` <= '2022-09-31' ) AS a 
LEFT JOIN ( 
    SELECT * FROM `resulthead` WHERE `endate` >= '2022-10-01' AND `endate` <= '2022-09-31' 
) AS b ON b.`endatehn` = a.`endatehn` 
LEFT JOIN ( 
    SELECT id,hn FROM `diabetes_user` 
) AS c ON c.hn = a.hn 
WHERE c.id IS NULL";