<?php

include 'bootstrap.php';
$db = Mysql::load();

$sql = "CREATE TEMPORARY TABLE `depart_main` 
SELECT a.`hn`,a.`ptname`,a.`ptright`,a.`depart`,a.`lab`,CONCAT('170312',a.`lab`) AS `labnumber` 
,b.`idcard`,b.`address`,b.`tambol`,b.`ampur`,b.`changwat`,b.`phone`
FROM `depart` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`cashok` = 'SSOCHKUP60' 
AND ( a.`depart` = 'PATHO' OR a.`depart` = 'XRAY' ) 
AND a.`ptright` NOT LIKE 'R03%' 
ORDER BY a.`hn`; ";
// dump($sql);
$db->select($sql);

$sql = "SELECT * 
FROM `depart_main` 
WHERE `lab` IS NOT NULL 
AND `depart` = 'PATHO' ; ";
$db->select($sql);
$items = $db->get_items();

$sql = "SELECT * 
FROM `depart_main` 
WHERE `depart` = 'XRAY'; ";
// dump($sql);
$db->select($sql);
$xray_items = $db->get_items();
$xray_list = array();
foreach ($xray_items as $key => $xray_item) {
    $code = $xray_item['hn'];
    $xray_list[] = $code;
}
// dump($xray_items);
// exit;

$sql = "CREATE TEMPORARY TABLE `orderdetail_tmp` 
SELECT * FROM `orderdetail` WHERE `labnumber` LIKE '170312%' ";
$db->select($sql);

?>
<table border="1" cellspacing="0" cellpadding="3"  bordercolor="#000000" style="border-collapse:collapse">
    <thead>
        <tr>
            <th>#</th>
            <th>HN</th>
            <th>ชื่อสกุล</th>
            <th>เลขบัตรปชช</th>
            <th>ที่อยู่</th>
            <th>CBC</th>
            <th>UA</th>
            <th>BS<br>(น้ำตาล)</th>
            <th>CR<br>(ไต)</th>
            <!-- 
            <th>CHOL</th>
            <th>HDL</th>
            -->
            <th>CHOL & HDL<br>(ไขมัน)</th>
            <th>HBSAG<br>(ตับอักเสบ)</th>
            
            <th>PAP</th>
            <th>STOCB</th>
            
            <th>X-Ray</th>
        </tr>
    </thead>
    <tbody>
        <?php 
        $i = 1;
        foreach ($items as $key => $item) {
            // dump($item);
            $labnumber = $item['labnumber'];
            $hn = $item['hn'];
            $sql = "SELECT `labcode` FROM `orderdetail_tmp` WHERE `labnumber` = '$labnumber' ";
            $db->select($sql);
            $lab_items = $db->get_items();
            // dump($item);

            $lab_lists = array();
            foreach ($lab_items as $key => $lab_item) {
                $lab_lists[] = $lab_item['labcode'];
            }
            // dump($item['hn']);
            // dump($lab_lists);

            ?>
            <tr>
                <td><?=$i;?></td>
                <td><?=$item['hn'];?></td>
                <td><?=$item['ptname'];?></td>
                <td><?=$item['idcard'];?></td>
                <td><?=$item['address'].' ต.'.$item['tambol'].' อ.'.$item['ampur'].' จ.'.$item['changwat'].' โทร.'.$item['phone'];?></td>
                <td align="center"><?=( in_array('CBC', $lab_lists) === true ? "&#10004;" : '' );?></td>
                <td align="center"><?=( in_array('UA', $lab_lists) === true ? "&#10004;" : '' );?></td>
                <td align="center"><?=( in_array('BS', $lab_lists) === true ? "&#10004;" : '' );?></td>
                <td align="center"><?=( in_array('CR', $lab_lists) === true ? "&#10004;" : '' );?></td>
                <!-- 
                <td align="center"><?=( ( in_array('CHOL', $lab_lists) === true OR in_array('LIPID', $lab_lists) === true ) ? "&#10004;" : '' );?></td>
                <td align="center"><?=( ( in_array('HDL', $lab_lists) === true OR in_array('LIPID', $lab_lists) === true ) ? "&#10004;" : '' );?></td>
                -->
                <td align="center"><?=( in_array('LIPID', $lab_lists) === true ? "&#10004;" : '' );?></td>
                <td align="center"><?=( in_array('HBSAG', $lab_lists) === true ? "&#10004;" : '' );?></td>
                
                <td align="center"><?=( in_array('PAP', $lab_lists) === true ? "&#10004;" : '' );?></td>
                <td align="center"><?=( in_array('STOCB', $lab_lists) === true ? "&#10004;" : '' );?></td>
                
                <td align="center"><?=( in_array($hn, $xray_list) === true ? "&#10004;" : '' );?></td>
            </tr>
            <?php 
            $i++;
            // echo "<hr>";
        }
        ?>
    </tbody>
</table>