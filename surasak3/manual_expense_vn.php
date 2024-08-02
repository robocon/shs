<?php 
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include 'bootstrap.php';
require_once 'class_file/opday.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", $_GET['hn']);

$q = $dbi->query("SELECT * FROM `expense_config` WHERE `type` = 'regis' ");
$config = $q->fetch_assoc();

$opday = new Opday();
$res = $opday->getThisDay($hn);
$msg = 'วันนี้ได้ออก VN ไปแล้ว';
if($res===false){
    $opday->setToborow('EX51 ตรวจสุขภาพ อปท.');
    $opday->sOfficer = $config['name'];
    $res = $opday->createOpday($hn);
    $msg = 'ดำเนินการออก VN เรียบร้อย';
}
?>
<table>
    <tr>
        <td colspan="2"><h3><?=$msg;?></h3></td>
    </tr>
    <tr>
        <td align="right"><strong>ชื่อ-สกุล : </strong></td>
        <td><?=$res['ptname'];?></td>
    </tr>
    <tr>
        <td align="right"><strong>VN : </strong></td>
        <td><?=$res['vn'];?></td>
    </tr>
    <tr>
        <td align="right"><strong>สิทธิ์ : </strong></td>
        <td><?=$res['ptright'];?></td>
    </tr>
</table>