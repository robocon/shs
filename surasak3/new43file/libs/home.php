<?php

$sql = "SELECT '11512' AS `HOSPCODE`, `opcard_id` AS `HID`, '' AS `HOUSE_ID`, '01' AS `HOUSETYPE`, '' AS `ROOMNO`, '' AS `CONDO`, 
'' AS `HOUSE`, '' AS `SOISUB`, '' AS `SOIMAIN`, '' AS `ROAD`, '' AS `VILLANAME`, `moo` AS `VILLAGE`, 
`tambon` AS `TAMBON`, `amphoe` AS `AMPUR`, `province` AS `CHANGWAT`, '' AS `TELEPHONE`, '' AS `LATITUDE`, '' AS `LONGITUDE`, 
'' AS `NFAMILY`, '01' AS `LOCATYPE`, '' AS `VHVID`, '' AS `HEADID`, '' AS `TOILET`, '' AS `WATER`, 
'' AS `WATERTYPE`, '' AS `GARBAGE`, '' AS `HOUSING`, '' AS `DURABILITY`, '' AS `CLEANLINESS`, '' AS `VENTILATION`, 
'' AS `LIGHT`, '' AS `WATERTM`, '' AS `MFOOD`, '' AS `BCONTROL`, '' AS `ACONTROL`, '' AS `CHEMICAL`, 
'' AS `OUTDATE`, `update` AS `D_UPDATE` 
FROM `home` ";
$q = mysql_query($q) or die( mysql_error() );

$txt = '';
while ( $item = mysql_fetch_assoc($q) ) {
	$item[''];'
}