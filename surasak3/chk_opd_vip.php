<? 
session_start();
include("../connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center"><strong>��§ҹ��ª��ͼ����� VIP þ.��������ѡ��������</strong></p>
<table width="90%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="11%" align="center"><strong>�ӴѺ</strong></td>
    <td width="89%" align="center"><strong>��-����-���ʡ��</strong></td>
  </tr>
<?
$sql="select * from opcard where idguard like 'MX03%' order by yot desc";
//echo $sql."<br>";
$result = mysql_query($sql)or die(mysql_error());
$i=0;
while($rows= mysql_fetch_array($result)){
$i++;
$ptname=$rows["yot"]." ".$rows["name"]."&nbsp;&nbsp;".$rows["surname"];
 ?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td><?=$ptname;?></td>
  </tr>
<?
  }
?>
</table>


