<?php
session_start();
include 'config.php';
mysql_connect(HOST,USER,PASS);
mysql_select_db(DB);

mysql_query("SET NAMES UTF8");
?>
<!DOCTYPE html>
<html lang="en">
<meta charset="UTF-8">
<title>ระบบตรวจสอบข้อมูลผู้ป่วยใน</title>
<meta name="viewport" content="width=device-width,initial-scale=1">
<link rel="stylesheet" href="">

<style type="text/css">
	body {
		font-family: 'TH SarabunPSK';
		background-color: #b2dfdb;
		font-size: 24px;
	}

	.sarabun {
		font-family: TH SarabunPSK;
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

	a:link,
	a:visited {
		background-color: white;
		color: black;
		border: 2px solid #2980B9;
		padding: 10px 20px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		font-weight: bold;
	}

	a:hover,
	a:active {
		background-color: #2980B9;
		color: white;
	}

	.clearfix::after {
		content: "";
		clear: both;
		display: table;
	}
</style>

<body>

	<script src="https://unpkg.com/html5-qrcode" type="text/javascript"></script>

	<div class="">
		<h1 align="center">ระบบตรวจสอบข้อมูลผู้ป่วยใน</h1>
		<div>

		</div>
		<form name="frm" id="frm" method="POST" action="show_dataipd.php">
			<input type="hidden" name="act" value="show">

			<div style="text-align:center; min-height:300px;" class="clearfix">
				<div id="camera_container" style="display:none; position: relative; float: left; width:50%;">
					<div id="camera_content"></div>
				</div>
				<div style="float:right; width:50%;">
					<p style="text-align:center;">
						<button type="button" onclick="showCameraContainer()" class="sarabun"
							style="font-size:32px; padding:8px 16px;">เปิดกล้อง</button>
					</p>
					<div>
						<button type="button" onclick="checkHn()" class="sarabun"
							style="font-size:32px; padding:8px 16px;">แสกน</button>
					</div>
					<div id="camera_response"></div>
					<div>
						<p align="center"><input type="text" name="an" id="search" size="22" id="an"
								style="height:100px;width:320px;font-size:32px;" class="sarabun"
								placeholder="กรุณาระบุ AN ผู้ป่วย" autofocus>
						</p>
						<button type="submit" class="sarabun">ค้นหา</button>
					</div>
				</div>
			</div>
			<?php
			// $ua = strtolower($_SERVER['HTTP_USER_AGENT']);
			// if(preg_match('/(android|mobile)/', $ua) > 0)
			// {
			?>

			<?php
			// }
			?>

		</form>
		<div align="center">*** หากสแกน QrCode/BarCode แล้วพบว่าตัวอักษรเป็นภาษาไทย ให้เปลี่ยนภาษาที่แป้นพิมพ์ ตัว
			&#126; เป็นภาษาอังกฤษก่อน ***
		</div>
		<script>
			function showCameraContainer() {
				document.getElementById('camera_container').style.display = '';
				document.getElementById('camera_content').style.width = '300px';
				document.getElementById('camera_content').style.height = '300px';
				document.getElementById('camera_content').style.position = 'absolute';
				document.getElementById('camera_content').style.left = '0';
				document.getElementById('camera_content').style.right = '0';
				document.getElementById('camera_content').style.margin = '0 auto';

				let html5QrcodeScanner = new Html5QrcodeScanner(
					"camera_content",
					{ fps: 10, qrbox: { width: 200, height: 200 } },
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
					document.getElementById('camera_response').innerHTML = 'กรุณาตั้งกล้องให้อยู่ในกรอบ';
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
		<?
		if ($_POST["act"] == "show") {
			
			$an = $_POST["an"];
			$sql1 = "SELECT an,hn,ptname,ptright,bedcode,diag,doctor,my_ward,adm_w FROM ipcard  WHERE `an` = '" . $an . "' and dcdate ='0000-00-00 00:00:00' limit 1 ";
			$result1 = mysql_query($sql1);
			$num = mysql_num_rows($result1);
			if ($num < 1) {
				echo "ไม่พบข้อมูลผู้ป่วย AN:$an ในระบบผู้ป่วยใน กรุณาตรวจสอบข้อมูลใหม่อีกครั้ง";
				echo '<a href="show_dataipd.php">กลับไปหน้าค้นหา</a>';
				exit;
			} else {
				list($an, $hn, $ptname, $ptright, $bedcode, $diag, $doctor, $my_ward, $adm_w) = Mysql_fetch_row($result1);

				$query = "SELECT idcard,bed,date,date_format(date,'%d-%m-%Y'),diagnos,food,price,paid,debt,caldate,bedname,chgdate,status,age,diag1,days FROM bed WHERE an = '$an' ORDER BY bedcode ASC ";
				//echo $query;
				$result = mysql_query($query) or die("Query failed");
				list($idcard, $bed, $date1, $date, $diagnos, $food, $price, $paid, $debt, $caldate, $bedname, $chgdate, $status, $age, $diag1, $daysall) = mysql_fetch_row($result);

				$str = "month=" . date('m') . "&year=" . (date('Y') + 543) . "&date=" . date('dmy');

				//////// แพ้ยา ////////
				$list1 = array();
				$sql = "Select  tradname,advreact,sideeffects From drugreact  where hn = '" . $hn . "' and advreact !=''";
				$result = Mysql_Query($sql);
				$drugreact_rows = mysql_num_rows($result);
				if ($drugreact_rows > 0) {
					while ($arr = Mysql_fetch_assoc($result)) {
						array_push($list1, $arr["tradname"]);
					}
					$list_drug1 = implode(", ", $list1);
					$drugreact_disease .= $list_drug1;
				} else {
					$drugreact_disease = "ปฎิเสธการแพ้ยา";
				}
				?>

				<FORM name="f1" METHOD=POST ACTION="" Onsubmit="return checkForm();">
					<TABLE bgcolor="#e0f2f1" width="70%" align="center" border="3" bordercolor="#009688" cellpadding="5"
						cellspacing="5">
						<TR>
							<TD>
								<TABLE width="100%" cellpadding="3" cellspacing="3" style="font-size: 32px;">
									<TR class="tb_head">
										<TD colspan="2" align="center"><strong>แสดงข้อมูลผู้ป่วย</strong></TD>
									</TR>
									<TR>
										<TD width="34%" align="right">วันที่รับป่วย : </TD>
										<TD width="66%">
											<?php echo $date . " " . substr($date1, 11); ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">AN : </TD>
										<TD><strong>
												<?php echo $an; ?>
											</strong><span style="margin-left:20px;">HN :
												<?php echo $hn; ?>
											</span></TD>
									</TR>
									<TR>
										<TD align="right">ชื่อ - สกุล : </TD>
										<TD>
											<?php echo $ptname; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">อายุ : </TD>
										<TD>
											<?php echo $age; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">โรคประจำตัว : </TD>
										<TD>
											<?php echo $diag1; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">แพ้ยา : </TD>
										<TD>
											<?php echo $drugreact_disease; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">สิทธิ : </TD>
										<TD>
											<?php echo $ptright; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">หอผู้ป่วยรับ : </TD>
										<TD>
											<?php echo $my_ward; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">เตียง/ห้อง : </TD>
										<TD>
											<?php echo $bedcode; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">อาหาร : </TD>
										<TD>
											<?php echo $food; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">โรค : </TD>
										<TD>
											<?php echo $diag; ?>
										</TD>
									</TR>
									<TR>
										<TD align="right">แพทย์ : </TD>
										<TD>
											<?php echo $doctor; ?>
										</TD>
									</TR>

									<TR>
										<TD colspan="2" align="center"><A target="_BLANK"
												HREF="<?=SM3_HOST_URL;?>ipd_labchk.php?an=<?= $an; ?>&hn=<?= $hn; ?>"><img
													src="images/blood-bag.png" height="25px"
													width="25px"><br>ข้อมูลการให้เลือด</a>
											<span style="margin-left:20px;"><A target="_BLANK"
													HREF="<?=SM3_HOST_URL;?>ipd_drugmar.php?an=<?= $an; ?>&hn=<?= $hn; ?>&<?= $str; ?>"><img
														src="images/prescription.png" height="25px" width="25px"><br>ใบ
													MAR</a></span>
											<span style="margin-left:20px;"><A target="_BLANK"
													HREF="<?=SM3_HOST_URL;?>ipd_drugorder.php?an=<?= $an; ?>&hn=<?= $hn; ?>"><img
														src="images/nurse.png" height="25px"
														width="25px"><br>จ่ายยาผู้ป่วย</a></span>
											<span style="margin-left:20px;"><A target="_BLANK"
													HREF="<?=SM3_HOST_URL;?>ipd_drugchk.php?an=<?= $an; ?>&hn=<?= $hn; ?>&<?= $str; ?>"><img
														src="images/drug.png" height="25px" width="25px"><br>ข้อมูล
													Drugprofile</a></span>
										</TD>
									</TR>
								</TABLE>
								<br>
							</TD>
						</TR>
					</TABLE>
				</FORM>
			<?
			}
		}
		?>


</body>

</html>