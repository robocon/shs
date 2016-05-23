<?php
include '../bootstrap.php';

$thaimonthFull = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = input('action');

if( $action === false ){
?>
	<div>
		<a href="../../nindex.htm">&lt;&lt;&nbsp;กลับไปหน้าเมนู</a>
	</div>
	<div>
		<h3>ส่งออก43แฟ้ม</h3>
		<p>อัพเดทเฉพาะ admission, service, drugallergy, epi, diagnosis_opd, drug_opd</p>
	</div>
	<form action="export_new43.php" method="post">
		<div>
			ปี <input type="text" name="dateSelect">
			<span style="color: red">* ตัวอย่าง 2559-01</span>
		</div>
		<div>
			<button type="submit">ส่งออก</button>
			<input type="hidden" name="action" value="export">
		</div>
	</form>
	<div>
		<div>
			<h3>รายชื่อแฟ้มที่เคยดึงข้อมูลแล้ว</h3>
		</div>
		<?php
		if( isset($_SESSION['x-msg']) ){
			?><div style="color: #FFC107;"><?=$_SESSION['x-msg'];?></div><?php
			$_SESSION['x-msg'] = NULL;
		}
		?>
		<div>
			<?php 
			$zipItems = glob('export/*.zip');
			$i = 1;
			?>
			<table border="1" cellpadding="4" cellspacing="0" style="border-collapse:collapse" bordercolor="#000000">
				<tr>
					<th>#</th>
					<th>ชื่อไฟล์(คลิกเพื่อดาวโหลดได้)</th>
					<th>ครั้งล่าสุดที่ดึงข้อมูล</th>
					<th>จัดการ</th>
				</tr>
				<?php
				foreach( $zipItems as $key => $item ){
				?>
				<tr>
					<td><?=$i;?></td>
					<td>
						<?php
						preg_match('/\/(.+\.zip)/', $item, $matchs);
						echo '<a href="'.$item.'">'.$matchs['1'].'</a>';
						?>
					</td>
					<td>
						<?php
						echo date('Y-m-d H:i:s', filemtime($item));
						?>
					</td>
					<td><a href="export_new43.php?action=del&file=<?=urlencode($matchs['1']);?>" onclick="return delFile()">[ลบข้อมูล]</a></td>
				</tr>
				<?php
				$i++;
				}
				?>
			</table>
		</div>
	</div>
	<script type="text/javascript">
		function delFile(){
			var c = confirm("ยืนยันที่จะลบข้อมูล?");
			if( c === false ){
				return false;
			}
		}
	</script>
<?php
} else if ( $action === 'del' ) {
	
	$file = input_get('file');
	$testMatch = preg_match('/.+\.zip$/', $file);
	
	$msg = 'ไฟล์ไม่ถูกต้อง';
	if( $testMatch > 0 ){
		unlink('export/'.$file);
		$msg = 'ลบไฟล์เรียบร้อย';
	}
	
	redirect('export_new43.php', $msg);
	
} else if( $action === 'export' ){
	
	$dateSelect = input_post('dateSelect');
	
	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		?>
		<p>อนุญาตให้ใช้รูปแบบ ปี-เดือน เช่น 2559-04 เท่านั้น</p>
		<a href="export_new43.php">ย้อนกลับ</a>
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
	
	// แฟ้มที่ 1
	include 'libs/person.php';
	
	// แฟ้มที่ 2
	include 'libs/address.php';
	
	// แฟ้มที่ 11
	include 'libs/drugallergy.php';
	
	// แฟ้มที่ 14
	include 'libs/service.php';
	
	// แฟ้มที่ 23
	include 'libs/admission.php';
	
	// แฟ้มที่ 18
	include 'libs/charge_opd.php';
	
	// แฟ้มที่ 15
	include 'libs/diagnosis_opd.php';
	
	// แฟ้มที่ 16
	include 'libs/drug_opd.php';
	
	// แฟ้มที่ 39
	include 'libs/epi.php';
	
	// ==== ด้านล่างยังไม่ได้ปรับ SQL PERFORMANCE ====
	
	// แฟ้มที่ 3
	include 'libs/death.php';
	
	// แฟ้มที่ 5
	include 'libs/card.php';
	
	// แฟ้มที่ 28
	include 'libs/appointment.php';
	
	// แฟ้มที่ 20
	include 'libs/accident.php';
	
	// แฟ้มที่ 17
	include 'libs/procedure_opd.php';
	
	// แฟ้มที่ 24
	include 'libs/diagnosis_ipd.php';
	
	// แฟ้มที่ 26
	include 'libs/procedure_ipd.php';
	
	// แฟ้มที่ 25
	include 'libs/drug_ipd.php';
	
	// แฟ้มที่ 27
	include 'libs/charge_ipd.php';
	
	
	// สร้าง zip ไฟล์
	$main_folder = 'F43_11512_'.$thiyr.$rptmo.'01090000';
	$zipName = 'export/'.$main_folder.'.zip';
	$zipNameQOF = 'export/QOF_'.$main_folder.'.zip';
	
	require_once("libs/dZip.inc.php"); // include Class
	
	$zip = new dZip($zipName);
	foreach( $zipLists as $key => $list){
		
		// match เอาเฉพาะชื่อไฟล์
		preg_match('/\/(\w+\.txt)/', $list, $file);
		
		// $zip->addFile(pathไฟล์ปัจจุบัน, ชื่อไฟล์ที่ใช้สร้างในzipใหม่);
		$zip->addFile($list, $main_folder.'/'.$file['1']);
	}
	$zip->save();
	
	// สร้าง zip สำหรับส่ง QOF ให้ สสจ
	$zip = new dZip($zipNameQOF);
	foreach( $qofLists as $key => $list){
		preg_match('/\/(\w+\.txt)/', $list, $file);
		$filename = str_replace('qof_', '', $file['1']); // ลบเอาคำ qof_ ออก
		$zip->addFile($list, $main_folder.'/'.$filename);
	}
	$zip->save();
	
	echo '<p><a href="'.$zipName.'">ดาวโหลดไฟล์</a></p>';
	echo '<p><a href="'.$zipNameQOF.'">ดาวโหลดไฟล์สำหรับ QOF</a></p>';
	echo '<p><a href="export_new43.php">&lt;&lt;&nbsp;กลับไปหน้ารายการ</a></p>';
}