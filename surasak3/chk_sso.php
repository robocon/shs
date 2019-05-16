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
    <div>
        <fieldset>
            <legend>ค้นหาตามบริษัท</legend>
            <form action="chk_sso.php" method="post">
                <?php 
                $db->select("SELECT `code`,`name` FROM `chk_company_list` ORDER BY `id` DESC");
                $company_list = $db->get_items();
                ?>
                <div>
                    เลือกบริษัท: 
                    <select name="company_name" id="">
                        <?php 
                        foreach ($company_list as $key => $item) {
                            ?>
                            <option value="<?=$item['code'];?>"><?=$item['name'];?> (<?=$item['code'];?>)</option>
                            <?php
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <button type="submit">ค้นหา</button>
                    <input type="hidden" name="action" value="search">
                    <input type="hidden" name="by" value="company">
                </div>
            </form>
        </fieldset>
    </div>
    <?php
    if( $action == "search" ){

        $by = input_post('by');
        
        if( $by == 'date' OR $by == 'hn' ){

            if( $by === 'date' ){
                $where = "`date_chk` LIKE '$date%'";
    
            }elseif ( $by === 'hn' ){
                $where = "`hn` = '$hn_search'";
    
            }

            $sql = "SELECT *, CONCAT(`prefix`,`name`,' ',`surname`) AS `ptname` 
            FROM `chk_doctor` 
            WHERE $where 
            ORDER BY `id` ASC ";
            $db->select($sql);


        }elseif($by === 'company') {

            $company_name = input_post('company_name');
            $sql = "SELECT a.`HN` AS `hn2`,a.`ptname`,c.*  
            FROM ( 
                    SELECT *,CONCAT(`name`,' ',`surname`) AS `ptname` FROM `opcardchk` WHERE `part` = '$company_name' 
            ) AS a 
            LEFT JOIN ( 
                SELECT `code`,`name`,SUBSTRING(`yearchk`,3,2) AS `yearchk` FROM `chk_company_list` 
            ) AS b ON b.`code` = a.`part` 
            LEFT JOIN `chk_doctor` AS c ON c.`hn` = a.`HN` AND c.`yearchk` = b.`yearchk`  "; 
            $db->select($sql);

        }

        $items = $db->get_items();
        if( count($items) > 0 ){

            ?>
            <br>
            <table class="chk_table">
                <tr>
                    <th>#</th>
                    <th>HN</th>
                    <th>ชื่อ-สกุล</th>
                    <th>วันที่ตรวจ</th>
                    <th>แพทย์</th>
                    <th colspan="2">พิมพ์</th>
                </tr>
            <?php 
            $i = 1;
            foreach ($items as $key => $item) {

                $vn = $item['vn'];
                list($date, $time) = explode(' ', $item['date_chk']);
                $hn = !empty($item['hn']) ? $item['hn'] : $item['hn2'] ;
            
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$hn;?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['date_chk'];?></td>
                    <td><?=$item['doctor'];?></td>
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