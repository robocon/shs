<?php
/*
ตาม สนย
i10-i15
j45
i20-i25
c00-d48
d50-d64
f30-f39
i60-i69
g80-g83
n17-n19
e10-e14
j42
j43
i05-i09
i26-i28
i30-i52
f10.0
f10.2
j44
a15-a19
*/

/*
hosxp
e10-e14
i10-i15
i20-i25
j41-j44
i60-i64
*/
$sql = "SELECT '11512' AS `HOSPCODE`, 
`hn` AS `PID`, 
thDateToEn(SUBSTRING_INDEX(`thidate`, ' ', 1)) AS `DATE_DIAG`, 
`icd10` AS `CHRONIC`, 
'' AS `HOSP_DX`, 
'' AS `HOSP_RX`, 
'' AS `DATE_DISCH`, 
'03' AS `TYPEDISCH`, 
thDateTimeToEn(`thidate`) AS `D_UPDATE`
FROM `opday` 
WHERE `thidate` LIKE '$thimonth%' 
AND ( 
	`icd10` LIKE 'i10%' OR `icd10` LIKE 'i11%' OR `icd10` LIKE 'i12%' OR `icd10` LIKE 'i13%' OR `icd10` LIKE 'i14%' 
	OR `icd10` LIKE 'e10%' OR `icd10` LIKE 'e11%' OR `icd10` LIKE 'e12%' OR `icd10` LIKE 'e13%' OR `icd10` LIKE 'e14%' 
	OR `icd10` LIKE 'i20%' OR `icd10` LIKE 'i21%' OR `icd10` LIKE 'i22%' OR `icd10` LIKE 'i23%' OR `icd10` LIKE 'i24%' OR `icd10` LIKE 'i25%' 
	OR `icd10` LIKE 'j42%' OR `icd10` LIKE 'j43%' OR `icd10` LIKE 'j44%' 
	OR `icd10` LIKE 'i60%' OR `icd10` LIKE 'i61%' OR `icd10` LIKE 'i62%' OR `icd10` LIKE 'i63%' OR `icd10` LIKE 'i64%' 
) ;";

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