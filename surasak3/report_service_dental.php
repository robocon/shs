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
<div align="center" style="margin-top: 20px;"><strong>รายงานค่าบริการทางการแพทย์กองทันตกรรม</strong>
</div>
<div align="center" style="margin-top: 20px;">
<form method="POST" action="report_service_dental1.php" target="_blank">
<p align="center"><strong>ประเภท : <select name="type" class="txt">
  <option value="in_opd">ในเวลาราชการ</option>
  <option value="out_opd">นอกเวลาราชการ</option>
</select></strong></p>
<p align="center"><strong>เลือกแพทย์ : </strong>
    <select name="doctor" id="doctor" class="txt">
    <?
    $sql="select * from doctor where status='y' and menucode='ADMDEN'";
	$query=mysql_query($sql);
	while($rows=mysql_fetch_array($query)){
	?>
    <option value="<?=$rows["name"];?>"><?=$rows["name"];?></option>
    <?
	}
	?>
    </select></p>
	<strong>วันที่ : </strong>
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
       <input type="submit" value="ดูข้อมูล" name="B1"  class="txt" />
</form>
</div>
