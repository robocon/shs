<?php 

function genSEQ($date, $vn, $clinicName){ 
    global $db;

    if ( preg_match('/(\d+)\s(.+)/', $clinicName, $matchs) > 0 ) {
        
        $clinicCode = $matchs['1'];

    }elseif( $clinicName !== null ){
        $db->select("SELECT `code` FROM `f43_clinic` WHERE `detail` = '$clinicName' ");
        $clinicDb = $db->get_item();
        $clinicCode = $clinicDb['code'];
    }else{
        $clinicCode = '99';
    }

    $s1 = date('Ymd', strtotime($date));
    $newHn = sprintf('%06d', $vn);
    return $s1.$clinicCode.$newHn;
}

?>