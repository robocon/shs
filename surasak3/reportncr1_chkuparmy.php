<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>��§ҹ���������§���ѧ�� ��.</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style></head>

<body>
<?
include("connect.inc");
if($_GET["ncr"]=="���������"){
$sql="select * from condxofyear_so where yearcheck ='$_GET[yearcheck]' and camp1='$_GET[camp]' and sum1='���� (��辺��������§)' order by age desc";
}else if($_GET["ncr"]=="���������§"){
$sql="select * from condxofyear_so where yearcheck ='$_GET[yearcheck]' and camp1='$_GET[camp]' and sum2='����������§���ͧ�鹵���ä' order by age desc";
}else if($_GET["ncr"]=="��������ä"){
$sql="select * from condxofyear_so where yearcheck ='$_GET[yearcheck]' and camp1='$_GET[camp]' and sum5='���´����ä������ѧ' order by age desc";
}
$query=mysql_query($sql);
?>
<p><strong>����˹��§ҹ</strong> : <?=$_GET["camp"];?> 
  <strong>����� : </strong>
<?=$_GET["ncr"];?></p>
<table width="100%" border="1" cellpadding="4" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="6%" align="center"><strong>�ӴѺ</strong></td>
    <td width="30%" align="center"><strong>����-���ʡ��</strong></td>
    <td width="14%" align="center"><strong>����</strong></td>
    <td width="50%" align="center"><strong>��������´</strong></td>
  </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
if($_GET["ncr"]=="���������"){
$detail=$rows["sum1"];
}else if($_GET["ncr"]=="���������§"){
$detail=$rows["sum2"];
}else if($_GET["ncr"]=="��������ä"){
$detail=$rows["sum5"];
}
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$rows["ptname"];?></td>
    <td><?=$rows["age"];?></td>
    <td>
	<?
if($_GET["ncr"]=="���������"){
	echo $detail;
}else if($_GET["ncr"]=="���������§"){
	echo $detail;
	if(!empty($rows["rs_sum21"])){
		echo ", $rows[rs_sum21]";
	}
	if(!empty($rows["rs_sum22"])){
		echo ", $rows[rs_sum22]";
	}
	if(!empty($rows["rs_sum23"])){
		echo ", $rows[rs_sum23]";
	}
	if(!empty($rows["rs_sum24"])){
		echo ", $rows[rs_sum24]";
	}
	if(!empty($rows["rs_sum25"])){
		echo ", $rows[rs_sum25]";
	}
}else if($_GET["ncr"]=="��������ä"){
	echo $detail;
	if(!empty($rows["rs_sum51"])){
		echo ", $rows[rs_sum51]";
	}
	if(!empty($rows["rs_sum52"])){
		echo ", $rows[rs_sum52]";
	}
	if(!empty($rows["rs_sum53"])){
		echo ", $rows[rs_sum53]";
	}
}	
?>
    </td>
  </tr>
 <?
 }
 ?>
</table>
</body>
</html>
