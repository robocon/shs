<?php
function dump($data = null){ 

    $prefix = hash_hmac("sha256", uniqid(), uniqid());
    $start = rand(1,20);
    $data = substr($prefix,$start,32);
    assert(strlen($data) == 16);
    // Set version to 0100
    $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    $data[8] = chr(ord($data[8]) & 0x3f | 0x80);


    var_dump($data);

    // $data = $data ?? random_bytes(16);
    // assert(strlen($data) == 16);
    
    // Set version to 0100
    // $data[6] = chr(ord($data[6]) & 0x0f | 0x40);
    // Set bits 6-7 to 10
    // $data[8] = chr(ord($data[8]) & 0x3f | 0x80);

    // $test1 = bin2hex($data);
    // var_dump($test1);
    // $test = str_split(bin2hex($data), 4);
    // var_dump($test);

    // preg_match("/(\w{0,8})(\w{0,4})(\w{0,4})(\w{0,4})(\w{0,12})/", $test1, $matchs);

    // var_dump($matchs);

    // $test = $matchs[1].'-'.$matchs[2].'-'.$matchs[3].'-'.$matchs[4].'-'.$matchs[5];
    // var_dump($test);
    // vsprintf("%04d%04d%04d%04d%04d%04d%04d%04d", $test);
    // Output the 36 character UUID.
    // vsprintf('%s%s-%s-%s-%s-%s%s%s', $test);
    // return vsprintf('%s%s-%s-%s-%s-%s%s%s', str_split(bin2hex($data), 4));
}
dump();