<?
include("connect.php");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font2
{
	font-family:AngsanaUPC;
	font-size:18px;
}
</style>
<body>
<div id="no_print" > 
<a href ="../nindex.htm" > &lt;&lt; เมนู</a>
<form action="" method="post">
<table class="pdxhead" border="1" bordercolor="#FFFF00">
  <tr>
    <td width="412" align="center" bgcolor="#FFFF99"><strong>แบบขอเบิกค่ารถส่งต่อผู้ป่วย</strong></td></tr>
  <tr>
  <td>HN : 
    <input name="hn" type="text" size="10" class="pdxhead"  /> 
  <input type="submit"  value="   ตกลง   " name="okhn" class="pdxhead"/></td>
  </tr>
</table>
</form>
</div>
<?
if(isset($_POST['okhn'])){
	//echo "<br><input type='button' onclick='window.print()' value='                             พิมพ์                               '>";
	echo "<table width='80%' border='1' cellpadding='0' cellspacing='0' style='border-collapse:collapse'><tr><td align='center'>วันที่</td><td align='center'>HN</td><td align='center'>ชื่อ</td><td align='center'>นามสกุล</td><td align='center'>&nbsp;</td><tr>";
	$sql = "select * from refer where hn = '".$_POST['hn']."'";
	$result = mysql_query($sql);
	$sum = mysql_num_rows($result);
	if($sum=="0"){
		echo "<br><span class='pdxhead'>ไม่พบ</span>";
	}else{
		while($arr = mysql_fetch_array($result)){
			echo "<tr><td>".$arr['dateopd']."</td><td>".$arr['hn']."</td><td>".$arr['name']."</td><td>".$arr['sname']."</td><td><a href='report_refer.php?print=".$arr['row_id']."'>พิมพ์ใบส่งตัว</a></td></tr>";
		}
		echo "</table>";
	}
}
elseif(isset($_GET['print'])){
	?>
	<script>
    window.print();
    </script>
	<?
		$sql = "select * from refer where row_id = '".$_GET['print']."'";
		$result = mysql_query($sql);
		$arr = mysql_fetch_array($result);
		
		$sql6= "select sex,concat(yot,' ',name,' ',surname) from opcard where hn = '".$arr['hn']."'";
		$result6 = mysql_query($sql6);
		list($sex,$ptname) = mysql_fetch_array($result6);
?>
<table width="655" border="0" align="center" class="font2">
  <tr>
    <td colspan="3" align="center" style="font-size:24px;"><strong>แบบขอเบิกค่ารถส่งต่อผู้ป่วย</strong></td>
  </tr>
  <tr>
    <td colspan="3" align="center" style="font-size:22px;"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง โทร. 054-839305</strong></td>
  </tr>
  <tr>
    <td colspan="2">ออกให้เมื่อ วันที่ : <?=date("d/m/").(date("Y")+543) ?> เวลา <?=date("H:i")?></td>
    <td width="336">เลขสำคัญส่งต่อผู้ป่วย&nbsp;&nbsp;&nbsp;R<?=$arr['refer_runno']?></td>
  </tr>
  <tr>
    <td colspan="2">ผู้ป่วยชื่อ&nbsp;&nbsp;&nbsp; <?=$ptname?></td>
    <td>เลขประจำตัวประชาชน <?=$arr['idcard']?></td>
  </tr>
  <tr>
    <td width="159">เพศ : 
      <?=$sex == 'ช' ? 'ชาย':'หญิง'?></td>
    <td width="146">อายุ : <?=$arr['age']?></td>
    <td>สิทธิสวัสดิการรักษาพยาบาล</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox" id="checkbox" />
     กรมบัญชีกลาง</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox2" id="checkbox2" />
    อื่นๆ :.....................................</td>
  </tr>
  <tr>
    <td colspan="2" align="center" style="font-size:20px;"><strong>ส่งต่อจาก</strong></td>
    <td align="center" style="font-size:20px;"><strong>รับต่อที่</strong></td>
  </tr>
  <tr>
    <td><strong>ร.พ. ค่ายสุรศักดิ์มนตรี</strong></td>
    <td><strong>รหัส 11512</strong></td>
   <? if($arr['referh']!="อื่นๆ"){?>
    <td><strong>ร.พ. 
      <?=substr($arr['referh'],6)?> &nbsp;&nbsp;&nbsp;รหัส : <?=substr($arr['referh'],0,5)?>
    </strong></td>
    <? }else{?>
    <td>ร.พ. .................. รหัส : ...........</td>
    <? }?>
  </tr>
  <tr>
    <td>วันที่  <?=substr($arr['dateopd'],8,2)."/".substr($arr['dateopd'],5,2)."/".substr($arr['dateopd'],0,4)?></td>
    <td>เวลา  <?=substr($arr['dateopd'],11)?></td>
    <td>วันที่ : ........../........../..........เวลา : ..........:..........</td>
  </tr>
  <tr>
    <td>HN : <?=$arr['hn']?></td>
    <td>AN : <?=$arr['an']?></td>
    <td>HN : ................................. AN : ...............................</td>
  </tr>
  <tr>
    <td colspan="2" align="center">เหตุผลที่ส่งต่อ และ/หรือ เหตุผลทางคลินิคที่สำคัญ</td>
    <td style="font-size:18px;"><strong>การรับไว้</strong></td>
  </tr>
  <tr>
    <td colspan="2" rowspan="3" valign="top">-<?=$arr['exrefer']?></td>
    <td><input type="checkbox" name="checkbox6" id="checkbox6" />
    เป็นผู้ป่วยใน</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox7" id="checkbox7" />
    สังเกตอาการ</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox8" id="checkbox8" />
    รักษาแล้วให้กลับ</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:18px;"><strong>วัตถุประสงค์/เพื่อ</strong></td>
    <td><input type="checkbox" name="checkbox9" id="checkbox9" />
    ส่งไปรักษาต่อที่อื่น</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox3" id="checkbox3" <? if($arr['target_refer']=="1")echo "checked";?> />
    ปรึกษา/วินิจฉัย</td>
    <td>&nbsp;</td>
    <td style="font-size:18px;"><strong>กรณีเสียชีวิต</strong></td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox4" id="checkbox4" <? if($arr['target_refer']=="2")echo "checked";?>/> 
    รักษาแล้วให้ส่งกลับ</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox10" id="checkbox10" />
    ระหว่างการส่งตัว</td>
  </tr>
  <tr>
    <td><input type="checkbox" name="checkbox5" id="checkbox5" <? if($arr['target_refer']=="3")echo "checked";?>/> 
      โอนย้าย</td>
    <td>&nbsp;</td>
    <td><input type="checkbox" name="checkbox11" id="checkbox11" />
    หลังจากรับรักษา</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>เจ้าหน้าที่ ร.พ. ผู้ส่งตัว</strong></td>
    <td align="center"><strong>เจ้าหน้าที่ ร.พ. ผู้รับตัว</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center">ลงชื่อ.............................................................</td>
    <td align="center">ลงชื่อ................................................................</td>
  </tr>
  <tr>
    <td colspan="2" align="center">(....................................................................)</td>
    <td align="center">(........................................................................)</td>
  </tr>
  <tr>
    <td colspan="2" align="center">ตำแหน่ง.................................................................</td>
    <td align="center">ตำแหน่ง........................................................................</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:18px;"><strong>อัตราการเบิก ค่าส่งต่อผู้ป่วย</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">ระยะทางระหว่าง ร.พ. ส่ง/รับ :................................กม.</td>
    <td>ค่าพาหนะที่เรียกเก็บ:.............................................บาท</td>
  </tr>
  <tr>
    <td colspan="2">อัตราเบิกได้ไม่เกิน :..............................................บาท</td>
    <td>เบิกตามสิทธิฯ:......................................................บาท</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
    <td>ส่วนเบิกไม่ได้:......................................................บาท</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:18px;"><strong>ยานพาหนะที่ใช้ส่งต่อผู้ป่วย</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="3">เลขทะเบียน.............................................&nbsp;&nbsp;จังหวัด...........................................</td>
  </tr>
  <tr>
    <td colspan="3">เป็นรถของ 
      <input type="checkbox" name="checkbox12" id="checkbox12" />
      ร.พ.ผู้ส่งตัว
      <input type="checkbox" name="checkbox14" id="checkbox14" />
      ร.พ.ผู้รับตัว
      <input type="checkbox" name="checkbox16" id="checkbox16" />
หน่วยงานอื่น ระบุ...............................................................................</td>
  </tr>
  <tr>
    <td colspan="2" style="font-size:18px;"><strong>หน่วยที่เบิกคือ</strong></td>
    <td style="font-size:18px;"><strong>หมายเหตุ สำหรับ ร.พ.</strong></td>
  </tr>
  <tr>
    <td colspan="2" align="center"><input type="checkbox" name="checkbox13" id="checkbox13" />
ร.พ.ผู้ส่งตัว
  <input type="checkbox" name="checkbox15" id="checkbox15" />
ร.พ.ผู้รับตัว</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center"><strong>ผู้บันทึก/เบิก</strong></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">ลงชื่อ.................................................................</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">(.........................................................................)</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2" align="center">ตำแหน่ง.......................................................................</td>
    <td>&nbsp;</td>
  </tr>
</table>
<?
	}
?>
</body>
</html>