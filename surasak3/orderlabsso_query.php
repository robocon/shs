<?php 
require_once 'bootstrap.php';
include 'includes/JSON.php';

$json = new Services_JSON();
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_REQUEST['action']);
if($action==='findlab'){
    $depart = sprintf("%s", $_GET['depart']);
    $part = sprintf("%s", $_GET['part']);
    $code = sprintf("%s", $_GET['code']);

    $andDepart = '';
    if(!empty($depart)){
        $andDepart = " AND depart = '$depart' ";
    }

    $andPart = '';
    if(!empty($part)){
        $andPart = " AND part = '$part' ";
    }

    $sql = "SELECT * FROM labcare WHERE code LIKE '%$code%' AND labstatus = 'Y' $andDepart $andPart";
    $q = $dbi->query($sql);
    $items = array();
    if($q->num_rows>0){
        while ($a = $q->fetch_assoc()) {
            $items[] = $a;
        }
    }
    $res = array(
        'count' => count($items),
        'list' => $items
    );
    echo $json->encode($res);
    exit;
}