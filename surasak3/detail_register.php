<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?
if($_GET['do']=='view'){
	
include("../connect.inc");
include("function.php"); 

$date1=$_GET['date1'];
$date2=$_GET['date2'];
$goup=$_GET['goup'];


$tsql1="CREATE TEMPORARY TABLE   db1  SELECT * 
FROM  `opcard` 
WHERE  `regisdate` BETWEEN  '$date1' AND '$date2'  and goup like '%$goup%'";
$tquery1 = mysql_query($tsql1);


$sql="SELECT  *  FROM db1  order by regisdate asc";
$result = mysql_query($sql);
$rows=mysql_num_rows($result);

$n=0;


print "<div><font class='forntsarabun' >��§ҹ���������� �����  ".displaydate($date1)."  �֧ ".displaydate($date2)."</font></div><br>";
?>
<input name="btnButton" type="button" value="��͹��Ѻ" onClick="JavaScript:history.back();" class="forntsarabun" />

<table  border="2" cellpadding="0" cellspacing="0" class="forntsarabun" >
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td align="center">�ӴѺ</td>
<td align="center">ŧ����¹</td>
<td align="center">�Ţ�ѵ� ���.</td>
<td align="center">HN</td>
<td align="center">����-ʡ��</td>
<td align="center">�������ؤ��</td>
</tr>
<?
while($dbarr=mysql_fetch_array($result)) {
$n++;
$ptname=$dbarr['yot'].$dbarr['name'].' '.$dbarr['surname'];

?>
	<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td align="center"><?=$n;?></td>
	<td><?=$dbarr['regisdate'];?></td>
	<td><?=$dbarr['idcard'];?></td>
    <td><?=$dbarr['hn'];?></td>
	<td><?=$ptname;?></td>
	<td><?=$dbarr['goup'];?></td>
  </tr>
<? } ?>
</table>
<?
}
?>
