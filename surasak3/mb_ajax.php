<?php 

require_once 'bootstrap.php';

$action = input_post('action');
if ($action === 'drugSearch') {

    $db = mysql::load();
    $drugName = input_post('drug_name');
    $sql ="SELECT `drugcode`,`genname`,`tradname`,`unit`,`salepri` 
    FROM `druglst` WHERE (
        `drugcode` LIKE '%$drugName%' 
        OR `tradname` LIKE '%$drugName%' 
        OR `genname` LIKE '%$drugName%' 
    ) 
     ";
    $db->select($sql);
    $items = $db->get_items();
    ?>
    <table class="w3-table w3-striped w3-border w3-hoverable">
        <tr>
            <th>ชื่อยา</th>
            <th>หน่วย</th>
            <th>ราคา</th>
        </tr>
    <?php
    foreach ($items as $key => $item) {
        ?>
        <tr class="drugSearchItem" data-drug="<?=$item['drugcode'];?>">
            <td><?=$item['genname'];?></td>
            <td><?=$item['unit'];?></td>
            <td><?=$item['salepri'];?></td>
        </tr>
        <?php
    }
    ?>
    </table>
    <?php
    exit;
}