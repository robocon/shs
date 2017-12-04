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
<title>Untitled Document</title>
<style>
	.font_title{font-family:"Angsana New"; font-size:36px}
	.tb_font{font-family:"Angsana New"; font-size:24px;}
	.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F}

.tb_font_2 {
	color: #B00000;
	font-weight: bold;
}
.style5 { font-weight: bold; }

.pdxhead {
	font-family: "TH SarabunPSK";
	font-size: 24px;
}
.pdxpro {
	font-family: "TH SarabunPSK";
	font-size: 22px;
}
.pdx {
	font-family: "TH SarabunPSK";
	font-size: 20px;
}
.stricker {
	font-family: "TH SarabunPSK";
	font-size: 16px;
}
.stricker1 {
	font-family: "TH SarabunPSK";
	font-size: 14px;
}
@media print{
#no_print{display:none;}
}

.theBlocktoPrint 
{ 
background-color: #000; 
color: #FFF; 
}
</style>
<script>
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
		//sss
	}
}
</script>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; เมนู</a>
<center>
  <div class="font_title">โปรแกรมตรวจสุขภาพประจำปีแบบกลุ่ม</div></center>

<form action="dx_ofyear_group.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#FFFFCE" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">กรอกหมายเลข HN , ชื่อ-สกุล</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/><input type="submit" name="Submit1" value="ตกลง" /></TD>
</TR>
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<input name="post_vn" type="hidden" value="1" />
</form>

<?php //if(!empty($_POST["post_vn"]) && $_POST["p_hn"] != ""){

//ค้นหา hn จาก opday ****************************************************************************************
	/*$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '".$_POST["p_hn"]."' limit 0,1";
	
	$result = mysql_query($sql) or die("Error line 117 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>ผู้ป่วยยังไม่ได้ทำการลงทะเบียน</CENTER>";
		exit();
	}*/
	//$arr_view = mysql_fetch_assoc($result);
	/*$sql1 = "select * from predxofyear where hn='%".$_POST['p_hn']."%' order by row_id desc limit 1";
	$result1 = mysql_query($sql1);
	$arr_view1 = mysql_fetch_assoc($result1);
	
$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$arr_view1["hn"]."' limit 0,1";
list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));

$date_hn = date("Y-m-d").$arr_view1["hn"];
$date_vn = date("Y-m-d").$arr_view["vn"];

$sql = "Select  weight, height From opd where hn = '".$arr_view1["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height) = Mysql_fetch_row($result);

//ค้นหาวันเกิดจาก opcard ****************************************************************************************
	$sql = "Select dbirth From opcard where hn = '".$arr_view1["hn"]."' limit  0,1";
	$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view1["age"] = calcage($arr_view1["dbirth"]);

//ค้นหาผลการตรวจทางพยาธิ ****************************************************************************************

	$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."'  AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54')  Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select labcode, result, unit  From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54' ) Order by labcode ASC";

	$result_ua = mysql_query($sql);

	$sql = "Select labcode, result, unit From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "Select labcode, result, unit From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by labcode ASC ";
	$result_lab = mysql_query($sql);
//ค้นหาข้อมูลเดิม
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	$sql = "Select * From  `predxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	if($count > 0){
		$arr_dxofyear = mysql_fetch_assoc($result);
		$height = $arr_dxofyear["height"];
		$weight = $arr_dxofyear["weight"];
		if($arr_dxofyear["cigarette"] == '1'){ $cigarette1 = "Checked";}else if($arr_dxofyear["cigarette"] == '0'){$cigarette0 = "Checked";}
		if($arr_dxofyear["alcohol"] == '1'){ $alcohol1 = "Checked";}else if($arr_dxofyear["alcohol"] == '0'){$alcohol0 = "Checked";}
		if($arr_dxofyear["congenital_disease"] != ''){ $congenital_disease = $arr_dxofyear["congenital_disease"];}else{$congenital_disease = "ปฎิเสธโรคประจำตัว";}
		
		
	}else{
		$sql = "Select congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END )   From opd where hn = '".$arr_view["hn"]."' AND type <> 'ญาติ' Order by row_id DESC limit 1";

		$result = Mysql_Query($sql);
		list($congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0) = Mysql_fetch_row($result);
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
*/
if(isset($_POST['Submit1'])){
?>

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD=POST ACTION="dx_ofyear_save_group.php" target="_blank">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view1["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $arr_view["vn"];?>" />
<?
if(isset($_POST['Submit1'])){
	$sql = "select * from dxofyear where hn= '".$_POST['p_hn']."' and camp = 'MX01 SCG' order by row_id desc limit 1";
	$row = mysql_query($sql);
	$numquery = mysql_num_rows($row);
	if($numquery=="0"){
		$sql = "select * from dxofyear where ptname like '%".$_POST['p_hn']."%' and camp = 'MX01 SCG' order by row_id desc limit 1";
		$row = mysql_query($sql);
		$numquery = mysql_num_rows($row);
		if($numquery=="0"){
			echo "ไม่มีข้อมูลการตรวจ";
		}
		else{
			$query = mysql_fetch_array($row);
		}
	}else{
		$query = mysql_fetch_array($row);
	}
}

if($numquery!="0"){

$sql3 = "select * from predxofyear where hn='".$query['hn']."' order by row_id desc limit 1";
$row3= mysql_query($sql3);
$query3 = mysql_fetch_array($row3);

$pic = explode("-",$query3['company']);
$ban = explode(" ",$query3['type_check']);

$sql1 = "select * from opcard where hn='".$query['hn']."' ";
$row1 = mysql_query($sql1);
$query1 = mysql_fetch_array($row1);


?>
<TABLE width="90%" border="1" cellpadding="0" cellspacing="0">
<TR>
	<td>
<table width="89%">
    <tr>
    	<td width="120" rowspan="3" align="center" valign="top"><img src="images/logo.jpg" width="87" height="83" /></td>
    	<td align="center" class="pdx"><strong><span class="pdx"><span class="pdxhead">แบบการตรวจสุขภาพ    	  
   	    <?=$pic[1]?></span></span></strong></td>
        <td width="163" rowspan="3" align="center" valign="top"><img src="images/<?=$pic[0]?>.jpg" width="120" height="75" /></td>
    </tr>
    <tr>
      <td align="center" class="pdxhead"><strong>โรงพยาบาลค่ายสุรศักดิ์มนตรี อ.เมือง จ.ลำปาง โทร. 054-839305</strong></td>
      </tr>
    <tr>
      <td align="center" class="pdxhead">ตรวจเมื่อวันที่...<?=$query['thidate']?>...</td>
      </tr>
      </table>
<br />
      <table width="89%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
      <tr><td>
      <table>
    <tr>
      <td width="718" class="pdxpro">HN :
        <strong>
        <?=$query['hn']?>
        </strong>       ชื่อ-สกุล : 
      <strong><?=$query['ptname']?></strong>
      <? $age1 = calcage($query1['dbirth']);?>
      อายุ <?=$age1?> เลขบัตรปชช : <?=$query1['idcard']?></td>
      <input name="age" type="hidden" value="<?=$age1?>"/>
      <input name="camp" type="hidden" value="<?=$query1['camp']?>"/>
      </tr>
    <tr>
      <td class="pdx">ที่อยู่ :
        <? echo $query1['address']." ตำบล".$query1['tambol']." อำเภอ".$query1['ampur']." จังหวัด".$query1['changwat']?> โทรศัพท์ : <?=$query1['phone']?></td>
    </tr>
    <tr>
      <td class="pdx">เชื้อชาติ : <?=$query1['race']?> สัญชาติ : <?=$query1['nation']?> ศาสนา : <?=$query1['religion']?> </td>
    </tr>
    <tr>
      <td class="pdx">กลุ่มเลือด : <?=$query1['blood']?>         สถานภาพ  <?=$query1['married']?></td>
    </tr>
    <tr>
      <td class="pdx">บิดา : <?=$query1['father']?> มารดา : <?=$query1['mother']?> คู่สมรส : <?=$query1['couple']?> </td>
    </tr>
    <tr>
      <td class="pdx"> ผู้ที่สามารถติดต่อได้ : <?=$query1['ptf']?> เกี่ยวข้องเป็น <?=$query1['ptfadd']?>  โทรศัพท์ <?=$query1['ptffone']?></td>
    </tr>
    <tr>
      <td class="pdx">สิทธิการรักษา <?=$query1['ptright']?></td>
    </tr>
      </table>
      </td></tr>
    </table>
    <br />
	<table width="89%" border="1" cellpadding="0" cellspacing="0" bordercolor="#666666">
    <tr><td>
    <table width="750">
    <tr>
      <td width="765" colspan="3" class="pdx"><strong>สถานีที่ 1 ผู้เข้ารับการตรวจสุขภาพต้องเข้ารับการตรวจสถานีนี้ทุกคน</strong></td>
    </tr>
    <tr>
      <td colspan="3" class="pdx">น้ำหนัก : <?=$query['weight']?> กก. ส่วนสูง : <?=$query['height']?> ซม. โรคประจำตัว : <?=$query['congenital_disease']?> แพ้ยา : <?=$query['drugreact']?> </td>
      </tr>
    <tr>
      <td colspan="3" class="pdx">T : <?=$query['temperature']?> C ํ P : <?=$query['pause']?> ครั้ง/นาที R : <?=$query['rate']?> ครั้ง/นาที BP : <?=$query['bp1']?>/<?=$query['bp2']?> mmHg.</td>
      </tr>
      </table></td></tr>
    </table>
    <?
    $arrtype = array('ตรวจ x-ray ปอด','ตรวจสมรรถภาพปอด','ตรวจสมรรถภาพการได้ยิน','ตรวจหน้าที่ของตับ','ตรวจหน้าที่ของไต','ตรวจความสมบูรณ์ของเม็ดเลือด','ตรวจปัสสาวะ','ตรวจปริมาณโลหะหนัก');
	
	$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select labcode, result, unit  From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by labcode ASC ";

	$result_ua = mysql_query($sql);
	$ua = mysql_num_rows($result_ua);

	$sql = "Select labcode, result, unit From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') Order by labcode ASC";
	$result_cbc = mysql_query($sql);
	$cbc = mysql_num_rows($result_cbc);
	
	$sql = "Select labcode, result, unit From resulthead as a , resultdetail as b  where a.hn='".$query['hn']."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND (clinicalinfo = 'ตรวจสุขภาพประจำปี54') AND parentcode <> 'CBC' Order by labcode ASC ";
	$result_lab = mysql_query($sql);
	$lab = mysql_num_rows($result_lab);
	?>
<table width="857">
    <tr>
      <td class="pdxpro">
      <TABLE border="1" cellpadding="2" cellspacing="0">
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR class="tb_font">
		<TD class="pdx">
	&nbsp;&nbsp; <span class="style5">UA :</span> 
       <table border="0">
	  <tr>
	  <?php if($ua!="0"){
	  $i=1;
	  	while(list($labname,$labresult, $unit) = mysql_fetch_row($result_ua)){
		if($labname == "OTHERU"){
			$size="13";
		}else{
			$size="6";
		}

		if(!empty($arr_dxofyear[$list_ua[$labname]]))
			$labresult = $arr_dxofyear[$list_ua[$labname]];
	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_ua[$labname];?>" type="text" value="<?php echo $labresult;?>"  size="<?php echo $size;?>" readonly />&nbsp;<?php //echo //$unit;?>&nbsp;</td>
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}}?>
		  </tr>
      </table>
	  <hr />
      
	  &nbsp;&nbsp; <span class="style5">CBC :</span> 
	<table border="0">
	  <tr>
	  <?php
	  if($cbc!="0"){
	  $i=1;
	  	while(list($labname,$labresult, $unit) = mysql_fetch_row($result_cbc)){
		if($labname == "OTHER" || $labname == "PLTS"){
			$size="13";
		}else{
			$size="6";
		}
		if(!empty($arr_dxofyear[$list_cbc[$labname]]))
			$labresult = $arr_dxofyear[$list_cbc[$labname]];
	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_cbc[$labname];?>" type="text" value="<?php echo $labresult;?>"  size="<?php echo $size;?>" readonly />&nbsp;<?php //echo //$unit;?>&nbsp;</td>
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}}?>
		  </tr>
      </table>
	  <hr />
	  <table border="0">
	  <tr>
	  <?php
	   if($lab!="0"){
	  $i=1;
	  	while(list($labname,$labresult, $unit) = mysql_fetch_row($result_lab)){

			if(!empty($arr_dxofyear[$list_lab[$labname]]))
			$labresult = $arr_dxofyear[$list_lab[$labname]];

	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_lab[$labname];?>" type="text" value="<?php echo $labresult;?>" size="6" readonly />&nbsp;<?php //echo $unit;?>
&nbsp;</td>
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}}?>
		  </tr>
      </table>
		</TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
</td>
    </tr>
    <tr>
      <td class="pdxpro"><select name="typenew">
             <option value='กลุ่มที่ 1 พนักงานปูนลำปาง/SCG-A(ไม่ได้สัมผัสสารเคมีและกากวัสดุไม่ใช้แล้ว)'>กลุ่มที่ 1 พนักงานปูนลำปาง/SCG-A(ไม่ได้สัมผัสสารเคมีและกากวัสดุไม่ใช้แล้ว)</option>
              <option value='กลุ่มที่ 2 พนักงานปูนลำปาง(สัมผัสสารเคมี)'>กลุ่มที่ 2 พนักงานปูนลำปาง(สัมผัสสารเคมี)</option>
              <option value='กลุ่มที่ 3 พนักงานปูนลำปาง(สัมผัสกากวัสดุไม่ใช้แล้ว)'>กลุ่มที่ 3 พนักงานปูนลำปาง(สัมผัสกากวัสดุไม่ใช้แล้ว)</option>
              <option value='กลุ่มที่ 4 พนักงานคู่ธุรกิจ(สัมผัสสารเคมี)'>กลุ่มที่ 4 พนักงานคู่ธุรกิจ(สัมผัสสารเคมี)</option>
              <option value='กลุ่มที่ 5 พนักงานคู่ธุรกิจ(สัมผัสกากวัสดุไม่ใช้แล้ว)'>กลุ่มที่ 5 พนักงานคู่ธุรกิจ(สัมผัสกากวัสดุไม่ใช้แล้ว)</option>
              <option value='กลุ่มที่ 6 พนักงานคู่ธุรกิจ(สัมผัสฝุ่นปูนซีเมนต์,ฝุ่น Biomass)'>กลุ่มที่ 6 พนักงานคู่ธุรกิจ(สัมผัสฝุ่นปูนซีเมนต์,ฝุ่น Biomass)</option>
              <option value='กลุ่มที่ 7 พนักงานคู่ธุรกิจ(สัมผัสเสียงดังขณะเครื่องจักรทำงาน)'>กลุ่มที่ 7 พนักงานคู่ธุรกิจ(สัมผัสเสียงดังขณะเครื่องจักรทำงาน)</option>
              <option value='กลุ่มที่ 8 พนักงานคู่ธุรกิจ(สัมผัสกากอุตสาหกรรมที่ไม่ใช้แล้ว และสัมผัสเสียงดังขณะเครื่องจักรทำงาน)'>กลุ่มที่ 8 พนักงานคู่ธุรกิจ(สัมผัสกากอุตสาหกรรมที่ไม่ใช้แล้ว และสัมผัสเสียงดังขณะเครื่องจักรทำงาน)</option>
               <option value='กลุ่มที่ 9 พนักงานคู่ธุรกิจ(สัมผัสสารเคมีและสัมผัสเสียงดังขณะเครื่องจักรทำงาน)'>กลุ่มที่ 9 พนักงานคู่ธุรกิจ(สัมผัสสารเคมีและสัมผัสเสียงดังขณะเครื่องจักรทำงาน)</option>
              <option value='กลุ่มที่ 10 พนักงานคู่ธุรกิจ(สัมผัสฝุ่นปูนซีเมนต์,ฝุ่น Biomass,เสียงดังขณะเครื่องจักรทำงาน)'>กลุ่มที่ 10 พนักงานคู่ธุรกิจ(สัมผัสฝุ่นปูนซีเมนต์,ฝุ่น Biomass,เสียงดังขณะเครื่องจักรทำงาน)</option>
             <option value='กลุ่มที่ 11 บ. พี.วาย.เมตัล งานสัญญาบำรุงรักษาเครื่องจักรชุด Clinker Production'>กลุ่มที่ 11 บ. พี.วาย.เมตัล งานสัญญาบำรุงรักษาเครื่องจักรชุด Clinker Production</option>
              <option value='กลุ่มที่ 12 หจก.เอ็ม.เควี.ลำปางเซอร์วิส 1'>กลุ่มที่ 12 หจก.เอ็ม.เควี.ลำปางเซอร์วิส 1</option>
              <option value='กลุ่มที่ 13 หจก.เอ็ม.เควี.ลำปางเซอร์วิส 2'>กลุ่มที่ 13 หจก.เอ็ม.เควี.ลำปางเซอร์วิส 2</option>
              <option value='กลุ่มที่ 14 หจก.พลีบัตรลำปางรวมช่าง 1'>กลุ่มที่ 14 หจก.พลีบัตรลำปางรวมช่าง 1</option>
             <option value='กลุ่มที่ 15 หจก.พลีบัตรลำปางรวมช่าง 2'>กลุ่มที่ 15 หจก.พลีบัตรลำปางรวมช่าง 2</option>
             <option value='กลุ่มที่ 16 บ.บ้านแพรกเอ็นจิเนียริ่ง'>กลุ่มที่ 16 บ.บ้านแพรกเอ็นจิเนียริ่ง</option>               <option value='กลุ่มที่ 17 บ.บ้านสาเจริญกิจ'>กลุ่มที่ 17 บ.บ้านสาเจริญกิจ</option>
             <option value='กลุ่มที่ 18 หจก.เมืองเหนือเทคนิค'>กลุ่มที่ 18 หจก.เมืองเหนือเทคนิค</option>
             </select>
              </td>
    </tr>
    <tr>
      <td class="pdxpro"><strong>ผลการตรวจสมรรถภาพการได้ยิน</strong></td>
      </tr>
    <tr>
      <td class="pdx"><table width="719"><tr><td colspan="3" align="center">ความถี่เสียงพูดคุยทั่วไป</td><td colspan="3" align="center">ความถี่เสียงสูง</td></tr>
        <tr>
          <td width="71" align="center">ความถี่เสียง</td>
          <td width="139" align="center">ขวา</td>
          <td width="134" align="center">ซ้าย</td>
          <td width="79" align="center">ความถี่เสียง</td>
          <td width="134" align="center">ขวา</td>
          <td width="134" align="center">ซ้าย</td>
        </tr>
        <tr>
          <td align="center">500</td>
          <td align="center"><input type="text" name="right1" id="left1" size="10" tabindex="1" value="<?=$query3['hear500R']?>" /></td>
          <td align="center"><input type="text" name="left1" id="right1" size="10" tabindex="10" value="<?=$query3['hear500L']?>" /></td>
          <td align="center">3000</td>
          <td align="center"><input type="text" name="right4" id="left4" size="10" tabindex="5" value="<?=$query3['hear3000R']?>"/></td>
          <td align="center"><input type="text" name="left4" id="right4" size="10" tabindex="14" value="<?=$query3['hear3000L']?>"/></td>
        </tr>
        <tr>
          <td align="center">1000</td>
          <td align="center"><input type="text" name="right2" id="left2" size="10" tabindex="2" value="<?=$query3['hear1000R']?>"/></td>
          <td align="center"><input type="text" name="left2" id="right2" size="10" tabindex="11" value="<?=$query3['hear1000L']?>"/></td>
          <td align="center">4000</td>
          <td align="center"><input type="text" name="right5" id="left5" size="10" tabindex="6" value="<?=$query3['hear4000R']?>"/></td>
          <td align="center"><input type="text" name="left5" id="right5" size="10" tabindex="15" value="<?=$query3['hear4000L']?>"/></td>
        </tr>
        <tr>
          <td align="center">2000</td>
          <td align="center"><input type="text" name="right3" id="left3" size="10" tabindex="3" value="<?=$query3['hear2000R']?>"/></td>
          <td align="center"><input type="text" name="left3" id="right3" size="10" tabindex="12" value="<?=$query3['hear2000L']?>"/></td>
          <td align="center">6000</td>
          <td align="center"><input type="text" name="right6" id="left6" size="10" tabindex="7" value="<?=$query3['hear6000R']?>"/></td>
          <td align="center"><input type="text" name="left6" id="right6" size="10" tabindex="16" value="<?=$query3['hear6000L']?>"/></td>
        </tr>
        <tr>
          <td align="center">PTA</td>
          <td align="center"><input type="text" name="pta1" id="pta1" size="10" tabindex="4" value="<?=$query3['ptaRight1']?>"/></td>
          <td align="center"><input type="text" name="pta2" id="pta2" size="10" tabindex="13" value="<?=$query3['ptaLeft1']?>"/></td>
          <td align="center">8000</td>
          <td align="center"><input type="text" name="right7" id="left7" size="10" tabindex="8" value="<?=$query3['hear8000R']?>"/></td>
          <td align="center"><input type="text" name="left7" id="right7" size="10" tabindex="17" value="<?=$query3['hear8000L']?>"/></td>
        </tr>
        <tr>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">&nbsp;</td>
          <td align="center">PTA</td>
          <td align="center"><input type="text" name="pta3" id="pta3" size="10" tabindex="9" value="<?=$query3['ptaRight2']?>"/></td>
          <td align="center"><input type="text" name="pta4" id="pta4" size="10" tabindex="18" value="<?=$query3['ptaLeft2']?>"/></td>
        </tr>
        <tr>
          <td align="center">LOW TONE</td>
          <td align="center">
          <select name="tone1" id="tone1">
          <option value="">- เลือก - </option>
              <option value="ปกติ" <? if($query3['LowRight']=="ปกติ") echo "selected";?>>ปกติ</option>
              <option value="ผิดปกติเล็กน้อย" <? if($query3['LowRight']=="ผิดปกติเล็กน้อย") echo "selected";?>>ผิดปกติเล็กน้อย</option>
              <option value="ผิดปกติปานกลาง" <? if($query3['LowRight']=="ผิดปกติปานกลาง") echo "selected";?>>ผิดปกติปานกลาง</option>
              <option value="ผิดปกติมาก" <? if($query3['LowRight']=="ผิดปกติมาก") echo "selected";?>>ผิดปกติมาก</option>
              <option value="ผิดปกติรุนแรง" <? if($query3['LowRight']=="ผิดปกติรุนแรง") echo "selected";?>>ผิดปกติรุนแรง</option>
              <option value="ผิดปกติรุนแรงมาก" <? if($query3['LowRight']=="ผิดปกติรุนแรงมาก") echo "selected";?>>ผิดปกติรุนแรงมาก</option>
          </select></td>
          <td align="center">
          <select name="tone2" id="tone2">
          <option value="">- เลือก - </option>
              <option value="ปกติ" <? if($query3['LowLeft']=="ปกติ") echo "selected";?>>ปกติ</option>
              <option value="ผิดปกติเล็กน้อย" <? if($query3['LowLeft']=="ผิดปกติเล็กน้อย") echo "selected";?>>ผิดปกติเล็กน้อย</option>
              <option value="ผิดปกติปานกลาง" <? if($query3['LowLeft']=="ผิดปกติปานกลาง") echo "selected";?>>ผิดปกติปานกลาง</option>
              <option value="ผิดปกติมาก" <? if($query3['LowLeft']=="ผิดปกติมาก") echo "selected";?>>ผิดปกติมาก</option>
              <option value="ผิดปกติรุนแรง" <? if($query3['LowLeft']=="ผิดปกติรุนแรง") echo "selected";?>>ผิดปกติรุนแรง</option>
              <option value="ผิดปกติรุนแรงมาก" <? if($query3['LowLeft']=="ผิดปกติรุนแรงมาก") echo "selected";?>>ผิดปกติรุนแรงมาก</option>
          </select></td>
          <td align="center">HIGH TONE</td>
          <td align="center">
          <select name="tone3" id="tone3">
          <option value="">- เลือก - </option>
              <option value="ปกติ" <? if($query3['HighRight']=="ปกติ") echo "selected";?>>ปกติ</option>
              <option value="ผิดปกติเล็กน้อย" <? if($query3['HighRight']=="ผิดปกติเล็กน้อย") echo "selected";?>>ผิดปกติเล็กน้อย</option>
              <option value="ผิดปกติปานกลาง" <? if($query3['HighRight']=="ผิดปกติปานกลาง") echo "selected";?>>ผิดปกติปานกลาง</option>
              <option value="ผิดปกติมาก" <? if($query3['HighRight']=="ผิดปกติมาก") echo "selected";?>>ผิดปกติมาก</option>
              <option value="ผิดปกติรุนแรง" <? if($query3['HighRight']=="ผิดปกติรุนแรง") echo "selected";?>>ผิดปกติรุนแรง</option>
              <option value="ผิดปกติรุนแรงมาก" <? if($query3['HighRight']=="ผิดปกติรุนแรงมาก") echo "selected";?>>ผิดปกติรุนแรงมาก</option>
          </select></td>
          <td align="center">
          <select name="tone4" id="tone4">
          <option value="">- เลือก - </option>
              <option value="ปกติ" <? if($query3['HighLeft']=="ปกติ") echo "selected";?>>ปกติ</option>
              <option value="ผิดปกติเล็กน้อย" <? if($query3['HighLeft']=="ผิดปกติเล็กน้อย") echo "selected";?>>ผิดปกติเล็กน้อย</option>
              <option value="ผิดปกติปานกลาง" <? if($query3['HighLeft']=="ผิดปกติปานกลาง") echo "selected";?>>ผิดปกติปานกลาง</option>
              <option value="ผิดปกติมาก" <? if($query3['HighLeft']=="ผิดปกติมาก") echo "selected";?>>ผิดปกติมาก</option>
              <option value="ผิดปกติรุนแรง" <? if($query3['HighLeft']=="ผิดปกติรุนแรง") echo "selected";?>>ผิดปกติรุนแรง</option>
              <option value="ผิดปกติรุนแรงมาก" <? if($query3['HighLeft']=="ผิดปกติรุนแรงมาก") echo "selected";?>>ผิดปกติรุนแรงมาก</option>
          </select></td>
        </tr>
      </table></td>
    </tr>
    <tr>
      <td class="pdx"><strong>ผลตรวจสมรรถภาพปอด</strong></td>
    </tr>
    <tr>
      <td class="pdx">%FVC : <input type="text" name="FVC1" id="FVC1" size="10" value="<?=$query3['FVC1']?>"/>
        <input type="text" name="FVC2" id="FVC2" size="10" value="<?=$query3['FVC2']?>"/>
        <input type="text" name="FVC3" id="FVC3" size="10" value="<?=$query3['FVC3']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">%FEV1 : <input type="text" name="FEV1" id="FEV1" size="10" value="<?=$query3['FEV1']?>"/>
        <input type="text" name="FEV2" id="FEV2" size="10" value="<?=$query3['FEV2']?>"/>
        <input type="text" name="FEV3" id="FEV3" size="10" value="<?=$query3['FEV3']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">%R/O : <input type="text" name="RO1" id="RO1" size="10" value="<?=$query3['RO1']?>"/>
        <input type="text" name="RO2" id="RO2" size="10" value="<?=$query3['RO2']?>"/>
        <input type="text" name="RO3" id="RO3" size="10" value="<?=$query3['RO3']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">%PEF : <input type="text" name="PEF1" id="PEF1" size="10" value="<?=$query3['PEF1']?>"/>
        <input type="text" name="PEF2" id="PEF2" size="10" value="<?=$query3['PEF2']?>"/>
        <input type="text" name="PEF3" id="PEF3" size="10" value="<?=$query3['PEF3']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">ผลการตรวจ <select name="reason">
      <option value="">- เลือก - </option>
      <option value="Normal Spirometry" <? if($query3['reason_chest']=="Normal Spirometry") echo "selected";?>>Normal Spirometry</option>
      <option value="Mild Restriction" <? if($query3['reason_chest']=="Mild Restriction") echo "selected";?>>Mild Restriction</option>
      <option value="Severe Restriction" <? if($query3['reason_chest']=="Severe Restriction") echo "selected";?>>Severe Restriction</option>
      <option value="Moderate Restriction" <? if($query3['reason_chest']=="Moderate Restriction") echo "selected";?>>Moderate Restriction</option>
      <option value="Very Severe Restriction" <? if($query3['reason_chest']=="Very Severe Restriction") echo "selected";?>>Very Severe Restriction</option>
      <option value="Moderate Severe Restriction" <? if($query3['reason_chest']=="Moderate Severe Restriction") echo "selected";?>>Moderate Severe Restriction</option>
      </select></td>
    </tr>
    <tr>
      <td class="pdx"><strong>ผลการตรวจเอกซเรย์</strong></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;<input name="check1" type="radio"  onclick="togglediv2('acnormal21')" value="-" <? if($query3['cxr']=="-") echo "checked";?> /> 
        -
</td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;<input name="check1" type="radio" value="ปกติ"  onclick="togglediv2('acnormal21')" <? if($query3['cxr']=="ปกติ") echo "checked";?>/>
ปกติ </td>
    </tr>
    <tr>
      <td height="39" class="pdx">
      <table width="242"><tr><td width="66" height="29"><input name="check1" type="radio" value="ผิดปกติ" onclick="togglediv1('acnormal21')" <? if($query3['cxr']=="ผิดปกติ") echo "checked";?>/> 
        ผิดปกติ </td><td width="164">
<div id="acnormal21" style='display: none;'><input type="text" size="15" name="reasoncxr" id="reasoncxr" size="10" /></div></td></tr></table></td>
    </tr>
    <tr>
      <td class="pdx"><strong>ผลการตรวจปริมาณโลหะหนัก</strong></td>
    </tr>
    <tr>
      <td class="pdx">Lead
        <input type="text" name="lead" id="lead" size="10" value="<?=$query3['lead']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">Cadmium
        <input type="text" name="cadmium" id="cadmium" size="10" value="<?=$query3['cadmium']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">Chromium
        <input type="text" name="chromium" id="chromium" size="10" value="<?=$query3['chromium']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">Arsenic
        <input type="text" name="arsenic" id="arsenic" size="10" value="<?=$query3['arsenic']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">Mercury
        <input type="text" name="mercury" id="mercury" size="10" value="<?=$query3['mercury']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">Copper
        <input type="text" name="copper" id="copper" size="10" value="<?=$query3['copper']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">Nickel
        <input type="text" name="nickel" id="nickel" size="10" value="<?=$query3['nickel']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">Antimony
        <input type="text" name="antimony" id="antimony" size="10" value="<?=$query3['antimony']?>"/></td>
    </tr>
    <tr>
      <td class="pdx">&nbsp;</td>
      </tr>
    </table>
</td>
</TR>
</TABLE>
<BR>


<center>
<input name="submit" type="submit" value=" ตกลง "  />&nbsp;&nbsp;
<!--<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" />-->
</center>
<INPUT TYPE="hidden" value="<?php echo $query3["row_id"];?>" name="row_id" />
<INPUT TYPE="hidden" value="<?php echo $query['hn'];?>" name="hn" />
</FORM>

<?php }}?>

<?php 
include("unconnect.inc");
 ?>
</body>


</html>
