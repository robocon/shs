<?php
$sqlTmpBaseTrauma = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_base_trauma`
(
`row_id` INT(11),
`hn` VARCHAR(20) CHARACTER SET utf8,
`date` VARCHAR(10) CHARACTER SET utf8,
`organ` VARCHAR(255) CHARACTER SET utf8,
`maintenance` VARCHAR(255) CHARACTER SET utf8,
`doctor` VARCHAR(255) CHARACTER SET utf8,
`thdatehn` VARCHAR(20) CHARACTER SET utf8,
KEY `hn` (`hn`),
KEY `thdatehn` (`thdatehn`)
)
SELECT `row_id`,`hn`,`date`,`organ`,`maintenance`,`doctor`,CONCAT(SUBSTRING(`date`,9,2),'-',SUBSTRING(`date`,6,2),'-',SUBSTRING(`date`,1,4),`hn`) AS `thdatehn`
FROM `trauma` 
WHERE ( `date` >= '$dateStartTh' AND `date` <= '$dateEndTh' ) 
AND `an` = '' ;";
$res = $db->exec($sqlTmpBaseTrauma);
if($res['error']){
    echo 'tmp_base_trauma : '.$res['error'];
    exit;
}