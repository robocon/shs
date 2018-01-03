#!/usr/bin/php
<?php
$conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $conn) or die( mysql_error() );

$year = date('Y') + 543;
$prev_th_year = substr(( $year - 1 ), 2);
$curr_th_year = substr($year, 2);

// $prev_th_year = 60;
// $curr_th_year = 61;

$errors = array();
$sql = "SELECT `title`,`prefix`
FROM  `runno`
WHERE `prefix` LIKE  '%$prev_th_year%'";
$query = mysql_query($sql);

$date_now = ( date('Y') + 543 ).date('-m-d H:i:s');

while( $item = mysql_fetch_assoc($query) ){

	$match = preg_replace('/('.$prev_th_year.')/', $curr_th_year, $item['prefix']);
	
	$title = $item['title'];
	$reset_runno = 0;
	if( $title == 'Medcer' OR $title == 'nid_pt' OR $title == 'nid_c' ){
		$reset_runno = 1;
	}

	$sql = "UPDATE `runno` SET 
	`prefix` = '$match', 
	`runno` = '$reset_runno', 
	`startday` = '$date_now'
	WHERE `title` = '$title' LIMIT 1 ;";
	$update = mysql_query($sql);

	$errors = array();
	if( $update === false ){
		$errors[] = mysql_error();
	}
}

$rows = count($errors);
if( $rows > 0 ){
	$content = "MySQL ERROR:\n";
	$content .= implode("\n", $errors);
	file_put_contents('mysql-errors.log', $content, FILE_APPEND);
}else{
	$content = "Update Successful :)\n";
	file_put_contents('mysql-errors.log', $content, FILE_APPEND);
}