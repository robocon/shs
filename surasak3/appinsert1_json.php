<?php
include_once 'includes/JSON.php';
$json = new Services_JSON();

$appoint_data = array();

$appoint_data[] = array('type' => 'opd', 'data' => $appoint_opd);

if( count($appoint_lab) > 0 ){
    $appoint_data[] = array('type' => 'lab', 'data' => $appoint_lab);
}

if( count($appoint_or) > 0 ){
    $appoint_data[] = array('type' => 'or', 'data' => $appoint_or);
}

$output = $json->encode($appoint_data);

file_put_contents('/mnt/win/appoint/insert/'.$cHn.'.json', $output);