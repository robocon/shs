<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$q = $dbi->query("SELECT *,SUBSTRING(`date`,1,10) AS `date` FROM `depart` WHERE `date` LIKE '2565-10%' AND `cashok` = 'SSOCHKUP66' AND (`depart`='XRAY' OR `depart`='PATHO') GROUP BY `hn`,`depart` ORDER BY `date` ");
$users = array();
while ($a = $q->fetch_assoc()) {
    $hn = $a['hn']; 

    $q_op = $dbi->query("SELECT `guardian`,`employee` FROM `opcard` WHERE `hn` = '$hn' LIMIT 1");
    $op = $q_op->fetch_assoc();
    $guardian = $op['guardian'];

    $depart = $a['depart'];

    $users[$hn]['hn'] = $a['hn'];
    $users[$hn]['guardian'] = $op['guardian'];
    $users[$hn]['date'] = $a['date'];
    $users[$hn]['name'] = $a['ptname'];
    $users[$hn]['depart'][$depart] = $a['price'];
}
?>
<style>
    *{
        font-family: "TH SarabunPSK";
        font-size: 16px;
    }
    .chk_table{
        border-collapse: collapse;
    }
    .chk_table th,
    .chk_table td{
        padding: 3px;
        border: 1px solid black;
    }
</style>
<p><h3 style="font-size:24px;">ตรวจสุขภาพลูกจ้าง วันที่ 17-21 ตุลาคม 2565</h3></p>
<table class="chk_table">
    <tr>
        <td>#</td>
        <td>วันที่</td>
        <td>HN</td>
        <td>ชื่อ-สกุล</td>
        <td></td>
        <td>LAB</td>
        <td>XRAY</td>
    </tr>
<?php 
$i = 1; 
$sum_xray = 0;
$sum_lab = 0;
foreach ($users as $key => $value) {
    $hn = $key;
    
    $xray = (empty($value['depart']['XRAY'])) ? '-' : $value['depart']['XRAY'];
    $lab = (empty($value['depart']['PATHO'])) ? '-' : $value['depart']['PATHO'];

    $sum_xray += (float) $value['depart']['XRAY'];
    $sum_lab += (float) $value['depart']['PATHO'];
    ?>
    <tr>
        <td align="right"><?=$i;?></td>
        <td><?=$value['date'];?></td>
        <td><?=$hn;?></td>
        <td><?=$value['name'];?></td>
        <td><?=$value['guardian'];?></td>
        <td align="right"><?=$lab;?></td>
        <td align="right"><?=$xray;?></td>
    </tr>
    <?php
    $i++;
}
?>
    <tr>
        <td colspan="5">รวม (บาท)</td>
        <td><?=number_format($sum_lab, 2);?></td>
        <td><?=number_format($sum_xray, 2);?></td>
    </tr>
    <tr>
        <td colspan="5">รวมทั้งสิ้น (บาท)</td>
        <td align="right" colspan="2"><?=number_format(($sum_lab+$sum_xray), 2);?></td>
    </tr>
</table>