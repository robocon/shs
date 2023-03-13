<?php 
require_once 'bootstrap.php';
include 'includes/JSON.php';
$json = new Services_JSON();

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$drug_code = sprintf("%s", $_POST['drugcode']);
$preg = sprintf("%s", $_POST['preg']);
$preg_alert = sprintf("%s", $_POST['preg_alert']);

$byuser = sprintf("%s", $_SESSION['sIdname']);

$q = $dbi->query("SELECT `id` FROM `drug_pregnancy` WHERE `drugcode` = '$drug_code' ");
if($q->num_rows===0){ 

    $save = $dbi->query("INSERT INTO `drug_pregnancy` (`drugcode`) VALUES ('$drug_code')");

}

if($preg==='pregnancy'){

    $sql = "UPDATE `drug_pregnancy` SET `pregnancy` = '$preg_alert', `lastupdate`=NOW(), `byuser` = '$byuser',`status`='y' WHERE `drugcode` = '$drug_code' ";

}elseif($preg==='lactation'){

    $sql = "UPDATE `drug_pregnancy` SET `lactation` = '$preg_alert', `lastupdate`=NOW(), `byuser` = '$byuser',`status`='y' WHERE `drugcode` = '$drug_code' ";

}
dump($sql);
$save = $dbi->query($sql);
dump($save);

if(empty($dbi->error)){
    $res = array('status'=>200, 'message' => 'บันทึกข้อมูลเรียบร้อย');
}else{
    $res = array('status'=>400, 'message' => 'บันทึกข้อมูลไม่สำเร็จ '.$dbi->error);
}

echo $json->encode($res);