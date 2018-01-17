<?php
include 'bootstrap.php';

if( empty($_SESSION['sOfficer']) ){ 
    echo 'เกิดข้อผิดพลาดบางประการ กรุณา<a href="login_page.php">เข้าสู่ระบบ</a>อีกครั้ง';
    exit;
}

$db = Mysql::load();

include 'rg_menu.php';

$page = input('page');
$date_th = input('date_th');

$sql = "SELECT SUBSTRING(a.`thidate`,1,10) AS `pt_date` , a.`hn`, a.`vn`, a.`ptname`, a.`idcard`, 
CONCAT(b.`address`,' ต.',b.`tambol`,' อ.',b.`ampur`,' จ.',b.`changwat`) AS `pt_address`
FROM `opday2` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`thidate` LIKE '$date_th%' 
AND a.`toborow` LIKE 'ex30%' ";
$db->select($sql);

$items = $db->get_items();

?>
<h3>รายชื่อผู้ที่มาขอใบรับรองงดเว้นเกณฑ์ทหาร</h3>
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff" width="100%">
    <tr>
        <th>ลำดับ</th>
        <th>ชื่อ-สกุล</th>
        <th>เลขบัตรประชาชน</th>
        <!--<th>โรคที่ตรวจพบ</th>
        <th>ตามกฏทรวงฉบับที่ ๗๔ พ.ศ. ๒๕๔๐<br>
และฉบับแก้ไขที่ ๗๖ พ.ศ. ๒๕๕๕</th>
        <th>คณะแพทย์ผู้ตรวจ</th>-->
        <th>ภูมิลำเนาทหาร</th>
        <th>ว.ด.ป. ที่รับการตรวจ</th>
    </tr>
    <?php
    $i = 0;
    foreach ($items as $key => $item) {
        ++$i;
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['idcard'];?></td>
            <td><?=$item['pt_address'];?></td>
            <td><?=$item['pt_date'];?></td>
        </tr>
        <?php

    }
    ?>
</table>