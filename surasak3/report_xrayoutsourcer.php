<?php
    session_start();
	include("connect.inc");
?>	
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style>
<p align="center"><strong>แบบฟอร์มประเภทการเช่าเครื่องตรวจ วิเคราะห์ และรักษา ทุกประเภท<br>
ที่ดำเนินการโดยบริษัท หรือบุคคลภายนอกที่มีความชำนาญในด้านนั้นๆ มาดำเนินการแทน (Outsourcer)<br>
รพ./หน่วย โรงพยาบาลค่ายสุรศักดิ์มนตรี จ.ลำปาง</strong></p>
<p align="center">
<table width="90%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000" style="border-collapse:collapse;">
  <tr>
    <td rowspan="2" align="center" valign="middle"><strong>เครื่องมือ</strong></td>
    <td colspan="3" align="center" valign="middle"><strong>ยอดผู้รับบริการ ปี ๒๕๕๗</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>รายได้รวม<br>
    ปี ๒๕๕๗</strong></td>
    <td colspan="3" align="center" valign="middle"><strong>ยอดผู้รับบริการ ปี ๒๕๕๘</strong></td>
    <td rowspan="2" align="center" valign="middle"><strong>รายได้รวม<br>
ปี ๒๕๕๘</strong></td>
  </tr>
  <tr>
    <td align="center" valign="middle"><strong>ทหาร</strong></td>
    <td align="center" valign="middle"><strong>พลเรือน</strong></td>
    <td align="center" valign="middle"><strong>รวม</strong></td>
    <td align="center" valign="middle"><strong>ทหาร</strong></td>
    <td align="center" valign="middle"><strong>พลเรือน</strong></td>
    <td align="center" valign="middle"><strong>รวม</strong></td>
  </tr>
  <tr>
<?
$sql171="SELECT *
FROM `depart`
WHERE `date`
LIKE '2557%' AND `depart`
LIKE '%HEMO%' AND price >0 GROUP BY hn";
$query171=mysql_query($sql171);
$num171=mysql_num_rows($query171);
$totalarmy57=0;
$totalperson57=0;
while($rows171=mysql_fetch_array($query171)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows171["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army57=1;
		$totalarmy57=$totalarmy57+$army57;
	}else{
		$person57=1;
		$totalperson57=$totalperson57+$person57;	
	}
}



$sql172="SELECT *
FROM `depart`
WHERE `date`
LIKE '2558%' AND `depart`
LIKE '%HEMO%' AND price >0 GROUP BY hn";
$query172=mysql_query($sql172);
$num172=mysql_num_rows($query172);
$totalarmy58=0;
$totalperson58=0;
while($rows172=mysql_fetch_array($query172)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows172["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army58=1;
		$totalarmy58=$totalarmy58+$army58;
	}else{
		$person58=1;
		$totalperson58=$totalperson58+$person58;	
	}
}


$sql1=mysql_query("SELECT sum(price)
FROM `depart`
WHERE `date`
LIKE '2557%' AND `depart`
LIKE '%HEMO%' AND price >0");
list($sumprice571)=mysql_fetch_array($sql1);

$sql2=mysql_query("SELECT sum(price)
FROM `depart`
WHERE `date`
LIKE '2558%' AND `depart`
LIKE '%HEMO%' AND price >0");
list($sumprice581)=mysql_fetch_array($sql2);
?>   
    <td>๑. เครื่องไตเทียม</td>
    <td align="right"><?=$totalarmy57;?></td>
    <td align="right"><?=$totalperson57;?></td>
    <td align="right"><?=$num171;?></td>
    <td align="right"><?=$sumprice571;?></td>
    <td align="right"><?=$totalarmy58;?></td>
    <td align="right"><?=$totalperson58;?></td>
    <td align="right"><?=$num172;?></td>
    <td align="right"><?=$sumprice581;?></td>
  </tr>
  <tr>
<?
$sql271="SELECT  * 
FROM  `patdata` 
WHERE  `date` 
LIKE  '%2557%' AND  `code` 
LIKE  '%sleeptest%' AND price > 0 GROUP BY hn";
$query271=mysql_query($sql271);
$num271=mysql_num_rows($query271);
$totalarmy57=0;
$totalperson57=0;
while($rows271=mysql_fetch_array($query271)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows271["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army57=1;
		$totalarmy57=$totalarmy57+$army57;
	}else{
		$person57=1;
		$totalperson57=$totalperson57+$person57;	
	}
}



$sql272="SELECT  * 
FROM  `patdata` 
WHERE  `date` 
LIKE  '%2558%' AND  `code` 
LIKE  '%sleeptest%' AND price > 0 GROUP BY hn";
$query272=mysql_query($sql272);
$num272=mysql_num_rows($query272);
$totalarmy58=0;
$totalperson58=0;
while($rows272=mysql_fetch_array($query272)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows272["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army58=1;
		$totalarmy58=$totalarmy58+$army58;
	}else{
		$person58=1;
		$totalperson58=$totalperson58+$person58;	
	}
}


$sql3=mysql_query("SELECT  sum(price) 
FROM  `patdata` 
WHERE  `date` 
LIKE  '%2557%' AND  `code` 
LIKE  '%sleeptest%' AND price > 0");
list($sumprice572)=mysql_fetch_array($sql3);

$sql4=mysql_query("SELECT  sum(price) 
FROM  `patdata` 
WHERE  `date` 
LIKE  '%2558%' AND  `code` 
LIKE  '%sleeptest%' AND price > 0");
list($sumprice582)=mysql_fetch_array($sql4);
?>     
    <td>๒. เครื่องตรวจและวิเคราะห์ความผิดปกติขณะนอนหลับ</td>
    <td align="right"><?=$totalarmy57;?></td>
    <td align="right"><?=$totalperson57;?></td>
    <td align="right"><?=$num271;?></td>
    <td align="right"><?=$sumprice572;?></td>
    <td align="right"><?=$totalarmy58;?></td>
    <td align="right"><?=$totalperson58;?></td>
    <td align="right"><?=$num272;?></td>
    <td align="right"><?=$sumprice582;?></td>
  </tr>
  <tr>
<?
$sql471="SELECT *
FROM `depart`
WHERE `date`
LIKE '2557%' AND `depart`
LIKE '%xray%' AND price >0 AND (
price =650 OR price =850 OR price =1000
) GROUP BY hn";
$query471=mysql_query($sql471);
$num471=mysql_num_rows($query471);
$totalarmy57=0;
$totalperson57=0;
while($rows471=mysql_fetch_array($query471)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows471["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army57=1;
		$totalarmy57=$totalarmy57+$army57;
	}else{
		$person57=1;
		$totalperson57=$totalperson57+$person57;	
	}
}



$sql472="SELECT *
FROM `depart`
WHERE `date`
LIKE '2558%' AND `depart`
LIKE '%xray%' AND price >0 AND (
price =650 OR price =850 OR price =1000
) GROUP BY hn";
$query472=mysql_query($sql472);
$num472=mysql_num_rows($query472);
$totalarmy58=0;
$totalperson58=0;
while($rows472=mysql_fetch_array($query472)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows472["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army58=1;
		$totalarmy58=$totalarmy58+$army58;
	}else{
		$person58=1;
		$totalperson58=$totalperson58+$person58;	
	}
}


$sql5=mysql_query("SELECT sum(price)
FROM `depart`
WHERE `date`
LIKE '2557%' AND `depart`
LIKE '%xray%' AND price >0 AND (
price =650 OR price =850 OR price =1000
)");
list($sumprice574)=mysql_fetch_array($sql5);

$sql6=mysql_query("SELECT sum(price)
FROM `depart`
WHERE `date`
LIKE '2558%' AND `depart`
LIKE '%xray%' AND price >0 AND (
price =650 OR price =850 OR price =1000
)");
list($sumprice584)=mysql_fetch_array($sql6);
?>   
    <td>๓. เครื่องอ่านและแปลงสัญญาณ</td>
    <td align="right"><?=$totalarmy57;?></td>
    <td align="right"><?=$totalperson57;?></td>
    <td align="right"><?=$num471;?></td>
    <td align="right"><?=$sumprice574;?></td>
    <td align="right"><?=$totalarmy58;?></td>
    <td align="right"><?=$totalperson58;?></td>
    <td align="right"><?=$num472;?></td>
    <td align="right"><?=$sumprice584;?></td>
  </tr>
  <tr>
<?
$sql571="SELECT *
FROM `depart`
WHERE `date`
LIKE '2557%' AND `depart`
LIKE '%xray%' AND price >0 AND (
price !=650 AND price !=850 AND price !=1000
) AND price < 3100 GROUP BY hn";
$query571=mysql_query($sql571);
$num571=mysql_num_rows($query571);
$totalarmy57=0;
$totalperson57=0;
while($rows571=mysql_fetch_array($query571)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows571["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army57=1;
		$totalarmy57=$totalarmy57+$army57;
	}else{
		$person57=1;
		$totalperson57=$totalperson57+$person57;	
	}
}



$sql572="SELECT *
FROM `depart`
WHERE `date`
LIKE '2558%' AND `depart`
LIKE '%xray%' AND price >0 AND (
price !=650 AND price !=850 AND price !=1000
) AND price < 3100 GROUP BY hn";
$query572=mysql_query($sql572);
$num572=mysql_num_rows($query572);
$totalarmy58=0;
$totalperson58=0;
while($rows572=mysql_fetch_array($query572)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows572["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army58=1;
		$totalarmy58=$totalarmy58+$army58;
	}else{
		$person58=1;
		$totalperson58=$totalperson58+$person58;	
	}
}


$sql7=mysql_query("SELECT sum(price)
FROM `depart`
WHERE `date`
LIKE '2557%' AND `depart`
LIKE '%xray%' AND price >0 AND (
price !=650 AND price !=850 AND price !=1000
) AND price < 3100");
list($sumprice575)=mysql_fetch_array($sql7);

$sql8=mysql_query("SELECT sum(price)
FROM `depart`
WHERE `date`
LIKE '2558%' AND `depart`
LIKE '%xray%' AND price >0 AND (
price !=650 AND price !=850 AND price !=1000
) AND price < 3100");
list($sumprice585)=mysql_fetch_array($sql8);
?> 
    <td>๔. ภาพเอ็กเรย์ระบบดิจิตอล</td>
    <td align="right"><?=$totalarmy57;?></td>
    <td align="right"><?=$totalperson57;?></td>
    <td align="right"><?=$num571;?></td>
    <td align="right"><?=$sumprice575;?></td>
    <td align="right"><?=$totalarmy58;?></td>
    <td align="right"><?=$totalperson58;?></td>
    <td align="right"><?=$num572;?></td>
    <td align="right"><?=$sumprice585;?></td>
  </tr>
  <tr>
<?
$sql671="SELECT *
FROM `depart`
WHERE `date`
LIKE '2557%' AND `depart`
LIKE '%xray%' AND price >=3100 GROUP BY hn";
$query671=mysql_query($sql671);
$num671=mysql_num_rows($query671);
$totalarmy57=0;
$totalperson57=0;
while($rows671=mysql_fetch_array($query671)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows671["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army57=1;
		$totalarmy57=$totalarmy57+$army57;
	}else{
		$person57=1;
		$totalperson57=$totalperson57+$person57;	
	}
}



$sql672="SELECT *
FROM `depart`
WHERE `date`
LIKE '2558%' AND `depart`
LIKE '%xray%' AND price >=3100 GROUP BY hn";
$query672=mysql_query($sql672);
$num672=mysql_num_rows($query672);
$totalarmy58=0;
$totalperson58=0;
while($rows672=mysql_fetch_array($query672)){
	$sqlopcard=mysql_query("select typeservice from opcard where hn ='".$rows672["hn"]."'");
	list($typeservice)=mysql_fetch_array($sqlopcard);
	if($typeservice=="TS01 ทหาร/ครอบครัว"){
		$army58=1;
		$totalarmy58=$totalarmy58+$army58;
	}else{
		$person58=1;
		$totalperson58=$totalperson58+$person58;	
	}
}


$sql9=mysql_query("SELECT sum(price)
FROM `depart`
WHERE `date`
LIKE '2557%' AND `depart`
LIKE '%xray%' AND price >=3100");
list($sumprice576)=mysql_fetch_array($sql9);

$sql10=mysql_query("SELECT sum(price)
FROM `depart`
WHERE `date`
LIKE '2558%' AND `depart`
LIKE '%xray%' AND price >=3100");
list($sumprice586)=mysql_fetch_array($sql10);

?>   
    <td>๕. เครื่องเอ็กเรย์คอมพิวเตอร์</td>
    <td align="right"><?=$totalarmy57;?></td>
    <td align="right"><?=$totalperson57;?></td>
    <td align="right"><?=$num671;?></td>
    <td align="right"><?=$sumprice576;?></td>
    <td align="right"><?=$totalarmy58;?></td>
    <td align="right"><?=$totalperson58;?></td>
    <td align="right"><?=$num672;?></td>
    <td align="right"><?=$sumprice586;?></td>
  </tr>
</table>

</p>
