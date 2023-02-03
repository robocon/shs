<?php
require_once 'bootstrap.php';

if($_SESSION["sOfficer"] == ""){
	echo "<center><font color='#000000' >ขออภัยครับ การ Login ของท่านหมดอายุ </font><br />";
	echo "<a href=\"../sm3.php\" target=\"_top\">กลับหน้าแรก</a></center>";
	exit();
}

$hn = sprintf("%s", $_GET['hn']);
?>
<style>
	body, h3{
		margin: 0;
	}
</style>
<h3>ดูประวัติออนไลน์(e-OPD)</h3>
<frameset cols="19%,80%">
<iframe name="left" src="dt_paperLessListItem.php?hn=<?=$hn;?>" scrolling="auto" style="width: 19%;height: 93%;"></iframe>
<iframe name="right" src="" scrolling="auto" style="width: 80%; height: 93%;"></iframe>
</frameset>