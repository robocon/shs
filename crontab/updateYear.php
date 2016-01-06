#!/usr/bin/php
<?php
$conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $conn) or die( mysql_error() );

$year = date('Y') + 543;
$prev_th_year = substr(( $year - 1 ), 2);
$curr_th_year = substr($year, 2);

$table = 'runno';

$errors = array();
$sql = "SELECT `title`,`prefix`
FROM  `$table`
WHERE `prefix` LIKE  '%$prev_th_year%'";
$query = mysql_query($sql);
while( $item = mysql_fetch_assoc($query) ){

	$match = preg_replace('/('.$prev_th_year.')/', $curr_th_year, $item['prefix']);
	$title = $item['title'];
	$sql = "UPDATE `$table` SET `prefix` = '$match' WHERE `title` = '$title' LIMIT 1 ;";
	$update = mysql_query($sql);

	if( $update === false ){
		$errors[] = mysql_error();
	}
}

$rows = count($errors);
if( $rows > 0 ){
	$content = "MySQL ERROR:\n";
	$content .= implode("\n", $errors);
	file_put_contents('mysql-errors.log', $content, FILE_APPEND);
	print $content;
}else{
	$content = "Update Successful :)\n";
	file_put_contents('mysql-errors.log', $content, FILE_APPEND);
	print $content;
}