<?php

/**
 * �Ѿഷ orderhead ��� orderdetail
 * �������� clinicalinfo �Ѿഷ����է�
 */
include 'bootstrap.php';
$db = Mysql::load();

// opcardchk
// out_result_chkup 
// ���¡��ҡ����˹����
$sql = "SELECT *, `HN` AS `hn` 
FROM `out_result_chkup` 
WHERE `part` = '��硫��������61' ";


$db->select($sql);

$items = $db->get_items();
foreach ($items as $key => $item) {

    $hn = $item['hn'];
    echo $hn."<br>";

    $sql_orderhead = "UPDATE `orderhead` SET 
    `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�61' 
    WHERE `hn` = '$hn' AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�60' ";
    $update_head = $db->update($sql_orderhead);
    dump($update_head);

    $sql_resulthead = "UPDATE `resulthead` SET 
    `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�61' 
    WHERE `hn` = '$hn' AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�60' ";
    $update_detail = $db->update($sql_resulthead);
    dump($update_detail);

    echo "<hr>";

    // exit;
}