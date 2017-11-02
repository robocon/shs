<?php

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT a.`month`,a.`doctor`, c.`genname`, 
b.`drugcode`, SUM(b.`amount`) AS `amount`, c.`unit`, c.`packing` 
FROM ( 
    SELECT `row_id`, SUBSTRING(`date`, 1, 10) AS `date`, SUBSTRING(`date`, 1, 7) AS `month`, `doctor`, `stkcutdate`, `dr_cancle`
    FROM `dphardep` 
    WHERE `date` LIKE  '2560-10%' 
    AND `dr_cancle` IS NULL 
    AND `whokey` = 'DR' 
    AND `stkcutdate` IS NOT NULL 
 ) AS a 
LEFT JOIN (
    SELECT * FROM `ddrugrx` WHERE `date` LIKE '2560-10%' 
) AS b ON b.`idno` = a.`row_id` 
LEFT JOIN `druglst` AS c ON c.`drugcode` = b.`drugcode` 
WHERE b.`drugcode` = '5gavi' 
GROUP BY a.`month`, a.`doctor`, b.`drugcode` 
ORDER BY a.`month` ASC, a.`doctor` ASC, SUM(b.`amount`) DESC";

$db->select($sql);

$items = $db->get_items();

$new_lists = array();

foreach ($items as $key => $item) {

    $dr = $item['doctor'];
    $new_lists[$dr][] = $item;

}


foreach ($new_lists as $dr_name => $sub_items) {

    // หมอแต่ละคน top 20
    $i = 1;
    ?>
    <p><?=$dr_name;?></p>
    <table width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#ffffff">
        <tr>
            <th>#</th>
            <th width="50%">ชื่อสามัญ</th>
            <th>จำนวน</th>
            <th>หน่วยนับ</th>
        </tr>
    <?php

    foreach ($sub_items as $key => $item) {
        
        if( $i > 20 ){
            continue;
        }

        ?>
        <tr>
            <td><?=$i;?></td>
            <td><?=$item['genname'];?></td>
            <td><?=$item['amount'];?></td>
            <td><?=$item['unit'].' : '.$item['packing'];?></td>
        </tr>
        <?php

        $pre_dr = $item['doctor'];
        $i++;

    }

    ?>
    </table>
    <?php

}
?>

