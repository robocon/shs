<?php

include 'bootstrap.php';

$db = Mysql::load();

$sql = "SELECT a.`hn` , a.`ptname` , c.`rule` , b.`changwat` , SUBSTRING( a.`thidate` , 1, 7 ) AS  `orderth` 
FROM  `opday` AS a
LEFT JOIN  `opcard` AS b ON a.`hn` = b.`hn` 
LEFT JOIN  `opd` AS c ON c.`thdatehn` = a.`thdatehn` 
WHERE a.`thidate` >=  '2559-10-01' AND a.`thidate` <=  '2560-02-20' AND c.`rule` !=  '' AND a.`toborow` 
LIKE  'EX30%'
GROUP BY a.`hn` 
LIMIT 500";
$db->select($sql);
$items = $db->get_items();

$new_items = array();
foreach ($items as $key => $item) {
    $item['rule'] = preg_replace(array('/\s/'),array(''), $item['rule']);
    $invalid_txt = array('ข้อ(๒)','ข้อ๒','ข้อ2','ข้อ','ตามกฏกระทรวงฉบับที่๗๔พ.ศ.๒๕๔๐','ตามกฏกระทรวงฉบับที่74(พ.ศ.2540)','กฏกระทรวงฉบับที่๗๖พ.ศ.๒๕๔๐');
    $item['rule'] = str_replace($invalid_txt, '', $item['rule']);
    $new_items[] = $item;
}

?>
<table>
    <tr>
        <td></td>
    </tr>
    <?php
    foreach ($new_items as $key => $item) {
        ?>
        <tr>
            <td><?=$item['hn'];?></td>
            <td><?=$item['ptname'];?></td>
            <td><?=$item['rule'];?></td>
            <td><?=$item['changwat'];?></td>
            <td><?=$item['orderth'];?></td>
        </tr>
        <?php
    }
    ?>
</table>