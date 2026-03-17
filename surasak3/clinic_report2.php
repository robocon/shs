<?php
require_once dirname(__FILE__).'/bootstrap.php';
$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>รายงานสมุดทะเบียนใบรับรองแพทย์</title>
	<script src="js/sweetalert2.all.min.js"></script>
	<style type="text/css">
		body, input, select, button{
			font-family: "TH SarabunPSK";
			font-size: 20px;
		}
		h1,h2{
			margin:0;
			padding:0;
		}
		.shs-table {
			width: 100%;
			border-left: 1px solid #000000;
			border-top: 1px solid #000000;
		}
		.shs-table td,
		.shs-table th {
			border-right: 1px solid #000000;
			border-bottom: 1px solid #000000;
			column-span: none;
			/* padding: 0.3em; */
			padding: 3px;
			vertical-align: bottom;
		}
		.shs-table th {
			background-color: #EDEDED;
			font-weight: bold;
			vertical-align: middle;
		}
		.shs-header {
			font-size: 1.4em;
			/* padding: 0.2em; */
			padding: 4xp;
		}
		.footer-sign td {
			/* padding: 0.2em; */
			padding: 4xp;
		}
		@media print {
			.new-page {
				page-break-before: always;
				page-break-inside: avoid;
			}
			body {
				padding-left: 10px;
				font-size: 18px;
			}
			body,td,th,h1,h2,h3,
			legend {
				padding-left: 10px;
			}
			.shs-header {
				font-size: 1.2em;
				/* padding: 0.2em; */
				padding: 4xp;
			}
			#no_print {
				display: none;
			}
		}
		.theBlocktoPrint {
			background-color: #000;
			color: #FFF;
		}

		/* Model */
	.modal {
		position: fixed; /* Stay in place */
		z-index: 1; /* Sit on top */
		padding-top: 100px; /* Location of the box */
		left: 0;
		top: 0;
		width: 100%; /* Full width */
		height: 100%; /* Full height */
		overflow: auto; /* Enable scroll if needed */
		background-color: rgb(0,0,0); /* Fallback color */
		background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
	}
	.close {
		color: #aaaaaa;
		float: right;
		font-size: 28px;
		font-weight: bold;
	}

	.close:hover,
	.close:focus {
		color: #000;
		text-decoration: none;
		cursor: pointer;
	}
	#myModalContainer{
		width: 90%;
		background: #fff;
		padding: 1em;
		margin:0 auto;
	}
	/* Model */
	</style>
</head>
<script language="javascript">
	function fncSubmit() {
		if (document.form1.cHn.value == "") {
			alert("กรุณาระบุ HN ด้วยครับ");
			document.form1.cHn.focus();
			return false;
		}
		document.form1.submit();
	}

	function fncSubmit2() {
		if (document.form2.doctor.value == "") {
			alert("กรุณาเลือกชื่อ doctor");
			document.form2.doctor.focus();
			return false;
		}
		document.form2.submit();
	}

	function chkvalue() {
		var name = document.getElementById('doctor').value;
		document.getElementById('name').value = name;
	}

	function showHide1(obj) {
		var txt = obj.options[obj.selectedIndex].value;
		var objseach = document.form1.seach;

		var div1 = document.getElementById('text1').style;

		var div3 = document.getElementById('text3').style;
		if (txt == 'thidate') {
			div1.visibility = 'visible';
			div1.display = 'inline';

			div3.visibility = 'visible';
			div3.display = 'none';

			//objseach.options[objseach.length].selected = true;

		} else if (txt == 'hn' || txt == 'ptname') {
			div3.visibility = 'visible';
			div3.display = 'inline';

			div1.visibility = 'visible';
			div1.display = 'none';
			//objseach.options[objseach.length].selected = true;
		} else {

			div1.visibility = 'visible';
			div1.display = 'none';

			div3.visibility = 'visible';
			div3.display = 'none';

		}
	}
</script>
<body>
	<div id="no_print">
		<h1 class="font1">คลินิกพิเศษนอกเวลาราชการ</h1>

		<fieldset class="font1" style="width: 80%">
			<legend>ค้นหา </legend>
			<form id="form1" name="form1" method="post" style="text-align: center;">
				<table border="0" align="center" style="margin-left: auto; margin-right: auto;">
					<tr>
						<td>ค้นหาจาก วันที่</td>
						<td>ระบุ</td>
						<td>
							<?php 
							$basic_d = date("d");
							$d_start = !empty($_POST['d_start']) ? $_POST['d_start'] : $basic_d ;
							?>
							<!-- วัน -->
							<select name='d_start' class="font1">
								<?php
								for ($d = 1; $d <= 31; $d++) {
									$newD = sprintf("%02d", $d);
									$selected = ($newD===$d_start) ? 'selected' : '';
									?><option value="<?=$newD;?>" <?=$selected;?> ><?=$newD;?></option><?php
								}
								?>
							</select>
							<!-- เดือน -->
							<select class="font1" name="m_start" id="m_start">
							<?php 
							$m = date('m');
							foreach ($def_fullm_th as $mNum => $mTxt) {
								$selected = ($mNum===$m) ? 'selected' : '';
								?><option value="<?=$mNum;?>" <?=$selected;?> ><?=$mTxt;?></option><?php
							}
							?>
							</select>
							<!-- ปี -->
							<?php
							$Y = date("Y") + 543;
							$yearRange = range(2565, $Y);
							?>
							<select name="y_start" id="y_start">
								<?php
								foreach ($yearRange as $year) {
									$selected = ($year==$_POST['y_start']) ? 'selected' : '';
									?><option value="<?=$year;?>" <?=$selected;?> ><?=$year;?></option><?php
								}
								?>
							</select>
							<?php
							$timeRange = Array('08.00-12.00','08.00-16.00','09.00-15.00','10.30-14.00','16.00-20.00','17.00-20.00');
							?>
							ช่วงเวลา
							<select name='time' class="font1">
								<?php
								foreach ($timeRange as $time) {
									$selected = ($time==$_POST['time']) ? 'selected' : '';
									?><option value="<?=$time;?>" <?=$selected;?> ><?=$time;?></option><?php
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">แพทย์ตรวจ: </td>
						<td style="text-align: left;">
							<select name="doctor" id="doctor">
								<option value="">-- กรุณาเลือกแพทย์ --</option>
								<option value="ห้องตรวจโรคทั่วไป">ห้องตรวจโรคทั่วไป</option>
								<?php
								$sql = "Select name From doctor where status = 'y' ";
								$result = mysql_query($sql);
								while (list($name) = mysql_fetch_row($result)) {
									$selected = ($name==$_POST['doctor']) ? 'selected' : '';
									echo "<option value='" . $name . "' $selected>" . $name . "</option>";
								}
								?>
							</select>
						</td>
					</tr>
					<tr>
						<td colspan="2" align="right">แพทย์ที่ใช้แสดงผล: </td>
						<td style="text-align: left;">
							<select name="doctor2" id="doctor2">
								<option value="">-- กรุณาเลือกแพทย์ --</option>
								<option value="ห้องตรวจโรคทั่วไป">ห้องตรวจโรคทั่วไป</option>
								<?php
								$sql = "SELECT `name` FROM `doctor` WHERE `status` = 'y' ";
								$result = mysql_query($sql);
								while (list($name) = mysql_fetch_row($result)) {
									echo "<option value=\"$name\">$name</option>";
								}
								?>
							</select>
							* ใช้ในกรณีทำโอที
						</td>
					</tr>
					<tr>
						<td colspan="3" align="center"><input name="button" type="submit" class="font1" id="button" value="ตกลง" />
							<a target=_self href='../nindex.htm'> ไปเมนู </a> &nbsp;&nbsp; <a href="clinic_vip.php">เพิ่มข้อมูล</a>
						</td>
					</tr>
				</table>
			</form>
		</fieldset>
		<br />
	</div>
	<?
	if ($_POST['button']) {

		switch ($_POST['m_start']) {
			case "01":
				$printmonth = "มกราคม";
				break;
			case "02":
				$printmonth = "กุมภาพันธ์";
				break;
			case "03":
				$printmonth = "มีนาคม";
				break;
			case "04":
				$printmonth = "เมษายน";
				break;
			case "05":
				$printmonth = "พฤษภาคม";
				break;
			case "06":
				$printmonth = "มิถุนายน";
				break;
			case "07":
				$printmonth = "กรกฏาคม";
				break;
			case "08":
				$printmonth = "สิงหาคม";
				break;
			case "09":
				$printmonth = "กันยายน";
				break;
			case "10":
				$printmonth = "ตุลาคม";
				break;
			case "11":
				$printmonth = "พฤศจิกายน";
				break;
			case "12":
				$printmonth = "ธันวาคม";
				break;
		}

		$dateshow = $_POST['d_start'] . ' ' . $printmonth . " " . $_POST['y_start'];

		$fil = $_POST['seach'];
		$key = $_POST['key'];

		$thidate = $_POST['y_start'] . '-' . $_POST['m_start'] . '-' . $_POST['d_start'];

		$sql = "SELECT a.*,b.`ptright`,SUBSTRING(b.`ptright`,1,3) AS `ptcode`,c.`name` AS `ptrightName` FROM `clinic_vip` AS a
		LEFT JOIN `opcard` AS b ON b.`hn`=a.`hn`
		LEFT JOIN `ptright` AS c ON c.`code` = SUBSTRING(b.`ptright`,1,3)
		WHERE a.`thidate` = '" . $thidate . "' 
		AND a.`time` = '" . $_POST['time'] . "' 
		AND a.`doctor` = '" . $_POST['doctor'] . "' 
		AND a.`status` = 'Y' ORDER BY a.`row_id` ASC";

		$query = mysql_query($sql) or die(mysql_error());
		$numrow = mysql_num_rows($query);
	?>

		<h1 class="font1 shs-header" align="center">คลินิกพิเศษนอกเวลาราชการ</h1>
		<h2 class="font3 shs-header" align="center">วันที่ <?= $dateshow; ?> เวลา <?= $_POST['time']; ?> ห้องตรวจโรคเวชศาสตร์ฟื้นฟู</h2>

		<table class="shs-table" border="1" style="border-collapse:collapse; border-color:#000;" cellpadding="0" cellspacing="0" class="font2" width="100%" align="center">
			<tr bgcolor="#999999">
				<td align="center" width="7%">ลำดับ</td>
				<td colspan="2" align="center" width="47%">ชื่อ - สกุล</td>
				<td align="center" width="13%">HN</td>
				<td align="center" width="20%">สิทธิ์</td>
				<td align="center" width="13%">AN</td>
				<td colspan="2" align="center" id="no_print">จัดการ</td>
			</tr>
			<?php
			$doctor_replace = false;
			$yot_replace = false;
			$doctor2 = (isset($_POST['doctor2']) && $_POST['doctor2'] != '') ? trim($_POST['doctor2']) : false;
			if ($doctor2 !== false) {

				$where = " `name` = '$doctor2'";
				if (preg_match('/ว\.\d+/', $doctor2, $matchs) > 0) {
					$dr_code = substr($matchs['0'], 2);
					$where = " `doctorcode` = '$dr_code'";
				}

				$sql = "SELECT `yot`,`yot2`,`name` FROM `doctor` WHERE $where";
				$q = mysql_query($sql) or die(mysql_error());
				$item = mysql_fetch_assoc($q);
				$doctor2 = $item['name'];

				$doctor_replace = substr($doctor2, 5);
				$yot_replace = $item['yot'];
				if (empty($item['yot'])) {
					$yot_replace = $item['yot2'];
				}
			}

			$run = 1;
			$r = 0;

			while ($arr = @mysql_fetch_array($query)) {

				if ($yot_replace !== false) {
					$yot = $yot_replace;
				} else {
					$yot = $arr['yot'];
				}

				if ($doctor_replace !== false) {
					$doctor = $doctor_replace;
				} else {
					$doctor = substr($arr['doctor'], 5);
				}

				global  $yot, $doctor;

				$r++;
				if ($r == '31') {
					$r = 1;

					echo "<table width='100%' border='0' align='center' class='font2 footer-sign'>
			<tr>
				<td align='center' width='40%'><br>ผู้บันทึก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td align='center' width='40%' >&nbsp;</td>
			</tr>
			<tr>
				<td align='center'>ส.อ. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td align='center'>$yot&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td align='center'>( มงคล  กันธิยะ )</td>
				<td align='center'>($doctor)</td>
			</tr>
			<tr>
				<td align='center'>นายสิบประจำงานแพทย์ทางเลือก</td>
				<td align='center'>แพทย์ผู้รักษา</td>
			</tr>
			<tr>
				<td align='center'>........./............/.........</td>
				<td align='center'>........./............/.........</td>
			</tr>
		</table>";

					echo "</table>";
					
					echo "<div class=\"new-page\"></div>";
					echo "<h1 class='font1 shs-header' align='center'>คลินิกพิเศษนอกเวลาราชการ</h1>";
					echo "<h2 class='font3 shs-header' align='center'>วันที่  $dateshow เวลา $_POST[time]  ห้องตรวจโรคเวชศาสตร์ฟื้นฟู</h2>";

					echo "<table class=\"font2 shs-table\" width=\"100%\" border=\"1\" style=\"border-collapse:collapse; border-color:#000;\" cellpadding=\"0\" cellspacing=\"0\" align='center'>
			<tr bgcolor=\"#999999\">
				<td align=\"center\" width=\"7%\">ลำดับ</td>
				<td colspan='2' align='center' width=\"47%\">ชื่อ - สกุล</td>
				<td align=\"center\" width=\"13%\">HN</td>
				<td align=\"center\" width=\"20%\">สิทธิ์</td>
				<td align=\"center\" width=\"13%\">AN</td>
				<td align=\"center\" id='no_print' colspan='2'>จัดการ</td>
			</tr>";
				} // End if
				$name = explode(" ", $arr['ptname']);
				$fname = $name[0];
				$lname = substr($arr['ptname'], strlen($fname) + 1);
				?>
				<tr id="itemId<?=$arr['row_id'];?>">
					<td align="center"><?= $run; ?></td>
					<td style='border-right-style:none'>&nbsp;<?= $fname ?></td>
					<td style="border-left-style:none"><?= $lname ?></td>
					<td><?= $arr['hn'] ?></td>
					<td>
						<?=str_replace('โครงการ','', $arr['ptrightName']);?>
					</td>
					<td><?= $arr['an'] ?></td>
					<td align="center" id="no_print"><a id="edit" class="various iframe" href="javascript:void(0);" onclick="editItem('<?=$arr['row_id'] ?>')" >แก้ไข</a></td>
					<td align="center" id="no_print"><a id="delete" class="various iframe" href="javascript:void(0);" onclick="delItem('<?=$arr['row_id'] ?>')" >ลบ</a></td>
				</tr>
				<?php
				$run++;
			} // End while
			?>
		</table>
		<BR />
		<table width="100%" border="0" align="center" class="font2 footer-sign">
			<tr>
				<td align="center" width="40%">ผู้บันทึก&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td align="center" width="40%">&nbsp;</td>
			</tr>
			<tr>
				<td align="center">จ.ส.ต. &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
				<td align="center"><?= $yot; ?>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
			</tr>
			<tr>
				<td align="center">( ไตรรัตน์  แม่นรัตน์ )</td>
				<td align="center">(<?= $doctor; ?>)</td>
			</tr>
			<tr>
				<td align="center">นายสิบประจำงานกายภาพบำบัด</td>
				<td align="center">แพทย์ผู้รักษา</td>
			</tr>
			<tr>
				<td align="center">........./............/.........</td>
				<td align="center">........./............/.........</td>
			</tr>
		</table>
		<div id="myModal" class="modal" style="display:none;">
			<div id="myModalContainer">
				<div class="clearfix">
					<div id="myModalHeader"><a href="javascript:void(0);" onclick="closeForm()"><span class="close">&times; ปิด</span></a></div>
				</div>
				<div id="resFormAddCompany"></div>
			</div>
		</div>
		<script>
			function editItem(id){
				document.getElementById('myModal').style.display = '';
				doLoadEditForm(id).then((res)=>{
					document.getElementById('resFormAddCompany').innerHTML = res;
				});
			}

			async function doLoadEditForm(id){
				const response = await fetch('clinic_editform.php?row_id='+id);
				const body = await response.text();
				return body;
			}

			function delItem(id){
				Swal.fire({
					title: "คุณมั่นใจที่จะลบข้อมูล?",
					icon: "warning",
					showCancelButton: true,
					confirmButtonColor: "#3085d6",
					cancelButtonColor: "#d33",
					confirmButtonText: "ยืนยันการลบ",
					cancelButtonText: "ยกเลิก"
				}).then((result) => {
					if (result.isConfirmed) {
						doDelItem(id).then((res)=>{
							if(res.status == 200){
								// document.getElementById('itemId'+id).style.display = 'none';
								Swal.fire({
									icon: 'success',
									title: 'บันทึกข้อมูลเรียบร้อย'
								}).then((res)=>{
									location.reload();
								});
							}
						});
					}
				});
			}
			async function doDelItem(id){
				const response = await fetch('clinic_delete.php?row_id='+id);
				const body = await response.json();
				return body;
			}

			function closeForm(){
				document.getElementById('myModal').style.display = 'none';
				document.getElementById('resFormAddCompany').innerHTML = '';
			}

			function checkPtright(){
				let hn = document.getElementById('hn').value;
				doCheckPtright(hn).then((res)=>{
					
					let data = res.split('|');
					let ptname = data[0].replace(/(\r\n|\n|\r)/gm,'');

					document.getElementById('ptname').value = ptname;
					document.getElementById('resPtright').innerHTML = data[1];

				});
			}

			async function doCheckPtright(hn){
				let data = "strHn="+encodeURIComponent(hn);
				const res = await fetch('clinic_vipgetfill.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					},
					body: data
				});

				const response = await res.text();
				return response;
			}

			function saveFormEdit(){
				event.preventDefault();
				
				doSaveFormEdit().then((res)=>{
					if(res.status==200){
						Swal.fire({
							icon: 'success',
							title: 'บันทึกข้อมูลเรียบร้อย'
						}).then((res)=>{
							location.reload();
						});
					}else{
						Swal.fire({
							icon: 'error',
							title: res.message
						});
					}
				});
			}

			async function doSaveFormEdit(){
				let data = "hn="+encodeURIComponent(document.getElementById('hn').value);
				data += "&ptname="+encodeURIComponent(document.getElementById('ptname').value);
				data += "&ptnaname="+encodeURIComponent(document.getElementById('an').value);
				data += "&row_id="+encodeURIComponent(document.getElementById('row_id').value);
				const res = await fetch('clinic_saveedit.php', {
					method: 'POST',
					headers: {
						'Content-Type': 'application/x-www-form-urlencoded'
					},
					body: data
				});
				const response = await res.json();
				return response;
			}
		</script>

	<? } ?>
</body>
</html>