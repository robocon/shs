<?php 
error_reporting(E_ALL);
ini_set('error_reporting', E_ALL);
ini_set('display_errors', 1);

include '../bootstrap.php';

$dbi = new mysqli(HOST, USER, PASS, DB);

$Conn = mysql_connect('localhost', 'root', '1234') or die( mysql_error() );
mysql_select_db('smdb', $Conn) or die( mysql_error() );

$db2 = $Conn;

$thaimonthFull = array('01' => 'มกราคม', '02' => 'กุมภาพันธ์', '03' => 'มีนาคม', '04' => 'เมษายน', 
'05' => 'พฤษภาคม', '06' => 'มิถุนายน', '07' => 'กรกฎาคม', '08' => 'สิงหาคม', 
'09' => 'กันยายน', '10' => 'ตุลาคม', '11' => 'พฤศจิกายน', '12' => 'ธันวาคม');

$selmon = isset($_POST['month']) ? $_POST['month'] : date('m');
$action = ( $_REQUEST['action'] ) ? $_REQUEST['action'] : false ;
$make = ( $_REQUEST['make'] ) ? $_REQUEST['make'] : false ;

if ( $make === 'del' ) {
	
	$file = input_get('file');
	$testMatch = preg_match('/.+\.zip$/', $file);
	
	$msg = 'ไฟล์ไม่ถูกต้อง';
	if( $testMatch > 0 ){
		$res = unlink('export/'.$file);
		$msg = 'ลบไฟล์เรียบร้อย';
	}

	redirect('export_new43.php', $msg);
	exit;
}


$file_lists = array( 
	'person','address','chronic','disability','icf',
	'provider','dental','home','drugallergy','service',
	'admission','charge_opd','diagnosis_opd','drug_opd','epi',
	'death','card','appointment','accident','procedure_opd',
	'diagnosis_ipd','procedure_ipd','drug_ipd','charge_ipd','anc',
	'prenatal','ncdscreen','labfu','chronicfu','specialpp',
	'policy','newborn','newborncare','nutrition','women',
	'fp', 'labor', 'postnatal'
);

if( $action === false ){
	include 'menu.php';
	?>
	<style>
	.btn-log:hover, label.select_item:hover{
		cursor: pointer;
		text-decoration: underline;
	}
	</style>

	<?php
	if( isset($_SESSION['x-msg']) ){
		?><div style="color: #000000;border: 2px solid #FFC107;margin: 8px;padding: 4px;background-color: #fff3d0;"><?=$_SESSION['x-msg'];?></div><?php
		$_SESSION['x-msg'] = NULL;
	}
	?>
<div class="w3-container">

	<div>
		<h3>ระบบส่งออก43แฟ้ม</h3>
		<div class="btn-log"><b>Log</b></div>
		<div style="display: none;" class="log-detail">
			<p>1.) ก่อนปี61 อัพเดทเฉพาะ admission, service, drugallergy, epi, diagnosis_opd, drug_opd</p>
			<p>2.) 12-01-2561 เพิ่มเติมแฟ้ม chronic, disability, provider, dental</p>
			<p>3.) 29-01-2561 เพิ่มเติมแฟ้ม home, icf</p>
			<p>4.) 30-08-2561 - 06-09-2561 เพิ่มเติมแฟ้ม anc, prenatal, ncdscreen, labfu, chronicfu</p>
			<p>5.) 07-09-2561 ปรับปรุงแฟ้ม procedure_opd, procedure_ipd เพิ่ม CID และปรับปรุงการดึงข้อมูล icd9-cm</p>
			<p>6.) 30-01-2562 ยกเลิกการคีย์ข้อมูลตรงๆ ของแฟ้ม icf & disability โดยเปลี่ยนไปใช้ข้อมูลที่คีย์จากหน้างาน</p>
			<p>7.) 25-02-2562 เพิ่มแฟ้ม policy</p>
			<p>8.) 26-02-2563 เพิ่มแฟ้ม newborn, newborncare และปรับปรุงโครงสร้างแฟ้ม policy, anc</p>
			<p>9.) 10-03-2563 เพิ่ม nutrition และอัพเดท EPI ตามโครงสร้างใหม่</p>
			<p>10.) 25-06-2564 อัพเดทแฟ้ม เป็น v2.4 anc, prenatal, newborn</p>
			<p>11.) 30-06-2564 แก้ error clinic code แฟ้ม diagnosis_opd, procedure_opd</p>
			<p>12.) 07-07-2564 เพิ่มการส่งออกแฟ้ม women, fp</p>
			<p>13.) 08-07-2564 เพิ่มการส่งออกแฟ้ม labor, postnatal</p>
			<p>14.) 19-07-2564 เพิ่มการฉีดวัคซีนโควิดเข้าแฟ้ม epi</p>
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
								<label class="select_item" for="<?=$file_name;?>"><?=$file_name;?></label>
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
	<fieldset>
		<legend>ค้นหาไฟล์จากวันที่</legend>
		<form action="export_new43.php" method="post">
			<div>
				เลือกวันที่ : <input type="text" name="date_file" id="date_file"> 
				- รูปแบบการค้นหาเช่น 2564-03-30
			</div>
			<div>
				<button type="submit">ค้นหา</button>
				<input type="hidden" name="page" value="search_file">
			</div>
		</form>
	</fieldset>
		<?php 
		$page = $_POST['page'];
		if($page === 'search_file')
		{
		
		?>
		<div>
			<h3>รายชื่อแฟ้มที่เคยดึงข้อมูลแล้ว</h3>
		</div>
		<div style="float: left;">
			<div><h3>43แฟ้ม</h3></div>
			<div>
				<?php 
				
				$extract_date = explode('-', $_POST['date_file']);
				$pre_file = '';
				if(!empty($extract_date['0']))
				{
					$pre_file .= $extract_date['0'];
				}

				if(!empty($extract_date['1']))
				{
					$pre_file .= $extract_date['1'];
				}

				if(!empty($extract_date['2']))
				{
					$pre_file .= $extract_date['2'];
				}

				$zipItems = glob('export/F43_11512_'.$pre_file.'*.zip');
				rsort($zipItems);
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
						<td><a href="export_new43.php?make=del&file=<?=urlencode($matchs['1']);?>" onclick="return delFile()">[ลบข้อมูล]</a></td>
					</tr>
					<?php
					$i++;
					}
					?>
				</table>
			</div>
		</div>
		<div style="float: left;">&nbsp;</div>
		<div style="float: left;">
			<div><h3>QOF 43แฟ้ม</h3></div>
			<?php 
			$zipItems = glob('export/QOF_F43_11512_'.$pre_file.'*.zip');
			rsort($zipItems);
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
					<td><a href="export_new43.php?make=del&file=<?=urlencode($matchs['1']);?>" onclick="return delFile()">[ลบข้อมูล]</a></td>
				</tr>
				<?php
				$i++;
				}
				?>
			</table>
		</div>
		<?php 
		}
		?>
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
} else if( $action === 'export' ){
	
	$dateSelect = $_POST['dateSelect'];
	if(empty($dateSelect))
	{
		echo "กรุณาเลือกวันที่";
		exit;
	}

	$rptday_for_day = '';
	$rptday = '';
	$day_parth = '';

	$testMatch = preg_match('/\d{4}\-\d{2}\-\d{2}/', $dateSelect);
	if( $testMatch === 0 ){ // ถ้าไม่เข้าเงื่อนไขตามรูปแบบ yyyy-mm-dd
		list($thiyr, $rptmo) = explode('-', $dateSelect);
	}else{ 
		list($thiyr, $rptmo, $rptday) = explode('-', $dateSelect);
		$rptday_for_day = "-$rptday";
		$day_parth = '/'.$rptday;
	}

	// สำหรับ opday
	$thdate_opday = $rptmo.'-'.$thiyr;
	if(!empty($rptday))
	{
		$thdate_opday = $rptday.'-'.$rptmo.'-'.$thiyr;
	}

	// format yyyymmdd เช่น 20210131
	$date_serv = ($thiyr-543).$rptmo.$rptday;

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
		require_once 'libs/person.php';
	}
	
	if( $_POST['address'] ){
		// แฟ้มที่ 2
		require_once 'libs/address.php';
	}
	

	if( $_POST['chronic'] ){ 
		// 4
		require_once 'libs/chronic.php';
	}
	

	if( $_POST['disability'] ){
		// 8
		require_once 'libs/disability.php';
	}
	
	if( $_POST['icf'] ){
		require_once 'libs/icf.php';
	}
	

	if( $_POST['provider'] ){
		require_once 'libs/provider.php';
	}
	

	if( $_POST['dental'] ){
		require_once 'libs/dental.php';
	}
	

	if( $_POST['home'] ){
		require_once 'libs/home.php';
	}
	
	
	if( $_POST['drugallergy'] ){
		// แฟ้มที่ 11
		require_once 'libs/drugallergy.php';
	}
	
	
	if( $_POST['service'] ){
		// แฟ้มที่ 14
		require_once 'libs/service.php';
	}
	
	
	if( $_POST['admission'] ){
		// แฟ้มที่ 23
		require_once 'libs/admission.php';
	}
	
	
	if( $_POST['charge_opd'] ){
		// แฟ้มที่ 18
		require_once 'libs/charge_opd.php';
	}
	
	
	if( $_POST['diagnosis_opd'] ){
		// แฟ้มที่ 15
		require_once 'libs/diagnosis_opd.php';
	}
	
	
	if( $_POST['drug_opd'] ){
		// แฟ้มที่ 16
		require_once 'libs/drug_opd.php';
	}
	
	
	if( $_POST['epi'] ){
		// แฟ้มที่ 39
		require_once 'libs/epi.php';
	}
	
	// ==== ด้านล่างยังไม่ได้ปรับ SQL PERFORMANCE ====
	
	if( $_POST['death'] ){ 
		// แฟ้มที่ 3
		require_once 'libs/death.php';
	}
	
	
	if( $_POST['card'] ){ 
		// แฟ้มที่ 5
		require_once 'libs/card.php';
	}
	
	
	if( $_POST['appointment'] ){ 
		// แฟ้มที่ 28
		require_once 'libs/appointment.php';
	}
	
	
	if( $_POST['accident'] ){ 
		// แฟ้มที่ 20
		require_once 'libs/accident.php';
	}
	
	
	if( $_POST['procedure_opd'] ){ 
		// แฟ้มที่ 17
		require_once 'libs/procedure_opd.php';
	}
	
	
	if( $_POST['diagnosis_ipd'] ){ 
		// แฟ้มที่ 24
		require_once 'libs/diagnosis_ipd.php';
	}
	
	if( $_POST['procedure_ipd'] ){ 
		// แฟ้มที่ 26
		require_once 'libs/procedure_ipd.php';
	}
	
	
	if( $_POST['drug_ipd'] ){ 
		// แฟ้มที่ 25
		require_once 'libs/drug_ipd.php';
	}
	
	if( $_POST['charge_ipd'] ){ 
		// แฟ้มที่ 27
		require_once 'libs/charge_ipd.php';
	}

	// ==== จบตัวเก่า
	

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
	
	if( $_POST['specialpp'] ){ 
		require_once 'libs/specialpp.php';
	}

	if( $_POST['policy'] ){ 
		require_once 'libs/policy.php';
	}

	if( $_POST['newborn'] ){ 
		require_once 'libs/newborn.php';
	}

	if( $_POST['newborncare'] ){ 
		require_once 'libs/newborncare.php';
	}

	if( $_POST['nutrition'] ){ 
		require_once 'libs/nutrition.php';
	}

	if( $_POST['women'] ){ 
		require_once 'libs/women.php';
	}

	if( $_POST['fp'] ){ 
		require_once 'libs/fp.php';
	}
	
	if( $_POST['labor'] ){ 
		require_once 'libs/labor.php';
	}

	if( $_POST['postnatal'] ){ 
		require_once 'libs/postnatal.php';
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