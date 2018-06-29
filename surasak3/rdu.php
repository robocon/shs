<?php

include 'bootstrap.php';

define('RDU_TEST', '1');

global $in6_result;

$db = Mysql::load();

$def_date = (date('Y') + 543).date('-m');

$date = input_post('date', $def_date);

?>

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
<form action="rdu.php" method="post">

    <div>
        เลือกเดือน <input type="text" name="date" id="" value="<?=$date;?>">
    </div>

    <div>
        <button type="submit">แสดงผล</button>
        <input type="hidden" name="action" value="load">
    </div>

</form>

<?php
// special char
// w3schools.com/charsets/ref_utf_math.asp
$action = input_post('action');

if ( $action == 'load' ) {
    
    ?>
    <table class="chk_table">
        <tr>
            <th>ตัวชี้วัดที่</th>
            <th>ชื่อตัวชี้วัด</th>
            <th>เป้าหมาย</th>
            <th>ร.พ.ค่ายฯ</th>
        </tr>
        <tr>
            <td align="center">6</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันในผู้ป่วยนอก</td>
        
            <?php
            include 'rdu_in6.php';
            ?>
            <td>&le; ร้อยละ 20</td>
            <td><?=number_format($in6_result, 2);?></td>
            
        </tr>
    </table>
    <?php
}