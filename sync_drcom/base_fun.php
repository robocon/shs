<?php
if ( !defined('EXTENDED_ABLE') ) { exit; }

/**
 * DEFAULT FUNCTION
 */
function dump($txt){
    echo "<pre>";
    var_dump($txt);
    echo "</pre>";
}

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY = substr($birth,0,4)-543;
	$bM = substr($birth,5,2);
	$ageY = $nY-$bY;
	$ageM = $nM-$bM;

	if ($ageM< 0 ) {
		$ageY = $ageY-1;
		$ageM = 12+$ageM;
	}

	if ($ageM == 0){
		$pAge = "$ageY ปี";
	}else{
		$pAge = "$ageY ปี $ageM เดือน";
	}

    return $pAge;
}

function to_tis620($txt){
    $txt = iconv('UTF-8', 'TIS-620', $txt);
    return $txt;
}

function set_error_log( $error_msg ){
	base_log('error_log.log', $error_msg);
}

function set_system_log( $msg ){
	base_log('system_log.log', $msg);
}

function base_log($file_name, $msg){
	file_put_contents(ROOT_DIR.$file_name, $msg."\n", FILE_APPEND);
}

function query($sql, $link){
    $q = mysql_query($sql, $link);
    if( $q === false ){
        set_error_log( mysql_error() );
    }
    return $q;
}