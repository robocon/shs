<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$part = $_GET['part'];

if(empty($part))
{
    echo "Invalid data";
    exit;
}

$sql = "DELETE FROM `opcardchk` WHERE `part` = '$part' ";
$dbi->query($sql);

redirect('pm_shs.php', 'จัดการข้อมูลเรียบร้อย');
exit;
