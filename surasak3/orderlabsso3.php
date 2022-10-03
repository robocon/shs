<?php 
require_once 'bootstrap.php';
require_once 'class_file/OpdReceive.php';

$dbi = new mysqli(HOST,USER,PASS,DB);

$hn = $_REQUEST['hn'];
$vn = $_REQUEST['vn'];

// เอา $_REQUEST['labSelect'] มาแยกก่อนว่าเป็นเงินสดกี่บาท 
// และเป็นประกันสังคมกี่บาท ตามรายการที่พี่อึ่งให้มาในไฟล์ excel
dump($_REQUEST['labSelect']);

!!! แยกการเพิ่มรายการ เพราะการคีย์ค่าใช้จ่าย ห้องแลป กับ ห้อง Xray ไม่เหมือนกัน

$a = new OpdReceive();
$a->hn = $hn;
$a->vn = $vn; 
$a->clinicalinfo = 'ตรวจสุขภาพประจำปี66';
$a->sOfficer = $_SESSION['sOfficer'];
//     // $a->custom_labnumber = '6509200301';
$a->orderLab($_REQUEST['labSelect']);

/**
 * what am i doing next
 * [x] กลับไปดูหน้าตรวจสุขภาพทหารว่าบันทึกแล้วทำอะไรต่อ
 * [] ปริ้นสติกเกอร์แลป??
 * [] เพิ่มลิ้งกลับไปหน้าแรก??
 * [] แสดงรายการที่เคยคิดค่าใช้จ่ายไปแล้วในหน้าเลือกผลแลป
 *      [] แยกด้วยว่าเป็น ปกส.กี่บาท
 *      [] เป็นเงินสดกี่บาท
 * [] ตามข้อด้านบน คือจะให้คำนวณค่าใช้จ่ายที่แยกจากไฟล์ excel ของพี่อึ่งรึป่าว ???
 */

/**
 * Requirement เพิ่มเติมในวันที่ 23-09-65 คือ
 * พี่สมยศบอกว่า ผอ. ให้ตรวจแลปทุกคนเหมือนๆกัน เพราะฉะนั้นก็จะเหลือที่จะต้องคุยกับพี่อึ่งก็คือ
 * - การเงินจะแยกรายการรึป่าว ว่านาย A ใช้สิทธิประกันสังคมไปกี่บาท แล้วที่เหลือเป็นเงินสดที่ต้องจ่ายอีกกี่บาท
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

