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

include("connect.inc"); 


$hn=$_GET['hn'];
$txdate=$_GET['txdate'];
//$txdate=explode(" ",$_GET['txdate']);



$sql="SELECT  *  FROM  patdata   WHERE  date like '%$txdate%' and hn =  '$hn' and depart like '%XRAY%' ";
$result = mysql_query($sql);
$rows=mysql_num_rows($result);

$n=0;
?>

<table  border="2" cellpadding="0" cellspacing="0" class="forntsarabun" >
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td align="center">ลำดับ</td>
<td align="center">วันที่</td>
<td align="center">HN</td>
<td align="center">ชื่อ-สกุล</td>
<td align="center">รายละเอียด</td>
<td align="center">สิทธิ</td>
<td align="center">ราคา</td>
<td align="center">เบิกได้</td>
<td align="center">เบิกไม่ได้</td>
</tr>
<?
while($dbarr=mysql_fetch_array($result)) {
$n++;


?>
	<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td align="center"><?=$n;?></td>
	<td><?=$dbarr['date'];?></td>
	<td><?=$dbarr['hn'];?></td>
	<td><?=$dbarr['ptname'];?></td>
	<td><?=$dbarr['detail'];?></td>
	<td><?=$dbarr['ptright'];?></td>
	<td><?=$dbarr['price'];?></td>
	<td><?=$dbarr['yprice'];?></td>
	<td><?=$dbarr['nprice'];?></td>
  </tr>
<? } ?>
</table>
<?
}
?>
<input name="btnButton" type="button" value="กลับหน้าเดิม" onClick="JavaScript:history.back();" class="forntsarabun" />