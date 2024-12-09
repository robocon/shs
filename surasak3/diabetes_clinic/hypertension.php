<?php
require_once dirname(__FILE__).'/../bootstrap.php';
require_once dirname(__FILE__).'/../class_file/class_drugreact.php';
require_once dirname(__FILE__).'/../class_file/class_hypertension.php';

require "../connect.php";

$hypertension = new Hypertension();

if(empty($_SESSION['sIdname'])){
	?>
	<p>Sessionหมดอายุ กรุณาLoginอีกครั้ง</p>
	<p><a href="../../nindex.htm">เข้าสู่ระบบ</a></p>
	<?php
	exit;
}

function calcage($birth){

	$today=getdate();   
	$nY=$today['year']; 
	$nM=$today['mon'] ;
	$bY=substr($birth,0,4)-543;
	$bM=substr($birth,5,2);
	$ageY=$nY-$bY;
	$ageM=$nM-$bM;

	if ($ageM<0) {
		$ageY=$ageY-1;
		$ageM=12+$ageM;
	}

	if ($ageM==0){
		$pAge="$ageY ปี";
	}else{
		$pAge="$ageY ปี $ageM เดือน";
	}

	return $pAge;
}

if($_REQUEST['do']=='save'){
	
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
	$data['thidate'] = date('Y-m-d');
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
	
	$hypertension->setHypertension_clinic($data);
	$res = $hypertension->insert();

	$hypertension->insert_history();
	
	if($res['error_code']!=='400')
	{
		$msg = "บันทึกข้อมูลเรียบร้อยแล้ว";
	}
	else
	{
		$msg = "ไม่สามารถบันทึกได้ ".$res['msg'];
	}
	$_SESSION['x_message'] = $msg;
	header("Location: hypertension.php");
	
	exit;
}

$action = sprintf("%s", $_GET['action']);
if($action==='loadDate'){
	$hn = sprintf("%s", $_GET['hn']);

	$thaiYear = (date('Y')+543);
	$sql = sprintf("SELECT a.`row_id`,a.`date`,a.`hn`,a.`ptname`,a.`code`,b.`tvn`
	FROM `patdata` AS a 
	LEFT JOIN `depart` AS b ON a.`idno` = b.`row_id` 
	WHERE ( a.`date` LIKE '$thaiYear%%' AND a.`hn` = '%s' ) 
	AND ( a.`code` LIKE '41001%%' OR a.`code` LIKE '%%EKG%%') 
	GROUP BY a.`hn`",
	mysql_escape_string($hn));

	$q = mysql_query($sql);
	if(mysql_num_rows($q) > 0){
		?>
		<style>
			#loadDateTable td{
				padding-right:6px;
			}
		</style>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateSelected')">[ ปิด ]</a>
		</div>
		<table id="loadDateTable">
			<tr>
				<th>วันที่</th>
				<th>VN</th>
				<th>HN</th>
				<th>Code</th>
			</tr>
		<?php
		while ($a = mysql_fetch_assoc($q)) {
			?>
			<tr>
				<td><a href="javascript:void(0);" onclick="document.getElementById('dateEcgCxr').value='<?=substr($a['date'],0,10);?>';closeContainer('landingDateSelected');"><?=$a['date'];?></a></td>
				<td><?=$a['tvn'];?></td>
				<td><?=$a['hn'];?></td>
				<td><?=$a['code'];?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}else{
		?>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateSelected')">[ ปิด ]</a>
		</div>
		<p>ไม่พบข้อมูล</p>
		<?php
	}
	exit;
}elseif ($action==='loadDateAlbumin') {
	$hn = sprintf("%s", $_GET['hn']);
	$year = date('Y');

	$sql = sprintf("SELECT b.`autonumber`,CONCAT((SUBSTRING(b.`orderdate`,1,4)+543),SUBSTRING(b.`orderdate`,5,6)) AS `orderdate`,b.`hn`,b.`patientname`,b.`profilecode`,b.`autonumber` 
	FROM (
		SELECT MAX(`autonumber`) AS `latest_autonumber` 
		FROM `resulthead` 
		WHERE `orderdate` LIKE '$year%%' 
		AND `hn` = '%s'
		AND `profilecode` IN ('ALB','UMALB') 
		GROUP BY `hn`
	) AS a 
	LEFT JOIN `resulthead` AS b ON b.auto`number = a.`latest_autonumber`
	ORDER BY b.`autonumber` ASC",
	mysql_escape_string($hn));
	$q = mysql_query($sql);
	if(mysql_num_rows($q) > 0){
		?>
		<style>
			#loadDateTable td{
				padding-right:6px;
			}
		</style>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateAlbumin')">[ ปิด ]</a>
		</div>
		<table id="loadDateTable">
			<tr>
				<th>วันที่</th>
				<th>HN</th>
				<th>ชื่อสกุล</th>
				<th>Profilecode</th>
			</tr>
		<?php
		while ($a = mysql_fetch_assoc($q)) {
			?>
			<tr>
				<td><a href="javascript:void(0);" onclick="document.getElementById('dateAlbumin').value='<?=substr($a['orderdate'],0,10);?>';document.getElementById('albuminLabnumber').value = '<?=$a['autonumber'];?>';closeContainer('landingDateAlbumin');"><?=$a['orderdate'];?></a></td>
				<td><?=$a['hn'];?></td>
				<td><?=$a['patientname'];?></td>
				<td><?=$a['profilecode'];?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}else{
		?>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateAlbumin')">[ ปิด ]</a>
		</div>
		<p>ไม่พบข้อมูล</p>
		<?php
	}
	exit;
}elseif ($action==='loadDateCreatinine') {


	$hn = sprintf("%s", $_GET['hn']);
	$year = date('Y');

	$sql = sprintf("SELECT b.autonumber,CONCAT((SUBSTRING(b.`orderdate`,1,4)+543),SUBSTRING(b.`orderdate`,5,6)) AS `orderdate`,b.hn,b.patientname,b.profilecode,b.autonumber 
	FROM (
		SELECT MAX(autonumber) AS latest_autonumber 
		FROM resulthead 
		WHERE orderdate LIKE '$year%%' 
		AND hn = '%s'
		AND profilecode IN ('CREAG') 
		GROUP BY hn
	) AS a 
	LEFT JOIN resulthead AS b ON b.autonumber = a.latest_autonumber
	ORDER BY b.autonumber ASC",
	mysql_escape_string($hn));
	$q = mysql_query($sql);
	if(mysql_num_rows($q) > 0){
		?>
		<style>
			#loadDateTable td{
				padding-right:6px;
			}
		</style>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateCreatinine')">[ ปิด ]</a>
		</div>
		<table id="loadDateTable">
			<tr>
				<th>วันที่</th>
				<th>HN</th>
				<th>ชื่อสกุล</th>
				<th>Profilecode</th>
			</tr>
		<?php
		while ($a = mysql_fetch_assoc($q)) {
			?>
			<tr>
				<td><a href="javascript:void(0);" onclick="document.getElementById('dateCreatinine').value='<?=substr($a['orderdate'],0,10);?>';document.getElementById('creatinineLabnumber').value = '<?=$a['autonumber'];?>';closeContainer('landingDateCreatinine');"><?=$a['orderdate'];?></a></td>
				<td><?=$a['hn'];?></td>
				<td><?=$a['patientname'];?></td>
				<td><?=$a['profilecode'];?></td>
			</tr>
			<?php
		}
		?>
		</table>
		<?php
	}else{
		?>
		<div style="display: inline-block;width: 100%;background-color: #b8b8b8;text-align: center;">
			<a href="javascript:void(0);" style="color:#000000; text-decoration:none;" onclick="closeContainer('landingDateCreatinine')">[ ปิด ]</a>
		</div>
		<p>ไม่พบข้อมูล</p>
		<?php
	}
	exit;
}

$web_title = 'หน้าลงทะเบียนผู้ป่วย Hypertension';
require "header.php";
?>
<style>
	.font_title{
		font-family:"TH SarabunPSK"; 
		font-size:25px;
	}
	.tb_font{
		font-family:"TH SarabunPSK";
		font-size:24px;
		color: #09F;
	}
	.tb_font_1{
		font-family:"TH SarabunPSK"; 
		font-size:24px; 
		color:#FFFFFF;
		font-weight:bold;
	}
	.tb_col{
		font-family:"TH SarabunPSK"; 
		font-size:24px;
		background-color:#9FFF9F;
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

<h1 class="forntsarabun1">ลงทะเบียนผู้ป่วย Hypertension</h1>

<form action="" method="post">
	<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
		<TR>
			<TD>
				<TABLE border="0" cellpadding="0" cellspacing="0">
					<TR>
						<TD align="center" bgcolor="#0000CC" class="forntsarabun">กรอกหมายเลข HN</TD>
					</TR>
					<TR>
						<TD class="tb_font"><input name="p_hn" type="text" class="forntsarabun1" id="p_hn"  value="<?php echo $_POST["p_hn"];?>"/>&nbsp;<input name="Submit" type="submit" class="forntsarabun1" value="ตกลง" /></TD>
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

$hn=trim($_POST["p_hn"]);
if(!empty($_POST["p_hn"]) != ""){
	
	$sqlht=sprintf("SELECT *,CONCAT(`yot`,`name`,' ',`surname`) AS `ptname` FROM `opcard` WHERE `hn`='%s' ", mysql_real_escape_string($hn));
	$queryht=mysql_query($sqlht);
	$row=mysql_num_rows($queryht);
	
	if(!$row){
	
		print "<br> <font class='forntsarabun1'>ไม่พบ  HN  <b>$hn</b>  ในระบบทะเบียน </font>";
	
	}else{

		$select=sprintf("select hn from hypertension_clinic WHERE  hn ='%s' ", mysql_real_escape_string($hn));
		$q=mysql_query($select)or die (mysql_error());
		$rows=mysql_num_rows($q);

		if($rows){
			?>
			<p><font class='forntsarabun1'> HN  <?=$hn;?> ได้ลงทะเบียนแล้ว </font></p>
			<p><font class='forntsarabun1'> คลิก <a href='hypertension_edit.php?p_hn=<?=$hn;?>'>แก้ไข</a> เพื่อดำเนินการต่อไป</font></p>
			<?php
			
		}else{
	
			$arr_view = mysql_fetch_assoc($queryht);
			$y=date("Y")+543;
			$d=date("d");
			$m=date("m");
			$date1=$y.'-'.$m.'-'.$d;
			
			$opd = "Select * From  opd where  hn='".$arr_view["hn"]."' ORDER BY `thidate` DESC limit 0,1 ";
			$result_opd = mysql_query($opd);
			$arr_opd = mysql_fetch_array($result_opd);
			$arr_view["age"] = calcage($arr_view["dbirth"]);
	
			$height = $arr_opd["height"];
			$weight = $arr_opd["weight"];
			
			$cigarette=$arr_opd["cigarette"];
			////////////////////////////////////////
	 
			$sqlht="select max(ht_no)as htnumber from hypertension_clinic";
			$queryht=mysql_query($sqlht);
			$arrht=mysql_fetch_array($queryht);
			$ht=$arrht['htnumber']+1;
			$ht_no=$ht;

			$urlCallBack = 'hypertension.php';
			$do = 'save';
			require_once 'hypertension_form.php';

		}
	} //ปิด ค้นหา hn ใน opcard
}

require "footer.php";
?>