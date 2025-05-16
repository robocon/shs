<?php
include_once dirname(__FILE__).'/bootstrap.php';
include_once dirname(__FILE__).'/class_file/class_opcard.php';
include_once dirname(__FILE__).'/includes/JSON.php';

$json = new Services_JSON();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$data = json_decode(file_get_contents('php://input'));

$action = $data->action;

if( $action == 'save' ) {
    $company = $data->company;
    $id = $data->id;
    $company_code = $data->company_code;
    $date_checkup = $data->date_checkup;
    $yearchk = $data->yearchk;
    $typeReport = $data->typeReport;
    $officer = $_SESSION['sOfficer'];
    $genVn = intval($data->genVn);

    $job_status = '';
    $job_date_run = '';
    if($genVn===1){
        $job_status = 'r'; // ready
        $job_date_run = $data->job_date_run;
    }
    $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');

    // ถ้ามีไอดีอยู่แล้วแสดงว่าแก้ตัวเดิม
    if( $id > 0 ){
        $sql = sprintf("UPDATE `chk_company_list` SET `name` = '%s', 
        `code` = '%s', 
        `date_checkup` = '%s', 
        `yearchk` = '%s',
        `job_status` = '%s',
        `job_date_edit` = NOW(),
        `job_date_run` = '%s',
        `officer_edit` = '%s'
        WHERE `id` = '%s';",
        $dbi->real_escape_string($company),
        $dbi->real_escape_string($company_code),
        $dbi->real_escape_string($date_checkup),
        $dbi->real_escape_string($yearchk),
        $dbi->real_escape_string($job_status),
        $dbi->real_escape_string($job_date_run),
        $dbi->real_escape_string($officer),
        $dbi->real_escape_string($id)
        );
        $save = $dbi->query($sql);
        if( $save !== true ){
            $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ '.$dbi->error);
        }

    }else{

        $sql = sprintf("SELECT `id` FROM `chk_company_list` WHERE `code` = '%s'", $dbi->real_escape_string($company_code));
        $q = $dbi->query($sql);
        if( $q->num_rows == 0 ){
            $sql = sprintf("INSERT INTO `chk_company_list` ( `id`,`name`,`code`,`date_checkup`,`yearchk`,`status`,`report`,`job_status`,`job_date_add`,`job_date_run`,`officer_add`) 
            VALUES (
                NULL,'%s','%s','%s','%s','1','%s','%s',NOW(),'%s','%s'
            );",
            $dbi->real_escape_string($company),
            $dbi->real_escape_string($company_code),
            $dbi->real_escape_string($date_checkup),
            $dbi->real_escape_string($yearchk),
            $dbi->real_escape_string($typeReport),
            $dbi->real_escape_string($job_status),
            $dbi->real_escape_string($job_date_run),
            $dbi->real_escape_string($officer)
            );
            $save = $dbi->query($sql);

            if( $save !== true ){
                $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ '.$dbi->error);
            }
        }else{
            $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ รหัสบริษัทซ้ำซ้อน');
        }

    }
    
    echo $json->encode($res);
    exit;
}elseif ( $action == 'delCompany' ) {

    if(empty($data->id)){
        $res = array('status'=>400, 'message'=>'ไม่พบรหัสบริษัท');
        echo $json->encode($res);
        exit;
    }

    $sql = sprintf("DELETE FROM `chk_company_list` WHERE `id` = '%s' LIMIT 1", $dbi->real_escape_string($data->id));
    $q = $dbi->query($sql);
    if($q!==false){
        $res = array('status'=>200, 'message'=>'ลบเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถลบได้ '.$dbi->error);
    }
    echo $json->encode($res);
    exit;
}elseif ($action=='getUser') {

    $hn = $data->hn;
    if(empty($hn)){
        $res = array('status'=>400, 'message'=>'กรุณากรอก HN');
        echo $json->encode($res);
        exit;
    }

    $opcard = new Opcard();
    $user = $opcard->getByHn($hn,array('idcard'));
    if($user===false){
        $res = array('status'=>400, 'message'=>'ไม่พบ HN');
    }else{
        $res = array('status'=>200, 'data'=>$user);
    }
    
    echo $json->encode($res);
    exit;
    
}elseif ($action==='saveUser') {

    $row = $data->id;
    $pid = $data->pid;
    $userType = $data->userType;
    $exam_no = $data->exam_no;
    $hn = $data->hn;
    $idcard = $data->idcard;
    $name = $data->name;
    $surname = $data->surname;
    $part = $data->part;
    $course = $data->course;
    $datechkup = $data->datechkup;
    $agey = $data->agey;
    $dbirth = $data->dbirth;

    if($userType==='new'){

        $sql = sprintf("SELECT `row` FROM `opcardchk` WHERE `HN` = '%s' AND `part` = '%s' ",
        $dbi->real_escape_string($hn),
        $dbi->real_escape_string($part));

        $q = $dbi->query($sql);
        if($q->num_rows>0){
            echo $json->encode(array('status'=>400, 'message'=>'HN '.$hn.' ซ้ำซ้อนใน '.$part));
            exit;
        }

        $sql = sprintf("INSERT INTO `opcardchk`
        (
        `HN`,`row`,`exam_no`,`pid`,`idcard`,
        `name`,`surname`,`dbirth`,`agey`,`part`,
        `branch`,`course`,`datechkup`,`active`
        )
        VALUES (
        '%s','%s','%s','%s','%s',
        '%s','%s','%s','%s','%s',
        '','%s','%s','y'
        );",
        $dbi->real_escape_string($hn),
        $dbi->real_escape_string($row),
        $dbi->real_escape_string($exam_no),
        $dbi->real_escape_string($pid),
        $dbi->real_escape_string($idcard),
        $dbi->real_escape_string($name),
        $dbi->real_escape_string($surname),
        $dbi->real_escape_string($dbirth),
        $dbi->real_escape_string($agey),
        $dbi->real_escape_string($part),
        $dbi->real_escape_string($course),
        $dbi->real_escape_string($datechkup));

        $q = $dbi->query($sql);

    }else{
        $sql = sprintf("UPDATE `opcardchk` SET 
        `idcard` = '%s', 
        `name` = '%s', 
        `surname` = '%s', 
        `dbirth` = '%s',
        `agey` = '%s', 
        `part` = '%s', 
        `course` = '%s', 
        `datechkup` = '%s' 
        WHERE `row` = '%s' ",
        $dbi->real_escape_string($idcard),
        $dbi->real_escape_string($name),
        $dbi->real_escape_string($surname),
        $dbi->real_escape_string($dbirth),
        $dbi->real_escape_string($agey),
        $dbi->real_escape_string($part),
        $dbi->real_escape_string($course),
        $dbi->real_escape_string($datechkup),
        $dbi->real_escape_string($row)
        );
        $q = $dbi->query($sql);
    }

    if($q !== false){
        $res = array('status'=>200, 'message'=>'บันทึกข้อมูลเรียบร้อย');
    }else{
        $res = array('status'=>400, 'message'=>'ไม่สามารถบันทึกข้อมูลได้ '.$dbi->error);
    }

    echo $json->encode($res);
    exit;
}elseif ($action==='delUser') { 

    $row = $data->id;
    if(empty($row)){
        echo $json->encode(array('status'=>400, 'message'=>'ไม่พบข้อมูล'));
        exit;
    }
    
    $sql = sprintf("DELETE FROM `opcardchk` WHERE `row` = '%s' ", $dbi->real_escape_string($row));
    $del = $dbi->query($sql);
    if($del!==false){
        $res = array('status'=>200, 'message'=>'ลบข้อมูลเรียบร้อย');
    }else{  
        $res = array('status'=>400, 'message'=>'ไม่สามารถลบข้อมูลได้ '.$dbi->error);
    }

    echo $json->encode($res);
    exit;

}