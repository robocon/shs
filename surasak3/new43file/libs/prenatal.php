<?php 

$sql = "SELECT '11512' AS `HOSPCODE`,
`hn` AS `PID`, 
'' AS `GRAVIDA`, 
'' AS `LMP`, 
'' AS `EDC`, 
'' AS `VDRL_RESULT`, 
'' AS `HB_RESULT`, 
'' AS `HIV_RESULT`, 
'' AS `DATE_HCT`, 
'' AS `HCT_RESULT`, 
'' AS `THALASSEMIA`, 
thDateTimeToEn(`thidate`) AS `D_UPDATE`, 
CONCAT(thDateToEn(`thidate`), LPAD(`vn`, 3, 0),'0000') AS `PROVIDER`, 
`idcard` AS `CID` 
FROM `opday` 
WHERE `thidate` LIKE '2561-08%' 
AND `toborow` LIKE 'ex08%' ";





// เทสว่ามีแลปอะไรบ้าง
/*
SELECT b.* 
FROM (
    SELECT '11512' AS `HOSPCODE`,
    `hn` AS `PID`, 
    '' AS `GRAVIDA`, 
    '' AS `LMP`, 
    '' AS `EDC`, 
    '' AS `VDRL_RESULT`, 
    '' AS `HB_RESULT`, 
    '' AS `HIV_RESULT`, 
    '' AS `DATE_HCT`, 
    '' AS `HCT_RESULT`, 
    '' AS `THALASSEMIA`, 
    thDateTimeToEn(`thidate`) AS `D_UPDATE`, 
    CONCAT(thDateToEn(`thidate`), LPAD(`vn`, 3, 0),'0000') AS `PROVIDER`, 
    `idcard` AS `CID` 
    FROM `opday` 
    WHERE `thidate` LIKE '2561-08%' 
    AND `toborow` LIKE 'ex08%'
) AS a 
LEFT JOIN ( 
    SELECT * FROM `orderhead` WHERE `orderdate` LIKE '2018-08%' 
) AS b ON b.`hn` = a.`PID` 
*/