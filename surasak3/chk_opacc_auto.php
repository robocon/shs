<?php 

include 'bootstrap.php';

$db = Mysql::load();

/**
 * ��63 �ѹ�������ͧ�ѹ
 * �ͺ���Ǩ63 �Ѻ �ͺ���Ǩ63_02
 */


$sql = "SELECT * FROM `log_opcardchk` WHERE `log_part` = '�ͺ���Ǩ 64' ORDER BY `log_id` ASC ";
$db->select($sql);
$items = $db->get_items();

$Thidate2 =(date("Y")+543).date("-m-d H:i:s");
$depart = "OTHER";
$detail = "��Һ�ԡ�õ�Ǩ�آ�Ҿ���Ǩ";
$price = 880.00;
$paid  = 880.00;
$idname='�ҧ�ǧ��� �㨻ԧ';
$credit="��Ǩ�آ�Ҿ���Ǩ";

foreach ($items as $key => $value) {

    $hn = $value['log_hn'];
    $logId = $value['log_id'];
    $billno = $value['bill'];
    
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
    $opaccId = $db->get_last_id();
    dump($insert);

    
    $logQL = "UPDATE `log_opcardchk` SET 
    `opacc_id` = '$opaccId' 
    WHERE `log_id` = '$logId' ";
    $db->update($logQL);

    echo "<hr>";
}

exit;