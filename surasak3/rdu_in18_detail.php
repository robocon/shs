<?php 
include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

$year = input_get('year');
$quarter = input_get('quarter');
$table = input_get('table');


$sql = "CREATE TEMPORARY TABLE `tmp_opday_in18` 
SELECT * 
FROM `opday` 
WHERE `year` = '$year' AND `quarter` = '$quarter'  
AND `age` <> '' 
AND (
	( TRIM(SUBSTRING(`age`,1,2)) >= 0 AND TRIM(SUBSTRING(`age`,1,2)) < 18 )
)
AND ( 
    `icd10` IN ( 'J00', 'J000' ) 
    OR `icd10` regexp 'J01([0-4]|[8-9])' 
    OR `icd10` IN ( 'J020', 'J029' ) 
    OR `icd10` IN ( 'J030', 'J038', 'J039' ) 
    OR `icd10` IN ( 'J040', 'J041', 'J042' ) 
    OR `icd10` IN ( 'J050', 'J051' ) 
    OR `icd10` IN ( 'J060', 'J068', 'J069' ) 
    OR `icd10` IN ( 'J101', 'J111' ) 
    OR `icd10` regexp 'J(20[0-9])' 
    OR `icd10` IN ( 'J210', 'J218', 'J219' ) 
    OR `icd10` IN ( 'H650', 'H651', 'H659' ) 
    OR `icd10` IN ( 'H660', 'H664', 'H669' ) 
    OR `icd10` IN ( 'H670', 'H671', 'H678' ) 
    OR `icd10` IN ( 'H720', 'H721', 'H722' ) 
    OR `icd10` IN ( 'H728', 'H729' ) 
) 
GROUP BY `date_hn` ";
$db->exec($sql);


$sql = "CREATE TEMPORARY TABLE `tmp_drugrx_in18` 
SELECT * 
FROM `drugrx` 
WHERE `year` = '$year' AND `quarter` = '$quarter' 
AND `drugcode` IN ( 
    '1AERI*', 
    '1CLAR-C', 
    '5ZYR', 
    '1XYZA', 
    '1ZYRT-C', 
    '1TELF180', 
    '5AERI', 
    '1TELF-C', 
    '1ZYRT-N', 
    '1RUPA', 
    '5ZYR-N', 
    '1XYZA-N', 

    '1CETI', 
    '1BILA', 
    '5AERI-C' 
);";
$db->exec($sql);

if( $table == 'a' ){

    $sql = "SELECT a.*,b.`drugcode`,b.`amount` 
    FROM `tmp_opday_in18` AS a 
    LEFT JOIN `tmp_drugrx_in18` AS b ON b.`date_hn` = a.`date_hn` 
    WHERE b.`row_id` IS NOT NULL";
    $db->select($sql);
    $items = $db->get_items();

}elseif( $table == 'b' ){

    $sql = "SELECT * FROM `tmp_opday_in18`";
    $db->select($sql);
    $items = $db->get_items();

}

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_opday_in18`");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_drugrx_in18`");
?>

<style>
/* ตาราง */
body, button{
    font-family: "TH Sarabun New","TH SarabunPSK" ;
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