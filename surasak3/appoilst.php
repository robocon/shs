<form method="POST" action="appoited.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
   รายชื่อผู้ป่วยนัดตามแพทย์</b></font></font></p>
  <font face="Angsana New">วันที่&nbsp;&nbsp;<input type="text" name="appdate" size="2"><select size="1" name="appmo">
    <option selected>--เดือน--</option>
    <option value="มกราคม">มกราคม</option>
    <option value="กุมภาพันธ์">กุมภาพันธ์</option>
    <option value="มีนาคม">มีนาคม</option>
    <option value="เมษายน">เมษายน</option>
    <option value="พฤษภาคม">พฤษภาคม</option>
    <option value="มิถุนายน">มิถุนายน</option>
    <option value="กรกฎาคม">กรกฎาคม</option>
    <option value="สิงหาคม">สิงหาคม</option>
    <option value="กันยายน">กันยายน</option>
    <option value="ตุลาคม">ตุลาคม</option>
    <option value="พฤศจิกายน">พฤศจิกายน</option>
    <option value="ธันวาคม">ธันวาคม</option>
  </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></p>
  <p><font face="Angsana New">แพทย์ผู้นัด&nbsp;


 <?php
   include("connect.inc");
  $sql = "Select menucode From inputm where idname = '".$_SESSION["sIdname"]."' ";
list($menucode) = Mysql_fetch_row(Mysql_Query($sql));

  if($menucode == "ADMMAINOPD"){
  ?>
  
  <? 

$strSQL = "SELECT name FROM doctor  where status='y'  and menucode !='ADMPT'  order by name "; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>



  
	  <?php }else{?>
	  <? 
	 $strSQL = "SELECT name FROM doctor where status='y' order by name"; 
$objQuery = mysql_query($strSQL) or die ("Error Query [".$strSQL."]"); 
?>
<select name="doctor"> 
<? 
while($objResult = mysql_fetch_array($objQuery)) 
{ 
?> 
<option value="<?=$objResult["name"];?>"><?=$objResult["name"];?></option> 
<? 
} 
?> 
</select>

	  <?php }?>
</font> </p>
<p>นัดมาเพื่อ
  <select size="1" name="detail2">
    <option value="">ดูทั้งหมด</option>
    <?
      $app = "select * from applist  WHERE status='Y' ";
	  $row = mysql_query($app);
	  while($result = mysql_fetch_array($row)){
		  $str="";
		  if($menucode == "ADMMAINOPD"){ 
		  	$str = " Selected ";
		  }
?>
    <option value="<?=$result['appvalue']?>" <?=$str;?>>
      <?=$result['applist']?>
      </option>
    <?
	  }
?>
    <!--<option value="FU01" <?php //if($menucode == "ADMMAINOPD"){ echo " Selected ";}?>>ตรวจตามนัด</option>
<option value="FU02">ตามผลตรวจ</option>
<option value="FU03">นอนโรงพยาบาล</option>
<option value="FU04">ทันตกรรม</option>
<option value="FU05">ผ่าตัด</option>
<option value="FU06">สูติ</option>
<option value="FU07">คลีนิกฝังเข็ม</option>
<option value="FU08">Echo</option>
<option value="FU09">มวลกระดูก</option>
<option value="FU10">กายภาพ</option>
<option value="FU11">ตรวจตามนัดพร้อมประวัติผู้ป่วยใน</option>
<option value="FU12">นวดแผนไทย</option>
<option value="FU13">ส่องกระเพาะ</option>
<option value="FU20)">ส่องกระเพาะ(คลินิกพิเศษ)</option>
<option value="FU14">เจาะเลือดไม่พบแพทย์</option>
<option value="FU15">OPD นอกเวลาราชการ</option>
<option value="FU16">คลินิกศัลยกรรมนอกเวลาพิเศษ(ค่าบริการ 100 บาท)</option>
<option value="FU17">X-ray ไม่พบแพทย์</option>
<option value="FU18">ตัดไหมที่ ER ไม่พบแพทย์</option>
<option value="FU19"> อัลตร้าซาวด์</option>
<option value="FU21">คลินิก C OPD</option>
<option value="FU22">OPD เวชศาสตร์ฟื่นฟู</option>
<option value="FU26">EMG</option>
<option value="FU27">X-ray ก่อนพบแพทย์</option>
<option value="FU28">Lab ก่อนพบแพทย์</option>
<option value="FU29">X-ray + Lab ก่อนพบแพทย์</option>
<option value="FU30 คลินิกโรคไต">คลินิกโรคไต</option>-->
  </select>
</p>
  <input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a>&nbsp&nbsp;&nbsp<a target=_self  href='hnappoi1.php'>ออกใบนัดใหม่</a></p>
  </form>
    <br><a target=_BLANK href="calendar.php">ปฏิทิน</a>

<form method="POST" action="appoited1.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
   รายชื่อผู้ป่วยนัดตามแผนก</b></font></font></p>
  <font face="Angsana New">วันที่&nbsp;&nbsp;

<select size="1" name="appdate">
    <option selected>--วันที่--</option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
   </select>
    

<select size="1" name="appmo">
    <option selected>--เดือน--</option>
    <option value="มกราคม">มกราคม</option>
    <option value="กุมภาพันธ์">กุมภาพันธ์</option>
    <option value="มีนาคม">มีนาคม</option>
    <option value="เมษายน">เมษายน</option>
    <option value="พฤษภาคม">พฤษภาคม</option>
    <option value="มิถุนายน">มิถุนายน</option>
    <option value="กรกฎาคม">กรกฎาคม</option>
    <option value="สิงหาคม">สิงหาคม</option>
    <option value="กันยายน">กันยายน</option>
    <option value="ตุลาคม">ตุลาคม</option>
    <option value="พฤศจิกายน">พฤศจิกายน</option>
    <option value="ธันวาคม">ธันวาคม</option>
  </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></p>
  <p><font face="Angsana New">แผนกที่นัด&nbsp;

  <select size="1" name="detail">
    <option selected><เลือกแผนก></option>
    <?
      $app = "select * from applist   WHERE status='Y' ";
	  $row = mysql_query($app);
	  while($result = mysql_fetch_array($row)){
?>
<option value="<?=$result['appvalue']?>" ><?=$result['applist']?></option>
<?
	  }
?>
    <!--<option value="FU01 ตรวจตามนัด">ตรวจตามนัด</option>
<option value="FU02 ตามผลตรวจ">ตามผลตรวจ</option>
<option value="FU03 นอนโรงพยาบาล">นอนโรงพยาบาล</option>
<option value="FU04 ทันตกรรม">ทันตกรรม</option>
<option value="FU05 ผ่าตัด">ผ่าตัด</option>
<option value="FU06 สูติ">สูติ</option>
<option value="FU07 คลีนิกฝังเข็ม">คลีนิกฝังเข็ม</option>
<option value="FU08 Echo">Echo</option>
<option value="FU09 มวลกระดูก">มวลกระดูก</option>
<option value="FU10 กายภาพ">กายภาพ</option>
<option value="FU11 ตรวจตามนัดพร้อมประวัติผู้ป่วยใน">ตรวจตามนัดพร้อมประวัติผู้ป่วยใน</option>
<option value="FU12 นวดแผนไทย">นวดแผนไทย</option>
<option value="FU13 ส่องกระเพาะ">ส่องกระเพาะ</option>
<option value="FU20 ส่องกระเพาะ(คลินิกพิเศษ)">ส่องกระเพาะ(คลินิกพิเศษ)</option>
<option value="FU14 เจาะเลือดไม่พบแพทย์">เจาะเลือดไม่พบแพทย์</option>
<option value="FU15 OPD นอกเวลา">OPD นอกเวลาราชการ</option>
<option value="FU16 คลินิกพิเศษ">คลินิกศัลยกรรมนอกเวลาพิเศษ(ค่าบริการ 100 บาท)</option>
<option value="FU17 X-ray ไม่พบแพทย์">X-ray ไม่พบแพทย์</option>
<option value="FU18 ตัดไหมที่ ER ไม่พบแพทย์">ตัดไหมที่ ER ไม่พบแพทย์</option>
<option value="FU19 อัลตร้าซาวด์"> อัลตร้าซาวด์</option>
<option value="FU21 คลินิก C OPD">คลินิก C OPD</option>
<option value="FU22 ตรวจตามนัดOPD เวชศาสตร์ฟื่นฟู">OPD เวชศาสตร์ฟื่นฟู</option>
<option value="FU26 EMG">EMG</option>
<option value="FU27 X-ray ก่อนพบแพทย์">X-ray ก่อนพบแพทย์</option>
<option value="FU28 Lab ก่อนพบแพทย์">Lab ก่อนพบแพทย์</option>
<option value="FU29 X-ray + Lab ก่อนพบแพทย์">X-ray + Lab ก่อนพบแพทย์</option>
<option value="FU30 คลินิกโรคไต">คลินิกโรคไต</option>-->

    </select></font> </p>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a></p>
 </form>

  <form method="POST" action="appoited3.php"  target=_BLANK>
  <p>&nbsp;<font face="Angsana New"><font size="4"><b>
   รายชื่อผู้ป่วยตามการนัดมาเพื่อ</b></font></font></p>
  <font face="Angsana New">วันที่&nbsp;&nbsp;

<select size="1" name="appdate">
    <option value="" selected>--</option>
    <option value="01">01</option>
    <option value="02">02</option>
    <option value="03">03</option>
    <option value="04">04</option>
    <option value="05">05</option>
    <option value="06">06</option>
    <option value="07">07</option>
    <option value="08">08</option>
    <option value="09">09</option>
    <option value="10">10</option>
    <option value="11">11</option>
    <option value="12">12</option>
    <option value="13">13</option>
    <option value="14">14</option>
    <option value="15">15</option>
    <option value="16">16</option>
    <option value="17">17</option>
    <option value="18">18</option>
    <option value="19">19</option>
    <option value="20">20</option>
    <option value="21">21</option>
    <option value="22">22</option>
    <option value="23">23</option>
    <option value="24">24</option>
    <option value="25">25</option>
    <option value="26">26</option>
    <option value="27">27</option>
    <option value="28">28</option>
    <option value="29">29</option>
    <option value="30">30</option>
    <option value="31">31</option>
   </select>
    

<select size="1" name="appmo">
    <option selected>--เดือน--</option>
    <option value="มกราคม">มกราคม</option>
    <option value="กุมภาพันธ์">กุมภาพันธ์</option>
    <option value="มีนาคม">มีนาคม</option>
    <option value="เมษายน">เมษายน</option>
    <option value="พฤษภาคม">พฤษภาคม</option>
    <option value="มิถุนายน">มิถุนายน</option>
    <option value="กรกฎาคม">กรกฎาคม</option>
    <option value="สิงหาคม">สิงหาคม</option>
    <option value="กันยายน">กันยายน</option>
    <option value="ตุลาคม">ตุลาคม</option>
    <option value="พฤศจิกายน">พฤศจิกายน</option>
    <option value="ธันวาคม">ธันวาคม</option>
  </select><? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?></p>
  <p><font face="Angsana New">นัดมาเพื่อ&nbsp;

<select size="1" name="detail">
<?
      $app = "select * from applist   WHERE status='Y'  ";
	  $row = mysql_query($app);
	  while($result = mysql_fetch_array($row)){
?>
<option value="<?=$result['appvalue']?>" ><?=$result['applist']?></option>
<?
	  }
?>
<!--<option value="FU01 ตรวจตามนัด">ตรวจตามนัด</option>
<option value="FU02 ตามผลตรวจ">ตามผลตรวจ</option>
<option value="FU03 นอนโรงพยาบาล">นอนโรงพยาบาล</option>
<option value="FU04 ทันตกรรม">ทันตกรรม</option>
<option value="FU05 ผ่าตัด">ผ่าตัด</option>
<option value="FU06 สูติ">สูติ</option>
<option value="FU07 คลีนิกฝังเข็ม">คลีนิกฝังเข็ม</option>
<option value="FU08 Echo">Echo</option>
<option value="FU09 มวลกระดูก">มวลกระดูก</option>
<option value="FU10 กายภาพ">กายภาพ</option>
<option value="FU11 ตรวจตามนัดพร้อมประวัติผู้ป่วยใน">ตรวจตามนัดพร้อมประวัติผู้ป่วยใน</option>
<option value="FU12 นวดแผนไทย">นวดแผนไทย</option>
<option value="FU13 ส่องกระเพาะ">ส่องกระเพาะ</option>
<option value="FU20 ส่องกระเพาะ(คลินิกพิเศษ)">ส่องกระเพาะ(คลินิกพิเศษ)</option>
<option value="FU14 เจาะเลือดไม่พบแพทย์">เจาะเลือดไม่พบแพทย์</option>
<option value="FU15 OPD นอกเวลา">OPD นอกเวลาราชการ</option>
<option value="FU16 คลินิกพิเศษ">คลินิกศัลยกรรมนอกเวลาพิเศษ(ค่าบริการ 100 บาท)</option>
<option value="FU17 X-ray ไม่พบแพทย์">X-ray ไม่พบแพทย์</option>
<option value="FU18 ตัดไหมที่ ER ไม่พบแพทย์">ตัดไหมที่ ER ไม่พบแพทย์</option>
<option value="FU19 อัลตร้าซาวด์"> อัลตร้าซาวด์</option>
<option value="FU21 คลินิก C OPD">คลินิก C OPD</option>
<option value="FU22 ตรวจตามนัดOPD เวชศาสตร์ฟื่นฟู">OPD เวชศาสตร์ฟื่นฟู</option>
<option value="FU26 EMG">EMG</option>
<option value="FU27 X-ray ก่อนพบแพทย์">X-ray ก่อนพบแพทย์</option>
<option value="FU28 Lab ก่อนพบแพทย์">Lab ก่อนพบแพทย์</option>
<option value="FU29 X-ray + Lab ก่อนพบแพทย์">X-ray + Lab ก่อนพบแพทย์</option>
<option value="FU30 คลินิกโรคไต">คลินิกโรคไต</option>-->

</select></font> </p>

  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="submit" value="     &#3605;&#3585;&#3621;&#3591;    " name="B1">
  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< &#3648;&#3617;&#3609;&#3641;</a></p>
  </form>


