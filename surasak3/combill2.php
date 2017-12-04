<?
if(isset($_POST['okbtn'])){
	header("Content-type: application/vnd.ms-excel");
	header("Content-Disposition: attachment; filename=testing.xls");
}
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
.font1
{
	font-family:AngsanaUPC;
	font-size:18px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<body>
<div id="no_print" >
<a href ="../nindex.htm" >&lt;&lt; ไปเมนู</a><br /><br />

<form name="form3" action="<? $_SERVER['PHP_SELF']?>" method="post">
ข้อมูลการสั่งซื้อยา
  <br />
<br />ตั้งแต่เดือน 
<? $month = array('เดือน','มกราคม','กุมภาพันธ์','มีนาคม','เมษายน','พฤษภาคม','มิถุนายน','กรกฎาคม','สิงหาคม','กันยายน','ตุลาคม','พฤศจิกายน','ธันวาคม'); ?>
  <select name="month1">
  <? for($i=0;$i<=12;$i++){?>
  <option value="<? if($i<10){ echo "0";}?><?=$i?>"><?=$month[$i]?></option>
  <? }?>
  </select>
ปี <select name="year1">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select> <br /><br />
ถึงเดือน
  <select name="month2">
  <? for($i=0;$i<=12;$i++){?>
  <option value="<? if($i<10){ echo "0";}?><?=$i?>"><?=$month[$i]?></option>
  <? }?>
  </select>
ปี <select name="year2">
<?php for($i=date("Y")+540;$i<date("Y")+545;$i++){?>
<option value="<?php echo $i;?>" <?php if($i == date("Y")+543) echo "Selected"; ?> ><?php echo $i;?></option>
<?php }?>
</select>
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" name="okbtn" value="ตกลง"  />
</form>
</div>
<?
if(isset($_POST['okbtn'])){
?>
<center class="font1">
บัญชีราคายาที่ โรงพยาบาลค่ายสุรศักดิ์มนตรี จัดซื้อ เดือน<?=$month[$_POST['month1']+0]?> ปี <?=$_POST['year1']?> - เดือน<?=$month[$_POST['month2']+0]?> ปี <?=$_POST['year2']?></center>
<table width="100%" border="1" class="font1" cellpadding="0" cellspacing="0" style="border-collapse:collapse">
  <tr>
    <td align="center">ลำดับ</td>
    <td align="center">รหัสยา</td>
    <td align="center">ชื่อสามัญ</td>
    <td align="center">ชื่อการค้า</td>
    <td align="center">หน่วยนับ</td>
    <td align="center">ขนาดบรรจุ</td>
    <td align="center">ราคาต่อหน่วยนับ<br />(บาท)</td>
    <td align="center">หมายเหตุ<br />(ผู้จำหน่าย)</td>
  </tr>
<?php
    include("connect.inc");
/*	$sql ="select distinct(drugcode) from combill where date between '2011-01-01 00:00:00' and '2012-03-31 23:59:59'";
	$result = mysql_query($sql);
	while(list($drugcode) = mysql_fetch_array($result)){*/
		$sql3 ="select * from combill where billdate between '".($_POST['year1']-543)."-".$_POST['month1']."-01' and '".($_POST['year2']-543)."-".$_POST['month2']."-31'";
		
		$i=0;
		$result3 = mysql_query($sql3);
	  		while($arr = mysql_fetch_array($result3)){
		  	//$i++;
  ?>
  <tr>
    <td align="center"><?=++$i?></td>
    <td><?=$arr['drugcode']?></td>
    <td><?=$arr['tradname']?></td>
    <td><?=$arr['genname']?></td>
    <td><?=$arr['unit']?></td>
    <td><?=$arr['packing']?></td>
    <td><?=$arr['packpri']?></td>
    <td><?=$arr['comcode']." ".$arr['comname'];?></td>
  </tr>
  <?
	}
$sql7 ="select stock,mainstk,totalstk from druglst where drugcode = '$drugcode' ";
$result7 = mysql_query($sql7);
list($stock,$mainstk,$totalstk) = mysql_fetch_array($result7);
  ?>
 <!-- <tr>
    <td colspan="7" align="right">จำนวนเหลือในคลัง (<?=date("d/m/").(date("Y")+543)?>)</td>
    <td align="center"><?=number_format($mainstk)?></td>
  </tr>
  <tr>
    <td colspan="7" align="right">จำนวนเหลือในห้องจ่าย (<?=date("d/m/").(date("Y")+543)?>) </td>
    <td align="center"><?=number_format($stock)?></td>
  </tr>
  <tr>
    <td colspan="7" align="right">จำนวนคงเหลือทั้งหมด (<?=date("d/m/").(date("Y")+543)?>)</td>
    <td align="center"><?=number_format($totalstk)?></td>
  </tr>-->
</table>
<table width="100%"><tr>
  <td align="right">
<span class="font1" style="text-align:right"><br />
ลงชื่อ.......................................................ผู้ให้ข้อมูล<br />
ตำแหน่ง...................................................................<br />
ลงชื่อ............................................ผู้ตรวจสอบข้อมูล<br />
ตำแหน่ง ผอ.รพ.ค่ายสุรศักดิ์มนตรี&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
</span>
</td></tr></table>
<? }?>
</body>
</html>