<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<link rel="stylesheet" type="text/css" href="epoch_styles.css" />
<script type="text/javascript" src="epoch_classes.js"></script>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>แบบรายงานความคลาดเคลื่อนทางยาโรงพยาบาลค่ายสุรศักดิ์มนตรี</title>
<script type="text/javascript">

	var bas_cal,dp_cal,ms_cal;

window.onload = function () {
	dp_cal  = new Epoch('epoch_popup','popup',document.getElementById('fha_date'));

};

</script>
<style type="text/css">


a:link {color:#FF0000; text-decoration:underline;}
a:visited {color:#FF0000; text-decoration:underline;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:  MS Sans Serif;
	font-size: 14px;
}

.font_title{
	font-family:  MS Sans Serif;
	font-size: 14px;
	color: #FFFFFF;
	font-weight: bold;

}
</style>
</head>

<body>
<?php
include("connect.inc");

if(empty($_GET["view"])){
?>
<script language="javascript">
	window.onload = function(){
		window.print();
		//window.close();
	}
	
</script>
<?php } ?>
<?php
	

		
		$sql = "Select * From drug_fail where drug_fail_id = '".$_GET["id"]."' limit  1 ";
		$result = Mysql_Query($sql) or die(mysql_error());
		$arr_edit = mysql_fetch_assoc($result);
		

?>

<table width="741" border="1" bordercolor="#3366FF" align="center" cellpadding="2" cellspacing="2" >
  <tr>
    <td align="center" bgcolor="#3366FF"><FONT SIZE="1" COLOR="#FFFFFF"><B>แบบรายงานความคลาดเคลื่อนทางยาโรงพยาบาลค่ายสุรศักดิ์มนตรี</B></FONT></td>
  </tr>
  <tr>
    <td align="center"><table width="100%" border="0" cellpadding="2" cellspacing="1">
      <tr>
        <td width="741"></td>
      </tr>
      <tr>
        <td align="left">ชื่อผู้รายงาน (เภสัชกร, แพทย์, พยาบาล) :
          <input name="send_by" type="text" id="send_by" value="<?php echo $arr_edit["send_by"];?>" maxlength="50" />
          หน่วยงานของท่าน  :
          <select name="until">
            <option value="">--------------</option>
            <?php
										foreach($cfg_until as $key => $value){
											echo "<Option value=\"".$key."\" ";
												if($arr_edit["until"] == $key ) echo " Selected ";
											echo ">".$value."</Option>";
										}
									?>
          </select></td>
      </tr>
      <tr>
        <td align="left">
          สถานที่พบเหตุการณ์
          <input name="location" type="text" id="location" maxlength="50" value="<?php echo $arr_edit["location"];?>"/>
          สถานที่เกิดเหตุการณ์
          <select name="area">
            <option value="">--------------</option>
            <?php
										foreach($cfg_until as $key => $value){
											echo "<Option value=\"".$key."\" ";
												if($arr_edit["area"] == $key ) echo " Selected ";
											echo ">".$value."</Option>";
										}
									?>
          </select></td>
      </tr>
      <tr>
        <td align="left">วันเดือนปีที่เกิดความคลาดเคลื่อนทางยาขึ้น
          <input name="fha_date" type="text" id="fha_date" size="10" maxlength="10" value="<?php echo $arr_edit["fha_date"];?>" />
          &nbsp;&nbsp;
          เวลาที่เกิด
          <select name="fha_time1">
		  		<option value="">--</option>
                <?php 
				list($fha_time1,$fha_time2,$fha_time3) = explode(":",$arr_edit["fha_time"]);
				for($i=0;$i<=23;$i++){ 
					echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($fha_time1 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
				}?>
              </select>
          :
          <select name="fha_time2">
		  	<option value="">--</option>
            <?php 
			for($i=0;$i<=59;$i=$i+5){ 
				echo "<Option value=\"".sprintf('%02d',$i)."\" ";
						if($fha_time2 == $i) echo " Selected ";
					echo ">".sprintf('%02d',$i)."</Option>";
			}?>
          </select>
          น.</td>
      </tr>
      <tr>
        <td align="left" valign="top">กรุณาบรรยายความคลาดเคลื่อนทางยาที่เกินขึ้น<br />
          &nbsp; &nbsp; &nbsp; &nbsp;
          <textarea name="detail" cols="60" rows="4" id="detail"><?php echo $arr_edit["detail"];?></textarea></td>
      </tr>
      <tr>
        <td><table width="100%" border="0">
            <tr>
              <td width="41%" valign="top"><table width="100%" border="0" cellpadding="0" cellspacing="0">
			  	 <tr>
                    <td align="left">
					ประเภทของ Error :
                      <select name="type_error">
					  <option value="" >-- ประเภทของ Error --</option>
                      <option value="T" <?php if($arr_edit["type_error"]=="T") echo " Selected "; ?>>Transcribing Error</option>
                      <option value="P" <?php if($arr_edit["type_error"]=="P") echo " Selected "; ?>>Processing Error</option>
                      <option value="D" <?php if($arr_edit["type_error"]=="D") echo " Selected "; ?>>Dispansing</option>
                      <option value="A" <?php if($arr_edit["type_error"]=="A") echo " Selected "; ?>>Administration</option>

                    </select>                    </td>
                  </tr>
                  <tr>
                    <td align="left"><strong>ผลลัพธ์</strong>&nbsp; ต่อผู้ป่วย<br />
                      Category :
                      <select name="category">
					  <option value="">-- category --</option>
                      <option value="A" <?php if($arr_edit["category"]=="A") echo " Selected "; ?>>A</option>
                      <option value="B" <?php if($arr_edit["category"]=="B") echo " Selected "; ?>>B</option>
                      <option value="C" <?php if($arr_edit["category"]=="C") echo " Selected "; ?>>C</option>
                      <option value="D" <?php if($arr_edit["category"]=="D") echo " Selected "; ?>>D</option>
                      <option value="E" <?php if($arr_edit["category"]=="E") echo " Selected "; ?>>E</option>
                      <option value="F" <?php if($arr_edit["category"]=="F") echo " Selected "; ?>>F</option>
                      <option value="G" <?php if($arr_edit["category"]=="G") echo " Selected "; ?>>G</option>
                      <option value="H" <?php if($arr_edit["category"]=="H") echo " Selected "; ?>>H</option>
                      <option value="I" <?php if($arr_edit["category"]=="I") echo " Selected "; ?>>I</option>
                    </select>                    </td>
                  </tr>
                  <tr>
                    <td align="left"><br />
<strong>ชนิด</strong> ของความคลาดเคลื่อนทางยา<br />
                            <input name="kind1" type="checkbox" value="1" <?php if($arr_edit["kind1"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาไม่ครบ (ไม่รวมเมือผู้ป่วยปฎิเสธยา)<br />
                      <input name="kind2" type="checkbox" value="1" <?php if($arr_edit["kind2"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาผิดชนิด<br />
                      <input name="kind3" type="checkbox" value="1" <?php if($arr_edit["kind3"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาโดยผู้สั่งยาไม่ได้สั่ง<br />
                      <input name="kind4" type="checkbox" value="1" <?php if($arr_edit["kind4"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาผิดคน<br />
                      <input name="kind5" type="checkbox" id="kind5" value="1" <?php if($arr_edit["kind5"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาผิดขนาด<br />
                      <input name="kind6" type="checkbox" id="kind6" value="1" <?php if($arr_edit["kind6"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาผิดวิถีทาง<br />
                      <input name="kind7" type="checkbox" id="kind7" value="1" <?php if($arr_edit["kind7"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาผิดเวลา<br />
                      <input name="kind8" type="checkbox" id="kind8" value="1" <?php if($arr_edit["kind8"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยามากกว่าจำนวนครั้งที่สั่ง<br />
                      <input name="kind9" type="checkbox" id="kind9" value="1" <?php if($arr_edit["kind9"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาในอัตราเร็วที่ผิด<br />
                      <input name="kind10" type="checkbox" id="kind10" value="1" <?php if($arr_edit["kind10"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาผิดเทคนิค<br />
                      <input name="kind11" type="checkbox" id="kind11" value="1" <?php if($arr_edit["kind11"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาผิดรูปแบบยา<br />
                      <input name="kind12" type="checkbox" id="kind12" value="1" <?php if($arr_edit["kind12"]=="1") echo " Checked "; ?> />
                      &nbsp;ให้ยาหมดอายุแก่ผู้ป่วย<br />
                      <input name="kind13" type="checkbox" id="kind13" value="1" <?php if($arr_edit["kind13"]=="1") echo " Checked "; ?> />
                      &nbsp;การติดตามผู้ป่วยไม่เหมาะสมทำให้เกิด<br />
                      &nbsp;  &nbsp;  &nbsp;
                      <input name="kind13_1" type="checkbox" id="kind13_1" value="1" <?php if($arr_edit["kind13_1"]=="1") echo " Checked "; ?> />
                      &nbsp;ปฎิกิริยาระหว่าง
                      &nbsp;  &nbsp;  &nbsp;
                                        <input name="kind13_2" type="checkbox" id="kind13_2" value="1" <?php if($arr_edit["kind13_2"]=="1") echo " Checked "; ?> />
                      &nbsp;ได้รับยาที่ผู้ป่วยมีประวัติแพ้<br />
                      อื่นๆ (ระบุ)
                      <input name="kind_etc" type="text" value="<?php echo $arr_edit["kind_etc"];?>" maxlength="50" />
                      <br />                    </td>
                  </tr>
                  <tr>
                    <td align="left"><strong>ยา</strong> ชนิดที่ 1 ที่เกี่ยวข้อง<br />
                      ชื่อการค้ายา
                      <input name="genname1" type="text" id="genname1" value="<?php echo $arr_edit["genname1"];?>" size="15" />
                      &nbsp;<br />
                      ชื่อสามัญทางยา
                      <input name="tradname1" type="text" id="tradname1" value="<?php echo $arr_edit["tradname1"];?>" size="15" />
                      <br />
                      รูปแบบยา
                      <input name="until1" type="text" id="until1" value="<?php echo $arr_edit["until1"];?>" size="15" />
                      <br />
                      ความแรง/ควาเข้มข้น
                      <input name="flavoure1" type="text" id="flavoure1" value="<?php echo $arr_edit["flavoure1"];?>" size="15" /></td>
                  </tr>
                  <tr>
                    <td align="left"><br /></td>
                  </tr>
                  <tr>
                    <td align="left"><strong>ยา</strong> ชนิดที่ 2 ที่เกี่ยวข้อง<br />
                      ชื่อการค้ายา
                      <input name="genname2" type="text" id="genname2" value="<?php echo $arr_edit["genname2"];?>" size="15" />
                      &nbsp;<br />
                      ชื่อสามัญทางยา
                      <input name="tradname2" type="text" id="tradname2" value="<?php echo $arr_edit["tradname2"];?>" size="15" />
                      <br />
                      รูปแบบยา
                      <input name="until2" type="text" id="until2" value="<?php echo $arr_edit["until2"];?>" size="15" />
                      <br />
                      ความแรง/ควาเข้มข้น
                      <input name="flavoure2" type="text" id="flavoure2" value="<?php echo $arr_edit["flavoure2"];?>" size="15" /></td>
                  </tr>
              </table></td>
              <td width="59%" align="left" valign="top">สาเหตุ ของความคลาดเคลื่อนทางยา : เกิดจาก (เลือกได้ <u>&gt;</u> 1ข้อ)<br />
                &nbsp;&nbsp; 1. การติดต่อสื่อสาร <br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <input name="cause1_1" type="checkbox" id="cause1_1" value="1" <?php if($arr_edit["cause1_1"]=="1") echo " Checked "; ?> />
                ด้วยวาจา<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;
                <input name="cause1_2" type="checkbox" id="cause1_2" value="1" <?php if($arr_edit["cause1_2"]=="1") echo " Checked "; ?> />
                การคัดลอก/แปลคำสั่งให้ชาผิด<br />
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; การเขียนคำสั่งใช้ยา<br />
                <table width="100%" border="0">
                  <tr>
                    <td>&nbsp;</td>
                    <td width="7%"><input name="cause1_3" type="checkbox" id="cause1_3" value="1" <?php if($arr_edit["cause1_3"]=="1") echo " Checked "; ?> /></td>
                    <td width="27%">อ่านลายมือไม่ออก</td>
                    <td width="7%" align="right"><input name="cause1_6" type="checkbox" id="cause1_6" value="1" <?php if($arr_edit["cause1_6"]=="1") echo " Checked "; ?> /></td>
                    <td width="53%">ใช้ตัวย่อไม่เหมาะสม</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause1_4" type="checkbox" id="cause1_4" value="1" <?php if($arr_edit["cause1_4"]=="1") echo " Checked "; ?> /></td>
                    <td>ใช้หน่วยผิด</td>
                    <td align="right"><input name="cause1_7" type="checkbox" id="cause1_7" value="1" <?php if($arr_edit["cause1_7"]=="1") echo " Checked "; ?> /></td>
                    <td>มีศูนย์หลังจุดทศนิยม</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause1_5" type="checkbox" id="cause1_5" value="1" <?php if($arr_edit["cause1_5"]=="1") echo " Checked "; ?> /></td>
                    <td>มีศูนย์หน้าตัวเลข</td>
                    <td align="right"><input name="cause1_8" type="checkbox" id="cause1_8" value="1" <?php if($arr_edit["cause1_8"]=="1") echo " Checked "; ?> /></td>
                    <td>ไม่มีจุดมศนิยม
                      <input name="cause1_9" type="checkbox" id="cause1_9" value="1" <?php if($arr_edit["cause1_9"]=="1") echo " Checked "; ?> />
                      อ่านผิด </td>
                  </tr>
                </table>
      
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
                    
            2.ชื่อ/ลักษณะของยาทำให้สับสน
            <table width="100%" border="0">
              <tr>
                <td width="6%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td width="94%"><input name="cause2_1" type="checkbox" id="cause2_1" value="1" <?php if($arr_edit["cause2_1"]=="1") echo " Checked "; ?> />
                  ชื่อยาออกเสียงคล้ายกัน คือ
                  <input name="cause2_1_1" type="text" id="cause2_1_1" value="<?php echo $arr_edit["cause2_1_1"];?>" size="12" />
                  กับ
                  <input name="cause2_1_2" type="text" id="cause2_1_2" value="<?php echo $arr_edit["cause2_1_2"];?>" size="12" /></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td><input name="cause2_2" type="checkbox" id="cause2_2" value="1" <?php if($arr_edit["cause2_2"]=="1") echo " Checked "; ?> />
                  ภาชนะบรรจุคล้ายกัน  คือ
                  <input name="cause2_2_1" type="text" id="cause2_2_1" value="<?php echo $arr_edit["cause2_2_1"];?>" size="12" />
                  กับ
                  <input name="cause2_2_2" type="text" id="cause2_2_2" value="<?php echo $arr_edit["cause2_2_2"];?>" size="12" /></td>
              </tr>
              <tr>
                <td>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp; </td>
                <td><input name="cause2_3" type="checkbox" id="cause2_3" value="1" <?php if($arr_edit["cause2_3"]=="1") echo " Checked "; ?> />
                  ลักษณะ/สียาคล้ายกัน  คือ
                  <input name="cause2_3_1" type="text" id="cause2_3_1" value="<?php echo $arr_edit["cause2_3_1"];?>" size="12" />
                  กับ
                  <input name="cause2_3_2" type="text" id="cause2_3_2" value="<?php echo $arr_edit["cause2_3_2"];?>" size="12" /></td>
              </tr>
            </table>
                <br />
                3.ฉลากยา
                <table width="100%" border="0">
                  <tr>
                    <td width="5%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td colspan="2"><input name="cause3_1" type="checkbox" id="cause3_1" value="1" <?php if($arr_edit["cause3_1"]=="1") echo " Checked "; ?> />
                      ฉลากจากบริษัทยาคล้ายกัน</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td colspan="2"><input name="cause3_2" type="checkbox" id="cause3_2" value="1" <?php if($arr_edit["cause3_2"]=="1") echo " Checked "; ?> />
                      ฉลากยาที่จ่ายให้ผู้ป่วย</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td width="40%"><input name="cause3_3" type="checkbox" id="cause3_3" value="1" <?php if($arr_edit["cause3_3"]=="1") echo " Checked "; ?> />
                      คำแนะนำในการใช้ยา</td>
                    <td width="55%"><input name="cause3_6" type="checkbox" id="cause3_6" value="1" <?php if($arr_edit["cause3_6"]=="1") echo " Checked "; ?> />
                      คำแนะนำในการใช้ยาไม่ครบ</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause3_4" type="checkbox" id="cause3_4" value="1" <?php if($arr_edit["cause3_4"]=="1") echo " Checked "; ?> />
                      ชื่อยาผิด</td>
                    <td><input name="cause3_7" type="checkbox" id="cause3_7" value="1" <?php if($arr_edit["cause3_7"]=="1") echo " Checked "; ?> />
                      ขนาดยาผิด</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause3_5" type="checkbox" id="cause3_5" value="1" <?php if($arr_edit["cause3_5"]=="1") echo " Checked "; ?> />
                      ผู้ป่วยผิดคน</td>
                    <td>อื่นๆ ระบุ :
                      <input name="cause3_8" type="text" id="cause3_8" value="<?php echo $arr_edit["cause3_8"];?>" size="15" /></td>
                  </tr>
                </table>
                <br />
                4. บุคลากร
                <table width="100%" border="0">
                  <tr>
                    <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="6%"><input name="cause4_1" type="checkbox" id="cause4_1" value="1" <?php if($arr_edit["cause4_1"]=="1") echo " Checked "; ?> /></td>
                    <td width="42%">ขาดความรู้</td>
                    <td width="7%"><input name="cause4_5" type="checkbox" id="cause4_5" value="1" <?php if($arr_edit["cause4_5"]=="1") echo " Checked "; ?> /></td>
                    <td width="41%">การปฎิบัติงานบกพร่อง</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause4_2" type="checkbox" id="cause4_2" value="1" <?php if($arr_edit["cause4_2"]=="1") echo " Checked "; ?> /></td>
                    <td>คอมพิวเตอร์ผิดพลาด</td>
                    <td><input name="cause4_6" type="checkbox" id="cause4_6" value="1" <?php if($arr_edit["cause4_6"]=="1") echo " Checked "; ?> /></td>
                    <td>การเตรียมยาผิดพลาด</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause4_3" type="checkbox" id="cause4_3" value="1" <?php if($arr_edit["cause4_3"]=="1") echo " Checked "; ?> /></td>
                    <td>ให้ยาผิดคัดลอกคำสั่งใช้ยาผิด</td>
                    <td colspan="2">อื่นๆ ระบุ :
                      <input name="cause4_7" type="text" id="cause4_7" value="<?php echo $arr_edit["cause4_7"];?>" size="15" /></td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause4_4" type="checkbox" id="cause4_4" value="1" <?php if($arr_edit["cause4_4"]=="1") echo " Checked "; ?> /></td>
                    <td>คำนวนขนาดยาหรืออัตราการ</td>
                    <td>&nbsp;</td>
                    <td>&nbsp;</td>
                  </tr>
                </table>
                <br />
                5.ปัจจัยส่งเสริมเชิงระบบข้อง
                <table width="100%" border="0">
                  <tr>
                    <td width="4%">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
                    <td width="6%"><input name="cause5_1" type="checkbox" id="cause5_1" value="1" <?php if($arr_edit["cause5_1"]=="1") echo " Checked "; ?> /></td>
                    <td width="36%">แสงสว่าง เสียงรบกวน </td>
                    <td width="7%"><input name="cause5_5" type="checkbox" id="cause5_5" value="1" <?php if($arr_edit["cause5_5"]=="1") echo " Checked "; ?> /></td>
                    <td width="47%">การขัดจังหวะ</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause5_2" type="checkbox" id="cause5_2" value="1" <?php if($arr_edit["cause5_2"]=="1") echo " Checked "; ?> /></td>
                    <td>การฝึกอบรม</td>
                    <td><input name="cause5_6" type="checkbox" id="cause5_6" value="1" <?php if($arr_edit["cause5_6"]=="1") echo " Checked "; ?> /></td>
                    <td>บุคลากรไม่เพียงพอ</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause5_3" type="checkbox" id="cause5_3" value="1" <?php if($arr_edit["cause5_3"]=="1") echo " Checked "; ?> /></td>
                    <td>ระบบการสื่อสารระหว่าง</td>
                    <td><input name="cause5_7" type="checkbox" id="cause5_7" value="1" <?php if($arr_edit["cause5_7"]=="1") echo " Checked "; ?> /></td>
                    <td>บุคลากรไม่เหมาะสม</td>
                  </tr>
                  <tr>
                    <td>&nbsp;</td>
                    <td><input name="cause5_4" type="checkbox" id="cause5_4" value="1" <?php if($arr_edit["cause5_4"]=="1") echo " Checked "; ?> /></td>
                    <td>ขาดนโยบาย</td>
                    <td colspan="2">อื่นๆ ระบุ :
                      <input name="cause5_8" type="text" id="cause5_8" value="<?php echo $arr_edit["cause5_8"];?>" size="15" /></td>
                  </tr>
                </table></td>
            </tr>
        </table></td>
      </tr>
    </table></td>
  </tr>
</table>
<?php echo $hd;?>

</body>
</html>

