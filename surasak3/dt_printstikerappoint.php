<?php

global $detail, $user_code;

include("connect.inc");
$Thidate = date("d-m-").(date("Y")+543).date(" H:i:s"); 

$sql = "Select * From appoint  where hn='".$_GET["hn"]."' AND `date` like '".(date("Y")+543).date("-m-d")."%' AND apptime <> 'ยกเลิกการนัด'  Order by row_id DESC limit 1 ";

$result = Mysql_Query($sql);
$arr = Mysql_fetch_assoc($result);

$xxx = explode("(ว",$arr["doctor"]);
$arr["doctor"] = $xxx[0];

$sql2 = "Select * From appoint_lab where id = '".$arr["row_id"]."' and id != 0 ";
$result2 = Mysql_Query($sql2);
$i=false;
$list_lab_appoint = array();
while($arr2 = Mysql_fetch_assoc($result2)){
	array_push($list_lab_appoint,$arr2["code"]);
	$i=true;
}


$drugstk = "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"350\" font style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 ><B>ใบนัดผู้ป่วย รพ.ค่ายสุรศักดิ์มนตรี ลำปาง</B>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2>ชื่อ : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>วันที่ : ".$arr["appdate"]."<font face='Angsana New' size= 2 >&nbsp;เวลา : ".$arr["apptime"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 ><B>เพื่อ :</B> ".$arr["detail"]."<font face='Angsana New' size= 2 >&nbsp;<B>แพทย์ :</B> ".$arr["doctor"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><U><B>ยื่นใบนัดที่ :</B> ".$arr["room"]."</U></TD>
			</TR>";

if($i){

$drugstk .="<TR  style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >LAB : ".implode(", ",$list_lab_appoint)."</TD>
			</TR>";
}

if(trim($arr["xray"]) !="" &&  trim($arr["xray"]) !="NA"){
$drugstk .="<TR  style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >X-Ray : ".$arr["xray"]."&nbsp;&nbsp;&nbsp;&nbsp;อื่นๆ".$arr["other"]."</TD>
			</TR>";

}

$drugstk .="<TR style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 >วันเวลาออกใบนัด : ".date("d/m/Y H:i:s")."</TD>
			</TR>";

$phone_intra = '1100';
if( $user_code === 'ADMDEN' ){
	$phone_intra = '1230';
}

$drugstk .= "<TR style=\"line-height: 14px;\">
				<TD><font face='Angsana New' size= 1 > มีข้อสงสัยในการนัดติดต่อจุดบริการนัด โทร 054-839305 ต่อ $phone_intra</TD>
			</TR>
			</TABLE>
			";

if($i){
$drugstk .= "<DIV style=\"page-break-after:always\"></DIV>";
$drugstk .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"350\"  style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 >ใบนัดเจาะเลือด&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ชื่อผู้ป่วย : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>นัดวันที่ : ".$arr["appdate"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >แพทย์ : ".$arr["doctor"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ข้อควรปฏิบัติ : <U>".$arr["advice"]."</U></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >รายการ : <B>".implode(", ",$list_lab_appoint)."</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 1 >".$arr["other"]."</TD>
			</TR>
			</TABLE>
			";
}

if(trim($arr["xray"]) !=""  &&  trim($arr["xray"]) !="NA"){
$drugstk .= "<DIV style=\"page-break-after:always\"></DIV>";
$drugstk .= "<TABLE cellpadding=\"0\" cellspacing=\"0\" width=\"350\"  style=\"font-family:'MS Sans Serif'; font-size:14px; line-height: 20px;\">
			<TR>
				<TD align=\"center\"><font face='Angsana New' size= 3 >ใบนัด X-Ray&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >ชื่อผู้ป่วย : ".$arr["ptname"]." &nbsp;&nbsp; HN : ".$arr["hn"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 3 ><B><U>นัดวันที่ : ".$arr["appdate"]."</U></B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >แพทย์ : ".$arr["doctor"]."</TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 2 >X-Ray : <B>".$arr["xray"]."</B></TD>
			</TR>
			<TR>
				<TD><font face='Angsana New' size= 1 >".$arr["other"]."</TD>
			</TR>
			</TABLE>
			";
}

echo "



	<html>
	<head>
		<SCRIPT LANGUAGE=\"JavaScript\">
		
		window.onload = function(){
			
			print();
			//setTimeout(\"window.location.href='dt_index.php';\",5000);


		}
		
		</SCRIPT>
	</head>

	<body leftmargin=\"0\" topmargin=\"0\">
		",$drugstk,"
		<div style=\"page-break-after:always;\"></div><img src=\"printQrCode.php?hn=".$arr['hn']."\">
	</body>
	</html>
				
	";





	include("unconnect.inc");
?>