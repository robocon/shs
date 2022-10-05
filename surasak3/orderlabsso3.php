<?php 
require_once 'bootstrap.php';
require_once 'class_file/OpdReceive.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

$hn = $_REQUEST['hn'];
$vn = $_REQUEST['vn'];

$a = new OpdReceive();
$a->hn = $hn;
$a->vn = $vn; 
$a->clinicalinfo = 'ตรวจสุขภาพประจำปี66';
$a->sOfficer = $_SESSION['sOfficer'];
$a->orderLab($_REQUEST['labSelect']);

/**
 * what am i doing next
 * [x] กลับไปดูหน้าตรวจสุขภาพทหารว่าบันทึกแล้วทำอะไรต่อ
 * [] ปริ้นสติกเกอร์แลป??
 * [] เพิ่มลิ้งกลับไปหน้าแรก??
 */

 /**
  * 
หมดรายการใบแจ้งหนี้
http://192.168.131.250/sm3/surasak3/labofyeartranx.php?pro=3

สติกเกอร์
http://192.168.131.250/sm3/surasak3/labslip4bc_chkup_solider.php

สติกเกอร์ CBC
http://192.168.131.250/sm3/surasak3/labslip4cbc_chkup_solider.php

สติกเกอร์ UA
http://192.168.131.250/sm3/surasak3/labslip4ua_chkup_solider.php
  */

// echo "บันทึกข้อมูลเรียบร้อย";
?>
<p>บันทึกข้อมูลเรียบร้อย</p>
<p><a href="orderlabsso.php">กลับไปหน้าแรก</a></p>

