<?php
include("../connect.inc");
$newyear = "$thiyr$rptmo$day";
$thimonth = "$thiyr-$rptmo";
$thiyr = $thiyr-543;
$yrmonth = "$thiyr-$rptmo";
$yy = 543;

if( !is_dir('new43file') ){
	mkdir('new43file');
}

$dirPath = 'new43file/'.$thiyr.'/';
if( !is_dir($dirPath) ){
	mkdir($dirPath);
}

print "14. ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน แฟ้มที่14 ตาราง ADMISSION ประจำเดือน $thimonth <a target=_self  href='../../nindex.htm'><<ไปเมนู</a><br> ";

$temp14="CREATE TEMPORARY  TABLE report_admission 
SELECT `date`,`an`,`hn`,`ptright`,`clinic`,`my_ward`,`dcdate`,`dcstatus`,`dctype`,`doctor` 
FROM `ipcard` 
WHERE `dcdate` LIKE '$thimonth%' 
AND `dcdate` IS NOT NULL";
var_dump($temp14);
$querytmp14 = mysql_query($temp14) or die("Query failed,Create temp14");

$sql14="SELECT * 
FROM report_admission";
$result14 = mysql_query($sql14) or die("Query failed,Select report_admission");

$hospcode = '11512';
$txt = '';

while (list ($date,$an,$hn,$ptright,$clinic,$my_ward,$dcdate,$dcstatus,$dctype,$doctor) = mysql_fetch_row ($result14)){
	
	$sqlopd = mysql_query("SELECt `weight`,`height` FROM `opd` WHERE `hn`='$hn' ORDER BY `row_id` DESC");
	list($admitweight,$admitheight)=mysql_fetch_array($sqlopd);
	
	$num2 = 543;
    $d = substr($date,8,2);
    $m = substr($date,5,2); 
    $y = substr($date,0,4); 
	$y1 = $y-$num2;
   	$y2 = substr($y1,2,2);
	$dateserv = "$y1$m$d";
	list($hn1,$hn2) = explode("-",$hn);
	$seq = $dateserv.$hn1.$hn2;		
	
	$regis1 = substr($date,0,10);
	$regis2 = substr($date,11,19);
	list($yy,$mm,$dd) = explode("-",$regis1);
	list($hh,$ss,$ii) = explode(":",$regis2);
	$d_update = ($yy-543).$mm.$dd.$hh.$ss.$ii;
	
	$dcdate1 = substr($dcdate,0,10);
	$dcdate2 = substr($dcdate,11,19);
	list($yy,$mm,$dd) = explode("-",$dcdate1);
	list($hh,$ss,$ii) = explode(":",$dcdate2);
	$datetime_disch = ($yy-543).$mm.$dd.$hh.$ss.$ii;	
	
	$newclinic = substr($clinic,0,2);
	if($newclinic == "12"){
		$newclinic = "99";
	}
	
	// โค้ดเก่า
	// if(!empty($clinic)){
	// 	$wardadmit = "1$newclinic00";
	// 	$warddisch = "1$newclinic00";
	// }
	
	$newptright = substr($ptright,0,3);
	if($newptright == "R01" || $newptright == "R05"){
		$instype = "9100";
	}else if($newptright=="R02" || $newptright=="R03"  || $newptright=="R04"){
		$instype = "1100";
	}else if($newptright=="R06"){
		$instype = "6100";
	}else if($newptright=="R07"){
		$instype = "4200";
	}else if($newptright=="R09"){
		$instype = "0100";
	}
	
	$typein = "1";
	$dischtype = substr($dctype,0,1);
	$dischstatus = $dcstatus;
	
	$ipmonsql = mysql_query("SELECT `price`,`cash`,`credit` FROM `ipmonrep` WHERE `an` = '$an'");
	list($price, $cash, $credit)=mysql_fetch_array($ipmonsql);
	
	if($credit == "เงินสด" || $credit == "อื่นๆ"){
		$price = $cash;
		$payprice = $cash;
		$actualpay = $cash;
	}else{
		$payprice = 0;
		$actualpay = 0;	
	}
	
	// รหัส5ตัวหน้าของหมอ
	$doctor = substr($doctor,0,5);
	
	// หา VN
	$chkdate = substr($date, 0, 10);
	$sqlopd1 = "select vn FROM opday WHERE thidate LIKE '$chkdate%' and hn='$hn'";
	$resultopd1 = mysql_query($sqlopd1);	
	list($vn) = mysql_fetch_array($resultopd1);
	
	// date_serv สำหรับ provider
	list($yy,$mm,$dd) = explode("-", $regis1);
	$yy = $yy - 543;
	$date_serv = "$yy$mm$dd";  //วันที่มารับบริการ
	
	// provider
	$sqldoc = mysql_query("select doctorcode FROM doctor WHERE name LIKE'%$doctor%'");
	list($doctorcode) = mysql_fetch_array($sqldoc);
	if(empty($doctorcode)){
		$provider = $date_serv.$vn."00000";
	}else{
		$provider = $date_serv.$vn.$doctorcode;
	}
	
	// โค้ดเก่า
	// $provider=$doctor.$an;
	
	/* แผนกที่รับผู้ป่วยจากโค้ดหมอ อิงตามมาตรฐาน สนย. */
	// @todo สำหรับเทสเท่านั้น รอเพิ่มเติมหมอคนอื่น
	$doctor_sny = array(
		'MD100' => '01',
		'MD007' => '01',
		'MD006' => '01',
		'MD009' => '01',
		'MD056' => '02',
		'MD054' => '02',
		'MD101' => '03',
		'MD041' => '05',
		'MD036' => '06',
		'MD065' => '07',
		'MD089' => '07',
		'MD079' => '08',
		'MD013' => '08',
	);
	
	/**
	 * Override wardadmit and warddisch FROM doctor code(MDxxx)
	 */
	$dr_code = trim($doctor);
	$wardadmit = $warddisch = '1'.$doctor_sny[$dr_code].'00';
	
	$causein = "1";  //สาเหตุการส่งผู้ป่วย
	$cost = "0.00";  //ราคาทุน
	
	
	$inline = "$hospcode|$hn|$seq|$an|$dateserv|$wardadmit|$instype|$typein|$referinhosp|$causein|$admitweight|$admitheight|$datetime_disch|$warddisch|$dischstatus|$dischtype|$referouthosp|$causeout|$cost|$price|$payprice|$actualpay|$provider|$d_update\r\n";
	print($inline);
	$txt .= $inline;
} // End while

file_put_contents($dirPath.'admission.txt', $txt);