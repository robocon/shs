<?php 
include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<link rel="stylesheet" href="css/style.css">
<title>�к�ŧ����¹��Ǩ�آ�Ҿ</title>
<style type="text/css">
<!--
body {
	background-color: #0CA3D2;
}
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" /></head>
<body>
<div align="center">
<p align="center" class="pdx"><strong>��ª��͹ѡ�֡��������������Ǩ�آ�Ҿ ��Шӻա���֡�� 2557<br />
����Է�����෤������Ҫ������ҹ�� �ӻҧ</strong></p>
<div align="center">
<?
$csql1=mysql_query("select * from opcardchk where part ='�Ҫ����'");
$countop=mysql_num_rows($csql1);

$csql2=mysql_query("SELECT  * FROM opcardchk AS a INNER  JOIN out_result_chkup AS b ON a.HN = b.hn WHERE a.part ='�Ҫ����'");
$countout=mysql_num_rows($csql2);

$total=$countop-$countout;
?>

<table width="35%" border="0" cellpadding="3" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
  <tr>
    <td width="76%" align="left">�ӹǹ������ժ��͵�Ǩ�آ�Ҿ</td>
    <td width="24%" align="right"><strong style="color: #0033CC;"><?=number_format($countop,0);?></strong>
      &nbsp;��</td>
  </tr>
  <tr>
    <td align="left">�ӹǹ������Ǩ�آ�Ҿ��������</td>
    <td align="right"><strong style="color:#0033CC;"><?=number_format($countout,0);?></strong>
      &nbsp;��</td>
  </tr>
  <tr>
    <td align="left">�ӹǹ������ѧ������Ǩ�آ�Ҿ</td>
    <td align="right"><strong style="color: #FF0000;"><?=number_format($total,0);?></strong>
      &nbsp;��</td>
  </tr>
</table>
</div>
<br />
<?
$sql="SELECT  * 
FROM opcardchk AS a
LEFT  JOIN out_result_chkup AS b ON a.HN = b.hn
WHERE b.hn IS NULL and a.part ='�Ҫ����'
ORDER  BY  row";
//echo $sql;
$query=mysql_query($sql);
?>

<table width="80%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <th width="7%" height="31" bgcolor="#FF9999">�ӴѺ</td>
    <th width="14%" bgcolor="#FF9999">HN</td>
    <th width="21%" bgcolor="#FF9999">IDCARD    
    <th width="58%" bgcolor="#FF9999">����-���ʡ��</td>    </tr>
<?
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$fullname=$rows["yot"]."".$rows["name"]." ".$rows["surname"];
?>  
  <tr>
    <td align="center" bgcolor="#FFFFFF"><?=$i;?></td>
    <td bgcolor="#FFFFFF"><?=$rows["HN"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$rows["idcard"];?></td>
    <td align="left" bgcolor="#FFFFFF"><?=$fullname;?></td>
    </tr>
<?
}
?>  
</table>
</div>
</body>
</html>

