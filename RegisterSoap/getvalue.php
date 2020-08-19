<?php 
header('Access-Control-Allow-Origin: *');

$cont = file_get_contents("D:\\UCAuthentication4.x\\nhso_token.txt");
$cont = trim($cont);
list($user_person_id,$smctoken) = explode('#', $cont);

var_dump($user_person_id);
var_dump($smctoken);
