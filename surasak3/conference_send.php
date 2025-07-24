#!/usr/bin/php
<?php
require dirname(__FILE__).'/includes/config.php';

$dbi = new mysqli(HOST,USER,PASS,DB,PORT);
$dbi->query("SET NAMES UTF-8");

$currDate = date('Y-m-d');
$before30min = date('H:i:s', strtotime('+30 minute'));

// ( ADDTIME(DATE_FORMAT(NOW(),'%H:%i:%s'),'00:30:00')
$sql = "SELECT a.*,b.`name` AS `department_name`
FROM (
    SELECT * FROM `conference_room` 
    WHERE `date` = '$currDate' 
    AND `time_start` <= '$before30min' 
    AND `crontab_status` = 'n' 
    ORDER BY `id` ASC
) AS a LEFT JOIN `departments` AS b ON a.`department_id` = b.`id`";
$q = $dbi->query($sql);

if($q!==false && $q->num_rows>0){
    while ($a = $q->fetch_assoc()) {

        $updateSql = sprintf("UPDATE `conference_room` SET `crontab_status` = 'y' WHERE `id` = '%s' ", $a['id']);
        $qUpdate = $dbi->query($updateSql);
        if($qUpdate!==false){

            $department = $a['department_name'];
            $timeStart = substr($a['time_start'],0,5);
            $room = $a['room'];
            $detail = $a['detail'];

            $msgTelegram = "👉📅 แจ้งเตือนใช้ห้องประชุม 📅👈\n<b>แผนก</b>: $department \nมีประชุม ณ <b>$room</b> \n<b>เวลา</b>: $timeStart น. ⏰\n<b>รายละเอียด</b>: $detail";
            
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, NOTIFY_HOST."/telegram/conference.php");
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt( $ch, CURLOPT_SSLVERSION, 6);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, "sMessage=".$msgTelegram);
            curl_setopt( $ch, CURLOPT_CONNECTTIMEOUT, 0);
            curl_setopt( $ch, CURLOPT_TIMEOUT, 5);
            $headers = array( 'Content-type: application/x-www-form-urlencoded' );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec( $ch );
            if($result===false){
                $error = curl_error($ch);
                $msg = '['.date('Y-m-d H:i:s').'] CURL - '.$error."\n";
                file_put_contents(dirname(__FILE__).'/logs/telegram.log', $msg, FILE_APPEND);

                echo $msg;
            }
            curl_close($ch);
        }
    }
}