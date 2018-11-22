<?php 

$db2 = mysql_connect('192.168.1.13', 'dottwo', '') or die( mysql_error() );
mysql_select_db('smdb', $db2) or die( mysql_error() );

//
//-------------------- Create file charge_opd ไฟล์ที่ 18 --------------------//
// 
// $temp13="CREATE  TEMPORARY  TABLE report_chargeopd 
// SELECT `date`,`hn`,`depart`,`price`,`paid`,`essd`,`nessdy`,`nessdn`,`dpy`,`dpn`,`dsy`,`dsn`,`ptright`,`credit`,
// SUBSTRING(`date`, 1, 10) AS `date2`, `vn`
// FROM `opacc` 
// WHERE `date` like '$thimonth%' 
// AND ( `vn` IS NOT NULL AND `vn` != '' )
// GROUP BY SUBSTRING(`date`, 1, 10), `hn`
// ORDER BY `date` ASC";

// $querytmp13 = mysql_query($temp13) or die( mysql_error() );

// $sql13="SELECT *
// FROM report_chargeopd";
// $result13= mysql_query($sql13) or die( mysql_error() );
// $num = mysql_num_rows($result13);

$sql13="SELECT `date`,`hn`,`depart`,`price`,`paid`,`essd`,`nessdy`,`nessdn`,`dpy`,`dpn`,`dsy`,`dsn`,`ptright`,`credit`,
SUBSTRING(`date`, 1, 10) AS `date2`, `vn` 
FROM `opacc` 
WHERE `txdate` like '$thimonth%' 
AND ( `vn` IS NOT NULL AND `vn` != '' ) 
GROUP BY SUBSTRING(`date`, 1, 10), `hn` 
ORDER BY `date` ASC";
$result13= mysql_query($sql13, $db2) or die( mysql_error() );
$num = mysql_num_rows($result13);

$txt = '';

while (list ($date,$hn,$depart,$price,$paid,$essd,$nessdy,$nessdn,$dpy,$dpn,$dsy,$dsn,$ptright,$credit,$date2,$vn) = mysql_fetch_row ($result13)) {	

	$sqlpt=mysql_query("SELECT `ptrightdetail` FROM `opcard` WHERE `hn`='$hn'", $db2);
	list($ptrightdetail)=mysql_fetch_array($sqlpt);	

	list($chkdate) = explode(' ', $date);

	$qOpday = "SELECT `thidate`,`idcard` 
	FROM `opday` 
	WHERE `thidate` LIKE '$date2%' 
	AND `vn` = '$vn'";
	
	$sqlop = mysql_query($qOpday, $db2);
	list($thidate,$idcard) = mysql_fetch_array($sqlop);

	if( empty($thidate) ){
		$thidate = $date;
	}
	
	// $newclinic=substr($cliniccode,0,2);
	// if($newclinic=="" || $newclinic=="ศั"){ 
	// 	$newclinic = "99";
	// }else{
	// 	$newclinic = $newclinic;
	// }


	$test_match = preg_match('^\d{2}.+', $cliniccode, $matchs);
    if($test_match > 0){
        list($old_clinic_code, $name) = explode(' ', $cliniccode);

        $cliniccode = $name;
	}
	
	$q = mysql_query("SELECT `code` FROM `clinic` WHERE detail LIKE '$cliniccode%'", $db2) or die( mysql_error() );
    $newclinic = '99';
    if( mysql_num_rows($q) > 0 ){
        $item = mysql_fetch_assoc($q);
        $newclinic = $item['code'];
    }


	if(!empty($vn)){ 
		$firstcode="0";
	}
	$treecode="00";
	$clinic = $firstcode.$newclinic.$treecode;

	$sqlptr = "Select code FROM  ptrightdetail WHERE detail='$ptrightdetail'";
	$resultptr = mysql_query($sqlptr, $db2) or die(mysql_error());
	list($instype) = mysql_fetch_row($resultptr);

	$cost="0.00";  //ราคาทุน
	if($credit=="เงินสด" || $credit=="อื่นๆ"){
		$price=$price;
		$payprice=$price;
	}else{
		$price=$paid;
		$payprice=$price-$paid;
	}
	$payprice=number_format($payprice,2);

	if($depart=="PHAR"){
		if((!empty($dpy) || $dpy !="0.00") || (!empty($dpn) || $dpn !="0.00")){
			$chargeitem="02";
		}
		if((!empty($dsy) || $dsy !="0.00") || (!empty($dsn) || $dsn !="0.00")){
			$chargeitem="05";
		}	
		if((!empty($nessdy) || $nessdy !="0.00") || (!empty($nessdn) || $nessdn !="0.00")){
			$chargeitem="17";
		}	
	}else if($depart=="PATHO"){
		$chargeitem="07";
	}else if($depart=="XRAY"){
		$chargeitem="08";
	}else if($depart=="HEMO"){
		$chargeitem="09";
	}else if($depart=="SURG"){
		$chargeitem="11";
	}else if($depart=="OTHER" || $depart=="EMER" || $depart=="WARD" || $depart=="EYE"){
		$chargeitem="12";
	}else if($depart=="DENTA"){
		$chargeitem="13";
	}else if($depart=="PHYSI"){
		$chargeitem="14";
	}else if($depart=="NID"){
		$chargeitem="15";
	}

	list($regis1, $regis2) = explode(' ', $thidate);

	list($yy,$mm,$dd) = explode("-",$regis1);
	$yy = $yy-543;
	list($hh,$ss,$ii) = explode(":",$regis2);
	$d_update = $yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

	$date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
	$vn = sprintf("%03d",$vn);	
	$seq = $date_serv.$vn;	  //ลำดับที่

	$chargelist = "000000";
	$quantity="1";

	$inline = "$hospcode|$hn|$seq|$date_serv|$clinic|$chargeitem|$chargelist|$quantity|$instype|$cost|$price|$payprice|$d_update|$idcard\r\n";			
	// print($inline);
	$txt .= $inline;
}
$filePath = $dirPath.'/charge_opd.txt';
file_put_contents($filePath, $txt);
$zipLists[] = $filePath;

$header = "HOSPCODE|PID|SEQ|DATE_SERV|CLINIC|CHARGEITEM|CHARGELIST|QUANTITY|INSTYPE|COST|PRICE|PAYPRICE|D_UPDATE|CID\r\n";
$txt = $header.$txt;
$qofPath = $dirPath.'/qof_charge_opd.txt';
file_put_contents($qofPath, $txt);
$qofLists[] = $qofPath;

echo "สร้างแฟ้ม charge_opd เสร็จเรียบร้อย<br>";