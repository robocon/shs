<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<?
if($_GET['do']==view){

include("../Connections/connect.inc.php"); 


$date1=$_GET['ddate'];
$film=$_GET['film'];


$sql="SELECT * FROM xray_doctor 
WHERE  film='$film' and  date LIKE  '$date1%'    ";
$result = mysql_query($sql);
$rows=mysql_num_rows($result);

$n=0;
echo $sql;
?>
<table  border="2" cellpadding="0" cellspacing="0" class="forntsarabun" >
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td>ลำดับ</td>
<td>วันที่</td>
<td>HN</td>
<td>ชื่อ-สกุล</td>
<td>รายละเอียด</td>
<td>ฟิล์ม</td>
</tr>
<?
While($dbarr=mysql_fetch_array($result)) {
$n++;

$ptname=$dbarr['yot'].' '.$dbarr['name'].' '.$dbarr['sname'];

?>
<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td><?=$n;?></td>
	<td><?=$dbarr['date'];?></td>
	<td><?=$dbarr['hn'];?></td>
	<td><?=$ptname;?></td>
	<td><?=$dbarr['detail'];?></td>
	<td><?=$dbarr['film'];?></td>
</tr>
<? } ?>
</table>
<?
}
?>