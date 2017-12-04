<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
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

echo "รายงานยาที่ไม่หมุนเวียน ( ไม่มีการจ่ายยาตามช่วงเวลา ) &nbsp;&nbsp;&nbsp;<A HREF=\"../nindex.htm\">&lt;&lt;เมนู</A><BR>";
echo "ณ วันที่ ",date("d")," ",$month_[date("m")]," ",date("Y")+543,"<BR>";
echo "<div align='center' style='color:red;'>กำลังปรับปรุง Report ยังไม่เสร็จสมบูรณ์</div>";
echo "<TABLE>
<TR bgcolor=\"blue\" style=\"color: #FFFFFF\">
	<TD><strong>รหัสยา</strong></TD>
	<TD><strong>ชื่อยา</strong></TD>
	<TD><strong>ชื่อยา</strong></TD>
	<TD width=\"7%\"><strong>วันที่เบิกล่าสุด</strong></TD>
	<TD width=\"5%\" align=\"center\"><strong>จำนวนยา<br>ในคลัง</strong></TD>
	<TD width=\"7%\"><strong>วันที่หมดอายุ</strong></TD>
	<TD><strong>รหัสบริษัท</strong></TD>
	<TD><strong>ชื่อบริษัท</strong></TD>
</TR>";

$string_time = mktime(0,0,0,date("m"),date("d")-30,date("Y"));

//where  datetranx < '".date("d-m-Y",$string_time)." 00:00:00' AND datetranx IS NOT NULL 

$sql = "SELECT drugcode, tradname, genname, date_format( datetranx, '%d-%m-%Y' ) AS format_datetranx, mainstk, comcode, comname  FROM `druglst` where  datetranx < '".(date("Y",$string_time)+543)."".date("-m-d",$string_time)." 00:00:00' AND datetranx IS NOT NULL";
//echo $sql;
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

//หาวันหมดอายุของยา จากการนำยาเข้าคลังครั้งสุดท้าย	
$query1=mysql_query("select date_format(expdate,'%d-%m-%Y') from stktranx where drugcode='$arr[drugcode]' and amount > 0 order by row_id desc limit 1");
list($newexpdate)=mysql_fetch_array($query1);
list($d,$m,$y)=explode("-",$newexpdate);
$y=$y+543;
$expdate="$d-$m-$y";


	echo"
	<TR bgcolor=\"",$bgcolor,"\">
		<TD>",$arr["drugcode"],"</TD>
		<TD>",$arr["tradname"],"</TD>
		<TD>",$arr["genname"],"</TD>
		<TD>",$arr["format_datetranx"],"</TD>
		<TD>",$arr["mainstk"],"</TD>
		<TD>",$expdate,"</TD>
		<TD>",$arr["comcode"],"</TD>
		<TD>",$arr["comname"],"</TD>						
	</TR>";
}

echo"</TABLE>";



include("unconnect.inc");
?>

