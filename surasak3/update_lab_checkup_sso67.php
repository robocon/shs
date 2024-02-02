<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$thidate = "2567-02-02";
$orderdate = '2024-02-02';

$sql = "SELECT a.thidate,b.hn,b.idcard,CONCAT(b.yot,b.name,' ',b.surname) AS ptname,b.dbirth,b.guardian,b.ptright,b.hospcode,b.employee,a.vn 
FROM (
    SELECT * FROM opday WHERE thidate LIKE '$thidate%' AND ptright LIKE 'R42%' 
) AS a 
LEFT JOIN opcard AS b ON b.hn = a.hn";
dump($sql);
$q = $dbi->query($sql);
while ($a = $q->fetch_assoc()) { 
    
    $hn = $a['hn'];
    
    $updateResultHead = "UPDATE resulthead SET clinicalinfo='ตรวจสุขภาพประจำปี67' WHERE hn = '$hn' AND orderdate LIKE '$orderdate%' ";
    dump($updateResultHead);
    $update = $dbi->query($updateResultHead);
    dump($update);

    echo "<hr>";
}