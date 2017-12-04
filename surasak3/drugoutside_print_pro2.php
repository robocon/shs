<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>แบบสั่งซื้อยาและทำหัตถการ นอกโรงพยาบาล</title>
</head>
<style type="text/css">
.font1 {
	font-family: "TH Niramit AS";
	font-size:20px;
}
.font2 {
	font-family: "TH Niramit AS";
	font-size:22px;
}
</style>
<body onload="window.print() ;">

<? 
 include("connect.inc");
 
 
$month['01'] = "มกราคม";
$month['02'] = "กุมภาพันธ์";
$month['03'] = "มีนาคม";
$month['04'] = "เมษายน";
$month['05'] = "พฤษภาคม";
$month['06'] = "มิถุนายน";
$month['07'] = "กรกฎาคม";
$month['08'] = "สิงหาคม";
$month['09'] = "กันยายน";
$month['10'] = "ตุลาคม";
$month['11'] = "พฤศจิกายน";
$month['12'] = "ธันวาคม";	

$sql="select * from  drugoutside as b WHERE  b.row_id='".$_GET['id']."' ";
$result = mysql_query($sql);
$arr=mysql_fetch_array($result);

$showdate=substr($arr['regisdate'],0,10);

$showdate1=explode("-",$showdate);
?>
<br />
<div align="right" class="font1" style="width:80%;">เลขที่   <?=$arr['runno'];?>

</div>
<h1 class="font2" align="center" style="height:20PX;">แบบสั่งซื้อยาและเวชภัณฑ์ นอกโรงพยาบาล</h1>
<h1 class="font2" align="center" style="height:20PX;">โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง</h1>
<!--<h1 class="font2" align="center">โปรดทำเครื่องหมาย / ลงในช่อง ( ) พร้อมทั้งกรอกข้อความ</h1>-->
<hr width="60%" />
<table border="0" align="center"  class="font1">
 <? if($arr['hn']!=''){?>
  <tr>
    <td align="center">วันที่ </td>
    <td class="font1"><?=$arr['dateadd'];?>&nbsp;&nbsp; </td>
    <td class="font1">ผู้ป่วยนอก</td>
    <td colspan="3">ชื่อ-สกุล 
    <b><?=$arr['ptname'];?></b>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HN  :
<b><?=$arr['hn'];?></b></td>

</tr>
<? }else{ 

	$sql1="select * from  ipcard where an='".$arr['an']."' ";
	$query1=mysql_query($sql1) or die (mysql_error());	
	$arr1=mysql_fetch_array($query1);
?>
 <tr>
    <td align="center">วันที่</td>
    <td class="font1"><?=$arr['dateadd'];?> &nbsp;&nbsp;</td>
    <td class="font1">ผู้ป่วยใน</td>
    <td colspan="3">ชื่อ-สกุล 
    <b><?=$arr['ptname'];?></b>
     &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AN  :
<b><?=$arr['an'];?></b>&nbsp;&nbsp;หอผู้ป่วย :<?=$arr1['my_ward'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

</tr>
<? } ?>

  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="3" class="font1">ซึ่งป่วยเป็นโรค .......
      <?=$arr['diag'];?>
......</td>
    </tr>
  <tr>
    <td colspan="6" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" class="font1">ระบุ รายการ/จำนวน/วิธีใช้ยา</td>
  </tr>
  <? 
$sql2="select * from  drugoutside_list as b WHERE  b.ref_id='".$arr['row_id']."' ";
$result2 = mysql_query($sql2);
$i=1;
while($arr2=mysql_fetch_array($result2)){

?>
  <tr>
    <td colspan="4" align="right" class="font1">(&nbsp;<?=$i;?>&nbsp;)</td>
    <td colspan="2" class="font1">&nbsp;&nbsp;
<?=$arr2['list_detail']?></td>
  </tr>
  <? 
  $i++;
  } ?>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">ยาและเวชภัณฑ์ตามรายการนี้โรงพยาบาลไม่มีจำหน่าย</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">กรุณาซื้อจากโรงพยาบาลอื่นหรือร้านขายยาแผนปัจจุบัน</td>
  </tr>
  <tr>
    <td height="39" colspan="6" align="center" valign="bottom" class="font1">เภสัชกร .........................................</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">( <span class="font11">
      <?=$arr['name2'];?>
    )</span></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">ผู้ป่วยเบิกได้ กรุณานำใบเสร็จรับเงินที่ระบุซื้อยาและใบสั่งยา</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">ติดต่อห้องทะเบียนและแพทย์ผู้สั่งยา ทำใบรับรองเบิก</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  
  <? 
  $sql = "Select doctorcode From doctor where name like '%".$arr['name']."%' ";
  $result = mysql_query($sql);
  list($doctorcode) = mysql_fetch_row($result);
  
  ?>
  <tr>
    <td height="45" colspan="6" align="center" class="font1">แพทย์ .............................ว.&nbsp;<?=$doctorcode;?></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">( <?=substr($arr['name'],5);?> )</td>
  </tr>
  </table>

</body>
</html>