<?php
require_once dirname(__FILE__).'/newBootstrap.php';

$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);
$input = file_get_contents('php://input');
$data = $json->decode($input, true);

$pass = sprintf("%s", $dbi->real_escape_string($data['pass']));

$sql = "SELECT `row_id` FROM `inputm` WHERE `idname`='{$_SESSION['sIdname']}' AND `pword`={$pass} LIMIT 1";
$q = $dbi->query($sql);
if($q->num_rows>0){
    $res = array('status'=>200);
}else{
    $res = array('status'=>400);
}
echo $json->encode($res);
?>