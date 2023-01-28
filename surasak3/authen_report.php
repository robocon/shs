<?php
require_once 'bootstrap.php';

if (authen() === false) {
	?>
	<p>กรุณา <a href="../nindex.htm">Login</a> เข้าสู่ระบบอีกครั้ง</p>
	<?php
	exit;
}

$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$action = sprintf("%s", $_REQUEST['action']);

if($action==='search'){
	$date = sprintf("%s", $_REQUEST['inputDate']);

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
</head>

<body>
	<nav class="navbar navbar-expand-md navbar-dark bg-dark mb-4">
		<div class="container-fluid">
			<a class="navbar-brand" href="#">HOME</a>
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
		<div class="row">
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
		
	</div>
	<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js" integrity="sha384-w76AqPfDkMBDXo30jS1Sgez6pr3x5MlQ1ZAGC+nuZB+EYdgRZgiwxhTBTkF7CXvN" crossorigin="anonymous"></script>
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

			let data = {'type':myType, 'value':v};

			await fetch('/my/urlauthen_report.php', {
				method: 'POST',
				headers: {
					'Content-Type': 'application/json'
				},
				body: JSON.stringify(data)
			});

			if (!response.ok) {

			}

			const body = await response.text();
		}
	</script>
</body>
</html>