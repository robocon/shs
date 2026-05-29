<?php
include dirname(__FILE__).'/newBootstrap.php';
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$no = sprintf("%s", $dbi->real_escape_string($_GET['no']));
$sql = "DELETE FROM `lab_ward` WHERE `no`='$no';";
$q = $dbi->query($sql);
if($q!==false){
    $res = array('status'=>200,'id'=>$no);
}else{
    $res = array('status'=>400);
}
echo $json->encode($res);