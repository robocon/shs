<?php
session_start();
include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
.txtform {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<form action="<?=$PHP_SELF;?>" method="post" name="form1">
<input name="act" type="hidden" value="show">
<table width="100%" border="0" align="center" cellpadding="0" cellspacing="0">
  <tr>
    <td colspan="3" align="center"><strong>กรุณากรอก HN เพื่อค้นหาข้อมูล</strong></td>
    </tr>
  <tr>
    <td width="43%" align="right"><strong>HN&nbsp;:</strong>&nbsp;</td>
    <td width="13%"><label>
      <input name="hn" type="text" class="txtform" id="hn">
    </label></td>
    <td width="44%"><label>
      &nbsp;
      <input name="button" type="submit" class="txtform" id="button" value="  ค้นหา  ">
    </label></td>
  </tr>
  <tr>
    <td colspan="3" align="center"><a target=_self  href='../nindex.htm'>กลับสู่หน้าเมนูหลัก</a></td>
    </tr>
</table>
</form>
<?
if($_POST["act"]=="show"){

	////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
	$result = mysql_query($query) or die("Query failed");
		
		for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			if (!mysql_data_seek($result, $i)) {
				echo "Cannot seek to row $i\n";
				continue;
			}
				if(!($row = mysql_fetch_object($result)))
				continue;
		}
		
		$nPrefix=$row->prefix;
		$chkupyear="25$nPrefix";
	////*runno ตรวจสุขภาพ*/////////

$sql="select * from condxofyear_so where hn='$_POST[hn]' and yearcheck='$chkupyear' order by row_id desc limit 1";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
if($num < 1){
	echo "<script>alert('!!! ผิดพลาด...ไม่พบ HN ที่ท่านต้องการค้นหา');window.location='screen_chkupsolider.php';</script>";
}
$rows=mysql_fetch_array($query);

	$sql1="select * from opcard where hn='$rows[hn]'";
	$query1=mysql_query($sql1);
	$result=mysql_fetch_array($query1);
	list($dy,$dm,$dd)=explode("-",$result["dbirth"]);
	$dy=$dy-543;
	$birhtday="$dy-$dm-$dd";
?>
<div style="border:#000000 solid 1px; margin-left: 10px; margin-right: 10px;">
<form name="form2" method="post" action="">
<table width="90%" border="0" align="center" cellpadding="5" cellspacing="5" >
  <tr>
    <td align="center"><strong>สำรวจและคัดกรองความเสี่ยงต่อสุขภาพประจำปี 
        <?=$chkupyear;?>
    </strong></td>
  </tr>
  <tr>
    <td align="center">&nbsp;</td>
  </tr>
  <tr>
    <td align="right">เลขที่
      <input name="no" type="text" class="txtform" id="no" autofocus>      </td>
  </tr>
  <tr>
    <td align="right">หน่วยบริการที่ให้บริการตรวจคัดกรอง
      <input name="hospital" type="text" class="txtform" id="hospital" value="โรงพยาบาลค่ายสุรศักดิ์มนตรี">
      &nbsp;เลขที่สถานพยาบาล 
      <input name="hcode" type="text" class="txtform" id="hcode" value="11512" maxlength="5"></td>
  </tr>
  <tr>
    <td align="right">วันที่ตรวจ&nbsp;
      <input name="datechkup" type="text" class="txtform" id="datechkup" value="<?=date("Y-m-d");?>"></td>
  </tr>
  <tr>
    <td align="left"><strong>ข้อมูลทั่วไป</strong></td>
  </tr>
  <tr>
    <td align="left">หมายเลขบัตรประจำตัวประชาชน 
      <input name="idcard" type="text" class="txtform" id="idcard" value="<?=$result["idcard"];?>" maxlength="13"></td>
  </tr>
  <tr>
    <td align="left">ยศชื่อ 
      <input name="name" type="text" class="txtform" id="name" value="<?=$result["yot"]." ".$result["name"];?>">
      &nbsp;นามสกุล 
      <input name="surname" type="text" class="txtform" id="surname" value="<?=$result["surname"];?>">
      &nbsp;
      <input name="type" type="radio" id="radio" value="1" checked>
      ข้าราชการ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="type" id="radio2" value="2">
      ลูกจ้างประจำ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="type" id="radio3" value="3">
      พนักงานราชการ</td>
  </tr>
  <tr>
    <td align="left">วันเดือนปีเกิด 
      <input name="birthday" type="text" class="txtform" id="birthday" value="<?=$birhtday;?>">
      &nbsp;อายุ 
      <input name="age" type="text" class="txtform" id="age" value="<?=$rows["age"];?>"></td>
  </tr>
  <tr>
    <td align="left">ที่อยู่ปัจจุบัน 
      <input name="address" type="text" class="txtform" id="address" value="<?=$result["address"];?>" size="10">
      &nbsp;ตำบล 
      <input name="tambol" type="text" class="txtform" id="tambol" value="<?=$result["tambol"];?>" size="15">      
      &nbsp;อำเภอ 
      <input name="ampur" type="text" class="txtform" id="ampur" value="<?=$result["ampur"];?>" size="15">
      &nbsp;จังหวัด 
      <input name="changwat" type="text" class="txtform" id="changwat" value="<?=$result["changwat"];?>" size="15">
      &nbsp;รหัสไปรษณย์ 
      <input name="zipcode" type="text" class="txtform" id="zipcode" value="" size="10"></td>
  </tr>
  <tr>
    <td align="left">โทรศัพท์ที่ทำงาน 
      <input name="telwork" type="text" class="txtform" id="telwork" value="">
      &nbsp;โทรศัพท์มือถือ 
      <input name="tel" type="text" class="txtform" id="tel" value="<?=$result["phone"];?>"></td>
  </tr>
  <tr>
    <td align="left"><strong>1. ประวัติส่วนบุคคล</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left: 20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="9%">เพศ</td>
          <td width="15%"><input type="radio" name="gender" id="radio4" value="m" <? if($result["sex"]=="ช"){ echo "checked";}?>>
            ชาย</td>
          <td width="17%"><input type="radio" name="gender" id="radio5" value="f" <? if($result["sex"]=="ญ"){ echo "checked";}?>>
            หญิง</td>
          <td width="17%">&nbsp;</td>
          <td width="42%">&nbsp;</td>
        </tr>
        <tr>
          <td>การศึกษา</td>
          <td><input type="radio" name="edu" id="radio6" value="1">
            ประถมศึกษา</td>
          <td><input type="radio" name="edu" id="radio7" value="2">
มัธยมศึกษา</td>
          <td><input type="radio" name="edu" id="radio8" value="3"> 
            อนุปริญา</td>
          <td><input type="radio" name="edu" id="radio9" value="4"> 
            ปริญญาตรี/สูงกว่า</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>2. ประวัติครอบครัว</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left: 20px;"><strong>บิดา หรือ มารดา ของท่านมีประวัติการเจ็บป่วยด้วยโรค<br>
    </strong>
        <table width="100%" border="0" cellspacing="2" cellpadding="2">
          <tr>
            <td width="38%"><input type="radio" name="fm" id="radio10" value="dm">
              เบาหวาน (DM)</td>
            <td width="62%"><input type="radio" name="fm" id="radio10" value="crf">
              ไตวายเรื้อรัง (CRF)</td>
          </tr>
          <tr>
            <td><input type="radio" name="fm" id="radio11" value="ht">
ความดันโลหิตสูง (HT)</td>
            <td><input type="radio" name="fm" id="radio11" value="copd">
              ถุงลมโป่งพอง (COPD)</td>
          </tr>
          <tr>
            <td><input type="radio" name="fm" id="radio12" value="mi">
กล้ามเนื้อหัวใจตาย (MI)</td>
            <td><input type="radio" name="fm" id="radio12" value="stroke">
              เส้นเลือดสมองแตก /ตีบ อัมพาต อัมพฤกษ์ (STROKE)</td>
          </tr>
          <tr>
            <td><input type="radio" name="fm" id="radio13" value="gout">
โรคเกาต์ (GOUT)</td>
            <td><input type="radio" name="fm" id="radio13" value="other">
            อื่นๆ เช่น ตัดขา, ตาบอด ระบุ 
              <input type="text" name="otherdetail" id="otherdetail"></td>
          </tr>
          <tr>
            <td><input type="radio" name="fm" id="radio14" value="deny">
ไม่ทราบ</td>
            <td><input type="radio" name="fm" id="radio14" value="not">
              ไม่มี</td>
          </tr>
        </table>
    
    </div>    </td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left: 20px;"><strong>บิดา หรือ มารดา เสียชีวิตด้วยโรคหัวใจหรือไม่<br>
      </strong>
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="38%"><input type="radio" name="fm" id="radio15" value="dm">
                บิดาและมารดายังมีชีวิตอยู่</td>
              <td width="62%"><input type="radio" name="fm" id="radio15" value="crf">
                บิดาหรือมารดาเสียชีวิตด้วยโรคอื่น</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio16" value="ht">
                บิดาเสียชีวิตด้วยโรคหัวใจ</td>
              <td><input type="radio" name="fm" id="radio16" value="copd">
                มารดาเสียชีวิตด้วยโรคหัวใจ</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio17" value="mi">
                ทั้งบิดาและมารดาเสียชีวิตด้วยโรคหัวใจ</td>
              <td>&nbsp;</td>
            </tr>
          </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left: 20px;"><strong>พี่น้อง (สายตรง) ของท่านมีประวัติการเจ็บป่วยด้วยโรค<br>
      </strong>
          <table width="100%" border="0" cellspacing="2" cellpadding="2">
            <tr>
              <td width="38%"><input type="radio" name="fm" id="radio18" value="dm">
                เบาหวาน (DM)</td>
              <td width="62%"><input type="radio" name="fm" id="radio18" value="crf">
                ไตวายเรื้อรัง (CRF)</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio19" value="ht">
                ความดันโลหิตสูง (HT)</td>
              <td><input type="radio" name="fm" id="radio19" value="copd">
                ถุงลมโป่งพอง (COPD)</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio20" value="mi">
                กล้ามเนื้อหัวใจตาย (MI)</td>
              <td><input type="radio" name="fm" id="radio20" value="stroke">
                เส้นเลือดสมองแตก /ตีบ อัมพาต อัมพฤกษ์ (STROKE)</td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio21" value="gout">
                โรคเกาต์ (GOUT)</td>
              <td><input type="radio" name="fm" id="radio21" value="other">
                อื่นๆ เช่น ตัดขา, ตาบอด ระบุ
                <input type="text" name="otherdetail2" id="otherdetail2"></td>
            </tr>
            <tr>
              <td><input type="radio" name="fm" id="radio22" value="deny">
                ไม่ทราบ</td>
              <td><input type="radio" name="fm" id="radio22" value="not">
                ไม่มี</td>
            </tr>
          </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>3. ท่านมีประวัติการเจ็บป่วย หรือต้องพบแพทย์ ด้วยโรค</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="22%">- เบาหวาน (DM)</td>
    <td width="16%"><input type="radio" name="radio23" id="radio23" value="radio23">
      ไม่มี</td>
    <td width="62%"><input type="radio" name="radio25" id="radio25" value="radio25">
      มี&nbsp;( 
      <input type="radio" name="radio26" id="radio26" value="radio26">
      รับประทานยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio27" value="radio27">
      ไม่รับประทานยา )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio24" value="radio24">
      ไม่เคยตรวจ</td>
  </tr>
  <tr>
    <td>- ความดันโลหิตสูง (HT)</td>
    <td><input type="radio" name="radio23" id="radio28" value="radio23">
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio29" value="radio25">
      มี&nbsp;(
      <input type="radio" name="radio26" id="radio30" value="radio26">
      รับประทานยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio31" value="radio27">
      ไม่รับประทานยา )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio27" value="radio24">
      ไม่เคยตรวจ</td>
  </tr>
  
  <tr>
    <td>- โรคตับ</td>
    <td><input type="radio" name="radio23" id="radio33" value="radio23">
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio34" value="radio25">
      มี&nbsp;(
      <input type="radio" name="radio26" id="radio35" value="radio26">
      รับประทานยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio36" value="radio27">
      ไม่รับประทานยา )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio32" value="radio24">
      ไม่เคยตรวจ</td>
  </tr>
  
  <tr>
    <td>- โรคอัมพาต</td>
    <td><input type="radio" name="radio23" id="radio38" value="radio23">
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio39" value="radio25">
      มี&nbsp;(
      <input type="radio" name="radio26" id="radio40" value="radio26">
      รับประทานยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio41" value="radio27">
      ไม่รับประทานยา )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio37" value="radio24">
      ไม่เคยตรวจ</td>
  </tr>
  
  <tr>
    <td>- โรคหัวใจ</td>
    <td><input type="radio" name="radio23" id="radio43" value="radio23">
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio44" value="radio25">
      มี&nbsp;(
      <input type="radio" name="radio26" id="radio45" value="radio26">
      รับประทานยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio46" value="radio27">
      ไม่รับประทานยา )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio42" value="radio24">
      ไม่เคยตรวจ</td>
  </tr>
  
  <tr>
    <td>- ไขมันในเลือดผิดปกติ</td>
    <td><input type="radio" name="radio23" id="radio48" value="radio23">
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio49" value="radio25">
      มี&nbsp;(
      <input type="radio" name="radio26" id="radio50" value="radio26">
      รับประทานยา&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
      <input type="radio" name="radio27" id="radio51" value="radio27">
      ไม่รับประทานยา )</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td colspan="2"><input type="radio" name="radio24" id="radio47" value="radio24">
      ไม่เคยตรวจ</td>
  </tr>
  
  <tr>
    <td>- แผลที่เท้า/ตัดขา (จากเบาหวาน)</td>
    <td><input type="radio" name="radio23" id="radio52" value="radio23">
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio53" value="radio25">
      มี</td>
  </tr>
  <tr>
    <td>- คลอดบุตรน้ำหนักเกิน 4 กิโลกรัม</td>
    <td><input type="radio" name="radio23" id="radio56" value="radio23">
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio57" value="radio25">
      มี</td>
  </tr>
</table>

    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>ในรอบปีที่ผ่านมา หรือในขณะนี้ท่านมีอาการผิดปกติหรือมีพฤติกรรมต่อไปนี้หรือไม่</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
  <tr>
    <td width="59%">- ดื่มน้ำบ่อยและมาก</td>
    <td width="15%"><input type="radio" name="radio23" id="radio54" value="radio23" />
ไม่มี</td>
    <td width="26%"><input type="radio" name="radio25" id="radio55" value="radio25" />
มี</td>
  </tr>
  <tr>
    <td>- ปัสสาวะกลางคืน 3 ครั้งขึ้นไป</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- กินจุแต่ผอมลง</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- น้ำหนักลด/อ่อนเพลีย</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- เป็นแผลที่ริมฝีปากบ่อย และหายยาก</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- คันตามผิวหนัง และอวัยวะสืบพันธุ์</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- ตาพร่ามัว ต้องเปลี่ยนแว่นบ่อย</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- ชาปลายมือ ปลายเท้า โดยไม่ทราบสาเหตุ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- มีก้อนนิ่วหรือเลือดปนมาในปัสสาวะ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- ขาบวม เท้าบวมทั้ง 2 ข้าง หรือหนังตาบวม</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- ไอเรื้อรัง</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- แน่นหน้าอกตรงกลางมากกว่า 5 นาที เหมือนใจจะขาดร่วมกับเหงื่อออก</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- ขึ้นบันไดไปชั้น 2 หรือขึ้นสะพานลอย ต้องนั่งหอบหรือหยุดพัก</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- คลำได้ก้อนผิดปกติ</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- มีเลือด หรือน้ำออกผิดปกตที่จมูก / หู / หัวนม</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- เป็นไข้ติดต่อกันนานมากกว่า 2 สัปดาห์</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- ท้องเสียมากกว่า 3 ครั้งต่อวัน เกิน 2 สัปดาห์</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- มีอาการตัวเหลือง หรือตาเหลือง</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- มีอาการแขน หรือขาอ่อนแรง ข้างใดข้างหนึ่งหรือทั้งสองข้าง</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td>- ปวด, บวม, แดง ร้อนโคนนิ้วหัวแม่เท้า ข้อเท้า ข้อเข่า เดินไม่ถนัด</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
  <tr>
    <td> &nbsp;&nbsp;(หลังกินเนื้อสัตว์ สัตว์ปีก เครื่องในสัตว์ เหล้า เบียร์)</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>- เป็นลมไม่รู้สึกตัว</td>
    <td><input type="radio" name="radio23" id="radio54" value="radio23" />
      ไม่มี</td>
    <td><input type="radio" name="radio25" id="radio55" value="radio25" />
      มี</td>
  </tr>
</table>

    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>กรณีมีโรค / อาการดังกล่าวท่านปฏิบัติตนอย่างไร</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="38%"><input type="radio" name="fm" id="radio58" value="dm" />
          รับการรักษาอยู่ / ปฏิบัติตามที่แพทย์แนะนำ</td>
        </tr>
      <tr>
        <td><input type="radio" name="fm" id="radio59" value="ht" />
          รักษาแต่ไม่สม่ำเสมอ</td>
        </tr>
      <tr>
        <td><input type="radio" name="fm" id="radio60" value="mi" />
          เคยรักษา แต่ขณะนี้ไม่รักษา / หายาทานเอง</td>
        </tr>
    </table>
    </div>    </td>
  </tr>
  <tr>
    <td align="left"><strong>4. นิยามการเคลื่อนไหวออกแรง / ออกกำลังกาย</strong></td>
  </tr>
  <tr>
    <td align="left">4.1 ออกกำลังกายเพื่อสุขภาพ / เล่นกีฬา หรือ</td>
  </tr>
  <tr>
    <td align="left">4.2 มีการออกแรงในระดับปานกลางขึ้นไป เช่น ล้างรถ ถูบ้าน เช็ดหน้าต่าง ทำสวน ขุดดิน เต้นรำในจังหวะเร็ว</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;ขึ้นบันได เดินเร็ว ขี่จักรยาน ฯลฯ</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;(ถ้าท่านปฏิบัติตามข้อ 4.1 หรือ 4.2 ครั้งละ 30 นาทีขึ้นไป หรือช่วงละ 10 นาที เวลารวมกันตั้งแต่ 30 นาทีต่อวัน</td>
  </tr>
  <tr>
    <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;เทียบเท่ากับการได้ออกกำลังกายในวันนั้น)</td>
  </tr>
  <tr>
    <td align="left"><strong>การเคลื่อนไหวออกแรง / การออกกำลังกาย ของท่านเข้าเกณฑ์ข้อใด</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
    <table width="100%" border="0" cellspacing="2" cellpadding="2">
      <tr>
        <td width="38%"><input type="radio" name="fm" id="radio61" value="dm" />
          ไม่ออกกำลังกายเลย</td>
        <td width="62%"><input type="radio" name="fm" id="radio61" value="crf" />
          ออกกำลังกายสัปดาห์ละ 1-2 วัน</td>
      </tr>
      <tr>
        <td><input type="radio" name="fm" id="radio62" value="ht" />
          ออกกำลังกายสัปดาห์ละ 3-6 วัน</td>
        <td><input type="radio" name="fm" id="radio62" value="copd" />
          ออกกำลังกายทุกวัน</td>
      </tr>
    </table>
    </div>    </td>
  </tr>
  <tr>
    <td align="left"><strong>5. ท่านชอบอาหารรสใด (ตอบได้มากกกว่า 1 ข้อ)</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="23%"><input type="checkbox" name="checkbox" id="checkbox" />            
            หวาน</td>
          <td width="22%"><input type="checkbox" name="checkbox2" id="checkbox2" />
            เค็ม</td>
          <td width="21%"><input type="checkbox" name="checkbox3" id="checkbox3" />
            มัน</td>
          <td width="34%"><input type="checkbox" name="checkbox4" id="checkbox4" />
            ไม่ชอบทุกข้อ</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>6. สารเสพติด</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>สูบบุหรี่</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio63" value="dm" />
            ไม่เคยสูบ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio64" value="ht" />
            เคยสูบแต่เลิกแล้ว</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td width="38%"><input type="radio" name="fm" id="radio66" value="dm" />
                  เลิกสูบน้อยกว่า 6 เดือน</td>
                <td width="62%"><input type="radio" name="fm" id="radio66" value="crf" />
                  เลิกสูบ 6 เดือนขึ้นไป</td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio65" value="mi" />
            สูบเป็นครั้งคราวไม่ทุกวัน</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio67" value="mi" />
สูบเป็นประจำทุกวัน</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>ดื่มสุรา</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio68" value="dm" />
            ไม่เคยดื่ม</td>
          <td width="62%"><input type="radio" name="fm" id="radio68" value="crf" />
            เคยดื่มแต่เลิกแล้ว</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio69" value="ht" />
            ดื่มเป็นครั้งคราว</td>
          <td><input type="radio" name="fm" id="radio69" value="copd" />
            ดื่มเป็นประจำ 
              <input name="textfield" type="text" id="textfield" size="5" />
              วัน / สัปดาห์</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>7. สภาพการเงินของท่านเป็นอย่างไร</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio70" value="dm" />
            มีเงินพอใช้จ่าย และเหลือเก็บออม</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio71" value="ht" />
            มีเงินพอใช้จ่ายแต่ละเดือนไม่ต้องกู้ยืม แต่ไม่เหลือเก็บ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio72" value="mi" />
            ไม่พอใช้จ่ายและต้องกู้ยืม</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio73" value="mi" /> 
            อื่นๆ ระบุ 
              <input type="text" name="textfield2" id="textfield2" /></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>ท่านมีหนี้หรือไม่</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio74" value="dm" />
            ไม่มี</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio75" value="ht" />
            มี</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="38%"><input type="radio" name="fm" id="radio76" value="dm" />
                    &lt; 50,000 บาท</td>
                  <td width="62%"><input type="radio" name="fm" id="radio76" value="crf" />
                    50,000 - 100,000 บาท</td>
                </tr>
                <tr>
                  <td><input type="radio" name="fm" id="radio79" value="dm" />
                    100,001 - 1,000,000 บาท</td>
                  <td><input type="radio" name="fm" id="radio79" value="crf" />
                    &gt; 1,000,000 บาท</td>
                </tr>
              </table>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>8. อุบัติเหตุ</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>8.1 หลังการดื่มสุรา, เบียร์, ไวน์ ฯลฯ ท่านขับรถหรือไม่</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio77" value="dm" />
            ไม่ขับรถหลังดื่ม</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio78" value="ht" />
            ขับบางครั้ง</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio80" value="mi" />
            ขับทุกครั้งหลังดื่ม</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>8.2 การป้องกันอุบัติเหตุ สำหรับผู้ขับขี่ หรือโดยสารรถจักรยานยนต์ ท่านใส่หมวกกันน็อคหรือไม่</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio81" value="dm" />
            ใส่ทุกครั้ง</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio82" value="ht" />
            ใส่บางครั้ง</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio83" value="mi" />
            ไม่เคยใส่</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>8.3 ท่านขับขี่รถยนต์หรือเป็นผู้โดยสารนั่งข้างหน้า ท่านคาดเข็มขัดนิรภัยหรือไม่</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio84" value="dm" />
            คาดทุกครั้ง</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio85" value="ht" />
            คาดบางครั้ง</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio86" value="mi" />
            ไม่คาด</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>8.4 ท่านเคยมีเพศสัมพันธ์กับ หญิง/ชาย ที่ไม่ใช่คู่สมรสหรือไม่</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio87" value="dm" />
            ไม่เคย</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio88" value="ht" />
            เคย ถ้าเคยท่านและคู่นอนใช้ถุงยางอนามัยหรือไม่</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="28%"><input type="radio" name="fm" id="radio89" value="dm" />
                    ไม่เคยใช้</td>
                  <td width="30%"><input type="radio" name="fm" id="radio89" value="crf" />
                    ใช้บางครั้ง</td>
                  <td width="42%"><input type="radio" name="fm" id="radio90" value="crf" />
ใช้ทุกครั้ง</td>
                </tr>
              </table>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>9. ความเครียด</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>ปัญหาที่ทำให้ท่านเครียดมากที่สุด</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="31%"><input type="radio" name="fm" id="radio91" value="dm" />
            งานในหน้าที่</td>
          <td width="35%"><input type="radio" name="fm" id="radio91" value="crf" />
            ปัญหาในครอบครัว</td>
          <td width="34%"><input type="radio" name="fm" id="radio93" value="crf" />
ปัญหาการเงิน</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio92" value="ht" />
            ปัญหาการเมือง</td>
          <td><input type="radio" name="fm" id="radio92" value="copd" />
            อื่นๆ ระบุ 
              <input type="text" name="textfield3" id="textfield3" /></td>
          <td>&nbsp;</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>10. สภาพแวดล้อม</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>สภาพแวดล้อมบริเวณที่พักอาศัยของท่านมีลักษณะเป็นอย่างไร</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio94" value="dm" />
            สะอาดดี มีการเก็บขยะสม่ำเสมอเป็นประจำ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio95" value="ht" />
            ค่อนข้างสกปรก มีการเก็บขยะเป็นครั้งคราว</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio96" value="mi" />
          สกปรกมาก มีการทิ้งขยะเกลื่อนกลาด</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio97" value="mi" /> 
            อื่นๆ ระบุ 
              <input type="text" name="textfield4" id="textfield4" /></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>สภาพแวดล้อมในที่ทำงานของท่านมีลักษณะอย่างไร (ตอบได้มากกว่า 1 ข้อ)</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="checkbox" name="checkbox5" id="checkbox5" />            
            สะอาด</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox9" id="checkbox9" /> 
            ค่อนข้างสกปรก</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox6" id="checkbox6" />            
            มีแสงสว่างเพียงพอ</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox7" id="checkbox7" />            
            ค่อนข้างมืด</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox10" id="checkbox10" /> 
            คับแคบ</td>
        </tr>
        <tr>
          <td><input type="checkbox" name="checkbox8" id="checkbox8" />
            อื่นๆ ระบุ
            <input type="text" name="textfield5" id="textfield5" /></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>สำหรับเจ้าหน้าที่</strong></td>
  </tr>
  <tr>
    <td align="left"><strong>11. การตรวจร่างกาย</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td colspan="2">น้ำหนัก 
            <input type="text" name="weight" id="weight" value="<?=$rows["weight"];?>" class="txtform" /> 
            กก. &nbsp;ส่วนสูง 
            <input type="text" name="height" id="height" value="<?=$rows["height"];?>" class="txtform" />
            ซม. &nbsp;BMI 
            <input type="text" name="bmi" id="bmi" value="<?=$rows["bmi"];?>" class="txtform" />
            กก./ม</td>
        </tr>
        <tr>
          <td colspan="2">เส้นรอบเอว (วัดผ่านสะดือ) 
            <input type="text" name="round_cm" id="round_cm" value="<?=$rows["round_"];?>" class="txtform"  />
            ซม. (
            <input type="text" name="round_inc" id="round_inc" value="<?=number_format($rows["round_"]/2.54,2);?>" class="txtform" />
            นิ้ว)</td>
        </tr>
        <tr>
          <td>ชีพจร 
            <input type="text" name="pause" id="pause" value="<?=$rows["pause"];?>" class="txtform" /> 
            ครั้ง/นาที, </td>
          <td>ความดันโลหิต (ครั้งที่ 1)
            <input type="text" name="bp11" id="bp11" value="<?=$rows["bp1"]."/".$rows["bp2"];?>" class="txtform" />
มม. ปรอท</td>
        </tr>
        <tr>
          <td>&nbsp;</td>
          <td>ความดันโลหิต (ครั้งที่ 2)
            <input name="bp21" type="text" class="txtform" id="bp21" value="" />
มม. ปรอท</td>
        </tr>
        <tr>
          <td colspan="2">(วัดความดันโลหิตครั้งที่ 2 เฉพาะกรณีที่วัดครั้งแรกผิดปกติ และบันทึกค่าที่ปกติหรือใกล้เคียงปกติมากที่สุด)</td>
        </tr>
        <tr>
          <td colspan="2"><strong>การตรวจร่างกายตามระบบ</strong></td>
        </tr>
        <tr>
          <td colspan="2"><textarea name="textarea" id="textarea" cols="45" rows="5"></textarea></td>
        </tr>
        <tr>
          <td colspan="2">แพทย์ผู้ตรวจ 
            <input type="text" name="textfield6" id="textfield6" /></td>
        </tr>
        <tr>
          <td colspan="2"><strong>ทันตแพทย์ : สุขภาพช่องปาก</strong></td>
        </tr>
        <tr>
          <td colspan="2"><input name="radio98" type="radio" class="txtform" id="radio98" value="radio98" />
            ปกติ</td>
        </tr>
        <tr>
          <td colspan="2"><input name="radio99" type="radio" class="txtform" id="radio99" value="radio99" />
            ไม่ปกติ</td>
        </tr>
        <tr>
          <td width="29%"><strong>โรคฟัน</strong></td>
          <td width="71%"><strong>โรคเหงือก</strong></td>
        </tr>
        <tr>
          <td><input type="radio" name="radio100" id="radio100" value="radio100" />
            ฟันผุ</td>
          <td><input type="radio" name="radio100" id="radio100" value="radio100" />
            โรคเหงือกอักเสบ</td>
        </tr>
        <tr>
          <td><input type="radio" name="radio101" id="radio101" value="radio101" />
            ฟันสึก</td>
          <td><input type="radio" name="radio101" id="radio101" value="radio101" />
            โรคปริทันต์อักเสบ</td>
        </tr>
        <tr>
          <td><input type="radio" name="radio102" id="radio102" value="radio102" />
            ฟันคุด</td>
          <td>ผู้ตรวจ 
            <input type="text" name="textfield15" id="textfield15" /></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>สรุปเบื้องต้น</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="100%"><input type="radio" name="fm" id="radio106" value="dm" />
            ไม่พบความเสี่ยง</td>
          </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio103" value="dm" />
พบความเสี่ยงเบื้องต้นต่อโรค</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td width="21%"><input type="radio" name="fm" id="radio104" value="dm" />
                DM</td>
                <td width="22%"><input type="radio" name="fm" id="radio104" value="crf" />
                  HT</td>
                <td width="22%"><input type="radio" name="fm" id="radio105" value="crf" /> 
                  Stroke</td>
                <td width="35%"><input type="radio" name="fm" id="radio107" value="crf" /> 
                  Obesity</td>
              </tr>
            </table>
          </div></td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio108" value="dm" />
            ป่วยด้วยโรคเรื้อรัง</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
            <table width="100%" border="0" cellspacing="2" cellpadding="2">
              <tr>
                <td width="21%"><input type="radio" name="fm" id="radio109" value="dm" />
                  DM</td>
                <td width="22%"><input type="radio" name="fm" id="radio109" value="crf" />
                  HT</td>
                <td width="22%"><input type="radio" name="fm" id="radio110" value="crf" />
                  Stroke</td>
                <td width="35%"><input type="radio" name="fm" id="radio111" value="crf" />
                  Obesity</td>
              </tr>
            </table>
          </div></td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>12. กรณีอายุเกิน 35 ปีขึ้นไป มีประวัติเสี่ยง และค่า BMI &gt; 25 กก/ม ดำเนินการตรวจ Total Cholesterol</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio112" value="dm" />
            ตรวจ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio113" value="ht" />
            ไม่ตรวจ</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>การดำเนินงาน</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="38%"><input type="radio" name="fm" id="radio114" value="dm" />
            ให้คำแนะนะการดูแลตนเอง และตรวจคัดกรองซ้ำทุก 1 ปี</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio115" value="ht" />
            ลงทะเบียนกลุ่มเสี่ยงต่อกลุ่มโรค Metabolic และแนะนำเข้าโครงการปรับเปลี่ยนพฤติกรรม</td>
        </tr>
        <tr>
          <td><input type="radio" name="radio116" id="radio116" value="radio116" />
            ส่งต่อเพื่อรักษา</td>
        </tr>
      </table>
    </div></td>
  </tr>
  <tr>
    <td align="left"><strong>สรุปผลการตรวจสุขภาพประจำปี</strong></td>
  </tr>
  <tr>
    <td align="left"><div style="margin-left:20px;">
      <table width="100%" border="0" cellspacing="2" cellpadding="2">
        <tr>
          <td width="100%"><input type="radio" name="fm" id="radio117" value="dm" />
            ปกติ</td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio118" value="dm" />
            มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)</td>
        </tr>
        <tr>
          <td><div style="margin-left: 20px;">
              <table width="100%" border="0" cellspacing="2" cellpadding="2">
                <tr>
                  <td width="21%"><input type="radio" name="fm" id="radio119" value="dm" />
                    Overweight</td>
                  <td width="22%"><input type="radio" name="fm" id="radio119" value="crf" />
                    Hyperuricemia</td>
                  <td width="22%"><input type="radio" name="fm" id="radio120" value="crf" />
                    Anemia</td>
                  <td width="35%"><input type="radio" name="fm" id="radio121" value="crf" />
                    HLD</td>
                </tr>
                <tr>
                  <td><input type="radio" name="fm" id="radio126" value="dm" />
                    Impaired FG</td>
                  <td><input type="radio" name="fm" id="radio126" value="crf" />
                    Renal insufficiency</td>
                  <td><input type="radio" name="fm" id="radio127" value="crf" />
                    Mild hepatitis</td>
                  <td><input type="radio" name="fm" id="radio128" value="crf" />
                    Other 
                      <input type="text" name="textfield16" id="textfield16" /></td>
                </tr>
              </table>
          </div></td>
        </tr>
        <tr>
          <td><input type="radio" name="fm" id="radio122" value="dm" />
          เป็นโรค 
            <input type="text" name="textfield17" id="textfield17" /></td>
        </tr>
        <tr>
          <td>ลงชื่อ 
            <input name="textfield18" type="text" class="txtform" id="textfield18" value="<?=$rows["doctor"];?>" size="25" /> 
            แพทย์ผู้ตรวจ</td>
        </tr>
      </table>
    </div></td>
  </tr>
</table>
</form>
</div>
<?
}  //close if show
?>