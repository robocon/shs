<?
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

a:link {
  text-decoration: none;
}

a:visited {
  text-decoration: none;
}
</style>
<?
$date1=$_GET["date1"];

list($y,$m,$d)=explode("-",$date1);

$showdate1="$d/$m/$y";


$date2=$_GET["date2"];

list($yy,$mm,$dd)=explode("-",$date2);

$showdate2="$dd/$mm/$yy";


if($_GET["opdtype"]=="SI"){
	$type="OP self Isolation";	
}else if($_GET["opdtype"]=="HI"){
	$type="Home Isolation";
}else if($_GET["opdtype"]=="FI"){
	$type="รพ.สนาม";
}else if($_GET["opdtype"]=="ALL"){
	$type="OP self Isolation";
}

?>
<div align="center" style="margin-top: 20px;"><strong>รายชื่อผู้ป่วย <?=$type;?></strong></div>
<div align="center">ระหว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
    <td width="17%" align="center" bgcolor="#66CC99"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>สิทธิการักษา</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>ประเภท</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>กลุ่มอาการ</strong></td>
  </tr>
<?
if($_GET["opdcolor"]=="ALL"){
	$sql="select * from opday where (thidate >= '$date1 00:00:00' and thidate <= '$date2 23:59:59') and opdtype ='SI' and (opdcolor ='green' || opdcolor='yellow' || opdcolor='red') order by opdtype desc";
}else{
	$sql="select * from opday where (thidate >= '$date1 00:00:00' and thidate <= '$date2 23:59:59') and opdtype='".$_GET["opdtype"]."' and opdcolor='".$_GET["opdcolor"]."' order by row_id asc";	
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
	
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$today;?></td>
    <td align="center"><?=$rows["hn"]?></td>
    <td align="center"><?=$rows["vn"];?></td>
    <td><?=$rows["ptname"]?></td>
    <td><?=$rows["ptright"]?></td>
    <td align="center"><?=$type;?></td>
    <td align="center"><?=$color;?></td>
  </tr>
<?
	}
}
?> 
</table>
