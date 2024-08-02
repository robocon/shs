<?php 
include_once 'includes/JSON.php';
require_once 'includes/config.php';
$json = new Services_JSON();

$idcard = $_GET['idcard'];
$person_id = $_GET['user_person_id'];
$smctoken = $_GET['smctoken'];

$url = NOTIFY_HOST."/appointNhso.php?idcard=$idcard&user_person_id=$person_id&smctoken=$smctoken";

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec( $ch );
if($result===false){
    $result = 'Error: '.curl_error($ch);
}
// $items = $json->decode($result);

echo $result;