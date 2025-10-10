<?
session_start();

$user_code = $_SESSION['smenucode'];
$user_id = $_SESSION['sIdname'];
if( $user_code !== 'ADM' && $user_code !== 'ADMFINANCE'){
    
    // ตรวจสอบชื่อ และ menucode ว่าอยู่ในรายการหรือไม่
    $check_level = in_array($user_code, array('ADMLAB'));
    $check_user = in_array($user_id, array('สมยศ','นิรชา')); 
    
    if( $check_level === false OR $check_user === false ){
        ?>
        <p align="center">คุณไม่มีสิทธิ์เข้าใช้งาน</p>
        <p align="center"><a href="../nindex.htm">คลิกที่นี่</a> เพื่อกลับไปหน้าเมนูหลัก</p>
        <?php
        exit;
    }
}

include("connect.inc");
?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.txt{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<p align="center" style="margin-top: 20px;"><strong>รายงานรายรับสถานพยาบาลตามห้วงเวลา</strong></p>
<div align="center">
<form method="POST" action="report_money06.php" >
	<strong>ระหว่างวันที่ : </strong>
    <input name="date1" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เลือกเดือน : </strong><select size="1" name="month1" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year1'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
       &nbsp; <strong>ถึงวันที่</strong> 
    <input name="date2" type="text" id="date1" size="1" value="<?=date("d");?>" class="txt">
    <strong>เลือกเดือน : </strong><select size="1" name="month2" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if(date("m")=="01"){ echo "selected";}?>>มกราคม</option>
    <option value="02" <? if(date("m")=="02"){ echo "selected";}?>>กุมภาพันธ์</option>
    <option value="03" <? if(date("m")=="03"){ echo "selected";}?>>มีนาคม</option>
    <option value="04" <? if(date("m")=="04"){ echo "selected";}?>>เมษายน</option>
    <option value="05" <? if(date("m")=="05"){ echo "selected";}?>>พฤษภาคม</option>
    <option value="06" <? if(date("m")=="06"){ echo "selected";}?>>มิถุนายน</option>
    <option value="07" <? if(date("m")=="07"){ echo "selected";}?>>กรกฎาคม</option>
    <option value="08" <? if(date("m")=="08"){ echo "selected";}?>>สิงหาคม</option>
    <option value="09" <? if(date("m")=="09"){ echo "selected";}?>>กันยายน</option>
    <option value="10" <? if(date("m")=="10"){ echo "selected";}?>>ตุลาคม</option>
    <option value="11" <? if(date("m")=="11"){ echo "selected";}?>>พฤศจิกายน</option>
    <option value="12" <? if(date("m")=="12"){ echo "selected";}?>>ธันวาคม</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='year2'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>       
&nbsp;&nbsp;ลูกหนี้ : <select name="credit" class="txt">
  <option value="all" select>ทั้งหมด</option>
  <option value="จ่ายตรง">จ่ายตรง</option>
  <option value="จ่ายตรง อปท.">จ่ายตรง อปท.</option>
  <option value="จ่ายตรง อปท. (HD)">จ่ายตรง อปท. (HD)</option>
  <option value="ประกันสังคม">ประกันสังคม</option>
  <option value="30บาท">30บาท</option>
  <option value="กทม">กทม</option>
  <option value="เงินสด">เงินสด</option>
  <option value="เงินโอน">เงินโอน</option>
  <option value="HD">HD</option>
  <option value="กท44">กท44</option>
  <option value="ทหารไทย">ทหารไทย</option>
  <option value="เช็ค">เช็ค</option>
  <option value="พรบ.">พรบ.</option>
  <option value="ออมสิน">ธนาคารออมสิน</option>
  <option value="ธปท">ธนาคารแห่งประเทศไทย</option>
  <option value="ททท">การท่องเที่ยวแห่งประเทศไทย</option>
  <option value="ตรวจสุขภาพ">ตรวจสุขภาพ</option>
  <option value="ตรวจสุขภาพตำรวจ">ตรวจสุขภาพตำรวจ</option>
  <option value="CHKUP66">ตรวจสุขภาพทหารประจำปี</option>
  <option value="SSOCHECKUP66">ตรวจสุขภาพประกันสังคม</option>
  <option value="DENTALSSO66">ทันตกรรมประกันสังคม</option>
  <option value="ทันตสาธารณสุข">ทันตสาธารณสุข</option> <!-- น่าจะฟรี-->
  <option value="PAYCHKUP66">เรียกเก็บตรวจสุขภาพ</option>
  <option value="อื่นๆ">อื่นๆ</option>
</select>&nbsp;&nbsp;
    <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
</form>
</div>
