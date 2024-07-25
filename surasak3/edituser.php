<?php
include 'bootstrap.php';
$dbi = new mysqli(HOST, USER, PASS, DB);
$dbi->query("SET NAMES UTF8");

$loginLevel = sprintf("%s", $_SESSION["sLevel"]);

if ($loginLevel !== 'admin') {
	echo "Invalid Level";
	exit;
}

$act = sprintf("%s", $_GET["act"]);
if ($act == "edit") {

	$txtname = sprintf("%s", $_POST["txtname"]);
	$row_id = sprintf("%s", $_POST["row_id"]);
	$menucode = sprintf("%s", $_POST["menucode"]);
	$sql = "UPDATE `inputm` SET `name`='$txtname' WHERE `row_id`='$row_id' LIMIT 1";
	$q = $dbi->query($sql);
	redirect('edituser.php?menucode='.$menucode.'&id='.$row_id, 'บันทึกข้อมูลเรียบร้อย');
	exit;
} elseif ($act == "updatePass") {

	$row_id = sprintf("%s", $_POST["row_id"]);
	$password = sprintf("%s", $_POST["password"]);
	$menucode = sprintf("%s", $_POST["menucode"]);
	$sql = "UPDATE `inputm` SET `pword`='$password' WHERE `row_id`='$row_id' LIMIT 1";
	$q = $dbi->query($sql);
	redirect('edituser.php?menucode='.$menucode.'&id='.$row_id, 'บันทึกข้อมูลเรียบร้อย');
	exit;
} elseif ($act == "updateLevel") {

	$row_id = sprintf("%s", $_POST["row_id"]);
	$userlevel = sprintf("%s", $_POST["userlevel"]);
	$menucode = sprintf("%s", $_POST["menucode"]);

	$sql = "UPDATE `inputm` SET `level`='$userlevel' WHERE `row_id`='$row_id' LIMIT 1";
	$q = $dbi->query($sql);
	redirect('edituser.php?menucode='.$menucode.'&id='.$row_id, 'บันทึกข้อมูลเรียบร้อย');
	exit;
}elseif ($act == "editUsername") {

	$row_id = sprintf("%s", $_POST["row_id"]);
	$username = sprintf("%s", $_POST["username"]);
	$menucode = sprintf("%s", $_POST["menucode"]);

	$sql = "UPDATE `inputm` SET `idname`='$username' WHERE `row_id`='$row_id' LIMIT 1";
	$q = $dbi->query($sql);
	redirect('edituser.php?menucode='.$menucode.'&id='.$row_id, 'บันทึกข้อมูลเรียบร้อย');
	exit;
}elseif ($act == "updateDepartment") {

	$row_id = sprintf("%s", $_POST["row_id"]);
	$department = sprintf("%s", $_POST["department"]);
	$menucode = sprintf("%s", $_POST["menucode"]);

	$sql = "UPDATE `inputm` SET `menucode`='$department' WHERE `row_id`='$row_id' LIMIT 1";
	$q = $dbi->query($sql);
	redirect('edituser.php?menucode='.$menucode.'&id='.$row_id, 'บันทึกข้อมูลเรียบร้อย');
	exit;
}





$id = sprintf("%s", $_GET["id"]);
$menucode = sprintf("%s", $_GET["menucode"]);
?>
<style type="text/css">
	body,
	td,
	th {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}

	.forntsarabun {
		font-family: "TH SarabunPSK";
		font-size: 20px;
	}
</style>
<div>
	<a href="showuser.php?menucode=<?= $menucode; ?>">&lt;&lt;&nbsp;กลับไปหน้าจัดการผู้ใช้งาน</a>
</div>
<div align="center">
	<?php 
	if(!empty($_SESSION['x-msg'])){
		?>
		<div style="background-color: #00b30e; color:#ffffff; border:4px solid #007d0a; padding: 4px;">
			<?=$_SESSION['x-msg'];?>
		</div>
		<?php
		unset($_SESSION['x-msg']);
	}
	?>
	<p><strong>แก้ไขข้อมูลผู้ใช้งานระบบ</strong></p>
	<?php
	$sql = "SELECT * FROM inputm WHERE row_id='$id'";
	$q = $dbi->query($sql);
	$num = $q->num_rows;
	if ($num === 0) {
		echo "ไม่พบข้อมูล";
		exit;
	}
	$rows = $q->fetch_assoc();
	?>
	<form action="edituser.php?act=edit" method="post" name="form1">
		<table width="50%" border="0" cellspacing="0" cellpadding="5">
			<tr>
				<td width="34%" align="right" bgcolor="#FF9999"><strong>ชื่อ-นามสกุล : </strong></td>
				<td width="66%" bgcolor="#FFCCCC">
					<label>
						<input name="txtname" type="text" class="forntsarabun" id="txtname" size="25" value="<?= $rows["name"]; ?>">
					</label>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FF9999">&nbsp;</td>
				<td bgcolor="#FF9999">
					<label>
						<input type="submit" name="button" id="button" class="forntsarabun" value="บันทึก">
					</label>
					<input name="act" type="hidden" value="edit">
					<input name="row_id" type="hidden" value="<?= $id; ?>">
					<input name="menucode" type="hidden" value="<?= $menucode; ?>">
				</td>
			</tr>
		</table>
	</form>
	<form action="edituser.php?act=editUsername" method="post" name="form1">
		<table width="50%" border="0" cellspacing="0" cellpadding="5">
			<tr>
				<td width="34%" align="right" bgcolor="#FF9999"><strong>ชื่อผู้ใช้งาน : </strong></td>
				<td width="66%" bgcolor="#FFCCCC">
					<label>
						<input name="username" type="text" class="forntsarabun" id="username" size="25" value="<?=$rows['idname'];?>">
					</label>
				</td>
			</tr>
			<tr>
				<td bgcolor="#FF9999">&nbsp;</td>
				<td bgcolor="#FF9999">
					<label>
						<input type="submit" name="button" id="button" class="forntsarabun" value="บันทึก">
					</label>
					<input name="act" type="hidden" value="editUsername">
					<input name="row_id" type="hidden" value="<?=$id;?>">
					<input name="menucode" type="hidden" value="<?=$menucode;?>">
				</td>
			</tr>
		</table>
	</form>
	<div>
		<form action="edituser.php?act=updatePass" method="post" name="form1" onsubmit="return checkPassword()">

			<table width="50%" border="0" cellspacing="0" cellpadding="5">
				<tr>
					<td width="34%" align="right" bgcolor="#FF9999"><strong><label for="password">ตั้งรหัสผ่านใหม่ :
							</label></strong></td>
					<td width="66%" bgcolor="#FFCCCC">
						<input name="password" type="password" class="forntsarabun" id="password" size="25" value="">
					</td>
				</tr>
				<tr>
					<td width="34%" align="right" bgcolor="#FF9999"><strong><label for="password2">ยืนยันรหัสผ่านใหม่ :
							</label></strong></td>
					<td width="66%" bgcolor="#FFCCCC">
						<input name="password2" type="password" class="forntsarabun" id="password2" size="25" value="">
					</td>
				</tr>
				<tr>
					<td width="34%" align="right" bgcolor="#FF9999"></td>
					<td bgcolor="#FFCCCC">
						<strong>คำแนะนำในการตั้งรหัสผ่าน</strong>
						<ol>
							<li>ควรมีจำนวนตั้งแต่ 8 ตัวอักษรขึ้นไป</li>
							<li>รหัสผ่านควรมีตัวพิมพ์เล็ก(a-z) พิมพ์ใหญ่(A-Z) ตัวเลข(1-9) และ อักขระพิเศษ(!@#$%^&*[]_+)ผสมกัน</li>
						</ol>
					</td>
				</tr>
				<tr>
					<td bgcolor="#FF9999">&nbsp;</td>
					<td bgcolor="#FF9999"><label>
							<input type="submit" name="button" id="button" class="forntsarabun" value="บันทึก">
						</label>
						<input name="act" type="hidden" value="updatePass">
						<input name="row_id" type="hidden" value="<?= $id; ?>">
						<input name="menucode" type="hidden" value="<?= $menucode; ?>">
					</td>
				</tr>
			</table>
		</form>
		<script>
			function checkPassword() {
				let res = true;
				let p1 = document.getElementById('password').value;
				let p2 = document.getElementById('password2').value;
				if (p1 != p2) {

					alert('รหัสผ่านไม่ตรงกัน');
					res = false;
				} else if (p1 == '' || p2 == '') {
					alert('รหัสผ่านไม่ควรเป็นค่าว่าง');
					res = false;
				}
				return res;
			}
		</script>
	</div>
	<div>
		<form action="edituser.php?act=updateLevel" method="post" name="form1">
			<table width="50%" border="0" cellspacing="0" cellpadding="5">
				<tr valign="top">
					<td width="34%" align="right" bgcolor="#FF9999"><strong>ระดับผู้ใช้งาน : </strong></td>
					<td width="66%" bgcolor="#FFCCCC">
						<?php 
						$levelList = array('admin','user');
						?>
						<select name="userlevel" id="userlevel" class="forntsarabun">
							<?php 
							foreach ($levelList as $ll) {
								$selected = ($ll == $rows['level']) ? 'selected="selected"' : '' ;
								?>
								<option value="<?=$ll;?>" class="forntsarabun" <?=$selected;?> ><?=$ll;?></option>
								<?php
							}
							?>
						</select>
						<div>
							กรณีที่ต้องการ<strong>ปิดการใช้งาน</strong>ผู้ใช้ระดับ admin ต้องทำการปรับให้เป็นระดับ user ก่อน
						</div>
					</td>
				</tr>
				<tr>
					<td bgcolor="#FF9999">&nbsp;</td>
					<td bgcolor="#FF9999">
						<button type="submit" class="forntsarabun">บันทึก</button>
						<input name="menucode" type="hidden" value="<?= $menucode; ?>">
						<input name="row_id" type="hidden" value="<?= $id; ?>">
					</td>
				</tr>
			</table>
		</form>
	</div>
	<div>
		<form action="edituser.php?act=updateDepartment" method="post" name="form1">
			<table width="50%" border="0" cellspacing="0" cellpadding="5">
				<tr valign="top">
					<td width="34%" align="right" bgcolor="#FF9999"><strong>แผนกที่ปฏิบัตติงาน : </strong></td>
					<td width="66%" bgcolor="#FFCCCC">
						<?php 
						$sql = "SELECT `name`,`menucode` FROM `departments` WHERE `menucode` <> '' ";
						$q = $dbi->query($sql);
						?>
						<select name="department" id="department" class="forntsarabun">
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
						<div>แผนกที่ตกหล่นไม่มีข้อมูล สามารถแจ้งมาที่ศูนย์คอมฯ เพื่อทำการอัพเดท</div>
					</td>
				</tr>
				<tr>
					<td bgcolor="#FF9999">&nbsp;</td>
					<td bgcolor="#FF9999">
						<button type="submit" class="forntsarabun">บันทึก</button>
						<input name="menucode" type="hidden" value="<?= $menucode; ?>">
						<input name="row_id" type="hidden" value="<?= $id; ?>">
					</td>
				</tr>
			</table>
		</form>
	</div>
</div>