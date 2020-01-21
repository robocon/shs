<?php 

function genSEQ($date, $hn){

    $s1 = date('Ymd', strtotime($date));
    list($prefix, $number) = explode('-', $hn);
    $newHn = $prefix.( sprintf('%05d', intval($nubmer)) );

    return $s1.$newHn;
}

?>