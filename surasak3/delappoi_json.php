<?php
include_once 'includes/JSON.php';
$json = new Services_JSON();

$appoint_delete = array('id' => $cRow, 'apptime' => urlencode('ยกเลิกการนัด'));
$output = $json->encode($appoint_delete);

file_put_contents('syncfile/appoint/update/'.$cHn.'.json', $output);