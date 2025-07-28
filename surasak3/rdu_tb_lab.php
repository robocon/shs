<?php
$sqlTmpBaseCrea = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_base_crea`
(
`autonumber` INT(11),
`orderdate` VARCHAR(20) CHARACTER SET utf8,
`hn` VARCHAR(10) CHARACTER SET utf8,
`sex` VARCHAR(5) CHARACTER SET utf8,
`result` VARCHAR(255) CHARACTER SET utf8,
`age` VARCHAR(10) CHARACTER SET utf8,
`thdatehn` VARCHAR(20) CHARACTER SET utf8,
KEY `hn` (`hn`),
KEY `thdatehn` (`thdatehn`)
)
SELECT b.`autonumber`,b.`orderdate`,b.`hn`,b.`sex`,c.`result`,
TIMESTAMPDIFF(YEAR, thDateToEn(d.`dbirth`), SUBSTRING(b.`orderdate`, 1, 10)) AS `age`, 
CONCAT(SUBSTRING(b.`orderdate`,9,2),'-',SUBSTRING(b.`orderdate`,6,2),'-',SUBSTRING(b.`orderdate`,1,4),b.`hn`) AS `thdatehn`
FROM ( 
	SELECT MAX(`autonumber`) AS `latest_id`
	FROM `resulthead` 
	WHERE (`orderdate` >= '$date_start 00:00:00' AND `orderdate` <= '$date_end 23:59:59' ) 
	AND ( `profilecode` = 'CREA' OR `profilecode` = 'CREAG' ) 
	GROUP BY CONCAT(SUBSTRING(`orderdate`,9,2),'-',SUBSTRING(`orderdate`,6,2),'-',SUBSTRING(`orderdate`,1,4),`hn`)
) AS a 
LEFT JOIN `resulthead` AS b ON b.`autonumber` = a.`latest_id` 
LEFT JOIN `resultdetail` AS c ON c.`autonumber` = a.`latest_id` 
LEFT JOIN `opcard` AS d ON d.`hn` = b.`hn` 
WHERE c.`labcode` = 'GFR' 
AND (c.`result` != '*' AND c.`result` NOT LIKE '%-%') 
GROUP BY CONCAT(SUBSTRING(b.`orderdate`,9,2),'-',SUBSTRING(b.`orderdate`,6,2),'-',SUBSTRING(b.`orderdate`,1,4),b.`hn`)
ORDER BY b.`autonumber` ASC ";
$res = $db->exec($sqlTmpBaseCrea);
if($res['error']){
    echo 'tmp_base_crea : '.$res['error'];
    exit;
}