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

include("../Connections/connect.inc.php"); 


$date1=$_GET['ddate'];
$detail=$_GET['detail'];

$detail2=substr($detail,0,3);


$sql="SELECT  *  FROM xray_stat  WHERE  ptright like '$detail2%' and date LIKE  '$date1%'";
$result = mysql_query($sql);
$rows=mysql_num_rows($result);

$n=0;

$y=substr($date1,0,4);
$m=substr($date1,5,2);

switch($m){
		case "01": $printmonth = "มกราคม"; break;
		case "02": $printmonth = "กุมภาพันธ์"; break;
		case "03": $printmonth = "มีนาคม"; break;
		case "04": $printmonth = "เมษายน"; break;
		case "05": $printmonth = "พฤษภาคม"; break;
		case "06": $printmonth = "มิถุนายน"; break;
		case "07": $printmonth = "กรกฏาคม"; break;
		case "08": $printmonth = "สิงหาคม"; break;
		case "09": $printmonth = "กันยายน"; break;
		case "10": $printmonth = "ตุลาคม"; break;
		case "11": $printmonth = "พฤศจิกายน"; break;
		case "12": $printmonth = "ธันวาคม"; break;
	}
	
   $dateshow=$printmonth." ".$y;

?>
<h1 class="forntsarabun">รายชื่อผู้ป่วยสิทธิการรักษา  <?=$detail;?>  ประจำเดือน  <?=$dateshow;?><br /><br />

<table  border="2" cellpadding="0" cellspacing="0" class="forntsarabun" >
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td>ลำดับ</td>
<td>วันที่</td>
<td>HN</td>
<td>ชื่อ-สกุล</td>
<td>รายละเอียด</td>
<td>สิทธิ</td>
</tr>
<?
while($dbarr=mysql_fetch_array($result)) {
$n++;


?>
	<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td><?=$n;?></td>
	<td><?=$dbarr['date'];?></td>
	<td><?=$dbarr['hn'];?></td>
	<td><?=$dbarr['ptname'];?></td>
	<td><?=$dbarr['detail'];?></td>
	<td><?=$dbarr['ptright'];?></td>
</tr>
<? } ?>
</table>
<?
}
?>
<input name="btnButton" type="button" value="กลับหน้าเดิม" onClick="JavaScript:history.back();" class="forntsarabun" />