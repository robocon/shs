<?php
include '../bootstrap.php';

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

$web_title = 'หน้าลงทะเบียนผู้ป่วย Hypertension';
require "header.php";

$date_now = date("Y-m-d");

function calcage($birth)
{
	$today = getdate();
	$nY = $today['year'];
	$nM = $today['mon'];
	$bY = substr($birth, 0, 4) - 543;
	$bM = substr($birth, 5, 2);
	$ageY = $nY - $bY;
	$ageM = $nM - $bM;

	if ($ageM < 0) {
		$ageY = $ageY - 1;
		$ageM = 12 + $ageM;
	}

	if ($ageM == 0) {
		$pAge = "$ageY ปี";
	} else {
		$pAge = "$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

$thaidate = (date("Y") + 543) . date("-m-d");
?>
<style>
	.font_title {
		font-family: "TH SarabunPSK";
		font-size: 25px;
	}
	.tb_font {
		font-family: "TH SarabunPSK";
		font-size: 24px;
		color: #09F;
	}
	.tb_font_1 {
		font-family: "TH SarabunPSK";
		font-size: 24px;
		color: #FFFFFF;
		font-weight: bold;
	}
	.tb_col {
		font-family: "TH SarabunPSK";
		font-size: 24px;
		background-color: #9FFF9F;
	}
	.tb_font_2 {
		font-family: "TH SarabunPSK";
		color: #B00000;
		font-size: 22px;
		font-weight: bold;
	}
	.forntsarabun {
		font-family: "TH SarabunPSK";
		font-size: 22px;
		color: #FFF;
	}

	.forntsarabun1 {
		font-family: "TH SarabunPSK";
		font-size: 22px;
	}
	input[readonly]{
		background-color: #e8e8e8;
	}
</style>


<h1 class="forntsarabun1">ลงทะเบียนผู้ป่วย Hypertension</h1>

<form action="" method="post">
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE">
		<TR>
			<TD align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข HN</TD>
		</TR>
		<TR>
			<TD class="tb_font" style="padding: 2px;">
				<input name="p_hn" type="text" class="forntsarabun1" id="p_hn" value="<?php echo $_POST["p_hn"]; ?>" />&nbsp;
				<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" />
			</TD>
		</TR>
	</TABLE>
</form>
<br>
<?php
$hn = sprintf("%s", trim($_POST["p_hn"]));
if (!empty($hn)) {

	$sqlht = "SELECT *,concat(yot,name,' ',surname) AS ptname FROM opcard WHERE hn='$hn' ";
	$qOpcard = $dbi->query($sqlht);
	if (!$qOpcard->num_rows) {

		print "<br> <font class='forntsarabun1'>ไม่พบ  HN  <b>$hn</b> ในระบบทะเบียน </font>";

	} else {

		$qHt = $dbi->query("SELECT hn FROM hypertension_clinic WHERE  hn ='$hn' ");
		$rows = $qHt->num_rows;
		if ($rows>0) {

			print "<BR><font class='forntsarabun1'> <b>HN:</b>$hn ได้ลงทะเบียนแล้ว </font>";
			print "<BR><font class='forntsarabun1'> คลิก <a href='hypertension_edit.php?p_hn=$hn'>ที่นี่</a> หากต้องการแก้ไข</font>";
			
		} else {

			$arr_view = $qOpcard->fetch_assoc();
			$y = date("Y") + 543;
			$d = date("d");
			$m = date("m");
			$date1 = $y . '-' . $m . '-' . $d;

			$arr_opd = array();
			$thaiDateShort = '';
			$opd = "SELECT * FROM opd WHERE  hn='".$arr_view['hn']."' ORDER BY `row_id` DESC LIMIT 1 ";
			$qOpd = $dbi->query($opd);
			if($qOpd->num_rows>0){
				$arr_opd = $qOpd->fetch_assoc();
				$thaiDateShort = substr($arr_opd['thidate'],0,10);
			}
			$arr_view["age"] = calcage($arr_view["dbirth"]);

			$height = $arr_opd["height"];
			$weight = $arr_opd["weight"];

			$cigarette = $arr_opd["cigarette"];

			
			////////////////////////////////////////

			$datenow = date("Y-m-d");

			// $sqlht = "SELECT MAX(ht_no) AS htnumber FROM hypertension_clinic";
			// $queryht = mysql_query($sqlht);
			// $arrht = mysql_fetch_array($queryht);
			$qHtNumber = $dbi->query("SELECT MAX(ht_no) AS htnumber FROM hypertension_clinic");
			$arrht = $qHtNumber->fetch_assoc();
			$ht = $arrht['htnumber'] + 1;
			$ht_no = $ht;
			?>

			<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
			<FORM METHOD="post" ACTION="hypertension.php?do=save" name="F1">

				<input name="age" type="hidden" id="age" value="<?=$arr_view["age"]; ?>" />
				<input name="hn" type="hidden" id="hn" value="<?=$arr_view["hn"]; ?>" />
				<input name="hn" type="hidden" id="hn" value="<?=$arr_view["hn"]; ?>" />
				<input name="ptname" type="hidden" id="ptname" value="<?=$arr_view["ptname"]; ?>" />
				<input name="age" type="hidden" id="age" value="<?=$arr_view["age"]; ?>" />
				<input name="dbirth" type="hidden" id="dbirth" value="<?=$arr_view["dbirth"]; ?>" />
				<input name="pension" type="hidden" id="pension" value="<?=$arr_view["pension_status"]; ?>" />
				<input name="ptright" type="hidden" id="ptright" value="<?=$arr_view["ptright"];?>" />
				<input name="row_id" type="hidden" value="<?=$arr_dxofyear["row_id"]; ?>" />
				
				<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE">
					<tr>
						<td>
							<!-- ข้อมูลผู้ป่วย -->
							<table border="0" width="100%">
								<TR>
									<TD align="left" bgcolor="#0000CC" class="tb_font_1" colspan="4">
										<span class="forntsarabun">&nbsp;&nbsp;ข้อมูลผู้ป่วย&nbsp;&nbsp;</span>
									</TD>
								</TR>
								<tr>
									<td align="right" class="tb_font_2" width="120">วันที่ลงทะเบียน: </td>
									<td colspan="3">
										<span class="data_show">
											<input name="thaidate" type="text" class="forntsarabun1" id="thaidate" value="<?= date("Y-m-d"); ?>" />
										</span>
										<span class="tb_font_2">// รูปแบบ ปี ค.ศ.-เดือน-วัน</span>
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">HT number :</td>
									<td width="280">
										<span class="data_show">
											<input name="ht_no" type="text" class="forntsarabun1" id="ht_no" value="<?=$ht_no;?>" readonly />
										</span>
									</td>
									<td align="right" width="70" class="tb_font_2">HN :</td>
									<td align="left" class="forntsarabun1">
										<?php echo $arr_view["hn"]; ?>
										
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">ชื่อ-สกุล :</td>
									<td class="forntsarabun1">
										<?php echo $arr_view["ptname"]; ?>
										
									</td>
									<td align="right" class="tb_font_2">อายุ :</td>
									<td align="left" class="forntsarabun1">
										<?php echo $arr_view["age"]; ?>
										
										
									</td>
								</tr>
								<tr class="forntsarabun1">
									<td align="right" class="tb_font_2">เพศ :</td>
									<td colspan="2">
										<?php $sex1 = $sex2 = "";
										if ($arr_view['sex'] == 'ช') {
											$sex1 = "checked";
										} elseif ($arr_view['sex'] == 'ญ') {
											$sex2 = "checked";
										}
										?>
										<label for="sex1"><input name="sex" id="sex1" type="radio" value="0" <?= $sex1; ?> /> ชาย</label>
										<label for="sex2"><input name="sex" id="sex2" type="radio" value="1" <?= $sex2; ?> /> หญิง</label>

										
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">แพทย์ :</td>
									<td>
										<select name="doctor" id="doctor" class="forntsarabun1">
											<option value="" >-- กรุณาเลือกแพทย์ --</option>
											<?php
											// $result = mysql_query("SELECT name FROM doctor WHERE status = 'y' ");
											// while ($dbarr2 = mysql_fetch_array($result)) {
											$qDoctor = $dbi->query("SELECT name FROM doctor WHERE status = 'y' ");
											while($dbarr2 = $qDoctor->fetch_assoc()){

												$sub1 = substr($arr_opd['doctor'], 0, 5);
												$sub2 = substr($dbarr2['name'], 0, 5);

												if ($dbarr2['name'] == $arr_opd['doctor']) {
													echo "<option value='" . $dbarr2['name'] . "'  selected>" . $dbarr2['name'] . "</option>";
												} else {
													echo "<option value='" . $dbarr2['name'] . "' >" . $dbarr2['name'] . "</option>";
												}
											} // End while
											?>
										</select> </td>
									<td align="right" class="tb_font_2">สิทธิ :</td>
									<td align="left" class="forntsarabun1">
										<?php echo $arr_view["ptright"]; ?>
										
									</td>
								</tr>
							</table>

							<?php
							$ht = $height / 100;
							$bmi = number_format($weight / ($ht * $ht), 2);
							?>
							<table border="0" class="forntsarabun1" width="100%">
								<TR>
									<TD align="left" bgcolor="#0000CC" class="tb_font_1" colspan="8">
										<span class="forntsarabun">&nbsp;&nbsp;การตรวจร่างกาย&nbsp;&nbsp; <?=!empty($thaiDateShort) && !empty($arr_opd['temperature']) ? "(ข้อมูลซักประวัติเมื่อ $thaiDateShort)" : '' ;?></span> 
									</TD>
								</TR>
								<tr>
									<td width="120" align="right" class="tb_font_2">ส่วนสูง : </td>
									<td>
										<input name="height" type="text" class="forntsarabun1" value="<?=$height;?>" size="3" maxlength="5" 
onBlur="calbmi(this.value,document.F1.weight.value)" /> ซม.
									</td>
									<td width="70" align="right" class="tb_font_2">น้ำหนัก : </td>
									<td>
										<input name="weight" type="text" class="forntsarabun1" value="<?=$weight;?>" size="1" maxlength="5" 
onBlur="calbmi(document.F1.height.value,this.value)" /> กก. 
									</td>
									<td width="70" align="right" class="tb_font_2">BMI :</td>
									<td>
										<input name="bmi" type="text" size="3" value="<?=$bmi;?>" class="forntsarabun1" />
									</td>
									<td width="70" align="right" class="tb_font_2">รอบเอว : </td>
									<td>
										<input name="round" type="text" class="forntsarabun1" id="round" cvalue="<?=$arr_opd["waist"];?>" size="3" maxlength="5" /> ซม.
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">T : </td>
									<td>
										<input name="temperature" type="text" size="1" maxlength="5" value="<?=$arr_opd["temperature"]; ?>" class="forntsarabun1" /> C&deg;
									</td>
									<td align="right" class="tb_font_2">P : </td>
									<td>
										<input name="pause" type="text" size="1" maxlength="3" value="<?=$arr_opd["pause"]; ?>" class="forntsarabun1" /> ครั้ง/นาที
									</td>
									<td align="right" class="tb_font_2">R :</td>
									<td>
										<input name="rate" type="text" size="1" maxlength="3"value="<?=$arr_opd["rate"]; ?>" class="forntsarabun1" /> ครั้ง/นาที
									</td>
									<td align="right" class="tb_font_2">BP :</td>
									<td>
										<input name="bp1" type="text" size="1" maxlength="3" value="<?=$arr_opd["bp1"];?>" class="forntsarabun1" />
										/
										<input name="bp2" type="text" size="1" maxlength="3" value="<?=$arr_opd["bp2"];?>" class="forntsarabun1" /> mmHg
									</td>
								</tr>
								<tr>
									<td class="tb_font_2" align="right">Repeat BP : </td>
									<td colspan="7">
										<input name="bp3" type="text" size="1" maxlength="3" value="<?=$arr_opd["bp3"];?>" class="forntsarabun1" />
										/
										<input name="bp4" type="text" size="1" maxlength="3"value="<?=$arr_opd["bp4"];	?>" class="forntsarabun1" /> mmHg
									</td>
								</tr>
							</table>

							<table class="forntsarabun1" width="100%">
								<tr>
									<td align="right" class="tb_font_2" width="120">การวินิจฉัย : </td>
									<td align="left" class="forntsarabun1">
										<label for="ht1"><input name="ht" id="ht1" type="radio" value="0" /> No</label>
										<label for="ht2"><input name="ht" id="ht2" type="radio" value="1" /> Essential HT</label>
										<label for="ht3"><input name="ht" id="ht3" type="radio" value="3" /> Secondary HT</label>
										<label for="ht4"><input name="ht" id="ht4" type="radio" value="2" /> Uncertain type</label>
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2"></td>
									<td>
										การวินิจฉัยครั้งแรกประมาณ พ.ศ. <input type="text" name="diag_date"
											id="diag_date" value="<?= (date('Y') + 543) . date('-m-d'); ?>">
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2">โรคร่วม HT :</td>
									<td align="left" class="forntsarabun1">
										<label for="joint1"><input id="joint1" name="joint_disease_dm" type="checkbox" value="Y" /> เบาหวาน</label>
										<label for="joint2"><input id="joint2" name="joint_disease_nephritic" type="checkbox" value="Y" /> ไตเรื้อรัง</label>
										<label for="joint3"><input id="joint3" name="joint_disease_myocardial" type="checkbox" value="Y" /> กล้ามเนื้อหัวใจตาย</label>
										<label for="joint4"><input id="joint4" name="joint_disease_paralysis" type="checkbox" value="Y" /> อัมพฤกษ์อัมพาต</label>
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2"> ประวัติบุหรี่ : </td>
									<td >
										<INPUT TYPE="radio" id="cigarette1" name="cigarette" value="0" <?php if ($cigarette == 0) {
											echo "checked";
										} ?>>
										<label for="cigarette1">ไม่สูบบุหรี่</label>
										<INPUT TYPE="radio" id="cigarette2" name="cigarette" value="1" <?php if ($cigarette == 1) {
											echo "checked";
										} ?>>
										<label for="cigarette2">สูบบุหรี่</label>
										<input type="radio" id="cigarette3" name="cigarette" value="2" <?php if ($cigarette == 2) {
											echo "checked";
										} ?> />
										<label for="cigarette3">NA</label>
									</td>
								</tr>
								<tr>
									<td align="right" class="tb_font_2" width="120">EKG : </td>
									<td>
										<?php 
										$qEkg = $dbi->query("SELECT row_id,SUBSTRING(date,1,10) AS date FROM patdata WHERE hn = '$hn' AND code IN('E-EKGMO','11303') AND (date >= '2567-01-01 00:00:00' AND date <= '2567-12-31 23:59:59');");
										if($qEkg->num_rows>0){
											$ekg = $qEkg->fetch_assoc();
											?>
											<p>ได้รับการตรวจเมื่อวันที่ <b><?=$ekg['date'];?></b></p>
											<input type="hidden" name="ekg_date" value="<?=$ekg['date'];?>">
											<?php
										}else{
											?>-<?php
										}
										?>
									</td>
								</tr>
							</table>
							<table width="100%">
								<tr align="left" bgcolor="#0000CC" class="tb_font_1">
									<td>
										<span class="forntsarabun">&nbsp;&nbsp;ผลตรวจทางพยาธิ&nbsp;&nbsp;</span> 
									</td>
								</tr>
								<tr>
									<td>
									<?php 
									$sqlLab = "SELECT a.orderdate,b.* 
									FROM (
										SELECT SUBSTRING(orderdate,1,10) AS orderdate,autonumber 
										FROM resulthead 
										WHERE hn = '$hn' AND profilecode IN('GLU','LDL','HBA1C') 
										AND ( orderdate >= '2024-01-01 00:00:00' AND orderdate <= '2024-12-31 23:59:59' )
										GROUP BY profilecode
										ORDER BY orderdate DESC 
									) AS a LEFT JOIN resultdetail AS b ON a.autonumber = b.autonumber 
									WHERE b.labcode IN ('GLU','LDL','HBA1CC') ";
									$qLab = $dbi->query($sqlLab);
									if($qLab->num_rows>0){
										?>
										<table border="1" cellpadding="8" cellspacing="0">
											<tr>
												<th>Date</th>
												<th>Lab Detail</th>
												<th>Result</th>
												<th>Normal</th>
												<th>Flag</th>
											</tr>
											<?php
											while ($a = $qLab->fetch_assoc()) {
												?>
												<tr>
													<td><?=$a['orderdate'];?></td>
													<td align="right"><b><?=$a['labname'];?></b></td>
													<td><?=$a['result'].' '.$a['unit'];?></td>
													<td><?=$a['normalrange'];?></td>
													<td>
														<?=$a['flag'];?>
														<input type="hidden" name="autonumber" value="<?=$a['autonumber'];?>">
													</td>
												</tr>
												<?php
											}
											?>
										</table>
										<?php
									}
									?>
									</td>
								</tr>
							</table>
						</td>
					</tr>
				</table>
				<br>
				<div style="text-align:center;">
					<input name="submit" type="submit" class="forntsarabun1" value="บันทึกข้อมูล" style="padding: 8px 16px;"/>
				</div>
			</FORM>
			<script>
				function calbmi(a, b) {
					var h = a / 100;
					var bmi = b / (h * h);
					document.F1.bmi.value = bmi.toFixed(2);
				}
			</script>
			<script type="text/javascript">
				var popup7;
				window.onload = function () {
					popup7 = new Epoch('popup7', 'popup', document.getElementById('diag_date'), false);
				};
			</script>
		<?php }
	} //ปิด ค้นหา hn ใน opcard
}

if ($_REQUEST['do'] == 'save') {

	$dateN = date("Y-m-d");
	$register = date("Y-m-d H:i:s");

	$joint_disease = 0;
	if (
		$_POST['joint_disease_dm']
		or $_POST['joint_disease_nephritic']
		or $_POST['joint_disease_myocardial']
		or $_POST['joint_disease_paralysis']
	) {
		$joint_disease = 1;
	}

	$diag_date = $_POST['diag_date'];

	$bp3 = $_POST['bp3'];
	$bp4 = $_POST['bp4'];

	$strSQL = "INSERT INTO `hypertension_clinic` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , `ptname` , `ptright` , `sex` , `ht` , `joint_disease`, `joint_disease_dm` , `joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , `smork` , `bmi` , `height` , `weight` , `round` , `temperature` , `pause` , `rate` , `bp1` , `bp2` , `officer` , `register_date`,pension,`age_str`,`diag_date`,`bp3`,`bp4` )
	VALUES ('" . $_POST["ht_no"] . "','" . $_POST["thaidate"] . "', '" . $dateN . "', '" . $_POST['hn'] . "', '" . $_POST['doctor'] . "', '" . $_POST['ptname'] . "', '" . $_POST['ptright'] . "', '" . $_POST['sex'] . "', '" . $_POST['ht'] . "', '$joint_disease', '" . $_POST['joint_disease_dm'] . "', '" . $_POST['joint_disease_nephritic'] . "', '" . $_POST['joint_disease_myocardial'] . "', '" . $_POST['joint_disease_paralysis'] . "', '" . $_POST['cigarette'] . "', '" . $_POST['bmi'] . "', '" . $_POST['height'] . "','" . $_POST['weight'] . "', '" . $_POST['round'] . "', '" . $_POST['temperature'] . "', '" . $_POST['pause'] . "', '" . $_POST['rate'] . "', '" . $_POST['bp1'] . "', '" . $_POST['bp2'] . "', '" . $sOfficer . "', '" . $register . "','" . $_POST['pension'] . "','" . $_POST['age'] . "','$diag_date','$bp3','$bp4');";
	$objQuery = mysql_query($strSQL);

	// เพิ่มเข้าไปใน ประวัติผู้ป่วย
	$strSQL = "INSERT INTO `hypertension_history` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , `ptname` , `ptright` , `sex` , `ht` , `joint_disease`, `joint_disease_dm` , `joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , `smork` , `bmi` , `height` , `weight` , `round` , `temperature` , `pause` , `rate` , `bp1` , `bp2` , `officer` , `register_date`,pension,`age_str`,`diag_date`,`bp3`,`bp4` )
	VALUES ('" . $_POST["ht_no"] . "','" . $_POST["thaidate"] . "', '" . $dateN . "', '" . $_POST['hn'] . "', '" . $_POST['doctor'] . "', '" . $_POST['ptname'] . "', '" . $_POST['ptright'] . "', '" . $_POST['sex'] . "', '" . $_POST['ht'] . "', '$joint_disease', '" . $_POST['joint_disease_dm'] . "', '" . $_POST['joint_disease_nephritic'] . "', '" . $_POST['joint_disease_myocardial'] . "', '" . $_POST['joint_disease_paralysis'] . "', '" . $_POST['cigarette'] . "', '" . $_POST['bmi'] . "', '" . $_POST['height'] . "','" . $_POST['weight'] . "', '" . $_POST['round'] . "', '" . $_POST['temperature'] . "', '" . $_POST['pause'] . "', '" . $_POST['rate'] . "', '" . $_POST['bp1'] . "', '" . $_POST['bp2'] . "', '" . $sOfficer . "', '" . $register . "','" . $_POST['pension'] . "','" . $_POST['age'] . "','$diag_date','$bp3','$bp4');";
	$objQuery = mysql_query($strSQL);


	if ($objQuery) {
		echo "<br><font class='forntsarabun1'>บันทึกข้อมูลเรียบร้อยแล้ว</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension.php'>";
	} else {
		echo "<br><font class='forntsarabun1'>ไม่สามารถบันทึกได้ [" . mysql_error($Conn) . "]</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension.php'>";
	}


	// include("../unconnect.inc");	 
}

require "footer.php";
?>