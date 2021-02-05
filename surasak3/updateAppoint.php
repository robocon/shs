<?php 
// ตั้งเวลาให้อัพเดทแต่ละวันไว้ที่ 23:55
function getMonthTH($t){
    $listMonth = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
    $key = array_search($t,$listMonth);
    if($key !== false){
        return $key;
    }
}
$dbi = new mysqli("localhost","root","1234","smdb");
$thDate = (date('Y')+543).date('-m-d');
$q = $dbi->query("SELECT `row_id`,`appdate` FROM `appoint` WHERE `date` LIKE '$thDate'; ");
while($item = $q->fetch_assoc()){
    if(preg_match("/\d{4}\-\d{2}\-\d{2}/", $item['appdate'], $matchs) == false){
        $appId = $item['row_id'];
        list($d, $mTH, $yTH) = explode(' ',$item['appdate']);
        $mINT = getMonthTH($mTH);
        $dateEn = ($yTH - 543).'-'.$mINT.'-'.$d;
        $dbi->query("UPDATE `appoint` SET `appdate_en` = '$dateEn' WHERE `row_id` = '$appId' LIMIT 1;");
    }
}