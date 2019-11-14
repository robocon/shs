<?php
session_start();

// Open for show error
// ini_set('display_errors',1);
// ini_set('display_startup_errors',1);
// error_reporting(-1);

include 'connect.inc';

function dump($txt){
	echo "<pre>";
	var_dump($txt);
	echo "</pre>";
}

/**
 * @todo 
 * ปรับเงื่อนไขใหม่โดยให้ lock เป็น หลังทุกวันที่ 5 ของแต่ละเดือนให้ระบบ lock ไม่ให้กรอกเลย
 */
$_POST["nonconf_time"] = $_POST["nonconf_time1"].":".$_POST["nonconf_time2"].":00";

list($form_y, $form_m, $form_d) = explode('-', $_POST['nonconf_date']);
$form_date = ($form_y - 543)."-$form_m-$form_d ".$_POST["nonconf_time"];

$form_date_month = ($form_y - 543).'-'.$form_m;
$test_date_month = date('Y-m');

$now = date('Y-m-d H:i:s');
$date_5 = date('Y-m-05 23:59:59');

$time_now = strtotime($now);
$time5 = strtotime($date_5);

$form_time = strtotime($form_date);


if( empty($_SESSION['Namencr']) && ( $_SESSION['Namencr'] != 'นิธิวดี' && $_SESSION['Namencr'] != 'admin' ) ){

	// ถ้ามีการลงข้อมูลย้อนหลังที่ต่างเดือนกัน
	if( $form_date_month != $test_date_month ){

		if( $time_now > $time5 ){

			echo "<b>RM งดการรายงานย้อนหลัง</b><br>";
			echo '<a href="ncf2.php">กลับไปหน้าบันทึกรายงาน</a>';
			exit;

		}

	}

}


$q = mysql_query("SELECT `last_update_runno` FROM `runno` WHERE `title` = 'NCR';");
$item = mysql_fetch_assoc($q);

// ทำการเปรียบเทียบเดือน ถ้ามีการเปลี่ยนเดือนให้เริ่มเลข runno ใหม่
// แต่ถ้าไม่ใช่ให้เพิ่มเลข runno +1 
$unix_time = strtotime($item['last_update_runno']);
$test_month = date('n'); // Current month
$runno_month = date('n', $unix_time); // Month from database

if($test_month != $runno_month){ // if month has change will reset runno to 1
	$sql = "UPDATE `runno` 
	SET `runno` = '1' , `last_update_runno` = '$now' 
	WHERE `title` = 'NCR'";
}else{ // if month not change
	$sql = "UPDATE `runno` 
	SET `runno` = `runno` + 1 , `last_update_runno` = '$now' 
	WHERE `title` = 'NCR'";
}
$update = mysql_query($sql) or die( mysql_error($Conn) );
if( $update === false ){
	echo "ไม่สามารถอัพเดทเลขรันได้ กรุณาติดต่อผู้ดูแลระบบ";
	exit;
}

// Get last runno again
$q = mysql_query("SELECT `runno` FROM `runno` WHERE `title` = 'NCR';");
$item = mysql_fetch_assoc($q);


// if($_POST['ncr']==''){
// 	$ncr='000';
// }else{
// 	$ncr=$_POST['ncr'];
// }

include '../includes/JSON.php';
$json = new Services_JSON();
$data = $json->encode($_POST);
$officer = ( !empty($_POST['officer']) ? urlencode($_POST['officer']) : $_POST['sRowid'] ) ;

// ALTER TABLE `dbconform`.`ncr_log` 
// CHARACTER SET = latin1 , COLLATE = latin1_general_ci ;
$sql = "INSERT INTO `ncr_log`
(`id`,`officer`,`data`,`date`)
VALUES
(NULL,'$officer','$data',NOW());";
mysql_query($sql) or die( mysql_error() );

/**
 *ALTER TABLE `ncr2556` ADD `date_edit` DATETIME NULL ,
 * ADD `date_print` DATETIME NULL ;
*/

/* 
เพิ่มช่องข้อ 9
ALTER TABLE `ncr2556` ADD `topic9_1` VARCHAR(4) NULL,
ADD `topic9_2` VARCHAR(4) NULL,
ADD `topic9_3` VARCHAR(4) NULL,
ADD `topic9_4` VARCHAR(4) NULL,
ADD `topic9_5` TEXT NULL;
*/

function to_int($post){
	$res = 0;
	if( !empty($post) ){
		$res = $post;
	}
	return $res;
}

$topic1_1 = to_int($_POST['topic1_1']);
$topic1_2 = to_int($_POST['topic1_2']);
$topic1_3 = to_int($_POST['topic1_3']);
$topic1_4 = to_int($_POST['topic1_4']);
$topic1_5 = to_int($_POST['topic1_5']);
$topic1_6 = to_int($_POST['topic1_6']);

$topic2_1 = to_int($_POST['topic2_1']);
$topic2_2 = to_int($_POST['topic2_2']);
$topic2_3 = to_int($_POST['topic2_3']);
$topic2_4 = to_int($_POST['topic2_4']);
$topic2_5 = to_int($_POST['topic2_5']);
$topic2_6 = to_int($_POST['topic2_6']);

$topic3_1 = to_int($_POST['topic3_1']);
$topic3_2 = to_int($_POST['topic3_2']);
$topic3_3 = to_int($_POST['topic3_3']);

$topic4_1 = to_int($_POST['topic4_1']);
$topic4_2 = to_int($_POST['topic4_2']);
$topic4_3 = to_int($_POST['topic4_3']);
$topic4_4 = to_int($_POST['topic4_4']);
$topic4_5 = to_int($_POST['topic4_5']);

$topic5_1 = to_int($_POST['topic5_1']);
$topic5_2 = to_int($_POST['topic5_2']);
$topic5_3 = to_int($_POST['topic5_3']);
$topic5_4 = to_int($_POST['topic5_4']);
$topic5_5 = to_int($_POST['topic5_5']);
$topic5_6 = to_int($_POST['topic5_6']);
$topic5_7 = to_int($_POST['topic5_7']);
$topic5_8 = to_int($_POST['topic5_8']);
$topic5_9 = to_int($_POST['topic5_9']);
$topic5_10 = to_int($_POST['topic5_10']);

$topic6_1 = to_int($_POST['topic6_1']);
$topic6_2 = to_int($_POST['topic6_2']);
$topic6_3 = to_int($_POST['topic6_3']);
$topic6_4 = to_int($_POST['topic6_4']);

$topic7_1 = to_int($_POST['topic7_1']);
$topic7_2 = to_int($_POST['topic7_2']);
$topic7_3 = to_int($_POST['topic7_3']);
$topic7_4 = to_int($_POST['topic7_4']);
$topic7_5 = to_int($_POST['topic7_5']);
$topic7_6 = to_int($_POST['topic7_6']);

$topic8_1 = to_int($_POST['topic8_1']);
$topic8_2 = to_int($_POST['topic8_2']);
$topic8_3 = to_int($_POST['topic8_3']);
$topic8_4 = to_int($_POST['topic8_4']);
$topic8_5 = to_int($_POST['topic8_5']);
$topic8_6 = to_int($_POST['topic8_6']);
$topic8_7 = to_int($_POST['topic8_7']);
$topic8_8 = to_int($_POST['topic8_8']);
$topic8_9 = to_int($_POST['topic8_9']);
$topic8_10 = to_int($_POST['topic8_10']);

$topic9_1 = $_POST['topic9_1'];
$topic9_2 = $_POST['topic9_2'];
$topic9_3 = $_POST['topic9_3'];
$topic9_4 = $_POST['topic9_4'];
$topic9_5 = $_POST['topic9_5'];
$topic9_6 = $_POST['topic9_6'];

$risk1 = to_int($_POST['risk1']);
$risk2 = to_int($_POST['risk2']);
$risk3 = to_int($_POST['risk3']);
$risk4 = to_int($_POST['risk4']);
$risk5 = to_int($_POST['risk5']);
$risk6 = to_int($_POST['risk6']);
$risk7 = to_int($_POST['risk7']);
$risk8 = to_int($_POST['risk8']);
$risk9 = to_int($_POST['risk9']);

$sql="INSERT INTO `ncr2556` (
	`ncr` , `until` , `nonconf_date` , `nonconf_time` , `event` , `come_from_id` , 
	`come_from_detail` , `topic1_1` , `topic1_2` , `topic1_3` , `topic1_4` , `topic1_5` , 
	`topic1_6` , `topic1_7` , `topic2_1` , `topic2_2` , `topic2_3` , `topic2_4` , 
	`topic2_5` , `topic2_6` , `topic2_7` , `topic3_1` , `topic3_2` , `topic3_3` , 
	`topic3_4` , `topic4_1` , `topic4_2` , `topic4_3` , `topic4_4` , `topic4_5` , 
	`topic4_6` ,`topic5_1` , `topic5_2` , `topic5_3` , `topic5_4` , `topic5_5` , 
	`topic5_6` , `topic5_7` , `topic5_8` , `topic5_9` , `topic5_10` , `topic5_11` , 
	`topic6_1` , `topic6_2` , `topic6_3` , `topic6_4` , `topic6_5` , `topic7_1` , 
	`topic7_2` , `topic7_3` , `topic7_4` , `topic7_5` , `topic7_6` , `topic7_7` , 
	`topic8_1` , `topic8_2` , `topic8_3` , `topic8_4` , `topic8_5` , `topic8_6` , 
	`topic8_7` , `topic8_8` , `topic8_9` , `topic8_10` , `topic8_11` , `clinic` , 
	`quality` , `cpno` , `risk1` , `risk2` , `risk3` , `risk4` , 
	`risk5` , `risk6` , `risk7` , `risk8` , `risk9` , `sum_up` , 
	`problem` , `protect` , `head_name` , `menucode` , `officer`, `insert_date`, 
	`topic9_1`, `topic9_2`, `topic9_3`, `topic9_4`, `topic9_5`, `topic9_6`)
VALUES (
	'".$item['runno']."', '".$_POST['until']."', '".$_POST['nonconf_date']."', '".$_POST['nonconf_time']."', '".$_POST['event']."', '".$_POST['come_from_id']."',
	'".$_POST['come_from_detail']."', '$topic1_1', '$topic1_2', '$topic1_3', '$topic1_4', 
	'$topic1_5', '$topic1_6', '".nl2br(trim($_POST['topic1_7']))."', '$topic2_1', 
	'$topic2_2', '$topic2_3', '$topic2_4', '$topic2_5', 
	'$topic2_6', '".nl2br(trim($_POST['topic2_7']))."', '$topic3_1', '$topic3_2', 
	'$topic3_3', '".nl2br(trim($_POST['topic3_4']))."', '$topic4_1', '$topic4_2', 
	'$topic4_3', '$topic4_4','$topic4_5', '".nl2br(trim($_POST['topic4_6']))."' , 
	'$topic5_1', '$topic5_2', '$topic5_3', '$topic5_4', 
	'$topic5_5', '$topic5_6', '$topic5_7', '$topic5_8', 
	'$topic5_9', '$topic5_10', '".nl2br(trim($_POST['topic5_11']))."', '$topic6_1', 
	'$topic6_2', '$topic6_3', '$topic6_4', '".nl2br(trim($_POST['topic6_5']))."', 
	'$topic7_1', '$topic7_2', '$topic7_3', '$topic7_4', 
	'$topic7_5', '$topic7_6', '".nl2br(trim($_POST['topic7_7']))."', '$topic8_1', 
	'$topic8_2', '$topic8_3', '$topic8_4', '$topic8_5', 
	'$topic8_6', '$topic8_7','$topic8_8','$topic8_9',
	'$topic8_10', '".nl2br(trim($_POST['topic8_11']))."', '".$_POST['clinic']."', '".$_POST['quality']."',
	'".$_POST['cpno']."','$risk1', '$risk2','$risk3',
	'$risk4','$risk5','$risk6','$risk7', 
	'$risk8','$risk9','".nl2br(trim($_POST['sum_up']))."', '".nl2br(trim($_POST['problem']))."',
	'".nl2br(trim($_POST['protect']))."','".$_POST['head_name']."', '".$_POST['menucode']."', '".$_POST['officer']."', NOW(), 
	'$topic9_1', '$topic9_2', '$topic9_3', '$topic9_4', '$topic9_5', '$topic9_6')";

$query = mysql_query($sql) or die( mysql_error($Conn) );
if($query){
	?>
	<div align='center'>บันทึกข้อมูลเรียบร้อยแล้ว</div>
	<script type="text/javascript">
		setTimeout(function(){
			window.location.href="ncf2.php";
		}, 3000);
	</script>
	<?php
}else{
	echo "ไม่สามารถบันทึกข้อมูล ERROR !!!   ";
}
?>