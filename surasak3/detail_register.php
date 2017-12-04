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


print "<div><font class='forntsarabun' >รายงานผู้ป่วยใหม่ ตั้งแต่  ".displaydate($date1)."  ถึง ".displaydate($date2)."</font></div><br>";
?>
<input name="btnButton" type="button" value="ย้อนกลับ" onClick="JavaScript:history.back();" class="forntsarabun" />

<table  border="2" cellpadding="0" cellspacing="0" class="forntsarabun" >
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td align="center">ลำดับ</td>
<td align="center">ลงทะเบียน</td>
<td align="center">เลขบัตร ปชช.</td>
<td align="center">HN</td>
<td align="center">ชื่อ-สกุล</td>
<td align="center">ประเภทบุคคล</td>
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
