<?php

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT b.`row_id`,b.`hn`,b.`ptname`,b.`thdatehn`,b.`organ`,b.`dx_mc_soldier`,b.`dr1_mc_soldier`,b.`dr2_mc_soldier`,b.`dr3_mc_soldier`,b.`rule`,
CONCAT(c.`address`,' ',c.`tambol`,' ',c.`ampur`,' ',c.`changwat`) AS `address`,
CONCAT(SUBSTRING(b.`thidate`,9,2),'-',SUBSTRING(b.`thidate`,6,2),'-',SUBSTRING(b.`thidate`,1,4)) AS `date`,
c.`idcard`
FROM 
(
    SELECT MAX(`row_id`) AS `opd_id`
    FROM `opd` 
    WHERE `thidate` >= '2558-10-01' AND `thidate` <= '2560-01-17' 
    AND (
        ( `organ` LIKE '%รับรอง%' AND `organ` LIKE '%งดเกณ%' )
        OR `toborow` LIKE 'EX30%' 
    )
    AND `dx_mc_soldier` IS NOT NULL 
    GROUP BY `hn`
) AS a 
LEFT JOIN `opd` AS b ON b.`row_id` = a.`opd_id` 
LEFT JOIN `opcard` AS c ON c.`hn` = b.`hn` 
ORDER BY b.`thdatehn` ASC";

$db->select($sql);

$items = $db->get_items();


?>
<table>
    <tr>
        <td>hn</td>
        <td>ptname</td>
        <td>organ</td>
        <td>dx_mc_soldier</td>
        <td>dr1_mc_soldier</td>
        <td>dr2_mc_soldier</td>
        <td>dr3_mc_soldier</td>
        <td>rule</td>
        <td>address</td>
        <td>date</td>
    </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['organ'];?></td>
            <td><?=$item['dx_mc_soldier'];?></td>
            <td><?=$item['dr1_mc_soldier'];?></td>
            <td><?=$item['dr2_mc_soldier'];?></td>
            <td><?=$item['dr3_mc_soldier'];?></td>
            <td><?=$item['rule'];?></td>
            <td><?=$item['address'];?></td>
            <td><?=$item['date'];?></td>
        </tr>
        <?php
    }
    ?>
</table>