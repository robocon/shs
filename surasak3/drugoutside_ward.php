<?php
session_start();
include("connect.php");
if ($_POST['button_submit']) {

	$Thidate = (date("Y") + 543) . date("-m-d H:i:s");
	$an = sprintf("%s", $_POST['an']);
	$code = sprintf("%s", $_POST['code']);
	$detail = sprintf("%s", $_POST['detail']);
	$amount = sprintf("%s", $_POST['amount']);
	$price = sprintf("%s", $_POST['price']);
	$part = sprintf("%s", $_POST['part']);
	$nprice = sprintf("%s", $_POST['nprice']);
	$sOfficer = sprintf("%s", $_SESSION["sOfficer"]);
	$cBedcode = sprintf("%s", $_POST['cBedcode']);
	$backTo = sprintf("%s", $_POST['backTo']);

	if (empty($code) || empty($detail) || empty($amount) || empty($price)) {
		?>
		กรุณากรอกข้อมูล ให้ครบถ้วน <a href="javascript:void(0);" onclick="window.history.back(-1)">คลิกที่นี่</a> เพื่อย้อนกลับ
		<?php
		exit;
	}

	$strsql3 = "INSERT INTO `ipacc` ( `date` , `an` , `code` , `depart` , `detail` , `amount` , `price` , `paid` , `part` , `yprice` , `nprice` , `idname` , `accno`,`idno`)
	VALUES ('$Thidate', '$an', '$code', 'WARD', '$detail', '$amount', '$price', '', '$part', '$price', '$nprice', '$sOfficer', '1','$idno')";
	$strquery3 = mysql_query($strsql3) or die(mysql_error());
	if ($strquery3) {

		if(!empty($backTo)){
			echo 'บันทึกข้อมูลเรียบร้อยแล้วครับ กำลังกลับไปเมนู บันทึกค่าใช้จ่ายนอกโรงพยาบาล ผู้ป่วยใน ระบุ AN';
		}else{
			echo "บันทึกข้อมูลเรียบร้อยแล้วครับ กำลังกลับไปเมนู บันทึกค่าใช้จ่าย / คืนยา / จำหน่าย";
		}
	}

	$defaultUrl = 'ipdata.php?cBedcode='.$cBedcode;

	// ถ้าคีย์มาจากหน้า drugoutside_hnward
	if(!empty($backTo)){
		$defaultUrl = 'drugoutside_hnward.php';
	}
	?>
	<script>
		setTimeout(() => {
			window.location = '<?=$defaultUrl;?>';
		}, 2000);
	</script>
	<?php
	exit;
}
?>
<!DOCTYPE html
	PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>บันทึกค่าบริการ นอกโรงพยาบาล</title>
</head>
<style type="text/css">
	.font1 {
		font-family: "TH SarabunPSK";
		font-size: 22px;
	}
</style>

<body>
	<?php
	$backTo = sprintf("%s", $_REQUEST['backTo']);

	$build = array("42" => "หอผู้ป่วยรวม", "44" => "หอผู้ป่วย ICU", "43" => "หอผู้ป่วยสูติ", "45" => "หอผู้ป่วยพิเศษ");
	$Thidate = (date("Y") + 543) . date("-m-d H:i:s");
	$cAn = sprintf("%s",$_REQUEST["cAn"]);
	$sql = "SELECT `an`,`hn`,`ptname`,`bedcode`,`ptright`,`doctor`,`diag` FROM `ipcard` WHERE `an` = '$cAn' LIMIT 0,1 ";
	$result = mysql_query($sql);
	$numRow = mysql_num_rows($result);
	if($numRow>0){
		$arr = mysql_fetch_assoc($result);
	
	?>
	<h3 align="center" class="font1">บันทึกค่าใช้จ่ายนอกโรงพยาบาล ผู้ป่วยใน</h3>
	<form name="f1" method="post">
		<fieldset class="font1">
			<legend>ข้อมูลส่วนตัวผู้ป่วย</legend>
			<TABLE align="center" width="70%">
				<TR>
					<TD align="right">AN : </TD>
					<TD bgcolor="#FFFFBC"><?php echo $arr["an"]; ?><input type="hidden" name="an"
							value="<?php echo $arr["an"]; ?>" /></TD>
					<TD align="right">HN : </TD>
					<TD bgcolor="#FFFFBC"><?php echo $arr["hn"]; ?><input type="hidden" name="hn"
							value="<?php echo $arr["hn"]; ?>" /></TD>
					<TD align="right">ชื่อ-สกุล : </TD>
					<TD bgcolor="#FFFFBC"><?php echo $arr["ptname"]; ?><input type="hidden" name="ptname"
							value="<?php echo $arr["ptname"]; ?>" /></TD>
				</TR>
				<TR>
					<TD align="right">หอผู้ป่วย : </TD>
					<TD bgcolor="#FFFFBC"><?php echo $build[substr($arr["bedcode"], 0, 2)]; ?></TD>
					<TD align="right">สิทธิ์ : </TD>
					<TD bgcolor="#FFFFBC"><?php echo $arr["ptright"]; ?><input type="hidden" name="ptright"
							value="<?php echo $arr["ptright"]; ?>" /></TD>
					<TD align="right">แพทย์ : </TD>
					<TD bgcolor="#FFFFBC"><?php echo $arr["doctor"]; ?><input type="hidden" name="doctor"
							value="<?php echo $arr["doctor"]; ?>" /></TD>
				</TR>
				<TR>
					<TD align="right">Diag :</TD>
					<TD bgcolor="#FFFFBC"><?php echo $arr["diagnos"]; ?><input type="hidden" name="diagnos"
							value="<?php echo $arr["diagnos"]; ?>" /></TD>
					<TD align="right">&nbsp;</TD>
					<TD>&nbsp;</TD>
					<TD align="right">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
			</TABLE>
		</fieldset>
		<br />
		<fieldset class="font1">
			<legend>ข้อมูลค่าบริการ</legend>
			<TABLE align="center">
				<TR>
					<TD align="right">รหัสค่าบริการ : </TD>
					<TD><input name="code" type="text" class="font1" /></TD>
					<TD align="right">ชื่อหัถการ : </TD>
					<TD><input name="detail" type="text" class="font1" id="detail" size="40" /></TD>
					<TD align="right">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD align="right">จำนวน : </TD>
					<TD bgcolor="#FFFFBC"><input name="amount" type="text" class="font1" /></TD>
					<TD align="right">ประเภท : </TD>
					<TD bgcolor="#FFFFBC"><select name="part" id="part" class="font1">
							<? $sqlpart = "SELECT DISTINCT (part)as part FROM `ipacc` GROUP BY part";
							$querypart = mysql_query($sqlpart);
							while ($arrpart = mysql_fetch_array($querypart)) {
								?>
								<option value="<?= $arrpart['part']; ?>">
									<?= $arrpart['part']; ?>
								</option>
							<? } ?>
						</select></TD>
					<TD align="right">&nbsp;</TD>
					<TD>&nbsp;</TD>
				</TR>
				<TR>
					<TD align="right">ราคา :</TD>
					<TD bgcolor="#FFFFBC"><input name="price" type="text" class="font1" id="price" /></TD>
					<!--<TD align="right">เบิกได้ :</TD>
					<TD bgcolor="#FFFFBC"><input name="yprice" type="text" class="font1" id="yprice" /></TD>
					<TD align="right">เบิกไม่ได้ :</TD>
					<TD bgcolor="#FFFFBC"><input name="nprice" type="text" class="font1" id="nprice" /></TD>-->
				</TR>
				<TR>
					<TD colspan="6" align="center"></TD>
				</TR>
			</TABLE>
			<br />
			<div align="center"><INPUT name="button_submit" TYPE="submit" class="font1" ID="button_submit" VALUE=" ตกลง ">
				<input type="hidden" name="cBedcode" value="<?=$arr['bedcode'];?>">
				<?php 
				if(!empty($backTo)){
					?>
					<input type="hidden" name="backTo" value="<?=$backTo;?>">
					<?php
				}
				?>
				<a target="_self" href="ipdata.php?cBedcode=<?=$arr['bedcode'];?>">&nbsp;&nbsp;&lt;&lt;&nbsp;ไปเมนู บันทึกค่าใช้จ่าย / คืนยา / จำหน่าย</a>
			</div>
		</fieldset>
	</form>
	<?php
	}else{
		?><p><strong>ไม่พบ AN <?=$cAn;?> กรุณาตรวจสอบข้อมูลอีกครั้ง <a href="drugoutside_hnward.php">คลิกที่นี่</a> เพื่อย้อนกลับ</strong></p><?php
	}
	?>
</body>

</html>