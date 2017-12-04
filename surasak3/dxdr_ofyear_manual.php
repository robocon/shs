<?php
session_start();
include("connect.inc");

$_SESSION["list_bill"] = "";
$_POST["p_hn"] = $_SESSION["vn_now"]; //vn
$_POST["fixPrefix"] = $_SESSION["fixPrefix"]; //vn
$_POST["post_vn"] = 1;
$_SESSION["dt_doctor"] = $_SESSION["sOfficer"];

//$date_now = date("Y-m-d H:i:s");
$date_now = $_SESSION['pdate'];
$datecut =(substr($_SESSION['pdate'],0,4)-543)."-".substr($_SESSION['pdate'],5);

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
<title>ตรวจสุขภาพ</title>
<style>
	.font_title{font-family:"Angsana New"; font-size:36px;}
	.tb_font{font-family:"Angsana New"; font-size:24px;}
	.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F;}

.tb_font_2 {
	font-family:"Angsana New";
	color: #333;
	font-weight: bold;
	font-size: 24px;
}
body,td,th {
	font-family: Angsana New;
	font-size: 24px;
}

.tb_head {background-color: #0046D7; color: #FFFFCA; font-weight: bold; text-align:center;  }
.tb_detail {background-color: #FFFFC1;  }
.tb_menu {background-color: #FFFFC1;  }
.profile {
	font-family: "Angsana New";
	color: #00F;
	font-size: 22px;
	
}
.profilevalue {
	font-family: "Angsana New";
	font-size: 20px;
}
.profilehead {
	font-family: "Angsana New";
	font-size: 24px;
	color: #00F;
	font-weight: bold;
}
.profileheadvalue {
	font-family: "Angsana New";
	font-size: 22px;
	
}
.labfont {
	font-family:"Angsana New";
	font-size: 20px;
}
.sum {
	font-family:"Angsana New";
	font-size: 28px;
	color: #360;
	text-align: left;
}
.sum2 {
	color: #F00;
}
.sum1 {
	color: #00F;
}
</style>
<script>
function check(){
	if(document.dxdrform.normal120.checked == false&document.dxdrform.normal121.checked == false){
		alert('ยังไม่ได้เลือกผลการตรวจร่างกายทั่วไป');
		document.dxdrform.normal120.focus();
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
	else if(document.dxdrform.normal95.checked == false&document.dxdrform.normal94.checked == false){
		alert('ยังไม่ได้เลือกผลการตรวจเอ็กซ์เรย์ปอด');
		document.dxdrform.normal95.focus();
		return false;
	}else if(document.dxdrform.normal171.checked == false&document.dxdrform.normal172.checked == false&document.dxdrform.normal173.checked == false){
		alert('ยังไม่ได้เลือกสรุปผลการตรวจ');
		document.dxdrform.normal171.focus();
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

//ค้นหา hn จาก opday ****************************************************************************************
	//$date_now = (date("Y")+543).date("-m-d");
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

$date_hn = $datecut.$queryvn['hn'];
$date_vn = $datecut.$queryvn['vn'];
$arr_view["hn"] = $queryvn['hn'];
/*$sql = "Select  weight, height From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
echo $sql;
$result = Mysql_Query($sql);
list($weight, $height) = Mysql_fetch_row($result);*/


/*$sqlvn = "Select vn From dxofyear  where  hn = '".$_POST["p_hn"]."' limit 0,1";
list($vn) = mysql_fetch_row(mysql_query($sqlvn));*/

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	//$sql = "Select dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
	//$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	//list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);

//ค้นหาผลการตรวจทางพยาธิ ****************************************************************************************

	/*$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."'  AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54')  Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54' ) Order by labcode ASC ";
	
	$result_ua = mysql_query($sql);

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);*/
//ค้นหาข้อมูลเดิม
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	//$sql = "Select * From  `dxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";
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
		
		//$nPrefix1=$row->prefix;
		$nPrefix1=$_POST["fixPrefix"];
	////*runno ตรวจสุขภาพ*/////////
	$sql = "Select * From  `dxofyear` where yearchk = '$nPrefix1' AND hn='".$arr_view["hn"]."' and thidate like '%$datecut%'  order by row_id desc limit 0,1 ";

	
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	$result_dx = mysql_fetch_array($result);
	if($count > 0){
		$result = mysql_query($sql);
		$arr_dxofyear = mysql_fetch_assoc($result);
		$height = $arr_dxofyear["height"];
		$weight = $arr_dxofyear["weight"];
		if($arr_dxofyear["cigarette"] == '1'){ $cigarette1 = "Checked";}else if($arr_dxofyear["cigarette"] == '0'){$cigarette0 = "Checked";}
		if($arr_dxofyear["alcohol"] == '1'){ $alcohol1 = "Checked";}else if($arr_dxofyear["alcohol"] == '0'){$alcohol0 = "Checked";}
		if($arr_dxofyear["congenital_disease"] != ''){ $congenital_disease = $arr_dxofyear["congenital_disease"];}else{$congenital_disease = "ปฎิเสธโรคประจำตัว";}
		$rowid = $arr_dxofyear['row_id'];
		
	}else{
		$sql = "Select drugreact,congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END )   From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";

		$result = Mysql_Query($sql);
		list($drugreact,$congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0) = Mysql_fetch_row($result);
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
<FORM name="dxdrform" METHOD="post" ACTION="dxdr_ofyear_save_manual.php"   onsubmit="return check()" target="_blank">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $queryvn['vn'];?>" /><br />
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  width="100%">
<tr>
  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FEFBD6" >
    <tr>
      <td align="left" bgcolor="#0033FF" class="tb_font_1" colspan="12">&nbsp;&nbsp;&nbsp;ข้อมูลผู้ป่วย</td>
    </tr>
    <tr>
      <td align="left" class="profilehead">VN</td>
      <td align="left" class="profilehead"> :</td>
      <td  class="profileheadvalue">&nbsp;<?php echo $queryvn["vn"];?></td>
      <td rowspan="2" align="left" class="profilehead">ชื่อ-สกุล </td>
      <td rowspan="2" align="left" class="profilehead">:</td>
      <td rowspan="2" class="profileheadvalue">&nbsp;<?php echo $arr_view["ptname"];?></td>
      <td rowspan="2" align="left" class="profilehead">สังกัด </td>
      <td rowspan="2" align="left" class="profilehead">:</td>
      <td rowspan="2" class="profileheadvalue">&nbsp;<?php echo $arr_view["camp"];?></td>
      <input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/>
      <td width="89" rowspan="2" align="left" class="profilehead">อายุ</td>
      <td width="4" rowspan="2" align="left" class="profilehead">:</td>
      <td width="221" rowspan="2" class="profileheadvalue">&nbsp;<?php echo $arr_view["age"];?></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">HN </td>
      <td align="left" class="profilehead">:</td>
      <td class="profileheadvalue">&nbsp;<?php echo $arr_view["hn"];?></td>
    </tr>
    <tr>
      <td align="left" class="profile">ส่วนสูง </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $height; ?> ซม.</td>
      <td align="left" class="profile">น้ำหนัก</td>
      <td align="left" class="profile">:</td>
      <td align="left" class="profilevalue">&nbsp;<?php echo $weight; ?> กก. </td>
      <td align="left" class="profile">รอบเอว </td>
      <td align="left" class="profile">:</td>
      <?
			$ht = $height/100;
            $bmi = number_format($weight/($ht*$ht),2);
			?>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["round_"]; ?> ซม.</td>
      <td align="left" class="profile">BMI</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><span style="color:#F00">&nbsp;<?php echo $bmi; ?></span></td>
    </tr>
    <tr>
      <td align="left" class="profile">T </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["temperature"]; ?> C&deg;</td>
      <td align="left" class="profile">P </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["pause"]; ?> ครั้ง/นาที</td>
      <td align="left" class="profile">R </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["rate"]; ?> ครั้ง/นาที</td>
      <td align="left" class="profile">BP </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["bp1"]; ?> / <?php echo $arr_dxofyear["bp2"]; ?> mmHg</td>
    </tr>
    <tr>
      <td align="left" class="profile">บุหรี่ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['cigarette']=="1") echo "สูบ"; else echo "ไม่สูบ";?></td>
      <td align="left" class="profile">สุรา</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['alcohol']=="1") echo "ดื่ม"; else echo "ไม่ดื่ม";?></td>
      <td align="left" class="profile">แพ้ยา</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['drugreact']=="0"|$drugreact=="0") echo "ไม่แพ้ยา"; else echo $arr_dxofyear['drugreact']; ?>
        &nbsp;<?php echo $txt_react2;?></td>
      <td align="left" class="profile">โรคประจำตัว</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $congenital_disease;?></td>
    </tr>
    <tr>
      <td align="left" class="profile">อาการ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear['organ'];?></td>
      <td class="profile">กรุ๊ปเลือด</td>
      <td class="profilevalue">:</td>
      <td class="profilevalue"><?=$arr_dxofyear['blood']?></td>
      <td align="left" class="profile">แพทย์ </td>
      <td align="left" class="profile">:</td>
      <td colspan="4" class="profilevalue">&nbsp;<?=$arr_dxofyear['doctor'];?></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td bgcolor="#FFCC99" class="profile"  style="color:#000"><strong>ตรวจร่างกายทั่วไป</strong></td>
	    <td bgcolor="#FFCC99"><span class="profile">:</span></td>
	    <td colspan="3" bgcolor="#FFCC99" class="profilevalue">
	      
	      <input name='normal20' type='radio' value='ปกติ' onclick="togglediv2('acnormal20')" id="normal120"/>
	       ปกติ
           <input name='normal20' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal20')" id="normal121"/>
	      ผิดปกติ </td>
	    <td colspan="7" bgcolor="#FFCC99"><div id="acnormal20" style='display: none;'>
	      <select name="ch20" >
	        <option value="ความดันผิดปกติ">ความดันผิดปกติ</option>
	        <option value="ดัชนีมวลกายเกินค่าปกติ">ดัชนีมวลกายเกินค่าปกติ</option>
	        <option value="ความดันผิดปกติ,ดัชนีมวลกายเกินค่าปกติ">ความดันผิดปกติ,ดัชนีมวลกายเกินค่าปกติ</option>
	        </select>
	      </div>
	      </td>
	    <td>&nbsp;</td>
      </tr>
  </table></td></tr>
</table>
<BR>
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" width="100%">
<TR>
	<TD><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FEFBD6">
	  <tr>
	    <td align="left" class="tb_font_1" bgcolor="#0033FF" colspan="8">&nbsp;&nbsp;&nbsp;การตรวจร่างกายทบ.</td>
	  </tr>
	  <tr>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    <td>&nbsp;</td>
	    </tr>
	  <tr>
	    <td width="36%" class="profile">ก. ลักษณะทั่วไป</td>
	    <td width="18%" class="profilevalue"><input name='normal21' type='radio' onclick="togglediv2('acnormal21')" value='ปกติ' checked="checked"/>
	      ปกติ
	        <input name='normal21' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal21')"/>
	      ผิดปกติ </td>
	    <td width="46%">
  <div style="display:none" id="acnormal21"><input name="text21" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">ข. ผิวหนัง</td>
	    <td class="profilevalue"><input name='normal22' type='radio' onclick="togglediv2('acnormal22')" value='ปกติ' checked="checked"/>
	      ปกติ
	        <input name='normal22' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal22')"/>
	      ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal22"><input name="text22" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">ค. ทางเดินแห่งอาหาร</td>
	    <td class="profilevalue"><input name='normal23' type='radio' onclick="togglediv2('acnormal23')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal23' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal23')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal23"><input name="text23" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">ง. ทางเดินแห่งลมหายใจ</td>
	    <td class="profilevalue"><input name='normal24' type='radio' onclick="togglediv2('acnormal24')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal24' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal24')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal24"><input name="text24" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">จ. ทางเดินแห่งโลหิต</td>
	    <td class="profilevalue"><input name='normal25' type='radio' onclick="togglediv2('acnormal25')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal25' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal25')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal25"><input name="text25" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">ฉ. ทางเดินแห่งน้ำเหลือง</td>
	    <td class="profilevalue"><input name='normal26' type='radio' onclick="togglediv2('acnormal26')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal26' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal26')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal26"><input name="text26" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">ช. ทางเดินแห่งปัสสาวะและอวัยวะสืบพันธุ์</td>
	    <td class="profilevalue"><input name='normal27' type='radio' onclick="togglediv2('acnormal27')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal27' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal27')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal27"><input name="text27" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">ซ. สมองและประสาท</td>
	    <td class="profilevalue"><input name='normal28' type='radio' onclick="togglediv2('acnormal28')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal28' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal28')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal28"><input name="text28" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">ญ. กระดูกและข้อ</td>
	    <td class="profilevalue"><input name='normal29' type='radio' onclick="togglediv2('acnormal29')" value='ปกติ' checked="checked"/>
ปกติ
  <input name='normal29' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal29')"/>
ผิดปกติ </td>
	    <td><div style="display:none" id="acnormal29"><input name="text29" type="text" size="30" /></div></td>
	    </tr>
	  <tr>
	    <td class="profile">ด. ตา, หู, คอ, จมูก</td>
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
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  width="100%">
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0"  width="100%" bgcolor="#FEFBD6">
	<TR>
		<TD align="left" class="tb_font_1" bgcolor="#0033FF">&nbsp;&nbsp;&nbsp;ผลการตรวจทางพยาธิ เมื่อวันที่ <?php echo $lab_date;?></TD>
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
	    <td width="8%" align="right" class="tb_font_2">Color:</td><td width="10%" ><?=$result_dx['ua_color']?></td>
	    <td width="10%" align="right" class="tb_font_2">SP.Gr:</td>
	    <td width="9%"><?=$result_dx['ua_spgr']?></td>
	    <td width="13%"  align="right" class="tb_font_2">PH:</td>
	    <td width="10%" ><?=$result_dx['ua_phu']?></td>
	    <td width="10%"  align="right" class="tb_font_2">Blood:</td>
	    <td width="11%"  ><?=$result_dx['ua_bloodu']?></td>
	    <td width="10%" align="right" class="tb_font_2">Protien:</td><td width="9%"><?=$result_dx['ua_prou']?></td></tr>
      <tr>
        <td align="right" class="tb_font_2">Sugar:</td><td><?=$result_dx['ua_gluu']?></td>
        <td align="right" class="tb_font_2">Ketone:</td>
        <td><?=$result_dx['ua_ketu']?></td>
        <td align="right" class="tb_font_2">Urobillinogen:</td>
        <td><?=$result_dx['ua_urobil']?></td>
        <td align="right" class="tb_font_2">Billirubin</td>
        <td><?=$result_dx['ua_bili']?></td>
        <td align="right" class="tb_font_2">Nitrite</td><td><?=$result_dx['ua_nitrit']?></td></tr>
      <tr>
        <td align="right" class="tb_font_2">Crystal:</td><td><?=$result_dx['ua_crystu']?></td>
        <td align="right" class="tb_font_2">Casts:</td>
        <td><?=$result_dx['ua_castu']?></td>
        <td align="right" class="tb_font_2">Epithelial:</td>
        <td><?=$result_dx['ua_epiu']?></td>
        <td align="right" class="tb_font_2">WBC:</td>
        <td><?=$result_dx['ua_wbcu']?></td>
        <td align="right" class="tb_font_2">RBC:</td><td><?=$result_dx['ua_rbcu']?></td></tr>
      <tr>
        <td align="right" class="tb_font_2">Amorphous:</td><td><?=$result_dx['ua_amopu']?></td>
        <td align="right" class="tb_font_2">Bacteria:</td>
        <td><?=$result_dx['ua_bactu']?></td>
        <td align="right" class="tb_font_2">Mucus:</td>
        <td><?=$result_dx['ua_mucosu']?></td>
        <td align="right" class="tb_font_2">Yeast:</td>
        <td><?=$result_dx['ua_yeast']?></td>
        <td align="right" class="tb_font_2">Appear:</td><td><?=$result_dx['ua_appear']?></td></tr>
      <tr>
        <td align="right" class="tb_font_2">Otheru:</td>
        <td><?=$result_dx['otheru']?></td>
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
        <td colspan="2" align="center" bgcolor="#FFCC99"><strong>ผลการตรวจ</strong></td>
        <td colspan="2" align="center" bgcolor="#FFCC99"><input name='normal' type='radio' value='ปกติ' onclick="togglediv2('acnormal')" id="normal98" />
          ปกติ
          <input name='normal' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal')" id="normal99" />
          ผิดปกติ </td>
          <td colspan="6" bgcolor="#FFCC99">
          <div id="acnormal" style='display: none;'>
            <select name='ch'>
              <option value='พบเม็ดเลือดแดงในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดแดงในปัสสาวะ</option>
              <option value='พบเม็ดเลือดขาวในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดขาวในปัสสาวะ</option>
              <option value='โปรตีนรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>โปรตีนรั่วในปัสสาวะ</option>
              <option value='น้ำตาลรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>น้ำตาลรั่วในปัสสาวะ</option>
              <option value='พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ</option>
              <option value='พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดแดงในปัสสาวะ,โปรตีนรั่วในปัสสาวะ</option>
              <option value='พบเม็ดเลือดแดงในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดแดงในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ</option>
              <option value='พบเม็ดเลือดแดงในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดขาวในปัสสาวะ,โปรตีนรั่วในปัสสาวะ</option>
              <option value='พบเม็ดเลือดขาวในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดขาวในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ</option>
              <option value='โปรตีนรั่วในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>โปรตีนรั่วในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ</option>
              <option value='พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ,โปรตีนรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ,โปรตีนรั่วในปัสสาวะ</option>
              <option value='พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ</option>
              <option value='พบเม็ดเลือดขาวในปัสสาวะ,โปรตีนรั่วในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดขาวในปัสสาวะ,โปรตีนรั่วในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ</option>
              <option value='พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ,โปรตีนรั่วในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ หากมีอาการปัสสาวะผิดปกติร่วมด้วย ควรปรึกษาแพทย์'>พบเม็ดเลือดแดงในปัสสาวะ,พบเม็ดเลือดขาวในปัสสาวะ,โปรตีนรั่วในปัสสาวะ,น้ำตาลรั่วในปัสสาวะ</option>
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
          <td width="10%"  align="right" class="tb_font_2">WBC :</td>
          <td width="8%" ><strong><?=$result_dx['cbc_wbc']?></strong></td>
          <td width="9%"  align="right" class="tb_font_2">HCT : </td>
          <td width="10%" ><strong><?=$result_dx['cbc_hct']?></strong></td>
          <td width="10%"  align="right" class="tb_font_2">NEU :</td>
          <td width="8%" ><strong><?=$result_dx['cbc_neu']?></strong></td>
          <td width="12%"  align="right" class="tb_font_2">LYMP : </td>
          <td width="10%" ><strong><?=$result_dx['cbc_lymp']?></strong></td>
          <td width="10%"  align="right" class="tb_font_2">MONO : </td>
          <td width="13%" ><strong><?=$result_dx['cbc_mono']?></strong></td>
		  </tr>
          <tr>
            <td align="right" class="tb_font_2">EOS : </td>
            <td><strong><?=$result_dx['cbc_eos']?></strong></td>
            <td align="right" class="tb_font_2">MCV :</td>
            <td><strong><?=$result_dx['cbc_mcv']?></strong></td>
            <td align="right" class="tb_font_2">MCH :</td>
            <td><strong><?=$result_dx['cbc_mch']?></strong></td>
            <td align="right" class="tb_font_2">MCHC : </td>
            <td><strong><?=$result_dx['cbc_mchc']?></strong></td>
            <td align="right" class="tb_font_2">PLTS :</td>
            <td><strong><?=$result_dx['cbc_plts']?></strong></td>
          </tr>
          <tr>
          <td align="right" class="tb_font_2">OTHER : </td>
          <td><strong><?=$result_dx['cbc_other']?></strong></td>
          <td align="right" class="tb_font_2">NRBC : </td>
          <td><strong><?=$result_dx['cbc_nrbc']?></strong></td>
          <td align="right" class="tb_font_2">RBC :</td>
          <td><strong><?=$result_dx['cbc_rbc']?></strong></td>
          <td align="right" class="tb_font_2">RBCMOR : </td>
          <td><strong><?=$result_dx['cbc_rbcmor']?></strong></td>
          <td align="right" class="tb_font_2">HB :</td>
          <td><strong><?=$result_dx['cbc_hb']?></strong></td>
		  </tr>
          <tr>
            <td align="right" class="tb_font_2">BASO :</td>
            <td><strong><?=$result_dx['cbc_baso']?></strong></td>
            <td align="right" class="tb_font_2">ATYP :</td>
            <td><strong><?=$result_dx['cbc_atyp']?></strong></td>
            <td align="right" class="tb_font_2">BAND :</td>
            <td><strong><?=$result_dx['cbc_band']?></strong></td>
            <td align="right" class="tb_font_2">PLTC : </td>
            <td><strong><?=$result_dx['cbc_pltc']?></strong></td>
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
<table border="0" width="100%" bgcolor="#FFCCCC">
          <tr>
            <td align="right" class="tb_font_2" width="50">HCT : </td>
            <td width="28" class="labfont">&nbsp;<strong><?=$result_dx['cbc_hct']?></strong></td>
            <td class="labfont"  width="66">(<?=$result_dx['hctrange']?>)</td>
            <td width="20" align="center" class="labfont" ><span <? if($result_dx['hctflag']!="N") echo " style='color:#F00'";?>><?=$result_dx['hctflag']?></span></td>
            <td width="120" class="labfont">
            <? if($arr_view["sex"]=="ญ" && $arr_view["age"] <=55){ ?>
            <input name='normal31' type='radio' value='ปกติ' onclick="togglediv2('acnormal31')" <? if($result_dx['cbc_hct'] >= 36) echo "checked";?> />ปกติ 
            <input name='normal31' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal31')" <? if($result_dx['cbc_hct'] < 36) echo "checked";?>/>ผิดปกติ
            <? }else{ ?>
             <input name='normal31' type='radio' value='ปกติ' onclick="togglediv2('acnormal31')" <? if($result_dx['cbc_hct'] >= 39) echo "checked";?> />ปกติ 
            <input name='normal31' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal31')" <? if($result_dx['cbc_hct'] < 39) echo "checked";?>/>ผิดปกติ           
            <? } ?>
            </td>
            <td width="412">
            <? if($arr_view["sex"]=="ญ" && $arr_view["age"] <=55){ ?>
             <div id="acnormal31" <? if($result_dx['cbc_hct'] >= 36) echo "style='display: none;'"; else "style='display: block;'"; ?>>
                <select name='ch31'>
                <option value='มีระดับเม็ดเลือดแดงต่ำกว่าปกติ บ่งบอกถึงภาวะซีดควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ'>มีระดับเม็ดเลือดแดงต่ำกว่าปกติ บ่งบอกถึงภาวะซีดควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ</option>
                </select>
            </div>           
            <? }else{ ?>
            <div id="acnormal31" <? if($result_dx['cbc_hct'] >= 39) echo "style='display: none;'"; else "style='display: block;'"; ?>>
                <select name='ch31'>
                <option value='มีระดับเม็ดเลือดแดงต่ำกว่าปกติ บ่งบอกถึงภาวะซีดควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ'>มีระดับเม็ดเลือดแดงต่ำกว่าปกติ บ่งบอกถึงภาวะซีดควรตรวจซ้ำ หรือ พบแพทย์เพื่อหาสาเหตุ</option>
                </select>
            </div>            
            <? } ?>
     		</td>
          </tr>
          <tr>
          <td align="right" class="tb_font_2" width="50">WBC : </td>
          <td width="28" class="labfont">&nbsp;<strong><?=$result_dx['cbc_wbc']?></strong></td>
          <td class="labfont" width="66">(<?=$result_dx['wbcrange']?>)</td>
          <td align="center" class="labfont" width="20" ><span <? if($result_dx['wbcflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['wbcflag'];?></span></td>
          <td width="120" class="labfont"><input name='normal32' type='radio' value='ปกติ' onclick="togglediv2('acnormal32')" <? if($result_dx['cbc_wbc'] >= 4.5 &&  $result_dx['cbc_wbc'] <= 10){ echo "checked";}?>/>
          ปกติ 
            <input name='normal32' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal32')" <? if($result_dx['cbc_wbc'] < 4.5 || $result_dx['cbc_wbc'] > 10){ echo "checked";}?>/>ผิดปกติ </td><td>
            <div id="acnormal32" <? if($result_dx['cbc_wbc'] >= 4.5 &&  $result_dx['cbc_wbc'] <= 10){ echo "style='display: none;'";}else{ echo "style='display: block;'";} ?>>
            <select name='ch32'>
              <option value='ปริมาณเม็ดเลือดขาวมีค่าต่ำกว่าปกติ ควรตรวจซ้ำหรือพบแพทย์' <? if($result_dx['cbc_wbc'] < 4.5){ echo "selected='selected';";}?>>ปริมาณเม็ดเลือดขาวมีค่าต่ำกว่าปกติ ควรตรวจซ้ำหรือพบแพทย์</option>
              <option value='ปริมาณเม็ดเลือดขาวอยู่ในระดับสูงเกินปกติ ควรตรวจซ้ำหรือพบแพทย์' <? if($result_dx['cbc_wbc'] > 10){ echo "selected='selected';";}?>>ปริมาณเม็ดเลือดขาวอยู่ในระดับสูงเกินปกติ ควรตรวจซ้ำหรือพบแพทย์</option>              
            </select>
          </div></td>
          </tr>
          <tr>
          <td align="right" class="tb_font_2" width="50">PLTC : </td>
          <td width="28" class="labfont">&nbsp;<strong><?=$result_dx['cbc_pltc']?></strong></td>
          <td class="labfont" width="66">(<?=$result_dx['pltcrange']?>)</td>
          <td align="center" class="labfont" width="20"><span <? if($result_dx['pltcflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['pltcflag']?></span></td>
          <td width="120" class="labfont"><input name='normal33' type='radio' value='ปกติ' onclick="togglediv2('acnormal33')" <? if($result_dx['cbc_pltc'] >= 140 &&  $result_dx['cbc_pltc'] <= 400){ echo "checked";}?>/>ปกติ 
            <input name='normal33' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal33')" <? if($result_dx['cbc_pltc'] < 140 || $result_dx['cbc_pltc'] > 400){ echo "checked";}?>/>ผิดปกติ </td><td>
       <div id="acnormal33" <? if($result_dx['cbc_pltc'] >= 140 &&  $result_dx['cbc_pltc'] <= 400){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
       <select name='ch33'>
	  <option value='ปริมาณเกร็ดเลือดมีค่าต่ำกว่าปกติ ควรตรวจซ้ำหรือพบแพทย์' <? if($result_dx['cbc_pltc'] < 140){ echo "selected='selected';";}?>>ปริมาณเกร็ดเลือดมีค่าต่ำกว่าปกติ ควรตรวจซ้ำหรือพบแพทย์</option>
	  <option value='ปริมาณเกร็ดเลือดมีค่าสูงเกินปกติ ควรตรวจซ้ำหรือพบแพทย์' <? if($result_dx['cbc_pltc'] > 400){ echo "selected='selected';";}?>>ปริมาณเกร็ดเลือดมีค่าสูงเกินปกติ ควรตรวจซ้ำหรือพบแพทย์</option>      
	  </select></div></td>
          </tr>
          <tr bgcolor="#CCCCFF">
            <td colspan="5" align="center" bgcolor="#FFCC99"><strong>ผลการตรวจ</strong>
              <input name='normal81' type='radio' value='ปกติ' onclick="togglediv2('acnormal81')" id="normal97" />
              ปกติ
              <input name='normal81' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal81')" id="normal96" />
              ผิดปกติ </td>
            <td bgcolor="#FFCC99"><div id="acnormal81" style='display: none;'>
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
	$nPrefix ="25".$_POST["fixPrefix"];
////*runno ตรวจสุขภาพ*/////////

$bquery = "select * from condxofyear_so where hn ='".$_SESSION["hn_now"]."' and status_dr='Y' and yearcheck='".($nPrefix-1)."' ";
//echo $bquery;
$brow = mysql_query($bquery);
$bsult = mysql_fetch_array($brow);
?>
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  width="100%" bgcolor="#FFCCCC"><tr><td>
	  <table width="100%" border="0">
	    <tr>
	      <td align="right" class="tb_font_2">&nbsp;</td>
	      <td bgcolor="#339999" class="labfont"><strong><?=($nPrefix-1)?></strong></td>
	      <td bgcolor="#339999" class="labfont"><strong><?=$nPrefix?></strong></td>
	      <td class="labfont">&nbsp;</td>
	      <td align="center" class="labfont">&nbsp;</td>
	      <td class="labfont">&nbsp;</td>
	      <td colspan="4">&nbsp;</td>
	      </tr>
	    <tr>
	      <td align="right" class="tb_font_2">GLU :</td>
	      <td bgcolor="#0099CC" class="labfont"><strong><?=$bsult['bs']?></strong></td>
	    <td bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['bs']?></strong></td>
	    <td class="labfont">(<?=$result_dx['bsrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['bsflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['bsflag']?></span></td>
	    <td class="labfont"><input name='normal47' type='radio' value='ปกติ' onclick="togglediv2('acnormal47');" <?  if($result_dx['bs'] < 100){ echo "checked";}?>/>
ปกติ
  <input name='normal47' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal47');" <? if($result_dx['bs'] >= 100){ echo "checked";}?>/>
  ผิดปกติ </td>
	    <td colspan="4">            
        <div id="acnormal47" <? if($result_dx['bs'] < 100){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch47'>
        <option value="ระดับน้ำตาลในเลือดสูงเกินค่าปกติ มีความเสี่ยงสูงต่อการเกิดเบาหวานในอนาคต ควรเริ่มต้นควบคุมอาหาร จำพวกข้าว, แป้ง, อาหารที่มีรสชาติหวาน และตรวจซ้ำใน 1-2 ปี" <? if($result_dx['bs'] >= 100 && $result_dx['bs'] <= 125){ echo "selected='selected';";}?>>ระดับน้ำตาลในเลือดสูงเกินค่าปกติ มีความเสี่ยงสูงต่อการเกิดเบาหวานในอนาคต ควรเริ่มต้นควบคุมอาหาร จำพวกข้าว, แป้ง, อาหารที่มีรสชาติหวาน และตรวจซ้ำใน 1-2 ปี</option>
        <option value="อาจเป็นโรคเบาหวาน ควรพบแพทย์เพื่อประเมินและให้การรักษา" <? if($result_dx['bs'] > 125){ echo "selected='selected';";}?>>อาจเป็นโรคเบาหวาน ควรพบแพทย์เพื่อประเมินและให้การรักษา</option></select></div>
</td>
	      </tr>
	    <tr>
	      <td align="right" class="tb_font_2">CHOL :</td>
	      <td bgcolor="#0099CC" class="labfont"><strong><?=$bsult['chol']?></strong></td>
	    <td bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['chol']?></strong></td>
	    <td class="labfont">(<?=$result_dx['cholrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['cholflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['cholflag']?></span></td>
	    <td class="labfont"><input name='normal46' type='radio' value='ปกติ' onclick="togglediv2('acnormal46');" <? if($result_dx['chol'] <= 199){ echo "checked";}?> />
ปกติ
  <input name='normal46' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal46');" <? if($result_dx['chol'] >= 200){ echo "checked";}?>/>
  ผิดปกติ </td>
	    <td colspan="4">          
        <div id="acnormal46" <? if($result_dx['chol'] <= 199){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch46'>
			<option value="ระดับไขมันในเลือดมีค่าผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกาย และตรวจซ้ำใน 3-6 เดือน" <? if($result_dx['chol'] >= 200 && $result_dx['chol'] <= 239 ){ echo "selected='selected';";}?>>ระดับไขมันในเลือดมีค่าผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกาย และตรวจซ้ำใน 3-6 เดือน</option>
			<option value="ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['chol'] >= 240){ echo "selected='selected';";}?>>ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option>                        
		</select></div> 
  </td>
	      </tr>
	    <tr>
	      <td align="right" class="tb_font_2">TRIG :</td>
	      <td bgcolor="#0099CC" class="labfont"><strong><?=$bsult['tg']?></strong></td>
	    <td bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['tg']?></strong></td>
	    <td class="labfont">(<?=$result_dx['tgrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['tgflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['tgflag']?></span></td>
	    <td class="labfont"><input name='normal48' type='radio' value='ปกติ' onclick="togglediv2('acnormal48');" <? if($result_dx['tg'] < 150){ echo "checked";}?> />
ปกติ
  <input name='normal48' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal48');"  <? if($result_dx['tg'] >= 150){ echo "checked";}?>/>
  ผิดปกติ </td>
	    <td colspan="4">
        <div id="acnormal48" <? if($result_dx['tg'] < 150){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch48'>
			<option value="ระดับไขมันในเลือดมีค่าผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกาย และตรวจซ้ำใน 3-6 เดือน" <? if($result_dx['tg'] >= 150 && $result_dx['tg'] < 500 ){ echo "selected='selected';";}?>>ระดับไขมันในเลือดมีค่าผิดปกติเล็กน้อย ควรควบคุมอาหารกลุ่มไขมัน ออกกำลังกาย และตรวจซ้ำใน 3-6 เดือน</option>
			<option value="ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['tg'] >= 500){ echo "selected='selected';";}?>>ระดับไขมันในเลือดมีค่าสูงผิดปกติค่อนข้างมาก ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option>           
        </select></div>
            </td>
	      </tr>
	    <tr>
	      <td align="right" class="tb_font_2">BUN :</td>
	      <td bgcolor="#0099CC" class="labfont"><strong><?=$bsult['bun']?></strong></td>
	    <td bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['bun']?></strong></td>
	    <td class="labfont">(<?=$result_dx['bunrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['bunflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['bunflag']?></span></td>
	    <td class="labfont"><input name='normal44' type='radio' value='ปกติ' onclick="togglediv2('acnormal44');" <? if($result_dx['bun'] <= 20){ echo "checked";}?>/>
ปกติ
  <input name='normal44' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal44');" <? if($result_dx['bun'] > 20){ echo "checked";}?>/>
  ผิดปกติ </td>
	    <td colspan="4">
        <div id="acnormal44" <? if($result_dx['bun'] <= 20){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch44'>
        <option value="ค่าการทำงานของไตสูงกว่าปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['bun'] > 20){ echo "selected='selected';";}?>>ค่าการทำงานของไตสูงกว่าปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option>
</select></div>
  </td>
	      </tr>
	    <tr>
	      <td align="right" class="tb_font_2">CREA :</td>
	      <td bgcolor="#0099CC" class="labfont"><strong><?=$bsult['cr']?></strong></td>
	    <td bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['cr']?></strong></td>
	    <td class="labfont">(<?=$result_dx['crrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['crflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['crflag']?></span></td>
	    <td class="labfont"><input name='normal45' type='radio' value='ปกติ' onclick="togglediv2('acnormal45');" <? if($result_dx['cr'] <= 1.2){ echo "checked";}?> />
ปกติ
  <input name='normal45' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal45');" <? if($result_dx['cr'] > 1.2){ echo "checked";}?>/>
  ผิดปกติ </td>
	    <td colspan="4">
        <div id="acnormal45" <? if($result_dx['cr'] <= 1.2){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
		<select name='ch45'>
        <option value="ค่าการทำงานของไตสูงกว่าปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['cr'] > 1.2){ echo "selected='selected';";}?>>ค่าการทำงานของไตสูงกว่าปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option>
        </select>
       </div>
</td>
	      </tr>
	    <tr>
          <td width="9%" align="right" class="tb_font_2"> ALP : </td>
          <td width="7%" bgcolor="#0099CC" class="labfont"><strong><?=$bsult['alk']?></strong></td>
          <td width="7%" bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['alk']?></strong></td>
			<td width="7%" class="labfont">(<?=$result_dx['alkrange']?>)</td>
            <td width="4%" align="center" class="labfont"><span <? if($result_dx['alkflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['alkflag']?></span></td>
			<td width="19%" class="labfont"><input name='normal41' type='radio' value='ปกติ' onclick="togglediv2('acnormal41');"  <? if($result_dx['alk'] <= 100){ echo "checked";}?>/>
			ปกติ 
			  <input name='normal41' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal41');" <? if($result_dx['alk'] > 100){ echo "checked";}?>/>ผิดปกติ </td>
            <td width="54%" colspan="4">
           <div id="acnormal41" <? if($result_dx['alk'] <= 100){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
           <select name='ch41'><option value="ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['alk'] > 100){ echo "selected='selected';";}?>>ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option></select></div>
            </td>
          </tr>
	  <tr>
	    <td align="right" class="tb_font_2">ALT :</td>
	    <td bgcolor="#0099CC" class="labfont"><strong><?=$bsult['sgpt']?></strong></td>
	    <td bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['sgpt']?></strong></td>
	    <td class="labfont">(<?=$result_dx['sgptrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['sgptflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['sgptflag']?></span></td>
	    <td class="labfont"><input name='normal42' type='radio' value='ปกติ' onclick="togglediv2('acnormal42');" <? if($result_dx['sgpt'] <= 40){ echo "checked";}?>/>
ปกติ
  <input name='normal42' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal42');" <? if($result_dx['sgpt'] > 40){ echo "checked";}?>/>
  ผิดปกติ </td>
	    <td colspan="4">          
        <div id="acnormal42" <? if($result_dx['sgpt'] <= 40){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch42'><option value="ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['sgpt'] > 40){ echo "selected='selected';";}?>>ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option></select></div>
  </td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">AST :</td>
	    <td bgcolor="#0099CC" class="labfont"><strong><?=$bsult['sgot']?></strong></td>
	    <td bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['sgot']?></strong></td>
	    <td class="labfont">(<?=$result_dx['sgotrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['sgotflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['sgotflag']?></span></td>
	    <td class="labfont"><input name='normal43' type='radio' value='ปกติ' onclick="togglediv2('acnormal43');" <? if($result_dx['sgot'] <= 40){ echo "checked";}?>/>
ปกติ
  <input name='normal43' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal43');" <? if($result_dx['sgot'] > 40){ echo "checked";}?>/>
  ผิดปกติ </td>
	    <td colspan="4">        
        <div id="acnormal43" <? if($result_dx['sgot'] <= 40){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch43'><option value="ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา" <? if($result_dx['sgot'] > 40){ echo "selected='selected';";}?>>ค่าการทำงานของตับผิดปกติ ควรพบแพทย์เพื่อรับการประเมินและให้การรักษา</option></select></div>
  </td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">URIC :</td>
	    <td bgcolor="#0099CC" class="labfont"><strong><?=$bsult['uric']?></strong></td>
	    <td bgcolor="#FFFFFF" class="labfont"><strong><?=$result_dx['uric']?></strong></td>
	    <td class="labfont">(<?=$result_dx['uricrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['uricflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['uricflag']?></span></td>
	    <td class="labfont"><input name='normal49' type='radio' value='ปกติ' onclick="togglediv2('acnormal49');" <? if($result_dx['uric'] <= 7){ echo "checked";}?>/>
ปกติ
  <input name='normal49' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal49');"<? if($result_dx['uric'] > 7){ echo "checked";}?>/>
  ผิดปกติ </td>
	    <td colspan="4">
        <div id="acnormal49" <? if($result_dx['uric'] <= 7){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch49'>
        <option value="ปกติ" <? if($result_dx['uric'] <= 7){ echo "selected='selected';";}?>>ปกติ</option>
        <option value="มีระดับกรดยูริคสูงผิดปกติ ควรควบคุมอาหารจำพวกเครื่องใน, อาหารทะเล, เครื่องดื่มแอลกอฮอล์" <? if($result_dx['uric'] > 7){ echo "selected='selected';";}?>>มีระดับกรดยูริคสูงผิดปกติ ควรควบคุมอาหารจำพวกเครื่องใน, อาหารทะเล, เครื่องดื่มแอลกอฮอล์</option>
        </select></div>
            </td>
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
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" width="100%">
<TR>
	<TD><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FEFBD6">
	  <tr>
	    <td align="left" class="tb_font_1" bgcolor="#0033FF" colspan="7">&nbsp;&nbsp;&nbsp;การตรวจอื่น ๆ</td>
	  </tr>
	  <tr bgcolor="#CCCCFF">
	    <td width="27%" align="right" bgcolor="#FFCC99" class="tb_font_2">ตรวจเอ็กซ์เรย์ปอด : <a href="dxdr_xray_film.php" target="_blank">ดูฟิลม์</a> </td>
	    <td width="21%" bgcolor="#FFCC99" class="labfont"><input name='normal51' type='radio' value='ปกติ' onclick="togglediv2('acnormal51')" id="normal94"/>
	      ปกติ
	        <input name='normal51' type='radio' value='ผิดปกติ' onclick="togglediv1('acnormal51')" id="normal95"/>
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
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" width="100%">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FEFBD6">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0033FF" colspan="4">&nbsp;&nbsp;&nbsp;สรุปเบื้องต้น</td>
      </tr>
      <tr>
        <td width="27%" class="tb_font_2"><span class="labfont"><input name='normal61' type='radio' value='ไม่พบความเสี่ยง' id="normal61"/>ไม่พบความเสี่ยง</span></td>
        <td class="labfont">&nbsp;</td>
        </tr>
      <tr>
        <td align="left" class="tb_font_2"><span class="labfont"><input name='normal61' type='radio' value='พบความเสี่ยงเบื้องต้นต่อโรค' id="normal62"/>พบความเสี่ยงเบื้องต้นต่อโรค</span></td>
        <td class="labfont">
<input name='normal621' type='checkbox' value='Y' />DM
<input name='normal622' type='checkbox' value='Y' />HT
<input name='normal623' type='checkbox' value='Y' />Stroke
<input name='normal624' type='checkbox' value='Y' />Obesity</td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal61' type='radio' value='ป่วยด้วยโรคเรื้อรัง' id="normal63"/>ป่วยด้วยโรคเรื้อรัง
        </span></td>
        <td><span class="labfont">
<input name='normal631' type='checkbox' value='Y' />
DM
<input name='normal632' type='checkbox' value='Y' />
HT 
<input name='normal633' type='checkbox' value='Y' />
Stroke
<input name='normal634' type='checkbox' value='Y' />
Obesity
           </span></td>
        </tr>
      <tr>
        <td colspan="2" ><span class="labfont"><strong> ***กรณีอายุ 35 ปีขึ้นไป มีประวัติเสี่ยงและค่า BMI &gt; 25 kg ดำเนินการตรวจ Total Cholesterol</strong></span></td>
        </tr>
      <tr>
        <td colspan="2" class="tb_font_2"><span class="labfont">
          <input name='normal62' type='radio' value='ไม่ตรวจ' id="normal64"/>
          ไม่ตรวจ
        </span></td>
      </tr>
      <tr>
        <td colspan="2" class="tb_font_2">
<span class="labfont"><input name='normal62' type='radio' value='ตรวจ' id="normal65"/>
ตรวจ 
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input name='normal641' type='radio' value='ปกติ' id="normal66"/>
ปกติ
<input name='normal641' type='radio' value='ผิดปกติ' id="normal67"/>
ผิดปกติ
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
ค่าที่ตรวจได้
<input name="cholsult" type="text" id="cholsult" size="10" />
mg/dl </span>
		</td>
      </tr>
    </table></td>
  </tr>
</table>
<br />
<table border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" width="100%">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FEFBD6">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0033FF" colspan="3">&nbsp;&nbsp;&nbsp;การดำเนินงาน</td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont"><input name='normal91' type='radio' value='1 ให้คำแนะนำการดูแลตนเอง และตรวจคัดกรองซ้ำทุก 1 ปี' id="normal91"/>ให้คำแนะนำการดูแลตนเอง และตรวจคัดกรองซ้ำทุก 1 ปี</span></td>
        </tr>
      <tr>
        <td align="left" class="tb_font_2"><span class="labfont">
          <input name='normal91' type='radio' value='2 ลงทะเบียนกลุ่มเสี่ยงต่อกลุ่มโรค Metabolic และแนะนำเข้าโครงการปรับเปลี่ยนพฤติกรรม' id="normal92"/>ลงทะเบียนกลุ่มเสี่ยงต่อกลุ่มโรค Metabolic และแนะนำเข้าโครงการปรับเปลี่ยนพฤติกรรม</span></td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal91' type='radio' value='3 ส่งต่อเพื่อรักษา' id="normal93"/>ส่งต่อเพื่อรักษา
        </span></td>
        </tr>
    </table></td>
  </tr>
</table>
<br />
<TABLE width="100%" border="1" cellpadding="2" cellspacing="0" bordercolor="#393939"  bgcolor="#FEFBD6" >
 <tr bgcolor="#CCCCFF">
      <td height="49" align="center" bgcolor="#FFCC99" class="sum"><strong>สรุปผลการตรวจ</strong> :
        <br />
        <input name='normal71' type='radio' value='ปกติ' onclick="togglediv2('acnormal71');togglediv2('acnormal73');" id="normal171"/>
	      <span class="sum1">ปกติ</span>
	      <br />
          <input name='normal71' type='radio' value='มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)' onclick="togglediv1('acnormal73');togglediv2('acnormal71');" id="normal173"/> 
          มีปัจจัยเสี่ยงที่จะเกิดโรค (ผิดปกติเล็กน้อย)
          <div style="display:none" id="acnormal73">
              <input name="chk1" type="checkbox" value="Overweight" />Overweight 
              <input name="chk2" type="checkbox" value="Hyperuricemia" />Hyperuricemia 
              <input name="chk3" type="checkbox" value="Anemia" />Anemia
              <input name="chk4" type="checkbox" value="HLD" />HLD 
              <input name="chk5" type="checkbox" value="Impaired FG" />Impaired FG 
              <input name="chk6" type="checkbox" value="Renal insufficiency" />Renal insufficiency 
              <input name="chk7" type="checkbox" value="Mild hepatitis" />Mild hepatitis 
              <input name="chk8" type="checkbox" value="Other" />Other<input name="text71" type="text" id="txt71" size="20" />
          </div>
<br />
<input name='normal71' type='radio' value='เป็นโรค' onclick="togglediv1('acnormal71');togglediv2('acnormal73');" id="normal172"/>
	      <span class="sum2">เป็นโรค.....
          <div style="display:none" id="acnormal71">
				Diag : <input name="text72" type="text" id="txt72" size="20" />
          </div></span></td>
    </tr>
</TABLE>
<BR>
<!-- บันทึกการวินิฉัยจากแพทย์ -->
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FEFBD6">
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0" >
	<TR>
		<TD align="left" class="tb_font_1" bgcolor="#0033FF">&nbsp;&nbsp;&nbsp;บันทึกการวินิฉัยจากแพทย์</TD>
	</TR>
	<TR class="tb_font">
		<TD>
	 <table height="60" border="0" class="tb_font">
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
