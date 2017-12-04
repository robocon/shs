<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานประจำเดือน</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
-->
</style>
<body>

<? include("../Connections/connect.inc.php");  ?>

<h1 class="forntsarabun">รายงานการตรวจ Bone Density</h1>
<form name="f1" action="" method="post">
<table  border="0" cellpadding="3" cellspacing="3">
  <tr class="forntsarabun">
    <td  align="right"><span class="forntsarabun">ช่วงเดือน</span></td>
    <td ><? $m=date('m'); ?>
      <select name="m_start" class="forntsarabun">
        <option value="01" <? if($m=='01'){ echo "selected"; }?>>มกราคม</option>
        <option value="02" <? if($m=='02'){ echo "selected"; }?>>กุมภาพันธ์</option>
        <option value="03" <? if($m=='03'){ echo "selected"; }?>>มีนาคม</option>
        <option value="04" <? if($m=='04'){ echo "selected"; }?>>เมษายน</option>
        <option value="05" <? if($m=='05'){ echo "selected"; }?>>พฤษภาคม</option>
        <option value="06" <? if($m=='06'){ echo "selected"; }?>>มิถุนายน</option>
        <option value="07" <? if($m=='07'){ echo "selected"; }?>>กรกฎาคม</option>
        <option value="08" <? if($m=='08'){ echo "selected"; }?>>สิงหาคม</option>
        <option value="09" <? if($m=='09'){ echo "selected"; }?>>กันยายน</option>
        <option value="10" <? if($m=='10'){ echo "selected"; }?>>ตุลาคม</option>
        <option value="11" <? if($m=='11'){ echo "selected"; }?>>พฤศจิกายน</option>
        <option value="12" <? if($m=='12'){ echo "selected"; }?>>ธันวาคม</option>
        </select>
      <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='y_start' class='forntsarabun'>";
				foreach($dates as $i){
 
				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></td>&nbsp;
				
    </tr>
  <tr>
    <td colspan="3" align="center"><input name="submit" type="submit" class="forntsarabun" value="ค้นหา"/>&nbsp;&nbsp;
      <a href="../../nindex.htm" class="forntsarabun">กลับเมนูหลัก</a><!--&nbsp;&nbsp; 
      <a href="xray_menu.php" class="forntsarabun">เมนูรายงาน</a>-->
      </td>
  </tr>
</table>
</form>
<br/>
<hr />
<? 
if($_POST['submit']=="ค้นหา"){

switch($_POST['m_start']){
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
	
   $dateshow=$printmonth." ".$_POST['y_start'];
   
$date1=$_POST['y_start'].'-'.$_POST['m_start'];



 print "<font class='forntsarabun'> ประจำเดือน $dateshow </font><br> ";

$sql="SELECT * FROM  `patdata` WHERE (code =  '42703' OR code =  '42702') and date like '$date1%' Order by date desc";
$result=mysql_query($sql);
$rs=mysql_fetch_array($result);

?>
<br />
<table  border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" class="forntsarabun" style="border-collapse:collapse">
<tr bgcolor=#ffff99 onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
<td>ลำดับ</td>
<td>วันที่</td>
<td>HN</td>
<td>AN</td>
<td>ชื่อ-สกุล</td>
<td>แพทย์</td>
<td>รายละเอียด</td>
<td>ราคา</td>
</tr>

<?
while($dbarr=mysql_fetch_array($result)) {
	
//$ptname=$dbarr['yot'].' '.$dbarr['name'].' '.$dbarr['surname'];
?>
<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
	<td><?=++$n;?></td>
	<td><?=$dbarr['date'];?></td>
	<td><?=$dbarr['hn'];?></td>
	<td><?=$dbarr['an'];?></td>
	<td><?=$dbarr['ptname'];?></td>
	<td><?=$dbarr['doctor'];?></td>
	<td><?=$dbarr['detail'];?></td>
	<td><?=$dbarr['price'];?></td>
  </tr>
  <?
$sumP+=$dbarr['price'];
} 
?>
<tr  onMouseOver="this.style.backgroundColor='#ADDFFF'" onMouseOut="this.style.backgroundColor=''">
  <td colspan="7" align="right">รวมราคา</td>
  <td><?=number_format($sumP,2);?></td>
</tr>

</table>


<?
}
?>
</body>
</html>