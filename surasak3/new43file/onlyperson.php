<?php
include '../bootstrap.php';

$thaimonthFull = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = input('action');

if( $action === false ){
	include 'menu.php';
?>
	<div>
		<h3>ส่งออก43แฟ้ม</h3>
		<p>อัพเดทเฉพาะ แฟ้ม person </p>
	</div>
	<form action="onlyperson.php" method="post">
		<div>
			ปี <input type="text" name="dateSelect">
			<span style="color: red">* ตัวอย่าง 2559-01</span>
		</div>
		<div>
			<button type="submit">ส่งออก</button>
			<input type="hidden" name="action" value="export">
		</div>
	</form>
<?php
} else if( $action === 'export' ){
	
	$dateSelect = input_post('dateSelect');
	
	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		?>
		<p>อนุญาตให้ใช้รูปแบบ ปี-เดือน เช่น 2559-04 เท่านั้น</p>
		<a href="onlyperson.php">ย้อนกลับ</a>
		<?php
		exit;
	}
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

	// แฟ้มที่ 27
	include 'libs/person.php';
	
	echo '<p><a href="'.$filePath.'" target="_blank">ดาวโหลดไฟล์</a></p>';
	echo '<p><a href="'.$qofPath.'" target="_blank">ดาวโหลดไฟล์สำหรับ QOF</a></p>';
	echo '<p><a href="onlyperson.php">&lt;&lt;&nbsp;กลับไปหน้ารายการ</a></p>';
}