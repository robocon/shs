<?php 

// Line Notification ในไลน์กลุ่ม
$sToken = "XhvMYujk7DaMZnNOsCYldMFya0nlv9UeEDfQhnbEgb5";
$sMessage = iconv('TIS-620','UTF-8',"ทดสอบส่งข้อความ จาก line notify ขออภัยในความไม่สะดวกครับ");
$chOne = curl_init(); 
// https://notify-api.line.me/api/notify
// http://203.104.138.174/api/notify
curl_setopt( $chOne, CURLOPT_URL, "https://203.104.138.174/api/notify"); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYHOST, 0); 
curl_setopt( $chOne, CURLOPT_SSL_VERIFYPEER, 0); 
curl_setopt( $chOne, CURLOPT_POST, 1); 
curl_setopt( $chOne, CURLOPT_POSTFIELDS, "message=".$sMessage); 
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken.'', );
curl_setopt($chOne, CURLOPT_HTTPHEADER, $headers); 
curl_setopt( $chOne, CURLOPT_RETURNTRANSFER, 1); 
$result = curl_exec( $chOne ); 
curl_close($chOne);