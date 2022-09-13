<?php 
include 'bootstrap.php';
// include 'fpdf16/fpdf.php';
include 'fpdf_thai/shspdf.php';
include 'fpdf_thai/fpdf_merge.php';

$merge = new FPDF_Merge();

$db = Mysql::load();

$y = $_GET['y'];
$m = $_GET['m'];

$year_chk = $y + 543;

$db->select("SELECT `hn`,`idcard_img`,`pic_patient`,`amed_stat` FROM `rg_soldier` WHERE `date_certificate` LIKE '$y-$m%' ");
$items = $db->get_items();

$pdf = new SHSPdf('P', 'mm', 'A4');

$path = 'certificate/'.$year_chk.'/';

$zip = new ZipArchive;
$zip->open($path.'export/11512.zip', ZipArchive::CREATE);

foreach ($items as $key => $a) {  
    $hn = $a['hn'];
    $db->select("SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn' ");
    $user = $db->get_item();

    $idcard_img = $a['idcard_img'];
    $pic_patient = $a['pic_patient'];

    if(is_file($path.$idcard_img) && is_file($path.$pic_patient)){
        // เอารูปกับบัตรปะชาชนมาสร้างเป็นไฟล์ pdf
        $pdf->AddPage();
        $pdf->Image($path.$idcard_img, 10,10,120);
        $pdf->Image($path.$pic_patient, 10,110,120);
        $pdf->Output("F",$path.$hn.'_present.pdf');
    }
    
    // เพิ่มไฟล์ที่จะส่ง amedstat ก่อน
    $merge->add($path.$a['amed_stat']);

    if(is_file($path.$hn.'_present.pdf')){
        // ตามด้วยเพิ่มไฟล์ที่เป็นรูป+บัตรปชช
        $merge->add($path.$hn.'_present.pdf');
    }
    
    // ถ้ายังไม่มี folder export ให้สร้างขึ้นมาก่อน
    if( !file_exists($path.'export') ){ mkdir($path.'export'); }

    // Merge ไฟล์ทั้งหมดแล้วสร้างเป็น pdf ตัวใหม่
    $merge->output($path.'export/'.$user['idcard'].'.pdf');

    $zip->addFile($path.'export/'.$user['idcard'].'.pdf', $user['idcard'].'.pdf');

}

$zip->close();

header("Content-type: application/zip"); 
header("Content-Disposition: attachment; filename=11512.zip");
header("Content-length: " . filesize($path.'export/11512.zip'));
header("Pragma: no-cache"); 
header("Expires: 0"); 
readfile($path.'export/11512.zip');
