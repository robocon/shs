<?php
session_start();
include("connect.inc");
include("dt_menu.php");
session_unregister("list_bill");
session_register("list_bill");
$_SESSION["list_bill"] = "";
$_POST["p_hn"] = $_SESSION["vn_now"]; //vn
$_POST["post_vn"] = 1;
$_SESSION["dt_doctor"] = $_SESSION["sOfficer"];

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

$list_lab["TRIG"] = "tg";
$list_lab["GLU"] = "bs";
$list_lab["CREA"] = "cr";
$list_lab["CHOL"] = "chol";
$list_lab["AST"] = "sgot";
$list_lab["ALT"] = "sgpt";
$list_lab["ALP"] = "alk";
$list_lab["BUN"] = "bun";
$list_lab["CREA"] = "cr";
$list_lab["URIC"] = "uric";

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=windows-874" />
<title>ตรวจสุขภาพทหาร</title>
<style>
	.font_title{font-family:"TH Sarabun New"; font-size:32px;}
	.tb_font{font-family:"TH Sarabun New"; font-size:24px;}
	.tb_font_1{font-family:"TH Sarabun New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"TH Sarabun New"; font-size:24px; background-color:#9FFF9F;}
	.head_font1{font-family:"TH Sarabun New"; font-size:24px; color:#000000; font-weight:bold;}
.tb_font_2 {
	font-family:"TH Sarabun New";
	color: #333;
	font-weight: bold;
	font-size: 18px;
}
body,td,th {
	font-family: Angsana New;
	font-size: 18px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.profile {
	font-family: "TH Sarabun New";
	color: #00F;
	font-size: 18px;
	
}
.profilevalue {
	font-family: "TH Sarabun New";
	font-size: 18px;
}
.profilehead {
	font-family: "TH Sarabun New";
	font-size: 18px;
	color: #00F;
	font-weight: bold;
}
.profilelab {
	font-family: "TH Sarabun New";
	font-size: 18px;
	color: #000;
	font-weight: bold;
}
.profileheadvalue {
	font-family: "TH Sarabun New";
	font-size: 18px;
	
}
.labfont {
	font-family:"TH Sarabun New";
	font-size: 18px;
}
.labfontlab {
	font-family:"TH Sarabun New";
	font-size: 18px;
	font-weight:bold;
	color:#FFFFFF;
}
.sum {
	font-family:"TH Sarabun New";
	font-size: 18px;
	color: #360;
	text-align: left;
}
.sum2 {
	color: #F00;
}
.sum1 {
	color: #00F;
}
.fgn {
	font-family: "TH Sarabun New";
	font-size: 18px;
	color: #00F;
	font-weight: bold;
}
.style1 {color: #FFFFFF}
</style>
<script>
function check(){
	if(document.dxdrform.normal55.checked == false&document.dxdrform.normal55.checked == false){
		alert('ยังไม่ได้เลือกค่าความดัน');
		document.dxdrform.normal55.focus();
		return false;
	}else if(document.dxdrform.normal56.checked == false&document.dxdrform.normal56.checked == false){
		alert('ยังไม่ได้เลือกค่า BMI');
		document.dxdrform.normal56.focus();
		return false;		
	}else if(document.dxdrform.normal98.checked == false&document.dxdrform.normal99.checked == false){
		alert('ยังไม่ได้เลือกผลการตรวจUA');
		document.dxdrform.normal98.focus();
		return false;
	}
	else if(document.dxdrform.normal97.checked == false&document.dxdrform.normal96.checked == false){
		alert('ยังไม่ได้เลือกผลการตรวจCBC');
		document.dxdrform.normal97.focus();
		return false;
	}
	else if(document.dxdrform.normal58.checked == false&document.dxdrform.normal57.checked == false){
		alert('ยังไม่ได้เลือกผลการตรวจเอ็กซ์เรย์ปอด');
		document.dxdrform.normal58.focus();
		return false;
	}else if(document.dxdrform.normal61.checked == false&document.dxdrform.normal62.checked == false&document.dxdrform.normal63.checked == false&document.dxdrform.normal64.checked == false&document.dxdrform.normal65.checked == false&document.dxdrform.normal66.checked == false){
		alert('ยังไม่ได้เลือกสรุปผลการตรวจ');
		document.dxdrform.normal61.focus();
		return false;
	}else{
		return true;
	}
}
function togglediv1(divid){ 
	if(document.getElementById(divid).style.display == 'none'){ 
		document.getElementById(divid).style.display = 'block'; 
	}else{
		//sss
	}
}
function togglediv2(divid){ 
	if(document.getElementById(divid).style.display == 'block'){ 
		document.getElementById(divid).style.display = 'none'; 
	}else{
		document.getElementById(divid).style.display = 'none'; 
	}
}

</script>
</head>

<body>


<!--<form action="dxdr_ofyear1.php" method="post" name="selecthn">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">กรอกหมายเลข VN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/>&nbsp;<input type="submit" name="Submit" value="ตกลง" /></TD>
	</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<input name="post_vn" type="hidden" value="1" />
</form>-->

<?php if(!empty($_POST["post_vn"]) && $_POST["p_hn"] != ""){
		////*runno ตรวจสุขภาพ*/////////
	$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
		$showyear="25".$nPrefix;
	////*runno ตรวจสุขภาพ*/////////
	
//ค้นหา hn จาก opday ****************************************************************************************
	$date_now = (date("Y")+543).date("-m-d");
	$sqlvn = "Select * From opday where  vn = '".$_POST["p_hn"]."' and thidate like '$date_now%' limit 0,1";
	$resultvn= mysql_query($sqlvn);
	$queryvn = mysql_fetch_array($resultvn);
	
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '".$queryvn['hn']."' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql) or die("Error line 117 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>ผู้ป่วยยังไม่ได้ทำการลงทะเบียน</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_assoc($result);

//$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1";
//list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));

$date_hn = date("Y-m-d").$queryvn['hn'];
$date_vn = date("Y-m-d").$queryvn['vn'];
$arr_view["hn"] = $queryvn['hn'];
$sql = "Select  weight, height From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height) = Mysql_fetch_row($result);


$sqlvn = "Select vn From dxofyear  where  hn = '".$_POST["p_hn"]."' limit 0,1";
list($vn) = mysql_fetch_row(mysql_query($sqlvn));

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	//$sql = "Select dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
	//$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	//list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);

//ค้นหาผลการตรวจทางพยาธิ ****************************************************************************************

	$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."'  AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix')  Order by a.autonumber DESC limit 0,1";
	//echo $sql;
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	/*$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54' ) Order by labcode ASC ";
	
	$result_ua = mysql_query($sql);

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);*/
//ค้นหาข้อมูลเดิม
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	//$sql = "Select * From  `dxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";

	$sql = "Select * From  `dxofyear` where yearchk = '$nPrefix' AND hn='".$arr_view["hn"]."' limit 0,1 ";
	
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	$result_dx = mysql_fetch_array($result);
	if($count > 0){
		$result = mysql_query($sql);
		$arr_dxofyear = mysql_fetch_assoc($result);
		
		
		$height = $arr_dxofyear["height"];
		$weight = $arr_dxofyear["weight"];
		
		if($arr_dxofyear["cigarette"] == '1'){ $cigarette1 = "Checked";}else if($arr_dxofyear["cigarette"] == '0'){$cigarette0 = "Checked";}else if($arr_dxofyear["cigarette"] == '2'){$cigarette2 = "Checked";}else if($arr_dxofyear["cigarette"] == '3'){$cigarette3 = "Checked";}
		if($arr_dxofyear["alcohol"] == '1'){ $alcohol1 = "Checked";}else if($arr_dxofyear["alcohol"] == '0'){$alcohol0 = "Checked";}else if($arr_dxofyear["alcohol"] == '2'){$alcohol2 = "Checked";}else if($arr_dxofyear["alcohol"] == '3'){$alcohol3 = "Checked";}
		if($arr_dxofyear["exercise"] == '1'){ $exercise1 = "Checked";}else if($arr_dxofyear["exercise"] == '0'){$exercise0 = "Checked";}else if($arr_dxofyear["exercise"] == '2'){$exercise2 = "Checked";}
		if($arr_dxofyear["congenital_disease"] != ''){ $congenital_disease = $arr_dxofyear["congenital_disease"];}else{$congenital_disease = "ปฎิเสธโรคประจำตัว";}
		$rowid = $arr_dxofyear['row_id'];
		
	}else{
		$sql = "Select drugreact,congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN exercise = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN exercise = '0'THEN 'Checked' ELSE '' END ),(CASE WHEN cigarette = '2'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '2'THEN 'Checked' ELSE '' END ), (CASE WHEN exercise = '2'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '3'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '3'THEN 'Checked' ELSE '' END )   From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";

		$result = Mysql_Query($sql);
		list($drugreact,$congenital_disease, $weight, $height, $cigarette1, $alcohol1,$exercise1, $cigarette0, $alcohol0, $exercise0, $cigarette2, $alcohol2,$exercise2, $cigarette3, $alcohol3) = Mysql_fetch_row($result);
			if($congenital_disease == "")
				$congenital_disease = "ปฎิเสธโรคประจำตัว";

	}
	
	if($arr_dxofyear["rate"] == ""){
		$arr_dxofyear["rate"] = 20;
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
$_SESSION["hn_now"] = $arr_view["hn"];

?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM name="dxdrform" METHOD="post" ACTION="dxdr_ofyear_save1.php"   onsubmit="return check()" target="_blank">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_dxofyear["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $queryvn['vn'];?>" />
<br />
<p align="center" class="head_font1"><strong>บันทึกผลการตรวจสุขภาพทหารประจำปี <?=$showyear;?></strong></p>
<table  width="100%" border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td align="left" bgcolor="#0099CC" class="tb_font_1" colspan="12">&nbsp;&nbsp;&nbsp;ข้อมูลผู้ป่วย</td>
    </tr>
    <tr>
      <td width="148" align="left" class="profilehead">VN</td>
      <td width="10" align="left" class="profile"> :</td>
      <td width="197"  class="profileheadvalue">&nbsp;<?php echo $queryvn["vn"];?></td>
      <td width="91" rowspan="2" align="left" valign="bottom" class="profilehead">ชื่อ-สกุล </td>
      <td width="10" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="217" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_view["ptname"];?></td>
      <td width="145" rowspan="2" align="left" valign="bottom" class="profilehead">สังกัด </td>
      <td width="10" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="211" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_view["camp"];?></td>
      <input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/>
      <td width="89" rowspan="2" align="left" valign="bottom" class="profilehead">อายุ</td>
      <td width="9" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="216" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_view["age"];?></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">HN </td>
      <td align="left" class="profile">:</td>
      <td class="profileheadvalue">&nbsp;<?php echo $arr_view["hn"];?></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">ส่วนสูง </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $height; ?> ซม.</td>
      <td align="left" class="profilehead">น้ำหนัก</td>
      <td align="left" class="profile">:</td>
      <td align="left" class="profilevalue">&nbsp;<?php echo $weight; ?> กก. </td>
      <td align="left" class="profilehead">รอบเอว </td>
      <td align="left" class="profile">:</td>
      <?
			$ht = $height/100;
            $bmi = number_format($weight/($ht*$ht),2);
			?>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["round_"]; ?> ซม.</td>
      <td align="left" class="profilehead">BMI</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><span style="color:#F00">&nbsp;<?php echo $bmi; ?></span></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">T </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["temperature"]; ?> C&deg;</td>
      <td align="left" class="profilehead">P </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["pause"]; ?> ครั้ง/นาที</td>
      <td align="left" class="profilehead">R </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["rate"]; ?> ครั้ง/นาที</td>
      <td align="left" class="profilehead">BP </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["bp1"]; ?> / <?php echo $arr_dxofyear["bp2"]; ?> mmHg</td>
    </tr>
    <tr>
      <td align="left" class="profilehead">บุหรี่ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['cigarette']=="0"){ echo "ไม่เคยสูบบุหรี่";}else if($arr_dxofyear['cigarette']=="1"){ echo "เคยสูบ แต่เลิกแล้ว";}else if($arr_dxofyear['cigarette']=="2"){ echo "สูบบุหรี่ เป็นครั้งคราว";}else if($arr_dxofyear['cigarette']=="3"){ echo "สูบบุหรี่ เป็นประจำ";} ?></td>
      <td align="left" class="profilehead">สุรา</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['alcohol']=="0"){ echo "ไม่เคยดื่ม";}else if($arr_dxofyear['alcohol']=="1"){ echo "เคยดื่ม แต่เลิกแล้ว";}else if($arr_dxofyear['alcohol']=="2"){ echo "ดื่ม เป็นครั้งคราว";}else if($arr_dxofyear['alcohol']=="3"){ echo "ดื่ม เป็นประจำ";} ?></td>
      <td align="left" class="profilehead">ออกกำลังกาย</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;
          <? if($arr_dxofyear['exercise']=="0"){ echo "ไม่เคยออกกำลังกาย";} else if($arr_dxofyear['exercise']=="1"){ echo "ออกกำลังกาย ต่ำกว่าเกณฑ์";} else{ echo "ออกกำลังกาย ตามเกณฑ์";} ?></td>
      <td align="left" class="profilehead">แพ้ยา</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;
          <? if($arr_dxofyear['drugreact']=="0"){ echo "ไม่แพ้ยา";}else{ echo "<span style='color:#F00'>".$arr_view['drugreact']."</span>";} ?></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">โรคประจำตัว</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $congenital_disease;?></td>
      <td align="left" class="profilehead">อาการ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear['organ'];?></td>
      <td class="profilehead">กรุ๊ปเลือด</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?=$arr_dxofyear['blood']?></td>
      <td align="left" class="profilehead">แพทย์ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;
        <?php 
		$namedoc = explode(" ",$_SESSION["dt_doctor"]);
		$doctor = $namedoc[0]." ".$namedoc[1];
		$sql = "Select name From doctor where status = 'y' and name like '%$doctor%' ";
		$result = mysql_query($sql);
		$num = mysql_num_rows($result);
		list($name) = mysql_fetch_row($result);
		if($num>0){ echo $name; echo "<input type='hidden' name='doctorn' value='".$name."'";
		}else{ echo $_SESSION["sOfficer"]; echo "<input type='hidden' name='doctorn' value='".$_SESSION["sOfficer"]."'";}
		?></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td bgcolor="#FFCC99" class="profile"  style="color:#000"><strong>ค่าความดัน</strong></td>
	    <td bgcolor="#FFCC99"><span class="profile">:</span></td>
	    <td bgcolor="#FFCC99" class="profilevalue"><input name='normal55' type='radio' value='ปกติ' onclick="togglediv2('acnormal55')" <?  if($arr_dxofyear["bp1"] < 129 && $arr_dxofyear["bp2"] < 89){ echo "checked";}?>/>
ปกติ
<input name='normal55' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal55')"  <?  if(($arr_dxofyear["bp1"] >= 130 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >= 129 && $arr_dxofyear["bp2"] <= 89) || ($arr_dxofyear["bp1"] <= 129 && $arr_dxofyear["bp2"] >= 89)){ echo "checked";}?>/>
	      <?  
		  if(($arr_dxofyear["bp1"] >= 130 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >= 129 && $arr_dxofyear["bp2"] <= 89) || ($arr_dxofyear["bp1"] <= 129 && $arr_dxofyear["bp2"] >= 89)){
		  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
		  }else{
		  	echo "ผิดปกติ";
		  }
		  ?>
        </td>
	    <td colspan="9" bgcolor="#FFCC99" class="profilevalue">
         <div id="acnormal55" <? if($arr_dxofyear["bp1"] < 129 && $arr_dxofyear["bp2"] < 89){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
	      <select name="ch55" >
	        <option value="ความดันโลหิต เกือบสูง PRE-HT" <? if($arr_dxofyear["bp1"] >= 135 && $arr_dxofyear["bp1"] <= 139){ echo "selected='selected';";}?>>ความดันโลหิต เกือบสูง PRE-HT</option>
	        <option value="ท่านมีความดันโลหิตสูง ควรต้องควบคุมอาหารอย่างเคร่งครัด โดยเฉพาะอาหารที่มีรสเค็มและออกกำลังกาย" <? if(($arr_dxofyear["bp1"] >=140 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >=140 && $arr_dxofyear["bp2"] <= 90) || ($arr_dxofyear["bp1"] <=140 && $arr_dxofyear["bp2"] >= 90)){ echo "selected='selected';";}?>>ท่านมีความดันโลหิตสูง ควรต้องควบคุมอาหารอย่างเคร่งครัด โดยเฉพาะอาหารที่มีรสเค็มและออกกำลังกาย</option>
	        </select>
	      </div></td>
	    </tr>
    <tr bgcolor="#FFCC99">
      <td class="profile"  style="color:#000"><strong>ค่า BMI</strong></td>
      <td><span class="profile">:</span></td>
      <td class="profilevalue"><input name='normal56' type='radio' value='ปกติ' onclick="togglediv2('acnormal56')" id="normal56"  <?  if($bmi >= 18.5 && $bmi <= 22.99){ echo "checked";}?>/>
        ปกติ
        <input name='normal56' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal56')" id="normal56"  <?  if($bmi < 18.5 || $bmi > 22.99){ echo "checked";}?>/>
	      <?  
		  if($bmi < 18.5 || $bmi > 22.99){
		  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
		  }else{
		  	echo "ผิดปกติ";
		  }
		  ?>        
      </td>
      <td colspan="9" bgcolor="#FFCC99" class="profilevalue">
      <div id="acnormal56" <? if($bmi >= 18.5 && $bmi <= 22.99){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
	      <select name="ch56" >
	        <option value="ท่านมีน้ำหนักน้อยเกินไป" <? if($bmi < 18.5){ echo "selected='selected';";}?>>ท่านมีน้ำหนักน้อยเกินไป</option>
	        <option value="ท่านเริ่มมีภาวะน้ำหนักเกิน" <? if($bmi >= 23 && $bmi <= 24.99){ echo "selected='selected';";}?>>ท่านเริ่มมีภาวะน้ำหนักเกิน</option>
	        <option value="ท่านมีน้ำหนักเกินหรือภาวะอ้วน" <? if($bmi >= 25 && $bmi <= 29.99){ echo "selected='selected';";}?>>ท่านมีน้ำหนักเกินหรือภาวะอ้วน</option>
	        <option value="ท่านมีภาวะอ้วนค่อนข้างมาก" <? if($bmi >= 30 && $bmi <= 34.99){ echo "selected='selected';";}?>>ท่านมีภาวะอ้วนค่อนข้างมาก</option>
	        <option value="ท่านมีภาวะอ้วนรุนแรง" <? if($bmi >= 35){ echo "selected='selected';";}?>>ท่านมีภาวะอ้วนรุนแรง</option>            
	        </select>
	      </div></td>
      </tr>
  </table></td></tr>
</table>
<BR>
<TABLE border="2" cellpadding="2" cellspacing="0" bordercolor="#393939" width="100%">
<TR>
	<TD><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
	  <tr>
	    <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="8">&nbsp;&nbsp;&nbsp;การตรวจร่างกายทบ.</td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td width="36%" class="profilehead">ก. ลักษณะทั่วไป</td>
	    <td width="18%" class="profilevalue"><input name='normal21' type='radio' onclick="togglediv2('acnormal21')" value='ปกติ' checked="checked"/>
	      ปกติ
	        <input name='normal21' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal21')"/>
	      ผิดปกติ </td>
	    <td width="46%">
  <div style="display:none" id="acnormal21"><input name="text21" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">ข. ผิวหนัง</td>
	    <td class="profilevalue"><input name='normal22' type='radio' onclick="togglediv2('acnormal22')" value='ปกติ' checked="checked"/>
	      ปกติ
	        <input name='normal22' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal22')"/>
	      ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal22"><input name="text22" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">ค. ทางเดินแห่งอาหาร</td>
	    <td class="profilevalue"><input name='normal23' type='radio' onclick="togglediv2('acnormal23')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal23' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal23')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal23"><input name="text23" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">ง. ทางเดินแห่งลมหายใจ</td>
	    <td class="profilevalue"><input name='normal24' type='radio' onclick="togglediv2('acnormal24')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal24' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal24')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal24"><input name="text24" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">จ. ทางเดินแห่งโลหิต</td>
	    <td class="profilevalue"><input name='normal25' type='radio' onclick="togglediv2('acnormal25')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal25' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal25')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal25"><input name="text25" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">ฉ. ทางเดินแห่งน้ำเหลือง</td>
	    <td class="profilevalue"><input name='normal26' type='radio' onclick="togglediv2('acnormal26')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal26' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal26')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal26"><input name="text26" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">ช. ทางเดินแห่งปัสสาวะและอวัยวะสืบพันธุ์</td>
	    <td class="profilevalue"><input name='normal27' type='radio' onclick="togglediv2('acnormal27')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal27' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal27')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal27"><input name="text27" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">ซ. สมองและประสาท</td>
	    <td class="profilevalue"><input name='normal28' type='radio' onclick="togglediv2('acnormal28')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal28' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal28')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal28"><input name="text28" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">ญ. กระดูกและข้อ</td>
	    <td class="profilevalue"><input name='normal29' type='radio' onclick="togglediv2('acnormal29')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal29' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal29')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal29"><input name="text29" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profilehead">ด. ตา, หู, คอ, จมูก</td>
	    <td class="profilevalue"><input name='normal30' type='radio' onclick="togglediv2('acnormal30')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal30' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal30')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal30"><input name="text30" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  </table></td>
</tr>
</table>
<br />
<!-- ผลการตรวจทางพยาธิ -->
<TABLE border="2" cellpadding="2" cellspacing="0" bordercolor="#000000"  width="100%">
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0"  width="100%" bgcolor="#FFFFCC">
	<TR>
		<TD align="left" class="tb_font_1" bgcolor="#339999">&nbsp;&nbsp;&nbsp;ผลการตรวจทางพยาธิ เมื่อวันที่ <span style="color: #000000;"><?php echo $lab_date;?></span></TD>
	</TR>
	<TR class="tb_font">
		<TD >
	&nbsp;&nbsp; <span class="style5">UA :</span> 
       
	  <?php
	  /*$i=1;
	  	while(list($labname,$labresult,$unit,$normalrange,$flag) = mysql_fetch_row($result_ua)){
		if($labname == "OTHERU"){
			$size="13";
		}else{
			$size="6";
		}

		if(!empty($arr_dxofyear[$list_ua[$labname]]))
			$labresult = $arr_dxofyear[$list_ua[$labname]];
			<!--<td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<strong><?php  if($flag!="N")  echo "<span class='style6'>".$labresult."</span>"; else echo $labresult;?></strong></td>-->*/
	  ?>
      <table width="100%" border="0">
          <tr>
	    <td width="8%" align="right" class="profilelab">Color:</td>
	    <td width="10%" class="fgn" ><strong>
	      <?=$result_dx['ua_color']?>
	    </strong></td>
	    <td width="10%" align="right" class="profilelab">SP.Gr:</td>
	    <td width="9%" class="fgn"><strong>
	      <?=$result_dx['ua_spgr']?>
	    </strong></td>
	    <td width="13%"  align="right" class="profilelab">PH:</td>
	    <td width="10%" class="fgn" ><strong>
	      <?=$result_dx['ua_phu']?>
	    </strong></td>
	    <td width="10%"  align="right" class="profilelab">Blood:</td>
	    <td width="11%" class="fgn"  ><strong>
	      <?=$result_dx['ua_bloodu']?>
	    </strong></td>
	    <td width="10%" align="right" class="profilelab">Protien:</td>
	    <td width="9%" class="fgn"><strong>
	      <?=$result_dx['ua_prou']?>
	    </strong></td></tr>
      <tr>
        <td align="right" class="profilelab">Sugar:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_gluu']?>
        </strong></td>
        <td align="right" class="profilelab">Ketone:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_ketu']?>
        </strong></td>
        <td align="right" class="profilelab">Urobillinogen:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_urobil']?>
        </strong></td>
        <td align="right" class="profilelab">Billirubin</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_bili']?>
        </strong></td>
        <td align="right" class="profilelab">Nitrite</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_nitrit']?>
        </strong></td></tr>
      <tr>
        <td align="right" class="profilelab">Crystal:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_crystu']?>
        </strong></td>
        <td align="right" class="profilelab">Casts:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_castu']?>
        </strong></td>
        <td align="right" class="profilelab">Epithelial:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_epiu']?>
        </strong></td>
        <td align="right" class="profilelab">WBC:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_wbcu']?>
        </strong></td>
        <td align="right" class="profilelab">RBC:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_rbcu']?>
        </strong></td></tr>
      <tr>
        <td align="right" class="profilelab">Amorphous:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_amopu']?>
        </strong></td>
        <td align="right" class="profilelab">Bacteria:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_bactu']?>
        </strong></td>
        <td align="right" class="profilelab">Mucus:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_mucosu']?>
        </strong></td>
        <td align="right" class="profilelab">Yeast:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_yeast']?>
        </strong></td>
        <td align="right" class="profilelab">Appear:</td>
        <td class="fgn"><strong>
          <?=$result_dx['ua_appear']?>
        </strong></td></tr>
      <tr>
        <td align="right" class="profilelab">Otheru:</td>
        <td class="fgn"><strong>
          <?=$result_dx['otheru']?>
        </strong></td>
		<td>&nbsp;</td>
		<td>&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
		<td align="center">&nbsp;</td>
        </tr>
      <tr bgcolor="#CCCCFF">
        <td colspan="4" align="center" bgcolor="#FFCC99"><strong>ผลการตรวจ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
          <input name='normal' type='radio' value='ปกติ' onclick="togglediv2('acnormal')" id="normal98" />
          ปกติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name='normal' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal')" id="normal99" />
          ผิดปกติ </td>
        <td colspan="6" bgcolor="#FFCC99">
          <div id="acnormal" style='display: none;'>
            <select name='ch'>
              <option value='เม็ดเลือดแดงในปัสสาวะสูงเกินปกติ'>เม็ดเลือดแดงในปัสสาวะสูงเกินปกติ</option>
              <option value='เม็ดเลือดขาวในปัสสาวะสูงเกินปกติ'>เม็ดเลือดขาวในปัสสาวะสูงเกินปกติ</option>
              <option value='มีไข่ขาวรั่วในปัสสาวะ'>มีโปรตีนรั่วในปัสสาวะ</option>
              <option value='ค่ากรด - ด่าง'>ค่ากรด - ด่าง</option>
            </select></div></td>
        </tr>
    <?
	/*if($i%5==0) echo "<tr></tr>";
	$i++;*/
	
			//}
			?>
      </table>
	  <hr />
	  &nbsp;&nbsp; <span class="style5">CBC :</span> 
	<table width="100%" border="0">
	  
	  <?php
	  //$i=1;
	  /*$lab_cbcvalue = array();
	  $lab_cbcrange = array();
	  $lab_cbcflag = array();
	  if(mysql_num_rows($result_cbc)>0){
	  	while(list($labname,$labresult, $unit,$normalrange,$flag) = mysql_fetch_row($result_cbc)){
		array_push($lab_cbcvalue,$labresult);
		array_push($lab_cbcrange,$normalrange);
		array_push($lab_cbcflag,$flag);
		/*		if($labname == "OTHER" || $labname == "PLTS"){
			$size="13";
		}else{
			$size="6";
		}
		}*/

		/*if(!empty($arr_dxofyear[$list_cbc[$labname]]))
			$labresult = $arr_dxofyear[$list_cbc[$labname]];*/
	  ?>
          <tr>
          <td width="10%"  align="right" class="profilelab">WBC :</td>
          <td width="8%" class="fgn" ><strong><?=$result_dx['cbc_wbc']?></strong></td>
          <td width="9%"  align="right" class="profilelab">HCT : </td>
          <td width="10%" class="fgn" ><strong><?=$result_dx['cbc_hct']?></strong></td>
          <td width="10%"  align="right" class="profilelab">NEU :</td>
          <td width="8%" class="fgn" ><strong><?=$result_dx['cbc_neu']?></strong></td>
          <td width="12%"  align="right" class="profilelab">LYMP : </td>
          <td width="10%" class="fgn" ><strong><?=$result_dx['cbc_lymp']?></strong></td>
          <td width="10%"  align="right" class="profilelab">MONO : </td>
          <td width="13%" class="fgn" ><strong><?=$result_dx['cbc_mono']?></strong></td>
		  </tr>
          <tr>
            <td align="right" class="profilelab">EOS : </td>
            <td class="fgn"><strong><?=$result_dx['cbc_eos']?></strong></td>
            <td align="right" class="profilelab">MCV :</td>
            <td class="fgn"><strong><?=$result_dx['cbc_mcv']?></strong></td>
            <td align="right" class="profilelab">MCH :</td>
            <td class="fgn"><strong><?=$result_dx['cbc_mch']?></strong></td>
            <td align="right" class="profilelab">MCHC : </td>
            <td class="fgn"><strong><?=$result_dx['cbc_mchc']?></strong></td>
            <td align="right" class="profilelab">PLTS :</td>
            <td class="fgn"><strong><?=$result_dx['cbc_plts']?></strong></td>
          </tr>
          <tr>
          <td align="right" class="profilelab">OTHER : </td>
          <td class="fgn"><strong><?=$result_dx['cbc_other']?></strong></td>
          <td align="right" class="profilelab">NRBC : </td>
          <td class="fgn"><strong><?=$result_dx['cbc_nrbc']?></strong></td>
          <td align="right" class="profilelab">RBC :</td>
          <td class="fgn"><strong><?=$result_dx['cbc_rbc']?></strong></td>
          <td align="right" class="profilelab">RBCMOR : </td>
          <td class="fgn"><strong><?=$result_dx['cbc_rbcmor']?></strong></td>
          <td align="right" class="profilelab">HB :</td>
          <td class="fgn"><strong><?=$result_dx['cbc_hb']?></strong></td>
		  </tr>
          <tr>
            <td align="right" class="profilelab">BASO :</td>
            <td class="fgn"><strong><?=$result_dx['cbc_baso']?></strong></td>
            <td align="right" class="profilelab">ATYP :</td>
            <td class="fgn"><strong><?=$result_dx['cbc_atyp']?></strong></td>
            <td align="right" class="profilelab">BAND :</td>
            <td class="fgn"><strong><?=$result_dx['cbc_band']?></strong></td>
            <td align="right" class="profilelab">PLTC : </td>
            <td class="fgn"><strong><?=$result_dx['cbc_pltc']?></strong></td>
            <td align="right" class="tb_font_2">&nbsp;</td>
            <td>&nbsp;</td>
          </tr>
          <tr>
          <td colspan="10">
          	</td></tr>
          <?
	//  }
		  ?>
      </table>
<table border="0" width="100%">
          <tr>
            <td align="right" class="profilelab" width="80">HCT : </td>
            <td width="44" class="fgn">
            <? 
			if($result_dx['cbc_hct'] < 37){
				echo "<span style='color:#F00'><strong>$result_dx[cbc_hct]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[cbc_hct]</span>";
			}
			?>            
            </td>
            <td class="labfont"  width="101">(<?=$result_dx['hctrange']?>)</td>
            <td width="32" align="center" class="labfont" ><span <? if($result_dx['hctflag']!="N") echo " style='color:#F00'";?>><?=$result_dx['hctflag']?></span></td>
            <td width="202" class="labfont"><input name='normal31' type='radio' value='ปกติ' onclick="togglediv2('acnormal31')" <? if($result_dx['cbc_hct'] >= 37) echo "checked";?> />
              ปกติ 
              <input name='normal31' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal31')" <? if($result_dx['cbc_hct'] < 37) echo "checked";?>/>
              <? 
			  if($result_dx['cbc_hct'] < 37){
			  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			  }else{
			  	echo "ผิดปกติ";
			  }
			  ?>
              </td>
              <td width="877">
              <div id="acnormal31" <? if($result_dx['cbc_hct'] >= 37) echo "style='display: none;'"; else "style='display: block;'"; ?>>
      <select name='ch31'>
          <option value='มีระดับเม็ดเลือดแดงต่ำกว่าปกติ บ่งบอกถึงภาวะซีดควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ'>มีระดับเม็ดเลือดแดงต่ำกว่าปกติ บ่งบอกถึงภาวะซีดควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ</option>
     </select></div></td>
          </tr>
          <tr>
          <td align="right" class="profilelab" width="80">WBC : </td>
          <td width="44" class="fgn">
            <? 
			if($result_dx['cbc_wbc'] < 3 || $result_dx['cbc_wbc'] > 15){
				echo "<span style='color:#F00'><strong>$result_dx[cbc_wbc]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[cbc_wbc]</span>";
			}
			?>           
          </td>
          <td class="labfont" width="101">(<?=$result_dx['wbcrange']?>)</td>
          <td align="center" class="labfont" width="32" ><span <? if($result_dx['wbcflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['wbcflag'];?></span></td>
          <td width="202" class="labfont"><input name='normal32' type='radio' value='ปกติ' onclick="togglediv2('acnormal32')" <? if($result_dx['cbc_wbc'] >= 3 &&  $result_dx['cbc_wbc'] <= 15){ echo "checked";}?>/>
          ปกติ 
            <input name='normal32' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal32')" <? if($result_dx['cbc_wbc'] < 3 || $result_dx['cbc_wbc'] > 15){ echo "checked";}?>/>
              <? 
			  if($result_dx['cbc_wbc'] < 3 || $result_dx['cbc_wbc'] > 15){
			  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			  }else{
			  	echo "ผิดปกติ";
			  }
			  ?>
            </td>
            <td><div id="acnormal32" <? if($result_dx['cbc_wbc'] >= 3 &&  $result_dx['cbc_wbc'] <= 15){ echo "style='display: none;'";}else{ echo "style='display: block;'";} ?>>
            <select name='ch32'>
              <option value='ปริมาณเม็ดเลือดขาวมีค่าต่ำกว่าปกติ ควรตรวจซ้ำหรือพบแพทย์' <? if($result_dx['cbc_wbc'] < 3){ echo "selected='selected';";}?>>ปริมาณเม็ดเลือดขาวมีค่าต่ำกว่าปกติ ควรตรวจซ้ำหรือพบแพทย์</option>
              <option value='ปริมาณเม็ดเลือดขาวอยู่ในระดับสูงเกินปกติ ควรตรวจซ้ำหรือพบแพทย์' <? if($result_dx['cbc_wbc'] > 15){ echo "selected='selected';";}?>>ปริมาณเม็ดเลือดขาวอยู่ในระดับสูงเกินปกติ ควรตรวจซ้ำหรือพบแพทย์</option>              
            </select>
          </div></td>
          </tr>
          <tr>
          <td align="right" class="profilelab" width="80">PLTC : </td>
          <td width="44" class="fgn">
            <? 
			if($result_dx['cbc_pltc'] < 120 || $result_dx['cbc_pltc'] > 500){
				echo "<span style='color:#F00'><strong>$result_dx[cbc_pltc]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[cbc_pltc]</span>";
			}
			?>           
          </td>
          <td class="labfont" width="101">(<?=$result_dx['pltcrange']?>)</td>
          <td align="center" class="labfont" width="32"><span <? if($result_dx['pltcflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['pltcflag']?></span></td>
          <td width="202" class="labfont"><input name='normal33' type='radio' value='ปกติ' onclick="togglediv2('acnormal33')" <? if($result_dx['cbc_pltc'] >= 120 &&  $result_dx['cbc_pltc'] <= 500){ echo "checked";}?>/>
          ปกติ 
            <input name='normal33' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal33')" <? if($result_dx['cbc_pltc'] < 120 || $result_dx['cbc_pltc'] > 500){ echo "checked";}?>/>
              <? 
			  if($result_dx['cbc_pltc'] < 120 || $result_dx['cbc_pltc'] > 500){
			  	echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			  }else{
			  	echo "ผิดปกติ";
			  }
			  ?>            
            </td>
            <td><div id="acnormal33" <? if($result_dx['cbc_pltc'] >= 120 &&  $result_dx['cbc_pltc'] <= 500){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
       <select name='ch33'>
	  <option value='ปริมาณเกร็ดเลือดมีค่าต่ำกว่าปกติ ควรตรวจซ้ำหรือพบแพทย์' <? if($result_dx['cbc_pltc'] < 500){ echo "selected='selected';";}?>>ปริมาณเกร็ดเลือดมีค่าต่ำกว่าปกติ ควรตรวจซ้ำหรือพบแพทย์</option>
	  <option value='ปริมาณเกร็ดเลือดมีค่าสูงเกินปกติ ควรตรวจซ้ำหรือพบแพทย์' <? if($result_dx['cbc_pltc'] > 500){ echo "selected='selected';";}?>>ปริมาณเกร็ดเลือดมีค่าสูงเกินปกติ ควรตรวจซ้ำหรือพบแพทย์</option>      
	  </select></div></td>
          </tr>
          <tr bgcolor="#CCCCFF">
            <td colspan="5" align="center" bgcolor="#FFCC99"><strong>ผลการตรวจ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
              <input name='normal81' type='radio' value='ปกติ' onclick="togglediv2('acnormal81')" id="normal97" />
              ปกติ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input name='normal81' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal81')" id="normal96" />
              ผิดปกติ </td><td bgcolor="#FFCC99"><div id="acnormal81" style='display: none;'>
            <select name='ch81'>
              <option value='ควรพบแพทย์เพื่อหาสาเหตุ'>ควรพบแพทย์เพื่อหาสาเหตุ</option>
			</select></div></td>
            </tr>
            </table>
</TD></TR></TABLE>
</TD></TR></TABLE>
<br />
<?
////ผลlab ของปีที่แล้ว
////*runno ตรวจสุขภาพ*/////////
$query = "SELECT runno, prefix  FROM runno WHERE title = 's_chekup'";
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
	$nPrefix ="25".$nPrefix;
////*runno ตรวจสุขภาพ*/////////

$bsquery = "select * from condxofyear_so where hn ='".$_SESSION["hn_now"]."' and status_dr='Y' and yearcheck='".($nPrefix-2)."' ";
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);

$bquery = "select * from condxofyear_so where hn ='".$_SESSION["hn_now"]."' and status_dr='Y' and yearcheck='".($nPrefix-1)."' ";
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
?>
<table border="2" cellpadding="2" cellspacing="0" bordercolor="#000000"  width="100%" bgcolor="#FFCCCC">
  <tr><td>
	  <table width="100%" border="0">
	    <tr>
	      <td align="right" class="tb_font_2">&nbsp;</td>
	      <td align="center" bgcolor="#339999" class="profilelab"><strong><?=($nPrefix-2)?></strong></td>
          <td align="center" bgcolor="#339999" class="profilelab"><strong><?=($nPrefix-1)?></strong></td>
	      <td align="center" bgcolor="#339999" class="profilelab"><strong><?=$nPrefix?></strong></td>
	      <td class="labfont">&nbsp;</td>
	      <td align="center" class="labfont">&nbsp;</td>
	      <td class="labfont">&nbsp;</td>
	      <td colspan="4">&nbsp;</td>
	      </tr>
	    <tr>
	      <td align="right" class="profilelab">GLU :</td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bssult['bs']?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bsult['bs']?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['bs'] >= 110){
				echo "<span style='color:#F00'><strong>$result_dx[bs]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[bs]</span>";
			}
			?>        
        </td>
	    <td class="labfont">(<?=$result_dx['bsrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['bsflag']!="N"){ echo "style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['bsflag']?></span></td>
	    <td class="labfont"><input name='normal47' type='radio' value='ปกติ' onclick="togglediv2('acnormal47');" <?  if($result_dx['bs'] < 110){ echo "checked";}?>/>
ปกติ
  		<input name='normal47' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal47');" <? if($result_dx['bs'] >= 110){ echo "checked";}?>/>
            <? 
			if($result_dx['bs'] >= 110){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>  
  		</td>
	    <td colspan="4">            
        <div id="acnormal47" <? if($result_dx['bs'] < 110){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch47'>
        <option value="ระดับน้ำตาลในเลือดสูงเกินค่าปกติ มีความเสี่ยงสูงต่อการเกิดเบาหวานในอนาคต ควรเริ่มต้นควบคุมอาหาร จำพวกข้าว, แป้ง, อาหารที่มีรสชาติหวาน และตรวจซ้ำใน 1-2 ปี" <? if($result_dx['bs'] >= 100 && $result_dx['bs'] <= 125){ echo "selected='selected';";}?>>ระดับน้ำตาลในเลือดสูงเกินค่าปกติ มีความเสี่ยงสูงต่อการเกิดเบาหวานในอนาคต ควรเริ่มต้นควบคุมอาหาร และตรวจซ้ำใน 1-2 ปี</option>
        <option value="อาจเป็นโรคเบาหวาน ควรพบแพทย์เพื่อประเมินและให้การรักษา" <? if($result_dx['bs'] > 125){ echo "selected='selected';";}?>>อาจเป็นโรคเบาหวาน ควรพบแพทย์เพื่อประเมินและให้การรักษา</option>                
        </select></div></td>
	      </tr>
	    <tr>
	      <td align="right" class="profilelab">CHOL :</td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bssult['chol']?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bsult['chol']?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['chol'] >= 201){
				echo "<span style='color:#F00'><strong>$result_dx[chol]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[chol]</span>";
			}
			?>            
        </td>
	    <td class="labfont">(<?=$result_dx['cholrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['cholflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['cholflag']?></span></td>
	    <td class="labfont"><input name='normal46' type='radio' value='ปกติ' onclick="togglediv2('acnormal46');" <? if($result_dx['chol'] < 200){ echo "checked";}?> />
ปกติ
  <input name='normal46' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal46');" <? if($result_dx['chol'] >= 201){ echo "checked";}?>/>
            <? 
			if($result_dx['chol'] >= 201){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>  		
        </td>
	    <td colspan="4">          
        <div id="acnormal46" <? if($result_dx['chol'] <= 200){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch46'>
			<option value="ระดับไขมันในเลือดมีค่าผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกาย และตรวจซ้ำใน 3-6 เดือน" <? if($result_dx['chol'] > 200 && $result_dx['chol'] <= 300 ){ echo "selected='selected';";}?>>ระดับไขมันในเลือดมีค่าผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกาย และตรวจซ้ำใน 3-6 เดือน</option>
			<option value="ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['chol'] > 300){ echo "selected='selected';";}?>>ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option>                        
		</select></div>  </td>
	      </tr>
	    <tr>
	      <td align="right" class="profilelab">TRIG :</td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bssult['tg']?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bsult['tg']?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['tg'] >= 150){
				echo "<span style='color:#F00'><strong>$result_dx[tg]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[tg]</span>";
			}
			?>          
		</td>
	    <td class="labfont">(<?=$result_dx['tgrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['tgflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['tgflag']?></span></td>
	    <td class="labfont"><input name='normal48' type='radio' value='ปกติ' onclick="togglediv2('acnormal48');" <? if($result_dx['tg'] < 150){ echo "checked";}?> />
ปกติ
  <input name='normal48' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal48');"  <? if($result_dx['tg'] >= 150){ echo "checked";}?>/>
            <? 
			if($result_dx['tg'] >= 150){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>  		
        </td>
	    <td colspan="4">
        <div id="acnormal48" <? if($result_dx['tg'] < 150){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch48'>
			<option value="ระดับไขมันในเลือดมีค่าผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกาย และตรวจซ้ำใน 3-6 เดือน" <? if($result_dx['tg'] >= 150 && $result_dx['tg'] <= 400 ){ echo "selected='selected';";}?>>ระดับไขมันในเลือดมีค่าผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกาย และตรวจซ้ำใน 3-6 เดือน</option>
			<option value="ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['tg'] > 400){ echo "selected='selected';";}?>>ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option>           
        </select></div>            </td>
	      </tr>
	    <tr>
	      <td align="right" class="profilelab">BUN :</td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bssult['bun']?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bsult['bun']?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['bun'] > 20){
				echo "<span style='color:#F00'><strong>$result_dx[bun]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[bun]</span>";
			}
			?>          
        </td>
	    <td class="labfont">(<?=$result_dx['bunrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['bunflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['bunflag']?></span></td>
	    <td class="labfont"><input name='normal44' type='radio' value='ปกติ' onclick="togglediv2('acnormal44');" <? if($result_dx['bun'] <= 20){ echo "checked";}?>/>
ปกติ
  <input name='normal44' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal44');" <? if($result_dx['bun'] > 20){ echo "checked";}?>/>
            <? 
			if($result_dx['bun'] > 20){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>          
        </td>
	    <td colspan="4">
        <div id="acnormal44" <? if($result_dx['bun'] <= 20){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch44'>
        <option value="ค่าการทำงานของไตสูงกว่าปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['bun'] > 20){ echo "selected='selected';";}?>>ค่าการทำงานของไตสูงกว่าปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option>
</select></div>  </td>
	      </tr>
	    <tr>
	      <td align="right" class="profilelab">CREA :</td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bssult['cr']?>
	      </span></td>
	      <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	        <?=$bsult['cr']?>
	      </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['cr'] > 1.5){
				echo "<span style='color:#F00'><strong>$result_dx[cr]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[cr]</span>";
			}
			?>  
        </td>
	    <td class="labfont">(<?=$result_dx['crrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['crflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['crflag']?></span></td>
	    <td class="labfont"><input name='normal45' type='radio' value='ปกติ' onclick="togglediv2('acnormal45');" <? if($result_dx['cr'] <= 1.5){ echo "checked";}?> />
ปกติ
  <input name='normal45' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal45');" <? if($result_dx['cr'] > 1.5){ echo "checked";}?>/>
            <? 
			if($result_dx['cr'] > 1.5){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>  
		</td>
	    <td colspan="4">
        <div id="acnormal45" <? if($result_dx['cr'] <= 1.5){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
		<select name='ch45'>
        <option value="ค่าการทำงานของไตสูงกว่าปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['cr'] > 1.5){ echo "selected='selected';";}?>>ค่าการทำงานของไตสูงกว่าปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option>
        </select>
       </div></td>
	      </tr>
	    <tr>
          <td width="4%" align="right" class="profilelab"> ALP : </td>
          <td width="3%" align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
            <?=$bssult['alk']?>
          </span></td>
          <td width="3%" align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
            <?=$bsult['alk']?>
          </span></td>
          <td width="3%" align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['alk'] > 123){
				echo "<span style='color:#F00'><strong>$result_dx[alk]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[alk]</span>";
			}
			?>            
          	</td>
			<td width="6%" class="labfont">(<?=$result_dx['alkrange']?>)</td>
            <td width="3%" align="center" class="labfont"><span <? if($result_dx['alkflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['alkflag']?></span></td>
			<td width="10%" class="labfont"><input name='normal41' type='radio' value='ปกติ' onclick="togglediv2('acnormal41');"  <? if($result_dx['alk'] <= 123){ echo "checked";}?>/>
			ปกติ 
			  <input name='normal41' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal41');" <? if($result_dx['alk'] > 123){ echo "checked";}?>/>
            <? 
			if($result_dx['alk'] > 123){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>                  
            </td>
            <td width="68%" colspan="4">
           <div id="acnormal41" <? if($result_dx['alk'] <= 123){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
           <select name='ch41'><option value="ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['alk'] > 123){ echo "selected='selected';";}?>>ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option></select></div>            </td>
          </tr>
	  <tr>
	    <td align="right" class="profilelab">ALT :</td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$bssult['sgpt']?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$bsult['sgpt']?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['sgpt'] > 50){
				echo "<span style='color:#F00'><strong>$result_dx[sgpt]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[sgpt]</span>";
			}
			?>            
        </td>
	    <td class="labfont">(<?=$result_dx['sgptrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['sgptflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['sgptflag']?></span></td>
	    <td class="labfont"><input name='normal42' type='radio' value='ปกติ' onclick="togglediv2('acnormal42');" <? if($result_dx['sgpt'] <= 50){ echo "checked";}?>/>
ปกติ
  <input name='normal42' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal42');" <? if($result_dx['sgpt'] > 50){ echo "checked";}?>/>
            <? 
			if($result_dx['sgpt'] > 50){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>  
   
  		</td>
	    <td colspan="4">          
        <div id="acnormal42" <? if($result_dx['sgpt'] <= 50){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch42'><option value="ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['sgpt'] > 50){ echo "selected='selected';";}?>>ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option></select></div>  </td>
	    </tr>
	  <tr>
	    <td align="right" class="profilelab">AST :</td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$bssult['sgot']?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$bsult['sgot']?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['sgot'] > 40){
				echo "<span style='color:#F00'><strong>$result_dx[sgot]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[sgot]</span>";
			}
			?>         
       </td>
	    <td class="labfont">(<?=$result_dx['sgotrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['sgotflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['sgotflag']?></span></td>
	    <td class="labfont"><input name='normal43' type='radio' value='ปกติ' onclick="togglediv2('acnormal43');" <? if($result_dx['sgot'] <= 40){ echo "checked";}?>/>
ปกติ
  <input name='normal43' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal43');" <? if($result_dx['sgot'] > 40){ echo "checked";}?>/>
            <? 
			if($result_dx['sgot'] > 40){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?>    
		</td>
	    <td colspan="4">        
        <div id="acnormal43" <? if($result_dx['sgot'] <= 40){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch43'><option value="ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['sgot'] > 40){ echo "selected='selected';";}?>>ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option></select></div>  </td>
	    </tr>
	  <tr>
	    <td align="right" class="profilelab">URIC :</td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$bssult['uric']?>
	    </span></td>
	    <td align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
	      <?=$bsult['uric']?>
	    </span></td>
	    <td align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['uric'] > 7){
				echo "<span style='color:#F00'><strong>$result_dx[uric]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[uric]</span>";
			}
			?>         
        </td>
	    <td class="labfont">(<?=$result_dx['uricrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['uricflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['uricflag']?></span></td>
	    <td class="labfont"><input name='normal49' type='radio' value='ปกติ' onclick="togglediv2('acnormal49');" <? if($result_dx['uric'] <= 7){ echo "checked";}?>/>
ปกติ
  <input name='normal49' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal49');"<? if($result_dx['uric'] > 7){ echo "checked";}?>/>
            <? 
			if($result_dx['uric'] > 7){
				echo "<span style='color:#F00'><strong>ผิดปกติ</strong></span>";
			}else{
				echo "<span style='color:#000'>ผิดปกติ</span>";
			}
			?> 
		</td>
	    <td colspan="4">
        <div id="acnormal49" <? if($result_dx['uric'] <= 7){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch49'>
        <option value="ปกติ" <? if($result_dx['uric'] <= 7){ echo "selected='selected';";}?>>ปกติ</option>
        <option value="มีระดับกรดยูริคสูงผิดปกติ ควรควบคุมอาหารจำพวกเครื่องใน, อาหารทะเล, เครื่องดื่มแอลกอฮอล์" <? if($result_dx['uric'] > 7){ echo "selected='selected';";}?>>มีระดับกรดยูริคสูงผิดปกติ ควรควบคุมอาหารจำพวกเครื่องใน, อาหารทะเล, เครื่องดื่มแอลกอฮอล์</option>
        </select></div>            </td>
	    </tr>
	<?php 
	/*$i++;
			}*/?>
            </table>
        <hr />   
</TD>
	</TR>
	</TABLE>
  </TD>
</TR>
</TABLE>
<BR>
<TABLE border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" width="100%">
<TR>
	<TD><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
	  <tr>
	    <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="7">&nbsp;&nbsp;&nbsp;การตรวจอื่น ๆ</td>
	  </tr>
	  <tr bgcolor="#CCCCFF">
	    <td width="27%" align="right" bgcolor="#FFCC99" class="tb_font_2">ตรวจเอ็กซ์เรย์ปอด : <a href="dxdr_xray_film.php" target="_blank">ดูฟิลม์</a> </td>
	    <td width="21%" bgcolor="#FFCC99" class="labfont"><input name='normal51' type='radio' value='ปกติ' onclick="togglediv2('acnormal51')" id="normal58"/>
	      ปกติ
	        <input name='normal51' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal51')" id="normal57"/>
	      ผิดปกติ </td>
	    <td colspan="3" bgcolor="#FFCC99" class="labfont"><div id="acnormal51" style='display: none;'>
	      <select name="ch51" >
	        <option value="ภาพเอกซเรย์ทรวงอกไม่ชัดเจนเนื่องจากหายใจเข้าไม่เต็มที่ขณะตรวจ ควรตรวจซ้ำ">ภาพเอกซเรย์ทรวงอกไม่ชัดเจนเนื่องจากหายใจเข้าไม่เต็มที่ขณะตรวจ ควรตรวจซ้ำ</option>
	        <option value="ปอดผิดปกติเดิม ไม่เปลี่ยนแปลงเมื่อเทียบกับเอกซเรย์ปอดครั้งก่อน">ปอดผิดปกติเดิม ไม่เปลี่ยนแปลงเมื่อเทียบกับเอกซเรย์ปอดครั้งก่อน</option>
	        <option value="ปรึกษาแพทย์ทันที เพื่อตรวจรักษาเพิ่มเติม">ปรึกษาแพทย์ทันที เพื่อตรวจรักษาเพิ่มเติม</option>
	        </select>
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">ตรวจมะเร็งปากมดลูก : </td>
	    <td class="labfont"><input name='normal52' type='radio' value='ปกติ' onclick="togglediv2('acnormal52')"/>
	      ปกติ
	        <input name='normal52' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal52')"/>
	      ผิดปกติ </td>
	    <td colspan="3" class="labfont"><div id="acnormal52" style='display: none;'>
	      <select name="ch52" >
	        <option value="ช่องคลอดอักเสบ">ช่องคลอดอักเสบ</option>
	        <option value="ผนังช่องคลอดบางลง จากภาวะขาดฮอร์โมน/วัยทอง">ผนังช่องคลอดบางลง จากภาวะขาดฮอร์โมน/วัยทอง</option>
	        <option value="ปากมดลูกอักเสบ">ปากมดลูกอักเสบ</option>
	        <option value="เชื้อราในช่องคลอด">เชื้อราในช่องคลอด</option>
	        <option value="เชื้อพยาธิในช่องคลอด">เชื้อพยาธิในช่องคลอด</option>
	        <option value="เซลล์ปากมดลูกผิดปกติ">เซลล์ปากมดลูกผิดปกติ</option>
	        </select>
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">ตรวจพิเศษอื่นๆ :</td>
	    <td class="labfont"><input name="other1" type="text" size="20" /></td>
	    <td class="labfont"><input name='normal53' type='radio' value='ปกติ' onclick="togglediv2('acnormal53')"/>
ปกติ
  <input name='normal53' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal53')"/>
ผิดปกติ </td>
	    <td colspan="2"><div id="acnormal53" style='display: none;'>
	      <input name="ch53" type="text" size="50" value="พบความผิดปกติ.......ควรพบแพทย์ เพื่อตรวจหาสาเหตุ" />
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">ตรวจพิเศษอื่นๆ :</td>
	    <td class="labfont"><input name="other2" type="text" size="20" /></td>
	    <td class="labfont"><input name='normal54' type='radio' value='ปกติ' onclick="togglediv2('acnormal54')"/>
ปกติ
  <input name='normal54' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal54')"/>
ผิดปกติ </td>
	    <td colspan="2"><div id="acnormal54" style='display: none;'>
	      <input name="ch54" type="text" size="50" value="พบความผิดปกติ.......ควรพบแพทย์ เพื่อตรวจหาสาเหตุ" />
	      </div></td>
	    </tr>
	  </table></td>
</tr>
</table>
<br />
<table border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" width="100%">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="4">&nbsp;&nbsp;&nbsp;สรุปผลการตรวจ</td>
      </tr>
      <tr>
        <td width="34%" class="tb_font_2"><span class="labfont"><input name='normal61' type='checkbox' value='ปกติ (ไม่พบความเสี่ยง)' id="normal61"/>
        ปกติ (ไม่พบความเสี่ยง)</span></td>
        <td width="66%" class="labfont">&nbsp;</td>
        </tr>
      <tr>
        <td align="left" class="tb_font_2"><span class="labfont"><input name='normal62' type='checkbox' value='พบความเสี่ยงเบื้องต้นต่อโรค' id="normal62"/> 
          พบความเสี่ยงมีผลเลือดเกินค่าปกติ</span></td>
        <td class="labfont">
<input name='normal621' type='checkbox' value='น้ำตาล' />
น้ำตาล
<input name='normal622' type='checkbox' value='ไขมัน' />
ไขมัน
<input name='normal623' type='checkbox' value='ยูริค' />
ยูริค
<input name='normal624' type='checkbox' value='ตับ' />
ตับ
<input name='normal625' type='checkbox' id="normal625" value='ไต' /> 
ไต
</td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal63' type='checkbox' value='มีภาวะน้ำหนักเกิน' id="normal63"/>
        มีภาวะน้ำหนักเกิน</span></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal64' type='checkbox' value='มีค่าความดันโลหิตเกินค่าปกติ' id="normal64"/>
        มีค่าความดันโลหิตเกินค่าปกติ</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal65' type='checkbox' value='ป่วยด้วยโรคเรื้อรัง' id="normal65"/>
ป่วยด้วยโรคเรื้อรัง </span></td>
        <td><span class="labfont">
          <input name='normal651' type='checkbox' id="normal651" value='DM' />
          DM
          <input name='normal652' type='checkbox' id="normal652" value='HT' />
HT
<input name='normal653' type='checkbox' id="normal653" value='DLP' />
DLP
</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal66' type='checkbox' value='ผลเอ็กซเรย์' id="normal66"/> 
          ผลเอ็กซเรย์
</span></td>
        <td><input name="normal661" type="text" id="normal661"  /></td>
      </tr>
      <tr>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<table border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" width="100%">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="5">&nbsp;&nbsp;&nbsp;ป่วยเป็นโรค</td>
      </tr>
      <tr>
        <td width="30%" class="tb_font_2"><span class="labfont">
          <input name='anemia' type='checkbox' value='Y' id="normal"/>
          โลหิตจาง (Anemia)</span></td>
        <td width="32%" class="tb_font_2"><span class="labfont">
          <input name='cirrhosis' type='checkbox' value='Y' id="cirrhosis"/>
ตับแข็ง (Cirrhosis) </span></td>
        <td width="38%" class="tb_font_2"><span class="labfont">
          <input name='hepatitis' type='checkbox' value='Y' id="hepatitis"/>
โรคตับอักเสบ (Hepatitis) </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='cardiomegaly' type='checkbox' value='Y' id="cardiomegaly"/>
          หัวใจโต
        </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='allergy' type='checkbox' value='Y' id="allergy"/> 
          ภูมิแพ้
</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='gout' type='checkbox' value='Y' id="gout"/> 
          โรคเก๊าท์
</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name="waistline" type='checkbox' id="waistline" value='Y'/>
รอบเอวเกิน (ชาย &gt; 90 ซ.ม. , หญิง &gt; 80 ซ.ม.)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='asthma' type='checkbox' value='Y' id="asthma"/>
หอบหืด (Asthma) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='muscle' type='checkbox' value='Y' id="muscle"/>
กล้ามเนื้ออักเสบ</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='ihd' type='checkbox' value='Y' id="ihd"/>
โรคหัวใจขาดเลือดเรื้อรัง (IHD)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='thyroid' type='checkbox' value='Y' id="thyroid"/>
ไทรอยด์</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='heart' type='checkbox' value='Y' id="heart"/>
โรคหัวใจ </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='emphysema' type='checkbox' value='Y' id="emphysema"/>
ถุงลมโป่งพอง</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='herniated' type='checkbox' value='Y' id="herniated"/>
หมอนรองกระดูกทับเส้นประสาท</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='conjunctivitis' type='checkbox' value='Y' id="conjunctivitis"/>
เยื่อบุตาอักเสบ (Conjunctivitis)</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
    <input name='cystitis' type='checkbox' value='Y' id="cystitis"/>
กระเพาะปัสสาวะอักเสบ (Cystitis) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='epilepsy' type='checkbox' value='Y' id="epilepsy"/>
ลมชัก (Epilepsy) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='fracture' type='checkbox' value='Y' id="fracture"/>
กระดูกหักเลื่อน</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='cardiac' type='checkbox' value='Y' id="cardiac"/>
หัวใจเต้นผิดจังหวะ (Cardiac arrhythmia)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='spine' type='checkbox' value='Y' id="spine"/>
กระดูกสันหลัง (อก) คด</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='dermatitis' type='checkbox' value='Y' id="dermatitis"/>
ผิวหนังอักเสบ</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='degeneration' type='checkbox' value='Y' id="degeneration"/>
หัวเข่าเสื่อม</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='alcoholic' type='checkbox' value='Y' id="alcoholic"/>
ความผิดปกติจากแอลกอฮอล์</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='copd' type='checkbox' value='Y' id="copd"/>
COPD</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='bph' type='checkbox' value='Y' id="bph"/>
BPH</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='kidney' type='checkbox' value='Y' id="kidney"/>
ไตผิดปกติ</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='pterygium' type='checkbox' value='Y' id="pterygium"/>
ต้อเนื้อ</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='tonsil' type='checkbox' value='Y' id="tonsil"/>
ต่อมทอนซิลโต</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='paralysis' type='checkbox' value='Y' id="paralysis"/>
อัมพาตซีกซ้าย/ขวา </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='blood' type='checkbox' value='Y' id="blood"/>
เม็ดเลือดผิดปกติ </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='conanemia' type='checkbox' value='Y' id="conanemia"/>
ภาวะซีด</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='ht' type='checkbox' value='Y' id="ht"/>
          ความดันโลหิตสูง
        </span></td>
        <td class="tb_font_2">&nbsp;</td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<table width="100%" border="2" cellpadding="2" cellspacing="0" bordercolor="#000000">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="3">&nbsp;&nbsp;&nbsp;การดำเนินงาน</td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
        <input name='normal91' type='checkbox' value='1 แนะนำเรื่องพฤติกรรมสุขภาพเพื่อป้องกันความเสี่ยง' id="normal91"/>
        แนะนำเรื่องพฤติกรรมสุขภาพเพื่อป้องกันความเสี่ยง
        </span></td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal92' type='checkbox' value='2 แนะนำเรื่องการควบคุมอาหาร ลดน้ำหนัก' id="normal92"/>
          แนะนำเรื่องการควบคุมอาหาร ลดน้ำหนัก</span></td>
      </tr>
      <tr>
        <td align="left" class="tb_font_2"><span class="labfont">
          <input name='normal93' type='checkbox' value='3 แนะนำปรับพฤติกรรมการรับประทานอาหารและออกกำลังกายที่เหมาะสมกับวัย และการมาพบแพทย์ตามนัด' id="normal93"/>
          แนะนำปรับพฤติกรรมการรับประทานอาหารและออกกำลังกายที่เหมาะสมกับวัย และการมาพบแพทย์ตามนัด
        </span></td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal94' type='checkbox' value='4 พบโรค' id="normal94"/> 
          พบโรค 
          <input name="normal941" type="text" id="normal941" size="20"  />
ส่งต่อพบแพทย์เฉพาะทางเพื่อรักษาต่อ</span></td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal95' type='checkbox' value='5 อื่นๆ' id="normal95"/>
          <input name="normal951" type="text" id="normal951" size="80"  />
        </span></td>
      </tr>
    </table></td>
  </tr>
</table>
<BR>
<table width="100%" height="41" border="0" cellpadding="0" cellspacing="0">
  <tr>
    <td width="50%" height="35" valign="middle" bgcolor="#FFCCCC"><strong>การรักษา :</strong> <span class="labfont">
      <input name="cure_disease" type="text" id="cure_disease" size="80"  />
    </span></td>
    <td width="50%" valign="middle" bgcolor="#FFCCCC"><strong>นัดครั้งต่อไป : </strong><span class="labfont">
      <input name="appoint" type="text" id="appoint" size="30"  />
    </span></td>
  </tr>
</table>
<br />
<!-- บันทึกการวินิฉัยจากแพทย์ -->
<TABLE border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" bgcolor="#FFCCCC">
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0" >
	<TR>
		<TD align="left" class="tb_font_1" bgcolor="#339999">&nbsp;&nbsp;&nbsp;บันทึกการวินิฉัยจากแพทย์</TD>
	</TR>
	<TR class="tb_font">
		<TD>
	 <table height="60" border="0" bordercolor="#FFFFFF" bgcolor="#FFCCCC" class="tb_font">
  <tr>
    <td valign="top"><textarea name="dx" cols="60" rows="8" id="dx"><?php echo $arr_dxofyear["dx"]; ?></textarea>      &nbsp;&nbsp;</td>
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
<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" />
</center>
<INPUT TYPE="hidden" value="<?php echo $bmi;?>" name="bmi" />
<INPUT TYPE="hidden" value="<?php echo $rowid;?>" name="row_id" />
</FORM>

<?php }?>
<?php 
include("unconnect.inc");
 ?>
</body>


</html>
