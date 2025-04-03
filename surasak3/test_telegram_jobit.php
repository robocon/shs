<?php
require_once dirname(__FILE__).'/bootstrap.php';

$msg = urlencode('สวัสดีชาวโลก สบายดีมั้ย');

$dir = str_replace(basename($_SERVER['SCRIPT_NAME']),'',$_SERVER['SCRIPT_NAME']);
$url = 'http://'.$_SERVER['HTTP_HOST'].':8056'.$dir.'telegram_jobit.php?sMessage='.$msg;

$curl = curl_init(); 
curl_setopt( $curl, CURLOPT_URL, $url);
curl_setopt( $curl, CURLOPT_HEADER, 0);
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 0);
$result = curl_exec( $curl );
if($result===false){
    echo curl_error($curl);
}else{
    echo $result;
}
curl_close($curl);