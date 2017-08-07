<?php
/**
 * DEFAULT VARIABLE
 */
define('ROOT_DIR', realpath(dirname(__FILE__)).'/');
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

/**
 * CONNECTION 
 * ถ้าใช้ Query กับ Drcom จะใช้ $drcom เป็น link_identifier เช่น
 * mysql_query('// Do some select', $drcom)
 *
 * แต่ถ้า Query กับ รพ. จะเป็น $shs
 * 
 * อ่านต่อ http://php.net/manual/en/function.mysql-query.php
 */
$drcom = mysql_connect('192.168.1.4','surasak','1234') or die( set_error_log( mysql_error() ) );
mysql_select_db('sync', $drcom ) or die( set_error_log( mysql_error() ) );
mysql_query("SET NAMES UTF8", $drcom);

$shs = mysql_connect('localhost','root','1234') or die( set_error_log( mysql_error() ) );
mysql_select_db('smdb_drcom', $shs) or die( set_error_log( mysql_error() ) );

// !!!! ระวังตอนเอาขึ้นเซิฟเวอร์ !!!! บางทีมันจะไม่อ่าน
mysql_query("SET NAMES TIS620", $shs);