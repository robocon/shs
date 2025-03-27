<?php
require_once dirname(__FILE__).'/bootstrap.php';
require_once dirname(__FILE__).'/includes/JSON.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$json = new Services_JSON();

$data = $json->decode(file_get_contents('php://input'), true);

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
}