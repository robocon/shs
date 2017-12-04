<?php
session_start();
include("connect.inc");

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
<title>Untitled Document</title>
<style>
	.font_title{font-family:"Angsana New"; font-size:28px}
	.tb_font{font-family:"Angsana New"; font-size:20px;}
	.tb_font_1{font-family:"Angsana New"; font-size:20px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:20px; background-color:#9FFF9F}

.tb_font_2 {
	color: #B00000;
	font-weight: bold;
}
.style5 {color: #000099; font-weight: bold; }
</style>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; เมนู</a>
<center>
  <div class="font_title">โปรแกรมซักประวัติตรวจสุขภาพ</div></center>

<form action="dx_ofyear_man.php" method="post">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
  <tr>
    <td width="41%" align="right"><TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">กรอกหมายเลข HN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="p_hn" />&nbsp;<input type="submit" name="Submit" value="ตกลง" /></TD>
	</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE></td>
    <td width="12%" align="center"><strong>หรือ</strong></td>
    <td width="47%"><TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">กรอก ID CARD เพื่อดึงข้อมูล</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="idcard" id="idcard"/>
        <input type="submit" name="Submit" value="ตกลง" /></TD>
	</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE></td>
  </tr>
</table>
<input name="post_vn" type="hidden" value="1" />
</form>
<br />

<?php if(!empty($_POST["post_vn"]) && $_POST["p_hn"] != ""){

//ค้นหา hn จาก opday ****************************************************************************************
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '".$_POST["p_hn"]."' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql) or die("Error line 117 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>ผู้ป่วยยังไม่ได้ทำการลงทะเบียน</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_assoc($result);

$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1";
list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));

$date_hn = date("Y-m-d").$arr_view["hn"];
$date_vn = date("Y-m-d").$arr_view["vn"];

/*$sql = "Select  weight, height,waist From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height,$waist) = Mysql_fetch_row($result);*/

$sql3 = "Select  temperature,pause,rate,weight,height,bp1,bp2,waist From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' and thidate like '$thaidate%'";
$result3 = Mysql_Query($sql3);
$cou = mysql_num_rows($result3);
list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$waist) = Mysql_fetch_row($result3);
if($cou=="0"){
	$sql3 = "Select  temperature,pause,rate,weight,height,bp1,bp2,doctor,clinic From dxofyear where hn = '".$arr_view["hn"]."' and thidate like '".date("Y-m-d")."%'";
	$result3 = Mysql_Query($sql3);
	list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$dr,$cli) = Mysql_fetch_row($result3);
}

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	//$sql = "Select dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
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

	$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."'  AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix')  Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select labcode, result, unit,normalrange,flag  From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix' ) Order by labcode ASC ";

	$result_ua = mysql_query($sql);

	$sql = "Select labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "Select labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix') Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);
//ค้นหาข้อมูลเดิม
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	//$sql = "Select * From  `dxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";
	$sql = "Select * From  `dxofyear` where  hn='".$arr_view["hn"]."' ORDER BY row_id DESC limit 0,1 ";
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
		$chest=$arr_dxofyear["chest"];
		$round_=$arr_dxofyear["round_"];
		$bloodsugar=$arr_dxofyear["bloodsugar"];

		
		$arr_view["vn"]=$arr_dxofyear["vn"];
		
		if($arr_dxofyear["congenital_disease"] != ''){ $congenital_disease = $arr_dxofyear["congenital_disease"];}else{$congenital_disease = "ปฎิเสธโรคประจำตัว";}
		
		//echo "arr_dxofyear";





		
}else{  //// ค้นหาจาก opd
	
		$sql = "Select congenital_disease, weight, height,cigarette,alcohol,exercise ,bp1,bp2,doctor  From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
		
		//echo "OPD";

		$result = Mysql_Query($sql);
		list($congenital_disease, $weight, $height, $cigarette, $alcohol, $exercise,$bp1,$bp2,$doctor) = Mysql_fetch_row($result);
			if($congenital_disease == "")
				$congenital_disease = "ปฎิเสธโรคประจำตัว";

	}
	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
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
?>


<?

$csql="select * from metabolic where hn='". $_POST["p_hn"]."'";
//echo $csql;
$cquery=mysql_query($csql);
$rows=mysql_fetch_array($cquery);
$position=$rows["position"];
$chest=$rows["chest"];
$waist=$rows["waist"];
$bloodsugar=$rows["bloodsugar"];
$family_dm=$rows["family_dm"];
$family_ht=$rows["family_ht"];
$hypertension=$rows["ht"];
$dm=$rows["dm"];
$diseases=$rows["diseases"];
$remedy=$rows["remedy"];
$hospital=$rows["remedy_hospital"];
$sanitation=$rows["remedy_sanitation"];
$clinicname=$rows["remedy_clinic"];
$icd10_dxofyear=$rows["icd10_dxofyear"];
$icd10_metabolic=$rows["icd10_metabolic"];
$icd10_depression=$rows["icd10_depression"];
$type_depression=$rows["type_depression"];
$service=$rows["service"];
$st5=$rows["st5_depression"];
$q2=$rows["2q_depression"];
$q9=$rows["9q_depression"];
$q8=$rows["8q_depression"];
$icd10_dm=$rows["icd10_dm"];
$icd10_hypertension=$rows["icd10_hypertension"];




$sql1 = "Select * From  chkup_solider  where hn = '".$arr_view["hn"]."' limit 0,1 ";
$result1 = Mysql_Query($sql1);
$arr_view1= mysql_fetch_assoc($result1);



?>
<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD=POST ACTION="dx_ofyear_save_man.php" target="_blank" <?php //if($arr_view["vn"] ==""){echo "Onsubmit=\"alert('ผู้ป่วยยังไม่ได้ทำการลงทะเบียน');return false;\"";}?>>

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
			
			<td colspan="2" align="right"><span class="tb_font_2">HN :</span><?php echo $arr_view["hn"];?></td>
		
			<td  colspan="3"  align="right"><span class="tb_font_2">ชื่อ-สกุล : </span><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
			
			<td colspan="3"  align="right"><span class="tb_font_2">อายุ :</span> <?php echo $arr_view["age"];?><input name="age" type="hidden" value="<?php echo $arr_view["age"];?>" /></td>
	
			</tr>
		<tr>
		  <td colspan="2" align="right"><span class="tb_font_2">สังกัด : </span></td>
		  <td colspan="2" ><? echo $arr_view1["camp"];?><input name="camp" type="hidden" id="camp" value="<?php echo $arr_view1["camp"];?>"/></td>
		  <td align="right"><span class="tb_font_2">ตำแหน่ง :</span></td>
		  <td colspan="3" ><?php echo $arr_view1["goup"]; ?><input name="goup" type="hidden" id="goup" value="<?php echo $arr_view1["goup"];?>"/></td>
		</tr>
	</table>
	<hr />
	<table width="854" border="0" class="tb_font">
	  <tr>
			<td width="133" align="right" class="tb_font_2">ส่วนสูง : </td>
			<td width="103"><input name="height" type="text" size="1" maxlength="3" value="<?php echo $height; ?>" />
ซม.</td>
			<td width="84" align="right"><span class="tb_font_2">น้ำหนัก :</span></td>
			<td width="115"><input name="weight" type="text" size="1" maxlength="3" value="<?php echo $weight; ?>" />
กก. </td>
			<td width="106" align="right" class="tb_font_2"><span class="tb_font_2">BMI :</span></td>
			<td width="82"><input name="bmi" type="text" size="3"  value="<?php echo $bmi; ?>"  /></td>
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
		  <td align="right"><span class="tb_font_2">รอบอก :</span></td>
		  <td><input name="chest" type="text" size="1" maxlength="3" value="<?php echo $chest; ?>" />
		   ซม. </td>
		  <td align="right"><span class="tb_font_2">รอบเอว :</span></td>
		  <td><input name="round_" type="text" size="1" maxlength="3" value="<?php echo $round_; ?>" />
		    ซม.</td>
		  <td align="right"><span class="tb_font_2">น้ำตาลในเลือด :</span></td>
		  <td><input name="bloodsugar" type="text" size="1" value="<?php echo $bloodsugar; ?>" /></td>
		  <td align="left">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">แพ้ยา :</td>
		  <td><span class="data_show">
		    <input name="drugreact" type="radio" value="0" />
ไม่แพ้</span></td>
		  <td>&nbsp;</td>
		  <td colspan="5"><span class="data_show">
		    <input name="drugreact" type="radio" value="1" />
แพ้ <font class="data_drugreact"><?php echo $txt_react2;?></font></span></td>
		  </tr>
		 <td align="right" class="tb_font_2">บุหรี่ :</td>
		  <td><input type="radio" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?> />
		    ไม่เคยสูบ&nbsp;&nbsp;&nbsp;&nbsp;</td>
		  <td>&nbsp;</td>
		  <td colspan="2"><input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; } ?> />
		    เคยสูบ แต่เลิกแล้ว</td>
		  <td colspan="2"><input type="radio" name="cigarette" value="3" <?php if($cigarette==3){ echo "checked"; } ?> />
		    สูบเป็นครั้งคราว </td>
		  <td><input type="radio" name="cigarette" value="4" <?php if($cigarette==4){ echo "checked"; } ?> />
		    สูบเป็นประจำ</td>
		  </tr>
		<tr>
          <td align="right" class="tb_font_2">สุรา :</td>
		  <td><input type="radio" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> />
		    ไม่ดื่ม</td>
		  <td>&nbsp;</td>
		  <td colspan="2"><input type="radio" name="alcohol" value="2" <?php if($alcohol==2){ echo "checked"; } ?> />
		    เคยดื่ม แต่เลิกแล้ว </td>
		  <td colspan="2"><input type="radio" name="alcohol" value="3" <?php if($alcohol==3){ echo "checked"; } ?> />
		    ดื่มเป็นครั้งคราว</td>
		  <td><input type="radio" name="alcohol" value="4" <?php if($alcohol==4){ echo "checked"; } ?> />
		    ดื่มเป็นประจำ</td>
		  </tr>
		
		<tr>
		  <td align="right" class="tb_font_2">ออกกำลังกาย :</td>
		  <td colspan="2"><input type="radio" name="exercise" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
ไม่ออกกำลังกาย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		  <td colspan="2"><input type="radio" name="exercise" value="2" <?php if($exercise==2){ echo "checked"; } ?> />
ออกกำลังกายไม่ถึงเกณฑ์</td>
		  <td colspan="3"><input type="radio" name="exercise" value="3" <?php if($exercise==3){ echo "checked"; } ?> />
ออกกำลังกายตามเกณฑ์</td>
		  </tr>
		<tr>
		  <td colspan="3" align="right" class="tb_font_2">พ่อแม่ ญาติ พี่น้องสายตรงเป็นเบาหวาน :</td>
		  <td colspan="5"><input type="radio" name="family_dm" value="0" <?php if($family_dm=="0"){ echo "checked"; } ?> />
		    ไม่ทราบ
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="family_dm" value="1" <?php if($family_dm=="1"){ echo "checked"; } ?> />
            มี
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="family_dm" value="2" <?php if($family_dm=="2"){ echo "checked"; } ?> />
ไม่มี</td>
		  </tr>
		<tr>
		  <td colspan="3" align="right" class="tb_font_2">พ่อแม่ ญาติ พี่น้องสายตรงเป็นความดันโลหิตสูง :</td>
		  <td colspan="5"><input type="radio" name="family_ht" value="0" <?php if($family_ht=="0"){ echo "checked"; } ?> />
ไม่ทราบ
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="family_ht" value="1" <?php if($family_ht=="1"){ echo "checked"; } ?> />
มี
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="family_ht" value="2" <?php if($family_ht=="2"){ echo "checked"; } ?> />
ไม่มี</td>
		  </tr>
		<tr>
		  <td colspan="3" align="right" class="tb_font_2">เคยเป็นความดันโลหิตสูง :</td>
		  <td colspan="5"><input type="radio" name="hypertension" value="0" <?php if($hypertension=="0"){ echo "checked"; } ?> />
ไม่ทราบ
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="hypertension" value="1" <?php if($hypertension=="1"){ echo "checked"; } ?> />
มี
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="hypertension" value="2" <?php if($hypertension=="2"){ echo "checked"; } ?> />
ไม่มี</td>
		  </tr>
		<tr>
		  <td colspan="3" align="right" class="tb_font_2">เคยเป็นโรคเบาหวานหรือมีน้ำตาลในเลือดสูง :</td>
		  <td colspan="5"><input type="radio" name="dm" value="0" <?php if($dm=="0"){ echo "checked"; } ?> />
ไม่ทราบ
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="dm" value="1" <?php if($dm=="1"){ echo "checked"; } ?> />
มี
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="dm" value="2" <?php if($dm=="2"){ echo "checked"; } ?> />
ไม่มี</td>
		  </tr>
	</table>
	<hr />
	<TABLE class="tb_font">
	</TABLE>
	<TABLE width="780" class="tb_font">
	<tr>
	  <td align="right" class="tb_font_2">มีโรคประจำหรือไม่ :</td>
	  <td colspan="5" align="left">
	    <input type="radio" name="diseases" value="1" <?php if($diseases=="1"){ echo "checked"; } ?> />
	    ปฎิเสธ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="radio" name="diseases" value="2" <?php if($diseases=="2"){ echo "checked"; } ?> />
ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="diseases" value="3" <?php if($diseases=="3"){ echo "checked"; } ?> />
 ไม่ป่วย</td>
	  </tr>
	<tr>
           <td width="134" align="right" class="tb_font_2">โรคประจำตัว :</td>
           <td colspan="5" align="left"><span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>"/>
             <input type="button"  onclick="document.getElementById('congenital_disease').value='ปฎิเสธ';" name="Submit3" value="ปฎิเสธ" />
           </span></td>
         </tr>
	<tr>
	  <td align="right" class="tb_font_2">รักษาหรือไม่ :</td>
	  <td colspan="5" align="left"><input type="radio" name="remedy" value="y" <?php if($remedy!=""){ echo "checked"; } ?> />
	    รักษา
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="remedy" value="n" <?php if($remedy==""){ echo "checked"; } ?> />
ไม่รักษา</td>
	  </tr>
	<tr>
	  <td align="right" class="tb_font_2">ชื่อโรงพยาบาล :</td>
	  <td width="107" align="left"><input name="hospital" type="text" size="15" value="<?php echo $hospital; ?>" /></td>
	  <td width="124" align="right"><span class="tb_font_2">ชื่อสถานีอนามัย :</span></td>
	  <td width="122" align="left"><input name="sanitation" type="text" size="15" value="<?php echo $sanitation; ?>" /></td>
	  <td width="156" align="right"><span class="tb_font_2">ชื่อคลีนิค :</span></td>
	  <td width="109" align="left"><input name="clinicname" type="text" size="15" value="<?php echo $clinicname; ?>" /></td>
	</tr>
	<tr>
      <td align="right" class="tb_font_2">ICD10 ตรวจร่างกาย :</td>
	  <td align="left"><input name="icd10_dxofyear" type="text" size="15" value="Z000" /></td>
	  <td align="right"><span class="tb_font_2">ICD10 เมตาโบลิค :</span></td>
	  <td align="left"><input name="icd10_metabolic" type="text" size="15" value="Z138" /></td>
	  <td align="right"><span class="tb_font_2">ICD10 ภาวะซึมเศร้า :</span></td>
	  <td align="left"><input name="icd10_depression" type="text" size="15" value="Z133" /></td>
	  </tr>
      	<tr>
	  <td colspan="3" align="right" class="tb_font_2">ICD10 คัดกรองเบาหวาน :</td>
	  <td align="left"><input name="icd10_dm" type="text" id="icd10_dm" size="15"  value="Z131" /></td>
	  <td align="left">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="left">&nbsp;</td>
	  </tr>
      	<tr>
	  <td colspan="3" align="right" class="tb_font_2">ICD10 คัดกรองความดัน :</td>
	  <td align="left"><input name="icd10_hypertension" type="text" id="icd10_hypertension" size="15"  value="Z013" /></td>
	  <td align="left">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="left">&nbsp;</td>
	  </tr>
	
	<tr>
	  <td align="right" class="tb_font_2">คัดกรองภาวะซึมเศร้า :</td>
	  <td colspan="5" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">ST5</span> 
	    <input name="st5_depression" type="text" id="st5_depression" size="10"   value="<?php echo $st5; ?>" />
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">2Q</span>
        <input name="2q_depression" type="text" id="2q_depression" size="10"  value="<?php echo $q2; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">9Q</span>
<input name="9q_depression" type="text" id="9q_depression" size="10" value="<?php echo $q9; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">8Q</span>
<input name="8q_depression" type="text" id="8q_depression" size="10" value="<?php echo $q8; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  </tr>
<tr>
	  <td align="right" class="tb_font_2">สถานที่บริการ :</td>
	  <td colspan="5" align="left"><input type="radio" name="service" value="y" <?php if($service=="y"){ echo "checked"; } ?> />
	    ในสถานบริการ
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="servic" value="n" <?php if($service=="n"){ echo "checked"; } ?> /> 
        นอกสถานบริการ</td>
	  </tr>
	<tr>
	  <td align="right" class="tb_font_2">ลักษณะผู้ป่วย : </td>
	  <td colspan="5" align="left"><input name="type" type="radio" value="เดินมา"  <?php if($type=="เดินมา"){ echo "checked"; } ?> />
เดินมา
  <input name="type" type="radio" value="นั่งรถเข็น"  <?php if($type=="นั่งรถเข็น"){ echo "checked"; } ?> />
นั่งรถเข็น
<input name="type" type="radio" value="นอนเปล"  <?php if($type=="นอนเปล"){ echo "checked"; } ?>/>
นอนเปล
<input name="type" type="radio" value="ญาติ" <?php if($type=="ญาติ"){ echo "checked"; } ?>/>
ญาติ</td><!--onclick="clear_textbox();" -->
	  </tr>
	</TABLE>
	<TABLE class="tb_font">
	  <tr>
           <td align="right" valign="top" class="tb_font_2">อาการ : </td>
           <td colspan="2" align="left" valign="top"><textarea id="organ" name="organ" cols="40" rows="6" >ตรวจสุขภาพประจำปี<?php echo $og;?></textarea> &nbsp;&nbsp;</td>
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
             </select>           </td>
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
             </select>           </td>
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

<center>
<!--<input name="submit" type="submit" value="ตกลง"  />&nbsp;&nbsp;-->
<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" />
</center>
<INPUT TYPE="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
</FORM>


<?php }else if(!empty($_POST["post_vn"]) && $_POST["idcard"] != ""){ 
$arr_sql="select * from chkupmain58 as a left join opcard as b on a.f=b.idcard where a.f='".$_POST["idcard"]."'";
$arr_query=mysql_query($arr_sql);
$arr_view1=mysql_fetch_array($arr_query);
$ptname=$arr_view1["c"]." ".$arr_view1["d"];
$cigarette=$arr_view1["z"];
$alcohol=$arr_view1["aa"];
$exercise=$arr_view1["ab"];
$family_dm=$arr_view1["v"];
$family_ht=$arr_view1["w"];
$hypertension=$arr_view1["x"];
$dm=$arr_view1["y"];
$diseases=$arr_view1["l"];
$remedy=$arr_view1["m"];
$hn=$arr_view1["hn"];
$st5=$arr_view1["ac"];
$q2=$arr_view1["ad"];
$q9=$arr_view1["ae"];
$q8=$arr_view1["af"];



$sql2 = "Select * From  chkup_solider  where hn = '$hn' limit 1 ";
$result2 = Mysql_Query($sql2);
$arr_view2= mysql_fetch_assoc($result2);


?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD=POST ACTION="dx_ofyear_save_man.php" target="_blank" <?php //if($arr_view["vn"] ==""){echo "Onsubmit=\"alert('ผู้ป่วยยังไม่ได้ทำการลงทะเบียน');return false;\"";}?>>

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view1["e"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $hn;?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $arr_view1["vn"];?>" />

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
			
			<td colspan="2" align="right"><span class="tb_font_2">HN :</span><?php echo $arr_view1["hn"];?></td>
		
			<td  colspan="3"  align="right"><span class="tb_font_2">ชื่อ-สกุล : </span><?php echo $ptname; ?><input name="ptname" type="hidden" id="ptname" value="<?php echo $ptname ;?>"/></td>
			
			<td colspan="3"  align="right"><span class="tb_font_2">อายุ :</span> <?php echo $arr_view1["e"];?><input name="age" type="hidden" value="<?php echo $arr_view1["e"];?>" /></td>
	
			</tr>
		<tr>
		  <td colspan="2" align="right"><span class="tb_font_2">สังกัด : </span></td>
		  <td colspan="2" ><? echo $arr_view2["camp"];?><input name="camp" type="hidden" id="camp" value="<? echo $arr_view2["camp"];?>"/></td>
		  <td align="right"><span class="tb_font_2">ตำแหน่ง :</span></td>
		  <td colspan="3" ><?php echo $arr_view2["goup"]; ?><input name="goup" type="hidden" id="goup" value="<?php echo $arr_view2["goup"]; ?>"/></td>
		</tr>
	</table>
	<hr />
	<table width="854" border="0" class="tb_font">
	  <tr>
			<td width="133" align="right" class="tb_font_2">ส่วนสูง : </td>
			<td width="103"><input name="height" type="text" size="1" maxlength="3" value="<?php echo $arr_view1["o"];?>" />
ซม.</td>
			<td width="84" align="right"><span class="tb_font_2">น้ำหนัก :</span></td>
			<td width="115"><input name="weight" type="text" size="1" maxlength="3" value="<?php echo $arr_view1["n"];?>" />
กก. </td>
			<td width="106" align="right" class="tb_font_2"><span class="tb_font_2">BMI :</span></td>
			<td width="82"><input name="bmi" type="text" size="3"  value="<?php echo $arr_view1["p"];?>"  /></td>
			<td width="67" align="left"><span class="tb_font_2">BP1 :</span></td>
			<td width="130" align="left"><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $arr_view1["q"];?>" />
			  /
			  <input name="bp2" type="text" size="1" maxlength="3" value="<?php echo $arr_view1["r"];?>" />
			  mmHg</td>
			</tr>
		<tr>
		  <td align="right" class="tb_font_2">T :</td>
		  <td><input name="temperature" type="text" size="1" maxlength="5" value="<?php echo $arr_view1[""];?>" />
C&deg; </td>
		  <td align="right"><span class="tb_font_2">P :</span></td>
		  <td align="left"><input name="pause" type="text" size="1" maxlength="3" value="<?php echo $arr_view1["s"];?>" />
ครั้ง/นาที</td>
		  <td align="right"><span class="tb_font_2">R :</span></td>
		  <td align="left"><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $arr_view1[""];?>" />
ครั้ง/นาที</td>
		  <td align="left"><span class="tb_font_2">BP2 :</span></td>
		  <td align="left"><input name="bp21" type="text" size="1" maxlength="3" value="<?php echo $arr_view1[""];?>" />
/
  <input name="bp22" type="text" size="1" maxlength="3" value="<?php echo $arr_view1[""];?>" />
mmHg</td>
		  </tr>
		<tr>
		  <td align="right"><span class="tb_font_2">รอบอก :</span></td>
		  <td><input name="chest" type="text" size="1" maxlength="3" value="<?php echo $arr_view1[""];?>" />
		    ซม.</td>
		  <td align="right"><span class="tb_font_2">รอบเอว :</span></td>
		  <td><input name="round_" type="text" size="1" maxlength="3" value="<?php echo $arr_view1["u"];?>" />
		    ซม.</td>
		  <td align="right"><span class="tb_font_2">น้ำตาลในเลือด :</span></td>
		  <td><input name="bloodsugar" type="text" size="1" value="<?php echo $arr_view1[""];?>" /></td>
		  <td align="left">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">แพ้ยา :</td>
		  <td><span class="data_show">
		    <input name="drugreact" type="radio" value="0" />
ไม่แพ้</span></td>
		  <td>&nbsp;</td>
		  <td colspan="5"><span class="data_show">
		    <input name="drugreact" type="radio" value="1" />
แพ้ <font class="data_drugreact"><?php echo $txt_react2;?></font></span></td>
		  </tr>
		<tr>
          <td align="right" class="tb_font_2">บุหรี่ :</td>
		  <td><input type="radio" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?> />
		    ไม่เคยสูบ&nbsp;&nbsp;&nbsp;&nbsp;</td>
		  <td>&nbsp;</td>
		  <td colspan="2"><input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; } ?> />
		    เคยสูบ แต่เลิกแล้ว</td>
		  <td colspan="2"><input type="radio" name="cigarette" value="3" <?php if($cigarette==3){ echo "checked"; } ?> />
		    สูบเป็นครั้งคราว </td>
		  <td><input type="radio" name="cigarette" value="4" <?php if($cigarette==4){ echo "checked"; } ?> />
		    สูบเป็นประจำ</td>
		  </tr>
		<tr>
          <td align="right" class="tb_font_2">สุรา :</td>
		  <td><input type="radio" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> />
		    ไม่ดื่ม</td>
		  <td>&nbsp;</td>
		  <td colspan="2"><input type="radio" name="alcohol" value="2" <?php if($alcohol==2){ echo "checked"; } ?> />
		    เคยดื่ม แต่เลิกแล้ว </td>
		  <td colspan="2"><input type="radio" name="alcohol" value="3" <?php if($alcohol==3){ echo "checked"; } ?> />
		    ดื่มเป็นครั้งคราว</td>
		  <td><input type="radio" name="alcohol" value="4" <?php if($alcohol==4){ echo "checked"; } ?> />
		    ดื่มเป็นประจำ</td>
		  </tr>
		
		<tr>
		  <td align="right" class="tb_font_2">ออกกำลังกาย :</td>
		  <td colspan="2"><input type="radio" name="exercise" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
ไม่ออกกำลังกาย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
		  <td colspan="2"><input type="radio" name="exercise" value="2" <?php if($exercise==2){ echo "checked"; } ?> />
ออกกำลังกายไม่ถึงเกณฑ์</td>
		  <td colspan="3"><input type="radio" name="exercise" value="3" <?php if($exercise==3){ echo "checked"; } ?> />
ออกกำลังกายตามเกณฑ์</td>
		  </tr>
		<tr>
		  <td colspan="3" align="right" class="tb_font_2">พ่อแม่ ญาติ พี่น้องสายตรงเป็นเบาหวาน :</td>
		  <td colspan="5"><input type="radio" name="family_dm" value="0" <?php if($family_dm=="0"){ echo "checked"; } ?> />
		    ไม่ทราบ
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="family_dm" value="1" <?php if($family_dm=="1"){ echo "checked"; } ?> />
            มี
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="family_dm" value="2" <?php if($family_dm=="2"){ echo "checked"; } ?> />
ไม่มี</td>
		  </tr>
		<tr>
		  <td colspan="3" align="right" class="tb_font_2">พ่อแม่ ญาติ พี่น้องสายตรงเป็นความดันโลหิตสูง :</td>
		  <td colspan="5"><input type="radio" name="family_ht" value="0" <?php if($family_ht=="0"){ echo "checked"; } ?> />
ไม่ทราบ
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="family_ht" value="1" <?php if($family_ht=="1"){ echo "checked"; } ?> />
มี
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="family_ht" value="2" <?php if($family_ht=="2"){ echo "checked"; } ?> />
ไม่มี</td>
		  </tr>
		<tr>
		  <td colspan="3" align="right" class="tb_font_2">เคยเป็นความดันโลหิตสูง :</td>
		  <td colspan="5"><input type="radio" name="hypertension" value="0" <?php if($hypertension=="0"){ echo "checked"; } ?> />
ไม่ทราบ
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="hypertension" value="1" <?php if($hypertension=="1"){ echo "checked"; } ?> />
มี
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="hypertension" value="2" <?php if($hypertension=="2"){ echo "checked"; } ?> />
ไม่มี</td>
		  </tr>
		<tr>
		  <td colspan="3" align="right" class="tb_font_2">เคยเป็นโรคเบาหวานหรือมีน้ำตาลในเลือดสูง :</td>
		  <td colspan="5"><input type="radio" name="dm" value="0" <?php if($dm=="0"){ echo "checked"; } ?> />
ไม่ทราบ
		    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            <input type="radio" name="dm" value="1" <?php if($dm=="1"){ echo "checked"; } ?> />
มี
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="dm" value="2" <?php if($dm=="2"){ echo "checked"; } ?> />
ไม่มี</td>
		  </tr>
	</table>
	<hr />
	<TABLE class="tb_font">
	</TABLE>
	<TABLE width="780" class="tb_font">
	<tr>
	  <td align="right" class="tb_font_2">มีโรคประจำหรือไม่ :</td>
	  <td colspan="5" align="left">
	    <input type="radio" name="diseases" value="1" <?php if($diseases=="1"){ echo "checked"; } ?> />
	    ปฎิเสธ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	    <input type="radio" name="diseases" value="2" <?php if($diseases=="2"){ echo "checked"; } ?> />
ป่วย&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="diseases" value="3" <?php if($diseases=="3"){ echo "checked"; } ?> />
 ไม่ป่วย</td>
	  </tr>
	<tr>
           <td width="134" align="right" class="tb_font_2">โรคประจำตัว :</td>
           <td colspan="5" align="left"><span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>"/>
             <input type="button"  onclick="document.getElementById('congenital_disease').value='ปฎิเสธ';" name="Submit3" value="ปฎิเสธ" />
           </span></td>
         </tr>
	<tr>
	  <td align="right" class="tb_font_2">รักษาหรือไม่ :</td>
	  <td colspan="5" align="left"><input type="radio" name="remedy" value="y" <?php if($remedy!=""){ echo "checked"; } ?> />
	    รักษา
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input type="radio" name="remedy" value="n" <?php if($remedy==""){ echo "checked"; } ?> />
ไม่รักษา</td>
	  </tr>
	<tr>
	  <td align="right" class="tb_font_2">ชื่อโรงพยาบาล :</td>
	  <td width="107" align="left"><input name="hospital" type="text" size="15" value="<?php echo $hospital; ?>" /></td>
	  <td width="124" align="right"><span class="tb_font_2">ชื่อสถานีอนามัย :</span></td>
	  <td width="122" align="left"><input name="sanitation" type="text" size="15" value="<?php echo $sanitation; ?>" /></td>
	  <td width="156" align="right"><span class="tb_font_2">ชื่อคลีนิค :</span></td>
	  <td width="109" align="left"><input name="clinicname" type="text" size="15" value="<?php echo $clinicname; ?>" /></td>
	</tr>
	<tr>
      <td align="right" class="tb_font_2">ICD10 ตรวจร่างกาย :</td>
	  <td align="left"><input name="icd10_dxofyear" type="text" size="15" value="Z000" /></td>
	  <td align="right"><span class="tb_font_2">ICD10 เมตาโบลิค :</span></td>
	  <td align="left"><input name="icd10_metabolic" type="text" size="15" value="Z138" /></td>
	  <td align="right"><span class="tb_font_2">ICD10 ภาวะซึมเศร้า :</span></td>
	  <td align="left"><input name="icd10_depression" type="text" size="15" value="Z133" /></td>
	  </tr>
      	<tr>
	  <td colspan="3" align="right" class="tb_font_2">ICD10 คัดกรองเบาหวาน :</td>
	  <td align="left"><input name="icd10_dm" type="text" id="icd10_dm" size="15"  value="Z131" /></td>
	  <td align="left">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="left">&nbsp;</td>
	  </tr>
      	<tr>
	  <td colspan="3" align="right" class="tb_font_2">ICD10 คัดกรองความดัน :</td>
	  <td align="left"><input name="icd10_hypertension" type="text" id="icd10_hypertension" size="15"  value="Z013" /></td>
	  <td align="left">&nbsp;</td>
	  <td align="right">&nbsp;</td>
	  <td align="left">&nbsp;</td>
	  </tr>
	
	<tr>
	  <td align="right" class="tb_font_2">คัดกรองภาวะซึมเศร้า :</td>
	  <td colspan="5" align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">ST5</span> 
	    <input name="st5_depression" type="text" id="st5_depression" size="10"   value="<?php echo $st5; ?>" />
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">2Q</span>
        <input name="2q_depression" type="text" id="2q_depression" size="10"  value="<?php echo $q2; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">9Q</span>
<input name="9q_depression" type="text" id="9q_depression" size="10" value="<?php echo $q9; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<span class="tb_font_2">8Q</span>
<input name="8q_depression" type="text" id="8q_depression" size="10" value="<?php echo $q8; ?>" />
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</td>
	  </tr>
<tr>
	  <td align="right" class="tb_font_2">สถานที่บริการ :</td>
	  <td colspan="5" align="left"><input type="radio" name="service" value="y" <?php if($service=="y"){ echo "checked"; } ?> />
	    ในสถานบริการ
	    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
        <input type="radio" name="servic" value="n" <?php if($service=="n"){ echo "checked"; } ?> /> 
        นอกสถานบริการ</td>
	  </tr>
	<tr>
	  <td align="right" class="tb_font_2">ลักษณะผู้ป่วย : </td>
	  <td colspan="5" align="left"><input name="type" type="radio" value="เดินมา"  <?php if($type=="เดินมา"){ echo "checked"; } ?> />
เดินมา
  <input name="type" type="radio" value="นั่งรถเข็น"  <?php if($type=="นั่งรถเข็น"){ echo "checked"; } ?> />
นั่งรถเข็น
<input name="type" type="radio" value="นอนเปล"  <?php if($type=="นอนเปล"){ echo "checked"; } ?>/>
นอนเปล
<input name="type" type="radio" value="ญาติ" <?php if($type=="ญาติ"){ echo "checked"; } ?>/>
ญาติ</td><!--onclick="clear_textbox();" -->
	  </tr>
	</TABLE>
	<TABLE class="tb_font">
	  <tr>
           <td align="right" valign="top" class="tb_font_2">อาการ : </td>
           <td colspan="2" align="left" valign="top"><textarea id="organ" name="organ" cols="40" rows="6" >ตรวจสุขภาพประจำปี<?php echo $og;?></textarea> &nbsp;&nbsp;</td>
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
             </select>           </td>
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
             </select>           </td>
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

<center>
<!--<input name="submit" type="submit" value="ตกลง"  />&nbsp;&nbsp;-->
<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" />
</center>
<INPUT TYPE="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
</FORM>		
        
<?
		}
include("unconnect.inc");
 ?>
</body>


</html>

<br />
<? 
include("connect.inc");	

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
		
$num='0';
$sql1="SELECT * FROM  dxofyear where yearchk='$nPrefix' and ( weight != '' ) ORDER BY row_id DESC limit 5";
$query1=mysql_query($sql1)or die (mysql_error());

$cnum=mysql_num_rows($query1);

//echo $cnum;

?>
<h1 class="pdx" align="center"><font face='Angsana New'>รายชื่อผู้ตรวจสุขภาพที่ลงผล ซักประวัติแล้ว</h1>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="pdxpro">
  <tr>
 <td  bgcolor="#CCCCCC"><font face='Angsana New'>NO</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>HN</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>ชื่อ-สกุล</td>
 <td  bgcolor="#CCCCCC"><font face='Angsana New'>อายุ</td>
 <td  bgcolor="#CCCCCC"><font face='Angsana New'>สังกัด</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>น้ำหนัก</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>ส่วนสูง</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>BMI</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>TEMP</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>P</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>BP1</td>
    <td  bgcolor="#CCCCCC"><font face='Angsana New'>BP2</td>
    

 														 





  </tr>
  <? while($arr1=mysql_fetch_array($query1)){ 

$num++



?>

  <tr>
    <td><font face='Angsana New'><?=$num;?></td>
    <td><font face='Angsana New'><?=$arr1['hn'];?></td>
    <td><font face='Angsana New'><?=$arr1['ptname'];?></td>
   <td><font face='Angsana New'><?=$arr1['age'];?></td>
   <td><font face='Angsana New'><?=$arr1['camp'];?></td>
    <td><font face='Angsana New'><?=$arr1['weight'];?></td>
<td><font face='Angsana New'><?=$arr1['height'];?></td>
<td><font face='Angsana New'><? echo $b;?></td>
<td><font face='Angsana New'><?=$arr1['temperature'];?></td>
<td><font face='Angsana New'><?=$arr1['pause'];?></td>
<td><font face='Angsana New'><?=$arr1['bp1'];?>/<?=$arr1['bp2'];?></td>
<td><font face='Angsana New'><?=$arr1['bp21'];?>/<?=$arr1['bp22'];?></td>
 
 </tr>
  <? } ?>
</table>
<br>
<?php
    include("connect.inc");
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
		
   $query="SELECT  camp,COUNT(*) AS duplicate FROM dxofyear where yearchk='$nPrefix' and weight != ''  GROUP BY camp HAVING duplicate > 0 ORDER BY camp";
   $result = mysql_query($query);
     $n=0;
 while (list ($camp,$duplicate) = mysql_fetch_row ($result)) {
            $n++;
$num= $duplicate+$num;

list($doctor) = mysql_fetch_row(mysql_query("Select name From doctor where name like '{$codedoctor}%' limit 1 "));
            print (" <tr>\n".
               "  <td BGCOLOR=66CDAA><font face='Angsana New'>$n&nbsp;&nbsp;</td>\n".
              "  <td BGCOLOR=66CDAA><font face='Angsana New'>$camp&nbsp;&nbsp;</a></td>\n".
 
        "  <td BGCOLOR=66CDAA><font face='Angsana New'>จำนวน&nbsp; = &nbsp;<a target=_BLANK href=\"chkallchkupokvs.php? camp=$camp\">$duplicate </a>&nbsp;&nbsp;คน</td>\n".
               " </tr>\n<br>");
               }



 print "จำนวนทั้งหมด.... $num..คน</a><br> ";
   include("unconnect.inc");
?>
</body>
</html>
