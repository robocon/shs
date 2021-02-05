<?php 
// โค้ดแห้ง
// เอาไว้อัพเดท appdate_en เฉพาะครั้งแรก
exit;
function dump($t){echo "<pre>";var_dump($t);echo "</pre>";}
$dbi = new mysqli("localhost","root","1234","smdb");
//$q = $dbi->query("SELECT `row_id`,`appdate` FROM `appoint` WHERE `row_id` >= '1545734'");
$q = $dbi->query("select * from appoint where doctor like 'md013%' and appdate like '%2564' order by row_id asc");
$listMonth = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', '05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', '09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');
function getMonthTH($t)
{
    global $listMonth;
    $key = array_search($t,$listMonth);
    if($key !== false)
    {
        return $key;
    }
}
while($item = $q->fetch_assoc())
{
    if(preg_match("/\d{4}\-\d{2}\-\d{2}/", $item['appdate'], $matchs) == false){
        $appId = $item['row_id'];
        list($d, $mTH, $yTH) = explode(' ',$item['appdate']);
        $mINT = getMonthTH($mTH);
        $dateEn = ($yTH - 543).'-'.$mINT.'-'.$d;
        dump($dateEn);
        dump($appId);
        
        $update = $dbi->query("UPDATE `appoint` SET `appdate_en` = '$dateEn' WHERE `row_id` = '$appId' LIMIT 1 ");
        dump($update);
        echo "<hr>";
    }
}
?>