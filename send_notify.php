<?php 

$message = $_POST['message'];
$token = $_POST['token'];

$ch = curl_init(); 
curl_setopt( $ch, CURLOPT_URL, "https://notify-api.line.me/api/notify"); 
curl_setopt( $ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt( $ch, CURLOPT_SSLVERSION, 6);
curl_setopt( $ch, CURLOPT_POST, 1); 
curl_setopt( $ch, CURLOPT_POSTFIELDS, "message=".$sMessage); 
$headers = array( 'Content-type: application/x-www-form-urlencoded', 'Authorization: Bearer '.$sToken, );
curl_setopt( $ch, CURLOPT_HTTPHEADER, $headers); 
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec( $ch );
if($result===false){
    echo curl_error($ch);
}
curl_close($ch);