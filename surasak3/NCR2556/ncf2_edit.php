<?php
session_start();


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
</style>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('nonconf_date'));

};

</script>
</HEAD>

<BODY>

<?php
//		include("includes/menu2.in.php");
		include("connect.inc");


		$sendfile = "ncf2_edit2.php";
		$hidden = "";
		$date_now = (date("Y")+543).date("-m-d");
		$nonconf_time1 = date("H");
		$nonconf_time2 = date("i");
	

		$arr_edit["send_by"] = $_SESSION["firstname_now"];
		
		
		$sqlselect="SELECT * FROM `ncr2556` WHERE nonconf_id ='".$_GET['nonconf_id']."'";
		$txtquery=mysql_query($sqlselect);
		$arr_edit=mysql_fetch_array($txtquery);

?>
<!--<SCRIPT LANGUAGE="JavaScript">

	function clinicandnon(xxx){
		
		for(i=0;i<document.f1.clinic.length;i++){
			
			document.f1.clinic[i].checked = false;

		}

		for(i=0;i<document.f1.nonclinic.length;i++){
			
			document.f1.nonclinic[i].checked = false;

		}

		xxx.checked = true;

	}

</SCRIPT>-->
<SCRIPT LANGUAGE="JavaScript">
<!--
function CheckForm(){
	
	var ff = document.f1;

if(document.getElementById('free_event').checked==false){

	if(ff.until.value==""){
		alert("กรุณาเลือก หน่วยงาน ของท่าน");
		ff.until.focus();
		return false;
	
	
	}else if(
		ff.topic1_1.checked == false && ff.topic1_2.checked == false && ff.topic1_3.checked == false && ff.topic1_4.checked == false && ff.topic1_5.checked == false && ff.topic1_6.checked == false  && ff.topic1_7.value.length == 0 && ff.topic2_1.checked == false && ff.topic2_2.checked == false && ff.topic2_3.checked == false && ff.topic2_4.checked == false && ff.topic2_5.checked == false && ff.topic2_6.checked == false && ff.topic2_7.value.length == 0 && ff.topic3_1.checked == false && ff.topic3_2.checked == false && ff.topic3_3.checked == false && ff.topic3_4.value.length == 0 && ff.topic4_1.checked == false && ff.topic4_2.checked == false && ff.topic4_3.checked == false && ff.topic4_4.checked == false && ff.topic4_5.checked == false && ff.topic4_6.value.length == 0 && ff.topic5_1.checked == false && ff.topic5_2.checked == false && ff.topic5_3.checked == false && ff.topic5_4.checked == false && ff.topic5_5.checked == false && ff.topic5_6.checked == false && ff.topic5_7.checked == false && ff.topic5_8.checked == false && ff.topic5_9.checked == false && ff.topic5_10.checked == false && ff.topic5_11.value.length == 0 && ff.topic6_1.checked == false && ff.topic6_2.checked == false && ff.topic6_3.checked == false && ff.topic6_4.checked == false && ff.topic6_5.value.length == 0 && ff.topic7_1.checked == false && ff.topic7_2.checked == false && ff.topic7_3.checked == false && ff.topic7_4.checked == false && ff.topic7_5.checked == false && ff.topic7_6.checked == false  && ff.topic7_7.value.length == 0 && ff.topic8_1.checked == false && ff.topic8_2.checked == false && ff.topic8_3.checked == false && ff.topic8_4.checked == false && ff.topic8_5.checked == false && ff.topic8_6.checked == false && ff.topic8_7.checked == false && ff.topic8_8.checked == false && ff.topic8_9.checked == false && ff.topic8_10.checked == false && ff.topic8_11.value.length == 0
		){
		alert("กรุณาเลือกรายการที่ต้องการแจ้ง");
		return false;
	}else if(ff.clinic1.checked == false && ff.clinic2.checked == false && ff.clinic3.checked == false && ff.clinic4.checked == false && ff.clinic5.checked == false && ff.clinic6.checked == false && ff.clinic7.checked == false && ff.clinic8.checked == false && ff.clinic9.checked == false ){
		alert('กรุณาเลือกความรุนแรง');
		return false;	
	}else if(ff.risk1.checked == false && ff.risk2.checked == false && ff.risk3.checked == false && ff.risk4.checked == false && ff.risk5.checked == false && ff.risk6.checked == false && ff.risk7.checked == false && ff.risk8.checked == false && ff.risk9.checked == false ){
		alert('กรุณาเลือกชนิดของความเสี่ยง');
		return false;	
	}else if(ff.head_name.value==""){
		alert("กรุณากรอกชื่อหัวหน้า ");
		ff.head_name.focus();
		return false;
	}else{
		return true;
	}
	
}else{
	return true;
}

}

//-->
</SCRIPT>

<script type='text/javascript'>
	function clearRdo(){
		tag =document.getElementsByName('event');
		for(i=0;i<tag.length;i++){
			if(tag[i].id=='event'){
				tag[i].checked= false;
			}
		}
	}
function clearChecks(radioName) {
    var radio = document.f1[radioName]
    for(x=0;x<radio.length;x++) {
        document.f1[radioName][x].checked = false
    }
}

</script>
<FORM Name="f1" METHOD='post' POST ACTION="<?php echo $sendfile;?>" Onsubmit="return CheckForm();" target="_blank">

<TABLE align="center" border="1" bordercolor="#3366FF">
<TR>
	<TD bgcolor="#3366FF" align="center">
		<FONT SIZE="1" COLOR="#FFFFFF"><B>บันทึกรายงานเหตุการณ์สำคัญ/อุบัติการณ์/ความไม่สอดคล้อง ( Non - Conforming Report )</B></FONT>
	</TD>
</TR>
<TR>
  <TD bgcolor="#3366FF" align="center"><FONT SIZE="1" COLOR="#FFFFFF">ศูนย์พัฒนาคุณภาพ เอกสารหมายเลข FR-QMR -009/1 ,06, 3 ม.ค. 56</FONT></TD>
</TR>
<TR>
	<TD>
<TABLE border="0" width="800">
<TR valign="top">
  <TD>
    <TABLE bgcolor="#FFCAB0" height="115" width="98%">
      <TR>
        <TD>
          เลขที่ NCR : <INPUT TYPE="text" NAME="ncr" size="10" value="<?=$arr_edit["ncr"];?>"><BR>
          หน่วยงาน / ทีม : <SELECT NAME="until">
            <Option value="">--------------</Option>
            <?php
										$sql="SELECT * FROM `departments` where status='y' ";
										$query=mysql_query($sql);
										while($arr=mysql_fetch_array($query)){
											
											if($arr_edit["until"]==$arr['code']){
											echo "<option value='$arr[code]' selected>$arr[name]</option> ";
											}else{
											echo "<option value='$arr[code]' >$arr[name]</option> ";	
											}
										}
									?>
            </SELECT>
          
          <BR>
          วันที่ : <INPUT ID="nonconf_date" TYPE="text" NAME="nonconf_date" size="10" value="<?=$arr_edit["nonconf_date"];?>" readonly>&nbsp;
          
          เวลา : <INPUT TYPE="hidden" name="nonconf_time">
          <?
		  $timea=substr($arr_edit["nonconf_time"],0,5);
		  $timeb=explode(':',$timea);
		 
		  
		  ?>
          <SELECT NAME="nonconf_time1">
            <?php 
				
				
				
				
			
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($timeb[0] == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
            </SELECT>:
          <SELECT NAME="nonconf_time2">
            <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($timeb[1] == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
            </SELECT>
          
          <br>
  <!--<strong>บันทึกรายงาน</strong> <br>

		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="เหตุการณ์สำคัญ" <?//php if($arr_edit["type"] == "เหตุการณ์สำคัญ") echo " Checked ";?>>&nbsp;เหตุการณ์สำคัญ<br>
		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="อุบัติการณ์" <?//php if($arr_edit["type"] == "อุบัติการณ์") echo " Checked ";?>>&nbsp;อุบัติการณ์<br>
		&nbsp;&nbsp;&nbsp; <input name="type" type="radio" value="ความไม่สอดคล้อง" <?//php if($arr_edit["type"] == "ความไม่สอดคล้อง") echo " Checked ";?>>&nbsp;ความไม่สอดคล้อง<br>-->เดือนที่รายงาน: 
        <? if($arr_edit["nonconf_dategroup"]==""){ 
			$arr_edit["nonconf_dategroup"]=(date("Y")+543).date("-m");
			}else{
			$arr_edit["nonconf_dategroup"]=$arr_edit["nonconf_dategroup"];
		}
		?>
          <INPUT ID="nonconf_dategroup" TYPE="text" NAME="nonconf_dategroup" size="10" value="<?=$arr_edit["nonconf_dategroup"];?>">
          </TD>
        </TR>
      </TABLE>
    </TD>
  <TD colspan="2">
    <TABLE  height="115" width="100%" bgcolor="#FFCAB0">
      <TR  valign="top">
        <TD><B>ที่มา</B></TD>
        <TD>
          <INPUT TYPE="radio" NAME="come_from_id" value="1"  <?php if($arr_edit["come_from_id"] == "1") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;ENV ROUND<BR>
          <INPUT TYPE="radio" NAME="come_from_id" value="2"  <?php if($arr_edit["come_from_id"] == "2") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;IC ROUND<BR>
          <INPUT TYPE="radio" NAME="come_from_id" value="3"  <?php if($arr_edit["come_from_id"] == "3") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;RM ROUND<BR>
          
          </TD>
        <TD>
          <INPUT TYPE="radio" NAME="come_from_id" value="4"  <?php if($arr_edit["come_from_id"] == "4") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;12 กิจกรรมทบทวน<BR>
          <INPUT TYPE="radio" NAME="come_from_id" value="5"  <?php if($arr_edit["come_from_id"] == "5") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='none';}">&nbsp;หน่วยรายงานเอง<BR>
          <INPUT TYPE="radio" NAME="come_from_id" value="6"  <?php if($arr_edit["come_from_id"] == "6") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.come_from_detail.style.display='';}">&nbsp;อื่นๆ&nbsp;&nbsp;<INPUT TYPE="text" id="come_from_detail"NAME="come_from_detail" value="<?php echo $arr_edit["come_from_detail"];?>" style="display:none"><BR>
          </TD>
        </TR>
      </TABLE>
    
    </TD>
</TR>
<TR valign="top">
  <TD colspan="3" bgcolor="#CCCCCC" ><strong style="font-weight:bold;">เหตุการณ์ (ให้ทำเครื่องหมายถูกในช่องสี่เหลี่ยมทุกข้อที่เกิดขึ้นเพื่ออธิบายเหตุการณ์ที่เกิดขึ้น)</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3" bgcolor="#CCCCCC" ><strong style="font-weight:bold;">Sentinel Event ที่ต้องรายงานด่วนภายใน 6 ชั่วโมง ต่อ ผอ.รพ.ค่ายฯ หรือ ทีมจัดการความเสี่ยง</strong></TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="1" <?php if($arr_edit["event"] == "1") echo " Checked ";?>>
    1.ผู้ป่วยเสียชีวิตจากการฆ่าตัวตาย</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="6" <?php if($arr_edit["event"] == "6") echo " Checked ";?>>
    6.ผู้ป่วยได้รับผลกระทบหรือความเสียหายอาจถึงพิการหรือเสียชีวิต อันเป็นเหตุความบกพร่องของอุปกรณ์/เครื่องมือทางการแพทย์ รวมถึงจากบุคลากรทางการแพทย์/กระบวนการรักษาในโรงพยาบาล </TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="2" <?php if($arr_edit["event"] == "2") echo " Checked ";?>>
  2.การเสียชีวิตจากการให้เลือดผิดหมู่ ผิดคน</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="7" <?php if($arr_edit["event"] == "7") echo " Checked ";?>> 
  7.การมีสิ่งของ/อุปกรณ์ตกค้างอยู่ในร่างกายผู้ป่วย
</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="3" <?php if($arr_edit["event"] == "3") echo " Checked ";?>> 
    3.ผู้ป่วยเสียชีวิตซึ่งไม่เกี่ยวกับการดำเนินของโรคหรือการเจ็บป่วยในขณะนั้น
</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="8" <?php if($arr_edit["event"] == "8") echo " Checked ";?>> 
    8.การทำร้ายร่างกาย/ข่มขืนหรือล่วงเกินทางเพศ/ฆาตกรรมในโรงพยาบาล
</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="4" <?php if($arr_edit["event"] == "4") echo " Checked ";?>> 
    4.การผ่าตัดผิดตำแหน่ง / ผิดประเภท / ผ่าตัดผิดคน
</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="9" <?php if($arr_edit["event"] == "9") echo " Checked ";?>> 
    9.การลักพาตัวทารก/การส่งมอบทารกผิดครอบครัว</TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0"><input name="event" type="radio" id="event" value="5" <?php if($arr_edit["event"] == "5") echo " Checked ";?>> 
    5.ผู้ป่วยสูญเสียหน้าที่การทำงานของร่างกายหรือมีทุพลภาพอย่างถาวรโดยไม่เกี่ยวข้องกับการดำเนินของโรคหรือการเจ็บป่วยในขณะนั้น
</TD>
  <TD colspan="2" bgcolor="#FFCAB0"><a href="javascript:clearChecks('event')">clear</a>
    เคลียร์ค่า <strong style="font-weight:bold;">Sentinel Event</strong></TD>
</TR>
<TR valign="top">
  <TD bgcolor="#FFCAB0">&nbsp;</TD>
  <TD colspan="2" bgcolor="#FFCAB0">&nbsp;</TD>
</TR>
<TR  valign="top">
  <TD valign="top">
    <TABLE bgcolor="#FFCAB0" width='100%'>
      <TR>
        <TD>
          <B>1. ความปลอดภัย / ตก/ หกล้ม</B><BR>
          <INPUT TYPE="checkbox" NAME="topic1_1" value="1" <?php if($arr_edit["topic1_1"] == "1") echo " Checked ";?>> 1. ล้ม<BR>
          <INPUT TYPE="checkbox" NAME="topic1_2" value="1" <?php if($arr_edit["topic1_2"] == "1") echo " Checked ";?>> 2. พบว่านอนอยู่บนพื้น<BR>
          <INPUT TYPE="checkbox" NAME="topic1_3" value="1" <?php if($arr_edit["topic1_3"] == "1") echo " Checked ";?>> 3. ตกจากเตียง/เก้าอื้/โต๊ะ<BR>
          <INPUT TYPE="checkbox" NAME="topic1_4" value="1" <?php if($arr_edit["topic1_4"] == "1") echo " Checked ";?>> 4. เครื่องรัดตรึงหลุด<BR>
          <INPUT TYPE="checkbox" NAME="topic1_5" value="1" <?php if($arr_edit["topic1_5"] == "1") echo " Checked ";?>> 5. ปีนข้ามไม้กั้นเตียง<BR>
          <INPUT TYPE="checkbox" NAME="topic1_6" value="1" <?php if($arr_edit["topic1_6"] == "1") echo " Checked ";?>> 
          6. พลัดตกระหว่างการเคลื่อนย้าย<BR>
          
          <TABLE cellpadding="0" cellspacing="0">
            <TR valign="top">
              <TD>&nbsp;&nbsp;</TD>
              <TD><TEXTAREA NAME="topic1_7" ROWS="4" COLS="21" ><?php echo $arr_edit["topic1_7"];?></TEXTAREA></TD>
              </TR>
            </TABLE>
          </TD>
        </TR>
      </TABLE><BR>
  <TABLE bgcolor="#FFCAB0" width='100%'>
  <TR>
    <TD>
      <B>2. การติดต่อสื่อสาร</B><BR>
      <INPUT TYPE="checkbox" NAME="topic2_1" value="1" <?php if($arr_edit["topic2_1"] == "1") echo " Checked ";?>> 1. ไม่มีรายงานผล Lab/Film X-ray ด่วน<BR>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;หรือ ผิดปกติ<BR>
      <INPUT TYPE="checkbox" NAME="topic2_2" value="1" <?php if($arr_edit["topic2_2"] == "1") echo " Checked ";?>> 2. ไม่มีรายงานแพทย์/แพทย์ไม่ตอบ<BR>
      <INPUT TYPE="checkbox" NAME="topic2_3" value="1" <?php if($arr_edit["topic2_3"] == "1") echo " Checked ";?>> 3. ปฏิบัติไม่ถูกต้องตามคำสั่ง<BR>
      <INPUT TYPE="checkbox" NAME="topic2_4" value="1" <?php if($arr_edit["topic2_4"] == "1") echo " Checked ";?>> 4. เวชระเบียนไม่สมบูรณ์<BR>
      <INPUT TYPE="checkbox" NAME="topic2_5" value="1" <?php if($arr_edit["topic2_5"] == "1") echo " Checked ";?>> 5. ใบยินยอมไม่ตรงกับหัตถการ<BR>
      <INPUT TYPE="checkbox" NAME="topic2_6" value="1" <?php if($arr_edit["topic2_6"] == "1") echo " Checked ";?>> 6. ทำหัตถการโดยไม่มีใบยินยอม<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic2_7" ROWS="4" COLS="21" ><?php echo $arr_edit["topic2_7"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
  <BR>
  <TABLE bgcolor="#FFCAB0" width='100%' height="236">
  <TR>
    <TD valign="top">
      <B>3. เลือด</B><BR>
      <INPUT TYPE="checkbox" NAME="topic3_1" value="1" <?php if($arr_edit["topic3_1"] == "1") echo " Checked ";?> > 1. ผิดคน<BR>
      <INPUT TYPE="checkbox" NAME="topic3_2" value="1" <?php if($arr_edit["topic3_2"] == "1") echo " Checked ";?> > 2. ภาวะแทรกซ้อนจากการให้เลือด<BR>
      <INPUT TYPE="checkbox" NAME="topic3_3" value="1" <?php if($arr_edit["topic3_3"] == "1") echo " Checked ";?> > 3. แพ้เลือด<BR>
      <TABLE cellpadding="0" cellspacing="0">
        <TR valign="top">
          <TD>&nbsp;&nbsp;</TD>
          <TD><TEXTAREA NAME="topic3_4" ROWS="4" COLS="21" ><?php echo $arr_edit["topic3_4"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
    
    </TD>
  <TD>
  <TABLE bgcolor="#FFCAB0" width='100%'>
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
          <TD><TEXTAREA NAME="topic4_6" ROWS="4" COLS="21" ><?php echo $arr_edit["topic4_6"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE><BR>
  <TABLE bgcolor="#FFCAB0" width='100%'>
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
          <TD><TEXTAREA NAME="topic5_11" ROWS="4" COLS="21" ><?php echo $arr_edit["topic5_11"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
  <BR>
  <TABLE bgcolor="#FFCAB0" width='100%'>
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
          <TD><TEXTAREA NAME="topic6_5" ROWS="4" COLS="21" ><?php echo $arr_edit["topic6_5"];?></TEXTAREA></TD>
          </TR>
        </TABLE>
  </TD>
  </TR>
  </TABLE>
    </TD>
  <TD>
    
  <TABLE bgcolor="#FFCAB0" width='100%'>
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
            <TD><TEXTAREA NAME="topic7_7" ROWS="4" COLS="21" ><?php echo $arr_edit["topic7_7"];?></TEXTAREA></TD>
            </TR>
          </TABLE>
  </TD>
      </TR>
    </TABLE>
    <BR>
    
    <TABLE bgcolor="#FFCAB0" width='100%'>
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
              <TD><TEXTAREA NAME="topic8_11" ROWS="4" COLS="21" ><?php echo $arr_edit["topic8_11"];?></TEXTAREA></TD>
              </TR>
            </TABLE>
          
  </TD>
        </TR>
      </TABLE>
    
    <BR>
    
    <!-- <TABLE bgcolor="#FFCAB0" width='100%'>
	<TR>
		<TD>
	<B>9. อื่น ๆ</B><BR>
		
		<TABLE cellpadding="0" cellspacing="0">
		<TR valign="top">
			<TD>&nbsp;&nbsp;</TD>
			<TD><TEXTAREA NAME="topic9_1" ROWS="4" COLS="21" ><?php //echo $arr_edit["topic9_1"];?></TEXTAREA></TD>
		</TR>
		</TABLE>

</TD>
	</TR>
	</TABLE> -->
    
    </TD>
</TR>
<!--<TR>
	<TD bgcolor="#FFCAB0">-->
		<!--<B>ธรรมชาติของการบาดเจ็บ</B><BR>
		<INPUT TYPE="radio" NAME="type_injured" value="1" <?//php if($arr_edit["type_injured"] == "1") echo " Checked ";?> > 1.  กระดูกและกล้ามเนื้อ<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="2" <?//php if($arr_edit["type_injured"] == "2") echo " Checked ";?> > 2. ผิวหนัง<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="3" <?//php if($arr_edit["type_injured"] == "3") echo " Checked ";?> > 3. ประสาทส่วนกลาง<BR>
		<INPUT TYPE="radio" NAME="type_injured" value="4" <?//php if($arr_edit["type_injured"] == "4") echo " Checked ";?> > 4. หัวใจและปอด-->
	<!--</TD>
	<TD bgcolor="#FFCAB0">-->
		<!--<B>บันทึกในเวชระเบียน</B> <INPUT TYPE="radio" NAME="save_in_medical_record" value="1" <?//php if($arr_edit["save_in_medical_record"] == "1") echo " Checked ";?> > ทำ &nbsp;&nbsp;&nbsp;&nbsp; <INPUT TYPE="radio" NAME="save_in_medical_record" value="0" <?//php if($arr_edit["save_in_medical_record"] == "0") echo " Checked ";?> > ไม่ทำ<BR>
		รายงานแพทย์ : <BR>&nbsp;&nbsp;<TEXTAREA NAME="tell_doctor" ROWS="4" COLS="21"><?//php echo $arr_edit["tell_doctor"];?></TEXTAREA>-->
	<!--</TD>
	<TD bgcolor="#FFCAB0">-->
		<!--แพทย์ผู้ประเมิน : <INPUT TYPE="text" NAME="estimate_doctor" value="<?//php echo $arr_edit["estimate_doctor"];?>"><BR>
		ผลการประเมิน<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="1" <?//php if($arr_edit["estimate_result"] == "1") echo " Checked ";?> >&nbsp;ไม่มีการบาดเจ็บ<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="2" <?//php if($arr_edit["estimate_result"] == "2") echo " Checked ";?> >&nbsp;ไม่เห็นการบาดเจ็บชัดเจน<BR>
		<INPUT TYPE="radio" NAME="estimate_result" value="3" <?//php if($arr_edit["estimate_result"] == "3") echo " Checked ";?> >&nbsp;ต้องอยู่ รพ. นานขึ้น<BR>-->
<!--	</TD>
</TR>-->
<TR valign="top">
	<TD colspan="3"  bgcolor="#FFCAB0">
		<B>บรรยายสรุปเหตุการณ์</B> : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="sum_up" ROWS="6" COLS="60"><?php echo $arr_edit["sum_up"];?></TEXTAREA>
	</TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><TABLE width="100%" border='1' bordercolor="#000000" style='BORDER-COLLAPSE: collapse'>
    <TR>
      <TD colspan="3"><B>ความรุนแรง</B></TD>
    </TR>
    <TR>
      <TD><input type="radio" Name="clinic"   id="clinic1" value="A" <?php if($arr_edit["clinic"] == "A") echo " Checked ";?>>
        &nbsp;A มีเหตุการณ์ซึ่งมีโอกาสที่ก่อให้เกิดความคลาดเคลื่อน หรืออาจเกิดภายในหน่วยงาน แต่ยังไม่เกิด<br>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic2"  value="B" <?php if($arr_edit["clinic"] == "B") echo " Checked ";?>>
        &nbsp;B  เกิดความคลาดเคลื่อนขึ้น ซึ่งไม่ถึงผู้ป่วย/รพ./เจ้าหน้าที่ และยังไม่มีความเสียหายใด</TD>
      <td width="10%" align="center" valign="top" class="fonttable">ระดับ 1<br />
        เกือบพลาด <br /></td>
      <TD rowspan="3" align="center"> ส่งรายงานศูนย์พัฒนาคุณภาพ </TD>
    </TR>
    <TR>
      <TD><INPUT TYPE="radio" NAME="clinic" id="clinic3"  value="C" <?php if($arr_edit["clinic"] == "C") echo " Checked ";?>>
        &nbsp;C  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ แต่ไม่ได้รับอันตรายหรือเสื่อมเสียชื่อเสียง ทรัพย์สินเสียหายเล็กน้อย มูลค่าไม่เกิน 2,000 บาท</TD>
      <td align="center" class="fonttable">ระดับ 2<br />
        น้อย</td>
      </TR>
    <TR>
      <TD valign="top"><INPUT TYPE="radio" NAME="clinic"  id="clinic4" value="D" <?php if($arr_edit["clinic"] == "D") echo " Checked ";?>>
        &nbsp;D  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ ซึ่งต้องเฝ้าระวัง / ติดตามเพิ่มเติม ชื่อเสียงภาพพจน์เสียหาย เกิดความไม่ไว้วางใจจากผู้ป่วยและความไม่สะดวกขณะรับบริการ ทรัพย์สินเสียหายเล็กน้อยมูลค่า 2,000 -5,000 บาท<BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic5" value="E" <?php if($arr_edit["clinic"] == "E") echo " Checked ";?>>
        &nbsp;E  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ ส่งผลให้เกิดอันตรายชั่วคราวและต้องมีการบำบัดรักษา เกิดความไม่ไว้วางใจ จากบริษัทประกัน /หน่วยงานของรัฐ ทรัพย์สินเสียหายมากกว่า 5,000 - 15,000 บาท <BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic6" value="F" <?php if($arr_edit["clinic"] == "F") echo " Checked ";?>>
        &nbsp;F  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ ส่งผลให้เกิดอันตรายชั่วคราว และต้องนอนโรงพยาบาลหรืออยู่โรงพยาบาลนานขึ้น เกิดความไม่ไว้วางใจจากบริษัทประกัน / หน่วยงานของรัฐ ต้องหยุดงานมากกว่า 3 วัน ทรัพย์สินเสียหายมากกว่า 15,000 บาทแต่ไม่เกิน 30,000 บาท</TD>
      <td align="center" class="fonttable">ระดับ 3 <br />
        ปานกลาง</td>
      </TR>
    <TR>
      <TD  valign="top"><INPUT TYPE="radio" NAME="clinic"  id="clinic7" value="G" <?php if($arr_edit["clinic"] == "G") echo " Checked ";?>>
        &nbsp;G  เกิดความคลาดเคลื่อนกับผู้ป่วย /รพ./เจ้าหน้าที่ ส่งผลให้เกิดอันตรายถาวร ทรัพย์สินเสียหาย มีมูลค่ามากกว่า 30,000 บาท แต่ไม่เกิน 50,000 บาท ชื่อเสียงภาพพจน์เสียหายปรากฏในสื่อสาธารณะ<BR>
        <INPUT TYPE="radio" NAME="clinic"  id="clinic8" value="H" <?php if($arr_edit["clinic"] == "H") echo " Checked ";?>>
        &nbsp;H  เกิดความคลาดเคลื่อนกับผู้ป่วย  /รพ./เจ้าหน้าที่ ส่งผลให้ต้องทำการช่วยชีวิต การบาดเจ็บ/เจ็บป่วยจากงานในระดับรุนแรง ทรัพย์สินเสียหาย มีมูลค่ามากกว่า 50,000 แต่ไม่เกิน 100,000 บาท ชื่อเสียงภาพพจน์เสียหายปรากฏในสื่อสาธารณะ<BR>
        <INPUT TYPE="radio" NAME="clinic" id="clinic9"  value="I" <?php if($arr_edit["clinic"] == "I") echo " Checked ";?>>
        &nbsp;I   เกิดความคลาดเคลื่อนกับผู้ป่วย   /รพ./เจ้าหน้าที่  ซึ่งเป็นสาเหตุของการเสียชีวิต ทรัพย์สินเสียหาย มีมูลค่ามากกว่า 100,000 บาท ชื่อเสียงภาพพจน์เสียหายปรากฏในสื่อสาธารณะ/ถูกฟ้องร้องต่อองค์กรวิชาชีพ<BR></TD>
      <td align="center" class="fonttable">ระดับ 4 <br />
        มาก</td>
      <TD align="center">รายงานด่วนภายใน 6 ชั่วโมง<BR>
        ผอ.รพค่ายฯ, <BR>
        ทีมจัดการความเสี่ยง</TD>
    </TR>
    <TR>
      <TD colspan="3" align="center"  valign="top"><a href="javascript:clearChecks('clinic')">clear</a></TD>
      </TR>
  </TABLE></TD>
</TR>
<TR valign="top">
	<TD colspan="3"  bgcolor="#FFCAB0">
		<B>ปัญหาที่พบ/สาเหตุ</B> : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="problem" ROWS="6" COLS="60"><?php echo $arr_edit["problem"];?></TEXTAREA>
	</TD>
</TR>
<TR valign="top">
	<TD colspan="3"  bgcolor="#FFCAB0">
		<B>มาตรการแก้ไขที่ได้ดำเนินการไปแล้ว / มาตรการป้องกัน</B> : <BR>&nbsp;&nbsp;&nbsp;<TEXTAREA NAME="protect" ROWS="6" COLS="60"><?php echo $arr_edit["protect"];?></TEXTAREA>
	</TD>
</TR>

<TR>
  <TD colspan="3" bgcolor="#FFCAB0">&nbsp;</TD>
</TR>

<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><B>ลงชื่อ </B>
    <INPUT NAME="head_name" TYPE="text" value="<?php echo $arr_edit["head_name"];?>" size="40">
    หัวหน้าหน่วยงาน </TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0">&nbsp;</TD>
</TR>
<?
 if($_SESSION["statusncr"]=='admin'){
 ?>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><strong>ฝ่ายคุณภาพ</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><input name="quality" type="radio" id="quality1" onClick="javaScript:if(this.checked){document.all.cpno.style.display='none';}" value="1" <?php if($arr_edit["quality"] == "1") echo " Checked ";?>>
    หาข้อมูลเพิ่มเติม 
      <input name="quality" type="radio" id="quality2" onClick="javaScript:if(this.checked){document.all.cpno.style.display='none';}" value="2" <?php if($arr_edit["quality"] == "2") echo " Checked ";?>>
ติดตามความถี่ของความไม่สอดคล้อง 
<input name="quality" type="radio" id="quality3" onClick="javaScript:if(this.checked){document.all.cpno.style.display='';}" value="3" <?php if($arr_edit["quality"] == "3") echo " Checked ";?>> 
ออก CAR / PAR เลขที่ 
<input type="text" name="cpno" id="cpno"  value="<?=$arr_edit["cpno"];?>"></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0">&nbsp;</TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><strong>ชนิดของความเสี่ยง</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><table border="0">
    <tr>
      <td><input name="risk1" type="checkbox" id="risk1" value="1" <?php if($arr_edit["risk1"] == "1") echo " Checked ";?>> 
      1.Clinical Risk
</td>
      <td><input name="risk6" type="checkbox" id="risk6" value="1" <?php if($arr_edit["risk6"] == "1") echo " Checked ";?>> 
        6.Customer Complaint Risk
</td>
    </tr>
    <tr>
      <td><input name="risk2" type="checkbox" id="risk2" value="1" <?php if($arr_edit["risk2"] == "1") echo " Checked ";?>> 
        2.Infection control Risk
</td>
      <td><input name="risk7" type="checkbox" id="risk7" value="1" <?php if($arr_edit["risk7"] == "1") echo " Checked ";?>> 
        7.Financial Risk
</td>
    </tr>
    <tr>
      <td><input name="risk3" type="checkbox" id="risk3" value="1" <?php if($arr_edit["risk3"] == "1") echo " Checked ";?>> 
        3.Medication Risk
</td>
      <td><input name="risk8" type="checkbox" id="risk8" value="1" <?php if($arr_edit["risk8"] == "1") echo " Checked ";?>> 
        8.Utilization Management Risk
</td>
    </tr>
    <tr>
      <td><input name="risk4" type="checkbox" id="risk4" value="1" <?php if($arr_edit["risk4"] == "1") echo " Checked ";?>> 
        4.Medical Equipment Risk
</td>
      <td><input name="risk9" type="checkbox" id="risk9" value="1" <?php if($arr_edit["risk9"] == "1") echo " Checked ";?>> 
        9.Information Risk</td>
    </tr>
    <tr>
      <td><input name="risk5" type="checkbox" id="risk5" value="1" <?php if($arr_edit["risk5"] == "1") echo " Checked ";?>> 
        5.Safety and Environment Risk
</td>
      <td>&nbsp;</td>
    </tr>
    <? }?>
  </table></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><strong>Patient Safety Goal</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><input name="pro_f" type="checkbox" id="pro_f" value="1" <?php if($arr_edit["pro_f"] == "1") echo " Checked ";?>>
    F 
      <input name="pro_b" type="checkbox" id="pro_b" value="1" <?php if($arr_edit["pro_b"] == "1") echo " Checked ";?>> 
      B 
      <input name="pro_i" type="checkbox" id="pro_i" value="1" <?php if($arr_edit["pro_i"] == "1") echo " Checked ";?>> 
      I 
      <input name="pro_t" type="checkbox" id="pro_t" value="1" <?php if($arr_edit["pro_t"] == "1") echo " Checked ";?>> 
      T 
      <input name="pro_s" type="checkbox" id="pro_s" value="1" <?php if($arr_edit["pro_s"] == "1") echo " Checked ";?>> 
      S
      <input name="pro_otherchk" type="checkbox" id="pro_otherchk" value="1" <?php if($arr_edit["pro_other"] != "") echo " Checked ";?> onClick="javaScript:if(this.checked){document.all.spName.style.display='';}else{ document.all.spName.style.display='none'; }">
      อื่นๆ <span id="spName" style="display:none;">ระบุ
      <input type="text" name="pro_other" id="pro_other" value="<?=$arr_edit["pro_other"];?>"></span></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><strong>สถานะการส่งกลับ</strong></TD>
</TR>
<TR valign="top">
  <TD colspan="3"  bgcolor="#FFCAB0"><input name="return" type="checkbox" id="return" value="1" <?php if($arr_edit["return"] == "1") echo " Checked ";?>>
    สถานะการส่งกลับศูนย์คุณภาพ</TD>
</TR>
<TR valign="top">
  <TD colspan="3" align="center"  bgcolor="#FFCAB0"><input name="free_event"   type="checkbox" id="free_event" value="1" <?php if($arr_edit["free_event"] == "1") echo " Checked ";?>>
    กรณี รายงานเหตุการณ์ ไม่มีความเสี่ยง,ไม่มีความรุนแรง</TD>
</TR>
<?
		if($_SESSION["statusncr"]=='admin'){
	  ?> 
<TR valign="top">
  <TD colspan="3" align="center"  bgcolor="#FFCAB0"><input name="accept" type="checkbox" id="accept" value="A" <?php if($arr_edit["accept"] == "A") echo " Checked ";?>>
    ยืนยันข้อมูลใบรายงานเหตุการณ์สำคัญฯ</TD>
</TR>
<? } ?>
<TR>
	<TD colspan="3" bgcolor="#FFCAB0"><!--<B>ชื่อผู้ส่ง</B> <INPUT TYPE="text" NAME="send_by" value="<?//php echo $arr_edit["send_by"];?>">--></TD>
</TR>

<TR>
	<TD colspan="3" align="center"><INPUT TYPE="hidden" value="<?=$arr_edit["nonconf_id"];?>" name="nonconf_id"> <INPUT TYPE="submit" value="บันทึกข้อมูล"></TD>
</TR>
</TABLE>
</TD>
</TR>
</TABLE>
<INPUT TYPE="hidden" value="<?php echo $_SESSION["smenucode"];?>" name="menucode">
<INPUT TYPE="hidden" value="<?php  if(empty($_SESSION["Userncr"])){echo $_SESSION["sOfficer"];}else{echo $_SESSION["Namencr"];}?>" name="officer">
<?php
	echo $hidden;
?>
</FORM>
</BODY>
</HTML>
