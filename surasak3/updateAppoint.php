#!/usr/bin/php
<?php 
// �����������Ѿഷ�����ѹ����� 23:55
function getMonthTH($t){
    $listMonth = array('01' => '���Ҥ�', '02' => '����Ҿѹ��', '03' => '�չҤ�', '04' => '����¹', '05' => '����Ҥ�', '06' => '�Զع�¹', '07' => '�á�Ҥ�', '08' => '�ԧ�Ҥ�', '09' => '�ѹ��¹', '10' => '���Ҥ�', '11' => '��Ȩԡ�¹', '12' => '�ѹ�Ҥ�');
    $key = array_search($t,$listMonth);
    if($key !== false){
        return $key;
    }
}
$dbi = new mysqli("localhost","root","1234","smdb");
$thDate = (date('Y')+543).date('-m-d');
$q = $dbi->query("SELECT `row_id`,`appdate` FROM `appoint` WHERE `date` LIKE '$thDate%' AND `appdate_en` IS NULL; ");
while($item = $q->fetch_assoc()){
    if(preg_match("/\d{4}\-\d{2}\-\d{2}/", $item['appdate'], $matchs) == false){
        $appId = $item['row_id'];
        list($d, $mTH, $yTH) = explode(' ',$item['appdate']);
        $mINT = getMonthTH($mTH);
        $dateEn = ($yTH - 543).'-'.$mINT.'-'.$d;
        $dbi->query("UPDATE `appoint` SET `appdate_en` = '$dateEn' WHERE `row_id` = '$appId' LIMIT 1;");
    }
}