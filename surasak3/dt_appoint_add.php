<?
session_start();
include("connect.inc");

$Thidate = (date("Y")+543).date("-m-d H:i:s"); 

$cPtname = $_SESSION["yot_now"]." ".$_SESSION["name_now"]." ".$_SESSION["surname_now"];
$cAge = $_SESSION["age_now"];

//$appoint_doctor ="MD049  ศรายุทธ กาญจนธารายนต์"; Break;
//$appoint_doctor ="MD050  กฤษดากร ไวทยโยธิน"; Break;
//$appoint_doctor ="MD060  ปิยะบุตร บุญม"; Break;

$sql = "Select mdcode From inputm where name = '".$_SESSION["dt_doctor"]."' limit 1";
list($mdcode) = Mysql_fetch_row(Mysql_Query($sql));

$sql = "Select name From doctor where name like '".$mdcode."%' limit 1 ";
list($appoint_doctor) = Mysql_fetch_row(Mysql_Query($sql));

/*
switch($_SESSION["dt_doctor"]){
	case 'ปิยะบุตร บุญมี (ว.29265)': $appoint_doctor ="MD060  ปิยะบุตร บุญม"; Break;
	case 'สมัชชา เบี้ยจรัส (ว.20182)': $appoint_doctor ="MD014 สมัชชา เบี้ยจรัส"; Break;
	case 'พิพิธ บุรัสการ (ว.38220)': $appoint_doctor ="MD056  พิพิธ  บุรัสการ"; Break;
	case 'สุรภัทร ศรีนนท์ (ว.29290)': $appoint_doctor ="MD048  สุรภัทร ศรีนนท์"; Break;
	case 'วันชาติ นำประเสริฐชัย (ว.24535)': $appoint_doctor ="MD047  วันชาติ นำประเสริฐชัย"; Break;
	case 'นิธิไชย บุญไชย (ว.28437)': $appoint_doctor ="MD053  นิธิไชย  บุญไชย"; Break;
	case 'ปฎิพงค์ ศรีทิภัณฑ์ (ว.10212)': $appoint_doctor ="MD037 ปฏิพงค์  ศรีทิภัณฑ์"; break;
	case 'ไพบูลย์ คูหเพ็ญแสง (ว.38222)': $appoint_doctor ="MD057  ไพบูลย์  คูหเพ็ญแสง"; Break;
	case 'อัศวิน แก้วเนตร (ว.21329)': $appoint_doctor ="MD016 อัศวิน แก้วเนตร"; Break;
	case 'ศุภสิทธิ์ คงมีผล (ว.20278)': $appoint_doctor ="MD036 ศุภสิทธิ์  คงมีผล"; Break;
	case 'ธนบดินทร์ ผลศรีนาค (ว.19921)': $appoint_doctor ="MD013 ธนบดินทร์ ผลศรีนาค"; Break;
	case 'อนุพงษ์ รอดสาย (ว.20186)': $appoint_doctor ="MD011 อนุพงษ์ รอดสาย"; Break;
	case 'นภสมร ธรรมลักษมี (ว.19364)': $appoint_doctor ="MD009 นภสมร ธรรมลักษมี"; Break;
	case 'ทองแดง อาฒยะพันธ์ (ว.24512)': $appoint_doctor ="MD051  ทองแดง  อาฒยะพันธ์"; Break;
	case 'วุฒิไชย อิศระ (ว.14286)': $appoint_doctor ="MD052  วุฒิไชย  อิศระ"; Break;
	case 'วรวิทย์ วงษ์มณี (ว.27035)': $appoint_doctor ="MD041  วรวิทย์ วงษ์มณี"; Break;
	case 'เลือก  ด่านสว่าง  (ว.12891)': $appoint_doctor ="MD006 เลือก ด่านสว่าง"; Break;
	case 'ณรงค์ ปรีดาอนันทสุข (ว.12456)': $appoint_doctor ="MD007 ณรงค์ ปรีดาอนันทสุข"; Break;
	case 'อรรณพ ธรรมลักษมี (ว.16633)': $appoint_doctor ="MD008 อรรณพ ธรรมลักษมี"; Break;
	case 'ชัยเนตรอาร์ เนตรพิชิต (ว.28422)': $appoint_doctor ="MD059  ชัยเนตรอาร์ เนตรพิชิต"; Break;
	case 'การุณย์ สุริยวงศ์พงศา (ว.13553)': $appoint_doctor ="MD054  การุณย์  สุริยวงศ์พงศา"; Break;
	case 'กฤษฎิ์พงษ์ ศิริสารศักดา': $appoint_doctor ="MD061 กฤษฎิ์พงษ์ ศิริสารศักดา"; Break;
	case 'กฤษฎิ์พงษ์ ศิริสารศักดา(ว.40802)': $appoint_doctor ="MD061 กฤษฎิ์พงษ์ ศิริสารศักดา"; Break;
	case 'กัณฐรัตน์ จันรุ่งเรือง': $appoint_doctor ="MD062 กัณฐรัตน์ จันรุ่งเรือง"; Break;
	case 'ณัฐพล แหยมแก้ว': $appoint_doctor ="MD063 ณัฐพล แหยมแก้ว"; Break;
	case 'กฤษดากร ไวทยโยธิน (ว.37525)': $appoint_doctor ="MD050  กฤษดากร ไวทยโยธิน"; Break;
	case 'วีระยุทธ์ วงศ์จันทร์ (ท.1850)': $appoint_doctor ="MD043  วีระยุทธ์ วงศ์จันทร์"; Break;
	case 'เกื้อกูล ผสมทรัพย์ (ท.5749)': $appoint_doctor ="MD030 เกื้อกูล ผสมทรัพย์"; Break;
	case 'หนึ่งฤทัย มหายศนันท์ (ท.3448)': $appoint_doctor ="MD020 หนึ่งฤทัย มหายศนันท์"; Break;
	case 'กัณฐรัตน์ จันรุ่งเรือง (ว.40803)': $appoint_doctor ="MD062 กัณฐรัตน์ จันรุ่งเรือง"; Break;

}*/

$xxx = explode(" ",$_POST["date_appoint"]);

switch($xxx[1]){
	
	case "มกราคม":  $month = "01"; break;
	case "กุมภาพันธ์":  $month = "02"; break;
	case "มีนาคม":  $month = "03"; break;
	case "เมษายน":  $month = "04"; break;
	case "พฤษภาคม":  $month = "05"; break;
	case "มิถุนายน":  $month = "06"; break;
	case "กรกฎาคม":  $month = "07"; break;
	case "สิงหาคม": $month = "08";  break;
	case "กันยายน":  $month = "09"; break;
	case "ตุลาคม":  $month = "10"; break;
	case "พฤศจิกายน":  $month = "11"; break;
	case "ธันวาคม":  $month = "12"; break;

}

	

if(count($_POST["list_lab_appoint"]) > 0)
$lab_appoint_implode = @implode(", ",$_POST["list_lab_appoint"]);

$other2 = "";


if($_POST["other"] != ""){
	$other2 .= $_POST["other"];
}

if($_POST["operate"] != ""){
	if(strlen($other2) > 0)
		$comma = ", ";
	$other2 .= $comma." ผ่าตัด : ".$_POST["operate"];
}

if($_POST["inj"] != ""){
	if(strlen($other2) > 0)
		$comma = ", ";
	$other2 .= $comma." วัคซีน : ".$_POST["inj"];
}

$sql = "INSERT INTO appoint(date,officer,hn,ptname,age,doctor,appdate,apptime,room,detail,detail2,advice,patho,xray,other,depcode)VALUES('".$Thidate."','".$_SESSION["dt_doctor"]."','".$_SESSION["hn_now"]."','".$cPtname."','".$cAge."','".$appoint_doctor."','".$_POST["date_appoint"]."','".$_POST["capptime"]."','".$_POST["room"]."','".$_POST["detail"]."','".$_POST["detail2"]."','".$_POST["advice"]."','".$lab_appoint_implode."','".$_POST["xray"]."','".$other2."','".$_POST["depcode"]."');";

Mysql_Query($sql);

$row_id = @mysql_insert_id();
$i=false;
if(count($_POST["list_lab_appoint"]) > 0)
foreach($_POST["list_lab_appoint"] as $key => $value){
	$sql = "INSERT INTO `appoint_lab` ( `id` , `code` ) VALUES ('".$row_id."', '".$value."'); ";
	Mysql_Query($sql);
	$i = true;
}

$sql = "Select count(distinct hn) as c_app From appoint where appdate = '".$_POST["date_appoint"]."' AND doctor in ('".$_SESSION["dt_doctor"]."','".$appoint_doctor."') AND apptime <> 'ยกเลิกการนัด'  ";

$result = Mysql_Query($sql) or die(mysql_error());
list($c_app) = Mysql_fetch_row($result);

if(date("m") > $month){
	$month +=12; 
	$length_m = $month - date("m");
	$length_m = "(".$length_m."M)";

}else if(date("m") < $month){
	$length_m = $month - date("m");
	$length_m = "(".$length_m."M)";
}

setcookie($xxx[0].$month.$xxx[2], "<A HREF=\"javascript:void(0);\" Onclick=\"document.getElementById('date_appoint').value='".$_POST["date_appoint"]."';\" >".$_POST["date_appoint"]."</A>(".$c_app." คน)&nbsp;".$length_m."&nbsp;<A HREF=\"javascript:void(0);\" Onclick=\"deletecookie('".$xxx[0].$month.$xxx[2]."')\">[X]</A>", time()+(3600*6));

$down_list = "";

		if($_POST["xray"] != ""){
			$down_list .= "X-ray : ".$_POST["xray"];
		}

		if($other2 != ""){
			$down_list .= "&nbsp;&nbsp;&nbsp;&nbsp;อื่นๆ : ".$other2."";
		}

if($_SESSION["dt_drugstk"] != ""){
		$_SESSION["dt_drugstk"].= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"350\" font style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
		<TR>
			<TD>วันที่ ".$_POST["date_appoint"]."<font face='Angsana New' size= 2 >&nbsp;เวลา : ".$_POST["capptime"]."</TD>
		</TR>

		<TR>
			<TD><font face='Angsana New' size= 2 >นัดมาเพื่อ : ".substr($_POST["detail"],5)."</TD>
		</TR>
		";
		
		if(count($_POST["list_lab_appoint"]) > 0)
			$_SESSION["dt_drugstk"].= "
		<TR>
			<TD><font face='Angsana New' size= 1 >นัดตรวจทางพยาธิ : ".$lab_appoint_implode."</TD>
		</TR>";
		
		

		if(trim($down_list) !="")
		$_SESSION["dt_drugstk"] .="
		<TR>
				<TD><font face='Angsana New' size= 1 >".$down_list."</TD>
		</TR>";


		$_SESSION["dt_drugstk"].= "</TABLE>";
		$_SESSION["dt_drugstk"].= "<DIV style=\"page-break-after:always\"></DIV>";
}

if(substr($_POST["detail"],0 ,1) == "F"){
	$_POST["detail"] = substr($_POST["detail"],5);
}

$xxx = explode("(ว",$_SESSION["dt_doctor"]);
$doctor = $xxx[0];

$_SESSION["dt_drugstk"] .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"290\" font style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 ><B>ใบนัดผู้ป่วย รพ.ค่ายสุรศักดิ์มนตรี ลำปาง</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2>ชื่อ : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>นัดวันที่ : ".$_POST["date_appoint"]."<font face='Angsana New' size= 2 >&nbsp;เวลา : ".$_POST["capptime"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 ><B>เพื่อ :</B> ".$_POST["detail"]." ".(trim($_POST["detail2"]) !=''?"(".$_POST["detail2"].")":"")." <font face='Angsana New' size= 2 >&nbsp;<B>แพทย์ :</B> ".$doctor."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><U><B>ยื่นใบนัดที่ :</B> ".$_POST["room"]."</U></TD>
			</TR>";

if($i){

$_SESSION["dt_drugstk"] .="<TR  style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >LAB : ".$lab_appoint_implode."</TD>
			</TR>";
}

if(trim($_POST["xray"]) !=""){
$_SESSION["dt_drugstk"] .="<TR  style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >".$down_list."</TD>
			</TR>";

}

$_SESSION["dt_drugstk"] .="<TR style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >วันเวลาออกใบนัด : ".date("d/m/Y H:i:s")."</TD>
			</TR>";
			
if($_POST['room']=="กองสูติ-นารี"){
$_SESSION["dt_drugstk"] .= "<TR style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 > มีข้อสงสัยในการนัดติดต่อจุดบริการนัด โทร 054-839305 ต่อ 5111</TD>
			</TR>
			</TABLE>
			";
}else{
$_SESSION["dt_drugstk"] .= "<TR style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 > มีข้อสงสัยในการนัดติดต่อจุดบริการนัด โทร 054-839305 ต่อ 1125</TD>
			</TR>
			</TABLE>
			";
}

if($i){
$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>";
$_SESSION["dt_drugstk"] .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"290\"  style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 >ใบนัดตรวจทางพยาธิ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ชื่อผู้ป่วย : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>นัดวันที่ : ".$_POST["date_appoint"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >แพทย์ : ".$doctor."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ข้อควรปฏิบัติ : <U>".$_POST["advice"]."</U></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >รายการ : <B>".$lab_appoint_implode."</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 1 >".$other2."</TD>
			</TR>
			</TABLE>
			";
}

if(trim($_POST["xray"]) !=""){
$_SESSION["dt_drugstk"] .= "<DIV style=\"page-break-after:always\"></DIV>";
$_SESSION["dt_drugstk"] .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"290\"  style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 >ใบนัด X-Ray&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ชื่อผู้ป่วย : ".$cPtname." &nbsp;&nbsp; HN : ".$_SESSION["hn_now"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>นัดวันที่ : ".$_POST["date_appoint"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >แพทย์ : ".$doctor."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >X-Ray : <B>".$_POST["xray"]."</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 1 >".$other2."</TD>
			</TR>
			</TABLE>
			";
}

header('Location: dt_printstker.php');
exit;

echo "
	<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			//print();
			setTimeout(\"window.location.href='dt_printstker.php';\",0000);
		}
		
		</SCRIPT>
				<style type=\"text/css\">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
-->
</style>
	</head>
	<body leftmargin=\"0\" topmargin=\"0\">";

//include("dt_menu.php");
//echo "<BR><BR>
//	<CENTER>บันทึกข้อมูลเรียบร้อยแล้ว<BR><A HREF=\"dt_printstker.php\">Print Stker</A></CENTER>
echo"	</body>
	</html>
				
	";

include("unconnect.inc");
?>
