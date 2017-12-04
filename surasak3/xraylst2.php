<?php
session_start();
 include("connect.inc");   
	$month["01"] = "มกราคม";
    $month["02"] = "กุมภาพันธ์";
    $month["03"] = "มีนาคม";
    $month["04"] = "เมษายน";
    $month["05"] = "พฤษภาคม";
    $month["06"] = "มิถุนายน";
    $month["07"] = "กรกฏาคม";
    $month["08"] = "สิงหาคม";
    $month["09"] = "กันยายน";
    $month["10"] = "ตุลาคม";
    $month["11"] = "พฤศจิกายน";
    $month["12"] = "ธันวาคม";
	

?>
<html>
<head>
<style>
	body{
		font-family:"Angsana New";font-size:20px;
	}
	.font_tb{ 
		font-family:"Angsana New"; font-size:20px; text-align:center;
		}
</style>
</head>
<body>

<?php


	if($_REQUEST["start_year"] =="" || $_REQUEST["start_month"] =="" || $_REQUEST["start_year"] ==""){
		$date_select = (date("Y")+543).date("-m-d%");
		$date_select2 = (date("Y")+543).date("-m%");
		//$date_head = date("d-m-").(date("Y")+543);
		$date_head = date("d ").$month[date("m")]." ".(date("Y")+543);
	}else{
		$date_select = $_REQUEST["start_year"]."-".$_REQUEST["start_month"]."-".$_REQUEST["start_day"]."%";
		$date_select2 = $_REQUEST["start_year"]."-".$_REQUEST["start_month"]."%";
		$date_head = $_REQUEST["start_day"]." ".$month[$_REQUEST["start_month"]]." ".$_REQUEST["start_year"];
	}

$sql = "SELECT sum( `digital` ) , sum( `10_12` ) , sum( `14_14` ) , sum( `NONE` )  FROM `xray_stat`  WHERE `date`  LIKE '".$date_select."%'  AND detail not like '%CT%' AND ( date_format( `date` , '%H:%i:%s' )  BETWEEN '08:00:00' AND '16:00:00' )";
$result = mysql_query($sql) or die(mysql_error());
list($digital1, $F10_121, $F14_171, $none1) = mysql_fetch_row($result);
$sql = "SELECT sum( `digital` ) , sum( `10_12` ) , sum( `14_14` ) , sum( `NONE` )  FROM `xray_stat`  WHERE `date`  LIKE '".$date_select."%' AND detail not like '%CT%' AND ( date_format( `date` , '%H:%i:%s' )  BETWEEN '16:00:01' AND '23:59:59' )";
$result = mysql_query($sql);
list($digital2, $F10_122, $F14_172, $none2) = mysql_fetch_row($result);

$sql = "SELECT sum( `digital` ) , sum( `10_12` ) , sum( `14_14` ) , sum( `NONE` )  FROM `xray_stat`  WHERE `date`  LIKE '".$date_select."%' AND detail not like '%CT%'  AND ( date_format( `date` , '%H:%i:%s' )  BETWEEN '00:00:00' AND '07:59:59' )";
$result = mysql_query($sql);
list($digital3, $F10_123, $F14_173, $none3) = mysql_fetch_row($result);

if($_SERVER["PHP_SELF"] == "/sm3/surasak3/xraylst2.php"){
echo "
	<SCRIPT LANGUAGE=\"JavaScript\">
	
	window.onload = function(){
		window.print();
	}
	
	</SCRIPT>
";

	$print ="";

}else{
	$print ="&nbsp;&nbsp;<A HREF=\"xraylst2.php?start_day=".$_REQUEST["start_day"]."&start_month=".$_REQUEST["start_month"]."&start_year=".$_REQUEST["start_year"]."\" target=\"_blank\">พิมพ์</A>";
}

?>
 

สรุปจำนวนฟิล์ม ประจำวันที่ <?php echo $date_head; //echo substr($date_head,3),$print; ?><BR>
<TABLE width="500" border="1" cellpadding="0" cellspacing="0" style="border-color: #000000">
<TR align="center">
	<TD><B>เวร/ฟิล์ม</B></TD>
	<TD><B>Digital</B></TD>
	<TD><B>10x12</B></TD>
	<TD><B>14x17</B></TD>
	<TD><B>NONE</B></TD>
</TR>
<TR>
	<TD align="center"><B>เช้า</B></TD>
	<TD align="right"><?php echo $digital1;?>&nbsp;</TD>
	<TD align="right"><?php echo $F10_121;?>&nbsp;</TD>
	<TD align="right"><?php echo $F14_171;?>&nbsp;</TD>
	<TD align="right"><?php echo $none1;?>&nbsp;</TD>
</TR>
<TR>
	<TD align="center"><B>บ่าย</B></TD>
	<TD align="right"><?php echo $digital2;?>&nbsp;</TD>
	<TD align="right"><?php echo $F10_122;?>&nbsp;</TD>
	<TD align="right"><?php echo $F14_172;?>&nbsp;</TD>
	<TD align="right"><?php echo $none2;?>&nbsp;</TD>
</TR>
<TR>
	<TD align="center"><B>ดึก</B></TD>
	<TD align="right"><?php echo $digital3;?>&nbsp;</TD>
	<TD align="right"><?php echo $F10_123;?>&nbsp;</TD>
	<TD align="right"><?php echo $F14_173;?>&nbsp;</TD>
	<TD align="right"><?php echo $none3;?>&nbsp;</TD>
</TR>
</TABLE>
</body>
<?php
include("unconnect.inc");
?>