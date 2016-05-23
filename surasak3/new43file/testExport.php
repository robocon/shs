<?php
session_start();
include '../includes/functions.php';
// header('Content-Type: text/html; charset=TIS-620');
$Conn = mysql_connect('192.168.1.2', 'remoteuser', '') or die( mysql_error() );
mysql_select_db('smdb', $Conn) or die( mysql_error() );
// mysql_query("SET NAMES TIS620", $Conn);


$dateSelect = '2559-05';

list($thiyr, $rptmo) = explode('-', $dateSelect);
	
$dirPath = "export/$thiyr/$rptmo";

if( !is_dir("export/$thiyr") ){
    mkdir("export/$thiyr", 0777);
}

if( !is_dir($dirPath) ){
    mkdir($dirPath, 0777);
}

// define default val
// $newyear = "$thiyr$rptmo$day";
$thimonth = "$thiyr-$rptmo"; // e.g. 2559-05
$yrmonth = ( $thiyr - 543 )."-$rptmo"; // e.g. 2016-05
$yy = 543;
$hospcode = '11512';
$zipLists = array();
$qofLists = array();

$start = time() + microtime();
include 'libs/person.php';
$stop = time() + microtime();
$lasttime = round(($stop - $start), 6);
dump($lasttime);