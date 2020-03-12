<?php 
include 'bootstrap.php';

$db = Mysql::load($rdu_configs);
// $db->exec("SET NAMES TIS620");

// $year = input_get('year');
// $quarter = input_get('quarter');
$table = input_get('table');
$date = input_get('date');

$minDate = input_get('minDate');
$maxDate = input_get('maxDate');

// ����������� opday
$sql = "CREATE TEMPORARY TABLE `pre_opday_in11` 
SELECT `row_id`,`date`,`ptname`,`hn`,`age`,`icd10`,`date_hn`,TRIM(SUBSTRING(`age`, 1, 2)) AS `shortage`
FROM `opday` 
WHERE `date` LIKE '$date%' 
AND `icd10` regexp 'E11' 
GROUP BY `hn` ;";
$db->exec($sql); 

// ����������� drugrx
$sql = "CREATE TEMPORARY TABLE `pre_drugrx_in11` 
SELECT `row_id`,`hn`,`drugcode`,`amount`,`date_hn` 
FROM `drugrx` 
WHERE `date` LIKE '$date%' 
AND `drugcode` LIKE '1EUGL-C%' 
GROUP BY `hn` ;";
$test = $db->exec($sql); 

// ����ͧ��Ǻ�������ѹ ���� �����·�����Ѻ�� gibenclamide Ẻ����ѧ������觵������
$sql = "CREATE TEMPORARY TABLE `tmp_user_in11` 
SELECT a.*,CONCAT( (SUBSTRING(a.`date`, 1, 4) - 543), SUBSTRING(a.`date`,5,6) ) AS `date_en`,b.`drugcode` 
FROM `pre_opday_in11` AS a 
LEFT JOIN `pre_drugrx_in11` AS b ON b.`date_hn` = a.`date_hn` 
WHERE b.`hn` IS NOT NULL ;"; 
$db->exec($sql); 



// ������
if( $table == 'a' ){


    // A1
    $sql = "SELECT * FROM `tmp_user_in11` WHERE `shortage` > 65 ;";
    $db->select($sql);
    $pre_a1 = $db->get_items();

    // ������� A2 �ҡ���Ż��������ش
    $sql = "SELECT a.*,b.* 
    FROM (  
        SELECT * 
        FROM `tmp_user_in11` 
        WHERE `shortage` <= 65 
    ) AS a 
    LEFT JOIN ( 
        SELECT * 
        FROM `lab` 
        WHERE ( `orderdate` >= '$minDate 00:00:00' AND `orderdate` <= '$maxDate 23:59:59' )
        AND ( `egfr` < 60 AND `egfr` > 0 ) 
        GROUP BY `hn`
    ) AS b ON b.`hn` = a.`hn` 
    WHERE b.`id` IS NOT NULL ; ";
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
/* ���ҧ */
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
    <h3><u>��Ǫ���Ѵ��� 11 </u></h3> 
</div>
<table class="chk_table">
    <tr>
        <th>#</th>
        <th>Date</th>
        <th>HN</th>
        <th>���ͼ�����</th>
        <th>����</th>
        <th>eGFR</th>
        <th>Diag</th>
        <th>ICD-10</th>
        <th>Drug code</th>
        <th>�ӹǹ</th>
        <th>ᾷ��</th>
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
        <td><?=$item['shortage'];?></td>
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

<?php 
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_opday_in11`;");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `pre_drugrx_in11`;");
$db->exec("DROP TEMPORARY TABLE IF EXISTS `tmp_user_in11`;");