<?php
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_hypertension.php';

require "../connect.php";

$hypertension = new Hypertension();

if ($_POST['do'] === 'save') {
	
	$data['dateN'] = date("Y-m-d");
	$data['register_date'] = date("Y-m-d H:i:s");
	
	$data['joint_disease'] = 0;
	if( $_POST['joint_disease_dm'] OR $_POST['joint_disease_nephritic'] OR $_POST['joint_disease_myocardial'] OR $_POST['joint_disease_paralysis'] ){
		$data['joint_disease'] = 1;
	}

	$data['diag_date'] = $_POST['diag_date'];

	$data['bp3'] = $_POST['bp3'];
	$data['bp4'] = $_POST['bp4'];

	$data['ecgCxr'] = $_POST['ecgCxr'];
	$data['dateEcgCxr'] = $_POST['dateEcgCxr'];

	$data['albumin'] = $_POST['albumin'];
	$data['dateAlbumin'] = $_POST['dateAlbumin'];
	$data['albuminLabnumber'] = $_POST['albuminLabnumber'];

	$data['creatinine'] = $_POST['creatinine'];
	$data['dateCreatinine'] = $_POST['dateCreatinine'];
	$data['creatinineLabnumber'] = $_POST['creatinineLabnumber'];

	$data['officer'] = $_SESSION['sOfficer'];
	$data['officer_edit'] = '';

	$data['ht_no'] = $_POST["ht_no"];
	$data['thidate'] = $_POST["thaidate"];
	$data['hn'] = $_POST['hn'];
	$data['doctor'] = $_POST['doctor'];
	$data['ptname'] = $_POST['ptname'];
	$data['ptright'] = $_POST['ptright'];
	$data['sex'] = $_POST['sex'];
	$data['ht'] = $_POST['ht'];
	$data['joint_disease_dm'] = $_POST['joint_disease_dm'];
	$data['joint_disease_nephritic'] = $_POST['joint_disease_nephritic'];
	$data['joint_disease_myocardial'] = $_POST['joint_disease_myocardial'];
	$data['joint_disease_paralysis'] = $_POST['joint_disease_paralysis'];
	$data['cigarette'] = $_POST['cigarette'];
	$data['bmi'] = $_POST['bmi'];
	$data['height'] = $_POST['height'];
	$data['weight'] = $_POST['weight'];
	$data['round'] = $_POST['round'];
	$data['temperature'] = $_POST['temperature'];
	$data['pause'] = $_POST['pause'];
	$data['rate'] = $_POST['rate'];
	$data['bp1'] = $_POST['bp1'];
	$data['bp2'] = $_POST['bp2'];
	$data['pension'] = $_POST['pension'];
	$data['age_str'] = $_POST['age'];
	$data['smork'] = $_POST['cigarette'];

	$hypertension->setRowId($_POST['row_id']);
	$hypertension->setHypertension_clinic($data);
	$resUpdate = $hypertension->update();

	$hypertention_edit_id = sprintf("%s", $_POST['hypertention_edit_it']);
	$test = $hypertension->getHtHistoryThisDay($hn);
	if($test['error'] == true){
		$resHistory = $hypertension->insert_history();
	}else{
		$hypertension->setHistoryId($_POST['hypertention_edit_id']);
		$resHistory = $hypertension->update_history();
	}
	
	if ($resUpdate['error_code']!=='400') {
		$msg = 'บันทึกข้อมูลเรียบร้อยแล้ว';
	} else {
		$msg = 'ไม่สามารถบันทึกได้ '.$resUpdate['msg'];
	}
	$_SESSION['x_message'] = $msg;
	header("Location: hypertension_edit.php");
	exit;
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
						<TD class="tb_font">
							<input name="p_hn" type="text" class="forntsarabun1" id="p_hn" value="<?php echo $_REQUEST["p_hn"]; ?>" />&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" /></TD>
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

	$csql = sprintf("SELECT * FROM `hypertension_clinic` WHERE hn='%s' ",mysql_real_escape_string($hn));
	$cquery = mysql_query($csql);
	$crow = mysql_num_rows($cquery);
	if (!$crow) {
		
		?>
		<p><font class='forntsarabun1'>ไม่พบข้อมูล <?=$hn;?> ในระบบ Hypertension<br> คลิก<a href="hypertension.php?hn=<?=$hn;?>">ที่นี่</a>เพื่อทำการลงทะเบียน</font></p>
		<?php
	} else {

		$arr_opd = mysql_fetch_array($cquery);

		$diag_date = $arr_opd['diag_date'];

		$sqlht = sprintf("select *,concat(yot,name,' ',surname)as ptname from opcard where hn='%s' ",mysql_real_escape_string($hn));
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

		$sql = "SELECT `id` FROM `hypertension_history` WHERE `thidate` = '$datenow' AND `hn` = '$hn' ";
		$q = mysql_query($sql);
		$htEdit = mysql_fetch_assoc($q);
		$hypertention_edit_id = $htEdit['id'];
		
		$do = 'save';
		$urlCallBack = 'hypertension_edit.php';
		require_once 'hypertension_form.php';
	}
} //ปิด ค้นหา hn ใน opcard	$_REQUEST["p_hn"]
// include("../unconnect.inc");

include 'footer.php';
?>