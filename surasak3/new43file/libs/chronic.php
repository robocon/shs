<?php

$sql = "SELECT '11512' AS `HOSPCODE`, 
x.`hn` AS `PID`, 
REPLACE(x.`thidate`, '-', '') AS `DATE_DIAG`, 
s.`icd10` AS `CHRONIC`, 
'' AS `HOSP_DX`, 
'' AS `HOSP_RX`, 
'' AS `DATE_DISCH`, 
'03' AS `TYPEDISCH`, 
REPLACE(
	REPLACE( 
		REPLACE( 
			CONCAT((SUBSTRING(s.`thidate`, 1, 4) - 543), SUBSTRING(s.`thidate`, 5, 15)), 
			'-', 
			'' 
		), 
		':', 
		''
	), 
	' ', 
	'' 
) AS `D_UPDATE` 
 FROM (
	SELECT a.hn,a.dateN,a.thidate
	FROM diabetes_clinic AS a 
	WHERE a.thidate LIKE '$yrmonth%'
	UNION
	SELECT b.hn,b.dateN,b.thidate
	FROM hypertension_clinic AS b 
	WHERE b.thidate LIKE '$yrmonth%'
) AS x
LEFT JOIN (
	SELECT hn,icd10,thidate FROM opday WHERE thidate like '$thimonth%' AND ( icd10 LIKE 'I%' OR icd10 LIKE 'e%' )
) AS s ON s.hn = x.hn 
WHERE s.`icd10` IS NOT NULL;";

$q = mysql_query($sql) or die( mysql_query() );

$txt = "";
while ( $item = mysql_fetch_assoc($q) ) {
	$txt .= $item['HOSPCODE'].'|'.
	$item['PID'].'|'.
	$item['DATE_DIAG'].'|'.
	$item['CHRONIC'].'|'.
	$item['HOSP_DX'].'|'.
	$item['HOSP_RX'].'|'.
	$item['DATE_DISCH'].'|'.
	$item['TYPEDISCH'].'|'.
	$item['D_UPDATE']."\r\n";
}

$filePath = $dirPath.'/chronic.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|DATE_DIAG|CHRONIC|HOSP_DX|HOSP_RX|DATE_DISCH|TYPEDISCH|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_chronic.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม CHRONIC เสร็จเรียบร้อย";