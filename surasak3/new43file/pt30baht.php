<?php

include '../bootstrap.php';
include 'menu.php';
?>
<h3>แสดงรายชื่อผป.สิทธิ30บาทตามปี</h3>
<form action="pt30baht.php" method="post">
    <div class="col">
        <div class="cell">
            <label for="">
                เลือกปี: 
                <?php 
                $default_year = date('Y');
                $default_range = range('2004', $default_year);
                $input_year = input_post('year', $default_year);
                echo getYearList('year', true, $input_year, $default_range);
                ?>
            </label>
            <label for="">
                จนถึงปี: 
                <?php 
                $to_year = input_post('to_year', $default_year);
                echo getYearList('to_year', true, $to_year, $default_range);
                ?>
            </label>
        </div>
    </div>
    <div class="col">
        <div class="cell">
            <button type="submit">แสดงผล</button>
            <input type="hidden" name="action" value="show">
        </div>
    </div>
</form>
<?php

$action = input_post('action');
if( $action === 'show' ){

    $year = input_post('year');
    $to_year = input_post('to_year');

    $db = Mysql::load();
    $sql = "SELECT `hn`,CONCAT(`yot`,' ',`name`,' ',`surname`) AS `ptname`,`idcard`, `ptright1`
    FROM `opcard`
    WHERE ( `regisdate` >= '$year-01-01' AND `regisdate` <= '$to_year-12-31' ) 
    AND `ptright1` LIKE '%ประกันสุขภาพ%'
    ORDER BY `ptright1` ASC, `regisdate` ASC";
    
    $db->select($sql);

    $items = $db->get_items();

    ?>
    <h3>ผู้ป่วยสิทธิ ประกันสุขภาพถ้วนหน้า (30 บาท)</h3>
    <h3>ประจำปี <?=ad_to_bc($year);?>-<?=ad_to_bc($to_year);?></h3>
    <table border="1" cellpadding="0" cellspacing="0" style="border-collapse:collapse;" bordercolor="#000000" >
        <thead>
            <tr>
                <th>ลำดับ</th>
                <th>HN</th>
                <th>ชื่อ - นามสกุล</th>
                <th>เลขที่บัตรประชาชน</th>
                <th>สิทธิ</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $i = 1;
            foreach ($items as $key => $item) {
                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['idcard'];?></td>
                    <td><?=$item['ptright1'];?></td>
                </tr>
                <?php
                $i++;
            }
            ?>
        </tbody>
    </table>
    <?php
}