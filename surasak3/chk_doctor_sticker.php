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

$conclution = $user['conclution'];
if( $conclution == 1 ){
    $suggest_list = array(
        1 => 'ไม่ได้ให้คำแนะนำ', 
        'แนะนำให้รับการตรวจต่อเนื่อง ครั้งต่อไปในวันที่'
    );

    $suggest = $user['normal_suggest'];
    $suggest_date = ( $user['normal_suggest_date'] != '0000-00-00' ) ? 'ในวันที่ '.$user['normal_suggest_date'] : '' ;
    
}else{
    $suggest_list = array(
        1 => 'ไม่ได้ให้คำแนะนำ', 
        'ให้คำแนะนำในการตรวจติดตาม/ตรวจซ้ำ ครั้งต่อไป', 
        'ให้คำแนะนำเข้ารับการรักษากรณีเจ็บป่วยโดยนัดเข้ารับบริการ', 
        'ให้คำแนะนำเข้ารักการรักษากรณีภาวะแทรกซ้อนจากโรคเรื้อรัง'
    );

    $suggest = $user['abnormal_suggest'];
    $suggest_date = ( $user['abnormal_suggest_date'] != '0000-00-00' ) ? 'ในวันที่ '.$user['abnormal_suggest_date'] : '' ;
    
}

$suggest_detail = $suggest_list[$suggest];
$conclution_detail = $suggest_detail.$suggest_date;


include 'fpdf_thai/shspdf.php';

$pdf = new SHSPdf('L','mm',array( 80,35 ));
$pdf->SetThaiFont(); // เซ็ตฟอนต์
$pdf->SetAutoPageBreak(true, 2);
$pdf->SetMargins(4, 0);

$pdf->AddPage();

$pdf->SetFont('AngsanaNew','',13); // เรียกใช้งานฟอนต์ที่เตรียมไว้

$test_txt = "ผลการตรวจสุขภาพประจำปี ".$user['yearchk']."\n";
$test_txt .= "ชื่อ : ".$user["prefix"].$user["name"].' '.$user["surname"]." HN : ".$user["hn"]."\n";
$test_txt .= "วันที่ตรวจ : ".$user['date_chk']."\n";
$test_txt .= "สรุปผลการตรวจ : ".( $user['conclution'] == 1 ? 'ปกติ' : 'ผิดปกติ' )."\n";
$test_txt .= "คำแนะนำเพิ่มเติม : ".$conclution_detail."\n";
$test_txt .= "Diag : ".$user['diag']."\n";
$test_txt .= "แพทย์ : ".$user['doctor']."\n";
$pdf->MultiCell(0, 4, $test_txt, 0);

$pdf->AutoPrint(true);
$pdf->Output();
exit;
?>