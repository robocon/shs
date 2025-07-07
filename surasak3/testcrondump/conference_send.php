#!/usr/bin/php
<?php
/**
 * ใช้สำหรับการแจ้งเตือนผ่าน crontab เท่านั้น
 */
require_once '/var/www/html/sm3/surasak3/connect.php';

$dbi = new mysqli($ServerName,$User,$Password,$DatabaseName);
$dbi->query("SET NAMES UTF8");

$currDate = date('Y-m-d');
$currTime = date('H:i:s');

$sql = "SELECT a.*,b.`name` AS `department_name`
FROM (
    SELECT * FROM `conference_room` 
    WHERE `date` = '$currDate' 
    AND ( ADDTIME(DATE_FORMAT(NOW(),'%H:%i:%s'),'00:30:00') >= `time_start` ) 
    AND `crontab_status` = 'n' 
    ORDER BY `id` ASC
) AS a LEFT JOIN `departments` AS b ON a.`department_id` = b.`id`";
$q = $dbi->query($sql);
if($q->num_rows > 0){
    while ($a = $q->fetch_assoc()) {

        $conference_id = $a['id'];
        $updateSql = "UPDATE `conference_room` SET `crontab_status` = 'y' WHERE `id` = '$conference_id' ";
        $qUpdate = $dbi->query($updateSql);

        if($qUpdate!==false){

            $department = $a['department_name'];
            $timeStart = substr($a['time_start'],0,5);
            $room = $a['room'];
            $detail = $a['detail'];

            $msgTelegram = "👉📅 แจ้งเตือนใช้ห้องประชุม\n<b>แผนก</b>: $department \nมีประชุม ณ <b>$room</b> \n<b>เวลา</b>: $timeStart น. ⏰\n<b>รายละเอียด</b>: $detail";
            
            $ch = curl_init();
            curl_setopt( $ch, CURLOPT_URL, NOTIFY_HOST."/telegram/conference.php");
            curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
            curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
            curl_setopt( $ch, CURLOPT_SSLVERSION, 6);
            curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt( $ch, CURLOPT_POST, 1);
            curl_setopt( $ch, CURLOPT_POSTFIELDS, "sMessage=".$msgTelegram); 
            $headers = array( 'Content-type: application/x-www-form-urlencoded' );
            curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers);

            $result = curl_exec( $ch );
            if($result===false){
                $error = curl_error($ch);
                dump($error);
            }
            curl_close($ch);
        }
    }
}