<?php 
require_once 'bootstrap.php';

$db = Mysql::load();

/**
 * ��˹���͡ VN ������͹����� ����ա���͡ AN �����ʴ�����¡��ԡ Admit
 */
$an = input('an');
$hn = input_get('hn');
$dateTh = (date('Y')+543).date('-m-d');

$sql = "SELECT * 
FROM `ipcard` 
WHERE `hn` = '$hn' 
AND `date` LIKE '$dateTh%' ";
$db->select($sql);
$item = $db->get_item();

if( $item['bedcode'] === NULL ){
    $sql = "UPDATE `ipcard` SET `dcdate` = '$dateTh 00:00:00' WHERE `hn` = '$hn' AND `an` = '$an' ";

}elseif ($item['bedcode'] !== NULL) {
    echo "�����¶١�Ӣ����§���º�������� ��سһ���ҹ�������ͷӡ�� D/C";
}
