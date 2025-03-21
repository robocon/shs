<?php
include_once 'bootstrap.php';
include_once 'includes/JSON.php';
$json = new Services_JSON();
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$loginLevel = sprintf("%s", $_SESSION["sLevel"]);
if ($loginLevel !== 'admin') {
	echo "Invalid Level";
	exit;
}

function updateStatement($sql){
	global $dbi, $json;
	$q = $dbi->query($sql);
	if($q !== false) {
		$res = array('status'=>200, 'message'=> 'บันทึกข้อมูลเรียบร้อย');
	} else {
		$res = array('status'=>400, 'message'=> 'ไม่สามารถบันทึกข้อมูลได้ '.$dbi->error);
	}
	echo $json->encode($res);
	exit;
}

$act = sprintf("%s", $_REQUEST["act"]);
if ($act == "editFullname") {

	$fullname = sprintf("%s", $_POST["fullname"]);
	$row_id = sprintf("%s", $_POST["row_id"]);

	updateStatement("UPDATE `inputm` SET `name`='$fullname' WHERE `row_id`='$row_id' LIMIT 1");
	exit;

} elseif ($act == "updatePass") {

	$row_id = sprintf("%s", $_POST["row_id"]);
	$password = sprintf("%s", $_POST["password"]);

	updateStatement("UPDATE `inputm` SET `pword`='$password' WHERE `row_id`='$row_id' LIMIT 1");
	exit;

} elseif ($act == "updateLevel") {

	$row_id = sprintf("%s", $_POST["row_id"]);
	$userlevel = sprintf("%s", $_POST["userlevel"]);

	updateStatement("UPDATE `inputm` SET `level`='$userlevel' WHERE `row_id`='$row_id' LIMIT 1");
	exit;

}elseif ($act == "editUsername") {

	$row_id = sprintf("%s", $_POST["row_id"]);
	$username = sprintf("%s", $_POST["username"]);

	$q = $dbi->query("UPDATE `inputm` SET `idname`='$username' WHERE `row_id`='$row_id' LIMIT 1");
	if($q !== false) {
		$res = array('status'=>200, 'message'=> 'บันทึกข้อมูลเรียบร้อย');
	} else {
		if($dbi->errno==1062){
			$message = 'มีผู้ใช้งานนี้แล้ว กรุณาเปลี่ยนชื่อผู้ใช้งานใหม่';
		}else{
			$message = 'ไม่สามารถบันทึกข้อมูลได้ ['.$dbi->errno.'] ไม่ควรใช้ Single Quote(\') หรือ Double Quote(\") ในการตั้งชื่อ กราบบบบละครับ<br>'.$dbi->error;
		}
		$res = array('status'=>400, 'message'=> $message);
	}
	echo $json->encode($res);
	exit;

}elseif ($act == "updateDepartment") {

	$row_id = sprintf("%s", $_POST["row_id"]);
	$department = sprintf("%s", $_POST["department"]);

	$sql = "UPDATE `inputm` SET `menucode`='$department' WHERE `row_id`='$row_id' LIMIT 1";
	updateStatement($sql);
	exit;
}





$id = sprintf("%s", $_GET["id"]);
$menucode = sprintf("%s", $_GET["menucode"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>จัดการข้อมูลผู้ใช้งานระบบ</title>
	<link rel="icon" href="images/favicon-16x16.png" sizes="16x16" type="image/png">
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="bootstrap/bootstrap-icons-1.11.3/font/bootstrap-icons.min.css" rel="stylesheet">
    <script src="bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="js/sweetalert2.all.min.js"></script>
</head>
<body>
<?php 
require_once 'com_user_menu.php';
?>
<style type="text/css">
	body,td,th {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	.forntsarabun {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
	label:hover{
		cursor: pointer;
	}
</style>
<div class="container mt-4">
	<h3>แก้ไขข้อมูลผู้ใช้งานระบบ</h3>
	<?php
	$sql = "SELECT * FROM inputm WHERE row_id='$id'";
	$q = $dbi->query($sql);
	$num = $q->num_rows;
	if ($num === 0) {
		?><h3>ไม่พบข้อมูล</h3><?php
	}
	$rows = $q->fetch_assoc();
	?>
	<form action="edituser.php?act=edit" method="post" name="form1" class="border-bottom" onsubmit="return formUpdateFullname()">
		<div class="mb-3 row">
			<label for="fullname" class="col-sm-2 col-form-label">ชื่อ-นามสกุล : </label>
			<div class="col-sm-6 col-md-4">
				<input type="text" class="form-control" id="fullname" name="fullname" value="<?= $rows["name"]; ?>">
			</div>
		</div>
		<div class="mb-3 row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary" id="editFullname">บันทึก</button>
				<input name="act" type="hidden" value="editFullname">
				<input name="row_id" type="hidden" value="<?=$id;?>">
			</div>
		</div>
	</form>

	<form action="edituser.php?act=editUsername" method="post" name="form2" class="border-bottom mt-4" onsubmit="return formUpdateUsername()">
		<div class="mb-3 row">
			<label for="username" class="col-sm-2 col-form-label">ชื่อผู้ใช้งาน : </label>
			<div class="col-sm-6 col-md-4">
				<input type="text" class="form-control" id="username" name="username" value="<?= $rows["idname"]; ?>">
			</div>
		</div>
		<div class="mb-3 row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary" id="saveFullname">บันทึก</button>
				<input name="act" type="hidden" value="editUsername">
			</div>
		</div>
	</form>
	
	<form action="edituser.php?act=updatePass" method="post" name="form3" onsubmit="return checkPassword()" class="border-bottom mt-4">
		<div class="mb-3 row">
			<label for="password" class="col-sm-2 col-form-label">รหัสผ่าน : </label>
			<div class="col-sm-6 col-md-4">
				<input type="password" class="form-control" id="password" name="password">
			</div>
		</div>
		<div class="mb-3 row">
			<label for="password2" class="col-sm-2 col-form-label">ยืนยันรหัสผ่าน : </label>
			<div class="col-sm-6 col-md-ุ">
				<input type="password" class="form-control" id="password2" name="password2">
				<input type="checkbox" name="" id="showPass" onclick="showPassword(this.checked)"> <label for="showPass"><strong>แสดงรหัสผ่าน</strong> &lt;&lt; ไม่แน่ใจว่าตั้งรหัสผ่านถูกต้องรึป่าว กดดูได้ครับ</label>
			</div>
		</div>
		<div class="mb-3 row">
			<div class="alert alert-warning" role="alert">
				<strong>คำแนะนำในการตั้งรหัสผ่าน</strong>
				<ol>
					<li>ควรมีจำนวนตั้งแต่ 8 ตัวอักษรขึ้นไป</li>
					<li>รหัสผ่านควรมีตัวพิมพ์เล็ก(a-z) พิมพ์ใหญ่(A-Z) ตัวเลข(1-9) และ อักขระพิเศษ ( !@#$%^&*[]_+ ) ผสมกัน</li>
				</ol>
			</div>
		</div>
		<div class="mb-3 row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary" id="savePassword">บันทึก</button>
				<input name="act" type="hidden" value="updatePass">
				
			</div>
		</div>
	</form>
	<script>
		function checkPassword() {
			let res = true;
			let p1 = document.getElementById('password').value;
			let p2 = document.getElementById('password2').value;
			if (p1 == '' || p2 == '') {
				Swal.fire("รหัสผ่านไม่ควรเป็นค่าว่าง");
				res = false;
			}else if(p1.length<8 || p2.length<8){
				Swal.fire("ความยาวรหัสผ่านไม่ควรน้อยกว่า 8 ตัวอักษร");
				res = false;
			}else if (p1 != p2) {
				Swal.fire("รหัสผ่านไม่ตรงกัน");
				res = false;
			}else if(p1=='12345678'){
				Swal.fire("เปลี่ยนรหัสเป็นตัวอื่นเถอะจ้า IT Audit มาตรวจแล้วบอกปวดหัว<br>ไม่คิดรักษาความปลอดภัยในข้อมูลตัวเองเลยหรอ?");
				res = false;
			}
			console.log(res);
			// if(res===true){
			// 	formUpdatePassword();
			// }

			return false;
		}

		function showPassword(checkStatus) {
            if (checkStatus === true) {
                document.getElementById('password').type = 'text';
                document.getElementById('password2').type = 'text';
            } else {
                document.getElementById('password').type = 'password';
                document.getElementById('password2').type = 'password';
            }
        }
	</script>
	
	<form action="edituser.php?act=updateLevel" method="post" name="form4" class="border-bottom mt-4" onsubmit="return formUpdateLevel()">
		<div class="mb-3 row">
			<label for="password" class="col-sm-2 col-form-label">ระดับผู้ใช้งาน : </label>
			<div class="col-sm-6 col-md-4">
				<?php
				$levelList = array('user','admin');
				?>
				<select name="userlevel" id="userlevel" class="form-select">
					<?php
					foreach ($levelList as $ll) {
						$selected = ($ll == $rows['level']) ? 'selected="selected"' : '' ;
						?>
						<option value="<?=$ll;?>" class="forntsarabun" <?=$selected;?> ><?=$ll;?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
		<div class="mb-3 row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary" id="saveLevel">บันทึก</button>
			</div>
		</div>
	</form>
	
	<form action="edituser.php?act=updateDepartment" method="post" name="form5" class="mt-4" onsubmit="return formUpdateDepartment()">
		<div class="mb-3 row">
			<label for="password" class="col-sm-2 col-form-label">แผนกผู้ใช้งาน : </label>
			<div class="col-sm-6 col-md-4">
				<select name="department" id="department" class="form-select">
					<option name="" id="">-- เลือกแผนก --</option>
					<?php 
					$departments = array(
						'ADMCOM' => 'ศูนย์คอมพิวเตอร์',
						'ADMOPD' => 'ทะเบียน',
						'ADMWF' => 'หอผู้ป่วยรวม',
						'ADMICU' => 'หอผู้ป่วยหนัก',
						'ADMVIP' => 'หอผู้ป่วยพิเศษ',
						'ADMMAINREPORT' => 'กองบังคับการ',
						'ADMPT' => 'กายภาพบำบัด/นวดแผนไทย/เวชศาสตร์ฟื้นฟู',
						'ADMOBG' => 'หอผู้ป่วยสูตินรีเวชกรรม',
						'ADMHEM' => 'ห้องไตเทียม',
						'ADMSUR' => 'ห้องผ่าตัด/วิสัญญี',
						'ADMPHA' => 'กองเภสัชกรรม',
						'ADMPHARX' => 'เภสัชกร',
						'ADMDEN' => 'กองทันตกรรม',
						'ADMER' => 'ห้องฉุกเฉิน',
						'ADMMAINOPD' => 'ห้องตรวจโรคผู้ป่วยนอก',
						'ADMMON' => 'ส่วนเก็บเงินรายได้',
						'ADMNHSO' => 'ห้องประกันสุขภาพฯ',
						'ADMLAB' => 'แผนกพยาธิวิทยา',
						'ADMXR' => 'แผนกรังสีกรรม/ตรวจมวลกระดูก',
						'ADMCMS' => 'ห้องจ่ายกลาง',
						'ADMSSO' => 'ประกันสังคม',
						'ADMNID' => 'ห้องฝังเข็ม',
						'ADMEYE' => 'ห้องตรวจตา',
						'ADMFOD' => 'โภชนาการ',
						'ADMNEWCHKUP' => 'ตรวจสุขภาพ',
						'ADMLIBRARY'=>'ส่งเสริมสุขภาพ'
					);
					foreach ($departments as $key => $value) { 
						$selected = ($rows['menucode'] == $key) ? 'selected="selected"' : '' ;
						?>
						<option value="<?=$key;?>" class="forntsarabun" <?=$selected;?> ><?=$value;?></option>
						<?php
					}
					?>
				</select>
			</div>
		</div>
		<div class="mb-3 row">
			<div class="alert alert-warning" role="alert">แผนกที่ตกหล่นไม่มีข้อมูล สามารถแจ้งมาที่ศูนย์คอมฯ เพื่อทำการอัพเดท</div>
		</div>
		<div class="mb-3 row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-primary" id="saveDepart">บันทึก</button>
				
			</div>
		</div>
	</form>
	<script>
		async function sendForm(dataPost){
            let response = await fetch('edituser.php', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/x-www-form-urlencoded; charset=UTF-8'
                },
                body: dataPost
            });
            const body = await response.json();
            return body;
        }

		function formUpdateFullname(){
			
			let fullname = document.getElementById('fullname').value.trim();
			if(fullname === ''){
				Swal.fire("กรุณาใส่ชื่อ-นามสกุล");
				return false;
			}else if(fullname.length < 4){
				Swal.fire("ความยาวชื่อ-นามสกุล อย่างน้อยควรมากกว่า 4ตัวอักษร");
				return false;
			}else if(fullname.match(/admin/gi)){
				Swal.fire("admin ไม่ใช่ชื่อจริง กรุณาใส่ชื่อจริง");
				return false;
			}

			let data = [];
			data.push(encodeURIComponent('act') + "=" + encodeURIComponent('editFullname'));
            data.push(encodeURIComponent('fullname') + "=" + encodeURIComponent(fullname));
            data.push(encodeURIComponent('row_id') + "=" + encodeURIComponent('<?=$id;?>'));
            let dataPost = data.join("&");

			sendForm(dataPost).then((res)=>{
				Swal.fire(res.message);
			});

			return false;
		}

		function formUpdateUsername(){
			let username = document.getElementById('username').value.trim();
			const regexF = /(admin|test|user)/i;
			if(username === ''){
				Swal.fire("กรุณาใส่ชื่อผู้ใช้งาน");
				return false;
			}else if(username.length < 4){
				Swal.fire("ชื่อผู้ใช้งาน ควรยาวมากกว่า 4ตัวอักษร");
				return false;
			}else if(username.match(regexF)!=null){
				Swal.fire("มีผู้ใช้งานแล้ว กรุณาเปลี่ยนไปใช้ชื่ออื่น");
				return false;
			}

			let data = [];
			data.push(encodeURIComponent('act') + "=" + encodeURIComponent('editUsername'));
            data.push(encodeURIComponent('username') + "=" + encodeURIComponent(username));
            data.push(encodeURIComponent('row_id') + "=" + encodeURIComponent('<?=$id;?>'));
            let dataPost = data.join("&");

			sendForm(dataPost).then((res)=>{
				Swal.fire(res.message);
			});

			return false;
		}

		function formUpdatePassword(){
			let password = document.getElementById('password2').value.trim();

			let data = [];
			data.push(encodeURIComponent('act') + "=" + encodeURIComponent('updatePass'));
            data.push(encodeURIComponent('password') + "=" + encodeURIComponent(password));
            data.push(encodeURIComponent('row_id') + "=" + encodeURIComponent('<?=$id;?>'));
            let dataPost = data.join("&");

			sendForm(dataPost).then((res)=>{
				Swal.fire(res.message);
				if(res.status===200){
					document.getElementById('password').value='';
					document.getElementById('password2').value='';
				}
			});
			
		}

		function formUpdateLevel(){
			let userlevel = document.getElementById('userlevel').value.trim();

			let data = [];
			data.push(encodeURIComponent('act') + "=" + encodeURIComponent('updateLevel'));
            data.push(encodeURIComponent('userlevel') + "=" + encodeURIComponent(userlevel));
            data.push(encodeURIComponent('row_id') + "=" + encodeURIComponent('<?=$id;?>'));
            let dataPost = data.join("&");

			sendForm(dataPost).then((res)=>{
				Swal.fire(res.message);
			});
			return false;
		}

		function formUpdateDepartment(){
			let department = document.getElementById('department').value.trim();

			let data = [];
			data.push(encodeURIComponent('act') + "=" + encodeURIComponent('updateDepartment'));
            data.push(encodeURIComponent('department') + "=" + encodeURIComponent(department));
            data.push(encodeURIComponent('row_id') + "=" + encodeURIComponent('<?=$id;?>'));
            let dataPost = data.join("&");

			sendForm(dataPost).then((res)=>{
				Swal.fire(res.message);
			});
			return false;
		}
	</script>
</div>

</body>
</html>