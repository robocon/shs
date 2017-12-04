<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายงานการใช้ Antibiotic Smart Use</title>
<style type="text/css">
<!--
.h {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.h1 {
	font-family: "TH SarabunPSK";

}
.f1 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
.f1 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
-->
</style>
</head>

<body>


<?
include("Connections/connect.inc.php"); 

$hn=$_GET['hn'];
$icd10=$_GET['icd10'];
$date=substr($_GET['date'],'0','10');


$sql="SELECT *  FROM opday WHERE hn='$hn' and thidate like'%$date%' ";
$result = mysql_query($sql);
$rows=mysql_num_rows($result);
$dbarr=mysql_fetch_array($result);


$sql2="SELECT  *  FROM drugrx
INNER JOIN druglst ON drugrx.drugcode = druglst.drugcode WHERE  drugrx.hn='$hn' and drugrx.date like '%$date%' ";

$result2 = mysql_query($sql2);
$rows2=mysql_num_rows($result2);

?>
<h1 class="h1">รายงานการใช้ Antibiotic Smart Use โรงพยาบาลค่ายสุรศักดิ์มนตรี </h1>
<table border="1" cellspacing="0" cellpadding="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">

  <tr class="h">
    <td height="35" colspan="5" bgcolor="#00FFFF"><span class="f1">ข้อมูลผู้ป่วย</span></td>
  </tr>
  <tr class="h">
    <td width="163"><span class="f1">HN : 
      <?=$dbarr['hn'];?>
    </span></td>
    <td width="229"><span class="f1">ชื่อ - สกุล : 
      <?=$dbarr['ptname'];?>
    </span></td>
    <td width="191"><span class="f1">สิทธิ :
      <?=$dbarr['ptright'];?>
    </span></td>
    <td width="187"><span class="f1">โรค :
      <?=$dbarr['diag'];?>
    </span></td>
    <td width="308"><span class="f1">แพทย์ :
      <?=$dbarr['doctor'];?>
    </span></td>
  </tr>
</table>
<br />

<table border="1" cellspacing="0" cellpadding="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
  <tr class="h">
    <td  align="center" bgcolor="#CC99FF"><span class="f1">ลำดับ</span></td>
    <td  bgcolor="#CC99FF"><span class="f1">วันที่</span></td>
    <td  bgcolor="#CC99FF">รหัสยา</td>
    <td  bgcolor="#CC99FF"><span class="f1">รายการยา</span></td>
    <td  align="center" bgcolor="#CC99FF" class="f1" ><span class="forntsarabun">ราคากลาง</span></td>
    <td  align="center" bgcolor="#CC99FF" class="f1" ><span class="forntsarabun">ราคาทุน</span></td>
    <td  align="center" bgcolor="#CC99FF" class="f1" ><span class="forntsarabun">ราคาขาย</span></td>
    <td  align="center" bgcolor="#CC99FF" class="f1" ><span class="forntsarabun">จำนวน</span></td>
    <td align="center" bgcolor="#CC99FF" class="f1" ><span class="forntsarabun">มูลค่าทุน</span></td>
    <td align="center" bgcolor="#CC99FF" class="f1" ><span class="forntsarabun">มุลค่าขาย</span></td>
    <td  align="center" bgcolor="#CC99FF" class="f1" ><span class="forntsarabun">ประเภทยา</span></td>

  </tr>
  <? 
  
  if($rows2>0){
  
  while($dbarr2=mysql_fetch_array($result2)){ 
  
  if($dbarr2['asu']=='1'){
	  $count++;
	  $bg="#FF3366";
  	  }else{
	  $count1++;
 	  $bg="#99FFCC";
	  }
  ?>
  <tr class="h" bgcolor="<?=$bg;?>">
    <td align="center"><span class="f1">
      <?=++$no;?>
    </span></td>
    <td><span class="f1">
      <?=$dbarr2[1]?>
    </span></td>
    <td><?=$dbarr2['drugcode'];?></td>
    <td><span class="f1">
      <?=$dbarr2['tradname']?>
    </span></td>
    <td align="center" class="f1"><span class="forntsarabun">
      <?=$dbarr2['edpri'];?>
    </span></td>
    <td class="f1"><span class="forntsarabun">
      <?=$dbarr2['unitpri'];?>
    </span></td>
    <td class="f1"><span class="forntsarabun">
      <?=$dbarr2['salepri'];?>
    </span></td>
    <td class="f1"><span class="forntsarabun">
      <?=$dbarr2['amount'];?>
    </span></td>
    <td class="f1"><span class="forntsarabun">
      <?=$dbarr2['unitpri']*$dbarr2['amount'];?>
    </span></td>
    <td class="f1"><span class="forntsarabun">
      <?=$dbarr2['salepri']*$dbarr2['amount'];?>
    </span></td>
    <td class="f1"><span class="forntsarabun">
      <?=$dbarr2['part'];?>
    </span></td>
  </tr>
  <? 
  
  $unitpri+=$dbarr2['unitpri'];
  $salepri+=$dbarr2['salepri'];
  $amount+=$dbarr2['amount'];
  $sumunitpri+=$dbarr2['unitpri']*$dbarr2['amount'];
  $sumsalepri+=$dbarr2['salepri']*$dbarr2['amount'];
  }
  ?>
  <tr class="h">
    <td height="20" colspan="5" align="right"><span class="f1">รวม</span></td>
    <td><?=number_format($unitpri,2);?></td>
    <td><?=number_format($salepri,2);?></td>
    <td><?=number_format($amount,'',';',',');?></td>
    <td><?=number_format($sumunitpri,2);?></td>
    <td> <?=number_format($sumsalepri,'',';',',');?></td>
    <td>&nbsp;</td>

  </tr>
  <?
 	 }else{
			
			echo "<tr class='h'><td colspan='12' align='center'><font color='red'>ไม่พบรายการ</font></td></tr>";
			
	}
	if($count==0){
		$count="0";
		}
		if($count1==0){
		$count1="0";
		}
		
		$avg1=100*$count/$rows2;
		$avg2=100*$count1/$rows2;
		
		$avg1=number_format($avg1,2);
		$avg2=number_format($avg2,2);
		
		
		
		echo "<h1 class='h1'>สัดส่วนการใช้ยา ASU</h1>";
		echo "<span class='h'>รวมทั้งหมด: ".$rows2."&nbsp;รายการ&nbsp;&nbsp;คิดเป็น&nbsp;100%</span><br/>";
		
		echo "<font style='background-color: #FF3366;' color='#000000'><span class='h'>ใช้ยา ASU : ".$count."&nbsp;รายการ&nbsp;&nbsp;คิดเป็น&nbsp;$avg1%</span></font><br/>";
		echo "<font style='background-color: #99FFCC;' color='#000000'><span class='h'>ไม่ได้ใช้ยา ASU : ".$count1."&nbsp;รายการ&nbsp;&nbsp;คิดเป็น&nbsp;$avg2%</span></font><br/>";
  
  ?>
  
</table>
</body>
</html>