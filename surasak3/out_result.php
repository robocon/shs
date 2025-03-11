<?php
session_start();
include("connect.inc");

if (isset($_POST['okhn2']) && isset($_POST['form_status'])) {


	$data1 = $_POST['form_status'];

	$hpv = (trim($_POST['hpv']) != '') ? trim($_POST['hpv']) : NULL;
	$bone = (trim($_POST['42702']) != '') ? trim($_POST['42702']) : NULL;
	$bone_density = htmlspecialchars($_POST['bone_density'], ENT_QUOTES);

	$occupa_health = htmlspecialchars($_POST['occupa_health'], ENT_QUOTES);

	$outAfp = (!empty($_POST['outAfp'])) ? trim($_POST['outAfp']) : '';
	$outAfpResult = (!empty($_POST['outAfpResult'])) ? trim($_POST['outAfpResult']) : '';
	$outPsa = (!empty($_POST['outPsa'])) ? trim($_POST['outPsa']) : '';
	$outPsaResult = (!empty($_POST['outPsaResult'])) ? trim($_POST['outPsaResult']) : '';

	$nPrefix = $_POST['nPrefix'];

	$part = $_POST['part'];
	$seq = (int) $_POST['seq'];

	$cimt = sprintf("%s", $_POST['cimt']);
	$echo = sprintf("%s", $_POST['echo']);
	$abi = sprintf("%s", $_POST['abi']);

	$eye_pressure = sprintf("%s", $_POST['eye_pressure']);
	$eye_pressure_detail = sprintf("%s", $_POST['eye_pressure_detail']);

	$eye_vision = sprintf("%s", $_POST['eye_vision']);
	$eye_vision_detail = sprintf("%s", $_POST['eye_vision_detail']);

	$waist = sprintf("%s", $_POST['waist']);

	if ($data1 == "update") {

		if ($_POST['eye'] == "ปกติ") {
			$_POST['eye_detail'] = "";
		}
		if ($_POST['pt'] == "ปกติ") {
			$_POST['pt_detail'] = "";
		}

		$ptname = $_POST['ptname'];
		$update = "UPDATE `out_result_chkup` SET 
		`ptname` = '" . $_POST['newname'] . "',
		`age` = '" . $_POST['age'] . "',
		`weight` = '" . $_POST['weight'] . "',
		`height` = '" . $_POST['height'] . "',
		`bp1` = '" . $_POST['bp1'] . "',
		`bp2` ='" . $_POST['bp2'] . "',
		`waist` = '$waist', 
		`p` = '" . $_POST['p'] . "' ,
		`ekg` = '" . $_POST['ekg'] . "',
		`va` = '" . $_POST['va'] . "',
		`stool` = '" . $_POST['stool'] . "',
		`cxr` = '" . $_POST['cxr'] . "',
		`doctor_result` = '" . $_POST['doctor_result'] . "',
		`year_chk` = '$nPrefix',
		`part` = '$part',
		`42702` = '$bone',
		`hpv` = '$hpv',
		`altra` = '" . $_POST['altra'] . "',
		`psa` = '" . $_POST['psa'] . "',
		`mammogram` = '" . $_POST['mammogram'] . "',
		`temp` = '" . $_POST['temp'] . "',
		`rate` ='" . $_POST['rate'] . "',
		`prawat` = '" . $_POST['prawat'] . "' ,
		`cigga` = '" . $_POST['cigga'] . "',
		`alcohol` = '" . $_POST['alcohol'] . "',
		`exercise` = '" . $_POST['exercise'] . "',
		`allergic` = '" . $_POST['allergic'] . "',
		`comment` = '" . $_POST['comment'] . "'	,
		`bp3` = '" . $_POST['bp3'] . "',
		`bp4` ='" . $_POST['bp4'] . "',
		`eye` ='" . $_POST['eye'] . "',
		`eye_detail` ='" . $_POST['eye_detail'] . "',
		`pt` ='" . $_POST['pt'] . "',
		`pt_detail` ='" . $_POST['pt_detail'] . "',
		`last_officer` = '$sOfficer',
		`last_update` = '" . date("Y-m-d H:i:s") . "', 
		`seq` = '$seq', 
		`cs` = '" . $_POST['cs'] . "',
		`result_cs` = '" . $_POST['result_cs'] . "',
		`blindness` = '" . $_POST['blindness'] . "', 
		`hearing` = '" . $_POST['hearing'] . "', 
		`metal` = '" . $_POST['metal'] . "', 
		`metal_result` = '" . $_POST['metal_result'] . "',
		`benzene` = '" . $_POST['benzene'] . "',
		`benzene_result` = '" . $_POST['benzene_result'] . "',
		`bone_density` = '$bone_density',
		`occupa_health` = '$occupa_health',
		`outAfp` = '$outAfp',
		`outAfpResult` = '$outAfpResult',
		`outPsa` = '$outPsa',
		`outPsaResult` = '$outPsaResult',
		`cimt` = '$cimt', 
		`echo` = '$echo', 
		`abi` = '$abi',
		`eye_pressure` = '$eye_pressure',
		`eye_pressure_detail` = '$eye_pressure_detail',
		`eye_vision` = '$eye_vision',
		`eye_vision_detail` = '$eye_vision_detail'

		WHERE `row_id` ='" . $_POST['row_id'] . "';";
	} else if ($data1 == "insert") {
		$active = "y";
		if ($_POST['eye'] == "ปกติ") {
			$_POST['eye_detail'] = "";
		}
		if ($_POST['pt'] == "ปกติ") {
			$_POST['pt_detail'] = "";
		}
		$update = "INSERT INTO `out_result_chkup` SET 
		`hn` = '" . $_POST['hn'] . "',
		`ptname` = '" . $_POST['ptname'] . "',
		`age` = '" . $_POST['age'] . "',
		`weight` = '" . $_POST['weight'] . "',
		`height` = '" . $_POST['height'] . "',
		`bp1` =  '" . $_POST['bp1'] . "',
		`bp2` = '" . $_POST['bp2'] . "', 
		`waist` = '$waist', 
		`p` = '" . $_POST['p'] . "',
		`ekg` = '" . $_POST['ekg'] . "',
		`va` = '" . $_POST['va'] . "',
		`cxr` = '" . $_POST['cxr'] . "',
		`year_chk` =  '$nPrefix',
		`part` = '$part',
		`officer` = '$sOfficer',
		`register` = '" . date("Y-m-d H:i:s") . "',
		`42702` = '$bone',
		`hpv` = '$hpv',
		`altra` = '" . $_POST['altra'] . "',
		`psa` = '" . $_POST['psa'] . "',
		`mammogram` = '" . $_POST['mammogram'] . "',			
		`temp` = '" . $_POST['temp'] . "',
		`rate` = '" . $_POST['rate'] . "',
		`prawat` =  '" . $_POST['prawat'] . "',
		`cigga` = '" . $_POST['cigga'] . "',
		`alcohol` = '" . $_POST['alcohol'] . "',
		`exercise` = '" . $_POST['exercise'] . "',
		`allergic` = '" . $_POST['allergic'] . "',
		`comment` = '" . $_POST['comment'] . "',
		`bp3` = '" . $_POST['bp3'] . "',
		`bp4` = '" . $_POST['bp4'] . "',
		`eye` = '" . $_POST['eye'] . "',
		`eye_detail` =  '" . $_POST['eye_detail'] . "',
		`pt` = '" . $_POST['pt'] . "',
		`pt_detail` = '" . $_POST['pt_detail'] . "', 
		`seq` = '$seq', 
		`cs` = '" . $_POST['cs'] . "', 
		`result_cs` = '" . $_POST['result_cs'] . "', 
		`blindness` = '" . $_POST['blindness'] . "', 
		`hearing` = '" . $_POST['hearing'] . "', 
		`metal` = '" . $_POST['metal'] . "', 
		`metal_result` = '" . $_POST['metal_result'] . "',
		`benzene` = '" . $_POST['benzene'] . "',
		`benzene_result` = '" . $_POST['benzene_result'] . "',
		`bone_density` = '$bone_density', 
		`occupa_health` = '$occupa_health',
		`outAfp` = '$outAfp',
		`outAfpResult` = '$outAfpResult',
		`outPsa` = '$outPsa',
		`outPsaResult` = '$outPsaResult',
		`cimt` = '$cimt',
		`echo` = '$echo',
		`abi` = '$abi',
		`eye_pressure` = '$eye_pressure',
		`eye_pressure_detail` = '$eye_pressure_detail',
		`eye_vision` = '$eye_vision',
		`eye_vision_detail` = '$eye_vision_detail' ";

	}

	$upquery = mysql_query($update) or die(mysql_error());
	if ($upquery == true) { //บันทึกสำเร็จ
		if ($_POST["form_status"] == "insert") {
			$save = "บันทึกข้อมูลเรียบร้อยแล้ว";
		} else {
			$edit = "update opcardchk set `agey` = '" . $_POST['age'] . "' where HN='" . $_POST['hn'] . "' and part='" . $_POST['part'] . "';";
			$querey = mysql_query($edit);
			$save = "แก้ไขข้อมูลเรียบร้อยแล้ว";
		}
		$hn = $_POST['hn'];
		?>
		<script type="text/javascript">
			alert('<?= $save; ?>');
			setTimeout(function () {
				window.location = 'out_result.php?hn=<?= $hn; ?>&part=<?= $part; ?>&act=print';
			}, 1000);
		</script>
		<?php
	}
	exit;
}

if ($_GET["act"] == "print") {

	$showpart = $_GET["part"];
	$hn = $_GET['hn'];
	$sql1 = "SELECT * FROM  out_result_chkup where hn='$hn' and part='$showpart'";
	$query1 = mysql_query($sql1) or die(mysql_error());
	$arr1 = mysql_fetch_array($query1);
	$d = date("d");
	$m = date("m");
	$y = date("Y") + 543;
	$time = date("H:i:s");

	$thidate = "$d/$m/$y $time";
	?>
	<script type="text/javascript">
		window.onload = function () {
			window.print();
			setTimeout(function () {
				window.location = 'out_result.php?part=<?= $showpart; ?>';
			}, 1000);
		}
	</script>
	<table cellpadding="0" cellspacing="0" border="0" style="font-family:'TH SarabunPSK'; font-size:16px">
		<tr>
			<td>HN :
				<?= $arr1['hn']; ?>&nbsp;&nbsp;(
				<?php echo $thidate; ?>)
			</td>
		</tr>
		<tr>
			<td>ชื่อ-นามสกุล :
				<?= $arr1['ptname']; ?>
			</td>
		</tr>
		<tr>
			<td>ตรวจสุขภาพประจำปี (
				<?= $arr1['part']; ?>)
			</td>
		</tr>
		<tr>
			<td>โรคประจำตัว : <?=$arr1["prawat"]; ?>, แพ้ยา : <?=$arr1["allergic"]; ?>, นน : <?=$arr1["weight"]; ?> กก., สส : <?=$arr1["height"]; ?> ซม.</td>
		</tr>
		<tr>
			<td>BP :
				<? echo $arr1["bp1"] . "/" . $arr1["bp2"]; ?> mmHg,
				<? if (!empty($arr1["bp3"]) || !empty($arr1["bp4"])) { ?>RE-BP :
					<? echo $arr1["bp3"] . "/" . $arr1["bp4"]; ?> mmHg,
				<? } ?> T :
				<?php echo $arr1["temp"]; ?> C, P :
				<?php echo $arr1["p"]; ?> ครั้ง/นาที
			</td>
		</tr>
		<tr>
			<td>R :
				<?php echo $arr1["rate"]; ?> ครั้ง/นาที, บุหรี่ :
				<?php echo $arr1["cigga"]; ?>, สุรา :
				<?php echo $arr1["alcohol"]; ?>, ออกกำลังกาย :
				<?php echo $arr1["exercise"]; ?>
			</td>
		</tr>
		<? if (!empty($arr1["comment"])) { ?>
			<tr>
				<td>หมายเหตุ :
					<?php echo $arr1["comment"]; ?>
				</td>
			</tr>
		<? } ?>
	</table>
	<?php
	exit;
}

?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>บันทึกข้อมูลซักประวัตินอกหน่วย</title>
	<style type="text/css">
		*{
			font-family: "TH SarabunPSK";
		}
		body,td,th {font-size: 16px;}
		.pdxhead {font-size: 24px;}
		.pdxpro {font-size: 22px;}
		.pdx {font-size: 20px;}
		.stricker {font-size: 16px;}
		.stricker1 {font-size: 14px;}

		@media print {
			#no_print {
				display: none;
			}
		}

		.theBlocktoPrint {
			background-color: #000;
			color: #FFF;
		}

		.style1 {
			color: #FF0000
		}

		.help {
			cursor: pointer;
		}

		#chk_details tr:nth-child(even) {
			background-color: #f2f2f2;
		}
		#chk_details td:first-child {
			text-align: right;
			font-weight: bold;
		}
		#chk_details td:first-child:after{
			content:' : ';
		}
		#chk_details td{
			padding-bottom: 8px;
		}
	</style>
	<script type="text/javascript">
		function showDiv() {
			if (document.getElementById('pt').value == "ปอดจำกัดการขยายตัว") {
				document.getElementById('hidden_div').style.display = "";
			} else if (document.getElementById('pt').value == "ปอดอุดกั้น") {
				document.getElementById('hidden_div').style.display = "";
			} else {
				document.getElementById('hidden_div').style.display = "none";
			}
		}


		function showDiveye() {
			if (document.getElementById('eye2').value == "ผิดปกติ") {
				document.getElementById('hidden_div1').style.display = "";
			} else {
				document.getElementById('hidden_div1').style.display = "none";
			}
		}

		function showDiveye1() {
			if (document.getElementById('eye1').value == "ปกติ") {
				document.getElementById('hidden_div1').style.display = "none";
			} else {
				document.getElementById('hidden_div1').style.display = "none";
			}
		}
	</script>
</head>

<body>
	<div id="no_print">
		<?php
		$part = $_REQUEST['part'];
		?>
		<form action="out_result.php?part=<?= $part; ?>" method="post" name="f1">
			<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#339933" class="pdxhead">
				<tr>
					<td height="40" align="center" bgcolor="#66CC99">
						<strong>กรอกข้อมูล HN </strong>
					</td>
				</tr>
				<tr>
					<td align="left">
						HN: <input name="hn" type="text" size="20" class="pdxhead" />
						<input type="submit" value="   ตกลง   " name="okhn" class="pdxhead" />
						<input type="hidden" name="action" value="searchHn">
					</td>
				</tr>
			</table>
		</form>
		<br />
		<?php

		if (isset($_POST['hn']) && $_POST['action'] === "searchHn") {



			////*runno ตรวจสุขภาพ*/////////
			// $query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
			// $result = mysql_query($query) or die("Query failed");
		
			// for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
			// 	if (!mysql_data_seek($result, $i)) {
			// 		echo "Cannot seek to row $i\n";
			// 		continue;
			// 	}
		
			// 	if(!($row = mysql_fetch_object($result)))
			// 		continue;
			// }
		
			// $nPrefix=$row->prefix;
			// $nPrefix2="25".$nPrefix;
			$part = $_REQUEST['part'];

			$sql = "SELECT SUBSTRING(`yearchk`, 3, 2) AS `checkup_year` FROM `chk_company_list` WHERE `code` = '$part' ";
			$q = mysql_query($sql);
			$chk = mysql_fetch_assoc($q);
			$nPrefix = $chk['checkup_year'];

			////*runno ตรวจสุขภาพ*/////////
		

			$sql1 = "SELECT * ,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcardchk` WHERE `HN` = '" . (trim($_POST['hn'])) . "' and part='$part' ";
			$query = mysql_query($sql1) or die(mysql_error());
			$Row = mysql_num_rows($query);

			$arr = mysql_fetch_array($query); // list ข้อมูลจาก opcardchk
			$hn = $arr['HN'];
			$age = $arr['agey'];
			$ptname = $arr['yot'] . $arr['name'] . ' ' . $arr['surname'];

			$sqlchk = "SELECT * FROM `out_result_chkup` WHERE hn='$hn' and `part` = '$part' and year_chk ='$nPrefix' ";
			$querychk = mysql_query($sqlchk) or die(mysql_error());
			$Rowchk = mysql_num_rows($querychk);

			if ($Rowchk > 0) {

				$arrchk = mysql_fetch_array($querychk); // list ข้อมูลจาก out_result_chkup
				if (empty($age)) {
					$age = $arrchk["age"];
				}
				$data1 = "update";
				$button = "<input type='submit'  value='   แก้ไขข้อมูล   ' name='okhn2' class='pdxhead'/>";
				$button .= '<input type="hidden" name="form_status" value="update">';

			} else {
				$data1 = "insert";
				$button = "<input type='submit'  value='   บันทึกข้อมูล   ' name='okhn2' class='pdxhead'/>";
				$button .= '<input type="hidden" name="form_status" value="insert">';
			}

			if (!$Row) {

				$sql2 = "SELECT hn as HN ,concat(yot,name,' ',surname)as ptname FROM `opcard` WHERE hn='" . $_POST['hn'] . "' ";
				echo "<div class='pdx'><strong>แจ้งเตือน...</strong>บุคคลนี้ไม่ได้ลงทะเบียนตรวจสุขภาพแบบกลุ่มของหน่วย : <strong>$part</strong><br><span class='style1'>กรุณาเช็ครายชื่อบุคคลให้ตรงกับหน่วยงานที่มาตรวจสุขภาพ...!!!</span></div>";
				$query = mysql_query($sql2) or die(mysql_error());
				$Row2 = mysql_num_rows($query);
				if (empty($Row2)) {
					echo "<div align='center' class='fontsara'>!!! ไม่พบ HN  $_POST[hn]!! </div>";
				} else {
					$arr = mysql_fetch_array($query);
					$hn = $arr['HN'];
					$ptname = $arr['ptname'];

					$sqlchk = "SELECT * FROM `out_result_chkup` WHERE hn='" . $hn . "' and `part` = '$part' and year_chk ='$nPrefix' ";
					$querychk = mysql_query($sqlchk) or die(mysql_error());
					$Rowchk = mysql_num_rows($querychk);

					if ($Rowchk > 0) {

						$arrchk = mysql_fetch_array($querychk);
						$data1 = "update";
						$button = "<input type='submit'  value='   แก้ไขข้อมูล   ' name='okhn2' class='pdxhead'/>";
						$button .= '<input type="hidden" name="form_status" value="update">';
					} else {
						$data1 = "insert";
						$button = "<input type='submit'  value='   บันทึกข้อมูล   ' name='okhn2' class='pdxhead'/>";
						$button .= '<input type="hidden" name="form_status" value="insert">';
					}
				}
			}
			?>
			<form action="" method="post" name="f2">
				<table width="100%" border="1" cellpadding="0" cellspacing="0" bordercolor="#FF9900">
					<tr>
						<td>
							<table width="100%">
								<tr>
									<td class="pdxpro">HN :
										<b><?= $hn ?></b> ชื่อ-สกุล :
										&nbsp;&nbsp; <b><input name="newname" type="text" class="pdxhead" value="<?= $ptname ?>" /></b> 
										&nbsp;&nbsp; หน่วย: <b><?= $part; ?></b>
										&nbsp;&nbsp; อายุ: <input name="age" type="text" size="5" class="pdxhead" value="<?= $age; ?>" /><span class="cvRisk">*</span>
									</td>
								</tr>
								<tr>
									<td class="pdx">
										<style>
											.subTable td{
												padding-right:12px;
												padding-bottom: 12px;
											}
											.pdxBold{
												font-size: 20px;
												font-weight: bold;
											}
											.cvRisk{
												color:red;
											}
										</style>
										<table class="subTable">
											<tr>
												<td>
													<span class="pdxBold">น้ำหนัก :</span> <input name="weight" type="text" size="5" class="pdx" value="<?= $arrchk['weight'] ?>" /> กก. <span class="cvRisk">*</span>
												</td>
												<td>
													<span class="pdxBold">ส่วนสูง :</span> <input name="height" type="text" size="5" class="pdx" value="<?= $arrchk['height'] ?>" /> ซม.<span class="cvRisk">*</span>
												</td>
												<td>
													<span class="pdxBold">รอบเอว :</span> <input type="text" name="waist" size="5" class="pdx" value="<?=$arrchk['waist'];?>"><span class="cvRisk">*</span>
												</td>
												<td>
													<span class="pdxBold">BP :</span> <input name="bp1" type="text" size="5" class="pdx" value="<?= $arrchk['bp1'] ?>" />
													/
													<input name="bp2" type="text" size="5" class="pdx" value="<?= $arrchk['bp2'] ?>" /><span class="cvRisk">*</span>
												</td>
												<td>
													<span class="pdxBold">Repeat-BP :</span> <input name="bp3" type="text" size="5" class="pdx" value="<?= $arrchk['bp3'] ?>" />
													/
													<input name="bp4" type="text" class="pdx" id="bp4" value="<?= $arrchk['bp4'] ?>" size="5" /><span class="cvRisk">*</span>
												</td>
											</tr>
										</table>
										<table class="subTable">
											<tr>
												<td>
													<div align="left">
														<span class="pdxBold">T :</span> <input name="temp" type="text" size="5" class="pdx" id="temp" value="<?= $arrchk['temp'] ?>" />
													</div>
												</td>
												<td>
													<span class="pdxBold">P :</span> <input name="p" type="text" size="5" class="pdx" value="<?= $arrchk['p'] ?>" /> ครั้ง/นาที
												</td>
												<td>
													<span class="pdxBold">R :</span> <input name="rate" type="text" size="5" class="pdx" value="<?= $arrchk['rate'] ?>" /> ครั้ง/นาที
												</td>
												<td>
													<span class="pdxBold">โรคประจำตัว :</span> <input name="prawat" type="text" size="22" class="pdx" value="<?= $arrchk['prawat'] ?>" />
												</td>
											</tr>
										</table>
										<table class="subTable">
											<tr valign="top">
												<td>
													<span class="pdxBold">สูบบุหรี่ : </span> <input id="cigga" name="cigga" type="text" class="pdx" value="<?= $arrchk['cigga'] ?>" /><span class="cvRisk">*</span>
													<br>
													<a style="padding-right:12px;" href="javascript:void(0);" onclick="document.getElementById('cigga').value='สูบ'">สูบ</a >
													<a style="padding-right:12px;" href="javascript:void(0);" onclick="document.getElementById('cigga').value='ไม่เคยสูบ'">ไม่เคยสูบ</a >
													<a style="padding-right:12px;" href="javascript:void(0);" onclick="document.getElementById('cigga').value='เคยสูบแต่เลิกแล้ว'">เคยสูบแต่เลิกแล้ว</a >
												</td>
												<td>
													<span class="pdxBold">ดื่มสุรา : </span> <input id="alcohol" name="alcohol" type="text" class="pdx" value="<?= $arrchk['alcohol'] ?>" />
													<br>
													<a style="padding-right:12px;" href="javascript:void(0);" onclick="document.getElementById('alcohol').value='ดื่ม'">ดื่ม</a >
													<a style="padding-right:12px;" href="javascript:void(0);" onclick="document.getElementById('alcohol').value='ไม่ดื่ม'">ไม่ดื่ม</a >
													<a style="padding-right:12px;" href="javascript:void(0);" onclick="document.getElementById('alcohol').value='เคยดื่มแต่เลิกแล้ว'">เคยดื่มแต่เลิกแล้ว</a >
												</td>
												<td>
													<span class="pdxBold">ออกกำลังกาย : </span> <input name="exercise" type="text" class="pdx" value="<?= $arrchk['exercise'] ?>" />
												</td>
												<td>
													<span class="pdxBold">แพ้ยา : </span> <input name="allergic" type="text" class="pdx" value="<?= $arrchk['allergic'] ?>" />
												</td>
											</tr>
										</table>
										<div><span class="cvRisk">*</span> ข้อมูลจำเป็นสำหรับการคำนวณ CV Risk Score</div>
									</td>
								</tr>
								<tr>
									<td>
										<table width="100%" id="chk_details">
											<tr>
												<td width="188" class="pdx">หมายเหตุ</td>
												<td width="464"><input name="comment" type="text" class="pdx" size="50"
														id="comment" value="<?= $arrchk['comment'] ?>" /></td>
												<td width="256">&nbsp;</td>
											</tr>
											<tr valign="top">
												<td class="pdx">ผลตรวจ สมรรถภาพปอด</td>
												<td colspan="2">
													<input type="text" name="pt" class="pdx" id="pt" value="<?=$arrchk['pt'];?>">
													<select onchange="document.getElementById('pt').value=this.value;" class="pdx">
														<option value="">---------- เลือก ----------</option>
														<option value="ปกติ">ปกติ</option>
														<option value="ปอดจำกัดการขยายตัว">ปอดจำกัดการขยายตัว</option>
														<option value="ปอดอุดกั้น">ปอดอุดกั้น</option>
														<option value="มีการอุดกั้นของประสิทธิภาพปอด ระดับเล็กน้อย (เกรด B)">มีการอุดกั้นของประสิทธิภาพปอด ระดับเล็กน้อย (เกรด B)</option>
													</select>
													&nbsp;&nbsp;&nbsp;
													<? if ($arrchk['pt'] == "ปอดจำกัดการขยายตัว" || $arrchk['pt'] == "ปอดอุดกั้น") {
														echo "<span class='pdx'>" . $arrchk['pt_detail'] . "</span>";
													} ?>
													<div id="hidden_div" class="pdx">
														ระบุ : <label for="pt_detail1"><input
															type="radio" name="pt_detail" id="pt_detail1" value="ผิดปกติเล็กน้อย"
															class="pdxhead" <? if ($arrchk['pt_detail'] == "ผิดปกติเล็กน้อย") {
																echo "checked='checked'";
															} ?> />
														ผิดปกติเล็กน้อย</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<label for="pt_detail2"><input type="radio" name="pt_detail" id="pt_detail2" value="ผิดปกติปานกลาง"
															class="pdxhead" <? if ($arrchk['pt_detail'] == "ผิดปกติปานกลาง") {
																echo "checked='checked'";
															} ?> />
														ผิดปกติปานกลาง</label>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
														<label for="pt_detail3"><input type="radio" name="pt_detail" id="pt_detail3" value="ผิดปกติมาก"
															class="pdxhead" <? if ($arrchk['pt_detail'] == "ผิดปกติมาก") {
																echo "checked='checked'";
															} ?> /> ผิดปกติมาก</label>

														<a href="javascript:void(0);" onclick="clear_ptDetail()">[ยกเลิก]</a>
														<script>
															function clear_ptDetail(){
																document.getElementById('pt_detail1').checked=false;
																document.getElementById('pt_detail2').checked=false;
																document.getElementById('pt_detail3').checked=false;
															}
														</script>
													</div>
												</td>
											</tr>
											<tr>
												<td class="pdx">ผล X-RAY </td>
												<td>
													<input name="cxr" type="text" class="pdxhead" size="50" id="cxr"
														value="<?= $arrchk['cxr'] ?>" />
														<span class="style1"><br>กรณี ตั้งครรภ์ หรือไม่ได้ Xrayให้กรอกข้อมูลช่องนี้</span>
												</td>
												<td></td>
											</tr>
											<tr>
												<td class="pdx"> ผลตรวจตาบอดสี</td>
												<td colspan="2"><label>
														<select name="va" class="pdxhead" id="va">
															<option value="">---------- เลือก ----------</option>
															<option value="ไม่พบตาบอดสี" <? if ($arrchk['va'] == "ไม่พบตาบอดสี") {
																echo "selected='selected'";
															} ?>>ไม่พบตาบอดสี</option>
															<option value="พบตาบอดสี" <? if ($arrchk['va'] == "พบตาบอดสี") {
																echo "selected='selected'";
															} ?>>พบตาบอดสี</option>
														</select>
													</label></td>
											</tr>
											<tr>
												<td class="pdx">ผลตรวจ วัดสายตา</td>
												<td colspan="2" class="pdx">
													<input type="radio" name="eye" id="eye1" value="ปกติ"
														class="pdxhead eyeSelect" <? if ($arrchk['eye'] == "ปกติ") {
															echo "checked='checked'";
														} ?> onclick="showDiveye1()" />ปกติ&nbsp;
													<input type="radio" name="eye" id="eye2" value="ผิดปกติ"
														class="pdxhead eyeSelect" <? if ($arrchk['eye'] == "ผิดปกติ") {
															echo "checked='checked'";
														} ?> onclick="showDiveye()" />ผิดปกติ&nbsp;
													<? if ($arrchk['eye'] == "ผิดปกติ") {
														echo "<span class='pdx'>" . $arrchk['eye_detail'] . "</span>";
													} ?>

													<span id="hidden_div1" style="display: none;" class="pdx">
														ระบุความผิดปกติ : <input name="eye_detail" type="text"
															class="pdxhead" size="50" id="eye_detail"
															value="<?= $arrchk['eye_detail'] ?>" />
													</span>
													<a href="javascript: void(0);"
														onclick="return clearEyeSelect()">[ยกเลิก]</a>

													<script type="text/javascript">
														// if not getElementsByClassName create it // 
														if (!document.getElementsByClassName) {
															document.getElementsByClassName = function (className) {
																return this.querySelectorAll("." + className);
															};
															Element.prototype.getElementsByClassName = document.getElementsByClassName;
														}

														function clearEyeSelect() {
															var tabs = document.getElementsByClassName('eyeSelect');
															for (let index = 0; index < tabs.length; index++) {
																const element = tabs[index];
																element.checked = false;
															}

															document.getElementById('hidden_div1').style.display = "none";
															return false;
														}
													</script>
												</td>
											</tr>
											<tr>
												<td class="pdx">ผลตรวจ ความดันตา</td>
												<td colspan="2" class="pdx">
													<label for="eye_pressure1">
														<input type="radio" name="eye_pressure" id="eye_pressure1"
															value="ปกติ" class="pdxhead" <?php if ($arrchk['eye_pressure'] == "ปกติ") {
																echo "checked='checked'";
															} ?> />ปกติ
													</label>&nbsp;
													<label for="eye_pressure2">
														<input type="radio" name="eye_pressure" id="eye_pressure2"
															value="ผิดปกติ" class="pdxhead" <?php if ($arrchk['eye_pressure'] == "ผิดปกติ") {
																echo "checked='checked'";
															} ?>
															onclick="javascript: document.getElementById('eyePresDiv').style.display='';" />
														ผิดปกติ
													</label>
													&nbsp;
													<? if ($arrchk['eye_pressure'] == "ผิดปกติ") {
														echo "<span class='pdx'>" . $arrchk['eye_pressure_detail'] . "</span>";
													} ?>
													<span id="eyePresDiv" style="display: none;" class="pdx">
														ระบุความผิดปกติ :
														<input name="eye_pressure_detail" type="text" class="pdxhead"
															size="50" id="eye_pressure_detail"
															value="<?= $arrchk['eye_pressure_detail'] ?>" />
													</span>

													<a href="javascript: void(0);"
														onclick="return cancelEyePres()">[ยกเลิก]</a>
													<script>
														function cancelEyePres() {
															document.getElementById('eyePresDiv').style.display = "none";
															document.getElementById('eye_pressure1').checked = false;
															document.getElementById('eye_pressure2').checked = false;
															return false;
														}
													</script>
												</td>
											</tr>
											<tr>
												<td class="pdx">ผลตรวจ ลานสายตา</td>
												<td colspan="2" class="pdx">
													<label for="eye_vision1">
														<input type="radio" name="eye_vision" id="eye_vision1" value="ปกติ"
															class="pdxhead" <?php if ($arrchk['eye_vision'] == "ปกติ") {
																echo "checked='checked'";
															} ?> />ปกติ
													</label>&nbsp;
													<label for="eye_vision2">
														<input type="radio" name="eye_vision" id="eye_vision2"
															value="ผิดปกติ" class="pdxhead" <?php if ($arrchk['eye_vision'] == "ผิดปกติ") {
																echo "checked='checked'";
															} ?>
															onclick="javascript: document.getElementById('eyeVisionDiv').style.display='';" />
														ผิดปกติ
													</label>
													&nbsp;
													<? if ($arrchk['eye_vision'] == "ผิดปกติ") {
														echo "<span class='pdx'>" . $arrchk['eye_vision_detail'] . "</span>";
													} ?>
													<span id="eyeVisionDiv" style="display: none;" class="pdx">
														ระบุความผิดปกติ :
														<input name="eye_vision_detail" type="text" class="pdxhead"
															size="50" id="eye_vision_detail"
															value="<?= $arrchk['eye_vision_detail'] ?>" />
													</span>

													<a href="javascript: void(0);"
														onclick="return cancelEyePres()">[ยกเลิก]</a>
													<script>
														function cancelEyePres() {
															document.getElementById('eyeVisionDiv').style.display = "none";
															document.getElementById('eye_vision1').checked = false;
															document.getElementById('eye_vision2').checked = false;
															return false;
														}
													</script>
												</td>
											</tr>
											<tr>
												<td class="pdx">ผล EKG</td>
												<td colspan="2">
													<input name="ekg" type="text" class="pdxhead" size="50" id="ekg"
														value="<?= $arrchk['ekg'] ?>" />
												</td>
											</tr>
											<tr>
												<td class="pdx">ผลตรวจ BMD</td>
												<td colspan="2">
													<input name="42702" type="text" class="pdxhead" size="50" id="42702"
														value="<?= $arrchk['42702'] ?>" />
												</td>
											</tr>
											<tr>
												<td class="pdx">อัลตร้าซาวด์</td>
												<td colspan="2"><input name="altra" type="text" class="pdxhead" size="50"
														id="altra" value="<?= $arrchk['altra'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ตรวจคัดกรองหาความเสี่ยงของโรคเส้นเลือดแดงตีบตัน (CIMT)</td>
												<td colspan="2"><input name="cimt" type="text" class="pdxhead" size="50"
														id="cimt" value="<?= $arrchk['cimt'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ตรวจหัวใจด้วยคลื่นเสียงสะท้อนความถี่สูง (ECHO)</td>
												<td colspan="2"><input name="echo" type="text" class="pdxhead" size="50"
														id="echo" value="<?= $arrchk['echo'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ตรวจวัดความแข็งตัวของหลอดเลือด (ABI)</td>
												<td colspan="2"><input name="abi" type="text" class="pdxhead" size="50"
														id="abi" value="<?= $arrchk['abi'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ต่อมลูกหมาก</td>
												<td colspan="2"><input name="psa" type="text" class="pdxhead" size="50"
														id="psa" value="<?= $arrchk['psa'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">มะเร็งปากมดลูก</td>
												<td colspan="2"><input name="hpv" type="text" class="pdxhead" size="50"
														id="hpv" value="<?= $arrchk['hpv'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">แมมโมแกรม</td>
												<td colspan="2"><input name="mammogram" type="text" class="pdxhead"
														size="50" id="mammogram" value="<?= $arrchk['mammogram'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ลำดับ</td>
												<td colspan="2"><input name="seq" type="text" class="pdxhead" size="10"
														id="seq" value="<?= $arrchk['seq'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">สรุปผล Stool Culture(C-S)</td>
												<td colspan="2"><input name="cs" type="text" class="pdxhead" size="50"
														id="cs" value="<?= $arrchk['cs'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ผลตรวจ Stool Culture(C-S)</td>
												<td colspan="2"><input name="result_cs" type="text" class="pdxhead"
														size="50" value="<?= $arrchk['result_cs'] ?>" /></td>
											</tr>
											<!-- 
					<tr>
					  <td class="pdx">ผลตรวจ ตาบอดสี</td>
					  <td><input name="blindness" type="text" class="pdxhead" size="50" value="<?= $arrchk['blindness'] ?>" /></td>
					  <td>&nbsp;</td>
				  </tr>
					-->
											<tr>
												<td class="pdx">ผลการได้ยิน</td>
												<td colspan="2"><input name="hearing" type="text" class="pdxhead" size="50"
														value="<?= $arrchk['hearing'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ผลการตรวจสารเคมีโลหะหนัก</td>
												<td colspan="2"><input name="metal" type="text" class="pdxhead" size="50"
														value="<?= $arrchk['metal'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">สรุปผลการตรวจสารเคมีโลหะหนัก</td>
												<td colspan="2"><input name="metal_result" type="text" class="pdxhead"
														size="50" value="<?= $arrchk['metal_result'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ผลการตรวจสาร Benzene</td>
												<td colspan="2"><input name="benzene" type="text" class="pdxhead" size="50"
														value="<?= $arrchk['benzene'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">สรุปผลการตรวจสาร Benzene</td>
												<td colspan="2"><input name="benzene_result" type="text" class="pdxhead"
														size="50" value="<?= $arrchk['benzene_result'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">ผลตรวจความหนาแน่นของมวลกระดูก</td>
												<td colspan="2"><input name="bone_density" type="text" class="pdxhead"
														size="50" value="<?= $arrchk['bone_density'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">สายตาอาชีวอนามัย + สายตาสั้น, ยาว</td>
												<td colspan="2"><input name="occupa_health" type="text" class="pdxhead"
														size="50" value="<?= $arrchk['occupa_health'] ?>" /></td>
											</tr>

											<tr>
												<td class="pdx">ผลการตรวจ AFP</td>
												<td colspan="2"><input name="outAfp" type="text" class="pdxhead" size="50"
														value="<?= $arrchk['outAfp'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">สรุปผลการตรวจ AFP</td>
												<td colspan="2"><input name="outAfpResult" type="text" class="pdxhead"
														size="50" value="<?= $arrchk['outAfpResult'] ?>" /></td>
											</tr>

											<tr>
												<td class="pdx">ผลการตรวจ PSA</td>
												<td colspan="2"><input name="outPsa" type="text" class="pdxhead" size="50"
														value="<?= $arrchk['outPsa'] ?>" /></td>
											</tr>
											<tr>
												<td class="pdx">สรุปผลการตรวจ PSA</td>
												<td colspan="2"><input name="outPsaResult" type="text" class="pdxhead"
														size="50" value="<?= $arrchk['outPsaResult'] ?>" /></td>
											</tr>

											<!--
					<tr>
						<td class="pdx">
							ผลการตรวจมะเร็งปากมดลูก (Pap Smear)
						</td>
						<td>
							<input name="hpv" type="text" class="pdxhead" size="50" id="hpv" value="<?= $arrchk['hpv'] ?>" />
							[<span class="help" onclick="help('hpv','ปกติ')">ปกติ</span> | <span class="help" onclick="help('hpv','ผิดปกติ')">ผิดปกติ</span>]
						</td>
					</tr>
					-->
										</table>
										<script type="text/javascript">
											function help(id_name, status) {
												document.getElementById(id_name).value = status;
											}
										</script>
									</td>
								</tr>

								<tr>
									<td align="left" class="pdx">
										<input type="hidden" name="ptname" value="<?= $ptname ?>" />
										<input type="hidden" name="hn" value="<?= $hn ?>" />
										<input type="hidden" name="part" value="<?= $part; ?>" />
										<input type="hidden" name="row_id" value="<?= $arrchk['row_id'] ?>" />
										<input type="hidden" name="nPrefix" value="<?= $nPrefix ?>" />
										<?= $button; ?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
			</form>
			<p>
			<?
		}

		?>
			<br />
			<?php
			include("connect.inc");
			$showpart = $_GET["part"];

			$sql1 = "SELECT * FROM  out_result_chkup where part='$showpart' ORDER BY row_id asc";
			$query1 = mysql_query($sql1) or die(mysql_error());
			$num1 = mysql_num_rows($query1);

			$sqlchk1 = "SELECT * FROM  opcardchk where part='$showpart' and active='y'";
			$querychk1 = mysql_query($sqlchk1) or die(mysql_error());
			$numchk1 = mysql_num_rows($querychk1);

			$q = mysql_query("SELECT `name`,`code` FROM `chk_company_list` WHERE `code` = '$showpart' ");
			$company = mysql_fetch_assoc($q);

			?>
		<h1 class="pdx" align="center" style="font-size:32px;">รายชื่อผู้ตรวจสุขภาพ
			<?= $company['name'] . ' (' . $company['code'] . ')'; ?>
		</h1>

		<div class="pdx" align="center">ลงทะเบียนตรวจสุขภาพทั้งหมด
			<?= $numchk1; ?> คน ลงซักประวัติจำนวน
			<?= $num1; ?> คน
		</div>

		<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pdxpro">
			<tr>
				<td align="center" bgcolor="#FF99CC">#</td>
				<td height="31" align="left" bgcolor="#FF99CC"><strong>HN</strong></td>
				<td align="left" bgcolor="#FF99CC"><strong>ชื่อ-สกุล</strong></td>
				<td align="left" bgcolor="#FF99CC"><strong>น้ำหนัก</strong></td>
				<td align="left" bgcolor="#FF99CC"><strong>ส่วนสูง</strong></td>
				<td align="left" bgcolor="#FF99CC"><strong>รอบเอว</strong></td>
				<td align="left" bgcolor="#FF99CC"><strong>BP</strong></td>
				<td align="left" bgcolor="#FF99CC"><strong>P</strong></td>
				<td align="left" bgcolor="#FF99CC"><strong>Seq</strong></td>
				<td align="center" bgcolor="#FF99CC"><strong>สติ๊กเกอร์</strong></td>
				<td align="center" bgcolor="#FF99CC"><strong>ลบข้อมูล</strong></td>
			</tr>
			<?
			$i = 0;
			while ($arr1 = mysql_fetch_array($query1)) {
				$i++;
				?>
				<tr>
					<td align="center">
						<?= $i; ?>
					</td>
					<td>
						<?= $arr1['hn']; ?>
					</td>
					<td>
						<?= $arr1['ptname']; ?>
					</td>
					<td align="left">
						<?= $arr1['weight']; ?>
					</td>
					<td align="left">
						<?= $arr1['height']; ?>
					</td>
					<td align="left"><?=$arr1['waist']; ?></td>
					<td align="left">
						<? if (empty($arr1['bp3']) || empty($arr1['bp4'])) {
							echo $arr1['bp1'] . '/' . $arr1['bp2'];
						} else {
							echo $arr1['bp3'] . '/' . $arr1['bp4'];
						} ?>
					</td>
					<td align="left">
						<?= $arr1['p']; ?>
					</td>
					<td align="left">
						<?= $arr1['seq']; ?>
					</td>
					<td align="center"><a href="out_result_print.php?hn=<?= $arr1['hn']; ?>&part=<?= $showpart; ?>&act=print"
							target="_blank">พิมพ์</a></td>
					<td align="center"><a href="out_result.php?getid=<?= $arr1['row_id']; ?>&act=del&part=<?= $showpart; ?>"
							onclick="return confirm('คุณต้องการลบข้อมูลรายการนี้ใช่หรือไม่');">ลบ</a></td>
				</tr>
			<? } ?>
		</table>
	</div>
</body>
<?
if ($_GET["act"] == "del") {
	$del = "delete from out_result_chkup where row_id='$_GET[getid]'";
	if (mysql_query($del)) {
		echo "<script>alert('ลบข้อมูลเรียบร้อยแล้ว');window.location='out_result.php?part=$_GET[part]';</script>";
	} else {
		echo "<script>alert('ผิดพลาด ไม่สามารถลบข้อมูลได้');window.location='out_result.php?part=$_GET[part]';</script>";
	}
}
?>

</html>