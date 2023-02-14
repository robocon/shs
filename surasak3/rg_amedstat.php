<?php 
ini_set('memory_limit', '64M');

include 'bootstrap.php';
require_once 'fpdf_thai/shspdf.php';
require_once 'fpdf_thai/fpdf_merge.php';
require_once 'new43file/libs/dZip.inc.php';

$db = Mysql::load();

$y = $_GET['y'];
$m = $_GET['m'];

$year_chk = $y + 543;

$db->select("SELECT `hn`,`idcard_img`,`pic_patient`,`amed_stat` FROM `rg_soldier` WHERE `date_certificate` LIKE '$y-$m%' AND `status`='1' ");
$items = $db->get_items();

$path = 'certificate/'.$year_chk;
$export_path = $path.'/export';
// ถ้ายังไม่มี folder export ให้สร้างขึ้นมาก่อน
if( !file_exists($export_path) ){ mkdir($export_path,0777); }

$zip_lists = array();
foreach ($items as $key => $a) { 
    $hn = $a['hn'];
    $db->select("SELECT `idcard` FROM `opcard` WHERE `hn` = '$hn' ");
    $user = $db->get_item();
    
    // ลบไฟล์เก่าก่อน 
    @unlink($export_path.'/'.$user['idcard'].'.pdf');

    $idcard_img = $a['idcard_img'];
    $pic_patient = $a['pic_patient'];

    if(is_file($path.'/'.$idcard_img) && is_file($path.'/'.$pic_patient)){ 

        // เอารูปกับบัตรปะชาชนมาสร้างเป็นไฟล์ pdf
        $pdf = new SHSPdf('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->Image($path.'/'.$idcard_img, 10,10,120);
        $pdf->Image($path.'/'.$pic_patient, 10,110,120);
        $pdf->Output("F", $path.'/'.$hn.'_preset.pdf');
        $pdf->Close();
        chmod($path.'/'.$hn.'_preset.pdf',0777);

    }
    
    $merge = new FPDF_Merge();
    // เพิ่มไฟล์ที่จะส่ง amedstat ก่อน
    if(is_file($path.'/'.$a['amed_stat'])){
        $merge->add($path.'/'.$a['amed_stat']);
    }

    if(is_file($path.'/'.$hn.'_preset.pdf')){
        // ตามด้วยเพิ่มไฟล์ที่เป็นรูป+บัตรปชช
        $merge->add($path.'/'.$hn.'_preset.pdf');
    }

    // Merge ไฟล์ทั้งหมดแล้วสร้างเป็น pdf ตัวใหม่
    $merge->output($export_path.'/'.$user['idcard'].'.pdf');
    chmod($export_path.'/'.$user['idcard'].'.pdf',0777);

    $zip_lists[] = array(
        'path' => $export_path.'/'.$user['idcard'].'.pdf',
        'name' => $user['idcard'].'.pdf'
    );
}

$RealZipName = 'MED_CERT_11512.zip';
$ZipName = $export_path.'/'.$RealZipName;
@unlink($ZipName);

$zip = new dZip($ZipName);
foreach ($zip_lists as $key => $item) {

    $zip->addFile($item['path'], $item['name']);
}

$zip->save();
chmod($ZipName,0777);

header("Content-type: application/zip"); 
header("Content-Disposition: attachment; filename=".$RealZipName);
header("Content-length: " . filesize($ZipName));
header("Pragma: no-cache"); 
header("Expires: 0"); 
readfile($ZipName);
