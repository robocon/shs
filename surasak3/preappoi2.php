<?php
session_start();
session_register("cdoctor");
session_register("appd");

global $dt_doctor, $cdoctor, $doctor;

if(!function_exists('dump'))
{
	function dump($txt)
	{
		echo "<pre>";
		var_dump($txt);
		echo "</pre>";
	}
}

 if(isset($_GET["action"])){
	header("content-type: application/x-javascript; charset=TIS-620");
}

include("connect.inc");   

if(isset($_GET["action"])  && $_GET["action"] == "viewlist"){

	// var_dump($_SESSION);
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
}else if(isset($_GET["action"]) && $_GET["action"] == "addtolist"){

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
}else if(isset($_GET["action"]) && $_GET["action"] == "delete"){
	
	$count = count($_SESSION["list_code"]);
	
	$j=$_GET["code"];


	for($i=$j;$i<$count;$i++){
		$_SESSION["list_code"][$i] = $_SESSION["list_code"][$i+1];
		$_SESSION["list_detail"][$i] = $_SESSION["list_detail"][$i+1];

	}
	
	unset($_SESSION["list_code"][$count-1]);
	unset($_SESSION["list_detail"][$count-1]);


	exit();
}else if(isset($_GET["action"]) && $_GET["action"] == "lab"){

	$sql = "Select code, detail From labcare where  detail like '%".$_GET["search"]."%' AND part = 'lab' AND (left(code,1) >='0' AND left(code,1) <='9') Order by numbered ASC";

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
}


if(empty($_POST['date_appoint']) && !empty($_POST['date_appoint_old']))
{
	$_POST['date_appoint'] = $_POST['date_appoint_old'];
	$doctor = $dt_doctor = $_POST['doctor'] = $_POST['doctor_name'];
}

$officer_name = trim($_SESSION['sOfficer']);
$doctor_name = trim($_POST['doctor']);


if( !$_POST['date_appoint'])
{
	?><p>กรุณาเลือกวันที่นัด <a href="javascript:window.history.back();">คลิกที่นี่</a> เพื่อกลับไปหน้าเลือกวันที่</p><?php
	exit;
}

// @todo ยังไม่ได้ทำ lock นัดแบบแบ่งเช้า-บ่าย

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

	$months = array(
		'มกราคม' => '01', 'กุมภาพันธ์' => '02','มีนาคม' => '03', 'เมษายน' => '04','พฤษภาคม' => '05', 'มิถุนายน' => '06',
		'กรกฎาคม' => '07', 'สิงหาคม' => '08','กันยายน' => '09', 'ตุลาคม' => '10','พฤศจิกายน' => '11', 'ธันวาคม' => '12',
	);
	
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
	<meta http-equiv="Content-Type" content="text/html; charset=windows-874">
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
	  // session_register("cappdate");
	 // session_register("cappmo");
	 // session_register("cthiyr");
	 
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

	$def_fullm_th = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
	$month_int = array_search($arr[1], $def_fullm_th);
	$from_date_th = strtotime(($arr['2'] - 543).'-'.$month_int.'-'.$arr['0']);
	$test_curr_date_en = strtotime(date('Y-m-d'));

	$day = $arr[0];
	$year = $arr[2];
	$datenut = $day.$month.$year;
	$datenut1 = $day."-".$month."-".$year;
	$year -=543; 

	if($from_date_th < $test_curr_date_en){
		echo "ไม่สามารถเลือกวันที่ย้อนหลังได้ กรุณาเลือกวันใหม่";
		exit;
	}
	else{*/
	
		$dd = getdate ( mktime ( 0, 0, 0, $month, $day, $year ));

		/*
		if($dd['weekday']=="Saturday" || $dd['weekday']=="Sunday"){
			$droffline = "select count(*) from dr_offline where name = '$cdoctor' and dateoffline = '".$datenut1."' ";
				$rowdr1 = mysql_query($droffline);
				$showdr1 = mysql_fetch_array($rowdr1);
				if($showdr1[0]=="1"){
					?>
						<script>
							if(confirm("แพทย์ไม่ได้ทำการออกตรวจ ต้องการที่จะเลือกอยู่หรือไม่?")==true){
								
							}  
							else{
								window.history.back();
							}
						</script>
					<?
				}
		}else{
			include("connect.inc");   
			$droff = "select count(*) from doctor where name = '$cdoctor' and ".$dd['weekday']." = '1' ";
			//echo $droff;
			$rowdr = mysql_query($droff);
			$showdr = mysql_fetch_array($rowdr);
			//echo $showdr[0];
			if($showdr[0]!='1'){
				?>
				<script>
					if(confirm("แพทย์ไม่ได้ทำการออกตรวจ ต้องการที่จะเลือกอยู่หรือไม่?")==true){
						
					}  
					else{
						window.history.back();
					}
				</script>
				<?
			}else{
				$droffline = "select count(*) from dr_offline where name = '$cdoctor' and dateoffline = '".$datenut1."' ";
				$rowdr1 = mysql_query($droffline);
				$showdr1 = mysql_fetch_array($rowdr1);
				if($showdr1[0]=="1"){
					?>
						<script>
							if(confirm("แพทย์ไม่ได้ทำการออกตรวจ ต้องการที่จะเลือกอยู่หรือไม่?")==true){
								
							}  
							else{
								window.history.back();
							}
						</script>
					<?
				}
			}
		}
		*/
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
   $arrdr2 = array('MD008','MD009','MD007','MD072','MD036','MD041','MD016','MD047','MD088','MD100');
   
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
   print "<p><font face='Angsana New' size = '4'>ชื่อ $cPtname  HN: $cHn อายุ $cAge &nbsp;<B>สิทธิ:$cptright:$idguard</font></B><br>";
  print "<font face='Angsana New' size = '4'>แพทย์ $cdoctor วันที่: $cdate_appoint&nbsp; </font></B></p>";
   $queryT="SELECT phone FROM opcard where hn='$cHn'";
   $resultT = mysql_query($queryT);
   $rowT = mysql_fetch_array($resultT);

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
 while (list ($apptime,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;
            print (" <tr>\n".
           //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '3'><b>$apptime</b>&nbsp;&nbsp;</a></td>\n".
 
//    "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '4'><a target=_BLANK href=\"checkidchk.php? idcard=$idcard\">$idcard&nbsp;&nbsp;</a></td>\n".
             //  "  <td BGCOLOR=66CDAA><font face='Angsana New'>$detail&nbsp;&nbsp;</td>\n".
        "  <td BGCOLOR=66CDAA><font face='Angsana New' size = '3'>นัดจำนวน&nbsp; = &nbsp;$duplicate &nbsp;&nbsp;คน</td>\n".
               " </tr>\n&nbsp;");
               }
 print "<br><font face='Angsana New' size = '5'><b>จำนวนผู้ป่วยทั้งหมด&nbsp;&nbsp; $num&nbsp;&nbsp;คน</b></a> ";
  
?>

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
		document.getElementById("setor").style.display='block';
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
		document.getElementById("room").selectedIndex=3;
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

<TABLE border="0">
<TR valign="top">
	<TD>

	<?php 
	// ดึงข้อมูลนัดเวลาแก้ไข
	$appoint_id = $_POST['appoint_id'];
	$appoint = array();
	if(isset($appoint_id) && !empty($appoint_id))
	{
		$app_sql = "SELECT * FROM `appoint` WHERE `row_id` = '$appoint_id' ";
		$q_appoint = mysql_query($app_sql);
		
		if (mysql_num_rows($q_appoint) > 0) {
			$appoint = mysql_fetch_assoc($q_appoint);
		}
	}
	?>
<form  name="form1" method="POST" action="appinsert1.php" onSubmit="return checktext();">
<font face="Angsana New" size = '4'>กรุณาระบุการนัดมาเพื่อ เพื่อที่แผนกทะเบียนจะทำการค้นหา OPD Card ได้ถูกต้อง
<br>

<table border="0">
  <tr><td><font face="Angsana New">นัดมาเพื่อ&nbsp;&nbsp;&nbsp;</font></td>
    <td width="311"><font face="Angsana New">
      <select size="1" name="detail" onChange="listb(<?=$counter?>)" id="detail">
      <? if($_SESSION["sOfficer"]!="ศุภรัตน์ มิ่งเชื้อ"){ ?>
      <option value="NA"><<นัดมาเพื่อ>></option>  
	  <? } ?>
<?
      if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){
	  $app = "select * from applist where status='Y' and applist ='มวลกระดูก'";
	  }else{
	  $app = "select * from applist where status='Y' ";
	  }
	  $row = mysql_query($app);

	  $an_check = false;

	while($result = mysql_fetch_array($row)){
		$str="";
		if($result['applist']=="ตรวจตามนัดพร้อมประวัติผู้ป่วยใน"){
			if($_SESSION['smenucode'] == "ADMICU" || $_SESSION['smenucode'] == "ADMWF" || $_SESSION['smenucode'] == "ADMVIP" || $_SESSION['smenucode'] == "ADMOBG"){
				$str= "  Selected  ";
				$an_check = true;
			}
		}
		
		if($result['applist']=="กายภาพ"){
			if($_SESSION['smenucode']=="ADMPT")
			{
				$str= "  Selected  ";
			}
		}

		if(empty($str))
		{
			$str = ( $result['appvalue'] == $appoint['detail'] ) ? 'selected' : '' ;
		}

		?>
      	<option value="<?=$result['appvalue']?>" <?=$str;?>><?=$result['applist']?></option>
        <?
	}
		?>
      </select>
    </font></td>
    <td width="280"><font face="Angsana New">

	<?php 
	// U08  หอผู้ป่วยรวม
	// U19  หอผู้ป่วยพิเศษ3
	// U03  หอผู้ป่วยสูตินรี
	// U04  หอผู้ป่วยหนักICU
	// U05  ห้องผ่าตัด
	$dep_ward_lists = array('U08','U19','U03','U04','U05');
	$dep_short = substr($appoint['depcode'], 0, 3);

	if(in_array($dep_short, $dep_ward_lists)==true)
	{
		$an_check = true;
	}


	// ถ้านัดจาก Ward จะแสดงข้อความให้กรอก AN
	if( $an_check === true ){ echo "เลขที่AN/อื่นๆ : "; }
	?>
	<input type="text" id="detail2" name="detail2" size="20" value="<?=$appoint['detail2'];?>">

	<select size="1" name="detail_list" id="detail_list" style="display:none">
		<option value="ส่องกระเพาะอาหาร">ส่องกระเพาะอาหาร</option>
		<option value="ส่องลำไส้ใหญ่">ส่องลำไส้ใหญ่</option>
		<option value="ส่องกระเพาะอาหาร+ส่องลำไส้ใหญ่">ส่องกระเพาะอาหาร+ส่องลำไส้ใหญ่</option>
	</select>

</font>
</td>
</tr>

<?php 
$or_item = array();
$or_display = 'style="display: none;"';
$or_id = false;
if(isset($appoint_id))
{
	$appdate_en = $appoint['appdate_en'];
	$hn = $appoint['hn'];
	$or_sql = "SELECT * FROM `set_or` WHERE `date_surg` = '$appdate_en' AND `hn` = '$hn' LIMIT 1";
	$q_or = mysql_query($or_sql);
	if(mysql_num_rows($q_or) > 0)
	{
		$or_display = '';
		$or_item = mysql_fetch_assoc($q_or);
		$or_id = $or_item['row_id'];
		list($time1, $time2, $timexxx) = explode(':', $or_item['time']);
	}
}
?>
<!-- หน้าต่าง set or -->
<tr <?=$or_display;?> id="setor">
    <td>&nbsp;</td>
    <td colspan="2">
    	<fieldset>
			<legend>ใบเซตผ่าตัด</legend>
    		<table width="363">
				<tr>
					<td width="64">วัน/เดือน/ปี</td>
					<td width="287">

						<?php 
						if(!empty($or_id))
						{
							?>
							<input type="hidden" name="or_id" value="<?=$or_id;?>">
							<?php
						}
						?>
						<input type="text" name="date_surg" id="date_surg" size="10" value="<?=$or_item['date_surg'];?>"> เวลา
						<select name="time1">
							<option value="-" selected="selected">-</option>
							<?php 
							for($i=0;$i<=23;$i++){ 

								$time1_selected = ($time1 == $i) ? 'selected' : '' ;

								echo "<Option value=\"".sprintf('%02d',$i)."\" ".$time1_selected." >".sprintf('%02d',$i)."</Option>";
							}?>
						</select>
						:
						<select name="time2">
							<option value="-" selected="selected">-</option>
							<?php 
							for($i=0;$i<=59;$i=$i+5){ 

								$time2_selected = ($time2 == $i) ? 'selected' : '' ;

								echo "<Option value=\"".sprintf('%02d',$i)."\" ".$time2_selected." >".sprintf('%02d',$i)."</Option>";
							}?>
						</select>
					</td>
				</tr>
				<tr>
					<td>การวินิจฉัย</td>
					<td><font face="Angsana New">
						<input type="text" id="ordetail1" name="ordetail1" size="30" value="<?=$or_item['diag'];?>"/>
						</font>
					</td>
				</tr>
				<tr>
					<td>การผ่าตัด</td>
					<td><font face="Angsana New">
						<input type="text" id="ordetail2" name="ordetail2" size="30" value="<?=$or_item['surg'];?>"/>
						</font>
					</td>
				</tr>
				<tr>
					<td>ชนิดดมยา</td>
					<td><font face="Angsana New">
						<input type="text" id="ordetail3" name="ordetail3" size="30" value="<?=$or_item['inhalation_type'];?>"/>
						</font>
					</td>
				</tr>
				<tr>
					<td>หมายเหตุ</td>
					<td><font face="Angsana New">
						<textarea name="ordetail4" cols="30" rows="4" id="ordetail4"><?=$or_item['comment'];?></textarea>
						</font>
					</td>
				</tr>
    		</table>
    	</fieldset>
	</td>
</tr><!-- ปิด tr display none -->

  <tr>
    <td width="115"><font face="Angsana New" size = '4'><font face="Angsana New">ยื่นใบนัดที่</font></font></td>
    <td colspan="2"><font face="Angsana New" size = '4'><font face="Angsana New">

		<?php 
		// เงื่อนไขที่จะให้ default เป็นตึกใหม่คือ 
		// 1. มีชื่อตามรายการข้างล่างนี้
		// 2. เป็นหมอIntern 
		$status_new_build = false;

		$testNewBuilding = array(
			'MD009 นภสมร ธรรมลักษมี',
			'MD006 เลือก ด่านสว่าง',
			'MD007 ณรงค์ ปรีดาอนันทสุข',
			'MD008 อรรณพ ธรรมลักษมี',
			'MD100 เชาวรินทร์ อุ่นเครือ',
			'MD171 วีรวัฒน์ เลิศฤทธิ์เดชา'
		);

		$preOpd = '';
		if(in_array($doctor_post, $testNewBuilding)){
			$preOpd = 'selected="selected"';
			$status_new_build = true;
		}

		$sql = "SELECT `row_id` FROM `doctor` WHERE `name` = '$doctor_post' AND `position` = '99 เวชปฏิบัติ' LIMIT 1 ";
		$q = mysql_query($sql);
		if($q !== false)
		{
			if(mysql_num_rows($q) > 0)
			{
				$preOpd = 'selected="selected"';
				$status_new_build = true;
			}
		}

		$room_lists = array(
			'NA' => '<เลือกห้องตรวจ>',
			'จุดบริการนัดที่ 1',
			'อาคารเฉลิมพระเกียรติ',
			'แผนกทะเบียน',
			'ห้องฉุกเฉิน',
			'กองทันตกรรม',
			'แผนกพยาธิวิทยา',
			'แผนกเอกชเรย์',
			'กองสูติ-นารี',
			'กายภาพ',
			'คลีนิกฝังเข็ม',
			'นวดแผนไทย',
			'ห้องตรวจจักษุ(ตา)',
			'ห้องตรวจกายภาพบำบัด(ตึกกายภาพ)',
			'ตรวจตามนัด OPDเวชศาสตร์ฟื้นฟู',
			'คลีนิกโรคไต',
			'กายภาพบำบัดชั้น 2',
			'ห้อง CT SCAN',
			'ห้องเก็บเงินรายได้ เบอร์4',
			'ห้อง CT SCAN (ตรวจมวลกระดูก)',
			'ห้องตรวจเฉพาะโรค',
			'แผนกตรวจสุขภาพ',
			'คลินิก ARI (ติดเชื้อระบบทางเดินหายใจ)' 
		);

		?>

<select size="1" name="room" id="room">
<?php 
foreach ($room_lists as $key => $room) {
	$room_value = $room;

	$select = $id = '';


	if($room=='อาคารเฉลิมพระเกียรติ'){
		$id = 'id="pre-opd"';
	}elseif ($room=='แผนกทะเบียน') {
		$id = 'id="opd"';
	}

	if($status_new_build==true && $room=='อาคารเฉลิมพระเกียรติ')
	{
		$select = 'selected';
	}
	elseif($_SESSION["smenucode"]=="ADMPT" && $room=='กายภาพ')
	{
		$select = 'selected';
	}
	elseif($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ" && $room=='กายภาพ' )
	{
		$select = 'selected';
	}
	else
	{
		$select = ($room==$appoint['room']) ? 'selected' : 'ห้อง CT SCAN (ตรวจมวลกระดูก)' ;
	}

	if($room == '<เลือกห้องตรวจ>')
	{
		$room_value = 'NA';
	}

	?>
	<option value="<?=$room_value;?>" <?=$id;?> <?=$select;?>><?=$room;?></option>
	<?php
}
?>
</select></font></font>

<font face="Angsana New" size = '4'>
	<font face="Angsana New">เวลา
		<?php 
		if($_SESSION["sIdname"]== 'ฝังเข็ม' || $_COOKIE["until"] == "ฝังเข็ม"){

			if(empty($_COOKIE["until"])){
				@setcookie("until", "ฝังเข็ม", time()+(3600*12));
			}

			$time_appoint = array(
				'07:30 น. - 08:00 น.',
				'08:30 น. - 09:00 น.',
				'09:30 น. - 10:00 น.',
				'10:30 น. - 11:00 น.',
				'11:30 น. - 12:00 น.',
				'12:30 น. - 13:00 น.',
				'15:30 น. - 16:00 น.',
				'16:30 น. - 17:00 น.',
				'17:30 น. - 18:00 น.',
				'18:30 น. - 19:00 น.'
			);

		}else if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){ 
			$time_appoint = array( 
				'09:30 น.',
				'13:30 น.'
			);
		
		}else{ 
			$time_appoint = array(
				'08:00 น. - 10:00 น.',
				'08:00 น. - 11:00 น.',
				'07:00 น.','07:30 น.','08:00 น.','08:30 น.',
				'09:00 น.','09:30 น.','10:00 น.','10:30 น.',
				'11:00 น.','11:30 น.','12:30 น.','13:00 น.',
				'13:30 น.','14:00 น.','14:30 น.','15:00 น.',
				'15:30 น.','16:00 น.','16:30 น.','17:00 น.',
				'17:30 น.','18:00 น.','18:30 น.','19:00 น.',
				'19:30 น.','20:00 น.','21:00 น.'
			);
		} 
		?>
		<select size="1" name="capptime">
			<?php
			foreach ($time_appoint as $key => $value) { 
				$selected = ($value===$appoint['apptime']) ? 'selected' : '' ;
				?>
				<option value="<?=$value;?>" <?=$selected;?> ><?=$value;?></option>
				<?php
			}
			?>
		</select>

</font></font>
	</td>
    </tr>
<tr>
  <td colspan="3"><font face="Angsana New"><A HREF="javascript:show_bock();">เจาะเลือด</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เจาะเลือดเพิ่มเติม </font>
  <font face="Angsana New">
    <input type="text" name="labm" size="30" value="<?=$appoint['labm'];?>"/>
  </font>
</td>
  </tr>
 
<tr>
  <td colspan="3">
	  <!-- แสดงรายการแลป -->
	  <!-- 
		  // เรียกตัวนีก่อน เพื่อเก็บใน session
			$_GET["action"] == "addtolist"

			$sql = "Select detail, yprice, nprice, lab_listdetail From labcare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice, $lab_listdetail) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	array_push($_SESSION["list_detail"],$detail);
	array_push($_SESSION["lab_lists"],$lab_listdetail);


			แล้วเรียก ajax ตัวนี้ viewlist อีกทีเพื่อแสดงผล
			echo "<TABLE bgcolor='#FFFFD2'>
	<TR>
		<TD>";
	for($i=0;$i<$count;$i++){
		echo "<A HREF=\"javascript:del_list(",$i,");\" >",$_SESSION["list_detail"][$i],"</A><BR>";
	}
	echo "</TD>
	</TR>
	</TABLE>";

		-->


<div id="list_patho">
<?php 
$appoint_lab = $appoint['row_id'];
$sql = "SELECT * FROM `appoint_lab` WHERE `id` = '$appoint_lab' ";
$q = mysql_query($sql);

$appoint_patho_list = array();

if(mysql_num_rows($q) > 0)
{
	?>
	<table bgcolor="#FFFFD2">
	<?php 
	$lab_i = 0;
	while ($app_lab = mysql_fetch_assoc($q)) {

		$lab_code = $app_lab['code'];

		$sql = "Select detail, yprice, nprice, lab_listdetail From labcare where code = '$lab_code' limit 1; ";
		list($detail, $yprice, $nprice, $lab_listdetail) = mysql_fetch_row(mysql_query($sql));

		array_push($_SESSION["list_code"],$lab_code);
		array_push($_SESSION["list_detail"],$detail);
		array_push($_SESSION["lab_lists"],$lab_listdetail);

		?>
		<tr>
			<td>
			<A HREF="javascript:del_list(<?=$lab_i;?>);" ><?=$detail;?></A><BR>
			</td>
		</tr>
		<?php 
		$lab_i++;
	}
	?>
	</table>
	<?php
}



?>
</div>
  </td>
</tr>
<tr>
	<td><font face="Angsana New">เอกซเรย์&nbsp;</font></td>
	<td colspan="2">
	<?php 
	/**
	 * @todo
	 * มันจะมีปัญหาก็คือหน้าฟอร์มมันจะแยกกันระหว่าง xray กับ xray2 
	 * แต่พอ insert มันจะเอาไป concat เป็น xray ตัวเดียว
	 */
	$xray_lists = array(
		'NA' => 'ไม่มีการเอกซเรย์', 
		'CXR', 
		'KUB', 
		'เอกซเรย์ ก่อนพบแพทย์', 
		'อัลตราซาวนด์', 
		'ตรวจ IVP'
	);

	$appoint_xray = trim($appoint['xray']);
	if($appoint_xray === 'cxr')
	{
		$appoint_xray = strtoupper($appoint_xray);
	}

	?>
	<font face="Angsana New">
	<select size="1" name="xray">
		<?php 
		foreach ($xray_lists as $key => $xray) {
			$xray_value = $xray;

			if($xray == 'ไม่มีการเอกซเรย์')
			{
				$xray_value = $key;
			}

			$selected = ($xray==$appoint_xray) ? 'selected' : '' ;
			?>
			<option value="<?=$xray_value;?>" <?=$selected;?>><?=$xray;?></option>
			<?php
		}
		?>
	</select>
	</font>
	<font face="Angsana New">
		<input type="hidden" name="xray2" size="30" /> 
		<?php 
		echo "ข้อมูลที่บันทึกเอกซเรย์ครั้งก่อน : ".$appoint['xray'];
		?>
	</font>
	</td>
</tr>
<tr>
	<td><font face="Angsana New">อื่นๆ&nbsp;&nbsp;</font></td>
	<td colspan="2"><font face="Angsana New">
	<input type="text" name="other" size="30" value="<?=$appoint['other'];?>"/></font></td>
</tr>
<tr>
<td>ข้อควรปฏิบัติก่อนพบแพทย์</td>
<td colspan="2"><font face="Angsana New" size = '4'>
	<?php 
	if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){ 
		$advice_list = array( 'NA' => '<โปรดเลือกรายการ>' );
		
	}else{
		$advice_list = array( 
			'NA' => '<โปรดเลือกรายการ>',
			'ไม่มี',
			'ไม่ต้องงดน้ำหรืออาหาร',
			'งดน้ำหวานและอาหารหลังเวลา 20:00 น.(ให้ดื่มน้ำเปล่าได้)',
			'งดน้ำหวานและอาหารหลังเวลา 24:00 น.(ให้ดื่มน้ำเปล่าได้)',
			'งดน้ำและอาหารหลังเวลา 20:00 น.',
			'งดน้ำและอาหารหลังเวลา 24:00 น.',
			'งดน้ำและอาหารหลังเวลา .............. น.',
			'เอกซเรย์ ก่อนพบแพทย์',
			'งดสวมใส่เครื่องประดับทุกชนิด งดทาโลชั่น แป้งบริเวณต้นคอ แขน และขา',
			'เก็บปัสสาวะส่งตรวจก่อนพบแพทย์',
			'งดน้ำ อาหารตั้งแต่เวลา...............วันที่......................',
			'ดื่มน้ำเปล่ามากๆ ก่อนเวลานัดตรวจ ประมาณครึ่งชั่วโมง แล้วกลั้นปัสสาวะไว้จนกว่าจำทำการตรวจเสร็จ',
			'วันที่......................มื้อเย็น รับประทานอาหารอ่อน เช่น ข้าวต้ม โจ๊ก เวลา 20.00 น. ทานยาระบาย 3 เม็ด',
			'หลังเที่ยงคืน งดอาหารและน้ำ จนกว่าจะทำการตรวจเสร็จ',
			'เช้าวันที่......................สวนอุจจาระก่อนมาโรงพยาบาล' 
		);
	}
	?>
	<select name="advice" id="advice">
		<?php 
		foreach ($advice_list as $key => $adItem) {
			$adItem_value = $adItem;
			
			if($adItem==='<โปรดเลือกรายการ>')
			{
				$adItem_value = $key;
			}
			
			$selected = (strpos($adItem, $appoint['advice']) !== false) ? 'selected' : '' ;
			?>
			<option value="<?=$adItem_value;?>" <?=$selected;?>><?=$adItem;?></option>
			<?php
		}
		?>
	</select>

  </font>

</td>
</tr>

<tr>
  <td><font face="Angsana New">แผนกที่นัด</font></td>
  <td><font face="Angsana New">
	<?php 
	$dep_list = array(
		'NA' => '&lt;เลือกแผนกที่นัด&gt;', 
		'U09' => 'U09&nbsp;ห้องตรวจโรค', 
		'U01' => 'U01&nbsp;หอผู้ป่วยชาย', 
		'U02' => 'U02&nbsp;หอผู้ป่วยหญิง', 
		'U08' => 'U08&nbsp;&nbsp;หอผู้ป่วยรวม', 
		'U03' => 'U03&nbsp;หอผู้ป่วยสูตินรี', 
		'U19' => 'U19&nbsp;หอผู้ป่วยพิเศษ3', 
		'U04' => 'U04&nbsp;หอผู้ป่วยหนักICU', 
		'U05' => 'U05&nbsp;ห้องผ่าตัด', 
		'U06' => 'U06&nbsp; วิสัญญี', 
		'U12' => 'U12&nbsp;แผนกไตเทียม', 
		'U10' => 'U10&nbsp;แผนกพยาธิ', 
		'U11' => 'U11&nbsp;แผนกเอกซ์เรย์', 
		'U13' => 'U13&nbsp;กองทันตกรรม', 
		'U16' => 'U16&nbsp;ห้องฉุกเฉิน', 
		'U19' => 'U19&nbsp; กองตรวจโรคผู้ป่วยสู', 
		'U20' => 'U20&nbsp; กายภาพ', 
		'U21' => 'U21&nbsp; นวดแผนไทย', 
		'U22' => 'U22&nbsp; ห้องตรวจจักษุ(ตา)', 
		'U23' => 'U23&nbsp; ห้องตรวจเวชศาสตร์ฯ', 
		'U24' => 'U24&nbsp; คลินิกฝังเข็ม', 
		'U25' => 'U25&nbsp; CT Scan', 
		'U26' => 'U26&nbsp; คลินิกโรคไต', 
		'U27' => 'U27&nbsp; OPD PM&amp;R', 
		'U28' => 'U28&nbsp; ตรวจมวลกระดูก',
		'U29' => 'U29&nbsp;แผนกตรวจสุขภาพ' 
	);

	$appoint_depcode_key = substr($appoint['depcode'], 0, 3);
	?>
	<select size="1" name="depcode" id="depcode">
		<?php 
		foreach ($dep_list as $key => $dep_item) {

			$dep_value = $dep_item;
			if($key === 'NA')
			{
				$dep_value = $key;
			}

			$selected = ( $appoint_depcode_key == $key ) ? 'selected' : '' ;
			if($_SESSION['smenucode']=="ADMPT" && $key == 'U20')
			{
				$selected = 'selected';
			}
			if($_SESSION['sOfficer']=="ศุภรัตน์ มิ่งเชื้อ" && $key == 'U28')
			{
				$selected = 'selected';
			}
			?>
			<option value="<?=$dep_value;?>" <?=$selected;?>><?=$dep_item;?></option>
			<?php
		}
		?>
	</select>

</font></td>
<td>&nbsp;</td>
</tr>

<tr>
	<td><font face="Angsana New">เบอร์โทรศัพท์ผู้ป่วย</font></td>
	<td><font face="Angsana New">
	<input type="text" name="telp" size="20" value="<?=$rowT['phone']?>" />
	</font></td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td colspan="2"><font face="Angsana New">*ถ้าผู้ป่วยเปลี่ยนแปลงหมายเลขโทรศัพท์ให้กรอกหมายเลขโทรศัพท์ใหม่แทนหมายเลขเดิม</font></td>
	<td>&nbsp;</td>
</tr>
<tr>
	<td colspan="2" align="center">
		<input type="submit" value="     ตกลง (A5)    " name="B1" />
		<input name="btnButton1" type="button" value="ตกลง (ใบนัดสติ๊กเกอร์)"  onClick="JavaScript:fncSubmit('page1')">
		<input type="hidden" name="appoint_id" value="<?=$appoint_id;?>">
		<a target=_top  href="../nindex.htm"><< เมนู</a>
	</td>
	<td>&nbsp;</td>
</tr>
</table>
</font>
<br />
</p>

<input type="hidden" name="appd" value="<?php echo $appd; ?>">
</form>
&nbsp&nbsp;<<&nbsp<a target=_self  href='hnappoi1.php'>ออกใบนัดใหม่</a>
</TD>
<TD>
	
<?php
$i=0;
$sql2 = "select * from labcare where lab_list !=0 order by lab_list asc";
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
<?php  include("unconnect.inc");?>