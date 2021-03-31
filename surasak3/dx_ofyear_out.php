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
<title>โปรแกรมซักประวัติตรวจสุขภาพ</title>
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
.pdxhead {	font-family: "TH SarabunPSK";
	font-size: 24px;
}
</style>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; เมนู</a>  || <a href="upd_labstatus.php" target="_blank">ปรับสถานะ LAB เป็นตรวจสุขภาพ</a>
<center>
  <div class="font_title">โปรแกรมซักประวัติตรวจสุขภาพประจำปี (Walk in) && ฮักกันยามเฒ่า62</div>
</center>

<form action="dx_ofyear_out.php" method="post">
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
	<TR>
		<TD></TD>
	</TR>
	</TABLE>
	</TD>
</TR>
</TABLE>
<br />
<input name="post_vn" type="hidden" value="1" />
</form>

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

$sql = "Select vn,ptright,toborow From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1";
list($arr_view["vn"],$ptright,$toborow) = mysql_fetch_row(mysql_query($sql));
//echo "===>".$arr_view["vn"];

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
	$sql3 = "Select  temperature,pause,rate,weight,height,bp1,bp2,doctor,clinic From dxofyear_out where hn = '".$arr_view["hn"]."' and thidate like '".date("Y-m-d")."%'";
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
	// หาวันที่ตรวจ
	$sql = "Select date_format(a.orderdate,'%d/%m/%Y'),date_format(a.orderdate,'%Y-%m-%d') 
	From resulthead as a 
	where a.hn='".$arr_view["hn"]."'  
	AND (clinicalinfo = 'ตรวจสุขภาพประจำปี$nPrefix')  
	Order by a.autonumber DESC limit 0,1";
	list($lab_date,$labin_date) = mysql_fetch_row(mysql_query($sql));

	// หาผลที่ตรวจ UA
	$sql = "Select b.labcode, b.result, b.unit,b.normalrange,b.flag  
	From ( 
		SELECT MAX(`autonumber`) AS `autonumber` 
		FROM `resulthead` 
		WHERE `hn` = '".$arr_view["hn"]."' 
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
		WHERE `hn` = '".$arr_view["hn"]."' 
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
		WHERE `hn` = '".$arr_view["hn"]."' 
		AND ( `profilecode` <> 'UA' AND `profilecode` <> 'CBC' )
		AND `clinicalinfo` = 'ตรวจสุขภาพประจำปี$nPrefix' 
		GROUP BY `profilecode`
	) as a , 
	resultdetail as b  
	where a.autonumber = b.autonumber 
	AND parentcode <> 'UA' 
	AND parentcode <> 'CBC' 
	Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);
//ค้นหาข้อมูลเดิม
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	//$sql = "Select * From  `dxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";
	
	$sql = "Select * From  `dxofyear_out` where  hn='".$arr_view["hn"]."' and yearchk = '$nPrefix' ORDER BY row_id DESC limit 0,1 ";
	$result = mysql_query($sql);
	$count = mysql_num_rows($result);

	$camp = '';
	
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

		$camp = $arr_dxofyear['camp'];
		
		//$arr_view["vn"]=$arr_dxofyear["vn"];
		//echo "===>".$arr_view["vn"];
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

<!-- ข้อมูลเบื้องต้นของผู้ป่วย -->
<FORM METHOD=POST ACTION="dx_ofyear_out_save.php" target="_blank" <?php //if($arr_view["vn"] ==""){echo "Onsubmit=\"alert('ผู้ป่วยยังไม่ได้ทำการลงทะเบียน');return false;\"";}?>>

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
		<tr>
		  <td align="right"><span class="tb_font_2">หน่วยงาน : </span></td>
		  <td colspan="3"><span class="pdxhead">
		    <select name='camp' id="camp">
			<?php 
			$toborow_key = substr($toborow,0,4);
			$sql12 = "select * from chkcompany where status='Y' order by row_id asc";
			$rows12 = mysql_query($sql12);
			while($result12 = mysql_fetch_array($rows12)){ 

				$selected = '';
				if( $toborow_key == 'EX46' ){
					$selected = 'selected="selected"';
				}

				if( $camp == $result12['code'] ){
					$selected = 'selected="selected"';
				}

				?>
				<option value='<?=$result12['name']?>' <?=$selected;?> ><?=$result12['name']?></option>
				<?php
			}
			?>
            </select>
		  </span></td>
		  </tr>
	</table>
	<hr />
	<table width="854" border="0" class="tb_font">
	  <tr>
			<td width="130" align="right" class="tb_font_2">ส่วนสูง : </td>
			<td width="79"><input id="pt_height" name="height" type="text" size="1" maxlength="6" value="<?php echo $height; ?>" />
ซม.</td>
			<td width="76" align="right"><span class="tb_font_2">น้ำหนัก :</span></td>
			<td width="129"><input id="pt_weight" name="weight" type="text" size="1" maxlength="5" value="<?php echo $weight; ?>" />
กก. </td>
			<td width="77" align="right"><span class="tb_font_2">รอบเอว :</span></td>
			<td width="132"><input name="round_" type="text" size="1" maxlength="5" value="<?php echo $waist; ?>" />
			  ซม.</td>
			<td width="70" align="left"><span class="tb_font_2">BP1 :</span></td>
			<td width="150" align="left"><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $bp1;?>" />
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
		  <td align="left"><span class="tb_font_2">Repeat BP :</span></td>
		  <td align="left">
		  	<input name="bp21" type="text" size="1" maxlength="3" value="<?php echo $bp21;?>" /> / <input name="bp22" type="text" size="1" maxlength="3" value="<?php echo $bp22; ?>" /> mmHg<br>
			<span style="font-size: 13px; color: red;">* Repeat BP ถ้าไม่มีข้อมูลให้เว้นว่าง</span>
		  </td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2"><span class="tb_font_2">BMI :</span></td>
		  <td colspan="2">
		  	<input name="bmi" id="pt_bmi" type="text" size="5"  value="<?php echo $bmi; ?>"  />
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
		  <td colspan="7"><span class="data_show">
          <?
		  $strQuery=mysql_query("select * from drugreact where hn='".$arr_view["hn"]."'");
		  //echo $strQuery;
		  $numreact=mysql_num_rows($strQuery);
		  ?>
          
		    <input name="drugreact" type="radio" id="drugreact1" value="0" <? if(empty($numreact)){ echo "checked='checked'";}?> />
ไม่แพ้
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="drugreact" type="radio" id="drugreact2" value="1" <? if(!empty($numreact)){ echo "checked='checked'";}?> />
แพ้ &nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000"><?php if(!empty($arr_view["drugreact"])){ echo  $arr_view["drugreact"];} ?></font></span></td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">บุหรี่ :</td>
		  <td colspan="7">
          <? if($count > 0){ ?>
		<input type="radio" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
ไม่เคยสูบ&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?> />
เคยสูบ แต่เลิกแล้ว
&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; } ?> />
สูบบุหรี่ เป็นครั้งคราว
&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="3" <?php if($cigarette==1){ echo "checked"; } ?> />
สูบบุหรี่ เป็นประจำ
			<? }else{?>
 		<input type="radio" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
ไม่เคยสูบ&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="1" <?php if($cigarette==2){ echo "checked"; } ?> />
เคยสูบ แต่เลิกแล้ว
&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="2"  <?php if($cigarette==1){ echo "checked"; } ?>/>
สูบบุหรี่ เป็นครั้งคราว
&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="3"/>
สูบบุหรี่ เป็นประจำ           
            <? } ?>
			</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">สุรา : </td>
		  <td colspan="7">
          <? if($count > 0){ ?>
		<input type="radio" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
ไมเคย่ดื่ม&nbsp;&nbsp;&nbsp;
		<input type="radio" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> />
เคยดื่ม แต่เลิกแล้ว&nbsp;&nbsp;&nbsp;
 &nbsp;
 		<input type="radio" name="alcohol" value="2" <?php if($alcohol==2){ echo "checked"; } ?> />
ดื่ม เป็นครั้งคราว&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 		<input type="radio" name="alcohol" value="3" <?php if($alcohol==3){ echo "checked"; } ?> />
ดื่ม เป็นประจำ
		<? }else{ ?>
		<input type="radio" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
ไมเคยดื่ม&nbsp;&nbsp;&nbsp;
		<input type="radio" name="alcohol" value="1" <?php if($alcohol==2){ echo "checked"; } ?> />
เคยดื่ม แต่เลิกแล้ว&nbsp;&nbsp;&nbsp;
 &nbsp;
 		<input type="radio" name="alcohol" value="2" <?php if($alcohol==1){ echo "checked"; } ?> />
ดื่ม เป็นครั้งคราว&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 		<input type="radio" name="alcohol" value="3"/>
ดื่ม เป็นประจำ		
        <? } ?>
			</td>
		  </tr>
		<tr>
          <td align="right" class="tb_font_2">ออกกำลังกาย : </td>
		  <td colspan="7">
          <? if($count > 0){ ?>
		<input type="radio" name="exercise" value="0" <?php if($exercise==0){ echo "checked"; } ?> />
ไม่เคยออกกำลังกาย&nbsp;&nbsp;&nbsp;
		<input type="radio" name="exercise" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
ออกกำลังกาย ต่ำกว่าเกณฑ์ &nbsp;&nbsp;&nbsp;
		<input type="radio" name="exercise" value="2" <?php if($exercise==2){ echo "checked"; } ?> />
ออกกำลังกาย ตามเกณฑ์ 
		<? }else{ ?>
		<input type="radio" name="exercise" value="0"/>
ไม่เคยออกกำลังกาย&nbsp;&nbsp;&nbsp;
		<input type="radio" name="exercise" value="1" checked="checked"/>
ออกกำลังกาย ต่ำกว่าเกณฑ์ &nbsp;&nbsp;&nbsp;
		<input type="radio" name="exercise" value="2"/>
ออกกำลังกาย ตามเกณฑ์         
        <? } ?>
			</td>
		  </tr>
	</table>
	<TABLE class="tb_font">
	</TABLE>
	<TABLE width="725" class="tb_font">
	<tr>
           <td width="101" align="right" class="tb_font_2">โรคประจำตัว :</td>
           <td width="612" colspan="5" align="left"><span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>"/>
             <input type="button"  onclick="document.getElementById('congenital_disease').value='ปฎิเสธ';" name="Submit3" value="ปฎิเสธ" />
           </span></td>
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
	<table class="tb_font">
		<tr>
			<td align="right" valign="top" class="tb_font_2">ตรวจสุขภาพช่องปากและฟัน (Dental Examination) :</td>
			<td><input type="text" name="dental_exam" size="50"></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="tb_font_2">ตรวจสายตาและตาบอดสี (Auto-R & color blindness) :</td>
			<td><input type="text" name="color_blind" size="50"></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="tb_font_2">ตรวจการได้ยิน (Audiogram) :</td>
			<td><input type="text" name="audiogram" size="50"></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="tb_font_2">ตรวจคลื่นไฟฟ้าหัวใจ (EKG) :</td>
			<td><input type="text" name="ekg" size="50"></td>
		</tr>
	</table>
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

		//if(!empty($arr_dxofyear[$list_ua[$labname]]))
			//$labresult = $arr_dxofyear[$list_ua[$labname]];
	  ?>
          <td align="right" class="tb_font_2"><?php echo $labname;?> : </td>
          <td>&nbsp;<input name="<?php echo  $list_ua[$labname];?>" type="text" value="<?php echo $labresult;?>"  size="<?php echo $size;?>" readonly />&nbsp;<?php //echo //$unit;?>&nbsp;</td>
	<?php 
	if($i%5==0) echo "<tr></tr>";
	$i++;
			}?>
		  </tr>
      </table>
	  <hr />
	  &nbsp;&nbsp; <span class="style5">CBC :</span> 
	<div style="margin-top: -30px;">
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
      </div>
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
<br />
<center>
<!--<input name="submit" type="submit" value="ตกลง"  />&nbsp;&nbsp;-->
<input name="submit2" type="submit" value="ตกลง&amp;สติกเกอร์ OPD" />
<input type="hidden" name="toborow" value="<?=$toborow;?>">
<input type="hidden" name="ptright" value="<?=$ptright;?>">
</center>
<INPUT TYPE="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
<input type="hidden" name="labin_date" value="<?=$labin_date;?>">
</FORM>

<script src="js/vendor/jquery-1.11.2.min.js" type="text/javascript"></script>
<script>
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
