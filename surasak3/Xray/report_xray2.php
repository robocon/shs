<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style type="text/css">
<!--
.forntsarabun {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.forntsarabun2 {
	font-family: "TH SarabunPSK";
	font-size: 18px;
}
</style>
<body>
<h1 class="forntsarabun">ทะเบียนผู้ป่วย</h1>
<h1 class="forntsarabun2">แผนกรังสีกรรม เอกสารหมายเลข FR - XRA - 001/4 แก้ไขครั้งที่ ......................วันที่มีผลบังคับใช้ 9 มีนาคม 2543</h1></br>
<?
include("connect.inc.php"); 


$sql="select * from opcard inner join  xray_stat  on opcard.hn=xray_stat.hn";
$result = mysql_query($sql);
$rows=mysql_num_rows($result);
?>
<table border="1" cellspacing="0" cellpadding="0" bordercolorlight="#FFFFFF" bordercolordark="#000000">
  <tr>
    <td rowspan="2" align="center">วันเดือนปี</td>
    <td rowspan="2" align="center">HN</td>
    <td colspan="2" align="center">XN</td>
    <td rowspan="2" align="center">ชื่อ - สกุล</td>
    <td rowspan="2" align="center">อายุ</td>
    <td rowspan="2" align="center">สังกัด</td>
    <td rowspan="2" align="center">ผู้ป่วยส่งจาก</td>
    <td rowspan="2" align="center">ตรวจ</td>
    <td rowspan="2" align="center">แพทย์ผู้สั่ง</td>
    <td colspan="4" align="center">จำนวนฟิล์ม</td>
    <td rowspan="2" align="center">หมายเหตุ</td>
  </tr>
  <tr>
    <td align="center">เก่า</td>
    <td align="center">ใหม่</td>
    <td align="center">digital</td>
    <td align="center">10 * 12 </td>
    <td align="center">14 * 14 </td>
    <td align="center">NONE</td>
  </tr>
  <?  while($dbarr=mysql_fetch_array($result)){ ?>
  <tr>
    <td><?=$dbarr['date'];?></td>
    <td><?=$dbarr['hn'];?></td>
    <td><?=$dbarr['xn'];?></td>
    <td><?=$dbarr['xn_new'];?></td>
    <td><?=$dbarr['ptname'];?></td>
    <td><?=$dbarr['age']?></td>
     <td><?=$dbarr['goup'];?></td>
    <td><?=$dbarr['patient_from'];?></td>
    <td><?=$dbarr['detail'];?></td>
    <td><?=$dbarr['doctor'];?></td>
    <td><?=$dbarr['digital'];?></td>
    <td><?=$dbarr['10_12'];?></td>
    <td><?=$dbarr['14_14'];?></td>
    <td><?=$dbarr['NONE'];?></td>
    <td><?=?></td>
    
  </tr>
  <? } ?>
</table>

</body>
</html>