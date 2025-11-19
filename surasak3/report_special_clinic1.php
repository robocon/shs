<?
session_start();
include("connect.inc");
$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];
$doctor=$_POST["doctor"];
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style>
<div align="center" style="margin-top: 20px;"><strong>รายงานการคิดค่าคลินิกพิเศษและค่าคลินิกนอกเวลาราชการ</strong></div>
<div align="center"><strong>แพทย์ : <?=$doctor;?></strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="90%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center" bgcolor="#00CC99"><strong>ลำดับ</strong></td>
    <td width="14%" align="center" bgcolor="#00CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="8%" align="center" bgcolor="#00CC99"><strong>HN</strong></td>
    <td width="18%" align="center" bgcolor="#00CC99"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="16%" align="center" bgcolor="#00CC99"><strong>สิทธิการรักษา</strong></td>
    <td width="16%" align="center" bgcolor="#00CC99"><strong>ลูกหนี้</strong></td>
    <td width="27%" align="center" bgcolor="#00CC99"><strong>รายการ</strong></td>
    <td width="14%" align="center" bgcolor="#00CC99"><strong>จำนวนเงิน</strong></td>
  </tr>
<?
$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"];
//$sql="select * from depart where (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') and doctor like '$doctor%' and depart ='OTHER' and cashok='เงินสด' and price='200' order by date";
$sql="select * from depart where (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') and doctor like '$doctor%' and depart ='OTHER' and price='200' and (cashok ='เงินสด' || cashok ='ทหารไทย' || cashok ='เงินโอน') order by date";

//echo $sql;
$query=mysql_query($sql);
$i=0;
$total=0;
while($rows=mysql_fetch_array($query)){
$i++;
$date=substr($rows["date"],0,10);
list($y,$m,$d)=explode("-",$date);
$time=substr($rows["date"],11,8);
$datetime="$d/$m/$y $time";

?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$datetime;?></td>
    <td align="center"><a href="reportcash1.php?hn=<?=$rows["hn"];?>&date=<?=$date;?>" target="_blank"><?=$rows["hn"]?></a></td>
    <td><?=$rows["ptname"]?></td>
    <td><?=$rows["ptright"]?></td>
    <td><?=$rows["cashok"]?></td>
    <td><?=$rows["detail"]?></td>
    <td align="right"><?=$rows["price"]?></td>
  </tr>
  <?
  $total=$total+$rows["price"];
  }
  
  ?>
  <tr>
    <td colspan="7" align="right"><strong>รวมทั้งสิ้น</strong></td>
    <td align="right"><strong><?=number_format($total,2);?><strong></td>
  </tr>  
</table>
<p><hr></p>
<div align="center" style="margin-top: 20px;"><strong>รายงานการคิดค่าคลินิกนอกเวลาราชการ</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="90%" border="1" align="center" cellpadding="4" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="3%" align="center" bgcolor="#FF9999"><strong>ลำดับ</strong></td>
    <td width="14%" align="center" bgcolor="#FF9999"><strong>วัน/เดือน/ปี</strong></td>
    <td width="9%" align="center" bgcolor="#FF9999"><strong>HN</strong></td>
    <td width="17%" align="center" bgcolor="#FF9999"><strong>ชื่อ-นามสกุล</strong></td>
    <td width="16%" align="center" bgcolor="#FF9999"><strong>สิทธิการรักษา</strong></td>
    <td width="16%" align="center" bgcolor="#FF9999"><strong>ลูกหนี้</strong></td>
    <td width="27%" align="center" bgcolor="#FF9999"><strong>รายการ</strong></td>
    <td width="14%" align="center" bgcolor="#FF9999"><strong>จำนวนเงิน</strong></td>
  </tr>
<?
$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"];
//$sql="select * from depart where (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') and detail ='ค่าบริการทางการแพทย์ นอกเวลาราชการ (เบิกไม่ได้)' and depart ='OTHER' and cashok='เงินสด' order by date";
$sql="select * from depart where (date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59') and detail ='ค่าบริการทางการแพทย์ นอกเวลาราชการ (เบิกไม่ได้)' and depart ='OTHER' and (cashok ='เงินสด' || cashok ='ทหารไทย' || cashok ='เงินโอน') order by date";
//echo $sql;
$query=mysql_query($sql);
$i=0;
while($rows=mysql_fetch_array($query)){
$i++;
$date=substr($rows["date"],0,10);
list($y,$m,$d)=explode("-",$date);
$time=substr($rows["date"],11,8);
$datetime="$d/$m/$y $time";
?>
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$datetime;?></td>
    <td align="center"><?=$rows["hn"]?></td>
    <td><?=$rows["ptname"]?></td>
    <td><?=$rows["ptright"]?></td>
    <td><?=$rows["cashok"]?></td>
    <td><?=$rows["detail"]?></td>
    <td align="right"><?=$rows["price"]?></td>
  </tr>
  <?
  }
  ?>
</table>
