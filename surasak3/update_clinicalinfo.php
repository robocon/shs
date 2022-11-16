<?php 
require_once 'bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$sql_opcardchk = "SELECT * FROM `opcardchk` WHERE `part` = 'ห้างหุ้นส่วนจำกัดลำปางนิพนธ์บริการ พ.ย. 65' ";

$q = $dbi->query($sql_opcardchk);

while ($a = $q->fetch_assoc()) { 
    
    $examno = $a['exam_no'];
    $hn = $a['HN'];

    $find_resulthead = "SELECT `autonumber` FROM `resulthead` WHERE `labnumber` = '$examno' AND `hn` = '$hn' ";
    $q_rsh = $dbi->query($find_resulthead);
    if($q_rsh->num_rows > 0){
        $sql_update = "UPDATE `resulthead` SET `clinicalinfo`='ตรวจสุขภาพประจำปี66' WHERE `labnumber` = '$examno'";
        $rsh_update = $dbi->query($sql_update);
        dump($rsh_update);

    }else{
        dump($hn." ไม่มีผล resulthead");
    }

}