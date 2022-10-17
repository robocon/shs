<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$q = $dbi->query("SELECT * FROM `chk_lab_items` WHERE `part` = 'บริษัท อีซูชุลำปาง จำกัด และ ห้างหุ้นส่วนลำปางศิริชัย 65' ORDER BY `labnumber`");
ฟหกดฟหกด
while ($a = $q->fetch_assoc()) {
    
    $labnumber = $a['labnumber'];
    // $sql_isuzu = "UPDATE `resulthead` SET `clinicalinfo` = 'ตรวจสุขภาพประจำปี66' WHERE `labnumber`='$labnumber' ";
    // dump($sql_isuzu);
    $update = $dbi->query("UPDATE `resulthead` SET `clinicalinfo` = 'ตรวจสุขภาพประจำปี66' WHERE `labnumber`='$labnumber' ");
    dump($update);
    # code...
}