<?php 
include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
$db->exec("SET NAMES TIS620");

$year = input_get('year');
$quarter = input_get('quarter');
$table = input_get('table');


// เตรียมข้อมูล opday
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_opday_in11`;");
$sql = "CREATE TEMPORARY TABLE `pre_opday_in11` 
SELECT `row_id`,`date`,`hn`,`ptname`,`age`,`diag`,`icd10`,`doctor`,`date_hn`,TRIM(SUBSTRING(`age`, 1, 2)) AS `shortage` 
FROM `opday` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `icd10` regexp 'E11' 
GROUP BY `hn` ";
$db->exec($sql); 

// เตรียมข้อมูล drugrx
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_drugrx_in11`;");
$sql = "CREATE TEMPORARY TABLE `pre_drugrx_in11` 
SELECT `row_id`,`hn`,`drugcode`,`amount`,`date_hn` 
FROM `drugrx` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` LIKE '1EUGL-C%' 
GROUP BY `hn` ";
$test = $db->exec($sql); 

// เอาสองตัวบนมารวมกัน จะได้ ผู้ป่วยที่ได้รับยา gibenclamide แบบที่ยังไม่ได้แบ่งตามอายุ
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_user_in11`;");
$sql = "CREATE TEMPORARY TABLE `tmp_user_in11` 
SELECT a.*,CONCAT( (SUBSTRING(a.`date`, 1, 4) - 543), SUBSTRING(a.`date`,5,6) ) AS `date_en`,b.`drugcode`,b.`amount` 
FROM `pre_opday_in11` AS a 
LEFT JOIN `pre_drugrx_in11` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`hn` IS NOT NULL "; 
$db->exec($sql); 



// ตัวหาร
if( $table == 'a' ){


    // A1
    $sql = "SELECT * 
    FROM `tmp_user_in11` 
    WHERE `shortage` > 65 ;";
    $db->select($sql);
    $pre_a1 = $db->get_items();

    // เตรียมหา A2 จากผลแลปครั้งล่าสุด
    $sql = "SELECT * 
    FROM (  
        SELECT *  
        FROM `tmp_user_in11` 
        WHERE `shortage` <= 65 
    ) AS a 
    LEFT JOIN ( 
        SELECT * 
        FROM `lab` 
        WHERE `year` = '$year' AND `quarter` = '$quarter' 
        AND ( `egfr` < 60 AND `egfr` > 0 ) 
    ) AS b ON b.`hn` = a.`hn` 
    WHERE b.`id` IS NOT NULL 
    AND ( 
        TIMESTAMPDIFF(MONTH,SUBSTRING(b.`orderdate`,1,10),a.`date_en`) >= 0 
        AND TIMESTAMPDIFF(MONTH,SUBSTRING(b.`orderdate`,1,10),a.`date_en`) <= 6 
    )";
    $db->select($sql); 
    $pre_a2 = $db->get_items();

    $items = array_merge_recursive($pre_a1, $pre_a2);


}elseif( $table == 'b' ){
    $sql = "SELECT * FROM `tmp_user_in11` ";
    $db->select($sql);
    $items = $db->get_items();
}


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

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>ชื่อผู้ป่วย</th>
        <th>อายุ</th>
        <th>eGFR</th>
        <th>Diag</th>
        <th>ICD-10</th>
        <th>Drug code</th>
        <th>จำนวน</th>
        <th>แพทย์</th>
    </tr>
    <?php 
$i = 1;
foreach ($items as $key => $item) {
    ?>
    <tr>
        <td><?=$i;?></td>
        <td><?=$item['date'];?></td>
        <td><?=$item['hn'];?></td>
        <td><?=$item['ptname'];?></td>
        <td><?=$item['age'];?></td>
        <td><?=$item['egfr'];?></td>
        <td><?=$item['diag'];?></td>
        <td><?=$item['icd10'];?></td>
        <td><?=$item['drugcode'];?></td>
        <td><?=$item['amount'];?></td>
        <td><?=$item['doctor'];?></td>
    </tr>
    <?php
    $i++;
}
?>
</table>