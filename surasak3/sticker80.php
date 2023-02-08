<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", $_REQUEST['hn']);
$size = sprintf("%s", $_REQUEST['stickersize']);

?>
<style>
    *{font-family: "TH SarabunPSK";font-weight: bold;}
    body{margin: 0;padding: 0;}
    p {margin: 0;padding: 0;}
    .clearfix::after {
        content: "";
        clear: both;
        display: table;
    }
</style>
<?php
$sql = "SELECT `hn`,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn` = '$hn' ";
$q = $dbi->query($sql);
$a = $q->fetch_assoc();
if (empty($size) OR $size==80) { 
    $urlSize = 'size=5';
    $width = '80mm';
    $height = '50mm';
}elseif ($size==30) {
    $urlSize = 'size=3';
    $width = '50mm';
    $height = '26mm';
}
?>
<!-- เอา height ออกไปก่อน เพราะมีปัญหากับ ie บางเครื่องมันล้นกระดาษ 50 -->
<div style="max-width: <?=$width;?>; diplay:block; text-align:left; margin-top: 4px; margin-left: 4px;" class="clearfix">
    <div style="float:left;">
        <img src="printQrCode.php?hn=<?=$hn;?>&<?=$urlSize;?>&margin=1" alt="">
    </div>
    <div style="float:left;">
        <p>HN: <?=$hn;?></p>
        <p><?=$a['ptname'];?></p>
    </div>
</div>
<script type="text/javascript">
    window.onload = function(){
        setTimeout(function(){
            window.print();
        }, 1000);
    }
</script>