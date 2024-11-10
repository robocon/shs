<?php
session_start();

error_reporting(1);
ini_set('display_errors', 1);

require "../connect.php";
require "../includes/functions.php";

if ($_POST['do'] === 'save') {

	$dateN = date("Y-m-d");
	//$register=date("Y-m-d H:i:s");

	$diag_date = $_POST['diag_date'];

	$bp3 = $_POST['bp3'];
	$bp4 = $_POST['bp4'];

	$ecgCxr = $_POST['ecgCxr'];
	$dateEcgCxr = $_POST['dateEcgCxr'];

	$albumin = $_POST['albumin'];
	$dateAlbumin = $_POST['dateAlbumin'];
	$albuminLabnumber = $_POST['albuminLabnumber'];

	$creatinine = $_POST['creatinine'];
	$dateCreatinine = $_POST['dateCreatinine'];
	$creatinineLabnumber = $_POST['creatinineLabnumber'];

	/*$strSQL="INSERT INTO `hypertension_clinic` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , `ptname` , `ptright` , `sex` , `ht` , `joint_disease_dm` , `joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , `smork` , `bmi` , `height` , `weight` , `round` , `temperature` , `pause` , `rate` , `bp1` , `bp2` , `officer` , `register_date` )
	   VALUES ('".$_POST["ht_no"]."','".$_POST["thaidate"]."', '".$dateN."', '".$_POST['hn']."', '".$_POST['doctor']."', '".$_POST['ptname']."', '".$_POST['ptright']."', '".$_POST['sex']."', '".$_POST['ht']."', '".$_POST['joint_disease_dm']."', '".$_POST['joint_disease_nephritic']."', '".$_POST['joint_disease_myocardial']."', '".$_POST['joint_disease_paralysis']."', '".$_POST['cigarette']."', '".$_POST['bmi']."', '".$_POST['height']."','".$_POST['weight']."', '".$_POST['round']."', '".$_POST['temperature']."', '".$_POST['pause']."', '".$_POST['rate']."', '".$_POST['bp1']."', '".$_POST['bp2']."', '".$sOfficer."', '".$register."');";
	   $objQuery = mysql_query($strSQL);*/
	$strSQL = "UPDATE `hypertension_clinic` SET `thidate` = '" . $_POST["thaidate"] . "',
	`doctor` = '" . $_POST["doctor"] . "',
	`ptname` = '" . $_POST["ptname"] . "',
	`ptright` = '" . $_POST["ptright"] . "',
	`sex` = '" . $_POST["sex"] . "',
	`ht` = '" . $_POST["ht"] . "',
	`joint_disease_dm` = '" . $_POST["joint_disease_dm"] . "',
	`joint_disease_nephritic` = '" . $_POST["joint_disease_nephritic"] . "',
	`joint_disease_myocardial` = '" . $_POST["joint_disease_myocardial"] . "',
	`joint_disease_paralysis` = '" . $_POST["joint_disease_paralysis"] . "',
	`smork` = '" . $_POST["cigarette"] . "',
	`bmi` = '" . $_POST["bmi"] . "',
	`height` = '" . $_POST["height"] . "',
	`weight` = '" . $_POST["weight"] . "',
	`round` = '" . $_POST["round"] . "',
	`temperature` = '" . $_POST["temperature"] . "',
	`pause` = '" . $_POST["pause"] . "',
	`rate` = '" . $_POST["rate"] . "',
	`bp1` = '" . $_POST["bp1"] . "',
	`bp2` = '" . $_POST["bp2"] . "',
	`officer_edit` = '" . $sOfficer . "',
	`diag_date` = '$diag_date', 
	`bp3` = '$bp3', 
	`bp4` = '$bp4',
	`ecgCxr`, = '$ecgCxr',
	`dateEcgCxr`, = '$dateEcgCxr',
	`albumin`, = '$albumin',
	`dateAlbumin`, = '$dateAlbumin',
	`albuminLabnumber`, = '$albuminLabnumber',
	`creatinine`, = '$creatinine',
	`dateCreatinine`, = '$dateCreatinine',
	`creatinineLabnumber`, = '$creatinineLabnumber' 
	WHERE `row_id` = '" . $_POST["row_id"] . "' ";


	// $logs = $strSQL."\r\n";
	// $logs .= "---------------------------\r\n\r\n";
	// file_put_contents('../logs/hypertention-edit.log', $logs, FILE_APPEND);

	$objQuery = mysql_query($strSQL) or die(mysql_error($Conn));

	// เพิ่มเข้าไปใน ประวัติผู้ป่วย
	$register = date("Y-m-d H:i:s");
	$pension = isset($_POST['pension']) ? $_POST['pension'] : '';

	$strSQL = "INSERT INTO `hypertension_history` ( `ht_no` , `thidate` , `dateN` , `hn` , `doctor` , 
	`ptname` , `ptright` , `sex` , `ht` , `joint_disease_dm` , 
	`joint_disease_nephritic` , `joint_disease_myocardial` , `joint_disease_paralysis` , 
	`smork` , `bmi` , `height` , `weight` , `round` , 
	`temperature` , `pause` , `rate` , `bp1` , `bp2` , 
	`officer` , `register_date`,pension,`age_str`,`diag_date`,`bp3`,`bp4` )
	VALUES ('" . $_POST["ht_no"] . "','" . $_POST["thaidate"] . "', '" . $dateN . "', '" . $_POST['hn'] . "', '" . $_POST['doctor'] . "', 
	'" . $_POST['ptname'] . "', '" . $_POST['ptright'] . "', '" . $_POST['sex'] . "', '" . $_POST['ht'] . "', '" . $_POST['joint_disease_dm'] . "', 
	'" . $_POST['joint_disease_nephritic'] . "', '" . $_POST['joint_disease_myocardial'] . "', '" . $_POST['joint_disease_paralysis'] . "', 
	'" . $_POST['cigarette'] . "', '" . $_POST['bmi'] . "', '" . $_POST['height'] . "','" . $_POST['weight'] . "', '" . $_POST['round'] . "', 
	'" . $_POST['temperature'] . "', '" . $_POST['pause'] . "', '" . $_POST['rate'] . "', '" . $_POST['bp1'] . "', '" . $_POST['bp2'] . "', 
	'" . $sOfficer . "', '" . $register . "','" . $pension . "','" . $_POST['age'] . "','$diag_date','$bp3','$bp4');";

	// $logs = $strSQL."\r\n";
	// $logs .= "---------------------------\r\n\r\n";
	// file_put_contents('../logs/hypertention-edit.log', $logs, FILE_APPEND);


	$objQuery = mysql_query($strSQL) or die(mysql_error($Conn));

	if ($objQuery) {
		echo "<br><font class='forntsarabun1'>บันทึกข้อมูลเรียบร้อยแล้ว</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension_edit.php'>";
	} else {
		echo "<br><font class='forntsarabun1'>ไม่สามารถบันทึกได้ [" . $strSQL . "]</font>";
		print "<META HTTP-EQUIV='Refresh' CONTENT='2;URL=hypertension_edit.php'>";
	}

	// include("../unconnect.inc");	 
	//  }
}

$web_title = 'หน้าอัพเดทข้อมูล Hypertension';
require "header.php";

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
	#landingDateSelected{
		z-index:1;
	}
	#landingDateAlbumin{
		z-index:2;
	}
	#landingDateCreatinine{
		z-index:3;
	}
</style>


<h1 class="forntsarabun1">แก้ไขข้อมูล Hypertension</h1>


<form action="hypertension_edit.php" method="post">
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE">
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข HN</TD>
					</TR>
					<TR>
						<TD class="tb_font"><input name="p_hn" type="text" class="forntsarabun1" id="p_hn"
								value="<?php echo $_POST["p_hn"]; ?>" />&nbsp;<input name="Submit" type="submit"
								class="forntsarabun1" value="ตกลง" /></TD>
					</TR>
					<TR>
						<TD></TD>
					</TR>
				</TABLE>
			</TD>
		</TR>
	</TABLE>
</form>
<?php 
if($_SESSION['x_message']){
	?>
	<div style="border: 2px solid #a5a500; background-color: #ffffc5; margin: 8px 8px 0 8px; padding: 4px; text-align: center; font-weight: bold;"><?=$_SESSION['x_message'];?></div>
	<?php
    $_SESSION['x_message']=null;
    unset($_SESSION['x_message']);
}

$hn = trim($_POST["p_hn"]);
if (!empty($_POST["p_hn"]) != "") {

	$csql = "SELECT * FROM `hypertension_clinic` WHERE hn='$hn' ";
	$cquery = mysql_query($csql);
	$crow = mysql_num_rows($cquery);
	if (!$crow) {
		
		?>
		<p><font class='forntsarabun1'>ไม่พบข้อมูล <?=$hn;?> ในระบบ Hypertension<br> คลิก<a href="hypertension.php?hn=<?=$hn;?>">ที่นี่</a>เพื่อทำการลงทะเบียน</font></p>
		<?php
	} else {

		$arr_opd = mysql_fetch_array($cquery);

		$diag_date = $arr_opd['diag_date'];

		$sqlht = "select *,concat(yot,name,' ',surname)as ptname from opcard where hn='$hn' ";
		$queryht = mysql_query($sqlht);
		$row = mysql_num_rows($queryht);
		$arr_view = mysql_fetch_assoc($queryht);

		$arr_view["age"] = calcage($arr_view["dbirth"]);

		$height = $arr_opd["height"];
		$weight = $arr_opd["weight"];

		$cigarette = $arr_opd["smork"];
		////////////////////////////////////////
		$ht_no = $arr_opd['ht_no'];
		$datenow = date("Y-m-d");
		
		$do = 'save';
		$urlCallBack = 'hypertension_edit.php';
		require_once 'hypertension_form.php';
	}
} //ปิด ค้นหา hn ใน opcard	$_REQUEST["p_hn"]
// include("../unconnect.inc");

include 'footer.php';
?>