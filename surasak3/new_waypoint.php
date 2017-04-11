<?php 
include 'bootstrap.php';

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

$page = input('page');
$action = input('action');
$db = Mysql::load();

// บันทึกไฟล์นำเข้า
if( $action === 'import' ){

	include 'includes/JSON.php';
	$json = new Services_JSON();

	$file = $_FILES['file'];
	$date_start = input_post('date_start');
	$date_end = input_post('date_end');
	
	if($file['error'] > 0){
		$_SESSION['x-msg'] = 'กรุณาเลือกไฟล์ที่จะอัพโหลด';
		$_SESSION['type'] = 'warning';
		header('Location: new_waypoint.php?page=import');
		exit;
	}
	
	if(strrchr($file['name'], ".") != '.csv'){
		$_SESSION['x-msg'] = 'อนุญาตเฉพาะไฟล์ .csv เท่านั้น';
		$_SESSION['type'] = 'warning';
		header('Location: new_waypoint.php?page=import');
		exit;
	}

	$company_code = input_post('company');
	$sql = "SELECT `name` FROM `chkcompany` WHERE `code` = '$company_code'";
	$db->select($sql);
	$com = $db->get_item();
	$company = $com['name'];

	// ลบข้อมูลเดิมก่อน แล้วค่อยเพิ่มข้อมูลใหม่เข้าไป
	$sql = "DELETE FROM `testmatch` WHERE `company_code` = '$company_code' ";
	$db->delete($sql);

	$content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);
	$bad_lists = array();
	
	foreach ($items as $key => $list) {
		
		$item = explode(',', $list);
		$hn = str_replace(' ', '', $item['3']);
		
		// เป็น hn dd-ddddd รึป่าว
		$test_match = preg_match('/(\d+)\-(\d+)/', $hn);
		
		if( !empty($list) && $test_match > 0 ){

			$name = trim($item['0']);
			$surname = trim($item['1']);
			$age = trim($item['2']);
			
			$pre_list = array(
				'CBC-sso' => $item['4'],
				'UA-sso' => $item['5'],
				'BS-sso' => $item['6'],
				'CR-sso' => $item['7'],
				'LIPID-sso' => $item['8'],
				'HBSAG-sso' => $item['9'],
				'PAP-sso' => $item['10'],
				'STOCB-sso' => $item['11'],
				'41001-sso' => $item['12'], //x-ray
			);
			
			$list = array();
			foreach ($pre_list as $code => $value) {
				$value = ( !empty($value) ) ? 1 : 0 ;
				if( $value > 0 ){
					$list[] = $code;
				}
			}

			$json_list = $json->encode($list);

			$name = trim(str_replace(array('นางสาว','นาย','นาง','น.ส.'), '', $name));

			$sql = "SELECT `hn` 
			FROM `opcard` 
			WHERE `hn` = '$hn' 
			AND `name` = '$name' 
			AND `surname` = '$surname' ";
			$db->select($sql);
			$user_count = $db->get_rows();
			
			if( $user_count > 0 ){
				$sql = "INSERT INTO `testmatch` VALUES (
				NULL,
				'$hn', 
				'$age',
				'$company', 
				'$company_code', 
				'$date_start', 
				'$date_end',
				'$json_list');";
				
				$insert = $db->insert($sql);
				
			}else{

				$sql = "SELECT CONCAT(`name`,' ',`surname`) AS `fullname` FROM `opcard` WHERE `hn` = '$hn' ";
				$db->select($sql);
				$check_user = $db->get_item();
				$bad_lists[] = "$hn $name $surname (".$check_user['fullname'].")";
			}
		}
	}

	if( count($bad_lists) > 0 ){
		$_SESSION['bad_lists'] = $bad_lists;
	}

	$_SESSION['x-msg'] = 'นำเข้าไฟล์เเสร็จเรียบร้อย';

	header('Location: new_waypoint.php');
	exit;
}


// include 'templates/classic/header.php';
?>
<style type="text/css">
	.nav{
		list-style: none;
		margin: 10px;
		padding: 0;
	}
	.nav li{
		display: inline;
	}
	.nav li a{
		margin: 0;
		padding: 4px;
		border-right: 1px solid #000;
	}
</style>
<div id="no_print" class="col">
	<div class="cell">
		<ul class="nav">
			<li>
				<a href="../nindex.htm">เมนูหลัก รพ.</a>
			</li>
			<li>
				<a href="new_waypoint.php">ออกใบนำทาง</a>
			</li>
			<li>
				<a href="new_waypoint.php?page=import">นำเข้าข้อมูล</a>
			</li>
		</ul>
	</div>
</div>
<?php
// Notification
if( isset($_SESSION['x-msg']) ){
	?>
	<div style="border: 2px solid #c3c300;padding: 4px;background-color: #fffcdd;">
		<p><?=$_SESSION['x-msg'];?></p>
	</div>
	<?php
	unset($_SESSION['x-msg']);
}
if( count($_SESSION['bad_lists']) > 0 ){
	?>
	<div style="border: 2px solid #c3c300;padding: 4px;background-color: #fffcdd;">
		<p>ข้อมูลไม่ถูกต้อง HN หรือ ชื่อ-สกุล ไม่ตรงกับฐานข้อมูลกรุณาตรวจสอบอีกครั้ง</p>
		<ol>
			<?php
			foreach ($_SESSION['bad_lists'] as $key => $item) {
				?>
				<li><?=$item;?></li>
				<?php
			}
			?>
			
		</ol>
	</div>
	<?php
	unset($_SESSION['bad_lists']);
}
// Notification

//หน้าแรก
if( empty($page) ){

	$sql = "SELECT a.*, COUNT(b.`company_code`) AS rows
	FROM `chkcompany` AS a 
	LEFT JOIN `testmatch` AS b ON b.`company_code` = a.`code`
	WHERE a.`year` = '60' 
	GROUP BY b.`company_code`";
	// dump($sql);
	$db->select($sql);
	$items = $db->get_items();

	?>
	<h3>พิมพ์ใบนำทาง</h3>
	<form action="new_waypoint.php" method="post" onsubmit="return checker()">
		<div>
			เลือกหน่วยงานที่ต้องการพิมพ์ใบนำทาง
			<select name="company" id="company">
				<option value="">หน่วยงาน</option>
				<?php
				foreach( $items AS $key => $item ){
					if( $item['rows'] == 0 ){
						continue;
					}
					?>
					<option value="<?=$item['code'];?>"><?=$item['name'];?></option>
					<?php
				}
				?>
			</select>
		</div>
		<div>
			<input type="checkbox" id="ekg" name="ekg" value="1"> 
			<label for="ekg">มีการตรวจ EKG</label>
		</div>
		<div>
			<button type="submit">พิมพ์</button>
			<input type="hidden" name="page" value="print_waypoint">
		</div>
	</form>
	<script type="text/javascript">
		function checker(){
			var company = document.getElementById('company').value;
			if( company == '' ){
				alert('กรุณาเลือกหน่วยงาน');
				return false;
			}
		}
	</script>
	<?php

// หน้านำเข้าไฟล์ .csv
}else if( $page === 'import' ){
	
	?>
	<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
	<script type="text/javascript" src="epoch_classes.js"></script>
	<script type="text/javascript">
		var popup1, popup2;
		window.onload = function() {
			popup1 = new Epoch('popup1','popup',document.getElementById('date_start'),false);
			popup2 = new Epoch('popup2','popup',document.getElementById('date_end'),false);
			
		};
	</script>
	<h3>นำเข้าข้อมูลสำหรับใบนำทาง</h3>
	<form action="new_waypoint.php" method="post" enctype="multipart/form-data" onsubmit="return checker()">
		<div>
			<?php
			$sql = "SELECT * FROM `chkcompany` WHERE `year` = '60'";
			$db->select($sql);
			$items = $db->get_items();
			?>
			เลือกหน่วยงาน 
			<select name="company" id="company">
				<option value="">หน่วยงาน</option>
			
			<?php
			foreach( $items AS $key => $item ){
				?>
				<option value="<?=$item['code'];?>"><?=$item['name'];?></option>
				<?php
			}
			?>
			</select>
		</div>
		<div>
			วันที่เริ่มตรวจ <input type="text" id="date_start" name="date_start">
			สิ้นสุดการตรวจ <input type="text" id="date_end" name="date_end">
		</div>
		<div>
			ไฟล์นำเข้า <input type="file" name="file">
		</div>
		<div>
			<button type="submit">นำเข้า</button>
			<input type="hidden" name="action" value="import">
		</div>
	</form>
	<script type="text/javascript">
		function checker(){
			var company = document.getElementById('company').value;
			if( company == '' ){
				alert('กรุณาเลือกหน่วยงาน');
				return false;
			}

			var date_start = document.getElementById('date_start').value;
			var date_end = document.getElementById('date_end').value;
			if( date_start == '' || date_end == '' ){
				alert('กรุณาเลือกวันที่');
				return false;
			}
		}
	</script>
	<?php

// หน้าพิมพ์ใบนำทาง
}else if( $page === 'print_waypoint' ){

	$company_code = input_post('company');
	$ekg = input_post('ekg');

	$sql = "SELECT * 
	FROM `testmatch` 
	WHERE `company_code` = '$company_code'";
	$db->select($sql);
	$items = $db->get_items();

	?>
	<style type="text/css">
		.pdxhead {font-family: "TH SarabunPSK";font-size: 24px;}
		.pdxpro {font-family: "TH SarabunPSK";font-size: 22px;}
		.pdx {font-family: "TH SarabunPSK";font-size: 20px;}
		.stricker {font-family: "TH SarabunPSK";font-size: 16px;}
		.stricker1 {font-family: "TH SarabunPSK";font-size: 14px;}
		@media print{ #no_print{ display:none; } }
	</style>
	<?php
	$i = 1;
	foreach ($items as $key => $item) {

		$company = $item['company'];
		$hn = $item['hn'];

		// วว ดด ปปปป ไทยๆ
		list($y3, $m3, $d3) = explode('-', ad_to_bc($item['date_end']));
		
		// !!! ยังไม่รองรับข้ามเดือน
		list($y, $m, $d) = explode('-', ad_to_bc($item['date_start']));
		if( $d !== $d3 ){
			$d .= ' - '.$d3;
		}
		$date_checkup = $d.' '.$def_fullm_th[$m].' '.$y;
		
		$sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `fullname`,`idcard`,`dbirth`,`address`,`tambol`,`ampur`,`changwat`,`phone` 
		FROM `opcard` 
		WHERE `hn` = '$hn'";
		$db->select($sql);
		$patient = $db->get_item();
		
		$fullname = $patient['fullname'];
		$idcard = $patient['idcard'];
		$address = $patient['address'].' ต.'.$patient['tambol'].' อ.'.$patient['ampur'].' จ.'.$patient['changwat'];
		$phone = $patient['phone'];

		$age = calcage($patient['dbirth']);

		list($y2, $m2, $d2) = explode('-', $patient['dbirth']);
		$birth_date = $d2.' '.$def_fullm_th[$m2].' '.$y2;

		if( ($i % 2) == 0 ){
			?>
			<div style="margin-top: 80px;"></div>
			<?php
		}
		?>
		<table width="100%">
			<tr>
				<td>
					<table width="100%" border="0" cellspacing="0" cellpadding="0">
						<tr>
							<td width="8%" rowspan="3" align="center"><img src="images/logo.jpg" width="87" height="83" /></td>
							<td width="75%" align="center" class="pdx">
								<strong><span class="pdxhead">
								แบบการตรวจสุขภาพ <?=$company;?>
								</span></strong>
							</td>
							<td width="17%" align="center" class="pdx">&nbsp;</td>
						</tr>
						<tr>
							<td align="center" class="pdx"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
							<td align="center" class="pdx">&nbsp;</td>
						</tr>
						<tr>
							<td align="center" class="pdx"><span class="pdxhead">ตรวจวันที่ <?=$date_checkup;?></span></td>
							<td align="center" class="pdx">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
			<tr>
				<td>
					<span class="pdx"><strong>คำแนะนำสำหรับการตรวจสุขภาพ</strong><br />
					<strong>ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจตามสถานีที่กำหนดทุกสถานี</strong></span><br />

					<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
						<tr>
							<td>
								<table>
									<tr>
										<td class="pdxpro">
											HN : <strong><?=$hn?></strong> 
											ชื่อ-สกุล : <strong><?=$fullname?></strong>
											ว/ด/ป เกิด : <?=$birth_date;?>
											อายุ : <?=$age;?>
										</td>
									</tr>
									<tr>
										<td class="pdx">เลขบัตรปชช : <?=$idcard;?>&nbsp;
										ที่อยู่ : <?=$address;?>&nbsp;
										โทรศัพท์ : <?=$phone;?></td>
									</tr>
								</table>
							</td>
						</tr>
					</table>
					<?php
					// โปรแกรมตรวจ
					$arrtype = array('ตรวจ x-ray ปอด','ตรวจความสมบูรณ์ของเม็ดเลือด(CBC)','ตรวจปัสสาวะ(UA)','เบาหวาน(BS)','ไขมัน(CHOL) (TRI)','ตรวจหน้าที่ของตับ(SGOT,SGPT)','ตรวจหน้าที่ของไต(BUN,CR)','ตรวจหน้าที่ของไต(ALK)','ตรวจกรดยูริก(URICACID)');
					$arrprice = array('170.00','90.00','50.00','40.00','120.00','100.00','100.00','50','60');
					?>
					<table width="756">
						<tr>
							<td class="pdxpro" colspan="2"><strong>รายการตรวจสุขภาพ</strong></td>
						</tr>
						<!--
						<tr>
							<td class="pdxpro" colspan="2"><strong><?=$company;?></strong></td>
						</tr>
						-->
						<?php
						$sumpri=0;
						if($program_type=="1"){	
							$program_txt = "โปรแกรมที่ 1";
						}elseif($program_type=="2"){
							$program_txt = "โปรแกรมที่ 2";
						}elseif($program_type=="3"){
							$program_txt = "โปรแกรมที่ 3";
						}elseif($program_type=="4"){
							$program_txt = "โปรแกรมที่ 4";
						}else{
							$program_txt = "โปรแกรมอื่นๆ";
						}
						?>
						<!--
						<tr><td class='pdxpro'><strong><?=$program_txt;?></strong></td></tr>
						-->
						<tr>
							<td class="pdx" colspan="2"><strong>สถานีที่ต้องเข้ารับบริการ</strong></td>
						</tr>
						<tr>
							<td class="pdx" colspan="2">

							<table>
								<tr style='line-height:16px'>
									<!--
									<td>
										<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
											<tr align='center' style='line-height:16px'>
												<td>
													สถานี 1 <br>ลงทะเบียน<br>ทะเบียน<br>.............................
												</td>
											</tr>
										</table>
									</td>
									-->
									<td>
										<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
											<tr align='center' style='line-height:16px'>
												<td>
													สถานี 2<br>
													เจาะเลือด<br>
													.............................
												</td>
											</tr>
										</table>
									</td>
									<td>
										<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
											<tr align='center' style='line-height:16px'>
												<td>
													สถานี 3<br>
													X-RAY<br>
													.............................
												</td>
											</tr>
										</table>
									</td>
									<td>
										<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
											<tr align='center' style='line-height:16px'>
												<td>
													สถานี 4<br>
													ซักประวัติ<br>
													.............................
												</td>
											</tr>
										</table>
									</td>
							
							<?php
							// if($program_type != "1" && $program_type != "2" && $program_type != "3" && $program_type != "4"){
							if( $ekg > 0 ){
								?>
								<!-- 
								<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>สถานี 5<br>PAP<br>OPD สูติฯ<br>.............................</td></tr></table></td>
								<td><table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'><tr align='center' style='line-height:16px'><td>สถานี 6<br>V/A<br>OPD ตา<br>.............................</td></tr></table></td>
								-->
								<td>
									<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
										<tr align='center' style='line-height:16px'>
											<td>
												สถานี 4<br>
												EKG<br>
												.............................
											</td>
										</tr>
									</table>
								</td>
								<?php	
							}	
							?>
							</td>
						</tr>
						<tr>
							<td class="pdx">&nbsp;</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="pdx" style="margin-left:10px;">
			<strong>*** หมายเหตุ ***</strong><br />
			- ให้เจ้าหน้าที่เซ็นต์ชื่อกำกับทุกสถานี เมื่อทำการตรวจเสร็จเรียร้อยแล้ว <br />
			- เมื่อทำการตรวจครบทุกสถานีแล้ว นำเอกสารส่งคืนเจ้าหน้าที่ ณ จุดลงทะเบียน <br />
			- กรุณาอย่าทำเอกสารใบนำทางหาย เป็นอันเด็ดขาด
		</div>
		<?php
		$i++;

	} // End foreach

}
// include 'templates/classic/footer.php';
?>