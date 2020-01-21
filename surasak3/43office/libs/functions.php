<?php 

function genSEQ($date, $hn){
    $s1 = date('Ymd', strtotime($date));
    list($prefix, $HnNumber) = explode('-', $hn);
    $newHn = sprintf('%05d', $HnNumber);
    return $s1.$prefix.$newHn;
}

?>