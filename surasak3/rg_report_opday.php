<?php
include 'bootstrap.php';
include 'rg_menu.php';

$db = Mysql::load();

$day = date('d');
$month = date('m');
$year = date('Y') + 543;
?>
<div class="claearfix">
    <h3>รายชื่อผู้มาขอใบรับรองแพทย์งดเว้นเกณฑ์ทหาร</h3>
    <div>
        <form action="rg_report_opday.php" method="post">
            <table>
                <tr>
                    <td>ตั้งแต่วันที่</td>
                    <td>
                        <input type="text" name="start_day" value="<?=$day;?>" size="2" maxlength="2">
                        <?=getMonthList('start_month', $month);?>
                        <input type="text" name="start_year" value="<?=$year;?>" size="4" maxlength="4">
                    </td>
                </tr>
                <tr>
                    <td>ถึงวันที่</td>
                    <td>
                        <input type="text" name="end_day" value="<?=$day;?>" size="2" maxlength="2">
                        <?=getMonthList('end_month', $month);?>
                        <input type="text" name="end_year" value="<?=$year;?>" size="4" maxlength="4">
                    </td>
                </tr>
                <tr>
                    <td colspan="2">
                        <button type="submit">แสดงผล</button>
                        <input type="hidden" name="action" value="show_data">
                    </td>
                </tr>
            </table>
        </form>
    </div>
</div>
<?php

$action = input_post('action');
if ( $action === 'show_data' ) {

    $start_day = input_post('start_day');
    $start_month = input_post('start_month');
    $start_year = input_post('start_year');

    $end_day = input_post('end_day');
    $end_month = input_post('end_month');
    $end_year = input_post('end_year');

    $date_start = "$start_year-$start_month-$start_day";
    $date_end = "$end_year-$end_month-$end_day";
    
    $year_select = input_post('year_selected');
    $sql = "SELECT a.`hn`,a.`ptname`,a.`thidate`, 
    b.`idcard`,CONCAT(b.`address`,' ต.',b.`tambol`,' อ.',b.`ampur`,' จ.',b.`changwat`) AS `address`, 
    c.`book_id`,c.`number_id`,c.`date_certificate`,c.`hn` AS `rg_hn` 
    FROM `opday2` AS a 
    LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
    LEFT JOIN `rg_soldier` AS c ON c.`hn` = a.`hn`
    WHERE a.`thidate` >= '$date_start' 
    AND a.`thidate` <= '$date_end' 
    AND a.`toborow` LIKE 'EX30%' ";
    $db->select($sql);
    $users = $db->get_items();

    ?>
    <table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff">
        <tr>
            <th>ลำดับ</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>เลขบัตรประชาชน</th>
            <th>ภูมิลำเนา</th>
            <th>วันที่มาโรงพยาบาล</th>
            <th>วันที่ออกใบรับรอง</th>
            <th>เล่มที่</th>
            <th>เลขที่</th>
        </tr>
        
        <?php
        $i = 1;
        $got_cer = 1;
        foreach ($users as $key => $user) {

            list($date, $time) = explode(' ', $user['thidate']);
            list($y, $m, $d) = explode('-', $date);
            $date_coming = $d.' '.$def_fullm_th[$m].' '.$y;

            $color = !empty($user['rg_hn']) ? 'bgcolor="#d1faff"' : '' ;

            $date_certify = '';
            if( !empty($user['date_certificate']) ){
                list($y, $m, $d) = explode('-', $user['date_certificate']);
                $date_certify = $d.' '.$def_fullm_th[$m].' '.( $y + 543 );
            }

            $book_id = '';
            if ( !empty($user['book_id']) ) {
                $book_id = $user['book_id'];
            }

            $number_id = '';
            if ( !empty($user['number_id']) ) {
                $number_id = $user['number_id'];

                $got_cer++;
            }
                
            ?>
            <tr <?=$color;?>>
                <td><?=$i;?></td>
                <td><?=$user['hn'];?></td>
                <td><?=$user['ptname'];?></td>
                <td><?=$user['idcard'];?></td>
                <td><?=$user['address'];?></td>
                <td><?=$date_coming;?></td>
                <td><?=$date_certify;?></td>
                <td><?=$book_id;?></td>
                <td><?=$number_id;?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <div>
        <p><b>จำนวนผู้มาขอใบรับรองแพทย์</b> <?=$i;?> ราย</p>
    </div>
    <div>
        <p><b>จำนวนผู้ได้รับใบรับรองแพทย์</b> <?=$got_cer;?> ราย</p>
    </div>
    <?php
}