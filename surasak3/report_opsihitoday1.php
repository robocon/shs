<?
session_start();
include("connect.inc");

$showdate1=$_POST["date1"]."/".$_POST["month1"]."/".$_POST["year1"];
$showdate2=$_POST["date2"]."/".$_POST["month2"]."/".$_POST["year2"];

?>
<style type="text/css">
<!--
body,td,th {
	font-family: TH SarabunPSK;
	font-size: 18px;
}
-->

a:link {
  text-decoration: none;
}

a:visited {
  text-decoration: none;
}
</style>
<div align="center" style="margin-top: 20px; font-size: 28px;"><strong>รายงานข้อมูลสถิติผู้ป่วยโควิด 19 กรณีรักษา OP self Isolation </strong></div>
<?
$chkdate1=($_POST["year1"])."-".$_POST["month1"]."-".$_POST["date1"];
$chkdate2=($_POST["year2"])."-".$_POST["month2"]."-".$_POST["date2"];

$date1=($_POST["year1"]-543)."-".$_POST["month1"]."-".$_POST["date1"];
$date2=($_POST["year2"]-543)."-".$_POST["month2"]."-".$_POST["date2"];

$end=mktime(0,0,0,$_POST["month2"],$_POST["date2"],$_POST["year2"]-543);
$start=mktime(0,0,0,$_POST["month1"],$_POST["date1"],$_POST["year1"]-543);

//echo $datenum;

$csql="select substring(thidate,1,10) as thidate, count(row_id) as amount from opday where thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59' and (opdtype ='SI' || opdtype='HI' || opdtype='FI') GROUP BY SUBSTRING( thidate, 1, 10 )";

//echo $csql;
$cquery=mysql_query($csql);
$num=mysql_num_rows($cquery);
?>
<div align="center" style="margin-top: 20px;"><strong>สรุปยอดประจำวันผู้ป่วย OP self Isolation และผู้ป่วย Home Isolation</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="55%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="15%" align="center" bgcolor="#5499C7"><strong>วัน/เดือน/ปี</strong></td>
	<td width="10%" align="center" bgcolor="#5499C7"><strong>OP self Isolation</strong></td>
	<td width="10%" align="center" bgcolor="#5499C7"><strong>Home Isolation</strong></td>
	<td width="10%" align="center" bgcolor="#5499C7"><strong>รพ.สนาม</strong></td>
	<td width="10%" align="center" bgcolor="#5499C7"><strong>รวมทั้งสิ้น</td>
  </tr>
<?
if($num < 1){
?>  
  <tr>
    <td colspan="4" width="20%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
  </tr>
<?
}else{
	$totalsi=0;
	$totalhi=0;
	$totalfi=0;
	$totalamount=0;
	while($result=mysql_fetch_array($cquery)){
		$totalamount=$totalamount+$result["amount"];

		$sql="select count(row_id) as amountsi from opday where thidate LIKE '".$result["thidate"]."%' and (opdtype ='SI') GROUP BY SUBSTRING( thidate, 1, 10 )";	
		$query=mysql_query($sql);
		list($amountsi)=mysql_fetch_array($query);
		if(empty($amountsi)){ $amountsi="0";}
		$totalsi=$totalsi+$amountsi;
		
		$sql1="select count(row_id) as amounthi from opday where thidate LIKE '".$result["thidate"]."%' and (opdtype ='HI') GROUP BY SUBSTRING( thidate, 1, 10 )";	
		$query1=mysql_query($sql1);
		list($amounthi)=mysql_fetch_array($query1);	
		if(empty($amounthi)){ $amounthi="0";}
		$totalhi=$totalhi+$amounthi;
		
		$sql2="select count(row_id) as amountfi from opday where thidate LIKE '".$result["thidate"]."%' and (opdtype ='FI') GROUP BY SUBSTRING( thidate, 1, 10 )";	
		$query2=mysql_query($sql2);
		list($amountfi)=mysql_fetch_array($query2);
		if(empty($amountfi)){ $amountfi="0";}
		$totalfi=$totalfi+$amountfi;		

?>
  <tr>
    <td width="15%" align="center"><strong><?=$result["thidate"];?></strong></td>
	<td width="10%" align="center"><a href="report_opsihitoday2.php?opdtype=SI&date=<?=$result["thidate"];?>" target="_blank"><strong><?=$amountsi;?></strong></a></td>
	<td width="10%" align="center"><a href="report_opsihitoday2.php?opdtype=HI&date=<?=$result["thidate"];?>" target="_blank"><strong><?=$amounthi;?></strong></a></td>
	<td width="10%" align="center"><a href="report_opsihitoday2.php?opdtype=FI&date=<?=$result["thidate"];?>" target="_blank"><strong><?=$amountfi;?></strong></a></td>
	<td width="10%" align="center"><a href="report_opsihitoday2.php?opdtype=ALL&date=<?=$result["thidate"];?>" target="_blank"><strong><?=$result["amount"];?></strong></a></td>
	
  </tr>
<?
	}
?>
  <tr>
    <td width="15%" align="right"><strong>รวมทั้งสิ้น</strong></td>
	<td width="10%" align="center"><strong><a href="report_opsihitoday3.php?opdtype=SI&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><?=$totalsi;?></strong></a></td>
	<td width="10%" align="center"><strong><a href="report_opsihitoday3.php?opdtype=HI&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><?=$totalhi;?></strong></a></td>
	<td width="10%" align="center"><strong><a href="report_opsihitoday3.php?opdtype=FI&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><?=$totalfi;?></strong></a></td>
	<td width="10%" align="center"><strong><a href="report_opsihitoday3.php?opdtype=ALL&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><?=$totalamount;?></strong></a></td>
  </tr>
<?
}
?>  
</table>
<div align="center">*** ข้อมูลอ้างอิงจากการบันทึกประเภทผู้ป่วย/ซักประวัติคัดกรอง (OPD) ***</div><br>


<?

$csql="select DISTINCT (opdcolor) as opdcolor, count(row_id) as amount from opday where thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59' and (opdtype ='SI') GROUP BY opdcolor";

//echo $csql;
$cquery=mysql_query($csql);
$num=mysql_num_rows($cquery);
?>
<div align="center" style="margin-top: 20px;"><strong>สรุปยอดผู้ป่วย OP self Isolation ตามกลุ่มอาการ</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="45%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="35%" align="center" bgcolor="#FF6699"><strong>กลุ่มอาการ</strong></td>
	<td width="10%" align="center" bgcolor="#FF6699"><strong>จำนวน</strong></td>
  </tr>
<?
if($num < 1){
?>  
  <tr>
    <td colspan="2" width="45%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
  </tr>
<?
}else{
	$totalamount=0;
	while($result=mysql_fetch_array($cquery)){
	$totalamount=$totalamount+$result["amount"];
	
	if($result["opdcolor"]=="green"){
		$color="สีเขียว";	
	}else if($result["opdcolor"]=="yellow"){
		$color="สีเหลือง";	
	}else if($result["opdcolor"]=="green"){
		$color="สีแดง";	
	}else{
		$color="ไม่ได้ระบุ";
	}
	
?>
  <tr>
    <td width="35%" align="left"><strong><?=$color;?></strong></td>
	<td width="10%" align="center"><a href="report_opsihitoday4.php?opdtype=SI&opdcolor=<?=$result["opdcolor"];?>&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><strong><?=$result["amount"];?></strong></a></td>
<?
	}
?>
  <tr>
    <td width="35%" align="right"><strong>รวมทั้งสิ้น</strong></td>
	<td width="10%" align="center"><strong><a href="report_opsihitoday4.php?opdtype=SI&opdcolor=ALL&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><?=$totalamount;?></strong></a></td>
  </tr>
<?
}
?>  
</table>
<div align="center">*** ข้อมูลอ้างอิงจากการบันทึกประเภทผู้ป่วย/ซักประวัติคัดกรอง (OPD) ***</div><br>


<?

$csql="select DISTINCT (
typeservice
) as typeservice, count(row_id) as amount from opselfisolation_detail where registerdate >= '$date1' and registerdate <='$date2' GROUP BY typeservice";

//echo $csql;
$cquery=mysql_query($csql);
$num=mysql_num_rows($cquery);
?>
<div align="center" style="margin-top: 20px;"><strong>ผู้ป่วยโควิดทำการรักษาแบบ OP Self Isolation แยกตามประเภทบุคคล</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="45%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="35%" align="center" bgcolor="#FF9966"><strong>ประเภท</strong></td>
	<td width="10%" align="center" bgcolor="#FF9966"><strong>จำนวน</strong></td>
  </tr>
<?
if($num < 1){
?>  
  <tr>
    <td colspan="2" width="45%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
  </tr>
<?
}else{
	$totalamount=0;
	while($result=mysql_fetch_array($cquery)){
	$totalamount=$totalamount+$result["amount"];
	$typeservice=$result["typeservice"];
	
?>
  <tr>
    <td width="35%" align="left"><strong><?=$typeservice;?></strong></td>
	<td width="10%" align="center"><strong><?=$result["amount"];?></strong></td>
<?
	}
?>
  <tr>
    <td width="35%" align="right"><strong>รวมทั้งสิ้น</strong></td>
	<td width="10%" align="center"><strong><?=$totalamount;?></strong></td>
  </tr>
<?
}
?>  
</table>
<div align="center">*** ข้อมูลอ้างอิงจากการบันทึกข้อมูลผู้ป่วยโควิด 19 (คลินิกโรคทางเดินหายใจ) ***</div>
<br>

<?

$csql="select DISTINCT (
location
) as location, count(row_id) as amount from opselfisolation_detail where registerdate >= '$date1' and registerdate <='$date2' GROUP BY location";

//echo $csql;
$cquery=mysql_query($csql);
$num=mysql_num_rows($cquery);
?>
<div align="center" style="margin-top: 20px;"><strong>ผู้ป่วยโควิดทำการรักษาแบบ OP Self Isolation แยกตามสถานที่กักตัว</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="45%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="35%" align="center" bgcolor="#1ABC9C"><strong>ประเภท</strong></td>
	<td width="10%" align="center" bgcolor="#1ABC9C"><strong>จำนวน</strong></td>
  </tr>
<?
if($num < 1){
?>  
  <tr>
    <td colspan="2" width="45%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
  </tr>
<?
}else{
	$totalamount=0;
	while($result=mysql_fetch_array($cquery)){
	$totalamount=$totalamount+$result["amount"];
	$location=$result["location"];
	
?>
  <tr>
    <td width="35%" align="left"><strong><?=$location;?></strong></td>
	<td width="10%" align="center"><strong><?=$result["amount"];?></strong></td>
<?
	}
?>
  <tr>
    <td width="35%" align="right"><strong>รวมทั้งสิ้น</strong></td>
	<td width="10%" align="center"><strong><?=$totalamount;?></strong></td>
  </tr>
<?
}
?>  
</table>
<div align="center">*** ข้อมูลอ้างอิงจากการบันทึกข้อมูลผู้ป่วยโควิด 19 (คลินิกโรคทางเดินหายใจ) ***</div>
<br>





<div align="center" style="margin-top: 20px;"><strong>รายชื่อผู้ป่วยโควิด 19 รักษาแบบ OP self Isolation</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#0099CC"><strong>ลำดับ</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>วัน/เดือน/ปี</strong></td>
	<td width="11%" align="center" bgcolor="#0099CC"><strong>วันที่มีอาการ</strong></td>
	<td width="11%" align="center" bgcolor="#0099CC"><strong>วันที่จำหน่าย</strong></td>
    <td width="6%" align="center" bgcolor="#0099CC"><strong>HN</strong></td>
    <td width="5%" align="center" bgcolor="#0099CC"><strong>VN</strong></td>
	<td width="5%" align="center" bgcolor="#0099CC"><strong>บัตรปชช</strong></td>
    <td width="17%" align="center" bgcolor="#0099CC"><strong>ชื่อ - นามสกุล</strong></td>
	<td width="5%" align="center" bgcolor="#0099CC"><strong>อายุ</strong></td>
	<td width="5%" align="center" bgcolor="#0099CC"><strong>เบอร์โทร</strong></td>
	<td width="11%" align="center" bgcolor="#0099CC"><strong>ที่อยู่</strong></td>
    <td width="15%" align="center" bgcolor="#0099CC"><strong>สิทธิการรักษา</strong></td>
    <td width="11%" align="center" bgcolor="#0099CC"><strong>ประเภทบุคคล</strong></td>
	<td width="11%" align="center" bgcolor="#0099CC"><strong>สังกัด</strong></td>
    <td width="6%" align="center" bgcolor="#0099CC"><strong>กลุ่มอาการ</strong></td>
	<td width="20%" align="center" bgcolor="#0099CC"><strong>อาการ</strong></td>
	<td width="20%" align="center" bgcolor="#0099CC"><strong>PI</strong></td>
	<td width="20%" align="center" bgcolor="#0099CC"><strong>กลุ่มผู้ป่วย</strong></td>
	<td width="20%" align="center" bgcolor="#0099CC"><strong>สถานที่กักตัว</strong></td>
	<td width="20%" align="center" bgcolor="#0099CC"><strong>ประวัติการฉีดวัคซีน</strong></td>
	<td width="20%" align="center" bgcolor="#0099CC"><strong>ใบบันทึกการดูแลผู้ป่วย</strong></td>
  </tr>
<?

$sql="select * from opselfisolation where registerdate >= '$date1' and registerdate <='$date2' order by row_id asc";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
if($num < 1){
?>  
  <tr>
    <td colspan="21" width="97%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
  </tr>
<?
}else{
	$i=0;
	while($rows=mysql_fetch_array($query)){ 
	
	$thdatehn=$rows["thdatehn"];
	
	$y=substr($rows["officer_date"],0,4);
	$y=$y+543;
	$m=substr($rows["officer_date"],5,2);
	$d=substr($rows["officer_date"],8,2);
	$time=substr($rows["officer_date"],11);
	$registerdate="$d/$m/$y $time";	
	
		$hn = $rows['hn'];
		$sqlOpcard = "SELECT `phone`,`address`, `tambol`, `ampur`, `changwat` FROM `opcard` WHERE `hn` = '$hn' LIMIT 1";
		$qOpcard=mysql_query($sqlOpcard);
		$a = mysql_fetch_assoc($qOpcard);
		$phone = $a['phone'];

		$address = $a['address'];
		if(!empty($a['tambol'])){
			$address .= ' ต.'.$a['tambol'];
		}
		if(!empty($a['ampur'])){
			$address .= ' อ.'.$a['ampur'];
		}
		if(!empty($a['changwat'])){
			$address .= ' จ.'.$a['changwat'];
		}
		

	$i++;

	$sqlOpday = "SELECT `hn`,`vn`,`an`,`idcard`,`ptname`,`age`,`ptright`,`camp`,`typeservice`,`opdtype`,`opdcolor` FROM `opday` WHERE `thdatehn` = '$thdatehn' LIMIT 1";
	$qOpday=mysql_query($sqlOpday);
	$aOpday = mysql_fetch_assoc($qOpday);
		
	if($aOpday["opdtype"]=="SI"){
		$type="OP self Isolation";	
	}else if($aOpday["opdtype"]=="HI"){
		$type="Home Isolation";
	}else if($aOpday["opdtype"]=="FI"){
		$type="รพ.สนาม";	
	}else{
		$type="";
	}

	if($aOpday["opdcolor"]=="green"){
		$color="สีเขียว";
	}else if($aOpday["opdcolor"]=="yellow"){
		$color="สีเหลือง";
	}else if($aOpday["opdcolor"]=="red"){
		$color="สีแดง";	
	}else{
		$color="";
	}
	
	$sql1 = "Select hi_type From ipcard where an = '".$rows["an"]."' limit 1";
	$query1=mysql_query($sql1);
	$arr1 = mysql_fetch_assoc($query1);	
	
	if($arr1["hi_type"]=="in"){
		$location="รักษาที่เรือนรับรอง";	
	}else if($arr1["hi_type"]=="out"){
		$location="รักษาที่บ้าน";	
	}else{
		$location="";
	}
	
		$sqlOpd = "SELECT `organ`,`hpi` FROM `opd` WHERE `thdatehn` = '$thdatehn' LIMIT 1";
		$qOpd=mysql_query($sqlOpd);
		$aOpd = mysql_fetch_assoc($qOpd);	
	
	list($camp_code, $camp_name) = explode(' ', $aOpday["camp"], 2);
	
	
	$sql1 = "Select covid19_vaccine,amount1,vaccine_name1,amount2,vaccine_name2,amount3,vaccine_name3,amount4,vaccine_name4,amount5,vaccine_name5,amount6,vaccine_name6,officer,officer_date From patient_vaccine_covid19 where hn = '".$hn."'";
	//echo $sql1;
	$query1=mysql_query($sql1);
	$numvaccine=mysql_num_rows($query1);
	list($covid19_vaccine,$amount1,$vaccine_name1,$amount2,$vaccine_name2,$amount3,$vaccine_name3,$amount4,$vaccine_name4,$amount5,$vaccine_name5,$amount6,$vaccine_name6,$officer,$officer_date) = mysql_fetch_array($query1);
	if($numvaccine > 0){
		if(!empty($vaccine_name1)){
			$vaccine_name1="เข็มที่ 1 $vaccine_name1";
		}
		if(!empty($vaccine_name2)){
			$vaccine_name2="เข็มที่ 2 $vaccine_name2";
		}
		if(!empty($vaccine_name3)){
			$vaccine_name3="เข็มที่ 3 $vaccine_name3";
		}
		if(!empty($vaccine_name4)){
			$vaccine_name4="เข็มที่ 4 $vaccine_name4";
		}
		if(!empty($vaccine_name5)){
			$vaccine_name5="เข็มที่ 5 $vaccine_name5";
		}
		if(!empty($vaccine_name6)){
			$vaccine_name6="เข็มที่ 6 $vaccine_name6";
		}		
		
		$txtvaccine="$vaccine_name1 $vaccine_name2 $vaccine_name3 $vaccine_name4 $vaccine_name5 $vaccine_name6";
	}else{
		$txtvaccine="ยังไม่ได้บันทึกในระบบ";
	}	
	
$sql2 = "Select * From opselfisolation_detail where thdatehn = '".$thdatehn."' limit 1";
//echo $sql1."<br>";
$query2=mysql_query($sql2);
$num2=mysql_num_rows($query2);
$rows2=mysql_fetch_array($query2);
if($num2 < 1){ //ยังไม่มีการบันทึกข้อมูลในวันนี้
	$print="ยังไม่ได้บันทึกในระบบ";
	$bgcolor="#FADBD8";
}else{
	$bgcolor="#FFFFFF";
	$print="<a href='opselfisolation_print.php?hn=$hn&thidatehn=$thdatehn' target='_blank\'>พิมพ์</a> || <a href='opselfisolation_register.php?hn=$hn&thidatehn=$thdatehn' target='_blank\'>แก้ไข</a>";
	
	if($rows2["location"]=="สถานที่อื่น"){
		$location=$rows2["location_other"];
	}else{
		$location=$rows2["location"];
	}

	
	if($rows2["symptom_date"] !="0000-00-00"){
		$yy1=substr($rows2["symptom_date"],0,4);
		$yy1=$yy1+543;
		$mm1=substr($rows2["symptom_date"],5,2);
		$dd1=substr($rows2["symptom_date"],8,2);
		$symptom_date="$dd1/$mm1/$yy1";
	}else{
		$symptom_date="";
	}
	
	if($rows2["dcdate"] !="0000-00-00"){
		$yy=substr($rows2["dcdate"],0,4);
		$yy=$yy+543;
		$mm=substr($rows2["dcdate"],5,2);
		$dd=substr($rows2["dcdate"],8,2);
		$dcdate="$dd/$mm/$yy";	
	}else{
		$dcdate="";
	}
}	
?>  
  <tr bgcolor="<?=$bgcolor;?>">
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$registerdate;?></td>
	<td align="center"><?=$symptom_date;?></td>
	<td align="center"><?=$dcdate;?></td>
    <td align="center"><?=$aOpday["hn"]?></td>
    <td align="center"><?=$aOpday["vn"];?></td>
	<td><?=$aOpday["idcard"]?></td>
    <td><?=$aOpday["ptname"]?></td>
	<td><?=$aOpday["age"]?></td>
	<td><?=$phone;?></td>
	<td><?=$address;?></td>
    <td><?=$aOpday["ptright"]?></td>
    <td><?=substr($aOpday["typeservice"],4);?></td>
	<td align="center"><?=$camp_name;?></td>
	<td align="center"><?=$color;?></td>
	<td align="center"><?=$aOpd["organ"];?></td>
	<td align="center"><?=$aOpd["hpi"];?></td>
	<td align="center"><?=$rows2["typeservice"];?></td>
	<td align="center"><?=$location;?></td>
	<td align="center"><?=$txtvaccine;?></td>
	<td align="center"><?=$print;?></td>
  </tr>
<?
	}
}
?> 
</table>