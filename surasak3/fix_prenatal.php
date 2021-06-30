<?php 

require_once 'bootstrap.php'; 


$dbi = new mysqli(HOST,USER,PASS,DB);

$q_prenatal = $dbi->query("SELECT * FROM `43prenatal` ORDER BY `id` ASC ");


while ($item = $q_prenatal->fetch_assoc()) {
    
    $opday_id = $item['opday_id'];
    $sql_opday = "SELECT SUBSTRING(`thidate`, 1, 10) AS `thidate` FROM `opday` WHERE `row_id` = '$opday_id' ";
    $q_opday = $dbi->query($sql_opday);
    $opday = $q_opday->fetch_assoc();
    
    list($year, $month, $day) = explode('-', $opday['thidate']);

    $date_serv = ($year-543).$month.$day;

    $sql_update = "UPDATE `43prenatal` SET `date_serv` = '$date_serv' WHERE `opday_id` = '$opday_id' ";
    dump($sql_update);
    $save = $dbi->query($sql_update);
    dump($save);
    
}