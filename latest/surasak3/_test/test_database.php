<?php
include_once dirname(__FILE__).'/../newBootstrap.php';

$db = new Database();
$tbname = '43epi';
$data = array('HOSPCODE'=>'11512','PID'=>'59-1718');
$db->insertData($tbname, $data);