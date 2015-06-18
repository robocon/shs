<?php
session_start();
include("connect.inc");	


$sql = "Select * From noncof where nonconf_id = '".$_GET["id"]."' limit 1 ";
		$result = Mysql_Query($sql) or die(Mysql_error());
		$arr_edit = Mysql_fetch_assoc($result);
		$sql = "Select * From nonconf2 where nonconf_id = '".$_GET["id"]."' limit 1 ";
		$result = Mysql_Query($sql) or die(Mysql_error());
		$arr_edit2 = Mysql_fetch_assoc($result);
		
		$nonconf_id = $arr_edit["nonconf_id"];
		$date_now = $arr_edit["nonconf_date"];
		$nonconf_time1 = substr($arr_edit["nonconf_time"],0,-3);
		$nonconf_time2 = substr($arr_edit["nonconf_time"],-2);
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>
<TITLE>ใบรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง</TITLE>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14 px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14 px;
	color:#FFFFFF;
	font-weight: bold;

}
.style1 {
	color: #000000;
	font-weight: bold;
}
.style2 {color: #000000}
</style>
<?php
	if(empty($_GET["view"])){
?>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;
	window.onload = function(){
		window.print();
		window.close();
	}

</script>
<?php } ?>
</HEAD>

<BODY>

<TABLE align="center" border="0" bordercolor="#000000" style="BORDER-COLLAPSE: collapse">
<TR>
	<TD width="722" align="center">
		<span class="style1"><FONT SIZE="1"><br>
		รายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง ( Non - Conforming Report )</FONT> <br>
		</span></TD>
</TR>
<TR>
	<TD valign="top">
<TABLE width="721" border="1" bordercolor="#000000" style="BORDER-COLLAPSE: collapse">
<TR valign="top">
	<TD width="233" class="style2">
	<TABLE height="115" width="100%">
	<TR valign="top">
		<TD><br>
		<? if($arr_edit["ncr"] != "000" && $arr_edit["ncr"] != "" && $arr_edit["ncr"] != "-"){
				echo "เลขที่ NCR : ".$arr_edit["ncr"]."<BR>";	
		}?>
		หน่วยงาน / ทีม : <?php echo $cfg_until[$arr_edit["until"]];?><BR>
		วันที่ : <?php echo $date_now;?>&nbsp;&nbsp;
		เวลา : <?php echo $nonconf_time1,":",$nonconf_time2; ?>		
		<br>
<strong>บันทึกรายงาน</strong> <br>

		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="เหตุการณ์สำคัญ" <?php if($arr_edit["type"] == "เหตุการณ์สำคัญ") echo " Checked ";?>>&nbsp;เหตุการณ์สำคัญ<br>
		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="อุบัติการณ์" <?php if($arr_edit["type"] == "อุบัติการณ์") echo " Checked ";?>>&nbsp;อุบัติการณ์<br>
		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="ความไม่สอดคล้อง" <?php if($arr_edit["type"] == "ความไม่สอดคล้อง") echo " Checked ";?>>&nbsp;ความไม่สอดคล้อง<br>
		</TD>
	</TR>
	</TABLE>	</TD>
	<TD colspan="2">
		<TABLE  height="115" width="82%" >
		<TR  valign="top">
			<TD><B>ที่มา</B></TD>
			<TD>
				<INPUT TYPE="radio" NAME="come_from_id" value="1"  <?php if($arr_edit["come_from_id"] == "1") echo " Checked ";?>>&nbsp;ENV ROUND<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="2"  <?php if($arr_edit["come_from_id"] == "2") echo " Checked ";?>>&nbsp;IC ROUND<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="3"  <?php if($arr_edit["come_from_id"] == "3") echo " Checked ";?>>&nbsp;RM ROUND<BR>			</TD>
			<TD>
				<INPUT TYPE="radio" NAME="come_from_id" value="4"  <?php if($arr_edit["come_from_id"] == "4") echo " Checked ";?>>&nbsp;12 กิจกรรมทบทวน<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="5"  <?php if($arr_edit["come_from_id"] == "5") echo " Checked ";?>>&nbsp;หน่วยรายงานเอง<BR>
				<INPUT TYPE="radio" NAME="come_from_id" value="6"  <?php if($arr_edit["come_from_id"] == "6") echo " Checked ";?>>&nbsp;อื่นๆ&nbsp;&nbsp;<?php echo $arr_edit["come_from_detail"];?><BR>			</TD>
		</TR>
		</TABLE>	</TD>
</TR>
<TR  valign="top">
	<TD valign="top">
	<TABLE  width='100%'>
	<TR>
		<TD>
	<B>1. ความปลอดภัย / ตก/ หกล้ม</B><BR>
		<INPUT TYPE="checkbox" NAME="topic1_1" value="1" <?php if($arr_edit["topic1_1"] == "1") echo " Checked ";?>> 1. ล้ม<BR>
		<INPUT TYPE="checkbox" NAME="topic1_2" value="1" <?php if($arr_edit["topic1_2"] == "1") echo " Checked ";?>> 2. พบว่านอนอยู่บนพื้น<BR>
		<INPUT TYPE="checkbox" NAME="topic1_3" value="1" <?php if($arr_edit["topic1_3"] == "1") echo " Checked ";?>> 3. ตกจากเตียง/เก้าอื้/โต๊ะ<BR>
		<INPUT TYPE="checkbox" NAME="topic1_4" value="1" <?php if($arr_edit["topic1_4"] == "1") echo " Checked ";?>> 4. เครื่องรัดตรึงหลุด<BR>
		<INPUT TYPE="checkbox" NAME="topic1_5" value="1" <?php if($arr_edit["topic1_5"] == "1") echo " Checked ";?>> 5. ปีนข้ามไม้กั้นเตียง<BR>
		<INPUT TYPE="checkbox" NAME="topic1_6" value="1" <?php if($arr_edit["topic1_6"] == "1") echo " Checked ";?>> 6. พลัดตกระหว่างการเครื่อนย้าย<BR>

		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic1_7"]);?></TD>
		</TR>
		</TABLE>		</TD>
		</TR>
		</TABLE><BR>
<TABLE  width='100%'>
<TR>
	<TD>
	<B>2. การติดต่อสื่อสาร</B><BR>
		<INPUT TYPE="checkbox" NAME="topic2_1" value="1" <?php if($arr_edit["topic2_1"] == "1") echo " Checked ";?>> 1. ไม่มีรายงานผล Lab/Film X-ray ด่วน<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือ ผิดปกติ<BR>
		<INPUT TYPE="checkbox" NAME="topic2_2" value="1" <?php if($arr_edit["topic2_2"] == "1") echo " Checked ";?>> 2. ไม่มีรายงานแพทย์/แพทย์ไม่ตอบ<BR>
		<INPUT TYPE="checkbox" NAME="topic2_3" value="1" <?php if($arr_edit["topic2_3"] == "1") echo " Checked ";?>> 3. ปฏิบัติไม่ถูกต้องตามคำสั่ง<BR>
		<INPUT TYPE="checkbox" NAME="topic2_4 " value="1" <?php if($arr_edit["topic2_4"] == "1") echo " Checked ";?>> 4. เวชระเบียนไม่สมบูรณ์<BR>
		<INPUT TYPE="checkbox" NAME="topic2_5" value="1" <?php if($arr_edit["topic2_5"] == "1") echo " Checked ";?>> 5. ใบยินยอมไม่ตรงกับหัตถการ<BR>
		<INPUT TYPE="checkbox" NAME="topic2_6 " value="1" <?php if($arr_edit["topic2_6"] == "1") echo " Checked ";?>> 6. ทำหัตถการโดยไม่มีใบยินยอม<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic2_7"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE>
<BR>
<TABLE  width='100%' height="236">
<TR>
	<TD valign="top">
	<B>3. เลือด</B><BR>
		<INPUT TYPE="checkbox" NAME="topic3_1" value="1" <?php if($arr_edit["topic3_1"] == "1") echo " Checked ";?> > 1. ผิดคน<BR>
		<INPUT TYPE="checkbox" NAME="topic3_2" value="1" <?php if($arr_edit["topic3_2"] == "1") echo " Checked ";?> > 2. ภาวะแทรกซ้อนจากการให้เลือด<BR>
		<INPUT TYPE="checkbox" NAME="topic3_3" value="1" <?php if($arr_edit["topic3_3"] == "1") echo " Checked ";?> > 3. แพ้เลือด<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic3_4"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE>	</TD>
	<TD width="221">
<TABLE  width='100%'>
<TR>
	<TD>
	<B>4. เครื่องมือ</B><BR>

<INPUT TYPE="checkbox" NAME="topic4_1" value="1" <?php if($arr_edit["topic4_1"] == "1") echo " Checked ";?> >  1.ผู้ป่วยถูกลวก / ไหม้<BR>
<INPUT TYPE="checkbox" NAME="topic4_2" value="1" <?php if($arr_edit["topic4_2"] == "1") echo " Checked ";?> >  2.ตกใส่ผู้ป่วย<BR>
<INPUT TYPE="checkbox" NAME="topic4_3" value="1" <?php if($arr_edit["topic4_3"] == "1") echo " Checked ";?> >  3.ไม่ทำงาน / ทำงานผิดปกติ<BR>
<INPUT TYPE="checkbox" NAME="topic4_4" value="1" <?php if($arr_edit["topic4_4"] == "1") echo " Checked ";?> >  4.ไม่มีเครื่องมือ ใช้<BR>
<INPUT TYPE="checkbox" NAME="topic4_5" value="1" <?php if($arr_edit["topic4_5"] == "1") echo " Checked ";?> >  5.ลิฟท์ไม่ทำงาน<BR>

		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic4_7"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE><BR>
<TABLE  width='100%'>
<TR>
	<TD>
	<B>5. การวินิจฉัย / รักษา</B><BR>
		<INPUT TYPE="checkbox" NAME="topic5_1" value="1" <?php if($arr_edit["topic5_1"] == "1") echo " Checked ";?>> 1. รับ Admit ซ้ำโดยโรคเดิมใน  7 วัน<BR>
		<INPUT TYPE="checkbox" NAME="topic5_2" value="1" <?php if($arr_edit["topic5_2"] == "1") echo " Checked ";?>> 2. ไม่สามารถวินิจฉัยโรคที่ต้อง admit  หรือมา ER ซ้ำ<BR>
		<INPUT TYPE="checkbox" NAME="topic5_3" value="1" <?php if($arr_edit["topic5_3"] == "1") echo " Checked ";?>> 3. อ่านผลเอ็กซ์เรย์ผิด<BR>
		<INPUT TYPE="checkbox" NAME="topic5_4" value="1" <?php if($arr_edit["topic5_4"] == "1") echo " Checked ";?>> 4. ล่าช้าในการรักษาผู้ป่วยที่ทรุดลง<BR>
		<INPUT TYPE="checkbox" NAME="topic5_5" value="1" <?php if($arr_edit["topic5_5"] == "1") echo " Checked ";?>> 5. ภาวะแทรกซ้อนจากหัตถการ<BR>
		<INPUT TYPE="checkbox" NAME="topic5_6" value="1" <?php if($arr_edit["topic5_6"] == "1") echo " Checked ";?>> 6. ทำ Diag  Proc ซ้ำโดยไม่มีแผน<BR>
		<INPUT TYPE="checkbox" NAME="topic5_7" value="1" <?php if($arr_edit["topic5_7"] == "1") echo " Checked ";?>> 7. การเฝ้าระวังไม่เพียงพอ<BR>
		<INPUT TYPE="checkbox" NAME="topic5_8" value="1" <?php if($arr_edit["topic5_8"] == "1") echo " Checked ";?>> 8. ใส่ Cath / Tube / Drain ไม่ถูก<BR>
		<INPUT TYPE="checkbox" NAME="topic5_9" value="1" <?php if($arr_edit["topic5_9"] == "1") echo " Checked ";?>> 9. ดูแล Cath / Tube / Drain <BR>
		<INPUT TYPE="checkbox" NAME="topic5_10" value="1" <?php if($arr_edit["topic5_10"] == "1") echo " Checked ";?>> 10. ย้ายผู้ป่วยเข้า ICU โดยไม่มีแผน<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic5_11"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE>
<BR>
<TABLE  width='100%'>
<TR>
	<TD>
	<B>6. การคลอด</B><BR>
		<INPUT TYPE="checkbox" NAME="topic6_1" value="1" <?php if($arr_edit["topic6_1"] == "1") echo " Checked ";?>> 1. ไม่พบ Fetal distress ทันท่วงที<BR>
		<INPUT TYPE="checkbox" NAME="topic6_2" value="1" <?php if($arr_edit["topic6_2"] == "1") echo " Checked ";?>> 2. ผ่าตัดคลอดช้าเกินไป<BR>
		<INPUT TYPE="checkbox" NAME="topic6_3" value="1" <?php if($arr_edit["topic6_3"] == "1") echo " Checked ";?>> 3. ภาวะแทรกซ้อนจากการคลอด<BR>
		<INPUT TYPE="checkbox" NAME="topic6_4" value="1" <?php if($arr_edit["topic6_4"] == "1") echo " Checked ";?>> 4. บาดเจ็บจากการคลอด<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic6_5"]);?></TD>
		</TR>
		</TABLE></TD>
</TR>
</TABLE>	</TD>
	<TD width="245">

<TABLE  width='100%'>
	<TR>
		<TD>
	<B>7. การผ่าตัด / วิสัญญี</B><BR>
		<INPUT TYPE="checkbox" NAME="topic7_1" value="1" <?php if($arr_edit["topic7_1"] == "1") echo " Checked ";?>> 1. ภาวะแทรกซ้อนทางวิสัญญี<BR>
		<INPUT TYPE="checkbox" NAME="topic7_2" value="1" <?php if($arr_edit["topic7_2"] == "1") echo " Checked ";?>> 2. ผ่าตัดผิดคน / ผิดข้าง / ผิดตำแหน่ง<BR>
		<INPUT TYPE="checkbox" NAME="topic7_3" value="1" <?php if($arr_edit["topic7_3"] == "1") echo " Checked ";?>> 3. ตัดอวัยวะออกโดยไม่ได้วางแผน<BR>
		<INPUT TYPE="checkbox" NAME="topic7_4" value="1" <?php if($arr_edit["topic7_4"] == "1") echo " Checked ";?>> 4. เย็บซ่อมอวัยวะที่บาดเจ็บ<BR>
		<INPUT TYPE="checkbox" NAME="topic7_5" value="1" <?php if($arr_edit["topic7_5"] == "1") echo " Checked ";?>> 5. ทิ้งเครื่องมือ / ก๊อส ไว้ในผู้ป่วย<BR>
		<INPUT TYPE="checkbox" NAME="topic7_6" value="1" <?php if($arr_edit["topic7_6"] == "1") echo " Checked ";?>> 6. กลับมาผ่าตัดซ้ำ<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic7_7"]);?></TD>
		</TR>
		</TABLE></TD>
	</TR>
	</TABLE>
	<BR>

	<TABLE  width='100%'>
	<TR>
		<TD>
	<B>8. อื่น ๆ</B><BR>
		<INPUT TYPE="checkbox" NAME="topic8_1" value="1" <?php if($arr_edit["topic8_1"] == "1") echo " Checked ";?>> 1. ผู้ป่วย / ญาติ ไม่พึงพอใจ<BR>
		<INPUT TYPE="checkbox" NAME="topic8_2" value="1" <?php if($arr_edit["topic8_2"] == "1") echo " Checked ";?>> 2. ไม่สมัครใจอยู่ รพ.<BR>
		<INPUT TYPE="checkbox" NAME="topic8_3" value="1" <?php if($arr_edit["topic8_3"] == "1") echo " Checked ";?>> 3. มีการทำร้ายร่างกาย ผู้ป่วย / ญาติ /  เจ้าหน้าที่<BR>
		<INPUT TYPE="checkbox" NAME="topic8_4" value="1" <?php if($arr_edit["topic8_4"] == "1") echo " Checked ";?>> 4. ผู้ป่วยพยายามฆ่าตัวตาย / ทำร้ายร่างกายตัวเอง<BR>
		<INPUT TYPE="checkbox" NAME="topic8_5" value="1" <?php if($arr_edit["topic8_5"] == "1") echo " Checked ";?>> 5. โจรกรรม / ลักขโมย<BR>
		<INPUT TYPE="checkbox" NAME="topic8_6" value="1" <?php if($arr_edit["topic8_6"] == "1") echo " Checked ";?>> 6. การคุกคาม / ข่มขู่<BR>
		<INPUT TYPE="checkbox" NAME="topic8_7" value="1" <?php if($arr_edit["topic8_7"] == "1") echo " Checked ";?>> 7. สิ่งแวดล้อมเป็นอันตราย / ปนเปื้อน<BR>
		<INPUT TYPE="checkbox" NAME="topic8_8" value="1" <?php if($arr_edit["topic8_8"] == "1") echo " Checked ";?>> 8. อุบัติเหตุไฟไหม้<BR>
		<INPUT TYPE="checkbox" NAME="topic8_9" value="1" <?php if($arr_edit["topic8_9"] == "1") echo " Checked ";?>> 9. จนท. บาดเจ็บจากการทำงาน <BR>
		<INPUT TYPE="checkbox" NAME="topic8_10" value="1" <?php if($arr_edit["topic8_10"] == "1") echo " Checked ";?>> 10. ไม่ได้เรียกเก็บค่าใช้จ่าย<BR>
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic8_11"]);?></TD>
		</TR>
		</TABLE></TD>
	</TR>
	</TABLE>

	<BR>

	<TABLE  width='100%'>
	<TR>
		<TD>
	<B>9. อื่น ๆ</B><BR>
		
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><?php echo nl2br($arr_edit["topic9_1"]);?></TD>
		</TR>
		</TABLE></TD>
	</TR>
	</TABLE>	</TD>
</TR>
<TR>
	<TD >
		<B>ธรรมชาติของการบาดเจ็บ</B><BR>
		<INPUT TYPE="radio" NAME="type_injured" value="1" <?php if($arr_edit["type_injured"] == "1") echo " Checked ";?> > 1.  กระดูกและกล้ามเนื้อ<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="2" <?php if($arr_edit["type_injured"] == "2") echo " Checked ";?> > 2. ผิวหนัง<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="3" <?php if($arr_edit["type_injured"] == "3") echo " Checked ";?> > 3. ประสาทส่วนกลาง<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="4" <?php if($arr_edit["type_injured"] == "4") echo " Checked ";?> > 4. หัวใจและปอด	</TD>
	<TD >
		<B>บันทึกในเวชระเบียน</B> <INPUT TYPE="radio" NAME="save_in_medical_record" value="1" <?php if($arr_edit["save_in_medical_record"] == "1") echo " Checked ";?> > ทำ &nbsp;&nbsp;&nbsp;&nbsp; <INPUT TYPE="radio" NAME="save_in_medical_record" value="0" <?php if($arr_edit["save_in_medical_record"] == "0") echo " Checked ";?> > ไม่ทำ<BR>
		รายงานแพทย์ : <BR>&nbsp;&nbsp;<?php echo nl2br($arr_edit["tell_doctor"]);?>
	</TD>
	<TD >
		แพทย์ผู้ประเมิน : <?php echo $arr_edit["estimate_doctor"];?><BR>
		ผลการประเมิน<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="1" <?php if($arr_edit["estimate_result"] == "1") echo " Checked ";?> >&nbsp;ไม่มีการบาดเจ็บ<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="2" <?php if($arr_edit["estimate_result"] == "2") echo " Checked ";?> >&nbsp;ไม่เห็นการบาดเจ็บชัดเจน<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="3" <?php if($arr_edit["estimate_result"] == "3") echo " Checked ";?> >&nbsp;ต้องอยู่ รพ. นานขึ้น<BR>	
		
		</TD>
</TR>
<TR valign="top">
	<TD colspan="3"  >
	<DIV style="page-break-after:always"></DIV><BR>
		<B>บรรยายสรุปเหตุการณ์</B> : <BR>&nbsp;&nbsp;&nbsp;<?php echo nl2br($arr_edit["sum_up"]);?>
	</TD>
</TR>
<TR valign="top">
	<TD colspan="3" align="center"  >
		<TABLE width="100%" border='1' bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
          <TR>
            <TD colspan="3"><B>ความรุนแรง</B> </TD>
          </TR>
          <TR align="center">
            <TD>Clinic</TD>
            <TD colspan="2">Non - Clinic</TD>
          </TR>
          <TR>
            <TD valign="top"><INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="A" <?php if($arr_edit2["clinic"] == "A") echo " Checked ";?>>
              &nbsp;A มีเหตุการณ์ซึ่งมีโอกาสที่ก่อให้เกิดความคลาดเคลื่อน<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="B" <?php if($arr_edit2["clinic"] == "B") echo " Checked ";?>>
              &nbsp;B  เกิดความคลาดเคลื่อนขึ้นแต่ยังไม่ถึงตัวผู้ป่วย<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="C" <?php if($arr_edit2["clinic"] == "C") echo " Checked ";?>>
              &nbsp;C  เกิดความคลาดเคลื่อนกับผู้ป่วย <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เกิดความคลาดเคลื่อนกับผู้ป่วยไม่เกิดอันตราย <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่มีการรักษา<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="D" <?php if($arr_edit2["clinic"] == "D") echo " Checked ";?>>
              &nbsp;D  เกิดความคลาดเคลื่อนกับผู้ป่วย <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ต้องเฝ้าระวังอาการเพราะมีโอกาสเกิดอันตรายได้ <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ไม่เกิด อันตรายต่อผู้ป่วย<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="E" <?php if($arr_edit2["clinic"] == "E") echo " Checked ";?>>
              &nbsp;E  เกิดความคลาดเคลื่อนกับผู้ป่วย <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ต้องให้การรักษาเพิ่มมากขึ้นจากเหตุการณ์นั้น <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เกิดอันตราย / พิการ  เพียงชั่วคราวต่อผู้ป่วย<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="F" <?php if($arr_edit2["clinic"] == "F") echo " Checked ";?>>
              &nbsp;F  เกิดความคลาดเคลื่อนกับผู้ป่วย <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ต้องให้การรักษา  เกิดอันตราย / พิการ  เพียงชั่วคราว <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ผู้ป่วยต้องอยู่  รพ.นานขึ้น<BR>
            </TD>
            <TD valign="top"><INPUT TYPE="radio" NAME="nonclinic" onClick="clinicandnon(this);"  value="N1" <?php if($arr_edit2["nonclinic"] == "N1") echo " Checked ";?>>
              Near  miss  หรือระดับ 1 <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  เกือบพลาด  ไม่เกิดความเสียหาย<BR>
              <INPUT TYPE="radio" NAME="nonclinic" onClick="clinicandnon(this);"  value="N2" <?php if($arr_edit2["nonclinic"] == "N2") echo " Checked ";?>>
              Low  หรือระดับ 2 <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  มูลค่าความเสียหายต่ำกว่า10,000 บาท<BR>
              <BR>
              <INPUT TYPE="radio" NAME="nonclinic" onClick="clinicandnon(this);"  value="N3" <?php if($arr_edit2["nonclinic"] == "N3") echo " Checked ";?>>
              Intermediate  หรือระดับ 3 <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  มูลค่าความเสียหายตั้งแต่  10,000 ถึง <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;น้อยกว่า  50,000 บาท <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  เกิดอัคคีภัยในขั้นเริ่มต้น<BR>
            </TD>
            <TD align="center"> ส่งรายงานศูนย์พัฒนาคุณภาพ </TD>
          </TR>
          <TR>
            <TD  valign="top"><INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="G" <?php if($arr_edit2["clinic"] == "G") echo " Checked ";?>>
              &nbsp;G  เกิดความคลาดเคลื่อนกับผู้ป่วย <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ต้องให้การรักษา  เกิดความพิการถาวร<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="H" <?php if($arr_edit2["clinic"] == "H") echo " Checked ";?>>
              &nbsp;H  เกิดความคลาดเคลื่อนกับผู้ป่วย <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ต้องให้การรักษา  ทำการกู้ชีวิต / เกือบเสียชีวิต<BR>
              <INPUT TYPE="radio" NAME="clinic" onClick="clinicandnon(this);"  value="I" <?php if($arr_edit2["clinic"] == "I") echo " Checked ";?>>
              &nbsp;I   เกิดความคลาดเคลื่อนกับผู้ป่วย <BR>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ต้องให้การรักษาถึงแก่ชีวิต<BR>
            </TD>
            <TD valign="top"><INPUT TYPE="radio" NAME="nonclinic" onClick="clinicandnon(this);"  value="N4" <?php if($arr_edit2["nonclinic"] == "N4") echo " Checked ";?>>
              High  หรือระดับ 4 <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  มูลค่าความเสียหายตั้งแต่ 50,000 บาท 	    ขึ้นไป <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  เกิดอัคคีภัยที่มากกว่าขั้นเริ่มต้น <br>
              &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;-  Sentinel  Event<BR>
            </TD>
            <TD align="center">รายงานด่วนภายใน 6 ชั่วโมง<BR>
              ผอ.รพค่ายฯ, <BR>
              ทีมจัดการความเสี่ยง</TD>
          </TR>
        </TABLE>	</TD>
</TR>
<TR valign="top">
	<TD colspan="3"  >
		<B>ปัญหาที่พบ/สาเหต</B>ุ : <BR>&nbsp;&nbsp;&nbsp;<?php echo nl2br($arr_edit["problem"]);?>	</TD>
</TR>
<TR valign="top">
	<TD colspan="3"  >
		<B>มาตรการแก้ไขที่ได้ดำเนินการไปแล้ว / มาตรการป้องกัน</B> : <BR>&nbsp;&nbsp;&nbsp;<?php echo nl2br($arr_edit["protect"]);?>	</TD>
</TR>
<TR>
	<TD colspan="3">
	<B>ชื่อผู้ส่ง : </B><?php echo $arr_edit2["send_by"];?>
	&nbsp;&nbsp;&nbsp;&nbsp;<B>ชื่อหัวหน้า : </B><?php echo $arr_edit2["head_name"];?>
	</TD>
</TR>
<TR>
	<TD  colspan="3">
	<B>ฝ่ายคุณภาพ</B><BR>
<INPUT TYPE="radio" NAME="until_quality" value="1" <?php if($arr_edit2["until_quality"] == "1") echo " Checked ";?>>  หาข้อมูลเพิ่มเติม
<INPUT TYPE="radio" NAME="until_quality" value="2" <?php if($arr_edit2["until_quality"] == "2") echo " Checked ";?>>  ติดตามความถี่ของความไม่สอดคล้อง
<INPUT TYPE="radio" NAME="until_quality" value="3" <?php if($arr_edit2["until_quality"] == "3") echo " Checked ";?>>  ออก  CAR / PAR  เลขที่ <?php echo $arr_edit2["no_car"];?>

	</TD>
</TR>
<TR>
	<TD  colspan="3">
	<B>โปรแกรม</B><BR>
	<!--<TABLE>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P1" <?php //if($arr_edit2["program"] == "P1") echo " Checked ";?> readonly> 1. การดูแลรักษาผู้ป่วย</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P6" <?php //if($arr_edit2["program"] == "P6") echo " Checked ";?> readonly>6. อาชีวอนามัยและความปลอดภัยของเจ้าหน้าที่</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P2" <?php //if($arr_edit2["program"] == "P2") echo " Checked ";?> readonly>2. การควบคุมการติดเชื้อในโรงพยาบาล</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P7" <?php //if($arr_edit2["program"] == "P7") echo " Checked ";?> readonly>7. การจัดการโครงสร้างกายภาพและความปลอดภัย</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P3" <?php //if($arr_edit2["program"] == "P3") echo " Checked ";?> readonly>3. การบริหารจัดการด้านยา</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P8" <?php //if($arr_edit2["program"] == "P8") echo " Checked ";?> readonly>8. การพิทักษ์สิ่งแวดล้อม ขยะ น้ำเสีย</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P4" <?php //if($arr_edit2["program"] == "P4") echo " Checked ";?> readonly>4. เครื่องมือและระบบสาธารณูปโภค</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P9" <?php //if($arr_edit2["program"] == "P9") echo " Checked ";?> readonly>9. การป้องกันอัคคีภัยและอุบัติภัย</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P5" <?php //if($arr_edit2["program"] == "P5") echo " Checked ";?> readonly>5. สิทธิผู้ป่วย</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P10" <?php //if($arr_edit2["program"] == "P10") echo " Checked ";?> readonly>10.การจัดเก็บรายได้</TD>
	</TR>
	</TABLE>-->
    <TABLE>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P1" <?php if($arr_edit2["program"] == "P1") echo " Checked ";?> readonly> 1. การดูแลรักษาผู้ป่วย</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P11" <?php if($arr_edit2["program"] == "P11") echo " Checked ";?> readonly>
		  4. เครื่องมือแพทย์</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P2" <?php if($arr_edit2["program"] == "P2") echo " Checked ";?> readonly>2. การควบคุมการติดเชื้อในโรงพยาบาล</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P12" <?php if($arr_edit2["program"] == "P12") echo " Checked ";?> readonly>
		  5. การจัดการสิ่งแวดล้อมและความปลอดภัย</TD>
	</TR>
	<TR>
		<TD><INPUT TYPE="radio" NAME="program" value="P3" <?php if($arr_edit2["program"] == "P3") echo " Checked ";?> readonly>3. การบริหารจัดการด้านยา</TD>
		<TD><INPUT TYPE="radio" NAME="program" value="P10" <?php if($arr_edit2["program"] == "P10") echo " Checked ";?> readonly>
		  6. บริการทั่วไป</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE></TD>
</TR>
</TABLE>

<br>
<br>
</BODY>
</HTML>
