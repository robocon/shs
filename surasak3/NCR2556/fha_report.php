<body onLoad="window.print();">
<style type="text/css">
.font1{
	font-family:"TH SarabunPSK";
	font-size:16pt;
	font-weight:bold;
}
.font2{
	font-family:"TH SarabunPSK";
	font-size:14pt;
}
@media print{
  #no_print{display:none;}
}
.theBlocktoPrint { 
  background-color: #000; 
  color: #FFF; 
} 
</style>
<?php
include("connect.inc");

  // สร้าง departments key
  $q = mysql_query("SELECT `code`,`name` FROM `departments`");
  $departs = array();
  while ($item = mysql_fetch_assoc($q)) {
    $key = $item['code'];
    $departs[$key] = $item['name'];
  }

		$sql = "Select * From drug_fail_2  where row_id = '".$_GET["row_id"]."' limit  1 ";
		$result = mysql_query($sql) or die(mysql_error());
		$arr_edit = mysql_fetch_assoc($result);
		
		
		$sql="SELECT * FROM `departments` where code='".$arr_edit['depart']."' and status='y' ";
		$query=mysql_query($sql)or die (mysql_error());
		$arr=mysql_fetch_array($query);
		
		$sql2="SELECT * FROM `departments` where code='".$arr_edit['area']."' and status='y' ";
		$query2=mysql_query($sql2)or die (mysql_error());
		$arr2=mysql_fetch_array($query2);
		
		
?>
<h1 class="font1" align="center">แบบรายงานความคลาดเคลื่อนทางยาของโรงพยาบาลค่ายสุรศักดิ์มนตรี ลำปาง</h1>
<form name="f1" action="fha_add.php" method="post" onSubmit="return fncSubmit();">


<table border="0" align="center" cellpadding="2" cellspacing="0" class="font2">
  <tr>
    <td>ชื่อ-นามสกุลผู้ป่วย</td>
    <td align="center"><?=$arr_edit['ptname'];?></td>
    <td align="right">HN</td>
    <td align="center"><?=$arr_edit['hn'];?></td>
    <td align="right">AN</td>
    <td align="center"><? if($arr_edit['an']!=''){ echo $arr_edit['an'];}else{ echo "-"; }?></td>
    <td><input type="radio" name="type_opd" id="radio10" value="opd" <? if($arr_edit['type_opd']=="opd" || $arr_edit['an']==''){ echo "checked"; } ?> disabled/>
      ผู้ป่วยนอก
      <input type="radio" name="type_opd" id="radio11" value="ipd"  <? if($arr_edit['type_opd']=="ipd" || $arr_edit['an']<>''){ echo "checked"; } ?> disabled/>        ผู้ป่วยใน</td>
  </tr>
  <tr>
    <td >สถานที่เกิดเหตุ</td>
    <td align="center">&nbsp;<?=$arr2['name'];?></td>
    <td>วันเดือนปี</td>
    <td align="center"><?=$arr_edit['fha_date'];?></td>
    <td>เวลา</td>
    <td align="center"><?=$arr_edit['fha_time'];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ผู้สั่งยา</td>
    <td align="center"><?=$arr_edit['order_name'];?></td>
    <td>ผู้จ่ายยา</td>
    <td align="center"><?=$arr_edit['pay_name'];?></td>
    <td>ผู้ให้ยา</td>
   <td align="center"><?=$arr_edit['give_name'];?></td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ผู้รายงาน</td>
    <td align="center"><?=$arr_edit['report_name'];?></td>
    <td>กอง/แผนก</td>
    <td align="center">&nbsp;<?=$arr['name'];?></td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
  </tr>
  <tr>
    <td>ที่มา</td>
    <td colspan="7">
    <?php
    $lists = array('1' => 'ENV ROUND',
    '2' => 'IC ROUND',
    '3' => 'RM ROUND',
    '4' => '12 กิจกรรมทบทวน',
    '5' => 'หน่วยรายงานเอง',
    '6' => 'อื่นๆ',
    '7' => 'เวรตรวจการพยาบาล',
    '8' => 'นายทหารเวรประจำวัน'
    );
    $from_id = $arr_edit['come_from_id'];
    if( $from_id !== '6' ){
      echo $lists[$from_id];
    }else{
      $from_detail_id = $arr_edit['come_from_detail'];
      echo $departs[$from_detail_id];
    }
    ?>
    </td>
  </tr>
</table><br />
<table border="1" align="center" cellpadding="0" cellspacing="0" class="font2" style="border-collapse:collapse" bordercolor="#000000">
  <tr>
    <td colspan="4" align="center">ชนิดความคลาดเคลื่อนทางยา</td>
    </tr>
  <tr>
    <td colspan="2" align="center">การสั่งยา (Prescribing error)</td>
    <td colspan="2" align="center">การจ่ายยา(Dispensing error)</td>
    </tr>
  <tr>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="p1" type="checkbox" id="p1" value="1"  <? if($arr_edit['p1']=="1"){ echo "checked"; }?> disabled/>
          สั่งยาโดยไม่มีข้อบ่งใช้</td>
        </tr>
      <tr>
        <td><input name="p2" type="checkbox" id="p2" value="1"  <? if($arr_edit['p2']=="1"){ echo "checked"; }?> disabled/>
สั่งยาโดยไม่มีข้อห้ามใช้</td>
      </tr>
      <tr>
        <td><input name="p3" type="checkbox" id="p3" value="1" <? if($arr_edit['p3']=="1"){ echo "checked"; }?> disabled/>
สั่งยาที่ผู้ป่วยมีประวัตืแพ้</td>
      </tr>
      <tr>
        <td><input name="p4" type="checkbox" id="p4" value="1"  <? if($arr_edit['p4']=="1"){ echo "checked"; }?> disabled/>
สั่งยาที่เกิดปฏิกิริยาต่อกัน</td>
      </tr>
      <tr>
        <td><input name="p5" type="checkbox" id="p5" value="1" <? if($arr_edit['p5']=="1"){ echo "checked"; }?> disabled />
สั่งยาในขนาดสูงเกินไป</td>
      </tr>
      <tr>
        <td><input name="p6" type="checkbox" id="p6" value="1" <? if($arr_edit['p6']=="1"){ echo "checked"; }?> disabled/>

          สั่งยาในขนาดต่ำเกินไป</td>
      </tr>
      <tr>
        <td><input name="p7" type="checkbox" id="p7" value="1"  <? if($arr_edit['p7']=="1"){ echo "checked"; }?> disabled/>  อื่นๆ...... <?=$arr_edit['p_detail']?>.......</td>
      </tr>
      <tr>
        <td>&nbsp;</td>
      </tr>
    </table>
     </td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="p8" type="checkbox" id="p8" value="1"  <? if($arr_edit['p8']=="1"){ echo "checked"; }?> disabled/>
          ไม่ระบุความแรง/วิธีใช้/จำนวน</td>
      </tr>
      <tr>
        <td><input name="p9" type="checkbox" id="checkbox9" value="1"  <? if($arr_edit['p9']=="1"){ echo "checked"; }?> disabled/>
        ผิดชื่อยา/ชนิดยา</td>
      </tr>
      <tr>
        <td><input name="p10" type="checkbox" id="checkbox10" value="1" <? if($arr_edit['p10']=="1"){ echo "checked"; }?> disabled/>
          ผิดความแรง</td>
      </tr>
      <tr>
        <td><input name="p11" type="checkbox" id="checkbox11" value="1" <? if($arr_edit['p11']=="1"){ echo "checked"; }?> disabled/>
          ผิดรูปแบบยา</td>
      </tr>
      <tr>
        <td><input name="p12" type="checkbox" id="checkbox12" value="1" <? if($arr_edit['p12']=="1"){ echo "checked"; }?> disabled />
          ผิดวิธีใช้</td>
      </tr>
      <tr>
        <td><input name="p13" type="checkbox" id="checkbox13" value="1" <? if($arr_edit['p13']=="1"){ echo "checked"; }?> disabled/>
          ผิดปริมาณ/จำนวนยา</td>
      </tr>
      <tr>
        <td><input name="p14" type="checkbox" id="checkbox14" value="1" <? if($arr_edit['p14']=="1"){ echo "checked"; }?> disabled/>
        สั่งยาซ้ำซ้อน</td>
      </tr>
      <tr>
        <td><input name="p15" type="checkbox" id="checkbox29" value="1" <? if($arr_edit['p15']=="1"){ echo "checked"; }?> disabled /> 
          สั่งจ่ายยาไม่ตรงกับผู้ป่วย
</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="d1" type="checkbox" id="checkbox15" value="1"  <? if($arr_edit['d1']=="1"){ echo "checked"; }?> disabled/>
          จ่ายยาไม่ตรงกับผู้ป่วย </td>
      </tr>
      <tr>
        <td><input name="d2" type="checkbox" id="checkbox16" value="1"  <? if($arr_edit['d2']=="1"){ echo "checked"; }?> disabled/>
        จ่ายยาผิดชนิด/ชื่อยา</td>
      </tr>
      <tr>
        <td><input name="d3" type="checkbox" id="checkbox17" value="1"   <? if($arr_edit['d3']=="1"){ echo "checked"; }?> disabled/>
          ผิดขนาด</td>
      </tr>
      <tr>
        <td><input name="d4" type="checkbox" id="checkbox18" value="1"  <? if($arr_edit['d4']=="1"){ echo "checked"; }?> disabled/>
          ผิดความแรง</td>
      </tr>
      <tr>
        <td><input name="d5" type="checkbox" id="checkbox19" value="1"  <? if($arr_edit['d5']=="1"){ echo "checked"; }?>  disabled/>
          ผิดจำนวน/ปริมาณ</td>
      </tr>
      <tr>
        <td><input name="d6" type="checkbox" id="checkbox20" value="1"  <? if($arr_edit['d6']=="1"){ echo "checked"; }?> disabled/>
          ผิดรูปแบบ</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="d7" type="checkbox" id="checkbox22" value="1"   <? if($arr_edit['d7']=="1"){ echo "checked"; }?> disabled/>
          จ่ายยาหมดอายุ/เสื่อมสภาพโดยสภาพเก็บไม่เหมาะสม</td>
      </tr>
      <tr>
        <td><input name="d8" type="checkbox" id="checkbox23" value="1"  <? if($arr_edit['d8']=="1"){ echo "checked"; }?> disabled/>
          ยาขาด Stock ไม่สามารถจัดยาได้ตามใบสั่งขณะนั้น</td>
      </tr>
      <tr>
        <td><input name="d9" type="checkbox" id="checkbox28" value="1"   <? if($arr_edit['d9']=="1"){ echo "checked"; }?> disabled/>
          อื่นๆ .......<?=$arr_edit['d_detail']?>........</td>
      </tr>
      <tr>
        <td align="center"></td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="2" align="center">การคัดลอกคำสั่ง (Transcribing error)</td>
    <td colspan="2" align="center">การบริหารยา (Administration error)</td>
    </tr>
  <tr>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">

      <tr>
        <td><input name="t1" type="checkbox" id="checkbox21" value="1"   <? if($arr_edit['t1']=="1"){ echo "checked"; }?> disabled/>
          ผิดชื่อยา/ชนิดยา</td>
      </tr>
      <tr>
        <td><input name="t2" type="checkbox" id="checkbox24" value="1" <? if($arr_edit['t2']=="1"){ echo "checked"; }?> disabled/>
        ผิดความแรง</td>
      </tr>
      <tr>
        <td><input name="t3" type="checkbox" id="checkbox25" value="1"  <? if($arr_edit['t3']=="1"){ echo "checked"; }?> disabled/>
          ผิดรูปแบบยา</td>
      </tr>
      <tr>
        <td><input name="t4" type="checkbox" id="checkbox26" value="1"  <? if($arr_edit['t4']=="1"){ echo "checked"; }?> disabled/>
          ผิดวิธีใช้</td>
      </tr>
      <tr>
        <td><input name="t5" type="checkbox" id="checkbox27" value="1"  <? if($arr_edit['t5']=="1"){ echo "checked"; }?> disabled/>
          ผิดปริมาณ/จำนวนยาซ้ำซ้อน</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="t6" type="checkbox" id="checkbox32" value="1"  <? if($arr_edit['t6']=="1"){ echo "checked"; }?> disabled/>
          ยาไม่ตรงกับชื่อผู้ใช้</td>
      </tr>
      <tr>
        <td><input name="t7" type="checkbox" id="checkbox33" value="1"  <? if($arr_edit['t7']=="1"){ echo "checked"; }?> disabled/>
          ยาที่แพทย์ไม่ได้สั่ง</td>
      </tr>
      <tr>
        <td><input name="t8" type="checkbox" id="checkbox34" value="1" <? if($arr_edit['t8']=="1"){ echo "checked"; }?> disabled/>
          อื่นๆ.....<?=$arr_edit['t_detail']?>......</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="a1" type="checkbox" id="checkbox39" value="1" <? if($arr_edit['a1']=="1"){ echo "checked"; }?> disabled/>
          ไม่จ่ายยาในเวลาที่กำหนด/ลืมให้ยา</td>
      </tr>
      <tr>
        <td><input name="a2" type="checkbox" id="checkbox40" value="1"  <? if($arr_edit['a2']=="1"){ echo "checked"; }?> disabled/>
          ผิดขนาด/ความแรง</td>
      </tr>
      <tr>
        <td><input name="a3" type="checkbox" id="checkbox41" value="1" <? if($arr_edit['a3']=="1"){ echo "checked"; }?> disabled/>
          ผิดชื่อยา/ชนิดยา</td>
      </tr>
      <tr>
        <td><p>
          <input name="a4" type="checkbox" id="checkbox42" value="1" <? if($arr_edit['a4']=="1"){ echo "checked"; }?> disabled/>
          ผิดอัตราการให้ยา/สารละลาย</p></td>
      </tr>
      <tr>
        <td><input name="a5" type="checkbox" id="checkbox43" value="1"  <? if($arr_edit['a5']=="1"){ echo "checked"; }?> disabled/>
          ผิดตำแหน่ง/วิถีทาง/รูปแบบ</td>
      </tr>
      <tr>
        <td><input name="a6" type="checkbox" id="checkbox44" value="1"  <? if($arr_edit['a6']=="1"){ echo "checked"; }?> disabled/>
          ผิดคน</td>
      </tr>
      <tr>
        <td><input name="a7" type="checkbox" id="checkbox45" value="1"  <? if($arr_edit['a7']=="1"){ echo "checked"; }?> disabled/>
          อื่นๆ .....<?=$arr_edit['a_detail']?>.....</td>
      </tr>
      <tr>
        <td align="center">&nbsp;</td>
      </tr>
    </table></td>
    <td valign="top"><table border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td><input name="a8" type="checkbox" id="checkbox46" value="1"  <? if($arr_edit['a8']=="1"){ echo "checked"; }?> disabled/>
          ให้ยาไม่ครบรายการ(ขาด/เกิน)</td>
      </tr>
      <tr>
        <td><input name="a9" type="checkbox" id="checkbox47" value="1"  <? if($arr_edit['a9']=="1"){ echo "checked"; }?> disabled/>
          ให้ยามากกว่า/น้อยกว่าจำนวนครั้งที่สั่ง</td>
      </tr>
      <tr>
        <td><input name="a10" type="checkbox" id="checkbox48" value="1"  <? if($arr_edit['a10']=="1"){ echo "checked"; }?> disabled/>
          เตรียม/ผสมยาผิด</td>
      </tr>
      <tr>
        <td><p>
          <input name="a11" type="checkbox" id="checkbox49" value="1"  <? if($arr_edit['a11']=="1"){ echo "checked"; }?> disabled/>
          เก็บรักษายาผิด(ยาค้าง stock/<br />
          เก็บยาอันตรายในรถฉุกเฉิน <br />
          เก็บยาไม่เหมาะสม เช่นนอกตู้เย็น ไม่ป้องกันแสง)</p></td>
      </tr>
      <tr>
        <td><input name="a12" type="checkbox" id="checkbox50" value="1"  <? if($arr_edit['a12']=="1"){ echo "checked"; }?> disabled/>
          ให้ยาหมดอายุ/เสื่อมสภาพ</td>
      </tr>
    </table></td>
  </tr>
  <tr>
    <td colspan="4" align="center" valign="top">Compliance Error (การใช้ยาของผู้ป่วย)</td>
    </tr>
  <tr>
    <td colspan="4" valign="top"><input name="c1" type="checkbox" id="c1" value="1"  <? if($arr_edit['c1']=="1"){ echo "checked"; }?> disabled/>
      ผู้ป่วยไม่ได้รับประทานยาตามแพทย์สั่ง
      <input name="c2" type="checkbox" id="checkbox31" value="1" <? if($arr_edit['c2']=="1"){ echo "checked"; }?> disabled />
      อื่นๆ.............<?=$arr_edit['c_detail']?>............</td>
    </tr>
</table>
<br />
<table border="0" align="center" cellpadding="0" cellspacing="0" class="font2">
  <tr>
    <td colspan="3"><u>ระดับความรุนแรง</u></td>
    </tr>
  <tr>
    <td width="27"><input type="radio" name="level_vio" id="radio" value="A"  <? if($arr_edit['level_vio']=="A"){ echo "checked"; }?> disabled/></td>
    <td width="17">A</td>
    <td width="718">เหตุการณ์ซึ่งมีโอกาสที่จะก่อให้เกิดความคลาดเคลื่อน</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio2" value="B"  <? if($arr_edit['level_vio']=="B"){ echo "checked"; }?> disabled/></td>
    <td>B</td>
    <td>เกิดความคลาดเคลื่อนขึ้นแต่ไม่ถึงผู้ป่วย</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio3" value="C"  <? if($arr_edit['level_vio']=="C"){ echo "checked"; }?> disabled/></td>
    <td>C</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย แต่ไม่ทำให้ผู้ป่วยได้รับอันตราย</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio4" value="D"  <? if($arr_edit['level_vio']=="D"){ echo "checked"; }?> disabled/></td>
    <td>D</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ต้องการเฝ้าระวังเพื่อให้มั่นใจว่าไม่เกิดอันตรายแก่ผู้ป่วยและหรือต้องมีบำบัดรักษา</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio5" value="E"  <? if($arr_edit['level_vio']=="E"){ echo "checked"; }?> disabled/></td>
    <td>E</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ส่งผลให้เกิดอันตรายชั่วคราว และต้องมีการบำบัดรักษา</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio6" value="F"  <? if($arr_edit['level_vio']=="F"){ echo "checked"; }?> disabled/></td>
    <td>F</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ส่งผลให้เกิดอันตรายชั่วคราว และต้องนอนในโรงพยาบาลหรืออยู่โรงพยาบาลนานขึ้น</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio7" value="G"  <? if($arr_edit['level_vio']=="G"){ echo "checked"; }?> disabled/></td>
    <td>G</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ส่งผลให้เกิดอันตรายถาวรแก่ผู้ป่วย</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio8" value="H" <? if($arr_edit['level_vio']=="H"){ echo "checked"; }?> disabled/></td>
    <td>H</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ส่งผลทำให้ต้องทำการช่วยชีวิต</td>
  </tr>
  <tr>
    <td><input type="radio" name="level_vio" id="radio9" value="I" <? if($arr_edit['level_vio']=="I"){ echo "checked"; }?> disabled/></td>
    <td>I</td>
    <td>เกิดความคลาดเคลื่อนกับผู้ป่วย ซึ่งอาจจะเป็นสาเหตุของการเสียชีวิต</td>
  </tr>
  <tr>
    <td colspan="3">&nbsp;</td>
    </tr>
  <tr>
    <td height="32" colspan="3">รายละเอียดอื่นๆ ของเหตุการณ์ </td>
  </tr>
  <tr>
    <td colspan="3"><?=$arr_edit['action_detail'] ?></td>
  </tr>
  <tr id="no_print">
    <td><a href="fha_from.php">กลับไปหน้าแบบฟอร์ม</a></td>
  </tr>
</table>
</form>
</body>