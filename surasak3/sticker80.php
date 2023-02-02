<?php 
require_once 'bootstrap.php';
// exit;
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", $_REQUEST['hn']);
$show = sprintf("%s", $_REQUEST['showvn']);
$thdateHn = sprintf("%s", $_REQUEST['thdatehn']);

?>
<style>
    body{
        margin: 0;
        padding: 0;
    }
    p {
        margin: 0;
        padding: 0;
    }
</style>
<?php

if (empty($show)) {
    ?>
    <div style="width: 80mm; height: 50mm;border: 1px solid red; text-align:left;">
        <div style="float:left; text-align:center;">
            <img src="printQrCode.php?hn=<?=$hn;?>&size=5&margin=1" alt="">
            <p><?=$hn;?></p>
        </div>
    </div>
    
    <?php
    
}elseif ($show==='vn') {
    
    $sql = "SELECT `thidate`,`hn`,`vn`,`ptname`,`age`,`toborow` FROM `opday` WHERE `thdatehn` = '$thdateHn' ";
    $q = $dbi->query($sql);
    $a = $q->fetch_assoc();
    ?>
    
    <div style="width: 80mm; height: 50mm; border: 1px solid red;">
        <div style="float:left; text-align:center;">
            <img src="printQrCode.php?hn=<?=$hn;?>&size=5&margin=1" alt="">
            <p>Digitalcard</p>
        </div>
        <div style="margin-left: 4px;">
            <p>HN: <?=$a['hn'];?></p>
            <p><?=$a['ptname'];?></p>
            <p>VN: <?=$a['vn'];?> <?=$a['vn'];?> <?=$a['age'];?></p>
            <p><?=$a['thidate'];?></p>
            <p><?=$a['toborow'];?></p>
        </div>
    </div>
    
    <?php
}
?>
