<?php

include 'bootstrap.php';

$action = input('action');

if( $action === 'update' ){

    $db = Mysql::load();


    $file = $_FILES['test'];
    $content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);

    foreach ($items as $key => $item) {
        
        list($hn, $name, $surname, $exam_no, $pid) = explode(',', $item);

        $sql = "UPDATE `opcardchk` SET 
        `active` = 'y' 
        WHERE `HN` = '$hn' ";

        $update = $db->update($sql);

        dump($update);

    }

    exit;
}



$page = input_post('page');
if( empty($page) ){
    ?>
    <form action="police_update_status_chk.php" method="post" enctype="multipart/form-data">
    
        <input type="file" name="test" id="">
        <input type="hidden" name="action" value="update">
        <button type="submit">�Ѿഷ</button>
    
    </form>
    <?php
}