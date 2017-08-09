<?php
/**
 * DEFAULT VARIABLE
 */
define('ROOT_DIR', realpath(dirname(__FILE__)).'/');
define('EXTENDED_ABLE', 1);
$date_create = date('Y-m-d');
$th_date = ( date('Y') + 543 ).date('-m-d');

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
    file_put_contents(ROOT_DIR.'error_log.log', $error_msg."\n", FILE_APPEND);
}

function set_log( $msg ){
	file_put_contents(ROOT_DIR.'system_log.log', $msg."\n", FILE_APPEND);
}

function query($sql, $link){
    $q = mysql_query($sql, $link);
    if( $q === false ){
        set_error_log( mysql_error() );
    }
    return $q;
}