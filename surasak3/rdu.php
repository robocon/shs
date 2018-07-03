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

<div>
    <a href="../nindex.htm">กลับหน้าหลัก ร.พ.</a>
</div>

<h3>RDU Indicator</h3>
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
            <th>A</th>
            <th>B</th>
            <th>ร.พ.ค่ายฯ</th>
        </tr>
        <tr>
            <td align="center">6</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในโรคติดเชื้อที่ระบบการหายใจช่วงบนและหลอดลมอักเสบเฉียบพลันในผู้ป่วยนอก</td>
            <?php
            // include 'rdu_in6.php';
            ?>
            <td>&le; ร้อยละ 20</td>
            <td align="right"><?=$in6a;?></td>
            <td align="right"><?=$in6b;?></td>
            <td align="right"><?=number_format($in6_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">7</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในโรคอุจจาระร่วงเฉียบพลัน</td>
            <?php
            // include 'rdu_in7.php';
            ?>
            <td>&le; ร้อยละ 20</td>
            <td align="right"><?=$in7a;?></td>
            <td align="right"><?=$in7b;?></td>
            <td align="right"><?=number_format($in7_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">8</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในบาดแผลสดจากอุบัติเหตุ</td>
            <?php
            // include 'rdu_in8.php';
            ?>
            <td>&le; ร้อยละ 40</td>
            <td align="right"><?=$in8a;?></td>
            <td align="right"><?=$in8b;?></td>
            <td align="right"><?=number_format($in8_result, 2);?></td>
        </tr>
        <tr>
            <td align="center">9</td>
            <td>ร้อยละการใช้ยาปฏิชีวนะในหญิงคลอดปกติครบกำหนดทางช่องคลอด</td>
            <td>&le; ร้อยละ 10</td>
            <td>-</td>
            <td>-</td>
            <td>-</td>
        </tr>
        <tr>
            <td align="center">10</td>
            <td>ร้อยละของผู้ป่วยความดันเลือดสูงทั่วไป ที่มีการใช้ RAS blockage (ACEIs/ARBs/Renin inhibitor) <br>
            2ชนิดร่วมกัน ในการรักษาภาวะความดันเลือดสูง</td>
            <?php
            include 'rdu_in10.php';
            ?>
            <td>= ร้อยละ 10</td>
            <td align="right"><?=$in10a;?></td>
            <td align="right"><?=$in10b;?></td>
            <td align="right"><?=number_format($in10_result, 2);?></td>
        </tr>
    </table>
    <?php
}