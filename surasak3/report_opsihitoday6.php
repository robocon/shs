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



$type="Home Isolation";


?>
<div align="center" style="margin-top: 20px;"><strong>รายชื่อผู้ป่วย <?=$type;?></strong></div>
<div align="center">ระหว่างวันที่ <?=$showdate1;?> ถึงวันที่ <?=$showdate2;?></div>
<table width="97%" border="1" align="center" cellpadding="0" cellspacing="0" bordercolor="#000000">
  <tr>
    <td width="4%" align="center" bgcolor="#66CC99"><strong>ลำดับ</strong></td>
    <td width="10%" align="center" bgcolor="#66CC99"><strong>วัน/เดือน/ปี</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>HN</strong></td>
    <td width="5%" align="center" bgcolor="#66CC99"><strong>VN</strong></td>
	 <td width="5%" align="center" bgcolor="#66CC99"><strong>AN</strong></td>
    <td width="17%" align="center" bgcolor="#66CC99"><strong>ชื่อ - นามสกุล</strong></td>
    <td width="15%" align="center" bgcolor="#66CC99"><strong>สิทธิการักษา</strong></td>
    <td width="11%" align="center" bgcolor="#66CC99"><strong>ประเภท</strong></td>
    <td width="6%" align="center" bgcolor="#66CC99"><strong>กลุ่มอาการ</strong></td>
	<td width="11%" align="center" bgcolor="#66CC99"><strong>สถานที่รักษา</strong></td>
  </tr>
<?
if($_GET["hi_type"]=="ALL"){
	$sql="select * from ipcard where (date >= '$date1 00:00:00' and date <= '$date2 23:59:59') and (hi_type ='in' || hi_type='out') order by date asc";
}else{
	$sql="select * from ipcard where (date >= '$date1 00:00:00' and date <= '$date2 23:59:59') and hi_type ='".$_GET["hi_type"]."' order by date asc";
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
	$y=substr($rows["date"],0,4);
	$m=substr($rows["date"],5,2);
	$d=substr($rows["date"],8,2);
	$chkdate="$y-$m-$d";
	$today="$d/$m/$y";
	

	if($rows["hi_type"]=="in"){
		$location="รักษาที่เรือนรับรอง";	
	}else if($rows["hi_type"]=="out"){
		$location="รักษาที่บ้าน";
	}else{
		$location="";
	}

	
	$sql1 = "Select vn,opdcolor From opday where thidate like '$chkdate%' and an = '".$rows["an"]."' limit 1";
	//echo $sql1."<br>";
	$query1=mysql_query($sql1);
	$arr1 = mysql_fetch_assoc($query1);	
	
	if($arr1["opdcolor"]=="green"){
		$color="เขียว";
	}else if($arr1["opdcolor"]=="yellow"){
		$color="เหลือง";
	}else if($arr1["opdcolor"]=="red"){
		$color="แดง";	
	}else{
		$color="";
	}	
?>  
  <tr>
    <td align="center"><?=$i;?></td>
    <td align="center"><?=$today;?></td>
    <td align="center"><?=$rows["hn"]?></td>
    <td align="center"><?=$arr1["vn"];?></td>
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
