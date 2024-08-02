<?php 
require_once 'bootstrap.php';
$hn = sprintf("%s", $_GET['hn']);
$dbi = new mysqli(HOST,USER,PASS,DB);

$q = $dbi->query("SELECT * FROM `test_pdf` WHERE `hn` = '$hn' AND `status` = 1 ORDER BY `id` DESC LIMIT 10");
if ($q->num_rows>0) {
    ?>
    <h1>HN : <?=$hn;?></h1>
    <h3>วันที่ทำการรักษา</h3>
    <?php
    while($item = $q->fetch_assoc()){
        $id = $item['id'];
        $file = NOTIFY_HOST.'/shsPaperLess/'.$item['file'];
        ?>
        <div>
            <div><p><a href="dt_paperLessFile.php?hn=<?=$hn;?>&id=<?=$id;?>&file=<?=$file;?>" target="right"><?=$item['dateTM'];?></a></p></div>
        </div>
        <?php
    }
}else{
    ?>
    <h1>ยังไม่มีการ Scan e-opd</h1>
    <?php
}