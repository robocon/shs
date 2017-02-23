<?php
session_start();
include("connect.inc");

if( empty($_SESSION["statusncr"]) ){
	echo "Session หมดอายุ กรุณาล็อคอินอีกครั้งเพื่อเข้าใช้งาน";
	exit;
}

// Set time to print only admin
if($_SESSION["statusncr"]=='admin' && $_SESSION['Userncr'] == 'admin' ){
	$print_by = $_SESSION['Namencr'];
	$sql = "UPDATE `ncr2556` 
	SET `date_print` = NOW(), 
	`print_by` = '$print_by'
	WHERE `nonconf_id` = '".$_GET['ncr_id']."';";
	$query = mysql_query($sql) or die( mysql_error($Conn) );
}

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>Untitled Document</title>
</head>

<style>
.fonth1{
	font-family:"TH SarabunPSK";
	font-size:18px;
}
.fonth3{
	font-family:"TH SarabunPSK";
	font-size:16px;
}
.fonttable{
	font-family:"TH SarabunPSK";
	font-size:14px;
}
.line{
	text-indent:10px;
}
checkbox-style:disabled { }
	
</style>
<body onload="window.print();">
<?


$sql="SELECT * FROM `ncr2556` WHERE nonconf_id='".$_GET['ncr_id']."' ";
$query=mysql_query($sql);
$arr_show=mysql_fetch_array($query);

	$sql2="SELECT * FROM `departments` WHERE  code ='".$arr_show['until']."' ";
	$query2=mysql_query($sql2);
	$arr_until=mysql_fetch_array($query2);
	
	$sql3="SELECT * FROM `departments` WHERE  code  ='".$arr_show['come_from_detail']."' ";
	$query3=mysql_query($sql3);
	$arr_detail=mysql_fetch_array($query3);
	
	function displaydate($datex) {
	$date_array=explode("-",$datex);
	$y=$date_array[0];
	$m=$date_array[1];
	$d=$date_array[2];
	$displaydate="$d-$m-$y";
	return $displaydate;
}
?>
<div align="center">
<h1 class="fonth1">ใบรายงานเหตุการณ์สำคัญ / อุบัติการณ์ / ความไม่สอดคล้อง ( Non-Conforming Report)</h1>
<h3 class="fonth3">ศูนย์พัฒนาคุณภาพ  เอกสารหมายเลข FR-QMR-009/1 ,06, 3 ม.ค.56</h3>
</div>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="fonttable" style="border-collapse:collapse;">
  <tr>
	<td width="33%" valign="top">เลขที่ NCR : 
	  <?=$arr_show['ncr']?>
	  <br />
	หน่วยงาน /ทีม

	  <?=$arr_until['name']?><br />
	วันที่  : <?=displaydate($arr_show['nonconf_date']);?> เวลา <?=$arr_show['nonconf_time']?>
	</td>
	<td colspan="2" valign="top"><table border="0">
	  <tr>
		<td width="33">ที่มา</td>
		<td width="105"><input type="checkbox"  name="come_from_id" id="come_from_id"  <?php if($arr_show["come_from_id"] == "1") echo " Checked ";?> disabled/>ENV ROUND</td>
		<td width="275"><input type="checkbox" id="checkbox-1-6" <?php if($arr_show["come_from_id"] == "4") echo " Checked ";?> disabled/>
		  12 กิจกรรมทบทวน</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input type="checkbox" id="checkbox-1-2" <?php if($arr_show["come_from_id"] == "2") echo " Checked ";?> disabled/>
		  IC ROUND</td>
		<td><input type="checkbox" id="checkbox-1-5" <?php if($arr_show["come_from_id"] == "5") echo " Checked ";?> disabled/>
		  หน่วยรายงานเอง</td>
	  </tr>
	  <tr>
		<td>&nbsp;</td>
		<td><input type="checkbox" id="checkbox-1-3" <?php if($arr_show["come_from_id"] == "3") echo " Checked ";?> disabled/>
		  RM ROUND</td>
		<td><input type="checkbox" id="checkbox-1-4" <?php if($arr_show["come_from_id"] == "6") echo " Checked ";?> disabled/>  
		  &nbsp;อื่นๆ  <?=$arr_detail["name"]?></td>
	  </tr>
	</table></td>
  </tr>
  <tr>
	<td colspan="3">เหตุการณ์ (ให้ทำเครื่องหมายถูกในช่องสี่เหลี่ยมทุกข้อที่เกิดขึ้นเพื่ออธิบายเหตุการณ์ที่เกิดขึ้น )</td>
  </tr>
  <tr>
	<td colspan="2"><table width="100%" border="0">
	  <tr>
		<td width="50%"><strong><u>**Sentinel Event**</u></strong></td>
		<td width="50%">&nbsp;</td>
		</tr>
	  <tr>
		<td width="50%" valign="top"><div><input type="checkbox"  name="event1" id="event1"  <?php if($arr_show["event"] == "1") echo " Checked ";?> disabled/>
		  1. ผู้ป่วยเสียชีวิตจากการฆ่าตัวตาย
		 </div>
		 <div>  <input type="checkbox"  name="event2" id="event2"  <?php if($arr_show["event"] == "2") echo " Checked ";?> disabled/>
		  2.การเสียชีวิตจากการให้เลือดผิดหมู่ ผิดคน</div>
		  <div><input type="checkbox"  name="event3" id="event3"  <?php if($arr_show["event"] == "3") echo " Checked ";?> disabled/>
		  3.ผู้ป่วยเสียชีวิตซึ่งไม่เกี่ยวกับการดำเนินของโรคหรือการเจ็บป่วยในขณะนั้น </div>
		  <div>
		  <input type="checkbox"  name="event4" id="event4"  <?php if($arr_show["event"] == "4") echo " Checked ";?> disabled/>
		  4.การผ่าตัดผิดตำแหน่ง/ผิดประเภท/ผ่าตัดผิดคน </div>
		  <div>
		  <input type="checkbox"  name="event5" id="event5"  <?php if($arr_show["event"] == "5") echo " Checked ";?> disabled/>
		  5.ผู้ป่วยสูญเสียหน้าที่การทำงานของร่างกายหรือมีทุพลภาพอย่างถาวรโดยไม่เกี่ยวข้องกับการดำเนินของโรคหรือการเจ็บป่วยในขณะนั้น </div></td>
		<td width="50%" valign="top" class="line1"><div>
		  <input type="checkbox"  name="event6" id="event6"  <?php if($arr_show["event"] == "6") echo " Checked ";?> disabled/>
		  6.ผู้ป่วยได้รับผลกระทบหรือความเสียหายอาจถึงพิการหรือเสียชีวิต อันเป็นเหตุความบกพร่องของอุปกรณ์/เครื่องมือทางการแพทย์ รวมถึงจากบุคลากรทางการแพทย์/กระบวนการรักษาในโรงพยาบาล 
		 </div>
		  <div><input type="checkbox"  name="event7" id="event7"  <?php if($arr_show["event"] == "7") echo " Checked ";?> disabled/>
		  7.การมีสิ่งของ/อุปกรณ์ตกค้างอยู่ในร่างกายผู้ป่วย<br />
		  </div>
		  <div><input type="checkbox"  name="event8" id="event8"  <?php if($arr_show["event"] == "8") echo " Checked ";?> disabled/>
		  8.การทำร้ายร่างกาย/ข่มขืนหรือล่วงเกินทางเพศ/ฆาตกรรมในโรงพยาบาล<br />
		  </div>
		  <div><input type="checkbox"  name="event9" id="event9"  <?php if($arr_show["event"] == "9") echo " Checked ";?> disabled/>
		  9.การลักพาตัวทารก/การส่งมอบทารกผิดครอบครัว</div></td>
	  </tr>
	</table></td>
	<td width="32%" align="center"><strong>รายงานด่วนภายใน 6 ชั่วโมง<br />
ผอ.รพค่ายฯ, ทีมจัดการความเสี่ยง</strong></td>
  </tr>
  <tr>
	<td valign="top" width="33%"><p><b>1. ความปลอดภัย / ตก/ หกล้ม</b><br />
	  <input type="checkbox" name="topic1_1" value="1" <?php if($arr_show["topic1_1"] == "1") echo " Checked ";?> disabled />
	  1. ล้ม<br />
  <input type="checkbox" name="topic1_2" value="1" <?php if($arr_show["topic1_2"] == "1") echo " Checked ";?> disabled />
	  2. พบว่านอนอยู่บนพื้น<br />
  <input type="checkbox" name="topic1_3" value="1" <?php if($arr_show["topic1_3"] == "1") echo " Checked ";?> disabled />
	  3. ตกจากเตียง/เก้าอื้/โต๊ะ<br />
  <input type="checkbox" name="topic1_4" value="1" <?php if($arr_show["topic1_4"] == "1") echo " Checked ";?> disabled />
	  4. เครื่องรัดตรึงหลุด<br />
  <input type="checkbox" name="topic1_5" value="1" <?php if($arr_show["topic1_5"] == "1") echo " Checked ";?> disabled />
	  5. ปีนข้ามไม้กั้นเตียง<br />
  <input type="checkbox" name="topic1_6" value="1" <?php if($arr_show["topic1_6"] == "1") echo " Checked ";?> disabled/>
	  6. พลัดตกระหว่างการเคลื่อนย้าย<br /><?=$arr_show["topic1_7"];?>
	</p>
	  <p><b>2. การติดต่อสื่อสาร</b><br />
		<input type="checkbox" name="topic2_1" value="1" <?php if($arr_show["topic2_1"] == "1") echo " Checked ";?> disabled/>
1. ไม่มีรายงานผล Lab/Film X-ray ด่วน<br />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือ ผิดปกติ<br />
<input type="checkbox" name="topic2_2" value="1" <?php if($arr_show["topic2_2"] == "1") echo " Checked ";?> disabled/>
2. ไม่มีรายงานแพทย์/แพทย์ไม่ตอบ<br />
<input type="checkbox" name="topic2_3" value="1" <?php if($arr_show["topic2_3"] == "1") echo " Checked ";?> disabled/>
3. ปฏิบัติไม่ถูกต้องตามคำสั่ง<br />
<input type="checkbox" name="topic2_4" value="1" <?php if($arr_show["topic2_4"] == "1") echo " Checked ";?> disabled/>
4. เวชระเบียนไม่สมบูรณ์<br />
<input type="checkbox" name="topic2_5" value="1" <?php if($arr_show["topic2_5"] == "1") echo " Checked ";?> disabled/>
5. ใบยินยอมไม่ตรงกับหัตถการ<br />
<input type="checkbox" name="topic2_6" value="1" <?php if($arr_show["topic2_6"] == "1") echo " Checked ";?> disabled/>
6. ทำหัตถการโดยไม่มีใบยินยอม<br />
<?=$arr_show["topic2_7"];?>
	  </p>
	  <p><b>3. เลือด</b><br />
		<input type="checkbox" name="topic3_1" value="1" <?php if($arr_show["topic3_1"] == "1") echo " Checked ";?> disabled/>
1. ผิดคน<br />
<input type="checkbox" name="topic3_2" value="1" <?php if($arr_show["topic3_2"] == "1") echo " Checked ";?> disabled/>
2. ภาวะแทรกซ้อนจากการให้เลือด<br />
<input type="checkbox" name="topic3_3" value="1" <?php if($arr_show["topic3_3"] == "1") echo " Checked ";?>disabled />
3. แพ้เลือด<br />
<?=$arr_show["topic3_4"];?>
	  </p></td>
	<td valign="top" width=""><p><b>4. เครื่องมือ</b><br />
	  <input type="checkbox" name="topic4_1" value="1" <?php if($arr_show["topic4_1"] == "1") echo " Checked ";?> disabled/>
	  1.ผู้ป่วยถูกลวก / ไหม้<br />
  <input type="checkbox" name="topic4_2" value="1" <?php if($arr_show["topic4_2"] == "1") echo " Checked ";?> disabled/>
	  2.ตกใส่ผู้ป่วย<br />
  <input type="checkbox" name="topic4_3" value="1" <?php if($arr_show["topic4_3"] == "1") echo " Checked ";?> disabled/>
	  3.ไม่ทำงาน / ทำงานผิดปกติ<br />
  <input type="checkbox" name="topic4_4" value="1" <?php if($arr_show["topic4_4"] == "1") echo " Checked ";?> disabled/>
	  4.ไม่มีเครื่องมือ ใช้<br />
  <input type="checkbox" name="topic4_5" value="1" <?php if($arr_show["topic4_5"] == "1") echo " Checked ";?> disabled/>
	  5.ลิฟท์ไม่ทำงาน<br />
	  <?=$arr_show["topic4_6"];?>
	</p>
	  <p><b>5. การวินิจฉัย / รักษา</b><br />
		<input type="checkbox" name="topic5_1" value="1" <?php if($arr_show["topic5_1"] == "1") echo " Checked ";?> disabled/>
1. รับ Admit ซ้ำโดยโรคเดิมใน  7 วัน<br />
<input type="checkbox" name="topic5_2" value="1" <?php if($arr_show["topic5_2"] == "1") echo " Checked ";?> disabled/>
2. ไม่สามารถวินิจฉัยโรคที่ต้อง admit  หรือมา ER ซ้ำ<br />
<input type="checkbox" name="topic5_3" value="1" <?php if($arr_show["topic5_3"] == "1") echo " Checked ";?> disabled/>
3. อ่านผลเอ็กซ์เรย์ผิด<br />
<input type="checkbox" name="topic5_4" value="1" <?php if($arr_show["topic5_4"] == "1") echo " Checked ";?> disabled/>
4. ล่าช้าในการรักษาผู้ป่วยที่ทรุดลง<br />
<input type="checkbox" name="topic5_5" value="1" <?php if($arr_show["topic5_5"] == "1") echo " Checked ";?> disabled/>
5. ภาวะแทรกซ้อนจากหัตถการ<br />
<input type="checkbox" name="topic5_6" value="1" <?php if($arr_show["topic5_6"] == "1") echo " Checked ";?> disabled/>
6. ทำ Diag  Proc ซ้ำโดยไม่มีแผน<br />
<input type="checkbox" name="topic5_7" value="1" <?php if($arr_show["topic5_7"] == "1") echo " Checked ";?> disabled/>
7. การเฝ้าระวังไม่เพียงพอ<br />
<input type="checkbox" name="topic5_8" value="1" <?php if($arr_show["topic5_8"] == "1") echo " Checked ";?> disabled/>
8. ใส่ Cath / Tube / Drain ไม่ถูก<br />
<input type="checkbox" name="topic5_9" value="1" <?php if($arr_show["topic5_9"] == "1") echo " Checked ";?> disabled/>
9. ดูแล Cath / Tube / Drain <br />
<input type="checkbox" name="topic5_10" value="1" <?php if($arr_show["topic5_10"] == "1") echo " Checked ";?> disabled/>
10. ย้ายผู้ป่วยเข้า ICU โดยไม่มีแผน<br />
<?=$arr_show["topic5_11"];?>
	  </p>
	  <p><b>6. การคลอด</b><br />
		<input type="checkbox" name="topic6_1" value="1" <?php if($arr_show["topic6_1"] == "1") echo " Checked ";?> disabled/>
1. ไม่พบ Fetal distress ทันท่วงที<br />
<input type="checkbox" name="topic6_2" value="1" <?php if($arr_show["topic6_2"] == "1") echo " Checked ";?>disabled />
2. ผ่าตัดคลอดช้าเกินไป<br />
<input type="checkbox" name="topic6_3" value="1" <?php if($arr_show["topic6_3"] == "1") echo " Checked ";?> disabled/>
3. ภาวะแทรกซ้อนจากการคลอด<br />
<input type="checkbox" name="topic6_4" value="1" <?php if($arr_show["topic6_4"] == "1") echo " Checked ";?> disabled/>
4. บาดเจ็บจากการคลอด<br />
<?=$arr_show["topic6_5"];?>
	  </p></td>
	<td valign="top"><p><b>7. การผ่าตัด / วิสัญญี</b><br />
	  <input type="checkbox" name="topic7_1" value="1" <?php if($arr_show["topic7_1"] == "1") echo " Checked ";?> disabled/>
	  1. ภาวะแทรกซ้อนทางวิสัญญี<br />
  <input type="checkbox" name="topic7_2" value="1" <?php if($arr_show["topic7_2"] == "1") echo " Checked ";?> disabled/>
	  2. ผ่าตัดผิดคน / ผิดข้าง / ผิดตำแหน่ง<br />
  <input type="checkbox" name="topic7_3" value="1" <?php if($arr_show["topic7_3"] == "1") echo " Checked ";?> disabled/>
	  3. ตัดอวัยวะออกโดยไม่ได้วางแผน<br />
  <input type="checkbox" name="topic7_4" value="1" <?php if($arr_show["topic7_4"] == "1") echo " Checked ";?> disabled/>
	  4. เย็บซ่อมอวัยวะที่บาดเจ็บ<br />
  <input type="checkbox" name="topic7_5" value="1" <?php if($arr_show["topic7_5"] == "1") echo " Checked ";?>disabled />
	  5. ทิ้งเครื่องมือ / ก๊อส ไว้ในผู้ป่วย<br />
  <input type="checkbox" name="topic7_6" value="1" <?php if($arr_show["topic7_6"] == "1") echo " Checked ";?> disabled/>
	  6. กลับมาผ่าตัดซ้ำ<br /><?=$arr_show["topic7_7"];?>
	</p>
	  <b>8. อื่น ๆ</b><br />
	  <input type="checkbox" name="topic8_1" value="1" <?php if($arr_show["topic8_1"] == "1") echo " Checked ";?> disabled/>
1. ผู้ป่วย / ญาติ ไม่พึงพอใจ<br />
<input type="checkbox" name="topic8_2" value="1" <?php if($arr_show["topic8_2"] == "1") echo " Checked ";?>disabled />
2. ไม่สมัครใจอยู่ รพ.<br />
<input type="checkbox" name="topic8_3" value="1" <?php if($arr_show["topic8_3"] == "1") echo " Checked ";?>disabled />
3. มีการทำร้ายร่างกาย ผู้ป่วย /ญาติ /เจ้าหน้าที่<br />
<input type="checkbox" name="topic8_4" value="1" <?php if($arr_show["topic8_4"] == "1") echo " Checked ";?> disabled/>
4. ผู้ป่วยพยายามฆ่าตัวตาย /ทำร้ายร่างกายตัวเอง<br />
<input type="checkbox" name="topic8_5" value="1" <?php if($arr_show["topic8_5"] == "1") echo " Checked ";?> disabled/>
5. โจรกรรม/ลักขโมย<br />
<input type="checkbox" name="topic8_6" value="1" <?php if($arr_show["topic8_6"] == "1") echo " Checked ";?>disabled />
6. การคุกคาม/ ข่มขู่<br />
<input type="checkbox" name="topic8_7" value="1" <?php if($arr_show["topic8_7"] == "1") echo " Checked ";?> disabled/>
7. สิ่งแวดล้อมเป็นอันตราย/ปนเปื้อน<br />
<input type="checkbox" name="topic8_8" value="1" <?php if($arr_show["topic8_8"] == "1") echo " Checked ";?>disabled />
8. อุบัติเหตุไฟไหม้<br />
<input type="checkbox" name="topic8_9" value="1" <?php if($arr_show["topic8_9"] == "1") echo " Checked ";?>disabled />
9. จนท. บาดเจ็บจากการทำงาน <br />
<input type="checkbox" name="topic8_10" value="1" <?php if($arr_show["topic8_10"] == "1") echo " Checked ";?>disabled />
10. ไม่ได้เรียกเก็บค่าใช้จ่าย<br /><?=$arr_show["topic8_11"];?></td>
  </tr>
</table>

<div style="page-break-after:always;"></div>

<table width="100%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" class="fonttable" style="border-collapse:collapse;">
  <tr>
	<td colspan="3"><strong>บรรยายสรุปเหตุการณ์</strong></td>
  </tr>
  <tr>
	<td colspan="3" class="line"><?=$arr_show['sum_up'];?></td>
  </tr>
  <tr>
	<td colspan="3">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="3"><strong>ความรุนแรง</strong></td>
  </tr>
  <tr>
	<td width="78%"><input type="radio" name="clinic"   id="clinic1" value="A" <?php if($arr_show["clinic"] == "A") echo " Checked ";?> disabled/>
  A มีเหตุการณ์ซึ่งมีโอกาสที่ก่อให้เกิดความคลาดเคลื่อน หรืออาจเกิดภายในหน่วยงาน แต่ยังไม่เกิด<br />
<input type="radio" name="clinic"  id="clinic2"  value="B" <?php if($arr_show["clinic"] == "B") echo " Checked ";?>disabled />
B  เกิดความคลาดเคลื่อนขึ้น ซึ่งไม่ถึงผู้ป่วย/รพ./เจ้าหน้าที่ และยังไม่มีความเสียหายใด</td>
	<td width="10%" align="center" valign="top">ระดับ 1<br />
	  เกือบพลาด      <br /></td>
	<td width="12%" rowspan="3" align="center"><strong>ส่งรายงานศูนย์พัฒนาคุณภาพ</strong></td>
  </tr>
  <tr>
	<td><input type="radio" name="clinic" id="clinic3"  value="C" <?php if($arr_show["clinic"] == "C") echo " Checked ";?> disabled/>
C  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ แต่ไม่ได้รับอันตรายหรือเสื่อมเสียชื่อเสียง ทรัพย์สินเสียหายเล็กน้อย มูลค่าไม่เกิน 2,000 บาท</td>
	<td align="center">ระดับ 2<br />
	  น้อย</td>
  </tr>
  <tr>
	<td><input type="radio" name="clinic"  id="clinic4" value="D" <?php if($arr_show["clinic"] == "D") echo " Checked ";?> disabled/>
D  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ ซึ่งต้องเฝ้าระวัง / ติดตามเพิ่มเติม ชื่อเสียงภาพพจน์เสียหาย เกิดความไม่ไว้วางใจจากผู้ป่วยและความไม่สะดวกขณะรับบริการ ทรัพย์สินเสียหายเล็กน้อยมูลค่า 2,000 -5,000 บาท<br />
  <input type="radio" name="clinic"  id="clinic5" value="E" <?php if($arr_show["clinic"] == "E") echo " Checked ";?> disabled/>
E  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ ส่งผลให้เกิดอันตรายชั่วคราวและต้องมีการบำบัดรักษา เกิดความไม่ไว้วางใจ จากบริษัทประกัน /หน่วยงานของรัฐ ทรัพย์สินเสียหายมากกว่า 5,000 - 15,000 บาท <br />
  <input type="radio" name="clinic"  id="clinic6" value="F" <?php if($arr_show["clinic"] == "F") echo " Checked ";?> disabled/>
F  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ ส่งผลให้เกิดอันตรายชั่วคราว และต้องนอนโรงพยาบาลหรืออยู่โรงพยาบาลนานขึ้น เกิดความไม่ไว้วางใจจากบริษัทประกัน / หน่วยงานของรัฐ ต้องหยุดงานมากกว่า 3 วัน ทรัพย์สินเสียหายมากกว่า 15,000 บาทแต่ไม่เกิน 30,000 บาท</td>
	<td align="center">ระดับ 3 <br />
	  ปานกลาง</td>
  </tr>
  <tr>
	<td><input type="radio" name="clinic"  id="clinic7" value="G" <?php if($arr_show["clinic"] == "G") echo " Checked ";?> disabled/>
G  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ ส่งผลให้เกิดอันตรายถาวร ทรัพย์สินเสียหาย มีมูลค่ามากกว่า 30,000 บาท แต่ไม่เกิน 50,000 บาท ชื่อเสียงภาพพจน์เสียหายปรากฏในสื่อสาธารณะ<br />
<input type="radio" name="clinic"  id="clinic8" value="H" <?php if($arr_show["clinic"] == "H") echo " Checked ";?> disabled/>
H  เกิดความคลาดเคลื่อนกับผู้ป่วย  /รพ./เจ้าหน้าที่ ส่งผลให้ต้องทำการช่วยชีวิต การบาดเจ็บ/เจ็บป่วยจากงานในระดับรุนแรง ทรัพย์สินเสียหาย มีมูลค่ามากกว่า 50,000 แต่ไม่เกิน 100,000 บาท ชื่อเสียงภาพพจน์เสียหายปรากฏในสื่อสาธารณะ<br />
<input type="radio" name="clinic" id="clinic9"  value="I" <?php if($arr_show["clinic"] == "I") echo " Checked ";?> disabled/>
I   เกิดความคลาดเคลื่อนกับผู้ป่วย   /รพ./เจ้าหน้าที่  ซึ่งเป็นสาเหตุของการเสียชีวิต ทรัพย์สินเสียหาย มีมูลค่ามากกว่า 100,000 บาท ชื่อเสียงภาพพจน์เสียหายปรากฏในสื่อสาธารณะ/ถูกฟ้องร้องต่อองค์กรวิชาชีพ</td>
	<td align="center">ระดับ 4 <br />
	  มาก</td>
	<td align="center">รายงานด่วนภายใน 6 ชั่วโมง<br />
ผอ.รพค่ายฯ, ทีมจัดการ<br />
ความเสี่ยง</td>
  </tr>
  <tr>
	<td colspan="3"><strong>ปัญหาที่พบ /สาเหตุ</strong></td>
  </tr>
  <tr>
	<td colspan="3" class="line"><span class="line1">
	  <?=$arr_show['problem'];?>
	</span></td>
  </tr>
  <tr>
	<td colspan="3" class="line">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="3"><strong>มาตรการแก้ไขที่ได้ดำเนินการไปแล้ว / มาตรการป้องกัน</strong></td>
  </tr>
  <tr>
	<td colspan="3" class="line"><span class="line1">
	  <?=$arr_show['protect'];?>
	</span></td>
  </tr>
   <tr>
	<td colspan="3" class="line">&nbsp;</td>
  </tr>
  <tr>
	<td colspan="3">ลงชื่อ <span class="line1">
	  <?=$arr_show['head_name'];?>
	</span> หัวหน้าหน่วยงาน</td>
  </tr>
  <? if($_SESSION["statusncr"]=='admin'){ ?>
  <tr>
	<td colspan="3"><strong>ฝ่ายคุณภาพ </strong></td>
  </tr>
  <tr>
	<td colspan="3"><input name="quality" type="radio" id="quality1"  value="1"  <?php if($arr_show["quality"] == "1") echo " Checked ";?> disabled/>
	  หาข้อมูลเพิ่มเติม
	  <input name="quality" type="radio" id="quality2" value="2"  <?php if($arr_show["quality"] == "2") echo " Checked ";?> disabled/>
	  ติดตามความถี่ของความไม่สอดคล้อง
  <input name="quality" type="radio" id="quality3"  value="3" <?php if($arr_show["quality"] == "3") echo " Checked ";?> disabled/>
	  ออก CAR / PAR เลขที่
	  
  <?=$arr_show['cpno'];?>
</td>
  </tr>
  <tr>
	<td colspan="3"><strong>ชนิดของความเสี่ยง</strong></td>
  </tr>
  <tr>
	<td colspan="3"><table border="0">
	  <tr>
		<td><input name="risk1" type="checkbox" id="risk1" value="1"  <?php if($arr_show["risk1"] == "1") echo " Checked ";?> disabled/>
		  1.Clinical Risk </td>
		<td><input name="risk6" type="checkbox" id="risk6" value="6" <?php if($arr_show["risk6"] == "1") echo " Checked ";?> disabled/>
		  6.Customer Complaint Risk </td>
		</tr>
	  <tr>
		<td><input name="risk2" type="checkbox" id="risk2" value="2"  <?php if($arr_show["risk2"] == "1") echo " Checked ";?> disabled/>
		  2.Infection control Risk </td>
		<td><input name="risk7" type="checkbox" id="risk7" value="7" <?php if($arr_show["risk7"] == "1") echo " Checked ";?> disabled/>
		  7.Financial Risk </td>
		</tr>
	  <tr>
		<td><input name="risk3" type="checkbox" id="risk3" value="3" <?php if($arr_show["risk3"] == "1") echo " Checked ";?> disabled/>
		  3.Medication Risk </td>
		<td><input name="risk8" type="checkbox" id="risk8" value="8" <?php if($arr_show["risk8"] == "1") echo " Checked ";?> disabled/>
		  8.Utilization Management Risk </td>
		</tr>
	  <tr>
		<td><input name="risk4" type="checkbox" id="risk4" value="4" <?php if($arr_show["risk4"] == "1") echo " Checked ";?> disabled/>
		  4.Medical Equipment Risk </td>
		<td><input name="risk9" type="checkbox" id="risk9" value="9"  <?php if($arr_show["risk9"] == "1") echo " Checked ";?> disabled/>
		  9.Information Risk</td>
		</tr>
	  <tr>
		<td><input name="risk5" type="checkbox" id="risk5" value="5" <?php if($arr_show["risk5"] == "1") echo " Checked ";?> disabled/>
		  5.Safety and Environment Risk </td>
		<td>&nbsp;</td>
		</tr>
		<? } ?>
	</table></td>
  </tr>
</table>


</body>
</html>