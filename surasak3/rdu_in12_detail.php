<?php 
include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

// $year = input_get('year');
// $quarter = input_get('quarter');
$table = input_get('table');
$date = input_get('date');
$maxDate = input_get('maxDate');
$minDate = input_get('minDate');

$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_in12`");
$sql = "CREATE TEMPORARY TABLE `tmp_in12` 
SELECT a.`row_id`,a.`hn`,a.`date_hn`,a.`icd10`,b.`egfr`,a.`ptname`,a.`age`,a.`diag` 
FROM ( 
	SELECT * 
    FROM `opday` 
    WHERE `date` LIKE '$date%' 
    #`year` = '$year' AND `quarter` = '$quarter' 
    AND ( `icd10` regexp 'E11' OR `icd10` regexp 'N18[4|5]' ) GROUP BY `hn`
) AS a 
LEFT JOIN ( 
	SELECT * 
    FROM `lab` 
    WHERE ( `orderdate` <= '$maxDate-01' AND `orderdate` >= '$minDate' ) 
    #`year` = '$year' 
    AND `egfr` > 30 GROUP BY `hn`
) AS b ON b.`hn` = a.`hn` 
WHERE b.`autonumber` IS NOT NULL ";
$db->exec($sql);

if( $table == 'b' ){
    // Table B
    $sql = "SELECT a.* FROM `tmp_in12` 
    FROM `tmp_in12` AS a 
    LEFT JOIN ( 
        SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`
        FROM `drugrx` 
        WHERE `date` LIKE '$date%' 
        #`year` = '$year' 
        AND `drugcode` IN ( 
'1ACTOS*',
'1AMAR',
'1AVAN*',
'1DIAM-MR',
'1EUGL-C',
'1MET500-C
'1METF',
'1MINID',
'2HUMUN',
'2HUMUR',
'2HUMUR1',
'1MET850-C',
'1JANU',
'1UTMO',
'2LANTP',
'2GENN',
'2GENR',
'2GENM30',
'1GLUXR',
'2HN70_30',
'1GALV',
'1MINID-C',
'2HRPE',
'1DIAMR_60',
'1GLUB',
'1AMAR-C',
'1DIAM30-C',
'1AMAR-N',
'1TRAJ',
'1AMAR-NN',
'1AMAR-NNN',
'1FORX',
'1OSEN',
'1GLUX1000',
'2WIN30_70',
'1JARD',
'2WIN_N',
'2WIN_R',
'1MINID-N',
'1MET750',
'2WIN_N_1iu',
'2WIN_R_1iu',
'1METF500-N',
'1NOVO',
'2TOUJEO',
'1CANA300',
'1ZEMI',
'2VICTO',
'1GLYX',
'2INSU_R',
'2INSU_N',
'1VILMET',
'2DULA'
        ) 
        GROUP BY `hn` 
    ) AS b ON b.`hn`=a.`hn`
    WHERE b.`row_id` IS NOT NULL ";
    $db->select($sql);
    $items = $db->get_items();

}elseif( $table == 'a' ){

    // Table A
    $sql = "SELECT a.*,b.*
    FROM tmp_in12 AS a 
    LEFT JOIN ( 
        SELECT `row_id`,`date`,`hn`,`drugcode`,`date_hn`
        FROM `drugrx` 
        WHERE `date` LIKE '$date%' 
        #`year` = '$year' 
        AND `drugcode` IN ( 
            '1MET500-C', 
            '1METF', 
            '1MET850-C', 
            '1GLUXR', 
            '1GLUX1000', 
            '1MET750', 
            '1METF500-N', 
            '1VILMET'
        ) 
        GROUP BY `hn` 
    ) AS b  ON b.`hn` = a.`hn` 
    WHERE b.`row_id` IS NOT NULL ";
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