<?php
session_start();
include 'config.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$hn = sprintf("%s", (!empty($_GET['hn']) ? $_GET['hn'] : '' ));
$an = sprintf("%s", (!empty($_GET['an']) ? $_GET['an'] : '' ));
$labnumber = sprintf("%s", (!empty($_GET['labnumber']) ? $_GET['labnumber'] : ''));
$act = (!empty($_GET["act"])) ? sprintf("%s", $_GET["act"]) : '';

if ($act == "search") {

	$sqlResulthead = "SELECT `labnumber` FROM `resulthead` WHERE `hn` = '$hn' AND `labnumber` = '$labnumber' LIMIT 1";
	$qResulthead = $dbi->query($sqlResulthead);
	$rows = $qResulthead->num_rows;
	
	if($rows > 0){  //ข้อมูลถูกต้อง

		$sql1 = "SELECT `autonumber`,DATE_FORMAT(`orderdate`,'%Y-%m-%d') AS `dateresult`, 
		DATE_FORMAT(orderdate,'%d') as `dateresult2`, 
		DATE_FORMAT(orderdate,'%m') as `dateresult4`, 
		DATE_FORMAT(orderdate,'%Y') as `dateresult3`,`labnumber`,`sourcename`,`clinicianname`,`profilecode` 
		FROM `resulthead` WHERE `hn` = '$hn' 
		GROUP BY `labnumber` 
		ORDER BY `orderdate` DESC";
		$query = $dbi->query($sql1);
		$result = $query->fetch_assoc();
		$dateresult=$result["dateresult"];
		$sourcename=$result["sourcename"];
		$clinicianname=$result["clinicianname"];
		$list_lab=$result["profilecode"];

		$url = SM3_HOST_URL.'lab_lst_print_opd1new.php?hn='.$hn;
		$url .= '&lab_date='.$dateresult;
		$url .= '&labnumber='.$labnumber;
		$url .= '&listlab='.$list_lab;
		$url .= '&depart='.$sourcename;
		$url .= '&doctor='.$clinicianname;

		$res = array('status'=>200,'data'=>array('url'=>$url,'detail'=>''));

	}else{
		$res = array('status'=>400,'errors'=>array('status'=>400,'detail'=>'ไม่พบข้อมูล'));
	}

	echo json_encode($res);
	exit;
} // end if ($act == "show")

?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>การให้เลือดผู้ป่วยใน</title>
<meta name="viewport" content="width=device-width,initial-scale=1">

<link href="bootstrap-5.3.2/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">

<script src="bootstrap-5.3.2/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

<style type="text/css">
	body {
		font-family: "TH SarabunPSK";
		background-color: #f9bdbb;
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
				<img src="images/blood-bag.png" width="64" height="64px">
			</div>
			<div class="col mb-2">
				<h1 class="h1 mt-2 fw-bold">ระบบตรวจสอบข้อมูลการให้เลือดผู้ป่วยใน<br>AN: <?=$an;?> <?=$bed['ptname'];?></h1>
			</div>
		</div>
		<form name="frm" id="frm" method="GET" action="ipd_labchk.php">
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
							<input type="text" class="form-control sarabun" placeholder="ระบุ Lab Number" size="22" name="labnumber" id="labnumber" autofocus value="<?=$labnumber;?>">
							<button class="btn btn-primary" type="button" onclick="clearInput()"><i class="bi bi-x-circle"></i></button>
						</div>
					</div>
					<div>
						<button type="submit" class="sarabun btn btn-success">ค้นหา</button>
                        <input type="hidden" name="hn" id="hn" value="<?=$hn?>">
                        <input type="hidden" name="an" id="an" value="<?=$an?>">
					</div>
				</div>
			</div>
		</form>
		<div>
			<p class="text-danger fw-bold">*** กรณีใช้เครื่องยิง Barcode แล้วพบว่าตัวอักษรเป็นภาษาไทย ***<br>*** ให้เปลี่ยนภาษาที่แป้นพิมพ์ ตัว &#126; เป็นภาษาอังกฤษก่อน ***</p>
		</div>
		<script>
			function clearInput(){
				document.getElementById('labnumber').value = '';
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
					document.getElementById('labnumber').value = '';
				} else {
					document.getElementById('camera_response').innerHTML = '';
					document.getElementById('labnumber').value = testHn;
				}
			}

			function onScanFailure(error) {
				testHn = '';
			}

			document.getElementById('frm').addEventListener("submit", function(event){
				
				event.preventDefault();

				let labnumber = document.getElementById('labnumber').value.trim();
				let act = 'search';
				let hn = document.getElementById('hn').value;
				let an = document.getElementById('an').value;

				let url = `ipd_labchk.php?labnumber=${encodeURIComponent(labnumber)}&act=${encodeURIComponent(act)}&hn=${encodeURIComponent(hn)}&an=${encodeURIComponent(an)}`;

				if(labnumber==''){
					Swal.fire({
						icon: "error",
						title: "กรุณาใส่ Labnumber"
					});
				}else{
					sendFrmSubmit(url).then(function(res){
						
						if(res.status===200){ 

							window.open(res.data.url,"LabNewWindows","width=800,height=600");

						}else if(res.status===400){
							Swal.fire({
								icon: "error",
								title: "Labnumber ไม่ถูกต้อง"
							});
						}
					});
				}
			});

			async function sendFrmSubmit(url){
				const response = await fetch(url);
				const data = await response.json();
				return data;
			}

		</script>
</body>

</html>