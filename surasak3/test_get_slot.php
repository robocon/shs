<?php
header('Access-Control-Allow-Origin: *');
session_start();
define('PREFIX_MOPH', '1');
define('HOSPITAL_CODE', '11512');
define('MOPH_USER', 'Surasak11512');
define('SECRET_KEY', '$jwt@moph#');
define('MOPH_TOKEN', 'https://cvp1.moph.go.th/');

$password_hash = strtoupper(hash_hmac('sha256', MOPH_USER, SECRET_KEY));
$public_key_url = MOPH_TOKEN . "token?Action=get_moph_access_token&user=" . MOPH_USER . "&password_hash=$password_hash&hospital_code=" . HOSPITAL_CODE;

$curl = curl_init();
curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
curl_setopt($curl, CURLOPT_URL, $public_key_url);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$public_key = curl_exec($curl);
curl_close($curl);

$date_start = $_REQUEST['date_start'];
$date_finish = $_REQUEST['date_finish'];

$curl = curl_init();
curl_setopt($curl, CURLOPT_AUTOREFERER, TRUE);
curl_setopt($curl, CURLOPT_URL, MOPH_TOKEN . "api/ImmunizationSlot?date_start=$date_start&date_finish=$date_finish&Action=slot");
curl_setopt($curl, CURLOPT_HTTPHEADER, array(
    "Authorization: Bearer $public_key" 
));
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$output = curl_exec($curl);
curl_close($curl);

header('Content-Type: application/json');
echo $output;