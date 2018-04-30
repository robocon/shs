<?php

include 'bootstrap.php';

$page = input('page');
$action = input_post('action');
$db = Mysql::load();

$date = input_post('date_search', date('Y-m-d'));
$hn_search = input_post('hn_search');

if( empty($page) ){

    include 'chk_menu.php';
    ?>
    <div style="content: ''; display: table; clear: both; width: 100%;">
        <fieldset style="width: 30%; float: left;">
            <legend>ค้นหาตามวันที่</legend>
            <form action="chk_sso.php" method="post">
                <div>
                    ค้นหา <input type="text" name="date_search" id="" value="<?=$date;?>">
                    <div>รูปแบบการค้นหา ปี-เดือน-วัน เช่น 2017-01-25</div>
                </div>

                <div>
                    <button type="submit">ทำการค้นหา</button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="by" value="date">
                </div>
            </form>
        </fieldset>
        <fieldset style="width: 30%; float: left;">
            <legend>ค้นหาตาม HN</legend>
            <form action="chk_sso.php" method="post">
                <div>
                    ค้นหา <input type="text" name="hn_search" id="" value="<?=$hn_search;?>">
                </div>
                <div>
                    <button type="submit">ทำการค้นหา</button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="by" value="hn">
                </div>
            </form>
        </fieldset>
    </div>
    <?php
    if( $action == "search" ){

        $by = input_post('by');
        
        if( $by === 'date' ){
            $where = "`date_chk` LIKE '$date%'";
        }else if( $by === 'hn' ){

            $where = "`hn` = '$hn_search'";

        }
        
        $sql = "SELECT *, CONCAT(`prefix`,`name`,' ',`surname`) AS `ptname` 
        FROM `chk_doctor` 
        WHERE $where 
        ORDER BY `id` ASC ";
        $db->select($sql);

        $items = $db->get_items();
        if( count($items) > 0 ){

        
        ?>
        <table class="chk_table">
            <tr>
                <th>#</th>
                <th>HN</th>
                <th>ชื่อ-สกุล</th>
                <th>วันที่ตรวจ</th>
                <th colspan="2">พิมพ์</th>
            </tr>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) {

            $vn = $item['vn'];
            list($date, $time) = explode(' ', $item['date_chk']);
            $hn = $item['hn'];
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['date_chk'];?></td>
                <td><a href="chk_doctor_sticker.php?hn=<?=$hn;?>&vn=<?=$vn;?>&date=<?=$date;?>" target="_blank">Sticker</a></td>
                <td><a href="chk_doctor_print.php?hn=<?=$hn;?>&vn=<?=$vn;?>&date=<?=$date;?>" target="_blank">ใบรายงานผล</a></td>
            </tr>
            <?php
            $i++;
        }
        ?>
        </table>
        <?php
        }else{
            ?>ไม่พบข้อมูลที่ค้นหา<?php
        }
    }
    


}