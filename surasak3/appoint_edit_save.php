<?php 
require_once 'bootstrap.php';

$xray = input_post('xray');
$xray2 = input_post('xray2');
$code = $_POST['code'];
$labextra = input_post('labextra');
$id = input_post('id');
$hn = input_post('hn');
$officer = $_SESSION['sOfficer'];
$lab_old = input_post('lab_old');
$xray_old = input_post('xray_old');
$officer_old = input_post('officer_old');
$labextra_old = input_post('labextra_old');

$detail2 = input_post('detail2');

$where_detail2 = '';
if( $detail2 != false ){
    $where_detail2 = ", `detail2` = '$detail2' ";
}

$appoint_lab = array();
foreach ($code as $key => $item) {
    $appoint_lab[] = $item;
}
$appoint_lab_txt = implode(',', $appoint_lab);

$xray_txt = $xray.( $xray2 != false ? ','.$xray2 : false );


$sql = "UPDATE `appoint` SET 
    `patho`='$appoint_lab_txt', 
    `xray`='$xray_txt', 
    `labextra`='$labextra' 
    $where_detail2
    WHERE (`row_id`='$id');";
$db->update($sql);

$sql = "DELETE FROM `appoint_lab` WHERE `id` = '$id' ";
$db->delete($sql);

foreach ($code as $key => $item) {
    $sql = "INSERT INTO `appoint_lab` (`row_id`, `id`, `code`) VALUES (NULL, '$id', '$item');";
    $db->insert($sql);
}

$sql = "INSERT INTO `log_appoint` (
    `id`, `date`, `hn`, `lab_old`, `lab`, 
    `labextra`, `labextra_old`, `xray`, `xray_old`, `office`, `officer_old`
) VALUES (
    NULL, NOW(), '$hn', '$lab_old', '$appoint_lab_txt', 
    '$labextra', '$labextra_old', '$xray_txt', '$xray_old', '$officer', '$officer_old'
);";
$db->insert($sql);

header('Location: appoint_edit.php?action=print&id='.$id);
exit;