<?php
/*
��� ʹ�
�����ѹ���Ե�٧		i10-i15
����ҹ			e10-e14
�ͺ�״			j45
���㨢Ҵ���ʹ	i20-i25
�����			c00-d48
���Ե�ҧ		d50-d64
�ä��������		f30-f39
��ʹ���ʹ��ͧ	i60-i69
����ġ�� ����ҵ g80-g83
����			n17-n19
��ʹ���ѡ�ʺ������ѧ	j42
�ا���觾ͧ	j43
�ҧ�Թ�����ش���������ѧ		j44
�ä���� 		i05-i09 + i26-i28 + i30-i52
�������������ѧ		f10.0 + f10.2
�ѳ�ä			a15-a19
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

echo "���ҧ��� CHRONIC �������º����<br>";