<?php
require_once 'bootstrap.php';
require_once 'includes/JSON.php';
$json = new Services_JSON();

if (authen() === false) {
	?>
	<p>กรุณา <a href="login_page.php?from=authen_report">Login</a> เข้าสู่ระบบอีกครั้ง</p>
	<?php
	exit;
}

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$request = file_get_contents( "php://input" );
$request = $json->decode($request);

$action = sprintf("%s", $request->action);

if($action==='search'){
	$value = sprintf("%s", $request->value);
	$type = sprintf("%s", $request->type);
	if(empty($value)){
		$res = array('status'=>400,'message'=>'ข้อมูลผิดพลาด');
	}else{

		$where = "`idcard` = '$idcard' ";
		if($type==='date'){
			$where = "`createdDate` LIKE '$value%' ";
		}
		$sql = "SELECT a.*,CONCAT(b.`yot`,b.`name`,' ',b.`surname`) AS `ptname` 
		FROM ( 
			SELECT `pid`,`claimType`,SUBSTRING(`createdDate`,1,10) AS `createdDate`,`claimCode`,`officer` FROM `api_authen` WHERE $where ORDER BY `createdDate` DESC
		) AS a 
		LEFT JOIN `opcard` AS b ON a.`pid` = b.`idcard` ";
		$q = $dbi->query($sql);
		$rows = $q->num_rows;
		if($rows>0){
			$res_data = array();
			while ($a = $q->fetch_assoc()) {
				$res_data[] = $a;
			}
			$res = array('status'=>200, 'rows'=>$rows, 'items'=>$res_data);
		}else{
			$res = array('status'=>204,'message'=>'ไม่พบข้อมูล');
		}
	}
	echo $json->encode($res);
	exit;
}

?>
<!doctype html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>ระบบรายงาน New AuthenCode API</title>
	<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
	<style>
		#notify-ie{
			background-color: #ffff97;
			border: 2px solid #464600;
			padding: 4px;
			text-align: center;
			vertical-align: middle;
			position: absolute;
			top: 0;
			left: 0;
			width: 100%;
			height: 100%;
		}
		@media print {
			.container {
				width:100%;
				max-width: unset;
			}
		}
	</style>
</head>
<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4 d-print-none">
		<div class="container-fluid">
			<a class="navbar-brand" href="../nindex.htm">HOME</a>
			<button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
				<span class="navbar-toggler-icon"></span>
			</button>
			<!-- <div class="collapse navbar-collapse" id="navbarNavDropdown">
				<ul class="navbar-nav">
					<li class="nav-item">
						<a class="nav-link active" aria-current="page" href="#">Home</a>
					</li>
				</ul>
			</div> -->
		</div>
	</nav>
	<div class="container">
		<h3>รายงาน New AuthenCode API</h3>
		<div class="row d-print-none">
			<div class="col">
				<form id="idcardForm">
					<div class="row mb-3">
						<label for="idcard" class="col-sm-3 col-form-label">เลขบัตรประชาชน</label>
						<div class="col-sm-8">
							<input type="text" class="form-control" id="idcard" name="idcard">
						</div>
					</div>
					<div class="col-md-3">
						<button type="submit" class="btn btn-primary mb-3">ค้นหาข้อมูล</button>
					</div>
				</form>
			</div>
			<div class="col">
				<form id="dateForm">
					<div class="row mb-3">
						<label for="inputDate" class="col-sm-2 col-form-label">เลือกวันที่</label>
						<div class="col-sm-3">
							<input type="date" class="form-control" id="inputDate" name="inputDate" value="2023-01-01">
						</div>
					</div>
					<div class="col-md-3">
						<button type="submit" class="btn btn-primary mb-3">ค้นหาข้อมูล</button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="table-responsive">
				<table class="table">
					<thead>
						<tr>
							<th>#</th>
							<th>วันที่บันทึก</th>
							<th>เลขบัตรประชาชน</th>
							<th>ชื่อ-สกุล</th>
							<th>Claim Type</th>
							<th>Claim Code</th>
							<th>เจ้าหน้าที่ผู้บันทึก</th>
						</tr>
					</thead>
					<tbody id="resHtml"></tbody>
				</table>
			</div>
		</div>
	</div>
	<?php 
	$ua = htmlentities($_SERVER['HTTP_USER_AGENT'], ENT_QUOTES, 'UTF-8');
	if (preg_match('~MSIE|Internet Explorer~i', $ua) || (strpos($ua, 'Trident/7.0') !== false && strpos($ua, 'rv:11.0') !== false)) {
		?>
		<div id="notify-ie">
			<p>ไมโครซอฟหยุด Support Internet Explorer ตั้งแต่ 15 มิถุนายน 2022 เป็นต้นไป<br>ดาวโหลด/อัพเดท เป็น <a href="https://www.microsoft.com/th-th/edge?r=1">Microsoft Edge</a> ได้แล้ววันนี้</p>
		</div>
		<?php
	}
	?>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
	<script type="template/javascript" id="authen_template">
	<tr>
		<td>{{auth_number}}</td>
		<td>{{auth_date}}</td>
		<td>{{auth_pid}}</td>
		<td>{{auth_ptname}}</td>
		<td>{{auth_type}}</td>
		<td>{{auth_code}}</td>
		<td>{{auth_officer}}</td>
	</tr>
	</script>
	<script>
		document.getElementById("idcardForm").onsubmit = function(ev){
			ev.preventDefault();
			var idcard = document.getElementById("idcard").value;
			search('idcard',idcard);
			return false;
		}

		document.getElementById("dateForm").onsubmit = function(ev){
			ev.preventDefault();
			var date = document.getElementById("inputDate").value;
			search('date',date);
			return false;
		}

		async function search(myType, v){
			let response = await fetch('authen_report.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify({'action':'search', 'type':myType, 'value':v})
			});

			if (!response.ok) {

			}

			let data = await response.json();
			if(data.status===200){
				let i =1;
				let html = '';
				data.items.forEach(el => { 
					var tem = document.getElementById('authen_template').innerHTML;
					
					tem = tem.replace(/{{auth_number}}/g, i, tem);
					tem = tem.replace(/{{auth_date}}/g, el.createdDate, tem);
					tem = tem.replace(/{{auth_pid}}/g, el.pid, tem);
					tem = tem.replace(/{{auth_ptname}}/g, el.ptname, tem);
					tem = tem.replace(/{{auth_type}}/g, el.claimType, tem);
					tem = tem.replace(/{{auth_code}}/g, el.claimCode, tem);
					tem = tem.replace(/{{auth_officer}}/g, el.officer, tem);
					i++;
					html += tem;
				});
				document.getElementById("resHtml").innerHTML = html;
			}else{
				document.getElementById("resHtml").innerHTML = '<tr><td colspan="7">'+data.message+'</td></tr>';
			}
		}
	</script>
</body>
</html>