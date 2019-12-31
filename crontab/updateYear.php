#!/usr/bin/php
<?php
$conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $conn) or die( mysql_error() );

$year = date('Y') + 543;
$prev_th_year = substr(( $year - 1 ), 2);
$curr_th_year = substr($year, 2);

$sql = "SELECT `title`,`prefix` FROM  `runno` WHERE `prefix` LIKE  '%$prev_th_year%'";
$query = mysql_query($sql);

$date_now = ( date('Y') + 543 ).date('-m-d H:i:s');
$errors = array();
$success = array();
while( $item = mysql_fetch_assoc($query) ){

	$match = preg_replace('/('.$prev_th_year.')/', $curr_th_year, $item['prefix']);
	
	$title = $item['title'];
	$reset_runno = 0;
	if( $title == 'Medcer' OR $title == 'nid_pt' OR $title == 'nid_c' ){
		$reset_runno = 1;
	}

	$sql = "UPDATE `runno` SET `prefix` = '$match', `runno` = '$reset_runno', `startday` = '$date_now' WHERE `title` = '$title' LIMIT 1 ;";
	$update = mysql_query($sql);
	if( !$update ){
		$errors[] = mysql_error();
	}else{
		$success[] = $sql;
	}
}

define('ROOT_DIR', realpath(dirname(__FILE__)).'/');

$rows = count($errors);
if( $rows > 0 ){

	$content = "MySQL ERROR:\n";
	$content .= implode("\n", $errors);
	file_put_contents(ROOT_DIR.'mysql-errors.log', $content, FILE_APPEND);

}else{

	$content = "Update Successful :)\n";
	$content .= implode("\n", $success);
	file_put_contents(ROOT_DIR.'mysql-errors.log', $content, FILE_APPEND);

}