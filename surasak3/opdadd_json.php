<?php
include_once 'bootstrap.php';
include_once 'includes/JSON.php';
define('DS', DIRECTORY_SEPARATOR);

/*
[
    {
        "ENTRY_DATE":"20/01/2016",
        "txtName":"Fernido",
        "txtLname":"Torres"
    },
    {
        "ENTRY_DATE":"20/01/2016",
        "txtName":"Supang",
        "txtLname":"Rctwc"
    }
]
*/

// scp -P 21 hello.json administrator@192.168.1.4:/d/Syncweb

$json = new Services_JSON();
$data = array();

foreach ($_POST as $key => $post) {
    $data[] = '"'.$key.'":"'.urlencode($post).'"';
}
$data['date'] = date('Y-m-d H:i:s');
$data['status'] = 'new';
$output = $json->encode($data);

file_put_contents('syncfile/'.$vHN.'.json', $output);

exit;