<?php
session_start();
include 'config.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", (!empty($_GET['hn']) ? $_GET['hn'] : '' ));
$an = sprintf("%s", (!empty($_GET['an']) ? $_GET['an'] : '' ));

$drugcode = sprintf("%s", (!empty($_POST['drugcode']) ? $_POST['drugcode'] : ''));
$act = sprintf("%s", (!empty($_POST['act']) ? $_POST['act'] : '' ));

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>จ่ายยาผู้ป่วยใน</title>
<meta name="viewport" content="width=device-width,initial-scale=1">

<link href="bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<script src="bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style type="text/css">
	body {
		font-family: "TH SarabunPSK";
		background-color: #e1f5fe;
		font-size: 24px;
	}

	.sarabun {
		font-family: "TH SarabunPSK";
		font-size: 28px;
	}
	.sarabunPSK{
		font-family: "TH SarabunPSK";
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
	#customThColor th{
		background-color: #EC7063;
	}
	#customTdColor td{
		background-color: #F5B7B1;
	}
	#customTdColor td a:hover{
		background-color: #0a58ca!important;
		color: white;
	}
</style>

<body>
	<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>
	<?php 
	$sql = "SELECT ptname FROM bed WHERE an = '$an' ";
	$q = $dbi->query($sql);
	$bed = $q->fetch_assoc();
	?>
	<div class="container text-center">
		<div class="row row-cols-1 row-cols-md-2 mt-2">
			<div class="col mb-2">
				<img src="images/drug.png" width="64" height="64px">
			</div>
			<div class="col mb-2">
				<h1 class="h1 mt-2 fw-bold">ระบบตรวจสอบการจ่ายยาผู้ป่วยใน<br>AN: <?=$an;?> <?=$bed['ptname'];?></h1></h1>
			</div>
		</div>
		<form name="frm" id="frm" method="POST" action="ipd_drugorder.php?hn=<?=$hn;?>&an=<?=$an;?>">
			<div class="row row-cols-1 row-cols-md-2">
				<div class="col mb-2">
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
					<div class="mb-2" style="margin-left:auto; margin-right:auto; display:table;">
						<div class="input-group">
							<input type="text" class="form-control sarabun" placeholder="ระบุรหัสยา" size="22" name="drugcode" id="drugcode" autofocus value="<?=$drugcode;?>">
							<button class="btn btn-primary" type="button" onclick="clearInput()"><i class="bi bi-x-circle"></i></button>
						</div>
					</div>
					<div>
						<button type="submit" class="sarabun btn btn-success">ค้นหา</button>
						<input type="hidden" name="act" id="act" value="search">
                        <input type="hidden" name="hn" id="hn" value="<?=$hn?>">
                        <input type="hidden" name="an" id="an" value="<?=$an?>">
					</div>
				</div>
			</div>
		</form>
		<div>
			<p class="text-danger fw-bold">*** กรณีใช้เครื่องยิง Barcode แล้วพบว่าตัวอักษรเป็นภาษาไทย ***<br>*** ให้เปลี่ยนภาษาที่แป้นพิมพ์ ตัว &#126; เป็นภาษาอังกฤษก่อน ***</p>
		</div>
		<?php 
		if($act==='search'){
			$hn = sprintf("%s", (!empty($_POST['hn']) ? $_POST['hn'] : '' ));
			$an = sprintf("%s", (!empty($_POST['an']) ? $_POST['an'] : '' ));
			
			$sql1 = "SELECT `row_id`,`drugcode`,`tradname`,`slcode`,`statcon`,`amount`,`unit` 
			FROM `dgprofile` 
			WHERE `an` = '$an' 
			AND `drugcode` = '$drugcode' 
			AND `onoff`='ON'
			AND `slcode`  <> '' 
			AND  `statcon` IS NOT NULL";
			$q = $dbi->query($sql1);
			if($q->num_rows>0){

				$showdate=date("d/m/").(date("Y")+543);

				?>
				<div class="text-center">
					<p class="h1 fw-bold sarabunPSK">รายการยาที่ต้องการจ่ายให้ผู้ป่วย ประจำวันที่ <?=$showdate;?></p>
				</div>
				<table class="table table-hover">
					<thead class="" id="customThColor">
						<tr>
							<th>ลำดับ</th>
							<th>รหัสยา</th>
							<th>ชื่อยา</th>
							<th>จำนวน</th>
							<th>หน่วยนับ</th>
							<th>วิธีใช้</th>
							<th>ประเภท</th>
							<th>ดำเนินการ</th>
						</tr>
					</thead>
					<tbody id="customTdColor">
						<?php 
						$i = 1;
						while ($a = $q->fetch_assoc()) { 
							$row_id = $a['row_id'];
							$drugcode = $a['drugcode'];

							// <a href=\"ipd_drugorder_form.php?row_id=$row_id&an=$getan&hn=$gethn&drugcode=$drugcode&act=$getact\">จ่ายยา</a>
							$href = SM3_HOST_URL."ipd_drugorder_form.php?row_id=$row_id&an=$an&hn=$hn&drugcode=$drugcode"
							?>
							<tr>
								<td><?=$i;?></td>
								<td><?=$a['drugcode'];?></td>
								<td><?=$a['tradname'];?></td>
								<td><?=$a['amount'];?></td>
								<td><?=$a['unit'];?></td>
								<td><?=$a['slcode'];?></td>
								<td><?=$a['statcon'];?></td>
								<td><a href="<?=$href;?>" class="btn btn-outline-primary fw-bold" style="background-color: white;">จ่ายยา</a></td>
							</tr>
							<?php
							$i++;
						}
						?>
						
					</tbody>
				</table>
				<?php
			}else{
				?>
				<p class="fw-bold">ไม่พบข้อมูล</p>
				<?php
			}
			
		}
		?>
		<script>
			function clearInput(){
				document.getElementById('drugcode').value = '';
			}

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
					document.getElementById('drugcode').value = '';
				} else {
					document.getElementById('camera_response').innerHTML = '';
					document.getElementById('drugcode').value = testHn;
				}
			}

			function onScanFailure(error) {
				testHn = '';
			}
		</script>
</body>

</html>