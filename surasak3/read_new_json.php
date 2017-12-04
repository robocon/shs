<?php
include 'bootstrap.php';
include_once 'includes/JSON.php';

$json = new Services_JSON();

$file = file_get_contents('syncfile/appoint/insert/49-16276.json');
$items = $json->decode($file);
// dump($items);
$new_data = array();
foreach ($items as $key => $item) {
    // $item = str_replace('"','',$item);
    // list($key, $data) = explode(':', $item);
    // dump($key);
    // dump($item->data);
    foreach ($item->data as $key_data => $data) {
        # code...
        dump($key_data);
        dump(urldecode($data));
    }
    // $new_data[$key] = $item;
}
// $new_data['hn'] = '60-4413';
// dump($new_data);
// $output = $json->encode($new_data);
// echo $output;