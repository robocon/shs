<?php
include '../../bootstrap.php';

$db = Mysql::load();

$current_day = (date('Y') + 543).date('-m-d');
$officer = get_session('sOfficer');
$runno = input_post('run_number');

$sql_pre = "SELECT `date` 
FROM `billtranx` 
WHERE `chktranx` = '$runno' 
AND `date` = '$current_day' 
AND `officer` = '$officer'
ORDER BY `row_id` DESC
LIMIT 1;";

$db->select($sql_pre, array(':hn' => $hn));
$item = $db->get_item();

if( $item !== false ){
    $rows = (int) $db->get_rows();
    $txt = '{"get_status":200,"rows":'.$rows.'}';
}else{
    $txt = '{"get_status":400,"msg":"�������ö���¡�٢������� '.$item['error'].'"}';
}

header('Content-Type:text/html; charset=UTF-8');
echo $txt;
exit;