<?php
$dirname = dirname(__FILE__);
require_once $dirname.'/bootstrap.php';
require_once $dirname."/dZip.inc.php";
require_once $dirname.'/includes/JSON.php';

$json = new Services_JSON();

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES utf8");

$id = $_GET['doc_id'];

$sql = sprintf("SELECT `doc_id`,`doc_date` FROM `document` WHERE `doc_id` = '%s' LIMIT 1", $dbi->real_escape_string($id));
$q = $dbi->query($sql);
if($q->num_rows>0){
    $doc = $q->fetch_assoc();

    $document_name = strtotime($doc['doc_date']);
    $document_id = $doc['doc_id'];
    $zipName = $document_name.'.zip';

    $filePath = $dirname.'/document_file';
    @unlink($filePath.'/'.$zipName);
    
    $sqlFile = sprintf("SELECT `file_name` FROM `document_file` WHERE `doc_id` = '%s'", $dbi->real_escape_string($document_id));
    $qFile = $dbi->query($sqlFile);
    if($qFile->num_rows>0){

        $items = array();
        while ($a = $qFile->fetch_assoc()) {
            if(file_exists($filePath.'/'.$a['file_name'])){
                $items[] = $a['file_name'];
         
            }
        }

        if(count($items)>0){
            $zip = new dZip($filePath.'/'.$zipName);
            foreach ($items as $item) {
                $zip->addFile($filePath.'/'.$item, $item);
            }
            $zip->save();

            $res = array('status'=>200, 'message'=>'สร้างไฟล์ zip เรียบร้อย');
            
        }else{
            $res = array('status'=>400, 'message'=>'ไม่พบข้อมูล');
        }

    }else{
        $res = array('status'=>400, 'message'=>'ไม่พบไฟล์');
    }
    
}else{
    $res = array('status'=>400, 'message'=>'ไม่พบเอกสาร');
}

echo $json->encode($res);