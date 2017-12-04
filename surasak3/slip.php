<style type="text/css">
<!--
body,td,th {
	font-family: Angsana New;
	font-size: 20px;
}
-->
</style><title>ออกใบเสร็จ</title></head>

<body onLoad="window.print(); window.close();">
<?
 include("connect.inc");
$sql="select * from opcardchk where hn='$_POST[hn]'";
//echo $sql;
$query=mysql_query($sql);
$rows=mysql_fetch_array($query);
$ptname=$rows["yot"]." ".$rows["name"]."&nbsp;&nbsp;&nbsp;".$rows["surname"];

$showdate="27-03-2558";
$showtime=date("H:i");


$change=$_POST["cash"]-800;
?>
<div style="margin-top:85px;"><strong>ชื่อ : <?=$ptname;?></strong>&nbsp;&nbsp;&nbsp;HN : <?=$hn;?>&nbsp;&nbsp;&nbsp;วันที่ <?=$showdate;?>&nbsp;&nbsp;เวลา <?=$showtime;?></div>


<div style="margin-top:70px;">ค่าบริการตรวจสุขภาพตำรวจ <span style="margin-left:295px;">800.00</span></div>

<div style="margin-top:400px; margin-left:370px;">0.00 <span style="margin-left:55px;">800.00</span></div>

<div style="margin-left: 40px;"><strong>** แปดร้อยบาทถ้วน **</strong><span style="margin-left:245px;">800.00</span></div>
<div style="font-size:18px;">
<div style="margin-top:10px; margin-left: 250px;">ลงชื่อ.........................................ผู้รับเงิน</div>
<? if($_POST["cash"]=="1000"){ ?>
<div style="margin-left: 5px;">ได้รับ เงินสด (<?=$_POST["cash"];?>,<?=$change;?>)<span style="margin-left:150px;">(นาง พวงเพ็ชร&nbsp;&nbsp;&nbsp;โนใจปิง)</span></div>
<? }else{?>
<div style="margin-left: 5px;">ได้รับ เงินสด (<?=$_POST["cash"];?>,<?=$change;?>)<span style="margin-left:170px;">(นาง พวงเพ็ชร&nbsp;&nbsp;&nbsp;โนใจปิง)</span></div>
<? }?>
<div style="margin-left: 295px;">เจ้าหน้าที่เก็บเงิน</div>
</div>
</body>
