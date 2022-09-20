<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$hn = $dbi->escape_string($_GET['hn']);
$q = $dbi->query("SELECT `id`,`date` FROM `echo_cardio` WHERE `hn` = '$hn' ");
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
	font-family:  Angsana New;
	font-size: 20 px;
}

.font_title{
	font-family:  Angsana New;
	font-size: 20 px;
	color:#FFFFFF;
	font-weight: bold;

}
</style>
</HEAD>

<BODY>

<h3>เลือกวันที่</h3>



<?php
while ($a=$q->fetch_assoc()) {
    ?>
    <a href="echo_print.php?id=<?=$a['id'];?>&print=noprint" target="right"><?=$a['date'];?></a>
    <?php
}


?>




</BODY>
</HTML>