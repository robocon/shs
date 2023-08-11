<?php 
include_once 'includes/JSON.php';
$json = new Services_JSON();

$idcard = $_GET['idcard'];
$person_id = $_GET['user_person_id'];
$smctoken = $_GET['smctoken'];

$url = "http://192.168.129.143/appointNhso.php?idcard=$idcard&user_person_id=$person_id&smctoken=$smctoken";

$ch = curl_init(); 
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

$result = curl_exec( $ch );
// $items = $json->decode($result);

echo $result;