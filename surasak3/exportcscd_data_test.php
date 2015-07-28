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
</style><form method="POST" action="datacscd/exportdatacscd_test.php">
<p><strong>ส่งออกข้อมูลเบิก CSCD แต่ละเดือน</strong>  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../nindex.htm'  class='txt'><< ไปเมนู</a></p>
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
    <option value="<?=$dd;?>"><?=$dd;?></option>
  <?
  }
  ?>
  </select>
  &nbsp; 
  <select size="1" name="rptmo" class="txt">
    <option selected>-------เลือก-------</option>
    <option value="01">มกราคม</option>
    <option value="02">กุมภาพันธ์</option>
    <option value="03">มีนาคม</option>
    <option value="04">เมษายน</option>
    <option value="05">พฤษภาคม</option>
    <option value="06">มิถุนายน</option>
    <option value="07">กรกฎาคม</option>
    <option value="08">สิงหาคม</option>
    <option value="09">กันยายน</option>
    <option value="10">ตุลาคม</option>
    <option value="11">พฤศจิกายน</option>
    <option value="12">ธันวาคม</option>

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
      <p style="margin-left: 65px;"><input type="submit" value="ส่งออกข้อมูล" name="B1"  class="txt" /></p>
</form>

