<?php
include 'bootstrap.php';

$action = input_post('action');
$def_date = input('date_selected', ( date('Y') + 543 ).date('-m-d') );
?>
<style type="text/css">
    @media print{
        .no_print{
            display: none;
        }
    }
    table.simple {
        border-collapse: collapse;
    }
    table.simple thead{
        background-color: #e0e0e0;
    }
    table.simple, th, td {
        border: 1px solid black;
        padding: 3px;
    }
</style>
<div class="no_print">
    <a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลัก รพ.</a>
</div>
<h3>แสดงจำนวนผู้ป่วยในแต่ละห้องตรวจ</h3>
<form action="opd_room_counter.php" method="post" class="no_print">
    <div>
        เลือกวันที่แสดงผล: 
        <input type="text" name="date_selected" value="<?=$def_date;?>">
    </div>
    <div>
        <button type="submit">ตกลง</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>

<?php
if( $action == 'show' ){

    $date = input_post('date_selected');
    if( preg_match("/(\d+-\d+-\d+)/", $date) !== 1 ){
        echo "กรุณาเลือกรูปแบบ ปี-เดือน-วัน ให้ถูกต้อง <br>";
        echo "ตัวอย่างเช่น 2560-01-26 เป็นต้น";
        exit;
    }

    $db = Mysql::load();
    $sql = "SELECT COUNT(`room`) AS `count`,`room` FROM `opd` WHERE `thidate` LIKE '$date%' GROUP BY `room`";
    $db->select($sql);
    $items = $db->get_items();
    if( count($items) > 0 ){
        list($year, $month, $day) = explode('-', $date);
        ?>
        <h3>วันที่ <?=$day;?> <?=$def_fullm_th[$month];?> <?=$year;?></h3>
        <table class="simple">
            <thead>
                <tr>
                    <th>ห้องตรวจ</th>
                    <th>จำนวนผู้ป่วย</th>
                </tr>
            </thead>
            <tbody>
                <?php
                foreach ($items as $key => $item) {
                    ?>
                    <tr>
                        <td><?=$item['room'];?></td>
                        <td align="right"><?=$item['count'];?></td>
                    </tr>
                    <?php
                }
                ?>
            </tbody>
        </table>
        <?php
    }
    exit;
}