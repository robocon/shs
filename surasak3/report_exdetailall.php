<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
</style>
<?
include("connect.inc"); 
$thidate=$_GET['thidate'];
$toborow=$_GET['toborow'];

	$sql1="SELECT  *  FROM opday WHERE thidate like '$thidate%' and substr( toborow, 1, 4 ) =  '$toborow' order by thidate asc";
	$query1 = mysql_query($sql1);
	
	$i=1;
?>

<table  border="1" style="border-collapse:collapse" cellpadding="0" cellspacing="0" bordercolor="#000000" class="forntsarabun"> 
    <tr bgcolor="#0099FF">
    <td align="center">ลำดับ</td>
    <td align="center">วันที่-เวลา</td>
    <td align="center">HN</td>
    <td align="center">ชื่อ-สกุล</td>
    <td align="center">สิทธิ</td>
    <td align="center">ออกโดย</td>
    </tr>
    <? 
while($arr1=mysql_fetch_array($query1)){
	?>
    <tr class="forntsarabun">
      <td align="center"><?=$i;?></td>
      <td><?=$arr1['thidate']?></td>
      <td><?=$arr1['hn']?></td>
      <td><?=$arr1['ptname']?></td>
      <td><?=$arr1['ptright']?></td>
      <td><?=$arr1['toborow']?></td>
     </tr>
     <?
	 $i++;
	}
	?>

    </table>