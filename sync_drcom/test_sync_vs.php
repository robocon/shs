#!/usr/local/bin/php
<?php

include 'config.php';

$sql = "SELECT * 
FROM `sync_vitalsign` 
WHERE `DATE_CREATE` LIKE  '$date_create%' 
AND `STATUS` IS NULL 
AND `V_VN` != '' 
GROUP BY `V_HN`,`V_VN`
ORDER BY `DATE_CREATE` ASC ";
$q = query($sql, $drcom);
$user_row = mysql_num_rows($q);

if( $user_row > 0 ){
	while ( $item = mysql_fetch_assoc($q) ) {
		// dump($item);
		$hn = $item['V_HN'];
		$date_hn = $th_date.$hn;
		$temp = $item['V_TEMP'];

		$sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn'";
		$q = query($sql, $shs);
		$user = mysql_fetch_assoc($q);

		$ptname = $user['ptname'];

		$sql = "INSERT INTO `opd` (
			`row_id` ,`thidate` ,`thdatehn`, `hn`, `ptname` ,
			`temperature` ,`pause` ,`rate` ,`weight` ,`bp1`  ,
			`bp2` ,`drugreact` ,`congenital_disease` ,`type` ,`organ` ,
			`doctor`, `officer`, `vn` , `toborow`, `height`, 
			`clinic`, `cigarette`, `alcohol`,`cigok`,`waist`,
			`chkup`,`room`,`painscore`,`age`
			)VALUES (
			NULL , '$th_date', '$date_hn', '$hn', '$ptname', 
			'$temp', '".$_POST["pause"]."', '".$_POST["rate"]."', '".$_POST["weight"]."', '".$_POST["bp1"]."', 
			'".$_POST["bp2"]."', '".$_POST["drugreact"]."', '".$_POST["congenital_disease"]."', '".$_POST["type"]."', '".$_POST["organ"]."', 
			'".$doctorname."', '".$_SESSION["sOfficer"]."', '".$_POST["vn"]."', '".$_POST["toborow"]."', '".$_POST["height"]."', 
			'".$_POST["clinic"]."', '".$_POST["cigarette"]."', '".$_POST["alcohol"]."', '".$_POST["member2"]."', '".$_POST["waist"]."', 
			'".$_POST["typediag"]."', '".$_POST["room"]."', '".$_POST["painscore"]."' ,'".$cAge."');";


	}
}