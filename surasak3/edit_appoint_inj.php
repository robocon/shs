<?php 

include 'bootstrap.php';

$rdu_configs = array(
    'host' => '192.168.1.2',
    'port' => '3306',
    'dbname' => 'smdb',
    'user' => 'remoteuser',
    'pass' => ''
);

$db = Mysql::load($rdu_configs);
// $db->set_charset('TIS620');

$page = input('page');
$action = input('action');

if ( $action == 'save' ) {
    //

    dump($_POST);

    $new_date = input_post('new_date');
    $appoint_id = input_post('appoint_id');
    $ddrugrx_id = input_post('ddrugrx_id');
    $dphardep_id = input_post('dphardep_id');
    $hn = input_post('hn');

    exit;
}

// if ( empty($page) ) {
    ?>
    <style>
    body, button{
        font-family: TH Sarabun NEW, TH SarabunPSK;
        font-size: 16pt;
    }
    .chk_table{
        border-collapse: collapse;
    }

    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
        font-size: 16pt;
    }
    </style>
    <div>
        <h3>แก้ไขฉีดยากรณีมาไม่ตรงนัด</h3>
    </div>
    <fieldset>
        <legend>ค้นหาจาก HN</legend>
    
        <form action="edit_appoint_inj.php" method="post">
            <div>
                HN: <input type="text" name="hn" id="">
            </div>
            <div>
                <button type="submit">ค้นหา</button>
                <input type="hidden" name="page" value="search_hn">
            </div>
        </form>

    </fieldset>
    <?php
// }


if ( $page == 'search_hn' ) {

    $hn = input_post('hn');

    $sql = "SELECT * 
    FROM `appoint` 
    WHERE `detail` LIKE 'FU22%' 
    AND `hn` = '$hn' 
    GROUP BY `detail2`,`appdate` 
    ORDER BY `detail2`,`appdate` DESC ";

    $db->select($sql);
    $items = $db->get_items();

    ?>
    <fieldset>
        <legend>รายละเอียดนัดฉีดยา</legend>
        <table class="chk_table">
            <tr>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>นัดมาวันที่</th>
                <th>เวลา</th>
                <th>นัดมาเพื่อ</th>
                <th>ยาฉีด</th>
                <th>เข็มที่</th>
                <th>แก้ไข</th>
            </tr>
        
        <?php
        foreach ($items as $key => $item) { 

            list($y,$m,$d) = explode('-',$item['appdate']);

            $mTh = $def_fullm_th[$m];
            ?>
            <tr>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$d.' '.$mTh.' '.$y;?></td>
                <td><?=$item['apptime'];?></td>
                <td><?=$item['detail'];?></td>
                <td><?=$item['detail2'];?></td>
                <td><?=$item['injno'];?></td>
                <td><a href="edit_appoint_inj.php?id=<?=$item['row_id'];?>&page=edit_form">แก้ไข</a></td>
            </tr>
            <?php
        }
        ?>
        </table>
    </fieldset>
    <?php
}elseif ( $page == 'edit_form' ) {
    // 

    $id = input_get('id');

    $sql = "SELECT `row_id`,`hn`,`appdate`,`ptname`,`detail` FROM `appoint` WHERE `row_id` = '$id' LIMIT 1 ";
    $db->select($sql);
    $item = $db->get_item();

    $hn = $item['hn'];
    $appdate = $item['appdate'];

    list($y,$m,$d) = explode('-',$item['appdate']);
    $mTh = $def_fullm_th[$m];

    // หา vn
    // $sql = "SELECT * FROM `opday` WHERE ";

    $sql = "SELECT `row_id`,`tradname`,`injno` FROM `ddrugrx` WHERE `date` LIKE '$appdate%' AND `hn` = '$hn' ";
    $db->select($sql);
    $drug = $db->get_item();

    $sql = "SELECT `row_id` FROM `dphardep` WHERE `date` LIKE '$appdate%' AND `hn` = '$hn' ";
    $db->select($sql);
    $phar = $db->get_item();
    
    ?>
    <fieldset>
        <legend>แก้ไขวันนัดฉีดยา</legend>

        <fieldset>
            <legend>ข้อมูลเบื้องต้น</legend>
            <div>
                <p><b>HN:</b> <?=$item['hn'];?> <b>ชื่อ-สกุล:</b> <?=$item['ptname'];?> <b>นัดวันที่:</b> <?=$d.' '.$mTh.' '.$y;?> <b>นัดมาเพื่อ:</b> <?=$item['detail'];?> </p>
                <p><b>ยาฉีด:</b> <?=$drug['tradname'];?> <?=$drug['injno'];?></p>
            </div>
        </fieldset>

        <form action="edit_appoint_inj.php" method="post">
            <div>
                เลื่อนวันนัด: <input type="text" name="new_date" id="" value="<?=$appdate;?>">
            </div>
            <div>
                <button type="submit">บันทึก</button>
                <input type="hidden" name="action" value="save">
                <input type="hidden" name="appoint_id" value="<?=$item['row_id'];?>">
                <input type="hidden" name="ddrugrx_id" value="<?=$drug['row_id'];?>">
                <input type="hidden" name="dphardep_id" value="<?=$phar['row_id'];?>">
                <input type="hidden" name="hn" value="<?=$item['hn'];?>">
            </div>
        </form>
    </fieldset>
    <?php

}
?>