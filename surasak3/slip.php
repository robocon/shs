<?php 
include("connect.inc");
$sql="select * from opcardchk where hn='".$_POST['hn']."' and part LIKE 'สอบตำรวจ63%'";

$query=mysql_query($sql);

if( mysql_num_rows($query) == 0 ){
	echo "ไม่พบ HN";
	exit;
}

$rows=mysql_fetch_array($query);
$ptname=$rows["yot"]." ".$rows["name"]."   ".$rows["surname"];

// $showdate="27-03-2558";
$showdate = date('d-m-').(date('Y')+543);
$showtime=date("H:i");

$change=$_POST["cash"]-60;

$hn = $HN = $rows["HN"];
$exam_no=$rows["pid"];
$part=$rows['part'];
$datechk=date("Y-m-d H:i:s");
$ptname = trim($ptname);

$add="INSERT INTO `log_opcardchk` SET 
`log_examno`='$exam_no', 
`log_hn`='$HN', 
`log_ptname`='$ptname', 
`log_part`='$part', 
`log_datechk`='$datechk',
`price`='60'";
$query=mysql_query($add);
?>

<html>
<head>
<style type="text/css">
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}
</style>
<title>ออกใบเสร็จ</title>
</head>
<body>
<div style="margin-top:85px;"><strong>ชื่อ : <?=$ptname;?></strong>&nbsp;&nbsp;&nbsp;HN : <?=$hn;?>&nbsp;&nbsp;&nbsp;วันที่ <?=$showdate;?>&nbsp;&nbsp;เวลา <?=$showtime;?></div>

<div style="margin-top:70px;">ค่าบริการตรวจสุขภาพตำรวจ <span style="margin-left:295px;">60.00</span></div>

<div style="margin-top:400px; margin-left:370px;">0.00 <span style="margin-left:55px;">60.00</span></div>

<div style="margin-left: 40px;"><strong>** หกสิบบาทถ้วน **</strong><span style="margin-left:245px;">60.00</span></div>
<div style="font-size:18px;">
<div style="margin-top:10px; margin-left: 250px;">ลงชื่อ.........................................ผู้รับเงิน</div>
<div style="margin-left: 5px;">ได้รับ เงินสด (<?=$_POST["cash"];?>,<?=$change;?>)<span style="margin-left:170px;">(นาง พวงเพ็ชร&nbsp;&nbsp;&nbsp;โนใจปิง)</span></div>
<div style="margin-left: 295px;">เจ้าหน้าที่เก็บเงิน</div>
</div>
<style type="text/javascript">
window.onload = function(){
	window.print();
}
</style>
</body>
</html>