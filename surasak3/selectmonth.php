<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 20px;
}
.font1{
	font-family: TH SarabunPSK;
	font-size: 20px;
}
a:link {
	text-decoration: none;
}
a:visited {
	text-decoration: none;
}
a:hover {
	text-decoration: none;
}
a:active {
	text-decoration: none;
}
-->
</style><p align="center"><strong>รายงานสถิติทางการแพทย์ ของ รพ.ทบ.</strong></p>
<div align="center">
<form action="menupst.php" method="post">
  <span> เลือก เดือน </span>: 
  <select name="mon" class="font1">
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
  &nbsp;&nbsp;<span class="font1">ปี</span>
  : <?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='font1'>";
foreach($dates as $i){
?>
  <option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
  <?=$i;?>
  </option>
  <?
}
echo "<select>";
?>
&nbsp;  
<input name="BOK" class="font1" value="ดูรายงาน" type="submit" />
</form>
<p><a href="../nindex.htm">เมนูหลัก</a></p>
</div>