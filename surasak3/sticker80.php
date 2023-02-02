<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", $_REQUEST['hn']);
$size = sprintf("%s", $_REQUEST['stickersize']);
$thdateHn = sprintf("%s", $_REQUEST['thdatehn']);

?>
<style>
    *{font-family: "TH SarabunPSK";font-weight: bold;}
    body{margin: 0;padding: 0;}
    p {margin: 0;padding: 0;}
</style>
<?php
$thdateHn = date('d-m-').(date('Y')+543).$hn;
$sql = "SELECT `thidate`,`hn`,`vn`,`ptname`,`age`,`toborow`,`ptright` FROM `opday` WHERE `thdatehn` = '$thdateHn' ";
$q = $dbi->query($sql);
$a = $q->fetch_assoc();
if (empty($size) OR $size==80) { 
    $urlSize = 'size=5';
    $width = '80mm';
    $height = '50mm';
}elseif ($size==30) {
    $urlSize = 'size=3';
    $width = '50mm';
    $height = '30mm';
}
?>
<div style="width: <?=$width;?>; height: <?=$height;?>; text-align:left;">
    <div style="float:left; text-align:center;">
        <img src="printQrCode.php?hn=<?=$hn;?>&<?=$urlSize;?>&margin=1" alt="">
        <p><?=$hn;?></p>
        <p><?=$a['ptname'];?></p>
    </div>
</div>