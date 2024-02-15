<?php
session_start();
include 'config.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>ระบบตรวจสอบข้อมูลผู้ป่วยใน</title>
<meta name="viewport" content="width=device-width,initial-scale=1">

<link href="bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>

<style type="text/css">
	body {
		font-family: "TH SarabunPSK";
		background-color: #b2dfdb;
		font-size: 24px;
	}

	.sarabun {
		font-family: "TH SarabunPSK";
		font-size: 28px;
	}

	@media print {
		#no-print {
			display: none;
		}

		#sticker-contain {
			padding: 0;
		}
	}

	.clearfix::after {
		content: "";
		clear: both;
		display: table;
	}
	a{
		text-decoration: none;
	}
</style>

<body>
	<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
	<div class="container text-center">
		<h1 class="h1 p-4 fw-bold">ระบบตรวจสอบข้อมูลผู้ป่วยใน</h1>
		<form name="frm" id="frm" method="POST" action="show_dataipd.php">

			<div class="row">
				<div class="col">
					<div id="camera_container" style="display:none; position: relative;">
						<div id="camera_content"></div>
					</div>
				</div>
				<div class="col">
					<div class="mb-2">
						<button type="button" onclick="showCameraContainer()" class="sarabun btn btn-primary">เปิดกล้อง</button>
						<button type="button" onclick="checkHn()" class="sarabun btn btn-success">แสกน</button>
						<div id="camera_response" class="text-danger fw-bold"></div>
					</div>
					<div class="mb-2">
						<input type="text" name="an" id="search" size="22" id="an" class="sarabun" placeholder="กรุณาระบุ AN ผู้ป่วย" autofocus>
					</div>
					<div>
						<button type="submit" class="sarabun btn btn-success">ค้นหา</button>
						<input type="hidden" name="act" value="show">
					</div>
				</div>
			</div>
		</form>
		<div>
			<p class="text-danger fw-bold">*** กรณีใช้เครื่องยิง Barcode แล้วพบว่าตัวอักษรเป็นภาษาไทย ให้เปลี่ยนภาษาที่แป้นพิมพ์ ตัว &#126;เป็นภาษาอังกฤษก่อน ***</p>
		</div>
		<script>
			function showCameraContainer() {
				document.getElementById('camera_container').style.display = '';
				let html5QrcodeScanner = new Html5QrcodeScanner(
					"camera_content",
					{ fps: 10, qrbox: { width: 300, height: 300 } },
				/* verbose= */ false);
				html5QrcodeScanner.render(onScanSuccess, onScanFailure);

			}

			var testHn = '';
			function onScanSuccess(decodedText, decodedResult) {
				console.log(decodedText);
				testHn = decodedText;
			}

			function checkHn() {
				if (testHn === '') {
					document.getElementById('camera_response').innerHTML = 'กรุณาตั้ง QR Code ให้อยู่ในกรอบ';
					document.getElementById('search').value = '';
				} else {
					document.getElementById('camera_response').innerHTML = '';
					document.getElementById('search').value = testHn;
				}
			}

			function onScanFailure(error) {
				testHn = '';
			}

		</script>
		<?php
		$act = (!empty($_POST["act"])) ? sprintf("%s", $_POST["act"]) : '';
		if ($act == "show") {

			$an = sprintf("%s", $_POST["an"]);
			$sql1 = "SELECT `an`,`hn`,`ptname`,`ptright`,`bedcode`,`diag`,`doctor`,`my_ward`,`adm_w` FROM `ipcard`  WHERE `an` = '" . $an . "' AND `dcdate` ='0000-00-00 00:00:00' LIMIT 1 ";
			$resxult1 = $dbi->query($sql1);
			$num = $resxult1->num_rows;
			if ($num < 1) {
				?>
				<div>
					<p class="text-danger fw-bold">ไม่พบข้อมูลผู้ป่วย AN: <?= $an; ?> ในระบบผู้ป่วยใน กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง</p>
				</div>
				<?php
			} else {
				$ipcard = $resxult1->fetch_assoc();

				$an = $ipcard['an'];
				$hn = $ipcard['hn'];
				$ptname = $ipcard['ptname'];
				$ptright = $ipcard['ptright'];
				$bedcode = $ipcard['bedcode'];
				$diag = $ipcard['diag'];
				$doctor = $ipcard['doctor'];
				$my_ward = $ipcard['my_ward'];
				$adm_w = $ipcard['adm_w'];

				$query = "SELECT `idcard`,`bed`,`date`,date_format(`date`,'%d-%m-%Y'),`diagnos`,`food`,`price`,`paid`,`debt`,`caldate`,`bedname`,`chgdate`,`status`,`age`,`diag1`,`days` FROM `bed` WHERE `an` = '$an' ORDER BY `bedcode` ASC ";
				$result = $dbi->query($query);
				list($idcard, $bed, $date1, $date, $diagnos, $food, $price, $paid, $debt, $caldate, $bedname, $chgdate, $status, $age, $diag1, $daysall) = $result->fetch_array();
				$str = "month=" . date('m') . "&year=" . (date('Y') + 543) . "&date=" . date('dmy');

				//////// แพ้ยา ////////
				$list1 = array();
				$sql = "SELECT `tradname`,`advreact`,`sideeffects` FROM `drugreact`  WHERE `hn` = '$hn' AND `advreact` !=''";
				$resultDrugReact = $dbi->query($sql);
				$drugreact_rows = $resultDrugReact->num_rows;
				if ($drugreact_rows > 0) {
					while ($arr = $resultDrugReact->fetch_assoc()) {
						array_push($list1, $arr["tradname"]);
					}
					$list_drug1 = implode(", ", $list1);
					$drugreact_disease .= $list_drug1;
				} else {
					$drugreact_disease = "ปฎิเสธการแพ้ยา";
				}
				?>
				<div class="bg-light mb-4">
					<form name="f1" method="POST" action="" onsubmit="return checkForm();">
						<table width="100%" cellpadding="3" cellspacing="3">
							<tr>
								<td colspan="2" align="center"><b>แสดงข้อมูลผู้ป่วย</b></td>
							</tr>
							<tr>
								<td width="34%" align="right"><b>วันที่รับป่วย : </b></td>
								<td width="66%" align="left"><?= $date." ".substr($date1, 11);?></td>
							</tr>
							<tr>
								<td align="right"><b>AN : </b></td>
								<td align="left">
									<b><?= $an; ?></b><span style="margin-left:20px;">HN :<?= $hn; ?></span>
								</td>
							</tr>
							<tr>
								<td align="right"><b>ชื่อ - สกุล : </b></td>
								<td align="left"><?= $ptname; ?></td>
							</tr>
							<tr>
								<td align="right"><b>อายุ : </b></td>
								<td align="left"><?= $age; ?></td>
							</tr>
							<tr>
								<td align="right"><b>โรคประจำตัว : </b></td>
								<td align="left"><?= $diag1; ?></td>
							</tr>
							<tr>
								<td align="right"><b>แพ้ยา : </b></td>
								<td align="left"><?= $drugreact_disease; ?></td>
							</tr>
							<tr>
								<td align="right"><b>สิทธิ : </b></td>
								<td align="left"><?= $ptright; ?></td>
							</tr>
							<tr>
								<td align="right"><b>หอผู้ป่วยรับ : </b></td>
								<td align="left"><?= $my_ward; ?></td>
							</tr>
							<tr>
								<td align="right"><b>เตียง/ห้อง : </b></td>
								<td align="left"><?= $bedcode; ?></td>
							</tr>
							<tr valign="top">
								<td align="right"><b>อาหาร : </b></td>
								<td align="left"><?= $food; ?></td>
							</tr>
							<tr>
								<td align="right"><b>โรค : </b></td>
								<td align="left"><?= $diag; ?></td>
							</tr>
							<tr>
								<td align="right"><b>แพทย์ : </b></td>
								<td align="left"><?= $doctor; ?></td>
							</tr>
						</table>
					</form>
				</div>
					<div class="row row-cols-1 row-cols-md-4 g-4">
						<div class="col">
							<div class="card">
								<a href="ipd_labchk.php?an=<?=$an;?>&hn=<?=$hn;?>" target="_blank">
									<img src="images/blood-bag.png" class="card-img-top" alt="ข้อมูลการให้เลือด">
									<div class="card-body">
										<h5 class="card-title fw-bold">ข้อมูลการให้เลือด</h5>
									</div>
								</a>
							</div>
						</div>
						<div class="col">
							<div class="card">
								<a href="<?=SM3_HOST_URL;?>ipd_drugmar.php?an=<?=$an;?>&hn=<?=$hn;?>&<?=$str;?>" target="_blank">
									<img src="images/prescription.png" class="card-img-top" alt="ใบ MAR">
									<div class="card-body">
										<h5 class="card-title fw-bold">ใบ MAR</h5>
									</div>
								</a>
							</div>
						</div>
						<div class="col">
							<div class="card">
								<a href="ipd_drugorder.php?an=<?=$an;?>&hn=<?=$hn;?>" target="_blank">
									<img src="images/nurse.png" class="card-img-top" alt="จ่ายยาผู้ป่วย">
									<div class="card-body">
										<h5 class="card-title fw-bold">จ่ายยาผู้ป่วย</h5>
									</div>
								</a>
							</div>
						</div>
						<div class="col">
							<div class="card">
								<a href="<?=SM3_HOST_URL;?>ipd_drugchk.php?an=<?=$an;?>&hn=<?=$hn;?>&<?=$str;?>" target="_blank">
									<img src="images/drug.png" class="card-img-top" alt="Drugprofile">
									<div class="card-body">
										<h5 class="card-title fw-bold">Drugprofile</h5>
									</div>
								</a>
							</div>
						</div>
					</div>
				
				<?php
			}
		} // end if ($act == "show")
		?>
</body>

</html>