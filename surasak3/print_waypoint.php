<?php 
include 'bootstrap.php';

$page = input('page');
$action = input('action');
$db = Mysql::load();
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
	<h3>ออกใบนำทางทั่วไป</h3>
	<div class="cell">
		<ul class="nav">
			<li>
				<a href="../nindex.htm">เมนูหลัก รพ.</a>
			</li>
			<!--
			<li>
				<a href="new_waypoint.php">ตรวจสุขภาพแบบกลุ่ม</a>
			</li>
			-->
			<li>
				<a href="print_waypoint.php">ออกใบนำทางทั่วไป</a>
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
// Notification

//หน้าแรก
if( empty($page) ){

	?>

	<style>
	#sortable{
		list-style-type: none;
		margin: 0;
		padding: 0;
		width: 20%;
	}
	#sortable li{
		margin: 0 3px 3px 3px;
		padding: 0.4em;
		padding-left: 1.5em;
		height: 18px;
		cursor: pointer;
	}
	#sortable li span{
		position: absolute;
		margin-left: -1.3em;
	}
	</style>

	<link type="text/css" href="epoch_styles.css" rel="stylesheet" />
	<script type="text/javascript" src="epoch_classes.js"></script>
	<script type="text/javascript">
		var popup1, popup2;
		window.onload = function() {
			popup1 = new Epoch('popup1','popup',document.getElementById('date_start'),false);
			popup2 = new Epoch('popup2','popup',document.getElementById('date_end'),false);
			
		};
	</script>

	<link type="text/css" href="jquery-ui-1.9.2/css/ui-lightness/jquery-ui-1.9.2.custom.min.css" rel="stylesheet" />
	<script type="text/javascript" src="jquery-ui-1.9.2/js/jquery-1.8.3.js"></script>
	<script type="text/javascript" src="jquery-ui-1.9.2/js/jquery-ui-1.9.2.custom.min.js"></script>

	<h3>พิมพ์ใบนำทาง</h3>
	<form action="print_waypoint.php" method="post" enctype="multipart/form-data" onsubmit="return checker()">

		<div>
			ชื่อหน่วยงาน : <input type="text" name="company">
		</div>

		<div>
			วันที่เริ่มตรวจ : <input type="text" id="date_start" name="date_start">
			สิ้นสุดการตรวจ : <input type="text" id="date_end" name="date_end">
		</div>

		<div>
			ไฟล์นำเข้า : <input type="file" name="file">
			<div><span style="color: red; font-size: 14px;">รองรับไฟล์ csv</span></div>
		</div>

		<div>
			<p>เลือกสถานีตรวจ</p>
			<ul id="sortable">
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="register" name="step[register]" value="1"> 
					<label for="register">แผนกทะเบียน</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="lab" name="step[lab]" value="1"> 
					<label for="lab">LAB</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="xray" name="step[xray]" value="1"> 
					<label for="xray">X-Ray</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="vs" name="step[vs]" value="1"> 
					<label for="vs">V/S คัดแยก</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="pap" name="step[pap]" value="1"> 
					<label for="pap">PAP OPD สูติฯ</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="va" name="step[va]" value="1"> 
					<label for="va">V/A OPD ตา</label>
				</li>
				<li class="ui-state-default">
					<span class="ui-icon ui-icon-arrowtick-2-n-s"></span>
					<input type="checkbox" id="vs" name="step[ekg]" value="1"> 
					<label for="ekg">EKG OPD ตา</label>
				</li>
			</ul>
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

		$(function(){
			$("#sortable").sortable();
		});
	</script>
	<?php

// หน้านำเข้าไฟล์ .csv
}else if( $page === 'print_waypoint' ){

	$station_list = array(
		'register' => array(
			'ห้องทะเบียน' => 'ลงทะเบียน'
		),
		'lab' => array(
			'ห้องพยาธิ' => 'เจาะเลือด'
		),
		'xray' => array(
			'ห้องเอ็กเรย์' => 'X-RAY'
		),
		'vs' => array(
			'จุดคัดแยก' => 'V/S'
		),
		'pap' => array(
			'OPDสูติฯ' => 'PAP'
		),
		'va' => array(
			'OPDตา' => 'V/A'
		),
		'ekg' => array(
			'OPDตา' => 'EKG'
		)
	);

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
	$company = $_POST['company'];
	$date_start = $_POST['date_start'];
	$date_end = $_POST['date_end'];
	$stations = $_POST['step'];

	$file = $_FILES['file'];
	$content = file_get_contents($file['tmp_name']);
	$items = explode("\r\n", $content);

	$i = 1;
	foreach ($items as $key => $item) {

		if( empty($item) ){
			continue;
		}
		
		list($name, $surname, $age, $hn) = explode(',', $item);

		$hn = trim(str_replace(' ', '', $hn));

		// วว ดด ปปปป ไทยๆ
		list($y3, $m3, $d3) = explode('-', ad_to_bc($date_end));
		
		// !!! ยังไม่รองรับข้ามเดือน
		list($y, $m, $d) = explode('-', ad_to_bc($date_start));
		if( !empty($d3) && $d !== $d3 ){
			$d .= ' - '.$d3;
		}
		$date_checkup = $d.' '.$def_fullm_th[$m].' '.$y;
		
		$sql = "SELECT CONCAT(`yot`,`name`,' ',`surname`) AS `fullname`,`idcard`,`dbirth`,`address`,`tambol`,`ampur`,`changwat`,`phone` 
		FROM `opcard` 
		WHERE `hn` = '$hn'";
		$db->select($sql);
		$patient = $db->get_item();
		
		$fullname = $name.' '.$surname;
		$idcard = $patient['idcard'];
		$address = $patient['address'].' ต.'.$patient['tambol'].' อ.'.$patient['ampur'].' จ.'.$patient['changwat'];
		$phone = $patient['phone'];

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
											อายุ : <?=$age;?> ปี
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
					<table width="100%">
						<!--
						<tr>
							<td class="pdxpro" colspan="2"><strong>รายการตรวจสุขภาพ</strong></td>
						</tr>
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
										<?php 
										$station_i = 1;
										foreach ($stations as $key => $station) {
											$test_key = array_keys($station_list[$key]);
											$test_val = array_values($station_list[$key]);
											?>
											<td>
												<table width='120' border='1' cellpadding='0' cellspacing='0' bordercolor='#666666'>
													<tr align='center' style='line-height:16px'>
														<td>
															สถานี <?=$station_i;?><br>
															<?=$test_val['0'];?><br>
															<?=$test_key['0'];?><br>
															.............................
														</td>
													</tr>
												</table>
											</td>
											<?php
											$station_i++;
										}
										?>
								</table>
							</td>
						</tr>
					</table>
				</td>
			</tr>
		</table>
		<div class="pdx" style="margin-left:10px;">
			<strong>*** หมายเหตุ ***</strong><br />
			- เมื่อทำการตรวจครบทุกสถานีแล้ว นำเอกสารส่งคืนเจ้าหน้าที่ ณ จุดคัดแยก <br />
		</div>
		<?php 
		/*
		if( ( $i % 2 ) == 0 ){
			*/
			?>
			<div style="page-break-after: always;"></div>
			<?php
			/*
		}
		*/
		$i++;
	} // End foreach

}
?>