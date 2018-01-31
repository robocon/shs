<?php
/*
ตาม สนย
ความดันโลหิตสูง		i10-i15
เบาหวาน			e10-e14
หอบหืด			j45
หัวใจขาดเลือด	i20-i25
มะเร็ง			c00-d48
โลหิตจาง		d50-d64
โรคซึมเศร้า		f30-f39
หลอดเลือดสมอง	i60-i69
อัมพฤกษ์ อัมพาต g80-g83
ไตวาย			n17-n19
หลอดลมอักเสบเรื้อรัง	j42
ถุงลมโป่งพอง	j43
ทางเดินหายใจอุดกั้นเรื้อรัง		j44
โรคหัวใจ 		i05-i09 + i26-i28 + i30-i52
พิษสุราเรื้อรัง		f10.0 + f10.2
วัณโรค			a15-a19
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
	`icd10` regexp 'i1[0-5]' 
	OR `icd10` regexp 'e1[0-4]' 
	OR `icd10` = 'j45' 
	OR `icd10` regexp 'i2[0-5]' 
	OR `icd10` regexp 'c[0-9][0-9]' OR `icd10` regexp 'd[0-3][0-9]' OR `icd10` regexp 'd4[0-8]' 
	OR `icd10` regexp 'd5[0-9]' OR `icd10` regexp 'd6[0-4]' 
	OR `icd10` regexp 'f3[0-9]' 
	OR `icd10` regexp 'i6[0-9]' 
	OR `icd10` regexp 'g8[0-3]' 
	OR `icd10` regexp 'n1[7-9]' 
	OR `icd10` regexp 'j4[2-4]' 
	OR `icd10` regexp 'i0[5-9]' OR `icd10` regexp 'i2[6-8]' OR `icd10` regexp 'i[3-5][0-9]' OR `icd10` regexp 'i5[1-2]' 
	OR `icd10` = 'f10.0' OR `icd10` = 'f10.2' 
	OR `icd10` regexp 'a1[5-9]' 
) 
GROUP BY `hn`;";

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

echo "สร้างแฟ้ม CHRONIC เสร็จเรียบร้อย<br>";