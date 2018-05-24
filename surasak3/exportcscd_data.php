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
  <?
  $seldate=date("d");
  $selmon=date("m");
  ?>
<form method="POST" action="datacscd/exportdatacscd.php">
<p><strong>โปรแกรมส่งเบิกค่าชดเชยทางการแพทย์ผู้ป่วยนอก สิทธิเบิกจ่ายตรง (CSCD)<br />
 ปรับปรุงล่าสุด Date11/05/2561 By Pfc.แอมป์ โทร.6203</strong></p>
  <strong>ข้อมูลประจำวันที่ : </strong>
  <select name="rptdate" class="txt" id="rptdate">
  <?
  for($i=1;$i<=31;$i++){
	  if($i < 10){
	  	$dd="0".$i;
	  }else{
	  	$dd=$i;
	  }
  ?>
    <option value="<?=$dd;?>" <? if($seldate==$dd){ echo "selected='selected'";}?>><?=$dd;?></option>
  <?
  }
  ?>
  </select>
  &nbsp; 

  <select size="1" name="rptmo" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01" <? if($selmon=="01"){ echo "selected='selected'";}?>>มกราคม</option>
    <option value="02" <? if($selmon=="02"){ echo "selected='selected'";}?>>กุมภาพันธ์</option>
    <option value="03" <? if($selmon=="03"){ echo "selected='selected'";}?>>มีนาคม</option>
    <option value="04" <? if($selmon=="04"){ echo "selected='selected'";}?>>เมษายน</option>
    <option value="05" <? if($selmon=="05"){ echo "selected='selected'";}?>>พฤษภาคม</option>
    <option value="06" <? if($selmon=="06"){ echo "selected='selected'";}?>>มิถุนายน</option>
    <option value="07" <? if($selmon=="07"){ echo "selected='selected'";}?>>กรกฎาคม</option>
    <option value="08" <? if($selmon=="08"){ echo "selected='selected'";}?>>สิงหาคม</option>
    <option value="09" <? if($selmon=="09"){ echo "selected='selected'";}?>>กันยายน</option>
    <option value="10" <? if($selmon=="10"){ echo "selected='selected'";}?>>ตุลาคม</option>
    <option value="11" <? if($selmon=="11"){ echo "selected='selected'";}?>>พฤศจิกายน</option>
    <option value="12" <? if($selmon=="12"){ echo "selected='selected'";}?>>ธันวาคม</option>

  </select>
  <? 
			   $Y=date("Y")+543;
			   $date=date("Y")+543+5;
			  
				$dates=range(2547,$date);
				echo "<select name='thiyr'  class='txt'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
      <p style="margin-left: 65px;"><input type="submit" value="ส่งออกข้อมูล" name="B1"  class="txt" />&nbsp;&nbsp;&nbsp;<input type="button" value="กลับหน้าหลัก" onclick="window.location.href='../nindex.htm' " class="txt" /></p>
</form>

