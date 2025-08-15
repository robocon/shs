<?php
/**
 * ข้อมูลจาก drugrx 
 * - จำนวน(amount) ต้องมากกว่า 0
 * - สถานะต้องเป็น Y
 */
$sqlTmpBaseDrugrx = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_base_drugrx` (
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
SELECT a.*, b.`ptname`,b.`doctor`,b.`diag`,c.`age`
FROM ( 
    SELECT `row_id`,`date`,`hn`,`an`,`part`,`drugcode`,`tradname`,`idno`,`amount`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn` 
    FROM `drugrx` 
    WHERE `date` LIKE '$yearMonthTH%' 
    AND ( `amount` > 0 AND `status` = 'y' ) 
    AND ( `an` IS NULL OR TRIM(`an`) = '')
) AS a 
LEFT JOIN `phardep` AS b ON a.`idno` = b.`row_id`
LEFT JOIN `tmp_base_opday` AS c ON c.`thdatehn` = a.`thdatehn`;";
dump($sqlTmpBaseDrugrx);
$res = $db->exec($sqlTmpBaseDrugrx);
dump($res);
if($res['error']){
    echo 'tmp_base_drugrx : '.$res['error'];
    exit;
}