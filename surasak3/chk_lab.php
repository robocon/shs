<?php

include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

if ( $page === false ) { 

    $id = input_get('id');
    
    if ( $id === false ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $

    ?>
    <form action="" method="post">
        <div>
            <input type="text" name="" id="">
        </div>
    </form>
    <?php
}