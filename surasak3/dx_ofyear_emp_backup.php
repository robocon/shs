<?php
// header('Content-Type: text/html; charset=tis-620');
// error_reporting(0);
// ini_set('display_errors', 0);
// session_start();
// include 'connect.inc';
// mysql_query("SET NAMES TIS620");
// mysql_query("SET NAMES UTF8");

include 'bootstrap.php';

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

$list_ua = array(
	'COLOR' => 'ua_color',
	'APPEAR' => 'ua_appear',
	'SPGR' => 'ua_spgr',
	'PHU' => 'ua_phu',
	'BLOODU' => 'ua_bloodu',
	'PROU' => 'ua_prou',
	'GLUU' => 'ua_gluu',
	'KETU' => 'ua_ketu',
	'UROBIL' => 'ua_urobil',
	'BILI' => 'ua_bili',
	'NITRIT' => 'ua_nitrit',
	'WBCU' => 'ua_wbcu',
	'RBCU' => 'ua_rbcu',
	'EPIU' => 'ua_epiu',
	'BACTU' => 'ua_bactu',
	'YEAST' => 'ua_yeast',
	'MUCOSU' => 'ua_mucosu',
	'AMOPU' => 'ua_amopu',
	'CASTU' => 'ua_castu',
	'CRYSTU' => 'ua_crystu',
	'OTHERU' => 'ua_otheru',
);

$list_cbc = array(
	'WBC' => 'cbc_wbc',
	'RBC' => 'cbc_rbc',
	'HB' => 'cbc_hb',
	'HCT' => 'cbc_hct',
	'MCV' => 'cbc_mcv',
	'MCH' => 'cbc_mch',
	'MCHC' => 'cbc_mchc',
	'PLTC' => 'cbc_pltc',
	'PLTS' => 'cbc_plts',
	'NEU' => 'cbc_neu',
	'LYMP' => 'cbc_lymp',
	'MONO' => 'cbc_mono',
	'EOS' => 'cbc_eos',
	'BASO' => 'cbc_baso',
	'BAND' => 'cbc_band',
	'ATYP' => 'cbc_atyp',
	'NRBC' => 'cbc_nrbc',
	'RBCMOR' => 'cbc_rbcmor',
	'OTHER' => 'cbc_other',
);

$list_lab = array(
	'TRIG' => 'tg',
	'GLU' => 'bs',
	'CHOL' => 'chol',
	'AST' => 'sgot',
	'ALT' => 'sgpt',
	'ALP' => 'alk',
	'BUN' => 'bun',
	'CREA' => 'cr',
	'URIC' => 'uric',
);
?>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
            "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta http-equiv="Content-Type" content="text/html; charset=tis-620" />
<title>โปรแกรมตรวจสุขภาพลูกจ้าง</title>
<style type="text/css">
	.font_title{font-family:"Angsana New"; font-size:28px}
	.tb_font{font-family:"Angsana New"; font-size:20px;}
	.tb_font_1{font-family:"Angsana New"; font-size:20px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:20px; background-color:#9FFF9F}

.tb_font_2 {
	color: #B00000;
	font-weight: bold;
}
.style5 {color: #000099; font-weight: bold; }
.pdxhead {	font-family: "TH SarabunPSK";
	font-size: 24px;
}

.align-center{
	text-align: center;
}
</style>
</head>
<body>
	<a href ="../nindex.htm" >&lt;&lt; เมนู</a>
	<h1 class="align-center">โปรแกรมตรวจสุขภาพลูกจ้าง</h1>
<form action="dx_ofyear_emp.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
		<TR>
			<TD align="center" bgcolor="#0000CC" class="tb_font_1">กรอกหมายเลข HN</TD>
		</TR>
		<TR>
			<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/>&nbsp;<input type="submit" name="Submit" value="ตกลง" /></TD>
		</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<input name="post_vn" type="hidden" value="1" />
</form>
<br/>
<?php 
if(!empty($_POST["post_vn"]) && $_POST["p_hn"] != ""){

	//ค้นหา hn จาก opday ****************************************************************************************
	
	$sql = "SELECT *, CONCAT(`yot`,' ',`name`,' ',`surname`) as `ptname` 
	FROM `opcard` 
	WHERE `hn` = ? 
	AND `employee` = 'y' LIMIT 0,1";
	$arr_view = DB::select($sql, array($_POST['p_hn']));
	
	if(empty($arr_view)){
		echo 'ไม่ได้เป็นบุคลากรโรงพยาบาล';
		exit;
	}
	
	// ค้นหา vn ล่าสุด จาก opd
	$sql = " SELECT vn
FROM `opd`
WHERE `hn` = ?
ORDER BY `row_id` DESC
LIMIT 1 ";
	$get_vn = DB::select($sql, array($_POST['p_hn']));
	$arr_view['vn'] = $get_vn['vn'];
	
	$date_hn = date("Y-m-d").$arr_view["hn"];
	$date_vn = date("Y-m-d").$arr_view["vn"];

/*$sql = "SELECT  weight, height,waist From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height,$waist) = Mysql_fetch_row($result);*/

$sql3 = "SELECT  temperature,pause,rate,weight,height,bp1,bp2,waist From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' and thidate like '$thaidate%'";
$result3 = Mysql_Query($sql3);
$cou = mysql_num_rows($result3);
list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$waist) = Mysql_fetch_row($result3);
if($cou=="0"){
	$sql3 = "SELECT  temperature,pause,rate,weight,height,bp1,bp2,doctor,clinic From dxofyear_out where hn = '".$arr_view["hn"]."' and thidate like '".date("Y-m-d")."%'";
	$result3 = Mysql_Query($sql3);
	list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$dr,$cli) = Mysql_fetch_row($result3);
}

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	//$sql = "SELECT dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
	//$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	//list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);

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

	$sql = "SELECT date_format(a.orderdate,'%d/%m/%Y') 
	From resulthead as a 
	where a.hn='".$arr_view['hn']."'  
	AND (a.clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix') 
	Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	// ค้นหาผลตรวจทางพยาธิ
	$sql = "SELECT labcode, result, unit,normalrange,flag 
	From resulthead as a , resultdetail as b 
	where a.hn='".$arr_view['hn']."' 
	AND a.autonumber = b.autonumber 
	AND b.parentcode = 'UA' 
	AND (a.clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix' ) 
	Order by b.labcode ASC ";
	$result_ua = mysql_query($sql);
	
	$sql = "SELECT labcode, result, unit,normalrange,flag 
	From resulthead as a , resultdetail as b 
	where a.hn = ?
	AND a.autonumber = b.autonumber 
	AND b.parentcode = 'UA' 
	AND (a.clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix' ) 
	Order by b.labcode ASC ";
	$test_ua = DB::select($sql, array($arr_view['hn']));
	// var_dump($test_ua);
	
	$sql = "SELECT labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "SELECT labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix') Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);

	
	
	// ค้นหาข้อมูลเดิม เพื่อตรวจสอบว่า เคยเพิ่มข้อมูลเข้ามายัง dxofyear_emp แล้วรึยัง
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	//$sql = "SELECT * From  `dxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";
	$sql = "SELECT * FROM  `dxofyear_emp` WHERE `hn`='".$arr_view["hn"]."' ORDER BY `row_id` DESC limit 0,1 ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	if($count > 0){
		$arr_dxofyear = mysql_fetch_assoc($result);
		
		$height = $arr_dxofyear["height"];
		$weight = $arr_dxofyear["weight"];
		$temperature=$arr_dxofyear["temperature"];
		$pause=$arr_dxofyear["pause"];
		$rate=$arr_dxofyear["rate"];
		//$bmi=$arr_dxofyear["bmi"];
		
		 $ht = $height/100;
		 $bmi=number_format($weight /($ht*$ht),2);
		 
		 $bp1=$arr_dxofyear["bp1"];
		 $bp2=$arr_dxofyear["bp2"];
		 $bp21=$arr_dxofyear["bp21"];
		 $bp22=$arr_dxofyear["bp22"];
		 $cigarette=$arr_dxofyear["cigarette"];
		 $alcohol=$arr_dxofyear["alcohol"];
		 $exercise=$arr_dxofyear["exercise"];
		$type=$arr_dxofyear["type"];
		$doctor=$arr_dxofyear["doctor"];
		
		$arr_view["vn"]=$arr_dxofyear["vn"];
		
		if($arr_dxofyear["congenital_disease"] != ''){ 
			$congenital_disease = $arr_dxofyear["congenital_disease"];
		}else{
			$congenital_disease = "ปฎิเสธโรคประจำตัว";
		}
		
	}else{  //// ค้นหาจาก opd
	
		$sql = "SELECT congenital_disease,weight,height,cigarette,alcohol,exercise,bp1,bp2,doctor,temperature,pause,rate,waist
		FROM opd 
		WHERE hn = ? 
		AND type <> 'ญาติ' 
		ORDER BY row_id DESC limit 1";
		$opd = DB::select($sql, array($arr_view["hn"]));
		
		$congenital_disease = $opd['congenital_disease'];
		$weight = $opd['weight'];
		$height = $opd['height'];
		$cigarette = $opd['cigarette'];
		$alcohol = $opd['alcohol'];
		$exercise = $opd['exercise'];
		$bp1 = $opd['bp1'];
		$bp2 = $opd['bp2'];
		$doctor = $opd['doctor'];
		$temperature = $opd['temperature'];
		$pause = $opd['pause'];
		$rate = $opd['rate'];
		$waist = $opd['waist'];

		if(empty($congenital_disease)){
			$congenital_disease = "ปฎิเสธโรคประจำตัว";
		}
	}
	
	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
	if($arr_dxofyear["rate"] == ""){
		$arr_dxofyear["rate"] = 20;
	}
	
$choose = array(
	"ตรวจตามนัด",
	"มาก่อนนัด",
	"มาหลังนัด",
	"อาการทั่วไปปกติ",
	"รับยาเดิม",
	"..........วัน",
	"ไข้",
	"ไอ",
	"เจ็บคอ",
	"มีเสมหะ",
	"มีน้ำมูก",
	"ปวดศีรษะ",
	"เวียนศีรษะ",
	"บ้านหมุน",
	"คลื่นไส้",
	"อาเจียน",
	"ใจสั่น",
	"อ่อนเพลีย",
	"เบื่ออาหาร",
	"หายใจเหนื่อยหอบ",
	"จุกแน่นท้อง",
	"เจ็บหน้าอก",
	"หน้ามืด ตาลาย",
	"ปวดท้อง",
	"อืดท้อง",
	"ถ่านอุจจาระเหลว",
	"ท้องผูก",
	"ปัสสาวะแสบขัด",
	"ปวดหลัง",
	"ปวดเอว",
	"ปวดแขน",
	"ปวดขา",
	"ปวดน่อง",
	"ปวดไหล่",
	"ปวดสะโพก",
	"แผลที่.......",
	"ก้อนที่........",
	"ตรวจสุขภาพ",
	"ขอใบรับรองแพทย์",
	"ปรึกษาแพทย์",
	"ปวดเมื่อยตามตัว",
	"ครั่นเนื้อครั่นตัว",
	"ผื่นคัน",
	"ผู้ป่วยไม่มา ญาติชื่อ..ID..",
	"ขอรับวัคซีนนัดฉีดโรคพิษสุนัขบ้า เข็มที่",
	"ขอรับวัคซีนนัดฉีดบาดทะยัก เข็มที่",
	"ขอรับวัคซีนนัดฉีดไวรัสตับอักเสบบี เข็มที่",
	"ขอสำเนาประวัติรักษา",
);
sort($choose);

// อาการเดิม
$sql = "SELECT DISTINCT `organ` 
FROM `opd` 
WHERE `hn` = ? 
AND `organ` != '' ORDER BY `row_id` DESC limit 10";
$arrs = DB::select($sql, array($arr_view["hn"]));
$choose2 = array();
if(count($arrs) > 1){
	foreach($arrs as $arr){
		$choose2[] = $arr["organ"];
	}
}else{
	$choose2[] = $arrs['organ'];
}

?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<form method="post" ACTION="dx_ofyear_emp_save.php" <?php //if($arr_view["vn"] ==""){echo "Onsubmit=\"alert('ผู้ป่วยยังไม่ได้ทำการลงทะเบียน');return false;\"";}?>>

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $arr_view["vn"];?>" />

<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" width="100%" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0" width="100%">
	<TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;&nbsp;&nbsp;ข้อมูลผู้ป่วย</TD>
	</TR>
	<TR>
		<TD>
	<table width="528" border="0" class="tb_font">
		<tr>
			<td width="88" align="right"><span class="tb_font_2">VN :</span></td>
			<td width="225"><?php echo $arr_view["vn"];?></td>
			<td align="right"><span class="tb_font_2">HN :</span></td>
			<td width="148"><?php echo $arr_view["hn"];?></td>
			</tr>
		<tr>
			<td width="88" align="right"><span class="tb_font_2">ชื่อ-สกุล : </span></td>
			<td><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
			<td width="49" align="right"><span class="tb_font_2">อายุ :</span> </td>
			<td align="left"><?php echo $arr_view["age"];?></td>
			</tr>
		  <tr><td><input type="hidden" name="camp" value="ลูกจ้าง ร.พ.ค่ายสุรศักดิ์มนตรี"></td></tr>
	</table>
	<hr />
	<table width="854" border="0" class="tb_font">
	  <tr>
			<td width="130" align="right" class="tb_font_2">ส่วนสูง : </td>
			<td width="79"><input name="height" type="text" size="1" maxlength="3" value="<?php echo $height; ?>" />
ซม.</td>
			<td width="76" align="right"><span class="tb_font_2">น้ำหนัก :</span></td>
			<td width="129"><input name="weight" type="text" size="1" maxlength="3" value="<?php echo $weight; ?>" />
กก. </td>
			<td width="77" align="right"><span class="tb_font_2">รอบเอว :</span></td>
			<td width="132"><input name="round_" type="text" size="1" maxlength="3" value="<?php echo $waist; ?>" />
			  ซม.</td>
			<td width="67" align="left"><span class="tb_font_2">BP1 :</span></td>
			<td width="130" align="left"><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $bp1;?>" />
			  /
			  <input name="bp2" type="text" size="1" maxlength="3" value="<?php echo $bp2; ?>" />
			  mmHg</td>
			</tr>
		<tr>
		  <td align="right" class="tb_font_2">T :</td>
		  <td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $temperature; ?>" />
C&deg; </td>
		  <td align="right"><span class="tb_font_2">P :</span></td>
		  <td align="left"><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $pause; ?>" />
ครั้ง/นาที</td>
		  <td align="right"><span class="tb_font_2">R :</span></td>
		  <td align="left"><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $rate;?>" />
ครั้ง/นาที</td>
		  <td align="left"><span class="tb_font_2">BP2 :</span></td>
		  <td align="left"><input name="bp21" type="text" size="1" maxlength="3" value="<?php echo $bp21;?>" />
/
  <input name="bp22" type="text" size="1" maxlength="3" value="<?php echo $bp22; ?>" />
mmHg</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2"><span class="tb_font_2">BMI :</span></td>
		  <td colspan="2"><input name="bmi" type="text" size="3"  value="<?php echo $bmi; ?>"  /></td>
		  <td align="left">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">แพ้ยา :</td>
		  <td colspan="7">
		  
			<label for="drugreact1">
				<input name="drugreact" type="radio" id="drugreact1" value="0" <?php echo $arr_view["drugreact"]==0 ? 'checked="checked"' : '' ;?> />
				ไม่แพ้
			</label>
			<label for="drugreact2">
				<input name="drugreact" type="radio" id="drugreact2" value="1" <?php echo $arr_view["drugreact"]==1 ? 'checked="checked"' : '' ;?> />
				แพ้ 
			</label>
			<span style="color: #ff0000; font-weight:bold;">
			<?php
			if(!empty($arr_view["drugreact"])){ 
				echo  $arr_view["drugreact"];
			}
			?>
			</span>
			
			</td>
		</tr>
		<?php /*
		<tr>
		  <td align="right" class="tb_font_2">บุหรี่ :</td>
		  <td colspan="7"><input type="radio" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
ไม่เคยสูบ&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?> />
เคยสูบ แต่เลิกแล้ว
&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; } ?> />
สูบบุหรี่ เป็นครั้งคราว
&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="3" <?php if($cigarette==3){ echo "checked"; } ?> />
สูบบุหรี่ เป็นประจำ</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">สุรา : </td>
		  <td colspan="7"><input type="radio" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
ไมเคย่ดื่ม&nbsp;&nbsp;&nbsp;
<input type="radio" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> />
เคยดื่ม แต่เลิกแล้ว&nbsp;&nbsp;&nbsp;
 &nbsp;
 <input type="radio" name="alcohol" value="2" <?php if($alcohol==2){ echo "checked"; } ?> />
ดื่ม เป็นครั้งคราว&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input type="radio" name="alcohol" value="3" <?php if($alcohol==3){ echo "checked"; } ?> />
ดื่ม เป็นประจำ</td>
		  </tr>
		<?php */ ?>
		<tr>
			<td align="right" class="tb_font_2">บุหรี่ :</td>
			<td colspan="7">
				<label for="cig1">
					<input type="radio" id="cig1" name="cigarette" value="2" <?php if($cigarette==2 OR $cigarette==3){ echo "checked"; } ?>>สูบ
				</label>
				<label for="cig2">
					<input type="radio" id="cig2" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?>>ไม่สูบ
				</label>
				<label for="cig3">
					<input type="radio" id="cig3" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?>>เคยสูบ
				</label>
			</td>
		</tr>
		<tr>
			<td align="right" class="tb_font_2">สุรา :</td>
			<td colspan="7">
				<label for="alc1">
					<INPUT type="radio" id="alc1" name="alcohol" value="2" <?php if($alcohol==2 OR $alcohol==3){ echo "checked"; } ?> >ดื่ม&nbsp;&nbsp;&nbsp;
				</label>
				<label for="alc2">
					<INPUT type="radio" id="alc2" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> >ไม่ดื่ม&nbsp;&nbsp;&nbsp;
				</label>
				<label for="alc3">
					<INPUT type="radio" id="alc3" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> >เคยดื่ม
				</label>
			</td>
		</tr>
		<tr>
          <td align="right" class="tb_font_2">ออกกำลังกาย : </td>
		  <td colspan="7"><input type="radio" name="exercise" value="0" <?php if($exercise==0){ echo "checked"; } ?> />
ไม่เคยออกกำลังกาย&nbsp;&nbsp;&nbsp;
<input type="radio" name="exercise" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
ออกกำลังกาย ต่ำกว่าเกณฑ์ &nbsp;&nbsp;&nbsp;
<input type="radio" name="exercise" value="2" <?php if($exercise==2){ echo "checked"; } ?> />
ออกกำลังกาย ตามเกณฑ์ </td>
		  </tr>
	</table>
	<TABLE class="tb_font">
	</TABLE>
	<TABLE width="725" class="tb_font">
	<tr>
           <td width="101" align="right" class="tb_font_2">โรคประจำตัว :</td>
           <td width="612" colspan="5" align="left"><span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>"/>
             <input type="button" onclick="document.getElementById('congenital_disease').value='ปฎิเสธ';" name="Submit3" value="ปฎิเสธ" />
           </span></td>
         </tr>
	<tr>
	  <td align="right" class="tb_font_2">ลักษณะผู้ป่วย : </td>
	  <td colspan="5" align="left"><input name="type" type="radio" value="เดินมา"  checked="checked" />
เดินมา
  <input name="type" type="radio" value="นั่งรถเข็น" />
นั่งรถเข็น
<input name="type" type="radio" value="นอนเปล" />
นอนเปล
<input name="type" type="radio" value="ญาติ" />
ญาติ</td><!--onclick="clear_textbox();" -->
	  </tr>
	</TABLE>
	<TABLE class="tb_font">
	  <tr>
           <td align="right" valign="top" class="tb_font_2">อาการ : </td>
           <td colspan="2" align="left" valign="top"><textarea id="organ" name="organ" cols="40" rows="6" >ตรวจสุขภาพประจำปี</textarea> &nbsp;&nbsp;</td>
           <td colspan="2" align="left" valign="top">
		   <table border="0">
               <tr>
                 <td align="left"><select name="choose_organ" onchange="if(this.value != ''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}" style="position: absolute;">
                   <option value="">--- ตัวช่วย ---</option>
                     <?php
			 foreach($choose as $value){
			 	echo "<option value='".$value."'>".$value."</option>";
			 }
			 ?>
              </select></td>
                </tr>
				<tr>
                 <td align="left"><br />
<select name="select" onchange="if(this.value !=''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}" style="position: absolute;">
                     <option value="">--- อาการเดิม ---</option>
                     <?php
			 foreach($choose2 as $value){
			 	echo "<option value='".$value."'>".$value."</option>";
			 }
			 ?>
                          </select></td>
                </tr>
             </table></td>
         </tr>
	</TABLE>
	<TABLE class="tb_font">
	<tr>
           <td align="right" class="tb_font_2">คลินิก : </td>
           <td align="left" colspan="5">
			<select name="clinic" id="clinic">
				<option value='' >-- กรุณาเลือกคลินิก --</option>
				<option value='12 เวชปฏิบัติ' selected>เวชปฏิบัติ</option>
				<option value='01 อายุรกรรม'>อายุรกรรม</option>
				<option value='02 ศัลยกรรม'>ศัลยกรรม</option>
				<option value='03 สูติกรรม'>สูติกรรม</option>
				<option value='04 นารีเวชกรรม'>นารีเวชกรรม</option>
				<option value='05 กุมารเวช'>กุมารเวช</option>
				<option value='06 โสต ศอ นาสิก'>โสต สอ นาสิก</option>
				<option value='07 จักษุ'>จักษุ</option>
				<option value='08 ศัลยกรรมกระดูก'>ศัลยกรรมกระดุก</option>
				<option value='08 ศัลยกรรมทางเดินปัสสาวะ'>ศัลยกรรมทางเดินปัสสาวะ</option>
				<option value='09 จิตเวช'>จิตเวช</option>
				<option value='10 รังษีวิทยา'>รังษีวิทยา</option>
				<option value='11 ทันตกรรม'>ทันตกรรม</option>
				<?php
				if($_SESSION["smenucode"] != "ADMMAINOPD"){
					?>
					<option value='12 เวชศาสตร์ฟื้นฟู'>เวชศาสตร์ฟื้นฟู</option>
					<?php
				}
				?>
				<option value='12 อื่นๆ'>อื่นๆ</option>
             </select>
			 </td>
         </tr>
         <tr>
           <td align="right" class="tb_font_2">แพทย์ : </td>
           <td align="left" colspan="5">
			<?php
			$sql = "SELECT name FROM doctor WHERE status = 'y' ";
			$items = DB::select($sql);
			?>
			<select name="doctor" id="doctor">
				<option value="" >-- กรุณาเลือกแพทย์ --</option>
				<option value="ห้องตรวจโรคทั่วไป" >ห้องตรวจโรคทั่วไป</option>
			<?php 
			foreach($items as $item){
				$selected = $doctor==$$item['name'] ? 'selected="selected"' : '' ;
				?>
				<option value="<?php echo $item['name'];?>" <?php echo $selected;?> ><?php echo $item['name'];?></option>
				<?php
			}
			?>
             </select>
			</td>
         </tr>
	</TABLE>
		</TD>
	</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<BR>

<!-- ผลการตรวจทางพยาธิ -->
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;&nbsp;&nbsp;ผลการตรวจทางพยาธิ เมื่อวันที่ <?php echo $lab_date;?></TD>
	</TR>
	<TR class="tb_font">
		<TD>
	&nbsp;&nbsp; <span class="style5">UA :</span> 
	  <table>
		<tr>
			<?php
			$i = 1;
			foreach($test_ua as $item){
				$labname = $item['labcode'];
				
				if($labname == "OTHERU"){
					$size="13";
				}else{
					$size="6";
				}
			
				?>
				<td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
				<td>&nbsp;<input name="<?php echo  $list_ua[$labname];?>" type="text" value="<?php echo $item['result'];?>"  size="<?php echo $size;?>" readonly /></td>
				<?php 
				if($i > 0 && $i%5==0) echo "<tr></tr>";
				$i++;
			}
			?>
		</tr>
	  </table>
	  <hr />
	  &nbsp;&nbsp; <span class="style5">CBC :</span> 
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
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_cbc[$labname];?>" type="text" value="<?php echo $labresult;?>"  size="<?php echo $size;?>" readonly />&nbsp;<?php //echo //$unit;?>&nbsp;</td>
          <input type="hidden" name="<?=$labname?>range" value="<?=$normalrange?>" />
          <input type="hidden" name="<?=$labname?>flag" value="<?=$flag?>" />
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>
		  </tr>
      </table>
	  <hr />
	  <table border="0">
	  <tr>
	  <?php
	  $i=1;
	  	while(list($labname,$labresult, $unit,$normalrange,$flag) = mysql_fetch_row($result_lab)){

			//if(!empty($arr_dxofyear[$list_lab[$labname]]))
			//$labresult = $arr_dxofyear[$list_lab[$labname]];

	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_lab[$labname];?>" type="text" value="<?php echo $labresult;?>" size="6" readonly />&nbsp;<?php //echo $unit;?>
&nbsp;</td>
		 <input type="hidden" name="<?=$labname?>range" value="<?=$normalrange?>" />
          <input type="hidden" name="<?=$labname?>flag" value="<?=$flag?>" />
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>
		  </tr>
      </table>
		</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<BR>
<!-- บันทึกการวินิฉัยจากแพทย์ -->
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;&nbsp;&nbsp;บันทึกการวินิฉัยจากแพทย์</TD>
	</TR>
	<TR class="tb_font">
		<TD>
	 <table height="60" border="0" class="tb_font">
  <tr>
    <td valign="top">&nbsp;&nbsp;
      <textarea name="dx" cols="60" rows="8" id="dx"><?php echo $arr_dxofyear["dx"]; ?></textarea></td>
    </tr>
</table>
		</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<center>
<!--<input name="submit" type="submit" value="ตกลง"  />&nbsp;&nbsp;-->
<input name="submit2" type="submit" value="ตกลง" />
</center>
<INPUT TYPE="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
</form>
<?php }?>
<?php 
// include("unconnect.inc");
?>
</body>
</html>
