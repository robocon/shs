<?php

/**
 * ÍÑ¾à´· orderhead áÅÐ orderdetail
 * ãËé¢éÍÁÙÅ clinicalinfo ÍÑ¾à´·µÒÁ»Õ§º
 */
include 'bootstrap.php';
$db = Mysql::load();

// opcardchk
// out_result_chkup 
// àÃÕÂ¡ãªé¨Ò¡µÑÇäË¹¡çä´é
$sql = "SELECT *, `HN` AS `hn` 
FROM `out_result_chkup` 
WHERE `part` = 'àÍç¡«ìµÃéÒàÇÅÙ61' ";


$db->select($sql);

$items = $db->get_items();
foreach ($items as $key => $item) {

    $hn = $item['hn'];
    echo $hn."<br>";

    $sql_orderhead = "UPDATE `orderhead` SET 
    `clinicalinfo` = 'µÃÇ¨ÊØ¢ÀÒ¾»ÃÐ¨Ó»Õ61' 
    WHERE `hn` = '$hn' AND `clinicalinfo` = 'µÃÇ¨ÊØ¢ÀÒ¾»ÃÐ¨Ó»Õ60' ";
    $update_head = $db->update($sql_orderhead);
    dump($update_head);

    $sql_resulthead = "UPDATE `resulthead` SET 
    `clinicalinfo` = 'µÃÇ¨ÊØ¢ÀÒ¾»ÃÐ¨Ó»Õ61' 
    WHERE `hn` = '$hn' AND `clinicalinfo` = 'µÃÇ¨ÊØ¢ÀÒ¾»ÃÐ¨Ó»Õ60' ";
    $update_detail = $db->update($sql_resulthead);
    dump($update_detail);

    echo "<hr>";

    // exit;
}