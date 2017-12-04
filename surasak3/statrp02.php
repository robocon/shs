<?php if(isset($_POST["submit"])){
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

	if($_POST["day"] != "")
		$_POST["day"] = sprintf("%02d",$_POST["day"]);
	
	$time_zone = explode("-",$_POST["time"]);
	
	if($_POST["code"] == "58001")
		$where = " AND code like '".$_POST["code"]."%'  ";
	else
		$where = " AND code = '".$_POST["code"]."'  ";

	$sql = "SELECT distinct ptname, hn   FROM patdata WHERE ( date between '".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".$time_zone[0]."' AND '".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".$time_zone[1]."') AND doctor = '".$_POST["doctor"]."' AND amount > 0 ".$where." limit 30 ";

	$result2  = Mysql_Query($sql);

	$sql = "SELECT distinct ptname, hn   FROM patdata WHERE ( date between '".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".$time_zone[0]."' AND '".$_POST["year"]."-".$_POST["month"]."-".$_POST["day"]." ".$time_zone[1]."') AND doctor = '".$_POST["doctor"]."' AND amount > 0 ".$where." limit 30,30 ";
	$result3  = Mysql_Query($sql);

?>
<html>
<head>
<title>การบันทึกประวัติผู้ป่วย ER</title>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
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
</head>
<body><BR>
<BR>
<CENTER>คลินิกนอกเวลาราชการ (ฝังเข็ม) เวลา <?php if($_POST["time"] == "07:30:00-12:30:00")  echo "08.00 - 12.00"; else echo "16.30 - 20.30";?></CENTER>
<dd><dd><dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;วันที่ <?php echo $_POST["day"]," ",$month_[$_POST["month"]]," ",$_POST["year"];?>
<TABLE align="center" border="1"  bordercolor="#000000" width="600" cellpadding="2" cellspacing="0">
<TR align="center">
	<TD width="50">ลำดับ</TD>
	<TD width="350">ชื่อ - สกุล ผู้รับบริการ</TD>
	<TD width="100">HN</TD>
	<TD width="100">หมายเหตุ</TD>
</TR>
<?php
	$i=1;
	while(list($hn,$ptname) = Mysql_fetch_row($result2)){	
?>
<TR>
	<TD align="center"><?php echo $i;?></TD>
	<TD>&nbsp;&nbsp;<?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD>&nbsp;</TD>
</TR>
<?php $i++;}?>
</TABLE>
<?php
	
$rows = Mysql_num_rows($result3);
if($rows){
?>
<div style="page-break-before: always;"></div>
<BR>
<BR>
<TABLE align="center" border="1"  bordercolor="#000000" width="600" cellpadding="2" cellspacing="0">
<TR align="center">
	<TD width="50">ลำดับ</TD>
	<TD width="350">ชื่อ - สกุล ผู้รับบริการ</TD>
	<TD width="100">HN</TD>
	<TD width="100">หมายเหตุ</TD>
</TR>
<?php
	while(list($hn,$ptname) = Mysql_fetch_row($result3)){	
?>
<TR>
	<TD align="center"><?php echo $i;?></TD>
	<TD>&nbsp;&nbsp;<?php echo $hn;?></TD>
	<TD><?php echo $ptname;?></TD>
	<TD>&nbsp;</TD>
</TR>
<?php $i++;}?>
</TABLE>
<?php }?>
<BR>
<BR><BR>
<TABLE  width="700" border="0"  align="center">
<TR>
	<TD  width="350" align="center">
	ผู้บันทึก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR>
	(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<BR>
	เจ้าหน้าที่คลินิกฝังเข็ม<BR>
	........../........../..........
	
	</TD>
	<TD  width="350" align="center">
		พ.อ.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR>
	(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<BR>
	แพทย์ผู้รักษา<BR>
	........../........../..........
	</TD>
</TR>
</TABLE>
</body>
</html>
<?php
}
 include("unconnect.inc");
 
 ?>