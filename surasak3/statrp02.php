<?php if(isset($_POST["submit"])){
	include("connect.inc");

	$month_["01"] = "���Ҥ�";
    $month_["02"] = "����Ҿѹ��";
    $month_["03"] = "�չҤ�";
    $month_["04"] = "����¹";
    $month_["05"] = "����Ҥ�";
    $month_["06"] = "�Զع�¹";
    $month_["07"] = "�á�Ҥ�";
    $month_["08"] = "�ԧ�Ҥ�";
    $month_["09"] = "�ѹ��¹";
    $month_["10"] = "���Ҥ�";
    $month_["11"] = "��Ȩԡ�¹";
    $month_["12"] = "�ѹ�Ҥ�";

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
<title>��úѹ�֡����ѵԼ����� ER</title>
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
<CENTER>��Թԡ�͡�����Ҫ��� (�ѧ���) ���� <?php if($_POST["time"] == "07:30:00-12:30:00")  echo "08.00 - 12.00"; else echo "16.30 - 20.30";?></CENTER>
<dd><dd><dd>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;�ѹ��� <?php echo $_POST["day"]," ",$month_[$_POST["month"]]," ",$_POST["year"];?>
<TABLE align="center" border="1"  bordercolor="#000000" width="600" cellpadding="2" cellspacing="0">
<TR align="center">
	<TD width="50">�ӴѺ</TD>
	<TD width="350">���� - ʡ�� ����Ѻ��ԡ��</TD>
	<TD width="100">HN</TD>
	<TD width="100">�����˵�</TD>
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
	<TD width="50">�ӴѺ</TD>
	<TD width="350">���� - ʡ�� ����Ѻ��ԡ��</TD>
	<TD width="100">HN</TD>
	<TD width="100">�����˵�</TD>
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
	���ѹ�֡&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR>
	(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<BR>
	���˹�ҷ���Թԡ�ѧ���<BR>
	........../........../..........
	
	</TD>
	<TD  width="350" align="center">
		�.�.&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<BR>
	(&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;)<BR>
	ᾷ�����ѡ��<BR>
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