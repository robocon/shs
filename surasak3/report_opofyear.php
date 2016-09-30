<?php
session_start();
$depart1 = array();
$depart2 = array();
$depart3 = array();
$depart4 = array();
$depart5 = array();
$depart6 = array();
$depart7 = array();
$depart8 = array();
$depart9 = array();
$depart10 = array();

include("connect.inc");
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>รายรับรวม</title>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->
</style></head>
<? 
function displaydate($x) {
	$thai_m=array("มกราคม","กุมภาพันธ์","มีนาคม","เมษายน","พฤษภาคม","มิถุนายน","กรกฏาคม","สิงหาคม","กันยายน","ตุลาคม","พฤศจิกายน","ธันวาคม");
	$date_array=explode("-",$x);
	$y=$date_array[0];
	$m=$date_array[1]-1;
	$d=$date_array[2];

	$m=$thai_m[$m];
	$y=$y+543;

	$displaydate="$d $m $y";
	return $displaydate;
} // end function displaydate

?>
<?
$keydate =date('Y-m-d');
$keytime =date('H:i:s');
?>
<body>
<form action="report_opofyear.php" method="post">
<input name="act" type="hidden" value="search" />
  <table width="174" border="0" style="font-family:'TH SarabunPSK'; font-size:18px;">
    <tr>
      <td width="103"><span style="font-family:'TH SarabunPSK'; font-size:18;">พ.ศ. : &nbsp;</span><?
        $Y=date("Y")+543;
        $date=date("Y")+543+5;
                      
        $dates=range(2547,$date);
		?>
        <select name="year" style="font-family:'TH SarabunPSK'; font-size:18px;">
        <? foreach($dates as $i){
        ?>
		<option value='<?=$i; ?>' <? if($Y==$i){ echo "selected"; }?>>
            <?=$i;?>
        </option>
        <?
        }
		?>
        </select>
        </td>
      <td width="61"><input name="submit" type="submit" id="submit" style="font-family:'TH SarabunPSK'; font-size:18px;" value="ตกลง" /></td>
    </tr>
  </table>
</form>
<hr />
<? 
if($_POST["act"]=="search"){
$year =$_POST["year"];
	
?>
<p align="center">ส่วนเก็บเงินผู้ป่วยนอก: รายงานรายรับรวมทั้งหมด<br />
รายงานเงินรายรับผู้ป่วยนอก ประจำปี <?=$year?><br />
ออกรายงาน ณ วันที่ <?=displaydate($keydate); ?></p>
<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="88%" align="center"><strong>แผนก</strong></td>
 <? for($i=1;$i<13;$i++){
 	if($i==1){ $mon="มกราคม";}else if($i==2){ $mon="กุมภาพันธ์";}else if($i==3){ $mon="มีนาคม";}else if($i==4){ $mon="เมษายน";}else if($i==5){ $mon="พฤษภาคม";}else if($i==6){ $mon="มิถุนายน";}else if($i==7){ $mon="กรกฎาคม";}else if($i==8){ $mon="สิงหาคม";}else if($i==9){ $mon="กันยายน";}else if($i==10){ $mon="ตุลาคม";}else if($i==11){ $mon="พฤศจิกายน";}else if($i==12){ $mon="ธันวาคม";}
 ?>
    <td width="12%" align="center"><strong>เดือน<?=$mon;?>
    </strong></td>
 <? } ?>
  </tr>
  
  <tr>
    <td align="left">1. เภสัชกรรม</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(paid) as totalpaid FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHAR'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart1,$rows["totalpaid"]);
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalpaid"],2);?></td>
<?
	 }
}
?>    
  </tr>
  <tr>
    <td align="left">.......1.1 ค่ายาในบัญชียาหลักแห่งชาติ</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(essd) as totalessd FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHAR'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalessd"],2);?></td>
<?
	 }
}

?>  
  </tr>
  <tr>
    <td align="left">.......1.2 ค่ายานอกบัญชียาหลักแห่งชาติ เบิกได้</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(nessdy) as totalnessdy FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHAR'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalnessdy"],2);?></td>
<?
	 }
}
?>   
  </tr>
  <tr>
    <td align="left">.......1.3 ค่ายานอกบัญชียาหลักแห่งชาติ เบิกไม่ได้</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(nessdn) as totalnessdn FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHAR'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalnessdn"],2);?></td>
<?
	 }
}
?> 
  </tr>
  <tr>
    <td align="left">.......1.4 ค่าเวชภัณฑ์ ส่วนที่เบิกได้</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(dpy) as totaldpy FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHAR'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totaldpy"],2);?></td>
<?
	 }
}
?>   
  </tr>
  <tr>
    <td align="left">.......1.5 ค่าเวชภัณฑ์ ส่วนที่เบิกไม่ได้</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(dpn) as totaldpn FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHAR'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totaldpn"],2);?></td>
<?
	 }
}
?>    
  </tr>
  <tr>
    <td align="left">.......1.6 ค่าอุปกรณ์ ส่วนที่เบิกได้</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(dsy) as totaldsy FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHAR'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totaldsy"],2);?></td>
<?
	 }
}
?>    
  </tr>
  <tr>
    <td align="left">.......1.7 ค่าอุปกรณ์ ส่วนที่เบิกไม่ได้</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(dsn) as totaldsn FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHAR'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totaldsn"],2);?></td>
<?
	 }
}
?>     
  </tr>
  <tr>
    <td align="left">2. พยาธิ</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='PATHO'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart2,$rows["totalprice"]);	
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>   
  </tr>
  <tr>
    <td align="left">3. เอกซเรย์</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='XRAY'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart3,$rows["totalprice"]);		
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>   
  </tr>
  <tr>
    <td align="left">4. ห้องผ่าตัด</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='SURG'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart4,$rows["totalprice"]);		
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>   
  </tr>
  <tr>
    <td align="left">5. ห้องฉุกเฉิน</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='EMER'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart5,$rows["totalprice"]);		
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>    
  </tr>
  <tr>
    <td align="left">6. ทันตกรรม</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='DENTA'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart6,$rows["totalprice"]);		
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>   
  </tr>
  <tr>
    <td align="left">7. กายภาพบำบัด</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='PHYSI'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart7,$rows["totalprice"]);		
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>   
  </tr>
  <tr>
    <td align="left">8. ไตเทียม</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='HEMO'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart8,$rows["totalprice"]);		
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>    
  </tr>
  <tr>
    <td align="left">9. หอผู้ป่วย</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='WARD'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart9,$rows["totalprice"]);		
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>    
  </tr>
  <tr>
    <td align="left">10. อื่นๆ</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and depart ='OTHER'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
		array_push($depart10,$rows["totalprice"]);	
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
<?
	 }
}
?>    
  </tr>
  <tr>
    <td align="center"><strong>รวมทั้งสิ้น</strong></td>
 <? 
 for($i=0;$i<12;$i++){ 
	$sumprice = $depart1[$i]+$depart2[$i]+$depart3[$i]+$depart4[$i]+$depart5[$i]+$depart6[$i]+$depart7[$i]+$depart8[$i]+$depart9[$i]+$depart10[$i];
 ?> 
    <td width="12%" align="right"><span style="font-weight:bold; color:#FF0000;"><?=number_format($sumprice,2);?></span></td>
<?
}
?>
  </tr>
</table>
<p>&nbsp;</p>
<table width="80%" border="1" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td align="center"><strong>สรุปข้อมูลการรับชำระเงิน</strong></td>
 <? for($i=1;$i<13;$i++){
 	if($i==1){ $mon="มกราคม";}else if($i==2){ $mon="กุมภาพันธ์";}else if($i==3){ $mon="มีนาคม";}else if($i==4){ $mon="เมษายน";}else if($i==5){ $mon="พฤษภาคม";}else if($i==6){ $mon="มิถุนายน";}else if($i==7){ $mon="กรกฎาคม";}else if($i==8){ $mon="สิงหาคม";}else if($i==9){ $mon="กันยายน";}else if($i==10){ $mon="ตุลาคม";}else if($i==11){ $mon="พฤศจิกายน";}else if($i==12){ $mon="ธันวาคม";}
 ?>
    <td align="center"><strong>เดือน<?=$mon;?>
    </strong></td>
 <? } ?>
  </tr>
  <tr>
    <td width="88%" align="left">เงินสด</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='เงินสด'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>   
  </tr>
  <tr>
    <td align="left">กรุงเทพ</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='กรุงเทพ'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
  <tr>
    <td align="left">ทหารไทย</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='ทหารไทย'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
  <tr>
    <td align="left">จ่ายตรง</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='จ่ายตรง'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
    <tr>
    <td align="left">จ่ายตรง อปท.</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='จ่ายตรง อปท.'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
  <tr>
    <td align="left">ประกันสังคม</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='ประกันสังคม'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
  <tr>
    <td align="left">30บาท</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='30บาท'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
  <tr>
    <td align="left">เงินเชื่อ</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='เงินเชื่อ'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
  <tr>
    <td align="left">อื่นๆ</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='อื่นๆ'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
  <tr>
    <td align="left">HD</td>
 <? for($i=1;$i<13;$i++){ 
 	$los = strlen($i);
	if($los=="1"){
		$n="0".$i;
	}else{
		$n=$i;
	}
    $query = "SELECT sum(price) as totalprice FROM opacc WHERE date LIKE '$year-$n%' and credit ='HD'";
	//echo $query;
    $result = mysql_query($query)or die("Query failed");
	while($rows=mysql_fetch_array($result)){
 ?> 
    <td width="12%" align="right"><?=number_format($rows["totalprice"],2);?></td>
    <?
	 }
}
?>  
  </tr>
</table>
<p align="center">&nbsp;</p>
<?
}
?>
</body>
</html>
