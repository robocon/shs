<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/includes/JSON.php';
$json = new Services_JSON(SERVICES_JSON_LOOSE_TYPE);

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$input = file_get_contents('php://input');
$data = $json->decode($input);
$action = $data['action'];
if($action==='add'){
    $name = $data['name'];
    $sql = sprintf("INSERT INTO `drugreact_group` (`name`, `status`) VALUES ('%s', 'y')", 
        $dbi->real_escape_string($name)
    );
    $q = $dbi->query($sql);
    if($q===true){
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ Error: '.$dbi->error);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;

}elseif($action==='delete'){
    $id = $data['id'];
    $sql = sprintf("UPDATE `drugreact_group` SET `status` = 'n' WHERE `id` = '%s'", 
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sql);
    if($q===true){
        $res = array('status'=>200, 'message'=>'ลบข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถลบข้อมูลได้ Error: '.$dbi->error);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;

}elseif($action==='getFromId'){
    $id = $data['id'];
    $sql = sprintf("SELECT `name` FROM `drugreact_group` WHERE `id` = '%s'", 
        $dbi->real_escape_string($id)
    );
    $q = $dbi->query($sql);
    if($q!==false){
        if($q->num_rows>0){
            $a = $q->fetch_assoc();
            $res = array('status'=>200, 'message'=>$a['name']);
        }else{ 
            $res = array('status'=>400, 'message'=>'ไม่พบข้อมูล');
        }
    }else{
        $res = array('status'=>400, 'message'=>'Not Found Data Error: '.$dbi->error);
    }
    
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;

}elseif($action==='update'){
    $id = $data['id'];
    $name = $data['name'];
    $oldName = $data['oldName'];
    
    $sql = sprintf("UPDATE `drugreact_group` SET `name` = '%s' WHERE `id` = '%s'", 
        $dbi->real_escape_string($name),
        $dbi->real_escape_string($id)
    );
    $qReactGroup = $dbi->query($sql);
    
    $sqlUpdate = sprintf("UPDATE `drugreact` SET `groupname` = '%s' WHERE `groupname` = '%s' ;",
        $dbi->real_escape_string($name),
        $dbi->real_escape_string($oldName)
    );
    $dbi->query($sqlUpdate);
    
    if($qReactGroup!==false){
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ Error: '.$dbi->error);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;

}elseif ($action==='checkDrugreact') {
    $id = $data['id'];
    $name = $data['name'];

    $res = array('status'=>200,'userReactRows'=>0,'groupReactRows'=>0);
    $sql = sprintf("SELECT * FROM `drugreact` WHERE `groupname` = '%s'; ", $dbi->real_escape_string($name));
    $q = $dbi->query($sql);
    if($q!==false){
        $userReactRows = $q->num_rows;
        if($userReactRows>0){
            $res['userReactRows'] = $userReactRows;
        }
    }else{
        $res = array('status'=>400,'message'=>'Error: '.$dbi->error);
    }
    
    $sql = sprintf("SELECT * FROM `drugreact_group_list` WHERE `drugreact_group` = '%s' ", $dbi->real_escape_string($id));
    $q = $dbi->query($sql);
    if($q!==false){
        $groupReactRows = $q->num_rows;
        if($groupReactRows>0){
            $res['groupReactRows'] = $groupReactRows;
        }
    }else{
        $res = array('status'=>400,'message'=>'Error: '.$dbi->error);
    }
    
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;
}elseif ($action=='checkPass') {
    
    $user = $_SESSION['sIdname'];
    $pass = $data['pass'];

    $sql = sprintf("SELECT `row_id` FROM `inputm` WHERE `idname` = '%s' AND `pword` = '%s' AND `status` = 'y' LIMIT 1", 
    $dbi->real_escape_string($user),
    $dbi->real_escape_string($pass));
    $q = $dbi->query($sql);
    if($q!==false){
        if($q->num_rows>0){
            $res = array('status'=>200);
        }else{
            $res = array('status'=>400);
        }
    }else{
        $res = array('status'=>400);
    }
    header('Content-Type: application/json; charset=UTF-8');
    echo $json->encode($res);
    exit;
}