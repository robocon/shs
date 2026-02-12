<?php
include("connect.inc");

$vn = mysql_real_escape_string($_GET['vn']);
$order_date = mysql_real_escape_string($_GET['order_date']);
$staff_id = mysql_real_escape_string($_GET['staff_id']);
$ip_address = $_SERVER['REMOTE_ADDR']; // เก็บ IP ผู้ใช้งาน
$log_time = date("Y-m-d H:i:s");

if($vn != "") {
    // 1. Update ตาราง opday
    $sql = "UPDATE opday SET type_sso_nhso = 'APPOINT' WHERE vn = '$vn'";
    $result = mysql_query($sql);

    if($result) {
        // 2. Insert Log
        $remark = "ยืนยันเป็นผู้ป่วยนัดจากวันที่สั่งยา: " . $order_date . " (ขยายวงเงินอัตโนมัติ)";
        $log_sql = "INSERT INTO log_extend_credit (vn, staff_id, log_date, remark, ip_address) 
                    VALUES ('$vn', '$staff_id', '$log_time', '$remark', '$ip_address')";
        mysql_query($log_sql);
        
        echo "SUCCESS";
    } else {
        echo "ERROR: " . mysql_error();
    }
}
?>