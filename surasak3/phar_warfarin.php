<?php
// phpinfo();
// exit;
include 'bootstrap.php';

// @todo
// [] หน้าเมนูหน้าค้นหา hn ที่เป็น history
// [] หน้าแบบฟอร์มที่เพิ่มข้อมูลต่างๆ จาก HN




$action = input('action');
$page = input('page');

if( $action === 'save_intervention' ){
	
	dump($_POST);
	
	$sql = "INSERT INTO  `phar_intervention` (  `id` ,  `phar_id` ,  `date_add` ,  `date_inter` ,  `detail` ) 
	VALUES (
	'',  '4',  '2559-05-31 11:59:12',  '2559-05-31',  'test'
	);";
	
	exit;
}



//หน้าการแสดงผลต่างๆ
include 'templates/classic/header.php';
include 'templates/warfarin/nav.php';
if( $page === false ){
	
} else if( $page === 'intervention' ){
	
	$id = input_get('id');
	$date_val = get_date_ad(false);
	include 'templates/warfarin/intervention_form.php';
	
} else if( $page === 'inr' ){
	
	include 'templates/warfarin/intervention_form.php';
	
}
include 'templates/classic/footer.php';