<?php
session_start();

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

	$sql = "Select detail, yprice, nprice From labcare where code = '".$_GET["code"]."' limit 1; ";
	list($detail, $yprice, $nprice) = Mysql_fetch_row(Mysql_Query($sql));

	array_push($_SESSION["list_code"],$_GET["code"]);
	array_push($_SESSION["list_detail"],$detail);
	
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


$officer_name = trim($_SESSION['sOfficer']);
$doctor_name = trim($_POST['doctor']);

// @todo ยังไม่ได้ทำ lock นัดแบบแบ่งเช้า-บ่าย

// ถ้าเป็น POST ที่ส่งมาจาก preappoi1.php ให้เข้าเงื่อนไขในการตรวจสอบ
// ถ้าคนคีย์ไม่ใช่พี่หล้าสูติ หรือ หมอที่นัดไม่ใช่หมอขชล ก็ยังให้เข้าเงื่อนไขตรวจสอบอยู่
if( empty($_GET['action']) 
&& ( $doctor_name != 'MD101 ขชล รวมทรัพย์' OR $officer_name != 'กัลยรัตน์ ตาคำ' ) ){
	
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
	$testmatch = preg_match('/(\d+|MD\d+)/', $_POST['doctor'], $match);
	$code = $match['1'];
	$date_appoint = $_POST['date_appoint'];

	$sql = "SELECT COUNT(`hn`) 
	FROM `appoint` 
	WHERE `appdate` = '$date_appoint' 
	AND `doctor` LIKE '%$code%' 
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
	WHERE `dr_name` LIKE '$code%' 
	AND `date` = '$check_date'";
	$query = mysql_query($sql);
	$item = mysql_fetch_assoc($query);
	$dr_limit = (int) $item['user_row'];
	if( $item !== false && $appoint_rows >= $dr_limit ){
		
		$get_day = (int) $item['date'];
		echo 'วัน'.$th_day[$get_day].'ที่ '.$_POST['date_appoint'].' แพทย์ '.substr($item['dr_name'],5).' ได้จำกัดจำนวนผู้ป่วยนัดไม่ให้เกิน  '.$item['user_row'].' คน หากต้องการนัดเพิ่มกรุณาติดต่อ '.$item['dr_contact'];
		echo '<br>';
		echo '<a href="#" onclick="window.history.back();return false;">คลิกที่นี่</a> เพื่อกลับไปเปลี่ยนวันนัดใหม่';
		exit;
	}
	// จำกัดจำนวนผู้ป่วยนัด
	
	// กรณีนอกเหนือจาก dr_limit_appoint
	$manual_lock = false;
	if( $_POST['doctor'] == 'MD100 เชาวรินทร์ อุ่นเครือ' OR $_POST['doctor'] == 'HD เชาวรินทร์ (ว.37533)' ){
		$dr_name = 'แพทย์ เชาวรินทร์ อุ่นเครือ';
		$manual_lock = array(
			'02 กรกฎาคม 2560' => 0,
			'03 กรกฎาคม 2560' => 0,
			'04 กรกฎาคม 2560' => 0,
			'05 กรกฎาคม 2560' => 0,
			'06 กรกฎาคม 2560' => 0,
			'07 กรกฎาคม 2560' => 0,
			'08 กรกฎาคม 2560' => 0,
			'09 กรกฎาคม 2560' => 0,
			'10 กรกฎาคม 2560' => 0,
			'11 กรกฎาคม 2560' => 0
		);
	}elseif( $_POST['doctor'] == 'HD ณรงค์ (ว.12456)' OR $_POST['doctor'] == 'MD007 ณรงค์ ปรีดาอนันทสุข' ){
		$dr_name = 'แพทย์ ณรงค์ ปรีดาอนันทสุข';
		$manual_lock = array(
			'11 สิงหาคม 2560' => 0
		);
	}elseif( $_POST['doctor'] == 'MD009 นภสมร ธรรมลักษมี' OR $_POST['doctor'] == 'HD นภสมร (ว.19364)' ){
		$dr_name = 'แพทย์ นภสมร ธรรมลักษมี';
		$manual_lock = array(
			'06 มีนาคม 2560' => 0,
			'07 มีนาคม 2560' => 0,
			'08 มีนาคม 2560' => 0,
			'09 มีนาคม 2560' => 0,
			'12 เมษายน 2560' => 0,
			'20 เมษายน 2560' => 0,
			'11 พฤษภาคม 2560' => 0,
			'15 พฤษภาคม 2560' => 0,
			'16 พฤษภาคม 2560' => 0,
			'17 พฤษภาคม 2560' => 0,
			'18 พฤษภาคม 2560' => 0,
			'19 พฤษภาคม 2560' => 0,
			'22 พฤษภาคม 2560' => 0,
			'23 พฤษภาคม 2560' => 0,
			'24 พฤษภาคม 2560' => 0,
			'25 พฤษภาคม 2560' => 0,
			'26 พฤษภาคม 2560' => 0
		);
	}elseif( $_POST['doctor'] == 'MD137 กฤษฎิ์พงษ์ ศิริสารศักดา' ){
		$dr_name = 'แพทย์ กฤษฎิ์พงษ์ ศิริสารศักดา';
		$manual_lock = array(
			'27 กรกฎาคม 2560' => 0
		);
	}

	if( isset($manual_lock[$date_appoint]) === true ){
		
		$limit = (int) $manual_lock[$date_appoint];
		if( $limit <= $appoint_rows ){
			
			if( $limit === 0 ){
				echo $dr_name.' ไม่ออกตรวจวันที่ '.$date_appoint;
			}else{
				echo $dr_name.' ได้จำกัดนัดในวันที่ '.$date_appoint.' ไว้ที่ '.$manual_lock[$date_appoint].'คน';
			}
			echo ' กรุณา<a href="#" onClick="window.history.back(); return false;">เลือกวันตรวจใหม่</a>';
			exit;
		}
	}

	// หมอเชาวไม่รับตรวจทุกวันศุกร์ ไม่มีกำหนดว่าจะยกเลิกเมื่อไร
	if( $doctor_name == 'MD100 เชาวรินทร์ อุ่นเครือ' OR $doctor_name == 'HD เชาวรินทร์ (ว.37533)' ){
		if( $check_date == 5 && $dr_cheaw_test > "2017-04-01" ){
			echo 'แพทย์ เชาวรินทร์ อุ่นเครือ งดนัดผู้ป่วยทุกวันศุกร์ กรุณา<a href="#" onClick="window.history.back(); return false;">เลือกวันตรวจใหม่</a>';
			exit;
		}
	}

	
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
	  $cdoctor=$dt_doctor;
	$cdate_appoint = $_POST['date_appoint'];
	  // session_register("cappdate");
	 // session_register("cappmo");
	 // session_register("cthiyr");
	 session_register("cdoctor");
	session_register("appd");
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
/*	if($datenut<$datenow){
		?>
		<script>
		//alert("เลือกวันที่ไม่ถูกต้อง กรุณาเลือกวันใหม่");
        //window.history.back();
        </script>
		<?
	}
	else{*/
	
		$dd = getdate ( mktime ( 0, 0, 0, $month, $day, $year ));
			if($cdoctor=="MD022 (ไม่ทราบแพทย์)"){
			
			}
			elseif($dd['weekday']=="Saturday"|$dd['weekday']=="Sunday"){
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
			else{
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
				}
				else{
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
		//}
	}
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
		document.getElementById("room").selectedIndex=18;	 <!--ห้องเก็บเงินรายได้-->	
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
	
		str = str+String.fromCharCode(event.keyCode);

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
<form  name="form1" method="POST" action="appinsert1.php" target="_blank" onSubmit="return checktext();">
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
			$sql1 = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
			$result1 = Mysql_Query($sql1);
			$arr = Mysql_fetch_row($result1);
			
			if($arr[0] == "ADMICU" || $arr[0] == "ADMWF" || $arr[0] == "ADMVIP" || $arr[0] == "ADMOBG"){
					$str= "  Selected  ";
					$an_check = true;
			}
		}
?>
      	<option value="<?=$result['appvalue']?>" <?=$str;?>><?=$result['applist']?></option>
        <!--<option value="FU01 ตรวจตามนัด">ตรวจตามนัด</option>
        <option value="FU02 ตามผลตรวจ">ตามผลตรวจ</option>
        <option value="FU03 นอนโรงพยาบาล">นอนโรงพยาบาล</option>
        <option value="FU04 ทันตกรรม">ทันตกรรม</option>
        <option value="FU05 ผ่าตัด">ผ่าตัด</option>
        <option value="FU06 สูติ">สูติ</option>
        <option value="FU07 คลีนิกฝังเข็ม">คลีนิกฝังเข็ม</option>
        <option value="FU08 Echo">Echo</option>
        <option value="FU09 มวลกระดูก">มวลกระดูก</option>
        <option value="FU10 กายภาพ">กายภาพ</option>
        <option value="FU11 ตรวจตามนัดพร้อมประวัติผู้ป่วยใน"


>ตรวจตามนัดพร้อมประวัติผู้ป่วยใน</option>-->
       <!-- <option value="FU12 นวดแผนไทย">นวดแผนไทย</option>
        //ไม่ได้ใช้ <option value="FU13 ส่องกระเพาะ">ส่องกระเพาะ</option>
<option value="FU20 ส่องกระเพาะ(คลินิกพิเศษ)">ส่องกระเพาะ(คลินิกพิเศษ)</option>//ไม่ได้ใช้
        <option value="FU13 ตรวจระบบทางเดินอาหาร">ตรวจระบบทางเดินอาหาร</option>
        <option value="FU14 เจาะเลือดไม่พบแพทย์">เจาะเลือดไม่พบแพทย์</option>
        <option value="FU15 OPD นอกเวลา">OPD นอกเวลาราชการ</option>
        <option value="FU16 คลินิกพิเศษ">คลินิกศัลยกรรมนอกเวลาพิเศษ(ค่าบริการ 100 บาท)</option>
        <option value="FU17 X-ray ไม่พบแพทย์">X-ray ไม่พบแพทย์</option>
        <option value="FU18 ตัดไหมที่ ER ไม่พบแพทย์">ตัดไหมที่ ER ไม่พบแพทย์</option>
        <option value="FU19 อัลตร้าซาวด์"> อัลตร้าซาวด์</option>
        <option value="FU21 คลินิก COPD">คลินิก C OPD</option>
        <option value="FU22 ตรวจตามนัดOPD เวชศาสตร์ฟื่นฟู">ตรวจตามนัดOPD เวชศาสตร์ฟื่นฟู</option>
        <option value="FU23 OPD กายภาพ">OPD กายภาพ</option>
        <option value="FU24 ตรวจตามนัด OPD จักษุ(ตา)">ตรวจตามนัด OPD จักษุ(ตา)</option>
        <option value="FU25 CT Scan">CT Scan</option>
        <option value="FU26 EMG">EMG</option>
        <option value="FU27 X-ray ก่อนพบแพทย์">X-ray ก่อนพบแพทย์</option>
        <option value="FU28 Lab ก่อนพบแพทย์">Lab ก่อนพบแพทย์</option>
        <option value="FU29 X-ray + Lab ก่อนพบแพทย์">X-ray + Lab ก่อนพบแพทย์</option>
        <option value="FU30 คลินิกโรคไต">คลินิกโรคไต</option>-->
        <!-- นัดมาเพื่อ มีถึง FU30 -->
        <?
	  }
		?>
      </select>
    </font></td>
    <td width="280"><font face="Angsana New">

	<?php 
	// ถ้านัดจาก Ward จะแสดงข้อความให้กรอก AN
	if( $an_check === true ){ echo "เลขที่AN/อื่นๆ : "; }
	?>
	<input type="text" id="detail2" name="detail2" size="20">

 <select size="1" name="detail_list" id="detail_list" style="display:none">
<option value="ส่องกระเพาะอาหาร">ส่องกระเพาะอาหาร</option>
<option value="ส่องลำไส้ใหญ่">ส่องลำไส้ใหญ่</option>
<option value="ส่องกระเพาะอาหาร+ส่องลำไส้ใหญ่">ส่องกระเพาะอาหาร+ส่องลำไส้ใหญ่</option>
</select></font></td></tr>

  <tr style="display:none" id="setor">
    <td>&nbsp;</td>
    <td colspan="2">
    <fieldset><legend>ใบเซตผ่าตัด</legend>
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
    </fieldset>    </td>
    </tr>

  <tr>
    <td width="115"><font face="Angsana New" size = '4'><font face="Angsana New">ยื่นใบนัดที่</font></font></td>
    <td colspan="2"><font face="Angsana New" size = '4'><font face="Angsana New">
      <select size="1" name="room" id="room">
        <option selected value="NA">&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3627;&#3657;&#3629;&#3591;&#3605;&#3619;&#3623;&#3592;&gt;</option>
        <option>จุดบริการนัดที่ 1</option>
        <option id="pre-opd">จุดบริการนัดที่ 2</option>
        <option id="opd">แผนกทะเบียน</option>
        <option>ห้องฉุกเฉิน</option>
        <option>กองทันตกรรม</option>
        <option>แผนกพยาธิวิทยา</option>
        <option>แผนกเอกชเรย์</option>
        <option>กองสูติ-นารี</option>
        <option>กายภาพ</option>
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
<tr>
  <td colspan="3"><font face="Angsana New"><A HREF="javascript:show_bock();">เจาะเลือด</A>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; เจาะเลือดเพิ่มเติม <font face="Angsana New">
    <input type="text" name="labm" size="30" />
  </font></td>
  </tr>
 
<tr>
  <td colspan="3"><div id="list_patho"></div></td>
</tr>
<tr>
  <td><font face="Angsana New">เอกซเรย์&nbsp;</font></td>
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
      <input type="text" name="xray2" size="30" />
    </font></td>
  </tr>
<tr>
  <td><font face="Angsana New">อื่นๆ&nbsp;&nbsp;</font></td>
  <td colspan="2"><font face="Angsana New">
    <input type="text" name="other" size="30" /></font></td>
  </tr>
 <tr>
  <td>ข้อควรปฏิบัติก่อนพบแพทย์</td>
  <td colspan="2"><font face="Angsana New" size = '4'>
  <? if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){ ?>
     <select size="1" name="advice" id="advice">
      <option value="ไม่มี" selected="selected">ไม่มี</option
      ></select> 
  <? }else{ ?>
    <select size="1" name="advice" id="advice">
      <option selected value="NA">&lt;&#3650;&#3611;&#3619;&#3604;&#3648;&#3621;&#3639;&#3629;&#3585;&#3619;&#3634;&#3618;&#3585;&#3634;&#3619;&gt;</option>
      <option value="ไม่มี">ไม่มี</option>
      <option>ไม่ต้องงดน้ำหรืออาหาร</option>
      <option>งดน้ำหวานและอาหารหลังเวลา 20:00 น.(ให้ดื่มน้ำเปล่าได้)</option>
      <option>งดน้ำหวานและอาหารหลังเวลา 24:00 น.(ให้ดื่มน้ำเปล่าได้)</option>
      <option>งดน้ำและอาหารหลังเวลา 20:00 น.</option>
      <option>งดน้ำและอาหารหลังเวลา 24:00 น.</option>
      <option>งดน้ำและอาหารหลังเวลา .............. น.</option>
      <option>เอกซเรย์ ก่อนพบแพทย์</option>
      <option>งดสวมใส่เครื่องประดับทุกชนิด งดทาโลชั่น แป้งบริเวณต้นคอ แขน และขา</option>
	  <option value="เก็บปัสสาวะส่งตรวจก่อนพบแพทย์">เก็บปัสสาวะส่งตรวจก่อนพบแพทย์</option>
      <option value="งดน้ำ อาหารตั้งแต่เวลา...............วันที่......................">งดน้ำ อาหารตั้งแต่เวลา...............วันที่......................</option>
      <option value="ดื่มน้ำเปล่ามากๆ ก่อนเวลานัดตรวจ ประมาณครึ่งชั่วโมง แล้วกลั้นปัสสาวะไว้จนกว่าจำทำการตรวจเสร็จ">ดื่มน้ำเปล่ามากๆ ก่อนเวลานัดตรวจ ประมาณครึ่งชั่วโมง แล้วกลั้นปัสสาวะไว้จนกว่าจำทำการตรวจเสร็จ</option>
      <option value="วันที่......................มื้อเย็น รับประทานอาหารอ่อน เช่น ข้าวต้ม โจ๊ก เวลา 20.00 น. ทานยาระบาย 3 เม็ด">วันที่......................มื้อเย็น รับประทานอาหารอ่อน เช่น ข้าวต้ม โจ๊ก เวลา 20.00 น. ทานยาระบาย 3 เม็ด</option>
      <option value="หลังเที่ยงคืน งดอาหารและน้ำ จนกว่าจะทำการตรวจเสร็จ">หลังเที่ยงคืน งดอาหารและน้ำ จนกว่าจะทำการตรวจเสร็จ</option>      
      <option value="เช้าวันที่......................สวนอุจจาระก่อนมาโรงพยาบาล">เช้าวันที่......................สวนอุจจาระก่อนมาโรงพยาบาล</option>      
      </select>
      <? } ?>
  </font></td>
  </tr>

<tr>
  <td><font face="Angsana New">แผนกที่นัด</font></td>
  <td><font face="Angsana New">
    <select size="1" name="depcode" id="depcode">
    <? if($_SESSION["sOfficer"]!="ศุภรัตน์ มิ่งเชื้อ"){?>
      <option selected value="NA">&lt;&#3648;&#3621;&#3639;&#3629;&#3585;&#3649;&#3612;&#3609;&#3585;&#3607;&#3637;&#3656;&#3609;&#3633;&#3604;&gt;</option>
      <? } ?>
      <option>U09&nbsp;
        ห้องตรวจโรค</option>
      <option>U01&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3594;&#3634;&#3618;</option>
      <option>U02&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3597;&#3636;&#3591;</option>
	  <option>U08&nbsp;&nbsp;หอผู้ป่วยรวม</option>
	  <option>U03&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3626;&#3641;&#3605;&#3636;&#3609;&#3619;&#3637;</option>
      <option>U19&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3614;&#3636;&#3648;&#3624;&#3625;3</option>
      <option>U04&nbsp;
        &#3627;&#3629;&#3612;&#3641;&#3657;&#3611;&#3656;&#3623;&#3618;&#3627;&#3609;&#3633;&#3585;ICU</option>
      <option>U05&nbsp;
        &#3627;&#3657;&#3629;&#3591;&#3612;&#3656;&#3634;&#3605;&#3633;&#3604;</option>
      <option>U06&nbsp; &#3623;&#3636;&#3626;&#3633;&#3597;&#3597;&#3637;</option>
      <option>U12&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3652;&#3605;&#3648;&#3607;&#3637;&#3618;&#3617;</option>
      <option>U10&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3614;&#3618;&#3634;&#3608;&#3636;</option>
      <option>U11&nbsp;
        &#3649;&#3612;&#3609;&#3585;&#3648;&#3629;&#3585;&#3595;&#3660;&#3648;&#3619;&#3618;&#3660;</option>
      <option>U13&nbsp;
        &#3585;&#3629;&#3591;&#3607;&#3633;&#3609;&#3605;&#3585;&#3619;&#3619;&#3617;</option>
      <option>U16&nbsp;
        &#3627;&#3657;&#3629;&#3591;&#3593;&#3640;&#3585;&#3648;&#3593;&#3636;&#3609;</option>
      <option>U19&nbsp; กองตรวจโรคผู้ป่วยสูติ</option>
      <option>U20&nbsp; กายภาพ</option>
      <option>U21&nbsp; นวดแผนไทย</option>
      <option>U22&nbsp; ห้องตรวจจักษุ(ตา)</option>
      <option>U23&nbsp; ห้องตรวจเวชศาสตร์ฯ</option>
      <option>U24&nbsp; คลินิกฝังเข็ม</option>
      <option>U25&nbsp; CT Scan</option>
       <option>U26&nbsp; คลินิกโรคไต</option>
       <option>U27&nbsp; OPD PM&R</option>
	<? if($_SESSION["sOfficer"]=="ศุภรัตน์ มิ่งเชื้อ"){?>
       <option selected="selected">U28&nbsp; ตรวจมวลกระดูก</option>
     <? } ?>
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
  <td colspan="2" align="center"><input type="submit" value="     ตกลง (A5)    " name="B1" /> <input name="btnButton1" type="button" value="ตกลง (ใบนัดสติ๊กเกอร์)"  onClick="JavaScript:fncSubmit('page1')">
    <a target=_top  href="../nindex.htm"><< เมนู</a></td>
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
/*$i=0;
	$list_lab_check[$i]["code"] = "BS";
	$list_lab_check[$i]["detail"] = "BS";
	
$i++;
	$list_lab_check[$i]["code"] = "HBA1C";
	$list_lab_check[$i]["detail"] = "HbA1C";
	
$i++;
	$list_lab_check[$i]["code"] = "LIPID";
	$list_lab_check[$i]["detail"] = "Lipid";

$i++;
	$list_lab_check[$i]["code"] = "CHOL";
	$list_lab_check[$i]["detail"] = "CHOL";

$i++;
	$list_lab_check[$i]["code"] = "TRI";
	$list_lab_check[$i]["detail"] = "TG";
	
$i++;
	$list_lab_check[$i]["code"] = "HDL";
	$list_lab_check[$i]["detail"] = "HDL";
	
$i++;
	$list_lab_check[$i]["code"] = "LDL";
	$list_lab_check[$i]["detail"] = "LDL";
	
$i++;
	$list_lab_check[$i]["code"] = "URIC";
	$list_lab_check[$i]["detail"] = "URIC";
	
$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN";
	
$i++;
	$list_lab_check[$i]["code"] = "CR";
	$list_lab_check[$i]["detail"] = "CR";

$i++;
	$list_lab_check[$i]["code"] = "E";
	$list_lab_check[$i]["detail"] = "E'Lyte";
	
$i++;
	$list_lab_check[$i]["code"] = "LFT";
	$list_lab_check[$i]["detail"] = "LFT";
	
$i++;
	$list_lab_check[$i]["code"] = "SGOT";
	$list_lab_check[$i]["detail"] = "AST";
	
$i++;
	$list_lab_check[$i]["code"] = "SGPT";
	$list_lab_check[$i]["detail"] = "ALT";
	
$i++;
	$list_lab_check[$i]["code"] = "ALK";
	$list_lab_check[$i]["detail"] = "AP";
	
$i++;
	$list_lab_check[$i]["code"] = "ALB";
	$list_lab_check[$i]["detail"] = "Alb";
	
$i++;	
	$list_lab_check[$i]["code"] = "CBC";
	$list_lab_check[$i]["detail"] = "CBC";
	
$i++;
	$list_lab_check[$i]["code"] = "UA";
	$list_lab_check[$i]["detail"] = "UA";
	
$i++;
	$list_lab_check[$i]["code"] = "HCT";
	$list_lab_check[$i]["detail"] = "HCT";
	
$i++;
	$list_lab_check[$i]["code"] = "BG";
	$list_lab_check[$i]["detail"] = "BG";

$i++;
	$list_lab_check[$i]["code"] = "FT3";
	$list_lab_check[$i]["detail"] = "FT3";
	
$i++;
	$list_lab_check[$i]["code"] = "FT4";
	$list_lab_check[$i]["detail"] = "FT4";
	
$i++;
	$list_lab_check[$i]["code"] = "TSH";
	$list_lab_check[$i]["detail"] = "TSH";
	
$i++;
	$list_lab_check[$i]["code"] = "TROP-T";
	$list_lab_check[$i]["detail"] = "TROP-T";
	
$i++;
	$list_lab_check[$i]["code"] = "HIV";
	$list_lab_check[$i]["detail"] = "AntiHIV";
	
$i++;
	$list_lab_check[$i]["code"] = "CD4";
	$list_lab_check[$i]["detail"] = "CD4";

$i++;
	$list_lab_check[$i]["code"] = "10530";
	$list_lab_check[$i]["detail"] = "HIV VL";
	
$i++;
	$list_lab_check[$i]["code"] = "VDRL";
	$list_lab_check[$i]["detail"] = "VDRL";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAG";
	$list_lab_check[$i]["detail"] = "HBsAg";
	
$i++;
	$list_lab_check[$i]["code"] = "HBSAB";
	$list_lab_check[$i]["detail"] = "HBsAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HBCAB";
	$list_lab_check[$i]["detail"] = "HBcAb";
	
$i++;
	$list_lab_check[$i]["code"] = "HCV";
	$list_lab_check[$i]["detail"] = "HCV";
	
$i++;
	$list_lab_check[$i]["code"] = "10508";
	$list_lab_check[$i]["detail"] = "HBeAg";
	
$i++;
	$list_lab_check[$i]["code"] = "10509";
	$list_lab_check[$i]["detail"] = "HBeAg titer";

$i++;
	$list_lab_check[$i]["code"] = "10517";
	$list_lab_check[$i]["detail"] = "HBV VL";

$i++;
	$list_lab_check[$i]["code"] = "10522";
	$list_lab_check[$i]["detail"] = "HCV VL";

$i++;
	$list_lab_check[$i]["code"] = "10523";
	$list_lab_check[$i]["detail"] = "HCV genotype";

$i++;
	$list_lab_check[$i]["code"] = "HBTY";
	$list_lab_check[$i]["detail"] = "Hb typing";
		
$i++;
	$list_lab_check[$i]["code"] = "ESR";
	$list_lab_check[$i]["detail"] = "ESR";	

$i++;
	$list_lab_check[$i]["code"] = "CRP";
	$list_lab_check[$i]["detail"] = "CRP";

$i++;
	$list_lab_check[$i]["code"] = "RF";
	$list_lab_check[$i]["detail"] = "RF";
	
$i++;
	$list_lab_check[$i]["code"] = "PSA";
	$list_lab_check[$i]["detail"] = "PSA";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANA";

$i++;
	$list_lab_check[$i]["code"] = "AFP";
	$list_lab_check[$i]["detail"] = "AFP";
	
$i++;
	$list_lab_check[$i]["code"] = "CPK";
	$list_lab_check[$i]["detail"] = "CPK";
	
$i++;
	$list_lab_check[$i]["code"] = "10212";
	$list_lab_check[$i]["detail"] = "Stool exam";

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Stool C/S";

$i++;
	$list_lab_check[$i]["code"] = "STOCB";
	$list_lab_check[$i]["detail"] = "Stool occult blood";

$i++;
	$list_lab_check[$i]["code"] = "AFB";
	$list_lab_check[$i]["detail"] = "AFB";

$i++;
	$list_lab_check[$i]["code"] = "C-S";
	$list_lab_check[$i]["detail"] = "Sputum C/S";

$i++;
	$list_lab_check[$i]["code"] = "PT";
	$list_lab_check[$i]["detail"] = "PT,INR";
	
$i++;
	$list_lab_check[$i]["code"] = "BLTI";
	$list_lab_check[$i]["detail"] = "Bleeding time";

$i++;
	$list_lab_check[$i]["code"] = "FER";
	$list_lab_check[$i]["detail"] = "SF";
	
$i++;
	$list_lab_check[$i]["code"] = "PTT";
	$list_lab_check[$i]["detail"] = "PTT,Ratio";
	
$i++;
	$list_lab_check[$i]["code"] = "DCIP";
	$list_lab_check[$i]["detail"] = "DCIP";

$i++;
	$list_lab_check[$i]["code"] = "co2";
	$list_lab_check[$i]["detail"] = "CO2";

$i++;
	$list_lab_check[$i]["code"] = "Na";
	$list_lab_check[$i]["detail"] = "Na";

$i++;
	$list_lab_check[$i]["code"] = "k";
	$list_lab_check[$i]["detail"] = "K";

$i++;
	$list_lab_check[$i]["code"] = "Cl";
	$list_lab_check[$i]["detail"] = "Cl";
	
$i++;
	$list_lab_check[$i]["code"] = "PAP";
	$list_lab_check[$i]["detail"] = "PAP";

$i++;
	$list_lab_check[$i]["code"] = "CAL";
	$list_lab_check[$i]["detail"] = "Ca";

$i++;
	$list_lab_check[$i]["code"] = "PH";
	$list_lab_check[$i]["detail"] = "P";

$i++;
	$list_lab_check[$i]["code"] = "MAG";
	$list_lab_check[$i]["detail"] = "Mg";

$i++;
	$list_lab_check[$i]["code"] = "BUN";
	$list_lab_check[$i]["detail"] = "BUN2";

$i++;
	$list_lab_check[$i]["code"] = "BUNHD";
	$list_lab_check[$i]["detail"] = "BUN3";

$i++;
	$list_lab_check[$i]["code"] = "10362";
	$list_lab_check[$i]["detail"] = "Copper";

$i++;
	$list_lab_check[$i]["code"] = "10360";
	$list_lab_check[$i]["detail"] = "Cadmium";
	
$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "Iron";
	
$i++;
	$list_lab_check[$i]["code"] = "10245";
	$list_lab_check[$i]["detail"] = "Zinc";

$i++;
	$list_lab_check[$i]["code"] = "UPT";
	$list_lab_check[$i]["detail"] = "UPT";
	
$i++;
	$list_lab_check[$i]["code"] = "SI";
	$list_lab_check[$i]["detail"] = "SI";

$i++;
	$list_lab_check[$i]["code"] = "TIBC";
	$list_lab_check[$i]["detail"] = "TIBC";

$i++;
	$list_lab_check[$i]["code"] = "10979";
	$list_lab_check[$i]["detail"] = "IPTH";

$i++;
	$list_lab_check[$i]["code"] = "ANA";
	$list_lab_check[$i]["detail"] = "ANCA";

$i++;
	$list_lab_check[$i]["code"] = "10617";
	$list_lab_check[$i]["detail"] = "C3";
	


$i++;
	$list_lab_check[$i]["code"] = "U-CR";
	$list_lab_check[$i]["detail"] = "Urine Cr";

$i++;
	$list_lab_check[$i]["code"] = "10623";
	$list_lab_check[$i]["detail"] = "C4";

$i++;
	$list_lab_check[$i]["code"] = "ASO";
	$list_lab_check[$i]["detail"] = "ASOtiter";

$i++;
	$list_lab_check[$i]["code"] = "U-PROT";
	$list_lab_check[$i]["detail"] = "Urine Protein";

$i++;
	$list_lab_check[$i]["code"] = "";
	$list_lab_check[$i]["detail"] = "";
	
$i++;
	$list_lab_check[$i]["code"] = "U-PROT24V";
	$list_lab_check[$i]["detail"] = "24 hr. Urine Vol";

$i++;
	$list_lab_check[$i]["code"] = "U-PROT24";
	$list_lab_check[$i]["detail"] = "24 hr. Urine Protien";
	
$i++;
	$list_lab_check[$i]["code"] = "10421";
	$list_lab_check[$i]["detail"] = "Urine Microalbumin";
	*/
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