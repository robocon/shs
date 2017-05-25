<?php
include_once 'includes/JSON.php';
$json = new Services_JSON();

$sql = "SELECT `hn` FROM `appoint` WHERE `row_id` = '$cRow' ";
$q = mysql_query($sql);
$item = mysql_fetch_assoc($q);

$cHn = $item['hn'];

$appoint_delete = array('id' => $cRow, 'hn' => $cHn, 'apptime' => urlencode('ยกเลิกการนัด'));
$output = $json->encode($appoint_delete);

file_put_contents('syncfile/appoint/update/'.$cHn.'.json', $output);