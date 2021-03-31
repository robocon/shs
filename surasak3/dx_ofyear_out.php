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
<title>������ѡ����ѵԵ�Ǩ�آ�Ҿ</title>
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
<a href ="../nindex.htm" >&lt;&lt; ����</a>  || <a href="upd_labstatus.php" target="_blank">��Ѻʶҹ� LAB �繵�Ǩ�آ�Ҿ</a>
<center>
  <div class="font_title">������ѡ����ѵԵ�Ǩ�آ�Ҿ��Шӻ� (Walk in) && �ѡ�ѹ������62</div>
</center>

<form action="dx_ofyear_out.php" method="post">
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

//���� hn �ҡ opday ****************************************************************************************
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '".$_POST["p_hn"]."' limit 0,1";
	//echo $sql;
	$result = mysql_query($sql) or die("Error line 117 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>�������ѧ�����ӡ��ŧ����¹</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_assoc($result);

$sql = "Select vn,ptright,toborow From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1";
list($arr_view["vn"],$ptright,$toborow) = mysql_fetch_row(mysql_query($sql));
//echo "===>".$arr_view["vn"];

$date_hn = date("Y-m-d").$arr_view["hn"];
$date_vn = date("Y-m-d").$arr_view["vn"];

/*$sql = "Select  weight, height,waist From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height,$waist) = Mysql_fetch_row($result);*/

$sql3 = "Select  temperature,pause,rate,weight,height,bp1,bp2,waist From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' and thidate like '$thaidate%'";
$result3 = Mysql_Query($sql3);
$cou = mysql_num_rows($result3);
list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$waist) = Mysql_fetch_row($result3);
if($cou=="0"){
	$sql3 = "Select  temperature,pause,rate,weight,height,bp1,bp2,doctor,clinic From dxofyear_out where hn = '".$arr_view["hn"]."' and thidate like '".date("Y-m-d")."%'";
	$result3 = Mysql_Query($sql3);
	list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$dr,$cli) = Mysql_fetch_row($result3);
}

//�����ѹ�Դ�ҡ opcard ****************************************************************************************
	//$sql = "Select dbirth From opcard where hn = '".$arr_view["hn"]."' limit  0,1";
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
	// ���ѹ����Ǩ
	$sql = "Select date_format(a.orderdate,'%d/%m/%Y'),date_format(a.orderdate,'%Y-%m-%d') 
	From resulthead as a 
	where a.hn='".$arr_view["hn"]."'  
	AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix')  
	Order by a.autonumber DESC limit 0,1";
	list($lab_date,$labin_date) = mysql_fetch_row(mysql_query($sql));

	// �Ҽŷ���Ǩ UA
	$sql = "Select b.labcode, b.result, b.unit,b.normalrange,b.flag  
	From ( 
		SELECT MAX(`autonumber`) AS `autonumber` 
		FROM `resulthead` 
		WHERE `hn` = '".$arr_view["hn"]."' 
		AND `profilecode` = 'UA' 
		AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix' 
	) as a , 
	resultdetail as b  
	where a.autonumber = b.autonumber 
	AND b.parentcode = 'UA' 
	Order by b.seq ASC ";
	$result_ua = mysql_query($sql);

	// �Ҽŷ���Ǩ CBC
	$sql = "Select b.labcode, b.result, b.unit,b.normalrange,b.flag 
	From ( 
		SELECT MAX(`autonumber`) AS `autonumber` 
		FROM `resulthead` 
		WHERE `hn` = '".$arr_view["hn"]."' 
		AND `profilecode` = 'CBC' 
		AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix' 
	) as a , 
	resultdetail as b  
	where a.autonumber = b.autonumber 
	AND b.parentcode = 'CBC' 
	Order by b.seq ASC";
	$result_cbc = mysql_query($sql);

	// �Ҽŷ���Ǩ ����������� UA CBC
	$sql = "Select b.labcode, b.result, b.unit,b.normalrange,b.flag 
	From ( 
		SELECT MAX(`autonumber`) AS `autonumber` 
		FROM `resulthead` 
		WHERE `hn` = '".$arr_view["hn"]."' 
		AND ( `profilecode` <> 'UA' AND `profilecode` <> 'CBC' )
		AND `clinicalinfo` = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix' 
		GROUP BY `profilecode`
	) as a , 
	resultdetail as b  
	where a.autonumber = b.autonumber 
	AND parentcode <> 'UA' 
	AND parentcode <> 'CBC' 
	Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);
//���Ң��������
	
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
		if($arr_dxofyear["congenital_disease"] != ''){ $congenital_disease = $arr_dxofyear["congenital_disease"];}else{$congenital_disease = "����ʸ�ä��Шӵ��";}
		
		//echo "arr_dxofyear";
		
}else{  //// ���Ҩҡ opd
	
		$sql = "Select congenital_disease, weight, height,cigarette,alcohol,exercise ,bp1,bp2,doctor  From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";
		
		//echo "OPD";

		$result = Mysql_Query($sql);
		list($congenital_disease, $weight, $height, $cigarette, $alcohol, $exercise,$bp1,$bp2,$doctor) = Mysql_fetch_row($result);
			if($congenital_disease == "")
				$congenital_disease = "����ʸ�ä��Шӵ��";

	}
	$ht = $height/100;
	$bmi=number_format($weight /($ht*$ht),2);
	
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
?>

<!-- ���������ͧ�鹢ͧ������ -->
<FORM METHOD=POST ACTION="dx_ofyear_out_save.php" target="_blank" <?php //if($arr_view["vn"] ==""){echo "Onsubmit=\"alert('�������ѧ�����ӡ��ŧ����¹');return false;\"";}?>>

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
		<tr>
		  <td align="right"><span class="tb_font_2">˹��§ҹ : </span></td>
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
			<td width="130" align="right" class="tb_font_2">��ǹ�٧ : </td>
			<td width="79"><input id="pt_height" name="height" type="text" size="1" maxlength="6" value="<?php echo $height; ?>" />
��.</td>
			<td width="76" align="right"><span class="tb_font_2">���˹ѡ :</span></td>
			<td width="129"><input id="pt_weight" name="weight" type="text" size="1" maxlength="5" value="<?php echo $weight; ?>" />
��. </td>
			<td width="77" align="right"><span class="tb_font_2">�ͺ��� :</span></td>
			<td width="132"><input name="round_" type="text" size="1" maxlength="5" value="<?php echo $waist; ?>" />
			  ��.</td>
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
����/�ҷ�</td>
		  <td align="right"><span class="tb_font_2">R :</span></td>
		  <td align="left"><input name="rate" type="text" size="1" maxlength="3" value="<?php echo $rate;?>" />
����/�ҷ�</td>
		  <td align="left"><span class="tb_font_2">Repeat BP :</span></td>
		  <td align="left">
		  	<input name="bp21" type="text" size="1" maxlength="3" value="<?php echo $bp21;?>" /> / <input name="bp22" type="text" size="1" maxlength="3" value="<?php echo $bp22; ?>" /> mmHg<br>
			<span style="font-size: 13px; color: red;">* Repeat BP �������բ�������������ҧ</span>
		  </td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2"><span class="tb_font_2">BMI :</span></td>
		  <td colspan="2">
		  	<input name="bmi" id="pt_bmi" type="text" size="5"  value="<?php echo $bmi; ?>"  />
			<button type="button" id="btn-bmi">�ӹǳBMI</button>
		  </td>
		  <td align="left">&nbsp;</td>
		  <td align="right">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  <td align="left">&nbsp;</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">���� :</td>
		  <td colspan="7"><span class="data_show">
          <?
		  $strQuery=mysql_query("select * from drugreact where hn='".$arr_view["hn"]."'");
		  //echo $strQuery;
		  $numreact=mysql_num_rows($strQuery);
		  ?>
          
		    <input name="drugreact" type="radio" id="drugreact1" value="0" <? if(empty($numreact)){ echo "checked='checked'";}?> />
�����
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<input name="drugreact" type="radio" id="drugreact2" value="1" <? if(!empty($numreact)){ echo "checked='checked'";}?> />
�� &nbsp;&nbsp;&nbsp;&nbsp;<font color="#FF0000"><?php if(!empty($arr_view["drugreact"])){ echo  $arr_view["drugreact"];} ?></font></span></td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">������ :</td>
		  <td colspan="7">
          <? if($count > 0){ ?>
		<input type="radio" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
������ٺ&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="1" <?php if($cigarette==1){ echo "checked"; } ?> />
���ٺ ����ԡ����
&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="2" <?php if($cigarette==2){ echo "checked"; } ?> />
�ٺ������ �繤��駤���
&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="3" <?php if($cigarette==1){ echo "checked"; } ?> />
�ٺ������ �繻�Ш�
			<? }else{?>
 		<input type="radio" name="cigarette" value="0" <?php if($cigarette==0){ echo "checked"; } ?> />
������ٺ&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="1" <?php if($cigarette==2){ echo "checked"; } ?> />
���ٺ ����ԡ����
&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="2"  <?php if($cigarette==1){ echo "checked"; } ?>/>
�ٺ������ �繤��駤���
&nbsp;&nbsp;&nbsp;
		<input type="radio" name="cigarette" value="3"/>
�ٺ������ �繻�Ш�           
            <? } ?>
			</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">���� : </td>
		  <td colspan="7">
          <? if($count > 0){ ?>
		<input type="radio" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
��������&nbsp;&nbsp;&nbsp;
		<input type="radio" name="alcohol" value="1" <?php if($alcohol==1){ echo "checked"; } ?> />
�´��� ����ԡ����&nbsp;&nbsp;&nbsp;
 &nbsp;
 		<input type="radio" name="alcohol" value="2" <?php if($alcohol==2){ echo "checked"; } ?> />
���� �繤��駤���&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 		<input type="radio" name="alcohol" value="3" <?php if($alcohol==3){ echo "checked"; } ?> />
���� �繻�Ш�
		<? }else{ ?>
		<input type="radio" name="alcohol" value="0" <?php if($alcohol==0){ echo "checked"; } ?> />
���´���&nbsp;&nbsp;&nbsp;
		<input type="radio" name="alcohol" value="1" <?php if($alcohol==2){ echo "checked"; } ?> />
�´��� ����ԡ����&nbsp;&nbsp;&nbsp;
 &nbsp;
 		<input type="radio" name="alcohol" value="2" <?php if($alcohol==1){ echo "checked"; } ?> />
���� �繤��駤���&nbsp;&nbsp;&nbsp;
 &nbsp;
 &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
 		<input type="radio" name="alcohol" value="3"/>
���� �繻�Ш�		
        <? } ?>
			</td>
		  </tr>
		<tr>
          <td align="right" class="tb_font_2">�͡���ѧ��� : </td>
		  <td colspan="7">
          <? if($count > 0){ ?>
		<input type="radio" name="exercise" value="0" <?php if($exercise==0){ echo "checked"; } ?> />
������͡���ѧ���&nbsp;&nbsp;&nbsp;
		<input type="radio" name="exercise" value="1" <?php if($exercise==1){ echo "checked"; } ?> />
�͡���ѧ��� ��ӡ���ࡳ�� &nbsp;&nbsp;&nbsp;
		<input type="radio" name="exercise" value="2" <?php if($exercise==2){ echo "checked"; } ?> />
�͡���ѧ��� ���ࡳ�� 
		<? }else{ ?>
		<input type="radio" name="exercise" value="0"/>
������͡���ѧ���&nbsp;&nbsp;&nbsp;
		<input type="radio" name="exercise" value="1" checked="checked"/>
�͡���ѧ��� ��ӡ���ࡳ�� &nbsp;&nbsp;&nbsp;
		<input type="radio" name="exercise" value="2"/>
�͡���ѧ��� ���ࡳ��         
        <? } ?>
			</td>
		  </tr>
	</table>
	<TABLE class="tb_font">
	</TABLE>
	<TABLE width="725" class="tb_font">
	<tr>
           <td width="101" align="right" class="tb_font_2">�ä��Шӵ�� :</td>
           <td width="612" colspan="5" align="left"><span class="data_show">
             <input name="congenital_disease" type="text" id="congenital_disease" size="80"  value="<?php echo $congenital_disease;?>"/>
             <input type="button"  onclick="document.getElementById('congenital_disease').value='����ʸ';" name="Submit3" value="����ʸ" />
           </span></td>
         </tr>
	<tr>
	  <td align="right" class="tb_font_2">�ѡɳм����� : </td>
	  <td colspan="5" align="left"><input name="type" type="radio" value="�Թ��"  <?php if($type=="�Թ��"){ echo "checked"; } ?> />
�Թ��
  <input name="type" type="radio" value="���ö��"  <?php if($type=="���ö��"){ echo "checked"; } ?> />
���ö��
<input name="type" type="radio" value="�͹��"  <?php if($type=="�͹��"){ echo "checked"; } ?>/>
�͹��
<input name="type" type="radio" value="�ҵ�" <?php if($type=="�ҵ�"){ echo "checked"; } ?>/>
�ҵ�</td><!--onclick="clear_textbox();" -->
	  </tr>
	</TABLE>
	<TABLE class="tb_font">
	  <tr>
           <td align="right" valign="top" class="tb_font_2">�ҡ�� : </td>
           <td colspan="2" align="left" valign="top"><textarea id="organ" name="organ" cols="40" rows="6" >��Ǩ�آ�Ҿ��Шӻ�<?php echo $og;?></textarea> &nbsp;&nbsp;</td>
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
	<table class="tb_font">
		<tr>
			<td align="right" valign="top" class="tb_font_2">��Ǩ�آ�Ҿ��ͧ�ҡ��пѹ (Dental Examination) :</td>
			<td><input type="text" name="dental_exam" size="50"></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="tb_font_2">��Ǩ��µ���еҺʹ�� (Auto-R & color blindness) :</td>
			<td><input type="text" name="color_blind" size="50"></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="tb_font_2">��Ǩ������Թ (Audiogram) :</td>
			<td><input type="text" name="audiogram" size="50"></td>
		</tr>
		<tr>
			<td align="right" valign="top" class="tb_font_2">��Ǩ����俿������ (EKG) :</td>
			<td><input type="text" name="ekg" size="50"></td>
		</tr>
	</table>
	<TABLE class="tb_font">
	<tr>
           <td align="right" class="tb_font_2">��Թԡ : </td>
           <td align="left" colspan="5">
   	<select name="clinic" id="clinic">
      <?php 
	  	print "<option value='' >-- ��س����͡��Թԡ --</option>";
		print " <option value='12 �Ǫ��Ժѵ�' selected>�Ǫ��Ժѵ�</option>";
		print " <option value='01 ����á���'>����á���</option>";
		print " <option value='02 ���¡���'>���¡���</option>";
		print " <option value='03 �ٵԡ���'>�ٵԡ���</option>";
		print " <option value='04 �����Ǫ����'>�����Ǫ����</option>";
		print " <option value='05 ������Ǫ'>������Ǫ</option>";
		print " <option value='06 �ʵ �� ���ԡ'>�ʵ �� ���ԡ</option>";
		print " <option value='07 �ѡ��'>�ѡ��</option>";
		print " <option value='08 ���¡�����д١'>���¡�����дء</option>";
		print " <option value='08 ���¡����ҧ�Թ�������'>���¡����ҧ�Թ�������</option>";
		print " <option value='09 �Ե�Ǫ'>�Ե�Ǫ</option>";
		print " <option value='10 �ѧ���Է��'>�ѧ���Է��</option>";
		print " <option value='11 �ѹ�����'>�ѹ�����</option>";
		if($_SESSION["smenucode"] != "ADMMAINOPD"){
		print " <option value='12 �Ǫ��ʵ���鹿�'>�Ǫ��ʵ���鹿�</option>";
		}
		print " <option value='12 ����'>����</option>";
	?>
             </select>           </td>
         </tr>
         <tr>
           <td align="right" class="tb_font_2">ᾷ�� : </td>
           <td align="left" colspan="5"><select name="doctor" id="doctor">
               <?php 
		echo "<option value='' >-- ��س����͡ᾷ�� --</option>";
		echo "<option value='��ͧ��Ǩ�ä�����' >��ͧ��Ǩ�ä�����</option>";
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
<br />
<center>
<!--<input name="submit" type="submit" value="��ŧ"  />&nbsp;&nbsp;-->
<input name="submit2" type="submit" value="��ŧ&amp;ʵԡ���� OPD" />
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
