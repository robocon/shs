<?php

$sql = "SELECT '11512' AS `HOSPCODE`, 
`opcard_id` AS `HID`, 
'' AS `HOUSE_ID`, 
'01' AS `HOUSETYPE`, 
'' AS `ROOMNO`, 
'' AS `CONDO`, 
'' AS `HOUSE`, 
'' AS `SOISUB`, 
'' AS `SOIMAIN`, 
'' AS `ROAD`, 
'' AS `VILLANAME`, `moo` AS `VILLAGE`, 
`tambon` AS `TAMBON`, 
`amphoe` AS `AMPUR`, 
`province` AS `CHANGWAT`, 
'' AS `TELEPHONE`, 
'' AS `LATITUDE`, 
'' AS `LONGITUDE`, 
'' AS `NFAMILY`, 
'01' AS `LOCATYPE`, 
'' AS `VHVID`, 
'' AS `HEADID`, 
'' AS `TOILET`, 
'' AS `WATER`, 
'' AS `WATERTYPE`, 
'' AS `GARBAGE`, 
'' AS `HOUSING`, 
'' AS `DURABILITY`, 
'' AS `CLEANLINESS`, 
'' AS `VENTILATION`, 
'' AS `LIGHT`, 
'' AS `WATERTM`, 
'' AS `MFOOD`, 
'' AS `BCONTROL`, 
'' AS `ACONTROL`, 
'' AS `CHEMICAL`, 
'' AS `OUTDATE`, 
`update` AS `D_UPDATE` 
FROM `pre_home` ";
$q = mysql_query($sql) or die( mysql_error() );

$txt = '';
while ( $item = mysql_fetch_assoc($q) ) {
	$txt .= $item['HOSPCODE'].'|'.$item['HID'].'|'.$item['HOUSE_ID'].'|'.$item['HOUSETYPE'].'|'.$item['ROOMNO'].'|'.$item['CONDO'].'|';
	$txt .= $item['HOUSE'].'|'.$item['SOISUB'].'|'.$item['SOIMAIN'].'|'.$item['ROAD'].'|'.$item['VILLANAME'].'|'.$item['VILLAGE'].'|';
	$txt .= $item['TAMBON'].'|'.$item['AMPUR'].'|'.$item['CHANGWAT'].'|'.$item['TELEPHONE'].'|'.$item['LATITUDE'].'|'.$item['LONGITUDE'].'|';
	$txt .= $item['NFAMILY'].'|'.$item['LOCATYPE'].'|'.$item['VHVID'].'|'.$item['HEADID'].'|'.$item['TOILET'].'|'.$item['WATER'].'|';
	$txt .= $item['WATERTYPE'].'|'.$item['GARBAGE'].'|'.$item['HOUSING'].'|'.$item['DURABILITY'].'|'.$item['CLEANLINESS'].'|'.$item['VENTILATION'].'|';
	$txt .= $item['LIGHT'].'|'.$item['WATERTM'].'|'.$item['MFOOD'].'|'.$item['BCONTROL'].'|'.$item['ACONTROL'].'|'.$item['CHEMICAL'].'|';
	$txt .= $item['OUTDATE'].'|'.$item['D_UPDATE']."\r\n";
}

$filePath = $dirPath.'/home.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|HID|HOUSE_ID|HOUSETYPE|ROOMNO|CONDO|HOUSE|SOISUB|SOIMAIN|ROAD|VILLANAME|VILLAGE|TAMBON|AMPUR|CHANGWAT|TELEPHONE|LATITUDE|LONGITUDE|NFAMILY|LOCATYPE|VHVID|HEADID|TOILET|WATER|WATERTYPE|GARBAGE|HOUSING|DURABILITY|CLEANLINESS|VENTILATION|LIGHT|WATERTM|MFOOD|BCONTROL|ACONTROL|CHEMICAL|OUTDATE|D_UPDATE";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_home.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม home เสร็จเรียบร้อย<br>";