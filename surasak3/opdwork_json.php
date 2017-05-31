<?php
include_once 'bootstrap.php';
include_once 'includes/JSON.php';
define('DS', DIRECTORY_SEPARATOR);

$json = new Services_JSON();
$data = array();

foreach ($_POST as $key => $post) {
    $data[$key] = urlencode($post);
}
$data['date'] = date('Y-m-d H:i:s');
$data['status'] = 'update';
$data['hn'] = $cHn;
$output = $json->encode($data);

file_put_contents('/mnt/win/opd/update/'.$cHn.'.json', $output);