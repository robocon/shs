<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE> รายชื่อสิทธิ์ผู้ป่วย </TITLE>
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</HEAD>

<BODY>
<?php include("connect.inc");

$list_ptright = array();
	
	$list_ptright["P01"] = "-------";
	$list_ptright["P02"] = "ทหาร (น)";
	$list_ptright["P03"] = "ทหาร (นส)";
	$list_ptright["P04"] = "ทหาร (พลฯ)";
	$list_ptright["P05"] = "ครอบครัว";
	$list_ptright["P06"] = "พ.ต้น";
	$list_ptright["P07"] = "พ.";
	$list_ptright["P08"] = "ประกันสังคม";
	$list_ptright["P09"] = "30บาท";
	$list_ptright["P10"] = "30บาทฉุกเฉิน";
	$list_ptright["P11"] = "พรบ.";
	$list_ptright["P12"] = "กท.44";
	
	?>
<TABLE width="800" cellpadding="2" cellspacing="0" border="1" bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
<TR align="center">
	<TD>No.</TD>
	<TD>HN</TD>
	<TD>ชื่อ - สกุล</TD>
	<TD>สิทธิ์หลัก</TD>
	<TD>สิทธิ์รอง</TD>
</TR>
<?php
$i=1;
	$sql = "Select a.hn,concat(b.yot,' ',b.name,' ',b.surname) as fullname , a.list_ptright, a.list_ptright2 From (Select hn, list_ptright, list_ptright2 From trauma where (date_in between '".$_GET["select_day"]." 00:00:00' AND '".$_GET["select_day2"]." 23:59:59') AND ".$_GET["field"]." = '".$_GET["list_ptright"]."' ) as a INNER JOIN opcard as b ON a.hn=b.hn ";

	$result = Mysql_Query($sql);
	while($arr = Mysql_fetch_assoc($result)){

echo "<TR>
	<TD>".$i."</TD>
	<TD>".$arr["hn"]."</TD>
	<TD>".$arr["fullname"]."</TD>
	<TD>".$list_ptright[$arr["list_ptright"]]."</TD>
	<TD>".$list_ptright[$arr["list_ptright2"]]."</TD>
</TR>";
$i++;
	}
?>
</table>
<?php
include("unconnect.inc");
?>
</BODY>
</HTML>
