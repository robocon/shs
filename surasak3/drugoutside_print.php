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

if($arr['typedoc']=='N'){
$typedoc="โรงพยาบาลไม่มีจำหน่าย";
}else{
$typedoc="โรงพยาบาลมีจำหน่ายแต่เนื่องจากขาดคราว";
}
?>
<br />
<div align="right" class="font1" style="width:80%;">เลขที่   <?=$arr['runno'];?>

</div>
<h1 class="font2" align="center" style="height:20PX;">ใบรับรองรายการยาและอวัยวะเทียมที่ไม่มีจำหน่ายในสถานพยาบาล</h1>
<!--<h1 class="font2" align="center" style="height:20PX;">โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง</h1>-->
<!--<h1 class="font2" align="center">โปรดทำเครื่องหมาย / ลงในช่อง ( ) พร้อมทั้งกรอกข้อความ</h1>-->
<hr width="60%" />
<table border="0" align="center"  class="font1">
  <tr>
    <td colspan="4">ข้าพเจ้า
      <?=$arr['yot'];?>
    &nbsp;<?=substr($arr['doctor'],6);?>  </td>
    <td>[
      <? if($arr['type']=='นายแพทย์ผู้รักษา'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>
]
      นายแพทย์ผู้รักษา   [
<? if($arr['type']=='หัวหน้าสถานพยาบาล'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>
]
    หัวหน้าสถานพยาบาล</td>
  </tr>
  <tr>
    <td colspan="5">แห่งโรงพยาบาล...............โรงพยาบาลค่ายสุรศักดิ์มนตรี.............. จังหวัด.............ลำปาง &nbsp;&nbsp;&nbsp;&nbsp;ขอรับรองว่า</td>
  </tr>
  <tr>
    <td colspan="5" class="font1"><input type="hidden" name="ptname" value="<?=$arr['yot'].$arr['name'].' '.$arr['surname'];?>" /><?=$arr['ptname'];?>&nbsp;&nbsp;&nbsp;&nbsp;HN  : <?=$arr['hn'];?><input type="hidden" name="hn" value="<?=$arr['hn'];?>" /> 
      &nbsp;&nbsp;สิทธิ :
<?=$arr['ptright'];?>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ซึ่งป่วยเป็นโรค .......
    <?=$arr['diag'];?> .......</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="font1">[ <? if($arr['action']=='A'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?> ]
      ก.จำเป็นต้องใช้</td>
    <td colspan="2">[ <? if($arr['action_detail']=='ยา'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?> ] ยา </td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='เลือดและส่วนประกอบของเลือดหรือสารทดแทน'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]  เลือดและส่วนประกอบของเลือดหรือสารทดแทน </td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='อ๊อกซิเจน'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ] อ๊อกซิเจน</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='อวัยวะเทียม'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?> ] อวัยวะเทียม</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='อุปกรณ์ในการบำบัดรักษาโรค'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]
      อุปกรณ์ในการบำบัดรักษาโรค</td>
  </tr>
  <tr>
    <td colspan="5" align="center" class="font1">ตามรายการข้างล่างนี้ ซึ่ง ไม่มีจำหน่ายในโรงพยาบาลหรือสถานพยาบาลแห่งนี้</td>
  </tr>
  <tr>
    <td colspan="5" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3" class="font1">[  <? if($arr['action']=='B'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]  ข.จำเป็นต้องเข้ารับการตรวจ</td>
    <td colspan="2">[ <? if($arr['action_detail']=='ทางห้องทดลอง'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]
      ทางห้องทดลอง</td>
  </tr>
  <tr>
    <td colspan="3" align="center" class="font1">&nbsp;</td>
    <td colspan="2">[ <? if($arr['action_detail']=='เอ๊กซเรย์'){ echo '<img src="check_icon.gif" width="20" height="20" />'; } ?>  ]
      เอ๊กซเรย์
</td>
  </tr>
  <tr>
    <td colspan="5" align="center" class="font1">ตามรายการข้างล่างนี้ ซึ่งไม่มีจำหน่ายในโรงพยาบาลหรือสถานพยาบาลแห่งนี้ไม่สามารถให้บริการได้</td>
  </tr>
  <tr>
    <td colspan="5" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="5" class="font1">ระบุ รายการ</td>
  </tr>
  <? 
$sql2="select * from  drugoutside_list as b WHERE  b.ref_id='".$arr['row_id']."' ";
$result2 = mysql_query($sql2);
$i=1;
while($arr2=mysql_fetch_array($result2)){

?>
  <tr>
    <td colspan="3" align="right" class="font1">(&nbsp;<?=$i;?>&nbsp;)</td>
    <td colspan="2" class="font1">&nbsp;&nbsp;
<?=$arr2['list_detail']?></td>
  </tr>
  <? 
  $i++;
  } ?>
  <tr>
    <td colspan="5" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1"><?=$arr['yot'];?>&nbsp;&nbsp;&nbsp;&nbsp;<span class="font11">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</span>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
  </tr>
     <?  $sql = "Select doctorcode,position From doctor where name like '%".$arr['doctor']."%' ";
  $result = mysql_query($sql)  or die (mysql_error());
  list($doctorcode,$position) = mysql_fetch_row($result); ?>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center">&nbsp;(
    <?=substr($arr['doctor'],5);?>&nbsp;)</td>
  </tr>
 
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center">ตำแหน่ง
      <?=$position;?>&nbsp;&nbsp;&nbsp;ว.
      <?=$doctorcode;?>&nbsp;&nbsp;&nbsp;</td>
  </tr>
  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center" class="font1">&nbsp;</td>
    <td align="center">วันที่..<?=$showdate1[2];?>..เดือน...<?=$month[$showdate1[1]];?>...พ.ศ...<?=$showdate1[0];?>&nbsp;</td>
  </tr>
</table>
  
  <div style="page-break-before:always;"></div>
  
  <br />
<div align="right" class="font1" style="width:80%;">เลขที่   <?=$arr['runno'];?>

</div>
<h1 class="font2" align="center" style="height:20PX;">แบบสั่งซื้อยา/เวชภัณฑ์ นอกโรงพยาบาล</h1>
<h1 class="font2" align="center" style="height:20PX;">โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง</h1>
<!--<h1 class="font2" align="center">โปรดทำเครื่องหมาย / ลงในช่อง ( ) พร้อมทั้งกรอกข้อความ</h1>-->
<hr width="60%" />
<table border="0" align="center"  class="font1">
 <? if($arr['typeopd']=='ผู้ป่วยนอก'){?>
  <tr>
    <td colspan="3" align="center">วันที่
    <?=$showdate;?>&nbsp;&nbsp; ผู้ป่วยนอก</td>
    <td colspan="3" align="left"> &nbsp;ชื่อ-สกุล 
      <b><?=$arr['ptname'];?></b>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;HN  :
  <b><?=$arr['hn'];?></b></td>

</tr>
<? }elseif($arr['typeopd']=='ผู้ป่วยใน'){

	$sql1="select * from  ipcard where an='".$arr['an']."' limit 1";
	$query1=mysql_query($sql1) or die (mysql_error());	
	$arr1=mysql_fetch_array($query1);
?>
 <tr>
    <td colspan="3" align="center">วันที่ 
    <?=$showdate;?> &nbsp;&nbsp;ผู้ป่วยใน</td>
    <td colspan="3">ชื่อ-สกุล 
      <b><?=$arr['ptname'];?></b>
      &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;AN  :
  <b><?=$arr['an'];?></b>&nbsp;&nbsp;หอผู้ป่วย :<?=$arr1['my_ward'];?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>

</tr>
<? } ?>

  <tr>
    <td align="center" class="font1">&nbsp;</td>
    <td colspan="2" align="center" class="font1"><span class="font11">สิทธิ :
        <?=$arr['ptright'];?>
    </span></td>
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
    <td align="right" class="font1">&nbsp;</td>
    <td align="right" class="font1"><span class="font11">(&nbsp;
        <?=$i;?>
&nbsp;)</span></td>
    <td colspan="4" class="font1">&nbsp;&nbsp;
    <?=$arr2['list_detail']?></td>
  </tr>
  <? 
  $i++;
  } ?>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">ยา/เวชภัณฑ์ตามรายการนี้ <?=$typedoc;?></td>
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
    <td colspan="6" align="center" class="font1">ผู้ป่วยที่เบิกได้ กรุณานำใบเสร็จรับเงินที่ระบุชื่อยาและใบสั่งยา</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">ติดต่อห้องทะเบียนและแพทย์ผู้สั่งยา ทำใบรับรองเบิก</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
  
  <? 
  $sql = "Select doctorcode ,position From doctor where name like '%".$arr['doctor']."%' ";
  $result = mysql_query($sql);
  list($doctorcode,$position ) = mysql_fetch_row($result);
  
  ?>
  <tr>
    <td colspan="6" align="center" class="font1"><?=$arr['yot'];?>
    .............................</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">(  
      <?=substr($arr['doctor'],5);?> )</td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">ตำแหน่ง
      <?=$position;?>
      &nbsp;&nbsp;&nbsp;ว.
    <?=$doctorcode;?></td>
  </tr>
  <tr>
    <td colspan="6" align="center" class="font1">&nbsp;</td>
  </tr>
</table>

</body>
</html>