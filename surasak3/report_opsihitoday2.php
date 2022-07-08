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
<?
$date=$_GET["date"];

list($y,$m,$d)=explode("-",$date);

$showdate="$d/$m/$y";


if($_GET["opdtype"]=="SI"){
	$type="OP self Isolation";	
}else if($_GET["opdtype"]=="HI"){
	$type="Home Isolation";
}else if($_GET["opdtype"]=="FI"){
	$type="รพ.สนาม";
}else if($_GET["opdtype"]=="ALL"){
	$type="OP self Isolation && Home Isolation && รพ.สนาม";
}

?>
<div align="center" style="margin-top: 20px;"><strong>รายชื่อผู้ป่วย <?=$type;?></strong></div>
<div align="center">วันที่ <?=$showdate;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
	 <td width="5%" align="center" bgcolor="#66CC99"><strong>AN</strong></td>
    <td width="17%" align="center" bgcolor="#66CC99"><strong>ชื่อ - นามสกุล</strong></td>
	<td width="17%" align="center" bgcolor="#66CC99"><strong>อายุ</strong></td>
	<td width="17%" align="center" bgcolor="#66CC99"><strong>สังกัด</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>สิทธิการักษา</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>ประเภท</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>กลุ่มอาการ</strong></td>
	<td width="11%" align="center" bgcolor="#66CC99"><strong>สถานที่รักษา</strong></td>
  </tr>
<?
if($_GET["opdtype"]=="ALL"){
	$sql="select * from opday where thidate LIKE '$date%' and (opdtype ='SI' || opdtype='HI' || opdtype='FI') order by opdtype desc";
}else{
	$sql="select * from opday where thidate LIKE '$date%' and opdtype='".$_GET["opdtype"]."' order by row_id asc";	
}
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
	<td><?=$rows["age"]?></td>
	<td><?=$rows["camp"]?></td>
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
