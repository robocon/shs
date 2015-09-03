<?php
session_start();
include("connect.inc");
session_unregister("list_bill");
session_register("list_bill");
$_SESSION["list_bill"] = "";
$_GET["p_hn"] = $_GET["hn_now"]; //hn
$thidate = $_GET["thidate"]; //hn
$_SESSION["dt_doctor"] = $_GET["doctor"];

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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
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
<title>��Ǩ�آ�Ҿ</title>
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
	if(document.dxdrform.statusdata.checked == false&document.dxdrform.normal57.checked == false){
	return true;
	}else{
		if(document.dxdrform.normal55.checked == false&document.dxdrform.normal55.checked == false){
			alert('�ѧ��������͡��Ҥ����ѹ');
			document.dxdrform.normal55.focus();
			return false;
		}else if(document.dxdrform.normal56.checked == false&document.dxdrform.normal56.checked == false){
			alert('�ѧ��������͡��� BMI');
			document.dxdrform.normal56.focus();
			return false;		
		}else if(document.dxdrform.normal98.checked == false&document.dxdrform.normal99.checked == false){
			alert('�ѧ��������͡�š�õ�ǨUA');
			document.dxdrform.normal98.focus();
			return false;
		}else if(document.dxdrform.normal97.checked == false&document.dxdrform.normal96.checked == false){
			alert('�ѧ��������͡�š�õ�ǨCBC');
			document.dxdrform.normal97.focus();
			return false;
		}else if(document.dxdrform.normal58.checked == false&document.dxdrform.normal57.checked == false){
			alert('�ѧ��������͡�š�õ�Ǩ��硫�����ʹ');
			document.dxdrform.normal58.focus();
			return false;
		}else if(document.dxdrform.normal61.checked == false&document.dxdrform.normal62.checked == false&document.dxdrform.normal63.checked == false&document.dxdrform.normal64.checked == false&document.dxdrform.normal65.checked == false&document.dxdrform.normal66.checked == false){
			alert('�ѧ��������͡��ػ�š�õ�Ǩ');
			document.dxdrform.normal61.focus();
			return false;
		}else{
			return true;
		}
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
		<TD align="center" bgcolor="#0000CC" class="tb_font_1">��͡�����Ţ VN</TD>
	</TR>
	<TR>
		<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_GET["p_hn"]?>"/>&nbsp;<input type="submit" name="Submit" value="��ŧ" /></TD>
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

<?php if(!empty($_GET["p_hn"] )){
		////*runno ��Ǩ�آ�Ҿ*/////////
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
		$showyear="25".$nPrefix;
	////*runno ��Ǩ�آ�Ҿ*/////////
	
//���� hn �ҡ opday ****************************************************************************************
	$date_now = (date("Y")+543).date("-m-d");
	$sqlvn = "Select * From dxofyear_out where  hn = '".$_GET["p_hn"]."' and thidate like '$thidate%' limit 0,1";
	$resultvn= mysql_query($sqlvn);
	$queryvn = mysql_fetch_array($resultvn);
	
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '".$queryvn['hn']."' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql) or die("Error line 117 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>�������ѧ�����ӡ��ŧ����¹</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_assoc($result);

//$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$_GET["p_hn"]."' limit 0,1";
//list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));

$date_hn = date("Y-m-d").$queryvn['hn'];
$date_vn = date("Y-m-d").$queryvn['vn'];
$arr_view["hn"] = $queryvn['hn'];
$sql = "Select  weight, height From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height) = Mysql_fetch_row($result);


$sqlvn = "Select vn From dxofyear_out  where  hn = '".$_GET["p_hn"]."' and thidate='".$thidate."' limit 0,1";
list($vn) = mysql_fetch_row(mysql_query($sqlvn));

//�����ѹ�Դ�ҡ opcard ****************************************************************************************
	//$sql = "Select dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
	//$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	//list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);

//���Ҽš�õ�Ǩ�ҧ��Ҹ� ****************************************************************************************

	$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."'  AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix')  Order by a.autonumber DESC limit 0,1";
	//echo $sql;
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	/*$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54' ) Order by labcode ASC ";
	
	$result_ua = mysql_query($sql);

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "Select labcode, result, unit , normalrange, flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�54') Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);*/
//���Ң��������
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	//$sql = "Select * From  `dxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";

	$sql = "Select * From  `dxofyear_out` where yearchk = '$nPrefix' AND hn='".$arr_view["hn"]."' limit 0,1 ";
	//echo $sql;
	
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
		if($arr_dxofyear["congenital_disease"] != ''){ $congenital_disease = $arr_dxofyear["congenital_disease"];}else{$congenital_disease = "����ʸ�ä��Шӵ��";}
		$rowid = $arr_dxofyear['row_id'];
		
	}else{
		$sql = "Select drugreact,congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN exercise = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN exercise = '0'THEN 'Checked' ELSE '' END ),(CASE WHEN cigarette = '2'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '2'THEN 'Checked' ELSE '' END ), (CASE WHEN exercise = '2'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '3'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '3'THEN 'Checked' ELSE '' END )   From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";

		$result = Mysql_Query($sql);
		list($drugreact,$congenital_disease, $weight, $height, $cigarette1, $alcohol1,$exercise1, $cigarette0, $alcohol0, $exercise0, $cigarette2, $alcohol2,$exercise2, $cigarette3, $alcohol3) = Mysql_fetch_row($result);
			if($congenital_disease == "")
				$congenital_disease = "����ʸ�ä��Шӵ��";

	}
	
	if($arr_dxofyear["rate"] == ""){
		$arr_dxofyear["rate"] = 20;
	}
	
$choose = array();

array_push($choose,"��Ǩ����Ѵ");
array_push($choose,"�ҡ�͹�Ѵ");
array_push($choose,"����ѧ�Ѵ");
array_push($choose,"�ҡ�÷���任���");
array_push($choose,"�Ѻ�����");
array_push($choose,"..........�ѹ");
array_push($choose,"��");
array_push($choose,"��");
array_push($choose,"�纤�");
array_push($choose,"�������");
array_push($choose,"�չ���١");
array_push($choose,"�Ǵ�����");
array_push($choose,"���¹�����");
array_push($choose,"��ҹ��ع");
array_push($choose,"�������");
array_push($choose,"����¹");
array_push($choose,"����");
array_push($choose,"��͹����");
array_push($choose,"���������");
array_push($choose,"�����˹�����ͺ");
array_push($choose,"�ء�蹷�ͧ");
array_push($choose,"��˹��͡");
array_push($choose,"˹���״ �����");
array_push($choose,"�Ǵ��ͧ");
array_push($choose,"�״��ͧ");
array_push($choose,"��ҹ�ب��������");
array_push($choose,"��ͧ�١");
array_push($choose,"��������ʺ�Ѵ");
array_push($choose,"�Ǵ��ѧ");
array_push($choose,"�Ǵ���");
array_push($choose,"�Ǵᢹ");
array_push($choose,"�Ǵ��");
array_push($choose,"�Ǵ��ͧ");
array_push($choose,"�Ǵ����");
array_push($choose,"�Ǵ��⾡");
array_push($choose,"�ŷ��.......");
array_push($choose,"��͹���........");
array_push($choose,"��Ǩ�آ�Ҿ");
array_push($choose,"����Ѻ�ͧᾷ��");
array_push($choose,"��֡��ᾷ��");
array_push($choose,"�Ǵ�����µ�����");
array_push($choose,"�������ͤ��蹵��");
array_push($choose,"��蹤ѹ");
array_push($choose,"����������� �ҵԪ���..ID..");
array_push($choose,"���Ѻ�Ѥ�չ�Ѵ�մ�ä����عѢ��� ������");
array_push($choose,"���Ѻ�Ѥ�չ�Ѵ�մ�Ҵ���ѡ ������");
array_push($choose,"���Ѻ�Ѥ�չ�Ѵ�մ����ʵѺ�ѡ�ʺ�� ������");
array_push($choose,"�����һ���ѵ��ѡ��");
sort($choose);
$sql = "Select distinct organ From opd where hn = '".$arr_view["hn"]."' AND organ <> '' Order by row_id DESC limit 10";
$result = Mysql_Query($sql);
$choose2 = array();
while($arr = Mysql_fetch_assoc($result)){
	array_push($choose2,$arr["organ"]);
}
$_SESSION["hn_now"] = $arr_view["hn"];

?>
<a href='../nindex.htm'>&lt;&lt;�����</a>  || <a href='dt_manual_index.php'>����Ǩ�آ�Ҿ�������</a>
<!-- ���������ͧ�鹢ͧ������ -->
<FORM name="dxdrform" METHOD="post" ACTION="dxdr_ofyearout_save_alpha.php"   onsubmit="return check()">

<input name="age" type="hidden" id="age"  value="<?php echo $arr_dxofyear["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $queryvn['vn'];?>" />
<input name="doctor" type="hidden" id="doctor"  value="<?php echo $_SESSION["dt_doctor"];?>" />
<br />
<p align="center" class="head_font1"><strong>�ѹ�֡�š�õ�Ǩ�آ�Ҿ</strong></p>
<table  width="100%" border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" bgcolor="#FFFFFF">
<tr>
  <td><table width="100%" border="0" cellpadding="0" cellspacing="0" >
    <tr>
      <td align="left" bgcolor="#0099CC" class="tb_font_1" colspan="12">&nbsp;&nbsp;&nbsp;�����ż�����</td>
    </tr>
    <tr>
      <td width="148" align="left" class="profilehead">VN</td>
      <td width="10" align="left" class="profile"> :</td>
      <td width="197"  class="profileheadvalue">&nbsp;<?php echo $queryvn["vn"];?></td>
      <td width="91" rowspan="2" align="left" valign="bottom" class="profilehead">����-ʡ�� </td>
      <td width="10" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="217" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_view["ptname"];?></td>
      <td width="145" rowspan="2" align="left" valign="bottom" class="profilehead">�ѧ�Ѵ </td>
      <td width="10" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="211" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_view["camp"];?></td>
      <input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/>
      <td width="89" rowspan="2" align="left" valign="bottom" class="profilehead">����</td>
      <td width="9" rowspan="2" align="left" valign="bottom" class="profile">:</td>
      <td width="216" rowspan="2" valign="bottom" class="profileheadvalue">&nbsp;<?php echo $arr_view["age"];?></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">HN </td>
      <td align="left" class="profile">:</td>
      <td class="profileheadvalue">&nbsp;<?php echo $arr_view["hn"];?></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">��ǹ�٧ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $height; ?> ��.</td>
      <td align="left" class="profilehead">���˹ѡ</td>
      <td align="left" class="profile">:</td>
      <td align="left" class="profilevalue">&nbsp;<?php echo $weight; ?> ��. </td>
      <td align="left" class="profilehead">�ͺ��� </td>
      <td align="left" class="profile">:</td>
      <?
			$ht = $height/100;
            $bmi = number_format($weight/($ht*$ht),2);
			?>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["round_"]; ?> ��.</td>
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
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["pause"]; ?> ����/�ҷ�</td>
      <td align="left" class="profilehead">R </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["rate"]; ?> ����/�ҷ�</td>
      <td align="left" class="profilehead">BP </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear["bp1"]; ?> / <?php echo $arr_dxofyear["bp2"]; ?> mmHg</td>
    </tr>
    <tr>
      <td align="left" class="profilehead">������ </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['cigarette']=="0"){ echo "������ٺ������";}else if($arr_dxofyear['cigarette']=="1"){ echo "���ٺ ����ԡ����";}else if($arr_dxofyear['cigarette']=="2"){ echo "�ٺ������ �繤��駤���";}else if($arr_dxofyear['cigarette']=="3"){ echo "�ٺ������ �繻�Ш�";} ?></td>
      <td align="left" class="profilehead">����</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<? if($arr_dxofyear['alcohol']=="0"){ echo "����´���";}else if($arr_dxofyear['alcohol']=="1"){ echo "�´��� ����ԡ����";}else if($arr_dxofyear['alcohol']=="2"){ echo "���� �繤��駤���";}else if($arr_dxofyear['alcohol']=="3"){ echo "���� �繻�Ш�";} ?></td>
      <td align="left" class="profilehead">�͡���ѧ���</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;
          <? if($arr_dxofyear['exercise']=="0"){ echo "������͡���ѧ���";} else if($arr_dxofyear['exercise']=="1"){ echo "�͡���ѧ��� ��ӡ���ࡳ��";} else{ echo "�͡���ѧ��� ���ࡳ��";} ?></td>
      <td align="left" class="profilehead">����</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;
          <? if($arr_dxofyear['drugreact']=="0"){ echo "�������";}else{ echo "<span style='color:#F00'>".$arr_view['drugreact']."</span>";} ?></td>
    </tr>
    <tr>
      <td align="left" class="profilehead">�ä��Шӵ��</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $congenital_disease;?></td>
      <td align="left" class="profilehead">�ҡ�� </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;<?php echo $arr_dxofyear['organ'];?></td>
      <td class="profilehead">�������ʹ</td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue"><?=$arr_dxofyear['blood']?></td>
      <td align="left" class="profilehead">ᾷ�� </td>
      <td align="left" class="profile">:</td>
      <td class="profilevalue">&nbsp;
        <?php 
		echo $_SESSION["dt_doctor"]; echo "<input type='hidden' name='doctorn' value='".$_SESSION["dt_doctor"]."'";
		?></td>
    </tr>
    <tr bgcolor="#CCCCFF">
      <td bgcolor="#FFCC99" class="profile"  style="color:#000"><strong>��Ҥ����ѹ</strong></td>
	    <td bgcolor="#FFCC99"><span class="profile">:</span></td>
	    <td bgcolor="#FFCC99" class="profilevalue"><input name='normal55' type='radio' value='����' onclick="togglediv2('acnormal55')" <?  if($arr_dxofyear["bp1"] < 129 && $arr_dxofyear["bp2"] < 89){ echo "checked";}?>/>
����
<input name='normal55' type='radio' value='�Դ����' onclick="togglediv1('acnormal55')"  <?  if(($arr_dxofyear["bp1"] >= 130 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >= 129 && $arr_dxofyear["bp2"] <= 89) || ($arr_dxofyear["bp1"] <= 129 && $arr_dxofyear["bp2"] >= 89)){ echo "checked";}?>/>
	      <?  
		  if(($arr_dxofyear["bp1"] >= 130 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >= 129 && $arr_dxofyear["bp2"] <= 89) || ($arr_dxofyear["bp1"] <= 129 && $arr_dxofyear["bp2"] >= 89)){
		  	echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
		  }else{
		  	echo "�Դ����";
		  }
		  ?>
        </td>
	    <td colspan="9" bgcolor="#FFCC99" class="profilevalue">
         <div id="acnormal55" <? if($arr_dxofyear["bp1"] < 129 && $arr_dxofyear["bp2"] < 89){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
	      <select name="ch55" >
	        <option value="�����ѹ���Ե ��ͺ�٧ PRE-HT" <? if($arr_dxofyear["bp1"] >= 135 && $arr_dxofyear["bp1"] <= 139){ echo "selected='selected';";}?>>�����ѹ���Ե ��ͺ�٧ PRE-HT</option>
	        <option value="��ҹ�դ����ѹ���Ե�٧ ��õ�ͧ�Ǻ�����������ҧ��觤�Ѵ ��੾������÷�������������͡���ѧ���" <? if(($arr_dxofyear["bp1"] >=140 && $arr_dxofyear["bp2"] >= 90) || ($arr_dxofyear["bp1"] >=140 && $arr_dxofyear["bp2"] <= 90) || ($arr_dxofyear["bp1"] <=140 && $arr_dxofyear["bp2"] >= 90)){ echo "selected='selected';";}?>>��ҹ�դ����ѹ���Ե�٧ ��õ�ͧ�Ǻ�����������ҧ��觤�Ѵ ��੾������÷�������������͡���ѧ���</option>
	        </select>
	      </div></td>
	    </tr>
    <tr bgcolor="#FFCC99">
      <td class="profile"  style="color:#000"><strong>��� BMI</strong></td>
      <td><span class="profile">:</span></td>
      <td class="profilevalue"><input name='normal56' type='radio' value='����' onclick="togglediv2('acnormal56')" id="normal56"  <?  if($bmi >= 18.5 && $bmi <= 22.99){ echo "checked";}?>/>
        ����
        <input name='normal56' type='radio' value='�Դ����' onclick="togglediv1('acnormal56')" id="normal56"  <?  if($bmi < 18.5 || $bmi > 22.99){ echo "checked";}?>/>
	      <?  
		  if($bmi < 18.5 || $bmi > 22.99){
		  	echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
		  }else{
		  	echo "�Դ����";
		  }
		  ?>        
      </td>
      <td colspan="9" bgcolor="#FFCC99" class="profilevalue">
      <div id="acnormal56" <? if($bmi >= 18.5 && $bmi <= 22.99){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
	      <select name="ch56" >
	        <option value="��ҹ�չ��˹ѡ�����Թ�" <? if($bmi < 18.5){ echo "selected='selected';";}?>>��ҹ�չ��˹ѡ�����Թ�</option>
	        <option value="��ҹ����������й��˹ѡ�Թ" <? if($bmi >= 23 && $bmi <= 24.99){ echo "selected='selected';";}?>>��ҹ����������й��˹ѡ�Թ</option>
	        <option value="��ҹ�չ��˹ѡ�Թ����������ǹ" <? if($bmi >= 25 && $bmi <= 29.99){ echo "selected='selected';";}?>>��ҹ�չ��˹ѡ�Թ����������ǹ</option>
	        <option value="��ҹ��������ǹ��͹��ҧ�ҡ" <? if($bmi >= 30 && $bmi <= 34.99){ echo "selected='selected';";}?>>��ҹ��������ǹ��͹��ҧ�ҡ</option>
	        <option value="��ҹ��������ǹ�ع�ç" <? if($bmi >= 35){ echo "selected='selected';";}?>>��ҹ��������ǹ�ع�ç</option>            
	        </select>
	      </div></td>
      </tr>
  </table></td></tr>
</table>
<br />
<!-- �š�õ�Ǩ�ҧ��Ҹ� -->
<TABLE border="2" cellpadding="2" cellspacing="0" bordercolor="#000000"  width="100%">
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0"  width="100%" bgcolor="#FFFFCC">
	<TR>
		<TD align="left" class="tb_font_1" bgcolor="#339999">&nbsp;&nbsp;&nbsp;�š�õ�Ǩ�ҧ��Ҹ� ������ѹ��� <span style="color: #000000;"><?php echo $lab_date;?></span></TD>
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
        <td colspan="4" align="center" bgcolor="#FFCC99"><strong>�š�õ�Ǩ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
          <input name='normal' type='radio' value='����' onclick="togglediv2('acnormal')" id="normal98" />
          ����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
          <input name='normal' type='radio' value='�Դ����' onclick="togglediv1('acnormal')" id="normal99" />
          �Դ���� </td>
        <td colspan="6" bgcolor="#FFCC99">
          <div id="acnormal" style='display: none;'>
            <select name='ch'>
              <option value='��õ�Ǩ������;�ᾷ�����������˵�'>��õ�Ǩ������;�ᾷ�����������˵�</option>
              <option value='������ʹᴧ㹻�������٧�Թ����'>������ʹᴧ㹻�������٧�Թ����</option>
              <option value='������ʹ���㹻�������٧�Թ����'>������ʹ���㹻�������٧�Թ����</option>
              <option value='����������㹻������'>���õչ����㹻������</option>
              <option value='��ҡô - ��ҧ'>��ҡô - ��ҧ</option>
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
			if($result_dx['cbc_hct'] < 37 || $result_dx['cbc_hct'] > 49){
				echo "<span style='color:#F00'><strong>$result_dx[cbc_hct]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[cbc_hct]</span>";
			}
			?>            
            </td>
            <td class="labfont"  width="101">(<?=$result_dx['hctrange']?>)</td>
            <td width="32" align="center" class="labfont" ><span <? if($result_dx['hctflag']!="N") echo " style='color:#F00'";?>><?=$result_dx['hctflag']?></span></td>
            <td width="202" class="labfont"><input name='normal31' type='radio' value='����' onclick="togglediv2('acnormal31')" <? if($result_dx['cbc_hct'] >= 37 && $result_dx['cbc_hct'] <= 49) echo "checked";?> />
              ���� 
              <input name='normal31' type='radio' value='�Դ����' onclick="togglediv1('acnormal31')" <? if($result_dx['cbc_hct'] < 37 || $result_dx['cbc_hct'] > 49) echo "checked";?>/>
              <? 
			  if($result_dx['cbc_hct'] < 37 || $result_dx['cbc_hct'] > 49){
			  	echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			  }else{
			  	echo "�Դ����";
			  }
			  ?>
              </td>
              <td width="877">
              <div id="acnormal31" <? if($result_dx['cbc_hct'] >= 37 && $result_dx['cbc_hct'] <= 49) echo "style='display: none;'"; else "style='display: block;'"; ?>>
      <select name='ch31'>
          <option value='���дѺ������ʹᴧ��ӡ��һ��� �觺͡�֧���Ыմ��õ�Ǩ��� ���� ��ᾷ�����������˵�' <? if($result_dx['cbc_hct'] < 37){ echo "selected='selected';";}?>>���дѺ������ʹᴧ��ӡ��һ��� �觺͡�֧���Ыմ��õ�Ǩ��� ���� ��ᾷ�����������˵�</option>
     </select>
			<option value='���дѺ������ʹᴧ�٧���һ��� ��õ�Ǩ��� ���� ��ᾷ��' <? if($result_dx['cbc_hct'] > 49){ echo "selected='selected';";}?>>���дѺ������ʹᴧ�٧���һ��� ��õ�Ǩ������;�ᾷ��</option>
     </select>     
     </div></td>
          </tr>
          <tr>
          <td align="right" class="profilelab" width="80">WBC : </td>
          <td width="44" class="fgn">
            <? 
			if($result_dx['cbc_wbc'] < 5 || $result_dx['cbc_wbc'] > 10){
				echo "<span style='color:#F00'><strong>$result_dx[cbc_wbc]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[cbc_wbc]</span>";
			}
			?>           
          </td>
          <td class="labfont" width="101">(<?=$result_dx['wbcrange']?>)</td>
          <td align="center" class="labfont" width="32" ><span <? if($result_dx['wbcflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['wbcflag'];?></span></td>
          <td width="202" class="labfont"><input name='normal32' type='radio' value='����' onclick="togglediv2('acnormal32')" <? if($result_dx['cbc_wbc'] >= 5 &&  $result_dx['cbc_wbc'] <= 10){ echo "checked";}?>/>
          ���� 
            <input name='normal32' type='radio' value='�Դ����' onclick="togglediv1('acnormal32')" <? if($result_dx['cbc_wbc'] < 5 || $result_dx['cbc_wbc'] > 10){ echo "checked";}?>/>
              <? 
			  if($result_dx['cbc_wbc'] < 5 || $result_dx['cbc_wbc'] > 10){
			  	echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			  }else{
			  	echo "�Դ����";
			  }
			  ?>
            </td>
            <td><div id="acnormal32" <? if($result_dx['cbc_wbc'] >= 5 &&  $result_dx['cbc_wbc'] <= 10){ echo "style='display: none;'";}else{ echo "style='display: block;'";} ?>>
            <select name='ch32'>
              <option value='����ҳ������ʹ����դ�ҵ�ӡ��һ��� ��õ�Ǩ������;�ᾷ��' <? if($result_dx['cbc_wbc'] < 5){ echo "selected='selected';";}?>>����ҳ������ʹ����դ�ҵ�ӡ��һ��� ��õ�Ǩ������;�ᾷ��</option>
              <option value='����ҳ������ʹ���������дѺ�٧�Թ���� ��õ�Ǩ������;�ᾷ��' <? if($result_dx['cbc_wbc'] > 10){ echo "selected='selected';";}?>>����ҳ������ʹ���������дѺ�٧�Թ���� ��õ�Ǩ������;�ᾷ��</option>              
            </select>
          </div></td>
          </tr>
          <tr>
          <td align="right" class="profilelab" width="80">PLTC : </td>
          <td width="44" class="fgn">
            <? 
			if($result_dx['cbc_pltc'] < 140 || $result_dx['cbc_pltc'] > 400){
				echo "<span style='color:#F00'><strong>$result_dx[cbc_pltc]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[cbc_pltc]</span>";
			}
			?>           
          </td>
          <td class="labfont" width="101">(<?=$result_dx['pltcrange']?>)</td>
          <td align="center" class="labfont" width="32"><span <? if($result_dx['pltcflag']!="N"){ echo " style='color:#F00'";}?>><?=$result_dx['pltcflag']?></span></td>
          <td width="202" class="labfont"><input name='normal33' type='radio' value='����' onclick="togglediv2('acnormal33')" <? if($result_dx['cbc_pltc'] >= 140 &&  $result_dx['cbc_pltc'] <= 400){ echo "checked";}?>/>
          ���� 
            <input name='normal33' type='radio' value='�Դ����' onclick="togglediv1('acnormal33')" <? if($result_dx['cbc_pltc'] < 140 || $result_dx['cbc_pltc'] > 400){ echo "checked";}?>/>
              <? 
			  if($result_dx['cbc_pltc'] < 140 || $result_dx['cbc_pltc'] > 400){
			  	echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			  }else{
			  	echo "�Դ����";
			  }
			  ?>            
            </td>
            <td><div id="acnormal33" <? if($result_dx['cbc_pltc'] >= 140 &&  $result_dx['cbc_pltc'] <= 400){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
       <select name='ch33'>
	  <option value='����ҳ������ʹ�դ�ҵ�ӡ��һ��� ��õ�Ǩ������;�ᾷ��' <? if($result_dx['cbc_pltc'] < 140){ echo "selected='selected';";}?>>����ҳ������ʹ�դ�ҵ�ӡ��һ��� ��õ�Ǩ������;�ᾷ��</option>
	  <option value='����ҳ������ʹ�դ���٧�Թ���� ��õ�Ǩ������;�ᾷ��' <? if($result_dx['cbc_pltc'] > 400){ echo "selected='selected';";}?>>����ҳ������ʹ�դ���٧�Թ���� ��õ�Ǩ������;�ᾷ��</option>      
	  </select></div></td>
          </tr>
          <tr bgcolor="#CCCCFF">
            <td colspan="5" align="center" bgcolor="#FFCC99"><strong>�š�õ�Ǩ&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</strong>
              <input name='normal81' type='radio' value='����' onclick="togglediv2('acnormal81')" id="normal97" />
              ����&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
              <input name='normal81' type='radio' value='�Դ����' onclick="togglediv1('acnormal81')" id="normal96" />
              �Դ���� </td><td bgcolor="#FFCC99"><div id="acnormal81" style='display: none;'>
            <select name='ch81'>
              <option value='��õ�Ǩ������;�ᾷ�����������˵�'>��õ�Ǩ������;�ᾷ�����������˵�</option>
			</select></div></td>
            </tr>
            </table>
</TD></TR></TABLE>
</TD></TR></TABLE>
<br />
<?
////��lab �ͧ�շ������
////*runno ��Ǩ�آ�Ҿ*/////////
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
	$nPrefix ="25".$nPrefix;
////*runno ��Ǩ�آ�Ҿ*/////////

$bsquery = "select * from condxofyear_out where hn ='".$_SESSION["hn_now"]."' and status_dr='Y' and yearcheck='".($nPrefix-2)."' ";
$bsrow = mysql_query($bsquery);
$bssult = mysql_fetch_array($bsrow);

$bquery = "select * from condxofyear_out where hn ='".$_SESSION["hn_now"]."' and status_dr='Y' and yearcheck='".($nPrefix-1)."' ";
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
			if($result_dx['bs'] < 74 || $result_dx['bs'] > 106){
				echo "<span style='color:#F00'><strong>$result_dx[bs]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[bs]</span>";
			}
			?>        
        </td>
	    <td class="labfont">(<?=$result_dx['bsrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['bsflag']!="N"){ echo "style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['bsflag']?></span></td>
	    <td class="labfont"><input name='normal47' type='radio' value='����' onclick="togglediv2('acnormal47');" <?  if($result_dx['bs'] >= 74 && $result_dx['bs'] <= 106){ echo "checked";}?>/>
����
  		<input name='normal47' type='radio' value='�Դ����' onclick="togglediv1('acnormal47');" <? if($result_dx['bs'] < 74 || $result_dx['bs'] > 106){ echo "checked";}?>/>
            <? 
			if($result_dx['bs'] < 74 || $result_dx['bs'] > 106){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>  
  		</td>
	    <td colspan="4">            
        <div id="acnormal47" <? if($result_dx['bs'] >= 74 && $result_dx['bs'] <= 106){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch47'>
        <option value="�дѺ��ӵ������ʹ�٧�Թ��һ��� �դ�������§�٧��͡���Դ����ҹ�͹Ҥ� ���������鹤Ǻ�������� �Ӿǡ����, ��, ����÷�����ʪҵ���ҹ ��е�Ǩ���� 1-2 ��" <? if($result_dx['bs'] >= 106 && $result_dx['bs'] <= 125){ echo "selected='selected';";}?>>�дѺ��ӵ������ʹ�٧�Թ��һ��� �դ�������§�٧��͡���Դ����ҹ�͹Ҥ� ���������鹤Ǻ�������� ��е�Ǩ���� 1-2 ��</option>
        <option value="�Ҩ���ä����ҹ ��þ�ᾷ�����ͻ����Թ���������ѡ��" <? if($result_dx['bs'] > 125){ echo "selected='selected';";}?>>�Ҩ���ä����ҹ ��þ�ᾷ�����ͻ����Թ���������ѡ��</option>                
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
			if($result_dx['chol'] > 200){
				echo "<span style='color:#F00'><strong>$result_dx[chol]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[chol]</span>";
			}
			?>            
        </td>
	    <td class="labfont">(<?=$result_dx['cholrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['cholflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['cholflag']?></span></td>
	    <td class="labfont"><input name='normal46' type='radio' value='����' onclick="togglediv2('acnormal46');" <? if($result_dx['chol'] <= 200){ echo "checked";}?> />
����
  <input name='normal46' type='radio' value='�Դ����' onclick="togglediv1('acnormal46');" <? if($result_dx['chol'] > 200){ echo "checked";}?>/>
            <? 
			if($result_dx['chol'] > 200){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>  		
        </td>
	    <td colspan="4">          
        <div id="acnormal46" <? if($result_dx['chol'] <= 200){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch46'>
			<option value="�дѺ��ѹ����ʹ�դ�ҼԴ������硹��� ��äǺ�������á������ѹ �͡���ѧ��� ��е�Ǩ���� 3-6 ��͹" <? if($result_dx['chol'] > 200 && $result_dx['chol'] <= 300 ){ echo "selected='selected';";}?>>�дѺ��ѹ����ʹ�դ�ҼԴ������硹��� ��äǺ�������á������ѹ �͡���ѧ��� ��е�Ǩ���� 3-6 ��͹</option>
			<option value="�дѺ��ѹ����ʹ�դ���٧�Դ���Ԥ�͹��ҧ�ҡ ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��" <? if($result_dx['chol'] > 300){ echo "selected='selected';";}?>>�дѺ��ѹ����ʹ�դ���٧�Դ���Ԥ�͹��ҧ�ҡ ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��</option>                        
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
			if($result_dx['tg'] > 150){
				echo "<span style='color:#F00'><strong>$result_dx[tg]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[tg]</span>";
			}
			?>          
		</td>
	    <td class="labfont">(<?=$result_dx['tgrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['tgflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['tgflag']?></span></td>
	    <td class="labfont"><input name='normal48' type='radio' value='����' onclick="togglediv2('acnormal48');" <? if($result_dx['tg'] <= 150){ echo "checked";}?> />
����
  <input name='normal48' type='radio' value='�Դ����' onclick="togglediv1('acnormal48');"  <? if($result_dx['tg'] > 150){ echo "checked";}?>/>
            <? 
			if($result_dx['tg'] > 150){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>  		
        </td>
	    <td colspan="4">
        <div id="acnormal48" <? if($result_dx['tg'] <= 150){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch48'>
			<option value="�дѺ��ѹ����ʹ�դ�ҼԴ������硹��� ��äǺ�������á������ѹ �͡���ѧ��� ��е�Ǩ���� 3-6 ��͹" <? if($result_dx['tg'] > 150 && $result_dx['tg'] <= 400 ){ echo "selected='selected';";}?>>�дѺ��ѹ����ʹ�դ�ҼԴ������硹��� ��äǺ�������á������ѹ �͡���ѧ��� ��е�Ǩ���� 3-6 ��͹</option>
			<option value="�дѺ��ѹ����ʹ�դ���٧�Դ���Ԥ�͹��ҧ�ҡ ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��" <? if($result_dx['tg'] > 400){ echo "selected='selected';";}?>>�дѺ��ѹ����ʹ�դ���٧�Դ���Ԥ�͹��ҧ�ҡ ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��</option>           
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
			if($result_dx['bun'] < 7 || $result_dx['bun'] > 18){
				echo "<span style='color:#F00'><strong>$result_dx[bun]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[bun]</span>";
			}
			?>          
        </td>
	    <td class="labfont">(<?=$result_dx['bunrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['bunflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['bunflag']?></span></td>
	    <td class="labfont"><input name='normal44' type='radio' value='����' onclick="togglediv2('acnormal44');" <? if($result_dx['bun'] >= 7 && $result_dx['bun'] <= 18){ echo "checked";}?>/>
����
  <input name='normal44' type='radio' value='�Դ����' onclick="togglediv1('acnormal44');" <? if($result_dx['bun'] < 7 || $result_dx['bun'] > 18){ echo "checked";}?>/>
            <? 
			if($result_dx['bun'] < 7 || $result_dx['bun'] > 18){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>          
        </td>
	    <td colspan="4">
        <div id="acnormal44" <? if($result_dx['bun'] >= 7 && $result_dx['bun'] <= 18){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch44'>
		<option value="��ҡ�÷ӧҹ�ͧ䵵�ӡ��һ��� ��þ�ᾷ�����͵�Ǩ���" <? if($result_dx['bun'] < 7){ echo "selected='selected';";}?>>��ҡ�÷ӧҹ�ͧ䵵�ӡ��һ��� ��þ�ᾷ�����͵�Ǩ���</option>        
        <option value="��ҡ�÷ӧҹ�ͧ��٧���һ��� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��" <? if($result_dx['bun'] > 18){ echo "selected='selected';";}?>>��ҡ�÷ӧҹ�ͧ��٧���һ��� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��</option>
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
			if($result_dx['cr'] < 0.6 || $result_dx['cr'] > 1.3){
				echo "<span style='color:#F00'><strong>$result_dx[cr]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[cr]</span>";
			}
			?>  
        </td>
	    <td class="labfont">(<?=$result_dx['crrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['crflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['crflag']?></span></td>
	    <td class="labfont"><input name='normal45' type='radio' value='����' onclick="togglediv2('acnormal45');" <? if($result_dx['cr'] >= 0.6 && $result_dx['cr'] <= 1.3){ echo "checked";}?> />
����
  <input name='normal45' type='radio' value='�Դ����' onclick="togglediv1('acnormal45');" <? if($result_dx['cr'] < 0.6 || $result_dx['cr'] > 1.3){ echo "checked";}?>/>
            <? 
			if($result_dx['cr'] < 0.6 || $result_dx['cr'] > 1.3){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>  
		</td>
	    <td colspan="4">
        <div id="acnormal45" <? if($result_dx['cr'] >= 0.6 && $result_dx['cr'] <= 1.3){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
		<select name='ch45'>
        <option value="��ҡ�÷ӧҹ�ͧ䵵�ӡ��һ��� ��þ�ᾷ�����͵�Ǩ���" <? if($result_dx['cr'] < 0.6){ echo "selected='selected';";}?>>��ҡ�÷ӧҹ�ͧ䵵�ӡ��һ��� ��þ�ᾷ�����͵�Ǩ���</option>
        <option value="��ҡ�÷ӧҹ�ͧ��٧���һ��� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��" <? if($result_dx['cr'] > 1.3){ echo "selected='selected';";}?>>��ҡ�÷ӧҹ�ͧ��٧���һ��� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��</option>
        </select>
       </div></td>
	      </tr>
	    <tr>
          <td width="4%" align="right" class="profilelab"> ALP : </td>
          <td width="2%" align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
            <?=$bssult['alk']?>
          </span></td>
          <td width="2%" align="center" bgcolor="#0099CC" class="labfontlab"><span class="style1">
            <?=$bsult['alk']?>
          </span></td>
          <td width="2%" align="center" bgcolor="#FFFFFF" class="profilehead">
            <? 
			if($result_dx['alk'] < 46 || $result_dx['alk'] > 116){
				echo "<span style='color:#F00'><strong>$result_dx[alk]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[alk]</span>";
			}
			?>          	</td>
			<td width="6%" class="labfont">(<?=$result_dx['alkrange']?>)</td>
            <td width="4%" align="center" class="labfont"><span <? if($result_dx['alkflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['alkflag']?></span></td>
			<td width="10%" class="labfont"><input name='normal41' type='radio' value='����' onclick="togglediv2('acnormal41');"  <? if($result_dx['alk'] >= 46 && $result_dx['alk'] <= 116){ echo "checked";}?>/>
			���� 
			  <input name='normal41' type='radio' value='�Դ����' onclick="togglediv1('acnormal41');" <? if($result_dx['alk'] < 46 || $result_dx['alk'] > 116){ echo "checked";}?>/>
            <? 
			if($result_dx['alk'] < 46 || $result_dx['alk'] > 116){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>                  
            </td>
            <td width="70%" colspan="4">
           <div id="acnormal41" <? if($result_dx['alk'] >= 46 && $result_dx['alk'] <= 116){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
           <select name='ch41'><option value="��ҡ�÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��" <? if($result_dx['alk'] < 46 || $result_dx['alk'] > 116){ echo "selected='selected';";}?>>��ҡ�÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��</option></select></div>            </td>
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
	    <td class="labfont"><input name='normal42' type='radio' value='����' onclick="togglediv2('acnormal42');" <? if($result_dx['sgpt'] <= 50){ echo "checked";}?>/>
����
  <input name='normal42' type='radio' value='�Դ����' onclick="togglediv1('acnormal42');" <? if($result_dx['sgpt'] > 50){ echo "checked";}?>/>
            <? 
			if($result_dx['sgpt'] > 50){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>  
   
  		</td>
	    <td colspan="4">          
        <div id="acnormal42" <? if($result_dx['sgpt'] <= 50){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch42'><option value="��ҡ�÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��" <? if($result_dx['sgpt'] > 50){ echo "selected='selected';";}?>>��ҡ�÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��</option></select></div>  </td>
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
			if($result_dx['sgot'] < 15 || $result_dx['sgot'] > 37){
				echo "<span style='color:#F00'><strong>$result_dx[sgot]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[sgot]</span>";
			}
			?>         
       </td>
	    <td class="labfont">(<?=$result_dx['sgotrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['sgotflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['sgotflag']?></span></td>
	    <td class="labfont"><input name='normal43' type='radio' value='����' onclick="togglediv2('acnormal43');" <? if($result_dx['sgot'] >= 15 && $result_dx['sgot'] <= 37){ echo "checked";}?>/>
����
  <input name='normal43' type='radio' value='�Դ����' onclick="togglediv1('acnormal43');" <? if($result_dx['sgot'] < 15 || $result_dx['sgot'] > 37){ echo "checked";}?>/>
            <? 
			if($result_dx['sgot'] < 15 || $result_dx['sgot'] > 37){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?>    
		</td>
	    <td colspan="4">        
        <div id="acnormal43" <? if($result_dx['sgot'] >= 15 && $result_dx['sgot'] <= 37){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch43'><option value="��ҡ�÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��" <? if($result_dx['sgot'] < 15 || $result_dx['sgot'] > 37){ echo "selected='selected';";}?>>��ҡ�÷ӧҹ�ͧ�Ѻ�Դ���� ��þ�ᾷ�������Ѻ��û����Թ���������ѡ��</option></select></div>  </td>
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
			if($result_dx['uric'] < 2.6 || $result_dx['uric'] > 7.2){
				echo "<span style='color:#F00'><strong>$result_dx[uric]</strong></span>";
			}else{
				echo "<span style='color:#00F'>$result_dx[uric]</span>";
			}
			?>         
        </td>
	    <td class="labfont">(<?=$result_dx['uricrange']?>)</td>
	    <td align="center" class="labfont"><span <? if($result_dx['uricflag']!="N"){ echo " style='color:#F00;font-weight:bold;'";}?>><?=$result_dx['uricflag']?></span></td>
	    <td class="labfont"><input name='normal49' type='radio' value='����' onclick="togglediv2('acnormal49');" <? if($result_dx['uric'] >= 2.6 && $result_dx['uric'] <= 7.2){ echo "checked";}?>/>
����
  <input name='normal49' type='radio' value='�Դ����' onclick="togglediv1('acnormal49');"<? if($result_dx['uric'] < 2.6 || $result_dx['uric'] > 7.2){ echo "checked";}?>/>
            <? 
			if($result_dx['uric'] < 2.6 || $result_dx['uric'] > 7.2){
				echo "<span style='color:#F00'><strong>�Դ����</strong></span>";
			}else{
				echo "<span style='color:#000'>�Դ����</span>";
			}
			?> 
		</td>
	    <td colspan="4">
        <div id="acnormal49" <? if($result_dx['uric'] >= 2.6 && $result_dx['uric'] <= 7.2){ echo "style='display: none;'"; }else{ echo "style='display: block;'";} ?>>
        <select name='ch49'>
		<option value="���дѺ�ô���Ԥ��ӡ��һ��� ��þ�ᾷ�����͵�Ǩ���" <? if($result_dx['uric'] < 2.6){ echo "selected='selected';";}?>>���дѺ�ô���Ԥ��ӡ��һ��� ��þ�ᾷ�����͵�Ǩ���</option>
        <option value="���дѺ�ô���Ԥ�٧�Դ���� ��äǺ�������èӾǡ����ͧ�, ����÷���, ����ͧ������š�����" <? if($result_dx['uric'] > 7.2){ echo "selected='selected';";}?>>���дѺ�ô���Ԥ�٧�Դ���� ��äǺ�������èӾǡ����ͧ�, ����÷���, ����ͧ������š�����</option>
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
	    <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="7">&nbsp;&nbsp;&nbsp;��õ�Ǩ��� �</td>
	  </tr>
	  <tr bgcolor="#CCCCFF">
	    <td width="27%" align="right" bgcolor="#FFCC99" class="tb_font_2">��Ǩ��硫�����ʹ : <a href="dxdr_xray_film.php" target="_blank">�ٿ����</a> </td>
	    <td width="21%" bgcolor="#FFCC99" class="labfont"><input name='normal51' type='radio' value='����' onclick="togglediv2('acnormal51')" id="normal58"/>
	      ����
	        <input name='normal51' type='radio' value='�Դ����' onclick="togglediv1('acnormal51')" id="normal57"/>
	      �Դ���� </td>
	    <td colspan="3" bgcolor="#FFCC99" class="labfont"><div id="acnormal51" style='display: none;'>
	      <select name="ch51" >
	        <option value="�Ҿ�͡������ǧ͡���Ѵਹ���ͧ�ҡ���������������袳е�Ǩ ��õ�Ǩ���">�Ҿ�͡������ǧ͡���Ѵਹ���ͧ�ҡ���������������袳е�Ǩ ��õ�Ǩ���</option>
	        <option value="�ʹ�Դ������� �������¹�ŧ�������º�Ѻ�͡�����ʹ���駡�͹">�ʹ�Դ������� �������¹�ŧ�������º�Ѻ�͡�����ʹ���駡�͹</option>
	        <option value="��û�֡��ᾷ�� ���͵�Ǩ�ѡ���������">��û�֡��ᾷ�� ���͵�Ǩ�ѡ���������</option>
	        </select>
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">��Ǩ����移ҡ���١ : </td>
	    <td class="labfont"><input name='normal52' type='radio' value='����' onclick="togglediv2('acnormal52')"/>
	      ����
	        <input name='normal52' type='radio' value='�Դ����' onclick="togglediv1('acnormal52')"/>
	      �Դ���� </td>
	    <td colspan="3" class="labfont"><div id="acnormal52" style='display: none;'>
	      <select name="ch52" >
	        <option value="��ͧ��ʹ�ѡ�ʺ">��ͧ��ʹ�ѡ�ʺ</option>
	        <option value="��ѧ��ͧ��ʹ�ҧŧ �ҡ���ТҴ�������/��·ͧ">��ѧ��ͧ��ʹ�ҧŧ �ҡ���ТҴ�������/��·ͧ</option>
	        <option value="�ҡ���١�ѡ�ʺ">�ҡ���١�ѡ�ʺ</option>
	        <option value="������㹪�ͧ��ʹ">������㹪�ͧ��ʹ</option>
	        <option value="���;�Ҹ�㹪�ͧ��ʹ">���;�Ҹ�㹪�ͧ��ʹ</option>
	        <option value="����ҡ���١�Դ����">����ҡ���١�Դ����</option>
	        </select>
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">��Ǩ��������� :</td>
	    <td class="labfont"><input name="other1" type="text" size="20" /></td>
	    <td class="labfont"><input name='normal53' type='radio' value='����' onclick="togglediv2('acnormal53')"/>
����
  <input name='normal53' type='radio' value='�Դ����' onclick="togglediv1('acnormal53')"/>
�Դ���� </td>
	    <td colspan="2"><div id="acnormal53" style='display: none;'>
	      <input name="ch53" type="text" size="50" value="�������Դ����.......��þ�ᾷ�� ���͵�Ǩ�����˵�" />
	      </div></td>
	    </tr>
	  <tr>
	    <td align="right" class="tb_font_2">��Ǩ��������� :</td>
	    <td class="labfont"><input name="other2" type="text" size="20" /></td>
	    <td class="labfont"><input name='normal54' type='radio' value='����' onclick="togglediv2('acnormal54')"/>
����
  <input name='normal54' type='radio' value='�Դ����' onclick="togglediv1('acnormal54')"/>
�Դ���� </td>
	    <td colspan="2"><div id="acnormal54" style='display: none;'>
	      <input name="ch54" type="text" size="50" value="�������Դ����.......��þ�ᾷ�� ���͵�Ǩ�����˵�" />
	      </div></td>
	    </tr>
    <tr>
      <td align="right" class="tb_font_2">���ä:</td>
      <td class="labfont"><input name="other2_1" type="text" size="20" /></td>
      <td class="labfont">���й�: <input name="other2_1_1" type="text" size="40" value="��þ�ᾷ�� ���͡���ѡ�ҵ�����ͧ"/></td>
      <td colspan="2"></td>
    </tr>
	  </table></td>
</tr>
</table>
<br />
<table border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" width="100%">
  <tr>
    <td><table width="100%" border="0" cellpadding="0" cellspacing="0" bgcolor="#FFCCCC">
      <tr>
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="4">&nbsp;&nbsp;&nbsp;��ػ�š�õ�Ǩ</td>
      </tr>
      <tr>
        <td width="34%" class="tb_font_2"><span class="labfont"><input name='normal61' type='checkbox' value='���� (��辺��������§)' id="normal61"/>
        ���� (��辺��������§)</span></td>
        <td width="66%" class="labfont">&nbsp;</td>
        </tr>
      <tr>
        <td align="left" class="tb_font_2"><span class="labfont"><input name='normal62' type='checkbox' value='����������§���ͧ�鹵���ä' id="normal62"/> 
          ����������§�ռ����ʹ�Թ��һ���</span></td>
        <td class="labfont">
<input name='normal621' type='checkbox' value='��ӵ��' />
��ӵ��
<input name='normal622' type='checkbox' value='��ѹ' />
��ѹ
<input name='normal623' type='checkbox' value='���Ԥ' />
���Ԥ
<input name='normal624' type='checkbox' value='�Ѻ' />
�Ѻ
<input name='normal625' type='checkbox' id="normal625" value='�' /> 
�
</td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal63' type='checkbox' value='�����й��˹ѡ�Թ' id="normal63"/>
        �����й��˹ѡ�Թ</span></td>
        <td>&nbsp;</td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal64' type='checkbox' value='�դ�Ҥ����ѹ���Ե�Թ��һ���' id="normal64"/>
        �դ�Ҥ����ѹ���Ե�Թ��һ���</span></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal65' type='checkbox' value='���´����ä������ѧ' id="normal65"/>
���´����ä������ѧ </span></td>
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
          <input name='normal66' type='checkbox' value='����硫����' id="normal66"/> 
          ����硫����
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
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="5">&nbsp;&nbsp;&nbsp;�������ä</td>
      </tr>
      <tr>
        <td width="30%" class="tb_font_2"><span class="labfont">
          <input name='anemia' type='checkbox' value='Y' id="normal"/>
          ���Ե�ҧ (Anemia)</span></td>
        <td width="32%" class="tb_font_2"><span class="labfont">
          <input name='cirrhosis' type='checkbox' value='Y' id="cirrhosis"/>
�Ѻ�� (Cirrhosis) </span></td>
        <td width="38%" class="tb_font_2"><span class="labfont">
          <input name='hepatitis' type='checkbox' value='Y' id="hepatitis"/>
�ä�Ѻ�ѡ�ʺ (Hepatitis) </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='cardiomegaly' type='checkbox' value='Y' id="cardiomegaly"/>
          �����
        </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='allergy' type='checkbox' value='Y' id="allergy"/> 
          ������
</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='gout' type='checkbox' value='Y' id="gout"/> 
          �ä��ҷ�
</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name="waistline" type='checkbox' id="waistline" value='Y'/>
�ͺ����Թ (��� &gt; 90 �.�. , ˭ԧ &gt; 80 �.�.)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='asthma' type='checkbox' value='Y' id="asthma"/>
�ͺ�״ (Asthma) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='muscle' type='checkbox' value='Y' id="muscle"/>
����������ѡ�ʺ</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='ihd' type='checkbox' value='Y' id="ihd"/>
�ä���㨢Ҵ���ʹ������ѧ (IHD)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='thyroid' type='checkbox' value='Y' id="thyroid"/>
���´�</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='heart' type='checkbox' value='Y' id="heart"/>
�ä���� </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='emphysema' type='checkbox' value='Y' id="emphysema"/>
�ا���觾ͧ</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='herniated' type='checkbox' value='Y' id="herniated"/>
��͹�ͧ��д١�Ѻ��鹻���ҷ</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='conjunctivitis' type='checkbox' value='Y' id="conjunctivitis"/>
����ͺص��ѡ�ʺ (Conjunctivitis)</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
    <input name='cystitis' type='checkbox' value='Y' id="cystitis"/>
�����л�������ѡ�ʺ (Cystitis) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='epilepsy' type='checkbox' value='Y' id="epilepsy"/>
���ѡ (Epilepsy) </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='fracture' type='checkbox' value='Y' id="fracture"/>
��д١�ѡ����͹</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='cardiac' type='checkbox' value='Y' id="cardiac"/>
�����鹼Դ�ѧ��� (Cardiac arrhythmia)</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='spine' type='checkbox' value='Y' id="spine"/>
��д١�ѹ��ѧ (͡) ��</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='dermatitis' type='checkbox' value='Y' id="dermatitis"/>
���˹ѧ�ѡ�ʺ</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='degeneration' type='checkbox' value='Y' id="degeneration"/>
������������</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='alcoholic' type='checkbox' value='Y' id="alcoholic"/>
�����Դ���Ԩҡ��š�����</span></td>
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
䵼Դ����</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='pterygium' type='checkbox' value='Y' id="pterygium"/>
�������</span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='tonsil' type='checkbox' value='Y' id="tonsil"/>
�����͹����</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='paralysis' type='checkbox' value='Y' id="paralysis"/>
����ҵ�ա����/��� </span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='blood' type='checkbox' value='Y' id="blood"/>
������ʹ�Դ���� </span></td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='conanemia' type='checkbox' value='Y' id="conanemia"/>
���Ыմ</span></td>
        <td class="tb_font_2"><span class="labfont">
          <input name='ht' type='checkbox' value='Y' id="ht"/>
          �����ѹ���Ե�٧
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
        <td align="left" class="tb_font_1" bgcolor="#0099CC" colspan="3">&nbsp;&nbsp;&nbsp;��ô��Թ�ҹ</td>
      </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
        <input name='normal91' type='checkbox' value='1 �й�����ͧ�ĵԡ����آ�Ҿ���ͻ�ͧ�ѹ��������§' id="normal91"/>
        �й�����ͧ�ĵԡ����آ�Ҿ���ͻ�ͧ�ѹ��������§
        </span></td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal92' type='checkbox' value='2 �й�����ͧ��äǺ�������� Ŵ���˹ѡ' id="normal92"/>
          �й�����ͧ��äǺ�������� Ŵ���˹ѡ</span></td>
      </tr>
      <tr>
        <td align="left" class="tb_font_2"><span class="labfont">
          <input name='normal93' type='checkbox' value='3 �йӻ�Ѻ�ĵԡ�������Ѻ��зҹ���������͡���ѧ��·����������Ѻ��� ��С���Ҿ�ᾷ�����Ѵ' id="normal93"/>
          �йӻ�Ѻ�ĵԡ�������Ѻ��зҹ���������͡���ѧ��·����������Ѻ��� ��С���Ҿ�ᾷ�����Ѵ
        </span></td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal94' type='checkbox' value='4 ���ä' id="normal94"/> 
          ���ä 
          <input name="normal941" type="text" id="normal941" size="20"  />
�觵�;�ᾷ��੾�зҧ�����ѡ�ҵ��</span></td>
        </tr>
      <tr>
        <td class="tb_font_2"><span class="labfont">
          <input name='normal95' type='checkbox' value='5 ����' id="normal95"/>
          <input name="normal951" type="text" id="normal951" size="80"  />
        </span></td>
      </tr>
    </table></td>
  </tr>
</table>
<BR>
<!-- �ѹ�֡����Թԩ�¨ҡᾷ�� -->
<TABLE border="2" cellpadding="2" cellspacing="0" bordercolor="#000000" bgcolor="#FFCCCC">
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0" >
	<TR>
		<TD align="left" class="tb_font_1" bgcolor="#339999">&nbsp;&nbsp;&nbsp;�ѹ�֡����Թԩ�¨ҡᾷ��</TD>
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
<p align="center"><input name="statusdata" type="checkbox" value="1" /> <strong>�׹�ѹ����͡�ŵ�Ǩ�آ�Ҿ</strong></p>
<center>
<!--<input name="submit" type="submit" value="��ŧ"  />&nbsp;&nbsp;-->
<input name="submit2" type="submit" value="��ŧ&amp;ʵԡ���� OPD" />
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
