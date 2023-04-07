<?php 
require_once 'bootstrap.php';
require_once 'includes/JSON.php';

$json = new Services_JSON();
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_POST['action']);
$drug_code = sprintf("%s", $_POST['drugcode']);
$preg = sprintf("%s", $_POST['preg']);
$preg_alert = sprintf("%s", $_POST['preg_alert']);
$byuser = sprintf("%s", $_SESSION['sIdname']);

if(empty($action) OR empty($byuser)){
    echo "Invalid";
    exit;
}

if($action=='add'){

    // เพิ่มข้อมูล drugcode เข้าไปก่อน
    $q = $dbi->query("SELECT `id` FROM `drug_pregnancy` WHERE `drugcode` = '$drug_code' ");
    if($q->num_rows===0){ 
        $save = $dbi->query("INSERT INTO `drug_pregnancy` (`drugcode`) VALUES ('$drug_code')");
    }

    // แล้วค่อยมาเซ็ตค่า pregnancy กับ lactation อีกที
    if($preg==='pregnancy'){
        $set = "`pregnancy` = '$preg_alert'";

    }elseif($preg==='lactation'){
        $set = "`lactation` = '$preg_alert'";

    }

    $sql = "UPDATE `drug_pregnancy` SET $set, `lastupdate`=NOW(), `byuser` = '$byuser', `status`='y' WHERE `drugcode` = '$drug_code' ";
    $save = $dbi->query($sql);

}else{ 

    if($preg==='pregnancy'){
        $set = "`pregnancy` = ''";

    }elseif($preg==='lactation'){
        $set = "`lactation` = ''";

    }

    $sql = "UPDATE `drug_pregnancy` SET $set, `byuser`='$byuser' WHERE (`drugcode`='$drug_code');";
    $save = $dbi->query($sql);

}

if($save!==false){
    $res = array('status'=>200, 'message' => 'บันทึกข้อมูลเรียบร้อย');

}else{
    $res = array('status'=>400, 'message' => 'บันทึกข้อมูลไม่สำเร็จ '.$dbi->error);
    
}

echo $json->encode($res);