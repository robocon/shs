<?php
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf($_POST['action']);
if($action==='del'){

    $id = $_POST['id'];
    if(!empty($id)){

        $sql = sprintf("DELETE FROM `drugreact_group_list` WHERE `id` = '%d' LIMIT 1;", $dbi->real_escape_string($id));
        $result = $dbi->query($sql);
        
        if($result!==false){
            $res = array('status' => 200, 'message' => 'ลบข้อมูลเรียบร้อยแล้ว');
        }else{
            $res = array('status' => 400, 'message' => 'ไม่สามารถดำเนินการต่อได้ Error: '.$dbi->error);
        }
        
    }else{
        $res = array('status' => 400, 'message' => 'กรุณาระบุรายการที่ต้องการลบ');
    }
    
    header("Content-Type: application/json; charset=UTF-8");
    echo json_encode($res);
    exit;
}