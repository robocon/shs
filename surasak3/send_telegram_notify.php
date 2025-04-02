<?php
require_once dirname(__FILE__).'/bootstrap.php';

$sMessage = $_REQUEST['sMessage'];
if(empty($sMessage)){
    echo 'Message is required';
    exit;
}

$type = sprintf('%s', $_REQUEST['type']);
if ($type=='jobit') {
    $chat_id = UPDATE_JOB_IT;
}

$curl = curl_init(); 
curl_setopt( $curl, CURLOPT_URL, "https://api.telegram.org/bot".TELEGRAM_BOT_TOKEN."/sendMessage?chat_id=".UPDATE_JOB_IT."&text=".$sMessage); 
curl_setopt( $curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt( $curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt( $curl, CURLOPT_SSLVERSION, 6);
curl_setopt( $curl, CURLOPT_RETURNTRANSFER, 1);

$result = curl_exec( $curl );
if($result===false){
    // echo curl_error($curl);
}else{
    // echo $result;
}
curl_close($curl);