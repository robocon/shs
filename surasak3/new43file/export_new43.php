<?php
include '../bootstrap.php';

$thaimonthFull = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = input('action');


$file_lists = array(
	'person','address','chronic','disability','icf',
	'provider','dental','home','drugallergy','service',
	'admission','charge_opd','diagnosis_opd','drug_opd','epi',
	'death','card','appointment','accident','procedure_opd',
	'diagnosis_ipd','procedure_ipd','drug_ipd','charge_ipd','anc',
	'prenatal','ncdscreen','labfu','chronicfu',
);

if( $action === false ){
	include 'menu.php';
	?>
	<div>
		<h3>ระบบส่งออก43แฟ้ม</h3>
		<div class="btn-log"><b>Log</b></div>
		<div style="display: none;" class="log-detail">
			<p>1. ก่อนปี61 อัพเดทเฉพาะ admission, service, drugallergy, epi, diagnosis_opd, drug_opd</p>
			<p>2. 12-01-2561 เพิ่มเติมแฟ้ม chronic, disability, provider, dental</p>
			<p>3. 29-01-2561 เพิ่มเติมแฟ้ม home, icf</p>
			<p>4. 30-08-2561 - 06-09-2561 เพิ่มเติมแฟ้ม anc, prenatal, ncdscreen, labfu, chronicfu</p>
			<p>2561-09-07 ปรับปรุงแฟ้ม procedure_opd, procedure_ipd เพิ่ม CID และปรับปรุงการดึงข้อมูล icd9-cm</p>
		</div>
	</div>

	<fieldset>
		<legend>เลือกข้อมูลส่งออก</legend>
		<form action="export_new43.php" method="post">
			<div>
				เลือกปี <input type="text" name="dateSelect">
				<span style="color: red">* ตัวอย่าง 2559-01</span>
			</div>
			<br>
			<div>
				<div>
					เลือกตารางที่จะส่งออกข้อมูล <input type="checkbox" name="checkAll" id="checkAll"> <label for="checkAll">เลือกทั้งหมด</label>
				</div>
				
				<div>
					<table> 
						<tr>
						
						<?php 
						$i = 1;
						foreach ($file_lists as $key => $file_name) {
							?>
							<td>
								<input type="checkbox" name="<?=$file_name;?>" id="<?=$file_name;?>"> 
								<label for="<?=$file_name;?>"><?=$file_name;?></label>
							</td>
							<?php
							if( $i % 8 == 0 ){
								?></tr><tr><?php
							}
							$i++;
						}
						?>
						</tr>
					</table>
				</div>
			</div>
			<div>
				<button type="submit">ส่งออก</button>
				<input type="hidden" name="action" value="export">
			</div>
		</form>
	</fieldset>
	<script src="../js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
	<script type="text/javascript">
        jQuery.noConflict();
        (function( $ ) {
        $(function() {
			
			$(document).on('click', '.btn-log', function(){
				$('.log-detail').toggle();
			});

			$(document).on('click', "#checkAll", function(){
				$("input:checkbox").not(this).prop("checked", this.checked);
			});
			
        });
        })(jQuery);
	</script>

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
	
	/*
	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		?>
		<p>อนุญาตให้ใช้รูปแบบ ปี-เดือน เช่น 2559-04 เท่านั้น</p>
		<a href="export_new43.php">ย้อนกลับ</a>
		<?php
		exit;
	}
	*/

	$rptday_for_day = '';
	$rptday = '';
	$day_parth = '';

	$testMatch = preg_match('/\d+\-\d+$/', $dateSelect);
	if( $testMatch === 0 ){
		list($thiyr, $rptmo) = explode('-', $dateSelect);
	}else{
		list($thiyr, $rptmo, $rptday) = explode('-', $dateSelect);

		$rptday_for_day = "-$rptday";

		$day_parth = '/'.$rptday;
	}



	$dirPath = realpath(dirname(__FILE__))."/export/$thiyr/$rptmo$day_parth";
	
	if( !is_dir("export/$thiyr") ){
		mkdir("export/$thiyr", 0777);
	}
	
	if( !is_dir("export/$thiyr/$rptmo") ){
		mkdir("export/$thiyr/$rptmo", 0777);
	}

	if( !is_dir("export/$thiyr/$rptmo$day_parth") ){
		mkdir("export/$thiyr/$rptmo$day_parth", 0777);
	}
	
	// define default val
	// $newyear = "$thiyr$rptmo$day";
	$thimonth = "$thiyr-$rptmo".$rptday_for_day; // e.g. 2559-05
	$yrmonth = ( $thiyr - 543 )."-$rptmo$rptday_for_day"; // e.g. 2016-05
	$yy = 543;
	$hospcode = '11512';
	$zipLists = array();
	$qofLists = array();



	if( $_POST['person'] ){
		// แฟ้มที่ 1
		include 'libs/person.php';
	}
	
	if( $_POST['address'] ){
		// แฟ้มที่ 2
		include 'libs/address.php';
	}
	

	if( $_POST['chronic'] ){ 
		// 4
		include 'libs/chronic.php';
	}
	

	if( $_POST['disability'] ){
		// 8
		include 'libs/disability.php';
	}
	
	if( $_POST['icf'] ){
		include 'libs/icf.php';
	}
	

	if( $_POST['provider'] ){
		include 'libs/provider.php';
	}
	

	if( $_POST['dental'] ){
		include 'libs/dental.php';
	}
	

	if( $_POST['home'] ){
		include 'libs/home.php';
	}
	
	
	if( $_POST['drugallergy'] ){
		// แฟ้มที่ 11
		include 'libs/drugallergy.php';
	}
	
	
	if( $_POST['service'] ){
		// แฟ้มที่ 14
		include 'libs/service.php';
	}
	
	
	if( $_POST['admission'] ){
		// แฟ้มที่ 23
		include 'libs/admission.php';
	}
	
	
	if( $_POST['charge_opd'] ){
		// แฟ้มที่ 18
		include 'libs/charge_opd.php';
	}
	
	
	if( $_POST['diagnosis_opd'] ){
		// แฟ้มที่ 15
		include 'libs/diagnosis_opd.php';
	}
	
	
	if( $_POST['drug_opd'] ){
		// แฟ้มที่ 16
		include 'libs/drug_opd.php';
	}
	
	
	if( $_POST['epi'] ){
		// แฟ้มที่ 39
		include 'libs/epi.php';
	}
	
	
	// ==== ด้านล่างยังไม่ได้ปรับ SQL PERFORMANCE ====
	
	if( $_POST['death'] ){ 
		// แฟ้มที่ 3
		include 'libs/death.php';
	}
	
	
	if( $_POST['card'] ){ 
		// แฟ้มที่ 5
		include 'libs/card.php';
	}
	
	
	if( $_POST['appointment'] ){ 
		// แฟ้มที่ 28
		include 'libs/appointment.php';
	}
	
	
	if( $_POST['accident'] ){ 
		// แฟ้มที่ 20
		include 'libs/accident.php';
	}
	
	
	if( $_POST['procedure_opd'] ){ 
		// แฟ้มที่ 17
		include 'libs/procedure_opd.php';
	}
	
	
	if( $_POST['diagnosis_ipd'] ){ 
		// แฟ้มที่ 24
		include 'libs/diagnosis_ipd.php';
	}
	
	if( $_POST['procedure_ipd'] ){ 
		// แฟ้มที่ 26
		include 'libs/procedure_ipd.php';
	}
	
	
	if( $_POST['drug_ipd'] ){ 
		// แฟ้มที่ 25
		include 'libs/drug_ipd.php';
	}
	
	if( $_POST['charge_ipd'] ){ 
		// แฟ้มที่ 27
		include 'libs/charge_ipd.php';
	}
	

	// แฟ้มใหม่
	if( $_POST['anc'] ){ 
		require_once 'libs/anc.php';
	}
	
	if( $_POST['prenatal'] ){ 
		require_once 'libs/prenatal.php';
	}
	

	if( $_POST['ncdscreen'] ){ 
		require_once 'libs/ncdscreen.php';
	}
	

	if( $_POST['labfu'] ){ 
		require_once 'libs/labfu.php';
		require_once 'libs/labfu2.php';
	}
	
	if( $_POST['chronicfu'] ){ 
		require_once 'libs/chronicfu.php';
	}
	
	
	
	
	// สร้าง zip ไฟล์
	$main_folder = 'F43_11512_'.$thiyr.$rptmo.$rptday.'01090000';
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