<?php 
require_once '../bootstrap.php';
require_once 'OpdReceive.php';

$a = new OpdReceive();
$a->hn = '58-2733';
$a->vn = '1';
$a->clinicalinfo = 'ตรวจสุขภาพประกันสังคม';
$a->sOfficer = 'เทสเทสเทส';
$a->orderXray(array('41001'));