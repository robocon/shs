<?php
include 'bootstrap.php';
include_once 'includes/JSON.php';

$json = new Services_JSON();

$file = file_get_contents('http://192.168.1.2/sm3/surasak3/syncfile/appoint/insert/47-767.json');
$items = $json->decode($file);

$new_data = array();
foreach ($items as $key => $item) {

    foreach ($item->data as $key_data => $data) {
        
        dump($key_data);
        dump(urldecode($data));
    }

}
