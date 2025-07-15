<?php
/**
 * ข้อมูลจาก drugrx 
 * - จำนวน(amount) ต้องมากกว่า 0
 * - สถานะต้องเป็น Y
 */
$sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_base_drugrx` (
`row_id` INT(11),
`date` VARCHAR(20) CHARACTER SET utf8,
`hn` VARCHAR(20) CHARACTER SET utf8,
`an` VARCHAR(20) CHARACTER SET utf8,
`part` VARCHAR(5) CHARACTER SET utf8,
`drugcode` VARCHAR(20) CHARACTER SET utf8,
`tradname` VARCHAR(255) CHARACTER SET utf8,
`thdatehn` VARCHAR(20) CHARACTER SET utf8,
`idno` VARCHAR(10),
`amount` VARCHAR(11),
`ptname` VARCHAR(255) CHARACTER SET utf8,
`doctor` VARCHAR(255) CHARACTER SET utf8,
`diag` VARCHAR(255) CHARACTER SET utf8,
`age` VARCHAR(100) CHARACTER SET utf8,
KEY `hn` (`hn`),
KEY `part` (`part`),
KEY `drugcode` (`drugcode`),
KEY `thdatehn` (`thdatehn`)
)
SELECT a.`row_id`,a.`date`,a.`hn`,a.`an`,a.`part`,a.`drugcode`,a.`tradname`,
CONCAT(SUBSTRING(a.`date`,9,2),'-',SUBSTRING(a.`date`,6,2),'-',SUBSTRING(a.`date`,1,4),a.`hn`) AS `thdatehn`,a.`idno`,a.`amount`,
b.`ptname`,b.`doctor`,b.`diag`,c.`age`
FROM `drugrx` AS a 
LEFT JOIN `phardep` AS b ON a.`idno` = b.`row_id`
LEFT JOIN `opday` AS c ON c.`thdatehn` = CONCAT(SUBSTRING(a.`date`,9,2),'-',SUBSTRING(a.`date`,6,2),'-',SUBSTRING(a.`date`,1,4),a.`hn`) 
WHERE ( a.`date` >= '$dateStartTh' AND a.`date` <= '$dateEndTh' ) 
AND a.`amount` > 0 AND a.`status` = 'y' ;";
$res = $db->exec($sql);
if($res['error']){
    echo 'tmp_base_drugrx : '.$res['error'];
    exit;
}