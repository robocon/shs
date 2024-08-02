<?php
session_start();
include("connect.inc");
require_once 'includes/config.php';
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>ใบ MAR ผู้ป่วยใน</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">

<style type="text/css">
body{ 
	font-family: 'TH SarabunPSK';
	font-size: 18px;
 }	
.sarabun {	font-family: TH SarabunPSK;
	font-size: 18px;
} 
@media print{
	#no-print{ display: none; }
	#sticker-contain{ padding: 0; }
}



.button-green {
  background-color: #45B39D; /* green */;
  font-family:"TH SarabunPSK"; 
  border: none;
  border-radius: 12px;
  color: white;
  padding: 5px 15px;
  text-align: center;
  text-decoration: none;
  display: inline-block;
  font-size: 22px;
  font-weight:bold;
  cursor: pointer;
}
</style>
<body>
<?

	$getan=$_GET["an"];
	$gethn=$_GET["hn"];
	$getmonth=$_GET["month"];
	$getyear=$_GET["year"];
	$getdate=$_GET["date"];
	$getact=$_GET["act"];
	if($_GET["act"]=="1"){	//HAD
		$sql = "SELECT a.`drugcode`,a.`date`,a.`tradname`,a.`unit`,a.`slcode`,a.`amount`,a.`onoff`,a.`dateoff`,a.`row_id`,a.`part` ,a.`ranktime`,a.`ranktime1`,a.`ranktime2`,a.`ranktime3` 
		FROM `dgprofile` AS a INNER JOIN drughad AS b ON a.drugcode=b.drugcode 
		WHERE a.`an` = '$getan' 
		AND (a.part='DDL' OR a.part='DDY' OR a.part='DDN')
		AND (a.drugcode NOT LIKE '3%')";
		$showtext="ยา Height Alert Drug";
		$divcolor="red";
		$drugtext="ยา Height Alert Drug";
		$typemar="ยา Height Alert Drug";
	}else if($_GET["act"]=="2"){  //oneday+stat แบบรับประทาน
		$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id`,`part`,`ranktime`,`ranktime1`,`ranktime2`,`ranktime3` 
		FROM `dgprofile` 
		WHERE `an` = '$getan' 
		AND (statcon='STAT' OR statcon='STAT1')
		AND (part='DDL' OR part='DDY' OR part='DDN')
		AND (drugcode NOT LIKE '3%') 
		AND (drugcode NOT like '2%')";
		$divcolor="whrite";
		$drugtext="ยารับประทาน";
		$typemar="oneday+stat แบบรับประทาน";
	}else if($_GET["act"]=="3"){  //oneday+stat แบบฉีด
		$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id`,`part`,`ranktime`,`ranktime1`,`ranktime2`,`ranktime3` 
		FROM `dgprofile` 
		WHERE `an` = '$getan' 
		AND (statcon='STAT' OR statcon='STAT1') 
		AND (part='DDL' OR part='DDY' OR part='DDN') 
		AND (drugcode NOT LIKE '3%') 
		AND (drugcode like '2%')";
		$divcolor="whrite";
		$drugtext="ยาฉีด";
		$typemar="oneday+stat แบบฉีด";
	}else if($_GET["act"]=="4"){  //continue แบบรับประทาน
		$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id`,`part`,`ranktime`,`ranktime1`,`ranktime2`,`ranktime3` 
		FROM `dgprofile` 
		WHERE `an` = '$getan'
		AND (statcon='CONT') 
		AND (part='DDL' OR part='DDY' OR part='DDN')
		AND (drugcode NOT LIKE '3%') 
		AND (drugcode NOT like '2%')";
		$showtext="ยา Continue";
		$divcolor="blue";
		$drugtext="ยารับประทาน";
		$typemar="continue แบบรับประทาน";
	}else if($_GET["act"]=="5"){  //continue แบบฉีด
		$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id`,`part`,`ranktime`,`ranktime1`,`ranktime2`,`ranktime3` 
		FROM `dgprofile` 
		WHERE `an` = '$getan' 
		AND (statcon='CONT') 
		AND (part='DDL' OR part='DDY' OR part='DDN') 
		AND (drugcode NOT LIKE '3%') 
		AND (drugcode like '2%')";
		$showtext="ยา Continue";
		$divcolor="blue";
		$drugtext="ยาฉีด";
		$typemar="continue แบบฉีด";
	}
//echo "==>".$sql;	
$result = mysql_query($sql);
$chknum=mysql_num_rows($result);
//echo ">>>".$chknum;
if(empty($chknum)){
	echo "<script>alert('ไม่พบข้อมูล Drug Profile ประเภท $typemar ของผู้ป่วย AN:$an ในระบบ');window.location='ipd_drugmar.php?an=$getan&hn=$gethn&month=$getmonth&year=$getyear&date=$getdate';</script>";
}else{
list($drugcode,$date,$tradname,$unit,$slcode,$amount,$onoff,$dateoff,$row_id,$part,$ranktime,$ranktime1,$ranktime2,$ranktime3) = mysql_fetch_array($result);	
//echo $drugcode;
$sqlbed="select hn,age,ptname,my_ward,bedcode,ptright,diag,doctor from ipcard where an='$getan'";
$query=mysql_query($sqlbed);
list($hn,$age,$ptname,$ward,$bedcode,$ptright,$diag,$doctor)=mysql_fetch_array($query);


	$list1 = array();
	$sql5 = "Select  drugcode,tradname From drugreact  where hn = '".$gethn."' and sideeffects=''";
	$result5 = Mysql_Query($sql5);
	$drugreact_rows = mysql_num_rows($result5);
		if($drugreact_rows>0){
			while($arr5 = Mysql_fetch_assoc($result5)){
				array_push($list1 ,$arr5["drugcode"]);
			}
			$list_drugreact1 = implode(", ",$list1);
			$texdrugreact .= $list_drugreact1;
		}else{
			$texdrugreact .= "ไม่มีประวัติการแพ้ยา";
		}		
	
?>
<table width='100%' border='0' style='border-collapse: collapse;'>
<tr>
	<td width='25%' align='center' valign='top'>
		<div><strong style="font-size:22px;">โรงพยาบาลค่ายสุรศักด์มนตรี</strong></div>
		<div>แบบบันทึกการให้ยา</div>
		<br>
		<div><strong style="font-size:20px;"><u><?=$drugtext;?></u></strong></div>
	</td>
	<td width='40%'>
		<div><span>ชื่อ/สกุล ผู้ป่วย : <?=$ptname;?></span><span style="margin-left:10px;">อายุ : <?=$age;?></span></div>
		<div><span>HN: <?=$hn;?></span><span style="margin-left:10px;">AN: <?=$getan;?></span><span style="margin-left:10px;">Ward: <?=$ward;?></span></div>
		<div><span>Room/Bed: <?=$bedcode;?></span><span style="margin-left:10px;">Dx: <?=$diag;?></span></div>
		<div><span>สิทธิการรักษา: <?=$ptright;?></span><span style="margin-left:10px;">แพทย์: <?=$doctor;?></span></div>
		
		<div><span>แพ้ยา: <?=$texdrugreact;?></span></div>
	</td>
	<td width='15%' align='center' valign="middle">
		<div id="no-print" align="center">
		<div><A HREF="<?=NOTIFY_HOST;?>/testqrcode/ipd_drugorder.php?an=<?=$an;?>&hn=<?=$hn;?>&act=<?=$getact;?>"><button type="button" class="button-green" style="width:200px;"><img src="images/nurse.png" height="32px" width="32px" /><br>จ่ายยาผู้ป่วย</button></a></div>
		</div>
	</td>	
	<td width='20%'>
		
		<div align="center" style="border:3px solid <?=$divcolor;?>; height: 80px;"><strong style="color:<?=$divcolor;?>;"><br><?=$showtext;?></strong></div>
	</td>	
</tr>
</table>
<?
list($y,$m,$d)=explode("-",substr($date,0,10));
$y=$y-543;
$current = strtotime("$y-$m-$d");
//echo "==>".$current;


$DateStart = $d; //วันเริ่มต้น
$MonthStart = $m; //เดือนเริ่มต้น
$YearStart = $y; //ปีเริ่มต้น

$DateEnd = date("d"); //วันสิ้นสุด
$MonthEnd = date("m"); //เดือนสิ้นสุด
$YearEnd = date("y"); //ปีสิ้นสุด

$End = mktime(0,0,0,$MonthEnd,$DateEnd,$YearEnd);
$Start = mktime(0,0,0,$MonthStart ,$DateStart ,$YearStart);

$DateNum=ceil(($End -$Start)/86400); // 28
$DateNum=$DateNum+1;
$numcolspan=$DateNum+2;
//echo ">>".$DateNum;


?>

<table width='100%' border='1' style='border-collapse: collapse;'>
<tr>
	<td width="20%" align="center" rowspan = "2">ชื่อยา ขนาด วิธีใช้</td>
	<td width="10%" align="center" rowspan = "2">เวลา</td>
<?
for ($i=1; $i <= $DateNum; $i++) { 
    $year = date('Y', $current) + 543;
    $short_y = substr($year,2);
    $month = date('m', $current);
    $date = date('d', $current);
	
	$current = strtotime('+1 day', $current);
	
?>	
	<td align="center"><? echo $date.'/'.$month.'/'.$short_y;?></td> <!-- หัวตารางวันที่ให้ยา --->
<? } ?>	
</tr>
<tr>
<?
for ($i=1; $i <= $DateNum; $i++) { 
    $year = date('Y', $current) + 543;
    $short_y = substr($year,2);
    $month = date('m', $current);
    $date = date('d', $current);
	
	$current = strtotime('+1 day', $current);
	
?>
	<td width="10%" align="center">เวลา/ผู้ให้</td>	
<? } ?>		
</tr>




<?
	if($_GET["act"]=="1"){	//HAD
		$sql = "SELECT a.`drugcode`,a.`date`,a.`tradname`,a.`unit`,a.`slcode`,a.`amount`,a.`onoff`,a.`dateoff`,a.`row_id`,a.`part` ,a.`ranktime`,a.`ranktime1`,a.`ranktime2`,a.`ranktime3` 
		FROM `dgprofile` AS a INNER JOIN drughad AS b ON a.drugcode=b.drugcode 
		WHERE a.`an` = '$getan' 
		AND (a.part='DDL' OR a.part='DDY' OR a.part='DDN')
		AND (a.drugcode NOT LIKE '3%')";
		$showtext="ยา Height Alert Drug";
		$divcolor="red";
		$drugtext="ยา Height Alert Drug";
		$typemar="ยา Height Alert Drug";
	}else if($_GET["act"]=="2"){  //oneday+stat แบบรับประทาน
		$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id`,`part`,`ranktime`,`ranktime1`,`ranktime2`,`ranktime3` 
		FROM `dgprofile` 
		WHERE `an` = '$getan' 
		AND (statcon='STAT' OR statcon='STAT1')
		AND (part='DDL' OR part='DDY' OR part='DDN')
		AND (drugcode NOT LIKE '3%') 
		AND (drugcode NOT like '2%')";
		$divcolor="whrite";
		$drugtext="ยารับประทาน";
		$typemar="oneday+stat แบบรับประทาน";
	}else if($_GET["act"]=="3"){  //oneday+stat แบบฉีด
		$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id`,`part`,`ranktime`,`ranktime1`,`ranktime2`,`ranktime3` 
		FROM `dgprofile` 
		WHERE `an` = '$getan' 
		AND (statcon='STAT' OR statcon='STAT1') 
		AND (part='DDL' OR part='DDY' OR part='DDN') 
		AND (drugcode NOT LIKE '3%') 
		AND (drugcode like '2%')";
		$divcolor="whrite";
		$drugtext="ยาฉีด";
		$typemar="oneday+stat แบบฉีด";
	}else if($_GET["act"]=="4"){  //continue แบบรับประทาน
		$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id`,`part`,`ranktime`,`ranktime1`,`ranktime2`,`ranktime3` 
		FROM `dgprofile` 
		WHERE `an` = '$getan'
		AND (statcon='CONT') 
		AND (part='DDL' OR part='DDY' OR part='DDN')
		AND (drugcode NOT LIKE '3%') 
		AND (drugcode NOT like '2%')";
		$showtext="ยา Continue";
		$divcolor="blue";
		$drugtext="ยารับประทาน";
		$typemar="continue แบบรับประทาน";
	}else if($_GET["act"]=="5"){  //continue แบบฉีด
		$sql = "SELECT `drugcode`,`date`,`tradname`,`unit`,`slcode`,`amount`,`onoff`,`dateoff`,`row_id`,`part`,`ranktime`,`ranktime1`,`ranktime2`,`ranktime3` 
		FROM `dgprofile` 
		WHERE `an` = '$getan' 
		AND (statcon='CONT') 
		AND (part='DDL' OR part='DDY' OR part='DDN') 
		AND (drugcode NOT LIKE '3%') 
		AND (drugcode like '2%')";
		$showtext="ยา Continue";
		$divcolor="blue";
		$drugtext="ยาฉีด";
		$typemar="continue แบบฉีด";
	}
//echo "==>".$sql;	
$query = mysql_query($sql);
while($arr = mysql_fetch_array($query)){
	//echo ">>>".$drugcode;
	$slcode=$arr["slcode"];
	$chkranktime=$arr["ranktime"];
	//echo "==>".$chkranktime;
    $sql2 = "SELECT * 
    FROM `drugslip` 
    WHERE `slcode` = '$slcode' ";
	$result2 = Mysql_Query($sql2);	
	$dSlip=mysql_fetch_array($result2);
	
    $sql3 = "SELECT genname 
    FROM `druglst` 
    WHERE `drugcode` = '".$arr["drugcode"]."' ";
	$result3 = Mysql_Query($sql3);	
	list($genname)=mysql_fetch_array($result3);	

    $detail_txt = $dSlip['detail1']." ";
    $detail_txt .= $dSlip['detail2']." ";
    $detail_txt .= $dSlip['detail3']." ";
    $detail_txt .= $dSlip['detail4'];	
	
	$sql1="select * from drugslip_ipd where slcode='$chkranktime'";
	$result1 = Mysql_Query($sql1);
	$num1=mysql_num_rows($result1);
	//echo ">>".$num1;
	$amount=$num1+1;	
	//echo "==>".$num1;
	if($num1==0){  //หากไม่มีวิธีใช้
?>
<tr>
	<td valign="top" rowspan="5"><?=$arr["tradname"]."<br>".$detail_txt;?></td>
</tr>
<?
$current=strtotime("$y-$m-$d");
for ($i=1; $i <= 4; $i++) { 
	$year = date('Y', $current) + 543;
	$short_y = substr($year,2);
	$month = date('m', $current);
	$date = date('d', $current);
		
	$current = strtotime('+1 day', $current);
?>
<tr>	
	<td align="center">&nbsp;</td> <!-- ช่วงเวลาในการให้ยา --->
<?
for ($n=1; $n <= $DateNum; $n++) { 	
?>
	<td align="center">&nbsp;</td>  <!-- พยาบาลและเวลาในการให้ยา --->
<? } ?>	
</tr>
<? } ?>


<?		
	}else{ //หากมีวิธีใช้	
?>
<tr>
	<td valign="top" rowspan="<?=$amount?>"><?=$arr["tradname"]."<br>".$detail_txt;?></td>
</tr>	
<?
while($rows=mysql_fetch_array($result1)){
	//echo ">>".$rows["ranktime"];
	if($rows["slcode"]=="iv q 8 hr (กำหนดเอง)"){		
		$sql2="select ranktime1,ranktime2,ranktime3 from dgprofile where row_id='".$arr["row_id"]."'";
		//echo $sql2;
		$result2 = Mysql_Query($sql2);
		list($ranktime1,$ranktime2,$ranktime3)=mysql_fetch_array($result2);	
		if($rows["row_id"]=="38"){
			$showranktime=$ranktime1;
		}else if($rows["row_id"]=="39"){
			$showranktime=$ranktime2;
		}else if($rows["row_id"]=="40"){
			$showranktime=$ranktime3;
		}
	}else if($rows["slcode"]=="iv OD (กำหนดเอง)"){
		$sql2="select ranktime1,ranktime2,ranktime3 from dgprofile where row_id='".$arr["row_id"]."'";
		//echo $sql2;
		$result2 = Mysql_Query($sql2);
		list($ranktime1,$ranktime2,$ranktime3)=mysql_fetch_array($result2);	
		$showranktime=$ranktime1;		
	}else{
		$showranktime=$rows["ranktime"];
	}

?>	
<tr>	
	<td align="center"><?=$showranktime;?></td>
<?
$current=strtotime("$y-$m-$d");
for ($i=1; $i <= $DateNum; $i++) { 
    $year = date('Y', $current) + 543;
    $short_y = substr($year,2);
    $month = date('m', $current);
    $date = date('d', $current);
	
	$current = strtotime('+1 day', $current);
	$chkdate=$year.'-'.$month.'-'.$date;	
	
	$sqlmar="select nurse1,nurse2,register_time from dgprofile_mar where idno='".$arr["row_id"]."' and date='$chkdate' and ranktime='$showranktime'";	
	//echo "==>".$sqlmar."<br>";
	$resultmar = mysql_query($sqlmar);	
	list($nurse1,$nurse2,$register_time)=mysql_fetch_array($resultmar);	
	$num=mysql_num_rows($resultmar);
	if($num==0){  //หากไม่มีการบันทึกให้ยา	
		$showtime="";
		$nurse="";
	}else{
		$showtime=$register_time;
		if(empty($nurse2)){
			$nurse=$nurse1;
		}else{
			$nurse="$nurse1<br>$nurse2";
		}	
		
	}	
?>	
	<td align="center"><?=$nurse."<br>".$register_time;?></td>
<? } ?>	
</tr>
<? } ?>	
<? 
	} //close if num1==0
}  //close while
?>

<?
for ($i=1; $i <= 5; $i++) { 
?>
<tr>
	<td align="center">&nbsp;</td>
	<td align="center">&nbsp;</td>
<?
for ($n=1; $n <= $DateNum; $n++) { 	
?>
	<td align="center">&nbsp;</td>  <!-- พยาบาลและเวลาในการให้ยา --->
<? } ?>	
</tr>
<?
}
?>

<tr>
	<td align="center">Recheck order</td>
	<td align="center" colspan="<?=$numcolspan;?>">ผู้ตรวจสอบ</td>
</tr>
<tr>
	<td align="center">เวรเช้า</td>
	<td align="center"></td>
<?
$current=strtotime("$y-$m-$d");
for ($n=1; $n <= $DateNum; $n++) { 	
    $year = date('Y', $current) + 543;
    $short_y = substr($year,2);
    $month = date('m', $current);
    $date = date('d', $current);
	
	$current = strtotime('+1 day', $current);
	$chkdate=$year.'-'.$month.'-'.$date;	
	
	$sqlmar1="select nurse from dgprofile_approve where an='".$getan."' and date='$chkdate' and type='$typemar' and period='เวรเช้า'";	
	//echo "==>".$sqlmar1."<br>";
	$resultmar1 = mysql_query($sqlmar1);	
	list($nurse)=mysql_fetch_array($resultmar1);	
	$num1=mysql_num_rows($resultmar1);
	if($num1==0){  //หากไม่มีการบันทึกตรวจสอบข้อมูล
		$nurseapprove1="";
	}else{
		$nurseapprove1=$nurse;	
	}
?>
	<td align="center"><?=$nurseapprove1;?></td>  <!-- พยาบาลเวรเช้า --->
<? } ?>	
</tr>
<tr>
	<td align="center">เวรบ่าย</td>
	<td align="center"></td>
<?
$current=strtotime("$y-$m-$d");
for ($n=1; $n <= $DateNum; $n++) { 	
    $year = date('Y', $current) + 543;
    $short_y = substr($year,2);
    $month = date('m', $current);
    $date = date('d', $current);
	
	$current = strtotime('+1 day', $current);
	$chkdate=$year.'-'.$month.'-'.$date;	
	
	$sqlmar2="select nurse from dgprofile_approve where an='".$getan."' and date='$chkdate' and type='$typemar' and period='เวรบ่าย'";	
	//echo "==>".$sqlmar2."<br>";
	$resultmar2 = mysql_query($sqlmar2);	
	list($nurse)=mysql_fetch_array($resultmar2);	
	$num2=mysql_num_rows($resultmar2);
	if($num2==0){  //หากไม่มีการบันทึกตรวจสอบข้อมูล
		$nurseapprove2="";
	}else{
		$nurseapprove2=$nurse;	
	}
?>
	<td align="center"><?=$nurseapprove2;?></td>  <!-- พยาบาลเวรบ่าย --->
<? } ?>	
</tr>
<tr>
	<td align="center">เวรดึก</td>
	<td align="center"></td>
<?
$current=strtotime("$y-$m-$d");
for ($n=1; $n <= $DateNum; $n++) { 	
    $year = date('Y', $current) + 543;
    $short_y = substr($year,2);
    $month = date('m', $current);
    $date = date('d', $current);
	
	$current = strtotime('+1 day', $current);
	$chkdate=$year.'-'.$month.'-'.$date;	
	
	$sqlmar3="select nurse from dgprofile_approve where an='".$getan."' and date='$chkdate' and type='$typemar' and period='เวรดึก'";	
	//echo "==>".$sqlmar3."<br>";
	$resultmar3 = mysql_query($sqlmar3);	
	list($nurse)=mysql_fetch_array($resultmar3);	
	$num3=mysql_num_rows($resultmar3);
	if($num3==0){  //หากไม่มีการบันทึกตรวจสอบข้อมูล
		$nurseapprove3="";
	}else{
		$nurseapprove3=$nurse;	
	}	
?>
	<td align="center"><?=$nurseapprove3;?></td>  <!-- พยาบาลเวรดึก --->
<? } ?>	
</tr>
</table>

<?php
	function DateThai($strDate)
	{
		$strYear = date("Y",strtotime($strDate))+543;
		$strMonth= date("n",strtotime($strDate));
		$strDay= date("j",strtotime($strDate));
		$strHour= date("H",strtotime($strDate));
		$strMinute= date("i",strtotime($strDate));
		$strSeconds= date("s",strtotime($strDate));
		$strMonthCut = Array("","ม.ค.","ก.พ.","มี.ค.","เม.ย.","พ.ค.","มิ.ย.","ก.ค.","ส.ค.","ก.ย.","ต.ค.","พ.ย.","ธ.ค.");
		$strMonthThai=$strMonthCut[$strMonth];
		return "$strDay $strMonthThai $strYear";
	}
	
	$strDate = date("Y-m-d H:i:s");


$user_id = trim($_SESSION['sIdname']);
$check_user = in_array($user_id, array('บุญทิวา3','เมตตาวลี','วราภรณ์2','วธัญญา','บุศริน','ณัฐนิชา','นราพร1234','อรพรรณ1','ภิรมภรณ์','สุพิชชา','ดนัย2','หทัยพิมพ์กานต์','ธิดากานต์','จุรีย์รัตน์','แพรวรดา','ธมลวรรณ','รัชยานันท์','วรรณภา','ณัฐมล','พิไลพร','จีรานันท์','กมลวรรณ4','ลดามณี','บุณฑริกา','ปวีณา','ปวีณา2','ชูภาพันธ์'));  
if($check_user === true ){
?>

<div id="no-print" align="center" style='margin-top:50px; margin-bottom:20px;'>
<FORM name="form2" METHOD="POST" ACTION="med_record_print_2023_add.php" Onsubmit="return checkForm();">
<input type="hidden" name="active" id="active" value="add">
<input type="hidden" name="act" id="act" value="<?=$_GET["act"];?>">
<input type="hidden" name="an" id="an" value="<?=$getan;?>">
<input type="hidden" name="hn" id="hn" value="<?=$gethn;?>">
<input type="hidden" name="month" id="month" value="<?=$getmonth;?>">
<input type="hidden" name="year" id="year" value="<?=$getyear;?>">
<input type="hidden" name="date" id="date" value="<?=$getdate;?>">
<input type="hidden" name="typemar" id="typemart" value="<?=$typemar;?>">
<div>
<div align="center"><strong style="font-size:28px;">ข้อมูลประจำวันที่ <?=DateThai($strDate);?></strong></div>
<strong style="font-size:28px;">ตรวจสอบข้อมูล :  </strong>
	<select name="period" id="period" class="sarabun" style="width:150px; height:40px; font-size:22px; font-weight:bold;">
      <option value="0" selected>----- เลือกข้อมูล -----</option>
      <option value="เวรเช้า">เวรเช้า</option>
      <option value="เวรบ่าย">เวรบ่าย</option>
      <option value="เวรดึก">เวรดึก</option>  
        </select>
<span style="margin-left:20px;">
<input name="submit" type="submit" class="button-green" id="submit" value="  บันทึกข้อมูล  " />
</span>
</div>
</FORM>
</div>
<?
	}
}  //close if chknum
?>


</body>
</html>