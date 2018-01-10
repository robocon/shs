<?php 
// DROP TEMPORARY TABLE IF EXISTS tmp_inputm;
$sql = "CREATE TEMPORARY TABLE tmp_inputm 
(INDEX ptname (ptname))
SELECT `row_id`,`name`,`menucode`,`date_pword`, REPLACE( 
	REPLACE( 
		REPLACE( 
			REPLACE( 
				REPLACE( 
					REPLACE( `name`, 'จ.ส.อ.', '' ), 
					'น.ส.', 
					'' 
				), 
				'นางสาว', 
				'' 
			), 
			'นาง', 
			'' 
		), 
		'นาย', 
		'' 
	), 
	' ', 
	''
) AS `ptname` 
FROM `inputm` 
WHERE `level` != 'dr' 
AND `level` != 'intern' 
AND ( 
	`menucode` != 'ADMDR1' 
	AND `menucode` != 'ADM' 
	AND `menucode` != 'ADMCOM' 
	AND `menucode` != 'ADMcom1' 
	AND `menucode` != 'ADMCHKOUT' 
	AND `menucode` != 'ADM43FILE' 
	AND `menucode` != 'ADMCHKUP1' 
	AND `menucode` != 'ADMOPD' 
) 
AND `status` = 'Y' 
ORDER BY `row_id` ASC;";
$q = mysql_query($sql) or die( mysql_error() );

// DROP TEMPORARY TABLE IF EXISTS tmp_opcard;
$sql = "CREATE TEMPORARY TABLE tmp_opcard 
(INDEX fullname (fullname))
SELECT `idcard`,`yot`,`name`,`surname`,IF( TRIM(`sex`) = 'ช', '1', '2') AS `sex`,`dbirth`,`regisdate`,`lastupdate`, CONCAT(`name`,`surname`) AS `fullname` 
FROM `opcard` 
WHERE ( `idcard` != '' AND `idcard` != '-' ) 
AND ( `idguard` NOT LIKE 'MX04%' AND `idguard` NOT LIKE 'MX07%' );";
mysql_query($sql) or die( mysql_error() );

$sql = "SELECT '11510' AS `HOSPCODE`, 
a.`row_id` AS `PROVIDER`, 
'' AS `REGISTERNO`, 
'' AS `CONCIL`, 
b.`idcard` AS `CID`, 
b.`yot` AS `PRENAME`, 
b.`name` AS `NAME`, 
b.`surname` AS `LNAME`, 
`sex` AS `SEX`, 
thDateToEn(b.`dbirth`) AS `BIRTH`, 
'09' AS `PROVIDERTYPE`,
REPLACE(SUBSTRING(b.`regisdate`,1,10),'-','') AS `STARTDATE`, 
'' AS `OUTDATE`, 
'' AS `MOVEFROM`, 
'' AS `MOVETO`, 
thDateTimeToEn(b.`lastupdate`) AS `D_UPDATE` 
FROM `tmp_inputm` AS a 
LEFT JOIN `tmp_opcard` AS b ON b.`fullname` = a.`ptname` 
WHERE b.`idcard` IS NOT NULL 
ORDER BY a.`row_id`;";
$q = mysql_query($sql) or die( mysql_error() );

$txt = '';
while ( $item = mysql_fetch_assoc($q) ) {
	$txt .= $item['HOSPCODE'].'|'.$item['PROVIDER'].'|';
	$txt .= $item['REGISTERNO'].'|'.$item['CONCIL'].'|';
	$txt .= $item['CID'].'|'.$item['PRENAME'].'|';
	$txt .= $item['NAME'].'|'.$item['LNAME'].'|';
	$txt .= $item['SEX'].'|'.$item['BIRTH'].'|';
	$txt .= $item['PROVIDERTYPE'].'|'.$item['STARTDATE'].'|';
	$txt .= $item['OUTDATE'].'|'.$item['MOVEFROM'].'|';
	$txt .= $item['MOVETO'].'|'.$item['D_UPDATE']."\r\n";
}

// @todo ค้างของหมอ







$filePath = $dirPath.'/provider.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PROVIDER|REGISTERNO|CONCIL|CID|PRENAME|NAME|LNAME|SEX|BIRTH|PROVIDERTYPE|STARTDATE|OUTDATE|MOVEFROM|MOVETO|D_UPDATE\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_provider.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม provider เสร็จเรียบร้อย";