<?php 
include 'bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$ptname = $dbi->real_escape_string($_POST['ptname']);
$hn = $dbi->real_escape_string($_POST['hn']);
$vn = $dbi->real_escape_string($_POST['vn']);
$bp1 = $dbi->real_escape_string($_POST['bp1']);
$bp2 = $dbi->real_escape_string($_POST['bp2']);
$age = $dbi->real_escape_string($_POST['age']);
$echo_no = $dbi->real_escape_string($_POST['echo_no']);
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
$doctor = $dbi->real_escape_string($_POST['doctor']);



$sql = "INSERT INTO `echo_cardio` ( 
    `id`, `date`, `ptname`, `hn`, `vn`, 
    `bp1`, `bp2`, `age`, `echo_no`, `ao`, `la`, 
    `ivsd`, `ivss`, `lvdd`, `lvds`, `pwd`, `pws`, 
    `fs`, `lvedv`, `lvesv`, `sv`, `co`, `ef`, 
    `peake`, `peaka`, `ea`, `dt`, `ms`, `ms_mngrad`, 
    `ms_mvapht`, `ms_mva2d`, `ms_mr`, `as`, `as_pgrad`, `as_mngrad`, 
    `as_ar`, `as_aipht`, `ps`, `ps_pgrad`, `ps_mngrad`, `ps_pr`, 
    `ps_pr_pgrad`, `ts`, `ts_mngrad`, `ts_tvapht`, `ts_tva2d`, `ts_tr`, 
    `ts_rvsp`, `cardio_finding`, `diag`, `doctor` 
) VALUES ( 
    NULL, NOW(), '$ptname', '$hn', '$vn', 
    '$bp1', '$bp2', '$age', '$echo_no', '$ao', '$la', 
    '$ivsd', '$ivss', '$lvdd', '$lvds', '$pwd', '$pws', 
    '$fs', '$lvedv', '$lvesv', '$sv', '$co', '$ef', 
    '$peake', '$peaka', '$ea', '$dt', '$ms', '$ms_mngrad', 
    '$ms_mvapht', '$ms_mva2d', '$ms_mr', '$as', '$as_pgrad', '$as_mngrad', 
    '$as_ar', '$as_aipht', '$ps', '$ps_pgrad', '$ps_mngrad', '$ps_pr', 
    '$ps_pr_pgrad', '$ts', '$ts_mngrad', '$ts_tvapht', '$ts_tva2d', '$ts_tr', 
    '$ts_rvsp', '$cardio_finding', '$diag', '$doctor' 
);";
