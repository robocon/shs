<?php 
header('Access-Control-Allow-Origin: *');
header('Content-Type: application/json');
$hn = $_REQUEST['hn'];
$cont = file_get_contents("D:\\UCAuthentication4.x\\nhso_token.txt");
$cont = trim($cont);
list($user_person_id,$smctoken) = explode('#', $cont);

/**
 * https://medium.com/dev2pro/%E0%B8%9E%E0%B8%B1%E0%B8%92%E0%B8%99%E0%B8%B2%E0%B8%A3%E0%B8%B0%E0%B8%9A%E0%B8%9A%E0%B9%80%E0%B8%8A%E0%B9%87%E0%B8%84%E0%B8%AA%E0%B8%B4%E0%B8%97%E0%B8%98%E0%B8%B4%E0%B9%8C-%E0%B9%82%E0%B8%94%E0%B8%A2%E0%B8%81%E0%B8%B2%E0%B8%A3-%E0%B9%80%E0%B8%8A%E0%B8%B7%E0%B9%88%E0%B8%AD%E0%B8%A1%E0%B8%95%E0%B9%88%E0%B8%AD-%E0%B8%81%E0%B8%B1%E0%B8%9A-webservice-%E0%B8%82%E0%B8%AD%E0%B8%87-%E0%B8%AA%E0%B8%9B%E0%B8%AA%E0%B8%8A-51886a7d5772
 */
$client = new SoapClient("http://ucws.nhso.go.th:80/ucwstokenp1/UCWSTokenP1?wsdl");

$params = array(
"user_person_id" => $user_person_id,
"smctoken" => $smctoken,
"person_id" => $hn,
);

// Invoke WS method (Function1) with the request params 
$response = $client->__soapCall("searchCurrentByPID", array($params));

$res = (array) $response->return;
echo json_encode($res);
