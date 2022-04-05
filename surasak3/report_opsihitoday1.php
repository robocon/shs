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
<div align="center" style="margin-top: 20px; font-size: 28px;"><strong>รายงานข้อมูลสถิติผู้ป่วย OP self Isolation ผู้ป่วย Home Isolation และผู้ป่วย รพ.สนาม</strong></div>
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
    <td width="15%" align="center" bgcolor="#009966"><strong>วัน/เดือน/ปี</strong></td>
	<td width="10%" align="center" bgcolor="#009966"><strong>OP self Isolation</strong></td>
	<td width="10%" align="center" bgcolor="#009966"><strong>Home Isolation</strong></td>
	<td width="10%" align="center" bgcolor="#009966"><strong>รพ.สนาม</strong></td>
	<td width="10%" align="center" bgcolor="#009966"><strong>รวมทั้งสิ้น</td>
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
<br>


<?

$csql="select DISTINCT (opdcolor) as opdcolor, count(row_id) as amount from opday where thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59' and (opdtype ='SI') GROUP BY opdcolor";

//echo $csql;
$cquery=mysql_query($csql);
$num=mysql_num_rows($cquery);
?>
<div align="center" style="margin-top: 20px;"><strong>สรุปยอดผู้ป่วย OP self Isolation</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="25%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="15%" align="center" bgcolor="#FF6699"><strong>กลุ่มอาการ</strong></td>
	<td width="10%" align="center" bgcolor="#FF6699"><strong>จำนวน</strong></td>
  </tr>
<?
if($num < 1){
?>  
  <tr>
    <td colspan="2" width="25%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
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
	}
	
?>
  <tr>
    <td width="15%" align="left"><strong><?=$color;?></strong></td>
	<td width="10%" align="center"><a href="report_opsihitoday4.php?opdtype=SI&opdcolor=<?=$result["opdcolor"];?>&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><strong><?=$result["amount"];?></strong></a></td>
<?
	}
?>
  <tr>
    <td width="15%" align="right"><strong>รวมทั้งสิ้น</strong></td>
	<td width="10%" align="center"><strong><a href="report_opsihitoday4.php?opdtype=SI&opdcolor=ALL&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><?=$totalamount;?></strong></a></td>
  </tr>
<?
}
?>  
</table>
<br>


<?

$csql="select DISTINCT (opdcolor) as opdcolor, count(row_id) as amount from opday where thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59' and (opdtype ='HI') GROUP BY opdcolor";

//echo $csql;
$cquery=mysql_query($csql);
$num=mysql_num_rows($cquery);
?>
<div align="center" style="margin-top: 20px;"><strong>สรุปยอดผู้ป่วย Home Isolation</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="25%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="15%" align="center" bgcolor="#FF6699"><strong>กลุ่มอาการ</strong></td>
	<td width="10%" align="center" bgcolor="#FF6699"><strong>จำนวน</strong></td>
  </tr>
<?
if($num < 1){
?>  
  <tr>
    <td colspan="2" width="25%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
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
	}
	
?>
  <tr>
    <td width="15%" align="left"><strong><?=$color;?></strong></td>
	<td width="10%" align="center"><a href="report_opsihitoday5.php?opdtype=HI&opdcolor=<?=$result["opdcolor"];?>&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><strong><?=$result["amount"];?></strong></a></td>
<?
	}
?>
  <tr>
    <td width="15%" align="right"><strong>รวมทั้งสิ้น</strong></td>
	<td width="10%" align="center"><strong><a href="report_opsihitoday5.php?opdtype=HI&opdcolor=ALL&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><?=$totalamount;?></strong></a></td>
  </tr>
<?
}
?>  
</table>
<br>



<?

$csql="select DISTINCT (
hi_type
) as hi_type, count(row_id) as amount from ipcard where date >= '$chkdate1 00:00:00' and date <='$chkdate2 23:59:59' and (hi_type !='') GROUP BY hi_type";

//echo $csql;
$cquery=mysql_query($csql);
$num=mysql_num_rows($cquery);
?>
<div align="center" style="margin-top: 20px;"><strong>ผู้ป่วยโควิดทำการรักษาแบบ Home Isolation แยกตามประเภท</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="25%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="15%" align="center" bgcolor="#FF9966"><strong>ประเภท</strong></td>
	<td width="10%" align="center" bgcolor="#FF9966"><strong>จำนวน</strong></td>
  </tr>
<?
if($num < 1){
?>  
  <tr>
    <td colspan="2" width="25%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
  </tr>
<?
}else{
	$totalamount=0;
	while($result=mysql_fetch_array($cquery)){
	$totalamount=$totalamount+$result["amount"];
	
	if($result["hi_type"]=="in"){
		$location="รักษาที่เรือนรับรอง";	
	}else if($result["hi_type"]=="out"){
		$location="รักษาที่บ้าน";	
	}else{
		$location="";
	}
	
?>
  <tr>
    <td width="15%" align="left"><strong><?=$location;?></strong></td>
	<td width="10%" align="center"><a href="report_opsihitoday6.php?hi_type=<?=$result["hi_type"];?>&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><strong><?=$result["amount"];?></strong></a></td>
<?
	}
?>
  <tr>
    <td width="15%" align="right"><strong>รวมทั้งสิ้น</strong></td>
	<td width="10%" align="center"><strong><a href="report_opsihitoday6.php?hi_type=ALL&date1=<?=$chkdate1;?>&date2=<?=$chkdate2;?>" target="_blank"><?=$totalamount;?></strong></a></td>
  </tr>
<?
}
?>  
</table>
<br>

<div align="center" style="margin-top: 20px;"><strong>รายชื่อผู้ป่วย OP self Isolation ผู้ป่วย Home Isolation และผู้ป่วย รพ.สนาม</strong></div>
<div align="center">ระว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#0099CC"><strong>ลำดับ</strong></td>
    <td width="10%" align="center" bgcolor="#0099CC"><strong>วัน/เดือน/ปี</strong></td>
    <td width="6%" align="center" bgcolor="#0099CC"><strong>HN</strong></td>
    <td width="5%" align="center" bgcolor="#0099CC"><strong>VN</strong></td>
	 <td width="5%" align="center" bgcolor="#0099CC"><strong>AN</strong></td>
    <td width="17%" align="center" bgcolor="#0099CC"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="15%" align="center" bgcolor="#0099CC"><strong>สิทธิการักษา</strong></td>
    <td width="11%" align="center" bgcolor="#0099CC"><strong>ประเภท</strong></td>
    <td width="6%" align="center" bgcolor="#0099CC"><strong>กลุ่มอาการ</strong></td>
	<td width="11%" align="center" bgcolor="#0099CC"><strong>สถานที่รักษา</strong></td>
  </tr>
<?

$sql="select * from opday where thidate >= '$chkdate1 00:00:00' and thidate <='$chkdate2 23:59:59' and (opdtype ='SI' || opdtype='HI' || opdtype='FI') order by opdtype desc";
//echo $sql;
$query=mysql_query($sql);
$num=mysql_num_rows($query);
if($num < 1){
?>  
  <tr>
    <td colspan="10" width="97%" align="center"><strong>---------- ไม่มีข้อมูล ----------</strong></td>
  </tr>
<?
}else{
	$i=0;
	while($rows=mysql_fetch_array($query)){
	$i++;
	$y=substr($rows["thidate"],0,4);
	$m=substr($rows["thidate"],5,2);
	$d=substr($rows["thidate"],8,2);
	$today="$d/$m/$y";
	
if($rows["opdtype"]=="SI"){
	$type="OP self Isolation";	
}else if($rows["opdtype"]=="HI"){
	$type="Home Isolation";
}else if($rows["opdtype"]=="FI"){
	$type="รพ.สนาม";	
}else{
	$type="";
}

if($rows["opdcolor"]=="green"){
	$color="เขียว";
}else if($rows["opdcolor"]=="yellow"){
	$color="เหลือง";
}else if($rows["opdcolor"]=="red"){
	$color="แดง";	
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
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$today;?></td>
    <td align="center"><?=$rows["hn"]?></td>
    <td align="center"><?=$rows["vn"];?></td>
	<td align="center"><?=$rows["an"];?></td>
    <td><?=$rows["ptname"]?></td>
    <td><?=$rows["ptright"]?></td>
    <td align="center"><?=$type;?></td>
    <td align="center"><?=$color;?></td>
	<td align="center"><?=$location;?></td>
  </tr>
<?
	}
}
?> 
</table>