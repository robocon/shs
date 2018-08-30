<?php 

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );
mysql_query("SET NAMES UTF8", $db2);

$sql = "SELECT 
'' AS `HOSPCODE`, 
'' AS `PID`, 
'' AS `SEQ`, 
'' AS `DATE_SERV`, 
'' AS `LABTEST`, 
'' AS `LABRESULT`, 
'' AS `D_UPDATE`, 
'' AS `LABPLACE`, 
'' AS `CID` 
FROM xxxx ";



SELECT 
'11512' AS `HOSPCODE`, 
'' AS `PID`, 
'' AS `SEQ`, 
'' AS `DATE_SERV`, 
'' AS `LABTEST`, 
'' AS `LABRESULT`, 
'' AS `D_UPDATE`, 
'' AS `LABPLACE`, 
'' AS `CID` 
FROM ( 

    SELECT `thidate`,`hn`,`icd10`,CONCAT(toEn(SUBSTRING(`thidate`,1,10)),`hn`) AS `date_hn` 
    FROM `opday` 
    WHERE `thidate` LIKE '2561-08%' 
    AND ( `icd10` regexp 'I(1[0-5])' OR `icd10` regexp 'E(1[0-4])' ) 

) AS x 
LEFT JOIN ( 

    SELECT b.`result`, CONCAT(SUBSTRING(a.`orderdate`,1,10),a.`hn`) AS `date_hn`
    FROM `resulthead` AS a 
    LEFT JOIN `resultdetail` AS b ON b.`autonumber` = a.`autonumber` 
    WHERE a.`orderdate` LIKE '2018-08%' 
    AND ( a.`profilecode` = 'CREA' OR a.`profilecode` = 'CREAG' ) 
    AND b.`labname` = 'Creatinine' 
    
) AS y ON y.`date_hn` = x.`date_hn` 