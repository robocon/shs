<?php 

$sql = "SELECT '11512' AS `HOSPCODE`,
`hn` AS `PID`, 
`vn` AS `SEQ`, 
thDateToEn(`thidate`) AS `DATE_SERV`, 
'' AS `GRAVIDA`, 
'' AS `ANCNO`, 
'' AS `GA`, 
'' AS `ANCRESULT`, 
'' AS `ANCPLACE`, 
CONCAT(thDateToEn(`thidate`), LPAD(`vn`, 3, 0),'0000') AS `PROVIDER`, 
thDateTimeToEn(`thidate`) AS `D_UPDATE`, 
`idcard` AS `CID`
FROM `opday` 
WHERE `thidate` LIKE '2561-08%' 
AND `toborow` LIKE 'ex08%' ";


