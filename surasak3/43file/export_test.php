<?php
include '../bootstrap.php';
$thiyr = '2559';
$rptmo = '02';

$thimonth = "$thiyr-$rptmo";
	$thiyr = ( $thiyr - 543 );
	$yrmonth = "$thiyr-$rptmo";
	$yy = 543;
	$hospcode = '11512';

$temp13="CREATE  TEMPORARY  TABLE report_chargeopd 
	SELECT `date`,`hn`,`depart`,`price`,`paid`,`essd`,`nessdy`,`nessdn`,`dpy`,`dpn`,`dsy`,`dsn`,`ptright`,`credit`,
	DATE_FORMAT(`date`,'%Y-%m-%d') AS `date2`, vn
	FROM `opacc` 
	WHERE `date` like '$thimonth%' 
	AND ( `vn` IS NOT NULL AND `vn` != '' )
	GROUP BY `date2`, `hn`
	ORDER BY `date` ASC";

	$querytmp13 = mysql_query($temp13) or die( mysql_error() );

	$sql13="SELECT *
	FROM report_chargeopd";
	$result13= mysql_query($sql13) or die( mysql_error() );
	$num = mysql_num_rows($result13);

	
	$txt = '';
    $i = 0;
	while (list ($date,$hn,$depart,$price,$paid,$essd,$nessdy,$nessdn,$dpy,$dpn,$dsy,$dsn,$ptright,$credit,$date2,$vn) = mysql_fetch_row ($result13)) {	

		$sqlpt=mysql_query("SELECT `ptrightdetail` FROM `opcard` WHERE `hn`='$hn'");
		list($ptrightdetail)=mysql_fetch_array($sqlpt);	

		list($chkdate) = explode(' ', $date);

		$qOpday = "SELECT `thidate` FROM `opday` WHERE `thidate` LIKE '$date2%' AND `vn` = '$vn'";
        echo "<pre>";
        var_dump($qOpday);
		// $sqlop = mysql_query($qOpday);
		// list($thidate) = mysql_fetch_array($sqlop);
        
        if( $i === 50 ){
            exit;
        }
        $i++;
        
        /*
		if( empty($thidate) ){
			$thidate = $date;
		}
		
		$newclinic=substr($cliniccode,0,2);
		if($newclinic=="" || $newclinic=="ศั"){ 
			$newclinic = "99";
		}else{
			$newclinic = $newclinic;
		}
		if(!empty($vn)){ 
			$firstcode="0";
		}
		$treecode="00";
		$clinic = $firstcode.$newclinic.$treecode;

		$sqlptr = "Select code FROM  ptrightdetail WHERE detail='$ptrightdetail'";
		$resultptr = mysql_query($sqlptr) or die(mysql_error());
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
			$chargeitem="16";
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

		$inline = "$hospcode|$hn|$seq|$date_serv|$clinic|$chargeitem|$chargelist|$quantity|$instype|$cost|$price|$payprice|$d_update\r\n";			
		// print($inline);
		$txt .= $inline;
        
        */
	}
	// file_put_contents($dirPath.'/charge_opd.txt', $txt);
	// echo "สร้างแฟ้ม charge_opd เสร็จเรียบร้อย<br>";