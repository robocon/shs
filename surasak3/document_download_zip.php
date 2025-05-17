<?php
require_once 'bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$id = $_GET['doc_id'];

$sql = sprintf("SELECT `doc_id`,`doc_date` FROM `document` WHERE `doc_id` = '%s' LIMIT 1", $dbi->real_escape_string($id));
$q = $dbi->query($sql);
if($q->num_rows>0){
    $dirname = dirname(__FILE__);
    
    $doc = $q->fetch_assoc();
    $document_name = strtotime($doc['doc_date']);
    $filePath = $dirname.'/document_file';
    $zipName = $document_name.'.zip';

    header($_SERVER['SERVER_PROTOCOL'].' 200 OK');
    header("Content-Type: application/zip");
    header("Content-Transfer-Encoding: Binary");
    header("Content-Length: ".filesize($filePath.'/'.$zipName));
    header("Content-Disposition: attachment; filename=\"$zipName\"");
    readfile($filePath.'/'.$zipName);
}