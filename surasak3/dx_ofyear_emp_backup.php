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
		$pAge="$ageY ��";
	}else{
		$pAge="$ageY �� $ageM ��͹";
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
<title>�������Ǩ�آ�Ҿ�١��ҧ</title>
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
	<a href ="../nindex.htm" >&lt;&lt; ����</a>
	<h1 class="align-center">�������Ǩ�آ�Ҿ�١��ҧ</h1>
<form action="dx_ofyear_emp.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
		<TR>
			<TD align="center" bgcolor="#0000CC" class="tb_font_1">��͡�����Ţ HN</TD>
		</TR>
		<TR>
			<TD class="tb_font"><input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/>&nbsp;<input type="submit" name="Submit" value="��ŧ" /></TD>
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

	//���� hn �ҡ opday ****************************************************************************************
	
	$sql = "SELECT *, CONCAT(`yot`,' ',`name`,' ',`surname`) as `ptname` 
	FROM `opcard` 
	WHERE `hn` = ? 
	AND `employee` = 'y' LIMIT 0,1";
	$arr_view = DB::select($sql, array($_POST['p_hn']));
	
	if(empty($arr_view)){
		echo '������繺ؤ�ҡ��ç��Һ��';
		exit;
	}
	
	// ���� vn ����ش �ҡ opd
	$sql = " SELECT vn
FROM `opd`
WHERE `hn` = ?
ORDER BY `row_id` DESC
LIMIT 1 ";
	$get_vn = DB::select($sql, array($_POST['p_hn']));
	$arr_view['vn'] = $get_vn['vn'];
	
	$date_hn = date("Y-m-d").$arr_view["hn"];
	$date_vn = date("Y-m-d").$arr_view["vn"];

/*$sql = "SELECT  weight, height,waist From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height,$waist) = Mysql_fetch_row($result);*/

$sql3 = "SELECT  temperature,pause,rate,weight,height,bp1,bp2,waist From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' and thidate like '$thaidate%'";
$result3 = Mysql_Query($sql3);
$cou = mysql_num_rows($result3);
list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$waist) = Mysql_fetch_row($result3);
if($cou=="0"){
	$sql3 = "SELECT  temperature,pause,rate,weight,height,bp1,bp2,doctor,clinic From dxofyear_out where hn = '".$arr_view["hn"]."' and thidate like '".date("Y-m-d")."%'";
	$result3 = Mysql_Query($sql3);
	list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$dr,$cli) = Mysql_fetch_row($result3);
}

//�����ѹ�Դ�ҡ opcard ****************************************************************************************
	//$sql = "SELECT dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
	//$result = mysql_query($sql) or die("Error line 122 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	//list($arr_view["dbirth"]) = mysql_fetch_row($result);
	$arr_view["age"] = calcage($arr_view["dbirth"]);

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
////*runno ��Ǩ�آ�Ҿ*/////////

//���Ҽš�õ�Ǩ�ҧ��Ҹ� ****************************************************************************************

	$sql = "SELECT date_format(a.orderdate,'%d/%m/%Y') 
	From resulthead as a 
	where a.hn='".$arr_view['hn']."'  
	AND (a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix') 
	Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	// ���Ҽŵ�Ǩ�ҧ��Ҹ�
	$sql = "SELECT labcode, result, unit,normalrange,flag 
	From resulthead as a , resultdetail as b 
	where a.hn='".$arr_view['hn']."' 
	AND a.autonumber = b.autonumber 
	AND b.parentcode = 'UA' 
	AND (a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix' ) 
	Order by b.labcode ASC ";
	$result_ua = mysql_query($sql);
	
	$sql = "SELECT labcode, result, unit,normalrange,flag 
	From resulthead as a , resultdetail as b 
	where a.hn = ?
	AND a.autonumber = b.autonumber 
	AND b.parentcode = 'UA' 
	AND (a.clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix' ) 
	Order by b.labcode ASC ";
	$test_ua = DB::select($sql, array($arr_view['hn']));
	// var_dump($test_ua);
	
	$sql = "SELECT labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "SELECT labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix') Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);

	
	
	// ���Ң�������� ���͵�Ǩ�ͺ��� ������������������ѧ dxofyear_emp �������ѧ
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
			$congenital_disease = "����ʸ�ä��Шӵ��";
		}
		
	}else{  //// ���Ҩҡ opd
	
		$sql = "SELECT congenital_disease,weight,height,cigarette,alcohol,exercise,bp1,bp2,doctor,temperature,pause,rate,waist
		FROM opd 
		WHERE hn = ? 
		AND type <> '�ҵ�' 
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
			$congenital_disease = "����ʸ�ä��Шӵ��";
		}
	}
	
	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
	if($arr_dxofyear["rate"] == ""){
		$arr_dxofyear["rate"] = 20;
	}
	
$choose = array(
	"��Ǩ����Ѵ",
	"�ҡ�͹�Ѵ",
	"����ѧ�Ѵ",
	"�ҡ�÷���任���",
	"�Ѻ�����",
	"..........�ѹ",
	"��",
	"��",
	"�纤�",
	"�������",
	"�չ���١",
	"�Ǵ�����",
	"���¹�����",
	"��ҹ��ع",
	"�������",
	"����¹",
	"����",
	"��͹����",
	"���������",
	"�����˹�����ͺ",
	"�ء�蹷�ͧ",
	"��˹��͡",
	"˹���״ �����",
	"�Ǵ��ͧ",
	"�״��ͧ",
	"��ҹ�ب��������",
	"��ͧ�١",
	"��������ʺ�Ѵ",
	"�Ǵ��ѧ",
	"�Ǵ���",
	"�Ǵᢹ",
	"�Ǵ��",
	"�Ǵ��ͧ",
	"�Ǵ����",
	"�Ǵ��⾡",
	"�ŷ��.......",
	"��͹���........",
	"��Ǩ�آ�Ҿ",
	"����Ѻ�ͧᾷ��",
	"��֡��ᾷ��",
	"�Ǵ�����µ�����",
	"�������ͤ��蹵��",
	"��蹤ѹ",
	"����������� �ҵԪ���..ID..",
	"���Ѻ�Ѥ�չ�Ѵ�մ�ä����عѢ��� ������",
	"���Ѻ�Ѥ�չ�Ѵ�մ�Ҵ���ѡ ������",
	"���Ѻ�Ѥ�չ�Ѵ�մ����ʵѺ�ѡ�ʺ�� ������",
	"�����һ���ѵ��ѡ��",
);
sort($choose);

// �ҡ�����
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

<!-- ���������ͧ�鹢ͧ������ -->
<form method="post" ACTION="dx_ofyear_emp_save.php" <?php //if($arr_view["vn"] ==""){echo "Onsubmit=\"alert('�������ѧ�����ӡ��ŧ����¹');return false;\"";}?>>

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $arr_view["vn"];?>" />

<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" width="100%" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0" width="100%">
	<TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;&nbsp;&nbsp;�����ż�����</TD>
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
			<td width="88" align="right"><span class="tb_font_2">����-ʡ�� : </span></td>
			<td><?php echo $arr_view["ptname"];?><input name="ptname" type="hidden" id="ptname" value="<?php echo $arr_view["ptname"];?>"/></td>
			<td width="49" align="right"><span class="tb_font_2">���� :</span> </td>
			<td align="left"><?php echo $arr_view["age"];?></td>
			</tr>
		  <tr><td><input type="hidden" name="camp" value="�١��ҧ �.�.��������ѡ��������"></td></tr>
	</table>
	<hr />
	<table width="854" border="0" class="tb_font">
	  <tr>
			<td width="130" align="right" class="tb_font_2">��ǹ�٧ : </td>
			<td width="79"><input name="height" type="text" size="1" maxlength="3" value="<?php echo $height; ?>" />
��.</td>
			<td width="76" align="right"><span class="tb_font_2">���˹ѡ :</span></td>
			<td width="129"><input name="weight" type="text" size="1" maxlength="3" value="<?php echo $weight; ?>" />
��. </td>
			<td width="77" align="right"><span class="tb_font_2">�ͺ��� :</span></td>
			<td width="132"><input name="round_" type="text" size="1" maxlength="3" value="<?php echo $waist; ?>" />
			  ��.</td>
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
����/�ҷ�</td>
		  <td align="right"><span class="tb_font_2">R :</span></td>
		  <td align="left"><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $rate;?>" />
����/�ҷ�</td>
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
		  <td align="right" class="tb_font_2">���� :</td>
		  <td colspan="7">
		  
			<label for="drugreact1">
				<input name="drugreact" type="radio" id="drugreact1" value="0" <?php echo $arr_view["drugreact"]==0 ? 'checked="checked"' : '' ;?> />
				�����
			</label>
			<label for="drugreact2">
				<input name="drugreact" type="radio" id="drugreact2" value="1" <?php echo $arr_view["drugreact"]==1 ? 'checked="checked"' : '' ;?> />
				�� 
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
		  <td align="right" class="tb_font_2">������ :</td>
		  <td colspan="7"><input type="radio" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
������ٺ&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?> />
���ٺ ����ԡ����
&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; } ?> />
�ٺ������ �繤��駤���
&nbsp;&nbsp;&nbsp;
<input type="radio" name="cigarette" value="3" <?php if($cigarette==3){ echo "checked"; } ?> />
�ٺ������ �繻�Ш�</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">���� : </td>
		  <td colspan="7"><input type="radio" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
��������&nbsp;&nbsp;&nbsp;
<input type="radio" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> />
�´��� ����ԡ����&nbsp;&nbsp;&nbsp;
 &nbsp;
 <input type="radio" name="alcohol" value="2" <?php if($alcohol==2){ echo "checked"; } ?> />
���� �繤��駤���&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 <input type="radio" name="alcohol" value="3" <?php if($alcohol==3){ echo "checked"; } ?> />
���� �繻�Ш�</td>
		  </tr>
		<?php */ ?>
		<tr>
			<td align="right" class="tb_font_2">������ :</td>
			<td colspan="7">
				<label for="cig1">
					<input type="radio" id="cig1" name="cigarette" value="2" <?php if($cigarette==2 OR $cigarette==3){ echo "checked"; } ?>>�ٺ
				</label>
				<label for="cig2">
					<input type="radio" id="cig2" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?>>����ٺ
				</label>
				<label for="cig3">
					<input type="radio" id="cig3" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?>>���ٺ
				</label>
			</td>
		</tr>
		<tr>
			<td align="right" class="tb_font_2">���� :</td>
			<td colspan="7">
				<label for="alc1">
					<INPUT type="radio" id="alc1" name="alcohol" value="2" <?php if($alcohol==2 OR $alcohol==3){ echo "checked"; } ?> >����&nbsp;&nbsp;&nbsp;
				</label>
				<label for="alc2">
					<INPUT type="radio" id="alc2" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> >������&nbsp;&nbsp;&nbsp;
				</label>
				<label for="alc3">
					<INPUT type="radio" id="alc3" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> >�´���
				</label>
			</td>
		</tr>
		<tr>
          <td align="right" class="tb_font_2">�͡���ѧ��� : </td>
		  <td colspan="7"><input type="radio" name="exercise" value="0" <?php if($exercise==0){ echo "checked"; } ?> />
������͡���ѧ���&nbsp;&nbsp;&nbsp;
<input type="radio" name="exercise" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
�͡���ѧ��� ��ӡ���ࡳ�� &nbsp;&nbsp;&nbsp;
<input type="radio" name="exercise" value="2" <?php if($exercise==2){ echo "checked"; } ?> />
�͡���ѧ��� ���ࡳ�� </td>
		  </tr>
	</table>
	<TABLE class="tb_font">
	</TABLE>
	<TABLE width="725" class="tb_font">
	<tr>
           <td width="101" align="right" class="tb_font_2">�ä��Шӵ�� :</td>
           <td width="612" colspan="5" align="left"><span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>"/>
             <input type="button" onclick="document.getElementById('congenital_disease').value='����ʸ';" name="Submit3" value="����ʸ" />
           </span></td>
         </tr>
	<tr>
	  <td align="right" class="tb_font_2">�ѡɳм����� : </td>
	  <td colspan="5" align="left"><input name="type" type="radio" value="�Թ��"  checked="checked" />
�Թ��
  <input name="type" type="radio" value="���ö��" />
���ö��
<input name="type" type="radio" value="�͹��" />
�͹��
<input name="type" type="radio" value="�ҵ�" />
�ҵ�</td><!--onclick="clear_textbox();" -->
	  </tr>
	</TABLE>
	<TABLE class="tb_font">
	  <tr>
           <td align="right" valign="top" class="tb_font_2">�ҡ�� : </td>
           <td colspan="2" align="left" valign="top"><textarea id="organ" name="organ" cols="40" rows="6" >��Ǩ�آ�Ҿ��Шӻ�</textarea> &nbsp;&nbsp;</td>
           <td colspan="2" align="left" valign="top">
		   <table border="0">
               <tr>
                 <td align="left"><select name="choose_organ" onchange="if(this.value != ''){document.getElementById('organ').value = document.getElementById('organ').value+' '+this.value;}" style="position: absolute;">
                   <option value="">--- ��Ǫ��� ---</option>
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
                     <option value="">--- �ҡ����� ---</option>
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
           <td align="right" class="tb_font_2">��Թԡ : </td>
           <td align="left" colspan="5">
			<select name="clinic" id="clinic">
				<option value='' >-- ��س����͡��Թԡ --</option>
				<option value='12 �Ǫ��Ժѵ�' selected>�Ǫ��Ժѵ�</option>
				<option value='01 ����á���'>����á���</option>
				<option value='02 ���¡���'>���¡���</option>
				<option value='03 �ٵԡ���'>�ٵԡ���</option>
				<option value='04 �����Ǫ����'>�����Ǫ����</option>
				<option value='05 ������Ǫ'>������Ǫ</option>
				<option value='06 �ʵ �� ���ԡ'>�ʵ �� ���ԡ</option>
				<option value='07 �ѡ��'>�ѡ��</option>
				<option value='08 ���¡�����д١'>���¡�����дء</option>
				<option value='08 ���¡����ҧ�Թ�������'>���¡����ҧ�Թ�������</option>
				<option value='09 �Ե�Ǫ'>�Ե�Ǫ</option>
				<option value='10 �ѧ���Է��'>�ѧ���Է��</option>
				<option value='11 �ѹ�����'>�ѹ�����</option>
				<?php
				if($_SESSION["smenucode"] != "ADMMAINOPD"){
					?>
					<option value='12 �Ǫ��ʵ���鹿�'>�Ǫ��ʵ���鹿�</option>
					<?php
				}
				?>
				<option value='12 ����'>����</option>
             </select>
			 </td>
         </tr>
         <tr>
           <td align="right" class="tb_font_2">ᾷ�� : </td>
           <td align="left" colspan="5">
			<?php
			$sql = "SELECT name FROM doctor WHERE status = 'y' ";
			$items = DB::select($sql);
			?>
			<select name="doctor" id="doctor">
				<option value="" >-- ��س����͡ᾷ�� --</option>
				<option value="��ͧ��Ǩ�ä�����" >��ͧ��Ǩ�ä�����</option>
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

<!-- �š�õ�Ǩ�ҧ��Ҹ� -->
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;&nbsp;&nbsp;�š�õ�Ǩ�ҧ��Ҹ� ������ѹ��� <?php echo $lab_date;?></TD>
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
<!-- �ѹ�֡����Թԩ�¨ҡᾷ�� -->
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD>
	<TABLE border="0" cellpadding="0" cellspacing="0">
	<TR>
		<TD align="left" bgcolor="#0000CC" class="tb_font_1">&nbsp;&nbsp;&nbsp;�ѹ�֡����Թԩ�¨ҡᾷ��</TD>
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
<!--<input name="submit" type="submit" value="��ŧ"  />&nbsp;&nbsp;-->
<input name="submit2" type="submit" value="��ŧ" />
</center>
<INPUT TYPE="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
</form>
<?php }?>
<?php 
// include("unconnect.inc");
?>
</body>
</html>
