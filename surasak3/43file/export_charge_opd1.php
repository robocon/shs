<?php
include("../connect.inc");
$newyear = "$thiyr$rptmo$day";
$thimonth = "$thiyr-$rptmo";
$thiyr = $thiyr-543;
$yrmonth = "$thiyr-$rptmo";
$yy = 543;

print "1. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่13 ตาราง CHARGE_OPD ประจำเดือน $yrmonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";
//-------------------- Create file charge_opd ไฟล์ที่ 13 --------------------//
// 
$temp13="CREATE  TEMPORARY  TABLE report_chargeopd 
SELECT  date,hn,depart,price,paid,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit 
From opacc 
where date like '$thimonth%' 
GROUP BY `hn` 
ORDER BY date ASC
";
//echo $temp13;
$querytmp13 = mysql_query($temp13) or die("Query failed,Create temp13");

$sql13="SELECT date,hn,depart,price,paid,essd,nessdy,nessdn,dpy,dpn,dsy,dsn,ptright,credit 
From report_chargeopd";
$result13= mysql_query($sql13) or die("Query failed, Select report_chargeopd (charge_opd)");
$num=mysql_num_rows($result13);

//echo "$num <br>";
while (list ($date,$hn,$depart,$price,$paid,$essd,$nessdy,$nessdn,$dpy,$dpn,$dsy,$dsn,$ptright,$credit) = mysql_fetch_row ($result13)) {	
	$sqlhos=mysql_query("select pcucode from mainhospital where pcuid='1'");
	list($hospcode)=mysql_fetch_array($sqlhos);

	$sqlpt=mysql_query("select ptrightdetail from opcard where hn='$hn'");
	list($ptrightdetail)=mysql_fetch_array($sqlpt);	

	// $chkdate=substr($date,0,10);
	list($chkdate) = explode(' ', $date);

	$sqlop=mysql_query("select thidate,vn from opday where hn ='$hn' and thidate like '$chkdate%'");
	list($thidate,$vn)=mysql_fetch_array($sqlop);

	if( empty($thidate) ){
		$thidate = $date;
	}
	$newclinic=substr($cliniccode,0,2);
	if($newclinic=="" || $newclinic=="ศั"){ $newclinic="99";}else{ $newclinic=$newclinic;}
	if(!empty($vn)){ $firstcode="0";}
	$treecode="00";
	$clinic=$firstcode.$newclinic.$treecode;

	/*$newptright=substr($ptright,0,3);
	if($newptright=="R01" || $newptright=="R05"){  //เงินสด
	$instype="9100";  //ประเภทสิทธิการรักษา
	}else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){  //โครงการเบิกจ่ายตรง
	$instype="1100";  //ประเภทสิทธิการรักษา
	}else if($newptright=="R06"){  //พ.ร.บ.คุ้มครองผู้ประสบภัยจากรถ
	$instype="6100";  //ประเภทสิทธิการรักษา
	}else if($newptright=="R07"){  //ประกันสังคม
	$instype="4200";  //ประเภทสิทธิการรักษา
	}else if($newptright=="R09"){  //ประกันสุขภาพถ้วนหน้า
	$instype="0100";  //ประเภทสิทธิการรักษา
	}*/

	$sqlptr = "Select code From  ptrightdetail where detail='$ptrightdetail'";
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

	// $regis1=substr($thidate,0,10);
	// $regis2=substr($thidate,11,19);
	list($regis1, $regis2) = explode(' ', $thidate);

	list($yy,$mm,$dd)=explode("-",$regis1);
	$yy = $yy-543;
	list($hh,$ss,$ii)=explode(":",$regis2);
	$d_update=$yy.$mm.$dd.$hh.$ss.$ii;  //วันเดือนปีที่ปรับปรุงข้อมูล

	// $regis1=substr($thidate,0,10);
	// $regis2=substr($thidate,11,19);
	// list($yy,$mm,$dd)=explode("-",$regis1);
	// $yy = $yy-543;
	$date_serv="$yy$mm$dd";  //วันที่มารับบริการ
	$vn=sprintf("%03d",$vn);	
	$seq=$date_serv.$vn;	  //ลำดับที่

	$chargelist="000000";
	$quantity="1";

	echo "$hospcode|$hn|$seq|$date_serv|$clinic|$chargeitem|$chargelist|$quantity|$instype|$cost|$price|$payprice|$d_update<br>";			

}