<?php
include 'bootstrap.php';
$checkup_date_code = '170509';

$db = Mysql::load();

$sql = "CREATE TEMPORARY TABLE `temp_depart` 
SELECT `row_id`,`hn`,`tvn`,`depart`,`paid` 
FROM `depart` 
WHERE `date` LIKE '2560-05-11%' AND `cashok` = 'SSOCHECKUP60' ";
$db->select($sql);

$sql = "CREATE TEMPORARY TABLE `temp_patdata` 
SELECT b.`idno`,b.`hn`,b.`code`,b.`detail`,b.`price` 
FROM `temp_depart` AS a 
LEFT JOIN `patdata` AS b ON b.`idno` = a.`row_id` 
WHERE a.`depart` = 'PATHO'";
$db->select($sql);

$sql = "SELECT a.`HN`,a.`name`,a.`surname`,a.`exam_no`
#,b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth`,b.`ptright`
,c.`vn`
FROM `opcardchk` AS a 
#LEFT JOIN `opcard` AS b ON b.`hn` = a.`HN` 
LEFT JOIN ( 
    SELECT `hn`,`vn` FROM `opday` WHERE `thidate` LIKE '2560-05-11%' 
) AS c ON c.`hn` = a.`HN` 
WHERE a.`part` = 'ÍÑÊÊÑÁªÑ­60' 
AND c.`vn` IS NOT NULL 
GROUP BY a.`HN` ";
// dump($sql);

$db->select($sql);
$items = $db->get_items();
// dump($items);

?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>ª×èÍ-Ê¡ØÅ</th>
            <th>HN</th>
            <th>ÃÇÁ¤ª¨.</th>
            <th>CBC</th>
            <th>UA</th>
            <th>FBS</th>
            <th>CR</th>
            <th>CHOL</th>
            <th>HDL</th>
            <th>HBSAG</th>
            <th>FOBT</th>
            <th>X-Ray</th>
        </tr>
    </thead>
    <tbody>
    <?php
    $i = 1;
    foreach ($items as $key => $item) { 

        $exam_nummber = $item['exam_no'];
        $hn = $item['HN'];
        $vn = $item['vn'];

        $sql = "SELECT `row_id`,SUM(`paid`) AS `paid` 
        FROM `temp_depart` 
        WHERE `hn` = '$hn' 
        AND `tvn` = '$vn' ";
        $db->select($sql);
        $depart = $db->get_item();
        
        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['name'].' '.$item['surname'];?></td>
            <td><?=$hn;?></td>
            <td><?=$depart['paid'];?></td>
            <?php
            $idno = $depart['row_id'];
            $sql = "SELECT * 
            FROM `temp_patdata` 
            WHERE `hn` = '$hn' ";
            $db->select($sql);
            $patdata = $db->get_items();
            dump($patdata);
            ?>
        </tr>
        <?php
        $i++;
    }
    ?>
    </tbody>
</table>