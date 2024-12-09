<?php
# https://github.com/jumbojett/OpenID-Connect-PHP
// composer install / update ได้เลย
require __DIR__ . '/vendor/autoload.php';

use Jumbojett\OpenIDConnectClient;

$oidc = new OpenIDConnectClient('web', // เว็บของ n-health
                                'id', // id
                                'secret'); // secret
// ลิ้งเว็บ token endpoint
$oidc->providerConfigParam(['token_endpoint'=>'openid-connect/token']);

// ฟิกเป็น openid ได้เลย
$oidc->addScope(['openid']);

//Add username and password
$oidc->addAuthParam(['username'=>'']);
$oidc->addAuthParam(['password'=>'']);

// full path ของไฟล์ cacert.pem
$oidc->setCertPath('cacert.pem');

//Perform the auth and return the token (to validate check if the access_token property is there and a valid JWT) :
$token = $oidc->requestResourceOwnerToken(TRUE)->access_token;

// var_dump($token);

$postField = <<<POSTFIELD
{
"companyCode": "2900000001",
"packageName": "web_n_health_open_platform",
"data": {
}
}
POSTFIELD;

// ท่าขอ server key จาก token
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, ""); // ลิ้ง server key
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($curl, CURLOPT_POST, 1);
curl_setopt($curl, CURLOPT_POSTFIELDS, $postField);
$headers = array('Accept: application/json', 'Content-Type: application/json', 'Authorization: Bearer ' . $token . '',);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
$res = json_decode($result, true);
$serverKey = $res['serverKey'];
var_dump($serverKey);


// เรียกดู lab/result
$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, "");
curl_setopt($curl, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, 0);
$headers = array('Accept: application/json', 'Content-Type: application/json', 'Authorization: Bearer ' . $token,'serverKey:'.$serverKey);
curl_setopt($curl, CURLOPT_HTTPHEADER, $headers);
curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
$result = curl_exec($curl);
curl_close($curl);
var_dump($result);