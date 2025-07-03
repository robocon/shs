<?php 
include 'bootstrap.php';

$db = Mysql::load();
$db->exec("SET NAMES UTF8");

// $year = input_get('year');
// $quarter = input_get('quarter');
$table = input_get('table');
$date = input_get('date');

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in10`");
$sql = "CREATE TEMPORARY TABLE `tmp_opday_in10` (
`row_id` INT(11) NOT NULL,
`date` VARCHAR(255) CHARACTER SET utf8 NULL,
`hn` VARCHAR(255) CHARACTER SET utf8 NULL,
`ptname` VARCHAR(255) CHARACTER SET utf8 NULL,
`age` VARCHAR(255) CHARACTER SET utf8 NULL,
`diag` VARCHAR(255) CHARACTER SET utf8 NULL,
`icd10` VARCHAR(255) CHARACTER SET utf8 NULL,
`doctor` VARCHAR(255) CHARACTER SET utf8 NULL,
`date_hn` VARCHAR(255) CHARACTER SET utf8 NULL,
KEY `date_hn` (`date_hn`),
KEY `drugcode` (`drugcode`)
)
SELECT `row_id`,`date`,`hn`,`ptname`,`age`,`diag`,`icd10`,`doctor`,`date_hn` 
FROM `rdu_opday` 
WHERE `date` LIKE '$date%' 
AND `icd10` regexp 'I10' ;";
$test = $db->exec($sql);

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in10`");
$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in10` 
(
`row_id` INT(11) NOT NULL,
`date` VARCHAR(255) CHARACTER SET utf8 NULL,
`hn` VARCHAR(255) CHARACTER SET utf8 NULL,
`drugcode` VARCHAR(255) CHARACTER SET utf8 NULL,
`thidatecode` VARCHAR(255) CHARACTER SET utf8 NULL,
`date_hn` VARCHAR(255) CHARACTER SET utf8 NULL,
KEY `date_hn` (`date_hn`),
KEY `drugcode` (`drugcode`)
)
SELECT `row_id`,`date`,`hn`,`drugcode`,`amount`, CONCAT(SUBSTRING(`date`,1,10),`hn`,TRIM(`drugcode`)) AS `thidatecode`,`date_hn`
FROM `rdu_drugrx` 
WHERE `date` LIKE '$date%' 
AND `drugcode` IN ( 
'1RENI5-C',
'1ENAL5',
'1COVE5',
'1ENAL20',
'1TANZ',
'1LOSAR100',
'1EDAR',
'1CODI160-C',
'1ENT100', 
'1EXFO-C'
) GROUP BY `thidatecode` ORDER BY `hn` ; "; 
$db->exec($sql); 

if( $table == 'a' ){

    $sql = "SELECT b.`date`,b.`hn`,b.`ptname`,b.`age`,b.`diag`,b.`icd10`,b.`doctor`,a.`drugcode`,a.`amount` 
    FROM (

        SELECT `hn`,COUNT(`hn`) as `row`,'1' as `hn_row`,`date_hn`,`drugcode`,`amount`
        FROM `tmp_drugrx_in10` 
        GROUP BY `thidatecode` 
        HAVING COUNT(`hn`) >= 2

    ) AS a 
    LEFT JOIN `tmp_opday_in10` AS b ON b.`date_hn` = a.`date_hn` 
    WHERE b.`row_id` IS NOT NULL 
    ORDER BY b.`hn`;";

}elseif( $table == 'b' ){
    $sql = "SELECT b.`date`,b.`hn`,b.`ptname`,b.`age`,b.`diag`,b.`icd10`,b.`doctor`,a.`drugcode`,a.`amount`
    FROM (

        SELECT `hn`,COUNT(`hn`) as `row`,'1' as `hn_row`,`date_hn`,`drugcode`,`amount`
        FROM `tmp_drugrx_in10` 
        GROUP BY `thidatecode` 

    ) AS a 
    LEFT JOIN `tmp_opday_in10` AS b ON b.`date_hn` = a.`date_hn` 
    WHERE b.`row_id` IS NOT NULL ;";
}


$db->select($sql);
$items = $db->get_items();


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

<?php
if( $table == 'a' ){ 
    ?>
    <h3><u>ตัวชี้วัดที่ 10 (ไตรมาส <?=$quarter;?>)</u> ตัวตั้ง จำนวน visit ผู้ป่วยความดันเลือดสูงที่ได้รับการสั่งใช้ยากลุ่ม RAS blockage ได้แก่ ACEIs+ARBs หรือ ACEIs+Renin inhibitor หรือ ARBs+Renin inhibitor &ge; 2 ชนิด</h3>
    <?php
}elseif( $table == 'b' ){
    ?>
    <h3><u>ตัวชี้วัดที่ 10 (ไตรมาส <?=$quarter;?>)</u> ตัวตั้ง จำนวน visit ผู้ป่วยความดันเลือดสูงที่ได้รับการสั่งใช้ยากลุ่ม RAS blockage อย่างน้อย 1 ชนิด</h3>
    <?php
}
?>

 

<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>ชื่อผู้ป่วย</th>
        <th>อายุ</th>
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