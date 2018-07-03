<?php
include 'bootstrap.php';
$db = Mysql::load();
?>

<div>
    <a href="../nindex.htm">หน้าหลัก ร.พ.</a>
</div>

<style>
/* ตาราง */
body, button{
    font-family: TH SarabunPSK, TH Sarabun NEW;
    font-size: 16pt;
}
.chk_table{
    border-collapse: collapse;
}

.chk_table, th, td{
    border: 1px solid black;
    font-size: 16pt;
}

.chk_table th,
.chk_table td{
    padding: 3px;
}
</style>
<?php
$def_month = ( date('Y') + 543 ).date('-m');
$month_select = input_post('month_selected', $def_month);
?>
<h3>ระยะเวลารอคอยของผู้สูงอายุ70ปีขึ้นไป</h3>
<form action="opd_age70.php" method="post">
    <div>
        เลือกเดือน <input type="text" name="month_selected" value="<?=$month_select;?>">
        <br>
        <span style="color: red;"><u><b>รูปแบบ ปี-เดือน เช่น 2561-02</b></u></span>
    </div>
    <div>
        <button type="submit">แสดงผล</button>
        <input type="hidden" name="action" value="show">
    </div>
</form>

<?php
$action = input_post('action');
if ( $action == 'show' ) {

    $month_selected = input_post('month_selected');
    
    $sql = "SELECT `row_id`,SUBSTRING(`thidate`, 1, 10) AS `date`,`thdatehn`,`hn`,`ptname`,`age`,`ptright`,`time1`,`time2`  
    FROM `opday` 
    WHERE `thidate` LIKE '$month_selected%' 
    AND SUBSTRING(`age`, 1, 2) >= 70 ";

    $db->select($sql);
    $items = $db->get_items();

    ?>

    <table class="chk_table">
        <tr>
            <th>ลำดับ</th>
            <th>วันที่</th>
            <th>HN</th>
            <th>ชื่อ-สกุล</th>
            <th>อายุ</th>
            <th>ระยะเวลา<br>ยื่นบัตรทะเบียน</th>
            <th>ระยะเวลา<br>ซักประวัติ</th>
        </tr>

    <?php 

    $i = 1;
    foreach ($items as $key => $item) {

        $thdatehn = $item['thdatehn'];

        $time1 = $item['time1'];
        $time2 = $item['time2'];

        $regis_time = '-';
        if ( !empty($time1) && !empty($time2) ) {
            $time_diff = strtotime($time2) - strtotime($time1);
            $regis_time = gmdate('H:i:s', $time_diff);
        }

        $opd_time = '-';
        if ( $regis_time != '-' ) { 

            $sql = "SELECT SUBSTRING(`thidate`, 1, 10) AS `date`,SUBSTRING(`thidate`, 11, 8) AS `opd_time`  
            FROM `opd` 
            WHERE `thdatehn` = '$thdatehn'";
            $db->select($sql);
            $opd = $db->get_item();

            if( !empty($opd) ){
                $time3 = $opd['opd_time'];

                // ถ้าเวลา checkout ของทะเบียนเกินเวลาของซักประวัติ
                // จะเอาเวลา checkin แทน
                if( $time2 > $time3 ){
                    $time2 = $time1;
                }

                $opd_diff = strtotime($time3) - strtotime($time2);
                $opd_time = gmdate('H:i:s', $opd_diff);
            }
        }
        
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['date'];?></td>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['age'];?></td>
            <td align="center"><?=$regis_time;?></td>
            <td align="center"><?=$opd_time;?></td>
        </tr>
        <?php 
        $i++;
    }
    ?>
    </table>
    <div style="font-size: 14pt;">
        <p style="margin: 0; padding: 0;"><b>ระยะเวลา ยื่นบัตรทะเบียน</b> : นับเวลาจากการลงทะเบียน -> ห้องค้นบัตร -> กลับออกมาที่เค้าเตอร์ทะเบียน</p>
        <p style="margin: 0; padding: 0;"><b>ระยะเวลา ซักประวัติ</b> : นับเวลาจากการ Checkout ที่ห้องค้นบัตร มาจนถึงการบันทึกข้อมูลที่ซักประวัติ</p>
    </div>
    <?php
}
