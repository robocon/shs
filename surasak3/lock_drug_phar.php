<?php
session_start();
/*if(isset($_GET["action"]) && $_GET["action"] != "edit" && $_GET["action"] != "del"){
	header("content-type: application/x-javascript; charset=TIS-620");
}*/

	 
	 ?>

<html>
<head>
<title>Lock ยา</title>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
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
.font1{
	font-family:Verdana, Geneva, sans-serif;
	font-size: 14 px;
	color:#000;

}

<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
} 
</style>
</head>
<body>

<div id="no_print" ><A HREF="../nindex.htm">&lt;&lt; เมนู</A></div>
<?
$d=date("d");
$y=date("Y")+543;
$m=date("m");
switch($m){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	 $dateshow=$d.' '.$printmonth.' '.$y;
?>
<h1 class="font1">รายการยาที่ LOCK ข้อมูล ณ วันที่  <?=$dateshow;?></h1>
<FORM name="f1" METHOD=POST ACTION="" >
  <TABLE   width="700" border="1" bordercolor="#000000" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
<TR>
	<TD>
<TABLE border="0"  width="100%">
<TR >
  <TD align="center" bgcolor="#CCCCCC" >รหัสยา</TD>
	
  <!-- <TD align="center" >รหัส</TD> -->
	<TD align="center" bgcolor="#CCCCCC" >ชื่อการค้า</TD>
	<TD align="center" bgcolor="#CCCCCC" >ชื่อสามัญ</TD>
	<TD align="center" bgcolor="#CCCCCC" >ราคาขาย</TD>
	<TD align="center" bgcolor="#CCCCCC" >ราคาทุน</TD>
	<TD align="center" bgcolor="#CCCCCC" >หน่วย</TD>
	<TD align="center" bgcolor="#CCCCCC" >ประเภท</TD>
</TR>
<?php
include("connect.inc");

$sql = "SELECT * FROM  `druglst` WHERE  `lock` =  'n' ";

$result = mysql_query($sql);

while($arr = mysql_fetch_assoc($result)){

	if($arr["lock"] != "Y"){
		$bgcolor="#FF9393";
	}else{
		$bgcolor="#FFFFFF";
	}

?>
<TR bgcolor="<?php echo $bgcolor;?>">
  <TD><?php echo $arr["drugcode"];?></TD>

  <!-- 	<TD><?php //echo $arr["drugcode"];?></TD> -->
	<TD><?php echo $arr["tradname"];?></TD>
	<TD><?php echo $arr["genname"];?></TD>
	<TD><?php echo $arr["salepri"];?></TD>
	<TD><?php echo $arr["unitpri"];?></TD>
	<TD><?php echo $arr["unit"];?></TD>
	<TD align="center"><?php echo $arr["part"];?></TD>
</TR>
<?php
}	
?>
<TR>
	<TD colspan="9" align="center"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
</FORM>


</body>
</html>
<?php include("unconnect.inc");?>
