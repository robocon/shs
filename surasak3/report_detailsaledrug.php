<?php
    include("connect.inc");

///function convert to float number ทศนิยม 2ตำแหน่ง
function vat($nVArabic){
    $nVArabic = number_format($nVArabic, 2, '.', ''); 
    $cTarget = Ltrim($nVArabic);
    $cLtnum="";
    $x=0;
    while (substr($cTarget,$x,1) <> "."){
            $cLtnum=$cLtnum.substr($cTarget,$x,1);
            $x++;
	}
   $cRtnum=substr($cTarget,$x+1);

$cRtnum=$cRtnum/107;
$cRtnum=intval($cRtnum);
$vat=$nVArabic+$cRtnum;
return $vat;
	}
///end of function convert to float number ทศนิยม 2ตำแหน่ง	
?>
<style>
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
.font1 {
	font-family: TH SarabunPSK;
	font-size:18px;
}

.fromthai {
font-family: TH SarabunPSK;
font-size: 18px;
}
body,td,th {
	font-family: TH SarabunPSK;
}
</style>
<div id="no_print" >
<span class="font1">
<font face="TH SarabunPSK" size="+2">
<strong>ทะเบียนคุมยาและเวชภัณฑ์</strong>
</font>
</span>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<a target=_top  href="../nindex.htm"><< ไปเมนู</a>
<form action="<? $_SERVER['PHP_SELF']?>" method="post">
<span class="font1">
เดือน 
</span>
<?
$mm=date("m");
?>
 <select name="mon" class="fromthai">
   <option value="01" <? if($mm=="01"){ echo "selected='selected'";}?>>มกราคม</option>
   <option value="02" <? if($mm=="02"){ echo "selected='selected'";}?>>กุมภาพันธ์</option>
   <option value="03" <? if($mm=="03"){ echo "selected='selected'";}?>>มีนาคม</option>
   <option value="04" <? if($mm=="04"){ echo "selected='selected'";}?>>เมษายน</option>
   <option value="05" <? if($mm=="05"){ echo "selected='selected'";}?>>พฤษภาคม</option>
   <option value="06" <? if($mm=="06"){ echo "selected='selected'";}?>>มิถุนายน</option>
   <option value="07" <? if($mm=="07"){ echo "selected='selected'";}?>>กรกฎาคม</option>
   <option value="08" <? if($mm=="08"){ echo "selected='selected'";}?>>สิงหาคม</option>
   <option value="09" <? if($mm=="09"){ echo "selected='selected'";}?>>กันยายน</option>
   <option value="10" <? if($mm=="10"){ echo "selected='selected'";}?>>ตุลาคม</option>
   <option value="11" <? if($mm=="11"){ echo "selected='selected'";}?>>พฤศจิกายน</option>
   <option value="12" <? if($mm=="12"){ echo "selected='selected'";}?>>ธันวาคม</option>
 </select>
<span class="font1">
ปี
</span>
<?
$Y=date("Y")+543;
$date=date("Y")+543+5;
			  
$dates=range(2547,$date);
echo "<select name='year' class='fromthai'>";
foreach($dates as $i){
?>
	<option value='<?=$i-543; ?>' <? if($Y==$i){ echo "selected"; }?>>
	<?=$i;?>
	</option>
<?
}
echo "<select>";
?>
&nbsp;&nbsp;<input name="BOK" value="ตกลง" class="fromthai" type="submit" />
  </span>
</form>
<hr>
</div>
<?
if(isset($_POST['BOK'])){
$year=$_POST["year"]+543;
//$yymm=$year."-".$_POST["mon"];
	if($_POST['mon']=="01"){
		$mon ="มกราคม";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="02"){
		$mon ="กุมภาพันธ์";
		$d1="01";
		$d2="28";
	}else if($_POST['mon']=="03"){
		$mon ="มีนาคม";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="04"){
		$mon ="เมษายน";
		$d1="01";
		$d2="30";
	}else if($_POST['mon']=="05"){
		$mon ="พฤษภาคม";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="06"){
		$mon ="มิถุนายน";
		$d1="01";
		$d2="30";
	}else if($_POST['mon']=="07"){
		$mon ="กรกฎาคม";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="08"){
		$mon ="สิงหาคม";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="09"){
		$mon ="กันยายน";
		$d1="01";
		$d2="30";
	}else if($_POST['mon']=="10"){
		$mon ="ตุลาคม";
		$d1="01";
		$d2="31";
	}else if($_POST['mon']=="11"){
		$mon ="พฤศจิกายน";
		$d1="01";
		$d2="30";
	}else if($_POST['mon']=="12"){
		$mon ="ธันวาคม";
		$d1="01";
		$d2="31";
	}
	
$yymm=$mon." ".$year;																		
?>
<div align="center"><strong>สถานพยาบาล โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div>
<div align="center">รายละเอียดการจัดซื้อ(ยา) โดยวิธีเฉพาะเจาะจง (กองเภสัชกรรม)</div>
<div align="center">ระยะเวลาตั้งแต่เดือน <?=$d1." ".$mon." ".$year;?> ถึง <?=$d2." ".$mon." ".$year;?></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="2%" align="center"><strong>ลำดับ</strong></td>
    <td width="5%" align="center"><strong>เลขที่สัญญา</strong></td>
    <td width="4%" align="center"><strong>รายการ</strong></td>
    <td width="5%" align="center"><strong>จำนวนเงิน</strong></td>
    <td width="36%" align="center"><strong>คู่สัญญา</strong></td>
    <td width="9%" align="center"><strong>อนุมัติงบประมาณ</strong></td>
    <td width="9%" align="center"><strong>อนุมัติจัดซื้อ</strong></td>
    <td width="9%" align="center"><strong>วันที่ลงนามในสัญญา</strong></td>
    <td width="8%" align="center"><strong>กำหนดส่งมอบ</strong></td>
    <td width="8%" align="center"><strong>วันที่ส่งมอบ</strong></td>
    <td width="5%" align="center"><strong>หมายเหตุ</strong></td>
  </tr>
<?

$sql = "SELECT * FROM pocompany  WHERE bounddate LIKE '%$yymm' AND (potype IS NULL OR potype ='') AND (
prepono !=  'ยกเลิก' AND prepono NOT LIKE  'DS%') and pono !=''  ORDER BY pono asc, ponoyear asc";
//echo $sql;

$result = mysql_query($sql) or die("Query failed1");
$num=mysql_num_rows($result);
$i=0;
$total=0;
while($rows = mysql_fetch_array($result)){
$i++;
$type=substr($rows["pono"],0,2);
if($type=="DS"){
	$typename="เวชภัณฑ์";
}else{
	$typename="ยา";
}
$total=$total+$rows["netprice"];
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["pono"].$rows["ponoyear"];?></td>
    <td align="center"><?=$typename;?></td>
    <td align="right"><?=number_format($rows["netprice"],2);?></td>
    <td><?=$rows["comname"];?></td>
    <td align="right"><?=$rows["podate"];?></td>
    <td align="right"><?=$rows["podate"];?></td>
    <td align="right"><?=$rows["chkindate"];?></td>
    <td align="right"><?=$rows["fixdate"];?></td>
    <td align="right"><?=$rows["bounddate"];?></td>
    <td>&nbsp;</td>
  </tr>
<?
}
?>

</table>
<p align="center" style="font-size:24px;"><strong>รวมเป็นเงินทั้งสิ้น <?=number_format($total,2);?> บาท<strong></p>
<p>&nbsp;</p>
<div align="center"><strong>สถานพยาบาล โรงพยาบาลค่ายสุรศักดิ์มนตรี</strong></div>
<div align="center">รายละเอียดการจัดซื้อ(เวชภัณฑ์) โดยวิธีเฉพาะเจาะจง (กองเภสัชกรรม)</div>
<div align="center">ระยะเวลาตั้งแต่เดือน <?=$d1." ".$mon." ".$year;?> ถึง <?=$d2." ".$mon." ".$year;?></div>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td width="2%" align="center"><strong>ลำดับ</strong></td>
    <td width="5%" align="center"><strong>เลขที่สัญญา</strong></td>
    <td width="4%" align="center"><strong>รายการ</strong></td>
    <td width="5%" align="center"><strong>จำนวนเงิน</strong></td>
    <td width="36%" align="center"><strong>คู่สัญญา</strong></td>
    <td width="9%" align="center"><strong>อนุมัติงบประมาณ</strong></td>
    <td width="9%" align="center"><strong>อนุมัติจัดซื้อ</strong></td>
    <td width="9%" align="center"><strong>วันที่ลงนามในสัญญา</strong></td>
    <td width="8%" align="center"><strong>กำหนดส่งมอบ</strong></td>
    <td width="8%" align="center"><strong>วันที่ส่งมอบ</strong></td>
    <td width="5%" align="center"><strong>หมายเหตุ</strong></td>
  </tr>
<?

$sql = "SELECT * FROM pocompany  WHERE bounddate LIKE '%$yymm' AND potype IS NULL AND (
prepono !=  'ยกเลิก' AND prepono LIKE  'DS%') and pono !=''  ORDER BY pono asc, ponoyear asc";
//echo $sql;

$result = mysql_query($sql) or die("Query failed1");
$num=mysql_num_rows($result);
$i=0;
$total1=0;
while($rows = mysql_fetch_array($result)){
$i++;
$type=substr($rows["pono"],0,2);
if($type=="DS"){
	$typename="เวชภัณฑ์";
}else{
	$typename="ยา";
}
$total1=$total1+$rows["netprice"];

?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$rows["pono"].$rows["ponoyear"];?></td>
    <td align="center"><?=$typename;?></td>
    <td align="right"><?=number_format($rows["netprice"],2);?></td>
    <td><?=$rows["comname"];?></td>
    <td align="right"><?=$rows["podate"];?></td>
    <td align="right"><?=$rows["podate"];?></td>
    <td align="right"><?=$rows["chkindate"];?></td>
    <td align="right"><?=$rows["fixdate"];?></td>
    <td align="right"><?=$rows["bounddate"];?></td>
    <td>&nbsp;</td>
  </tr>
<?
}
?>  
</table>
<p align="center" style="font-size:24px;"><strong>รวมเป็นเงินทั้งสิ้น <?=number_format($total1,2);?> บาท<strong></p>


<?
}  //if bok
?>