<?
session_start();
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
<title>รายงาน SWAB COVID* - 01</title>

<p align="center" style="margin-top: 20px;"><strong>รายงานผู้ป่วยมารับบริการตรวจ SWAB COVID*</strong></p>
<div align="center">
<form method="POST" action="report_30bath_01_show.php" target="_blank">
</p>
    <strong>วันที่ : </strong><select size="1" name="day1" class="txt">
    <!--option selected>-------เลือก-------</option-->
 <?
$number = 1;  
	for($i=01;$i<=31;$i++){
	  echo "<option value='".str_pad($i, 2, '0', STR_PAD_LEFT)."'>".str_pad($i, 2, '0', STR_PAD_LEFT)."</option>";
	}//end for	
 ?>
    </select>

    <strong>เดือน : </strong><select size="1" name="month1" class="txt">
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

&nbsp;&nbsp;&nbsp;

       <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
</form>

<br><br>
* ค่า SWAB COVID ประกันสังคม และ  Antigen chromatography (เชิงรุกในหน่วยบริการ)
</div>
