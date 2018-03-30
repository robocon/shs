<?php

include '../bootstrap.php';

require "header.php";

$date = input('date_selected', date('Y-m-d'));
?>

<style>
/* ตาราง */
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>

<form action="report_retinal_exam.php" method="post">
    <div>
        เลือกวันที่ <input type="text" name="date_selected" id="" value="<?=$date;?>">
    </div>
    <div>
        <button type="submit">แสดงวันที่</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>
<?php
$action = input('action');
if( $action == 'show' ){

    $db = Mysql::load();

    $sql = "SELECT * 
    FROM `diabetes_clinic_history` 
    WHERE `dateN` LIKE '$date%' 
    AND `retinal` != '' ";

    $db->select($sql);
    $items = $db->get_items();
    
    ?>
    <table class="chk_table">
        <tr>
            <th>#</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>สิทธิ</th>
            <th>Retinal Exam</th>
            <th>วันที่ Retinal Exam</th>
        </tr>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) {
            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['ptright'];?></td>
                <td><?=$item['retinal'];?></td>
                <td><?=$item['retinal_date'];?></td>
            </tr>
            <?php
            $i++;
        }
        ?>
    </table>
    <?php
}