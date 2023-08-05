<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');

$idcard = $_REQUEST['idcard'];
$user_person_id = $_REQUEST['user_person_id'];
$smctoken = $_REQUEST['smctoken'];

$client = new SoapClient("http://ucws.nhso.go.th:80/ucwstokenp1/UCWSTokenP1?wsdl");

$params = array(
"user_person_id" => $user_person_id,
"smctoken" => $smctoken,
"person_id" => $idcard,
);

// Invoke WS method (Function1) with the request params 
$response = $client->__soapCall("searchCurrentByPID", array($params));

$res = (array) $response->return;
echo json_encode($res);