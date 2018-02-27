<?php

include 'bootstrap.php';

$db = Mysql::load();
$action = input('action');
// if( $action === false ){}

$def_date = input('date_select', (date('Y')+543).date('-m'));
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
@media print{
    .hidden{
        display: none;
    }
}
</style>
<div class="hidden">
    <div>
        <a href="../nindex.htm">&lt;&lt;&nbsp;หน้าหลักรพ.</a>
    </div>
    <div>&nbsp;</div>
    <form action="report_vnhn_permonth.php" method="post">
        <div>
            ค้นหาตามเดือน <input type="text" name="date_select" id="" value="<?=$def_date;?>">
            <div><span style="color: red; font-size: 12px;">รูปแบบการค้นหา ปี-เดือน เช่น 2560-12 เป็นต้น</span></div>
        </div>
        <div>
            <button type="submit">แสดงข้อมูล</button>
            <input type="hidden" name="action" value="search">
        </div>
    </form>
</div>

<?php
if( $action === 'search' ){

    list($year, $month) = explode('-', $def_date);

    $sql = "SELECT SUM(a.`rows_vn`) AS `rows`
    FROM (
        # แยกเป็นแต่ละวันมีกี่ vn
        SELECT SUBSTRING(`thidate`,1,10) AS `date`, COUNT(`vn`) AS `rows_vn`
        FROM `opday` 
        WHERE `thidate` LIKE '$def_date%' 
        GROUP BY SUBSTRING(`thidate`,1,10)

    )  AS a";
    $db->select($sql);
    $vn = $db->get_item();

    $sql = "SELECT COUNT(a.`hn`) AS `rows`
    FROM (

        # ดูได้ว่าในเดือน hn นั้นๆ มากี่ครั้ง
        SELECT `hn`,`vn`,COUNT(`hn`) AS `hn_per_month`
        FROM `opday` 
        WHERE `thidate` LIKE '$def_date%' 
        GROUP BY `hn`

    ) AS a";
    $db->select($sql);
    $hn = $db->get_item();

    ?>
    <h3>ยอดจำนวน Visit และ จำนวน HN ในเดือน <?=$def_fullm_th[$month].' '.$year;?></h3>
    <table class="chk_table">
        <tr>
            <th>จำนวน VN</th>
            <th>จำนวน HN</th>
        </tr>
        <tr>
            <td align="right"><?=$vn['rows'];?></td>
            <td align="right"><?=$hn['rows'];?></td>
        </tr>
    </table>
    <?php
}