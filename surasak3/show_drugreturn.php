<?
session_start();
include("connect.inc");
$day=date("d");
$month=date("m");
$year=date("Y");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size:18px;
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
.txt{
	font-family: TH SarabunPSK;
	font-size: 16px;
}
.txt1 {	font-family: TH SarabunPSK;
	font-size: 20px;
}
#printable { display: block; }
@media print { 
     #non-printable { display: none; } 
     #printable { page-break-after:always; } 
} 
-->
</style>
<div id="non-printable">
<p align="center"><strong>��§ҹ��ػ��¡�ä׹�� �����Ť�����Ѻ�׹�ҡ�ͼ�����</strong></p>
<form name="form1" method="post" action="show_drugreturn.php">
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
<p align="center"><strong>��§ҹ��ػ��¡�ä׹�� �����Ť�����Ѻ�׹�ҡ�ͼ�����</strong><br>
<strong>�����ҧ�ѹ��� : </strong><?=$start_day;?> ��͹<?=$mon;?> �.�. <?=$start_year;?> �֧�ѹ��� <?=$end_day;?> ��͹<?=$mon1;?> �.�. <?=$end_year;?>
</p>
<table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr bgcolor="#FFCCCC">
    <td width="8%" align="center"><strong>�ӴѺ</strong></td>
    <td align="center" bgcolor="#FFCCCC"><strong>�ѹ/��͹/��</strong></td>
    <td align="center"><strong>HN</strong></td>
    <td align="center"><strong>���� - ���ʡ��</strong></td>
    <td align="center" bgcolor="#FFCCCC"><strong>�ҷ��׹</strong></td>
    <td align="center" bgcolor="#FFCCCC"><strong>�ӹǹ</strong></td>
    <td align="center" bgcolor="#FFCCCC"><strong>�Ҥ�</strong></td>
  </tr>
<?
$sql = "SELECT * FROM drug_return WHERE txtdate between '$start_year-$start_month-$start_day 00:00:00' AND '$end_year-$end_month-$end_day 23:59:59'";
$result = mysql_query($sql) or die("Query failed ".$sql.""); 
$i=0;
	while($rows=mysql_fetch_array($result)){
	$i++;
	$sumprice = $sumprice+$rows["price"];
	$showdate=substr($rows["txtdate"],0,10);
	list($yy,$mm,$dd)=explode("-",$showdate);
	$dateshow="$dd/$mm/$yy";
  ?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$dateshow;?></td>
    <td><?=$rows["hn"];?></td>
    <td align="left"><?=$rows["an"];?></td>
    <td align="left"><?=$rows["tradname"];?></td>
    <td align="center"><?=$rows["amount"];?></td>
    <td align="right"><?=$rows["price"];?></td>
  </tr>
  <?
  }
  ?>
  <tr>
    <td align="right" colspan="6"><strong>�Ҥ����������</strong></td>
    <td align="right"><strong><?=number_format($sumprice,2);?></strong></td>
  </tr>
</table>
</div>
<?
}
?>
