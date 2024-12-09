<?php
session_start();
include("connect.inc");
require_once 'includes/config.php';

$sOfficer="";
$smenucode = "";
$sRowid="";
$sLevel="";
session_register("sOfficer");
session_register("smenucode");
session_register("sRowid");
session_register("sLevel");
//error_reporting (E_ALL ^ E_NOTICE);

function displaydate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="วันที่ $d เดือน $m พ.ศ. $y";
	return $displaydate;
} // end function displaydate

$showdate=displaydate(date("Y-m-d"));
$showtime=date("H:i:s");

$query = "SELECT * FROM inputm WHERE idname = '$sIdname' and pword='$sPword' and status ='Y' ";
$result = mysql_query($query) or die( mysql_error($Conn) );
for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
	if (!mysql_data_seek($result, $i)) {
		echo "Cannot seek to row $i\n";
		continue;
	}

	if(!($row = mysql_fetch_object($result)))
		continue;
}

if(mysql_num_rows($result)){
	$sOfficer=$row->name;
	$menucode=$row->menucode;
	$_SESSION["smenucode"]=$row->menucode;
	$sRowid=$row->row_id;
	$sLevel=$row->level;
	$where_search= "";
	$sPword = $row->pword;
//if($_SESSION["smenucode"] == "ADM"){
///////แบบสอบถาม//////
/*$query3 = "SELECT * FROM tb_assess WHERE row_id = '$sRowid' ";
$result3 = mysql_query($query3) or die("Query failed");
$nrow3 = mysql_num_rows($result3);
if($nrow3==0){
	?>
	<script>
    window.open("assess/question_com.php",null,'height=550,width=850,scrollbars=1');
    </script>
	<?
}*/
////////////////////////////////

if($_SESSION["smenucode"] == "ADMSUR"){
	include("alert_surgery_set.php");
}	
?>
<style type="text/css">
*{
	font-family: "TH SarabunPSK";
}
#userInfo{
	text-align: center;
	font-size: 24px;
	background-color: #148F77;
}

#logout{
	display: inline-block;
	cursor: pointer;
	text-decoration: none;
	border-radius: 4px; 
	padding: 0 6px; 
	background-color: rgb(0 111 89); 
	font-size: 24px; 
	box-shadow: 0 5px #999;
	margin-bottom: 8px;
}
#logout:active {
	/* background-color: #3e8e41; */
	box-shadow: 0 2px #666;
	transform: translateY(2px);
}

#menuAll{
	text-align:center;
	font-size:24px;
	background-color: #148F77;
	color: #ffffff;
}
#showDateTxt{
	font-size:22px;
}
#showDateTxt:hover{
	background-color: #CCFFCC!important;
}
#userInfo:hover, #menuAll:hover{
	background-color: #148F77!important;
}

tr:hover td{
	background-color: #007649;
}

/* Tooltip container */
.tooltip {
  position: relative;
  display: inline-block;
  /*border-bottom: 1px dotted black;*/ /* If you want dots under the hoverable text */
}

/* Tooltip text */
.tooltip .tooltiptext {
  visibility: hidden;
  width: 220px;
  background-color: black;
  color: #fff;
  text-align: center;
  padding: 5px 0;
  border-radius: 6px;
 
  /* Position the tooltip text - see examples below! */
  position: absolute;
  z-index: 1;
}

/* Show the tooltip text when you mouse over the tooltip container */
.tooltip:hover .tooltiptext {
  visibility: visible;
}
.tooltiptext{
	font-size: 16px;
}
</style>
<?php

echo "
<FORM METHOD=POST ACTION=\"\" style=\"margin:0;\">
	<INPUT TYPE=\"text\" NAME=\"search\" size=\"25\" class='txt'>&nbsp;<INPUT TYPE=\"submit\" value=\" ค้นหา \" class='txt'>
</FORM>
";

if(isset($_POST["search"]) && trim($_POST["search"]) <> ""){
	$xxx = explode(" ",$_POST["search"]);
	//$search_where_arr = array();
	//foreach($){
	//	$search_where .= " menu ";
	//}

	$yyy = implode("%' AND menu like '%",$xxx);
	$where_search = " AND (menu like '%".$yyy."%')";
	//echo $yyy;
	//}
}

/*//echo "<script>alert('ทดสอบ') </script>";*/
//print (" <tr>\n".
// "  <td BGCOLOR='#148F77'><font face='THSarabunPSK' size='3' color='#FFFFFF' >   $sOfficer </font></td>\n".
	//	" </tr>\n");
print "<body bgcolor='#008080' text='#00FFFF' link='#FFFFFF' vlink='#FFFFFF' alink='#FFFFFF' onload='Realtime();'>";
print "<table>";

print "<tr>";
print "<th bgcolor=#005555><font face='THSarabunPSK' size='5'>เมนู</th>";
print "</tr>";

if($menucode=='ADM' ){
	$sort = "ORDER BY menu ASC";
}elseif($menucode=='ADMPHA' ){
	$sort = "ORDER BY menu_sort2 ASC ,menu ASC";
}else{
	$sort = "ORDER BY menu_sort ASC ,menu ASC";
}
?>
<tr>
	<td BGCOLOR='#CCFFCC' align='center' style='color: red;' id="showDateTxt"><strong><?=$showdate;?> <div id='divDetail'><?=date('H:i:s');?> น.</div></strong></td>
</tr>
<?php 
if($menucode != 'ADMDR1'){ 

	$notifyTxt = '';
	$notifyIcon = '';
	$classNotify = '';
	$checkDigit = preg_match('/\d+/', $sPword, $digiMatch);
	if(strlen($sPword)<8 OR strlen($digiMatch['0'])===strlen($sPword)){
		$notifyTxt = "!!! คำเตือน !!!<br>รหัสผ่านของท่านไม่ปลอดภัย<br>ไม่ควรใช้รหัสผ่านที่คาดเดาได้ง่าย เช่น<br>- รหัสผ่านที่มีตัวเลขอย่างเดียว<br>- 12345678 หรือ 123456789<br>- วันเดือนปีเกิด หรือเบอร์โทรศัพท์";
		$notifyIcon = '🔔'; // ⚠️
		$classNotify = 'tooltiptext';
	}

	?>
	<tr>
		<td id="userInfo">
			<!-- 🚧 / &#x1F6A7; ( Window + . ใน VS Code เพื่อเรียกใช้งาน Emoji )-->
			<div style="font-size:24px; width: 100%;" class="tooltip">
				<?=$sOfficer;?>&nbsp;<?=($sLevel=="admin" ? '(Admin)' : '' );?>&nbsp;<?=$notifyIcon;?>
				<div class="<?=$classNotify;?>"><?=$notifyTxt;?></div>
			</div>
			<div>
				<a target='_top' href="../sm3.php?user_id=<?=$sRowid;?>" id="logout" ><strong>&gt;&gt; ออกจากระบบ &lt;&lt;</strong></a>
			</div>
			
		</td>
	</tr>
	<?php
}else{
	?>
	<tr>
		<td BGCOLOR='#148F77'><a target='_top' href="../sm3.php?user_id=<?=$sRowid;?>"><font face='THSarabunPSK' size='5'>:: ออกจากระบบ(<?=$sOfficer;?>)</font></a></td>
	</tr>
	<?php
}
?>
<tr>
	<td BGCOLOR='#148F77'><a target='main' href="newpw.php"><font face='THSarabunPSK' size='5'>:: เปลี่ยนรหัสผ่าน</font></a></td>
</tr>
<?php 
if($sOfficer=='อรรณพ ธรรมลักษมี (ว.16633)'){
	?>
	<tr>
		<td BGCOLOR='#148F77'>
			<a target='_blank' href="newpassdrug.php"><font face='THSarabunPSK' size='5'>:: เปลี่ยนรหัส Lock การจ่ายยา</font></a>
		</td>
	</tr>
	<tr>
		<td BGCOLOR='#148F77'>
			<a target='_blank' href="lock_drug_md.php"><font face='THSarabunPSK' size='5'>:: ระบุยาที่ต้องการ Lock/Un Lock</font></a>
		</td>
	</tr>
	<tr>
		<td BGCOLOR='#148F77'>
			<a target='_blank' href="report_cscdformonth.php"><font face='THSarabunPSK' size='5'>:: รายงานส่งเบิกเงินกรมบัญชีกลาง (ผู้ป่วยนอก)</font></a>
		</td>
	</tr>
	<?php
}
?>
<tr>
	<td BGCOLOR='#148F77'><a target='_top' href="com_support.php"><font face='THSarabunPSK' size='5'>:: แจ้งซ่อม/ปรับปรุงโปรแกรม</font></a></td>
</tr>
<tr>
	<td BGCOLOR='#148F77'><a target='_top' href="holiday_add.php"><font face='THSarabunPSK' size='5'>:: ข้อมูลวันหยุดประจำปี (Holiday)</font></a></td>
</tr>
<?php 
if($sLevel=="admin"){
	?>
	<tr>
		<td BGCOLOR='#148F77'><a target='_blank' href="showuser.php?menucode=<?=$menucode;?>"><font face='THSarabunPSK' size='5'>:: จัดการข้อมูลผู้ใช้งาน</font></a></td>
	</tr>
	<?php
}
if($menucode=="ADM"){
	?>
	<tr>
		<td BGCOLOR='#148F77'><a target='_top' href="showcomservice.php"><font face='THSarabunPSK' size='5'>:: บันทึกการปฏิบัติงาน</font></a></td>
	</tr>
	<?php
}
?>
<tr>
	<td BGCOLOR='#148F77'><a target='_top' href="document_list.php"><font face='THSarabunPSK' size='5'>:: Edocument- จัดเก็บเอกสาร</font></a></td>
</tr>
<tr>
	<td BGCOLOR='#148F77'><a target='_top' href="km_index.php?act=view"><font face='THSarabunPSK' size='5'>:: KM- Knowledge base</font></a></td>
</tr>
<?php
if($menucode!=='ADMDR1'){
	?>
	<tr>
		<td BGCOLOR='#148F77'><a target='_blank' href="ha_index.php"><font face='THSarabunPSK' size='5'>KPI Center (แบบบันทึกตัวชี้วัด)</font></a></td>
	</tr>
	<?php
}

?>
<tr style="background-color: #148F77;">
	<td><a href="opd_reprint.php" target="_blank" style="font-family: 'TH SarabunPSK'; font-weight: bold; font-size: 24px;color:black;">:: ใบตรวจโรคผู้ป่วยนอกวันนี้</a></td>
</tr>
<tr style="background-color: #148F77;">
	<td><a href="ophn_eopd.php" target="_blank" style="font-family: 'TH SarabunPSK'; font-weight: bold; font-size: 24px;color:black;">:: ค้นหา e-OPD จาก HN</a></td>
</tr>
<?php
if($menucode=='ADMCT' || $menucode=='ADMFINANCE'){
 $query = "SELECT menu,script,target FROM menulst WHERE menucode LIKE '$menucode%' AND status='Y'  ".$sort;
 $result = mysql_query($query) or die( mysql_error($Conn) );
 	while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
		print (" <tr>\n".
		"  <td BGCOLOR='#005555'><a target='$target' class='menulst-refer01' href=\"$script?\"><font face='THSarabunPSK' size='5'>$menu</font></a></td>\n".
		" </tr>\n");
	};

}elseif($sOfficer=='ภูภูมิ วุฒิธาดา (ว.33906)'){
    $query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADMXR' AND status='Y' ".$where_search." ".$sort;
    $result = mysql_query($query) or die( mysql_error($Conn) );
    
    while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
        "  <td BGCOLOR='#005555'><a target='$target' class='menulst-refer02' href=\"$script?\"><font face='THSarabunPSK' size='5'>$menu</font></a></td>\n".
        " </tr>\n");
    }
}elseif($sOfficer=='วริทธิ์ พสุธาดล (ว.38228)'){
    $query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADMXR' AND status='Y' ".$where_search." ".$sort;
    $result = mysql_query($query) or die( mysql_error($Conn) );
    
    while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
        print (" <tr>\n".
        "  <td BGCOLOR='#005555'><a target='$target' class='menulst-refer03' href=\"$script?\"><font face='THSarabunPSK' size='5'>$menu</font></a></td>\n".
        " </tr>\n");
    }
}elseif($sOfficer=='ธนบดินทร์ ผลศรีนาค (ว.19921)'){
	$query = "SELECT menu,script,target FROM menulst WHERE menucode = 'ADMDR1' OR  menucode = 'ADM19921' AND status='Y' ".$where_search." ".$sort;
	$result = mysql_query($query) or die( mysql_error($Conn) );
	
	while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
	print (" <tr>\n".
		"  <td BGCOLOR='#005555'><a target='$target' class='menulst-refer04' href=\"$script?\"><font face='THSarabunPSK' size='5'>$menu</font></a></td>\n".
		" </tr>\n");
	} 
}else{

$sql2="select * from menu_user WHERE member_code='".$sRowid."'";
$result2= mysql_query($sql2) or die( mysql_error($Conn) );
$rows=mysql_num_rows($result2);
$userRowId = "&sOfficer=".$_SESSION['sOfficer']."&dt_doctor=".$_SESSION['dt_doctor'];
if($rows){///  ถ้ามี rows

	$query = "SELECT menu,link ,sort,target FROM menu_user WHERE member_code='".$sRowid."' and sort !=0 ORDER BY `sort` ASC"; // ถ้าเป็น 0 ไม่แสดง
	$result = mysql_query($query) or die( mysql_error($Conn) );

	while (list ($menu,$link ,$sort,$target) = mysql_fetch_row ($result)) {
		print (" <tr>\n".
		"  <td BGCOLOR='#008484'><a target='$target' class='menulst-refer05' href=\"$link?$userRowId\"><font face='' size='5'>$menu</font></a></td>\n".
		" </tr>\n");
	}

}else{

	$query = "SELECT menu,script,target FROM menulst WHERE menucode like '$menucode%' AND status='Y' ".$where_search." ".$sort;
	$result = mysql_query($query) or die( mysql_error($Conn) );

	while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
		print (" <tr>\n".
		"  <td BGCOLOR='#008484' style='padding: 3px;'><a target='$target' class='menulst-refer06' href=\"$script?$userRowId\"><font face='' size='5'COLOR='#ffffff'>$menu</font></a></td>\n".
		" </tr>\n");
	}

}/// ปิด if rows

}
?>
<tr>
	<td id="menuAll"><b>เมนูสารบัญทั่วไป</b></td>
</tr>
<?php
	//สารบัญทั่วไป ทุกคนดูได้
	$query = "SELECT menu,script,target FROM menulst WHERE status='Y' and menucode = 'ALL' ORDER BY menu_sort ASC ";
	$result = mysql_query($query) or die( mysql_error($Conn) );

	while (list ($menu,$script,$target) = mysql_fetch_row ($result)) {
		print (" <tr>\n".
		"  <td BGCOLOR='#008484'><a target='$target' href=\"$script?\"><font face='THSarabunPSK' size='4' >$menu</font></a></td>\n".
		" </tr>\n");
	};

	$ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
    if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0') !== false && strpos($ua, 'rv:11.0') !== false)) {
        // do stuff for IE
        print(" <tr>\n" .
        "  <td BGCOLOR='#009933'><a target='_blank' href='microsoft-edge:".NOTIFY_HOST."/newauthen/staff.php?sOfficer=".$_SESSION['sOfficer']."'><font face='THSarabunPSK' size='5'>::  Authen Code ::</font></a></td>\n" .
        " </tr>\n");
    }else{
        print(" <tr>\n" .
        "  <td BGCOLOR='#009933'><a target='_blank' href='".NOTIFY_HOST."/newauthen/staff.php?sOfficer=".$_SESSION['sOfficer']."'><font face='THSarabunPSK' size='5'>::  Authen Code ::</font></a></td>\n" .
        " </tr>\n");
    }

	// print (" <tr>\n".
	// "  <td BGCOLOR='#148F77'><a target='_top' class='menulst-refer07' href=\"../sm3.php\"><font face='THSarabunPSK' size='5'>:: Logout- ออกจากระบบ</font></a></td>\n".
	// " </tr>\n");

	print "</table>";
	
	// แจ้งเตือนในครั้งแรกที่ login 
	/*
	if( $menucode == 'ADM' && empty($_SESSION['net_alert']) ){
		$sql_internet = "SELECT COUNT(`idcard`) AS `count_id` 
		FROM `internet` 
		WHERE `idcard` = '' ;";
		$q_net = mysql_query($sql_internet);
		$net = mysql_fetch_assoc($q_net);
		if( $net['count_id'] > 0 && $net['count_id'] < 20 ){
			?>
			<!--<script>alert('จำนวนผู้ใช้ internet ใกล้หมด');</script>-->
			<?php
			$_SESSION['net_alert'] = true;
		}
	}
	*/

	print "</body>";
	include("unconnect.inc");

} else {
	?>
	<body bgcolor='#669999' text='#00FFFF' link='#00FFFF' vlink='#00FFFF' alink='#00FF00' style="padding: 4px;">
	&nbsp;<br><br><br>
	<font size='5' style="font-family: 'TH SarabunPSK';">
		ชื่อผู้ใช้งาน หรือ รหัสผ่านไม่ถูกต้อง<br>คลิก<a href="login.php"><strong>ที่นี่เพื่อเข้าระบบใหม่</strong></a> อีกครั้ง
	</font>
	</body>
	<?php
	session_unregister("sIdname");
	session_unregister("sPword");
	session_unregister("sOfficer");
	session_unregister("sRowid");
	session_unregister("sLevel");
}
?>

<script language="javascript" src="js/jquery-1.8.0.min.js"></script>
<script>
function Realtime(){
   $.ajax({url:"ajaxtime.php",
   	async:false,
	cache:false,
	global:false,
	type:"POST",
	data:"",
	dataType:"html",
	success: function(result){
			// เอามาแปลงเป็นตัวเลขสำหรับ JS
			var prepare_date = Date.parse(result);
			Real(prepare_date);
		}
	});
}

function Real(prepare_date){ 
	setInterval(function(){ 

		// +1 วิไปเรื่อยๆ
		prepare_date += 1000;
		var d = new Date(prepare_date);
		var hour = to2Digit(d.getHours());
		var min = to2Digit(d.getMinutes());
		var sec = to2Digit(d.getSeconds());
		document.getElementById("divDetail").innerHTML = hour+':'+min+':'+sec+' น.';
	}, 1000);
}

function to2Digit(i){ 
	if(i < 10){
		i = "0"+i;
	}
	return i;
}

// สั่งให้เมนูด้านขวามือทำการ refresh เพื่ออัพเดทหน้าจอ
parent.document.getElementById('mainDisplayPage').contentWindow.location.reload();

</script>

<style>
th, td {
  padding:3px;
}
.txt{
	font-family:"TH SarabunPSK";
	font-size:20px;	
}	
</style>