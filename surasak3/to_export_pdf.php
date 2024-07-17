<?php 
session_start();
require_once 'includes/config.php';
$timeout = strtotime(date('Y-m-d'));
$sOfficer = $_SESSION['sOfficer'];
if(empty($sOfficer)){
    echo "Sessionหมดอายุ กรุณาLoginใหม่อีกครั้ง";
    exit;
}
header('Location: '.NOTIFY_HOST.'/shspdf/select_file.php?timeout='.$timeout.'&sOfficer='.$sOfficer);