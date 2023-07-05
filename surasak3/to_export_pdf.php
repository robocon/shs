<?php 
session_start();
$timeout = strtotime(date('Y-m-d'));
$sOfficer = $_SESSION['sOfficer'];
if(empty($sOfficer)){
    echo "Sessionหมดอายุ กรุณาLoginใหม่อีกครั้ง";
    exit;
}
header('Location: http://192.168.129.143/shspdf/select_file.php?timeout='.$timeout.'&sOfficer='.$sOfficer);