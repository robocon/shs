<?php

include 'bootstrap.php';

// echo "อยู่ในช่วงพัฒนาระบบ";
// exit;

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

if ( $page === 'form' ) { 

    $id = input_get('id');
    
    if ( $id === false ) {
        echo "ไม่พบข้อมูล";
        exit;
    }

    $sql = "SELECT b.* 
    FROM `opcardchk` AS a 
    LEFT JOIN `resulthead` AS b ON b.`hn` = a.`hn` 
    WHERE a.`row` = '$id' ";
    $db->select($sql);

    $items = $db->get_items();

    include 'chk_menu.php';
    ?>
    <form action="" method="post">
        <table class="chk_table">
        <?php
            foreach ($items as $key => $item) {
                $autonumber = $item['autonumber'];
            ?>
            <tr>
                <td> <!-- <?=$autonumber;?> --> <?=$item['profilecode'];?></td>
                <td>
                    <div>
                     <input type="text" name="" id="" value="<?=$item['clinicalinfo'];?>">
                    </div>
                </td>
                <td>
                    <?php
                    $detail_sql = "SELECT * FROM `resultdetail` WHERE `autonumber` = '$autonumber' ";
                    $db->select($detail_sql);
                    $detail_items = $db->get_items();
                    foreach( $detail_items AS $key => $detail ){
                        ?>
                        <div style="position: relative;"><?=$detail['labname'];?> : <span style="float: right;"><?=$detail['result'];?></span></div>
                        <?php
                    }
                    ?>
                </td>
            </tr>
            <?php
            }
        ?>
        </table>
        <div>
            <button type="submit">บันทึกข้อมูล</button>
        </div>
    </form>
    <?php
}