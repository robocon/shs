<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$hn = $dbi->escape_string($_GET['hn']);
$q = $dbi->query("SELECT `id`,`date`,`type` FROM `echo_cardio` WHERE `hn` = '$hn' ORDER BY `id` DESC ");
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
<HTML>
<HEAD>

<META NAME="Generator" CONTENT="EditPlus">
<META NAME="Author" CONTENT="">
<META NAME="Keywords" CONTENT="">
<META NAME="Description" CONTENT="">
<style type="text/css">


a:link {color:#000000; text-decoration:none;}
a:visited {color:#000000; text-decoration:none;}
a:active {color:#FF0000; text-decoration:underline;}
a:hover {color:#FF0000; text-decoration:underline;}

body,td,th {
	font-family:"TH Sarabun New","TH SarabunPSK";
	font-size: 20 px;
}

.font_title{
	font-family:"TH Sarabun New","TH SarabunPSK";
	font-size: 20 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</HEAD>
<BODY>
<h3>เลือกวันที่เพื่อแสดงรายการ</h3>
<ol style="margin: 0; padding: 4px 0 4px 12px;">
<?php 
$i = 1;
while ($a=$q->fetch_assoc()) { 
	$bg = 'style="background-color: #e5e5e5;"';
	if($i%2===0){
		$bg = 'style="background-color: #F0F4BF;"';
	}

	$type = '';
	if($a['type']=='IPD'){
		$type = '(IPD) ';
	}
    ?>
    <li <?=$bg;?>><a href="echo_print.php?id=<?=$a['id'];?>&print=noprint" target="right"><?=$a['date'];?> <?=$type;?></a></li>
    <?php
	$i++;
}
?>
</ol>
</BODY>
</HTML>