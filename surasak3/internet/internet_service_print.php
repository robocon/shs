<?php
session_start(); 
ob_start();
?>
<style>
.font1{
	font-family:"Angsana New";
	font-size:18pt;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style><br />
<div id="no_print">
(<a  class="font2" target="_top" href="../../nindex.htm">&lt;&lt; เลิกทำ,ไปเมนู</a>) <a href="internet_service.php">ขอรหัสอินเตอร์เน็ต</a>
</div>
<?php


include("../connect.inc");

$date_chk=date("Y-m-d");

$chksql="select * from internet where idcard ='".$_POST['idcard']."' and date_service like '$date_chk%' ";
$chkquery=mysql_query($chksql);
$chkrow=mysql_num_rows($chkquery);
$arr1=mysql_fetch_array($chkquery);
// ดึงข้อมูลเก่าออกมาแสดง
if($chkrow){
	
	echo "<div align='center' id='no_print'><b>คุณได้ขอรหัสไปแล้ว วันนี้ </b></div>";
	
?>
<br />
<br />
<script>
window.print() ;
</script>
<table align="center" cellspacing="2" cellpadding="2">
<tr>
<td align="center" class="font1">ระบบให้บริการอินเตอร์เน็ต</td>
</tr>
<tr>
     <td align="center" class="font1">โรงพยาบาลค่ายสุรศักดิ์มนตรี</td>
</tr>
<tr>
     <td height="17"><hr /></td>
</tr>
<tr>
     <td class="font1">ชื่อผู้ใช้ : <b><?=$arr1['user']?></b></td>
</tr>
<tr>
     <td class="font1">รหัสผ่าน : <b><?=$arr1['pass']?></b></td>
</tr>
<tr>
  <td class="font1">บัตรมีอายุการใช้งาน : <?php if($arr1['type_net']=='1day'){ echo "1 วัน"; }else if($arr1['type_net']=='7day'){ echo "7 วัน"; }?> </td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td class="font1">ชื่อผู้ขอใช้บริการ : <?=$arr1['ptname']?></td>
</tr>
<tr>
<td><div style="font-size:12pt"><u>หมายเหตุ<u><br />
- สามารถขอใช้อินเตอร์เน็ตได้วันละ 1ผู้ใช้งาน</div></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
	
<?php
}else{


$sql="select * from internet where idcard ='' and type_net='".$_POST['type_net']."' limit 1";
$query=mysql_query($sql);
$row=mysql_num_rows($query);
$arr=mysql_fetch_array($query);



if($row){
$date_regis=date("Y-m-d H:i:s");
$update1="UPDATE internet SET idcard='".$_POST['idcard']."' ,
ptname ='".$_POST['ptname']."' ,
phone ='".$_POST['phone']."' ,
officer ='".$sOfficer."', 
menucode='".$_SESSION['smenucode']."',
date_service='".$date_regis."' WHERE  row_id='".$arr['row_id']."'  ";	
$upquery1=mysql_query($update1);


if($upquery1){
?>
<script>
window.print() ;
</script>
<table align="center" cellspacing="2" cellpadding="2">
<tr>
<td align="center" class="font1">ระบบให้บริการอินเตอร์เน็ต</td>
</tr>
<tr>
     <td align="center" class="font1">โรงพยาบาลค่ายสุรศักดิ์มนตรี</td>
</tr>
<tr>
     <td height="17"><hr /></td>
</tr>
<tr>
     <td class="font1">ชื่อผู้ใช้ : <b><?=$arr['user']?></b></td>
</tr>

<tr>
     <td class="font1">รหัสผ่าน  : <b><?=$arr['pass']?></b></td>
</tr>
<tr>
  <td class="font1">บัตรมีอายุการใช้งาน : <? if($arr['type_net']=='1day'){ echo "1 วัน"; }else if($arr['type_net']=='7day'){ echo "7 วัน"; }?> </td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
<tr>
  <td class="font1">ชื่อผู้ขอใช้บริการ : <?=$_POST['ptname'];?></td>
</tr>
<tr>
  <td><div style="font-size:12pt"><u>หมายเหตุ<u><br />
- สามารถขอใช้อินเตอร์เน็ตได้วันละ 1ผู้ใช้งาน</div></td>
</tr>
<tr>
  <td>&nbsp;</td>
</tr>
</table>
<?php
 }else{
	?>
<table align="center" cellpadding="2" cellspacing="2" class="font1">
<tr>
<td align="center">ไม่สามารถออกรหัสได้ </td>
</tr>
</table>
<?php
 }
}else{
	echo "-----------------------รหัสหมดแล้วติดต่อ โทร 6203 ---------------------------";	
}

}
?>
</body>