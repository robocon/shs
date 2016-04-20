<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.fontform {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
-->
</style>
<form method="POST" action="export_person1.php">
<p style="font-weight:bold">ฐานข้อมูลด้านการแพทย์และสุขภาพ ในรูปแบบ 43 แฟ้มมาตรฐาน ตารางที่1 ตาราง PERSON แต่ละเดือน</p>
<div>แฟ้มข้อมูลประชาชนในเขตรับผิดชอบและผู้ป่วย</div>
  <p style="margin-left: 20px;">เดือน : <select name="rptmo" size="1" class="fontform">
    <option selected>---- เดือน ----</option>
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
				echo "<select name='thiyr' class='fontform'>";
				foreach($dates as $i){

				?>
      
      <option value='<?=$i?>' <? if($Y==$i){ echo "selected"; }?>><?=$i;?></option>
      <?
				}
				echo "<select>";
				?>
    <input name="B1" type="submit" class="fontform" value="    ตกลง    ">
    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_self  href='../../nindex.htm'><< ไปเมนู</a></p>
</form>
