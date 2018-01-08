<?php
include 'bootstrap.php';

$db = Mysql::load();

$hn = input_get('hn');
$vn = input_get('vn');
$date = input_get('date');

# ข้อมูลผู้ป่วย
$sql = "SELECT a.*, b.`ptffone`, b.`phone`
FROM `chk_doctor` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`hn` = '$hn' 
AND a.`vn` = '$vn' 
AND a.`date_chk` LIKE '$date%' ";
$db->select($sql);
$user = $db->get_item();

include 'fpdf_thai/shspdf.php';

$pdf = new SHSPdf('L','mm',array( 80,35 ));
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(0, 0);

$pdf->AddPage();

$pdf->SetFont('AngsanaNew','',13); // เรียกใช้งานฟอนต์ที่เตรียมไว้

$test_txt = "ผลการตรวจสุขภาพประจำปี ".$user['yearchk']."\n";
$test_txt .= "ชื่อ : ".$user["prefix"].$user["name"].' '.$user["surname"]." HN : ".$user["hn"]."\n";
$test_txt .= "วันที่ตรวจ : ".$user['date_chk']."\n";
$test_txt .= "สรุปผลการตรวจ : ".( $user['conclution'] == 1 ? 'ปกติ' : 'ผิดปกติ' )."\n";
$test_txt .= "คำแนะนำเพิ่มเติม : ".$user['suggestion']."\n";
$test_txt .= "แพทย์ : ".$user['doctor']."\n";
$pdf->MultiCell(0, 4, $test_txt, 0);

$pdf->AutoPrint(true);
$pdf->Output();
exit;
?>