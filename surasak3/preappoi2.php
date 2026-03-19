<?php
session_start();

include_once dirname(__FILE__).'/connect.php';
include_once dirname(__FILE__).'/newBootstrap.php';

if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}

session_register("cdoctor");
session_register("appd");

global $dt_doctor, $cdoctor, $doctor;

$doctor = $_POST['doctor'];

 if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=UTF-8");
}

Function calcage($birth){
      $today = getdate();   
      $nY  = $today['year']; 
      $nM = $today['mon'] ;
      $bY=substr($birth,0,4)-543;
      $bM=substr($birth,5,2);
      $ageY=$nY-$bY;
      $ageM=$nM-$bM;
       if ($ageM<0) {
           $ageY=$ageY-1;
           $ageM=12+$ageM;
                    }
      if ($ageM==0){
           $pAge="$ageY ปี";
             }
      else{
            $pAge="$ageY ปี $ageM เดือน";
                        }
      return $pAge;
}
$action = sprintf("%s", $_GET['action']);
if(isset($action)  && $action == "viewlist"){

	$count = count($_SESSION["list_code"]);
	//"<A HREF=\"javascript:show_bock();\">เจาะเลือด</A>
	echo "<TABLE bgcolor='#FFFFD2'>
	<TR>
		<TD>";
	for($i=0;$i<$count;$i++){
		echo "<A HREF=\"javascript:del_list(",$i,");\" >",$_SESSION["list_detail"][$i],"</A><BR>";
	}
	echo "</TD>
	</TR>
	</TABLE>";

	exit();
}else if(isset($action) && $action == "addtolist"){

	//************************** แสดงรายการ lab  ********************************************************

	$array_new = array($_GET["code"]);

	$result = array_intersect($_SESSION["list_code"], $array_new);

	if(count($result) ==0){

	$sql = "Select detail, yprice, nprice, lab_listdetail From labcare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice, $lab_listdetail) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	array_push($_SESSION["list_detail"],$detail);
	array_push($_SESSION["lab_lists"],$lab_listdetail);
	
	}

	exit();
}else if(isset($action) && $action == "delete"){
	
	$count = count($_SESSION["list_code"]);
	
	$j=$_GET["code"];


	for($i=$j;$i<$count;$i++){
		$_SESSION["list_code"][$i] = $_SESSION["list_code"][$i+1];
		$_SESSION["list_detail"][$i] = $_SESSION["list_detail"][$i+1];

	}
	
	unset($_SESSION["list_code"][$count-1]);
	unset($_SESSION["list_detail"][$count-1]);


	exit();
}else if(isset($action) && $action == "lab"){

	// $sql = "Select code, detail From labcare where  detail like '%".$_GET["search"]."%' AND part = 'lab' AND (left(code,1) >='0' AND left(code,1) <='9') Order by numbered ASC";
	$sql = "SELECT * 
	From `labcare` 
	where `detail` LIKE '%".$_GET['search']."%' 
	AND part = 'LAB' 
	AND `labstatus` = 'Y'
	AND `version` != 'OLD'";
	$result = Mysql_Query($sql)or die(Mysql_error());
	if(Mysql_num_rows($result) > 0){
		echo "<Div style=\"position: absolute;text-align: left; width:410px; height:430px; overflow:auto; \">";
		echo "<table bgcolor=\"#FFFFCC\" width=\"500\" border=\"0\" cellpadding=\"0\" cellspacing=\"0\">
		<tr align=\"center\" bgcolor=\"#3333CC\">
			<td width=\"368\"><font style=\"color: #FFFFFF\"><strong>รายละเอียด</strong></font></td>
			<td width=\"24\" bgcolor=\"#3333CC\"><font style=\"color: #FF0000;\"><strong><A HREF=\"#\" onclick=\"document.getElementById('list').innerHTML='';\">X</A></strong></font></td>
		</tr>";

		$i=1;
		while($arr = Mysql_fetch_assoc($result)){
				
			if($i%2==0)
				$bgcolor="#FFFFFF";
			else
				$bgcolor="#FFFFCC";

			$arr["detail"] = ereg_replace(strtoupper($_GET["search"]),"<span style=\"background:#FFC1C1;\">".strtoupper($_GET["search"])."</span>",$arr["detail"]);

			echo "<tr bgcolor=\"$bgcolor\">
					<td bgcolor=\"$bgcolor\"><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".$arr["code"]."'); \">",$arr["detail"],"</A></td>
					<td colspan=\"2\"  bgcolor=\"$bgcolor\">",$arr["salepri"],"</td>
				</tr>
				<tr bgcolor=\"#A45200\">
					<td height=\"5\"></td>
					<td height=\"5\"></td>
					<td height=\"5\"></td>
				</tr>
			";
		$i++;
		}
		echo "</TABLE></Div>";
	}

exit();
}elseif ($action=="viewecho") {
	
	$date = sprintf("%s", $_GET['date']);
	$doctor = sprintf("%s", $_GET['doctor']);

	$sql = "SELECT * 
	FROM `appoint` 
	WHERE ( `appdate_en` = '$date' AND `apptime` != 'ยกเลิกการนัด' )
	AND `doctor` LIKE '$doctor%' 
	AND ( `detail` LIKE 'FU08%' OR `detail2` LIKE '%echo%' )";
	$q = mysql_query($sql);
	$rows = mysql_num_rows($q);
	echo $rows;
	exit;
}


$officer_name = trim($_SESSION['sOfficer']);
$doctor_name = trim($_POST['doctor']);


if( !$_POST['date_appoint'] ){
	?><p>กรุณาเลือกวันที่นัด <a href="javascript:window.history.back();">คลิกที่นี่</a> เพื่อกลับไปหน้าเลือกวันที่</p><?php
	exit;
}

// @todo ยังไม่ได้ทำ lock นัดแบบแบ่งเช้า-บ่าย 

$months = array(
	'มกราคม' => '01', 'กุมภาพันธ์' => '02','มีนาคม' => '03', 'เมษายน' => '04','พฤษภาคม' => '05', 'มิถุนายน' => '06',
	'กรกฎาคม' => '07', 'สิงหาคม' => '08','กันยายน' => '09', 'ตุลาคม' => '10','พฤศจิกายน' => '11', 'ธันวาคม' => '12',
);

// ถ้าเป็น POST ที่ส่งมาจาก preappoi1.php ให้เข้าเงื่อนไขในการตรวจสอบ
// ถ้าคนคีย์ไม่ใช่พี่หล้าสูติ หรือ หมอที่นัดไม่ใช่หมอขชล ก็ยังให้เข้าเงื่อนไขตรวจสอบอยู่
if( empty($_GET['action']) && ( $doctor_name != 'MD101 ขชล รวมทรัพย์' OR $officer_name != 'กัลยรัตน์ ตาคำ' OR $officer_name != 'วิรัชรา เชื้อผาเต่า' ) ){
	
	global $doctor;
	$doctor = trim($doctor);
	if($doctor == 'กรุณาเลือกแพทย์'){
		?>
		<p>กรุณาเลือกแพทย์ก่อนทำการนัดผู้ป่วย</p>
		<p><a href="#" onClick="window.history.back(); return false;">คลิกที่นี่</a> เพื่อกลับไปกรอกข้อมูลใหม่</p>
		<?php
		exit;
	}

	// จำกัดจำนวนผู้ป่วยนัด
	// ใน dr_limit_appoint จะเป็น lock นัดแบบตายตัว
	// รองรับ format ว.xxxxx และ MDxxxxx
	$doctor_post = $_POST['doctor'];
	$date_appoint = $_POST['date_appoint'];

	$sql = "SELECT COUNT(`hn`) 
	FROM `appoint` 
	WHERE `appdate` = '$date_appoint' 
	AND `doctor` = '$doctor_post' 
	AND `apptime` != 'ยกเลิกการนัด' 
	GROUP BY `hn`;";
	$query = mysql_query($sql);
	$appoint_rows = (int) mysql_num_rows($query);
	
	$th_day = array(
		0 => 'อาทิตย์', 'จันทร์', 'อังคาร', 'พุธ', 'พฤหัสบดี', 'ศุกร์', 'เสาร์',
	);
	
	list($day, $th_month, $th_year) = explode(' ', $_POST['date_appoint']);
	$new_date = ($th_year-543).'-'.$months[$th_month].'-'.$day;
	
	$dr_cheaw_test = date('Y-m-d', strtotime($new_date));

	// 0 -> อาทิตย์ ไปจนถึง 6 -> วันเสาร์
	$check_date = date('w', strtotime($new_date));
	
	$sql = "SELECT `dr_name`,`date`,`user_row`,`dr_contact` 
	FROM `dr_limit_appoint` 
	WHERE `dr_name` = '$doctor_post' 
	AND `date` = '$check_date' 
	AND `type` = 'lock' ";
	$query = mysql_query($sql);
	if (mysql_num_rows($query) > 0) {
	
		$item = mysql_fetch_assoc($query);
		$dr_limit = $item['user_row'];

		if( $dr_limit == 0 ){

			echo 'แพทย์ '.substr($item['dr_name'],5).' งดนัดผู้ป่วยทุกวัน'.$th_day[$check_date].' กรุณา<a href="#" onClick="window.history.back(); return false;">เลือกวันตรวจใหม่</a>';
			exit;

		}elseif( $appoint_rows >= $dr_limit ){
			
			$get_day = (int) $item['date'];
			$contactTxt = '';
			if( !empty($item['dr_contact']) ){
				$contactTxt = ' หากต้องการนัดเพิ่มกรุณาติดต่อ'.$item['dr_contact'];
			}

			echo 'วัน'.$th_day[$get_day].'ที่ '.$_POST['date_appoint'].' แพทย์ '.substr($item['dr_name'],5).' ได้จำกัดจำนวนผู้ป่วยนัดไม่ให้เกิน '.$item['user_row'].'คน '.$contactTxt;
			echo '<br>';
			echo '<a href="#" onclick="window.history.back();return false;">คลิกที่นี่</a> เพื่อกลับไปเปลี่ยนวันนัดใหม่';
			exit;
		}
	}
	// จำกัดจำนวนผู้ป่วยนัด
	
	// จำกัดนัดรายวัน
	$sql = "SELECT `dr_name`,`date`,`user_row`,`dr_contact` 
	FROM `dr_limit_appoint` 
	WHERE `dr_name` = '$doctor_post' 
	AND `date_lock` = '$new_date' 
	AND `type` = 'date_lock' ";
	$query = mysql_query($sql);

	if( mysql_num_rows($query) > 0 ){
		$item = mysql_fetch_assoc($query);
		$limit = $item['user_row'];

		if( $limit == 0 ){
			echo $dr_name.' ไม่ออกตรวจวันที่ '.$date_appoint;
		}else{
			echo $dr_name.' ได้จำกัดนัดในวันที่ '.$date_appoint.' ไว้ที่ '.$limit.'คน';
		}
		echo ' กรุณา<a href="#" onClick="window.history.back(); return false;">เลือกวันตรวจใหม่</a>';
		exit;

	}
	// จำกัดนัดรายวัน

}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">

<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>ใบนัดผู้ป่วย</title>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<script type="text/javascript" src="js/vendor/jquery-1.11.2.min.js"></script>
	<script type="text/javascript">
	$(function(){
		
		// กรณีที่มีการเลือก "เจาะเลือดไม่พบแพทย์" จะไม่ได้แสดง แผนกทะเบียน
		$(document).on('change', '#detail', function(){
			if($(this).val() == 'FU14 เจาะเลือดไม่พบแพทย์'){
				$('#opd').remove();
			}else{
				if($('#opd').length == 0){
					$('#pre-opd').after('<option id="opd">แผนกทะเบียน</option>');
				}
			}
		});
	});
	</script>
</head>
<body>
<?php

if(isset($_POST['B1'])){

	if( !isset($dt_doctor) && empty($dt_doctor) ){
		$dt_doctor = $_POST['doctor_name'];
	}

	$cdoctor=$dt_doctor;
	$cdate_appoint = $_POST['date_appoint'];

	list($thD, $thM, $thY) = explode(' ',$cdate_appoint);
	$date_en = ($thY-543).'-'.$months[$thM].'-'.$thD;
	 
	//กรณีเลือกวันที่ย้อนหลัง
	$yearnow = date("Y")+543;
	$datenow =date("dm").$yearnow;
	
	$mon = array('','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม');
	$arr = explode (" ",$_POST['date_appoint']); 
	for($i=1;$i<13;$i++){
		if($arr[1]==$mon[$i]){
			if(strlen($i)==1) $month = "0".$i;
			else $month = $i;
		}
	}
	$day = $arr[0];
	$year = $arr[2];
	$datenut = $day.$month.$year;
	$datenut1 = $day."-".$month."-".$year;
	$year -=543;
	$dd = getdate ( mktime ( 0, 0, 0, $month, $day, $year ));
}

$cappdate=$appdate;
$cappmo=$appmo;
$cthiyr=$thiyr;
$cdoctor=$doctor;
$cdate_appoint = $_POST['date_appoint'];
session_register("cappdate");
session_register("cappmo");
session_register("cthiyr");
session_register("cdoctor");
session_register("appd");

session_register("list_code");
session_register("list_detail");
$_SESSION["list_code"] = array();
$_SESSION["list_detail"] = array();
$_SESSION['lab_lists'] = array();

 function jschars($str)
{
    $str = str_replace("\\\\", "\\\\", $str);
    $str = str_replace("\"", "\\\"", $str);
    //$str = str_replace("'", "\\'", $str);
    $str = str_replace("\r\n", "\\n", $str);
    $str = str_replace("\r", "\\n", $str);
    $str = str_replace("\n", "\\n", $str);
    $str = str_replace("\t", "\\t", $str);
    $str = str_replace("<", "\\x3C", $str); // for inclusion in HTML
    $str = str_replace(">", "\\x3E", $str);
    return $str;
}

   $codedr = substr($cdoctor,0,5);
   //$arrdr1 = array(MD052,MD006,MD013,MD014);

   // ยกเลิก MD036 ศุภสิทธิ์ ที่อาคารเฉลิมพรเกียรติ
   $arrdr2 = array('MD008','MD009','MD007','MD072','MD041','MD016','MD047','MD088','MD100','MD200');
   
	   if(in_array($codedr,$arrdr2)){
			$counter='2'; //จุดนัดที่ 2
		}else{
			$counter = '1'; //จุดนัดที่ 1
		}
//$dbirth="$y-$m-$d"; เก็บวันเกิดใน opcard= "$y-$m-$d" ซึ่ง=$birth in function
// print "<p><b><font face='Angsana New' size = '3'>โรงพยาบาลค่ายสุรศักดิ์มนตรี</font></b></p>";
?>
<div style="display: none;"><?=$dt_doctor;?> <?=$dd['weekday'];?>  </div>
<?php
	$chkhn=$_POST["chkhn"];
	$chkidcard=$_POST["chkidcard"];
	echo "<div style='font-size:12px;color:red;'>ข้อมูลที่ส่งมาตรวจสอบ HN :".$_POST["chkhn"].", ";
	echo "IDCARD :".$_POST["chkidcard"]."</div>";

	if($_POST["chkhn"]==$cHn){
		$queryT="SELECT phone,idcard FROM opcard where hn='$cHn'";
		$resultT = mysql_query($queryT);
		$rowT = mysql_fetch_array($resultT);
		$idcard=$rowT["idcard"];
		print "<p><font face='Angsana New' size = '6'>HN: $cHn ชื่อ $cPtname  อายุ $cAge &nbsp;<B>สิทธิ:$cptright</font></B><br>";
		print "<font face='Angsana New' size = '6'>เลขบัตรประชาชน : $idcard</font><br>";
		print "<font face='Angsana New' size = '6'>แพทย์ $cdoctor วันที่: $cdate_appoint&nbsp; </font><br>";
	}else{
		$cHn=$_POST["chkhn"];
		$queryT="SELECT yot,name,surname,dbirth,phone,idcard FROM opcard where hn='$cHn'";
		$resultT = mysql_query($queryT);
		$rowT = mysql_fetch_array($resultT);
		$idcard=$rowT["idcard"];
		$cPtname=$rowT["yot"]." ".$rowT["name"]." ".$rowT["surname"];
		$cAge=calcage($rowT["dbirth"]);
		
		print "<p><font face='Angsana New' size = '6'>HN: $cHn ชื่อ $cPtname  อายุ $cAge &nbsp;<B>สิทธิ:$cptright</font></B><br>";
		print "<font face='Angsana New' size = '6'>เลขบัตรประชาชน : $idcard</font><br>";
		print "<font face='Angsana New' size = '6'>แพทย์ $cdoctor วันที่: $cdate_appoint&nbsp; </font><br>";
	}	

 $appd=$cdate_appoint;
 
 
$SqlStr = "SELECT  *  FROM  appoint  WHERE  hn = '".$cHn."' and doctor = '".$cdoctor."' and appdate ='".$cdate_appoint."' ";
$OjbQuery = mysql_query($SqlStr);
$OjbRow=mysql_num_rows($OjbQuery);
$Array=mysql_fetch_array($OjbQuery);
if($Array['patho']==""){
	$Array['patho']="-";
}
if($Array['xray']==""){
	$Array['xray']="-";
}
if($Array['other']==""){
	$Array['other']="-";
}
if($OjbRow>0){
	
	echo "<div style='background-color:#F99;  font-family:TH SarabunPSK; color:#000; font-size:20pt;'>ผู้ป่วยมีการนัดใน วันที่ $Array[appdate] เวลา  $Array[apptime]  ซ้ำ แพทย์ :  $Array[doctor]  <br>  LAB : $Array[patho] <br>  Xray : $Array[xray] <BR>อื่นๆ : $Array[other]</div>";
}

$query="CREATE TEMPORARY TABLE appoint1 SELECT * FROM appoint WHERE appdate = '$appd' and doctor = '$cdoctor' ";
$result = mysql_query($query) or die("Query failed,app");

$query="SELECT  apptime,COUNT(*) AS duplicate FROM appoint1 GROUP BY apptime HAVING duplicate > 0 ORDER BY apptime";
$result = mysql_query($query);
$n=0;
$num = 0;

$afternoonUser = $morningUser = 0;

while (list ($apptime,$duplicate) = mysql_fetch_row ($result)) {
	$n++;
	$num = $duplicate+$num;

	$onlyTime = preg_replace('/[^0-9:.-]/u', '', $apptime);
	
	if($onlyTime>="08:00" && $onlyTime<"13:00"){
		$morningUser += $duplicate;
	}else{
		$afternoonUser += $duplicate;
	}

	print (" <span style='background-color: #66CDAA; margin-right:8px; padding:2px;'>".
	"  <span><font face='Angsana New' size='3'><b>$apptime</b></font></span>".
	"  <span><font face='Angsana New' size='3'>นัดจำนวน = $duplicate คน</font></span>".
	" </span>");
}
?>
<br><font face='Angsana New' size='5'><b>ยอดรวมวันที่ <u><?= $appd; ?></u>: <?= $num ?> คน</b>&nbsp;&nbsp;( เช้า:<?= $morningUser; ?>&nbsp;&nbsp;บ่าย:<?= $afternoonUser; ?> )</font>
<script type="text/javascript">

function newXmlHttp(){
	var xmlhttp = false;

		try{
			xmlhttp = new ActiveXObject("Msxml2.XMLHTTP");
		}catch(e){
		try{
			xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
			}catch(e){
				xmlhttp = false;
			}
		}

		if(!xmlhttp && document.createElement){
			xmlhttp = new XMLHttpRequest();
		}
	return xmlhttp;
}

function addtolist(code){
	
	xmlhttp = newXmlHttp();
	url = 'preappoi2.php?action=addtolist&code=' + code;
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	viewlist();

	//if(checkELyte() == "4"){
	//	alert("ท่านได้สั่งรายการ Na, K, Cl, Co2 แยกทั้ง 4 รายการ \n กรุณาสั่งเป็น E'Lyte ");
	//}
}

function viewlist(){

	xmlhttp = newXmlHttp();
	url = 'preappoi2.php?action=viewlist';
	xmlhttp.open("GET", url, false);
	xmlhttp.send(null);
	document.getElementById("list_patho").innerHTML = xmlhttp.responseText;
	document.getElementById("list").innerHTML = "";
}

function del_list(code){

	url = 'preappoi2.php?action=delete&code=' + code;
			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
	viewlist();
}

function show_bock(){
	
	if(document.getElementById("bock_lab").style.display=="none"){
		document.getElementById("bock_lab").style.display ="";
	}else{
		document.getElementById("bock_lab").style.display ="none";
	}

}

function listb(number){
	//alert(document.getElementById("detail").value);
	if(document.getElementById("detail").value!='FU05 ผ่าตัด'){
		document.getElementById("setor").style.display='none';
	}
	if(document.getElementById("detail").value=='FU01 ตรวจตามนัด'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU02 ตามผลตรวจ'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU03 นอนโรงพยาบาล'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU04 ทันตกรรม'){
		document.getElementById("room").selectedIndex=5;
	}
	else if(document.getElementById("detail").value=='FU05 ผ่าตัด'){
		document.getElementById("room").selectedIndex=3;
		document.getElementById("setor").style.display='';
	}
	else if(document.getElementById("detail").value=='FU06 สูติ'){
		document.getElementById("room").selectedIndex=8;
	}
	else if(document.getElementById("detail").value=='FU07 คลีนิกฝังเข็ม'){
		document.getElementById("room").selectedIndex=10;
	}
	else if(document.getElementById("detail").value=='FU08 Echo'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU09 มวลกระดูก'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU10 กายภาพ'){
		document.getElementById("room").selectedIndex=9;
	}
	else if(document.getElementById("detail").value=='FU11 ตรวจตามนัดพร้อมประวัติผู้ป่วยใน'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU12 นวดแผนไทย'){
		document.getElementById("room").selectedIndex=11;
	}
	else if(document.getElementById("detail").value=='FU20 ส่องกระเพาะ(คลินิกพิเศษ)'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU14 เจาะเลือดไม่พบแพทย์'){
		document.getElementById("room").selectedIndex=6;
	}
	else if(document.getElementById("detail").value=='FU15 OPD นอกเวลา'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU16 คลินิกพิเศษ'){
		document.getElementById("room").selectedIndex=0;
	}
	else if(document.getElementById("detail").value=='FU17 X-ray ไม่พบแพทย์'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU18 ตัดไหมที่ ER ไม่พบแพทย์'){
		document.getElementById("room").selectedIndex=4;
	}
	else if(document.getElementById("detail").value=='FU19 อัลตร้าซาวด์'){
		document.getElementById("room").selectedIndex=7;
	}
	else if(document.getElementById("detail").value=='FU21 คลินิก COPD'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU22 ตรวจตามนัดOPD เวชศาสตร์ฟื่นฟู'){
		document.getElementById("room").selectedIndex=14;
	}
	else if(document.getElementById("detail").value=='FU23 OPD กายภาพ'){
		document.getElementById("room").selectedIndex=9;
	}
	else if(document.getElementById("detail").value=='FU24 ตรวจตามนัด OPD จักษุ(ตา)'){
		document.getElementById("room").selectedIndex=12;
	}
	else if(document.getElementById("detail").value=='FU25 CT Scan'){
		document.getElementById("room").selectedIndex=0;
	}
	else if(document.getElementById("detail").value=='FU26 EMG'){
		document.getElementById("room").selectedIndex=3;
	}
	else if(document.getElementById("detail").value=='FU27 X-ray ก่อนพบแพทย์'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
	}
	else if(document.getElementById("detail").value=='FU28 Lab ก่อนพบแพทย์'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=18;
		}	
	}
	else if(document.getElementById("detail").value=='FU29 X-ray + Lab ก่อนพบแพทย์'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
		else if(number=="3"){
			document.getElementById("room").selectedIndex=18;
		}	
	}
	else if(document.getElementById("detail").value=='FU30 คลินิกโรคไต'){
		document.getElementById("room").selectedIndex=15;
	}
	else if(document.getElementById("detail").value=='FU13 ตรวจระบบทางเดินอาหาร'){
		if(number=="2"){
			document.getElementById("room").selectedIndex=2;
		}
		else if(number=="1"){
			document.getElementById("room").selectedIndex=1;
		}
		document.getElementById("detail_list").style.display ="block";
		document.getElementById("detail2").style.display ="none";
	}
	else{
		document.getElementById("detail2").style.display ="block";
		document.getElementById("detail_list").style.display ="none";
	}
}

function searchSuggest(action,str,len) {
	
		// str = str+String.fromCharCode(event.keyCode);

		if(str.length >= len){
			url = 'preappoi2.php?action='+action+'&search=' + str;

			xmlhttp = newXmlHttp();
			xmlhttp.open("GET", url, false);
			xmlhttp.send(null);
			document.getElementById('list').style.display=''
			document.getElementById("list").innerHTML = xmlhttp.responseText;
		}
}
</script>
<?php
// ถ้าเป็นวอร์ด ICU,รวม,พิเศษ,สูติ ให้แจ้งเตือนการกรอก AN กรณี FU11 ตรวจตามนัดพร้อมประวัติผู้ป่วยใน
$result1 = mysql_query("SELECT menucode FROM inputm WHERE idname = '".$_SESSION["sIdname"]."' ");
$arr = mysql_fetch_assoc($result1);
$an_alert = false;
if($arr['menucode'] == "ADMICU" 
	|| $arr['menucode'] == "ADMWF" 
	|| $arr['menucode'] == "ADMVIP" 
	|| $arr['menucode'] == "ADMOBG"){
	$an_alert = true;
}
?>
<script type="text/javascript">
function checktext(){
		if(document.getElementById('room').value=="NA"){
			alert('กรุณาเลือกช่อง\"ยื่นใบนัดที่\"');
			return false;
		}
		else if(document.getElementById('detail').value=="NA"){
			alert('กรุณาเลือกช่อง\"นัดมาเพื่อ\"');
			return false;
		}
		else if(document.getElementById('advice').value=="NA"){
			alert('กรุณาเลือกช่อง\"ข้อควรปฏิบัติก่อนพบแพทย์\"');
			return false;
		}
		else if(document.getElementById('depcode').value=="NA"){
			alert('กรุณาเลือกช่อง\"แผนกที่นัด\"');
			return false;
		}

		<?php
		if( $an_alert === true ){ 
			?>
			var detail = document.getElementById('detail').value;
			var detail2 = document.getElementById('detail2').value;
			if( detail == 'FU11 ตรวจตามนัดพร้อมประวัติผู้ป่วยใน' && detail2 == '' ){
				alert("กรุณากรอกเลขที่AN/อื่นๆ");
				return false;
			}
			<?php
		}
		?>

		return true;
}

</script>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;
	window.onload = function () {
		dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('date_surg'));
	};

function fncSubmit(strPage)
{
	if(strPage == "page1")
	{
		document.form1.action="appinsert_stricker.php";
	}
	
	/*if(strPage == "page2")
	{
		document.form1.action="page2.cgi";
	}	*/
	
	document.form1.submit();
}
</script>

<?php 
// แจ้งเตือน กรณีเลือกวันที่ย้อนหลัง
if($date_en < date('Y-m-d')){ 
	?>
	<div style="text-align: center; font-weight: bold; color: red;"><h3>แจ้งเตือน! คุณกำลังเลือกวันที่ย้อนหลัง</h3></div>
	<?php
}
?>
<TABLE border="0" width="100%">
<TR valign="top">
	<TD>
<form  name="form1" method="POST" action="appinsert1.php" onSubmit="return checktext();">
<font face="Angsana New" size = '4'>กรุณาระบุการนัดมาเพื่อ เพื่อที่แผนกทะเบียนจะทำการค้นหา OPD Card ได้ถูกต้อง
<br>

<table border="0" width="100%">
  <tr valign="top"><td width="11%" align="right"><font face="Angsana New">นัดมาเพื่อ&nbsp;&nbsp;&nbsp;</font></td>
    <td width="311"><font face="Angsana New">
      <select size="1" name="detail" onChange="listb(<?=$counter?>)" id="detail">
      <? if($_SESSION["sOfficer"]!="ศุภรัตน์ มิ่งเชื้อ"){ ?>
      <option value="NA"><<นัดมาเพื่อ>></option>
	  <option value="FU51 ติดตามกลุ่มเสี่ยง ตรวจสุขภาพประจำปีกองทัพบก">ติดตามกลุ่มเสี่ยง ตรวจสุขภาพประจำปีกองทัพบก</option>	  
	  <option value="FU52 ติดตามกลุ่มโรค ตรวจสุขภาพประจำปีกองทัพบก">ติดตามกลุ่มโรค ตรวจสุขภาพประจำปีกองทัพบก</option>  
	  <? } ?>
<?php
      if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){
	  $app = "select * from applist where status='Y' and applist ='มวลกระดูก'";
	  }else{
	  $app = "select * from applist where status='Y' and appvalue NOT LIKE 'FU54%' ";
	  }
	  $row = mysql_query($app);

	  $an_check = false;

	  while($result = mysql_fetch_array($row)){
		  $str="";
		if($result['applist']=="ตรวจตามนัดพร้อมประวัติผู้ป่วยใน"){
			$sql1 = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
			$result1 = Mysql_Query($sql1);
			$arr = Mysql_fetch_row($result1);
			
			if($arr[0] == "ADMICU" || $arr[0] == "ADMWF" || $arr[0] == "ADMVIP" || $arr[0] == "ADMOBG"){
					$str= "  Selected  ";
					$an_check = true;
			}
		}
		
		if($result['applist']=="กายภาพ"){
			$sql1 = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
			$result1 = Mysql_Query($sql1);
			$arr = Mysql_fetch_row($result1);
			
			if($arr[0] == "ADMPT"){
					$str= "  Selected  ";
			}
		}		
		?>
		<option value="<?=$result['appvalue']?>" <?=$str;?>><?=$result['applist']?></option>
		<?php
	  }
		?>
      </select>
	  
    </font>
</td>
    <td width="280">
		<font face="Angsana New">
			<?php 
			// ถ้านัดจาก Ward จะแสดงข้อความให้กรอก AN
			if( $an_check === true ){ echo "เลขที่AN/อื่นๆ : "; }
			?>
			<input type="text" id="detail2" name="detail2" size="60">

			<select size="1" name="detail_list" id="detail_list" style="display:none">
				<option value="ส่องกระเพาะอาหาร">ส่องกระเพาะอาหาร</option>
				<option value="ส่องลำไส้ใหญ่">ส่องลำไส้ใหญ่</option>
				<option value="ส่องกระเพาะอาหาร+ส่องลำไส้ใหญ่">ส่องกระเพาะอาหาร+ส่องลำไส้ใหญ่</option>
			</select>

			<?php 
			if($_SESSION['smenucode']=='ADMPT' OR $_SESSION['smenucode']=='ADM'){
				?>
				<select name="ptHelper" id="ptHelper" onchange="addToDetail2()" style="width: 200px;">
					<option value="">---- เลือกข้อมูล ----</option>
					<option value="กรุณา ใส่รองเท้าผ้าใบ หรือรองเท้ารัดส้น (ที่ไม่ใช่รองเท้าคัชชู) มาด้วยทุกครั้ง">กรุณา ใส่รองเท้าผ้าใบ หรือรองเท้ารัดส้น (ที่ไม่ใช่รองเท้าคัชชู) มาด้วยทุกครั้ง</option>
					<option value="โครงการสูงวัยไม่ล้ม ครั้งที่">โครงการสูงวัยไม่ล้ม ครั้งที่</option>
					<option value="นำใบนัดยื่นที่ห้องพยาธิเวลา 07.00น. เจาะเลือดแล้วรับประทานอาหารให้เรียบร้อย ก่อนพบแพทย์">นำใบนัดยื่นที่ห้องพยาธิเวลา 07.00น. เจาะเลือดแล้วรับประทานอาหารให้เรียบร้อย ก่อนพบแพทย์</option>
					<option value="นัดให้ยากระดูกพรุนครั้งที่  เจาะเลือดก่อนพบแพทย์">นัดให้ยากระดูกพรุนครั้งที่  เจาะเลือดก่อนพบแพทย์</option>
					<option value="นัดฉีดเข่า เบิกยาแล้ว">นัดฉีดเข่า เบิกยาแล้ว</option>
					<option value="นัดติดตามอาการ (ถ้าอาการไม่ดีขึ้น)">นัดติดตามอาการ (ถ้าอาการไม่ดีขึ้น)</option>
					<option value="นัดติดตามอาการ (ถ้าอาการไม่ดีขึ้น) พร้อมฟังผลX-ray, Lab, BMD, CT, MRI, ฝังเข็ม, ติดตามผลคัดกรองผู้สูงอายุ (มีค่าบริการนอกเวลาราชการ 300 บาท เบิกไม่ได้)">นัดติดตามอาการ (ถ้าอาการไม่ดีขึ้น) พร้อมฟังผลX-ray, Lab, BMD, CT, MRI, ฝังเข็ม, ติดตามผลคัดกรองผู้สูงอายุ (มีค่าบริการนอกเวลาราชการ 300 บาท เบิกไม่ได้)</option>
					<option value="นัดคัดกรองผู้สูงอายุ">นัดคัดกรองผู้สูงอายุ</option>
					<option value="นัดตรวจคลื่นไฟฟ้าวินิจฉัย EMG จาก พ. ">นัดตรวจคลื่นไฟฟ้าวินิจฉัย EMG จาก พ. </option>
					<option value="ส่งปรึกษาRehab จาก พ.">ส่งปรึกษาRehab จาก พ.</option>
					<option value="นัดให้ยากระดูกพรุนครั้งที่  เจาะเลือด+ทำมวลกระดูก ก่อนพบแพทย์">นัดให้ยากระดูกพรุนครั้งที่  เจาะเลือด+ทำมวลกระดูก ก่อนพบแพทย์</option>
					<option value="นัดติดตามอาการหลังให้ยากระดุกพรุนครั้งที่ ">นัดติดตามอาการหลังให้ยากระดุกพรุนครั้งที่ </option>
					<option value="ผู้ป่วยไม่สามารถมาได้ ให้ญาติติดต่อขอรับยาแทน (ติดต่อขอใบรับยาแทนที่ห้องทะเบียนก่อนพบแพทย์)">ผู้ป่วยไม่สามารถมาได้ ให้ญาติติดต่อขอรับยาแทน (ติดต่อขอใบรับยาแทนที่ห้องทะเบียนก่อนพบแพทย์)</option>
					<option value="พ.สัมมา ขอส่งปรึกษา ">พ.สัมมา ขอส่งปรึกษา </option>
				</select>
				<script type="text/javascript">
					function addToDetail2(){
						var select = document.getElementById('ptHelper');
						var option = select.options[select.selectedIndex];
						document.getElementById('detail2').value = option.value;
						console.log(option.value);
					}
				</script>
				<?php
			}
			?>
		</font>
	</td>
</tr>
<tr>
	<td id="echoResponse" style="color:red; display:none;" colspan="3"></td>
</tr>

  <tr style="display:none" id="setor">
    <td colspan="3">
    <fieldset style="display:inline-block;">
		<legend>ใบเซตผ่าตัด</legend>
    <table width="363">
        <tr><td width="64">วัน/เดือน/ปี</td><td width="287"><input type="text" name="date_surg" id="date_surg" size="10">
          เวลา
          <select name="time1">
            <option value="-" selected="selected">-</option>
            <?php 
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						//if($nonconf_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
          </select>
:
<select name="time2">
  <option value="-" selected="selected">-</option>
  <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
					//	if($nonconf_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
</select></td></tr>
        <tr><td>การวินิจฉัย</td><td><font face="Angsana New">
          <input type="text" id="ordetail1" name="ordetail1" size="30" />
        </font></td></tr>
        <tr><td>การผ่าตัด</td><td><font face="Angsana New">
          <input type="text" id="ordetail2" name="ordetail2" size="30" />
        </font></td></tr>
        <tr><td>ชนิดดมยา</td><td><font face="Angsana New">
          <input type="text" id="ordetail3" name="ordetail3" size="30" />
        </font></td></tr>
        <tr><td>หมายเหตุ</td><td><font face="Angsana New">
          <textarea name="ordetail4" cols="30" rows="4" id="ordetail4"></textarea>
        </font></td></tr>
    </table>
    </fieldset>
	</td>
</tr>

  <tr>
    <td width="115" align="right"><font face="Angsana New" size = '4'><font face="Angsana New">ยื่นใบนัดที่</font></font></td>
    <td colspan="2"><font face="Angsana New" size = '4'><font face="Angsana New">

		<?php 
		// default เป็นตึกใหม่
		$testNewBuilding = array(
			'MD009 นภสมร ธรรมลักษมี',
			'MD006 เลือก ด่านสว่าง',
			'MD007 ณรงค์ ปรีดาอนันทสุข',
			'MD008 อรรณพ ธรรมลักษมี',
			'MD100 เชาวรินทร์ อุ่นเครือ',
			'MD171 วีรวัฒน์ เลิศฤทธิ์เดชา',
			'MD190 วิรดา  อนันตวงศ์',
			'MD200 เมนัญชญา  พงษ์ไพรเจริญ'
		);

		$preOpd = '';
		if(in_array($doctor_post, $testNewBuilding)){
			$preOpd = 'selected="selected"';
		}

		$sql = "SELECT `row_id` FROM `doctor` WHERE `name` = '$doctor_post' AND `position` = '99 เวชปฏิบัติ' LIMIT 1 ";
		$q = mysql_query($sql);
		if($q !== false)
		{
			if(mysql_num_rows($q) > 0)
			{
				$preOpd = 'selected="selected"';
			}
		}


		// if($_SESSION["smenucode"]=="ADMXR"){


		?>

      <select size="1" name="room" id="room">
        <option value="NA">&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>
        <option>จุดบริการนัดที่ 1</option>
        <option id="pre-opd" <?=$preOpd;?>>อาคารเฉลิมพระเกียรติ</option>
        <option id="opd">แผนกทะเบียน</option>
        <option>ห้องฉุกเฉิน</option>
        <option>กองทันตกรรม</option>
        <option>แผนกพยาธิวิทยา</option>
        <option <?=($_SESSION["smenucode"]=="ADMXR") ? 'selected="selected"' : '';?>>แผนกเอกชเรย์</option>
        <option>กองสูติ-นารี</option>
        <option <? if($_SESSION["smenucode"]=="ADMPT"){ echo "selected";}?>>กายภาพ</option>
        <option>คลีนิกฝังเข็ม</option>
        <option>นวดแผนไทย</option>
        <option>ห้องตรวจจักษุ(ตา)</option>
        <option>ห้องตรวจกายภาพบำบัด(ตึกกายภาพ)</option>
        <option>ตรวจตามนัด OPDเวชศาสตร์ฟื้นฟู</option>
        <option>คลีนิกโรคไต</option>
		<option>กายภาพบำบัดชั้น 2</option>
         <option>ห้อง CT SCAN</option>  
        <option>ห้องเก็บเงินรายได้ เบอร์4</option>  <!--#18-->             
        <? if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){?>
        <option selected="selected">ห้อง CT SCAN (ตรวจมวลกระดูก)</option>
        <? } ?>
		<option>ห้องตรวจเฉพาะโรค</option>
		<option>แผนกตรวจสุขภาพ</option>
		<option>คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)</option>
		<option>อาคารแพทย์ทางเลือก</option>
		<option>หอผู้ป่วยพิเศษ3</option>
        </select>
      </font><font face="Angsana New" size = '4'><font face="Angsana New"></font></font></font><font face="Angsana New" size = '4'><font face="Angsana New">เวลา<?php if($_SESSION["sIdname"]== 'ฝังเข็ม' || $_COOKIE["until"] == "ฝังเข็ม"){
	   
	   if(empty($_COOKIE["until"])){
		 @setcookie("until", "ฝังเข็ม", time()+(3600*12));
	   }

	   ?>
        <select size="1" name="capptime">
          <option value="07:30 น. - 08:00 น.">07:30 น. - 08:00 น.</option>
          <option value="08:30 น. - 09:00 น.">08:30 น. - 09:00 น.</option>
          <option value="09:30 น. - 10:00 น.">09:30 น. - 10:00 น.</option>
          <option value="10:30 น. - 11:00 น.">10:30 น. - 11:00 น.</option>
          <option value="11:30 น. - 12:00 น.">11:30 น. - 12:00 น.</option>
          <option value="12:30 น. - 13:00 น.">12:30 น. - 13:00 น.</option>
          <option value="15:30 น. - 16:00 น.">15:30 น. - 16:00 น.</option>
          <option value="16:30 น. - 17:00 น.">16:30 น. - 17:00 น.</option>
          <option value="17:30 น. - 18:00 น.">17:30 น. - 18:00 น.</option>
          <option value="18:30 น. - 19:00 น.">18:30 น. - 19:00 น.</option>
          </select>
         <? }else if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){ ?>
        <select size="1" name="capptime">
          <option value="09:30 น.">09:30 น.</option>
          <option value="13:30 น.">13:30 น.</option>
          </select>         
        <?php }else{ ?>
        <select size="1" name="capptime">
          <option selected>&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3648;&#3623;&#3621;&#3634;&#3609;&#3633;&#3604;&gt;</option>
          <option selected>08:00 &#3609;. - 10.00 &#3609;.</option>
          <option>08:00 &#3609;. - 11.00 &#3609;.</option>
          <option>07:00 &#3609;.</option>
          <option>07:30 &#3609;.</option>
          <option>08:00 &#3609;.</option>
          <option>08:30 &#3609;.</option>
          <option>09:00 &#3609;.</option>
          <option>09:30 &#3609;.</option>
          <option>10:00 &#3609;.</option>
          <option>10:30 &#3609;.</option>
          <option>11:00 &#3609;.</option>
          <option>11:30 &#3609;.</option>
          <option>12:30 &#3609;.</option>
          <option>13:00 &#3609;.</option>
          <option>13:30 &#3609;.</option>
          <option>14:00 &#3609;.</option>
          <option>14:30 &#3609;.</option>
          <option>15:00 &#3609;.</option>
          <option>15:30 &#3609;.</option>
          <option>16:00 &#3609;.</option>
          <option>16:30 &#3609;.</option>
          <option>17:00 &#3609;.</option>
          <option>17:30 &#3609;.</option>
          <option>18:00 &#3609;.</option>
          <option>18:30 &#3609;.</option>
          <option>19:00 &#3609;.</option>
          <option>19:30 &#3609;.</option>
          <option>20:00 &#3609;.</option>
          <option>21:00 &#3609;.</option>
          </select>
        <?php } ?>
      </font></font></td>
    </tr>
	<?php 
	$hideStyle = '';
	if($_SESSION["smenucode"]=="ADMXR"){
		$hideStyle = 'style="display:none;"';
	}
	?>
<tr <?=$hideStyle;?> >
  <td colspan="3"><font face="Angsana New"><A HREF="javascript:show_bock();">เจาะเลือด</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เจาะเลือดเพิ่มเติม <font face="Angsana New">
    <input type="text" name="labm" size="30" />
  </font></td>
  </tr>
 
<tr>
  <td colspan="3"><div id="list_patho"></div></td>
</tr>
<tr>
  <td align="right"><font face="Angsana New">เอกซเรย์&nbsp;</font></td>
  <td colspan="2"><font face="Angsana New">
    <select size="1" name="xray">
      <option selected value="NA">&#3652;&#3617;&#3656;&#3617;&#3637;&#3585;&#3634;&#3619;&#3648;&#3629;&#3585;&#3595;&#3648;&#3619;&#3618;&#3660;</option>
      <option>CXR</option>
      <option>KUB</option>
      <option>เอกซเรย์ ก่อนพบแพทย์</option>
      <option>อัลตราซาวนด์</option>
      <option>ตรวจ IVP</option>
      &nbsp;
      </select>
    </font><font face="Angsana New">
		<select  name="xray2" id="xray2">
			<option  selected value="">----ไม่ระบุ----</option>
			<option  value="U/S UPPER ABDOMEN">U/S UPPER ABDOMEN</option>
			<option  value="U/S WHOLE ABDOMEN">U/S WHOLE ABDOMEN</option>
			<option  value="U/S KUB">U/S KUB</option>
			<option  value="U/S BREAST">U/S BREAST</option>
			<option  value="U/S BOTH LEG">U/S BOTH LEG</option>
			<option  value=">U/S LT LEG">U/S LT LEG</option>
			<option  value="U/S PR LEG">U/S PR LEG</option>
			<option  value="U/S EXTREMITY">U/S EXTREMITY</option>
			<option  value="U/S THYROID">U/S THYROID</option>
			<option  value="U/S NECK">U/S NECK</option>
			<option  value="U/S BACK">U/S BACK</option>
			<option  value="U/S BUTTOCK">U/S BUTTOCK</option>
			<option  value="U/S CAROTID ARTERY">U/S CAROTID ARTERY</option>
			<option  value="U/S RENAL ARTERY">U/S RENAL ARTERY</option>
			<option  value="U/S SCROTUM">U/S SCROTUM</option>
			<option  value="U/S LOWER ABDOMEN">U/S LOWER ABDOMEN</option>
			<option  value="U/S ARM">U/S ARM</option>
			<option  value="U/S FOREARM">U/S FOREARM</option>
			<option  value="U/S HAND">U/S HAND</option>
			<option  value="U/S THIGH">U/S THIGH</option>
			<option  value="U/S FOOT">U/S FOOT</option>
			<option  value="U/S HEAD">U/S HEAD</option>
			<option  value="U/S PAROTID GLAND">U/S PAROTID GLAND</option>
		</select>
    </font></td>
  </tr>
<tr>
  <td align="right"><font face="Angsana New">อื่นๆ&nbsp;&nbsp;</font></td>
  <td colspan="2"><font face="Angsana New">
    <input type="text" name="other" size="30" /></font></td>
  </tr>
 <tr>
  <td align="right">ข้อควรปฏิบัติก่อนพบแพทย์</td>
  <td colspan="2"><font face="Angsana New" size = '4'>
  <? if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){ ?>
     <select size="1" name="advice" id="advice">
      <option value="ไม่มี" selected="selected">ไม่มี</option
      ></select> 
  <? }else{ ?>
    <select size="1" name="advice" id="advice" style="width: 200px;">
      <option selected value="NA">--- กรุณาเลือก ---</option>
      <option value="ไม่มี" <? if($_SESSION["smenucode"]=="ADMPT" OR $_SESSION["smenucode"]=="ADMXR"){ echo "selected";}?>>ไม่มี</option>
      <option>ไม่ต้องงดน้ำหรืออาหาร</option>
      <option>งดน้ำหวานและอาหารหลังเวลา 20:00 น.(ให้ดื่มน้ำเปล่าได้)</option>
      <option>งดน้ำหวานและอาหารหลังเวลา 24:00 น.(ให้ดื่มน้ำเปล่าได้)</option>
      <option>งดน้ำและอาหารหลังเวลา 20:00 น.</option>
	  <option>งดน้ำและอาหารหลังเวลา 20:00 น. ดื่มน้ำเปล่าได้</option>
      <option>งดน้ำและอาหารหลังเวลา .............. น.</option>
      <option>เอกซเรย์ ก่อนพบแพทย์</option>
      <option>งดสวมใส่เครื่องประดับทุกชนิด งดทาโลชั่น แป้งบริเวณต้นคอ แขน และขา</option>
	  <option value="เก็บปัสสาวะส่งตรวจก่อนพบแพทย์">เก็บปัสสาวะส่งตรวจก่อนพบแพทย์</option>
      <option value="งดน้ำ อาหารตั้งแต่เวลา...............วันที่......................">งดน้ำ อาหารตั้งแต่เวลา...............วันที่......................</option>
      <option value="ดื่มน้ำเปล่ามากๆ ก่อนเวลานัดตรวจ ประมาณครึ่งชั่วโมง แล้วกลั้นปัสสาวะไว้จนกว่าจำทำการตรวจเสร็จ">ดื่มน้ำเปล่ามากๆ ก่อนเวลานัดตรวจ ประมาณครึ่งชั่วโมง แล้วกลั้นปัสสาวะไว้จนกว่าจำทำการตรวจเสร็จ</option>
      <option value="วันที่......................มื้อเย็น รับประทานอาหารอ่อน เช่น ข้าวต้ม โจ๊ก เวลา 20.00 น. ทานยาระบาย 3 เม็ด">วันที่......................มื้อเย็น รับประทานอาหารอ่อน เช่น ข้าวต้ม โจ๊ก เวลา 20.00 น. ทานยาระบาย 3 เม็ด</option>
      <option value="หลังเที่ยงคืน งดอาหารและน้ำ จนกว่าจะทำการตรวจเสร็จ">หลังเที่ยงคืน งดอาหารและน้ำ จนกว่าจะทำการตรวจเสร็จ</option>      
      <option value="เช้าวันที่......................สวนอุจจาระก่อนมาโรงพยาบาล">เช้าวันที่......................สวนอุจจาระก่อนมาโรงพยาบาล</option>
	  <option value="งดน้ำและอาหารหลังเวลา 24:00 น.">งดน้ำและอาหารหลังเวลา 24:00 น.</option>
	  <option value="งดน้ำและอาหารหลังเวลา 24:00 น. หลังเวลา 08:00 น. เริ่มกลั้นปัสสาวะ">งดน้ำและอาหารหลังเวลา 24:00 น. หลังเวลา 08:00 น. เริ่มกลั้นปัสสาวะ</option>
	  <option value="ดื่มน้ำมากๆ แล้วกลั้นปัสสาวะจนกว่าจะตรวจเสร็จ">ดื่มน้ำมากๆ แล้วกลั้นปัสสาวะจนกว่าจะตรวจเสร็จ</option>
	  <option value="นำผลเก่ามาด้วยทุกครั้ง">นำผลเก่ามาด้วยทุกครั้ง</option>
	  <option value="งดน้ำและอาหารหลังเวลา 12.00 น.">งดน้ำและอาหารหลังเวลา 12.00 น.</option>
	  <option value="งดน้ำและอาหารหลังเวลา 12.00 น. เริ่มกลั้นปัสสาวะหลังเวลา 15.00 น.">งดน้ำและอาหารหลังเวลา 12.00 น. เริ่มกลั้นปัสสาวะหลังเวลา 15.00 น.</option>
	  <option value="งดน้ำและอาหารหลัง 11.00 น.">งดน้ำและอาหารหลัง 11.00 น.</option>
	  <option value="งดน้ำและอาหารหลัง 11.00 น. หลัง 14.00 น.เริ่มกลั้นปัสสาวะ">งดน้ำและอาหารหลัง 11.00 น. หลัง 14.00 น.เริ่มกลั้นปัสสาวะ</option>
	<option value="กรุณาสวมใส่รองเท้าผ้าใบ หรือรองเท้ารัดส้นที่ไม่ใช่คัทชูมาด้วยทุกครั้ง">กรุณาสวมใส่รองเท้าผ้าใบ หรือรองเท้ารัดส้นที่ไม่ใช่คัทชูมาด้วยทุกครั้ง</option>
	<option value="นัดให้ยากระดูกพรุนครั้งที่.....เจาะเลือดเวลา07.00น. ทำมวลกระดูกซ้ำเวลา08.30น. ก่อนพบแพทย์">นัดให้ยากระดูกพรุนครั้งที่.....เจาะเลือดเวลา07.00น. ทำมวลกระดูกซ้ำเวลา08.30น. ก่อนพบแพทย์</option>
	<option value="ท่านที่ส่งอุจจาระแล้ว สำหรับสิทธิ์เบิกจ่ายตรง /เบิกครังจังหวัด กรุณาอยู่รอเจ้าหน้าที่ห้องพยาธิเรียกเพื่อรูดบัตรประชาชนก่อนกลับทุกครั้ง">ท่านที่ส่งอุจจาระแล้ว สำหรับสิทธิ์เบิกจ่ายตรง /เบิกครังจังหวัด กรุณาอยู่รอเจ้าหน้าที่ห้องพยาธิเรียกเพื่อรูดบัตรประชาชนก่อนกลับทุกครั้ง</option>
      </select>
      <? } ?>
  </font></td>
  </tr>

<tr>
  <td align="right"><font face="Angsana New">แผนกที่นัด</font></td>
  <td><font face="Angsana New">	
  <select size="1" name="depcode" id="depcode">
    <? if($_SESSION["sOfficer"]!="ศุภรัตน์ มิ่งเชื้อ"){?>
      <option selected value="NA">--- เลือกแผนกที่นัด ---</option>
      <? } ?>
    <?
      $dep = "select * from departments  WHERE depstatus='y' order by depcode ";
	  $row = mysql_query($dep);
	  while($result = mysql_fetch_array($row)){
		  $str="";
		  if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){ 
		  	if($result['depcode']=="U28"){
				$str = " Selected ";
			}	
		  }
		  $depcode=$result['depcode']." ".$result['depname'];
?>
    <option value="<?=$depcode;?>" <?=$str;?>><?=$depcode?></option>
    <?
	  }
	?>
	</select>
	
  </font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td align="right"><font face="Angsana New">เบอร์โทรศัพท์ผู้ป่วย</font></td>
  <td><font face="Angsana New">
    <input type="text" name="telp" size="20" value="<?=$rowT['phone']?>" />
  </font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2"><font face="Angsana New" style="color: red;">* ถ้าผู้ป่วยเปลี่ยนแปลงหมายเลขโทรศัพท์ให้กรอกหมายเลขโทรศัพท์ใหม่แทนหมายเลขเดิม</font></td>
  <td>&nbsp;</td>
</tr>
<tr>
  <td colspan="2" align="center"><input type="submit" value="     ตกลง (A5)    " name="B1" /> <input name="btnButton1" type="button" value="ตกลง (ใบนัดสติ๊กเกอร์)"  onClick="JavaScript:fncSubmit('page1')">
    <a target=_top  href="../nindex.htm"><< เมนู</a></td>
  <td>&nbsp;</td>
</tr>
</table>
</font>
<br />
</p>
<div style='margin-top:20px; margin-left:20px;color:blue;font-weight:bold;font-size:24px;'>กรุณาตรวจสอบข้อมูลของผู้ป่วยให้ถูกต้อง เพื่อดำเนินการต่อไป...</div>
	<input type="hidden" name="appd" value="<?php echo $appd; ?>">
<input type="hidden" name="chkhn" id="chkhn" value="<?=$_POST["chkhn"];?>">
<input type="hidden" name="cPtname" value="<?= $cPtname ?>">
<input type="hidden" name="cAge" value="<?= $cAge ?>">
<input type="hidden" name="chkidcard" id="chkidcard" value="<?=$_POST["chkidcard"];?>">  
  </form>
&nbsp;&nbsp;&lt;&lt;&nbsp;<a target=_self  href='hnappoi1.php'>ออกใบนัดใหม่</a>

<script>

</script>


</TD>
	<TD>
	
	<?php
$i=0;
$sql2 = "select * from labcare where labstatus='Y' and lab_list !=0 order by lab_list asc";
$rows2=mysql_query($sql2);
while($result2=mysql_fetch_array($rows2)){	
	$list_lab_check[$i]["code"] = $result2['code'];
	$list_lab_check[$i]["detail"] = $result2['lab_listdetail'];
	$i++;
}

	$r=5;
	$count = count($list_lab_check);

?>

<TABLE id="bock_lab" width="100%" border="1" bordercolor='#000000' cellpadding="3" cellspacing="0" style="display:none;">
<TR valign="top">
	<TD width="500">
	<CENTER><B>รายการตรวจทางพยาธิ</B></CENTER>
<TABLE width="100%" align="left" border="0">
<TR  valign="top">
	<TD  colspan="<?php echo $r*2;?>" align='left' >ตรวจLAB อื่นๆ ระบุ : <INPUT TYPE="text" NAME="" size="13" onKeyPress="searchSuggest('lab',this.value,2);"><Div id="list"></Div></TD>
</TR>
<TR>
<?php
	for($i=1;$i<=$count;$i++){
		
		
		echo "<TD valign='top'><A HREF=\"javascript:void(0);\" onclick=\"addtolist('".jschars($list_lab_check[$i-1]["code"])."');\" >".jschars($list_lab_check[$i-1]["detail"])."</A></TD>";
		if($i%$r==0)
			echo "</TR><TR>";
	}
?>
</TR>
<TR>
	<TD colspan="<?php echo $r*2;?>">
	
		<?php
			/*$sql = "Select code, detail From labcare where left(code,3) ='DR@' ";
			$result = Mysql_Query($sql);
			if(Mysql_num_rows($result) > 0){
				echo "สูตร LAB<BR>";
			while($arr = Mysql_fetch_assoc($result)){
				$i=0;
				$list = array();
				$sql2 = "Select code From labsuit where suitcode = '".$arr["code"]."' ";
				$result2 = Mysql_Query($sql2);
				while($arr2 = Mysql_fetch_assoc($result2)){
					$list[$i] = $arr2["code"];
					$i++;
				}

				echo "<A HREF=\"#\" Onclick=\"addsuittolist('".implode("][",$list)."');\">".$arr["detail"]."</A><BR>";
			}		
			}*/
		?>
	</TD>
</TR>
</TABLE>
	
	</TD>
</TR>
</TABLE>
</body>
</html>