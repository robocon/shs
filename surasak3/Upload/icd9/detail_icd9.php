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


$date1=$_GET['ddate'];
$icd9=base64_decode($_GET['icd9']);



$sql="SELECT  *  FROM ipcard as a ,ipicd9cm  as b WHERE  a.an=b.an and b.icd9cm='".base64_decode($_GET['icd9'])."' and date LIKE  '$date1%'";
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
<h1 class="forntsarabun">รายชื่อผู้ป่วย icd9  :: <?=$icd9;?>  ประจำเดือน  <?=$dateshow;?><br /><br />

<table  border="2" cellpadding="0" cellspacing="0" class="forntsarabun" >
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td>ลำดับ</td>
<td>วันที่</td>
<td>HN</td>
<td>an</td>
<td>ชื่อ-สกุล</td>
<td>diag</td>
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
	<td><?=$dbarr['an'];?></td>
	<td><?=$dbarr['ptname'];?></td>
	<td><?=$dbarr['diag'];?></td>
	<td><?=$dbarr['ptright'];?></td>
</tr>
<? } ?>
</table>
<?
}
?>
<input name="btnButton" type="button" value="กลับหน้าเดิม" onClick="JavaScript:history.back();" class="forntsarabun" />