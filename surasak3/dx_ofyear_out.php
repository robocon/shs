<?php
// session_start();
// include("connect.php");
// mysql_query("SET NAMES UTF8");

require_once 'bootstrap.php';
$Conn = mysql_connect(HOST,USER,PASS);
mysql_select_db(DB);
mysql_query("SET NAMES UTF8");

$dbi = new mysqli(HOST,USER,PASS,DB);
$dbi->query("SET NAMES UTF8");

if(empty($_SESSION["sOfficer"])){
	echo "Sessionหมดอายุ กรุณาloginใหม่อีกครั้ง <a href='../nindex.htm'>คลิกที่นี่เพื่อ Login</a>";
	exit;
}

$smenucode = sprintf("%s", $_SESSION['smenucode']);

$action = sprintf("%s", $_GET['action']);
if($action==='findvn'){
	$date = sprintf("%s", $_GET['date']);
	list($y,$m,$d) = explode('-', $date);
	
	$hn = sprintf("%s", $_GET['hn']);
	$thdateHn = "$d-$m-".($y+543).$hn;
	$sql = "SELECT vn FROM opday WHERE thdatehn = '$thdateHn' LIMIT 1 ";
	
	$q = mysql_query($sql);
	if(mysql_num_rows($q)>0){
		$a = mysql_fetch_assoc($q);
		$res = '{"status":200,"vn":"'.$a['vn'].'"}';
	}else{
		$res = '{"status":400,"message":"ไม่พบการลงทะเบียน"}';
	}
	echo $res;
	exit;
}

$date_now = date("Y-m-d H:i:s");

function calcage($birth){

	$today = getdate();   
	$nY  = $today['year']; 
	$nM = $today['mon'] ;
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

$thaidate = (date("Y")+543).date("-m-d");


$list_ua["COLOR"] =  "ua_color"; 
$list_ua["APPEAR"] =  "ua_appear"; 
$list_ua["SPGR"] =  "ua_spgr"; 
$list_ua["PHU"] =  "ua_phu"; 
$list_ua["BLOODU"] =  "ua_bloodu"; 
$list_ua["PROU"] =  "ua_prou"; 
$list_ua["GLUU"] =  "ua_gluu"; 
$list_ua["KETU"] =  "ua_ketu"; 
$list_ua["UROBIL"] =  "ua_urobil"; 
$list_ua["BILI"] =  "ua_bili"; 
$list_ua["NITRIT"] =  "ua_nitrit"; 
$list_ua["WBCU"] =  "ua_wbcu"; 
$list_ua["RBCU"] =  "ua_rbcu"; 
$list_ua["EPIU"] =  "ua_epiu"; 
$list_ua["BACTU"] =  "ua_bactu"; 
$list_ua["YEAST"] =  "ua_yeast"; 
$list_ua["MUCOSU"] =  "ua_mucosu"; 
$list_ua["AMOPU"] =  "ua_amopu";
$list_ua["CASTU"] =  "ua_castu"; 
$list_ua["CRYSTU"] =  "ua_crystu"; 
$list_ua["OTHERU"] =  "ua_otheru"; 

$list_cbc["WBC"] =  "cbc_wbc"; 
$list_cbc["RBC"] =  "cbc_rbc"; 
$list_cbc["HB"] =  "cbc_hb"; 
$list_cbc["HCT"] =  "cbc_hct"; 
$list_cbc["MCV"] =  "cbc_mcv";
$list_cbc["MCH"] =  "cbc_mch";
$list_cbc["MCHC"] =  "cbc_mchc";
$list_cbc["PLTC"] =  "cbc_pltc";
$list_cbc["PLTS"] =  "cbc_plts";
$list_cbc["NEU"] =  "cbc_neu";
$list_cbc["LYMP"] =  "cbc_lymp";
$list_cbc["MONO"] =  "cbc_mono";
$list_cbc["EOS"] =  "cbc_eos";
$list_cbc["BASO"] =  "cbc_baso";
$list_cbc["BAND"] =  "cbc_band";
$list_cbc["ATYP"] =  "cbc_atyp";
$list_cbc["NRBC"] =  "cbc_nrbc";
$list_cbc["RBCMOR"] =  "cbc_rbcmor";
$list_cbc["OTHER"] =  "cbc_other";

// รายการแลปอื่นๆที่ให้แสดงผลได้
$list_lab["TRIG"] = "tg";
$list_lab["GLU"] = "bs";
$list_lab["CHOL"] = "chol";
$list_lab["AST"] = "sgot";
$list_lab["ALT"] = "sgpt";
$list_lab["ALP"] = "alk";
$list_lab["BUN"] = "bun";
$list_lab["CREA"] = "cr";
$list_lab["URIC"] = "uric";

$list_lab["HDL"] = "hdl";
$list_lab["LDL"] = "ldl";
$list_lab["10001"] = "10001";//ldlc
$list_lab["MALARI"] = "malari";
$list_lab["METAMP"] = "metamp";
$list_lab["HBSAG"] = "hbsag";
$list_lab["HCVAB"] = "hcvab";
$list_lab["HIV"] = "hiv";
$list_lab["VDRL"] = "vdrl";

$list_lab["GROUPT"] = "groupt";
$list_lab["RH"] = "rh";
$list_lab["UPT"] = "upt";
$list_lab["STOCC"] = "stocc";
$list_lab["OCCULT"] = "OCCULT";
$list_lab["PARASI"] = "parasi";

$list_lab["1427"] = "uric";
$list_lab["ANTIHB"] = "ANTIHB";
$list_lab["HBA1CC"] = "HBA1C";
$list_lab["CEA"] = "CEA";
$list_lab["PSA"] = "PSA";
$list_lab["AFP"] = "AFP";

// profilecode = LFT
$list_lab["TP"] = "TP";
$list_lab["ALB"] = "ALB";
$list_lab["TB"] = "TB";
$list_lab["DB"] = "DB";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<title>โปรแกรมซักประวัติตรวจสุขภาพ</title>
<style>
	body{
		font-family:"TH SarabunPSK";
		font-size: 18px;
	}
	.font_title{font-size:28px}
	.tb_font{font-size:20px;}
	.tb_font_1{font-size:20px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-size:20px; background-color:#9FFF9F}
	.tb_font_2 {color: #B00000;font-weight: bold;}
	.style5 {color: #000099; font-weight: bold; }
	.pdxhead {font-size: 24px;}
	label:hover{cursor: pointer;}
	.button {
		background-color: #04AA6D; /* Green */
		border: none;
		color: white;
		padding: 8px 15px;
		text-align: center;
		text-decoration: none;
		display: inline-block;
		border-radius: 12px;
	}
	.checkupField tr td{
		padding-bottom: 4px;
	}
	.checkupField input[type="text"]{
		line-height: 20px;
	}
	legend{
		font-weight: bold;
		font-size: 24px;
		margin-left: 20px;
	}
</style>
	<script src="sweetalert/sweetalert2@11.js"></script>
</head>

<body>
<a href ="../nindex.htm" class="button">&lt;&lt; เมนู</a> <a href="upd_labstatus.php" target="_blank" class="button">ปรับสถานะ LAB เป็นตรวจสุขภาพ</a> <a href="Edx_ofyear_out.php" class="button">โปรแกรมซักประวัติตรวจสุขภาพ (ขอใบรับรองแพทย์อิเล็กทรอนิกส์)</a>
<div>
	<h1 style="text-align:center;">โปรแกรมซักประวัติตรวจสุขภาพประจำปี (Walk in) && ฮักกันยามเฒ่า62</h1>
</div>

<form action="dx_ofyear_out.php" method="post">
	<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
		<tr>
			<td>
				<table border="0" cellpadding="0" cellspacing="0">
					<tr>
						<td align="center" bgcolor="#0000CC" class="tb_font_1">กรอกหมายเลข HN</td>
					</tr>
					<tr>
						<td class="tb_font">
							<input type="text" name="p_hn"  value="<?=$_POST["p_hn"]?>"/>&nbsp;
							<input type="submit" name="Submit" value="ค้นหา" />
							<input name="post_vn" type="hidden" value="1" />
						</td>
					</tr>
				</table>
			</td>
		</tr>
	</table>
</form>
<?php 
if(!empty($_POST["post_vn"]) && $_POST["p_hn"] != ""){

	$p_hn = sprintf("%s", $_POST["p_hn"]);
	$thdateHn = date('d-m-').(date('Y')+543).$p_hn;

	//ค้นหา hn จาก opcard, opday ****************************************************************************************
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '$p_hn' limit 0,1";
	$result = mysql_query($sql) or die("<!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	if(mysql_num_rows($result)===0){
		echo "ไม่พบ HN กรุณาตรวจสอบข้อมูลอีกครั้ง";
		exit;
	}
	$arr_view = mysql_fetch_assoc($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);
	
	$sql = "Select vn,ptright,toborow From opday where thdatehn = '$thdateHn' limit 1";
	list($arr_view["vn"],$ptright,$toborow) = mysql_fetch_row(mysql_query($sql));

	// $date_hn = date("Y-m-d").$arr_view["hn"];
	// $date_vn = date("Y-m-d").$arr_view["vn"];
	
	// ดึงข้อมูลล่าสุดมาแสดงผล
	$sql3 = "Select * From dxofyear_out where hn = '$p_hn' ORDER BY row_id DESC LIMIT 0,1 "; //and thidate like '".date("Y-m-d")."%'
	$result3 = Mysql_Query($sql3);
	if(mysql_num_rows($result3) > 0){
		$arr_dxofyear = mysql_fetch_assoc($result3);
		$congenital_disease = $arr_dxofyear["congenital_disease"];
		$height = $arr_dxofyear["height"];
		$weight = $arr_dxofyear["weight"];
		$temperature = $arr_dxofyear["temperature"];
		$pause = $arr_dxofyear["pause"];
		$rate = $arr_dxofyear["rate"];
		
		$ht  =  $height/100;
		$bmi = number_format($weight /($ht*$ht),2);
		 
		$bp1 = $arr_dxofyear["bp1"];
		$bp2 = $arr_dxofyear["bp2"];
		$bp21 = $arr_dxofyear["bp21"];
		$bp22 = $arr_dxofyear["bp22"];
		$cigarette = $arr_dxofyear["cigarette"];
		$alcohol = $arr_dxofyear["alcohol"];
		$exercise = $arr_dxofyear["exercise"];
		$type = $arr_dxofyear["type"];
		$doctor = $arr_dxofyear["doctor"];
		$camp = $arr_dxofyear['camp'];
		$dental_exam = $arr_dxofyear['dental_exam'];
		$color_blind = $arr_dxofyear['color_blind'];
		$audiogram = $arr_dxofyear['audiogram'];
		$ekg = $arr_dxofyear['ekg'];
		$waist = $arr_dxofyear['round_'];
		
	}else{ // ถ้าไม่มีข้อมูลใน dxofyear_out ค่อยมาใช้ข้อมูลจากใน opd แทน

		$sql3 = "Select congenital_disease,temperature,pause,rate,weight,height,bp1,bp2,waist,cigarette,alcohol,exercise,doctor From opd where hn = '$p_hn' AND type <> 'ญาติ' ORDER BY row_id DESC LIMIT 1 "; //and thidate like '$thaidate%'
		$result3 = Mysql_Query($sql3);
		$cou = mysql_num_rows($result3);
		list($congenital_disease,$temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$waist, $cigarette, $alcohol, $exercise, $doctor) = Mysql_fetch_row($result3);

	}

	if($congenital_disease == ''){ 
		$congenital_disease = "ปฎิเสธโรคประจำตัว";
	}

	////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 'y_chekup'";
	$result = mysql_query($query) or die("Query failed");
	
	for ($i = mysql_num_rows($result) - 1; $i >= 0; $i--) {
		if (!mysql_data_seek($result, $i)) {
			echo "Cannot seek to row $i\n";
			continue;
		}
			if(!($row = mysql_fetch_object($result)))
			continue;
	}
	
	$nPrefix=$row->prefix;
	////*runno ตรวจสุขภาพ*/////////

	//ค้นหาผลการตรวจทางพยาธิ ****************************************************************************************
	// หาวันที่ตรวจ
	$sql = "Select date_format(a.orderdate,'%d/%m/%Y'),date_format(a.orderdate,'%Y-%m-%d') 
	From resulthead as a 
	where a.hn='$p_hn'  
	AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix')  
	Order by a.autonumber DESC limit 0,1";
	list($lab_date,$labin_date) = mysql_fetch_row(mysql_query($sql));

	$result_ua = array();
	$result_cbc = array();
	$result_lab = array();
	
	$lab_alert = 'ไม่มีผลแลปตรวจสุขภาพประจำปี กรุณาตรวจสอบสถานะแลปอีกครั้ง';
	if(!empty($lab_date)){ 

		$lab_alert = '';
		// หาผลที่ตรวจ UA
		$sql = "Select b.labcode, b.result, b.unit,b.normalrange,b.flag  
		From ( 
			SELECT MAX(`autonumber`) AS `autonumber` 
			FROM `resulthead` 
			WHERE `hn` = '$p_hn' 
			AND `profilecode` = 'UA' 
			AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$nPrefix' 
		) as a , 
		resultdetail as b  
		where a.autonumber = b.autonumber 
		AND b.parentcode = 'UA' 
		Order by b.seq ASC ";
		$result_ua = mysql_query($sql);

		// หาผลที่ตรวจ CBC
		$sql = "Select b.labcode, b.result, b.unit,b.normalrange,b.flag 
		From ( 
			SELECT MAX(`autonumber`) AS `autonumber` 
			FROM `resulthead` 
			WHERE `hn` = '$p_hn' 
			AND `profilecode` = 'CBC' 
			AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$nPrefix' 
		) as a , 
		resultdetail as b  
		where a.autonumber = b.autonumber 
		AND b.parentcode = 'CBC' 
		Order by b.seq ASC";
		$result_cbc = mysql_query($sql);
		
		// หาผลที่ตรวจ อื่นๆที่ไม่ใช่ UA CBC
		$sql = "Select b.labcode, b.result, b.unit,b.normalrange,b.flag 
		From ( 
			SELECT MAX(`autonumber`) AS `autonumber` 
			FROM `resulthead` 
			WHERE `hn` = '$p_hn' 
			AND ( `profilecode` <> 'UA' AND `profilecode` <> 'CBC' )
			AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$nPrefix' 
			GROUP BY `profilecode`
		) as a , 
		resultdetail as b  
		where a.autonumber = b.autonumber 
		AND b.parentcode <> 'UA' 
		AND b.parentcode <> 'CBC' 
		Order by a.autonumber ASC ";
		$result_lab = mysql_query($sql);
	}
	
$choose = array();

array_push($choose,"ตรวจตามนัด");
array_push($choose,"มาก่อนนัด");
array_push($choose,"มาหลังนัด");
array_push($choose,"อาการทั่วไปปกติ");
array_push($choose,"รับยาเดิม");
array_push($choose,"..........วัน");
array_push($choose,"ไข้");
array_push($choose,"ไอ");
array_push($choose,"เจ็บคอ");
array_push($choose,"มีเสมหะ");
array_push($choose,"มีน้ำมูก");
array_push($choose,"ปวดศีรษะ");
array_push($choose,"เวียนศีรษะ");
array_push($choose,"บ้านหมุน");
array_push($choose,"คลื่นไส้");
array_push($choose,"อาเจียน");
array_push($choose,"ใจสั่น");
array_push($choose,"อ่อนเพลีย");
array_push($choose,"เบื่ออาหาร");
array_push($choose,"หายใจเหนื่อยหอบ");
array_push($choose,"จุกแน่นท้อง");
array_push($choose,"เจ็บหน้าอก");
array_push($choose,"หน้ามืด ตาลาย");
array_push($choose,"ปวดท้อง");
array_push($choose,"อืดท้อง");
array_push($choose,"ถ่านอุจจาระเหลว");
array_push($choose,"ท้องผูก");
array_push($choose,"ปัสสาวะแสบขัด");
array_push($choose,"ปวดหลัง");
array_push($choose,"ปวดเอว");
array_push($choose,"ปวดแขน");
array_push($choose,"ปวดขา");
array_push($choose,"ปวดน่อง");
array_push($choose,"ปวดไหล่");
array_push($choose,"ปวดสะโพก");
array_push($choose,"แผลที่.......");
array_push($choose,"ก้อนที่........");
array_push($choose,"ตรวจสุขภาพ");
array_push($choose,"ขอใบรับรองแพทย์");
array_push($choose,"ปรึกษาแพทย์");
array_push($choose,"ปวดเมื่อยตามตัว");
array_push($choose,"ครั่นเนื้อครั่นตัว");
array_push($choose,"ผื่นคัน");
array_push($choose,"ผู้ป่วยไม่มา ญาติชื่อ..ID..");
array_push($choose,"ขอรับวัคซีนนัดฉีดโรคพิษสุนัขบ้า เข็มที่");
array_push($choose,"ขอรับวัคซีนนัดฉีดบาดทะยัก เข็มที่");
array_push($choose,"ขอรับวัคซีนนัดฉีดไวรัสตับอักเสบบี เข็มที่");
array_push($choose,"ขอสำเนาประวัติรักษา");
sort($choose);
$sql = "Select distinct organ From opd where hn = '".$arr_view["hn"]."' AND organ <> '' Order by row_id DESC limit 10";
$result = Mysql_Query($sql);
$choose2 = array();
while($arr = Mysql_fetch_assoc($result)){
	array_push($choose2,$arr["organ"]);
}
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<form method="POST" id="checkupForm" action="dx_ofyear_out_save.php" target="_blank" style="margin-top:8px;" onsubmit="return checkForm()">

<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" width="100%" >
<tr>
	<td>
	<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;&nbsp;&nbsp;ข้อมูลผู้ป่วย</td>
	</tr>
	<tr>
		<td>
	<table width="1024" border="0" class="tb_font">
		<tr valign="top">
			<td align="right" class="tb_font_2">เลือกวันที่ย้อนหลัง:</td>
			<td colspan="3">
				<input type="date" name="datePrev" id="datePrev" onchange="beforeFindVn(this.value);"> <span id="dateResponse"></span>
				<div>* การบันทึกวันที่ย้อนหลังระบบจะดึง VN ให้อัตโนมัติ</div>
				<script>
					function beforeFindVn(v){
						findVn(v).then(function(res){
							if(res.status===200){
								document.getElementById('vn').value = res.vn;
								document.getElementById('show_vn').innerHTML = res.vn;
								document.getElementById('dateResponse').innerHTML = '';
							}else if(res.status===400){
								document.getElementById('dateResponse').style.color = 'red';
								document.getElementById('dateResponse').innerHTML = res.message;
								document.getElementById('vn').value = '';
								document.getElementById('show_vn').innerHTML = '';
							}
						})
					}
					async function findVn(v){
						const hn = encodeURIComponent('<?=$arr_view["hn"];?>');
						const response = await fetch('dx_ofyear_out.php?action=findvn&date='+encodeURIComponent(v)+'&hn='+hn);
						const data = await response.json();
						return data;
					}
				</script>
			</td>
		</tr>
		<tr>
			<td></td>
			<td colspan="3">
				<input type="checkbox" name="sendto_out_result_chkup" id="sendto_out_result_chkup" value="1"  onclick="showCheckupForm(this.checked)">
				<label for="sendto_out_result_chkup" title="กรณีต้องการบันทึกข้อมูลเข้าระบบหลังบ้านของงานตรวจสุขภาพ">บันทึกข้อมูลเข้าแผนกตรวจสุขภาพ</label>
				<script>
					function showCheckupForm(checked){
						var el = document.getElementsByClassName('checkupField');
						for (var i=0; i < el.length; i++) {
							toggle(el[i]);
						}
					}

					function toggle(el) {
						if (el.style.display == 'none') {
							el.style.display = '';
						} else {
							el.style.display = 'none';
						}
					}
				</script>
			</td>
		</tr>
		<tr class="checkupField" style="display:none;">
			<td align="right" class="tb_font_2">เลือกบริษัท</td>
			<td colspan="3">
				<?php 

				// จับคู่กับบริษัทให้ทันที ถ้ามีข้อมูล
				$sql = "SELECT `part` FROM `opcardchk` WHERE `hn` = '$p_hn' ORDER BY `row` DESC LIMIT 1";
				$q = $dbi->query($sql);
				$part = '';
				if ($q->num_rows>0) {
					$opcardchk = $q->fetch_assoc();
					$part = $opcardchk['part'];
				}
				
				$chkYear = get_year_checkup(true);
				$sql = "SELECT `name`,`code` FROM `chk_company_list` WHERE `yearchk`='$chkYear' AND `report` <> '' ORDER BY `id` DESC";
				$q = $dbi->query($sql);
				?>
				<select name="part" id="part" style="width:200px;">
					<option value="">&lt;&lt;&nbsp;เลือกบริษัท&nbsp;&gt;&gt;</option>
					<?php 
					while ($a = $q->fetch_assoc()) { 
						$selected = ($part==$a['code']) ? 'selected="selected"' : '' ;
						?>
						<option value="<?=$a['code'];?>" <?=$selected;?> ><?=$a['name'].'&nbsp;----&gt;&nbsp;['.$a['code'].']';?></option>
						<?php
					}
					?>
				</select>
			</td>
		</tr>
		<tr>
			<td width="120" align="right"><span class="tb_font_2">VN :</span></td>
			<td width="200"><span id="show_vn"><?=$arr_view["vn"];?></span></td>
			<td width="120" align="right"><span class="tb_font_2">HN :</span></td>
			<td><?=$arr_view["hn"];?></td>
		</tr>
		<tr>
			<td align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
			<td><?=$arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?=$arr_view["ptname"];?>"/></td>
			<td align="right"><span class="tb_font_2">อายุ :</span> </td>
			<td align="left"><?=$arr_view["age"];?></td>
		</tr>
		<tr>
			<td align="right"><span class="tb_font_2">หน่วยงาน : </span></td>
			<td colspan="3"><span class="pdxhead">
				<select name="camp" id="camp" style="width:200px;">
				<?php 
				$ptright_key = substr($ptright,0,3);

				$sql12 = "select * from chkcompany where status='Y' AND row_id != 77 AND row_id != 78 order by row_id asc";
				$rows12 = mysql_query($sql12);
				while($result12 = mysql_fetch_array($rows12)){ 

					$selected = '';
					if( $ptright_key == 'R42' || $result12['code'] == 'ตรวจสุขภาพประจำปี' ){
						$selected = 'selected="selected"';
					}

					if( $camp == $result12['name'] ){
						$selected = 'selected="selected"';
					}

					?>
					<option value='<?=$result12['name']?>' <?=$selected;?> ><?=$result12['name']?></option>
					<?php
				}
				?>
				</select>
			</span>
			</td>
		</tr>
	</table>
	<hr />
	<table width="1024" border="0" class="tb_font">
		<tr>
			<td width="88" align="right" class="tb_font_2">ส่วนสูง : </td>
			<td width="79">
				<input id="pt_height" name="height" type="text" size="1" maxlength="6" value="<?=$height; ?>" /> ซม.
			</td>
			<td width="76" align="right"><span class="tb_font_2">น้ำหนัก :</span></td>
			<td width="129">
				<input id="pt_weight" name="weight" type="text" size="1" maxlength="5" value="<?=$weight; ?>" /> กก.
			</td>
			<td width="77" align="right"><span class="tb_font_2">รอบเอว :</span></td>
			<td width="132">
				<input name="round_" id="round_" type="text" size="1" maxlength="5" value="<?=$waist; ?>" /> ซม.
			</td>
			<td width="70" align="right"><span class="tb_font_2">BP :</span></td>
			<td width="160" align="left">
				<input name="bp1" type="text" size="1" maxlength="3" value="<?=$bp1;?>" />
				/
				<input name="bp2" type="text" size="1" maxlength="3" value="<?=$bp2; ?>" />
				mmHg
			</td>
			</tr>
		<tr valign="top">
		  <td align="right" class="tb_font_2">T :</td>
		  <td><input name="temperature" type="text" size="1" maxlength="5" value="<?=$temperature; ?>" />
C&deg; </td>
		  <td align="right"><span class="tb_font_2">P :</span></td>
		  <td align="left"><input name="pause" type="text" size="1" maxlength="3" value="<?=$pause; ?>" />
ครั้ง/นาที</td>
		  <td align="right"><span class="tb_font_2">R :</span></td>
		  <td align="left"><input name="rate" type="text" size="1" maxlength="3" value="<?=$rate;?>" />
ครั้ง/นาที</td>
		  <td align="right"><span class="tb_font_2">Repeat BP :</span></td>
		  <td align="left">
		  	<input name="bp21" type="text" size="1" maxlength="3" value="<?=$bp21;?>" /> / <input name="bp22" type="text" size="1" maxlength="3" value="<?=$bp22; ?>" /> mmHg<br>
			<span style="color: red;">* Repeat BP ถ้าไม่มีข้อมูลให้เว้นว่าง</span>
		  </td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2"><span class="tb_font_2">BMI :</span></td>
		  <td colspan="2">
		  	<input name="bmi" id="pt_bmi" type="text" size="5"  value="<?=$bmi; ?>"  />
			<button type="button" id="btn-bmi">คำนวณBMI</button>
		  </td>
		  <td align="left">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">แพ้ยา :</td>
		  <td colspan="7">
			<span class="data_show">
			<?php
			$sql = "Select drugcode, tradname, genname From drugreact where hn = '$hn' AND advreact!='' AND g6pd IS NULL ";
			$qReact = $dbi->query($sql);
			$numreact = 0;
			if($qReact->num_rows>0){
				$drugreact = $qReact->fetch_assoc();
				$numreact = 1;
			}
			?>
			<label for="drugreact1"><input name="drugreact" id="drugreact1" type="radio" value="0" <?=(empty($numreact) ? 'checked="checked"' : '' );?>/>ไม่มีประวัติการแพ้</label> 
			<label for="drugreact2"><input name="drugreact" id="drugreact2" type="radio" value="1" <?=(!empty($numreact) ? 'checked="checked"' : '' );?>/>แพ้</label>
			<label for="drugreact3"><input name="drugreact" id="drugreact3" type="radio" value="2" />ไม่ทราบ</label>
			&nbsp;<font color="#FF0000"><?php if(!empty($arr_view["drugreact"])){ echo  $arr_view["drugreact"];} ?></font>
		</span>
		</td>
		  </tr>
		<tr>
			<td align="right" class="tb_font_2">บุหรี่ :</td>
			<td colspan="7">
				<input type="radio" id="cigarette1" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?> /><label for="cigarette1">ไม่เคยสูบ</label>
				<input type="radio" id="cigarette2" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?> /><label for="cigarette2">เคยสูบ แต่เลิกแล้ว</label>
				<input type="radio" id="cigarette3" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; } ?> /><label for="cigarette3">สูบบุหรี่ เป็นครั้งคราว</label>
				<input type="radio" id="cigarette4" name="cigarette" value="3" <?php if($cigarette==3){ echo "checked"; } ?> /><label for="cigarette4">สูบบุหรี่ เป็นประจำ</label>
			</td>
		  </tr>
		<tr>
			<td align="right" class="tb_font_2">สุรา : </td>
			<td colspan="7">
				<input type="radio" id="alcohol1" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> /><label for="alcohol1">ไม่เคยดื่ม</label>
				<input type="radio" id="alcohol2" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> /><label for="alcohol2">เคยดื่ม แต่เลิกแล้ว</label>
				<input type="radio" id="alcohol3" name="alcohol" value="2" <?php if($alcohol==2){ echo "checked"; } ?> /><label for="alcohol3">ดื่ม เป็นครั้งคราว</label>
				<input type="radio" id="alcohol4" name="alcohol" value="3" <?php if($alcohol==3){ echo "checked"; } ?> /><label for="alcohol4">ดื่ม เป็นประจำ</label>
			</td>
		  </tr>
		<tr>
			<td align="right" class="tb_font_2">ออกกำลังกาย : </td>
			<td colspan="7">
				<input type="radio" id="exercise1" name="exercise" value="0" <?php if($exercise==0){ echo "checked"; } ?> /><label for="exercise1">ไม่เคยออกกำลังกาย</label>
				<input type="radio" id="exercise2" name="exercise" value="1" <?php if($exercise==1){ echo "checked"; } ?> /><label for="exercise2">ออกกำลังกาย ต่ำกว่าเกณฑ์</label>
				<input type="radio" id="exercise3" name="exercise" value="2" <?php if($exercise==2){ echo "checked"; } ?> /><label for="exercise3">ออกกำลังกาย ตามเกณฑ์</label>
			</td>
		  </tr>
	</table>
	<table class="tb_font">
	</table>
	<table width="960" class="tb_font">
	<tr>
		<td width="101" align="right" class="tb_font_2">โรคประจำตัว :</td>
		<td width="612" colspan="5" align="left">
			<span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?=$congenital_disease;?>"/>
             <input type="button"  onclick="document.getElementById('congenital_disease').value='ปฎิเสธ';" name="Submit3" value="ปฎิเสธ" />
           </span>
		</td>
	</tr>
	<tr>
	  <td align="right" class="tb_font_2">ลักษณะผู้ป่วย : </td>
	<td colspan="5" align="left">
		<input name="type" id="type1" type="radio" value="เดินมา" <?php if($type=="เดินมา"){ echo "checked"; } ?> /><label for="type1">เดินมา</label>
		<input name="type" id="type2" type="radio" value="นั่งรถเข็น" <?php if($type=="นั่งรถเข็น"){ echo "checked"; } ?> /><label for="type2">นั่งรถเข็น</label>
		<input name="type" id="type3" type="radio" value="นอนเปล" <?php if($type=="นอนเปล"){ echo "checked"; } ?>/><label for="type3">นอนเปล</label>
		<input name="type" id="type4" type="radio" value="ญาติ" <?php if($type=="ญาติ"){ echo "checked"; } ?>/><label for="type4">ญาติ</label>
	</td>
	  </tr>
	</table>
	<table class="tb_font" width="">
	  <tr>
			<td align="right" valign="top" class="tb_font_2" width="101">อาการ : </td>
			<td colspan="2" align="left" valign="top">
				<textarea id="organ" name="organ" cols="40" rows="6" >ตรวจสุขภาพประจำปี<?=$og;?></textarea> &nbsp;&nbsp;
			</td>
            <td colspan="2" align="left" valign="top">
				<div>
					<select style="width: 180px;" name="choose_organ" onchange="if(this.value != ''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}">
						<option value="">--- ตัวช่วย ---</option>
						<?php
						foreach($choose as $value){
						echo "<option value='".$value."'>".$value."</option>";
						}
						?>
					</select>
				</div>
				<div style="margin-top:8px;">
					<select style="width: 180px;" name="select" onchange="if(this.value !=''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}">
						<option value="">--- อาการเดิม ---</option>
						<?php
						foreach($choose2 as $value){
						echo "<option value='".$value."'>".$value."</option>";
						}
						?>
					</select>
				</div>
			</td>
		</tr>
	</table>
	<table class="tb_font">
		<tr valign="top">
			<td width="200" align="right" class="tb_font_2">ตรวจสุขภาพช่องปากและฟัน :<br>(Dental Examination)</td>
			<td><input type="text" name="dental_exam" value="<?=$arr_dxofyear['dental_exam'];?>"></td>
			<td width="200" align="right" class="tb_font_2">ตรวจสายตาและตาบอดสี :<br>(Auto-R & color blindness)</td>
			<td><input type="text" name="color_blind" value="<?=$arr_dxofyear['color_blind'];?>"></td>
		</tr>
		<tr valign="top">
			<td align="right" class="tb_font_2">ตรวจการได้ยิน :<br>(Audiogram)</td>
			<td><input type="text" name="audiogram" value="<?=$arr_dxofyear['audiogram'];?>"></td>
			<td align="right" class="tb_font_2">ตรวจคลื่นไฟฟ้าหัวใจ :<br>(EKG)</td>
			<td><input type="text" name="ekg" value="<?=$arr_dxofyear['ekg'];?>"></td>
		</tr>
	</table>
	<?php
	$outResult = array();
	$chkYear = get_year_checkup();
	$sql = "SELECT * FROM out_result_chkup WHERE hn = '$p_hn' AND year_chk = '$chkYear' ";
	$q = $dbi->query($sql);
	if($q->num_rows > 0){
		$a = $q->fetch_assoc();
		$outResult = $a;
	}
	?>
	<fieldset class="checkupField" style="display:none;">
		<legend>แบบฟอร์มตรวจสุขภาพ</legend>
		<table class="tb_font" width="100%">
			<tr valign="top">
				<td width="240" align="right" class="tb_font_2">หมายเหตุ : </td>
				<td colspan="3"><input type="text" name="comment" id="comment" value="<?=$outResult['comment'];?>"></td>
			</tr>
			<tr valign="top">
				<td width="240" align="right" class="tb_font_2">ผลตรวจ สมรรถภาพปอด : </td>
				<td colspan="3">
					<input type="text" name="pt" id="pt" value="<?=$outResult['pt'];?>">
					<select onchange="document.getElementById('pt').value=this.value;" class="pdx" style="width:120px;">
						<option value="">---------- เลือก ----------</option>
						<option value="ปกติ">ปกติ</option>
						<option value="ปอดจำกัดการขยายตัว">ปอดจำกัดการขยายตัว</option>
						<option value="ปอดอุดกั้น">ปอดอุดกั้น</option>
						<option value="มีการอุดกั้นของประสิทธิภาพปอด ระดับเล็กน้อย (เกรด B)">มีการอุดกั้นของประสิทธิภาพปอด ระดับเล็กน้อย (เกรด B)</option>
					</select>
					<div>
						<b>ระบุ : </b><input type="radio" name="pt_detail" id="pt_detail1" value="ผิดปกติเล็กน้อย" class="pdxhead">
						<label for="pt_detail1">ผิดปกติเล็กน้อย</label>

						<input type="radio" name="pt_detail" id="pt_detail2" value="ผิดปกติปานกลาง" class="pdxhead">
						<label for="pt_detail2">ผิดปกติปานกลาง</label>

						<input type="radio" name="pt_detail" id="pt_detail3" value="ผิดปกติมาก" class="pdxhead">
						<label for="pt_detail3">ผิดปกติมาก</label>
						
						<a href="javascript:void(0);" onclick="cancelPtDetail()">[ยกเลิก]</a>
						<script>
							function cancelPtDetail(){
								document.getElementById("pt_detail1").checked = false;
								document.getElementById("pt_detail2").checked = false;
								document.getElementById("pt_detail3").checked = false;
							}
						</script>
					</div>
				</td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผล X-RAY : </td>
				<td><input type="text" name="cxr" id="cxr" value="<?=$outResult['cxr'];?>"></td>
				<td></td>
				<td></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลตรวจตาบอดสี : </td>
				<td>
					<input type="radio" name="va" id="va1" value="ไม่พบตาบอดสี"><label for="va1">ไม่พบตาบอดสี</label>
					<input type="radio" name="va" id="va2" value="พบตาบอดสี"><label for="va2">พบตาบอดสี</label>
					<a href="javascript:void(0);" onclick="clearVa();">ยกเลิก</a>
					<script>
						function clearVa(){
							document.getElementById('va1').checked=false;
							document.getElementById('va2').checked=false;
						}
					</script>
				</td>
				<td align="right" class="tb_font_2">ผลการได้ยิน : </td>
				<td><input type="text" name="hearing" id="hearing" value="<?=$outResult['hearing'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลตรวจ วัดสายตา : </td>
				<td>
					<input type="radio" name="eye" id="eye1" onclick="eye_detail_contain('none')" value="ปกติ"><label for="eye1">ปกติ</label>
					<input type="radio" name="eye" id="eye2" onclick="eye_detail_contain('')" value="ผิดปกติ"><label for="eye2">ผิดปกติ</label>
					<a href="javascript:void(0);" onclick="clearEye();">[ยกเลิก]</a>
					<div id="eye_detail_contain" style="display:none;">
						ระบุความผิดปกติ : <input name="eye_detail" type="text" id="eye_detail" value="<?=$outResult['eye_detail'];?>">
					</div>
					<script>
						function clearEye(){
							document.getElementById('eye1').checked=false;
							document.getElementById('eye2').checked=false;
							document.getElementById('eye_detail_contain').style.display='none';
						}
						function eye_detail_contain(css){
							document.getElementById('eye_detail_contain').style.display=css;
							if(css==''){
								document.getElementById('eye_detail').focus();
							}
						}
					</script>
				</td>
				<td align="right" class="tb_font_2">ผลตรวจ BMD  : </td>
				<td><input type="text" name="42702" id="42702" value="<?=$outResult['42702'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลตรวจ ความดันตา : </td>
				<td>
					<input type="radio" name="eye_pressure" id="eye_pressure1" onclick="eyePressureDetail('none')" value="ปกติ"><label for="eye_pressure1">ปกติ</label>
					<input type="radio" name="eye_pressure" id="eye_pressure2" onclick="eyePressureDetail('')" value="ผิดปกติ"><label for="eye_pressure2">ผิดปกติ</label>
					<a href="javascript:void(0);" onclick="clearEyePressure()">[ยกเลิก]</a>
					<div id="eyePressureDetail" style="display:none;">
						ระบุความผิดปกติ : <input name="eye_pressure_detail" type="text" id="eye_pressure_detail" value="<?=$outResult['eye_pressure_detail'];?>">
					</div>
					<script>
						function clearEyePressure(){
							document.getElementById('eye_pressure1').checked=false;
							document.getElementById('eye_pressure2').checked=false;
							document.getElementById('eyePressureDetail').style.display='none';
						}
						function eyePressureDetail(css){
							document.getElementById('eyePressureDetail').style.display=css;
							if(css==''){
								document.getElementById('eye_pressure_detail').focus();
							}
						}
					</script>
				</td>
				<td align="right" class="tb_font_2">อัลตร้าซาวด์  : </td>
				<td><input type="text" name="altra" id="altra" value="<?=$outResult['altra'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลตรวจ ลานสายตา : </td>
				<td>
					<input type="radio" name="eye_vision" id="eye_vision1" onclick="eyeVisionDetail('none')" value="ปกติ"><label for="eye_vision1">ปกติ</label>
					<input type="radio" name="eye_vision" id="eye_vision2" onclick="eyeVisionDetail('')" value="ผิดปกติ"><label for="eye_vision2">ผิดปกติ</label>
					<a href="javascript:void(0);" onclick="clearEyeVision()">[ยกเลิก]</a>
					<div id="eyeVisionDetail" style="display:none;">
						ระบุความผิดปกติ : <input name="eye_vision_detail" type="text" id="eye_vision_detail" value="<?=$outResult['eye_vision_detail'];?>">
					</div>
					<script>
						function clearEyeVision(){
							document.getElementById('eye_vision1').checked=false;
							document.getElementById('eye_vision2').checked=false;
							document.getElementById('eyeVisionDetail').style.display='none';
						}
						function eyeVisionDetail(css){
							document.getElementById('eyeVisionDetail').style.display=css;
							if(css==''){
								document.getElementById('eye_vision_detail').focus();
							}
						}
					</script>
				</td>
				<td></td>
				<td></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ตรวจคัดกรองหาความเสี่ยงของโรคเส้นเลือดแดงตีบตัน (CIMT)  : </td>
				<td><input type="text" name="cimt" id="cimt" value="<?=$outResult['cimt'];?>"></td>
				<td align="right" class="tb_font_2">ตรวจหัวใจด้วยคลื่นเสียงสะท้อนความถี่สูง (ECHO)  : </td>
				<td><input type="text" name="echo" id="echo" value="<?=$outResult['echo'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ตรวจวัดความแข็งตัวของหลอดเลือด (ABI)  : </td>
				<td><input type="text" name="abi" id="abi" value="<?=$outResult['abi'];?>"></td>
				<td align="right" class="tb_font_2">ต่อมลูกหมาก : </td>
				<td><input type="text" name="psa" id="psa" value="<?=$outResult['psa'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">มะเร็งปากมดลูก : </td>
				<td><input type="text" name="hpv" id="hpv" value="<?=$outResult['hpv'];?>"></td>
				<td align="right" class="tb_font_2">แมมโมแกรม : </td>
				<td><input type="text" name="mammogram" id="mammogram" value="<?=$outResult['mammogram'];?>"></td>
			</tr>

			<tr valign="top">
				<td align="right" class="tb_font_2">ผลตรวจ Stool Culture(C-S) : </td>
				<td><input type="text" name="result_cs" id="result_cs" value="<?=$outResult['result_cs'];?>"></td>
				<td align="right" class="tb_font_2">สรุปผล Stool Culture(C-S) : </td>
				<td><input type="text" name="cs" id="cs" value="<?=$outResult['cs'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลการตรวจสารเคมีโลหะหนัก : </td>
				<td><input type="text" name="metal" id="metal" value="<?=$outResult['metal'];?>"></td>
				<td align="right" class="tb_font_2">สรุปผลการตรวจสารเคมีโลหะหนัก : </td>
				<td><input type="text" name="metal_result" id="metal_result" value="<?=$outResult['metal_result'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลการตรวจสาร Benzene : </td>
				<td><input type="text" name="benzene" id="benzene" value="<?=$outResult['benzene'];?>"></td>
				<td align="right" class="tb_font_2">สรุปผลการตรวจสาร Benzene : </td>
				<td><input type="text" name="benzene_result" id="benzene_result" value="<?=$outResult['benzene_result'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลตรวจความหนาแน่นของมวลกระดูก : </td>
				<td><input type="text" name="bone_density" id="bone_density" value="<?=$outResult['bone_density'];?>"></td>
				<td align="right" class="tb_font_2">สายตาอาชีวอนามัย + สายตาสั้น, ยาว : </td>
				<td><input type="text" name="occupa_health" id="occupa_health" value="<?=$outResult['occupa_health'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลการตรวจ AFP : </td>
				<td><input type="text" name="outAfp" id="outAfp" value="<?=$outResult['outAfp'];?>"></td>
				<td align="right" class="tb_font_2">สรุปผลการตรวจ AFP : </td>
				<td><input type="text" name="outAfpResult" id="outAfpResult" value="<?=$outResult['outAfpResult'];?>"></td>
			</tr>
			<tr valign="top">
				<td align="right" class="tb_font_2">ผลการตรวจ PSA : </td>
				<td><input type="text" name="outPsa" id="outPsa" value="<?=$outResult['outPsa'];?>"></td>
				<td align="right" class="tb_font_2">สรุปผลการตรวจ PSA : </td>
				<td><input type="text" name="outPsaResult" id="outPsaResult" value="<?=$outResult['outPsaResult'];?>"></td>
			</tr>
		</table>
	</fieldset>

	<table class="tb_font">
		<tr>
			<td align="right" class="tb_font_2">คลินิก : </td>
			<td align="left" colspan="5">
				<select name="clinic" id="clinic">
				<?php 
				print "<option value='' >-- กรุณาเลือกคลินิก --</option>";
				print " <option value='12 เวชปฏิบัติ' selected>เวชปฏิบัติ</option>";
				print " <option value='01 อายุรกรรม'>อายุรกรรม</option>";
				print " <option value='02 ศัลยกรรม'>ศัลยกรรม</option>";
				print " <option value='03 สูติกรรม'>สูติกรรม</option>";
				print " <option value='04 นารีเวชกรรม'>นารีเวชกรรม</option>";
				print " <option value='05 กุมารเวช'>กุมารเวช</option>";
				print " <option value='06 โสต ศอ นาสิก'>โสต สอ นาสิก</option>";
				print " <option value='07 จักษุ'>จักษุ</option>";
				print " <option value='08 ศัลยกรรมกระดูก'>ศัลยกรรมกระดุก</option>";
				print " <option value='08 ศัลยกรรมทางเดินปัสสาวะ'>ศัลยกรรมทางเดินปัสสาวะ</option>";
				print " <option value='09 จิตเวช'>จิตเวช</option>";
				print " <option value='10 รังษีวิทยา'>รังษีวิทยา</option>";
				print " <option value='11 ทันตกรรม'>ทันตกรรม</option>";
				if($_SESSION["smenucode"] != "ADMMAINOPD"){
				print " <option value='12 เวชศาสตร์ฟื้นฟู'>เวชศาสตร์ฟื้นฟู</option>";
				}
				print " <option value='12 อื่นๆ'>อื่นๆ</option>";
				?>
				</select>
			</td>
         </tr>
         <tr>
			<td align="right" class="tb_font_2">แพทย์ : </td>
			<td align="left" colspan="5"><select name="doctor" id="doctor">
				<?php 
				echo "<option value='' >-- กรุณาเลือกแพทย์ --</option>";
				echo "<option value='ห้องตรวจโรคทั่วไป' >ห้องตรวจโรคทั่วไป</option>";
				$sql = "Select name From doctor where status = 'y' ";
				$result = mysql_query($sql);
				while(list($name) = mysql_fetch_row($result)){
					if($doctor==$name){
						echo "<option value='".$name."' selected >".$name."</option>";
					}else{
						echo "<option value='".$name."' >".$name."</option>";	
					}
				}
				?>
				</select>
			</td>
         </tr>
	</table>
		</td>
	</tr>
	<tr>
		<td></td>
	</tr>
	</table>
	</td>
</tr>
</table>
<BR>

<!-- ผลการตรวจทางพยาธิ -->
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<tr>
	<td>
	<table border="0" cellpadding="0" cellspacing="0">
	<tr>
		<td align="left" bgcolor="#0000CC" class="tb_font_1">
			<?php 
			$labStyle = '';
			$todayLab = date('d/m/Y');
			// ถ้าไม่ใช่แลปของวันนี้ให้แจ้งเตือนวันที่ที่เจาะแลป
			if ($todayLab!=$lab_date && !empty($lab_date)) {
				$labStyle='<span style="font-weight:bold; color:red; font-size:32px;">เมื่อวันที่ '.$lab_date.'</span>';

			}elseif(empty($lab_date)){
				$labStyle = '<span style="color:red;">'.$lab_alert.'</span>';

			}
			?>
			&nbsp;&nbsp;&nbsp;ผลการตรวจทางพยาธิ <?=$labStyle;?> &nbsp;&nbsp;&nbsp;
		</td>
	</tr>
	<tr class="tb_font">
		<td>
	&nbsp;&nbsp; <span class="style5">UA :</span> 
       <table border="0">
	  <tr>
	  <?php
	  $i=1;
		while(list($labname,$labresult, $unit) = mysql_fetch_row($result_ua)){
			if($labname == "OTHERU"){
				$size="13";
			}else{
				$size="6";
			}
			?>
			<td align="right" class="tb_font_2"><?=$labname;?> : </td>
			<td>&nbsp;<input name="<?=$list_ua[$labname];?>" type="text" value="<?=$labresult;?>"  size="<?=$size;?>" readonly />&nbsp;</td>
			<?php 
			if($i%5==0) echo "<tr></tr>";
			
			$i++;
		} // end while UA
			?>
		  </tr>
      </table>
	  <hr />
	  <div><span class="style5">&nbsp;&nbsp;CBC :</span></div>
	<div >
    <table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit,$normalrange,$flag) = mysql_fetch_row($result_cbc)){
		if($labname == "OTHER" || $labname == "PLTS"){
			$size="13";
		}else{
			$size="6";
		}
		//if(!empty($arr_dxofyear[$list_cbc[$labname]]))
			//$labresult = $arr_dxofyear[$list_cbc[$labname]];
	  ?>
          <td align="right" class="tb_font_2"><?=$labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_cbc[$labname];?>" type="text" value="<?=$labresult;?>"  size="<?=$size;?>" readonly />&nbsp;<?php //echo //$unit;?>&nbsp;</td>
          <input type="hidden" name="<?=$labname?>range" value="<?=$normalrange?>" />
          <input type="hidden" name="<?=$labname?>flag" value="<?=$flag?>" />
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>
		  </tr>
      </table>
      </div>
	  <hr />

	<?php 
	$other_lab_rows = mysql_num_rows($result_lab);
	if ($other_lab_rows > 0) 
	{
	?>
	<div><span class="style5">&nbsp;&nbsp;แลปอื่นๆ :</span></div>
	<table border="0">
		<tr>
		<?php
		$i=1;
		while(list($labname,$labresult, $unit,$normalrange,$flag) = mysql_fetch_row($result_lab))
		{ 

			$extraName = "";
			if($labname=='10001')
			{
				$extraName = '(LDLC)';
			}

			if($labname=='1427'){
				$extraName = '(URIC)';
			}

			if($labname=='ANTIHB'){
				$extraName = '(HBsAb)';
			}

			?>
			<td align="right" class="tb_font_2"><?=$labname.$extraName;?> : </td>
			<td>
				&nbsp;<input name="<?=$list_lab[$labname];?>" type="text" value="<?=$labresult;?>" size="6" readonly />&nbsp;&nbsp;
				<input type="hidden" name="<?=$labname?>range" value="<?=$normalrange?>" />
				<input type="hidden" name="<?=$labname?>flag" value="<?=$flag?>" />
				<?php 
				if(empty($list_lab[$labname])){
					echo "<span>*<span>";
				}
				?>
			</td>
			<?php 
			// ตัดบรรทัดใหม่
			if($i%5==0) echo "<tr></tr>";
			$i++;
		}
		?>
		</tr>

		<tr>
			<td colspan="10">
			<p style="margin: 0;">
				<?php 
				echo implode(', ', array_keys($list_lab));
				?>
			</p>
			<p style="margin: 0;">ผลแลปที่มี(*)ตามท้ายคือผลแลปอื่นๆที่ไม่มีในรายการข้างต้น <b><u>หากจำเป็นต้องให้แแพทย์บันทึกผลและออกรายงาน</u></b> กรุณาแจ้งศูนย์คอมฯล่วงหน้า เพื่อจะได้ปรับปรุงฐานข้อมูลก่อน ขอบคุณครับ</p>
			</td>
		</tr>

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
<BR>
<!-- บันทึกการวินิฉัยจากแพทย์ -->
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
	<tr>
		<td>
			<table border="0" cellpadding="0" cellspacing="0">
				<tr>
					<td align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;&nbsp;&nbsp;บันทึกการวินิฉัยจากแพทย์</td>
				</tr>
				<tr class="tb_font">
					<td>
						<table height="60" border="0" class="tb_font">
							<tr>
								<td valign="top">&nbsp;&nbsp;
									<textarea name="dx" cols="60" rows="8" id="dx"><?=$arr_dxofyear["dx"]; ?></textarea>
								</td>
							</tr>
						</table>
					</td>
				</tr>
			</table>
		</td>
	</tr>
</table>

<div style="text-align:center; margin-top:8px; margin-bottom:8px;">
	<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" style="padding: 8px 16px;"/>&nbsp;&nbsp;<input name="submit2" type="submit" value="บันทึกและพิมพ์ใบตรวจโรค" style="padding: 8px 16px;"/>
</div>

<input type="hidden" name="age" id="age"  value="<?=$arr_view["age"];?>" />
<input type="hidden" name="hn" id="hn"  value="<?=$arr_view["hn"];?>" />
<input type="hidden" name="vn" id="vn"  value="<?=$arr_view["vn"];?>" />
<input type="hidden" name="toborow" value="<?=$toborow;?>">
<input type="hidden" name="ptright" value="<?=$ptright;?>">
<input type="hidden" name="row_id" value="<?=$arr_dxofyear["row_id"];?>">
<input type="hidden" name="labin_date" value="<?=$labin_date;?>">
</form>

<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<script>
	function checkForm(){
		let waist = parseFloat(document.getElementById('round_').value.trim());
		if(isNaN(waist)===true){
			
			Swal.fire({
				icon: "error",
				title: "กรุณาใส่ข้อมูลรอบเอว"
			});

			return false;
		}
	}

	jQuery.noConflict();
	(function( $ ) {
	$(function() {
		
        $(document).on('click', '#btn-bmi', function(){

            var pt_height = $("#pt_height").val();
			var pt_weight = $("#pt_weight").val();

			var hei = pt_height / 100;
			var bmi = pt_weight / ( hei * hei );

			$("#pt_bmi").val(bmi.toFixed(2));
            
        });
		
	});
})(jQuery);
</script>




<?php }?>



<?php 
include("unconnect.inc");
 ?>
</body>


</html>
