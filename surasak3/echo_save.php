<?php 
include 'bootstrap.php';
include 'includes/JSON.php';

$json = new Services_JSON();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = $dbi->real_escape_string($_POST['id']);
$thdatehn = $dbi->real_escape_string($_POST['thdatehn']);

$ptname = $dbi->real_escape_string($_POST['ptname']);
$hn = $dbi->real_escape_string($_POST['hn']);
$vn = $dbi->real_escape_string($_POST['vn']);
$pause = $dbi->real_escape_string($_POST['pause']);
$bp = $dbi->real_escape_string($_POST['bp']);
$age = $dbi->real_escape_string($_POST['age']);

$echo_no = $dbi->real_escape_string($_POST['echo_number']);
$ao = $dbi->real_escape_string($_POST['ao']);
$la = $dbi->real_escape_string($_POST['la']);
$ivsd = $dbi->real_escape_string($_POST['ivsd']);
$ivss = $dbi->real_escape_string($_POST['ivss']);
$lvdd = $dbi->real_escape_string($_POST['lvdd']);
$lvds = $dbi->real_escape_string($_POST['lvds']);
$pwd = $dbi->real_escape_string($_POST['pwd']);
$pws = $dbi->real_escape_string($_POST['pws']);
$fs = $dbi->real_escape_string($_POST['fs']);
$lvedv = $dbi->real_escape_string($_POST['lvedv']);
$lvesv = $dbi->real_escape_string($_POST['lvesv']);
$sv = $dbi->real_escape_string($_POST['sv']);
$co = $dbi->real_escape_string($_POST['co']);
$ef = $dbi->real_escape_string($_POST['ef']);
$peake = $dbi->real_escape_string($_POST['peake']);
$peaka = $dbi->real_escape_string($_POST['peaka']);
$ea = $dbi->real_escape_string($_POST['ea']);
$dt = $dbi->real_escape_string($_POST['dt']);
$ms = $dbi->real_escape_string($_POST['ms']);
$ms_mngrad = $dbi->real_escape_string($_POST['ms_mngrad']);
$ms_mvapht = $dbi->real_escape_string($_POST['ms_mvapht']);
$ms_mva2d = $dbi->real_escape_string($_POST['ms_mva2d']);
$ms_mr = $dbi->real_escape_string($_POST['ms_mr']);
$as = $dbi->real_escape_string($_POST['as']);
$as_pgrad = $dbi->real_escape_string($_POST['as_pgrad']);
$as_mngrad = $dbi->real_escape_string($_POST['as_mngrad']);
$as_ar = $dbi->real_escape_string($_POST['as_ar']);
$as_aipht = $dbi->real_escape_string($_POST['as_aipht']);
$ps = $dbi->real_escape_string($_POST['ps']);
$ps_pgrad = $dbi->real_escape_string($_POST['ps_pgrad']);
$ps_mngrad = $dbi->real_escape_string($_POST['ps_mngrad']);
$ps_pr = $dbi->real_escape_string($_POST['ps_pr']);
$ps_pr_pgrad = $dbi->real_escape_string($_POST['ps_pr_pgrad']);
$ts = $dbi->real_escape_string($_POST['ts']);
$ts_mngrad = $dbi->real_escape_string($_POST['ts_mngrad']);
$ts_tvapht = $dbi->real_escape_string($_POST['ts_tvapht']);
$ts_tva2d = $dbi->real_escape_string($_POST['ts_tva2d']);
$ts_tr = $dbi->real_escape_string($_POST['ts_tr']);
$ts_rvsp = $dbi->real_escape_string($_POST['ts_rvsp']);
$cardio_finding = $dbi->real_escape_string($_POST['cardio_finding']);
$diag = $dbi->real_escape_string($_POST['diag']);
$doctor = $dbi->real_escape_string($_SESSION['sOfficer']);
$type = $dbi->real_escape_string($_POST['type']);

// กรณีผู้ป่วยใน และพยาบาลเป็นคนคีย์
if(!empty($_POST['staff'])){
    $doctor = sprintf("%s", $_POST['doctor']);
    $staff = sprintf("%s", $_POST['staff']);
}


$res['data'] = array();
if(empty($id)){

    $sql = "INSERT INTO `echo_cardio` ( 
        `id`, `date`, `thdatehn`, `ptname`, `hn`, `type`, `vn`, 
        `pause`, `bp`, `age`, `echo_no`, `ao`, `la`, 
        `ivsd`, `ivss`, `lvdd`, `lvds`, `pwd`, `pws`, 
        `fs`, `lvedv`, `lvesv`, `sv`, `co`, `ef`, 
        `peake`, `peaka`, `ea`, `dt`, `ms`, `ms_mngrad`, 
        `ms_mvapht`, `ms_mva2d`, `ms_mr`, `as`, `as_pgrad`, `as_mngrad`, 
        `as_ar`, `as_aipht`, `ps`, `ps_pgrad`, `ps_mngrad`, `ps_pr`, 
        `ps_pr_pgrad`, `ts`, `ts_mngrad`, `ts_tvapht`, `ts_tva2d`, `ts_tr`, 
        `ts_rvsp`, `cardio_finding`, `diag`, `doctor`, `staff`, `status`
    ) VALUES ( 
        NULL, NOW(), '$thdatehn', '$ptname', '$hn', '$type', '$vn', 
        '$pause', '$bp', '$age', '$echo_no', '$ao', '$la', 
        '$ivsd', '$ivss', '$lvdd', '$lvds', '$pwd', '$pws', 
        '$fs', '$lvedv', '$lvesv', '$sv', '$co', '$ef', 
        '$peake', '$peaka', '$ea', '$dt', '$ms', '$ms_mngrad', 
        '$ms_mvapht', '$ms_mva2d', '$ms_mr', '$as', '$as_pgrad', '$as_mngrad', 
        '$as_ar', '$as_aipht', '$ps', '$ps_pgrad', '$ps_mngrad', '$ps_pr', 
        '$ps_pr_pgrad', '$ts', '$ts_mngrad', '$ts_tvapht', '$ts_tva2d', '$ts_tr', 
        '$ts_rvsp', '$cardio_finding', '$diag', '$doctor', '$staff', 'y'
    );";
    $save = $dbi->query($sql);
    $insert_id = $dbi->insert_id;

    $res['data'][] = array('id'=>$insert_id, 'echo_number'=>$echo_no);

}else{
    // update
    $sql = "UPDATE `echo_cardio` SET 
    `thdatehn`='$thdatehn', 
    `ptname`='$ptname', 
    `hn`='$hn', 
    `type`='$type',
    `vn`='$vn', 
    `pause`='$pause', 
    `bp`='$bp', 
    `age`='$age', 
    `echo_no`='$echo_no', 
    `ao`='$ao', 
    `la`='$la', 
    `ivsd`='$ivsd', 
    `ivss`='$ivss', 
    `lvdd`='$lvdd', 
    `lvds`='$lvds', 
    `pwd`='$pwd', 
    `pws`='$pws', 
    `fs`='$fs', 
    `lvedv`='$lvedv', 
    `lvesv`='$lvesv', 
    `sv`='$sv', 
    `co`='$co', 
    `ef`='$ef', 
    `peake`='$peake', 
    `peaka`='$peaka', 
    `ea`='$ea', 
    `dt`='$dt', 
    `ms`='$ms', 
    `ms_mngrad`='$ms_mngrad', 
    `ms_mvapht`='$ms_mvapht', 
    `ms_mva2d`='$ms_mva2d', 
    `ms_mr`='$ms_mr', 
    `as`='$as', 
    `as_pgrad`='$as_pgrad', 
    `as_mngrad`='$as_mngrad', 
    `as_ar`='$as_ar', 
    `as_aipht`='$as_aipht', 
    `ps`='$ps', 
    `ps_pgrad`='$ps_pgrad', 
    `ps_mngrad`='$ps_mngrad', 
    `ps_pr`='$ps_pr', 
    `ps_pr_pgrad`='$ps_pr_pgrad', 
    `ts`='$ts', 
    `ts_mngrad`='$ts_mngrad', 
    `ts_tvapht`='$ts_tvapht', 
    `ts_tva2d`='$ts_tva2d', 
    `ts_tr`='$ts_tr', 
    `ts_rvsp`='$ts_rvsp', 
    `cardio_finding`='$cardio_finding', 
    `diag`='$diag', 
    `doctor`='$doctor', 
    `staff` = '$staff' WHERE ( `id`='$id' );";
    $save = $dbi->query($sql);
    $res['data'][] = array('id'=>$id, 'echo_number'=>$echo_no);

}

if($save == false){
    unset($res['data']);
    $res['data'][] = array('error' => $dbi->error, 'errno' => $dbi->errno);
}

// header('Content-Type: application/json; charset=utf-8');
echo $json->encode($res);