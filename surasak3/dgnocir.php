<?php
session_start();
 include("connect.inc");
$month_["01"] = "มกราคม";
$month_["02"] = "กุมภาพันธ์";
$month_["03"] = "มีนาคม";
$month_["04"] = "เมษายน";
$month_["05"] = "พฤษภาคม";
$month_["06"] = "มิถุนายน";
$month_["07"] = "กรกฏาคม";
$month_["08"] = "สิงหาคม";
$month_["09"] = "กันยายน";
$month_["10"] = "ตุลาคม";
$month_["11"] = "พฤศจิกายน";
$month_["12"] = "ธันวาคม";

echo "รายงานยาที่ไม่หมุนเวียน ( ไม่มีการจ่ายยาในรอบ 3 เดือน ) &nbsp;&nbsp;&nbsp;<A HREF=\"../nindex.htm\">&lt;&lt;เมนู</A><BR>";
echo "ณ วันที่ ",date("d")," ",$month_[date("m")]," ",date("Y")+543,"<BR>";

echo "<TABLE>
<TR bgcolor=\"blue\" style=\"color: #FFFFFF\">
	<TD>รหัสยา</TD>
	<TD>ชื่อยา</TD>
	<TD>ชื่อยา</TD>
	<TD>วันที่เบิกล่าสุด</TD>
	<TD>จำนวนปัจจุบันที่มีอยู่ในคลังยา</TD>
</TR>";

$string_time = mktime(0,0,0,date("m"),date("d")-30,date("Y"));

//where  datetranx < '".date("d-m-Y",$string_time)." 00:00:00' AND datetranx IS NOT NULL 

$sql = "SELECT drugcode, tradname, genname, date_format( datetranx, '%d-%m-%Y' ) AS format_datetranx, mainstk  FROM `druglst` where  datetranx < '".(date("Y",$string_time)+543)."".date("-m-d",$string_time)." 00:00:00' AND datetranx IS NOT NULL";

$result = Mysql_Query($sql);
$i=true;
while($arr = Mysql_fetch_assoc($result)){
	if($i == true){
		$bgcolor="#FFFFCC";
		$i = false;
	}else{
		$bgcolor="#FFFFCC";
		$i = true;
	}

	echo"
	<TR bgcolor=\"",$bgcolor,"\">
		<TD>",$arr["drugcode"],"</TD>
		<TD>",$arr["tradname"],"</TD>
		<TD>",$arr["genname"],"</TD>
		<TD>",$arr["format_datetranx"],"</TD>
		<TD>",$arr["mainstk"],"</TD>
	</TR>";
}

echo"</TABLE>";



include("unconnect.inc");
?>

