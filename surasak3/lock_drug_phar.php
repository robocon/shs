<?php
session_start();
/*if(isset($_GET["action"]) && $_GET["action"] != "edit" && $_GET["action"] != "del"){
	header("content-type: application/x-javascript; charset=TIS-620");
}*/

	 
	 ?>

<html>
<head>
<title>Lock ��</title>
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

<div id="no_print" ><A HREF="../nindex.htm">&lt;&lt; ����</A></div>
<?
$d=date("d");
$y=date("Y")+543;
$m=date("m");
switch($m){
		case "01": $printmonth = "���Ҥ�"; break;
		case "02": $printmonth = "����Ҿѹ��"; break;
		case "03": $printmonth = "�չҤ�"; break;
		case "04": $printmonth = "����¹"; break;
		case "05": $printmonth = "����Ҥ�"; break;
		case "06": $printmonth = "�Զع�¹"; break;
		case "07": $printmonth = "�á�Ҥ�"; break;
		case "08": $printmonth = "�ԧ�Ҥ�"; break;
		case "09": $printmonth = "�ѹ��¹"; break;
		case "10": $printmonth = "���Ҥ�"; break;
		case "11": $printmonth = "��Ȩԡ�¹"; break;
		case "12": $printmonth = "�ѹ�Ҥ�"; break;
	}
	 $dateshow=$d.' '.$printmonth.' '.$y;
?>
<h1 class="font1">��¡���ҷ�� LOCK ������ � �ѹ���  <?=$dateshow;?></h1>
<FORM name="f1" METHOD=POST ACTION="" >
  <TABLE   width="700" border="1" bordercolor="#000000" style="border-collapse:collapse" cellpadding="0" cellspacing="0">
<TR>
	<TD>
<TABLE border="0"  width="100%">
<TR >
  <TD align="center" bgcolor="#CCCCCC" >������</TD>
	
  <!-- <TD align="center" >����</TD> -->
	<TD align="center" bgcolor="#CCCCCC" >���͡�ä��</TD>
	<TD align="center" bgcolor="#CCCCCC" >�������ѭ</TD>
	<TD align="center" bgcolor="#CCCCCC" >�ҤҢ��</TD>
	<TD align="center" bgcolor="#CCCCCC" >�Ҥҷع</TD>
	<TD align="center" bgcolor="#CCCCCC" >˹���</TD>
	<TD align="center" bgcolor="#CCCCCC" >������</TD>
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
