#!/usr/bin/php
<?php
#header('Content-Type: text/html; charset=utf-8');

$conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $conn) or die( mysql_error() );
#mysql_query("SET NAMES UTF8", $conn);

include_once '/var/www/html/sm3/surasak3/includes/functions.php';
include_once '/var/www/html/sm3/surasak3/includes/cu_sso.php';

$sso = new CU_SSO();

### ไม่สนใจ runno ตามเลข running number อยู่แล้ว เพราะรันหลังเที่ยงคืนเป็นอันดับแรก ###

# Lock ให้ write ไม่ให้ read
$sql_lock = "LOCK TABLES 
`runno` WRITE, 
`orderhead` WRITE, 
`orderdetail` WRITE, 
`labcare` READ, 
`opcardchk` AS a READ,  
`opcard` AS b READ ; ";
mysql_query($sql_lock, $conn) or die( mysql_error() );

# เตรียมข้อมูล labcare ก่อน จะได้ไม่ได้ต้อง query หลายรอบ
$sql = "SELECT `code`,`oldcode`,`detail`,`price`,`yprice`,`nprice` 
FROM `labcare` 
WHERE `code` LIKE '%-sso'";
$q = mysql_query($sql, $conn) or die( mysql_error() );
$lab_lists = array();
while( $lab = mysql_fetch_assoc($q) ){
    $code = $lab['code'];
    $lab_lists[$code] = $lab;
}

# Default variable
$last_labnumber = false;
$checkup_date_code = '170501';
$thai_date = (date("Y")+543)."-".date("m-d H:i:s");
$en_date = date("Y-m-d H:i:s");
$clinicalinfo = 'ตรวจสุขภาพประกันสังคม60';
$part = 'นิยมพานิช60';
# Default variable

$user_i = 1;

$sql = "SELECT a.*,
b.`idcard`,b.`sex`,CONCAT((SUBSTRING(b.`dbirth`,1,4) - 543),SUBSTRING(b.`dbirth`,5,15)) AS `dbirth`
FROM `opcardchk` AS a 
LEFT JOIN `opcard` AS b ON b.`hn` = a.`hn` 
WHERE a.`part` = '$part' 
ORDER BY a.`row` ASC";
$q = mysql_query($sql, $conn) or die( mysql_error() );

while( $item = mysql_fetch_assoc($q) ){ 
	
    $hn = $item['HN'];
    $last_labnumber = $exam_no = $item['exam_no'];
    $labnumber = $checkup_date_code.$exam_no;
    $age_year = substr($item['dbirth'], 0, 4) + 543 ;
    $sex = ( $item['sex'] === 'ช' ) ? 1 : 2 ;
    $ptname = $item['name'].' '.$item['surname'];
    $gender = ( $item['sex'] === 'ช' ) ? 'M' : 'F' ;
    $dbirth = $item['dbirth'];

    $all_lists = $sso->get_checkup_from_age($item['agey'], $age_year, $sex);

    # ตัดรายการของ xray ออกไปก่อน
    if( ( $search_key = array_search('41001-sso',$all_lists) ) !== false ){
        unset($all_lists[$search_key]);
    }

	# orderhead
	$orderhead_sql = "INSERT INTO `orderhead` ( 
		`autonumber`, 
		`orderdate`, 
		`labnumber`, 
		`hn`, 
		`patienttype`, 
		`patientname`, 
		`sex`, 
		`dob`, 
		`sourcecode`, 
		`sourcename`, 
		`room`, 
		`cliniciancode`, 
		`clinicianname`, 
		`priority`, 
		`clinicalinfo` 
	) VALUES (
		'', 
		'$en_date', 
		'$labnumber', 
		'$hn', 
		'OPD', 
		'$ptname', 
		'$gender', 
		'$dbirth', 
		'', 
		'', 
		'', 
		'', 
		'MD022 (ไม่ทราบแพทย์)', 
		'R', 
		'$clinicalinfo'
	);";
	mysql_query($orderhead_sql, $conn) or die( mysql_error() );

	foreach ($all_lists as $key => $list) {
		$lab_item = $lab_lists[$list];
		$code = $lab_item['code'];
		$oldcode = $lab_item['oldcode'];
		$detail = $lab_item['detail'];

		$orderdetail_sql = "INSERT INTO `orderdetail` ( 
			`labnumber`,`labcode`,`labcode1`,`labname` 
		) VALUES (
			'$labnumber', '$code', '$oldcode', '".$detail."'
		);";
		mysql_query($orderdetail_sql, $conn) or die( mysql_error() );
	}

	// if( $user_i === 1 ){
	// 	exit;
	// }
}

$update_date = date('Y-m-d');

// update runno
$sql = "UPDATE `runno` SET  
`runno` =  '$last_labnumber',
`startday` =  '$update_date'
WHERE  `title` = 'lab' 
AND  `prefix` = '' 
LIMIT 1 ;";
mysql_query($sql, $conn) or die( mysql_error() );


// หลังจากที่ write แล้วค่อยปล่อย lock
mysql_query("UNLOCK TABLES ;", $conn) or die( mysql_error() );