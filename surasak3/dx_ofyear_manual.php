<?php
session_start();
include("connect.inc");

//$date_now = date("Y-m-d H:i:s");


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

//$thaidate = (date("Y")+543).date("-m-d");


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
	.font_title{font-family:"Angsana New"; font-size:36px}
	.tb_font{font-family:"Angsana New"; font-size:24px;}
	.tb_font_1{font-family:"Angsana New"; font-size:24px; color:#FFFFFF; font-weight:bold;}
	.tb_col{font-family:"Angsana New"; font-size:24px; background-color:#9FFF9F}

.tb_font_2 {
	color: #B00000;
	font-weight: bold;
}
.style5 {color: #000099; font-weight: bold; }
</style>
</head>

<body>
<a href ="../nindex.htm" >&lt;&lt; ����</a>
<center>
  <div class="font_title">������ѡ����ѵԵ�Ǩ�آ�Ҿ</div></center>

<form action="dx_ofyear_manual.php" method="post">
<TABLE border="1" cellpadding="2" cellspacing="0" bordercolor="#393939" bgcolor="#BAF394" >
<TR>
	<TD><table width="100%" border="0" cellspacing="0" cellpadding="0">
      <tr>
        <td colspan="2" align="center" bgcolor="#0000CC"><span class="tb_font_1">��͡�����Ţ HN</span></td>
      </tr>
      <tr>
        <td width="384" class="tb_font">HN :
          <input type="text" name="p_hn"  value="<?php echo $_POST["p_hn"]?>"/>
          &nbsp;</td>
        <td width="123" rowspan="4" class="tb_font">&nbsp;&nbsp;
            <input type="submit" name="Submit" value="��ŧ" />        </td>
      </tr>
      <tr>
        <td class="tb_font">�ѹ����Ǩ :
          <input type="text" name="p_date"  value="<?php echo $_POST["p_date"]?>"/>
ex.(01/10/2556)</td>
      </tr>
      <tr>
        <td class="tb_font">��
          <input name="nPrefix" type="text" value="57" size="5"/>
          ex.(57)</td>
      </tr>
    </table></TD>
</TR>
</TABLE>
<br />
<input name="post_vn" type="hidden" value="1" />
</form>

<?php if(!empty($_POST["post_vn"]) && $_POST["p_hn"] != ""){
	
	$thaidate = substr($_POST['p_date'],6,4)."-".substr($_POST['p_date'],3,2)."-".substr($_POST['p_date'],0,2);
	$thaidate2 = (substr($_POST['p_date'],6,4)-543)."-".substr($_POST['p_date'],3,2)."-".substr($_POST['p_date'],0,2);
	$_SESSION['pdate'] = $thaidate;
	
//���� hn �ҡ opday ****************************************************************************************
	$sql = "Select *, concat(yot,' ',name,' ',surname) as ptname From opcard where  hn = '".$_POST["p_hn"]."' limit 0,1";
	//echo "--->$sql<br>";
	$result = mysql_query($sql) or die("Error line 117 \n <!-- ".$sql." --> \n <!-- ".mysql_error()." -->");
	/*if(mysql_num_rows($result) <= 0){
		echo "<CENTER>�������ѧ�����ӡ��ŧ����¹</CENTER>";
		exit();
	}*/
	$arr_view = mysql_fetch_assoc($result);

$sql = "Select vn From opd where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1"; //��� vn ����� �������¹�� table opday
list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));
if($arr_view["vn"]==0){
$sql = "Select vn From opday where thidate like '".$thaidate."%' and hn = '".$_POST["p_hn"]."' limit 0,1"; //��� vn ����� �������¹�� table opday
list($arr_view["vn"]) = mysql_fetch_row(mysql_query($sql));
}

$date_hn = $thaidate.$arr_view["hn"];
$date_vn = $thaidate.$arr_view["vn"];

/*$sql = "Select  weight, height,waist From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";
$result = Mysql_Query($sql);
list($weight, $height,$waist) = Mysql_fetch_row($result);*/

$sql3 = "Select  temperature,pause,rate,weight,height,bp1,bp2,waist From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' and thidate like '$thaidate%'";
$result3 = Mysql_Query($sql3);
$cou = mysql_num_rows($result3);
list($temperature,$pause,$rate,$weight,$height,$bp1,$bp2,$waist) = Mysql_fetch_row($result3);
if($cou=="0"){
	$sql3 = "Select  temperature,pause,rate,weight,height,bp1,bp2,doctor,clinic From dxofyear where hn = '".$arr_view["hn"]."' and thidate like '".$thaidate2."%'";
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
	
	$nPrefix1=$_POST["nPrefix"];
////*runno ��Ǩ�آ�Ҿ*/////////

//���Ҽš�õ�Ǩ�ҧ��Ҹ� ****************************************************************************************

	$sql = "Select date_format(a.orderdate,'%d/%m/%Y') From resulthead as a where a.hn='".$arr_view["hn"]."'  AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix')  Order by a.autonumber DESC limit 0,1";
	list($lab_date) = mysql_fetch_row(mysql_query($sql));

	$sql = "Select labcode, result, unit,normalrange,flag  From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'UA' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix' ) Order by labcode ASC ";

	$result_ua = mysql_query($sql);

	$sql = "Select labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode = 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix') Order by labcode ASC";
	$result_cbc = mysql_query($sql);

	$sql = "Select labcode, result, unit,normalrange,flag From resulthead as a , resultdetail as b  where a.hn='".$arr_view["hn"]."' AND a.autonumber = b.autonumber AND parentcode <> 'UA' AND parentcode <> 'CBC' AND (clinicalinfo = '��Ǩ�آ�Ҿ��Шӻ�$nPrefix') Order by a.autonumber ASC ";
	$result_lab = mysql_query($sql);
//���Ң��������
	
	$times = mktime(0,0,0,date("m"),date("d")-3,date("Y"));
	$date_after= date("Y-m-d H:i:s",$times);
	$sql = "Select * From  `dxofyear` where `thdatehn` > '{$date_after}' AND hn='".$arr_view["hn"]."' limit 0,1 ";

	$result = mysql_query($sql);
	$count = mysql_num_rows($result);
	
	if($count > 0){
		$arr_dxofyear = mysql_fetch_assoc($result);
		$height = $arr_dxofyear["height"];
		$weight = $arr_dxofyear["weight"];
		if($arr_dxofyear["cigarette"] == '1'){ $cigarette1 = "Checked";}else if($arr_dxofyear["cigarette"] == '0'){$cigarette0 = "Checked";}
		if($arr_dxofyear["alcohol"] == '1'){ $alcohol1 = "Checked";}else if($arr_dxofyear["alcohol"] == '0'){$alcohol0 = "Checked";}
		if($arr_dxofyear["congenital_disease"] != ''){ $congenital_disease = $arr_dxofyear["congenital_disease"];}else{$congenital_disease = "����ʸ�ä��Шӵ��";}
		
		
	}else{
		$sql = "Select congenital_disease, weight, height, (CASE WHEN cigarette = '1' THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '1'THEN 'Checked' ELSE '' END ), (CASE WHEN cigarette = '0'THEN 'Checked' ELSE '' END ), (CASE WHEN alcohol = '0'THEN 'Checked' ELSE '' END )   From opd where hn = '".$arr_view["hn"]."' AND type <> '�ҵ�' Order by row_id DESC limit 1";

		$result = Mysql_Query($sql);
		list($congenital_disease, $weight, $height, $cigarette1, $alcohol1, $cigarette0, $alcohol0) = Mysql_fetch_row($result);
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
?>

<!-- ���������ͧ�鹢ͧ������ -->
<FORM METHOD="POST" ACTION="dx_ofyear_save_manual.php" >

<input name="age" type="hidden" id="age"  value="<?php echo $arr_view["age"];?>" />
<input name="hn" type="hidden" id="hn"  value="<?php echo $arr_view["hn"];?>" />
<input name="vn" type="hidden" id="vn"  value="<?php echo $arr_view["vn"];?>" />
<input name="fixPrefix" type="hidden" id="fixPrefix"  value="<?php echo $_POST["nPrefix"];?>" />
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
		  <td align="right"><span class="tb_font_2">�ѧ�Ѵ : </span></td>
		  <td colspan="3">
          <select name="camp" id="camp">
			<option value='<? echo $arr_view["camp"];?>' ><? echo $arr_view["camp"];?></option> 
				<option value="M12 ��Ũѧ��Ѵ�ӻҧ">��Ũѧ��Ѵ�ӻҧ</option>
				<option value="M11 ͺ�.���ҧ">ͺ�.���ҧ</option>
                <option value="M14 �����">�����</option>
                <option value="M01 �����͹">�����͹</option>
				<option value="M02 �.17 �ѹ2">�.17 �ѹ2</option>
				<option value="M03 ���ŷ��ú����32">���ŷ��ú����32</option>
				<option value="M04 �.�.��������ѡ��������">�.�.��������ѡ��������</option>
				<option value="M05 �.�ѹ4">�.�ѹ4</option>
				<option value="M06 ���½֡ú����ɻ�еټ�">���½֡ú����ɻ�еټ�</option>
				<option value="M0301 ��.���.32">��.���.32</option>
				<option value="M0302 ���.���.32">���.���.32</option>
				<option value="M0303 ���.,���.���.32">���.,���.���.32</option>
				<option value="M0304 �¡.���.32">�¡.���.32</option>
				<option value="M0305 ���.���.32">���.���.32</option>
				<option value="M0306 ���.���.32">���.���.32</option>
				<option value="M0307 ���.���.32">���.���.32</option>
				<option value="M0308 ���.���.32">���.���.32</option>
				<option value="M0309 �ʡ.���.32">�ʡ.���.32</option>
				<option value="M0310 ����.���.32">����.���.32</option>
				<option value="M0311 ���.���.32">���.���.32</option>
				<option value="M0312 ͡.��� ���.32">͡.��� ���.32</option>
				<option value="M0313 ����.���.32">����.���.32</option>
				<option value="M0314 ���.���.32">���.���.32</option>
				<option value="M0315 �Ȩ.���.32">�Ȩ.���.32</option>
				<option value="M0316 ����.���.32">����.���.32</option>
				<option value="M0317 ʢ�.���.32">ʢ�.���.32</option>
				<option value="M0313 è.���.32">è.���.32</option>
				<option value="M0318 ���.���.32">���.���.32</option>
				<option value="M0319 ��.���.32">��.���.32</option>
				<option value="M0320 ���.���.32">���.���.32</option>
				<option value="M0321 ����.��.���.32">����.��.���.32</option>
				<option value="M0322 ��.��.���.32">��.��.���.32</option>
				<option value="M0323 �ʾ.���.32">�ʾ.���.32</option>
				<option value="M0324 ��þ���ѧ ���.32">��þ���ѧ ���.32</option>
				<option value="M0325 Ƚ.�ȷ.���.32">Ƚ.�ȷ.���.32</option>
				<option value="M0326 ���.���.32">���.���.32</option>
				<option value="M0327 �ٹ�����Ѿ�� ���.32">�ٹ�����Ѿ�� ���.32</option>
				<option value="M0328 ���.���.32">���.���.32</option>
				<option value="M08 ��ʴըѧ��Ѵ�ӻҧ">��ʴըѧ��Ѵ�ӻҧ</option>
				<option value="M09 ��.��ѧ ʻ.��">��.��ѧ ʻ.��</option>
                <option value="M10 ��� ��.33">��� ��.33</option>
				<option value="M07 ˹��·�������">˹��·�������</option>
	
			</select></td>
		  </tr>
	</table>
	<hr />
	<table width="725" border="0" class="tb_font">
	  <tr>
			<td width="64" align="right" class="tb_font_2">��ǹ�٧ : </td>
			<td width="79"><input name="height" type="text" size="1" maxlength="3" value="<?php echo $height; ?>" />
��.</td>
			<td width="64" align="right"><span class="tb_font_2">���˹ѡ :</span></td>
			<td width="109"><input name="weight" type="text" size="1" maxlength="3" value="<?php echo $weight; ?>" />
��. </td>
			<td width="65" align="right"><span class="tb_font_2">�ͺ��� :</span></td>
			<td width="112"><input name="round_" type="text" size="1" maxlength="3" value="<?php echo $waist; ?>" />
			  ��.</td>
			<td align="left"><span class="tb_font_2">BP1 :</span></td>
			<td align="left"><input name="bp1" type="text" size="1" maxlength="3" value="<?php echo $bp1;?>" />
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
		  <td align="left"><input name="bp21" type="text" size="1" maxlength="3" value="<?php echo $bp1;?>" />
/
  <input name="bp22
  " type="text" size="1" maxlength="3" value="<?php echo $bp2; ?>" />
mmHg</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">���� :</td>
		  <td colspan="7"><span class="data_show">
		    <input name="drugreact" type="radio" value="0" />
�����
<input name="drugreact" type="radio" value="1" />
�� <font class="data_drugreact"><?php echo $txt_react2;?></font></span></td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">������ :</td>
		  <td colspan="7"><input type="radio" name="cigarette" value="1" <?php echo $cigarette1;?> />
		    �ٺ&nbsp;&nbsp;&nbsp;
            <input type="radio" name="cigarette" value="0" <?php echo $cigarette0;?> />
            ����ٺ</td>
		  </tr>
		<tr>
		  <td align="right" class="tb_font_2">���� : </td>
		  <td colspan="7"><input type="radio" name="alcohol" value="1" <?php echo $alcohol1;?> />
		    ����&nbsp;&nbsp;&nbsp;
		    <input type="radio" name="alcohol" value="0" <?php echo $alcohol0;?> />
		    ������ </td>
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
	  <td colspan="5" align="left"><input name="type" type="radio" value="�Թ��" />
�Թ��
  <input name="type" type="radio" value="���ö��" />
���ö��
<input name="type" type="radio" value="�͹��" />
�͹��
<input name="type" type="radio" value="�ҵ�" onclick="clear_textbox();"/>
�ҵ�</td>
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
	<TABLE class="tb_font">
	<tr>
           <td align="right" class="tb_font_2">��Թԡ : </td>
           <td align="left" colspan="5"><select name="clinic" id="clinic">
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
		
		echo "<option value='".$name."' >".$name."</option>";
		
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
<input name="submit2" type="submit" value="��ŧ&amp;ʵԡ���� OPD" />
</center>
<INPUT TYPE="hidden" value="<?php echo $arr_dxofyear["row_id"];?>" name="row_id" />
</FORM>






<?php }?>



<?php 
include("unconnect.inc");
 ?>
</body>


</html>
