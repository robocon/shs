<?php 

include 'bootstrap.php';

$db = Mysql::load();

/**
 * ��63 �ѹ�������ͧ�ѹ
 */
$sql = "SELECT * 
FROM `log_opcardchk` 
WHERE `log_part` = '�ͺ���Ǩ63' 
GROUP BY `log_hn` 
ORDER BY `log_id` ";
dump($sql);
$db->select($sql);
$items = $db->get_items();

$Thidate2 =(date("Y")+543).date("-m-d H:i:s");
$depart = "OTHER";
$detail = "��Һ�ԡ�õ�Ǩ�آ�Ҿ���Ǩ";
$price = 880;
$paid  = 880;
$idname='�ҧ�ǧ��� �㨻ԧ';
$credit="�Թʴ";

$billno = '';

foreach ($items as $key => $value) {

    $hn = $value['log_hn'];
    
    $sqlOpacc = "INSERT INTO `opacc` ( 
        `date` , `txdate` , `hn` , `depart` , `detail` , 
        `price` , `paid` , `idname` , `credit` , `ptright` , 
        `credit_detail` , `billno`
    ) VALUES ( 
        '$Thidate2', '$Thidate2', '$hn', '$depart', '$detail', 
        '$price', '$paid', '$idname',  '$credit', 'R01 �Թʴ', 
        '', '$billno'
    );";
    dump($sqlOpacc);
    $insert = $db->insert($sqlOpacc);
    dump($insert);
    echo "<hr>";
}

exit;