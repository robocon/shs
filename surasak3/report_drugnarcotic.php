<?
session_start();
include("connect.inc");	
$day=date("d");
$month=date("m");
$year=date("Y");

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
	}

return $pAge;
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ������ҷ���к������ʾ�Դ</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
</head>
<body>
<div id="non-printable">
<p align="center"><strong>��§ҹ������ҷ���к������ʾ�Դ</strong></p>
<form name="form1" method="post" action="report_drugnarcotic.php">
<input name="act" type="hidden" value="show" />
<table width="100%" height="72" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="34%" height="30" align="right" valign="middle">��ǧ�ѹ��� :      </td>
    <td width="33%" height="30" align="left" valign="middle"><input name="start_day" type="text" id="start_day" size="5" value="1" />
��͹ :
  <input name="start_month" type="text" id="start_month" size="10" value="<?=$month;?>" />
��:
<input name="start_year" type="text" id="start_year" size="10" value="<?=$year+543;?>" /></td>
    <td width="33%" rowspan="2" align="left" valign="middle"><input type="submit" name="button2" id="button2" value="ViewReport" style="height: 40px; font-family:'TH SarabunPSK'; font-weight:bold; font-size:16px;" /></td>
  </tr>
  <tr>
    <td height="23" align="right" valign="middle">�֧�ѹ���&nbsp;:</td>
    <td height="23" align="left" valign="middle"><input name="end_day" type="text" id="end_day" size="5" value="<?=$day;?>" />
��͹ :
  <input name="end_month" type="text" id="end_month" size="10" value="<?=$month;?>" />
��:
<input name="end_year" type="text" id="end_year" size="10" value="<?=$year+543;?>" /></td>
    </tr>
</table>
</form>
<div align="center"><a href="../nindex.htm"><<< �˹���á</a></div>
<hr>
</div>
<?
if($_POST["act"]=="show"){ 
$start_year=$_POST["start_year"];
$start_month=$_POST["start_month"];
$start_day=sprintf("%02d",$_POST["start_day"]);

$end_year=$_POST["end_year"];
$end_month=$_POST["end_month"];
$end_day=sprintf("%02d",$_POST["end_day"]);

$selmon=$start_month;
	if($selmon=="01"){
		$mon ="���Ҥ�";
	}else if($selmon=="02"){
		$mon ="����Ҿѹ��";
	}else if($selmon=="03"){
		$mon ="�չҤ�";
	}else if($selmon=="04"){
		$mon ="����¹";
	}else if($selmon=="05"){
		$mon ="����Ҥ�";
	}else if($selmon=="06"){
		$mon ="�Զع�¹";
	}else if($selmon=="07"){
		$mon ="�á�Ҥ�";
	}else if($selmon=="08"){
		$mon ="�ԧ�Ҥ�";
	}else if($selmon=="09"){
		$mon ="�ѹ��¹";
	}else if($selmon=="10"){
		$mon ="���Ҥ�";
	}else if($selmon=="11"){
		$mon ="��Ȩԡ�¹";
	}else if($selmon=="12"){
		$mon ="�ѹ�Ҥ�";
	}
	
$selmon1=$end_month;
	if($selmon1=="01"){
		$mon1 ="���Ҥ�";
	}else if($selmon1=="02"){
		$mon1 ="����Ҿѹ��";
	}else if($selmon1=="03"){
		$mon1 ="�չҤ�";
	}else if($selmon1=="04"){
		$mon1 ="����¹";
	}else if($selmon1=="05"){
		$mon1 ="����Ҥ�";
	}else if($selmon1=="06"){
		$mon1 ="�Զع�¹";
	}else if($selmon1=="07"){
		$mon1 ="�á�Ҥ�";
	}else if($selmon1=="08"){
		$mon1 ="�ԧ�Ҥ�";
	}else if($selmon1=="09"){
		$mon1 ="�ѹ��¹";
	}else if($selmon1=="10"){
		$mon1 ="���Ҥ�";
	}else if($selmon1=="11"){
		$mon1 ="��Ȩԡ�¹";
	}else if($selmon1=="12"){
		$mon1 ="�ѹ�Ҥ�";
	}	
?>
<div id="printable"> 
<p align="center"><strong>��§ҹ������ҷ���к������ʾ�Դ</strong><br>
<strong>�����ҧ�ѹ��� : </strong><?=$start_day;?> ��͹<?=$mon;?> �.�. <?=$start_year;?> �֧�ѹ��� <?=$end_day;?> ��͹<?=$mon1;?> �.�. <?=$end_year;?>
</p>
<?
$dsql="select * from druglst where narcotic='Y'";
$dquery=mysql_query($dsql) or die ("Query Error");
$n=0;
while($drows=mysql_fetch_array($dquery)){
$n++;
?>
<div align="left"><strong>�ӴѺ��� <?=$n;?> ������ : <?=$drows["drugcode"];?> ������ : <?=$drows["tradname"];?></strong></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:">
  <tr>
    <td width="4%" align="center" bgcolor="#FFCCCC"><strong>#</strong></td>
    <td width="9%" align="center" bgcolor="#FFCCCC"><strong>�ѹ��������</strong></td>
    <td width="8%" align="center" bgcolor="#FFCCCC"><strong>HN</strong></td>
    <td width="19%" align="center" bgcolor="#FFCCCC"><strong>����-���ʡ��</strong></td>
    <td width="10%" align="center" bgcolor="#FFCCCC"><strong>����</strong></td>
    <td width="28%" align="center" bgcolor="#FFCCCC"><strong>�������</strong></td>
    <td width="15%" align="center" bgcolor="#FFCCCC"><strong>������</strong></td>
    <td width="7%" align="center" bgcolor="#FFCCCC"><strong>�ӹǹ������</strong></td>
  </tr>
<?
$sql="select * from drugrx where (date between '$start_year-$start_month-$start_day 00:00:00' AND '$end_year-$end_month-$end_day 23:59:59') and drugcode='".$drows["drugcode"]."'";
$query=mysql_query($sql) or die ("Query Error");
if(mysql_num_rows($query) < 1){
	echo "<tr><td colspan='11' align='center'>----- ����բ����� -----</td></tr>";
}
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$osql="select * from opcard where hn='".$rows["hn"]."'";
$oquery=mysql_query($osql) or die ("Query Error");
$orows=mysql_fetch_array($oquery);
$ptname=$orows["yot"].$orows["name"]."  ".$orows["surname"];
$address=$orows["address"]." �.".$orows["tambol"]."  �.".$orows["ampur"]."  �.".$orows["changwat"];
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["date"];?></td>
    <td><?=$rows["hn"];?></td>
    <td><?=$ptname;?></td>
    <td><?=calcage($orows["dbirth"]);?></td>
    <td><?=$address;?></td>
    <td><?=$orows["phone"];?></td>
    <td><?=$rows["amount"];?></td>
  </tr>
<?
}
?>    
</table>
<br />
<?
}
?>
</div>
<?
}
?>
</body>
</html>
