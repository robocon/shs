<?php

include 'bootstrap.php';
$db = Mysql::load();


$sql = "SELECT `ptname`,`hn`,`an`,`diag`,`age`,`days`, SUBSTRING(`date`, 1, 4) AS `year`
FROM `ipcard` 
WHERE `date` >= '2558-10-01' AND `date` <= '2559-09-30' 
AND `age` IS NOT NULL 
ORDER BY SUBSTRING(`date`, 1, 4) ASC;";
$db->select($sql);
$items = $db->get_items();

?>
<table>
    <thead>
        <tr>
            <th>#</th>
            <th>ชื่อ</th>
            <th>HN</th>
            <th>AN</th>
            <th>Diag</th>
            <th>วันนอน</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $i = 1;
        foreach ($items as $key => $item) {

            $match = preg_match('/(\d+)/', $item['age'], $matchs);
            if( $match > 0 && $matchs['1'] <= 14 ){

                ?>
                <tr>
                    <td><?=$i;?></td>
                    <td><?=$item['ptname'];?></td>
                    <td><?=$item['hn'];?></td>
                    <td><?=$item['an'];?></td>
                    <td><?=$item['diag'];?></td>
                    <td><?=$item['days'];?></td>
                </tr>
                <?php
                ++$i;
            }

        }
        ?>
    </tbody>
</table>