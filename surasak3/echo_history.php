<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$hn = $dbi->escape_string($_GET['hn']);
$q = $dbi->query("SELECT `date` FROM `echo_cardio` WHERE `hn` = '$hn' ");
if($q->num_rows > 0){
    ?>
    <frameset cols="25%,75%">
        <frame name="left" src="echo_history_date.php?hn=<?=$hn;?>" scrolling="auto" width="20%" height="100%">
        <frame name="right" src="" scrolling="auto"  width="80%">
    </frameset>
    <?php
}else{
    ?>
    <p>ไม่พบข้อมูลย้อนหลัง</p>
    <?php
}
?>
