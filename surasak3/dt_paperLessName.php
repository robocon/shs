<?php 
$hn = $_GET['hn'];
$mysqli = new mysqli("localhost", "root", "1234", "paperless");
$paperLessPath = "D:\DEVELOPMENT\AppServEiei\www\php-zxing-master/";
$q = $mysqli->query("SELECT * FROM `pdfs` WHERE `hn` = '$hn' AND `status` = 1 ORDER BY `id` DESC LIMIT 10");
if ($q->num_rows>0) {
    ?>
    <h1>HN : <?=$hn;?></h1>
    <h3>วันที่ทำการรักษา</h3>
    <?php
    while($item = $q->fetch_assoc()){
        $id = $item['id'];
        $file = $item['file'];
        if (file_exists($paperLessPath.$file)) {
            ?>
            <div>
                <div><p><a href="dt_paperLessFile.php?hn=<?=$hn;?>&id=<?=$id;?>&file=<?=$file;?>" target="right"><?=$item['dateTM'];?></a></p></div>
            </div>
            <?php
        }
    }
}