<?php

include 'bootstrap.php';

include 'templates/classic/header.php';

$default_year = get_year_checkup(true);
$year = (int) input_post('year', $default_year);
?>
<form action="quick.php" method="post" class="no_print">
    <div>
        <label for="year">
            ปีงบประมาณ: <input type="year" id="year" name="year" value="<?=$year;?>">
        </label>
        <div>
            <button type="submit">ตกลง</button>
            <input type="hidden" name="showtable" value="table">
        </div>
    </div>
</form>
<?php

$show = input_post('showtable');

if( $show === 'table' ){

    $year = (int) input_post('year');
    
    // นับตามปีงบประมาณ
    $year_start = ($year - 1)."-10-01";
    $year_end = "$year-09-30";

    $bc_year = bc_to_ad($year);
    
    $budget_range = array(
        ($bc_year - 1).'-10' => 'ต.ค.', 
        ($bc_year - 1).'-11' => 'พ.ย.', 
        ($bc_year - 1).'-12' => 'ธ.ค.', 
        $bc_year.'-01' => 'ม.ค.', 
        $bc_year.'-02' => 'ก.พ.', 
        $bc_year.'-03' => 'มี.ค', 
        $bc_year.'-04' => 'เม.ษ.', 
        $bc_year.'-05' => 'พ.ค.', 
        $bc_year.'-06' => 'มิ.ย.', 
        $bc_year.'-07' => 'ก.ค.', 
        $bc_year.'-08' => 'ส.ค.', 
        $bc_year.'-09' => 'ก.ย.'
    );

    $db = Mysql::load();

    ?>
    <div>
        <div>
            <h3>ผลการบริการ</h3>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th rowspan="2">ผลงาน</th>
                <th rowspan="2">จำนวน</th>
                <th colspan="12">ปีงบประมาณ <?=$year;?></th>
            </tr>
            <tr>
                <?php
                foreach($budget_range as $key => $month){
                    ?>
                    <th><?=$month;?></th>
                    <?php
                }
                ?>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td rowspan="2">
                    <p>2. บริการทันตกรรม ครอบคลุมการสร้างเสริมสุขภาพ การป้องกันโรค การรักษาพยาบาล และการฟื้นฟูสมรรถภาพ</p>
                    <p>2.1 มีการให้บริการทั้งรักษาและฟื้นฟูอย่างน้อย 200ครั้ง ต่อผู้มีสิทธิ 1,000คนต่อปี</p>
                </td>
                <td>ครั้ง</td>
                <?php
                //// ทันตกรรม นับเป็นครั้งต่อคน ////
                // DROP TEMPORARY TABLE IF EXISTS `tmp_depart`;
                $sql = "CREATE TEMPORARY TABLE `tmp_den1` 
                SELECT COUNT(`hn`) AS `user_rows`, 
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 6 )) AS `full_ad_date`,
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 2 )) AS `ad_month`,
                (SUBSTRING(`date`, 1, 4) - 543) AS `year`,
                SUBSTRING( `date`, 6, 2 ) AS `month`, 
                SUBSTRING( `date`, 9, 2 ) AS `date`,
                IF(COUNT(`hn` >= 1),1,0) AS `num_user`
                FROM `depart`  
                WHERE `date` >= '$year_start' AND `date` <= '$year_end' 
                AND `status` = 'Y' 
                AND `depart` = 'DENTA'
                AND ( 
                    `ptright` LIKE 'R09%' 
                    OR `ptright` LIKE 'R10%' OR `ptright` LIKE 'R11%' 
                    OR `ptright` LIKE 'R12%' OR `ptright` LIKE 'R13%' 
                    OR `ptright` LIKE 'R14%' OR `ptright` LIKE 'R15%' 
                    )
                AND ( `cashok` != '' OR `cashok` IS NOT NULL ) 
                GROUP BY `hn`,`full_ad_date` 
                ORDER BY `full_ad_date` ASC;";
                $db->select($sql);

                $sql = "SELECT `full_ad_date`,`ad_month`,`year`,`month`,SUM(`num_user`) AS `sum` 
                FROM `tmp_den1` 
                GROUP BY `ad_month`;";
                $db->select($sql);
                $items = $db->get_items();

                $new_items = array();
                foreach ($items as $key => $item) {
                    $key = $item['ad_month'];
                    $new_items[$key] = $item;
                }

                //// ทันตกรรม ////
                foreach($budget_range as $key => $month){
                    $sum = 0;
                    if ( isset($new_items[$key]) ) {
                        $item = $new_items[$key];
                        $sum = $item['sum'];
                    }
                    ?>
                    <td align="right"><?=$sum;?></td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <td>คน</td>
            <?php
                //// นับเป็นคนต่อเดือน
                $sql = "CREATE TEMPORARY TABLE `tmp_den2` 
                SELECT COUNT(`hn`) AS `user_rows`,`hn`,  
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 6 )) AS `full_ad_date`, 
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 2 )) AS `ad_month`, 
                (SUBSTRING(`date`, 1, 4) - 543) AS `year`, 
                SUBSTRING( `date`, 6, 2 ) AS `month`, 
                SUBSTRING( `date`, 9, 2 ) AS `date`, 
                IF(COUNT(`hn` >= 1),1,0) AS `num_user` 
                FROM `depart` 
                WHERE `date` >= '$year_start' AND `date` <= '$year_end' 
                AND `status` = 'Y' 
                AND `depart` = 'DENTA' 
                AND ( 
                    `ptright` LIKE 'R09%' 
                    OR `ptright` LIKE 'R10%' OR `ptright` LIKE 'R11%' 
                    OR `ptright` LIKE 'R12%' OR `ptright` LIKE 'R13%' 
                    OR `ptright` LIKE 'R14%' OR `ptright` LIKE 'R15%' 
                    ) 
                AND ( `cashok` != '' OR `cashok` IS NOT NULL ) 
                GROUP BY `hn`,`ad_month` 
                ORDER BY `ad_month` ASC;";
                $db->select($sql);

                $sql = "SELECT `full_ad_date`,`ad_month`,`year`,`month`,SUM(`num_user`) AS `sum` 
                FROM `tmp_den2` 
                GROUP BY `ad_month`;";
                $db->select($sql);
                $items = $db->get_items();

                $new_items = array();
                foreach ($items as $key => $item) {
                    $key = $item['ad_month'];
                    $new_items[$key] = $item;
                }

                //// ทันตกรรม ////
                foreach($budget_range as $key => $month){
                    $sum = 0;
                    if ( isset($new_items[$key]) ) {
                        $item = $new_items[$key];
                        $sum = $item['sum'];
                    }
                    ?>
                    <td align="right"><?=$sum;?></td>
                    <?php
                }
            ?>
            </tr>
            <tr>
                <td rowspan="2">
                    <p>3.บริการกายภาพบำบัด โดยการใช้กระบวนการทางกายภาพบำบัดครอบคลุมการสร้างเสริมสุขภาพ การป้องกันดรค การรักษพยาบาล และการฟื้นฟูสมรรถภาพมีผลงานบริการกายภาพบำบัดอย่างน้อย 1,320ครั้ง ต่อผู้มีสิทธิ 10,000คน</p>
                </td>
                <td>ครั้ง</td>
                <?php
                //// กายภาพ นับเป็นจำนวนครั้ง ////
                $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_pt` 
                SELECT COUNT(`hn`) AS `user_rows`, 
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 6 )) AS `full_ad_date`,
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 2 )) AS `ad_month`,
                (SUBSTRING(`date`, 1, 4) - 543) AS `year`,
                SUBSTRING( `date`, 6, 2 ) AS `month`, 
                SUBSTRING( `date`, 9, 2 ) AS `date`,
                IF(COUNT(`hn` >= 1),1,0) AS `num_user`
                FROM `depart`  
                WHERE `date` >= '$year_start' AND `date` <= '$year_end' 
                AND `status` = 'Y' 
                AND ( `doctor` LIKE 'MD074%' OR `doctor` LIKE 'MD013%' )
                AND ( 
                    `ptright` LIKE 'R09%' 
                    OR `ptright` LIKE 'R10%' OR `ptright` LIKE 'R11%' 
                    OR `ptright` LIKE 'R12%' OR `ptright` LIKE 'R13%' 
                    OR `ptright` LIKE 'R14%' OR `ptright` LIKE 'R15%' 
                    ) 
                AND ( `cashok` != '' OR `cashok` IS NOT NULL )
                GROUP BY `hn`,`full_ad_date` 
                ORDER BY `full_ad_date` ASC;";
                $db->select($sql);

                $sql = "SELECT `full_ad_date`,`ad_month`,`year`,`month`,SUM(`num_user`) AS `sum` 
                FROM `tmp_pt` 
                GROUP BY `ad_month`;";
                $db->select($sql);
                $items = $db->get_items();

                $new_items = array();
                foreach ($items as $key => $item) {
                    $key = $item['ad_month'];
                    $new_items[$key] = $item;
                }
                //// กายภาพ ////
                foreach($budget_range as $key => $month){
                    $sum = 0;
                    if ( isset($new_items[$key]) ) {
                        $item = $new_items[$key];
                        $sum = $item['sum'];
                    }
                    ?>
                    <td align="right"><?=$sum;?></td>
                    <?php
                }
                ?>
            </tr>
            <tr>
                <td>คน</td>
                <?php
                //// กายภาพ นับเป็นจำนวนครั้ง ////
                $sql = "CREATE TEMPORARY TABLE IF NOT EXISTS `tmp_pt2` 
                SELECT COUNT(`hn`) AS `user_rows`, 
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 6 )) AS `full_ad_date`,
                CONCAT((SUBSTRING(`date`, 1, 4) - 543), '-', SUBSTRING( `date`, 6, 2 )) AS `ad_month`,
                (SUBSTRING(`date`, 1, 4) - 543) AS `year`,
                SUBSTRING( `date`, 6, 2 ) AS `month`, 
                SUBSTRING( `date`, 9, 2 ) AS `date`,
                IF(COUNT(`hn` >= 1),1,0) AS `num_user`
                FROM `depart`  
                WHERE `date` >= '$year_start' AND `date` <= '$year_end' 
                AND `status` = 'Y' 
                AND ( `doctor` LIKE 'MD074%' OR `doctor` LIKE 'MD013%' )
                AND ( 
                    `ptright` LIKE 'R09%' 
                    OR `ptright` LIKE 'R10%' OR `ptright` LIKE 'R11%' 
                    OR `ptright` LIKE 'R12%' OR `ptright` LIKE 'R13%' 
                    OR `ptright` LIKE 'R14%' OR `ptright` LIKE 'R15%' 
                    ) 
                AND ( `cashok` != '' OR `cashok` IS NOT NULL )
                GROUP BY `hn`,`ad_month` 
                ORDER BY `ad_month` ASC;";
                $db->select($sql);

                $sql = "SELECT `full_ad_date`,`ad_month`,`year`,`month`,SUM(`num_user`) AS `sum` 
                FROM `tmp_pt2` 
                GROUP BY `ad_month`;";
                $db->select($sql);
                $items = $db->get_items();

                $new_items = array();
                foreach ($items as $key => $item) {
                    $key = $item['ad_month'];
                    $new_items[$key] = $item;
                }
                //// กายภาพ ////
                foreach($budget_range as $key => $month){
                    $sum = 0;
                    if ( isset($new_items[$key]) ) {
                        $item = $new_items[$key];
                        $sum = $item['sum'];
                    }
                    ?>
                    <td align="right"><?=$sum;?></td>
                    <?php
                }
                ?>
            </tr>
        </tbody>
    </table>
    <?php
    




}












include 'templates/classic/footer.php';