<?php 

include 'bootstrap.php';

$db = Mysql::load();

/**
 * ��63 �ѹ�������ͧ�ѹ
 * �ͺ���Ǩ63 �Ѻ �ͺ���Ǩ63_02
 */
$sql = "SELECT * 
FROM `log_opcardchk` 
WHERE `log_part` = '�ͺ���Ǩ63' 
GROUP BY `log_hn` 
ORDER BY `log_hn` ";

$db->select($sql);
$items = $db->get_items();

foreach ($items as $key => $value) {

    $hn = $value['log_hn'];
    $billno = $value['bill'];
    
    $logQL = "UPDATE `opacc` SET `credit` = '��Ǩ�آ�Ҿ', billno = '357/$billno' WHERE `date` LIKE '2562-12-22%' AND `hn` = '$hn' ";
    $db->update($logQL);

    echo "<hr>";
}

exit;