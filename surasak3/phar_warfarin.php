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

// Load Guide Navigation ถ้าไม่ใช่หน้าหลัก
if( $page !== false ){
	include 'templates/warfarin/form_nav.php';
}

if( $page === false ){
	
} else if( $page === 'intervention' ){
	
	$id = input_get('id');
	$date_val = get_date_ad(false);
	
	
	include 'templates/warfarin/intervention_form.php';
	
} else if( $page === 'inr' ){
	
	$id = input_get('id');
	
	
	include 'templates/warfarin/inr_form.php';
	
} else if( $page === 'warfarin' ){
	
	$id = input_get('id');
	
	
	
} else if( $page === 'adr' ){
	
	$id = input_get('id');
	
	
	
} else if( $page === 'inr6' ){
	
	$id = input_get('id');
	
	
	
} else if( $page === 'inr1_5' ){
	
	$id = input_get('id');
	
	
	
} else if( $page === 'inr_range' ){
	
	$id = input_get('id');
	
	
	
}
include 'templates/classic/footer.php';